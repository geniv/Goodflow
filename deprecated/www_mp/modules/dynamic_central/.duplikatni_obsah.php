<?php

/* -------------------------------------------------------------------------- */

  $result = array(

/* - - - - - - - - - - Normal výpis default - - - - - - - - - - */

                  "admin_obsah_sablony_add" => "
  <a href=\"%%1%%\" title=\"Přidat\" class=\"addobsah tlacitko-2 fl-l m-b-15 barva-1\">
    <span class=\"tlacitko-pattern\"><!-- --></span>
    <span class=\"tlacitko-text\">Přidat</span>
  </a>\n",

                  "admin_obsah_sablony" => "
<div class=\"obal_dyncent__%%1%%\">
  <div class=\"obal-nadpisy-sekce m-b-15 p-t-5 p-b-5\">
    <h3 class=\"nadpis-sekce upc f-s-30\">%%3%%</h3>
    <h4 class=\"pod-nadpis-sekce f-s-17 f-f-web-pro\">%%4%%<!-- --></h4>
  </div>
%%2%%
  <div class=\"cl-b pos-rel fw-around\">
    %%5%%
  </div>
</div>\n",

                  "normal_vypis_obal" => "%%vypis%%",

                  "normal_vypis_obal_null" => "<strong style=\"display: block; text-align: center;\">Není vložen obsah</strong>",

                  "admin_vypis_obsah_sablony_copy" => "<a href=\"%%1%%\" title=\"Duplikovat\" class=\"copyobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Duplikovat</a>",

                  "admin_vypis_obsah_sablony_del" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat obsah: &quot;%%1%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

/* - - - - - - - - - - /Normal výpis default - - - - - - - - - - */

/* - - - - - - - - - - Normal výpis - - - - - - - - - - */

                  "normal_vypis=domu-slider" => "
      <div class=\"panel\">
        <div class=\"panel-wrapper\">
          <img src=\"%%18%%\" alt=\"%%10%%\" />
          <p>
            <strong>%%10%%</strong>
            <span>%%11%%</span>
            %%13%%
          </p>
        </div>
      </div>\n",

                  "normal_vypis_url=domu-slider" => "<a href=\"%%1%%\" title=\"%%2%%\"%%3%%>» %%2%%</a>",

                  "admin_vypis_obsah_sablony_del=1" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat obsah: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=1" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><a href=\"%%13%%\" title=\"%%14%%\" class=\"odkaz-3 no-u\">» %%14%%</a></span></li>
  <li class=\"polozka-1-lichy p-t-20 p-r-10 p-b-20 p-l-7 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%16%%\" alt=\"%%10%%\" class=\"block m-l-30\" /></span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_url=domu-obsah" => "<a href=\"%%1%%\" title=\"%%2%%\"%%3%%>",

                  "normal_vypis=domu-obsah" => "
  <div id=\"domu_obsah_oddil\">
    <div id=\"obsah_oddil\">
      <span id=\"otaznik_vice_o_mp\"><!-- --></span>
%%10%%
      <a href=\"%%absolutni_url%%o-nas\" title=\"Přejít do sekce O nás\" style=\"display: %%11%%;\">Přejít do sekce O nás</a>
    </div>
    <div id=\"socialni_site_oddil\">
      <h2>%%12%%</h2>
      <p id=\"socialni_prvni_oddil\">
        <a href=\"%%14%%\" title=\"%%15%%\" id=\"mp_youtube\"%%16%%><!-- --></a>
        <a href=\"%%18%%\" title=\"%%19%%\" id=\"mp_flickr\"%%20%%><!-- --></a>
      </p>
      <p id=\"socialni_druhy_oddil\">
        <a href=\"%%22%%\" title=\"%%23%%\" id=\"mp_facebook\"%%24%%><!-- --></a>
        <a href=\"%%26%%\" title=\"%%27%%\" id=\"mp_twitter\"%%28%%><!-- --></a>
        <a href=\"%%30%%\" title=\"%%31%%\" id=\"mp_slideshare\"%%32%%><!-- --></a>
      </p>
    </div>
  </div>
  <div id=\"vybrano_z_webu_oddil\">
    <h2>%%33%%</h2>
    <p>
      %%34%%
        <span style=\"background-image: url(%%39%%);\"><!-- --></span>
        <strong>%%36%%</strong>
      </a>
    </p>
    <p>
      %%44%%
        <span style=\"background-image: url(%%49%%);\"><!-- --></span>
        <strong>%%46%%</strong>
      </a>
    </p>
    <p>
      %%54%%
        <span style=\"background-image: url(%%59%%);\"><!-- --></span>
        <strong>%%56%%</strong>
      </a>
    </p>
    <p>
      %%64%%
        <span style=\"background-image: url(%%69%%);\"><!-- --></span>
        <strong>%%66%%</strong>
      </a>
    </p>
    <p class=\"posledni_polozka\">
      %%74%%
        <span style=\"background-image: url(%%79%%);\"><!-- --></span>
        <strong>%%76%%</strong>
      </a>
    </p>
  </div>\n",

                  "admin_vypis_obsah_sablony=2" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 ow-h\"><span class=\"fl-l\">Domů - obsah</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%10%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%15%%: %%14%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%18%%: %%17%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%21%%: %%20%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%24%%: %%23%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%27%%: %%26%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_oneseriefoto_row=amp-obsah" => "
      <div class=\"panel\">
        <div class=\"panel-wrapper\">
          <img src=\"%%1%%\" alt=\"%%2%%\" />
        </div>
      </div>\n",

                  "normal_vypis=amp-obsah" => "
<div id=\"amp_blok_text\">
  <h3><span>+</span> %%10%%</h3>
%%11%%
  <div id=\"amp_blok_text_levy\">
    <h3><span>+</span> %%12%%</h3>
    %%13%%
  </div>
  <div id=\"amp_blok_text_pravy\">
    <h3><span>+</span> %%14%%</h3>
    %%15%%
  </div>
</div>
<div id=\"amp_blok_slider\">
  <a href=\"registrace\" title=\"\" id=\"amp_registrovat\"><!-- --></a>
  <div id=\"amp_slider\">
    <span id=\"podklad_pluska\"><!-- --></span>
    <div class=\"coda-slider-amp\" id=\"amp-slider\">
%%16%%
    </div>
  </div>
</div>\n",

                  "admin_vypis_obsah_sablony=3" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%13%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%14%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%16%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%17%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-20 p-l-15 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%19%%</span></li>
</ul>\n",

                  "admin_vypis_obsah_sablony_oneseriefoto=3" => "<img src=\"%%1%%\" alt=\"%%2%%\" class=\"block fl-l m-t-20 m-l-20\" />",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_obal=o-nas-obsah" => "
<div id=\"sekce_o_nas\">
  <h2>%%nazevsekceonas%%</h2>
  <div id=\"obal_kdo_jsme\">
    %%vypis%%
  </div>\n",

                  "normal_vypis=o-nas-obsah" => "
    <a href=\"%%11%%\" title=\"%%22%%\">
      <span class=\"foto_sprit\" style=\"background-image: url(%%15%%);\"><!-- --></span>
      <strong>%%22%%</strong>
    </a>\n",

                  "normal_rozkliknuty_vypis_obal=o-nas-obsah" => "
<div id=\"sekce_o_nas_clen\">
  <h2>%%nazevsekceonas%%</h2>
  <div id=\"obal_kdo_jsme_clen\">
    %%vypis%%
  </div>\n",

                  "normal_rozkliknuty_vypis=o-nas-obsah" => "
<div id=\"obal_clen_foto\">
  <p>
    <img src=\"%%21%%\" alt=\"%%22%%\" />
  </p>
</div>
<div id=\"obal_clen_obsah\">
  <h3>%%22%%</h3>
  <h4>Věk</h4>
  <p>%%23%%</p>
  <h4>Krédo</h4>
  <p>%%24%%</p>
  <h4>Funkce</h4>
  <p>%%25%%</p>
  <h4>Cíle</h4>
  %%26%%
  <h4>Čím se hodlám zabývat</h4>
  <p>%%27%%</p>
  <h4>Vzdělání</h4>
  %%28%%
  <h4>Profesní zkušenosti</h4>
  %%29%%
  <h4>Kontakt</h4>
  <div id=\"obal_kontaktni_info\">
    <div class=\"sloupec_kontaktni_info\">
      <p>
        <strong>Telefon</strong>
      </p>
      <p>%%30%%</p>
      <p>
        <strong>Mobil</strong>
      </p>
      <p>%%31%%</p>
    </div>
    <div class=\"sloupec_kontaktni_info\">
      <p>
        <strong>Mail</strong>
      </p>
      <p>%%32%%</p>
      <p>
        <strong>Skype</strong>
      </p>
      <p>%%33%%</p>
    </div>
  </div>
</div>\n",

                  "admin_vypis_obsah_sablony=4" => "
<div class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <ul>
    <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%15%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
  %%4%%
    <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
    <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  </ul>
  <div class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\">
    <span class=\"fl-l block\" style=\"width: 227px; height: 281px; background: url(%%12%%) no-repeat right top;\"></span>
    <div class=\"fl-l block w-460 m-l-3\">
      <h4 class=\"f-s-16\">Věk</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%16%%</p>
      <h4 class=\"f-s-16\">Krédo</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%17%%</p>
      <h4 class=\"f-s-16\">Funkce</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%18%%</p>
      <h4 class=\"f-s-16\">Cíle</h4>
      <div class=\"m-b-6 m-l-6 f-s-12\">%%19%%</div>
      <h4 class=\"f-s-16\">Čím se hodlám zabývat</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%21%%</p>
      <h4 class=\"f-s-16\">Vzdělání</h4>
      <div class=\"m-b-6 m-l-6 f-s-12\">%%22%%</div>
      <h4 class=\"f-s-16\">Profesní zkušenosti</h4>
      <div class=\"m-b-6 m-l-6 f-s-12\">%%24%%</div>
      <h4 class=\"f-s-16\">Telefon</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%26%%</p>
      <h4 class=\"f-s-16\">Mobil</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%27%%</p>
      <h4 class=\"f-s-16\">Mail</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%28%%</p>
      <h4 class=\"f-s-16\">Skype</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%29%%</p>
    </div>
  </div>
</div>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis=o-nas-fotky" => "
    <a href=\"%%13%%\" class=\"highslide\" title=\"%%10%%\" onclick=\"return hs.expand(this, config1 )\">
      <span style=\"background: url(%%12%%) no-repeat center center;\"></span>
    </a>\n",

                  "admin_vypis_obsah_sablony_del=5" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=5" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15 w-320 h-360 fl-l m-l-20\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Přidáno:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Upraveno:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-10 p-r-10 p-b-10 p-l-15 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%11%%\" alt=\"%%10%%\" class=\"block\" /></span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_menu_aktivni=tiskovy-servis-menu" => array("tsaktivni" => " class=\"aktivni\""),

                  "normal_vypis_menu=tiskovy-servis-menu" => "<h3%%tsaktivni%%><a href=\"%%url%%\" title=\"%%nazev%%\">%%nazev%%</a></h3>",

                  "normal_vypis_obal=tiskovy-servis-obsah" => "<div id=\"tiskovy_servis_obal_sekce\">%%vypis%%</div>%%strankovani%%",

                  "normal_vypis_onefoto=tiskovy-servis-obsah" => "<img src=\"%%1%%\" alt=\"\" />",

                  "normal_vypis=tiskovy-servis-obsah" => "
  <div class=\"tiskovy_servis_clanek\">
    <div class=\"tiskovy_servis_clanek_levy\">
      %%10%%
      <p>%%12%%</p>
      <p>%%13%%</p>
    </div>
    <div class=\"tiskovy_servis_clanek_pravy\">
      %%14%%
    </div>
    <p class=\"cely_clanek_odkaz\">
      <a href=\"%%16%%\" title=\"%%17%%\"%%18%%>Celý článek</a>
    </p>
  </div>\n",

                  "admin_vypis_obsah_sablony_del=6" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%5%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=6" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%12%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%10%%\" alt=\"%%12%%\" /></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%13%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%15%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_menu_aktivni=pozvanky-menu" => array("paktivni" => " class=\"aktivni\""),

                  "normal_vypis_menu=pozvanky-menu" => "<h4%%paktivni%%><a href=\"%%url%%\" title=\"%%nazev%%\">+ %%nazev%%</a></h4>",

                  "normal_vypis_onefoto=pozvanky-obsah" => "<img src=\"%%1%%\" alt=\"\" />",

                  "normal_vypis_obal=pozvanky-obsah" => "%%vypis%%%%strankovani%%",

                  "normal_rozkliknuty_vypis_obal=pozvanky-obsah" => "%%vypis%%",

                  "normal_vypis_rewrite=pozvanky-obsah" => "<a href=\"%%2%%\" title=\"%%1%%\">Celý článek</a>",

                  "normal_vypis=pozvanky-obsah" => "
<div class=\"pozvanky_obsah_polozka\">
  <h3>%%12%%</h3>
  <p class=\"popis\">%%14%% / %%15%%</p>
  <p class=\"obr_a_info\">
    %%17%%
    <em>
      <span>KDE</span>
    </em>
    <strong>
      <span>%%19%%</span>
    </strong>
    <em>
      <span>KDY</span>
    </em>
    <strong>
      <span>%%20%%</span>
    </strong>
    <em>
      <span>CENA</span>
    </em>
    <strong>
      <span>%%21%%</span>
    </strong>
  </p>
  <div class=\"kratky_popis_clanku\">
    %%22%%
  </div>
  <p class=\"cely_clanek_odkaz\" style=\"display: %%23%%;\">
    %%10%%
  </p>
</div>\n",

                  "normal_rozkliknuty_vypis=pozvanky-obsah" => "
<div id=\"pozvanky_cely_clanek\">
  <h3>%%12%%</h3>
  %%24%%
  <p id=\"info_clanek\">%%14%% / %%15%%<span>%%16%%</span></p>
  <div id=\"dlouhy_popis_clanku\">
    %%26%%
  </div>
</div>\n",

                  "admin_vypis_obsah_sablony_del=10" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=10" => "
<div class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <ul>
    <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
  %%4%%
    <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
    <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  </ul>
  <div class=\"polozka-1-lichy p-t-9 p-r-10 p-b-3 p-l-10 ow-h f-s-14\">
    <img src=\"%%15%%\" alt=\"\" class=\"fl-l block\" />
    <div class=\"fl-l block w-360 m-l-10\">
      <h4 class=\"f-s-16\">Autor</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%13%%</p>
      <h4 class=\"f-s-16\">Zdroj</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%14%%</p>
      <h4 class=\"f-s-16\">Kde</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%16%%</p>
      <h4 class=\"f-s-16\">Kdy</h4>
      <div class=\"m-b-6 m-l-6 f-s-12\">%%17%%</div>
      <h4 class=\"f-s-16\">Cena</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%18%%</p>
    </div>
  </div>
  <ul>
    <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%19%%</span></li>
  </ul>
</div>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_menu_aktivni=tipy-menu" => array("paktivni" => " class=\"aktivni\""),

                  "normal_vypis_menu=tipy-menu" => "<h4%%paktivni%%><a href=\"%%url%%\" title=\"%%nazev%%\">+ %%nazev%%</a></h4>",

                  "normal_vypis_onefoto=tipy-obsah" => "<img src=\"%%1%%\" alt=\"\" />",

                  "normal_vypis_obal=tipy-obsah" => "%%vypis%%%%strankovani%%",

                  "normal_rozkliknuty_vypis_obal=tipy-obsah" => "%%vypis%%",

                  "normal_vypis_rewrite=tipy-obsah" => "<a href=\"%%2%%\" title=\"%%1%%\">Celý článek</a>",

                  "normal_vypis_ente_od=tipy-obsah" => array("kazda_druha" => 1),

                  "normal_vypis_ente_po=tipy-obsah" => array("kazda_druha" => 2),

                  "normal_vypis_ente_break=tipy-obsah" => array("kazda_druha" => 0),

                  "normal_vypis_begin_poc=tipy-obsah" => array("kazda_druha" => 1),

                  "normal_vypis_ente=tipy-obsah" => array("kazda_druha" => " tipy_obsah_polozka_prava"),

                  "normal_vypis=tipy-obsah" => "
