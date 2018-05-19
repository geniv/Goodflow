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
      classes\Administration,
      \Config;

  final class ModuleHome implements Module {
    const URL = '';
    const VERSION = 1.54;

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

    public static function getSection() {
      return array ('' => _('Technical information'),
                    );
    }

    public static function getLoadModules() {
      return array();
    }

    public static function getState() {
      return true;
    }

//TODO kazdy modul musi mit vlastni pozadavky na extenze, otazka je jestli by to mel publikovat ven?
//moduly mohou posilat zpravy svych udaju sem? a nebo se bude posilat na admin a tu se to bude getovat z adminu!?!

    //uvodni stranka, a nejake statistiky
    public static function getAdminContent($co) {
      $result = NULL;
      $path = Administration::getPath();
      switch ($co) {
        default:
          $gallery_path = sprintf('%s%s', $path, Config::SOURCE);
          $item = array();
          $item[] = array(_('Imagic library:'), (file_exists(sprintf('%sclasses/imagic.php', $path)) ? _('exist, ready') : _('does not exist, fail')));
          $item[] = array(_('Gallery directory:'), (file_exists($gallery_path) ? _('exist, ready') : _('does not exist, fail')));
          $item[] = array(_('Dirs databases:'), (file_exists(ModuleDirs::getXmlPath()) ? _('exist, ready') : _('does not exist, warning')));
          $item[] = array(_('Setting databases:'), (file_exists(ModuleSettings::getXmlPath()) ? _('exist, ready') : _('does not exist, warning')));
          $item[] = array(_('Size gallery directory:'), Core::calculateSize(Core::getSizeDir($gallery_path, true)));
          $item[] = array(_('Size complet page:'), Core::calculateSize(Core::getSizeDir($path, true)));
          $item[] = array(_('PHP version:'), phpversion());
          $item[] = array(_('Permissions home directory:'), Core::getFilePermissions($path));
          $item[] = array(_('Upload max filesize:'), ini_get('upload_max_filesize'));
          $item[] = array(_('Post max size:'), ini_get('post_max_size'));
          $item[] = array(_('The peak of memory allocated by PHP:'), Core::calculateSize(memory_get_peak_usage(true)));
          $item[] = array(_('Amount of memory allocated to PHP:'), Core::calculateSize(memory_get_usage(true)));
          //$item[] = sprintf(_('Loadet extension: %s'),implode(', ', get_loaded_extensions()));

          $row = array();
          foreach ($item as $polozka) {
            //var_dump($polozka);
            $row[] = Html::elem('p')
                          ->insert(Html::elem('span')->setText($polozka[0]))
                          ->insert(Html::elem('span')->class('value')->setText($polozka[1]))
                          ;
            //->setText($polozka);
          }
          $result = Html::elem('div')
                        ->id('technical_information')
                        ->insert($row);
        break;
      }

      return $result;
    }
  }

  //class ExceptionMenuHome extends Exception {}

?>
