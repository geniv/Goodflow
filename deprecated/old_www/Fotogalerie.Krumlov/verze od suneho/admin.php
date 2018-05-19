<?
if(!Empty($jmeno) and !Empty($heslo))
{
print LoginDoAdminu($jmeno,$heslo);
}
else
{
echo 
"<form method=\"post\">
<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td align=\"center\">Login:</td>
<td align=\"center\"><input type=\"text\" name=\"jmeno\"></td>
</tr>
<tr>
<td align=\"center\">Heslo:</td>
<td align=\"center\"><input type=\"password\" name=\"heslo\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\"><input type=\"submit\" value=\"Pøihlásit\"></td>
</tr>
</tr>
</table>
<form>";
}
//print_r($_POST);
?>
