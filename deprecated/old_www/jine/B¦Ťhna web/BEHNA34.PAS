program cisla; (* cisla 1..N*)
var n,i:integer;
begin
writeln('pocet opakovani:');
readln(n);
 for i:=1 to n do
  begin
   writeln(i);
  end;

  i:=0;
 repeat
  inc(i);
  writeln(i);
 until n=i;

readln;
end.