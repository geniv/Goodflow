<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>020.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 020.php -->
<?
  $a=1; $b=2;
  if($a>0 && $a<100)     // výsledek true
    echo "Proměnná z intervalu (0;100).";
  if($a>0 || $b>0)       // výsledek true
    echo "<br>Obě proměnné jsou kladné.";
  if(($a>0 && $b>0) xor (!$a))       // výsledek true
    echo "<br>Obě proměnné \$a a \$b jsou kladné nebo \$a je nula.";

  $b=0;
  if($b!=0 && $a/$b)     // výsledek false
    echo "<br>Proběhlo dělení";
  else
    echo "<br>Nemusíte se bát, dělení nulou je hlídáno.";
?>
     </body>
</html>
