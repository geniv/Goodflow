<?
$sb_ban="bin_ban_bong_lide_ihhciacianfancoijnhiuhoiadaoifisubvcs.php";
$uk=fopen($sb_ban,"r");
$nezadouci_ip=explode("#b*",fread($uk,1000000));
fclose($uk);
            
for ($i=0;$i<count($nezadouci_ip);$i++)
{   
if ($nezadouci_ip[$i]==$REMOTE_ADDR) 
{  
require "ban/ban.php";
exit;                  
}}                        
?>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
<tr>
<td align=center>Galerie</td>
</tr>
</table>
<?
$sb="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$k=fopen($sb,"r");
$dataip=explode("*@*",fread($k,1000000));
fclose($k);

for($ri=1;$ri<count($dataip);$ri=$ri+2)
{
if($REMOTE_ADDR==$dataip[$ri])  //ovìøuje IP
{
$kdo=$dataip[$ri+1];
}//end if
}//end for

$sr_uz="regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php";
$uk=fopen($sr_uz,"r");
$reg=explode("*r*",fread($uk,1000000));
fclose($uk);

$pc=0;

for($p1=0;$p1<count($reg);$p1++)
{
if($reg[$p1]==$logjm and $reg[$p1+1]==$loghe){$pc++;}//rovná-li se pøiète se 1.
}   //end for

if(!Empty($logjm)and !Empty($loghe))
{
$tepri="Pøihlašování: <b>".$logjm."</b> s heslem: <b>".$loghe."</b> do: <b>".$kam."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR." - <b>".$kdo."</b><br>\n";
$soupri="log_prihil_scnicoijqqpqowksvnnvbubiuiwsrhodfheudjhn.php";
$usopr=fopen($soupri,"a+");
fwrite($usopr,$tepri);
fclose($usopr);
}//end empty

if($pc==1)
{
echo
"
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center><input type=image src=\"nastaveni_uctu_tlacitko.gif\" onclick=\"men.kam.value='nastaveni_prihlasovani';men.posl.click();\"></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Foto Galerie</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td align=center id=barv_tab_poz>Fotky z nádraží Bøeclav<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled_rozcestnik/foto_galerie_nadrazi.gif\" onclick=\"men.kam.value='foto_galerie_nadrazi';men.posl.click();\"></td>
  <td align=center id=barv_tab_poz>Fotky z pøednádraží Bøeclav<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled_rozcestnik/foto_galerie_prednadrazi.gif\" onclick=\"men.kam.value='foto_galerie_prednadrazi';men.posl.click();\"></td>
 </tr>
</table>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Obrázky z projektù do TRS</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td align=center id=barv_tab_poz>Dùl Schoeller<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled_rozcestnik/projekt_dul.gif\" onclick=\"men.kam.value='dulschoeller';men.posl.click();\"></td>
  <td align=center id=barv_tab_poz>Rozestavìný dùm<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled_rozcestnik/projekt_rozestaveny_dum.gif\" onclick=\"men.kam.value='rozestavenydum';men.posl.click();\"></td>
 </tr>
 <tr>
  <td align=center id=barv_tab_poz>Moravský Krumlov<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled_rozcestnik/projekt_moravskykrumlov.gif\" onclick=\"men.kam.value='moravskykrumlov';men.posl.click();\"></td>
  <td align=center id=barv_tab_poz>Stavìdlo Moravský Krumlov<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_projekty_stavba/obr_nahled_rozcestnik/projekt_stavedlomoravskykrumlov.gif\" onclick=\"men.kam.value='stavedlomoravskykrumlov';men.posl.click();\"></td>
 </tr>
</table>
<SCRIPT LANGUAGE=javascript>
function dopl()
{
men.pridrzjme.value=\"$logjm\";
men.pridrzhes.value=\"$loghe\";
}
</SCRIPT>
<body onload=\"dopl();\"></body>
";
}
else
{ 
echo
"<body onload=\"vyp();\"></body>
<SCRIPT LANGUAGE=javascript>
function vyp()
{  
jme.value=ReadCookie('jmc','',24*365);
hes.value=ReadCookie('hec','',24*365);
var aupr=ReadCookie('aut','',24*365);
if(aupr=='goojdi' && jme.value!='' && hes.value!=''){vlz.click();}
}
function zap()
{
WriteCookie('jmc',jme.value,24*365);
WriteCookie('hec',hes.value,24*365);
}
function del()
{
WriteCookie('jmc','',24*365);
WriteCookie('hec','',24*365);
}
</SCRIPT>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center id=vel_b>Vstup pro registrované uživatele</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td align=right>Jméno:</td>
<td>&nbsp;</td>
<td><input type=text name=jme></td>
</tr>
<tr>
<td align=right>Heslo:</td>
<td>&nbsp;</td>
<td><input type=password name=hes onkeyup=\"zap();vyp();\"></td>
</tr>
<tr>
<td align=right><input type=button name=\"vlz\" value=\"Vstup\" title=\"Vstup\" onclick=\"zap();men.kam.value='galerie';men.logjm.value=jme.value;men.loghe.value=hes.value;men.posl.click();\"></td>
<td>&nbsp;</td>
<td align=center><input type=button value=\"Vyprázdnit pole\" title=\"Vyprázdní vyplnìné jméno a heslo\" onclick=\"del();men.kam.value='galerie';men.posl.click();\"></td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center><a href=\"novaregistrace.php\" title=\"Registrace nového uživatele\" target=_blank id=vel_b>Registrace</a></td>
</tr>
</table>
";
}
?>
