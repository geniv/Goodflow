<?php
class RspHostel
{
  var $kam; //globální kam
  var $chyba;
  var $default = "uvod";
  var $meta;
  public $temp = "temp/hostel";   //na serveru prazdne    /temp/hostel
  public $web;
  var $adresa = array("uvod" => "uvod",
                      "informace" => "informace",
                      "rezervace" => "rezervace",
                      "ceny" => "ceny",
                      "akce" => "akce",
                      "sluzby" => "sluzby",
                      "mapa_stranek" => "mapa-stranek",
                      "mapa" => "mapa",
                      "odkazy" => "odkazy",
                      "dokumenty" => "dokumenty",
                      "byty" => "domy-byty",
                      "rekreace" => "ubytovani-rekreace",
                      "ostatni" => "nebytove-prostory-ostatni",
                      "prohlaseni_o_pristupnosti" => "prohlaseni-o-pristupnosti",
                      "admin_webmaster" => "admin-webmasters",
                      "admin_moderator" => "admin-moderator",
                      "" => "");

  var $typjaz = array("czech" => "CZ",
                      "polak" => "PL",
                      "english" => "EN");
//******************************************************************************
  function RspHostel()
  {
    $this->web = "http://{$_SERVER["SERVER_NAME"]}{$this->temp}";
    $obsah = $this->ObsahStrakny(); //plni se promenna this->kam
    $vlajky = $this->VolbaJazyka();
    $menu = $this->MenuStranky();
    $this->StartCas();
    //**************************************************************************
    switch ($this->kam)
    {
      //************************************************************************
      case "uvod":
        $uvod = "_uvod";
        $aktuality = include_once "aktuality.php";
        $nadpisaktuality =
        "
                  <h3 class=\"aktuality_uvod\">
                    {$this->jazyk["aktuality"]}
                  </h3>
        ";
      break;
      //************************************************************************
      case "byty":
        $aktiv[0] = " aktivni";
      break;
      //************************************************************************
      case "rekreace":
        $aktiv[1] = " aktivni";
      break;
      //************************************************************************
      case "ostatni":
        $aktiv[2] = " aktivni";
      break;
      //************************************************************************
      default:
        $uvod = $aktuality = "";
      break;
      //************************************************************************
    }
    //**************************************************************************
    if ($this->kam != "uvod")
    {
      $title = "{$this->jazyk["nadpis"]} - {$this->jazyk[$this->kam]}";
    }
      else
    {
      $title = "{$this->jazyk["nadpis"]}";
    }
    $result =
      "
      <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
          <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <meta http-equiv=\"Content-Language\" content=\"cs\" />
            <meta name=\"author\" content=\"\" />
            <meta name=\"copyright\" content=\"\" />
            <meta name=\"description\" content=\"\" />
            {$this->meta}
              <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->web}/styles/global_styles.css\" media=\"screen\" />
            <!--[if IE]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->web}/styles/styles_IE.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE 7]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->web}/styles/styles_IE7.css\" media=\"screen\" />
            <![endif]-->
            <!--[if lte IE 6]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->web}/styles/styles_IE6.css\" media=\"screen\" />
            <![endif]-->
            <title>{$title}</title>
          </head>
          <body>
            <div id=\"obal_layout\" class=\"obal_layout_sekce{$uvod}\">
              <h1>Hostel - Ubytování - Vila Anna Kail</h1>
              <div id=\"menu_top\">
                {$menu}
                <p id=\"text_jazyk\">
                  {$this->jazyk["jazyk"]}: {$this->typjaz[$this->AktualniJazyk()]}
                </p>
              </div>
              <div id=\"zahlavi\">
                <div id=\"jazyky_vlajky\">
                  {$vlajky}
                </div>
              </div>
              <div id=\"zahlavi_nadpis_{$this->AktualniJazyk()}\"></div>
              <div id=\"panel_center_menu\">
                <ul>
                  <li>
                    <a href=\"domy-byty\" title=\"{$this->jazyk["byty"]}\" class=\"domy_byty_{$this->AktualniJazyk()}\">
                      <span class=\"button_obr{$aktiv[0]}\"></span>
                      <span>{$this->jazyk["byty"]}</span>
                    </a>
                  </li>
                  <li>
                    <a href=\"ubytovani-rekreace\" title=\"{$this->jazyk["rekreace"]}\" class=\"ubytovani_rekreace_{$this->AktualniJazyk()}\">
                      <span class=\"button_obr{$aktiv[1]}\"></span>
                      <span>{$this->jazyk["rekreace"]}</span>
                    </a>
                  </li>
                  <li>
                    <a href=\"nebytove-prostory-ostatni\" title=\"{$this->jazyk["ostatni"]}\" class=\"nebytove_prostory_ostatni_{$this->AktualniJazyk()}\">
                      <span class=\"button_obr{$aktiv[2]}\"></span>
                      <span>{$this->jazyk["ostatni"]}</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div id=\"obal_menu_nadpis_sekce\">
                <div id=\"menu_nadpis_sekce\">
                  <h3>
                    {$this->jazyk[$this->kam]}
                  </h3>
                  <div id=\"mezera_nadpis_sekce{$uvod}\"></div>
                  {$nadpisaktuality}
                </div>
              </div>
              <div class=\"obal_obsah{$uvod}\">
                <div class=\"obsah_sekce{$uvod}\">
                  {$obsah}
                </div>
                {$aktuality}
              </div>
              <div id=\"zapati{$uvod}\">
                <div id=\"obal_zapati\">
                  <p id=\"mapa_stranek\">
                    <a href=\"mapa-stranek\" title=\"{$this->jazyk["mapa_stranek"]}\">{$this->jazyk["mapa_stranek"]}</a>
                  </p>
                  <p id=\"prohlaseni\">
                    <a href=\"prohlaseni-o-pristupnosti\" title=\"{$this->jazyk["prohlaseni_o_pristupnosti"]}\">{$this->jazyk["prohlaseni_o_pristupnosti"]}</a>
                  </p>
                  <p id=\"aw\">
                    <a href=\"admin-webmasters\" title=\"{$this->jazyk["admin_webmaster"]}\"></a>
                  </p>
                  <p id=\"am\">
                    <a href=\"admin-moderator\" title=\"{$this->jazyk["admin_moderator"]}\"></a>
                  </p>
                  {$this->KonecCas()}
                  <p id=\"tvurci\">
                    © 2008 RSP Invest s.r.o. | Created by <a href=\"http://www.gfdesign.cz/\" title=\"GF design\" onclick=\"window.open(this.href); return false\">GF design</a>
                  </p>
                </div>
              </div>
            </div>
          </body>
        </html>
    ";

    print $result;
  }
