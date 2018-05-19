<?php
  $this->var->main->ReturnValuePaswordDir($login, $heslo);
  return
  "
{$this->var->main->DelPaswordDir()}
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat zaheslování složky s loginem / heslem:
  </p>
  <p>
    <strong>{$login}</strong> / <strong>{$heslo}</strong>
  </p>
  <p>
    Opravdu chceš toto zaheslování smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" value=\"{$login}\" name=\"login\" />
    </fieldset>
  </form>
</div>
  ";
?>
