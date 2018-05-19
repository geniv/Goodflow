<?
  $obr = $this->var->main[0]->NactiFunkci("RandomPicture", "Obrazek");

  $result =
  "
          <div id=\"vypis_sekce_kontakt\">
            <div id=\"obsah_velky\">
              <span class=\"backgroundy_obsah_velky obsah_velky_top\"></span>
              <h2 title=\"Kontakt\">
                <span>Kontakt</span>
              </h2>
                <div>
                <h1>GF Design</h1>
                  <br />
                  Kontakt
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
