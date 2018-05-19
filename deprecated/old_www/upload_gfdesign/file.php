<?php
  return
  "
<div id=\"vypis_souboru_slozek\">
  <a href=\"?action=addfile\" class=\"pridat_soubor\" title=\"{$this->var->stranka["addfile"]}\">{$this->var->stranka["addfile"]}<span></span></a>
  {$this->var->main->ListingFile()}
</div>
  ";
?>
