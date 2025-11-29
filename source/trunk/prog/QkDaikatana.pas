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
unit QkDaikatana;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, Classes, QkObjects, QkQ2;

procedure LoadTextureDataDK(F: TStream; Base, Taille: TStreamPos; var Texture: QTexture2);

 {------------------------}

implementation

uses SysUtils, qhelper, Quarkx, Setup, QkTextures, QkExceptions, Logging;

const
 DKMaxMipmaps = 9;

type
 TDKMiptex = packed record
              Version: Byte;
              Nom: TCompactTexName;
              padding1, padding2, padding3: Byte;
              W,H: LongInt;
              Indexes: array[0..DKMaxMipmaps-1] of LongInt;
              Animation: TCompactTexName;
              Flags: LongInt;
              Contents: LongInt;
              Palette: array[0..767] of Byte;
              Value: LongInt;
             end;

 {------------------------}

//Copied (and slightly modified) from QkTextures
procedure CheckTexName(const Texture: QTexture2; const nName: String);
var
  TexName: String;
begin
  if SetupSubSet(ssFiles, 'Textures').Specifics.Strings['TextureNameCheck']<>'' then
  begin
    TexName := Texture.GetTexName;
    if ((nName = '') or (TexName = '')) and (SetupSubSet(ssFiles, 'Textures').Specifics.Strings['TextureEmptyNameValid']<>'') then
      Exit;
    if not SameText(nName, TexName) then
      GlobalWarning(FmtLoadStr1(5569, [nName, TexName]));
  end;
end;

//Based on QkQ2's LoadTextureData
procedure LoadTextureDataDK(F: TStream; Base, Taille: TStreamPos; var Texture: QTexture2);
const
  Spec1 = 'Image#';
  PosNb = 6;
  Spec2 = 'Pal';
var
  Header: TDKMiptex;
  B: String; //FIXME: Switch to bytes!
  S: String;
  I: Integer;
  Taille1: TStreamPos;
  V: array[1..2] of Single;
  W, H: Integer;
begin
  if Taille-Base<SizeOf(Header) then
    Raise EError(5519);
  F.ReadBuffer(Header, SizeOf(Header));
  if Header.Version <> 3 then
    Raise EErrorFmt(5858, [Header.Version]);
  S:=CharToPas(Header.Nom);
  for I:=Length(S) downto 1 do
  begin
    if S[I]='/' then
    begin
      Texture.Specifics.Strings['Path']:=Copy(S,1,I-1);
      Break;
    end;
  end;
  CheckTexName(Texture, S);
  W:=Header.W;
  H:=Header.H;
  V[1]:=W;
  V[2]:=H;
  Texture.SetFloatsSpec('Size', V);
  for I:=0 to DKMaxMipmaps-1 do
  begin
    if Header.Indexes[I]=0 then
      Break;
    S:=Spec1;
    S[PosNb]:=ImgCodes[I];
    Taille1:=W*H;
    if I=DKMaxMipmaps-1 then
    begin
      if Base+Header.Indexes[I]+Taille1 > Taille then
      begin
        Log(LOG_WARNING, LoadStr1(5859), [Texture.GetFullName()]);
        Break;
      end;
    end
    else
    begin
      if Base+Header.Indexes[I]+Taille1 > Base+Header.Indexes[I+1] then
      begin
        Log(LOG_WARNING, LoadStr1(5859), [Texture.GetFullName()]);
        Break;
      end;
    end;
    SetLength(B, Taille1);
    F.Position:=Base+Header.Indexes[I];
    F.ReadBuffer(B[1], Taille1);
    Texture.Specifics.ByteArray[S]:=B;
    if not ScaleDown(W,H) then
      Break;
  end;

  //Read palette
  SetLength(B, 768);
  Move(Header.Palette, B[1], 768);
  Texture.Specifics.ByteArray[Spec2]:=B;

  if Header.Animation[0]<>0 then
    Texture.Specifics.Strings['Anim']:=CharToPas(Header.Animation);

  Texture.Specifics.Integers['Contents']:=Header.Contents;
  Texture.Specifics.Integers['Flags']:=Header.Flags;
  Texture.Specifics.Integers['Value']:=Header.Value;
  F.Position:=Base+Taille;
end;

//FIXME: Add save support!

 {------------------------}

initialization

end.
