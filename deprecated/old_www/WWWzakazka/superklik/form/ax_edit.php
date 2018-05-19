<?php
  $this->var->main->ReturnValieUditUser($_SESSION["IDUSER"], $email, $jmeno, $prijmeni, $ulice, $cp, $psc, $mesto, $telefon);

  return
  "
<h2 id=\"h2_registrace\"></h2>
  <div id=\"div_registrace_info_edit\">
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <strong class=\"upraveni_osobnich_udaju\"></strong>
    <form method=\"post\" action=\"\">
      <fieldset>
        <div class=\"levy_sloupec_osobni_udaje\">
          <dl>
            <dt>
              <label for=\"input_jmeno\">Jméno:</label>
            </dt>
            <dd>
              <input id=\"input_jmeno\" type=\"text\" name=\"jmeno\" value=\"{$jmeno}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
          <dl>
            <dt>
              <label for=\"input_prijmeni\">Příjmení:</label>
            </dt>
            <dd>
              <input id=\"input_prijmeni\" type=\"text\" name=\"prijmeni\" value=\"{$prijmeni}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
          <dl>
            <dt>
              <label for=\"input_email\">E-mail:</label>
            </dt>
            <dd>
              <input id=\"input_email\" type=\"text\" name=\"email\" value=\"{$email}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
          <dl>
            <dt>
              <label for=\"input_telefon\">Telefon:</label>
            </dt>
            <dd>
              <input id=\"input_telefon\" type=\"text\" name=\"telefon\" value=\"{$telefon}\" />
            </dd>
          </dl>
        </div>
        <div class=\"pravy_sloupec_osobni_udaje\">
          <dl>
            <dt>
              <label for=\"input_ulice\">Ulice:</label>
            </dt>
            <dd>
              <input id=\"input_ulice\" type=\"text\" name=\"ulice\" value=\"{$ulice}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
          <dl>
            <dt>
              <label for=\"input_cp\">Číslo popisné:</label>
            </dt>
            <dd>
              <input id=\"input_cp\" type=\"text\" name=\"cp\" value=\"{$cp}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
          <dl>
            <dt>
              <label for=\"input_psc\">PSČ:</label>
            </dt>
            <dd>
              <input id=\"input_psc\" type=\"text\" name=\"psc\" value=\"{$psc}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
          <dl>
            <dt>
              <label for=\"input_mesto\">Město:</label>
            </dt>
            <dd>
              <input id=\"input_mesto\" type=\"text\" name=\"mesto\" value=\"{$mesto}\" />
              <span class=\"\">*</span>
            </dd>
          </dl>
        </div>

        <input type=\"button\" name=\"tlacitko\" id=\"tlacitko_potvrdit\" value=\"Uložit údaje\" onclick=\"UpravitUdaje(document.getElementById('input_email').value, document.getElementById('input_jmeno').value, document.getElementById('input_prijmeni').value, document.getElementById('input_ulice').value, document.getElementById('input_cp').value, document.getElementById('input_psc').value, document.getElementById('input_mesto').value, document.getElementById('input_telefon').value); location.href='#';\" />
      </fieldset>
    </form>
    <acronym id=\"povinne_udaje\">* Povinné údaje</acronym>
  </div>
<h3 id=\"h3_registrace\"></h3>
  ";
?>
