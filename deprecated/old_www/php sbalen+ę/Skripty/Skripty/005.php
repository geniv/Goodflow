<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>005.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
 <!-- 005.php -->
 <?
    echo "(1) Prost� text.<br>";

    echo "(2) Text naform�tovan� pomoc�
          odsazov�n� kl�vesou Enter.<br>";

    echo "(3) Text s v�pisem speci�ln�ch znak� dolaru (\$) a uvozovek (\").<br>";

    $jmeno="Honz�k";
    echo "(4) V�pis prom�nn� \$jmeno s obsahem \"$jmeno\".<br>";

    echo '(5) Jm�no je obsahem prom�nn� $jmeno. <br>';
 ?>
    (6) Jm�no: <?=$jmeno;?>

    <br>(7) <? print "Prost� text."; ?>
     </body>
</html>
