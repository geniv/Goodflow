<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Kopírování pole
    </title>
  </head>

  <body>
    <h1>
      Kopírování pole
    </h1>

    <?
      $jidla[1] = "kuře";
      $jidla[2] = "krůta";
      $jidla[3] = "brambory";
      $jidla[2] = "vejce";
      $jidla[] = "špagety";
      $svacina = $jidla;
      echo $svacina[2];
    ?>
  </body>
</html>
