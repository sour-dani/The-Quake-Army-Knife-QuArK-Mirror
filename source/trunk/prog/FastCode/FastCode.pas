unit Fastcode;

(* ***** BEGIN LICENSE BLOCK *****
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is Fastcode
 *
 * The Initial Developer of the Original Code is Fastcode
 *
 * Portions created by the Initial Developer are Copyright (C) 2002-2005
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 * Charalabos Michael <chmichael@creationpower.com>
 * John O'Harrow <john@elmcrest.demon.co.uk>
 *
 * ***** END LICENSE BLOCK ***** *)

interface

{$I Fastcode.inc}

//DanielPharos: Added Delphi 2005, 2007, and 2009 IFDEF's.
{$IFDEF Delphi2009Plus}FastCode was integrated into the official RTL{$ENDIF}

uses
  FastcodeCPUID,
  FastcodePatch
  {$IFNDEF Delphi2007Plus},
  FastcodeAnsiStringReplaceUnit,
  FastcodePosUnit
  {$ENDIF}
  {$IFDEF Delphi7Plus},
  FastcodePosExUnit
  {$ENDIF}
  {$IFNDEF Delphi2007Plus},
  FastcodeLowerCaseUnit,
  FastcodeUpperCaseUnit,
  FastcodeCompareStrUnit,
  FastcodeCompareMemUnit
  {$ENDIF}
  {$IFNDEF Delphi2005Plus}, //DanielPharos: Was integrated into the official RTL
  FastcodeCompareTextUnit
  {$ENDIF}
  {$IFNDEF Delphi2007Plus},
  FastcodeStrCompUnit,
  FastcodeStrCopyUnit,
  FastcodeStrICompUnit,
  FastcodeStrLenUnit
  {$ENDIF}
  {$IFNDEF Delphi2005Plus}, //DanielPharos: Was integrated into the official RTL
  FastcodeFillCharUnit
  {$ENDIF}
  {$IFNDEF Delphi2007Plus},
  FastcodeStrToInt32Unit
  {$ENDIF};

const
  FastCodeRTLVersion = '0.6.2';

var
  {$IFNDEF Delphi2007Plus}
  FastcodeAnsiStringReplace: FastcodeAnsiStringReplaceFunction = nil;
  FastcodeCompareMem: FastcodeCompareMemFunction = nil;
  FastcodeCompareStr: FastcodeCompareStrFunction = nil;
  {$ENDIF}
  {$IFNDEF Delphi2005Plus}
  FastcodeCompareText: FastcodeCompareTextFunction = nil;
  FastcodeFillChar: FastcodeFillCharFunction = nil;
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}  
  FastcodeLowerCase: FastcodeLowerCaseFunction = nil;
  FastcodePos: FastcodePosFunction = nil;
  {$ENDIF}
  {$IFDEF Delphi7Plus}
  FastcodePosEx: FastcodePosExFunction = nil;
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeStrComp: FastcodeStrCompFunction = nil;
  FastcodeStrCopy: FastcodeStrCopyFunction = nil;
  FastcodeStrIComp: FastcodeStrICompFunction = nil;
  FastcodeStrLen: FastcodeStrLenFunction = nil;
  FastcodeStrToInt32: FastcodeStrToInt32Function = nil;
  FastcodeUpperCase: FastcodeUpperCaseFunction = nil;
  {$ENDIF}

implementation

uses
  Windows, SysUtils;

