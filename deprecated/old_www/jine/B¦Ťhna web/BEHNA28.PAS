program forcisla; (* vypsani cisla od 1 do N*)
var i,a,s:real;
begin
writeln('Zadej koncove cislo:');
readln(a);
i:=0;
repeat
 i:=i+1;
 s:=s+i;
(* write(s:0:0,', ');*)
 writeln(i:0:0,'+',s-i:0:0,'=',s:0:0);
until(a=i);
writeln('Soucet je: ',s:0:0);
readln;
end.