<?php
  include_once "funkce.php";
  include_once "login.php";
  include_once "promenne.php";

class SuperKlik
{
  public $var;
//******************************************************************************
/* konstuktor layoutu
 *
 * name: __construct
 * @param void
 * @return stranky
 */
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login(); //vytvoření objektu login
    $this->var->main = new HlavniFunkce($this->var); //vytvoření objektu vytvoření hlavní funkce

    $this->var->main->StartCas();

    if ($con = $this->var->main->OtevriMySQLi())//$this->var,$this->login$this->var,
    {
      $this->var->main->InstalaceMySQLi();//$this->var, $this->login

      $result = include "{$this->var->form}/index_on.php";

      $this->var->main->ZavriMySQLi(); //uzávěr databáze
    }
      else
    {
      $result = $this->var->chyba; //návrat chyby
    }

    echo $result;
  }
//******************************************************************************
}

$web = new SuperKlik();
?>
