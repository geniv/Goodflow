<?
//--------------------------------------------------------------------
function DelkaOtevirani()
{
$soub="delka_otevir_ani_qwpidjchsiuvnsodivnmsodikvnsfoivnbsdoinvoisnbvsdisuundfijokb.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//--------------------------------------------------------------------
function Banovani($adresa)
{
$sou_ban="ban_qpwjfiowejhvurhvasocjsoiuhciuwrcizwrciuwrnizrbvzeurnbvwizuvvwrzrubc.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,DelkaOtevirani()));
fclose($u);
for($p=0;$p<count($ban);$p++)
{if($ban[$p]==$adresa)
{return "Neoprávnìný pøístup!!!";
exit;}
}//end for
}
//--------------------------------------------------------------------
function DatumNovoty()
{
$sb_dt="datum_akualizace_pqjiowuvuirwnbvizuwefoijwiurvnruifnwuirbviurenbvzwr.php";
$u=fopen($sb_dt,"r");
return fread($u,DelkaOtevirani());
fclose($u);
}
//--------------------------------------------------------------------
function Logovani($kde,$adresa)
{
$logt="Kliknuto na: <b>$kde</b> v: ".Date("H:i:s j.m. Y")." z IP: <b>$adresa</b><br>\n";
$lg_s="l_s_qpwoedjoweijfhsdjhvkjsnvijsnisufrhoireuhgiwjhgwrgnidfuvevowhfviuunviuentrvuirevizuehbiuenv.php";  //zapisovací soubor
$uk=fopen($lg_s,"a+");
fwrite($uk,$logt);
fclose($uk);
}
//--------------------------------------------------------------------
function DelkaDatabaze()
{
$soub="delka_databaze_olkjsdvnhsivhnkjvnbsdksjhdvsdikjvskjvbs.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//--------------------------------------------------------------------
function LogovaniPrihlasovani($tx1,$tx2,$adresa)
{
$lg="Pøihlášení do knihovny pod jmémen: <b>$tx1</b> a heslem: $tx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$adresa</b><br>\n";
$s_lop="l_s_lg_d_kn_qpfkcjsoadcnunvzrebwesiuvasizvbsizcvaeufnuquwhuienczagfcviuahqpcjaducvnzbcvizcaiucb.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);
}
//--------------------------------------------------------------------
function LoginKnihovna($jmeno,$heslo)
{
$soubr="prist_udj_pojaiudfhoivjsvoihwsivushfiushoiasudfvidfuviadfuhiarsufhvirefuhviuhregiurhreuihgpojqqewfdf.php";
$u=fopen($soubr,"r");
$udaj=explode("--LG--",fread($u,DelkaOtevirani()));
fclose($u);

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+1]==$heslo){$poc=$i;}
}//end for

if($poc!=0)
{
if($udaj[$poc+2]==1)
{return "true1";}
else
{return "true0";}
}
else
{return "false";}
}
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
function NactiDatabazi($b1,$b2,$b3,$b4,$zm1,$zm2,$zp1,$zp2)
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

$tab="";
for($i=1;$i<((count($kni)-1)/$del)+1;$i++)
{

switch($kni[($i*$del)])
{
case $b1:
    $sekce="no1";
    break;
case $b2:
    $sekce="no2";
    break;
case $b3:
    $sekce="no3";
    break;
case $b4:
    $sekce="no4";
    break;
}//end case

if($kni[($i*$del)-3]=="true")//zamluveno
{
$zamluvenoBarva=$zm1;
$zamluvenoText="Volná";
$zaml="<a href=\"index.php?kam=knihovna&vstup=true&cislo=$i&akce=zamluvit\">Zamluvit</a>";
}
else
{
$zamluvenoBarva=$zm2;
$zamluvenoText="Zamluvená";
$zaml="Nelze zamluvit";
}

if($kni[($i*$del)-1]=="true")//zapùjèeno
{
$zapujcenoBarva=$zp1;
$zapujcenoText="Volná";
}
else
{
$zapujcenoBarva=$zp2;
$zapujcenoText="Zapùjèená";
}

if(!Empty($kni[($i*$del)-2]))
{$jme=$kni[($i*$del)-2];}
else
{$jme="&nbsp;";}

/*
-5:název
-4:autor
-3:zamluveno
-2:jméno
-1:vypùjèeno
-0:barva literatury

nemùžou být talèítka!!!
*/

$tab.="<tr>
<th bgcolor=\"{$kni[($i*$del)]}\"><a name=\"$sekce\">$i</a></th>
<td>{$kni[($i*$del)-4]}</td>
<td>{$kni[($i*$del)-5]}</td>
<th bgcolor=\"$zamluvenoBarva\">$zamluvenoText</th>
<th bgcolor=\"$zapujcenoBarva\">$zapujcenoText</th>
<td>$jme</td>
<td>$zaml</td>
</tr>";
}//end for
return $tab;
}
//--------------------------------------------------------------------
function NactiDatabaziAdmin($b1,$b2,$b3,$b4,$zm1,$zm2,$zp1,$zp2)
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

