<?php
  //stazeni souboru
  $down = $_GET["down"];
  if (!Empty($down))
  {
    header("Content-Description: File Transfer");
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=\"{$down}\"");
    readfile($down); //vybydne ke stazeni
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>Experiment</title>
  </head>
  <body bgcolor="#FFFFFF">
  <div align="center">
  <a href="http://www.mira.7u.cz/"><img src="http://www.mira.7u.cz/motiv.jpg" aling="center" alt="" border="0"></a>
  <br clear="all">
  <table style="text-align: center; vertical-align: top; width: 800px;" border="0">
  <tr>
<td style="text-align: center; vertical-align: top; color: green;">
<? include "menu.php"; ?>
 </td>
<td style="height: 600px; width: 530px; text-align: left; vertical-align: top;">
<? include "vypis.php"; ?>
</td></tr>
</table>
<table style="text-align: center; vertical-align: top; width: 800px;" border="0">
<tr><td>
</td><tr>
<div align="center">
<? include "pata.php"; ?>
</div>

