; QuArK dependencies installer script for NSIS
; HomePage: https://quark.sourceforge.io/
; Author: DanielPharos

; Modern UI 2 ------
!include MUI2.nsh
!include LangFile.nsh
!include LogicLib.nsh
!include Sections.nsh
!include WinVer.nsh

!define SPLASHDIR "C:\QuArK_installer_splash_image"
!define DEPENDENCYDIR "C:\QuArK_installer_dependencies"
!define INSTALLER_EXENAME "quark-dependencies.exe"
!define PRODUCT_NAME "QuArK dependencies"
!define PRODUCT_NAME_FULL "Quake Army Knife dependencies"
!define PRODUCT_COPYRIGHT "Copyright (c) 2024"
!define PRODUCT_VERSION_NUMBER "1.0.0.2"
!define PRODUCT_VERSION_STRING "1.0.0.2"
!define PRODUCT_WEB_SITE "https://quark.sourceforge.io/"
!define PRODUCT_PUBLISHER "QuArK Development Team"

; Configure installer
CRCCheck off ;To massively speed up starting the installer on older systems
ManifestDPIAware true
;ManifestLongPathAware true ;Not compatible with CreateShortCut
ManifestSupportedOS all
RequestExecutionLevel admin
SetCompress off ;To massively speed up starting the installer on older systems
ShowInstDetails show
Unicode false
;XPStyle true

Name "${PRODUCT_NAME}"
OutFile "${INSTALLER_EXENAME}"

; MUI Settings
!define MUI_ICON "${NSISDIR}\Contrib\Graphics\Icons\modern-install-blue.ico"
; Loads the splash window
!define MUI_WELCOMEFINISHPAGE_BITMAP "${SPLASHDIR}\install_splash.bmp"
; Loads the header picture
!define MUI_HEADERIMAGE
!define MUI_HEADERIMAGE_BITMAP "${SPLASHDIR}\install_header.bmp"

; Language Selection Dialog Settings
!define MUI_LANGDLL_ALWAYSSHOW

; Welcome page
!insertmacro MUI_PAGE_WELCOME
; Component page
!define MUI_COMPONENTSPAGE_SMALLDESC
!insertmacro MUI_PAGE_COMPONENTS
; Instfiles page
!insertmacro MUI_PAGE_INSTFILES
; Finish page
!define MUI_FINISHPAGE_LINK "QuArK website"
!define MUI_FINISHPAGE_LINK_LOCATION "${PRODUCT_WEB_SITE}"
!insertmacro MUI_PAGE_FINISH

; Language files
;!define MUI_LANGDLL_ALLLANGUAGES
!insertmacro MUI_LANGUAGE "English"
!insertmacro LANGFILE_INCLUDE "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Albanian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Albanian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Arabic"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Arabic.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Basque"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Basque.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Belarusian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Belarusian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Bosnian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Bosnian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Breton"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Breton.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Bulgarian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Bulgarian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "SimpChinese"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\SimpChinese.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "TradChinese"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\TradChinese.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Corsican"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Corsican.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Croatian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Croatian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Czech"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Czech.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Danish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Danish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Dutch"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Dutch.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Estonian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Estonian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Finnish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Finnish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "French"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\French.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "German"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\German.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Greek"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Greek.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Icelandic"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Icelandic.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Irish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Irish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Italian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Italian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Japanese"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Japanese.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Korean"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Korean.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Latvian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Latvian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Lithuanian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Lithuanian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Luxembourgish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Luxembourgish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Macedonian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Macedonian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Norwegian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Norwegian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Polish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Polish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Portuguese"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Portuguese.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Romanian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Romanian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Russian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Russian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Serbian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Serbian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Slovak"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Slovak.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Slovenian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Slovenian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Spanish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Spanish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Swedish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Swedish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Turkish"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Turkish.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Ukrainian"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Ukrainian.nsh" "LangFiles\English.nsh"

!insertmacro MUI_LANGUAGE "Welsh"
!insertmacro LANGFILE_INCLUDE_WITHDEFAULT "LangFiles\Welsh.nsh" "LangFiles\English.nsh"

; Installer executable settings
VIProductVersion "${PRODUCT_VERSION_NUMBER}"

