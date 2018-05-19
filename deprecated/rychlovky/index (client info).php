<?php
  var_dump($_SERVER);
echo "<br />";
  $roz = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
  $autolang = explode("-", $roz[0]);
  var_dump($autolang[0]);
?>