initialization
{$IFDEF FastcodeCPUID}
  case FastcodeTarget of
           fctIA32: begin
                      {$IFDEF FastcodeSizePenalty}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceIA32SizePenalty;
                        FastcodeCompareMem := FastcodeCompareMemIA32SizePenalty;
                        FastcodeCompareStr := FastcodeCompareStrIA32SizePenalty;
                        {$ENDIF}
                        {$IFNDEF Delphi2005Plus}
                        FastcodeCompareText := FastcodeCompareTextIA32SizePenalty;
                        FastcodeFillChar := FastcodeFillCharIA32SizePenalty;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeLowerCase := FastcodeLowerCaseIA32SizePenalty;
                        FastcodePos := FastcodePosIA32SizePenalty;
                        {$ENDIF}
                        {$IFDEF Delphi7Plus}
                        FastcodePosEx := FastcodePosExIA32SizePenalty;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeStrComp := FastcodeStrCompIA32SizePenalty;
                        FastcodeStrCopy := FastcodeStrCopyIA32SizePenalty;
                        FastcodeStrIComp := FastcodeStrICompIA32SizePenalty;
                        FastcodeStrLen := FastcodeStrLenIA32SizePenalty;
                        FastcodeStrToInt32 := FastcodeStrToInt32IA32SizePenalty
                        FastcodeUpperCase := FastcodeUpperCaseIA32SizePenalty;
                        {$ENDIF}
                      {$ELSE}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceIA32;
                        FastcodeCompareMem := FastcodeCompareMemIA32;
                        FastcodeCompareStr := FastcodeCompareStrIA32;
                        {$ENDIF}
                        {$IFNDEF Delphi2005Plus}
                        FastcodeCompareText := FastcodeCompareTextIA32;
                        FastcodeFillChar := FastcodeFillCharIA32;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeLowerCase := FastcodeLowerCaseIA32;
                        FastcodePos := FastcodePosIA32;
                        {$ENDIF}
                        {$IFDEF Delphi7Plus}
                        FastcodePosEx := FastcodePosExIA32;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeStrComp := FastcodeStrCompIA32;
                        FastcodeStrCopy := FastcodeStrCopyIA32;
                        FastcodeStrIComp := FastcodeStrICompIA32;
                        FastcodeStrLen := FastcodeStrLenIA32;
                        FastcodeStrToInt32 := FastcodeStrToInt32IA32;
                        FastcodeUpperCase := FastcodeUpperCaseIA32;
                        {$ENDIF}
                      {$ENDIF}
                    end;
            fctMMX: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceMMX;
                      FastcodeCompareMem := FastcodeCompareMemMMX;
                      FastcodeCompareStr := FastcodeCompareStrMMX;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextMMX;
                      FastcodeFillChar := FastcodeFillCharMMX;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCaseMMX;
                      FastcodePos := FastcodePosMMX;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExMMX;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompMMX;
                      FastcodeStrCopy := FastcodeStrCopyMMX;
                      FastcodeStrIComp := FastcodeStrICompMMX;
                      FastcodeStrLen := FastcodeStrLenMMX;
                      FastcodeStrToInt32 := FastcodeStrToInt32MMX;
                      FastcodeUpperCase := FastcodeUpperCaseMMX;
                      {$ENDIF}
                    end;
            fctSSE: begin
                      {$IFDEF FastcodeSizePenalty}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceSSESizePenalty;
                        FastcodeCompareMem := FastcodeCompareMemSSESizePenalty;
                        FastcodeCompareStr := FastcodeCompareStrSSESizePenalty;
                        {$ENDIF}
                        {$IFNDEF Delphi2005Plus}
                        FastcodeCompareText := FastcodeCompareTextSSESizePenalty;
                        FastcodeFillChar := FastcodeFillCharSSESizePenalty;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeLowerCase := FastcodeLowerCaseSSESizePenalty;
                        FastcodePos := FastcodePosSSESizePenalty;
                        {$ENDIF}
                        {$IFDEF Delphi7Plus}
                        FastcodePosEx := FastcodePosExSSESizePenalty;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeStrComp := FastcodeStrCompSSESizePenalty;
                        FastcodeStrCopy := FastcodeStrCopySSESizePenalty;
                        FastcodeStrIComp := FastcodeStrICompSSESizePenalty;
                        FastcodeStrLen := FastcodeStrLenSSESizePenalty;
                        FastcodeStrToInt32 := FastcodeStrToInt32SSESizePenalty
                        FastcodeUpperCase := FastcodeUpperCaseSSESizePenalty;
                        {$ENDIF}
                      {$ELSE}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceSSE;
                        FastcodeCompareMem := FastcodeCompareMemSSE;
                        FastcodeCompareStr := FastcodeCompareStrSSE;
                        {$ENDIF}
                        {$IFNDEF Delphi2005Plus}
                        FastcodeCompareText := FastcodeCompareTextSSE;
                        FastcodeFillChar := FastcodeFillCharSSE;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeLowerCase := FastcodeLowerCaseSSE;
                        FastcodePos := FastcodePosSSE;
                        {$ENDIF}
                        {$IFDEF Delphi7Plus}
                        FastcodePosEx := FastcodePosExSSE;
                        {$ENDIF}
                        {$IFNDEF Delphi2007Plus}
                        FastcodeStrComp := FastcodeStrCompSSE;
                        FastcodeStrCopy := FastcodeStrCopySSE;
                        FastcodeStrIComp := FastcodeStrICompSSE;
                        FastcodeStrLen := FastcodeStrLenSSE;
                        FastcodeStrToInt32 := FastcodeStrToInt32SSE;
                        FastcodeUpperCase := FastcodeUpperCaseSSE;
                        {$ENDIF}
                      {$ENDIF}
                    end;
           fctSSE2: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceSSE2;
                      FastcodeCompareMem := FastcodeCompareMemSSE2;
                      FastcodeCompareStr := FastcodeCompareStrSSE2;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextSSE2;
                      FastcodeFillChar := FastcodeFillCharSSE2;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCaseSSE2;
                      FastcodePos := FastcodePosSSE2;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExSSE2;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompSSE2;
                      FastcodeStrCopy := FastcodeStrCopySSE2;
                      FastcodeStrIComp := FastcodeStrICompSSE2;
                      FastcodeStrLen := FastcodeStrLenSSE2;
                      FastcodeStrToInt32 := FastcodeStrToInt32SSE2;
                      FastcodeUpperCase := FastcodeUpperCaseSSE2;
                      {$ENDIF}
                    end;
            fctPMD: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplacePMD;
                      FastcodeCompareMem := FastcodeCompareMemPMD;
                      FastcodeCompareStr := FastcodeCompareStrPMD;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextPMD;
                      FastcodeFillChar := FastcodeFillCharPMD;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCasePMD;
                      FastcodePos := FastcodePosPMD;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExPMD;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompPMD;
                      FastcodeStrCopy := FastcodeStrCopyPMD;
                      FastcodeStrIComp := FastcodeStrICompPMD;
                      FastcodeStrLen := FastcodeStrLenPMD;
                      FastcodeStrToInt32 := FastcodeStrToInt32PMD;
                      FastcodeUpperCase := FastcodeUpperCasePMD;
                      {$ENDIF}
                    end;
            fctPMY: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplacePMY;
                      FastcodeCompareMem := FastcodeCompareMemPMY;
                      FastcodeCompareStr := FastcodeCompareStrPMY;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextPMY;
                      FastcodeFillChar := FastcodeFillCharPMY;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCasePMY;
                      FastcodePos := FastcodePosPMY;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExPMY;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompPMY;
                      FastcodeStrCopy := FastcodeStrCopyPMY;
                      FastcodeStrIComp := FastcodeStrICompPMY;
                      FastcodeStrLen := FastcodeStrLenPMY;
                      FastcodeStrToInt32 := FastcodeStrToInt32PMY;
                      FastcodeUpperCase := FastcodeUpperCasePMY;
                      {$ENDIF}
                    end;
            fctP4N: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceP4N;
                      FastcodeCompareMem := FastcodeCompareMemP4N;
                      FastcodeCompareStr := FastcodeCompareStrP4N;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextP4N;
                      FastcodeFillChar := FastcodeFillCharP4N;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCaseP4N;
                      FastcodePos := FastcodePosP4N;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExP4N;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompP4N;
                      FastcodeStrCopy := FastcodeStrCopyP4N;
                      FastcodeStrIComp := FastcodeStrICompP4N;
                      FastcodeStrLen := FastcodeStrLenP4N;
                      FastcodeStrToInt32 := FastcodeStrToInt32P4N;
                      FastcodeUpperCase := FastcodeUpperCaseP4N;
                      {$ENDIF}
                    end;
            fctP4R: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceP4R;
                      FastcodeCompareMem := FastcodeCompareMemP4R;
                      FastcodeCompareStr := FastcodeCompareStrP4R;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextP4R;
                      FastcodeFillChar := FastcodeFillCharP4R;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCaseP4R;
                      FastcodePos := FastcodePosP4R;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExP4R;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompP4R;
                      FastcodeStrCopy := FastcodeStrCopyP4R;
                      FastcodeStrIComp := FastcodeStrICompP4R;
                      FastcodeStrLen := FastcodeStrLenP4R;
                      FastcodeStrToInt32 := FastcodeStrToInt32P4R;
                      FastcodeUpperCase := FastcodeUpperCaseP4R;
                      {$ENDIF}
                    end;
          fctAmd64: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceAmd64;
                      FastcodeCompareMem := FastcodeCompareMemAmd64;
                      FastcodeCompareStr := FastcodeCompareStrAmd64;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextAmd64;
                      FastcodeFillChar := FastcodeFillCharAmd64;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCaseAmd64;
                      FastcodePos := FastcodePosAmd64;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExAmd64;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompAmd64;
                      FastcodeStrCopy := FastcodeStrCopyAmd64;
                      FastcodeStrIComp := FastcodeStrICompAmd64;
                      FastcodeStrLen := FastcodeStrLenAmd64;
                      FastcodeStrToInt32 := FastcodeStrToInt32Amd64;
                      FastcodeUpperCase := FastcodeUpperCaseAmd64;
                      {$ENDIF}
                    end;
     fctAmd64_SSE3: begin
                      {$IFNDEF Delphi2007Plus}
                      FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceAmd64_SSE3;
                      FastcodeCompareMem := FastcodeCompareMemAmd64_SSE3;
                      FastcodeCompareStr := FastcodeCompareStrAmd64_SSE3;
                      {$ENDIF}
                      {$IFNDEF Delphi2005Plus}
                      FastcodeCompareText := FastcodeCompareTextAmd64_SSE3;
                      FastcodeFillChar := FastcodeFillCharAmd64_SSE3;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeLowerCase := FastcodeLowerCaseAmd64_SSE3;
                      FastcodePos := FastcodePosAmd64_SSE3;
                      {$ENDIF}
                      {$IFDEF Delphi7Plus}
                      FastcodePosEx := FastcodePosExAmd64_SSE3;
                      {$ENDIF}
                      {$IFNDEF Delphi2007Plus}
                      FastcodeStrComp := FastcodeStrCompAmd64_SSE3;
                      FastcodeStrCopy := FastcodeStrCopyAmd64_SSE3;
                      FastcodeStrIComp := FastcodeStrICompAmd64_SSE3;
                      FastcodeStrLen := FastcodeStrLenAmd64_SSE3;
                      FastcodeStrToInt32 := FastcodeStrToInt32Amd64_SSE3;
                      FastcodeUpperCase := FastcodeUpperCaseAmd64_SSE3;
                      {$ENDIF}
                    end;

  end;