$tab="";
for($i=1;$i<((count($kni)-1)/$del)+1;$i++)
{

switch($kni[($i*$del)])
{
case $b1:
    $sekce="no1";
    break;
case $b2:
    $sekce="no2";
    break;
case $b3:
    $sekce="no3";
    break;
case $b4:
    $sekce="no4";
    break;
}//end case

if($kni[($i*$del)-3]=="true")//zamluveno
{
$zamluvenoBarva=$zm1;
$zamluvenoText="Volná";
$zaml="<a href=\"index.php?kam=knihovna&vstup=true&cislo=$i&akce=zamluvit\">Zamluvit</a>";
$uvol="Nelze ulovnit";
$vypu="Nelze vydat";
}
else
{
$zamluvenoBarva=$zm2;
$zamluvenoText="Zamluvená";
$zaml="Nelze zamluvit";
$uvol="<a href=\"index.php?kam=knihovna&vstup=true&cislo=$i&akce=uvolnit\">Uvolnit</a>";
$vypu="<a href=\"index.php?kam=knihovna&vstup=true&cislo=$i&akce=vypujcit\">Vypùjèit</a>";
}

if($kni[($i*$del)-1]=="true")//zapùjèeno
{
$zapujcenoBarva=$zp1;
$zapujcenoText="Volná";
}
else
{
$zapujcenoBarva=$zp2;
$zapujcenoText="Zapùjèená";
$vypu="Nelze vydat";
}

if(!Empty($kni[($i*$del)-2]))
{$jme=$kni[($i*$del)-2];}
else
{$jme="&nbsp;";}

$tab.="<tr>
<th bgcolor=\"{$kni[($i*$del)]}\"><a name=\"$sekce\">$i</a></th>
<td>{$kni[($i*$del)-4]}</td>
<td>{$kni[($i*$del)-5]}</td>
<th bgcolor=\"$zamluvenoBarva\">$zamluvenoText</th>
<th bgcolor=\"$zapujcenoBarva\">$zapujcenoText</th>
<td>$jme</td>
<td>$zaml</td>
<td>$vypu</td>
<td>$uvol</td>
<td><a href=\"index.php?kam=knihovna&vstup=true&cislo=$i&akce=upravit\">upravit</a></td>
<td><a href=\"index.php?kam=knihovna&vstup=true&cislo=$i&akce=smazat\">smazat</a></td>
</tr>";
}//end for
return $tab;
}
//--------------------------------------------------------------------
function ZamluvitKnihu($cislo,$jmeno)
{
$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();
//-3 zamluvit
//-2 jméno

$kni[0]="<?php";
$kni[($cislo*$del)-5]=$kni[($cislo*$del)-5];
$kni[($cislo*$del)-4]=$kni[($cislo*$del)-4];
$kni[($cislo*$del)-3]="false";
$kni[($cislo*$del)-2]=$jmeno;
$kni[($cislo*$del)-1]=$kni[($cislo*$del)-1];
$kni[($cislo*$del)]=$kni[($cislo*$del)];

$u=fopen($soub,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);

return
"<center>Úspìšnì jste zamluvily knihu: <b>{$kni[($cislo*$del)-5]}</b> na jméno: <b>$jmeno</b>, s èíslem: $cislo
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde</h2></a></center>";
}
//--------------------------------------------------------------------
function VypujcitKnihu($cislo)
{
$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

$kni[0]="<?php";
$kni[($cislo*$del)-5]=$kni[($cislo*$del)-5];
$kni[($cislo*$del)-4]=$kni[($cislo*$del)-4];
$kni[($cislo*$del)-3]=$kni[($cislo*$del)-3];
$kni[($cislo*$del)-2]=$kni[($cislo*$del)-2];
$kni[($cislo*$del)-1]="false";
$kni[($cislo*$del)]=$kni[($cislo*$del)];

$u=fopen($soub,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);

return
"<center>Úspìšnì jste vypùjèily knihu: <b>{$kni[($cislo*$del)-5]}</b>, s èíslem: $cislo
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde</h2></a></center>";
}
//--------------------------------------------------------------------
function UvolnitKnihu($cislo)
{
$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

$kni[0]="<?php";
$kni[($cislo*$del)-5]=$kni[($cislo*$del)-5];
$kni[($cislo*$del)-4]=$kni[($cislo*$del)-4];
$kni[($cislo*$del)-3]="true";
$kni[($cislo*$del)-2]="";//jméno
$kni[($cislo*$del)-1]="true";
$kni[($cislo*$del)]=$kni[($cislo*$del)];

$u=fopen($soub,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);

return
"<center>Úspìšnì jste uvolnily knihu: <b>{$kni[($cislo*$del)-5]}</b>, s èíslem: $cislo
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde</h2></a></center>";
}
//--------------------------------------------------------------------
function Kniha($cislo)
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

