<?
if(!Empty($admin_jmeno) and !Empty($admin_heslo) and login($admin_jmeno,$admin_heslo)=="true")
{
$delkasoub=delka_souboru(".");
$soub="../navody_y_qpwdjnisvbnaocnbsuivniufcvbekjshbvuwzbviuciwuehcwiufchwfcveruzcweoijwiufvwezfvcweiciwecibwiuc.php";
$u=fopen($soub,"r");
$odk=explode("--OD--",fread($u,$delkasoub));
fclose($u);

$del=delka_pole_navodu("..");

print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong>Smazání&nbsp;návodu</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td></td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong><a href=\"#uplne_dolu\"><img src=\"../images/icon_botton.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a></strong></td>
<td></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
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
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"1%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong>$i</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td></td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong><img src=\"../{$odk[($i*$del)-7]}\" width=\"180\" height=\"135\"></strong></td>
<td></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td></td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong><a href=\"{$odk[($i*$del)-6]}\" target=\"_blank\"><img src=\"../images/ikona_www.gif\" alt=\"{$odk[($i*$del)-6]}\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a></strong></td>
<td></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong>{$odk[($i*$del)-5]}</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong>{$odk[($i*$del)-4]}</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong>{$odk[($i*$del)-3]}</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong>{$odk[($i*$del)-2]}</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong>{$odk[($i*$del)-1]}</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong>{$odk[($i*$del)]}</strong></td>
<td class=\"input\" width=\"0%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td></td>
<td class=\"input\" align=\"center\" width=\"0%\"><strong><a href=\"index_go.php?kam=smaz&pro=del&cislo=$i\" class=\"genmed\"><img src=\"../images/topic_delete.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a></strong></td>
<td></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"1%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>";
}//end for
print "";

if(!Empty($pro) and $pro=="del" and !Empty($cislo))
{
$ftp_server="cz-sk-trainz-tutorial.ic.cz";
$ftp_user_name="cz-sk-trainz-tutorial";
$ftp_user_pass="3Dgtutczskftp";
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//musí
ftp_delete($conn_id,$odk[($cislo*$del)-7]);
ftp_close($conn_id);
print smazat_navod($cislo);
}

}
else
{print "neoprávnìný pøístup!";}
?>

