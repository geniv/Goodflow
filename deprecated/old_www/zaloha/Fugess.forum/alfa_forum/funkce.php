<?
//$pole=array("jmeno"=>"aaaa","bbbb","cccc","prijmeni"=>"fry�ta","dddd","eeee");
//print_r ($pole);
/*
function test($neco)
{
return $neco." tad�";
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
seznamy a pomocn� admin:
ak_ti_v_li_nky_qwpfoeijgsfnxiokmsciovsnviuojsdcvuisfnvmcoiaesdvjnsudnvsdounosdncoiudanciodnviusbvuzwreg.php

logov�n�:
akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php
hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php
prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php
seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php

jine:
ban_li_di_qpwdfjwoiunvrnvirwezbvbzeuivnwruzniwujenviuubnwieufzuhqzqwvfvwf.php
del_ky_qwpdfojaedsvinuidfsvjnaosdfnvuaidfghnvsdifviufhvnriugvnsaidfhnasfviodufgnrsforglnasfqwpoidfjajdfioqp.php
nad_pi_s_qwpdojsniufcojsiufvhjnviurebhfcbvjdoiqpowdfncwdfkjmvnwriufcmireu�hjoiewghvisucjwruvbwiuijfiwuhfuehfiwhufeueueuuueueuckaeinef.php
te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php
poz_namky_dlkjfhiwocniwspqwejfowwchnzsiudcmrweiuvbcnwreuivzbuisfnvezuhvbnwrezuisjfhvnerjhkfvherniuvnervjkhejhverhjv.php
re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php
*/
//---------------------------------------------------------------------
function autorizace($cislo)
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

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
  $ciuz=round($i/$pocet)+1;//��slo u�ivatele
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
unlink($soubor);//smaz�n� autoriza�n�ho souboru
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
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocp=0;//vyhled�n� duplik�t�
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno){$pocp++;}
if($udaj[$i]==$email){$pocp++;}
}//end for
if($pocp!=0)//kontrola duplik�t�
{$stav="false";}

$koema=strpos($email,"@");
if($heslo_1==$heslo_2 and $koema!=0 and $pocp==0)
{
$genjm=autorizacni_kod($jmeno);
$obr="";

$udaj[0]="<?";//ochrana!!
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
$udaj[count($udaj)+17]=1; //u�ivatel
$udaj[count($udaj)+18]=$obr; //ukl�dat obr�zek
$udaj[count($udaj)+19]=$genjm;
$udaj[count($udaj)+20]=Date("j.n.Y");
$udaj[count($udaj)+21]=0;
$udaj[count($udaj)+22]=$pohlavi;

$tex="<?
include \"funkce.php\";
autorizace($genjm);
?>
V� u�et s do�asn�m ��slem: <? print $genjm; ?> byl aktivov�n. 
Kliknete <a href=\"http://$server/$slozka/index.php?kam=login\">zde</a>
 pro p�ihl�en�."; //obsah str�nky
$soub="autorizace_no$genjm.php";
$uk=fopen($soub,"w");
fwrite($uk,$tex);
fclose($uk);

$link="http://$server/$slozka/$soub";
logovani_aktivace($adresa,$link,$soub);

mail($email,"Registrace - Fugess-Trainz-CZ","Dobr� den, Va�e ��dost o registraci na Fugess Trainz CZ byla zaznamen�na. Pro potvrzeni a aktivaci uctu kliknete na tento odkaz: $link. \n Va�e udaje: \n Jm�no: $jmeno \n Heslo: $heslo_1 \n D�kuji, Fugess."); //pro klienta
mail("fugess.martin@centrum.cz","��dost o registraci na Fugess.Trainz.CZ: ","Registruje se klient: $jmeno \ns emailem: $email \ns heslem: $heslo_1 \n Jeho aktiva�ni odkaz: $link \nv: ".Date("H:i:s j.m. Y")." \nz IP: $adresa"); //pro admina na email

$sb_hes="re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"w");     //u registrace
fwrite($u,implode($udaj,"--CL--"));
fclose($u);
$stav="true";
}//end if rovn� se heslo
return $stav;
}
//---------------------------------------------------------------------
function logovani_aktivace($adresa,$souborCesta,$soubor)
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--AT--",fread($u,$delkasoub));
fclose($u);

$udaj[count($udaj)+1]=$soubor;

$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($udaj,"--AT--"));
fclose($u);

$tex="Vytvo�en link <a href=\"$souborCesta\" target=\"_blank\"><b>$souborCesta</b></a> v: ".Date("H:i:s j.n. Y")." z IP: $adresa<br>\n";
$soub="akt_iv_log_qepfsovjdnviwekjfviuedhwiuegvieusfnwribvizeuhfwriugbvebviewriuhfjfoiwjvoiwrnfnfvnnnv.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function login($jmeno,$heslo)
{
$soubr="del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,30);
fclose($u);

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
{$pov="zak�zano";}
$tex="P�ihla�ov�n�: <b>$jmeno</b> s heslem: <b>$heslo</b> v: ".Date("H:i:s j.m. Y")." z IP: $adresa p��stup: <b>$pov</b><br>\n";
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
echo "<br><br><br><br><br><h2 align=center>Na tyto str�nky m�te z�kaz vstupu!!</h2>";
exit;
}//end if
}//end for
}
//---------------------------------------------------------------------
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

return "Pr�v� je $den, ".date("j")." $mes, ".date("Y H:i");
}
//---------------------------------------------------------------------

//---------------------------------------------------------------------

/*

*/
?>
