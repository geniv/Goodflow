<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Použití seznamu argumentů s variabilní délkou
    </title>

  </head>

  <body>
    <h1>Použití seznamu argumentů s variabilní délkou</h1>
    <?
    echo "spoj(Spojení, řetězců.) =  ", 
      spoj("Spojení", "řetězců."), "<br>";

    echo "spoj(Spojení, několika, řetězců.) =  ", 
      spoj("Spojení", "několika", "řetězců."), "<br>";

    echo "spoj(Spojení, několika, málo, řetězců.) =  ", 
      spoj("Spojení", "několika", "málo", "řetězců."), "<br>";

    function spoj() 
    {
      $retezec = "";
      $seznam_arg = func_get_args();
            
      for ($citac = 0; $citac < func_num_args(); $citac++) {
        $retezec .= $seznam_arg[$citac] . " ";
      }

      echo $retezec;
    } 
    ?>
  </body>
</html>
