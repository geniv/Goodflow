<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Použití klíčového slova elseif
        </title>
    </head>

    <body>
        <h1>
            Použití klíčového slova elseif
        </h1>
        <?
          $teplota = 27;

          if ($teplota < 24){
            echo "Není příliš horko.";
          }
          elseif ($teplota < 27) {
            echo "Pořád to není tak hrozné.";
          }
          elseif ($teplota < 30) {
            echo "Začíná tu být horko.";
          }
          else {
            echo "Je horko.";
          }
        ?>
    </body>
</html>
