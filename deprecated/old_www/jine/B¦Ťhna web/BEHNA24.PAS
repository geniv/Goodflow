program BMItest;
var v,h,bmi:real;
begin
writeln('Zadej svoji vysku (v m) a hmotnost (v kg)');

readln(v,h);
bmi:=h/sqr(v);
writeln('Tvoje BMI je:',bmi:0:0);
write('Hodnoceni: ');
case Round(bmi)of
0..19:writeln('Podvaha');
20..25:writeln('Normal');
26..100:writeln('Nadvaha');
end;
readln;
end.