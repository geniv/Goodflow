program rodne; (*zjisti cosi kdesi*)
var r,m,d,rok,mesic,vek:integer;
begin
writeln ('rok'); readln (r);
writeln ('mesic'); readln (m);
writeln ('den'); readln (d);
case m of
1..12: writeln ('osoba je muz');
51..56: writeln ('osoba je zena')
else writeln ('muzatka');
end;
rok:=1900+r;
if m > 50 then mesic :=m-50
              else mesic :=m;
writeln (d,'.',mesic,'.',rok);
vek:=2006-rok;
writeln('vek je ', vek);
if vek > 18 then writeln ('plnolety')
   else writeln ('neni plnolety');
readln;
end.


