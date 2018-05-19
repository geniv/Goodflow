<?php
  return
  "
  <script type=\"text/javascript\">
    PocetInput('soubory[]', true);
  </script>
{$this->var->main->AddImport()}
<div id=\"pridat_import\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"cesta_k_css_label_input\">Cesta k css:</label>
        </dt>
        <dd>
          <input type=\"file\" id=\"cesta_k_css_label_input\" name=\"soubor\" />
        </dd>
      </dl>
      <div id=\"poc_inputfile\"></div>
      <div id=\"pridat_import_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat import (css / obrázek)\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\">Je možné použít: <strong>Cesta k css</strong> nebo <strong>Cesta k obrázku</strong> a nebo oboje</p>
      <p><strong>Cesta k obrázku</strong> - Když budeš nahrávat několik obrázků, tak si nejprve nastav počet inputů podle počtu obrázků a potom nastavuj cesty</p>
    </div>
  </div>
</div>
  ";
?>