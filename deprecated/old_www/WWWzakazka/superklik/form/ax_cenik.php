<?php
  return
  "
<h2></h2>
<div>
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <h1>Ceník</h1>
  <h4>Ceník reklamy na serveru Superklik.cz</h4>
  <ul id=\"seznam_nabizenych_sluzeb\">
    <li>možnost oslovení zajímavé cílové skupiny</li>
    <li>vysoká návštěvnost stránek</li>
    <li>on-line statistiky úspěšnosti bannerů</li>
    <li>velký počet druhů reklamních pozic, možnost zajímavého reklamního mixu</li>
    <li>zajištění výroby bannerů</li>
    <li>pokud jste na seznamu VIP partnerů, Vaše bannery budou zhotoveny zdarma</li>
  </ul>
  <p class=\"odstavec_dalsi_text\">
    Speciální ceník požadavků Vám zašleme na vyžádání.
  </p>
  <p class=\"odstavec_dalsi_text_druhy\">
    V případě zájmu nás kontaktujte na e-mailu <img src=\"obr/email_ikona.png\" alt=\"\" /> <a href=\"mailto:info@superklik.cz\" title=\"info@superklik.cz\">info@superklik.cz</a>, mobilním tel.: <img src=\"obr/email_telefon.png\" alt=\"\" /> 603 345 626, nebo na objednávkovém formuláři uvedeném níže.
  </p>

  {$this->var->main->VypisCenik()}

  <h4>Obchodní podmínky</h4>
  <p class=\"odstavec_dalsi_text_druhy\" style=\"padding-bottom: 2px;\">
    Obchodní podmínky MV Consulting s.r.o. platné od 1.1.2009
  </p>
  <p class=\"odstavec_dalsi_text_druhy\" style=\"padding-bottom: 6px;\">
    <img src=\"obr/ikona_zobrazit.png\" alt=\"\" class=\"ikony_zobrazi_stahnout\" />
    <a href=\"#\" onclick=\"PoslatAkci('show_obchodpodm', 0, 'obchod_podminky'); return false;\" title=\"Zobrazit obchodní podmínky\">Zobrazit</a>
  </p>

  <div id=\"obchod_podminky\"></div>

  <p class=\"odstavec_dalsi_text_druhy\">
    <img src=\"obr/ikona_stahnout.png\" alt=\"\" class=\"ikony_zobrazi_stahnout\" />
    <a href=\"soubory/obchodni_podminky.doc\" title=\"Stáhnout obchodní podmínky\">Stáhnout</a>
  </p>

  <h4>Objednávka reklamy</h4>
  <p class=\"odstavec_dalsi_text_druhy\">
    Pro objednávku reklamy prosím použijte následující objednací formulář, e-mail <img src=\"obr/email_ikona.png\" alt=\"\" /> <a href=\"mailto:info@superklik.cz\" title=\"info@superklik.cz\">info@superklik.cz</a> nebo na telefoním čísle <img src=\"obr/email_telefon.png\" alt=\"\" /> 603 345 626
  </p>

  <form method=\"post\" action=\"\" id=\"forma_objednavka_cenik\">
    <fieldset>
      <legend>Objednávkový formulář</legend>
      <strong>Objednávkový formulář</strong>
      <dl>
        <dt>
          <label for=\"label_input_jmeno\">Jméno / Firma:</label>
        </dt>
        <dd>
          <input id=\"label_input_jmeno\" type=\"text\" name=\"jmeno\" />
          <span>*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_prijmeni\">Příjmení:</label>
        </dt>
        <dd>
          <input id=\"label_input_prijmeni\" type=\"text\" name=\"prijmeni\" />
          <span>*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_ulice\">Ulice:</label>
        </dt>
        <dd>
          <input id=\"label_input_ulice\" type=\"text\" name=\"ulice\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_mesto\">Město:</label>
        </dt>
        <dd>
          <input id=\"label_input_mesto\" type=\"text\" name=\"mesto\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_psc\">PSČ:</label>
        </dt>
        <dd>
          <input id=\"label_input_psc\" type=\"text\" name=\"psc\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_telefon\">Telefon:</label>
        </dt>
        <dd>
          <input id=\"label_input_telefon\" type=\"text\" name=\"telefon\" />
          <span>*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_input_email\">E-mail:</label>
        </dt>
        <dd>
          <input id=\"label_input_email\" type=\"text\" name=\"email\" value=\"@\" />
          <span>*</span>
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"label_textarea_pozadavek\">Požadavek objednávky:</label>
        </dt>
        <dd>
          <textarea id=\"label_textarea_pozadavek\" cols=\"47\" rows=\"7\" name=\"pozadavek\"></textarea>
        </dd>
      </dl>
      <dl id=\"dl_tlacitko\">
        <dt>
          <input id=\"tl_odeslat\" type=\"button\" value=\"Odeslat formulář\" name=\"tlacitko\" title=\"Odeslat\"
          onclick=\"
          idjmeno='label_input_jmeno';
          idprijmeni='label_input_prijmeni';
          idulice='label_input_ulice';
          idmesto='label_input_mesto';
          idpsc='label_input_psc';
          idtelefon='label_input_telefon';
          idemail='label_input_email';
          idtext='label_textarea_pozadavek';
          PoslatAkci('addobjednavkacenik&amp;jmeno='+document.getElementById(idjmeno).value+
          '&amp;prijmeni='+document.getElementById(idprijmeni).value+
          '&amp;ulice='+document.getElementById(idulice).value+
          '&amp;mesto='+document.getElementById(idmesto).value+
          '&amp;psc='+document.getElementById(idpsc).value+
          '&amp;telefon='+document.getElementById(idtelefon).value+
          '&amp;email='+document.getElementById(idemail).value+
          '&amp;text='+document.getElementById(idtext).value+
          '&amp;w='+screen.width+
          '&amp;h='+screen.height+
          '&amp;d='+screen.colorDepth
          , 0, 'info_objednavka');\" />
        </dt>
      </dl>
    <em>* Povinné údaje</em>
    </fieldset>
  </form>

  <div id=\"info_objednavka\"></div>

  <a href=\"#\" class=\"zavrit_sekci_pravidla spodek\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); location.href='#'; return false;\"><span>Zavřít sekci</span></a>
