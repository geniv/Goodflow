<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Použití konstrukce do...while
        </title>
    </head>

    <body>
        <h1>
            Použití konstrukce do...while
        </h1>
        <?
            $data = 1;

            do {
                echo "data:", $data, "<br>";
                $data += 1;
            } while ($data < 8)
        ?>
    </body>
</html>
