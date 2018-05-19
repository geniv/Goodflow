<?php
  return
  "
{$this->var->main->AddStyle()}
<div id=\"pridat_styl\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_stylu\">Název stylu:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_stylu\" type=\"text\" name=\"nazev\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky\">Název složky stylu:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky\" type=\"text\" name=\"slozka\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <div id=\"pridat_styl_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat styl\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\">Pole označená hvězdičkou [*] jsou povinná</p>
      <p><strong>Název stylu</strong> - S diakritikou</p>
      <p><strong>Název složky stylu</strong> - Bez diakritiky</p>
    </div>
  </div>
</div>
  ";
?>