{$ENDIF}

{$IFDEF FastcodeIA32}
  {$IFDEF FastcodeSizePenalty}
    {$IFNDEF Delphi2007Plus}
    FastcodeAnsiStringReplace := FastCodeAnsiStringReplaceIA32SizePenalty;
    FastcodeCompareMem := FastcodeCompareMemIA32SizePenalty;
    FastcodeCompareStr := FastcodeCompareStrIA32SizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeCompareText := FastcodeCompareTextIA32SizePenalty;
    FastcodeFillChar := FastcodeFillCharIA32SizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeLowerCase := FastcodeLowerCaseIA32SizePenalty;
    FastcodePos := FastcodePosIA32SizePenalty;
    {$ENDIF}
    {$IFDEF Delphi7Plus}
    FastcodePosEx := FastcodePosExIA32SizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeStrComp := FastcodeStrCompIA32SizePenalty;
    FastcodeStrCopy := FastcodeStrCopyIA32SizePenalty;
    FastcodeStrIComp := FastcodeStrICompIA32SizePenalty;
    FastcodeStrLen := FastcodeStrLenIA32SizePenalty;
    FastcodeStrStrToInt32 := FastcodeStrToInt32IA32SizePenalty;
    FastcodeUpperCase := FastcodeUpperCaseIA32SizePenalty;
    {$ENDIF}
  {$ELSE}
    {$IFNDEF Delphi2007Plus}
    FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceIA32;
    FastcodeCompareMem := FastcodeCompareMemIA32;
    FastcodeCompareStr := FastcodeCompareStrIA32;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeCompareText := FastcodeCompareTextIA32;
    FastcodeFillChar := FastcodeFillCharIA32;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeLowerCase := FastcodeLowerCaseIA32;
    FastcodePos := FastcodePosIA32;
    {$ENDIF}
    {$IFDEF Delphi7Plus}
    FastcodePosEx := FastcodePosExIA32;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeStrComp := FastcodeStrCompIA32;
    FastcodeStrCopy := FastcodeStrCopyIA32;
    FastcodeStrIComp := FastcodeStrICompIA32;
    FastcodeStrLen := FastcodeStrLenIA32;
    FastcodeStrToInt32 := FastcodeStrToInt32IA32; //DanielPharos: The uncompilable typo I fixed here proves this was never tested.
    FastcodeUpperCase := FastcodeUpperCaseIA32;
    {$ENDIF}
  {$ENDIF}
{$ENDIF}