</div>
<h3 class=\"pravidla_bottom\"></h3>
  ";
/*
<em class=\"nadpis_seznamu_tabulky\">VIP LOGA NA SOUTĚŽNÍCH VÁLCÍCH</em>
<table summary=\"VIP LOGA NA SOUTĚŽNÍCH VÁLCÍCH\" class=\"tabulka_cenik\">
<caption>VIP LOGA NA SOUTĚŽNÍCH VÁLCÍCH</caption>
  <thead>
    <tr>
      <th class=\"formaty_a_velikost\">Formáty a velikost</th>
      <th class=\"ceny_seznam\">Cena/týden</th>
      <th class=\"ceny_seznam\">Cena/měsíc</th>
      <th class=\"poznamky_seznam\">Poznámka</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class=\"formaty_a_velikost\">Logo společnosti <span>30x30</span></td>
      <td class=\"ceny_seznam\">5 000 Kč</td>
      <td class=\"ceny_seznam\">15 000 Kč</td>
      <td class=\"poznamky_seznam\">
        <span>
          - umístění loga společnosti na válce
        </span>
        <span>
          - odkaz na www stránky
        </span>
        <span>
          - zdarma rozesílání reklamních emailů
        </span>
        <span>
          - vyhotovení reklamního banneru zdarma
        </span>
      </td>
    </tr>
  </tbody>
  <tfoot>
    <tr class=\"zapati_tabulky\">
      <td class=\"formaty_a_velikost\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"poznamky_seznam\"></td>
    </tr>
  </tfoot>
</table>

<em class=\"nadpis_seznamu_tabulky\">BANNERY</em>
<table summary=\"BANNERY\" class=\"tabulka_cenik\">
<caption>BANNERY</caption>
  <thead>
    <tr>
      <th class=\"formaty_a_velikost\">Formáty a velikost</th>
      <th class=\"ceny_seznam\">Cena/týden</th>
      <th class=\"ceny_seznam\">Cena/měsíc</th>
      <th class=\"poznamky_seznam\">Poznámka</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class=\"formaty_a_velikost\">Postraní reklamní banner <span>468x60</span></td>
      <td class=\"ceny_seznam\">3 000 Kč</td>
      <td class=\"ceny_seznam\">10 000 Kč</td>
      <td class=\"poznamky_seznam\"><span class=\"prazdny_text\">---</span></td>
    </tr>
    <tr>
      <td class=\"formaty_a_velikost\">Fullbanner nahoře / dole <span>468x60</span></td>
      <td class=\"ceny_seznam\">1 500 Kč</td>
      <td class=\"ceny_seznam\">5 000 Kč</td>
      <td class=\"poznamky_seznam\"><span class=\"prazdny_text\">---</span></td>
    </tr>
    <tr>
      <td class=\"formaty_a_velikost\">Postraní banner <span>468x60</span></td>
      <td class=\"ceny_seznam\">3 000 Kč</td>
      <td class=\"ceny_seznam\">10 000 Kč</td>
      <td class=\"poznamky_seznam\"><span class=\"prazdny_text\">---</span></td>
    </tr>
  </tbody>
  <tfoot>
    <tr class=\"zapati_tabulky\">
      <td class=\"formaty_a_velikost\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"poznamky_seznam\"></td>
    </tr>
  </tfoot>
</table>

<em class=\"nadpis_seznamu_tabulky\">OSTATNÍ FORMY REKLAMY</em>
<table summary=\"OSTATNÍ FORMY REKLAMY\" class=\"tabulka_cenik druhy_vzhled_tabulky\">
<caption>OSTATNÍ FORMY REKLAMY</caption>
  <thead>
    <tr>
      <th class=\"formaty_a_velikost\">Formát</th>
      <th class=\"ceny_seznam specifikace_seznam\">Specifikace</th>
      <th class=\"ceny_seznam delsi_cena_seznam\">Cena</th>
      <th class=\"poznamky_seznam\">Poznámka</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class=\"formaty_a_velikost\">Logo společnosti s odkazem na www stránky</td>
      <td class=\"ceny_seznam specifikace_seznam\"><span>Rozsah A4,</span> <span>3x foto max 200x200</span></td>
      <td class=\"ceny_seznam delsi_cena_seznam\"><span>2 000 Kč / týden</span> <span>5 000 Kč / měsíc</span></td>
      <td class=\"poznamky_seznam\"><span class=\"prazdny_text\">Exkluzivita v oboru + 10% ceny</span></td>
    </tr>
    <tr>
      <td class=\"formaty_a_velikost\">Běžící reklamní text</td>
      <td class=\"ceny_seznam specifikace_seznam\"><span>odkaz na vaše stránky,</span> <span>text v délce max. 40 znaků</span></td>
      <td class=\"ceny_seznam delsi_cena_seznam\"><span>1 000 Kč / týden</span> <span>3 000 Kč / měsíc</span></td>
      <td class=\"poznamky_seznam\"><span class=\"prazdny_text\">---</span></td>
    </tr>
  </tbody>
  <tfoot>
    <tr class=\"zapati_tabulky\">
      <td class=\"formaty_a_velikost\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"poznamky_seznam\"></td>
    </tr>
  </tfoot>
</table>
*/
?>
