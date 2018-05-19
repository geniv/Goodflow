program hell2; (*program prevadec*)
var m, mm, km, dm,cm : real;

    begin
    writeln ('cislo v metrech:');
    read(m);
    cm:=m*100;
    dm:=m*10;
    km:=m/1000;
    mm:=m*1000;
    writeln('vysledky :',mm:4:1,'mm,',km:4:4,'km,',dm:4:1,'dm');
    read (m);



    end.

