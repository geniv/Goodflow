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
    $pokus=100;     // lokální proměnná
    echo "Lokální:&nbsp;".$pokus."<br>";
  }

  $pokus=1000000;   // globální proměnné
  Hodnota();
  echo "Globální:&nbsp;".$pokus;
?>
     </body>
</html>
