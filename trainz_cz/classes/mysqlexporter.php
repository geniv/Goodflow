<?php
/*
 * mysqlexporter.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * Exporter a importer MySQL databaze
   *
   * @package stable/pdo
   * @author geniv
   * @version 1.34
   */
  class MySQLExporter {
    private $helper = null; // instance haldlerudatabaze
    private $dbname = null; // jmeno databaze
    private $db = null;     // instance pripojeni databaze

    private $batch = 300;   // pocet polozek na davku

    //TODO unit testy!! , tesy na nekorektni vsutp!!!

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param PDOHelper helper instance pdo helperu
     */
    public function __construct(PDOHelper $helper, $db) {
      $this->helper = $helper;
      $this->dbname = $helper->getDatabaseName();
      $this->db = $db;
    }

    /**
     * nacteni polozek na davku
     *
     * @since 1.22
     * @param void
     * @return int pocet polozek na davku
     */
    public function getBatch() {
      return $this->batch;
    }

    /**
     * nastaveni poctu polozek na davku
     *
     * @since 1.20
     * @param int batch pocet na davku
     * @return this
     */
    public function setBatch($batch) {
      $this->batch = $batch;
      return $this;
    }

    /**
     * exportovani samostatneho modelu tabulky
     *
     * @since 1.34
     * @param string table jmeno tabulky
     * @return string serializovany create dotaz
     */
    public function exportModel($table) {
      $create_table = $this->db->rawQuery('SHOW CREATE TABLE ' . $table)->getFirst();
      return serialize(array('create_table' => $create_table[1]));
    }

    /**
     * exportovani samostatne tabulky
     *
     * @since 1.34
     * @param string table jmeno tabulky
     * @return string serializovane pole
     */
    public function exportTable($table) {
      $result = array();
      foreach ($this->db->query($table) as $v) {
        $result[] = (array) $v; // konvert do pole
      }
      return serialize(array('rows' => $result));
    }
//FIXME importeny neresi samostatne instance!!! 
    /**
     * exportovani aktualni databaze
     * - serializace
     *
     * @since 1.00
     * @param void
     * @return string poskladany sql
     */
    public function export() { //$ignore = array() opravdu vyuzijem ignore?
      $result = null;
      if ($this->db->beginTransaction()) {

        foreach ($this->db->rawQuery('SHOW TABLES') as $v) {
          $table = $v['Tables_in_' . $this->dbname];
          $create_table = $this->db->rawQuery('SHOW CREATE TABLE ' . $table)->getFirst();
          $result[$table] = array(
              //'create_table' => base64_encode($create_table[1]),  // ulozeny dotazu vytvareni
              'create_table' => $create_table[1],
            );
          $result[$table]['rows'] = array();  // inicializace rows

          foreach ($this->db->query($table) as $v1) {
            //$result[$table]['rows'][] = array_map('base64_encode', (array) $v1);  // ulozeni radku
            $result[$table]['rows'][] = (array) $v1;  // ulozeni radku
          }
        }
        $this->db->endTransaction();
      }

      //return json_encode($result);
      return serialize($result);
    }

//FIXME na vygenerovani nekolika tabulek s >10000 radku / tabulku, nezvlada memory limit!!! bud rozdelit na vice souboru s instancema
//pokud bude extra exportovani na tavulky bude se muset udelat i metoda ktera tyto vsechny data da do kupy...!!!
//TODO pokud by se to melo delit na vice pod metod na rucni generovani konkretnich mega tabulek se zaznamy se musi ukladat samostatne instance, create_table+rows
//array('downloads_has_trainz_kuid', 'languages_has_downloads', 'trainz_cdp_has_trainz_kuids', 'trainz_kuids'))
    //~ public function exportTable($table) {
      //~ $res = array();
      //~ if ($this->db->beginTransaction()) {
        //~ foreach ($this->db->query($table) as $v) {
          //~ $res[] = (array) $v;
        //~ }
        //~ $this->db->endTransaction();
      //~ }
      //~ return $res;
    //~ }

    /**
     * importovani modelu databaze
     * - zacatek stejny jako u metody import()
     * - unserializace
     *
     * @since 1.24
     * @param string data vstupni data
     * @return array pole importovanych tabulek
     */
    public function importModel($data) {
      //$code = json_decode($data, true);
      $code = unserialize($data);
      $result = null;
      if ($code && is_array($code) &&
              $this->db->beginTransaction()) {
        $this->db->execSQL('SET FOREIGN_KEY_CHECKS = 0'); // deaktivace FK
        foreach ($code as $table => $v) {
          if (is_array($v) && isset($v['create_table'])) {  // musi existovat indexy
            $this->db->execSQL('DROP TABLE IF EXISTS ' . $table); // smaznuti tabulek
            //$t = $this->db->execSQL(base64_decode($v['create_table']));  // vytvoreni tabulek
            $t = $this->db->execSQL($v['create_table']);  // vytvoreni tabulek
            $result[$table] = ($t == 0 ? 'ok' : 'fail');  // 0 modifikovanych radku
          }
        }
        $this->db->execSQL('SET FOREIGN_KEY_CHECKS = 1'); // aktivace FK
        $this->db->endTransaction();
      }
      return $result;
    }

    /**
     * importovani do aktualni databaze
     * - defaultne provadi drop tabulky
     * - unserializace
     *
     * @since 1.00
     * @param string data vstupni data
     * @param bool drop_table true pro drop a znovu vytvoreni modelu, false provadi jen truncate
     * @return array pole poctu zpracovanych polozek pri importu
     */
    public function import($data, $drop_table = true) {
      //$code = json_decode($data, true);
      $code = unserialize($data);
      $result = null;
      if ($code && is_array($code) &&
              $this->db->beginTransaction()) {
        $this->db->execSQL('SET FOREIGN_KEY_CHECKS = 0'); // deaktivace FK
        // inline funkce
        $inline_function = function($v) {
            //$v = base64_decode($v); // dekodovani
            return $v != '' ? $v : null;  // pokud je, jinak null
          };
        foreach ($code as $table => $v) {
          if (is_array($v) && isset($v['create_table']) && isset($v['rows'])) { // musi existovat indexy
            if ($drop_table) {  // pokud ma drop-ovat
              $this->db->execSQL('DROP TABLE IF EXISTS ' . $table); // smaznuti tabulek
              //$this->db->execSQL(base64_decode($v['create_table']));  // vytvoreni tabulek
              $this->db->execSQL($v['create_table']);  // vytvoreni tabulek
            } else {  // pokud ma cistit
              $this->db->truncate($table, false);
            }
            $res = 0;
            $count = count($v['rows']);
            if ($count > 0) { // pokud je vic jak 0 polozek
              $range = range(0, (int) ceil($count / $this->batch));
              foreach ($range as $i) {
                $cv = array();
                $select = array_slice($v['rows'], $i * $this->batch, $this->batch); // extrahovani pole
                foreach ($select as $v1) {  // prochazeni vyseku
                  $cv[] = ContentValues::init(array_map($inline_function, $v1));
                }
                $res += $this->db->insertMultiple($table, $cv);
              }
            }
            $result[$table] = $res . '; ' . ($res == $count ? 'ok' : 'fail');
          }
        }
        $this->db->execSQL('SET FOREIGN_KEY_CHECKS = 1'); // aktivace FK
        $this->db->endTransaction();
      }
      return $result;
    }
  }