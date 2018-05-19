<?php
  $_SESSION["SLOGIN"] = "";
  $_SESSION["SHESLO"] = "";
  $_SESSION["SACTIVE"] = false;
  $_SESSION["IDUSER"] = 0;

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
  ";
?>