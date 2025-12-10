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
unit MemTester;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, Windows;

{$IFDEF Debug}
{.$DEFINE MemResourceViewer}
{.$DEFINE MemHeavyListings} //Do not activate if MemTesterPassthrough is defined!
{.$DEFINE MemTrackAddress} //Don't forget to set your BREAKPOINT below!
{$ELSE}
//By default, only use this in Debug
{$DEFINE MemTesterPassthrough}
{$ENDIF}

procedure MemTesting(H: HWnd);
function HeavyMemDump: String;

implementation

uses SysUtils;

type
  //The memory manager switches from Integer to NativeInt in Delphi XE2. Let's make a type to keep our code readable.
{$IFDEF DelphiXE2orNewerCompiler}
  SizeT = NativeInt;
  PSizeT = PNativeInt;
{$ELSE}
  SizeT = Integer;
  PSizeT = PInteger;
{$ENDIF}

{$IFDEF MemTrackAddress}
const
 TrackMemoryAddress1 = SizeT($019e0000);
 TrackMemoryAddress2 = SizeT($02020000);
 TrackMemorySize     = SizeT(644);
{$ENDIF}

var
 OldMemMgr: TMemoryManager;
 GetMemCount: Integer;
 FreeMemCount: Integer;
 {$IFNDEF MemTesterPassthrough}
 AllocatedMemSize: SizeT;
 {$ENDIF}

{$OPTIMIZATION OFF}

{$IFNDEF MemTesterPassthrough}
const
 Signature1 = LongWord($89D128BA); //Prepend
 Signature2 = LongWord($3C66336C); //Append1
 Signature3 = LongWord($FFFFFFFF); //Append2
 {$IFDEF MemHeavyListings}
 FreedSizeTag = SizeT($12345678); //Overwrites Size
 {$ENDIF}
 FreedMemoryTag = LongWord($BADF00D); //Corrupt the freed data with an obvious value (assumes >=8Bytes allocation!)
{$ENDIF}

{$IFDEF MemHeavyListings}
type
 PPointer = ^Pointer;
var
 FullLinkedList: Pointer = Nil;
 FullListSize: Integer = 0;
{$ENDIF}

function NewGetMem(Size: SizeT): Pointer;
begin
  if (Size<=0) or (Size>=$2000000) then
   Raise Exception.CreateFmt('Very bad internal error [GetMem %x]', [Size]);
  Inc(GetMemCount);
  Result := OldMemMgr.GetMem(Size + SizeOf(SizeT) + 3*SizeOf(LongWord){$IFDEF MemHeavyListings} + SizeOf(Pointer){$ENDIF});
  {$IFNDEF MemTesterPassthrough}
  PSizeT(Result)^:=Size;
  Inc(PSizeT(Result));
  PLongWord(PByte(Result))^:=Signature1;
  Inc(PLongWord(Result));
  PLongWord(PArithByte(Result)+Size)^:=Signature2;
  PLongWord(PArithByte(Result)+Size+SizeOf(LongWord))^:=Signature3;
  {$IFDEF MemHeavyListings}
  PPointer(PArithByte(Result)+Size+2*SizeOf(LongWord))^:=FullLinkedList;
  FullLinkedList:=Result;
  Inc(FullListSize);
  {$ENDIF}
  Inc(AllocatedMemSize, Size);
  {$IFDEF MemTrackAddress}
  if (Size=TrackMemorySize) and (SizeT(Result)>=TrackMemoryAddress1) and (SizeT(Result)<TrackMemoryAddress2) then
   Result:=Nil;    { BREAKPOINT }
  {$ENDIF}
  {$ENDIF}
end;

