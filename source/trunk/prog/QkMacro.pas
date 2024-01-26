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
unit QkMacro;

interface

uses Windows, SysUtils, Classes, QkObjects, QkGroup;

const
 typSeparator    = 'S';
 typCreation     = 'C';    { object creation }
 typMessage      = 'M';
 typToolBox      = 'T';
 typCheckBox     = 'X';    { for setting setup options }
 typRadioButton  = 'R';    { for setting one of mutually exclusive setup options }
 typMenu         = '*';
 typMacro        = '+';    { multiple commands (the commands must be included as ":macro" objects) }
 typOpenNew      = 'N';
 typExecute      = 'G';

 typCode         = 'P';

{typFormSwitch   = 'F';}
{typInstallation = 'I';}
{typOperation    = 'O';}

type
  QMacro = class(QObject)
           protected
             function GetTyp: Char;
             function GetNewGroup : QExplorerGroup;
           public
             class function TypeInfo: String; override;
             procedure Click(Sender: TComponent);
           end;

procedure ProcessMacros(Q, Source: QObject);
procedure DrawMapMacros(Entity: QObject; Macros, Entities: TQList);
procedure ExecuteObjectMacros(Sender: TComponent; Obj: QObject);

 {------------------------}

implementation

uses StrUtils, Controls, Forms, Console, FormCfg, Platform, Python, Setup, QkExplorer,
  QkFileObjects, QkForm, QkFormCfg, QkInclude, QkObjectClassList, qmath, Qk3D, Quarkx,
  QkSpecifics, ToolBox1, QkExceptions, ExtraFunctionality;

 {------------------------}

procedure ExecuteObjectMacros(Sender: TComponent; Obj: QObject);
var
 I: Integer;
 Q: QObject;
begin
 if Obj=Nil then Exit;
 Obj.Acces;
 for I:=0 to Obj.SubElements.Count-1 do
  begin
   Q:=Obj.SubElements[I];
   if Q.ClassType = QMacro then
    QMacro(Q).Click(Sender)
   else
    if Q is QFormCfg then
     DisplayFormDlg(QFormCfg(Q));
  end;
end;







(*procedure FindFreeMacro(var S: String; Next: Boolean);
var
 Form4: TForm4;
 L: TQList;
 TestI, J, K, P, P2: Integer;
 Test, nArg, SpecArg, PreviousArg: String;
 Q: QObject;
 Used: Boolean;
begin
 P:=Pos('%d', S);
 if P=0 then
  begin
   P:=Pos('%s', S);
   if P=0 then Exit;
   TestI:=0;
   Test:='a';
  end
 else
  begin
   TestI:=1;
   Test:='1';
  end;
 Form4:=GetDefaultForm4;
 if Form4=Nil then Exit;
 L:=Form4.GetEntityList;
 nArg:='';
 repeat
  PreviousArg:=nArg;
  nArg:=Copy(S, 1, P-1) + Test + Copy(S, P+2, MaxInt);
  Used:=False;
  for J:=0 to L.Count-1 do
   begin
    Q:=L[J];
    for K:=0 to Q.Specifics.Count-1 do
     begin
      SpecArg:=Q.Specifics[K];
      P2:=Pos('=', SpecArg);
      if (P2>0) and (P2=Length(SpecArg)-Length(nArg))
      and SameText(Copy(SpecArg, P2+1, MaxInt), nArg) then
       begin
        Used:=True;
        Break;
       end;
     end;
    if Used then Break;
   end;
  if not Used then
   begin
    if not Next and (PreviousArg<>'') then
     S:=PreviousArg
    else
     S:=nArg;
    Exit;
   end;
  if TestI=0 then
   begin
    J:=Length(Test);
    while (J>0) and (Test[J]='z') do
     begin
      Test[J]:='a';
      Dec(J);
     end;
    if J=0 then
     Test:='a'+Test
    else
     Test[J]:=Succ(Test[J]);
   end
  else
   begin
    Inc(TestI);
    Test:=IntToStr(TestI);
   end;
 until False;
end;*)

function Process1(Q, Source: QObject; const S: String) : String;
var
 I, J: Integer;
 S1, MacroStr: String;
 Q1: QObject;
