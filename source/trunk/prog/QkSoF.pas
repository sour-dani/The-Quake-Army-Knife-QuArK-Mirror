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
unit QkSoF;

interface

uses SysUtils, Classes, QkObjects, QkFileObjects, QkBsp, QkImages, Dialogs;

type
 QM32 = class(QImage)
        protected
          class function FormatName : String; override;
          procedure SaveFile(Info: TInfoEnreg1); override;
          procedure LoadFile(F: TStream; FSize: TStreamPos); override;
          procedure CheckTexName(const nName: String); //FIXME: Should probably inherit from QTexture...
        public
          class function TypeInfo: String; override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;

 QBspSofFileHandler = class(QBspFileHandler)
  public
   procedure LoadBsp(F: TStream; StreamSize: TStreamPos); override;
   procedure SaveBsp(Info: TInfoEnreg1); override;
   function GetEntryName(const EntryIndex: Integer) : String; override;
   function GetLumpEdges: Integer; override;
   function GetLumpEntities: Integer; override;
   function GetLumpFaces: Integer; override;
   function GetLumpLeafs: Integer; override;
   function GetLumpLeafFaces: Integer; override;
   function GetLumpModels: Integer; override;
   function GetLumpNodes: Integer; override;
   function GetLumpPlanes: Integer; override;
   function GetLumpSurfEdges: Integer; override;
   function GetLumpTexInfo: Integer; override;
   function GetLumpTextures: Integer; override;
   function GetLumpVertexes: Integer; override;
 end;

implementation

uses StrUtils, Setup, Travail, Quarkx, QkExceptions, QkPixelSet,
  QkText, QkObjectClassList, ExtraFunctionality;

const
  LUMP_ENTITIES = 0;
  LUMP_PLANES = 1;
  LUMP_VERTEXES = 2;
  LUMP_VISIBILITY = 3;
  LUMP_NODES = 4;
  LUMP_TEXINFO = 5;
  LUMP_FACES = 6;
  LUMP_LIGHTING = 7;
  LUMP_LEAFS = 8;
  LUMP_LEAFFACES = 9;
  LUMP_LEAFBRUSHES = 10;
  LUMP_EDGES = 11;
  LUMP_SURFEDGES = 12;
  LUMP_MODELS = 13;
  LUMP_BRUSHES = 14;
  LUMP_BRUSHSIDES = 15;
  LUMP_POP = 16;
  LUMP_AREAS = 17;
  LUMP_AREAPORTALS = 18;
  LUMP_REGIONFACES = 19;
  LUMP_LIGHTS = 20;
  LUMP_REGIONS = 21;

  HEADER_LUMPS = 22;

type
 TBspEntries = record
                EntryPosition: LongInt;
                EntrySize: LongInt;
               end;

 TBspSOFHeader = record
                  Signature: LongInt;
                  Version: LongInt;
                  Entries: array[0..HEADER_LUMPS-1] of TBspEntries;
                 end;

const
 BspSOFEntryNames : array[0..HEADER_LUMPS-1] of String =
   (              {Actually a 'FilenameExtension' - See TypeInfo()}
    'entities'    + '.a.bspsof'   // lump_entities
   ,'planes'      + '.b.bspsof'   // lump_planes
   ,'vertexes'    + '.c.bspsof'   // lump_vertexes
   ,'visibility'  + '.d.bspsof'   // lump_visibility
   ,'nodes'       + '.e.bspsof'   // lump_nodes
   ,'texinfo'     + '.f.bspsof'   // lump_texinfo
   ,'faces'       + '.g.bspsof'   // lump_faces
   ,'lighting'    + '.h.bspsof'   // lump_lighting
   ,'leafs'       + '.i.bspsof'   // lump_leafs
   ,'leaffaces'   + '.j.bspsof'   // lump_leaffaces
   ,'leafbrushes' + '.k.bspsof'   // lump_leafbrushes
   ,'edges'       + '.l.bspsof'   // lump_edges
   ,'surfedges'   + '.m.bspsof'   // lump_surfedges
   ,'models'      + '.n.bspsof'   // lump_models
   ,'brushes'     + '.o.bspsof'   // lump_brushes
   ,'brushsides'  + '.p.bspsof'   // lump_brushsides
   ,'pop'         + '.q.bspsof'   // lump_pop
   ,'areas'       + '.r.bspsof'   // lump_areas
   ,'areaportals' + '.s.bspsof'   // lump_areaportals
   ,'regionfaces' + '.t.bspsof'   // lump_regionfaces
   ,'lights'      + '.u.bspsof'   // lump_lights
   ,'regions'     + '.v.bspsof'   // lump_regions
   );

