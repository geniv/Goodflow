<?php
include_once "promenne.php";
include_once "funkce.php";

class Ajax
{
  public $var, $soub;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);

    echo $this->VyberFunkci();
  }
//******************************************************************************
  function VyberFunkci()
  {
    $action = (!Empty($_POST["action"]) ? $_POST["action"] : $_GET["action"]);
    $result = "";
    if (!Empty($action))
    {
      switch ($action)
      {
/*
        case "progress":  //post - vykreslovani progress baru
          $result = $this->var->main->PostupUploadu();
        break;
*/

        case "cssimport": //post - vykreslovani importu
          $style = $_POST["style"];
          settype($style, "integer");
          $result = $this->var->main->ListingImport($style);
        break;

        case "css": //get - ykreslovani global styles
          $style = $_GET["style"];
          settype($style, "integer");
          $result = $this->var->main->ViewCSS($style);
        break;

        case "pocfile": //post - vykreslovani input type file
          $jmeno = $_POST["jmeno"];
          $smer = $_POST["smer"];
          $poc = $_POST["poc"];
          settype($poc, "integer");
          $result = $this->var->main->PocetInputu($jmeno, $smer, $poc);
        break;

        case "pocfileupload": //post - vykreslovani input type file v hlavnim uploadu
          $jmeno = $_POST["jmeno"];
          $smer = $_POST["smer"];
          $poc = $_POST["poc"];
          settype($poc, "integer");
          $result = $this->var->main->PocetInputuUploadu($jmeno, $smer, $poc);
        break;

        case "csspripony": //get - vykreslovani stylu pripony
          $result = $this->var->main->ViewCssPripony();
        break;

        case "resolution": //post - zalogovani rozliseni
          $this->var->main->LogResolution($_POST["sessid"]);
        break;

        case "showlisip": //post - show list IP
          $result = $this->var->main->ShowSelectUserIp();
        break;

        case "zip": //post - zabali a stahne obsah slozky
          $result = $this->var->main->ZipFile($_POST["cesta"]);
        break;
      }
    }

    return $result;
  }
//******************************************************************************
}

$web = new Ajax();
?>
