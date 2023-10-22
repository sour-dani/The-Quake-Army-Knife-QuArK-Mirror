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
unit QkFrame;

interface

uses Windows, SysUtils, Classes, QkObjects, Qk3D, Python, QkMdlObject,
     QMath, QkModelBone, qmatrices;

type
  TBoneRec = packed record
    Bone: QModelBone;
    new_end_offset: vec3_t;
  end;
  PBoneRec = ^TBoneRec;
  QFrame = class(QMdlObject)
  private
    FInfo: PyObject;
    Component: QObject;
  public
    class function TypeInfo: String; override;
    function IsAllowedParent(nParent: QObject) : Boolean; override;
    destructor Destroy; override;
    procedure ObjectState(var E: TEtatObjet); override;
    function GetVertices(var P: vec3_p) : Integer;
    Procedure RemoveVertex(index: Integer);
    procedure ChercheExtremites(var Min, Max: TVect); override;
    function PyGetAttr(attr: PyChar) : PyObject; override;
    function PySetAttr(attr: PyChar; value: PyObject) : Boolean; override;
    property ParentComponent: QObject read Component write Component;
    function GetBoneMovement(var P: PBoneRec): Integer;
    procedure TranslateFrame(vec: vec3_t);
    procedure RotateFrame(matrice: TMatrixTransformation);
  end;

implementation

uses Quarkx, QkExceptions, PyObjects, QkObjectClassList, QkComponent, QkModelRoot,
     QkModelTag, QkFrameGroup, QkMiscGroup, QkTagFrame, PyMath, Logging;

function QFrame.IsAllowedParent(nParent: QObject) : Boolean;
begin
  if ParentComponent = Nil then
   if Self.Parent<>Nil then
    ParentComponent := Self.Parent.Parent;
  if (nParent=nil) or ((nParent is QFrameGroup) and (nParent.Parent = ParentComponent)) then
    Result:=true
  else
    Result:=false;
end;

procedure QFrame.RotateFrame(matrice: TMatrixTransformation);
const
  VertSpec = 'Vertices';
var
  p, p_org: vec3_p;
  s:String;
  j,c: integer;
  Dest: vec3_p;
begin
  c:=GetVertices(p_org);
  p:=p_org;
  SetLength(S, SizeOf(vec3_t)*c);
  PChar(Dest):=PChar(S);
  for j:=1 to c do
  begin
    Dest^:=MatrixMultByVect(matrice, p^);
    inc(p);
    inc(Dest);
  end;
  Specifics.Bytes[FloatSpecNameOf(VertSpec)]:=S;
end;

procedure QFrame.TranslateFrame(vec: vec3_t);
const
  VertSpec = 'Vertices';
var
  p_org: vec3_p;
  s:String;
  c: integer;
  Dest: vec3_p;
begin
  c:=GetVertices(p_org);
  SetLength(S, SizeOf(vec3_t)*c);
  PChar(Dest):=PChar(S);

  TranslateVecs(vec, Dest, C);

  Specifics.Bytes[FloatSpecNameOf(VertSpec)]:=S;
end;

destructor QFrame.Destroy;
begin
  Py_XDECREF(FInfo);
  inherited;
end;

class function QFrame.TypeInfo;
begin
  TypeInfo:=':mf';
end;

procedure QFrame.ObjectState(var E: TEtatObjet);
begin
  inherited;
  E.IndexImage:=iiFrame;
end;

function QFrame.GetBoneMovement(var P: PBoneRec): Integer; //FIXME: Don't return a pointer to a stack variable!
const
  BoneSpec = 'BoneMovement';
var
  s: String;
begin
  S:=Specifics.Bytes[BoneSpec]; //FIXME: FloatSpec?
  Result:=0;
  if S='' then
    Exit;
  Result:=Length(S) div SizeOf(TBoneRec);
  if Result<=0 then
  begin
    Result:=0;
    Exit;
  end;
  PChar(P):=PChar(S);
end;

function QFrame.GetVertices(var P: vec3_p) : Integer; //FIXME: Don't return a pointer to a stack variable!
const
  VertSpec = 'Vertices';
  //RefSpec = 'RefFrame';
  NewVertSpec = 'NewVertices';
