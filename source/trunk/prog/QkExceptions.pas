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
unit QkExceptions;

interface

uses Windows, SysUtils, Classes, Controls, Dialogs, Forms, StdCtrls;

type
  TCustomExceptionHandler = class(TObject)
  private
    OldException: TExceptionEvent;
    procedure AppExceptionMore(Sender: TObject);
  public
    constructor Create;
    destructor Destroy; override;
    procedure AppException(Sender: TObject; E: Exception);
    function MessageException(const E: Exception; const Info: String; Buttons: TMsgDlgButtons) : TModalResult;
  end;

function GetExceptionMessage(E: Exception) : String;
procedure LogAndWarn(const WarnMessage : String);
procedure LogAndRaiseError(const ErrMessage : String);
function EError(Res: Integer) : Exception;
function EErrorFmt(Res: Integer; const Fmt: array of const) : Exception;
function InternalE(const Hint: String) : Exception;

procedure GlobalWarning(const Texte: String);
procedure GlobalDisplayWarnings;

function GetSystemErrorMessage(ErrNr: DWORD) : String;
procedure LogWindowsError(ErrNr: DWORD; const Call: String);

procedure InstallExceptProc;
procedure CustomExceptHandler(ExceptObject: TObject; ExceptAddr: Pointer);

var
  CustomExceptionHandler: TCustomExceptionHandler;

 {-------------------}

implementation

uses QConsts, TextBoxForm, Quarkx, Logging, ExtraFunctionality, Platform;

 {-------------------}

function GetExceptionMessage(E: Exception) : String;
var
 I: Integer;
 S: String;
begin
 Result:=E.Message;
{$IFDEF Debug}
 Exit;
{$ENDIF}
 I:=Pos('//', Result);
 if I>0 then
  begin
   S:=Copy(Result, I+2, MaxInt);
   Log(LOG_VERBOSE, 'GetExceptionMessage: %s', [S]);
   SetLength(Result, I);
   Result[I]:='.';
  end
 else
  Result:=Result+'.';
end;

procedure LogAndWarn(const WarnMessage : String);
begin
  Log(LOG_WARNING, WarnMessage);
  Application.MessageBox(PChar(WarnMessage), 'QuArK', MB_ICONEXCLAMATION or MB_OK);
end;

procedure LogAndRaiseError(const ErrMessage : String);
begin
  Log(LOG_CRITICAL, ErrMessage);
  Raise Exception.Create(ErrMessage);
end;

function EError(Res: Integer) : Exception;
begin
 PythonCodeEnd;
 EError:=Exception.Create(LoadStr1(Res));
end;

function EErrorFmt(Res: Integer; const Fmt: array of const) : Exception;
begin
 PythonCodeEnd;
 EErrorFmt:=Exception.Create(FmtLoadStr1(Res, Fmt));
end;

function InternalE(const Hint: String) : Exception;
begin
  Result:=EErrorFmt(5223, [Hint]);
end;

 {------------------------}

var
 GlobalWarnings: TStringList;

procedure GlobalWarning(const Texte: String);
begin
 if Texte='' then Exit;
 Log(LOG_WARNING, 'Global warning: %s', [Texte]);
 if GlobalWarnings=Nil then
  begin
   GlobalWarnings:=TStringList.Create;
  {PostMessage(g_Form1.Handle, wm_InternalMessage, wp_Warning, 0);}
  end;
 if GlobalWarnings.IndexOf(Texte)<0 then
  GlobalWarnings.Add(Texte);
end;

procedure GlobalDisplayWarnings;
var
 //We need to clear GlobalWarnings before going into the Modal loop,
 //because AppIdle will trigger, and call this procedure again,
 //causing an endless loop!
 DummyStringList: TStringList;
begin
 if GlobalWarnings<>Nil then
  begin
   DummyStringList:=GlobalWarnings;
   try
     GlobalWarnings:=Nil;
     ShowTextBox('QuArK', LoadStr1(5835), DummyStringList, mtWarning);
   finally
     DummyStringList.Free;
   end;
  end;
end;

 {------------------------}

//Based on: http://www.swissdelphicenter.ch/torry/showcode.php?id=282
function GetSystemErrorMessage(ErrNr: DWORD) : String;
var
  P: LPTSTR;
begin
  if FormatMessage(FORMAT_MESSAGE_ALLOCATE_BUFFER + FORMAT_MESSAGE_FROM_SYSTEM, nil, ErrNR, 0, @P, 0, nil) <> 0 then
  begin
    Result:=P;
    LocalFree(HLOCAL(P));
  end
  else
  begin
    Log(LOG_WARNING, 'Unable to retrieve system error message for error: %u', [ErrNR]);
    Result:='';
  end;
end;

procedure LogWindowsError(ErrNr: DWORD; const Call: String);
begin
  Log(LOG_WARNING, 'Error when calling a Windows API:' + sLineBreak +
                   'Call: %s' + sLineBreak +
                   'Reason: %s', [Call, GetSystemErrorMessage(ErrNr)]);
end;

 {------------------------}

constructor TCustomExceptionHandler.Create();
begin
  //Hook application-level exception handling
  OldException:=Application.OnException;
  Application.OnException:=CustomExceptionHandler.AppException;
end;

destructor TCustomExceptionHandler.Destroy();
begin
  //Unhook application-level exception handling
  Application.OnException:=OldException;
  //OldException:=nil;

  inherited;
end;

