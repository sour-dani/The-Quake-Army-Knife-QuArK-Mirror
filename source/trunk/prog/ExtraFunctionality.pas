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
unit ExtraFunctionality;

interface

{$I DelphiVer.inc}

uses Classes, Types, Windows, SysUtils{$IFDEF Delphi6orNewerCompiler}, StrUtils{$ENDIF};

type
{$ifndef Delphi2orNewerCompiler}
  AnsiChar = Char;
  PAnsiChar = PChar;
  AnsiString = String;
{$endif}

{$ifndef Delphi4orNewerCompiler}
  Int64 = TLargeInteger;
  PInt64 = ^Int64;
  LongWord = DWORD;
  PLongWord = ^LongWord;
{$endif}

{$ifndef Delphi6orNewerCompiler}
  PByte = ^Byte;
  PInteger = ^Integer;
  PSingle = ^Single;
  PDouble = ^Double;
  PPointer = ^Pointer;
{$endif}

//NativeInt and NativeUInt are not suitable before Delphi 2009, so let's supply our own.
//More information:
//  https://stackoverflow.com/questions/24507704/difference-between-longint-and-integer-longword-and-cardinal
//  https://stackoverflow.com/questions/7630781/delphi-2007-and-xe2-using-nativeint
//  https://blog.dummzeuch.de/2018/09/08/nativeint-nativeuint-type-in-various-delphi-versions/
{$ifndef Delphi2009orNewerCompiler}
{$IFDEF CPU64BITS}
  NativeInt = Int64;
  NativeUInt = UInt64;
{$ELSE}
  //This appears to be true in (32-bit) Delphi
  NativeInt = Integer;
  NativeUInt = Cardinal;
{$ENDIF}

  PNativeInt = ^NativeInt;
  PNativeUInt = ^NativeUInt;
{$else}
{$ifndef Delphi2010orNewerCompiler}
  //Delphi 2009 has a compiler bug with NativeUInt (http://qc.embarcadero.com/wc/qcmain.aspx?d=71292).
{$IFDEF CPU64BITS}
  NativeUInt = UInt64;
{$ELSE}
  //This appears to be true in (32-bit) Delphi
  NativeUInt = Cardinal;
{$ENDIF}

  PNativeUInt = ^NativeUInt;
{$endif}
{$endif}

{$ifdef MSWINDOWS}
  QWORD = {$ifdef Delphi2007orNewerCompiler}UInt64{$else}Int64{$endif}; //UInt64 is known to be broken before Delphi 2007, even if present. Borland also uses Int64 instead in ActiveX.pas
  {$EXTERNALSYM QWORD}
  PQWORD = ^QWORD;
  {$EXTERNALSYM PQWORD}
  LPQWORD = PQWORD;
  {$EXTERNALSYM LPQWORD}

{$ifndef Delphi2009orNewerCompiler}
  DWORDLONG = {$ifdef Delphi2007orNewerCompiler}UInt64{$else}Int64{$endif}; //UInt64 is known to be broken before Delphi 2007, even if present. Borland also uses Int64 instead in ActiveX.pas
  {$EXTERNALSYM DWORDLONG}
{$endif}
  PDWORDLONG = ^DWORDLONG;
  {$EXTERNALSYM PDWORDLONG}
  LPDWORDLONG = PDWORDLONG;
  {$EXTERNALSYM LPDWORDLONG}

{$ifndef Delphi2orNewerCompiler}
  LONGLONG = Int64;
  {$EXTERNALSYM LONGLONG}
{$endif}
  PLONGLONG = ^LONGLONG;
  {$EXTERNALSYM PLONGLONG}

{$ifndef Delphi2007orNewerCompiler}
  ULONGLONG = {$ifdef Delphi2007orNewerCompiler}UInt64{$else}Int64{$endif}; //UInt64 is known to be broken before Delphi 2007, even if present. Borland also uses Int64 instead in ActiveX.pas
  {$EXTERNALSYM ULONGLONG}
{$endif}
  PULONGLONG = ^ULONGLONG;
  {$EXTERNALSYM PULONGLONG}

{$ifndef Delphi2010orNewerCompiler}
  LPBYTE = PByte;
  {$EXTERNALSYM LPBYTE}
  USHORT = Word;
  {$EXTERNALSYM USHORT}
{$endif}
  PUSHORT = ^USHORT;
  {$EXTERNALSYM PUSHORT}

{$ifndef Delphi2010orNewerCompiler}
  PLPCTSTR = ^LPCTSTR;
  PLPTSTR = ^LPTSTR;
{$endif}

{$ifndef Delphi2007orNewerCompiler}
  INT_PTR = Integer;
  {$EXTERNALSYM INT_PTR}
  LONG_PTR = NativeInt;
  {$EXTERNALSYM LONG_PTR}
  UINT_PTR = Cardinal;
  {$EXTERNALSYM UINT_PTR}
  ULONG_PTR = NativeUInt;
  {$EXTERNALSYM ULONG_PTR}

  DWORD_PTR = ULONG_PTR;
  {$EXTERNALSYM DWORD_PTR}
{$endif}
{$ifndef Delphi2010orNewerCompiler}
  HANDLE_PTR = type NativeUInt;
  {$EXTERNALSYM HANDLE_PTR}
{$endif}
{$endif}

  //Delphi is making the mistake of locking their Unicode implementation to UTF-16; we're better than that.
{$IFDEF UNICODE}
  UnicodeChar = WideChar;
  PUnicodeChar = ^WideChar;
{$ENDIF}

  size_t = NativeUInt;
  ssize_t = NativeInt;

  //To support pointer arithmetic, we need a custom datatype, because support for it has changed throughout the years.
  //https://helloacm.com/pointer-arithmetic-in-delphi/
  //Using naming convection suggested by: https://stackoverflow.com/questions/38371432/how-to-handle-pbyte-pointer-operations-in-d5-d7-operator-not-applicable-to-this#comment64189614_38372378
{$ifdef Delphi2009orNewerCompiler}
  ArithByte = Byte;
  PArithByte = PByte;
{$else}
  ArithByte = AnsiChar;
  PArithByte = PAnsiChar;
{$endif}

{$ifdef MSWINDOWS}
{$ifndef Delphi2009orNewerCompiler}
  PMemoryStatusEx = ^TMemoryStatusEx;
  _MEMORYSTATUSEX = record
    dwLength: DWORD;
    dwMemoryLoad: DWORD;
    ullTotalPhys: DWORDLONG;
    ullAvailPhys: DWORDLONG;
    ullTotalPageFile: DWORDLONG;
    ullAvailPageFile: DWORDLONG;
    ullTotalVirtual: DWORDLONG;
    ullAvailVirtual: DWORDLONG;
    ullAvailExtendedVirtual: DWORDLONG;
  end;
  {$EXTERNALSYM _MEMORYSTATUSEX}
  TMemoryStatusEx = _MEMORYSTATUSEX;
  MEMORYSTATUSEX = _MEMORYSTATUSEX;
  {$EXTERNALSYM MEMORYSTATUSEX}
{$endif}

  POSVersionInfoExA = ^TOSVersionInfoExA;
  POSVersionInfoExW = ^TOSVersionInfoExW;
  POSVersionInfoEx = POSVersionInfoExA;
  _OSVERSIONINFOEXA = record
    dwOSVersionInfoSize: DWORD;
    dwMajorVersion: DWORD;
    dwMinorVersion: DWORD;
    dwBuildNumber: DWORD;
    dwPlatformId: DWORD;
    szCSDVersion: array[0..127] of AnsiChar; { Maintenance string for PSS usage }
    wServicePackMajor: WORD;
    wServicePackMinor: WORD;
    wSuiteMask: WORD;
    wProductType: Byte;
    wReserved: Byte;
  end;
  {$EXTERNALSYM _OSVERSIONINFOEXA}
  _OSVERSIONINFOEXW = record
    dwOSVersionInfoSize: DWORD;
    dwMajorVersion: DWORD;
    dwMinorVersion: DWORD;
    dwBuildNumber: DWORD;
    dwPlatformId: DWORD;
    szCSDVersion: array[0..127] of WideChar; { Maintenance string for PSS usage }
    wServicePackMajor: WORD;
    wServicePackMinor: WORD;
    wSuiteMask: WORD;
    wProductType: Byte;
    wReserved: Byte;
  end;
  {$EXTERNALSYM _OSVERSIONINFOEXW}
  TOSVersionInfoExA = _OSVERSIONINFOEXA;
  TOSVersionInfoExW = _OSVERSIONINFOEXW;
  {$IFDEF UNICODE}
  TOSVersionInfoEx = TOSVersionInfoExW;
  {$ELSE}
  TOSVersionInfoEx = TOSVersionInfoExA;
  {$ENDIF}

  RESTRICTIONS = LongWord; //Really: enum
  {$EXTERNALSYM RESTRICTIONS}
  _FIRMWARE_TYPE = LongWord; //Really: enum
  {$EXTERNALSYM _FIRMWARE_TYPE}
  PFIRMWARE_TYPE = ^_FIRMWARE_TYPE;
  {$EXTERNALSYM PFIRMWARE_TYPE}
{$endif}

