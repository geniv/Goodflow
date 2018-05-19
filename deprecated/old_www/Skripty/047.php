<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>047.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 047.php -->
  <?
    $Auta = array("Osobní"=>array("Škoda","Renault","Audi"),
                  "Nákladní"=>array("Liaz","Tatra"));

    echo "<b>Dvojrozměrné pole</b><br>";
    foreach ($Auta as $index => $hodnota){  // $hodnota je opět pole
      echo " <b>$index</b><br>";
      foreach ($hodnota as $index => $hodnota2)     // 2. rozměr
        echo "<i>&nbsp;&nbsp;&nbsp;Hodnota</i>: $hodnota2<br>";
    }
  ?>
     </body>
</html>
