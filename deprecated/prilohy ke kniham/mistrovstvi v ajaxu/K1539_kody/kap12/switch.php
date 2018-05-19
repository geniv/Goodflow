<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Použití klíčového slova switch
        </title>
    </head>

    <body>
        <h1>
            Použití klíčového slova switch
        </h1>
        <?
          $teplota = 24;

          switch ($teplota){
            case 24:
              echo "Pěkné počasí.";
              break;
            case 25:
              echo "Pořád je hezky.";
              break;
            case 26:
              echo "Otepluje se.";
              break;
            default:
              echo "Teplota mimo rozsah.";
            }
        ?>
    </body>
</html>
