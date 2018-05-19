<?php
  include_once "funkce.php";
  include_once "login.php";
  include_once "promenne.php";

class Autorizace

{
  public $var;  //definice mistni promenne

/* konstruktor stranek
 *
 * name: __construct
 * @param void
 * @return echo navrat
 */
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login(); //vytvoření objektu login
    $this->var->main = new HlavniFunkce($this->var); //vytvoření objektu vytvoření hlavní funkce

    if ($con = $this->var->main->OtevriMySQLi())//$this->var,$this->login$this->var,
    {
      if (!Empty($_GET["action"]))
      {
        $obsah = $this->var->main->OvereniAutorizace($_GET["action"]);
      }

      $this->var->main->ZavriMySQLi(); //uzávěr databáze
    }
      else
    {
      $chyba = $this->var->chyba; //návrat chyby
    }

    $result =
    "
    <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
      \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
    <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">

    <head>
      <title></title>
      <meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\" />
      <meta name=\"generator\" content=\"Geany 0.13\" />
    </head>

    <body>
      {$obsah}
      {$chyba}
    </body>
    </html>
    ";

    echo $result;
  }
}

  $web = new Autorizace();
?>
