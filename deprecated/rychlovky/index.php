<?php

  $result = "
  <form method=\"post\">
    Jméno: <input type=\"text\" name=\"jmeno\" /><br />
    Příjmení: <input type=\"text\" name=\"prijmeni\" /><br />
    Věk: <input type=\"text\" name=\"vek\" /><br />
    Pohlaví:
    <select name=\"pohlavi\">
      <option value=\"muz\">Muž</option>
      <option value=\"zena\">Žena</option>
    </select><br />
    <input type=\"submit\" name=\"tlacitko\" value=\"Odeslat...\" /><br />
  </form>
  ";

  if (!Empty($_POST["tlacitko"]) && //neprazdne
      !Empty($_POST["jmeno"]) &&
      !Empty($_POST["prijmeni"]) &&
      is_numeric($_POST["vek"])) //nastavene (zohledneni 0)
  {
    //prepinani pohlavi
    switch ($_POST["pohlavi"])
    {
      default:
      case "muz":
        $pohlavi = "pane";
      break;

      case "zena":
        $pohlavi = "slečno";
      break;
    }

    //podminky na vek
    $stari = "";
    $vek = $_POST["vek"];
    if ($vek >= 0 && $vek <= 5)
    {
      $stari = "min jak 5";
    }
      else
    if ($vek >= 6 && $vek <= 12)
    {
      $stari = "min jak 12 let, ale mate vic jak 5";
    }
      else
    if ($vek >= 13 && $vek <= 18)
    {
      $stari = "min jak 18 ale mate vic jak 13";
    }
      else
    if ($vek > 18)
    {
      $stari = "vic jak 18";
    }

    $result = "
Zdravím {$pohlavi} {$_POST["prijmeni"]} {$_POST["jmeno"]}<br />
Je vám: {$stari} let.";
  }
    else
  {
    //osetreni chyb
    if (!Empty($_POST["tlacitko"]))
    {
      if (!is_numeric($_POST["vek"]))
      {
        $result = "v poli věk musí být zadané číslo!";
      }
    }
  }

  echo $result;
?>
