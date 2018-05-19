<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>041.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 041.php -->
  <?
    $Auta = array("Toyota"=>"Japonsko","Mercedes"=>"Německo","Seat"=>"Španělsko",
            "Audi"=>"Německo","Škoda"=>"Česká republika","Trabant"=>"NDR",
            "Renault"=>"Francie","Volvo"=>"Švédsko");

    echo "<table border=1><tr><th colspan=2>
          Výpis indexů a hodnot asociativního pole \"Auta\"</th></tr>";
    echo "<tr><th>Index</th><th>Hodnota</th></tr>";

    while($polozka = Each($Auta)){
      echo "<tr align=\"center\"><td>";
      echo $polozka["key"]."</td><td>".$polozka["value"]."</td></tr>";
    }
    echo "</table>";
  ?>
     </body>
</html>
