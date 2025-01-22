; QuArK installer script for NSIS
; HomePage: https://quark.sourceforge.io/
; Author: Fredrick Vamstad, DanielPharos & cdunde
; Date: 18 August 2005 & 5 January 2007 & 29 March 2024
; nullsoft NSIS installer program available at:
;   https://nsis.sourceforge.io/

; Modern UI 2 ------
!include MUI2.nsh
!include LangFile.nsh
!include LogicLib.nsh
;!include MultiUser.nsh ;FIXME: Implement!
  ;https://nsis.sourceforge.io/Docs/MultiUser/Readme.html
  ;https://nsis.sourceforge.io/Add_uninstall_information_to_Add/Remove_Programs#With_a_MultiUser_Installer

!define BUILDDIR "C:\QuArK_installer_files"
!define SPLASHDIR "C:\QuArK_installer_splash_image"
!define INSTALLER_EXENAME "quark-win32-6.6.0Beta8.exe"
!define PRODUCT_NAME "QuArK"
!define PRODUCT_NAME_FULL "Quake Army Knife"
!define PRODUCT_COPYRIGHT "Copyright (c) 2025"
!define PRODUCT_VERSION "6.6.0 Beta 8"
!define PRODUCT_VERSION_NUMBER "6.6.8.0"
!define PRODUCT_VERSION_STRING "6.6 (Beta-Release)"
!define PRODUCT_WEB_SITE "https://quark.sourceforge.io/"
!define PRODUCT_WEB_FORUM "https://quark.sourceforge.io/forums/"
!define PRODUCT_INFOBASE "https://quark.sourceforge.io/infobase/"
!define PRODUCT_DIR_REGKEY "Software\Microsoft\Windows\CurrentVersion\App Paths\QuArK.exe"
!define PRODUCT_UNINST_KEY "Software\Microsoft\Windows\CurrentVersion\Uninstall\${PRODUCT_NAME}"
!define PRODUCT_UNINST_ROOT_KEY "HKLM"
!define PRODUCT_PUBLISHER "QuArK Development Team"

; Configure installer
ManifestDPIAware true
;ManifestLongPathAware true ;Not compatible with CreateShortCut
ManifestSupportedOS all
RequestExecutionLevel admin
SetCompressor /SOLID lzma
ShowInstDetails show
ShowUnInstDetails show
Unicode false
;XPStyle true

Name "${PRODUCT_NAME} ${PRODUCT_VERSION}"
OutFile "${INSTALLER_EXENAME}"
InstallDir "$PROGRAMFILES\QuArK 6.6"
InstallDirRegKey HKLM "${PRODUCT_DIR_REGKEY}" ""

; MUI Settings
!define MUI_ABORTWARNING
!define MUI_ABORTWARNING_CANCEL_DEFAULT
!define MUI_UNABORTWARNING
!define MUI_ICON "${NSISDIR}\Contrib\Graphics\Icons\modern-install-blue.ico"
!define MUI_UNICON "${NSISDIR}\Contrib\Graphics\Icons\modern-uninstall-blue.ico"
; Loads the splash window
!define MUI_WELCOMEFINISHPAGE_BITMAP "${SPLASHDIR}\install_splash.bmp"
!define MUI_UNWELCOMEFINISHPAGE_BITMAP "${SPLASHDIR}\install_splash.bmp"
; Loads the header picture
!define MUI_HEADERIMAGE
!define MUI_HEADERIMAGE_BITMAP "${SPLASHDIR}\install_header.bmp"
!define MUI_HEADERIMAGE_UNBITMAP "${SPLASHDIR}\install_header.bmp"

; Language Selection Dialog Settings
!define MUI_LANGDLL_ALWAYSSHOW
!define MUI_LANGDLL_REGISTRY_ROOT "${PRODUCT_UNINST_ROOT_KEY}"
!define MUI_LANGDLL_REGISTRY_KEY "${PRODUCT_UNINST_KEY}"
!define MUI_LANGDLL_REGISTRY_VALUENAME "NSIS:Language"