{$IFDEF FastcodeMMX}
  {$IFNDEF Delphi2007Plus}
  FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceMMX;
  FastcodeCompareMem := FastcodeCompareMemMMX;
  FastcodeCompareStr := FastcodeCompareStrMMX;
  {$ENDIF}
  {$IFNDEF Delphi2005Plus}
  FastcodeCompareText := FastcodeCompareTextMMX;
  FastcodeFillChar := FastcodeFillCharMMX;
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeLowerCase := FastcodeLowerCaseMMX;
  FastcodePos := FastcodePosMMX;
  {$ENDIF}
  {$IFDEF Delphi7Plus}
  FastcodePosEx := FastcodePosExMMX;
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeStrComp := FastcodeStrCompMMX;
  FastcodeStrCopy := FastcodeStrCopyMMX;
  FastcodeStrIComp := FastcodeStrICompMMX;
  FastcodeStrLen := FastcodeStrLenMMX;
  FastcodeStrToInt32 := FastcodeStrToInt32MMX;
  FastcodeUpperCase := FastcodeUpperCaseMMX;
  {$ENDIF}
{$ENDIF}

{$IFDEF FastcodeSSE}
  {$IFDEF FastcodeSizePenalty}
    {$IFNDEF Delphi2007Plus}
    FastcodeAnsiStringReplace := FastCodeAnsiStringReplaceSSESizePenalty;
    FastcodeCompareMem := FastcodeCompareMemSSESizePenalty;
    FastcodeCompareStr := FastcodeCompareStrSSESizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeCompareText := FastcodeCompareTextSSESizePenalty;
    FastcodeFillChar := FastcodeFillCharSSESizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeLowerCase := FastcodeLowerCaseSSESizePenalty;
    FastcodePos := FastcodePosSSESizePenalty;
    {$ENDIF}
    {$IFDEF Delphi7Plus}
    FastcodePosEx := FastcodePosExSSESizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeStrComp := FastcodeStrCompSSESizePenalty;
    FastcodeStrCopy := FastcodeStrCopySSESizePenalty;
    FastcodeStrIComp := FastcodeStrICompSSESizePenalty;
    FastcodeStrLen := FastcodeStrLenSSESizePenalty;
    FastcodeStrToInt32 := FastcodeStrToInt32SSESizePenalty;
    FastcodeUpperCase := FastcodeUpperCaseSSESizePenalty;
    {$ENDIF}
  {$ELSE}
    {$IFNDEF Delphi2007Plus}
    FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceSSE;
    FastcodeCompareMem := FastcodeCompareMemSSE;
    FastcodeCompareStr := FastcodeCompareStrSSE;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeCompareText := FastcodeCompareTextSSE;
    FastcodeFillChar := FastcodeFillCharSSE;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeLowerCase := FastcodeLowerCaseSSE;
    FastcodePos := FastcodePosSSE;
    {$ENDIF}
    {$IFDEF Delphi7Plus}
    FastcodePosEx := FastcodePosExSSE;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeStrComp := FastcodeStrCompSSE;
    FastcodeStrCopy := FastcodeStrCopySSE;
    FastcodeStrIComp := FastcodeStrICompSSE;
    FastcodeStrLen := FastcodeStrLenSSE;
    FastcodeStrToInt32 := FastcodeStrToInt32SSE;
    FastcodeUpperCase := FastcodeUpperCaseSSE;
    {$ENDIF}
  {$ENDIF}
{$ENDIF}

