<?php

class DbModel
{
  public function createTable($var) //metoda
  {
    //do SQL create with this->dbStruct;
    var_dump($var);
  }
}

class Hlavicka extends DbModel
{
  //public $dbStruct = "bl bla lba int toto, varchar ono";
  const dbStruct = "bl bla lba int toto, varchar ono";
}

//var_dump(Hlavicka::dbStruct);
Hlavicka::createTable(Hlavicka::dbStruct);

?>
