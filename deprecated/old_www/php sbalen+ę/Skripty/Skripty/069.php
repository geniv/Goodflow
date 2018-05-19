<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>069.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 069.php -->
<?
  function Hodnota()
  {
    global $pokus;
    $pokus=100;     // změna hodnoty globální proměnné
    echo "Změna přístupné globální proměnné: ".$pokus."<br>";
  }

  $pokus=1000000;   // globální proměnné
  echo "Původní hodnota proměnné \$pokus=$pokus.<br>";
  Hodnota();
  echo "Globální:&nbsp;".$pokus;
?>
     </body>
</html>
