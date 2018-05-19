program znaky; (* prevod znaku *)
var z1,z2,z3:char;
    cs:byte;
begin
writeln('Zadej cislo znaku');
readln(cs);
z1:=chr(pred(cs));
z2:=chr(cs);
z3:=chr(succ(cs));
writeln(z1);
writeln(z2);
writeln(z3);
readln;
end.