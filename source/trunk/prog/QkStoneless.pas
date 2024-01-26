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
unit QkStoneless;

interface

uses
  SysUtils, Classes, QkFileObjects, QkObjects, QkMap;

type
 QXMPFile = class(QMapFile)
        public
          class function TypeInfo: String; override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
          procedure LoadFile(F: TStream; FSize: TStreamPos); override;
          procedure SaveFile(Info: TInfoEnreg1); override;
        end;

 {------------------------}

implementation

uses Quarkx, QkObjectClassList, Logging;

 {------------------------}

class function QXMPFile.TypeInfo;
begin
 Result:='.xmp';
end;

class procedure QXMPFile.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5870);
 Info.FileExt:=836;
end;

procedure QXMPFile.LoadFile(F: TStream; FSize: TStreamPos);
begin
 Log(LOG_VERBOSE, 'Loading XMP file: %s', [self.name]);
 case ReadFormat of
  rf_Default: begin  { as stand-alone file }
      raise EQObjectSavingNotSupported.Create('Loading XMP files is currently not supported.'); //FIXME: Move to dict!
     end;
 else
  inherited;
 end;
end;

procedure QXMPFile.SaveFile(Info: TInfoEnreg1);
begin
 with Info do case Format of
  rf_Default: begin  { as stand-alone file }
      raise EQObjectSavingNotSupported.Create('Saving XMP files is currently not supported.'); //FIXME: Move to dict!
     end;
 else
  inherited;
 end;
end;

 {------------------------}

initialization
  RegisterQObject(QXMPFile, 'x');
end.
