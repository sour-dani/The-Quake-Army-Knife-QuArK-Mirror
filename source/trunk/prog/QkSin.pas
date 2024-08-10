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
unit QkSin;

interface

uses SysUtils, Classes, Graphics, Dialogs, Controls,
     QkObjects, QkFileObjects, QkTextures, QkPak, QkQ2, QkBsp;

type
 QTextureSin = class(QTexture2)
        protected
          procedure SaveFile(Info: TInfoEnreg1); override;
          procedure LoadFile(F: TStream; FSize: TStreamPos); override;
        public
          class function TypeInfo: String; override;
          class function CustomParams : Integer; override;
          function BaseGame : Char; override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;
 QSinPak = class(QPak)
           public
             class function TypeInfo: String; override;
             class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
           end;

 QBspSinFileHandler = class(QBspFileHandler)
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

 {------------------------}

implementation

uses Travail, Game, Setup, Quarkx, qmath, QkText, QkExceptions, QkObjectClassList;

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
 LUMP_LIGHTINFO = 19;

 HEADER_LUMPS = 20;

type
 TBspEntries = record
                EntryPosition: LongInt;
                EntrySize: LongInt;
               end;

 TBspSinHeader = record
                  Signature: LongInt;
                  Version: LongInt;
                  Entries: array[0..HEADER_LUMPS-1] of TBspEntries;
                 end;

const
 BspSinEntryNames : array[0..HEADER_LUMPS-1] of String =
   (              {Actually a 'FilenameExtension' - See TypeInfo()}
    'entities'    + '.a.bspsin'   // lump_entities
   ,'planes'      + '.b.bspsin'   // lump_planes
   ,'vertexes'    + '.c.bspsin'   // lump_vertexes
   ,'visibility'  + '.d.bspsin'   // lump_visibility
   ,'nodes'       + '.e.bspsin'   // lump_nodes
   ,'texinfo'     + '.f.bspsin'   // lump_texinfo
   ,'faces'       + '.g.bspsin'   // lump_faces
   ,'lighting'    + '.h.bspsin'   // lump_lighting
   ,'leafs'       + '.i.bspsin'   // lump_leafs
   ,'leaffaces'   + '.j.bspsin'   // lump_leaffaces
   ,'leafbrushes' + '.k.bspsin'   // lump_leafbrushes
   ,'edges'       + '.l.bspsin'   // lump_edges
   ,'surfedges'   + '.m.bspsin'   // lump_surfedges
   ,'models'      + '.n.bspsin'   // lump_models
   ,'brushes'     + '.o.bspsin'   // lump_brushes
   ,'brushsides'  + '.p.bspsin'   // lump_brushsides
   ,'pop'         + '.q.bspsin'   // lump_pop
   ,'areas'       + '.r.bspsin'   // lump_areas
   ,'areaportals' + '.s.bspsin'   // lump_areaportals
   ,'lightinfo'   + '.t.bspsin'   // lump_lightinfo
   );

type
  QBspSin   = class(QFileObject)  protected class function TypeInfo: String; override; end;
  QBspSina  = class(QZText)       protected class function TypeInfo: String; override; end;

class function QBspSin .TypeInfo; begin TypeInfo:='.bspsin';                         end;
class function QBspSina.TypeInfo; begin TypeInfo:='.a.bspsin'; {'entities.a.bspsin'} end;

type
 {tiglari: this stuff is binary data just read into this structure in
    one gulp in QTextureSin.LoadFile}
 TSinTextureHeader = packed record
                      Name: array[0..63] of AnsiChar;
                      Width, Height: LongInt;
                      Palette: array[0..255] of record R,G,B,A: Byte; end;
                      PalCrc: Word;
                      Reserved1: Word;
                      Offsets: array[0..3] of LongInt;
                      AnimName: array[0..63] of AnsiChar;
                      Flags, Contents: LongInt;
                      Value, direct: Word;
                      animtime, nonlit: Single;
                      directangle, trans_angle: Word;
                      directstyle, translucence, friction, restitution, trans_mag: Single;
                      color: array[0..2] of Single;
                     end;

 {------------------------}

class function QTextureSin.TypeInfo: String;
begin
 Result:='.swl';
end;

class procedure QTextureSin.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5165);
 Info.FileExt:=793;
end;

class function QTextureSin.CustomParams : Integer;
begin
 Result:=cp4MipIndexes or cpPalette or cpAnyHeight;
end;

function QTextureSin.BaseGame : Char;
begin
 Result:=mjSin;
end;

procedure QTextureSin.LoadFile(F: TStream; FSize: TStreamPos);
const
 Spec1 = 'Image1=';
 Spec2 = 'Pal=';
 Spec3 = 'Alpha=';
var
 Header: TSinTextureHeader;
 Q2MipTex: TQ2MipTex;
 Base: TStreamPos;
 I: Integer;
 Lmp: PPaletteLmp;
 Data: String;
 HasAlpha: Boolean;
 P: PChar;