; Installer pages
!insertmacro MUI_PAGE_WELCOME
!define MUI_LICENSEPAGE_CHECKBOX
!insertmacro MUI_PAGE_LICENSE "${BUILDDIR}\COPYING.txt"
;FIXME: Use LicenseLangString?
!define MUI_COMPONENTSPAGE_SMALLDESC
!insertmacro MUI_PAGE_COMPONENTS
!insertmacro MUI_PAGE_DIRECTORY
;FIXME: Start using MUI_PAGE_STARTMENU?
!insertmacro MUI_PAGE_INSTFILES
!define MUI_FINISHPAGE_RUN "$INSTDIR\QuArK.exe"
!define MUI_FINISHPAGE_SHOWREADME "$INSTDIR\README.txt"
!define MUI_FINISHPAGE_LINK "QuArK website"
!define MUI_FINISHPAGE_LINK_LOCATION "${PRODUCT_WEB_SITE}"
!insertmacro MUI_PAGE_FINISH

; Uninstaller pages
!insertmacro MUI_UNPAGE_INSTFILES

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

!insertmacro MUI_RESERVEFILE_LANGDLL

; Installer executable settings
VIProductVersion "${PRODUCT_VERSION_NUMBER}"

VIAddVersionKey /LANG=${LANG_ENGLISH} "ProductName" "Quake Army Knife installer"
;VIAddVersionKey /LANG=${LANG_ENGLISH} "CompanyName" "QuArK Development Team"
VIAddVersionKey /LANG=${LANG_ENGLISH} "LegalCopyright" "${PRODUCT_COPYRIGHT}"
VIAddVersionKey /LANG=${LANG_ENGLISH} "FileDescription" "Installer for the Quake Army Knife"
VIAddVersionKey /LANG=${LANG_ENGLISH} "FileVersion" "${PRODUCT_VERSION_NUMBER}"
VIAddVersionKey /LANG=${LANG_ENGLISH} "ProductVersion" "${PRODUCT_VERSION_STRING}"

VIAddVersionKey /LANG=${LANG_DUTCH} "ProductName" "Quake Army Knife installatiebestand"
;VIAddVersionKey /LANG=${LANG_DUTCH} "CompanyName" "QuArK Development Team"
VIAddVersionKey /LANG=${LANG_DUTCH} "LegalCopyright" "${PRODUCT_COPYRIGHT}"
VIAddVersionKey /LANG=${LANG_DUTCH} "FileDescription" "Installatiebestand voor de Quake Army Knife"
VIAddVersionKey /LANG=${LANG_DUTCH} "FileVersion" "${PRODUCT_VERSION_NUMBER}"
VIAddVersionKey /LANG=${LANG_DUTCH} "ProductVersion" "${PRODUCT_VERSION_STRING}"
; MUI end ------


; Based on: https://nsis.sourceforge.io/Add_uninstall_information_to_Add/Remove_Programs#Computing_EstimatedSize
; Return on top of stack the total size of the selected (installed) sections, formatted as DWORD
; Assumes no more than 256 sections are defined
Var GetInstalledSize.total
Function GetInstalledSize
	Push $0
	Push $1
	StrCpy $GetInstalledSize.total 0
	${ForEach} $1 0 256 + 1
		${if} ${SectionIsSelected} $1
			SectionGetSize $1 $0
			IntOp $GetInstalledSize.total $GetInstalledSize.total + $0
		${Endif}

		; Error flag is set when an out-of-bound section is referenced
		${if} ${errors}
			${break}
		${Endif}
	${Next}

	ClearErrors
	Pop $1
	Pop $0
	IntFmt $GetInstalledSize.total "0x%08X" $GetInstalledSize.total
	Push $GetInstalledSize.total
FunctionEnd


!define VC2005
;!define VC2010
!include "VisualCRuntimeGUIDs.nsh"


