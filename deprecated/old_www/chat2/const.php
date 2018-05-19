<?
$subor = "./data.txt"; // cesta k suboru, kde sa budu ukladat spravy

$maxDlzkaMeno = 8; // maximalna dlzka retazca "meno"
$maxDlzkaSprava = 80; // maximalna dlzka retazca "sprava"

$maxPocetOdkaz = 15; // kolko poslednych odkazov sa ma zobrazovat ?

// format zobrazenia spravy
$format = sprintf("%s <b>%%%d.%ds: </b>%%-%d.%ds<br>",Date("d.m.Y H:i:s"),$maxDlzkaMeno,$maxDlzkaMeno,$maxDlzkaSprava,$maxDlzkaSprava);

// kolko bajtov obsahuje maxPocetOdkaz ?
$maxOdkazByte = StrLen(sprintf($format,"","")) * $maxPocetOdkaz;
?>