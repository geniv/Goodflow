<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>017.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 017.php -->
<?
  $a = 2;
  $b = ++$a;                       // $b = 3, $a = 3
  $c = $b + $a++;                  // $c = 6, $b = 3, $a = 4
  $d = --$a + (++$b) - $c--;       // $d = 1, $a = 3, $b = 4, $c = 5
  echo "Hodnota \$a = $a, \$b = $b, \$c = $c, \$d = $d";
?>
     </body>
</html>
