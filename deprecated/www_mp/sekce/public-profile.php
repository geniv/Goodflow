<?php
  $absolute_url = $this->var->absolutni_url;





$infoprofil = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoPublicProfile");




  $result =
  "




<div id=\"sekce_profil\">

{$infoprofil}




</div>


  ";
  return $result;
?>
