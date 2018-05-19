<div style="WIDTH: 740px; HEIGHT: 0px"></div>

<?
if (Empty($_POST["jmeno"]) and Empty($_POST["pass"]))
{
  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\">
<tr>
<td class=\"centralni_nadpis\">Administrace</td>
</tr>
</table><br>
<form method=\"post\">
<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td colspan=\"3\">Zde se mohou přihlásit jen administrátoři</td>
</tr>
<tr>
<td colspan=\"3\" height=\"6px\"></td>
</tr>
<tr>
<td align=right>Login:</td>
<td>&nbsp;</td>
<td><input type=\"text\" name=\"jmeno\" class=\"prechod_tabulka_input\"></td>
</tr>
<tr>
<td align=right>Heslo:</td>
<td>&nbsp;</td>
<td><input type=\"password\" name=\"pass\" class=\"prechod_tabulka_input\"></td>
</tr>
<tr>
<td colspan=\"3\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\"><input type=\"submit\" value=\"Přihlásit\"></td>
</tr>
</table>
</form>";
}
  else
{
  if (!Empty($_POST["jmeno"]) and !Empty($_POST["pass"]) and LogAdmin("administrace", $_POST["jmeno"], $_POST["pass"], 0) == "true1")
  {
    echo
    "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=_admin\">
    </head>
    <center><a href=\"index.php?kam=_admin\">".overuji_vase_udaje()."</a></center>";
  }
    else
  {
    echo
    "<head>
    <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=admin\">
    </head>
    <center><a href=\"index.php?kam=admin\">".pristup_zamitnut()."</a></center>";
  }
}
?>
