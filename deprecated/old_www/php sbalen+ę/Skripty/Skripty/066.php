<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>066.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 066.php -->
<?
  function Seznam($pole)
  {
    echo "<table border=1><tr><th>";
    echo "Seznam</th><tr>\n";
    reset($pole);             // ukazatel na za��tek pole
    $radek=current($pole);
    while($radek){
      echo "<tr><td>$radek</td></tr>\n";
      $radek=next($pole);     // na�ten� dal��ho prvku pole
    }
    echo "</table>";
  }
?>
<?
  $pole=array("Josef Nov�k","Martin Dole�al",
              "Aneta Svi�n�","Rostislav Hulv�t");
  Seznam($pole);
?>
     </body>
</html>
