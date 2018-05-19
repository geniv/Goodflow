<?php
/*
 * session.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * trida obsluhujici: Session a SectionSession
 */

  namespace classes;


  /**
   * nevlastni rozhranni pro centrolani konstanty
   */
  interface ISessionConstants {
    //const VERSION = 2.06;
    const SESSIONKEY = 'HTTP_HOST';

    const SESSIONDATA = '_DATA_';
    const SESSIONMETA = '_META_';
  }


  /**
   * nevlastni trida obsluhuci sekce pro session
   */
  class SessionSection implements ISessionConstants {
    const VERSION = 2.20;
    private $mainSection = null;  //jmeno hlavni sekce
    private $nameSection = null;  //jmeno aktualni sekce
    private $parentSession = null;  //(Session)
    private $dataSession = null;  //datova oblast
    private $metaSession = null;  //meta oblast
    private $timeExpire = '1 hours';  //defaulnti cas expirace
    private $clearAfterExpire = false;  //mazat po expiraci?

    /**
     * kostruktor sekce
     * -startuje az po prvnim plneni promennych!
     *
     * @param session instance ze ktere vyhcazi
     * @param name jmeno sekce
     */
    public function __construct(Session $session, $name) {
      $this->parentSession = $session;
      $this->nameSection = $name;
      $this->mainSection = $_SERVER[self::SESSIONKEY];
    }

    /**
     * vnitrni startovani session
     */
    private function start() {
      $this->parentSession->start();
      $this->dataSession = &$_SESSION[$this->mainSection][self::SESSIONDATA][$this->nameSection];
      $this->metaSession = &$_SESSION[$this->mainSection][self::SESSIONMETA][$this->nameSection];

      $sessionTime = &$this->metaSession;
      $time = time();

      if (!is_null($this->dataSession) && $this->timeExpire != 0 && $time > $sessionTime) {
        $sessionTime = strtotime('+'.$this->timeExpire, $time);
        // pokus se ma po vyprseni session likvidovat
        if ($this->clearAfterExpire) {
          $this->dataSession = null;
        }
      }
    }

    /**
     * setter na promenne
     *
     * @param name jmeno promenne
     * @param value hodnota promenne
     */
    public function __set($name, $value) {
      $this->start();
      $this->dataSession[$name] = $value;
    }

    /**
     * getter na promennou
     *
     * @param name jmeno promenne
     * @return hodnota promenne
     */
    public function &__get($name) {
      $this->start();
      return $this->dataSession[$name];
    }

    /**
     * overovani existence promenne
     *
     * @param name jmeno promenne
     * @return true pokud promenna existuje
     */
    public function __isset($name) {
      if ($this->parentSession->isExists()) {
        $this->start();
      }
      return isset($this->dataSession[$name]);
    }

    /**
     * ruseni promenne
     *
     * @param name jmeno promenne
     */
    public function __unset($name) {
      //$this->start();
      unset($this->dataSession[$name]);
    }

    /**
     * zniceni sekce
     */
    public function remove() {
      $this->start();
      $this->dataSession = null;
    }

    /**
     * nacteni casu expirace sekce, predsunuti dopredu
     *
     * @return cas expirace
     */
    public function getExpiration() {
      return $this->timeExpire;
    }

    /**
     * nastaveni casu expirace, predsunuti dopredu
     *
     * @param time novy cas expirace, format: '1 hour 2 minutes'
     * @return this
     */
    public function setExpiration($time) {
      $this->timeExpire = $time;

      if (function_exists('ini_set')) {
        $seconds = strtotime('+'.$time) - time();
        //~ var_dump($seconds);
        //~ ini_set('session.gc_maxlifetime', $seconds);
        //~ ini_set('session.cookie_lifetime', $seconds);
        //~ var_dump(ini_get('session.gc_maxlifetime'), ini_get('session.cookie_lifetime'));
      }

      //~ ini_set('session.gc_maxlifetime');  // number of seconds after which data will be seen as 'garbage' and potentially cleaned up.
      //~ ini_set('session.cookie_lifetime'); //The value 0 means "until the browser is closed."
      //~ ini_set('session.cookie_httponly'); //true pro redukci XSS
      return $this;
    }

    /**
     * revalidace catu, znovu prodlouzeni casu
     * pro aplikaci: setClearAfterExpire() musi byt revalidate() az nakonec
     * pro aplikaci: setExpiration() musi byt revalidate() az nakonec
     *
     * @return this
     */
    public function revalidate() {
      $this->start();
      if (!is_null($this->dataSession)) {
        $this->metaSession = strtotime('+'.$this->timeExpire);
      }
      return $this;
    }

    /**
     * cas kdy session vyprsi, predsunuta hodnota
     *
     * @return cas ulozeni (timestamp)
     */
    public function getExpirationTime() {
      $this->start();
      return $this->metaSession;
    }

    /**
     * nastavovani likvidace session po vyprseni
     *
     * @param state true pro zapnuti
     * @return this
     */
    public function setClearAfterExpire($state) {
      $this->clearAfterExpire = $state;
      return $this;
    }
  }


  /**
   * hlavni vlastni trida session
   */
  class Session implements ISessionConstants {
    const VERSION = 2.50;
    const DEFAULT_MAXLIFETIME = 10800;  // maximalni zivotnost session

    private static $started = false;
    private $regenerated = false;
    private $mainSection = null;
    private $timeExpire = '1 hours';
    private $clearAfterExpire = false;

    /**
     * kostruktor tridy
     */
    public function __construct() {
      $this->mainSection = $_SERVER[self::SESSIONKEY];
    }

    /**
     * manualeni konfigurace session v php.ini
     *
     * @param configure pole nove konfigurace
     * @return this
     */
    private function configureSession($configure = null) {
      $conf = array(
                    'session.referer_check' => '',
                    'session.use_cookies' => 1,
                    'session.use_only_cookies' => 1,
                    'session.use_trans_sid' => 0,

                    'session.cookie_lifetime' => 0, // do zavreni prohlizece
                    'session.cookie_path' => '/',
                    'session.cookie_domain' => '',
                    'session.cookie_secure' => false,
                    'session.cookie_httponly' => true,

                    'session.gc_maxlifetime' => self::DEFAULT_MAXLIFETIME,  // 3 hodiny
                    'session.cache_limiter' => null,
                    'session.cache_expire' => null,
                    'session.hash_function' => null,
                    'session.hash_bits_per_character' => null,
                    );

      // pokud neco prijde parametrem
      if ($configure && is_array($configure)) {
        $conf = array_merge($conf, $configure);
      }

      // pokud je dostupna funkce: ini_set
      if (function_exists('ini_set')) {
        $cookie = null;
        foreach ($conf as $k => $v) {
          if (!is_null($v) && ini_get($k) != $v) {
            //saha se na cookie
            if (strncmp($k, 'session.cookie_', 15) === 0) {
              if (!isset($cookie)) {
                $cookie = session_get_cookie_params();
              }
              $cookie[substr($k, 15)] = $v;
            }
            ini_set($k, $v);  // nastavovani ini souboru
          }
        }

        // pokud se na cookie sahalo musi se resend
        if (isset($cookie)) {
          session_set_cookie_params($cookie['lifetime'], $cookie['path'], $cookie['domain'],
                                    $cookie['secure'], $cookie['httponly']);
          if (self::$started) { // pokud se jiz startovalo, potreba resend
             $this->resendCookie();
          }
        }
      } else {
        die('function: ini_set does not found!');
      }
      return $this;
    }

    /**
     * znovu odeslani cookie
     */
    private function resendCookie() {
      $cookie = session_get_cookie_params();
      Core::setCookie(session_name(), session_id(),
                      $cookie['lifetime'] ? $cookie['lifetime'] + time() : 0,
                      $cookie['path'], $cookie['domain'],
                      $cookie['secure'], $cookie['httponly']);
    }

    /**
     * globalni nastaveni expirace session nad php.ini
     * -0 = expirovat po zavreni prohlizece (defaultne)
     *
     * @param time cas expirace ve formatu '1 hour'
     * @return this
     */
    public function setExpiration($time) {
      if (empty($time)) {
        return $this->configureSession(array(
          'session.gc_maxlifetime' => self::DEFAULT_MAXLIFETIME,
          'session.cookie_lifetime' => 0));
      } else {
        $time = strtotime('+'.$time) - time();
        return $this->configureSession(array(
          'session.gc_maxlifetime' => $time,
          'session.cookie_lifetime' => $time));
      }
    }

    /**
     * startovani session
     *
     * @return this
     */
    public function start() {
      if (self::$started) {
        return;  // pokud je nastartovano rovnou se vraci
      }

      $this->configureSession();

      if (session_start()) {
        self::$started = true;
      }

      //pokud se vyskytne potreba regenerovat
      if ($this->regenerated) {
        $this->regenerateId();
        $this->regenerated = false;
      }

      return $this;
    }

    /**
     * uzavreni a vyscisteni session
     *
     * @return this
     */
    public function close() {
      if (self::$started) {
        $this->clean();
        session_write_close();
        self::$started = false;
      }
      return $this;
    }

    /**
     * vycisteni session
     *
     * @return this
     */
    public function clean() {
      if (self::$started && !empty($_SESSION)) {
        if (!empty($_SESSION[$this->mainSection])) {
          unset($_SESSION[$this->mainSection]);
        }
      }
      return $this;
    }

    /**
     * likvidace session i z response
     *
     * @return this
     */
    public function destroy() {
      if (self::$started) {
        session_destroy();
        $_SESSION = null; //vynulovani session
        self::$started = false;
        //likvidace cookie
        $params = session_get_cookie_params();
        Core::deleteCookie(session_name(), $params['path'], $params['domain'], $params['secure']);
      }
      return $this;
    }

    /**
     * je nastartovano?
     *
     * @return true pokud sessesion bezi
     */
    public function isStarted() {
      return self::$started;
    }

    /**
     * existuje session
     *
     * @return true pokud session existuje (start || je v cookie)
     */
    public function isExists() {
      return (self::$started || !is_null(Core::getCookie($this->getName())));
    }

    /**
     * nacitani sekce cookie
     *
     * @param name jmeno sekce
     * @return instance SessionSection
     */
    public function getSection($name) {
      return new SessionSection($this, $name);
    }

    /**
     * existuje sekce?
     *
     * @param name jmeno sekce
     * @return true pokud existuje sekce
     */
    public function hasSection($name) {
      if ($this->isExists() && !self::$started) {
        $this->start();
      }
      return (!empty($_SESSION[$this->mainSection][self::SESSIONDATA][$name]));
    }

    /**
     * nacitani session id
     *
     * @return nazev id
     */
    public function getId() {
      return session_id();
    }

    /**
     * nacteni session name
     *
     * @return sesion name
     */
    public function getName() {
      return session_name();
    }

    /**
     * nastaveni session name
     *
     * @param name nove jmeno
     * @return this
     */
    public function setName($name) {
      session_name($name);
      return $this;
    }

    /**
     * regeneruje session id
     *
     * @return this
     */
    public function regenerateId() {
      if (self::$started && !$this->regenerated) {
        if (Core::isSentHeaders()) {
          echo 'chyba jiz odesleno?!';
        }
        session_regenerate_id(true);
        session_write_close();
        $z = $_SESSION;
        session_start();
        $_SESSION = $z;
      }
      $this->regenerated = true;
      return $this;
    }
  }