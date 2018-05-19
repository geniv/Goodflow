<?php
  return
  "
<p id=\"registrace_prihlaseni\">
  <a href=\"#\" title=\"Registrace\" onclick=\"AjaxStranka('ax_registrace'); return false;\">
    <span>Registrace</span>
  </a>
  <em></em>
  <a href=\"#\" class=\"prihlaseni_odkaz\" title=\"Přihlášení\" onclick=\"AjaxStranka('ax_login'); return false;\">
    <span>Přihlášení</span>
  </a>
</p>
<div id=\"lista_prihlasovani\">
  <h2></h2>
    <div>
      <p class=\"texty_odhlaseno_prihlaseno\">
        <span class=\"obrazek_odhlasen_prihlasen obrazek_spatne_prihlaseni\"></span>
        Zadali jste špatné přihlašovací údaje !
      </p>
    </div>
  <h3 class=\"pravidla_bottom\"></h3>
</div>
  ";
?>