VIAddVersionKey /LANG=${LANG_ENGLISH} "ProductName" "Quake Army Knife dependencies installer"
;VIAddVersionKey /LANG=${LANG_ENGLISH} "CompanyName" "QuArK Development Team"
VIAddVersionKey /LANG=${LANG_ENGLISH} "LegalCopyright" "${PRODUCT_COPYRIGHT}"
VIAddVersionKey /LANG=${LANG_ENGLISH} "FileDescription" "Installer for QuArK dependencies"
VIAddVersionKey /LANG=${LANG_ENGLISH} "FileVersion" "${PRODUCT_VERSION_NUMBER}"
VIAddVersionKey /LANG=${LANG_ENGLISH} "ProductVersion" "${PRODUCT_VERSION_STRING}"

VIAddVersionKey /LANG=${LANG_DUTCH} "ProductName" "Quake Army Knife afhankelijkheden installatiebestand"
;VIAddVersionKey /LANG=${LANG_DUTCH} "CompanyName" "QuArK Development Team"
VIAddVersionKey /LANG=${LANG_DUTCH} "LegalCopyright" "${PRODUCT_COPYRIGHT}"
VIAddVersionKey /LANG=${LANG_DUTCH} "FileDescription" "Installatiebestand voor QuArK afhankelijkheden"
VIAddVersionKey /LANG=${LANG_DUTCH} "FileVersion" "${PRODUCT_VERSION_NUMBER}"
VIAddVersionKey /LANG=${LANG_DUTCH} "ProductVersion" "${PRODUCT_VERSION_STRING}"
; MUI end ------

; Windows NT SP3 installer ------

Function _isInstalledWinNT4SP3
  ${IfNot} ${IsWinNT4}
  ${OrIf} ${AtLeastServicePack} 3
    Push 1
    Return
  ${EndIf}
  Push 0
FunctionEnd

Section /o "$(TEXT_SecWinNT4SP3_TITLE)" SecWinNT4SP3
  SetOutPath $TEMP
  File "${DEPENDENCYDIR}\WinNT4\winnt40sp3.exe"
  ExecWait "$TEMP\winnt40sp3.exe"
  Delete "$TEMP\winnt40sp3.exe"
SectionEnd



; Windows NT SP6 installer ------

Function _isInstalledWinNT4SP6
  ${IfNot} ${IsWinNT4}
  ${OrIf} ${AtLeastServicePack} 6
    Push 1
    Return
  ${EndIf}
  Push 0
FunctionEnd

Section /o "$(TEXT_SecWinNT4SP6_TITLE)" SecWinNT4SP6
  SetOutPath $TEMP
  File "${DEPENDENCYDIR}\WinNT4\sp6ai386.exe"
  ExecWait "$TEMP\sp6ai386.exe"
  Delete "$TEMP\sp6ai386.exe"
SectionEnd



; Windows Installer 2 ------

; https://docs.microsoft.com/en-us/windows/win32/msi/released-versions-of-windows-installer
; https://learn.microsoft.com/en-us/windows/win32/msi/instmsi-exe

; Windows Installer 2.0 needs SP6 on Windows NT4.

Function _isInstalledWinInstaller2
  ; Inspired by: https://learn.microsoft.com/en-us/windows/win32/msi/determining-the-windows-installer-version

  ClearErrors
  GetDllVersion "$SYSDIR\msi.dll" $R0 $R1
  IfErrors NotInstalled
  IntOp $R2 $R0 >> 16
  IntOp $R2 $R2 & 0x0000FFFF ; $R2 now contains major version
  ;IntOp $R3 $R0 & 0x0000FFFF ; $R3 now contains minor version
  ;IntOp $R4 $R1 >> 16
  ;IntOp $R4 $R4 & 0x0000FFFF ; $R4 now contains release
  ;IntOp $R5 $R1 & 0x0000FFFF ; $R5 now contains build
  IntCmp $R2 2 0 NeedsUpdate 0 ;Check major version
  Push 1
  Return
NotInstalled:
NeedsUpdate:
  Push 0
FunctionEnd

