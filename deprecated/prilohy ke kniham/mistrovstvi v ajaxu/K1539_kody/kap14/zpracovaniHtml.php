<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2"/>
    <title>Zpracování HTML</title>
  </head>

  <body>
    <center>
      <h1>Zpracování HTML</h1>
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
          
          if($_REQUEST["komentar"] == "") {
            $chyby[] = '<font color="red">Zadejte komentář</font>';
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
          $text = htmlspecialchars($_REQUEST["komentar"]);
          echo $text;
        }

        function zobraz_uvitani()
        {
          echo '<form method="post" action="zpracovaniHtml.php">';
          echo "Zadejte svůj komentář<br>";
          echo '<input name="komentar" type="text">';
          echo "<br><br>";
          echo '<input type="submit" value="Odeslat">';
          echo '<input type="hidden" name="zobrazeno" value="data">';
          echo "</form>";
        }
      ?>
     </center>
   </body>
</html>
