<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Načítání dat formuláře do polí
    </title>
  </head>

  <body>
    <center>
      <h1>Načítání dat formuláře do polí</h1>

      Vaše jméno je:
      <?
        $data = $_REQUEST['data'];
        echo $data['jmeno'], "<br>";
       ?>

       Váš věk je:
       <?
         $data = $_REQUEST['data'];
         echo $data['vek'], "<br>";
       ?>
     </center>

   </body>
</html>
