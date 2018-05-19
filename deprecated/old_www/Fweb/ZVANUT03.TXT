program obvaobs; (* Vypocet obvodu a obsahu *)
uses crt;
var a,b,c:integer;
begin
clrscr;
writeln('Zadej delku strany (v cm)');
readln(a);
b:=4*a;
c:=sqr(a);
writeln('Obvod je: ',b,'cm');
writeln('Obsah je: ',c,'cm2');
readln;
end.