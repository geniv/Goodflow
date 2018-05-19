<?php
/*
 *      uvod.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use classes\Html;

  class Uvod implements Page {
    const URL = '';

    public static function getName() {
      return _('Home');
    }

    public static function getSubMenu() {
      return array ();
    }

    public static function getContent() {
      return Html::div()->class('trida uvodu')->setText('text divu v uvodu');
    }
  }

?>
