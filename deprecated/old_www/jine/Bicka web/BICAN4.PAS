(*vypocet obvodu a obsahu odelnika*)
program obdelnk;
var a,b,o,s: integer;
begin
write('zadej obdeln¡k');
readln(a,b);
s:=a*b;
o:=2*(a+b);
write ('obvod je',o);
write ('obsah je',s);
readln;
end.