<?
if(!Empty($hl_jmeno) and !Empty($hl_heslo) and (LoginAdmin($hl_jmeno,$hl_heslo)=="true0" or LoginAdmin($hl_jmeno,$hl_heslo)=="true1"))
{
DostaveniDelkyOtvirani(false);

echo
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
<td class=\"input_nadpis\" height=\"20px\">Pøidat aktualitu</td>
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
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Text aktuality:</td>
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
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\"><input type=\"text\" name=\"text\" value=\"<u>".Date("j.n. Y</u> - ")."místo tohoto textu napiš aktualitu\" size=\"90\"></td>
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
<td class=\"input\"><input type=\"submit\" value=\"Pøidat\"></td>
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

if(!Empty($text))
{
print PridatAktualitu($text);
}

}
else
{print "neoprávnìný pøístup!";}
?>