const
  { Days between TDateTime basis (12/31/1899) and Windows 64-bit timestamp basis (1/1/1601) }
  Win64DateDelta = -109207;

{$ifdef MSWINDOWS}
{$ifndef Delphi3orNewerCompiler}
  DUPLICATE_CLOSE_SOURCE     = $00000001;
  DUPLICATE_SAME_ACCESS      = $00000002;
  MAILSLOT_NO_MESSAGE                 = LongWord(-1);
  MAILSLOT_WAIT_FOREVER               = LongWord(-1);
{$endif}
{$ifndef Delphi7orNewerCompiler}
  SM_CXVIRTUALSCREEN = 78;
  SM_CYVIRTUALSCREEN = 79;
{$endif}
{$ifndef Delphi2006orNewerCompiler}
  IMAGE_FILE_LARGE_ADDRESS_AWARE           = $0020;  { App can handle >2gb addresses }
  {$EXTERNALSYM IMAGE_FILE_LARGE_ADDRESS_AWARE}
{$endif}
{$ifndef Delphi2007orNewerCompiler}
  {$EXTERNALSYM DWM_EC_DISABLECOMPOSITION}
  DWM_EC_DISABLECOMPOSITION         = 0;
  {$EXTERNALSYM DWM_EC_ENABLECOMPOSITION}
  DWM_EC_ENABLECOMPOSITION          = 1;
{$endif}
{$ifndef Delphi2010orNewerCompiler}
  {$EXTERNALSYM GR_GDIOBJECTS_PEAK}
  GR_GDIOBJECTS_PEAK = 2;
  {$EXTERNALSYM GR_USEROBJECTS_PEAK}
  GR_USEROBJECTS_PEAK = 4;
  {$EXTERNALSYM GR_GLOBAL}
  GR_GLOBAL = THandle(-2);
{$endif}
{$ifndef Delphi11orNewerCompiler} //FIXME: Missing in Delphi 2010, but existing in Delphi 11.3!
  VER_SUITE_BACKOFFICE = $00000004;
  VER_SUITE_BLADE = $00000400;
  VER_SUITE_COMPUTE_SERVER = $00004000;
  VER_SUITE_DATACENTER = $00000080;
  VER_SUITE_ENTERPRISE = $00000002;
  VER_SUITE_EMBEDDEDNT = $00000040;
  VER_SUITE_PERSONAL = $00000200;
  VER_SUITE_SINGLEUSERTS = $00000100;
  VER_SUITE_SMALLBUSINESS =$00000001;
  VER_SUITE_SMALLBUSINESS_RESTRICTED =$00000020;
  VER_SUITE_STORAGE_SERVER = $00002000;
  VER_SUITE_TERMINAL = $00000010;
  VER_SUITE_WH_SERVER = $00008000;

  VER_NT_DOMAIN_CONTROLLER = $0000002;
  VER_NT_SERVER = $0000003;
  VER_NT_WORKSTATION = $0000001;

  SM_MEDIACENTER = 87;
  SM_SERVERR2 = 89;
  SM_STARTER = 88;
  SM_TABLETPC = 86;

  //Added in Windows 2000
  REG_QWORD = 11;
  {$EXTERNALSYM REG_QWORD}
  REG_QWORD_LITTLE_ENDIAN = 11;
  {$EXTERNALSYM REG_QWORD_LITTLE_ENDIAN}

  PROCESSOR_ARCHITECTURE_INTEL(*: WORD*) = 0; //x86
  PROCESSOR_ARCHITECTURE_ARM(*: WORD*) = 5; //ARM
  PROCESSOR_ARCHITECTURE_IA64(*: WORD*) = 6; //Intel Itanium Processor Family (IPF)
  PROCESSOR_ARCHITECTURE_AMD64(*: WORD*) = 9; //x64 (AMD or Intel)
  PROCESSOR_ARCHITECTURE_UNKNOWN(*: WORD*) = $FFFF; //Unknown architecture.

  {$EXTERNALSYM COLORMGMTCAPS}
  COLORMGMTCAPS = 121;   { Color Management caps                 }
{$else} //Note: this is a special case! There is a conflicting COLORMGMTCAPS defined by Delphi with an incompatible type, so let's always use this one explicitly
  COLORMGMTCAPS = Windows.COLORMGMTCAPS;
{$endif}

  IMAGE_DLLCHARACTERISTICS_DYNAMIC_BASE = $0040;
  IMAGE_DLLCHARACTERISTICS_NX_COMPAT = $0100;

  UOI_TIMERPROC_EXCEPTION_SUPPRESSION(*: DWORD*) = 7;

  INVALID_SET_FILE_POINTER = DWORD(-1);

  UNLEN = 256; // Maximum user name length, in characters (not bytes), excluding terminating 0-characters.

  PROCESSOR_INTEL_386 = 386;
  PROCESSOR_INTEL_486 = 486;
  PROCESSOR_INTEL_PENTIUM = 586;
  PROCESSOR_INTEL_IA64 = 2200;
  PROCESSOR_AMD_X8664 = 8664;
  //PROCESSOR_ARM = Reserved;

  { Color Management Capabilities }

  {$EXTERNALSYM CM_NONE}
  CM_NONE       = 0;     { ICM not supported          }
  {$EXTERNALSYM CM_DEVICE_ICM}
  CM_DEVICE_ICM = 1;     { Can perform ICM on either the device driver or the device itself }
  {$EXTERNALSYM CM_GAMMA_RAMP}
  CM_GAMMA_RAMP = 2;     { Supports GetDeviceGammaRamp and SetDeviceGammaRamp }
  {$EXTERNALSYM CM_CMYK_COLOR}
  CM_CMYK_COLOR = 4;     { Accepts CMYK color space ICC color profile }

  //RESTRICTIONS:
  REST_NONE = $00000000;
  REST_NORUN = $00000001;
  REST_NOCLOSE = $00000002;
  REST_NOSAVESET = $00000004;
  REST_NOFILEMENU = $00000008;
  REST_NOSETFOLDERS = $00000010;
  REST_NOSETTASKBAR = $00000020;
  REST_NODESKTOP = $00000040;
  REST_NOFIND = $00000080;
  REST_NODRIVES = $00000100;
  REST_NODRIVEAUTORUN = $00000200;
  REST_NODRIVETYPEAUTORUN = $00000400;
  REST_NONETHOOD = $00000800;
  REST_STARTBANNER = $00001000;
  REST_RESTRICTRUN = $00002000;
  REST_NOPRINTERTABS = $00004000;
  REST_NOPRINTERDELETE = $00008000;
  REST_NOPRINTERADD = $00010000;
  REST_NOSTARTMENUSUBFOLDERS = $00020000;
  REST_MYDOCSONNET = $00040000;
  REST_NOEXITTODOS = $00080000;
  REST_ENFORCESHELLEXTSECURITY = $00100000;
  REST_LINKRESOLVEIGNORELINKINFO = $00200000;
  REST_NOCOMMONGROUPS = $00400000;
  REST_SEPARATEDESKTOPPROCESS = $00800000;
  REST_NOWEB = $01000000;
  REST_NOTRAYCONTEXTMENU = $02000000;
  REST_NOVIEWCONTEXTMENU = $04000000;
  REST_NONETCONNECTDISCONNECT = $08000000;
  REST_STARTMENULOGOFF = $10000000;
  REST_NOSETTINGSASSIST = $20000000;
  REST_NOINTERNETICON = $40000001;
  REST_NORECENTDOCSHISTORY = $40000002;
  REST_NORECENTDOCSMENU = $40000003;
  REST_NOACTIVEDESKTOP = $40000004;
  REST_NOACTIVEDESKTOPCHANGES = $40000005;
  REST_NOFAVORITESMENU = $40000006;
  REST_CLEARRECENTDOCSONEXIT = $40000007;
  REST_CLASSICSHELL = $40000008;
  REST_NOCUSTOMIZEWEBVIEW = $40000009;
  REST_NOHTMLWALLPAPER = $40000010;
  REST_NOCHANGINGWALLPAPER = $40000011;
  REST_NODESKCOMP = $40000012;
  REST_NOADDDESKCOMP = $40000013;
  REST_NODELDESKCOMP = $40000014;
  REST_NOCLOSEDESKCOMP = $40000015;
  REST_NOCLOSE_DRAGDROPBAND = $40000016;
  REST_NOMOVINGBAND = $40000017;
  REST_NOEDITDESKCOMP = $40000018;
  REST_NORESOLVESEARCH = $40000019;
  REST_NORESOLVETRACK = $4000001A;
  REST_FORCECOPYACLWITHFILE = $4000001B;
  REST_NOLOGO3CHANNELNOTIFY = $4000001C;
  REST_NOFORGETSOFTWAREUPDATE = $4000001D;
  REST_NOSETACTIVEDESKTOP = $4000001E;
  REST_NOUPDATEWINDOWS = $4000001F;
  REST_NOCHANGESTARMENU = $40000020;
  REST_NOFOLDEROPTIONS = $40000021;
  REST_HASFINDCOMPUTERS = $40000022;
  REST_INTELLIMENUS = $40000023;
  REST_RUNDLGMEMCHECKBOX = $40000024;
  REST_ARP_ShowPostSetup = $40000025;
  REST_NOCSC = $40000026;
  REST_NOCONTROLPANEL = $40000027;
  REST_ENUMWORKGROUP = $40000028;
  REST_ARP_NOARP = $40000029;
  REST_ARP_NOREMOVEPAGE = $4000002A;
  REST_ARP_NOADDPAGE = $4000002B;
  REST_ARP_NOWINSETUPPAGE = $4000002C;
  REST_GREYMSIADS = $4000002D;
  REST_NOCHANGEMAPPEDDRIVELABEL = $4000002E;
  REST_NOCHANGEMAPPEDDRIVECOMMENT = $4000002F;
  REST_MaxRecentDocs = $40000030;
  REST_NONETWORKCONNECTIONS = $40000031;
  REST_FORCESTARTMENULOGOFF = $40000032;
  REST_NOWEBVIEW = $40000033;
  REST_NOCUSTOMIZETHISFOLDER = $40000034;
  REST_NOENCRYPTION = $40000035;
  REST_DONTSHOWSUPERHIDDEN = $40000037;
  REST_NOSHELLSEARCHBUTTON = $40000038;
  REST_NOHARDWARETAB = $40000039;
  REST_NORUNASINSTALLPROMPT = $4000003A;
  REST_PROMPTRUNASINSTALLNETPATH = $4000003B;
  REST_NOMANAGEMYCOMPUTERVERB = $4000003C;
  REST_DISALLOWRUN = $4000003E;
  REST_NOWELCOMESCREEN = $4000003F;
  REST_RESTRICTCPL = $40000040;
  REST_DISALLOWCPL = $40000041;
  REST_NOSMBALLOONTIP = $40000042;
  REST_NOSMHELP = $40000043;
  REST_NOWINKEYS = $40000044;
  REST_NOENCRYPTONMOVE = $40000045;
  REST_NOLOCALMACHINERUN = $40000046;
  REST_NOCURRENTUSERRUN = $40000047;
  REST_NOLOCALMACHINERUNONCE = $40000048;
  REST_NOCURRENTUSERRUNONCE = $40000049;
  REST_FORCEACTIVEDESKTOPON = $4000004A;
  REST_NOVIEWONDRIVE = $4000004C;
  REST_NONETCRAWL = $4000004D;
  REST_NOSHAREDDOCUMENTS = $4000004E;
  REST_NOSMMYDOCS = $4000004F;
  REST_NOSMMYPICS = $40000050;
  REST_ALLOWBITBUCKDRIVES = $40000051;
  REST_NONLEGACYSHELLMODE = $40000052;
  REST_NOCONTROLPANELBARRICADE = $40000053;
  REST_NOSTARTPAGE = $40000054;
  REST_NOAUTOTRAYNOTIFY = $40000055;
  REST_NOTASKGROUPING = $40000056;
  REST_NOCDBURNING = $40000057;
  REST_MYCOMPNOPROP = $40000058;
  REST_MYDOCSNOPROP = $40000059;
  REST_NOSTARTPANEL = $4000005A;
  REST_NODISPLAYAPPEARANCEPAGE = $4000005B;
  REST_NOTHEMESTAB = $4000005C;
  REST_NOVISUALSTYLECHOICE = $4000005D;
  REST_NOSIZECHOICE = $4000005E;
  REST_NOCOLORCHOICE = $4000005F;
  REST_SETVISUALSTYLE = $40000060;
  REST_STARTRUNNOHOMEPATH = $40000061;
  REST_NOUSERNAMEINSTARTPANEL = $40000062;
  REST_NOMYCOMPUTERICON = $40000063;
  REST_NOSMNETWORKPLACES = $40000064;
  REST_NOSMPINNEDLIST = $40000065;
  REST_NOSMMYMUSIC = $40000066;
  REST_NOSMEJECTPC = $40000067;
  REST_NOSMMOREPROGRAMS = $40000068;
  REST_NOSMMFUPROGRAMS = $40000069;
  REST_NOTRAYITEMSDISPLAY = $4000006A;
  REST_NOTOOLBARSONTASKBAR = $4000006B;
  REST_NOSMCONFIGUREPROGRAMS = $4000006F;
  REST_HIDECLOCK = $40000070;
  REST_NOLOWDISKSPACECHECKS = $40000071;
  REST_NOENTIRENETWORK = $40000072;
  REST_NODESKTOPCLEANUP = $40000073;
  REST_BITBUCKNUKEONDELETE = $40000074;
  REST_BITBUCKCONFIRMDELETE = $40000075;
  REST_BITBUCKNOPROP = $40000076;
  REST_NODISPBACKGROUND = $40000077;
  REST_NODISPSCREENSAVEPG = $40000078;
  REST_NODISPSETTINGSPG = $40000079;
  REST_NODISPSCREENSAVEPREVIEW = $4000007A;
  REST_NODISPLAYCPL = $4000007B;
  REST_HIDERUNASVERB = $4000007C;
  REST_NOTHUMBNAILCACHE = $4000007D;
  REST_NOSTRCMPLOGICAL = $4000007E;
  REST_NOPUBLISHWIZARD = $4000007F;
  REST_NOONLINEPRINTSWIZARD = $40000080;
  REST_NOWEBSERVICES = $40000081;
  REST_ALLOWUNHASHEDWEBVIEW = $40000082;
  REST_ALLOWLEGACYWEBVIEW = $40000083;
  REST_REVERTWEBVIEWSECURITY = $40000084;
  REST_INHERITCONSOLEHANDLES = $40000086;
  REST_SORTMAXITEMCOUNT = $40000087;
  REST_NOREMOTERECURSIVEEVENTS = $40000089;
  REST_NOREMOTECHANGENOTIFY = $40000091;
  REST_NOSIMPLENETIDLIST = $40000092;
  REST_NOENUMENTIRENETWORK = $40000093;
  REST_NODETAILSTHUMBNAILONNETWORK = $40000094;
  REST_NOINTERNETOPENWITH = $40000095;
  REST_DONTRETRYBADNETNAME = $4000009B;
  REST_ALLOWFILECLSIDJUNCTIONS = $4000009C;
  REST_NOUPNPINSTALL = $4000009D;
  REST_ARP_DONTGROUPPATCHES = $400000AC;
  REST_ARP_NOCHOOSEPROGRAMSPAGE = $400000AD;
  REST_NODISCONNECT = $41000001;
  REST_NOSECURITY = $41000002;
  REST_NOFILEASSOCIATE = $41000003;
  REST_ALLOWCOMMENTTOGGLE = $41000004;
  REST_USEDESKTOPINICACHE = $41000005;

  //_FIRMWARE_TYPE:
  FirmwareTypeUnknown = 0;
  FirmwareTypeBios = 1;
  FirmwareTypeUefi = 2;
  FirmwareTypeMax = 3;

