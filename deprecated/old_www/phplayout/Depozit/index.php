<?php

/**
 *
 * Centralni index projektu a hlavni nalinkovani funkce
 *
 */

class Depozit
{
  private $var;
  private $sqlite;
  private $dbname = ".evidence.sqlite2";
  private $filestr = ".strankovani";
  private $get_kam = "action";
  private $get_sub = "akce";
  private $adresaadminu = "\$admin";
  private $zipdir = "zip";
  private $moduledir = "modules";

  private $get_check = "check";
  private $get_download = "down";
  private $get_zdrojstazeni = "source";

  private $klenot = true;  //true/false - provoz na klenotu
  private $autoklenot = true; //true/false - zjitsti podle IP jestli je soubor na webu ci nikoli

  private $limit = 2; //maximalne 2 stazeni od 1 prohlizece, jedne verze

  private $adminpristup = array("Geniv" => "93f9a5d3507bbd81db94663fd09dc866",  //hesla v doubleMD5
                                "Fugess" => "7c8c47575b1ff8a0a34e871a33b5954f",
                                "jurkix" => "2750e0d761a4d611073ae2ac3b171753");

  private $title = array ("" => "",
                          "down" => " - výpis stahování",
                          "listmodule" => " - vypis modulů",
                          "update" => " - update modulu",
                          "logoff" => " - odhlášení",
                          "delzip" => " - mazání zip-u",
                          );

