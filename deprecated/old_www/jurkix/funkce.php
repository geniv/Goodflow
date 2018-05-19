<?php
class Hlavni
{
  public $var, $web;
//******************************************************************************
  function __construct(&$var)  //konstruktor
  {
    $this->var = $var;

    $this->var->web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";

    $this->var->jurixweb = new SQLiteDatabase($this->var->nazevdbweb);
    $this->var->jurixgra = new SQLiteDatabase($this->var->nazevdbgra);

    $this->Instalace();
    //$this->StartCas();
/*
    $this->jurixweb = new SQLiteDatabase($this->nazevdbweb);
    $this->jurixgra = new SQLiteDatabase($this->nazevdbgra);
    $this->Instalace();
    $this->StartCas();

    $novinky = include_once "novinky.php";
    $web = "http://{$_SERVER["SERVER_NAME"]}{$this->temp}";
    $obsah = $this->ObsahStrakny();
    $menu = $this->Menu();
    $chyba = $this->chyba;

    $result =
      "
      <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
          <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <meta http-equiv=\"Content-Language\" content=\"cs\" />
            <meta name=\"author\" content=\"Jurkix &amp; Geniv &amp; Fugess, (GF Design)\" />
            <meta name=\"copyright\" content=\"Jurkix (c) 2008, Geniv (c) 2008, Fugess (c) 2008, Created by GF Design - info@gfdesign.cz\" />
            <meta name=\"keywords\" content=\"Jurkix, Jurkix design, Jurkix GFdesign, grafika, photoshop, cinema 4d, pixel art, flash, design, webdesign, web, tvorba webu, návrh webu\" />
            <meta name=\"description\" content=\"Jurkix design - Grafika | Animace | Webdesign\" />
            <meta name=\"robots\" content=\"index, follow\" />
              <link rel=\"stylesheet\" type=\"text/css\" href=\"$web/styles/global_styles.css\" media=\"screen\" />
            <!--[if IE]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"$web/styles/styles_IE.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE 7]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"$web/styles/styles_IE7.css\" media=\"screen\" />
            <![endif]-->
            <!--[if lte IE 6]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"$web/styles/styles_IE6.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE]>
              <script type=\"text/javascript\" src=\"$web/script/script_flash.js\" defer=\"defer\"></script>
            <![endif]-->
            <script type=\"text/javascript\" src=\"$web/script/funkce.js\"></script>
              <!-- lightbox -->
                <script type=\"text/javascript\" src=\"$web/script/lightbox/prototype.js\"></script>
                <script type=\"text/javascript\" src=\"$web/script/lightbox/scriptaculous.js?load=effects,builder\"></script>
                <script type=\"text/javascript\" src=\"$web/script/lightbox/lightbox.js\"></script>
              <!-- lightbox -->
            <script type=\"text/javascript\">
              var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
              document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
            </script>
            <script type=\"text/javascript\">
              var pageTracker = _gat._getTracker(\"UA-4450047-3\");
              pageTracker._initData();
              pageTracker._trackPageview();
            </script>
            <script type=\"text/javascript\">
              var prom = \"{$_GET["action"]}\";
              if (prom == '')
              {
                AjaxStranka({$this->default}, NULL, NULL, NULL);
              }
            </script>
            <title>Jurkix design - {$this->Title()}</title>
          </head>
          <body>
              <div id=\"zahlavi\">
                <h1>Jurkix design - Grafika | Animace | Webdesign</h1>
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"$web/flash/logo_new_web.swf\" width=\"710\" height=\"165\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"710\" height=\"165\">
                    <param name=\"movie\" value=\"$web/flash/logo_new_web.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#433025\" />
                    <p id=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>
            <div id=\"obal_layout\">
              <div id=\"menu\">
                $menu
              </div>
              <div id=\"obal_obsah\">
                <div id=\"obsah\">
                  $obsah
                  $chyba
                </div>
                <div id=\"obal_novinky\">
                  <div id=\"novinky_top\"></div>
                    <div id=\"novinky_obsah\">
                      $novinky
                    </div>
                  <div id=\"novinky_bottom\"></div>
                </div>
              </div>
              <div id=\"zapati\">
                {$this->KonecCas()}
                <p>
                  {$this->TextSekce("zapati")} | Valid <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict\" rel=\"nofollow\">xhtml</a> &amp; <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS 2.1\" rel=\"nofollow\">css</a> |
                </p>
              </div>
            </div>
          </body>
        </html>
    ";

    echo $result;*/
  }
//******************************************************************************
  function MenuAjax()
  {
    switch ($this->var->kam)
    {
      case "uvod":
        $aktivni[0] = " aktivni";
      break;

      case "grafika":
        $aktivni[1] = " aktivni";
      break;

      case "nabidka":
        $aktivni[2] = " aktivni";
      break;

      case "kontakt":
        $aktivni[3] = " aktivni";
      break;

      default:
        if ($this->var->kam != "administrace")  //kdyz neni v adminu
        {
          $aktivni[0] = " aktivni";
        }
      break;
    }

    $result =
    "
              <ul>
                <li class=\"menu_uvod{$aktivni[0]}\"><a href=\"#\" onclick=\"AjaxStranka('uvod', '', '', '');\" title=\"Úvod\"><em>Úvod</em></a></li>
                <li class=\"menu_grafika{$aktivni[1]}\"><a href=\"#\" onclick=\"AjaxStranka('grafika', '', '', '');\" title=\"Grafika\"><em>Grafika</em></a></li>
                <li class=\"menu_nabidka{$aktivni[2]}\"><a href=\"#\" onclick=\"AjaxStranka('nabidka', '', '', '');\" title=\"Nabídka\"><em>Nabídka</em></a></li>
                <li class=\"menu_kontakt{$aktivni[3]}\"><a href=\"#\" onclick=\"AjaxStranka('kontakt', '', '', '');\" title=\"Kontakt\"><em>Kontakt</em></a></li>
              </ul>
              <p>
                <a href=\"?action=administrace\" title=\"Administrace\"><em>Administrace</em></a>
              </p>
    ";
//onclick=\"AjaxStranka('administrace', '', '', '');\"
    return $result;
  }
//******************************************************************************
  function Menu()
  {
    switch ($this->var->kam)
    {
      case "uvod":
        $aktivni[0] = " aktivni";
      break;

      case "grafika":
        $aktivni[1] = " aktivni";
      break;

      case "nabidka":
        $aktivni[2] = " aktivni";
      break;

      case "kontakt":
        $aktivni[3] = " aktivni";
      break;

      default:
        if ($this->var->kam != "administrace")  //kdyz neni v adminu
        {
          $aktivni[0] = " aktivni";
        }
      break;
    }

    $result =
    "
              <ul>
                <li class=\"menu_uvod{$aktivni[0]}\"><a href=\"?action=uvod\" title=\"Úvod\"><em>Úvod</em></a></li>
                <li class=\"menu_grafika{$aktivni[1]}\"><a href=\"?action=grafika\" title=\"Grafika\"><em>Grafika</em></a></li>
                <li class=\"menu_nabidka{$aktivni[2]}\"><a href=\"?action=nabidka\" title=\"Nabídka\"><em>Nabídka</em></a></li>
                <li class=\"menu_kontakt{$aktivni[3]}\"><a href=\"?action=kontakt\" title=\"Kontakt\"><em>Kontakt</em></a></li>
              </ul>
              <p>
                <a href=\"?action=administrace\" title=\"Administrace\"><em>Administrace</em></a>
              </p>
    ";

    return $result;
  }
//******************************************************************************
  function MenuAdmin()
  {
    $result =
    "
    <div id=\"menu_admin\">
      <p id=\"uprava_textu\">
        <a href=\"?action=administrace&amp;akce=texty\" title=\"Úprava textů\">Úprava textů</a>
      </p>
      <p id=\"panel_novinky\">
        <a href=\"?action=administrace&amp;akce=novinky\" title=\"Panel Novinky\">Panel Novinky</a>
      </p>
      <p id=\"panel_grafika\">
        <a href=\"?action=administrace&amp;akce=grafika\" title=\"Panel Grafika\">Panel Grafika</a>
      </p>
      <p id=\"panel_kontakty\">
        <a href=\"?action=administrace&amp;akce=kontakt\" title=\"Panel Kontakty\">Panel Kontakty</a>
      </p>
      <p id=\"uvodni_strana\">
        <a href=\"?action=administrace\" title=\"Úvodní strana\">Úvodní strana</a>
      </p>
      <p id=\"odhlasit\">
        <a href=\"?action=administrace&amp;akce=logoff\" title=\"Odhlásit\">Odhlásit</a>
      </p>

      <p id=\"\">
        <a href=\"?action=administrace&amp;akce=pocadmin\" title=\"Počítadlo\">Počítadlo</a>
      </p>

    </div>
    <div class=\"hr\">
      <p></p>
    </div>
    ";
//AjaxStranka('administrace', 'logoff', '', '');
    return $result;
  }
//******************************************************************************
  function AutoClick($cas, $cesta)  //auto kliknutí, procedůra
  {
    $this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }
//******************************************************************************
/*
  function Title()
  {
    $title = array ("uvod" => "Úvod",
                    "grafika" => "Grafika",
                    "nabidka" => "Nabídka",
                    "kontakt" => "Kontakt",
                    "administrace" => "Administrace",
                    "odhlasit" => "Odhlášení");

    return $title[$this->var->kam];
  }*/
//******************************************************************************
  function ObsahStrakny()
  {
    $kam = $_GET["action"];

    if (!Empty($kam))
    {
      if (file_exists("{$kam}.php"))
      {
        $this->var->kam = $kam;
        $result = include_once "{$this->var->kam}.php";
      }
        else
      {
        $this->var->kam = $this->var->default;
        $result = include_once "{$this->var->kam}.php";
      }
    }
      else
    {
      $this->var->kam = $this->var->default;
      $result = include_once "{$this->var->kam}.php";
    }

    return $result;
  }
//******************************************************************************
  function ObsahAdmin()
  {
    switch ($_GET["akce"])
    {
      case "texty":

        if (!Empty($_POST["tlacitko"]) &&
            !Empty($_POST["zapati"]) &&
            !Empty($_POST["uvod"]) &&
            !Empty($_POST["grafika"]) &&
            !Empty($_POST["nabidka"]) &&
            !Empty($_POST["kontakt"]) &&
            !Empty($_POST["administrace"]))
        {
          $nadpis = $this->UpravitTexty();
          $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result =
        "
        <h4>Úprava textů</h4>
          {$nadpis}
        <form id=\"admin_uprava_textu_form\" action=\"\" method=\"post\">
          <fieldset>
          <legend>Úprava textů</legend>
            <label for=\"text_uvod\">Text v sekci Úvod:</label>
              <textarea id=\"text_uvod\" name=\"uvod\" cols=\"\" rows=\"\">{$this->TextSekce("uvod")}</textarea>
            <label for=\"text_grafika\">Text v sekci Grafika:</label>
              <textarea id=\"text_grafika\" name=\"grafika\" cols=\"\" rows=\"\">{$this->TextSekce("grafika")}</textarea>
            <label for=\"text_nabidka\">Text v sekci Nabídka:</label>
              <textarea id=\"text_nabidka\" name=\"nabidka\" cols=\"\" rows=\"\">{$this->TextSekce("nabidka")}</textarea>
            <label for=\"text_kontakt\">Text v sekci Kontakt:</label>
              <textarea id=\"text_kontakt\" name=\"kontakt\" cols=\"\" rows=\"\">{$this->TextSekce("kontakt")}</textarea>
            <label for=\"text_administrace\">Text v sekci Administrace:</label>
              <textarea id=\"text_administrace\" name=\"administrace\" cols=\"\" rows=\"\">{$this->TextSekce("administrace")}</textarea>
            <label for=\"text_zapati\">Text v zápatí:</label>
              <textarea id=\"text_zapati\" name=\"zapati\" cols=\"\" rows=\"\">{$this->TextSekce("zapati")}</textarea>
            <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" title=\"Potvrdit\" />
          </fieldset>
        </form>
        ";
      break;
      //************************************************************************
      case "novinky":
        $detachdatum = date("j.n.y");
        $cislo = $_GET["cislo"];
        settype($cislo, "integer");

        if ($res = @$this->var->jurixweb->query("SELECT detachdatum, zprava FROM novinky WHERE id={$cislo};", NULL, $error))
        {
          $data = $res->fetchObject();
        }
          else
        {
          $this->ErrorMsg($error);
        }

        switch ($_GET["co"])
        {
          case "add":
            $aed =
            "
            <form id=\"admin_pridat_novinku_form\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Panel Novinky</legend>
                <div id=\"tlacitka_formatovani_pisma\">
                {$this->FormatovaniTextu("label_input_novinka")}
                </div>
                <label for=\"label_input_datum\">Datum:</label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"detachdatum\" value=\"{$detachdatum}\" title=\"D.M.RR\" />
                <label for=\"label_input_novinka\" id=\"label_novinka\">Novinka:</label>
                  <textarea id=\"label_input_novinka\" name=\"novinka\" cols=\"\" rows=\"\"></textarea>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" title=\"Přidat Novinku\" />
              </fieldset>
            </form>
            ";

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($_POST["novinka"]) &&
                !Empty($_POST["detachdatum"]))
            {
              $aed = $this->PridejNovinku();
              $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
            }
          break;

          case "edit":
            if ($cislo != 0)
            {
              $aed =
            "
            <form id=\"admin_pridat_novinku_form\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Panel Novinky</legend>
                <div id=\"tlacitka_formatovani_pisma\">
                {$this->FormatovaniTextu("label_input_novinka")}
                </div>
                <label for=\"label_input_datum\">Datum:</label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"detachdatum\" value=\"{$data->detachdatum}\" title=\"D.M.RR\" />
                <label for=\"label_input_novinka\" id=\"label_novinka\">Novinka:</label>
                  <textarea id=\"label_input_novinka\" name=\"novinka\" cols=\"\" rows=\"\">{$data->zprava}</textarea>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" title=\"Uložit Novinku\" />
              </fieldset>
            </form>
            ";

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($_POST["novinka"]) &&
                  !Empty($_POST["detachdatum"]) &&
                  $cislo != 0)
              {
                $aed = $this->UpravNovinku($cislo);
                $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
              }
            }
          break;

          case "del":
            if ($cislo != 0)
            {
              $aed =
              "
              <div id=\"potvrzeni_ulozeno\">
                <p>
                  Chystáš se smazat novinku
                </p>
                <p>
                  s datem:
                </p>
                <p>
                  <em>{$data->detachdatum}</em>
                </p>
                <p>
                  a textem:
                </p>
                <p>
                  <em>{$data->zprava}</em>
                </p>
                <p>
                  Opravdu chceš tuto novinku smazat ?
                </p>
              </div>
              <form id=\"admin_smazat_novinku_form\" action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chceš tuto novinku smazat ?</legend>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

              if (!Empty($_POST["ano"]) &&
                  $cislo != 0)
              {
                $aed = $this->SmazNovinku($cislo);
                $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
              }
                else
              {
                if (!Empty($_POST["ne"]))
                {
                  $aed =
                  "
                  <div id=\"potvrzeni_ulozeno\">
                    <p>
                      Stornoval jsi smazání novinky.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
                }
              }
            }
          break;
        }

        $result =
        "
        <h4>Panel Novinky</h4>
        <p id=\"pridat\">
          <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\" title=\"Přidat novinku\"><span>Přidat novinku</span></a>
        </p>
        {$aed}
        {$this->VypisNovinekEditDel()}
        ";
      break;
      //************************************************************************
      case "grafika":
        $realdatum = date("Y-m-d H:i:s");
        $cislo = $_GET["cislo"];
        settype($cislo, "integer");

        if ($res = @$this->var->jurixgra->query("SELECT id, sekce, datum, nadpis, zprava, altobrazek FROM grafika WHERE id={$cislo};", NULL, $error))
        {
          $data = $res->fetchObject();
        }
          else
        {
          $this->ErrorMsg($error);
        }

        switch ($_GET["co"])
        {
          case "add":
            $aed =
            "
            <form id=\"admin_panel_grafika_form\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
              <legend>Přidat položku v grafice</legend>
                <label for=\"nadpis_label_input\">Nadpis:</label>
                  <input id=\"nadpis_label_input\" type=\"text\" name=\"nadpis\" />
                <label for=\"text_label_textarea\">Text:</label>
                  <textarea id=\"text_label_textarea\" name=\"zprava\" cols=\"\" rows=\"\"></textarea>
                <label for=\"datum_label_input\">Datum:</label>
                  <input id=\"datum_label_input\" type=\"text\" name=\"datum\" value=\"{$realdatum}\" title=\"(RRRR-MM-DD HH:MM:SS)\" />
                <label for=\"popis_obrazku_label_input\">Popis obrázku:</label>
                  <input id=\"popis_obrazku_label_input\" type=\"text\" name=\"altobrazek\" title=\"(alt u img)\" />
                <label for=\"nahrat_label_input\">Nahrát obrázek:</label>
                  <input id=\"nahrat_label_input\" type=\"file\" name=\"obrazek\" title=\"(png)\" />(png)
                sekce: {$this->VypisSekciGrafika()}
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" title=\"Přidat položku v grafice\" />
              </fieldset>
            </form>
            ";

            if (!Empty($_POST["nadpis"]) &&
                !Empty($_POST["zprava"]) &&
                !Empty($_POST["datum"]) &&
                !Empty($_POST["altobrazek"]) &&
                !Empty($_FILES["obrazek"]["name"]))
            {
              $aed = $this->PridejGrafiku();
              $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
            }
          break;

          case "edit":
            if ($cislo != 0)
            {
              $aed =
              "
              <form id=\"admin_panel_grafika_form\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                <legend>Upravit položku v grafice</legend>
                  <label for=\"nadpis_label_input\">Nadpis:</label>
                    <input id=\"nadpis_label_input\" type=\"text\" name=\"nadpis\" value=\"{$data->nadpis}\" />
                  <label for=\"text_label_textarea\">Text:</label>
                    <textarea id=\"text_label_textarea\" name=\"zprava\" cols=\"\" rows=\"\">{$data->zprava}</textarea>
                  <label for=\"datum_label_input\">Datum:</label>
                    <input id=\"datum_label_input\" type=\"text\" name=\"datum\" value=\"{$data->datum}\" title=\"(RRRR-MM-DD HH:MM:SS)\" />
                  <label for=\"popis_obrazku_label_input\">Popis obrázku:</label>
                    <input id=\"popis_obrazku_label_input\" type=\"text\" name=\"altobrazek\" title=\"(alt u img)\" value=\"{$data->altobrazek}\" />
                  <label>Obrázek:</label>
                    <img src=\"foto.php?action=mini&amp;id={$data->id}\" alt=\"{$data->altobrazek}\"/>

                    <input id=\"\" type=\"file\" name=\"obrazek\" title=\"(png)\" />(png)
                    {$this->VypisSekciGrafikaOznacene($data->sekce)}

                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" title=\"Upravit položku v grafice\" />
                </fieldset>
              </form>
              ";
            }

            if (!Empty($_POST["nadpis"]) &&
                !Empty($_POST["zprava"]) &&
                !Empty($_POST["datum"]) &&
                !Empty($_POST["altobrazek"]) &&
                $cislo != 0)
            {
              $aed = $this->UpravGrafiku($cislo);
              $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
            }
          break;

          case "del":
            if ($cislo != 0)
            {
              $aed =
              "
              <div id=\"potvrzeni_ulozeno\">
                <p>
                  Chystáš se smazat položku v grafice
                </p>
                <p>
                  s nadpisem:
                </p>
                <p>
                  <em>{$data->nadpis}</em>
                </p>
                <p>
                  a datem:
                </p>
                <p>
                  <em>{$data->datum}</em>
                </p>
                <p>
                  Opravdu chceš tuto položku smazat ?
                </p>
              </div>
              <form id=\"admin_smazat_novinku_form\" action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chceš tuto položku smazat ?</legend>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

              if (!Empty($_POST["ano"]) &&
                  $cislo != 0)
              {
                $aed = $this->SmazGrafiku($cislo);
                $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
              }
                else
              {
                if (!Empty($_POST["ne"]))
                {
                  $aed =
                  "
                  <div id=\"potvrzeni_ulozeno\">
                    <p>
                      Stornoval jsi smazání této položky.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
                }
              }
            }
          break;
        }

        $result =
        "
        <h4>Panel Grafika</h4>
        <p id=\"pridat\">
          <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\" title=\"Přidat položku v grafice\"><span>Přidat položku v grafice</span></a>
        </p>
        {$aed}
        {$this->VypisGrafikyEditDel()}";
      break;
      //************************************************************************
      case "kontakt":
        $cislo = $_GET["cislo"];
        settype($cislo, "integer");

        if ($res = @$this->var->jurixweb->query("SELECT jmeno, email, telefon, zprava, datum FROM kontakt WHERE id=$cislo;", NULL, $error))
        {
          $data = $res->fetchObject();
        }
          else
        {
          $this->ErrorMsg($error);
        }

        switch ($_GET["co"])
        {
          case "del":
            if ($cislo != 0)
            {
              $aed =
              "
              <div id=\"potvrzeni_ulozeno\">
                <p>
                  Chystáš se smazat položku v kontaktech
                </p>
                <p>
                  se jménem:
                </p>
                <p>
                  <em>{$data->jmeno}</em>
                </p>
                <p>
                  s e-mailem:
                </p>
                <p>
                  <em>{$data->email}</em>
                </p>
                <p>
                  s telefonem:
                </p>
                <p>
                  <em>{$data->telefon}</em>
                </p>
                <p>
                  se zprávou:
                </p>
                <p>
                  <em>{$data->zprava}</em>
                </p>
                <p>
                  a s datem:
                </p>
                <p>
                  <em>{$data->datum}</em>
                </p>
                <p>
                  Opravdu chceš tuto položku smazat ?
                </p>
              </div>
              <form id=\"admin_smazat_novinku_form\" action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chceš tuto položku smazat ?</legend>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

              if (!Empty($_POST["ano"]) &&
                  $cislo != 0)
              {
                $aed = $this->SmazKontakt($cislo);
                $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
              }
                else
              {
                if (!Empty($_POST["ne"]))
                {
                  $aed =
                  "
                  <div id=\"potvrzeni_ulozeno\">
                    <p>
                      Stornoval jsi smazání této položky.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
                }
              }
            }
          break;
        }

        $result =
        "
        <h4>Panel Kontakty</h4>
        {$aed}
        {$this->VypisKontaktuDel()}";
      break;
      //************************************************************************
      case "pocadmin":
        $result =
        "počítadlo<br />
        {$this->VypisPocitadla()}

        ";
      break;
      //************************************************************************
      default:
        switch (Date("N"))
        {
          case 1:
            $den = "Pondělí";
          break;

          case 2:
            $den = "Úterý";
          break;

          case 3:
            $den = "Středa";
          break;

          case 4:
            $den = "Čtvrtek";
          break;

          case 5:
            $den = "Pátek";
          break;

          case 6:
            $den = "Sobota";
          break;

          case 7:
            $den = "Neděle";
          break;
        }
        $result =
        "
        <div id=\"neotux\">
          <span id=\"tucnak\"></span>
          <div id=\"bublina\">
            <p>
              <em>Vítej</em>
            </p>
            <p>
              <em>V Administraci</em>
            </p>
            <p>
              Dnes je: {$den}
            </p>
            <p>
              Datum: ".Date("j.n.y")."
            </p>
            <p id=\"cas\">
              Čas: ".Date("H.i.s")."
            </p>
          </div>
        </div>
        ";
      break;
    }

