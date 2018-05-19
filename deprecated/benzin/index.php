<?php

  header("Content-Type: text/html; charset=UTF-8");

  $result = "
  <form method=\"post\" action=\"\">
    <fieldset>
      <label class=\"input_text\">
        <span>Poměr:</span>
        1 : <input type=\"text\" name=\"pomer\" value=\"".(!Empty($_POST["pomer"]) ? $_POST["pomer"] : 30)."\" />
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"input_text\">
        <span>Ředit na ... litrů:</span>
        <input type=\"text\" name=\"litru\" value=\"".(!Empty($_POST["litru"]) ? $_POST["litru"] : 5)."\" /> litru
        <span class=\"zobrazovani_dodatek\">Povinná položka.</span>
      </label>
      <label class=\"submit\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Vypočítat\" />
      </label>
    </fieldset>
  </form>
  ";

  if (!Empty($_POST["tlacitko"])) {
    $pomer = intval($_POST["pomer"]);
    $litru = floatval($_POST["litru"]);

    $lit = round($litru / $pomer, 3);
    $millti = $lit * 1000;

    $result .= "{$lit} l oleje do {$litru} l benzinu<br />
    {$millti} ml oleje do {$litru} l benzinu";
  }

  echo $result;
?>
