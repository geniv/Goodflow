<?
$sou_ban="ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,100000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
{
require "ee.php";
exit;
}
}//end for
$sb_dt="datum_akualizace_pqjiowuvuirwnbvizuwefoijwiurvnruifnwuirbviurenbvzwr.php";
$u=fopen($sb_dt,"r");
$datum=fread($u,1000);
fclose($u);

/*
a
{
color: black;
text-decoration:none;
}
*/

echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<title>obec Hlup�n</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
<SCRIPT LANGUAGE=\"JavaScript\" src=\"cookies.js\"></SCRIPT>
</head>
<style type=\"text/css\">
#but
{
border-left-color: orange;
border-bottom-color: orange;
border-top-color: orange;
border-right-color: orange;
background-color: orange;
width:120px;
font-size:14px;
}
#butmen
{
border-left-color: DarkOrange;
border-bottom-color: DarkOrange;
border-top-color: DarkOrange;
border-right-color: DarkOrange;
background-color: DarkOrange;
width:100px;
font-size:12px;
}
#mnu,#mnu1,#mnu2,#mnu3,#mnu4
{
cursor:hand;
}
#odkz
{
cursor:hand;
color:blue;
}
#tvu
{
border-left-color: RoyalBlue;
border-bottom-color: RoyalBlue;
border-top-color: RoyalBlue;
border-right-color: RoyalBlue;
background-color: RoyalBlue;
width:120px;
font-size:14px;
}
body,table
{
font-family: Trebuchet MS, Courier, Courier New, sans-serif, verdana;
font-size:14px;
}
.tbb1
{
z-index:999;
width:100;
position:absolute;
left:122;
top:286;

text-align:left;
background-color:#ff7f00;
color:#ffffff;
text-decoration:none;
border-color:#000000;
border-style:solid;
border-width:0px 0px 0px 0px;
padding:2px 0px 2px 0px;
cursor:hand;
display:block;
font-size:8pt;
font-family:Arial, Helvetica, sans-serif;
}
.tbb2
{
z-index:999;
width:100;
position:absolute;
left:122;
top:313;

text-align:left;
background-color:#ff7f00;
color:#ffffff;
text-decoration:none;
border-color:#000000;
border-style:solid;
border-width:0px 0px 0px 0px;
padding:2px 0px 2px 0px;
cursor:hand;
display:block;
font-size:8pt;
font-family:Arial, Helvetica, sans-serif;
}
.tbb3
{
z-index:999;
width:100;
position:absolute;
left:122;
top:367;

text-align:left;
background-color:#ff7f00;
color:#ffffff;
text-decoration:none;
border-color:#000000;
border-style:solid;
border-width:0px 0px 0px 0px;
padding:2px 0px 2px 0px;
cursor:hand;
display:block;
font-size:8pt;
font-family:Arial, Helvetica, sans-serif;
}
.tbb4
{
z-index:999;
width:100;
position:absolute;
left:122;
top:475;

text-align:left;
background-color:#ff7f00;
color:#ffffff;
text-decoration:none;
border-color:#000000;
border-style:solid;
border-width:0px 0px 0px 0px;
padding:2px 0px 2px 0px;
cursor:hand;
display:block;
font-size:8pt;
font-family:Arial, Helvetica, sans-serif;
}
.inputtext
{
border-right: #4e86b9 1px solid;
border-top: #4e86b9 1px solid;
border-left: #4e86b9 1px solid;
border-bottom: #4e86b9 1px solid;
}
.button
{
border-right: #6f6b6c 1px solid;
border-top: #6f6b6c 1px solid;
border-left: #6f6b6c 1px solid;
border-bottom: #6f6b6c 1px solid;
font-weight: bold;
font-size: 11px;
padding-botom: 2px;
cursor: hand;
color: #135b9e;
}
</style>
<script language=\"JavaScript\">
function menu(povel)
{
if(povel==0)
{
tab1.style.visibility=\"hidden\";
tab2.style.visibility=\"hidden\";
tab3.style.visibility=\"hidden\";
tab4.style.visibility=\"hidden\";
}
if(povel==11)
{
tab1.style.visibility=\"visible\";
tab2.style.visibility=\"hidden\";
tab3.style.visibility=\"hidden\";
tab4.style.visibility=\"hidden\";
}
if(povel==21)
{
tab1.style.visibility=\"hidden\";
tab2.style.visibility=\"visible\";
tab3.style.visibility=\"hidden\";
tab4.style.visibility=\"hidden\";
}
if(povel==31)
{
tab1.style.visibility=\"hidden\";
tab2.style.visibility=\"hidden\";
tab3.style.visibility=\"visible\";
tab4.style.visibility=\"hidden\";
}
if(povel==41)
{
tab1.style.visibility=\"hidden\";
tab2.style.visibility=\"hidden\";
tab3.style.visibility=\"hidden\";
tab4.style.visibility=\"visible\";
}
}

