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
//poèítání--------------------------------------
$pocso="pocet_zobrazeni_clanku_problemy_zobrazeni_sdbgfjkdshfksnfklfxdhbfldzhjrdkulz.php";
$upp=fopen($pocso,"r+");
$pop=fread($upp,10);
rewind($upp);
fwrite($upp,++$pop,10);
fclose($upp);                        
?>
<title>Problémy s registrací na Fugess Trainz CZ</title>
<style>
body,table,center
{
background: #A8ACB8;
font-family: Trebuchet MS, Courier, Courier New, sans-serif, verdana;
font-size: 14px;
font-weight: bold;
color: black;
}
#vel_a
{
text-decoration: underline;
font-size: 16px;
}
#vel_b
{
font-size: 12px;
}
</style>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center>Èlánek:</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center id=vel_a>Problémy s registrací na Fugess Trainz CZ</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center>Objevily se zde problémy s registrací pro pøístup do rùzných galerií. Zejména za to mohly vìty, které byly automaticky posílány, tìm lidem, kteøí úspìšnì dokonèily registraci. Dne 26.12.2006 byly tyto chyby ihned opraveny na srozumitelné pro všechny. Nyní, když se bude registrovat nový úèastník, tak se mu po zaregistrování zašle e-mail s oznámením, že registrace byla zaznamenána v databázi a že mu bude do 24 hodin zaslán druhý potvrzovací e-mail. Za pøedešlé zmatky pøi registraci se omlouvám. Dìkuji za trpìlivost a za oznámení problému.</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center id=vel_b>Autor èlánku: Fugess - administrátor</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td id=vel_b align=center colspan=3>Èlánek prohlíželo <? print $pop ?> lidí</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td align=center><input type=image src="zpatky_tlacitko.gif" onclick="window.close()"></td>
 </tr>
</table>
