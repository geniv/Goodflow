<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>045.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 045.php -->
  <?
    $pole = array("Cecílie","Agáta","Dana","Bernard");
    Sort($pole);
    echo "<br><b>Třídění prvků pole bez zachování indexů - Sort():</b><br>";
    foreach ($pole as $index => $hodnota)
      echo " <i>Index</i>: $index&nbsp;&nbsp;<i>Hodnota</i>: $hodnota<br>";

    $pole = array("Cecílie","Agáta","Dana","Bernard");
    ASort($pole);
    echo "<br><b>Třídění prvků pole včetně indexů - ASort():</b><br>";
    foreach ($pole as $index => $hodnota)
      echo " <i>Index</i>: $index&nbsp;&nbsp;<i>Hodnota</i>: $hodnota<br>";
  ?>
     </body>
</html>