  private $blok = array("127.0.1.1",  //seznam blokovanych ip pri kontrole z localhostu
                        "127.0.0.1",
                        "192.168.1.1",
                        "192.168.1.2",
                        "192.168.1.3",
                        "192.168.1.4",
                        "192.168.1.5",
                        "192.168.1.6",
                        "192.168.1.7",
                        "192.168.1.8",
                        "192.168.1.9",
                        "192.168.1.10",
                        "192.168.1.11",
                        "192.168.1.12",
                        "192.168.1.13",
                        "192.168.1.14",
                        "192.168.1.15",
                        "192.168.1.16",
                        "192.168.1.17",
                        "192.168.1.18",
                        "192.168.1.19",
                        "192.168.1.20",
                        "192.168.1.21",
                        "192.168.1.22",
                        "192.168.1.23",
                        "192.168.1.24",
                        "192.168.1.25",
                        "192.168.1.26",
                        "192.168.1.27",
                        "192.168.1.28",
                        "192.168.1.29",
                        "192.168.1.30",
                        "192.168.1.31",
                        "192.168.1.32",
                        "192.168.1.33",
                        "192.168.1.34",
                        "192.168.1.35",
                        "192.168.1.36",
                        "192.168.1.37",
                        "192.168.1.38",
                        "192.168.1.39",
                        "192.168.1.40",
                        "192.168.1.41",
                        "192.168.1.42",
                        "192.168.1.43",
                        "192.168.1.44",
                        "192.168.1.45",
                        "192.168.1.46",
                        "192.168.1.47",
                        "192.168.1.48",
                        "192.168.1.49",
                        "192.168.1.50",
                        "192.168.1.101",
                        "192.168.1.102",
                        "192.168.1.103",
                        "192.168.1.104",
                        "192.168.1.105");


/**
 *
 * Konstruktor hlavniho indexu
 *
 */
  function __construct()
  {
    $this->StartCas();

    session_start();

    if ($this->autoklenot)  //kdyz bude IP v bloku tak jde o lokalhost tedy, o klenot se nejedna
    {
      $this->klenot = (!in_array($_SERVER["REMOTE_ADDR"], $this->blok) ? true : false);
    }

    $this->sqlite = @new SQLiteDatabase($this->dbname, 0777, $error);

    if (filesize($this->dbname) == 0)
    {
       $this->sqlite->queryExec ("CREATE TABLE evidence (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  agent VARCHAR(200),
                                  ip VARCHAR(20),
                                  cas DATETIME,
                                  session VARCHAR(100),
                                  soubor TEXT,
                                  verze VARCHAR(50),
                                  pocet INTEGER UNSIGNED,
                                  zdroj TEXT);
                                  ", $error);
    }

    $cesta = $_GET[$this->get_check];
    $down = $_GET[$this->get_download];
    $source = $_GET[$this->get_zdrojstazeni];  //stazeno ze stranek

    $ssid = session_id();
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $ip = $_SERVER["REMOTE_ADDR"];

    if (!Empty($cesta) ||
        (!Empty($down) && !Empty($source)))
    {
      if (!Empty($cesta)) //check
      {
        $velikost = filesize($cesta); //$this->Velikost() date("d.m.Y H:i:s", )
        $result =  (file_exists($cesta) ? filemtime($cesta)."-_-{$velikost}" : "Chybná cesta"); //pevny format!!!
      }

      if (!Empty($down) &&  //download
          $down != "index.php" &&
          $down != $this->dbname &&
          $down != ".htaccess" &&
          !Empty($source))
      {
        $nazev = explode("/", $down); //rozdeli podle lomitek
        $nazev = explode(".", $nazev[count($nazev) - 1]); //vytahne nazev souboru
        $pripona = $nazev[count($nazev) - 1]; //vytahne priponu

        $jmeno = "{$nazev[0]}"; //jmeno zip
        $nazev = "{$jmeno}.{$pripona}";  //nazev v zip
        $cil = "zip/{$jmeno}.zip";  //cesta zip

        $verze = (file_exists($down) ? date("d.m.Y / H:i:s", filemtime($down)) : "Chybná cesta");

        $zip = new ZipArchive();
        if ($zip->open($cil, ZipArchive::OVERWRITE) === true &&
            file_exists($down))
        {
          if ($res = @$this->sqlite->query("SELECT id, pocet FROM evidence WHERE session='{$ssid}' AND agent='{$agent}' AND ip='{$ip}' AND soubor='{$down}' AND verze='{$verze}';", NULL, $error))
          {
            $data = $res->fetchObject();
            $id = $data->id;

            if ($res->numRows() == 0) //kdyz neexstuje
            {
              $this->sqlite->queryExec("INSERT INTO evidence (id, agent, ip, cas, session, soubor, verze, pocet, zdroj) VALUES
                                        (NULL, '{$agent}', '{$ip}', datetime('now', '+1 hour'), '{$ssid}', '{$down}', '{$verze}', 0, '{$source}');", $error);
            }
              else
            {
              if ($this->PocetStazeni($id) < $this->limit)
              {
                $pocet = $data->pocet + 1;
                $this->sqlite->queryExec("UPDATE evidence SET cas=datetime('now', '+1 hour'),
                                                              soubor='{$down}',
                                                              verze='{$verze}',
                                                              agent='{$agent}',
                                                              pocet={$pocet},
                                                              zdroj='{$source}'
                                                              WHERE id={$id};", $error);
              }
            }

            if ($this->PocetStazeni($id) < $this->limit)  //kontrola limitu
            {
              $zip->addFile($down);  //ulozi i se stejnou cestou
              $zip->close();

              header("Content-Description: File Transfer");
              header("Content-Type: application/force-download");
              header("Content-Disposition: attachment; filename=\"{$cil}\"");
              $result = readfile($cil); //vybydne ke stazeni
            }
              else
            {
              $result = "limit stažení souboru překročen!";
            }
          }
            else
          {
            $result = $error;
          }
        }
          else
        {
          $result = "něco se porouchalo...";
        }
      }
    }
      else
    {
      $datum = date("d.m.Y / H:i:s");

      $linux = ($this->DetekceLinuxu() ?  //detekce linuxu
                "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_linux.css\" media=\"screen\" />" :
                "");

      $kam = $_GET[$this->get_kam];
      $sub = $_GET[$this->get_sub];

      if (!Empty($kam) &&
          ($kam == $this->adresaadminu ||
          $kam == "logoff"))
      {
        if ($this->Prihlasovani())  //admin stranek
        {
          switch ($sub)
          {
            case "":
              $obsah =
              "<div id=\"sekce_uvodni_strana\">
{$this->VypisZip()}        </div>";
            break;

            case "down":  //vypis stahovani
              $obsah = $this->VypisEvidence();
            break;

            case "listmodule":  //vypis modulu
              $obsah = $this->VypisModulu();
            break;

            case "update":  //update modulu
              $obsah = $this->UpdateSouboru();
            break;

            case "download":  //zabali a stahne soubor
              $obsah = $this->ZabalStahniSoubor();
            break;

            case "delzip":  //smaze zip soubor
              $obsah = $this->SmazatSouborZip();
            break;
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
    <meta name=\"description\" content=\"Depozitář by GF Design\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles_admin.css\" media=\"screen\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if IE 7]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie7_admin.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie6_admin.css\" media=\"screen\" />
    <![endif]-->
    {$linux}
    <title>Depozitář by GF Design{$this->title[$_GET[$this->get_sub]]}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
    <script type=\"text/javascript\" src=\"script/mootools-1.2.1-core-yc.js\"></script>
    <script type=\"text/javascript\" src=\"script/more.js\"></script>
    <script type=\"text/javascript\" src=\"script/snippet.js\"></script>
    <script type=\"text/javascript\" src=\"script/script_stranky.js\"></script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1>
          <span>Administrace Depozit</span>
        </h1>
        <div id=\"menu_zahlavi\">
          <h2 id=\"uvodni_strana\"".(Empty($sub) || $sub == "delzip" ? " style=\"opacity: 1 !important;\" class=\"aktivni_polozka_ie\"" : "").">
            <a href=\"?{$this->get_kam}={$this->adresaadminu}\" title=\"Úvodní strana\">
              <em>
                Úvodní strana
              </em>
            </a>
          </h2>
          <h2 id=\"vypis_modulu\"".($sub == "listmodule" || $sub == "update" ? " style=\"opacity: 1 !important;\" class=\"aktivni_polozka_ie\"" : "").">
            <a href=\"?{$this->get_kam}={$this->adresaadminu}&amp;{$this->get_sub}=listmodule\" title=\"Výpis modulů\">
              <em>
                Výpis modulů
              </em>
            </a>
          </h2>
          <h2 id=\"vypis_stazenych_modulu\"".($sub == "down" ? " style=\"opacity: 1 !important;\" class=\"aktivni_polozka_ie\"" : "").">
            <a href=\"?{$this->get_kam}={$this->adresaadminu}&amp;{$this->get_sub}=down\" title=\"Výpis stažených modulů\">
              <em>
                Výpis stažených modulů
              </em>
            </a>
          </h2>
          <h2 id=\"odhlasit_se\">
            <a href=\"?{$this->get_kam}=logoff\" title=\"Odhlásit se\">
              <em>
                Odhlásit se
              </em>
            </a>
          </h2>
        </div>
      </div>
      <div id=\"obal_obsah\">
        {$obsah}
      </div>
      <div id=\"zapati\">
        <p>
          Created by <a href=\"http://www.gfdesign.cz/\" title=\"GF Design - Tvorba webových stránek a systémů\">GF design</a>
        </p>
        {$this->AdminStrankovani()}
      </div>
    </div>
  </body>
</html>
          ";
        }
          else
        { //odhlasovani ze stranek
          $this->AutoClick(0, "./");
          $result = "{$this->meta}";
        }
      }
        else
      { //hlavni obsah stranek
        $result =
        "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"depozit, depozitar, depozitář, depozit gfdesign, depozit gf design, depozit by gf design, depozit by gfdesign\" />
    <meta name=\"description\" content=\"Depozitář by GF Design\" />
    <meta name=\"robots\" content=\"index, follow\" />
    {$this->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
      {$linux}
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>Depozitář by GF Design</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" /> -->
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_obsah\">
        <div id=\"depozit_nadpis\">
          <h1>Depozitář by GF Design</h1>
          <p>
            <strong>
              Depozitář by GF Design
            </strong>
          </p>
        </div>
        <div id=\"depozit_top\"></div>
        <!--[if lte IE 6]>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}\" title=\"admin\" id=\"odkaz_depozit_center_ie6\"></a>
        <![endif]-->
        <div id=\"depozit_center\">
          <a href=\"?{$this->get_kam}={$this->adresaadminu}\" title=\"admin\"></a>
        </div>
        <!--[if lte IE 6]>
          <a href=\"http://www.gfdesign.cz/\" title=\"GF Design - Tvorba webových stránek a systémů\" id=\"odkaz_depozit_bottom_ie6\">
            <span>GF Design - Tvorba webových stránek a systémů</span>
          </a>
        <![endif]-->
        <div id=\"depozit_bottom\">
          <a href=\"http://www.gfdesign.cz/\" title=\"GF Design - Tvorba webových stránek a systémů\">
            <span>GF Design - Tvorba webových stránek a systémů</span>
          </a>
        </div>
        <!-- <div id=\"vypis_sekce\">Dnes je: {$datum}</div> -->
        {$admin}
      </div>
    </div>
    <script type=\"text/javascript\">
    var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
    document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
    </script>
    <script type=\"text/javascript\">
    try {
    var pageTracker = _gat._getTracker(\"UA-8011476-1\");
    pageTracker._trackPageview();
    } catch(err) {}</script>
  </body>
</html>
        ";
      }
    }

    echo $result;
  }

/**
 *
 * Vrati pocet radku v databazi
 *
 * @return pocet radku
 */
  private function PocetPolozekDatabaze()
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM evidence;", NULL, $error))
    {
      $result = $res->numRows();
    }

    return $result;
  }

/**
 *
 * Strankuje hlavni vypis, definovano na promenny pocet stranek
 *
 * @param na_stranku cislo urcujici pocet polozek na stranku
 * @param pocet_radku pocet radku (polozek) v cele databazi
 * @param strana strana ziskaza z adresy (aktualni zvolena stranka)
 * @param adresa text adresy pro maximalni zachovani funkcnosti odkazu
 * @param typ urcuje typ vystupu pres parametr limit - limit/array
 * @param limit pres parametr vraceny dotaz do databaze pro dany vypis polozek, a nebo pole minimum a maximum
 * @return strankovaci odkazy
 */
  private function Strankovani($na_stranku, $pocet_radku, $strana, $adresa, $typ, &$limit)
  {
    settype($na_stranku, "integer");
    $pocetstran = ceil($pocet_radku / $na_stranku);  //vypocteny pocet stran podle strankovani

    settype($strana, "integer");
    $mezai = false;
    if ($pocetstran > 7)
    {
      for ($i = 0; $i < 3; $i++)  //prvni trojicka
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana != 0)  //predchozi
        {
          $prev = $strana - $na_stranku;
          $jdi .= "<a href=\"{$adresa}&amp;str={$prev}\" title=\"Předchozí stránka\">Předchozí</a> - ";
        }

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a>".($i != 2 ? "," : "")." ";
        }
      }

      if (($strana / $na_stranku) >= 2 && ($strana / $na_stranku) <= ($pocetstran - 3))
      {
        $mezi = true;
      }
        else
      {
        $jdi .= "... ";
      }

      for ($i = $pocetstran - 3; $i < $pocetstran; $i++)  //posledni trojicka
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a>, ";
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky
          $next = $strana + $na_stranku;
          $jdi .= " - <a href=\"{$adresa}&amp;str={$next}\" title=\"Další stránka\">Další</a>, "; //".($i != 2 ? "," : "")."
        }
      }
    }
      else
    {
      for ($i = 0; $i < $pocetstran; $i++)
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana != 0)  //predchozi
        {
          $prev = $strana - $na_stranku;
          $jdi .= "<a href=\"{$adresa}&amp;str={$prev}\" title=\"Předchozí stránka\">Předchozí</a> - ";
        }

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a>, ";
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky

          $next = $strana + $na_stranku;
          $jdi .= " - <a href=\"{$adresa}&amp;str={$next}\" title=\"Další stránka\">Další</a>, ";
        }
      }
    }

    if ($mezi)
    {
      $prev = $strana - $na_stranku;  //predchozi
      $pred = "<a href=\"{$adresa}&amp;str={$prev}\" title=\"Předchozí stránka\">Předchozí</a> - ";

      $i = 0;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi = "{$pred}<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a> ... ";

      $i = ($strana / $na_stranku) - 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a>, ";

      $i = ($strana / $na_stranku);
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "{$poc}</a>, ";

      $aktualni = $poc; //prostedni clen

      $i = ($strana / $na_stranku) + 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a> ... ";

      $i = $pocetstran - 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"{$poc}. stránka\">{$poc}</a>, ";

      $jdi = substr($jdi, 0, -2); //odebrani carky
      $next = $strana + $na_stranku;  //dalsi
      $jdi .= " - <a href=\"{$adresa}&amp;str={$next}\" title=\"Další stránka\">Další</a>, ";
    }

    $jdi = substr($jdi, 0, -2); //odebrani carky

    switch ($typ)
    {
      case "limit":
        $limit = "LIMIT {$strana}, {$na_stranku}"; //dodatecny dotaz do DB
      break;

      case "array":
        $limit[0] = $strana;
        $limit[1] = $strana + $na_stranku;
      break;
    }

    $result =
     "          <div class=\"strankovani\">
            <p>
              {$jdi}
            </p>
            <p class=\"strankovani_vpravo\">
              Strana: {$aktualni} z {$pocetstran}
            </p>
          </div>";

    return $result;
  }

