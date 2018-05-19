<?php

class Formular
{
  private $method = "post";

  public function __construct($method = "post")
  {
    $this->method = $method;  //nastaveni odesilaci metody
  }

//array("name" => array("typ", "nazev", "value"))
  public function Form($pole)
  {
    $elem = "";
    foreach ($pole as $indexpolozka => $polozka)
    {
      //rozliseni podle typu
      switch ($polozka[0])
      {
        case "text":
        case "password":
        case "submit":
          $nadpis = (!Empty($polozka[1]) ? "<span>{$polozka[1]}:</span>" : "");
          $elem[] = "
      <label class=\"input_{$polozka[0]}\">
        {$nadpis}
        <input type=\"{$polozka[0]}\" name=\"{$indexpolozka}\" value=\"{$polozka[2]}\">
      </label>
      ";
        break;
      }

    }
// enctype=\"multipart/form-data\"
    $elementy = implode("", $elem);
    $result = "
  <form method=\"{$this->method}\" action=\"\">
    <fieldset>
      {$elementy}
    </fieldset>
  </form>";

    return $result;
  }


}
?>
