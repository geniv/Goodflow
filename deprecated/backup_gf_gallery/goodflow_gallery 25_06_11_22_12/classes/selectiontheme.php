<?php
/*
 *      selectiontheme.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use configs\Config,
      Exception;

  //TODO dodelat!!! poradne domyslet, bude se menit cela kostra a nebo jen cast headu a body nebo cele...


//prvni najde definovanou slozku
  class SelectionTheme implements Singleton {
    const VERSION = '1.0';

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
      self::$instance->path = $path;
      //FIXME tady si take musi kontrolovat jestli dotycna slozka existuje,
      //jestli ne tak si ji vytvori!!!!
    }

    private function searchThemes() {
      if (empty(self::$instance->themes)) {
        $path = self::$instance->path;
        $themes = Core::getListDir(array('path' => $path));

        foreach ($themes as $theme) {
          $theme_path = sprintf('%s%s/%s.php', $path, $theme, $theme);
          $array = require_once $theme_path;
          self::$instance->themes[$theme] = $array;
        }
      }
    }

    private function getCurrentTheme() {
      $theme = Core::getCookie(self::THEME_COOKIE);
      return (!empty($theme) ? $theme : self::THEME_DEFAULT);
    }

    public function controlPanel() {
      $this->searchThemes();

      $result = NULL;

      $themes = self::$instance->themes;
      $select = array(self::THEME_DEFAULT => _('Default theme'));
      foreach ($themes as $path => $values) {
        $select[$path] = $values[self::THEME_NAME];
      }

      $current = $this->getCurrentTheme();

      $form = new Form;
      $form->addSelect('theme', array('value' => $select, 'selected' => $current, 'label' => _('Available themes:')))
            ->addSubmit(__CLASS__.'_tlacitko', array('value' => _('Change theme')));

      $result = $form;

      if ($form->isSubmitted()) {
        Core::setCookie(self::THEME_COOKIE, $form->theme);
        Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl());
      }

      return $result;
    }

    public function applyTheme() {
      //TODO aplikace tematu
    }
  }

  class ExceptionSelectionTheme extends Exception {}

?>
