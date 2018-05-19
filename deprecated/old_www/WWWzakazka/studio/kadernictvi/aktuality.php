<?
$soub="kadernictvi/administrace/aktuality_qpofkoivnosfihvnkjhnfniujdfnvisfuviudfhviefuhvfivuhbuhhvcsdhc.php";
$u=fopen($soub,"r");
$akt=explode("--AKT--",fread($u,DelkaOtevirani("kadernictvi/administrace")));
fclose($u);

$del=DelkaAktualit("{$sekce}/administrace");

if(count($akt)!=1)
{
print 
"<h4>Aktuality</h4>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"97%\">";
for($i=(count($akt)-1)/$del;$i>0;$i--)
{
print
"<tr>
<td>{$akt[($i*$del)]}</td>
</tr>";
}//end for
print 
"</table>";
}
else
{
print "Žádné akuality";
}
?>
