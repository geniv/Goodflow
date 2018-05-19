<?php
  return
  "
<div class=\"menu_admin_centralni_background\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p>
        ".($this->PristupOdkaz("admin", "prava") ? "<a href=\"?action=admin&amp;akce=prava\" title=\"{$this->var->jazyk["pristup_admin"]}\">{$this->var->jazyk["pristup_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamprava") ? "<a href=\"?action=admin&amp;akce=zamprava\" title=\"{$this->var->jazyk["prava_admin"]}\">{$this->var->jazyk["prava_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamzeme") ? "<a href=\"?action=admin&amp;akce=zamzeme\" title=\"{$this->var->jazyk["zeme_admin"]}\">{$this->var->jazyk["zeme_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamvzdela") ? "<a href=\"?action=admin&amp;akce=zamvzde\" title=\"{$this->var->jazyk["vzde_admin"]}\">{$this->var->jazyk["vzde_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamstatus") ? "<a href=\"?action=admin&amp;akce=zamstat\" title=\"{$this->var->jazyk["stat_admin"]}\">{$this->var->jazyk["stat_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamjazyk") ? "<a href=\"?action=admin&amp;akce=zamjazyk\" title=\"{$this->var->jazyk["jazyk_admin"]}\">{$this->var->jazyk["jazyk_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamhobby") ? "<a href=\"?action=admin&amp;akce=zamhobby\" title=\"{$this->var->jazyk["hobby_admin"]}\">{$this->var->jazyk["hobby_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamsport") ? "<a href=\"?action=admin&amp;akce=zamsport\" title=\"{$this->var->jazyk["sport_admin"]}\">{$this->var->jazyk["sport_admin"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("admin", "zamvyska") ? "<a href=\"?action=admin&amp;akce=zamvyska\" title=\"{$this->var->jazyk["vyska_admin"]}\">{$this->var->jazyk["vyska_admin"]}</a>" : "")."
      </p>
      <p class=\"posledni\">
        ".($this->PristupOdkaz("admin", "strankovani") ? "<a href=\"?action=admin&amp;akce=strankovani\" title=\"{$this->var->jazyk["stran_admin"]}\">{$this->var->jazyk["stran_admin"]}</a>" : "")."
      </p>
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
  ";
?>
