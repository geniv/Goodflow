<?php
/*
 * curl.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * obsluha cURL knihovny
   * - vyzaduje: CURL (apt-get install php5-curl)
   *
   * @package stable
   * @author geniv
   * @version 1.32
   */
  class Curl {
    private $res = null;
    private $url = null;
    private $timeout = 10;
    private $returntransfer = true;
    private $header = false;
    private $useragent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.114 Safari/537.36';
    private $options = array();

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param string url
     */
    public function __construct($url = null) {
      if (self::isLoaded()) {
        $this->res = curl_init($url);
        if ($url) {
          $this->url = $url;
        }
      } else {
        throw new ExceptionCurl('PHP extension cURL must be loaded!');
      }
    }

    //~ /**
     //~ * destruktor
     //~ * - Closes a cURL session and frees all resources
     //~ *
     //~ * @since 1.06
     //~ * @param void
     //~ * @return void
     //~ */
    //~ public function __destruct() {
      //~ if (is_resource($this->res)) {
        //~ curl_close($this->res);
      //~ }
    //~ }

    /**
     * je cURL nacten jako modul?
     *
     * @since 1.02
     * @param void
     * @return bool true kdyz je nacteno
     */
    public static function isLoaded() {
      return extension_loaded('curl');
    }

    /**
     * nacteni timeoutu
     *
     * @since 1.24
     * @param void
     * @return int casovy timeout
     */
    public function getTimeout() {
      return $this->timeout;
    }

    /**
     * nastavovani timeout
     * - The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
     *
     * @since 1.04
     * @param int timeout cas, defaultne 10
     * @return this
     */
    public function setTimeout($timeout) {
      $this->timeout = intval($timeout);
      return $this;
    }

    /**
     * nacteni vraceni do promenne
     *
     * @since 1.24
     * @param void
     * @return bool true kdyz vraci do promenne
     */
    public function getReturnTransfer() {
      return $this->returntransfer;
    }

    /**
     * nastaveni vraceni do promenne
     * - TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
     *
     * @since 1.06
     * @param bool state true pro povoleni vraceni do promenne
     * @return this
     */
    public function setReturnTransfer($state) {
      $this->returntransfer = (bool) $state;
      return $this;
    }

    /**
     * nacteni vraceni hlavicek
     *
     * @since 1.24
     * @param void
     * @return bool true kdyz vracet hlavicky
     */
    public function getHeader() {
      return $this->header;
    }

    /**
     * nastaveni vraceni hlavicek
     * - TRUE to include the header in the output.
     *
     * @since 1.08
     * @param bool state true pro vraceni hlavicek, defaultni false
     * @return this
     */
    public function setHeader($state) {
      $this->header = (bool) $state;
      return $this;
    }

    /**
     * nacteni user agenta
     *
     * @since 1.30
     * @param void
     * @return string text user agenta
     */
    public function getUseragent() {
      return $this->useragent;
    }

    /**
     * nastaveni user agenta
     * - The contents of the "User-Agent: " header to be used in a HTTP request.
     *
     * @since 1.10
     * @param string agent text usera agenta ktery se ma pouzit pri pristupu
     * @return this
     */
    public function setUseragent($agent) {
      if ($agent) {
        $this->useragent = $agent;
      }
      return $this;
    }

    //TODO do budoucna pridat: curl_getinfo($this->res)

    /**
     * nacteni moznosti
     *
     * @since 1.28
     * @param string key klic nastaveni
     * @return mixed hodnota nastaveni
     */
    public function getOption($key) {
      return (isset($this->options[$key]) ? $this->options[$key] : (!$key ? $this->options : null));
    }

    /**
     * nastavovani moznosti
     * - vice moznosti: http://www.php.net/manual/en/function.curl-setopt.php
     *
     * @since 1.14
     * @param int key klic nastaveni
     * @param mixed value hodnota nastaveni
     * @return this
     */
    public function setOption($key, $value) {
      if ($key && $value) {
        $this->options[$key] = $value;
      }
      return $this;
    }

    /**
     * nacteni url adresy
     *
     * @since 1.30
     * @param void
     * @return string url adresa
     */
    public function getUrl() {
      return $this->url;
    }

    /**
     * nastaveni url adresy
     * - The URL to fetch. This can also be set when initializing a session with curl_init().
     *
     * @since 1.18
     * @param string url url adresa
     * @return this
     */
    public function url($url) {
      if ($url) {
        $this->url = $url;
      }
      return $this;
    }

    /**
     * nastaveni get dat (hlavni je nastavovani url)
     * - jde pouzit jako metoda: url()
     *
     * @since 1.16
     * @param string url url adresa
     * @param array|null argv pole argumentu, nepovinny argument
     * @return this
     */
    public function get($url, $argv = null) {
      if ($url) {
        $this->url = $url . ($argv && is_array($argv) ? '?' . http_build_query($argv) : null);  // pokud je pole
      }
      return $this;
    }

    /**
     * nastavovani post dat
     *
     * @since 1.14
     * @param array data pole argumentu
     * @return this
     */
    public function post($data) {
      if ($data && is_array($data)) { // pokud je pole
        $this->options[CURLOPT_POST] = count($data);
        $this->options[CURLOPT_POSTFIELDS] = $data;
      }
      return $this;
    }

    /**
     * hlavni vykovaci metoda
     * - This function should be called after initializing a cURL session and all the options for the session are set.
     *
     * @since 1.08
     * @param void
     * @return mixed data vracena z dotazu
     */
    public function exec() {
      $options = array(
          CURLOPT_URL => $this->url,
          CURLOPT_RETURNTRANSFER => $this->returntransfer,
          CURLOPT_CONNECTTIMEOUT => $this->timeout,
          CURLOPT_HEADER => $this->header,
          CURLOPT_USERAGENT => $this->useragent,
        );
      $options += $this->options; // aplikace dalsiho nastaveni
      curl_setopt_array($this->res, $options);
      if (($result = curl_exec($this->res)) === false) {
        throw new ExceptionCurl(curl_error($this->res), curl_errno($this->res));
      } else {
        curl_close($this->res);
      }
      return $result;
    }

    /**
     * nacteni verze cURL
     *
     * @since 1.12
     * @param void
     * @return string verze cURL
     */
    public static function version() {
      $v = curl_version();
      return $v['version'];
    }
  }

  /**
   * vyjimky pro curl
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionCurl extends \Exception {}