type
  QBspSOF   = class(QFileObject)  protected class function TypeInfo: String; override; end;
  QBspSOFa  = class(QZText)       protected class function TypeInfo: String; override; end;

class function QBspSOF .TypeInfo; begin TypeInfo:='.bspsof';                         end;
class function QBspSOFa.TypeInfo; begin TypeInfo:='.a.bspsof'; {'entities.a.bspsof'} end;

 { --------------- }

const
  MIP32_VERSION = 4;
  MIPLEVELS = 16;
  MAX_OSPATH = 128; //max length of a filesystem pathname

type
 TM32Header = packed record
                Id: LongInt;                                // id / version
                Name: array[0..MAX_OSPATH-1] of Char;       // texture name
                Altname: array[0..MAX_OSPATH-1] of Char;    // texture substitution
                Animname: array[0..MAX_OSPATH-1] of Char;   // next frame in animation chain
                Damagename: array[0..MAX_OSPATH-1] of Char; // image that should be shown when damaged
                Width, Height, Offsets: array[0..MIPLEVELS-1] of LongInt; //width, height, offsets of all miplevels
                Flags: LongInt;
                Contents: LongInt;
                Value: LongInt;
                Scale_x, Scale_y: Single;
                Mip_scale: LongInt;

                // detail texturing info
                dt_name: array[0..MAX_OSPATH-1] of Char; // detailed texture name
                dt_scale_x, dt_scale_y: Single;
                dt_u, dt_v: Single;
                dt_alpha: Single;
                dt_src_blend_mode, dt_dst_blend_mode: LongInt;

                flags2: LongInt;
                damage_health: Single;

                unused: array[0..17] of LongInt; // future expansion to maintain compatibility with h2
              end;

Procedure QM32.SaveFile(Info: TInfoEnreg1);
type
  PRGB = ^TRGB;
  TRGB = array[0..2] of Byte;
const
  spec1='Image1=';
  spec2='Alpha=';
var
  LineWidth, J, K: Integer;
  m32header: TM32Header;
  ScanLine, AlphaScanLine: PByte;
  PSD,OldPSD: TPixelSetDescription;
  PBaseLineBuffer,PLineBuffer: PByte;
  SourceRGB: PRGB;
  SourceAlpha: PByte;
