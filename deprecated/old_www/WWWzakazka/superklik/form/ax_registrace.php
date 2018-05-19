<?php
  return
  "
<h2 id=\"h2_registrace\"></h2>
<div id=\"div_registrace\">
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <h4>Registrace uživatele</h4>
  <p>
    Zde prosím vyplňte registrační údaje. Políčka označená hvězdičkou * vyjadřují povinné údaje, které je nutné vyplnit. Registrace se skládá ze tří částí. Prvním krokem je registrace uživatele. Druhým krokem je nepovinný dotazník a třetím krokem uživatel potvrdí odsouhlasením osobních údajů a jejich nakládání za podmínek uvedených v ochraně osobních dat a údajů výherního serveru Superklik.cz
  </p>
  <h4 class=\"nadpis_ve_forme_ie6\">Krok č. 1 - Registrační údaje</h4>



  <form method=\"post\" action=\"\">
    <fieldset>
      <dl class=\"tucne rucni_centrovani\">
        <dt>
          <label for=\"input_login\">Uživatelské jméno:</label>
        </dt>
        <dd>
          <input id=\"input_login\" type=\"text\" name=\"login\" />
          <span>*</span>
        </dd>
      </dl>
      <dl class=\"tucne rucni_centrovani\">
        <dt>
          <label for=\"input_heslo\">Uživatelské heslo:</label>
        </dt>
        <dd>
          <input id=\"input_heslo\" type=\"password\" name=\"heslo\" />
          <span>*</span>
        </dd>
      </dl>
      <dl class=\"odsazeni_pod_loginem rucni_centrovani\">
        <dt>
          <label for=\"input_heslo1\">Kontrola hesla:</label>
        </dt>
        <dd>
          <input id=\"input_heslo1\" type=\"password\" name=\"heslo1\" />
          <span>*</span>
        </dd>
      </dl>
      <div class=\"levy_sloupec_osobni_udaje\">
        <dl>
          <dt>
            <label for=\"input_jmeno\">Jméno:</label>
          </dt>
          <dd>
            <input id=\"input_jmeno\" type=\"text\" name=\"jmeno\" />
            <span>*</span>
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_prijmeni\">Příjmení:</label>
          </dt>
          <dd>
            <input id=\"input_prijmeni\" type=\"text\" name=\"prijmeni\" />
            <span>*</span>
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_email\">E-mail:</label>
          </dt>
          <dd>
            <input id=\"input_email\" type=\"text\" name=\"email\" value=\"@\" />
            <span>*</span>
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_telefon\">Telefon:</label>
          </dt>
          <dd>
            <input id=\"input_telefon\" type=\"text\" name=\"telefon\" />
          </dd>
        </dl>
      </div>
      <div class=\"pravy_sloupec_osobni_udaje\">
        <dl>
          <dt>
            <label for=\"input_ulice\">Ulice:</label>
          </dt>
          <dd>
            <input id=\"input_ulice\" type=\"text\" name=\"ulice\" />
            <span>*</span>
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_cp\">Číslo popisné:</label>
          </dt>
          <dd>
            <input id=\"input_cp\" type=\"text\" name=\"cp\" />
            <span>*</span>
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_psc\">PSČ:</label>
          </dt>
          <dd>
            <input id=\"input_psc\" type=\"text\" name=\"psc\" />
            <span>*</span>
          </dd>
        </dl>
        <dl>
          <dt>
            <label for=\"input_mesto\">Město:</label>
          </dt>
          <dd>
            <input id=\"input_mesto\" type=\"text\" name=\"mesto\" />
            <span>*</span>
          </dd>
        </dl>
      </div>
      <acronym id=\"povinne_udaje\">* Povinné údaje</acronym>


    <h4 class=\"nadpis_ve_forme\">Krok č. 2 - Dotazník</h4>

    <div id=\"dotaznik\">
      {$this->var->main->VypisDotaznik()}
    </div>

    <h4 class=\"nadpis_ve_forme\">Krok č. 3 - Prohlášení o nakládání s osobními údaji</h4>

    <div class=\"ostatni_info_potvrdit\">
            <textarea>
                                                Souhlas se zpracováním osobních údajů

      Uděluji tímto provozovateli serveru www.superklik.cz (dále jen „server“), společnosti MV Consulting s.r.o., IČ: 283 21 219, se sídlem Nám. P. Bezruče 1131/14, 690 02 Břeclav, zapsaná v obchodním rejstříku vedeném u Krajského soudu v Brně v oddílu C, vložce číslo 61130 (dále jen „správce“) ve smyslu zákona č. 101/2000 Sb. v platném znění (dále jen „Zákon“) souhlas s automatizovaným i manuálním zpracováním svých osobních údajů v rozsahu uvedeném v registračním formuláři, v potvrzení o přijetí výhry dle článku II 5. (3) Všeobecných podmínek a ve všech anketních částech soutěží pořádaných správcem na serveru (dále jen „osobní údaje“), kterých se zúčastním (dále jen „soutěž/e“), za tím účelem, (1) aby správce prověřoval mou platnou účast v soutěžích; v případě, že se stanu výhercem, též aby mně předal cenu a v rámci toho aby zveřejnil mé osobní údaje v rozsahu: jméno, příjmení a PSČ na serveru v rubrice „Výherci“; a v souladu s anketním účelem soutěží, (2) aby správce zpracovával mé osobní údaje pro své marketingové potřeby, zejména aby mě zasílal informace o pořádaných soutěžích nebo vložených cenách nebo obchodní informace týkající se zboží a služeb dále definovaných příjemců a (3) aby správce nebo dále definovaní příjemci vyhodnocovali mé osobní údaje z hlediska mých společenských a spotřebitelských návyků, (4) aby správce předával mé osobní údaje níže definovaným příjemcům a dále (5) aby je níže definovaní příjemci zpracovávali pro své marketingové potřeby, tj. aby mně zejména zasílali nabídky svého zboží a služeb.
      Příjemci jsou z hlediska Zákona zpracovateli a mohou jimi být všichni stávající a budoucí smluvními partneři správce tj. poskytovatelé jednotlivých cen do soutěží a další subjekty, jejichž předmětu podnikání se týkají nebo budou týkat anketní části soutěží či vložené ceny, zejména zadavatelé marketingových výzkumů, tedy hlavně podnikatelské subjekty působící v oblasti bankovnictví, pojišťovnictví a jiných finančních služeb, v oblasti cestovního ruchu, zejména cestovní kanceláře a hotely, v oblasti realit a stavebnictví např. realitní kanceláře, v oblasti volnočasových aktivit a zdraví např. fitness centra, kultury a umění, a v oblasti obchodu spotřebním zbožím např. elektronikou, kosmetikou, dětským zbožím, včetně těch, kteří provozují svou činnost prostřednictvím elektronických prostředků např. on-line obchody. Souhlasím s tím, aby správce za shora uvedených podmínek zpracovával mé osobní údaje též prostřednictvím dalších řádně pověřených zpracovatelů zejm. reklamních agentur a informačních společností.
      Tento souhlas uděluji na celou dobu své registrace na serveru, tedy do okamžiku, kdy zde ukončím svou registraci, případně, kdy bude ukončena v souladu se všeobecnými podmínkami serveru ze strany správce, dojde-li k tomu dříve.
      Poskytnutí tohoto souhlasu je dobrovolné, je však podmínkou platné registrace na serveru a účasti v soutěžích.

      Poučení: Tento souhlas můžete odvolat zrušením své registrace na serveru zasláním emailu či doporučeného dopisu zaslaného na adresu sídla správce s účinností ode dne doručení správci. Odvolání souhlasu má za následek vyloučení ze všech probíhajících soutěží a ztrátu případného nároku na ceny do nich vložené. O odvolání Vašeho souhlasu bude správce bezodkladně informovat všechny dotčené zpracovatele.

      Vaše práva
      Máte právo na přístup k Vašim osobním údajů, právo na jejich opravu, jakož i další práva stanovená §21 Zákona tj. zejména právo požadovat na správci vysvětlení, domníváte-li se, že zpracování je nezákonné nebo v rozporu s ochranou Vašeho soukromého a osobního života či, že Vaše osobní údaje jsou nepřesné, a požadovat odstranění tohoto stavu blokováním osobních údajů, provedením opravy, doplněním nebo likvidací Vašich osobních údajů atp.