procedure TCustomExceptionHandler.AppException(Sender: TObject; E: Exception);
begin
  try
    MessageException(E, '%s', [mbOk]);
  except
    //If anything goes wrong with QuArK's exception handling, use the old one
    try
      Log(LOG_ALWAYS, Format('Error: Exception in exception handler: %s', [GetExceptionMessage(E)]));
    except
      //Ignore any errors here
    end;
    OldException(Sender, E);
  end;
end;

function TCustomExceptionHandler.MessageException(const E: Exception; const Info: String; Buttons: TMsgDlgButtons) : TModalResult;
const
 Fallback4614 = '&More >>';
var
 B: TButton;
{P: Integer;}
 S: String;
begin
(*if E.HelpContext=0 then
  Application.ShowException(E)
 else
  begin
   PlaySound(SOUND_ERROR);
   MessageDlg(E.Message, mtError, [mbOk, mbHelp], E.HelpContext);
  end;*)
 if E is EAbort then
  begin
   Result:=mrNone;
   Exit;   { silent exception }
  end;
 PlaySound(SOUND_ERROR);
 Include(Buttons, mbIgnore);
 if E.HelpContext<>0 then Include(Buttons, mbHelp);
 S:=Format(Info, [GetExceptionMessage(E)]);
 try
   Log(LOG_ALWAYS, 'Error: '+S);
 except
   //Ignore any errors here
 end;
{P:=Pos('//', S);
 if P=0 then
  P:=Length(S)+1;}
 with CreateMessageDialog({Copy(}S{,1,P-1)}, mtError, Buttons) do
  try
   HelpContext := E.HelpContext;
   B:=FindComponent('Ignore') as TButton;
   with B do
    begin
     if IsPythonInited then
      Caption:=LoadStr1(4614)
     else
      Caption:=Fallback4614;
     Hint:=E.Message;
     ModalResult:=mrNone;
     OnClick:=AppExceptionMore;
    end;
  {if P<Length(E.Message) then
    ActiveControl:=B;}
   Result:=ShowModal;
  finally
   Free;
  end;
end;

var
  OverrideExceptAddr: Pointer;

procedure TCustomExceptionHandler.AppExceptionMore(Sender: TObject);
const
 DlgW  = 372;
 MemoH = 160;
 Margin = 8;
 Fallback4616 = '                     *** EXCEPTION REPORT ***'+sLineBreak+sLineBreak+'%s %s'+sLineBreak+'Address in the program: 0x%p (base: 0x%p)'+sLineBreak;
 Fallback4617 = sLineBreak+sLineBreak+'Please report this error to the QuArK development team, so that they can fix the issue promptly.';
var
{E: Exception;}
 Msg: String;
 Dlg: TCustomForm;
 P: Integer;
 L: TStringList;
 Delta: Integer;
 ExceptAddrX: Pointer;
begin
 with Sender as TButton do
  begin
   Enabled:=False;
   //{$IFDEF DelphiXE2orNewerCompiler}NativeInt{$ELSE}LongInt{$ENDIF}(Pointer(E)):=Tag;
   Msg:=Hint;
  end;
 L:=TStringList.Create; try
 if OverrideExceptAddr = nil then
  ExceptAddrX:=ExceptAddr
 else
  ExceptAddrX:=OverrideExceptAddr;
 if IsPythonInited then
  L.Add(FmtLoadStr1(4616, [QuArKVersion, QuArKMinorVersion, ExceptAddrX, Pointer(GetModuleHandle(Nil))]))
 else
  L.Add(Format(Fallback4616, [QuArKVersion, QuArKMinorVersion, ExceptAddrX, Pointer(GetModuleHandle(Nil))]));
 P:=Pos('//', Msg);
 if P<>0 then
  begin
   L.Add(Copy(Msg, 1, P-1));
   L.Add(Copy(Msg, P+2, MaxInt));
  end;
 if IsPythonInited then
  L.Add(LoadStr1(4617))
 else
  L.Add(Fallback4617);
 Dlg:=GetParentForm(TControl(Sender));
 Delta:=DlgW - Dlg.Width;
 if Delta<0 then Delta:=0;
 with TMemo.Create(Dlg) do
  begin
   SetBounds(Margin, Dlg.ClientHeight, Dlg.ClientWidth + Delta - (2 * Margin), MemoH - Margin);
   Parent:=Dlg;
   Lines.Text:={$IFDEF Debug}'!! DEBUG !!'+{$ENDIF}L.Text;
   ScrollBars:=ssVertical;
   ReadOnly:=True;
   WantReturns:=False;
   SetFocus;
  end;
 Dlg.SetBounds(Dlg.Left - Delta div 2, Dlg.Top, Dlg.Width + Delta, Dlg.Height + MemoH);
 finally L.Free; end;
end;

 {------------------------}

var
  OldExceptProc: Pointer;

procedure InstallExceptProc;
begin
  OldExceptProc:=ExceptProc;
  ExceptProc:=@CustomExceptHandler;
end;

procedure CustomExceptHandler(ExceptObject: TObject; ExceptAddr: Pointer);
begin
 //Restore old ExceptProc to become part of a chain of exception procedures.
 ExceptProc:=OldExceptProc;

 if ExceptObject is Exception then
 begin
   OverrideExceptAddr:=ExceptAddr;
   CustomExceptionHandler.AppException(nil, Exception(ExceptObject));
   Halt(1);
 end;

 //Since we didn't halt, Delphi will raise a runtime error.
end;

initialization
  CustomExceptionHandler:=TCustomExceptionHandler.Create();
finalization
  CustomExceptionHandler.Free;
end.
