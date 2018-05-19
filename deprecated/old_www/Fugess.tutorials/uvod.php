<table border="0" cellspacing="0" cellpadding="0" align="center" width="90%">
<tr>
<td align="center" class="genmed"><strong>CZ & SK Trainz Tutorial - Sbírka všech CZ a SK návodù na Gmax / 3D Studio Max / Trainz</strong></td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="70%">
<tr>
<td height="6px"></td>
</tr>
</table>
<?
$delkasoub=delka_souboru("administrace");
$soub="uvod_ni_apfijnsdjvnadkcjnosnvosinhvisuffnbpqoweigunfugfhgifjhkdjgztdedzgtdfeoikjwefoihweoufwerf.php";
$u=fopen($soub,"r");
$uvd=explode("--VL--",fread($u,$delkasoub));
fclose($u);

if(Empty($str)){$str=1;}

$del=delka_pole_uvodu(".");
$zobstr=pocet_polozek_uvod(".");
$pocstr=ceil(((count($uvd)-1)/$del)/$zobstr);

$zobrmin=(((count($uvd)-1)/$del)+1)-($zobstr*$str);
$zobrmax=($zobrmin+$zobstr)-1;

for($i=((count($uvd)-1)/$del);$i>0;$i--)
{
if(($i>=$zobrmin and $i<=$zobrmax))
{
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"70%\" align=\"center\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>{$uvd[($i*$del)-1]}</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"left\" width=\"100%\"><strong><span clas=\"uvod_pridan_navod\">{$uvd[($i*$del)]}</strong></span></td>
<td class=\"input\"><img src=\"images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"images/spacer.gif\" width=\"17px\" height=\"18px\"></a></td>
</tr>
</table>";
}
}//end for
print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"70%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"90%\">
<tr>
<td align=\"left\" class=\"genmed\"><strong>Strana: $str z $pocstr</strong></td>
<td align=\"right\" class=\"genmed\"><strong>".jdi_na_stranku($str,$pocstr,"uvod")."</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td align=\"center\" class=\"genmed\"><strong>Bylo zde ".pocitadlo_pristupu()." lidí</strong></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"70%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>";
?>
