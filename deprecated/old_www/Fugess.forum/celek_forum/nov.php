<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis) and !Empty($pris))
{
smazani_novoty($cis,$pris);
print "p��sp�vek ji� nen� nov�";
}
else
{print "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";}
?>
