<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>035.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont size=4>
     </head>
     <body>
  <!-- 035.php -->
  <div align="center">
  <b>Velká násobilka</b><br><br>
  <?
    // odsazení horního záhlaví s barvou pozadí
    echo "<font color=\"white\">xxxxx</font>";
    for($i=11;$i<21;$i++){    // horní záhlaví
      echo "<font color=\"red\">".$i."</font>&nbsp;&nbsp;&nbsp;";
    }
    echo "<br>";
    for($i=11;$i<21;$i++){
      echo "<font color=\"red\">".$i."</font> ";
      for($j=11;$j<21;$j++){
        echo $i*$j." ";    // řádky
      }
      echo "<br>";
    }
  ?>
  </div>
     </body>
</html>
