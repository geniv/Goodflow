<?
echo
"<script language=\"JavaScript\">
function odk(cislo)
{
";
$sb="aktuality_skrypt_DB_odkazy_po_str_aoisdhncoasdnqpojfuiszvsfhcnivuisnvisbviusdhhfvisdhuvdvwsd.php";             
$u=fopen($sb,"r");
$akt=explode("***AKU***",fread($u,1000000));
fclose($u);
for($i=1;$i<count($akt);$i++)//vygeneruje skrypt z pole
{
echo "if(cislo==$i){men.kam.value='".$akt[$i]."';men.poslat.click();}\n";
}//end for
echo
"}
</script>";
require "aktuality_upravovani_qpwrijoiweuhrfgvuirhbiuvnuivwrezvbwriufniuowr.php";
?>
