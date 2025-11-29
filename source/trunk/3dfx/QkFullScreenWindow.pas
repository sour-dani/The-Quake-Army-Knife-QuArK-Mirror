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
unit QkFullScreenWindow;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, Windows, SysUtils, QkObjects;

procedure OpenFullscreenWindow(const Caption: String; Root: QObject);

implementation

uses Messages, QkExceptions, Coordinates, EdSceneObject, qmath, Setup, Qk3D;

type
  QFullScreenWindow = class
  private
    Handle: HWND;
    FScene: TSceneObject;
    MapProjView: TCameraCoordinates;
    PrevFrameTimer: TLargeInteger;
    FrameTimerFreq: TLargeInteger;
    Caption: String;
    Root: QObject;
    NeedRerender: Boolean;
    Quit: Boolean;
  public
    constructor Create(const nCaption: String; nRoot: QObject);
    destructor Destroy; override;
    procedure Init();
    function MessagePump : WPARAM;
    property Scene : TSceneObject read FScene;
  end;

const
  FullScreenWindowClassName: string = 'QuArK FullScreen Window Class';

var
  FSWindow: QFullScreenWindow; //We're only allowing one fullscreen window at a time.
  FullScreenWindowClassRegistered: Boolean;
  FullScreenWindowClass: WNDCLASSEX;
  FullScreenWindowClassAtom: ATOM;

 { ----------------- }

procedure OpenFullscreenWindow(const Caption: String; Root: QObject);
begin
//  if FSWindow<>nil then
//    raise

  FSWindow:=QFullScreenWindow.Create(Caption, Root);
  try
    FSWindow.Init();
    FSWindow.MessagePump();
  finally
    FSWindow.Free;
    FSWindow:=nil;
  end;
end;

function WndMessageProc(hWnd: HWND; Msg: UINT; WParam: WPARAM; LParam: LPARAM): LRESULT; stdcall;
var
 PaintInfo: TPaintStruct;
 DC: HDC;
begin
  case Msg of
  WM_DESTROY:
  begin
    with FSWindow do
    begin
      FScene.Free;
      //FScene:=nil;

      Quit:=true;
    end;
    Result := DefWindowProc(hWnd, Msg, wParam, lParam);
  end;
  WM_KILLFOCUS:
  begin
    DestroyWindow(hWnd);
    Result := DefWindowProc(hWnd, Msg, wParam, lParam);
  end;
  WM_PAINT:
  begin
    DC:=BeginPaint(hWnd, PaintInfo);
    try
      if DC<>0 then
      begin
        with FSWindow do
        begin
          if Scene<>nil then
          begin
            if NeedRerender then
            begin
              Scene.Render3DView();
              NeedRerender:=False;
            end;
            Scene.Draw3DView();
          end;
        end;
      end;
    finally
      EndPaint(hWnd, PaintInfo);
    end;
    Result := 0;
  end;
  WM_KEYUP:
  begin
    if wParam=vk_Escape then
      DestroyWindow(hWnd);

    Result := 0;
  end;
  else
    Result := DefWindowProc(hWnd, Msg, wParam, lParam);
  end;
end;

 { ----------------- }

constructor QFullScreenWindow.Create(const nCaption: String; nRoot: QObject);
begin
  Quit:=False;
  inherited Create();
  Root:=nRoot;
  Root.AddRef(+1);
  Caption:=nCaption;
  if not FullScreenWindowClassRegistered then
  begin
    FillChar(FullScreenWindowClass, SizeOf(FullScreenWindowClass), 0);
    FullScreenWindowClass.cbSize:=SizeOf(FullScreenWindowClass);
    FullScreenWindowClass.style:=CS_HREDRAW or CS_VREDRAW or CS_OWNDC;
    FullScreenWindowClass.hbrBackground:=0;
    FullScreenWindowClass.hInstance:=hInstance;
    //@ We must set hCursor...?
    FullScreenWindowClass.lpszClassName:=PChar(FullScreenWindowClassName);
    FullScreenWindowClass.lpfnWndProc:=@WndMessageProc;
    FullScreenWindowClassAtom:=RegisterClassEx(FullScreenWindowClass);
    if FullScreenWindowClassAtom = 0 then
      Raise EErrorFmt(6014, ['RegisterClassEx']);
    FullScreenWindowClassRegistered := True;
  end;

  MapProjView:=TCameraCoordinates.Create;
