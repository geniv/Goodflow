program forcisla; (* vypsani cisla od 1 do N*)
var i,a:real;
begin
writeln('Zadej koncove cislo:');
readln(a);
i:=0;
repeat
 i:=i+1;
 write(i:0:0,', ');
until a=i;
readln;
end.