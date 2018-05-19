<?
//konstanty:
$freeJM="volny";
$freeHE="free";
$bar1="#99ff99";//typ literatùty
$bar2="#ffff00";
$bar3="#669900";
$bar4="#ff66ff";
$bta1="skyblue";//zamluveno
$bta2="orange";
$bta3="lime";//vypùjèeno
$bta4="red";

if(!Empty($vstup) and $vstup=="false" and Empty($jmeno) and Empty($heslo))
{
echo 
"<img src=\"Open-book-f.jpg\" width=\"95%\">

<table border=0 cellpadding=0 cellspacing=3 style=\"left:520;top:300;position:absolute;\">
<tr>
<th colspan=2>
<form method=\"post\">
<input type=\"hidden\" name=\"jmeno\" value=\"$freeJM\">
<input type=\"hidden\" name=\"heslo\" value=\"$freeHE\">
<button type=\"submit\">
<b>Volný vstup</b><br>
do<br>
Místní lidové<br>
knihovny Hlupín
</button>
</form>
</th>
</tr>

<tr>
<th colspan=2>Knihovna login</th>
</tr>

<form method=\"post\">
<tr>
<td>Login: </td>
<td><input type=\"text\" name=\"jmeno\"></td>
</tr>

<tr>
<td>Heslo: </td>
<td><input type=\"password\" name=\"heslo\"></td>
</tr>

<tr>
<th colspan=2><input type=\"submit\" value=\"Vstup\"></th>
</tr>
</table>
</form>

<table border=0 style=\"left:210;top:220;position:absolute;\">
<tr>
<td>V naší obecní knihovnì si mùžete online<br>
 zamluvit jakoukoli knihu ze seznamu a<br>
  pøijít vypùjèit do knihovny Hlupín è.p. 49..<br>
<b>Výpùjèní doba:</b> v denních hodinách<br>
<br>
<br>
 <b>Knihovnice:</b> Božena Kloudová<br>
		<b>ICQ:</b> 451 032 975<br>
		<b>Tel:</b> 380 120 297<br>
	  <b>Email:</b> <a href=\"mailto:knihovna@hlupin.cz\">knihovna@hlupin.cz</td>
</tr>
</table>";
}
else
{
if(!Empty($jmeno) and !Empty($heslo))
{print "<h1><a href=\"index.php?kam=knihovna&vstup=true\">>> Pokraèuj zde <<</a></h1>";}
else
{
if(Empty($KN_jmeno) and Empty($KN_heslo))
{print "Neoprávnìný pøístup!!!";}
}

//free
if(!Empty($vstup) and $vstup=="true" and !Empty($KN_jmeno) and !Empty($KN_heslo) and LoginKnihovna($KN_jmeno,$KN_heslo)=="true0")
{
echo
"<h2 align=\"center\">Místní lidová knihovna Hlupín</h2>
<hr>
<p style=\"text-align:justify;\">
Vítejte v Místní lidové knihovnì Hlupín.<br>
Nyní si mùžete zamluvit na své jméno knihy ze seznamu, které jsou barevnì rozlišeny na 4 
tématické èástí: <b><font color=\"$bar1\">Beletrie</font>, <font color=\"$bar2\">Nauèné</font>, <font color=\"$bar3\">Beletrie pro dìti</font>, <font color=\"$bar4\">Nauèné pro dìti</font>.</b>
Staèí vyplnit pole <b>\"Na jmého\"</b> a stisknout tlaèítko <b>\"zamluvit\"</b>. Pokud se u knihy pole <b>\"zamluveno A/N\"</b>
vybarví <b><font color=\"$bta2\">oranžovì</font></b> s nápisem <b>\"zamluvená\"</b> máte jistotu,<br>že kniha je pro vás zamluvena a mùžete si ji pøijít vyzvednout. 
Knihovní databáze se aktualizuje ètvrtletnì.</p>
<hr>
<table border=0 align=center cellpadding=0 cellspacing=0>
<tr>
<td><img src=\"beletrie_left.png\"></td>
<td><a href=\"#no1\"><img border=\"0\" src=\"beletrie_b1.png\" onmouseover=\"src='beletrie_b1_over.png';\" onmouseout=\"src='beletrie_b1.png';\"></a></td>
<td><a href=\"#no2\"><img border=\"0\" src=\"naucne_b1.png\" onmouseover=\"src='naucne_b1_over.png';\" onmouseout=\"src='naucne_b1.png';\"></a></td>
<td><a href=\"#no3\"><img border=\"0\" src=\"beletrie_pro_mladez_b1.png\" onmouseover=\"src='beletrie_pro_mladez_b1_over.png';\" onmouseout=\"src='beletrie_pro_mladez_b1.png';\"></a></td>
<td><a href=\"#no4\"><img border=\"0\" src=\"naucne_pro_mladez_b1.png\" onmouseover=\"src='naucne_pro_mladez_b1_over.png';\" onmouseout=\"src='naucne_pro_mladez_b1.png';\"></a></td>
<td><img src=\"naucne_pro_madez_right.png\"></td>
</tr>
</table>";

if(!Empty($cislo) and !Empty($akce) and $akce=="zamluvit")
{
echo 
"<form method=\"post\">
<table border=\"0\" align=\"center\">
<tr>
<th colspan=\"2\"><u>Zamluvit knihu:</u></th>
</tr>
<tr>
<td>Název knihy:</td>
<th>".Kniha($cislo)."</th>
</tr>
<tr>
<td>Na jméno:</td>
<td><input type=\"text\" name=\"najmeno\">
<input type=\"hidden\" name=\"akce\" value=\"$akce\"></td>
</tr>
<tr>
<th colspan=\"2\">";
if(Empty($najmeno) and !Empty($cislo))
{print "<input type=\"submit\" value=\"Zamluvit\">";}
print
"</th>
</tr>
</table>
</form>
<br>";

if(!Empty($najmeno) and !Empty($cislo) and !Empty($akce) and $akce=="zamluvit")
{print ZamluvitKnihu($cislo,stripslashes($najmeno));}//end zamluvit
}//end zamluveno

$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

if((((count($kni)-1)/$del)+1)!=1)
{
echo
"<table border=\"2\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\">
<tr>
<th>#</th>
<th>Autor</th>
<th>Název</th>
<th>Zamluveno<br>(A/N)</th>
<th>Zapùjèeno<br>(A/N)</th>
<th>Na jméno</th>
<th>Zamluvit</th>
</tr>
".NactiDatabazi($bar1,$bar2,$bar3,$bar4,$bta1,$bta2,$bta3,$bta4)."
</table>";
}//end empty
else
{print "Žádné knihy!";}

}//end free

//admin
if(!Empty($vstup) and $vstup=="true" and !Empty($KN_jmeno) and !Empty($KN_heslo) and LoginKnihovna($KN_jmeno,$KN_heslo)=="true1")
{
echo
"<h2 align=\"center\">Místní lidová knihovna Hlupín - administrace</h2>
<hr>
<p style=\"text-align:justify;\">
Vítejte v Místní lidové knihovnì Hlupín.<br>
Nyní si mùžete zamluvit na své jméno knihy ze seznamu, které jsou barevnì rozlišeny na 4 
tématické èástí: <b><font color=\"$bar1\">Beletrie</font>, <font color=\"$bar2\">Nauèné</font>, <font color=\"$bar3\">Beletrie pro dìti</font>, <font color=\"$bar4\">Nauèné pro dìti</font>.</b>
Staèí vyplnit pole <b>\"Na jmého\"</b> a stisknout tlaèítko <b>\"zamluvit\"</b>. Pokud se u knihy pole <b>\"zamluveno A/N\"</b>
vybarví <b><font color=\"$bta2\">oranžovì</font></b> s nápisem <b>\"zamluvená\"</b> máte jistotu,<br>že kniha je pro vás zamluvena a mùžete si ji pøijít vyzvednout. 
Knihovní databáze se aktualizuje ètvrtletnì.</p>
<hr>
<table border=0 align=center cellpadding=0 cellspacing=0>
<tr>
<td><img src=\"beletrie_left.png\"></td>
<td><a href=\"#no1\"><img border=\"0\" src=\"beletrie_b1.png\" onmouseover=\"src='beletrie_b1_over.png';\" onmouseout=\"src='beletrie_b1.png';\"></a></td>
<td><a href=\"#no2\"><img border=\"0\" src=\"naucne_b1.png\" onmouseover=\"src='naucne_b1_over.png';\" onmouseout=\"src='naucne_b1.png';\"></a></td>
<td><a href=\"#no3\"><img border=\"0\" src=\"beletrie_pro_mladez_b1.png\" onmouseover=\"src='beletrie_pro_mladez_b1_over.png';\" onmouseout=\"src='beletrie_pro_mladez_b1.png';\"></a></td>
<td><a href=\"#no4\"><img border=\"0\" src=\"naucne_pro_mladez_b1.png\" onmouseover=\"src='naucne_pro_mladez_b1_over.png';\" onmouseout=\"src='naucne_pro_mladez_b1.png';\"></a></td>
<td><img src=\"naucne_pro_madez_right.png\"></td>
</tr>
</table>

<center>
<a href=\"zapucene_kn.php\" target=\"_blank\"><h4>Již zamluvené knihy</h4></a>
<a href=\"index.php?kam=knihovna&vstup=true&akce=pridat\"><h3>Pøidat kníhu</h3></a>
</center>";

if(!Empty($cislo) and !Empty($akce) and $akce=="zamluvit")
{
echo 
"<form method=\"post\">
<table border=\"0\" align=\"center\">
<tr>
<th colspan=\"2\"><u>Zamluvit knihu:</u></th>
</tr>
<tr>
<td>Název knihy:</td>
<th>".Kniha($cislo)."</th>
</tr>
<tr>
<td>Na jméno:</td>
<td><input type=\"text\" name=\"najmeno\">
<input type=\"hidden\" name=\"akce\" value=\"$akce\"></td>
</tr>
<tr>
<th colspan=\"2\">";
if(Empty($najmeno) and !Empty($cislo))
{print "<input type=\"submit\" value=\"Zamluvit\">";}
print
"</th>
</tr>
</table>
</form>
<br>";

if(!Empty($najmeno) and !Empty($cislo) and !Empty($akce) and $akce=="zamluvit")
{print ZamluvitKnihu($cislo,stripslashes($najmeno));}//end zamluveni

}//end zamluvit


if(!Empty($cislo) and !Empty($akce) and $akce=="vypujcit")
{print VypujcitKnihu($cislo);}//vypùjèit

if(!Empty($cislo) and !Empty($akce) and $akce=="uvolnit")
{print UvolnitKnihu($cislo);}//uvolnit

if(!Empty($akce) and $akce=="pridat")
{
echo
"<form method=\"post\">
<table border=\"0\" align=\"center\">
<tr>
<th>Autor knihy:</th>
<td><input type=\"text\" name=\"autorknihy\"></td>
</tr>
<tr>
<th>Název knihy:</th>
<td><input type=\"text\" name=\"nazevknihy\"></td>
</tr>
<tr>
<th>Typ knihy:</th>
<td>
Beletrie: <input type=\"radio\" checked name=\"typknihy\" value=\"typ1\"><br>
Nauèné: <input type=\"radio\" name=\"typknihy\" value=\"typ2\"><br>
Beletrie pro mládež: <input type=\"radio\" name=\"typknihy\" value=\"typ3\"><br>
Nauèné pro mládež: <input type=\"radio\" name=\"typknihy\" value=\"typ4\">
</td>
</tr>
<tr>
<th colspan=\"2\">";
if(Empty($nazevknihy) and Empty($typknihy))
{print "<input type=\"submit\" value=\"Pøidej knihu\">";}
print
"</th>
</tr>
</table>
</form>";

if(!Empty($nazevknihy) and !Empty($typknihy))
{
if(Empty($autorknihy)){$autorknihy="";}
print PridatKnihu(stripslashes($autorknihy),stripslashes($nazevknihy),$typknihy,$bar1,$bar2,$bar3,$bar4);
}//end pøidání

}//end pøidat

if(!Empty($cislo) and !Empty($akce) and $akce=="upravit")
{
$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

switch($kni[($cislo*$del)])
{
case $bar1:
     $tp[1]="checked";
     $tp[2]="";
     $tp[3]="";
     $tp[4]="";
     break;
     
case $bar2:
     $tp[1]="";
     $tp[2]="checked";
     $tp[3]="";
     $tp[4]="";
     break;
     
case $bar3:
     $tp[1]="";
     $tp[2]="";
     $tp[3]="checked";
     $tp[4]="";
     break;
   
case $bar4:
     $tp[1]="";
     $tp[2]="";
     $tp[3]="";
     $tp[4]="checked";
     break;
     
default:
     $tp[1]="checked";
     $tp[2]="";
     $tp[3]="";
     $tp[4]="";
}

echo
"<form method=\"post\">
<table border=\"0\" align=\"center\">
<tr>
<th>Název:</th>
<td><input type=\"text\" name=\"nazevknihy\" value=\"{$kni[($cislo*$del)-5]}\"></td>
</tr>
<tr>
<th>Autor:</th>
<td><input type=\"text\" name=\"autorknihy\" value=\"{$kni[($cislo*$del)-4]}\"></td>
</tr>
<tr>
<th>Jméno:</th>
<td><input type=\"text\" name=\"jmenoobcana\" value=\"{$kni[($cislo*$del)-2]}\"></td>
</tr>
<tr>
<th>Typ:</th>
<td>
Beletrie: <input type=\"radio\" name=\"typknihy\" {$tp[1]} value=\"typ1\"><br>
Nauèné: <input type=\"radio\" name=\"typknihy\" {$tp[2]} value=\"typ2\"><br>
Beletrie pro mládež:  <input type=\"radio\" name=\"typknihy\" {$tp[3]} value=\"typ3\"><br>
Nauèné pro mládež: <input type=\"radio\" name=\"typknihy\" {$tp[4]} value=\"typ4\">
</td>
</tr>
<tr>";
if(Empty($nazevknihy) and Empty($typknihy))
{print "<th colspan=\"2\"><input type=\"submit\" value=\"Upravit\"></th>";}
print
"</tr>
</table>
</form>";

if(!Empty($nazevknihy) and !Empty($typknihy))
{
if(Empty($autorknihy)){$autorknihy="";}
if(Empty($jmenoobcana)){$jmenoobcana="";}
print UpravitKnihu($cislo,stripslashes($nazevknihy),stripslashes($autorknihy),stripslashes($jmenoobcana),$typknihy,$bar1,$bar2,$bar3,$bar4);
}//end upravení

}//end upravit

if(!Empty($cislo) and !Empty($akce) and $akce=="smazat")
{
$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

echo
"<form method=\"post\">
<table border=\"0\" align=\"center\">
<tr>
<th>Smazat??</th>
<td>{$kni[($cislo*$del)-5]}</td>
</tr>";
if(Empty($prikaz))
{
print
"<tr>
<th><input type=\"submit\" name=\"prikaz\" value=\"Ano\"></th>
<th><input type=\"submit\" name=\"prikaz\" value=\"Ne\"></th>
</tr>";
}
print
"</table>
</form>";

if(!Empty($cislo) and !Empty($prikaz) and $prikaz=="Ano" and !Empty($akce) and $akce=="smazat")
{print SmazatKnihu($cislo);}//end smazání

}//end samzat

if(!Empty($akce) and $akce=="vymazatvse")
{
echo
"<form method=\"post\">
<table border=\"0\" align=\"center\">
<tr>
<th>Smazat??</th>
<td>Všechny knihy</td>
</tr>";
if(Empty($prikaz))
{
print
"<tr>
<th><input type=\"submit\" name=\"prikaz\" value=\"Ano\"></th>
<th><input type=\"submit\" name=\"prikaz\" value=\"Ne\"></th>
</tr>";
}
print
"</table>
</form>";

if(!Empty($prikaz) and $prikaz=="Ano" and !Empty($akce) and $akce=="vymazatvse")
{print SmazatVsechnyKnihy();}//end vymazání všech knih

}//smazat všech knih

$soub="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($soub,"r");
$kni=explode("***BD***",fread($u,DelkaOtevirani()));
fclose($u);

$del=DelkaDatabaze();

if((((count($kni)-1)/$del)+1)!=1)
{
echo
"<table border=\"2\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\">
<tr>
<th>#</th>
<th>Autor</th>
<th>Název</th>
<th>Zamluveno (A/N)</th>
<th>Zapùjèeno (A/N)</th>
<th>Na jméno</th>
<th colspan=\"5\">Akce</th>
</tr>
".NactiDatabaziAdmin($bar1,$bar2,$bar3,$bar4,$bta1,$bta2,$bta3,$bta4)."
</table>
<center><a href=\"index.php?kam=knihovna&vstup=true&akce=vymazatvse\"><font style=\"font-size: 8px\">Vymazat všechny knížky</font></a></center>";
}//end empty
else
{print "Žádné knihy!";}

}//end admin

}//end vstup OK

