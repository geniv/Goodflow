<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Interpolace proměnných v PHP
        </title>
    </head>

    <body>
        <h1>
            Interpolace proměnných v PHP
        </h1>

        <?
            echo "Nastavuji počet jídel na 2.<br>";
            
            $jidla = 2;

            echo "Počet jídel: $jidla<br>";

            echo "Přidávám 2 další jídla.<br>";

            $jidla = $jidla + 2;

            echo "Počet jídel: $jidla<br>";
        ?>

    </body>

</html>
