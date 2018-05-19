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

$sr_uz="regr_uz_kjdscnjnikjafajfvsoiudhvuihaSDVsgasdfhjkndihuafuh.php";
$uk=fopen($sr_uz,"r");
$reg=explode("*r*",fread($uk,1000000));
fclose($uk);

$pc=0;

if(Empty($pridrzjme) and Empty($pridrzhes))
{
$pridrzjme="";
$pridrzhes="";
}//end empty

for($p1=0;$p1<count($reg);$p1++)
{
if($reg[$p1]==$pridrzjme and $reg[$p1+1]==$pridrzhes){$pc++;}//rovná-li se pøiète se 1.
}   //end for

if($pc==1)
{
echo                      //do další podsekce!!!
"
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Fotky reálné železnice - Pøednádraží Bøeclav</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>Všechny obrázky jsou zmenšené, originály poskytuji jen na požádání</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled/obr_prednadrazi_a.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie/obr_prednadrazi_a.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled/obr_prednadrazi_b.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie/obr_prednadrazi_b.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled/obr_prednadrazi_c.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie/obr_prednadrazi_c.jpg'\"></td>
 </tr>
 <tr>
  <td><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled/obr_prednadrazi_d.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie/obr_prednadrazi_d.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled/obr_prednadrazi_e.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie/obr_prednadrazi_e.jpg'\"></td>
  <td><input type=image src=\"obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie_nahled/obr_prednadrazi_f.gif\" onclick=\"location.href='obr_vsechny_galerie/obr_foto_galerie/obr_foto_galerie/obr_prednadrazi_f.jpg'\"></td>
 </tr>
</table>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center><input type=image src=\"zpatky_tlacitko.gif\" onclick=\"history.back()\"></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<SCRIPT LANGUAGE=javascript>
function dopl()
{
men.pridrzjme.value=\"$pridrzjme\"; 
men.pridrzhes.value=\"$pridrzhes\";
}
</SCRIPT>
<body onload=\"dopl();\"></body>
";
}
else
{
print "Sem mají pøístup jen zaregistrovaní uživatelé";
}//end if pc
?>
