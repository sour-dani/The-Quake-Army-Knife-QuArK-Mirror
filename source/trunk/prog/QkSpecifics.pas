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
unit QkSpecifics;

{$B-,R-,X+}

//Originally, QuArK used TStringList to store specifics internally. However,
//this causes problems when we switch to 64-bit and/or Unicode, as the string
//data format and the binary data format are no longer compatible. Older Delphi's
//don't have a convenient container type to handle this, so let's make our own.
//
//It is heavily inspired by TStringList, but we've stripped functionality
//we don't need.

interface

uses Classes;

{$I DelphiVer.inc}

resourcestring
  SListItemNotFoundError = 'Item not found (%s)';

type
  PSpecificsItem = ^TSpecificsItem;
  TSpecificsItem = record
    Key: String;
    Value: String;
  end;

const
  MaxSpecificsListSize = MaxInt div SizeOf(TSpecificsItem);

type
  PSpecificsItemList = ^TSpecificsItemList;
  TSpecificsItemList = array[0..MaxSpecificsListSize-1] of TSpecificsItem;

  TSpecificsList = class(TPersistent)
  private
    FList: PSpecificsItemList;
    FCount: Integer;
    FCapacity: Integer;
    function GetName(Index: Integer): string;
    procedure Grow;
    function GetBytes(const Name: string): string;
    function GetBytesFromIndex(Index: Integer): string;
    procedure SetBytes(const Name: string; const B: string);
    procedure SetBytesFromIndex(Index: Integer; const B: string);
    function GetFloat(const Name: string): Single;
    function GetFloatFromIndex(Index: Integer): Single;
    procedure SetFloat(const Name: string; const F: Single);
    procedure SetFloatFromIndex(Index: Integer; const F: Single);
    function GetInteger(const Name: string): Integer;
    function GetIntegerFromIndex(Index: Integer): Integer;
    procedure SetInteger(const Name: string; const I: Integer);
    procedure SetIntegerFromIndex(Index: Integer; const I: Integer);
    function GetString(const Name: string): string;
    function GetStringFromIndex(Index: Integer): string;
    procedure SetString(const Name: string; const S: string);
    procedure SetStringFromIndex(Index: Integer; const S: string);
  protected
    procedure Error(const Msg: string; Data: Integer); overload;
    procedure Error(const Msg: string; const Data: string); overload;
    procedure Error(Msg: PResStringRec; Data: Integer); overload;
    procedure Error(Msg: PResStringRec; const Data: string); overload;
    function Get(Index: Integer): TSpecificsItem;
    procedure Put(Index: Integer; const Item: TSpecificsItem);
    procedure SetCapacity(NewCapacity: Integer);
  public
    destructor Destroy; override;
    function Add(const Item: TSpecificsItem): Integer;
    function AddFloat(const Name: string; const F: Single): Integer;
    function AddInteger(const Name: string; const I: Integer): Integer;
    function AddString(const Name: string; const S: string): Integer;
    function AddStringFull(const Data: string): Integer; //FIXME: This function needs to be removed in the future
    procedure Assign(Source: TPersistent); override;
    procedure Clear;
    procedure Delete(const Name: string; raiseError: Boolean = false); overload;
    procedure Delete(Index: Integer); overload;
    function IndexOfName(const Name: string): Integer;
    procedure Insert(Index: Integer; const Item: TSpecificsItem);
    procedure InsertFloat(Index: Integer; const Name: string; const F: Single);
    procedure InsertInteger(Index: Integer; const Name: string; const I: Integer);
    procedure InsertString(Index: Integer; const Name: string; const S: string);
    function TryGetBytesDef(const Name: string; var B: string; const Default: string = {$IFDEF Delphi2005orNewerCompiler}Default(string){$ELSE}''{$ENDIF}): Boolean; //FIXME: No clue when this was added!
    function TryGetFloatsDef(const Name: string; var F: Single; const Default: Single = {$IFDEF Delphi2005orNewerCompiler}Default(Single){$ELSE}0.0{$ENDIF}): Boolean; //FIXME: No clue when this was added!
    function TryGetIntegersDef(const Name: string; var I: Integer; const Default: Integer = {$IFDEF Delphi2005orNewerCompiler}Default(Integer){$ELSE}0{$ENDIF}): Boolean; //FIXME: No clue when this was added!
    function TryGetStringsDef(const Name: string; var S: string; const Default: string = {$IFDEF Delphi2005orNewerCompiler}Default(string){$ELSE}''{$ENDIF}): Boolean; //FIXME: No clue when this was added!
    property Bytes[const Name: string]: string read GetBytes write SetBytes;
    property BytesFromIndex[Index: Integer]: string read GetBytesFromIndex write SetBytesFromIndex;
    property Count: Integer read FCount;
    property Floats[const Name: string]: Single read GetFloat write SetFloat;
    property FloatsFromIndex[Index: Integer]: Single read GetFloatFromIndex write SetFloatFromIndex;
    property Integers[const Name: string]: Integer read GetInteger write SetInteger;
    property IntegersFromIndex[Index: Integer]: Integer read GetIntegerFromIndex write SetIntegerFromIndex;
    property Items[Index: Integer]: TSpecificsItem read Get write Put; (*default;*)
    property Names[Index: Integer]: string read GetName;
    property Strings[const Name: string]: string read GetString write SetString;
    property StringsFromIndex[Index: Integer]: string read GetStringFromIndex write SetStringFromIndex;
  end;

 {------------------------}