end;

destructor QFullScreenWindow.Destroy;
begin
  if Handle <> 0 then
    DestroyWindow(Handle);

  MapProjView.Free;
  MapProjView:=nil;

  Root.AddRef(-1);
  //Root:=nil;

  inherited;
end;

procedure QFullScreenWindow.Init;
var
 Setup: QObject;
 ClientRect: TRect;
 AllowsGDI: Boolean;
 Width, Height: Integer;
begin
  if QueryPerformanceFrequency(FrameTimerFreq) = false then
    ; //@
  if FrameTimerFreq = 0 then
    ; //@

  //@ THIS IS BAD! We want to do this with SetWindowPos or WHATEVER!
  Width:=GetSystemMetrics( SM_CXSCREEN );
  Height:=GetSystemMetrics( SM_CYSCREEN );

  //VAngle:=GetFloatSpec('VAngle', 45);
  MapProjView.VAngleDegrees:=45.0;
  MapProjView.RFactorBase:=Cos(45.0 * Deg2Rad)/Sin(45.0 * Deg2Rad);
  MapProjView.Resize(Width, Height);
  //MinDistance:=Minoow / GetFloatSpec('DarkFactor', 1);
  MapProjView.MinDistance:=1.0;

  Handle := CreateWindowEx({WS_EX_TOPMOST} 0, FullScreenWindowClass.lpszClassName, PChar(Caption), WS_POPUP, 0, 0, Width, Height, 0, 0, hInstance, nil);
  if Handle = 0 then
    Raise EErrorFmt(6014, ['CreateWindow']);

  try
    //@
    with MapProjView do
    begin
      VAngleDegrees:=45.0;
      RFactorBase:=Cos(VAngleDegrees*Deg2Rad)/Sin(VAngleDegrees*Deg2Rad);
      MinDistance:=Minoow / 1;
    end;

    AllowsGDI:=True;

    Setup:=SetupSubSet(ssGeneral, '3D view');

    FScene:=GetNewSceneObject();
    Scene.SetViewWnd(Handle);
    if GetClientRect(Handle, ClientRect) = false then
      //Error@
      ;
    Scene.SetDrawRect(ClientRect);
    Scene.SetViewSize(ClientRect.Right - ClientRect.Left, ClientRect.Bottom - ClientRect.Top);
    Scene.Init(MapProjView, dmFullScreen, dt3D, rmTextured, Setup.Specifics.Strings['Lib'], AllowsGDI);
    if Root<>nil then
      Q3DObject(Root).AddTo3DScene(Scene);
    Scene.BuildScene(0, nil);
    NeedRerender:=True;
  except
    DestroyWindow(Handle);
    raise;
  end;

  ShowWindow(Handle, SW_SHOWNORMAL);
end;

function QFullScreenWindow.MessagePump : WPARAM;
const
  WalkSpeed = 100.0;
  RunSpeed = 1000.0;
var
  Msg: TMsg;
  Eye: TVect;
  FrameTimer: TLargeInteger;
  TimeDiff: Double;
  SceneChanged: Boolean;