begin
 try
  for I:=1 to Length(S) do
   if S[I]='[' then
    if S[I+1]='<' then
     begin
      MacroStr:=Copy(S, I+2, MaxInt);
      J:=Pos('>', MacroStr);
      if J=0 then Raise EError(5580);
      if S[J+1]<>']' then Raise EError(5581);
      Result:=Copy(S,1,I-1)+Copy(MacroStr,1,J-1)+Process1(Q, Source, Copy(MacroStr,J+2,MaxInt));
      Exit;
     end
    else
     begin
      MacroStr:=Process1(Q, Source, Copy(S, I+2, MaxInt));
      J:=Pos(']', MacroStr);
      if J=0 then Raise EError(5578);
      Result:=Copy(MacroStr, J+1, MaxInt);
      MacroStr:=Copy(MacroStr, 1, J-1);
      case S[I+1] of
       ':': if GetSetupPath(MacroStr, S1, Q1) then
             MacroStr:=Q1.Specifics.Strings[S1]
            else
             MacroStr:='';
      {'$': FindFreeMacro(MacroStr, True);
       '£': FindFreeMacro(MacroStr, False);}
       '~': MacroStr:=Source.Specifics.Strings[MacroStr];
      else
       Raise EError(5579);
      end;
      Result:=Copy(S,1,I-1)+MacroStr+Result;
      Exit;
     end;
 except
  on E: Exception do
   GlobalWarning(FmtLoadStr1(5577, [S, GetExceptionMessage(E)]));
 end;
 Result:=S;
end;

(*procedure ProcessBrackets(Q, Source: QObject);
var
 I, J: Integer;
 S: String;
begin
 Q.Acces;
 for I:=0 to Q.Specifics.Count-1 do
  begin
   S:=Q.Specifics[I];
   J:=Pos('=', S);
   if (J>3) and (S[J-2]='[') and (S[J-1]=']') then   { process macro }
    Q.Specifics[I]:=Copy(S, 1, J-3)+'='+Process1(Q, Source, Copy(S, J+1, MaxInt));
  end;
 for I:=0 to Q.SubElements.Count-1 do
  ProcessBrackets(Q.SubElements[I], Source);
end;*)

procedure ProcessMacros(Q, Source: QObject);
var
 I, J: Integer;
 L: TStringList;
 S: String;
 PlaceInclBack: TStringList; //Needed to prevent infinite looping
begin
 PlaceInclBack:=TStringList.Create; try
 PlaceInclBack.Delimiter:=',';
 Q.Acces;
 Q.Specifics.Delete(SpecDesc);
 repeat
  for I:=0 to Q.Specifics.Count-1 do
   begin
    S:=Q.Specifics.Names[I];
    if EndsStr('[]', S) then   { process macro }
     Q.Specifics.Strings[LeftStr(S, Length(S)-2)]:=Process1(Q, Source, Q.Specifics.StringsFromIndex[I]);
   end;
  for I:=0 to Q.SubElements.Count-1 do
   ProcessMacros(Q.SubElements[I], Source);

  I:=Q.Specifics.IndexOfName(SpecIncl);
  if I<0 then Break;
  S:=Q.Specifics.StringsFromIndex[I];
  Q.Specifics.Delete(I);
  L:=TStringList.Create; try
  L.Text:=S;
  for J:=0 to L.Count-1 do
  begin
   if (L[J] = 'defpoly') or (L[J] = 'poly') or (L[J] = 'trigger') or (L[J] = 'clip') or (L[J] = 'origin') or (L[J] = 'caulk') then
   begin
    //Skip this one; the Python code will handle it!
    PlaceInclBack.Add(L[J]);
    continue;
   end;
   DoIncludeData(Q, Source, L[J]);
  end;
  finally L.Free; end;
 until False;
 if PlaceInclBack.Count<>0 then
  Q.Specifics.Strings[SpecIncl]:=PlaceInclBack.DelimitedText;
 finally PlaceInclBack.Free; end;

 I:=Q.Specifics.IndexOfName(SpecCopy);
 if I<0 then Exit;
 S:=Q.Specifics.StringsFromIndex[I];
 Q.Specifics.Delete(I);
 L:=TStringList.Create; try
 L.Text:=S;
 for J:=0 to L.Count-1 do
  DoIncludeData(Q, Source, L[J]);
 finally L.Free; end;
end;

(*var
 I, J: Integer;
begin
 S:=Q.Specifics.Strings[SpecIncl];
 Q.Specifics.Delete(SpecIncl);
 if S<>'' then
  begin
   L:=TStringList.Create; try
   L.Text:=S;
   for J:=0 to L.Count-1 do
    DoIncludeData(Q, Gr.SubElements[I], L[J]);
   finally L.Free; end;
  end;
 S:=Q.Specifics.Strings[SpecTexture];
 if S<>'' then
  begin
   ReplaceWithDefaultTex(Q, S, SetupGameSet.Specifics.Strings['TextureDef']);
   Q.Specifics.Delete(SpecTexture);
  end;
end;*)

