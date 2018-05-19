<?php
/*
 *      index.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  /**
   * Autoload classes
   *
   * @param name string
   */
  function __autoload($name) {
    try {

      $file = strtolower($name);
      $cesta = "{$file}.php";
      //overovani existence cesty
      if (file_exists($cesta)) {
        include_once $cesta;
        //require_once $cesta;
      } else {
        throw new ExceptionAutoload($cesta);
      }

    } catch (ExceptionAutoload $e) {
      echo sprintf("Třída <strong>%s</strong> neexistuje!", $e->getMessage());
    }
  }

  class ExceptionAutoload extends Exception {}


  //vzor singleton
  final class Database {
    protected static $instance = NULL;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
      if (self::$instance == NULL) {
        $c = __CLASS__;
        self::$instance = new $c;
      }
      return self::$instance;
    }

    //
  }

  class ExceptionDatabase extends Exception {}


  //vzor singleton
  final class Unique {
    protected static $instance = NULL;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
      if (self::$instance == NULL) {
        $c = __CLASS__;
        self::$instance = new $c;
      }
      return self::$instance;
    }
//TODO pridat i nacitaci metodu z textu, aby bylo nejen ze sozboru ale i textu!
    public static function __callStatic($name, $args) {
      try {

        $result = NULL;
        if ($name == 'i') { //TODO pripadne pres switch na volani method
          if (self::$instance != NULL) {
            $result = self::$instance;
          } else { throw new ExceptionUnique; }
        }

      } catch (ExceptionUnique $e) {
        echo 'Nejprve je potreba zavolat: Unique::getInstance()->loadUnique(__FILE__);';
        exit(1);
      }

      return $result;
    }

    const UNIQUE_NAME = 'unique';
    const DUPLIC_NAME = 'duplicate';

    public function loadUnique($path) {
      try {

        $dir = dirname($path);
        $name = basename($path, ".php");
        //unikatni
        $uniq_path = "{$dir}/{$name}_".self::UNIQUE_NAME.'.php';
        if (file_exists($uniq_path)) {
          self::$instance->unique = include_once $uniq_path;
        } else {
          throw new ExceptionUnique($uniq_path);
        }
        //duplikatni
        $duplic_path = "{$dir}/{$name}_".self::DUPLIC_NAME.'.php';
        if (file_exists($duplic_path)) {
          self::$instance->unique = include_once $duplic_path;
        }

      } catch (ExceptionUnique $e) {
        echo sprintf('Cesta %s neexistuje!', $e->getMessage());
      }
    }

    public function getUniq($key, array $array, $znak = "%%") {
      try {

        $result = NULL;
        if (!empty(self::$instance->unique)) {
          if (array_key_exists($key, self::$instance->unique)) {
            $vstup = self::$instance->unique[$key];
          } else {
            throw new ExceptionUnique($key, 1);
          }
        } else {
          throw new ExceptionUnique('', 0);
        }

        //separace klicu z array
        $klice = array_keys($array);
        //uprava klicu
        $search = preg_replace("/\w+/", "{$znak}$0{$znak}", $klice);
        //separace hodnot z array
        $replace = array_values($array);
        //nahrazeni vstupu naraz
        $result = str_replace($search, $replace, $vstup);

      } catch (ExceptionUnique $e) {
        switch ($e->getCode()) {
          case 0:
            echo 'Unikatni nebyli doposud nacteny!';
          break;

          case 1:
            echo 'Klic "'.$e->getMessage().'" nebyl nalezen!';
          break;
        }
      }

      return $result;
    }
  }

  class ExceptionUnique extends Exception {}

////////////////////////////////////////////////////////////////////////////////
  class MenuMaster {
    //globalni metory pro praci v instanci objektu????????
  }
