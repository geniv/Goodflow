program forcisla; (* vypsani cisla od 1 do N*)
var i,a:real;
    p:integer;
begin
writeln('Zadej pocet cisel:');
readln(a);
i:=0;
repeat
 i:=i+2;
 inc(p);
 write(i-1:0:0,', ');
until(a=p);
readln;
end.