Section /o "$(TEXT_SecWinInstaller2_TITLE)" SecWinInstaller2
  ${If} ${IsWin95}
  ${OrIf} ${IsWin98}
  ${OrIf} ${IsWinME}
    SetOutPath $TEMP
    File "${DEPENDENCYDIR}\WindowsInstaller\2.0.2600.2\InstMsiA.exe"
    ExecWait "$TEMP\InstMsiA.exe /q"
    Delete "$TEMP\InstMsiA.exe"
    ; FIXME: Check return code: ERROR_SUCCESS_REBOOT_REQUIRED (or ERROR_SUCCESS)
    ; Reboot
  ${EndIf}
  ${If} ${IsWinNT4}
  ${OrIf} ${IsWin2000}
    SetOutPath $TEMP
    File "${DEPENDENCYDIR}\WindowsInstaller\2.0.2600.2\InstMsiW.exe"
    ExecWait "$TEMP\InstMsiA.exe /q"
    Delete "$TEMP\InstMsiA.exe"
    ; FIXME: Check return code: ERROR_SUCCESS_REBOOT_REQUIRED (or ERROR_SUCCESS)
    ; Reboot
  ${EndIf}
SectionEnd



;; Windows Installer 3.1 ------
;
;; https://docs.microsoft.com/en-us/windows/win32/msi/released-versions-of-windows-installer
;
;; Windows Installer 3.1 needs SP3 on Windows 2000.
;
;Function _isInstalledWinInstaller31
;  ; Inspired by: https://learn.microsoft.com/en-us/windows/win32/msi/determining-the-windows-installer-version
;
;  ClearErrors
;  GetDllVersion "$SYSDIR\msi.dll" $R0 $R1
;  IfErrors NotInstalled
;  IntOp $R2 $R0 >> 16
;  IntOp $R2 $R2 & 0x0000FFFF ; $R2 now contains major version
;  IntOp $R3 $R0 & 0x0000FFFF ; $R3 now contains minor version
;  ;IntOp $R4 $R1 >> 16
;  ;IntOp $R4 $R4 & 0x0000FFFF ; $R4 now contains release
;  ;IntOp $R5 $R1 & 0x0000FFFF ; $R5 now contains build
;  IntCmp $R2 3 0 NeedsUpdate +1 ;Check major version
;  IntCmp $R3 1 0 NeedsUpdate 0 ;Check minor version
;  Push 1
;  Return
;NotInstalled:
;NeedsUpdate:
;  Push 0
;FunctionEnd
;
;Section /o "$(TEXT_SecWinInstaller31_TITLE)" SecWinInstaller31
;  SetOutPath $TEMP
;  File "${DEPENDENCYDIR}\WindowsInstaller\3.1.4000.2435\WindowsInstaller-KB893803-v2-x86.exe"
;  ExecWait "$TEMP\WindowsInstaller-KB893803-v2-x86.exe /quiet /norestart"
;  Delete "$TEMP\WindowsInstaller-KB893803-v2-x86.exe"
;  ; FIXME: May require a REBOOT...!
;SectionEnd



; Internet Explorer 4 installer ------

;Official documentation says:
;- For Microsoft Windows NT:
;  You must be running Service Pack 3 (or higher)

Function _isInstalledIE4SP2
  ${IfNot} ${IsWin95}
  ${AndIfNot} ${IsWinNT4}
    Push 1
    Return
  ${EndIf}

  ;Windows 95C (version 4.03.1216) and higher already include IE4
  ;Note: WinVer.nsh's service pack code doesn't work for Windows 95 OSR's
  ${WinVerGetMinor} $0
  ${If} ${IsWin95}
  ${AndIf} $0 > 2
    Push 1
    Return
  ${EndIf}

  ClearErrors
  ReadRegStr $0 HKLM "SOFTWARE\Microsoft\Internet Explorer" "Version"
  IfErrors 0 AlreadyInstalled
  Push 0
  Return
AlreadyInstalled:
  StrCmp $0 "4.72.3612.1713" RightVersion
  Push 0
  Return
RightVersion:
  Push 1
FunctionEnd

Section /o "$(TEXT_SecIE4SP2_TITLE)" SecIE4SP2
  SetOutPath $TEMP
  File "${DEPENDENCYDIR}\Microsoft Internet Explorer 4.01 SP2\*.*"
  ExecWait "$TEMP\IE4SETUP.EXE /Q /T:$\"$TEMP\IE4Setup$\""
  Delete "$TEMP\*.*"
  RMDir /r $TEMP\IE4Setup
  ; FIXME: May require a REBOOT...!
SectionEnd



; Visual C++ redistributable installers ------

; See: https://docs.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist

; The VC++ Runtime SP1 2005 installer lowered the requirements to Windows Installer 2.0.
; Note that (at least) the VC2010 installer needs Internet Explorer 3.02 to be installed.

!define VC2005
;!define VC2008
!define VC2010
;!define VC2013
!include "VisualCRuntimeGUIDs.nsh"

