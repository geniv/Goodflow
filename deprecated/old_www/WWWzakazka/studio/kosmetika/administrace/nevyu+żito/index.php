<?
//NEVYU�IT�!!!!!!!!!!!!!!!!!
require "funkce.php";

if(!Empty($jmeno) and !Empty($heslo1))
{
if(LoginAdmin($jmeno,$heslo1)=="true0" or LoginAdmin($jmeno,$heslo1)=="true1")
{
SetCookie("hl_jmeno",$jmeno,Time()+360000000);
SetCookie("hl_heslo",$heslo1,Time()+360000000);
print "<a href=\"kosmetika/administrace/index_go.php\" target=\"_blank\">Pokra�uj zde</a>";//krok 2
}
else
{
SetCookie("hl_jmeno","");
SetCookie("hl_heslo","");
print "Nepovolen� p��stup!!";
}//end if else login
}
else
{
SetCookie("hl_jmeno","");
SetCookie("hl_heslo","");
echo
"<h4>Admininstr�torsk� sekce - p�ihl�en�:</h3>
<form method=\"post\">
<table border=\"0\">
<tr>
<td align=\"right\">U�ivatelsk� jm�no:</td>
<td><input type=\"text\" name=\"jmeno\"></td>
</tr>
<tr>
<td align=\"right\">Heslo:</td>
<td><input type=\"password\" name=\"heslo1\"></td>
</tr>
<tr>
<td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"P�ihl�sit\"></td>
</tr>
</table>
</form>";
}
?>
