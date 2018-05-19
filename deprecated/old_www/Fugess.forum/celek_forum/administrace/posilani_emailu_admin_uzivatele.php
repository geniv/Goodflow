<?
require "../funkce.php";
require "funkce_admin.php";

if(!Empty($jmeno_admina) and !Empty($heslo_admina) and login_admin($jmeno_admina,$heslo_admina)=="true" and prava_uzivatele_admin($jmeno_admina,$ID_uz_admin)==3)
{
if(Empty($vyber))
{$vyber="";}

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


<h2>Posílání e-mailů</h2>

<p>Vyber uživatele, kterému chceš poslat e-mail a klapni na tlačítko přenést jeho e-mail do příjemce.</p>";


if(!Empty($subject) and !Empty($mejl) and !Empty($message))
{
mail($mejl,$subject,$message);
print
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
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

<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <th class=\"thHead\">&nbsp;</th>
	  <th class=\"thHead\">&nbsp;</th>
	  <th class=\"thHead\">&nbsp;</th>
	  <th class=\"thHead\">E-mail byl odeslán</th>
	  <th class=\"thHead\">&nbsp;</th>
	  <th class=\"thHead\">&nbsp;</th>
	  <th class=\"thHead\">&nbsp;</th>
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

}

echo
"<form mathod=\"post\">
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

<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <th class=\"thHead\" colspan=\"6\">Vyber uživatele, kterému chceš poslat e-mail</th>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"6\">&nbsp;</td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"left\">
     <select name=\"vyber\" size=\"10\">";

$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace_admin();

for($i=1;$i<count($udaj)/$pocet;$i++)
{	
echo
"<option value=\"{$udaj[($i*$pocet)-21]}\">{$udaj[($i*$pocet)-22]}</option>
";
}
       
echo
"    </select>
    </td>
    <td class=\"input\" align=\"center\">&nbsp;</td>
    <td class=\"input\" align=\"center\"><input type=\"submit\" value=\"Přenést jeho e-mail do příjemce\" name=\"submit\"></td>
    <td class=\"input\" align=\"center\">&nbsp;</td>
	</tr>

	<tr>
	  <td class=\"input\" align=\"center\" colspan=\"6\">&nbsp;</td>
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



<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" class=\"forumline\">
	<tr>
	  <th class=\"thHead\" colspan=\"4\">Napsat e-mail</th>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"right\"><b>Příjemce:</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"left\"><span class=\"gen\"><input class=\"post\" type=\"text\" name=\"mejl\" size=\"64\" tabindex=\"2\" class=\"post\" value=\"$vyber\"></span></td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"right\"><b>Předmět:</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\"><span class=\"gen\"><input class=\"post\" type=\"text\" name=\"subject\" size=\"64\" tabindex=\"2\" class=\"post\" value=\"\"></span></td>
	</tr>
	<tr>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\" align=\"right\" valign=\"top\"><b>Zpráva:</b></td>
	  <td class=\"input\" align=\"center\">&nbsp;</td>
	  <td class=\"input\"><span class=\"gen\"><textarea name=\"message\" rows=\"15\" cols=\"35\" wrap=\"virtual\" style=\"width:400px\" tabindex=\"3\" class=\"post\"></textarea></span>
	</tr>
	<tr>
	  <td class=\"catBottom\" align=\"center\" colspan=\"4\"><input type=\"submit\" value=\"Poslat e-mail\" name=\"submit\" class=\"mainoption\"></td>
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
</form>";




echo
"
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

?>
