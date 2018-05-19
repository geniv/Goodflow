<?
require "zac.php";   //jen 1x!!
             
$sb_hes="hesl_oiaeruhviusjdoijoijùaawpoeuofljylvnsbbvvutzfqwetzvc.php";             
$u=fopen($sb_hes,"r");
$prist=explode("***",fread($u,1000));
fclose($u);
             
$zvjm=$prist[10];
$zvhe=$prist[11];         
             
$delka_pr=count($prist);
$pr=0;

$vs_poz_so="vstupni_po_zn_amka.php";
$uk=fopen($vs_poz_so,"r");
$vstuppoz=fread($uk,50000);
fclose($uk);

if(!Empty($tri) and !Empty($roc) and !Empty($hes))
{
$trida=$tri.$roc;

if($zvjm==$trida and $zvhe==$hes)
{
$zap=false;
}
else
{
$zap=true;
}

$logs="Vstup pod pøihlášením: <b>".$trida."</b> s heslem: <b>".$hes."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR."<br>\n";
$lg="ologovo_soboro.php";
$zaz=fopen($lg,"a+"); //bez ovìøení existence
if($zap==true){fwrite($zaz,$logs);}
fclose($zaz);

for($ov=0;$ov<$delka_pr;$ov++)//nezáleží na poøadí, prochází to celé
{
if($prist[$ov]==$trida and $prist[$ov+1]==$hes){$pr++;}
}//end for
if($pr==1)
{
require "trida".$trida.".php"; //všechno jde pøes tohle!!!
}
else
{
print "<br><br><br><br><br><h1 align=center>Nepovolený pøístup</h1>";
}//end if pr
}
else//else empty
{
echo
"
<br>
<br>
<br>
<br>
<h2 align=center><u>Studijní materiály pro žáky SŠ informatiky a spojù Brno, Èichnova 23</u></h2>
<br>
<br>
<br>
<form method=post>
<table border=0 align=center>
<tr>
<td>Tøída a roèník: </td>
<td><input type=text name=tri size=5 title=\"Tøída\"><input type=text name=roc size=2 title=\"Roèník\"></td>
</tr>
<tr>
<td>Heslo: </td>
<td><input type=password name=hes size=9 title=\"Tajné heslo\"></td>
</tr>
<tr>
<th colspan=2><input type=submit value=\"Vstupte\" title=\"Po vyplnìní udajù mùžete vstoupit\"></th>
</tr>
</table>
</form>
<br><center><b>".$vstuppoz."</b></center>
";
}//end if empty
require "kon.php";
?>