/**
 *
 * Adminstrace strankovani modulu
 *
 * @return vypis administrace
 */
  private function AdminStrankovani()
  {
    $this->NactiKonfiguraci($modul, $down);

    $result =
    "<div id=\"nastaveni_strankovani\">
          <form method=\"post\" action=\"\" onsubmit=\"return confirm('Opravdu chcete nastavit tyto hodnoty ?');\">
            <fieldset>
              <dl>
                <dt>Výpis stažených modulů</dt>
                <dd><input type=\"text\" name=\"list_down\" value=\"{$down}\" /></dd>
              </dl>
              <dl>
                <dt>Výpis modulů</dt>
                <dd><input type=\"text\" name=\"list_modul\" value=\"{$modul}\" /></dd>
              </dl>
              <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" title=\"Nastavit\" id=\"tl_nastavit\" />
            </fieldset>
          </form>
          <p>
            Nastavení stránkování
          </p>{$this->UlozKonfiguraci()}
        </div>";

    return $result;
  }

/**
 *
 * Nacte dany pocet strankovani ze souboru
 *
 * @param sekce cislo sekce pro ktere se ma vratit pocet stranek
 * @return pocet stranek na list
 */
  private function NactiStrankovani($sekce)
  {
    if (file_exists($this->filestr))
    {
      $u = fopen($this->filestr, "r");
      $data = fread($u, filesize($this->filestr));
      fclose($u);

      $data = explode("-", $data);

      $result = $data[$sekce];
    }

    return $result;
  }

