<?php
  $absolute_url = $this->var->absolutni_url;






$upravitprofil = $this->var->main[0]->NactiFunkci("DynamicRegistration", "ProfileForm");




  $result =
  "

















<div id=\"sekce_upravit_profil\">



{$upravitprofil}




















</div>




</div>




































  ";
  return $result;
?>