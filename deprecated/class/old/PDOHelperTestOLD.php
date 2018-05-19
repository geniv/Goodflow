<?php
namespace classes;

//classes\PDOHelper,
//classes\PDODatabase,
//classes\ContentValues,

/**
 * minimanle instalovane PDO mysql+sqlite
 *
 * http://www.wunderkraut.com/blog/multi-languages-and-sort-order/2009-06-05
 * http://www.root.cz/clanky/databaze-mariadb-valcuje-mysql/
 *
 * phpunit-skelgen --bootstrap ../loader.php --test -- "classes\PDOOpenHelper" pdoopenhelper.php
 * mv -v PDOOpenHelperTest.php ../test/
 */

  //deklarace a definice tabulek
  class DatabaseHandler extends PDOHelper {

    const ROWID = '_id';
    //suroviny
    const TABLE_SUROVINY = 'suroviny';
    const TABLE_SUROVINY_NAZEV = 'nazev';
    const TABLE_SUROVINY_POPIS = 'popis';

    //kategorie
    const TABLE_KATEGORIE = 'kategorie';
    const TABLE_KATEGORIE_NAZEV = 'nazev';
    const TABLE_KATEGORIE_POPIS = 'popis';

    //jednotky
    const TABLE_JEDNOTKY = 'jednotky';
    const TABLE_JEDNOTKY_NAZEV = 'nazev';
    const TABLE_JEDNOTKY_POPIS = 'popis';

    //recepty
    const TABLE_RECEPTY = 'recepty';
    const TABLE_RECEPTY_NAZEV = 'nazev';
    const TABLE_RECEPTY_POPIS = 'popis';
    const TABLE_RECEPTY_DOBA = 'doba';
    const TABLE_RECEPTY_PORCE = 'porce';
    const TABLE_RECEPTY_NAROCNOST = 'narocnost';
    const TABLE_RECEPTY_AUTOR = 'autor';

    //slozeni
    const TABLE_SLOZENI = 'slozeni';
    const TABLE_SLOZENI_MNOZSTVI = 'mnozstvi';

    //~ public function __construct($name) {
      //~ parent::__construct($name);
    //~ }

    public function onCreate(PDODatabase $db) {
      //pro testovaci ucely test na obou db
      switch ($db->getDriverName()) {
        case 'sqlite':
          $create_sql = 'CREATE TABLE IF NOT EXISTS %s (
                        %s INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                        %s VARCHAR(100) NOT NULL UNIQUE,
                        %s TEXT NULL);';

          //suroviny
          $db->execSQL($create_sql, array(self::TABLE_SUROVINY, self::ROWID,
            self::TABLE_SUROVINY_NAZEV, self::TABLE_SUROVINY_POPIS));

          //kategorie
          $db->execSQL($create_sql, array(self::TABLE_KATEGORIE, self::ROWID,
            self::TABLE_KATEGORIE_NAZEV, self::TABLE_KATEGORIE_POPIS));

          //jednotky
          $db->execSQL($create_sql, array(self::TABLE_JEDNOTKY, self::ROWID,
            self::TABLE_JEDNOTKY_NAZEV, self::TABLE_JEDNOTKY_POPIS));

          //recepty
          $db->execSQL('CREATE TABLE IF NOT EXISTS %s (
              %s INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
              id_%s INT NOT NULL,
              %s VARCHAR(100) NOT NULL UNIQUE,
              %s TEXT NOT NULL,
              %s INT(11) NOT NULL, --\'v minutach\'
              %s INT(11) NOT NULL, --\'pocet porci\'
              %s INT(11) NOT NULL, --\'ciselne hodnoceni\'
              %s TEXT NOT NULL);',
            array(self::TABLE_RECEPTY, self::ROWID, self::TABLE_KATEGORIE,
              self::TABLE_RECEPTY_NAZEV, self::TABLE_RECEPTY_POPIS,
              self::TABLE_RECEPTY_DOBA, self::TABLE_RECEPTY_PORCE,
              self::TABLE_RECEPTY_NAROCNOST, self::TABLE_RECEPTY_AUTOR));

          //slozeni
          $db->execSQL('CREATE TABLE IF NOT EXISTS %s (
              %s INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
              id_%s INT(11) NOT NULL,
              id_%s INT(11) NOT NULL,
              %s FLOAT NOT NULL,
              id_%s INT(11) NOT NULL);',
            array(self::TABLE_SLOZENI, self::ROWID, self::TABLE_SUROVINY,
              self::TABLE_RECEPTY, self::TABLE_SLOZENI_MNOZSTVI,
              self::TABLE_JEDNOTKY));
        break;

        case 'mysql':
          $create_sql = 'CREATE TABLE IF NOT EXISTS `%s` (
                        `%s` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `%s` VARCHAR(100) NOT NULL UNIQUE,
                        `%s` TEXT NULL) ENGINE = InnoDB;';

          //suroviny
          $db->execSQL($create_sql, array(self::TABLE_SUROVINY, self::ROWID,
            self::TABLE_SUROVINY_NAZEV, self::TABLE_SUROVINY_POPIS));

          //kategorie
          $db->execSQL($create_sql, array(self::TABLE_KATEGORIE, self::ROWID,
            self::TABLE_KATEGORIE_NAZEV, self::TABLE_KATEGORIE_POPIS));

          //jednotky
          $db->execSQL($create_sql, array(self::TABLE_JEDNOTKY, self::ROWID,
            self::TABLE_JEDNOTKY_NAZEV, self::TABLE_JEDNOTKY_POPIS));

          //recepty
          $db->execSQL('CREATE  TABLE IF NOT EXISTS `%s` (
              `%s` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
              `id_%s` INT NOT NULL,
              `%s` VARCHAR(100) NOT NULL UNIQUE,
              `%s` TEXT NOT NULL,
              `%s` INT(11) NOT NULL COMMENT \'v minutach\' ,
              `%s` INT(11) NOT NULL COMMENT \'pocet porci\' ,
              `%s` INT(11) NOT NULL COMMENT \'ciselne hodnoceni\',
              `%s` TEXT NOT NULL) ENGINE = InnoDB;',
            array(self::TABLE_RECEPTY, self::ROWID, self::TABLE_KATEGORIE,
              self::TABLE_RECEPTY_NAZEV, self::TABLE_RECEPTY_POPIS,
              self::TABLE_RECEPTY_DOBA, self::TABLE_RECEPTY_PORCE,
              self::TABLE_RECEPTY_NAROCNOST, self::TABLE_RECEPTY_AUTOR));

          //slozeni
          $db->execSQL('CREATE TABLE IF NOT EXISTS `%s` (
              `%s` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
              `id_%s` INT(11) NOT NULL,
              `id_%s` INT(11) NOT NULL,
              `%s` FLOAT NOT NULL,
              `id_%s` INT(11) NOT NULL) ENGINE = InnoDB;',
            array(self::TABLE_SLOZENI, self::ROWID, self::TABLE_SUROVINY,
              self::TABLE_RECEPTY, self::TABLE_SLOZENI_MNOZSTVI,
              self::TABLE_JEDNOTKY));
        break;
      }
    }
  }

  //deklarace a definice tabulek
  class DBHandlerMysqlMemory extends PDOHelper {

    const ROWID = '_id';
    //suroviny
    const TABLE_SUROVINY = 'suroviny';
    const TABLE_SUROVINY_NAZEV = 'nazev';
    const TABLE_SUROVINY_POPIS = 'popis';

    //~ public function __construct($name) {
      //~ parent::__construct($name);
    //~ }

    public function onCreate(PDODatabase $db) {
      $create_sql = 'CREATE TABLE IF NOT EXISTS `%s` (
                        `%s` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `%s` VARCHAR(100) NOT NULL UNIQUE,
                        `%s` VARCHAR(255) NULL) ENGINE = HEAP;';  // / MEMORY

      //memory suroviny
      $db->execSQL($create_sql, array(self::TABLE_SUROVINY, self::ROWID,
        self::TABLE_SUROVINY_NAZEV, self::TABLE_SUROVINY_POPIS));
    }
  }