function NewFreeMem(P: Pointer): Integer;
{$IFNDEF MemTesterPassthrough}
var
  OldSize: SizeT;
{$ENDIF}
begin
  Inc(FreeMemCount);
  {$IFNDEF MemTesterPassthrough}
  Dec(PByte(P), SizeOf(SizeT) + SizeOf(LongWord));
  OldSize:=PSizeT(P)^;
  if (OldSize<=0) or (OldSize>=$2000000)
  or (PLongWord(PArithByte(P)+SizeOf(SizeT))^<>Signature1)
  or (PLongWord(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+OldSize)^<>Signature2)
  or (PLongWord(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+OldSize+SizeOf(LongWord))^<>Signature3) then
   Raise Exception.CreateFmt('Very bad internal error [FreeMem %x]', [OldSize]);
  {$IFDEF MemHeavyListings}
  PSizeT(P)^:=FreedSizeTag;
  {$ENDIF}
  PLongWord(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+4)^:=FreedMemoryTag;
  Dec(AllocatedMemSize, OldSize);
  {$IFDEF MemHeavyListings}
  PInteger(PArithByte(P)+SizeOf(SizeT))^:=PInteger(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+OldSize+2*SizeOf(LongWord))^;
  Dec(FullListSize);
  Result := 0;
  {$ELSE}
  Result := OldMemMgr.FreeMem(P);
  {$ENDIF}
  {$ELSE}
  Result := OldMemMgr.FreeMem(P);
  {$ENDIF}
end;

function NewReallocMem(P: Pointer; Size: SizeT): Pointer;
{$IFNDEF MemTesterPassthrough}
var
 OldSize: SizeT;
{$ENDIF}
begin
  {$IFNDEF MemTesterPassthrough}
  Dec(PByte(P), SizeOf(SizeT) + SizeOf(LongWord));
  OldSize:=PSizeT(P)^;
  if (OldSize<=0) or (OldSize>=$2000000)
  or (PLongWord(PArithByte(P)+SizeOf(SizeT))^<>Signature1)
  or (PLongWord(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+OldSize)^<>Signature2)
  or (PLongWord(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+OldSize+SizeOf(LongWord))^<>Signature3) then
   Raise Exception.CreateFmt('Very bad internal error [ReallocMem %d]', [OldSize]);
  {$IFDEF MemHeavyListings}
  Inc(PByte(P), SizeOf(SizeT) + SizeOf(LongWord));
  if Size<=OldSize then
   begin
    Result:=P;
    Exit;
   end;
  Result:=NewGetMem(Size);
  Move(PByte(P)^, PByte(Result)^, OldSize);
  NewFreeMem(P);
  {$ELSE}
  Inc(AllocatedMemSize, Size-OldSize);
  Result := OldMemMgr.ReallocMem(P, SizeOf(SizeT)+SizeOf(LongWord)+Size+2*SizeOf(LongWord));
  PSizeT(Result)^:=Size;
  PLongWord(PArithByte(Result)+SizeOf(SizeT))^:=Signature1;
  Inc(PByte(Result), SizeOf(SizeT)+SizeOf(LongWord));
  PLongWord(PArithByte(Result)+Size)^:=Signature2;
  PLongWord(PArithByte(Result)+Size+SizeOf(LongWord))^:=Signature3;
  {$ENDIF}
  {$ELSE}
  Result := OldMemMgr.ReallocMem(P, Size);
  {$ENDIF}
end;

{$IFDEF MemHeavyListings}
const
{$IFDEF CPU16BITS}
  HeavyMemDumpFormatStr = '%04x %5d'#13#10;
  HeavyMemDumpFormatStrLen = 19;
{$ENDIF}
{$IFDEF CPU32BITS}
  HeavyMemDumpFormatStr = '%08x %10d'#13#10;
  HeavyMemDumpFormatStrLen = 21;
{$ENDIF}
{$IFDEF CPU64BITS}
  HeavyMemDumpFormatStr = '%016x %20d'#13#10;
  HeavyMemDumpFormatStrLen = 39;
{$ENDIF}

function HeavyMemDump: String;
var
 P: Pointer;
 OldSize, Count: Integer;
 Q: PChar;
 Args: array[0..SizeOf(Pointer)+SizeOf(SizeT)-1] of Byte;