begin
 case ReadFormat of
  rf_Default: begin  { as stand-alone file }
      if FSize<=SizeOf(Header) then
       Raise EError(5519);
      Base:=F.Position;
      F.ReadBuffer(Header, SizeOf(Header));

       { reads the palette }
      Data:=Spec2;
      SetLength(Data, Length(Spec2)+SizeOf(TPaletteLmp));
      Lmp:=PPaletteLmp(@Data[Length(Spec2)+1]);
      HasAlpha:=False;
      for I:=Low(Lmp^) to High(Lmp^) do
       with Header.Palette[I] do
        begin
         Lmp^[I,0]:=R;
         Lmp^[I,1]:=G;
         Lmp^[I,2]:=B;
         if A<>0 then
          HasAlpha:=True;
        end;
      Specifics.AddStringFull(Data);  { "Pal=xxxxx" }

      if HasAlpha then
       begin
        Data:=Spec3;
        SetLength(Data, Length(Spec3)+256);
        P:=@Data[Length(Spec3)+1];
        for I:=0 to 255 do
         P[I]:=Chr(Header.Palette[I].A);
        Specifics.AddStringFull(Data);  { "Alpha=xxxx" }
       end;

       { reads misc flags }
      IntSpec['PalCrc']:=Header.PalCrc;
      Specifics.Integers['direct']:=Header.direct;
      SetFloatSpec('animtime', Header.animtime);
      SetFloatSpec('nonlit', Header.nonlit);
      Specifics.Integers['directangle']:=Header.directangle;
      Specifics.Integers['trans_angle']:=Header.trans_angle;
    { tiglari: this shouldn't be set since it shouldn't be in .swl's
	   at all, nor in tex. def. files, it's a label for grouping light
	   sources that go on & off together, treated as a string in the
	   editor & converted to a logical integer by qbsp, wtf knows why
	   it gets coded as a float in the .swls......
	  SetFloatSpec('directstyle', Header.directstyle); }
      SetFloatSpec('translucence', Header.translucence);
      SetFloatSpec('friction', Header.friction);
      SetFloatSpec('restitution', Header.restitution);
      SetFloatSpec('trans_mag', Header.trans_mag);

    { tiglari: we revise this so as to represent color as a string coding
	  the three floats (2 dec places)
	  SetFloatsSpec('color', Header.color); }

      Specifics.AddStringFull('color='+FloatToStrF(Header.color[0],ffFixed,7,2)+' '+
                                       FloatToStrF(Header.color[1],ffFixed,7,2)+ ' '+
                                       FloatToStrF(Header.color[2],ffFixed,7,2));

       { reads the image data }
      Q2MipTex.W:=Header.Width;
      Q2MipTex.H:=Header.Height;
      Q2MipTex.Contents:=Header.Contents;
      Q2MipTex.Flags:=Header.Flags;
      Q2MipTex.Value:=Header.Value;
      LoadTextureData(F, Base, FSize, Q2MipTex, @Header.Offsets, Header.Name, Header.AnimName);
     end;
 else inherited;
 end;
end;

{ tiglari:  Not sure what this is actually for, tho it seems to write
   info in the object-specific format to the header format. }
procedure QTextureSin.SaveFile;
var
 Header: TSinTextureHeader;
 I, Taille: Integer;
 Delta: Integer;
 Lmp: PPaletteLmp;
 S: String;
 V: array[1..2] of Single;
 Cl: array[0..2] of Double;
 begin
 with Info do case Format of
  rf_Default: begin  { as stand-alone file }
      FillChar(Header, SizeOf(Header), 0);
      StrPLCopy(Header.Name, GetTexName, SizeOf(Header.Name));
      if not GetFloatsSpec('Size', V) then
       Raise EErrorFmt(5504, ['Size']);
      Header.Width:=Round(V[1]);
      Header.Height:=Round(V[2]);
      LoadPaletteLmp(Lmp);
      for I:=0 to 255 do
       with Header.Palette[I] do
        begin
         R:=Lmp^[I,0];
         G:=Lmp^[I,1];
         B:=Lmp^[I,2];
        end;
      S:=Specifics.Bytes['Alpha'];
      for I:=1 to Length(S) do
       Header.Palette[I-1].A:=Ord(S[I]);

      Header.PalCrc:=IntSpec['PalCrc'];

      Delta:=SizeOf(Header);
      Taille:=Header.Width*Header.Height;
      for I:=0 to 3 do
       begin
        Header.Offsets[I]:=Delta;
        Inc(Delta, Taille);
        Taille:=Taille div 4;
       end;

      StrPLCopy(Header.AnimName, Specifics.Strings['Anim'], SizeOf(Header.AnimName));
      Header.Contents:=StrToIntDef(Specifics.Strings['Contents'], 0); //FIXME: Switch to QkSpecifics.Integers?
      Header.Flags   :=StrToIntDef(Specifics.Strings['Flags'], 0); //FIXME: Switch to QkSpecifics.Integers?
      Header.Value   :=StrToIntDef(Specifics.Strings['Value'], 0); //FIXME: Switch to QkSpecifics.Integers?
      Header.direct  :=StrToIntDef(Specifics.Strings['direct'], 0); //FIXME: Switch to QkSpecifics.Integers?
      Header.animtime    :=GetFloatSpec('animtime', 0.2);
      Header.nonlit      :=GetFloatSpec('nonlit', 0.0);
      Header.directangle :=StrToIntDef(Specifics.Strings['directangle'], 0); //FIXME: Switch to QkSpecifics.Integers?
      Header.trans_angle :=StrToIntDef(Specifics.Strings['trans_angle'], 0); //FIXME: Switch to QkSpecifics.Integers?
   {  tiglari: removing this one, see above
      Header.directstyle :=GetFloatSpec('directstyle', 0.0);  }
      Header.translucence :=GetFloatSpec('translucence', 0.0);
      Header.friction :=GetFloatSpec('friction', 1.0);
      Header.restitution :=GetFloatSpec('restitution', 0.0);
      Header.trans_mag :=GetFloatSpec('trans_mag', 0.0);
    { tiglari: revising rep to string
      GetFloatsSpec('color', Header.color); }
      ReadDoubleArray(Specifics.Strings['color'], Cl); //FIXME: Switch to QkSpecifics.Integers?
    { tiglari: this looks real dumb, is there a cast construction or something
       that could be used instead? }
      for I:=0 to 2 do
       Header.color[i]:=Cl[i];

      F.WriteBuffer(Header, SizeOf(Header));
      for I:=0 to 3 do
       begin
        S:=GetTexImage(I);
        F.WriteBuffer(S[1], Length(S));
       end;
     end;
 else inherited;
 end;
