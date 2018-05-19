<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $nastavenistrankovani = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-tipy");
  $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", array("adresa" => "tipy-menu"));
  $strankovani = $this->var->main[0]->NactiFunkci("StaticStrankovani", "Strankovani", array("na_stranku" => $nastavenistrankovani->nastaveni_strankovani, "pocet_radku" => $pocet->pocet, "baseurl" => "tipy/{$pocet->baseurl}/"));
  $tipymenu = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "tipy-menu", "baseurl" => "tipy/", "tvar" => "tipy-menu"));
  $tipyobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("strankovani" => $strankovani, "adresa" =>  "tipy-menu", "baseurl" => "tipy/", "tvar" => "tipy-obsah"));
  $result =
  "<div id=\"sekce_tipy\">
  <h2>{$nazvysekci->nazev_sekce_tipy}</h2>
  <div id=\"obal_sekce_tipy\">
    <div id=\"tipy_obal_menu\">
      <h3>Seznam témat</h3>
      {$tipymenu}
    </div>
    <div id=\"tipy_obal_obsah\">
{$tipyobsah}
    </div>
  </div>
</div>\n";
  return $result;
?>