/*
if(!Empty($KN_jmeno) and !Empty($KN_heslo) and !Empty($vstup) and $vstup=="true" and LoginKnihovna($KN_jmeno,$KN_heslo)=="true0")
{
print "samotná knihovna free!";
}

if(!Empty($KN_jmeno) and !Empty($KN_heslo) and !Empty($vstup) and $vstup=="true" and LoginKnihovna($KN_jmeno,$KN_heslo)=="true1")
{
print "samotná knihovna admin!";
}
*/

/*

if(Empty($jmeno) and Empty($heslo) and Empty($KN_jmeno) and Empty($KN_heslo))
{

//print_r($_POST);
//print_r($HTTP_COOKIE_VARS);
//print $KN_jmeno;

}
else
{
if(LoginKnihovna($jmeno,$heslo)=="true0" or LoginKnihovna($jmeno,$heslo)=="true1")

}

{
//LogovaniPrihlasovani($jmeno,$heslo,$REMOTE_ADDR);
if(!Empty($KN_jmeno) and !Empty($KN_heslo) and LoginKnihovna($KN_jmeno,$KN_heslo)=="true0")
{

//<input type=\"hidden\" name=\"ptx1\" value=\"$ptx1\">
//<input type=\"hidden\" name=\"ptx2\" value=\"$ptx2\">
//<th>Na jméno</th>
//print_r($_POST);
//--------------------------------------------------------------------

//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
//--------------------------------------------------------------------
}//end free
else
{
//print LoginKnihovna($jmeno,$heslo);
if(!Empty($KN_jmeno) and !Empty($KN_heslo) and LoginKnihovna($KN_jmeno,$KN_heslo)=="true1")
{
echo
"admin

";
}//end admin
//else
//{print "Neoprávnìný pøístup!!!";}

}//end else !admin

}//end !Empty


*/


