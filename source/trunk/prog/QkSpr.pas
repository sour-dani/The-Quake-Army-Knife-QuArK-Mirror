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
unit QkSpr;

interface

uses
  Windows, Messages, SysUtils, Classes, Graphics, Controls, Forms, Dialogs,
  QkForm, QkFileObjects, QSplitter, StdCtrls, ComCtrls, ExtCtrls, TB97,
  QkObjects, Game, Setup, Menus, QkImages, Sprite;

type
  THLSprHeader = packed record // Half Life Sprite
    ident           :  Longint;
    version         :  Longint;
    stype           :  Longint;
    texFormat       :  Longint;
    boundingradius  :  Single;
    width           :  Longint;
    height          :  Longint;
    numframes       :  Longint;
    beamlength      :  Single;
    synctype        :  Longint;
  end;
  TQ1SprHeader = packed record  // Quake 1 Sprite
    ident           :  Longint;
    version         :  Longint;
    stype           :  Longint;
    boundingradius  :  Single;
    width           :  Longint;
    height          :  Longint;
    numframes       :  Longint;
    beamlength      :  Single;
    synctype        :  Longint; //ST_SYNC=0, ST_RAND=1
  end;
  TQ2SprHeader = packed record  // Quake 2 Sprite
    ident: Longint;
    version: Longint;
    noFrames: Longint;
  end;
  TQ2SprFrame = packed record
    x, y, w, h: LongInt;
    fn: array[1..64] of Byte;
  end;
  QSprFile = class(QFileObject)
  public
    function IsExplorerItem(Q: QObject) : TIsExplorerItem; override;
    class function TypeInfo: String; override;
    class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
    procedure ObjectState(var E: TEtatObjet); override;
    function OpenWindow(nOwner: TComponent) : TQForm1; override;
    procedure LoadFile(F: TStream; FSize: TStreamPos); override;
    procedure LoadQ1Spr(fs:TStream; PPPalette:PGameBuffer; Sprite: QSprite);
    procedure LoadHLSpr(Fs:TStream; Sprite: QSprite);
    Procedure WriteQ1Spr(F:TStream);
    Procedure WriteHLSpr(F:TStream);
    procedure SaveFile(Info: TInfoEnreg1); override;
    function Loaded_Frame(Root: QObject; const Name: String; const Size: array of Single; var P: PChar; var DeltaW: Integer; pal: TPaletteLmp) : QImage;
    function Loaded_FrameFile(Root: QObject; const Name: String) : QImage;
    procedure GetWidthHeight(var size:TPoint);
    function GetSprite: QSprite;
    Function CreateSpriteObject: QSprite;
  end;
  QSp2File = class(QSprFile)
  public
    class function TypeInfo: String; override;
    class procedure FileObjectClassInfo(var Info: TFileObjectClassInfo); override;
    procedure LoadFile(F: TStream; FSize: TStreamPos); override;
    procedure SaveFile(Info: TInfoEnreg1); override;
  end;
  TQSprForm = class(TQForm1)
    Panel1: TPanel;
    ListView1: TListView;
    QSplitter1: TQSplitter;
    Panel2: TPanel;
    Label1: TLabel;
    ComboBox2: TComboBox;
    Label2: TLabel;
    ComboBox3: TComboBox;
    Panel3: TPanel;
    ffw: TToolbarButton97;
    play: TToolbarButton97;
    back: TToolbarButton97;
    rew: TToolbarButton97;
    Bevel1: TBevel;
    Label3: TLabel;
    procedure QSplitter1Resized(Sender: TObject; nPosition: Integer);
    procedure FormCreate(Sender: TObject);
    procedure playClick(Sender: TObject);
    procedure ComboBox2Change(Sender: TObject);
    procedure ComboBox3Change(Sender: TObject);
  private
    Index: Longint;
    procedure UpdateListView;
    { Private declarations }
  public
    ImageDisplayer: TImageDisplayer;
    function AssignObject(const Q: QFileObject; State: TFileObjectWndState) : Boolean; override;
    procedure wmInternalMessage(var Msg: TMessage); override;
    { Public declarations }
  end;

