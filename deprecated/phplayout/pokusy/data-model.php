<?php
  /*
   * Třída Table manager je zodpovědná za správu tabulek.  Slouží k:
   *  * vytváření CREATE
   *  * odstraňování DROP
   *  ...
   *FIXME: je třeba zajistit že TableManager je singleton! upravovat trikama!
   * http://cz.php.net/lsb
   * http://php.net/manual/en/language.oop5.patterns.php <<!
   *
   * TODO toto my byt Vzor singleton
   *
   * soustredeni metod pro manipulaci s tabulkami nikam nepatri
   */
  class TableManager
  {

    /*
     * Vytvoření tabulky v databázi, pokud neexistuje.
     */
    public function createTable()
    {
        //$a = func_get_args();
        //var_dump("vytvářím tabulku: {$a[0]["name"]}");
    }

    public function InstallTable($table)
    {
      //seskladani sql pro vytvoreni tabulky
      //var_dump($table);
    }
  }


  /*
   * Abstraktní třída datového modelu ze které kontkrétní datové modely dědí.
   * zodpovida za obecne metody kazde tabulky
   * nelze vytvaret instance tridy (s new)
   */
  abstract class DataModel
  {
    /*
     * Společná statická metoda pro přečtení záznamu z tabulky.
     * Protože ji používáme všude, posunuli jsme ji sem a z
     * jednotlivých modelů se volá pomocí trampolíny.
     */
    public static function get_by_id($dm, $id)
    {
      //staticka metoda ktera neumi $this na vlstni tridu! neni spojena ze zadnou instnci!
      //lze pto globalni komunikaci ve tride pouzit self (nini svazano s konkr.objektem)
      //daji se volat bez vytvoreni objektu (trida::metoda())
      //nevolat uvnitř metod s $this na volani metod z vlastní třídy, pouzivat self::metoda()
      //parent::metoda() pro volani staticke metody predka

      //var_dump($dm);

      // SELECT * FROM $dm->table_name WHERE id=$id
      //var_dump($dm, $dm["class_name"]);
      $nalezeno = true;  //docasne
      if ($nalezeno)
      {
        $entita = new $dm["class_name"];
        // naplníme entitu podle přečtených sql dat.
        return $entita;   // Entita je instance třídy $dm->class_name!!!

      }
        else
      {
        return null;
      }
    }//get_by_id

    public static function get_by_name($dm, $id)
    {
      return $objekt;
    }
  }

  //trida tabulky Hlavicka
  final class Hlavicka extends DataModel
  {
    //protected $xprom = array("prvekA" => "hodnotaA", "prvekB" => "hodnota B");
    /*
     * Asociativní pole které obsahuje vše co je třeba o datové
     * tabulce.  Většina hodnot je ReadOnly ale mohou zde také být
     * ReadWrite informace jako třeba nějaké cacheované věcí.  Třeba
     * promyslet.
     *FIXME: najít lepší jméno pro x
     */
    public static $x = array (
                              'class_name' => __CLASS__,
                              'table_name' => "hlavicka",  // mohlo by bý implicitní
                              'table_sctructure' => array("id" => "integer+insigned",
                                                          "titulek" => "pokusny typ textu",
                                                          "adresa" => "text",
                                                          "nazev" => "varchar(200)",
                                                          "zamek" => "bool",
                                                          "popis" => "text"),
                              );

    /*
     * Metody třídy/tabulky.  Zde jsou základní metody pro práci s
     * řádky.  Buď to je implementujeme, nebo jsou zde trampolíny do
     * statických metod v DataModel.  Je to tak proto, že PHP špatně
     * dědí statické metody.  Aby metody v DbModel mohly pracovat,
     * jako první parametr dostanou asociativní pole s informacemi o
     * tomto konkrétním modelu.
     */
    public static function get_by_id($id) { return parent::get_by_id(self::$x, $id); }
    public static function get_by_name($name) { return parent::get_by_name(self::$x, $name); }


    public function __construct()
    {
      $param = func_get_args(); //nacitani libovolnych parametru
      //...
    }

    public function __set($name, $val)  //nastavovani hodnot
    {
      //var_dump($name, $val);
      //priprava hodnoty pro insert/update: $pole[$name] = $val;
    }

    public function __get($name)  //nacitnai hodnot
    {
      var_dump($name);
      //nacitani z databaze pod indexem $name
      return self::$x["table_sctructure"][$name]; //prozatim vraceni typu
    }

    // Tato metoda je implementována zde protože je specifická pro tento model.
    static function get_by_poradi($poradi)
    {
      //FIXME: not yet implemented
    }

    public static function spatne()
    {
      // IMPEMENT SQL SELECT všech špatných hlaviček => $rows
      $result = array();   // množina/seznam
      foreach($rows as $row)
      {
          $e = new Hlavicka;  //??
          //$e naplnit z $row
          //$result.push($e)
      }

      return $result;
    }

    public static function all()
    {
      //vraceni jakych sloupcu????
      $pole = array("polozka 1", "pol 2 z db", "pol dal z db", "polozka 22", "polozka X 1", "polozka x3");
      //TODO nacitani dat z databaze...
      //vraceni vseho
      return $pole;
      //range(1, 20);  //pokusne vraceni cisel 1-20
    }

    /*
     * Obsah řádku tabulky se rezprezentuje objektem tohot typu
     * Hlavicka.  Musíme tedy mít pro každý sloupec/pole jeden atribut.
     */

    /* Mohlo by se refaktorizovat do DataModel. */
    public function put() {
      //IMPLEMENT SQL INSERT
    }


  }//end class Hlavicka


  //pro kopirovani (duplikaci) lze pouzivat $obj2 = clone $obj1 (vytvori novou instanci)
  //v __clone lze uvnit pouzivat $this

  //self:: a parent:: jsou rezervovane nazvy trid

  //psvm


  //instalace tabulek Hlavicka a Bunky
  $tm = new TableManager; //do $tm vlozi instanci tridy (vytvoreni instance tridy)
  $tm->InstallTable(Hlavicka::$x);  // $x je to jméno které je třeba vylepšit, volani metody instance
  //$tm->InstallTable(Bunky::$x);


  //vlozeni noveho radku do tabulky Hlavicka
  $h1 = new Hlavicka(array(/*pole 'implicitních' hondot*/));  //vytvoreni instance tridy
  $h1->titulek = 'muj titulek'; //nastaveni atributu/vlastnosti tridy
  $h1->put(); //zavolani metody tridy


  //navraveni radku z hlavicky pod indexem 123
  $hl = Hlavicka::get_by_id(123); //volani metody tridy, ktera vraci instanci tridy
  echo $hl->titulek;  //cteni atributu tridy


  // Metoda all nevrací objekt ale iterabilní množinu objektů.
  // v prekladu pro php vraci objektove nebo asociativni pole s nactenyma hodnotama (ktere se zvoly)
  //ale kde se zvolily?
  $hlavicky = Hlavicka::all();  //volani metody tridy, ktera vraci pole hodnot
  echo "<hr />";
  foreach ($hlavicky as $hlavicka)
  {
    //echo $hlavicka->titulek;
    echo "{$hlavicka}<br />";
  }

?>
