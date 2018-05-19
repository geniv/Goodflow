<?php
  $absolute_url = $this->var->absolutni_url;
  $sekcedomu = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-domu");
  $fuckie67 = $this->var->main[0]->NactiFunkci("Funkce", "DetekceIExplorer", array(6, 7));

  $domuslider = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "domu-slider", "tvar" => "domu-slider"));
  $domuobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "domu-obsah", "tvar" => "domu-obsah"));

/*
  <div id=\"domu_obsah_oddil\">
    <div id=\"obsah_oddil\">
      <span id=\"otaznik_vice_o_mp\"><!-- --></span>
      <h2>Více o mladých podnikatelích</h2>
      <p>Obecně prospěšná společnost <strong style=\"font-size: 20px;\">Mladí podnikatelé</strong>, založená v roce 2010, zprostředkovává zajímavé názory odborníků a celkově tak napomáhá zvyšování lidského potenciálu. Cílem projektu je utváření <em>pozitivních životních postojů</em> a rozvojů těch, kteří mají zájem o rozšiřování si svých  obzorů a zkušeností.</p>
      <p>V současné době se Mladí podnikatelé zaměřují na besedy s úspěšnými lidmi, vzdělávacími <em>workshopy</em>, ale také na kulturní, sportovní a společenské akce, kde se angažují v  organizátorských rolích či jako mediální podporovatelé.</p>
      <a href=\"{$absolute_url}o-nas\" title=\"Přejít do sekce O nás\" style=\"display: block;\">Přejít do sekce O nás</a>
    </div>
    <div id=\"socialni_site_oddil\">
      <h2>Kde nás najdete</h2>
      <p id=\"socialni_prvni_oddil\">
        <a href=\"http://www.youtube.com/user/Mladipodnikatele2010?feature=mhum\" title=\"Youtube\" id=\"mp_youtube\"><!-- --></a>
        <a href=\"http://www.flickr.com/photos/54692385@N02/archives/\" title=\"Flickr\" id=\"mp_flickr\"><!-- --></a>
      </p>
      <p id=\"socialni_druhy_oddil\">
        <a href=\"http://www.facebook.com/home.php?#!/group.php?gid=162849187074480\" title=\"Facebook\" id=\"mp_facebook\"><!-- --></a>
        <a href=\"http://twitter.com/Mpodnikatele\" title=\"Twitter\" id=\"mp_twitter\"><!-- --></a>
        <a href=\"http://www.slideshare.net/Mpodnikatele/newsfeed\" title=\"Slideshare\" id=\"mp_slideshare\"><!-- --></a>
      </p>
    </div>
  </div>
  <div id=\"vybrano_z_webu_oddil\">
    <h2>Vybráno z webu</h2>
    <p>
      <a href=\"{$absolute_url}obcasnik\" title=\"News\">
        <span style=\"background-image: url({$absolute_url}4.png);\"><!-- --></span>
        <strong>News</strong>
      </a>
    </p>
    <p>
      <a href=\"http://www.flickr.com/photos/54692385@N02/archives/\" title=\"Fotografie\">
        <span style=\"background-image: url({$absolute_url}2.png);\"><!-- --></span>
        <strong>Fotografie</strong>
      </a>
    </p>
    <p>
      <a href=\"{$absolute_url}tiskovy-servis\" title=\"Tiskový servis\">
        <span style=\"background-image: url({$absolute_url}1.png);\"><!-- --></span>
        <strong>Tiskový servis</strong>
      </a>
    </p>
    <p>
      <a href=\"{$absolute_url}ke-stazeni\" title=\"Ke stažení\">
        <span style=\"background-image: url({$absolute_url}3.png);\"><!-- --></span>
        <strong>Ke stažení</strong>
      </a>
    </p>
    <p class=\"posledni_polozka\">
      <a href=\"{$absolute_url}akademie-mladych-podnikatelu\" title=\"Připoj se k nám\">
        <span style=\"background-image: url({$absolute_url}5.png);\"><!-- --></span>
        <strong>Připoj se k nám</strong>
      </a>
    </p>
  </div>
*/

  $result =
  "
".($fuckie67 ? "
<script type=\"text/javascript\">
  $().ready(function() {
    $('#coin-slider').codaSlider({
      autoSlide: true,
      autoSlideInterval: {$sekcedomu->domu_slider_delay}000,
      autoSlideStopWhenClicked: {$sekcedomu->domu_hoverpause},
      crossLinking: false,
      dynamicArrows: false,
      dynamicTabs: true,
      dynamicTabsAlign: 'right',
      dynamicTabsPosition: 'bottom',
      slideEaseDuration: 1000,
      slideEaseFunction: 'easeOutExpo'
    });
  });
</script>
" : "
<script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/coin-slider.min.js\"></script>
<script type=\"text/javascript\">
  $(document).ready(function(){
    $('#coin-slider').coinslider({ 
      width: 636,
      height: 250,
      navigation: true,
      delay: {$sekcedomu->domu_slider_delay}000,
      links: false,
      opacity: 1,
      sDelay: {$sekcedomu->domu_sdelay},
      titleSpeed: 500,
      effect: '{$sekcedomu->domu_slider_effect}',
      hoverPause: {$sekcedomu->domu_hoverpause}
    });
  });
</script>
")."
<div id=\"sekce_domu\">
  <div id=\"podklad_slider\">
    ".($fuckie67 ? "<div class=\"coda-slider-wrapper\">" : "")."
    <div id=\"coin-slider\"".($fuckie67 ? " class=\"coda-slider\"" : "").">
{$domuslider}
    </div>
    ".($fuckie67 ? "</div>" : "")."
  </div>
{$domuobsah}
  <div id=\"bannery_oddil\" style=\"display: {$sekcedomu->viditelnost_bannery_oddil};\">
    <p id=\"mp_banner_1\">BANNER</p>
    <p id=\"mp_banner_2\">BANNER</p>
    <p id=\"mp_banner_3\">BANNER</p>
  </div>
</div>\n";

  return $result;
?>