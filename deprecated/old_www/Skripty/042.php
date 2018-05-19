<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>042.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 042.php -->
  <?
    $pole = array("Thajsko"=>"Asie","Kanada"=>"Severní Amerika","Norsko"=>"Evropa","Albánie"=>"Evropa");

    echo "<b>Hodnoty prvků pole:</b> ";
    foreach($pole as $hodnota)
      echo "$hodnota ";

    echo "<br><b>Hodnoty prvků pole včetně indexů:</b><br>";
    foreach ($pole as $index => $hodnota)
      echo " <i>Index</i>: $index&nbsp;&nbsp;<i>Hodnota</i>: $hodnota<br>";
  ?>
     </body>
</html>
