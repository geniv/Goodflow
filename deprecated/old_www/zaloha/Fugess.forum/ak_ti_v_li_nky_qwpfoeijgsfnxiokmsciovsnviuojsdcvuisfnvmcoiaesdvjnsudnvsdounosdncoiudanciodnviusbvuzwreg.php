<?
$sb_hes="seznam_akti_vace_qpewfmonfvdvkmwoibndslkfjmeoijgvkfmwfgnvdkfjiworebpiojweolfiljnoslkmnfoiksdnoesdjrng.php";
$u=fopen($sb_hes,"r");
$udaj=explode("--AT--",fread($u,1000000));
fclose($u);

if(!Empty($smaz))
{
for($i=1;$i<count($udaj);$i++)
{
if($smaz==$i and file_exists($udaj[$i]))
{
print "Soubor: {$udaj[$i]} je smazán!";
unlink($udaj[$i]);
}
}//end for
}

$slozka=basename(getcwd());
$sob=basename($PATH_TRANSLATED);

echo
"<form>
<table border=1>";
for($i=1;$i<count($udaj);$i++)
{
if(file_exists($udaj[$i])=="true")
{$jeta="existuje";
$bar="lime";}
else
{$jeta="neexistuje";
$bar="red";}

$link="http://$SERVER_NAME/$slozka/$udaj[$i]";

echo "
<tr>
<td><a href=\"$link\" target=\"_blank\">$link</a></td>
<td>{$udaj[$i]}</td>
<td bgcolor=\"$bar\">$jeta</td>
<td><a href=\"http://$SERVER_NAME/$slozka/$sob?smaz=$i\">Smazat soubor {$udaj[$i]}</td>
</tr>";
}//end for
echo
"
</table>
</form>";
?>
