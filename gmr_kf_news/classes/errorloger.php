<?php
/*
 * errorloger.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * trida pro logovani a posilani error chyb spravcum systemu
   * -error hunting :)
   *
   * @package stable
   * @author geniv
   * @version 2.40
   */
  abstract class ErrorLoger implements ICron {
    private static $path = null;  // cesta
    private static $email = null; // email
    private static $emailer = null; // pole nastaveni emaileru
    private static $errorPage = null; // content error page, jen pro stdout
    private static $errorMsg = null;  // text error hlasky
    private static $printStdOut = true; // vypis na stdout, defaultne zapnuto
    private static $instantlySend = true; // okamzite odesilani, defaultne zapnuto
    private static $enabled = false; // stav zapnuti, defaultne vypnuto

    // predefinovatelne konstanty
    /** jmeno konfigu */
    const DEFAULT_CONFIG_NAME = '.ErrorLoger_config';
    /** days, ponechat a pak expirovat */
    const DEFAULT_EXPIRE = 7;
    /** maximalni pocet zaloh */
    const DEFAULT_COUNT = 10;

    // systemove konstanty
    /** format datumu souboru */
    const DEFAULT_DATE_FORMAT = 'Y-m-d';
     /** format nazvu souboru */
    const DEFAULT_FILE_FORMAT = 'errorlog_%s.log';

    // pole chybovych hlasek
    private static $errorCode = array(
      1 => 'E_ERROR',
      2 => 'E_WARNING',
      4 => 'E_PARSE',
      8 => 'E_NOTICE',
      16 => 'E_CORE_ERROR',
      32 => 'E_CORE_WARNING',
      64 => 'E_COMPILE_ERROR',
      128 => 'E_COMPILE_WARNING',
      256 => 'E_USER_ERROR',
      512 => 'E_USER_WARNING',
      1024 => 'E_USER_NOTICE',
      2048 => 'E_STRICT',
      4096 => 'E_RECOVERABLE_ERROR',
      8192 => 'E_DEPRECATED',
      16384 => 'E_USER_DEPRECATED',
      32767 => 'E_ALL',
    );

    //dalsi: muze pak byt (ale asi nebude, pokud se budou projekty drzet proti gitu) dalsi trida nebo cast admina ktera bude bude obsahovat online editor
    // pomoci toho editoru ktery tam bude k dispozici bude moznot danou chybu vyladit (pokud se teda nebude nalazet chyba v core tridach)
    //-->> zavisi to na tom aby admin obsahoval moduly adminu ktere se tam proste jednoduse vlozi a nebude se resit apliace nekterych admin casti

    /**
     * aktivace logeru
     * -mody: logovat / logovat a posilat / posilat / jen zobrazovat
     * -cron: logy aktualniho dne a predesleho dne (pokud teda nejake jsou)
     * -pri cronu: zasilat jen kdyz je path, nastaveny path a email adresa
     *
     * @since 1.04
     * @param string path  cesta na slozku pro log soubory
     * @param string|Emailer email cilova adresa pro posilani error logu
     * @return void
     */
    public static function enable($path = null, $email = null) {
      self::$path = $path;  // cesta na logovani
      self::$email = $email;  // nastaveni emailu
      // prvotni inicializace
      self::initCallback();
    }

    /**
     * nacteni stavu logeru
     *
     * @since 2.08
     * @return bool true pokud je zapnuto
     */
    public static function isEnabled() {
      return self::$enabled;
    }

    /**
     * nacteni path cesty na slozku pro error logy
     *
     * @since 2.10
     * @return string patch cesta do adresare
     */
    public static function getPath() {
      return self::$path;
    }

    /**
     * nacteni email adresy pro posilani error reportu
     *
     * @since 2.10
     * @return string emailova adresa
     */
    public static function getEmail() {
      return self::$email;
    }

    /**
     * inicializace callbacku, prekryti implicitnich handleru
     *
     * @since 1.64
     * @return void
     */
    private static function initCallback() {
      self::$enabled = true;
      register_shutdown_function(array(__CLASS__, '_shutdownHandler')); // pri destrukci
      set_exception_handler(array(__CLASS__, '_exceptionHandler')); // pri exception
      set_error_handler(array(__CLASS__, '_errorHandler')); // pri php chybe
    }

    /**
     * nacitani konfigurace
     *
     * @since 1.60
     * @param string path cesta a jmeno konfiguraku
     * @return void
     */
    public static function load($path = null) {
      $decode = json_decode(file_get_contents($path ?: self::DEFAULT_CONFIG_NAME), true);
      self::$path = $decode['path'];  // nastaveni promennych zpet
      self::$emailer = $decode['emailer'];
      $email = $decode['email'];
      // pokud je nastaveny emailer tak automaticky bude unsearializovat, jinak nacte jen email
      self::$email = ($decode['emailer'] ? unserialize($email) : $email);
      self::$printStdOut = $decode['printStdOut'];
      self::$instantlySend = $decode['instantlySend'];
      // po nacteni znovu inicializuje
      self::initCallback();
    }

    /**
     * ukladani konfigurace
     *
     * @since 1.60
     * @param string path cesta a jmeno konfiguraku
     * @return int pocet zapsanych bytes
     */
    public static function save($path = null) {
      $encode = array(
          'path' => self::$path,  // ulozeni promennych
          'email' => (is_object(self::$email) ? serialize(self::$email) : self::$email),
          'emailer' => self::$emailer,
          'printStdOut' => self::$printStdOut,
          'instantlySend' => self::$instantlySend,
      );
      return file_put_contents($path ?: self::DEFAULT_CONFIG_NAME, json_encode($encode));
    }

    /**
     * nastaveni error page, format vystupu pro stdout
     * -promenne: {$date}, {$type}, {$message}, {$file}, {$line}, {$other}
     *
     * @since 1.26
     * @param string page obsah stranky s pripravenyma promennyma pro vystup chyby
     * @return void
     */
    public static function setErrorPage($page) {
      self::$errorPage = $page;
    }

    /**
     * nacteni nastaveni emaileru
     *
     * @since 2.22
     * @return array nastaveni emaileru
     */
    public static function getEmailer() {
      return self::$emailer;
    }

    /**
     * nastaveni nazvu metod emaileru
     *
     * @since 1.84
     * @param string msg nazev instancni metody pro nastaveni zpravy emailu
     * @param string send nazev instancni metody pro odeslani emailu
     * @return void
     */
    public static function setEmailer($msg = 'setMessage', $send = 'send') {
      self::$emailer = array('message' => $msg, 'send' => $send);
    }

    /**
     * nastaveni stavu vypisu
     *
     * @since 2.20
     * @param bool state true pro vypis na stdout, defaultne true
     * @return void
     */
    public static function setPrintStdOut($state) {
      self::$printStdOut = $state;
    }

    /**
     * nastaveni stavu odesilani (kdyz je nastaveny path a email)
     * -true: posila automaticky pri chybe (defaultne)
     * -false: posila jen s cronem (musi byt jeste zadany path)
     *
     * @since 2.30
     * @param bool state true pro okamzite odesilani, false pro posilani s cronem
     * @return void
     */
    public static function setInstantlySend($state) {
      self::$instantlySend = $state;
    }

    /**
     * nacteni error hlasky
     *
     * @since 2.14
     * @return string text error hlasky
     */
    public static function getMessage() {
      return self::$errorMsg;
    }

    /**
     * zpracovani chybove hlasky, jednotna metoda pro sjednocovani chybovych stavu
     *
     * @since 1.40
     * @param int|string code kod nebo typ chyby
     * @param string message text chyby
     * @param string file soubor kde se chyba nachazi
     * @param int line cislo radku ze ktere byla chyba vyvolana
     * @param null|array other nepovinny parametr dalsich udaju prevzatych od chyby
     * @return void
     */
    private static function processError($code, $message, $file, $line, $other = null) {
      // zpracovani kodu chyby
      $_code = (is_numeric($code) ? self::$errorCode[$code] : $code);
      // vytvoreni defaultniho formatu chyby
      $_message = date('Y-m-d H:i:s') . ' [' . $_code . '] [' . Core::getIp() . '] ' . $message . ' in ' . $file . ' on line ' . $line . PHP_EOL;

      if (self::$errorPage) {
        self::$errorMsg = str_replace(
            array('{$date}', '{$type}', '{$message}', '{$file}', '{$line}', '{$other}'),
            array(date('Y-m-d H:i:s'), $_code, $message, $file, $line, $other),
            self::$errorPage);
      } else {
        self::$errorMsg = $_message;  // defaultni zprava
      }

      // pokud je umozneno vypisuje defaultne na stdout
      if (self::$printStdOut) {
        echo self::$errorMsg;
      }

      // pokud je zadana cesta, ulozi do logu
      if (self::$path) {
        // vytvoreni slozky logu
        if (!file_exists(self::$path)) {
          Core::generatePath(self::$path);
        }
        // zapis do logu
        $file = self::$path . sprintf(self::DEFAULT_FILE_FORMAT, date(self::DEFAULT_DATE_FORMAT));
        file_put_contents($file, $_message, FILE_APPEND | LOCK_EX); // pridavat na konec a zamykat pri zapisu
      }

      // pokud je zadany email && je aktivni okamzite posilani tak posle emailem
      if (self::$email && self::$instantlySend) {
        if (self::$email instanceof Emailer) {
          // pokud jde o emailera
          $msg = self::$emailer['message']; // nacteni nazvu metod
          $snd = self::$emailer['send'];
          // nastaveni metod
          self::$email->$msg($_message);  // nastaveni zpravy
          self::$email->$snd(); // odeslani zpravy
        } else {
          // pokud jdeo klasicky email
          mail(self::$email, 'Report error log', $_message);
        }
      }
    }

    /**
     * handler volany pri destrukci pred GC
     * -pro chyby odchytava obsah funkce: error_get_last()
     *
     * @since 1.04
     * @return void
     */
    public static function _shutdownHandler() {
      $error = error_get_last();
      if ($error) { //detekce chyby
        // type obsahuje kod pro pole: errorCode
        self::processError($error['type'], $error['message'], $error['file'], $error['line']);
      }
    }

    /**
     * handler volany pri exceptionu
     *
     * @since 1.04
     * @param Exception exception vyvolany exception
     * @return void
     */
    public static function _exceptionHandler($exception) {
      self::processError(get_class($exception).' ('.$exception->getCode().')',
          $exception->getMessage(), $exception->getFile(),
          $exception->getLine(), print_r($exception->getTrace(), true));
    }

    /**
     * pridani logovani pro vyuziti v try - catch
     * vklada se do catch: ::logTryCatchException($e)
     *
     * @since 1.80
     * @param Exception exception vyvolany exception
     * @return void
     */
    public static function logTryCatchException($exception) {
      self::_exceptionHandler($exception);
    }

    /**
     * handler volany pri chybe
     *
     * @since 1.04
     * @param int errno cislo chyby
     * @param string errstr text chyby
     * @param string errfile soubor kde je chyba
     * @param int errline cislo radku kde je chyba
     * @param array errcontext kontext prostredi
     * @return void
     */
    public static function _errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
      // errno obsahuje kod pro pole: errorCode
      self::processError($errno, $errstr, $errfile, $errline, print_r($errcontext, true));
    }

    /**
     * metoda pro synchronizaci cronem
     * -odesilani reportu s pripardnyma chybama
     * -odesila jen tehdy kdyz je nastaveny: path error logu && email && instantlySend=false (vypnute okamzite odesilani)
     *
     * @since 1.14
     * @param array (jinak pole konfigurace predavana z kofigurace cronu)
     * @return int pocet zpracovanych polozek
     */
    public static function synchronizeCron($args = array()) {
      $conf = array(
          'path' => null, // path konfiguracniho souboru
          'clean_expire' => self::DEFAULT_EXPIRE, // expirovat po
          'clean_count' => self::DEFAULT_COUNT, // maximalni pocet
      );
      $conf = array_merge($conf, $args);  // secteni konfigurace

      if (file_exists($conf['path'])) {
        self::load($conf['path']);
      }

      // pokud je zadany path && email && je vypnute okamzite odesilani emailu!!!
      if (self::$path && self::$email && !self::$instantlySend) {
        //~ var_dump(self::$email);
        $minus = strtotime('-1 day');
        $yesterday = date(self::DEFAULT_DATE_FORMAT, $minus);
        $today = date(self::DEFAULT_DATE_FORMAT);

        $f1 = self::$path . sprintf(self::DEFAULT_FILE_FORMAT, $yesterday); // soubor pro vcerejsek
        $f2 = self::$path . sprintf(self::DEFAULT_FILE_FORMAT, $today); // soubor pro dnesek

        $message = PHP_EOL . 'read file: '. $f1 . ', time: ' . date('Y-m-d H:i:s', $minus) . PHP_EOL;
        // pokud existuje log ze vcerejska
        if (file_exists($f1)) {
          $message .= file_get_contents($f1) . PHP_EOL;
        } else {
          $message .= '-- does not exists --' . PHP_EOL;
        }

        $message .= PHP_EOL . 'read file: '. $f1 . ', time: ' . date('Y-m-d H:i:s') . PHP_EOL;

        // pokud existuje log z dneska
        if (file_exists($f2)) {
          $message .= file_get_contents($f2) . PHP_EOL;
        } else {
          $message .= '-- does not exists --' . PHP_EOL;
        }

        // odeslani klasickeho emailu
        mail(self::$email, 'Cron report error log', $message);
      }

      $poc = 0;
      // pokud je zadany path
      if (self::$path) {
        $list = Core::getListFile(array(
          'path' => self::$path,  // path logu
          'full' => true,
          'filter+' => array('log'),
          'sort' => array(Core::LIST_SORT_MTIME, Core::LIST_SORT_DESC),
        ));

        // mazani na expiraci souboru
        $poc = Core::cleanExpire($list, $conf['clean_expire'] . ' day');
        // mazani na pocet souboru
        $poc += Core::cleanCount($list, $conf['clean_count']);
      }

      return $poc;
    }
  }