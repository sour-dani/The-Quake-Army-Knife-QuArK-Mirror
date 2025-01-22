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
procedure RefreshAssociations;
procedure RemoveAssociations;

{$I DelphiVer.inc}

 {------------------------}

implementation

uses Windows, Forms, StrUtils, Registry2, Quarkx, ApplPaths, Setup,
     QkExceptions, QkFileObjects, QkObjectClassList,
     {$IFDEF CompiledWithDelphi2} ShellObj, {$ELSE} ShlObj, {$ENDIF}
     ExtraFunctionality, Logging;

 {------------------------}

const
  RegFileDescrFormat = 'QuArK %s';
  RegFileAssocFormat = 'QuArK_%s_file';

function GetRegCommand : String;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
begin
  Result:='"'+EscapeCommandline(Application.ExeName)+'" /NOSPLASH "%1"';
end;

procedure MakeAssociations(Config: QObject);
var
  I: Integer;
  S, S1, Ext: String;
  Reg: TRegistry2;
begin
  Reg:=Nil;
  try
    for I:=0 to Config.Specifics.Count-1 do
    begin
      if not StartsStr('.', Config.Specifics.Names[I]) then continue;

      if Config.Specifics.StringsFromIndex[I]<>'' then
      begin   { must be activated }
        Ext:=Copy(Config.Specifics.Names[I], 2, MaxInt);

        if Reg=Nil then
        begin
          Reg:=TRegistry2.Create;
          Reg.RootKey:=HKEY_CLASSES_ROOT;
        end;
        if not Reg.OpenKey('\.'+Ext, True) then
        begin
          GlobalWarning(FmtLoadStr1(5616, [Ext, LoadStr1(5848)]));
          continue;
        end;
        try
          S:=Format(RegFileAssocFormat, [Ext]);
          if (not Reg.TryReadString('', S1)) or (S<>S1) then
            if not Reg.TryWriteString('', S) then
            begin
              GlobalWarning(FmtLoadStr1(5616, [Ext, LoadStr1(5844)]));
              continue;
            end;
        finally
          Reg.CloseKey;
        end;
      end;
    end;
  finally
    if Reg <> Nil then
     Reg.Free;
  end;
  RefreshAssociations;
  SHChangeNotify(SHCNE_ASSOCCHANGED, SHCNF_IDLIST, nil, nil);
end;

//Fix any broken associations, but don't active any! 
procedure RefreshAssociations;
var
  I, J: Integer;
  S, S1, Ext, Command: String;
  Reg: TRegistry2;
  QClassPtr: QObjectClass;
  QClassInfo: TFileObjectClassInfo;
  Description: String;
  ClassKey: String;
begin
  Reg:=Nil;
  Command:=GetRegCommand;
  with SetupSubSet(ssGeneral, 'File Associations') do
  begin
    try
      for I:=0 to Specifics.Count-1 do
      begin
        if not StartsStr('.', Specifics.Names[I]) then continue;

        Ext:=Copy(Specifics.Names[I], 2, MaxInt);
        QClassPtr:=RequestClassOfType('.'+Ext);
        Description:=Ext;
        ClassKey:=Format(RegFileAssocFormat, [Ext]);
        if (QClassPtr<>Nil) and (QClassPtr.InheritsFrom(QFileObject)) then
        begin
          QFileObjectClass(QClassPtr).FileObjectClassInfo(QClassInfo);
          Description:=QClassInfo.DescriptionText;
        end;

        Log(LOG_VERBOSE, LoadStr1(5847), [Ext]);
        if Reg=Nil then
        begin
          Reg:=TRegistry2.Create;
          Reg.RootKey:=HKEY_CLASSES_ROOT;
        end;
        if not Reg.OpenKey('\'+ClassKey, True) then
        begin
          if Specifics.StringsFromIndex[I]<>'' then
            Log(LOG_WARNING, FmtLoadStr1(5616, [Ext, LoadStr1(5849)]));
          continue;
        end;
        try
          if not Reg.TryWriteString('AlwaysShowExt', '') then //FIXME: Add an option for this!
            Log(LOG_WARNING, LoadStr1(5861), ['AlwaysShowExt', Ext, 'HKCR\'+ClassKey]);

          S:=Format(RegFileDescrFormat, [Description]);
          if (not Reg.TryReadString('', S1)) or (S<>S1) then
            if not Reg.TryWriteString('', S) then
              Log(LOG_WARNING, LoadStr1(5861), ['<description>', Ext, 'HKCR\'+ClassKey]);

          J:=Round(GetFloatSpec('i'+Ext, -1));
          if (J>=0) and Reg.OpenKey('\'+ClassKey+'\DefaultIcon', True) then
            if not Reg.TryWriteString('', Format('%s,%d', [Application.ExeName, J])) then
              Log(LOG_WARNING, LoadStr1(5861), ['DefaultIcon', Ext, 'HKCR\'+ClassKey]);
        finally
          Reg.CloseKey;
        end;

        if not Reg.OpenKey('\'+ClassKey+'\shell\open\command', True) then
        begin
          Log(LOG_WARNING, FmtLoadStr1(5616, [Ext, LoadStr1(5850)]));
          continue;
        end;
        try
          if (not Reg.TryReadString('', S)) or (S<>Command) then
            if not Reg.TryWriteString('', Command) then
            begin
              Log(LOG_WARNING, LoadStr1(5861), ['<command>', Ext, 'HKCR\'+ClassKey+'\shell\open\command']);
              continue;
            end;
        finally
          Reg.CloseKey;
        end;
    end;
    finally
      if Reg <> Nil then
        Reg.Free;
    end;
  end;
  //SHChangeNotify(SHCNE_ASSOCCHANGED, SHCNF_IDLIST, nil, nil);
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
         and Reg.TryReadString('', S1) and (S1<>'')
         and Reg.OpenKey('\'+S1+'\shell\open\command', False)
         and Reg.TryReadString('', S)
         and SameText(S, Command);

     if Active then   { must un-associate }
       if not Reg.OpenKey('\', False)
       or not Reg.DeleteKey(S1)
       or not Reg.DeleteKey('.'+Ext) then
         GlobalWarning(FmtLoadStr1(5613, [Ext, ''])); //FIXME: Add details to error message!
    end;
   finally Reg.Free; end;
  end;
  SHChangeNotify(SHCNE_ASSOCCHANGED, SHCNF_IDLIST, nil, nil);
end;

end.
