program delitele;
var i,a,n:integer;
begin
writeln('zadej cislo');
readln(n);
if n<>0 then
 begin
  for i:=1 to n do
   begin
    {a:=a div 2;
    write(a:4);  }
    if (n mod i)=0 then write(i:4);
   end;
 end;
readln;
end.