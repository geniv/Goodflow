<?php
/*
 * session.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * vetsi inspirace od nette
 */

  namespace classes;

  use classes\DateAndTime,
      classes\Response,
      stdClass,
      Exception;

  /**
   *
   * rozhranni pro pripadne pouziti u session storage
   *
   */
  //PHP 5.4.0: SessionHandlerInterface
  interface ISessionStorage {
    //const VERSION = 1.00;
    function open($savePath, $sessionName);
    function close();
    function read($sessionId);
    function write($sessionId, $data);
    function destroy($sessionId);
    function gc($lifetime);
  }
//TODO provest revizi metod/zybtecnosti nekterych casti!
  /**
   *
   * rozhrani s konstantama session
   *
   */
  interface ISessionConstants {
    //const VERSION = 1.02;
    const SESKEY = '__GOODFLOW__';
  }

  /**
   *
   * instancni trida pro vytvareni jmenych prostoru session
   *
   */

  class SessionSection implements ISessionConstants {
    const VERSION = 1.26;

    private $section = null;

    /**
     * hlavni konstruktor sekce
     * obvykle neni volany naprimo!
     *
     * @param session zdrojova session
     * @param name jmeno sekce
     */
    public function __construct(Session $session, $name) {
      $this->section = new stdClass;
      $this->section->session = $session;
      $this->section->name = $name;
      $this->section->data = null;
      $this->section->meta = null;
    }

    /**
     * inicializace sekce, volana interne
     */
    private function start() {
      $this->section->session->start();
      $this->section->data = &$_SESSION[self::SESKEY]['data'][$this->section->name];  //predani adresy do ->data
      $this->section->meta = &$_SESSION[self::SESKEY]['meta'][$this->section->name];  //predani adresy do ->meta
    }

    /**
     * nastaveni hodnoty promenne
     *
     * @param name jmeno promenne
     * @param value hodnota promenne
     */
    public function __set($name, $value) {
      $this->start();
      $this->section->data[$name] = $value;
    }

    /**
     * nacteni hodnoty promenne
     *
     * @param name jmeno promenne
     * @return hodnota promenne
     */
    public function &__get($name) {
      $this->start();
      return $this->section->data[$name];
    }

    /**
     * overuje jestli promenna existuje
     *
     * @param name jmeno promenne
     * @return true pokud existuje
     */
    public function __isset($name) {
      if ($this->section->session->isExists()) {
        $this->start();
      }
      return isset($this->section->data[$name]);
    }

    /**
     * zruseni konkretni promenne
     *
     * @param name jmeno promenne
     * @return true zruseno
     */
    public function __unset($name) {
      $this->start();
      unset($this->section->data[$name]);
    }

    /**
     * nastaveni expirace sekci na danou promennou/promenne
     *
     * @param time cas expirace
     * @param variables jmeno promenne/promennych
     * @return this
     */
    public function setExpiration($time, $variables = null) {
      $this->start();
      if (empty($time)) {
        $time = null;
        $browserClose = true;
      } else {
        $time = DateAndTime::from($time)->format('U');
        $max = ini_get('session.gc_maxlifetime');
        if ($time - time() > $max + 3) {
          //throw new ExceptionSession('expirace je vetsi nez maximalni trvanlivost session');
          //toto neni chyba!
        }
        $browserClose = false;
      }

      if (is_null($variables)) {
        $this->section->meta['']['time'] = $time;
        $this->section->meta['']['browser'] = $browserClose;
      } else
      if (is_array($variables)) {
        foreach ($variables as $var) {
          $this->section->meta[$var]['time'] = $time;
          $this->section->meta[$var]['browser'] = $browserClose;
        }
      } else {
        $this->section->meta[$variables]['time'] = $time;
        $this->section->meta[$variables]['browser'] = $browserClose;
      }
      return $this;
    }

    /**
     * odebrani expirace sekci na danou promennou/promenne
     *
     * @param variables promenna/pole/null promennych
     * @return this
     */
    public function removeExpiration($variables = null) {
      $this->start();
      if (is_null($variables)) {
        unset($this->section->meta['']['time'],
              $this->section->meta['']['browser']);
      } else
      if (is_array($variables)) {
        foreach ($variables as $var) {
          unset($this->section->meta[$var]['time'],
                $this->section->meta[$var]['browser']);
        }
      } else {
        unset($this->section->meta[$variables]['time'],
              $this->section->meta[$variables]['browser']);
      }
      return $this;
    }

    /**
     * zruseni aktualni session sekce
     */
    public function remove() {
      $this->start();
      $this->section->data = null;
      $this->section->meta = null;
    }
  }

  /**
   *
   * hlavni instancni trida ktera ma na starosti praci se _session
   *
   */

  class Session implements ISessionConstants {
    const VERSION = 1.30;

    private static $started = false;
    private $items = null;

    const FILE_LIFE_TIME = 10800; //3 * 60 * 60
    const REGEN_INTERVAL = 1800;  //30 * 60

    /**
     * hlavni konstruktor session
     */
    public function __construct() {
      $this->items = new stdClass;
      $this->items->regenerated = false;
      $this->items->response = new Response();

      $this->items->options = array(
        // security
        'referer_check' => '',    // must be disabled because PHP implementation is invalid
        'use_cookies' => 1,       // must be enabled to prevent Session Hijacking and Fixation
        'use_only_cookies' => 1,  // must be enabled to prevent Session Fixation
        'use_trans_sid' => 0,     // must be disabled to prevent Session Hijacking and Fixation

        // cookies
        'cookie_lifetime' => 0,   // until the browser is closed
        'cookie_path' => '/',     // cookie is available within the entire domain
        'cookie_domain' => '',    // cookie is available on current subdomain only
        'cookie_secure' => false, // cookie is available on HTTP & HTTPS
        'cookie_httponly' => true,// must be enabled to prevent Session Hijacking

        // other
        'gc_maxlifetime' => self::FILE_LIFE_TIME,// 3 hours
        'cache_limiter' => null,  // (default "nocache", special value "\0")
        'cache_expire' => null,   // (default "180")
        'hash_function' => null,  // (default "0", means MD5)
        'hash_bits_per_character' => null, // (default "4")
      );
    }

    /**
     * start a inicializace session dat
     *
     * @return this
     */
    public function start() {
      if (!self::$started) {

        $this->configure($this->items->options);

        if (session_start()) {
          self::$started = true;

          $ses = &$_SESSION[self::SESKEY];
          if (empty($ses)) {
            $ses = array('count' => 0);
          } else {
            $ses['count']++;
          }

          $sesTime = &$ses['cas'];
          $cas = time();
          if ($cas - $sesTime > self::REGEN_INTERVAL) {
            $this->items->regenerated = $this->items->regenerated || isset($sesTime);
            $sesTime = $cas;
          }
          //browser-key???

          //TODO kontrola expiraci promennych ze section ['meta']

          //var_dump(session_id());
        } else {
          throw new ExceptionSession('session se nepodarilo nastartovat');
        }

        if ($this->items->regenerated) {
          $this->regenerateId();
          $this->items->regenerated = false;
        }

        register_shutdown_function(array($this, 'clean'));
      }
      return $this;
    }

    /**
     * zjistuje jestli je session nastartovana
     * session_status() >= 5.4.0
     *
     * @return true pokud je jiz nastatrovana
     */
    public function isStarted() {
      return self::$started;
    }

    /**
     * ukonceni aktualni session a ulozeni dat
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
     * zniceni vsech dat ulozenych v session
     *
     * @return this
     */
    public function destroy() {
      if (self::$started) {
        session_destroy();
        $_SESSION = null;
        self::$started = false;

        if ($this->items->response->isSent()) {
          $params = session_get_cookie_params();
          $this->items->response->deleteCookie(session_name(), $params['path'], $params['domain'], $params['secure']);
        }
      } else {
        throw new ExceptionSession('session neni nastartovane!');
      }
      return $this;
    }

    /**
     * testuje jestli existuje session pro aktualni request
     *
     * @return true existuje
     */
    public function isExists() {
      return (self::$started || !is_null($this->items->response->getCookie($this->getName())));
    }

    /**
     * regeneruje session id
     *
     * @return this
     */
    public function regenerateId() {
      if (self::$started && !$this->items->regenerated) {
        if (headers_sent($file, $line)) { throw new ExceptionSession('nelze zalaslat hlavicky, via:'.$file.', '.$line); }
        session_regenerate_id(true);
        session_write_close();
        $zaloha = $_SESSION;
        session_start();
        $_SESSION = $zaloha;
      }
      $this->items->regenerated = true;
      return $this;
    }

    /**
     * vraci aktualni session id
     *
     * @return session id
     */
    public function getId() {
      return session_id();
    }

    /**
     * nastavi jmeno session
     *
     * @param name nove jmeno session
     * @return this
     */
    public function setName($name) {
      session_name($name);
      $this->setOptions(array('name' => $name));
      return $this;
    }

    /**
     * vraceni jmeno session
     *
     * @return jmeno session
     */
    public function getName() {
      return (isset($this->items->options['name']) ? $this->items->options['name'] : session_name());
    }

    /**
     * vrati sekci (jmeny prostor) session sekce
     *
     * @param section jmeno sekce
     * @param class tirda sekce ktera se vytvari
     * @return instance SessionSection
     */
    public function getSection($section, $class = 'classes\SessionSection') {
      return new $class($this, $section); //vytvoreni jmenoho prostoru jako noveho objektu
    }

    /**
     * zjistuje jestli dana sekce jiz existuje
     *
     * @param section jmeno sekce
     * @return true pokud sekce existuje
     */
    public function hasSection($section) {
      if ($this->isExists() && !self::$started) { $this->start(); }
      return (!empty($_SESSION[self::SESKEY]['data'][$section]));
    }

    /**
     * uklid po session
     *
     * @return this
     */
    public function clean() {
      if (self::$started && !empty($_SESSION)) {
        //unset($_SESSION);

        $ses = &$_SESSION[self::SESKEY];

        //cisteni session

        if (empty($ses['data'])) {
          unset($ses['data']);
        }

        if (empty($ses['meta'])) {
          unset($ses['meta']);
        }
      }
      return $this;
    }

    /**
     * nastaveni session konfigurace
     *
     * @param options nove nastaveni
     * @return this
     */
    public function setOptions(array $options) {
      if (self::$started) {
        $this->configure($options);
      }
      $this->items->options = $options + $this->items->options;
      if (!empty($options['auto_start'])) {
        $this->start();
      }
      return $this;
    }

    /**
     * nacte konfiguraci session
     *
     * @return pole konfigurace
     */
    public function getOptions() {
      return $this->items->options;
    }

    /**
     * aplikace session konfiguraci
     *
     * @param config pole konfigurace
     */
    private function configure(array $config) {
      $special = array('cache_expire' => 1, 'cache_limiter' => 1, 'save_path' => 1, 'name' => 1);

      foreach ($config as $key => $value) {
        if (!strncmp($key, 'session.', 8)) { // back compatibility
          $key = substr($key, 8);
        }
        $key = strtolower(preg_replace('#(.)(?=[A-Z])#', '$1_', $key));

        if (is_null($value) || ini_get("session.$key") == $value) { // intentionally ==
          continue;
        } else
        if (strncmp($key, 'cookie_', 7) === 0) {
          if (!isset($cookie)) {
            $cookie = session_get_cookie_params();
          }
          $cookie[substr($key, 7)] = $value;
        } else {
          if (defined('SID')) {
            throw new ExceptionSession("Unable to set 'session.$key' to value '$value' when session has been started" . (self::$started ? "." : " by session.auto_start or session_start()."));
          }
          if (isset($special[$key])) {
            $key = "session_$key";
            $key($value);
          } else
          if (function_exists('ini_set')) {
            ini_set("session.$key", $value);
          } else
          if (!function_exists('ini_set')) {
            throw new ExceptionSession('Required function ini_set() is disabled.');
          }
        }
      }

      if (isset($cookie)) {
        session_set_cookie_params(
          $cookie['lifetime'], $cookie['path'], $cookie['domain'],
          $cookie['secure'], $cookie['httponly']
        );

        if (self::$started) {
          $this->sendCookie();
        }
      }
    }

    /**
     * nastaveni expirace
     *
     * @param time cas expirace, 0 znamena po zavreni prohlizece expirovat
     * @return this
     */
    public function setExpiration($time) {
      if (empty($time)) {
        return $this->setOptions(array(
          'gc_maxlifetime' => self::FILE_LIFE_TIME,
          'cookie_lifetime' => 0,
        ));
      } else {
        $time = DateAndTime::from($time)->format('U') - time();
        return $this->setOptions(array(
          'gc_maxlifetime' => $time,
          'cookie_lifetime' => $time,
        ));
      }
    }

    /**
     * nastaveni session cookie parametru
     *
     * @param path cesta platnosti cookie
     * @param domain domena platnosti cookie
     * @param secure true pro zabezpecene cookie
     * @return this
     */
    public function setCookieParameters($path, $domain = null, $secure = null) {
      return $this->setOptions(array(
        'cookie_path' => $path,
        'cookie_domain' => $domain,
        'cookie_secure' => $secure
      ));
    }

    /**
     * nacteni session cookie parametru
     *
     * @return pole parametru: lifetime, path, domain, secure, httponly
     */
    public function getCookieParameters() {
      return session_get_cookie_params();
    }

    /**
     * nastaveni session cesty pro ulozeni
     *
     * @param path cesta na ulozeni
     * @return this
     */
    public function setSavePath($path) {
      return $this->setOptions(array(
        'save_path' => $path,
      ));
    }

    /**
     * nastaveni uzivatelskeho session uloziste
     *
     * @param storage jmeno tridy ktera dedi rozhranni ISessionStorage
     * @return this
     */
    public function setStorage(ISessionStorage $storage) {
      if (self::$started) {
        throw new ExceptionSession('session nebylo nastartovano!');
      }

      session_set_save_handler(
        array($storage, 'open'), array($storage, 'close'), array($storage, 'read'),
        array($storage, 'write'), array($storage, 'remove'), array($storage, 'clean')
      );
      return $this;
    }

    /**
     * posilani session cookie
     */
    private function sendCookie() {
      $cookie = $this->getCookieParameters();
      $this->items->response
      ->setCookie(
        session_name(), session_id(),
        $cookie['lifetime'] ? $cookie['lifetime'] + time() : 0,
        $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'])
      //->setCookie('nette-browser', $_SESSION['__NF']['B'], Response::BROWSER, $cookie['path'], $cookie['domain'])
      ;
    }
  }

  class ExceptionSession extends Exception {}

?>
