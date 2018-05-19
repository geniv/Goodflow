<?
if(Empty($uziv) and Empty($hesl) and Empty($autologin))
{
echo
"<form method=\"get\">
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
<table border=\"0\" cellspacing=\"8\">
<tr>
<td class=\"loginIndex\">
<span class=\"genmed\">
Uživatel: <INPUT class=\"post\" type=\"text\" name=\"uziv\" size=\"10\" maxlength=\"32\">&nbsp;&nbsp;&nbsp;
Heslo: <INPUT class=\"post\" type=\"password\" name=\"hesl\" size=\"10\" maxlength=\"32\">&nbsp;&nbsp;&nbsp;&nbsp;
<INPUT type=\"button\" class=\"mainoption\" value=\"Pøihlášení\" onclick=\"kam.click();\">
</span>
</td>
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
<input type=submit value=\"prihlaseni\" name=\"kam\" style=\"visibility:hidden\">
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
