<?php
/*
 * ipage.php
 * 
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 * 
 */

  namespace classes;

  /**
   *
   * rozhranni pro Stranky tridy StaticWeb
   *
   */
  interface IPage {
    //const VERSION = 2.02;
    //const VISIBLE = true; //defaultne se bere ze je kazda stranka viditelna
    static function getName(); //jmeno a promenne stranky  +(moznost predavat parametr)
    //static function getJS(); //js  +(moznost predavat parametr)
    //static function getCSS(); //css  +(moznost predavat parametr)
    static function getContent(); //obsah stranky  +(moznost predavat parametr)
  }