<?
print
"<form mathod=\"get\">
Výpoèet kvadratcké rovnice:<br>
a:<input type=\"text\" name=\"a\"><br>
b:<input type=\"text\" name=\"b\"><br>
c:<input type=\"text\" name=\"c\"><br>
<input type=\"submit\" value=\"spoèítaj\">
</form>";

if(!Empty($a) and !Empty($b) and !Empty($c))
{
$d=4*$a*$c;

if($d>0)
{
$X1=(-$b+sqrt($d))/(2*$a);
$X2=(-$b-sqrt($d))/(2*$a);
print "X1: <b>$X1</b><br> X2: <b>$X2</b>";
}
else
{
print "Rovnice nemá øešení v oboru reálných èísel.... jen komplexních";
} //end if else

} //end if empty

?>
