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
$stats = Explode ("#", FRead ($fp, 999)); // na�teme obsah souboru do pole, jednotliv� ��sti �et�zce odd�len� znakem # p�ijdou do jednotliv�ch bun�k
FClose ($fp);
}
else
{
for ($i = 0; $i <= 5; $i++) $stats[$i] = 0; // pokud je�t� soubor neexistuje, d�me v�ude nuly
}

if ($stats[0] == $REMOTE_ADDR) $stats[$znamka]++; // pokud tato zn�mka p�i�la z jin� adresy ne� ta p�edchoz�, p�i�teme ji
$stats[0] = $REMOTE_ADDR; // aktualizujeme posledn� IP adresu

$hlasu = 0; // celkov� po�et hlas� (zn�mek)
$suma = 0; // celkov� suma (po�et ka�d� zn�mky n�soben� jej� hodnotou)
for ($i = 1; $i <= 5; $i++)
{
$hlasu += $stats[$i]; // p�i�teme po�et t�to zn�mky k celkov�mu po�tu
$suma += $i * $stats[$i]; // p�i�teme po�et zn�mky kr�t jej� hodnotu k celkov� sum�
}//1*x+2*x+3*x+4*x+5*x
$prumer = (Round (100 * $suma / $hlasu)) / 100; // pr�m�rn� zn�mka zaokrouhlen� na dv� desetinn� m�sta

$fp = FOpen ("stats.txt", "w"); // ulo��me aktu�ln� statistiky
FWrite ($fp, Implode ($stats, "#"));
FClose ($fp);
?>

<center><font face="Arial CE, Arial" size="5">
Jakou zn�mku byste dali seri�lu o PHP? (1... nejlep��, 5 ... nejhor��)<br>
D�ky za hodnocen�. Celkem seri�l o PHP ozn�mkovalo <? print $hlasu; ?> �ten���
pr�m�rnou zn�mkou <? print $prumer; ?>.
</font></center>
<? print $suma; ?>

<form method="post">
<center><font face="Arial CE, Arial" size="5">
Jakou zn�mku byste dali seri�lu o PHP? (1... nejlep��, 5 ... nejhor��)<br>
<input type="radio" name="znamka" value="1" checked> 1
<input type="radio" name="znamka" value="2"> 2
<input type="radio" name="znamka" value="3"> 3
<input type="radio" name="znamka" value="4"> 4
<input type="radio" name="znamka" value="5"> 5
<input type="hidden" name="action" value="send"><br>
<input type="submit" value="Ozn�mkuj!">
</font></center>
</form>


</body>

</html>