Poučení: Změnu svých osobních údajů můžete provést přímo v sekci „Profil-uživatel“ nebo o ní informovat správce doporučeným dopisem zaslaným na adresu jeho sídla. O změně Vašich osobních údajů bude správce bezodkladně informovat všechny dotčené zpracovatele.

      Závazek správce
      Správce se zavazuje, že bude spolu se všemi zpracovateli tj. zejména výše definovanými příjemci zpracovávat Vaše osobní údaje v souladu s tímto souhlasem a se Zákonem, zejména že bude dbát, abyste neutrpěl(a) újmu na svých právech a abyste byl(a) chráněn(a) před neoprávněným zasahováním do soukromého a osobního života, a to především tak, že prostřednictvím technicko-organizačních opatření zajistí ochranu Vašich údajů před jakýmkoli neoprávněným přístupem, před jejich změnou, zničením či ztrátou, neoprávněnými přenosy a veškerým jejich neoprávněným zpracováním.
      Souhlas se zasíláním obchodních sdělení
      Uděluji tímto správci a příjemcům souhlas s tím, aby v souladu se zákonem č. 480/2004 Sb. v platném znění, o některých službách informační společnosti, využívali podrobnosti mého elektronického kontaktu tj. mou e-mailovou adresu nebo mé číslo mobilního telefonu pro účely šíření obchodních sdělení týkajících se jejich vlastního zboží a služeb a v případě správce též zboží a služeb příjemců.

      Závazek správce
      Správce se zavazuje, že obchodní sdělení, která Vám budeme zasílat na Vaši e-mailovou adresu budou jasně označena jako „obchodní sdělení“, bude z nich zřejmá totožnost odesílatele, jehož jménem se bude komunikace uskutečňovat, a budou obsahovat platnou adresu, na kterou můžete přímo a účinně zaslat informaci o tom, že si nepřejete, aby Vám byly obchodní informace odesílatelem nadále zasílány.

            </textarea>
            <p>
              Souhlasím s pravidly o poskytnutí osobních údajů a dalším použití dle pravidel soutěžních podmínek Superklik.cz <input id=\"input_souhlas\" onclick=\"UkazTlacitko('tlacitko_potvrdit', false);\" type=\"checkbox\" />
            </p>
          </div>
      <input type=\"button\" name=\"tlacitko\" id=\"tlacitko_potvrdit\" value=\"Zaregistrovat\" disabled=\"disabled\" onclick=\"Registrace(document.getElementById('input_login').value, document.getElementById('input_heslo').value, document.getElementById('input_heslo1').value, document.getElementById('input_email').value, document.getElementById('input_jmeno').value, document.getElementById('input_prijmeni').value, document.getElementById('input_ulice').value, document.getElementById('input_cp').value, document.getElementById('input_psc').value, document.getElementById('input_mesto').value, document.getElementById('input_telefon').value, document.getElementById('input_souhlas').checked); location.href='#';\" />








    </fieldset>
  </form>













  <a href=\"#\" class=\"zavrit_sekci_pravidla spodek\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); location.href='#'; return false;\"><span>Zavřít sekci</span></a>
