<?
$delkasoub=delka_souboru("administrace");
$soub="kontakty_qpwjovinrsovnsdonvosidnviosbvoisdfbvisfbvoisdhnvoisnbv.php";
$u=fopen($soub,"r");
$kont=explode("--KT--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_kontaktu(".");

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
<tr>
<td align=\"center\" class=\"genmed\"><strong>Kontakt na tvùrce stránek a návodù</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
for($i=1;$i<((count($kont)-1)/$del)+1;$i++)
{
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"70%\" align=\"center\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"7\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>{$kont[($i*$del)-4]}</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\" colspan=\"5\"><strong>{$kont[($i*$del)-3]}</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"7\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
<tr>
<td colspan=\"5\" rowspan=\"3\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"7\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>";
if (!empty($kont[($i*$del)-2]))
{
print
"<td class=\"input\" width=\"30%\" align=\"right\"><a href=\"mailto:{$kont[($i*$del)-2]}\" target=\"_blank\"><img src=\"images/ikona_email.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\" class=\"genmed\"></a></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
";
}
else
{print "<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td><td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>";}
if (!empty($kont[($i*$del)-1]))
{
print
"<td class=\"input\" width=\"30%\" align=\"center\"><a href=\"http://www.icq.com/scripts/search.dll?to={$kont[($i*$del)-1]}\" target=\"_blank\"><img src=\"images/ikona_icq.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\" class=\"genmed\"></a></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
";
}
else
{print "<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td><td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>";}
if (!empty($kont[($i*$del)]))
{
print
"<td class=\"input\" width=\"30%\" align=\"left\"><a href=\"{$kont[($i*$del)]}\" target=\"_blank\"><img src=\"images/ikona_www.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\" class=\"genmed\"></a></td>
";
}
else
{print "<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>";}
print
"<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"7\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table><hr width=\"60%\">";
}//end for
print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
?>
