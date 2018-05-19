<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Upload souborů</title>
  </head>

  <body>
    <center>
      <h1>Upload souborů</h1>
      <br>

      Obsah souboru je následující:
      <br>
      <br>
      <b>
      <?
        $handle = fopen($_FILES['soubor']['tmp_name'], "r");

        while (!feof($handle)){
          $text = fgets($handle);
          echo $text, "<br>";
        }

        fclose($handle);
      ?>
      </b>
    </center>

  </body>
</html>
