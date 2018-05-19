program vyptrou; (* vypocet stran, obsahu, obvodu trouhelniku *)
var a,b,c,o,s:real;
begin
writeln('Zadej sranu A a B: (v cm)');
readln(a,b);
c:=sqrt(sqr(a)+sqr(b));
o:=a+b+c;
s:=0.5*a*b;
writeln('Strana C je: ',c:6:2,'cm');
writeln('Obvod trouhelniku je: ',o:6:2,'cm');
writeln('Obsah trouhelniku je: ',s:6:2,'cm');
readln;
end.