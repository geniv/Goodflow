<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>008.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 008.php -->
  <?
    $cele_cislo = 5;

    // prom�nn� bude celo��seln�ho typu
    $typ = $cele_cislo;
    echo "1) Prom�nn� \$typ je datov�m typem ".GetType($typ);

    // prom�nn� bude re�ln�ho typu, p�vodn� prom�nn� $cele_cislo
    // z�st�v� na celo��seln�m datov�m typu
    $typ2 = (double) $cele_cislo;
    echo "<br>2) Prom�nn� \$typ2 je datov�m typem ".GetType($typ2);

    // prom�nnou $cele_cislo p�etypujeme na typ �et�zec pomoc�
    // funkce SetType()
    SetType($cele_cislo,"string");
    echo "<br>3) Prom�nn� \$cele_cislo je nyn� datov�m typem "
         .GetType($cele_cislo);
  ?>
     </body>
</html>
