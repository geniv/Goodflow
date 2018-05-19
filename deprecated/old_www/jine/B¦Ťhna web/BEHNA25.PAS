program rodnecislo; (*vyhodnoceni rodneho cisla*)
var dd,mm,rr,rc:string;
    pmm,er,pprr,prr,vmm,vv:integer;
begin
writeln('Zadej rodne cislo');
readln(rc);

rr:=copy(rc,1,2);
mm:=copy(rc,3,2);
dd:=copy(rc,5,2);

val(mm,pmm,er); (* prevedeni ze sringu na integer *)
val(rr,prr,er); (* prevedeni se str na int*)

case pmm of
01..12:writeln('Muz');
51..62:writeln('Zena');
else
writeln('Mutant');
end;

pprr:=1900+prr; (* rok narozeni *)

if pmm>50 then
 vmm:=pmm-50
  else
 vmm:=pmm;

vv:=2006-pprr;

writeln('Darum narozeni je: ',dd,'.',vmm,'. ',pprr);
writeln('Vek je: ',vv);

if vv>=18 then
 writeln('Plnolety')
  else
 writeln('Nezletily');

readln;
end.