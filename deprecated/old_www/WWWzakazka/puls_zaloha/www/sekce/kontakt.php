<?php
  $absolute_url = $this->var->absolutni_url;
  //$sekceamp = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-amp");
  //$nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  //$ampobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "amp-obsah", "tvar" => "amp-obsah"));

$centralniobsah = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "centralni-obsah");

$formular = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "formular-kontakt");

  $result =
  "







<div id=\"obal_kontakt\">




<div id=\"obal_formular\">

<p>
{$centralniobsah->kontakt_text}

<br /><br />
</p>


{$formular}



</div>





<div id=\"obal_kontaktni_informace\">

<div id=\"kontaktni_informace_studio_puls\">

<h2>{$centralniobsah->studio_puls_nazev}</h2>

<a href=\"{$absolute_url}salon\" title=\"» PODROBNÉ INFO O SALONU\">» PODROBNÉ INFO O SALONU</a>

<p>{$centralniobsah->studio_puls_adresa_1}</p>
<p>{$centralniobsah->studio_puls_adresa_2}</p>
<p>Tel: {$centralniobsah->studio_puls_tel}</p>
<p>Email: {$centralniobsah->studio_puls_email}</p>
<p>Skype: {$centralniobsah->studio_puls_skype}</p>





</div>











</div>










</div>















";
  return $result;
?>