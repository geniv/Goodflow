(*proram pascalozrout*)
program pascalozrout ;
var n,i: integer;
begin

writeln ('zadej cislo'); readln (n);
i:=0;

repeat
      i:=i+1;
      writeln (i*n , ' ')


until
     i=n;

readln;
end.

