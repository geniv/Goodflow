<?php

  //sprava webu - aby vedel z kam tahat udaje
//u kazdeho webu
  //sprava udaju, novinek na uvodni strance/admin uzivatel
  //pripadne aktualizace, errory, zvetsujici se velikosti, verze, logy do adminu apod.
  //(v podstate cely help center)
  //reporty
  //faq
  //tutorialy

include_once "form.php";

class Admin
{
  public function __construct()
  {
    $form = new Formular();
    $login = $form->Form(array ("login" => array("text", "Login", ""),
                                "heslo" => array("password", "Tajne heslo", ""),
                                "tlacitko" => array("submit", "", "Přihlásit se")));

    $result = "
<html>
  <head>
    <title>Admin</title>
  </head>
  <body>
    {$login}
  </body>
</html>
    ";

    echo $result;
  }
}

new Admin();
?>
