<?
/*
obrázek 240*180
odkaz na soubor(link)
nazev
popis
autor
typ: html, pdf, jpg...
datum pøidání

*/
// size=\"10\"
if(!Empty($admin_jmeno) and !Empty($admin_heslo) and login($admin_jmeno,$admin_heslo)=="true")
{
print
"<form method=\"post\" enctype=\"multipart/form-data\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"100%\"><strong>Pøidání&nbsp;návodu</strong></td>
<td class=\"input\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td align=\"left\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Obrázek:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\"><input type=\"file\" name=\"soubor\"></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Název:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\"><input type=\"text\" name=\"nazev\"></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Popis:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\"><textarea name=\"popis\" rows=\"2\" cols=\"30\"></textarea></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Pro:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\">
<select name=\"program\">
<option value=\"Gmax\">Gmax</option>
<option value=\"TACS\">TACS</option>
<option value=\"3D Studio Max\">3D Studio Max</option>
<option value=\"Gmax / TACS\">Gmax / TACS</option>
<option value=\"Gmax / 3D Studio Max\">Gmax / 3D Studio Max</option>
<option value=\"TACS / 3D Studio Max\">TACS / 3D Studio Max</option>
<option value=\"Gmax / TACS / 3D Studio Max\">Gmax / TACS / 3D Studio Max</option>
<option value=\"TRS\">TRS</option>
<option value=\"Photoshop\">Photoshop</option>
<option value=\"Gimp\">Gimp</option>
</select>
</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Typ:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\">
<select name=\"typ\">
<option value=\"WWW Stránky (online tutoriál)\">WWW Stránky (online tutoriál)</option>
<option value=\"JPG Obrázek\">JPG Obrázek</option>
<option value=\"GIF Obrázek\">GIF Obrázek</option>
<option value=\"PDF Soubor\">PDF Soubor</option>
<option value=\"AVI Video\">AVI Video</option>
<option value=\"MOV Video\">MOV Video</option>
<option value=\"MPG Video\">MPG Video</option>
<option value=\"MPEG Video\">MPEG Video</option>
<option value=\"WMV Video\">WMV Video</option>
<option value=\"ZIP Archiv - AVI Video\">ZIP Archiv - AVI Video</option>
<option value=\"ZIP Archiv - MOV Video\">ZIP Archiv - MOV Video</option>
<option value=\"ZIP Archiv - MPG Video\">ZIP Archiv - MPG Video</option>
<option value=\"ZIP Archiv - MPEG Video\">ZIP Archiv - MPEG Video</option>
<option value=\"ZIP Archiv - WMV Video\">ZIP Archiv - WMV Video</option>
<option value=\"ZIP Archiv - JPG Obrázek\">ZIP Archiv - JPG Obrázek</option>
<option value=\"ZIP Archiv - GIF Obrázek\">ZIP Archiv - GIF Obrázek</option>
<option value=\"ZIP Archiv - PDF Soubor\">ZIP Archiv - PDF Soubor</option>
<option value=\"ZIP Archiv - WWW Stránky\">ZIP Archiv - WWW Stránky</option>
<option value=\"RAR Archiv - AVI Video\">RAR Archiv - AVI Video</option>
<option value=\"RAR Archiv - MOV Video\">RAR Archiv - MOV Video</option>
<option value=\"RAR Archiv - MPG Video\">RAR Archiv - MPG Video</option>
<option value=\"RAR Archiv - MPEG Video\">RAR Archiv - MPEG Video</option>
<option value=\"RAR Archiv - WMV Video\">RAR Archiv - WMV Video</option>
<option value=\"RAR Archiv - JPG Obrázek\">RAR Archiv - JPG Obrázek</option>
<option value=\"RAR Archiv - GIF Obrázek\">RAR Archiv - GIF Obrázek</option>
<option value=\"RAR Archiv - PDF Soubor\">RAR Archiv - PDF Soubor</option>
<option value=\"RAR Archiv - WWW Stránky\">RAR Archiv - WWW Stránky</option>
</select>
</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Autor:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\"><input type=\"text\" name=\"autor\"></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td class=\"input\" align=\"center\" width=\"1%\"><strong>Odkaz&nbsp;na&nbsp;návod:</strong></td>
<td class=\"input\" width=\"1%\"><img src=\"../images/spacer.gif\" width=\"1px\">&nbsp;</td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\"><input type=\"text\" name=\"odkaz\"></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\" colspan=\"3\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
</td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"50%\">
<tr>
<td height=\"6px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"1%\">
<tr>
<td width=\"0%\" class=\"levy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
<td width=\"100%\" class=\"vrsek\"><img src=\"../images/spacer.gif\" height=\"17px\"></td>
<td width=\"0%\" class=\"pravy_vrsek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
<td class=\"input\" align=\"center\" width=\"1%\"><input type=\"submit\" value=\"Pøidat\"></td>
<td width=\"0%\" class=\"pravy\"><img src=\"../images/spacer.gif\" width=\"17px\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"levy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
<td width=\"100%\" class=\"spodek\"><img src=\"../images/spacer.gif\" height=\"18px\"></td>
<td width=\"0%\" class=\"pravy_spodek\"><img src=\"../images/spacer.gif\" width=\"17px\" height=\"18px\"></td>
</tr>
</table>
</form>";

if(!Empty($soubor) and !Empty($odkaz) and !Empty($nazev) and !Empty($program) and !Empty($popis) and !Empty($autor) and !Empty($typ) and $vel=getimagesize($soubor) and $vel[0]<=240 and $vel[1]<=180 and !Empty($vel[2]))
{
$ftp_server="cz-sk-trainz-tutorial.ic.cz";
$ftp_user_name="cz-sk-trainz-tutorial";
$ftp_user_pass="3Dgtutczskftp";
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);
$source_file=$soubor; //z komplu název
$novnaz=vygeneruj_nazev_obrazku($vel[2]);
$destination_file="../images/obrazky_navody/$novnaz";//na ftp
$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
if(!$upload)
{print "<font color=\"red\">Chyba pøi nahrávání na server</font>";}
else
{print pridej_navod($novnaz,"images/obrazky_navody/$novnaz",$odkaz,$nazev,$program,$popis,$autor,$typ);}
ftp_close($conn_id);
}//end if empty
else
{
if(!Empty($soubor))
{print "<font color=\"red\">Obrázek nesplòuje požadavky ! - Velikost obrázku je omezena na 240 x 180 px</font>";}
}
}
else
{print "neoprávnìný pøístup!";}
?>
