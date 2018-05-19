<?php
/*
 * menu.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * uloziste pro polozky menu
   *
   * @package stable
   * @author geniv
   * @version 5.10
   */
  class MenuRow extends ObjectArray {

    /**
     * obsahuje submenu?
     *
     * @since 5.00
     * @param void
     * @return bool true pokud ma submenu
     */
    public function hasMenu() {
      return is_array($this->menu);
    }

    /**
     * nacteni vygenerovaneho menu
     *
     * @since 5.06
     * @param void
     * @return array vygenerovane menu
     */
    public function getMenu() {
      $c = $this->__conf;
      $c['level']++;
      $c['last_exist'] = Menu::__existsMenu($c['uri_values'], $c['level'], $this->menu);
      return Menu::__generateMenu($this->menu, $c);
    }

    /**
     * nacteni indexu pole, pri cistem vypisu do textu
     *
     * @since 5.00
     * @param void
     * @return string text indexu
     */
    public function __toString() {
      return $this->name;
    }
  }


  /**
   * generator menu,
   * - TPL: implode('/', $menu->getActiveAddress())
   *
   * @package stable
   * @author geniv
   * @version 5.62
   */
  class Menu {
    private $layout = null;

    private $uri = null;
    private $uri_values = null;
    private $uri_default = null;

    private $weburl = null;
    private $default_page = null;
    private $auto_default_page = false;

    private $array_address = array();
    private $last_address = null;

    /**
     * defaultni konstruktor
     *
     * @since 5.00
     * @param array pole layoutu
     * @return void
     */
    public function __construct($_layout) {
      $this->layout = $_layout;
    }

    /**
     * jednoducha tovarni metoda na vytvoreni
     * -router($, '', 0, null)
     * -defaultPage($, true)
     * -webUrl($ ?: Core::getUrl())
     *
     * @since 5.54
     * @param array layout pole modelu menu
     * @param array|string model route model
     * @param string default_page defaultni stranka pri chybe nebo prazdne adrese
     * @param string url adresa pro pouziti v href, defaultne se nacita z Core
     * @return Menu vytvorena instance
     */
    public static function simple($layout, $model, $default_page, $url = null) {
      $menu = new self($layout);
      $menu->setRouter($model)
          ->setDefaultPage($default_page, true)
          ->setWebUrl($url ?: Core::getUrl());

      return $menu;
    }

    /**
     * nacitani pole layoutu
     *
     * @since 5.48
     * @param void
     * @return array pole layoutu menu
     */
    public function getLayout() {
      return $this->layout;
    }

    /**
     * nastaveni routeru
     *
     * @since 5.00
     * @param array|string routovaci pravidla (text nebo pole)
     * @param string default defaultni adresa v request zapisu
     * @param int from ciselny posun requestu, od zacatku
     * @param null|string request text predavan od serveru nebo manualne
     * @return this
     */
    public function setRouter($model, $default = '', $from = 0, $request = null) {
      $uri = Router::uri($model, $default, ($request ?: Router::request()), $from);
      $this->uri = $uri;
      $this->uri_values = array_values($uri);
      $this->uri_default = $default;
      return $this;
    }

    /**
     * nacitani uri routeru
     *
     * @since 5.46
     * @param void
     * @return array uri pole
     */
    public function getUri() {
      return $this->uri;
    }

    /**
     * nacitani defaultni request adresy routeru
     *
     * @since 5.46
     * @param void
     * @return string text defaultni adresy
     */
    public function getUriDefault() {
      return $this->uri_default;
    }

    /**
     * nacteni web url
     *
     * @since 5.40
     * @param void
     * @return string web url
     */
    public function getWebUrl() {
      return $this->weburl;
    }

    /**
     * nastaveni web url
     *
     * @since 5.16
     * @param string url bazova web url
     * @return this
     */
    public function setWebUrl($url) {
      $this->weburl = $url;
      return $this;
    }

    /**
     * nacitani defaultni stranky
     *
     * @since 5.50
     * @param void
     * @return string nazev edfaultni stranky
     */
    public function getDefaultPage() {
      return $this->default_page;
    }

    /**
     * nastaveni defaultni stranky defaultni uri s defaultni strankou
     * - zvlada oznacovat defaultni jen 0.levelu!
     *
     * @since 5.20
     * @param string page nazev defaultni stranky
     * @param bool auto zapinani oznacovani pokud je neexistujici stranka (spatna adresa), defaultne false
     * @return this
     */
    public function setDefaultPage($page, $auto = false) {
      $this->default_page = $page;
      $this->auto_default_page = $auto;
      return $this;
    }

    /**
     * nacitani stavu auto oznacovani
     *
     * @since 5.50
     * @param void
     * @return bool true pokud je zapnuto auto oznacovani
     */
    public function isAutoDefaultPage() {
      return $this->auto_default_page;
    }

    /**
     * interni pridavani do pole adres
     *
     * @since 5.28
     * @param string key nazev klice
     * @param string array pole predstavujici aktualni klic (nazev) polozky adresy
     * @return this
     */
    private function __addToAddress($key, $array) {
      $this->array_address[$key] = $array;
      $this->last_address = $key;
      return $this;
    }

    /**
     * interni pocitani polozek menu s akceptaci visible
     *
     * @since 5.40
     * @param array source zdrojove pole
     * @return int spravny pocet polozek v urovni
     */
    private static function __getCount($source) {
      $f = array_filter($source, function($item) {
        return (isset($item['visible']) ? $item['visible'] : true);
      });
      return count($f);
    }

    /**
     * existuje pozadovana polozka menu podle levelu v requestu?
     *
     * @since 5.42
     * @param array uri_values request pole
     * @param int level cislo levelu
     * @param array source pole ve kterem se hleda aktualni request
     * @return bool true pokud existuje polozka
     */
    public static function __existsMenu($uri_values, $level, $source) {
      return (isset($uri_values[$level]) && array_key_exists($uri_values[$level], $source));
    }

    /**
     * skryte staticke generovani menu
     *
     * @since 5.02
     * @param array source vstupni pole pro vygenerovani urovne menu
     * @param array __conf konfigurcni pole predavane mezi urovnemi
     * @return array vygenerovane menu
     */
    public static function __generateMenu($source, $__conf = array()) {
      $result = null;

      $th = $__conf['base_instance']; // nacteni hlavni instance
      $lasturl = $__conf['lasturl'];  // nacteni posledni url
      $level = $__conf['level'];  // nacteni cisl levelu

      if (!$__conf['last_exist']) {
        $__conf['possible_active'] = false; // ma cenu oznacovat ostatni polozky
      }

      $poc = 0;
      $count = self::__getCount($source);//count($source);
      foreach ($source as $page => $values) {

        $visible = (isset($values['visible']) ? $values['visible'] : true);
        $link = (isset($values['link']) ? $values['link'] : null);
        // pokud bude link vyslovene prazdny text
        if ($link === '') {
          $link = $__conf['weburl'];
        }

        $_lasturl = array_merge($lasturl, array($page));
        $__conf['lasturl'] = $_lasturl;

        $active = ($__conf['possible_active'] ? // pokud dana adresa existuje
            (isset($__conf['uri_values'][$level]) && $__conf['uri_values'][$level] === $page) // oznacovani pokud sedi request[level] s iterovanou adresou
              : // nebo
            ($__conf['uri_values'][0] == $__conf['uri_default'] && $__conf['default_page'] === $page) ||  // oznacovani pokud je adresa prazdna
            ($__conf['auto_default_page'] ? !$__conf['last_exist'] && $__conf['default_page'] === $page : false)  // oznacovani nezname adresy, pokud je zapnuto
        );

        $data = array(
            'url' => $page,
            'lasturl' => $_lasturl,
            'allurl' => ($link ?: $__conf['weburl'] . implode('/', $_lasturl)), //FIXME kdyz je potreba prazhnou url
            'visible' => $visible,
            'link' => $link,
            'active' => $active,
            'poc' => $poc,
            'count' => $count,
            'level' => $level,
            'js' => null,
            'css' => null,

            '__conf' => $__conf,
            );

        if ($active) {
          $a = $data;
          unset($a['__conf']);  // vyrazeni konfigurace pro celkove pole
          $th->__addToAddress($page, array_merge($a, $values));
        }

        if ($visible) {
          $result[] = new MenuRow(array_merge($data, $values));
          $poc++;
        }
      }
      return $result;
    }

    /**
     * generovani bazoveho hlavniho menu
     *
     * @since 5.02
     * @param void
     * @return array vygenerovane pole menu
     */
    public function getMenu() {
      $base_data = array(
          'level' => 0,
          'lasturl' => array(),
          'weburl' => $this->weburl,
          'uri' => $this->uri,
          'uri_values' => $this->uri_values,
          'uri_default' => $this->uri_default,
          'default_page' => $this->default_page,
          'auto_default_page' => $this->auto_default_page,
          'base_instance' => $this,

          'last_exist' => self::__existsMenu($this->uri_values, 0, $this->layout),
          'possible_active' => true,
          );
      return self::__generateMenu($this->layout, $base_data);
    }

    static $_last = null; // posledni polozka pri vynucenem iterovani

    /**
     * vnitrni metoda na kompletni proiterovani menu kvuli nacteni dat
     * - hlida vicenasobny pruchod
     *
     * @since 5.58
     * @param Menu menu instance menu na proiterovani
     * @return void
     */
    private function forceIterate($menu) {
      if (!array_key_exists(self::$_last, $this->array_address)) {
        foreach ($menu->getMenu() as $m) {
          if ($m->hasMenu()) {
            $this->forceIterate($m);
          }
        }
      }
      self::$_last = $this->last_address;
    }

    /**
     * nacteni titulku stranek
     *
     * @since 5.24
     * @param void
     * @return array pole cesta=>nazev
     */
    public function getNames() {
      $this->forceIterate($this);
      return array_map(function($item) {
          return $item['name'];
          }, $this->array_address);
    }

    /**
     * nacitani obsahu title stranek
     * - vnitrne si vynuti
     *
     * @since 5.58
     * @param string|null before
     * @param string|null after
     * @param bool show_defautl
     * @param string separator
     * @return string slozeny title
     */
    public function getTitle($before = null, $after = null, $show_defautl = true, $separator = ' - ') {
      $this->forceIterate($this);
      // nacteni nazvu
      $names = $this->getNames();
      if (!$show_defautl) {
        $address = $this->getActiveAddress();
        if ($address[0] === $this->default_page) {  // pokud prvni index === defaultni
          $names = array();
        }
      }
      // soucet pole
      $array_sum = array_merge(($before ? array($before) : array()), $names, ($after ? array($after) : array()));
      return implode($separator, $array_sum);
    }

    /**
     * nacitani uzivatelske promenne
     *
     * @since 5.36
     * @param string index textovy pro uzivatelskou promennou
     * @return string|array|null navratova hodnota podle daneho indexu
     */
    public function getVariable($index) {
      $this->forceIterate($this);
      return (isset($this->array_address[$this->last_address][$index]) ? $this->array_address[$this->last_address][$index] : null);
    }

    /**
     * nacitani pole ktere se generuje pri getMenu()
     *
     * @since 5.40
     * @param void
     * @return array pole generovane pri tvorbe menu
     */
    public function getArrayAddress() {
      $this->forceIterate($this);
      return $this->array_address;
    }

    /**
     * nacteni cele aktivni adresy
     *
     * @since 5.34
     * @param void
     * @return array pole aktivni adresy
     */
    public function getActiveAddress() {
      $this->forceIterate($this);
      return array_keys($this->array_address);
    }

    /**
     * nacteni posledni adresy ktera je oznacena
     *
     * @since 5.38
     * @param void
     * @return string nazev posledni aktivni sekce
     */
    public function getLastAddress() {
      $this->forceIterate($this);
      return $this->last_address;
    }

    /**
     * nacitani JS pro danou sekci
     *
     * @since 5.32
     * @param void
     * @return array pole js na nalinkovani
     */
    public function getJS() {
      $this->forceIterate($this);
      return (array) $this->array_address[$this->last_address]['js'];
    }

    /**
     * nacitani CSS pro danou sekci
     *
     * @since 5.32
     * @param void
     * @return array pole css na nalinkovani
     */
    public function getCSS() {
      $this->forceIterate($this);
      return (array) $this->array_address[$this->last_address]['css'];
    }
  }