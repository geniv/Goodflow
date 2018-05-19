<?php
  return
  "
<div class=\"menu_partneri_centralni_background\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p>
        ".($this->PristupOdkaz("partneri", "all") ? "<a href=\"?action=partneri&amp;akce=all\" title=\"{$this->var->jazyk["all_partner"]}\">{$this->var->jazyk["all_partner"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("partneri", "add") ? "<a href=\"?action=partneri&amp;akce=add\" title=\"{$this->var->jazyk["add_partner"]}\">{$this->var->jazyk["add_partner"]}</a>" : "")."
      </p>
      <p class=\"posledni\">
        ".($this->PristupOdkaz("partneri", "search") ? "<a href=\"?action=partneri&amp;akce=search\" title=\"{$this->var->jazyk["search_partner"]}\">{$this->var->jazyk["search_partner"]}</a>" : "")."
      </p>
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
  ";
?>
