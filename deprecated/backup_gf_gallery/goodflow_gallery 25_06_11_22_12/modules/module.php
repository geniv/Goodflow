<?php
/*
 *      module.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace modules;

  interface Module {
    public static function getName();
    public static function getState();
    public static function getAdminContent($co);
  }

?>