Section /o "$(TEXT_SecVC2005Redist_TITLE)" SecVC2005Redist
  SetOutPath $TEMP
  File "${DEPENDENCYDIR}\VC2005SP1MFC\vcredist_x86.EXE"
  ExecWait "$TEMP\vcredist_x86.EXE /q:a /c:$\"msiexec /i vcredist.msi /qn REBOOT=ReallySuppress$\""
  Delete "$TEMP\vcredist_x86.EXE"
SectionEnd

;Section /o "$(TEXT_SecVC2008Redist_TITLE)" SecVC2008Redist
;  SetOutPath $TEMP
;  File "${DEPENDENCYDIR}\VC2008SP1MFC\vcredist_x86.exe"
;  StrCpy $0 0
;  IfFileExists $SYSDIR\msvcrt.dll +2 0
;  File "${DEPENDENCYDIR}\MSVCRT\6.0.8797.0\msvcrt.dll"
;  StrCpy $0 1
;  ExecWait "$TEMP\vcredist_x86.exe /q"
;  Delete "$TEMP\vcredist_x86.exe"
;  ${If} $0 != 0
;    Delete "$TEMP\msvcrt.dll"
;  ${EndIf}
;SectionEnd

Section /o "$(TEXT_SecVC2010Redist_TITLE)" SecVC2010Redist
  SetOutPath $TEMP
  File "${DEPENDENCYDIR}\VC2010SP1MFC\vcredist_x86.exe"
  StrCpy $0 0
  IfFileExists $SYSDIR\msvcrt.dll +2 0
  File "${DEPENDENCYDIR}\MSVCRT\6.0.8797.0\msvcrt.dll"
  StrCpy $0 1
  ExecWait "$TEMP\vcredist_x86.exe /q /norestart"
  Delete "$TEMP\vcredist_x86.exe"
  ${If} $0 != 0
    Delete "$TEMP\msvcrt.dll"
  ${EndIf}
SectionEnd

;Section /o "$(TEXT_SecVC2013Redist_TITLE)" SecVC2013Redist
;  SetOutPath $TEMP
;  File "${DEPENDENCYDIR}\VC2013_12.0.40664.0\vcredist_x86.exe"
;  ExecWait "$TEMP\vcredist_x86.exe /install /quiet /norestart"
;  Delete "$TEMP\vcredist_x86.exe"
;SectionEnd



; DirectX installer ------

; https://aka.ms/dxsetup

; Based on: https://nsis.sourceforge.io/Detect_DirectX_Version
; Registry key only works for DirectX <= 9

Function _isInstalledDirectX9
  ;Pretend Windows 95 and NT 4 already have DirectX 9, so we don't try to install it.
  ${If} ${IsWin95}
  ${OrIf} ${IsWinNT4}
    Push 1
    Return
  ${EndIf}

  ;Windows 8 was released after DirectX 9's latest version.
  ${If} ${AtLeastWin8}
    Push 1
    Return
  ${EndIf}

  ClearErrors
  ReadRegStr $0 HKLM "SOFTWARE\Microsoft\DirectX" "Version"
  IfErrors 0 AlreadyInstalled
  Push 0
  Return
AlreadyInstalled:
  StrCmp $0 "4.09.00.0904" RightVersion
  Push 0
  Return
RightVersion:
  Push 1
FunctionEnd

Section /o "$(TEXT_SecDirectX9_TITLE)" SecDirectX9
  ;Note: Not supported on Windows 95 or NT 4.
  ${If} ${IsWin98}
  ${OrIf} ${IsWinME}
    SetOutPath $TEMP
    File "${DEPENDENCYDIR}\DirectX\directx-9-0c-oct-06-directx_oct2006_redist.exe"
    ExecWait "$TEMP\directx-9-0c-oct-06-directx_oct2006_redist.exe /Q /T:$\"$TEMP\DirectX$\""
    Delete "$TEMP\directx-9-0c-oct-06-directx_oct2006_redist.exe"
    ExecWait "$TEMP\DirectX\DXSETUP.exe /silent"
    RMDir /r $TEMP\DirectX
    Goto AlreadyInstalled
  ${Else}
    ${If} ${IsWin2000}
      SetOutPath $TEMP
      File "${DEPENDENCYDIR}\DirectX\directx_feb2010_redist.exe"
      ExecWait "$TEMP\directx_feb2010_redist.exe /Q /T:$\"$TEMP\DirectX$\""
      Delete "$TEMP\directx_feb2010_redist.exe"
      ExecWait "$TEMP\DirectX\DXSETUP.exe /silent"
      RMDir /r $TEMP\DirectX
      Goto AlreadyInstalled
    ${Else}
      ${If} ${IsWinXP}
      ${OrIf} ${IsWin2003}
        SetOutPath $TEMP
        File "${DEPENDENCYDIR}\DirectX\directx_Jun2010_redist.exe"
        ExecWait "$TEMP\directx_Jun2010_redist.exe /Q /T:$\"$TEMP\DirectX$\""
        Delete "$TEMP\directx_Jun2010_redist.exe"
        ExecWait "$TEMP\DirectX\DXSETUP.exe /silent"
        RMDir /r $TEMP\DirectX
        Goto AlreadyInstalled
      ${EndIf}
    ${EndIf}
  ${EndIf}

