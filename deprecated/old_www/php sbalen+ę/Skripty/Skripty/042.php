<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>042.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 042.php -->
  <?
    $pole = array("Thajsko"=>"Asie","Kanada"=>"Severn� Amerika","Norsko"=>"Evropa","Alb�nie"=>"Evropa");

    echo "<b>Hodnoty prvk� pole:</b> ";
    foreach($pole as $hodnota)
      echo "$hodnota ";

    echo "<br><b>Hodnoty prvk� pole v�etn� index�:</b><br>";
    foreach ($pole as $index => $hodnota)
      echo " <i>Index</i>: $index&nbsp;&nbsp;<i>Hodnota</i>: $hodnota<br>";
  ?>
     </body>
</html>
