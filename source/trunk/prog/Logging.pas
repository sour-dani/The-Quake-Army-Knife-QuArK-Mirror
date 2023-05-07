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
unit Logging;

interface

//Keep the number of uses to a bare minimal, due to Delphi's init-order!
{$IFDEF PyProfiling}uses Classes;{$ENDIF}

type
  TLogName = (LOG_DEFAULT, LOG_PASCAL, LOG_PYTHON, LOG_SYS, LOG_CONSOLE, LOG_DEBUG);

Procedure OpenLogFile;

function GetLogLevel : Cardinal;

Procedure Log(const s: string); overload;
Procedure Log(level: cardinal; const s: string); overload;
Procedure Log(const s: string; const args: array of const); overload;
Procedure Log(level: cardinal; const s: string; const args: array of const); overload;
Procedure Log(Logger: TLogName; const s: string); overload;
Procedure Log(Logger: TLogName; level: cardinal; const s: string); overload;
Procedure Log(Logger: TLogName; const s: string; const args: array of const); overload;
Procedure Log(Logger: TLogName; level: cardinal; const s: string; const args: array of const); overload;

const
  LOG_FILENAME = 'QUARK.LOG';
  LOG_PATCHFILE = 'PATCH.TXT';

  LOG_ALWAYS = 0;
  LOG_CRITICAL = 10;
  LOG_WARNING = 20;
  LOG_INFO = 30;
  LOG_VERBOSE = 40;

{$IFDEF PyProfiling}
Procedure LogProfiling(const Location: String; const Args: array of String; const PythonStackTrace: TStringList);

const
  LOG_PROFILE_FILENAME = 'PROFILING.LOG';
{$ENDIF}

implementation

uses Windows, Sysutils, QConsts, ApplPaths;

var
  LogFile: TextFile;
  LogOpened: boolean;
  LogFilename: string;
  LogPatchname: string;
  LogLevel: cardinal;
  LogLevelEnv: string;
  LogCache: array of string;
{$IFDEF PyProfiling}
  LogProfileFile: TextFile;
{$ENDIF}

const
  //Default level is 'warning'
  DefaultLogLevel = LOG_WARNING;

Procedure aLog(Logger: TLogName; const s: string); forward;

 {------------------------}

function GetLogLevel : Cardinal;
begin
  result := LogLevel;
end;

function GetPatchVersion: String;
var
  PF: TextFile;
  filename: string;
begin
  result:='';
  filename:=ConcatPaths([GetQPath(pQuArK), LogPatchname]);
  if fileexists(filename) then
  begin
  {$I-}
    AssignFile(PF, filename);
    Reset(PF);
    ReadLn(PF, result);
    CloseFile(PF);
  {$I+}
  end;
end;

Procedure OpenLogFile;
var
  PatchVersion: String;
  I: Integer;
begin
  if LogOpened then
    exit;
  PatchVersion:=GetPatchVersion;
  {$I-}
  AssignFile(LogFile, ConcatPaths([GetQPath(pQuArKLog), LogFilename]));
  rewrite(LogFile);
  {$I+}
  LogOpened:=true;
  Log(LOG_PASCAL, 'QuArK started at %s', [DateTimeToStr(now)]);
  if Length(PatchVersion) <> 0 then
    Log(LOG_PASCAL, 'QuArK version is %s %s %s', [QuArKVersion, QuArKMinorVersion, PatchVersion])
  else
    Log(LOG_PASCAL, 'QuArK version is %s %s', [QuArKVersion, QuArKMinorVersion]);
  Log(LOG_PASCAL, 'Loglevel is %d', [LogLevel]);
{$IFDEF Debug}
  Log(LOG_PASCAL, 'Current install is located in %s', [GetQPath(pQuArK)]);
  Log(LOG_PASCAL, 'Running in DEBUG mode!');
{$ENDIF}
  if Length(LogCache)<>0 then
  begin
    {$I-}
    for I:=0 to Length(LogCache)-1 do
      WriteLn(LogFile, LogCache[I]);
    Flush(LogFile);
    {$I+}
    SetLength(LogCache, 0);    
  end;
{$IFDEF PyProfiling}
  {$I-}
  AssignFile(LogProfileFile, ConcatPaths([GetQPath(pQuArKLog), LOG_PROFILE_FILENAME]));
  rewrite(LogProfileFile);
  {$I+}
{$ENDIF}
end;

Procedure aLog(logger: TLogName; const s: string);
var
  S2: string;
begin
  case logger of
    LOG_DEFAULT: S2:=Format('Log> %s', [s]);
    LOG_PASCAL:  S2:=Format('QuArKLog> %s', [s]);
    LOG_PYTHON:  S2:=Format('PythonLog> %s', [s]);
    LOG_SYS:     S2:=Format('SysLog> %s', [s]);
    LOG_CONSOLE: S2:=Format('ConsoleLog> %s', [s]);
    LOG_DEBUG:   S2:=Format('DebugLog> %s', [s]);
    else         S2:=s;
  end;
  if not LogOpened then
  begin
    //Logfile isn't open yet (or already closed). Let's store it,
    //and write it as soon as the logfile gets opened (again?).
    SetLength(LogCache, Length(LogCache) + 1);
    LogCache[Length(LogCache) - 1]:=S2;
    Exit;
  end;
  {$I-}
  WriteLn(LogFile, S2);
  Flush(LogFile);
  {$I+}
end;