//This is a macro that wasn't converted.
function CopyCursor(pcur: HCursor): HCursor;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
{$endif}

{$ifndef DelphiXE6orNewerCompiler} //FIXME: Not sure about the version of Delphi these were added
function StrToUInt(const S: string): Cardinal;
function StrToUIntDef(const S: string; Default: Cardinal): Cardinal;
function TryStrToUInt(const S: string; out Value: Cardinal): Boolean;
{$endif}

{$ifndef DelphiXE6orNewerCompiler} //FIXME: Not sure about the version of Delphi these were added
function UIntToStr(Value: Cardinal): string; overload;
{$ifdef Delphi2007orNewerCompiler} //UInt64 is known to be broken before Delphi 2007, even if present. Borland also uses Int64 instead in ActiveX.pas
function UIntToStr(Value: UInt64): string; overload;
{$else}
function UIntToStr(Value: Int64): string; overload;
{$endif}
{$endif}

{$ifndef Delphi2005orNewerCompiler}
function ContainsText(const AText, ASubText: string): Boolean;
function StartsText(const ASubText, AText: string): Boolean;
function EndsText(const ASubText, AText: string): Boolean;
function ContainsStr(const AText, ASubText: string): Boolean;
function StartsStr(const ASubText, AText: string): Boolean;
function EndsStr(const ASubText, AText: string): Boolean;
{$endif}

