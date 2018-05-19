smazat_objednavku
<?
if(!Empty($hl_jmeno) and !Empty($hl_heslo) and (LoginAdmin($hl_jmeno,$hl_heslo)=="true0" or LoginAdmin($hl_jmeno,$hl_heslo)=="true1"))
{




}
else
{print "neoprávnìný pøístup!";}
?>
