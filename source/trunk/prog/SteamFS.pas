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
unit SteamFS;

interface

uses Windows, Classes;

function RunSteam: Boolean;
function RunSteamExtractor(const Filename : String) : Boolean;
function GetSteamCacheDir : String;

 {------------------------}

implementation

uses ShellAPI, SysUtils, StrUtils, Quarkx, Game, Setup, Logging, SystemDetails,
     QkObjects, ExtraFunctionality, ApplPaths, QkExceptions, QkFileObjects;

const
  QSASDelay: DWORD = 30000; //How long (in ms) to wait for QSAS to run

var
  CheckQuArKSAS: Boolean = true;

//FIXME: Not used anymore... More somewhere else?
function DoFileOperation(const FilesFrom, FilesTo: TStringList; Operation: UINT; FileOpFlags: FILEOP_FLAGS): Boolean;

  //This helper function is missing in Delphi:
  function ConvertTStringListToCZZSTR(const Files: TStringList): PChar;
  var
    Dest: PChar;
    I: Integer;
    TotalLength: Integer;
  begin
    TotalLength := 1; //The second null of the double null terminator.
    for I:=0 to Files.Count-1 do
      Inc(TotalLength, Length(Files[I]) + 1); //Don't forget the null terminator.
    GetMem(Result, TotalLength * SizeOf(Char));
    Dest:=Result;
    for I:=0 to Files.Count-1 do
    begin
      StrCopy(Dest, PChar(Files[I]));
      Inc(Dest, Length(Files[I])+1);
    end;
    StrCopy(Dest, PChar('')); //Create the double null-termination = empty string at the end
  end;

var
  PFilesFrom, PFilesTo: Pointer;
  FileOp: TSHFileOpStruct;
begin
  Result:=False;
  PFilesFrom:=nil;
  PFilesTo:=nil;
  try
    if (FilesFrom<>nil) and (FilesFrom.Count > 0) then
      PFilesFrom:=ConvertTStringListToCZZSTR(FilesFrom)
    else
      PFilesFrom := nil;
    if (FilesTo<>nil) and (FilesTo.Count > 0) then
      PFilesTo:=ConvertTStringListToCZZSTR(FilesTo)
    else
      PFilesTo := nil;
    FillChar(FileOp, SizeOf(FileOp), 0);
    FileOp.wFunc := Operation;
    FileOp.pFrom := PFilesFrom;
    FileOp.pTo := PFilesTo;
    FileOp.fFlags := FileOpFlags;
    if SHFileOperation(FileOp) <> 0 then
      Log(LOG_WARNING, LoadStr1(5891), ['DoFileOperation'])
    else
    begin
      if FileOp.fAnyOperationsAborted = False then
        Result:=True
      else
        Log(LOG_WARNING, LoadStr1(5892), ['DoFileOperation']);
    end;
  finally
    if PFilesTo <> nil then
      FreeMem(PFilesTo);
    if PFilesFrom <> nil then
      FreeMem(PFilesFrom);
  end;
end;

function GetSteamCacheDir : String;
begin
  Result := ConcatPaths([ExtractFilePath(MakeTempFileName('QuArKSAS')), 'QuArKSAS']);
end;

function RunSteam: Boolean;
var
  Setup: QObject;
  SteamEXEFullPath: String;
  SteamStartupInfo: StartUpInfo;
  SteamProcessInformation: Process_Information;
begin
  Setup := SetupSubSet(ssGames, 'Steam');
  SteamEXEFullPath := ConcatPaths([QuickResolveFilename(Setup.Specifics.Strings['Directory']), Setup.Specifics.Strings['SteamEXEName']]);
  Result := ProcessExists(SteamEXEFullPath);
  if (not Result) and (Setup.Specifics.Strings['Autostart']='1') then
  begin
    FillChar(SteamStartupInfo, SizeOf(SteamStartupInfo), 0);
    FillChar(SteamProcessInformation, SizeOf(SteamProcessInformation), 0);
    SteamStartupInfo.cb:=SizeOf(SteamStartupInfo);
    if CreateProcess(nil, PChar(SteamEXEFullPath), nil, nil, false, 0, nil, nil, SteamStartupInfo, SteamProcessInformation)=false then
    begin
      LogWindowsError(GetLastError(), 'CreateProcess(Steam)');
      Exit;
    end;
    CloseHandle(SteamProcessInformation.hThread);
    WaitForInputIdle(SteamProcessInformation.hProcess, INFINITE);
    CloseHandle(SteamProcessInformation.hProcess);
    Result := true;
  end;
end;

//This function uses QuArKSAS to extract files from Steam
function RunSteamExtractor(const Filename : String) : Boolean;
var
  Setup: QObject;
  SteamCompiler: String;
  GameIDDir: String;
  FullFilename: String;
  TmpDirectory: String;
  QuArKSASEXE: String;
  QSASFile, QSASPath, QSASCommandline, QSASAdditionalParameters: String;
  QSASStartupInfo: StartUpInfo;
  QSASProcessInformation: Process_Information;
  I: Integer;