    return $result;
  }
//******************************************************************************
  function KontrolaLogin($jmeno, $heslo)
  {
    $login = array ("6342fd9364b41005acce71e244849183", // radek
                    "93f9a5d3507bbd81db94663fd09dc866",
                    "48acfd8edd4b6009c8257490df01c717", // martin
                    "7c8c47575b1ff8a0a34e871a33b5954f",
                    "06b586c247dd639a269aa3bbe70fabac", // jurysek
                    "2750e0d761a4d611073ae2ac3b171753",
                    "9c83c0b9979b730f81775f6ecea19fab", // mistr - vysinka
                    "f5190f3d6c2bb1208f4bc1c7dfda6737"); //zápis loginů
    $poc = 0;

    for ($i = 0; $i < (count($login) - 1); $i++)
    {
      if ($jmeno == $login[$i] && $heslo == $login[$i + 1])
      {
        $poc++;
      }
    }

    if ($poc == 1)
    {
      $result = true;
    }
      else
    {
      $result = false;
    }

    return $result;
  }
//******************************************************************************
  function Instalace()  //Y-m-d H:i:s 2008-03-21 12:00:00
  {
    if (filesize($this->var->nazevdbweb) == 0)
    {
      if (!@$this->var->jurixweb->queryExec("CREATE TABLE kontakt (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            jmeno VARCHAR(50),
                                            email VARCHAR(50),
                                            telefon VARCHAR(20),
                                            zprava TEXT,
                                            datum DATETIME);

                                            CREATE TABLE novinky (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            detachdatum DATE,
                                            datum DATETIME,
                                            zprava TEXT);

                                            INSERT INTO novinky(detachdatum, datum, zprava) VALUES ('27.2.08', '2008-02-27 12:00:00', 'Dnes jsem dokončil redesign webu a opravil kód.');
                                            INSERT INTO novinky(detachdatum, datum, zprava) VALUES ('12.3.08', '2008-03-12 12:00:00', 'Přidán nový obrázek do sekce Grafika, pojmenovaný Chobotnice.');
                                            INSERT INTO novinky(detachdatum, datum, zprava) VALUES ('21.3.08', '2008-03-21 12:00:00', 'Do sekce grafika přidán nový výtvor. Pojmenoval jsem ho V parku.');

                                            CREATE TABLE texty (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            sekce VARCHAR(20),
                                            text TEXT);

                                            INSERT INTO texty(sekce, text) VALUES ('zapati',  '&copy; 2008 Jurkix &amp; GF Design');
                                            INSERT INTO texty(sekce, text) VALUES ('uvod',    'Vítejte na mém novém webu. Co tu najdete? Jak jinak než moje vlastní projekty, moje práce a taky nabídku grafiky, animace a webdesignu.');
                                            INSERT INTO texty(sekce, text) VALUES ('grafika', 'sekce se připravuje');
                                            INSERT INTO texty(sekce, text) VALUES ('nabidka', 'sekce se připravuje');
                                            INSERT INTO texty(sekce, text) VALUES ('kontakt', 'Pokud byste si rádi něco objednali, nebo na mě máte jakékoliv dotazy. Potom neváhejte a využijte níže uvedeného formuláře.');
                                            INSERT INTO texty(sekce, text) VALUES ('administrace',  'Pokud zde nemáte co dělat, opusťte prosím tuhle sekci. Zpět se vrátíte vybráním libovolné položky z menu.');
                                            ", $error))
      {
        $this->ErrorMsg($error);
      }
    }

    if (filesize($this->var->nazevdbgra) == 0)
    {
      if (!@$this->var->jurixgra->queryExec("CREATE TABLE grafika (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            sekce INTEGER,
                                            datum DATETIME,
                                            nadpis VARCHAR(100),
                                            zprava TEXT,
                                            altobrazek VARCHAR(100));

                                            CREATE TABLE fotografikamini (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            foto MEDIUMBLOB,
                                            nazev VARCHAR(100),
                                            typ VARCHAR(20));

                                            CREATE TABLE fotografikafull (
                                            id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                            foto LONGBLOB,
                                            nazev VARCHAR(100),
                                            typ VARCHAR(20));", $error))
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function TextSekce($sekce)
  {
    if ($res = @$this->var->jurixweb->query("SELECT text FROM texty WHERE sekce='{$sekce}';", NULL, $error))
    {
      $result = $res->fetchObject()->text;
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function UpravitTexty()
  {
    $zapati = stripslashes(htmlspecialchars($_POST["zapati"]));
    $uvod = stripslashes(htmlspecialchars($_POST["uvod"]));
    $grafika = stripslashes(htmlspecialchars($_POST["grafika"]));
    $nabidka = stripslashes(htmlspecialchars($_POST["nabidka"]));
    $kontakt = stripslashes(htmlspecialchars($_POST["kontakt"]));
    $administrace = stripslashes(htmlspecialchars($_POST["administrace"]));

    if (@$this->var->jurixweb->queryExec("UPDATE texty SET text='{$zapati}' WHERE sekce='zapati';
                                          UPDATE texty SET text='{$uvod}' WHERE sekce='uvod';
                                          UPDATE texty SET text='{$grafika}' WHERE sekce='grafika';
                                          UPDATE texty SET text='{$nabidka}' WHERE sekce='nabidka';
                                          UPDATE texty SET text='{$kontakt}' WHERE sekce='kontakt';
                                          UPDATE texty SET text='{$administrace}' WHERE sekce='administrace';", $error))
    {
      $result =
      "
      <div id=\"potvrzeni_ulozeno\">
        <p>
          Upravené texty byly uloženy.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function VypisNovinek()
  {
    if ($res = @$this->var->jurixweb->query("SELECT detachdatum, zprava FROM novinky ORDER BY datum DESC", NULL, $error))
    {
      $poc = $res->numRows();
      if ($poc != 0)
      {
        for ($i = 0; $i < $poc; $i++)
        {
          $data = $res->fetchObject();
          $zprava = str_replace($this->var->short, $this->var->long, $data->zprava);  //nahrazení textu
          $result .=
          "
          <p>
            {$data->detachdatum} - {$zprava}
          </p>
          ";
        }
      }
        else
      {
        $result = "žádná položka";
      }

    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function VypisNovinekEditDel()
  {
    if ($res = @$this->var->jurixweb->query("SELECT id, detachdatum, zprava FROM novinky ORDER BY datum DESC", NULL, $error))
    {
      $poc = $res->numRows();
      $result = "";
      for ($i = 0; $i < $poc; $i++)
      {
        $data = $res->fetchObject();
        $zprava = str_replace($this->var->short, $this->var->long, $data->zprava);  //nahrazení textu
        $result .=
        "
        <div class=\"hr\">
          <p></p>
        </div>
        <div class=\"vypis_novinek\">
          <p class=\"datum\">
            {$data->detachdatum}
          </p>
          <p class=\"smazat\">
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" title=\"Smazat novinku\"><span>Smazat novinku</span></a>
          </p>
          <p class=\"upravit\">
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$data->id}\" title=\"Upravit novinku\"><span>Upravit novinku</span></a>
          </p>
          <p class=\"text\">
            {$zprava}
          </p>
        </div>
        ";
      }
      $result .=
      "
        <div class=\"hr\">
          <p></p>
        </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function PridejNovinku()
  {
    $novinka = stripslashes(htmlspecialchars($_POST["novinka"]));
    $detachdatum = $_POST["detachdatum"];
    $realdatum = date("Y-m-d H:i:s");

    if (@$this->var->jurixweb->queryExec("INSERT INTO novinky(detachdatum, datum, zprava) VALUES ('{$detachdatum}', '{$realdatum}', '{$novinka}');", $error))
    {
      $result =
      "
      <div id=\"potvrzeni_ulozeno\">
        <p>
          Byla přidána novinka s textem:
        </p>
        <p>
          <em>{$novinka}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function UpravNovinku($id)
  {
    $novinka = stripslashes(htmlspecialchars($_POST["novinka"]));
    $detachdatum = $_POST["detachdatum"];

    if (@$this->var->jurixweb->queryExec("UPDATE novinky SET zprava='{$novinka}' WHERE id={$id};
                                          UPDATE novinky SET detachdatum='{$detachdatum}' WHERE id={$id};", $error))
    {
      $result =
      "
              <div id=\"potvrzeni_ulozeno\">
                <p>
                  Novinka byla upravena.
                </p>
                <p>
                  Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                </p>
              </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function SmazNovinku($id)
  {
    if (@$this->var->jurixweb->queryExec("DELETE FROM novinky WHERE id={$id};", $error))
    {
      $result =
      "
            <div id=\"potvrzeni_ulozeno\">
              <p>
                Novinka byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function VypisSekciGrafika()
  {
    $result =
    "<select id=\"\" name=\"sekcegrafika\">
    ";

    for ($i = 1; $i < count($this->var->sekce) + 1; $i++)
    {
      $result .= "<option value=\"{$i}\">{$this->var->sekce[$i]}</option>
                 ";
    }

    $result .=
    "</select>";

    return $result;
  }
//******************************************************************************
  function VypisSekciGrafikaOznacene($cislo)
  {
    $sekce[$cislo] = "";

    $result =
    "<select id=\"\" name=\"sekcegrafika\">
    ";

    for ($i = 1; $i < count($this->var->sekce) + 1; $i++)
    {
      $result .= "<option value=\"{$i}\" ".($cislo == $i ? "selected=\"selected\"" : "").">{$this->var->sekce[$i]}</option>
                 ";
    }

    $result .=
    "</select>";

    return $result;
  }
//******************************************************************************
  function VypisSekciGrafikaText($cislo)
  {
    return $this->var->sekce[$cislo];
  }
//******************************************************************************
  function VypisRozcesti($sekce)
  {
    if ($res = @$this->var->jurixgra->query("SELECT id, sekce, nadpis, zprava, datum, altobrazek FROM grafika WHERE sekce={$sekce} ORDER BY datum DESC LIMIT 0,3", NULL, $error)) //výpis posledních 3 položek podle datumu DESC!
    {
      $poc = $res->numRows();
      if ($poc != 0)
      {
        for ($i = 0; $i < $poc; $i++)
        {
          $data = $res->fetchObject();

          $result .=
          "
          {$data->nadpis}<br />
          <a href=\"foto.php?action=full&amp;id={$data->id}\" title=\"{$data->altobrazek}\" rel=\"lightbox[roadtrip]\"><img src=\"foto.php?action=mini&amp;id={$data->id}\" alt=\"{$data->altobrazek}\" /><br />{$data->datum}<br /></a>
          ";
        }
          $result .= "";
      }
        else
      {
        $result = "žádná položka";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }
    return $result;
  }
//******************************************************************************
  function VypisGrafiky($sekce)
  {
    if (!Empty($sekce))
    {
      if ($res = @$this->var->jurixgra->query("SELECT id, nadpis, zprava, datum, altobrazek FROM grafika WHERE sekce={$sekce} ORDER BY datum DESC", NULL, $error))
      {
        $poc = $res->numRows();
        if ($poc != 0)
        {
          for ($i = 0; $i < $poc; $i++)
          {
            $data = $res->fetchObject();

            if ($i > 0)
            {
              $styl = " vetsi_odsazeni";
            }

            $result .=
            "
            <div class=\"polozka_grafika{$styl}\">
            <h3>
              {$data->nadpis}
            </h3>
            <div class=\"text\">
              <p>
                {$data->zprava}
              </p>
              <p class=\"datum\">
                {$data->datum}
              </p>
            </div>
            <a href=\"foto.php?action=full&amp;id={$data->id}\" title=\"{$data->altobrazek}\" rel=\"lightbox[roadtrip]\"><img src=\"foto.php?action=mini&amp;id={$data->id}\" alt=\"{$data->altobrazek}\" /><span>Po klapnutí na obrázek se zobrazí plný náhled</span></a>
            <div class=\"ukonceni_obtekani\"></div>
            </div>";
          }
          $result .= "";
        }
          else
        {
          $result = "žádná položka";
        }
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }

    return $result;
  }
  //onclick=\"window.open(this.href); return false;
//******************************************************************************
  function VypisGrafikyEditDel()
  {
    if ($res = @$this->var->jurixgra->query("SELECT id, sekce, nadpis, zprava, datum, altobrazek FROM grafika ORDER BY datum DESC", NULL, $error))
    {
      $poc = $res->numRows();
      if ($poc != 0)
      {
        for ($i = 0; $i < $poc; $i++)
        {
          $data = $res->fetchObject();

          if ($i > 0)
          {
            $styl = " vetsi_odsazeni";
          }

          $result .=
          "
          <div class=\"polozka_grafika{$styl}\">
          <h3>
            {$data->nadpis}
          </h3>
          <div class=\"text\">
            <p>
              sekce: {$this->VypisSekciGrafikaText($data->sekce)}
            </p>
            <p>
              {$data->zprava}
            </p>
            <p class=\"datum\">
              {$data->datum}
            </p>
          </div>
          <a href=\"foto.php?action=full&amp;id={$data->id}\" title=\"{$data->altobrazek}\" rel=\"lightbox[roadtrip]\"><img src=\"foto.php?action=mini&amp;id={$data->id}\" alt=\"{$data->altobrazek}\" /><span>Po klapnutí na obrázek se zobrazí plný náhled</span></a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$data->id}\" class=\"upravit_grafika\" title=\"Upravit\"><span>Upravit</span></a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" class=\"smazat_grafika\" title=\"Smazat\"><span>Smazat</span></a>
          <div class=\"ukonceni_obtekani\"></div>
          </div>";
        }
        $result .= "";
      }
        else
      {
        $result = "žádná položka";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function PridejGrafiku()
  {
    $sekce = $_POST["sekcegrafika"];
    $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"]));
    $zprava = stripslashes(htmlspecialchars($_POST["zprava"]));
    $altobrazek = stripslashes(htmlspecialchars($_POST["altobrazek"]));
    $realdatum = stripslashes(htmlspecialchars($_POST["datum"]));

    $a = explode(".", $_FILES["obrazek"]["name"]);
    $pripona = strtolower($a[count($a) - 1]);
    $size = $_FILES["obrazek"]["size"]; //velikost

    if ($pripona == "png" &&
        $size <= $this->var->maxsize) //ještě asi omezit velikost
    {
      $nazev = $_FILES["obrazek"]["name"];
      $tmp = $_FILES["obrazek"]["tmp_name"];
      $typ = $_FILES["obrazek"]["type"];  //typ

      $this->ZmensiObrazek($tmp);

      $obr = $this->var->docasny;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $obr = $tmp;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      if (@$this->var->jurixgra->queryExec("INSERT INTO grafika(sekce, datum, nadpis, zprava, altobrazek) VALUES ({$sekce}, '{$realdatum}', '{$nadpis}', '{$zprava}', '{$altobrazek}');", $error))
      {
        $id = $this->var->jurixgra->lastInsertRowid();  //nacte posledni vlozene id

        if (!@$this->var->jurixgra->queryExec("INSERT INTO fotografikamini (id, foto, nazev, typ) VALUES({$id}, '{$stream1}', '{$nazev}', '{$typ}');
                                              INSERT INTO fotografikafull (id, foto, nazev, typ) VALUES({$id}, '{$stream2}', '{$nazev}', '{$typ}');", $error))
        {
          $this->ErrorMsg($error);
        }

        $result .=
        "
      <div id=\"potvrzeni_ulozeno\">
      <p>
        Byla přidána položka v grafice s nadpisem:
      </p>
      <p>
        <em>{$nadpis}</em>
      </p>
      <p>
        a názvem souboru obrázku:
      </p>
      <p>
        <em>{$nazev}</em>
      </p>
      <p>
        Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
      </p>
    </div>
        ";
      }
        else
      {
        $this->ErrorMsg($error);
      }
    }
      else
    {
      $this->ErrorMsg("Nahrávání obrázku selhalo. <em>Obrázek nemá kompatibilní příponu</em>.");
    }

    return $result;
  }
//******************************************************************************
  function UpravGrafiku($id)
  {
    $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"]));
    $zprava = stripslashes(htmlspecialchars($_POST["zprava"]));
    $altobrazek = stripslashes(htmlspecialchars($_POST["altobrazek"]));
    $datum = $_POST["datum"];
    $sekce = $_POST["sekcegrafika"];

    if (!Empty($_FILES["obrazek"]["name"]))
    {
      $a = explode(".", $_FILES["obrazek"]["name"]);
      $pripona = strtolower($a[count($a) - 1]);
      $size = $_FILES["obrazek"]["size"]; //velikost

      if ($pripona == "png" &&
          $size <= $this->var->maxsize) //ještě asi omezit velikost
      {
        $nazev = $_FILES["obrazek"]["name"];
        $tmp = $_FILES["obrazek"]["tmp_name"];
        $typ = $_FILES["obrazek"]["type"];  //typ

        $this->ZmensiObrazek($tmp);

        $obr = $this->var->docasny;
        $u = fopen($obr, "r");  //otevře
        $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
        fclose($u); //zavře

        $obr = $tmp;
        $u = fopen($obr, "r");  //otevře
        $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
        fclose($u); //zavře

        if (@$this->var->jurixgra->queryExec("UPDATE fotografikamini SET foto='{$stream1}' WHERE id={$id};
                                              UPDATE fotografikamini SET nazev='{$nazev}' WHERE id={$id};
                                              UPDATE fotografikamini SET typ='{$typ}' WHERE id={$id};

                                              UPDATE fotografikafull SET foto='{$stream2}' WHERE id={$id};
                                              UPDATE fotografikafull SET nazev='{$nazev}' WHERE id={$id};
                                              UPDATE fotografikafull SET typ='{$typ}' WHERE id={$id};", $error))
        {
          $result .=
          "
          uloženo do DB
          ";
        }
          else
        {
          $this->ErrorMsg($error);
        }
      }
        else
      {
        $this->ErrorMsg("Nahrávání obrázku selhalo. <em>Obrázek nemá kompatibilní příponu</em>.");
      }
    }

    if (@$this->var->jurixgra->queryExec("UPDATE grafika SET sekce={$sekce} WHERE id={$id};
                                          UPDATE grafika SET nadpis='{$nadpis}' WHERE id={$id};
                                          UPDATE grafika SET zprava='{$zprava}' WHERE id={$id};
                                          UPDATE grafika SET datum='{$datum}' WHERE id={$id};
                                          UPDATE grafika SET altobrazek='{$altobrazek}' WHERE id={$id};", $error))
    {
      $result =
      "
              <div id=\"potvrzeni_ulozeno\">
                <p>
                  Tato položka byla upravena.
                </p>
                <p>
                  Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                </p>
              </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function SmazGrafiku($id)
  {
    if (@$this->var->jurixgra->queryExec("DELETE FROM grafika WHERE id={$id};
                                          DELETE FROM fotografikamini WHERE id={$id};
                                          DELETE FROM fotografikafull WHERE id={$id};", $error))
    {
      $result =
      "
            <div id=\"potvrzeni_ulozeno\">
              <p>
                Tato položka byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function VypisKontaktuDel()
  {
    if ($res = @$this->var->jurixweb->query("SELECT id, jmeno, email, telefon, zprava, datum FROM kontakt ORDER BY datum DESC", NULL, $error))
    {
      $poc = $res->numRows();
      for ($i = 0; $i < $poc; $i++)
      {
        $data = $res->fetchObject();

        $result .=
        "
        <div class=\"hr\">
          <p></p>
        </div>
        <div class=\"vypis_novinek\">
          <p class=\"smazat levy_border\">
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" title=\"Smazat položku v kontaktech\"><span>Smazat položku v kontaktech</span></a>
          </p>
          <p class=\"datum kontakt_nazev\">
            Jméno:
          </p>
          <p class=\"text kontakt_hodnota\">
            {$data->jmeno}
          </p>
          <p class=\"datum kontakt_nazev\">
            E-mail:
          </p>
          <p class=\"text kontakt_hodnota\">
            {$data->email}
          </p>
          <p class=\"datum kontakt_nazev\">
            Telefon:
          </p>
          <p class=\"text kontakt_hodnota\">
            {$data->telefon}
          </p>
          <p class=\"datum kontakt_nazev\">
            Zpráva:
          </p>
          <p class=\"text kontakt_hodnota\">
            {$data->zprava}
          </p>
          <p class=\"datum kontakt_nazev\">
            Datum:
          </p>
          <p class=\"text kontakt_hodnota\">
            {$data->datum}
          </p>
        </div>
        ";
      }
        $result .=
        "
        <div class=\"hr\">
          <p></p>
        </div>
        ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function PridejKontakt($jmeno, $telefon, $email, $zprava)
  {
    $jmeno = stripslashes(htmlspecialchars($jmeno));
    $telefon = stripslashes(htmlspecialchars($telefon));
    $email = stripslashes(htmlspecialchars($email));
    $zprava = stripslashes(htmlspecialchars($zprava));
    $realdatum = date("Y-m-d H:i:s"); //YYYY-MM-DD HH:MM:SS

    if (@$this->var->jurixweb->queryExec("INSERT INTO kontakt(jmeno, email, telefon, zprava, datum) VALUES ('{$jmeno}', '{$email}', '{$telefon}', '{$zprava}', '{$realdatum}');", $error))
    {
      $result =
      "
        <div class=\"hr\">
          <p></p>
        </div>
      <div id=\"potvrzeni_ulozeno\">
        <p>
          Vámi vyplněný formulář byl odeslán s Vašim jménem:
        </p>
        <p>
          <em>{$jmeno}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"#\" onclick=\"AjaxStranka('kontakt', '', '', '');\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";

      $text =
          "
          Tato zpráva ti byla zaslána z tvého webu http://jurkix.gfdesign.cz<br />
          <br />
          <strong>{$jmeno}</strong> ti poslal zprávu z formuláře na tvém webu.<br />
          <br />
          Formulář vyplnil následovně:<br />
          Jméno: <strong>{$jmeno}</strong><br />
          Telefon: <strong>{$telefon}</strong><br />
          E-mail: <strong>{$email}</strong><br />
          Datum: <strong>{$realdatum}</strong><br />
          Zpráva: <strong>{$zprava}</strong><br />
          <br />
          Pro zobrazení zprávy klapni <a href=\"http://{$_SERVER["SERVER_NAME"]}/?action=administrace&amp;akce=kontakt\" title=\"Pro zobrazení zprávy klapni zde\">zde</a>.
          ";

          $header = "{$this->var->hlavicky}\nFrom: {$email}\n"; //hlavička

          if (!@mail($this->var->email, "Zpráva o příchodu zprávy z jurkix.gfdesign.cz", $text, $header))
          {
            $this->ErrorMsg("<em>E-mail nebyl odeslán</em>.");
          }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function SmazKontakt($id)
  {
    if (@$this->var->jurixweb->queryExec("DELETE FROM kontakt WHERE id={$id};", $error))
    {
      $result =
      "
            <div id=\"potvrzeni_ulozeno\">
              <p>
                Tato položka byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function ZmensiObrazek($stream)
  {
    list ($w, $h) = getimagesize($stream);

    if ($w <= $this->var->maxwidth) //je-li sirka mensi nez zmensovane
    {
      $newwidth = $w;
      $newheight = $h;
    }
      else
    {
      $newwidth = $this->var->maxwidth;
      $newheight = round($h / ($w / $this->var->maxwidth));
    }

    $res = @imagecreatetruecolor($newwidth, $newheight);
    $source = @imagecreatefrompng($stream);
    @imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
    imagepng($res, $this->var->docasny);
    imagedestroy($res);
  }
//******************************************************************************
  function KontrolaNazvu($jmeno) //vrací nové jméno
  {
    $prevod = array("ä›" => "e",
                    "ĺˇ" => "s",
                    "äť" => "c",
                    "ĺ™" => "r",
                    "ĺľ" => "z",
                    "ă˝" => "y",
                    "ăˇ" => "a",
                    "ă"  => "i",
                    "ă©" => "e",
                    "ăş" => "u",
                    "ĺż" => "u",
                    "ăł" => "o");
    $text = iconv("Windows-1250", "UTF-8", $jmeno);
    return strtr($text, $prevod);
    //" -áäčďéěëíňóöřšťúůüýžÁÄČĎÉĚËÍŇÓÖŘŠŤÚŮÜÝŽ",
    //"__aacdeeeinoorstuuuyzAACDEEEINOORSTUUUYZ");
  }
//******************************************************************************
  function FormatovaniTextu($element)
  {
    $result =
     "  <input id=\"label_input_url\" type=\"button\" title=\"Odkaz\" value=\"[url]\" onclick=\"VlozitDoTextu('$element', 0);\" />
        <input id=\"label_input_b\" type=\"button\" title=\"Tučné písmo\" value=\"b\" onclick=\"VlozitDoTextu('$element', 1);\" />
        <input id=\"label_input_i\" type=\"button\" title=\"Kurzívé písmo\" value=\"i\" onclick=\"VlozitDoTextu('$element', 2);\" />
        <input id=\"label_input_u\" type=\"button\" title=\"Podtržené písmo\" value=\"u\" onclick=\"VlozitDoTextu('$element', 3);\" />";

    return $result;
  }
//******************************************************************************
  function Pocitadlo()
  {
    $datum = date("Y-m-d");
    $cas = date("H:i:s");
    $hodina = date("H");
    $uphodina = date("H", mktime(date("H") + 1, 0, 0, 0, 0, 0));

    $this->var->jurpoc = new SQLiteDatabase($this->var->pocnazev); //počítadlo

    if (filesize($this->var->pocnazev) == 0)
    {
      if (!$this->var->jurpoc->queryExec("CREATE TABLE pocitadlo (
                                          id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                          ip VARCHAR(40),
                                          hodina INTEGER,
                                          cas TIME,
                                          datum DATE,
                                          pocet INTEGER);", $error))
      {
        $this->ErrorMsg($error);  //chyba do globální proměnné
      }
    }

    if ($res = @$this->var->jurpoc->query("SELECT COUNT(ip) as pocet FROM pocitadlo WHERE ip='{$_SERVER["REMOTE_ADDR"]}';", NULL, $error))
    {
      $data = $res->fetchObject();
      if ($data->pocet == 0)  //ověří existenci IP
      { //když neexistuje vytvoří s 1
        if (!@$this->var->jurpoc->queryExec("INSERT INTO pocitadlo VALUES (NULL, '{$_SERVER["REMOTE_ADDR"]}', {$uphodina}, '{$cas}', '{$datum}', 1);", $error))
        {
          $this->ErrorMsg($error);  //chyba do globální proměnné
        }
      }
        else
      { //existuje-li a 'hodina'!='hodině aktuální' tak si načte a updatuje
        if ($res = @$this->var->jurpoc->query("SELECT pocet, hodina FROM pocitadlo WHERE ip='{$_SERVER["REMOTE_ADDR"]}'", NULL, $error))
        {
          $data = $res->fetchObject();
          $poc = $data->pocet;  //php porovnání dat
          if (date("H", mktime($data->hodina - 1, 0, 0, 0, 0, 0)) != $hodina)  //když se ->hodina <= $hodina tak updejtuj 23<22
          {
            $poc++;
            if (!@$this->var->jurpoc->queryExec("UPDATE pocitadlo SET pocet={$poc} WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                                UPDATE pocitadlo SET cas='{$cas}' WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                                UPDATE pocitadlo SET datum='{$datum}' WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                                UPDATE pocitadlo SET hodina={$uphodina} WHERE ip='{$_SERVER["REMOTE_ADDR"]}';", $error))
            {
              $this->ErrorMsg($error);  //chyba do globální proměnné
            }
          }
        }
          else
        {
          $this->ErrorMsg($error);  //chyba do globální proměnné
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);  //chyba do globální proměnné
    }

    if ($res = @$this->var->jurpoc->query("SELECT SUM(pocet) as pocet FROM pocitadlo", NULL, $error))
    {
      $result = $res->fetchObject()->pocet;
    }

    return $result;
  }
//******************************************************************************
  function VypisPocitadla()
  {
    $this->var->jurpoc = new SQLiteDatabase($this->var->pocnazev); //počítadlo
    if ($res = @$this->var->jurpoc->query("SELECT * FROM pocitadlo", NULL, $error))
    {
      while ($data = $res->fetchObject())
      {
        $host = gethostbyaddr($data->ip);
        $result .= "
          <div class=\"pozadi_obal_polozka_katal\">
            <div class=\"pozadi_top_polozka_katal\"></div>
              <div class=\"pozadi_center_polozka_katal\">
                <p class=\"id_hodnota vsechny_hodnota\" title=\"{$data->id}\">{$data->id}</p>
                <p class=\"ip_hodnota vsechny_hodnota\">{$data->ip}</p>
                <p class=\"hostitel_hodnota vsechny_hodnota\" title=\"{$host}\">{$host}</p>
                <p class=\"do_kdy_hodnota vsechny_hodnota\">{$data->hodina}</p>
                <p class=\"prichod_cas_hodnota vsechny_hodnota\">{$data->cas}</p>
                <p class=\"prichod_datum_hodnota vsechny_hodnota\">{$data->datum}</p>
                <p class=\"kolikrat_hodnota vsechny_hodnota\" title=\"{$data->pocet}x\">{$data->pocet}x</p>
              </div>
            <div class=\"pozadi_bottom_polozka_katal\"></div>
          </div>
        ";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function ErrorMsg($chyba)
  {
    $this->var->chyba = "
    <div class=\"chyba\">
      <span id=\"levy_obrazek\"></span>
      <span id=\"pravy_obrazek\"></span>
      <p>
        Vyskytla se chyba:
      </p>
      <p>
        {$chyba}
      </p>
    </div>
     ";
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
      Stránka vygenerována za: {$cas} ms
    </p>
    ";

    return $result;
  }
//******************************************************************************
}
?>