//******************************************************************************
  function ObsahStrakny()
  {
    $kam = $_GET["action"];

    if (!Empty($kam))
    {
      if (file_exists("{$kam}.php"))
      {
        $this->kam = $kam;
        $result = include_once "{$kam}.php";
      }
        else
      {
        $this->kam = $this->default;
        $result = include_once "{$this->default}.php";
      }
    }
      else
    {
      $this->kam = $this->default;
      $result = include_once "{$this->default}.php";
    }

    return $result;
  }
//******************************************************************************
  function MenuStranky()
  {
    $result =
    "
                <div id=\"odkazy_menu_top_{$this->AktualniJazyk()}\">
                  <h2>
                    <a href=\"uvod\" title=\"{$this->jazyk["uvod"]}\">{$this->jazyk["uvod"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"informace\" title=\"{$this->jazyk["informace"]}\">{$this->jazyk["informace"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"rezervace\" title=\"{$this->jazyk["rezervace"]}\">{$this->jazyk["rezervace"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"ceny\" title=\"{$this->jazyk["ceny"]}\">{$this->jazyk["ceny"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"akce\" title=\"{$this->jazyk["akce"]}\">{$this->jazyk["akce"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"sluzby\" title=\"{$this->jazyk["sluzby"]}\">{$this->jazyk["sluzby"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"mapa\" title=\"{$this->jazyk["mapa"]}\">{$this->jazyk["mapa"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"odkazy\" title=\"{$this->jazyk["odkazy"]}\">{$this->jazyk["odkazy"]}</a>
                  </h2>
                    <span></span>
                  <h2>
                    <a href=\"dokumenty\" title=\"{$this->jazyk["dokumenty"]}\">{$this->jazyk["dokumenty"]}</a>
                  </h2>
                </div>
    ";

    return $result;
  }
