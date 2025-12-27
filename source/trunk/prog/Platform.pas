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
unit Platform;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat{$IFDEF MSWINDOWS}, Windows{$ENDIF};

function ProcessExists(const exeFileName: String): Boolean;
function WindowExists(const WindowName: String): Boolean;
{$IFDEF MSWINDOWS}
function RetrieveModuleFilename(ModuleHandle: HMODULE): String;
{$ENDIF}

type
  TSoundType = (SOUND_DEFAULT, SOUND_INFO, SOUND_QUESTION, SOUND_WARNING, SOUND_ERROR);

function PlaySound(const SoundType: TSoundType): Boolean;
function SaveRecentFiles: Boolean;
function SaveWindowPositions: Boolean;

function SwapEndian8(const Value: UInt8): UInt8; register;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function SwapEndian16(const Value: UInt16): UInt16; register;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function SwapEndian32(const Value: UInt32): UInt32; register;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function SwapEndian64(const Value: UInt64): UInt64; register;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}

function BigEndianToPlatformEndianness(const Value: UInt8): UInt8; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function BigEndianToPlatformEndianness(const Value: UInt16): UInt16; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function BigEndianToPlatformEndianness(const Value: UInt32): UInt32; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function BigEndianToPlatformEndianness(const Value: UInt64): UInt64; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function LittleEndianToPlatformEndianness(const Value: UInt8): UInt8; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function LittleEndianToPlatformEndianness(const Value: UInt16): UInt16; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function LittleEndianToPlatformEndianness(const Value: UInt32): UInt32; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
function LittleEndianToPlatformEndianness(const Value: UInt64): UInt64; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
//Note: Swapping endianness on a UInt8 is a no-op, but provided for consistency.

implementation

uses SysUtils, {$IFNDEF LINUX}ShlObj{$ENDIF}, TlHelp32, {$IFDEF Delphi5orNewerCompiler}Psapi, {$ENDIF}SystemDetails, QkExceptions;

function ProcessExists(const exeFileName: String): Boolean;
var
  ContinueLoop: BOOL;
  FSnapshotHandle, FSnapshotHandle2: THandle;
  FProcessEntry32: TProcessEntry32;
  FModuleEntry32: TModuleEntry32;
  ProcessNumber: Integer;
  ProcessSize, BytesReturned: DWORD;
  ProcessList, ProcessList2: PDWORD;
  ProcessHandle: THandle;
  ProcessModule: HMODULE;
  SizeNeeded: DWORD;
  ProcessName: String;
  ProcessNameBuffer: PChar;
  ProcessNameBufferSize: Cardinal;
  RealProcessNameSize: Cardinal;
  I: Integer;
begin
  Result := False;
  if GetPlatformType=osWin95Comp then
  begin
    FSnapshotHandle := CreateToolhelp32Snapshot(TH32CS_SNAPPROCESS, 0);
    if FSnapshotHandle = INVALID_HANDLE_VALUE then
      LogAndRaiseLastOSError('Unable to retrieve process information!');
    try
      FProcessEntry32.dwSize := SizeOf(FProcessEntry32);
      ContinueLoop := Process32First(FSnapshotHandle, FProcessEntry32);
      while ContinueLoop <> false do
      begin
        if SameFileName(ExtractFilename(StrPas(FProcessEntry32.szExeFile)), ExtractFilename(exeFileName)) then
        begin
          FSnapshotHandle2 := CreateToolhelp32Snapshot(TH32CS_SNAPMODULE, FProcessEntry32.th32ProcessID);
          if FSnapshotHandle2 = INVALID_HANDLE_VALUE then
            LogAndRaiseLastOSError('Unable to retrieve process information!');
          try
            FModuleEntry32.dwSize := SizeOf(FModuleEntry32);
            Module32First(FSnapshotHandle2, FModuleEntry32);
            if SameFileName(StrPas(FModuleEntry32.szExePath), ExeFileName) then
            begin
              Result := True;
              break;
            end;
          finally
            CloseHandle(FSnapshotHandle2);
          end;
        end;
        ContinueLoop := Process32Next(FSnapshotHandle, FProcessEntry32);
      end;
    finally
      CloseHandle(FSnapshotHandle);
    end;
  end
  else
  begin
    ProcessNumber := 16;
    GetMem(ProcessList, ProcessNumber * SizeOf(DWORD));
    try
      repeat
        ProcessNumber := ProcessNumber * 2;
        ReallocMem(ProcessList, ProcessNumber * SizeOf(DWORD));
        BytesReturned := 0;
        ProcessSize := ProcessNumber * SizeOf(DWORD);
        if EnumProcesses(ProcessList, ProcessSize, BytesReturned) = false then
          LogAndRaiseLastOSError('Unable to enumerate processes!');
      until BytesReturned < ProcessSize;
      ProcessNumber := BytesReturned div SizeOf(DWORD);
      ProcessList2 := ProcessList;
      for I:=0 to ProcessNumber-1 do
      begin
        ProcessHandle := OpenProcess(PROCESS_QUERY_INFORMATION or PROCESS_VM_READ, False, ProcessList2^);
        if ProcessHandle <> 0 then
        begin
          try
            if EnumProcessModules(ProcessHandle, @ProcessModule, SizeOf(ProcessModule), SizeNeeded) <> false then
            begin
              ProcessNameBufferSize := 128;
              GetMem(ProcessNameBuffer, ProcessNameBufferSize * SizeOf(Char));
              try
                repeat
                  ProcessNameBufferSize := ProcessNameBufferSize * 2;
                  ReallocMem(ProcessNameBuffer, ProcessNameBufferSize * SizeOf(Char));
                  RealProcessNameSize := GetModuleFileNameEx(ProcessHandle, ProcessModule, ProcessNameBuffer, ProcessNameBufferSize);
                until RealProcessNameSize < ProcessNameBufferSize;
                if RealProcessNameSize > 0 then
                begin
                  SetString(ProcessName, ProcessNameBuffer, RealProcessNameSize);
                  if SameFileName(ProcessName, exeFileName) then
                  begin
                    Result:=True;
                    break;
                  end;
                end;
              finally
                FreeMem(ProcessNameBuffer);
              end;
            end;
          finally
            CloseHandle(ProcessHandle);
          end;
        end;
        Inc(ProcessList2);
      end;
    finally
      FreeMem(ProcessList);
    end;
  end;
