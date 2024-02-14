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
  TVersionNumber = class
  private
    Numbers: array of Cardinal;
    Remainder: String;
  public
    constructor Create(const Version: String; const Delimiter: String = '.');
    function Count: Integer;
    function IsEqual(const VersionNumber: array of Cardinal): Boolean;
    function IsEqualOrGreater(const VersionNumber: array of Cardinal): Boolean;
    function IsLess(const VersionNumber: array of Cardinal): Boolean;
  end;

 { ------------------- }

implementation

uses SysUtils, StrUtils, Math, ExtraFunctionality;

 { ------------------- }

constructor TVersionNumber.Create(const Version: String; const Delimiter: String);
var
  Index, OldIndex: Integer;
begin
  //Reset
  SetLength(Numbers, 0);
  Remainder:='';

  Index:=Pos(Delimiter, Version);
  OldIndex:=1;
  while (Index > 0) do
  begin
    SetLength(Numbers, Length(Numbers)+1);
    Numbers[Length(Numbers)-1]:=StrToIntDef(MidStr(Version, OldIndex, Index - OldIndex), 0);
    OldIndex:=Index+1;
    Index:=PosEx(Delimiter, Version, OldIndex);
  end;
  SetLength(Numbers, Length(Numbers)+1);
  Numbers[Length(Numbers)-1]:=StrToUIntDef(RightStr(Version, Length(Version) - OldIndex + 1), 0);

  //FIXME: Remainder
end;

function TVersionNumber.Count: Integer;
begin
  Result:=Length(Numbers);
end;

//If no number is provided, interpret that as zero.
function GetIndex(const VersionNumber: array of Cardinal; Index: Integer): Cardinal;
begin
  if Index >= Length(VersionNumber) then
    Result:=0
  else
    Result:=VersionNumber[Index]
end;

//Are we equal to the provided version number?
function TVersionNumber.IsEqual(const VersionNumber: array of Cardinal): Boolean;
var
  I: Integer;
begin
  for I:=0 to Max(Length(Numbers), Length(VersionNumber))-1 do
  begin
    if GetIndex(VersionNumber, I) <> GetIndex(Numbers, I) then
    begin
      //We are not equal to the provided version number.
      Result:=False;
      Exit;
    end;
    //We are equal to the provided version number for this index, so continue comparing.
  end;
  //We are equal to the provided version number.
  Result:=True;
end;

//Are we equal to or greater than the provided version number?
function TVersionNumber.IsEqualOrGreater(const VersionNumber: array of Cardinal): Boolean;
var
  I: Integer;
begin
  for I:=0 to Max(Length(Numbers), Length(VersionNumber))-1 do
  begin
    if GetIndex(Numbers, I) < GetIndex(VersionNumber, I) then
    begin
      //We are less than the provided version number.
      Result:=False;
      Exit;
    end
    else if GetIndex(Numbers, I) > GetIndex(VersionNumber, I) then
    begin
      //We are greater than the provided version number.
      Result:=True;
      Exit;
    end;
    //We are equal to the provided version number for this index, so continue comparing.
  end;
  //We are equal to the provided version number.
  Result:=True;
end;

//Are we less than the provided version number?
function TVersionNumber.Isless(const VersionNumber: array of Cardinal): Boolean;
var
  I: Integer;
begin
  for I:=0 to Max(Length(Numbers), Length(VersionNumber))-1 do
  begin
    if GetIndex(Numbers, I) < GetIndex(VersionNumber, I) then
    begin
      //We are less than the provided version number.
      Result:=True;
      Exit;
    end
    else if GetIndex(Numbers, I) > GetIndex(VersionNumber, I) then
    begin
      //We are greater than the provided version number.
      Result:=False;
      Exit;
    end;
    //We are equal to the provided version number for this index, so continue comparing.
  end;
  //We are equal to the provided version number.
  Result:=False;
end;

end.
