<?php
/*
 *      modulehome.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace modules;

  use classes\Core,
      classes\Html,
      configs\Config;

  final class ModuleHome implements Module {
    const URL = '';
    const VERSION = '1.5';

    /**
     * Getter of name module
     *
     * @method public static getName
     *
     * @return string section name
     */
    public static function getName() {
      return _('Home');
    }

    public static function getState() {
      $result = true;
//TODO tady neco kontrolovat??? propadne jeste vracet stavkovou hlasku???
      return $result;
    }

    private static $web_path = NULL;

    public static function setWebPath($path = NULL) {
      self::$web_path = $path;
    }
//TODO kazdy modul musi mit vlastni pozadavky na extenze, otazka je jestli by to mel publikovat ven?
    //uvodni stranka, a nejake statistiky
    public static function getAdminContent($co) {
      $result = NULL;
      switch ($co) {
        default:
          $gallery_path = sprintf('%s%s', self::$web_path, Config::SOURCE);
          $item = array();
          $item[] = (file_exists(sprintf('%sclasses/imagic.php', self::$web_path)) ? _('Imagic library exist, ready') : _('Imagic library does not exist, fail'));
          $item[] = (file_exists($gallery_path) ? _('Gallery directory exist, ready') : _('Gallery directory does not exist, fail'));
          $item[] = (file_exists(ModuleDirs::getXmlPath()) ? _('Dirs databases exist, ready') : _('Dirs databases does not exist, warning'));
          $item[] = (file_exists(ModuleSettings::getXmlPath()) ? _('Setting databases exist, ready') : _('Settings databases does not exist, warning'));
          $item[] = sprintf(_('Size gallery directory: %s'), Core::calculateSize(Core::getSizeDir($gallery_path, true)));
          $item[] = sprintf(_('Size complet page: %s'), Core::calculateSize(Core::getSizeDir(self::$web_path, true)));
          $item[] = sprintf(_('PHP version: %s'), phpversion());
          $item[] = sprintf(_('The peak of memory allocated by PHP: %s'), Core::calculateSize(memory_get_peak_usage(true)));
          $item[] = sprintf(_('Amount of memory allocated to PHP: %s'), Core::calculateSize(memory_get_usage(true)));
          $item[] = sprintf(_('Loadet extension: %s'),implode(', ', get_loaded_extensions()));

          $result = implode(Html::elem('br'), $item);
        break;
      }

      return $result;
    }
  }

  //class ExceptionMenuHome extends Exception {}

?>
