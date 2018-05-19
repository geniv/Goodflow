<?php
  $logoff = false;
  if (!Empty($_GET["akce"]) &&
      $_GET["akce"] == "logoff")
  {
    $_SERVER["PHP_AUTH_USER"] = "";
    $_SERVER["PHP_AUTH_PW"] = "";
    $logoff = true;
  }

  if (Empty($_SERVER["PHP_AUTH_USER"]) ||
      !$this->var->main->KontrolaAutorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
  {
    header("WWW-Authenticate: Basic realm=\"kupredu.net\"");
    header("HTTP/1.0 401 Unauthorized");

    $this->var->main->AutoClick(1, "./");
    if ($logoff)
    {
      $result = "odhlášen";
    }
      else
    {
      $result = "neautorizovany vstup";
    }
  }
    else
  {
    switch ($_GET["akce"])
    {
      case "beza":
        $obsah = $this->var->main->VypisAdminBezAgregace();
      break;

      case "sa":
        $obsah = $this->var->main->VypisAdminSAgregaci();
      break;

      case "nov":
        $obsah = $this->var->main->VypisAdminNovinky();
      break;

      default:
        $obsah =
        "
      uvod...
        ";
      break;
    }
    $result =
    "
    tajna sekce adminstrace...
    <a href=\"index.php?action=admin\">uvod</a>
    <a href=\"index.php?action=admin&amp;akce=beza\">bez agregace</a>
    <a href=\"index.php?action=admin&amp;akce=sa\">s agregací</a>
    <a href=\"index.php?action=admin&amp;akce=nov\">novinky</a>

    <a href=\"index.php?action=admin&amp;akce=logoff\">odhlásit</a>
<br/>
    {$obsah}
    {$this->var->chyba}
    ";
  }

  return $result;
?>
