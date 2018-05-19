<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Použití funkcí</title>
  </head>

  <body>
    <h1>Použití funkcí</h1>

    <?
      echo "<h3>Vítejte na mé webové stránce!</h3>";
      echo "<br>";
      echo "Jak se vám líbí?";
      echo "<br>";
      echo "<br>";

      autorska_prava();

      function autorska_prava()
      {
        echo "<hr>";
        echo "<center>";
        echo "&copy; 2007 Moje firma, s.r.o.";
        echo "</center>";
      }
    ?>
  </body>
</html>
