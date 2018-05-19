<?php
  /**
   * Modul hlavniho jadra, funkce pro vseobecnou praci
   * @class Core
   * @author geniv
   * @copyright 2011 geniv "geniv.radek@gmail.com"
   */
  final class Core {
    //minimal version for php5
    const PHPMIN = '5.3.0';

    //promena pro mereni casu
    private static $worktime;

/* //TODO zahrnout do testu!!!!
$ext = get_loaded_extensions();
* var_dump(get_loaded_extensions());
$a = array('gettext', 'session', 'SimpleXML');
var_dump($ext); - jen do tech baliku kde je to potreba!
* => extension_loaded ( string $name )
*/

    /**
     * Load absolute web page adress
     *
     * @method public static getAbsoluteUrl
     *
     * @param array query array url
     * @param array settings array settings, rewrite(boolean), amp(string)
     * @return string adress web page
     */
    public static function getAbsoluteUrl($query = array(), array $settings = array()) {
      $path = dirname($_SERVER['SCRIPT_NAME']);
      $rewrite = self::isFill($settings, 'rewrite', false);
      $link_path = self::isFill($settings, 'path', '');
      $amp = self::isFill($settings, 'amp', '&amp;');
      $end = (!empty($query) ?
                  ($rewrite ? sprintf('/%s', implode($amp, $query))
                  : sprintf('?%s', http_build_query(($rewrite ? array_values($query) : $query), NULL, $amp)))
              : NULL);
      return sprintf('http://%s%s/%s%s', $_SERVER['SERVER_NAME'], ($path != '/' ? $path : ''), $link_path, $end);
    }

    /**
     * Nacitani cesty stranek
     *
     * @method public static getWebPath
     *
     * @return string cesta stranek
     */
    public static function getWebPath() {
      return dirname($_SERVER['SCRIPT_FILENAME']);  //to same jako __DIR__ ???
    }

    /**
     * Vypocet prevodu velikosti
     *
     * @method public static calculateSize
     * @param integer size cislo velikosti pro prevod
     * @return string prevedena velikost
     */
    public static function calculateSize($size) {
      $exp = 0;
      $converted = 0;
      //nadefinovane symboly
      $symbol = array('b', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
      //pokud je velikost > 0
      if ($size > 0) {
        //vypocet exponentu
        $exp = floor(log($size) / log(1024));
        //vypocet vysledne hodnoty
        $converted = ($size / pow(1024, floor($exp)));
      }

      return sprintf(($exp == 0 ? '%d %s' : '%.2f %s'), $converted, $symbol[$exp]);
    }

    /**
     * Getter of cookie
     *
     * @method public static getCookie
     *
     * @param string name name cookie index
     * @return string value of index
     */
    public static function getCookie($name) {
      return self::isFill($_COOKIE, $name);
    }

    public static function setCookie($name, $value, $deltatime = 31536000) {
      setcookie($name, $value, Time() + $deltatime);
    }

    public static function unsetCookie($name, $deltatime = 31536000) {
      setcookie($name, '', Time() - $deltatime);
    }

    public static function initSession($name = NULL) {
      session_start();  //TODO ma tehdenci nekdy zlobit!!!
      if (!empty($name)) {
        session_name($name);
      }
    }

    /**
     * Vytvari mezery v cisle, po tisicech
     *
     * @method public static getSpaceNumber
     *
     * @param int cislo vstupni cislo
     * @param string desetinne char
     * @param string mezera char
     * @return int string with space
     */
    public static function getSpaceNumber($cislo, $desetinna = '.', $mezera = ' ') {
      return number_format($cislo, 0, $desetinna, $mezera);
    }
  }

  class ExceptionCore extends Exception {}

?>