AlreadyInstalled:
SectionEnd



; OpenGL installer ------

; KB154877
; ftp://ftp.microsoft.com/Softlib/MSLFILES/Opengl95.exe

Function _isInstalledOpenGL
  ;Needed for OpenGL on Windows 95 before OSR2.
  ${IfNot} ${IsWin95}
    Push 1
    Return
  ${EndIf}
  ${WinVerGetMinor} $0
  ${If} $0 > 1
    Push 1
    Return
  ${EndIf}

  ClearErrors
  GetDllVersion "$SYSDIR\Opengl32.dll" $R0 $R1
  IfErrors NotInstalled
  IntOp $R1 $R0 / 0x00010000
  IntCmp $R1 4 0 NeedsUpdate 0
  Push 1
  Return
NotInstalled:
NeedsUpdate:
  Push 0
FunctionEnd

Section /o "$(TEXT_SecOpenGL_TITLE)" SecOpenGL
  SetOutPath $TEMP
  File "${DEPENDENCYDIR}\OpenGL\Opengl95.exe"
  ExecWait "$TEMP\Opengl95.exe $SYSDIR *.dll"
  Delete "$TEMP\Opengl95.exe"
SectionEnd



; --------------------

!insertmacro MUI_FUNCTION_DESCRIPTION_BEGIN
  !insertmacro MUI_DESCRIPTION_TEXT ${SecWinNT4SP3} "$(TEXT_SecWinNT4SP3_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecWinNT4SP6} "$(TEXT_SecWinNT4SP6_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecWinInstaller2} "$(TEXT_SecWinInstaller2_DESC)"
  ;!insertmacro MUI_DESCRIPTION_TEXT ${SecWinInstaller31} "$(TEXT_SecWinInstaller31_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecIE4SP2} "$(TEXT_SecIE4SP2_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecVC2005Redist} "$(TEXT_SecVC2005Redist_DESC)"
  ;!insertmacro MUI_DESCRIPTION_TEXT ${SecVC2008Redist} "$(TEXT_SecVC2008Redist_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecVC2010Redist} "$(TEXT_SecVC2010Redist_DESC)"
  ;!insertmacro MUI_DESCRIPTION_TEXT ${SecVC2013Redist} "$(TEXT_SecVC2013Redist_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecDirectX9} "$(TEXT_SecDirectX9_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SecOpenGL} "$(TEXT_SecOpenGL_DESC)"
!insertmacro MUI_FUNCTION_DESCRIPTION_END

Function .onInit
  !insertmacro MUI_LANGDLL_DISPLAY

  Call _isInstalledIE4SP2
  Pop $0
  ${If} $0 == 0
    SectionGetFlags ${SecIE4SP2} $0
    IntOp $0 $0 | ${SF_SELECTED}
    SectionSetFlags ${SecIE4SP2} $0

    Call _isInstalledWinNT4SP3
    Pop $0
    ${If} $0 == 0
      SectionGetFlags ${SecWinNT4SP3} $0
      IntOp $0 $0 | ${SF_SELECTED}
      SectionSetFlags ${SecWinNT4SP3} $0
    ${EndIf}
  ${EndIf}

  Call _isInstalledVC2005
  Pop $0
  ${If} $0 == 0
    SectionGetFlags ${SecVC2005Redist} $0
    IntOp $0 $0 | ${SF_SELECTED}
    SectionSetFlags ${SecVC2005Redist} $0

    ;FIXME: https://support.microsoft.com/en-gb/topic/description-of-the-security-update-for-microsoft-visual-c-2005-service-pack-1-redistributable-package-july-28-2009-42f08236-49f4-b7bd-e414-416bb0d7438b
    ;FIXME: Thus maybe needs Windows Installer 3.1?!?
    Call _isInstalledWinInstaller2
    Pop $0
    ${If} $0 == 0
      SectionGetFlags ${SecWinInstaller2} $0
      IntOp $0 $0 | ${SF_SELECTED}
      SectionSetFlags ${SecWinInstaller2} $0

      Call _isInstalledWinNT4SP6
      Pop $0
      ${If} $0 == 0
        SectionGetFlags ${SecWinNT4SP6} $0
        IntOp $0 $0 | ${SF_SELECTED}
        SectionSetFlags ${SecWinNT4SP6} $0
      ${EndIf}
    ${EndIf}
  ${EndIf}

