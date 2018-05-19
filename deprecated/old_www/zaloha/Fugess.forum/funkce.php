<?
//$pole=array("jmeno"=>"aaaa","bbbb","cccc","prijmeni"=>"fryšta","dddd","eeee");
//print_r ($pole);
/*
function test($neco)
{
return $neco." tadá";
}
$i="ahoj";
print test($i);
*/
//print "$HTTP_ACCEPT, $REMOTE_ADDR, $HTTP_USER_AGENT, $REQUEST_METHOD, $SERVER_PORT, $SERVER_PROTOCOL, $GATEWAY_INTERFACE, $SERVER_NAME, $QUERY_STRING, $SCRIPT_NAME, $PATH_TRANSLATED, $SERVER_SOFTWARE, ";

//print gethostbyaddr($REMOTE_ADDR);
//basename(getcwd());

//print $link;
//"<a href=\"http://$server/$slozka/$soub\">http://$server/$slozka/$soub</a>";


/*
seznamy a pomocný admin:
ak_ti_v_li_nky_qwpfoeijgsfnxiokmsciovsnviuojsdcvuisfnvmcoiaesdvjnsudnvsdounosdncoiudanciodnviusbvuzwreg.php
admin_hlavni.php
admin_index.php
admin_menu.php

logování:
akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php
hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php
prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php
seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php
zas_la_ni_h_es_la_qwpfdkcosiovnsriunvsornvsnoijnvsfoinsokjkjnsfjniujbndonrsonkjnskjvnbrfjnjn.php

jine:
ban_li_di_qpwdfjwoiunvrnvirwezbvbzeuivnwruzniwujenviuubnwieufzuhqzqwvfvwf.php
del_ky_qwpdfojaedsvinuidfsvjnaosdfnvuaidfghnvsdifviufhvnriugvnsaidfhnasfviodufgnrsforglnasfqwpoidfjajdfioqp.php
nad_pi_s_qwpdojsniufcojsiufvhjnviurebhfcbvjdoiqpowdfncwdfkjmvnwriufcmireuíhjoiewghvisucjwruvbwiuijfiwuhfuehfiwhufeueueuuueueuckaeinef.php
te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php
poz_namky_dlkjfhiwocniwspqwejfowwchnzsiudcmrweiuvbcnwreuivzbuisfnvezuhvbnwrezuisjfhvnerjhkfvherniuvnervjkhejhverhjv.php
re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php

//$delkasoub=delka_souboru();

//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}
//---------------------------------------------------------------------
function ()
{

}*/
//---------------------------------------------------------------------
function prekopej_text($text)
{
$upr[0]=str_replace("[b]","<b>",$text);
$upr[1]=str_replace("[/b]","</b>",$upr[0]);
$upr[2]=str_replace("[i]","<i>",$upr[1]);
$upr[3]=str_replace("[/i]","</i>",$upr[2]);
$upr[4]=str_replace("[u]","<u>",$upr[3]);
$upr[5]=str_replace("[/u]","</u>",$upr[4]);

//$upr[1]=str_replace("[/b]","<b>",$upr[0]);
//$upr[1]=str_replace("[/b]","<b>",$upr[0]);
//$upr[1]=str_replace("[/b]","<b>",$upr[0]);
//$upr[1]=str_replace("[/b]","<b>",$upr[0]);
//$upr[1]=str_replace("[/b]","<b>",$upr[0]);
//$upr[1]=str_replace("[/b]","<b>",$upr[0]);
//$upr[1]=str_replace("[/b]","<b>",$upr[0]);

return $upr[5];
}
//---------------------------------------------------------------------
function vygeneruj_nazev_obrazku($typ)
{
if($typ=="image/gif"){$konc=".gif";}
if($typ=="image/pjpeg"){$konc=".jpg";}
$slz=0;
for($i=1;$i<10;$i++)
{
$slz.=rand(1,1000);
}//end for
return "$slz$konc";
}
//---------------------------------------------------------------------
function zapomel_heslo($jmeno,$email,$adr)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$ppm=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+1]==$email){$ppm=$i;}
}//end for

$tex="Zaslány udaje uživatele: <b>$jmeno</b> s emailem: <b>$email</b>, zaslané heslo: <i>{$udaj[$ppm+2]}</i> v: ".Date("H:i:s j.n. Y")." z IP: $adr<br>\n";
$soub="zas_la_ni_h_es_la_qwpfdkcosiovnsriunvsornvsnoijnvsfoinsokjkjnsfjniujbndonrsonkjnskjvnbrfjnjn.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);

