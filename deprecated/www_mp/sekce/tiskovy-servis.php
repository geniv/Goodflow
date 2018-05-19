<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $nastavenistrankovani = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-tiskovy-servis");
  $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", array("adresa" => "tiskovy-servis-menu"));
  $strankovani = $this->var->main[0]->NactiFunkci("StaticStrankovani", "Strankovani", array("na_stranku" => $nastavenistrankovani->nastaveni_strankovani, "pocet_radku" => $pocet->pocet, "baseurl" => "tiskovy-servis/{$pocet->baseurl}/"));
  $tiskovyservismenu = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", array("adresa" => "tiskovy-servis-menu", "baseurl" => "tiskovy-servis/", "tvar" => "tiskovy-servis-menu"));
  $tiskovyservisobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("strankovani" => $strankovani, "adresa" =>  "tiskovy-servis-menu", "baseurl" => "tiskovy-servis/", "tvar" => "tiskovy-servis-obsah"));
/*
  <h3 class=\"aktivni\"><a href=\"#\" title=\"\">2010</a></h3>
  <h3 class=\"\"><a href=\"#\" title=\"\">2009</a></h3>
  <div class=\"tiskovy_servis_clanek\">
    <div class=\"tiskovy_servis_clanek_levy\">
      <img src=\"{$absolute_url}idnescz.png\" alt=\"\" />
      <p>datum přidání</p>
      <p>zdroj</p>
    </div>
    <div class=\"tiskovy_servis_clanek_pravy\">
      <p>nsectetur adipiscing elit. Mauris sodales molestie nisl nec porta.</p>
    </div>
    <p class=\"cely_clanek_odkaz\">
      <a href=\"http://www.idnes.cz/\" title=\"\" onclick=\"this.target='_blank'\">Celý článek</a>
    </p>
  </div>
*/
  $result =
  "<div id=\"sekce_tiskovy_servis\">
  <h2>{$nazvysekci->nazev_sekce_tiskovy_servis}</h2>
  <div id=\"obal_sekce_tiskovy_servis\">
    <div id=\"tiskovy_servis_obal_menu\">
      {$tiskovyservismenu}
    </div>
    {$tiskovyservisobsah}
  </div>
</div>\n";
  return $result;
?>