;  Call _isInstalledVC2008
;  Pop $0
;  ${If} $0 == 0
;    SectionGetFlags ${SecVC2008Redist} $0
;    IntOp $0 $0 | ${SF_SELECTED}
;    SectionSetFlags ${SecVC2008Redist} $0
;
;    ;FIXME: This executable calls "InitializeCriticalSectionAndSpinCount", which requires Windows XP SP2 or Windows Server 2003 SP1 or later.
;    Call _isInstalledWinInstaller2
;    Pop $0
;    ${If} $0 == 0
;      SectionGetFlags ${SecWinInstaller2} $0
;      IntOp $0 $0 | ${SF_SELECTED}
;      SectionSetFlags ${SecWinInstaller2} $0
;
;      Call _isInstalledWinNT4SP6
;      Pop $0
;      ${If} $0 == 0
;        SectionGetFlags ${SecWinNT4SP6} $0
;        IntOp $0 $0 | ${SF_SELECTED}
;        SectionSetFlags ${SecWinNT4SP6} $0
;      ${EndIf}
;    ${EndIf}
;  {$EndIf}

  Call _isInstalledVC2010
  Pop $0
  ${If} $0 == 0
    SectionGetFlags ${SecVC2010Redist} $0
    IntOp $0 $0 | ${SF_SELECTED}
    SectionSetFlags ${SecVC2010Redist} $0

    ;FIXME: This executable calls "InitializeCriticalSectionAndSpinCount", which requires Windows XP SP2 or Windows Server 2003 SP1 or later.
    Call _isInstalledWinInstaller2
    Pop $0
    ${If} $0 == 0
      SectionGetFlags ${SecWinInstaller2} $0
      IntOp $0 $0 | ${SF_SELECTED}
      SectionSetFlags ${SecWinInstaller2} $0
    ${EndIf}
  ${EndIf}

;  Call _isInstalledVC2013
;  Pop $0
;  ${If} $0 == 0
;    SectionGetFlags ${SecVC2013Redist} $0
;    IntOp $0 $0 | ${SF_SELECTED}
;    SectionSetFlags ${SecVC2013Redist} $0
;
;    Call _isInstalledWinInstaller2
;    Pop $0
;    ${If} $0 == 0
;      SectionGetFlags ${SecWinInstaller2} $0
;      IntOp $0 $0 | ${SF_SELECTED}
;      SectionSetFlags ${SecWinInstaller2} $0
;    ${EndIf}
;  ${EndIf}

  Call _isInstalledDirectX9
  Pop $0
  ${If} $0 == 0
    SectionGetFlags ${SecDirectX9} $0
    IntOp $0 $0 | ${SF_SELECTED}
    SectionSetFlags ${SecDirectX9} $0
  ${EndIf}

  Call _isInstalledOpenGL
  Pop $0
  ${If} $0 == 0
    SectionGetFlags ${SecOpenGL} $0
    IntOp $0 $0 | ${SF_SELECTED}
    SectionSetFlags ${SecOpenGL} $0
  ${EndIf}
FunctionEnd

Function .onSelChange
  ;If Windows NT4 SP6 is selected, deselect Windows NT4 SP3
  SectionGetFlags ${SecWinNT4SP6} $0
  IntOp $0 $0 & ${SF_SELECTED}
  IntCmp $0 0 done
  SectionGetFlags ${SecWinNT4SP3} $0
  IntOp $0 $0 & ${SECTION_OFF}
  SectionSetFlags ${SecWinNT4SP3} $0
done:
FunctionEnd
