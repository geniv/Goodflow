<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>082.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 082.php -->
<h3>Odkazy na související soubory</h3>
<?
  $adresar = Dir("./adr/");      // načtení odkazů ostatních částí
  $poz=0;
  while($polozka=$adresar->Read()):
    $i=StrRPos($polozka,"_");
    if($polozka!="." && $polozka!=".." && $i):
      $cislo[$poz]=SubStr($polozka,$i+1,-4);
      $i=0;
      $poz++;
    endif;
  endwhile;
  if($cislo) Sort($cislo);       // utřídění čísel dle velikosti
  while(List($index,$hodnota)=Each($cislo)):
    echo "<A HREF=\"./adr/php_adr_".$hodnota.".htm\">[".$hodnota."]</A>\n";
  endwhile;
  $adresar->Close();
?>
     </body>
</html>
