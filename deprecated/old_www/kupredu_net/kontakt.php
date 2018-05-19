<?php
  if (!Empty($_POST["jmeno"]) &&
      !Empty($_POST["prijmeni"]) &&
      !Empty($_POST["e-mail"]) &&
      !Empty($_POST["vzkaz"]) &&
      !Empty($_POST["tlacitko"]))
  {
    $potvrzeni = $this->var->main->PosliKontakt();
  }

  $result =
  "
    <span class=\"nadpis_kontakt\"></span>

  <div id=\"kontakty\">

 <span class=\"hlavicka\"></span>

 <ul>
  <li class=\"k1\">Adresa</li><li class=\"k2\">Na Výsluní­ 965, Moravská Nová Ves, 691 55</li>
 </ul>

 <ul>
  <li class=\"k1\">Mobil:</li><li class=\"k2\">+420 737 550 087</li>
  </ul>

  <ul>
  <li class=\"k1\">E-mail:</li><li class=\"k2\">info@kupredu.net</li>
  </ul>

  <ul>
  <li class=\"k1\">ICQ:</li><li class=\"k2\">237039478</li>
  </ul>

  <ul>
  <li class=\"k1\">SKYPE:</li><li class=\"k2\">Admin-Kupredu.net</li>
 </ul>

 <ul>
  <li class=\"k1\">IČO:</li><li class=\"k2\">75820641</li>
  </ul>

  <ul>
  <li class=\"k1\">DIČ:</li><li class=\"k2\">CZ8507184466</li>
  </ul>

  <ul>
  <li class=\"k1\">Bankovní­ spojení­:</li><li class=\"k2\">198 283 164 /0300 - ČSOB</li>
 </ul>

<span class=\"paticka\"></span>

</div>

<div id=\"prac_doba\">

<span>Pracovní doba:</span>

<ul><li>Po:</li><li>8:30 – 12:00</li><li>13:00 – 17:00</li></ul>
<ul><li>Út:</li><li>8:30 – 12:00</li><li>13:00 – 17:00</li></ul>
<ul><li>St:</li><li>8:30 – 12:00</li><li>13:00 – 17:00</li></ul>
<ul><li>Čt:</li><li>8:30 – 12:00</li><li>13:00 – 17:00</li></ul>
<ul><li>Pá:</li><li>8:30 – 12:00</li><li>13:00 – 15:00</li></ul>

<p>Mimo tuto pracovní dobu dle telefonické dohody.</p>

</div>
{$potvrzeni}
<form id=\"kontakt_form\" action=\"\" method=\"post\" onsubmit=\"return kontrolaEmailu();\">
  <fieldset>
    <legend>Kontaktní formulář</legend>
      <h2>Jestliže se nás chcete na něco zeptat nebo nás kontaktovat, použijte níže uvedený formulář.</h2>
        <dl>
          <dt>
            <label for=\"jmeno_label_input\">Jméno *</label>
          <dt>
          <dd>
            <input id=\"jmeno_label_input\" type=\"text\" maxlength=\"25\" name=\"jmeno\" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"prijmeni_label_input\">Příjmení *</label>
          <dt>
          <dd>
            <input id=\"prijmeni_label_input\" type=\"text\" maxlength=\"25\" name=\"prijmeni\" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"e-mail_label_input\">E-mail *</label>
          <dt>
          <dd>
            <input id=\"e-mail_label_input\" type=\"text\" maxlength=\"40\" name=\"e-mail\" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"telefon_label_input\">Telefon  </label>
          <dt>
          <dd>
            <input id=\"telefon_label_input\" type=\"text\" maxlength=\"16\" name=\"telefon\" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"vzkaz_label_input\">Vzkaz *</label>
          <dt>
          <dd>
            <textarea cols=\"23\" rows=\"7\" id=\"vzkaz_label_input\" name=\"vzkaz\"></textarea>
          </dd>
        </dl>
      <input id=\"tl_odeslat\" type=\"submit\" value=\"&nbsp;\" name=\"tlacitko\" />
    <p>* Povinný údaj</p>
  </fieldset>
</form>
  ";

  return $result;
?>