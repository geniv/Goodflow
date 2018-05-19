<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Použití klíčového slova if
        </title>
    </head>

    <body>
        <h1>
            Použití klíčového slova if
        </h1>
        <?
          $teplota = 26;

          if ($teplota < 24){
            echo "Není příliš horko.";
          }
          else {
            echo "Je horko.";
          }
        ?>
    </body>
</html>
