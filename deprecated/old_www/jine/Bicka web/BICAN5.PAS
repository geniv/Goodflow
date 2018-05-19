(*vypocet obvodu a obsahu kruh*)
program kruh;
var a,o,s: real;
begin
write('zadej polomer');
readln(a);
s:=3,14* sqr(a);
o:=2*3,14*a;
write ('obvod je',o);
write ('obsah je',s);
readln;
end.