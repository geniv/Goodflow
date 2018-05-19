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
  <td align=center>Odkazy</td>
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
  <td align=center><a href="http://trainz.jedisoft.cz" target="blank">Èeský oficiální web o TRS</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://tomas-trainz.net" target="blank">Tomas Trainz</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://danburger.trainz.cz" target="blank">Danburger Trainz</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://holoubek.silesiasoft.cz" target="blank">Holoubek Trainz</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://www.czechtrains.com" target="blank">Czech Trains</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://milas.trainz.cz" target="blank">Milas Trainz</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://www.vlaky-kuna.ic.cz" target="blank">Vlaky kuna</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://viktor-trainz-vlaky.ic.cz" target="blank">Viktor Trainz</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://geniv.wz.cz" target="blank">Bráchùv web (Geniv)</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://www.ursus-trainz.profitux.cz" target="blank">Ursus Trainz</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://www.trainz-online.com/fansites.htm" target="blank">Trainz - Online</a></td>
 </tr>
 <tr>
  <td align=center><a href="http://dandys1.wz.cz" target="blank">Dandysovi stránky</a></td>
 </tr>
</table>
