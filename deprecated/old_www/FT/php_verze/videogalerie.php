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
<td align=center>Video Galerie</td>
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

$nvg1[0]="Capsule s modifikátorem";
$nvg[0]="melt a osvìtlenou scénou";

$nvg1[1]="Na všech cilindrech je použitý";
$nvg[1]="modifikátor twist";

$nvg1[2]="Zde jsou použity";
$nvg[2]="modifikátory twist a stretch";

$nvg1[3]="Zde jsou použity";
$nvg[3]="modifikátory twist a taper";

$nvg1[4]="Použity tøi èásticové efekty";
$nvg[4]="Výsledek - kouøící komín";

$nvg1[5]="Zde je použitá gravitace s";
$nvg[5]="dynamickými efekty na míèku";

$nvg1[6]="Generování objektu po køivce";
$nvg[6]="èásticovým efektem Parray";

$nado[0]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/capsule_a_melt.rar';";//se støedníkem!!
$nado[1]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/modifikator_twist.rar';";
$nado[2]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/modifikator_twist_a_stretch.rar';";
$nado[3]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/modifikator_twist_a_taper.rar';";
$nado[4]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/super_spray_-_drag_-_wind_-_kour_z_kominu.rar';";
$nado[5]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/prulet_micku_v_tube_-_gravitace_a_dynamicke_efekty.rar';";
$nado[6]="location.href='obr_vsechny_galerie/obr_video_galerie/soubory_video_galerie/generovani_objektu_po_krivce.rar';";

$novg[0]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/capsule_a_melt.gif";//cesta do ukázky
$novg[1]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/modifikator_twist.gif";
$novg[2]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/modifikator_twist_a_stretch.gif";
$novg[3]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/modifikator_twist_a_taper.gif";
$novg[4]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/super_spray_-_drag_-_wind_-_kour_z_kominu.gif";
$novg[5]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/prulet_micku_v_tube_-_gravitace_a_dynamicke_efekty.gif";
$novg[6]="obr_vsechny_galerie/obr_video_galerie/obr_video_galerie/generovani_objektu_po_krivce.gif";