end;

 {------------------------}

class function QSinPak.TypeInfo;
begin
 Result:='.sin';
end;

class procedure QSinPak.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5166);
 Info.FileExt:=794;
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

procedure QBspSinFileHandler.LoadBsp(F: TStream; StreamSize: TStreamPos);
var
 Header: TBspSinHeader;
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
      Raise EErrorFmt(5509, [84]);

    if Header.Entries[I].EntrySize = 0 then
      Header.Entries[I].EntryPosition := SizeOf(Header)
    else
    begin
      if Header.Entries[I].EntryPosition < SizeOf(Header) then
        Raise EErrorFmt(5509, [85]);

      if Header.Entries[I].EntryPosition+Header.Entries[I].EntrySize > StreamSize then
      begin
        Header.Entries[I].EntrySize := StreamSize - Header.Entries[I].EntryPosition;
        GlobalWarning(LoadStr1(5641));
      end;
    end;

    F.Position:=Origine + Header.Entries[I].EntryPosition;
    Q:=MakeFileQObject(F, BspSinEntryNames[I], FBsp); //FIXME: Used Header.Entries[I].EntrySize as third argument to OpenFileObjectData.
    FBsp.SubElements.Add(Q);
    LoadedItem(rf_Default, F, Q, Header.Entries[I].EntrySize);
  end;
end;

procedure QBspSinFileHandler.SaveBsp(Info: TInfoEnreg1);
var
  Header: TBspSinHeader;
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
    Header.Signature := cSignatureBspRaven;
    Header.Version := cVersionBspSin;
    Info.F.WriteBuffer(Header, SizeOf(Header));

    Info.F.Position := Fin;
  finally
    ProgressIndicatorStop;
  end;
end;

function QBspSinFileHandler.GetEntryName(const EntryIndex: Integer) : String;
begin
  if (EntryIndex<0) or (EntryIndex>=HEADER_LUMPS) then
    raise InternalE('Tried to retrieve name of invalid BSP lump!');
  Result:=BspSinEntryNames[EntryIndex];
end;

function QBspSinFileHandler.GetLumpEdges: Integer;
begin
  Result:=LUMP_EDGES;
end;

function QBspSinFileHandler.GetLumpEntities: Integer;
begin
  Result:=LUMP_ENTITIES;
end;

function QBspSinFileHandler.GetLumpFaces: Integer;
begin
  Result:=LUMP_FACES;
end;

function QBspSinFileHandler.GetLumpLeafs: Integer;
begin
  Result:=LUMP_LEAFS;
end;

function QBspSinFileHandler.GetLumpLeafFaces: Integer;
begin
  Result:=LUMP_LEAFFACES;
end;

function QBspSinFileHandler.GetLumpModels: Integer;
begin
  Result:=LUMP_MODELS;
end;

function QBspSinFileHandler.GetLumpNodes: Integer;
begin
  Result:=LUMP_NODES;
end;

function QBspSinFileHandler.GetLumpPlanes: Integer;
begin
  Result:=LUMP_PLANES;
end;

function QBspSinFileHandler.GetLumpSurfEdges: Integer;
begin
  Result:=LUMP_SURFEDGES;
end;

function QBspSinFileHandler.GetLumpTexInfo: Integer;
begin
  Result:=LUMP_TEXINFO;
end;

function QBspSinFileHandler.GetLumpTextures: Integer;
begin
  Result:=-1;
end;

function QBspSinFileHandler.GetLumpVertexes: Integer;
begin
  Result:=LUMP_VERTEXES;
end;

 {------------------------}

initialization
  RegisterQObject(QTextureSin, 'k');
  RegisterQObject(QSinPak, 't');

  RegisterQObject(QBspSin,  '!');
  RegisterQObject(QBspSina, 'a');  
end.
