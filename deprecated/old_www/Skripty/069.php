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
    $pokus=100;     // zm�na hodnoty glob�ln� prom�nn�
    echo "Zm�na p��stupn� glob�ln� prom�nn�: ".$pokus."<br>";
  }

  $pokus=1000000;   // glob�ln� prom�nn�
  echo "P�vodn� hodnota prom�nn� \$pokus=$pokus.<br>";
  Hodnota();
  echo "Glob�ln�:&nbsp;".$pokus;
?>
     </body>
</html>
