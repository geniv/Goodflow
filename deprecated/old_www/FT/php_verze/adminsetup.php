<?
$sb_ban="bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php";
$uk=fopen($sb_ban,"r");
$nezadouci_ip=explode("#b*",fread($uk,1000000));
fclose($uk);
                
for($i=1;$i<count($nezadouci_ip);$i++)
{   
if($nezadouci_ip[$i]==$REMOTE_ADDR) 
{  
require "ban/ban.php";//odkaz na ban
exit; //zastavení naèítání                 
}//end if
}//end for                        

if(!Empty($prik))
{
if($prik=="dot_nacti")
{
$otazky_odpovedi="Naèteno";
$dot_s="dotazy_skdjvjaoiujhcsiudhoiudhfoiruwruzqpokjfgzuhskzruiasdffmk.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="dot_uloz" and !$mobs=="")
{
$otazky_odpovedi="Uloženo";
$dot_s="dotazy_skdjvjaoiujhcsiudhoiudhfoiruwruzqpokjfgzuhskzruiasdffmk.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="dot_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="hlo_nacti")
{
$log_vsech_IP="Naèteno";
$dot_s="log_chod_coksjgapiuimaspifguichsviuaerhgguiphakamcmsbbsfjcn.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="hlo_uloz" and !$mobs=="")
{
$log_vsech_IP="Uloženo";
$dot_s="log_chod_coksjgapiuimaspifguichsviuaerhgguiphakamcmsbbsfjcn.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="hlo_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="han_nacti")
{
$log_ankety_IP="Naèteno";
$dot_s="hlas_ank_KJSDHCiuahciuihaichsiulkdkjjcosejojijfofiz.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="han_uloz" and !$mobs=="")
{
$log_ankety_IP="Uloženo";
$dot_s="hlas_ank_KJSDHCiuahciuihaichsiulkdkjjcosejojijfofiz.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="han_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="pri_nacti")
{
$log_prihlasovani="Naèteno";
$dot_s="log_prihil_scnicoijqqpqowksvnnvbubiuiwsrhodfheudjhn.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="pri_uloz" and !$mobs=="")
{
$log_prihlasovani="Uloženo";
$dot_s="log_prihil_scnicoijqqpqowksvnnvbubiuiwsrhodfheudjhn.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="pri_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="reg_nacti")
{
$novy_uzivatele="Naèteno";
$dot_s="now_hes_reg_sdfhoiuhoqijwdpwqpijfsvnvknsjdnsdkjhedcc.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="reg_uloz" and !$mobs=="")
{
$novy_uzivatele="Uloženo";
$dot_s="now_hes_reg_sdfhoiuhoqijwdpwqpijfsvnvknsjdnsdkjhedcc.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="reg_uloz" and $mobs==""){$obsah="";}
}//end ulož
  
if($prik=="pozn_nacti")
{
$poznamky="Naèteno";
$dot_s="poznam_ky_sdjciuaoioiaqoiwhgfiundvhbsudifnoiweoifihiuhrejvoe.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="pozn_uloz" and !$mobs=="")
{
$poznamky="Uloženo";
$dot_s="poznam_ky_sdjciuaoioiaqoiwhgfiundvhbsudifnoiweoifihiuhrejvoe.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="pozn_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="an1_nacti")
{
$anketa1_hlas="Naèteno";
$dot_s="los_akn1_ccideiemcieaaacachnbiewufbjne.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="an1_uloz" and !$mobs=="")
{
$anketa1_hlas="Uloženo";
$dot_s="los_akn1_ccideiemcieaaacachnbiewufbjne.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="an1_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="posl_mejl")
{
if(!Empty($emm) and !Empty($emp) and !Empty($emz))
{
mail($emm,$emp,$emz);
$mail_odeslan="-- E-mail odeslán --";
}//end empty
$obsah="";
}//end pøíkaz

if($prik=="nav_nacti")
{
$navstevni_kniha="Naèteno";
$dot_s="nastevnikniha_kwkenfijrsngiualkfkwoiziowppogiusutiahjfwokknmafbccbbvnvann.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="nav_uloz" and !$mobs=="")
{
$navstevni_kniha="Uloženo";
$dot_s="nastevnikniha_kwkenfijrsngiualkfkwoiziowppogiusutiahjfwokknmafbccbbvnvann.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="nav_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="pii_nacti")
{
$ip_adr="Naèteno";
$dot_s="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="pii_uloz" and !$mobs=="")
{
$ip_adr="Uloženo";
$dot_s="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="pii_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="ban_nacti")
{
$ban_dat="Naèteno";
$dot_s="bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="ban_uloz" and !$mobs=="")
{
$ban_dat="Uloženo";
$dot_s="bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="ban_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="regi_nacti")
{
$reg_dat="Naèteno";
$dot_s="regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="regi_uloz" and !$mobs=="")
{
$reg_dat="Uloženo";
$dot_s="regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="regi_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="pocp_nacti")
{
$poc_pri="Naèteno";
$dot_s="pristupy_kjlsahfjksdgtbdsmnfgbwamdfbaeksdhkfsdhf.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="pocp_uloz" and !$mobs=="")
{
$poc_pri="Uloženo";
$dot_s="pristupy_kjlsahfjksdgtbdsmnfgbwamdfbaeksdhkfsdhf.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="pocp_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="pocdw_nacti")
{
$poc_dow="Naèteno";
$dot_s="dovnloud_ihsiLKDJDcnnNvjndfjksddpjfdpjhmxkmxaufazufgkjclc.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="pocdw_uloz" and !$mobs=="")
{
$poc_dow="Uloženo";
$dot_s="dovnloud_ihsiLKDJDcnnNvjndfjksddpjfdpjhmxkmxaufazufgkjclc.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="pocdw_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="logdw_nacti")
{
$log_dow="Naèteno";
$dot_s="log_down_aoeuchiuwsrvsihviuhiasdcacipojiuhasfvokjwroihwekh.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="logdw_uloz" and !$mobs=="")
{
$log_dow="Uloženo";
$dot_s="log_down_aoeuchiuwsrvsihviuhiasdcacipojiuhasfvokjwroihwekh.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="logdw_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="pocnav_nacti")
{
$poc_nav="Naèteno";
$dot_s="navody_poc_ujacaiohcaoishuhaqwfoijjiufhdiujhuifzgbzvrhzuburjnsdojhnshgvvv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="pocnav_uloz" and !$mobs=="")
{
$poc_nav="Uloženo";
$dot_s="navody_poc_ujacaiohcaoishuhaqwfoijjiufhdiujhuifzgbzvrhzuburjnsdojhnshgvvv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="pocnav_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="lognav_nacti")
{
$log_nav="Naèteno";
$dot_s="log_navody_ahsjhciazuhdqwfpojaodfuhiushviuhvriugsv.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="lognav_uloz" and !$mobs=="")
{
$log_nav="Uloženo";
$dot_s="log_navody_ahsjhciazuhdqwfpojaodfuhiushviuhvriugsv.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="lognav_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="vgpo_nacti")
{
$povg_nav="Naèteno";
$dot_s="video_gal_dflknvalkqpojqwpofjfknbjlyvlknsdvinsoidnviosdnbvsrsiovnbsoivg.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="vgpo_uloz" and !$mobs=="")
{
$povg_nav="Uloženo";
$dot_s="video_gal_dflknvalkqpojqwpofjfknbjlyvlknsdvinsoidnviosdnbvsrsiovnbsoivg.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="vgpo_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="vglg_nacti")
{
$lgvg_nav="Naèteno";
$dot_s="log_vidgal_aksdjcakjsbckjqpfjfqwoizsqeseqswdksncsdknvsronvslkdvn.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="vglg_uloz" and !$mobs=="")
{
$lgvg_nav="Uloženo";
$dot_s="log_vidgal_aksdjcakjsbckjqpfjfqwoizsqeseqswdksncsdknvsronvslkdvn.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="vgpo_uloz" and $mobs==""){$obsah="";}
}//end ulož

if($prik=="vglgob_nacti")
{
$lgvgob_nav="Naèteno";
$dot_s="log_proh_obr_osnvsdnusnonsdoinioasufljndfjhskjprdfhbpidbvsdipkjfvsdipkj.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}//end nacti

if($prik=="vglgob_uloz" and !$mobs=="")
{
$lgvgob_nav="Uloženo";
$dot_s="log_proh_obr_osnvsdnusnonsdoinioasufljndfjhskjprdfhbpidbvsdipkjfvsdipkj.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$mobs);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,1000000);
fclose($doss);
}
else
{
if($prik=="vglgob_uloz" and $mobs==""){$obsah="";}
}//end ulož

}
else
{
$obsah="";
}// end empty

if (empty($log_vsech_IP))$log_vsech_IP="&nbsp;";
if (empty($log_ankety_IP))$log_ankety_IP="&nbsp;";
if (empty($log_prihlasovani))$log_prihlasovani="&nbsp;";
if (empty($novy_uzivatele))$novy_uzivatele="&nbsp;";
if (empty($otazky_odpovedi))$otazky_odpovedi="&nbsp;";
if (empty($navstevni_kniha))$navstevni_kniha="&nbsp;";
if (empty($poznamky))$poznamky="&nbsp;";
if (empty($anketa1_hlas))$anketa1_hlas="&nbsp;";
if (empty($mail_odeslan))$mail_odeslan="";
if (empty($ip_adr))$ip_adr="&nbsp;";
if (empty($ban_dat))$ban_dat="&nbsp;";
if (empty($reg_dat))$reg_dat="&nbsp;";
if (empty($poc_pri))$poc_pri="&nbsp;";
if (empty($poc_dow))$poc_dow="&nbsp;";
if (empty($log_dow))$log_dow="&nbsp;";
if (empty($poc_nav))$poc_nav="&nbsp;";
if (empty($log_nav))$log_nav="&nbsp;";
if (empty($povg_nav))$povg_nav="&nbsp;";
if (empty($lgvg_nav))$lgvg_nav="&nbsp;";
if (empty($lgvgob_nav))$lgvgob_nav="&nbsp;";

if($ajm=="Fugess")
{
echo 
"
<hr size=1 color=white>
<center>Administrátorská Sekce</center>
<hr size=1 color=white>

<table align=center cellpadding=1 cellspacing=3 border=0>

<tr>
<td>Logovací soubor všech IP</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='log_chod_coksjgapiuimaspifguichsviuaerhgguiphakamcmsbbsfjcn.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='hlo_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='hlo_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$log_vsech_IP</td>
</tr>

<tr>
<td>Logovací soubor IP - Ankety</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='hlas_ank_KJSDHCiuahciuihaichsiulkdkjjcosejojijfofiz.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='han_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='han_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$log_ankety_IP</td>
</tr>

<tr>
<td>Kdo se sem snažil pøihlásit</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='log_prihil_scnicoijqqpqowksvnnvbubiuiwsrhodfheudjhn.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='pri_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='pri_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$log_prihlasovani</td>
</tr>

<tr>
<td>Nový uživatelé co se chtìjí zaregistrovat</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='now_hes_reg_sdfhoiuhoqijwdpwqpijfsvnvknsjdnsdkjhedcc.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='reg_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='reg_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$novy_uzivatele</td>
</tr>

<tr>
<td>Otázky a Odpovìdi</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='dotazy_skdjvjaoiujhcsiudhoiudhfoiruwruzqpokjfgzuhskzruiasdffmk.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='dot_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='dot_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$otazky_odpovedi</td>
</tr>

<tr>
<td>Návštìvní kniha</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='nastevnikniha_kwkenfijrsngiualkfkwoiziowppogiusutiahjfwokknmafbccbbvnvann.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='nav_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='nav_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$navstevni_kniha</td>
</tr>

<tr>
<td>Poznámky</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='poznam_ky_sdjciuaoioiaqoiwhgfiundvhbsudifnoiweoifihiuhrejvoe.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='pozn_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='pozn_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$poznamky</td>
</tr>

<tr>
<td>Anketa 1 (<u>bez mezer!</u>)</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='los_akn1_ccideiemcieaaacachnbiewufbjne.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='an1_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='an1_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$anketa1_hlas</td>
</tr>

<tr>
<td>Databáze IP adres</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='pii_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='pii_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$ip_adr</td>
</tr>

<tr>
<td>Databáze zabanovaných lidí (<u>bez mezer!</u>)</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='ban_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='ban_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$ban_dat</td>
</tr>


<tr>
<td>Databáze registrovaných uživatelù (<u>bez mezer!</u>)</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='regi_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='regi_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$reg_dat</td>
</tr>

<tr>
<td>Poèítadlo pøístupù</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='pristupy_kjlsahfjksdgtbdsmnfgbwamdfbaeksdhkfsdhf.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='pocp_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='pocp_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$poc_pri</td>
</tr>

<tr>
<td>Poèítadlo v Download (<u>bez mezer!</u>)</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='dovnloud_ihsiLKDJDcnnNvjndfjksddpjfdpjhmxkmxaufazufgkjclc.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='pocdw_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='pocdw_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$poc_dow</td>
</tr>

<tr>
<td>Logovací soubor Downloadu</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='log_down_aoeuchiuwsrvsihviuhiasdcacipojiuhasfvokjwroihwekh.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='logdw_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='logdw_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$log_dow</td>
</tr>

<tr>
<td>Poèítadlo v Návodech (<u>bez mezer!</u>)</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='navody_poc_ujacaiohcaoishuhaqwfoijjiufhdiujhuifzgbzvrhzuburjnsdojhnshgvvv.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='pocnav_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='pocnav_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$poc_nav</td>
</tr>

<tr>
<td>Logovací soubor Návodù</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='log_navody_ahsjhciazuhdqwfpojaodfuhiushviuhvriugsv.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='lognav_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='lognav_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$log_nav</td>
</tr>

<tr>
<td>Poèítadlo stažení v sekci video galerie</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='video_gal_dflknvalkqpojqwpofjfknbjlyvlknsdvinsoidnviosdnbvsrsiovnbsoivg.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='vgpo_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='vgpo_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$povg_nav</td>
</tr>

<tr>
<td>Logovací soubor v sekci video galerie</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='log_vidgal_aksdjcakjsbckjqpfjfqwoizsqeseqswdksncsdknvsronvslkdvn.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='vglg_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='vglg_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$lgvg_nav</td>
</tr>

<tr>
<td>Logovací soubor obrázkù v sekci video galerie</td>
<td>&nbsp;</td>
<td><span onclick=\"location.href='log_proh_obr_osnvsdnusnonsdoinioasufljndfjhskjprdfhbpidbvsdipkjfvsdipkj.php';\" style=\"cursor:hand;\" id=podt_v_as>Zobrazit</span></td>
<td>&nbsp;</td>
<td><input type=button value=\"Naèti\" onclick=\"men.prik.value='vglgob_nacti';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td><input type=button value=\"Ulož\" onclick=\"men.prik.value='vglgob_uloz';men.kam.value='adminsetup';men.mobs.value=edpol.innerText;men.ajm.value='Fugess';men.posl.click();\"></td>
<td>$lgvgob_nav</td>
</tr>

<tr>
<td>Smazat obsah</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan=2 align=center><input type=button value=\"Proveï\" onclick=\"edpol.innerText='';men.mobs.value='';men.kam.value='adminsetup';men.ajm.value='Fugess';men.posl.click();\"></td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Odhlásit</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan=2 align=center><input type=button value=\"Proveï\" onclick=\"men.zrus.click();men.posl.click();\"></td>
<td>&nbsp;</td>
</tr>

</table>

<hr size=1 color=white>
<center>
<TEXTAREA rows=30 cols=76 name=edpol>$obsah</TEXTAREA>
</center>
<hr size=1 color=white>

<table align=center cellpadding=0 cellspacing=1 border=0>

<tr>
<td colspan=2 align=center>Poslat E-mail:</td>
</tr>

<tr>
<td align=right>Komu:&nbsp;</td>
<td><input type=text name=emm size=47 value=\"@\"></td>
</tr>

<tr>
<td align=right>Pøedmìt:&nbsp;</td>
<td><input type=text name=emp size=47></td>
</tr>

<tr>
<td valign=top align=right>Zpráva:&nbsp;</td>
<td><textarea name=emz cols=40 rows=10></textarea></td>
</tr>

<tr>
<td colspan=2 align=center><input type=button value=\"Odeslat\" onclick=\"men.prik.value='posl_mejl';men.kam.value='adminsetup';men.emm.value=emm.value;men.emp.value=emp.value;men.emz.value=emz.value;men.ajm.value='Fugess';men.posl.click();\"></td>
</tr>

<tr>
<td colspan=2 align=center>$mail_odeslan</td>
</tr>

</table>

<hr size=1 color=white>
";
}
else
{
print "<h1>Tady nemáš co dìlat</h1>";
}
?>
