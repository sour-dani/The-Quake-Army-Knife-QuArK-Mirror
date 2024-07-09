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
unit QkBspHulls;

interface

uses Windows, SysUtils, Classes, QkObjects, QkMapObjects, QkBsp,
     qmath, QkFileObjects, ExtraFunctionality;

const
  MAX_MAP_HULLS = 4; //8 FOR HEXEN2!!!
  MAXLIGHTMAPS = 4;

type
 TBoundBox = record
              Min, Max: vec3_t;
             end;

 PHullQ1 = ^THullQ1;
 THullQ1 = record
            Bound: TBoundBox;
            Origin: vec3_t;
            Node_id: array[0..MAX_MAP_HULLS-1] of Integer;
            NumLeafs, Face_id, Face_num: Integer;
           end;
 PHullH2 = ^THullH2;
 THullH2 = record
            Bound: TBoundBox;
            Origin: vec3_t;
            Node_id: array[0..8-1] of Integer; //@@@MAX_MAP_HULLS
            NumLeafs, Face_id, Face_num: Integer;
           end;
 PHullQ2 = ^THullQ2;
 THullQ2 = record
            Bound: TBoundBox;
            Origin: vec3_t;
            HeadNode, Face_id, Face_num: Integer;
           end;
 PHullQ3 = ^THullQ3;
 THullQ3 = record
            Bound: TBoundBox;
            Face_id, Face_num: Integer;
            Brush_id, Brush_num: Integer;
           end;

 PQ1Surface = ^TQ1Surface;
 TQ1Surface = record
               Plane_id, Side: SmallInt;
               LEdge_id: LongInt;
               LEdge_num, TexInfo_id: SmallInt;
               LightStyles: array[0..MAXLIGHTMAPS-1] of Byte;
               LightMapOffset: LongInt;
              end;

 PQ2Surface = ^TQ2Surface;
 TQ2Surface = record
               Plane_id: Word;
               Side: SmallInt;
               LEdge_id: LongInt;
               LEdge_num, TexInfo_id: SmallInt;
               LightStyles: array[0..MAXLIGHTMAPS-1] of Byte;
               LightMapOffset: LongInt;
              end;

 PSOFSurface = ^TSOFSurface;
 TSOFSurface = record
                Plane_id: Word;
                Side: SmallInt;
                LEdge_id: LongInt;
                LEdge_num, TexInfo_id: SmallInt;
                Region_id: SmallInt;
                RegionFace_id: Integer;
                RegionFace_num: SmallInt;
                LightStyles: array[0..MAXLIGHTMAPS-1] of Byte;
                LightMapOffset: LongInt;
                Lm_Size, Lm_Start : array[0..1] of Byte;
                Texturemins: array[0..1] of SmallInt;
                Extents: array[0..1] of SmallInt;
               end;

 PQ3Surface = ^TQ3Surface;
 TQ3Surface = record
               TexInfo_id: LongInt;
               Effect_id: LongInt;
               Face_Type: LongInt; { 0=bad, 1=planer (polygon), 2=patch, 3=mesh (triangle soup), 4=billboard (flare) }
               Vertex_id, Vertex_num, Meshvert_id, Meshvert_num: LongInt;
               Lightmap_id: LongInt;
               Lm_Start, Lm_Size: array[0..1] of LongInt;
               Lm_Origin: vec3_t;
               Lm_S, Lm_T: vec3_t; // for patches, these are lodbounds
               Normal: vec3_t;
               PatchDim: array[0..1] of LongInt;
              end;

 TLEdge = LongInt; //FIXME: Not LongWord?
 PLEdge = ^TLEdge;
 PEdge = ^TEdge;
 TEdge = record
          Vertex0, Vertex1: Word;
         end;
 PTexInfoVecs = ^TTexInfoVecs;
 TTexInfoVecs = array[0..1, 0..3] of Single;
 PTexInfo = ^TTexInfo;
 TTexInfo = record
             vecs: TTexInfoVecs;     // [s/t][xyz offset]
             miptex: LongInt;
             flags: LongInt;
            end;
 PTexInfoQ2 = ^TTexInfoQ2;
 TTexInfoQ2 = record
               vecs: TTexInfoVecs;             // [s/t][xyz offset]
               flags: LongInt;                 // miptex flags + overrides
               value: LongInt;                 // light emission, etc
               texture: array[0..31] of Byte;  // texture name (textures/*.wal)
               nexttexinfo: LongInt;           // for animations, -1 = end of chain
              end;

const
 MAX_QPATH = 64; //At least in Quake 2 & Quake 3
type
 PTexInfoQ3 = ^ TTexInfoQ3;
 TTexInfoQ3 = record
                texture: array[0..MAX_QPATH-1] of Byte;
                flags: LongInt;
                content: LongInt;
              end;

type
 TBSPHull = class(TTreeMapGroup)
            private
              FBsp: QBSP;
              HullNum, UsedVertex: Integer;
              NbFaces, FirstFace: Integer;
              SurfaceList: PArithByte;
            public
              constructor Create(nBsp: QBSP; Index: Integer; nParent: QObject; const Origin: TVect);
              destructor Destroy; override;
              class function TypeInfo: String; override;
              procedure ObjectState(var E: TEtatObjet); override;
              function IsExplorerItem(Q: QObject) : TIsExplorerItem; override;
              procedure Dessiner; override;
             {procedure AjouterRef(Liste: TList; Niveau: Integer) : Integer; override;}
            end;

 {------------------------}