procedure DrawMapMacros(Entity: QObject; Macros, Entities: TQList);

  procedure MapMacros(Q: QObject);

    function SelectPen : HPen;
    var
     S: String;
     Width: Integer;
     Color: TColorRef;
    begin
     S:=Q.Specifics.Strings['width']; //FIXME: Switch to QkSpecifics.Float?
     if S='' then
      Width:=2
     else
      Width:=Round(ReadNumValueEx(S));
     S:=Q.Specifics.Strings['color']; //FIXME: Switch to QkSpecifics.Integer?
     if S='' then
      Color:=MapColors(lcAxes)
     else
      Color:=vtocol(ReadVector(S));
     SelectPen:=SelectObject(g_DrawInfo.DC,
      CreatePen(ps_Solid, Width, Color));
    end;

  var
   S, Arg: String;
   I, J: Integer;
   Test, Macro: QObject;
   V1, V2: TVect;
   R: Double;
   Pt1, Pt2, Pt3, Pt4, Pt5: TPoint;
   Pen: HPen;
  begin
   try
    Q.Acces;
    if SameText(Q.Name, 'DrawMap') then
     begin
      S:=Q.Specifics.Strings['Spec'];
      if S='' then Exit;
      Arg:=Q.Specifics.Strings['Arg'];
      if ((Arg='') and (Entity.Specifics.IndexOfName(S)>=0))
      or ((Arg<>'') and SameText(Entity.Specifics.Strings[S],Arg)) then
       begin  { "Entity" has the matching Specific }
        for J:=0 to Q.SubElements.Count-1 do
         begin
          Macro:=Q.SubElements[J].Clone(Nil, False); try
          ProcessMacros(Macro, Entity);
          MapMacros(Macro);
          finally Macro.Free; end;
         end;
       end;
      Exit;
     end
    else if SameText(Q.Name, 'find') then
     begin
      S:=Q.Specifics.Strings['Spec'];
      if S='' then Exit;
      Arg:=Q.Specifics.Strings['Arg'];
      for I:=0 to Entities.Count-1 do   { search for matching entities }
       begin
        Test:=Entities[I];
        if ((Arg='') and (Test.Specifics.IndexOfName(S)>=0))
        or ((Arg<>'') and (CompareText(Test.Specifics.Strings[S],Arg)=0)) then
         begin  { found an entity }
          for J:=0 to Q.SubElements.Count-1 do
           begin
            Macro:=Q.SubElements[J].Clone(Nil, False); try
            ProcessMacros(Macro, Test);
            MapMacros(Macro);
            finally Macro.Free; end;
           end;
         end;
       end;
      Exit;
     end
    else if SameText(Q.Name, 'Circle') then
     begin
      V1:=ReadVector(Q.Specifics.Strings['center']); //FIXME: Switch to QkSpecifics.Floats?
      Pt1:=Proj(V1);
      R:=ReadNumValueEx(Q.Specifics.Strings['radius']); //FIXME: Switch to QkSpecifics.Floats?
      J:=Round(R*g_pProjZ);
      Pen:=SelectPen;
      Ellipse(g_DrawInfo.DC, Pt1.X-J, Pt1.Y-J, Pt1.X+J, Pt1.Y+J);
      DeleteObject(SelectObject(g_DrawInfo.DC, Pen));
      Exit;
     end
    else if SameText(Q.Name, 'Arrow') then
     begin
      V1:=ReadVector(Q.Specifics.Strings['from']); //FIXME: Switch to QkSpecifics.Floats?
      Pt1:=Proj(V1);
      V2:=ReadVector(Q.Specifics.Strings['to']); //FIXME: Switch to QkSpecifics.Floats?
      Pt2:=Proj(V2);
      Pt3.X:=Pt2.X-Pt1.X;
      Pt3.Y:=Pt2.Y-Pt1.Y;
      R:=Sqrt(Sqr(Pt3.X)+Sqr(Pt3.Y));
      if R<rien then Exit;
      S:=Q.Specifics.Strings['arrow']; //FIXME: Switch to QkSpecifics.Integer?
      if S='' then
       J:=5
      else
       J:=Round(ReadNumValueEx(S));
      R:=J/R;
      Pt4.X:=Pt2.X-Round(R*(Pt3.X+Pt3.Y));
      Pt4.Y:=Pt2.Y-Round(R*(Pt3.Y-Pt3.X));
      Pt5.X:=Pt2.X-Round(R*(Pt3.X-Pt3.Y));
      Pt5.Y:=Pt2.Y-Round(R*(Pt3.Y+Pt3.X));
      Pen:=SelectPen;
      MoveToEx(g_DrawInfo.DC, Pt1.X, Pt1.Y, Nil);
      LineTo(g_DrawInfo.DC, Pt2.X, Pt2.Y);
      LineTo(g_DrawInfo.DC, Pt4.X, Pt4.Y);
      MoveToEx(g_DrawInfo.DC, Pt2.X, Pt2.Y, Nil);
      LineTo(g_DrawInfo.DC, Pt5.X, Pt5.Y);
      DeleteObject(SelectObject(g_DrawInfo.DC, Pen));
      Exit;
     end;
   except
    {rien}
   end;
  end;

