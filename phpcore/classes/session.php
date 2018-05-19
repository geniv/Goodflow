<?php
/*
 * session.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * nevlastni rozhranni pro centrolani konstanty
   *
   * @package stable/session
   * @author geniv
   * @version 2.06
   */
  interface ISessionConstants {
    /** session klic */
    const SESSIONKEY = 'HTTP_HOST';

    /** klic pro session data */
    const SESSIONDATA = '_DATA_';
    /** klic pro session meta info */
    const SESSIONMETA = '_META_';
  }


  /**
   * nevlastni trida obsluhuci sekce pro session
   *
   * @package stable/session
   * @author geniv
   * @version 2.24
   */
  class SessionSection implements ISessionConstants {
    /** jmeno hlavni sekce */
    private $mainSection = null;
    /** jmeno aktualni sekce */
    private $nameSection = null;
    /** instance Session */
    private $parentSession = null;
    /** datova oblast */
    private $dataSession = null;
    /** meta oblast */
    private $metaSession = null;
    /** defaulnti cas expirace */
    private $timeExpire = '1 hours';
    /** mazat po expiraci? */
    private $clearAfterExpire = false;

    /**
     * kostruktor sekce
     * - startuje az po prvnim plneni promennych!
     *
     * @since 2.00
     * @param Session session instance ze ktere vyhcazi
     * @param string name jmeno sekce
     */
    public function __construct(Session $session, $name) {
      $this->parentSession = $session;
      $this->nameSection = $name;
      $this->mainSection = $_SERVER[self::SESSIONKEY];
    }

    /**
     * vnitrni startovani session
     *
     * @since 2.00
     * @param void
     * @return void
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
     * @since 2.00
     * @param string name jmeno promenne
     * @param mixed value hodnota promenne
     * @return void
     */
    public function __set($name, $value) {
      $this->start();
      $this->dataSession[$name] = $value;
    }

    /**
     * getter na promennou
     *
     * @since 2.00
     * @param string name jmeno promenne
     * @return mixed hodnota promenne
     */
    public function &__get($name) {
      $this->start();
      return $this->dataSession[$name];
    }

    /**
     * overovani existence promenne
     *
     * @since 2.00
     * @param string name jmeno promenne
     * @return bool true pokud promenna existuje
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
     * @since 2.00
     * @param string name jmeno promenne
     * @retrun void
     */
    public function __unset($name) {
      //$this->start();
      unset($this->dataSession[$name]);
    }

    /**
     * zniceni sekce
     *
     * @since 2.00
     * @param void
     * @return void
     */
    public function remove() {
      $this->start();
      $this->dataSession = null;
    }

    /**
     * nacteni casu expirace sekce, predsunuti dopredu
     *
     * @since 2.00
     * @param void
     * @return string cas expirace
     */
    public function getExpiration() {
      return $this->timeExpire;
    }

    /**
     * nastaveni casu expirace, predsunuti dopredu
     *
     * @since 2.00
     * @param string time novy cas expirace, format: '1 hour 2 minutes'
     * @return this
     */
    public function setExpiration($time) {
      $this->timeExpire = $time;
      return $this;
    }

    /**
     * revalidace catu, znovu prodlouzeni casu
     * - pro aplikaci: setClearAfterExpire() musi byt revalidate() az nakonec
     * - pro aplikaci: setExpiration() musi byt revalidate() az nakonec
     *
     * @since 2.00
     * @param void
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
     * @since 2.00
     * @param void
     * @return int cas ulozeni (timestamp)
     */
    public function getExpirationTime() {
      $this->start();
      return $this->metaSession;
    }

    /**
     * nastavovani likvidace session po vyprseni
     *
     * @since 2.00
     * @param bool state true pro zapnuti
     * @return this
     */
    public function setClearAfterExpire($state) {
      $this->clearAfterExpire = $state;
      return $this;
    }
  }


  /**
   * hlavni vlastni trida session
   *
   * @package stable/session
   * @author geniv
   * @version 2.54
   */
  class Session implements ISessionConstants {
    /** maximalni zivotnost session */
    const DEFAULT_MAXLIFETIME = 10800;

    private static $started = false;
    private $regenerated = false;
    private $mainSection = null;
    private $timeExpire = '1 hours';
    private $clearAfterExpire = false;

    /**
     * defaultni kostruktor
     *
     * @since 2.00
     * @param void
     */
    public function __construct() {
      $this->mainSection = $_SERVER[self::SESSIONKEY];
    }

    /**
     * toravni metoda
     *
     * @since 2.50
     * @param void
     * @return Session instance
     */
    public static function factory() {
      return new self;
    }

    /**
     * manualeni konfigurace session v php.ini
     *
     * @since 2.00
     * @param array configure pole nove konfigurace
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
     *
     * @since 2.00
     * @param void
     * @return void
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
     * - 0 = expirovat po zavreni prohlizece (defaultne)
     *
     * @since 2.00
     * @param string time cas expirace ve formatu '1 hour'
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
     * @since 2.00
     * @param void
     * @return this
     */
    public function start() {
      if (self::$started) {
        return;  // pokud je nastartovano rovnou se vraci
      }

      $this->configureSession();
//TODO pridat ochranu!
/*
        if (isset($_COOKIE['PHPSESSID'])) {
            $sessid = $_COOKIE['PHPSESSID'];
        } else if (isset($_GET['PHPSESSID'])) {
            $sessid = $_GET['PHPSESSID'];
        } else {
            session_start();
            return false;
        }

        if (!preg_match('/^[a-z0-9]{32}$/', $sessid)) {
            return false;
        }
        session_start();
*/
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
     * @since 2.00
     * @param void
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
     * @since 2.00
     * @param void
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
     * @since 2.00
     * @param void
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
     * @since 2.00
     * @param void
     * @return bool true pokud sessesion bezi
     */
    public function isStarted() {
      return self::$started;
    }

    /**
     * existuje session
     *
     * @since 2.00
     * @param void
     * @return bool true pokud session existuje (start || je v cookie)
     */
    public function isExists() {
      return (self::$started || !is_null(Core::getCookie($this->getName())));
    }

    /**
     * nacitani sekce session
     * - ustredni metoda
     *
     * @since 2.00
     * @param string name jmeno sekce
     * @return SessionSection instance
     */
    public function getSection($name) {
      return new SessionSection($this, $name);
    }

    /**
     * existuje sekce?
     *
     * @since 2.00
     * @param string name jmeno sekce
     * @return bool true pokud existuje sekce
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
     * @since 2.00
     * @param void
     * @return string nazev id
     */
    public function getId() {
      return session_id();
    }

    /**
     * nacteni session name
     *
     * @since 2.00
     * @param void
     * @return string session name
     */
    public function getName() {
      return session_name();
    }

    /**
     * nastaveni session name
     *
     * @since 2.00
     * @param string name nove jmeno
     * @return this
     */
    public function setName($name) {
      session_name($name);
      return $this;
    }

    /**
     * regeneruje session id
     *
     * @since 2.00
     * @param void
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