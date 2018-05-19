<?php
/*
 *      kontakt.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace pages;

  use classes\Html;

  class Kontakt implements Page {
    const URL = 'kontakt';

    public static function getName() {
      return _('Kontakty');
    }

    public static function getSubMenu() {
      return array ();
    }

    public static function getContent() {
      return Html::div()->class('trida kontaktu')->setText('text kontaktu');
    }
  }

?>
