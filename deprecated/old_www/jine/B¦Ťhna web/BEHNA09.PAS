program zvirata; (* pocitani hlav a nohou *)
const
    slepn=2;
    kraln=4;
    hlava=1;
var h,n,s,k:integer;
begin
writeln('Zadejte pocet slepic a kraliku');
readln(s,k);
h:=(s*hlava)+(k*hlava);
n:=(s*slepn)+(k*kraln);
writeln('Celkem hlav: ',h);
writeln('Celkem nohou: ',n);
readln;
end.