////////////////////////////////////////////////////////////////////////////////
  final class Filesystem {
    const READ = 'r';
    const WRITE = 'w';
    const APPEND = 'a';

    protected $handler = NULL;

    public function __construct($name, $mode) {
      //FIXME muze nastat: spatne zadane parametry
      $this->handler->name = $name;
      $this->handler->mode = $mode;
      $this->handler->autoclose = true;

      //TODO moznost volit autoopen?!
      //a nebo volat jen tehdy kdyz jsou vsechny parametry zadane regularne
      $this->open();

      return $this;
    }

    public function setName($name) {
      $this->handler->name = $name;
      return $this;
    }

    public function setMode($mode) {
      $this->handler->mode = $mode;
      return $this;
    }

    public function setAutoClose($stav) {
      $this->handler->autoclose = $stav;
      return $this;
    }

    public function open() {
      try {

        if (!$this->handler->pointer = @fopen($this->handler->name, $this->handler->mode)) {
          throw new ExceptionFilesystem;
        }

      } catch (ExceptionFilesystem $e) {
        echo 'nezadarilo se otevrit soubor!';
      }

      return $this;
    }

    public function read() {
      //FIXME muze nastat: prazdny soubor!
      $result = fread($this->handler->pointer, filesize($this->handler->name));

      if ($this->handler->autoclose) {
        $this->close();
      }

      return $result;
    }

    public function write($data) {
      //FIXME muze nastat: nelze zapisovat..
      fwrite($this->handler->pointer, $data);

      if ($this->handler->autoclose) {
        $this->close();
      }
    }

    public function close() {
      //FIXME muze nastat: nelze zavrit?!
      fclose($this->handler->pointer);
    }

    //TODO dodelat osetreni chyb a necekanych stavu
  }

  class ExceptionFilesystem extends Exception {}

//TODO tridu MainPage ktera se bude starat o veci na hlavni NE-admin srankach pro uzivatele

//TODO tridu Email s fluent interface

////////////////////////////////////////////////////////////////////////////////

  if (Core::checkPHP()) {
    Core::startTime();
    Core::initSession();

    //nacitani jazykove mutace
    $lang = array('cs' => 'cs_CZ',
                  'en' => 'en_EN',  //default
                  );
    Language::getInstance()->loadListLanguage($lang);
    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->loadGettext();

    Unique::getInstance()->loadUnique(__FILE__);

    //login forms
    $login = new Login();
    $loginform = $login->LoginForm();
    $logoutform = $login->LogoutForm();
    $loginerrors = $login->getErrors();

    $data_settings = MenuSettings::getXmlData();
    $title_galery = Core::isFill($data_settings, 'title');
    $description = Core::isFill($data_settings, 'description');
    $robots = Core::isFill($data_settings, 'robots');

    $absolutni_url = Core::getAbsoluteUrl();

//TODO vymyslet styl na meneni tematu => skripty, style, obrazky, kostra; co nove tema to nove unikatni defakto...?!!

//var_dump(error_get_last());
//TODO pujde do informaci na uvodni stranku adminu...
//var_dump(Core::calculateSize(memory_get_peak_usage(true)));
//var_dump(Core::calculateSize(memory_get_usage(true)));

    if ($login->isLogin()) {
      $admin = new Administration();
      $title = $admin->getAdminTitle();
      $menu = $admin->getAdminMenu();
      $admin_content = $admin->getAdminContent();

      echo Unique::i()->getUniq('main_admin_index',
                                array('title_galery' => $title_galery,
                                      'description' => $description,
                                      'title' => $title,
                                      'absolutni_url' => $absolutni_url,
                                      'jazyk' => '',
                                      'admin_menu' => $menu,
                                      'admin_content' => $admin_content,
                                      'logout_form' => $logoutform,
                                      'end_time' => Core::stopTime(),
                                      )
                                );
    } else {
      //TODO tady na hlavni strance vypsovat jen ty z uloziste tj, ty ulozene!
      echo Unique::i()->getUniq('main_index',
                                array('title_galery' => $title_galery,
                                      'description' => $description,
                                      'robots' => ($robots ? 'index, follow' : 'noindex, nofollow'),
                                      'title' => "title... vybrana galerie",
                                      'absolutni_url' => $absolutni_url,
                                      //'jazyk' => $languageform,
                                      'jazyk' => '',
                                      'menu' => "menu...",
                                      'obsah' => "obsah...",
                                      'login_form' => $loginform,
                                      'login_exception' => $loginerrors,
                                      'end_time' => Core::stopTime(),
                                      )
                                );
    }

  }

//tridu pro oop pristupy do xml pres simplexml
/**
 * drag & drop - razeni
 * do xml nastaveni a komentare k fotkam
 */

//dedit zakladni ovladaci prvky... z tablemastru
//class db_admin {}
//class db_cron {}
//...





