<?php
/*
 * lightstaticweb.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception,
      classes\Core,
      classes\Route;

  class LightStaticWeb {
    const VERSION = 1.52;

    private $web = null;

    /**
     * hlavni konstruktor
     *
     * @param routemodel povinny parametr, pole routovacich pravidel
     * @param defaulturi defaultni uri adresa (vztahuje se k [0] route modelu)
     */
    public function __construct(array $routemodel, $defaulturi = '') {
      if (empty($routemodel)) { //rez route modelu nema cenu pokracovat
        throw new ExceptionLightStaticWeb('route model must by defined!!');
      }

      $this->web = new stdClass;
      //vytvoreni routovani
      $route = new Route;
      $route->setRouteModel($routemodel)
            ->setDefaultUri($defaulturi);
      $this->web->route = $route;

      $this->configRoute();
    }

    /**
     * konfigurace tridy route
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
    public function setDefaultUri($uri) {  //nepovina metoda ne?
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
      return self::getCurrentPage();
    }

    /**
     * nacitani aktualni stranky podle adresy
     *
     * @param array vstupni pole pro pruchod, nepovinne
     * @param index hloubka aktualniho pruchodu, nepovinne
     * @return jmeno class tridy vyhledane podle url adresy
     */
    private function getCurrentPage($array = null, $index = 0) {
      if (empty($this->web->page)) {
        throw new ExceptionLightStaticWeb('doposud neni nactene menu! je nutne mit nastavenou metodu: ->setLoadMenu(array)');
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
        $result = self::getCurrentPage($result, $index + 1);
      }
      return $result;
    }

    /**
     * nacita data z vyhledane tridy
     *
     * @param select index pro nacitani metod z aktualni tridy (stranky)
     * @return obsah nacteny z konkretni stranky
     */
    private function getCurrentData($select) {
      $page = self::getCurrentPage();
      switch ($select) {
        case 'name':
          if (method_exists($page, 'getName')) {
            return $page::getName();
          } else {
            throw new ExceptionLightStaticWeb('neexistuje metoda: getName');
          }
        break;

        case 'js':
          if (method_exists($page, 'getJS')) {
            return $page::getJS();
          } else {
            throw new ExceptionLightStaticWeb('neexistuje metoda: getJS');
          }
        break;

        case 'css':
          if (method_exists($page, 'getCSS')) {
            return $page::getCSS();
          } else {
            throw new ExceptionLightStaticWeb('neexistuje metoda: getCSS');
          }
        break;

        case 'content':
          if (method_exists($page, 'getContent')) {
            return $page::getContent();
          } else {
            throw new ExceptionLightStaticWeb('neexistuje metoda: getContent');
          }
        break;
      }
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
      return Core::isNull(self::getCurrentData('name'), $name);
    }

    /**
     * rekurzivni kontrola existence polozek menu
     * url => 'namespace\pageclass'
     *
     * @param menu x-dimenzionalni pole s tvarem
     * @return pole existujicich stranek
     */
    private function checkMenuItem($menu) {
      $result = array();

      foreach ($menu as $url => $class) {
        if (!is_array($class)) {
          $result[$url] = $class;
          if (class_exists($class)) {
            $result[$url] = $class;
          } else {
            throw new ExceptionLightStaticWeb('trida stranky '.$class.' nebyla nalezena');
          }
        } else {
          $result[$url] = self::checkMenuItem($class);
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
      $this->web->page = self::checkMenuItem($arraymenu);
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
          $result += self::_getCountMenu($v);
        }
      }
      return $result;
    }

    /**
     * rekurzivni generovani menu
     *
     * @param skeleton pole callbacku: menu, obal
     * @param array vstupni pole menu, nepovinne
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
                                      'global' => self::_getCountMenu()),
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

          $r = self::_getMenu($skeleton, $class, $datas);

          $np = array('submenu' => $r);
          $nc = array_merge($np, $datas);

          //vykonani callback polozky obalu
          $result[] = $obal($nc);

          array_splice($datas['lasturl'], -1);  //odstranovani posledniho prvku
          $datas['level']--;  //snizovani zanoreni
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

      if (empty($skeleton)) {
        throw new ExceptionLightStaticWeb('neni definovane pole pro menu');
      }

      //if (!array_key_exists('obal', $skeleton)) {
      if (empty($skeleton['obal'])) {
        $skeleton['obal'] = function($row) { return implode('', $row['submenu']); };
      }

      if (!array_key_exists('menu', $skeleton)) {
        throw new ExceptionLightStaticWeb('neexistuje index pole: [menu]');
      }

      if (!is_callable($skeleton['menu'])) {
        throw new ExceptionLightStaticWeb('neni callback pro menu');
      }

      if (!is_callable($skeleton['obal'])) {
        throw new ExceptionLightStaticWeb('neni callback pro obal');
      }

      return self::_getMenu($skeleton);
    }
//TODO vypinat throw exception???
    /**
     * vraci obsah na aktualni strance
     *
     * @return obsah stranky
     */
    public function getContent() {
      return self::getCurrentData('content');
    }

    /**
     * vraci JS pro danou stranku
     *
     * @return js stranky
     */
    public function getJS() {
      return self::getCurrentData('js');
    }

    /**
     * vraci CSS pro danou stranku
     *
     * @return css stranky
     */
    public function getCSS() {
      return self::getCurrentData('css');
    }
  }

  class ExceptionLightStaticWeb extends Exception {}

?>
