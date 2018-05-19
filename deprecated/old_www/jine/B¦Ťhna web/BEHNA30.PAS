program kladne;
var i,a,c:integer;
begin
c:=0;
repeat
 inc(c);
 writeln('Zadej kladne cislo');
 readln(a);
until(a>0);
writeln('No konecne kladne cislo. Dekuji, ',c,'x vam to trvalo.');
readln;
end.