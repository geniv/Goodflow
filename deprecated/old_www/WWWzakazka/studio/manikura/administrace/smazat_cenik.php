<?
if(!Empty($hl_jmeno) and !Empty($hl_heslo) and (LoginAdmin($hl_jmeno,$hl_heslo)=="true0" or LoginAdmin($hl_jmeno,$hl_heslo)=="true1"))
{
$soub="cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php";
$u=fopen($soub,"r");
$cen=explode("--CEN--",fread($u,DelkaOtevirani(".")));
fclose($u);

$del=DelkaCeniku(".");

print 
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td align=\"center\" height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input_nadpis\" height=\"20px\">Smazat položku ceníku</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td align=\"center\" height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
<tr>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td width=\"1%\">&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\" width=\"1%\">&nbsp#&nbsp</td>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"73%\">&nbsp;Text&nbsp;položky&nbsp;ceníku&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\">&nbsp;Cena&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\" height=\"20px\">&nbsp;Pøíkaz&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
</tr>";

if(count($cen)!=1)
{
for($i=1;$i<((count($cen)-1)/$del)+1;$i++)
{
print
"<tr>
<td height=\"6px\"></td>
</tr>
<tr>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\" height=\"20px\" width=\"1%\">&nbsp;$i&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"73%\">&nbsp;{$cen[($i*$del)-1]}&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\">&nbsp;{$cen[($i*$del)]},-&nbsp;Kè&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\" height=\"20px\">&nbsp;<a href=\"index_go.php?kam=smazat_cenik&akce=smaz&cislo=$i\" class=\"odkaz\">Smazat</a>&nbsp;</td>
<td width=\"1%\">&nbsp;</td>
</tr>";
}//end for
print 
"</table>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td width=\"1%\">&nbsp;</td>
</tr>
<tr>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td align=\"center\" height=\"6px\"></td>
</tr>
</table>";
}
else
{
print
"<tr>
<td class=\"input\" colspan=\"9\" align=\"center\" height=\"20px\">Žádné ceníky</td>
</tr>
</table>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
</tr>
<tr>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>";
}

if(!Empty($akce) and $akce=="smaz" and !Empty($cislo) and Empty($maz))
{
echo
"<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td colspan=\"5\" align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Opravdu chceš smazat tuto položku ceníku ?</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan=\"5\" height=\"6px\"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\" height=\"20px\">&nbsp;$cislo&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\" height=\"20px\">&nbsp;{$cen[($cislo*$del)-1]}&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan=\"6\" height=\"6px\"></td>
</tr>
<tr>
<td colspan=\"6\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td height=\"8px\"></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\"><input type=\"submit\" name=\"maz\" value=\"Ano\"></td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\"><input type=\"submit\" name=\"maz\" value=\"Ne\"></td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td height=\"8px\"></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\"height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan=\"5\" height=\"6px\"></td>
</tr>
</table>
<input type=\"hidden\" value=\"$cislo\" name=\"cislo\">
</form>";
}

if(!Empty($maz) and $maz=="Ano" and !Empty($cislo))
{print SmazatCenik($cislo);}

}
else
{print "neoprávnìný pøístup!";}
?>