return $kni[($cislo*$del)-5];
}
//--------------------------------------------------------------------
function PridatKnihu($autor,$nazev,$typ,$bar1,$bar2,$bar3,$bar4)
{
$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$typbarva="";
switch($typ)
{
case "typ1":
     $typbarva=$bar1;
     break;
     
case "typ2":
     $typbarva=$bar2;
     break;
     
case "typ3":
     $typbarva=$bar3;
     break;
     
case "typ4":
     $typbarva=$bar4;
     break;
}

$kni[count($kni)+1]=$nazev;
$kni[count($kni)+2]=$autor;
$kni[count($kni)+3]="true";
$kni[count($kni)+4]="";
$kni[count($kni)+5]="true";
$kni[count($kni)+6]=$typbarva;

$u=fopen($soub,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);

return
"<center>Uspìšnì jste pøidaly knížku: <b><font color=\"$typbarva\">$nazev</font></b>
<a href=\"index.php?kam=knihovna&vstup=true&akce=pridat\"><h2>Další novou knížku</h2></a>
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde pro jinou èinnost</h2></a>
</center>";
}
//--------------------------------------------------------------------
function UpravitKnihu($cislo,$nazev,$autor,$jmeno,$typ,$bar1,$bar2,$bar3,$bar4)
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

$typbarva="";
switch($typ)
{
case "typ1":
     $typbarva=$bar1;
     break;
     
case "typ2":
     $typbarva=$bar2;
     break;
     
case "typ3":
     $typbarva=$bar3;
     break;
     
case "typ4":
     $typbarva=$bar4;
     break;
}

$kni[0]="<?php";
$kni[($cislo*$del)-5]=$nazev;
$kni[($cislo*$del)-4]=$autor;
$kni[($cislo*$del)-3]=$kni[($cislo*$del)-3];
$kni[($cislo*$del)-2]=$jmeno;
$kni[($cislo*$del)-1]=$kni[($cislo*$del)-1];
$kni[($cislo*$del)]=$typbarva;

$u=fopen($sb,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);

return
"<center>Úspìšnì jste upravily knihu: <b>{$kni[($cislo*$del)-5]}</b>, s èíslem: $cislo
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde</h2></a></center>";
}
//--------------------------------------------------------------------
function SmazatKnihu($cislo)
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();
$poz=($cislo*$del)-($del-1);
$nazev=$kni[($cislo*$del)-5];//název souboru

$poc=0;
$nove[]="";
for($i=1;$i<$poz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$kni[$i];
}//end for

for($i1=$poz+$del;$i1<count($kni);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$kni[$i1];
}//end for

$nove[0]="<?php";
$u=fopen($sb,"w");
fwrite($u,implode($nove,"***BD***"));
fclose($u);

return
"<center>Úspìšnì jste smazaly knihu: <b>$nazev</b>, s èíslem: $cislo
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde</h2></a></center>";
}
//--------------------------------------------------------------------
function SmazatVsechnyKnihy()
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"w");
fwrite($u,"<?php");
fclose($u);

return
"<center><b>Všechny knihy byly vymazány!</b>
<a href=\"index.php?kam=knihovna&vstup=true\"><h2>Pokraèuj zde</h2></a></center>";
}
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
?>