begin
  while not Quit do
  begin
    if PeekMessage(Msg, Handle, 0, 0, PM_REMOVE) = false then
    begin
      //@
      if Scene<>nil then
      begin
        SceneChanged:=false;

        if QueryPerformanceCounter(FrameTimer) = false then
          ; //@ Check for errors
        TimeDiff := (FrameTimer - PrevFrameTimer) / FrameTimerFreq;
        PrevFrameTimer := FrameTimer;

        if GetAsyncKeyState(vk_Down) and $8000 <> 0 then
        begin
          Eye := FSWindow.MapProjView.Camera;
          if GetAsyncKeyState(VK_SHIFT) and $8000 <> 0 then
            Eye.X := Eye.X - RunSpeed * TimeDiff
          else
            Eye.X := Eye.X - WalkSpeed * TimeDiff;
          MapProjView.Camera := Eye;
          MapProjView.ResetCamera();
          FScene.SetCoords(FSWindow.MapProjView);
          InvalidateRect(Handle, nil, false);
        end;

        if GetAsyncKeyState(vk_Up) and $8000 <> 0 then
        begin
          Eye := FSWindow.MapProjView.Camera;
          if GetAsyncKeyState(VK_SHIFT) and $8000 <> 0 then
            Eye.X := Eye.X + RunSpeed * TimeDiff
          else
            Eye.X := Eye.X + WalkSpeed * TimeDiff;
          MapProjView.Camera := Eye;
          MapProjView.ResetCamera();
          FScene.SetCoords(FSWindow.MapProjView);
          InvalidateRect(Handle, nil, false);
        end;

        if GetAsyncKeyState(vk_Left) and $8000 <> 0 then
        begin
          Eye := FSWindow.MapProjView.Camera;
          if GetAsyncKeyState(VK_SHIFT) and $8000 <> 0 then
            Eye.Y := Eye.Y + RunSpeed * TimeDiff
          else
            Eye.Y := Eye.Y + WalkSpeed * TimeDiff;
          MapProjView.Camera := Eye;
          MapProjView.ResetCamera();
          FScene.SetCoords(FSWindow.MapProjView);
          InvalidateRect(Handle, nil, false);
        end;

        if GetAsyncKeyState(vk_Right) and $8000 <> 0 then
        begin
          Eye := FSWindow.MapProjView.Camera;
          if GetAsyncKeyState(VK_SHIFT) and $8000 <> 0 then
            Eye.Y := Eye.Y - RunSpeed * TimeDiff
          else
            Eye.Y := Eye.Y - WalkSpeed * TimeDiff;
          MapProjView.Camera := Eye;
          MapProjView.ResetCamera();
          FScene.SetCoords(FSWindow.MapProjView);
          InvalidateRect(Handle, nil, false);
        end;

        if GetAsyncKeyState($43) and $8000 <> 0 then //vk_C
        begin
          Eye := FSWindow.MapProjView.Camera;
          if GetAsyncKeyState(VK_SHIFT) and $8000 <> 0 then
            Eye.Z := Eye.Z - RunSpeed * TimeDiff
          else
            Eye.Z := Eye.Z - WalkSpeed * TimeDiff;
          MapProjView.Camera := Eye;
          MapProjView.ResetCamera();
          FScene.SetCoords(FSWindow.MapProjView);
          InvalidateRect(Handle, nil, false);
        end;

        if GetAsyncKeyState($44) and $8000 <> 0 then //vk_D
        begin
          Eye := FSWindow.MapProjView.Camera;
          if GetAsyncKeyState(VK_SHIFT) and $8000 <> 0 then
            Eye.Z := Eye.Z + RunSpeed * TimeDiff
          else
            Eye.Z := Eye.Z + WalkSpeed * TimeDiff;
          MapProjView.Camera := Eye;
          MapProjView.ResetCamera();
          FScene.SetCoords(FSWindow.MapProjView);
          InvalidateRect(Handle, nil, false);
        end;
        //@
        //@ SceneChanged:=true;

        if SceneChanged then
          Scene.BuildScene(0, nil);
        NeedRerender:=True;
        UpdateWindow(Handle);
      end;
    end
    else
    begin
      if (Msg.message = WM_QUIT) then
        Quit:=True;
      TranslateMessage(Msg);
      DispatchMessage(Msg);
    end;
  end;
  Handle := 0;
  Result:=Msg.wParam;
end;

initialization
  FullScreenWindowClassRegistered := False;
finalization
  if FullScreenWindowClassRegistered then
  begin
    if Windows.UnregisterClass(FullScreenWindowClass.lpszClassName, hInstance) = false then
      Raise EErrorFmt(6014, ['UnregisterClass']);
    FullScreenWindowClassAtom := 0;

    FullScreenWindowClassRegistered := False;
  end;
end.
