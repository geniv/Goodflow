<?php 
  $handle = fopen("http://www.google.com/complete/search?hl=en&js=true&qu=" . $_GET["qu"], "r"); 
  while (!feof($handle)){
    $obsah = fgets($handle);
    echo $obsah;
  }
  fclose($handle);
?>