begin
  Result:=False;

  Setup:=SetupSubSet(ssGames, 'Steam');

  if not (Setup.Specifics.Strings['UseQuArKSAS'] <> '') then
  begin
    //Don't use QuArKSAS
    Exit;
  end;

  SteamCompiler:=GetSteamCompiler;
  if (SteamCompiler = 'old') or (SteamCompiler = 'source2006') then
  begin
    if (SteamCompiler = 'old') then
      QuArKSASEXE := Setup.Specifics.Strings['QuArKSASEXENameOld']
    else
      QuArKSASEXE := Setup.Specifics.Strings['QuArKSASEXENameSource2006'];
    FullFilename := ConvertPath(FileName);
    I := Pos(PathDelim, FullFilename);
    if (I > 0) then
    begin
      GameIDDir := LeftStr(FullFilename, I-1);
      FullFileName := RightStr(FullFilename, Length(FullFilename) - I);
    end
    else
    begin
      GameIDDir := '';
      FullFileName := Filename;
    end;
  end
  else if (SteamCompiler = 'source2007') then
  begin
    QuArKSASEXE := Setup.Specifics.Strings['QuArKSASEXENameSource2007'];
    GameIDDir := '';
    FullFileName := FileName;
  end
  else if (SteamCompiler = 'source2009') then
  begin
    QuArKSASEXE := Setup.Specifics.Strings['QuArKSASEXENameSource2009'];
    GameIDDir := '';
    FullFileName := FileName;
  end
  else //Includes orangebox and maybe Source2013
  begin
    QuArKSASEXE := Setup.Specifics.Strings['QuArKSASEXENameOrangebox'];
    GameIDDir := '';
    FullFileName := FileName;
  end;

  if QuArKSASEXE='' then
  begin
    Log(LOG_WARNING, LoadStr1(5893), ['QuArKSAS.exe']);
    QuArKSASEXE:='QuArKSAS.exe';
  end;

  //Copy QSAS if it's not in the Steam directory yet
  QSASPath := QuickResolveFilename(SourceSDKDir);
  QSASFile := ConcatPaths([QSASPath, QuArKSASEXE]);
  if CheckQuArKSAS then
  begin

    //FIXME: First check if the Steam path exists at all!

    if FileExists(ConcatPaths([GetQPath(pQuArKDll), QuArKSASEXE])) = false then
      LogAndRaiseError(FmtLoadStr1(5894, ['dlls/'+QuArKSASEXE]));
    if FileExists(QSASFile) = false then
    begin
      if CopyFile(PChar(ConcatPaths([GetQPath(pQuArKDll), QuArKSASEXE])), PChar(QSASFile), true) = false then
        LogAndRaiseError(FmtLoadStr1(5895, ['CopyFile']));
    end;

    //Make sure its the same version
    if CompareFiles(ConcatPaths([GetQPath(pQuArKDll), QuArKSASEXE]), QSASFile) then
    begin
      //Files do not match. The one in dlls is probably the most current one,
      //so let's update the Steam one.
      if CopyFile(PChar(ConcatPaths([GetQPath(pQuArKDll), QuArKSASEXE])), PChar(QSASFile), false) = false then
        LogAndRaiseError(FmtLoadStr1(5895, ['CopyFile']));
    end;

    CheckQuArKSAS:=false;
  end;

  TmpDirectory:=GetSteamCacheDir;
  if DirectoryExists(TmpDirectory) = false then
    if CreateDir(TmpDirectory) = false then
      LogAndRaiseError(LoadStr1(5896));

  //Note: No trailing slashes in paths allowed for QuArKSAS!
  QSASCommandLine:=Format('%s -g %s -gamedir "%s" -o "%s" -overwrite', [QSASFile, SteamAppID, ExcludeTrailingPathDelimiter(GetSteamBaseDir), TmpDirectory]);
  QSASAdditionalParameters:=Setup.Specifics.Strings['ExtractorParameters'];
  if Length(QSASAdditionalParameters)<>0 then
    QSASCommandLine:=QSASCommandLine+' '+QSASAdditionalParameters;
  QSASCommandLine:=QSASCommandLine+' '+FullFilename; //FIXME: Need to quote/escape FullFilename?

  Log(LOG_VERBOSE, 'Now calling: %s', [QSASCommandLine]);
  FillChar(QSASStartupInfo, SizeOf(QSASStartupInfo), 0);
  FillChar(QSASProcessInformation, SizeOf(QSASProcessInformation), 0);
  QSASStartupInfo.cb:=SizeOf(QSASStartupInfo);
  QSASStartupInfo.dwFlags:=STARTF_USESHOWWINDOW;
  QSASStartupInfo.wShowWindow:=SW_SHOWMINNOACTIVE;
  if CreateProcess(nil, PChar(QSASCommandLine), nil, nil, false, 0, nil, PChar(QSASPath), QSASStartupInfo, QSASProcessInformation)=false then
    LogAndRaiseError(FmtLoadStr1(5895, ['CreateProcess']));
  try
    CloseHandle(QSASProcessInformation.hThread);

    //DanielPharos: Waiting for INFINITE is rather dangerous, so let's wait only a certain amount of seconds
    if WaitForSingleObject(QSASProcessInformation.hProcess, QSASDelay)=WAIT_FAILED then
      LogAndRaiseError(FmtLoadStr1(5895, ['WaitForSingleObject']));
  finally
    CloseHandle(QSASProcessInformation.hProcess);
  end;
  Result:=True;
end;

end.

