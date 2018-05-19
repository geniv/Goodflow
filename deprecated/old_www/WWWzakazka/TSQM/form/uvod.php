<?php
  return
  "
<div id=\"uvod_menu_{$this->var->nowjazyk}\"><!-- czech/deutsch -->
  <div id=\"logo\">
    <p id=\"menu_central_1_3\"></p>
    <p id=\"menu_central_2_3\"></p>
    <p id=\"menu_central_3_3\"></p>
  </div>
  ".($this->PristupOdkaz("uvod") ? "<p id=\"uvodni_strana\">
    <a href=\"?action=uvod\" title=\"{$this->var->jazyk["uvod"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["uvod"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"uvodni_strana_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["uvod"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("zamestnanci") ? "<p id=\"zamestnanci\">
    <a href=\"?action=zamestnanci\" title=\"{$this->var->jazyk["zamestnanci"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["zamestnanci"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"zamestnanci_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["zamestnanci"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("partneri") ? "<p id=\"partneri\">
    <a href=\"?action=partneri\" title=\"{$this->var->jazyk["partneri"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["partneri"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"partneri_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["partneri"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("zakaznici") ? "<p id=\"zakaznici\">
    <a href=\"?action=zakaznici\" title=\"{$this->var->jazyk["zakaznici"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["zakaznici"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"zakaznici_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["zakaznici"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("management") ? "<p id=\"management\">
    <a href=\"?action=management\" title=\"{$this->var->jazyk["management"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["management"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"management_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["management"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("procesy") ? "<p id=\"procesy\">
    <a href=\"?action=procesy\" title=\"{$this->var->jazyk["procesy"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["procesy"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"procesy_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["procesy"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("terminy") ? "<p id=\"terminy\">
    <a href=\"?action=terminy\" title=\"{$this->var->jazyk["terminy"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["terminy"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"terminy_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["terminy"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("archiv") ? "<p id=\"archiv\">
    <a href=\"?action=archiv\" title=\"{$this->var->jazyk["archiv"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["archiv"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"archiv_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["archiv"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
  ".($this->PristupOdkaz("admin") ? "<p id=\"administrace\">
    <a href=\"?action=admin\" title=\"{$this->var->jazyk["admin"]}\">
      <span class=\"alternativa\">{$this->var->jazyk["admin"]}</span>
      <span class=\"polozka\"></span>
      <span class=\"ikona\"></span>
    </a>" : "<p id=\"administrace_noactive\">
    <span class=\"alternativa_noactive\">{$this->var->jazyk["admin"]}</span>
    <span class=\"polozka_noactive\"></span>
    <span class=\"ikona_noactive\"></span>")."
  </p>
</div>
  ";

/*
<div id=\"uvod_menu_{$this->var->nowjazyk}\"><!-- czech/deutsch -->
    <p id=\"menu_central_1_3\"></p>
    <p id=\"menu_central_2_3\"></p>
    <p id=\"menu_central_3_3\"></p>
    
    
  <p id=\"uvodni_strana\">
    ".($this->PristupOdkaz("uvod") ? "<a href=\"?action=uvod\" title=\"{$this->var->jazyk["uvod"]}\">
      <span>{$this->var->jazyk["uvod"]}</span>
    </a>" : "<p id=\"uvodni_strana_noactive\"></p>")."
  </p>
  
  <p id=\"zamestnanci\">
    ".($this->PristupOdkaz("zamestnanci") ? "<a href=\"?action=zamestnanci\" title=\"{$this->var->jazyk["zamestnanci"]}\">
      <span>{$this->var->jazyk["zamestnanci"]}</span>
    </a>" : "<p id=\"zamestnanci_noactive\"></p>")."
  </p>
  
  <p id=\"partneri\">
    ".($this->PristupOdkaz("partneri") ? "<a href=\"?action=partneri\" title=\"{$this->var->jazyk["partneri"]}\">
      <span>{$this->var->jazyk["partneri"]}</span>
    </a>" : "<p id=\"partneri_noactive\"></p>")."
  </p>
  
  <p id=\"zakaznici\">
    ".($this->PristupOdkaz("zakaznici") ? "<a href=\"?action=zakaznici\" title=\"{$this->var->jazyk["zakaznici"]}\">
      <span>{$this->var->jazyk["zakaznici"]}</span>
    </a>" : "<p id=\"zakaznici_noactive\"></p>")."
  </p>
  
  <p id=\"management\">
    ".($this->PristupOdkaz("management") ? "<a href=\"?action=management\" title=\"{$this->var->jazyk["management"]}\">
      <span>{$this->var->jazyk["management"]}</span>
    </a>" : "<p id=\"management_noactive\"></p>")."
  </p>
  
  <p id=\"procesy\">
    ".($this->PristupOdkaz("procesy") ? "<a href=\"?action=procesy\" title=\"{$this->var->jazyk["procesy"]}\">
      <span>{$this->var->jazyk["procesy"]}</span>
    </a>" : "<p id=\"procesy_noactive\"></p>")."
  </p>
  
  <p id=\"terminy\">
    ".($this->PristupOdkaz("terminy") ? "<a href=\"?action=terminy\" title=\"{$this->var->jazyk["terminy"]}\">
      <span>{$this->var->jazyk["terminy"]}</span>
    </a>" : "<p id=\"terminy_noactive\"></p>")."
  </p>
  
  <p id=\"archiv\">
    ".($this->PristupOdkaz("archiv") ? "<a href=\"?action=archiv\" title=\"{$this->var->jazyk["archiv"]}\">
      <span>{$this->var->jazyk["archiv"]}</span>
    </a>" : "<p id=\"archiv_noactive\"></p>")."
  </p>
  
  <p id=\"administrace\">
    ".($this->PristupOdkaz("admin") ? "<a href=\"?action=admin\" title=\"{$this->var->jazyk["admin"]}\">
      <span>{$this->var->jazyk["admin"]}</span>
    </a>" : "<p id=\"administrace_noactive\"></p>")."
  </p>
  
</div>

---------------------------------------------------------------------------------------------------------------------------------------------

<div id=\"uvod_menu_czech\">
    <p id=\"menu_central_1_3\"></p>
    <p id=\"menu_central_2_3\"></p>
    <p id=\"menu_central_3_3\"></p>
  <p id=\"uvodni_strana\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"zamestnanci\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"partneri\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"zakaznici\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"management\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"procesy\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"terminy\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"archiv\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
  <p id=\"administrace\">
    <a href=\"\" title=\"\">
      <span>nazev_sekce</span>
    </a>
  </p>
</div>


















*/

?>
