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
    static $citac = 0;  // inicializace prob�hne pouze poprv�
    $citac++;
    echo "Funkce m� $citac. b�h zpracov�n�.<br>";
  }

  Citac();
  Citac();
  Citac();
?>
     </body>
</html>