//These are missing altogether:
function DateTimeToWin64(const AValue: TDateTime): QWORD;
function Win64ToDateTime(const AValue: QWORD): TDateTime;

{$ifndef Delphi2009orNewerCompiler}
var
  CPUCount: Integer;
{$endif}

{$ifdef MSWINDOWS}
{$ifdef Delphi2010orNewerCompiler} //Use delayed loading
{$ifndef Delphi2007orNewerCompiler}
function DwmEnableComposition(uCompositionAction: UINT): HResult; stdcall;
{$EXTERNALSYM DwmEnableComposition}
function DwmEnableComposition(uCompositionAction: UINT): HResult; external 'DWMAPI.DLL' name 'DwmEnableComposition' delayed;

//function DwmIsCompositionEnabled(out pfEnabled: BOOL): HResult; stdcall;
//{$EXTERNALSYM DwmIsCompositionEnabled}
//function DwmIsCompositionEnabled(out pfEnabled: BOOL): HResult; external 'DWMAPI.DLL' name 'DwmIsCompositionEnabled' delayed;
{$endif}

{$ifndef Delphi2009orNewerCompiler}
function GlobalMemoryStatusEx(var lpBuffer : TMEMORYSTATUSEX): BOOL; stdcall;
{$EXTERNALSYM GlobalMemoryStatusEx}
function GlobalMemoryStatusEx; external kernel32 name 'GlobalMemoryStatusEx' delayed;

procedure GetNativeSystemInfo(var lpSystemInformation: TSystemInfo); stdcall;
{$EXTERNALSYM GetNativeSystemInfo}
procedure GetNativeSystemInfo; external kernel32 name 'GetNativeSystemInfo' delayed;

function GetErrorMode(): UINT; stdcall;
{$EXTERNALSYM GetErrorMode}
function GetErrorMode; external kernel32 name 'GetErrorMode' delayed;

function SetDllDirectory(lpPathName: LPCWSTR): BOOL; stdcall;
{$EXTERNALSYM SetDllDirectory}
function SetDllDirectoryA(lpPathName: LPCSTR): BOOL; stdcall;
{$EXTERNALSYM SetDllDirectoryA}
function SetDllDirectoryW(lpPathName: LPCWSTR): BOOL; stdcall;
{$EXTERNALSYM SetDllDirectoryW}
function SetDllDirectory; external kernel32 name {$IFDEF UNICODE}'SetDllDirectoryW'{$ELSE}'SetDllDirectoryA'{$ENDIF} delayed;
function SetDllDirectoryA; external kernel32 name 'SetDllDirectoryA' delayed;
function SetDllDirectoryW; external kernel32 name 'SetDllDirectoryW' delayed;

function IsWow64Process(hProcess: THandle; Wow64Process: PBOOL): BOOL; overload; stdcall;
function IsWow64Process(hProcess: THandle; var Wow64Process: BOOL): BOOL; overload; stdcall;
{$EXTERNALSYM IsWow64Process}
function IsWow64Process(hProcess: THandle; Wow64Process: PBOOL): BOOL; external kernel32 name 'IsWow64Process' delayed;
function IsWow64Process(hProcess: THandle; var Wow64Process: BOOL): BOOL; external kernel32 name 'IsWow64Process' delayed;

function IsWow64Process2(hProcess: THandle; pProcessMachine: PUSHORT; pNativeMachine: PUSHORT): BOOL; overload; stdcall;
function IsWow64Process2(hProcess: THandle; var pProcessMachine: USHORT; var pNativeMachine: USHORT): BOOL; overload; stdcall;
{$EXTERNALSYM IsWow64Process2}
function IsWow64Process2(hProcess: THandle; pProcessMachine: PUSHORT; pNativeMachine: PUSHORT): BOOL; external kernel32 name 'IsWow64Process2' delayed;
function IsWow64Process2(hProcess: THandle; var pProcessMachine: USHORT; var pNativeMachine: USHORT): BOOL; external kernel32 name 'IsWow64Process2' delayed;

function GetTickCount64: ULONGLONG; stdcall;
{$EXTERNALSYM GetTickCount64}
function GetTickCount64; external kernel32 name 'GetTickCount64' delayed;
{$endif}

