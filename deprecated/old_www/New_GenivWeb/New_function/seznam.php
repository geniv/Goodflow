<?
print
"<h2>Seznam uživatelù</h2>";

$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$del=DelkaRegistrace("administrace");

print 
"<table border=1>
<tr>
<td>Jméno:</td>
<td>Bydlištì:</td>
<td>Založeno:</td>
<td>Pøíspìvkù:</td>
<td>WWW:</td>
</tr>";

for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
print 
"<tr>
<td><a href=\"index.php?kam=info&kdo={$udaj[($i*$del)-18]}&ide={$udaj[($i*$del)-16]}\" class=\"odkaz\">{$udaj[($i*$del)-18]}</a></td>
<td>{$udaj[($i*$del)-9]}</td>
<td>{$udaj[($i*$del)-2]}</td>
<td>{$udaj[($i*$del)-5]}</td>
<td><a href=\"{$udaj[($i*$del)-11]}\">{$udaj[($i*$del)-11]}</a></td>
</tr>";
}//end for i
print "</table>";

?>

