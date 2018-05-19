<?php
  return
  "
<div class=\"menu_zakaznici_centralni_background\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p>
        ".($this->PristupOdkaz("zakaznici", "all") ? "<a href=\"?action=zakaznici&amp;akce=all\" title=\"{$this->var->jazyk["all_zakaznik"]}\">{$this->var->jazyk["all_zakaznik"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zakaznici", "add") ? "<a href=\"?action=zakaznici&amp;akce=add\" title=\"{$this->var->jazyk["add_zakaznik"]}\">{$this->var->jazyk["add_zakaznik"]}</a>" : "")."
      </p>
      <p class=\"posledni\">
        ".($this->PristupOdkaz("zakaznici", "search") ? "<a href=\"?action=zakaznici&amp;akce=search\" title=\"{$this->var->jazyk["search_zakaznik"]}\">{$this->var->jazyk["search_zakaznik"]}</a>" : "")."
      </p>
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
  ";
?>
