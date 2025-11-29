(**************************************************************************
QuArK -- Quake Army Knife -- 3D game editor
Copyright (C) QuArK Development Team

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

https://quark.sourceforge.io/ - Contact information in AUTHORS.TXT
**************************************************************************)
unit ZipAbbrevia;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, Sysutils, Classes, QkObjects;

function ZipCompressStream(input: TStream; var output: TMemoryStream): LongWord; //Returns the CRC32
function ZipDecompressStream(input: TStream; var output: TStream): LongWord; //Returns the CRC32

implementation

uses
  AbUtils, AbDfBase, AbZipTyp, AbDfDec, AbDfEnc, AbUnzPrc, AbZLTyp,
  Quarkx, Setup, QkExceptions;

{ pkzip header in front of every file in archive }
type
  //Same as in QkZip2.pas:
  TLocalFileHeader = packed record
    version_needed      : Word;
    bit_flag            : Word;
    compression_method  : Word;
    last_mod_datetime   : Longword;
    crc_32              : Longword;
    compressed          : Longword;
    uncompressed        : Longword;
    filename_len        : Word;
    extrafield_len      : Word;
  end;

function GetZBufferSize: Integer;
begin
  Result:=Round(SetupSubSet(ssFiles, 'ZIP').GetFloatSpec('CompressionBufferSize', 16));
  if Result<1 then
    Result:=1;
  if Result>32 then
    Result:=32; //FIXME: Allow 64 for Deflate64
  Result:=Result*1024; // Convert from KB to B.
end;

function GetZLevel: Integer;
begin
  Result:=Round(SetupSubSet(ssFiles, 'ZIP').GetFloatSpec('CompressionLevel', 8));
  if (Result<1) or (Result>9) then
    Result:=8;
end;

function ZipCompressStream(input: TStream; var output: TMemoryStream) : LongWord;
var
  Hlpr: TAbDeflateHelper;
begin
  Result:=0;

  Hlpr:=TAbDeflateHelper.Create();
  try
    Hlpr.WindowSize:=GetZBufferSize();

    //Compression levels (as per zlib 1.2.13)
    // zlib good = AmpleLength
    // zlib lazy = MaxLazyLength
    // zlib nice = ?
    // zlib chain = ChainLength
    case GetZLevel() of
     1:
      begin
       Hlpr.Options := Hlpr.Options and not dfc_UseLazyMatch;
       Hlpr.AmpleLength := 4;
       Hlpr.ChainLength := 4;
       Hlpr.MaxLazyLength := 4;
      end;
     2:
      begin
       Hlpr.Options := Hlpr.Options and not dfc_UseLazyMatch;
       Hlpr.AmpleLength := 4;
       Hlpr.ChainLength := 8;
       Hlpr.MaxLazyLength := 5;
      end;
     3:
      begin
       Hlpr.Options := Hlpr.Options and not dfc_UseLazyMatch;
       Hlpr.AmpleLength := 4;
       Hlpr.ChainLength := 32;
       Hlpr.MaxLazyLength := 6;
      end;
     4:
      begin
       Hlpr.Options := Hlpr.Options or dfc_UseLazyMatch;
       Hlpr.AmpleLength := 4;
       Hlpr.ChainLength := 16;
       Hlpr.MaxLazyLength := 4;
      end;
     5:
      begin
       Hlpr.Options := Hlpr.Options or dfc_UseLazyMatch;
       Hlpr.AmpleLength := 8;
       Hlpr.ChainLength := 32;
       Hlpr.MaxLazyLength := 16;
      end;
     6:
      begin
       Hlpr.Options := Hlpr.Options or dfc_UseLazyMatch;
       Hlpr.AmpleLength := 8;
       Hlpr.ChainLength := 128;
       Hlpr.MaxLazyLength := 16;
      end;
     7:
      begin
       Hlpr.Options := Hlpr.Options or dfc_UseLazyMatch;
       Hlpr.AmpleLength := 8;
       Hlpr.ChainLength := 256;
       Hlpr.MaxLazyLength := 32;
      end;
     8:
      begin
       Hlpr.Options := Hlpr.Options or dfc_UseLazyMatch;
       Hlpr.AmpleLength := 32;
       Hlpr.ChainLength := 1024;
       Hlpr.MaxLazyLength := 128;
      end;
     9:
      begin
       Hlpr.Options := Hlpr.Options or dfc_UseLazyMatch;
       Hlpr.AmpleLength := 32;
       Hlpr.ChainLength := 4096;
       Hlpr.MaxLazyLength := 258;
      end;
    else
      raise InternalE('invalid compression level');
    end;

    Result:=Deflate(input, output, Hlpr);
  finally
    Hlpr.Free;
  end;
end;

function ZipDecompressStream(input: TStream; var output: TStream): LongWord;
var
  Origin: TStreamPos;
  header: TLocalFileHeader;
  sig: LongWord;

  Hlpr: TAbDeflateHelper;
  Helper: TAbUnzipHelper;
begin
  Origin:=input.Position;
  input.readbuffer(sig, 4);
  input.readbuffer(header, sizeof(TLocalFileHeader));
  //compsize := header.compressed;
  //uncompsize := header.uncompressed;

  //Seek to beginning of file data
  input.seek(Origin + header.filename_len + header.extrafield_len + sizeof(TLocalFileHeader) + 4, soBeginning);

  case header.compression_method of
  0: //cmStored
  begin
    output.CopyFrom(input, header.uncompressed);
    Result:=0;
  end;
  1: //cmShrunk
  begin
    Helper := TAbUnzipHelper.Create(input, output);
    try
      Helper.DictionarySize       := dsInvalid;
      Helper.UnCompressedSize     := header.uncompressed;
      Helper.CompressionMethod    := TAbZipCompressionMethod(header.compression_method);
      Helper.ShannonFanoTreeCount := 0;
      Helper.Execute;
    finally
      Helper.Free;
    end;
    Result:=0;
  end;
  6: //cmImploded
  begin
    Helper := TAbUnzipHelper.Create(input, output);
    try
      Helper.DictionarySize       := dsInvalid;
      Helper.UnCompressedSize     := header.uncompressed;
      Helper.CompressionMethod    := TAbZipCompressionMethod(header.compression_method);
      if (header.bit_flag and $04) <> 0 then
        Helper.ShannonFanoTreeCount := 3
      else
        Helper.ShannonFanoTreeCount := 2;
      Helper.Execute;
    finally
      Helper.Free;
    end;
    Result:=0;
  end;
  8: //cmDeflated
  begin
    Hlpr := TAbDeflateHelper.Create;
    try
      Hlpr.WindowSize := GetZBufferSize();
      //if TAbZipCompressionMethod(header.compression_method) = cmEnhancedDeflated then
      //  Hlpr.Options := Hlpr.Options or dfc_UseDeflate64;
      Hlpr.StreamSize := header.compressed;

      Result:=Inflate(input, output, Hlpr);
      if Result<>header.crc_32 then
        raise Exception.Create(LoadStr1(5873));
    finally
      Hlpr.Free;
    end;
  end;
  else
    raise Exception.Create(LoadStr1(5874));
  end;
end;

end.
