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
  <td align=center>Zajímavosti - Obrázky, Zábavné obrázky, TRS, Železnice</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>Rozcestník:</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style="border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;">
 <tr>
  <td align=center id=barv_tab_poz>Zábavné kreslené obrázky<br clear=right><input type=image src="obr_zajimavosti/obr_nahled_rozcestnik/vtipne_obrazky_kreslene.gif" onclick="men.kam.value='vtipne_kreslene_obrazky';men.posl.click();"></td>
  <td align=center id=barv_tab_poz>Ostatní zajímavosti<br clear=right><input type=image src="obr_zajimavosti/obr_nahled_rozcestnik/zajimavosti_ostatni.gif" onclick="men.kam.value='ostatni_zajimavosti';men.posl.click();"></td>
 </tr>
</table>
