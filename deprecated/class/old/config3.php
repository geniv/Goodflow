<?php
/*
 *      config.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  use classes\Configurator;

  class Config extends Configurator {
    const PROJECT_NAME = 'GoodFlow design - Tvorba webových stránek a systémů';
    const LANG = 'cs';
    //loading module for web
    protected static $loadpages = array('pages\Reference',
                                        'pages\Onas',
                                        'pages\Kontakt',
                                        'pages\Blog',
                                        'pages\Vyvoj');
  }

?>
