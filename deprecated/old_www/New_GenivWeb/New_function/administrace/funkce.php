<?  //3A79C1
function DelkaOtvirani($Kde)
{
$soub="$Kde/delka_otvirani_qpfsiuvsoifjsoiivhsfkivjodihbodihvoidfjvsiuovsiohriohveoihg.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//-------------------------------------------------------------------------
function DelkaRegistrace($Kde)
{
$soub="$Kde/delka_registrovanych_qpdjoifhiuwrvoiwuciqpoewsjhifvbisufiureiujnwirufbiurviuedfbfu.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//-------------------------------------------------------------------------
function Banovani($Adresa)
{
$soub="administrace/ban_lide_qpowdjiushiuosoisvsoivhisuhvwesdiugcgweuzicisuhcviuuuhwuhweoqwefndfuhbsdh.php";
$delkaotv=DelkaOtvirani("administrace");
$u=fopen($soub,"r");
$ban=explode("--BAN--",fread($u,$delkaotv));
fclose($u);

$poc=0;
for($i=1;$i<count($ban);$i++)
{
if($ban[$i]==$Adresa){$poc++;}
}//end for

if($poc!=0)
{
print "nepovolený pøístup!!";
exit;
}//end if poc
}
//-------------------------------------------------------------------------
function Login($Jmeno,$Heslo)
{
$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$del=DelkaRegistrace("administrace");
$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno==$udaj[$i] and $Heslo==$udaj[$i+1] and $udaj[$i+14]==""){$poc++;}
}//end for

if($poc==1)
{return "true";}
else
{return "false";}

/*
login jmeno   -0
heslo         -1
idecko        -2
email
jmeno
prijmeni
icq
www
zájmy
bydliste
povolani
pohlaví
podpis
poèet pøíspìvkù
autorizaèní kód
obrázek
založení
typ pøístupu
hodnoceni
19...

//$del=DelkaRegistrace("administrace");
//$udaj[((($poc+4)/$del)*$del)-18]; //ok!!
*/
}
//-------------------------------------------------------------------------
function Registrace($login,$heslo1,$heslo2,$email,$jmeno,$prijmeni,$icq,$www,$zajmy,$bydliste,$povolani,$pohlavi,$podpis,$server,$slozka,$adresa)
{
$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$login){$poc++;}
if($udaj[$i]==$email){$poc++;}
}//end for

if($poc!=0){$stav="false";}

$kon_em=strpos($email,"@");
if($heslo1==$heslo2 and $poc==0 and $kon_em!=0)
{
$autoriz=AutorizacniKod();//autorizace
$idc=GeneratorID();

$udaj[0]="<?php";
$udaj[count($udaj)+1]=$login;
$udaj[count($udaj)+2]=$heslo1;
$udaj[count($udaj)+3]=$idc;//ideèko
$udaj[count($udaj)+4]=$email;
$udaj[count($udaj)+5]=$jmeno;
$udaj[count($udaj)+6]=$prijmeni;
$udaj[count($udaj)+7]=$icq;
$udaj[count($udaj)+8]=$www;
$udaj[count($udaj)+9]=$zajmy;
$udaj[count($udaj)+10]=$bydliste;
$udaj[count($udaj)+11]=$povolani;
$udaj[count($udaj)+12]=$pohlavi;
$udaj[count($udaj)+13]=$podpis;
$udaj[count($udaj)+14]=0;//poèet pøíspìvkù
$udaj[count($udaj)+15]=$autoriz;//autorizace
$udaj[count($udaj)+16]="";//obrázek
$udaj[count($udaj)+17]=Date("j.n.Y");//založení
$udaj[count($udaj)+18]=0;//typ pøístupu
$udaj[count($udaj)+19]=0;//hodnoceni

$text=
"<?
require \"administrace/funkce.php\";
Autorizace($autoriz);
?>
Váš úèet s doèasným èíslem <b>$autoriz</b> byl aktivován.<br>
Kliknìte <a href=\"http://$server/$slozka/index.php?kam=uvod\">zde</a> pro pøihlášení.";

$soub1="autorizace_{$autoriz}.php";
$u=fopen($soub1,"w");
fwrite($u,$text);
fclose($u);

$link="http://$server/$slozka/$soub1";

mail($email,"Geniv web - registrace","Dobrý den! \n Vaše registrace probìhla úspìšnì! Registrace zatím néni potvrzená! \n Pro potvrzení kliknìte na následující odkaz: $link \n Vaše udaje pro pøihlášení jsou: \n Login: $login \n Heslo: $heslo1 \n Tento email peèlivì uložte na bezpeèné místo. Dìkuji a s pozdravem Geniv!");
mail("geniv@centrum.cz","Nový klient: $login","Zaregistroval se nový klient. \n Login: $login \n Email: $email \n Aktivaèní odkaz: $link \n v: ".Date("H:i:s j.m. Y")." \n z IP: $adresa");

$u=fopen($soub,"w");
fwrite($u,implode($udaj,"--REG--"));
fclose($u);

$stav="true";
}

return $stav;
}
//-------------------------------------------------------------------------
function AutorizacniKod()
{
$poc="";
for($i=1;$i<10;$i++)
{
$poc.=rand(1,1000);
}//end for
return $poc;
}
//-------------------------------------------------------------------------
function GeneratorID()
{
$poc=0;
for($i=0;$i<20;$i++)
{
$poc.=rand(10,10000);
}//end for
return $poc;
}
//-------------------------------------------------------------------------
function Autorizace($Kod)
{
$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$Kod){$poc=$i;}
}//end for

if($poc!=0)
{
unlink("autorizace_{$udaj[$poc]}.php");//smazání!
$udaj[$poc]="";//vyprázdnìní pozice
$u=fopen($soub,"w");
fwrite($u,implode($udaj,"--REG--"));
fclose($u);
}//end if
}
//-------------------------------------------------------------------------
function IdeckoUzivatele($Jmeno,$Heslo)
{
$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$del=DelkaRegistrace("administrace");
$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($Jmeno==$udaj[$i] and $Heslo==$udaj[$i+1]){$poc=$i;}
}//end for
return $udaj[$poc+2];
}
//-------------------------------------------------------------------------
function HlavniLogovani($Jmeno,$Sekce,$Adresa)
{
$text="Uživatel $Jmeno klikl na: <b>$Sekce</b> v:".Date("H:i:s j.n. Y")." z IP: $Adresa<br>\n";
$soub="administrace/logovani_hlavni_sdhvbfdvwoiedhfruiiwufuiredifnvdfiuonvzugbuozvhgviujgviuecdztzfg.php";
$u=fopen($soub,"a+");
fwrite($u,$text);
fclose($u);
}
//-------------------------------------------------------------------------
function LogovaniLogin($Jmeno,$Heslo,$Adresa,$Stav)
{
if($Stav=="true")
{$pov="povoleno";}
else
{$pov="zakázano";}
$text="Pøihlašování: <b>$Jmeno</b> s heslem: <b>$Heslo</b> v: ".Date("H:i:s j.m. Y")." z IP: $Adresa pøístup: <b>$pov</b><br>\n";
$soub="administrace/logovani_prihlasovani_dujgzufshvckjsnvdfifuhviksjfvowhbfdjvhsvb.php";
$u=fopen($soub,"a+");
fwrite($u,$text);
fclose($u);
}
//-------------------------------------------------------------------------
function jdi_na_stranku($stranka,$pocet_stran,$sekce)
{
//aplikovat!!
//ještì upozoròování na email!
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
//-------------------------------------------------------------------------
function UlozProfil()
{


}
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
?>