<div class=\"tipy_obsah_polozka%%kazda_druha%%\">
  %%17%%
  <h3>%%12%%</h3>
  <p class=\"popis\">%%14%% <span>%%15%%</span></p>
  <p class=\"popis\">%%16%%</p>
  <div class=\"kratky_popis_clanku\">
    %%19%%
  </div>
  <p class=\"cely_clanek_odkaz\" style=\"display: %%20%%;\">
    %%10%%
  </p>
</div>\n",

                  "normal_rozkliknuty_vypis=tipy-obsah" => "
<div id=\"tipy_cely_clanek\">
  <h3>%%12%%</h3>
  %%21%%
  <p id=\"info_clanek\">%%14%% / %%15%%<span>%%16%%</span></p>
  <div id=\"dlouhy_popis_clanku\">
    %%23%%
  </div>
</div>\n",

                  "admin_vypis_obsah_sablony_del=13" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=13" => "
<div class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <ul>
    <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
  %%4%%
    <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
    <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  </ul>
  <div class=\"polozka-1-lichy p-t-9 p-r-10 p-b-9 p-l-10 ow-h f-s-14\">
    <img src=\"%%15%%\" alt=\"\" class=\"fl-l block\" />
    <div class=\"fl-l block w-360 m-l-10\">
      <h4 class=\"f-s-16\">Autor</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%13%%</p>
      <h4 class=\"f-s-16\">Zdroj</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%14%%</p>
      <h4 class=\"f-s-16\">Krátký text</h4>
      <p class=\"m-b-6 m-l-6 f-s-12\">%%16%%</p>
    </div>
  </div>