/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-03 at 10:16:22.
 */
class PDOOpenHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PDOOpenHelper
     */
    protected $h, $db;
    private $dbname = 'test';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->h = new DBHandlerMysqlMemory($this->dbname);
        $this->db = $this->h->MySQL('localhost', 'root', 'geniv')->getDatabase(true);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->h->close();  //zavreni handleru
    }
//TODO zrevidovat testy!!
//TODO otestovat, prepsat testy!!!
    /**
     * @covers PDOOpenHelper::SQLite3
     */
    public function testSQLite3()
    {
      //~ $h = new PDOHelper('');
      //~ $this->assertEquals('', $h->getDatabaseName());
      //~ $this->assertEquals('', $h->getDatabasePath());
      //~ $h->SQLite3();
      //~ $this->assertEquals(PDOHelper::SQLITE_MEMORY, $h->getSQLitePath());
      //~ $h->SQLite3('mujpath');
      //~ $this->assertEquals(PDOHelper::SQLITE_MEMORY, $h->getSQLitePath());
      //~ $this->assertFalse($h->getDatabase()->isMySQL());
      //~ $this->assertTrue($h->getDatabase()->isSQLite());
//~
      //~ $h = new PDOHelper('nazevdb');  //defaultni path
      //~ $this->assertEquals('nazevdb', $h->getDatabaseName());
      //~ $this->assertEquals('', $h->getDatabasePath());
      //~ $h->SQLite3();
      //~ $this->assertEquals('nazevdb', $h->getSQLitePath());
      //~ $h->SQLite3(__DIR__);
      //~ $this->assertEquals(__DIR__.'/nazevdb', $h->getSQLitePath());
//~
      //~ $h->deleteDatabase();
//~
      //~ $h = new PDOHelper('nazevdb', array('path' => __DIR__));  //vlastni path
      //~ $this->assertEquals('nazevdb', $h->getDatabaseName());
      //~ $this->assertEquals(__DIR__, $h->getDatabasePath());
      //~ $h->SQLite3();
      //~ $this->assertEquals(__DIR__.'/nazevdb', $h->getSQLitePath());
      //~ $h->SQLite3(__DIR__);
      //~ $this->assertEquals(__DIR__.'/nazevdb', $h->getSQLitePath());
//~
      //~ $h->deleteDatabase();
//~
      //~ $h->close();
    }

    /**
     * @covers PDOOpenHelper::MySQL
     */
    public function testMySQL()
    {
        $h = new DBHandlerMysqlMemory('');
        $this->assertEquals('', $h->getDatabaseName());
        $h->setDatabaseName($this->dbname);
        $this->assertEquals($this->dbname, $h->getDatabaseName());
        $db = $h->MySQL('localhost', 'root', 'geniv')->getDatabase();
        $this->assertEquals('mysql', $h->getDatabase()->getDriverName());
        $this->assertTrue($h->getDatabase()->isMySQL());
        $this->assertFalse($h->getDatabase()->isSQLite());

        $h->close();
    }

    public function testMySQL1()
    {
        $h = new DBHandlerMysqlMemory('');
        $def = array(
                      'host' => 'localhost',
                      'username' => 'root',
                      'password' => 'geniv',
                      //~ 'port' => 3306,
                      //~ 'options' => '',
                    );
        $db = $h->MySQL($def)->getDatabase();
        $this->assertTrue($db->isMySQL());
    }

    /**
     * @expectedException PDOException
     */
    public function testMySQLException1() //chyby uzivatel
    {
        $h = new DBHandlerMysqlMemory('');
        $db = $h->MySQL('localhost');
    }

    /**
     * @expectedException PDOException
     */
    public function testMySQLException2() //chyby heslo
    {
        $h = new DBHandlerMysqlMemory('');
        $db = $h->MySQL('localhost', 'root');
    }

    /**
     * @expectedException PDOException
     */
    public function testMySQLException3() //chyby chyby heslo
    {
        $h = new DBHandlerMysqlMemory('');
        $db = $h->MySQL('localhost', 'root', null);
    }

    /**
     * @covers PDOOpenHelper::getDatabase
     */
    public function testGetDatabase()
    {
        $h = new DBHandlerMysqlMemory($this->dbname);
        $this->assertEquals($this->dbname, $h->getDatabaseName());
        $db = $h->MySQL('localhost', 'root', 'geniv')->getDatabase();
        $this->assertInstanceOf('classes\PDODatabase', $h->getDatabase());

        $h->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testException1()
    {
        //od PHP 5.3 kde byla sqlite2 databaze vypustena!
        $h = new DatabaseHandler('');
        $h->SQLite2()->getDatabase();
    }

    /**
     * @expectedException PDOException
     */
    public function testException2()
    {
        $h = new DBHandlerMysqlMemory($this->dbname.'AA');
        $db = $h->MySQL('localhost', 'root', 'geniv')->getDatabase();
        $h->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testException3()
    {
        $h = new DBHandlerMysqlMemory($this->dbname);
        $db = $h->MySQL('localhostAA', 'root', 'geniv')->getDatabase();
        $h->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testException4()
    {
        $h = new DBHandlerMysqlMemory($this->dbname);
        $db = $h->MySQL('localhost', 'rootAA', 'geniv')->getDatabase();
        $h->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testException5()
    {
        $h = new DBHandlerMysqlMemory($this->dbname);
        $db = $h->MySQL('localhost', 'root', 'genivAA')->getDatabase();
        $h->close();
    }

    public function testInsert() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev 2')
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu 2');

        $this->assertGreaterThan(0, $db->insert(DatabaseHandler::TABLE_SUROVINY, $val));
    }

    public function testDupliciteInsert() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev 2 - duplicite')
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu 2');

        $db->insert(DatabaseHandler::TABLE_SUROVINY, $val);
        $this->assertEquals(-1, $db->insert(DatabaseHandler::TABLE_SUROVINY, $val));
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionInsert() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev 2')
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu 2');

        $db->insert(DatabaseHandler::TABLE_SUROVINY.'AA', $val);
    }

    public function testInsertOrThrow() {
        $db = $this->db;

        $d = date('Y-m-d H:i:s');
        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev - '.$d)
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu - '.$d);

        //nesmi skoncit vyjimkou, budou ce vkladat neustale unikatni hodnoty
        $id = $db->insertOrThrow(DBHandlerMysqlMemory::TABLE_SUROVINY, $val);
        $this->assertGreaterThan(1, $id);
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionInsertOrThrow()
    {
        $db = $this->db;

        $c = $db->rawQuery('select * from '.DatabaseHandler::TABLE_SUROVINY);
        $this->assertGreaterThan(0, count($c));
        $c->close();

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev 1 - first')
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu 1');

        $db->insertOrThrow(DBHandlerMysqlMemory::TABLE_SUROVINY, $val); //1 vlozeni
        $db->insertOrThrow(DBHandlerMysqlMemory::TABLE_SUROVINY, $val); //duplicitni vlozeni vyvola vyjimku
    }

    public function testUpdate() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev - update - '.date('Y-m-d H:i:s'));

        $aff = $db->update(DBHandlerMysqlMemory::TABLE_SUROVINY, $val,
                  DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV.'=?',
                  array('nazev 2'));

        $this->assertEquals(1, $aff);
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionUpdate() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev - update - '.date('Y-m-d H:i:s'));

        $aff = $db->update(DBHandlerMysqlMemory::TABLE_SUROVINY-'AA', $val,
                  DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV.'=?',
                  array('nazev 2'));

        $this->assertEquals(1, $aff);
    }

    public function testDelete() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev 2 - prodelete')
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu 2 - delete');

        $db->insert(DatabaseHandler::TABLE_SUROVINY, $val);

        $aff = $db->delete(DatabaseHandler::TABLE_SUROVINY, DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV.'=?', array('nazev 2 - prodelete'));
        $this->assertEquals(1, $aff);
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionDelete() {
        $db = $this->db;

        $val = new ContentValues;
        $val->put(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, 'nazev 3 - prodelete')
            ->put(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, 'popis nazvu 3 - delete');

        $db->insert(DatabaseHandler::TABLE_SUROVINY, $val);

        $aff = $db->delete(DatabaseHandler::TABLE_SUROVINY.'AA', DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV.'=?', array('nazev 2 - prodelete'));
        //$this->assertEquals(1, $aff);
    }

    public function testQuery() {
        $db = $this->db;

        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        $this->assertGreaterThan(1, $c->count());
        $this->assertGreaterThan(1, $c->getCount());
        $this->assertEquals($c->count(), $c->getCount());

        $it = $c->getMoveIterator();
        $this->assertEquals('string', $it->getType(0));
        $this->assertEquals(0, $it->getPosition());
        $c->close();
    }
//TODO vic prikladu na query!
    /**
     * @expectedException PDOException
     */
    public function testExceptionQuery() {
        $db = $this->db;
        $c = $db->query(DatabaseHandler::TABLE_SUROVINY.'AA', array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        $c->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionQuery1() {
        $db = $this->db;
        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV.'AA', DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        $c->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionQuery2() {
        $db = $this->db;
        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS), 'AA');
        $c->close();
    }

    public function testRawQuery() {
        $db = $this->db;

        $sql = sprintf('select * from %s where _id = ?;', DatabaseHandler::TABLE_SUROVINY);
        $c = $db->rawQuery($sql, array(1));
        $this->assertEquals(1, count($c));
        $this->assertEquals(3, $c->getColumnCount());
        $c->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionRawQuery() {
        $db = $this->db;
        $sql = sprintf('select * from %s where _id = ?;', DatabaseHandler::TABLE_SUROVINY.'AA');
        $c = $db->rawQuery($sql, array(1));
        $c->close();
    }

    /**
     * @expectedException PDOException
     */
    public function testExceptionExecSQL() {
      $db = $this->db;
      $sql = sprintf('select * from %s;', DatabaseHandler::TABLE_SUROVINY.'AA');
      $b = $db->execSQL($sql);
    }

    public function testGetAvailableDrivers() {
      $db = $this->db;
      //muze se lisit na zaklade instalace
      $this->assertEquals(\PDO::getAvailableDrivers(), $db->getAvailableDrivers());
    }

    public function testGetDriverName() {
      $db = $this->db;
      $this->assertEquals('mysql', $db->getDriverName());

      $h = new DatabaseHandler('');
      $db1 = $h->SQLite3()->getDatabase();
      $this->assertEquals('sqlite', $db1->getDriverName());
      $h->close();
    }

    public function testContentValues() {
      $c = new ContentValues();
      $this->assertEquals(0, $c->size());

      $c->put('k1', 'v1');
      $this->assertEquals(1, $c->size());
      $this->assertEquals('v1', $c->get('k1'));

      $this->assertTrue($c->containsKey('k1'));
      $this->assertFalse($c->containsKey('kX'));

      $this->assertTrue($c->getAsBoolean('k1'));
      //$this->assertFalse($c->getAsBoolean('kX'));

    }

    public function testContentValues2() {
      $c = new ContentValues();

      $c->put('k2', 3.14);
      $this->assertEquals(1, $c->size());
      $this->assertEquals(3.14, $c->getAsFloat('k2'));
      $this->assertEquals(3, $c->getAsInteger('k2'));
      $this->assertEquals('3.14', $c->getAsString('k2'));
    }

    public function testContentValues3() {
      $c = new ContentValues();

      $pole = array('a' => 1, 'b' => 2);
      $c->put($pole);
      $this->assertEquals(2, $c->size());
      $this->assertTrue($c->containsKey('a'));
      $this->assertTrue($c->containsKey('b'));
      $this->assertFalse($c->containsKey('c'));
      $this->assertEquals(1, $c->getAsInteger('a'));
      $this->assertEquals(2, $c->getAsInteger('b'));
      $this->assertEquals('2', $c->getAsString('b'));
    }

    public function testContentValues4() {
      $pole = array('a' => 1, 'b' => 2);

      $cx = new ContentValues($pole);
      $cx->put('k', 'v');
      $this->assertEquals(3, $cx->size());
      $this->assertTrue($cx->containsKey('a'));
      $this->assertTrue($cx->containsKey('b'));
      $this->assertTrue($cx->containsKey('k'));
      $this->assertFalse($cx->containsKey('c'));
      $this->assertEquals(1, $cx->getAsInteger('a'));
      $this->assertEquals(2, $cx->getAsInteger('b'));
      $this->assertEquals('v', $cx->getAsString('k'));
    }

    public function testContentValues5() {
      $cd = new ContentValues;
      $cd->putDate('cas');
      $cd->putDate('cas2', '+1 day', 'd.m.Y');
      $this->assertTrue($cd->containsKey('cas'));
      $this->assertTrue($cd->containsKey('cas2'));
      $this->assertEquals(date('Y-m-d H:i:s'), $cd->getAsString('cas'));
      $this->assertEquals(date('d.m.Y', strtotime('+1 day')), $cd->getAsString('cas2'));
    }

    public function testContentValues6() {
      $c = new ContentValues;
      $pole = array('a' => 1, 'b' => 2);
      $c->put($pole); // ulozeni pole do $c

      $c2 = new ContentValues;
      $c2->putAll($c);  // vlozeni cele instance ContentValues
      $this->assertEquals($c, $c2);
      $this->assertEquals(2, $c2->size());

      $c3 = new ContentValues($c2);
      $this->assertEquals($c2, $c3);
      $this->assertEquals(2, $c3->size());

      $c3->putNull('k2');
      $this->assertNull($c3->get('k2'));

      $c3->remove('k2');
      $this->assertFalse($c3->containsKey('k2'));
      $this->assertEquals(2, $c3->size());

      $c3->clear();
      $this->assertEquals(0, $c3->size());
    }
/*
    public function testCursor() {
        $db = $this->db;

        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        $this->assertEquals(2, $c->getColumnCount());
        $this->assertEquals(2, $c->getColumnCount());
        $this->assertEquals(0, $c->getColumnIndex(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV));
        $this->assertEquals(1, $c->getColumnIndex(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        $this->assertEquals(-1, $c->getColumnIndex(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS.'AA'));
        $this->assertEquals(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, $c->getColumnName(0));
        $this->assertEquals(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS, $c->getColumnName(1));
        $this->assertEquals('', $c->getColumnName(2));
        $this->assertEquals(array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS), $c->getColumnNames());
        $this->assertEquals($c->count() , $c->getCount());

        //pokus indexu
        $this->assertTrue($c->isFirst());
        $this->assertFalse($c->isLast());
        $this->assertEquals(0, $c->getPosition());
        $this->assertTrue($c->moveToNext());
        $this->assertTrue($c->isBeforeFirst());
        $this->assertEquals(1, $c->getPosition());
        $this->assertFalse($c->isFirst());

        $this->assertTrue($c->moveToPrevious());
        $this->assertTrue($c->isFirst());
        $this->assertFalse($c->isLast());
        $this->assertEquals(0, $c->getPosition());
        $this->assertFalse($c->moveToPrevious());
        $this->assertFalse($c->moveToPrevious());
        $this->assertEquals(0, $c->getPosition());

        $this->assertTrue($c->moveToLast());
        $this->assertFalse($c->isFirst());
        $this->assertTrue($c->isLast());
        $this->assertEquals($c->getPosition(), $c->count() - 1);
        $this->assertEquals($c->getPosition(), $c->getCount() - 1);

        $this->assertFalse($c->isAfterLast());
        $this->assertTrue($c->moveToPrevious());
        $this->assertTrue($c->isAfterLast());

        //relativni posun
        $this->assertTrue($c->move(-1));
        $this->assertEquals($c->count()-3, $c->getPosition());
        $this->assertFalse($c->move(20));

        //absolutni posun
        $this->assertTrue($c->moveToPosition(4));
        $this->assertEquals(4, $c->getPosition());
        $this->assertFalse($c->moveToPosition(count($c) + 5));
        $this->assertFalse($c->moveToPosition(-5));
        $this->assertTrue($c->close());

        //iterace 1
        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        $this->assertTrue($c->moveToFirst());
        do {  //TODO tento zpusob iterace je nestastny
          //~ var_dump($c);
          $this->assertTrue(!is_null($c->getString(0)));
          $this->assertTrue(!is_null($c->getString(1)));
        } while ($c->moveToNext());
        $this->assertTrue($c->close());

        $nazev = DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV;
        $popis = DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS;
        //iterace 2
        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        while ($c->hasNext()) {
          $r = $c->nextRow();

          $this->assertCount(2, $r);
          foreach ($r as $k => $v) {
            $this->assertTrue(!is_null($k));
            $this->assertTrue(!is_null($v));
          }

          $this->assertTrue(!is_null($r->nazev));
          $this->assertTrue(!is_null($r->popis));

          $this->assertTrue(!is_null($r[0]));
          $this->assertTrue(!is_null($r[1]));

          $this->assertTrue(!is_null($r[DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV]));
          $this->assertTrue(!is_null($r[DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS]));

          $this->assertTrue(!is_null($r->getString(0)));
          $this->assertTrue(!is_null($r->getString(1)));

          $this->assertTrue(!is_null($r->getString(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV)));
          $this->assertTrue(!is_null($r->getString(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS)));
        }
        $this->assertTrue($c->close());

        //iterace 3
        $c = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV, DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS));
        //foreach ($c as $k => $v) {
        foreach ($c as $v) {
          $this->assertFalse($v->isNull(0));

          $this->assertTrue(!is_null($v->nazev));
          $this->assertTrue(!is_null($v->popis));

          $this->assertTrue(!is_null($v[0]));
          $this->assertTrue(!is_null($v[1]));

          $this->assertTrue(!is_null($v[DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV]));
          $this->assertTrue(!is_null($v[DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS]));

          $this->assertTrue(!is_null($v->getString(0)));
          $this->assertTrue(!is_null($v->getString(1)));

          $this->assertTrue(!is_null($v->getString(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV)));
          $this->assertTrue(!is_null($v->getString(DBHandlerMysqlMemory::TABLE_SUROVINY_POPIS)));
        }
        $this->assertFalse($c->isClosed());
        $this->assertTrue($c->close());
        $this->assertTrue($c->isClosed());
    }
*/
    /**
     * @expectedException PDOException
     */
    public function testGetColumnIndexOrThrow() {
        $db = $this->db;

        $sql = sprintf('select * from %s;', DatabaseHandler::TABLE_SUROVINY);
        $c = $db->rawQuery($sql);
        $c->getColumnIndexOrThrow(DBHandlerMysqlMemory::TABLE_SUROVINY_NAZEV.'AA');
        $c->close();
    }

    //TODO testy na zamky databaze!

    //~ public function testMainClass() {
        //~ $db = $this->db;

        //$db = $this->handle->setDatabaseName('pokus')->MySQL('localhost', 'root', 'geniv')->getDatabase();

//FIXME revidovat testy!!!!! + vice testu na exception
//→tim i doresit ty zbytene try cache bloky
        //~ $h = new DatabaseHandler('pdotest.sqlite3');  //aplikovat priparne cestu primo k name, ale zvlast!
        //~ $db = $h->SQLite3(__DIR__)->getDatabase();
        //~ //$this->assertEquals(__DIR__, $h->getDatabasePath());
//~
        //~ //ContentValues
        //~ $val = new ContentValues;
        //~ $val->put(DatabaseHandler::TABLE_SUROVINY_NAZEV, 'nazev 1')
            //~ ->put(DatabaseHandler::TABLE_SUROVINY_POPIS, 'popis nazvu 1');
//~
        //~ $this->assertEquals('nazev 1', $val->get(DatabaseHandler::TABLE_SUROVINY_NAZEV));
        //~ $this->assertEquals(null, $val->get(DatabaseHandler::TABLE_SUROVINY_NAZEV.'_not'));
//~
        //~ PDODatabase::setExceptionOut(PDODatabase::EXCEPTION_ECHO);
//~
        //~ $this->assertEquals(PDODatabase::EXCEPTION_ECHO, PDODatabase::getExceptionOut());
//~
        //~ //delete:
        //~ $this->assertGreaterThanOrEqual(0, $db->delete(DatabaseHandler::TABLE_SUROVINY, DatabaseHandler::TABLE_SUROVINY_NAZEV.'=?', array('nazev 1')));
//~
        //~ //insert
        //~ $this->assertGreaterThan(0, $db->insert(DatabaseHandler::TABLE_SUROVINY, $val));
//~
        //~ //delete 2
        //~ $this->assertGreaterThanOrEqual(0, $db->delete(DatabaseHandler::TABLE_SUROVINY, DatabaseHandler::TABLE_SUROVINY_NAZEV.'=?', array('nazev 2')));
//~
        //~ //update 2
        //~ $val2 = new ContentValues;
        //~ $val2->put(DatabaseHandler::TABLE_SUROVINY_NAZEV, 'nazev 2 uprava')
            //~ ->put(DatabaseHandler::TABLE_SUROVINY_POPIS, 'popis nazvu 3 uprava');
        //~ $this->assertEquals(0, $db->update(DatabaseHandler::TABLE_SUROVINY, $val2, DatabaseHandler::TABLE_SUROVINY_NAZEV.'=?', array('nazev 2')));
//~
        //~ //insert 3
        //~ $val = new ContentValues;
        //~ $val->put(DatabaseHandler::TABLE_SUROVINY_NAZEV, 'nazev 2')
            //~ ->put(DatabaseHandler::TABLE_SUROVINY_POPIS, 'popis nazvu 3');
        //~ $this->assertGreaterThan(0, $db->insert(DatabaseHandler::TABLE_SUROVINY, $val));
//~
        //~ //delete 4
        //~ $this->assertGreaterThanOrEqual(0, $db->delete(DatabaseHandler::TABLE_SUROVINY, DatabaseHandler::TABLE_SUROVINY_NAZEV.'=?', array('nazev 2 uprava')));
//~
        //~ //update 4
        //~ $val2 = new ContentValues;
        //~ $val2->put(DatabaseHandler::TABLE_SUROVINY_NAZEV, 'nazev 2 uprava')
            //~ ->put(DatabaseHandler::TABLE_SUROVINY_POPIS, 'popis nazvu 3 uprava');
        //~ $this->assertEquals(1, $db->update(DatabaseHandler::TABLE_SUROVINY, $val2, DatabaseHandler::TABLE_SUROVINY_NAZEV.'=?', array('nazev 2')));
//~
        //~ //insert 5
        //~ $val = new ContentValues;
        //~ $val->put(DatabaseHandler::TABLE_SUROVINY_NAZEV, 'nazev 2')
            //~ ->put(DatabaseHandler::TABLE_SUROVINY_POPIS, 'popis nazvu 3');
        //~ $this->assertGreaterThan(0, $db->insert(DatabaseHandler::TABLE_SUROVINY, $val));
//~
//~
        //~ $cur = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV), DatabaseHandler::ROWID.'=?', array(8));
        //~ $this->assertEquals(0, count($cur));
//~
        //~ $cur = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV));
        //~ $this->assertEquals(3, count($cur));
        //~ $this->assertEquals(3, $cur->getCount());
//~
        //~ $this->assertEquals(array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV), $cur->getColumnNames());
//~
//~
        //~ $this->assertEquals(DatabaseHandler::TABLE_SUROVINY_NAZEV, $cur->getColumnName(1));
        //~ $this->assertEquals('', $cur->getColumnName(3));
//~
        //~ $this->assertEquals(0, $cur->getColumnIndex(DatabaseHandler::ROWID));
        //~ $this->assertEquals(1, $cur->getColumnIndex(DatabaseHandler::TABLE_SUROVINY_NAZEV));
//~
        //~ $this->assertEquals(1, $cur->getColumnIndexOrThrow(DatabaseHandler::TABLE_SUROVINY_NAZEV));
//~
        //~ $this->assertEquals(2, $cur->getColumnCount());
//~
        //~ //test pozice 1
        //~ $this->assertEquals(0, $cur->getPosition());
        //~ $this->assertTrue($cur->moveToNext());
        //~ $this->assertTrue($cur->moveToNext());
        //~ $this->assertFalse($cur->moveToNext());
        //~ $this->assertEquals(2, $cur->getPosition());
//~
        //~ //test pozice 2
        //~ $this->assertTrue($cur->moveToFirst());
        //~ $this->assertEquals(0, $cur->getPosition());
//~
        //~ $this->assertFalse($cur->moveToPosition(-2));
        //~ $this->assertEquals(0, $cur->getPosition());
//~
        //~ $this->assertTrue($cur->moveToPosition(2));
        //~ $this->assertEquals(2, $cur->getPosition());
//~
        //~ $this->assertFalse($cur->moveToPosition(5));
        //~ $this->assertEquals(2, $cur->getPosition());
//~
        //~ $this->assertFalse($cur->moveToPosition('a'));
        //~ $this->assertEquals(2, $cur->getPosition());
//~
        //~ //test pozice 3
        //~ $this->assertTrue($cur->moveToLast());
        //~ $this->assertEquals(2, $cur->getPosition());
//~
        //~ $this->assertTrue($cur->moveToPrevious());
        //~ $this->assertEquals(1, $cur->getPosition());
//~
        //~ $this->assertTrue($cur->moveToPrevious());
        //~ $this->assertEquals(0, $cur->getPosition());
//~
        //~ $this->assertFalse($cur->moveToPrevious());
        //~ $this->assertEquals(0, $cur->getPosition());
//~
        //~ //test iterace 1
        //~ if ($cur->moveToFirst()) {
          //~ $this->assertTrue($cur->moveToFirst());
          //~ $this->assertEquals(0, $cur->getPosition());
          //~ $this->assertTrue($cur->isFirst());
          //~ $b = array();
          //~ $p = 0;
          //~ do {
            //~ if ($p == 1) {
              //~ $this->assertTrue($cur->isBeforeFirst());
            //~ } else {
              //~ $this->assertFalse($cur->isBeforeFirst());
            //~ }
            //~ $this->assertGreaterThanOrEqual(1, $cur->getInt(0));
            //~ $b[] = $cur->getString(1);
            //~ $this->assertTrue($cur->isNull(2));
            //~ if ($p == ($cur->getCount() - 2)) {
              //~ $this->assertTrue($cur->isAfterLast());
            //~ }
            //~ $p++;
          //~ } while ($cur->moveToNext());
          //~ $this->assertTrue($cur->isLast());
          //~ $this->assertEquals(array('nazev 1', 'nazev 2', 'nazev 2 uprava'), $b);
        //~ }
//~
        //~ //test iterace 2
        //~ $cur = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV));
        //~ $a = $b = array();
        //~ while ($cur->hasNext()) {
          //~ $r = $cur->nextRow();
          //~ $this->assertGreaterThanOrEqual(1, $r->getInt(0));
          //~ $a[] = $r->getString(DatabaseHandler::TABLE_SUROVINY_NAZEV);
          //~ $b[] = $r->getString(1);
        //~ }
        //~ $this->assertEquals(array('nazev 1', 'nazev 2', 'nazev 2 uprava'), $a);
        //~ $this->assertEquals(array('nazev 1', 'nazev 2', 'nazev 2 uprava'), $b);
//~
        //~ //test iterace 3
        //~ $cur = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV));
        //~ $a = $b = array();
        //~ foreach ($cur as $k => $v) {
          //~ $b[] = $k;
          //~ $this->assertGreaterThanOrEqual(1, $v->getInt(0));
          //~ $a[] = $v->getString(1);
        //~ }
        //~ $this->assertEquals(array('nazev 1', 'nazev 2', 'nazev 2 uprava'), $a);
        //~ $this->assertEquals(array(0, 1, 2), $b);
//~
        //~ $cur = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV));
        //~ $a = $b = array();
//~
        //~ foreach ($cur as $k => $v) {
          //~ $b[] = $k;
          //~ $this->assertGreaterThanOrEqual(1, $v->getInt(0));
          //~ $a[] = $v->getString(1);
        //~ }
        //~ $this->assertEquals(array('nazev 1', 'nazev 2', 'nazev 2 uprava'), $a);
        //~ $this->assertEquals(array(0, 1, 2), $b);
//~
        //~ //test zavirani
        //~ $this->assertFalse($cur->isClosed());
        //~ $this->assertTrue($cur->close());
        //~ $this->assertTrue($cur->isClosed());
    //~ }

    // cisteni databaze
    public function testTruncateTable() {
        $db = $this->db;
        $db->truncate(DatabaseHandler::TABLE_SUROVINY);
        $this->assertTrue($db->isMySQL());
    }
}