/**
 *
 * Nacta a vytvari prpadne neexistujici soubor konfigurace strankovani
 *
 * @param modul cislo strankovan ve vypisu modulu
 * @param down cislo strankovani ve vypisu downloadu
 */
  private function NactiKonfiguraci(&$modul, &$down)
  {
    if (file_exists($this->filestr))
    {
      $u = fopen($this->filestr, "r");
      $data = fread($u, filesize($this->filestr));
      fclose($u);

      $data = explode("-", $data);
      $modul = $data[0];
      $down = $data[1];
    }
      else
    {
      $u = fopen($this->filestr, "w");
      fwrite($u, "10-10");
      fclose($u);

      echo "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Konfigurační soubor se vytváří. Nyní obnovte stránku, nebo nastavte práva k zápisu
          </p>
          <a href=\"./\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
    }
  }

/**
 *
 * Ulozi konfiguraci strankovani
 *
 */
  private function UlozKonfiguraci()
  {
    if (!Empty($_POST["tlacitko"]))
    {
      $modul = $_POST["list_modul"];
      settype($modul, "integer");

      $down = $_POST["list_down"];
      settype($modul, "integer");

      if ($modul != 0 &&
          $down != 0)
      {
        $u = fopen($this->filestr, "w");
        fwrite($u, "{$modul}-{$down}");
        fclose($u);

        $this->AutoClick(1, "?{$this->get_kam}={$this->adresaadminu}");  //auto kliknuti
      }

      $this->AutoClick(1, "?{$this->get_kam}={$this->adresaadminu}");  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Prepocet velikosti
 *
 * @param size zmerena velikost
 * @return prepocitana velikost
 */
  private function Velikost($size)
  {
    $symbol = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

    $exp = 0;
    $converted_value = 0;
    if ($size > 0)
    {
      $exp = floor(log($size) / log(1024));
      $converted_value = ($size / pow(1024, floor($exp)));
    }

    $result = sprintf("%.2f {$symbol[$exp]}", $converted_value);

    return $result;
  }

/**
 *
 * Vrati pocet stazeni daneho id
 *
 * @param id cislo zaznamu
 * @return pocet stazeni
 */
  private function PocetStazeni($id)
  {
    settype($id, "integer");
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT pocet FROM evidence WHERE id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet;
      }
    }
      else
    {
      $result = $error;
    }

    return $result;
  }

/**
 *
 * Vypisuje evidovane stahovani
 *
 * @return vypis stahovani
 */
  private function VypisEvidence()
  {
    $strana = $_GET["str"];
    settype($strana, "integer");

    $adresa = "?{$this->get_kam}={$this->adresaadminu}&amp;{$this->get_sub}=down";

    $str = $this->Strankovani($this->NactiStrankovani(1), $this->PocetPolozekDatabaze(), $strana, $adresa, "limit", $limit);
    $kip = $_SERVER["REMOTE_ADDR"];
    if ($res = @$this->sqlite->query("SELECT id, agent, ip, cas, session, soubor, verze, pocet, zdroj
                                      FROM evidence
                                      ORDER BY id DESC
                                      {$limit};", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = "<div id=\"sekce_vypis_stazenych_modulu\">\n{$str}\n          <div class=\"polozka_vypis zahlavi_polozka_vypis\">
            <p class=\"border_bottom\">
              Hostitel
            </p>
            <p class=\"border_bottom\">
              Operační systém
            </p>
            <p class=\"border_bottom\">
              Prohlížeč
            </p>
            <p class=\"border_bottom\">
              IP adresa
            </p>
            <p class=\"border_right_none border_bottom\">
              Původ stažení
            </p>
            <p>
              ID prohlížeče
            </p>
            <p>
              Modul
            </p>
            <p>
              Datum modulu na depozitu
            </p>
            <p>
              Počet stažení
            </p>
            <p class=\"border_right_none\">
              Datum / čas stažení modulu
            </p>
          </div>
          <span class=\"oddelovac_mooslide\"></span>";

        $i = 0;
        while ($data = $res->fetchObject())
        {
          $ip = $data->ip;
          $host = (in_array($kip, $this->blok) ? "localhost" : gethostbyaddr($ip)); //host
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $dat = strtotime($data->cas);
          $cas = date("d.m.Y / H:i:s", $dat);
          $soubor = basename($data->soubor);

          $result .=
           "\n          <div class=\"polozka_vypis\">
            <p class=\"border_bottom\">
              {$host}
            </p>
            <p class=\"border_bottom\">
              {$os}
            </p>
            <p class=\"border_bottom\">
              {$browser}
            </p>
            <p class=\"border_bottom\">
              {$ip}
            </p>
            <p class=\"border_right_none border_bottom\">
              {$data->zdroj}
            </p>
            <p>
              {$data->session}
            </p>
            <p title=\"{$data->soubor}\">
              {$soubor}
            </p>
            <p>
              {$data->verze}
            </p>
            <p>
              {$data->pocet}x
            </p>
            <p class=\"border_right_none\">
              {$cas}
            </p>
          </div>
          <span class=\"".(($i + 1) ==  $res->numRows() ? "none_oddelovac_mooslide" : "oddelovac_mooslide")."\"></span>";

          $i++;
        }
        $result .= "
{$str}\n        </div>";


      }
    }
      else
    {
      $result = $error;
    }

    return $result;
  }

/**
 *
 * Zajisti vypis adresare modulu
 *
 * @return pole v modulama
 */
  private function ObsluhaAdresareModulu()
  {
    $cesta = $this->moduledir;

    $handle = opendir($cesta);
    $moduly = array();
    $moduly[0] = "funkce.php";
    $moduly[1] = "promenne.php";

    $i = count($moduly);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "dir")
      {
        //prohledani slozek
        $handle1 = opendir("{$cesta}/{$soub}");
        while($soub1 = readdir($handle1))
        {
          if ($soub1 != "." && $soub1 != ".." && filetype("{$cesta}/{$soub}/{$soub1}") == "file")
          {
            $moduly[$i] = "{$cesta}/{$soub}/{$soub1}";
            $i++;
          }
        }
        closedir($handle1);
      }
    }
    closedir($handle);
    sort($moduly);

    return $moduly;
  }

