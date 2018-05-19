program kalkulacka;
var o:char;
    x,y,v:real;
begin
writeln('Zadej 2.cisla pro provedeni pocetni operace');
readln(x,y);
writeln('Zadej operator pro pocetni operaci ( +,-,*,/ )');
readln(o);
case o of
'+':v:=x+y;
'-':v:=x-y;
'*':v:=x*y;
'/':
begin
if y<>0 then v:=x/y
else
writeln('Chcete delit nulou, jato nechcu!');
end;
else
writeln('Nejde!');
end;
writeln(x:0:2,o,y:0:2,'=',v:0:2);
readln;
end.