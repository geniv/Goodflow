program prevod; (* posun o urcitou hodnotu *)
var vst,vyst:char;
    okol,cs:integer;
begin
writeln('Zadej vstupni znak: ');
readln(vst);
writeln('Zadej o kolik cisel se ma znak posunout: ');
readln(okol);
cs:=ord(vst);        {prevod na cislo}
vyst:=chr(cs+okol);  {pricteni posunu + prevod na znak}
writeln('Zpracovany znak je: ',vyst);
readln;
end.