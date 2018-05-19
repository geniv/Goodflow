<?php

$cesta = ".";  //projiti miniatur
$handle = opendir($cesta);
while($soub = readdir($handle))
{
  if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
  {
    $result .= "<a href=\"{$soub}\">{$soub}</a><br />";  //nacitani souboru
  }
}
closedir($handle);

echo $result;

?>
