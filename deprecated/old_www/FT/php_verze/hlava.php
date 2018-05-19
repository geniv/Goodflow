<?
$sb_ban="bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php";
$uk=fopen($sb_ban,"r");
$nezadouci_ip=explode("#b*",fread($uk,1000000));
fclose($uk);
            
for($i=0;$i<count($nezadouci_ip);$i++)
{   
if ($nezadouci_ip[$i]==$REMOTE_ADDR) 
{  
require "ban/ban.php";
exit;                  
}}                        
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTH HTML 4.0 Transitional//EN">
<html>
<head>
<?
$tt="";
if(!Empty($kam))
{
switch($kam)
{
case "uvod"; 
  {$tt="Úvod";}
  break;
case "download"; 
  {$tt="Download";}
  break; 
case "navody"; 
  {$tt="Návody";}
  break; 
case "galerie"; 
  {$tt="Galerie";}
  break; 
case "3dgalerie"; 
  {$tt="3D Galerie";}
  break;
case "videogalerie"; 
  {$tt="Video Galerie";}
  break;
case "3danimace"; 
  {$tt="3D Animace";}
  break;
case "zajimavosti"; 
  {$tt="Zajímavosti";}
  break;
case "projekty"; 
  {$tt="Projekty";}
  break;
case "modelovazeleznice"; 
  {$tt="Modelová železnice";}
  break; 
case "ankety"; 
  {$tt="Ankety";}
  break;
case "odpovedi"; 
  {$tt="Otázky a Odpovìdi";}
  break;
case "navsteva"; 
  {$tt="Návštìvní Kniha";}
  break;
case "pocitadla"; 
  {$tt="Poèítadla";}
  break;
case "odkazy"; 
  {$tt="Odkazy";}
  break; 
case "napistemi"; 
  {$tt="Napište mi";}
  break;
case "kontakt"; 
  {$tt="Kontakt";}
  break;
case "admin"; 
  {$tt="Sekce jen pro pøedem urèené lidi";}
  break;
case "adminsetup"; 
  {$tt="Administrace webu";}
  break;
case "dulschoeller"; 
  {$tt="Projekt - Dùl Schoeller";}
  break;
case "rozestavenydum"; 
  {$tt="Projekt - Rozestavìný dùm";}
  break;
case "moravskykrumlov"; 
  {$tt="Projekt - Moravský Krumlov";}
  break;
case "stavedlomoravskykrumlov"; 
  {$tt="Projekt - Stavìdlo Moravský Krumlov";}
  break;
case "vtipne_kreslene_obrazky"; 
  {$tt="Zábavné kreslené obrázky";}
  break;
case "foto_galerie_nadrazi"; 
  {$tt="Foto Galerie - Fotky reálné železnice - Nádraží Bøeclav";}
  break;
case "foto_galerie_prednadrazi"; 
  {$tt="Foto Galerie - Fotky reálné železnice - Pøednádraží Bøeclav";}
  break;
case "ostatni_zajimavosti"; 
  {$tt="Ostatní zajímavosti";}
  break;
case "nastaveni_prihlasovani"; 
  {$tt="Nastavení pøihlašování";}
  break;
}
}
else
 {
 $tt="TRS a Grafika";
 }
echo "<title>Fugess Trainz - $tt</title>";
?>
<META http-equiv="Content-Type"content="text/html; charset=windows-1250">
<SCRIPT LANGUAGE="javascript" src="cookies.js"></SCRIPT>
<meta http-equiv="Content-Language" content="cs">
<META HTTP-EQUIV="EXPIRES" CONTENT="0">
<META NAME="RESOURCE-TYPE" CONTENT="DOCUMENT">
<META NAME="DISTRIBUTION" CONTENT="GLOBAL">
<META NAME="AUTHOR" CONTENT="Fugess">
<META NAME="COPYRIGHT" CONTENT="Copyright (c) 2006-2007 by Fugess">
<META NAME="KEYWORDS" CONTENT="Fugess, Fugesss, Fugessovy stránky, Fugessùv web, Fugessovy objekty, Fugessovy 3D objekty, Download Fugess, 3D Download, 3D download, 3D Downloads, 3D downloads, CDP, cdp, Trainz, trainz, trains, Trans, Czech Trainz, czech trainz, Czech Trainz Team, czech trainz team, jeditrainz team, jtt, real trains, real trainz, virtual trainz, virtual trains, model trains, model trainz, 3D building, Trainz Simulator, TRS simulator, èeské modely, èeské 3D modely, èeský TRS tým, èeský trainz tým, 3D modely, stavba v 3D, stavba 3D, GMAX, gmax, 3Dmax, 3Dsmax, 3D studio max, 3D max studio, 3D">
<META NAME="DESCRIPTION" CONTENT="Fugess web - Trainz Railroad Simulator">
<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<META NAME="REVISIT-AFTER" CONTENT="1 DAYS">
<META NAME="RATING" CONTENT="GENERAL">
</head>
<style>
body,table,center
{
background: #A8ACB8;
font-family: Trebuchet MS, Courier, Courier New, sans-serif, verdana;
font-size: 14px;
font-weight: bold;
color: black;
}
#vel_a
{
font-size: 20px;
}
#vel_b
{
font-size: 12px;
}
#vel_c
{
font-size: 10px;
}
#vel_d
{
font-size: 9px;
}
#vel_e
{
font-size: 12px;
background: #B6BCC3;
}
#vel_ank_a
{
font-size: 12px;
}
#otz_odp_barv
{
color: navy;
}
#otz_odp_barv_a
{
color: #004080;
}
#nav_kni_barv
{
color: #5A5A5A;
}
#barv_tab_poz
{
background: #B6BCC3;
}
#podt_v_as
{
text-decoration: underline;
color: blue;
}
#upoz_ota_nav
{
text-decoration: overline underline;
color: maroon;
}
#gal_vi_down
{
text-decoration: underline;
color: blue;
cursor: hand;
font-size: 12px;
background: #B6BCC3;
}
#uvod_info_ozn
{
text-decoration: underline;
}
#down_aktualiz
{
color: navy;
text-decoration: underline;
}
</style>
<body>
<? //tabulka - nadpis ?>
<TABLE align="center" border="0" cellspacing="0" cellpadding="0">
<TR><TD><img src="nadpis.gif"></TD></TR>
</TABLE>

<? //tabulka - menu ?>
<table border=0 align=center height=600px>
<tr>
<td valign="top">
<? require "menu.php"; ?>
</td>

<? //tabulka - obsah stránek ?>
<td rowspan="2" width="660px" valign="top">
<?
if(Empty($kam))
{
require "uvod.php";
}
else
{
require $kam.'.php';
}
?>
</td>
</tr>
</table>

<?
//logovani-----------------------------------

$sb="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$k=fopen($sb,"r");
$dataip=explode("*@*",fread($k,1000000));
fclose($k);

if(!Empty($kam))
{
for($ri=1;$ri<count($dataip);$ri=$ri+2)
{
if($REMOTE_ADDR==$dataip[$ri])  //ovìøuje IP
{
$kdo=$dataip[$ri+1];
}//end if
}//end for

$logsz="Kliknuto na: <b>".$kam."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR." viz: <b>".$kdo."</b><br>\n";
$lg="log_chod_coksjgapiuimaspifguichsviuaerhgguiphakamcmsbbsfjcn.php";  //zapisovací soubor
$zaz=fopen($lg,"a+");
fwrite($zaz,$logsz);
fclose($zaz);
}//end kam
?>