var
  S, S2: String;
  currentModelComponent: QComponent;
  currentFrameNumber: Integer;
  bf,bf2: QModelTag;
  o_tag,s_tag: QTagFrame;
  O: QObject;
  myRoot, modelRoot: QModelRoot;
  m,m1: PMatrixTransformation;
  New: vec3_p;
//  sc: double;
begin
  S:=Specifics.Bytes[FloatSpecNameOf(VertSpec)];
  if S='' then
  begin
    Result:=0;
    Exit;
  end;
  Result:=Length(S) div SizeOf(vec3_t);
  PChar(P):=PChar(S);

  //Now handle MD3 tags (if any) by moving the vertices appropriately
  O:=Parent;
  while O<>nil do
  begin
    if O is QModelRoot then Break;
    O:=O.Parent;
  end;
  myRoot:=QModelRoot(O);

  if myRoot<>nil then
  begin
    if (MyRoot.Parent is QModelRoot) then
      O:=O.Parent;
  end;
  if O = Self then O:=nil;
  modelRoot:=QModelRoot(O);

  if myRoot=modelRoot then
    //Not a frame from a tagged model
    Exit;

  s_tag:=nil;
  o_tag:=nil;
  bf:=nil;
  bf2:=nil;

  CurrentModelComponent:=modelRoot.CurrentComponent;
  if CurrentModelComponent=nil then
    CurrentModelComponent:=modelRoot.GetComponentFromIndex(0);
  if CurrentModelComponent<>nil then
  begin
    currentFrameNumber:=CurrentModelComponent.FrameGroup.SubElements.IndexOf(CurrentModelComponent.CurrentFrame);
    if currentFrameNumber<>-1 then
    begin
      bf:=QModelTag(modelRoot.getmisc.FindSubObject(myRoot.Specifics.Strings['linked_to'], QModelTag, nil));
      bf2:=QModelTag(myRoot.getmisc.FindSubObject(myRoot.Specifics.Strings['linked_to'], QModelTag, nil));
      o_tag:=QTagFrame(bf.GetTagFrameFromIndex(currentFrameNumber));
      s_tag:=QTagFrame(bf2.GetTagFrameFromIndex(Parent.SubElements.IndexOf(Self)));
      Log(LOG_VERBOSE, 'Connecting tag %s from model %s to model %s', [myRoot.Specifics.Strings['linked_to'], modelRoot.Name, myRoot.Name]);
    end;
  end;

  if (s_tag<>nil) and (o_tag<>nil) and (bf<>nil) and (bf2<>nil) then
  begin
    //Allocate new storage for the new vertices
    SetLength(S2, SizeOf(vec3_t)*Result);
    PChar(New):=PChar(S2);

    //Copy the old vertices into New
    Move(P^, New^, Result*SizeOf(Vec3_T));

    //Get the rotation matrices of the connected tags
    s_Tag.GetRotMatrix(m);
    if m=nil then
      Exit;
    o_Tag.GetRotMatrix(m1);
    if m1=nil then
      Exit;

    //Rotate the vertices so the tags align
    RotateVecs(MultiplieMatrices(M^,M1^), P, Result);

    //Move the vertices so the tags are at the same position
    TranslateVecs(Vec3Diff(o_Tag.GetPosition^, s_tag.getPosition^), P, Result);
//    ScaleVecs(P, Result, sc-bf.GetQ3A_Scale);

    //Store the new vertices and return them
    Specifics.Bytes[FloatSpecNameOf(NewVertSpec)]:=S2;
    PChar(P):=PChar(S2);
  end;
end;

Procedure QFrame.RemoveVertex(index: Integer);
const
  VertSpec = 'Vertices';
var
  I, Count: Integer;
  S: String;
  Dest: vec3_p;
  vtxs: vec3_p;
begin
  count:=GetVertices(vtxs);
  if index>count then
    Exit;
  SetLength(S, SizeOf(vec3_t)*(Count-1));
  PChar(Dest):=PChar(S);
  //FIXME: Instead of copying one-by-one, do a bulk-Move.
  for i:=1 to count do
  begin
    if i<>index then
    begin
      Dest^[0]:=vtxs^[0];
      Dest^[1]:=vtxs^[1];
      Dest^[2]:=vtxs^[2];
      inc(dest);
    end;
    inc(vtxs);
  end;
  Specifics.Bytes[FloatSpecNameOf(VertSpec)]:=S;
