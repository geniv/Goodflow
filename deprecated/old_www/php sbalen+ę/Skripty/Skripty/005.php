<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>005.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
 <!-- 005.php -->
 <?
    echo "(1) Prostý text.<br>";

    echo "(2) Text naformátovaný pomocí
          odsazování klávesou Enter.<br>";

    echo "(3) Text s výpisem speciálních znaků dolaru (\$) a uvozovek (\").<br>";

    $jmeno="Honzík";
    echo "(4) Výpis proměnné \$jmeno s obsahem \"$jmeno\".<br>";

    echo '(5) Jméno je obsahem proměnné $jmeno. <br>';
 ?>
    (6) Jméno: <?=$jmeno;?>

    <br>(7) <? print "Prostý text."; ?>
     </body>
</html>
