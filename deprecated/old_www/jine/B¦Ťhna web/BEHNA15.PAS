program cifra; (* zjisteni poctu cifer *)
var cs,del:integer;
    kl:string;
begin
writeln('Zadej nekolika ciferne cislo, nasledne vam bude zdelen pocet cifer.');
readln(cs);
if cs<0 then
 kl:='zaporne'
else
 kl:='kladne';

case abs(cs) of
0..9:del:=1;
10..99:del:=2;
100..999:del:=3;
1000..9999:del:=4;
end;
writeln('Cislo: ',cs,' ma pocet cifer: ',del,', a je: ',kl);
readln;
end.