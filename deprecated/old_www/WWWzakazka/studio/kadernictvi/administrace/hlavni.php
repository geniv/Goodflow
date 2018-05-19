<?
if(!Empty($hl_jmeno) and !Empty($hl_heslo) and (LoginAdmin($hl_jmeno,$hl_heslo)=="true0" or LoginAdmin($hl_jmeno,$hl_heslo)=="true1"))
{
$soub="udaje_kadernictvi_sdichnboipppjqqfqwoncoisnswdofcvnooiwvoiihwvohnwe.php";
$u=fopen($soub,"r");
$udj=explode("--UDJ--",fread($u,DelkaOtevirani(".")));
fclose($u);

print
"<form method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
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
<td class=\"input_nadpis\" height=\"20px\">Nastavení kontaktních údajù</td>
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
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Jméno:</td>
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
<td class=\"input\"><input type=\"text\" name=\"jmeno\" value=\"{$udj[1]}\" size=\"30\"></td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\"height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
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
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Telefon / Mobil:</td>
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
<td class=\"input\"><input type=\"text\" name=\"mobil\" value=\"{$udj[2]}\" size=\"30\"></td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\"height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan=\"5\" height=\"6px\"></td>
</tr>
<tr>
<td colspan=\"5\" align=\"center\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\"><input type=\"submit\" value=\"Upravit\"></td>
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
</tr>
</table>
</form>";

if(!Empty($jmeno) and !Empty($mobil))
{
$udj[0]="<?php";
$udj[1]=stripslashes($jmeno);
$udj[2]=stripslashes($mobil);

$u=fopen($soub,"w");
fwrite($u,implode($udj,"--UDJ--"));
fclose($u);

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=hlavni\" class=\"odkaz\">Upraveno, pokraèuj klapnutím zde</a></td>
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
</table>";
}

}
else
{print "neoprávnìný pøístup!";}
                                                                              ?>
