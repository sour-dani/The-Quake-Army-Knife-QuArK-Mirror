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
unit MapError;

{$INCLUDE DelphiCompat.inc}

interface

uses DelphiCompat, Classes;

type
  TMapError = class
   protected
    MapErrorText: TStringList;
   public
    constructor Create;
    destructor Destroy; override;
    procedure Clear;
    procedure AddText(const Text: String);
    function Text : String;
  end;

var
  g_MapError : TMapError;

implementation

constructor TMapError.Create;
begin
  MapErrorText:=TStringList.Create;
end;

destructor TMapError.Destroy;
begin
  MapErrorText.Free;
  inherited;
end;

procedure TMapError.Clear;
begin
  MapErrorText.Clear;
end;

procedure TMapError.AddText(const Text: String);
begin
  MapErrorText.Add(Text);
end;

function TMapError.Text: String;
begin
  Result:=MapErrorText.Text;
  Clear;
end;

initialization
  g_MapError:=TMapError.Create;

finalization
  g_MapError.Free;

end.
