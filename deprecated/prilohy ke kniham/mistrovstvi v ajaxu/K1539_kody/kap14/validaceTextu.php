<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Validace textu</title>
  </head>

  <body>
    <center>
      <h1>Validace textu</h1>

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

          if(!preg_match('/ahoj/i', $_REQUEST["text"])){
          $chyby[] = '<font color="red">Zadejte text obsahující řetězec "ahoj"</font>';
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
          echo $_REQUEST["text"];
        }

        function zobraz_uvitani()
        {
          echo '<form method="post" action="validaceTextu.php">';
          echo 'Zadejte prosím text obsahující řetězec "ahoj"';
          echo "<br>";
          echo '<input name="text" type="text">';
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
