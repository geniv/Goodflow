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
  if($a>0 && $a<100)     // v�sledek true
    echo "Prom�nn� z intervalu (0;100).";
  if($a>0 || $b>0)       // v�sledek true
    echo "<br>Ob� prom�nn� jsou kladn�.";
  if(($a>0 && $b>0) xor (!$a))       // v�sledek true
    echo "<br>Ob� prom�nn� \$a a \$b jsou kladn� nebo \$a je nula.";

  $b=0;
  if($b!=0 && $a/$b)     // v�sledek false
    echo "<br>Prob�hlo d�len�";
  else
    echo "<br>Nemus�te se b�t, d�len� nulou je hl�d�no.";
?>
     </body>
</html>
