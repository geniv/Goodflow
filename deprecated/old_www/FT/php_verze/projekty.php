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
  <td align=center>Projekty - Objekty co stavím nebo se chystám stavìt pro TRS</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=3 cellpadding=3 borderColorDark=white borderColorLight=white style="border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;">
 <tr>
  <td align=center id=barv_tab_poz>Název projektu:</td>
  <td align=center id=barv_tab_poz>Stav projektu:</td>
 </tr>
 <tr>
  <td align=center>Dùl Schoeller</td>
  <td align=center>Model ve výstavbì</td>
 </tr>
 <tr>
  <td align=center>Rozestavìný dùm</td>
  <td align=center>Model ve výstavbì</td>
 </tr>
 <tr>
  <td align=center>Moravský Krumlov</td>
  <td align=center>Hotovo</td>
 </tr>
 <tr>
  <td align=center>Stavìdlo Moravský Krumlov</td>
  <td align=center>Zatím jsou jen podklady</td>
 <tr>
  <td align=center>Sada potegovaných el. skøíní</td>
  <td align=center>Idea</td>
 </tr>
 <tr>
  <td align=center>Potegovaná trafika</td>
  <td align=center>Idea</td>
 </tr>
 <tr>
  <td align=center>Lamelový billboard</td>
  <td align=center>Hotovo</td>
 </tr>
 <tr>
  <td align=center>Motorová lokomotiva T698.002</td>
  <td align=center>Model ve výstavbì</td>
 </tr>
</table>
