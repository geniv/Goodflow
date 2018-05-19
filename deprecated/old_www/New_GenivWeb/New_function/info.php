<?
if(!Empty($kdo) and !Empty($ide))
{
$delkaotv=DelkaOtvirani("administrace");
$soub="administrace/reg_lide_qpodjiuwhfiuaikjfcnbdbiqpqejfoihsvsnfdiweqopdjiwdnsdodvinvnurehf.php";
$u=fopen($soub,"r");
$udaj=explode("--REG--",fread($u,$delkaotv));
fclose($u);

$del=DelkaRegistrace("administrace");

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$kdo and $udaj[$i+2]==$ide){$poc=$i;}
}//end for

print 
"<h2>Informace o uživateli: {$udaj[$poc]}</h2>
<table border=1>
<tr>
<td>Login:</td>
<td>{$udaj[$poc]}</td>
</tr>

<tr>
<td>Email:</td>
<td>{$udaj[$poc+3]}</td>
</tr>

<tr>
<td>Jmeno:</td>
<td>{$udaj[$poc+4]}</td>
</tr>

<tr>
<td>Pøíjmení:</td>
<td>{$udaj[$poc+5]}</td>
</tr>

<tr>
<td>ICQ:</td>
<td>{$udaj[$poc+6]}</td>
</tr>

<tr>
<td>WWW:</td>
<td>{$udaj[$poc+7]}</td>
</tr>

<tr>
<td>Zájmy:</td>
<td>{$udaj[$poc+8]}</td>
</tr>

<tr>
<td>Bydlištì:</td>
<td>{$udaj[$poc+9]}</td>
</tr>

<tr>
<td>Povolání:</td>
<td>{$udaj[$poc+10]}</td>
</tr>

<tr>
<td>Pohlaví:</td>
<td>{$udaj[$poc+11]}</td>
</tr>

<tr>
<td>Poèet pøíspìvkù:</td>
<td>{$udaj[$poc+13]}</td>
</tr>

<tr>
<td>Obrázek:</td>
<td>{$udaj[$poc+15]}</td>
</tr>

<tr>
<td>Založen:</td>
<td>{$udaj[$poc+16]}</td>
</tr>

<tr>
<td>Pøístup jako:</td>
<td>{$udaj[$poc+17]}</td>
</tr>

<tr>
<td>Hodnocení:</td>
<td>{$udaj[$poc+18]}</td>
</tr>
</table>";

}
else
{
print "Neoprávnìné nabourávání!!";
}
?>
