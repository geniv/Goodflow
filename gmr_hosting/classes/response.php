<?php
/*
 * response.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * instancni trida spravujici hlavne hlavicky
 */

  namespace classes;

  use classes\DateAndTime,
      DateTimeZone,
      stdClass,
      Exception;

  class Response {
    const VERSION = 1.34;

    private $response = null;

    /**
     * hlavni kostruktor
     */
    public function __construct() {
      $this->response = new stdClass;
      $this->response->code = 200;
      $this->response->cookieDomain = '';
      $this->response->cookiePath = '/';
      $this->response->cookieSecure = false;
      $this->response->cookieHttpOnly = true;
    }

    /**
     * kontrola odeslanych slozek
     *
     * @assert () throws classes\ExceptionResponse
     */
    private function checkHeadersSent() {
      if (headers_sent($file, $line)) {
        throw new ExceptionResponse('nelze odeslat hlavicky po http odeslani hlavicek, via: '.$file.', '.$line);
      }
    }

    /**
     * nastavi http response kod
     *
     * @param code http kod pro hlavicku
     * @return this
     */
    public function setCode($code) {
      $allow = array(200, 201, 202, 203, 204, 205, 206,
                     300, 301, 302, 303, 304, 307,
                     400, 401, 403, 404, 405, 406, 408, 410, 412, 415, 416,
                     500, 501, 503, 505
                    );

      $code = intval($code);

      $this->checkHeadersSent();

      if (!in_array($code, $allow)) {
        throw new ExceptionResponse('zadany kod: '.$code.' neni v seznamu povolenych kodu');
      } else {
        $this->response->code = $code;
        $protocol = (!empty($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1');
        header($protocol.' '.$code, true, $code);
      }
      return $this;
    }

    /**
     * vrati http response kod
     *
     * @return http kod
     */
    public function getCode() {
      return $this->response->code;
    }

    /**
     * posle http hlavicku, kde nahhradi predeslou
     *
     * @param name jmeno hlavicky
     * @param value hodnota hlavicky, null maze hlavicku
     * @return this
     */
    public function setHeader($name, $value) {
      $this->checkHeadersSent();
      if (is_null($value)) {
        header_remove($name); //od PHP 5.3.0
      } else {
        header($name.': '.$value, true, $this->response->code);
      }
      return $this;
    }

    /**
     * prida http hlavicku
     *
     * @param name jmeno hlavicky
     * @param value hodnota hlavicky
     * @return this
     */
    public function addHeader($name, $value) {
      $this->checkHeadersSent();
      header($name.': '.$value, false, $this->response->code);
      return $this;
    }

    /**
     * nactavuje http content-type
     *
     * @param type mime-type typ
     * @param charset charset typ
     * @return this
     */
    public function setContentType($type, $charset = 'UTF-8') {
      $this->setHeader('Content-Type', $type.(!is_null($charset) ? '; charset='.$charset : ''));
      return $this;
    }

    /**
     * redirect na urcitou url adresu(, po zavolani je nutne zavolat exit)
     *
     * @param url cislova adresa presmerovani
     * @param code kod presmerovani, pokud je null kod bude 302
     * @param echo true pro tisk redirect zpravy echem
     * @param text redirect
     */
    public function redirect($url, $code = 302, $echo = true) {
      $kod = (is_null($code) ? 302 : $code);
      $this->setCode($kod);
      $this->setHeader('Location', $url);
      if ($echo) {
        echo '<h1>Redirect</h1><a href="'.htmlspecialchars($url).'">Pokud nefunguje presmerovani automaticky, tak zde klikni</a>';
      }
    }

    /**
     * nastaveni expirace hlavicek
     *
     * @param time cas kdy ma k expiraci dojit
     * @return this
     */
    public function setExpiration($time) {
      if (is_null($time) || !$time) {
        $this->setHeader('Cache-Control', 's-maxage=0, max-age=0, must-revalidate');
        $this->setHeader('Expires', 'Mon, 23 Jan 1978 10:00:00 GTM');
      }

      $time = DateAndTime::from($time);
      $this->setHeader('Cache-Control', 'max-age='.($time->format('U') - time()));
      $this->setHeader('Expires', self::date($time));
      return $this;
    }

    /**
     * kontroluje jestli uz byli hlaviky odeslany
     *
     * @return true kdyz byli hlavicky odeslany
     */
    public function isSent() {
      return headers_sent();
    }

    /**
     * vrati hodnotu konkretni http hlavicky
     *
     * @param header jmeno hlavicky
     * @param default defaultni hodnota
     * @return hodnota
     */
    public function getHeader($header, $default = null) {
      $headers = $this->getHeaders();
      return (!empty($headers[$header]) ? $headers[$header] : $default);
    }

    /**
     * vrati pole hlavicek na poslani
     *
     * @return pole hlavicek
     */
    public function getHeaders() {
      $result = null;
      $list = function($value, $key, $data) {
        $exp = explode(': ', $value);
        $data[$exp[0]] = $exp[1];
      };
      $headers = headers_list();
      array_walk($headers, $list, array(&$result));
      return $result;
    }

    /**
     * vraci validni http date format
     *
     * @param time vstupni datum v textu/cislu/DateTime
     * @return naformatovane datum
     */
    public static function date($time = null) {
      $time = DateAndTime::from($time);
      $time->setTimezone(new DateTimeZone('GMT'));
      return $time->format('D, d M Y H:i:s \G\M\T');
    }

    /**
     * nacteni cookie
     *
     * @param key klic
     * @param default defaultni hodnota
     * @return hodnota cookie
     */
    public function getCookie($key, $default = null) {
      return (isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default);
    }

    /**
     * nastaveni cookie
     *
     * @param name jmeno
     * @param value hodnota
     * @param time cas expirace
     * @param path cesta platnosti
     * @param domain domena
     * @param secure zabezpeceni
     * @param httpOnly prenaset po http
     * @return this
     */
    public function setCookie($name, $value, $time, $path = null, $domain = null, $secure = null, $httpOnly = null) {
      $this->checkHeadersSent();

      setcookie($name,
                $value,
                $time ? DateAndTime::from($time)->format('U') : 0,
                is_null($path) ? $this->response->cookiePath : (string) $path,
                is_null($domain) ? $this->response->cookieDomain : (string) $domain,
                is_null($secure) ? $this->response->cookieSecure : (bool) $secure,
                is_null($httpOnly) ? $this->response->cookieHttpOnly : (bool) $httpOnly
                );

      if (ini_get('suhosin.cookie.encrypt')) {
        return $this;
      }

      //nejaka++kontrola hlavicek?!

      return $this;
    }

    /**
     * smazani cookie
     *
     * @param name jmeno
     * @param path cesta platnosti
     * @param domain domena
     * @param secure zabezpeceni
     * @return this
     */
    public function deleteCookie($name, $path = null, $domain = null, $secure = null) {
      $this->setCookie($name, false, 0, $path, $domain, $secure);
      return $this;
    }
//TODO doaplikovat! via: http://laravel.com/docs/views
    //~ public static function download($path, $name = null, $headers = array()) {}
    //~ class Redirect extends Response {
    //~ public static function home($status = 302, $https = null) {}
    //~ public static function error($code, $data = array()) {}
  }

  class ExceptionResponse extends Exception {}

?>