function CheckQ1Hulls(Hulls: PHullQ1; Size, FaceCount: Integer) : Boolean;
function CheckH2Hulls(Hulls: PHullH2; Size, FaceCount: Integer) : Boolean;

 {------------------------}

implementation

uses qhelper, QkExceptions, QkMapPoly, Setup, qmatrices, QkWad, Quarkx, Coordinates, Qk3D,
     QkObjectClassList, Dialogs, Travail, Logging;

 {------------------------}

function CheckQ1Hulls(Hulls: PHullQ1; Size, FaceCount: Integer) : Boolean;
var
 P, Q: PHullQ1;
 I, J, HullCount: Integer;
begin
 Result:=False;
 HullCount:=Size div SizeOf(THullQ1);
 if HullCount*SizeOf(THullQ1)<>Size then Exit;
 P:=Hulls;
 for I:=1 to HullCount do
  begin
   with P^ do
    begin
     if (Face_id<0) or (Face_num<=0) or (Face_id>=FaceCount) or (Face_id+Face_num>FaceCount) then
      Exit;    { invalid Face_id and Face_num }
     Q:=Hulls;
     for J:=2 to I do
      begin
       if (Face_id+Face_num > Q^.Face_id) and (Face_id < Q^.Face_id+Q^.Face_num) then
        Exit;   { overlapping Face_id and Face_num }
       Inc(Q);
      end;
    end;
   Inc(P);
  end;
 Result:=True;
end;

function CheckH2Hulls(Hulls: PHullH2; Size, FaceCount: Integer) : Boolean;
var
 P, Q: PHullH2;
 I, J, HullCount: Integer;
begin
 Result:=False;
 HullCount:=Size div SizeOf(THullH2);
 if HullCount*SizeOf(THullH2)<>Size then Exit;
 P:=Hulls;
 for I:=1 to HullCount do
  begin
   with P^ do
    begin
     if (Face_id<0) or (Face_num<=0) or (Face_id>=FaceCount) or (Face_id+Face_num>FaceCount) then
      Exit;    { invalid Face_id and Face_num }
     Q:=Hulls;
     for J:=2 to I do
      begin
       if (Face_id+Face_num > Q^.Face_id) and (Face_id < Q^.Face_id+Q^.Face_num) then
        Exit;   { overlapping Face_id and Face_num }
       Inc(Q);
      end;
    end;
   Inc(P);
  end;
 Result:=True;
end;

 {------------------------}

constructor TBSPHull.Create(nBsp: QBSP; Index: Integer; nParent: QObject; const Origin: TVect);
var
 HullSize, TexInfoSize: Integer;
 HullOffset, FaceOffset: Integer;
 Models, Faces, LEdges, Edges, TexInfo, Planes, Q3Vertices: String; //FIXME: Switch to bytes!
 cLEdges, cEdges, cVertices, cTexInfo, cPlanes: Integer;
 S: String;
 Size1, I, J, NoVert, NoVert2, TexInfo_id: Integer;
 Vertices: PVertexList;
 Q1Faces: PQ1Surface;
 Q2Faces: PQ2Surface;
 SOFFaces: PSOFSurface;
 Q3Faces: PQ3Surface;
 Q3VertexP: PQ3Vertex;
 LEdge: PLEdge;
 NoEdge: LongInt;
 Face: TFace;
 Surface1: PSurface;
 Dest: ^PVertex;
 Dest2: PVertex;
 OriginCorrection: TList;
 BspVecs: PTexInfoVecs;
 InvFaces: Integer;
 LastError: String;
 P1, P2, P3, NN: TVect;
 P5_1, P5_2, P5_3: TVect5;
 PlaneDist: Double;
 texcoord: vec2_t;
 TextureList: QTextureList;
 HullType, BSPType: Char;
 miptex: boolean;
 Norm2: TVect;
 Facteur: Double;

 function AdjustTexScale(const V: TVect5) : TVect5;
 begin
   Result:=V;
  { Result.S:=Result.S; }
   Result.T:=-Result.T;
 end;

