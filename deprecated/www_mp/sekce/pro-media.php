<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $promediavlevo = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "pro-media", "subobsah" => "box-vlevo", "tvar" => "pro-media-vlevo"));
  $promediavpravo = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "pro-media", "subobsah" => "box-vpravo", "tvar" => "pro-media-vpravo"));
  $result =
  "<div id=\"sekce_pro_media\">
  <h2>{$nazvysekci->nazev_sekce_pro_media}</h2>
  <div id=\"obal_sekce_pro_media\">
    {$promediavlevo}
    {$promediavpravo}
  </div>
</div>\n";
  return $result;
?>