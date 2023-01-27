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

// Pre-2.0 versions of Python are no longer supported.
{$DEFINE PYTHON24}

// Version cascade:
{$IFDEF PYTHON27}
{$DEFINE PYTHON26}
{$ENDIF}
{$IFDEF PYTHON26}
{$DEFINE PYTHON25}
{$ENDIF}
{$IFDEF PYTHON25}
{$DEFINE PYTHON24}
{$ENDIF}
{$IFDEF PYTHON24}
{$DEFINE PYTHON23}
{$ENDIF}
{$IFDEF PYTHON23}
{$DEFINE PYTHON22}
{$ENDIF}
{$IFDEF PYTHON22}
{$DEFINE PYTHON21}
{$ENDIF}
{$IFDEF PYTHON21}
{$DEFINE PYTHON20}
{$ENDIF}
