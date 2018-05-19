<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Zobrazení všech dat formuláře
    </title>
  </head>

  <body>
    <center>
      <h1>Zobrazení všech dat formuláře</h1>

      Zde jsou data formuláře:
      <br>
      <?
        foreach($_REQUEST as $index => $hodnota){
          if(is_array($hodnota)){
            foreach($hodnota as $polozka){
              echo $index, " => ", $polozka, "<br>";
            }
          }
          else {
            echo $index, " => ", $hodnota, "<br>";
          }
        }
      ?>
      </center>
  </body>
</html>
