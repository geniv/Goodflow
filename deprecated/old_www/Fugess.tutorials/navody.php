<?
$delkasoub=delka_souboru("administrace");
$soub="navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$odk=explode("--OD--",fread($u,$delkasoub));
fclose($u);

if(Empty($str)){$str=1;}

$del=delka_pole_navodu(".");
$zobstr=pocet_polozek_navod(".");
$pocstr=ceil(((count($odk)-1)/$del)/$zobstr);

$zobrmin=(((count($odk)-1)/$del)+1)-($zobstr*$str);
$zobrmax=($zobrmin+$zobstr)-1;

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
<tr>
<td align=\"center\" class=\"genmed\"><strong>Návody - Sbírka všech CZ a SK návodù na Gmax / 3D Studio Max</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
<tr>
<td align=\"right\" class=\"genmed\"><strong>".jdi_na_stranku($str,$pocstr,"navody")."</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
for($i=((count($odk)-1)/$del);$i>0;$i--)
{
if(($i>=$zobrmin and $i<=$zobrmax))
{
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"2\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" height=\"0%\"><img src=\"{$odk[($i*$del)-7]}\"></td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td valign=\"top\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\" align=\"center\" width=\"300\">
<tr>
<td width=\"1px\">&nbsp;</td>
<td width=\"1%\" valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Název:</u></strong></td>
<td width=\"1px\">&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong>{$odk[($i*$del)-5]}</strong></td>
<td width=\"1px\">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Popis:</u></strong></td>
<td>&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong>{$odk[($i*$del)-3]}</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Pro:</u></strong></td>
<td>&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong>{$odk[($i*$del)-4]}</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Typ:</u></strong></td>
<td>&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong>{$odk[($i*$del)-1]}</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Autor:</u></strong></td>
<td>&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong>{$odk[($i*$del)-2]}</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Pøidáno:</u></strong></td>
<td>&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong>{$odk[($i*$del)]}</strong></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td valign=\"top\" align=\"right\" class=\"genmed\"><strong><u>Odkaz:</u></strong></td>
<td>&nbsp;</td>
<td align=\"left\" class=\"genmed\"><strong><a href=\"{$odk[($i*$del)-6]}\" target=\"_blank\" class=\"genmed\"><img src=\"images/odkaz_tlacitko.gif\" border=\"0\"></a></strong></td>
<td>&nbsp;</td>
</tr>
</table>
</td>
<td class=\"genmed\" align=\"center\" width=\"100%\"><strong></strong></td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"2\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table>";
}
}//end for
print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
<tr>
<td align=\"left\" class=\"genmed\"><strong>Strana: $str z $pocstr</strong></td>
<td align=\"right\" class=\"genmed\"><strong>".jdi_na_stranku($str,$pocstr,"navody")."</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
?>
