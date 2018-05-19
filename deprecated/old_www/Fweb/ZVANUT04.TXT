program vypoaos; (* vypocet obsahu a obvodu obdelniku *)
uses crt;
var o,s,a,b:integer;
begin
clrscr;
repeat
writeln('Zadej delky stran A a B:');
readln(a,b);
clrscr;
if a=b then writeln('Tohle neni obdelnik ale ctverec !!! Zadej hodnotu znovu!');
until a<>b;
o:=2*(a+b);
s:=a*b;
writeln('Obvod obdelniku je: ',o,' cm');
writeln('Obsah obdelniku je: ',s,' cm');
readln;
end.