<?php
  $this->var->main->ReturnValueUser($login, $heslo, $icq, $www, $email, $prostor, $pravo, $dnyexpiraceucet, $dnyexpirace, $vytvoreno, $style);
  return
  "
{$this->var->main->EditUser()}
<div id=\"pridat_uzivatele\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
  <form method=\"post\" action=\"\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"label_input_login\">Login:</label>
        </dt>
        <dd>
          <input id=\"label_input_login\" type=\"text\" name=\"login\" value=\"{$login}\" />
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
          <input id=\"label_input_icq\" type=\"text\" name=\"icq\" value=\"{$icq}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_www\">www:</label>
        </dt>
        <dd>
          <input id=\"label_input_www\" type=\"text\" name=\"www\" value=\"{$www}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_email\">E-mail:</label>
        </dt>
        <dd>
          <input id=\"label_input_email\" type=\"text\" name=\"email\" value=\"{$email}\" />
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
            {$this->var->main->ListingProstorSelected($prostor)}
          </span>
        </dd>
      </dl>
      " : "
      <dl>
        <dt>
          <label for=\"label_input_prostor\">Prostor:</label>
        </dt>
        <dd>
          <input id=\"label_input_prostor\" type=\"text\" name=\"prostor\" value=\"{$prostor}\" />
          <span>MB</span>
        </dd>
      </dl>
      ")."
      ".($this->var->pravo == $this->var->moderator ? "<input type=\"hidden\" name=\"pravo\" value=\"{$pravo}\" />" : "
      <dl class=\"label_input_dl_prava\">
        <dt>
          <label>Práva:</label>
        </dt>
        <dd>
          --- Vyber práva ---
          <span class=\"input_label_dl_obal_polozka_administrator\">
            {$this->var->main->ListingRightSelected($pravo)}
          </span>
        </dd>
      </dl>
      ")."
      ".($this->var->pravo == $this->var->moderator ?
          "
          <input type=\"hidden\" name=\"dnyexpiraceucet\" value=\"{$dnyexpiraceucet}\" />
          <input type=\"hidden\" name=\"dnyexpirace\" value=\"{$dnyexpirace}\" />
          " : "
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
          <input id=\"label_input_expirace_uctu\" type=\"radio\" name=\"expiraceucet\"".($dnyexpiraceucet != 0 ? " checked=\"checked\"" : "")." value=\"true\" />
          <input class=\"label_input_expirace_uctu\" type=\"text\" id=\"valexpucet\" name=\"dnyexpiraceucet\" value=\"{$dnyexpiraceucet}\" onclick=\"NastavRadio('label_input_expirace_uctu', true)\" />
          <span class=\"dd_span_expirace_uctu_souboru\" onclick=\"NastavRadio('selexpucettrue', true);\">
            <input type=\"radio\" name=\"expiraceucet\" id=\"selexpucettrue\"".($dnyexpiraceucet == 0 ? " checked=\"checked\"" : "")." value=\"false\" />
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
          <input id=\"label_input_expirace_souboru\" type=\"radio\" name=\"expirace\"".($dnyexpirace != 0 ? " checked=\"checked\"" : "")." value=\"true\" />
          <input class=\"label_input_expirace_souboru\" type=\"text\" name=\"dnyexpirace\" value=\"{$dnyexpirace}\" onclick=\"NastavRadio('label_input_expirace_souboru', true)\" />
          <span class=\"dd_span_expirace_uctu_souboru\" onclick=\"NastavRadio('selexptrue', true);\">
            <input type=\"radio\" name=\"expirace\" id=\"selexptrue\"".($dnyexpirace == 0 ? " checked=\"checked\"" : "")." value=\"false\" />
            <span class=\"label_input_expirace_souboru_neomezene\">Neomezeně</span>
          </span>
        </dd>
      </dl>")."
        <input type=\"hidden\" name=\"oldheslo\" value=\"{$heslo}\" />
      <div id=\"upravit_uzivatele_moderatora\">
        <input type=\"submit\" name=\"tlacitko\" value=\"".($this->var->pravo == $this->var->moderator ? "Upravit uživatele" : "Upravit uživatele / moderátora / administrátora")."\" />
      </div>
    </fieldset>
  </form>
</div>
  ";
?>