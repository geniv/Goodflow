<?
if(!Empty($AD_jmeno) and !Empty($AD_heslo) and LoginAdmin($AD_jmeno,$AD_heslo,".")=="true")
{
DostaveniDelkyOtvirani(false);

print
"<form method=\"post\">
���ka muniatury: <input type=\"text\" name=\"vyska\" value=\"".HlavniKonfigurace(".",1)."\"><br>
V��ka miniatury: <input type=\"text\" name=\"sirka\" value=\"".HlavniKonfigurace(".",2)."\"><br>
Po�et ��dku: <input type=\"text\" name=\"radku\" value=\"".HlavniKonfigurace(".",3)."\"><br>
Po�et sloupc�: <input type=\"text\" name=\"sloupcu\" value=\"".HlavniKonfigurace(".",4)."\"><br>";

if(!Empty($vyska) and !Empty($sirka) and !Empty($radku) and !Empty($sloupcu))
{
print UlozitKonfiguraci($vyska,$sirka,$radku,$sloupcu);
}
else
{
print
"<input type=\"submit\" value=\"Upravit\">
</form>";
}


}
else
{
print "Nepovolen� p��stup";
}
?>
