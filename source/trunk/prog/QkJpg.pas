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
unit QkJpg;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, Classes, QkImages, QkPixelSet, QkObjects, QkFileObjects,
     DevIL, FreeImage;

type
 QJPeg = class(QImage)
        protected
          class function FileTypeDevIL : DevILType; override;
          class function FileTypeFreeImage : FREE_IMAGE_FORMAT; override;
          procedure SaveFileDevILSettings; override;
          function LoadFileFreeImageSettings : Integer; override;
          function SaveFileFreeImageSettings : Integer; override;
          class function FormatName : String; override;
          procedure SaveFile(Info: TInfoEnreg1); override;
          procedure LoadFile(F: TStream; FSize: TStreamPos); override;
        public
          class function TypeInfo: String; override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;

 {--------------------}

implementation

uses SysUtils, Setup, Quarkx, QkObjectClassList, QkTextures, Game, Logging, QkExceptions;

class function QJPeg.FormatName : String;
begin
 Result:='JPG';
end;

class function QJPeg.TypeInfo: String;
begin
 Result:='.jpg';
end;

class procedure QJPeg.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5172);
 Info.FileExt:=801;
 Info.WndInfo:=[wiWindow];
end;

class function QJpeg.FileTypeDevIL : DevILType;
begin
  Result:=IL_JPG;
end;

class function QJpeg.FileTypeFreeImage : FREE_IMAGE_FORMAT;
begin
  Result:=FIF_JPEG;
end;

procedure QJpeg.SaveFileDevILSettings;
var
  Setup: QObject;
  Flag: ILint;
begin
  inherited;

  Setup:=SetupSubSet(ssFiles, 'JPG');
  try
    case Setup.Specifics.Integers['SaveFormatDevIL'] of
    0: Flag:=IL_JFIF;
    1: Flag:=IL_EXIF;
    else
      //FIXME: Log!
      Flag:=IL_JFIF;
    end;
  except
    on EConvertError do
      //FIXME: Log!
      Flag:=IL_JFIF;
  end;
  ilSetInteger(IL_JPG_SAVE_FORMAT, Flag);
  CheckDevILError(ilGetError);

  Flag:=Round(Setup.GetFloatSpec('SaveQualityDevIL', 99));
  if Flag < 0 then
    Flag:=0;
  if Flag > 99 then
    Flag:=99;
  ilSetInteger(IL_JPG_QUALITY, Flag);
  CheckDevILError(ilGetError);

  if Setup.Specifics.Strings['SaveProgressiveDevIL']<>'' then
    ilEnable(IL_JPG_PROGRESSIVE)
  else
    ilDisable(IL_JPG_PROGRESSIVE);
  CheckDevILError(ilGetError);
end;

function QJpeg.LoadFileFreeImageSettings : Integer;
var
  Setup: QObject;
begin
  Setup:=SetupSubSet(ssFiles, 'JPG');
  try
    case Setup.Specifics.Integers['LoadQualityFreeImage'] of
    0: Result:=JPEG_DEFAULT;
    1: Result:=JPEG_FAST;
    2: Result:=JPEG_ACCURATE;
    else
      //FIXME: Log!
      Result:=JPEG_ACCURATE;
    end;
  except
    on EConvertError do
      //FIXME: Log!
      Result:=JPEG_ACCURATE;
  end;

  if Setup.Specifics.Strings['LoadCMYKFreeImage']<>'' then
    Result:=Result or JPEG_CMYK;
end;

function QJpeg.SaveFileFreeImageSettings : Integer;
var
  Setup: QObject;
begin
  Setup:=SetupSubSet(ssFiles, 'JPG');
  try
    case Setup.Specifics.Integers['SaveQualityFreeImage'] of
    0: Result:=JPEG_DEFAULT;
    1: Result:=JPEG_QUALITYBAD;
    2: Result:=JPEG_QUALITYAVERAGE;
    3: Result:=JPEG_QUALITYNORMAL;
    4: Result:=JPEG_QUALITYGOOD;
    5: Result:=JPEG_QUALITYSUPERB;
    else
      //FIXME: Log!
      Result:=JPEG_QUALITYGOOD;
    end;
  except
    on EConvertError do
      //FIXME: Log!
      Result:=JPEG_QUALITYGOOD;
  end;

  if Setup.Specifics.Strings['SaveProgressiveFreeImage']<>'' then
    Result:=Result or JPEG_PROGRESSIVE;
end;

procedure QJpeg.LoadFile(F: TStream; FSize: TStreamPos);
var
  LibraryToUse: string;
begin
  Log(LOG_VERBOSE, 'Loading JPG file: %s', [self.name]);
  case ReadFormat of
  rf_Default: begin  { as stand-alone file }
    LibraryToUse:=SetupSubSet(ssFiles, 'JPG').Specifics.Strings['LoadLibrary'];
    if LibraryToUse='DevIL' then
      LoadFileDevIL(F, FSize)
    else if LibraryToUse='FreeImage' then
      LoadFileFreeImage(F, FSize)
    else
      LogAndRaiseError(FmtLoadStr1(5813, [FormatName]));
  end;
  else
    inherited;
  end;
end;

procedure QJpeg.SaveFile(Info: TInfoEnreg1);
var
  LibraryToUse: string;
begin
 Log(LOG_VERBOSE, 'Saving JPG file: %s', [self.name]);
 with Info do
  case Format of
  rf_Default: begin  { as stand-alone file }
    LibraryToUse:=SetupSubSet(ssFiles, 'JPG').Specifics.Strings['SaveLibrary'];
    if LibraryToUse='DevIL' then
      SaveFileDevIL(Info)
    else if LibraryToUse='FreeImage' then
      SaveFileFreeImage(Info)
    else
      LogAndRaiseError(FmtLoadStr1(5814, [FormatName]));
  end
  else
    inherited;
  end;
end;

 {--------------------}

initialization
  RegisterQObject(QJPeg, 'l');
end.
