<?php

class Kombinace
{
  //vstupni pole, pocet kombinace je: pow(count(pole))
  private $pole = array("sara", "tomkova", "437", "dubi");

  //konstruktor
  public function __construct()
  {
    $poc = count($this->pole);
    $pocet = pow($poc, $poc); //X^X
    $index = "";
    //generovani indexu
    for ($i = 0; $i < $pocet; $i++)
    {
      $index[] = base_convert($i, 10, $poc);
    }

    //dosazeni indexu
    foreach ($index as $ihodn => $hodnota)
    {
      $ret[$ihodn] = "";
      foreach (str_split($hodnota) as $index)
      {
        $ret[$ihodn] .= $this->pole[$index];
      }
    }
    var_dump($ret);
  }
}
//vytvoreni tridy
new Kombinace();

?>
