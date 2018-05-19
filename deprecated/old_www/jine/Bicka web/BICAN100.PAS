program kreten; (*tento program je o krete*)
var a,b,c,d,e,f,g,h,ch,i,j,k,l,m,n:
real;
begin
writeln ('zadej mnozstvi penez na uctu v kc'); readln (a);
writeln ('zadej kurs eura ku korune'); readln (b);
c:=a/b;
d:=c/100*10;
e:=c-d;
f:=a/100*10;
g:=a-f;
writeln('po odecteni 10 procent mate v eurech a v korunach na ucte');
writeln('eura');writeln (e:2:5);
writeln('koruny');writeln(g:2:5);
h:=240/1;
ch:=11500/c;
i:=21300/c;
j:=2050/1;

k:=c/h;
l:=c/ch;
m:=c/i;
n:=c/j;
if k>1 then writeln ('mas na zajezd do chorvatska')else writeln ('nemas zajezd do chorvatska');

if l>1 then writeln ('mas na zajezd na kretu')else writeln ('nemas zajezd na kretu');
if m>1 then writeln ('mas na zajezd do Norska')else writeln ('nemas zajezd do norska');

if n>1 then writeln ('mas na zajezd na maledivi')else writeln ('nemas na zajezd na maledivi');


readln;
end.
