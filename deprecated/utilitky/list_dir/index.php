<?php

include_once "config.php";

class ListDir extends Konfig
{
  public function __construct()
  {
    $soubory = $this->VypisSouboru($this->dir);
    $row = array();
    foreach ($soubory as $soubor)
    {
      $nazev = basename($soubor, ".png");
      $row[] = "
      {$nazev}
      <br />
      <img src=\"{$this->dir}/{$soubor}\" alt=\"{$nazev}\" />
      <br /><br />
      ";
    }

    $row = implode("", $row);
    $result = "... {$row} ... ";

    echo $result;
  }
}

new ListDir();

?>