begin
 with Info do case Format of
  rf_Default: begin  { as stand-alone file }
    FillChar(m32header, sizeOf(m32header), 0);
    PSD.Init;
    OldPSD:=Description;
    try
      PSD.Format:=psf24bpp;  { force to 24bpp }
      PSD.AlphaBits:=psa8bpp;  { force to 8bpp alpha }
      PSDConvert(PSD, OldPSD, ccTemporary);
     { use PSD here, it is guaranteed to be 24bpp + 8bpp alpha }

      m32header.Id:=MIP32_VERSION;
      StrPCopy(m32header.Name, Name); //@Need to verify string length!
      StrPCopy(m32header.Altname, Specifics.Strings['Texture_Substitution_Path']);
      StrPCopy(m32header.Animname, Specifics.Strings['Next_Frame_Path']);
      StrPCopy(m32header.Damagename, Specifics.Strings['Damage_Texture_Path']);
      m32header.scale_x:=1.0;
      m32header.scale_y:=1.0;
      m32header.Contents:=StrToIntDef(Specifics.Strings['Contents'], 0);
      m32header.Flags   :=StrToIntDef(Specifics.Strings['Flags'], 0);
      m32header.Value   :=StrToIntDef(Specifics.Strings['Value'], 0);

      with PSD.Size do
      begin
        m32header.Width[0]:=X;
        m32header.Height[0]:=Y;
        m32header.Offsets[0]:=sizeOf(m32header);
      end;
      F.WriteBuffer(m32header, sizeOf(m32header));

      LineWidth:= m32header.Width[0] * 4;  { 4 bytes per line (32 bit)}
      ScanLine:=PByte(PSD.StartPointer);
      AlphaScanLine:=PByte(PSD.AlphaStartPointer);
      GetMem(PBaseLineBuffer, LineWidth);
      try
        for J:=1 to m32header.Height[0] do {iterate lines}
        begin
          PLineBuffer:=PBaseLineBuffer;
          SourceRGB:=PRGB(ScanLine);
          SourceAlpha:=PByte(AlphaScanLine);
          for K:=1 to m32header.Width[0] do { mix color and alpha line-by-line }
          begin
            PLineBuffer^:=SourceRGB^[2];  {rgb -> bgr  }
            Inc(PLineBuffer, 1);
            PLineBuffer^:=SourceRGB^[1];  {rgb -> bgr  }
            Inc(PLineBuffer, 1);
            PLineBuffer^:=SourceRGB^[0];  {rgb -> bgr  }
            Inc(PLineBuffer, 1);
            Inc(SourceRGB);
            PLineBuffer^:=SourceAlpha^; {inject alpha after RGB}
            Inc(PLineBuffer, 1);
            Inc(SourceAlpha);
          end;
          F.WriteBuffer(PBaseLineBuffer^, LineWidth);
          Inc(ScanLine, PSD.ScanLine);
          Inc(AlphaScanLine, PSD.AlphaScanLine);
        end;
      finally
        FreeMem(PBaseLineBuffer);
      end;
    finally
      OldPSD.Done;
      PSD.Done;
    end;
  end;
 end;
end;

procedure QM32.CheckTexName;
var
  TexName: String;
begin
  //Copied and slightly modified from QkTextures!
  if SetupSubSet(ssFiles, 'Textures').Specifics.Strings['TextureNameCheck']<>'' then
  begin
    TexName := Name;
    if ((nName = '') or (TexName = '')) and (SetupSubSet(ssFiles, 'Textures').Specifics.Strings['TextureEmptyNameValid']<>'') then
      Exit;
    if not SameText(nName, TexName) then
      GlobalWarning(FmtLoadStr1(5569, [nName, TexName]));
  end;
end;

Procedure ReadRGBA(F: TStream; var rgb, a: string; width, height: integer); //FIXME: Bytes!
type
  PRGB = ^TRGB;
  TRGB = array[0..2] of Byte;
var
  RawData, Image_Buffer, Alpha_Buffer: String; //FIXME: Bytes!
  ScanLine, Dest, Source, AlphaBuf: PChar;
  I, J, ScanW, sScanW: Integer;
begin
  {read into rawdata string}
  I:=Width*(32 div 8);    { bytes per line in the .m32 file }
  ScanW:=(I+3) and not 3; { the same but rounded up, for storing the data }
  SetLength(RawData, ScanW*Height);
  ScanLine:=PChar(RawData)+Length(RawData)-ScanW;
  sScanW:=-ScanW;
  for J:=1 to Height do
  begin
    F.ReadBuffer(ScanLine^, I);
    if I<ScanW then
      FillChar(ScanLine[I], ScanW-I, 0);  { pad with zeroes }
    Inc(ScanLine, sScanW);
  end;

  {It is assumed to be one byte per pixel if available.
   It was loaded together with the image data into 'RawData',
   but 'RawData' must now be split into two buffers : one for the image colors
   and one for the alpha channel.}
  J:=Width*Height;       { pixel count }
  Setlength(alpha_buffer, J);
  SetLength(Image_Buffer, 3*J);

  {split ABGR into RGB and Alpha}
  Source:=PChar(RawData); //FIXME: PArithByte
  Dest:=PChar(Image_Buffer); //FIXME: PArithByte
  AlphaBuf:=PChar(alpha_buffer); //FIXME: PArithByte
  for I:=1 to J do
  begin
    PRGB(Dest)^[2]:=PRGB(Source)^[0];  {bgr -> rgb  }
    PRGB(Dest)^[1]:=PRGB(Source)^[1];  {bgr -> rgb  }
    PRGB(Dest)^[0]:=PRGB(Source)^[2];  {bgr -> rgb  }
    AlphaBuf^:=Source[3];      { alpha }
    Inc(Dest, 3);
    Inc(Source, 4);
    Inc(AlphaBuf);
  end;
  a:=Alpha_Buffer;
  rgb:=Image_Buffer;
