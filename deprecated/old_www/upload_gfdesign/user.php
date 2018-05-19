<?php
  return
  "
<div id=\"vypis_uzivatelu\">
  <a href=\"?action=adduser\" class=\"pridat_uzivatele\" title=\"{$this->var->stranka["adduser"]}\">{$this->var->stranka["adduser"]}<span></span></a>
  {$this->var->main->ListingUser()}
</div>
  ";
?>
