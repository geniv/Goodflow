<?php
/*
 * cache.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * cachovani dat
   * -nova reimplementace
   * -output buffering je defaultne vypnuty!!
   * -pro usnadneni jsou tu tovarni metody
   *
   * @package stable
   * @author geniv
   * @version 4.16
   */
  final class Cache implements ICron {

    /** defaultni slozka */
    const DEFAULT_DIR = '.cache/';
    /** defaultni cas expirace */
    const DEFAULT_EXPIRE = '1 day';

    private $ob = false;
    private $exclude = array();
    private $enabled = false;
    private $prefix = null;
    private $request = null;
    private $dir = self::DEFAULT_DIR;
    private $expire = self::DEFAULT_EXPIRE;

    /**
     * defaultni konstruktor cache
     *
     * @since 3.02
     */
    public function __construct() {
      $this->request = Router::request();
    }

    /**
     * vytvoreni Cache s Output buffering
     * -tovarni metoda
     *
     * @since 3.94
     * @param void
     * @return Cache vytvorena instance
     */
    public static function OB() {
      $cache = new self;
      $cache->setOB(true);
      return $cache;
    }

    /**
     * vytvoreni Cache bez OB a s akceptaci prefixu
     * -tovarni metoda
     *
     * @since 3.90
     * @param string prefix textovy profix pro vicenasobne cachovani
     * @return Cache vytvorena instance
     */
    public static function Prefix($prefix = '') {
      $cache = new self;
      $cache->setPrefix($prefix);
      return $cache;
    }

    /**
     * vytvoreni Cache s Output buffering a akceptaci prefixu
     * -tovarni metoda
     *
     * @since 3.86
     * @param string prefix textovy profix pro vicenasobne cachovani
     * @return Cache vytvorena instance
     */
    public static function OBPrefix($prefix = '') {
      $cache = new self;
      $cache->setOB(true)->setPrefix($prefix);
      return $cache;
    }

    /**
     * nacteni pracovni slozky
     *
     * @since 3.62
     * @return string nazev slozky
     */
    public function getDir() {
      return $this->dir;
    }

    /**
     * nastaveni nazvu slozky
     *
     * @since 3.64
     * @param string _dir nazev slozky
     * @return this
     */
    public function setDir($_dir) {
      $this->dir = $_dir;
      return $this;
    }

    /**
     * nacteni casu expirace
     *
     * @since 3.54
     * @return string cas expirace
     */
    public function getExpiration() {
      return $this->expire;
    }

    /**
     * nastaveni casu expirace
     *
     * @since 3.54
     * @param string time cas expirace, bez znamenka
     * @return this
     */
    public function setExpiration($time) {
      $this->expire = $time;
      return $this;
    }

    /**
     * nacteni requestu
     *
     * @since 3.46
     * @return string text requestu
     */
    public function getRequest() {
      return $this->request;
    }

    /**
     * nastaveni request zdroje
     *
     * @since 3.44
     * @param string|null _request text requestu, null nastavi defaultni request z Router
     * @return this
     */
    public function setRequest($_request) {
      $this->request = ($_request ?: Router::request());
      return $this;
    }

    /**
     * nacteni jmena cache souboru
     *
     * @since 3.50
     * @return string jmeno souboru podle aktualniho requestu
     */
    public function getName() {
      return $this->prefix . basename($this->request) . '.' . md5($this->request);
    }

    /**
     * nacteni cele cesty cache souboru
     *
     * @since 4.12
     * @param void
     * @return string cely path dir + nazev
     */
    public function getPath() {
      return $this->dir . $this->getName();
    }

    /**
     * nacteni prefixu, pro vice instanci cache
     *
     * @since 3.40
     * @return string text prefixu
     */
    public function getPrefix() {
      return $this->prefix;
    }

    /**
     * nastaveni prefixu, pro vice instanci cache
     *
     * @since 3.40
     * @param string prefix text prefixu
     * @return this
     */
    public function setPrefix($prefix) {
      $this->prefix = $prefix;
      return $this;
    }

    /**
     * nastaveni stavu Output buffering
     *
     * @since 3.88
     * @param bool state true pro zapnuti OB
     * @return this
     */
    public function setOB($state) {
      $this->ob = $state;
      return $this;
    }

    /**
     * jde o output buffer?
     *
     * @since 3.20
     * @return bool true kdyz jde o output buffering
     */
    public function isOB() {
      return $this->ob;
    }

    /**
     * nacteni pole (uri) vyjmutych slozek
     *
     * @since 3.16
     * @return array pole vyjmutych uri adres
     */
    public function getExclude() {
      return $this->exclude;
    }

    /**
     * nastaveni pole (uri) vyjmutych slozek
     *
     * @since 3.02
     * @param array pole vyjmutych uri adres
     * @return this
     */
    public function setExclude($array) {
      $this->exclude = $array;
      return $this;
    }

    /**
     * je request v poli vyjimek?
     *
     * @since 3.64
     * @return bool true pokud je v poli exclude
     */
    private function inExclude() {
      return in_array($this->request, $this->exclude);
    }

    /**
     * je cache povolena?
     *
     * @since 3.12
     * @return bool true kdyz je povoleno
     */
    public function isEnabled() {
      return $this->enabled;
    }

    /**
     * aktivovani cache
     *
     * @since 3.06
     * @param bool enable true pro zapnuti cache
     * @return this
     */
    public function setEnabled($enable) {
      $this->enabled = $enable;
      return $this;
    }

    /**
     * je cachovano?
     *
     * @since 3.02
     * @return bool true kdyz je cachovano
     */
    public function isCached() {
      $result = false;

      if ($this->inExclude()) {
        $this->setEnabled(false);
      }

      if ($this->enabled) {
        $file = $this->getPath(); //$this->dir . $this->getName();
        if (file_exists($file)) {
          $result = filemtime($file) >= strtotime('-' . $this->expire);
        }
      }
      return $result;
    }

    /**
     * rucni obnova cache, pomoci modifikace modify casu
     * -cas expirace se posune  opet na zacatek
     *
     * @since 3.36
     * @return this
     */
    public function reload() {
      if ($this->enabled) {
        $file = $this->getPath(); //$this->dir . $this->getName();
        if (!touch($file)) {
          throw new ExceptionCache('Modification time is failure');
        }
      }
      return $this;
    }

    /**
     * nacteni casoveho razitka
     *
     * @since 3.98
     * @param string|null format text formatu datumu
     * @return int|null casove razitko
     */
    public function getModifyTime($format = null) {
      return Core::getFileModify($this->getPath(), $format);  //$this->dir . $this->getName()
    }

    /**
     * nacteni informaci o cache
     *
     * @since 3.36
     * @return string souhrne informace
     */
    public function getInfo() {
      $sum = Core::getCountListFile(array('path' => $this->dir,'sumsize' => true));
      //$this->dir . $this->getName()
      $result = '<br />
      state: <strong>' . ($this->enabled ? 'enabled' : 'disabled') . '</strong><br />
      isCached: <strong>' . ($this->isCached() ? 'cached' : 'no-cache') . '</strong><br />
      dir: <strong>' . $this->dir . '</strong><br />
      path: <strong>' . $this->getPath() . '</strong><br />
      name: <strong>' . $this->getName() . '</strong><br />
      size: <strong>' . Core::getFileSize($this->getPath()) . '</strong><br />
      modify: <strong>' . Core::getFileModify($this->getPath(), 'Y-m-d H:i:s') . '</strong><br />
      expire: <strong>' . $this->expire . '</strong><br />
      remain: <strong>' . $this->getRemainTime() . '</strong><br />
      elapse: <strong>' . $this->getElapsedTime() . '</strong><br />
      sum size in dir: <strong>' . $sum['calculatesum'] . '</strong><br />
      sum count files in dir: <strong>' . $sum['count'] . '</strong><br />';
      return $result;
    }

    /**
     * uplynuty cas
     *
     * @since 4.00
     * @param string format casovy format pro DateInterval
     * @return DateInterval|string rozdil pro uplynuty cas
     */
    public function getElapsedTime($format = '%Y-%m-%d %H:%i:%s') {
      $result = null;
      if ($this->enabled) {
        $diff = DateAndTime::different($this->getModifyTime());
        $result = ($format ? $diff->format($format) : $diff);
      }
      return $result;
    }

    /**
     * zbyvajici cas
     *
     * @since 4.00
     * @param string format casovy format pro DateInterval
     * @return DateInterval|string rozdil pro zbyvajici cas
     */
    public function getRemainTime($format = '%Y-%m-%d %H:%i:%s') {
      $result = null;
      if ($this->enabled) {
        $diff = DateAndTime::different($this->getModifyTime(), '-' . $this->expire);
        $result = ($format ? $diff->format($format) : $diff);
      }
      return $result;
    }

    /**
     * nacteni obsahu z cache, ze souboru
     *
     * @since 3.06
     * @return string obsah nacteny z cache
     */
    public function getContents() {
      $result = null;
      if ($this->enabled) {
        $file = $this->getPath(); //$this->dir . $this->getName();
        if (file_exists($file)) {
          $result = file_get_contents($file);
        }
      }
      return $result;
    }

    /**
     * zacatek bloku cachovani
     * -jen pro OB=true
     *
     * @since 3.08
     * @return this
     */
    public function start() {
      if ($this->enabled) {
        if ($this->ob) {
          if (!ob_start()) {
            throw new ExceptionCache('Turn on output buffering is failure');
          }
        }
      }
      return $this;
    }

    /**
     * konec bloku cachovani
     * -vzdy nutny, pri OB=false prijde obsah do parametru
     *
     * @since 3.08
     * @param string content rucne vlozeny obsah, pokud se nepouzije OB
     * @return this
     */
    public function end($content = null) {
      if ($this->enabled) {
        // pokud neexistuje slozka tak zaridi jeji vytvoreni
        if (!file_exists($this->dir)) {
          Core::generatePath($this->dir);
        }

        $file = $this->getPath(); //$this->dir . $this->getName();
        if ($this->ob) {  // pokud je OB
          file_put_contents($file, ob_get_contents());  // zapis OB
        } else {
          if (!is_null($content)) { // nesmi byt null
            file_put_contents($file, $content); // zapis z parametru
          }
        }
      }
      return $this;
    }

    /**
     * smazani konkterniho souboru z cache
     *
     * @since 3.24
     * @param string|null uri konkretni uri pro soubor
     * @return this
     */
    public function clear($uri = null) {
      if ($this->enabled) {
        // mazani aktualni cache nebo zadane z parametru
        $name = ($uri ?: $this->getName());
        $file = $this->dir . $name;
        if (file_exists($file)) {
          if (!@unlink($file)) {
            throw new ExceptionCache('does not unlink file');
          }
        }
      }
      return $this;
    }

    /**
     * smazani veskereho obsahu z cache
     *
     * @since 3.24
     * @param bool rmdir true smazani vcetne slozky
     * @return this
     */
    public function clearAll($rmdir = false) {
      if ($this->enabled) {
        $files = Core::getListFile(array('path' => $this->dir, 'full' => true));
        // prochazen souboru v adresari s cache
        foreach ($files as $file) {
          if (file_exists($file)) {
            if (!@unlink($file)) {
              throw new ExceptionCache('does not remove file');
            }
          }
        }
        // pokud se ma smazat i vcetne slozky
        if ($rmdir && file_exists($this->dir)) {
          if (!rmdir($this->dir)) {
            throw new ExceptionCache('does not remove dir');
          }
        }
      }
      return $this;
    }

    /**
     * synchronizacni metoda
     *
     * @since 3.02
     * @param array args pole konfigurace predavane z cronu
     * @return int pocet zpracovanych polozek
     */
    public static function synchronizeCron($args = array()) {
      $conf = array(
          'dir' => self::DEFAULT_DIR,
          'expire' => self::DEFAULT_EXPIRE,
      );
      $conf = array_merge($conf, $args);  // secteni konfigurace
      // nacteni pole souboru
      $list = Core::getListFile(array(
          'path' => $conf['dir'],
          'full' => true,
        ));
      return Core::cleanExpire($list, $conf['expire']);
    }
  }


  /**
   * trida vyjimky pro Cache
   *
   * @package stable
   * @author geniv
   * @version 1.00
   */
  class ExceptionCache extends \Exception {}