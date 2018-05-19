<?php
  $this->var->main->ReturnValueUser($login, $heslo, $icq, $www, $email, $prostor, $pravo, $dnyexpiraceucet, $dnyexpirace, $vytvoreno, $style);
  $cislo = $_GET["cislo"];
  settype($cislo, "integer");

  $zaplneno = $this->var->main->CurrentPercentSizeSpace($cislo, $prostor);  //% zaplneno
  $zbyva = 100 - $zaplneno;

  $zaplnenomega = $this->var->main->CurrentSizeSpace($cislo, true); //MB zaplneno
  $maxmega = $prostor * 1024 * 1024;
  $zbyvamega = $maxmega - $zaplnenomega;
  return
  "
<div id=\"vypis_info_slozky_uzivatele_obal\">
  <div id=\"vypis_info_uzivatele\">
    <dl>
      <dt>
        Login:
      </dt>
      <dd>
        {$login}
      </dd>
    </dl>
    <dl>
      <dt>
        Hodnost:
      </dt>
      <dd>
        {$this->var->prava[$pravo]}
      </dd>
    </dl>
    <dl>
      <dt>
        ICQ:
      </dt>
      <dd class=\"neuvedeno_polozky\">
        ".(!Empty($icq) ? "<strong><a href=\"http://people.icq.com/people/about_me.php?uin={$icq}\" title=\"{$icq}\">{$icq}</a></strong>" : "<em>Neuvedeno</em>")."
      </dd>
    </dl>
    <dl>
      <dt>
        www:
      </dt>
      <dd class=\"neuvedeno_polozky\">
        ".(!Empty($www) ? "<strong><a href=\"http://{$www}\" title=\"{$www}\">{$www}</a></strong>" : "<em>Neuvedeno</em>")."
      </dd>
    </dl>
    <dl>
      <dt>
        E-mail:
      </dt>
      <dd class=\"neuvedeno_polozky\">
        ".(!Empty($email) ? "<strong><a href=\"mailto:{$email}\" title=\"{$email}\">{$email}</a></strong>" : "<em>Neuvedeno</em>")."
      </dd>
    </dl>
    <dl>
      <dt>
        Prostor:
      </dt>
      <dd>
        {$this->var->main->Velikost($prostor * 1024 * 1024)}
      </dd>
    </dl>
    <dl>
      <dt>
        Má zaplněno:
      </dt>
      <dd>
        {$this->var->main->Velikost($zaplnenomega)} ({$zaplneno}%)
      </dd>
    </dl>
    <dl>
      <dt>
        Zbývá mu:
      </dt>
      <dd>
        {$this->var->main->Velikost($zbyvamega)} ({$zbyva}%)
      </dd>
    </dl>
    ".($dnyexpiraceucet != 0 ? "
    <dl>
      <dt>
        Do smazání účtu zbývá:
      </dt>
      <dd>
        {$this->var->main->VyslovnostDnuZbyva($this->var->main->ZbyvaDni($vytvoreno, $dnyexpiraceucet))}
      </dd>
    </dl>
    " : "")."
    <dl>
      <dt>
        Doba existence účtu:
      </dt>
      <dd>
        {$this->var->main->VyslovnostDnu($dnyexpiraceucet)}
      </dd>
    </dl>
    <dl>
      <dt>
        Doba existence souborů:
      </dt>
      <dd>
        {$this->var->main->VyslovnostDnu($dnyexpirace)}
      </dd>
    </dl>
    <dl>
      <dt>
        Účet vytvořen:
      </dt>
      <dd>
        ".(date("d.m.Y H:i:s", strtotime($vytvoreno)))."
      </dd>
    </dl>
    <dl>
      <dt>
        Vybraný styl:
      </dt>
      <dd>
        {$this->var->main->VypisNazevStylu($style)}
      </dd>
    </dl>
  </div>
  <div id=\"vypis_info_slozky_uzivatele\">
    {$this->var->main->ListingUserDir($cislo, $dnyexpirace)}
  </div>
</div>
  ";
  //free: {$this->var->main->AvailableFreeSpace($_GET["cislo"], $prostor)} - neefektivní<br>
  //free: {$this->var->main->AvailablePercentFreeSpace($_GET["cislo"], $prostor)}% - neefektivní
?>
