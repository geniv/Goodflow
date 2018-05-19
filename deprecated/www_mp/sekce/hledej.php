<?php
  $absolute_url = $this->var->absolutni_url;







$hledej = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearch", array("loadstr" => array("adresa" => 4)));



  $result =
  "












<div id=\"sekce_profil\">







<h2>Výsledek hledání</h2>

<div style=\"margin: 0 30px 30px;\">

{$hledej}


</div>

</div>
















  ";
  return $result;
?>