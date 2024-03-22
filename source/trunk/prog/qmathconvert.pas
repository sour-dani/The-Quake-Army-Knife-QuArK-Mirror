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
unit qmathconvert;

//Putting these in a separate module, as to prevent cyclical includes.

interface

uses SysUtils, qmath, qmatrices, qquaternions;

function QuaternionToMatrix(const Q: TQuaternion) : TMatrixTransformation;
function MatrixToQuaternion(const M: TMatrixTransformation) : TQuaternion;

 {------------------------}

implementation

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

function MatrixToQuaternion(const M: TMatrixTransformation) : TQuaternion;
var
  S: Double;
begin
  //This function assumes the matrix is a rotation matrix.
  //See: http://www.euclideanspace.com/maths/geometry/rotations/conversions/matrixToQuaternion/index.htm
  S := Sqrt(Abs(M[1,1] + M[2,2] + M[3,3] + 1.0));
  if S = 0.0 then
  begin
    if (M[1,1] > M[2,2]) and (M[1,1] > M[3,3]) then
    begin
      S := Sqrt(1.0 + M[1,1] - M[2,2] - M[3,3]) * 2.0;
      Result.X:=0.25 * S;
      Result.Y:=(M[2,1] + M[1,2]) / S;
      Result.Z:=(M[3,1] + M[1,2]) / S;
      Result.W:=(M[2,3] - M[3,2]) / S;
    end
    else if M[2,2] > M[3,3] then
    begin
      S := Sqrt(1.0 + M[2,2] - M[1,1] - M[3,3]) * 2.0;
      Result.X:=(M[2,1] + M[1,2]) / S;
      Result.Y:=0.25 * S;
      Result.Z:=(M[3,2] + M[2,3]) / S;
      Result.W:=(M[3,1] - M[1,3]) / S;
    end
    else
    begin
      S := Sqrt(1.0 + M[3,3] - M[1,1] - M[2,2]) * 2.0;
      Result.X:=(M[3,1] + M[1,3]) / S;
      Result.Y:=(M[3,2] + M[2,3]) / S;
      Result.Z:=0.25 * S;
      Result.W:=(M[1,2] - M[2,1]) / S;
    end;
  end
  else
  begin
    Result.X:=(M[2,3] - M[3,2]) / (2.0 * S);
    Result.Y:=(M[3,1] - M[1,3]) / (2.0 * S);
    Result.Z:=(M[1,2] - M[2,1]) / (2.0 * S);
    Result.W:=0.5 * S;
  end;
end;

end.
