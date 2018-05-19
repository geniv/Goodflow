<?php
  $this->var->main->ReturnValueStyle($nazev, $slozka);
  return
  "
{$this->var->main->DelStyle()}
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat styl s názvem:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš tento styl smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" value=\"{$nazev}\" name=\"nazev\" />
      <input type=\"hidden\" value=\"{$slozka}\" name=\"slozka\" />
    </fieldset>
  </form>
</div>
  ";
?>