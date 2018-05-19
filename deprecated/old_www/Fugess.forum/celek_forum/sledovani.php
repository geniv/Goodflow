<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis))
{
if(!Empty($prik) and $prik=="del")
{print zrusit_sledovani_prispevku($kdo,$cis,$pris,$str);}
else
{print nastavit_sledovani($Jmeno_r,$cis,$pris,$str);}
}
else
{print "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";}
?>
