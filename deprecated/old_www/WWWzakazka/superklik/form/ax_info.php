<?php
  $this->var->main->ReturnValieUditUser($_SESSION["IDUSER"], $email, $jmeno, $prijmeni, $ulice, $cp, $psc, $mesto, $telefon);

  return
  "
<h2 id=\"h2_registrace\"></h2>
  <div id=\"div_registrace_info_edit\">
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <strong></strong>
  <span class=\"obrazek_info_uzivatel\"></span>
    <dl class=\"vypis_info_uzivatel prvni_polozka\">
      <dt>
        Uživatel:
      </dt>
      <dd>
        {$_SESSION["SLOGIN"]}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        Jméno:
      </dt>
      <dd>
        {$jmeno}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        Příjmení:
      </dt>
      <dd>
        {$prijmeni}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        Ulice:
      </dt>
      <dd>
        {$ulice}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        Číslo popisné:
      </dt>
      <dd>
        {$cp}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        PSČ:
      </dt>
      <dd>
        {$psc}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        Město:
      </dt>
      <dd>
        {$mesto}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel\">
      <dt>
        Telefon:
      </dt>
      <dd>
        {$telefon}
      </dd>
    </dl>
    <dl class=\"vypis_info_uzivatel posledni_polozka\">
      <dt>
        E-mail:
      </dt>
      <dd>
        {$email}
      </dd>
    </dl>
    <a href=\"#\" class=\"info_uzivatel_upravit_udaje\" onclick=\"AjaxStranka('ax_edit'); return false;\">
      <span>Editovat údaje</span>
    </a>
  </div>
<h3 id=\"h3_registrace\"></h3>
  ";
?>
