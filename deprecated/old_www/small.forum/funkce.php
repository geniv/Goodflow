<?
function registrace($jmeno,$heslo,$heslo_1,$email,$icq,$aol,$msn,$yah,$www,$lokace,$povolani,$zajmy,$podpis,$skremail,$server,$slozka)
{
$delkasoub=delka_souboru();
$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--UI--",fread($u,$delkasoub));
fclose($u);

$pocp=0;//vyhledání duplikátù
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno){$pocp++;}//jméno email!
if($udaj[$i]==$email){$pocp++;}
}//end for

if($pocp!=0)//kontrola duplikátù
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
$udaj[count($udaj)+14]=1; //typ: uživatel
$udaj[count($udaj)+15]=$obr; //cesta obrázku
$udaj[count($udaj)+16]=Date("j.n.Y");//založení
$udaj[count($udaj)+17]=$genjm;//generované èíslo
$udaj[count($udaj)+18]=0;//poèet pøíspìvkù
//$udaj[count($udaj)+22]=$pohlavi;//pohlaví
//$udaj[count($udaj)+23]=1;//hodnoceni dle pøíspìvkù


$tex="<?
include \"funkce.php\";
autorizace($genjm);
?>
<b>Váš uèet s doèasným èíslem <u><? print $genjm; ?></u> byl aktivován.</b> 
<b>Kliknìte <a href=\"http://$server/$slozka/index.php?kam=login\"><u>zde</u></a> pro pøihlášení.</b>"; //obsah stránky

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

mail($email,"fórum - Registrace","Dobrý den,\n\nVaše registrace byla zaznamenána.\nRegistrace zatím není potvrzena. Pro potvrzení klapnìte na následující odkaz, který aktivuje Váš úèet.\n\n$link.\n\nVaše pøihlašovací údaje:\n--------------------------\nJméno: $jmeno\nHeslo: $heslo_1\n--------------------------\n\nTento e-mail si prosím uschovejte.\n\nDìkuji."); //pro klienta
//mail("fugess.martin@centrum.cz","Žádost o registraci na Fugessovì fóru","Registruje se klient: $jmeno \ns emailem: $email \ns heslem: $heslo_1 \n Jeho aktivaèni odkaz: $link \nv: ".Date("H:i:s j.m. Y")." \nz IP: $adresa"); //pro admina na email

$sb_hes="regi_str_ovani_clenove_qpdfojcnsfiujvnsdoifhvdfiunvdofnbvidfjnsvskjvoijsdfnbvisjijvndfskjvnkdjfv.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--UI--"));
fclose($u);
$stav="true";
}//end if rovná se heslo
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
unlink($soubor);//smazání autorizaèního souboru
}//end if vymaz 
}
//--------------------------------------------------------------------------
function cesta_ve_foru($kde,$ur1,$ur2)
{
$zacat=nazev_fora();
if(!Empty($kde))
{
if($kde=="hledani"){$text="Hledat";}
if($kde=="uzivatele"){$text="Seznam uživatelù";}
if($kde=="skupiny"){$text="Uživatelské skupiny";}
if($kde=="profil"){$text="Profil";}
if($kde=="inbox"){$text="Soukromé zprávy";}
if($kde=="info_user"){$text="Informace o uživateli";}
if($kde=="logoff"){$text="Odhlášení";}
if($kde=="login" or $kde=="prihlaseni"){$text="Pøihlášení";}
if($kde=="registrace"){$text="Registrace";}
//if($kde=="novy_topik"){$text="Nové téma";}
//if($kde=="novy_pris"){$text="Forum";}
if($kde=="zap_heslo"){$text="Zapomenuté heslo";}
if($kde=="vn_tp"){$text="Nevyplnily jste text nebo pøedmìt zprávy";}
if($kde=="vn_pr"){$text="Nevyplnily jste text zprávy";}
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
if(date("w")=="0"){$den="nedìle";}
if(date("w")=="1"){$den="pondìlí";}
if(date("w")=="2"){$den="úterý";}
if(date("w")=="3"){$den="støeda";}
if(date("w")=="4"){$den="ètvrtek";}
if(date("w")=="5"){$den="pátek";}
if(date("w")=="6"){$den="sobota";}

if(date("n")=="1"){$mes="leden";}
if(date("n")=="2"){$mes="únor";}
if(date("n")=="3"){$mes="bøezen";}
if(date("n")=="4"){$mes="duben";}
if(date("n")=="5"){$mes="kvìten";}
if(date("n")=="6"){$mes="èerven";}
if(date("n")=="7"){$mes="èervenec";}
if(date("n")=="8"){$mes="srpen";}
if(date("n")=="9"){$mes="záøí";}
if(date("n")=="10"){$mes="øíjen";}
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
