<?
include_once "administrace/funkce.php";

if (!Empty($_POST["jmeno"]) && !Empty($_POST["pass"]) && (LogAdmin("administrace", $_POST["jmeno"], $_POST["pass"], 0) == "true1" || LogAdmin("administrace", $_POST["jmeno"], $_POST["pass"], 0) == "true0"))
{
  SetCookie("R_jmeno", $_POST["jmeno"], Time() + 31536000);
  SetCookie("R_heslo", $_POST["pass"], Time() + 31536000);
  SetCookie("R_ID", LogAdmin("administrace", $_POST["jmeno"], $_POST["pass"], 1), Time() + 31536000);
}
  else
{
  if (!Empty($_GET["kam"]) && $_GET["kam"] == "admin")
  {
    SetCookie("R_jmeno", "");
    SetCookie("R_heslo", "");
    SetCookie("R_ID", "");
  }
}

if (!Empty($_GET["kam"]) && $_GET["kam"] == "vzkazy" && !Empty($_GET["akce"]) && $_GET["akce"] == "logoff")
{
  SetCookie("R_jmeno", "");
  SetCookie("R_heslo", "");
  SetCookie("R_ID", "");

  $log =
  "<meta http-equiv=\"refresh\" content=\"0;URL=index.php?kam=vzkazy\">"; //popř glogální proměnnou!
}

if (!Empty($_GET["kam"]) && $_GET["kam"] == "inzerce" && !Empty($_GET["akce"]) && $_GET["akce"] == "logoff")
{
  SetCookie("R_jmeno", "");
  SetCookie("R_heslo", "");
  SetCookie("R_ID", "");

  $log =
  "<meta http-equiv=\"refresh\" content=\"0;URL=index.php?kam=inzerce\">"; //popř glogální proměnnou!
}

if (!Empty($_GET["kam"]) && $_GET["kam"] == "admin" && !Empty($_GET["akce"]) && $_GET["akce"] == "logoff")
{
  SetCookie("R_jmeno", "");
  SetCookie("R_heslo", "");
  SetCookie("R_ID", "");

  $log =
  "<meta http-equiv=\"refresh\" content=\"0;URL=index.php?kam=admin\">"; //popř glogální proměnnou!
}

echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
{$log}
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<meta name=\"keywords\" content=\"rybolov, lov, rybník, sportovní rybolov, kapr, restaurace, penzion, ubytování, chyť a pusť, outdoor, balaton, rybník balaton\">
<title>Rybník Balaton - Rybářská bašta</title>
<script language=\"javascript\" type=\"text/javascript\">AC_FL_RunContent = 0;</script>
<script src=\"AC_RunActiveContent.js\" language=\"javascript\" type=\"text/javascript\"></script>
<style type=\"text/css\" media=\"all\">

body {
  color: #000000;
  background-image : url(obr/pozadi.png);
}

font,td { font-family: Trebuchet MS, Arial; font-weight : bold;}
p, td { font-size : 16px; }

td.pole_jezdici_text {
  background-image: url(obr/4_1_2.jpg);
  background-repeat: no-repeat;
}

td.pozadi_obsah {
  background-image: url(obr/pozadi_obsah.jpg);
  background-repeat: repeat-y;
}

td.pole_datum_hodiny {
  background-image: url(obr/7_2.jpg);
  background-repeat: no-repeat;
  font-family: Trebuchet MS;
  font-weight : bold;
  font-size : 11px;
  color: #000000;
}

td.pozadi_pod_menu_opakujici {
  background-image: url(obr/pozadi_pod_menu_opakujici.jpg);
  background-repeat: repeat-y;
}

td.pozadi_bezici_text {
  background-image: url(obr/pozadi_bezici_text.jpg);
  background-repeat: no-repeat;
}

td.upozorneni_flash {
  font-family: Trebuchet MS;
  font-weight : bold;
  font-size : 11;
  color: lime;
  filter: glow(color=blue, strength=3);
}

td.nadpis_onas {
  font-weight: bold;
  font-size: 19px;
  text-decoration: underline;
  font-family: Trebuchet MS;
  letter-spacing : 0.07em;
}

