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
<td align=center>Modelov· éeleznice</td>
</tr>
</table>
<?
$sb="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$k=fopen($sb,"r");
$dataip=explode("*@*",fread($k,1000000));
fclose($k);

for($ri=1;$ri<count($dataip);$ri=$ri+2)
{
if($REMOTE_ADDR==$dataip[$ri])  //ovÏ¯uje IP
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
if($reg[$p1]==$logjm and $reg[$p1+1]==$loghe){$pc++;}//rovn·-li se p¯iËte se 1.
}   //end for

if(!Empty($logjm)and !Empty($loghe))
{
$tepri="P¯ihlaöov·nÌ: <b>".$logjm."</b> s heslem: <b>".$loghe."</b> do: <b>".$kam."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR." - <b>".$kdo."</b><br>\n";
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
  <td align=center>Fotky naöich kolejiöù - DetailnÌ a ostatnÌ fotky</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Vöechny obr·zky jsou zmenöenÈ, origin·ly poskytuji jen na poû·d·nÌ</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_b.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_b.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_c.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_c.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_d.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_d.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_e.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_e.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_f.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_f.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_g.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_g.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_h.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_h.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_ch.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_ch.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_i.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_i.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_j.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_j.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_k.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_k.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_l.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_l.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_m.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_m.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_n.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_n.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_o.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_o.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_p.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_p.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_q.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_q.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_r.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_r.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_s.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_s.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_t.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_t.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_u.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_u.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_v.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_v.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_w.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_w.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_x.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_x.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_y.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_y.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_z.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_z.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_a.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_a.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_b.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_b.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_c.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_c.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_d.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_d.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_e.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_e.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_f.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_f.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_g.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_g.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_h.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_h.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_ch.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_ch.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_i.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_i.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_j.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_j.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_k.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_k.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_l.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_l.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_m.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_m.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_n.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_n.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_o.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_o.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_p.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_p.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_q.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_q.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice_nahled/obr_modelova_zeleznice_a_r.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_modelova_zeleznice/obr_modelova_zeleznice/obr_modelova_zeleznice_a_r.jpg'\"></td>
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
<td colspan=3 align=center id=vel_b>Vstup pro registrovanÈ uûivatele</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td align=right>JmÈno:</td>
<td>&nbsp;</td>
<td><input type=text name=jme></td>
</tr>
<tr>
<td align=right>Heslo:</td>
<td>&nbsp;</td>
<td><input type=password name=hes onkeyup=\"zap();vyp();\"></td>
</tr>
<tr>
<td align=right><input type=button name=\"vlz\" value=\"Vstup\" title=\"Vstup\" onclick=\"zap();men.kam.value='modelovazeleznice';men.logjm.value=jme.value;men.loghe.value=hes.value;men.posl.click();\"></td>
<td>&nbsp;</td>
<td align=center><input type=button value=\"Vypr·zdnit pole\" title=\"Vypr·zdnÌ vyplnÏnÈ jmÈno a heslo\" onclick=\"del();men.kam.value='modelovazeleznice';men.posl.click();\"></td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center><a href=\"novaregistrace.php\" title=\"Registrace novÈho uûivatele\" target=_blank id=vel_b>Registrace</a></td>
</tr>
</table>
";
}
?>
