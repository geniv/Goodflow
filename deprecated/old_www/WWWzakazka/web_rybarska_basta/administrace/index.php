<?
include_once "funkce.php";

if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<title>Rybník Balaton - Rybářská bašta - Administrace</title>
<script language=\"javascript\">AC_FL_RunContent = 0;</script>
<script src=\"../AC_RunActiveContent.js\" language=\"javascript\"></script>
</head>
<body>
<style type=\"text/css\">
<!--

body {
	color: #000000;
	margin-top : 0px ! important;
	margin-left : 0px ! important;
	margin-right : 0px ! important;
	margin-bottom : 0px ! important;
	background-image: url(../obr/pozadi.png);
}

font,td { font-family: Trebuchet MS, Arial;	font-weight : bold;}
p, td { font-size : 16px; }

td.pole_jezdici_text {
	background-image: url(../obr/4_1_2.jpg);
	background-repeat: no-repeat;
}

td.pozadi_obsah {
	background-image: url(../obr/pozadi_obsah.jpg);
	background-repeat: repeat-y;
}

td.pole_datum_hodiny {
	background-image: url(../obr/7_2.jpg);
	background-repeat: no-repeat;
	font-family: Trebuchet MS;
  font-weight : bold;
  font-size : 11px;
  color: #000000;
}

td.pozadi_pod_menu_opakujici {
	background-image: url(../obr/pozadi_pod_menu_opakujici.jpg);
	background-repeat: repeat-y;
}

td.pozadi_bezici_text {
	background-image: url(../obr/pozadi_bezici_text.jpg);
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
  color: white;
  height: 3px;
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
	background-image: url(../obr/9_2.jpg);
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
	background-image: url(../obr/pozadi_pro_pocasi.jpg);
	background-repeat: no-repeat;
}

td.prechod_tabulka_001 {
	background-image: url(../obr/prechod_tabulka_001.jpg);
}

td.prechod_tabulka_002 {
	background-image: url(../obr/prechod_tabulka_002.jpg);
	color: white;
}

td.prechod_tabulka_003 {
	background-image: url(../obr/prechod_tabulka_003.jpg);
	color: white;
}

td.prechod_tabulka_004 {
	background-image: url(../obr/prechod_tabulka_004.jpg);
	color: black;
}

td.prechod_tabulka_005 {
	background-image: url(../obr/prechod_tabulka_005.jpg);
	color: white;
}

td.prechod_tabulka_006 {
	background-image: url(../obr/prechod_tabulka_006.jpg);
	color: white;
}

td.prechod_tabulka_007 {
	background-image: url(../obr/prechod_tabulka_007.jpg);
	color: white;
}

td.prechod_tabulka_008 {
	background-image: url(../obr/prechod_tabulka_008.jpg);
	color: white;
}

td.prechod_tabulka_009 {
	background-image: url(../obr/prechod_tabulka_009.jpg);
	color: white;
}

td.prechod_tabulka_010 {
	background-image: url(../obr/prechod_tabulka_010.jpg);
	color: white;
}

td.prechod_tabulka_011 {
	background-image: url(../obr/prechod_tabulka_011.jpg);
	color: white;
}

td.prechod_tabulka_012 {
	background-image: url(../obr/prechod_tabulka_012.jpg);
	color: white;
}

input.prechod_tabulka_input {
	background-image: url(../obr/prechod_tabulka_input.jpg);
	color: black;
	border-color: #4589BE #22445F #22445F #4589BE;
	font-size: 14px;
}

textarea {
	background-image: url(../obr/prechod_tabulka_textarea.jpg);
	color: white;
}

td.prechod_tabulka_004_cas {
	background-image: url(../obr/prechod_tabulka_004.jpg);
	color: black;
	font-size: 12px;
}

td.prechod_tabulka_004_uzivatele {
	background-image: url(../obr/prechod_tabulka_004.jpg);
	color: black;
}

td.prechod_tabulka_aktualita {
	background-image: url(../obr/prechod_tabulka_textarea.jpg);
	color: white;
}

td.prechod_tabulka_002_maly_font {
	background-image: url(../obr/prechod_tabulka_004.jpg);
	color: black;
	font-size: 14px;
}

td.vzkazy_jmeno_email_uzivatel {
  color: black;
	background-image: url(../obr/prechod_tabulka_001.jpg);
}

td.vzkazy_datum_cas_uzivatel {
	background-image: url(../obr/prechod_tabulka_004.jpg);
	color: black;
	font-size: 12px;
}

