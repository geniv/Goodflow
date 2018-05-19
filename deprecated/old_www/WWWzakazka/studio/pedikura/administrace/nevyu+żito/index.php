<?
require "funkce.php";

if(!Empty($jmeno) and !Empty($heslo1))
{
if(LoginAdmin($jmeno,$heslo1)=="true0" or LoginAdmin($jmeno,$heslo1)=="true1")
{
SetCookie("hl_jmeno",$jmeno,Time()+360000000);
SetCookie("hl_heslo",$heslo1,Time()+360000000);
print "<a href=\"index_go.php\">Pokraèuj zde</a>";//krok 2
}
else
{
SetCookie("hl_jmeno","");
SetCookie("hl_heslo","");
print "Nepovolený pøístup!!";
}//end if else login
}
else
{
SetCookie("hl_jmeno","");
SetCookie("hl_heslo","");
echo
"<form method=\"post\">
<input type=\"text\" name=\"jmeno\"><br>
<input type=\"password\" name=\"heslo1\"><br>
<input type=\"password\" name=\"heslo2\"><br>
<input type=\"password\" name=\"heslo3\"><br>
<input type=\"password\" name=\"heslo4\"><br>
<input type=\"submit\" value=\"Pøihlásit\">
</form>";
}
?>
