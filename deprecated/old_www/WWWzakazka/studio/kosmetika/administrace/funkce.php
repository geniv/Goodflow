<?
/*
$soub="bezp_kod_qwpofjwrsovnsdolivnsvoinsvoiuhsdfovnsovnefoivnsdfoinbvoiwreudfn.php";
$u=fopen($soub,"w");
fwrite($u,$poc);
fclose($u);
//"<a href=\"index.php?prist=ok&kod=$kod\">vstup do adminu</a>";
//$kod=
function GeneratorNahod()
{
$poc=0;
for($i=0;$i<10;$i++)
{
$poc.=rand(1,10000);
}//end for

return $poc;
}


<img src=\"kosmetika2.jpg\" name=\"ob1\" onmousemove=\"ob1.src='ukazka_vnitrek_logo.jpg';ob4.src='kosmetika2.jpg';\" onmouseover=\"ob1.src='kosmetika2.jpg';ob4.src='ukazka_vnitrek_logo.jpg';\">
<img src=\"ukazka_vnitrek_logo.jpg\" name=\"ob2\">

<img src=\"kosmetika2.jpg\" name=\"ob3\">
<img src=\"ukazka_vnitrek_logo.jpg\" name=\"ob4\">

<img name="galerie"onMouseOut="galerie.src='kosmetika01.gif';" onMouseOver="galerie.src='zkouska.gif';" src="kosmetika01.gif" BORDER=0

require "{$sekce}/menu.php";
print
"</td>
<td class=\"obsah_pozadi\" width=\"420px\" height=\"598px\" rowspan=\"2\" valign=\"top\" align=\"center\">";
if(!Empty($kam))//obsah
{require "{$sekce}/{$kam}.php";}
else
{require "{$sekce}/uvodni.php";}

<title>".NazevStranek("administrace").Hlavicka($kam)."</title>

	background-image: url({$sekce}/obrazky/ramecek_pravy_dolni.jpg);
	
	if(Empty($sekce))
{


require "administrace/funkce.php";

if(Empty($kam)){$kam="";}

Èechova 13 nová adresa!

<a href=\"{$sekce}/administrace\">&nbsp;</a>
{$nap=NapisteNam($kam,$jmeno,$email,$zprava);}
else
{$nap="";}
global $nap;
print_r($_POST);
print_r($_GET);
print $_GET["sekce"];
print $sekce1;
".$GLOBALS["nap"];
if(!Empty($sekce) and !Empty($kam) and $kam="napis" and !Empty($jmeno) and !Empty($email) and strpos($email,"@")!=0 and !Empty($zprava))
return "oivhisudvoikjsdnmv   ".;
*/
//---------------------------------------------------------------------
function LoginAdmin($Jmeno,$Heslo)
{
/*
jmeno
heslo
typ 0-beta, 1-full
*/
$soub="Prist_upo_ve_udaje_fdzuvdoijonvfojvjnslvfnniasbdiuhbuufvztftcfgsrteqtfiujjnùlkkjhvtfgdwredfrvbn.php";
$u=fopen($soub,"r");
$Log=explode("--LA--",fread($u,DelkaOtevirani(".")));
fclose($u);

$poc=0;
for($i=1;$i<count($Log);$i++)
{
if($Log[$i]==$Jmeno and $Log[$i+1]==$Heslo){$poc=$i;}
}//end for

if($poc!=0)
{
if($Log[$poc+2]==0)
{return "true0";}
else
{return "true1";}
}
else
{return "false";}

}
//---------------------------------------------------------------------
function DelkaOtevirani($Kde)
{
$soub="$Kde/delka_otevr_ijdfbvuizsdhfoiqejfiurhfoiwedfiujfuvoilsfjvujhvisufodjfhsvsfhbvidhsjfbviadfhbvfeuhv.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function DelkaAktualit($Kde)
{
$soub="$Kde/delka_aktualit_qwodfnncohsvisdfvbjiksdcfnvizudfvidjfnbuzdbfvijedjfbizuhedfvwred.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function DelkaCeniku($Kde)
{
$soub="$Kde/delka_ceniku_skjvnoopppqojqwpjjfonsfokjnsdcoijnsviushbviuwsdfhviusdfhvoisudfhbv.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function NazevStranek()
{
$soub="kosmetika/administrace/nazev_stranek_gwdksnnbkjjndfjvhbvikjdijsjidjvlkshvsjfjvolkshgoisdehoiwreshoishoiesudfhv.php";
$u=fopen($soub,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------

function Hlavicka($Kde)
{
if(!Empty($Kde))
{
if($Kde=="uvodni"){return " - Úvod";}
if($Kde=="onas"){return " - O nás";}
if($Kde=="nabidka"){return " - Nabídka";}
if($Kde=="aktuality"){return " - Aktuality";}
if($Kde=="fotogalerie"){return " - Foto galerie";}
if($Kde=="napis"){return " - Napište nám";}
if($Kde=="mapa"){return " - Mapa";}
if($Kde=="cenik"){return " - Ceník služeb";}
if($Kde=="objednat"){return " - Objednávky";}
}
else
{
return "";//pøi vstupu
}
}
//---------------------------------------------------------------------

/*
uvodní:
-poèet nabídek
-poèet aktualit
-poèet fotek
-poèet zpráv
-poèet služeb
-poèet objednávek

nabídka:
-(od)
-druh
-popis
-cena v ceníku

aktuality:
-datum
-zpráva

fotky:
-fotka
-popis

zprávy:
-od koho
-email
-zpráva

ceník:
-služba
-cena
-popis

objednávka: (potøeba generovat kalendáø)
-kdy (z kalendáøe)
-kolik hodin
-služba
-kdo?

hlavní:
-název stránky
-kontrola délky (uprava bude probíhat automaticky)
*/
  
//---------------------------------------------------------------------
/*
nabidka_doikibjpwwpkqqpfjoivndfoikjvnfoivnsjvhgchjhzugzugzvuhfgdfdfuhksdbvs.php
aktuality_qpofkoivnosfihvnkjhnfniujdfnvisfuviudfhviefuhvfivuhbuhhvcsdhc.php
fotky_qwofnsivbijsisudvishisdhvisjhvijsdfsdfjhifvbuzckjndbondbvkjnbvhnb.php
zpravy_qpowfihivhadiuucsdvoisuvoiasncuggasddfpiisdjajcsdihusv.php
cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php
objednavka_qwdoihjcvhfggdfreahggfdujhgsdjfibvefdjhhsfcvuzgvwskjv.php
*/
//---------------------------------------------------------------------
function PridatAktualitu($Text)
{
$soub="aktuality_qpofkoivnosfihvnkjhnfniujdfnvisfuviudfhviefuhvfivuhbuhhvcsdhc.php";
$u=fopen($soub,"r");
$akt=explode("--AKT--",fread($u,DelkaOtevirani(".")));
fclose($u);

$akt[0]="<?php";
//$akt[count($akt)+1]=Date("d.m.Y");//založen
$akt[count($akt)+1]=stripslashes($Text);

$u=fopen($soub,"w");
fwrite($u,implode($akt,"--AKT--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Pøidána aktualita:</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">".stripslashes($Text)."</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=pridat_aktualitu\" class=\"odkaz\">Pokraèuj klapnutím zde</a></td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
</td>
</tr>
</table>";
}
//---------------------------------------------------------------------
function UpravitAktualitu($Cislo,$Text)
{
$soub="aktuality_qpofkoivnosfihvnkjhnfniujdfnvisfuviudfhviefuhvfivuhbuhhvcsdhc.php";
$u=fopen($soub,"r");
$akt=explode("--AKT--",fread($u,DelkaOtevirani(".")));
fclose($u);

$del=DelkaAktualit(".");

$akt[0]="<?php";
$akt[($Cislo*$del)]=stripslashes($Text);

$u=fopen($soub,"w");
fwrite($u,implode($akt,"--AKT--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Upravena aktualita:</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">".stripslashes($Text)."</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=upravit_aktualitu\" class=\"odkaz\">Pokraèuj klapnutím zde</a></td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
</td>
</tr>
</table>";
}
//---------------------------------------------------------------------
function SmazatAktualitu($Cislo)
{
$soub="aktuality_qpofkoivnosfihvnkjhnfniujdfnvisfuviudfhviefuhvfivuhbuhhvcsdhc.php";
$u=fopen($soub,"r");
$akt=explode("--AKT--",fread($u,DelkaOtevirani(".")));
fclose($u);

$del=DelkaAktualit(".");
$poz=($Cislo*$del)-($del-1);
$sb=stripslashes($akt[($Cislo*$del)]);//název souboru

$poc=0;
$nove[]="";
for($i=1;$i<$poz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$akt[$i];
}//end for

for($i1=$poz+$del;$i1<count($akt);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$akt[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($soub,"w");
fwrite($u,implode($nove,"--AKT--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td align=\"center\" colspan=\"2\" height=\"20px\"></td>
</tr>
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Smazána aktualita:</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">$sb</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=smazat_aktualitu\" class=\"odkaz\">Pokraèuj klapnutím zde</a></td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
</td>
</tr>
</table>";
}
//---------------------------------------------------------------------
function DostaveniDelkyOtvirani($info)//auto kontrola délky
{
$delka=DelkaOtevirani(".");
$soub="aktuality_qpofkoivnosfihvnkjhnfniujdfnvisfuviudfhviefuhvfivuhbuhhvcsdhc.php";
$u=fopen($soub,"r");
$akt=fread($u,$delka);
fclose($u);

$soub="cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php";
$u=fopen($soub,"r");
$cen=fread($u,$delka);
fclose($u);

$min=500;//minimální rozdíl
$plus=500;//pøíèítat pøi poklesu
if(DelkaOtevirani(".")-(strlen($akt)+2)<$min or 
DelkaOtevirani(".")-(strlen($cen)+2)<$min)
{
$del=DelkaOtevirani(".")+$plus;
$soub="delka_otevr_ijdfbvuizsdhfoiqejfiurhfoiwedfiujfuvoilsfjvujhvisufodjfhsvsfhbvidhsjfbviadfhbvfeuhv.php";
$u=fopen($soub,"w");
fwrite($u,$del);
fclose($u);
}

if($info="true")
{
return 
"<table border=\"0\">
<tr>
<td>Délka aktualit:</td>
<td><b>".(strlen($akt)+2)."</b></td>
</tr>

<tr>
<td>Rozdíl aktualit:</td>
<td><b>".(DelkaOtevirani(".")-(strlen($akt)+2))."</b></td>
</tr>

<tr>
<td colspan=\"2\">&nbsp;</td>
</tr>

<tr>
<td>Délka ceníku:</td>
<td><b>".(strlen($cen)+2)."</b></td>
</tr>

<tr>
<td>Rozdíl ceníku:</td>
<td><b>".(DelkaOtevirani(".")-(strlen($cen)+2))."</b></td>
</tr>

<tr>
<td colspan=\"2\">&nbsp;</td>
</tr>

<tr>
<td>Délka otevírání:</td>
<td><b>".DelkaOtevirani(".")."</b></td>
</tr>
</table>";
}
else
{
return "";
}

}
//---------------------------------------------------------------------
function PridatCenik($Text,$Cena)
{
$soub="cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php";
$u=fopen($soub,"r");
$cen=explode("--CEN--",fread($u,DelkaOtevirani(".")));
fclose($u);

$cen[0]="<?php";
$cen[count($cen)+1]=stripslashes($Text);
$cen[count($cen)+2]=stripslashes($Cena);

$u=fopen($soub,"w");
fwrite($u,implode($cen,"--CEN--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\">Pøidána&nbsp;položka&nbsp;ceníku:</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\">".stripslashes($Text)."</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\">s&nbsp;cenou:</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\" width=\"80\">".stripslashes($Cena)."&nbsp;,-&nbsp;Kè</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
</tr>
<tr>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
</tr>
</table>
</td>
<td>
</td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=pridat_cenik\" class=\"odkaz\">Pokraèuj klapnutím zde</a></td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
</td>
</tr>
</table>";
}
//---------------------------------------------------------------------
function UpravitCenik($Cislo,$Text,$Cena)
{
$soub="cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php";
$u=fopen($soub,"r");
$cen=explode("--CEN--",fread($u,DelkaOtevirani(".")));
fclose($u);

$del=DelkaCeniku(".");

$cen[0]="<?php";
$cen[($Cislo*$del)-1]=stripslashes($Text);
$cen[($Cislo*$del)]=stripslashes($Cena);

$u=fopen($soub,"w");
fwrite($u,implode($cen,"--CEN--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
<td></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\">Upravena&nbsp;položka&nbsp;ceníku:</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\">".stripslashes($Text)."</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\">s&nbsp;cenou:</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\" valign=\"top\" width=\"80\">".stripslashes($Cena)."&nbsp;,-&nbsp;Kè</td>
<td class=\"input\">&nbsp;</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
<td>&nbsp;</td>
</tr>
<tr>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
<td></td>
</tr>
</table>
</td>
<td>
</td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=upravit_cenik\" class=\"odkaz\">Pokraèuj klapnutím zde</a></td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
</td>
</tr>
</table>";
}
//---------------------------------------------------------------------
function SmazatCenik($Cislo)
{
$soub="cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php";
$u=fopen($soub,"r");
$cen=explode("--CEN--",fread($u,DelkaOtevirani(".")));
fclose($u);

$del=DelkaCeniku(".");
$poz=($Cislo*$del)-($del-1);
$sb=stripslashes($cen[($Cislo*$del)-1]);//název souboru

$poc=0;
$nove[]="";
for($i=1;$i<$poz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$cen[$i];
}//end for

for($i1=$poz+$del;$i1<count($cen);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$cen[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($soub,"w");
fwrite($u,implode($nove,"--CEN--"));
fclose($u);

return
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td align=\"center\" colspan=\"2\" height=\"20px\"></td>
</tr>
<tr>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">Smazána položka ceníku:</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
<td>&nbsp;</td>
<td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\">$sb</td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td class=\"ramecek_levy_horni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_horni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_horni\" width=\"7px\" height=\"8px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy\" width=\"7px\"></td>
<td class=\"input\">&nbsp;</td>
<td class=\"input\" height=\"20px\"><a href=\"index_go.php?kam=smazat_cenik\" class=\"odkaz\">Pokraèuj klapnutím zde</a></td>
<td class=\"input\">&nbsp;</td>
</td>
<td class=\"ramecek_pravy\" width=\"7px\"></td>
</tr>
<tr>
<td class=\"ramecek_levy_dolni\" width=\"7px\" height=\"8px\"></td>
<td class=\"ramecek_dolni\" colspan=\"3\" height=\"8px\"></td>
<td class=\"ramecek_pravy_dolni\" width=\"7px\" height=\"8px\"></td>
</tr>
</table>
<tr>
<td align=\"center\" colspan=\"2\" height=\"6px\"></td>
</tr>
</td>
</tr>
</table>";
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
function NapisteNam($sekce,$jmeno,$email,$zprava)
{
$soub="kosmetika/administrace/udaje_kosmetika_kjfnvoiwpsejfowksjpkopijqqqwjmoinjsdfvokknoksldncoiksndvlkidfjviosdjnhgef.php";
$u=fopen($soub,"r");
$udj=explode("--UDJ--",fread($u,DelkaOtevirani("kosmetika/administrace")));
fclose($u);
mail($udj[5],"Zpráva ze sekce $sekce","$zprava \n\n Odesláno: ".Date("G:i:s j.n. Y"), "From: " . $email);
//mail("geniv@centrum.cz","Zpráva ze sekce $sekce","$zprava /n v: ".Date("G:i:s j.n. Y"));
return "Email byl úspìšnì odeslán!";
}
//---------------------------------------------------------------------
function ZmenseniObrazku()
{
$soubor="kosmetika/galerie/P6155703.JPG";
$novy="kosmetika/galerie/maly_P6155703.jpg";
$vel=GetImageSize($soubor);
$quality=100;
$si=240;
$vy=180;
$sirka=Ceil($vel[0]/($vel[1]/$vy));
$vyska=Ceil($vel[1]/($vel[0]/$si));
$zdroj=imagecreatefromjpeg($soubor);
$cil=imagecreate($sirka,$vyska);
imagecopyresized($cil,$zdroj,0,0,0,0,$sirka,$vyska,$vel[0],$vel[1]);
//imagecopyresampled($cil,$zdroj,0,0,0,0,$sirka,$vyska,$vel[0],$vel[1]);
imageJPEG($cil,$novy,$quality);
ImageDestroy($zdroj);
ImageDestroy($cil);
}
//---------------------------------------------------------------------
function jdi_na_stranku($stranka,$pocet_stran,$sekce)
{
$dalstr=$stranka+1;
$predstr=$stranka-1;
if($pocet_stran<6)
{
if($stranka>1)
{$pred="( <a href=\"index.php?kam=$sekce&str=$predstr\" class=\"genmed\"><u>Pøedchozí</u></a> ) ";}
else
{$pred="";}

$zc="";
for($i=1;$i<=$pocet_stran;$i++)
{
if($i!=$pocet_stran)
{
if($i==$stranka)//ruší a href
{$zc.="$i, ";}//zaèátek
else
{$zc.="<a href=\"index.php?kam=$sekce&str=$i\"><u>$i</u></a>, ";}
}
else
{
if($pocet_stran==$stranka)//dohlíží na další
{$kn="$i";}//konec
else
{$kn="<a href=\"index.php?kam=$sekce&str=$i\"><u>$i</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}
}
}//end for

return "Jdi na stránku: {$pred}{$zc}{$kn}";
}
else
{
$str2=$stranka+1;
$str3=$stranka+2;
$str4=$pocet_stran-1;
$str5=$pocet_stran-2;

if($stranka>1)
{$pred1="( <a href=\"index.php?kam=$sekce&str=$predstr\" class=\"genmed\"><u>Pøedchozí</u></a> ) <a href=\"index.php?kam=$sekce&str=1\"><u>1</u></a> ... ";}
else
{$pred1="";}

if($stranka<$pocet_stran-2)
{
if($pocet_stran==1)
{$zc1=$stranka;}
else
{$zc1="";}

if($pocet_stran==2)
{$zc1="$stranka, <a href=\"index.php?kam=$sekce&str=$str2\"><u>$str2</u></a>";}
else
{$zc1="";}

if($pocet_stran>3)
{$zc1=" $stranka, <a href=\"index.php?kam=$sekce&str=$str2\"><u>$str2</u></a>, <a href=\"index.php?kam=$sekce&str=$str3\"><u>$str3</u></a>";}
else
{$zc1="";}

if($pocet_stran-2==$stranka)//dohlíží na další
{$kn1="";}//konec
else
{$kn1=" ... <a href=\"index.php?kam=$sekce&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}

}
else
{
if($stranka==$str5)
{$zc1="$str5, <a href=\"index.php?kam=$sekce&str=$str4\"><u>$str4</u></a>, <a href=\"index.php?kam=$sekce&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}

if($stranka==$str4)
{$zc1="<a href=\"index.php?kam=$sekce&str=$str5\"><u>$str5</u></a>, $str4, <a href=\"index.php?kam=$sekce&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&str=$dalstr\" class=\"genmed\"><u>Další</u></a> )";}

if($pocet_stran==$stranka)
{$zc1="<a href=\"index.php?kam=$sekce&str=$str5\"><u>$str5</u></a>, <a href=\"index.php?kam=$sekce&str=$str4\"><u>$str4</u></a>, $pocet_stran";}

$kn1="";
}
return "Jdi na stránku: {$pred1}{$zc1}{$kn1}";
}//...
}
//---------------------------------------------------------------------
function pocet_souboru($cesta)
{
$handle=opendir($cesta);
$poc=0;
while($soub=readdir($handle))
{
$poc+=1;
}
closedir($handle);

return $poc-2;
}
//---------------------------------------------------------------------
function velikost_adresare($jmeno,$koncovka)
{
$handle=opendir($jmeno);
$vel=0;
while($soub=readdir($handle))
{
$vel+=filesize("$jmeno/$soub");
}
closedir($handle);

if($koncovka=="true")
{
if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",round($vel/1048576*100)/100);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",round($vel/1024*100)/100);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
else//else koncovka
{return $vel;}
}
//---------------------------------------------------------------------
function velikost_sekce()
{
$vs[0]=velikost_adresare("../obrazky",false);
$vs[1]=velikost_adresare("../galerie",false);
$vs[2]=velikost_adresare(".",false);//admin
$vs[3]=velikost_adresare("../",false);//hlavni

$vel=0;
for($i=0;$i<count($vs);$i++)
{
$vel+=$vs[$i];
}//end for

if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",$vel/1048576);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",$vel/1024);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
?>
