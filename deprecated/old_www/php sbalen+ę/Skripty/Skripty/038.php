<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>038.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 038.php -->
  <?
    $Pokus[0] = 1;
    $Pokus[1] = "Petr";
    $Pokus[2] = "725830/4460";

    echo "<b>Prvky pole:&nbsp;</b>";
    for($i=0;$i<3;$i++){     // výpis prvků pole
      if($i>0) echo ", ";
      echo $Pokus[$i];
    }
  ?>
     </body>
</html>
