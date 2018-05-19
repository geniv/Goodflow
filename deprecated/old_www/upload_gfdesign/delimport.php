<?php
  $this->var->main->ReturnValueImport($nazev);
  $a = explode(".", $nazev);
  $pripona = $a[count($a) - 1];
  $nazev = $a[0];

  return
  "
{$this->var->main->DelImport()}
<div id=\"smazat_slozku_soubor\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat import s názvem:
  </p>
  <p>
    <strong>{$nazev}.{$pripona}</strong>
  </p>
  <p>
    Opravdu chceš tento import smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ok\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_no\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" name=\"nazev\" value=\"{$nazev}.{$pripona}\" />
      <input type=\"hidden\" name=\"style\" value=\"{$_GET["style"]}\" />
    </fieldset>
  </form>
</div>
  ";
?>