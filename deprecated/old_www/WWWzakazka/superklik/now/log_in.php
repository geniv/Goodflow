<?php
  return
  "
<p id=\"prilasen_odhlasit\">
 <a href=\"#\" title=\"{$_SESSION["SLOGIN"]}\" class=\"jste_prihlasen\" onclick=\"AjaxStranka('ax_info'); return false;\" ondblclick=\"AjaxStranka('ax_vyhodnoceni'); return false;\">{$_SESSION["SLOGIN"]}</a>
  <em></em>
  <a href=\"#\" title=\"Odhlásit se\" class=\"odhlasit_se\" onclick=\"UnLogin(); return false;\">
    <span>Odhlásit se</span>
  </a>
</p>
  ";
?>
