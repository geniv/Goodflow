<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>009.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 009.php -->
  <?
    $retezec1 = "Mart�nkov 118";
    $retezec2 = "118 Mart�nkov";

    $cislo = 2 + $retezec1;
    echo "V�sledek1: $cislo <br>";  // vyp�e v�sledek 2

    $cislo = 2 + $retezec2;
    echo "V�sledek2: $cislo <br>";  // vyp�e v�sledek 120

    // obsah p�vodn�ch prom�nn�ch z�st�v� nedot�en
    echo "Obsah �et�zce1: $retezec1<br>";  // Mart�nkov 118
    echo "Obsah �et�zce2: $retezec2<br>";  // 118 Mart�nkov

    // vyhodnocen� ��sla
    $cislo = "-3.4e2";
    $cislo = 0 + $cislo;              // ��slo -340
    echo $cislo," ",GetType($cislo);  // typ double
  ?>
     </body>
</html>