function rozl()
{
var x=screen.width;
var y=screen.height;
if(x==1024 && y==768)
{
var ro=\"se shoduje s doporu�en�m.\";
}
if(x<1024 && y<768)
{
var ro=\"je men�� n� doporu�en�.\";
}
if(x>1024 && y>768)
{
var ro=\"je v�t�� n� doporu�en�.\";
}
rz.innerText=\"Va�e rozli�en�: \"+x+\"x\"+y+\" \"+ro;

var nmes = new Array('leden', '�nor', 'b�ezen', 'duben', 'kv�ten', '�erven', '�ervenec', 'srpen', 'z���', '��jen', 'listopad', 'prosinec');
var nden = new Array('Ned�le', 'Pond�l�', '�ter�', 'St�eda', '�tvrtek', 'P�tek', 'Sobota');
var now = new Date();
var dd = now.getDay();
var mm = now.getMonth();
var da = now.getDate();
var ro = now.getYear();
datum.innerText=da+'. '+nmes[mm]+' '+ro;
den.innerText=nden[dd];
}
</script>";
//nebere Firefox
//<script language=\"JavaScript\" src=\"snezeni.js\"></script>
//<script language=\"JavaScript\" src=\"snezeni.js\"></script>
//if($kam=="mapa")
//{$ump="hrf.click();";}
//else
//{$ump="";}
if(!Empty($kam) and $kam=="knihovna" and Empty($ptx1) and Empty($ptx2))
{
$logovani="logov(0);";//logov�n� do knihovny
}
else
{
$logovani="";
}
/*
if(!Empty($kam) and $kam=="forum" and Empty($ptx1) and Empty($ptx2))
{
$logchat="chatov(0);";//logov�n� do chatu
}
else
{
$logchat="";
}

if(!Empty($kam) and $kam=="forum" and !Empty($ptx1))
{
$cetov="novok.click();";//otev�en� chatu
}
else
{
$cetov="";
}
//$cetov$logchat
*/
require "hornilista.php";
echo "
</head>
<body onload=\"menu(0);rozl();$logovani\" onclick=\"menu(0);\">

<table bgcolor=lightyellow border=0 cellpadding=0 cellspacing=2 style=\"position:absolute;top:175px;left:0;\">

<tr>
<td colspan=2></td>
</tr>

<tr>
<td bgcolor=white height=600px valign=top>";
require "menu.php";
echo "
</td>

<td valign=top>";
if(Empty($kam))//kdy� neexistuje str�nka
{$kam="aktuality";}
require $kam.".php";//vlo�en� str�nky

echo //���ka st�edu
"<div style=\"width:720;\"></div>
</td>

<td valign=top>
<i>adresa:</i><br>
<b>Obecn� ��ad<br>
Hlup�n �. 41<br>
386 01 Strakonice</b><br>

<i>email:</i><br>
<a href=\"mailto:ouhlupin@tiscali.cz\"><b>ouhlupin@tiscali.cz</b><br></a>

<i>ePodatelna:</i><br>
<a href=\"mailto:ePodatelna@hlupin.cz\"><b>ePodatelna@hlupin.cz</b><br></a>

<i>��edn� hodiny:</i><br>
<b>�tvrtek: 17:00 - 19:00</b>
<hr>
<b>
<span style=\"cursor:hand;\" onclick=\"men.kam.value='urednideska';men.poslat.click();\">��EDN� DESKA</span><br>

<span style=\"cursor:hand;\" onclick=\"men.kam.value='zastupitele';men.poslat.click();\">ZASTUPITEL�</span><br>

<span style=\"cursor:hand;\" onclick=\"men.kam.value='zapisy';men.poslat.click();\">Z�PISY</span><br>

<span style=\"cursor:hand;\" onclick=\"men.kam.value='vyhlasky';men.poslat.click();\">VYHL��KY</span>
</b>
<hr>
<script language=\"JavaScript\" type=\"text/javascript\" src=\"http://www.e-pocasi.cz/weather.php?idx=10113&amp;cp=win\"></script>
<hr>

<table border=0 cellpadding=0 cellspacing=3>
<tr>
<td><a href=\"http://webmail.hlupin.cz\" target=\"_blank\"><img border=0 src=\"posta.gif\"></a></td>
<td valign=top><b>@hlupin.cz</b></td>
</tr>
</table>

<hr>";
include "anketa.php";
echo
"<div style=\"width:128;\"></div>
</td>
</tr>

<tr>
<th colspan=3>Aktualizace: $datum, <i><span id=rz title=\"Nev�te co s t�m??\nZm��te rozli�en�!!!\nA bude to lep��!\"></span></i></th>
</tr>

</body>
</html>";
//<div style=\"position:absolute;left:850;top:545;width:200;height:40;background-color:white;\"><h3 align=center>Po�as�:</h3></div>
//Po�as� ve Strakonic�ch<br><u style=\"cursor:hand;\" onclick=\"men.kam.value='webcam';men.poslat.click();\"><font color=blue>- Web kamera -</font></u>
//V�te jak se dostat do optim�ln�ho rozli�en�, kter� tomuto webo sed� nejl�pe?\nKlikn�te na plo�e prav�m tla��tkem, vyberte vlastnosti, pak z�lo�ku nastaven� a posu�te nastaven� rozli�en� do prava �i do leva aby se shodoval s rozli�en�m 1024x768.
//----------------------logov�n� do souboru------------------
$logt="Kliknuto na: <b>".$kam."</b> v: ".Date("H:i:s j.m. Y")." z IP: <b>".$REMOTE_ADDR."</b><br>\n";
$lg_s="l_s_qpwoedjoweijfhsdjhvkjsnvijsnisufrhoireuhgiwjhgwrgnidfuvevowhfviuunviuentrvuirevizuehbiuenv.php";  //zapisovac� soubor
$uk=fopen($lg_s,"a+");
fwrite($uk,$logt);
fclose($uk);
//javascript:history.back(1)
?>
