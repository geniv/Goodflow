<?php
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/main.css\" />
<title>Přihlašte se......</title>
</head>

<body>
";

$table_name = "myrs_clanky";
$sql = "update"; // insert nebo update

echo "<form action=\"\" method=\"POST\">";
echo "<table border=\"0\">";
require "../conf.php";



//POKUD JE PROMENA SQL UPDATE AKTIVUJE SE TENTO SCRIPT
if($_GET[a] == "update"){
$query_up = "Select * From $table_name where id like '$_GET[id]'";
$prikaz_up = $mysqli->query($query_up);
$update = $prikaz_up->fetch_array();
}
else
{$sql = "insert";}
//KONEC

////RESI JENOM OPTION NEBOLI KLICOVE SLOVO ENUM
function option($klicove_slovo, $value){
if("$value" != ""){
$prevod_formular_enum = array("enum" => "<option value=\"{$value}\">{$value}</option>");
$prevod_formular_enum = strtr($klicove_slovo, $prevod_formular_enum);
echo "{$prevod_formular_enum}";
}
}

///KONEC UPDATE KOLEKCE
$query = "SHOW FULL COLUMNS FROM $table_name";
$prikaz = $mysqli->query($query);
while ($obj = $prikaz->fetch_object()) {

////UPRAVY VESKERE nezadouci znaky na ; a tim pomuze prerozdelit pozadovane klicove slova v explode
$uprava_sql = array("(" => ";",")" => "","','" => ";","'" => "");
$uprava_sql = strtr("$obj->Type", $uprava_sql); //upravi znaky na ;
$uprava_sql = explode(";", $uprava_sql);
////KONEC UPRAVY
$File_up = $obj->Field;

/// DAVA PROMENE SLOUPCU DO INSERTU
$namefield["insert"] .= "`{$obj->Field}`,";

/// DAVA PROMENE SLOUPCU DO UPDATE
if($obj->Comment != ""){$namefield["insert2"] .= "`{$obj->Field}`='$_POST[$File_up]',";}

$i = 1 + $i++;


if("enum" != $uprava_sql["0"])
{
//PREVADI KLICOVA SLOVA NA FORMULAR
$prevod_formular = array("varchar" => "<input type=\"text\" name=\"$obj->Field\" maxlength=\"{$uprava_sql["1"]}\" value=\"{$update[$obj->Field]}\" />","int" => "<input type=\"text\" name=\"{$update[$obj->Field]}\" maxlength=\"{$uprava_sql["1"]}\" value=\"{$update[$obj->Field]}\" />",
"datetime" => "<input type=\"text\" name=\"{$update[$obj->Field]}\" maxlength=\"{$uprava_sql["1"]}\" value=\"{$update[$obj->Field]}\" />","text" => "<textarea name=\"$obj->Field\" rows=\"4\" cols=\"20\">{$update[$obj->Field]}</textarea>");
$prevod_formular = strtr($uprava_sql["0"], $prevod_formular);

if($obj->Comment != ""){echo "<tr>
<td>{$obj->Comment}</td><td>$prevod_formular</td>
</tr>
";}

}/// ZOBRAZI VSE KROME ENUM
else
{
echo "<tr>
<td>{$obj->Comment}</td><td><select name=\"$obj->Field\">";

////JE POVOLENO MAXIMALNE 15 POLOZEK V OPTION
for ($ii = 1; $ii <= 25; $ii++) {
echo option($uprava_sql["0"], $uprava_sql["$ii"]);
}

echo "$uprava_sql[0]</select></td>
</tr>";
}
}

echo "
<tr>
<td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Odeslat\" name=\"send\" />
</tr>
";
echo "</table>";
echo "</form>";

print_r($zkouska);

//UPDATE A INSERT
$uprav = array(",)" => ")","', W" => "' W");
if($sql == "insert")
{$muj_prikaz = "INSERT INTO `$table_name` ({$namefield["insert"]}) VALUES ({$namefield["insert2"]})"; echo $muj_prikaz = strtr($muj_prikaz, $uprav);}
else{$muj_prikaz = "UPDATE `$table_name` SET {$namefield["insert2"]} WHERE (`id`='$_GET[id]') LIMIT 1"; echo $muj_prikaz = strtr($muj_prikaz, $uprav);}
//END UPDATE A INSERT





//DODELAT udelat skript, ktery bude filtrovat veskere ID vstupy a vystupy
?>
