<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>068.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 068.php -->
<?
  function Hodnota()
  {
    $pokus=100;     // lok�ln� prom�nn�
    echo "Lok�ln�:&nbsp;".$pokus."<br>";
  }

  $pokus=1000000;   // glob�ln� prom�nn�
  Hodnota();
  echo "Glob�ln�:&nbsp;".$pokus;
?>
     </body>
</html>