var
 I: Integer;
 Brush: HBrush;
begin
 Brush:=SelectObject(g_DrawInfo.DC, GetStockObject(Null_brush));
 for I:=0 to Macros.Count-1 do
  MapMacros(Macros[I]);
 SelectObject(g_DrawInfo.DC, Brush);
end;

 {------------------------}

class function QMacro.TypeInfo: String;
begin
 Result:=':macro';
end;

function QMacro.GetTyp: Char;
var
 S: String;
begin
 S:=Specifics.Strings['Typ'];
 if S='' then
  Result:=#0
 else
  Result:=S[1];
end;

function QMacro.GetNewGroup : QExplorerGroup;
var
 S: String;
 Gr: QExplorerGroup;
begin
{Result:=SubElements.FindName('New.qrk') as QExplorerGroup;
 if Result=Nil then
  Result:=QExplorerGroup.Create('New', Nil)
 else
  Result:=CopyToOutside(Result);}

 Gr:=QExplorerGroup.Create(LoadStr1(5119), Nil);
 Gr.AddRef(+1); try
 S:=Specifics.Strings['Create'];
 if S<>'' then
  DoIncludeData(Gr, Self, S);
 Result:=CopyToOutside(Gr);
 finally Gr.AddRef(-1); end;
end;

(*procedure InstallCopy(Sender: TComponent; const TargetPath: String);
var
 FileOp: TSHFILEOPSTRUCT;
 sFrom, sTo: String;
begin
 sFrom:=ConcatPaths([GetApplicationPath(), '*.*']);
 sTo:=TargetPath;
 FillChar(FileOp, SizeOf(FileOp), 0);
 FileOp.hwnd:=ValidParentForm(Sender).Handle;
 FileOp.wFunc:=FO_COPY;
 FileOp.pFrom:=PChar(sFrom);
 FileOp.pTo:=PChar(sTo);
 FileOp.fFlags:=FOF_ALLOWUNDO or FOF_NOCONFIRMATION;
 if SHFileOperation(FileOp) <> 0 then
  ;
end;*)

procedure QMacro.Click(Sender: TComponent);
var
 Q{, Source}: QObject;
 Spec{, LinFile}: String;
 E: TQkExplorer;
 Gr: QExplorerGroup;
 ClearList{, L, L1}: TStringList;
 I: Integer;
