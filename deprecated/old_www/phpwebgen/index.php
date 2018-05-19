<?php

include_once "local_settings.php";

class PHPWebGen extends LocalSettings
{
  private $meta, $menu, $sqlite, $chyba, $dirbaselayout;
  private $get_kam = "action";  //get promenna do adresy
  private $get_sub = "co";  //get promenna pro submenu
  private $dbname = ".phpwebgen.sqlite2"; //databaze modulu
  private $nazevwebu = "PHP Web Generátor";

  private $configfile = ".proj_config";
  private $userpromfile = "user_promenne.php";

  private $copystaticdir = array ("db",
                                  "included",
                                  "modules",
                                  "obr",
                                  "script",
                                  "sekce",
                                  "styles",
                                  "error_page",
                                  );

  private $copystaticfile = array("promenne.php",
                                  "login_promenne.php",
                                  "default_modul.php",
                                  "index.php",
                                  "funkce.php",
                                  "robots.txt",
                                  ".unikatni_fukce.php",

                                  "styles/global_styles.css",
                                  "styles/global_styles_admin.css",
                                  "styles/reset.css",
                                  "styles/styles.css",
                                  "styles/styles_admin.css",
                                  "styles/styles_ie.css",
                                  "styles/styles_ie6.css",
                                  "styles/styles_ie6_admin.css",
                                  "styles/styles_ie7.css",
                                  "styles/styles_ie7_admin.css",
                                  "styles/styles_ie_admin.css",
                                  "styles/styles_linux.css",
                                  "styles/styles_linux_admin.css",

                                  //"error_page/400.html",
                                  "error_page/400.png",
                                  //"error_page/401.html",
                                  "error_page/401.png",
                                  //"error_page/403.html",
                                  "error_page/403.png",
                                  //"error_page/404.html",
                                  //"error_page/500.html",
                                  "error_page/404-500.png",
                                  //"error_page/503.html",
                                  "error_page/503.png",
                                  "error_page/error.css",
                                  "error_page/reset.css",
                                  "error_page/error_sablona.html",
                                  );

