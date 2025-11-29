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
unit QkBBoxGroup;

{$INCLUDE DelphiCompat.inc}

interface

uses
  DelphiCompat, QkObjects, QkFileObjects, QkForm, QkImages, Python, Game, QkMdlObject;

type
  QBBoxGroup = Class(QMdlObject)
  public
    class function TypeInfo: String; override;
    function IsAllowedParent(nParent: QObject) : Boolean; override;
    procedure AnalyseClic(Liste: PyObject); override;
  end;

implementation

uses QkObjectClassList, QkMiscGroup, QkMapPoly;

function QBBoxGroup.IsAllowedParent(nParent: QObject) : Boolean;
begin
  if (nParent=nil) or (nParent is QMiscGroup) then
    Result:=true
  else
    Result:=false;
end;

class function QBBoxGroup.TypeInfo;
begin
  Result:=':bbg';
end;

procedure QBBoxGroup.AnalyseClic;
var
  I: Integer;
  Q: QObject;
begin
  for I:=0 to SubElements.Count-1 do begin
    Q:=SubElements[I];
    if (Q is TPolyhedron) then
      TPolyhedron(Q).AnalyseClic(Liste);
  end;
end;

initialization
  RegisterQObject(QBBoxGroup,  'a');
end.

