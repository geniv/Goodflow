<?php

  echo
  "
  return: {$nav}<br />
  text:<br />
  <pre>";

  $ret = system("diff --help", $nav);

  echo "</pre>";

?>
