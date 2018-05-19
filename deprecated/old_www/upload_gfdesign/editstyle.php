<?php
  $this->var->main->ReturnValueStyle($nazev, $slozka);
  return
  "
{$this->var->main->EditStyle()}
<div id=\"pridat_styl\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_stylu\">Název stylu:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_stylu\" type=\"text\" name=\"nazev\" value=\"{$nazev}\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky\">Název složky stylu:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky\" type=\"text\" name=\"slozka\" value=\"{$slozka}\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <input type=\"hidden\" name=\"oldslozka\" value=\"{$slozka}\" />
      <div id=\"upravit_styl_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit styl\" />
      </div>
    </fieldset>
  </form>
</div>
  ";
?>