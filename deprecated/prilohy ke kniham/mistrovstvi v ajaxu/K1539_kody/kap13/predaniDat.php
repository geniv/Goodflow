<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Předávání dat funkcím</title>
  </head>

  <body>
    <h1>Předávání dat funkcím</h1>

    <?
      echo "<h3>Vítejte na mé webové stránce!</h3>";
      echo "<br>";
      echo "Jak se vám líbí?";
      echo "<br>";
      echo "<br>";

      $datum = "2007";
      $vlastnik = "Moje firma, s.r.o.";

      autorska_prava($datum, $vlastnik);

      function autorska_prava($prava_datum, $prava_vlastnik)
      {
        echo "<hr>";
        echo "<center>";
        echo "&copy; $prava_datum $prava_vlastnik";
        echo "</center>";
      }
    ?>
  </body>
</html>
