<?php
  $vyhodnoceni = $this->var->main->VypisVyhodnoceni($styl);
  return
  "
<h2></h2>
  <div>
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen{$styl}\"></span>
      {$vyhodnoceni}
    </p>
  </div>
<h3 class=\"pravidla_bottom\"></h3>
  "; //       vyhodnoceni od uživatele: {$_SESSION["SLOGIN"]}...
?>
