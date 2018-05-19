<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}
?>

<?
/*  testing!!!
SetCookie ("nazev_cookie", "hodnota");
echo "Tato stránka Vám poslala cookie!";

SetCookie ("nazev_cookie", "hodnota", time()+10*60);
echo "Tato stránka Vám poslala cookie!";

echo "<p>Hodnota naší cookie je ".$_COOKIE["nazev_cookie"];
*/
?> 

<h3><u>Projekty a úlohy z hodin Informaèní a Komunikaèní techniky (IKT)</u></h3>
Programy respektive zdrojáky, které tu budou tak jsou psané 
v Delhpi 6 ( <i>{$APPTYPE CONSOLE}</i> ) no a také podle možností i v TP.<br><br>
<table border=2 align=center>
<tr>
<th colspan=7>Úlohy</th>
</tr>

<tr>
<th>Úloha</th>
<th>Delphi - zdoják</th>
<th>Delphi - EXE</th>
<th>TPascal - zdroj</th>
<th>TPascal - EXE</th>
<th>Vylepšená verze</th>
<th>Funkce</th>
</tr>

<tr>
<td>01</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha01_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha01_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta01_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta01_exec.rar'"></td>
<td>------</td>
<td>Vypsání textu</td>
</tr>

<tr>
<td>02</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha02_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha02_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta02_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta02_exec.rar'"></td>
<td>------</td>
<td>Souèet dvou èísel</td>
</tr>

<tr>
<td>03</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha03_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha03_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta03_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta03_exec.rar'"></td>
<td>------</td>
<td>Výpoèet obsahu a obvodu ètverce</td>
</tr>

<tr>
<td>04</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha04_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha04_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta04_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Výpoèet obsahu a obvodu obdelníku</td>
</tr>

<tr>
<td>05</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha05_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha05_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta05_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Výpoèet obsahu a obvodu kruhu</td>
</tr>

<tr>
<td>06</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta06_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Výpoèet obsahu a obvodu trojùhelníku</td>
</tr>

<tr>
<td>07</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta07_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Pøevod z m na cm,mm,dm,km</td>
</tr>

<tr>
<td>08</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta08_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Pøevod znaku</td>
</tr>

<tr>
<td>09</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta09_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Poèítání zvíøat</td>
</tr>

<tr>
<td>10</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta10_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Posun znaku o urèitý èíslo</td>
</tr>

<tr>
<td>11</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta11_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Celoèíselný dìlení</td>
</tr>

<tr>
<td>12</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta12_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Porovnání dvou èísel</td>
</tr>

<tr>
<td>13</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta13_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Zjištìní kladnosti èísla</td>
</tr>

<tr>
<td colspan=7>&nbsp;</td>
</tr>
<tr>
<td><input type=image src="Turbo.gif" onclick="location.href='tp55.rar'"></td>
<td colspan=6>Zde je na stáhnutí Turbo Pascal verze 5.5</td>
</tr>
<tr>
<td><input type=image src="Turbo.gif" onclick="location.href='TP70.rar'"></td>
<td colspan=6>Zde je na stáhnutí Turbo Pascal verze 7.0</td>
</tr>
</table>
<?
$sb_hes="hes_sdcjaiuaiudfkkjdvoisdjvoisdjoisoisfoiassoiessdfsdfghsoihzfafoaiufauihcd.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*---*",fread($u,1000));
fclose($u); 

if(!Empty($logjm))
{
if($logjm==$reg[0])
{
print "<center><br>";
print "<br><a href='admini_set".$reg[0]."_aecihieufisudeoiapsgjwsoigjsrgaoifujaedoifjh.php' title='Udajù na stránkách' target=_blank>Editace souboru...</a>";
print "</center>";
}
}
print "\n";
?>
