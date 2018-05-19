<?php
/*
 * index.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  require 'loader.php'; //load autoload
  //Loader::setDebug(true);

  use
      classes\Core,
      classes\Debugger,

      //classes\Route,
      classes\Html,
      classes\Form,
      classes\StaticWeb,
      classes\HtmlPage,

      //SimpleXMLElement,

      classes\User,
      classes\UserStorage,
      classes\SimpleAuthenticator,
      classes\Permission,

      //~ Rain\Tpl,

      classes\Session,
      classes\Language

      //~ classes\DateAndTime,
      //~ classes\Response//,

      //classes\Browscap

      //classes\Form

      //classes\PDOOpenHelper,
      //classes\PDODatabase as PDODatabase,
      //classes\ContentValues as ContentValues
      ;



  //~ $err = error_get_last();
  //~ print_r($err);

  try {
    if (Core::checkPHP()) {

      Debugger::startTime('cache');

      $html = 'classes\Html';
      $form = 'classes\Form';

      //~ $configure = classes\Configurator::decode(require('config.php'));
      $configure = classes\Configurator::decode('global_config.php');
//~ var_dump($configure);

      //inicializace cache
      $cache = new classes\Cache;
      $cache->setCache($configure['cache']['enabled'])
            ->setCacheExpire($configure['cache']['expire'])
            ->setExceptionUri(array('admin'));

      //~ $cache->clearAllCache();

      //Debugger::startTime('po cache');

      //definice konstant
      $menuskel = array(
        'obal' => function($row) {
          $result = null;
          //prepinani podle levelu
          switch ($row['level']) {
            case 1:
              $result = Html::div()
                          ->class('level:%s_trida', $row['level'])
                          ->add($row['submenu'])
                          ;
            break;

            case 2:
              $result = Html::span()
                          ->class('level:%s_trida', $row['level'])
                          ->add($row['submenu'])
                          ;
            break;
          }
          return $result;
        },
        'menu' => function($row) {
            $result = null;

            $result = Html::a()->hrefrewrite('', array('action' => $row['url']))
                        //->id(Core::isFill($row, 'idsekce'))
                        //->title('%s - %s', array(Core::isFill($row, 'name'), Core::isFill($row, 'addition')))
                        ->class($row['active'] ? 'aktivni' : null)
                        //->setText(Core::isFill($row, 'name').', lvl: '.$row['level'].', (L:'.$row['poc']['local'][$row['level']].'/'.$row['count']['local'][$row['level']].', G:'.$row['poc']['global'].'/'.$row['count']['global'].')'.($row['poc']['global'] == 0 ? ' - prvni' : '').($row['poc']['global'] == $row['count']['global'] ? ' - posledni' : ''))
                        ->add(Html::span()->setText($row['name']))
                        ;

          return $result;
        }
      );

      $loadpages = array('' => 'pages\Home',
                        'suroviny' => 'pages\Suroviny',
                        'kategorie' => 'pages\Kategorie',
                        'jednotky' => 'pages\Jednotky',
                        'recepty' => 'pages\Recepty',
                        'slozeni' => 'pages\Slozeni',
                        );

      if ($cache->isCached()) {
        echo $cache->getOutBuff();
      } else {
        $cache->initOutBuff();

        $weburl = Core::getUrl();

        //vytvareni instanci
        $w = new StaticWeb(array('action/subakce'));
        $w->setLoadMenu($loadpages);

        $html::setBreakDepth(true);

//TODO autorizace → opraveni → admin pages → emaily
//po autorizaci se prejde na stranku admin/index.php (staticweb[pripadne rozsireny
  //o nejaky ficury potrebne u adminu])

/*
 * //TODO do TPL testu!
$var = array(
          "variable"  => "Hello",
          "version" => "3.0 Alpha",
          "menu"    => array(
                      array("name" => "Home", "link" => "index.php", "selected" => true ),
                      array("name" => "FAQ", "link" => "index.php/FAQ/", "selected" => null ),
                      array("name" => "Documentation", "link" => "index.php/doc/", "selected" => null )
                    ),
          "week"    => array( "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday" ),
          "title"   => "Rain TPL 3 - Easy and Fast template engine",
          "user"    => array(
                      array("name" => "Fede", "color" => "blue" ),
                      array("name" => "Sheska", "color" => "red" ),
                      array("name" => "Who", "color" => "yellow" ),
                    ),
          'website' => array('name' => 'Rain', 'url' => 'http://www.raincms.com'),
          "empty_array" => array(),
          "copyright" => "Copyright 2006 - 2012 Rain TPL<br>Project By Rain Team",

        );



$tpl = new classes\Tpl;
$tpl::setConfigure(array('auto_escape' => false));
$tpl
    ->assign("name", "Obi Wan Kenoby")
    ->assign('name', "žluťoučký kůň úpěl ďábelskými sračky :D")
    ->assign("pole", array('a' => 10, 'b' => 'kokus', 'c' => 'ahoj'))
    ->assign('html', 'classes\Html')
    ->assign('html2', Html::div())
    ->assign($var)
    ->setTemplate(file_get_contents('tpl/simple_template.html'));
//~ var_dump($tpl);
echo $tpl;

//~ var_dump(php_uname(), $_SERVER);

echo '<hr><hr>';
*/

        $maindata = array();

        $tpl = new classes\Tpl;
        //~ $tpl::setConfigure(array('auto_gen_dir' => true));
        //~ $tpl->installDirs();

        $maindata['tpl'] = $tpl;

        $asg = array(
                      'html' => 'classes\Html',
                      'weburl' => $weburl,
                      'index_menu' => $w->getMenu($menuskel),
                      'index_content' => $w->getContent($maindata),
                    );
        $tpl->assign($asg);


        //~ $body[] = $html::nav()->id('menu')->add($w->getMenu($menuskel));
        //~ $body[] = $html::section()->id('content')->add($w->getContent());//->add($f->render()); //, $frm->render()

        $page = new HtmlPage;
        $page->setTitle($w->getTitle())
            ->setUrl($weburl)
            ->addMetaTag('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
            ->addMetaTag('copyright', 'Created by GoodFlow design')
            ->addMetaTag('description', 'GoodFlow cook')
            //~ ->addBody($body)
            //~ ->addBody($frm->render())
            ->addBody($tpl->render('uniq_index.php'))
            ;

        echo $page;
        $cache->setOutBuff();
      }


      echo PHP_EOL.PHP_EOL.PHP_EOL.'<hr />'.PHP_EOL;
      Debugger::stopTime('cache');
      echo $cache->getCacheInfo();
      echo Debugger::viewTimes();

    } else {
      echo 'php neni v poradku';
    }

  } catch (Exception $e) {
    echo $e;
  }


