Section "!$(TEXT_SEC01_TITLE)" SEC01
  SetOutPath "$INSTDIR\addons\6DX"
  File "${BUILDDIR}\addons\6DX\*.*"
  SetOutPath "$INSTDIR\addons\Alice"
  File "${BUILDDIR}\addons\Alice\*.*"
  SetOutPath "$INSTDIR\addons\Alice\maps"
  File "${BUILDDIR}\addons\Alice\maps\*.*"
  SetOutPath "$INSTDIR\addons\CoD1"
  File "${BUILDDIR}\addons\CoD1\*.*"
  SetOutPath "$INSTDIR\addons\CoD2"
  File "${BUILDDIR}\addons\CoD2\*.*"
  SetOutPath "$INSTDIR\addons\Cry_of_Fear"
  File "${BUILDDIR}\addons\Cry_of_Fear\*.*"
  SetOutPath "$INSTDIR\addons\Crystal_Space"
  File "${BUILDDIR}\addons\Crystal_Space\*.*"
  SetOutPath "$INSTDIR\addons\Daikatana"
  File "${BUILDDIR}\addons\Daikatana\*.*"
  SetOutPath "$INSTDIR\addons\Doom_3"
  File "${BUILDDIR}\addons\Doom_3\*.*"
  SetOutPath "$INSTDIR\addons\EF2"
  File "${BUILDDIR}\addons\EF2\*.*"
  SetOutPath "$INSTDIR\addons\FAKK2"
  File "${BUILDDIR}\addons\FAKK2\*.*"
  SetOutPath "$INSTDIR\addons\Genesis3D"
  File "${BUILDDIR}\addons\Genesis3D\*.*"
  SetOutPath "$INSTDIR\addons\Half-Life"
  File "${BUILDDIR}\addons\Half-Life\*.*"
  SetOutPath "$INSTDIR\addons\Half-Life2"
  File "${BUILDDIR}\addons\Half-Life2\*.*"
  SetOutPath "$INSTDIR\addons\Heretic_II"
  File "${BUILDDIR}\addons\Heretic_II\*.*"
  SetOutPath "$INSTDIR\addons\Hexen_II"
  File "${BUILDDIR}\addons\Hexen_II\*.*"
  SetOutPath "$INSTDIR\addons\JA"
  File "${BUILDDIR}\addons\JA\*.*"
  SetOutPath "$INSTDIR\addons\JK2"
  File "${BUILDDIR}\addons\JK2\*.*"
  SetOutPath "$INSTDIR\addons\KingPin"
  File "${BUILDDIR}\addons\KingPin\*.*"
  SetOutPath "$INSTDIR\addons\MOHAA"
  File "${BUILDDIR}\addons\MOHAA\*.*"
  SetOutPath "$INSTDIR\addons\NEXUIZ"
  File "${BUILDDIR}\addons\NEXUIZ\*.*"
  SetOutPath "$INSTDIR\addons\Prey"
  File "${BUILDDIR}\addons\Prey\*.*"
  SetOutPath "$INSTDIR\addons\Quake_1"
  File "${BUILDDIR}\addons\Quake_1\*.*"
  SetOutPath "$INSTDIR\addons\Quake_2"
  File "${BUILDDIR}\addons\Quake_2\*.*"
  SetOutPath "$INSTDIR\addons\Quake_3"
  File "${BUILDDIR}\addons\Quake_3\*.*"
  SetOutPath "$INSTDIR\addons\Quake_4"
  File "${BUILDDIR}\addons\Quake_4\*.*"
  SetOutPath "$INSTDIR\addons\RTCW"
  File "${BUILDDIR}\addons\RTCW\*.*"
  SetOutPath "$INSTDIR\addons\RTCW-ET"
  File "${BUILDDIR}\addons\RTCW-ET\*.*"
  SetOutPath "$INSTDIR\addons\Sin"
  File "${BUILDDIR}\addons\Sin\*.*"
  SetOutPath "$INSTDIR\addons\SOF"
  File "${BUILDDIR}\addons\SOF\*.*"
  SetOutPath "$INSTDIR\addons\SoF2"
  File "${BUILDDIR}\addons\SoF2\*.*"
  SetOutPath "$INSTDIR\addons\STVEF"
  File "${BUILDDIR}\addons\STVEF\*.*"
  SetOutPath "$INSTDIR\addons\SvenCoop"
  File "${BUILDDIR}\addons\SvenCoop\*.*"
  SetOutPath "$INSTDIR\addons\Sylphis"
  File "${BUILDDIR}\addons\Sylphis\*.*"
  SetOutPath "$INSTDIR\addons\Torque"
  File "${BUILDDIR}\addons\Torque\*.*"
  SetOutPath "$INSTDIR\addons\Warfork"
  File "${BUILDDIR}\addons\Warfork\*.*"
  SetOutPath "$INSTDIR\addons\Warsow"
  File "${BUILDDIR}\addons\Warsow\*.*"
  SetOutPath "$INSTDIR\addons\WildWest"
  File "${BUILDDIR}\addons\WildWest\*.*"
  SetOutPath "$INSTDIR\addons"
  File "${BUILDDIR}\addons\*.*"
  SetOutPath "$INSTDIR\dlls"
  File "${BUILDDIR}\dlls\*.*"
  SetOutPath "$INSTDIR\images"
  File "${BUILDDIR}\images\*.*"
  SetOutPath "$INSTDIR\lgicons"
  File "${BUILDDIR}\lgicons\*.*"
  SetOutPath "$INSTDIR\Lib"
  File "${BUILDDIR}\Lib\*.*"
  SetOutPath "$INSTDIR\plugins"
  File "${BUILDDIR}\plugins\*.*"
  SetOutPath "$INSTDIR\quarkpy"
  File "${BUILDDIR}\quarkpy\*.*"
  SetOutPath "$INSTDIR"
  File "${BUILDDIR}\*.*"
  WriteIniStr "$INSTDIR\${PRODUCT_NAME}.url" "InternetShortcut" "URL" "${PRODUCT_WEB_SITE}"

  ;---

  ;These are needed:
  ;DevIL.dll needs VC2005 runtime (MSVCP80.dll, MSVCR80.dll)
  ;HLLib.dll needs VC2010 runtime (MSVCP100.dll, MSVCR100.dll)
  ;python.dll needs VC2003 runtime (MSVCR71.dll) ;Note that there is no VC2003 runtime installer, so we will have to include this library manually.

  Call _isInstalledVC2005
  Pop $0

  ;Not going to check, because the official installer can't handle Windows XP SP1 and earlier.
  ;Call _isInstalledVC2010
  ;Pop $1

  ;FIXME: Check Windows IE4 SP2
  ;FIXME: Check DirectX9

  ${If} $0 == 0
  ;${OrIf} $1 == 0
    MessageBox MB_ICONEXCLAMATION|MB_OK "$(TEXT_DEPENDENCIES)" /SD IDOK
  ${EndIf}
