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
   * - TPL modularnejsi reseni: $menu->getTplAddress($, $)
   *
   * @package stable
   * @author geniv
   * @version 5.84
   */
  class Menu {
    private $layout = null;

    private $uri = null;  // key-value uri
    private $uri_values = null; // hodnoty z uri
    private $uri_default = null;  // defaultni uri

    private $weburl = null;
    private $default_page = null; // defaultni stranka
    private $auto_default_page = false; // atomaticka defaultni stranka

    private $array_address = array(); // pole aktivnich adres
    private $last_address = null; // posledni aktivni adresa

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
     * -router($, '', $, null)
     * -defaultPage($, true)
     * -webUrl($ ?: Core::getUrl())
     *
     * @since 5.54
     * @param array layout pole modelu menu
     * @param array|string model route model
     * @param string default_page defaultni stranka pri chybe nebo prazdne adrese, bud: home nebo home/sekce
     * @param string url adresa pro pouziti v href, defaultne se nacita z Core
     * @param int from ciselny posun requestu, od zacatku
     * @return Menu vytvorena instance
     */
    public static function simple($layout, $model, $default_page = '', $url = null, $from = 0) {
      $menu = new self($layout);
      $menu->setRouter($model, '', $from)
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
     * @param string page nazev defaultni stranky, bud home nebo home/sekce
     * @param bool auto zapinani oznacovani pokud je neexistujici stranka (spatna adresa), defaultne false
     * @return this
     */
    public function setDefaultPage($page, $auto = false) {
      $this->default_page = explode('/', $page);
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
      $result = array();

      $th = $__conf['base_instance']; // nacteni hlavni instance
      $lasturl = $__conf['lasturl'];  // nacteni posledni url
      $level = $__conf['level'];  // nacteni cisl levelu

      //~ if (!$__conf['last_exist']) {
        //~ $__conf['possible_active'] = false; // ma cenu oznacovat ostatni polozky
      //~ }

      $poc = 0;
      $count = self::__getCount($source);
      foreach ($source as $page => $values) {

        $visible = (isset($values['visible']) ? $values['visible'] : true);
        $link = (isset($values['link']) ? $values['link'] : null);
        // pokud bude link vyslovene prazdny text
        if ($link === '') {
          $link = $__conf['weburl'];
        }

        $_lasturl = array_merge($lasturl, array($page));
        $__conf['lasturl'] = $_lasturl;


        $active = (array_slice($__conf['uri_values'], 0, $level + 1) === array_slice($_lasturl, 0, $level + 1)) ||
            (isset($__conf['uri_values'][0]) && $__conf['uri_values'][0] == $__conf['uri_default'] && array_slice($__conf['default_page'], 0, $level + 1) === array_slice($_lasturl, 0, $level + 1)) ||
            ($__conf['auto_default_page'] ? !$__conf['last_exist'] && array_slice($__conf['default_page'], 0, $level + 1) === array_slice($_lasturl, 0, $level + 1) : false);

        $data = array(
            'url' => $page,
            'lasturl' => $_lasturl,
            'allurl' => ($link ?: $__conf['weburl'] . implode('/', $_lasturl)), //FIXME kdyz je potreba prazhnou url, poladit ve vice urovnovem menu!!!
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
          //~ 'possible_active' => true,
          );
      return self::__generateMenu($this->layout, $base_data);
    }

    /**
     * vnitrni metoda na kompletni proiterovani menu kvuli nacteni dat
     * - nehlida vicenasobny pruchod (kvuli odstranene statice)
     *
     * @since 5.58
     * @param Menu menu instance menu na proiterovani
     * @return void
     */
    private function forceIterate($menu) {
      foreach ($menu->getMenu() as $m) {
        if ($m->hasMenu()) {
          $this->forceIterate($m);
        }
      }
    }

    /**
     * nacteni titulku stranek
     * - pole aktualni cesty
     *
     * @since 5.24
     * @param string index index
     * @return array pole cesta=>nazev
     */
    public function getNames($index = 'name') {
      $this->forceIterate($this);
      return array_map(function($item) use ($index) {
          return $item[$index];
        }, $this->array_address);
    }

    /**
     * nacitani a generovani title pro stranky
     * - vnitrne vytahuje data
     *
     * @since 5.66
     * @param array configure pole konfigurace
     * @return string seskladany title
     */
    public function getTitle($configure = null) {
      $before = isset($configure['before']) ? $configure['before'] : null;
      $after = isset($configure['after']) ? $configure['after'] : null;
      $source = isset($configure['source']) ? $configure['source'] : $this->getNames();
      $separator = isset($configure['separator']) ? $configure['separator'] : ' - ';
      $show_default = isset($configure['show_default']) ? $configure['show_default'] : true;
      $address = $this->getActiveAddress();
      $names = array();
      foreach ($address as $url) {
        $names[] = isset($source[$url]) ? $source[$url] : null;
      }
      if (!$show_default) {
        if ($address[0] === $this->default_page[0]) {  // pokud prvni index === defaultni
          $names = array();
        }
      }

      // uprava na pole
      $before = is_string($before) ? array($before) : $before;
      $after = is_string($after) ? array($after) : $after;

      $array_sum = array_filter(array_merge($before, $names, $after));
      return implode($separator, $array_sum);
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
     * nacteni adresy pro include v TPL
     *
     * @since 5.64
     * @param string|null separator oddelovac pri skladani adresy
     * @param array|null extras pole pridavnych adres pro pripadne dozamereni tpl
     * @return string sloucene pole adresy pro prime adresovani
     */
    public function getTplAddress($separator = null, $extras = null) {
      $_separator = $separator ?: '/';
      $source = $this->getActiveAddress();
      if ($extras) {
        $source = array_merge($source, $extras);
      }
      return implode($_separator, $source);
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
     * vnitrni nacteni pole z uzivatelem definovane promenne
     * - rekurzivne scita
     *
     * @since 5.78
     * @param string var promenna se kterou se ma pracovat
     * @param string|null section eventualni rozdeleni na sekce
     * @param bool inherit true pro aktivaci dedeni v submenu, false pro pouhe nacteni v konkretni sekci
     * @return array vystupni zpracovane pole
     */
    private function _getVar($var, $section, $inherit) {
      $this->forceIterate($this);
      $result = array();
      if ($inherit) {
        $all = array_map(function($v) use ($var) {
          return $v[$var];
        }, $this->array_address);
        foreach ($all as $v) {  // projitit urovni
          if ($v) {
            $result = array_merge_recursive($result, (array) $v);
          }
        }
      } else {
        if (isset($this->array_address[$this->last_address]) && isset($this->array_address[$this->last_address][$var])) {
          $result = (array) $this->array_address[$this->last_address][$var];
        } else {
          $result = null;
        }
      }
      return $section ? (is_array($result) && isset($result[$section]) ? $result[$section] : null) : $result;
    }

    /**
     * nacitani uzivatelske promenne (promennych jako getCSS a getJS)
     * - jen jedne promenne
     *
     * @since 5.80
     * @param string index textovy pro uzivatelskou promennou
     * @param string|null section eventualni rozdeleni na sekce
     * @param bool inherit true pro aktivaci dedeni v submenu, false pro pouhe nacteni v konkretni sekci
     * @return array|string vystupni pole nebo text (pri 1 polozce)
     */
    public function getVariable($index, $section = null, $inherit = false) {
      $res = $this->_getVar($index, $section, $inherit);
      if (is_array($res) && count($res) == 1) { // pri jedne polozce vraci samotnou polozku
        $res = $res[0];
      }
      return $res;
    }

    /**
     * nacitani JS pro danou sekci
     * - podporuje sekce
     *
     * @since 5.32
     * @param string|null section eventualni rozdeleni na sekce
     * @param bool inherit true pro aktivaci dedeni v submenu, false pro pouhe nacteni v konkretni sekci
     * @return array pole js na nalinkovani
     */
    public function getJS($section = null, $inherit = false) {
      return $this->_getVar('js', $section, $inherit);
    }

    /**
     * nacitani CSS pro danou sekci
     * - podporuje sekce
     *
     * @since 5.32
     * @param string|null section eventualni rozdeleni na sekce
     * @param bool inherit true pro aktivaci dedeni v submenu, false pro pouhe nacteni v konkretni sekci
     * @return array pole css na nalinkovani
     */
    public function getCSS($section = null, $inherit = false) {
      return $this->_getVar('css', $section, $inherit);
    }
  }