  private $adrmenu = array ("",
                            array("module", "addmodule", "editmodule", "delmodule", "searchmodule"),
                            array("admini", "addadmini", "editadmini", "deladmini"),
                            array("ipblok", "addipblok", "editipblok", "delipblok"),
                            array("prom"),
                            array("genweb"),
                            );
/*
pridat tabulku fukci,
* -> z toho i naklikat ktere funkce se naji pouzit a nebo minimalne kdyby se
* vsechny funkce ukazkove zavolaly
pridat tabulku zavislosti!
* rozsirit databazi adminu o polozku normalniho jmena
*
* jmena brat podle nazvu slozky/ci souboru!!
*
* predvolene kombinace
* automaticke doplneni vazeb mezi baliky!
* zakazovani veci ktere je zbytecne nastavovat u baliku!!
* defaultni baliky!
* sdružování na sub balíčky
* nutně kopirovat bez databází!!
* moznost i naklikat kde ktere moduly maji neco spolecnyho s file systemem
* zarucovat poradi v user_promenne!!
* generovatelne promenne + vypelpit jejich online spravu!
*/
  //uzivatelske promenne
  private $promenne = array(array("nazev" => "označování menu v admnu",
                                  "popis" => "možnosti výběru: odkaz, class, id",
                                  "name" => "admin_ozn_menu",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "odkazové označené levé",
                                  "popis" => "znak pro označení odkazu nalevo",
                                  "name" => "select_admin_oznac0",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "odkazové označení pravé",
                                  "popis" => "znak pro označení odkazu napravo",
                                  "name" => "select_admin_oznac1",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "označení podle třídy",
                                  "popis" => "označování odkazu třídou class",
                                  "name" => "select_admin_oznac2",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "označení podle id",
                                  "popis" => "označování odkazu idečkem id",
                                  "name" => "select_admin_oznac3",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "sekund expirace",
                                  "popis" => "sekundy",
                                  "name" => "admin_expire_sec",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "minuty expirace",
                                  "popis" => "minuty",
                                  "name" => "admin_expire_min",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "hodiny expirace",
                                  "popis" => "hodiny",
                                  "name" => "admin_expire_hod",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "dní zálohy",
                                  "popis" => "počet dní pro zálohování",
                                  "name" => "zalohovatdni",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "auto zaloha",
                                  "popis" => "aktivace automatickeho zalohovani",
                                  "name" => "autozaloha",
                                  "type" => "checkbox", //text/checkbox
                                  ),

                            array("nazev" => "adresar zalohy",
                                  "popis" => "jmeno adresare zalohy",
                                  "name" => "zalohadir",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "název webu",
                                  "popis" => "název webu",
                                  "name" => "nazevwebu",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "defaultní stránka",
                                  "popis" => "defaultní stráka webu",
                                  "name" => "default",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "aktualizace",
                                  "popis" => "zapínání aktualizací webu",
                                  "name" => "aktualizovat",
                                  "type" => "checkbox", //text/checkbox
                                  ),

                            array("nazev" => "htaccess",
                                  "popis" => "zapíná transformaci adres do htaccess modu",
                                  "name" => "htaccess",
                                  "type" => "checkbox", //text/checkbox
                                  ),

                            array("nazev" => "debug mod",
                                  "popis" => "zapíná debug mód",
                                  "name" => "debug_mod",
                                  "type" => "checkbox", //text/checkbox
                                  ),

                            array("nazev" => "administrace",
                                  "popis" => "zapíná jestli je webu administrace (při statickych webech)",
                                  "name" => "administrace",
                                  "type" => "checkbox", //text/checkbox
                                  ),

                            array("nazev" => "adresa adminu",
                                  "popis" => "nastavuje jaka bude adresa adminu",
                                  "name" => "adresaadminu",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "soubory menu",
                                  "popis" => "určuje složku kde budou soubory se stánkami menu",
                                  "name" => "souborymenu",
                                  "type" => "text", //text/checkbox
                                  ),

/*
                            array("nazev" => "soubory include",
                                  "popis" => "určuje složku kde budou soubory s unikátním nastavením",
                                  "name" => "souboryinclude",
                                  "type" => "text", //text/checkbox
                                  ),
*/

                            array("nazev" => "get_kam",
                                  "popis" => "určuje adresu kam",
                                  "name" => "get_kam",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "get_idmodul",
                                  "popis" => "určuje adresu modulu",
                                  "name" => "get_idmodul",
                                  "type" => "text", //text/checkbox
                                  ),

                            array("nazev" => "get_submenu",
                                  "popis" => "určuje adresu submenu",
                                  "name" => "get_submenu",
                                  "type" => "text", //text/checkbox
                                  ),
                            );

/**
 *
 * Konstruktor stranek
 *
 */
  public function __construct()
  {
    $this->StartCas();

    $this->menu = array(array("main_href" => $this->adrmenu[0][0],
                              "odkaz" => "Úvod",
                              "title" => "Úvod",
                              "id" => "aktivni",
                              "class" => "",
                              "akce" => "",
                              "submenu" => "",
                              ),

                        array("main_href" => $this->adrmenu[1][0],
                              "odkaz" => "Moduly",
                              "title" => "Moduly",
                              "id" => "aktivni",
                              "class" => "",
                              "akce" => "",
                              "submenu" =>array($this->adrmenu[1][1] => "Přidat modul",
                                                $this->adrmenu[1][2] => "Upravit modul",
                                                $this->adrmenu[1][3] => "Smazat modul",
                                                $this->adrmenu[1][4] => "Prohledat stávající moduly"),
                              ),

                        array("main_href" => $this->adrmenu[2][0],
                              "odkaz" => "Administrátoři",
                              "title" => "Administrátoři",
                              "id" => "aktivni",
                              "class" => "",
                              "akce" => "",
                              "submenu" =>array($this->adrmenu[2][1] => "Přidat administrátora",
                                                $this->adrmenu[2][2] => "Upravit administrátora",
                                                $this->adrmenu[2][3] => "Smazat administrátora"),
                              ),

                        array("main_href" => $this->adrmenu[3][0],
                              "odkaz" => "IP BAN",
                              "title" => "IP BAN",
                              "id" => "aktivni",
                              "class" => "",
                              "akce" => "",
                              "submenu" =>array($this->adrmenu[3][1] => "Přidat IP BAN",
                                                $this->adrmenu[3][2] => "Upravit IP BAN",
                                                $this->adrmenu[3][3] => "Smazat IP BAN"),
                              ),

                        array("main_href" => $this->adrmenu[4][0],
                              "odkaz" => "Nastavení defaultních uživatelských proměnných",
                              "title" => "Nastavení defaultních uživatelských proměnných",
                              "id" => "aktivni",
                              "class" => "",
                              "akce" => "",
                              "submenu" => "",
                              ),

                        array("main_href" => $this->adrmenu[5][0],
                              "odkaz" => "Vygenerovat web",
                              "title" => "Vygenerovat web",
                              "id" => "aktivni",
                              "class" => "",
                              "akce" => "",
                              "submenu" => "",
                              ),
                        );

    if (!$this->sqlite = @new SQLiteDatabase($this->dbname, 0777, $error))
    {
      $this->ErrorMsg($error);
    }

    $this->dirbaselayout = dirname($this->dirlayout); //vrati cestu bez nadslozky

    $this->Instalace();

    $menu = $this->Menu();
    $obsah = $this->Obsah();
    $title = $this->Title();

    $linux = ($this->DetekceLinuxu() ? "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_linux.css\" media=\"screen\" />" : "");

    $result =
    "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
  \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Geniv &amp; Fugess &amp; Jurkix (GF Design - www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz - www.gfdesign.cz)\" />
    <meta name=\"keywords\" content=\"\" />
    <meta name=\"description\" content=\"\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />
    {$this->meta}
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
      {$linux}
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <!--[if lte IE 6]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie6.css\" media=\"screen\" />
    <![endif]-->
    <title>{$this->nazevwebu} - {$title}</title>
    <!-- <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />              -->
    <!-- <script type=\"text/javascript\" src=\"script/funkce.js\"></script>  -->
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"zahlavi\">
        <h1>{$this->nazevwebu}</h1>
      </div>
      <div id=\"obal_obsah\">
        <div id=\"menu_obal\">
{$menu}        </div>
        <div id=\"obal_sekce\">
{$obsah}
        </div>{$this->chyba}
      </div>
      <div id=\"zapati\">
        <p>
          <em>
            Stránka vygenerována za: {$this->KonecCas()} s /
          </em>
          <strong>
            Created by <a href=\"http://www.gfdesign.cz/\" title=\"GF Design - Tvorba webových stránek a systémů\">GF design</a>
          </strong>
        </p>
      </div>
    </div>
  </body>
</html>
    ";

    echo $result;
  }

/**
 *
 * Instalace dazabaze
 *
 */
  private function Instalace()
  {
    if (filesize($this->dbname) == 0)
    {
      if (!@$this->sqlite->queryExec("CREATE TABLE moduly (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(200),
                                      include VARCHAR(1000),
                                      class VARCHAR(200),
                                      admin BOOL,
                                      databaze VARCHAR(200),
                                      zobrazit BOOL,
                                      popisek TEXT);

                                      CREATE TABLE admini (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      jmeno VARCHAR(100),
                                      heslo VARCHAR(100));

                                      INSERT INTO admini (id, jmeno, heslo) VALUES (NULL, '6342fd9364b41005acce71e244849183', '93f9a5d3507bbd81db94663fd09dc866');
                                      INSERT INTO admini (id, jmeno, heslo) VALUES (NULL, '48acfd8edd4b6009c8257490df01c717', '7c8c47575b1ff8a0a34e871a33b5954f');
                                      INSERT INTO admini (id, jmeno, heslo) VALUES (NULL, '06b586c247dd639a269aa3bbe70fabac', '2750e0d761a4d611073ae2ac3b171753');

                                      CREATE TABLE ipblok (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      ip VARCHAR(50));

                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '127.0.1.1');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '127.0.0.1');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.1');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.2');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.3');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.4');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.5');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.6');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.7');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.8');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.9');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.10');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.11');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.12');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.13');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.14');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.15');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.16');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.17');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.18');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.19');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.20');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.21');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.22');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.23');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.24');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.25');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.26');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.27');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.28');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.29');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.30');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.31');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.32');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.33');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.34');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.35');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.36');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.37');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.38');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.39');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.40');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.41');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.42');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.43');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.44');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.45');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.46');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.47');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.48');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.49');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.50');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.101');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.102');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.103');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.104');
                                      INSERT INTO ipblok (id, ip) VALUES (NULL, '192.168.1.105');
                                      ", $error))
      {
        $this->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Generovani title
 *
 * @return text title
 */
  private function Title()
  {
    $result = $this->menu[0]["title"];
    for ($i = 0; $i < count($this->menu); $i++)
    {
      if ($_GET[$this->get_kam] == $this->menu[$i]["main_href"])
      {
        $result = $this->menu[$i]["title"].(!Empty($this->menu[$i]["submenu"]) && !Empty($_GET[$this->get_sub]) ? " - {$this->menu[$i]["submenu"][$_GET[$this->get_sub]]}" : "");

        break;
      }
    }

    return $result;
  }

/**
 *
 * Generuje menu
 *
 * @return vygenerovane menu
 */
  private function Menu()
  {
    $result = "";
    for ($i = 0; $i < count($this->menu); $i++)
    {
      $podm = ($_GET[$this->get_kam] == $this->menu[$i]["main_href"]);
      $href = (!Empty($this->menu[$i]["main_href"]) ? "?{$this->get_kam}={$this->menu[$i]["main_href"]}" : "./");
      $class = (!Empty($this->menu[$i]["class"]) ? " class=\"{$this->menu[$i]["main_href"]}\"" : "");
      $id = (!Empty($this->menu[$i]["id"]) && $podm ? " id=\"{$this->menu[$i]["id"]}\"" : "");
      $akce = (!Empty($this->menu[$i]["akce"]) ? " {$this->menu[$i]["akce"]}" : "");

      $result .=
      "<p>
  <a href=\"{$href}\" title=\"{$this->menu[$i]["odkaz"]}\"{$class}{$id}{$akce}>
    {$this->menu[$i]["odkaz"]}
  </a>
</p>
";
    }

    return $result;
  }

/**
 *
 * Generovani obsahu
 *
 * @return obsah stanek
 */
  private function Obsah()
  {
    $result = "";
    switch ($_GET[$this->get_kam])
    {
      case $this->adrmenu[0][0]:  //uvod
        $result =
        "<h2>Tento systém má za úkol vygenerovat uživatelem nadefinované moduly z výchozího layoutu</h2>
<h3>Návod na použití Web Generátoru</h3>
<ul>
  <li>Lorem ipsum dolor sit amet consectetuer fermentum Curabitur eget orci adipiscing. Praesent dui condimentum sit orci justo nonummy pede felis iaculis convallis. Et laoreet fringilla parturient elit at Aliquam vitae lobortis pellentesque quis. Orci tellus id commodo tempus congue nisl Curabitur dictumst lacinia Vestibulum. Gravida est Nulla condimentum metus justo congue in laoreet dapibus lacus.</li>
  <li>dasdasd</li>
  <li>Vivamus hendrerit ipsum felis sapien Ut urna tincidunt laoreet malesuada scelerisque. Lacinia augue et justo hac Maecenas mattis hendrerit eget wisi mauris. Justo mi laoreet orci quis orci platea metus sollicitudin Vestibulum nec. Aenean magna id id sem pharetra nibh sodales metus a metus. Nam at Fusce faucibus tristique justo a semper ligula Vestibulum interdum. Adipiscing elit dolor.</li>
  <li>asdas</li>
  <li>sadsadfsaf</li>
  <li>dsfdfbg</li>
  <li>fbdgbdfv</li>
</ul>";
      break;

      case $this->adrmenu[1][0]:  //moduly
        $result =
        "
        <br />
        <a href=\"?{$this->get_kam}={$this->adrmenu[1][0]}&amp;{$this->get_sub}={$this->adrmenu[1][1]}\">Přidej modul</a><br />
        <a href=\"?{$this->get_kam}={$this->adrmenu[1][0]}&amp;{$this->get_sub}={$this->adrmenu[1][4]}\">Prohledat stávající moduly</a><br />
        <br />
        {$this->VypisModulu()}
        ";

        switch ($_GET[$this->get_sub])
        {
          case $this->adrmenu[1][1]:  //pridat
            $result =
            "
            <form method=\"post\">
              <fieldset>
                název: <input type=\"text\" name=\"nazev\" size=\"50\" />*<br />
                include: <input type=\"text\" name=\"include\" value=\"{$_GET["include"]}\" size=\"50\" />*<br />
                class: <input type=\"text\" name=\"class\" value=\"{$_GET["class"]}\" />*<br />
                admin: <input type=\"checkbox\" name=\"admin\" /><br />
                databaze: <input type=\"text\" name=\"databaze\" value=\"{$_GET["databaze"]}\" /><br />
                zobrazit: <input type=\"checkbox\" name=\"zobrazit\" /><br />
                popisek: <textarea name=\"popisek\"></textarea><br />
                <input type=\"submit\" name=\"tlacitko\" value=\"Přidat modul\" />
              </fieldset>
            </form>
            ";

            $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
            $include = stripslashes(htmlspecialchars($_POST["include"], ENT_QUOTES));
            $class = stripslashes(htmlspecialchars($_POST["class"], ENT_QUOTES));
            $admin = (!Empty($_POST["admin"]) ? 1 : 0);
            $databaze = stripslashes(htmlspecialchars($_POST["databaze"], ENT_QUOTES));
            $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
            $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($nazev) &&
                !Empty($include) &&
                !Empty($class))
            {
              if (@$this->sqlite->queryExec("INSERT INTO moduly (id, nazev, include, class, admin, databaze, zobrazit, popisek) VALUES
                                            (NULL, '{$nazev}', '{$include}', '{$class}', {$admin}, '{$databaze}', {$zobrazit}, '{$popisek}');", $error))
              {
                $result =
                "
                  přídán: {$nazev}
                ";
              }
                else
              {
                $this->ErrorMsg($error);
              }

              $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[1][0]}");  //auto kliknuti
            }
          break;

          case $this->adrmenu[1][2]:  //upravit
            $id = $_GET["id"];  //cislo sekce
            settype($id, "integer");

            if ($res = @$this->sqlite->query("SELECT nazev, include, class, admin, databaze, zobrazit, popisek FROM moduly WHERE id={$id};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();

                $result =
                "
                <form method=\"post\">
                  <fieldset>
                    název: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" />*<br />
                    include: <input type=\"text\" name=\"include\" value=\"{$data->include}\" />*<br />
                    class: <input type=\"text\" name=\"class\" value=\"{$data->class}\" />*<br />
                    admin: <input type=\"checkbox\" name=\"admin\"".($data->admin ? " checked=\"checked\"" : "")." /><br />
                    databaze: <input type=\"text\" name=\"databaze\" value=\"{$data->databaze}\" /><br />
                    zobrazit: <input type=\"checkbox\" name=\"zobrazit\"".($data->zobrazit ? " checked=\"checked\"" : "")." /><br />
                    popisek: <textarea name=\"popisek\">{$data->popisek}</textarea><br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"Upravit modul\" />
                  </fieldset>
                </form>
                ";

                $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
                $include = stripslashes(htmlspecialchars($_POST["include"], ENT_QUOTES));
                $class = stripslashes(htmlspecialchars($_POST["class"], ENT_QUOTES));
                $admin = (!Empty($_POST["admin"]) ? 1 : 0);
                $databaze = stripslashes(htmlspecialchars($_POST["databaze"], ENT_QUOTES));
                $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
                $popisek = stripslashes(htmlspecialchars($_POST["popisek"], ENT_QUOTES));

                if (!Empty($_POST["tlacitko"]) &&
                    !Empty($nazev) &&
                    !Empty($include) &&
                    !Empty($class) &&
                    $id != 0)
                {
                  if (@$this->sqlite->queryExec ("UPDATE moduly SET nazev='{$nazev}',
                                                                    include='{$include}',
                                                                    class='{$class}',
                                                                    admin={$admin},
                                                                    databaze='{$databaze}',
                                                                    zobrazit={$zobrazit},
                                                                    popisek='{$popisek}'
                                                                    WHERE id={$id};", $error))
                  {
                    $result =
                    "
                      upraven: {$nazev}
                    ";
                  }
                    else
                  {
                    $this->var->main[0]->ErrorMsg($error);
                  }

                  $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[1][0]}");  //auto kliknuti
                }
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }
          break;

          case $this->adrmenu[1][3]:  //smazat
            $id = $_GET["id"];  //cislo sekce
            settype($id, "integer");

            if ($res = @$this->sqlite->query("SELECT nazev FROM moduly WHERE id={$id};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();

                if (@$this->sqlite->queryExec("DELETE FROM moduly WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $result =
                  "
                    smazán: '{$data->nazev}'
                  ";
                }
                  else
                {
                  $this->ErrorMsg($error);
                }

                $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[1][0]}");  //auto kliknuti
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          break;

          case $this->adrmenu[1][4]:  //automaticke hledani modulu
            $moduly = $this->ProjdiSlozku($this->dirlayout);

            for ($i = 0; $i < count($moduly); $i++)
            {
              $u = fopen($moduly[$i], "r"); //nacteni tridy
              $uryvek = explode("class ", nl2br(fread($u, 5000)));  //rozdeleni podle tridy
              fclose($u);
              $uryvek = explode(" extends", $uryvek[1]);  //rozdeleni podle dedicnosti
              $uryvek = explode("<br />", $uryvek[0]);  //rozdeleni podle entru
              $uryvek = explode(" //", $uryvek[0]); //rozdeleni podle komentare

              if ($res = @$this->sqlite->query("SELECT id FROM moduly WHERE class='{$uryvek[0]}';", NULL, $error))
              {
                if ($res->numRows() == 0)
                {
                  $incl = explode("/", $moduly[$i]);  //nacteni include souboru
                  $include = "";
                  for ($j = 2; $j < count($incl); $j++)
                  {
                    $include .= "{$incl[$j]}".($j != (count($incl) - 1) ? "/" : "");
                  }

                  $dat = explode("_", basename($include));  //vytvoreni jmena databaze
                  $databaze = ".db";
                  for ($j = 0; $j < count($dat); $j++)
                  {
                    $databaze .= substr($dat[$j], 0, 3);
                  }
                  $databaze .= ".sqlite2";

                  $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[1][0]}&amp;co={$this->adrmenu[1][1]}&amp;include={$include}&amp;class={$uryvek[0]}&amp;databaze={$databaze}");  //auto kliknuti
                  break;
                }
              }
                else
              {
                $this->ErrorMsg($error);
              }

              if ($i == (count($moduly) - 1))
              {
                $result =
                "
                  žádné nové moduly<br />
                ";

                $this->AutoClick(2, "?{$this->get_kam}={$this->adrmenu[1][0]}");  //auto kliknuti
              }
                else
              {
                $result .=
                "
                  prohledávám  moduly ({$uryvek[0]}) ...<br />
                ";
              }
            }
          break;
        }
      break;

      case $this->adrmenu[2][0]:  //admini
        $result =
        "
        <br />
        <a href=\"?{$this->get_kam}={$this->adrmenu[2][0]}&amp;{$this->get_sub}={$this->adrmenu[2][1]}\">přidej admina</a><br />
        <br />
        {$this->VypisAdminu()}
        ";

        switch ($_GET[$this->get_sub])
        {
          case $this->adrmenu[2][1]:  //pridat
            $result =
            "
            <form method=\"post\">
              <fieldset>
                jmeno: <input type=\"text\" name=\"jmeno\" />*<br />
                heslo: <input type=\"text\" name=\"heslo\" />*<br />
                <input type=\"submit\" name=\"tlacitko\" value=\"Přidat admina\" />
              </fieldset>
            </form>
            ";

            $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"], ENT_QUOTES));
            $heslo = stripslashes(htmlspecialchars($_POST["heslo"], ENT_QUOTES));

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($jmeno) &&
                !Empty($heslo))
            {
              if (@$this->sqlite->queryExec("INSERT INTO admini (id, jmeno, heslo) VALUES
                                            (NULL, '{$jmeno}', '{$heslo}');", $error))
              {
                $result =
                "
                  přídán: {$jmeno}
                ";
              }
                else
              {
                $this->ErrorMsg($error);
              }

              $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[2][0]}");  //auto kliknuti
            }
          break;

          case $this->adrmenu[2][2]:  //upravit
            $id = $_GET["id"];  //cislo sekce
            settype($id, "integer");

            if ($res = @$this->sqlite->query("SELECT jmeno, heslo FROM admini WHERE id={$id};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();

                $result =
                "
                <form method=\"post\">
                  <fieldset>
                    jmeno: <input type=\"text\" name=\"jmeno\" value=\"{$data->jmeno}\" />*<br />
                    heslo: <input type=\"text\" name=\"heslo\" value=\"{$data->heslo}\" />*<br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"Upravit admina\" />
                  </fieldset>
                </form>
                ";

                $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"], ENT_QUOTES));
                $heslo = stripslashes(htmlspecialchars($_POST["heslo"], ENT_QUOTES));

                if (!Empty($_POST["tlacitko"]) &&
                    !Empty($jmeno) &&
                    !Empty($heslo) &&
                    $id != 0)
                {
                  if (@$this->sqlite->queryExec ("UPDATE admini SET jmeno='{$jmeno}',
                                                                    heslo='{$heslo}'
                                                                    WHERE id={$id};", $error))
                  {
                    $result =
                    "
                      upraveno: {$jmeno}
                    ";
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }

                  $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[2][0]}");  //auto kliknuti
                }
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          break;

          case $this->adrmenu[2][3]:  //smazat
            $id = $_GET["id"];  //cislo sekce
            settype($id, "integer");

            if ($res = @$this->sqlite->query("SELECT jmeno FROM admini WHERE id={$id};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();

                if (@$this->sqlite->queryExec("DELETE FROM admini WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $result =
                  "
                    smazáno: '{$data->jmeno}'
                  ";
                }
                  else
                {
                  $this->ErrorMsg($error);
                }

                $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[2][0]}");  //auto kliknuti
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          break;
        }
      break;

      case $this->adrmenu[3][0]:  //ip bloky
        $result =
        "
        <br />
        <a href=\"?{$this->get_kam}={$this->adrmenu[3][0]}&amp;{$this->get_sub}={$this->adrmenu[3][1]}\">přidej ip</a><br />
        <br />
        {$this->VypisIp()}
        ";

        switch ($_GET[$this->get_sub])
        {
          case $this->adrmenu[3][1]:  //pridat
            $result =
            "
            <form method=\"post\">
              <fieldset>
                ip: <input type=\"text\" name=\"ip\" />*<br />
                <input type=\"submit\" name=\"tlacitko\" value=\"Přidat ip\" />
              </fieldset>
            </form>
            ";

          $ip = stripslashes(htmlspecialchars($_POST["ip"], ENT_QUOTES));

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($ip))
            {
              if (@$this->sqlite->queryExec("INSERT INTO ipblok (id, ip) VALUES
                                            (NULL, '{$ip}');", $error))
              {
                $result =
                "
                  přídáno: {$ip}
                ";
              }
                else
              {
                $this->ErrorMsg($error);
              }

              $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[3][0]}");  //auto kliknuti
            }
          break;

          case $this->adrmenu[3][2]:  //upravit
            $id = $_GET["id"];  //cislo sekce
            settype($id, "integer");

            if ($res = @$this->sqlite->query("SELECT ip FROM ipblok WHERE id={$id};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();

                $result =
                "
                <form method=\"post\">
                  <fieldset>
                    ip: <input type=\"text\" name=\"ip\" value=\"{$data->ip}\" />*<br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"Upravit ip\" />
                  </fieldset>
                </form>
                ";

                $ip = stripslashes(htmlspecialchars($_POST["ip"], ENT_QUOTES));

                if (!Empty($_POST["tlacitko"]) &&
                    !Empty($ip) &&
                    $id != 0)
                {
                  if (@$this->sqlite->queryExec ("UPDATE ipblok SET ip='{$ip}'
                                                                    WHERE id={$id};", $error))
                  {
                    $result =
                    "
                      upraveno: {$ip}
                    ";
                  }
                    else
                  {
                    $this->ErrorMsg($error);
                  }

                  $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[3][0]}");  //auto kliknuti
                }
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          break;

          case $this->adrmenu[3][3]:  //smazat
            $id = $_GET["id"];  //cislo sekce
            settype($id, "integer");

            if ($res = @$this->sqlite->query("SELECT ip FROM ipblok WHERE id={$id};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();

                if (@$this->sqlite->queryExec("DELETE FROM ipblok WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $result =
                  "
                    smazáno: '{$data->ip}'
                  ";
                }
                  else
                {
                  $this->ErrorMsg($error);
                }

                $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[3][0]}");  //auto kliknuti
              }
            }
              else
            {
              $this->ErrorMsg($error);
            }
          break;
        }
      break;

      case $this->adrmenu[4][0]:  //promenne
        $dat = $this->NactiKonfiguraci(".konfprom");

        $result =
        "
        <form method=\"get\">
          <fieldset>
            <input type=\"hidden\" name=\"{$this->get_kam}\" value=\"{$this->adrmenu[4][0]}\" />";

            for ($i = 0; $i < count($this->promenne); $i++)
            {
              $value = ($this->promenne[$i]["type"] == "text" ? " value=\"{$dat[$i]}\"" : ($dat[$i] ? " checked=\"checked\"" : ""));

              $result .=
              "
              {$this->promenne[$i]["nazev"]}: <input type=\"{$this->promenne[$i]["type"]}\" name=\"{$this->promenne[$i]["name"]}\"{$value} /> {$this->promenne[$i]["popis"]}<br />
              ";

              $prom[] = ($this->promenne[$i]["type"] == "text" ? stripslashes(htmlspecialchars($_GET[$this->promenne[$i]["name"]], ENT_QUOTES)) : (!Empty($_GET[$this->promenne[$i]["name"]]) ? 1 : 0));
            }

        $result .=
        "
            <input type=\"submit\" name=\"tlacitko\" value=\"Uložit konfguraci\" />
          </fieldset>
        </form>
        ";

        if (!Empty($_GET["tlacitko"]))
        {
          $this->UlozKonfiguraci(".konfprom", $prom);

          $result =
          "uloženo...";

          $this->AutoClick(1, "?{$this->get_kam}={$this->adrmenu[4][0]}");  //auto kliknuti
        }
      break;

      case $this->adrmenu[5][0]:  //generovani
        $cestakwebu = $_GET["cestakwebu"];
        $nazevprojektu = $_POST["nazevprojektu"];

        $result =
        "
        generování webu, zde si naklikame dotyčný web<br /><br />

        <form method=\"get\">
          <fieldset>
            <input type=\"hidden\" name=\"{$this->get_kam}\" value=\"{$this->adrmenu[5][0]}\" />
            Cesta k projektu: <input type=\"text\" name=\"cestakwebu\" value=\"{$cestakwebu}\" size=\"100\" \>/{$this->configfile}<br /><br />
            <input type=\"submit\" name=\"loadtlacitko\" value=\"Načti konfiguraci webu\">
          </fieldset>
        </form>
        ";

        if (!Empty($_GET["loadtlacitko"]) &&
            !Empty($cestakwebu))
        {
          $soubor = "{$cestakwebu}/{$this->configfile}";
          if (file_exists($soubor))
          {
            $u = fopen($soubor, "r");
            $data = fread($u, filesize($soubor));
            fclose($u);

            // 0: nazev
            // 1: moduly
            // 2: dat - promenne

            $data = explode("-||-", $data);
            $nazevprojektu = $data[0];  //naceteni nazvu
            $nactenemoduly = explode(", ", $data[1]); //pole modulu
            $dat = explode("|--|", $data[2]); //pole promennych
          }
            else
          {
            $result .= "Neexistuje uložená konfigurace!<br />";
          }
        }
          else
        {
          $dat = $this->NactiKonfiguraci(".konfprom");  //pole promennych
        }

        //generovani promennych
        $prom = "";
        for ($i = 0; $i < count($this->promenne); $i++)
        {
          $textove = stripslashes(htmlspecialchars($_POST[$this->promenne[$i]["name"]], ENT_QUOTES));

          $value = ($this->promenne[$i]["type"] == "text" ?
                    (!Empty($_POST[$this->promenne[$i]["name"]]) ? " value=\"{$textove}\"" : " value=\"{$dat[$i]}\"") :
                    (!Empty($_POST[$this->promenne[$i]["name"]]) ? ($_POST[$this->promenne[$i]["name"]] ? " checked=\"checked\"" : "") : ($dat[$i] ? " checked=\"checked\"" : ""))
                    );

          $prom .=
          "
          {$this->promenne[$i]["nazev"]}: <input type=\"{$this->promenne[$i]["type"]}\" name=\"{$this->promenne[$i]["name"]}\"{$value} /> {$this->promenne[$i]["popis"]}<br />
          ";

          $hledat[] = "%%{$this->promenne[$i]["name"]}%%";
          $nahradit[] = ($this->promenne[$i]["type"] == "text" ? stripslashes(htmlspecialchars($_POST[$this->promenne[$i]["name"]], ENT_QUOTES)) : (!Empty($_POST[$this->promenne[$i]["name"]]) ? "true" : "false"));
          $save_proj[] = ($this->promenne[$i]["type"] == "text" ? stripslashes(htmlspecialchars($_POST[$this->promenne[$i]["name"]], ENT_QUOTES)) : (!Empty($_POST[$this->promenne[$i]["name"]]) ? 1 : 0));
        }

        $webgenpath = dirname($_SERVER["SCRIPT_NAME"]);

        $result .=
        "
        <br />
        aktuální projekt: ".(!Empty($nazevprojektu) ? $nazevprojektu : "není vložen název")."
        <br /><br />
        adresa aktualniho webu: ".(!Empty($nazevprojektu) ? "<a href=\"http://{$_SERVER["SERVER_NAME"]}{$webgenpath}/{$this->dirout}/{$nazevprojektu}\" target=\"_blank\">{$nazevprojektu}</a>" : "nebyl dosud vytvořen")."<br />
        <br />
        <form method=\"post\">
          <fieldset>
            {$this->VyberVypisModulu($nactenemoduly)}
            <hr />
            Název projektu: <input type=\"text\" name=\"nazevprojektu\" value=\"{$nazevprojektu}\">*<br /><br />
            {$prom}
            <input type=\"submit\" name=\"tlacitko\" value=\"Vygenerovat web\">
          </fieldset>
        </form>
        ";

        if (!Empty($_POST["tlacitko"]) &&
            !Empty($nazevprojektu) &&
            count($_POST["modul"]) > 0)
        {
          //generovani modulu
          $moduly = implode(", ", $_POST["modul"]);
          $hledat[] = "%%moduly%%";
          $module = "array(\"include\" => \"funkce.php\",  //hlavni funkce musi byt implicitne na 0.
                                  \"class\" => \"Funkce\",
                                  \"admin\" => true,
                                  \"databaze\" => \"\",
                                  \"zobrazit\" => true,
                                  \"uloziste\" => \"sqlite\"),\n";

          if ($res = @$this->sqlite->query("SELECT id, include, class, admin, databaze FROM moduly WHERE id IN({$moduly});", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              while ($data = $res->fetchObject())
              {
                $module .=
                "
                            array(\"include\" => \"{$data->include}\",
                                  \"class\" =>  \"{$data->class}\",
                                  \"admin\" => ".($data->admin ? "true" : "false").",
                                  \"databaze\" => \"{$data->databaze}\",
                                  \"zobrazit\" => ".(in_array($data->id, $_POST["zobrazit"]) ? "true" : "false").",
                                  \"uloziste\" => \"sqlite\"),\n";
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
          $nahradit[] = $module;

          //generovani adminu
          $hledat[] = "%%admini%%";
          $admini = "";
          if ($res = @$this->sqlite->query("SELECT jmeno, heslo FROM admini ORDER BY LOWER(jmeno) ASC;", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              while ($data = $res->fetchObject())
              {
                $admini .=
                "\"{$data->jmeno}\" => \"{$data->heslo}\",
                                  ";
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
          $nahradit[] = $admini;

          //generovani ip
          $hledat[] = "%%ip%%";
          $ip = "";
          if ($res = @$this->sqlite->query("SELECT ip FROM ipblok ORDER BY LOWER(ip) ASC;", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              while ($data = $res->fetchObject())
              {
                $ip .=
                "\"{$data->ip}\",
                            ";
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
          $nahradit[] = $ip;

          //oteverni sablony
          $soubor = "{$this->dirsablony}/sablona_{$this->userpromfile}";
          $u = fopen($soubor, "r");
          $user_prom = fread($u, filesize($soubor));
          fclose($u);

          $out[] = $nazevprojektu;
          $out[] = $moduly;
          $out[] = implode("|--|", $save_proj);
          $ulozit = implode("-||-", $out);

          if (!file_exists("{$this->dirout}/{$nazevprojektu}"))
          {
            mkdir("{$this->dirout}/{$nazevprojektu}", 0777);  //vytvoreni slozky projektu
            $result .= "vytvořena složka projektu: <strong>{$nazevprojektu}</strong><br />";
          }

          //nahrazeni slov
          $nove_promenne = str_replace($hledat, $nahradit, $user_prom);

          $soubor = "{$this->dirout}/{$nazevprojektu}/{$this->configfile}";
          if ($u = fopen($soubor, "w"))
          {
            fwrite($u, $ulozit);
            $result .= "projekt uložen do konfiguračního souboru: <strong>{$this->configfile}</strong><br />";
          }
          fclose($u);

          $soubor = "{$this->dirout}/{$nazevprojektu}/{$this->userpromfile}";
          if ($u = fopen($soubor, "w"))
          {
            fwrite($u, $nove_promenne);
            $result .= "vytvořen soubor: <strong>{$this->userpromfile}</strong><br />";
          }
          fclose($u);

          for ($i = 0; $i < count($this->copystaticdir); $i++)
          {
            if (!Empty($this->copystaticdir[$i]) && !file_exists("{$this->dirout}/{$nazevprojektu}/{$this->copystaticdir[$i]}"))
            {
              mkdir("{$this->dirout}/{$nazevprojektu}/{$this->copystaticdir[$i]}", 0777);
              $result .= "vytvořena složka: <strong>{$this->copystaticdir[$i]}</strong><br />";
            }
          }

          for ($i = 0; $i < count($this->copystaticfile); $i++)
          {
            if (!Empty($this->copystaticfile[$i]))
            {
              if (!file_exists("{$this->dirout}/{$nazevprojektu}/{$this->copystaticfile[$i]}"))
              {//dirbaselayout -< ??
                copy("{$this->dirbaselayout}/{$this->copystaticfile[$i]}", "{$this->dirout}/{$nazevprojektu}/{$this->copystaticfile[$i]}");
                $result .= "zkopírováno: <strong>{$this->copystaticfile[$i]}</strong><br />";
              }
            }
          }

          if ($res = @$this->sqlite->query("SELECT include FROM moduly WHERE id IN({$moduly});", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              while ($data = $res->fetchObject())
              {
                $cesta = dirname("{$this->dirbaselayout}/{$data->include}");
                $slozky = $this->VypisSlozky($cesta);
                for($i = 0; $i < count($slozky); $i++)  //prochazeni zjistenych neprazdnach slozek a souboru
                {
                  $path = dirname($slozky[$i]); //zjisteni slozky
                  $nazev = basename($slozky[$i]); //zjisteni nazvu souboru

                  $cutpath = explode("/", $path); //rozsekani podle lomitka
                  $kuscesty = "";
                  for ($j = 2; $j < count($cutpath); $j++)  //projiti cesty s omezenim
                  {
                    $kuscesty[] = $cutpath[$j]; //nacpani do nezavisleho pole
                    $mezicesta = implode("/", $kuscesty); //spojeni urcite cesty opet dohromady

                    if (!file_exists("{$this->dirout}/{$nazevprojektu}/{$mezicesta}"))  //vytvoreni slozek
                    {
                      mkdir("{$this->dirout}/{$nazevprojektu}/{$mezicesta}", 0777);
                      $result .= "vytvořena složka: <strong>{$mezicesta}</strong><br />";
                    }

                    if ($j == (count($cutpath) - 1))  //kdyz je konec adresare
                    {
                      if (!file_exists("{$this->dirout}/{$nazevprojektu}/{$mezicesta}/{$nazev}")) //prekoprovani dotycnich souboru
                      {
                        copy($slozky[$i], "{$this->dirout}/{$nazevprojektu}/{$mezicesta}/{$nazev}");
                        $result .= "zkopírován soubor: <strong>{$mezicesta}/{$nazev}</strong><br />";
                      }
                    }
                  }
                }
              }
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }
          //jeste by tam mohlo byt seznam funkci
        }
          else
        {
          if (!Empty($_POST["tlacitko"]))
          {
            if (Empty($_POST["nazevprojektu"]))
            {
              $result = "Chybý název projektu";
            }

            if (count($_POST["modul"]) == 0)
            {
              $result = "Musí být vybrán alespoň jeden modul";
            }
          }
        }
      break;
    }

    return $result;
  }

/**
 *
 * Vypis slozek a souboru do pole
 *
 * @param cesta cesta ke slozce
 * @return pole cest
 */
  private function VypisSlozky($cesta)
  {
    $handle = opendir($cesta);
    $result = "";
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $ret = $this->VypisSlozky("{$cesta}/{$soub}");
            if (!Empty($ret))
            {
              for ($i = 0; $i < count($ret); $i++)
              {
                if (!Empty($ret[$i]))
                {
                  $result[] = $ret[$i];
                }
              }
            }
          break;

          case "file":
            $result[] = "{$cesta}/{$soub}";
          break;
        }
      }
    }
    closedir($handle);

    return $result;
  }

/**
 *
 * Rekurzivni prochazeni slozky, s filtrem na *.php, ve slozce s 2 php bere posledni
 *
 * @param cesta cesta slozky
 * @return pole souboru
 */
  private function ProjdiSlozku($cesta)
  {
    $handle = opendir($cesta);
    $result = "";
    $i = 0;
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != "..")
      {
        switch (filetype("{$cesta}/{$soub}"))
        {
          case "dir":
            $ret = $this->ProjdiSlozku("{$cesta}/{$soub}");
            if (!Empty($ret))
            {
              $result[$i] = $ret[count($ret) - 1];
              $i++;
            }
          break;

          case "file":
            $a = explode(".", "{$cesta}/{$soub}");
            $prip = $a[count($a) - 1];

            if ($prip == "php" && //filtruje soubory php && skryte
                $soub[0] != "." &&
                $soub != "ajax.php")
            {
              $result[$i] = "{$cesta}/{$soub}";
              $i++;
            }
          break;
        }
      }
    }
    closedir($handle);

    return $result;
  }

/**
 *
 * Vypise vyber modulu
 *
 * @return vypis vyberu
 */
  private function VyberVypisModulu($moduly = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, include, class, admin, databaze, zobrazit, popisek FROM moduly ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
          vybrat: <input type=\"checkbox\" name=\"modul[]\" value=\"{$data->id}\"".(!Empty($_POST["modul"]) && in_array($data->id, $_POST["modul"]) ? " checked=\"checked\"" : (Empty($_POST["modul"]) && !Empty($moduly) && in_array($data->id, $moduly) ? " checked=\"checked\"" : ""))." /><br />
          zobrazit: <input type=\"checkbox\" name=\"zobrazit[]\" value=\"{$data->id}\"".($data->zobrazit && Empty($_POST["zobrazit"]) ? " checked=\"checked\"" : (!Empty($_POST["zobrazit"]) && in_array($data->id, $_POST["zobrazit"]) ? " checked=\"checked\"" : ""))." /><br />
          {$data->nazev}<br />
          {$data->class}<br />
          {$data->databaze}<br />
          admin: <input type=\"checkbox\" disabled=\"disabled\"".($data->admin ? " checked=\"checked\"" : "")." /><br />
          {$data->popisek}<br />
          <br />
          ";
        }
      }
        else
      {
        $result = "žádné položky";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Nacte konfiguraci z daneho souboru
 *
 * @param soubor nazev souboru
 * @return pole hodnot
 */
  private function NactiKonfiguraci($soubor)
  {
    $result = "";
    if (!Empty($soubor) && file_exists($soubor))
    {
      $u = fopen($soubor, "r");
      $result = explode("|--|", fread($u, filesize($soubor)));
      fclose($u);
    }
      else
    {
      $u = fopen($soubor, "w");
      fclose($u);
    }

    return $result;
  }

/**
 *
 * Ulozi konfiguraci do daneho souboru s danymi daty
 *
 * @param soubor nazev souboru
 * @param data data na ulozeni do konfigurace
 */
  private function UlozKonfiguraci($soubor, $data)
  {
    if (!Empty($soubor) && is_array($data))
    {
      $u = fopen($soubor, "w");
      fwrite($u, implode("|--|", $data));
      fclose($u);
    }
  }

/**
 *
 * Vypise moduly v databazi
 *
 * @return vypis modulu
 */
  private function VypisModulu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, include, class, admin, databaze, zobrazit, popisek FROM moduly ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result .= "počet modulů: {$res->numRows()}<br />";
        while ($data = $res->fetchObject())
        {
          $result .=
          "({$data->id}) {$data->nazev}
          <input type=\"checkbox\" disabled=\"disabled\"".($data->admin ? " checked=\"checked\"" : "")." />
          <input type=\"checkbox\" disabled=\"disabled\"".($data->zobrazit ? " checked=\"checked\"" : "")." />
          <a href=\"?{$this->get_kam}={$this->adrmenu[1][0]}&amp;{$this->get_sub}={$this->adrmenu[1][2]}&amp;id={$data->id}\" title=\"\">upravit modul</a>
          <a href=\"?{$this->get_kam}={$this->adrmenu[1][0]}&amp;{$this->get_sub}={$this->adrmenu[1][3]}&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->nazev}\' ?');\">smazat modul</a>
          <br />
          ";
        }
      }
        else
      {
        $result = "žádné položky";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vypise adminy v db
 *
 * @return vypis adminu
 */
  private function VypisAdminu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, jmeno, heslo FROM admini ORDER BY LOWER(jmeno) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result .= "počet adminů: {$res->numRows()}<br />";
        while ($data = $res->fetchObject())
        {
          $result .=
          "({$data->id}) {$data->jmeno}
          <a href=\"?{$this->get_kam}={$this->adrmenu[2][0]}&amp;{$this->get_sub}={$this->adrmenu[2][2]}&amp;id={$data->id}\" title=\"\">upravit admina</a>
          <a href=\"?{$this->get_kam}={$this->adrmenu[2][0]}&amp;{$this->get_sub}={$this->adrmenu[2][3]}&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->jmeno}\' ?');\">smazat admina</a>
          <br />
          ";
        }
      }
        else
      {
        $result = "žádní admini";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vypise IP v db
 *
 * @return vypis ip
 */
  private function VypisIp()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, ip FROM ipblok ORDER BY LOWER(ip) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result .= "počet ip: {$res->numRows()}<br />";
        while ($data = $res->fetchObject())
        {
          $result .=
          "({$data->id}) {$data->ip}
          <a href=\"?{$this->get_kam}={$this->adrmenu[3][0]}&amp;{$this->get_sub}={$this->adrmenu[3][2]}&amp;id={$data->id}\" title=\"\">upravit ip</a>
          <a href=\"?{$this->get_kam}={$this->adrmenu[3][0]}&amp;{$this->get_sub}={$this->adrmenu[3][3]}&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->ip}\' ?');\">smazat ip</a>
          <br />
          ";
        }
      }
        else
      {
        $result = "žádné ip";
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
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
 * Vypis chyby v html
 *
 * @param chyba text chyby
 * @return chyby interpretovana v html kodu
 */
  private function ErrorMsg($chyba)
  {
    $this->chyba =
    "
<div id=\"centralni_chyba\">
  <p>
    Vyskytla se chyba:
  </p>
  <p>
    <strong>{$chyba}</strong>
  </p>
</div>
    ";
  }

/**
 *
 * Meta refresh
 *
 * @param cas doba aktualizace
 * @param cesta cilova cesta presmerovani
 * @return prislusne nastaveny meta tag
 */
  public function AutoClick($cas, $cesta)
  {
    $this->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }

/**
 *
 * Detekce linuxu
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

$web = new PHPWebGen(); //vytvoreni stranek
?>
