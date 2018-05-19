<?php
  $this->var->main->ReturnValueImport($nazev);
  $a = explode(".", $nazev);
  $pripona = $a[count($a) - 1];
  $nazev = $a[0];

  return
  "
{$this->var->main->EditImport()}
<div id=\"pridat_import\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"nazev_css_label_input\">Název css souboru:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"nazev_css_label_input\" name=\"nazev\" value=\"{$nazev}\" /> .{$pripona}
        </dd>
      </dl>
      <input type=\"hidden\" name=\"oldnazev\" value=\"{$nazev}\" />
      <input type=\"hidden\" name=\"pripona\" value=\"{$pripona}\" />
      <input type=\"hidden\" name=\"style\" value=\"{$_GET["style"]}\" />
      <div id=\"upravit_import_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit import (css soubor)\" />
      </div>
    </fieldset>
  </form>
</div>
  ";
?>