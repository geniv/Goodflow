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

if(!Empty($ajm) and !Empty($ahe1) and !Empty($ahe2))
{

$tepri="Pøihlašování: <b>".$ajm."</b> s 1.heslem: <b>".$ahe1."</b> s 2.heslem: <b>".$ahe2."</b> do: <b>".$kam."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR." - <b>".$kdo."</b><br>\n";
$soupri="log_prihil_scnicoijqqpqowksvnnvbubiuiwsrhodfheudjhn.php";
$usopr=fopen($soupri,"a+");
fwrite($usopr,$tepri);
fclose($usopr);

 if(($ajm=="Fugess" and $ahe1=="Mercury" and $ahe2=="Olympus")or($ajm=="Geniv" and $ahe1=="TOSHIBA" and $ahe2=="Tecra8000"))
 {
 $ajm="Fugess";
 require "adminsetup.php";
 }
 else
 {
 print "<center>Sem nemáš pøístup !</center>";
 }
}
else
{
echo
"
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center>Vstup jen pro zvolené lidi</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
<table border=1 align=center valign=top cellspacing=2 cellpadding=2 borderColorDark=white borderColorLight=white style=\"border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;\">
 <tr>
  <td align=center><input type=text name=adjm></td>
 </tr>
 <tr>
  <td align=center><input type=password name=adhe1></td>
 </tr>
 <tr>
  <td align=center><input type=password name=adhe2></td>
 </tr>
 <tr>
  <td align=center><input type=password name=adhe3></td>
 </tr>
 <tr>
  <td align=center><input type=button value=\"Vstoupit\" onclick=\"men.ajm.value=adjm.value;men.ahe1.value=adhe1.value;men.ahe2.value=adhe2.value;men.kam.value='admin';men.posl.click();\"></td>
 </tr>
</table>
";
}
?>
