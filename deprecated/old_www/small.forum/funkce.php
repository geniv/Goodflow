<?
function registrace($jmeno,$heslo,$heslo_1,$email,$icq,$aol,$msn,$yah,$www,$lokace,$povolani,$zajmy,$podpis,$skremail,$server,$slozka)
{
$delkasoub=delka_souboru();
$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--UI--",fread($u,$delkasoub));
fclose($u);

$pocp=0;//vyhled�n� duplik�t�
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno){$pocp++;}//jm�no email!
if($udaj[$i]==$email){$pocp++;}
}//end for

if($pocp!=0)//kontrola duplik�t�
{$stav="false";}

$koema=strpos($email,"@");
if($heslo==$heslo_1 and $koema!=0 and $pocp==0)
{
$genjm=autorizacni_kod();
$obr="";

$udaj[0]="<?php";//ochrana!!
$udaj[count($udaj)+1]=$jmeno;
$udaj[count($udaj)+2]=$email;
$udaj[count($udaj)+3]=$heslo_1;
$udaj[count($udaj)+4]=$icq;
$udaj[count($udaj)+5]=$aol;
$udaj[count($udaj)+6]=$msn;
$udaj[count($udaj)+7]=$yah;
$udaj[count($udaj)+8]=$www;
$udaj[count($udaj)+9]=$lokace;
$udaj[count($udaj)+10]=$povolani;
$udaj[count($udaj)+11]=$zajmy;
$udaj[count($udaj)+12]=$podpis;
$udaj[count($udaj)+13]=$skremail;
$udaj[count($udaj)+14]=1; //typ: u�ivatel
$udaj[count($udaj)+15]=$obr; //cesta obr�zku
$udaj[count($udaj)+16]=Date("j.n.Y");//zalo�en�
$udaj[count($udaj)+17]=$genjm;//generovan� ��slo
$udaj[count($udaj)+18]=0;//po�et p��sp�vk�
//$udaj[count($udaj)+22]=$pohlavi;//pohlav�
//$udaj[count($udaj)+23]=1;//hodnoceni dle p��sp�vk�


$tex="<?
include \"funkce.php\";
autorizace($genjm);
?>
<b>V� u�et s do�asn�m ��slem <u><? print $genjm; ?></u> byl aktivov�n.</b> 
<b>Klikn�te <a href=\"http://$server/$slozka/index.php?kam=login\"><u>zde</u></a> pro p�ihl�en�.</b>"; //obsah str�nky

$soub="autorizace_{$genjm}.php";
$uk=fopen($soub,"w");
fwrite($uk,$tex);
fclose($uk);

//soubor s emaily  --EMA--
$tex_me="<?php";
$soub_me="{$jmeno}_qpefojvdbknvmlfldnvdgikjbnqpwoeiwrsjgdhuipqwkeojrsgqpwokewirsjfdfovjn.php";
$uk=fopen($soub_me,"w");
fwrite($uk,$tex_me);
fclose($uk);

$link="http://$server/$slozka/$soub";
//logovani_aktivace($adresa,$link,$soub);

mail($email,"f�rum - Registrace","Dobr� den,\n\nVa�e registrace byla zaznamen�na.\nRegistrace zat�m nen� potvrzena. Pro potvrzen� klapn�te na n�sleduj�c� odkaz, kter� aktivuje V� ��et.\n\n$link.\n\nVa�e p�ihla�ovac� �daje:\n--------------------------\nJm�no: $jmeno\nHeslo: $heslo_1\n--------------------------\n\nTento e-mail si pros�m uschovejte.\n\nD�kuji."); //pro klienta
//mail("fugess.martin@centrum.cz","��dost o registraci na Fugessov� f�ru","Registruje se klient: $jmeno \ns emailem: $email \ns heslem: $heslo_1 \n Jeho aktiva�ni odkaz: $link \nv: ".Date("H:i:s j.m. Y")." \nz IP: $adresa"); //pro admina na email

$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--UI--"));
fclose($u);
$stav="true";
}//end if rovn� se heslo
return $stav;
}
//--------------------------------------------------------------------------
function delka_souboru()
{
$soubr="del_ka_otvir_soub_qpojfnsufiovsdvjnrkjnvedwfivnoiasujfjvdfijvniadjfnviadjfhvidjfnbviunbiujsnbv.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,100);
fclose($u);
return $delkasoub;
}
//--------------------------------------------------------------------------
function autorizacni_kod()
{
$nahc[]=0;
$nazn="";
for($i=0;$i<12;$i++)
{
$nahc[$i]=rand(10,5000);
$nazn.=$nahc[$i];
}
return $nazn;
}
//--------------------------------------------------------------------------
function autorizace($cislo)
{
$delkasoub=delka_souboru();
$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--UI--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace();

$i1=0;
$cis=0;
for($i=1;$i<count($udaj);$i++)
{
$i1=$i1+($pocet+2);
if($cislo==$udaj[$i])
{$cis=$i;}
}//end for

$soubor="autorizace_{$cislo}.php";

if($cis!=0)
{
$udaj[$cis]="";
$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--UI--"));
fclose($u);
unlink($soubor);//smaz�n� autoriza�n�ho souboru
}//end if vymaz 
}
//--------------------------------------------------------------------------
function cesta_ve_foru($kde,$ur1,$ur2)
{
$zacat=nazev_fora();
if(!Empty($kde))
{
if($kde=="hledani"){$text="Hledat";}
if($kde=="uzivatele"){$text="Seznam u�ivatel�";}
if($kde=="skupiny"){$text="U�ivatelsk� skupiny";}
if($kde=="profil"){$text="Profil";}
if($kde=="inbox"){$text="Soukrom� zpr�vy";}
if($kde=="info_user"){$text="Informace o u�ivateli";}
if($kde=="logoff"){$text="Odhl�en�";}
if($kde=="login" or $kde=="prihlaseni"){$text="P�ihl�en�";}
if($kde=="registrace"){$text="Registrace";}
//if($kde=="novy_topik"){$text="Nov� t�ma";}
//if($kde=="novy_pris"){$text="Forum";}
if($kde=="zap_heslo"){$text="Zapomenut� heslo";}
if($kde=="vn_tp"){$text="Nevyplnily jste text nebo p�edm�t zpr�vy";}
if($kde=="vn_pr"){$text="Nevyplnily jste text zpr�vy";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
if($ur1!=0)
{
if($ur2!=0)
{
$urov=temata_fora($ur1);
$urov1=temata_topiku($ur1,$ur2);
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> <A href=\"index.php?kam=forum&cis=$ur1&str=1\">$urov</a> -> <A href=\"index.php?kam=obsah_tema&cis=$ur1&pris=$ur2&str=1\">$urov1</a>";
}
else
{
$urov=temata_fora($ur1);
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> <A href=\"index.php?kam=forum&cis=$ur1&str=1\">$urov</a>";
}//end else if ul2
}
else
{if(Empty($text)){$text="";}
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> $text";}

}
else
{return "<a href=\"index.php\" class=\"nav\">$zacat</a>";}
}
//--------------------------------------------------------------------------
function datum()
{
if(date("w")=="0"){$den="ned�le";}
if(date("w")=="1"){$den="pond�l�";}
if(date("w")=="2"){$den="�ter�";}
if(date("w")=="3"){$den="st�eda";}
if(date("w")=="4"){$den="�tvrtek";}
if(date("w")=="5"){$den="p�tek";}
if(date("w")=="6"){$den="sobota";}

if(date("n")=="1"){$mes="leden";}
if(date("n")=="2"){$mes="�nor";}
if(date("n")=="3"){$mes="b�ezen";}
if(date("n")=="4"){$mes="duben";}
if(date("n")=="5"){$mes="kv�ten";}
if(date("n")=="6"){$mes="�erven";}
if(date("n")=="7"){$mes="�ervenec";}
if(date("n")=="8"){$mes="srpen";}
if(date("n")=="9"){$mes="z���";}
if(date("n")=="10"){$mes="��jen";}
if(date("n")=="11"){$mes="listopad";}
if(date("n")=="12"){$mes="prosinec";}

return "$den, ".date("j")." $mes, ".date("Y H:i");
}
//--------------------------------------------------------------------------
function delka_registrace()
{
$delkasoub=delka_souboru();
$sb_del="poc_poliii_qowijcorshvuhhqoiwjfugvbhnnnvfvvnqoownwvoionnnnsonwivnwreiujunowjnwkdjncvksdnv.php";
$u=fopen($sb_del,"r");
return fread($u,$delkasoub);
fclose($u);
}
//--------------------------------------------------------------------------
function login($jmeno,$heslo)
{
$delkasoub=delka_souboru();
$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--UI--",fread($u,$delkasoub));
fclose($u);

$pris=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo and $udaj[$i+17]=="")
{$pris++;}
}//end for

if($pris==1)
{return "true";}//povoleno
else
{return "false";}
}
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
?>
