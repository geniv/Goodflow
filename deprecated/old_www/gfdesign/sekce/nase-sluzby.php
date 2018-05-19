<?
  $obr = $this->var->main[0]->NactiFunkci("RandomPicture", "Obrazek");

  $result =
  "
          <div id=\"vypis_sekce_nase_sluzby\">
            <div id=\"obsah_velky\">
              <span class=\"backgroundy_obsah_velky obsah_velky_top\"></span>
              <h2 title=\"Naše služby\">
                <span>Naše služby</span>
              </h2>
                <div>
                  <p id=\"prvni_odstavec\">
                    Lorem ipsum dolor sit amet consectetuer lacinia tortor tincidunt auctor libero. Nunc tincidunt consequat risus non ut Morbi platea felis congue porta.
                  </p>
                  <div id=\"accordion_obal\">
                    <span id=\"zahlavi_accordion\"></span>
                    <h3 class=\"prepinac\">
                      <span>
                        Grafický design stránek
                      </span>
                    </h3>
                    <div class=\"obsah_accordion prvni_ie6\">
                      <span></span>
                      <p>The first suggestion that all organisms may have had a common ancestor and diverged through random variation and natural selection was made in 1745 by the French mathematician and scientist Pierre-Louis Moreau de Maupertuis (1698-1759) in his work Venus physique. Specifically.</p>
                      <p class=\"posledni_odstavec\">\"Neváhejte a kontaktujte nás.\"</p>
                    </div>
                    <h3 class=\"prepinac\">
                      <span>
                        Flash animace a bannery
                      </span>
                    </h3>
                    <div class=\"obsah_accordion\">
                      <span></span>
                      <p>The first suggestion that all organisms may have had a common ancestor and diverged through random variation and natural selection was made in 1745 by the French mathematician and scientist Pierre-Louis Moreau de Maupertuis (1698-1759) in his work Venus physique. Specifically.</p>
                      <p class=\"posledni_odstavec\">\"Neváhejte a kontaktujte nás.\"</p>
                    </div>
                    <h3 class=\"prepinac\">
                      <span>
                        Tvorba www stránek
                      </span>
                    </h3>
                    <div class=\"obsah_accordion\">
                      <span></span>
                      <p>The first suggestion that all organisms may have had a common ancestor and diverged through random variation and natural selection was made in 1745 by the French mathematician and scientist Pierre-Louis Moreau de Maupertuis (1698-1759) in his work Venus physique. Specifically.</p>
                      <p class=\"posledni_odstavec\">\"Neváhejte a kontaktujte nás.\"</p>
                    </div>
                    <span id=\"zapati_accordion\"></span>
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

  return $result;
?>
