<?php
  return
  "
{$this->var->main->AddSuffix()}
<div id=\"pridat_priponu\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_pripony\">Přípona:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_pripony\" type=\"text\" name=\"pripona\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_popis_pripony\">Popis přípony:</label>
        </dt>
        <dd>
          <input id=\"label_input_popis_pripony\" type=\"text\" name=\"nazev\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_trida_pripony\">Třída přípony:</label>
        </dt>
        <dd>
          <input id=\"label_input_trida_pripony\" type=\"text\" name=\"trida\" value=\"pripona_\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"cesta_k_obrazku_label_input\">Cesta k obrázku:</label>
        </dt>
        <dd>
          <input type=\"file\" id=\"cesta_k_obrazku_label_input\" name=\"soubor\" />
        </dd>
      </dl>
      <div id=\"pridat_priponu_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Přidat příponu\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\">Pole označená hvězdičkou [*] jsou povinná</p>
      <p><strong>Popis přípony</strong> - Title obrázku</p>
      <p><strong>Přípona a Třída přípony</strong> - Výchozí tvar: [typ] a pripona_[typ] (tyto dvě pole by se měli shodovat)</p>
    </div>
  </div>
</div>
  ";
?>
