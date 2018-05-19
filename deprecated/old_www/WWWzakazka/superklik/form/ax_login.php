<?php
  $this->var->main->KontrolaExpiraceAutorizace(); //kontroluje expiraci uctu

  return
  "
<h2></h2>
<div class=\"background_prihlaseni\">
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
    <form>
      <p>Pro přihlášení do soutěže Superklik<sup>®</sup> zadejte prosím Vaše přihlašovací jméno a heslo.</p>
      <fieldset>
        <dl>
          <dt>
            <label for=\"input_login\">Uživatel:</label>
          </dt>
          <dd>
            <input type=\"text\" name=\"login\" id=\"input_login\" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_heslo\">Heslo:</label>
          </dt>
          <dd>
            <input type=\"password\" name=\"heslo\" id=\"input_heslo\" onkeydown=\"Enter(event, 'input_tlacitko');\" />
          </dd>
        </dl>
        <dl>
          <dd>
            <input type=\"button\" name=\"tlacitko\" id=\"input_tlacitko\" value=\"Přihlásit se\" onclick=\"Login(document.getElementById('input_login').value, document.getElementById('input_heslo').value); location.href='#';\" />
          </dd>
        </dl>
      </fieldset>
    </form>
</div>
<h3></h3>
  ";
?>
