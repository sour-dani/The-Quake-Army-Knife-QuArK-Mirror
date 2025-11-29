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
unit FileExists2;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat;

function FileExistsWild(const Path, CheckFile: String; Checked: PString) : Boolean;

implementation

uses SysUtils, ApplPaths;

function FileExistsWild(const Path, CheckFile: String; Checked: PString) : Boolean;
var
  RemainingCheckFile, SingleFile: String;
  S: TSearchRec;
  rc: Integer;
  I, J: Integer;
  F: Boolean;
begin
  if (Path='') or (CheckFile='') then
  begin
    Result:=True;
    Exit;
  end;

  Result:=false;

  RemainingCheckFile:=CheckFile;
  while RemainingCheckFile<>'' do
  begin
    I:=Pos(#$D, RemainingCheckFile);
    if I = 0 then
      I:=Pos(#$A, RemainingCheckFile)
    else
    begin
      J:=Pos(#$A, RemainingCheckFile);
      if (J<>0) and (J<I) then I:=J;
    end;

    if I <> 0 then
    begin
      SingleFile:=Copy(RemainingCheckFile, 1, I-1);
      Delete(RemainingCheckFile, 1, I);
    end
    else
    begin
      SingleFile:=RemainingCheckFile;
      RemainingCheckFile:='';
    end;

    if SingleFile='' then
      Continue;

    if Pos('*', SingleFile) <> 0 then
    begin
      rc:=FindFirst(ConcatPaths([Path, SingleFile]), faAnyFile, S);
      try
        if rc=0 then
          F:=True
        else
          F:=False;
      finally
        FindClose(S);
      end;
    end
    else
    begin
      F:=FileExists(ConcatPaths([Path, SingleFile]));
    end;
    Result:=Result or F;
    if (Checked<>nil) and not F then Checked^:=Checked^+SingleFile+', or ';
  end;
end;

end.
