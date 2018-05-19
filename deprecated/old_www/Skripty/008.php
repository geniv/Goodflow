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

    // proměnná bude celočíselného typu
    $typ = $cele_cislo;
    echo "1) Proměnná \$typ je datovým typem ".GetType($typ);

    // proměnná bude reálného typu, původní proměnná $cele_cislo
    // zůstává na celočíselném datovém typu
    $typ2 = (double) $cele_cislo;
    echo "<br>2) Proměnná \$typ2 je datovým typem ".GetType($typ2);

    // proměnnou $cele_cislo přetypujeme na typ řetězec pomocí
    // funkce SetType()
    SetType($cele_cislo,"string");
    echo "<br>3) Proměnná \$cele_cislo je nyní datovým typem "
         .GetType($cele_cislo);
  ?>
     </body>
</html>