if($ppm!=0)
{
$heslo=$udaj[$ppm+2];
mail($email,"Údajde - Fugess-Trainz-CZ","Dobrý den, Vaše žádost o heslo na Fugess Trainz CZ byla zaznamenána. \n Vaše udaje: \n Jméno: $jmeno \n Heslo: $heslo \n Dìkuji, Fugess."); //pro klienta
mail("fugess.martin@centrum.cz","Žádost o údaje na Fugess.Trainz.CZ: ","Zjištìní údajù klienta: $jmeno \ns emailem: $email \ns heslem: $heslo \nv: ".Date("H:i:s j.m. Y")." \nz IP: $adr"); //pro admina na email
return "true";
}
else
{return "false";}
}
//---------------------------------------------------------------------
function anonymnich($adr)//doøešit!!
{
return pocet_uzivatelu($adr)-((pocet_pritomnych_2()-1)/2);
}
//---------------------------------------------------------------------
function registrovanych()//doøešit!!
{
return ((pocet_pritomnych_2()-1)/2);
}
//---------------------------------------------------------------------
function obnov_pritomne()//doøešit!!
{
$uziv="";
$delkasoub=delka_souboru();
$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"w");
fwrite($u,$uziv);
//$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

$soub="ip_na_ser_ve_ru_qwpfocemrimvwgvunisuocnmwriuvnisuvnreiuvnusvhnjwsdcoilkjhnwkvnkwdfv.php";
$u=fopen($soub,"w");
fwrite($u,$uziv);
//$adr=explode("--IP--",fread($u,$delkasoub));
fclose($u);
}
//---------------------------------------------------------------------
function odpocet($cas)//doøešit!!
{
if($cas==59){obnov_pritomne();}//dodìlat!
}
//---------------------------------------------------------------------
function pocet_pritomnych_2()
{
$delkasoub=delka_souboru();
$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"r");
$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

return count($uziv);
}
//---------------------------------------------------------------------
function vypis_uzivatelu($cislo)//doøešit!!
{
$delkasoub=delka_souboru();
$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"r");
$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

$vyp[]="";
$pcl=0;
for($i=1;$i<(count($uziv)/2);$i=$i+2)
{
$pcl++;
$vyp[$pcl]=uzivatel($uziv[$i]);
}//end if
return $vyp[$cislo];
}
//---------------------------------------------------------------------
function rozlis_dle_adresy($jmeno,$heslo,$adresa)//doøešit!
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_hes="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($sb_hes,"r");
$uziv=explode("--UZ--",fread($u,$delkasoub));
fclose($u);

$pmp=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo){$pmp=$i;}
}//end for

$ppj=0;
for($i=1;$i<count($uziv);$i++)
{
if($uziv[$i]==$adresa){$ppj++;}
}//end for

if($pmp!=0 and $ppj==0)
{
$uziv[count($uziv)+1]=$pmp;
$uziv[count($uziv)+2]=$adresa;
$soub="prito_mni_uziva_te_le_qwpfeocmruivnmeioubnriuvijeriuvnuidbnvikudnvlkjdfnv.php";
$u=fopen($soub,"w");     //u registrace
fwrite($u,implode($uziv,"--UZ--"));
fclose($u);
}//end if
//return $uziv;//dodìlat výpis!
}
//---------------------------------------------------------------------
function delka_souboru()
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);
return $delkasoub;
}
//---------------------------------------------------------------------
function delka_fora($cislo)
{
$delkasoub=delka_souboru();
$soub="del_ky_qwpdfojaedsvinuidfsvjnaosdfnvuaidfghnvsdifviufhvnriugvnsaidfhnasfviodufgnrsforglnasfqwpoidfjajdfioqp.php";
$u=fopen($soub,"r");
$delka=explode("--DL--",fread($u,$delkasoub));
fclose($u);
return $delka[$cislo];
}
//---------------------------------------------------------------------
function pocet_uzivatelu($adresa)//doøešit!!
{
$delkasoub=delka_souboru();
$soub="ip_na_ser_ve_ru_qwpfocemrimvwgvunisuocnmwriuvnisuvnreiuvnusvhnjwsdcoilkjhnwkvnkwdfv.php";
$u=fopen($soub,"r");
$adr=explode("--IP--",fread($u,$delkasoub));
fclose($u);

$prr=0;
for($i=1;$i<count($adr);$i++)
{
if($adr[$i]==$adresa){$prr++;}
}//end for

if($prr==0)
{
$adr[count($adr)+1]=$adresa;
$soub="ip_na_ser_ve_ru_qwpfocemrimvwgvunisuocnmwriuvnisuvnreiuvnusvhnjwsdcoilkjhnwkvnkwdfv.php";
$u=fopen($soub,"w");     //u registrace
fwrite($u,implode($adr,"--IP--"));
fclose($u);
}//emd if
return count($adr)-1;
}
//---------------------------------------------------------------------
function uzivatel($cislo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

return $udaj[$cislo];
}
//---------------------------------------------------------------------
function posledni_uzivatel()
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_del="pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
$pocet=fread($u,10);
fclose($u);

