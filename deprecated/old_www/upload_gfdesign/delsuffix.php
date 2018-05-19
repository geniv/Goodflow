<?php
  $this->var->main->ReturnValueSuffix($nazev, $pripona, $trida, $zamek);
  return
  "
{$this->var->main->DelSuffix()}
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat příponu:
  </p>
  <p>
    <strong>{$nazev}</strong>
  </p>
  <p>
    Opravdu chceš tuto příponu smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" value=\"{$nazev}\" name=\"nazev\" />
      <input type=\"hidden\" value=\"{$zamek}\" name=\"zamek\" />
    </fieldset>
  </form>
</div>
  ";
?>
