<?php 
  require("libajax.php"); 

  function secti($operand1, $operand2) 
  { 
    print $operand1 + $operand2; 
  } 

  $ajax = new Ajax(); 
  $ajax->mode = "GET"; 
  $ajax->export = array("secti");
  $ajax->client_request(); 
?>

<html> 
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Použití frameworku LibAjax</title> 
    <script> 

      <?php 
        $ajax->output(); 
      ?> 

      function zobraz(vysledek) 
      { 
        document.getElementById("vysledek").value = vysledek; 
      }

      function pouzijLibAjax() 
      {
        var operand1 = document.getElementById("operand1").value; 
        var operand2 = document.getElementById("operand2").value; 
        ajax_secti(operand1, operand2, zobraz);
      }
    </script> 

  </head>

  <body>
    <center>
      <h1>Použití frameworku LibAjax</h1>
      <form>
        <input type="text" name="operand1" id="operand1" value="4" 
          size="5">
        +
        <input type="text" name="operand2" id="operand2" value="5" 
          size="5"> 
        =
        <input type="text" name="vysledek" id="vysledek" value="" size="5">
        <input type="button" value="Sečti" 
          onclick="pouzijLibAjax()">
      </form>
    </center>
  </body>
</html>