SectionEnd

Section "$(TEXT_SEC02_TITLE)" SEC02
  ;FIXME: Manually update required!
  SetOutPath "$INSTDIR\help\colorconverter"
  File "${BUILDDIR}\help\colorconverter\*.*"
  SetOutPath "$INSTDIR\help\triangleUV"
  File "${BUILDDIR}\help\triangleUV\*.*"

  SetOutPath "$INSTDIR\help\pics"
  File "${BUILDDIR}\help\pics\*.*"
  SetOutPath "$INSTDIR\help\zips"
  File "${BUILDDIR}\help\zips\*.*"
  SetOutPath "$INSTDIR\help"
  File "${BUILDDIR}\help\*.*"
SectionEnd

Section "$(TEXT_SEC03_TITLE)" SEC03
  ;SetShellVarContext all
  SetOutPath $INSTDIR ;To set the working directory for the shortcuts
  CreateDirectory "$SMPROGRAMS\QuArK"
  CreateShortCut "$SMPROGRAMS\QuArK\QuArK.lnk" "$INSTDIR\QuArK.exe"
  CreateShortCut "$SMPROGRAMS\QuArK\Website.lnk" "$INSTDIR\${PRODUCT_NAME}.url"
  CreateShortCut "$SMPROGRAMS\QuArK\Forum.lnk" "${PRODUCT_WEB_FORUM}"
  CreateShortCut "$SMPROGRAMS\QuArK\Online Infobase.lnk" "${PRODUCT_INFOBASE}"
  CreateShortCut "$SMPROGRAMS\QuArK\Readme.lnk" "$INSTDIR\README.txt"
  ;CreateShortCut "$SMPROGRAMS\QuArK\Uninstall.lnk" "$INSTDIR\uninst.exe"   ;Against Windows 95+ Guidelines; can be done through the Add/Remove Programs configuration screen panel.
SectionEnd

Section /o "$(TEXT_SEC04_TITLE)" SEC04
  ;SetShellVarContext all
  SetOutPath $INSTDIR ;To set the working directory for the shortcuts
  CreateShortCut "$DESKTOP\QuArK.lnk" "$INSTDIR\QuArK.exe"
SectionEnd

