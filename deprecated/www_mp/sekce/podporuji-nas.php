<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $podporujinas = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "podporuji-nas", "tvar" => "podporuji-nas"));
  $result =
  "<div id=\"sekce_podporuji_nas\">
  <h2>{$nazvysekci->nazev_sekce_podporuji_nas}</h2>
  <div id=\"obal_sekce_podporuji_nas\">
    {$podporujinas}
  </div>
</div>\n";
  return $result;
?>