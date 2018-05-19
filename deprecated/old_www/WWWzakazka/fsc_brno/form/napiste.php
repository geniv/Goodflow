<?php
  return
  "
<div id=\"napiste_nam\">
<span class=\"obalka_01\"></span>
<span class=\"obalka_02\"></span>
<h2>Napište nám</h2>

<div id=\"mesg_napiste\"></div>

<p class=\"text\">
  Pokud máte jakýkoliv dotaz, či sdělení, neváhejte a napište nám. Rádi Vám odpovíme ...
</p>
  <form action=\"\" method=\"post\">
    <fieldset>
      <legend>Napište nám</legend>
        <label for=\"label_input_jmeno\">Jméno:</label>
          <input id=\"label_input_jmeno\" type=\"text\" name=\"jmeno\" /><span>*</span>
        <label for=\"label_input_prijmeni\">Příjmení:</label>
          <input id=\"label_input_prijmeni\" type=\"text\" name=\"prijmeni\" /><span>*</span>
        <label for=\"label_input_ulice\">Ulice:</label>
          <input id=\"label_input_ulice\" type=\"text\" name=\"ulice\" />
        <label for=\"label_input_mesto\">Město:</label>
          <input id=\"label_input_mesto\" type=\"text\" name=\"mesto\" />
        <label for=\"label_input_psc\">PSČ:</label>
          <input id=\"label_input_psc\" type=\"text\" name=\"psc\" />
        <label for=\"label_input_telefon\">Telefon:</label>
          <input id=\"label_input_telefon\" type=\"text\" name=\"telefon\" /><span>*</span>
        <label for=\"label_input_email\">E-mail:</label>
          <input id=\"label_input_email\" type=\"text\" name=\"email\" value=\"@\" onchange=\"kontrolaEmailu('label_input_email');\" /><span>*</span>
        <label for=\"label_textarea_pozadavek\">Text zprávy:</label>
          <textarea id=\"label_textarea_pozadavek\" cols=\"47\" rows=\"7\" name=\"pozadavek\"></textarea>
        <input id=\"tl_odeslat_napiste\" type=\"button\" value=\"\" name=\"tlacitko\" title=\"Odeslat\" onclick=\"AjaxNapiste(document.getElementById('label_input_jmeno').value, document.getElementById('label_input_prijmeni').value, document.getElementById('label_input_ulice').value, document.getElementById('label_input_mesto').value, document.getElementById('label_input_psc').value, document.getElementById('label_input_telefon').value, document.getElementById('label_input_email').value, document.getElementById('label_textarea_pozadavek').value);AutoClick(2, 'napiste', '');document.getElementById('tl_odeslat_napiste').style.visibility='hidden';\" />
    </fieldset>
  </form>
  <p>
    <span>*</span> Povinné údaje
  </p>
</div>


  ";
?>
