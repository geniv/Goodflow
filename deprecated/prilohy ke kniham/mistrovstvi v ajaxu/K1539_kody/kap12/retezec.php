<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2"/>
        <title>
            Pou�it� �et�zc�
        </title>
    </head>

    <body>
        <h1>
            Pou�it� �et�zc�
        </h1>

        <?
          echo trim(" M�m r�d PHP."), "<br>";

          echo substr("M�m r�d PHP.", 8, 3), "<br>";

          echo "Pod�et�zec 'PHP' za��n� na pozici ", strpos("M�m r�d PHP.", "PHP"), "<br>";

          echo "�et�zec 'M�m r�d PHP.' m� d�lku ", strlen("M�m r�d PHP."), " znak�.<br>";

          echo substr_replace("M�m r�d PHP.", "pou��vat", 4, 3), "<br>";

          echo strtoupper("M�m r�d PHP."), "<br>";
        ?>

    </body>

</html>
