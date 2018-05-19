<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Více návratových hodnot funkce
    </title>
  </head>

  <body>
    <h1>
      Více návratových hodnot funkce
    </h1>

    <?
            
      list($prvni, $druha, $treti, $ctvrta, $pata, 
        $sesta) = vrat();

      echo "\$prvni: $prvni<br>";
      echo "\$druha: $druha<br>";
      echo "\$treti: $treti<br>";
      echo "\$ctvrta: $ctvrta<br>";
      echo "\$pata: $pata<br>";
      echo "\$sesta: $sesta<br>";
    
      function vrat()
      {
        $pole = array("Červená", "Zelená", "Žlutá", "Modrá", 
          "Oranžová", "Fialová");

        return $pole;
      }
    ?> 
  </body>
</html>
