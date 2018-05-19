<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $projektydokoncene = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("adresa" =>  "projekty-menu", "baseurl" => "dokoncene-projekty/", "submenu_od" => 1, "tvar" => "projekty-menu"));
  $projektydokoncenemenu = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "projekty-menu", "baseurl" => "dokoncene-projekty/", "tvar" => "projekty-menu"));
  $result =
  "<div id=\"sekce_projekty\">
  <h2>{$nazvysekci->nazev_sekce_projekty}</h2>
  <div id=\"obal_sekce_projekty\">
    <div id=\"projekty_obal_menu\">
      <h4 class=\"aktualni_projekty\"><a href=\"{$absolute_url}projekty\" title=\"\">+ Aktuální projekty</a></h4>
      <h4 class=\"historie_projektu aktivni\"><a href=\"{$absolute_url}dokoncene-projekty\" title=\"\">+ Dokončené projekty</a></h4>
      {$projektydokoncenemenu}
    </div>
    <div id=\"projekty_obal_obsah\">
      {$projektydokoncene}
    </div>
  </div>
</div>";
  return $result;
?>