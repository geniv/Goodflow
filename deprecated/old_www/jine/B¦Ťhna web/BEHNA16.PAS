program seraz; (* serazeni dvou cisel*)
var a,b:integer;
begin
writeln('Zadej dve ruzne cisla');
readln(a,b);
if a<b then
 writeln(a,', ',b)
else
 writeln(b,', ',a);
readln;
end.