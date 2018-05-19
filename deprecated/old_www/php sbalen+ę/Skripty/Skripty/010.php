
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>010.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 010.php -->
  <?
    $real_1 = 0.3;
    $real_2 = 0.4;

    echo "Mělo by být 0.7 - 0.3 - 0.4 = 0 <br>";
    echo "Ale tady je 0.7 - 0.3 - 0.4 =". (0.7 - $real_1 - $real_2);
  ?>
     </body>
</html>