(***********  Quake 1/Half-Life 1 .spr format  ***********)
const
  cSignatureSprID = (Ord('P') shl 24) or (ord('S') shl 16) or (ord('D') shl 8) or ord('I'); //"IDSP" = ID Sprite
  cVersionSprQ1H2 = 1;
  cVersionSprHL = 2;

(***********  Quake 2 .spr format  ***********)
const
  cSignatureSprQ2 = (Ord('2') shl 24) or (ord('S') shl 16) or (ord('D') shl 8) or ord('I'); //"IDS2" = ID Sprite 2
  cVersionSprQ2 = 2;

implementation

uses CommCtrl, Math, Quarkx, QkExceptions, QkPcx, QkTextures, QkObjectClassList, qhelper;

{$R *.DFM}

 {------------------------}

Function MyIntSpec(s:QSprFile; const ident:String):Integer; //FIXME: These shouldn't be needed!
begin
  if s.Specifics.IndexOfName(ident)=-1 then
    result:=0
  else
    try
      result:=s.Specifics.Integers[ident];
    except
      on EConvertError do result:=0;
    end;
end;

Function MyStrSpec(s:QSprFile; const ident:String):String; //FIXME: These shouldn't be needed!
begin
  if s.Specifics.IndexOfName(ident)=-1 then
    result:=''
  else
    result:=s.Specifics.Strings[ident];
end;

Function MyFloatSpec(s:QSprFile; const ident:String):Single; //FIXME: These shouldn't be needed!
begin
  if s.Specifics.IndexOfName(ident)=-1 then
    result:=0.0
  else
    try
      result:=s.Specifics.Floats[ident];
    except
      on EConvertError do result:=0.0;
    end;
end;

 {------------------------}
 
function QSprFile.IsExplorerItem(Q: QObject) : TIsExplorerItem;
begin
// if (Q is QSprite) then
//   Result:=ieResult[True]
// else
   Result:=[];
end;

procedure QSprFile.LoadFile(F: TStream; FSize: TStreamPos);
var
  Signature, Version: LongInt;
  pgb: PGameBuffer;
  spr: QSprite;
begin
  case ReadFormat of
    rf_Default: begin  { as stand-alone file }

      F.ReadBuffer(Signature, SizeOf(Signature));
      if (Signature<>cSignatureSprID) then
        raise EErrorFmt(5797, [Signature,cSignatureSprID]); //FIXME: Do errors like in QkBSP!
      F.ReadBuffer(Version, SizeOf(Version));
      F.Seek(-(SizeOf(Signature)+SizeOf(Version)), soCurrent);

      spr:=getsprite;
      if (Version=cVersionSprQ1H2) then
      begin
        pgb:=GameBuffer(mjQuake);
        LoadQ1Spr(F, pgb, spr);
      end
      else if (Version=cVersionSprHL) then
        LoadHLSpr(F, spr)
      else
        raise EErrorFmt(5798, [Version]); //FIXME: Do errors like in QkBSP!
      end;
    else inherited;
  end;
end;

procedure QSprFile.LoadQ1Spr(fs: TStream; PPPalette: PGameBuffer; Sprite: QSprite);
var
  dst: TQ1SprHeader;
  group, i, j, k, nopics{, noframes} :longint;
  pos: TStreamPos;
  xoffset,yoffset,width,height:Longint;
  aPalette: TPaletteLmp;
  P: PChar; //FIXME: ArithByte!
  DeltaW: Integer;
  times: array[1..1024] of Single; //FIXME: Hardcoded limit...? THERE IS NO LIMIT IN Q1!!! REWRITE!!! Make an ARRAY!!! SetLength!!!
