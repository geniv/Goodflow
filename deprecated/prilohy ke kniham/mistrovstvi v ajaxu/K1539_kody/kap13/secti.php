<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>
      Návratová hodnota funkce
    </title>

  </head>

  <body>
    <h1>Návratová hodnota funkce</h1>
    <?
      echo "secti(3, 2) = ", secti(3, 2), "<br>";

      echo "secti(5, 7) = ", secti(5, 7), "<br>";

      echo "secti(9, 17) = ", secti(9, 17), "<br>";


      function secti($operand_1, $operand_2) 
      {
        return $operand_1 + $operand_2;
      } 
    ?>
  </body>
</html>
