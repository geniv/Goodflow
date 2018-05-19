<?php
  $absolute_url = $this->var->absolutni_url;



$registraceform = $this->var->main[0]->NactiFunkci("DynamicRegistration", "RegistraceForm");

  $podminky = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "text-podminky");


/*


    //$tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "RegistraceForm");

    $tx[] = $this->var->main[0]->NactiFunkci("DynamicMail", "MailZachytavaniOdhlaseni");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaStrankach");

    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "LoginForm");
    //$tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "AktivniUzivatel");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "ProfileForm");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoPublicProfile");
    $tx[] = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoProfile");

//$text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearchForm");
//$text1 = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearch", array("loadstr" => array("adresa" => 4)));



*/





  $result =
  "

















<div id=\"sekce_registrace\">






<h2>Registrace <span>{račte vspoupit}</span></h2>



<div id=\"obal_sekce_registrace\">


{$registraceform}













<div id=\"podminky_registrace\">
<h3><span>+</span> Rozhodl jsi se vstoupit do Akademie mladých podnikatelů</h3>

{$podminky->podminky_registrace_text}

</div>


























</div>




</div>




































  ";
  return $result;
?>