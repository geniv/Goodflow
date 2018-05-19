<?php
//echo system("java -jar yuicompressor-2.4.2.jar highslide.js -o highslide-min.js --type js --charset utf-8");
class YuiCompressor
{
  private $kompresor = "java -jar yuicompressor-2.4.2.jar";
  private $jsdir = "js";
  private $cssdir = "css";

  public function __construct()
  {
    $volba = $_POST["volba"];
    $vystup = "";
    if (!Empty($_POST["tlacitko"]) &&
        !Empty($volba))
    {
      switch ($volba)
      {
        case "help":
          $vystup = $this->VykonejPrikaz("{$this->kompresor} -help");
        break;

        case "listdir":
          $typ = $_POST["typ"];

          $line_break = (!Empty($_POST["line_break"]) ? " --line-break {$_POST["line_break"]}" : "");
          $verbose = (!Empty($_POST["verbose"]) ? " --verbose" : "");

          $charset = (!Empty($_POST["charset"]) ? " --charset {$_POST["charset"]}" : "");
          $outfile = (!Empty($_POST["outfile"]) ? " -o " : "");

          $nomunge = (!Empty($_POST["nomunge"]) ? " --nomunge" : "");
          $preserve_semi = (!Empty($_POST["preserve_semi"]) ? " --preserve-semi" : "");
          $disable_optimizations = (!Empty($_POST["disable_optimizations"]) ? " --disable-optimizations" : "");

          $privetek_js = $_POST["privetek_js"];
          $privetek_css = $_POST["privetek_css"];

          $out = "";
          switch ($typ)
          {
            case "js":
              $jsfile = $this->ProjdiSlozku($this->jsdir);

              for ($i = 0; $i < count($jsfile); $i++)
              {
                if (!Empty($privetek_js) && !Empty($outfile))
                {
                  $out = "{$outfile}{$this->VlozText($jsfile[$i], $privetek_js)}";
                }

                $vystup .= $this->VykonejPrikaz("{$this->kompresor} {$jsfile[$i]} --type js{$line_break}{$verbose}{$charset}{$out}{$nomunge}{$preserve_semi}{$disable_optimizations}");
              }
            break;

            case "css":
              $cssfile = $this->ProjdiSlozku($this->cssdir);

              for ($i = 0; $i < count($cssfile); $i++)
              {
                if (!Empty($privetek_css) && !Empty($outfile))
                {
                  $out = "{$outfile}{$this->VlozText($cssfile[$i], $privetek_css)}";
                }

                $vystup .= $this->VykonejPrikaz("{$this->kompresor} {$cssfile[$i]} --type css{$line_break}{$verbose}{$charset}{$out}");
              }
            break;

            case "jscss":
              $jsfile = $this->ProjdiSlozku($this->jsdir);

              for ($i = 0; $i < count($jsfile); $i++)
              {
                if (!Empty($privetek_js) && !Empty($outfile))
                {
                  $out = "{$outfile}{$this->VlozText($jsfile[$i], $privetek_js)}";
                }

                $vystup .= $this->VykonejPrikaz("{$this->kompresor} {$jsfile[$i]} --type js{$line_break}{$verbose}{$charset}{$out}{$nomunge}{$preserve_semi}{$disable_optimizations}");
              }

              $cssfile = $this->ProjdiSlozku($this->cssdir);

              for ($i = 0; $i < count($cssfile); $i++)
              {
                if (!Empty($privetek_css) && !Empty($outfile))
                {
                  $out = "{$outfile}{$this->VlozText($cssfile[$i], $privetek_css)}";
                }

                $vystup .= $this->VykonejPrikaz("{$this->kompresor} {$cssfile[$i]} --type css{$line_break}{$verbose}{$charset}{$out}");
              }
            break;
          }
        break;
      }
    }

    $result =
  "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
    <title>YUI Compressor</title>
    <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\"><a href=\"./\" title=\"YUI Compressor\"></a></div>
      <div id=\"obal_obsah\">
        <form method=\"post\" action=\"\">
          <fieldset>
            <dl>
              <dt class=\"center full-width\">Hlavní nastavení kompresoru</dt>
            </dl>
            <dl>
              <dt><label for=\"napoveda_compressoru\">Nápověda kompresoru</label></dt>
              <dd><input type=\"radio\"".($_POST["volba"] == "help" ? " checked=\"checked\"" : "")." name=\"volba\" value=\"help\" id=\"napoveda_compressoru\" /></dd>
            </dl>
            <dl>
              <dt><label for=\"provest_kompresi\">Provést kompresi ze složek</label></dt>
              <dd><input type=\"radio\"".($_POST["volba"] == "listdir" || Empty($_POST["volba"]) ? " checked=\"checked\"" : "")." name=\"volba\" value=\"listdir\" id=\"provest_kompresi\" /></dd>
            </dl>
            <dl>
              <dt><label for=\"line-break\">Číslo = po deklaraci se vloží řádek<span>Prázdné pole = jeden souvislý řádek</span></label></dt>
              <dd class=\"vertical-center dd_line_break\"><input type=\"text\" name=\"line_break\" value=\"{$_POST["line_break"]}\" id=\"line-break\" /></dd>
            </dl>
            <dl>
              <dt><label for=\"verbose-info\">Zobrazit informace a varování</label></dt>
              <dd><input type=\"checkbox\" name=\"verbose\"".(!Empty($_POST["verbose"]) ? " checked=\"checked\"" : "")." id=\"verbose-info\"/></dd>
            </dl>
            <dl class=\"input_text_border\">
              <dt><label for=\"vystup_js\">Doplní před koncovku .js odlišující text</label></dt>
              <dd><input type=\"text\" name=\"privetek_js\" value=\"-yui\" id=\"vystup_js\" /></dd>
            </dl>
            <dl class=\"input_text_border\">
              <dt><label for=\"vystup_css\">Doplní před koncovku .css odlišující text</label></dt>
              <dd><input type=\"text\" name=\"privetek_css\" value=\"-yui\" id=\"vystup_css\" /></dd>
            </dl>
            <dl class=\"input_text_border\">
              <dt><label for=\"select_vybrat\">Určuje z jakých složek bude prováděna komprese</label></dt>
              <dd>
                <select name=\"typ\" id=\"select_vybrat\">
                  <option value=\"js\"".($_POST["typ"] == "js" ? " selected=\"selected\"" : "").">JS</option>
                  <option value=\"css\"".($_POST["typ"] == "css" ? " selected=\"selected\"" : "").">CSS</option>
                  <option value=\"jscss\"".($_POST["typ"] == "jscss" ? " selected=\"selected\"" : "")." class=\"posledni\">JS &amp; CSS</option>
                </select>
              </dd>
            </dl>
            <dl class=\"input_text_border\">
              <dt><label for=\"charset_nastaveni\">Nastaví charset</label></dt>
              <dd><input type=\"text\" name=\"charset\" value=\"UTF-8\" id=\"charset_nastaveni\" /></dd>
            </dl>
            <dl>
              <dt><label for=\"outfile_vystup\">Jestliže je povoleno, tak bude komprese prováděna do souboru<span>Když se nepovolí, tak se výsledná komprese jen vypíše</span></label></dt>
              <dd class=\"vertical-center\"><input type=\"checkbox\" name=\"outfile\"".(!Empty($_POST["outfile"]) ? " checked=\"checked\"" : "")." id=\"outfile_vystup\" /></dd>
            </dl>
            <dl>
              <dt class=\"center full-width\">Následující nastavení je určeno jen pro kompresi JS</dt>
            </dl>
            <dl>
              <dt><label for=\"minify_only\">Pokud je povoleno, tak ponechá původní názvy proměnných</label></dt>
              <dd><input type=\"checkbox\" name=\"nomunge\"".(!Empty($_POST["nomunge"]) ? " checked=\"checked\"" : "")." id=\"minify_only\" /></dd>
            </dl>
            <dl>
              <dt><label for=\"preserve-semi\">Zachovat všechny (zbytečné) středníky</label></dt>
              <dd><input type=\"checkbox\" name=\"preserve_semi\"".(!Empty($_POST["preserve_semi"]) ? " checked=\"checked\"" : "")." id=\"preserve-semi\" /></dd>
            </dl>
            <dl>
              <dt><label for=\"disable-optimizations\">Vypnout všechny mikro optimalizace</label></dt>
              <dd><input type=\"checkbox\" name=\"disable_optimizations\"".(!Empty($_POST["disable_optimizations"]) ? " checked=\"checked\"" : "")." id=\"disable-optimizations\" /></dd>
            </dl>
            <dl>
              <dt class=\"full-width final\"><input type=\"submit\" name=\"tlacitko\" value=\"Vykonat\" id=\"tl_vykonat\" /></dt>
            </dl>
          </fieldset>
        </form>
        <div class=\"vypisy_souboru vypis_js\">
          <ul>
            <li class=\"nadpis_vypisu\">Výpis složky JS</li>
{$this->FormatujVypis($this->jsdir)}          </ul>
        </div>
        <div class=\"vypisy_souboru vypis_css\">
          <ul>
            <li class=\"nadpis_vypisu\">Výpis složky CSS</li>
{$this->FormatujVypis($this->cssdir)}          </ul>
        </div>{$vystup}
      </div>
      <div id=\"zapati\">
        <p>
          Created by <a href=\"http://www.gfdesign.cz/\" title=\"GF Design - Tvorba webových stránek a systémů\">GF design</a>
        </p>
      </div>
    </div>
  </body>
</html>";

    echo $result;
  }

/**
 *
 * Formatuje vypis souboru do divatelne podoby
 *
 * @param cesta cesta slozky
 * @return naformatovany vypis
 */
  private function FormatujVypis($cesta)
  {
    $soubor = $this->ProjdiSlozku($cesta);
    $result = "";

    if (count($soubor) > 0)
    {
      for ($i = 0; $i < count($soubor); $i++)
      {
        $jmeno = basename($soubor[$i]);
        $result .=
         "            <li>{$jmeno}</li>\n";
      }
    }
      else
    {
      $result =
      "            <li class=\"zadny_soubor\">Složka je prázdná</li>\n";
    }

    return $result;
  }

/**
 *
 * Projde zadanou slozku a vrati v poli jeji soubory
 *
 * @param cesta cesta slozky
 * @return pole souboru
 */
  private function ProjdiSlozku($cesta)
  {
    if (!file_exists($cesta))
    {
      mkdir($cesta, 0777);
    }

    $handle = opendir($cesta);
    $i = 0;
    $result = "";
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "file":
            $result[$i] = "{$cesta}/{$soub}";
            $i++;
          break;
        }
      }
    }
    closedir($handle);

    return ($i > 0 ? $result : NULL);
  }

