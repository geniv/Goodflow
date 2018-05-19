<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $obcasnikobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObal", array("adresa" => "obcasnik-menu", "tvar" => "obcasnik-obsah"));
  $result =
  "<div id=\"sekce_obcasnik\">
  <h2>{$nazvysekci->nazev_sekce_obcasnik}</h2>
  <div id=\"obal_sekce_obcasnik\">
    {$obcasnikobsah}
  </div>
</div>";
  return $result;
?>