unit D6CheckWin32VersionFix;

// The patch fixes CheckWin32Version routine.

{$IFNDEF VER140}
//'This patch is intended for Delphi 6 only';
{$ENDIF}

interface

procedure PatchCheckWin32Version; //DanielPharos: We will run this ourselves when needed.

implementation

uses
  Windows, SysUtils;

resourcestring
  RsPatchingFailed = 'CheckWin32Version patching failed.';

type
  TPatchResult = (prNotNeeded, prOk, prError);

function PatchCode(RoutineStartAddr: Pointer; PatchOffset: Cardinal; OriginalCode: Pointer;
  OriginalCodeLen: Integer; PatchedCode: Pointer; PatchedCodeLen: Cardinal): TPatchResult;
const
  JmpOpCode = $25FF;
type
  PPackageThunk = ^TPackageThunk;
  TPackageThunk = packed record
    JmpInstruction: Word;
    JmpAddress: PPointer;
  end;
var
  CodeStart: Pointer;
  BytesWritten: DWORD;
begin
  if FindClassHInstance(System.TObject) <> HInstance then
    with PPackageThunk(RoutineStartAddr)^ do
      if JmpInstruction = JmpOpCode then
        RoutineStartAddr := JmpAddress^
      else
      begin
        Result := prError;
        Exit;
      end;
  CodeStart := Pointer(LongWord(RoutineStartAddr) + PatchOffset);
  if CompareMem(CodeStart, OriginalCode, OriginalCodeLen) then
  begin
    if WriteProcessMemory(GetCurrentProcess, CodeStart, PatchedCode, PatchedCodeLen, BytesWritten) and
      (BytesWritten = PatchedCodeLen) then
    begin
      FlushInstructionCache(GetCurrentProcess, CodeStart, PatchedCodeLen);
      Result := prOk;
    end
    else
      Result := prError;
  end
  else
    Result := prNotNeeded;
end;

function AddrOfCheckWin32Version: Pointer;
begin
  Result := @CheckWin32Version;
end;

procedure PatchCheckWin32Version;
const
  OriginalCode1: Cardinal = $C033037D; // JNL  +$03
  PatchedCode1: Cardinal  = $C033037E; // JLE  +$03
  PatchOffset1 = $16;
  OriginalCode2: Cardinal = $053B137F; // JNLE +$13
  PatchedCode2: Cardinal  = $053B137C; // JL   +$13
  PatchOffset2 = $06;
var
  PatchResult: TPatchResult;
begin
  PatchResult := PatchCode(AddrOfCheckWin32Version, PatchOffset1, @OriginalCode1, SizeOf(OriginalCode1),
    @PatchedCode1, SizeOf(PatchedCode1));
  if PatchResult = prOk then
    PatchResult := PatchCode(AddrOfCheckWin32Version, PatchOffset2, @OriginalCode2, SizeOf(OriginalCode2),
      @PatchedCode2, SizeOf(PatchedCode2));
  case PatchResult of
    prError:
      begin
        if IsConsole then
          WriteLn(ErrOutput, RsPatchingFailed)
        else
          MessageBox(0, PChar(RsPatchingFailed), nil, MB_OK or MB_ICONSTOP or MB_TASKMODAL);
        RunError(1);
      end;
  end;
end;

initialization
  //PatchCheckWin32Version; //DanielPharos: We will run this ourselves when needed.

end.
