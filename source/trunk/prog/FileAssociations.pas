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
unit FileAssociations;

interface

uses SysUtils, Classes, QkObjects;

procedure MakeAssociations(Config: QObject);
procedure RefreshAssociations(Forced: Boolean);
procedure RemoveAssociations;

{$I DelphiVer.inc}

 {------------------------}

implementation

uses Windows, Forms, StrUtils, Registry2, Quarkx, ApplPaths, Setup,
     QkExceptions, QkFileObjects, QkObjectClassList,
     {$IFDEF CompiledWithDelphi2} ShellObj, {$ELSE} ShlObj, {$ENDIF}
     ExtraFunctionality, Logging;

 {------------------------}

function MakeAssociation({Reg: TRegistry2;} const Ext, Command: String) : Boolean;
const
 RegFileDescrFormat = 'QuArK %s';
 RegFileAssocFormat = 'QuArK_%s_file';
var
 Reg: TRegistry2;
 S1, S: String;
 QClassPtr: QObjectClass;
 QClassInfo: TFileObjectClassInfo;
 Description: String;
 ClassKey: String;
begin
 Log(LOG_VERBOSE, LoadStr1(5847), [Ext]);

 QClassPtr:=RequestClassOfType('.'+Ext);
 Description:=Ext;
 ClassKey:=Format(RegFileAssocFormat, [Ext]);
 if (QClassPtr<>Nil) and (QClassPtr.InheritsFrom(QFileObject)) then
  begin
   QFileObjectClass(QClassPtr).FileObjectClassInfo(QClassInfo);
   Description:=QClassInfo.DescriptionText;
  end;

 Result:=False;
 Reg:=TRegistry2.Create;
 try
  Reg.RootKey:=HKEY_CLASSES_ROOT;
  if not Reg.OpenKey('\.'+Ext, True) then
   begin
    Log(LOG_WARNING, FmtLoadStr1(5613, [Ext]) + LoadStr1(5848));
    Exit;
   end;
  try
   S:=Format(RegFileAssocFormat, [Ext]);
   if not (Reg.TryReadString('', S1) or (S=S1)) then
    if not Reg.TryWriteString('', S) then
     begin
      Log(LOG_WARNING, FmtLoadStr1(5613, [Ext]) + LoadStr1(5844));
      Exit;
     end;
  finally
   Reg.CloseKey;
  end;

  if not Reg.OpenKey('\'+ClassKey, True) then
   begin
    Log(LOG_WARNING, FmtLoadStr1(5613, [Ext]) + LoadStr1(5849));
    Exit;
   end;
  try
   S:=Format(RegFileDescrFormat, [Description]);
   if not (Reg.TryReadString('', S1) or (S=S1)) then
    if not Reg.TryWriteString('', S) then
     begin
      Log(LOG_WARNING, FmtLoadStr1(5613, [Ext]) + LoadStr1(5845));
      Exit;
     end;
  finally
   Reg.CloseKey;
  end;

  if not Reg.OpenKey('\'+ClassKey+'\shell\open\command', True) then
   begin
    Log(LOG_WARNING, FmtLoadStr1(5613, [Ext]) + LoadStr1(5850));
    Exit;
   end;
  try
   if not (Reg.TryReadString('', S) or (S=Command)) then
    if not Reg.TryWriteString('', Command) then
     begin
      Log(LOG_WARNING, FmtLoadStr1(5613, [Ext]) + LoadStr1(5846));
      Exit;
     end;
   {if (Icon>=0) and Reg.OpenKey('\'+S1+'\DefaultIcon', True) then
    Reg.WriteString('', Format('%s,%d', [Application.ExeName, Icon]));}
  finally
   Reg.CloseKey;
  end;
 finally
  Reg.Free;
 end;
 Result:=True;
end;

function GetRegCommand : String;
begin
 Result:='"'+EscapeCommandline(Application.ExeName)+'" /NOSPLASH "%1"';
end;

procedure MakeAssociations(Config: QObject);
var
 I: Integer;
 Command, Ext: String;
{Reg: TRegistry2;}
begin
 Command:=GetRegCommand;
{Reg:=TRegistry2.Create; try
 Reg.RootKey:=HKEY_CLASSES_ROOT;}
 for I:=0 to Config.Specifics.Count-1 do
  begin
   if not StartsStr('.', Config.Specifics.Names[I]) then continue;

   if Config.Specifics.StringsFromIndex[I]<>'' then
    begin   { must be activated }
     Ext:=Copy(Config.Specifics.Names[I], 2, MaxInt);
     if not MakeAssociation({Reg,} Ext, Command) then
      GlobalWarning(FmtLoadStr1(5616, [Ext]));
    end;
  end;
{finally Reg.Free; end;
 SHChangeNotify(SHCNE_ASSOCCHANGED, SHCNF_IDLIST, nil, nil);}
 RefreshAssociations(True);
end;

procedure RefreshAssociations(Forced: Boolean);
var
 I, J: Integer;
 S, S1, Ext, Command: String;
 Active, Activate: Boolean;
 Reg: TRegistry2;
begin
 Command:=GetRegCommand;
 with SetupSubSet(ssGeneral, 'File Associations') do
  begin
   Reg:=Nil;
   try
    for I:=0 to Specifics.Count-1 do
     begin
      if not StartsStr('.', Specifics.Names[I]) then continue;

      Activate:=Specifics.StringsFromIndex[I]='!';
      Ext:=Copy(Specifics.Names[I], 2, MaxInt);
      if Reg=Nil then
       begin
        Reg:=TRegistry2.Create;
        Reg.RootKey:=HKEY_CLASSES_ROOT;
       end;

      Active:=Reg.OpenKey('\.'+Ext, False)
        and Reg.TryReadString('', S1) and (S1<>'')
        and Reg.OpenKey('\'+S1+'\shell\open\command', False)
        and Reg.TryReadString('', S)
        and SameText(S, Command);
      Reg.CloseKey;

      if not Active and Activate then   { auto-associate }
       begin
        Reg.Free;
        Reg:=Nil;
        Active:=MakeAssociation({Reg,} Ext, Command);
       end;
      if Active or (Activate and Forced) then   { set icon and always show icon }
       begin
        if Reg=Nil then
         begin
          Reg:=TRegistry2.Create;
          Reg.RootKey:=HKEY_CLASSES_ROOT;
         end;
        if Reg.OpenKey('\'+S1, True) then
         begin
          if not Reg.TryWriteString('AlwaysShowExt', '') then //FIXME: Add an option for this!
           Log(LOG_WARNING, LoadStr1(5861), ['AlwaysShowExt', Ext, S1]);
          J:=Round(GetFloatSpec('i'+Ext, -1));
          if (J>=0) and Reg.OpenKey('\'+S1+'\DefaultIcon', True) then
           if not Reg.TryWriteString('', Format('%s,%d', [Application.ExeName, J])) then
            Log(LOG_WARNING, LoadStr1(5861), ['DefaultIcon', Ext, S1]);
          Reg.CloseKey;
         end;
       end;

       {if not Reg.OpenKey('\', False)
        or not Reg.DeleteKey(S1)
        or not Reg.DeleteKey('.'+Ext) then
         GlobalWarning(FmtLoadStr1(5613, [Ext]));}

    end;
   finally
    if Reg <> Nil then
     Reg.Free;
   end;
  end;
  SHChangeNotify(SHCNE_ASSOCCHANGED, SHCNF_IDLIST, nil, nil);
end;

procedure RemoveAssociations;
var
 I: Integer;
 S, S1, Ext, Command: String;
 Active: Boolean;
 Reg: TRegistry2;
begin
 Command:=GetRegCommand;
 with SetupSubSet(ssGeneral, 'File Associations') do
  begin
   Reg:=TRegistry2.Create; try
   Reg.RootKey:=HKEY_CLASSES_ROOT;
   for I:=0 to Specifics.Count-1 do
    begin
     if not StartsStr('.', Specifics.Names[I]) then continue;

     Ext:=Copy(Specifics.Names[I], 2, MaxInt);
     Active:=Reg.OpenKey('\.'+Ext, False)
         and Reg.TryReadString('', S1)
         and (S1<>'') and Reg.OpenKey('\'+S1+'\shell\open\command', False)
         and Reg.TryReadString('', S)
         and SameText(S, Command);

     if Active then   { must un-associate }
       if not Reg.OpenKey('\', False)
       or not Reg.DeleteKey(S1)
       or not Reg.DeleteKey('.'+Ext) then
         GlobalWarning(FmtLoadStr1(5613, [Ext]));
    end;
   finally Reg.Free; end;
  end;
  SHChangeNotify(SHCNE_ASSOCCHANGED, SHCNF_IDLIST, nil, nil);
end;

end.
