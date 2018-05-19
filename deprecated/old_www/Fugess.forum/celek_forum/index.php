<?
require "funkce.php"; //funkce všeho

banovani($REMOTE_ADDR);

if(!Empty($kam)){hlavni_logovani($kam,$REMOTE_ADDR);}

if(!Empty($logodh) and $logodh=="true")
{
SetCookie("Jmeno_r","");
SetCookie("Heslo_r","");
SetCookie("ID_uz","");
}

if(!Empty($uziv) and !Empty($hesl))
{
$st=login($uziv,$hesl);
logovani_prihlasovani($uziv,$hesl,$REMOTE_ADDR,$st);

if($st=="true")
{
SetCookie("Jmeno_r",$uziv,Time()+360000000);
SetCookie("Heslo_r",$hesl,Time()+360000000);
SetCookie("ID_uz",id_uzivatele($uziv,$hesl),Time()+360000000);
}//end if st=true

}//end if empty
//odpocet(Date("s"));doøešit!

//if(!Empty($Jmeno_r) and !Empty($Heslo_r))//doøešit!
//{
//rozlis_dle_adresy($Jmeno_r,$Heslo_r,$REMOTE_ADDR);
//}

//index.php?kam=zap_heslo
//index.php?kam=novy_topik

//print_r($HTTP_COOKIE_VARS);//test
$nazv=nazev_fora();
if(Empty($kam)){$kam="";}
if(Empty($cis)){$cis=0;}
if(Empty($pris)){$pris=0;}
$cest=cesta_ve_foru($kam,$cis,$pris);

if(!Empty($Jmeno_r) and !Empty($Heslo_r))
{logovani_pohybu($Jmeno_r,$Heslo_r,$REMOTE_ADDR,$cis,$pris);}

if(!Empty($Jmeno_r) and prava_uzivatele($Jmeno_r,$ID_uz)==3)
{$admin="<br><center><a href=\"administrace\" class=\"genmed\">Administrace fóra</a></center>";}
else
{$admin="";}

echo 
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<title>$nazv</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<link rel=\"stylesheet\" href=\"fugess-f-z.css\" type=\"text/css\">
</head>
<body bgcolor=\"#0071AE\" text=\"#FFFFFF\" link=\"#FFFFFF\" vlink=\"#9CCEFF\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
<tr>

<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>

<td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>

<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>

<tr>
<td width=\"0%\" class=\"mainboxLeft\">
<img src=\"images/spacer.gif\" width=\"6\" height=\"6\">
</td>

<td width=\"100%\" class=\"mainbox\">
<table width=\"100%\" cellpadding=\"16\" border=\"0\">
<tr>
<td>

<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>

<td valign=\"top\">
<a href=\"index.php\"><img src=\"images/logo_fugess.jpg\" border=\"0\" alt=\"$nazv\" vspace=\"1\" width=\"224\" height=\"96\"></a>
</td>

<td align=\"center\" width=\"100%\" valign=\"top\">
<span class=\"maintitle\">$nazv</span>
<br>
<span class=\"gen\">".popis_fora()."</span>
<br><br>

<table border=\"0\" cellpadding=\"0\">
<tr>

<td align=\"center\" valign=\"middle\" nowrap class=\"mainmenu\">

<table border=\"0\" cellspacing=\"0\">
<tr>
<td>
<a href=\"index.php?kam=uzivatele&str=1\"><img src=\"images/icon_mini_members.gif\" border=\"0\" alt=\"Seznam uživatelù\"></a>
</td>
<td style=\"padding-right: 7px\" class=\"mainmenu\">
<a href=\"index.php?kam=uzivatele&str=1\">Seznam uživatelù</a>
</td>
</tr>
</table>
</td>

<td align=\"center\" valign=\"middle\" nowrap class=\"mainmenu\">

<table border=\"0\" cellspacing=\"0\">
<tr>
<td>
<a href=\"index.php?kam=skupiny\"><img src=\"images/icon_mini_groups.gif\" border=\"0\" alt=\"Uživatelské skupiny\"></a>
</td>
<td style=\"padding-right: 7px\" class=\"mainmenu\">
<a href=\"index.php?kam=skupiny\">Uživatelské skupiny</a>
</td>
</tr>
</table>
</td>

<td align=\"center\" valign=\"middle\" nowrap class=\"mainmenu\">";

if(Empty($Jmeno_r) and Empty($Heslo_r))
{
echo
"<table border=\"0\" cellspacing=\"0\">
<tr>
<td>
<a href=\"index.php?kam=registrace\"><img src=\"images/icon_mini_register.gif\" border=\"0\" alt=\"Registrace\"></a>
</td>
<td style=\"padding-right: 7px\" class=\"mainmenu\">
<a href=\"index.php?kam=registrace\">Registrace</a> - <a href=\"../clanek_-_registrace_fugessovo_forum.php\" target=\"_blank\">ÈTI MÌ</a>
</td>
</tr>
</table>";
}

echo
"</td>

</tr>
</table>

<table border=\"0\" cellpadding=\"0\">
<tr>
<td align=\"center\" class=\"mainmenu\" valign=\"middle\" nowrap class=\"mainmenu\">

<table border=\"0\" cellspacing=\"0\">
<tr>
<td class=\"mainmenu\">
<a href=\"index.php?kam=profil\" class=\"mainmenu\"><img src=\"images/icon_mini_profile.gif\" border=\"0\" alt=\"Profil\"></a>
</td>
<td class=\"mainmenu\" style=\"padding-right: 7px\">
<a href=\"index.php?kam=profil\" class=\"mainmenu\">Profil</a>
</td>
</tr>
</table>
</td>

<td align=\"center\" class=\"mainmenu\" valign=\"middle\" nowrap class=\"mainmenu\">";

if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true")
{
$fnu="index.php?kam=logoff&logodh=true&uziv=&hesl=";
$popt="Odhlášení ( $Jmeno_r )";
}
else
{
$fnu="index.php?kam=login";
$popt="Pøihlášení";
}
echo
"<table border=\"0\" cellspacing=\"0\">
<tr>
<td class=\"mainmenu\">
<a href=\"$fnu\" class=\"mainmenu\"><img src=\"images/icon_mini_login.gif\" border=\"0\" alt=\Pøihlášení\"></a>
</td>
<td class=\"mainmenu\" style=\"padding-right: 7px\">
<a href=\"$fnu\" class=\"mainmenu\">$popt</a>
</td>
</tr>
</table>

</td>

</tr>
</table>
</td>

</tr>
</table>

<br>

<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\">
<tr>
<td align=\"left\" valign=\"bottom\">
<span class=\"gensmall\">";
if(Empty($kam))
{
print "Právì je ".datum();
}
echo 
"</span>

<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
<tr>
<td align=\"left\">
<span class=\"nav\">$cest</span>
</td>
</tr>
</table>
</td>

</tr>
</table>";

if(!Empty($kam))
{require "$kam.php";}
else
{require "hlavni.php";}

echo
"$admin
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

</div>
</td>
</tr>
</table>

</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
</table>

</body>
</html>";

//print "$uziv $hesl";

//<SCRIPT LANGUAGE=\"JavaScript\" src=\"cookies.js\"></SCRIPT>
/*
</head>
<body>

</body>
</html>
*/
?>
