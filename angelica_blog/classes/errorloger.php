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
   * - error hunting
   * - vyuziva: Session
   * - umi posilat s: Emailer
   *
   * @package stable
   * @author geniv
   * @version 2.62
   */
  abstract class ErrorLoger implements ICron {
    private static $path = null;  // cesta
    private static $email = null; // email
    private static $errorPage = null; // content error page, jen pro stdout
    private static $errorMsg = null;  // text error hlasky
    private static $printStdOut = true; // vypis na stdout, defaultne zapnuto
    private static $instantlySend = true; // okamzite odesilani, defaultne zapnuto
    private static $errorLog = true;  // povoloje volami funkce error_log()
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

    // subjecty vnitnich emailu
    /** predmet emailu pri zasilani jednotlive chyby */
    const ERROR_SUBJECT = 'Error log report';
    /** predmet emailu pri zasilani chyb cronem */
    const ERROR_CRON_SUBJECT = 'Cron error log report';

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

    /**
     * aktivace logeru
     * - mody: logovat / logovat a posilat / posilat / jen zobrazovat
     * - cron: logy aktualniho dne a predesleho dne (pokud teda nejake jsou)
     * - pri cronu: zasilat jen kdyz je path, nastaveny path a email adresa
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
     * @param void
     * @return bool true pokud je zapnuto
     */
    public static function isEnabled() {
      return self::$enabled;
    }

    /**
     * nacteni path cesty na slozku pro error logy
     *
     * @since 2.10
     * @param void
     * @return string patch cesta do adresare
     */
    public static function getPath() {
      return self::$path;
    }

    /**
     * nacteni email adresy pro posilani error reportu
     * - vraci email nebo instanci Emaileru
     *
     * @since 2.10
     * @param void
     * @return string|Emailer emailova adresa
     */
    public static function getEmail() {
      return self::$email;
    }

    /**
     * nastaveni email adresy pro posilani
     * - natavuje se email nebo instance Emaileru
     *
     * @since 2.42
     * @param string|Emailer email emailova adresa
     * @return void
     */
    public static function setEmail($email) {
      self::$email = $email;
    }

    /**
     * inicializace callbacku, prekryti implicitnich error handleru
     *
     * @since 1.64
     * @param void
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
      $email = $decode['email'];
      // pokud je nastaveny Emailer tak automaticky bude unsearializovat, jinak nacte jen email
      self::$email = (Core::isEmail($email) ? $email : unserialize($email));
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
     * nastaveni stavu vypisu
     * - defaultne true (zapnuto)
     *
     * @since 2.20
     * @param bool state true pro vypis na stdout
     * @return void
     */
    public static function setPrintStdOut($state) {
      self::$printStdOut = $state;
    }

    /**
     * nastaveni logovani do php logu
     * - defaultne true (zapnuto)
     * - pro testy musi byt vypnuto!
     *
     * @since 2.54
     * @param bool state true pro prenaseni do logu
     * @return void
     */
    public static function enableErrorLog($state) {
      self::$errorLog = $state;
    }

    /**
     * nastaveni stavu odesilani (kdyz je nastaveny path a email)
     * - true: posila automaticky pri chybe (defaultne)
     * - false: posila jen s cronem (musi byt jeste zadany path)
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
     * @param void
     * @return string text error hlasky
     */
    public static function getMessage() {
      return self::$errorMsg;
    }

    /**
     * nacitani file name logu
     * - pro externi nacteni a pro vnitrni uziti v tride
     *
     * @since 2.56
     * @param void
     * @return string file name
     */
    public static function getFileNameLog() {
      return sprintf(self::DEFAULT_FILE_FORMAT, date(self::DEFAULT_DATE_FORMAT));
    }

    /**
     * pridani polozky do errorlogu
     * - pridavani primo do souboru
     *
     * @since 2.52
     * @param string message text zpravy
     * @param int code cislo kodu
     * @param string file soubor
     * @param int line cislo radku
     * @return void
     */
    public static function addLog($message, $code = E_USER_NOTICE, $file = null, $line = null) {
      // zpracovani kodu chyby
      $_code = (is_numeric($code) ? self::$errorCode[$code] : $code);
      // vytvoreni defaultniho formatu chyby
      $_message = date('Y-m-d H:i:s') . ' [' . $_code . '] [' . Core::getIp() . '] ' . $message . (isset($file) ? ' in ' . $file : null) . (isset($line) ? ' on line ' . $line : null);

      $file = self::$path . self::getFileNameLog();
      file_put_contents($file, $_message . PHP_EOL, FILE_APPEND | LOCK_EX); // pridavat na konec a zamykat pri zapisu
    }

    /**
     * vnitrni zpracovani chybove hlasky, jednotna metoda pro sjednocovani chybovych stavu
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
      $_message = date('Y-m-d H:i:s') . ' [' . $_code . '] [' . Core::getIp() . '] ' . $message . ' in ' . $file . ' on line ' . $line;

      if (self::$errorPage) {
        self::$errorMsg = str_replace(
            array('{$date}', '{$type}', '{$message}', '{$file}', '{$line}', '{$other}'),
            array(date('Y-m-d H:i:s'), $_code, $message, $file, $line, $other),
            self::$errorPage);
      } else {
        self::$errorMsg = $_message;  // defaultni zprava
      }

      if (self::$errorLog) {
        error_log(self::$errorMsg); // zaslani chyby do error logu
      }

      // pokud je umozneno vypisuje defaultne na stdout, s akceptovanim mutovani chyb @
      if (self::$printStdOut && error_reporting() != 0) {
        echo self::$errorMsg . PHP_EOL;
      }

      // pokud je zadana cesta, ulozi do logu
      if (self::$path) {
        // vytvoreni slozky logu
        if (!file_exists(self::$path)) {
          Core::generatePath(self::$path);
        }
        // zapis do logu
        $file = self::$path . self::getFileNameLog();
        file_put_contents($file, $_message . PHP_EOL, FILE_APPEND | LOCK_EX); // pridavat na konec a zamykat pri zapisu
      }

      // pokud je zadany email && je aktivni okamzite posilani tak posle emailem
      if (self::$email && self::$instantlySend) {
        if (self::$email instanceof Emailer) {
          self::$email->setMessage($_message)->send();  // nastaveni zpravy & odeslani zpravy
        } else {
          // pokud jdeo klasicky email
          $ses = Session::factory()->getSection(__CLASS__)->setClearAfterExpire(true);  // ochrana proti posilani stejne chybe za sebou
          if ($ses->$_code != $_code) {
            mail(self::$email, self::ERROR_SUBJECT, $_message);
            $ses->$_code = $_code; // ulozeni neexistujici polozky
          }
        }
      }
    }

    /**
     * handler volany pri destrukci pred GC
     * - pro chyby odchytava obsah funkce: error_get_last()
     *
     * @since 1.04
     * @param void
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
     * - vklada se do catch: ::logTryCatchException($e)
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
     * - odesilani reportu s pripardnyma chybama
     * - odesila jen tehdy kdyz je nastaveny: path error logu && email && instantlySend=false (vypnute okamzite odesilani)
     *
     * @since 1.14
     * @param array (jinak pole konfigurace predavana z kofigurace cronu)
     * @return int pocet zpracovanych polozek
     */
    public static function synchronizeCron($args = array()) {
      $conf = array(
          'path' => self::$path, // path konfiguracniho souboru
          'config' => self::DEFAULT_CONFIG_NAME,
          'email' => null,
          'clean_expire' => self::DEFAULT_EXPIRE, // expirovat po
          'clean_count' => self::DEFAULT_COUNT, // maximalni pocet
      );
      $conf = array_merge($conf, $args);  // secteni konfigurace

      if (file_exists($conf['config'])) {
        self::load($conf['config']);
      } else {
        self::$path = $conf['path'];
        self::$email = $conf['email'];
      }

      // pokud je zadany path && email
      if (self::$path && self::$email) {
        //~ var_dump(self::$email);
        $minus = strtotime('-1 day');
        $yesterday = date(self::DEFAULT_DATE_FORMAT, $minus);
        $today = date(self::DEFAULT_DATE_FORMAT);

        $f1 = self::$path . sprintf(self::DEFAULT_FILE_FORMAT, $yesterday); // soubor pro vcerejsek
        $f2 = self::$path . sprintf(self::DEFAULT_FILE_FORMAT, $today); // soubor pro dnesek

        $message = PHP_EOL . 'read file: '. $f1 . ', from date: ' . date('Y-m-d', $minus) . PHP_EOL . PHP_EOL;
        // pokud existuje log ze vcerejska
        if (file_exists($f1)) {
          $message .= file_get_contents($f1) . PHP_EOL;
        } else {
          $message .= '-- does not exists --' . PHP_EOL;
        }

        $message .= PHP_EOL . 'read file: '. $f2 . ', from date: ' . date('Y-m-d') . PHP_EOL . PHP_EOL;

        // pokud existuje log z dneska
        if (file_exists($f2)) {
          $message .= file_get_contents($f2) . PHP_EOL;
        } else {
          $message .= '-- does not exists --' . PHP_EOL;
        }

        // odeslani klasickeho emailu
        mail(self::$email, self::ERROR_CRON_SUBJECT, $message);
      }

      $poc = 0;
      // pokud je zadany path
      if (file_exists(self::$path)) {
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