//******************************************************************************
  function AktualniJazyk()
  {
    $kolac = $_COOKIE["RSP_LANG"];

    if (!Empty($kolac))
    {
      $result = $kolac;
    }
      else
    {
      $result = "czech";
    }

    return $result;
  }
//******************************************************************************
  function VolbaJazyka()
  {
    $kolac = $_COOKIE["RSP_LANG"];

    if (!Empty($kolac))
    {
      $cesta = $kolac;
    }
      else
    {
      $cesta = "czech";
    }

    if (file_exists("{$cesta}.php"))
    {
      $this->jazyk = include_once "{$cesta}.php";
    }
      else
    {
      $this->jazyk = include_once "czech.php";
    }

    switch ($cesta)
    {
      case "czech":
        $sel[0] = " aktivni";
      break;

      case "polak":
        $sel[1] = " aktivni";
      break;

      case "english":
        $sel[2] = " aktivni";
      break;
    }

    $result =
    "
                  <form action=\"\" method=\"get\">
                    <fieldset>
                      <legend>Změnit jazyk</legend>
                        <label for=\"vlajka_czech\">{$this->jazyk["cz"]}</label>
                          <input id=\"vlajka_czech\" class=\"vlajka_czech_pozadi{$sel[0]}\" type=\"submit\" name=\"czech\" value=\"\" title=\"{$this->jazyk["cz"]}\" />
                        <label for=\"vlajka_polak\">{$this->jazyk["pl"]}</label>
                          <input id=\"vlajka_polak\" class=\"vlajka_polak_pozadi{$sel[1]}\" type=\"submit\" name=\"polak\" value=\"\" title=\"{$this->jazyk["pl"]}\" />
                        <label for=\"vlajka_english\">{$this->jazyk["en"]}</label>
                          <input id=\"vlajka_english\" class=\"vlajka_english_pozadi{$sel[2]}\" type=\"submit\" name=\"english\" value=\"\" title=\"{$this->jazyk["en"]}\" />
                    </fieldset>
                  </form>
    ";

    if (array_key_exists("czech", $_GET))
    {
      $language = "czech";
    }

    if (array_key_exists("polak", $_GET))
    {
      $language = "polak";
    }

    if (array_key_exists("english", $_GET))
    {
      $language = "english";
    }

    if (!Empty($language))
    {
      SetCookie("RSP_LANG", $language, Time() + 31536000); //zápis do cookie
      $this->AutoClick(0, $this->kam);
    }

    return $result;
  }
//******************************************************************************
  function AutoClick($cas, $cesta)  //auto kliknutí
  {
    $url = $this->adresa[$cesta]; //konverze get->.htaccess
    $this->meta = "<meta http-equiv=\"refresh\" content=\"$cas;URL=$url\" />";
  }
//******************************************************************************
  var $start, $konec;
  function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $soucet = $cas[1] + $cas[0];

    return $soucet;
  }
//******************************************************************************
  function StartCas() //zapis začátku
  {
    $this->start = $this->MeritCas();
  }
//******************************************************************************
  function KonecCas() //zápis konce a finální vypis doby
  {
    $this->konec = $this->MeritCas();
    $presnost = 10000; //nastavená přesnost
    $cas = Abs((Round(($this->konec - $this->start) * $presnost)) / $presnost); //Abs, výpočet
    $result =
    "
                <p id=\"gen\">
                  {$this->jazyk["vygenerovano"]}: $cas ms
                </p>
    ";

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************

}
?>
