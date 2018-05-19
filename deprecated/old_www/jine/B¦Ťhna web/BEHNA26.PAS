program geomtv; (* geometricke tvary tr,ct,ob,k r*)
var vyb:integer;

procedure ctverec;
var o,s,a:real;
begin
writeln('Zadej delku strany');
readln(a);
o:=4*a;
s:=a*a;
writeln('Obvod je: ',o:0:0,'cm, obsah je: ',s:0:0,'cm2');
readln;
end;

procedure obdelnik;
begin


end;

procedure kruh;
begin


end;

procedure trouhelnik;
begin


end;

begin
 writeln('Co chcete spocitat?');
 writeln('1: Ctverec');
 writeln('2: Obdelnik');
 writeln('3: Kruh');
 writeln('4: Trouhelnik');
 readln(vyb);

case vyb of
 1:ctverec;
 2:obdelnik;
 3:kruh;
 4:trouhelnik;
 else
 begin
  writeln('Co chcete spocitat?');
  writeln('1: Ctverec');
  writeln('2: Obdelnik');
  writeln('3: Kruh');
  writeln('4: Trouhelnik');
  readln(vyb);
 end;
end;

end.