function GetFirmwareType(FirmwareType: PFIRMWARE_TYPE): BOOL; overload; stdcall;
function GetFirmwareType(var FirmwareType: _FIRMWARE_TYPE): BOOL; overload; stdcall;
{$EXTERNALSYM GetFirmwareType}
function GetFirmwareType(FirmwareType: PFIRMWARE_TYPE): BOOL; external kernel32 name 'GetFirmwareType' delayed;
function GetFirmwareType(var FirmwareType: _FIRMWARE_TYPE): BOOL; external kernel32 name 'GetFirmwareType' delayed;

function SHRestricted(rest: RESTRICTIONS): DWORD; stdcall;
{$EXTERNALSYM SHRestricted}
function SHRestricted; external 'shell32.dll' name 'SHRestricted' delayed;
{$else}
var
{$ifndef Delphi2007orNewerCompiler}
  DwmEnableComposition: function (uCompositionAction: UINT): HResult; stdcall;
  //DwmIsCompositionEnabled: function (out pfEnabled: BOOL): HResult; stdcall;
{$endif}
{$ifndef Delphi11orNewerCompiler}
  GlobalMemoryStatusEx: function (var lpBuffer: TMemoryStatusEx): BOOL; stdcall;
  GetNativeSystemInfo: procedure (var lpSystemInformation: TSystemInfo); stdcall;
  GetErrorMode: function : UINT; stdcall;
  SetDllDirectory: function (lpPathName: LPCTSTR): BOOL; stdcall;
  SetDllDirectoryA: function (lpPathName: LPCSTR): BOOL; stdcall;
  SetDllDirectoryW: function (lpPathName: LPCWSTR): BOOL; stdcall;
  IsWow64Process: function (hProcess: THandle; var Wow64Process: BOOL): BOOL; stdcall;
  IsWow64Process2: function (hProcess: THandle; var pProcessMachine: USHORT; var pNativeMachine: USHORT): BOOL; stdcall;
  GetTickCount64: function: ULONGLONG; stdcall;
{$endif}
  GetFirmwareType: function (var FirmwareType: _FIRMWARE_TYPE): BOOL; stdcall;
  SHRestricted: function (rest: RESTRICTIONS): DWORD; stdcall;
{$endif}
{$endif}

type
  TMemoryStreamWithCapacity = class(TMemoryStream)
  public
    property Capacity;
  end;
{$IFDEF CompiledWithDelphi2}
  TCustomForm = TForm;
{$ENDIF}

{$ifndef Delphi6orNewerCompiler}
type
{ TStream seek origins }
  TSeekOrigin = (soBeginning, soCurrent, soEnd);
{$ENDIF}

{$ifndef Delphi2orNewerCompiler}
{ CompareMem performs a binary compare of Length bytes of memory referenced
  by P1 to that of P2.  CompareMem returns True if the memory referenced by
  P1 is identical to that of P2. }
function CompareMem(P1, P2: Pointer; Length: Integer): Boolean; assembler;
{$endif}

{$ifndef Delphi5orNewerCompiler}
{ SameText compares S1 to S2, without case-sensitivity. Returns true if
  S1 and S2 are the equal, that is, if CompareText would return 0. SameText
  has the same 8-bit limitations as CompareText }
function SameText(const S1, S2: string): Boolean;

{ AnsiSameStr compares S1 to S2, with case-sensitivity. The compare
  operation is controlled by the current Windows locale. The return value
  is True if AnsiCompareStr would have returned 0. }
function AnsiSameStr(const S1, S2: string): Boolean;

{ AnsiSameText compares S1 to S2, without case-sensitivity. The compare
  operation is controlled by the current Windows locale. The return value
  is True if AnsiCompareText would have returned 0. }
function AnsiSameText(const S1, S2: string): Boolean;

{ FreeAndNil frees the given TObject instance and sets the variable reference
  to nil.  Be careful to only pass TObjects to this routine. }
procedure FreeAndNil(var Obj);
{$endif}

