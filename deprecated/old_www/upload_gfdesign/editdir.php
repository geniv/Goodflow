<?php
  $this->var->main->ReturnValueDir($nazev);
  return
  "
{$this->var->main->EditDir()}
<div id=\"pridat_slozku_soubor\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky_souboru\">Název složky:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky_souboru\" type=\"text\" name=\"nazev\" value=\"{$nazev}\" />
        </dd>
      </dl>
        <input type=\"hidden\" name=\"oldnazev\" value=\"{$nazev}\" />
      <div id=\"pridat_slozku_soubor_tlacitko\" class=\"slozka_upravit_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit složku\" />
      </div>
    </fieldset>
  </form>
</div>
  ";
?>
