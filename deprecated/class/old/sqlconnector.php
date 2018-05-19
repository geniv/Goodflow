<?php
/*
 * sqlconnector.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception,
      PDO,
      classes\IConnector,
      classes\Core,
      classes\Sql;

  class SqlConnector implements IConnector {
    const VERSION = 1.23;

    const MySQL = 'mysql';
    const SQLite2 = 'sqlite2';
    const SQLite3 = 'sqlite';

    private $pointer = NULL;

    //array('path', 'user', 'pass')

    public function __construct($type, $settings = NULL) {
      try {
        $this->pointer = new stdClass;
        $this->pointer->state = true;
        $this->pointer->type = $type;

        $this->pointer->dbresult = NULL;
        $this->pointer->dbresultfetch = NULL;
        $this->pointer->dbresultobject = false;
        $this->pointer->dbsql = NULL;

        $dsn = NULL;
        $path = Core::isFill($settings, 'path');
        $user = Core::isFill($settings, 'user', NULL);
        $pass = Core::isFill($settings, 'pass', NULL);

        switch ($type) {
          case self::SQLite2:
          case self::SQLite3:
            $this->pointer->path = sprintf('%s.%s', $path, $type);
            $dsn = sprintf('%s:%s', $type, $this->pointer->path);
          break;

          case self::MySQL:
            //TODO v pripade potreby doimplementovat...
            //blbost, v pripade u PDO se meni jen tym ponektoru, metody jsou stejny!!!
          break;
        }

        $this->pointer->db = new PDO($dsn, $user, $pass);
      } catch (PDOException $e) {
        $this->pointer->state = false;
        error_log(sprintf('Connection failed: %s', $e->getMessage()));
      }
    }

    public function __destruct() {
      $this->pointer->db = NULL;
    }

    public function setStructure($struct) {
      //pokud je pripojena databaze a velikost souboru databaze 0 tak instaluje
      try {
        if (!empty($this->pointer->db) && filesize($this->pointer->path) == 0) {
          $func = function ($k ,$v) { return sprintf('%s %s', $k, $v); };
          foreach ($struct as $name => $columns) {
            $values = implode(','.PHP_EOL, array_map($func, array_keys($columns), $columns));
            $sql = sprintf('CREATE TABLE %s (%s);', $name, $values);
            if ($this->pointer->db->exec($sql) !== false) {
              error_log(sprintf('instalovano: "%s" (%s)', $name, $this->pointer->type));
            }
          }
        }
        $this->pointer->struct = $struct; //vlozeni struktury tabulky
      } catch (PDOException $e) {
        error_log(sprintf('Create structure failed: %s', $e->getMessage()));
      }
      return $this;
    }

    public function getType() {
      return $this->pointer->type;
    }

//vypise dostupne drivery
    public static function getAvailableDrivers() {
      return PDO::getAvailableDrivers();
    }

//vrati posledni pridane id
    public function getLastInsertID($name = NULL) {
      return $this->pointer->db->lastInsertId($name);
    }

//zahajeni transakce
    public function beginTransaction() {
      return $this->pointer->db->beginTransaction();
    }

//overeni jestli transakce probiha
    public function inTransaction() {
      return $this->pointer->db->inTransaction();
    }
//TODO udelat testy na razdne transakce a na transakce ve ktere probehne chyba
//odeslani ukonceni transakce
    public function commit() {
      $result = NULL;
      try {
        $result = $this->pointer->db->commit();
      } catch (PDOException $e) {
        $this->pointer->db->rollBack(); //pokud se nepodari odeslat
        error_log(sprintf('Commit failed: %s', $e->getMessage()));
      }
      return $result;
    }

//pridavani dat z asociativniho poli do dane tabulky
    public function addRow($table, $data) {
      $result = NULL;
      try {
        $keys = array_keys($data);
        $cols = array_fill(0, count($keys), '?');
        $val = Sql::getTransferTypes($this->pointer->struct[$table], $data);
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s);', $table, implode(', ', $keys), implode(', ', $cols)); //implode(', ', $val)
        $prep = $this->pointer->db->prepare($sql);
        $prep->execute($val);
        $result = $prep->rowCount(); //vraci pocet radku u kterych probehla zmena
      } catch (PDOException $e) {
        error_log(sprintf('Insert row failed: %s', $e->getMessage()));
      }
      return $result;
    }

//updava zadaneho radku, zadane tabulky s prilozenyma datama
    public function editRow($table, $id, $data) {
      $result = NULL;
      try {
        //TEST na to jestli jsou data zadane v poli!
        $keys = array_keys($data);
        $func = function($k) { return sprintf('%s=?', $k); };
        $values = array_map($func, $keys);
        $val = Sql::getTransferTypes($this->pointer->struct[$table], $data);
        $sql = sprintf('UPDATE %s SET %s WHERE rowid=%d;', $table, implode(','.PHP_EOL, $values), $id);
        $prep = $this->pointer->db->prepare($sql);
        $prep->execute($val);
        $result = $prep->rowCount(); //vraci pocet radku u kterych probehla zmena
//TODO radne otestovat upravu radku!!!!, at uz existujicich a nebo neexistujicich
//+spatne data, spatne formaty a pokus o vlozeni vadneho dotazu
      } catch (PDOException $e) {
        error_log(sprintf('Update row failed: %s', $e->getMessage()));
      }
      return $result;
    }

//smazani zadaneho radku, zadane tabulky
    public function delRow($table, $id) {
      $result = NULL;
      try {
        $sql = sprintf('DELETE FROM %s WHERE rowid=%d;', $table, $id);
        $result = $this->pointer->db->exec($sql); //vraci pocet radku u kterych probehla zmena
        $this->pointer->db->exec('VACUUM;');
      } catch (PDOException $e) {
        error_log(sprintf('Update row failed: %s', $e->getMessage()));
      }
      return $result;
    }

//nacte radek dle zadanych podminek, pokud vrati false je 0 radku
    public function loadRow($table, $where, $columns = '*') {
      $result = NULL;
      try {
        $sql = sprintf('SELECT %s FROM %s WHERE %s;', $columns, $table, $where[0]);
        if ($prep = $this->pointer->db->prepare($sql)) {
          $prep->execute(array_slice($where, 1));
          $result = $prep->fetch(PDO::FETCH_OBJ);
        } else {
          throw new ExceptionSqlConnector('Invalid sql code');
        }
      } catch (ExceptionSqlConnector $e) {
        echo $e;
      }
      return $result;
    }

//nacitani zadaneho radku podle id, zadane tabulky a zadanych sloupcu
    public function loadRowId($table, $id, $columns = '*') {
      $result = NULL;
      try {
        $sql = sprintf('SELECT %s FROM %s WHERE rowid=?;', $columns, $table);
        if ($prep = $this->pointer->db->prepare($sql)) {
          $prep->execute($id);
          $result = $prep->fetch(PDO::FETCH_OBJ);
        } else {
          throw new ExceptionSqlConnector('Invalid sql code');
        }
      } catch (ExceptionSqlConnector $e) {
        echo $e;
      }
      return $result;
    }

//nastavovani dotazu pro nacitani pres iterator, da se nastavit vraceni poctu radku pres return
    public function setIterator(Sql $sql_object, array $settings = array()) {
      $sql = NULL;
      try { //TODO ++napsat testy!
        $sql_query = $sql_object->getSql();  //nacteni sql dotazu
        $where_arg = $sql_object->getWhereArgs();  //nacteni hotnoty where

        $this->pointer->dbsql = $sql_object;  //prenaseni Sql objektu
        $result_count = Core::isNull($settings, 'result_count', false);

        if ($this->pointer->dbresult = $this->pointer->db->prepare($sql_query)) {
          $this->pointer->dbresult->execute($where_arg);
        } else {
          throw new ExceptionSqlConnector('Invalid sql code');
        }

        $this->pointer->dbresultobject = Core::isNull($settings, 'result_object', true);
      } catch (ExceptionSqlConnector $e) {
        echo $e;
      }
    }

    public function count() {
      $result = 0;
      try {
        $sql_query = $this->pointer->dbsql->getSql();
        $where_arg = $this->pointer->dbsql->getWhereArgs();  //nacteni hotnoty where
        if ($prep = $this->pointer->db->prepare($sql_query)) {
          $prep->execute($where_arg);
          $result = count($prep->fetchAll());  //spocita radky
        } else {
          throw new ExceptionSqlConnector('Invalid sql code');
        }
      } catch (ExceptionSqlConnector $e) {
        echo $e;
      }
      return $result;
    }

    private function getResultFetch() {
      if (!is_null($this->pointer->dbresult)) {
        //nacitani radku z databaze
        if ($this->pointer->dbresultobject) {
          $this->pointer->dbresultfetch = $this->pointer->dbresult->fetchObject();
        } else {
          $this->pointer->dbresultfetch = $this->pointer->dbresult->fetch(PDO::FETCH_ASSOC);
        }
      }
    }

    //metody iteratoru

    function rewind() {
      //inicializace iterace
      $this->getResultFetch();
    }

    function current() {
      //vraceni aktualni hodnoty iterace
      return $this->pointer->dbresultfetch;
    }

    function key() {
      //vraceni klice iterace
      return (int) $this->pointer->dbresultfetch->rowid;
    }

    function next() {
      //posouvani indexu iterace
      $this->getResultFetch();
    }

    function valid() {
      //overovani koncove podminky iterace
      return (bool) $this->pointer->dbresultfetch; //pokud nejsou data, vraci false
    }

  }

  class ExceptionSqlConnector extends Exception {}

?>
