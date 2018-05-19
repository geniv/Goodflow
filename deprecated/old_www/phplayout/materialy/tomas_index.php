<?php
//require "login.php";
///MAZE CO POTREBUJEME
class delete{
	public function __construct($databaze, $id, $akce, $spravne, $spatne, $obrazek){
	$this->smaz($databaze, $id, $akce, $spravne, $spatne, $obrazek);
	}
	public function smaz($databaze, $id, $akce, $spravne, $spatne, $obrazek){
echo $obrazek;
//MAZE TO CO SI REKNEME
	require "../conf.php";
if($obrazek != "" && $id == "del"){unlink("$obrazek");}
if($akce == "del"){
	$query = "DELETE FROM `$databaze` WHERE (`id`='$id') LIMIT 1";
	$prikaz = $mysqli->query($query);
	if(!$prikaz){echo "<div class=\"spatne\">$spatne</div>";}else{echo "<div class=\"spravne\">$spravne</div>";}
		}

	}
}
//KONEC MAZANI
$web = new delete();


class formularsql{

	public function __construct($table_dot, $a, $id){
	$this->formular($table_dot, $a, $id);
	}

		public function formular($table_dot, $a, $id){

require "../conf.php";
require "upload_image.php";
$table_name = $table_dot; //tabulka ze ktere se bude delat vypis
$sql = $a; // insert nebo update
echo "<form action=\"\" enctype=\"multipart/form-data\" method=\"POST\">";
echo "<table border=\"0\">";
require "../conf.php";

//POKUD JE PROMENA SQL UPDATE AKTIVUJE SE TENTO SCRIPT
if($a == "update"){
$query_up = "Select * From $table_name where id like '{$id}'";
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
}///KONEC UPDATE KOLEKCE


////RESI JENOM KATEGORTII V OPTION je zapotreby mit i hidden polozku o neco dole
function kategorie($tabulka, $name_id){

$smaz = array("_id" => "");
$tabulka = strtr($tabulka, $smaz);

if("$tabulka" != ""){
require "../conf.php";
echo "
<tr>
<td>Kategorie:</td><td><select name=\"$name_id\">";
		$query = "SELECT * From {$tabulka}";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {

$zobraz .= "<option value=\"{$obj->id}\">{$obj->nazev}</option>";

}
echo "{$zobraz}";
echo "</select></td>
</tr>";
}
}///KONEC


//Zjistuje jake jsou sloupce v tabulce vcetne komentaru
$query = "SHOW FULL COLUMNS FROM $table_name";
$prikaz = $mysqli->query($query);
while ($obj = $prikaz->fetch_object()) {

//PODKATEGORIE
if($obj->Comment == "hidden"){
	kategorie($obj->Field, $obj->Field);

	}
	//KONEC PODKATEGORIE

////UPRAVY VESKERE nezadouci znaky na ; a tim pomuze prerozdelit pozadovane klicove slova v explode
$uprava_sql = array("(" => ";",")" => "","','" => ";","'" => "");
$uprava_sql = strtr("$obj->Type", $uprava_sql); //upravi znaky na ;
$uprava_sql = explode(";", $uprava_sql);
////KONEC UPRAVY
$File_up = $obj->Field;

/// DAVA PROMENE SLOUPCU DO INSERTU
//$obj->Comment == "Obrázek:" pokudje podminka splnena nahraje se cesta obrazku
if($obj->Comment != ""){if($obj->Comment == "Obrázek:"){$namefield["insert3"] .= "'{$cesta_upload}{$nazev_obrazku}',"; $namefield["insert"] .= "`{$obj->Field}`,";}else{$namefield["insert3"] .= "'{$_POST["$File_up"]}',"; $namefield["insert"] .= "`{$obj->Field}`,";} }

/// DAVA PROMENE SLOUPCU DO UPDATE
//$obj->Comment == "Obrázek:" pokudje podminka splnena nahraje se cesta obrazku

if($obj->Comment != ""){
if($obj->Field == "obrazek" && $nazev_obrazku == "")
{}
else{

if($obj->Field == "obrazek" && $_POST["$File_up"] == "")
{$namefield["insert2"] .= "`{$obj->Field}`='{$cesta_upload}{$nazev_obrazku}',";}
else
{$namefield["insert2"] .= "`{$obj->Field}`='{$_POST["$File_up"]}',";}

}}




$i = 1 + $i++;

if("enum" != $uprava_sql["0"])
{
//PREVADI KLICOVA SLOVA NA FORMULAR

if($obj->Comment == "Obrázek:"){
	$prevod_formular = array("varchar" => "<input type=\"file\" name=\"obrazek\" width=\"10\" value=\"\" /><input type=\"hidden\" value=\"now\" name=\"upload\" />");
}
elseif($obj->Comment == "hidden"){
//HIDDEN INPUT NENI POTREBA
}
else
{
$prevod_formular = array("varchar" => "<input type=\"text\" name=\"$obj->Field\" maxlength=\"{$uprava_sql["1"]}\" value=\"{$update[$obj->Field]}\" />","int" => "<input type=\"text\" name=\"{$update[$obj->Field]}\" maxlength=\"{$uprava_sql["1"]}\" value=\"{$update[$obj->Field]}\" />",
"datetime" => "<input type=\"text\" name=\"{$update[$obj->Field]}\" maxlength=\"{$uprava_sql["1"]}\" value=\"{$update[$obj->Field]}\" />","text" => "<textarea id=\"elm1v\" name=\"$obj->Field\" rows=\"12\" cols=\"70\">{$update[$obj->Field]}</textarea>");

}

//



$prevod_formular = strtr($uprava_sql["0"], $prevod_formular);


if($obj->Comment == "hidden"){echo "";}
elseif($obj->Comment != ""){echo "<tr>
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


//UPDATE A INSERT
$uprav = array(",)" => ")","', W" => "' W");
if($sql == "insert")
{$muj_prikaz = "INSERT INTO `{$table_name}` ({$namefield["insert"]}) VALUES ({$namefield["insert3"]})"; echo $muj_prikaz = strtr($muj_prikaz, $uprav);}
else{$muj_prikaz = "UPDATE `{$table_name}` SET {$namefield["insert2"]} WHERE (`id`='{$_GET["id"]}') LIMIT 1"; echo $muj_prikaz = strtr($muj_prikaz, $uprav);}

if($_POST[send] == "Odeslat"){$prikaz = $mysqli->query($muj_prikaz);  echo "Požadavek byl vložen do databáze.";}

//END UPDATE A INSERT

//UDELAT AUTOMATICKE SEO
// DODELAT UPDATE PRO UZ HOTOVE OPTION
	}

}

class zeme{

	public function __construct(){
$this->www();
	}
	public function www(){

require "../conf.php";
	echo "<h1>Vytvořte novou zem</h1>";
		$web = new formularsql("gabb_zeme", "{$_GET["a"]}", "{$_GET["id"]}");
		
			echo "<br /><br /><h1>Seznam novinek</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_zeme", $_GET["id"], $_GET["a"], "Země byla smazaná.", "Nastala chyba, země nebyla smazaná.");

		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Název</th><th align=\"center\">Popis</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_zeme";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
  echo"
		<tr>
    <td align=\"center\">$obj->nazev</td><td>$obj->popis</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\">Smazat</a>]</td>
  </tr>";
}echo "</table>";

	}
}

class lokalita{

