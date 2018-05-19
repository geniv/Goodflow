<?php
/*
 *      menuhome.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class MenuHome {
    const URL = '';

    public static function getName() {
      return _('Home');
    }

    //uvodni stranka, a nejake statistiky
    public static function getContent($co) {
      $result = NULL;
      switch ($co) {
        default:
          $result = 'defaultní stránka u sekce uvodni strany...';
        break;
      }

      return $result;
    }
  }

  //class ExceptionMenuHome extends Exception {}

?>
