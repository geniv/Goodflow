<?php
	header('Content-type: text/html; charset=UTF-8');
	include_once "funkce.php";	//vložení funkcí
	$obj = new UploadSQLite;	//vytvoření třídy
	$obj->Menu();	//vykreslení menu

?>