<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis) and !Empty($pris))
{
smazani_novoty($cis,$pris);
print "pøíspìvek již není nový <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$pris&str=1\" class=\"genmed\"><b>zde</b></a>";
}
else
{print "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";}
?>
