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
<td align=center>3D Galerie</td>
</tr>
</table>
<?
$sb="ip_asiksdjhkyxjbiapdjhuipasfgiuadhubiphfduisfjivodjivnsdoifnvmjcbwpfhwauif.php";
$k=fopen($sb,"r");
$dataip=explode("*@*",fread($k,1000000));
fclose($k);

for($ri=1;$ri<count($dataip);$ri=$ri+2)
{
if($REMOTE_ADDR==$dataip[$ri])  //ov��uje IP
{
$kdo=$dataip[$ri+1];
}//end if
}//end for

$sr_uz="regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php";
$uk=fopen($sr_uz,"r");
$reg=explode("*r*",fread($uk,1000000));
fclose($uk);

$poc=count($reg);
$pc=0;
for($p1=0;$p1<$poc;$p1++)
{
if($reg[$p1]==$logjm and $reg[$p1+1]==$loghe){$pc++;}//rovn�-li se p�i�te se 1.
}   //end for

if(!Empty($logjm)and !Empty($loghe))
{
$tepri="P�ihla�ov�n�: <b>".$logjm."</b> s heslem: <b>".$loghe."</b> do: <b>".$kam."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR." - <b>".$kdo."</b><br>\n";
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
  <td align=center>3D obr�zky z m� tvorby</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Na podrobnosti o stavb� t�chto model� se m��ete pt�t v sekci <u>ot�zky a odpov�di</u></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td align=center id=vel_e>Pou�it� array na box s<br clear=right>posunut�m gizmo<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/array_funkce.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/array_funkce.gif'\"></td>
  <td align=center id=vel_e>Pou�it� scatter na<br clear=right>cylindru<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/scatter_funkce.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/scatter_funkce.gif'\"></td>
  <td align=center id=vel_e>Matrace vytvo�en� z boxu<br clear=right>s editable poly a meshsmooth<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/matrace_pokus.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/matrace_pokus.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Cylinder s n�kolika<br clear=right>segmentama a ripple binding<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/ripple_binding.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/ripple_binding.gif'\"></td>
  <td align=center id=vel_e>Miska vytvo�en� pomoc�<br clear=right>linky a modifik�toru lathe<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/miska_pokus.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/miska_pokus.gif'\"></td>
  <td align=center id=vel_e>Napodobenina je�ka<br clear=right> v kleci<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/jezek_v_kleci_pokus.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/jezek_v_kleci_pokus.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Miska s renderov�n�m<br clear=right>na wireframe<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/miska_pokus_wireframe.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/miska_pokus_wireframe.gif'\"></td>
  <td align=center id=vel_e>Miska s renderov�n�m<br clear=right>na wireframe a 2 sides<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/miska_pokus_wireframe_2_sides.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/miska_pokus_wireframe_2_sides.gif'\"></td>
  <td align=center id=vel_e>Porovn�n� materi�l�<br clear=right>s materi�lem bump a bez<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/levy-pouzity_bump_pravy-bez_bump.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/levy-pouzity_bump_pravy-bez_bump.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Chamfer Cylinder s<br clear=right>modifik�torem Tessellate<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/chamfercyl_tessellate.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/chamfercyl_tessellate.gif'\"></td>
  <td align=center id=vel_e>Cham. Cyl. s modifik�torem<br clear=right>Tessellate s Face-Center<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/chamfercyl_tessellate_face-center.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/chamfercyl_tessellate_face-center.gif'\"></td>
  <td align=center id=vel_e>Cham. Cyl. s modifik�torem<br clear=right>Tessellate s Edge a 100 Tension<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/chamfercyl_tessellate_max_tension.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/chamfercyl_tessellate_max_tension.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Boxy a uprost�ed<br clear=right>Volume omni<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/boxy_a_volume_omni.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/boxy_a_volume_omni.gif'\"></td>
  <td align=center id=vel_e>Sklenice z line a lathe<br clear=right>s materi�lem opacity a bump<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/sklenka_z_line_material_opacity_bump.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/sklenka_z_line_material_opacity_bump.gif'\"></td>
  <td align=center id=vel_e>Sklenice s materi�lem<br clear=right>opacity, raytrace a bump<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/sklenka_z_line_material_raytrace_opacity_bump.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/sklenka_z_line_material_raytrace_opacity_bump.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Torus Knot na povrchu s<br clear=right>materi�lem raytrace a bump<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/bump_raytrace_torus_knot.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/bump_raytrace_torus_knot.gif'\"></td>
  <td align=center id=vel_e>Sphere v boxu s jedn�m light a<br clear=right>materi�lem raytrace na sphere<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/kamerove_pohledy.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/kamerove_pohledy.gif'\"></td>
  <td align=center id=vel_e>Sphere v boxu s materi�lem<br clear=right>raytrace na sphere i na boxu<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/kamerove_pohledy_a.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/kamerove_pohledy_a.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Tube na povrchu s<br clear=right>materi�lem raytrace a bump<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/raytrace_bump.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/raytrace_bump.gif'\"></td>
  <td align=center id=vel_e>Box na plo�e s<br clear=right>materi�lem raytrace<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/box_raytrace_bump_b.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/box_raytrace_bump_b.gif'\"></td>
  <td align=center id=vel_e>Box na plo�e s<br clear=right>materi�lem raytrace a bump<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/box_raytrace_bump.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/box_raytrace_bump.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Notebook postaven�<br clear=right>podle re�ln� p�edlohy<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/notebook.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/notebook.gif'\"></td>
  <td align=center id=vel_e>P�vodn� n�vrh menu z model�:<br clear=right>Text, Capsule a Chamfer Box<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/fugess_trainz_menu.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/fugess_trainz_menu.gif'\"></td>
  <td align=center id=vel_e>Na v�ech modelech je pou�it�<br clear=right>materi�l raytrace<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/fugess_trainz_menu_a.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/fugess_trainz_menu_a.gif'\"></td>
 </tr>
 <tr>
  <td align=center id=vel_e>Box s pou�it�m<br clear=right>spacing tool<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_3d_galerie/obr_nahled/box_spacing_tool.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_3d_galerie/obr_3d_galerie/box_spacing_tool.gif'\"></td>
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
<td colspan=3 align=center id=vel_b>Vstup pro registrovan� u�ivatele</td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td align=right>Jm�no:</td>
<td>&nbsp;</td>
<td><input type=text name=jme></td>
</tr>
<tr>
<td align=right>Heslo:</td>
<td>&nbsp;</td>
<td><input type=password name=hes onkeyup=\"zap();vyp();\"></td>
</tr>
<tr>
<td align=right><input type=button name=\"vlz\" value=\"Vstup\" title=\"Vstup\" onclick=\"zap();men.kam.value='3dgalerie';men.logjm.value=jme.value;men.loghe.value=hes.value;men.posl.click();\"></td>
<td>&nbsp;</td>
<td align=center><input type=button value=\"Vypr�zdnit pole\" title=\"Vypr�zdn� vypln�n� jm�no a heslo\" onclick=\"del();men.kam.value='3dgalerie';men.posl.click();\"></td>
</tr>
<tr>
<td colspan=3 align=center>&nbsp;</td>
</tr>
<tr>
<td colspan=3 align=center><a href=\"novaregistrace.php\" title=\"Registrace nov�ho u�ivatele\" target=_blank id=vel_b>Registrace</a></td>
</tr>
</table>
";
}
?>