/*
var_dump('----------------------');

  //definice tabulek
  class DatabaseHandler extends PDOOpenHelper {

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

    public function __construct() {
      //parent::__construct('pokus'); //'nam.sqlite3'
      //parent::__construct('', array('target' => PDOOpenHelper::TARGET_MYSQL));
      //parent::__construct('', array('target' => PDOOpenHelper::TARGET_SQLITE3));
      parent::__construct('pokus', array('target' => PDOOpenHelper::TARGET_MYSQL, 'mysql_driver' => array('host' => 'localhost', 'user' => 'root', 'pass' => 'geniv')));
    }

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

  $handle = new DatabaseHandler();
  //$db = $handle->SQLite3()->getWritableDatabase();
  //$db = $handle->MySQL('localhost', 'root', 'geniv')->getDatabase();
  $db = $handle->getDatabase();


  $cur = $db->query(DatabaseHandler::TABLE_SUROVINY, array(DatabaseHandler::ROWID, DatabaseHandler::TABLE_SUROVINY_NAZEV));

  if ($cur->moveToFirst()) {
    do {
      var_dump($cur->getInt(0), $cur->getString(1));
      //var_dump($cur);
    } while ($cur->moveToNext());
  }

  $cur->close();
  $handle->close();
var_dump('----------------------');
*/


  //Debugger::startTime('web');

  //if (Core::checkPHP()) { //Core::isChrome()
    //Debugger::startTime();

    //$weburl = Core::getUrl();


//------------------------------------------------------------------------------
    /**
     * ----develop block----
     *
     * //TODO musi byt multilanguage
     *
     * materials/add+edit+del
     * units/add+edit+del
     * composition/add+edit+del
     * category/add+edit+del
     * recipe/add+edit+del
     * ((recipe/category))
     * search (by materials, by recipe, by category)
     *
     * pravidla:
     * defaultne:
     * action=$1
     * action=$1&itm=$2
     *
     */
//http://geniv-asus.local/www/svn/goodflow_cook/recipe/add

/*
    $routemodel = array('action/subakce/id/di/ouje',
                        'action==recipe/subakce2==blee/idd',
                        'action==recipe/subakce2/id==hu/dii',
                        'action==recipe/subakce2/id',
                        'action==units/subakce3==edit2/editid2==[0-9]+/si',
                        //'action==units/subakce3==edit2/editid2==[a-z]+/si',
                        'action==units/subakce3==edit/editid',
                        'action==units/subakce3/id',
                        );
    var_dump(Route::getUri($routemodel));
*/
//------------------------------------------------------------------------------
