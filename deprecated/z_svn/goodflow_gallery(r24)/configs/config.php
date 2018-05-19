<?php
/*
 *      config.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace configs;

  final class Config {
    const VERSION = '1.5';

    const MINSIZEW = '140'; //W, default small size pictures, with bestfit
    const MINSIZEH = '140'; //H
    const MAXSIZEW = '800'; //W, default large size pictures, with bestfit
    const MAXSIZEH = '800'; //H
    const THUMB = 'thumbnails';  //name directory for thumbnails
    const SOURCE = 'gallery'; //path for directory galleries
    const TIME_LOGIN = 1; //refresh time (s), for login, create login, etc...
    const TIME_EDIT = 1;  //refresh time (s), for edit, delete, etc...

    //loading module for web
    private static $loadModules = array('modules\ModuleHome',
                                        'modules\ModuleDirs',
                                        'modules\ModulePictures',
                                        'modules\ModuleSettings');

    const LANG = 'cs';  //language: cs, en (default)
    private static $availableLanguages = array ('en' => 'en_EN',
                                                'cs' => 'cs_CZ',);


    public static function getLoadModules() {
      return self::$loadModules;
    }

    public static function getAvailableLanguages() {
      return self::$availableLanguages;
    }
  }

?>