/**
 *
 * Vypisuje vsechny obsazene moduly
 *
 * @return vypis modulu
 */
  private function VypisModulu()
  {
    $moduly = $this->ObsluhaAdresareModulu();

    $strana = $_GET["str"];
    settype($strana, "integer");

    $adresa = "?{$this->get_kam}={$this->adresaadminu}&amp;{$this->get_sub}=listmodule";

    $str = $this->Strankovani($this->NactiStrankovani(0), count($moduly), $strana, $adresa, "array", $limit);

    $result = "<div id=\"sekce_vypis_modulu\">\n{$str}\n          <div class=\"polozka_vypis zahlavi_polozka_vypis\">
            <p class=\"border_bottom\">
              Název modulu
            </p>
            <p class=\"mala_delka border_bottom\">
              Velikost
            </p>
            <p class=\"trida_cesta_modulu border_bottom\">
              Třída modulu
            </p>
            <p class=\"mala_delka_odkaz border_bottom\">
              Stáhnout
            </p>
            <p>
              Datum / čas modulu
            </p>
            <p class=\"mala_delka\">
              Aktuálnost modulu
            </p>
            <p class=\"trida_cesta_modulu\">
              Cesta k modulu
            </p>
            <p class=\"mala_delka_odkaz\">
              Aktualizovat
            </p>
          </div>
          <span class=\"oddelovac_mooslide\"></span>";
    for ($i = $limit[0]; $i < $limit[1]; $i++)
    {
      if (!Empty($moduly[$i]))  //kdyz je nazev neprazdny
      {
        if (file_exists($moduly[$i])) //kdyz modul existuje
        {
          $nazev = basename($moduly[$i]);
          $modul = dirname($moduly[$i]);
          $modul = explode("/", $modul);
          $modul = (count($modul) > 1 ? $modul[1] : "./");
          $datum = date("d.m.Y / H:i:s", filemtime($moduly[$i]));
          $velikost = $this->Velikost(filesize($moduly[$i]));
          $info = $this->PocetDni(filemtime($moduly[$i]));

          $classmodul = $this->ZjistiClassModulu($moduly[$i]);
          $atrbuty = $this->ZjistiAtributy($moduly[$i]);
          $vlastnik = fileowner($moduly[$i]);
          $skupina = filegroup($moduly[$i]);

          $result .=
          "\n          <div class=\"polozka_vypis\">
            <p class=\"border_bottom\">
              {$nazev}
            </p>
            <p class=\"mala_delka border_bottom\">
              {$velikost}
            </p>
            <p class=\"trida_cesta_modulu border_bottom\" title=\"{$classmodul} - [adresar: {$modul}, owner: {$vlastnik}, group: {$skupina}, permissions: {$atrbuty}]\">
              {$classmodul} - [{$vlastnik}/{$skupina}/{$atrbuty}]
            </p>
            <p class=\"mala_delka_odkaz border_bottom\">
              <a href=\"?{$this->get_kam}={$this->adresaadminu}&amp;{$this->get_sub}=update&amp;file={$moduly[$i]}\" title=\"Aktualizovat modul: {$nazev}\">Aktualizovat</a>
            </p>
            <p>
              {$datum}
            </p>
            <p class=\"mala_delka\">
              {$info}
            </p>
            <p class=\"trida_cesta_modulu\" title=\"{$moduly[$i]}\">
              {$modul}
            </p>
            <p class=\"mala_delka_odkaz\">
              <a href=\"?{$this->get_kam}={$this->adresaadminu}&amp;{$this->get_sub}=download&amp;file={$moduly[$i]}\" onclick=\"return confirm('Jste si jistí, že chcete stáhnout tento modul: &quot;{$nazev}&quot; ?');\" title=\"Stáhnout modul: {$nazev}\">Stáhnout</a>
            </p>
          </div>
          <span class=\"".(($i + 1) == $limit[1] ? "none_oddelovac_mooslide" : "oddelovac_mooslide")."\"></span>";
        }
          else
        {
          $result .= "\n          <div class=\"polozka_vypis\">
            <p class=\"border_bottom\">
              Tento modul neexistuje
            </p>
            <p class=\"mala_delka border_bottom\">
              -
            </p>
            <p class=\"trida_cesta_modulu border_bottom\" title=\"-\">
              -
            </p>
            <p class=\"mala_delka_odkaz border_bottom\">
              -
            </p>
            <p>
              -
            </p>
            <p class=\"mala_delka\">
              -
            </p>
            <p class=\"trida_cesta_modulu\" title=\"{$moduly[$i]}\">
              {$moduly[$i]}
            </p>
            <p class=\"mala_delka_odkaz\">
              -
            </p>
          </div>
          <span class=\"oddelovac_mooslide\"></span>";
        }
      }
    }

    $result .= "
{$str}\n        </div>";

    return $result;
  }

/**
 *
 * Zjisti nazev tridy ze souboru
 *
 * @param cesta cesta souboru
 * @return nazev tridy
 */
  private function ZjistiClassModulu($cesta)
  {
    $u = fopen($cesta, "r");
    $data = explode("class ", fread($u, 5000));
    fclose($u);
    $a = explode("\n", $data[1]);
    $result = explode(" ", $a[0]);

    return $result[0];
  }

/**
 *
 * Zjisti atributy opravneni
 *
 * @param cesta cesta k souboru
 * @return text opravneni
 */
  private function ZjistiAtributy($cesta)
  {
    $perms = fileperms($cesta);
    //Owner
    $result .= (($perms & 0x0100) ? "r" : "-");
    $result .= (($perms & 0x0080) ? "w" : "-");
    $result .= (($perms & 0x0040) ?
                (($perms & 0x0800) ? "s" : "x" ) :
                (($perms & 0x0800) ? "S" : "-"));
    // Group
    $result .= (($perms & 0x0020) ? "r" : "-");
    $result .= (($perms & 0x0010) ? "w" : "-");
    $result .= (($perms & 0x0008) ?
                (($perms & 0x0400) ? "s" : "x" ) :
                (($perms & 0x0400) ? "S" : "-"));
    // World
    $result .= (($perms & 0x0004) ? "r" : "-");
    $result .= (($perms & 0x0002) ? "w" : "-");
    $result .= (($perms & 0x0001) ?
                (($perms & 0x0200) ? "t" : "x" ) :
                (($perms & 0x0200) ? "T" : "-"));

    $oktal = substr(sprintf("%o", $perms), -4);

    return $result." ({$oktal})";
  }

/**
 *
 * Zabali a stahne dany soubor
 *
 * @return zapakovany soubor
 */
  private function ZabalStahniSoubor()
  {
    $down = $_GET["file"];
    $jmeno = basename($down);

    $result = "";
    mkdir($this->zipdir); //vytvoreni slozky
    chmod($this->zipdir, 0777); //zmena prav
    chown($this->zipdir, 11003);  //zmena uzivatele
    chgrp($this->zipdir, 10000);  //zmena skupny

    $cil = "{$this->zipdir}/{$jmeno}.zip";  //cesta zip
    if (file_exists($cil))  //pokud existuje pro jistotu jej smaze
    {
      unlink($cil);
    }

    $zip = new ZipArchive();
    if ($zip->open($cil, ZipArchive::OVERWRITE) === true)
    {
      $zip->addFile($down);  //ulozi i se stejnou cestou
      $zip->close();

      header("Content-Description: File Transfer");
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=\"{$cil}\"");
      $result = readfile($cil); //vybydne ke stazeni
    }

    return $result;
  }

