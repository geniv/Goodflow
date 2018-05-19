<?php
/*
 * tpl.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * trida zajistujici templatovaci system,
   * - Template engine source (raintpl v3): http://www.raintpl.com/Documentation/
   * - moznosti: loop (break + continue), if (else + elseif), noparse, comment, include, use, function, date, date_str, variable, constant, translate, translate_n, code
   * - pro automaticke generovani slozek, a souboru zapnout: auto_create; zbytek se musi vytvaret rucne
   * - pro vynuceni kompilace pri kazdem volani zapnout: force_compile
   *
   * - cmd pro upravu slozky: $ sudo chmod -v 0777 templates
   *
   * @package stable
   * @author geniv
   * @version 4.50
   */
  final class Tpl implements ICron {

    const _COMPILE_RESULT = '$__r';

    private $vars = array();
    private $template_name = null;

    private static $config = array(
      'force_compile' => false, // vynutit rucne rekompilaci
      'auto_create' => false,   // zapinani auto vytvareni souboru
      'charset' => 'UTF-8', // charset pri escapovani textu
      'suffix' => 'tpl', // koncovka template
      'base_dir' => null, // slozka posouvajici vsechny vyuzivajici cesty na jine misto
      'tpl_dir' => 'templates/',  // slozka s template a vlastnima php like template out kody
      'compile_dir' => 'templates/compile/',  // slozka s automaticky vygenerovanymi kody z template
      'auto_escape' => false,  // automaticke escapovani retezcu
      //~ 'auto_gen_dir' => false,  // automaticke generovani slozek, pro samotnou instalaci: ->installDirs()
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
                      'loop' => array('({loop.*?})', '/{loop="(?<variable>\${0,1}[^"]*)"(?: as (?<key>\$.*?)(?: => (?<value>\$.*?)){0,1}){0,1}}/'), //ok, smycka
                      'loop_close' => array('({\/loop})', '/{\/loop}/'),  //ok
                      'loop_break' => array('({break})', '/{break}/'),  //ok
                      'loop_continue' => array('({continue})', '/{continue}/'), //ok
                      'loop_empty' => array('({emptyloop})', '/{emptyloop}/'), //ok
                      'if' => array('({if.*?})', '/{if="([^"]*)"}/'), //ok. podminka
                      'elseif' => array('({elseif.*?})', '/{elseif="([^"]*)"}/'), //ok
                      'else' => array('({else})', '/{else}/'),  //ok
                      'if_close' => array('({\/if})', '/{\/if}/'),  //ok
                      'noparse' => array('({noparse})', '/{noparse}/'), //ok, neprsrovat
                      'noparse_close' => array('({\/noparse})', '/{\/noparse}/'), //ok
                      'comment' => array('({\*)', '/{\*/'), //ok, komentar
                      'comment_close' => array('(\*})', '/\*}/'), //ok
                      'include' => array('({include.*?})', '/{include="([^"]*)"}/'),  //ok, vkladani dalsiho tpl
                      'compile' => array('({compile.*?})', '/{compile="([^"]*)"}/'),  //ok, vkladani kodu na kompilaci
                      'function' => array('({function.*?})', '/{function="([a-zA-Z_][a-zA-Z_0-9\\\:]*)(\(.*\)){0,1}"}/'), //ok, vkladani funkce
                      'date' => array('({date.*?})', '/{date="(?<format>.*?)",?(?<timestamp>.*?){0,1}}/'), //ok, vkladani data
                      'date_str' => array('({date_str.*?})', '/{date_str="(?<format>.*?)",?(?<timestamp>.*?){0,1}}/'), //ok, vkladani textoveho data
                      'variable' => array('({\$.*?})', '/{(\$.*?)}/'),  //ok, promenne
                      'constant' => array('({#.*?})', '/{#(.*?)#{0,1}}/'),  //ok, konstanty
                      'translate' => array('({@.*?@})', '/{@(.*)@}/'), //ok, staticky preklad
                      'translate_n' => array('({@.*\|.*\|.*@})', '/{@(.*)\|(.*)\|([0-9]+)@}/'), //ok, stativcky pocitatelny obsah
                      'code' => array('({code})', '/{code}/'),  //ok, php kod
                      'code_close' => array('({\/code})', '/{\/code}/'),  //ok
      ),
    );

    /**
     * defaultni konstruktor tridy
     *
     * @since 1.02
     * @param array|null config nepovinny kostruktor nastaveni
     */
    public function __construct($config = null) {
      self::setConfigure($config);
    }

    /**
     * tovarni metod na kratky zapis
     *
     * @since 4.26
     * @param string name jmeno template
     * @param array config pole konfigurace
     * @return Tpl instance template
     */
    public static function draw($name, $config = null) {
      $tpl = new self($config);
      return $tpl->template($name);
    }

    /**
     * kompilace vlozeneho tpl kodu
     * - obsah cachuje do temp souboru
     * - je schopno kompilovat i rekurzivne sam do sebe, do 1.urovne (vlozenym kodem)
     *
     * @since 4.46
     * @param string tplcode tpl kod na zkompilovani
     * @param array|null assign promenne pro dosazeni
     * @return string zkompilovany a provedeny kod
     */
    public static function compile($tplcode, $assign = null) {
      $tpl = new self;  // konfigurace neni potreba
      $temp_file = tempnam('/tmp', 'tpl-'); // vytvoreni temp cesty
      file_put_contents($temp_file, $tpl->compileTemplate($tplcode));  // obchazeni renderu, zapis do tempu
      if ($assign) {  // dosazeni promennych, pokud nejake jsou
        extract($assign);
      }
      return require($temp_file); // vlozeni obsahu, vycteni z tempu
    }

    /**
     * sestavovani nazvu cesty pro template
     *
     * @since 4.40
     * @param string name nazev tpl souboru (bez koncovky a bez pathu)
     * @return string sestavena cesta
     */
    public function buildPath($name) {
      return self::$config['tpl_dir'] . $name . '.' . self::$config['suffix'];
    }

    /**
     * zistuje zadana promenna/promenne
     *
     * @since 4.42
     * @param string|array pole nebo text promennych
     * @return bool true pokud promenna nebo promenne existuji
     */
    public function isVariables($input) {
      if (is_array($input)) {
        foreach ($input as $v) {
          if (!array_key_exists($v, $this->vars)) {
            return false;
          }
        }
        return true;
      } else {
        return array_key_exists($input, $this->vars);
      }
    }

    /**
     * nacteni konfigurace
     *
     * @since 2.00
     * @param string key klic pro hodnotu
     * @return string hodnota z klice
     */
    public static function getConfigure($key) {
      if (!isset(self::$config[$key])) {
        throw new ExceptionTpl('This key: '.$key.' does not exist!');
      }

      return self::$config[$key];
    }

    /**
     * nastaveni noveho nastaveni
     *
     * @since 2.00
     * @param string|array key klic pro hodnotu nebo pole key-value hodnot
     * @param string|null value hodnota pro klic
     * @return this
     */
    public static function setConfigure($key, $value = null) {
      if ($key) { // pokud neni key null
        if (is_array($key) && !$value) {
          foreach ($key as $k => $v) {  //nastaveni dat v cyklu
            self::setConfigure($k, $v);
          }
        } else {
          if (!isset(self::$config[$key])) {
            throw new ExceptionTpl('This key: '.$key.' does not exist!');
          }

          self::$config[$key] = $value; //nastaveni jednotlivych dat
        }
      }

      if (self::$config['base_dir']) {
        $base = self::$config['base_dir'];
        self::$config['tpl_dir'] = $base . self::$config['tpl_dir'];
        self::$config['compile_dir'] = $base . self::$config['compile_dir'];
        self::$config['base_dir'] = null; // musi se provest jen 1x!
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
        throw new ExceptionTpl('This value '.$var.' is in Blacklist!');
      }
    }

    /**
     * samotna kompilace tempalte na php kod
     *
     * @param string template vstupni text na kompilaci
     * @return string zkompiloany kod
     */
    private function compileTemplate($template) {
      //cteni/zpracovani/vygenerovani/
      $cmrs = self::_COMPILE_RESULT;
      $result = '<?php try { '.$cmrs." = <<<T\n";

      $split = implode('|', array_map(function($r) {
            return $r[0];
          }, self::$config['tags']));

      $tagMatch = array_map(function($r) {
            return $r[1];
          }, self::$config['tags']);

      // rosekani predane sablony do pole pro kmpilaci
      $codeSplit = preg_split("/" . $split . "/", $template, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

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
          if (preg_match($tagMatch['include'], $html, $matches)) {  // z TPL neumi I/O predavani promennych
            $_path = $this->replaceVar($matches[1], false, false);

            if (preg_match('/.*\$.*/', $_path)) {
              // pokud se vklada promenna nebo funkce (neosetruje neexistenci souboru!!!)
              $result .= "\nT\n. self::draw($_path)->assign(compact('".implode("', '", array_keys($this->vars))."')) . <<<T\n";
            } else {
              // pokud se vklada normalni cesta
              $include = self::$config['tpl_dir'] . $_path . '.' . self::$config['suffix'];
              //~ $include = preg_replace('/\w+\/\.\.\//', '', $act);  //include path

              if (file_exists($include)) {  // pokud path exituje
                $result .= self::draw($_path)->assign($this->vars)->render();
              } else {
                $result .= '**<strong>'.$_path.'</strong> nelze najit**';
              }
            }
          } else

          // zpracovani compile
          if (preg_match($tagMatch['compile'], $html, $matches)) {  // z TPL neumi I/O predavani promennych
            //~ $result .= self::compile($matches[1], $this->vars);
            $result .= "\nT\n. self::compile(".$matches[1].", compact('".implode("', '", array_keys($this->vars))."')) . <<<T\n";
          } else

          // zpracovani zacatku cyklu
          if (preg_match($tagMatch['loop'], $html, $match)) {
            $loopLevel++;

            $var = $this->replaceModifier($this->replaceVar($match['variable'], false, false));

            $counter = '$counter'.$loopLevel; //pocitadlo
            $_array = '$__array'.$loopLevel;

            $key = '$key';
            $value = '$value';

            // dosazni chybejicich atributu
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
            $result .= "\nT;\n  ".$counter.' =- 1; ' . $_array . ' = '.$var.'; if (isset(' . $_array . ') && (is_array(' . $_array . ') || ' . $_array . ' instanceof \Traversable) && count(' . $_array . ')) foreach (' . $_array . ' as ' . $key . ' => ' . $value . ') { ' . $counter . '++; ' . $cmrs . " .= <<<T\n";
          } else

          // zpracovani konce cyklu
          if (preg_match($tagMatch['loop_close'], $html, $match)) {
            $loopLevel--;

            $result .= "\nT;\n  } " . $cmrs ." .= <<<T\n"; // rozdeleni
          } else

          // zpracovani break;
          if (preg_match($tagMatch['loop_break'], $html)) {
            $result .= "\nT;\n  break; " . $cmrs . " .= <<<T\n";  // rozdeleni
          } else

          // zpracovani continue
          if (preg_match($tagMatch['loop_continue'], $html)) {
            $result .= "\nT;\n  continue; " . $cmrs . " .= <<<T\n"; // rozdeleni
          } else

          // zpracovani loop empty
          if (preg_match($tagMatch['loop_empty'], $html)) {
            $result .= "\nT;\n  } if (\$counter" . $loopLevel . " == -1) { " . $cmrs . " .= <<<T\n";  // rozdeleni
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
            $result .= "\nT\n. (" . ($function.$param) . ") . <<<T\n";  // vlozeni
          } else

          // zpracovani datumu
          if (preg_match($tagMatch['date'], $html, $matches)) {
            $format = $matches['format']; //nacteni formatu
            $timestamp = $this->replaceVar($matches['timestamp']); // nacteni razitka
            //~ $result .= "\nT;\n".$cmrs.' .= (date("'.($format ?: 'Y-m-d H:i:s').'"'.($timestamp ? ','.$timestamp : '').")) . <<<T\n";  // vlozeni
            $result .= "\nT\n. (date(\"" . ($format ?: 'Y-m-d H:i:s') . '"' . ($timestamp ? ',' . $timestamp : '') . ")) . <<<T\n";  // vlozeni
          } else

          // zpracovani stringoveho datumu, prevede si vstupni datum rovnou pres strtotime
          if (preg_match($tagMatch['date_str'], $html, $matches)) {
            $format = $matches['format']; //nacteni formatu
            $timestamp = $this->replaceVar($matches['timestamp']); // nacteni casoveho razitra
            //~ $result .= "\nT;\n".$cmrs.' .= (date("'.($format ?: 'Y-m-d H:i:s').'"'.($timestamp ? ',strtotime('.($timestamp).')' : '').")) . <<<T\n";  // vlozeni
            $result .= "\nT\n. (date(\"" . ($format ?: 'Y-m-d H:i:s') . '"' . ($timestamp ? ',strtotime(' . ($timestamp) . ')' : '').")) . <<<T\n";  // vlozeni
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
          if (preg_match($tagMatch['translate_n'], $html, $match)) {  // pouze staticke preklady
            $result .= $this->replacePluralTranslate($match[1], $match[2], $match[3]);
          } else

          // zpracovani obycejnych prekladu
          if (preg_match($tagMatch['translate'], $html, $match)) {  // pouze staticke preklady
            $result .= $this->replaceTranslate($match[1]);
          } else

          { // vkladani zbyleho textu
            $result .= $html;
          }
        }

        if ($openIf > 0) {
          throw new ExceptionTpl('neukoncena podminka IF!');
        }

        if ($loopLevel > 0) {
          throw new ExceptionTpl('neukonceny cyklis LOOP!');
        }

      }

      $result .= "\nT;\nreturn ".$cmrs.'; } catch (\Exception $e) { die($e); }';

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
          $rep = preg_replace('/\[(\${0,1}[a-zA-Z_0-9]*)\]/', '[\'$1\']', $matches[1][$i]);
          $array_in = array(
              '/\.(\$[a-zA-Z_0-9]*)/',
              '/\.(\${0,1}[a-zA-Z_0-9]*)/',
          );
          $array_out = array(
              '[$1]',
              '[\'$1\']',
          );
          $rep = preg_replace($array_in, $array_out, $rep);
          $html = str_replace($matches[0][$i], $rep, $html);
        }

        //modifikatory
        $html = $this->replaceModifier($html);

        if (!preg_match('/\$.*=.*/', $html)) {
          //escapoani znaku
          if (self::$config['auto_escape'] && $escape)  { //escape sekcevce
            $html = 'htmlspecialchars($html, ENT_COMPAT, \'' . self::$config['charset'] . '\'. false)';
          }

          if ($output) {  //prime vkladani promenne
            $html = "\nT\n. (" . $html . ") . <<<T\n";  // vlozeni
          }
        } else {
          if ($output) {  //nejaky vypocet
            if (preg_match('/.*\?.*\:.*/', $html)) {  // ? : - detekce a vlozeni ternaru
              $html = "\nT\n. (" . $html . ") . <<<T\n";  // vlozeni
            } else {
              $html = "\nT;\n  (" . $html . '); '.$cmrs." .= <<<T\n"; // rozdeleni
            }
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
     * vkladani jmena template sablony pro zkompilovani v pozdejdim volani render()
     *
     * @since 2.00
     * @param string name nazev nebo spis path cesta konkretni template sablony pro kompilaci
     * @return this
     */
    public function template($name) {
      // vytvareni hlavni slozky
      if (!file_exists(self::$config['tpl_dir'])) {
        if (!@mkdir(self::$config['tpl_dir'])) {
          throw new ExceptionTpl('nelze vytvorit dir strukturu pro path "' . self::$config['tpl_dir'] . '"');
        }
      }
      // utvoreni jmena predaneho z parametru
      $path = self::$config['tpl_dir'] . $name . '.' . self::$config['suffix'];

      // pokud template neexistuje vygeneruje jednoduchy example soubor
      if (self::$config['auto_create'] && !file_exists($path)) {
        $text = 'example template, fill it...';
        if (!@file_put_contents($path, $text)) {  // vytvoreni tpl pokud neexistuje
          throw new ExceptionTpl('neexistuje soubor "' . $path . '" s templatem');
        }

        if (!@chmod($path, 0777)) { // nastaveni prav pro ostatni
          throw new ExceptionTpl('nelze nastavit prava na template "'.$path.'"');
        }
      }

      // ulozeni jmeno konkretniho pathe, pro render()!
      $this->template_name = $name;

      return $this;
    }

    /**
     * renderovani vystupu
     *
     * @since 2.00
     * @param void
     * @return string html vykonaneho zkompilovaneho php skriptu
     */
    public function render() {
      $result = '';
      $template = null;
      $_compile_path = null;

      // slozeni jmena pro hash
      $name = self::$config['tpl_dir'] . $this->template_name . '.' . self::$config['suffix'];

      if (file_exists($name)) {
        // hash puvodniho template
        $hash = md5_file($name);  // detekuje zmeny tpl
        // slozeny link z hashu a nazvu templatu pro ulozeni kompilace
        $_compile_path = self::$config['compile_dir'] . str_replace('/', '__', $this->template_name) . '.' . $hash . '.php';
      }

      // pokud path kompilace neexistuje bude se ho pokouset zkompilovat
      if (!file_exists($_compile_path) || self::$config['force_compile']) {

        // kompiluje jen tehdy pokud je neco na zkompilovani
        if (file_exists($name)) {
          // obsah pro kompilci se predava parametrem
          $compile = $this->compileTemplate(file_get_contents($name));  // kompilace

          //pokud neexistuje slozka pro vysledek kompilace
          if (!file_exists(self::$config['compile_dir'])) {
            if (!mkdir(self::$config['compile_dir'])) {
              throw new ExceptionTpl('nelze vytvorit slozka "'.self::$config['compile_dir'].'" pro vysledek kompilace');
            }
          }

          // update .map-y souboru
          $this->generateMap($_compile_path);
          // ulozeni vysledneho zkompilovaneho souboru
          file_put_contents($_compile_path, $compile);
        }
      }

      // pokud uz zkompilovany soubor existuje, dopni promenne a vlozi
      if (file_exists($_compile_path)) {
        $this->vars['template_info'] = print_r($this->vars, true);  // preddefinovana promenna
        extract($this->vars); // vlozeni promennych do php z pole
        $result = require($_compile_path);
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