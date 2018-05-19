<?php
  if (!Empty($_POST["odkud"]) &&
      !Empty($_POST["kam"]) &&
      !Empty($_POST["kdy"]) &&
      !Empty($_POST["nazev_firmy"]) &&
      !Empty($_POST["jmeno"]) &&
      !Empty($_POST["prijmeni"]) &&
      !Empty($_POST["adresa"]) &&
      !Empty($_POST["mesto"]) &&
      !Empty($_POST["stat"]) &&
      !Empty($_POST["kontaktni_osoba"]) &&
      !Empty($_POST["kontaktni_telefon"]) &&
      !Empty($_POST["email"]) &&
      !Empty($_POST["predpokladana_hmotnost"]) &&
      !Empty($_POST["rozmery"]) &&
      !Empty($_POST["hodnota_zbozi"]) &&
      !Empty($_POST["vzkaz"]) &&
      !Empty($_POST["tlacitko"]))
  {
    $potvrzeni = $this->var->main->PosliDopravu();
  }

  $result =
  "
    <span class=\"nadpis_doprava\"></span>

    <p class=\"text\">
      Nabízíme Vám možnost vnitrostátní i mezinárodní pozemní expresní nákladní přepravy zboží do 3,5 tuny. Přepravované zboží je standardně pojištěno na hodnotu 500 000 Kč. Připojištění je možné doobjednat za příplatek. Máte-li zájem o přepravu, vyplňte prosím následující formulář a budeme Vás kontaktovat s cenovou nabídkou.
      </p>

      {$potvrzeni}
       <form id=\"doprava_form\" action=\"\" method=\"post\" onsubmit=\"return kontrolaEmailu();\">
      <fieldset>
        <legend>Kontaktní formulář</legend>
        <label for=\"odkud_label_input\">Odkud</label>
          <input id=\"odkud_label_input\" type=\"text\" name=\"odkud\" />
        <label for=\"kam_label_input\">Kam</label>
          <input id=\"kam_label_input\" type=\"text\" name=\"kam\" />
        <label for=\"kdy_label_input\">Kdy(datum)</label>
          <input id=\"kdy_label_input\" type=\"text\" name=\"kdy\" value=\"".date("d.m.Y")."\" />
          <label for=\"nazev_firmy_label_input\">Název firmy</label>
          <input id=\"nazev_firmy_label_input\" type=\"text\" name=\"nazev_firmy\" />
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
          <label for=\"predpokladana_hmotnost_label_input\">Předpokládaná hmotnost</label>
          <input id=\"predpokladana_hmotnost_label_input\" type=\"text\" name=\"predpokladana_hmotnost\" />
          <label for=\"rozmery_label_input\">Rozměry v cm (výška x šířka x délka)</label>
          <input id=\"rozmery_label_input\" type=\"text\" name=\"rozmery\" />
          <label for=\"hodnota_zbozi_label_input\">Hodnota zboží</label>
          <input id=\"hodnota_zbozi_label_input\" type=\"text\" name=\"hodnota_zbozi\" />
        <label for=\"vzkaz_label_input\">Vzkaz</label>
          <textarea cols=\"23\" rows=\"7\" id=\"vzkaz_label_input\" name=\"vzkaz\"></textarea>
          <input id=\"tl_odeslat\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" />
      </fieldset>
    </form>
  ";

  return $result;
?>