implementation

uses RTLConsts, SysUtils;

destructor TSpecificsList.Destroy;
begin
  inherited Destroy;
  if FCount <> 0 then Finalize(FList^[0], FCount);
  FCount := 0;
  SetCapacity(0);
end;

function TSpecificsList.Add(const Item: TSpecificsItem): Integer;
begin
  Result := IndexOfName(Item.Key);
  if Result<0 then
    Result:=FCount;
  Insert(Result, Item);
end;

function TSpecificsList.AddFloat(const Name: string; const F: Single): Integer;
begin
  Result := IndexOfName(Name);
  if Result<0 then
    Result:=FCount;
  InsertFloat(Result, Name, F);
end;

function TSpecificsList.AddInteger(const Name: string; const I: Integer): Integer;
begin
  Result := IndexOfName(Name);
  if Result<0 then
    Result:=FCount;
  InsertInteger(Result, Name, I);
end;

function TSpecificsList.AddString(const Name: string; const S: string): Integer;
begin
  Result := IndexOfName(Name);
  if Result<0 then
    Result:=FCount;
  InsertString(Result, Name, S);
end;

function TSpecificsList.AddStringFull(const Data: string): Integer;
var
  P: Integer;
begin
  P := Pos('=', Data);
  if P = 0 then raise Exception.Create('Invalid string!');
  Result := AddString(Copy(Data, 0, P-1), Copy(Data, P+1, MaxInt));
end;

procedure TSpecificsList.Assign(Source: TPersistent);
var
  I: Integer;
begin
  if Source is TSpecificsList then
  begin
    Clear;
    for I := 0 to TSpecificsList(Source).Count - 1 do
      Add(TSpecificsList(Source).Items[I]);
    Exit;
  end;
  inherited Assign(Source);
end;

procedure TSpecificsList.Clear;
begin
  if FCount <> 0 then
  begin
    Finalize(FList^[0], FCount);
    FCount := 0;
    SetCapacity(0);
  end;
end;

procedure TSpecificsList.Delete(const Name: string; raiseError: Boolean);
var
  Index: Integer;
begin
  Index:=IndexOfName(Name);
  if Index<0 then
  begin
    if raiseError then
      Error(@SListIndexError, Index);
    Exit;
  end;
  Finalize(FList^[Index]);
  Dec(FCount);
  if Index < FCount then
    System.Move(FList^[Index + 1], FList^[Index],
      (FCount - Index) * SizeOf(TSpecificsItem));
end;

procedure TSpecificsList.Delete(Index: Integer);
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  Finalize(FList^[Index]);
  Dec(FCount);
  if Index < FCount then
    System.Move(FList^[Index + 1], FList^[Index],
      (FCount - Index) * SizeOf(TSpecificsItem));
end;

procedure TSpecificsList.Error(const Msg: string; Data: Integer);

  function ReturnAddr: Pointer;
  asm
          MOV     EAX,[EBP+4]
  end;

begin
  raise EStringListError.CreateFmt(Msg, [Data]) at ReturnAddr;
end;

procedure TSpecificsList.Error(const Msg: string; const Data: string);

  function ReturnAddr: Pointer;
  asm
          MOV     EAX,[EBP+4]
  end;

