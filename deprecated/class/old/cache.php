<?php
/*
 * cache.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * trida obsluhujici cachovani
 * obsahuje: ob(true) a vlastni implementaci
 */

  namespace classes;

  /**
   * trida zajistujici cachovani dat nebo stdout vystupu
   *
   * @deprecated
   * @package unstable
   * @author geniv
   * @version 2.62
   */
  final class Cache {

    private $ob = null;
    private $expire = '1 day';  // expirovat po
    private $dir = '.cache';  // slozka pro cache
    private $exclude = array(); // ignorovane uri
    private $enabled = false; // stav cachovani
    private $prefix = null; // prefix pro cache soubory

    /**
     * konstruktor cache
     * (prefixy jsou uzitelne jen tehdy pokud se cachuje od jedne slozky)
     *
     * @param prefix predpona pro vice instanci cache
     */
    public function __construct($prefix = '') {
      $this->cache = new \stdClass;
      $this->cache->ob = true;  //defaultni zapnuty output buffering
      $this->cache->expire = '1 day'; //defaultni expirace
      $this->cache->dir = '.cache'; //defaultni slozka
      $this->cache->exception = array();
      $this->cache->enable = false; //defaultni vypnute
      $this->cache->prefix = $prefix;

      $this->cache->pathDir = $this->getCachePathDir();
      $this->cache->pathName = $this->getCachePathName();
    }

    /**
     * nacteni stavu output bufferingu
     *
     * @return vrati true pokud je ob zapnuty
     */
    public function getOutputBuffering() {
      return $this->cache->ob;
    }

    /**
     * nastaveni stabu output bufferingu
     *
     * @param state true pro zapnuti
     * @return this
     */
    public function setOutputBuffering($state) {
      $this->cache->ob = $state;
      return $this;
    }

    /**
     * vraci cas expirace obsahu
     *
     * @return timestamp cas uchovani
     */
    public function getCacheExpire() {
      return $this->cache->expire;
    }

    /**
     * nastaveni expirace cache
     *
     * @param expire cas po ktere ma expirovat mezi pamet
     * @return this
     */
    public function setCacheExpire($expire) {
      if (!empty($expire)) {
        $this->cache->expire = $expire;
      }
      return $this;
    }

    /**
     * vraci pole vyjimek u kterych se nema cache aceptovat
     *
     * @return pole uri adres
     */
    public function getExceptionUri() {
      return $this->cache->exception;
    }

    /**
     * nactavuje pole vyjimek u kterych se necachuje
     *
     * @param uri pole relativnich uri adres
     * @return this
     */
    public function setExceptionUri(array $uri) {
      if (!empty($uri)) {
        $this->cache->exception = $uri;
      }
      return $this;
    }

    /**
     * vyprazdneni pole vyjimek
     *
     * @return this
     */
    public function clearExceptionUri() {
      $this->cache->exception = array();
      return $this;
    }

    /**
     * overeni jestli je adresa ve vyjimkach
     * (dotaz rovnou do Route)
     *
     * @return vratu true pokud je adresa ve vyjimce
     */
    private function inException() {
      $sub = Route::getRequest(); //classes\Route
      return in_array($sub, $this->cache->exception); //hleda aktualni uri uvnitr pole vyjimek
    }

    /**
     * vraci adresar cache
     *
     * @return nazev adresare
     */
    public function getCacheDir() {
      return $this->cache->dir;
    }

    /**
     * nastavovani cache adresare
     *
     * @param dir novy adresar pro cache
     * @return this
     */
    public function setCacheDir($dir) {
      if (!empty($dir)) {
        $this->cache->dir = $dir;
      }
      return $this;
    }

    /**
     * absolutni cesta ke skripru
     *
     * @return path skriptu
     */
    private function getCachePath() {
      return dirname($_SERVER['SCRIPT_FILENAME']);
    }

    /**
     * kodovane jmeno cache souboru
     * prefix.uri.hash
     *
     * @return jmeno cache souboru
     */
    private function getCacheName($uri = null) {
      $uri = (isset($uri) ? $uri : $_SERVER['REQUEST_URI']);
      $hash = md5($uri); //nebude akceptovat addr, protoze by zbytecne rostla cache
      return $this->cache->prefix.basename($uri).'.'.$hash;
    }

    /**
     * plna cesta k adresari cache
     *
     * @return cesta k adresari
     */
    public function getCachePathDir() {
      return sprintf('%s/%s', $this->getCachePath(), $this->cache->dir);
    }

    /**
     * plna cesta k adresari cache se jmenem konkterniho souboru
     *
     * @return cesta k souboru v adresari
     */
    public function getCachePathName() {
      return sprintf('%s/%s', $this->cache->pathDir, $this->getCacheName());
    }

    /**
     * vrati stav cache
     *
     * @return boolean, pokud je cache aktivni vraci true
     */
    public function isCache() {
      return $this->cache->enable;
    }

    /**
     * zapinani cache
     *
     * @param enabled true zapne cachovani, default true
     * @return this
     */
    public function setCache($state = true) {
      $this->cache->enable = $state;
      return $this;
    }

    /**
     * predpona pro ruzne instance cache
     *
     * @return nastaveny prefix
     */
    public function getPrefix() {
      return $this->cache->prefix;
    }

    /**
     * nastaveni predpony pro ruzne instance cache
     *
     * @param prefix nazev prefixu
     * @return this
     */
    public function setPrefix($prefix) {
      if (!is_null($prefix)) {
        $this->cache->prefix = $prefix;
      }
      return $this;
    }

    /**
     * inicializace output buffer
     * pozn.: vklada se pred echo
     *
     * ->initOutBuff();
     * $cont = "any content";
     */
    public function initOutBuff() {
      if ($this->cache->enable) {
        if ($this->cache->ob) {
          if (!ob_start()) {
            throw new ExceptionCache('nepodarilo se nastartovat output buffering');
          }
        }
      }
    }

    /**
     * cteni obsahu z cache, alias pro getCacheContent()
     * echo ->getOutBuff();
     *
     * ob = true
     *
     * @return cachovany obsah
     */
    public function getOutBuff() {
      return $this->getCacheContent();
    }

    /**
     * zapis obsahu output buffer do souboru
     * echo $const;
     * ->setOutBuff();
     *
     * ob = true
     *
     * pozn.: vklada se za echo
     */
    public function setOutBuff() {
      if ($this->cache->enable && $this->cache->ob) {
        $cachedir = $this->cache->pathDir;
        //pokud path neexistuje, vytvori se
        if (!file_exists($cachedir)) {
          Core::generatePath($cachedir);
        }

        $cachefile = $this->cache->pathName;
//TODO v idealnim pripade by se mela cache brat dle obsahu stranky ne podle modifikovatelne adresy!!!!
        //overeni existence slozky
        if (file_exists($cachedir)) {
          file_put_contents($cachefile, ob_get_contents());  //ob_get_contents();/ob_get_clean()
          //~ ob_end_flush(); //zaslani cache
        }
      }
    }

    /**
     * overovani jestli je obsah nacachovany
     * if (->isCached())
     *
     * @return boolean
     */
    public function isCached() {
      $result = false;
      if ($this->inException()) {
        //pokud je ve vyjimce tak vypina cache
        $this->setCache(false);
      } else {
        //pokud neni ve vyjimce cachuje
        if ($this->cache->enable) {
          $cachepath = $this->cache->pathName;
          if (file_exists($cachepath)) {
            $result = (filemtime($cachepath) >= strtotime(sprintf('-%s', $this->cache->expire)));
          }
        }
      }
      return $result;
    }

    /**
     * uplynuty cas od posledniho cache
     *
     * @return datetime object
     */
    public function getElapseTime() {
      $result = null;
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathName;
        $mtime = Core::getFileModify($cachepath);
        if (!is_null($mtime)) {
          $fil = new \DateTime('@'.$mtime);
          $cur = new \DateTime();
          $result = $fil->diff($cur);
        } else {
          $result = new \DateTime;
        }
      }
      return $result;
    }

    /**
     * zbyvajici cas do dalsi cache
     *
     * @return datetime object
     */
    public function getRemainTime() {
      $result = null;
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathName;
        $mtime = Core::getFileModify($cachepath);
        if (!is_null($mtime)) {
          $fil = new \DateTime('@'.$mtime);
          $exp = new \DateTime('-'.$this->cache->expire);
          $result = $fil->diff($exp);
        } else {
          $result = new \DateTime;
        }
      }
      return $result;
    }

    /**
     * vraci informace o aktualni cache
     *
     * @return informace o cache
     */
    public function getCacheInfo() {
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathName;
        $path = $this->cache->pathDir;
        $files = Core::getCountListFile(array('path' => $path,'sumsize' => true));

        $result = sprintf('cache: <strong>enable</strong><br />
cache path: <strong>%s</strong><br />
cache dir: <strong>%s</strong><br />
cache name: <strong>%s</strong><br />
current cache name: <strong>%s</strong><br />
current cache size: <strong>%s</strong><br />
current cache modify: <strong>%s</strong><br />
summary cache size: <strong>%s</strong><br />
expire time: <strong>%s</strong><br />
remain time: <strong>%s</strong><br />
elapse time: <strong>%s</strong>',
        $this->getCachePath(),
        $this->cache->dir,
        $this->getCacheName(),
        $cachepath,
        Core::getFileSize($cachepath),
        Core::getFileModify($cachepath, 'Y-m-d H:i:s'),
        $files['calculatesum'],
        $this->cache->expire,
        $this->getRemainTime()->format('%Y-%m-%d %H:%i:%s'),
        $this->getElapseTime()->format('%Y-%m-%d %H:%i:%s'));
      } else {
        $result = 'cache: <strong>disable</strong>';
      }
      return $result;
    }

    /**
     * pozmeni mtime a tim donuti automatiku o reload
     */
    public function reloadCache() {
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathName;
        if (!touch($cachepath)) {
          throw new ExceptionCache('nelze modifikovat soubor!');
        }
      }
    }

    /**
     * vymaze aktualni cache soubor
     */
    public function clearCache() {
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathName;
        if (@!unlink($cachepath)) { //preneseni chybi na exception
          throw new ExceptionCache('nelze smazat soubor!');
        }
      }
    }

    /**
     * vymaze veskere soubory z cache
     */
    public function clearAllCache($rmdir = false) {
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathDir;
        $files = Core::getListFile(array('path' => $cachepath));
        if ($files) { //pokud obsahuje nejake soubory
          //smazani souboru
          foreach ($files as $fil) {
            if (!unlink(sprintf('%s/%s', $cachepath, $fil))) {
              throw new ExceptionCache('nelze smazat jeden ze souboru!');
            }
          }
        }

        if ($rmdir) { //pokud je povolene mazani samotne slozky cache
          //smazani slozky
          if (!rmdir($cachepath)) {
            throw new ExceptionCache('nelze smazat adresar cache!');
          }
        }
      }
    }

    public function clear($name) {
      //TODO metodu na mazani konkterni cache!!!a vytvareni .map
    }
