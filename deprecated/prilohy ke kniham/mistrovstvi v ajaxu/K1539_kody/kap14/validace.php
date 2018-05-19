<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Validace uživatelského vstupu
    </title>
  </head>

  <body>
    <center>

      <h1>Validace uživatelského vstupu</h1>
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

          if($_REQUEST["jmeno"] == "") {
            $chyby[] = '<font color="red">Zadejte jméno</font>';
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
          echo "Vaše jméno je: ";
          echo $_REQUEST["jmeno"];
        }

        function zobraz_uvitani()
        {
           echo '<form method="post" action="validace.php">';
           echo "Zadejte prosím své jméno:";
           echo "<br>";
           echo '<input name="jmeno" type="text">';
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