begin
  aPalette:=PPPalette^.PaletteLmp;
  fs.ReadBuffer(dst,sizeof(dst));
  if dst.ident<>cSignatureSprID then
    raise EErrorFmt(5799, [dst.ident, cSignatureSprID]); //FIXME: Do errors like in QkBSP!
  if dst.version<>cVersionSprQ1H2 then
    raise EErrorFmt(5800, [dst.version, cVersionSprQ1H2]); //FIXME: Do errors like in QkBSP!
  ObjectGameCode:=mjQuake;
  Self.Specifics.Integers['SPR_STYPE']:=dst.sType;
  Self.Specifics.Integers['SPR_TXTYPE']:=-1;
  Self.Specifics.Floats['SPR_RADIUS']:=dst.boundingradius;
  Self.Specifics.Integers['SPR_WIDTH']:=dst.width;
  Self.Specifics.Integers['SPR_HEIGHT']:=dst.height;
  //FIXME: If dst.numframes < 0 THEN ERROR! Invalid number of frames!
  for i:=1 to dst.numframes do
  begin
    fs.ReadBuffer(group,4);
    if group=0 then
    begin
      fs.ReadBuffer(xoffset,4); //@@@Make into struct?
      fs.ReadBuffer(yoffset,4);
      fs.ReadBuffer(width,4);
      fs.ReadBuffer(height,4);
      Pos:=Fs.Position;
      Loaded_Frame(Sprite, format('Frame %d',[i]), [width,height], p, DeltaW, apalette);
      Fs.Position:=Pos;
      for J:=1 to height do
      begin
        Fs.ReadBuffer(P^, width);
        Inc(P, DeltaW);
      end;
    end
    else
    begin
      fs.readbuffer(nopics,4);
      for j:=1 to nopics do
        fs.readbuffer(times[j],4);
      for j:=1 to nopics do
      begin
        fs.ReadBuffer(xoffset,4); //@@@Make into struct?
        fs.ReadBuffer(yoffset,4);
        fs.ReadBuffer(width,4);
        fs.ReadBuffer(height,4);
        Pos:=Fs.Position;
        Loaded_Frame(Sprite, format('Frame %d',[i]), [width,height], p, DeltaW, apalette);
        Fs.Position:=Pos;
        for k:=1 to height do
        begin
          Fs.ReadBuffer(P^, width);
          Inc(P, DeltaW);
        end;
      end;
    end;
  end;
end;

procedure QSprFile.LoadHLSpr(Fs: TStream; Sprite: QSprite);
var
  dst: THLSprHeader;
  group, i, w, h, lint, lint2, J: Longint;
  pos: TStreamPos;
  DeltaW: Integer;
  PalLen: SmallInt;
  aPalette: TPaletteLmp;         //@@@Al die ReadBuffers-->SizeOf gebruiken!!!
  P: PChar; //FIXME: ArithByte!
