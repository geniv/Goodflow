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
<table border=0 align=center cellspacing=0 cellpadding=0 width=640px>
<tr>
<td id=vel_a align=center>Ot�zky a odpov�di</td>
</tr>
<tr>
<td align=center><hr size=1 color=white></td>
</tr>
<tr>
<td align=center><input type=button value="Napsat ot�zku" onclick="men.kam.value='pridej';men.posl.click();"></td>
</tr>
<tr>
<td align=center><hr size=1 color=white></td>
</tr>
</table>
<table border=0 align=center cellspacing=0 cellpadding=0>
<?
if($dota && $dotajme && $dotamejl)
{
$dota="<tr><td><table border=0 align=left cellspacing=2 cellpadding=0 width=640px><tr><td valign=top align=right><u>Jm�no</u>:</td><td><div style=width:580px;>".$dotajme."</td></tr><tr><td valign=top align=right><u>E-mail</u>:</td><td>".$dotamejl."</td></tr><tr><td valign=top align=right><u>Ot�zka</u>:</td><td id=otz_odp_barv_a>".$dota."</td></tr><tr><td valign=top align=right><u>Odpov��</u>:</td><td><span id=otz_odp_barv>Vy�kejte pros�m na odpov�� od administr�tora</span></td></tr><tr><td colspan=2><hr size=1 color=white></td></tr></table></td></tr>\n";
mail("fugess@trainz.cz","P�id�n dotaz","Vlo�eno:\nOd koho:".$dotajme."\n Email: ".$dotamejl."\nZpr�va: ".$dota."; z IP: ".$REMOTE_ADDR."\n v: ".Date("H:i:s j.m. Y"));
if(!$soubor=fopen("dotazy_skdjvjaoiujhcsiudhoiudhfoiruwruzqpokjfgzuhskzruiasdffmk.php","a+"))
{
echo("Soubor nelze otev��t!");
}
else
{
if(!@fwrite($soubor,$dota))
echo("Chyba p�i z�pisu do souboru!");
else
fclose($soubor);
}
}
if(File_Exists("dotazy_skdjvjaoiujhcsiudhoiudhfoiruwruzqpokjfgzuhskzruiasdffmk.php"))
{
$text=file("dotazy_skdjvjaoiujhcsiudhoiudhfoiruwruzqpokjfgzuhskzruiasdffmk.php");    // na�ten� do pole
while($dotz = Each($text))  //z dotz ud�l� pole
 {
  print $dotz["value"];
 }
}
print "</table>";
?>