{$IFDEF FastcodeSSE2}
  {$IFNDEF Delphi2007Plus}
  FastcodeAnsiStringReplace := FastcodeAnsiStringReplaceSSE2;
  FastcodeCompareMem := FastcodeCompareMemSSE2;
  FastcodeCompareStr := FastcodeCompareStrSSE2;
  {$ENDIF}
  {$IFNDEF Delphi2005Plus}
  FastcodeCompareText := FastcodeCompareTextSSE2;
  FastcodeFillChar := FastcodeFillCharSSE2;
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeLowerCase := FastcodeLowerCaseSSE2;
  FastcodePos := FastcodePosSSE2;
  {$ENDIF}
  {$IFDEF Delphi7Plus}
  FastcodePosEx := FastcodePosExSSE2;
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeStrComp := FastcodeStrCompSSE2;
  FastcodeStrCopy := FastcodeStrCopySSE2;
  FastcodeStrIComp := FastcodeStrICompSSE2;
  FastcodeStrLen := FastcodeStrLenSSE2;
  FastcodeStrToInt32 := FastcodeStrToInt32SSE2;
  FastcodeUpperCase := FastcodeUpperCaseSSE2;
  {$ENDIF}
{$ENDIF}

{$IFDEF FastcodePascal}
  {$IFDEF FastcodeSizePenalty}
    {$IFNDEF Delphi2007Plus}
    FastcodeAnsiStringReplace := FastCodeAnsiStringReplacePascalSizePenalty;
    FastcodeCompareMem := FastcodeCompareMemPascalSizePenalty;
    FastcodeCompareStr := FastcodeCompareStrPascalSizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeCompareText := FastcodeCompareTextPascalSizePenalty;
    FastcodeFillChar := FastcodeFillCharPascalSizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeLowerCase := FastcodeLowerCasePascalSizePenalty;
    FastcodePos := FastcodePosPascalSizePenalty;
    {$ENDIF}
    {$IFDEF Delphi7Plus}
    FastcodePosEx := FastcodePosExPascalSizePenalty;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeStrComp := FastcodeStrCompPascalSizePenalty;
    FastcodeStrCopy := FastcodeStrCopyPascalSizePenalty;
    FastcodeStrIComp := FastcodeStrICompPascalSizePenalty;
    FastcodeStrLen := FastcodeStrLenPascalSizePenalty;
    FastcodeStrToInt32 := FastcodeStrToInt32PascalSizePenalty;
    FastcodeUpperCase := FastcodeUpperCasePascalSizePenalty;
    {$ENDIF}
  {$ELSE}
    {$IFNDEF Delphi2007Plus}
    FastcodeAnsiStringReplace := FastcodeAnsiStringReplacePascal;
    FastcodeCompareMem := FastcodeCompareMemPascal;
    FastcodeCompareStr := FastcodeCompareStrPascal;
    {$ENDIF}
    {$IFNDEF Delphi2005Plus}
    FastcodeCompareText := FastcodeCompareTextPascal;
    FastcodeFillChar := FastcodeFillCharPascal;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeLowerCase := FastcodeLowerCasePascal;
    FastcodePos := FastcodePosPascal;
    {$ENDIF}
    {$IFDEF Delphi7Plus}
    FastcodePosEx := FastcodePosExPascal;
    {$ENDIF}
    {$IFNDEF Delphi2007Plus}
    FastcodeStrComp := FastcodeStrCompPascal;
    FastcodeStrCopy := FastcodeStrCopyPascal;
    FastcodeStrIComp := FastcodeStrICompPascal;
    FastcodeStrLen := FastcodeStrLenPascal;
    FastcodeStrToInt32 := FastcodeStrToInt32Pascal;
    FastcodeUpperCase := FastcodeUpperCasePascal;
    {$ENDIF}
  {$ENDIF}
{$ENDIF}

