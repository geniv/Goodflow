<?php
  if (!Empty($_POST["misto"]) &&
      !Empty($_POST["firma"]) &&
      !Empty($_POST["jmeno"]) &&
      !Empty($_POST["prijmeni"]) &&
      !Empty($_POST["adresa"]) &&
      !Empty($_POST["mesto"]) &&
      !Empty($_POST["stat"]) &&
      !Empty($_POST["kontaktni_osoba"]) &&
      !Empty($_POST["kontaktni_telefon"]) &&
      !Empty($_POST["email"]) &&
      !Empty($_POST["vzkaz"]) &&
      !Empty($_POST["tlacitko"]))
  {
    $potvrzeni = $this->var->main->PosliSatelit();
  }

  $result =
  "
    <span class=\"nadpis_satelity\"></span>

    <p class=\"text\">
      Není u Vás dostupné pozemní digitální vysílání? Nevadí! Nabízíme Vám příjem českých i zahraničních programů pomocí satelitu.
Vyplňte prosím následující formulář a my Vás budeme sami kontaktovat s nabídkou.
Nyní nově nabízíme i možnost pouze samotného seřízení paraboly na správnou družici a to i v případě,
že jste zařízení pro příjem koupili u konkurence.
  </p>

      {$potvrzeni}
       <form id=\"satelity_form\" action=\"\" method=\"post\" onsubmit=\"return kontrolaEmailu();\">
      <fieldset>
        <legend>Kontaktní­ formulář</legend>
        <label for=\"misto_label_input\">Místo instalace</label>
          <input id=\"misto_label_input\" type=\"text\" name=\"misto\" />
        <label for=\"firma_label_input\">Název firmy</label>
          <input id=\"firma_label_input\" type=\"text\" name=\"firma\" />
          <label for=\"jmeno_label_input\">Jméno</label>
          <input id=\"jmeno_label_input\" type=\"text\" name=\"jmeno\" />
          <label for=\"prijmeni_label_input\">Příjmení</label>
          <input id=\"prijmeni_label_input\" type=\"text\" name=\"prijmeni\" />
          <label for=\"adresa_label_input\">Adresa</label>
          <input id=\"adresa_label_input\" type=\"text\" name=\"adresa\" />
          <label for=\"mesto_label_input\">Město</label>
          <input id=\"mesto_label_input\" type=\"text\" name=\"mesto\" />
          <label for=\"stat_label_input\">Stát</label>
          <input id=\"stat_label_input\" type=\"text\" name=\"stat\" />
          <label for=\"kontaktni_osoba_label_input\">Kontaktní osoba</label>
          <input id=\"kontaktni_osoba_label_input\" type=\"text\" name=\"kontaktni_osoba\" />
          <label for=\"kontaktni_telefon_label_input\">Kontaktní telefon</label>
          <input id=\"kontaktni_telefon_label_input\" type=\"text\" name=\"kontaktni_telefon\" />
          <label for=\"email_label_input\">Kontaktní e-mail</label>
          <input id=\"email_label_input\" type=\"text\" name=\"email\" />
        <label for=\"vzkaz_label_input\">Vzkaz</label>
          <textarea cols=\"23\" rows=\"7\" id=\"vzkaz_label_input\" name=\"vzkaz\"></textarea>
          <input id=\"tl_odeslat\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" />
      </fieldset>
    </form>
  ";

  return $result;
?>