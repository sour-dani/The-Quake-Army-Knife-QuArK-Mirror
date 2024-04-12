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
unit MouseTracker;

interface

uses Windows, Messages, SysUtils, Classes, ExtCtrls, Controls;

type
  TMouseTracker = class(TGraphicControl)
  private
    procedure CMMouseEnter(var Msg: TMessage); message CM_MOUSEENTER;
    procedure CMMouseLeave(var Msg: TMessage); message CM_MOUSELEAVE;
    procedure TimerHandler(Sender: TObject);
  protected
    procedure MouseMove(Shift: TShiftState; X, Y: Integer); override;
    procedure MouseUpdating(const ScreenPos: TPoint); virtual;
    procedure UpdateMousePos;
  public
    destructor Destroy; override;
    procedure BeginDragging(C: TControl); dynamic;
    procedure Deactivate;
    function IsActive: Boolean;
  end;

procedure Register;

 {-------------------}

implementation

uses Types;

procedure Register;
begin
  RegisterComponents('Exemples', [TMouseTracker]);
end;

 {-------------------}

var
 ActiveTracker: TMouseTracker = Nil;
 CheckTimer: TTimer = Nil;

destructor TMouseTracker.Destroy;
begin
 if ActiveTracker=Self then
  begin
   ActiveTracker:=Nil;
   CheckTimer.Enabled:=False;
  end;
 inherited;
end;

procedure TMouseTracker.Deactivate;
begin
  ActiveTracker:=Nil;
  Perform(WM_LBUTTONUP, 0, 0);
end;

procedure TMouseTracker.CMMouseEnter;
begin
 UpdateMousePos;
 inherited;
end;

procedure TMouseTracker.CMMouseLeave;
begin
 inherited;
 UpdateMousePos;
end;

procedure TMouseTracker.UpdateMousePos;
const
 CheckInterval = 125; //in ms
var
 P: TPoint;
 C: TControl;
 OldTracker: TMouseTracker;
begin
 if not Enabled then
  begin
   if ActiveTracker=Self then
    begin
     ActiveTracker:=Nil;
     Repaint;
    end;
   Exit;
  end;
 GetCursorPos(P);
 C:=FindDragTarget(P, True);
 if C <> Self then
  begin
   if ActiveTracker=Self then
    begin
     ActiveTracker:=Nil;
     BeginDragging(C);
     Repaint;
    end;
   Exit;
  end;
 MouseUpdating(P);
 if ActiveTracker=Self then Exit;
 OldTracker:=ActiveTracker;
 ActiveTracker:=Self;
 if CheckTimer=Nil then
  begin
   CheckTimer:=TTimer.Create(Nil);
   CheckTimer.Interval:=CheckInterval;
  end;
 CheckTimer.OnTimer:=TimerHandler;
 CheckTimer.Enabled:=True;
 Repaint;
 if OldTracker<>Nil then
  OldTracker.Repaint;
end;

procedure TMouseTracker.BeginDragging;
begin
end;

procedure TMouseTracker.MouseUpdating;
begin
end;

procedure TMouseTracker.TimerHandler;
begin
 if ActiveTracker=Self then
  UpdateMousePos;
 if ActiveTracker<>Self then
  CheckTimer.Enabled:=False;
end;

procedure TMouseTracker.MouseMove(Shift: TShiftState; X, Y: Integer);
begin
 UpdateMousePos;
 inherited;
end;

function TMouseTracker.IsActive: Boolean;
begin
 Result:=(ActiveTracker=Self);
end;

 {-------------------}

initialization

finalization
 CheckTimer.Free;

end.