</div>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_ente_od=podporuji-nas" => array("kazda_ctvrta" => 1),

                  "normal_vypis_ente_po=podporuji-nas" => array("kazda_ctvrta" => 4),

                  "normal_vypis_ente_break=podporuji-nas" => array("kazda_ctvrta" => 0),

                  "normal_vypis_begin_poc=podporuji-nas" => array("kazda_ctvrta" => 1),

                  "normal_vypis_ente=podporuji-nas" => array("kazda_ctvrta" => " polozka_partner_posledni"),

                  "normal_vypis=podporuji-nas" => "
<div class=\"polozka_partner%%kazda_ctvrta%%\">
  <a href=\"%%13%%\" title=\"%%14%%\"%%15%%>
    <span style=\"background-image: url(%%11%%);\"><!-- --></span>
    <strong>%%14%%</strong>
  </a>
</div>\n",

                  "admin_vypis_obsah_sablony_del=14" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%5%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=14" => "
<ul class=\"f-f-web-pro f-s-14 m-b-25 w-260 h-320 fl-l m-l-50\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\" style=\"height: 35px;\"><span class=\"fl-l\">%%12%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Přidáno:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Upraveno:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"block barva-4\" style=\"background-color: #dde7ef;\"><span class=\"block m-auto\" style=\"width: 225px; height: 200px; background: url(%%10%%) no-repeat center center;\"></span></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_menu=ke-stazeni-menu" => "<h3 class=\"%%avm%%%%tm%%%%aktivni%%\"><a href=\"%%url%%\" title=\"%%nazev%%\">%%nazev%%</a></h3>",

                  "normal_vypis_menu_aktivni=ke-stazeni-menu" => array("aktivni" => " aktivni"),

                  "normal_vypis_menu_ente_def_array=ke-stazeni-menu" => array("avm" => array(1), "tm" => array(2)),

                  "normal_vypis_menu_ente_def=ke-stazeni-menu" => array("avm" => "audiovizualni_materialy", "tm" => "textove_materialy"),

                  "normal_vypis_obal_null=ke-stazeni-obsah" => "<strong style=\"display: block; height: 200px; line-height: 200px; text-align: center;\">Není vložen obsah</strong>",

                  "normal_vypis_externalfile_row=ke-stazeni-obsah" => "
