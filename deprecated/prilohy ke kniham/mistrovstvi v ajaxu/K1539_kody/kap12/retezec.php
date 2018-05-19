<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2"/>
        <title>
            Použití řetězců
        </title>
    </head>

    <body>
        <h1>
            Použití řetězců
        </h1>

        <?
          echo trim(" Mám rád PHP."), "<br>";

          echo substr("Mám rád PHP.", 8, 3), "<br>";

          echo "Podřetězec 'PHP' začíná na pozici ", strpos("Mám rád PHP.", "PHP"), "<br>";

          echo "Řetězec 'Mám rád PHP.' má délku ", strlen("Mám rád PHP."), " znaků.<br>";

          echo substr_replace("Mám rád PHP.", "používat", 4, 3), "<br>";

          echo strtoupper("Mám rád PHP."), "<br>";
        ?>

    </body>

</html>
