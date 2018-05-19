<?php
  if (Empty($_SERVER["PHP_AUTH_USER"]) ||
      !$this->var->main->KontrolaAutorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
  {
    header("WWW-Authenticate: Basic realm=\"superklik.cz\"");
    header("HTTP/1.0 401 Unauthorized");
    return include "unautorizet.php";
  }
    else
  {
    return "";
    //"<input type=\"button\" value=\"vstoupit\" onclick=\"location.href='ajax.php?action=admin';\"> do admin sekce";
  }
?>
