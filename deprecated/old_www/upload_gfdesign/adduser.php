<?php
  return
  "
{$this->var->main->AddUser()}
<div id=\"pridat_uzivatele\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_login\">Login:</label>
        </dt>
        <dd>
          <input id=\"label_input_login\" type=\"text\" name=\"login\" />
          <span class=\"label_input_login_heslo\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_heslo\">Heslo:</label>
        </dt>
        <dd>
          <input id=\"label_input_heslo\" type=\"text\" name=\"heslo\" />
          <span class=\"label_input_login_heslo\">*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_icq\">ICQ:</label>
        </dt>
        <dd>
          <input id=\"label_input_icq\" type=\"text\" name=\"icq\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_www\">www:</label>
        </dt>
        <dd>
          <input id=\"label_input_www\" type=\"text\" name=\"www\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_email\">E-mail:</label>
        </dt>
        <dd>
          <input id=\"label_input_email\" type=\"text\" name=\"email\" />
        </dd>
      </dl>
      ".($this->var->pravo == $this->var->moderator ? "
      <dl class=\"label_input_dl_prava\">
        <dt>
          <label>Prostor:</label>
        </dt>
        <dd>
          --- Vyber místo ---
          <span class=\"input_label_dl_obal_polozka_administrator\">
            {$this->var->main->ListingProstorSelect()}
          </span>
        </dd>
      </dl>
      " : "
      <dl>
        <dt>
          <label for=\"label_input_prostor\">Prostor:</label>
        </dt>
        <dd>
          <input id=\"label_input_prostor\" type=\"text\" name=\"prostor\" value=\"10\" />
          <span>MB</span>
        </dd>
      </dl>
      ")."
      ".($this->var->pravo == $this->var->moderator ? "<input type=\"hidden\" name=\"pravo\" value=\"{$this->var->user}\" />" : "
      <dl class=\"label_input_dl_prava\">
        <dt>
          <label>Práva:</label>
        </dt>
        <dd>
          --- Vyber práva ---
          <span class=\"input_label_dl_obal_polozka_administrator\">
            {$this->var->main->ListingRightSelect()}
          </span>
        </dd>
      </dl>
      ")."
      <dl class=\"label_input_expirace_uctu\">
        <dt>
          Doba existence účtu
        </dt>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_expirace_uctu\">Počet dní:</label>
        </dt>
        <dd>
          <input id=\"label_input_expirace_uctu\" type=\"radio\" name=\"expiraceucet\" checked=\"checked\" value=\"true\" />
          <input class=\"label_input_expirace_uctu\" type=\"text\" id=\"valexpucet\" name=\"dnyexpiraceucet\" value=\"5\" onclick=\"NastavRadio('label_input_expirace_uctu', true)\" />
          <span class=\"dd_span_expirace_uctu_souboru\" onclick=\"NastavRadio('selexpucettrue', true);\">
            <input type=\"radio\" name=\"expiraceucet\" id=\"selexpucettrue\" value=\"false\" />
            <span class=\"label_input_expirace_uctu_neomezene\">Neomezeně</span>
          </span>
        </dd>
      </dl>
      <dl class=\"label_input_expirace_uctu\">
        <dt>
          Doba existence souborů
        </dt>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_expirace_souboru\">Počet dní:</label>
        </dt>
        <dd>
          <input id=\"label_input_expirace_souboru\" type=\"radio\" name=\"expirace\" checked=\"checked\" value=\"true\" />
          <input class=\"label_input_expirace_souboru\" type=\"text\" name=\"dnyexpirace\" value=\"5\" onclick=\"NastavRadio('label_input_expirace_souboru', true)\" />
          <span class=\"dd_span_expirace_uctu_souboru\" onclick=\"NastavRadio('selexptrue', true);\">
            <input type=\"radio\" name=\"expirace\" id=\"selexptrue\" value=\"false\" />
            <span class=\"label_input_expirace_souboru_neomezene\">Neomezeně</span>
          </span>
        </dd>
      </dl>
      <div id=\"pridat_uzivatele_moderatora\">
        <input type=\"submit\" name=\"tlacitko\" value=\"".($this->var->pravo == $this->var->moderator ? "Přidat uživatele" : "Přidat uživatele / moderátora / administrátora")."\" />
      </div>
    </fieldset>
  </form>
  <div id=\"centralni_napoveda\" class=\"napoveda_vychozi\" title=\"Nápověda\">
    <div>
      <p class=\"napoveda_prvni\">Pole označená hvězdičkou [*] jsou povinná</p>
      <p><strong>ICQ</strong> - Devíti-místné číslo</p>
      <p><strong>www</strong> - Psát bez http://</p>
      <p><strong>Právo uživatel</strong> - Vidí hlavní stranu, složky, soubory</p>
      <p><strong>Právo moderátor</strong> - Vidí hlavní stranu, uživatelé, složky, soubory</p>
      <p><strong>Právo administrátor</strong> - Vidí vše</p>
      <p><strong>Doba existence účtu</strong> - Počet dní do smazání účtu</p>
      <p><strong>Doba existence souborů</strong> - Hodnota, která nastaví interval mazání souborů</p>
    </div>
  </div>
</div>
  ";
?>
