<?
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{

$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace_admin();

print
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




<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
<tr>
<td>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <td class=\"thHead\" align=\"center\">&nbsp;</td>
	  <th class=\"thHead\" align=\"center\">Hodnost</th>
	  <td class=\"thHead\" align=\"center\">&nbsp;</td>
	  <th class=\"thHead\" align=\"center\">Ranks obrázek</th>
	  <td class=\"thHead\" align=\"center\">&nbsp;</td>
	  <th class=\"thHead\" align=\"center\">Typ Ranks</th>
	  <td class=\"thHead\" align=\"center\">&nbsp;</td>
	  <th class=\"thHead\" align=\"center\">Typ klienta</th>
	  <td class=\"thHead\" align=\"center\">&nbsp;</td>

	</tr>
	<tr>
	  <td class=\"thHead\" colspan=\"9\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\"><b>Uživatel</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\"><img src=\"../images/ranks/ranks_level_f.gif\"></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\" align=\"center\"><b>1</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\" align=\"center\"><b>1</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"thHead\" colspan=\"9\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\"><b>Elektromechanik</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\"><img src=\"../images/ranks/ranks_elektromechanik.gif\"></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\" align=\"center\"><b>7</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\" align=\"center\"><b>2</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"thHead\" colspan=\"9\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\"><b>Administrátor</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\"><img src=\"../images/ranks/ranks_administrator.gif\"></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\" align=\"center\"><b>8</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	  <td class=\"thHead\" align=\"center\"><b>3</b></td>
	  <td class=\"thHead\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"thHead\" colspan=\"9\">&nbsp;</td>
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
</td>
</tr>
</table>



<br clear=\"left\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">

<table cellspacing=\"3\" cellpadding=\"3\" border=\"1\" align=\"center\" class=\"genmed\" borderColorDark=#004A7B borderColorLight=#004A7B style=\"border-left-color: #004A7B; border-bottom-color: #004A7B; border-top-color: #004A7B; border-right-color: #004A7B;\">
	<tr>
	  <th class=\"thHead\">#</th>
	  <th class=\"thHead\">Jméno</th>
	  <th class=\"thHead\">E-mail</th>
	  <th class=\"thHead\">Heslo</th>
	  <th class=\"thHead\">ICQ</th>
	  <th class=\"thHead\">AOL</th>
	  <th class=\"thHead\">MSN</th>
	  <th class=\"thHead\">YAHOO</th>
	  <th class=\"thHead\">WWW</th>
	  <th class=\"thHead\">Bydliště</th>
	  <th class=\"thHead\">Povolání</th>
	  <th class=\"thHead\">Zájmy</th>
	  <th class=\"thHead\">Podpis</th>
	  <th class=\"thHead\">mail&nbsp;A/N</th>
	  <th class=\"thHead\">Identifikační&nbsp;číslo</th>
	  <th class=\"thHead\">Nic</th>
	  <th class=\"thHead\">Podpis&nbsp;A/N</th>
	  <th class=\"thHead\">Typ&nbsp;klienta</th>
	  <th class=\"thHead\">Cesta&nbsp;k&nbsp;avatar&nbsp;obrázku</th>
	  <th class=\"thHead\">Autorizační&nbsp;číslo</th>
	  <th class=\"thHead\">Datum&nbsp;vytvoření</th>
	  <th class=\"thHead\">Počet&nbsp;příspěvků</th>
	  <th class=\"thHead\">Pohlaví</th>
	  <th class=\"thHead\">Typ&nbsp;ranks</th>
	  <th class=\"thHead\">#</th>
	</tr>


";

$poz=0;
for($i=1;$i<count($udaj)/$pocet;$i++)
{
print "<tr><td class=\"genmed\" align=\"center\"><strong>$i<br>&nbsp;</strong></td>";

for($i1=22;$i1>-1;$i1--)
{
$poz++;
print "<td class=\"genmed\" align=\"center\"><strong>{$udaj[($i*$pocet)-$i1]}</strong><br><font color=silver>($poz)</font></td>";
}

print "<td class=\"genmed\" align=\"center\"><strong>$i<br>&nbsp;</strong></td></tr>";
}

echo
"	<tr>
	  <th class=\"thHead\">#</th>
	  <th class=\"thHead\">Jméno</th>
	  <th class=\"thHead\">E-mail</th>
	  <th class=\"thHead\">Heslo</th>
	  <th class=\"thHead\">ICQ</th>
	  <th class=\"thHead\">AOL</th>
	  <th class=\"thHead\">MSN</th>
	  <th class=\"thHead\">YAHOO</th>
	  <th class=\"thHead\">WWW</th>
	  <th class=\"thHead\">Bydliště</th>
	  <th class=\"thHead\">Povolání</th>
	  <th class=\"thHead\">Zájmy</th>
	  <th class=\"thHead\">Podpis</th>
	  <th class=\"thHead\">mail&nbsp;A/N</th>
	  <th class=\"thHead\">Identifikační&nbsp;číslo</th>
	  <th class=\"thHead\">Nic</th>
	  <th class=\"thHead\">Podpis&nbsp;A/N</th>
	  <th class=\"thHead\">Typ&nbsp;klienta</th>
	  <th class=\"thHead\">Cesta&nbsp;k&nbsp;avatar&nbsp;obrázku</th>
	  <th class=\"thHead\">Autorizační&nbsp;číslo</th>
	  <th class=\"thHead\">Datum&nbsp;vytvoření</th>
	  <th class=\"thHead\">Počet&nbsp;příspěvků</th>
	  <th class=\"thHead\">Pohlaví</th>
	  <th class=\"thHead\">Typ&nbsp;ranks</th>
	  <th class=\"thHead\">#</th>
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
</td>
</tr>
</table>";
}
?>
