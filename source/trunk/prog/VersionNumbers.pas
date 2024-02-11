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
unit VersionNumbers;

interface

type
  TVersionNumber = array of Integer;

function SplitVersionNumber(const VersionNumber: String; const Delimiter: String = '.') : TVersionNumber;

 { ------------------- }

implementation

uses SysUtils, StrUtils, ExtraFunctionality;

 { ------------------- }

function SplitVersionNumber(const VersionNumber: String; const Delimiter: String): TVersionNumber;
var
  Index, OldIndex: Integer;
begin
  SetLength(Result, 0);
  Index:=Pos(Delimiter, VersionNumber);
  OldIndex:=1;
  while (Index > 0) do
  begin
    SetLength(Result, Length(Result)+1);
    Result[Length(Result)-1]:=StrToIntDef(MidStr(VersionNumber, OldIndex, Index - OldIndex), 0);
    OldIndex:=Index+1;
    Index:=PosEx(Delimiter, VersionNumber, OldIndex);
  end;
  SetLength(Result, Length(Result)+1);
  Result[Length(Result)-1]:=StrToUIntDef(RightStr(VersionNumber, Length(VersionNumber) - OldIndex + 1), 0);
end;

end.