begin
  inherited Create(FmtLoadStr1(5406, [Index]), nParent);
  Log(LOG_INFO, LoadStr1(5466), [Index]);
  HullNum:=Index;

  InvFaces:=0;
  PlaneDist:=0; //Supress compiler warning

  FBsp:=nBsp;
  FBsp.AddRef(+1);
  //Note: No need for a try-except for cleanup here; the destructor takes care of this.

  HullType:=FBsp.FileHandler.GetHullType(FBsp.NeedObjectGameCode);
  BSPType:=FBsp.FileHandler.BSPType(FBsp.NeedObjectGameCode);
  case HullType of
   HullQ1: HullSize:=SizeOf(THullQ1);
   HullHx: HullSize:=SizeOf(THullH2);
   HullQ2: HullSize:=SizeOf(THullQ2);
   HullQ3: HullSize:=SizeOf(THullQ3);
  else Exit;
  end;
  miptex:=SetupSubSet(ssGames, GetGameName(FBsp.NeedObjectGameCode)).Specifics.Strings['UsesMipTex']<>'';

  Models:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpModels());
  HullOffset:=HullSize*Index;
  if Length(Models)<HullOffset+HullSize then
   Raise EErrorFmt(5635, [1]);
  case HullType of
   HullQ1: with PHullQ1(PArithByte(Models)+HullOffset)^ do
             begin
              NbFaces:=Face_num;
              FirstFace:=Face_id;
              TexInfoSize:=SizeOf(TTexInfo);
             end;
   HullHx: with PHullH2(PArithByte(Models)+HullOffset)^ do
             begin
              NbFaces:=Face_num;
              FirstFace:=Face_id;
              TexInfoSize:=SizeOf(TTexInfo);
             end;
   HullQ2: with PHullQ2(PArithByte(Models)+HullOffset)^ do
              begin
               NbFaces:=Face_num;
               FirstFace:=Face_id;
               TexInfoSize:=SizeOf(TTexInfoQ2);
              end;
   HullQ3: with PHullQ3(PArithByte(Models)+HullOffset)^ do
              begin
               NbFaces:=Face_num;
               FirstFace:=Face_id;
               TexInfoSize:=SizeOf(TTexInfoQ3);
              end;
   end;
  if not miptex then
   TextureList:=Nil
  else
   begin
    TextureList:=FBsp.BspEntry[FBsp.FileHandler.GetLumpTextures()] as QTextureList;
    TextureList.Acces;
   end;

  Faces:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpFaces());
  if Length(Faces) < (FirstFace+NbFaces)*FBsp.SurfaceSize then
    Raise EErrorFmt(5635, [2]); //FIXME: Check for out-of-bound everywhere!
  FaceOffset := Pred(FirstFace) * FBsp.SurfaceSize; //-1 because we start iterating with Inc-ing.

  if (BSPType=bspTypeQ1) or (BSPType=bspTypeQ2) or (BSPType=bspTypeSOF) then
  begin
    LEdges:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpSurfEdges());
    cLEdges:=Length(LEdges) div SizeOf(TLEdge);
    Log(LOG_INFO, LoadStr1(5468), [cLEdges]);

    Edges:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpEdges());
    cEdges:=Length(Edges) div SizeOf(TEdge);
    Log(LOG_INFO, LoadStr1(5469), [cEdges]);
  end
  else
  begin
    cLEdges:=0; //Supress compiler warning
    cEdges:=0; //Supress compiler warning
  end;

  TexInfo:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpTexInfo());
  cTexInfo:=Length(TexInfo) div TexInfoSize;
  Log(LOG_INFO, LoadStr1(5470), [cTexInfo]);

  Planes:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpPlanes());
  cPlanes := Length(Planes) div FBsp.PlaneSize;
  Log(LOG_INFO, LoadStr1(5471), [cPlanes]);

  //FBsp.FVertices, VertexCount are previously computed through FBsp.GetStructure
  Vertices:=FBsp.FVertices;
  cVertices:=FBsp.VertexCount;
  Log(LOG_INFO, LoadStr1(5472), [cVertices]);

  if BSPType=bspTypeQ3 then
    Q3Vertices:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpVertexes());

  Size1:=0;
  { for each face in the brush, reserve space for a Surface }
  if BSPType=bspTypeQ1 then
  begin
    Q1Faces:=PQ1Surface(PArithByte(Faces)+FaceOffset);
    for I:=1 to NbFaces do
    begin
      Inc(PArithByte(Q1Faces), FBsp.SurfaceSize);
      if Q1Faces^.ledge_id < 0 then
        Raise EErrorFmt(5635, [9]);
      if Q1Faces^.ledge_id + Q1Faces^.ledge_num > cLEdges then
        Raise EErrorFmt(5635, [3]);
      Inc(Size1, TailleBaseSurface+Q1Faces^.ledge_num*SizeOf(PVertex));
    end;
  end
  else if BSPType=bspTypeQ2 then
  begin
    Q2Faces:=PQ2Surface(PArithByte(Faces)+FaceOffset);
    for I:=1 to NbFaces do
    begin
      Inc(PArithByte(Q2Faces), FBsp.SurfaceSize);
      if Q2Faces^.ledge_id < 0 then
        Raise EErrorFmt(5635, [9]);
      if Q2Faces^.ledge_id + Q2Faces^.ledge_num > cLEdges then
        Raise EErrorFmt(5635, [3]);
      Inc(Size1, TailleBaseSurface+Q2Faces^.ledge_num*SizeOf(PVertex));
    end;
  end
  else if BSPType=bspTypeSOF then
  begin
    SOFFaces:=PSOFSurface(PArithByte(Faces)+FaceOffset);
    for I:=1 to NbFaces do
    begin
      Inc(PArithByte(SOFFaces), FBsp.SurfaceSize);
      if SOFFaces^.ledge_id < 0 then
        Raise EErrorFmt(5635, [9]);
      if SOFFaces^.ledge_id + SOFFaces^.ledge_num > cLEdges then
        Raise EErrorFmt(5635, [3]);
      Inc(Size1, TailleBaseSurface+SOFFaces^.ledge_num*SizeOf(PVertex));
    end;
  end
  else
  begin
    Q3Faces:=PQ3Surface(PArithByte(Faces)+FaceOffset);
    for I:=1 to NbFaces do
    begin
      Inc(PArithByte(Q3Faces), FBsp.SurfaceSize);
      if Q3Faces^.Face_Type=1 then
      begin
        if Q3Faces^.Vertex_num < 0 then
          Raise EErrorFmt(5635, [10]);
        {FIXME : check for face additions as above}
        Inc(Size1, TailleBaseSurface+Q3Faces^.Vertex_num*SizeOf(PVertex));
      end
      else
        Inc(FBsp.NonFaces);
        {FIXME: we'll be wanting to do something smarter with patches etc}
    end;
  end;
  GetMem(SurfaceList, Size1); //FIXME: Is this something like prvVertexTable???
  PArithByte(Surface1):=SurfaceList;

  SubElements.Capacity:=NbFaces;

  if BSPType=bspTypeQ1 then
    Q1Faces:=PQ1Surface(PArithByte(Faces)+FaceOffset)
  else if BSPType=bspTypeQ2 then
    Q2Faces:=PQ2Surface(PArithByte(Faces)+FaceOffset)
  else if BSPType=bspTypeSOF then
    SOFFaces:=PSOFSurface(PArithByte(Faces)+FaceOffset)
  else if BSPType=bspTypeQ3 then
    Q3Faces:=PQ3Surface(PArithByte(Faces)+FaceOffset);
  //bspTypeHL2
  //bspTypeG3D

  OriginCorrection:=TList.Create;
  ProgressIndicatorStart(5463, NbFaces); try
  for I:=1 to NbFaces do
   begin
    ProgressIndicatorIncrement;
    if BSPType=bspTypeQ1 then
    begin
      Inc(PArithByte(Q1Faces), FBsp.SurfaceSize);
      PArithByte(LEdge):=PArithByte(LEdges) + Q1Faces^.ledge_id * SizeOf(TLEdge);
    end
    else if BSPType=bspTypeQ2 then
    begin
      Inc(PArithByte(Q2Faces), FBsp.SurfaceSize);
      PArithByte(LEdge):=PArithByte(LEdges) + Q2Faces^.ledge_id * SizeOf(TLEdge);
    end
    else if BSPType=bspTypeSOF then
    begin
      Inc(PArithByte(SOFFaces), FBsp.SurfaceSize);
      PArithByte(LEdge):=PArithByte(LEdges) + SOFFaces^.ledge_id * SizeOf(TLEdge);
    end
    else if BSPType=bspTypeQ3 then
    begin
      Inc(PArithByte(Q3Faces), FBsp.SurfaceSize);
      if Q3Faces^.Face_Type<>1 then
        Continue;
    end;
    //bspTypeHL2
    //bspTypeG3D
    Surface1^.Source:=Self;
    Surface1^.NextF:=Nil;
    if BSPType=bspTypeQ1 then
    begin
      Surface1^.prvVertexCount:=Q1Faces^.ledge_num;
      if Q1Faces^.Plane_id >= cPlanes then
      begin
        Inc(InvFaces);
        LastError:='Err Plane_id';
        Continue;
      end;
      with PQ1Plane(PArithByte(Planes) + Q1Faces^.Plane_id * SizeOf(TQ1Plane))^ do
      begin
        NN.X:=normal[0];
        NN.Y:=normal[1];
        NN.Z:=normal[2];
        PlaneDist:=dist;
      end;
    end
    else if BSPType=bspTypeQ2 then
    begin
      Surface1^.prvVertexCount:=Q2Faces^.ledge_num;
      if Q2Faces^.Plane_id >= cPlanes then
      begin
        Inc(InvFaces);
        LastError:='Err Plane_id';
        Continue;
      end;
      with PQ1Plane(PArithByte(Planes) + Q2Faces^.Plane_id * SizeOf(TQ1Plane))^ do
      begin
        NN.X:=normal[0];
        NN.Y:=normal[1];
        NN.Z:=normal[2];
        PlaneDist:=dist;
      end;
    end
    else if BSPType=bspTypeSOF then
    begin
      Surface1^.prvVertexCount:=SOFFaces^.ledge_num;
      if SOFFaces^.Plane_id >= cPlanes then
      begin
        Inc(InvFaces);
        LastError:='Err Plane_id';
        Continue;
      end;
      with PQ1Plane(PArithByte(Planes) + SOFFaces^.Plane_id * SizeOf(TQ1Plane))^ do
      begin
        NN.X:=normal[0];
        NN.Y:=normal[1];
        NN.Z:=normal[2];
        PlaneDist:=dist;
      end;
    end
    else
    begin
      with Q3Faces^ do
      begin
        Surface1^.prvVertexCount:=Vertex_num;
        NN.X:=Normal[0];
        NN.Y:=Normal[1];
        NN.Z:=Normal[2];
        { fill in PlaneDist later }
      end
    end;

    PArithByte(Dest):=PArithByte(Surface1)+TailleBaseSurface;
    if (BSPType=bspTypeQ1) or (BSPType=bspTypeQ2) or (BSPType=bspTypeSOF) then
      for J:=1 to Surface1^.prvVertexCount do
      begin
        NoEdge:=LEdge^;
        Inc(PArithByte(LEdge), SizeOf(TLEdge));
        if NoEdge < 0 then
         begin
          if -NoEdge>=cEdges then
           Raise EErrorFmt(5635, [4]);
          with PEdge(PArithByte(Edges) - NoEdge * SizeOf(TEdge))^ do
           begin
            NoVert:=Vertex0;
            NoVert2:=Vertex1;
           end;
         end
        else
         begin
          if NoEdge>=cEdges then
           Raise EErrorFmt(5635, [5]);
          with PEdge(PArithByte(Edges) + NoEdge * SizeOf(TEdge))^ do
           begin
            NoVert:=Vertex1;
            NoVert2:=Vertex0;
           end;
         end;
        if NoVert2>=UsedVertex then
         UsedVertex:=NoVert2+1;
        if NoVert>=UsedVertex then
         UsedVertex:=NoVert+1;
        Dest^:=PVertex(PArithByte(Vertices) + NoVert * SizeOf(TVect));
        Inc(Dest);
      end
    else
      with Q3Faces^ do
      begin
       { the vertexes are stored in the vertex lump in consecutive
         order as they are used by each face.  Since we need a QuArK
         Vertex (Sommet) table like that constructed in FBsp.GetStructure,
         we use it for the vertexes, but use direct access to the bsp
         structure for the texture position information }
        for J:=0 to Vertex_num-1 do
        begin
          //FIXME: Handle meshverts!
          Dest^:=PVertex(PArithByte(Vertices) + (Vertex_id+J) * SizeOf(TVect));
          Q3VertexP:=PQ3Vertex(PArithByte(Q3Vertices)+(Vertex_id+J)*SizeOf(TQ3Vertex));
          //dist:=Q3VertexP^.Normal;
          if J=1 then
          begin
            P1:=MakeVect(vec3_p(Q3VertexP)^);
            PlaneDist:=Dot(NN,P1);
          end;
          Inc(Dest);
        end;
      end;
    if UsedVertex>cVertices then
      Raise EErrorFmt(5635, [6]);

     { load texture infos }
    if (BSPType=bspTypeQ1) or (BSPType=bspTypeQ2) or (BSPType=bspTypeSOF) then
    begin
      if BSPType=bspTypeQ1 then
        TexInfo_id:=Q1Faces^.TexInfo_id
      else if BSPType=bspTypeQ2 then
        TexInfo_id:=Q2Faces^.TexInfo_id
      else if BSPType=bspTypeSOF then
        TexInfo_id:=SOFFaces^.TexInfo_id
      else
        TexInfo_id:=0; //Supress compiler warning

      if TexInfo_id >= cTexInfo then
      begin
        Inc(InvFaces);
       {if TexInfo_id = MaxInt then
         LastError:='Err Point Off Plane'
        else}
         LastError:='Err TexInfo_id';
        Continue;
      end;

      if (BSPType=bspTypeQ2) or (BSPType=bspTypeSOF) then
        with PTexInfoQ2(PArithByte(TexInfo) + TexInfo_id * SizeOf(TTexInfoQ2))^ do
        begin
          S:=CharToPas(texture);
          BspVecs:=@vecs;
        end
      else
        with PTexInfo(PArithByte(TexInfo) + TexInfo_id * SizeOf(TTexInfo))^ do
        begin
          BspVecs:=@vecs;
          if miptex>=TextureList.SubElements.Count then
          begin
            Inc(InvFaces);
            LastError:=FmtLoadStr1(5639,[miptex]);
            Continue;
          end;
          S:=TextureList.SubElements[miptex].Name;
        end;

          (** Equations to solve :     with (s,s0)=vecs[0] and (t,t0)=vecs[1]

                s*P1 + s0 = 0       s*P2 + s0 = 128     s*P3 + s0 = 0
                t*P1 + t0 = 0       t*P2 + t0 = 0       t*P3 + t0 = -128

              with P1, P2, P3 in the plane PlaneInfo = (n,d).
              We must solve (s*p,t*p) = (s1,t1).

                s.x*p.x + s.y*p.y + s.z*p.z = s1
                t.x*p.x + t.y*p.y + t.z*p.z = t1
                n.x*p.x + n.y*p.y + n.z*p.z = d
          **)
      g_DrawInfo.Matrice[1,1]:=bspvecs^[0,0];
      g_DrawInfo.Matrice[1,2]:=bspvecs^[0,1];
      g_DrawInfo.Matrice[1,3]:=bspvecs^[0,2];
      g_DrawInfo.Matrice[2,1]:=bspvecs^[1,0];
      g_DrawInfo.Matrice[2,2]:=bspvecs^[1,1];
      g_DrawInfo.Matrice[2,3]:=bspvecs^[1,2];
      g_DrawInfo.Matrice[3,1]:=NN.X;
      g_DrawInfo.Matrice[3,2]:=NN.Y;
      g_DrawInfo.Matrice[3,3]:=NN.Z;
      g_DrawInfo.Matrice:=MatriceInverse(g_DrawInfo.Matrice);
      P1.X:=-bspvecs^[0,3];
      P1.Y:=-bspvecs^[1,3];
      P1.Z:=PlaneDist;
      TransformationLineaire(P1);
      P2.X:=EchelleTexture-bspvecs^[0,3];
      P2.Y:=-bspvecs^[1,3];
      P2.Z:=PlaneDist;
      TransformationLineaire(P2);
      P3.X:=-bspvecs^[0,3];
      P3.Y:=-EchelleTexture-bspvecs^[1,3];
      P3.Z:=PlaneDist;
      TransformationLineaire(P3);
    end
    else
    begin {Q3 texture info}
      if Q3Faces^.Vertex_num<3 then
        Raise EErrorFmt(5635, [7]);
      J:=1;
      while true do
      begin
        Q3VertexP:=PQ3Vertex(PArithByte(Q3Vertices) + (Q3Faces^.Vertex_id+J-1) * SizeOf(TQ3Vertex));
        if J=1 then
          { This trick works because the position and tex coords are the
            first 5 fields.  If we want to drag lightmaps into it we'll
            need to go to 7, or do something different }
          P5_1:=AdjustTexScale(MakeVect5(vec5_p(Q3VertexP)^))
        else if J=2 then
          P5_2:=AdjustTexScale(MakeVect5(vec5_p(Q3VertexP)^))
        else if J=3 then
          P5_3:=AdjustTexScale(MakeVect5(vec5_p(Q3VertexP)^))
        else
        begin
          // If this failed, the three vertices lay on a single line. Cycle through to find some that don't.
          P5_1:=P5_2;
          P5_2:=P5_3;
          P5_3:=AdjustTexScale(MakeVect5(vec5_p(Q3VertexP)^));
        end;
        if J>2 then
          // Try to convert them to etp 3points P1-P3
          if SolveForThreePoints(P5_1, P5_2, P5_3, P1, P2, P3) then
            break;
        J:=J+1;
        if J>Q3Faces^.Vertex_num then
          Raise EErrorFmt(5635, [8]);
      end;
      with PTexInfoQ3(PArithByte(TexInfo) + Q3Faces^.TexInfo_id * SizeOf(TTexInfoQ3))^ do
      begin
        S:=CharToPas(texture);
        { strip off leading texture/ }
        S:=Copy(S,10,Length(S)-9);
        { get flags & contents }
      end;
    end;

    Face:=TFace.Create(IntToStr(I), Self);
    SubElements.Add(Face);
    if (BSPType=bspTypeQ1) or (BSPType=bspTypeQ2) or (BSPType=bspTypeSOF) then
    begin
      if ((BSPType=bspTypeQ1) and (Q1Faces^.side<>0))
      or ((BSPType=bspTypeQ2) and (Q2Faces^.side<>0))
      or ((BSPType=bspTypeSOF) and (SOFFaces^.side<>0)) then
        with Face do
        begin
          Normale.X:=-NN.X;
          Normale.Y:=-NN.Y;
          Normale.Z:=-NN.Z;
          Dist:=-PlaneDist;
        end
      else
        with Face do
        begin
          Normale:=NN;
          Dist:=PlaneDist;
        end;
    end
    else
    begin
      with Face do
      begin
        Normale:=NN;
        //Dist:=PlaneDist;
      end;
    end;

    { BSP files use an 'origin' specific to offset BSPHulls }
    if (Origin.X<>OriginVectorZero.X) or (Origin.Y<>OriginVectorZero.Y) or (Origin.Z<>OriginVectorZero.Z) then
    begin
      Facteur:=Dot(Face.Normale, Origin);
      Norm2.X:=Origin.X - Face.Normale.X*Facteur;
      Norm2.Y:=Origin.Y - Face.Normale.Y*Facteur;    { Norm2 is Origin forced in the plane of the face }
      Norm2.Z:=Origin.Z - Face.Normale.Z*Facteur;
      P1:=VecSum(P1, Norm2);
      P2:=VecSum(P2, Norm2);
      P3:=VecSum(P3, Norm2);

      for J:=0 to Surface1^.prvVertexCount-1 do
      begin
        Dest2:=Surface1^.prvVertexTable[J];
        if OriginCorrection.IndexOf(Dest2)=-1 then
          OriginCorrection.Add(Dest2);
      end;
    end;

    { Some changes needed here if NuTex2 branch stuff used  }
    Norm2:=Cross(VecDiff(P2,P1), VecDiff(P3,P1));
    if VecLength(Norm2)> rien then
    begin
      Normalise(Norm2);
      if VecLength(VecDiff(Norm2, Face.Normale)) < rien then
        Face.SetThreePoints(P1, P2, P3)
      else
        Face.SetThreePoints(P1, P3, P2);
    end;
    if not Face.SetThreePointsEx(P1, P2, P3, Face.Normale) then
    begin
      SubElements.Remove(Face);
      Inc(InvFaces);
      LastError:='Err degenerate';
      Continue;
    end;
    Face.NomTex:=S;
    if BSPType=bspTypeQ3 then
      Face.SetThreePointsUserTex(P1,P2,P3,nil);
    Face.Specifics.Strings[CannotEditFaceYet]:='1';
    Surface1^.F:=Face;
    Face.LinkSurface(Surface1);
    PArithByte(Surface1):=PArithByte(Dest);
   end;

   for I:=0 to OriginCorrection.Count-1 do
    begin
     Dest2:=OriginCorrection[I];
     Dest2^.P:=VecSum(Dest2^.P, Origin);
    end;
  finally
   ProgressIndicatorStop;
   OriginCorrection.Free;
  end;

  if InvFaces>0 then
   GlobalWarning(FmtLoadStr1(5638, [Index, InvFaces, LastError]));
end;

procedure TBSPHull.Dessiner;   { optimized (the inherited version would also do the job) }
type
 PProjVertices = ^TProjVertices;
 TProjVertices = array[0..0] of TPointProj;
var
 I, J, EdgeNum: Integer;
 Faces, LEdges, Edges: String; //FIXME: Switch to bytes!
 Q1Faces: PQ1Surface;
 Q2Faces: PQ2Surface;
 Vertices, Limit: PArithByte;
 LEdge: PLEdge;
 NoEdge: LongInt;
 ProjVertices: PProjVertices;
{OutOfView: TBits;}
 OutOfViewChk: Boolean;
 Dest: PPointProj;
 Src: ^TVect;
 Sommets: array[0..1] of PVect;
 ProjSommets: array[0..1] of TPointProj;
{Pts: array[0..1] of TPoint;}
 OldPen, NewPen: HPen;
 PV0, PV1: PPointProj;
 BSPType: Char;
begin
 if (FBsp=Nil) or (SurfaceList=Nil) then Exit;

 BSPType:=FBsp.FileHandler.BSPType(FBsp.NeedObjectGameCode);
 case BSPType of
 bspTypeQ1:
   begin
     Faces:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpFaces());
     Q1Faces:=PQ1Surface(Faces);
     Inc(PArithByte(Q1Faces), FirstFace * SizeOf(TQ1Surface));
     LEdges:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpSurfEdges());
     Edges:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpEdges());
     FBsp.VerticesAddRef(+1);
     Vertices:=PArithByte(FBsp.FVertices);
   end;
 bspTypeQ2:
   begin
     Faces:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpFaces());
     Q2Faces:=PQ2Surface(Faces);
     Inc(PArithByte(Q2Faces), FirstFace * SizeOf(TQ2Surface));
     LEdges:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpSurfEdges());
     Edges:=FBsp.GetBspEntryData(FBsp.FileHandler.GetLumpEdges());
     FBsp.VerticesAddRef(+1);
     Vertices:=PArithByte(FBsp.FVertices);
   end;
 bspTypeSOF:
   begin
     // optimized versions don't work for SOF, even with correct surfacesize
     inherited;
     Exit;
   end;
 else
   begin
     // Whatever Happens to draw Q3A bsp's ...
     inherited;
     Exit;
   end;
 end;
 if g_DrawInfo.SelectedBrush<>0 then
  begin
   NewPen:=g_DrawInfo.SelectedBrush;
  {OldROP:=SetROP2(g_DrawInfo.DC, R2_CopyPen);}
  end
 else
  if HullNum=0 then
   NewPen:=CreatePen(ps_Solid, 0, MapColors(lcBSP))
  else
   NewPen:=GetStockObject(g_DrawInfo.BasePen);
 OldPen:=SelectObject(g_DrawInfo.DC, NewPen);
 SetROP2(g_DrawInfo.DC, R2_CopyPen);
 ProjVertices:=Nil;
{OutOfView:=Nil;}
 try
  if HullNum=0 then     { point projection optimization }
   begin
    J:=UsedVertex*SizeOf(TPointProj);
    GetMem(ProjVertices, J);
    PArithByte(Src):=Vertices;
    PArithByte(Dest):=PArithByte(ProjVertices);
    Limit:=PArithByte(Dest)+J;
    while PArithByte(Dest)<Limit do
     begin
      Dest^:=CCoord.Proj(Src^);
      CCoord.CheckVisible(Dest^);
      Inc(Dest);
      Inc(Src);
     end;
    OutOfViewChk:=(g_DrawInfo.ModeAff>0) and (g_DrawInfo.SelectedBrush=0);
  (*if (g_DrawInfo.ModeAff>0) and (g_DrawInfo.SelectedBrush=0) then
     begin
      OutOfView:=TBits.Create;
      OutOfView.Size:=UsedVertex;
      PArithByte(Dest):=PArithByte(ProjVertices);
      for I:=0 to UsedVertex-1 do
       begin
        if Dest^.OffScreen <> 0 then
         OutOfView.Bits[I]:=True;
        Inc(Dest);
       end;
     end;*)
    for I:=1 to NbFaces do   { fast version }
     begin
      EdgeNum:=0; //Supress compiler warning
      if BSPType=bspTypeQ1 then
      begin
        PArithByte(LEdge):=PArithByte(LEdges) + Q1Faces^.ledge_id * SizeOf(TLEdge);
        EdgeNum:=Q1Faces^.ledge_num;
      end
      else if BSPType=bspTypeQ2 then
      begin
        PArithByte(LEdge):=PArithByte(LEdges) + Q2Faces^.ledge_id * SizeOf(TLEdge);
        EdgeNum:=Q2Faces^.ledge_num;
      end
      (*else if BSPType=bspTypeSOF then
      begin
        PArithByte(LEdge):=PArithByte(LEdges) + SOFFaces^.ledge_id * SizeOf(TLEdge);
        EdgeNum:=SOFFaces^.ledge_num;
      end
      else if BSPType=bspTypeQ3 then
      begin
        PArithByte(LEdge):=PArithByte(LEdges) + Q3Faces^.ledge_id * SizeOf(TLEdge);
        EdgeNum:=Q3Faces^.ledge_num;
      end*);
      for J:=1 to EdgeNum do
       begin
        NoEdge:=LEdge^;
        Inc(PArithByte(LEdge), SizeOf(TLEdge));
        if NoEdge > 0 then  { only draws half the edges - the other ones are drawn in the other direction another time anyway }
         with PEdge(PArithByte(Edges) + NoEdge * SizeOf(TEdge))^ do
          begin
           PV0:=@ProjVertices^[Vertex0];
           PV1:=@ProjVertices^[Vertex1];
           if OutOfViewChk then
            begin
             if not ((PV0^.OffScreen<>0) and (PV1^.OffScreen<>0)) then
              begin
               if g_DrawInfo.ModeAff=1 then
                begin
                 SelectObject(g_DrawInfo.DC, NewPen);
                 SetROP2(g_DrawInfo.DC, R2_CopyPen);
                end;
              end
             else
              begin
               if g_DrawInfo.ModeAff=2 then
                Continue;
               SetROP2(g_DrawInfo.DC, g_DrawInfo.MaskR2);
               SelectObject(g_DrawInfo.DC, g_DrawInfo.GreyBrush);
              end;
            end;
           CCoord.Line95f(PV0^, PV1^);
          end;
       end;
       if BSPType=bspTypeQ1 then
         Inc(PArithByte(Q1Faces), SizeOf(TQ1Surface))
       else if BSPType=bspTypeQ2 then
         Inc(PArithByte(Q2Faces), SizeOf(TQ2Surface))
       (*else if BSPType=bspTypeSOF then
         Inc(PArithByte(SOFFaces), SizeOf(TSOFSurface))*);
     end
   end
  else
   for I:=1 to NbFaces do   { slow version }
    begin
     EdgeNum:=0; //Supress compiler warning
     if BSPType=bspTypeQ1 then
     begin
       PArithByte(LEdge):=PArithByte(LEdges) + Q1Faces^.ledge_id * SizeOf(TLEdge);
       EdgeNum:=Q1Faces^.ledge_num;
     end
     else if BSPType=bspTypeQ2 then
     begin
       PArithByte(LEdge):=PArithByte(LEdges) + Q2Faces^.ledge_id * SizeOf(TLEdge);
       EdgeNum:=Q2Faces^.ledge_num;
     end
     (*else if BSPType=bspTypeSOF then
     begin
       PArithByte(LEdge):=PArithByte(LEdges) + SOFFaces^.ledge_id * SizeOf(TLEdge);
       EdgeNum:=SOFFaces^.ledge_num;
     end
     else if BSPType=bspTypeQ3 then
     begin
       PArithByte(LEdge):=PArithByte(LEdges) + Q3Faces^.ledge_id * SizeOf(TLEdge);
       EdgeNum:=Q3Faces^.ledge_num;
     end*);
     for J:=1 to EdgeNum do
      begin
       NoEdge:=LEdge^;
       Inc(PArithByte(LEdge), SizeOf(TLEdge));
       if NoEdge > 0 then  { only draws half the edges - the other ones are drawn in the other direction another time anyway }
        with PEdge(PArithByte(Edges) + NoEdge * SizeOf(TEdge))^ do
         begin
          PArithByte(Sommets[0]):=Vertices + Vertex0 * SizeOf(TVect);
          PArithByte(Sommets[1]):=Vertices + Vertex1 * SizeOf(TVect);
          ProjSommets[0]:=CCoord.Proj(Sommets[0]^);
          ProjSommets[1]:=CCoord.Proj(Sommets[1]^);
          CCoord.CheckVisible(ProjSommets[0]);
          CCoord.CheckVisible(ProjSommets[1]);
          if (g_DrawInfo.ModeAff>0) and (g_DrawInfo.SelectedBrush=0) then
           begin
          (*ModeProj:=TModeProj(1-Ord(ModeProj));
            Pts[0]:=Proj(Sommets[0]^);
            Pts[1]:=Proj(Sommets[1]^);
            ModeProj:=TModeProj(1-Ord(ModeProj));
            if PtInRect(g_DrawInfo.VisibleRect, Pts[0])
            or PtInRect(g_DrawInfo.VisibleRect, Pts[1]) then*)
            if (ProjSommets[0].OffScreen=0)
            or (ProjSommets[1].OffScreen=0) then
             begin
              if g_DrawInfo.ModeAff=1 then
               begin
                SelectObject(g_DrawInfo.DC, NewPen);
                SetROP2(g_DrawInfo.DC, R2_CopyPen);
               end;
             end
            else
             begin
              if g_DrawInfo.ModeAff=2 then
               Continue;
              SetROP2(g_DrawInfo.DC, g_DrawInfo.MaskR2);
              SelectObject(g_DrawInfo.DC, g_DrawInfo.GreyBrush);
             end;
           end;
          CCoord.Line95f(ProjSommets[0], ProjSommets[1]);
         end;
      end;
      if BSPType=bspTypeQ1 then
        Inc(PArithByte(Q1Faces), SizeOf(TQ1Surface))
      else if BSPType=bspTypeQ2 then
        Inc(PArithByte(Q2Faces), SizeOf(TQ2Surface))
      (*else if BSPType=bspTypeSOF then
        Inc(PArithByte(SOFFaces), SizeOf(TSOFSurface))
      else if BSPType=bspTypeQ3 then
        Inc(PArithByte(Q3Faces), SizeOf(TQ3Surface))*);
    end;
 finally
 {OutOfView.Free;}
  FreeMem(ProjVertices);
  SelectObject(g_DrawInfo.DC, OldPen);
  if g_DrawInfo.SelectedBrush<>0 then
  {SetROP2(g_DrawInfo.DC, OldROP)}
  else
   DeleteObject(NewPen);
  FBsp.VerticesAddRef(-1);
 end;
