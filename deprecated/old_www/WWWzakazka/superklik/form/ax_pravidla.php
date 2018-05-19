<?php
  return
  "
<h2></h2>
<div>
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <h1>Pravidla soutěže</h1>
  <h4>VŠEOBECNÉ PODMÍNKY</h4>
  <p>
    Všeobecné podmínky serveru Superklik.cz obsahují základní informace o těchto stránkách a pravidla v nich uvedená jsou závazná jak pro soutěžící, tak pro provozovatele serveru. Všeobecné podmínky se mimo jiné věnují problematice soukromí uživatelů a související ochraně osobních údajů. Níže uvedené všeobecné podmínky jsou platné od 1.1.2009.
  </p>

  {$this->var->main->VypisPravidla()}

  <a href=\"#\" class=\"zavrit_sekci_pravidla spodek\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); location.href='#'; return false;\"><span>Zavřít sekci</span></a>
</div>
<h3 class=\"pravidla_bottom\"></h3>
  ";

/*
<br>
<br>
>>konec vypisu<<
<br>
<br>

  <ul>
    <li class=\"nadpis_seznamu\"><span><em>I.</em>Definice</span>
      <ul>
        <li>Výherní server (dále jen Superklik.cz) – je veřejný webový server umožňující výhry pro jednotlivé soutěžící. Soutěžit může jen zaregistrovaný uživatel.</li>
        <li>Uživatel soutěže (dále jen uživatel nebo soutěžící) - osoba, která je občanem České republiky a má zde trvalé bydliště a při registraci potvrdí souhlas s těmito pravidly.</li>
        <li>Pořadatel soutěže (dále jen pořadatel) - právnická nebo fyzická osoba, která si u provozovatele zadá zveřejnění soutěže. Pořadatelem může být i provozovatel.</li>
        <li>Provozovatel Superklik.cz (dále jen provozovatel) – AZ-System s.r.o. se sídlem Fibichova 43, Břeclav, 690 02, IČO: 25715909, www.azsystem.cz</li>
        <li>Výherce soutěže (dále jen výherce) - uživatel, který zodpověděl správně soutěžní otázky v soutěži a byl automaticky vylosován po skončení soutěže.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>II.</em>Obecná pravidla</span>
      <ul>
        <li>Na výherním portálu Superklik.cz se mohou účastnit všichni zaregistrovaní uživatelé serveru kteří souhlasí s těmito pravidly, s výjimkou zaměstnanců a spolupracovníků provozovatele a jejich rodinných příslušníků.</li>
        <li>Provoz serveru, povinnosti provozovatele, pořadatelů a uživatelů jsou dány těmito pravidly.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>III.</em>Registrace</span>
      <ul>
        <li>Zkusit své štěstí se mohou účastnit pouze řádně zaregistrovaní uživatelé. Řádnou registrací se rozumí uvedení všech povinných registračních údajů v souladu se skutečností. Nepovinné údaje vyplněny být nemusí, nesmějí však být vyplněny v rozporu se skutečností. Uživatel je povinen v případě změny jakýchkoliv registračních údajů opravit tyto data na stránce změna registrace, a to do 1 měsíce od okamžiku, kdy změna nastala.</li>
        <li>Každý uživatel serveru může být na  Superklik.cz  v jeden okamžik zaregistrován pouze jednou.</li>
        <li>V případě zjištění duplicitních registrací nebo nepravdivých údajů (v rozporu se skutečností) si provozovatel vyhrazuje právo na nepřiznání výhry takovémuto uživateli a na úplné zrušení všech duplicitních registrací.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>IV.</em>Ochrana osobních údajů</span>
      <ul>
        <li>Veškerá data získaná od uživatele jsou považována za jeho osobní a vztahuje se na ně ochrana podle zákona č. 101/2000 Sb. o ochraně osobních údajů.</li>
        <li>Provozovatel se zavazuje, že osobní údaje uživatelů nebudou předávány žádné třetí osobě. Výjimku tvoří pouze data výherců, která mohou být uveřejněna na stránkách  Superklik.cz  ve formátu \"Jméno - Příjmení - Město\") a dále může být jejich jméno a adresa předána pořadateli soutěže pro zaslání výhry.</li>
        <li>Data získaná od uživatele slouží jako základ pro generovaní výsledných statistických zpráv a jako kontaktní údaje pro zasílání výher nebo \"dárků za účast v soutěži\", kterými mohou být slevy na různé zboží apod.</li>
        <li>E-maily s oznámením o nových soutěžích nebo o výhrách mohou mimo toto oznámení obsahovat i reklamní sdělení či obrázek.</li>
        <li>Uživatel může kdykoliv zrušit svou registraci po přihlášení k serveru pomocí svého uživatelského jména a hesla, které zadá v průběhu registrace. Po zrušení registrace jsou veškerá data uživatele zanonymizována v souladu se zákonem č. 101/2000 Sb. o ochraně osobních údajů.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>V.</em>Účást v soutěžích</span>
      <ul>
        <li>U každé ze soutěží je uvedeno datum jejího vyhlášení i datum ukončení, přičemž během této doby se mohou uživatelé zúčastnit soutěže zodpovězením všech soutěžních otázek. Uživatelé, kteří zodpoví správně všechny soutěžní otázky, postupují do slosování o výhry. Losování soutěží probíhá automaticky do 14 dnů od data jejího ukončení. Vylosovaní výherci jsou v závislosti na nastavení osobních preferencí informováni o své výhře prostřednictvím elektronické pošty na e-mailovou adresu uvedenou při registraci</li>
        <li>Některé soutěže můžou mít doplňující nebo omezující požadavky na výherce. Jedná se například o výhry tabákových či alkoholických výrobků, zapůjčení automobilu atp. Výherce který nesplňuje všeobecné právní požadavky k získání takové výhry může výhru převést písemným, notářsky ověřeným prohlášením na jinou osobu která tyto požadavky splňuje, nebo za něj může výhru převzít jeho zákonný zástupce.</li>
        <li>Výhry jsou zasílány pouze v rámci území ČR a to na adresy výherců uvedených při registraci nejpozději do 1 měsíce od data slosování, přičemž u některých výher může být účtováno poštovné formou dobírky. V případě, že se výhra vrátí odesílateli z důvodu nevyzvednutí výhercem, bude po dobu 1 měsíce připravena k osobnímu vyzvednutí v sídle provozovatele. Pokud výhra nebude ani v této lhůtě vyzvednuta, propadá ve prospěch pořadatele soutěže.</li>
        <li>Pokud není pořadatelem soutěže přímo provozovatel, nenese provozovatel žádnou zodpovědnost za případné nedodání či neodeslání výher výhercům ze strany pořadatele soutěže.</li>
        <li>Výhry jsou právně nevymahatelné.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>VI.</em>Kreditní systém</span>
      <ul>
        <li>Každá soutěž je ohodnocena určitým počtem kreditů které se při správném zodpovězení soutěžních otázek po skončení soutěže přičtou na účet uživatele.</li>
        <li>Kredity se přičtou uživateli pouze při správném zodpovězení soutěžní otázky následný den po ukončení soutěže.</li>
        <li>Kredity je možno sbírat po dobu kalendářního roku. Účastník s největším počtem kreditů k 31.12. pak získá cenu předem vyhlášenou provozovatelem.</li>
        <li>Pořadatel může určit i kratší dobu (nejčastěji měsíc) po jejímž uplynutí získá cenu určenou provozovatelem ten soutěžící, který má nejvíce kreditů.</li>
        <li>Pokud má největší počet kreditů více uživatelů rozhodne o výherci losování stejně jako u standardních soutěží.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>VII.</em>Záruky provozovatele</span>
      <ul>
        <li>Provozovatel neposkytuje záruku nepřetržité funkčnosti, bezchybného provozu a zabezpečení serveru. Je v zájmu provozovatele veškeré funkce systému poskytovat uživatelům na maximální možné úrovni. Provozovatel se zavazuje plnit veškeré povinnosti plynoucí z těchto podmínek.</li>
        <li>Provozovatel neodpovídá za jakoukoliv škodu, která byla nebo mohla být uživateli nebo pořadateli způsobena v souvislosti s jeho používáním nebo využíváním serveru Superklik.cz.</li>
      </ul>
    </li>
  </ul>
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>VIII.</em>Závěrečná ustanovení</span>
      <ul>
        <li>Tato pravidla jsou vytvořena v souladu s platnými zákony a dalšími právními předpisy České republiky a jsou závazná pro obě strany. Uživatel serveru svou registrací potvrzuje, že byl s nimi prokazatelným způsobem seznámen a zavazuje se podle nich řídit.</li>
        <li>Provozovatel si vyhrazuje právo na případnou změnu a doplnění těchto registračních podmínek. V tomto případě provozovatel oznámí změny upozorněním na stránkách serveru Superklik.cz</li>
        <li>Tato pravidla jsou platná ode dne 1.3.2006</li>
      </ul>
    </li>
  </ul>
*/
?>