//doèasnì!!!


/*
if(Empty($_POST["ptx1"]) and Empty($_POST["ptx2"]))
{
echo 
"<img src=\"Open-book-f.jpg\" width=\"95%\">
<script language=\"JavaScript\">
function logov(pov)
{
if(pov==0)
{
rade1.style.visibility=\"hidden\";
rade2.style.visibility=\"hidden\";
rade3.style.visibility=\"hidden\";
rade4.style.visibility=\"hidden\";
rade5.style.visibility=\"hidden\";
rade6.style.visibility=\"hidden\";
}
if(pov==1)
{
rade1.style.visibility=\"visible\";
rade2.style.visibility=\"visible\";
rade3.style.visibility=\"visible\";
rade4.style.visibility=\"visible\";
rade5.style.visibility=\"visible\";
rade6.style.visibility=\"visible\";
}
}
</script>

<table border=0 cellpadding=0 cellspacing=3 style=\"left:520;top:300;position:absolute;\">
<tr>
<th colspan=2>
<form method=\"post\">
<button type=\"submit\">
<b>Volný vstup</b><br>
do<br>
Místní lidové<br>
knihovny Hlupín
</button>
<input type=\"hidden\" name=\"ptx1\" value=\"$freeJM\">
<input type=\"hidden\" name=\"ptx2\" value=\"$freeHE\">
</form>
</th>
</tr>
<tr>
<th colspan=2 ondblclick=\"logov(1);\">&nbsp;</th>
</tr>
<tr>
<th colspan=2><span id=rade1>Knihovna login</span></th>
</tr>
<tr>
<td><span id=rade2>Login: </span></td>
<td><span id=rade3><input type=\"text\" name=\"ptx1\"></span></td>
</tr>
<tr>
<td><span id=rade4>Heslo: </span></td>
<td><span id=rade5><input type=\"password\" name=\"ptx2\"></span></td>
</tr>
<tr>
<th colspan=2><span id=rade6><input type=\"submit\" value=\"Vstup\">&nbsp;<input type=button value=\"Skrýt\" onclick=\"logov(0);\"></span></th>
</tr>
</table>


<table border=0 style=\"left:210;top:220;position:absolute;\">
<tr>
<td>V naší obecní knihovnì si mùžete online<br>
 zamluvit jakoukoli knihu ze seznamu a<br>
  pøijít vypùjèit do knihovny Hlupín è.p. 49..<br>
<b>Výpùjèní doba:</b> v denních hodinách<br>
<br>
<br>
 <b>Knihovnice:</b> Božena Kloudová<br>
		<b>ICQ:</b> 451 032 975<br>
		<b>Tel:</b> 380 120 297<br>
	  <b>Email:</b> <a href=\"mailto:knihovna@hlupin.cz\">knihovna@hlupin.cz</td>
</tr>
</table>";
}
else
{
$lg="Pøihlášení do knihovny pod jmémen: <b>$ptx1</b> a heslem: $ptx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";
$s_lop="l_s_lg_d_kn_qpfkcjsoadcnunvzrebwesiuvasizvbsizcvaeufnuquwhuienczagfcviuahqpcjaducvnzbcvizcaiucb.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);

//volny free
if($_POST["ptx1"]==$freeJM and $_POST["ptx2"]==$freeHE)  //($ppo==1)
{
//zaèátek vykreslování knihovny
echo
"<h2 align=center>Místní lidová knihovna Hlupín</h2>
<hr>
Vítejte v Místní lidové knihovnì Hlupín.<br>
Nyní si mùžete zamluvit na své jméno knihy ze seznamu, které jsou barevnì rozlišeny na 4 <br>
tématické èástí: <b><font color=$bar1>Beletrie</font>, <font color=$bar2>Nauèné</font>, <font color=$bar3>Beletrie pro dìti</font>, <font color=$bar4>Nauèné pro dìti</font>.</b><br>
Staèí vyplnit pole <b>\"Na jmého\"</b> a stisknout tlaèítko <b>\"zamluvit\"</b>. Pokud se u knihy pole <b>\"zamluveno A/N\"</b><br>
vybarví <b><font color=$bta2>oranžovì</font></b> s nápisem <b>\"zamluvená\"</b> a máte jistotu,<br>že kniha je pro vás zamluvena a mùžete si ji pøijít vyzvednout. <br>
Knihovní soubor se aktualizuje ètvrtletnì.
<hr>";

$hled="";
if(!Empty($zajm) and !Empty($czkn)and $zajm!=$defjmen and $zajm!=" ")//zamlouvání
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,1000000));
fclose($u);
//logování chodu
if(!Empty($kni[$czkn-3])and !Empty($kni[$czkn-2]))
{$lg="Zamluvena kniha: <b>{$kni[$czkn-3]}</b> od autora: {$kni[$czkn-2]}, syst: <i>$czkn</i> Žadatel je: <b>$zajm</b> pod login jménem: <b>$ptx1</b> a heslem: $ptx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";}
else
{$lg="syst: <i>$czkn</i> Žadatel je: <b>$zajm</b> pod login jménem: <b>$ptx1</b> a heslem: $ptx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";}
$s_lop="log_fu_n_kni_ho_vn_yy_qpowfjwiuvnruiwvhwjnvuwrhviuzrfuiwjnuvnrwuifwiejfurehguiwhviznwfoujnwrouvhwruof.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);

$pokn=0;
if($zajm=="hledamKN" and $czkn!=" ")
{
echo "
<table border=1 align=center cellpadding=0 cellspacing=2>
<tr>
<th>èíslo knihy</th>
<th>dílo</th>
<th>pøejít</th>
</tr>";

$pocihk=0;//poèítadlo hledaného písmena
$porovkni="";//porovnávací
$porovkni1="";
$porkn[]=0;//poøadí knížky
$cislokn[]=0;
$varianta2=ucfirst($cislokn);
for($i=0;$i<count($kni);$i++)
{
$porovkni=strpos($kni[$i],$cislokn);
$porovkni1=strpos($kni[$i],$varianta2);
if($porovkni!=0 or $porovkni1!=0 or $kni[$i]==$varianta2)
{
//($kni[$i]!=$bar1 or $kni[$i]!=$bar2 or $kni[$i]!=$bar3 or $kni[$i]!=$bar4 or $kni[$i]!="true" or $kni[$i]!="false" or $kni[$i]!=$defjmen)=="true" and 
$pocihk++;
$porkn[$pocihk]=$i;//poøadí knížky dle $i
$ciskni[$pocihk]=round($i/6)+1;
echo
"<tr>
<th>{$ciskni[$pocihk]}</th>
<td>{$kni[$porkn[$pocihk]]}</td>
<td><a href=\"#nal$pocihk\">sem...</a></td>
</tr>";
}//end if   
}//end for
echo 
"</table>
<br>";
if((count($porkn)-1)!=0)
{
$hled="výraz: <b>$czkn</b> nalezen: ".(count($porkn)-1)."x";
$pozhlle="true";
}
else
{
$hled="<br><b>Kniha nenalezena</b>, výraz: <b>$cislokn</b> nenalezen";
$pozhlle="false";
}//end if
}//end hledání
else
{
if($cislokn!=" ")
{
$kni[$cislokn-1]="false";//zamluvení v knihovnì
$kni[$cislokn]=$zajm;
mail("admin.hlupin@seznam.cz","Zamluvení knihy","Byla zamluvena kniha: \n".$kni[$czkn-2]." \n".$kni[$czkn-3]." \nŽadatel: ".$kni[$czkn].", pod loginem: $ptx1 \nv: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //email pro admina
//email pro knihovnicu
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$u=fopen($sb,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);
}//end if
}//end hledani
}
print_r($_POST);
echo
"<table border=0 align=center cellpadding=0 cellspacing=0>
<tr>
<td><img src=\"beletrie_left.png\"></td>
<td><a href=\"#no1\"><img border=0 src=\"beletrie_b1.png\" onmouseover=\"src='beletrie_b1_over.png';\" onmouseout=\"src='beletrie_b1.png';\"></a></td>
<td><a href=\"#no2\"><img border=0 src=\"naucne_b1.png\" onmouseover=\"src='naucne_b1_over.png';\" onmouseout=\"src='naucne_b1.png';\"></a></td>
<td><a href=\"#no3\"><img border=0 src=\"beletrie_pro_mladez_b1.png\" onmouseover=\"src='beletrie_pro_mladez_b1_over.png';\" onmouseout=\"src='beletrie_pro_mladez_b1.png';\"></a></td>
<td><a href=\"#no4\"><img border=0 src=\"naucne_pro_mladez_b1.png\" onmouseover=\"src='naucne_pro_mladez_b1_over.png';\" onmouseout=\"src='naucne_pro_mladez_b1.png';\"></a></td>
<td><img src=\"naucne_pro_madez_right.png\"></td>
</tr>
</table>
<br>

<form method=\"post\">
<input type=\"hidden\" name=\"ptx1\" value=\"".$_POST["ptx1"]."\">
<input type=\"hidden\" name=\"ptx2\" value=\"".$_POST["ptx2"]."\">
<table border=0 align=center cellpadding=0 cellspacing=2>
<tr>
<th>Hledání knihy nebo autora:</th>
<th><input type=text name=hltex></th>
<th><input type=button value=\"Vyhledej knihu\" onclick=\"men.kam.value='knihovna';men.zajm.value='hledamKN';men.czkn.value=hltex.value;men.poslat.click();\"></th>
</tr>
</table>
<center>
$hled
</center>
<br>
<table border=1 align=center cellpadding=0 cellspacing=2>
<tr>
<th>#</th>
<th>Autor</th>
<th>Název</th>
<th>Zamluveno<br>(A/N)</th>
<th>Zapùjèeno<br>(A/N)</th>
<th>Na jméno</th>
<th>Zamluvit</th>
</tr>";

$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,1000000));
fclose($u);

//pokusy...
//$text="malování";
//echo ucfirst($text)."<br>";
//$pss="pedi";
//echo strpos($kni[1],$pss);

$i1=0;
$jmk=0;
$stv="";
$blok="";
$brzam="";
$brzap="";
$pocpor=0;
$ck=0;
for($i=1;$i<((count($kni)-1)/$del)+1;$i++)
{
//$i1=$i1+8;
$ck++;
$jmk=($i*$del)-2;
if($kni[($i*$del)-3]=="true")
{
$stv="volná";
$zamluv="<input type=\"submit\" value=\"Zamluvit\" name=\"akce\">";
$brzam=$bta1;
//<a href=\"index.php?kam=knihovna&ptx1=volny&ptx2=free&zamljm=zamljm$ck&jmkn=$jmk\"></a>
}
else
{
$stv="zamluvená";
$zamluv="------";
$brzam=$bta2;
}
if($kni[($i*$del)-1]=="true")
{
$odn="V knihovnì";
$brzap=$bta3;
}
else
{
$odn="Zapùjèena";
$brzap=$bta4;
}
$pz="";
if($kni[($i*$del)]==$bar1){$pz="no1";}
if($kni[($i*$del)]==$bar2){$pz="no2";}
if($kni[($i*$del)]==$bar3){$pz="no3";}
if($kni[($i*$del)]==$bar4){$pz="no4";}

if(!Empty($pozhlle) and $pozhlle=="true" and !Empty($ciskni))
{
for($i4=0;$i4<count($ciskni);$i4++)
{
if($ciskni[$i4]==$ck)
{ //$kni[$i]==$kni[$porkn[$i]] and 
$pocpor++;
$pz="nal$pocpor";
}//end if
}//end for
}//end if

echo 
"<tr>
<th bgcolor=\"{$kni[($i*$del)]}\"><a name=\"$pz\"></a>$ck</th>
<td>".$kni[($i*$del)-4]."</td>
<td>".$kni[($i*$del)-5]."</td>
<th bgcolor=\"$brzam\">$stv</th>
<th bgcolor=\"$brzap\">$odn</th>
<td><input type=text $blok size=10 value=".$kni[($i*$del)-2]." name=\"zamljm$ck\"></td>
<td>$zamluv</td>
</tr>
";
}//end for
echo 
"</table>
<input type=\"hidden\" name=\"\">
</form>";
//konec vykreslování knihovny

} //end fajn password
else //else dobrého hesla
{
if($jmadmin==$ptx1 and $headmin==$ptx2)
{
//pøidání knížky
if(!Empty($ptx3) and !Empty($ptx4))
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,1000000));
fclose($u);
//nazev, autor, stav, jméno zamluvitele, poloha knihy
//if(Empty($kni[$czkn])){$kni[$czkn]="jmeno";}
$kni[count($kni)+1]=$ptx3; //nazev (-3)
$kni[count($kni)+2]=$ptx4; //autor (-2)
$kni[count($kni)+3]="true"; //zamluvená true=volná (-1)
$kni[count($kni)+4]=$defjmen; //zamluvitel
$kni[count($kni)+5]="true"; //vypujèená true=na místì (+1)
$kni[count($kni)+6]=$ptx0; //barva

$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$u=fopen($sb,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);
}

//zaèátek vykreslování knihovny
echo
"<hr>
Vítejte v Místní lidové knihovnì Hlupín. Jste zaregistrováni pod jménem: <b>$ptx1</b><br>
Nyní si mùžete zamluvit na své jméno knihy ze seznamu, které jsou barevnì rozlišeny na 4 <br>
tématické èástí: <font color=$bar1>Beletrie</font>, <font color=$bar2>Nauèné</font>, <font color=$bar3>Beletrie pro dìti</font>, <font color=$bar4>Nauèné pro dìti</font>.<br>
Staèí vyplnit pole s jménem a stisknout tlaèítko zamluvit. Pokud se u knihy pole \"zamluveno A/N\" <br>
vybarví oranžovì s nápisem \"zamluvená\" máte jistotu, že kniha je pro vás zamluvena a mùžete si ji pøijít vyzvednout. <br>
Knihovní soubor se aktualizuje ètvrtletnì.
<hr>
";
$hled="";
if(!Empty($zajm) and !Empty($czkn)and $zajm!=$defjmen and $zajm!=" ")//zamlouvání
{
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,1000000));
fclose($u);
//logování chodu
if(!Empty($kni[$czkn-3])and !Empty($kni[$czkn-2]))
{
$lg="Zamluvena kniha: <b>{$kni[$czkn-3]}</b> od autora: {$kni[$czkn-2]}, syst: <i>$czkn</i> Žadatel je: <b>$zajm</b> pod login jménem: <b>$ptx1</b> a heslem: $ptx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";
}
else
{
$lg="syst: <i>$czkn</i> Žadatel je: <b>$zajm</b> pod login jménem: <b>$ptx1</b> a heslem: $ptx2, v: ".Date("H:i:s j.m. Y")." z IP: <b>$REMOTE_ADDR</b><br>\n";}
$s_lop="log_fu_n_kni_ho_vn_yy_qpowfjwiuvnruiwvhwjnvuwrhviuzrfuiwjnuvnrwuifwiejfurehguiwhviznwfoujnwrouvhwruof.php";
$u=fopen($s_lop,"a+");
fwrite($u,$lg);
fclose($u);

$pokn=0;
if($zajm=="hledamKN" and !Empty($czkn) and $czkn!=" ")
{
echo 
"<input type=\"hidden\" name=\"kam\" value=\"knihovna\">
<input type=\"hidden\" name=\"ptx1\" value=\"volny\">
<input type=\"hidden\" name=\"ptx2\" value=\"free\">
<input type=\"hidden\" name=\"zamljm\" value=\"zamljm$ck\">
<input type=\"hidden\" name=\"jmkn\" value=\"$jmk\">
<table border=1 align=center cellpadding=0 cellspacing=2>
<tr>
<th>èíslo knihy</th>
<th>dílo</th>
<th>pøejít</th>
</tr>";

$pocihk=0;//poèítadlo hledaného písmena
$porovkni="";//porovnávací
$porovkni1="";
$porkn[]=0;//poøadí knížky
$ciskni[]=0;
$varianta2=ucfirst($czkn);
for($i=0;$i<count($kni);$i++)
{
$porovkni=strpos($kni[$i],$czkn);
$porovkni1=strpos($kni[$i],$varianta2);
if($porovkni!=0 or $porovkni1!=0 or $kni[$i]==$varianta2)
{
//if(($kni[$i]!="false" or $kni[$i]!=$defjmen) and ($porovkni!=0 or $porovkni1!=0))
$pocihk++;
$porkn[$pocihk]=$i;//poøadí knížky dle $i
$ciskni[$pocihk]=round($i/6)+1;
echo
"<tr>
<th>{$ciskni[$pocihk]}</th>
<td>{$kni[$porkn[$pocihk]]}</td>
<td><a href=\"#nal$pocihk\">sem...</a></td>
</tr>";
}//end if   
}//end for
echo 
"</table>
<br>";
if((count($porkn)-1)!=0)
{
$hled="výraz: <b>$czkn</b> nalezen: ".(count($porkn)-1)."x";
$pozhlle="true";
}
else
{
$hled="<br><b>Kniha nenalezena</b>, výraz: <b>$czkn</b> nenalezen";
$pozhlle="false";
}//end if
}//end if hledani
else
{
if($zajm=="smazatAM" and !Empty($czkn) and $czkn=="delete")//smazaní
{  //smazat mùže jen nezamluvené a nevypùjèené!!!!! dodìlat!!!
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"w");
$kni=" ";
fwrite($u,$kni);
fclose($u);
echo "<br><b>Vymazány všechny knížky.</b>";
}
else
{
if($zajm=="nikdoAM")//uvolnìní
{
$kni[$czkn-1]="true"; //zamluvení
$kni[$czkn]=$defjmen;
$kni[$czkn+1]="true"; //vypùjèená
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$u=fopen($sb,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);
}
else
{
if(!Empty($vyp) and $vyp=="vypuceno")
{
$kni[$czkn+1]="false";//vypùjèená z knihovny
$kni[$czkn]=$zajm;
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$u=fopen($sb,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);
}
else
{
$kni[$czkn-1]="false";//zamluvení v knihovnì
$kni[$czkn]=$zajm;
mail("admin.hlupin@seznam.cz","Zamluvení knihy","Byla zamluvena kniha: \n".$kni[$czkn-2]." \n".$kni[$czkn-3]." \nŽadatel: ".$kni[$czkn].", pod loginem: $ptx1 \nv: ".Date("H:i:s j.m. Y")." \nz IP: $REMOTE_ADDR"); //email pro admina
//email pro knihovnicu
$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";
$u=fopen($sb,"w");
fwrite($u,implode($kni,"***BD***"));
fclose($u);
}
}
}//end else smaž
}//end hledani
}
echo
"<table border=0 align=center cellpadding=0 cellspacing=0>
<tr>
<td><img src=\"beletrie_left.png\"></td>
<td><a href=\"#no1\"><img border=0 src=\"beletrie_b1.png\" onmouseover=\"src='beletrie_b1_over.png';\" onmouseout=\"src='beletrie_b1.png';\"></a></td>
<td><a href=\"#no2\"><img border=0 src=\"naucne_b1.png\" onmouseover=\"src='naucne_b1_over.png';\" onmouseout=\"src='naucne_b1.png';\"></a></td>
<td><a href=\"#no3\"><img border=0 src=\"beletrie_pro_mladez_b1.png\" onmouseover=\"src='beletrie_pro_mladez_b1_over.png';\" onmouseout=\"src='beletrie_pro_mladez_b1.png';\"></a></td>
<td><a href=\"#no4\"><img border=0 src=\"naucne_pro_mladez_b1.png\" onmouseover=\"src='naucne_pro_mladez_b1_over.png';\" onmouseout=\"src='naucne_pro_mladez_b1.png';\"></a></td>
<td><img src=\"naucne_pro_madez_right.png\"></td>
</tr>
</table>
<br>
<center>
<a href=\"zapucene_kn.php\" target=\"_blank\">Vypis zapùjèených knih</a>
</center>
<br>
<form method=\"post\">
<table border=0 align=center cellpadding=0 cellspacing=2>
<tr>
<th>Hledání knihy nebo autora:</th>
<th><input type=text name=hltex></th>
<th><input type=button value=\"Vyhledej knihu\" onclick=\"men.kam.value='knihovna';men.zajm.value='hledamKN';men.czkn.value=hltex.value;men.poslat.click();\"></th>";
echo
"</tr>
</table>
<center>
$hled
</center>
<br>
<table border=1 align=center cellpadding=0 cellspacing=2>
<tr>
<th>#</th>
<th>Autor</th>
<th>Název</th>
<th>Zamluveno (A/N)</th>
<th>Zapùjèeno (A/N)</th>
<th>Na jméno</th>
<th>Zamluvit (U)</th>
<th>Vypùjèit (A)</th>
<th>Uvolnit vše (A)</th>

<th colspan=2>Pøíkaz (A)</th>
</tr>";

$sb="DB_kn_chr_csdkojvnsdjncoipqiojwfiunvdjfnsfiswuhvoisejgiurhfoivueiuhbwiuvirsgourehniuwhfjviuheoifwoijhvurehoiuwrj.php";             
$u=fopen($sb,"r");
$kni=explode("***BD***",fread($u,1000000));
fclose($u);

$i1=0;
$jmk=0;
$stv="";
$blok="";
$blok1="";
$brzam="";
$brzap="";
$pocpor=0;
$ck=0;
for($i=1;$i<((count($kni)-1)/$del)+1;$i++)
{
//$i1=$i1+8;
$ck++;
$jmk=($i*$del)-2;
if($kni[($i*$del)-3]=="true")//zamluvení
{
$stv="volná";
$blok="";
$blok1="disabled";//blok vydání pøed zamluvením
$brzam=$bta1;
}
else
{
$stv="zamluvená";
$blok="disabled";
$blok1="";//blok vydání
$brzam=$bta2;
}
if($kni[($i*$del)-1]=="true")//pùjèení
{
$odn="V knihovnì";
$brzap=$bta3;
//$blok1="";
}
else
{
$odn="Zapùjèena";
$brzap=$bta4;
$blok1="disabled";
}
$pz="";//pozicování
if($kni[($i*$del)]==$bar1){$pz="no1";}
if($kni[($i*$del)]==$bar2){$pz="no2";}
if($kni[($i*$del)]==$bar3){$pz="no3";}
if($kni[($i*$del)]==$bar4){$pz="no4";}

if(!Empty($pozhlle) and $pozhlle=="true" and !Empty($ciskni))
{
for($i4=0;$i4<count($ciskni);$i4++)
{
if($ciskni[$i4]==$ck)
{ //$kni[$i]==$kni[$porkn[$i]] and 
$pocpor++;
$pz="nal$pocpor";
}//end if
}//end for
}//end if

echo 
"<tr>
<th bgcolor=".$kni[($i*$del)]."><a name=\"$pz\"></a>$ck</th>
<td>".$kni[($i*$del)-4]."</td>
<td>".$kni[($i*$del)-5]."</td>
<th bgcolor=\"$brzam\">$stv</th>
<th bgcolor=\"$brzap\">$odn</th>
<td><input type=text $blok size=10 value=".$kni[($i*$del)-2]." name=zamljm$ck></td>
<td><input type=button $blok name=zaml$ck value=\"Zamluvit\" onclick=\"men.kam.value='knihovna';men.zajm.value=zamljm$ck.value;men.czkn.value='$jmk';men.poslat.click();\"></td>
<td><input type=button $blok1 name=zaml$ck value=\"Vydat\" onclick=\"men.kam.value='knihovna';men.zajm.value=zamljm$ck.value;men.czkn.value='$jmk';men.vyp.value='vypuceno';men.poslat.click();\"></td>
<td><input type=button name=zaml$ck value=\"Vráceno\" onclick=\"men.kam.value='knihovna';men.zajm.value='nikdoAM';men.czkn.value='$jmk';men.poslat.click();\"></td>
<td>..</td>
<td>..</td>
</tr>
";
}//end for
echo 
"</table>";
//konec vykreslování knihovny

echo 
"<br>
<script language=\"JavaScript\">
function volna(povel)
{
if(povel==true)
{
zamjm.value='nikdo';
zamjm.disabled='false';
}
}
function typo(pov)
{
if(pov==1){men.ptx0.value='$bar1';} //barvy
if(pov==2){men.ptx0.value='$bar2';}
if(pov==3){men.ptx0.value='$bar3';}
if(pov==4){men.ptx0.value='$bar4';}
}
</script>
<hr>
<h1 align=center>Admin sekce knihovny</h1>
<table border=1 align=center>
<tr>
<th colspan=2>Pøidat knížku</th>
</tr>

<tr>
<td>Název knížky</td>
<td><input type=text name=nazev></td>
</tr>

<tr>
<td>Autor knížky</td>
<td><input type=text name=autor></td>
</tr>

<tr>
<td>Typ</td>
<td>
<input type=radio name=typ onclick=\"typo(1);\">Beletrie<br>
<input type=radio name=typ onclick=\"typo(2);\">Nauèná<br>
<input type=radio name=typ onclick=\"typo(3);\">Beletrie pro mládež<br>
<input type=radio name=typ onclick=\"typo(4);\">Nauèná pro mládež
</td>
</tr>

<tr>
<th colspan=2><input type=button value=\"Pøidej knížku...\" onclick=\"men.kam.value='knihovna';men.ptx3.value=nazev.value;men.ptx4.value=autor.value;men.poslat.click();\"></th>
</tr>
</table>
<br>
<hr>
<br>
<center>
Pojistka proti náhodnému smazání<br><input type=text disabled name=poj><br>Pro potvrzení poklepejte na tento text: <b ondblclick=\"poj.value='delete';\">delete</b><br>
<input type=button name=zamlKO value=\"Smazat všecny knížky\" ondblclick=\"men.kam.value='knihovna';men.zajm.value='smazatAM';men.czkn.value=poj.value;men.poslat.click();\">
</center>
<hr>
</form>";

}//else admina
else
{
echo "<br><br><br><br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nemáte pøístup</h2>";
}
}//end if else
}//end else zobrazení

*/

//print "<br><b>".$kni[$czkn]."</b><br><b>".$kni[$czkn-1]."</b>";
/*
$sb_uz="kn_h_s_qwpojneunvoiwnvoiwnoiurevreuhvurehgowrghoiehoiuwhgiunfirunvrvieurnhgunviuenviuenguegiuerjviureh.php";
$u=fopen($sb_uz,"r");
$uziv=explode("--*kn*--",fread($u,1000000));
fclose($u);
//$ptx1 //jméno
//$ptx2 //heslo
$ppo=0;
for($p=1;$p<count($uziv);$p++)
{
if($ptx1==$uziv[$p] and $ptx2==$uziv[$p+1])
{
$ppo++;
}//end if
}//end for

if($ppo==1)
{$prii="povoleno";}
else
{$prii="nepovoleno";}
 - $prii
*/
?>