Section -Post
  WriteUninstaller "$INSTDIR\uninst.exe"
  WriteRegStr HKLM "${PRODUCT_DIR_REGKEY}" "" "$INSTDIR\QuArK.exe"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "DisplayIcon" "$INSTDIR\QuArK.exe"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "DisplayName" "${PRODUCT_NAME_FULL} (${PRODUCT_NAME})"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "DisplayVersion" "${PRODUCT_VERSION}"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "HelpLink" "${PRODUCT_WEB_FORUM}"
  ;WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "InstallDate" "..."
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "InstallLocation" "$INSTDIR"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "Publisher" "${PRODUCT_PUBLISHER}"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "Readme" "$INSTDIR\README.txt"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "UninstallString" "$INSTDIR\uninst.exe"
  WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "URLInfoAbout" "${PRODUCT_WEB_SITE}"

  ;WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "ModifyPath" "..."
  WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "NoModify" "0x00000001"
  ;WriteRegStr ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "RepairPath" "..."
  WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "NoRepair" "0x00000001"
  ;WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "NoRemove" "0x00000001"

  ;WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "MajorVersion" "..."
  ;WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "MinorVersion" "..."
  ;WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "VersionMajor" "..."
  ;WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "VersionMinor" "..."

  Call GetInstalledSize
  Pop $0
  WriteRegDWORD ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}" "EstimatedSize" "$0"
SectionEnd

Section Uninstall
  Delete "$INSTDIR\${PRODUCT_NAME}.url"
  Delete "$INSTDIR\addons\WildWest\*.*"
  Delete "$INSTDIR\addons\Warsow\*.*"
  Delete "$INSTDIR\addons\Warfork\*.*"
  Delete "$INSTDIR\addons\Torque\*.*"
  Delete "$INSTDIR\addons\Sylphis\*.*"
  Delete "$INSTDIR\addons\STVEF\*.*"
  Delete "$INSTDIR\addons\SoF2\*.*"
  Delete "$INSTDIR\addons\SOF\*.*"
  Delete "$INSTDIR\addons\Sin\*.*"
  Delete "$INSTDIR\addons\RTCW-ET\*.*"
  Delete "$INSTDIR\addons\RTCW\*.*"
  Delete "$INSTDIR\addons\Quake_4\*.*"
  Delete "$INSTDIR\addons\Quake_3\*.*"
  Delete "$INSTDIR\addons\Quake_2\*.*"
  Delete "$INSTDIR\addons\Quake_1\*.*"
  Delete "$INSTDIR\addons\Prey\*.*"
  Delete "$INSTDIR\addons\NEXUIZ\*.*"
  Delete "$INSTDIR\addons\MOHAA\*.*"
  Delete "$INSTDIR\addons\KingPin\*.*"
  Delete "$INSTDIR\addons\JK2\*.*"
  Delete "$INSTDIR\addons\JA\*.*"
  Delete "$INSTDIR\addons\Hexen_II\*.*"
  Delete "$INSTDIR\addons\Heretic_II\*.*"
  Delete "$INSTDIR\addons\Half-Life2\*.*"
  Delete "$INSTDIR\addons\Half-Life\*.*"
  Delete "$INSTDIR\addons\Genesis3D\*.*"
  Delete "$INSTDIR\addons\FAKK2\*.*"
  Delete "$INSTDIR\addons\EF2\*.*"
  Delete "$INSTDIR\addons\Doom_3\*.*"
  Delete "$INSTDIR\addons\Daikatana\*.*"
  Delete "$INSTDIR\addons\Crystal_Space\*.*"
  Delete "$INSTDIR\addons\Cry_of_Fear\*.*"
  Delete "$INSTDIR\addons\CoD2\*.*"
  Delete "$INSTDIR\addons\CoD1\*.*"
  Delete "$INSTDIR\addons\Alice\maps\*.*"
  Delete "$INSTDIR\addons\Alice\*.*"
  Delete "$INSTDIR\addons\6DX\*.*"
  Delete "$INSTDIR\addons\*.*"
  Delete "$INSTDIR\dlls\*.*"
  Delete "$INSTDIR\help\pics\*.*"
  Delete "$INSTDIR\help\*.*"
  Delete "$INSTDIR\images\*.*"
  Delete "$INSTDIR\lgicons\*.*"
  Delete "$INSTDIR\Lib\*.*"
  Delete "$INSTDIR\plugins\*.*"
  Delete "$INSTDIR\quarkpy\*.*"
  Delete "$INSTDIR\*.*"

  Delete "$SMPROGRAMS\QuArK\*.*"
  Delete "$DESKTOP\QuArK.lnk"

  RMDir "$INSTDIR\addons\WildWest"
  RMDir "$INSTDIR\addons\Warsow"
  RMDir "$INSTDIR\addons\Warfork"
  RMDir "$INSTDIR\addons\Torque"
  RMDir "$INSTDIR\addons\Sylphis"
  RMDir "$INSTDIR\addons\STVEF"
  RMDir "$INSTDIR\addons\SoF2"
  RMDir "$INSTDIR\addons\SOF"
  RMDir "$INSTDIR\addons\Sin"
  RMDir "$INSTDIR\addons\RTCW-ET"
  RMDir "$INSTDIR\addons\RTCW"
  RMDir "$INSTDIR\addons\Quake_4"
  RMDir "$INSTDIR\addons\Quake_3"
  RMDir "$INSTDIR\addons\Quake_2"
  RMDir "$INSTDIR\addons\Quake_1"
  RMDir "$INSTDIR\addons\Prey"
  RMDir "$INSTDIR\addons\NEXUIZ"
  RMDir "$INSTDIR\addons\MOHAA"
  RMDir "$INSTDIR\addons\KingPin"
  RMDir "$INSTDIR\addons\JK2"
  RMDir "$INSTDIR\addons\JA"
  RMDir "$INSTDIR\addons\Hexen_II"
  RMDir "$INSTDIR\addons\Heretic_II"
  RMDir "$INSTDIR\addons\Half-Life2"
  RMDir "$INSTDIR\addons\Half-Life"
  RMDir "$INSTDIR\addons\Genesis3D"
  RMDir "$INSTDIR\addons\FAKK2"
  RMDir "$INSTDIR\addons\EF2"
  RMDir "$INSTDIR\addons\Doom_3"
  RMDir "$INSTDIR\addons\Daikatana"
  RMDir "$INSTDIR\addons\Crystal_Space"
  RMDir "$INSTDIR\addons\Cry_of_Fear"
  RMDir "$INSTDIR\addons\CoD2"
  RMDir "$INSTDIR\addons\CoD1"
  RMDir "$INSTDIR\addons\Alice"
  RMDir "$INSTDIR\addons\6DX"
  RMDir "$INSTDIR\addons"
  RMDir "$INSTDIR\dlls"
  RMDir "$INSTDIR\help\pics"
  RMDir "$INSTDIR\help"
  RMDir "$INSTDIR\images"
  RMDir "$INSTDIR\lgicons"
  RMDir "$INSTDIR\Lib"
  RMDir "$INSTDIR\plugins"
  RMDir "$INSTDIR\quarkpy"
  RMDir "$INSTDIR"
  RMDir "$SMPROGRAMS\QuArK"

  DeleteRegKey ${PRODUCT_UNINST_ROOT_KEY} "${PRODUCT_UNINST_KEY}"
  DeleteRegKey HKLM "${PRODUCT_DIR_REGKEY}"
  SetAutoClose true
