<?php
  return
  "
<div id=\"vypis_stylu\">
  <a href=\"?action=addstyle\" class=\"pridat_styl\" title=\"{$this->var->stranka["addstyle"]}\">{$this->var->stranka["addstyle"]}<span></span></a>
  {$this->var->main->ListingStyle()}
</div>
  ";
?>