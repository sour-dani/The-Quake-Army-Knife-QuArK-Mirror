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
unit qquaternions;

interface

uses SysUtils, qmath, qmatrices;

type
 PQuaternion = ^TQuaternion;
 TQuaternion = record
                X, Y, Z, W: Double;
               end;

 {------------------------}

function MultiplyQuaternions(const Q1, Q2: TQuaternion) : TQuaternion;
function qtos(const Q: TQuaternion) : String;
function stoq(const S: String) : TQuaternion;
function QuaternionNorm(const Q: TQuaternion) : Double;
function QuaternionInverse(const Q: TQuaternion) : TQuaternion;
procedure QuaternionNormalise(var Q: TQuaternion);
function QuaternionToMatrix(const Q: TQuaternion) : TMatrixTransformation;
//function QuaternionFromMatrix(const M: TMatrixTransformation) : TQuaternion;

 {------------------------}

implementation

uses Qk3D;

 {------------------------}

function QuaternionNorm(const Q: TQuaternion) : Double;
begin
 Result:=sqrt(Q.X*Q.X + Q.Y*Q.Y + Q.Z*Q.Z + Q.W*Q.W);
end;

function MultiplyQuaternions(const Q1, Q2: TQuaternion) : TQuaternion;
var
 r: array[1..4] of Double;
 d: Double;
begin
  r[1]:=Q2.W * Q1.X + Q2.X * Q1.W + Q2.Y * Q1.Z - Q2.Z * Q1.Y;
  r[2]:=Q2.W * Q1.Y + Q2.Y * Q1.W + Q2.Z * Q1.X - Q2.X * Q1.Z;
  r[3]:=Q2.W * Q1.Z + Q2.Z * Q1.W + Q2.X * Q1.Y - Q2.Y * Q1.X;
  r[4]:=Q2.W * Q1.W - Q2.X * Q1.X - Q2.Y * Q1.Y - Q2.Z * Q1.Z;
  d:=sqrt(r[1] * r[1] + r[2] * r[2] + r[3] * r[3] + r[4] * r[4]);
  Result.X:=r[1] / d;
  Result.Y:=r[2] / d;
  Result.Z:=r[3] / d;
  Result.W:=r[4] / d;
end;

function QuaternionInverse(const Q: TQuaternion) : TQuaternion;
var
 Facteur: Double;
begin
 Facteur:=1/QuaternionNorm(Q);
 Result.X:=-Q.X * Facteur;
 Result.Y:=-Q.Y * Facteur;
 Result.Z:=-Q.Z * Facteur;
 Result.W:=Q.W * Facteur;
end;

procedure QuaternionNormalise(var Q: TQuaternion);
var
 F,S: Double;
begin
 S:=Sqrt(Sqr(Q.X)+Sqr(Q.Y)+Sqr(Q.Z)+Sqr(Q.W));
 if (S = 0) then
   exit;
 F:=1/S;
 Q.X:=Q.X*F;
 Q.Y:=Q.Y*F;
 Q.Z:=Q.Z*F;
 Q.W:=Q.W*F;
end;

function qtos(const Q: TQuaternion) : String;
begin
 Result:=ftos(Q.X) + ' ' + ftos(Q.Y) + ' ' + ftos(Q.Z) + ' ' + ftos(Q.W);
end;

function stoq(const S: String) : TQuaternion;
var
 V: array[1..4] of Double;
begin
 ReadDoubleArray(S, V);
 Result:=TQuaternion(V);
end;

function QuaternionToMatrix(const Q: TQuaternion) : TMatrixTransformation;
var
  xx, yy, zz, xy, xz, yz, wx, wy, wz: Double;
begin
  xx := Q.X * Q.X;
  yy := Q.Y * Q.Y;
  zz := Q.Z * Q.Z;
  xy := Q.X * Q.Y;
  xz := Q.X * Q.Z;
  yz := Q.Y * Q.Z;
  wx := Q.W * Q.X;
  wy := Q.W * Q.Y;
  wz := Q.W * Q.Z;
  Result[1,1]:=1.0 - 2.0 * (yy + zz);
  Result[1,2]:=      2.0 * (xy + wz);
  Result[1,3]:=      2.0 * (xz - wy);
  Result[2,1]:=      2.0 * (xy - wz);
  Result[2,2]:=1.0 - 2.0 * (xx + zz);
  Result[2,3]:=      2.0 * (yz + wx);
  Result[3,1]:=      2.0 * (xz + wy);
  Result[3,2]:=      2.0 * (yz - wx);
  Result[3,3]:=1.0 - 2.0 * (xx + yy);
end;

(*function QuaternionFromMatrix(const M: TMatrixTransformation) : TQuaternion; //FIXME: Untested
var
  S, X, Y, Z: Double;
begin
  //This function assumes the matrix is a rotation matrix.
  S := Sqrt(Abs(M[1,1] + M[2,2] + M[3,3] + 1.0));
  if S = 0.0 then
  begin
    X := Abs(M[3,2] - M[2,3]);
    Y := Abs(M[1,3] - M[3,1]);
    Z := Abs(M[2,1] - M[1,2]);
    if (X >= Y) and (X >= Z) then
    begin
      Result.X:=1.0;
      Result.Y:=0.0;
      Result.Z:=0.0;
      Result.W:=0.0;
    end
    else if (Y >= X) and (Y >= Z) then
    begin
      Result.X:=0.0;
      Result.Y:=1.0;
      Result.Z:=0.0;
      Result.W:=0.0;
    end
    else
    begin
      Result.X:=0.0;
      Result.Y:=0.0;
      Result.Z:=1.0;
      Result.W:=0.0;
    end;
  end
  else
  begin
    Result.X:=-(M[3,2] - M[2,3]) / (2.0 * S);
    Result.Y:=-(M[1,3] - M[3,1]) / (2.0 * S);
    Result.Z:=-(M[2,1] - M[1,2]) / (2.0 * S);
    Result.W:=0.5 * S;
    QuaternionNormalise(Result);
  end;
end;*)

end.
