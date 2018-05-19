<?php
  $logoff = false;
  if (!Empty($_GET["akce"]) &&
      $_GET["akce"] == "logoff")
  {
    $_SERVER["PHP_AUTH_USER"] = "";
    $_SERVER["PHP_AUTH_PW"] = "";
    $logoff = true;
  }

  if (Empty($_SERVER["PHP_AUTH_USER"]) ||
      !$this->var->main->KontrolaAutorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
  {
    header("WWW-Authenticate: Basic realm=\"superklik.cz\"");
    header("HTTP/1.0 401 Unauthorized");

    $this->var->main->AutoClick(1, "./");
    if ($logoff)
    {
      $result = include "unlogin.php";
    }
      else
    {
      $result = include "unautorizet.php";
    }
  }
    else
  {
    $menu = $this->var->main->MenuAdmin();  //nacteni menu
    $obsah = $this->var->main->ObsahAdminu($_GET["akce"]);  //nacteni obsahu

    $result =
    "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
          \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
          <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
            <head>
              <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
              <meta http-equiv=\"Content-Language\" content=\"cs\" />
              <meta name=\"author\" content=\"GF Design www.gfdesign.cz\" />
              <meta name=\"copyright\" content=\"MV Consulting s.r.o.\" />
              <meta name=\"description\" content=\"Superklik.cz - Největší internetový výherní portál v ČR\" />
              <meta name=\"robots\" content=\"noindex, nofollow\" />

              <meta http-equiv=\"cache-control\" content=\"no-cache\" />
              <meta http-equiv=\"pragma\" content=\"no-cache\" />

              {$this->var->meta}

                <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles_admin.css\" media=\"screen\" />

              <script type=\"text/javascript\">
                {$this->var->jazykinterpretu}
              </script>
              <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
              <title>Superklik.cz - Administrace</title>

              <link rel=\"shortcut icon\" href=\"obr/klik.ico\" />
              <link href=\"obr/klik.png\" rel=\"icon\" type=\"image/png\" />

            </head>
            <body>
              <div id=\"obal_layout\">
                <div id=\"obal_obsah\">
                  <div id=\"menu_admin\">
                    {$menu}
                  </div>
                  <div id=\"obsah_admin\">
                    {$obsah}
                    {$this->var->chyba}
                  </div>
                </div>
                <div id=\"zapati\">
                  <div id=\"background_zapati\">
                    <p class=\"prvni_odstavec_odsazeni\">
                      Copyright © 2008–2009 MV Consulting s.r.o. provozovatel soutěžního portálu Superklik.cz
                    </p>
                    {$this->var->main->KonecCas()}
                  </div>
                </div>
              </div>
            </body>
          </html>
    ";
  }

  return $result;

/*

reklama: menit texty, z duvou necosavych textu vyusteno<br>

              <div id=\"zahlavi\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/zahlavi_flash.swf\" width=\"740\" height=\"207\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"740\" height=\"207\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/zahlavi_flash.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->

<a onclick=\"this.style.behavior='url(#default#homepage)'; this.setHomePage('http://www.superklik.cz'); return false\" href=\"#\" id=\"nastavit_domovskou_stranku\">
  <img src=\"obr/home.png\" alt=\"\" />
  <span>
    Nastavit Superklik jako domovskou stránku
  </span>
</a>


              <div class=\"reklama_1\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/autoshop.swf\" width=\"120\" height=\"400\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"120\" height=\"400\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/autoshop.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

              <div class=\"reklama_2\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/CDC.swf\" width=\"120\" height=\"400\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"120\" height=\"400\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/CDC.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

              <div class=\"reklama_3\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/balaton.swf\" width=\"120\" height=\"400\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"120\" height=\"400\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/balaton.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

              <div class=\"reklama_4\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/klenot.swf\" width=\"120\" height=\"400\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"120\" height=\"400\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/klenot.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>










              </div>

              <div id=\"uzivatelske_info\">
                <p class=\"left\">
                  Info: Dnes je ".(date("j.n.Y"))." ,  svátek má {$this->var->main->DnesMaSvatek()}
                </p>

                <p class=\"right\" id=\"reg_log\">

                </p>
              </div>





              <div id=\"main_form\">
                <noscript>
                <p>
                  Pro odstraneni problemu funkčnosti stránek klikněte na: <a href=\"?action=ax_faq\">faq</a>
                  {$this->var->main->ObsahStranky($_GET["action"])}
                </p>
                </noscript>
              </div>

              <div id=\"panel_automat_vyherci\">
                <div id=\"automat\">


                  <div id=\"flash_automat\">
                    <noscript>
                      <p>
                        Pro odstraneni problemu funkčnosti stránek klikněte na: <a href=\"?action=ax_faq\">faq</a>
                      </p>
                    </noscript>
                  </div>


                </div>
                <div id=\"tabulka_vyhercu\">
                  <div id=\"vyherci\">
                    {$this->var->main->ListVyherci()}
                  </div>
                </div>
              </div>


<div id=\"zpravy_a_horoskopy_obal\"></div>

              <div id=\"sponzori_reklama\">




                <div id=\"reklama\">



<form action=\"http://www.google.com/cse\" id=\"cse-search-box\">
  <div>
    <input type=\"hidden\" name=\"cx\" value=\"000786807977455256087:ru25py1c8te\" />
    <input type=\"hidden\" name=\"ie\" value=\"UTF-8\" />
    <input type=\"text\" name=\"q\" id=\"input_text_hledani\" />
    <input type=\"submit\" name=\"sa\" value=\"\" id=\"input_tlacitko_hledat\" />
  </div>
</form>
<script type=\"text/javascript\" src=\"http://www.google.com/coop/cse/brand?form=cse-search-box&lang=cs\"></script>


<div id=\"pocasi\">
  <img src=\"http://www.meteopress.cz/pictures/pp_cr_0den.png\" alt=\"\" />
  <img src=\"http://www.meteopress.cz/pictures/pp_cr_1den.png\" alt=\"\" />
  <img src=\"http://www.meteopress.cz/pictures/pp_cr_2den.png\" alt=\"\" />
  <img src=\"http://www.meteopress.cz/pictures/pp_cr_3den.png\" alt=\"\" />
  <img src=\"http://www.meteopress.cz/pictures/pp_cr_4den.png\" alt=\"\" />
  <img src=\"http://www.meteopress.cz/pictures/pp_cr_5den.png\" alt=\"\" />
</div>




<div id=\"horoskop\">
  {$this->var->main->Horoskop()}

  <div id=\"horoskopy_seznam\">
    <span class=\"icon_beran\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('beran'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('beran'); return false;\" title=\"\">
        <strong>Beran</strong>
      </a>
      <cite>21.3 - 20.4</cite>
    </span>
    <span class=\"icon_byk\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('byk'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('byk'); return false;\" title=\"\">
        <strong>Býk</strong>
      </a>
      <cite>21.4 - 20.5</cite>
    </span>
    <span class=\"icon_blizenci\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('blizenci'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('blizenci'); return false;\" title=\"\">
        <strong>Blíženci</strong>
      </a>
      <cite>21.5 - 21.6</cite>
    </span>
    <span class=\"icon_rak\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('rak'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('rak'); return false;\" title=\"\">
        <strong>Rak</strong>
      </a>
      <cite>22.6 - 22.7</cite>
    </span>
    <span class=\"icon_lev\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('lev'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('lev'); return false;\" title=\"\">
        <strong>Lev</strong>
      </a>
      <cite>23.7 - 23.8</cite>
    </span>
    <span class=\"icon_panna\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('panna'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('panna'); return false;\" title=\"\">
        <strong>Panna</strong>
      </a>
      <cite>24.8 - 23.9</cite>
    </span>
    <span class=\"icon_vahy\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('vahy'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('vahy'); return false;\" title=\"\">
        <strong>Váhy</strong>
      </a>
      <cite>24.9 - 23.10</cite>
    </span>
    <span class=\"icon_stir\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('stir'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('stir'); return false;\" title=\"\">
        <strong>Štír</strong>
      </a>
      <cite>24.10 - 22.11</cite>
    </span>
    <span class=\"icon_strelec\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('strelec'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('strelec'); return false;\" title=\"\">
        <strong>Střelec</strong>
      </a>
      <cite>23.11 - 21.12</cite>
    </span>
    <span class=\"icon_kozoroh\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('kozoroh'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('kozoroh'); return false;\" title=\"\">
        <strong>Kozoroh</strong>
      </a>
      <cite>22.12 - 20.1</cite>
    </span>
    <span class=\"icon_vodnar\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('vodnar'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('vodnar'); return false;\" title=\"\">
        <strong>Vodnář</strong>
      </a>
      <cite>21.1 - 19.2</cite>
    </span>
    <span class=\"icon_ryby\">
      <a href=\"#\" onclick=\"ZobrazitHoroskop('ryby'); return false;\" title=\"\">
        <em></em>
      </a>
      <a href=\"#\" onclick=\"ZobrazitHoroskop('ryby'); return false;\" title=\"\">
        <strong>Ryby</strong>
      </a>
      <cite>20.2 - 20.3</cite>
    </span>
  </div>
</div>

<div id=\"mena_eur_usd\">
  <p class=\"eur_margin\">
    EUR: {$eur}
  </p>
  <p class=\"usd_margin\">
    USD: {$usd}
  </p>
  <p class=\"skk_margin\">
    SKK: {$skk}
  </p>
  <p class=\"gbp_margin\">
    GBP: {$gbp}
  </p>
</div>

<div id=\"program_televize\">
  <p>
    <a href=\"http://www.ceskatelevize.cz/program/\" title=\"TV program &mdash; Česká televize\">
      {$ct1}
    </a>
  </p>
  <p>
    <a href=\"http://www.ceskatelevize.cz/program/\" title=\"TV program &mdash; Česká televize\">
      {$ct2}
    </a>
  </p>
  <p>
    <a href=\"http://tvprogram.nova.cz/\" title=\"TV Program Nova\">
      {$nova}
    </a>
  </p>
  <p>
    <a href=\"http://www.iprima.cz/index.php/plain_site/content/view/full/83\" title=\"TV Program Prima\">
      {$prima}
    </a>
  </p>
</div>


                </div>


                <div id=\"zpravy\">
                  <div id=\"zpravy_z_domova\">
                    {$this->var->main->Zpravy("http://www.novinky.cz/rss/domaci", 6, 1)}
                  </div>

                  <span class=\"linka_zpravy\"></span>

                  <div id=\"zpravy_ze_sveta\">
                    {$this->var->main->Zpravy("http://www.novinky.cz/rss/zahranicni", 4, 2)}
                  </div>

                  <span class=\"linka_zpravy\"></span>

                  <div id=\"zpravy_ze_sportu\">
                    {$this->var->main->Zpravy("http://www.sport.cz/rss/", 3, 3)}
                  </div>
                </div>


                <div id=\"sponzori\"></div>

              </div>

{$this->var->chyba}
              <div id=\"reklama_2\">

              <a href=\"#\" onclick=\"AjaxStranka('admin'); return false;\">...</a>


              </div>




            <div id=\"zapati_reklamy\">
              <ul>
                <li><a href=\"http://asus.com/\" title=\"ASUSTeK Computer Inc.\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_02.png\" alt=\"ASUSTeK Computer Inc.\" /></a></li>
                <li><a href=\"http://t-mobile.com/\" title=\"T-Mobile Company\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_03.png\" alt=\"T-Mobile Company\" /></a></li>
                <li><a href=\"http://www.google.com/\" title=\"Google\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_04.png\" alt=\"Google\" /></a></li>
                <li><a href=\"http://www.citrix.com/\" title=\"Citrix Systems\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_05.png\" alt=\"Citrix Systems\" /></a></li>
                <li><a href=\"http://icq.com/\" title=\"ICQ\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_06.png\" alt=\"ICQ\" /></a></li>
                <li><a href=\"http://skype.com/\" title=\"Skype\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_07.png\" alt=\"Skype\" /></a></li>
                <li><a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict !\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_09.png\" alt=\"Valid XHTML 1.0 Strict !\" /></a></li>

                <li><a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS version 2.1 !\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_08.png\" alt=\"Valid CSS version 2.1 !\" /></a></li>
              </ul>
            </div>







*/
















?>