	public function __construct(){
$this->www();
	}
	public function www(){

		require "../conf.php";
	echo "<h1>Vytvořte novou lokalitu</h1>";
		$web = new formularsql("gabb_lokalita", "{$_GET["a"]}", "{$_GET["id"]}");

			echo "<br /><br /><h1>Seznam lokalit</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_lokalita", $_GET["id"], $_GET["a"], "Lokalita byla smazaná.", "Nastala chyba, lokalita nebyla smazaná.");

		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Název</th><th align=\"center\">Popis</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_lokalita";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
  echo"
		<tr>
    <td align=\"center\">$obj->nazev</td><td>$obj->popis</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>";
}echo "</table>";

	}
}

class oblast{

	public function __construct(){
$this->www();
	}
	public function www(){
		require "../conf.php";
	echo "<h1>Vytvořte novou oblast</h1>";
		$web = new formularsql("gabb_oblast", "{$_GET["a"]}", "{$_GET["id"]}");

			echo "<br /><br /><h1>Seznam oblastí</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_oblast", $_GET["id"], $_GET["a"], "Oblast byla smazaná.", "Nastala chyba, oblast nebyla smazaná.");

		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Název</th><th align=\"center\">Popis</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_oblast";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
  echo"
		<tr>
    <td align=\"center\">$obj->nazev</td><td>$obj->popis</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>";
}echo "</table>";
	}
}

