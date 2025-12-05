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

{$INCLUDE DelphiCompat.inc}

interface

//Keep the number of uses to a bare minimal, due to Delphi's init-order!
uses DelphiCompat{$IFDEF PyProfiling}, Classes{$ENDIF};

type
  TLogName = (LOG_DEFAULT, LOG_PASCAL, LOG_PYTHON, LOG_SYS, LOG_CONSOLE, LOG_DEBUG);

procedure OpenLogFile;

function GetLogLevel : Cardinal;

procedure Log(const msg: String); overload;
procedure Log(level: Cardinal; const msg: String); overload;
procedure Log(const msg: String; const args: array of const); overload;
procedure Log(level: Cardinal; const msg: String; const args: array of const); overload;
procedure Log(Logger: TLogName; const msg: String); overload;
procedure Log(Logger: TLogName; level: Cardinal; const msg: String); overload;
procedure Log(Logger: TLogName; const msg: String; const args: array of const); overload;
procedure Log(Logger: TLogName; level: Cardinal; const msg: String; const args: array of const); overload;

const
  LOG_ALWAYS = 0;
  LOG_CRITICAL = 10;
  LOG_WARNING = 20;
  LOG_INFO = 30;
  LOG_VERBOSE = 40;

function GetPatchVersion: String;

{$IFDEF PyProfiling}
procedure LogProfiling(const Location: String; const Args: array of String; const PythonStackTrace: TStringList);
{$ENDIF}

implementation

uses Windows{$IFNDEF PyProfiling}, Classes{$ENDIF}, Forms, Sysutils, ApplPaths;

var
  LogFile: TextFile;
  LogFilename: String;
  LogPatchname: String;
  LogLevel: Cardinal;
  LogCache: TStringList = nil;
{$IFDEF PyProfiling}
  LogProfileFile: TextFile;
{$ENDIF}

const
  LOG_FILENAME = 'QUARK.LOG';
  LOG_PATCHFILE = 'PATCH.TXT';
  {$IFDEF PyProfiling}
  LOG_PROFILE_FILENAME = 'PROFILING.LOG';
  {$ENDIF}

  //Default level is 'warning'
  DefaultLogLevel = LOG_WARNING;

procedure aLog(Logger: TLogName; const msg: String); forward;

 {------------------------}

function GetLogLevel : Cardinal;
begin
  result := LogLevel;
end;

function GetPatchVersion: String;
var
  PF: TextFile;
  filename: String;
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

procedure OpenLogFile;
var
  I: Integer;
{$IFDEF Delphi7orNewerCompiler}
  DateFormat: TFormatSettings;
{$ENDIF}
begin
  if TTextRec(LogFile).Mode<>fmClosed then
    Exit;
  {$IFDEF Delphi7orNewerCompiler}
  GetLocaleFormatSettings(LOCALE_SYSTEM_DEFAULT, DateFormat);
  {$ENDIF}
  {$I-}
  AssignFile(LogFile, ConcatPaths([GetQPath(pQuArKLog), LogFilename]));
  Rewrite(LogFile);
  {$I+}
  Log(LOG_PASCAL, 'Logging started at %s', [DateTimeToStr(now{$IFDEF Delphi7orNewerCompiler}, DateFormat{$ENDIF})]);
  Log(LOG_PASCAL, 'Loglevel is %d', [LogLevel]);
  if Assigned(LogCache) then
  begin
    {$I-}
    for I:=0 to LogCache.Count-1 do
      WriteLn(LogFile, LogCache[I]);
    Flush(LogFile);
    {$I+}
    FreeAndNil(LogCache);
  end;
{$IFDEF PyProfiling}
  {$I-}
  AssignFile(LogProfileFile, ConcatPaths([GetQPath(pQuArKLog), LOG_PROFILE_FILENAME]));
  Rewrite(LogProfileFile);
  {$I+}
{$ENDIF}
end;

procedure aLog(logger: TLogName; const msg: String);
var
  s: String;
begin
  case logger of
    LOG_DEFAULT: s:=Format('Log> %s', [msg]);
    LOG_PASCAL:  s:=Format('QuArKLog> %s', [msg]);
    LOG_PYTHON:  s:=Format('PythonLog> %s', [msg]);
    LOG_SYS:     s:=Format('SysLog> %s', [msg]);
    LOG_CONSOLE: s:=Format('ConsoleLog> %s', [msg]);
    LOG_DEBUG:   s:=Format('DebugLog> %s', [msg]);
    else         s:=msg;
  end;
  if TTextRec(LogFile).Mode=fmClosed then
  begin
    //Logfile isn't open yet (or already closed). Let's store it,
    //and write it as soon as the logfile gets opened (again?).
    if not Assigned(LogCache) then LogCache := TStringList.Create();
    LogCache.Append(s);
    Exit;
  end;
  {$I-}
  WriteLn(LogFile, s);
  Flush(LogFile);
  {$I+}
end;

procedure Log(const msg: String);
begin
  aLog(LOG_DEFAULT, msg);
end;

procedure Log(level: Cardinal; const msg: String);
begin
  if level<=Loglevel then
    aLog(LOG_DEFAULT, msg);
end;

procedure Log(const msg: String; const args: array of const);
begin
  aLog(LOG_DEFAULT, format(msg, args));
end;

procedure Log(level: Cardinal; const msg: String; const args: array of const);
begin
  if level<=Loglevel then
    aLog(LOG_DEFAULT, format(msg, args));
end;

procedure Log(Logger: TLogName; const msg: String);
begin
  aLog(Logger, msg);
end;

procedure Log(Logger: TLogName; level: Cardinal; const msg: String);
begin
  if level<=Loglevel then
    aLog(Logger, msg);
end;