td.centralni_nadpis {
  color: white;
  font-size: 26px;
  text-decoration: underline;
  font-family: Arial Black;
  letter-spacing: 0.07em;
  filter: glow(color=#4592C1, strength=12);
}

td.gps_text {
  filter: glow(color=#4592C1, strength=6);
  color: white;
}

hr {
  color: #5E7734;
}

img {
  border-left-color:black;
  border-bottom-color:black;
  border-top-color:black;
  border-right-color:black;
}

#odkaz {
  color: white;
}

td.barva_tabulky_ceny {
  background-color: #007CB2;
  color: white;
}

td.barva_tabulky_vnitrek_ceny {
  background-color: #94BEE5;
  color: #000000;
}

td.pole_toplist {
  background-image: url(obr/9_2.jpg);
  background-repeat: no-repeat;
}

marquee {
 font-family: Trebuchet MS, Verdana, Helvetica;
 font-weight : bold;
 font-size : 18;
 color: #FFFFFF;
}

td.text_kontakt {
  font-weight : bold;
}

td.pocasi_dny {
  background-image: url(obr/pozadi_pro_pocasi.jpg);
  background-repeat: no-repeat;
}

td.prechod_tabulka_001 {
  background-image: url(obr/prechod_tabulka_001.jpg);
}

td.prechod_tabulka_002 {
  background-image: url(obr/prechod_tabulka_002.jpg);
  color: white;
}

td.prechod_tabulka_003 {
  background-image: url(obr/prechod_tabulka_003.jpg);
  color: white;
}

td.prechod_tabulka_004 {
  background-image: url(obr/prechod_tabulka_004.jpg);
  color: black;
}

td.prechod_tabulka_005 {
  background-image: url(obr/prechod_tabulka_005.jpg);
  color: white;
}

td.prechod_tabulka_006 {
  background-image: url(obr/prechod_tabulka_006.jpg);
  color: white;
}

td.prechod_tabulka_007 {
  background-image: url(obr/prechod_tabulka_007.jpg);
  color: white;
}

td.prechod_tabulka_008 {
  background-image: url(obr/prechod_tabulka_008.jpg);
  color: white;
}

td.prechod_tabulka_009 {
  background-image: url(obr/prechod_tabulka_009.jpg);
  color: white;
}

td.prechod_tabulka_010 {
  background-image: url(obr/prechod_tabulka_010.jpg);
  color: white;
}

td.prechod_tabulka_011 {
  background-image: url(obr/prechod_tabulka_011.jpg);
  color: white;
}

td.prechod_tabulka_012 {
  background-image: url(obr/prechod_tabulka_012.jpg);
  color: white;
}

input.prechod_tabulka_input {
  background-image: url(obr/prechod_tabulka_input.jpg);
  color: black;
  border-color: #4589BE #22445F #22445F #4589BE;
  font-size: 14px;
}

textarea {
  background-image: url(obr/prechod_tabulka_textarea.jpg);
  color: white;
}

td.prechod_tabulka_004_cas {
  background-image: url(obr/prechod_tabulka_004.jpg);
  color: black;
  font-size: 12px;
}

td.prechod_tabulka_aktualita {
  background-image: url(obr/prechod_tabulka_textarea.jpg);
  color: white;
}

td.prechod_tabulka_002_maly_font {
  background-image: url(obr/prechod_tabulka_004.jpg);
  color: black;
  font-size: 14px;
}

td.vzkazy_jmeno_email_uzivatel {
  color: black;
  background-image: url(obr/prechod_tabulka_001.jpg);
}

td.vzkazy_datum_cas_uzivatel {
  background-image: url(obr/prechod_tabulka_004.jpg);
  color: black;
  font-size: 12px;
}

td.vzkazy_text_uzivatel {
  background-image: url(obr/prechod_tabulka_textarea.jpg);
  color: white;
}

td.vzkazy_jmeno_email_admin {
  color: #AA0000;
  background-image: url(obr/prechod_tabulka_001.jpg);
}

td.vzkazy_datum_cas_admin {
  background-image: url(obr/prechod_tabulka_004.jpg);
  color: black;
  font-size: 12px;
}

td.vzkazy_text_admin {
  color: orange;
  background-image: url(obr/prechod_tabulka_textarea.jpg);
}

td.prechod_tabulka_fotografie {
  color: white;
  background-image: url(obr/prechod_tabulka_fotografie.jpg);
  font-size: 14px;
}

td.fotografie_tabulka {
  color: white;
  font-size: 14px;
}

td.prechod_tabulka_akce {
  color: white;
  background-image: url(obr/prechod_tabulka_akce.jpg);
}

td.vel1 {
  font-size: 20px;
  text-decoration: underline;
  color: white;
}

td.akce_font {
  color: white;
}

td.akce_pozadi_obrazek {
  background-color: white;
}

td.prechod_tabulka_download {
  color: white;
  background-image: url(obr/prechod_tabulka_download.jpg);
}

td.font_tabulka_download {
  color: white;
  font-size: 14px;
}

td.prechod_tabulka_vtipy {
  color: white;
  background-image: url(obr/prechod_tabulka_vtipy.jpg);
}

td.prechod_tabulka_vtipy_001 {
  background-image: url(obr/prechod_tabulka_001.jpg);
  color: black;
}

td.prechod_tabulka_vtipy_002 {
  background-image: url(obr/prechod_tabulka_004.jpg);
  color: black;
}

img {
  border-color: #3886C6;
}

img.foto {
  border-color: #25548A;
}

#prvni_logo_1 a {
    display: block;
    width: 146px;
    height: 167px;
    background-image: url(obr/prvni_logo_1.jpg);
    background-repeat: no-repeat;
}
#prvni_logo_1 a:hover {
    border: none;
    background-position: -146px 0;
}