begin
  raise EStringListError.CreateFmt(Msg, [Data]) at ReturnAddr;
end;

procedure TSpecificsList.Error(Msg: PResStringRec; Data: Integer);
begin
  Error(LoadResString(Msg), Data);
end;

procedure TSpecificsList.Error(Msg: PResStringRec; const Data: string);
begin
  Error(LoadResString(Msg), Data);
end;

function TSpecificsList.Get(Index: Integer): TSpecificsItem;
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  Result := FList^[Index];
end;

function TSpecificsList.GetBytes(const Name: string): string;
begin
  //FIXME: For now, store the bytes in a string
  Result := GetString(Name);
end;

function TSpecificsList.GetBytesFromIndex(Index: Integer): string;
begin
  //FIXME: For now, store the bytes in a string
  Result := GetStringFromIndex(Index);
end;

(*function TSpecificsList.GetCapacity: Integer;
begin
  Result := FCapacity;
end;*)

(*function TSpecificsList.GetCount: Integer;
begin
  Result := FCount;
end;*)

function TSpecificsList.GetFloat(const Name: string): Single;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then Error(@SListItemNotFoundError, Name);
  Result := StrToFloat(FList^[Index].Value);
end;

function TSpecificsList.GetFloatFromIndex(Index: Integer): Single;
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  Result := StrToFloat(FList^[Index].Value);
end;

function TSpecificsList.GetInteger(const Name: string): Integer;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  //if (Index < 0) then Error(@SListItemNotFoundError, Name); //FIXME: This is a backwards compatibility thing!!!
  if (Index < 0) then begin Result:=0; Exit; end; //FIXME: This is a backwards compatibility thing!!!
  Result := StrToInt(FList^[Index].Value);
end;

function TSpecificsList.GetIntegerFromIndex(Index: Integer): Integer;
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  Result := StrToInt(FList^[Index].Value);
end;

function TSpecificsList.GetName(Index: Integer): string;
begin
  Result := Get(Index).Key;
end;

function TSpecificsList.GetString(const Name: string): string;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  //if (Index < 0) then Error(@SListItemNotFoundError, Name); //FIXME: This is a backwards compatibility thing!!!
  if (Index < 0) then begin Result:=''; Exit; end; //FIXME: This is a backwards compatibility thing!!!
  Result := FList^[Index].Value;
end;

function TSpecificsList.GetStringFromIndex(Index: Integer): string;
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  Result := FList^[Index].Value;
end;

procedure TSpecificsList.Grow;
var
  Delta: Integer;
begin
  if FCapacity > 64 then Delta := FCapacity div 4 else
    if FCapacity > 8 then Delta := 16 else
      Delta := 4;
  SetCapacity(FCapacity + Delta);
end;

function TSpecificsList.IndexOfName(const Name: string): Integer;
begin
  for Result := 0 to FCount - 1 do
    if CompareText(FList^[Result].Key, Name) = 0 then Exit;
  Result := -1;
end;

procedure TSpecificsList.Insert(Index: Integer; const Item: TSpecificsItem);
begin
  if (Index < 0) or (Index > FCount) then Error(@SListIndexError, Index); //Note: Index = FCount is allowed!
  if Index = FCount then
  begin
    if FCount = FCapacity then Grow;
    if Index < FCount then
      System.Move(FList^[Index], FList^[Index + 1],
        (FCount - Index) * SizeOf(TSpecificsItem));
    Inc(FCount);
    with FList^[Index] do
    begin
      Pointer(Key) := nil;
      Pointer(Value) := nil;
    end;
  end;
  FList^[Index]:=Item;
end;

procedure TSpecificsList.InsertFloat(Index: Integer; const Name: String; const F: Single);
begin
  if (Index < 0) or (Index > FCount) then Error(@SListIndexError, Index); //Note: Index = FCount is allowed!
  if Index = FCount then
  begin
    if FCount = FCapacity then Grow;
    if Index < FCount then
      System.Move(FList^[Index], FList^[Index + 1],
        (FCount - Index) * SizeOf(TSpecificsItem));
    Inc(FCount);
    with FList^[Index] do
    begin
      Pointer(Key) := nil;
      Pointer(Value) := nil;
      Key := Name;
    end;
  end;
  FList^[Index].Value := FloatToStr(F);
end;

