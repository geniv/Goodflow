<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>015.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 015.php -->
<?
  // v�cen�sobn� p�i�azen�
  $a=($b=($c=10));
  // v�razy jsou vyhodnocov�na zprava doleva, proto je mo�n� i zkr�cen� z�pis
  $a=$b=$c=10;

  echo "Hodnota \$a = ".$a;
?>
     </body>
</html>
