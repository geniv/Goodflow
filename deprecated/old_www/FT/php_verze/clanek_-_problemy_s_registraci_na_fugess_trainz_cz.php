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
//po��t�n�--------------------------------------
$pocso="pocet_zobrazeni_clanku_problemy_zobrazeni_sdbgfjkdshfksnfklfxdhbfldzhjrdkulz.php";
$upp=fopen($pocso,"r+");
$pop=fread($upp,10);
rewind($upp);
fwrite($upp,++$pop,10);
fclose($upp);                        
?>
<title>Probl�my s registrac� na Fugess Trainz CZ</title>
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
  <td colspan=3 align=center>�l�nek:</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center id=vel_a>Probl�my s registrac� na Fugess Trainz CZ</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center>Objevily se zde probl�my s registrac� pro p��stup do r�zn�ch galeri�. Zejm�na za to mohly v�ty, kter� byly automaticky pos�l�ny, t�m lidem, kte�� �sp�n� dokon�ily registraci. Dne 26.12.2006 byly tyto chyby ihned opraveny na srozumiteln� pro v�echny. Nyn�, kdy� se bude registrovat nov� ��astn�k, tak se mu po zaregistrov�n� za�le e-mail s ozn�men�m, �e registrace byla zaznamen�na v datab�zi a �e mu bude do 24 hodin zasl�n druh� potvrzovac� e-mail. Za p�ede�l� zmatky p�i registraci se omlouv�m. D�kuji za trp�livost a za ozn�men� probl�mu.</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td colspan=3 align=center id=vel_b>Autor �l�nku: Fugess - administr�tor</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td id=vel_b align=center colspan=3>�l�nek prohl�elo <? print $pop ?> lid�</td>
 </tr>
 <tr>
  <td colspan=3 align=center><hr color=white size=1></td>
 </tr>
 <tr>
  <td align=center><input type=image src="zpatky_tlacitko.gif" onclick="window.close()"></td>
 </tr>
</table>
