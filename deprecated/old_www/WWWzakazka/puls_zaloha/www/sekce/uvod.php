<?php
  $absolute_url = $this->var->absolutni_url;
  //$sekceamp = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-amp");
  //$nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $indexslider = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "index-slider", "tvar" => "index-slider"));
  
  $centralniobsah = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "centralni-obsah");
  $aktualityindex = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "aktuality", "tvar" => "aktuality-index"));
  $galerieucesuindex = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "galerie-ucesu", "tvar" => "galerie-ucesu-index"));
  
  /* {$centralniobsah->salon_puls_nazev} */

  $result =
  "<script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/coin-slider-uvod.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('#coin-slider').coinslider({
      width: 824,
      height: 264,
      spw: 7,
      sph: 5,
      delay: 3000,
      sDelay: 30,
      opacity: 1,
      titleSpeed: 500,
      effect: '',
      navigation: true,
      links : true,
      hoverPause: true
    });
  });
</script>
<div id=\"obal_coin_slider_index\">
  <div id=\"coin-slider\">



{$indexslider}





  </div>
</div>












<script type=\"text/javascript\">
  $(document).ready(function(){


$('#galerie_ucesu_obsah').cycle({ 
    fx:     'fade', 
    timeout: 6000, 
    delay:  -2000 
});


$('#aktuality_obsah').cycle({ 
    fx:     'scrollHorz', 
    timeout: 0, 


    next:   '#aktuality_sipka_vpravo', 
    prev:   '#aktuality_sipka_vlevo'


});












$('#kontakty_obsah').cycle({ 
    fx:     'scrollHorz',
    timeout: 0, 
    pager:  '#kontakty_nadpis',

activePagerClass: 'kontakty_aktivni',




});





/*
    * blindX
    * blindY
    * blindZ
    * cover
    * curtainX
    * curtainY
    * fade
    * fadeZoom
    * growX
    * growY
    * none
    * scrollUp
    * scrollDown
    * scrollLeft
    * scrollRight
    * scrollHorz
    * scrollVert
    * shuffle
    * slideX
    * slideY
    * toss
    * turnUp
    * turnDown
    * turnLeft
    * turnRight
    * uncover
    * wipe
    * zoom
*/








  });
</script>





<div id=\"obal_aktuality_galerie_ucesu\">

<div id=\"obal_aktuality\">



<span id=\"aktuality_nadpis\"><!-- --></span>



<a href=\"#\" title=\"\" id=\"aktuality_sipka_vlevo\"><!-- --></a>


<div id=\"aktuality_obsah\">




{$aktualityindex}








</div>


<a href=\"#\" title=\"\" id=\"aktuality_sipka_vpravo\"><!-- --></a>



<div id=\"obal_kontakty\">




<div id=\"kontakty_nadpis\">

</div>



<div id=\"kontakty_obsah\">


<div>


<div class=\"levy_blok\">

<strong>Adresa</strong>
<p>{$centralniobsah->studio_puls_nazev}</p>
<p>{$centralniobsah->studio_puls_adresa_1}</p>
<p>{$centralniobsah->studio_puls_adresa_2}</p>



</div>


<div class=\"pravy_blok\">


<strong>Kontakt</strong>
<p>Tel: {$centralniobsah->studio_puls_tel}</p>
<p>Email: {$centralniobsah->studio_puls_email}</p>
<p>Skype: {$centralniobsah->studio_puls_skype}</p>


</div>



</div>





</div>







</div>




</div>









<div id=\"obal_galerie_ucesu\">



<span id=\"galerie_ucesu_nadpis\"><!-- --></span>

<div id=\"galerie_ucesu_obsah\">
{$galerieucesuindex}


</div>



</div>







</div>

";
  return $result;
?>