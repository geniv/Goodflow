<?php
/*
 * iconnector.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Iterator,
      Countable;

//TODO iconnector pro databaze a i pro file databaze?!

  interface IConnector extends Iterator, Countable {
    //const VERSION = 1.04;
    public function addRow($table, $data);
    public function editRow($table, $id, $data);
    public function delRow($table, $id);
    public function loadRow($table, $where, $columns = '*');
    public function loadRowId($table, $id, $columns = '*');
  }

?>
