<?php
  $this->var->main->ReturnValueSuffix($nazev, $pripona, $trida, $zamek);
  return
  "
{$this->var->main->EditSuffix()}
<div id=\"pridat_priponu\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
    <fieldset>
      ".($zamek != "true" ? "
      <dl>
        <dt>
          <label for=\"label_input_nazev_pripony\">Přípona:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_pripony\" type=\"text\" name=\"pripona\" value=\"{$pripona}\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      " : "")."
      <dl>
        <dt>
          <label for=\"label_input_popis_pripony\">Popis přípony:</label>
        </dt>
        <dd>
          <input id=\"label_input_popis_pripony\" type=\"text\" name=\"nazev\" value=\"{$nazev}\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      ".($zamek != "true" ? "
      <dl>
        <dt>
          <label for=\"label_input_trida_pripony\">Třída přípony:</label>
        </dt>
        <dd>
          <input id=\"label_input_trida_pripony\" type=\"text\" name=\"trida\" value=\"{$trida}\" />
          <span class=\"label_input_povinne\">*</span>
        </dd>
      </dl>
      " : "
      <input type=\"hidden\" name=\"pripona\" value=\"{$pripona}\" />
      <input type=\"hidden\" name=\"trida\" value=\"{$trida}\" />
      ")."
      <dl>
        <dt>
          <label for=\"cesta_k_obrazku_label_input\">Cesta k obrázku:</label>
        </dt>
        <dd>
          <input type=\"file\" id=\"cesta_k_obrazku_label_input\" name=\"soubor\" />
        </dd>
      </dl>
      <div id=\"upravit_priponu_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit příponu\" />
      </div>
    </fieldset>
  </form>
</div>
  ";
?>