{$IFNDEF FastcodeNoRtlPatch}
  {$IFNDEF Delphi2007Plus}
  FastcodeAddressPatch(FastcodeGetAddress(@AnsiStringReplaceStub), @FastcodeAnsiStringReplace);
  FastcodeAddressPatch(FastcodeGetAddress(@CompareMemStub), @FastcodeCompareMem);
  FastcodeAddressPatch(FastcodeGetAddress(@CompareStrStub), @FastcodeCompareStr);
  {$ENDIF}
  {$IFNDEF Delphi2005Plus}
  FastcodeAddressPatch(FastcodeGetAddress(@CompareTextStub), @FastcodeCompareText);
  FastcodeAddressPatch(FastcodeGetAddress(@FillCharStub), @FastcodeFillChar);
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeAddressPatch(FastcodeGetAddress(@LowerCaseStub), @FastcodeLowerCase);
  FastcodeAddressPatch(FastcodeGetAddress(@PosStub), @FastcodePos);
  {$ENDIF}
  {$IFDEF Delphi7Plus}
  FastcodeAddressPatch(FastcodeGetAddress(@PosExStub), @FastcodePosEx);
  {$ENDIF}
  {$IFNDEF Delphi2007Plus}
  FastcodeAddressPatch(FastcodeGetAddress(@StrCompStub), @FastcodeStrComp);
  FastcodeAddressPatch(FastcodeGetAddress(@StrCopyStub), @FastcodeStrCopy);
  FastcodeAddressPatch(FastcodeGetAddress(@StrICompStub), @FastcodeStrIComp);
  FastcodeAddressPatch(FastcodeGetAddress(@StrLenStub), @FastcodeStrLen);
  FastcodeAddressPatch(FastcodeGetAddress(@StrToInt32Stub), @FastcodeStrToInt32);
  FastcodeAddressPatch(FastcodeGetAddress(@UpperCaseStub), @FastcodeUpperCase);
  {$ENDIF}
{$ENDIF}
end.