<h4>%%7%%<span>%%6%%</span></h4>
<p class=\"ke_stazeni_info_zahlavi\">
  %%8%%<br />
  <span>%%4%%</span> soubor
</p>
<div class=\"ke_stazeni_polozka_popis\">
  %%9%%
</div>
<p class=\"ke_stazeni_download\">
  <a href=\"%%1%%\" title=\"%%7%%\">Stáhnout</a>
</p>",

                  "normal_vypis_obal=ke-stazeni-obsah" => "%%vypis%%%%strankovani%%",

                  "normal_vypis=ke-stazeni-obsah" => "%%13%%",

                  "admin_vypis_obsah_sablony_externalfile=8" => "<img src=\"obr/admin/datovy_sklad_ikony/%%3%%.png\" alt=\"%%1%%\" class=\"block\" /><span class=\"block m-t-2\">%%1%%</span>",

                  "admin_vypis_obsah_sablony_del=8" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=8" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%12%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%14%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_menu_obal=obcasnik-obsah" => "<div class=\"obcasnik_obal_polozky\">
<h3>%%1%%</h3>
%%2%%
</div>\n",

                  "normal_vypis_externalfile_row=obcasnik-obsah" => "
<a href=\"%%1%%\" title=\"%%7%%\">
  <span class=\"detekce_prvniho_obcasnik\"><!-- --></span>
  <img src=\"%%10%%\" alt=\"%%7%%\" />
  <strong class=\"nazev_obcasnik\">
    <span class=\"podklad_obcasnik\"><!-- --></span>
    <span class=\"text_obcasnik\">
      %%7%%
    </span>
  </strong>
  <span class=\"stahnout_obcasnik\">
    <span class=\"podklad_obcasnik\"><!-- --></span>
    <span class=\"text_obcasnik\">
      stáhnout %%4%%
    </span>
  </span>
  <span class=\"datum_obcasnik\">
    <span class=\"podklad_obcasnik\"><!-- --></span>
    <span class=\"text_obcasnik\">
      %%8%%
    </span>
  </span>