/**
 *
 * Vypise obsah adresare zip
 *
 * @return seznam souboru
 */
  private function VypisZip()
  {
    $result = "";
    $cesta = $this->zipdir;
    if (file_exists($cesta))
    {
      $handle = opendir($cesta);
      $i = 0;
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
        {
          $soubor[$i] = $soub;
          $i++;
        }
      }
      closedir($handle);

      $pocetmodulu = count($this->ObsluhaAdresareModulu()); //vrat pocet modulu

      if ($i == 0)
      {
        $result = "          <p id=\"celkovy_pocet\">
            Ve složce: \"{$this->zipdir}\" není žádný archiv
          </p>\n";
      }
        else
      {
        rsort($soubor);
        $pocet = count($soubor);

        $result .= "          <p id=\"celkovy_pocet\">
            Celkový počet souborů na úvodu: <em>{$pocet}</em>, Celkový počet modulů: <em>{$pocetmodulu}</em>{$str}
          </p>\n";

        for ($i = 0; $i < $pocet; $i++)
        {
          $datum = date("d.m.Y / H:i:s", filemtime("{$cesta}/{$soubor[$i]}"));
          $velikost = $this->Velikost(filesize("{$cesta}/{$soubor[$i]}"));

          $result .=
          "          <p>
            <a href=\"{$cesta}/{$soubor[$i]}\" title=\"{$soubor[$i]}\">
              {$soubor[$i]}
            </a>
            <strong title=\"Datum vytvoření souboru: {$soubor[$i]}\" class=\"datum_vytvoreni\">
              {$datum}
            </strong>
            <strong title=\"Velikost souboru: {$soubor[$i]}\">
              {$velikost}
            </strong>
            <a href=\"?{$this->get_kam}={$this->adresaadminu}&amp;akce=delzip&amp;file={$soubor[$i]}\" onclick=\"return confirm('Opravdu chcete smazat soubor: &quot;{$soubor[$i]}&quot; ?');\" class=\"odkaz_smazat\" title=\"Smazat soubor: {$soubor[$i]}\">
              Smazat
              <span></span>
            </a>
          </p>\n";
        }
      }
    }
      else
    {
      $result = "          <p id=\"celkovy_pocet\">
            Složka: \"{$cesta}\" nebyla dosud vytvořena. Dokud nebude jakýkoliv modul zabalen, tak se složka nevytvoří.
          </p>\n";

      mkdir($this->zipdir); //vytvoreni slozky
      chmod($this->zipdir, 0777); //zmena prav
      chown($this->zipdir, 11003);  //zmena uzivatele
      chgrp($this->zipdir, 10000);  //zmena skupny
    }

    return $result;
  }

