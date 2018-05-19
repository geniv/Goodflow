<?
$soub="kosmetika/administrace/cenik_sjfhvboiklkasjcoiqpfjjhfgdfkdlsjcvkdjfbvhireuhgviurehvhnuf.php";
$u=fopen($soub,"r");
$cen=explode("--CEN--",fread($u,DelkaOtevirani("kosmetika/administrace")));
fclose($u);

$del=DelkaCeniku("{$sekce}/administrace");

if(count($cen)!=1)
{
print 
"<h4>Ceník služeb kosmetiky:</h4>
<table border=\"1\" width=\"97%\" cellspacing=\"0\" cellpadding=\"1\" borderColorDark=\"white\" borderColorLight=\"white\" style=\"border-left-color:white; border-bottom-color:white; border-top-color:white; border-right-color:white;\">";
for($i=1;$i<((count($cen)-1)/$del)+1;$i++)
{
print
"<tr>
<td height=\"20px\">{$cen[($i*$del)-1]}</td>
<td height=\"20px\" align=\"center\" width=\"30%\">{$cen[($i*$del)]},- Kè</td>
</tr>";
}//end for
print 
"</table><br>";
}
else
{
print "Žádné ceníky";
}
?>
