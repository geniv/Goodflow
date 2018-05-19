<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  if ($_GET["action"] == "projekty")
  {
    $aktivni = " aktivni";
    $nastavenistrankovani = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-projekty");
    $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", array("adresa" => "projekty-menu", "submenu_only" => 1));  //"subobsahradio" => "aktualni-projekty" /{$pocet->baseurl}
    $strankovani = $this->var->main[0]->NactiFunkci("StaticStrankovani", "Strankovani", array("na_stranku" => $nastavenistrankovani->nastaveni_strankovani, "pocet_radku" => $pocet->pocet, "baseurl" => "projekty/"));
    $projektyaktualni = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("adresa" => "projekty-menu", "submenu_only" => 1, "strankovani" => $strankovani, "baseurl" => "projekty/", "tvar" => "aktualni-projekty"));
  }
  $projektydokoncenemenu = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "projekty-menu", "baseurl" => "dokoncene-projekty/", "tvar" => "projekty-menu"));
  $result =
  "<div id=\"sekce_projekty\">
  <h2>{$nazvysekci->nazev_sekce_projekty}</h2>
  <div id=\"obal_sekce_projekty\">
    <div id=\"projekty_obal_menu\">
      <h4 class=\"aktualni_projekty{$aktivni}\"><a href=\"{$absolute_url}projekty\" title=\"\">+ Aktuální projekty</a></h4>
      <h4 class=\"historie_projektu\"><a href=\"{$absolute_url}dokoncene-projekty\" title=\"\">+ Dokončené projekty</a></h4>
      {$projektydokoncenemenu}
    </div>
    <div id=\"projekty_obal_obsah\">
      {$projektyaktualni}
    </div>
  </div>
</div>\n";
  return $result;
?>