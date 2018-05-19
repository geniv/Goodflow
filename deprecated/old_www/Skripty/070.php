<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>070.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 070.php -->
<?
  function Hodnota()
  {
    $GLOBALS["pokus"]=100;  // změna hodnoty globální proměnné
  }

  $pokus=1000000;           // globální proměnná
  echo "Původní hodnota proměnné \$pokus=$pokus.<br>";
  Hodnota();
  echo "Globální proměnná:&nbsp;".$pokus;    // vypíše 100
?>
     </body>
</html>
