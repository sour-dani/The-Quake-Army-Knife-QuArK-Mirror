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
unit QkTagFrame;

interface

uses QkMdlObject, QkObjects, qmath, qmatrices;

type
  QTagFrame = class(QMdlObject)
  public
    class function TypeInfo: String; override;
    function IsAllowedParent(nParent: QObject) : Boolean; override;
    procedure ObjectState(var E: TEtatObjet); override;
    Procedure SetPosition(p: vec3_t);
    Function GetPosition: vec3_p;
    procedure SetRotMatrix(P: TMatrixTransformation);
    procedure GetRotMatrix(var P: PMatrixTransformation);
  end;

implementation

uses QkObjectClassList, QkModelTag;

function QTagFrame.IsAllowedParent(nParent: QObject) : Boolean;
begin
  if (nParent=nil) or (nParent is QModelTag) then
    Result:=true
  else
    Result:=false;
end;

procedure QTagFrame.SetPosition(P: vec3_t);
const
  SpecOrigin = 'origin';
var
  CVert: vec3_p;
  S: string; //FIXME: Switch to bytes!
begin
  SetLength(S, SizeOf(vec3_t));
  PChar(CVert):=PChar(S);
  CVert^[0]:=P[0];
  CVert^[1]:=P[1];
  CVert^[2]:=P[2];
  Specifics.ByteArray[FloatSpecNameOf(SpecOrigin)]:=S;
end;

function QTagFrame.GetPosition: vec3_p;
const
  SpecOrigin = 'origin';
var
  S: string;
begin
  S:=Specifics.ByteArray[FloatSpecNameOf(SpecOrigin)];
  if S='' then
  begin
    Result:=nil;
    Exit;
  end;
  PChar(Result):=PChar(S);
end;

procedure QTagFrame.SetRotMatrix(P: TMatrixTransformation);
const
  SpecRotMatrix = 'rotmatrix';
var
  CVert: vec3_p;
  S: string; //FIXME: Switch to bytes!
begin
  SetLength(S, SizeOf(TMatrixTransformation));
  PChar(CVert):=PChar(S);
  Move(P, CVert^, Sizeof(TMatrixTransformation));
  Specifics.ByteArray[FloatSpecNameOf(SpecRotMatrix)]:=S;
end;

procedure QTagFrame.GetRotMatrix(var P: PMatrixTransformation);
const
  SpecRotMatrix = 'rotmatrix';
var
  s: string;
begin
  S:=Specifics.ByteArray[FloatSpecNameOf(SpecRotMatrix)];
  if S='' then
  begin
    P:=nil;
    Exit;
  end;
  PChar(P):=PChar(S);
end;

class function QTagFrame.TypeInfo;
begin
  Result:=':tagframe';
end;

procedure QTagFrame.ObjectState(var E: TEtatObjet);
begin
  inherited;
  E.IndexImage:=iiFrame;
end;

initialization
  RegisterQObject(QTagFrame,   'a');
end.

