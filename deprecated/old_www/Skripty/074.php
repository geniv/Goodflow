<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>074.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 074.php -->
<?
  function Aritm_prumer($prvni,&$druha)
  {
    $druha = ($prvni+$druha)/2;
    $prvni=2;  // změna obsahu proměnné $a
  }

  $a=10;
  $b=13;
  Aritm_prumer(&$a,$b);
  echo "Aritmetický průměr zadaných hodnot je $b.";
  echo "<br>První změněná proměnná: $a";
?>
     </body>
</html>
