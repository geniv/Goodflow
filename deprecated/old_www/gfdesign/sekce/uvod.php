<?
  $obr = $this->var->main[0]->NactiFunkci("RandomPicture", "Obrazek");

  $novinky = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "LangCyklObsah", "novinky");
  $uvod = $this->var->main[0]->NactiFunkci("DynamicLanguageObsah", "LangObsah", "uvod");

  $result =
  "
          <div id=\"vypis_sekce_uvod\">
            <div id=\"obsah_velky\">
              <span class=\"backgroundy_obsah_velky obsah_velky_top\"></span>
              <h2 title=\"Úvod\">
                <span>Úvod</span>
              </h2>
                <div>
                  {$uvod}
                  <h3>
                    Nejnovější reference
                  </h3>
                  <div id=\"nejnovejsi_reference\">
                    <a href=\"http://kupredu.net/\" title=\"Kupředu net - communications for you, internet for life...\">
                      <img src=\"obr/nahled_reference_001.png\" alt=\"Kupředu net - communications for you, internet for life...\" class=\"reflect\" />
                    </a>
                    <!--[if IE]>
                      <a href=\"http://kupredu.net/\" title=\"Kupředu net - communications for you, internet for life...\" class=\"nahradni_odkaz_ie nahradni_odkaz_left\"></a>
                    <![endif]-->
                    <a href=\"http://www.superklik.cz/\" title=\"Superklik.cz - Největší internetový výherní portál v ČR\">
                      <img src=\"obr/nahled_reference_002.png\" alt=\"Superklik.cz - Největší internetový výherní portál v ČR\" class=\"reflect\" />
                    </a>
                    <!--[if IE]>
                      <a href=\"http://www.superklik.cz/\" title=\"Superklik.cz - Největší internetový výherní portál v ČR\" class=\"nahradni_odkaz_ie nahradni_odkaz_center\"></a>
                    <![endif]-->
                    <a href=\"http://flinston.gfdesign.cz/\" title=\"Flinston - Návrhy a realizace zahrad | Dřevostavby | Soliterní a okrasné kameny\" id=\"posledni_odkaz\">
                      <img src=\"obr/nahled_reference_003.png\" alt=\"Flinston - Návrhy a realizace zahrad | Dřevostavby | Soliterní a okrasné kameny\" class=\"reflect\" />
                    </a>
                    <!--[if IE]>
                      <a href=\"http://flinston.gfdesign.cz/\" title=\"Flinston - Návrhy a realizace zahrad | Dřevostavby | Soliterní a okrasné kameny\" class=\"nahradni_odkaz_ie nahradni_odkaz_right\"></a>
                    <![endif]-->
                    <span id=\"prekryti_reflection\"></span>
                  </div>
                  <h3>
                    Novinky
                  </h3>
                  <div id=\"novinky\">
                    {$novinky}
                  </div>
                </div>
              <span class=\"backgroundy_obsah_velky obsah_velky_bottom\"></span>
              <span class=\"backgroundy_obsah_velky obsah_velky_odraz\"></span>
            </div>
            <div id=\"obsah_maly\">
              <em title=\"Náhodný obrázek\">
                Náhodný obrázek
              </em>
                <div>
                  {$obr}
                </div>
            </div>
          </div>
  ";
/*
<p id=\"prvni_odstavec\">
                    <strong>GF Design - Jsme tříčlenný tým mladých, kreativních tvůrců webových stránek.</strong> Při tvorbě stránek uplatňuje každý z týmu své dovednosti (grafika, programování, kódování). Tímto se každý může zaměřit na určitou část a zpracovat ji dokonale.
                  </p>
                  <p>
                    <strong>Našim cílem jsou kvalitní a atraktivní webové stránky, které vyhovují koncovým zákazníkům.</strong> Klademe důraz na účelnost a použitelnost stránek.
                  </p>
                  <p id=\"posledni_odstavec\">
                    blaaa blaaa blaaa už mě nic nenapadá ...
                  </p>

<dl>
                      <dt>
                        <em>
                          25.3.2009
                          <span>-</span>
                        </em>
                      </dt>
                      <dd>
                        Opraveno to co jsem uz jednou opravoval ... nechapu kde se vzal stary index kdyz jsem novy automaticky hazel na net ...
                      </dd>
                    </dl>
                    <dl>
                      <dt>
                        <em>
                          22.3.2009
                          <span>-</span>
                        </em>
                      </dt>
                      <dd>
                        Všechny bugy opraveny - úvod: odrazy, novinky (IE 6, 7), naše služby: acoordion plně doladěn včetně IE 6, 7. Celkový check v IE6, IE7, Firefox, Opera, Safari, Chrome. Doladěny sémantické a nesémantické prvky.
                      </dd>
                    </dl>
                    <dl>
                      <dt>
                        <em>
                          16.3.2009
                          <span>-</span>
                        </em>
                      </dt>
                      <dd>
                        Zprovoznen nahodny obrazek a highslide, check v IE6, IE7, Firefox, Opera, Safari, Chrome.
                      </dd>
                    </dl>
                    <dl>
                      <dt>
                        <em>
                          16.3.2009
                          <span>-</span>
                        </em>
                      </dt>
                      <dd>
                        Nasazen maly obsah a zcheckovano v IE6, IE7, Firefox, Opera, Safari, Chrome.
                      </dd>
                    </dl>
                    <dl>
                      <dt>
                        <em>
                          16.3.2009
                          <span>-</span>
                        </em>
                      </dt>
                      <dd>
                        Zcheckovano v IE6, IE7, Firefox, Opera, Safari, Chrome.
                      </dd>
                    </dl>
*/
  return $result;
?>
