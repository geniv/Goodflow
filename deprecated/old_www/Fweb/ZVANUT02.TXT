program soucet; (* soucet dvou cisel *)
uses crt;
var a,b,c:integer;
begin
clrscr;
textcolor(2);
writeln('Zadej dve cisla!');
readln(a,b);
c:=a+b;
textcolor(4);
writeln('Soucet je: ',c);
readln;
end.