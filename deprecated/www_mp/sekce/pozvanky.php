<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $nastavenistrankovani = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-pozvanky");
  $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", array("adresa" => "pozvanky-menu"));
  $strankovani = $this->var->main[0]->NactiFunkci("StaticStrankovani", "Strankovani", array("na_stranku" => $nastavenistrankovani->nastaveni_strankovani, "pocet_radku" => $pocet->pocet, "baseurl" => "pozvanky/{$pocet->baseurl}/"));
  $pozvankymenu = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "pozvanky-menu", "baseurl" => "pozvanky/", "tvar" => "pozvanky-menu"));
  $pozvankyobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("strankovani" => $strankovani, "adresa" =>  "pozvanky-menu", "baseurl" => "pozvanky/", "tvar" => "pozvanky-obsah"));
  $result =
  "<div id=\"sekce_pozvanky\">
  <h2>{$nazvysekci->nazev_sekce_pozvanky}</h2>
  <div id=\"obal_sekce_pozvanky\">
    <div id=\"pozvanky_obal_menu\">
      <h3>Seznam akcí</h3>
      {$pozvankymenu}
    </div>
    <div id=\"pozvanky_obal_obsah\">
{$pozvankyobsah}
    </div>
  </div>
</div>\n";
  return $result;
?>