begin
 Acces;
 case GetTyp of
  typCreation:
    begin
     E:=TQkExplorer(ValidParentForm(Sender as TControl).Perform(wm_InternalMessage, wp_TargetExplorer, 0));
     if E<>Nil then
      begin
       Gr:=GetNewGroup;
       Gr.AddRef(+1); try
       if E.DropObjectsNow(Gr, LoadStr1(544), False) then
        Exit;
       finally Gr.AddRef(-1); end;
      end;
    end;
  typCheckBox:
    if GetSetupPath(Specifics.Strings['Path'], Spec, Q) then
     begin
      if Q.Specifics.Strings[Spec]='' then
       Q.Specifics.Strings[Spec]:='1'
      else
       Q.Specifics.Strings[Spec]:='';
      SetupChanged(scNormal);
      Exit;
     end;
  typRadioButton:
    if GetSetupPath(Specifics.Strings['Path'], Spec, Q) then
     begin
      Q.Specifics.Strings[Spec]:='1';
      ClearList:=TStringList.Create; try
      ClearList.Text:=Specifics.Strings['Clear'];
      for I:=0 to ClearList.Count-1 do
       Q.Specifics.Strings[ClearList[I]]:='';
      finally ClearList.Free; end;
      SetupChanged(scNormal);
      Exit;
     end;
  typMessage:
    begin
     ValidParentForm(Sender as TControl).Perform(wm_InternalMessage, wp_ToolbarButton1,
      IntSpec['Msg']);
     Exit;
    end;
  typToolBox:
    begin
     ShowToolBox(Specifics.Strings['ToolBox']);
     Exit;
    end;
  typMenu:
    Exit;
  typCode:
    begin
      Spec:=Specifics.Strings['Code'];
      if Spec<>'' then
      begin
        if PyRun_SimpleString(ToPyChar(Spec)) <> 0 then ShowConsole(True);
        Exit;
      end
    end;
  typMacro:
    begin
     if Specifics.TryGetIntegers('count', I)<>tgrSuccess then
      I:=1;
     while I>0 do
      begin
       ExecuteObjectMacros(Sender, Self);
       Dec(I);
      end;
     Exit;
    end;
  typOpenNew:
    begin
     Gr:=GetNewGroup;
     Gr.AddRef(+1); try
     for I:=0 to Gr.SubElements.Count-1 do
      begin
       Q:=Gr.SubElements[I];
       if Q is QFileObject then
        with QFileObject(Q) do
         begin
          Filename:='';
          ReadFormat:=rf_Default;
          Flags:=(Flags or ofFileLink) and not ofModified;
          OpenStandAloneWindow(Nil, False);
         end;
      end;
     finally Gr.AddRef(-1); end;
     Exit;
    end;
  typExecute:
    begin
   (*Q:=Clone(Parent);
     Q.AddRef(+1); try
     with ValidParentForm(Sender as TControl) do
      Source:=HasGotObject(Perform(wm_InternalMessage, wp_EditMsg, edGetMacroObject));
     if Source=Nil then
      ProcessMacros(Q, Q)
     else
      begin
       Source.AddRef(+1); try
       ProcessMacros(Q, Source);
       finally Source.AddRef(-1); end;
      end;
     ClearList:=TStringList.Create; try
     ClearList.Text:=Q.Specifics.Values['MustUpdate'];
     LinFile:=Q.Specifics.Values['LinFile'];
     if LinFile<>'' then
      begin
       LinFile:=OutputFile(LinFile);
       DeleteFile(LinFile);
      end; 
     Spec:=Q.Specifics.Values['AddToPack'];
     if (ClearList.Count>0) or (Spec<>'') then
      with Op.InternalSpecs.Specifics do
       begin
        L:=TStringList.Create; try
        L.Text:=Values['AddToPack'];
        L.AddStrings(ClearList);
        L1:=TStringList.Create; try
        L1.Text:=Spec;
        L.AddStrings(L1);
        finally L1.Free; end;
        Values['AddToPack']:=L.Text;
        finally L.Free; end;
       end;
     for I:=0 to ClearList.Count-1 do
      ClearList[I]:=OutputFile(ClearList[I]);
     RunProgram(Q.Specifics.Values['Exec'], Q.Specifics.Values['Dir'], Q.Specifics.Values['CheckFileCfg'],
      ClearList, False);
     finally ClearList.Free; end;
     finally Q.AddRef(-1); end;
     if (LinFile<>'') and FileExists(LinFile) then
      case MessageDlg(LoadStr1(5620), mtConfirmation, mbYesNoCancel, 0) of
       mrYes: begin
               with ValidParentForm(Sender as TControl) do
                Perform(wm_InternalMessage, wp_LoadLinFile, LPARAM(PChar(LinFile)));
               Raise EError(5621);
              end;
       mrNo: ;
       else Abort;
      end;
     Exit;*)
    end;
(*typFormSwitch:
    begin
     Q:=FindIncludeData1(Self, Specifics.Values['Page']);
     Q.AddRef(+1); try
     if (Q<>Nil) and (Q.SubElements.Count>0) then
      begin
       Q:=Q.SubElements[0];
       if Q is QFormCfg then
        begin
         Q.Acces;
         ValidParentForm(Sender as TControl).Perform(wm_InternalMessage,
          wp_SetFormCfg, LPARAM(Q));
         Exit;
        end;
      end;
     finally Q.AddRef(-1); end;
    end;*)
 {typInstallation:
    begin
     Spec:=Specifics.Values['Op'];
     if Spec='COPY' then
      begin
       InstallCopy(Sender, Specifics.Values['Path']);
       Exit;
      end;
    end;}
 {typOperation:
    begin
     Op.Operation(Self);
     Exit;
    end;}
 end;
 PlaySound(SOUND_ERROR);
 Abort;
end;

 {------------------------}

initialization
  RegisterQObject(QMacro, 'a');
end.
