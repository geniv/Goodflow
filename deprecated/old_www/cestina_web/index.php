<?
require "zac.php";   //jen 1x!!
             
$sb_hes="hesl_oiaeruhviusjdoijoij�aawpoeuofljylvnsbbvvutzfqwetzvc.php";             
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

$logs="Vstup pod p�ihl�en�m: <b>".$trida."</b> s heslem: <b>".$hes."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR."<br>\n";
$lg="ologovo_soboro.php";
$zaz=fopen($lg,"a+"); //bez ov��en� existence
if($zap==true){fwrite($zaz,$logs);}
fclose($zaz);

for($ov=0;$ov<$delka_pr;$ov++)//nez�le�� na po�ad�, proch�z� to cel�
{
if($prist[$ov]==$trida and $prist[$ov+1]==$hes){$pr++;}
}//end for
if($pr==1)
{
require "trida".$trida.".php"; //v�echno jde p�es tohle!!!
}
else
{
print "<br><br><br><br><br><h1 align=center>Nepovolen� p��stup</h1>";
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
<h2 align=center><u>Studijn� materi�ly pro ��ky S� informatiky a spoj� Brno, �ichnova 23</u></h2>
<br>
<br>
<br>
<form method=post>
<table border=0 align=center>
<tr>
<td>T��da a ro�n�k: </td>
<td><input type=text name=tri size=5 title=\"T��da\"><input type=text name=roc size=2 title=\"Ro�n�k\"></td>
</tr>
<tr>
<td>Heslo: </td>
<td><input type=password name=hes size=9 title=\"Tajn� heslo\"></td>
</tr>
<tr>
<th colspan=2><input type=submit value=\"Vstupte\" title=\"Po vypln�n� udaj� m��ete vstoupit\"></th>
</tr>
</table>
</form>
<br><center><b>".$vstuppoz."</b></center>
";
}//end if empty
require "kon.php";
?>