</a>\n",

                  "normal_vypis_ente_od=obcasnik-obsah" => array("kazda_pata" => 1),

                  "normal_vypis_ente_po=obcasnik-obsah" => array("kazda_pata" => 5),

                  "normal_vypis_ente_break=obcasnik-obsah" => array("kazda_pata" => 0),

                  "normal_vypis_begin_poc=obcasnik-obsah" => array("kazda_pata" => 1),

                  "normal_vypis_ente=obcasnik-obsah" => array("kazda_pata" => " posledni"),

                  "normal_vypis=obcasnik-obsah" => "<p class=\"%%subprvni%%%%kazda_pata%%\">%%13%%</p>",

                  "admin_vypis_obsah_sablony_externalfile=9" => "<img src=\"obr/admin/datovy_sklad_ikony/%%3%%.png\" alt=\"%%1%%\" class=\"block\" /><span class=\"block m-t-2\">%%1%%</span>",

                  "admin_vypis_obsah_sablony_del=9" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=9" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%12%%\" alt=\"%%10%%\" class=\"block\" /></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%13%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis=pro-media-vlevo" => "
<div id=\"pro_media_obal_sekce\">
  <h3><span>+</span> %%10%%</h3>
  %%11%%
</div>\n",

                  "normal_vypis_download_row=pro-media-vpravo" => "<a href=\"%%1%%\" title=\"%%3%%\">%%3%%&nbsp;</a>",

                  "normal_vypis=pro-media-vpravo" => "