#druhe_logo_1 a {
    display: block;
    width: 174px;
    height: 167px;
    background-image: url(obr/druhe_logo_1.jpg);
    background-repeat: no-repeat;
}
#druhe_logo_1 a:hover {
    border: none;
    background-position: -174px 0;
}

#treti_logo_1 {
    display: block;
    width: 280px;
    height: 167px;
}
#treti_logo_1 a {
  display: block;
  border: none;
  outline: none;
  width: 280px;
}

#treti_logo_1 a#odkaz_superklik {
  height: 78px;
  background: url(obr/logo_supreklik.png) no-repeat left top;
}

#treti_logo_1 a#odkaz_redfish {
  height: 89px;
  background: url(obr/logo_redfish.png) no-repeat left top;
}

#treti_logo_1 a#odkaz_superklik:hover,
#treti_logo_1 a#odkaz_redfish:hover {
  background-position: right;
}

#menu_001 a {
    display: block;
    width: 228px;
    height: 26px;
    background-image: url(obr/menu_001.jpg);
    background-repeat: no-repeat;
}
#menu_001 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_002 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_002.jpg);
    background-repeat: no-repeat;
}
#menu_002 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_002 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_002.jpg);
    background-repeat: no-repeat;
}
#menu_002 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_003 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_003.jpg);
    background-repeat: no-repeat;
}
#menu_003 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_004 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_004.jpg);
    background-repeat: no-repeat;
}
#menu_004 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_005 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_005.jpg);
    background-repeat: no-repeat;
}
#menu_005 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_006 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_006.jpg);
    background-repeat: no-repeat;
}
#menu_006 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_007 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_007.jpg);
    background-repeat: no-repeat;
}
#menu_007 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_008 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_008.jpg);
    background-repeat: no-repeat;
}
#menu_008 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_009 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_009.jpg);
    background-repeat: no-repeat;
}
#menu_009 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_010 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_010.jpg);
    background-repeat: no-repeat;
}
#menu_010 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_011 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_011.jpg);
    background-repeat: no-repeat;
}
#menu_011 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_012 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_012.jpg);
    background-repeat: no-repeat;
}
#menu_012 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_013 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_013.jpg);
    background-repeat: no-repeat;
}
#menu_013 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_014 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_014.jpg);
    background-repeat: no-repeat;
}
#menu_014 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_015 a {
    display: block;
    width: 228px;
    height: 27px;
    background-image: url(obr/menu_015.jpg);
    background-repeat: no-repeat;
}
#menu_015 a:hover {
    border: none;
    background-position: -228px 0;
}

#menu_016 a {
    display: block;
    width: 228px;
    height: 26px;
    background-image: url(obr/menu_016.jpg);
    background-repeat: no-repeat;
}
#menu_016 a:hover {
    border: none;
    background-position: -228px 0;
}

#kokot a {
  color: white;
  font-size: 14px;
}

#kokot a:hover {
  color: orange;
}

#tabulka_rybky {
  width: 500px;
}

#tabulka_rybky td {
  border: 2px solid #d0dcea;
  padding: 3px;
  text-align: center;
}

#tabulka_rybky tr {
  background-image: url(obr/prechod_tabulka_textarea.jpg);
  background-position: left top;
  color: white;
}

#tabulka_rybky tr.prvni {
  background-image: url(obr/prechod_tabulka_001.jpg);
  color: black;
}

#tabulka_rybky tr.prvni td {
  border-color: #3886C6;
}

#tabulka_rybky tr.prvni td.obrazek_tabulka {
  background: none;
}


#tabulka_rybky tr.odtuceni_zespodu td {
  border-bottom: 1px solid #d0dcea;
}

#tabulka_rybky tr.odtuceni_zvrchu td {
  border-top: 1px solid #d0dcea;
}

#tabulka_rybky .obrazek_tabulka,
#tabulka_rybky tr.odtuceni_zespodu td.obrazek_tabulka,
#tabulka_rybky tr.odtuceni_zvrchu td.obrazek_tabulka {
  border: none;
}

#tabulka_rybky .obrazek_lin,
#tabulka_rybky .obrazek_perlin,
#tabulka_rybky .obrazek_karas,
#tabulka_rybky .obrazek_zralok {
  width: 130px;
  height: 57px;
  background: url(obr/lin.png) no-repeat center;
}

