<?php
  return
  "
<div id=\"vypis_souboru_slozek\">
  <a href=\"?action=adddir\" class=\"pridat_slozku\" title=\"{$this->var->stranka["adddir"]}\">{$this->var->stranka["adddir"]}<span></span></a>
  {$this->var->main->ListingDir()}
</div>
  ";
?>