<div class=\"pro_media_obal_menu\">
  <h3><span>+</span> %%10%%</h3>
  %%11%%
</div>\n",

                  "admin_vypis_obsah_sablony_download=16" => "<img src=\"obr/admin/datovy_sklad_ikony/%%5%%.png\" alt=\"%%3%%\" class=\"block m-t-10\" /><span class=\"block m-t-2 m-b-10\">%%3%%</span>",

                  "admin_vypis_obsah_sablony_del=16" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=16" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%11%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_menu_aktivni=projekty-menu" => array("aktivnisub" => " class=\"aktivni\""),

                  "normal_vypis_menu=projekty-menu" => "<h4%%aktivnisub%%><a href=\"%%url%%\" title=\"%%nazev%%\">++ %%nazev%%</a></h4>",

                  "normal_vypis_obal=aktualni-projekty" => "%%vypis%%%%strankovani%%",

                  "normal_vypis_onefoto=aktualni-projekty" => "<img src=\"%%1%%\" alt=\"\" />",

                  "normal_vypis=aktualni-projekty" => "
<div class=\"projekty_obsah_polozka\">
  <h3>%%12%%</h3>
  <p class=\"popis\">%%14%% / %%15%%</p>
  <div class=\"obr_a_info\">
    %%16%%
    %%18%%
  </div>
  <p class=\"cely_popis_odkaz\" style=\"display: %%19%%;\">
    <a href=\"%%11%%\" title=\"Zobrazit celý popis projektu\">Zobrazit celý popis projektu</a>
  </p>
