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
    $prvni=2;  // zm�na obsahu prom�nn� $a
  }

  $a=10;
  $b=13;
  Aritm_prumer(&$a,$b);
  echo "Aritmetick� pr�m�r zadan�ch hodnot je $b.";
  echo "<br>Prvn� zm�n�n� prom�nn�: $a";
?>
     </body>
</html>
