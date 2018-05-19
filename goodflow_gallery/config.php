<?php
/*
 *      config.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  use classes\Configurator;

  class Config extends Configurator {
    const VERSION = 1.67;

    const MINSIZEW = '140'; //W, default small size pictures, with bestfit
    const MINSIZEH = '140'; //H
    const MAXSIZEW = '800'; //W, default large size pictures, with bestfit
    const MAXSIZEH = '800'; //H
    const THUMB = 'thumbnails';  //name directory for thumbnails
    const SOURCE = 'gallery'; //path for directory galleries
    const TIME_LOGIN = 1; //refresh time (s), for login, create login, etc...
    const TIME_EDIT = 3;  //refresh time (s), for edit, delete, etc...
    const TRIMMARKER_DIR = 120; //truncated string with specified width for dirs
    const TRIMMARKER_PIC = 220; //truncated string with specified width fot pictures
    const TRIMMARKER_LISTPIC = 70; //truncated string with specified width fot list pictures

    const LANG = 'en';  //language: cs, en (default)

    //loading module for web
    protected static $loadModules = array('modules\ModuleHome',
                                          'modules\ModuleDirs',
                                          'modules\ModulePictures',
                                          'modules\ModuleSettings');
  }

?>
