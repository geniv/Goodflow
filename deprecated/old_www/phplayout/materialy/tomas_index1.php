<?php
//Základní hlavicka wikmebovek
require "conf.php";

$web = new celej_web;

class celej_web{

public function __construct(){

$this->seo_web();
$this->tvorba_menu("1");
$this->logo();
$this->tvorba_menu("2");
$this->tvorba_menu("3");
$this->main();
$this->spodek();

}

/////////HLAVICKA AZ PO ZACATEK BODY  $logo_n je tam proto ze u loga je nadpis H1
public function seo_web($logo_n){
if("$_GET[kategorie]" != "" and "$_GET[clanek]" != ""){$clanek_kategorie = "clanky";}else{$clanek_kategorie = "kategorie";}
/////SEO URL udavaj SEO informace
require "conf.php";
$query = "SELECT * FROM myrs_{$clanek_kategorie} where seo_url like '$_GET[kategorie]'";
$prikaz = $mysqli->query($query); 
while ($obj = $prikaz->fetch_object()) {

include "templates/index.php";

}
if("$logo_n" == "logo"){echo "$logo";}else{echo "$hlavicka";}
$prikaz->close();
}
/////////END HLAVICKA AZ PO ZACATEK BODY


///DELA MENU 1,2,3
public function tvorba_menu($cislo_menu){
//vytváří menu

require "conf.php";
$query = "SELECT * FROM myrs_kategorie where menu like '$cislo_menu'";
$prikaz = $mysqli->query($query); 
while ($obj = $prikaz->fetch_object()) {

include "templates/index.php";

}
echo "$menu[$cislo_menu]";
$prikaz->close();
/////////////////end MENU
}


/////////SEO PRO NADPIS U LOGA
public function logo(){

$this->seo_web("logo");

}
/////////SEO PRO NADPIS U LOGA


/////////MAIN
public function main(){

require "conf.php";

$query = "SELECT * FROM myrs_clanky where kategorie like '$_GET[kategorie]'";
$prikaz = $mysqli->query($query);
$pocet = mysqli_num_rows($result);
while ($obj = $prikaz->fetch_object()) {
$pocet_i = $pocet_i + 0 + 1;

include "templates/index.php";

}
echo "$main";

}
/////////KONEC MAIN


/////////SPODEK
public function spodek(){


include "templates/index.php";
echo "$spodek";

}
/////////KONEC SPODEK

}


?>