begin
  fs.ReadBuffer(dst,sizeof(dst));
  if dst.ident<>cSignatureSprID then
    raise EErrorFmt(5773, [dst.ident,cSignatureSprID]); //FIXME: Do errors like in QkBSP!
  if dst.version<>cVersionSprHL then
    raise EErrorFmt(5774, [dst.version, cVersionSprHL]); //FIXME: Do errors like in QkBSP!
  ObjectGameCode:=mjHalfLife;
  Self.Specifics.Integers['SPR_STYPE']:=dst.sType;
  Self.Specifics.Integers['SPR_TXTYPE']:=dst.texformat;
  Self.Specifics.Floats['SPR_RADIUS']:=dst.boundingradius;
  Self.Specifics.Integers['SPR_WIDTH']:=dst.width;
  Self.Specifics.Integers['SPR_HEIGHT']:=dst.height;
  Self.Specifics.Integers['SPR_NOFRAMES']:=dst.numframes;

  //@@@ https://github.com/yuraj11/HL-Texture-Tools/blob/master/HL%20Texture%20Tools/HLTools/SpriteLoader.cs
  //@@@ https://github.com/Toodles2You/halflife-tools/blob/main/src/sprite.h
  //!!!: https://github.com/ValveSoftware/halflife/blob/master/utils/sprgen/sprgen.c#L80
  //+ https://github.com/ValveSoftware/halflife/blob/master/utils/sprgen/spritegn.h
  fs.ReadBuffer(PalLen, SizeOf(SmallInt)); //Palette will be missing in no16bit mode...! @@@ADD option to allow, or auto-detect???
  //@@@if PalLen < 0 or PalLen > 256 ERROR
  for i:=0 to PalLen-1 do
  begin
    fs.ReadBuffer(lint2,1);
    aPalette[i,0]:=lint2;
    fs.ReadBuffer(lint2,1);
    aPalette[i,1]:=lint2;
    fs.ReadBuffer(lint2,1);
    aPalette[i,2]:=lint2;
  end;
  for i:=1 to dst.numframes do
  begin
    fs.ReadBuffer(group,4);   //@@@Make into struct? Also, what are these int's?    Group    FrameType   SPR_SINGLE or group...?!?    SPR_SINGLE=0, SPR_GROUP } spriteframetype_t;
	  //if group=0 then ETC
    fs.ReadBuffer(lint,4);   //OriginX
    fs.ReadBuffer(lint,4);   //OriginY
    fs.ReadBuffer(W,4);   //@@@?!?
    fs.ReadBuffer(H,4);
    Pos:=Fs.Position;   //@@@Why is this needed...?!?
    Loaded_Frame(Sprite, format('Frame %d',[i]), [w,h], p, DeltaW, apalette);
    Fs.Position:=Pos;
    for J:=1 to h do
    begin
      Fs.ReadBuffer(P^, w);
      Inc(P, DeltaW);
    end;
  end;
end;

Procedure QSprFile.WriteQ1Spr(F: TStream);
var
  Header: TQ1SprHeader;
  i, j, delta: Integer;
  dummy: LongInt;
  P: PByte; //FIXME: ArithByte?
  Image1B: String;
  SkinObj: QImage;
  Spr: QSprite;
  pt: TPoint;
begin
  Header.ident:=cSignatureSprID;
  Header.version:=cVersionSprQ1H2;
  Header.stype:=myIntSpec(self,'SPR_STYPE');
  GetWidthHeight(pt);
  Header.width:=pt.x;
  Header.height:=pt.y;
  Header.boundingradius:=Sqrt(Sqr(Header.width/2)+Sqr(Header.height/2));
  Header.numframes:=SubElements.count;
  Header.beamlength:=0.0; //FIXME: Hardcoded for now!
  Header.synctype:=0; //FIXME: Hardcoded for now!
  F.WriteBuffer(Header, SizeOf(Header));

  Spr:= GetSprite;
  if (Spr = nil) then
    raise EError(5502);

  dummy:=0;
  for i:=1 to SubElements.count do
  begin
    SkinObj:=QImage(spr.SubElements[i-1]);
    SkinObj.NotTrueColor;
    pt:=SkinObj.GetSize;
    f.WriteBuffer(dummy,4);
    f.WriteBuffer(dummy,4);
    f.WriteBuffer(dummy,4);
    f.WriteBuffer(pt.x,4);
    f.WriteBuffer(pt.y,4);
    Image1B:=SkinObj.GetImage1(P);
    Delta:=(Header.width + 3) and not 3;
    Inc(P, Delta*Header.height); //FIXME: check palette
    for j:=1 to Header.height do
    begin
      Dec(P, Delta);
      F.WriteBuffer(P^, Header.width);
    end;
  end;
end;

const
  SpriteName: String = 'Sprite';

Function QSprFile.CreateSpriteObject: QSprite;
begin
  result:=QSprite.Create(SpriteName,Self);
  Subelements.add(Result);
end;

Function QSprFile.getSprite: QSprite;
var
  Obj : QObject;
begin
  Obj:=FindSubObject(SpriteName, QSprite, nil);
  if Obj=nil then
    result:=CreateSpriteObject // if not found then create it.
//  else if not(Obj is QSprite) then
//    result:=CreateSpriteObject // ???
  else
    result:=QSprite(Obj);