td.vzkazy_text_uzivatel {
	background-image: url(../obr/prechod_tabulka_textarea.jpg);
	color: white;
}

td.vzkazy_jmeno_email_admin {
  color: #AA0000;
	background-image: url(../obr/prechod_tabulka_001.jpg);
}

td.vzkazy_datum_cas_admin {
	background-image: url(../obr/prechod_tabulka_004.jpg);
	color: black;
	font-size: 12px;
}

td.vzkazy_text_admin {
  color: orange;
	background-image: url(../obr/prechod_tabulka_textarea.jpg);
}

td.prechod_tabulka_fotografie {
  color: white;
	background-image: url(../obr/prechod_tabulka_fotografie.jpg);
  font-size: 14px;
}

td.fotografie_tabulka {
  color: white;
  font-size: 14px;
}

td.prechod_tabulka_akce {
  color: white;
	background-image: url(../obr/prechod_tabulka_akce.jpg);
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
	background-image: url(../obr/prechod_tabulka_download.jpg);
}

td.font_tabulka_download {
  color: white;
  font-size: 14px;
}

td.prechod_tabulka_vtipy {
  color: white;
	background-image: url(../obr/prechod_tabulka_vtipy.jpg);
}

td.pozadi_admin {
	background-image: url(../obr/pozadi_admin.jpg);
	color: black;
}

a, a:active, a:visited {
	color : black;
	text-decoration: underline;
}

a:hover {
  color: white;
}

li {
	background-image: url(../obr/prechod_tabulka_004.jpg);
}

td.li {
	background-image: url(../obr/prechod_tabulka_004.jpg);
}

td.li_nadpis {
	background-image: url(../obr/prechod_tabulka_004.jpg);
  font-size: 22px;
	text-decoration: underline;
}

td.sekce_nadpis {
  font-size: 22px;
  text-decoration: underline;
}

td.sekce_podnadpis {
  font-size: 20px;
  text-decoration: underline;
}

td.sekce_text {
  font-size: 14px;
}

td.uvod_rozdily {
  font-size: 12px;
}

img {
  border-color: #3886C6;
}

</style>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" height=\"100%\" width=\"100%\">
  <tr>
    <td width=\"100%\" align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td class=\"pozadi_admin\" width=\"100%\" align=\"center\" valign=\"top\">
<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\" borderColorDark=\"black\" borderColorLight=\"black\">
  <tr>
    <td width=\"200px\" align=\"center\" valign=\"top\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" class=\"li_nadpis\" colspan=\"3\">Menu</td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"center\" class=\"li\" colspan=\"3\" height=\"20px\"><hr></td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"../\" target=\"_blank\"><li>Náhled&nbsp;na&nbsp;stránky</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=uvod\"><li>Úvodní&nbsp;strana</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=marque\"><li>Jezdící&nbsp;texty</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=jidelnicek\"><li>Jídelníček</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=ubytovani\"><li>Ceny&nbsp;ubytování</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=aktuality\"><li>Aktuality</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=restaurace\"><li>Otevírací&nbsp;doba</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=fotografie\"><li>Fotografie</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=out\"><li>Outdoor&nbsp;ceník</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=povolenky\"><li>Ceny&nbsp;povolenek</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=akce\"><li>Akce</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=vtipy\"><li>Vtipy</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=uzivatele\"><li>Uživatelé</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=rybky\"><li>Rybky</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=download\"><li>ke stažení</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"index.php?kam=soubory\"><li>Soubory&nbsp;z&nbsp;FTP</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
    <td align=\"left\"><a href=\"../index.php?kam=admin&akce=logoff\"><li>Odhlásit&nbsp;se</a></td>
    <td align=\"left\" class=\"li\">&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"center\" class=\"li\" colspan=\"3\" height=\"20px\"><hr></td>
  </tr>
</table>
    </td>
    <td align=\"center\" valign=\"top\">";

  $default = "uvod.php";
  $kam = $_GET["kam"];
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
    /*
    if (Empty($kam))
    {
      require "uvod.php";
    }
      else
    {
      if (!Empty($kam) and KontrolaKamAdmin(".", $kam) == "true")
      {
        require "$kam.php";
      }
        else
      {
        require "uvod.php";
      }
    }
    */
    echo
    "</td>
  </tr>
</table>
    </td>
  </tr>
</table>
    </td>
  </tr>
</table>
</body>
</html>";
}
  else
{
  echo HlaskaVypadni(".");
}
?>
