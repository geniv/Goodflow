<?
$zobr=false;

$sb_hes="hesl_oiaeruhviusjdoijoijùaawpoeuofljylvnsbbvvutzfqwetzvc.php";             
$u=fopen($sb_hes,"r");
$pristup=explode("***",fread($u,1000));
fclose($u);

$tridazd=$pristup[4];
$heszd=$pristup[5];

if(!Empty($tri) and !Empty($roc) and !Empty($hes))
{
$trida=$tri.$roc;  
if($trida==$tridazd and $hes==$heszd){$zobr=true;}
} //end if empty
if($zobr==true)  //pøi splnìní podmínky
{
$s_tr="tridy_dsicjqpjochsdiuhjqwidozeurizdvbnjirefufugrv.php";
$uk=fopen($s_tr,"r");
$trid=explode("-&-",fread($uk,1000));
fclose($uk);

$NPZ2_poz_so="PS2B_po_zn_amka.php";//poznámka
$uk=fopen($NPZ2_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);

//------------------------komentáø
$sob_NPZ2="kom_PS2B_dofvhpoakjfùkbjifgsjqpfogjdjfnbidfbsfsdfn.php";
$uk=fopen($sob_NPZ2,"r");
$kot1=explode("-*-",fread($uk,100000));
fclose($uk);

//------------------konstanty cest----------------------------------
$sona="ces_ps2b_eflkshjqqpeolvjdaqopsokddovhhuevwrugvev.php";
$uk=fopen($sona,"r");
$cet1=explode("*--*",fread($uk,10000));
fclose($uk);

//-------------------konstanty názvù--------------------------
$sona="naz_ps2b_jsdhnvonsdiohnvadetboiujweffsdvoijsvbasfsiudsfg.php";
$uk=fopen($sona,"r");
$nat1=explode("*--*",fread($uk,10000));
fclose($uk);

$ppol=count($nat1);//poèet položek
$pop="Ulož...";

for($p1=0;$p1<$ppol;$p1++)
{
if($kot1[$p1]=="nestahovat")
{$zat1[$p1]="disabled";
$cet1[$p1]="soubor.php";}
else
{$zat1[$p1]="";}
}
echo 
"
<h1 align=center><u>Tøída ".$trid[2]."</u></h3>
<h3 align=center>Studijní materiály pro žáky SŠ informatiky a spojù Brno, Èichnova 23</h3>

<table border=0 align=center>
<tr>
<th>Název</th>
<th>Uložte si</th>
<th>Komentáø</th>
</tr>
";
for($p1=0;$p1<$ppol;$p1++)
{
echo 
"<tr>
<td>".$nat1[$p1]."</td>
<th><input type=button value=\"$pop\" ".$zat1[$p1]." onclick=\"location.href='".$cet1[$p1]."'\"></th>
<th>".$kot1[$p1]."</th>
</tr>
";
}
echo 
"
</table>
<br>
<center>
<a href=\"vzkaz_icnuaibvjqpwofjvndksjvnajcnuiajniudjfadiufhn.php\" target=\"_blank\">Pøidat dotaz pro správce stránek</a>
<br><br>
<u>Poznámky pro studenty:</u><b> $vpo</b>
</center>
";
}
else
{
print "<br><br><br><br><br><h1 align=center>Nepovolený pøístup</h1>";
}
?>
