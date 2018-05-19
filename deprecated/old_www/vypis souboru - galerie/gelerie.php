<?php
  $cesta = "./";
  $konc = "jpg";
  $handle = opendir($cesta);
  while($soub = readdir($handle))
  {
    $koncovka = explode(".", $soub);
    if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file" && $koncovka[count($koncovka) - 1] == $konc)
    {
      echo
      "
      <p>
        <img src=\"{$soub}\" title=\"{$soub}\" />
      </p>
      ";
    }
  }
  closedir($handle);

?>
