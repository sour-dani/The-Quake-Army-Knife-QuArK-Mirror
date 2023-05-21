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

//FastMM memory manager
{$IF COMPILERVERSION >= 20} //FastMM5 only supports Delphi XE3 and higher, so fall back to FastMM4 below that.
{.$DEFINE FastMM_FullDebugMode}
{.$DEFINE FastMM_ClearLogFileOnStartup}
{.$DEFINE FastMM_EnableMemoryLeakReporting}
{$DEFINE FastMM_NoMessageBoxes}
{$DEFINE FastMM_NoDebugInfo}
{$DEFINE FastMM5}     (*Enable for FastMM5, copy the debug DLL to the runtime directory when debugging*)
{$ELSE}
{$DEFINE FastMM4}     (*Enable for FastMM4, copy the debug DLL to the runtime directory when debugging*)
{$IFEND}

//Enable for MemCheck
{.$DEFINE MemCheck}
