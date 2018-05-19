<?php
/*
 *      staticweb.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Html,
      classes\Core,
      \Config,
      Exception;

  class StaticWeb {
    const VERSION = 1.34;

    private static $get_adress = array('action', 'co');
    private static $list_pages = NULL;
    private static $defpage = ''; //defaultne prazdny index


//TODO psat rovnou s komentarama! a doplnit to do ostatnich!!!! DOPLNIT DODATECNE!

/**
 * Nacitani seznamu stranek ze seznamu
 *
 * @since 1.0
 * @method public static getPages
 *
 * @return array
 */
    private static function getPages() {
      if (empty(self::$list_pages)) { //nacitani dat z modulu jen jedenkrat
        $result = array();
        $pages = Config::getLoadPages();  //nacitani stranek z configu
        foreach ($pages as $page) {
          $result[$page::URL] = $page;
/*
          $result[$page::URL] = array('class' => $page,
                                      'name' => $page::getName(),
                                      'uservar' => $page::getUserVariable(),
                                      'modules' => $page::getLoadModules(),
                                      'submenu' => $page::getSubMenu(),
                                      'content' => $page::getContent(),
                                      );
*/
        }
        self::$list_pages = $result;
      }
      return self::$list_pages;
    }

/**
 * Nacitani js & css modulu
 *
 * @since 1.10
 * @method public static getLoadModules
 * @return array
 */
    public static function getLoadModules() {
      $result = NULL;

      $class = self::getCurrentPage();
      $modules = $class::getLoadModules();
//TODO rozlisovat blok pro cely modul, zdrejme znaceny * nebo neco takeho?!
      if (!empty($modules)) {
        $current1 = self::getCurrentAdress(1);
        $result = Core::isFill($modules, $current1);
      }
      return $result;
    }

/**
 * nastaveni defaultni stranky
 *
 * @since 1.10
 * @method public static setDefaultPage
 * @return array
 */
    public static function setDefaultPage($url) {
      self::$defpage = $url;
    }

/**
 * Vraci aktuali get adresu dle zadane urovne
 *
 * @since 1.05
 * @method public static getCurrentAdress
 * @param integer level
 * @return string
 */
    public static function getCurrentAdress($level = 0) {
      return Core::isFill($_GET, self::$get_adress[$level]);
    }

/**
 * vraci tridu aktualni stranky
 *
 * @since 1.10
 * @method public static getCurrentPage
 * @return array
 */
    public static function getCurrentPage() {
      $pages = self::getPages();
      $current = self::getCurrentAdress();
      return Core::isFill($pages, $current, $pages[self::$defpage]);
    }

/**
 * Vracit title stranek
 *
 * @since 1.0
 * @method public static getTitle
 * @param array disable pole zakazanych ::URL
 *
 * @return string
 */
    public static function getTitle(array $disable = NULL) {
      $result = NULL;
      $class = self::getCurrentPage();
      $title = $class::getName();
      $result = (!empty($disable) ? (!in_array($class::URL, $disable) ? $title : NULL) : $title);
      return $result;
    }

/**
 * Vraci menu stranek
 *
 * @since 1.0
 * @method public static getMenu
 *
 * @return string
 */
    public static function getMenu($sablona = NULL, $separate = '') {
      $pages = self::getPages();
      $absoluteurl = Core::getUrl();
      $current = self::getCurrentAdress();

      $row = array();
      $poc = 0;
      $count = count($pages) - 1;
      foreach ($pages as $url => $class) {
        $link = sprintf('%s%s', $absoluteurl, $url);
        $title = $class::getName(); //nacteni jmena
        $condition = ($url == $current ? 'aktivni' : NULL);
        if (empty($sablona)) {  //defaultni tvar
          $row[] = Html::a()->href($link)
                          ->class($condition)
                          ->title($title)
                          ->setText($title);
        } else {
          $data = array('href_link' => $link,
                        'condition' => $condition,
                        'name' => $title,
                        'aktivni' => ($url == $current ? 1 : 0),
                        'poc' => $poc,
                        'count' => $count,
                        ) + $class::getUserVariable();  //+pridani promennych ze stranky
          $row[] = $sablona->setTemplate($data)->render(); //vkladana sablona
        }
        $poc++;
      }
      return (!is_null($separate) ? implode($separate, $row) : $row);
    }

//vraceni uzivatelskych promennych
    public static function getUserVariable($index = NULL) {
      $class = self::getCurrentPage();
      $uservar = $class::getUserVariable();
      return Core::isFill($uservar, $index, $uservar);
    }

/**
 * Vraci obsah stranek
 *
 * @since 1.0
 * @method public static getContent
 *
 * @return string
 */
    public static function getContent() {
      $result = NULL;
      $class = self::getCurrentPage();
      $result = $class::getContent();
      return $result;
    }
  }

  class ExceptionStaticWeb extends Exception {}

?>
