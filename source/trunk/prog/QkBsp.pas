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
unit QkBsp;

interface

uses
  Windows, Messages, SysUtils, Classes, Graphics, Controls,
  Forms, Dialogs, QkObjects, QkFileObjects, QkForm, QkMapObjects, qmath,
  StdCtrls, Python, TB97, ExtraFunctionality;

 const
  { these are the game codes for the default games
     with these surface types (organization of face
     lump }

  bspTypeQ1 =     '1';
  bspTypeH2 =     '2';
  bspTypeQ2 =     'A';
  bspTypeSin =    'C';
  bspTypeSOF =    'E';
  bspTypeQ3 =     'a';
  bspTypeHL2 =    'k';
  bspTypeG3D =    '4';

  NUM_AMBIENTS = 4;

type
(*SurfaceList = ^TSurfaceList;
 TSurfaceList = record
                 Next: PSurfaceList;
                 {Surfaces: array of TSurface}
                end;*)
 PVertexList = ^TVertexList;
 {sleazy trick below, memory will be reserved for pointers to this }
 TVertexList = array[0..0] of TVect;

 PQ1Vertex = ^TQ1Vertex;
 TQ1Vertex = vec3_t;

 PQ3Vertex = ^TQ3Vertex;
 TQ3Vertex = record
              Position : vec3_t;
              SurfCoord, LightCoord : vec2_t;
              Normal : vec3_t;
              Color : array[0..3] of Byte;
             end;

 PQ1Plane = ^TQ1Plane;
 TQ1Plane = record
            normal: vec3_t;
            dist: Single;
            flags: LongInt;
           end;

 PQ3Plane = ^TQ3Plane;
 TQ3Plane = record
            normal: vec3_t;
            dist: Single;
           end;

 PQ1Node = ^TQ1Node;
 TQ1Node = record
             plane: LongInt; //plane index
             firstchild, secondchild: SmallInt; //child indices, neg if leaf
             mins, maxs: array[0..2] of SmallInt; //bbox
             first_face, num_faces: Word;
           end;

 PQ2Node = ^TQ2Node;
 TQ2Node = record
             plane: LongInt; //plane index
             firstchild, secondchild: LongInt; //child indices, neg if leaf
             mins, maxs: array[0..2] of SmallInt; //bbox
             first_face, num_faces: Word;
           end;

 PQ3Node = ^TQ3Node;
 TQ3Node = record
            plane: LongInt; //plane index
            firstchild, secondchild: LongInt; //child indices, neg if leaf
            mins, maxs: array[0..2] of LongInt; //bbox
           end;

 { This is an intermediate 'wrapper-like' class
   for accessing the nodes in the various bsp
   trees in a common format.

   An alternative technique would be to define read
   only properties that accessed & delivered from
   the original data structure without creating a
   full intermediate record }

 BspNode = class
   public
     Source: PArithByte;
     Plane: Integer;
     firstchild: Integer; {child indices, neg if leaf }
     secondchild: Integer;
     mins, maxs: array [0..2] of Integer; {bbox}
     constructor Create(SourcePtr: PArithByte; GameCode: Char);
    end;

 PQ1Leaf = ^TQ1Leaf;
 TQ1Leaf = record
            contents: LongInt; //or of all brush info
            visofs: LongInt; //cluster index (?)
            mins, maxs: array[0..2] of SmallInt; //bbox
            first_marksurface, num_marksurfaces: Word;
            ambient_level: array[0..NUM_AMBIENTS-1] of Byte;
           end;

 PQ2Leaf = ^TQ2Leaf;
 TQ2Leaf = record
            contents: LongInt; //or of all brush info
            cluster: SmallInt; //cluster index
            area: SmallInt; //areaportal area
            mins, maxs: array[0..2] of SmallInt; //bbox
            first_leafface, num_leaffaces: Word;
            first_leafbrush, num_leafbrushes: Word;
           end;

 PSOFLeaf = ^TSOFLeaf;
 TSOFLeaf = record
             contents: LongInt; //or of all brush info
             cluster, area, region: SmallInt;
             mins, maxs: array[0..2] of SmallInt; //bbox
             first_leafface, num_leaffaces: Word;
             first_leafbrush, num_leafbrushes: Word;
            end;

 PQ3Leaf = ^TQ3Leaf;
 TQ3Leaf = record
            cluster: LongInt; //cluster index
            area: LongInt; //areaportal area
            mins, maxs: array[0..2] of LongInt; //bbox
            first_leafface, num_leaffaces: LongInt;
            first_leafbrush, num_leafbrushes: LongInt;
           end;

 { leaf version of bspnode }
 BspLeaf = class
   public
     mins, maxs: array [0..2] of integer; {bbox}
     num_leaffaces: Integer;
     Source: PArithByte;
     constructor Create(SourcePtr: PArithByte; GameCode: Char);
   end;

 TNodeStats = record
               faces : Integer; { total # faces contained }
               children : Integer; { total children, inc. empty }
               empty:  Integer; { total empty children }
               leafs : Integer;  { total leafs, inc. empty }
               emptyleafs: Integer;
              end;

 QBsp = class;

 TTreeBspPlane = class(TTreeMapGroup)
  public
   Normal: TVect;
   Dist: Double;
   Source: PArithByte;
   Number: Integer;
   constructor Create(const nName: String; nParent: QObject; Source: PQ1Plane; Index: Integer); overload;

   class function TypeInfo: String; override;
   function GetNearPlanes(Close: Double; Bsp: QBsp): PyObject;
   function PyGetAttr(attr: PyChar) : PyObject; override;
 end;

 TTreeBspNode = class(TTreeMapGroup)
  public
   Source: PArithByte;
   Bsp: QBsp;
   Plane: TTreeBspPlane;
   Leaf: boolean;
   constructor Create(const nName: String; nParent: QObject; NodeSource: BspNode; var Stats: TNodeStats); overload;
   constructor Create(const nName: String; nParent: QObject; Source: BspLeaf; var Stats: TNodeStats); overload;

   class function TypeInfo: String; override;
   procedure GetFaces(var L: PyObject);
   function PyGetAttr(attr: PyChar) : PyObject; override;
 end;

 QBspFileHandler = class
  protected
   FBsp: QBsp;
  public
   constructor Create(nBsp: QBsp);
   procedure LoadBsp(F: TStream; StreamSize: TStreamPos); virtual; abstract;
   procedure SaveBsp(Info: TInfoEnreg1); virtual; abstract;
   class function BspType : Char; overload;
   class function BspType(mj : Char) : Char; overload;
   function GetEntryName(const EntryIndex: Integer) : String; virtual; abstract;
   function GetLumpEdges: Integer; virtual; abstract;
   function GetLumpEntities: Integer; virtual; abstract;
   function GetLumpFaces: Integer; virtual; abstract;
   function GetLumpLeafs: Integer; virtual; abstract;
   function GetLumpLeafFaces: Integer; virtual; abstract;
   function GetLumpModels: Integer; virtual; abstract;
   function GetLumpNodes: Integer; virtual; abstract;
   function GetLumpPlanes: Integer; virtual; abstract;
   function GetLumpSurfEdges: Integer; virtual; abstract;
   function GetLumpTexInfo: Integer; virtual; abstract;
   function GetLumpTextures: Integer; virtual; abstract;
   function GetLumpVertexes: Integer; virtual; abstract;
 end;

 QBsp = class(QFileObject)
        private
          FFileHandler: QBspFileHandler;
          FStructure: TTreeMapBrush;
          FVerticesRefCount: Integer;
          function GetStructure : TTreeMapBrush;
          function GetBspEntry(const EntryIndex: Integer) : QFileObject;
          function DetermineGameCodeForBsp1() : Char;
          function GetNodes: QObject;
          function GetBspNode(Node: PArithByte; const Name: String; Parent: QObject; var Stats: TNodeStats) : TTreeBspNode;
        protected
          FPlaneSize, LeafSize, NodeSize, FSurfaceSize: Integer;
          FVertexCount: Integer;
          function OpenWindow(nOwner: TComponent) : TQForm1; override;
          procedure SaveFile(Info: TInfoEnreg1); override;
          procedure LoadFile(F: TStream; StreamSize: TStreamPos); override;
        public
         {FSurfaces: PSurfaceList;}
          FVertices: PVertexList;
          NonFaces: Integer;
          property Structure: TTreeMapBrush read GetStructure;
          destructor Destroy; override;
          class function TypeInfo: String; override;
          procedure ObjectState(var E: TEtatObjet); override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
          function IsExplorerItem(Q: QObject) : TIsExplorerItem; override;
          property FileHandler: QBspFileHandler read FFileHandler;
          property BspEntry[const EntryIndex: Integer] : QFileObject read GetBspEntry;
          function GetBspEntryData(const EntryIndex: Integer) : String; //FIXME: Switch to bytes!
          procedure ReLoadStructure;
          procedure CloseStructure;
          procedure VerticesAddRef(Delta: Integer);
          function GetAltTextureSrc : QObject;
          procedure Go1(maplist, extracted: PyObject; var FirstMap: String; var QCList: TQList); override;
          function PyGetAttr(attr: PyChar) : PyObject; override;
          Function GetTextureFolder: QObject;
          (*Function CreateStringListFromEntities(ExistingAddons: QFileObject; var Found: TStringList): Integer;*)
          function GetEntityLump : String;
          function CreateHull(Index: Integer; nParent: QObject; const Origin: TVect): QObject; //A TBSPHull, but that would create a circular include
          property PlaneSize: Integer read FPlaneSize;
          property SurfaceSize: Integer read FSurfaceSize;
          property VertexCount: Integer read FVertexCount;
        end;

type
  TFQBsp = class(TQForm1)
    Button1: TButton;
    procedure Button1Click(Sender: TObject);
  private
    procedure wmInternalMessage(var Msg: TMessage); message wm_InternalMessage;
  protected
    function AssignObject(const Q: QFileObject; State: TFileObjectWndState) : Boolean; override;
    function GetConfigStr: String; override;
  public
  end;

(***********  Quake 1, Hexen II and Half-Life .bsp format  ***********)
const
 cSignatureBspQ1H2 = $0000001D; {Quake-1/Hexen-2 .BSP, 4-digit header}
 cSignatureBspHL   = $0000001E; {Half-Life .BSP, 4-digit header}

(***********  id Software .bsp format  ***********)
const
 cSignatureBspID   = $50534249; {"IBSP" 4-letter header}

 //cVersionCoD2      = $00000004; {Call of Duty 2 .D3DBSP}
 cVersionBspQ2     = $00000026; {Quake-2 .BSP}
 cVersionBspDK     = $00000029; {Daikatana .BSP}
 cVersionKMQuake2  = $0000002A; {KMQuake2 .BSP}
 cVersionBspQ3     = $0000002E; {Quake-3 or STVEF or Nexuiz .BSP}
 cVersionBspSOF    = $0000002E; {Soldier of Fortune .BSP} //Raven Software didn't talk to id Software about claiming this version number, did they?
 cVersionBspQL     = $0000002F; {Quake Live .BSP}
 cVersionBspRTCW   = $0000002F; {RTCW or Wolfenstein: ET .BSP} //Gray Matter Interactive didn't talk to id Software about claiming this version number, did they?
 cVersionBspIG     = $00000030; {Iron Grip .BSP}
 cVersionBspCoD1   = $0000003B; {Call of Duty 1 .BSP}
 cVersionBspQuetoo = $00000045; {Quetoo .BSP} //Wanna bet the Quetoo developer ALSO didn't talk to id Software about claiming this version number? Also, childish 69 humour detected.

(***********  Raven Software/Ritual Entertainment .bsp format  ***********) //Erm, can you guys please NOT share BSP signatures?
const
 cSignatureBspRaven = $50534252; {"RBSP" 4-letter header}

 cVersionBspSin     = $00000001; {SiN .BSP}
 cVersionBspJK2     = $00000001; {Jedi Knight 2 .BSP}
 cVersionBspSof2    = $00000001; {Soldier of Fortune 2 .BSP} //Dear Raven; did you forget about your previous game that used the same version number?
 cVersionBspJA      = $00000001; {Jedi Academy .BSP} //Dear Raven; did you forget about your previous game that used the same version number?

(***********  Respawn Entertainment .bsp format  ***********)
const
 cSignatureBspRespawn = $50534272; {"rBSP" 4-letter header}

 cVersionBspTitanfall = $00000013; {Titanfall .BSP}

(***********  2015 .bsp format  ***********)
const
 cSignatureBsp2015 = $35313032; {"2015" 4-letter header}

 cVersionBspMOHAA  = $00000013; {MOHAA}

(***********  EALA .bsp format  ***********)
const
 cSignatureBspEALA  = $414C4145; {"EALA" 4-letter header}

 cVersionBspMOHAAXP = $00000015; {MOHAA: Spearhead or MOHAA: Breakthrough .BSP}

(***********  FAKK .bsp format  ***********)
const
  cSignatureBspFAKK = $4B4B4146; {"FAKK" 4-letter header}

  cVersionBspFAKK   = $0000000C; {FAKK .BSP}
  cVersionBspAlice  = $0000002A; {Alice .BSP}

{ (Comment by Decker 2001-01-21)
 Lots more missing here, for FAKK - but it could be a superset of Quake-3:Arena's .BSP structure!
}

(***********  (Q)Fusion-engine .bsp format  ***********)
const
  cSignatureBspQFusion = $50534246; {"FBSP" 4-letter header}

  cVersionBspWarsow    = $00000001; {Warsow .BSP}

(***********  Valve .bsp format  ***********)
const
 cSignatureBspValve = $50534256; {"VBSP" 4-letter header}

 cVersionBspHL2     = $00000013; {Half-Life 2}
 cVersionBspHL2HDR  = $00000014; {Half-Life 2 with HDR lighting; Left 4 Dead}
 cVersionBspHL2V21  = $00000015; {Half-Life 2 with various changes; Left 4 Dead 2}
 cVersionBspDMoMM   = $00040014; {Dark Messiah of Might and Magic} //FIXME: Untested

(***********  Other .bsp format  ***********)
const
 cSignatureBspEF2    = $21324645; {"EF2!" 4-letter header; Star Trek: Elite Force 2} //FIXME: Untested
 cSignatureBspOther  = $20505342; {"BSP " 4-letter header}

 cVersionBspEF2      = $00000014; {Star Trek: Elite Force 2} //FIXME: Untested
 cVersionBspOverDose = $00000055; {OverDose} //FIXME: Untested

(*const
  HEADER_LUMPS = 64; //From HL2's bspfile.h

type
 THL2Lump_T = record
      fileofs: LongInt;
      filelen: LongInt;
      version: LongInt;
      fourCC: array[1..4] of Char;
 end;

 TBspHL2Header = record
      Signature: LongInt;
      Version: LongInt;
      lumps: array[1..HEADER_LUMPS] of THL2Lump_T;
      mapRevision: LongInt;
 end;

//FIXME: Lots of stuff missing here*)

 {------------------------}

Function StringListFromEntityLump(const e_lump: String; ExistingAddons: QFileObject; var Found: TStringList): Integer;
function DetermineIfSin(F: TStream; FSize: TStreamPos) : Boolean;

implementation

uses Travail, QkWad, Setup, Game, QkMap, QkBspHulls, ApplPaths,
     Undo, Quarkx, QkExceptions, PyForms, PyMath, PyObjects,
     QkObjectClassList, ToolBox1, ToolBoxGroup,
     QkQuakeCtx, FormCfg, Logging, QkTextures, QkFormCfg,
     QkQ1, QkQ2, QkSin, QkQ3, QkG3D;

{$R *.DFM}

 {------------------------}

function PlanesClose(const Plane1, Plane2: PArithByte; const BSPType: Char; const Close: Double): boolean;
var
  PlanePt1, PlanePt2, PlaneNorm1, PlaneNorm2: TVect;
begin
  Result:=False;
  if BSPType=bspTypeQ3 then
  begin
    with PQ3Plane(Plane1)^ do
    begin
      PlaneNorm1:=MakeVect(normal);
      PlanePt1:=VecScale(Dist,MakeVect(normal));
      with PQ3Plane(Plane2)^ do
      begin
        PlaneNorm2:=MakeVect(normal);
        if (1-Abs(Dot(PlaneNorm1,PlaneNorm2)))/Deg2Rad<Close then
        begin
          PlanePt2:=VecScale(Dist,MakeVect(normal));
          if VecLength(VecDiff(PlanePt1, PlanePt2))<1.0 then
          begin
            Result:=true;
          end;
        end
      end;
    end;
  end;
end;

 {------------------------}

constructor QBspFileHandler.Create(nBsp: QBsp);
begin
 FBSP:=nBsp;
end;

class function QBspFileHandler.BspType : Char;
begin
  Result:=BspType(CurrentGameMode);
end;

class function QBspFileHandler.BspType(mj : TGameCode) : Char;
begin
  if (mj>='1') and (mj<='9') then
  begin
    if mj=mjGenesis3D then
      Result:=bspTypeG3D
    else if mj=mjHexen2 then
      Result:=bspTypeH2
    else
      Result:=bspTypeQ1;
  end
  else if (mj>='A') and (mj<='Y') then
  begin
    if mj=mjSin then
      Result:=bspTypeSin
    else if mj=mjSOF then
      Result:=bspTypeSOF
    else
      Result:=bspTypeQ2;
  end
  else if (mj>'a') and (mj<='z') then
  begin
    if mj=mjHL2 then
      Result:=bspTypeHL2
    else
      Result:=bspTypeQ3;
  end
  else //FIXME: actually deal with the 'any' codes
    Raise InternalE('Unhandled BSP type!');
end;

 {------------------------}

class function QBsp.TypeInfo;
begin
 Result:='.bsp';
end;

function QBsp.OpenWindow(nOwner: TComponent) : TQForm1;
begin
 if nOwner=Application then
  Result:=NewPyForm(Self)
 else
  Result:=TFQBsp.Create(nOwner);
end;

procedure QBsp.ObjectState(var E: TEtatObjet);
begin
 inherited;
 E.IndexImage:=iiBsp;
 E.MarsColor:=clGray;
end;

class procedure QBsp.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5134);
{Info.FileExtCount:=1;}
 Info.FileExt{[0]}:=779;
{Info.DefaultExt[0]:='bsp';}
 Info.WndInfo:=[wiOwnExplorer, wiWindow];
 Info.PythonMacro:='displaybsp';
end;

function QBsp.IsExplorerItem(Q: QObject) : TIsExplorerItem;
var
 S: String;
begin
  S:=Q.Name+Q.TypeInfo;
  Result:=ieResult[
    { any ".bsp1" to ".bsp9" }
       (SameText(Copy(S, Length(S)-4, 4), '.bsp' ) and CharInSet(S[Length(S)], ['1'..'9']))
    { or any ".bsp10" to ".bsp15" }
    or (SameText(Copy(S, Length(S)-5, 5), '.bsp1') and CharInSet(S[Length(S)], ['0'..'5']))
    { or ".bspsin" }
    or SameText(Copy(S, Length(S)-6, 7), '.bspsin')
    { or ".bspg3d" }
    or SameText(Copy(S, Length(S)-6, 7), '.bspg3d')
  ];
end;

function QBsp.GetBspEntry(const EntryIndex: Integer) : QFileObject;
var
 Q: QObject;
 S: String;
begin
  if (EntryIndex<0) then
   begin
    Result:=Nil;
    Exit;
   end;

  Acces;
  S := FFileHandler.GetEntryName(EntryIndex);
  Q := SubElements.FindName(S);
  if (Q=Nil) or not (Q is QFileObject) then
    Raise EError(5521);

  Result := QFileObject(Q);
end;

function QBsp.GetBspEntryData(const EntryIndex: Integer) : String; //FIXME: Switch to bytes!
const
 DataSpec = 'Data';
var
 Q: QObject;
begin
 Q:=BspEntry[EntryIndex];
 if Q = nil then
 begin
   Log(LOG_WARNING, LoadStr1(5903), [EntryIndex]);
   Result:='';
   Exit;
 end;
 Q.Acces;
 Result:=Q.Specifics.Bytes[DataSpec];
end;

function QBsp.GetAltTextureSrc : QObject;
var
 EntryIndex: Integer;
begin
 EntryIndex := FFileHandler.GetLumpTextures();
 if (EntryIndex<0) then
  Result := Nil
 else
  Result := BspEntry[EntryIndex];
end;

 {----------------------}

function QBsp.DetermineGameCodeForBsp1() : char;
{ (Comment by Decker 2001-01-21)
 After load of a cSignatureBspQ1H2 file, this function must be called to determine what
 game-mode the .BSP file are for; Quake-1 or Hexen-2.
}
var
 B: String; //FIXME: Switch to bytes!
 FaceCount, Taille1: Integer;
 ModeQ1, ModeH2: Boolean;
begin
  { determine map game : Quake 1 or Hexen II }
  FFlags := FFlags and not ofNotLoadedToMemory;  { to prevent infinite loop on "Acces" }

  B := GetBspEntryData(FFileHandler.GetLumpFaces());
  FaceCount := Length(B) div SizeOf(TQ1Surface);

  B := GetBspEntryData(FFileHandler.GetLumpModels());
  Taille1 := Length(B);

  ModeQ1 := CheckQ1Hulls(PHullQ1(PArithByte(B)), Taille1, FaceCount);
  ModeH2 := CheckH2Hulls(PHullH2(PArithByte(B)), Taille1, FaceCount);

  if ModeQ1 and ModeH2 then
    case MessageDlg(FmtLoadStr1(5573, [LoadName]), mtConfirmation, mbYesNoCancel, 0) of
      mrYes: ModeQ1 := False;
      mrNo: ModeH2 := False;
      mrCancel: Abort;
    end;

  if ModeQ1 then
    Result := mjQuake
  else
    if ModeH2 then
      Result := mjHexen2
    else
      Raise EErrorFmt(5509, [84]);
end;

function DetermineIfSin(F: TStream; FSize: TStreamPos) : Boolean;
type
 TBspEntries = record
               EntryPosition: LongInt;
               EntrySize: LongInt;
              end;
var
 Origine: TStreamPos;
 LumpHeader: TBspEntries;
 LumpAt168: Boolean;
 I: Integer;
begin
  //Determine if this is a Sin map. //FIXME: Untested if this method doesn't false-positive!

  //If you dump Sin's qbsp3 strings, you'll find the lump-names. From this reverse engineering,
  //it seems that Sin BSP files have a different number of lumps (20), and this is indeed confirmed by the tool source code.

  //So we're going to try to figure out if this is indeed the number of lumps present. If not, it can't be a Sin map.

  //If there no enough space for the right number of lumps, this cannot be a Sin BSP file.
  if FSize < (20 * SizeOf(LumpHeader)) + (2 * SizeOf(LongInt)) then
  begin
    Result:=False;
    Exit;
  end;

  //Save the current stream offset, so we can restore it later.
  Origine:=F.Position;
  try
    //Jump the signature and version.
    F.Seek(2*SizeOf(LongInt), soCurrent);

    //Note: We assume there's no padding between the header and the first lump.
    LumpAt168:=False; //The Sin BSP header ends at Byte 168, so that's where we expect the first lump.
    for I:=0 to 19 do
    begin
      F.ReadBuffer(LumpHeader, SizeOf(LumpHeader));
      if LumpHeader.EntrySize = 0 then
      begin
        //This lump is empty; skip it.
        Continue;
      end;
      if LumpHeader.EntryPosition < 168 then
      begin
        //This lump would start inside the Sin BSP file header! In other words, this cannot be a valid Sin BSP file.
        Result:=False;
        Exit;
      end
      else if LumpHeader.EntryPosition > FSize then
      begin
        //This lump would be positioned beyond the end of the file! In other words, this cannot be a valid Sin BSP file.
        Result:=False;
        Exit;
      end
      else if LumpHeader.EntryPosition = 168 then
        LumpAt168:=True;
    end;
    if not LumpAt168 then
    begin
      //Didn't find a lump at 168. This could indicate padding, but let's be safe and not assume it's a Sin BSP file...
      Result:=False;
    end
    else
    begin
      //This most likely is a Sin BSP file. It would be rare to find a Q3 BSP file with 8 bytes padding between the header and the first lump.
      Result:=True;
    end;
  finally
    //Restore the old stream position.
    F.Position:=Origine;
  end;
end;

procedure QBsp.LoadFile(F: TStream; StreamSize: TStreamPos);
{ (Comment by Decker 2001-01-21)
 Loads 4 bytes of signature, and 4 bytes of version, to determine what type of
 .BSP file it is. Then calls a specialized function to load the actual .BSP file-data
}
var
 Signature: LongInt;
 Version: LongInt;
begin
  case ReadFormat of
    rf_Default: { as stand-alone file }
    begin
      if StreamSize < SizeOf(Signature)+SizeOf(Version) then
        Raise EError(5519);

      F.ReadBuffer(Signature, SizeOf(Signature));
      F.ReadBuffer(Version, SizeOf(Version));
      F.Seek(-(SizeOf(Signature)+SizeOf(Version)), soCurrent);

      case Signature of
        cSignatureBspQ1H2: { Quake 1 or Hexen 2 }
        begin
          ObjectGameCode := mjQuake; //Will check for Hexen 2 after loading
          FFileHandler:=QBsp1FileHandler.Create(Self);
          FFileHandler.LoadBsp(F, StreamSize);
          ObjectGameCode := DetermineGameCodeForBsp1();
        end;

        cSignatureBspHL: { Half-Life }
        begin
          ObjectGameCode := mjHalfLife;
          FFileHandler:=QBsp1FileHandler.Create(Self);
          FFileHandler.LoadBsp(F, StreamSize);
        end;

        cSignatureBspID: { id Software BSP format }
        begin
          case Version of
            cVersionBspQ2: { Quake 2 }
            begin
              if QBspFileHandler.BspType(CurrentGameMode)<>bspTypeQ2 then
                ChangeGameMode(mjQuake2,true);
              ObjectGameCode := CurrentQuake2Mode;
              FFileHandler:=QBsp2FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
            end;

            cVersionBspDK: { Daikatana }
            begin
(*
              ObjectGameCode := mjDaikatana;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Daikatana']);
            end;

            cVersionKMQuake2: { KMQuake 2 }
            begin
(*
              ObjectGameCode := mjKMQuake2;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'KMQuake 2']);
            end;

            cVersionBspQ3: { Quake 3 or Soldier of Fortune }
            begin
              { Somebody should be shot; SOF has the same Sig/Vers as Q3 (!!) }
              if CurrentGameMode=mjSOF then
              begin
                ObjectGameCode := mjSOF;
                FFileHandler:=QBsp2FileHandler.Create(Self);
                FFileHandler.LoadBsp(F, StreamSize);
              end
              else
              begin
                if (CurrentGameMode <> mjQ3A) and (CurrentGameMode <> mjSTVEF) and (CurrentGameMode <> mjNexuiz) then
                  ObjectGameCode := mjQ3A
                else
                  ObjectGameCode := CurrentGameMode;
                FFileHandler:=QBsp3FileHandler.Create(Self);
                FFileHandler.LoadBsp(F, StreamSize);
              end;
            end;

            cVersionBspQL: { Quake Live or Return to Castle Wolfenstein or Return To Castle Wolfenstein - Enemy Territory }
            begin

              ObjectGameCode := mjRTCW; //mjRTCWET //mjQL
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);

              //Raise EErrorFmt(5602, [LoadName, 'Return to Castle Wolfenstein']);
            end;

            cVersionBspIG: { Iron Grip: Warlord }
            begin
(*
              ObjectGameCode := ...;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Iron Grip: Warlord']);
            end;

            cVersionBspCoD1: { Call of Duty 1 }
            begin
(*
              ObjectGameCode := mjCoD;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Call of Duty 1']);
            end;

            cVersionBspQuetoo: { Quetoo }
            begin
(*
              ObjectGameCode := ...;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Quetoo']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'id Software', Version]);
          end;
        end;

        cSignatureBspRaven:
        begin
          case Version of
            cVersionBspSin: { SiN } (*or cVersionBspJK2:*) { Jedi Knight II or Soldier of Fortune 2 or Jedi Academy }
            begin
              if DetermineIfSin(F, StreamSize) then
              begin
                ObjectGameCode := mjSin;
                FFileHandler:=QBspSinFileHandler.Create(Self);
                FFileHandler.LoadBsp(F, StreamSize);
              end
              else
              begin
                if (CurrentGameMode <> mjJK2) and (CurrentGameMode <> mjJA) and (CurrentGameMode <> mjSoF2) then
                  ObjectGameCode := mjJK2
                else
                  ObjectGameCode := CurrentGameMode;
                FFileHandler:=QBsp3FileHandler.Create(Self); {Decker - try using the Q3 .BSP loader}
                FFileHandler.LoadBsp(F, StreamSize);
              end;
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'Raven Software', Version]);
          end;
        end;

        cSignatureBspRespawn:
        begin
          case Version of
            cVersionBspTitanfall: { Titanfall }
            begin
(* Non functional
              ObjectGameCode := ...;
              FFileHandler:=QBsp3FileHandler.Create(Self); {Decker - try using the Q3 .BSP loader}
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Titanfall']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'Respawn Entertainment', Version]);
            end;
        end;

        cSignatureBsp2015:
        begin
          case Version of
            cVersionBspMOHAA: { Moh:aa }
            begin
(* Non functional
              ObjectGameCode := mjMohaa;
              FFileHandler:=QBsp3FileHandler.Create(Self); {Decker - try using the Q3 .BSP loader}
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Medal of Honor: Allied Assault']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, '2015', Version]);
            end;
        end;

        cSignatureBspEALA:
        begin
          case Version of
            cVersionBspMOHAAXP: { Moh:aa:s or Moh:aa:bt }
            begin
(* Non functional
              ObjectGameCode := mjMohaa;
              FFileHandler:=QBsp3FileHandler.Create(Self); {Decker - try using the Q3 .BSP loader}
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Medal of Honor: Allied Assault: Breakthrough/Medal of Honor: Allied Assault: Spearhead']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'EALA', Version]);
            end;
        end;

        cSignatureBspFAKK:
        begin
          case Version of
            cVersionBspFAKK: { Heavy Metal: FAKK2 }
            begin
(* Currently not supported
              ObjectGameCode := mjFAKK2;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Heavy Metal: FAKK2']);
            end;

            cVersionBspAlice: { American McGee's Alice }
            begin
(* Currently not supported
              ObjectGameCode := mjAlice;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'American McGee''s Alice']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'FAKK', Version]);
            end;
        end;

        cSignatureBspQFusion:
        begin
          case Version of
            cVersionBspWarsow: { Warsow }
            begin
(* Currently not supported
              ObjectGameCode := mjWarsow;
              FFileHandler:=QBsp3FileHandler.Create(Self);
              FFileHandler.LoadBsp(F, StreamSize);
*)
              Raise EErrorFmt(5602, [LoadName, 'Warsow']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'QFusion', Version]);
          end;
        end;

        cSignatureBspValve: { Valve BSP format }
        begin
          case Version of
            cVersionBspHL2: { Half-Life 2 }
            begin
(*              ObjectGameCode := mjHL2;*)
              Raise EErrorFmt(5602, [LoadName, 'Half-Life 2']);
            end;

            cVersionBspHL2HDR: { Half-Life 2 with HDR lighting }
            begin
(*              ObjectGameCode := mjHL2;*)
              Raise EErrorFmt(5602, [LoadName, 'Half-Life 2 HDR']);
            end;

            cVersionBspHL2V21: { Half-Life 2 with various changes }
            begin
(*              ObjectGameCode := mjHL2;*)
              Raise EErrorFmt(5602, [LoadName, 'Half-Life 2 V21']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'Valve', Version]);
          end;
        end;

        cSignatureBspEF2: { Star Trek: Elite Force 2 }
        begin
          case Version of
            cVersionBspEF2: { Star Trek: Elite Force 2 }
            begin
              Raise EErrorFmt(5602, [LoadName, 'Star Trek: Elite Force 2']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'EF2', Version]);
          end;
        end;

        cSignatureBspOther: { Other BSP format }
        begin
          case Version of
            cVersionBspOverDose: { OverDose }
            begin
              Raise EErrorFmt(5602, [LoadName, 'OverDose']);
            end;

            else {version unknown}
              Raise EErrorFmt(5572, [LoadName, 'generic', Version]);
          end;
        end;

        0: { Genesis3D, hopefully }
        begin
          ObjectGameCode := mjGenesis3D;
          FFileHandler:=QBspG3DFileHandler.Create(Self);
          FFileHandler.LoadBsp(F, StreamSize);
        end;

        else {signature unknown}
          Raise EErrorFmt(5520, [LoadName, Signature]);
      end;

      case FFileHandler.BspType(NeedObjectGameCode) of
      bspTypeQ1, bspTypeH2:
        begin
          NodeSize:=SizeOf(TQ1Node);
          LeafSize:=SizeOf(TQ1Leaf);
          FSurfaceSize:=SizeOf(TQ1Surface);
          FPlaneSize:=SizeOf(TQ1Plane);
        end;
      bspTypeQ2:
        begin
          NodeSize:=SizeOf(TQ2Node);
          LeafSize:=SizeOf(TQ2Leaf);
          FSurfaceSize:=SizeOf(TQ2Surface);
          FPlaneSize:=SizeOf(TQ1Plane); //Quake 2 plane = Quake 1 plane
        end;
      bspTypeSin:
        begin
          NodeSize:=SizeOf(TQ2Node); //Sin node = Quake 2 node
          LeafSize:=SizeOf(TQ2Leaf); //Sin leaf = Quake 2 leaf
          FSurfaceSize:=SizeOf(TSinSurface);
          FPlaneSize:=SizeOf(TQ1Plane); //Sin plane = Quake 2 plane = Quake 1 plane
        end;
      bspTypeSOF:
        begin
          NodeSize:=SizeOf(TQ2Node); //SOF node = Quake 2 node
          LeafSize:=SizeOf(TSOFLeaf);
          FSurfaceSize:=SizeOf(TSOFSurface);
          FPlaneSize:=SizeOf(TQ1Plane); //SOF plane = Quake 2 plane = Quake 1 plane
        end;
      bspTypeQ3:
        begin
          NodeSize:=SizeOf(TQ3Node);
          LeafSize:=SizeOf(TQ3Leaf);
          FSurfaceSize:=Sizeof(TQ3Surface);
          FPlaneSize:=SizeOf(TQ3Plane);
        end;
      //bspTypeHL2:
      //bspTypeG3D:
      else
        begin
          //Don't try to load these... It won't work!
          NodeSize:=0;
          LeafSize:=0;
          FSurfaceSize:=0;
          FPlaneSize:=0;
        end;
      end;
    end;
  else
    inherited;
  end;
end;

procedure QBsp.SaveFile(Info: TInfoEnreg1);
begin
  case Info.Format of
    rf_Default: { as stand-alone file }
    begin
      FFileHandler.SaveBsp(Info);
    end
  else
    inherited;
  end;
end;

destructor QBsp.Destroy;
begin
  CloseStructure;
  if FFileHandler<> nil then
  begin
    FFileHandler.Free;
    FFileHandler:=nil;
  end;
  inherited;
end;

procedure QBsp.CloseStructure;
begin
 if FStructure<>Nil then
  begin
   SetPoolObj('', @FStructure.PythonObj);
   FStructure.AddRef(-1);
   FStructure:=Nil;
  end;
 VerticesAddRef(-1);
end;

procedure QBsp.VerticesAddRef(Delta: Integer);
var
  B: String; //FIXME: Switch to bytes!
  PQ1: PQ1Vertex;
  PQ3: PQ3Vertex;
  I : Integer;
  Dest: PVect;
  BSPType: Char;
begin
  Inc(FVerticesRefCount, Delta);
  if FVerticesRefCount<=0 then
    ReallocMem(FVertices, 0)
  else
  begin
    if FVertices=nil then
    begin
      BSPType:=FFileHandler.BSPType(NeedObjectGameCode);
      ProgressIndicatorStart(0,0);
      try
        if (BSPType=bspTypeQ1) or (BSPType=bspTypeH2) or (BSPType=bspTypeQ2) or (BSPType=bspTypeSin) or (BSPType=bspTypeSOF) then
        begin
          B:=GetBspEntryData(FFileHandler.GetLumpVertexes());
          FVertexCount:=Length(B) div SizeOf(TQ1Vertex);
        end
        else
        begin
          B:=GetBspEntryData(FFileHandler.GetLumpVertexes());
          FVertexCount:=Length(B) div SizeOf(TQ3Vertex);
        end;
        GetMem(FVertices, VertexCount*SizeOf(TVect));
        try
          Dest:=PVect(FVertices);

          if (BSPType=bspTypeQ1) or (BSPType=bspTypeH2) or (BSPType=bspTypeQ2) or (BSPType=bspTypeSin) or (BSPType=bspTypeSOF) then
          begin
            PQ1:=PQ1Vertex(PArithByte(B));
            for I:=1 to VertexCount do
            begin
              with Dest^ do
              begin
                X:=PQ1^[0];
                Y:=PQ1^[1];
                Z:=PQ1^[2];
              end;
              Inc(PQ1);
              Inc(Dest);
            end;
          end
          else
          begin
            PQ3:=PQ3Vertex(PArithByte(B));
            for I:=1 to VertexCount do
            begin
              with Dest^ do
              begin
                X:=PQ3^.Position[0];
                Y:=PQ3^.Position[1];
                Z:=PQ3^.Position[2];
              end;
              Inc(PQ3);
              Inc(Dest);
            end;
          end;
        except
          FreeMem(FVertices);
          FVertices:=nil;
          raise;
        end;
      finally
        ProgressIndicatorStop;
      end;
    end;
  end;
end;

function QBsp.GetStructure;
var
  Q: QObject;
begin
  if FStructure=Nil then
  begin
    VerticesAddRef(+1);
    try
      FStructure:=TTreeMapBrush.Create('', Self);
      FStructure.AddRef(+1);
      try
        Q:=BspEntry[FFileHandler.GetLumpEntities()];
        Q.Acces;
        NonFaces:=0;
        ReadEntityList(FStructure, Q.Specifics.Strings['Data'], Self);
        if NonFaces>0 then
          ShowMessage(FmtLoadStr1(5792, [NonFaces]));
      except
        FStructure.AddRef(-1);
        FStructure:=nil;
        raise;
      end;
    except
      VerticesAddRef(-1);
      raise;
    end;
  end;
  Result:=FStructure;
end;

//This function gets called if the editor containing this BSP file closes. Update the BSP lump with the modified data.
procedure QBsp.ReLoadStructure;
var
 Dest: TStringList;
 Q: QObject;
 S: String;
 MapSaveSettings: TMapSaveSettings;
begin
 if FStructure<>Nil then
  begin
   FStructure.LoadAll;
   MapSaveSettings:=GetDefaultMapSaveSettings;
   MapSaveSettings.GameCode:=NeedObjectGameCode;
   Dest:=TStringList.Create;
   try
    SaveAsMapText(FStructure, MapSaveSettings, Nil, Dest, soBSP, Nil);
    S:=Dest.Text;
   finally
    Dest.Free;
   end;
   Q:=BspEntry[FFileHandler.GetLumpEntities()];
   Q.Acces;
   Action(Q, TSpecificUndo.Create(LoadStr1(614), 'Data', S, sp_Auto, Q));
  end;
end;

function QBsp.CreateHull(Index: Integer; nParent: QObject; const Origin: TVect): QObject;
begin
  try
    Result:=TBSPHull.Create(Self, Index, nParent, Origin);
  except
    on E: Exception do
    begin
      Result:=nil;
      GlobalWarning(FmtLoadStr1(5634, [Index, GetExceptionMessage(E)]));
    end;
  end;
end;

procedure QBsp.Go1(maplist, extracted: PyObject; var FirstMap: String; var QCList: TQList);
var
 mapname: PyObject;
 S: String;
begin
 Acces;
 S:=Specifics.Strings['FileName'];
 if S='' then
  S:=Name;
 CleanupFileName(S);
 if S='' then
  S:=LoadStr1(180);
 if FirstMap='' then
  FirstMap:=S;
 S:=ConcatPaths([GameMapPath, S+TypeInfo]);
 SaveInFile(rf_Default, OutputFile(S));
 mapname:=PyString_FromString(ToPyChar(S));
 try
   PyList_Append(extracted, mapname);
 finally
   Py_DECREF(mapname);
 end;
end;

 {------------------------}

function qReloadStructure(self, args: PyObject) : PyObject; cdecl;
begin
 Result:=Nil;
 try
  with QkObjFromPyObj(self) as QBsp do
   ReLoadStructure;
  Result:=PyNoResult;
 except
  Py_XDECREF(Result);
  EBackToPython;
  Result:=Nil;
 end;
end;

function qCloseStructure(self, args: PyObject) : PyObject; cdecl;
begin
 Result:=Nil;
 try
  with QkObjFromPyObj(self) as QBsp do
   CloseStructure;
  Result:=PyNoResult;
 except
  Py_XDECREF(Result);
  EBackToPython;
  Result:=Nil;
 end;
end;

function qGetClosePlanes(self, args: PyObject) : PyObject; cdecl;
var
  Close: Single;
  I, J, PlaneInc, HalfPlaneCount, PlaneCount: Integer;
  Planes: String; //FIXME: Switch to bytes!
  Planes2, Planes3: PArithByte;
  BSPType: Char;
  o: PyObject;
begin
  Result:=Nil;
  try
    if PyArg_ParseTupleX(args, 'f', [@Close])=0 then
      Exit;
    with QkObjFromPyObj(self) as QBsp do
    begin
      Planes:=GetBspEntryData(FFileHandler.GetLumpPlanes());
      PlaneCount:=Length(Planes) div PlaneSize;

      Result:=PyList_New(0);
      HalfPlaneCount:=(PlaneCount-1) div 2;
      BSPType:=FFileHandler.BSPType(NeedObjectGameCode);
      PlaneInc:=2*PlaneSize;
      Planes2:=PArithByte(Planes);
      for I:=0 to HalfPlaneCount do
      begin
        Planes3 := Planes2+PlaneInc;
        for J:=I+1 to HalfPlaneCount do
        begin
          if PlanesClose(Planes2, Planes3, BSPType, Close) then
          begin
            o:=PyInt_FromLong(I*2);
            try
              PyList_Append(Result, o);
            finally
              Py_DECREF(o);
            end;
            Break;
          end;
          Inc(Planes3, PlaneInc);
        end;
        Inc(Planes2, PlaneInc);
      end;
    end;
  except
    Py_XDECREF(Result);
    EBackToPython;
    Result:=Nil;
  end;
end;


const
 BspMethodTable: array[0..2] of TyMethodDef =
  ((ml_name: 'reloadstructure';  ml_meth: qReloadStructure;  ml_flags: METH_VARARGS),
   (ml_name: 'closestructure';   ml_meth: qCloseStructure;   ml_flags: METH_VARARGS),
   (ml_name: 'closeplanes';      ml_meth: qGetClosePlanes;   ml_flags: METH_VARARGS));

function QBsp.PyGetAttr(attr: PyChar) : PyObject;
var
 I: Integer;
 L: TQlist;
 Planes: String; //FIXME: Switch to bytes!
 Planes2: PArithByte;
 PlaneCount: Integer;
 Q: QObject;
begin
 Result:=inherited PyGetAttr(attr);
 if Result<>Nil then Exit;
 for I:=Low(BspMethodTable) to High(BspMethodTable) do
  if StrComp(attr, BspMethodTable[I].ml_name) = 0 then
   begin
    Result:=PyCFunction_New(BspMethodTable[I], @PythonObj);
    Exit;
   end;
 case attr[0] of
  'n': if StrComp(attr, 'nodes') = 0 then
       begin
         Result:=GetPyObj(GetNodes);
         Exit;
       end;
  'p': if StrComp(attr, 'planes') = 0 then
       begin
         Planes:=GetBspEntryData(FileHandler.GetLumpPlanes());
         PlaneCount:=Length(Planes) div PlaneSize;

         L:=TQList.Create;
         try;
           Planes2:=PArithByte(Planes);
           for I:=0 to PlaneCount-1 do
           begin
             //If the plane is created with Self as parent, it can't be stuck into a subitems list by Python code
             Q:=TTreeBspPlane.Create('plane '+IntToStr(I), Nil, PQ1Plane(Planes2), I);
             L.Add(Q);
             Inc(Planes2, PlaneSize);
           end;
           Result:=QListToPyList(L);
         finally
           L.Free;
         end;
         Exit;
       end;
  't': if StrComp(attr, 'texsource') = 0 then
        begin
         Result:=GetPyObj(GetAltTextureSrc);
         Exit;
        end;
  's': if StrComp(attr, 'structure') = 0 then
        begin
         Result:=GetPyObj(Structure);
         Exit;
        end;
 end;
end;

 {------------------------}

procedure TFQBsp.wmInternalMessage(var Msg: TMessage);
begin
 case Msg.wParam of
  wp_AfficherObjet:
    FileObject.ChangeToObjectGameMode;
 end;
 inherited;
end;

function TFQBsp.AssignObject(const Q: QFileObject; State: TFileObjectWndState) : Boolean;
begin
 Result:=(Q is QBsp) and inherited AssignObject(Q, State);
end;

function TFQBsp.GetConfigStr;
begin
 Result:='BSP';
end;

procedure TFQBsp.Button1Click(Sender: TObject);
begin
 with ValidParentForm(Self) as TQkForm do
  ProcessEditMsg(edOpen);
end;

(*
convert this:

{
"worldtype" "2"
"sounds" "6"
"classname" "worldspawn"
"wad" "gfx/base.wad"
"message" "the Slipgate Complex"
}
{
"classname" "info_player_start"
"origin" "480 -352 88"
"angle" "90"
}

into a stringlist for each entity (entity = { ... } )
*)
Function EntityTextToStringList(const S0: String): TStringList;
var
  S, Spec, Arg: String;
  I: Integer;
  Es, E1: TStringList;

  function GetClassname(const S: TStringList): string;
  begin
    result:=S.Values['classname'];
  end;

  procedure CreateFullEntity(const S: TStringList);
  var
    E: TStringList;
    cn: String;
    z: integer;
  begin
    cn:=GetClassname(S);
    E:=nil;
    for z:=0 to Result.count-1 do
      if Result.Strings[z]=cn then
        E:=TStringList(Result.Objects[z]);
    if E=nil then
    begin
      E:=TStringList.Create;
      Result.AddObject(cn, E);
    end;
    for z:=0 to S.count-1 do
    begin
      if E.IndexOfName(S.names[z]) = -1 then
        E.Add(S.Strings[z]);
    end;
  end;
begin
  E1:=nil;
  Result:=TStringList.Create;
  for i:=1 to length(S0) do
    if (S0[i]<>#13) and (S0[i]<>#10) then
      S:=S+S0[i];
  i:=1;
  Es:=TStringlist.Create;
  try
    while i<length(S)+1 do
    begin
      case s[i] of
        '{': E1:=TStringlist.Create;
        '"': begin
          Spec:='';
          Arg:='';
          while true do
          begin
            inc(i);
            if s[i] = '"' then
              break;
            Spec:=Spec+s[i];
          end;
          while s[i]='"' do
            inc(i);
          inc(i);
          while s[i]='"' do
            inc(i);
          while true do
          begin
            if s[i] = '"' then
              break;
            arg:=arg+s[i];
            inc(i);
          end;
          E1.Add(Spec+'='+Arg);
        end;
        '}': Es.AddObject('', E1);
      end;
      inc(i);
    end;
    for i:=Es.Count-1 downto 0 do
    begin
      CreateFullEntity(TStringList(Es.Objects[i]));
      TStringList(Es.Objects[i]).Free;
      Es.Delete(i);
    end;
  finally
    Es.Free;
  end;
end;

Function GetBaseDir(const F: String; inPak: Boolean): String;
var
  i: Integer;
  slashCount, wSlashCount: Integer;
begin
  if not inPak then
    wSlashCount:=3
  else
    wSlashCount:=2;
  if F='' then
  begin
    result:=GetGameDir;
    exit;
  end;
  I:=Length(F)+1;
  SlashCount:=0;
  While SlashCount<wSlashCount do
  begin
    Dec(I);
    if IsPathDelimiter(F, I) then
    begin
      Inc(SlashCount);
    end;
  end;
  Result:=Copy(F, I+1, length(F)-I+1);
  I:=Pos(PathDelim, Result);
  Result:=Copy(Result, 1, I-1);
end;

function ByName(Item1, Item2: Pointer) : Integer;
var
 Q1: QObject absolute Item1;
 Q2: QObject absolute Item2;
begin
 if Q1 is QTextureList then
  if Q2 is QTextureList then
   Result:=CompareText(Q1.Name, Q2.Name)
  else
   Result:=-1
 else
  if Q2 is QTextureList then
   Result:=1
  else
   begin
    Result:=CompareText(Q1.Name, Q2.Name);
    if Result=0 then
     Result:=CompareText(Q1.TypeInfo, Q2.TypeInfo);
   end;
end;

procedure SortTexFolder(TexFolder: QObject);
var
 Q: QObject;
 I: Integer;
begin
 TexFolder.SubElements.Sort(ByName);
 for I:=0 to TexFolder.SubElements.Count-1 do
  begin
   Q:=TexFolder.SubElements[I];
   if not (Q is QTextureList) then Break;
   SortTexFolder(Q);
  end;
end;

Function QBsp.GetEntityLump: String;
var
  e: QObject;
  S: String;
  I: Integer;
begin
  Acces;
  e:=GetBspEntry(FFileHandler.GetLumpEntities());
  if e=nil then
    raise Exception.Create(LoadStr1(5791));
  e.acces;
  S:=e.Specifics.Strings['Data'];
  for I:=Length(S) downto 1 do
  begin
     if S[I]='}' then
        Break;
     S[I]:=' ';
  end;
  Result:=S;
end;

Function StringListFromEntityLump(const e_lump: String; ExistingAddons: QFileObject; var Found: TStringList): Integer;
var
  S: String;
  specList: TStringList;
  e_sl, f_sl: TStringList;
  i,J,k: Integer;
  Addons: QFileObject;
  bFound: Boolean;
begin
  S:=e_lump;
  (*
    Convert Entities in bsp to stringlists & remove "worldspawn" and "light" and
    pre-existing entities now.
  *)
  result:=0;
  specList:=EntityTextToStringList(S);
  Addons:=ExistingAddons;
  for i:=specList.count-1 downto 0 do
  begin
    e_sl:=TStringList(SpecList.Objects[i]);
    if (lowercase(e_sl.Values['classname']) = 'worldspawn') or
       (lowercase(e_sl.Values['classname']) = 'light') or
       (Addons.FindSubObject(e_sl.Values['classname'], QObject, QObject)<>nil) then
    begin
      specList.Delete(i);
      continue;
    end;
    if found.count=0 then
    begin
      found.addobject(e_sl.Values['classname'], e_sl);
      continue;
    end;
    bFound:=false;
    for j:=0 to found.count-1 do
    begin
      f_sl:=TStringList(found.objects[j]);
      if (lowercase(f_sl.Values['classname']) = lowercase(e_sl.Values['classname'])) then
      begin
        bFound:=true;
        for k:=0 to e_sl.count-1 do
        begin
          if f_sl.indexofname(e_sl.Names[k])=-1 then
          begin
            f_sl.add(e_sl.strings[k]);
          end;
        end;
      end
    end;
    if not bFound then
    begin
      found.addobject(e_sl.Values['classname'], e_sl);
      inc(result);
    end;
  end;
end;

function QBsp.GetNodes : QObject;
var
  Stats: TNodeStats;
  FirstNode: String; //FIXME: Switch to bytes!
begin
  FirstNode:=GetBspEntryData(FFileHandler.GetLumpNodes());
  Result:=GetBspNode(PArithByte(FirstNode), 'Root Node', Nil, Stats);
end;

function QBsp.GetBspNode(Node: PArithByte; const Name: String; Parent: QObject; var Stats: TNodeStats) : TTreeBspNode;
var
  TreePlane: TTreeBspPlane;
  FirstStats, SecStats: TNodeStats; { stats from children }
  NodeWrapper: BspNode;
  FirstNode, FirstLeaf: String; //FIXME: Switch to bytes!

  procedure AddChild(Parent: TTreeBspNode; child: Integer; const Name: String; var Stats: TNodeStats);
  var
    TreeNode: TTreeBspNode;
    PLeaf: PArithByte;
  begin
    if child>0 then
      TreeNode:=GetBspNode(PArithByte(FirstNode) + child*NodeSize, Name, Parent, Stats)
    else
    begin
      { add 1, so that first child index is 0 (Max McQuires
        Q2 Bsp Format description on www.flipcode.com) }
      PLeaf:=PArithByte(FirstLeaf) - (child+1)*LeafSize;
      TreeNode:=TTreeBspNode.Create(Name, Parent, BspLeaf.Create(PLeaf, NeedObjectGameCode), Stats);
      TreeNode.Source:=PLeaf;
    end;
    if Copy(Name,1,5)='First' then
      TreeNode.Specifics.Strings['first']:='1';
    Parent.SubElements.Add(TreeNode);
    TreeNode.Bsp:=Self;
  end;

begin
  FirstNode:=GetBspEntryData(FFileHandler.GetLumpNodes());
  FirstLeaf:=GetBspEntryData(FFileHandler.GetLumpLeafs());

  NodeWrapper:=BspNode.Create(Node, NeedObjectGameCode);
  Result:=TTreeBspNode.Create(Name, Parent, NodeWrapper, Stats);
  with NodeWrapper do
  begin
    TreePlane:=TTreeBspPlane.Create('Plane '+IntToStr(plane), Result, PQ1Plane(Planes+plane*Planesize), plane); //PQ3Plane???
    Result.SubElements.Add(TreePlane);
    Result.Plane:=TreePlane;
    AddChild(Result, firstchild, 'First', FirstStats);
    AddChild(Result, secondchild, 'Second', SecStats);
    with Stats do
    begin
      children:=FirstStats.children+SecStats.children;
      Result.Specifics.Integers['children']:=children;
      empty:=FirstStats.empty+SecStats.empty;
      Result.Specifics.Integers['emptychildren']:=empty;
      if children=empty then
      begin
        Result.Specifics.Strings['empty']:='1';
        Result.Name:=FmtLoadStr1(5862, [Result.Name]);
      end;
    end;
  end;
end;

(*
Function QBsp.CreateStringListFromEntities(ExistingAddons: QFileObject; var Found: TStringList): Integer;
var
  e: QObject;
begin
  Acces;
  e:=GetBspEntry(FFileHandler.GetLumpEntities());
  if e=nil then
  begin
    raise Exception.Create('No Entities in BSP');
  end;
  e.acces;
end;
*)

Function QBsp.GetTextureFolder: QObject;
var
  e: QObject;
  i: Integer;
  TexFolder, TexFolder2: QObject;
  Link: QTextureLnk;
  Tex: QObject;
begin
  Acces;
  try
    e:=GetBspEntry(FFileHandler.GetLumpTextures());
  except
    e:=nil;
  end;

  TexFolder:=nil;
  if (e<>nil)and(ObjectGameCode <> mjHalfLife) then
  begin
    e.acces;
    TexFolder:=QToolboxGroup.Create('textures from '+GetFullName, nil);
    for i:=0 to e.subelements.count-1 do
    begin
      Tex:=e.subelements[i];
      TexFolder2:=TexFolder.FindSubObject(Tex.Name[1], QTextureList, nil);
      if TexFolder2=nil then
      begin
        TexFolder2:=QTextureList.Create(Tex.Name[1], TexFolder);
        TexFolder.Subelements.Add(TexFolder2);
      end;
      Link:=QTextureLnk.Create(Tex.name, TexFolder2);
      Link.Specifics.Strings['b']:=Name;
      if Parent=nil then
        Link.Specifics.Strings['s']:=GetBaseDir(Self.Filename, false)
      else
        Link.Specifics.Strings['s']:=GetBaseDir(QFileObject(Parent.Parent).Filename, true);  // in a pak file
      TexFolder2.Subelements.Add(Link);
    end;
    SortTexFolder(TexFolder);
  end;
  Result:=TexFolder;
end;

 {------------------------}

constructor TTreeBspPlane.Create(const nName: String; nParent: QObject; Source: PQ1Plane; Index: Integer);
begin
  inherited Create(nName, nParent);
  Dist:=Source^.dist;
  Normal:=MakeVect(Source^.normal);
  Number:=Index;
  with Source^ do
  begin
    VectSpec['norm']:=MakeVect(normal);
    SetFloatSpec('dist',dist);
    Self.Source:=PArithByte(Source);
  end;
end;

class function TTreeBspPlane.TypeInfo: String;
begin
 TypeInfo:=':bspplane';
end;

function TTreeBspPlane.GetNearPlanes(Close: Double; Bsp: QBsp): PyObject;
var
  I, PlaneInc, HalfPlaneCount, PlaneCount: Integer;
  Planes: String; //FIXME: Switch to bytes!
  Planes2: PArithByte;
  BSPType: Char;
  o: PyObject;
begin
  Result:=PyList_New(0);
  with Bsp do
  begin
    Planes:=GetBspEntryData(FFileHandler.GetLumpPlanes());
    PlaneCount:=Length(Planes) div PlaneSize;
    HalfPlaneCount:=(PlaneCount-1) div 2;
    BSPType:=FFileHandler.BSPType(NeedObjectGameCode);
    PlaneInc:=2*PlaneSize;
    Planes2:=PArithByte(Planes);
    for I:=0 to HalfPlaneCount do
    begin
      if PlanesClose(Source, Planes2, BSPType, Close) then
      begin
        o:=PyInt_FromLong(I*2);
        try
          PyList_Append(Result, o);
        finally
          Py_DECREF(o);
        end;
      end;
      Inc(Planes2, PlaneInc);
    end;
  end;
end;

function qGetNearPlanes(self, args: PyObject) : PyObject; cdecl;
var
 r: Single;
 bsp: PyObject;
begin
 Result:=Nil;
 try
   if PyArg_ParseTupleX(args, 'fO', [@r, @bsp])=0 then
     Exit;
   with QkObjFromPyObj(self) as TTreeBspPlane do
   begin
     Result:=GetNearPlanes(r,QBsp(QkObjFromPyObj(bsp)));
   end;
 except
  Py_XDECREF(Result);
  EBackToPython;
  Result:=Nil;
 end;
end;



const
 PlaneMethodTable: array[0..0] of TyMethodDef =
  ((ml_name: 'nearplanes';   ml_meth: qGetNearPlanes;   ml_flags: METH_VARARGS));

function TTreeBspPlane.PyGetAttr(attr: PyChar) : PyObject;
var
  I: Integer;
begin
  Result:=inherited PyGetAttr(attr);
  if Result<>Nil then Exit;
  for I:=Low(PlaneMethodTable) to High(PlaneMethodTable) do
    if StrComp(attr, PlaneMethodTable[I].ml_name) = 0 then
    begin
      Result:=PyCFunction_New(PlaneMethodTable[I], @PythonObj);
      Exit;
     end;

  case attr[0] of
   'd': if StrComp(attr, 'dist') = 0 then
       begin
         Result:=PyFloat_FromDouble(Dist);
         Exit;
       end;
  'n': if StrComp(attr, 'normal') = 0 then
       begin
         Result:=MakePyVect(Normal);
         Exit;
       end
       else if StrComp(attr, 'num') = 0 then
       begin
         Result:=PyInt_FromLong(Number);
         Exit;
       end;
  end;
end;

 {------------------------}

constructor BspNode.Create(SourcePtr: PArithByte; GameCode: Char);
var
  SourceQ1: TQ1Node;
  SourceQ2: TQ2Node;
  SourceQ3: TQ3Node;
  BSPType: Char;
  I: Integer;
begin
  Source:=SourcePtr;
  BSPType:=QBspFileHandler.BspType(GameCode);
  case BSPType of
   bspTypeQ1, bspTypeH2:
     begin
       SourceQ1:=PQ1Node(Source)^;
       Plane:=SourceQ1.Plane;
       FirstChild:=SourceQ1.FirstChild;
       SecondChild:=SourceQ1.SecondChild;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceQ1.mins[I];
         maxs[I]:=SourceQ1.maxs[I];
       end
     end;
   bspTypeQ2, bspTypeSin, bspTypeSOF:
     begin
       SourceQ2:=PQ2Node(Source)^;
       Plane:=SourceQ2.Plane;
       FirstChild:=SourceQ2.FirstChild;
       SecondChild:=SourceQ2.SecondChild;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceQ2.mins[I];
         maxs[I]:=SourceQ2.maxs[I];
       end
     end;
   bspTypeQ3:
     begin
       SourceQ3:=PQ3Node(Source)^;
       Plane:=SourceQ3.Plane;
       FirstChild:=SourceQ3.FirstChild;
       SecondChild:=SourceQ3.SecondChild;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceQ3.mins[I];
         maxs[I]:=SourceQ3.maxs[I];
       end
     end
   //bspTypeHL2:
   //bspTypeG3D:
  end;
end;

 {------------------------}

constructor BspLeaf.Create(SourcePtr: PArithByte; GameCode: Char);
var
  SourceQ1: TQ1Leaf;
  SourceQ2: TQ2Leaf;
  SourceSOF: TSOFLeaf;
  SourceQ3: TQ3Leaf;
  BSPType: Char;
  I: Integer;
begin
  Source:=SourcePtr;
  BSPType:=QBspFileHandler.BspType(GameCode);
  case BSPType of
   bspTypeQ1, bspTypeH2:
     begin
       SourceQ1:=PQ1Leaf(Source)^;
       num_leaffaces:=SourceQ1.num_marksurfaces;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceQ1.mins[I];
         maxs[I]:=SourceQ1.maxs[I];
       end
     end;
   bspTypeQ2, bspTypeSin:
     begin
       SourceQ2:=PQ2Leaf(Source)^;
       num_leaffaces:=SourceQ2.num_leaffaces;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceQ2.mins[I];
         maxs[I]:=SourceQ2.maxs[I];
       end
     end;
   bspTypeSOF:
     begin
       SourceSOF:=PSOFLeaf(Source)^;
       num_leaffaces:=SourceSOF.num_leaffaces;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceSOF.mins[I];
         maxs[I]:=SourceSOF.maxs[I];
       end
     end;
   bspTypeQ3:
     begin
       SourceQ3:=PQ3Leaf(Source)^;
       num_leaffaces:=SourceQ3.num_leaffaces;
       for I:=0 to 2 do
       begin
         mins[I]:=SourceQ3.mins[I];
         maxs[I]:=SourceQ3.maxs[I];
       end
     end;
   //bspTypeHL2:
   //bspTypeG3D:
  end
end;

 {------------------------}

constructor TTreeBspNode.Create(const nName: String; nParent: QObject; NodeSource: BspNode; var Stats: TNodeStats);
begin
  inherited Create(nName, nParent);
  Source:=NodeSource.Source;
  with NodeSource do
  begin
    VectSpec['mins']:=MakeVect(mins[0], mins[1], mins[2]);
    VectSpec['maxs']:=MakeVect(maxs[0], maxs[1], maxs[2]);
  end;
  Leaf:=false
end;

constructor TTreeBspNode.Create(const nName: String; nParent: QObject; Source: BspLeaf; var Stats: TNodeStats);
begin
  with Source do
  begin
    if num_leaffaces=0 then
      inherited Create(nName+' (empty leaf)', nParent)
    else
      inherited Create(nName+' (leaf)', nParent);
    VectSpec['mins']:=MakeVect(mins[0], mins[1], mins[2]);
    VectSpec['maxs']:=MakeVect(maxs[0], maxs[1], maxs[2]);
    Specifics.Strings['leaf']:='1';
    Specifics.Integers['num faces']:=num_leaffaces;
    Leaf:=true;
    with Stats do
    begin
      children:=1;
      if num_leaffaces=0 then
        empty:=1
      else
        empty:=0;
    end;
  end;
end;

class function TTreeBspNode.TypeInfo: String;
begin
 TypeInfo:=':bspnode';
end;

procedure TTreeBspNode.GetFaces(var L : PyObject);
var
  LFaceIndex: Integer;
  o: PyObject;
begin
  if Specifics.Strings['leaf']='' then
  begin
    ShowMessage('Faces only for leaves');
    Exit;
  end;
  case Bsp.FFileHandler.BSPType(Bsp.NeedObjectGameCode) of
  //bspTypeQ1, bspTypeH2:
  bspTypeQ2, bspTypeSin:
    with PQ2Leaf(Source)^ do
    begin
      for LFaceIndex:=first_leafface to first_leafface+num_leaffaces do
      begin
        o:=PyInt_FromLong(LFaceIndex);
        try
          PyList_Append(L, o);
        finally
          Py_XDECREF(o);
       end;
      end;
    end;
  bspTypeSOF:
    with PSOFLeaf(Source)^ do
    begin
      for LFaceIndex:=first_leafface to first_leafface+num_leaffaces do
      begin
        o:=PyInt_FromLong(LFaceIndex);
        try
          PyList_Append(L, o);
        finally
          Py_XDECREF(o);
       end;
      end;
    end;
  bspTypeQ3:
    with PQ3Leaf(Source)^ do
    begin
      for LFaceIndex:=first_leafface to first_leafface+num_leaffaces do
      begin
        o:=PyInt_FromLong(LFaceIndex);
        try
          PyList_Append(L, o);
        finally
          Py_XDECREF(o);
       end;
      end;
    end;
  //bspTypeHL2:
  //bspTypeG3D:
  end;
end;

function TTreeBspNode.PyGetAttr(attr: PyChar) : PyObject;
(*  No node methods yet, so we don' need this
var
  I: Integer;
  L: PyObject;
*)
begin
  Result:=inherited PyGetAttr(attr);
  if Result<>Nil then Exit;
{ No node methods yet, so we don' need this
  for I:=Low(NodeMethodTable) to High(NodeMethodTable) do
    if StrComp(attr, NodeMethodTable[I].ml_name) = 0 then
    begin
      Result:=PyCFunction_New(NodeMethodTable[I], @PythonObj);
      Exit;
     end;
}

  case attr[0] of
  'l': if StrComp(attr, 'leaf') = 0 then
       begin
         if Leaf then
            Result:=PyInt_FromLong(1)
         else
            Result:=PyInt_FromLong(0);
         Exit;
       end;
  'p': if StrComp(attr, 'plane') = 0 then
       begin
         Result:=GetPyObj(Plane);
         Exit;
       end;
  end;
end;


initialization
  RegisterQObject(QBsp, 's');

  RegisterQObject(TTreeBspPlane, 'a');
  RegisterQObject(TTreeBspNode, 'a');
end.
