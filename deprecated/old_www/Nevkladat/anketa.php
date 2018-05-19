<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>PHP - anketa</title>
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?
print $znamka;
if (File_Exists ("stats.txt")) // existuje soubor se statistikou?
{
$fp = FOpen ("stats.txt", "r");
$stats = Explode ("#", FRead ($fp, 999)); // načteme obsah souboru do pole, jednotlivé části řetězce oddělené znakem # přijdou do jednotlivých buněk
FClose ($fp);
}
else
{
for ($i = 0; $i <= 5; $i++) $stats[$i] = 0; // pokud ještě soubor neexistuje, dáme všude nuly
}

if ($stats[0] == $REMOTE_ADDR) $stats[$znamka]++; // pokud tato známka přišla z jiné adresy než ta předchozí, přičteme ji
$stats[0] = $REMOTE_ADDR; // aktualizujeme poslední IP adresu

$hlasu = 0; // celkový počet hlasů (známek)
$suma = 0; // celková suma (počet každé známky násobená její hodnotou)
for ($i = 1; $i <= 5; $i++)
{
$hlasu += $stats[$i]; // přičteme počet této známky k celkovému počtu
$suma += $i * $stats[$i]; // přičteme počet známky krát její hodnotu k celkové sumě
}//1*x+2*x+3*x+4*x+5*x
$prumer = (Round (100 * $suma / $hlasu)) / 100; // průměrná známka zaokrouhlená na dvě desetinná místa

$fp = FOpen ("stats.txt", "w"); // uložíme aktuální statistiky
FWrite ($fp, Implode ($stats, "#"));
FClose ($fp);
?>

<center><font face="Arial CE, Arial" size="5">
Jakou známku byste dali seriálu o PHP? (1... nejlepší, 5 ... nejhorší)<br>
Díky za hodnocení. Celkem seriál o PHP oznámkovalo <? print $hlasu; ?> čtenářů
průměrnou známkou <? print $prumer; ?>.
</font></center>
<? print $suma; ?>

<form method="post">
<center><font face="Arial CE, Arial" size="5">
Jakou známku byste dali seriálu o PHP? (1... nejlepší, 5 ... nejhorší)<br>
<input type="radio" name="znamka" value="1" checked> 1
<input type="radio" name="znamka" value="2"> 2
<input type="radio" name="znamka" value="3"> 3
<input type="radio" name="znamka" value="4"> 4
<input type="radio" name="znamka" value="5"> 5
<input type="hidden" name="action" value="send"><br>
<input type="submit" value="Oznámkuj!">
</font></center>
</form>


</body>

</html>
