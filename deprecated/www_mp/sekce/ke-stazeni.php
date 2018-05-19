<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $nastavenistrankovani = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-ke-stazeni");
  $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", array("adresa" => "ke-stazeni-menu"));
  $strankovani = $this->var->main[0]->NactiFunkci("StaticStrankovani", "Strankovani", array("na_stranku" => $nastavenistrankovani->nastaveni_strankovani, "pocet_radku" => $pocet->pocet, "baseurl" => "ke-stazeni/{$pocet->baseurl}/"));
  $kestazenimenu = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "ke-stazeni-menu", "baseurl" => "ke-stazeni/", "tvar" => "ke-stazeni-menu"));
  $kestazeniobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("strankovani" => $strankovani, "adresa" =>  "ke-stazeni-menu", "baseurl" => "ke-stazeni/", "tvar" => "ke-stazeni-obsah"));
  $result =
  "<div id=\"sekce_ke_stazeni\">
  <h2>{$nazvysekci->nazev_sekce_ke_stazeni}</h2>
  <div id=\"obal_ke_stazeni\">
    {$nazvysekci->nazev_sekce_text_ke_stazeni}
    <div id=\"ke_stazeni_obal_menu_sekce\">
      <div id=\"ke_stazeni_obal_menu\">
        {$kestazenimenu}
      </div>
      <div id=\"ke_stazeni_obal_sekce\">
        {$kestazeniobsah}
      </div>
    </div>
  </div>
</div>\n";
  return $result;
?>
