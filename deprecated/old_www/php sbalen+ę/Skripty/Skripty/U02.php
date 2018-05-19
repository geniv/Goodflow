<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U02.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- U02.php -->
<?
  $a = 1; $b = 2; $c = 3; $d = 4; $e = 5;

  echo ($d++ / $b)."\n<br>";
  echo (++$a + $b--)."\n<br>";
  echo ($a % $e)."\n<br>";
  echo ($a %= $b = $c--)."\n<br>";
?>
     </body>
</html>
