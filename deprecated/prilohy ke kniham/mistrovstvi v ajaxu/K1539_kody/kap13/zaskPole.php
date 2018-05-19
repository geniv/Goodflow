<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Použití zaškrtávacích polí
    </title>
  </head>

  <body>
    <center>
      <h1>Použití zaškrtávacích polí</h1>

      Zaškrtnuli jste:
      <?
        if (isset($_REQUEST["pole1"]))
          echo $_REQUEST["pole1"], "<br>";
        if (isset($_REQUEST["pole2"]))
          echo $_REQUEST["pole2"], "<br>";
      ?>
    </center>
  </body>
</html>
