<?
$tema[0]="tema 1";//ze ssouboru!
$tema[1]="tema 2";

echo 
"Právì je: ".datum()."
<table border=1>";
$ppm=0;
for($i=0;$i<count($tema);$i++)
{
$ppm++;
echo 
"<tr>
<td><a href=\"index.php?kam=forum&cis=$ppm\">{$tema[$i]}</a></td>
</tr>
";
}
echo "</table>";
?>
