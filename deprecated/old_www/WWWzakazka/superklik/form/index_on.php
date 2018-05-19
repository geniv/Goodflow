<?php
  $this->var->main->Kurzy($eur, $usd, $gbp, $hrk);
  $this->var->main->TvAktualne($ct1, $ct2, $nova, $prima);
  $reklama = $this->var->main->VypisTexty("rekl_text_on");

  return
  "
      <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
          <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <meta http-equiv=\"Content-Language\" content=\"cs\" />
            <meta name=\"author\" content=\"nemuzu uvest nazev, protoze si to zakaznik neustale nepreje, ale jinak se jedna o triclennou skupinu autoru\" />
            <meta name=\"copyright\" content=\"MV Consulting s.r.o.\" />
            <meta name=\"description\" content=\"Superklik.cz - Největší internetový výherní portál v ČR\" />
            <meta name=\"robots\" content=\"index, follow\" />
            <meta name=\"keywords\" content=\"superklik, superklik.cz, Soutěž, soutěž, výherní, výhry, výhra, portál, soutěžní, soutěžní portál, výherní portál, super, klik, click, Super, Klik, MV, MV Consulting, Superklik\" />
            {$this->var->meta}
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
            <!--[if IE]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE 7]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
            <![endif]-->
            <!--[if lte IE 6]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE]>
              <script type=\"text/javascript\" src=\"script/script_flash.js\" defer=\"defer\"></script>
            <![endif]-->
            ".($reklama ? "
            <script type=\"text/javascript\">
              var line=new Array();
              {$this->var->main->VypisPoleJezdicihoTextu()}
            </script>
            " : "
            <script type=\"text/javascript\">
              var line=new Array();
              line[1] = \"\";
            </script>
            ")."
            <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
            <script type=\"text/javascript\">
              Login('', '');
              //Buben('demo');  //2 zavolani bubnu
              //AjaxStranka('ax_faq');
            </script>
            <title>Superklik.cz - Největší internetový výherní portál v ČR</title>
            <link rel=\"shortcut icon\" href=\"obr/klik.ico\" />
            <link href=\"obr/klik.png\" rel=\"icon\" type=\"image/png\" />
          </head>
          <body>

            <div id=\"obal_layout\">

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
                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
                    <p class=\"no_flash\" id=\"alternatina_flash\">
                      <a href=\"javascript:AjaxStranka('');\" onclick=\"AjaxStranka(''); return false;\">Hlavni stránka</a>
                      <a href=\"javascript:AjaxStranka('ax_pravidla');\" onclick=\"AjaxStranka('ax_pravidla'); return false;\">Pravidla</a>
                      <a href=\"javascript:AjaxStranka('ax_vyhry');\" onclick=\"AjaxStranka('ax_vyhry'); return false;\">Výhry</a>
                      <a href=\"javascript:AjaxStranka('ax_reklama');\" onclick=\"AjaxStranka('ax_reklama'); return false;\">Reklama</a>
                      <a href=\"javascript:AjaxStranka('ax_cenik');\" onclick=\"AjaxStranka('ax_cenik'); return false;\">ceník</a>
                      <a href=\"javascript:AjaxStranka('ax_kontakt');\" onclick=\"AjaxStranka('ax_kontakt'); return false;\">Kontakt</a>
                      <a href=\"javascript:AjaxStranka('ax_faq');\" onclick=\"AjaxStranka('ax_faq'); return false;\">FAQ</a>
                    </p>
                  </object>
                <!-- <![endif]-->

              <a onclick=\" this.style.behavior='url(#default#homepage)';
                            this.setHomePage('http://www.superklik.cz');
                            return false;\" href=\"javascript:AjaxStranka('ax_firefox');\" id=\"nastavit_domovskou_stranku\">
                <img src=\"obr/home.png\" alt=\"\" />
                <span>
                  Nastavit Superklik jako domovskou stránku
                </span>
              </a>

              <a href=\"soubory/install_flash_player.exe\" id=\"stahnout_flash_player\">
                <img src=\"obr/flash_zahlavi_ikona.png\" alt=\"\" />
                <span>
                  Instalovat flash pro správné zobrazení
                </span>
              </a>

              {$this->var->main->VypisBaner()}

              </div>

              ".($reklama ?
              "<div id=\"reklama_bezici_text\">
                <p id=\"jezdici_text\"></p>
              </div>" : "")."

              <div id=\"uzivatelske_info\">
                <p class=\"left\">
                  <img src=\"obr/background_info_zahlavi.png\" alt=\"\" /> <span>Dnes je ".(date("j.n.Y"))."</span> <img src=\"obr/background_svatek_ma_zahlavi.png\" class=\"svatek_ma_img\" alt=\"\" /> <span>{$this->var->main->DnesMaSvatek()}</span>
                </p>

                <div class=\"right\" id=\"reg_log\"></div>

                <div id=\"hodiny_pujcene\">
                <p class=\"right\">
                  <img src=\"obr/background_presny_cas_zahlavi.png\" alt=\"\" />
                </p>
                  <span></span>
                  <div id=\"samotne_hodiny\">
                  </div>
                </div>

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
                    {$this->var->main->VypisVyhercu()}
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
                  <script type=\"text/javascript\" src=\"http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=cs\"></script>

                  <div id=\"pocasi\">
                    <img src=\"picture.php?q=YUhSMGNEb3ZMM2QzZHk1dFpYUmxiM0J5WlhOekxtTjZMM0JwWTNSMWNtVnpMM0J3WDJOeVh6QmtaVzR1Y0c1bg\" alt=\"\" />
                    <img src=\"picture.php?q=YUhSMGNEb3ZMM2QzZHk1dFpYUmxiM0J5WlhOekxtTjZMM0JwWTNSMWNtVnpMM0J3WDJOeVh6RmtaVzR1Y0c1bg\" alt=\"\" />
                    <img src=\"picture.php?q=YUhSMGNEb3ZMM2QzZHk1dFpYUmxiM0J5WlhOekxtTjZMM0JwWTNSMWNtVnpMM0J3WDJOeVh6SmtaVzR1Y0c1bg\" alt=\"\" />
                    <img src=\"picture.php?q=YUhSMGNEb3ZMM2QzZHk1dFpYUmxiM0J5WlhOekxtTjZMM0JwWTNSMWNtVnpMM0J3WDJOeVh6TmtaVzR1Y0c1bg\" alt=\"\" />
                    <img src=\"picture.php?q=YUhSMGNEb3ZMM2QzZHk1dFpYUmxiM0J5WlhOekxtTjZMM0JwWTNSMWNtVnpMM0J3WDJOeVh6UmtaVzR1Y0c1bg\" alt=\"\" />
                    <img src=\"picture.php?q=YUhSMGNEb3ZMM2QzZHk1dFpYUmxiM0J5WlhOekxtTjZMM0JwWTNSMWNtVnpMM0J3WDJOeVh6VmtaVzR1Y0c1bg\" alt=\"\" />
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
                    <p class=\"gbp_margin\">
                      GBP: {$gbp}
                    </p>
                    <p class=\"hrk_margin\">
                      HRK: {$hrk}
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
                    {$this->var->main->Zpravy("http://www.novinky.cz/rss/domaci/", 6, 1)}
                  </div>

                  <span class=\"linka_zpravy\"></span>

                  <div id=\"zpravy_ze_sveta\">
                    {$this->var->main->Zpravy("http://www.novinky.cz/rss/zahranicni/", 4, 2)}
                  </div>

                  <span class=\"linka_zpravy\"></span>

                  <div id=\"zpravy_ze_sportu\">
                    {$this->var->main->Zpravy("http://www.sport.cz/rss/", 4, 3)}
                  </div>
                </div>

                <div id=\"sponzori\">
                  <span class=\"sponzor_001\"><em></em></span>
                  <span class=\"sponzor_002\"><em></em></span>
                  <span class=\"sponzor_003\"><em></em></span>
                  <span class=\"sponzor_004\"><em></em></span>
                  <span class=\"sponzor_005\"><em></em></span>
                  <span class=\"sponzor_006\"><em></em></span>
                  <span class=\"sponzor_007\"><em></em></span>
                  <span class=\"sponzor_008\"><em></em></span>
                </div>

              </div>

            {$this->var->chyba}

            <!-- <div id=\"reklama_2\"></div> -->

            <div id=\"zapati_reklamy\">
              <ul>
                <li><a href=\"http://asus.cz/\" title=\"ASUSTeK Computer Inc.\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_02.png\" alt=\"ASUSTeK Computer Inc.\" /></a></li>
                <li><a href=\"http://t-mobile.cz/\" title=\"T-Mobile Company\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_03.png\" alt=\"T-Mobile Company\" /></a></li>
                <li><a href=\"http://www.google.cz/\" title=\"Google\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_04.png\" alt=\"Google\" /></a></li>
                <li><a href=\"http://www.citrixnews.cz/\" title=\"Citrix Systems\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_05.png\" alt=\"Citrix Systems\" /></a></li>
                <li><a href=\"http://icq.com/\" title=\"ICQ\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_06.png\" alt=\"ICQ\" /></a></li>
                <li><a href=\"http://skype.cz/\" title=\"Skype\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_07.png\" alt=\"Skype\" /></a></li>
                <li><a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict !\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_09.png\" alt=\"Valid XHTML 1.0 Strict !\" /></a></li>
                <li><a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS version 2.1 !\" rel=\"nofollow\"><img src=\"obr/reklamy/zapati_lista_loga_08.png\" alt=\"Valid CSS version 2.1 !\" /></a></li>
              </ul>
            </div>
              <div id=\"zapati\">
                <div id=\"background_zapati\">
                  <p>
                    Copyright © 2008–2009 MV Consulting s.r.o. provozovatel soutěžního portálu Superklik.cz
                    <br />
                    <span>Všechna práva vyhrazena • All Rights Reserved</span>
                    <br />
                    Superklik<sup>®</sup> je chráněn registrovanou ochranou známkou úřadem průmyslového vlastnictví, Antonína Čermáka 2a, 160 68 Praha 6
                    <!--{$this->var->main->KonecCas()} -->

                    <a href=\"#\" onclick=\"AjaxStranka('admin'); return false;\" id=\"odkaz_do_sekce\"></a>
                  </p>
                </div>
              </div>
            </div>
            <div>
              <span class=\"preloader preload_001\"></span>
              <span class=\"preloader preload_002\"></span>
              <span class=\"preloader preload_003\"></span>
              <span class=\"preloader preload_004\"></span>
              <span class=\"preloader preload_005\"></span>
              <span class=\"preloader preload_006\"></span>
              <span class=\"preloader preload_007\"></span>
              <span class=\"preloader preload_008\"></span>
              <span class=\"preloader preload_009\"></span>
              <span class=\"preloader preload_010\"></span>
              <span class=\"preloader preload_011\"></span>
              <span class=\"preloader preload_012\"></span>
              <span class=\"preloader preload_013\"></span>
              <span class=\"preloader preload_014\"></span>
              <span class=\"preloader preload_015\"></span>
              <span class=\"preloader preload_016\"></span>
              <span class=\"preloader preload_017\"></span>
              <span class=\"preloader preload_018\"></span>
              <span class=\"preloader preload_019\"></span>
              <span class=\"preloader preload_020\"></span>
              <span class=\"preloader preload_021\"></span>
              <span class=\"preloader preload_022\"></span>
              <span class=\"preloader preload_023\"></span>
              <span class=\"preloader preload_024\"></span>
              <span class=\"preloader preload_025\"></span>
              <span class=\"preloader preload_026\"></span>
              <span class=\"preloader preload_027\"></span>
              <span class=\"preloader preload_028\"></span>
              <span class=\"preloader preload_029\"></span>
              <span class=\"preloader preload_030\"></span>
              <span class=\"preloader preload_031\"></span>
              <span class=\"preloader preload_032\"></span>
              <span class=\"preloader preload_033\"></span>
              <span class=\"preloader preload_034\"></span>
              <span class=\"preloader preload_035\"></span>
              <span class=\"preloader preload_036\"></span>
              <span class=\"preloader preload_037\"></span>
              <span class=\"preloader preload_038\"></span>
              <span class=\"preloader preload_039\"></span>
              <span class=\"preloader preload_040\"></span>
              <span class=\"preloader preload_041\"></span>
              <span class=\"preloader preload_042\"></span>
              <span class=\"preloader preload_043\"></span>
              <span class=\"preloader preload_044\"></span>
              <span class=\"preloader preload_045\"></span>
              <span class=\"preloader preload_046\"></span>
              <span class=\"preloader preload_047\"></span>
              <span class=\"preloader preload_048\"></span>
              <span class=\"preloader preload_049\"></span>
              <span class=\"preloader preload_050\"></span>
              <span class=\"preloader preload_051\"></span>
              <span class=\"preloader preload_052\"></span>
              <span class=\"preloader preload_053\"></span>
              <span class=\"preloader preload_054\"></span>
              <span class=\"preloader preload_055\"></span>
              <span class=\"preloader preload_056\"></span>
              <span class=\"preloader preload_057\"></span>
              <span class=\"preloader preload_058\"></span>
              <span class=\"preloader preload_059\"></span>
              <span class=\"preloader preload_060\"></span>
              <span class=\"preloader preload_061\"></span>
              <span class=\"preloader preload_062\"></span>
              <span class=\"preloader preload_063\"></span>
              <span class=\"preloader preload_064\"></span>
              <span class=\"preloader preload_065\"></span>
              <span class=\"preloader preload_066\"></span>
              <span class=\"preloader preload_067\"></span>
              <span class=\"preloader preload_068\"></span>
              <span class=\"preloader preload_069\"></span>
              <span class=\"preloader preload_070\"></span>
              <span class=\"preloader preload_071\"></span>
            </div>
          </body>
        </html>
  ";

/*

<br>
  <a href=\"javascript:AjaxStranka('ax_vyhodnoceni');\" onclick=\"AjaxStranka('ax_vyhodnoceni'); return false;\">vyhodnoceni</a>

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
                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
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
                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
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
                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
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
                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

              <div class=\"reklama_5\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/FSC.swf\" width=\"120\" height=\"400\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"120\" height=\"400\">
                    <param name=\"movie\" value=\"{$this->var->web}/flash/FSC.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />
                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

<span class=\"linka_nad_flashem_left\"></span>
<span class=\"linka_nad_flashem_right\"></span>

*/















?>
