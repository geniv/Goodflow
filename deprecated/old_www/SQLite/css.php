<?php
	include "funkce.php";
	$databaze = "styles_css.db";	//název databáze
	$db = new SQLiteDatabase($databaze);	//objektové připojení k databázi
	$Tdb = new SQLite;	//vytvoření třídy
	$Tdb->StartCas();
	$Tdb->CSS();	//volba dokumentu
	$Tdb->RozdelNazev();
	$Tdb->Instalace($db, $databaze); //kontrola existence databáze a její instalace
	$Tdb->Menu();	//výpis menu
	$Tdb->Sekce($db);	//výpis sekce
?>
