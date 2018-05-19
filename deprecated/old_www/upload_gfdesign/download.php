<?php
include_once "promenne.php";
include_once "funkce.php";

/*
//header('WWW-Authenticate: Basic realm="upload.gfdesign.cz"');//Basic
//header('HTTP/1.0 401 Unauthorized');

//header('Content-Disposition: attachment; filename="downloaded.pdf"');
* $_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]
*/

class Ajax
{
  public $var, $soub;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);

    header("Content-type: text/html; charset=UTF-8");

    if (Empty($_SERVER["PHP_AUTH_USER"]) || !$this->var->main->KontrolaAutorzace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"], $_GET["action"]))
    {
      header("WWW-Authenticate: Basic realm=\"upload.gfdesign.cz\"");
      header("HTTP/1.0 401 Unauthorized");
    }
      else
    {
      echo $this->var->main->DownloadFileOfDir($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"], $_GET["action"], $_GET["file"]);
    }

  }
//******************************************************************************
}

$web = new Ajax();
?>