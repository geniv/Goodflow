program kockopes; (*obedovy hlasic*)
var v :integer;
begin
     writeln ('kolik je hodin'); readln (v);
     case v of 0..12: writeln ('dobry rano');
     12..15: writeln ('dobry odpoledne');
     15 ..24: writeln ('dobry vecer');
     end;
     readln;
     end.