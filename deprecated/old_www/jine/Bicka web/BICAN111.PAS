(*proram na jelimanator*)
program jeliman;
var n,i,s: integer;
begin

writeln ('zadej cislo'); readln (n);
i:=0; s:=0;
repeat
      i:=i+1;
      s:=s+i;


until
      i=n;
writeln('soucet je' ,s);
readln;
end.