{$ifndef Delphi6orNewerCompiler}
{ IsPathDelimiter returns True if the character at byte S[Index]
  is a PathDelimiter ('\' or '/'), and it is not a MBCS lead or trail byte. }
function IsPathDelimiter(const S: string; Index: Integer): Boolean;

{ IncludeTrailingPathDelimiter returns the path with a PathDelimiter
  ('/' or '\') at the end.  This function is MBCS enabled. }
function IncludeTrailingPathDelimiter(const S: string): string;

{ ExcludeTrailingPathDelimiter returns the path without a PathDelimiter
  ('\' or '/') at the end.  This function is MBCS enabled. }
function ExcludeTrailingPathDelimiter(const S: string): string;

const
  PathDelim  = {$IFDEF MSWINDOWS} '\'; {$ELSE} '/'; {$ENDIF}
  DriveDelim = {$IFDEF MSWINDOWS} ':'; {$ELSE} '';  {$ENDIF}
  PathSep    = {$IFDEF MSWINDOWS} ';'; {$ELSE} ':'; {$ENDIF}
  sLineBreak = {$IFDEF LINUX} #10 {$ENDIF} {$IFDEF MSWINDOWS} #13#10 {$ENDIF};

function StrToFloatDef(const S: String; const Default: Extended) : Extended;

function RightStr(Const Str: String; Size: Word): String;

function MidStr(Const Str: String; From, Size: Word): String;

function LeftStr(Const Str: String; Size: Word): String;

{ Returns the reverse of a specified string. }
function ReverseString(const AText: string): string;

function BoolToStr(B: Boolean; UseBoolStrs: Boolean = False): string;
{$endif}

{$ifndef Delphi7orNewerCompiler}
{ PosEx searches for SubStr in S and returns the index position of
  SubStr if found and 0 otherwise.  If Offset is not given then the result is
  the same as calling Pos.  If Offset is specified and > 1 then the search
  starts at position Offset within S.  If Offset is larger than Length(S)
  then PosEx returns 0.  By default, Offset equals 1. }
function PosEx(const SubStr, S: string; Offset: Cardinal = 1): Integer;

//This was added in Delphi 6 Update Pack 2.
{$ifdef MSWINDOWS}
{$IF not Defined(CheckWin32Version)}
{$define ExtraFunc_CheckWin32Version}
function CheckWin32Version(AMajor: Integer; AMinor: Integer = 0): Boolean;
{$ifend}
{$endif}
{$endif}

{$ifndef DelphiXEorNewerCompiler}
function SplitString(const S, Delimiters: string): TStringDynArray;
{$endif}

//This function doesn't exist at all in Delphi:
function LastPos(const SubStr: String; const S: String): Integer;

function CharInSet(C: AnsiChar; const CharSet: TSysCharSet): Boolean; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
{$ifndef Delphi2orNewerCompiler}
function CharInSet(C: WideChar; const CharSet: TSysCharSet): Boolean; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}
{$endif}
//function CharInSet(C: UnicodeChar; const CharSet: TSysCharSet): Boolean; overload;{$IFDEF Delphi2005orNewerCompiler} inline;{$ENDIF}

//These functions doesn't exist at all in Delphi:
{$ifdef MSWINDOWS}
function CheckWin32VersionWithServicePack(AMajor: Integer; AMinor: Integer = 0; AServicePackMajor: Integer = 0; AServicePackMinor: Integer = 0): Boolean; //Note: We use the wrong datatype to be consistent with CheckWin32Version.
function CheckWin32VersionWithBuildNumber(AMajor: Integer; AMinor: Integer = 0; ABuildNumber: Integer = 0): Boolean; //Note: We use the wrong datatype to be consistent with CheckWin32Version.
{$endif}
{$ifndef Delphi2orNewerCompiler}
function WideLowerCaseFileName(const S: WideString): WideString;
function WideCompareFileName(const S1, S2: WideString): Integer;
{$endif}
{$IFDEF UNICODE}
function UnicodeLowerCaseFileName(const S: UnicodeString): string;
function UnicodeCompareFileName(const S1, S2: UnicodeString): Integer;
{$ENDIF}

//This function doesn't exist at all in Delphi:
function CompareFileName(const S1, S2: string): Integer;
procedure CleanupFileName(var S: String);

//For delay loading functionality:
{$ifdef MSWINDOWS}
var
  DelayFunc_DwmEnableComposition: Boolean;
  //DelayFunc_DwmIsCompositionEnabled: Boolean;
  DelayFunc_GlobalMemoryStatusEx: Boolean;
  DelayFunc_GetNativeSystemInfo: Boolean;
  DelayFunc_GetErrorMode: Boolean;
  DelayFunc_SetDllDirectoryA: Boolean;
  DelayFunc_SetDllDirectoryW: Boolean;
  DelayFunc_SetDllDirectory: Boolean;
  DelayFunc_IsWow64Process: Boolean;
  DelayFunc_IsWow64Process2: Boolean;
  DelayFunc_GetTickCount64: Boolean;
  DelayFunc_GetFirmwareType: Boolean;
  DelayFunc_SHRestricted: Boolean;
{$endif}

implementation

{$ifdef MSWINDOWS}
{$ifndef Delphi2010orNewerCompiler} //NOT Use delayed loading
//Only used for DelayFunc.
var
  ShellLib, DWMAPILib: HMODULE;
{$endif}

function CopyCursor(pcur: HCursor): HCursor;
begin
  Result:=HCURSOR(CopyIcon(HICON(pcur)));
end;
{$endif}

{$ifndef DelphiXE6orNewerCompiler}
function StrToUInt(const S: string): Cardinal;
const
  SInvalidCardinal = '''%s'' is not a valid cardinal value';
begin
  if not TryStrToUInt(S, Result) then EConvertError.Create(Format(SInvalidCardinal, [S]));
end;

function StrToUIntDef(const S: string; Default: Cardinal): Cardinal;
begin
  if not TryStrToUInt(S, Result) then Result:=Default;
end;

function TryStrToUInt(const S: string; out Value: Cardinal): Boolean;
const
  MaxCardinal = 4294967295; //FIXME: Use Cardinal.MaxValue in Delphi 11.3
var
  Dummy: Int64;
begin
  Result:=False;

  //Go through Int64
  if not TryStrToInt64(S, Dummy) then
    Exit;

  //And then check the bounds
  if (Dummy < 0) or (Dummy > MaxCardinal) then
    Exit;

  Value:=Cardinal(Dummy);
  Result:=True;
end;
{$endif}

{$ifndef DelphiXE6orNewerCompiler}
function UIntToStr(Value: Cardinal): string;
begin
  FmtStr(Result, '%u', [Value]);
end;

{$ifdef Delphi2007orNewerCompiler}
function UIntToStr(Value: UInt64): string;
begin
  FmtStr(Result, '%u', [Value]);
end;
{$else}
function UIntToStr(Value: Int64): string;
begin
  FmtStr(Result, '%u', [Value]);
end;
{$endif}
{$endif}

{$ifndef Delphi2005orNewerCompiler}
function ContainsText(const AText, ASubText: string): Boolean;
begin
  Result := AnsiContainsText(AText, ASubText); //Note: Apparently, this function is misnamed, and it handles unicode too!
end;

function StartsText(const ASubText, AText: string): Boolean;
begin
  Result := AnsiStartsText(ASubText, AText); //Note: Apparently, this function is misnamed, and it handles unicode too!
end;

function EndsText(const ASubText, AText: string): Boolean;
begin
  Result := AnsiEndsText(ASubText, AText); //Note: Apparently, this function is misnamed, and it handles unicode too!
end;

function ContainsStr(const AText, ASubText: string): Boolean;
begin
  Result := AnsiContainsStr(AText, ASubText); //Note: Apparently, this function is misnamed, and it handles unicode too!
end;

function StartsStr(const ASubText, AText: String): Boolean;
begin
  Result := AnsiStartsStr(ASubText, AText); //Note: Apparently, this function is misnamed, and it handles unicode too!
end;

function EndsStr(const ASubText, AText: String): Boolean;
begin
 Result := AnsiEndsStr(ASubText, AText); //Note: Apparently, this function is misnamed, and it handles unicode too!
end;
{$endif}

function DateTimeToWin64(const AValue: TDateTime): QWORD;
begin
  Result := Round((AValue - Win64DateDelta) * SecsPerDay * 100000000);
end;

function Win64ToDateTime(const AValue: QWORD): TDateTime;
begin
  Result := AValue / SecsPerDay / 100000000 + Win64DateDelta;
end;

{$ifndef Delphi2orNewerCompiler}
function CompareMem(P1, P2: Pointer; Length: Integer): Boolean; assembler;
asm
        PUSH    ESI
        PUSH    EDI
        MOV     ESI,P1
        MOV     EDI,P2
        MOV     EDX,ECX
        XOR     EAX,EAX
        AND     EDX,3
        SAR     ECX,2
        JS      @@1     // Negative Length implies identity.
        REPE    CMPSD
        JNE     @@2
        MOV     ECX,EDX
        REPE    CMPSB
        JNE     @@2
@@1:    INC     EAX
@@2:    POP     EDI
        POP     ESI
end;
{$endif}

{$ifndef Delphi5orNewerCompiler}
function SameText(const S1, S2: string): Boolean; assembler;
asm
        CMP     EAX,EDX
        JZ      @1
        OR      EAX,EAX
        JZ      @2
        OR      EDX,EDX
        JZ      @3
        MOV     ECX,[EAX-4]
        CMP     ECX,[EDX-4]
        JNE     @3
        CALL    CompareText
        TEST    EAX,EAX
        JNZ     @3
@1:     MOV     AL,1
@2:     RET
@3:     XOR     EAX,EAX
end;

function AnsiSameStr(const S1, S2: string): Boolean;
begin
  Result := CompareString(LOCALE_USER_DEFAULT, 0, PChar(S1), Length(S1),
    PChar(S2), Length(S2)) = 2;
end;

function AnsiSameText(const S1, S2: string): Boolean;
begin
  Result := CompareString(LOCALE_USER_DEFAULT, NORM_IGNORECASE, PChar(S1),
    Length(S1), PChar(S2), Length(S2)) = 2;
end;

procedure FreeAndNil(var Obj);
var
  P: TObject;
begin
  P := TObject(Obj);
  TObject(Obj) := nil;  // clear the reference before destroying the object
  P.Free;
end;
{$endif}

{$ifndef Delphi6orNewerCompiler}
function IsPathDelimiter(const S: string; Index: Integer): Boolean;
begin
  Result := (Index > 0) and (Index <= Length(S)) and (S[Index] = PathDelim)
    and (ByteType(S, Index) = mbSingleByte);
end;

function IncludeTrailingPathDelimiter(const S: string): string;
begin
  Result := S;
  if not IsPathDelimiter(Result, Length(Result)) then
    Result := Result + PathDelim;
end;

function ExcludeTrailingPathDelimiter(const S: string): string;
begin
  Result := S;
  if IsPathDelimiter(Result, Length(Result)) then
    SetLength(Result, Length(Result)-1);
end;

function StrToFloatDef(const S: String; const Default: Extended) : Extended;
begin
 if S='' then
  Result:=Default
 else
  try
   Result:=StrToFloat(S);
  except
   Result:=Default;
  end;
end;

function RightStr(Const Str: String; Size: Word): String;
begin
  if Size > Length(Str) then Size := Length(Str) ;
  RightStr := Copy(Str, Length(Str)-Size+1, Size)
end;

function MidStr(Const Str: String; From, Size: Word): String;
begin
  MidStr := Copy(Str, From, Size)
end;

function LeftStr(Const Str: String; Size: Word): String;
begin
  LeftStr := Copy(Str, 1, Size)
end;

function ReverseString(const AText: string): string;
var
  I: Integer;
  P: PChar;
begin
  SetLength(Result, Length(AText));
  P := PChar(Result);
  for I := Length(AText) downto 1 do
  begin
    P^ := AText[I];
    Inc(P);
  end;
end;

function BoolToStr(B: Boolean; UseBoolStrs: Boolean = False): string;
const
  cSimpleBoolStrs: array [boolean] of String = ('0', '-1');
begin
  if UseBoolStrs then
    //This is a down-scaled version of BoolToStr, that doesn't
    //support UseBoolStrs.
    raise exception.create('BoolToStr: UseBoolStrs not implemented!')
  else
    Result := cSimpleBoolStrs[B];
end;
{$endif}

{$ifndef Delphi7orNewerCompiler}
function PosEx(const SubStr, S: string; Offset: Cardinal = 1): Integer;
begin
  //This code is NOT copied from the StrUtils, so it MIGHT react differently!
  Result := Pos(SubStr, RightStr(S, Length(S) - Offset));
  if Result <> 0 then
    Result := Result + Offset;
end;

{$ifdef MSWINDOWS}
{$ifdef ExtraFunc_CheckWin32Version}
function CheckWin32Version(AMajor: Integer; AMinor: Integer = 0): Boolean;
begin
  Result := (Win32MajorVersion > AMajor) or
            ((Win32MajorVersion = AMajor) and
             (Win32MinorVersion >= AMinor));
end;
{$endif}
{$endif}
{$endif}

{$ifndef DelphiXEorNewerCompiler}
function SplitString(const S, Delimiters: string): TStringDynArray;
var
  I, LastFound: Integer;
begin
  LastFound:=0;
  for I:=1 to Length(S) do
  begin
    if Pos(S[I], Delimiters)<>0 then
    begin
      SetLength(Result, Length(Result) + 1);
      Result[Length(Result) - 1]:=Copy(S, LastFound+1, I-LastFound-1);
      LastFound:=I;
    end;
  end;
  if LastFound<>Length(S) then
  begin
    SetLength(Result, Length(Result) + 1);
    Result[Length(Result) - 1]:=Copy(S, LastFound+1, MaxInt);
  end;
end;
{$endif}

{$ifndef Delphi11orNewerCompiler}
function GetCPUCount: Integer;
{$IFDEF MSWINDOWS}
var
  SysInfo: TSystemInfo;
begin
  ZeroMemory(@SysInfo, SizeOf(SysInfo));
  if DelayFunc_GetNativeSystemInfo then
    GetNativeSystemInfo(SysInfo)
  else
    GetSystemInfo(SysInfo);
  Result := SysInfo.dwNumberOfProcessors;
end;
{$ENDIF}
{$IFDEF POSIX}
begin
  Result := sysconf(_SC_NPROCESSORS_ONLN);
end;
{$ENDIF}
{$endif}

//From: http://delphi.about.com/od/adptips2004/a/bltip0904_2.htm
function LastPos(const SubStr: String; const S: String): Integer;
begin
  Result := Pos(ReverseString(SubStr), ReverseString(S)) ;
  if (Result <> 0) then
    Result := ((Length(S) - Length(SubStr)) + 1) - Result + 1;
end;

function CharInSet(C: AnsiChar; const CharSet: TSysCharSet): Boolean;
begin
  Result := C in CharSet;
end;

{$ifndef Delphi2orNewerCompiler}
function CharInSet(C: WideChar; const CharSet: TSysCharSet): Boolean;
begin
  Result := AnsiChar(C) in CharSet; //FIXME: At some point beyond Delphi 7, the cast to AnsiChar is not longer needed.
end;
{$endif}

{$IFDEF UNICODE}
(*function CharInSet(C: UnicodeChar; const CharSet: TSysCharSet): Boolean;
begin
  Result := UnicodeChar(C) in CharSet; //FIXME: At some point beyond Delphi 7, the cast to AnsiChar is not longer needed.
end;*)
{$ENDIF}

{$ifdef MSWINDOWS}
function CheckWin32VersionWithServicePack(AMajor, AMinor, AServicePackMajor, AServicePackMinor: Integer): Boolean;
var
  OS: TOSVersionInfoEx;
  Win32ServicePackMajor, Win32ServicePackMinor: Integer;
begin
  if not CheckWin32Version(5, 0) then //Windows 2000
  begin
    Win32ServicePackMajor:=0;
    Win32ServicePackMinor:=0;
  end
  else
  begin
    ZeroMemory(@OS,SizeOf(OS));
    OS.dwOSVersionInfoSize:=SizeOf(TOSVersionInfoEx);
    if not GetVersionEx(POSVersionInfo(@OS)^) then
      raise exception.create('Unable to retrieve system details. Call to GetVersionEx failed!');
    Win32ServicePackMajor:=OS.wServicePackMajor;
    Win32ServicePackMinor:=OS.wServicePackMinor;
  end;
  Result := (Win32MajorVersion > AMajor) or
            ((Win32MajorVersion = AMajor) and (Win32MinorVersion >= AMinor)) or
            ((Win32MajorVersion = AMajor) and (Win32MinorVersion = AMinor) and (Win32ServicePackMajor >= AServicePackMajor)) or
            ((Win32MajorVersion = AMajor) and (Win32MinorVersion = AMinor) and (Win32ServicePackMajor = AServicePackMajor) and (Win32ServicePackMinor >= AServicePackMinor));
end;

function CheckWin32VersionWithBuildNumber(AMajor: Integer; AMinor: Integer = 0; ABuildNumber: Integer = 0): Boolean;
var
  OS: TOSVersionInfo;
  Win32BuildNumber: Integer;
begin
  ZeroMemory(@OS,SizeOf(OS));
  OS.dwOSVersionInfoSize:=SizeOf(TOSVersionInfo);
  if not GetVersionEx(OS) then
    raise exception.create('Unable to retrieve system details. Call to GetVersionEx failed!');
  Win32BuildNumber:=OS.dwBuildNumber;
  Result := (Win32MajorVersion > AMajor) or
            ((Win32MajorVersion = AMajor) and (Win32MinorVersion >= AMinor)) or
            ((Win32MajorVersion = AMajor) and (Win32MinorVersion = AMinor) and (Win32BuildNumber >= ABuildNumber));
end;
{$endif}

{$ifndef Delphi2orNewerCompiler}
function WideLowerCaseFileName(const S: WideString): WideString;
var
  I,L: Integer;
begin
  if SysLocale.FarEast then
  begin
    L := Length(S);
    SetLength(Result, L);
    I := 1;
    while I <= L do
    begin
      Result[I] := S[I];
      if S[I] in LeadBytes then
      begin
        Inc(I);
        Result[I] := S[I];
      end
      else
        if Result[I] in ['A'..'Z'] then Inc(Byte(Result[I]), 32);
      Inc(I);
    end;
  end
  else
    Result := WideLowerCase(S);
end;

function WideCompareFileName(const S1, S2: WideString): Integer;
begin
  Result := WideCompareStr(WideLowerCaseFileName(S1), WideLowerCaseFileName(S2));
end;
{$endif}

{$IFDEF UNICODE}
function UnicodeLowerCaseFileName(const S: UnicodeString): UnicodeString;
begin
  Result := AnsiLowerCase(S); //Yes, this function is misnamed in Delphi.
end;

function UnicodeCompareFileName(const S1, S2: UnicodeString): Integer;
begin
  Result := CompareStr(UnicodeLowerCaseFileName(S1), UnicodeLowerCaseFileName(S2)); //UnicodeCompareStr doesn't exist, but CompareStr is documented to handle Unicode.
end;
{$ENDIF}

function CompareFileName(const S1, S2: string): Integer;
begin
  {$IFDEF UNICODE}
  Result:=UnicodeCompareFileName(S1, S2);
  {$ELSE}
  Result:=AnsiCompareFileName(S1, S2);
  {$ENDIF}
end;

procedure CleanupFileName(var S: String);
const
{$ifdef MSWINDOWS}
  //Semi-colon and comma are invalid if long filenames are not supported.
  cInvalidChars = ['\', '/', ':', '*', '?', '"', '<', '>', '|'{, ';', ','}];
{$else}
  cInvalidChars = ['/'];
{$endif}
var
 I: Integer;
begin
 for I:=Length(S) downto 1 do
 begin
   {$ifdef MSWINDOWS}
   if (S[I] < #20) //Control characters are invalid
   {$else}
   if (S[I] = #0) //Null bytes are invalid
   {$endif}
   or CharInSet(S[I], cInvalidChars) then
     System.Delete(S, I, 1);
 end;
end;

initialization
{$ifdef MSWINDOWS}
{$ifndef Delphi2010orNewerCompiler} //NOT Use delayed loading
  //Initialize the delayed loading functions now, because this version of Delphi
  //doesn't support delayed loading.
  //Note: The module 'kernel32' is always loaded inside a process.
{$ifndef Delphi2007orNewerCompiler}
  DWMAPILib:=SafeLoadLibrary('DWMAPI.DLL');
  if DWMAPILib = 0 then
  begin
    DwmEnableComposition := nil;
    //DwmIsCompositionEnabled := nil;
  end
  else
  begin
    DwmEnableComposition := GetProcAddress(DWMAPILib, 'DwmEnableComposition');
    //DwmIsCompositionEnabled := GetProcAddress(DWMAPILib, 'DwmIsCompositionEnabled');
  end;

  DelayFunc_DwmEnableComposition := Assigned(DwmEnableComposition);
  //DelayFunc_DwmIsCompositionEnabled := Assigned(DwmIsCompositionEnabled);
  {$DEFINE DelayFunc_Delphi2007Done}
{$endif}
{$ifndef Delphi11orNewerCompiler}
  GlobalMemoryStatusEx := GetProcAddress(GetModuleHandle('kernel32'), 'GlobalMemoryStatusEx');
  GetNativeSystemInfo := GetProcAddress(GetModuleHandle('kernel32'), 'GetNativeSystemInfo');
  GetErrorMode := GetProcAddress(GetModuleHandle('kernel32'), 'GetErrorMode');
  SetDllDirectoryA := GetProcAddress(GetModuleHandle('kernel32'), 'SetDllDirectoryA');
  SetDllDirectoryW := GetProcAddress(GetModuleHandle('kernel32'), 'SetDllDirectoryW');
  {$IFDEF UNICODE}SetDllDirectory:=SetDllDirectoryW;{$ELSE}SetDllDirectory:=SetDllDirectoryA;{$ENDIF};
  IsWow64Process := GetProcAddress(GetModuleHandle('kernel32'), 'IsWow64Process');
  IsWow64Process2 := GetProcAddress(GetModuleHandle('kernel32'), 'IsWow64Process2');
  GetTickCount64 := GetProcAddress(GetModuleHandle('kernel32'), 'GetTickCount64');

  DelayFunc_GlobalMemoryStatusEx := Assigned(GlobalMemoryStatusEx);
  DelayFunc_GetNativeSystemInfo := Assigned(GetNativeSystemInfo);
  DelayFunc_GetErrorMode := Assigned(GetErrorMode);
  DelayFunc_SetDllDirectoryA := Assigned(SetDllDirectoryA);
  DelayFunc_SetDllDirectoryW := Assigned(SetDllDirectoryW);
  DelayFunc_SetDllDirectory := Assigned(SetDllDirectory);
  DelayFunc_IsWow64Process := Assigned(IsWow64Process);
  DelayFunc_IsWow64Process2 := Assigned(IsWow64Process2);
  DelayFunc_GetTickCount64 := Assigned(GetTickCount64);
  {$DEFINE DelayFunc_Delphi11Done}
{$endif}
{.$ifndef DelphiXXorNewerCompiler}
  GetFirmwareType := GetProcAddress(GetModuleHandle('kernel32'), 'GetFirmwareType');

  ShellLib:=SafeLoadLibrary('shell32.dll');
  if ShellLib = 0 then
    SHRestricted := nil
  else
    SHRestricted := GetProcAddress(ShellLib, 'SHRestricted');

  DelayFunc_GetFirmwareType := Assigned(GetFirmwareType);
  DelayFunc_SHRestricted := Assigned(SHRestricted);
  {$DEFINE DelayFunc_DelphiXXDone}
{.$endif}
{$endif}

  //Delphi's delayed loading raises an exception if the function cannot be loaded.
  //To avoid that, don't try to call the function if it's not present.
  {$ifndef DelayFunc_Delphi2007Done}
  DelayFunc_DwmEnableComposition := CheckWin32Version(6, 0); //Windows Vista
  //DelayFunc_DwmIsCompositionEnabled := CheckWin32Version(6, 0); //Windows Vista
  {$endif}
  {$ifndef DelayFunc_Delphi11Done}
  DelayFunc_GlobalMemoryStatusEx := CheckWin32Version(5, 0); //Windows 2000
  DelayFunc_GetNativeSystemInfo := CheckWin32Version(5, 1); //Windows XP, Windows Server 2003
  DelayFunc_GetErrorMode := CheckWin32Version(6, 0); //Windows Vista
  DelayFunc_SetDllDirectoryA := CheckWin32VersionWithServicePack(5, 1, 1); //Windows XP SP1, Windows Server 2003
  DelayFunc_SetDllDirectoryW := CheckWin32VersionWithServicePack(5, 1, 1); //Windows XP SP1, Windows Server 2003
  DelayFunc_SetDllDirectory := CheckWin32VersionWithServicePack(5, 1, 1); //Windows XP SP1, Windows Server 2003
  DelayFunc_IsWow64Process := CheckWin32VersionWithServicePack(5, 1, 2); //Windows XP with SP2, Windows Server 2003 with SP1
  DelayFunc_IsWow64Process2 := CheckWin32VersionWithBuildNumber(10, 0, 16299); //Windows 10, version 1709
  DelayFunc_GetTickCount64 := CheckWin32Version(6, 0); //Windows Vista, Windows Server 2008
  {$endif}
  {$ifndef DelayFunc_DelphiXXDone}
  DelayFunc_GetFirmwareType := CheckWin32Version(6, 2); //Windows 8, Server 2012
  DelayFunc_SHRestricted := CheckWin32VersionWithServicePack(5, 1, 1); //Windows XP SP1, Windows Server 2003, although it already existed in Windows 2000 as ordinal 100.
  {$endif}
{$endif}

  //Initialize other things too.
{$ifndef Delphi11orNewerCompiler}
  CPUCount:=GetCPUCount;
{$endif}

{$ifdef MSWINDOWS}
{$ifndef Delphi2010orNewerCompiler} //NOT Use delayed loading
finalization
  if ShellLib<> 0 then
  begin
    FreeLibrary(ShellLib);
    //ShellLib:=0;
  end;
  if DWMAPILib<> 0 then
  begin
    FreeLibrary(DWMAPILib);
    //DWMAPILib:=0;
  end;
{$endif}
{$endif}
end.
