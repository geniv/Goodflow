<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>
        Zobrazení prvků pole
      </title>
    </head>

    <body>
      <h1>
        Zobrazení prvků pole
      </h1>

      <?
        $jidla[1] = "kuře";
        $jidla[2] = "krůta";
        $jidla[3] = "brambory";

        $jidla[2] = "vejce";
 
        $jidla[] = "špagety";

        for ($index = 1; $index <= count($jidla); $index++){
          echo $jidla[$index], "<br>";
        }
      ?>
    </body>
</html>
