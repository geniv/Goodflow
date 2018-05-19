<?php
  return
  "
<div id=\"vypis_pripon\">
  <a href=\"?action=addsuffix\" class=\"pridat_priponu\" title=\"{$this->var->stranka["addsuffix"]}\">{$this->var->stranka["addsuffix"]}<span></span></a>
  {$this->var->main->ListingSuffix()}
</div>
  ";
?>
