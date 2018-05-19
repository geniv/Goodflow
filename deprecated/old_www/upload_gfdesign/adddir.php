<?php
  return
  "
{$this->var->main->AddDir()}
<div id=\"pridat_slozku_soubor\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky_souboru\">Název složky:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky_souboru\" type=\"text\" name=\"nazev\" />
          <span class=\"label_input_nazev_slozky_souboru\">*</span>
        </dd>
      </dl>
      <dl id=\"label_input_dl_vyber_slozku_soubor\">
        <dt>
          <label>Umístnění:</label>
        </dt>
        <dd>
          <strong>--- Vyber složku ---</strong>
          <span class=\"input_label_dl_obal_polozka_vyber_slozku_soubor\">
            {$this->var->main->ListingDirSelect()}
          </span>
        </dd>
      </dl>
      <div id=\"pridat_slozku_soubor_tlacitko\" class=\"slozka_pridat_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat složku\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\">Pole označené hvězdičkou [*] je povinné</p>
      <p><strong>Umístnění</strong> - Kořenový adresář / první zanoření / druhé zanoření</p>
      <p><strong>./</strong> - Kořenový adresář</p>
    </div>
  </div>
</div>
  ";
/*

      <dl class=\"label_input_dl_prava\">
        <dt>
          <label>Prostor:</label>
        </dt>
        <dd>
          --- Vyber místo ---
          <span class=\"input_label_dl_obal_polozka_administrator\">
            {$this->var->main->ListingProstorSelect()}
          </span>
        </dd>
      </dl>
      " : "
      <dl>
        <dt>
          <label for=\"label_input_prostor\">Prostor:</label>
        </dt>
        <dd>
          <input id=\"label_input_prostor\" type=\"text\" name=\"prostor\" value=\"10\" />
          <span>MB</span>
        </dd>
      </dl>
      ")."
      ".($this->var->pravo == $this->var->moderator ? "<input type=\"hidden\" name=\"pravo\" value=\"{$this->var->user}\" />" : "
      <dl class=\"label_input_dl_prava\">
        <dt>
          <label>Práva:</label>
        </dt>
        <dd>
          --- Vyber práva ---
          <span class=\"input_label_dl_obal_polozka_administrator\">
            {$this->var->main->ListingRightSelect()}
          </span>
        </dd>
      </dl>

*/

?>