//TODO cron metodu na cisteni diferentniho obsahu!!!!
    /**
     * vraceni nacachovaneho obsahu
     * echo ->getCacheContent()
     *
     * @return nacachovany obsah
     */
    public function getCacheContent() {
      $result = null;
      if ($this->cache->enable) {
        $cachepath = $this->cache->pathName;
        if (file_exists($cachepath)) {
          $result = file_get_contents($cachepath);
        }
      }
      return $result;
    }

    /**
     * nastavovani cache obsahu
     * pozn.: vklada se pred echo, obsah jde prvni do promenne a
     * pak do cache a z ni az nakonec echo
     *
     * $cont = "any content";
     * ->setCacheContent($cont);
     * echo $cont;
     *
     * ob = false
     *
     * @param content data ktera se maji nacachovat
     */
    public function setCacheContent($content) {
      if ($this->cache->enable) {
        $cachedir = $this->cache->pathDir;
        //pokud path neexistuje, vytvori se
        if (!file_exists($cachedir)) {
          Core::generatePath($cachedir);
        }

        $cachefile = $this->cache->pathName;
        //overeni existence slozky
        if (file_exists($cachedir)) {
          if (!is_null($content)) {
            file_put_contents($cachefile, strval($content));
          }
        }
      }
    }
  }


  /**
   * trida vyjimky pro Cache
   *
   * @package unstable
   * @author geniv
   * @version 1.00
   */
  class ExceptionCache extends \Exception {}