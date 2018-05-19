<?php
/*
 * tpl.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * udrzovani instance radku
   *
   * @package stable
   * @author geniv
   * @version 2.14
   */
  class TplMenuRow extends ObjectArray {
    
    private $index = 'url'; // defaultni index
    
    /**
     * nastaveni defaultniho indexu pro __toString
     *
     * @since 2.04
     * @param string index nazev indexu
     * @return this
     */
    public function setIndex($index) {
      $this->index = $index;
      return $this;
    }
    
    /**
     * obsahuje submenu?
     *
     * @since 2.06
     * @param void
     * @return bool true pokud obsahuje submenu
     */
    public function hasMenu() {
      return !is_null($this->menu);
    }
    
    /**
     * nacteni indexu pole
     *
     * @since 2.02
     * @param void
     * @return string text z konkretniho indexu
     */
    public function __toString() {
      return $this[$this->index];
    }
  }


  /**
   * trida zajistujici templatovaci system,
   * Template engine: http://www.raintpl.com/Documentation/
   * -vlastni vylepseni jako: use, date, translate, translate, code...
   *
   * @package unstable
   * @author geniv
   * @version 4.10
   */
  final class Tpl implements ICron {

    const _COMPILE_RESULT = '$__r';

    private $vars = array();
    private $template;
    private $template_name;


    private $menu_dir = null;
    private $menu_layout = null;
    
    private $menu_request = null;
    private $menu_default = '';
    private $menu_default_page = null;
    private $menu_uri = null;
    private $menu_uri_values = null;
    private $menu_userdata = array();
    private $menu_weburl = null;
    

    private static $config = array(
      'debug' => false, // debug vypis
      'charset' => 'UTF-8', // charset pri escapovani textu
      'suffix' => 'tpl', // koncovka template
      'base_dir' => null, // slozka posouvajici vsechny vyuzivajici cesty na jine misto
      'tpl_dir' => 'templates/',  // slozka s template a vlastnima php like template out kody
      'compile_dir' => 'templates/compile/',  // slozka s automaticky vygenerovanymi kody z template
      'auto_escape' => false,  // automaticke escapovani retezcu
      'auto_gen_dir' => false,  // automaticke generovani slozek, pro samotnou instalaci: ->installDirs()
      'black_list' => array(
        'exec', 'shell_exec', 'pcntl_exec', 'passthru', 'proc_open', 'system', 'posix_kill', 'posix_setsid', 'pcntl_fork', 'posix_uname', 'php_uname',
        'phpinfo', 'popen', 'file_get_contents', 'file_put_contents', 'rmdir', 'mkdir', 'unlink', 'highlight_contents', 'symlink', 'apache_child_terminate',
        'apache_setenv', 'define_syslog_variables', 'escapeshellarg', 'escapeshellcmd', 'eval', 'fp', 'fput', 'ftp_connect', 'ftp_exec', 'ftp_get',
        'ftp_login', 'ftp_nb_fput', 'ftp_put', 'ftp_raw', 'ftp_rawlist', 'highlight_file', 'ini_alter', 'ini_get_all', 'ini_restore', 'inject_code',
        'mysql_pconnect', 'openlog', 'passthru', 'php_uname', 'phpAds_remoteInfo', 'phpAds_XmlRpc', 'phpAds_xmlrpcDecode', 'phpAds_xmlrpcEncode',
        'posix_getpwuid', 'posix_kill', 'posix_mkfifo', 'posix_setpgid', 'posix_setsid', 'posix_setuid', 'posix_uname', 'proc_close', 'proc_get_status',
        'proc_nice', 'proc_open', 'proc_terminate', 'syslog', 'xmlrpc_entity_decode'
      ),
      'tags' => array(
                      'loop' => array('({loop.*?})', '/{loop="(?<variable>\${0,1}[^"]*)"(?: as (?<key>\$.*?)(?: => (?<value>\$.*?)){0,1}){0,1}}/'), //ok
                      'loop_close' => array('({\/loop})', '/{\/loop}/'),  //ok
                      'loop_break' => array('({break})', '/{break}/'),  //ok
                      'loop_continue' => array('({continue})', '/{continue}/'), //ok
                      'loop_empty' => array('({emptyloop})', '/{emptyloop}/'), //ok
                      'if' => array('({if.*?})', '/{if="([^"]*)"}/'), //ok
                      'elseif' => array('({elseif.*?})', '/{elseif="([^"]*)"}/'), //ok
                      'else' => array('({else})', '/{else}/'),  //ok
                      'if_close' => array('({\/if})', '/{\/if}/'),  //ok
                      'noparse' => array('({noparse})', '/{noparse}/'), //ok
                      'noparse_close' => array('({\/noparse})', '/{\/noparse}/'), //ok
                      'comment' => array('({\*)', '/{\*/'), //ok
                      'comment_close' => array('(\*})', '/\*}/'), //ok
                      'include' => array('({include.*?})', '/{include="([^"]*)"}/'),  //ok
                      'use' => array('({use.*?})', '/{use="([^"]*)"}/'), //ok
                      'function' => array('({function.*?})', '/{function="([a-zA-Z_][a-zA-Z_0-9\\\:]*)(\(.*\)){0,1}"}/'), //ok
                      'date' => array('({date.*?})', '/{date="(?<format>.*?)",?(?<timestamp>.*?){0,1}}/'), //ok
                      'date_str' => array('({date_str.*?})', '/{date_str="(?<format>.*?)",?(?<timestamp>.*?){0,1}}/'), //ok
                      'variable' => array('({\$.*?})', '/{(\$.*?)}/'),  //ok
                      'constant' => array('({#.*?})', '/{#(.*?)#{0,1}}/'),  //ok
                      'translate' => array('({@.*@})', '/{@(.*)@}/'), //ok
                      'translate_n' => array('({@.*\|.*\|.*@})', '/{@(.*)\|(.*)\|([0-9]+)@}/'), //ok
                      'code' => array('({code})', '/{code}/'),  //ok
                      'code_close' => array('({\/code})', '/{\/code}/'),  //ok
      ),
    );

    /**
     * defaultni konstruktor tridy
     *
     * @since 1.02
     * @param array|null config nepovinny kostruktor nastaveni
     */
    public function __construct(array $config = null) {
      self::setConfigure($config);
    }

    /*
     * zpracoani menu & obsahu
     */
     
    /**
     * nacteni slozky pro menu
     *
     * @since 3.56
     * @param void
     * @return string path ke slozce
     */
    public function getMenuDir() {
      return $this->menu_dir;
    }

    /**
     * nastaveni slozky pro menu
     *
     * @since 3.56
     * @param string dir path ke slozce
     * @return this
     */
    public function setMenuDir($dir) {
      $this->menu_dir = $dir;
      return $this;
    }
    
    /**
     * nacteni requestu
     *
     * @since 3.76
     * @param void
     * @return string text request
     */
    public function getMenuRequest() {
      return $this->menu_request;
    }
    
    /**
     * nastaveni requestu
     *
     * @since 3.76
     * @param string request text request
     * @return this
     */
    public function setMenuRequest($request = null) {
      $this->menu_request = ($request ?: Router::request());
      return $this;
    }
    
    /**
     * nastaveni menu layoutu
     *
     * @since 3.64
     * @param array layout pole vzoru menu
     * @return this
     */
    public function setMenuLayout($layout) {
      $this->menu_layout = $layout;
      return $this;
    }
    
    /**
     * nastaveni konfigurace routeru
     *
     * @since 3.86
     * @param string|array model pole modelu
     * @param string default defaultni 
     * @param int from
     * @return this
     */
    public function setMenuRouter($model, $default = '', $from = 0) {
      $this->menu_uri = Router::uri($model, $default, $this->menu_request, $from);
      $this->menu_uri_values = array_values($this->menu_uri);
      $this->menu_default = $default;
      return $this;
    }
  
    /**
     * nastaveni (spojení) defaultni tpl stranky a defaultni route uri
     *
     * @since 4.08
     * @param string page nazev defaultni tpl stranky
     * @return this
     */
    public function setDefaultPage($page) {
      $this->menu_default_page = $page;
      return $this;
    }
  
    /**
     * nacteni pole z routeru
     *
     * @since 3.88
     * @param void
     * @return array pole routeru
     */
    public function getUri() {
      return $this->menu_uri;
    }
    
    /**
     * nacteni uzivatelskych dat
     *
     * @since 3.90
     * @param void
     * @return array pole uzivatelskych dat
     */
    public function getUserData() {
      return $this->menu_userdata;
    }
    
    /**
     * nastaveni uzivatelskych dat
     *
     * @since 3.90
     * @param array data pole uzivatelskych dat
     * @return this
     */
    public function setUserData($data) {
      if ($data && is_array($data)) {
        $this->menu_userdata += $data;
      }
      return $this;
    }
    
    /**
     * nacitani adresy templatu ktery se ma zobrazovat
     *
     * @since 4.10
     * @param 
     * @return 
     */
    private function __getActiveTemplate($source = null, $index = 0) {
      //TODO jelikoz jde o tento typ.. tak staci aby se cesta overila proti poli a zarovem podle adresarove struktury??
      
      $key = (isset($this->menu_uri_values[$index]) ? $this->menu_uri_values[$index] : null);
      $value = ($source ?: $this->menu_layout);
      
      //FIXME reseni!!!: pokud nebude existovat adresarova struktura bude generovat pomocne pole jako json s odkazy na konkretni indexy nebo rovnou premapuje celou strukturu do jednourovneveho pole adresa=>pole nebo adresa/subadresa=>pole
      //to aby kvuli tomu aby do toho dokazal sahat rovnou i bez znovu a znovu regenerovani, regenerace bude poble rekurzivniho poctu polozek count(, recursive!)
      
      //~ var_dump($value[$key]); //TODO dodelat...
      //TODO prochazet rekurzivne? nebo si udelat seznam adres podle layoutu a z toho vychazet? mno jo ale se aadresuje konkretni adresa kdyz to pole bude na jedne urovni?
    }
    
    /**
     * vnitrni pocitani viditelnych polozek
     *
     * @since 4.02
     * @param array source zdrojove pole
     * @return int pocet viditelnych polozek
     */
    private function __getCount($source) {
      $filter = array_filter($source, function($row) {  //TODO jestli bude potreba vicekrat oddeli se do metody isVisible, pokud jinak oddeli se metody getVisibleMenu 
          return (isset($row['visible']) ? $row['visible'] : true);
      });
      return count($filter);
    }
    
    /**
     * vnitrni metoda pro generovani menu
     *
     * @since 3.68
     * @param array pole vstupni pole
     * @param array __conf predavan konfigurace mezi volenim pri rekurzi
     * @return array pole instanci TplMenuRow
     */
    private function __getMenu($pole, $__conf = array()) {  //, $maxlevel = 0, $lasturl = array()
      
      $result = array();
      
      //~ $this->menu_default
      //~ $this->menu_uri
      
      //FIXME vzor: trida Web, toto musi mi v sobe  tezce upravenou verzi tridy web!!
      //s tim ze musi byt metody na nacitani to HtmlPage a podobynch trida, takze v podstate se drzet metod jako ma trida web!!!! 
      //a timto se stane v podstate nezavislou a trida Web v podstate vypadne ze hry..  :S
      
      $count = $this->__getCount($pole);
      
      $lasturl = $__conf['lasturl'];
      $level = $__conf['level'];
      
      $poc = 0;
      foreach ($pole as $page => $values) {
        
        $visible = (isset($values['visible']) ? $values['visible'] : true);
        $link = (isset($values['link']) ? $values['link'] : null);
        
        $_lasturl = array_merge($lasturl, array($page));
        //~ var_dump($_lasturl);
        //~ var_dump($page);
        
        //~ var_dump($page, $this->menu_default, $this->menu_default_page, '...');
        //$page == $this->menu_default_page
        //~ var_dump($this->menu_uri_values[$level]);
        //($page === $this->menu_default_page)
        //~ var_dump($this->menu_uri_values);
        
        // ? true : ($this->menu_uri_values[$level] == $this->menu_default ? $page === $this->menu_default_page : false)
        //var_dump($this->menu_uri_values[0] == $this->menu_default);
        //TODO OMG vyresit defaultni !!!!
        //~ var_dump($this->menu_uri_values[0], $page, $page === $this->menu_default_page);
        //~ var_dump($this->menu_uri);
      
      //TODO musi taky resit pokd data nastanka neexistuje aby se oznacilo taky defaultni!!!
      //~ var_dump(!isset($this->menu_layout[$this->menu_uri_values[0]]));
      
      //TODO musi dokaz vyhodnotit ze adresa neexistuje v cele urovni nebo jen v aktualni?
      
      //TODO taky se m zadratovam aby tady ta metoda vedela jaka je akualni zobrazovana stranka (vnitrni tpl-url) 
      
        // aktivni podle: adresy || defaultni prazdne polozky || ... //FIXME dodelat podle vzoru na web.php!!!!!
        $active = (isset($this->menu_uri_values[$level]) && ($page === $this->menu_uri_values[$level])) ||
                      //((!isset($this->menu_uri_values[$level])) && ($page === $this->menu_default_page)) ||
                      (($this->menu_uri_values[0] === $this->menu_default) && ($page === $this->menu_default_page)); //FIXME bacha pri prazdne page a   
    

        //FIXME vyresit urgentne rozdil mezi linkem menu a url adresou!!!
        
        //FIXME osefovat max zanoreni!
        
        //FIXME doserit oznacovani aktivity
        
        //TODO doresit maximalni pocty
        
        //~ var_dump($this->menu_weburl);
        //TODO nastaveni defaultni adresy: pro defaultni uri bude ktery defaultni tpl???
        
        //TODO dodelat oznacovani aktualnich...!
        //~ var_dump($this->menu_default);
        //~ var_dump(implode('/', $_lasturl));
        $data = array(
          'url' => $page,
          'lasturl' => $_lasturl,
          'allurl' => ($link ?: $this->menu_weburl . implode('/', $_lasturl)),  // kdy je link tak ho pouzije, jinak spoji url a lasturl
          'name' => $values['name'],
          'level' => $level,
          'maxlevel' => $__conf['maxlevel'],
          'active' => $active,
          'visible' => $visible,
          'link' => $link,
          //~ 'menu' => null,
          'poc' => $poc,
          'count' => $count,
        );
        
        $data = array_merge($data, $values, $this->menu_userdata);
        
        //~ print_r($data);
        
        if ($visible) {
          
          if (isset($values['menu'])) {
            $__conf['level']++;
            // konvert menu layoutu na menu tridy Row
            $__conf['lasturl'] = array($page);
            $data['menu'] = $this->__getMenu($values['menu'], $__conf);
            $__conf['level']--;
          } 
          
          $result[] = new TplMenuRow($data);
        
          $poc++;
        }
        
      }
      
      return $result;
    }
    
    //TODO meotdu na nastavovani URL, defaultne si stahne tu z Core, predavani do kazdeho radku, prepis indexem [url|link]
    
    /**
     * nacteni web url
     *
     * @since 3.92
     * @param void
     * @return string text url adresy
     */
    public function getWebUrl() {
      return $this->menu_weburl;
    }
    
    /**
     * nastaveni web url
     *
     * @since 3.92
     * @param string url test url adresy
     * @return this
     */
    public function setWebUrl($url) {
      $this->menu_weburl = $url;
      return $this;
    }
    
    //TODO metoda getMenu(maxlevel) by mela byt dostupna z radku, + pridat metody do radku isSubmenu() atd...!
    
    /**
     * nacteni vygenerovaneho menu
     *
     * @since 3.60
     * @param int maxlevel maximalni level vykreslovaciho zanoreni do ktereho se ma maximalne vykreslovat/generovat
     * @return array pole instanci
     */
    public function getMenu($maxlevel = -1) {
      //generovani menu
      
      //TODO aplikace levelu
      $this->__getActiveTemplate();
      
      //TODO promyslet jeste jednou jestli se bude uzivat vykraslovani od levelu? nebo do levelu? i kdyz od levelu je picovina!
      //pac nema cenu to tak resitk kdyz se pozadavky na vykreslovani radavaji rucne a je potreba omezit jak hluboko vykreslovat! --> takze MXA je spravne!
  
  //TODO auto-rekurzivne to byt nemuze! musi se jeste zadat nejake pole ktere urci u kazde polozky: 
  //:: cely nazev (ktery prislusi ke konkretnimu tpl-nazvu), js, css, viditelnost[, *pridavky], a cela struktura hlavne urci poradi!
  
  //pokud by mely byt nejake pridavky tak jedine resieni asi jako nadglovblani pristup?! .. test jako globalni nastaveni title...
  
  // vystup musi byt jako pole objektu aby se to dalo opet na urovni hlavniho tpl pouzit v loopu
  
  //co se tyce budovani menu: tak to bude delat tak ze se udela kontrakt a podle neho se konkterni souboty (*.tpl) vygeneruji!!!
  
  //odkazy menu se budou generovat automaticky (podle vzoru → pole), s tim ze se budou dat prepsat!!! u polozek kde bude uvedeny link se soubor generovat nesmi!!!!
  
  //indexy: name, js, css, visible, link, menu

      return $this->__getMenu($this->menu_layout, array('level' => 0, 'maxlevel' => $maxlevel, 'lasturl' => array()));
  
  
      //~ print_r($this->menu_layout);
      
      
      
      
  
      //~ $list = Core::getLi
      //~ $dir = self::$config['tpl_dir'] . $this->menu_dir;
      //~ var_dump($dir);
    
      //~ $it = new \DirectoryIterator($dir);
      //~ foreach ($it as $item) {
        //~ if (!$item->isDot()) {
          //~ var_dump($item);
        //~ }
        //~ 
      //~ }
      
    }
    
    /**
     * nacitani vygenerovaneho obsahu
     *
     * @since 3.60
     * @param void?
     * @return void?
     */
    public function getContent() {
      //generovani obsahu
    }
    
    /*
     * samotne tpl
     */

    /**
     * nacteni konfigurace
     *
     * @since 2.00
     * @param string key klic pro hodnotu
     * @return string hodnota z klice
     */
    public static function getConfigure($key) {
      return self::$config[$key];
    }

    /**
     * nastaveni noveho nastaveni
     *
     * @since 2.00
     * @param string|array key klic pro hodnotu nebo pole key-value hodnot
     * @param string value hodnota pro klic
     * @return this
     */
    public static function setConfigure($key, $value = null) {
      if ($key) { // pokud neni key null
        if (is_array($key) && is_null($value)) {
          foreach ($key as $k => $v) {  //nastaveni dat v cyklu
            self::setConfigure($k, $v);
          }
        } else {
          self::$config[$key] = $value; //nastaveni jednotlivych dat
        }
      }

      if (self::$config['base_dir']) {
        $base = self::$config['base_dir'];
        self::$config['tpl_dir'] = $base . self::$config['tpl_dir'];
        self::$config['compile_dir'] = $base . self::$config['compile_dir'];
        self::$config['base_dir'] = ''; // musi se provest jen 1x!
      }
    }

    /**
     * pridelovani promennych do template
     *
     * @since 2.00
     * @param string|array variable nazev promenne nebo asociativni pole promennych
     * @param mixed|null value hodnota pro promennou (jen kdyz je variable zadany jako string)
     * @return this
     */
    public function assign($variable, $value = null) {
      if (is_array($variable)) {
        $this->vars += $variable;
      } else {
        $this->vars[$variable] = $value;
      }
      return $this;
    }

    /**
     * smaze veskerou cache zkompilovanych templatu
     *
     * @since 2.00
     * @param bool rmdir zapina uplny uklid vcetne slozky
     * @return this
     */
    public function clearAll($rmdir = false) {
      if (file_exists(self::$config['compile_dir'])) {
        $path = self::$config['compile_dir'];
        $list = Core::getListFile(array('path' => $path));
        if ($list) {
          foreach ($list as $item) {
            @unlink($path . $item);
          }
        }
      }

      if ($rmdir) { // mazani slozky kompilace
        rmdir(self::$config['compile_dir']);
      }
      return $this;
    }

    /**
     * generovani template mapy pro ukladani
     *
     * @since 2.00
     * @param string path cesta souboru pro zpracovani
     */
    private function generateMap($path) {
      $sep = explode('.', basename($path, '.php'));
      list($name, $hash) = $sep;
      $old = $this->clear($name);  //smazani stareho cache souboru
      $data = array($name => $hash); //stare se musi dat na konec
      if (is_array($old)) { // pokud je old pole
        $data += $old;  // preicte se do pole a prepisou se hodnoty
      }
      file_put_contents(self::$config['compile_dir'].'.map', json_encode($data));
    }

    /**
     * mazani konkterniho cache souboru dle nazvu template
     *
     * @since 2.00
     * @param string name jmeno template
     * @return array pole dat z mapy
     */
    public function clear($name) {
      $result = array();
      $map = self::$config['compile_dir'].'.map';
      if (file_exists($map)) {
        $result = json_decode(file_get_contents($map), true);
        if (isset($result[$name])) {  //pokud exituje index
          $path = self::$config['compile_dir'].$name.'.'.$result[$name].'.php';
          if (file_exists($path)) {
            @unlink($path);
          }
        }
      }
      return $result;
    }

    /**
     * synchronizace pro Cron-a
     *
     * @since 3.40
     * @param void
     * @return int pocet smazanych prebytku
     */
    public static function synchronizeCron($args = null) {
      $result = 0;
      $map = self::$config['compile_dir'].'.map';
      if (file_exists($map)) {
        $data_map = json_decode(file_get_contents($map), true);
        $data_map_out = array();
        array_walk($data_map, function($value, $key) use (&$data_map_out) {
          $data_map_out[] = $key . '.' . $value . '.php';
        });
        $compile_dir = self::$config['compile_dir'];
        $file_system = Core::getListFile(array(
            'path' => $compile_dir,
            'filter-' => array('map')
        ));

        $diff = array_diff($file_system, $data_map_out);  // rozdil musi zustat ty ktere prebyvaji ve file_systemu
        $result = count($diff);
        array_map(function($row) use ($compile_dir) { // projiti prebytku
          @unlink($compile_dir . $row); // a jejich smazani
        }, $diff);
      }
      return $result;
    }

    /**
     * kontrola zda parsrovana promenna je v blacklistu
     *
     * @since 2.00
     * @param string var promenna testovani
     * @retrun void
     */
    private function inBlackList($var) {
      if (in_array($var, self::$config['black_list'])) {
        die('This value '.$var.' is in Blacklist!');
      }
    }

    /**
     * samotna kompilace tempalte na php kod
     *
     * @param void
     * @return string zkompiloany kod
     */
    private function compileTemplate() {
      //cteni/zpracovani/vygenerovani/

      $cmrs = self::_COMPILE_RESULT;

      $result = '<?php '.$cmrs." = <<<T\n";

      $split_callback = function($r) {
        return $r[0];
      };
      $split = implode('|', array_map($split_callback, self::$config['tags']));

      $tag_callback = function($r) {
        return $r[1];
      };
      $tagMatch = array_map($tag_callback, self::$config['tags']);
  //~ print_r($tagMatch);

      $codeSplit = preg_split("/" . $split . "/", $this->template, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
  //~ var_dump($codeSplit);

      if ($codeSplit) {

        $openIf = $loopLevel = 0;
        $noparseIsOpen = $commentIsOpen = null;

        foreach ($codeSplit as $html) {

          // zpracovani konce komentaru
          if (preg_match($tagMatch['comment_close'], $html)) {
            $commentIsOpen = false;
          } else

          // ignorace textu komentare
          if ($commentIsOpen) {
            //~ var_dump($html);
          } else

          // zprackovani zacatku komentaru
          if (preg_match($tagMatch['comment'], $html)) {
            $commentIsOpen = true;
          } else

          // zpracovani konce noparse
          if (preg_match($tagMatch['noparse_close'], $html)) {
            $noparseIsOpen = false;
          } else

          // jednoduche preneseni textu noparse
          if ($noparseIsOpen) {
            $result .= $html; // vlozeni
          } else

          // zpracovani konce noparse
          if (preg_match($tagMatch['noparse'], $html)) {
            $noparseIsOpen = true;
          } else

          // zpracovani php kodu
          if (preg_match($tagMatch['code'], $html)) {
            $result .= "\nT;\n";
          } else
          // zpracovani konce php kodu
          if (preg_match($tagMatch['code_close'], $html)) {
            $result .= "\n".$cmrs." .= <<<T\n";
          } else

          // zpracovani include
          if (preg_match($tagMatch['include'], $html, $matches)) {

            $actual = self::$config['tpl_dir'] . $this->replaceVar($matches[1], false, false).'.'.self::$config['suffix'];
            $include = preg_replace('/\w+\/\.\.\//', '', $actual);  //include path

            if (file_exists($include)) {
              $__tpl = new self;
              $__tpl->assign($this->vars) //prenos promennych
                    ->template($this->replaceVar($matches[1], false, false)); //prenos nazvu

              $result .= $__tpl->render();  // vlozeni
            } else {
              $result .= '**<strong>'.basename($include).'</strong> nelze najit**';
            }

          } else

          // zpracovani zacatku cyklu
          if (preg_match($tagMatch['loop'], $html, $match)) {
            $loopLevel++;

            $var = $this->replaceModifier($this->replaceVar($match['variable'], false, false));

            $counter = '$counter'.$loopLevel; //pocitadlo
            $_array = '$__array'.$loopLevel;

            $key = '$key';
            $value = '$value';

            if (isset($match['key']) && isset($match['value'])) {
              $key = $match['key'];
              $value = $match['value'];
            } else
            if (isset($match['key'])) {
              $value = $match['key'];
            }

            //~ $var instanceof \Countable
            // promenna co jde do foreach, nesmi byt \Countable

            // rozdeleni
            $result .= "\nT;\n  ".$counter.' =- 1; '.$_array.' = '.$var.'; if (isset('.$_array.') && (is_array('.$_array.') || '.$_array.' instanceof \Traversable) && count('.$_array.')) foreach ('.$_array.' as '.$key.' => '.$value.') { '.$counter.'++; '.$cmrs." .= <<<T\n";
          } else

          // zpracovani konce cyklu
          if (preg_match($tagMatch['loop_close'], $html, $match)) {
            $loopLevel--;

            $result .= "\nT;\n  } ".$cmrs." .= <<<T\n"; // rozdeleni
          } else

          // zpracovani break;
          if (preg_match($tagMatch['loop_break'], $html)) {
            $result .= "\nT;\n  break; ".$cmrs." .= <<<T\n";  // rozdeleni
          } else

          // zpracovani continue
          if (preg_match($tagMatch['loop_continue'], $html)) {
            $result .= "\nT;\n  continue; ".$cmrs." .= <<<T\n"; // rozdeleni
          } else
          
          // zpracovani loop empty
          if (preg_match($tagMatch['loop_empty'], $html)) {
            $result .= "\nT;\n  } if (\$counter".$loopLevel." == -1) { ".$cmrs." .= <<<T\n";  // rozdeleni
          } else
          
          // zpracovani podminky if
          if (preg_match($tagMatch['if'], $html, $matches)) {
            $openIf++;

            $this->inBlackList($matches[1]);

            $condition = $this->replaceVar($matches[1], false, false);
            $result .= "\nT;\n  if (".$condition.') { '.$cmrs." .= <<<T\n"; // rozdeleni
          } else

          // zpracovani else if podminky
          if (preg_match($tagMatch['elseif'], $html, $matches)) {
            $this->inBlackList($matches[1]);

            $condition = $this->replaceVar($matches[1], false, false);
            $result .= "\nT;\n  } else if (".$condition.') { '.$cmrs." .= <<<T\n";  // rozdeleni
          } else

          // zpracovani else podminky
          if (preg_match($tagMatch['else'], $html)) {
            $result .= "\nT;\n  } else { ".$cmrs." .= <<<T\n";  // rozdeleni
          } else

          // zpracovani konce podminky
          if (preg_match($tagMatch['if_close'], $html)) {
            $openIf--;
            $result .= "\nT;\n  } ".$cmrs." .= <<<T\n"; // rozdeleni
          } else

          // zpracovani use
          if (preg_match($tagMatch['use'], $html, $matches)) {
            $result .= "\nT;\n  use ".$matches[1].'; '.$cmrs." .= <<<T\n";  // rozdeleni
          } else

          // zpracovani funkci
          if (preg_match($tagMatch['function'], $html, $matches)) {

            $function = $matches[1];

            $this->inBlackList($matches[1]);

            if (isset($matches[2])) {
              $param = $matches[2];
            } else {
              $param = '()';
            }

            //~ $result .= "\nT;\n".$cmrs.' .= ('.($function.$param).") . <<<T\n";  // vlozeni
            $result .= "\nT\n. (".($function.$param).") . <<<T\n";  // vlozeni
          } else

          // zpracovani datumu
          if (preg_match($tagMatch['date'], $html, $matches)) {
            $format = $matches['format']; //nacteni formatu
            $timestamp = $this->replaceVar($matches['timestamp']); // nacteni razitka
            //~ $result .= "\nT;\n".$cmrs.' .= (date("'.($format ?: 'Y-m-d H:i:s').'"'.($timestamp ? ','.$timestamp : '').")) . <<<T\n";  // vlozeni
            $result .= "\nT\n. (date(\"".($format ?: 'Y-m-d H:i:s').'"'.($timestamp ? ','.$timestamp : '').")) . <<<T\n";  // vlozeni
          } else

          // zpracovani stringoveho datumu, prevede si vstupni datum rovnou pres strtotime
          if (preg_match($tagMatch['date_str'], $html, $matches)) {
            $format = $matches['format']; //nacteni formatu
            $timestamp = $this->replaceVar($matches['timestamp']); // nacteni casoveho razitra
            //~ $result .= "\nT;\n".$cmrs.' .= (date("'.($format ?: 'Y-m-d H:i:s').'"'.($timestamp ? ',strtotime('.($timestamp).')' : '').")) . <<<T\n";  // vlozeni
            $result .= "\nT\n. (date(\"".($format ?: 'Y-m-d H:i:s').'"'.($timestamp ? ',strtotime('.($timestamp).')' : '').")) . <<<T\n";  // vlozeni
          } else

          // zpracovani promennych
          if (preg_match($tagMatch['variable'], $html, $match)) {
            $result .= $this->replaceVar($match[1], true, true);
          } else

          // zpracovani konstant
          if (preg_match($tagMatch['constant'], $html, $matches)) {
              $result .= $this->replaceConstant($matches[1]);
          } else

          // zpracovani pocitacich prekladu
          if (preg_match($tagMatch['translate_n'], $html, $match)) {
            $result .= $this->replacePluralTranslate($match[1], $match[2], $match[3]);
          } else

          // zpracovani obycejnych prekladu
          if (preg_match($tagMatch['translate'], $html, $match)) {
            $result .= $this->replaceTranslate($match[1]);
          } else

          { // vkladani zbyleho textu
            $result .= $html;
          }
        }

        if ($openIf > 0) {
          throw new ExceptionTpl('neukoncena podminka IF');
        }

        if ($loopLevel > 0) {
          throw new ExceptionTpl('neukonceny cyklis LOOP');
        }

      }

      $result .= "\nT;\nreturn ".$cmrs.';';

      return $result;
    }

    /**
     * kompilacni zpracovani promennych
     * -pokud neprojde jako $ promenna pokusi se alespon o modifikaci funkci
     *
     * @since 2.00
     * @param string html vstupni html kod
     * @param bool escape true pro zapinani htmlspecialchars
     * @param bool output true pro obalovani do ''
     * @return string osetrena html promenna
     */
    private function replaceVar($html, $escape = true, $output = false) {
      $cmrs = self::_COMPILE_RESULT;

      if (preg_match_all('/(\$[a-z_A-Z][^\s]*)/', $html, $matches)) {

        for ($i = 0; $i < count($matches[1]); $i++) { //zasazeni kontextu pole
          $rep = preg_replace('/\[(\${0,1}[a-zA-Z_0-9]*)\]/', '["$1"]', $matches[1][$i]);
          $rep = preg_replace('/\.(\${0,1}[a-zA-Z_0-9]*)/', '["$1"]', $rep);
          $html = str_replace($matches[0][$i], $rep, $html);
        }

        //modifikatory
        $html = $this->replaceModifier($html);

        if (!preg_match('/\$.*=.*/', $html)) {
          //escapoani znaku
          if (self::$config['auto_escape'] && $escape)  { //escape sekcevce
            $html = 'htmlspecialchars($html, ENT_COMPAT, \''.self::$config['charset'].'\'. false)';
          }

          if ($output) {  //prime vkladani promenne
            //~ $html = "\nT;\n".$cmrs.' .= ('.$html.") . <<<T\n";  // vlozeni
            $html = "\nT\n. (".$html.") . <<<T\n";  // vlozeni
          }
        } else {
          if ($output) {  //nejaky vypocet
            $html = "\nT;\n  (".$html.'); '.$cmrs." .= <<<T\n"; // rozdeleni
          }
        }
      } else {
        $html = $this->replaceModifier($html);
      }

      return $html;
    }

    /**
     * kompilacni zpracovani modifikatoru | funkci
     *
     * @since 2.00
     * @param string html html kod pro zpracovani
     * @return string zpracovany html kod
     */
    private function replaceModifier($html) {
      if ($pos = strrpos($html, "|")) {

        $this->inBlackList($html);

        $explode = explode(":", substr($html, $pos + 1));
        $function = $explode[0];
        $params = (isset($explode[1]) ? "," . $explode[1] : null);

        $html = $function . "(" . $this->replaceModifier(substr($html, 0, $pos)) . "$params)";
      }
      return $html;
    }

    /**
     * kompilacni zpracovani konstant
     *
     * @since 2.00
     * @param string html html na zpracovani
     * @return string zpracovany html
     */
    private function replaceConstant($html) {
      $cmrs = self::_COMPILE_RESULT;
      $html = $this->replaceModifier($html);
      //~ return "\nT;\n".$cmrs.' .= ('.$html.") . <<<T\n"; // vlozeni
      return "\nT\n. (".$html.") . <<<T\n"; // vlozeni
    }

    /**
     * kompilacni zprazovani jednoduchych prekladu
     *
     * @since 2.00
     * @param string html text prekladu na prelozeni
     * @return string zpracovany html
     */
    private function replaceTranslate($message) {
      $cmrs = self::_COMPILE_RESULT;
      //~ return "\nT;\n".$cmrs.' .= gettext("'.$message."\") . <<<T\n";  // vlozeni
      return "\nT\n. gettext(\"".$message."\") . <<<T\n";  // vlozeni
    }

    /**
     * kompilacni zpracovani puralnich prekladu
     *
     * @since 2.00
     * @param string singular jednotne cislo
     * @param string plural mnozne cislo
     * @param int count pocet
     * @return string zpracovany html
     */
    private function replacePluralTranslate($singular, $plural, $count) {
      $cmrs = self::_COMPILE_RESULT;
      //~ return "\nT;\n".$cmrs.' .= ngettext("'.$singular.'", "'.$plural.'", '.$count.") . <<<T\n";  // vlozeni
      return "\nT\n. ngettext(\"".$singular.'", "'.$plural.'", '.$count.") . <<<T\n";  // vlozeni
    }

    /**
     * kontrola a instalace adresaru potrebnych pro template
     *
     * @since 2.00
     * @param void
     * @return this
     */
    public function installDirs() {
      if (self::$config['auto_gen_dir']) {
        // template dir
        if (!file_exists(self::$config['tpl_dir'])) {
          if (!is_writable(dirname(self::$config['tpl_dir']))) {
            die('nemam dost prav na zapis na slozku "'.self::$config['tpl_dir'].'"');
          }

          if (!@mkdir(self::$config['tpl_dir'])) {
            die('nepodarilo se vytvorit "'.self::$config['tpl_dir'].'"');
          }
        }

        // compile dir
        if (!file_exists(self::$config['compile_dir'])) {
          if (!is_writable(dirname(self::$config['compile_dir']))) {
            die('nemam dost prav na zapis na slozku "'.self::$config['compile_dir'].'"');
          }

          if (!@mkdir(self::$config['compile_dir'])) {
            die('nepodarilo se vytvorit "'.self::$config['compile_dir'].'"');
          }
        }
      }
      return $this;
    }

    /**
     * vkladani jmena template sablony pro zkompilovani v pozdejdim volani render()
     *
     * @since 2.00
     * @param string name nazev nebo spis path cesta konkretni template sablony pro kompilaci
     * @return this
     */
    public function template($name) {
      if (!file_exists(self::$config['tpl_dir'])) {
        if (!@mkdir(self::$config['tpl_dir'])) {
          die('nelze vytvorit dir strukturu pro path "'.self::$config['tpl_dir'].'"');
        }
      }
      // utvoreni jmena predaneho z parametru
      $path = self::$config['tpl_dir'].$name.'.'.self::$config['suffix'];

      // utvoreni souborove struktury pokud neexituje
      $dir = dirname($path);
      if (!file_exists($dir)) {
        if (!@mkdir($dir, 0777, true)) {
          die('nelze vytvorit dir strukturu pro path "'.$dir.'"');
        }
      }

      // pokud template neexistuje vygeneruje jednoduchy example soubor
      if (!file_exists($path)) {
        $text = 'example template...';
        if (!@file_put_contents($path, $text)) {
          die('neexistuje soubor "'.$path.'" s templatem');
        }
      }

      // ulozeni jmena a nacteni konkretniho pathe, dalsi krok je render()!
      $this->template = file_get_contents($path);
      $this->template_name = $name;

      return $this;
    }

    /**
     * renderovani vystupu
     *
     * @since 2.00
     * @param string|null compile_path cesta pro prime vykonani uz zkompilovaneho soubouru (musi byt s returnem)
     * @return string html vykonaneho zkompilovaneho php skriptu
     */
    public function render($compile_path = null) {
      $result = '';

      // pokud je predan radoby zkompilovanej php soubor
      if (!empty($compile_path)) {
        $path = self::$config['tpl_dir'].$compile_path; // template musi vracet data pres return!

        if (!file_exists($path)) {
          die('neexistuje kompilace: '.$path);
        }
      } else {
        // slozeni jmena pro hash
        $name = self::$config['tpl_dir'] . $this->template_name . '.' . self::$config['suffix'];
        // hash puvodniho template
        $hash = md5_file($name);  // detekuje zmeny tpl
        // slozeny link z hashu a nazvu templatu pro ulozeni kompilace
        //~ $path = self::$config['compile_dir'].$this->template_name.'.'.$hash.'.php';
        $path = self::$config['compile_dir'].str_replace('/', '__', $this->template_name).'.'.$hash.'.php';
      }

      // pokud path neexistuje bude se ho pokouset zkompilovat
      if (!file_exists($path) || self::$config['debug']) {  
        // kompiluje jen tehdy pokud je neco na zkompilovani
        if (!empty($this->template)) {
//TODO mit moznost do renderu predavat paramtrem nejen string path na ulozeni souboru ale i string template, protoze se tu vyslovene pocita ze to proleze instanci, on to tpl muze generovat i staticky!
          $compile = $this->compileTemplate();  // kompilace

          if (!file_exists(self::$config['compile_dir'])) { //pokud neexistuje slozka pro kompilace
            if (!mkdir(self::$config['compile_dir'])) {
              die('nelze vytvorit slozka "'.self::$config['compile_dir'].'" pro vysledek kompilace');
            }
          }

          $this->generateMap($path);  // update .map-y souboru

          file_put_contents($path, $compile); // ulozeni zkompilovaneho souboru
        }
      }

      // pokud uz zkompilovany soubor existuje, dopni promenne a vlozi
      if (file_exists($path)) { 
        $this->vars['template_info'] = print_r($this->vars, true);  //preddefinovana promenna
        extract($this->vars); //vlozeni promennych do php z pole
        $result = require $path;
      }

      return $result;
    }

    /**
     * magicka metoda pro render templatu
     *
     * @since 1.00
     * @param void
     * @return string vygenerovane html
     */
    public function __toString() {
      return $this->render();
    }
  }


  /**
   * trida vyjimky pro Tpl
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionTpl extends \Exception {}