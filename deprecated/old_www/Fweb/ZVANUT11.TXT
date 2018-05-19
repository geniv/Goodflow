program deleni; (* deleni dvou cisel *)
var a,b,c,d:integer;
begin
writeln('Zadej cisla pro deleni:');
readln(a,b);
c:=a div b;
d:=a mod b;
writeln('Vysledek celociselneho deleni je: ',c,' a nejaky zbytek: ',d);
readln;
end.