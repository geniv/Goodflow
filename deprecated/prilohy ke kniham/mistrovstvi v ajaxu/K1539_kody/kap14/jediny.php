<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>
        Umístění veškerého kódu do jediné stránky
      </title>
    </head>

    <body>
        <center>
          <h1>Umístění veškerého kódu do jediné stránky</h1>
          <?
            if(isset($_REQUEST["jmeno"])){
          ?>
            Vaše jméno je:
          <?
            echo $_REQUEST["jmeno"];
            }
            else {
          ?>
            <form method="post" action="jediny.php">
                Zadejte své jméno:

                <input name="jmeno" type="text">
                <br>
                <br>
                <input type="submit" value="Odeslat">
            </form>
          <?
            }
          ?>
        </center>
    </body>
</html>
