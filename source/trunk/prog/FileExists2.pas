unit FileExists2;

interface

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
