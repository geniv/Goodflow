<?
require "funkce_admin.php";

if(!Empty($jmeno) and !Empty($heslo) and login_admin($jmeno,$heslo)=="true" and prava_uzivatele_admin($jmeno,$ID_uz)==3)
{
SetCookie("jmeno_admina",$jmeno,Time()+360000000);
SetCookie("heslo_admina",$heslo,Time()+360000000);
SetCookie("ID_uz_admin",id_uzivatele_admin($jmeno,$heslo),Time()+360000000);
$odk="<a href=\"index_go.php\" name=\"odk\" class=\"genmed\"><b>Přejít</b></a><body onload=\"odk.click();\"></body>";
}
else
{
SetCookie("jmeno_admina","");
SetCookie("heslo_admina","");
SetCookie("ID_uz_admin","");
if(!Empty($jmeno) and !Empty($heslo))
{$odk="<span class=\"genmed\"><b>Špatně zadané udaje !<b></span>";}
else
{$odk="";}
}

if(!Empty($jmeno) and !Empty($heslo))
{
$st=login_admin($jmeno,$heslo);
logovani_prihlasovani_admin($jmeno,$heslo,$REMOTE_ADDR,$st);
}
echo 
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<link rel=\"stylesheet\" href=\"../fugess-f-z.css\" type=\"text/css\">
</head>
<body bgcolor=\"#0071AE\" text=\"#FFFFFF\" link=\"#FFFFFF\" vlink=\"#9CCEFF\">


<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>

<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>

<td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>

<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>

<tr>
<td width=\"0%\" class=\"mainboxLeft\">
<img src=\"../images/spacer.gif\" width=\"6\" height=\"6\">
</td>

<td width=\"100%\" class=\"mainbox\">
<table width=\"100%\" cellpadding=\"16\" border=\"0\">
<tr>
<td>

<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>

<td valign=\"top\">
<a href=\"../index.php\"><img src=\"../images/logo_fugess.jpg\" border=\"0\" alt=\"Fugessovo fórum\" vspace=\"1\" width=\"224\" height=\"96\"></a>
</td>

<td align=\"center\" width=\"100%\" valign=\"top\">
</td>

</tr>
</table>



<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\">
<tr>
<td align=\"left\" valign=\"bottom\">
<span class=\"gensmall\"></span>


</td>

</tr>
</table><form method=\"post\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td colspan=\"3\">

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"0%\"><img src=\"../images/cat_lcap_whosonline.gif\" width=\"22\" height=\"51\"></td>
<td width=\"100%\" background=\"../images/cat_bar.jpg\" valign=\"top\">

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
<tr>
<td class=\"cBarStart\" valign=\"top\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td valign=\"top\"><img src=\"../images/whosonline_item.gif\" width=\"21\" height=\"39\"></td>
<td class=\"cattitle\"><span class=\"cattitle\"><A name=\"login\"></a>Přihlášení</span></td>
</tr>
</table>

</td>
<td><img src=\"../images/spacer.gif\" width=\"1\" height=\"51\"></td>
</tr>
</table>

</td>
<td width=\"0%\"><img src=\"../images/cat_rcap.gif\" width=\"33\" height=\"51\"></td>
</tr>
</table>

</td>
</tr>
<tr>
<td width=\"0%\"><img src=\"../images/spacer.gif\" width=\"16\" height=\"22\">
</td>
<td width=\"100%\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"0%\" class=\"cboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"5\"></td>
<td width=\"100%\" class=\"cbox\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td class=\"cBoxStart\" align=\"center\">
<table border=\"0\" cellspacing=\"6\" cellpadding=\"1\" valign=\"top\">
 <tr>
  <td colspan=\"2\" align=\"center\"><span class=\"genmed\"><b>Napiš jméno a heslo:</b></span></td>
 </tr>
 <tr>
  <td align=\"right\" class=\"genmed\"><div style=\"width:30px;\">Jméno:</div></td><td><INPUT class=\"post\" type=\"text\" name=\"jmeno\" size=\"16\" maxlength=\"32\"></td>
 </tr>
 <tr>
  <td align=\"right\" class=\"genmed\"><div style=\"width:30px;\">Heslo:</div></td><td><INPUT class=\"post\" type=\"password\" name=\"heslo\" size=\"16\" maxlength=\"32\" onkeydown=\"if(event.keyCode==13){prihlas.click();}\"></td>
 </tr>
 <tr>
  <td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Přihlášení\"></td>
 </tr>
 <tr>
  <td colspan=\"2\" align=\"center\">$odk</td>
 </tr>
</table>
</td>
</tr>
</table>
</td>
<td width=\"0%\" class=\"cboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\">
</td>
</tr>
<tr>
<td width=\"0%\" class=\"cboxLeftbottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" valign=\"top\" class=\"cboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"0%\" class=\"cboxRightbottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
</table>
</td>
<td class=\"catbox_right\"><img src=\"../images/spacer.gif\" width=\"27\" height=\"27\"></td>
</tr>
</table>
<input type=\"hidden\" value=\"prihlaseni\" name=\"kam\">
</form>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
 <tr>
  <td align=\"center\" class=\"copyright\">Copyright <a href=\"http://fugess.trainz.cz/\" target=\"_blank\" class=\"copyright\">Fugess</a> © 2007</td>
 </tr>
  <tr>
  <td align=\"center\" class=\"copyright\">Programming <a href=\"http://geniv.wu.cz/\" target=\"_blank\" class=\"copyright\">Geniv</a> &reg; 2007</td>
 </tr>
  <tr>
  <td align=\"center\" class=\"copyright\">Design & Testing <a href=\"http://fugess.trainz.cz/\" target=\"_blank\" class=\"copyright\">Fugess</a> &reg; 2007</td>
 </tr>
</table>

</div>
</td>
</tr>
</table>

</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
</table>
</body>
</html>";
?>
