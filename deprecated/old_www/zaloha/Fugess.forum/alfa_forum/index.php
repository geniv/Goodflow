<?
include "funkce.php"; //funkce v�eho

banovani($REMOTE_ADDR);

if(!Empty($kam)){hlavni_logovani($kam,$REMOTE_ADDR);}

if(!Empty($logof) and $logof=="true")
{
SetCookie("Jmeno_r","",Time()+3600);
SetCookie("Heslo_r","",Time()+3600);
}

if(!Empty($uziv) and !Empty($hesl))
{
$st=login($uziv,$hesl);
logovani_prihlasovani($uziv,$hesl,$REMOTE_ADDR,$st);

if($st=="true")
{
SetCookie("Jmeno_r",$uziv,Time()+3600);
SetCookie("Heslo_r",$hesl,Time()+3600);
}//end if st=true

}
//print_r($HTTP_COOKIE_VARS);//test
echo 
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<title>Fugessovo f�rum</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<link rel=\"stylesheet\" href=\"Cobalt.css\" type=\"text/css\">
</head>
<body bgcolor=\"#0071AE\" text=\"#FFFFFF\" link=\"#FFFFFF\" vlink=\"#9CCEFF\">";
?>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
<tr>

<td width="0%" class="mainboxLefttop"><img src="images/spacer.gif" width="6" height="6"></td>

<td width="100%" class="mainboxTop"><img src="images/spacer.gif" width="6" height="6"></td>

<td width="0%" class="mainboxRighttop"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>

<tr>
<td width="0%" class="mainboxLeft">
<img src="images/spacer.gif" width="6" height="6">
</td>

<td width="100%" class="mainbox">
<table width="100%" cellpadding="16" border="0">
<tr>
<td>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>

<td valign="top">
<a href="index.php"><img src="images/logo_fugess.jpg" border="0" alt="Obsah f�ra phpBB.cz:Templates" vspace="1" width="224" height="96"></a>
</td>

<td align="center" width="100%" valign="top">
<span class="maintitle">Fugessovo f�rum</span>
<br>
<span class="gen">Trainz Railroad Simulator 2004 / 2006, Grafika, Elektro</span>
<br><br>

<table border="0" cellpadding="0">
<tr>

<td align="center" valign="middle" nowrap class="mainmenu">

<table border="0" cellspacing="0">
<tr>
<td>
<a href="index.php?kam=hledani"><img src="images/icon_mini_search.gif" border="0" alt="Hledat"></a>
</td>
<td style="padding-right: 7px" class="mainmenu">
<a href="index.php?kam=hledani">Hledat</a>
</td> 
</tr>
</table>
</td>

<td align="center" valign="middle" nowrap class="mainmenu">

<table border="0" cellspacing="0">
<tr>
<td>
<a href="index.php?kam=uzivatele"><img src="images/icon_mini_members.gif" border="0" alt="Seznam u�ivatel�"></a>
</td>
<td style="padding-right: 7px" class="mainmenu">
<a href="index.php?kam=uzivatele">Seznam u�ivatel�</a>
</td>
</tr>
</table>
</td>

<td align="center" valign="middle" nowrap class="mainmenu">

<table border="0" cellspacing="0">
<tr>
<td>
<a href="index.php?kam=skupiny"><img src="images/icon_mini_groups.gif" border="0" alt="U�ivatelsk� skupiny"></a>
</td>
<td style="padding-right: 7px" class="mainmenu">
<a href="index.php?kam=skupiny">U�ivatelsk� skupiny</a>
</td>
</tr>
</table>
</td>

<td align="center" valign="middle" nowrap class="mainmenu">
<?
if(Empty($Jmeno_r) and Empty($Heslo_r))
{
echo   
"<table border=\"0\" cellspacing=\"0\">
<tr>
<td>
<a href=\"index.php?kam=registrace\"><img src=\"images/icon_mini_register.gif\" border=\"0\" alt=\"Registrace\"></a>
</td>
<td style=\"padding-right: 7px\" class=\"mainmenu\">
<a href=\"index.php?kam=registrace\">Registrace</a>
</td>
</tr>
</table>";
}
?>
</td>

