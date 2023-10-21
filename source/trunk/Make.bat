@echo off
CLS

REM The ERRORLEVEL for 'file not found' is 9009
REM The ERRORLEVEL for 'ERROR_PATH_NOT_FOUND' is 3

ECHO Compiling QuArK.exe without debug information
ECHO ---------------------------------------------
ECHO.
REM Check if compiler is available
DCC32.EXE --version > NUL 2> NUL
REM The ERRORLEVEL for 'file not found' is 9009
IF ERRORLEVEL 9009 GOTO NoDCC32
IF ERRORLEVEL 3 GOTO NoDCC32
REM B = recompile ALL units, H = show hints, W = show warnings, Q = don't list all the unit file names
REM $D- = no debug info, $L- = no local debug symbols, $O+ = optimization
DCC32.EXE QuArK.dpr -B -H -W -Q -$D- -$L- -$O+
REM If the Delphi compiler didn't exit with an error level of 0, exit the batch file.
IF NOT ERRORLEVEL 0 GOTO CompileFailed

ECHO.
ECHO.
ECHO Embedding manifest
ECHO ------------------
ECHO.
REM Check whether MT is available, but don't display the output.
"%ProgramFiles(x86)%\Windows Kits\10\bin\10.0.22000.0\x86\mt.exe" > NUL 2> NUL
IF ERRORLEVEL 9009 GOTO NoMT
IF ERRORLEVEL 3 GOTO NoMT
"%ProgramFiles(x86)%\Windows Kits\10\bin\10.0.22000.0\x86\mt.exe" -nologo -validate_manifest -canonicalize -check_for_duplicates -manifest "QuArK.manifest" -outputresource:..\runtime\QuArK.exe
IF NOT ERRORLEVEL 0 GOTO ManifestFailed

ECHO.
ECHO.
ECHO Applying UPX compression
ECHO ------------------------
ECHO.
REM Make Windows look for UPX in the PATH system variable, but don't display the output.
UPX.EXE > NUL 2> NUL
IF ERRORLEVEL 9009 GOTO NoUPX
IF ERRORLEVEL 3 GOTO NoUPX
UPX.EXE --best --ultra-brute --no-lzma --overlay=strip ..\runtime\QuArK.exe
IF NOT ERRORLEVEL 0 GOTO CompressionFailed
GOTO Finished

:NoDCC32
ECHO DCC32.EXE was not found!
ECHO Make sure the Delphi compiler is in the PATH variable!
GOTO Finished

:CompileFailed
ECHO The compile failed!
GOTO Finished

:NoMT
ECHO MT.EXE was not found!
ECHO Install the Windows SDK, and update the path in Make.bat
GOTO Finished

:ManifestFailed
ECHO The embedding of the manifest failed!
GOTO Finished

:NoUPX
ECHO UPX.EXE is not in your PATH variable!
ECHO If you don't have a copy check out:
ECHO https://upx.github.io/
GOTO Finished

:CompressionFailed
ECHO The UPX compression failed!
GOTO Finished

:Finished
ECHO.
PAUSE