Procedure Log(const s: string);
begin
  aLog(LOG_DEFAULT, s);
end;

Procedure Log(level: cardinal; const s: string);
begin
  if level<=Loglevel then
    aLog(LOG_DEFAULT, s);
end;

Procedure Log(const s: string; const args: array of const);
begin
  aLog(LOG_DEFAULT, format(s, args));
end;

Procedure Log(level: cardinal; const s: string; const args: array of const);
begin
  if level<=Loglevel then
    aLog(LOG_DEFAULT, format(s, args));
end;

Procedure Log(Logger: TLogName; const s: string);
begin
  aLog(Logger, s);
end;

Procedure Log(Logger: TLogName; level: cardinal; const s: string);
begin
  if level<=Loglevel then
    aLog(Logger, s);
end;

Procedure Log(Logger: TLogName; const s: string; const args: array of const);
begin
  aLog(Logger, format(s, args));
end;

Procedure Log(Logger: TLogName; level: cardinal; const s: string; const args: array of const);
begin
  if level<=Loglevel then
    aLog(Logger, format(s, args));
end;

Procedure CloseLogFile;
begin
  if not LogOpened then
    exit;
  Log(LOG_PASCAL, format('QuArK closed at %s',[DateTimeToStr(now)]));
  {$I-}
  CloseFile(LogFile);
  {$I+}
  LogOpened:=false;
{$IFDEF PyProfiling}
  {$I-}
  CloseFile(LogProfileFile);
  {$I+}
{$ENDIF}
end;

{$IFDEF PyProfiling}
function AddressInfo(X: Cardinal): String;
begin
  Result:=IntToHex(X, 8);
end;

//Based on: https://stackoverflow.com/questions/15890029/delphi-obtain-stack-trace-after-exception
function GetStackReport: AnsiString;
var
  retaddr, walker: ^pointer;
begin
  //FIXME: Start using jclDebug's GetLocationInfo for this?

  // History of stack, ignore esp frame
  asm
    mov walker, ebp
  end;

  // assume return address is present above ebp
  while Cardinal(walker^) <> 0 do
  begin
    if Cardinal(walker^)=1 then Exit;
    retaddr := walker;
    Inc(retaddr);
    if result<>'' then
      result := result + #13#10;
    result := result + AddressInfo(Cardinal(retaddr^));
    walker := walker^;
  end;
end;

//Based on: https://stackoverflow.com/a/46523477
function JoinArgs(const s: array of string): string;
var
  i, c: Integer;
  p: PChar;
begin
  c := 0;
  for i := 0 to High(s) do
    Inc(c, Length(s[i]));
  SetLength(Result, c + High(s));
  p := PChar(Result);
  for i := 0 to High(s) do begin
    if i > 0 then begin
      p^ := ',';
      Inc(p);
    end;
    Move(PChar(s[i])^, p^, SizeOf(Char)*Length(s[i]));
    Inc(p, Length(s[i]));
  end;
end;

Procedure LogProfiling(const Location: String; const Args: array of String; const PythonStackTrace: TStringList);
var
  Timestamp: TDateTime;
begin
  Timestamp := Now;
  {$I-}
  if PythonStackTrace<>nil then
   WriteLn(LogProfileFile, Format('[%s %s] Thread %d, Location %s'#13#10'Arguments: %s'#13#10'Delphi stack trace:#13#10%s'#13#10'Python stack trace:'#13#10'%s', [DateToStr(Timestamp), TimeToStr(Timestamp), GetCurrentThreadId, Location, JoinArgs(Args), GetStackReport(), PythonStackTrace.Text]))
  else
   WriteLn(LogProfileFile, Format('[%s %s] Thread %d, Location %s'#13#10'Arguments: %s'#13#10'Delphi stack trace:#13#10%s'#13#10, [DateToStr(Timestamp), TimeToStr(Timestamp), GetCurrentThreadId, Location, JoinArgs(Args), GetStackReport()]));
  Flush(LogProfileFile);
  {$I+}
end;
{$ENDIF}

initialization
  LogOpened:=False;
  LogFilename:=GetEnvironmentVariable('QUARK_LOG_FILENAME');
  if LogFilename='' then
    LogFilename:=LOG_FILENAME
  else
    Windows.MessageBox(0, 'Environmental variable QUARK_LOG_FILENAME found. QuArK will use its value.', 'Environmental variable found', MB_TASKMODAL or MB_ICONINFORMATION or MB_OK);
  LogPatchname:=GetEnvironmentVariable('QUARK_LOG_PATCHNAME');
  if LogPatchname='' then
    LogPatchname:=LOG_PATCHFILE
  else
    Windows.MessageBox(0, 'Environmental variable QUARK_LOG_PATCHNAME found. QuArK will use its value.', 'Environmental variable found', MB_TASKMODAL or MB_ICONINFORMATION or MB_OK);
  LogLevelEnv:=GetEnvironmentVariable('QUARK_LOG_LEVEL');
  if LogLevelEnv='' then
    LogLevel:=DefaultLogLevel
  else
  begin
    Windows.MessageBox(0, 'Environmental variable QUARK_LOG_LEVEL found. QuArK will use its value.', 'Environmental variable found', MB_TASKMODAL or MB_ICONINFORMATION or MB_OK);
    LogLevel:=StrToIntDef(LogLevelEnv, DefaultLogLevel);
  end;
finalization
  CloseLogFile;
end.