SectionEnd

!insertmacro MUI_FUNCTION_DESCRIPTION_BEGIN
  !insertmacro MUI_DESCRIPTION_TEXT ${SEC01} "$(TEXT_SEC01_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SEC02} "$(TEXT_SEC02_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SEC03} "$(TEXT_SEC03_DESC)"
  !insertmacro MUI_DESCRIPTION_TEXT ${SEC04} "$(TEXT_SEC04_DESC)"
!insertmacro MUI_FUNCTION_DESCRIPTION_END

Function .onInit
  !insertmacro MUI_LANGDLL_DISPLAY
FunctionEnd

Function un.onInit
!insertmacro MUI_UNGETLANGUAGE
  MessageBox MB_ICONEXCLAMATION|MB_YESNO|MB_DEFBUTTON2 "$(TEXT_UNINSTALL1)" /SD IDYES IDYES +2
  Abort
  MessageBox MB_ICONQUESTION|MB_YESNO|MB_DEFBUTTON2 "$(TEXT_UNINSTALL2)" /SD IDYES IDYES +2
  Abort
FunctionEnd

Function un.onUninstSuccess
  HideWindow
  MessageBox MB_ICONINFORMATION|MB_OK "$(TEXT_UNINSTALL3)" /SD IDOK
FunctionEnd
