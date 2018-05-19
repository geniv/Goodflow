program prvocisla;
var n,i,p:integer;
begin
writeln('Zadej cislo');
readln(n);
for i:=1 to n do
 begin
  if(n mod i)=0 then inc(p);
 end;
  if p=2 then
   writeln('je to prvocislo')
    else
   writeln('neni to prvocislo');
readln;
end.