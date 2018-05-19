(***)
program q;
var i,n,p:integer;
begin
     writeln ('cislo');  readln (n);
     p:=0;
     for i:=1 to n do
begin
     if (n mod i)=0 then p:=p+1
end;
    if p=2 then writeln ('je')
    else writeln ('neni')
   
end.