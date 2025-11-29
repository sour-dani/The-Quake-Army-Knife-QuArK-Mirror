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

{$INCLUDE DelphiVer.inc}

{$IFNDEF Delphi2005orNewerCompiler}
  {$DEFINE CPU386}
{$ENDIF}

{$IFNDEF DelphiXE2orNewerCompiler}
  {$DEFINE CPUX86}
{$ENDIF}

{$IFNDEF DelphiXE8orNewerCompiler}
  {$IFDEF CPUX64}
    {$DEFINE CPU64BITS}
  {$ELSE} //CPUX86 or CPUARM
    {$IFDEF CompiledWithDelphi1}
      {$DEFINE CPU16BITS}
    {$ELSE}
      {$DEFINE CPU32BITS}
    {$ENDIF}
  {$ENDIF}

  {$IFDEF CPUARM}
    {$IFDEF CPU64BITS}
      {$DEFINE CPUARM64}
    {$ELSE} //CPU32BITS
      {$DEFINE CPUARM32}
    {$ENDIF}
  {$ENDIF}
{$ENDIF}

{$IFNDEF Delphi6orNewerCompiler}
  //Delphi 5 and earlier don't support other platforms, so they don't define this conditional.
  {$DEFINE MSWINDOWS}
{$ENDIF}

{$IFDEF MSWINDOWS}
  {$IFNDEF Delphi2009orNewerCompiler}
    {$IFDEF CompiledWithDelphi1}
      {$DEFINE WIN16}
    {$ELSE}
      {$DEFINE WIN32}
    {$ENDIF}
  {$ENDIF}
{$ENDIF}
