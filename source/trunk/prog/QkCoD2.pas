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
unit QkCoD2;

interface

uses
  Classes, QkZip2, QkBsp, QkFileObjects, QkObjects, QkPixelset;

type
  QCoD2Pak = class(QZipPak)
        public
         class function TypeInfo: String; override;
         class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;
  QCoD2Bsp = class(QBsp)
        public
         class function TypeInfo: String; override;
         class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;
  QCoD2Material = class(QPixelSet)
        private
         texture_name: String;
        protected
         procedure SaveFile(Info: TInfoEnreg1); override;
         procedure LoadFile(F: TStream; FSize: TStreamPos); override;
        public
         class function TypeInfo: String; override;
         class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
         class function CanLoadBlankFileExt(const Filename: String; nParent: QObject): Boolean; override;
         function IsExplorerItem(Q: QObject) : TIsExplorerItem; override;
         function ProvidesSomeImage : QPixelSet;
         function LoadPixelSet : QPixelSet; override;
         function Description : TPixelSetDescription; override;
         function SetDescription(const PSD: TPixelSetDescription;
                                 Confirm: TSDConfirm) : Boolean; override;
        end;

implementation

uses Windows, SysUtils, Quarkx, QkExceptions, QkObjectClassList,
  Setup, Game, Logging, QkTextures, ApplPaths, ExtraFunctionality;

type
  //Based on: https://github.com/CptAsgard/CoD2Unity/blob/master/Assets/cod2materialfiles.txt
  TCoD2MaterialHeader = packed record
     offset_material: Longword;            //index to the material name
     offset_color_texture: Longword;       //index to color texture name
     unknown1: Longword;                   //UNKNOWN
     size_texture: Longword;               //texture size
     unknown2: Longword;                   //UNKNOWN, padding?
     unknown3, unknown4: Word;             //UNKNOWN, texture UV?
     unknown5, unknown6: Word;             //UNKNOWN, texture ST?
     texture_size_x, texture_size_y: Word; //texture size dimensions
     unknown7: Longword;                   //UNKNOWN, padding?
     unknown8: Longword;                   //UNKNOWN
     unknown9: Longword;                   //UNKNOWN
     unknown10: Longword;                  //UNKNOWN
     unknown11: Longword;                  //UNKNOWN
     unknown12: Longword;                  //UNKNOWN
     offset_techniqueset: Longword;        //index to techniqueset name
     unknown13: Longword;                  //UNKNOWN
     offset_shader: Longword;              //index to shader name
     offset_colormap_tag: Longword;        //index to 'colorMap'
     unknown14: Longword;                  //UNKNOWN, shader slot index?
     offset_colormap: Longword;            //index to color map name
     offset_normalmap_tag: Longword;       //index to 'normalMap'
     unknown15: Longword;                  //UNKNOWN, shader slot index?
     offset_normalmap: Longword;           //index to normal map name
     offset_specularmap_tag: Longword;     //index to 'specularMap'
     unknown16: Longword;                  //UNKNOWN, shader slot index?
     offset_specularmap: Longword;         //index to specular texture
  end;

{------------------------}

class function QCoD2Pak.TypeInfo;
begin
 Result:='.iwd';
end;

class procedure QCoD2Pak.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.FileObjectDescriptionText:=LoadStr1(5147);
 Info.FileExt:=821;
end;

{------------------------}

class function QCoD2Bsp.TypeInfo;
begin
 Result:='.d3dbsp';
end;

class procedure QCoD2Bsp.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.FileObjectDescriptionText:=LoadStr1(5151);
 Info.FileExt:=828;
end;

 {------------------------}

class function QCoD2Material.TypeInfo;
begin
 //FIXME: Cannot handle empty file extension properly, so directly opening a CoD2 material file will not work.
 Result:='';
end;

class procedure QCoD2Material.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.FileObjectDescriptionText:=LoadStr1(5152);
 Info.FileExt:=829;
end;

class function QCoD2Material.CanLoadBlankFileExt(const Filename: String; nParent: QObject): Boolean;
begin
 Result:=False;
 if CurrentGameMode=mjCoD2 then
   while (nParent<>nil) do
   begin
     if IncludeTrailingPathDelimiter(nParent.Name)=IncludeTrailingPathDelimiter(GameShadersPath) then
     begin
       Result:=True;
       break;
     end;
     nParent:=nParent.Parent;
   end;
end;

function QCoD2Material.IsExplorerItem(Q: QObject) : TIsExplorerItem;
begin
 (*if Q is QShader then
  Result:=ieResult[True] + [ieListView]
 else*)
  Result:=ieResult[False];
end;

procedure QCoD2Material.LoadFile(F: TStream; FSize: TStreamPos);
var
  header: TCoD2MaterialHeader;
  org: TStreamPos;
  S: String;
  C: Char;

  function ReadString(): String;
  begin
    repeat
      f.read(C, 1);
      if C=#0 then
        break;
      Result:=Result+C;
    until (false);
  end;

begin
 case ReadFormat of
  rf_Default: begin  { as stand-alone file }
    ObjectGameCode:=mjCoD2;
    if FSize<SizeOf(TCoD2MaterialHeader) then
      Raise EError(5519);
    org:=F.position;
    f.readbuffer(header, sizeof(header));
    f.seek(org+TStreamPos(header.offset_material), soBeginning);
    S:=ReadString(); //@
    f.seek(org+TStreamPos(header.offset_color_texture), soBeginning);
    texture_name:=ReadString(); //@
    //@
   end
   else inherited;
 end;
end;

procedure QCoD2Material.SaveFile(Info: TInfoEnreg1);
begin
 with Info do case Format of
  rf_Default: begin  { as stand-alone file }
      raise EQObjectSavingNotSupported.Create('Saving CoD2 material files is currently not supported!');
     end;
 else inherited;
 end;
end;

function QCoD2Material.ProvidesSomeImage : QPixelSet;
var
 Filename: String;
begin
 Result:=Nil;
 if texture_name<>'' then
 begin
   Filename:=ConcatPaths([GameTexturesPath, texture_name+SetupGameSet.Specifics.Strings['TextureFormat']]);
   Log(LOG_VERBOSE, 'attempting to load %s', [Filename]);
   Result:=NeedGameFile(Filename, '') as QPixelSet;
 end;
end;

function QCoD2Material.LoadPixelSet : QPixelSet;
begin
 Result:=ProvidesSomeImage;
 if Result=Nil then
  Raise EErrorFmt(5697, [Name]);
 Result.Acces;
end;

function QCoD2Material.Description : TPixelSetDescription;
begin
 Result:=LoadPixelSet.Description;
end;

function QCoD2Material.SetDescription(const PSD: TPixelSetDescription;
                                      Confirm: TSDConfirm) : Boolean;
begin
 Raise EError(5696);
end;

 {------------------------}

initialization
  RegisterQObject(QCoD2Pak, 't');
  RegisterQObject(QCoD2Bsp, 's');
  RegisterQObject(QCoD2Material, 'p');
end.

