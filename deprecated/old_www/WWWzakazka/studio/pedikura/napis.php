<?
echo
"<h4>Napište nám</h4>
<form method=\"post\">
<table border=\"0\">
<tr>
<td align=\"right\">Jméno:</td>
<td><input type=\"text\" name=\"jmeno\" size=\"35\"></td>
</tr>
<tr>
<td align=\"right\">Email:</td>
<td><input type=\"text\" name=\"email\" value=\"@\" size=\"35\"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><textarea name=\"zprava\" cols=\"30\" rows=\"5\"></textarea></td>
</tr>
<tr>
<td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Odeslat\"></td>
</tr>
</table>
</form>";

if(!Empty($_POST["jmeno"]) and !Empty($_POST["email"]) and !Empty($_POST["zprava"]))
{
  if ($_POST["email"]=="@") {$email="studio-effect@ic.cz";} else {$email=$_POST["email"];}
  print NapisteNam($_GET["sekce"],$_POST["jmeno"],$email,$_POST["zprava"]);
}
?>
