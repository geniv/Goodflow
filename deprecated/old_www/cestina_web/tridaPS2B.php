<?
$zobr=false;

$sb_hes="hesl_oiaeruhviusjdoijoij�aawpoeuofljylvnsbbvvutzfqwetzvc.php";             
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
if($zobr==true)  //p�i spln�n� podm�nky
{
$s_tr="tridy_dsicjqpjochsdiuhjqwidozeurizdvbnjirefufugrv.php";
$uk=fopen($s_tr,"r");
$trid=explode("-&-",fread($uk,1000));
fclose($uk);

$NPZ2_poz_so="PS2B_po_zn_amka.php";//pozn�mka
$uk=fopen($NPZ2_poz_so,"r");
$vpo=fread($uk,50000);
fclose($uk);

//------------------------koment��
$sob_NPZ2="kom_PS2B_dofvhpoakjf�kbjifgsjqpfogjdjfnbidfbsfsdfn.php";
$uk=fopen($sob_NPZ2,"r");
$kot1=explode("-*-",fread($uk,100000));
fclose($uk);

//------------------konstanty cest----------------------------------
$sona="ces_ps2b_eflkshjqqpeolvjdaqopsokddovhhuevwrugvev.php";
$uk=fopen($sona,"r");
$cet1=explode("*--*",fread($uk,10000));
fclose($uk);

//-------------------konstanty n�zv�--------------------------
$sona="naz_ps2b_jsdhnvonsdiohnvadetboiujweffsdvoijsvbasfsiudsfg.php";
$uk=fopen($sona,"r");
$nat1=explode("*--*",fread($uk,10000));
fclose($uk);

$ppol=count($nat1);//po�et polo�ek
$pop="Ulo�...";

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
<h1 align=center><u>T��da ".$trid[2]."</u></h3>
<h3 align=center>Studijn� materi�ly pro ��ky S� informatiky a spoj� Brno, �ichnova 23</h3>

<table border=0 align=center>
<tr>
<th>N�zev</th>
<th>Ulo�te si</th>
<th>Koment��</th>
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
<a href=\"vzkaz_icnuaibvjqpwofjvndksjvnajcnuiajniudjfadiufhn.php\" target=\"_blank\">P�idat dotaz pro spr�vce str�nek</a>
<br><br>
<u>Pozn�mky pro studenty:</u><b> $vpo</b>
</center>
";
}
else
{
print "<br><br><br><br><br><h1 align=center>Nepovolen� p��stup</h1>";
}
?>