procedure Log(Logger: TLogName; const msg: String; const args: array of const);
begin
  aLog(Logger, format(msg, args));
end;

procedure Log(Logger: TLogName; level: Cardinal; const msg: String; const args: array of const);
begin
  if level<=Loglevel then
    aLog(Logger, format(msg, args));
end;

procedure CloseLogFile;
{$IFDEF Delphi7orNewerCompiler}
var
  DateFormat: TFormatSettings;
{$ENDIF}
begin
  if TTextRec(LogFile).Mode=fmClosed then
    Exit;
  {$IFDEF Delphi7orNewerCompiler}
  GetLocaleFormatSettings(LOCALE_SYSTEM_DEFAULT, DateFormat); //FIXME: Probably want to more this to a more central place?
  {$ENDIF}
  Log(LOG_PASCAL, format('Logging stopped at %s',[DateTimeToStr(now{$IFDEF Delphi7orNewerCompiler}, DateFormat{$ENDIF})]));
  {$I-}
  CloseFile(LogFile);
  {$I+}
{$IFDEF PyProfiling}
  {$I-}
  CloseFile(LogProfileFile);
  {$I+}
{$ENDIF}
end;

{$IFDEF PyProfiling}
//Based on: https://stackoverflow.com/questions/15890029/delphi-obtain-stack-trace-after-exception
function GetStackReport: String;
var
  retaddr, walker: ^pointer;
begin
  //FIXME: Start using jclDebug's GetLocationInfo for this?

  // History of stack, ignore esp frame
  asm
    mov walker, ebp
  end;

  // assume return address is present above ebp
  while NativeUInt(walker^) <> 0 do
  begin
    if NativeUInt(walker^)=1 then Exit;
    retaddr := walker;
    Inc(retaddr);
    if result<>'' then
      result := result + sLineBreak;
    result := result + {U}IntToHex(NativeUInt(retaddr^), SizeOf(NativeUInt) * 2);
    walker := walker^;
  end;
end;

//Based on: https://stackoverflow.com/a/46523477
function JoinArgs(const s: array of String): String;
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

procedure LogProfiling(const Location: String; const Args: array of String; const PythonStackTrace: TStringList);
var
  Timestamp: TDateTime;
{$IFDEF Delphi7orNewerCompiler}
  DateFormat: TFormatSettings;
{$ENDIF}
begin
  Timestamp := Now;
  {$IFDEF Delphi7orNewerCompiler}
  GetLocaleFormatSettings(LOCALE_SYSTEM_DEFAULT, DateFormat);
  {$ENDIF}
  {$I-}
  if PythonStackTrace<>nil then
   WriteLn(LogProfileFile, Format('[%s %s] Thread %d, Location %s'+sLineBreak+'Arguments: %s'+sLineBreak+'Delphi stack trace:'+sLineBreak+'%s'+sLineBreak+'Python stack trace:'+sLineBreak+'%s', [DateToStr(Timestamp{$IFDEF Delphi7orNewerCompiler}, DateFormat{$ENDIF}), TimeToStr(Timestamp{$IFDEF Delphi7orNewerCompiler}, DateFormat{$ENDIF}), GetCurrentThreadId, Location, JoinArgs(Args), GetStackReport(), PythonStackTrace.Text]))
  else
   WriteLn(LogProfileFile, Format('[%s %s] Thread %d, Location %s'+sLineBreak+'Arguments: %s'+sLineBreak+'Delphi stack trace:'+sLineBreak+'%s'+sLineBreak, [DateToStr(Timestamp{$IFDEF Delphi7orNewerCompiler}, DateFormat{$ENDIF}), TimeToStr(Timestamp{$IFDEF Delphi7orNewerCompiler}, DateFormat{$ENDIF}), GetCurrentThreadId, Location, JoinArgs(Args), GetStackReport()]));
  Flush(LogProfileFile);
  {$I+}
end;
{$ENDIF}

const
 EnvVarFound = 'Environmental variable %s found. QuArK will use its value.';
 EnvVarFoundTitle = 'Environmental variable found';
 EnvVarLogFilename = 'QUARK_LOG_FILENAME';
 EnvVarLogLevel = 'QUARK_LOG_LEVEL';
 EnvVarLogPatchname = 'QUARK_LOG_PATCHNAME';

initialization
  FillChar(LogFile, sizeof(TFileRec), 0);
  TTextRec(LogFile).Mode := fmClosed;

  LogFilename:=GetEnvironmentVariable(EnvVarLogFilename);
  if LogFilename='' then
    LogFilename:=LOG_FILENAME
  else
    Application.MessageBox(PChar(Format(EnvVarFound, [EnvVarLogFilename])), EnvVarFoundTitle, MB_TASKMODAL or MB_ICONINFORMATION or MB_OK);

  LogPatchname:=GetEnvironmentVariable(EnvVarLogLevel); //Note: We abusing variable LogPatchname here, so we don't have to allocate a separate String.
  if LogPatchname='' then
    LogLevel:=DefaultLogLevel
  else
  begin
    Application.MessageBox(PChar(Format(EnvVarFound, [EnvVarLogLevel])), EnvVarFoundTitle, MB_TASKMODAL or MB_ICONINFORMATION or MB_OK);
    LogLevel:=StrToUIntDef(LogPatchname, DefaultLogLevel);
  end;

  LogPatchname:=GetEnvironmentVariable(EnvVarLogPatchname);
  if LogPatchname='' then
    LogPatchname:=LOG_PATCHFILE
  else
    Application.MessageBox(PChar(Format(EnvVarFound, [EnvVarLogPatchname])), EnvVarFoundTitle, MB_TASKMODAL or MB_ICONINFORMATION or MB_OK);

finalization
  CloseLogFile;
  if Assigned(LogCache) then
    FreeAndNil(LogCache);
end.