class hotel{

	public function __construct(){
$this->www();
	}
	public function www(){
		
	require "../conf.php";
	echo "<h1>Vytvořte nový hotel nebo residenci</h1>";
		$web = new formularsql("gabb_hotel", "{$_GET["a"]}", "{$_GET["id"]}");

			echo "<br /><br /><h1>Seznam oblastí</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_hotel", $_GET["id"], $_GET["a"], "Hotel nebo residence byla smazaná.", "Nastala chyba, hotel nebo residence nebyla smazaná.");

///ZJISTI ZPETNE OBLAST HOTELU
function oblast($id){
	require "../conf.php";

$query = "SELECT * From gabb_oblast where id like '$id' ";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
		$oblast = $obj->nazev;
		}
		return $oblast;
}
//KONEC ZJISTENI ZPETNE OBLASTI HOTELU

		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Kategorie</th><th align=\"center\">Typ</th><th align=\"center\">Název</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_hotel";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {

$oblast = oblast($obj->gabb_oblast_id);

  echo"
		<tr>
    <td align=\"center\">$oblast</td><td align=\"center\">$obj->typ_dovolene</td><td>$obj->nazev</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>";
}echo "</table>";
	}
}

class personal{

	public function __construct(){
$this->www();
	}
	public function www(){

		require "../conf.php";
	
		echo "<h1>Přidej personál pro hotel nebo residenci</h1>";
	///UDELA FORMULAR CO CHCEME
	$web = new formularsql("gabb_personal", "{$_GET["a"]}", "{$_GET["id"]}");

		echo "<br /><br /><h1>Personál</h1>";

	///MAZE CO POTREBUJEME dokonce maze i obrazek
	
		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								  <th align=\"center\">Jméno</th><th align=\"center\">Přijmení</th><th align=\"center\">Skype</th><th align=\"center\">Mobil</th><th align=\"center\">Telefon</th><th align=\"center\">Fotka</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_personal";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
  echo"		<tr>
    <td align=\"center\">$obj->jmeno</td><td align=\"center\">$obj->prijmeni</td><td align=\"center\">$obj->skype</td><td align=\"center\">$obj->mobil</td><td align=\"center\">$obj->telefon</td><td align=\"center\"><img src=\"../$obj->obrazek\" /></td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>
			";
}echo "</table>";
$web = new delete("gabb_personal", $_GET["id"], $_GET["a"], "Osoba byla smazána i s obrázkem.", "Nastala chyba, osoba nebyla vymazána.");
	}
}

class galerie{

	public function __construct(){
$this->www();
	}
	public function www(){

	}
}

class soutez{

