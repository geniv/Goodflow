<?php
  $this->var->main->ReturnValueUser($login, $heslo, $icq, $www, $email, $prostor, $pravo, $dnyexpiraceucet, $dnyexpirace, $vytvoreno, $style);
  return
  "
{$this->var->main->DelUser()}
<div id=\"smazat_uzivatele\"".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "").">
  <p>
    Chystáš se smazat uživatele s loginem:
  </p>
  <p>
    <strong>{$login}</strong>
  </p>
  <p>
    Opravdu chceš tohoto uživatele smazat ?
  </p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <input id=\"tlacitko_ano\" type=\"submit\" value=\"Ano\" name=\"ano\" title=\"Ano\" />
      <input id=\"tlacitko_ne\" type=\"submit\" value=\"Ne\" name=\"ne\" title=\"Ne\" />
      <input type=\"hidden\" value=\"{$login}\" name=\"login\" />
    </fieldset>
  </form>
</div>
  ";
?>