begin
 P:=FullLinkedList;
 Count:=FullListSize;
 SetLength(Result, Count*HeavyMemDumpFormatStrLen);
 Q:=PChar(Result);
 while Assigned(P) do
  begin
   Dec(PByte(P), SizeOf(SizeT)+SizeOf(LongWord));
   OldSize:=PSizeT(P)^;
   if OldSize<>FreedSizeTag then
    begin
     if Count=0 then Raise Exception.Create('HeavyMemDump: Count<0');
     Dec(Count);
     PPointer(@Args[0])^ := P;
     PSizeT(@Args[SizeOf(Pointer)])^ := OldSize;
     wvsprintf(Q, HeavyMemDumpFormatStr, @Args);
     Inc(Q, HeavyMemDumpFormatStrLen);
     P:=PPointer(PArithByte(P)+SizeOf(SizeT)+SizeOf(LongWord)+OldSize+2*SizeOf(LongWord))^;
    end
   else
    P:=PPointer(PArithByte(P)+SizeOf(SizeT))^;
  end;
 if Count>0 then Raise Exception.Create('HeavyMemDump: Count>0');
end;
{$ELSE}
function HeavyMemDump: String;
begin
 Result:='';
end;
{$ENDIF}

{$IFDEF MemResourceViewer}
procedure MemTesting(H: HWnd);
var
 S: String;
 DC: HDC;
 OldMode: UINT;
 R: TRect;
begin
 GetWindowRect(H, R);
 S:=Format('<%d blocks, %.2f Kb>', [GetMemCount-FreeMemCount, AllocatedMemSize/1024]);
 DC:=GetWindowDC(H);
 try
  OldMode:=SetTextAlign(DC, TA_TOP or TA_RIGHT);
  TextOut(DC, R.Right-R.Left-60,5, PChar(S), Length(S));
  SetTextAlign(DC, OldMode);
 finally
  ReleaseDC(H, DC);
 end;
end;
(*procedure MemTesting(H: HWnd);
var
 Buffer: array[0..255] of Char;
 I: Integer;
 S: String;
 Diff: Boolean;
 Src: PChar;
begin
 S:=Format(' <%d blocks, %.2f Kb>', [GetMemCount-FreeMemCount, AllocatedMemSize/1024]);
 I:=GetWindowText(H, Buffer, SizeOf(Buffer));
 if (I>0) and (Buffer[I-1]='>') then
  begin
   Dec(I,3);
   while (I>0) and (Buffer[I+1]<>'<') do
    Dec(I);
  end;
 Diff:=False;
 Src:=PChar(S);
 repeat
  if Src^<>Buffer[I] then
   begin
    Buffer[I]:=Src^;
    Diff:=True;
   end;
  if Src^=#0 then Break;
  Inc(Src);
  Inc(I);
 until False;
 if Diff then
  SetWindowText(H, Buffer);
end;*)
{$ELSE}
procedure MemTesting(H: HWnd);
begin
end;
{$ENDIF}

 {------------------------}

const
  NewMemMgr: TMemoryManager = (
  GetMem: NewGetMem;
  FreeMem: NewFreeMem;
  ReallocMem: NewReallocMem);

procedure ReportDiff;
var
  Z: Array[0..127] of Char;
begin
  StrPCopy(Z, Format('Memory leaked! Please report: %d %d.', [GetMemCount, FreeMemCount]));
  MessageBox(0, Z, 'MemTester', mb_Ok);
end;

{$IFDEF MemHeavyListings}
procedure ReportHeavyListings;
var
  S: String;
begin
  S:=HeavyMemDump();
  if S<>'' then
    MessageBox(0, PChar(S), 'MemTester', mb_Ok);
end;
{$ENDIF}

initialization
  GetMemoryManager(OldMemMgr);
  SetMemoryManager(NewMemMgr);
finalization
  if GetMemCount-FreeMemCount <> 0 then
    ReportDiff();
  {$IFDEF MemHeavyListings}
  ReportHeavyListings();
  {$ENDIF}
  {$IFNDEF CompiledWithDelphi2}
  SetMemoryManager(OldMemMgr);
  {$ENDIF}
end.
