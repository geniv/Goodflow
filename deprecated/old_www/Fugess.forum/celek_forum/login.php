<?
if(Empty($uziv) and Empty($hesl))
{
echo
"<form method=\"post\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td colspan=\"3\">

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"0%\"><img src=\"images/cat_lcap_whosonline.gif\" width=\"22\" height=\"51\"></td>
<td width=\"100%\" background=\"images/cat_bar.jpg\" valign=\"top\">

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\">
<tr>
<td class=\"cBarStart\" valign=\"top\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td valign=\"top\"><img src=\"images/whosonline_item.gif\" width=\"21\" height=\"39\"></td>
<td class=\"cattitle\"><span class=\"cattitle\"><A name=\"login\"></a>Pøihlášení</span></td>
</tr>
</table>

</td>
<td><img src=\"images/spacer.gif\" width=\"1\" height=\"51\"></td>
</tr>
</table>

</td>
<td width=\"0%\"><img src=\"images/cat_rcap.gif\" width=\"33\" height=\"51\"></td>
</tr>
</table>

</td>
</tr>
<tr>
<td width=\"0%\"><img src=\"images/spacer.gif\" width=\"16\" height=\"22\">
</td>
<td width=\"100%\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"0%\" class=\"cboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"5\"></td>
<td width=\"100%\" class=\"cbox\">
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td class=\"cBoxStart\" align=\"center\">
<table border=\"0\" cellspacing=\"6\" cellpadding=\"1\" valign=\"top\">
 <tr>
  <td colspan=\"2\" align=\"center\"><span class=\"genmed\"><b>Zde zadejte Vaše uživatelské jméno a heslo:</b></span></td>
 </tr>
 <tr>
  <td align=\"right\" class=\"genmed\"><div style=\"width:80px;\">Uživatel:</div></td><td><INPUT class=\"post\" type=\"text\" name=\"uziv\" size=\"16\" maxlength=\"32\"></td>
 </tr>
 <tr>
  <td align=\"right\" class=\"genmed\"><div style=\"width:80px;\">Heslo:</div></td><td><INPUT class=\"post\" type=\"password\" name=\"hesl\" size=\"16\" maxlength=\"32\" onkeydown=\"if(event.keyCode==13){prihlas.click();}\"></td>
 </tr>
 <tr>
  <td colspan=\"2\" align=\"center\"><INPUT type=\"submit\" class=\"mainoption\" name=\"prihlas\" value=\"Pøihlášení\"></td>
 </tr>
 <tr>
  <td colspan=\"2\" align=\"center\"><span class=\"gensmall\">Po pøihlášení není zapotøebí se znovu  pøihlašovat (cookies je automaticky aktivní).</span></td>
 </tr>
 <tr>
  <td colspan=\"2\" align=\"center\"><span class=\"gensmall\">Zapomnìli jste svoje heslo ? - <a href=\"index.php?kam=zap_heslo\" class=\"gensmall\">požádejte o zaslání</a></span></td>
 </tr>


</table>
</td>
</tr>
</table>
</td>
<td width=\"0%\" class=\"cboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\">
</td>
</tr>
<tr>
<td width=\"0%\" class=\"cboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" valign=\"top\" class=\"cboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"0%\" class=\"cboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
</table>
</td>
<td class=\"catbox_right\"><img src=\"images/spacer.gif\" width=\"27\" height=\"27\"></td>
</tr>
</table>
<input type=\"hidden\" value=\"prihlaseni\" name=\"kam\">
</form>";
}
/*
else
{

odj.click();
?uziv=$uziv&hesl=$hesl&autologin=$autologin
echo 
"<input type=hidden name=\"jmeno\" value=\"$uziv\">
<input type=hidden name=\"heslo\" value=\"$hesl\">
..uloženo do cookie??;

}
/*
if($st=="true") <body onload=\"zapis();\"></body> <body onload=\"zapis();\"></body>";
{
print "<body onload=\"odj.click();\"><a name=\"odj\" href=\"index.php?kam=login\"></body>";
}
else
{
print "<body onload=\"odj.click();\"><a name=\"odj\" href=\"index.php?kam=login\"></body>";
}//end if st=true

}

<input type=\"hidden\" name=\"kam\">
<input type=\"submit\" name=\"poslat\" value=\"\" style=\"visibility:hidden\">
*/
?>
