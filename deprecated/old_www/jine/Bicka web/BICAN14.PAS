program nismenka; (*znakodej*)
var v: char;
begin
writeln ('znak');
readln (v);
       if (v>='A') and (v<='Z') then writeln ('velke pismeno')
       else if (v>='a') and (v<='z') then writeln ('male pismeno')
       else if (v>='0') and (v<='9') then writeln ('cislo')
       else writeln ('ostatni');
readln;
end.