end;

procedure QSprFile.GetWidthHeight(var size: TPoint);
var
 SizeTemp:TPoint;
 WTemp,HTemp,i:Longint;
 Spr: QSprite;
begin
  WTemp:=0;HTemp:=0;
  Spr:= GetSprite;
  if (Spr = nil) then
    raise EError(5502);
  for i:=0 to spr.SubElements.Count-1 do begin
    SizeTemp:=QPcx(spr.SubElements.Items1[i]).GetSize;
    WTemp:=Max(SizeTemp.X,WTemp);
    HTemp:=Max(SizeTemp.X,HTemp);
  end;
  Size.X:=WTemp;
  Size.Y:=HTemp;
end;

Procedure QSprFile.WriteHLSpr(F: TStream);
var
  Header: THLSprHeader;
  i, j, delta: Integer;
  dummy: LongInt;
  PalLen: SmallInt;
  P: PByte; //FIXME: ArithByte?
  Image1B: String;
  SkinObj: QImage;
  bt: Byte;
  pt: TPoint;
  Pal: TPaletteLmp;
  Spr: QSprite;
begin
  Header.ident:=cSignatureSprID;
  Header.version:=cVersionSprHL;
  Header.stype:=myIntSpec(self,'SPR_STYPE');
  Header.texFormat:=myIntSpec(self,'SPR_TXTYPE');
  GetWidthHeight(pt);
  Header.width:=pt.x;
  Header.height:=pt.y;
  Header.boundingradius:=Sqrt(Sqr(Header.width/2)+Sqr(Header.height/2));
  Header.numframes:=SubElements.count;
  Header.beamlength:=0.0; //FIXME: Hardcoded for now!
  Header.synctype:=0; //FIXME: Hardcoded for now!
  F.WriteBuffer(Header, SizeOf(Header));

  PalLen:=256; //FIXME: Hardcoded for now!
  f.WriteBuffer(PalLen, SizeOf(PalLen));

  Spr := GetSprite;
  if (Spr = nil) then
    raise EError(5502);
  SkinObj:=QImage(Spr.SubElements[0]); // use palette of first image for sprite.
  SkinObj.NotTrueColor;
  skinobj.GetPaletteNonPtr(pal);
  for i:=0 to 255 do
  begin
    for j:=0 to 2 do
    begin
      bt:=ord(pal[i,j]);
      f.WriteBuffer(bt,1);
    end;
  end;

  dummy:=0;
  for i:=1 to SubElements.count do
  begin
    SkinObj:=QImage(Spr.SubElements[i-1]);
    SkinObj.NotTrueColor;
    pt:=SkinObj.GetSize;
    f.WriteBuffer(dummy,4);
    f.WriteBuffer(dummy,4);
    f.WriteBuffer(dummy,4);
    f.WriteBuffer(pt.x,4);
    f.WriteBuffer(pt.y,4);
    Image1B:=SkinObj.GetImage1(P);
    Delta:=(Header.width + 3) and not 3;
    Inc(P, Delta*Header.height); //FIXME: check palette
    for j:=1 to Header.height do
    begin
      Dec(P, Delta);
      F.WriteBuffer(P^, Header.width);
    end;
  end;
end;

procedure QSp2File.LoadFile(F: TStream; FSize: TStreamPos);
var
  dst: TQ2SprHeader;
  i: Longint;
  frame: TQ2SprFrame;
