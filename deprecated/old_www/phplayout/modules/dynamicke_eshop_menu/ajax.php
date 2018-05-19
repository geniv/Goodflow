<?php
  include_once "../../default_modul.php";

class Ajax extends DefaultModule
{
  private $unikatni;
/**
 *
 * konstuktor ajaxu stranky s tiskem
 *
 * @return tisk vysledku dane funkce
 */
  public function __construct()
  {
    $this->unikatni = $this->NactiObsahSouboru(".unikatni_obsah.php");
    $this->prevod = $this->NactiUnikatniObsah($this->unikatni["ajax_prepis"]);
    echo $this->VyberFunkci();
  }

/**
 *
 * vybere provadenou akci ajaxu pres dane parmetry
 *
 * @return dana akce
 */
  private function VyberFunkci()  //vybere volanou funkci
  {
    //$action = (!Empty($_POST["action"]) ? $_POST["action"] : $_GET["action"]);
    //$web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
    //print_r($_GET);
    //print_r($_POST);
    //print_r($_SESSION);

    $result = "";

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        //uzivatele
        case "prepis": //post - prepis textu
          $result = $this->PrepisTextu($_POST["text"]);
        break;
      }
    }

    return $result;
  }

  private function PrepisTextu($text)
  {
    return strtr($text, $this->prevod);  //prevede text dle prevadecoho pole
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
