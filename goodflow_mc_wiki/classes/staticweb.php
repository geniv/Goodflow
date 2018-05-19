<?php
/*
 * StaticWeb.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception,
      classes\Core,
      classes\Route;

  /**
   *
   * rozhranni pro stranky
   *
   */

  interface IPage {
    //const VERSION = 1.10;
    //const VISIBLE = true; //defaultne se bere ze je kazda stranka viditelna
    static function getName(); //jmeno a promenne stranky  +(moznost predavat parametr)
    //static function getJS(); //js  +(moznost predavat parametr)
    //static function getCSS(); //css  +(moznost predavat parametr)
    static function getContent(); //obsah stranky  +(moznost predavat parametr)
  }

  /**
   *
   * hlavni trida
   *
   */

  class StaticWeb {
    const VERSION = 2.10;

    private $web = null;

    /**
     * hlavni konstruktor
     *
     * @param routemodel array|Route() povinny parametr, pole routovacich pravidel
     * @param defaulturi defaultni uri adresa (vztahuje se k [0] route modelu)
     */
    public function __construct($routemodel, $defaulturi = '') {
      if (empty($routemodel)) { //bez route modelu nema cenu pokracovat
        throw new ExceptionStaticWeb('route model must by defined!!');
      }

      $this->web = new stdClass;
      $this->web->pageArray = array();

      //vytvoreni routovani (z parametru nebo )
      if ($routemodel instanceof Route) {
        $this->web->route = $routemodel;//->setDefaultUri($defaulturi)
      } else {
        $route = new Route;
        $route->setRouteModel($routemodel)  //pole pro routovani
              ->setDefaultUri($defaulturi); //defaultni cesta
        $this->web->route = $route;
      }

      $this->configRoute();
    }

    /**
     * rekonfigurace tridy route
     */
    private function configRoute() {
      //nacteni uri pole
      $this->web->uri = $this->web->route->getUri();
      //separace klicu uri pole
      $this->web->url = array_values($this->web->uri);
      //nacteni defaultni url
      $this->web->defaulturl = $this->web->route->getDefaultUrl();
    }

    /**
     * nacteni nastavene default uri
     *
     * @return defaultni uri z route
     */
    public function getDefaultUri() {
      return $this->web->route->getDefaultUri();
    }

    /**
     * dodatecne nastavovani defaultni uri route adresy
     *
     * @param uri text defaultni uri
     * @return this
     */
    public function setDefaultUri($uri) {
      $this->web->route->setDefaultUri($uri);
      $this->configRoute();
      return $this;
    }

    /**
     * nacteni aktualni request uri
     *
     * @return request uri text
     */
    public function getRequestUri() {
      return $this->web->route->getRequestUri();
    }

    /**
     * nataveni request uri, obejde se $_SERVER
     *
     * @param uri nova request uri
     * @return this
     */
    public function setRequestUri($uri) {
      $this->web->route->setRequestUri($uri);
      $this->configRoute();
      return $this;
    }

    /**
     * vraci aktualni uri pole adresy
     *
     * @return uri pole adresy
     */
    public function getUri() {
      return $this->web->uri;
    }

    /**
     * vrati aktualni tridu
     *
     * @return nazev tridy
     */
    public function getCurrentClass() {
      return $this->_getCurrentPage();  //TODO otesotvat jestli se nevola tride zbytecne vickrat!
    }

    /**
     * nacitani aktualni stranky podle adresy
     *
     * @param array vstupni pole pro pruchod, nepovinne
     * @param index hloubka aktualniho pruchodu, nepovinne
     * @return jmeno class tridy vyhledane podle url adresy
     */
    private function _getCurrentPage($array = null, $index = 0) {
      if (empty($this->web->page)) {
        throw new ExceptionStaticWeb('doposud neni nactene menu! je nutne mit nastavenou metodu: ->setLoadMenu(array)');
      }
      $i = Core::isFill($this->web->url, $index);
      //nacteni zdroje z page nebo z parametru
      $source = (!is_null($array) ? $array : $this->web->page);
      //vyhodnocovani nekorektni adresy
      if (!array_key_exists($i, $source)) {
        $i = Core::isFill($this->web->defaulturl, $index);
      }
      $result = Core::isFill($source, $i, null);
      //rekurzivni prochazeni stranek
      if (is_array($result)) {
        //vkladani do pole trid jen kdyz neni posledni
        if ((count($this->web->url) - 1) != $index) {
          $this->web->pageArray[] = $result[''];
        }
        $result = $this->_getCurrentPage($result, $index + 1);
      } else {
        //vkladani do pole trid posledni polozku
        $this->web->pageArray[] = $result;
      }
      return $result;
    }

    /**
     * nacita data z vyhledane tridy
     *
     * @param select index pro nacitani metod z aktualni tridy (stranky)
     * @return obsah nacteny z konkretni stranky
     */
    private function getCurrentData($select, $data = null) {
      $this->web->pageArray = array();
      $page = $this->_getCurrentPage();
      switch ($select) {
        case 'name':
          if (method_exists($page, 'getName')) {
            return $page::getName($data);
          } else {
            throw new ExceptionStaticWeb('neexistuje metoda: getName');
          }
        break;

        case 'js':
          if (method_exists($page, 'getJS')) {
            return $page::getJS($data);
          } else {
            throw new ExceptionStaticWeb('neexistuje metoda: getJS');
          }
        break;

        case 'css':
          if (method_exists($page, 'getCSS')) {
            return $page::getCSS($data);
          } else {
            throw new ExceptionStaticWeb('neexistuje metoda: getCSS');
          }
        break;

        case 'content':
          if (method_exists($page, 'getContent')) {
            return $page::getContent($data);
          } else {
            throw new ExceptionStaticWeb('neexistuje metoda: getContent');
          }
        break;
      }
    }

    /**
     * vrati pole aktivnich trid pres ktere prochazi aktualni adresa
     * metoda pro zpracovani v drobeckove navigaci
     *
     * @return pole aktualnich trid
     */
    public function getArrayClass() {
      $this->web->pageArray = array();
      $this->_getCurrentPage();
      return $this->web->pageArray;
    }

    /**
     * nacitani textu pro titulek
     *
     * @return text pro title
     */
    public function getTitle() {
      //TODO jeste pripadne oddelovac!! pri prazdne stance oddelat,
      //a pripadne i dat na volbu i index pole kdyby by mel byt title uplne jiny
      return Core::isNull(self::getCurrentData('name'), 'name');
    }

    /**
     * nacitani urcite promenne z aktualni tridy (stranky)
     *
     * @param name index polozky v metode getName
     * @return hodnota z pozadovaneho indexu
     */
    public function getVariable($name) {
      return Core::isNull($this->getCurrentData('name'), $name);
    }

    /**
     * rekurzivni kontrola existence polozek menu
     * url => 'namespace\pageclass'
     *
     * @param menu x-dimenzionalni pole s tvarem
     * @return pole existujicich stranek
     */
    private function _checkMenuItem($menu) {
      $result = array();
      foreach ($menu as $url => $class) {
        if (!is_array($class)) {
          $result[$url] = $class;
          if (class_exists($class)) {
            $result[$url] = $class;
          } else {
            throw new ExceptionStaticWeb('trida stranky '.$class.' nebyla nalezena');
          }
        } else {
          $result[$url] = $this->_checkMenuItem($class);
        }
      }
      return $result;
    }

    /**
     * nastavovani pole menu pro instanci
     * url => 'namespace\pageclass'
     *
     * @param arraymanu pozadavany tvar menu
     * @return this
     */
    public function setLoadMenu(array $arraymenu) {
      $this->web->page = $this->_checkMenuItem($arraymenu);
      return $this;
    }

    /**
     * rekurzivni pocitani polozek menu
     *
     * @param array vstupni pole, nepovinne
     * @return cislo polozek
     */
    private function _getCountMenu($array = null) {
      $source = (!is_null($array) ? $array : $this->web->page);
      $result = count($source) - 1;
      foreach ($source as $v) {
        if (is_array($v)) {
          $result += $this->_getCountMenu($v);
        }
      }
      return $result;
    }

    /**
     * rekurzivni generovani menu
     *
     * @param skeleton pole callbacku: menu, obal
     * @param array vstupni pole menu pri rekurzi, nepovinne
     * @param datas pruchozi data predavane pri rekurzi
     * @return vysledne menu
     */
    private function _getMenu($skeleton, $array = null, $datas = array()) {
      $result = array();

      if (empty($datas)) {
        $datas = array('level' => 0,
                      'lasturl' => array(),
                      'poc' => array('local' => array(),
                                    'global' => 0),
                      'count' => array('local' => array(),
                                      'global' => $this->_getCountMenu()),
                      );
      }

      $menu = $skeleton['menu'];
      $obal = $skeleton['obal'];

      $source = (!is_null($array) ? $array : $this->web->page);

      //pocitadla se prekryvaji bacha!!
      $datas['poc']['local'][$datas['level']] = 0;
      $datas['count']['local'][$datas['level']] = count($source) - 1;

      foreach ($source as $url => $class) {
        //var_dump($class, $url);
        $visible = (defined($class.'::VISIBLE') ? $class::VISIBLE : true);

        if ($visible) { //osetruje viditelnost bloku menu
          if (!is_array($class)) {
            $datas['poc']['global'] = self::$menupoc;

            self::$menupoc++; //globalni pocitadlo

            $n = (method_exists($class, 'getName') ? $class::getName() : array());

            $curr = $this->web->route->getRequestUri();
            $_url = implode('/', array_merge($datas['lasturl'], array($url)));

            $np = array('url' => $_url,
                      'active' => ($curr == $_url),
                      );
            $nc = array_merge($n, $np, $datas);

            //vykonani callback polozky menu
            $result[] = $menu($nc);
          } else {
            $datas['level']++;  //zvysovani zanoreni
            $datas['lasturl'][] = $url;  //pridavani adresy

            $r = $this->_getMenu($skeleton, $class, $datas);

            $np = array('submenu' => $r);
            $nc = array_merge($np, $datas);

            //vykonani callback polozky obalu
            $result[] = $obal($nc);

            array_splice($datas['lasturl'], -1);  //odstranovani posledniho prvku
            $datas['level']--;  //snizovani zanoreni
          }
        }
        $datas['poc']['local'][$datas['level']]++;  //lokalni pocitadlo
      }

      return $result;
    }

    private static $menupoc = 0;  //globalni staticke pocitadlo pro menu

    /**
     * vraci vygenerovane menu podle skeletonu
     * callback indexy: [obal], [menu]
     * [obal] je implicitne definovan
     *
     * @param skeleton pole callbacku podle kterych se ma menu vygenerovat
     * @return vygenerovane menu
     */
    public function getMenu(array $skeleton) {
      self::$menupoc = 0;
      //musi byt definovan page
      if (empty($this->web->page)) {
        throw new ExceptionStaticWeb('neni definovane menu');
      }
      //musi byt definovan skeleton
      if (empty($skeleton)) {
        throw new ExceptionStaticWeb('neni definovane pole pro menu');
      }

      //pokud neexistuje index ['obal'] pouzije se defaultni callback
      if (empty($skeleton['obal'])) {
        $skeleton['obal'] = function($row) { return implode('', $row['submenu']); };
      }

      //musi existovat index ['menu']
      if (empty($skeleton['menu'])) {
        throw new ExceptionStaticWeb('neexistuje index pole: [menu]');
      }

      //['obal'] musi byt callable
      if (!is_callable($skeleton['obal'])) {
        throw new ExceptionStaticWeb('neni callback pro obal');
      }

      //['menu'] musi byt callable
      if (!is_callable($skeleton['menu'])) {
        throw new ExceptionStaticWeb('neni callback pro menu');
      }
      return $this->_getMenu($skeleton);
    }
//TODO vypinat throw exception???
    /**
     * vraci obsah na aktualni strance
     *
     * @return obsah stranky
     */
    public function getContent($data = null) {
      return $this->getCurrentData('content', $data);
    }

    /**
     * vraci JS pro danou stranku
     *
     * @return js stranky
     */
    public function getJS($data = null) {
      return $this->getCurrentData('js', $data);
    }

    /**
     * vraci CSS pro danou stranku
     *
     * @return css stranky
     */
    public function getCSS($data = null) {
      return $this->getCurrentData('css', $data);
    }
  }

  class ExceptionStaticWeb extends Exception {}

?>
