program denidoba; (* zjisteni denni doby *)
const
 d1='Dobre rano';
 d2='Dobre dopoledne';
 d3='Dobre poledne';
 d4='Dobre odpoledne';
 d5='Dobry vecer';
 d6='Dobrou pulnoc';
var hod:integer;
    poz:string;
begin
writeln('Zadej hodinu:');
readln(hod);
case hod of
0,24:poz:=d6;
1..3:poz:=d5;
4..8:poz:=d1;
9..11:poz:=d2;
12:poz:=d3;
13..18:poz:=d4;
19..23:poz:=d5;
else
poz:='neznas 24 hodinove zadavani casu??';
end;
writeln(poz);
readln;
end.