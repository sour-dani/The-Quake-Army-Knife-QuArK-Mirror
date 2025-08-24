Andys make_install files
======================================================================================

If you put a "Readme.txt" and/or "Patch.txt" in the same directory as this batch file, then they will be included in the main zip file. FIXME: Use a separate SUBDIR for this?!
if you use NOVERSION as the version then it will the files produced will be called "QuArK.zip", & "QuArK-Help.zip", if you specify a version then the files produced will be called "(version).zip" and "(version)-Help.zip". this batch file must be placed in the same directory as the "Source", "Runtime", "Infobase", and "Utils" directories.

Important: At the top of make_install.py, update the paths, especially "pathRoot".

This script uses Python 3, which may introduce difficulties using older Delphi versions. However, one can deploy only the compiler instead of the entire Delphi IDE by copying the "DCC32.EXE" over from a Delphi install.
For Delphi 7.1, these files are needed: DCC32.EXE, rlink32.dll, delphimm.dll, and the Delphi RTL files. (/Lib and /Source)
BUG in compiler (7.1): "RLINK32: Unsupported 16bit resource in file <DFM filename>". You need: lnkdfm70.dll as well!!!

You needs to compile addmaker first! Simply open up .dpr, and compile.
And SFX too! --> Update its File Size; see its readme!


Usage:

   python make_install.py dir version [option1] [option2] .....
   
   where:
     dir      = directory to store the final files in
                (should be fully qualified ie "c:\quark\install")
     version  = verify version of QuArK to build (example: "6.6 Beta 8")
   
   options:
     DEBUG         = make debug exe [optional]
     SNAPSHOT=DATE = create a snapshot archive [optional]
     NOCOMPILE     = doesn't compile a new .exe [optional]
     NOCOMPRESSEXE = doesn't compress .exe with "upx" [optional]
     NOMANIFEST    = doesn't embed manifest in .exe [optional]
     NORUNTIME     = doesn't copy runtime files [optional]
     NOD3D         = doesn't add QuArK D3D files [optional]
     NOHELP        = doesn't create help files [optional]
     NOHELPZIP     = doesn't create help files ZIP archive [optional]
     NOSFX         = doesn't create SFX extractor [optional]
     NONSIS        = doesn't create NSIS installer [optional]

======================================================================================

(c) 2001 Andy Vincent.
    2025 Ported to Python by DanielPharos, and added NSIS integration.
