program rozhod; (* rozhodne jaky pismeno se dostali do promene *)
var zn:char;
begin
writeln('Zadej nejaky znak');
readln(zn);

case zn of
'A'..'Z':writeln('Velke pismeno, ',zn);
'a'..'z':writeln('Male pismeno, ',zn);
'0'..'9':writeln('Cislice, ',zn);
else
writeln('Jiny znak')
end;
readln;
end.