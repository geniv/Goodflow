<?
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{
hlavni_logovani_admin($REMOTE_ADDR);
echo
"<html>
<head>
<title>Fugessovo fórum - Administrace</title>
<meta http-equiv=\"Content-Type\" content=\"text/html;\">
</head>

<frameset cols=\"150,*\" rows=\"*\" border=\"1\" framespacing=\"0\">
  <frame src=\"admin_menu.php\" name=\"nav\" marginwidth=\"3\" marginheight=\"3\" scrolling=\"no\">
  <frame src=\"admin_hlavni.php\" name=\"main\" marginwidth=\"10\" marginheight=\"10\" scrolling=\"auto\">
</frameset>

<noframes>
	<body bgcolor=\"#FFFFFF\" text=\"#000000\">
		<p>--- nejsou k dispozici rámce ---</p>
	</body>
</noframes>
</html>";
}
else
{
print "<center><h1>Tady nemáš co pohledávat !!!</h1></center>";
}


?>
