<?
  require("Sajax.php");
	
  function secti($operand1, $operand2) 
  {
    return $operand1 + $operand2;
  }
	
  sajax_init();
  sajax_export("secti");
  sajax_handle_client_request();
	
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Použití frameworku Sajax</title>
    <script>
      <?
        sajax_show_javascript();
      ?>
	
      function zobrazVysledek(vysledek) 
      {
        document.getElementById("vysledek").value = vysledek;
      }
	
      function provedSoucet() 
      {
        var operand1, operand2;
	
        operand1 = document.getElementById("operand1").value;
        operand2 = document.getElementById("operand2").value;
        x_secti(operand1, operand2, zobrazVysledek);
      }
    </script>
	
  </head>

  <body>
    <center>
      <h1>Použití frameworku Sajax</h1>  
      <input type="text" name="operand1" id="operand1" value="4" size="3">
	    +
      <input type="text" name="operand2" id="operand2" value="5" size="3">
      =
      <input type="text" name="vysledek" id="vysledek" value="" size="3">
      <input type="button" value="Sečti"
        onclick="provedSoucet(); return false;">
    </center>
  </body>
</html>
