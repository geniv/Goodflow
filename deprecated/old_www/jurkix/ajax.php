<?php
  include_once "promenne.php";
  include_once "funkce.php";

class Ajax
{
  public $var, $fun, $action, $akce, $co, $cislo, $sekce, $jmeno, $telefon, $email, $zprava;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->main = new Hlavni($this->var);
    
    $this->fun = $_GET["fun"];  //natazeni promennych
    $this->action = $_GET["action"];
    $this->akce = $_GET["akce"];
    $this->var->cislosekce = $this->akce; //predani cisla podsekce
    $this->co = $_GET["co"];
    $this->cislo = $_GET["cislo"];

    $this->sekce = $_GET["sekce"];
    
    $this->jmeno = $_GET["jmeno"];
    $this->telefon = $_GET["telefon"];
    $this->email = $_GET["email"];
    $this->zprava = $_GET["zprava"];

		$this->var->main->StartCas();

		echo $this->VolbaFunkce();
  }
//******************************************************************************
  function VolbaFunkce()
  {
    switch($this->fun)
    {
      //************************************************************************
      case "web": //webova stranka
        $result = $this->Stranka();  //vykresleni stranky
      break;
      //************************************************************************
      case "kontakt":
        if (!Empty($this->jmeno) &&
            !Empty($this->email) &&
            !Empty($this->zprava))
        {
          $result = $this->var->main->PridejKontakt($this->jmeno, $this->telefon, $this->email, $this->zprava);
        }
      break;
      //************************************************************************
    }

    return $result;
  }
//******************************************************************************
  function Stranka()
  {
    $novinky = include_once "novinky.php";
    $web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
    $obsah = $this->var->main->ObsahStrakny();
    $menu = $this->var->main->MenuAjax();
    $chyba = $this->var->chyba;
		$pocitadlo = $this->var->main->Pocitadlo();

    $result =
    "           <div id=\"menu\">
                  {$menu}
                </div>
                <div id=\"obal_obsah\">
                  <div id=\"obsah\">
                  	{$obsah}
                  	{$chyba}
                  </div>
                  <div id=\"obal_novinky\">
                    <div id=\"novinky_top\"></div>
                      <div id=\"novinky_obsah\">
                        {$novinky}
                      </div>
                    <div id=\"novinky_bottom\"></div>
                  </div>
                </div>
                <div id=\"zapati\">
                  {$this->var->main->KonecCas()}
                  <p>
                    {$this->var->main->TextSekce("zapati")} | {$pocitadlo}x | Valid <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict\" rel=\"nofollow\">xhtml</a> &amp; <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS 2.1\" rel=\"nofollow\">css</a> |
                  </p>
                </div>";

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

$web = new Ajax();
?>
