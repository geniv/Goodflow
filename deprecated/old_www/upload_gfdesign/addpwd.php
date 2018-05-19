<?php
  return
  "
  {$this->var->main->AddPaswordDir()}
<div id=\"pridat_slozku_soubor\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" onsubmit=\"SkryjUpload();\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky_souboru\">Login:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky_souboru\" type=\"text\" name=\"login\" value=\"{$this->var->jmeno}\" />
          <span class=\"label_input_nazev_slozky_souboru\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_heslo_slozky\">Heslo:</label>
        </dt>
        <dd>
          <input id=\"label_input_heslo_slozky\" type=\"text\" name=\"heslo\" />
          <span class=\"label_input_nazev_slozky_souboru\">*</span>
        </dd>
      </dl>
      <div id=\"pridat_slozku_soubor_tlacitko\" class=\"zamek_pridat_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Zaheslovat složku\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\"><strong>Login a Heslo</strong> - Po zadání se nastaví login a heslo na soubory v této složce</p>
    </div>
  </div>
</div>
  ";
?>