return $udaj[count($udaj)-$pocet];
}
//---------------------------------------------------------------------
function pocet_uzivatelu_celkem()
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_del="pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
$pocet=fread($u,10);
fclose($u);

return round(count($udaj)/$pocet);
}
//---------------------------------------------------------------------
function temata_fora($cislo)
{
$delkasoub=delka_souboru();
$soub="te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php";
$u=fopen($soub,"r");
$tema=explode("--TM--",fread($u,$delkasoub));
fclose($u);
return $tema[$cislo];
}
//---------------------------------------------------------------------
function cesta_ve_foru($kde,$ur1)
{
$zacat=nazev_fora();
if(!Empty($kde))
{
if($kde=="hledani"){$text="Hledat";}
if($kde=="uzivatele"){$text="Seznam uživatelù";}
if($kde=="skupiny"){$text="Uživatelské skupiny";}
if($kde=="profil"){$text="Profil";}
if($kde=="inbox"){$text="Soukromé zprávy";}
if($kde=="forum"){$text="Forum";}
if($kde=="info_user"){$text="Informace o uživateli";}
if($kde=="logoff"){$text="Odhlášení";}
if($kde=="login" or $kde=="prihlaseni"){$text="Pøihlášení";}
if($kde=="registrace"){$text="Registrace";}
if($kde=="novy_topik"){$text="Nové téma";}
if($kde=="zap_heslo"){$text="Zapomenuté heslo";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
//if($kde==""){$text="";}
if($ur1!=0)
{$urov=temata_fora($ur1-1);
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> <A href=\"index.php?kam=forum&cis=$ur1\">$text [ $urov ]</a>";}
else
{if(Empty($text)){$text="";}
return "<a href=\"index.php\" class=\"nav\">$zacat</a> -> $text";}

}
else
{return "<a href=\"index.php\" class=\"nav\">$zacat</a>";}
}
//---------------------------------------------------------------------
function nazev_fora()
{
$soub="nazev_for_a_pqowemfiuscnmweuinisnciwenfuiwewfwwefwiuwrnvwvuniwubeniuwndeoiunwdoiujn.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function autorizace($cislo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$sb_del="pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
$pocet=fread($u,10);
fclose($u);

$i1=0;
$ciuz=0;
$cis=0;
for($i=1;$i<count($udaj);$i++)
{
$i1=$i1+($pocet+2);
if($cislo==$udaj[$i])
 {
  $cis=$i;
  $ciuz=round($i/$pocet)+1;//èíslo uživatele
 }
}//end for
$soubor="autorizace_no$cislo.php";

if($cis!=0)
{
$udaj[$cis]="";
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
unlink($soubor);//smazání autorizaèního souboru
}//end if vymaz 
}
//---------------------------------------------------------------------
function autorizacni_kod($jmeno)
{
$nahc[]=0;
$nazn="";
$delka=count($jmeno);
if($delka<4){$delka=8;}

for($i=0;$i<($delka*10);$i++)
{
$nahc[$i]=rand(10,5000);
$nazn+=$nahc[$i];
}
return $nazn;
}
//---------------------------------------------------------------------
function registrace($jmeno,$email,$heslo_1,$heslo_2,$icq,$aim,$msn,$yim,$web,$location,$occupation,$interests,$signature,$viewemail,$notifyreply,$notifypm,$attachsig,$server,$slozka,$adresa,$pohlavi)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocp=0;//vyhledání duplikátù
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno){$pocp++;}
if($udaj[$i]==$email){$pocp++;}
}//end for
if($pocp!=0)//kontrola duplikátù
{$stav="false";}

