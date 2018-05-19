<?php
/*
 * sqlitestorage.php
 *
 * Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * kazda tabulka z teto tridy generuje automaticky radek id int
 * databaze bude typu SQLite3
 */

  namespace classes;

  use stdClass,
      SQLite3,
      classes\IConnector,
      classes\Core,
      classes\Sql;
//FIXME dodelat Exceptions!

//na sqlite databaze vkladat dotoaz: VACUUM , pac pry databaza po delete nemaze ...
  class SqliteStorage implements IConnector {
    const VERSION = 1.294;

    private $pointer = NULL;
//TODO dodelat!!

//do struktury se bude automaticky pridavat ID
    public function __construct($path = __DIR__) {
      $this->pointer = new stdClass;
      $this->pointer->path = NULL;
      $this->pointer->db = NULL;
      $this->pointer->state = true;

      $this->pointer->dbresult = NULL;
      $this->pointer->dbresultfetch = NULL;

      if ($this->pointer->state = is_writable(dirname($path))) {
        $this->pointer->path = sprintf('%s.sqlite3', $path);
        if (!$this->pointer->db = new SQLite3($this->pointer->path)) {
          $this->pointer->state = false;
          echo 'nepodarilo se vytvorit objekt databaze!';
        }
      } else {
        echo 'nelze do pathe zapisovat!';
      }
    }

//nakonec slusne uzavreni databaze
    public function __destruct() {
      if (is_object($this->pointer->db)) {
        $this->pointer->db->close();
      }
    }

//TODO mozna se trochu inspirovat z NotORM
    public function setStructure($struct) {
      //pokud je pripojena databaze a velikost souboru databaze 0 tak instaluje
      if (!empty($this->pointer->db) && filesize($this->pointer->path) == 0) {
        $func = function ($k ,$v) { return sprintf('%s %s', $k, $v); };
        foreach ($struct as $name => $columns) {
          $values = implode(','.PHP_EOL, array_map($func, array_keys($columns), $columns));
          $create = sprintf('CREATE TABLE %s (%s);', $name, $values);
          if (!$this->pointer->state = $this->pointer->db->exec($create)) {
            echo 'sql dotaz instalace se nepovedl!';
          }
        }
      }
      $this->pointer->struct = $struct; //vlozeni struktury tabulky
      return $this;
    }

//pridavani dat z asociativniho poli do dane tabulky
    public function addRow($table, $data) {
      $cols = array();
      $val = array();
      foreach ($data as $column => $value) {
        $cols[] = $column;
        $val[] = Sql::getType($this->pointer->struct[$table][$column], SQLite3::escapeString($value));
      }

      $sql = sprintf('INSERT INTO %s (%s) VALUES (%s);', $table, implode(', ', $cols), implode(', ', $val));
      if (!$this->pointer->state = $this->pointer->db->exec($sql)) {
        echo 'sql dotaz vlozeni radku se nezadaril!';
        var_dump($this->pointer->db->lastErrorMsg());
      }
    }

    public function getLastInsertID() {
      return $this->pointer->db->lastInsertRowID();
    }

    public function getCountChanges() {
      return $this->pointer->db->changes();
    }

//FIXME osetrovat predavana data od uzivatelu!!!
//editace dat podle daneho id, tabulky  a predaneho asociativniho pole
    public function editRow($table, $id, $data) {
      $val = array();
      foreach ($data as $column => $value) {
        $val[] = sprintf('%s=%s', $column, Sql::getType($this->pointer->struct[$table][$column], SQLite3::escapeString($value)));
      }

      $sql = sprintf('UPDATE %s SET %s WHERE rowid=%d;', $table, implode(','.PHP_EOL, $val), $id);
      if (!$this->pointer->state = $this->pointer->db->exec($sql)) {
        echo 'sql dotaz vlozeni radku se nezadaril!';
        var_dump($this->pointer->db->lastErrorMsg());
      }
    }

//mazani dat podle zadaneho id a tabulky
    public function delRow($table, $id) {
      $sql = sprintf('DELETE FROM %s WHERE rowid=%d;', $table, $id);
      if (!$this->pointer->state = $this->pointer->db->exec($sql)) {
        echo 'sql dotaz vlozeni radku se nezadaril!';
        var_dump($this->pointer->db->lastErrorMsg());
      }
      $this->pointer->db->exec('VACUUM;');  //provedeni vacua
    }

//nacteni konkretniho radku podle tabulky a id, pripadne jen zvojene sloupce
    public function loadRow($table, $id, $columns = '*') {
      $sql = sprintf('SELECT %s FROM %s WHERE rowid=%d;', $columns, $table, $id);
      return $this->pointer->db->querySingle($sql, true);
    }

    public function loadRows($table) {
      //nacte vybrane radky?
    }

//nastaveni sql dotazu pro iteraci
    public function setIterator($table, array $settings = array()) {
      $result = NULL;
      $sql = NULL;
      if ($table instanceof Sql) {
        $sql = $table->getSql();  //nacteni sql dotazu
        $where = $table->getWhereArgs();  //nacteni hotnoty where
        $limit = $table->getLimitArgs();  //nacteni hodnoty limitu
        $table = $table->getTable();  //nateni nazvu tabulek
      } else {
        $columns = Core::isFill($settings, 'columns', '*');
        $order = Core::isFill($settings, 'order', 'rowid ASC');
        $where = Core::isFill($settings, 'where');
        $limit = Core::isFill($settings, 'limit');
      }

      if (!empty($limit)) {
        $result = $limit[1]; //druhe cislo limitu
        $limit = vsprintf(' LIMIT %s,%s', $limit);
      }

//FIXME kurva!!! cele prekopat do PDO konektor!!!!!!!, originalni pristup je k hovnum!!!!!

      if (!empty($where)) {
        $where = sprintf(' WHERE %s', $where);
        $result = $this->pointer->db->querySingle(sprintf('SELECT count(rowid) FROM %s%s;', $table, $where));
      }
//FIXME domyslet a nebo odhledat lepsi zpusob na pocitani radku!!!!! z sql dotazu!!!
      if (empty($sql)) {
        $sql = sprintf('SELECT rowid, %s FROM %s%s ORDER BY %s%s;', $columns, $table, $where, $order, $limit);
      }

//var_dump(sprintf('SELECT count(%s) FROM %s;', $sql, $table));
      //!var_dump($this->pointer->db->querySingle(sprintf('SELECT count(%s) FROM %s;', $sql, $table), true));
//FIXME PDO je reseni!!!!! pres pdo s tim ze se udela univerzalni a nebo pro jednotlive databaze?!!!
//samozrejme efektivenejsu bude nejak jako "SqlConnector()" :)

//var_dump($sql);
      $this->pointer->dbresultobject = Core::isFill($settings, 'result_object', true); //navrat objektem
      $this->pointer->dbresult = $this->pointer->db->query($sql);

//TODO pri nastaveni vzit i nejake univerzalni id a adresovat to pres to, aby se nekrizily pruchody
      return $result;
    }

//stara se o vyber sloupcu
    private function getResultFetch() {
      if (!is_null($this->pointer->dbresult)) {
        $fetch = $this->pointer->dbresult->fetchArray(SQLITE3_ASSOC);
        $this->pointer->dbresultid = $fetch['rowid'];
        //extract od 1.indexu
        $this->pointer->dbresultfetch = (is_array($fetch) ? ($this->pointer->dbresultobject ? (object) array_slice($fetch, 1) : array_slice($fetch, 1)) : NULL);
      }
    }
//FIXME otestovat na zanorujici se databaze!!!!
    function rewind() {
      //prvni krok v iteraci
      //var_dump(__METHOD__);
      $this->getResultFetch();
    }

    function current() {
      //vraceni hodnoty iterace
      //var_dump(__METHOD__);
      return $this->pointer->dbresultfetch;
    }

    function key() {
      //vraceni klice iterace
      //var_dump(__METHOD__);
      //return $this->pointer->dbresultfetch['rowid'];
      return $this->pointer->dbresultid;
    }

    function next() {
      //posouvani indexu iterace
      //var_dump(__METHOD__);
      $this->getResultFetch();
    }

    function valid() {
      //overeni koncove podminky iterace
      //var_dump(__METHOD__);
      $res = (!is_null($this->pointer->dbresultfetch));
      if (!$res && !is_null($this->pointer->dbresultfetch)) {
        //uzavreni result setu
        $this->pointer->dbresult->finalize();
      }
      return $res;
    }

    //TODO kompletni load dat?!

    //TODO load podle nejakeho objektoveho prikazu, viz NotORM...

//na sqlite databaze vkladat dotoaz: VACUUM , pac pry datazaeb po delete nemaze ...

    public function getCountRows() {
      //
    }
  }

?>