begin
  f.ReadBuffer(Dst,sizeof(dst));
  if dst.ident<>cSignatureSprQ2 then
    raise EErrorFmt(5801, [dst.ident,cSignatureSprQ2]); //FIXME: Do errors like in QkBSP!
  if dst.version<>cVersionSprQ2 then
    raise EErrorFmt(5802, [dst.version,cVersionSprQ2]); //FIXME: Do errors like in QkBSP!
  ObjectGameCode:=mjQuake2;
  Self.Specifics.Integers['SPR_STYPE']:=-1;
  Self.Specifics.Integers['SPR_TXTYPE']:=-1;
  Self.Specifics.Strings['SPR_RADIUS']:='N / A';
  Self.Specifics.Strings['SPR_WIDTH']:='N / A';
  Self.Specifics.Strings['SPR_HEIGHT']:='N / A';
  Self.Specifics.Integers['SPR_NOFRAMES']:=Dst.noframes;
  For i:=1 to dst.Noframes do
  begin
    f.Readbuffer(frame,sizeof(frame));
    Self.Specifics.Integers[Format('SPR_FRAME%d_CAPTION',[i])]:=i;
    Self.Specifics.Strings[Format('SPR_FRAME%d_FTYPE',[i])]:=CharToPas(frame.fn);
    Self.Specifics.Integers[Format('SPR_FRAME%d_XORG',[i])]:=frame.x;
    Self.Specifics.Integers[Format('SPR_FRAME%d_YORG',[i])]:=frame.y;
    Self.Specifics.Integers[Format('SPR_FRAME%d_WIDTH',[i])]:=frame.w;
    Self.Specifics.Integers[Format('SPR_FRAME%d_HEIGHT',[i])]:=frame.h;
    Self.Specifics.Strings[Format('SPR_FRAME%d_IDATASIZE',[i])]:='N / A';
//    Loaded_FrameFile(self, fStr); //FIXME: Doesn't Work. Wonder Why??
  end;
end;

Procedure QSp2File.SaveFile(Info: TInfoEnreg1);
var
  Header: TQ2SprHeader;
  Frame: TQ2SprFrame;
  i: Longint;
  Data: String;
begin
  with Info do begin
    case Format of
      rf_Default: begin  { as stand-alone file }
        Header.ident:=cSignatureSprQ2;
        Header.version:=cVersionSprQ2;
        Header.noFrames:=IntSpec['SPR_NOFRAMES'];
        F.WriteBuffer(Header, SizeOf(Header));
        for i:=1 to Header.noFrames do
        begin
          Frame.x:=myIntSpec(self,Sysutils.format('SPR_FRAME%d_XORG',[i]));
          Frame.y:=myIntSpec(self,Sysutils.format('SPR_FRAME%d_YORG',[i]));
          Frame.w:=myIntSpec(self,Sysutils.format('SPR_FRAME%d_WIDTH',[i]));
          Frame.h:=myIntSpec(self,Sysutils.format('SPR_FRAME%d_HEIGHT',[i]));
          Data:=myStrSpec(self,Sysutils.format('SPR_FRAME%d_FTYPE',[i]));
          PasToChar(Frame.fn, Data); //FIXME: Cap at 64 Bytes...!
          F.WriteBuffer(Frame, SizeOf(Frame));
        end;
      end;
      else
        inherited;
    end;
  end;
end;

procedure QSprFile.SaveFile(Info: TInfoEnreg1);
var
  fg: TGameCode;
begin
  with Info do
    case Format of
      rf_Default: begin  { as stand-alone file }
        fg:=ObjectGameCode;
        if fg=mjQuake then
          WriteQ1Spr(Info.F)
        else if fg=mjHalfLife then
          WriteHLSpr(Info.F)
        else
          raise EErrorFmt(5796, [fg]);
       end;
    else
      inherited;
  end;
end;

function QSprFile.OpenWindow(nOwner: TComponent) : TQForm1;
begin
  Result:=TQSprForm.Create(nOwner);
end;

class function QSprFile.TypeInfo;
begin
  Result:='.spr';
end;

procedure QSprFile.ObjectState(var E: TEtatObjet);
begin
  inherited;
  E.IndexImage:=iiSpriteFile;
end;

class procedure QSprFile.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
  inherited;
  Info.DescriptionText:=LoadStr1(5171);
  Info.FileExt:=799;
  Info.WndInfo:=[];
end;

function QSprFile.Loaded_Frame(Root: QObject; const Name: String; const Size: array of Single; var P: PChar; var DeltaW: Integer; pal: TPaletteLmp) : QImage;
const
  Spec1 = 'Pal';
  Spec2 = 'Image1';
