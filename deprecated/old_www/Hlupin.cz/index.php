<?
require "funkce.php";

if(!Empty($jmeno) and !Empty($heslo) and !Empty($vstup) and $vstup=="false" and (LoginKnihovna($jmeno,$heslo)=="true0" or LoginKnihovna($jmeno,$heslo)=="true1"))
{
SetCookie("KN_jmeno",$jmeno,Time()+31536000);
SetCookie("KN_heslo",$heslo,Time()+31536000);
}
else
{
if(!Empty($kam) and $kam=="knihovna" and !Empty($vstup) and $vstup=="false")
{
SetCookie("KN_jmeno","");
SetCookie("KN_heslo","");
}
}

if(!Empty($tx1) and !Empty($tx2) and !Empty($tx3) and !Empty($tx4) and !Empty($vstup) and $vstup=="false")
{
SetCookie("AD_tx1",$jmeno,Time()+31536000);
SetCookie("AD_tx2",$heslo,Time()+31536000);
SetCookie("AD_tx3",$heslo,Time()+31536000);
SetCookie("AD_tx4",$heslo,Time()+31536000);
}
else
{
if(!Empty($kam) and $kam=="ajdimne" and !Empty($vstup) and $vstup=="false")
{
SetCookie("AD_tx1","");
SetCookie("AD_tx2","");
SetCookie("AD_tx3","");
SetCookie("AD_tx4","");
}
}

print Banovani($REMOTE_ADDR);

if(!Empty($kam))
{Logovani($kam,$REMOTE_ADDR);}

echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<div class=\"ic_lista\">
<head></div>
<title>Obec Hlupín</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
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

.ic_lista
{
visibility: hidden;
background-color: #BDD0EE;
position:absolute;
top:-100px;
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
var ro=\"se shoduje s doporuèeným.\";
}
if(x<1024 && y<768)
{
var ro=\"je menší nìž doporuèené.\";
}
if(x>1024 && y>768)
{
var ro=\"je vìtší nìž doporuèené.\";
}
rz.innerText=\"Vaše rozlišení: \"+x+\"x\"+y+\" \"+ro;

var nmes = new Array('leden', 'únor', 'bøezen', 'duben', 'kvìten', 'èerven', 'èervenec', 'srpen', 'záøí', 'øíjen', 'listopad', 'prosinec');
var nden = new Array('Nedìle', 'Pondìlí', 'Úterý', 'Støeda', 'Ètvrtek', 'Pátek', 'Sobota');
var now = new Date();
var dd = now.getDay();
var mm = now.getMonth();
var da = now.getDate();
var ro = now.getYear();
datum.innerText=da+'. '+nmes[mm]+' '+ro;
den.innerText=nden[dd];
}
</script>

</head>
<div class=\"ic_lista\">
<body onload=\"menu(0);rozl();\" onclick=\"menu(0);\">
</div>

<table border=0 cellpadding=0 cellspacing=2 style=\"position:absolute;top:0px;left:0;\">

<tr>
<td colspan=2><img src=\"hornilista5.jpg\"></td>
<td><img src=\"logos.gif\"></td>
</tr>

<tr>
<td bgcolor=white height=600px valign=top>";
//$logovani

require "menu.php";

echo 
"</td>

<td valign=top>";

if(Empty($kam))
{require "aktuality.php";}
else
{require "{$kam}.php";}

echo //šíøka støedu
"<div style=\"width:720;\"></div>
</td>

<td valign=top>
<i>adresa:</i><br>
<b>Obecní úøad<br>
Hlupín è. 41<br>
386 01 Strakonice</b><br>

<i>email:</i><br>
<a href=\"mailto:ouhlupin@tiscali.cz\"><b>ouhlupin@tiscali.cz</b><br></a>

<i>ePodatelna:</i><br>
<a href=\"mailto:ePodatelna@hlupin.cz\"><b>ePodatelna@hlupin.cz</b><br></a>

<i>úøední hodiny:</i><br>
<b>Ètvrtek: 17:00 - 19:00</b>
<hr>
<b>
<span style=\"cursor:hand;\" onclick=\"men.kam.value='urednideska';men.poslat.click();\">ÚØEDNÍ DESKA</span><br>

<span style=\"cursor:hand;\" onclick=\"men.kam.value='zastupitele';men.poslat.click();\">ZASTUPITELÉ</span><br>

<span style=\"cursor:hand;\" onclick=\"men.kam.value='zapisy';men.poslat.click();\">ZÁPISY</span><br>

<span style=\"cursor:hand;\" onclick=\"men.kam.value='vyhlasky';men.poslat.click();\">VYHLÁŠKY</span>
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
require "anketa.php";
echo
"<div style=\"width:128;\"></div>
</td>
</tr>

<tr>
<th colspan=3>Aktualizace: ".DatumNovoty().", <i><span id=rz title=\"Nevíte co s tím??\nZmìòte rozlišení!!!\nA bude to lepší!\"></span></i></th>
</tr>

</body>
</html>";
?>
