<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta name="Author" content="Experiment DataDisk, (c) 2009 Lkez, lkez.7u.cz" />
  <meta name="Copyright" content="Copyright" />
  <meta name="Keywords" content="DataDisk,Experiment,upload," />
  <meta name="Robots" content="index, follow" />
  <meta name="Description" content="Experiment�ln� str�nka pro v�voj speci�ln�ho redak�n�ho syst�mu." />
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title>Experiment</title>
  </head>
  <body bgcolor="#FFFFFF">
  <div align="center">
  <a href="index.php"><img src="image/motiv.jpg" aling="center" alt="uvod" border="0"></a>
  <br clear="all">
  <table style="text-align: center; width: 800px;" border="0">
  <div>
  <tr><td style="text-align: left; vertical-align: middle; color: black; height: 50px; width: 250px;"><? include "menu.php"; ?></td>
  <td style="text-align: center; vertical-align: middle; color: green;"><h4>M�sto pro ulo�en� soubor� do 10MB <h4></td></tr>
  <tr><td></td><td style="height: 75px; width: 530px; text-align: center; vertical-align: top;">
    <title>Upload soubor�</title>
  </head>
  <body>
    <form action="#" method="post" enctype="multipart/form-data">
      <input type="file" name="fupload">
      <input type="submit" value="Nahr�t">
    </form>
<?php
if (isset($_FILES['fupload']))
  {
    if($_FILES['fupload']['type']=="application/octet-stream"){
    echo "Soubory s p��ponou PHP jsou zak�z�ny!";
    }else{
    $slozka = "upload/";
    $cil = $slozka . "/" .$_FILES['fupload']['name'];
    $nazev_souboru = $_FILES['fupload']['tmp_name'];
    $copy = move_uploaded_file($nazev_souboru, $cil)
      or die ("P�enesen� soubor nelze zkop�rovat");
    chmod ($cil, 0644);
    if($copy == true){
      echo "Soubor " .$_FILES['fupload']['name']. " byl �sp�n� nahr�n na server.\n<br><a href=\"$cil\">Zobrazit soubor</a>";
    }else{
      echo "Soubor nemohl b�t nahr�n.\nPo�et chyb: " . $_FILES['fupload']['error'];
    }
    }
  }
?>

</td></tr>
<tr><td></td><td style="height: 75px; width: 530px; text-align: center; vertical-align: middle;"></td></tr>
<tr><td style="text-align: left;">
<br>
<a href="http://www.pspad.com/" title="PSPad.com - freeware text editor">
<img src="http://www.pspad.com/banners/pspad_90x32.png" border="0" alt="pspad" title="PSPad.com - freeware text editor" /></a>
<br>
<a href="http://www.exda.7u.cz/" title="Redak�n� system pro ukl�d�n� a stahov�n� soubor� na server Va�eho hostingu.">
<img src="http://exda.7u.cz/image/banner_green.png" border="0" alt="banner exda.7u.cz" /></a>
<br>
<!-- ---- ABZ rychle pocitadlo ---- -->
<a href="http://pocitadlo.abz.cz/" title="po��tadlo p��stup�: pocitadlo.abz.cz">
<img src="http://pocitadlo.abz.cz/aip.php?tp=di" alt="po��tadlo.abz.cz" border="0" /></a>
<!-- ---- http://pocitadlo.abz.cz/ ---- -->
</td><td style="height: 30px; width: 530px; text-align: center; vertical-align: middle;"></td></tr>
</table>
</div>
<div align="center">
<? include "pata.php"; ?>
</div>


