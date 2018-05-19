program lala; (*kalkulacka*)

var a,b,c : real;
    op:char;

begin
     writeln ('zadej 1 cislo'); readln (a);
     writeln ('zadej operant'); readln (op);
     writeln ('zadej 2 cislo'); readln (b);
     if op='+' then c:=a+b;
     if op='-' then c:=a-b;
     if op='/' then if b=0 then  else  c:=a/b;
     if op='*' then c:=a*b;

     writeln ('vysledek je:');
     writeln (a:5:0,op,b:5:0,'=',c:5:0);
     readln;
     end.