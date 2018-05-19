<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>018.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 018.php -->
<?
  $a==9;                        // chybné přiřazení
  echo "Hodnota: $a<br>";
  if($a==9)                     // správné porovnání
    echo "Správně nastavená hodnota.";
  else
    echo "Chybně nastavená hodnota.";
?>
     </body>
</html>
