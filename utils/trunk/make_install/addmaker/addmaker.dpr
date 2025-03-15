program addmaker;

uses
  Classes, SysUtils;

procedure main;
var
  out_file, caption, messag, defaultdir: String;
  flags, message_style, pyver, pyflags: integer;
  local: integer;
  fs: TFilestream;
  tmp: string;
  i: integer;
begin
  i:=1;
  if paramcount=0 then
  begin
    writeln;
    writeln('addmaker (c) 2001 Andy Vincent');
    writeln('------------------------------');
    writeln('valid command line options:');
    writeln('   -caption [caption]');
    writeln('   -message [message]');
    writeln('   -defaultdir [dir]');
    writeln('   -flags [flags]');
    writeln('       Bit 0 (val  1) : if set, user can disable running the command line after extraction (if any)');
    writeln('       Bit 1 (val  2) : if set, user can choose what files to extract');
    writeln('       Bit 2 (val  4) : if set, user cannot change the overwrite-mode (confirm, overwrite, skip)');
    writeln('       Bit3-4(val 8,16) : default-overwrite mode');
    writeln('            0 : confirm overwriting existing files ');
    writeln('            8 : overwrite existing files');
    writeln('            16 : skip existing files');
    writeln('       Bit5 (val  32) : internally used, if set, then do not check file size');
    writeln('       Bit6 (val  64) : if set, then automatically extract all files');
    writeln('       Bit7 (val 128) : if set, don''t show success message ("all files have been extracted")');
    writeln('   -pyver [version]');
    writeln('        ie 151 = 1.5.1');
    writeln('   -pyflags [flags]');
    writeln('        0  = don''t check');
    writeln('        1  = Allow pyver1 = pyver2');
    writeln('        2  = Allow pyver1 > pyver2');
    writeln('        4  = Allow pyver1 < pyver2');
    writeln('   -messagestyle [style]');
    writeln('        1 : messagebox style = MB_ICONINFORMATION ,');
    writeln('            buttons : (ok,cancel ; if cancel is pressed, stop sfx )');
    writeln('        2 : messagebox style = MB_ICONCONFIRMATION ,');
    writeln('            buttons : (yes,no ; if no is pressed, stop sfx )');
    writeln('   -output [filename]');
    exit;
  end;
  while (ParamCount > i) do
  begin
    if paramstr(i)[1]='-' then
    begin
      writeln('param: '+copy(paramstr(i),2,length(paramstr(i))-1)+'='+paramstr(i+1));
      if paramstr(i)='-caption' then
      begin
        caption:=paramstr(i+1);
        inc(i);
      end
      else if paramstr(i)='-message' then
      begin
        messag:=paramstr(i+1);
        inc(i);
      end
      else if paramstr(i)='-defaultdir' then
      begin
        defaultdir:=paramstr(i+1);
        inc(i);
      end
      else if paramstr(i)='-flags' then
      begin
        flags:=strtoint(paramstr(i+1));
        inc(i);
      end
      else if paramstr(i)='-pyver' then
      begin
        pyver:=strtoint(paramstr(i+1));
        inc(i);
      end
      else if paramstr(i)='-pyflags' then
      begin
        pyflags:=strtoint(paramstr(i+1));
        inc(i);
      end
      else if paramstr(i)='-messagestyle' then
      begin
        message_style:=strtoint(paramstr(i+1));
        inc(i);
      end
      else if paramstr(i)='-output' then
      begin
        out_file:=paramstr(i+1);
        inc(i);
      end
    end;
    inc(i);
  end;
  if out_file='' then exit;
  fs:=TFileStream.Create(out_file, fmCreate);
  tmp:='MPV';
  fs.WriteBuffer(tmp[1], length(tmp));
  fs.WriteBuffer(flags,1);
  flags:=0; fs.WriteBuffer(flags,1);
  flags:=1; fs.WriteBuffer(flags,1);
  local:=fs.position;
  flags:=0; fs.WriteBuffer(flags,2);
  flags:=length(caption); fs.WriteBuffer(flags,1);
  if flags>0 then
    fs.writebuffer(caption[1], length(caption));
  flags:=length(defaultdir); fs.WriteBuffer(flags,1);
  if flags>0 then
    fs.writebuffer(defaultdir[1], length(defaultdir));
  flags:=0; fs.WriteBuffer(flags,1);
  flags:=length(messag)+1; fs.WriteBuffer(flags,1);
  if flags-1>0 then
  begin
    fs.WriteBuffer(message_style,1);
    fs.writebuffer(messag[1], length(messag));
  end;
  fs.WriteBuffer(pyver,1);
  fs.WriteBuffer(pyflags,1);
  flags:=fs.position;
  fs.position:=local;
  fs.writebuffer(flags,2);
  fs.free;
end;

begin
  main;
end.
