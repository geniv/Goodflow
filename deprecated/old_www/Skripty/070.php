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
    $GLOBALS["pokus"]=100;  // zm�na hodnoty glob�ln� prom�nn�
  }

  $pokus=1000000;           // glob�ln� prom�nn�
  echo "P�vodn� hodnota prom�nn� \$pokus=$pokus.<br>";
  Hodnota();
  echo "Glob�ln� prom�nn�:&nbsp;".$pokus;    // vyp�e 100
?>
     </body>
</html>
