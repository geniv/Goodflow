<?php
/**
 *      modulehome.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 *
 * @class ModuleHome
 */

  final class ModuleHome implements Module {
    const URL = '';

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
//TODO kazdy modul musi mit vlastni pozadavky na extenze, otazka je jestli by to mel publikovat ven?
    //uvodni stranka, a nejake statistiky
    public static function getAdminContent($co) {
      $result = NULL;
      switch ($co) {
        default:
//var_dump(Core::calculateSize(memory_get_peak_usage(true)));
//var_dump(Core::calculateSize(memory_get_usage(true)));

          $item = array();
          $item[] = (file_exists('imagic.php') ? _('Imagic library exist, ready') : _('Imagic library does not exist, fail'));
          $item[] = (file_exists(Config::SOURCE) ? _('gallery directory exist, ready') : _('gallery directory does not exist, fail'));
          $item[] = (file_exists(ModuleDirs::getXmlPath()) ? _('dirs databases exist, ready') : _('dirs databases does not exist, fail'));
          $item[] = (file_exists(ModuleSettings::getXmlPath()) ? _('setting databases exist, ready') : _('settings databases does not exist, fail'));
          $item[] = sprintf(_('Size gallery directory: %s'), Core::calculateSize(Core::getSizeDir(Config::SOURCE, true)));
          $item[] = sprintf(_('Size complet page: %s'), Core::calculateSize(Core::getSizeDir('.', true)));
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
