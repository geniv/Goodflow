<?php
  require("xajax.inc.php");

  function secti($operand1, $operand2)
  {
    $odpoved = new xajaxResponse();
    $odpoved->addAssign("vysledek", "value", $operand1 + $operand2);
    return $odpoved->getXML();
  }

  $xajax = new xajax();
  $xajax->registerFunction("secti");
  $xajax->processRequests();

?>
<html> 
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Použití frameworku Xajax</title> 
    <?php 
      $xajax->printJavascript(); 
    ?> 
    <script>
      function pouzijXajax()
      {
        xajax_secti(document.getElementById('operand1').value,
          document.getElementById('operand2').value);
      }
    </script>
  </head> 

  <body>
    <center> 
      <h1>Použití frameworku Xajax</h1>
      <input type="text" name="operand1" id="operand1" value="4" size="3" /> 
      +
      <input type="text" name="operand2" id="operand2" value="5" size="3" /> 
      =
      <input type="text" name="vysledek" id="vysledek" value="" size="3" /> 
      <input type="button" value="Sečti" 
        onclick="pouzijXajax();return false;" />
    </center>
	</body> 
</html>