</div>\n",

                  "normal_vypis_obal=projekty-menu" => "
<div class=\"projekty_historie_polozka\">
  <h3>Seznam projektů</h3>
  <p>
%%vypis%%
  </p>
</div>\n",

                  "normal_vypis=projekty-menu" => "<a href=\"%%11%%\" title=\"%%12%%\">%%14%% <span>|</span> %%12%%</a>",

                  "normal_rozkliknuty_vypis_obal=projekty-menu" => "%%vypis%%",

                  "normal_vypis_onefoto=projekty-menu" => "<img src=\"%%1%%\" alt=\"\" />",

                  "normal_rozkliknuty_vypis=projekty-menu" => "
<div id=\"projekty_cely_popis\">
  <h3>%%12%%</h3>
  %%20%%
  <p id=\"info_projekt\">%%14%% / %%15%%</p>
  <div id=\"dlouhy_popis_projektu\">
    %%22%%
  </div>
</div>\n",

                  "normal_rozkliknuty_vypis_obal=aktualni-projekty" => "%%vypis%%",

                  "normal_rozkliknuty_vypis=aktualni-projekty" => "
<div id=\"projekty_cely_popis\">
  <h3>%%12%%</h3>
  %%20%%
  <p id=\"info_projekt\">%%14%% / %%15%%</p>
  <div id=\"dlouhy_popis_projektu\">
    %%22%%
  </div>
