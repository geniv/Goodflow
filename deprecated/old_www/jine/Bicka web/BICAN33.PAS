(*cislovac 1,2,3*)
program cyklus;
var n,i:integer;
begin

     writeln ('zadej cislo');  readln (n);

for
     i:=1 to n do
begin
     writeln (i);
     i:=0;
repeat
     i:=i+1;
until
     i=n;
     readln (n);
     end;