/**
 *
 * Smaze dany soubor ve slozce zalohy
 *
 * @return zprava o smazani
 */
  private function SmazatSouborZip()
  {
    $cesta = $_GET["file"];

    if (file_exists("zip/{$cesta}"))
    {
      $result = (unlink("zip/{$cesta}") ? "<div class=\"centralni_box info_centralni_box\">
          <span></span>
          <p>
            Soubor: \"{$cesta}\" byl smazán !
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>" : "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Při mazání souboru nastala chyba !
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>");

      $this->AutoClick(2, "?{$this->get_kam}={$this->adresaadminu}");  //auto kliknuti
    }
      else
    {
      $result = "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Cesta k souboru neexistuje !
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";

      $this->AutoClick(2, "?{$this->get_kam}={$this->adresaadminu}");  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Spocita pocet dni
 *
 * @param datum datum od ktereho to pocita
 * @return vysledny pocet
 */
  private function PocetDni($datum)
  {
    $result = "";
    if (date("Y-m-d", $datum) == date("Y-m-d"))
    {
      $result = "Dnes nové";
    }
      else
    {
      //vypocet dni stari
      $den = 0; //meni se aktualni datum dokud se nesrovna se souborem
      while (date("Y-m-d", mktime(0, 0, 0, date("n"), date("j") - $den, date("Y"))) != date("Y-m-d", $datum))
      {
        $den++;
      }

      switch ($den)
      {
        case 1:
          $result = "Včera nové";
        break;

        default:
          $result = "Před: {$den} dny nové";
        break;
      }
    }

    return $result;
  }

/**
 *
 * Updatuje dany soubor
 *
 * @return info o update
 */
  private function UpdateSouboru()
  {
    $soubor = $_GET["file"];
    chmod($soubor, 0777);
    chmod(dirname($soubor), 0777);
    @chown($soubor, 11003);
    @chgrp($soubor, 10000);

    $result =
    "<div id=\"nahravani_modulu\">
          <form method=\"post\" action=\"\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Opravdu chcete aktualizovat modul: &quot;{$soubor}&quot; ?');\">
            <fieldset>
              <dl>
                <dt>Aktualizujete modul: <strong>{$soubor}</strong></dt>
                <dd><input type=\"file\" name=\"modul\" /></dd>
              </dl>
              <input type=\"submit\" name=\"tlacitko\" value=\"Aktualizovat\" id=\"tl_aktualizovat\" />
            </fieldset>
          </form>
        </div>";

    $koncovka = explode(".", $_FILES["modul"]["name"]);

    if (!Empty($_FILES["modul"]["tmp_name"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($soubor) &&
        $_FILES["modul"]["name"] == basename($soubor) &&
        $koncovka[count($koncovka) - 1] == "php" &&
        file_exists($soubor) &&
        $soubor != "index.php" &&
        $soubor != ".htaccess")
    {
      if (move_uploaded_file($_FILES["modul"]["tmp_name"], $soubor))
      {
        $result = "<div class=\"centralni_box info_centralni_box\">
          <span></span>
          <p>
            Modul: \"{$soubor}\" byl úspěšně aktualizován.
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
        chmod($soubor, 0777);
        @chown($soubor, 11003);
        @chgrp($soubor, 10000);

        $this->AutoClick(2, "?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule");  //auto kliknuti
      }
        else
      {
        $result = "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Nastala chyba: \"{$_FILES["modul"]["error"]}\".
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
      }
    }
      else
    {
      if (!Empty($_FILES["modul"]["tmp_name"]))
      {
        if ($koncovka[count($koncovka) - 1] == "php")
        {
          $result = "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Nahrávání se nezdařilo. Můžete nahrávat jen podporovaný formát \".php\".
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
        }

        if (file_exists($soubor))
        {
          $result = "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Nahrávání se nezdařilo. Soubor neexistuje.
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
        }

        if ($soubor != "index.php" &&
            $soubor != ".htaccess")
        {
          $result = "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Nahrávání se nezdařilo. Můžete nahrávat jen korektní soubor.
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
        }

        if ($_FILES["modul"]["name"] == basename($soubor))
        {
          $result = "<div class=\"centralni_box chyba_centralni_box\">
          <span></span>
          <p>
            Nahrávání se nezdařilo. Nahráváte nekompatibilní soubor.
          </p>
          <a href=\"?{$this->get_kam}={$this->adresaadminu}&{$this->get_sub}=listmodule\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
        </div>";
        }
      }
    }

    return $result;
  }

/**
 *
 * Provadi prihlaseni do adminu
 *
 */
  private function Prihlasovani()
  {
    if ($this->klenot)  //prepnuti pro ziskani dat z klenot
    {
      list($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]) = explode(":", base64_decode(substr($_SERVER["REDIRECT_REMOTE_USER"], 6)));
    }

    if ($_GET[$this->get_kam] == "logoff")
    {
      $_SERVER["PHP_AUTH_USER"] = "";
      $_SERVER["PHP_AUTH_PW"] = "";
      header("WWW-Authenticate: Basic realm=\"vychozi layout\"");
      header("HTTP/1.0 401 Unauthorized");
      $this->AutoClick(0, "./");
    }

    if ($_GET[$this->get_kam] == $this->adresaadminu)
    {
      if (!$this->Autorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
      {
        header("WWW-Authenticate: Basic realm=\"vychozi layout\"");
        header("HTTP/1.0 401 Unauthorized");

        $result = false;
        $this->AutoClick(0, "./");
      }
        else
      {
        if ($this->Autorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
        {
          $result = true;
        }
          else
        {
          $result = false;
        }
      }
    }

    return $result;
  }

/**
 *
 * Overeni hesla do administrace
 *
 * @param login: login admina
 * @param heslo: heslo admina
 * @return povoleno/zamitnuto - true/false
 */
  private function Autorizace($login, $heslo)
  {
    $result = ($this->adminpristup[$login] == md5(md5($heslo)) ? true : false);

    return $result;
  }

/**
 *
 * Meta refresh
 *
 * @param cas doba aktualizace
 * @param cesta cilova cesta presmerovani
 * @return prislusne nastaveny meta tag
 */
  private function AutoClick($cas, $cesta)  //auto kliknuti, procedura
  {
    $this->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }

/**
 *
 * Vraceni odpocitavaneho casu pro vypocet delky provaden skryptu
 *
 * @return cas stopek v ms
 */
  private function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $soucet = $cas[1] + $cas[0];

    return $soucet;
  }

/**
 *
 * Zacatek odpocitavani
 *
 */
  private function StartCas() //zapis začátku
  {
    $this->start = $this->MeritCas();
  }

/**
 *
 * Konec odpocitavani
 *
 * @return cas v sec.
 */
  private function KonecCas()
  {
    $this->konec = $this->MeritCas();
    $cas = Abs(Round(($this->konec - $this->start) * 10000) / 10000); //Abs, výpočet

    return $cas;
  }

/**
 *
 * Zjisti brovser uzivatelel dle serverovych promennych
 *
 * @param agent agent ze serverovych promennych
 * @return browser uzivatele
 */
  private function ZjistiBrowser($agent)  //zjisteni prohlizece
  { //obsaj prejat a opraven z: programy.wz.cz
    $BrowserList = array ("Internet Explorer \\1" => "#MSIE ([a-zA-Z0-9\.]+)#i",
                          "Mozilla Firefox \\2" => "#(Firefox|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
                          "Flock \\1" => "#Flock/([a-zA-Z0-9\.]+)#i",
                          "Epiphany \\1" => "#Epiphany/([a-zA-Z0-9\.]+)#i",
                          "Konqueror \\1" => "#Konqueror/([a-zA-Z0-9\.]+)#i",
                          "Maxthon \\1" => "#Maxthon ?([a-zA-Z0-9\.]+)?#i",
                          "K-Meleon \\1" => "#K-Meleon/([a-zA-Z0-9\.]+)#i",
                          "Lynx \\1" => "#Lynx/([a-zA-Z0-9\.]+)#i",
                          "Links \\1" => "#Links .{2}([a-zA-Z0-9\.]+)#i",
                          "ELinks \\3" => "#ELinks([/ ]|(.{2}))([a-zA-Z0-9\.]+)#i",
                          "Debian IceWeasel \\1" => "#(iceweasel)/([a-zA-Z0-9\.]+)#i",
                          "Mozilla SeaMonkey \\1" => "#(SeaMonkey)/([a-zA-Z0-9\.]+)#i",
                          "OmniWeb" => "#OmniWeb#i",
                          "Mozilla \\1" => "#^Mozilla/5\.0.*rv:([a-zA-Z0-9\.]+).*#i",
                          "Netscape Navigator \\1" => "#^Mozilla/([a-zA-Z0-9\.]+)#i",
                          "PHP" => "/PHP/i",
                          "SymbianOS \\1" => "#symbianos/([a-zA-Z0-9\.]+)#i",
                          "Avant Browser" => "/avantbrowser\.com/i",
                          "Camino \\1" => "#(Camino|Chimera)[ /]([a-zA-Z0-9\.]+)#i",
                          "Anonymouse" => "/anonymouse/i",
                          "Danger HipTop" => "/danger hiptop/i",
                          "W3M \\1" => "#w3m/([a-zA-Z0-9\.]+)#i",
                          "Shiira \\1" => "#Shiira[ /]([a-zA-Z0-9\.]+)#i",
                          "Dillo \\1" => "#Dillo[ /]([a-zA-Z0-9\.]+)#i",
                          "Openwave UP.Browser \\1" => "#UP.Browser/([a-zA-Z0-9\.]+)#i",
                          "DoCoMo \\1" => "#DoCoMo/(([a-zA-Z0-9\.]+)[/ ]([a-zA-Z0-9\.]+))#i",
                          "Unbranded Firefox \\1" => "#(bonecho)/([a-zA-Z0-9\.]+)#i",
                          "Kazehakase \\1" => "#Kazehakase/([a-zA-Z0-9\.]+)#i",
                          "Minimo \\1" => "#Minimo/([a-zA-Z0-9\.]+)#i",
                          "MultiZilla \\1" => "#MultiZilla/([a-zA-Z0-9\.]+)#i",
                          "Sony PSP \\2" => "/PSP \(PlayStation Portable\)\; ([a-zA-Z0-9\.]+)/i",
                          "Galeon \\1" => "#Galeon/([a-zA-Z0-9\.]+)#i",
                          "iCab \\1" => "#iCab/([a-zA-Z0-9\.]+)#i",
                          "NetPositive \\1" => "#NetPositive/([a-zA-Z0-9\.]+)#i",
                          "NetNewsWire \\1" => "#NetNewsWire/([a-zA-Z0-9\.]+)#i",
                          "Opera Mini \\1" => "#opera mini/([a-zA-Z0-9]+)#i",
                          "WebPro \\2" => "#WebPro(/([a-zA-Z0-9\.]+))?#i",
                          "Netfront \\1" => "#Netfront/([a-zA-Z0-9\.]+)#i",
                          "Xiino \\1" => "#Xiino/([a-zA-Z0-9\.]+)#i",
                          "Blackberry \\1" => "#Blackberry([0-9]+)?#i",
                          "Orange SPV \\1" => "#SPV ([0-9a-zA-Z\.]+)#i",
                          "LG \\1" => "#LGE-([a-zA-Z0-9]+)#i",
                          "Motorola \\1" => "#MOT-([a-zA-Z0-9]+)#i",
                          "Nokia \\1" => "#Nokia ?([0-9]+)#i",
                          "Nokia N-Gage" => "#NokiaN-Gage#i",
                          "Blazer \\1" => "#Blazer[ /]?([a-zA-Z0-9\.]*)#i",
                          "Siemens \\1" => "#SIE-([a-zA-Z0-9]+)#i",
                          "Samsung \\4" => "#((SEC-)|(SAMSUNG-))((S.H-[a-zA-Z0-9]+)|([a-zA-Z0-9]+))#i",
                          "SonyEricsson \\1" => "#SonyEricsson ?([a-zA-Z0-9]+)#i",
                          "J2ME/MIDP Browser" => "#(j2me|midp)#i",
                          "Neznámý" => "/(.*)/");

    foreach($BrowserList as $Browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if ($matches)
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $Browser = str_replace("\\{$i}", $matches[$i], $Browser);
          }
        }
        break;
      }
    }

    return trim($Browser);
  }

/**
 *
 * Zjisti dle agenta operacni system
 *
 * @param agent agent ze serverovych promennych
 * @return operacni system
 */
  private function ZjistiOS($agent)
  { //obsaj prejat a opraven z: programy.wz.cz
    $OSList = array("Windows 3.11" => "/Win16/i",
                    "Windows 95" => "/(Windows.95)|(Win95)/i",
                    "Windows 98" => "/(Windows.98)|(Win98)/i",
                    "Windows 2000" => "/(Windows NT 5\.0)|(Windows 2000)/i",
                    "Windows XP" => "/(Windows NT 5\.1)|(Windows XP)/i",
                    "Windows XP x64" => "/((Windows NT 5\.2).*(Win64))|((Win64).*(Windows NT 5\.2))/i",
                    "Windows Server 2003" => "/Windows NT 5\.2/i",
                    "Windows Vista" => "/Windows NT 6\.0/i",
                    "Windows 7" => "/Windows NT 7\.0/i",
                    "Windows NT 4.0" => "/(Windows NT 4\.0)|(WinNT4\.0)|(WinNT)|(Windows NT)/i",
                    "Windows ME" => "/(Windows ME)|(Win 9x 4\.90)/i",
                    "Microsoft PocketPC" => "/((Windows CE).*(PPC))|((PPC).*(Windows CE))/i",
                    "Microsoft Smartphone" => "/((Windows CE).*(smartphone))|((smartphone).*(Windows CE))/i",
                    "Windows CE" => "/Windows CE/i",
                    "Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "Sharp Zaurus \\1" => "/Zaurus ([a-zA-Z0-9\.]+)/i",
                    "Zaurus" => "/Zaurus/i",
                    "Symbian OS" => "/Symbian/i",
                    "Sony Clie" => "#PalmOS/sony/model#i",
                    "Series \\1" => "/Series ([0-9]+)/i",
                    "Nokia \\1" => "/Nokia ([0-9]+)/i",
                    "Siemens \\1" => "/SIE-([a-zA-Z0-9]+)/i",
                    "Dopod \\1" => "/dopod([a-zA-Z0-9]+)/i",
                    "O2 XDA \\1" => "/o2 xda ([a-zA-Z0-9 ]+);/i",
                    "Samsung \\1" => "/SEC-([a-zA-Z0-9]+)/i",
                    "SonyEricsson \\1" => "/SonyEricsson ?([a-zA-Z0-9]+)/i",
                    "Nintendo Wii" => "/Wii/i",
                    "Bot" => "/(crawler)|(Mediapartners-Google)|(Jyxobot)|(morfeo.centrum.cz)|(Gigabot)|(ASAP-LynxViewer)|(ASAP-Web-Sniffer)|(EARTHCOM.info)|(Mozdex)|(SeznamBot)|(Speedy Spider)|(Yahoo! Slurp)|(ZACATEK_CZ_BOT)|(www.yacy.net)|(Googlebot)|(Openbot)|(MSNBot)|(del.icio.us-thumbnails)|(Exabot)|(findlinks)|(Bot,Robot,Spider)/i",
                    "Neznámý" => "/(.*)/");

    foreach($OSList as $OS => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if ($matches)
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $OS = str_replace("\\{$i}", $matches[$i], $OS);
          }
          break;
        }
      }
    }

    return trim($OS);
  }

/**
 *
 * Detekce linuxu
 *
 * použití v textu: ".($this->DetekceLinuxu() ? "je to linux" : "je to mrkvosoft")."
 *
 * @return jsou to linuxy / nejsou to linuxy - true(linux) / false(MS)
 */
  private function DetekceLinuxu()
  {
    $OSList = array("Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return (!Empty($os) ? true : false);
  }
}

  $web = new Depozit();
?>
