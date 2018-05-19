    program hell ; (*vypocita trojuhelnik*)

    var a,b,c,o,s:real;

    begin

    writeln ('strana "a" :');
    read (a) ;
    writeln ('strana "b": ');
    read (b);
    c:=sqrt(a*a+b*b) ;
    o:=a+b+c;
    s:=0.5*a*b;
    writeln('obsah je:' ,s);
    writeln('obvod je:' ,o);
    writeln('nevim je:' ,c);

    end.