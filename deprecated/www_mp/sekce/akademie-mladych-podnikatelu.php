<?php
  $absolute_url = $this->var->absolutni_url;
  $sekceamp = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-amp");
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $ampobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "amp-obsah", "tvar" => "amp-obsah"));
/*
<div id=\"amp_blok_text\">
  <h3><span>+</span> Co nabízí Akademie mladých podnikatelů?</h3>
  <p>Cílem akademie Mladých podnikatelů je rozvíjet dovednostní potenciál studentů středních a vysokých škol a pomoci jim tak při uplatnění se na pracovním trhu.</p>
  <p>Akademii Mladých podnikatelů tvoří členové, kteří chtějí rozvíjet své dovednosti a schopnosti díky vedení, koordinaci a strategii dílčích projektů, kde se seznamují s reálným pracovním životem a všemi relevantními náležitostmi, poukazujícími na to, jak být úspěšným stratégem a managerem. Získávání zkušeností, dotahování projektů do úspěšného konce, rozvoj dovedností v oblastech marketingu, managementu, public relations či media relations se řadí mezi základní dovednosti, které může každý člen uplatnit během své budoucí pracovní kariéry.</p>
  <p>Nejlepší členy akademie čeká řada výhod a pracovních zkušeností. Zmíněným členům akademie zajišťujeme stáže ve firmách (v některých případech také možnosti získat pracovní pozice), besedy se zajímavými lidmi, specializované workshopy a případové studie, které nabídnou členům přímou konfrontaci s reálnými příklady z pracovního prostředí.</p>
  <div id=\"amp_blok_text_levy\">
    <h3><span>+</span> Bodový systém</h3>
    <p>V současné době patří Bodový systém mezi interní materiály, proto je tento materiál pro širokou veřejnost nedostupný. Děkujeme za pochopení.</p>
  </div>
  <div id=\"amp_blok_text_pravy\">
    <h3><span>+</span> Chci se stát členem akademie</h3>
    <p>Zaujala vás myšlenka Mladých podnikatelů a rád by jste se staly členy? Neváhejte a klikněte.</p>
  </div>
</div>
<div id=\"amp_blok_slider\">
  <a href=\"registrace\" title=\"\" id=\"amp_registrovat\"><!-- --></a>
  <div id=\"amp_slider\">
    <span id=\"podklad_pluska\"><!-- --></span>
    <div class=\"coda-slider-amp\" id=\"amp-slider\">
      <div class=\"panel\">
        <div class=\"panel-wrapper\">
          <img src=\"{$absolute_url}amp_1.png\" alt=\"\" />
        </div>
      </div>
      <div class=\"panel\">
        <div class=\"panel-wrapper\">
          <img src=\"{$absolute_url}amp_2.png\" alt=\"\" />
        </div>
      </div>
      <div class=\"panel\">
        <div class=\"panel-wrapper\">
          <img src=\"{$absolute_url}amp_3.png\" alt=\"\" />
        </div>
      </div>
      <div class=\"panel\">
        <div class=\"panel-wrapper\">
          <img src=\"{$absolute_url}amp_4.png\" alt=\"\" />
        </div>
      </div>
    </div>
  </div>
</div>
*/
  $result =
  "
<script type=\"text/javascript\">
  $().ready(function() {
    $('#amp-slider').codaSlider({
      autoHeight: false,
      autoSlide: {$sekceamp->amp_autoslide},
      autoSlideInterval: {$sekceamp->amp_autoslideinterval}000,
      autoSlideStopWhenClicked: {$sekceamp->amp_autoslidestopwhenclicked},
      crossLinking: false,
      dynamicArrows: false,
      dynamicTabs: true,
      dynamicTabsAlign: 'right',
      dynamicTabsPosition: 'bottom',
      firstPanelToLoad: {$sekceamp->amp_firstpaneltoload},
      slideEaseDuration: {$sekceamp->amp_slideeaseduration},
      slideEaseFunction: '{$sekceamp->amp_slideeasefunction}'
    });
  });
</script>
<div id=\"sekce_amp\">
  <h2>{$nazvysekci->nazev_sekce_akademie_mladych_podnikatelu}</h2>
  <div id=\"obal_sekce_amp\">
{$ampobsah}
  </div>
</div>\n";
  return $result;
?>