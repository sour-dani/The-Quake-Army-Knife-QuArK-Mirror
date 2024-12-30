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

//
//Determines the memory manager to use.
//

//QuArK MemTester unit
{.$DEFINE MemTester}

//FastMM/RecyclerMM memory manager
//Note: copy the debug DLL to the runtime directory when debugging
{$IFDEF CONDITIONALEXPRESSIONS}
	{$IF COMPILERVERSION >= 24} //Supported Compilers: Delphi XE3 and later.
		{.$DEFINE FastMM_FullDebugMode}
		{.$DEFINE FastMM_ClearLogFileOnStartup}
		{.$DEFINE FastMM_EnableMemoryLeakReporting}
		{$DEFINE FastMM_NoMessageBoxes}
		{$DEFINE FastMM_NoDebugInfo}
		{$DEFINE FastMM5}
	{$IFEND}
{$ENDIF}
{$IFNDEF FastMM5} //Fall back to FastMM4 or RecyclerMM.
	{$IFDEF VER80}
		{$DEFINE Delphi1or2or3}
	{$ENDIF}
	{$IFDEF VER90}
		{$DEFINE Delphi1or2or3}
	{$ENDIF}
	{$IFDEF VER100}
		{$DEFINE Delphi1or2or3}
	{$ENDIF}
	{$IFDEF Delphi1or2or3}
		{$DEFINE RecyclerMM}
	{$ELSE}
		{$DEFINE FastMM4} //Supports Delphi 4 (or later), C++ Builder 4 (or later), Kylix 3.
		{.$DEFINE FastMM3} //Requires Delphi 7 or later (Win32) compiler. May compile under Delphi 5/6 with NoMMX defined (not tested).
		{.$DEFINE FastMM} //Requires Delphi 7 or later (Win32) compiler. May compile under Delphi 5/6 with NoMMX defined (not tested).
	{$ENDIF}
{$ENDIF}

//Enable for MemCheck
{.$DEFINE MemCheck}
