<?
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{
echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\"  />
<link rel=\"stylesheet\" href=\"../fugess-f-z.css\" type=\"text/css\">
<style type=\"text/css\">
<!--

/* General font families for common tags */
font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td		{ font-size : 11; color : #000000; }
h1,h2		{ font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 22px; font-weight : bold; text-decoration : none; line-height : 120%; color : #000000;}


/* The largest text used in the index page title and toptic title etc. */
.maintitle	{
			font-weight: bold; font-size: 22px; font-family: \"Trebuchet MS\",Verdana, Arial, Helvetica, sans-serif;
			text-decoration: none; line-height : 120%;
}

/* General text */
.gen { font-size : 12px; }
.genmed { font-size : 11px; }
.gensmall { font-size : 10px; }


/* The register, login, search etc links at the top of the page */
.mainmenu		{ font-size : 11px; }

/* Forum category titles */
.cattitle		{ font-weight: bold; font-size: 12px; }

/* Forum title: Text and link to the forums used in: index.php */
.forumlink		{ font-weight: bold; font-size: 12px; }

/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-weight: bold; font-size: 11px; }

/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name			{ font-size : 11px; }

/* Location, number of posts, post date etc */
.postdetails		{ font-size : 10px; }


/* The content of the posts (body of text) */
.postbody { font-size : 12px; }


/* Form elements */
input,textarea, select {
	font: normal 11px;
}

input { text-indent : 2px; }

/* The buttons used for bbCode styling in message post */
input.button {
	font-size: 11px;
}

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url(\"../fugess_form.css\");
-->
</style>
</head>
<body bgcolor=\"#E5E5E5\" text=\"#000000\" link=\"#A3C8FF\" vlink=\"#579AFF\">


<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">
  <tr>
	<td align=\"center\" >
	  <table width=\"100%\" cellpadding=\"6\" cellspacing=\"0\" border=\"0\" class=\"forumline_admin\">
		<tr>
		  <th class=\"thHead\"><b>Administrace</b></th>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"admin_hlavni.php\" target=\"main\" class=\"genmed\">Úvod administrace</a></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"../index.php\" target=\"_blank\" class=\"genmed\">Zobrazit fórum</a></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Fórum</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"\"  target=\"main\" class=\"genmed\">Administrace</a> - N</span></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Nastavení</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"hlavni_nastaveni_admin_nastaveni.php\" target=\"main\" class=\"genmed\">Hlavní nastavení</a></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"prevody_admin_nastaveni.php\" target=\"main\" class=\"genmed\">Převody</a></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"dir_aplaud_admin_nastaveni.php\" target=\"main\" class=\"genmed\">Hlavní upload</a></span></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"logovani_admin_nastaveni.php\" target=\"main\" class=\"genmed\">Logování</a></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Skupiny</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"\"  target=\"main\" class=\"genmed\">Administrace</a> - N</span></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Styly</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"\"  target=\"main\" class=\"genmed\">Administrace</a> - N</span></td>
		</tr>
		<tr>
		  <td class=\"catSides\"><span class=\"cattitle\">Uživatelé</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"administrace_admin_uzivatele.php\" target=\"main\" class=\"genmed\">Administrace</a></td>
		</tr>
		<tr>
		  <td class=\"input\"><a href=\"posilani_emailu_admin_uzivatele.php\" target=\"main\" class=\"genmed\">Posílání e-mailů</a></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"\"  target=\"main\" class=\"genmed\">Banysti</a> - N</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"\"  target=\"main\" class=\"genmed\">Oprávnění</a> - N</span></td>
		</tr>
		<tr>
		  <td class=\"input\"><span class=\"genmed\"><a href=\"\"  target=\"main\" class=\"genmed\">Hodnocení</a> - N</span></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>


</body>
</html>";
}
?>