/*
class AutoGalery3 extends Konfig
{
  //hlavni konstruktor
  public function __construct()
  {
    $this->absolutni_url = $this->AbsolutniUrl();

    $vyber = (!Empty($_GET["galerie"]) ? $_GET["galerie"] : "Přehled obrázků");
    $slozky = $this->VypisAdresaru($this->koren, array("name", "asc"));
    if (is_array($slozky))
    {
      $row = array();
      foreach ($slozky as $slozka)
      {
        if ($vyber == $slozka)
        {
          $row[] = "<p><span>{$slozka}</span></p>";
        }
          else
        {
          $row[] = "<p><a href=\"?galerie={$slozka}\" title=\"{$slozka}\">{$slozka}</a></p>";
        }
      }

      $menu = implode("", $row);
    }
      else
    {
      $menu = "";
    }

    $obsah = "";
    $cesta = "{$this->koren}/{$vyber}";
    if (!Empty($vyber) &&
        file_exists($cesta))
    {
      $this->ControlCreateDir(array(array($this->koren, $vyber, $this->minidir),
                                    ));

      $obrazky = $this->VypisSouboru($cesta, array("name", "asc"), array("png"));
      if (is_array($obrazky))
      {
        $max = 16 * 1024 * 1024;
        $files = array();
        $row = array();
        foreach ($obrazky as $obrazek)
        {
          $minicesta = "{$cesta}/{$this->minidir}/{$obrazek}";
          if (!file_exists($minicesta))
          {
            $files["tmp_name"]["obr"] = "{$cesta}/{$obrazek}";
            $files["type"]["obr"] = "image/png";
            $files["size"]["obr"] = filesize("{$cesta}/{$obrazek}");
            $files["out"]["obr"] = $minicesta;
            $this->SavePicture($files, "obr", $max, array("{$cesta}/{$this->minidir}" => $this->size));
          }

          $nazev = basename($obrazek, ".png");

          $row[] = "<div class=\"obal_vypis highslide-gallery\"><p class=\"obrazek\"><a href=\"{$cesta}/{$obrazek}\" title=\"{$nazev}\" class=\"highslide\" onclick=\"return hs.expand(this, config1 )\" style=\"background-image: url('{$cesta}/{$this->minidir}/{$obrazek}');\"><!-- --><span class=\"popis\">{$nazev}</span></a></p></div>";
        }

        $obsah = implode("", $row);
      }
        else
      {
        $minicesta = "{$cesta}/{$this->minidir}";
        $obrazky = $this->VypisSouboru($minicesta, array("name", "asc"));
        if (is_array($obrazky))
        {
          $row = array();
          foreach ($obrazky as $obrazek)
          {
            $nazev = basename($obrazek, ".png");

            $row[] = "<div class=\"obal_vypis highslide-gallery\"><p class=\"obrazek\"><a href=\"{$cesta}/{$obrazek}\" title=\"{$nazev}\" class=\"highslide\" onclick=\"return hs.expand(this, config1 )\" style=\"background-image: url('{$cesta}/{$this->minidir}/{$obrazek}');\"><!-- --><span class=\"popis\">{$nazev}</span></a></p></div>";
          }
        }

        $obsah = implode("", $row);
      }
    }

    $result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GoodFlow design\" />
    <meta name=\"description\" content=\"GoodFlow galerie #2\" />
    <meta name=\"robots\" content=\"index, follow\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" title=\"\" />
    <!--[if IE]>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_ie.css\" media=\"screen\" />
    <![endif]-->
    <title>GoodFlow galerie #2 - {$vyber} - Název galerie</title>
    <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
    <script type=\"text/javascript\" src=\"highslide/highslide-with-gallery.js\"></script>
    <script type=\"text/javascript\" src=\"highslide/highslide.config.js\" charset=\"utf-8\"></script>
  </head>
  <body>
    <div id=\"obal_layout\">
      <div id=\"obal_sekce\">
        <h1><a href=\"{$this->absolutni_url}\">Název galerie</a></h1>
        <div id=\"obal\">
          <div id=\"menu\">
            {$menu}
          </div>
          <div id=\"vypis\">
            {$obsah}
          </div>
        </div>
      </div>
    </div>
  </body>
</html>";

    echo $result;

  }
}

new AutoGalery3();
*/

?>