procedure TSpecificsList.InsertInteger(Index: Integer; const Name: String; const I: Integer);
begin
  if (Index < 0) or (Index > FCount) then Error(@SListIndexError, Index); //Note: Index = FCount is allowed!
  if Index = FCount then
  begin
    if FCount = FCapacity then Grow;
    if Index < FCount then
      System.Move(FList^[Index], FList^[Index + 1],
        (FCount - Index) * SizeOf(TSpecificsItem));
    Inc(FCount);
    with FList^[Index] do
    begin
      Pointer(Key) := nil;
      Pointer(Value) := nil;
      Key := Name;
    end;
  end;
  FList^[Index].Value := IntToStr(I);
end;

procedure TSpecificsList.InsertString(Index: Integer; const Name: String; const S: string);
begin
  if (Index < 0) or (Index > FCount) then Error(@SListIndexError, Index); //Note: Index = FCount is allowed!
  if Index = FCount then
  begin
    if FCount = FCapacity then Grow;
    if Index < FCount then
      System.Move(FList^[Index], FList^[Index + 1],
        (FCount - Index) * SizeOf(TSpecificsItem));
    Inc(FCount);
    with FList^[Index] do
    begin
      Pointer(Key) := nil;
      Key := Name;
      Pointer(Value) := nil;
    end;
  end;
  FList^[Index].Value := S;
end;

procedure TSpecificsList.Put(Index: Integer; const Item: TSpecificsItem);
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  FList^[Index] := Item;
end;

procedure TSpecificsList.SetCapacity(NewCapacity: Integer);
begin
  ReallocMem(FList, NewCapacity * SizeOf(TSpecificsItem));
  FCapacity := NewCapacity;
end;

procedure TSpecificsList.SetBytes(const Name: string; const B: string);
begin
  //FIXME: For now, store the bytes in a string
  SetString(Name, B);
end;

procedure TSpecificsList.SetBytesFromIndex(Index: Integer; const B: string);
begin
  //FIXME: For now, store the bytes in a string
  SetStringFromIndex(Index, B);
end;

procedure TSpecificsList.SetFloat(const Name: string; const F: Single);
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
    AddString(Name, FloatToStr(F))
  else
    FList^[Index].Value := FloatToStr(F);
end;

procedure TSpecificsList.SetFloatFromIndex(Index: Integer; const F: Single);
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  FList^[Index].Value := FloatToStr(F);
end;

procedure TSpecificsList.SetInteger(const Name: string; const I: Integer);
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
    AddString(Name, IntToStr(I))
  else
    FList^[Index].Value := IntToStr(I);
end;

procedure TSpecificsList.SetIntegerFromIndex(Index: Integer; const I: Integer);
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  FList^[Index].Value := IntToStr(I);
end;

procedure TSpecificsList.SetString(const Name: string; const S: string);
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
    AddString(Name, S)
  else
    FList^[Index].Value := S;
end;

procedure TSpecificsList.SetStringFromIndex(Index: Integer; const S: string);
begin
  if (Index < 0) or (Index >= FCount) then Error(@SListIndexError, Index);
  FList^[Index].Value := S;
end;

function TSpecificsList.TryGetBytesDef(const Name: string; var B: string; const Default: string): Boolean;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
  begin
    Result := False;
    B := Default;
    //FIXME: Also add to list???
  end
  else
  begin
    Result := True;
    B := FList^[Index].Value;
  end;
end;

function TSpecificsList.TryGetFloatsDef(const Name: string; var F: Single; const Default: Single): Boolean;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
  begin
    Result := False;
    F := Default;
    //FIXME: Also add to list???
  end
  else
  begin
    Result := True;
    F := StrToFloat(FList^[Index].Value);
  end;
end;

function TSpecificsList.TryGetIntegersDef(const Name: string; var I: Integer; const Default: Integer): Boolean;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
  begin
    Result := False;
    I := Default;
    //FIXME: Also add to list???
  end
  else
  begin
    Result := True;
    I := StrToInt(FList^[Index].Value);
  end;
end;

function TSpecificsList.TryGetStringsDef(const Name: string; var S: string; const Default: string): Boolean;
var
  Index: Integer;
begin
  Index := IndexOfName(Name);
  if (Index < 0) then
  begin
    Result := False;
    S := Default;
    //FIXME: Also add to list???
  end
  else
  begin
    Result := True;
    S := FList^[Index].Value;
  end;
end;

 {------------------------}

end.