</tr>
</table>

<table border="0" cellpadding="0">
<tr>
<td align="center" class="mainmenu" valign="middle" nowrap class="mainmenu">

<table border="0" cellspacing="0">
<tr>
<td class="mainmenu">
<a href="index.php?kam=profil" class="mainmenu"><img src="images/icon_mini_profile.gif" border="0" alt="Profil"></a>
</td>
<td class="mainmenu" style="padding-right: 7px">
<a href="index.php?kam=profil" class="mainmenu">Profil</a>
</td>
</tr>
</table>
</td>

<td align="center" class="mainmenu" valign="middle" nowrap class="mainmenu">

<table border="0" cellspacing="0">
<tr>
<td class="mainmenu">
<a href="index.php?kam=inbox" class="mainmenu"><img src="images/icon_mini_message.gif" border="0" alt="Soukrom� zpr�vy"></a>
</td>
<td class="mainmenu" style="padding-right: 7px">
<a href="index.php?kam=inbox" class="mainmenu">Soukrom� zpr�vy</a>
</td>
</tr>
</table>
</td>

<td align="center" class="mainmenu" valign="middle" nowrap class="mainmenu">
<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r))
{
$fnu="index.php?kam=logoff&logof=true&uziv=&hesl=&autologin=";
$popt="Odhl�en� ( $Jmeno_r )";
}
else
{
$fnu="index.php?kam=login";
$popt="P�ihl�en�";
}
echo
"<table border=\"0\" cellspacing=\"0\">
<tr>
<td class=\"mainmenu\">
<a href=\"$fnu\" class=\"mainmenu\"><img src=\"images/icon_mini_login.gif\" border=\"0\" alt=\P�ihl�en�\"></a>
</td>
<td class=\"mainmenu\" style=\"padding-right: 7px\">
<a href=\"$fnu\" class=\"mainmenu\">$popt</a>
</td>
</tr>
</table>";
?>
</td>

</tr>
</table>
</td>

</tr>
</table>

<br>

<? //dod�ltat na podm�nku
echo 
"<table width=\"100%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\" align=\"center\">
<tr>
<td align=\"left\" valign=\"bottom\"><span class=\"gensmall\">";
if(Empty($kam))
{
print datum();
}
echo "
<BR>
</span>

<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
<tr>
<td align=\"left\">
<span class=\"nav\">
<A href=\"index.php\" class=\"nav\">Testovac� f�rum</a>
</span>
</td>
</tr>
</table>

</td>
<td align=\"right\" valign=\"bottom\" class=\"gensmall\">

&nbsp;

</td>
</tr>
</table>";
?>

<br>
<!--vr�ek-->
<?
if(!Empty($kam))
{
include "$kam.php";
}
else
{
include "hlavni.php";
}
?>

<!--spodek-->
<center>
<br>
<span class="copyright">
Programming <a href="http://geniv.wu.cz/" target="_blank" class="copyright">Geniv</a> &copy; 2007
</span>
<br>
<span class="copyright">
Design & Testing <a href="http://fugess.trainz.cz/" target="_blank" class="copyright">Fugess</a> &copy; 2007
</span>
<br>
--- nepodporujeme zasran� phpBB ---
<br>
</center>

</div>

</td>
</tr>
</table>

</td>
<td width="0%" class="mainboxRight"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>
<tr>
<td width="0%" class="mainboxLeftbottom"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="100%" valign="top" class="mainboxBottom"><img src="images/spacer.gif" width="6" height="6"></td>
<td width="0%" class="mainboxRightbottom"><img src="images/spacer.gif" width="6" height="6"></td>
</tr>
</table>

</body>
</html>
<?
//print "$uziv $hesl";

//<SCRIPT LANGUAGE=\"JavaScript\" src=\"cookies.js\"></SCRIPT>
/*
</head>
<body>

</body>
</html>
*/
?>