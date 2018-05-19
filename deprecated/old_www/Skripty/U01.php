<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U01.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- U01.php -->
<?
  $Datum = Date("d.m.Y");
  echo "Obsah proměnné \$Datum je $Datum a \n<br>
        proměnná je datového typu ".GetType($Datum).".";
?>
     </body>
</html>
