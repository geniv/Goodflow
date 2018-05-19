<?php
/*
 *      selectiontheme.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use \Config,
      classes\ISilngleton,
      Exception;

//prvni najde definovanou slozku
  class SelectionTheme implements ISingleton {
    const VERSION = 1.254;

    const THEME_NAME = 'name';
    const THEME_LAYOUT = 'layout';

    const THEME_COOKIE = 'select_theme';
    const THEME_DEFAULT = 'default';

    private static $instance = NULL;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self;
      }
      return self::$instance;
    }

    public function setWebPath($path = NULL) {
      try {

        if (file_exists($path)) {
          self::$instance->path = $path;
          self::$instance->theme = Core::isEmpty(Core::getCookie(self::THEME_COOKIE), self::THEME_DEFAULT);
        } else {
          //TODO jestli ne tak si ji vytvori!!!!??????!!
          throw new ExceptionSelectionTheme(sprintf(_('Dir theme "%s" does not exist!'), $path));
        }

      } catch (ExceptionSelectionTheme $e) {
        echo $e;
      }
    }

//nacteni tematu
    private function loadThemes() {
      //pokud nejsou nactena temata a neni prazdna cesta
      if (empty(self::$instance->themes) && !empty(self::$instance->path)) {
        $path = self::$instance->path;

        $themes = Core::getListDir(array('path' => $path));
        foreach ($themes as $theme) {
          $theme_path = sprintf('%s%s/%s.php', $path, $theme, $theme);
          if (file_exists($theme_path)) {
            //$array = require_once $theme_path;
            //self::$instance->themes[$theme] = $array;
            self::$instance->themes[$theme] = require($theme_path);
          }
        }
      }
    }

    public function getCurrentTheme() {
      return self::$instance->theme;
    }

    public function setCurrentTheme($theme) {
      self::$instance->theme = Core::isEmpty($theme, self::THEME_DEFAULT);
    }

    private function getSelectArray() {
      $result = array(self::THEME_DEFAULT => _('Default theme'));
      if (!empty(self::$instance->themes)) {
        $themes = self::$instance->themes;
        foreach ($themes as $path => $values) {
          $result[$path] = $values[self::THEME_NAME];
        }
        asort($result); //sezazeni podle hodnot
      }
      return $result;
    }

    public function internalControlPanel() {
      $this->loadThemes();
      return $this->getSelectArray();
    }

    public function internalSetCookie($theme) {
      Core::setCookie(self::THEME_COOKIE, $theme);
    }

    public function controlPanel() {
      $result = NULL;
      $this->loadThemes();
      $select = $this->getSelectArray();
      $current = $this->getCurrentTheme();

      $form = new Form;
      $form->addSelect('theme', array('value' => $select, 'selected' => $current, 'label' => _('Available themes:')))
            ->addSubmit(__CLASS__.'_submit', array('value' => _('Change theme')));

      $result = $form;

      if ($form->isSubmitted()) {
        $result = _('Changing theme now... wait please...');
        $this->internalSetCookie($form->theme);
        Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl());
      }
      return $result;
    }

//nacteni konkterni sekce html z template
    public function section($name) {
      $result = NULL;
      $this->loadThemes();
      $current = $this->getCurrentTheme();
      if ($current != self::THEME_DEFAULT) {  //defaultni tema nema tema ve slozce!
        $result = Core::isFill(self::$instance->themes[$current], $name);
      }
      return $result;
    }
  }

  class ExceptionSelectionTheme extends Exception {}

?>
