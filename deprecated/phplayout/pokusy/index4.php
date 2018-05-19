<?php

class DbModel
{ //datova vrstva
  static function insertTable()
  {
    //$result = new self;
    //var_dump($result);
    //var_dump(self::$table);
  }

  //metoda tridy
  static function InstallTable($class)
  {
    //var_dump(self::konst_bun);
    //var_dump(func_get_args());
    $inst = new $class;
    echo "instaluj: {$inst->table["name"]}...\n"; // "instaluju: {$class}, ({$a})"
  }
}

class Hlavicka extends DbModel
{
  public $table = array("name" => "hlavicka",
                        "struct" => array("id" => "integer+insigned",
                                          "adresa" => "text",
                                          "nazev" => "varchar(200)",
                                          "zamek" => "bool",
                                          "popis" => "text",
                                          ),
                          );

  public static function InstallTable() { parent::InstallTable(__CLASS__); }

  public static function All()  //pres ::
  {
    echo "funkceee All\n";
  }
}

class Bunka extends DbModel
{
  public $table = array("name" => "bunka",
                        "struct" => array("id" => "integer+insigned",
                                          "hlavicka" => "integet",
                                          //"nazev" => "varchar(200)",
                                          //"zamek" => "bool",
                                          //"popis" => "text",
                                          ),
                          );

  public static function InstallTable() { parent::InstallTable(__CLASS__); }
}

//var_dump(Hlavicka::dbStruct);
//Hlavicka::createTable(Hlavicka::dbStruct);
//var_dump(Hlavicka::createTable());
//var_dump(Bunka::createTable());

class DynamicTable
{
  public function __construct()
  {
    //instalace tabulek
    Hlavicka::InstallTable("ahosssj");
    Bunka::InstallTable("uviiiii");
  }

  public static function Admin()
  {

    //$a = new SplInt(3);
    $inst = new self; //zavolano samotneho konstruktoru
//ue?
    Hlavicka::All();

    return "ahoj\n";
  }

}

//echo DynamicTable::Admin();

//header("Content-type: image/jpeg");
//var_dump(imagick::CHANNEL_GREEN);
//$image = new Imagick("opossum.jpg");
//$image->thresholdImage(16000);
//echo $image;
//$image = new Imagick("plasma.gif");
//getimagesize("plasma.gif"),
//var_dump($image->getImageDepth());
//$image->getQuantumRange()

//$customer=new Customer();
//$customer->name="MY NAME";
//$customer->insert()

?>
