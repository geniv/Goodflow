<?php
/*
 *      config.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

final class Config {
  const MINSIZE = '140x140';  //default small size pictures, with bestfit
  const MAXSIZE = '800x800';  //default large size pictures, with bestfit
  const THUMB = 'thumbnails';  //name directory for thumbnails
  const SOURCE = 'gallery'; //path for directory galleries
  const LANG = 'en';  //language: cs, en (default),
  const TIME_LOGIN = 1; //refresh time (s), for login, create login, etc...
  const TIME_EDIT = 1;  //refresh time (s), for edit, delete, etc...
}

?>
