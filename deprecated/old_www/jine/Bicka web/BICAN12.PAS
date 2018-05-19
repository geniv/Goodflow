(*aski*)
program eskimak;
var a,b:char;
posun:integer;
begin
writeln ('zadej znak');
readln (a);
writeln ('zadej posun');
readln (posun);



a:=chr (ord(a)+posun);
writeln ('vysledny znak');
readln (posun);
readln;



end.