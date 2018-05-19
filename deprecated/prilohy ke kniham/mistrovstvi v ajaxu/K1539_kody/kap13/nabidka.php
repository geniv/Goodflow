<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Použití nabídek</title>
  </head>

  <body>
    <center>
      <h1>Použití nabídek</h1>
        Vybrali jste:
        <br>
        <?
          foreach($_REQUEST["jidla"] as $jidlo){
            echo $jidlo, "<br>";
          }
        ?>
      </center>
  </body>
</html>