end;

Procedure QM32.LoadFile(F: TStream; FSize: TStreamPos);
const
  Spec1='Image1';
  Spec2='Alpha';
var
  m32header: TM32Header;
  org: TStreamPos;
  S: string;
  I: Integer;
  rgb, a: string; //FIXME: Bytes!
  V: array[1..2] of Single;
begin
 case ReadFormat of
  rf_Default: begin  { as stand-alone file }
     org:=F.Position;
     F.readbuffer(m32header, sizeof(m32header));
     if m32header.Id <> MIP32_VERSION then
       raise Exception.Create('Not a valid m32 file!');
     Specifics.Strings['Texture_Path']:=m32header.Name;

     //Verify if the texturename matches the filename
     S:=m32header.Name;
     for I:=Length(S) downto 1 do
     begin
       if S[I]='/' then
       begin
         Specifics.Strings['Path']:=Copy(S,1,I-1);
         S:=RightStr(S, Length(S)-I);
         Break;
       end;
     end;
     CheckTexName(S);

     Specifics.Strings['Texture_Substitution_Path']:=m32header.Altname;
     Specifics.Strings['Next_Frame_Path']:=m32header.Animname;
     Specifics.Strings['Damage_Texture_Path']:=m32header.Damagename;
     Specifics.Strings['Contents']:=format('%d',[m32header.contents]);
     Specifics.Strings['Flags']:=format('%d',[m32header.flags]);
     Specifics.Strings['Value']:=format('%d',[m32header.value]);

     V[1]:=m32header.Width[0];
     V[2]:=m32header.Height[0];
     SetFloatsSpec('Size', V);

     F.Position:=org+m32header.Offsets[0];
     ReadRGBA(f, rgb, a, m32header.Width[0], m32header.Height[0]);

     Specifics.ByteArray[Spec1]:=rgb;
     Specifics.ByteArray[Spec2]:=a;
  end;
 else inherited;
 end;
end;

class function QM32.FormatName : String;
begin
 Result:='M32';
end;

class function QM32.TypeInfo: String;
begin
  Result:='.m32';
end;

class Procedure QM32.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
  inherited;
  Info.DescriptionText:=LoadStr1(5177);
  Info.FileExt:=806;
  Info.WndInfo:=[wiWindow];
end;


 { --------------- }

function MakeFileQObject(F: TStream; const FullName: String; nParent: QObject) : QFileObject;
var
  i: TStreamPos;
begin
  {wraparound for a stupid function OpenFileObjectData having obsolete parameters }
  {tbd: clean this up in QkFileobjects and at all referencing places}
 Result:=OpenFileObjectData(F, FullName, i, nParent);
end;

procedure QBspSOFFileHandler.LoadBsp(F: TStream; StreamSize: TStreamPos);
var
 Header: TBspSOFHeader;
 Origine: TStreamPos;
 Q: QObject;
 I: Integer;
begin
  if StreamSize < SizeOf(Header) then
    Raise EError(5519);

  Origine:=F.Position;
  F.ReadBuffer(Header, SizeOf(Header));

  for I:=0 to HEADER_LUMPS-1 do
  begin
    if Header.Entries[I].EntrySize < 0 then
      Raise EErrorFmt(5509, ['Invalid entry size']);

    if Header.Entries[I].EntrySize = 0 then
      Header.Entries[I].EntryPosition := SizeOf(Header)
    else
    begin
      if Header.Entries[I].EntryPosition < SizeOf(Header) then
        Raise EErrorFmt(5509, ['Invalid file offset']);

      if Header.Entries[I].EntryPosition+Header.Entries[I].EntrySize > StreamSize then
      begin
        Header.Entries[I].EntrySize := StreamSize - Header.Entries[I].EntryPosition;
        GlobalWarning(LoadStr1(5641));
      end;
    end;

    F.Position:=Origine + Header.Entries[I].EntryPosition;
    Q:=MakeFileQObject(F, BspSOFEntryNames[I], FBsp); //FIXME: Used Header.Entries[I].EntrySize as third argument to OpenFileObjectData.
    FBsp.SubElements.Add(Q);
    LoadedItem(rf_Default, F, Q, Header.Entries[I].EntrySize);
  end;
