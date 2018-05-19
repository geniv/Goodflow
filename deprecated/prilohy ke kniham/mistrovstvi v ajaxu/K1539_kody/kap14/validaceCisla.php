<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Validace čísel</title>
  </head>

  <body>
    <center>

      <h1>Validace čísel</h1>

      <?
        $chyby = array();
        if(isset($_REQUEST["zobrazeno"])){
          over_data();

          if(count($chyby) != 0){
            zobraz_chyby();
            zobraz_uvitani();
          } 
          else {
            zpracuj_data();
          }
        } 
        else {
         zobraz_uvitani();
        }

        function over_data()
        {
          global $chyby;
          
          if(strcmp($_REQUEST["cislo"], 
            strval(intval($_REQUEST["cislo"])))) {
            $chyby[] = '<font color="red">Zadejte celé číslo</font>';
          }
        }

        function zobraz_chyby()
        {
          global $chyby;

          foreach ($chyby as $chyba){
            echo $chyba, "<br>";
          }
        }

        function zpracuj_data()
        {
          echo "Zadali jste: ";
          echo $_REQUEST["cislo"];
        }

        function zobraz_uvitani()
        {
          echo '<form method="post" action="validaceCisla.php">';
          echo "Zadejte prosím celé číslo.";
          echo "<br>";
          echo '<input name="cislo" type="text">';
          echo "<br>";
          echo "<br>";
          echo '<input type="submit" value="Odeslat">';
          echo '<input type="hidden" name="zobrazeno" value="data">';
          echo "</form>";
        }
      ?>
    </center>
  </body>
</html>
