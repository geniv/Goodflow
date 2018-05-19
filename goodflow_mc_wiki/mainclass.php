<?php
/*
 * mainclass.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * hlavni trida ktera bude agregovat nejpouzivanejsi atributy a metody
 */

  final class MainClass extends classes\BaseMainClass {
    const VERSION = 1.04;

    //~ public function __construct($data) {
      //~ parent::__construct($data);
    //~ }

    // nacte role dostupne role
    public function getUserRoles() {
      $dbRole = $this->data['db']->query('roles', array('idrole', 'nazev'), null, null, null, null, 'idrole ASC');
      $itRoles = iterator_to_array($dbRole);
      $k_roles = array_map(function($r) { return $r->getInt('idrole'); }, $itRoles);
      $v_roles = array_map(function($r) { return $r->getString('nazev'); }, $itRoles);
      return array_combine($k_roles, $v_roles);
    }
  }