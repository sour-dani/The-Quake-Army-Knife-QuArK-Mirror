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
unit QkWorldCraft;

interface

uses
  Windows, SysUtils, Classes, QkFileObjects, QkObjects, QkMap;

type
 QRmfMapFile = class(QMapFile)
        protected
          procedure LoadFile(F: TStream; FSize: TStreamPos); override;
          procedure SaveFile(Info: TInfoEnreg1); override;
        public
          class function TypeInfo: String; override;
          class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
        end;

implementation

uses qhelper, QuarkX, QkObjectClassList, QkExceptions, Logging, Setup,
  QkMapObjects, QkMapPoly, MapError, qmath {//FIXME};

type
  RMFVisGroup = packed record
    m_szName: packed array[0..127] of AnsiChar;
    m_rgbColor: packed array[0..3] of Byte;
    m_dwID: DWORD;
    m_bVisible: Bool;
  end;

  RMFTexture_21 = packed record
    texture: array[0..MAX_PATH-1] of AnsiChar;
    rotate: Single;
    shift: array[0..1] of Single;
    scale: array[0..1] of Single;
    smooth: Byte;
    material: Byte;
    PADDING: array[0..1] of Byte;
    q2surface: DWORD;
    q2contents: DWORD;
    q2value: DWORD;
  end;

  RMFTexture_33 = packed record
    texture: array[0..MAX_PATH-1] of AnsiChar;
    UAxis: array[0..3] of Single;
    VAxis: array[0..3] of Single;
    rotate: Single;
    scale: array[0..1] of Single;
    smooth: Byte;
    material: Byte;
    PADDING: array[0..1] of Byte;
    q2surface: DWORD;
    q2contents: DWORD;
    nLightmapScale: LongInt;
  end;

const
  RMFMaxVersion: Single = 3.7;
  RMFLastCompatVersion: Single = 0.3;
  RmfID: array[0..2] of AnsiChar = ('R', 'M', 'F');
  DocInfoSignature: array[0..7] of AnsiChar = ('D', 'O', 'C', 'I', 'N', 'F', 'O', #0);
  old_group_bytes: Integer = 134;

{------------------------}

class function QRmfMapFile.TypeInfo;
begin
 Result:='.rmf';
end;

class procedure QRmfMapFile.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
 inherited;
 Info.DescriptionText:=LoadStr1(5150);
 Info.FileExt:=827;
end;

procedure QRmfMapFile.LoadFile(F: TStream; FSize: TStreamPos);

  function ReadRMFString : AnsiString;
  var
    StringLength: Byte;
  begin
    F.ReadBuffer(StringLength, SizeOf(Byte));
    if StringLength >= 128 then
      Log(LOG_INFO, LoadStr1(5787));
    SetLength(Result, StringLength);
    if StringLength>0 then
    begin
      F.ReadBuffer(PAnsiChar(Result)^, StringLength);
      while Result[Length(Result)] = #0 do
      begin
        SetLength(Result, Length(Result)-1);
        if Length(Result) = 0 then
          Exit;
      end;
    end;
  end;

  function ReadRMFBoolean : Boolean;
  var
    RawValue: LongInt;
  begin
    F.ReadBuffer(RawValue, SizeOf(LongInt));
    Result:=(RawValue<>0);
  end;

var
 Racine: TTreeMapBrush;
 MapStructure : TTreeMapGroup;
 BrushNum, FaceNum: Integer;
 RMFVersion: Single;

 procedure LoadMapClass(var obj : TTreeMap); forward;
 procedure LoadEditGameClass(var obj : TTreeMap); forward;

 procedure LoadMapEntity(parent: TTreeMap);
 var
   Entite: TTreeMapSpec;
   Origin: packed array[0..2] of Single;
   OldPos: TStreamPos;
   IsBrush: Boolean;
   GroupID: DWORD;
   GroupColor: packed array[0..2] of Byte;
   NumberOfChildren: LongInt;
   Flags: WORD;
   GroupInformationSize: LongInt;
   Complex: LongInt;
 begin
   //Ugly hack; we need to know if there's children for this entity
   OldPos:=F.Position;
   if RMFVersion < 1.0 then
   begin
     F.ReadBuffer(GroupInformationSize, SizeOf(LongInt));
     F.Seek(GroupInformationSize, soCurrent); //Skipped
   end
   else
     F.ReadBuffer(GroupID, SizeOf(GroupID)); //Unused
   F.ReadBuffer(GroupColor, SizeOf(GroupColor));
   F.ReadBuffer(NumberOfChildren, SizeOf(LongInt));
   F.Seek(OldPos, soBeginning); //Rewind
   IsBrush:=(NumberOfChildren<>0);
   if IsBrush then
     Entite:=TTreeMapBrush.Create('CMapEntity', parent) //Temp name
   else
     Entite:=TTreeMapEntity.Create('CMapEntity', parent); //Temp name
   parent.SubElements.Add(Entite);

   LoadMapClass(TTreeMap(Entite));
   LoadEditGameClass(TTreeMap(Entite));

   F.ReadBuffer(Flags, SizeOf(WORD));
   F.ReadBuffer(Origin[0], SizeOf(Origin));
   if not IsBrush then
     TTreeMapEntity(Entite).Origin:=MakeVect(Origin[0], Origin[1], Origin[2]);

   if RMFVersion < 0.5 then
     Origin[2]:=-Origin[2];

   F.ReadBuffer(Complex, SizeOf(Integer)); //Unused
 end;

 procedure LoadMapGroup(parent: TTreeMap);
 var
   Entite: TTreeMapSpec;
 begin
   Entite:=TTreeMapGroup.Create('func_group', parent); //Slightly naughty hardcoded name
   parent.SubElements.Add(Entite);

   LoadMapClass(TTreeMap(Entite));
 end;

 procedure LoadMapHelper(parent: TTreeMap);
 begin
   //@
 end;

 procedure LoadMapDisp();
 begin
   //@
 end;

 procedure LoadMapFace(P: TPolyhedron);
 var
   OldTex: RMFTexture_21;
   OldTex33: RMFTexture_33;
   LoadPoints: array[0..255, 0..2] of Single;
   LoadPlanePoints: array[0..2, 0..2] of Single;
   i: Integer;
   Surface: TFace;
   Params: TFaceParams;
   UAxis, VAxis : TVect;
   UShift, VShift: Double;
   Light: Single;
   Size: LongInt;
   LoadHasMapDisp: LongInt;
   HasMapDisp: Boolean;
 begin
   Surface:=TFace.Create(LoadStr1(139), P);
   P.SubElements.Add(Surface);

   FillChar(OldTex, SizeOf(OldTex), 0);
   FillChar(OldTex33, SizeOf(OldTex33), 0);
   FillChar(LoadPoints, SizeOf(LoadPoints), 0);
   FillChar(LoadPlanePoints, SizeOf(LoadPlanePoints), 0);
   if RMFVersion < 0.9 then
   begin
     // Read the name
     F.ReadBuffer(OldTex.texture[0], 16);

     // Ensure name is ASCIIZ
     OldTex.texture[16]:=#0;

     // Read the rest - skip the name
     F.ReadBuffer(OldTex.rotate, SizeOf(OldTex.rotate));
     F.ReadBuffer(OldTex.shift, SizeOf(OldTex.shift));
     F.ReadBuffer(OldTex.scale, SizeOf(OldTex.scale));
   end
   else if RMFVersion < 1.2 then
   begin
     // Didn't have smooth/material groups
     F.ReadBuffer(OldTex.texture[0], 40);
     F.ReadBuffer(OldTex.rotate, SizeOf(OldTex.rotate));
     F.ReadBuffer(OldTex.shift, SizeOf(OldTex.shift));
     F.ReadBuffer(OldTex.scale, SizeOf(OldTex.scale));
   end
   else if RMFVersion < 1.7 then
   begin
     // No quake2 fields yet and smaller texture size.
     F.ReadBuffer(OldTex.texture[0], 40);
     F.ReadBuffer(OldTex.rotate, SizeOf(OldTex.rotate));
     F.ReadBuffer(OldTex.shift, SizeOf(OldTex.shift));
     F.ReadBuffer(OldTex.scale, SizeOf(OldTex.scale));
     F.ReadBuffer(OldTex.smooth, SizeOf(OldTex.smooth));
     F.ReadBuffer(OldTex.material, SizeOf(OldTex.material));
     F.ReadBuffer(OldTex.PADDING, SizeOf(OldTex.PADDING));
   end
   else if RMFVersion < 1.8 then
   begin
     // Texture name field changed from 40 to MAX_PATH in size.
     F.ReadBuffer(OldTex.texture[0], MAX_PATH);
     F.ReadBuffer(OldTex.rotate, SizeOf(OldTex.rotate));
     F.ReadBuffer(OldTex.shift, SizeOf(OldTex.shift));
     F.ReadBuffer(OldTex.scale, SizeOf(OldTex.scale));
     F.ReadBuffer(OldTex.smooth, SizeOf(OldTex.smooth));
     F.ReadBuffer(OldTex.material, SizeOf(OldTex.material));
     F.ReadBuffer(OldTex.PADDING, SizeOf(OldTex.PADDING));
   end
   else if RMFVersion < 2.2 then
   begin
     F.ReadBuffer(OldTex.texture[0], SizeOf(OldTex));
   end
   else
   begin
     //
     // After 3.3 the alignment of vec4_t's changed. We never save the new format,
     // since RMF is no longer being revved.
     //
     F.ReadBuffer(OldTex33.texture[0], SizeOf(OldTex33));
     //@
   end;

   if RMFVersion < 1.8 then
   begin
     OldTex.texture[40]:=#0;
   end;

   if RMFVersion < 0.6 then
   begin
     F.ReadBuffer(Light, SizeOf(Single));
     //@
   end;
   F.ReadBuffer(Size, SizeOf(LongInt));
   if Size>256 then
     Raise EErrorFmt(5779, [LoadStr1(5783)]);
   F.ReadBuffer(LoadPoints[0][0], Size * 3 * SizeOf(Single));

   // Negate Z for older RMF files.
   if RMFVersion < 0.5 then
     for i := 0 to Size-1 do
       LoadPoints[i][2]:=-LoadPoints[i][2];

   Surface.SetThreePoints(MakeVect(LoadPoints[0][0], LoadPoints[0][1], LoadPoints[0][2]), MakeVect(LoadPoints[2][0], LoadPoints[2][1], LoadPoints[2][2]), MakeVect(LoadPoints[1][0], LoadPoints[1][1], LoadPoints[1][2]));  //FIXME
   if not Surface.LoadData then
     raise InternalE('LoadData failure');   //FIXME: ERROR!

   // If reading from a pre-2.2 RMF file, copy the texture info from the old format.
   if RMFVersion < 2.2 then
   begin
     Surface.NomTex:=OldTex.texture;

      //FIXME: OldTex.smooth
      //FIXME: OldTex.material
     Surface.Specifics.Integers['Contents']:=OldTex.q2contents;
     Surface.Specifics.Integers['Flags']:=OldTex.q2surface;

     Params[1]:=OldTex.shift[0];
     Params[2]:=OldTex.shift[1];
     Params[3]:=OldTex.rotate;
     Params[4]:=OldTex.scale[0];
     Params[5]:=OldTex.scale[1];
     with Surface do
       SetFaceFromParams(Normale, Dist, Params);
   end
   else
   begin
     Surface.NomTex:=OldTex33.texture;

     //FIXME: OldTex33.smooth
     //FIXME: OldTex33.material
     Surface.Specifics.Integers['Contents']:=OldTex33.q2contents;
     Surface.Specifics.Integers['Flags']:=OldTex33.q2surface;
     //FIXME: OldTex33.nLightmapScale
     //FIXME if texture.nLightmapScale == 0 then Use Default Value from GameConfig

     UAxis.x := OldTex33.UAxis[0];
     UAxis.y := OldTex33.UAxis[1];
     UAxis.z := OldTex33.UAxis[2];
     UShift := OldTex33.UAxis[3];

     VAxis.x := OldTex33.VAxis[0];
     VAxis.y := OldTex33.VAxis[1];
     VAxis.z := OldTex33.VAxis[2];
     VShift := OldTex33.VAxis[3];

     Params[3]:=OldTex33.rotate;
     Params[4]:=OldTex33.scale[0];
     Params[5]:=OldTex33.scale[1];
     if not WC22Params(Surface, Params, UAxis, VAxis , UShift, VShift) then
       g_MapError.AddText(Format(LoadStr1(5816), [FaceNum, BrushNum]));
   end;

   if RMFVersion >= 0.7 then
   begin
     F.ReadBuffer(LoadPlanePoints[0][0], SizeOf(LoadPlanePoints));
     //@
   end;

   if (RMFVersion >= 3.4) and (RMFVersion <= 3.6) then
   begin
     if RMFVersion >= 3.5 then
     begin
       F.ReadBuffer(LoadHasMapDisp, SizeOf(LongInt));
       HasMapDisp:=(LoadHasMapDisp<>0);
     end
     else
       HasMapDisp:=ReadRMFBoolean();

     if HasMapDisp then
       LoadMapDisp();
   end;
   //@
 end;

 procedure LoadMapSolid(parent: TTreeMap);
 var
   i: Integer;
   P: TPolyhedron;
   NumberOfFaces: LongInt;
 begin
   P:=TPolyhedron.Create(LoadStr1(138), parent);
   parent.SubElements.Add(P);

   LoadMapClass(TTreeMap(P));
   FaceNum:=0;

   F.ReadBuffer(NumberOfFaces, SizeOf(LongInt));
   for i := 0 to NumberOfFaces-1 do
   begin
     LoadMapFace(P);
     FaceNum:=FaceNum+1;
   end;
   //@
 end;

 procedure LoadMapClass(var obj : TTreeMap);
 var
   i: Integer;
   obj2: TTreeMap;
   GroupInformationSize: LongInt;
   GroupID: DWORD;
   ObjectColor: array[0..2] of Byte;
   NumberOfChildren: LongInt;
   ChildName: AnsiString;
 begin
   BrushNum:=0;
   if RMFVersion < 1.0 then
   begin
     F.ReadBuffer(GroupInformationSize, SizeOf(LongInt));
     F.Seek(GroupInformationSize, soCurrent); //Skipped
   end
   else
   begin
     F.ReadBuffer(GroupID, SizeOf(DWORD));
     //@
   end;

   F.ReadBuffer(ObjectColor[0], SizeOf(ObjectColor));

   //We want to load all the geometry into a separate group
   if obj=Racine then
     obj2:=MapStructure
   else
     obj2:=obj;

   //Load children
   F.ReadBuffer(NumberOfChildren, SizeOf(LongInt));
   for i := 0 to NumberOfChildren-1 do
   begin
     ChildName:=ReadRMFString();
     if ChildName = 'CMapEntity' then
       LoadMapEntity(obj2)
     else if ChildName = 'CMapGroup' then
       LoadMapGroup(obj2)
     else if ChildName = 'CMapHelper' then //used?
       LoadMapHelper(obj2)
     else if ChildName = 'CMapSolid' then
     begin
       LoadMapSolid(obj2);
       BrushNum:=BrushNum+1;
     end
     else
       Raise EErrorFmt(5779, [FmtLoadStr1(5784, [ChildName])]);
   end;
 end;

 procedure LoadKeyValue(var obj : TTreeMap);
 var
   Key, Value: AnsiString;
 begin
   Key:=ReadRMFString();
   Value:=ReadRMFString();
   obj.Specifics.Strings[Key]:=Value;
 end;

 procedure LoadEditGameClass(var obj : TTreeMap);
 var
   ClassName: AnsiString;
   Angle, SpawnFlags: LongInt;
   NumberOfSpecifics: LongInt;
   I: Integer;
   HasTimeline: Boolean;
   TimelineStart, TimelineEnd: LongInt;
 begin
   ClassName:=ReadRMFString();
   if ClassName = '' then
     Log(LOG_INFO, 'RMF: Invalid EditGameClass name.'); //@
   obj.Name:=ClassName;

   F.ReadBuffer(Angle, SizeOf(LongInt));
   obj.Specifics.Strings['angle'] := IntToStr(Angle);

   F.ReadBuffer(SpawnFlags, SizeOf(LongInt));
   obj.Specifics.Strings['spawnflags'] := IntToStr(SpawnFlags);

   F.ReadBuffer(NumberOfSpecifics, SizeOf(LongInt));
   for I := 0 to NumberOfSpecifics-1 do
     LoadKeyValue(obj);

   if RMFVersion >= 1.5 then
   begin
     HasTimeline:=ReadRMFBoolean(); //Unused
     F.ReadBuffer(TimelineStart, SizeOf(LongInt)); //Unused
     F.ReadBuffer(TimelineEnd, SizeOf(LongInt)); //Unused
   end;
 end;

 procedure LoadMapPath(parent : TTreeMap);
 var
   Entite: TTreeMapSpec;
   PathName, PathClass: packed array[0..127] of AnsiChar;
   Direction, NumberOfNodes: LongInt;
   Position: array[0..2] of Single;
   ChildID: DWORD;
   NodeName: packed array[0..127] of AnsiChar;
   NodeSize: LongInt;
   I, J: Integer;
 begin
   Entite:=TTreeMapEntity.Create('CMapPath', parent); //Temp name
   parent.SubElements.Add(Entite);

   F.ReadBuffer(PathName, SizeOf(PathName)); //FIXME: Apply
   F.ReadBuffer(PathClass, SizeOf(PathClass)); //FIXME: Apply
   F.ReadBuffer(Direction, SizeOf(LongInt)); //FIXME: Apply

   F.ReadBuffer(NumberOfNodes, SizeOf(LongInt));
   for I := 0 to NumberOfNodes-1 do
   begin
     F.ReadBuffer(Position[0], SizeOf(Position)); //FIXME: Apply
     F.ReadBuffer(ChildID, SizeOf(DWORD)); //FIXME: Apply
     if RMFVersion >= 1.6 then
     begin
       F.ReadBuffer(NodeName, SizeOf(NodeName)); //FIXME: Apply
       F.ReadBuffer(NodeSize, SizeOf(LongInt)); //FIXME: Apply
       for J := 0 to NodeSize-1 do
         LoadKeyValue(TTreeMap(Entite)); //FIXME: Save on NODE
     end;
   end;
 end;

var
 ModeJeu: Char;
 RMFHeader: packed array[0..2] of AnsiChar;
 NumberOfVisGroups: LongInt;
 VisGroup: RMFVisGroup;
 ObjType: AnsiString;
 OldGroupSize, NumberOfPaths: LongInt;
 Position, Direction: array[0..2] of Single;
 DocInfo: packed array[0..7] of AnsiChar;
 CameraToolVersion: Single;
 NumberOfActiveCamera, NumberOfCamera: LongInt;
 I: Integer;
begin
 case ReadFormat of
  rf_Default: begin  { as stand-alone file }
      Racine:=TTreeMapBrush.Create('', Self);
      Racine.AddRef(+1);
      try
        if CurrentGameMode=mjCoF then
         ModeJeu:=mjCoF
        else if CurrentGameMode=mjSC then
         ModeJeu:=mjSC
        else
         ModeJeu:=mjHalfLife;
        g_MapError.Clear;

        MapStructure:=TTreeMapGroup.Create(LoadStr1(137), Racine);
        Racine.SubElements.Add(MapStructure);

        //LoadMapWorld:
        if FSize<SizeOf(RMFVersion) then
          Raise EError(5519);
        F.ReadBuffer(RMFVersion, SizeOf(RMFVersion));
        RMFVersion:=RMFVersion+0.001; //Using a floating points for version numbers is dumb due to floating point noise, so let's workaround that design flaw.
        if (RMFVersion < RMFLastCompatVersion) or (RMFVersion > RMFMaxVersion) then
          Raise EErrorFmt(5779, [LoadStr1(5780)]);
        if RMFVersion >= 0.8 then
        begin
          F.ReadBuffer(RMFHeader, SizeOf(RMFHeader));
          if not CompareMem(@RMFHeader, @RmfID, SizeOf(RmfID)) then
            Raise EErrorFmt(5779, [LoadStr1(5781)]);
        end;

        // load groups
        if RMFVersion >= 1.0 then
        begin
          F.ReadBuffer(NumberOfVisGroups, SizeOf(LongInt));
          for I := 0 to NumberOfVisGroups-1 do
            F.ReadBuffer(VisGroup, SizeOf(VisGroup)); //Skipped
        end;

        // make sure it's a CMapWorld
        ObjType:=ReadRMFString();
        if ObjType<>'CMapWorld' then
          Raise EErrorFmt(5779, [FmtLoadStr1(5782, [ObjType, 'CMapWorld'])]);
        Racine.Name:=ObjType;

        // load children & local data
        LoadMapClass(TTreeMap(Racine));

        // load ceditgameclass & CMapClass
        LoadEditGameClass(TTreeMap(Racine));

        if RMFVersion < 1.0 then
        begin
          F.ReadBuffer(OldGroupSize, SizeOf(LongInt));
          F.Seek(old_group_bytes * OldGroupSize, soCurrent); //Skipped
        end;

        // load paths
        if RMFVersion >= 1.1 then
        begin
          F.ReadBuffer(NumberOfPaths, SizeOf(LongInt));
          for i := 0 to NumberOfPaths-1 do
            LoadMapPath(TTreeMap(Racine)); //FIXME: Make a separate group!
        end;

        // read camera
        if (RMFVersion >= 1.0) and (RMFVersion < 1.4) then //FIXME: Not clear in what version of RMF camera's were first added; v0.9 doesn't have them.
        begin
          F.ReadBuffer(Position[0], 3*SizeOf(Single));
          F.ReadBuffer(Direction[0], 3*SizeOf(Single));
        end
        else if RMFVersion >= 1.4 then
        begin
          F.ReadBuffer(DocInfo, SizeOf(DocInfo));
          if not CompareMem(@DocInfo, @DocInfoSignature, SizeOf(DocInfoSignature)) then
            Raise EErrorFmt(5779, [FmtLoadStr1(5782, [DocInfo, 'DOCINFO'])]);

          F.ReadBuffer(CameraToolVersion, SizeOf(Single));
          CameraToolVersion:=CameraToolVersion+0.001;

          if CameraToolVersion>=0.2 then
            F.ReadBuffer(NumberOfActiveCamera, SizeOf(LongInt));

          F.ReadBuffer(NumberOfCamera, SizeOf(LongInt));
          for i := 0 to NumberOfCamera-1 do
          begin
            F.ReadBuffer(Position[0], 3*SizeOf(Single));
            F.ReadBuffer(Direction[0], 3*SizeOf(Single));
          end;
          //@ Do something with the camera's
        end;

        Racine.FixupAllReferences;

        SubElements.Add(Racine);
        Specifics.Strings['Root']:=Racine.Name+Racine.TypeInfo;
        ObjectGameCode:=ModeJeu;
      finally
        Racine.AddRef(-1);
      end;
     end;
 else
  inherited;
 end;
end;

procedure QRmfMapFile.SaveFile(Info: TInfoEnreg1);
begin
 with Info do case Format of
  rf_Default: begin  { as stand-alone file }
      raise EQObjectSavingNotSupported.Create('RMF files');
     end;
 else
  inherited;
 end;
end;

 {------------------------}

initialization
  RegisterQObject(QRmfMapFile, 'x');
end.

