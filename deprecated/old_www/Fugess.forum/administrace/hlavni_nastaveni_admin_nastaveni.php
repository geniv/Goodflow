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


<h2>Hlavní nastavení fóra</h2>

<p>Zde jsou hlavní nastavení celého fóra.</p>
<form method=\"post\">
   <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" align=\"center\">
			<tr>
			  <td width=\"0%\" class=\"mainboxLefttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"mainboxTop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"0%\" class=\"mainboxRighttop\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			</tr>
			<tr>
			  <td width=\"0%\" class=\"mainboxLeft\"><img src=\"../images/spacer.gif\" width=\"6\" height=\"6\"></td>
			  <td width=\"100%\" class=\"ErrorConfirmBox\">
<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" align=\"center\">
	<tr>
	  <th class=\"thHead\" colspan=\"2\">Hlavní nastavení fóra</th>
	</tr>
	<tr>
		<td class=\"input\">Jméno fóra</td>
		<td class=\"input\" width=\"40%\"><input class=\"post\" type=\"text\" size=\"40\" name=\"sitename\" value=\"".nazev_fora_admin()."\" /></td>
	</tr>
	<tr>
		<td class=\"input\">Popis fóra</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" size=\"40\" name=\"site_desc\" value=\"".popis_fora_admin()."\" /></td>
	</tr>
	<tr>
		<td class=\"input\">Počet témat na stránku</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" name=\"topics_per_page\" size=\"6\" maxlength=\"4\" value=\"".pocet_topiku_na_strance_admin()."\" /></td>
	</tr>
	<tr>
		<td class=\"input\">Počet příspěvků na stránku</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" name=\"posts_per_page\" size=\"6\" maxlength=\"4\" value=\"".pocet_prispevku_na_strance_admin()."\" /></td>
	</tr>
	<tr>
		<td class=\"input\">Počet uživatelů na stránku</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" name=\"user_per_page\" size=\"6\" maxlength=\"4\" value=\"".pocet_uzivatelu_na_strance_admin()."\" /></td>
	</tr>
	<tr>
	  <th class=\"thHead\" colspan=\"2\">Hlavní nastavení avatarů</th>
	</tr>
	<tr>
		<td class=\"input\">Maximální velikost avatara</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" size=\"6\" name=\"avatar_filesize\" value=\"".(setings_avatar_admin(3)/1024)."\"> KB</td>
	</tr>
	<tr>
		<td class=\"input\">Maximální rozměry avatara</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" size=\"6\" name=\"avatar_max_height\" value=\"".setings_avatar_admin(1)."\"> x <input class=\"post\" type=\"text\" size=\"6\" name=\"avatar_max_width\" value=\"".setings_avatar_admin(2)."\"> px</td>
	</tr>
	<tr>
	  <th class=\"thHead\" colspan=\"2\">Hlavní nastavení délky otevírání souborů</th>
	</tr>
	<tr>
		<td class=\"input\">Maximální délka čtení souborů</td>
		<td class=\"input\"><input class=\"post\" type=\"text\" size=\"10\" name=\"delka_souboru\" value=\"".delka_souboru_admin()."\"></td>
	</tr>
	<tr>
		<td class=\"catBottom\" colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Potvrdit\" class=\"mainoption\">
		</td>
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
</form>";




if(!Empty($sitename) and !Empty($site_desc) and !Empty($topics_per_page) and !Empty($posts_per_page) and !Empty($user_per_page) and !Empty($avatar_filesize) and !Empty($avatar_max_height) and !Empty($avatar_max_width) and !Empty($delka_souboru))
{

$soub="../nazev_for_a_pqowemfiuscnmweuinisnciwenfuiwewfwwefwiuwrnvwvuniwubeniuwndeoiunwdoiujn.php";
$u=fopen($soub,"w");
fwrite($u,$sitename);
fclose($u);

$sb_hes="../popis_fora_qpwodjihciwsudfzbvndiscnsruvbnsiudbczusdbvsbnvizsbvisdbvisudbvisdbvisudbv.php";
$u=fopen($sb_hes,"w");
fwrite($u,$site_desc);
fclose($u);

$sb_hes="../po_uziv_qwpoifjhsiuvndvhnsvydkjvshksvsdjviksjvidjhsfvkjdfhbvjhsdfbvkjsdbvjhdfbvij.php";
$u=fopen($sb_hes,"w");
fwrite($u,$user_per_page);
fclose($u);

$sb_hes="../poc_topiku_qpofndfivnjsoighviudfjisufhviusdhijfvidflksjdfviuskjvbsdfjvbsfkjvbskjfhbvksdjfvbsdfkjvbsfikjhnaijcn.php";
$u=fopen($sb_hes,"w");
fwrite($u,$topics_per_page);
fclose($u);

$sb_hes="../poc_pris_pevku_pqwmfvjivnsdjvsniuhnhvzvzusdovjnsfvjnasdfvojndafvjndfavjnadfjokvjnsdvcoikn.php";
$u=fopen($sb_hes,"w");
fwrite($u,$posts_per_page);
fclose($u);

$delkasoub=delka_souboru_admin();
$nazev="../sys_avatar_qpdonmsdiuvnsdivmndfasivnflkvnmaifjvbfkjvnsdfiajbvakdfjnvakdjfbvdfakjvn.php";
$u=fopen($nazev,"r");
$udaj=explode("--AV--",fread($u,$delkasoub));
fclose($u);

$udaj[1]=$avatar_max_height;
$udaj[2]=$avatar_max_width;
$udaj[3]=$avatar_filesize*1024;

$u=fopen($nazev,"w");
fwrite($u,implode($udaj,"--AV--"));
fclose($u);

$soubr="../del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"w");
fwrite($u,$delka_souboru);
fclose($u);

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
	  <th class=\"thHead\">Hodnoty byly změněny</th>
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
"<div align=\"center\">
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