#tabulka_rybky .obrazek_perlin {
  background: url(obr/perlin.png) no-repeat center;
}

#tabulka_rybky .obrazek_karas {
  background: url(obr/karas.png) no-repeat center;
}

#tabulka_rybky .obrazek_zralok {
  background: none;
}

#tabulka_rybky .mensi_border_left {
  border-left: 1px solid #d0dcea;
}

#tabulka_rybky .mensi_border_right {
  border-right: 1px solid #d0dcea;
}


#tabulka_rybky .mensi_border_left_right {
  border-right: 1px solid #d0dcea;
  border-left: 1px solid #d0dcea;
}

</style>

</head>
<body>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"968px\">
<tr>
<td colspan=\"2\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td><img src=\"obr/logo_001.png\" border=\"0\" alt=\"\"></td>
<td><img src=\"obr/logo_002.jpg\" border=\"0\" alt=\"\"></td>
<td><img src=\"obr/logo_003.jpg\" border=\"0\" alt=\"\"></td>
<td><img src=\"obr/logo_004.jpg\" border=\"0\" alt=\"\"></td>
<td><img src=\"obr/logo_005.jpg\" border=\"0\" alt=\"\"></td>
<td><img src=\"obr/logo_006.png\" border=\"0\" alt=\"\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td valign=\"top\" class=\"pozadi_pod_menu_opakujici\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td><span id=\"menu_001\"><a href=\"index.php?kam=uvod\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_002\"><a href=\"index.php?kam=onas\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_003\"><a href=\"index.php?kam=aktuality\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_004\"><a href=\"index.php?kam=restaurace\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_005\"><a href=\"index.php?kam=vzkazy\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_006\"><a href=\"index.php?kam=foto\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_007\"><a href=\"index.php?kam=mapa\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_008\"><a href=\"index.php?kam=ceny\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_009\"><a href=\"index.php?kam=rad\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_010\"><a href=\"index.php?kam=akce\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_011\"><a href=\"index.php?kam=outdoor\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_012\"><a href=\"index.php?kam=download\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_013\"><a href=\"index.php?kam=fun\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_014\"><a href=\"index.php?kam=rybky\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_015\"><a href=\"index.php?kam=pocasi\"></a></span></td>
</tr>
<tr>
<td><span id=\"menu_016\"><a href=\"index.php?kam=admin\"></a></span></td>
</tr>
</table>
</td>
</tr>
<tr>
<td><img src=\"obr/kapr_pod_menu.jpg\" border=\"0\" alt=\"\"></td>
</tr>
<tr>
<td><img src=\"obr/6_1.jpg\" border=\"0\" alt=\"\"></td>
</tr>
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td><img src=\"obr/7_1.jpg\" border=\"0\" alt=\"\"></td>
<td class=\"pole_datum_hodiny\" width=\"165px\" height=\"32px\" align=\"center\">Dnes je: ".Date("j.n. Y")."<br>Váš příchod v: ".Date("G:i")."</td>
<td><img src=\"obr/7_3.jpg\" border=\"0\" alt=\"\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td><img src=\"obr/8_1.jpg\" border=\"0\" alt=\"\"></td>
</tr>
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td><img src=\"obr/9_1.jpg\" border=\"0\" alt=\"\"></td>
<td class=\"pole_toplist\" width=\"88px\" height=\"60px\"><img src=\"http://toplist.cz/count.asp?id=637669&amp;logo=mc\" alt=\"Rybník Balaton - Rybářská bašta\" border=\"0\"></td>
<td><img src=\"obr/9_3.jpg\" border=\"0\" alt=\"\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td><img src=\"obr/10_1.jpg\" border=\"0\" alt=\"\"></td>
</tr>
</table>
</td>
<td valign=\"top\" align=\"left\" class=\"pozadi_obsah\">
";

  $kam = $_GET["kam"];
  $default = "uvod.php";
  if (!Empty($kam))
  {
    if (file_exists("{$kam}.php"))
    {
      include_once "{$kam}.php";
    }
      else
    {
      include_once $default;
    }
  }
    else
  {
    include_once $default;
  }

echo
"</td>
</tr>
<tr>
<td colspan=\"2\"><img src=\"obr/spodek_lista.png\" border=\"0\" alt=\"\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>".podpisy_animace()."</td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"upozorneni_flash\">Stránky vyžadují podporu Adobe Flash. V případě, že se vám stránky nezobrazily, použijte <a href=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\" target=\"_blank\" id=\"odkaz\">tento odkaz</a></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<script type=\"text/javascript\">
var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
</script>
<script type=\"text/javascript\">
try {
var pageTracker = _gat._getTracker(\"UA-8011284-1\");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>";
?>
