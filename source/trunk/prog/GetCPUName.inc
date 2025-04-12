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

function GetCPUName(Family: Cardinal; VendorNo: Integer; Model: Cardinal): String;
begin
  case Family of
     4: case VendorNo Of
          0: case Model of
               $0: result:='i80486DX-25/33';
               $1: result:='i80486DX-50';
               $2: result:='i80486SX';
               $3: result:='i80486DX2';
               $4: result:='i80486SL';
               $5: result:='i80486SX2';
               $7: result:='i80486DX2WB';
               $8: result:='i80486DX4';
               $9: result:='i80486DX4WB';
               else result:='Unknown';
             end;
          1: case Model of
               $1: result:='U5D(486DX)';
               $2: result:='U5S(486SX)';
               else result:='Unknown';
             end;
          2: case Model of
               $3: result:='80486DX2WT';
               $7: result:='80486DX2WB';
               $8: result:='80486DX4';
               $9: result:='80486DX4WB';
               $E: result:='5x86';
               $F: result:='5x86WB';
               else result:='Unknown';
             end;
          3: case Model of
               $4: result:='Cyrix Media GX';
               $9: result:='Cyrix 5x86';
               else result:='Unknown';
             end;
          else result:='Unknown';
        end;
     5: case VendorNo of
          0: case Model of
               $0: result:='P5 A-step';
               $1: result:='P5';
               $2: result:='P54C';
               $3: result:='P24T OverDrive';
               $4: result:='P55C';
               $5: result:='DX4 OverDrive?';
               $6: result:='P5 OverDrive?';
               $7: result:='P54C';
               $8: result:='P55C(0,25µm)MMX';
               else result:='Unknown';
             end;
          2: case Model of
               $0: result:='SSA5';
               $1: result:='5k86';
               $2: result:='5k86';
               $3: result:='5k86';
               $6: result:='K6';
               $7: result:='K6';
               $8: result:='K6-2';
               $9: result:='K6-III';
               $D: result:='K6-2+';
               else result:='Unknown';
             end;
          3: case Model of
               $0: result:='Pentium Cx6X86 GXm';
               $2: result:='Std. Cx6x86';
               $4: result:='Cx6x86 GXm';
               else result:='Unknown';
             end;
          4: result:='Nx586';
          5: result:='IDT C6 (WinChip)';
          else result:='Unknown';
          end;
     6: case VendorNo of
          0: case Model of
               $0: result:='PentiumPro A-step';
               $1: result:='Pentium Pro';
               $3: result:='Pentium II';
               $4: result:='P55CT (P54 overdrive)';
               $5: result:='Pentium II 0,25µm';
               $6: result:='Celeron, model 06';
               $7: result:='Pentium III, model 07';
               $8: result:='Pentium/Celeron III, model 08';
               $9: result:='Pentium M/Celeron M, model 09';
               $A: result:='Pentium Xeon III, model 0Ah';
               $B: result:='Pentium III, model 0Bh';
               $D: result:='Pentium M/Celeron M, model 0Dh';
               $E: result:='Core';
               $F: result:='Core 2';
               $15: result:='Pentium M';
               $16: result:='Core 2';
               $17: result:='Core 2, model Penryn';
               $1A: result:='Nehalem';
               $1C: result:='Bonnell';
               $1D: result:='Core 2, model Penryn';
               $1E: result:='Nehalem';
               $25: result:='Westmere';
               $26: result:='Bonnell';
               $27: result:='Saltwell';
               $2A: result:='Sandy Bridge';
               $2C: result:='Westmere';
               $2D: result:='Sandy Bridge';
               $2E: result:='Nehalem';
               $2F: result:='Westmere';
               $35: result:='Saltwell';
               $36: result:='Saltwell';
               $37: result:='Silvermont';
               $3A: result:='Ivy Bridge';
               $3C: result:='Haswell';
               $3D: result:='Broadwell';
               $3E: result:='Ivy Bridge';
               $3F: result:='Haswell';
               $45: result:='Haswell';
               $46: result:='Haswell';
               $47: result:='Broadwell';
               $4A: result:='Silvermont';
               $4C: result:='Airmont';
               $4D: result:='Silvermont';
               $4E: result:='Skylake';
               $4F: result:='Broadwell';
               $55: result:='Skylake/Cascade Lake/Cooper Lake';
               $56: result:='Broadwell';
               $5A: result:='Silvermont';
               $5C: result:='Goldmont';
               $5D: result:='Silvermont';
               $5E: result:='Skylake';
               $5F: result:='Goldmont';
               else result:='Unknown';
             end;
          2: case Model of
               $1: result:='Athlon';
               $2: result:='Athlon';
               $3: result:='Duron';
               $4: result:='Athlon';
               $6: result:='Athlon / Athlon MP / Duron / Athlon XP';
               $7: result:='Duron';
               $8: result:='Athlon XP / Duron / Sempron / Athlon MP / Mobile Athlon';
               $A: result:='Athlon XP / Sempron / Mobile Athlon';
               else result:='Unknown';
             end;
          3: if Model=0 then
               result:='Cx6x86 MX/MII'
             else result:='Unknown';
          else result:='Unknown';
        end;
     else result:='Unknown';
  end;
end;
