<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>015.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 015.php -->
<?
  // vícenásobné přiřazení
  $a=($b=($c=10));
  // výrazy jsou vyhodnocována zprava doleva, proto je možný i zkrácený zápis
  $a=$b=$c=10;

  echo "Hodnota \$a = ".$a;
?>
     </body>
</html>