end;

procedure QBspSOFFileHandler.SaveBsp(Info: TInfoEnreg1);
var
  Header: TBspSOFHeader;
  Origine, Fin: TStreamPos;
  Zero: LongInt;
  Q: QObject;
  I: Integer;
begin
  ProgressIndicatorStart(5450, HEADER_LUMPS);
  try
    Origine := Info.F.Position;
    Info.F.WriteBuffer(Header, SizeOf(Header));  { updated later }

    { write .bsp entries }
    for I:=0 to HEADER_LUMPS-1 do
    begin
      Q := FBsp.BspEntry[I];
      Header.Entries[I].EntryPosition := Info.F.Position;

      Q.SaveFile1(Info);   { save in non-QuArK file format }

      Header.Entries[I].EntrySize := Info.F.Position - Header.Entries[I].EntryPosition;
      Dec(Header.Entries[I].EntryPosition, Origine);

      Zero:=0;
      Info.F.WriteBuffer(Zero, (-Header.Entries[I].EntrySize) and 3);  { align to 4 bytes }

      ProgressIndicatorIncrement;
    end;

    { update header }
    Fin := Info.F.Position;

    Info.F.Position := Origine;
    Header.Signature := cSignatureBspID;
    Header.Version := cVersionBspSOF;
    Info.F.WriteBuffer(Header, SizeOf(Header));

    Info.F.Position := Fin;
  finally
    ProgressIndicatorStop;
  end;
end;

function QBspSOFFileHandler.GetEntryName(const EntryIndex: Integer) : String;
begin
  if (EntryIndex<0) or (EntryIndex>=HEADER_LUMPS) then
    raise InternalE('Tried to retrieve name of invalid BSP lump!');
  Result:=BspSOFEntryNames[EntryIndex];
end;

function QBspSOFFileHandler.GetLumpEdges: Integer;
begin
  Result:=LUMP_EDGES;
end;

function QBspSOFFileHandler.GetLumpEntities: Integer;
begin
  Result:=LUMP_ENTITIES;
end;

function QBspSOFFileHandler.GetLumpFaces: Integer;
begin
  Result:=LUMP_FACES;
end;

function QBspSOFFileHandler.GetLumpLeafs: Integer;
begin
  Result:=LUMP_LEAFS;
end;

function QBspSOFFileHandler.GetLumpLeafFaces: Integer;
begin
  Result:=LUMP_LEAFFACES;
end;

function QBspSOFFileHandler.GetLumpModels: Integer;
begin
  Result:=LUMP_MODELS;
end;

function QBspSOFFileHandler.GetLumpNodes: Integer;
begin
  Result:=LUMP_NODES;
end;

function QBspSOFFileHandler.GetLumpPlanes: Integer;
begin
  Result:=LUMP_PLANES;
end;

function QBspSOFFileHandler.GetLumpSurfEdges: Integer;
begin
  Result:=LUMP_SURFEDGES;
end;

function QBspSOFFileHandler.GetLumpTexInfo: Integer;
begin
  Result:=LUMP_TEXINFO;
end;

function QBspSOFFileHandler.GetLumpTextures: Integer;
begin
  Result:=-1;
end;

function QBspSOFFileHandler.GetLumpVertexes: Integer;
begin
  Result:=LUMP_VERTEXES;
end;

initialization
  RegisterQObject(QM32, 'l');

  RegisterQObject(QBspSOF,  '!');
  RegisterQObject(QBspSOFa, 'a');
end.
