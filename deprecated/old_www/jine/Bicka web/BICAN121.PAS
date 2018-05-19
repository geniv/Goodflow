(*proram na lis ka*)
program lisak;
var n,i,s: integer;
begin

writeln ('zadej cislo'); readln (n);
i:=0;
s:=1;
repeat
      i:=i+1;
      writeln (s);
      s:=s+2

until
     i=n;

readln;
end.

