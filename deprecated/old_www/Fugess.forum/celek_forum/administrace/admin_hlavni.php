<?
require "../funkce.php";
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
p, td { font-size : 11; color : #FFFFFF; }
h1 { font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 20px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h2 { font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 18px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}
h3 { font-family: \"Trebuchet MS\", Verdana, Arial, Helvetica, sans-serif; font-size : 16px; font-weight : bold; text-decoration : none; line-height : 120%; color : #FFFFFF;}


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


<title>Fugessovo fórum - administrace</title>
</head>
<body bgcolor=\"#E5E5E5\" text=\"#000000\" link=\"#A3C8FF\" vlink=\"#579AFF\">

<h2>Administrace Fugessova fóra</h2>

<p>Úvodní stránka administrace.<br>Zde je výpis počtu souborů a velikosti každé složky.</p>

<h3>Statistiky Fugessova fóra</h3>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">
<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">
  <tr>
	<th width=\"25%\" nowrap=\"nowrap\" height=\"25\" class=\"thCornerL\" align=\"left\">Statistiky</th>
	<th width=\"25%\" height=\"25\" class=\"thTop\" align=\"left\">Hodnoty</th>
	<th width=\"25%\" nowrap=\"nowrap\" height=\"25\" class=\"thTop\" align=\"left\">Statistiky</th>
	<th width=\"25%\" height=\"25\" class=\"thCornerR\" align=\"left\">Hodnoty</th>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Příspěvků celkem:</td>
	<td class=\"input\"><b>".pocet_prispevku_celkem_admin()."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Celková velikost fóra</td>
	<td class=\"input\"><b>".celkova_velikost_fora()."</b></td>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Témat celkem:</td>
	<td class=\"input\"><b>".pocet_temat_celkem_admin()."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Velikost složky images:</td>
	<td class=\"input\"><b>".velikost_vsech_obrazku()."</b></td>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Uživatelů celkem:</td>
	<td class=\"input\"><b>".pocet_uzivatelu_celkem_admin()."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Velikost složky administrace:</td>
	<td class=\"input\"><b>".velikost_adresare("../administrace",true)."</b></td>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Avatarů celkem:</td>
	<td class=\"input\"><b>".pocet_souboru("../images/avatars")."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Velikost složky avatars:</td>
	<td class=\"input\"><b>".velikost_adresare("../images/avatars",true)."</b></td>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Smajlíků celkem:</td>
	<td class=\"input\"><b>".pocet_souboru("../images/smiles")."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Velikost složky smiles:</td>
	<td class=\"input\"><b>".velikost_adresare("../images/smiles",true)."</b></td>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Počet ranks obrázků:</td>
	<td class=\"input\"><b>".pocet_souboru("../images/ranks")."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Velikost složky ranks:</td>
	<td class=\"input\"><b>".velikost_adresare("../images/ranks",true)."</b></td>
  </tr>
  <tr>
	<td class=\"input\" nowrap=\"nowrap\">Počet tlačítka obrázků:</td>
	<td class=\"input\"><b>".pocet_souboru("../images/tlacitka")."</b></td>
	<td class=\"input\" nowrap=\"nowrap\">Velikost složky tlačítka:</td>
	<td class=\"input\"><b>".velikost_adresare("../images/tlacitka",true)."</b></td>
  </tr>

</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>
  
<h3>Výpis uživatelů kteří jsou přítomni</h3>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">
<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">
  <tr>
	<th width=\"20%\" class=\"thCornerL\" height=\"25\">Uživatel:</th>
	<th width=\"20%\" height=\"25\" class=\"thTop\">Příhlašen v:</th>
	<th width=\"20%\" class=\"thTop\">Poslední aktualizace v:</th>
	<th width=\"20%\" class=\"thCornerR\">nachází se v:</th>
	<th width=\"20%\" height=\"25\" class=\"thCornerR\">Jeho aktuální IP adresa:</th>
  </tr>
  <tr>
	<td width=\"20%\" class=\"input\"><span class=\"gen\"><a href=\"odkaz na uživatele\" class=\"gen\">Jméno uživatele</a></span></td>
	<td width=\"20%\" align=\"center\" class=\"input\"><span class=\"gen\">čas</span></td>
	<td width=\"20%\" align=\"center\" nowrap=\"nowrap\" class=\"input\"><span class=\"gen\">čas</span></td>
	<td width=\"20%\" class=\"input\"><span class=\"gen\"><a href=\"odkaz kde je uživatel\" class=\"gen\">Pozice uživatele ve fóru</a></span></td>
	<td width=\"20%\" class=\"input\"><span class=\"gen\"><a href=\"http://network-tools.com/default.asp?host=IP.IP.IP.IP\" class=\"gen\" target=\"_phpbbwhois\">IP.IP.IP.IP</a></span></td>
  </tr>
</table>
      </td>
      <td width=\"0%\" class=\"mainboxRight\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
    </tr>
    <tr>
      <td width=\"0%\" class=\"mainboxLeftbottom\">&nbsp;</td>
      <td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
      <td width=\"0%\" class=\"mainboxRightbottom\">&nbsp;</td>
    </tr>
  </table>

<div align=\"center\">
	<span class=\"copyright\">

<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
 <tr>
  <td align=\"center\" class=\"copyright\">&nbsp;</td>
 </tr>
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

	</span>
</div>


</body>
</html>";
}
?>
