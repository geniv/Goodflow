<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Použití výběrových polí
    </title>
  </head>

  <body>
    <center>
      <h1>Použití výběrových polí</h1>

      Vybrali jste:
      <?
        if (isset($_REQUEST["pole1"]))
          echo $_REQUEST["pole1"], "<br>";
      ?>
    </center>
  </body>
</html>
