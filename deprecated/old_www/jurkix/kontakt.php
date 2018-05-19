<?php
	return
  "
    <h2>
      Kontakt
    </h2>
    <p class=\"uvodni_text\">
      {$this->TextSekce("kontakt")}
    </p>
    {$potvrzeni}
    <div id=\"mesg_kontakt\"></div>
    <form id=\"kontakt_form\" action=\"\" method=\"\">
      <fieldset>
        <legend>Kontaktní formulář</legend>
        <label for=\"jmeno_label_input\">Jméno *</label>
          <input id=\"jmeno_label_input\" type=\"text\" name=\"jmeno\" />
        <label for=\"telefon_label_input\" id=\"telefon_label\">Telefon</label>
          <input id=\"telefon_label_input\" type=\"text\" name=\"telefon\" />
        <label for=\"email_label_input\">Email *</label>
          <input id=\"email_label_input\" type=\"text\" name=\"email\" onchange=\"kontrolaEmailu();\" />
        <label for=\"zprava_label_input\">Zpráva *</label>
          <textarea cols=\"23\" rows=\"7\" id=\"zprava_label_input\" name=\"zprava\"></textarea>
          <input id=\"tl_odeslat\" type=\"button\" value=\"Odeslat\" name=\"tlacitko\" onclick=\"AjaxKontakt(document.getElementById('jmeno_label_input').value, document.getElementById('telefon_label_input').value, document.getElementById('email_label_input').value, document.getElementById('zprava_label_input').value);AutoClick(2, 'kontakt', '');\" />
      </fieldset>
    </form>
    <p id=\"popis_vyplneni\">
      * Tyto pole jsou povinná při vyplňování
    </p>
  ";
?>

