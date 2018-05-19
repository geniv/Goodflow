<?php
  include_once "funkce.php";
  include_once "login.php";
  include_once "promenne.php";

class Picture
{
  public $var;

/* konstuktor ajaxu stranky s tiskem
 *
 * name: __construct
 * @param void
 * @return tisk vysledku dane funkce
 */
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login(); //vytvoření objektu login
    $this->var->main = new HlavniFunkce($this->var); //vytvoření objektu vytvoření hlavní funkce

    $cesta = base64_decode(base64_decode($_GET["q"]));

    if (!Empty($cesta))
    {
      $hlavicka = get_headers($cesta);
      $typ = explode(" ", $hlavicka[2]);
      $typ = $typ[1];

      header("Content-Type: {$typ}"); //hlavička
      echo $this->var->main->OpenUrl($cesta);
    }
  }
}
  //header('Content-type: text/html; charset=UTF-8');//encodovat v php asi
  $web = new Picture();
?>
