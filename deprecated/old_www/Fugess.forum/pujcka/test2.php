<?
include "funkce.php";

$delkasoub=delka_souboru();
$sb_hes="skr_ypt_zn_ack_y_pqwkdfciournviowemvionvmsvinsokfmwirumviowjdvmiojvmifovjnmwroviksjkmowirkvjkowivjvikmweoivnoiwrejnv.php";
$u=fopen($sb_hes,"r");
$zdroj=explode("--z--",fread($u,$delkasoub));
fclose($u);

$sb_hes="skry_p_t_zn_prevod_qpfomcieufnbviomciwnvisnmvosdmvosfnmvosnvjfdnbslkmvsokfmvosikdmvfolksdvnslkfmvsdfolkvmdolkfvmed.php";
$u=fopen($sb_hes,"r");
$nahrada=explode("--zp--",fread($u,$delkasoub));
fclose($u);

$zd=count($zdroj);
$na=count($nahrada);

print
"<link rel=\"stylesheet\" href=\"fugess-f-z.css\" type=\"text/css\">
<form>
<input type=text name=pok>
<input type=submit value=Zpracuj>
</form>

<table border=1>
<tr>
<td>#</td>
<td>Zdroj</td>
<td>Nadrada</td>
<td>Zdroj (jine)</td>
<td>Nadrada (jine)</td>
<tr>";

for($i=1;$i<count($nahrada);$i++)
{
echo
"
<tr>
<td>$i</td>
<td>

{$zdroj[$i]}

</td>
<td>

{$nahrada[$i]}

</td>

<td><input type=text value=\"".htmlspecialchars($zdroj[$i])."\"></td>
<td><input type=text size=50 value=\"".htmlspecialchars($nahrada[$i])."\"></td>

</tr>
";
}
print
"</table>
Délka zdroje: $zd<br>
Délka náhrady: $na<br><br><br>";

if(!Empty($pok))
{
print prekopej_text($pok);
}
?>
