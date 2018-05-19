program tralalak; (*geo tvar*)
var volba,a,b,r:integer ;
                o,s:real;

begin
     writeln ('vyber 1. ctverec, 2. obdelnik, 3. kruh');
     writeln ('vyber si');
redln (volba);
if volba=1 then begin
     writeln ('zadej stranu a'); readln (a);
o:=4*a;
s:=a*a;
     writeln ('obvod je'); readln (o);
     writeln ('obsah je'); readln (s);
 end;

if volba=2 then begin
     writeln ('zadej stranu a'); readln (a);
     writeln ('zadej stranu b'); readln (b);
o:=2*a+2*b;
s:=a*b;
     writeln ('obvod je'); readln (o);
     writeln ('obsah je'); readln (s);
 end;

 if volba=3 then begin
        writeln ('zadej polomer r'); readln (r);
o:=2*3.14*r ;
s:=2*3.14*r*r;
     writeln ('obvod je'); readln (o);
     writeln ('obsah je'); readln (s);
 end;