<?
function pocet_uzivatelu_celkem_admin()
{
$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$pocet=delka_registrace_admin();

return (count($udaj)-1)/$pocet;
}
//---------------------------------------------------------------------
function delka_souboru_admin()
{
$soubr="../del_ka_otv_qwpedwfomsfvoiunvwroigvjnremgoivienrgvcjwremfvhjrwnfvieuthgvneorfijhwefolijwjfni.php";
$u=fopen($soubr,"r");
$delkasoub=fread($u,100);
fclose($u);
return $delkasoub;
}
//---------------------------------------------------------------------
function delka_registrace_admin()
{
$delkasoub=delka_souboru_admin();
$sb_del="../pocet_poli_wpfkwrdfsiomvspedfjvirokjwiefoghveiufhjowiehiwresuvieruhnrunvireunbvireuwnwroiujnfoij.php";
$u=fopen($sb_del,"r");
return fread($u,$delkasoub);
fclose($u);
}
//---------------------------------------------------------------------
function login_admin($jmeno,$heslo)
{
$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
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
function prava_uzivatele_admin($kdo,$idecko)
{
$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$poz=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$kdo and $udaj[$i+13]==$idecko){$poz=$i;}
}//end for

return $udaj[$poz+16];
}
//---------------------------------------------------------------------
function logovani_prihlasovani_admin($jmeno,$heslo,$adresa,$stav)
{
if($stav=="true")
{$pov="povoleno";}
else
{$pov="zakázano";}
$tex="Pøihlašování do adminu: <b>$jmeno</b> s heslem: <b>$heslo</b> v: ".Date("H:i:s j.m. Y")." z IP: $adresa pøístup: <b>$pov</b><br>\n";
$soub="../prih_l_log_qwpofjsuoimwvnieunviueoiwrngvoiweunvzubadflkjofnvoiujsdfnvoikjdfmvoiunedfoibnuoinbqpwoeirdkslcmmbgzhezhgewewwwfnbreuxy.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function hlavni_logovani_admin($adresa)
{
$tex="Kliknuto v: ".Date("H:i:s j.n. Y")." z IP: $adresa<br>\n";
$soub="../hlav_ni_log_qpfcmiruhgniewijfveuiccoiwrehnviunfenrzuibirunvowieufniuruwenbfiunbreiunrefgiunreiuniuneiunbugerunb.php";
$uk=fopen($soub,"a+");
fwrite($uk,$tex);
fclose($uk);
}
//---------------------------------------------------------------------
function id_uzivatele_admin($jmeno,$heslo)
{
$delkasoub=delka_souboru_admin();
$sb_hes="../re_g_c_le_nqpwkdioewfuncvuienviojveivniersurfhviutefhvizduhefiudvsdvsdvhsiudovuiostndvunsbzurbvzrunvruruewiiwrviqwiedwmcvnd.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--CL--",fread($u,$delkasoub));
fclose($u);

$por=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$jmeno and $udaj[$i+2]==$heslo){$por=$i;}
}
return $udaj[$por+13];
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
function pocet_temat_admin($cislo)
{
$nazev="../naz_topik_$cislo.php";
$delka=delka_nadpisu_admin();
if(file_exists($nazev)==true)
{
$delkasoub=delka_souboru_admin();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);
return (count($tema)-1)/$delka;
}
else
{return 0;}
}
//---------------------------------------------------------------------
function delka_obsahu_admin()
{
$delkasoub=delka_souboru_admin();
$nazev="../de_lka_pol_e_obsahu_qpwodkcmuibnwsefgmiuenoiwhnrgbineoufvnejfnwlikrjvoiwrnjfvoijveironvwrokfon.php";
$u=fopen($nazev,"r");
return fread($u,$delkasoub);
fclose($u);
}
//---------------------------------------------------------------------
function delka_nadpisu_admin()
{
$delkasoub=delka_souboru_admin();
$nazev="../de_lka_pol_e_nadpisu_pqwdjfncwiufnvowienrviundwrnvisujfnwirojwofhwfweljfclpdfkosjcvmfnbnbv.php";
$u=fopen($nazev,"r");
return fread($u,$delkasoub);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_prispevku_admin($cislo)
{
$nazev="../naz_topik_$cislo.php";
if(file_exists($nazev))
{
$delkasoub=delka_souboru_admin();
$u=fopen($nazev,"r");
$tema=explode("--TPK--",fread($u,$delkasoub));
fclose($u);

$poct=delka_nadpisu_admin();
$del=delka_obsahu_admin();

$poc=0;
for($i=1;$i<count($tema)/$poct;$i++)
{
$poc+=($tema[(($del-2)*$i)+($i-1)]+1);
}
return $poc;
}
else
{return 0;}
}
//---------------------------------------------------------------------
function pocet_prispevku_celkem_admin()
{
$delkasoub=delka_souboru_admin();
$soub="../te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php";
$u=fopen($soub,"r");
$tema=explode("--TM--",fread($u,$delkasoub));
fclose($u);

$pocet=0;
for($i=1;$i<count($tema);$i++)
{
$pocet+=pocet_prispevku_admin($i);
}

return $pocet;
}
//---------------------------------------------------------------------
function pocet_temat_celkem_admin()
{
$delkasoub=delka_souboru_admin();
$soub="../te_ma_qpwdemwriuvjuoiejdcwriuhvneuirbvuiernvenclnqwdpkweoimcqeodcmrievneiuvwioiwrjnvoierjvoijwiojfoiwrjvrvrv.php";
$u=fopen($soub,"r");
$tema=explode("--TM--",fread($u,$delkasoub));
fclose($u);

$pocet=0;
for($i=1;$i<count($tema);$i++)
{
$pocet+=pocet_temat_admin($i);
}
return $pocet;
}
//---------------------------------------------------------------------
function pocet_uzivatelu_na_strance_admin()
{
$sb_hes="../po_uziv_qwpoifjhsiuvndvhnsvydkjvshksvsdjviksjvidjhsfvkjdfhbvjhsdfbvkjsdbvjhdfbvij.php";
$u=fopen($sb_hes,"r");
return fread($u,50);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_topiku_na_strance_admin()
{
$sb_hes="../poc_topiku_qpofndfivnjsoighviudfjisufhviusdhijfvidflksjdfviuskjvbsdfjvbsfkjvbskjfhbvksdjfvbsdfkjvbsfikjhnaijcn.php";
$u=fopen($sb_hes,"r");
return fread($u,50);
fclose($u);
}
//---------------------------------------------------------------------
function pocet_prispevku_na_strance_admin()
{
$sb_hes="../poc_pris_pevku_pqwmfvjivnsdjvsniuhnhvzvzusdovjnsfvjnasdfvojndafvjndfavjnadfjokvjnsdvcoikn.php";
$u=fopen($sb_hes,"r");
return fread($u,50);
fclose($u);
}
//---------------------------------------------------------------------
function nazev_fora_admin()
{
$soub="../nazev_for_a_pqowemfiuscnmweuinisnciwenfuiwewfwwefwiuwrnvwvuniwubeniuwndeoiunwdoiujn.php";
$u=fopen($soub,"r");
return fread($u,100);
fclose($u);
}
//---------------------------------------------------------------------
function popis_fora_admin()
{
$sb_hes="../popis_fora_qpwodjihciwsudfzbvndiscnsruvbnsiudbczusdbvsbnvizsbvisdbvisudbvisdbvisudbv.php";
$u=fopen($sb_hes,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
function setings_avatar_admin($cislo)
{
$delkasoub=delka_souboru_admin();
$nazev="../sys_avatar_qpdonmsdiuvnsdivmndfasivnflkvnmaifjvbfkjvnsdfiajbvakdfjnvakdjfbvdfakjvn.php";
$u=fopen($nazev,"r");
$udaj=explode("--AV--",fread($u,$delkasoub));
fclose($u);

return $udaj[$cislo];
}
//---------------------------------------------------------------------
function prekopej_text_admin($text)
{
$delkasoub=delka_souboru_admin();
$sb_hes="../skr_ypt_zn_ack_y_pqwkdfciournviowemvionvmsvinsokfmwirumviowjdvmiojvmifovjnmwroviksjkmowirkvjkowivjvikmweoivnoiwrejnv.php";
$u=fopen($sb_hes,"r");
$zdroj=explode("--z--",fread($u,$delkasoub));
fclose($u);

$sb_hes="../skry_p_t_zn_prevod_qpfomcieufnbviomciwnvisnmvosdmvosfnmvosnvjfdnbslkmvsokfmvosikdmvfolksdvnslkfmvsdfolkvmdolkfvmed.php";
$u=fopen($sb_hes,"r");
$nahrada=explode("--zp--",fread($u,$delkasoub));
fclose($u);

if(count($zdroj)==count($nahrada))
{
$upr[0]=$text;
for($i=1;$i<count($zdroj);$i++)
{
$upr[$i]=str_replace($zdroj[$i],$nahrada[$i],$upr[$i-1]);
}//end for
return $upr[count($zdroj)-1];
}//end if
else
{return "<font color=\"red\"><b>Chyba ".count($zdroj).":".count($nahrada)."</b></font>";}
}
//---------------------------------------------------------------------
function www_uzivatele_admin($web)
{
//$wb=parametr_uzivatele($jmeno,7);
if(!Empty($web) and $web!="http://")
{return "<a href=\"$web\" target=\"_blank\"><img src=\"../images/tlacitka/icon_www.gif\" class=\"imgfade\" onmouseover=\"this.className=&#39;imgfull&#39;\" onmouseout=\"this.className=&#39;imgfade&#39;\" border=\"0\"></a>";}
else
{return "";}
}/*
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
*/
?>