</div>\n",

                  "admin_vypis_obsah_sablony_del=15" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat obsah: &quot;%%3%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=15" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\"><span class=\"fl-l\">%%10%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah přidán:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Obsah upraven:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%12%% / %%13%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\"><img src=\"%%14%%\" alt=\"%%10%%\" class=\"block\" /></span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%15%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_vypis_prvni=zapati-partneri" => array("prvnicoda" => "            <div class=\"coda-slider-partneri\" id=\"partneri-projektu-slider\">
              <div class=\"panel\">
                <div class=\"panel-wrapper\">\n"),


                  "normal_vypis_posledni=zapati-partneri" => array("poslednicoda" => "                </div>
              </div>
            </div>"),

                  "normal_vypis_ente_od=zapati-partneri" => array("rozdelovac" => 1, "rozdelovacposledni" => 1),

                  "normal_vypis_ente_po=zapati-partneri" => array("rozdelovac" => 5, "rozdelovacposledni" => 4),

                  "normal_vypis_ente_break=zapati-partneri" => array("rozdelovac" => 0, "rozdelovacposledni" => 0),

                  "normal_vypis_begin_poc=zapati-partneri" => array("rozdelovac" => 1, "rozdelovacposledni" => 1),

                  "normal_vypis_ente=zapati-partneri" => array("rozdelovac" => "                </div>
              </div>
              <div class=\"panel\">
                <div class=\"panel-wrapper\">\n",
                                                               "rozdelovacposledni" => " class=\"posledni\""),

                  "normal_vypis=zapati-partneri" => "%%prvnicoda%%%%rozdelovac%%                  <p%%rozdelovacposledni%%>
                    <a href=\"%%11%%\" title=\"%%12%%\" style=\"background-image: url(%%15%%);\"%%13%%><!-- --></a>
                  </p>\n%%poslednicoda%%",

                  "admin_vypis_obsah_sablony_datum_null=7" => "---",

                  "admin_vypis_obsah_sablony_del=7" => "<a href=\"%%2%%\" title=\"Opravdu chceš smazat: &quot;%%4%%&quot; ?\" class=\"confirm delobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Smazat</a>",

                  "admin_vypis_obsah_sablony=7" => "
<ul class=\"f-f-web-pro f-s-14 m-b-15 w-230 h-250 fl-l m-l-6\" id=\"arrayporadi_%%1%%\">
  <li class=\"nadpis-2 f-s-16 m-t-2 p-t-6 p-r-10 p-b-6 p-l-10 cur-move ow-h\" style=\"height: 53px;\"><span class=\"fl-l\">%%11%%</span><span class=\"block fl-r f-s-14 m-t-1 ow-h\">%%5%%<a href=\"%%6%%\" title=\"Upravit\" class=\"editobsah block fl-l m-r-5 m-l-5 no-u odkaz-4\">Upravit</a>%%7%%</span></li>
%%4%%
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Přidáno:</span><span class=\"fl-r barva-5\">%%2%%</span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">Upraveno:</span><span class=\"fl-r barva-5\">%%3%%</span></li>
  <li class=\"polozka-1-lichy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"block barva-4\" style=\"background-color: #21282c;\"><span class=\"block m-auto\" style=\"width: 200px; height: 100px; background: url(%%13%%) no-repeat right center;\"></span></span></li>
  <li class=\"polozka-1-sudy p-t-3 p-r-10 p-b-3 p-l-10 ow-h f-s-14\"><span class=\"fl-l barva-4\">%%10%%</span></li>
</ul>\n",

/* - - - - - - - - - - - - - - - - - - - - */

                  "normal_search_form=zahlavi-hledej" => "            <label class=\"form_text\">
              <input type=\"text\" name=\"%%1%%\" value=\"%%2%%\" />
            </label>
            <label class=\"form_submit\">
              <input type=\"submit\" name=\"%%3%%\" value=\"&nbsp;\" />
            </label>",






                  "normal_vypis_search_minitext" => "<br /><em>V tomto bloku nalezeno: <strong>%%2%%x</strong></em><br /><br /><div>%%3%%</div><br /><hr />",

                  "normal_vypis_search_fulltext" => "<br /><em>V tomto bloku nalezeno: <strong>%%2%%x</strong></em><br /><br /><div>%%3%%</div><br /><hr />",

                  "normal_vypis_search_tinymce" => "<br /><em>V tomto bloku nalezeno: <strong>%%2%%x</strong></em><br /><br /><div>%%3%%</div><br /><hr />",

                  "normal_vypis_search_wymeditorlite" => "<br /><em>V tomto bloku nalezeno: <strong>%%2%%x</strong></em><br /><br /><div>%%3%%</div><br /><hr />",

                  "normal_vypis_search_minitextlite" => "<br /><em>V tomto bloku nalezeno: <strong>%%2%%x</strong></em><br /><br /><div>%%3%%</div><br /><hr />",

                  "normal_vypis_search_fulltextlite" => "<br /><em>V tomto bloku nalezeno: <strong>%%2%%x</strong></em><br /><br /><div>%%3%%</div><br /><hr />",

                  "normal_search_fix_adres" => array (1 => "%%1%%",
                                                      4 => "%%1%%"),



                  "normal_search_redirect_wait" => "",

                  "normal_search_redirect" => "%%1%%hledej/%%2%%",

                  "normal_vypis_search_konverze" => array("/%%1%%/" => "<strong style=\"background-color: yellow;\">$0</strong>",
                                                          "/&lt;p&gt;/" => "",
                                                          "/&lt;\/p&gt;/" => "",
                                                          //"/\|-x--x-\|/" => ", ",
                                                          //"/\|-xxxx-\|/" => ", ",
                                                          ),

                  "normal_vypis_search_null" => "Nebyl nalezen požadovaný dotaz",

                  "normal_vypis_search" => "
                  <br />
Nalezeno celkově výsledků: <strong>%%1%%</strong>
<br />

<hr />
                  %%2%%
                  ",






/* - - - - - - - - - - /Normal výpis - - - - - - - - - - */

/* -------------------------------------------------------------------------- */

                  );

/* -------------------------------------------------------------------------- */

  return $result;
?>
