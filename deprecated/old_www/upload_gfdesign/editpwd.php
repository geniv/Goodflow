<?php
  $this->var->main->ReturnValuePaswordDir($login, $heslo);
  return
  "
  {$this->var->main->EditPaswordDir()}
<div id=\"pridat_slozku_soubor\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" onsubmit=\"SkryjUpload();\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky_souboru\">Login:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky_souboru\" type=\"text\" name=\"login\" value=\"{$login}\" />
          <span class=\"label_input_nazev_slozky_souboru\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_heslo_slozky\">Heslo:</label>
        </dt>
        <dd>
          <input id=\"label_input_heslo_slozky\" type=\"text\" name=\"heslo\" value=\"{$heslo}\" />
          <span class=\"label_input_nazev_slozky_souboru\">*</span>
        </dd>
      </dl>
      <div id=\"pridat_slozku_soubor_tlacitko\" class=\"zamek_upravit_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit login / heslo\" />
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