</div>
<h3 id=\"h3_registrace\"></h3>
  ";
  /*
      <div>
        <em>Pohlaví:</em>
        <select size=\"1\" name=\"pohlavi\">
          <option>- Vyber možnost -</option>
          <option>Muž</option>
          <option>Žena</option>
        </select>
      </div>
      <div class=\"vpravo delsi\">
        <em>Stáří:</em>
        <select size=\"1\" name=\"vek\">
          <option>- Vyber možnost -</option>
          <option>5 - 11 let</option>
          <option>12 - 15 let</option>
          <option>16 - 18 let</option>
          <option>19 - 25 let</option>
          <option>26 - 35 let</option>
          <option>36 - 50 let</option>
          <option>51 - a více let</option>
        </select>
      </div>
      <div>
        <em>Pracuji jako:</em>
        <select size=\"1\" name=\"povolani\">
          <option>- Vyber možnost -</option>
          <option>Podnikatel</option>
          <option>Státní správa</option>
          <option>Ekonom</option>
          <option>Školství</option>
          <option>Ve firmě</option>
          <option>Student</option>
          <option>Nezaměstnaný</option>
        </select>
      </div>
      <div class=\"vpravo delsi\">
        <em>O Superklik.cz jsem se dozvěděl(a):</em>
        <select size=\"1\" name=\"anketa\">
          <option>- Vyber možnost -</option>
          <option>Z internetové reklamy</option>
          <option>Z televize</option>
          <option>Z novin</option>
          <option>Z inzerátu</option>
          <option>Od známého</option>
          <option>Z letáku</option>
        </select>
      </div>
  */
?>
