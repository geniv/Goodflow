<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
DostaveniDelkyOtvirani(false);

print
"<h3>P�idat Odkaz</h3>
<form method=\"post\">
Popis odkazu: <input type=\"text\" name=\"popis\"><br>
Link odkazu: <input type=\"text\" name= \"odkaz\"><br>";
if(Empty($popis) and Empty($odkaz))
{
print
"<input type=\"submit\" value=\"P�idat\">
</form>";
}
else
{print PridatOdkaz(stripslashes($popis),stripslashes($odkaz));}

}
else
{print "Nepovolen� p��stup";}
?>