	public function __construct(){
$this->www();
	}
	public function www(){
		require "../conf.php";
		echo "<h1>Soutěž</h1>";
		if($_GET["a"] == "update" && $_GET["id"] == "1"){
		$web = new formularsql("gabb_soutez", "{$_GET["a"]}", "{$_GET["id"]}");
		}

			echo "<br /><br /><h1>Výpis soutěže</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_email_text", $_GET["id"], $_GET["a"], "E-mailová novinka byla smazaná.", "Nastala chyba, e-mailová novinka nebyla smazaná.");

		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Informace</th><th align=\"center\">Otázka</th><th align=\"center\">Odpovědi</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_soutez";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {

  	echo"
		<tr>
    <td align=\"center\" rowspan=\"5\">$obj->nadpis</td>
		</tr>
		<tr>
				<td align=\"center\">$obj->otazka_c1 </td><td>a) $obj->odpoved_c1_a<br /> b) $obj->odpoved_c1_b<br /> c) $obj->odpoved_c1_c</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>]</td>
  </tr>
		<tr>
				<td align=\"center\">$obj->otazka_c2 </td><td>a) $obj->odpoved_c2_a<br /> b) $obj->odpoved_c2_b<br /> c) $obj->odpoved_c2_c</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>]</td>
  </tr>
		<tr>
    <td align=\"center\">$obj->otazka_c3 </td><td>a) $obj->odpoved_c3_a<br /> b) $obj->odpoved_c3_b<br /> c) $obj->odpoved_c3_c</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>]</td>
  </tr>
		<tr>
    <td align=\"center\">$obj->otazka_c4 </td><td>a) $obj->odpoved_c4_a<br /> b) $obj->odpoved_c4_b<br /> c) $obj->odpoved_c4_c</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>]</td>
  </tr>
			";

	}echo "</table>";


	}
}

class zasilani_novinek{

	public function __construct(){
$this->www();
	}
	public function www(){

	require "../conf.php";
	echo "<h1>Vytvořit e-mail novinku</h1>";
		$web = new formularsql("gabb_email_text", "{$_GET["a"]}", "{$_GET["id"]}");


			echo "<br /><br /><h1>Seznam novinek</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_email_text", $_GET["id"], $_GET["a"], "E-mailová novinka byla smazaná.", "Nastala chyba, e-mailová novinka nebyla smazaná.");

		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Datum</td><th align=\"center\">Předmět</td><th align=\"center\">Text</td><th align=\"center\">Akce</td>
								</tr>";
		$query = "SELECT * From gabb_email_text";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
  echo"
		<tr>
    <td align=\"center\">$obj->datum</td><td align=\"center\">$obj->predmet</td><td>$obj->text</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>";
}echo "</table>";
	}
}


class pridej_email{

	public function __construct(){
$this->www();
	}
	public function www(){

	require "../conf.php";
	echo "<h1>Přidej e-mail</h1>";
	///UDELA FORMULAR CO CHCEME
		$web = new formularsql("gabb_email", "{$_GET["a"]}", "{$_GET["id"]}");

		echo "<br /><br /><h1>Příjemci</h1>";

	///MAZE CO POTREBUJEME
	$web = new delete("gabb_email", $_GET["id"], $_GET["a"], "E-mail byl vymazán.", "Nastala chyba, e-mail nebyl vymazán.");

		echo "<table width=\"400\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">E-mail</td><th align=\"center\">Akce</td>
								</tr>";
		$query = "SELECT * From gabb_email";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
			$email_id = $obj->id;
  echo"
		<tr>
    <td><a href=\"mailto:$obj->email\">$obj->email</a></td><td align=\"center\"><a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a></td>
  </tr>";
}echo "</table>";


	}
}


class kurz{

	public function __construct(){
$this->www();
	}
	public function www(){
		
	require "../conf.php";
	echo "<h1>Kurz</h1>";
	///UDELA FORMULAR CO CHCEME
		$web = new formularsql("gabb_kurzmen", "{$_GET["a"]}", "{$_GET["id"]}");

		echo "<br /><br /><h1>Seznam měn a kurzů</h1>";

	///MAZE CO POTREBUJEME

		echo "<table width=\"400\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Měna</th><th align=\"center\">Kurz</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_kurzmen";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
			$email_id = $obj->id;
  echo"
		<tr>
    <td align=\"center\">$obj->mena</td><td align=\"center\">$obj->kurz</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Upravit</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>";
}echo "</table>";

	}
}


class objednavky{

