<?
$soubor="administrace/odkazy_poiucvcdskjhvkjvbsijhvjkvnjkhjfosibvdhfbhjvdhgvjydbvjhdbvjdsbvjhdsbvhjsdbvhjsdbvvlkanhsbvshvuvuifubghsjbshvs.php";
$u=fopen($soubor,"r");
$udaj=explode("--ODK--",fread($u,DelkaOteviraniSouboru("administrace")));
fclose($u);

$del=DelkaPoleOdkazu("administrace");

if(((count($udaj)-1)/$del)!=0)
{
print
"<table border=\"0\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">";

for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
print
"<tr>
<td><a href=\"{$udaj[($i*$del)]}\" target=\"_blank\" class=\"odkaz\">{$udaj[($i*$del)-1]}</a></td>
</tr>";
}//end for

print "</table>";

}
else
{print "Žádné odkazy";}
?>