$koema=strpos($email,"@");
if($heslo_1==$heslo_2 and $koema!=0 and $pocp==0)
{
$genjm=autorizacni_kod($jmeno);
$obr="";

$udaj[0]="<?php";//ochrana!!
$udaj[count($udaj)+1]=$jmeno;
$udaj[count($udaj)+2]=$email;
$udaj[count($udaj)+3]=$heslo_1;
$udaj[count($udaj)+4]=$icq;
$udaj[count($udaj)+5]=$aim;
$udaj[count($udaj)+6]=$msn;
$udaj[count($udaj)+7]=$yim;
$udaj[count($udaj)+8]=$web;
$udaj[count($udaj)+9]=$location;
$udaj[count($udaj)+10]=$occupation;
$udaj[count($udaj)+11]=$interests;
$udaj[count($udaj)+12]=$signature;
$udaj[count($udaj)+13]=$viewemail;
$udaj[count($udaj)+14]=$notifyreply;
$udaj[count($udaj)+15]=$notifypm;
$udaj[count($udaj)+16]=$attachsig;
$udaj[count($udaj)+17]=1; //typ: uživatel
$udaj[count($udaj)+18]=$obr; //cesta obrázku
$udaj[count($udaj)+19]=$genjm;//generované èíslo
$udaj[count($udaj)+20]=Date("j.n.Y");//založení
$udaj[count($udaj)+21]=0;//poèet pøíspìvkù
$udaj[count($udaj)+22]=$pohlavi;//pohlaví
$udaj[count($udaj)+23]=1;//hodnoceni dle pøíspìvkù

$tex="<?
include \"funkce.php\";
autorizace($genjm);
?>
Váš uèet s doèasným èíslem: <? print $genjm; ?> byl aktivován. 
Kliknete <a href=\"http://$server/$slozka/index.php?kam=login\">zde</a>
 pro pøihlášení."; //obsah stránky
$soub="autorizace_no$genjm.php";
$uk=fopen($soub,"w");
fwrite($uk,$tex);
fclose($uk);

$link="http://$server/$slozka/$soub";
logovani_aktivace($adresa,$link,$soub);

mail($email,"Registrace - Fugess-Trainz-CZ","Dobrý den, Vaše žádost o registraci na Fugess Trainz CZ byla zaznamenána. Pro potvrzeni a aktivaci uctu kliknete na tento odkaz: $link. \n Vaše udaje: \n Jméno: $jmeno \n Heslo: $heslo_1 \n Dìkuji, Fugess."); //pro klienta
mail("fugess.martin@centrum.cz","Žádost o registraci na Fugess.Trainz.CZ: ","Registruje se klient: $jmeno \ns emailem: $email \ns heslem: $heslo_1 \n Jeho aktivaèni odkaz: $link \nv: ".Date("H:i:s j.m. Y")." \nz IP: $adresa"); //pro admina na email

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
$stav="true";
}//end if rovná se heslo
return $stav;
}
//---------------------------------------------------------------------
function logovani_aktivace($adresa,$souborCesta,$soubor)
{
$delkasoub=delka_souboru();
$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--AT--",fread($u,$delkasoub));
fclose($u);

$udaj[count($udaj)+1]=$soubor;

$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--AT--"));
fclose($u);

$tex="Vytvoøen link <a href=\"$souborCesta\" target=\"_blank\"><b>$souborCesta</b></a> v: ".Date("H:i:s j.n. Y")." z IP: $adresa<br>\n";
$soub="akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function login($jmeno,$heslo)
{
$delkasoub=delka_souboru();
$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pris=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo and $udaj[$i+18]=="")
{$pris++;}
}//end for

if($pris==1)
{return "true";}//povoleno
else
{return "false";}
}
//---------------------------------------------------------------------
function hlavni_logovani($kde,$adresa)
{
$tex="Kliknuto na: <b>$kde</b> v: ".Date("H:i:s j.n. Y")." z IP: $adresa<br>\n";
$soub="hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function logovani_prihlasovani($jmeno,$heslo,$adresa,$stav)
{
if($stav=="true")
{$pov="povoleno";}
else
{$pov="zakázano";}
$tex="Pøihlašování: <b>$jmeno</b> s heslem: <b>$heslo</b> v: ".Date("H:i:s j.m. Y")." z IP: $adresa pøístup: <b>$pov</b><br>\n";
$soub="prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function banovani($adresa)
{
$sou_ban="ban_li_di_qpwdfjwoiunvrnvirwezbvbzeuivnwruzniwujenviuubnwieufzuhqzqwvfvwf.php";
$u=fopen($sou_ban,"r");
$ban=explode("--ban--",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$adresa)
{ 
echo "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
exit;
}//end if
}//end for
}
//---------------------------------------------------------------------
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
//---------------------------------------------------------------------

//---------------------------------------------------------------------

/*

*/
?>
