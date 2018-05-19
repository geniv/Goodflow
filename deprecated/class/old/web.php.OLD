<?php
/*
 * web.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   *
   * bazova abstraktni trida pro tridu web
   *
   * je nutne dodrzovat implementaci: classes\IPage
   */
//TODO dopsat testy
  abstract class BaseWeb {
    const VERSION = 1.40;

    protected $pages = array(); // pole stranek z konfigurace
    protected $userdata = array();  // uzivatelske data k vykreslovani
    protected $route = null, $uri = null, $url = null, $default_uri = null; // route
    protected $active_classes = array();  // pole trid kres ktere prochazi aktivita

    /**
     * hlavni konstruktor
     *
     * @param layout pole menu layoutu
     * @param userdata pole user dat
     */
    public function __construct($layout = null, array $userdata = null) {
      $this->setMenuLayout((array) $layout)
           ->setUserData($userdata);
    }

    /**
     * vraceni pole menu layoutu
     *
     * @return pole menu layoutu
     */
    public function getMenuLayout() {
      return $this->pages;
    }

    /**
     * nastavovani menu layoutu
     *
     * @param layout pole menu layoutu
     * @return this
     */
    public function setMenuLayout(array $layout = null) {
      if (!is_null($layout) && is_array($layout)) {
        $this->pages = $layout;
      }
      return $this;
    }

    /**
     * vraceni user dat
     *
     * @return pole menu layoutu
     */
    public function getUserData() {
      return $this->userdata;
    }

    /**
     * nastavovani (pridavani) user dat predavane pri generovani menu
     *
     * @param data pole user dat
     * @return this
     */
    public function setUserData(array $data = null) {
      if (!is_null($data) && is_array($data)) {
        $this->userdata += $data;
      }
      return $this;
    }

    /**
     * vraceni instance routovace
     *
     * @return instance routovace
     */
    public function getRoute() {
      return $this->route;
    }

    /**
     * nastavovani interniho routovace
     *
     * @param model pole route modelu
     * @param default_uri defaultni uri pro menu, defaultne ''
     * @param from pocatecni index pro routovac, defaultne 0
     * @return this
     */
    public function setRoute(array $model, $default_uri = '', $from = 0) {
      //vytvari instanci route
      $this->route = new Route;
      $this->route->setDefaultUri($default_uri);

      $this->uri = $this->route->getUri($model, $from);
      $this->url = array_values($this->uri);
      $this->default_uri = $default_uri;
      return $this;
    }

    /**
     * interni rekurzivni aplikovani vlastniho submenu
     *
     * @param source zdrojove pole
     * @param data data predavana az na uroven metody getSubmenu
     * @return rozsirene pole source o submenu
     */
    private function __applySelfSubmenu($source, $data) {
      $result = array();
      foreach ($source as $url => $class) {
        if (is_array($class)) {
          $result[$url] = $this->__applySelfSubmenu($class, $data);
        } else {
          $result[$url] = $class;
          $submenu = (method_exists($class, 'getSubmenu') ? $class::getSubmenu($data) : null);
          // pokud jsou data tak je pricte za aktualniho pole
          if (isset($submenu)) {
            $result += $submenu;
          }
        }
      }
      return $result;
    }

    /**
     * nastavovani vlastniho submenu definovaneho v getSubmenu
     * prepisuje ->pages rozsirenou verzi
     *
     * @param data data predavama do metody getSubmenu (pro system tridu)
     * @return this
     */
    public function setSelfSubmenu($data = null) {
      $this->pages = $this->__applySelfSubmenu($this->pages, $data);
      return $this;
    }

    /**
     * overuje existenci v source indexu podle zadane name
     *
     * @param source zdrojove pole
     * @param name name pro hledani v poli, hleda jen v zadane urovni pole source
     * @return vraci pouze index z uzi nebo default
     */
    public function exist($source, $name) {
      return (isset($source[$this->uri[$name]]) ? $this->uri[$name] : $this->default_uri);
    }

    /**
     * interni vyhodnocovani aktrualni tridy (stranky)
     *
     * @param source zdrojove pole, defaultne zacina na null
     * @úaram index pocatecni index, necoa jako pocitadlo urovne, defaultne 0
     * @return aktualni (posledni) trida, prichotd tridama je v: ->active_classes
     */
    private function __getCurrentClass($source = null, $index = 0) {
      // bere klic podle indexu
      $page_key = (isset($this->url[$index]) ? $this->url[$index] : null);
      // pole z parametru nebo stranek
      $page_value = (!is_null($source) ? $source : $this->pages);
      // nacteni defaultni hodnoty
      $_default = (isset($page_value[$this->default_uri]) ? $page_value[$this->default_uri] : null);
      // vlozeni klice do hodnoty
      $result = (isset($page_value[$page_key]) ? $page_value[$page_key] : $_default);
      if (is_array($result)) {
        // zpracovani daliho subpole
        if ($index != (count($this->url) - 1)) {
          $this->active_classes[] = $result[''];
        }
        // rekurzivni zpracovani
        $result = $this->__getCurrentClass($result, $index + 1);
      } else {
        $this->active_classes[] = $result;
      }
      return $result;
    }

    /**
     * vraceni vsech aktivnich trid pres ktere prochazi adresa
     *
     * @return pole aktualnich trid
     */
    public function getAllActiveClass() {
      $this->active_classes = array();
      $this->__getCurrentClass();
      return $this->active_classes;
    }

    /**
     * vraci posledni aktualni tidu
     *
     * @return posledni aktualni (zobrazovaci) trida
     */
    public function getLastActiveClass() {
      //~ $this->active_classes = array();  //TODO pridat?!
      return $this->__getCurrentClass();
    }

    /**
     * vraci drobeckovou navigaci
     *
     * @return pole jmen ze trid
     */
    public function getBreadcrumbs() {
      $result = array();
      $active = $this->getAllActiveClass();
      foreach ($active as $class) {
        $data = (method_exists($class, 'getName') ? $class::getName() : null);
        if (!is_null($data)) {
          $result[] = $data['name'];
        }
      }
      return $result;
    }

    /**
     * vraci hodnotu z pole getName()
     *
     * @param name index do pole
     * @return hodnota na danem indexu pole
     */
    public function getVariable($name) {
      $class = $this->__getCurrentClass();  //TODO nahradit za getLastActiveClass() ??
      $data = (method_exists($class, 'getName') ? $class::getName() : array());
      return (isset($data[$name]) ? $data[$name] : null);
    }

    /**
     * vraceni titulku podle aktualni adresy
     *
     * @param ?
     * @return zpracovany title
     */
    public function getTitle() {
      //TODO malinko poupravit a vylepsit
      $class = $this->__getCurrentClass();
      $data = (method_exists($class, 'getName') ? $class::getName() : array());
      return (isset($data['name']) ? $data['name'] : null);
    }

    /**
     * vraceni JS z aktualni adresy
     *
     * @param data nepovinne hodnoty predavane konecne tride
     * @return pripadna hodnota z JS
     */
    public function getJS($data = null) {
      $class = $this->__getCurrentClass();
      return (method_exists($class, 'getJS') ? $class::getJS($data) : null);
    }

    /**
     * vraceni CSS z aktualni adresy
     *
     * @param data nepovinne hodnoty predavane konecne tride
     * @return pripadna hodnota z CSS
     */
    public function getCSS($data = null) {
      $class = $this->__getCurrentClass();
      return (method_exists($class, 'getCSS') ? $class::getCSS($data) : null);
    }

    //~ public function getMenu() {}

    /**
     * vraceni obsahu podle aktualni adresy
     *
     * @param data nepovinne hodnoty predavane konecne tride
     * @return zpracovany obsah (content)
     */
    public function getContent($data = null) {
      $class = $this->__getCurrentClass();
      $data = (method_exists($class, 'getContent') ? $class::getContent($data) : null);
      return $data;
    }
  }

  /**
   *
   * trida udrzujici instanci jednotlivych polozek menu
   *
   * umoznuje pouzit __get ale i []
   */

  class MenuRowWeb extends BaseMainClass {
    const VERSION = 1.16;

    /**
     * pretizeni pro primi vypis
     *
     * @return vypisuje jmemno tridy
     */
    public function __toString() {
      return $this['class'];
    }
  }

  /**
   *
   * hlavni odvozena trida od BaseWeb
   *
   * roztrhana trida  po vzoru staticweb
   * pripdadne zmeny implementace by mely byt jednodussi
   */

  class Web extends BaseWeb {
    const VERSION = 1.54;

    /**
     * zjistovani jestli je zadana trida viditelne ci ne
     * -overuje konstantu VISIBLE
     * -oveduje index v poli getName 'visible', pokud je ma vetsi prioritu
     *
     * @param class jmeno tridy
     * @param data hodnoty predany zpet pres parametr z getName
     * @return bool viditelnosti
     */
    public function isVisible($class, &$data = null) {
      $result = true;
      if (defined($class.'::VISIBLE')) {
        $result = $class::VISIBLE;
      }
      //vkladani dat z metody getName, bude prepisovat viditelnost z konstanty
      $data = (method_exists($class, 'getName') ? $class::getName() : array());
      if (isset($data['visible'])) {  // pokud existuje klic visible
        $result = $data['visible'];
      }
      return $result;
    }

    /**
     * pocitani polozek s akceptovanim viditelnosti
     *
     * @param source zdrojove pole ve kterem se pocitaji polozky
     * @return presny pocet polozek
     */
    private function __getCount($source) {
      $t = $this;
      $sum = 0;
      array_map(function($cl) use ($t, &$sum) {
        $sum += $t->isVisible(!is_array($cl) ? $cl : $cl['']);  //secte true
      }, $source);
      return $sum;
    }

    /**
     * interni rekurzivni menu
     *
     * @param menu zdrojovy menu layout
     * @param maxlevel maximalni level do ktereho se ma vykreslovat
     * @param level aktualni level zanoreni
     * @param lasturl pole posledni url
     * @return pole instanci menuRowWeb
     */
    private function __getArrayMenu($menu, $__conf, $level = 0, $lasturl = array()) {
      $result = array();
      $poc = 0;
      $count = $this->__getCount($menu);
      foreach ($menu as $url => $class) {
//~ var_dump($url.' => '.$class);
        // zpracovani pole lasturl
        $_lasturl = array_filter(array_merge($lasturl, array($url)));
        // nacitani jmena tridy
        $cl = (!is_array($class) ? $class : $class['']);
        // nastavovani aktivity (podle adresy, pole adres a aktualni tridy)
        $active = (isset($this->url[$level]) ? ($url == $this->url[$level]) : false) || ($_lasturl == $this->url) || ($cl == $__conf['activeclass']);
        // nastavovani viditelnosti
        $visible = $this->isVisible($cl, $_getname);

        // nacitani maxlevel-u
        $maxlevel = $__conf['maxlevel'];

        // priprava dat na pole
        $data = array(
                      'url' => $url,
                      'lasturl' => $_lasturl,
                      'allurl' => implode('/', $_lasturl),
                      'active' => $active,
                      'class' => $cl,
                      'level' => $level,
                      'maxlevel' => $maxlevel,
                      'visible' => $visible,
                      'submenu' => null,
                      'poc' => $poc,
                      'count' => $count,
                      'submenu' => null,
                      );

        // scitani dat na pole
        $data = array_merge($_getname, $data, $this->userdata);

        if ($visible) { // pokud je polozka viditelna
          if (is_array($class)) {
            if ($maxlevel == -1 ?: $level < $maxlevel) {
              $level++;
              $data['submenu'] = $this->__getArrayMenu($class, $__conf, $level, array($url));
              $result[] = new MenuRowWeb($data);
              $level--;
            } else {
              $result[] = new MenuRowWeb($data);
            }
          } else {
            $result[] = new MenuRowWeb($data);
          }
          $poc++;
        }
      }
      return $result;
    }

    /**
     * generovani menu jako pole instanci MenuRowWeb
     *
     * @param maxlevel maximalni level zanoreni pro generovani, neomezene je -1
     * @param userdata pole uzivatelskych dat
     * @return pole instanci MenuRowWeb
     */
    public function getMenu($maxlevel = -1, array $userdata = null) {
      $this->setUserData($userdata);
      $data = array(
                    'maxlevel' => $maxlevel,
                    'activeclass' => $this->getLastActiveClass(),
                    );
      return $this->__getArrayMenu($this->pages, $data);
    }
  }