<?php
/*
 *      index.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

/**
 *
 * Užité technologie:
 *
 * pro zobrazeni:
 * http://doc.nette.org/cs/nette-forms
 * http://texy.info/
 * http://tinymce.moxiecode.com/
 *
 *
 * pro php:
 * http://www.php.net/manual/en/language.oop5.php
 * http://www.php.net/manual/en/class.arrayaccess.php
 * http://www.notorm.com/ (http://zdrojak.root.cz/clanky/databaze-v-php-elegantne-s-notorm/)
 * http://cz.php.net/class.pdo
 * http://code.google.com/p/phpbrowscap/
 *
 * http://framework.zend.com/docs/translations
 *
 * http://code.google.com/p/imagic/
 *
 * pro bezpečnost:
 * php vrana - 863.js
 *
 *
 * mozne pouziti do budoucna:
 * http://dibiphp.com/
 * http://www.adminer.org/
 * http://www.notorm.com/
 *
 * json_decode/json_encode
 *
 * http://www.modernizr.com/
 * http://diveintohtml5.org/
 *
 **/

  class DataModel {
    //metoda na nacitani datoveho modelu ze zaane tabulky
    //tady pry maji byt metody ktere ma tabluka stejny

  }

  class TableManager {

    //TODO ?? jen na tabulku?? a nebo to bude na skupinu???
    public function InstallTable($table)
    {
      //aby se nemusela vypisovat kazda tabulka???

    }
  }

  //TODO pripadne tu nacitat konfig pro dany web?!
  //include 'class/module_main.php';

  function __autoload($name) {
    $dir = str_replace(array("\\"), array("/"), strtolower($name));
    $nazev = basename($dir);
    //$cesta = "class/{$nazev}/{$nazev}.php";

    $slozka = dirname($dir);

    $pripona = '';
    switch ($slozka) {
      case 'modules': //modulove tridy
        $pripona = 'modul';
      break;

      case 'classes': //hlavni tridy
        $pripona = 'class';
      break;

      case 'implementes': //implementacni tridy
        $pripona = 'implements';
      break;
    }
//FIXME jinak posefovat nacitani trid!!!!! resp doladit!!!!!
    //ignorovane nazvy
/*
    switch ($nazev) {
      case 'arrayaccess':
      break;

      default:

      break;
    }
*/

    $cesta = "{$dir}/{$nazev}_{$pripona}.php";

    if (file_exists($cesta)) {
      include_once $cesta;
    } else {
      throw new Exception("problém... třída: <strong>{$cesta}</strong> nelze najít...");
    }

//$param = func_get_args();, $param
//var_dump("<br><strong>", $name, $slozka, $cesta, file_exists($cesta),"</strong><br />");
//include $cesta;

  }

  class Module {
    //trida pro globalni metody pro obsluhu modulu

  }

  class Table {
    //trida pro globalni metody pro obsluhu tabulek

    public static function __callStatic($name, $args) {
      //var_dump($name, $args);
      $class = "Table_{$name}"; //slozeji jmena pro slozeni volane metody
      $datamodel = $class::getDataModel();  //nacteni datoveho modulu z tabulky

      var_dump(__CLASS__, $name, $datamodel);
    }
  }

  class LayoutMain {
  //hlavni trida webu ktera se bude starat o skladani zakladni stranky
    const PHPMIN = '5.3.0';

    public static function Initialization() {

      //prvotni overovani verze
      if (version_compare(PHP_VERSION, self::PHPMIN, '>=')) {
        //nacitani hlavnich veci
        //TODO dodelat
        echo "tu probiha inicializace...<br />";

        try {

          //Modules\Main::metoda("pokus volani tridy MAIN<br />");
          //Modules\Cron::metoda("a tu je pokus volani tridy CRON<br />");

          //Classes\Form::metoda("test statiky formulare");
//var_dump(Classes\Form::GET);
          $form = new Classes\Form;
          $form->addText('name', array('label' => "třeba login", 'value' => "log"));
          $form->addText('pass', array('label' => "třeba heslo", 'value' => "hes"));
          //var_dump($form->getMethod());
          //TODO odpsat dalsi klasicke metody
          echo $form;


        } catch (Exception $e) {
          //echo "hopla... chybka :)";
          echo "{$e->getMessage()}, na řádku: {$e->getLine()}, v: {$e->getFile()}<br />";
          echo "<pre>{$e->getTraceAsString()}</pre>";
        }

      } else {
        echo "Vaše verze php: <strong>".PHP_VERSION."</strong> neodpovídá minimální stanovené verzi: <strong>".self::PHPMIN."</strong>.";
        exit;
      }
    }
  }

//jide
  //Module::Main("AdminLog");
  //Table::AdminLog();
  //Module_Main::metoda();
  //Table::AdminLog();

  LayoutMain::Initialization();

?>
