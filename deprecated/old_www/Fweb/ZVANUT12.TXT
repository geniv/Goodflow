program maximum; (* porovnani cisel *)
var a,b,c:integer;
begin
writeln('Zadej cisla pro srovnani');
readln(a,b);

if a<>b then
begin
  if a>b then
   writeln('prvni cislo je vetsi')
  else
   writeln('druhe cislo je vetsi');
  end
else
  writeln('cisla se rovnaji!!');

readln;
end.