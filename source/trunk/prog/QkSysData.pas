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
unit QkSysData;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, QkObjects;

type
  QSysData = class(QObject)
  public
    class function TypeInfo: String; override;
    function IsAllowedParent(nParent: QObject) : Boolean; override;
    class function ShowInListSel : Boolean; override;
  end;

implementation

uses QkObjectClassList;

function QSysData.IsAllowedParent(nParent: QObject) : Boolean;
begin
  if (nParent=nil) then
    Result:=true
  else
    Result:=false;
end;

class function QSysData.TypeInfo: String;
begin
  Result:=':sd';
end;

class function QSysData.ShowInListSel : Boolean;
begin
  Result:=False;
end;

initialization
  RegisterQObject(QSysData, 'a');
end.
