<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis))
{
print zamknout_topik($cis,$pris,$jak);
}
else
{print "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";}
?>
