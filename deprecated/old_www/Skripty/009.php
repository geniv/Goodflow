<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>009.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 009.php -->
  <?
    $retezec1 = "Martínkov 118";
    $retezec2 = "118 Martínkov";

    $cislo = 2 + $retezec1;
    echo "Výsledek1: $cislo <br>";  // vypíše výsledek 2

    $cislo = 2 + $retezec2;
    echo "Výsledek2: $cislo <br>";  // vypíše výsledek 120

    // obsah původních proměnných zůstává nedotčen
    echo "Obsah řetězce1: $retezec1<br>";  // Martínkov 118
    echo "Obsah řetězce2: $retezec2<br>";  // 118 Martínkov

    // vyhodnocení čísla
    $cislo = "-3.4e2";
    $cislo = 0 + $cislo;              // číslo -340
    echo $cislo," ",GetType($cislo);  // typ double
  ?>
     </body>
</html>