end;

procedure QFrame.ChercheExtremites(var Min, Max: TVect);
var
  I: Integer;
  P: vec3_p;
begin
  for I:=1 to GetVertices(P) do begin
    if P^[0] < Min.X then
      Min.X:=P^[0];
    if P^[1] < Min.Y then
      Min.Y:=P^[1];
    if P^[2] < Min.Z then
      Min.Z:=P^[2];
    if P^[0] > Max.X then
      Max.X:=P^[0];
    if P^[1] > Max.Y then
      Max.Y:=P^[1];
    if P^[2] > Max.Z then
      Max.Z:=P^[2];
    Inc(P);
  end;
end;

function QFrame.PyGetAttr(attr: PyChar) : PyObject;
var
  I, Count: Integer;
  P: vec3_p;
{  v: PyVect; }
begin
  Result:=inherited PyGetAttr(attr);
  if Result<>Nil then Exit;
  case attr[0] of
{    'b': if StrComp(attr, 'bones')=0 then begin
      Count:=GetBoneMovement(Pb);
      Result:=PyList_New(Count);
      for I:=0 to Count-1 do begin
        v:=MakePyVectv(Pb^.new_offset);
        PyList_SetItem(Result, I, Py_BuildValueX('(sO)',[ToPyChar(Pb^.Name), v]));
        PyDECREF(v);
        Inc(Pb);
      end;
      Exit;
    end;   }
    'c': if StrComp(attr, 'compparent')=0 then begin
      Result:=GetPyObj(Component);
      Exit;
    end;
    'i': if StrComp(attr, 'index')=0 then begin
      Result:=PyInt_FromLong(Parent.SubElements.IndexOf(self));
      Exit;
    end
    else if StrComp(attr, 'info')=0 then begin
      if FInfo=Nil then
        Result:=Py_None
      else
        Result:=FInfo;
      Py_INCREF(Result);
      Exit;
    end;
    'v': if StrComp(attr, 'vertices')=0 then begin
      Acces;
      Count:=GetVertices(P);
      Result:=PyList_New(Count);
      for I:=0 to Count-1 do begin
        PyList_SetItem(Result, I, MakePyVectv(P^));
        Inc(P);
      end;
      Exit;
    end;
  end;
end;

function QFrame.PySetAttr(attr: PyChar; value: PyObject) : Boolean;
const
  VertSpec = 'Vertices';
var
  I, Count: Integer;
  P: PyVect;
  S, S0: String;
  Dest: vec3_p;
  comp: QObject;
begin
  Result:=inherited PySetAttr(attr, value);
  if not Result then begin
    case attr[0] of
      'c': if StrComp(attr, 'compparent')=0 then begin
        comp:=QkObjFromPyObj(value);
        if comp=nil then
         Exit;
        if not (comp is QComponent) then
         Exit;
        Component:=QComponent(comp);
        Result:=True;
        Exit;
      end;
      'i': if StrComp(attr, 'info')=0 then begin
        Py_XDECREF(FInfo);
        FInfo:=value;
        Py_INCREF(value);
        Result:=True;
        Exit;
      end;
      'v': if StrComp(attr, 'vertices')=0 then begin
        Acces;
        Count:=PyObject_Length(value);
        if Count<0 then
          Exit;
        S0:=FloatSpecNameOf(VertSpec);
        S:=S0+'=';
        SetLength(S, Length(VertSpec+'=')+SizeOf(vec3_t)*Count);
        PChar(Dest):=PChar(S)+Length(VertSpec+'=');
        for I:=0 to Count-1 do begin
          P:=PyVect(PyList_GetItem(value, I));
          if P=Nil then
            Exit;
          if P^.ob_type <> @TyVect_Type then
            Raise EError(4441);
          with P^.V do begin
            Dest^[0]:=X;
            Dest^[1]:=Y;
            Dest^[2]:=Z;
          end;
          Inc(Dest);
        end;
        Specifics.Delete(S0);
        Specifics.AddStringFull(S);
        Result:=True;
        Exit;
      end;
    end;
  end;
end;

initialization
  RegisterQObject(QFrame, 'a');
end.
