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
unit QkLmp;

interface

uses Classes, Types, QkPixelSet, QkImages, QkObjects, QkFileObjects;

type
 QLmp = class(QImage)
        protected
          class function FormatName : String; override;
          procedure SaveFile(Info: TInfoEnreg1); override;
          procedure LoadFile(F: TStream; FSize: TStreamPos); override;
        public
          class function TypeInfo: String; override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;

 {------------------------}

implementation

uses Quarkx, Game, QkExceptions, QkObjectClassList, Logging, ExtraFunctionality;

type
 TLmpHeader = record
               width: Longint;
               height: Longint;
              end;

class function QLmp.FormatName : String;
begin
 Result:='LMP';
end;

class function QLmp.TypeInfo: String;
begin
 Result:='.lmp';
end;

class procedure QLmp.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5232);
 Info.FileExt:=837;
 Info.WndInfo:=[wiWindow];
end;

procedure QLmp.LoadFile(F: TStream; FSize: TStreamPos);
const
  Spec1 = 'Image1';
  Spec2 = 'Pal';
var
  Header: TLmpHeader;
  V: array[1..2] of Single;
  ImgData: String; //FIXME: TByteDynArray;
  ScanW, I: Integer;
  ScanLine: PArithByte;
  B: String; //FIXME: Switch to Bytes!
begin
 Log(LOG_VERBOSE, 'Loading LMP file: %s', [self.name]);
 case ReadFormat of
  rf_Default: begin  { as stand-alone file }
      if FSize<=SizeOf(Header) then
       Raise EError(5519);
      F.ReadBuffer(Header, SizeOf(Header));
      if FSize<SizeOf(Header)+Header.width*Header.height then Raise EErrorFmt(5186, [LoadName]);

      V[1]:=Header.width;
      V[2]:=Header.height;
      SetFloatsSpec('Size', V);
      ScanW:=(Header.width+3) and not 3;

      //Read image data
      SetLength(ImgData, ScanW * Header.height);
      ScanLine:=PArithByte(ImgData)+Length(ImgData);
      for I:=1 to Header.height do
       begin
        Dec(ScanLine, ScanW);   { image is bottom-up }

        F.ReadBuffer(ScanLine^, Header.width);
        FillChar(ScanLine^, ScanW-Header.width, 0);
       end;
      Specifics.ByteArray[Spec1]:=ImgData;

      //Use the game palette
      SetLength(B, SizeOf(TPaletteLmp));
      Move(GameBuffer(ObjectGameCode)^.PaletteLmp, B[1], SizeOf(TPaletteLmp));
      Specifics.ByteArray[Spec2]:=B;
    end;
 else inherited;
 end;
end;

procedure QLmp.SaveFile(Info: TInfoEnreg1);
const
  Spec1 = 'Image1';
var
  Header: TLmpHeader;
  Size: TPoint;
  Data: String; //FIXME: Switch to Bytes!
  ScanW, I: Integer;
  ScanLine: PArithByte;
begin
 Log(LOG_VERBOSE, 'Saving LMP file: %s', [self.name]);
 with Info do case Format of
  rf_Default: begin  { as stand-alone file }
      NotTrueColor;  { FIXME }

      //Write header
      Size:=GetSize;
      Header.width:=Size.x;
      Header.height:=Size.y;
      F.WriteBuffer(Header, SizeOf(Header));

      //Write image data
      Data:=Specifics.ByteArray[Spec1];
      ScanW:=(Size.X+3) and not 3;
      if Length(Data) <> ScanW*Size.Y then
       Raise EErrorFmt(5534, [Spec1]);
      ScanLine:=PArithByte(Data)+Length(Data);
      for I:=1 to Size.Y do
       begin
        Dec(ScanLine, ScanW);   { image is bottom-up }
        F.WriteBuffer(ScanLine^, Size.X);
       end;
     end;
 else inherited;
 end;
end;

 {------------------------}

initialization
  RegisterQObject(QLmp, 'k');
end.
