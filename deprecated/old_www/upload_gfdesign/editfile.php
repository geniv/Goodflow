<?php
  $this->var->main->ReturnValueFile($nazev);
  $a = explode(".", $nazev);
  $pripona = $a[count($a) - 1];
  $nazev = substr($nazev, 0, -(strlen($pripona) + 1));
  return
  "
{$this->var->main->EditFile()}
<div id=\"pridat_slozku_soubor\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_nazev_slozky_souboru\">Název souboru:</label>
        </dt>
        <dd>
          <input id=\"label_input_nazev_slozky_souboru\" type=\"text\" name=\"nazev\" value=\"{$nazev}\" />
          <span>.{$pripona}</span>
        </dd>
      </dl>
        <input name=\"oldnazev\" type=\"hidden\" value=\"{$nazev}\" />
        <input name=\"zan\" type=\"hidden\" value=\"{$_GET["zan"]}\" />
        <input name=\"cislo\" type=\"hidden\" value=\"{$_GET["cislo"]}\" />
        <input name=\"pod\" type=\"hidden\" value=\"{$_GET["pod"]}\" />
        <input name=\"ppod\" type=\"hidden\" value=\"{$_GET["ppod"]}\" />
        <input name=\"prip\" type=\"hidden\" value=\"{$pripona}\" />
      <div id=\"pridat_slozku_soubor_tlacitko\" class=\"soubor_upravit_tlacitko\">
        <input type=\"submit\" name=\"tlacitko\" value=\"Upravit soubor\" />
      </div>
    </fieldset>
  </form>
</div>
  ";
?>
