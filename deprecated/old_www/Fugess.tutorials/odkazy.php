<?
$delkasoub=delka_souboru("administrace");
$soub="odka_zy_qpwojiusbisubviusdbiuufasaiasnisjjcnisjdnbvisibsdvisdbdviuusdbdvisuubvs.php";
$u=fopen($soub,"r");
$odk=explode("--DA--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_odkazu(".");

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
<tr>
<td align=\"center\" class=\"genmed\"><strong>Odkazy na stránky o Trainz a Železnici</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
for($i=1;$i<((count($odk)-1)/$del)+1;$i++)
{
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong><a href=\"{$odk[($i*$del)]}\" target=\"_blank\" class=\"genmed\">{$odk[($i*$del)-1]}</a></strong></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table>";
}//end for
print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
?>
