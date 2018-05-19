<?php

  namespace Modules;

  class Main {
    //trida modulu hlavni funkce

    public static function __callStatic($name, $args) {
      //
      var_dump($name);
    }

    public static function metoda($neco) {
      echo ":{$neco}";
    }


  }



  class Table_AdminLog {
    //trida tabulky adminlog

    protected static $model = array('table_name' => "adminlog",
                                    'table_struct' => array("id" => array("integer", "unsigned", "ai", "pk"),
                                                            "login" => array("varchar(100)"),
                                                            "wrongpass"=> array("varchar(100)"),
                                                            "datum"=> array("datetime"),
                                                            "ip"=> array("varchar(50)"),
                                                            "agent"=> array("varchar(300)"),
                                                            "pocet"=> array("integer", "unsigned"),
                                                            "language"=> array("varchar(100)"),
                                                            "cookie"=> array("text"),
                                                            "get"=> array("text"),
                                                            ),
                                    );

    public static function getDataModel() { return self::$model; }
  }

?>
