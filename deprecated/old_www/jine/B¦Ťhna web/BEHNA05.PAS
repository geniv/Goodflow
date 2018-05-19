program vyposkruh; (* vypocer o a s kruhu *)
uses crt;
var r:integer;
    o,s:real;
begin
clrscr;
writeln('Zadej polomer kruhu: ');
readln(r);
o:=2*pi*r;
s:=pi*sqr(r);
writeln('Obvod kruhu je: ',o:10:2,'cm');
writeln('Obsah kruhu je: ',s:10:2,'cm');
readln;
end.