if($pc==1 or $pca=="vbh")
{
$s_vg="video_gal_dflknvalkqpojqwpofjfknbjlyvlknsdvinsoidnviosdnbvsrsiovnbsoivg.php";
$ukz=fopen($s_vg,"r");//poèítání download
$vig=explode("*+*",fread($ukz,10000));
fclose($ukz);

if(!Empty($kuk))
{
for($p1=0;$p1<count($novg);$p1++)
{
$pp1=$p1+1;
$pp2="nvga".$pp1;
if($kuk==$pp2)
{
$ukob=$novg[$p1];//cesta k obrázku
$shob=$nvg[$p1];//rozlišení prohlíženého obrázku
}//end if
}//end for
$s_vobr="obr_eskkaejnpkjwsmroigjhniqwfoipvjdfbokjndobjndokjfnboidnboihrnbv.php";
$uk=fopen($s_vobr,"w+");
fwrite($uk,$ukob);//pøenesení cesty
fclose($uk);

$lsbr="log_proh_obr_osnvsdnusnonsdoinioasufljndfjhskjprdfhbpidbvsdipkjfvsdipkj.php";
$lsobr="Uživatel: <b>$kdo</b> se díval na: <b>$shob</b> z IP: $REMOTE_ADDR v ".Date("H:i:s j.m. Y")."<br>\n";
$uk=fopen($lsbr,"a+");//logování
fwrite($uk,$lsobr);
fclose($uk);

$prnaot="ssho.click();";//klikne na odkaz
}
else
{
$prnaot="";
}//end if kuk

if(!Empty($down))
{
for($p1=0;$p1<count($nado);$p1++)
{
$pp1=$p1+1;
$pp2="vg".$pp1;
if($down==$pp2)
{
$dwnvg=$nado[$p1];//urèení stahovaného souboru
$uzssou=$nvg[$p1];//rozeznání souboru
$vig[$p1]++;//pøiètení stahování
}//end if
}//end for

$svglo="log_vidgal_aksdjcakjsbckjqpfjfqwoizsqeseqswdksncsdknvsronvslkdvn.php";
$lgzpvg="Byl stažen soubor: <b>$uzssou</b> uživatelem: <b>$kdo</b> z IP: $REMOTE_ADDR v ".Date("H:i:s j.m. Y")."<br>\n";
$uk=fopen($svglo,"a+");//logování
fwrite($uk,$lgzpvg);
fclose($uk);

$ukz=fopen($s_vg,"w");//pøièítání
fwrite($ukz,implode($vig,"*+*"));
fclose($ukz);
}//end if empty
else
{
$dwnvg="";
$uzssou="";
}
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
  <td align=center>3D videa z mé tvorby</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Na podrobnosti o stavbì tìchto modelù se mùžete ptát v sekci <u>otázky a odpovìdi</u></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>

<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td align=center id=vel_e>".$nvg1[0]."<br clear=right>".$nvg[0]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/capsule_a_melt.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga1';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg1';men.posl.click();\">Download</span></td>
  <td align=center id=vel_e>".$nvg1[1]."<br clear=right>".$nvg[1]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/modifikator_twist.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga2';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg2';men.posl.click();\">Download</span></td>
  <td align=center id=vel_e>".$nvg1[2]."<br clear=right>".$nvg[2]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/modifikator_twist_a_stretch.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga3';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg3';men.posl.click();\">Download</span></td>
 </tr>
 <tr>
  <td align=center id=vel_e>".$nvg1[3]."<br clear=right>".$nvg[3]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/modifikator_twist_a_taper.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga4';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg4';men.posl.click();\">Download</span></td>
  <td align=center id=vel_e>".$nvg1[4]."<br clear=right>".$nvg[4]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/super_spray_-_drag_-_wind_-_kour_z_kominu.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga5';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg5';men.posl.click();\">Download</span></td>
  <td align=center id=vel_e>".$nvg1[5]."<br clear=right>".$nvg[5]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/prulet_micku_v_tube_-_gravitace_a_dynamicke_efekty.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga6';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg6';men.posl.click();\">Download</span></td>
 </tr>
 <tr>
  <td align=center id=vel_e>".$nvg1[6]."<br clear=right>".$nvg[6]."<br clear=right><input type=image src=\"obr_vsechny_galerie/obr_video_galerie/obr_nahled/generovani_objektu_po_krivce.gif\" onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.kuk.value='nvga7';men.posl.click();\"><br clear=right><span id=gal_vi_down onclick=\"men.kam.value='videogalerie';men.pca.value='vbh';men.down.value='vg7';men.posl.click();\">Download</span></td>
 </tr>
</table>
<a href=\"ukazka_sdkjnvskdjfnvjdfnbvjkdfbvkjhhvjbsvjhbsvkjhbsvbsdfjkhgbdjfhbv.php\" target=\"_blank\" name=ssho></a>
<SCRIPT LANGUAGE=javascript>
function dopl()
{
men.pridrzjme.value=\"$logjm\";
men.pridrzhes.value=\"$loghe\";
}
</SCRIPT>
<body onload=\"dopl();$dwnvg"."$prnaot\"></body>";
}// uprava pro: se støedníky
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
<td align=right><input type=button name=\"vlz\" value=\"Vstup\" title=\"Vstup\" onclick=\"zap();men.kam.value='videogalerie';men.logjm.value=jme.value;men.loghe.value=hes.value;men.posl.click();\"></td>
<td>&nbsp;</td>
<td align=center><input type=button value=\"Vyprázdnit pole\" title=\"Vyprázdní vyplnìné jméno a heslo\" onclick=\"del();men.kam.value='videogalerie';men.posl.click();\"></td>
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
