<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>047.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 047.php -->
  <?
    $Auta = array("Osobn�"=>array("�koda","Renault","Audi"),
                  "N�kladn�"=>array("Liaz","Tatra"));

    echo "<b>Dvojrozm�rn� pole</b><br>";
    foreach ($Auta as $index => $hodnota){  // $hodnota je op�t pole
      echo " <b>$index</b><br>";
      foreach ($hodnota as $index => $hodnota2)     // 2. rozm�r
        echo "<i>&nbsp;&nbsp;&nbsp;Hodnota</i>: $hodnota2<br>";
    }
  ?>
     </body>
</html>
