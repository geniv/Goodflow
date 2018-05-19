program prevod; (* prevede m na cm,mm,dm *)
var a,b,c,d,e:real;
begin
writeln('Zadej delku v "m"');
readln(a);
b:=a*1000;
c:=a*100;
d:=a*10;
e:=a/1000;
writeln(b:10:2,'mm');
writeln(c:10:2,'cm');
writeln(d:10:2,'dm');
writeln(e:10:4,'km');
readln;
end.