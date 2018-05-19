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
   * Template engine: http://www.raintpl.com/Documentation/
   * -vlastni vylepseni jako: use, date, translate, translate, code...
   *
   * cmd:
   * sudo chmod -v 0777 templates/*.tpl
   *
   * @package stable
   * @author geniv
   * @version 4.20
   */
  final class Tpl implements ICron {

    const _COMPILE_RESULT = '$__r';

    private $vars = array();
    private $template;
    private $template_name;

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

      $split = implode('|', array_map(function($r) {
            return $r[0];
          }, self::$config['tags']));

      $tagMatch = array_map(function($r) {
            return $r[1];
          }, self::$config['tags']);

      // rosekani predane sablony do pole pro kmpilaci
      $codeSplit = preg_split("/" . $split . "/", $this->template, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

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

            $actual = self::$config['tpl_dir'] . $this->replaceVar($matches[1], false, false) . '.' . self::$config['suffix'];
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
        $path = self::$config['compile_dir'] . str_replace('/', '__', $this->template_name) . '.' . $hash . '.php';
      }

      // pokud path neexistuje bude se ho pokouset zkompilovat
      if (!file_exists($path) || self::$config['debug']) {
        // kompiluje jen tehdy pokud je neco na zkompilovani
        if (!empty($this->template)) {
          // obsah pro kompilci se predava uvnitr instance
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
        $this->vars['template_info'] = print_r($this->vars, true);  // preddefinovana promenna
        extract($this->vars); // vlozeni promennych do php z pole
        $result = require($path);
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