end;

function WindowExists(const WindowName: String): Boolean;
var
  FoundWindow: HWND;
begin
  FoundWindow:=FindWindow(nil, PChar(WindowName));
  if FoundWindow<>0 then
    Result := True
  else
    Result := False;
end;

function RetrieveModuleFilename(ModuleHandle: HMODULE) : String;
var
  Path: LPTSTR;
begin
  Path:=StrAlloc(MAX_PATH+1);
  try
    Path[MAX_PATH]:=#0; //GetModuleFileName might return a not null-terminated, truncated string
    if GetModuleFileName(ModuleHandle, Path, MAX_PATH) = 0 then
      LogAndRaiseLastOSError('Unable to retrieve filename of a module!');
    Result := StrPas(Path);
  finally
    StrDispose(Path);
  end;
end;

function PlaySound(const SoundType: TSoundType): Boolean;
{$IFNDEF LINUX}
var
  uType: UINT;
{$ENDIF}
begin
  {$IFDEF LINUX}
  Beep;
  Result:=True;
  {$ELSE}
  case SoundType of
  SOUND_DEFAULT: uType:=MB_OK;
  SOUND_INFO: uType:=MB_ICONINFORMATION;
  SOUND_QUESTION: uType:=MB_ICONQUESTION;
  SOUND_WARNING: uType:=MB_ICONWARNING;
  SOUND_ERROR: uType:=MB_ICONERROR;
  else raise InternalE('Unknown SoundType');
  end;
  Result:=Windows.MessageBeep(uType);
  {$ENDIF}
end;

function SaveRecentFiles: Boolean;
begin
  {$IFDEF LINUX}
  Result:=True;
  {$ELSE}
  if DelayFunc_SHRestricted then
    Result:=(SHRestricted(REST_CLEARRECENTDOCSONEXIT) = 0)
  else
    Result:=True;
  {$ENDIF}
end;

function SaveWindowPositions: Boolean;
begin
  {$IFDEF LINUX}
  Result:=True;
  {$ELSE}
  if DelayFunc_SHRestricted then
    Result:=(SHRestricted(REST_NOSAVESET) = 0)
  else
    Result:=True;
  {$ENDIF}
end;


function BigEndianToPlatformEndianness(const Value: UInt8): UInt8;
begin
  {$IFDEF BIGENDIAN}
  Result := Value;
  {$ELSE}
  Result := SwapEndian8(Value);
  {$ENDIF}
end;

function BigEndianToPlatformEndianness(const Value: UInt16): UInt16;
begin
  {$IFDEF BIGENDIAN}
  Result := Value;
  {$ELSE}
  Result := SwapEndian16(Value);
  {$ENDIF}
end;

function BigEndianToPlatformEndianness(const Value: UInt32): UInt32;
begin
  {$IFDEF BIGENDIAN}
  Result := Value;
  {$ELSE}
  Result := SwapEndian32(Value);
  {$ENDIF}
end;

function BigEndianToPlatformEndianness(const Value: UInt64): UInt64;
begin
  {$IFDEF BIGENDIAN}
  Result := Value;
  {$ELSE}
  Result := SwapEndian64(Value);
  {$ENDIF}
end;

function LittleEndianToPlatformEndianness(const Value: UInt8): UInt8;
begin
  {$IFDEF BIGENDIAN}
  Result := SwapEndian8(Value);
  {$ELSE}
  Result := Value;
  {$ENDIF}
end;

function LittleEndianToPlatformEndianness(const Value: UInt16): UInt16;
begin
  {$IFDEF BIGENDIAN}
  Result := SwapEndian16(Value);
  {$ELSE}
  Result := Value;
  {$ENDIF}
end;

function LittleEndianToPlatformEndianness(const Value: UInt32): UInt32;
begin
  {$IFDEF BIGENDIAN}
  Result := SwapEndian32(Value);
  {$ELSE}
  Result := Value;
  {$ENDIF}
end;

function LittleEndianToPlatformEndianness(const Value: UInt64): UInt64;
begin
  {$IFDEF BIGENDIAN}
  Result := SwapEndian64(Value);
  {$ELSE}
  Result := Value;
  {$ENDIF}
end;

function SwapEndian8(const Value: UInt8): UInt8;
begin
  Result := Value;
end;

function SwapEndian16(const Value: UInt16): UInt16;
{$IFDEF CPUX86}
asm
  rol   ax, 8
end;
{$ELSE}
begin
  Result := Swap(Value);
end;
{$ENDIF}

//Based on: https://www.oreilly.com/library/view/delphi-in-a/1565926595/re314.html
//Combined with: https://stackoverflow.com/a/3065619
function SwapEndian32(const Value: UInt32): UInt32;
{$IFDEF CPUX86}
asm
  bswap eax
end;
{$ELSE}
begin
  Result := Swap(Value shr 16) or (Swap(Value) shl 16);
end;
{$ENDIF}

function SwapEndian64(const Value: UInt64): UInt64;
begin
  Result := UInt64(SwapEndian32(UInt32(Value))) shl 32 or SwapEndian32(UInt32(Value shr 32));
end;

end.