	public function __construct(){
$this->www();
	}
	public function www(){

			require "../conf.php";
	echo "<h1>Objednavka</h1>";
	///UDELA FORMULAR CO CHCEME
		if($_GET["a"] == "update"){$web = new formularsql("gabb_objednavky", "{$_GET["a"]}", "{$_GET["id"]}");}

		echo "<br /><br /><h1>Seznam objednávek</h1>";

	///MAZE CO POTREBUJEME


///ZJISTI ZPETNE OBLAST HOTELU
function oblast($id){
	require "../conf.php";

$query = "SELECT * From gabb_hotel where id like '$id' ";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
		$oblast = $obj->nazev;
		}
		return $oblast;
}
//KONEC ZJISTENI ZPETNE OBLASTI HOTELU


		echo "<table width=\"800\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
								<tr>
								 <th align=\"center\">Hotel - Residence</th><th align=\"center\">Jméno</th><th align=\"center\">Příjmení</th><th align=\"center\">Narození</th><th align=\"center\">Ulice</th><th align=\"center\">Město</th><th align=\"center\">Telefon</th><th align=\"center\">E-mail</th><th align=\"center\">Akce</th>
								</tr>";
		$query = "SELECT * From gabb_objednavky";
		$prikaz = $mysqli->query($query);
		$pocet = mysqli_num_rows($result);
		while ($obj = $prikaz->fetch_object()) {
			$kategorie = oblast($obj->gabb_hotel_id);
  echo"
		<tr>
    <td align=\"center\">$kategorie</td><td align=\"center\">$obj->jmeno</td><td align=\"center\">$obj->prijmeni</td><td align=\"center\">$obj->datum_narozeni</td><td align=\"center\">$obj->ulice</td><td align=\"center\">$obj->mesto</td><td align=\"center\">$obj->telefon</td><td align=\"center\">$obj->email</td><td align=\"center\">[<a href=\"?html=$_GET[html]&a=update&id=$obj->id\">Zobraz</a>][<a href=\"?html=$_GET[html]&a=del&id=$obj->id\" onclick=\"return confirm('Opravdu chcete smazat tuto položku ?');\">Smazat</a>]</td>
  </tr>";
}echo "</table>";

	}
}


class kontakt{

	public function __construct(){
$this->www();
	}
	public function www(){

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles/admin.css" />
<title>ADMINISTRACE - GABBIANO</title>
<script type="text/javascript" src="../modules/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		theme_advanced_buttons1 : "mybutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
		theme_advanced_buttons1 : "mybutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
		theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false
	});
</script>
</head>

<body>



<div class="admin">
<div class="menu">

</div>

<div class="main">
<div class="menu2">
<h2><img src="images/h1.gif" vspace="0" hspace="5" border="0" alt=\"\" />Přidej sekci</h2><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=zeme">Země</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=lokalita">Lokalita</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=oblast">Oblast</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=hotel">Hotel</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=personal">Personal</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=galerie">Galerie</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=soutez">Soutěž</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=zasilani-novinek">Vytvoř e-mail novinku</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=pridej-email">Přidej e-mail</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=kurz">Kurz</a><br />
<img src="images/page.gif" vspace="0" hspace="5" alt=\"\" /><a href="?html=objednavky">Objednávky</a><br />
</div>

	
<div class="text">
<?php

switch ("$_GET[html]") {
				case "zeme":
        $web = new zeme();
        break;
				case "lokalita":
        $web = new lokalita();
        break;
				case "oblast":
        $web = new oblast();
        break;
				case "hotel":
        $web = new hotel();
        break;
				case "personal":
        $web = new personal();
        break;
				case "soutez":
        $web = new soutez();
        break;
				case "zasilani-novinek":
        $web = new zasilani_novinek();
        break;
				case "pridej-email":
        $web = new pridej_email();
        break;
				case "kurz":
        $web = new kurz();
        break;
				case "objednavky":
        $web = new objednavky();
        break;


}
//UDELAT v option aby se vepsal selected pri update
//UDELAT modul kdy se bude kontrolovat co je nahrane v DB za obrazky a co ve filesystemu a podle toho mazat :)
?>
</div>


</div>

<div class="spodek">Informace, technická podpora: <a href="mailto:info@graweb.com">info@graweb.com</a> | Administrace: <a href="http://www.graweb.cz">GRAWEB</a></div>
</div>



</body></html>
