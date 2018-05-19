<?php
  $this->var->main->ReturnValueDir($nazev);
  return
  "
{$this->var->main->DelDir()}
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat složku s názvem:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš tuto složku smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" value=\"{$nazev}\" name=\"nazev\" />
    </fieldset>
  </form>
</div>
  ";
?>
