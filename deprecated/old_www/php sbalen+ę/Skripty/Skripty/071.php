<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>071.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 071.php -->
<?
  function Citac()
  {
    static $citac = 0;  // inicializace proběhne pouze poprvé
    $citac++;
    echo "Funkce má $citac. běh zpracování.<br>";
  }

  Citac();
  Citac();
  Citac();
?>
     </body>
</html>
