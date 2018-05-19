<?php
  return
  "
<div class=\"menu_zamestnanec_centralni_background\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "all") ? "<a href=\"?action=zamestnanci&amp;akce=all\" title=\"{$this->var->jazyk["all_zamestnanec"]}\">{$this->var->jazyk["all_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "add") ? "<a href=\"?action=zamestnanci&amp;akce=add\" title=\"{$this->var->jazyk["add_zamestnanec"]}\">{$this->var->jazyk["add_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "search") ? "<a href=\"?action=zamestnanci&amp;akce=search\" title=\"{$this->var->jazyk["search_zamestnanec"]}\">{$this->var->jazyk["search_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "kompetence") ? "<a href=\"?action=zamestnanci&amp;akce=kompetence\" title=\"{$this->var->jazyk["kompetence_zamestnanec"]}\">{$this->var->jazyk["kompetence_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "foto") ? "<a href=\"?action=zamestnanci&amp;akce=foto\" title=\"{$this->var->jazyk["fotografie_zamestnanec"]}\">{$this->var->jazyk["fotografie_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "doba") ? "<a href=\"?action=zamestnanci&amp;akce=doba\" title=\"{$this->var->jazyk["doba_zamestnanec"]}\">{$this->var->jazyk["doba_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "terminy") ? "<a href=\"?action=zamestnanci&amp;akce=terminy\" title=\"{$this->var->jazyk["terminy_zamestnanec"]}\">{$this->var->jazyk["terminy_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "statistika") ? "<a href=\"?action=zamestnanci&amp;akce=statistika\" title=\"{$this->var->jazyk["statistika_zamestnanec"]}\">{$this->var->jazyk["statistika_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "naklady") ? "<a href=\"?action=zamestnanci&amp;akce=naklady\" title=\"{$this->var->jazyk["naklady_zamestnanec"]}\">{$this->var->jazyk["naklady_zamestnanec"]}</a>" : "")."
      </p>
      <p>
        ".($this->PristupOdkaz("zamestnanci", "prava") ? "<a href=\"?action=zamestnanci&amp;akce=prava\" title=\"{$this->var->jazyk["prava_zamestnanec"]}\">{$this->var->jazyk["prava_zamestnanec"]}</a>" : "")."
      </p>
      <p class=\"posledni\">
        ".($this->PristupOdkaz("zamestnanci", "protokoly") ? "<a href=\"?action=zamestnanci&amp;akce=protokoly\" title=\"{$this->var->jazyk["protokoly_zamestnanec"]}\">{$this->var->jazyk["protokoly_zamestnanec"]}</a>" : "")."
      </p>
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
  ";
?>