/**
 *
 * Zavola systemove volani systemu a vrati vysledek
 *
 * @param prikaz je prikaz na vykonani
 * @return textovy vystup prikazu
 */
  private function VykonejPrikaz($prikaz)
  {
    if (!Empty($prikaz))
    {
      exec($prikaz, $out);
    }

    $result =
    "\n<div id=\"vypis_kompresoru\">\n<p>Volaný příkaz: <strong>{$prikaz}</strong></p>\n";
    for ($i = 0; $i < count($out); $i++)  //redukce posledniho radku
    {
      $result .=
      "{$out[$i]}\n";
    }

    $result .=
    "</div>";

    return $result;
  }

/**
 *
 * Vlozi dany vklad do textoveho nazvu souboru, mezi koncovku a nazev
 *
 * @param text celkovy nazev souboru
 * @param vklad vkladany text
 * @return upraveny nazev s vkladem
 */
  private function VlozText($text, $vklad)
  {
    $a = explode(".", $text);
    $koncovka = $a[count($a) - 1];

    $nazev = "";
    for ($i = 0; $i < count($a) - 1; $i++)
    {
      $nazev .= $a[$i];
    }

    $result = "{$nazev}{$vklad}.{$koncovka}";

    return $result;
  }
}

$web = new YuiCompressor();
?>