end;

destructor TBSPHull.Destroy;
begin
 inherited;
 if FBsp<>Nil then
  FBsp.AddRef(-1);
 FreeMem(SurfaceList);
end;

class function TBSPHull.TypeInfo: String;
begin
 TypeInfo:=':bsphull';
end;

procedure TBSPHull.ObjectState;
begin
 inherited;
 E.IndexImage:=iiComponent;
end;

function TBSPHull.IsExplorerItem(Q: QObject) : TIsExplorerItem;
begin
 if Q is TFace then
  Result:=ieResult[True] + [ieInvisible]
 else
  Result:=[];
end;

(*function TBSPHull.AjouterRef(Liste: TList; Niveau: Integer) : Integer;
var
 ZMax1: LongInt;
 I: Integer;
 Vertices: PTableauPointsProj;
 S: PSurface;
begin
 if (FBsp<>Nil) and (SurfaceList<>Nil) then
  begin
   if HullNum=0 then
    begin
     GetMem(Vertices, Sommets.Count*SizeOf(TPointsProj)); try
     ZMax1:=-MaxInt;
     for I:=0 to Sommets.Count-1 do
      with Vertices^[I] do
       begin
        Src:=PVertex(Sommets[I]);
        Pt3D:=SceneCourante.Proj(Src^.P);
        if Pt3D.Z > ZMax1 then
         ZMax1:=Pt3D.Z;
      end;
     for I:=0 to Faces.Count-1 do
      begin
       S:=PSurface(Faces[I]);
       S^.F.AjouterSurfaceRef(Liste, S, Vertices, Sommets.Count, ZMax1, Odd(S^.F.SelMult));
        {g_DrawInfo.ColorTraits[esNormal]);}
      end;
     finally FreeMem(Vertices); end;
    end
   else
    inherited AjouterRef(Liste, -1);
   Result:=1;
  end
 else
  Result:=0;
end;*)

 {------------------------}

initialization
  RegisterQObject(TBSPHull, 'a');
end.
