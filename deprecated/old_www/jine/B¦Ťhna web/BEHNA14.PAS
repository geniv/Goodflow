program porovn; (* rozhodnuti kladnosti zapotrnosti nebo nula *)
var cis:integer;
begin
writeln('Zadej nejake cele cislo:');
readln(cis);
if cis=0 then
 begin
  writeln('Cislo: ',cis,' je nula.');
 end
else (* else cis = *)
 begin
  if cis>0 then
   begin
    writeln('Cislo: ',cis,' je kladne.');
   end
    else (* else cis > *)
   begin
    writeln('Cislo: ',cis,' je zaporne.');
   end; (* end cis > *)
 end;  (* end cis = *)
readln;
end.