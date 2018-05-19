(*proram pascalozrout*)
program pascalozrout ;
var n,i: integer;
begin

writeln ('zadej cislo'); readln (n);
i:=0;

repeat
      i:=i+1;
      writeln (i*n:4)


until
     i=10;
     i:=0;


repeat
      i:=i+1;
      writeln (i,'*',n,'=',i*n)
until
      i=10;
readln;
end.