var
  B: String; //FIXME: Bytes!
begin
  Result:=QPcx.Create(Name, Root);
  Root.SubElements.Add(Result);
  Result.SetFloatsSpec('Size', Size);
  SetLength(B, SizeOf(TPaletteLmp));
  if ObjectGameCode=mjQuake then
    Move(GameBuffer(ObjectGameCode)^.PaletteLmp, B[1], SizeOf(TPaletteLmp))
  else if ObjectGameCode=mjHalfLife then
    Move(pal, B[1], SizeOf(TPaletteLmp));
  Result.Specifics.ByteArray[Spec1]:=B;

  DeltaW:=-((Round(Size[0])+3) and not 3);
  SetLength(B, DeltaW*Round(Size[1]));
  P:=PChar(B)+Length(B)+DeltaW; //FIXME: PArithByte
  Result.Specifics.ByteArray[Spec2]:=B;
end;

function QSprFile.Loaded_FrameFile(Root: QObject; const Name: String) : QImage;
var
  Path: String;
  J: Integer;
  nImage: QFileObject;
begin
  GameBuffer(ObjectGameCode);
  Path:=Name;
  repeat
    nImage:=LoadSibling(Path);
    if nImage<>Nil then
      try
        if nImage is QTextureFile then begin
          Result:=QPcx.Create('', Root);
          try
            Result.ConversionFrom(QTextureFile(nImage));
          except
            Result.Free;
            Raise;
          end;
        end
      else begin
        Result:=nImage as QImage;
        Result:=Result.Clone(Root, False) as QImage;
      end;
      Root.SubElements.Add(Result);
      Result.Name:=Copy(Name, 1, Length(Name)-Length(nImage.TypeInfo));
     {Result.Flags:=Result.Flags or ofFileLink;}
     Exit;
   finally
     nImage.AddRef(-1);
   end;
   J:=Pos('/',Path);
   if J=0 then Break;
   System.Delete(Path, 1, J);
  until False;
  GlobalWarning(FmtLoadStr1(5575, [Name, LoadName]));
  Result:=Nil;
end;

class function QSp2File.TypeInfo;
begin
  Result:='.sp2';
end;

class procedure QSp2File.FileObjectClassInfo(var Info: TFileObjectClassInfo);
begin
  inherited;
  Info.DescriptionText:=LoadStr1(5171);
  Info.FileExt:=800;
  Info.WndInfo:=[wiWindow,wiSameExplorer];
end;

function TQSprForm.AssignObject(const Q: QFileObject; State: TFileObjectWndState) : Boolean;
begin
  Result:=((Q is QSprFile) or (Q is QSp2File))and inherited AssignObject(Q, State);
end;

procedure TQSprForm.QSplitter1Resized(Sender: TObject; nPosition: Integer);
begin
  Panel2.Height:=nPosition;
end;

procedure TQSprForm.wmInternalMessage(var Msg: TMessage);
var
  s: QSprFile;
  fg: TGameCode;
begin
  case Msg.wParam of
    wp_AfficherObjet:
      if FileObject<>Nil then begin
        ListView1.Items.Clear;
        s:=QSprFile(FileObject);
        if FileObject is QSp2File then begin
          ListView1.Visible:=true;
          panel3.visible:=false;
        end else begin
          ListView1.Visible:=false;
          panel3.visible:=true;
          rew.click;
          ImageDisplayer.AutoSize;
        end;
        fg:=s.ObjectGameCode;
        if fg=mjQuake then begin
          Combobox2.Enabled:=true;
          Combobox3.Enabled:=false;
          Combobox2.ItemIndex:=myintspec(s,'SPR_STYPE');
          Combobox3.ItemIndex:=-1;
        end else if fg=mjQuake2 then begin
          Combobox2.Enabled:=false;
          Combobox3.Enabled:=false;
          Combobox2.ItemIndex:=-1;
          Combobox3.ItemIndex:=-1;
        end else if fg=mjHalfLife then begin
          Combobox2.Enabled:=true;
          Combobox3.Enabled:=true;
          Combobox2.ItemIndex:=myintspec(s,'SPR_STYPE');
          Combobox3.ItemIndex:=myintspec(s,'SPR_TXTYPE');
        end;
        UpdateListView;
      end;
    end;
  inherited;
