<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Použití cyklu foreach</title>
  </head>

    <body>
        <h1>Použití cyklu foreach</h1>
            <?
                $pole = array("kuře", "krůta", "tuňák", "sýr");

                foreach ($pole as $jidlo) {
                   echo "Aktuální jídlo: $jidlo <br>";
               }
           ?>  
    </body>
</html>