end;

procedure TQSprForm.UpdateListView;
var
  li:TListItem;
  cnt,i:Integer;
  s:QSprFile;
begin
  s:=QSprFile(FileObject);
  listview1.items.clear;
  cnt:=myintspec(s,'SPR_NOFRAMES');
  for i:=1 to cnt do begin
    li:=ListView1.Items.add;
    li.Caption:=s.Specifics.Strings[format('SPR_FRAME%d_CAPTION',[i])];
    li.SubItems.add(s.Specifics.Strings[format('SPR_FRAME%d_FTYPE',[i])]);
    li.SubItems.add(s.Specifics.Strings[format('SPR_FRAME%d_XORG',[i])]); //FIXME: Some of these are integers!!!
    li.SubItems.add(s.Specifics.Strings[format('SPR_FRAME%d_YORG',[i])]);
    li.SubItems.add(s.Specifics.Strings[format('SPR_FRAME%d_WIDTH',[i])]);
    li.SubItems.add(s.Specifics.Strings[format('SPR_FRAME%d_HEIGHT',[i])]);
    li.SubItems.add(s.Specifics.Strings[format('SPR_FRAME%d_IDATASIZE',[i])]);
  end;
end;

Function SetRowSelect(h: THandle): Boolean;
var
  lvflags: DWord;
begin
  lvflags:=SendMessage(h, LVM_GETEXTENDEDLISTVIEWSTYLE, 0, 0);              // Send Message to Get ListViews Flags
  lvflags:=lvflags or LVS_EX_FULLROWSELECT;                                 // Add in Row Select Flag
  result:=bool(SendMessage(h, LVM_SETEXTENDEDLISTVIEWSTYLE, 0, lvflags));   // Send Message to Set ListViews Flags
end;

procedure TQSprForm.FormCreate(Sender: TObject);
begin
  inherited;
  ImageDisplayer:=TImageDisplayer.Create(Self);
  ImageDisplayer.Parent:=Panel1;
  ImageDisplayer.Align:=alClient;
  SetRowSelect(ListView1.Handle);
end;

procedure TQSprForm.playClick(Sender: TObject);
var
  s:QSprite;
  ps:QPcx;
begin
  s:=QSprFile(FileObject).getSprite;
  case TComponent(Sender).Tag of
    -100: index:=0;
     100: index:=s.SubElements.count-1;
       1: if index+1>s.SubElements.count-1 then index:=s.SubElements.count-1 else index:=index+1;
      -1: if index-1<0 then index:=0 else index:=index-1;
    else
      raise EErrorFmt(5803, [TComponent(Sender).Tag]);
  end;
  if index>s.SubElements.count-1 then
    index:=s.SubElements.count-1;
  if index<>-1 then
    if s.SubElements[index]<>nil then begin
      ps:=QPcx(s.SubElements[index]);
      ImageDisplayer.Source:=ps;
      ImageDisplayer.AutoSize;
    end;
  label3.caption:=Format('Frame %d / %d',[(index+1),s.SubElements.Count]);
end;

procedure TQSprForm.ComboBox2Change(Sender: TObject);
begin
  QSprFile(FileObject).Specifics.Integers['SPR_STYPE']:=Combobox2.ItemIndex;
end;

procedure TQSprForm.ComboBox3Change(Sender: TObject);
begin
  QSprFile(FileObject).Specifics.Integers['SPR_TXTYPE']:=Combobox3.ItemIndex;
end;

initialization
  RegisterQObject(QSprFile, 'p');
  RegisterQObject(QSp2File, 'p');
end.
