<?php
class Hlavni
{
  public $var, $web;
//******************************************************************************
	function __construct(&$var)  //konstruktor
	{
    $this->var = $var;

    $this->var->web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
	}
//******************************************************************************
	function MenuAdmin()
	{
		$result =
    "
    <div id=\"menu_admin\">";

    for ($i = 1; $i < count($this->var->sekce) + 1; $i++)
    {
      if ($this->var->sekce[$i] != "sponzori" &&
          $this->var->sekce[$i] != "solo" &&
          $this->var->sekce[$i] != "hokej")
      {
        $result .=
        "
        <p id=\"{$this->var->sekce[$i]}\">
          <a href=\"?action=administrace&amp;akce={$this->var->sekce[$i]}\" title=\"{$this->var->nazevsekce[$i]}\">{$this->var->nazevsekce[$i]}</a>
        </p>

        ";
      }
    }
/*
      <p id=\"uprava_textu\">
        <a href=\"?action={$_GET["action"]}&amp;akce=aktuality\" title=\"Aktuality\">Aktuality</a>
      </p>
      <p id=\"panel_novinky\">
        <a href=\"?action=administrace&amp;akce=novinky\" title=\"Panel Novinky\">Historie klubu</a>
      </p>
      <p id=\"panel_grafika\">
        <a href=\"?action=administrace&amp;akce=grafika\" title=\"Panel Grafika\">Foto galerie</a>
      </p>
      <p id=\"panel_kontakty\">
        <a href=\"?action=administrace&amp;akce=kontakt\" title=\"Panel Kontakty\">Panel Kontakty</a>
      </p>
      <p id=\"uvodni_strana\">
        <a href=\"?action=administrace\" title=\"Úvodní strana\">Úvodní strana</a>
      </p>
*/
      $result .=
      "<p id=\"odhlasit\">
        <a href=\"?action=administrace&amp;akce=logoff\" title=\"Odhlásit\">Odhlásit</a>
      </p>
      <p id=\"zpet_na_stranky\">
        <a href=\"./\" title=\"Zpět na stránky\">Zpět na stránky</a>
      </p>
      <p class=\"gen\">
        {$this->KonecCas()}
      </p>
    </div>
    ";
		return $result;
	}
//******************************************************************************
	function AutoClick($cas, $cesta)	//auto kliknutí, procedůra
	{
		$this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
	}
//******************************************************************************
	function ObsahStrakny()
	{
		$kam = $_GET["action"];

		if (!Empty($kam))
		{
      if (file_exists("{$this->var->form}/{$kam}.php"))
			{
				$this->var->kam = $kam;
        $result = include_once "{$this->var->form}/{$this->var->kam}.php";
			}
				else
			{
				$this->var->kam = $this->var->default;
				$result = include_once "{$this->var->form}/{$this->var->kam}.php";
			}
		}
			else
		{
			$this->var->kam = $this->var->default;
			$result = include_once "{$this->var->form}/{$this->var->kam}.php";
		}

		return $result;
	}
//******************************************************************************
  function OtevriMySQLi() //otvírání DB
  {
    $this->var->mysqli = @new mysqli($this->var->login->host, $this->var->login->username, $this->var->login->password, $this->var->login->databaze, $this->var->login->port);
    if (!mysqli_connect_errno())	//objektové připojení do DB mysqli_connect_errno()
    {
      if (@$this->var->mysqli->multi_query("SET CHARACTER SET UTF8"))	//bez návratu testuje jen chybu s negací
      {
        $result = true;
      }
        else
      {
        $this->ErrorMsg($this->var->myslqi->error);
      }
    }
      else
    {
      $result = false;
      $this->ErrorMsg(mysqli_connect_error());
    }

    return $result;
  }
//******************************************************************************
  function ZavriMySQLi()  //zavírání DB
  {
    $this->var->mysqli->close();
  }
//******************************************************************************
  function InstalaceMySQLi()  //instalace DB
  {
    if ($this->var->instalace)
    {
      if (!$this->ExistujeTabulka("aktuality")) //aktuality
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE aktuality (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              datum DATE NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @@$this->var->mysqli->multi_query("INSERT INTO aktuality (id, datum, text) VALUES(1, '2007-8-6', 'Kurzy bruslení - rozvh na sezónu 2007/2008');");
        @$this->var->mysqli->multi_query("INSERT INTO aktuality (id, datum, text) VALUES(2, '2007-8-6', 'Sólové bruslení - rozvrh srpen 2007');");
        @$this->var->mysqli->multi_query("INSERT INTO aktuality (id, datum, text) VALUES(3, '2007-8-6', 'Team Moravia A - rozvh na sezónu 2007/2008');");
        @$this->var->mysqli->multi_query("INSERT INTO aktuality (id, datum, text) VALUES(4, '2007-8-31', 'Dne 12.9.2007 v 18:00 se koná členská schůze FSC TECHNIKA BRNO v restauraci na zimním stadionu. Všechny Vás srdečně zveme.');");
        @$this->var->mysqli->multi_query("INSERT INTO aktuality (id, datum, text) VALUES(5, '2007-11-24', 'Team Moravia B - poslední trénink v roce 2007 - 21.12. 15:00 - 16:00. Od nového roku začíname 4.1. 15:00 - 16:00');");
      }

      if (!$this->ExistujeTabulka("texty")) //texty
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE texty (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce VARCHAR(20) NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'uvod1', 'Staráme se jak o výchovu začátečníků, tak i o zájmové, závodní a vrcholové krasobruslení. Náš klub nabízí možnost uplatnění v disciplínách: [b]sólové krasobruslení, sportovní dvojice, tance na ledě a synchronizované bruslení.[/b]');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'uvod2', 'je amatérský tým složený ze 16 krasobruslařů od 13 let zúčastňující se závodů. Ve svém programu zařazuje prvky synchronizovaného bruslení');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'uvod3', 'Pro chlapce i dívky. Děti se zúčastňují závodů po celé Evropě. Předvádějí volné jízdy skládající se ze skoků, piruet a dalších krasobruslařských prvků.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'uvod4', 'Pro chlapce kteří již zvládají jízdu na bruslích a mají zájem se v budoucnu státi malými hokejisty.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'uvod5', 'pro chlapce a dívky od 3 do 100 let.Kurzy od úplných začátečníků až po pokročilé bruslaře');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'historie', 'Skupina synchronizovaného bruslení – Team Moravia - vznikla spojením dvou skupin v roce 2001. Moravia navázala na činnost týmů Alky Brno a M-style Jihlava v seniorské kategorii. Během minulých sezón se Moravia účastnila domácích i zahraničních soutěží (Brno, Jihlava, Praha, Neuchatel, Milano), v České republice získala druhé (2002) a třetí (2003) místo na mistrovství republiky. Tým Moravia prošel velkým přerodem, který se pozitivně odrazil na technické i umělecké prezentaci týmu na ledě. České synchronizované bruslení zaznamenalo za několik posledních let velmi výrazný posun v kvalitě, proto je pro tým Moravia nastávající sezóna výzvou získat co nejlepší umístění ve stále zvyšující se konkurenci českých týmů.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kontakt1', '[b]FSC Technika Brno[/b]
                                                                                                      [odstavec]
                                                                                                        Hokejová hala dětí a mládeže
                                                                                                      [/odstavec]
                                                                                                      [odstavec]
                                                                                                        Střední 595/26
                                                                                                      [/odstavec]
                                                                                                      [odstavec]
                                                                                                        602 00 Brno
                                                                                                      [/odstavec]
                                                                                                      [odstavec]
                                                                                                        [email=&quot;fsc@fscbrno.cz&quot;]fsc@fscbrno.cz[/email]
                                                                                                      [/odstavec]');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kontakt2', '[b]Bankovní spojení[/b]
                                                                                                      [odstavec]
                                                                                                        373952733/0300
                                                                                                      [/odstavec]');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kontakt3', '[b]Variabilní symbol[/b]: Uvádějte rodné číslo dítěte. Do [b]vzkazu pro příjemce[/b] uveďte jméno dítěte.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'akce', 'Přehled akcí pořádaných v roce 2008');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy1', 'Kurzy 2007/2008');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy2', 'KURZY 2008 LEDEN-DUBEN');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy3', 'ŠKOLKA BRUSLENÍ');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy4', '80,-Kč / 1 hod');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy5', 'ŠKOLA BRUSLENÍ');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy6', '90,-Kč / 1 hod');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy7', 'KRASOBRUSLAŘSKÁ PŘÍPRAVKA');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy8', 'HOKEJOVÁ PŘÍPRAVKA: (pro pokročilé bruslaře)');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy9', 'Kartička na 5 lekcí * 80,-Kč = 400,-Kč');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy10', 'Platby jako ŠKOLA BRUSLENÍ.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy11', 'Školka bruslení');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy12', '3 - 4,5 roku');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy13', 'Herní výuka bruslení s různými pomůckami kde se děti seznámí se zaklady bruslení. Výuka probíhá pod dohledem trenérů. Lekce trvá 60min.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy14', 'Škola bruslení');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy15', '5 - 9 let');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy16', 'Škola bruslení je určena pro děti začátečníky i pokročilé. Děti budou dle výkonosti rozděleny do družstev s počtem 10 - 12 dětí. Trénuje se jak pod dohledem trenérů krasobruslení, tak hokeje, kteří dohlíží na technicky správné bruslení. Po absolvovaní kurzu jsou děti dle vašeho zájmu a dovednosti dítěte zařazeny do přípravky krasobruslařské a hokejové kde již probíhá specializovaný výcvik.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy17', 'Škola pro začátečníky a pokročilé');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy18', '9 - 15 let');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy19', '');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy20', 'Škola bruslení pro amatéry');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy21', '15 - 100 let');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy22', 'Je rekreační forma bruslení kde se zdokonalíte a vylepšíte techniku jak pro krasobruslení tak pro hokej nebo jen pro vaši radost!');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy23', 'Rádi vám ukážeme jak se zlepšit.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy24', 'Pondělí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy25', '16:30 - 17:30');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy26', '7.1. - 28.4.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy27', '17 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy28', 'Středa');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy29', '16:45 - 17:45');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy30', '9.1. - 30.4.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy31', '17 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy32', 'Čtvrtek');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy33', '17:15 - 18:15');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy34', '3.1. - 27.4.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy35', '17 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy36', 'Neděle');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy37', '16:30 - 17:30');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy38', '6.1. - 27.4.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy39', '17 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy40', 'Neděle');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy41', '17:30 - 18:30');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy42', '6.1. - 27.4.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy43', '17 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy44', '4 lekce');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy45', '300,-Kč');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy46', '1x týdně');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy47', '8 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy48', '600,-Kč');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy49', '2x týdně');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy50', '1x týdně');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy51', '17 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy52', '1200,-Kč');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy53', '4 měsíce');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy54', '2x týdně');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy55', '34 lekcí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy56', '2300,-Kč');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy57', '4 měsíce');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy58', 'Pondělí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy59', '16:30 - 17:30');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy60', 'Čtvrtek');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy61', '17:15 - 18:15');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy62', '1 měsíc');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy63', '2x týdně');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy64', '550,-Kč');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy65', 'Pondělí');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy66', '16:30 - 17:30');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy67', 'Čtvrtek');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'kurzy68', '17:15 - 18:15');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'rozvrh1', 'Tréninky srpen 2008');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'rozvrh2', 'Pozn.: Suchá příprava bude probíhat s trenéry v areálu zimního stadionu, nebo venku.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'rozvrh3', 'Tréninky srpen 2008 - Přípravka');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'rozvrh4', 'Pozn.: Suchá příprava bude probíhat s trenéry v areálu zimního stadionu, nebo venku.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team1', '[b]Nově vznikající amatérský tým synchronizovaného bluslení.[/b]');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team2', 'Zájmové rekreační bruslení pro dívky a chlapce od 13 do 100 let, kteří již ovládají základní dovednost na ledě a mají chuť se stát členy amaterského týmu MORAVIA B. Stačí ovládat jízdu vpřed a vzad. O zbytek se postará profesionální trenér, který s vámi bude rád spolupracovat celou sezónu.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team3', 'Nebojte se, buďte odvážní a výsledky se brzy dostavý.');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team4', '[b]OD ROKU 2008 ZAČÍNÁME 4.1. 15:00 - 16:00.[/b]');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team5', 'Rozvrh na sezónu 2008');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team6', 'Tréninky se konají 2x týdně na Hokejové hale dětí a mládeže v Brně ul. Střední');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team7', '[b]Po 16:30 - 17:30[/b]Technika bruslení');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team8', '[b]Pá 15:00 - 16:00[/b]Nácvik volné jízdy');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team9', '[b]Trvání kurzu: 17.9. - 17.12[/b]');");
        @$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES(NULL, 'team10', '[b]Cena kurzu : 1900,-Kč[/b]');");
      }

      if (!$this->ExistujeTabulka("kontakt")) //kontakt
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE kontakt (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce VARCHAR(20) NULL,
                                              jmeno VARCHAR(100) NULL,
                                              telefon VARCHAR(20) NULL,
                                              email VARCHAR(100) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'team', 'Jiránková Zuzana', '+420602773649', 'jirankova.z@seznam.cz');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'solo', 'Hegr Michal', '+420608711733', 'michalhegr@seznam.cz');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'solo', 'Kepáková Petra', '+420737211179', '');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'solo', 'Hájková Miroslava', '+420724117495', 'hajkova1@quick.cz');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'kurzy', 'Tůnová Sylva', '+420604591246', 'sylvaduchackova@centrum.cz');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'kurzy', 'Hegr Michal', '+420608711733', 'michalhegr@seznam.cz');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'kurzy', 'Hájková Miroslava', '+420724117495', 'hajkova1@quick.cz');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'kurzy', 'Kepáková Petra', '+420737211179', '');");
        @$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, 'hokej', 'Štrůbl Rostislav', '+420775919999', '');");
      }

      if (!$this->ExistujeTabulka("historie")) //historie
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE historie (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              hlava VARCHAR(100) NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO historie (id, hlava, text) VALUES(NULL, '2006-2007', 'Team Moravia se zúčastnil několika exibicí.');");
        @$this->var->mysqli->multi_query("INSERT INTO historie (id, hlava, text) VALUES(NULL, '17.3-18.3.07', 'Závod Thropeé des Hauts de France - Companie kde jsme se umístili na 2.místě');");
      }

      if (!$this->ExistujeTabulka("akce")) //akce
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE akce (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              datum DATE NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("trenink")) //trenink
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE trenink (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              datum TEXT NULL,
                                              trenink1 VARCHAR(100) NULL,
                                              sucha VARCHAR(100) NULL,
                                              trenink2 VARCHAR(100) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES (NULL, '4.8', '8:45 - 9:45', '10:15 - 11:15', '11:30 - 12:30');");
        @$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES (NULL, '5.8', '8:45 - 9:45', '10:15 - 11:15', '11:30 - 12:30');");
        @$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES (NULL, '6.8', '8:45 - 9:45', '10:15 - 11:15', '11:30 - 12:30');");
        @$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES (NULL, '6.8', '8:45 - 9:45', '10:15 - 11:15', '11:30 - 12:30');");
        @$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES (NULL, '8.8', '8:45 - 9:45', '10:15 - 11:15', '11:30 - 12:30');");
        @$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES (NULL, '11.8', '8:15 - 9:15', '10:00 - 11:00', '11:15 - 12:15');");
      }

      if (!$this->ExistujeTabulka("treninkpripravka")) //trenink pripravka
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE treninkpripravka (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              datum TEXT NULL,
                                              led VARCHAR(100) NULL,
                                              sucha VARCHAR(100) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO treninkpripravka (id, datum, led, sucha) VALUES (NULL, '4.8', '8:45 - 9:45', '10:15 - 11:15');");
        @$this->var->mysqli->multi_query("INSERT INTO treninkpripravka (id, datum, led, sucha) VALUES (NULL, '5.8', '8:45 - 9:45', '10:15 - 11:15');");
        @$this->var->mysqli->multi_query("INSERT INTO treninkpripravka (id, datum, led, sucha) VALUES (NULL, '6.8', '8:45 - 9:45', '10:15 - 11:15');");
        @$this->var->mysqli->multi_query("INSERT INTO treninkpripravka (id, datum, led, sucha) VALUES (NULL, '7.8', '8:45 - 9:45', '10:15 - 11:15');");
        @$this->var->mysqli->multi_query("INSERT INTO treninkpripravka (id, datum, led, sucha) VALUES (NULL, '8.8', '8:45 - 9:45', '10:15 - 11:15');");
      }

      if (!$this->ExistujeTabulka("fotosekce")) //fotosekce
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotosekce (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              nazev VARCHAR(100) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotogalerie")) //fotogalerie 1 sece-> N fotek, propojení fotek podle id, sekce podle sekce
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotogalerie (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce INTEGER UNSIGNED NULL,
                                              altobrazek VARCHAR(200) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotomini")) //fotomini
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotomini (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto MEDIUMBLOB NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotofull")) //fotofull
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotofull (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto LONGBLOB NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("napiste")) //napiste
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE napiste (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              jmeno VARCHAR(50) NULL,
                                              prijmeni VARCHAR(50) NULL,
                                              ulice VARCHAR(100) NULL,
                                              mesto VARCHAR(100) NULL,
                                              psc INTEGER UNSIGNED NULL,
                                              telefon VARCHAR(20) NULL,
                                              email VARCHAR(50) NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("forum")) //napiste
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE forum (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              datum DATETIME NULL,
                                              jmeno VARCHAR(50) NULL,
                                              email VARCHAR(50) NULL,
                                              zprava TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }
    }
  }
//******************************************************************************
  function ExistujeTabulka($nazev)  //ověření existence tabulky
  {
    if ($res = @$this->var->mysqli->query("SHOW TABLES"))
    {
      $poc = $res->num_rows;
      $pex = 0;
      $tab = "Tables_in_{$this->var->login->databaze}";

      while ($data = $res->fetch_object())
      {
        if ($data->$tab == $nazev)
        {
          $pex++;
        }
      }

      $result = ($pex == 1 ? true : false);
    }
      else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisTextuSekce($sekce, $hole = false)
  {
    if ($res = @$this->var->mysqli->query("SELECT text FROM texty WHERE sekce='{$sekce}';"))
		{
      switch ($hole)
      {
        case true:
          $result = $res->fetch_object()->text;  //nahrazení textu
        break;

        case false:
          $result = str_replace($this->var->short, $this->var->long, $res->fetch_object()->text);  //nahrazení textu
        break;
      }

    }
      else
    {
      $this->ErrorMsg($this->var->mysqli->error);
    }

    return $result;
  }
//******************************************************************************
  function UpravTextyUvod()
  {
    $uvod1 = stripslashes(htmlspecialchars($_POST["uvod1"]));
    $uvod2 = stripslashes(htmlspecialchars($_POST["uvod2"]));
    $uvod3 = stripslashes(htmlspecialchars($_POST["uvod3"]));
    $uvod4 = stripslashes(htmlspecialchars($_POST["uvod4"]));
    $uvod5 = stripslashes(htmlspecialchars($_POST["uvod5"]));

    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$uvod1}' WHERE sekce='uvod1';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$uvod2}' WHERE sekce='uvod2';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$uvod3}' WHERE sekce='uvod3';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$uvod4}' WHERE sekce='uvod4';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$uvod5}' WHERE sekce='uvod5';");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty uvod byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function UpravTextyHistorie()
  {
    $historie = stripslashes(htmlspecialchars($_POST["historie"]));

    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$historie}' WHERE sekce='historie';");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty historie byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function UpravTextyRozvrh()
  {
    $rozvrh1 = stripslashes(htmlspecialchars($_POST["rozvrh1"]));
    $rozvrh2 = stripslashes(htmlspecialchars($_POST["rozvrh2"]));
    $rozvrh3 = stripslashes(htmlspecialchars($_POST["rozvrh3"]));
    $rozvrh4 = stripslashes(htmlspecialchars($_POST["rozvrh4"]));

    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$rozvrh1}' WHERE sekce='rozvrh1';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$rozvrh2}' WHERE sekce='rozvrh2';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$rozvrh3}' WHERE sekce='rozvrh3';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$rozvrh4}' WHERE sekce='rozvrh4';");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty rozvrh byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function UpravTextyKontakt()
  {
    $kontakt1 = stripslashes(htmlspecialchars($_POST["kontakt1"]));
    $kontakt2 = stripslashes(htmlspecialchars($_POST["kontakt2"]));
    $kontakt3 = stripslashes(htmlspecialchars($_POST["kontakt3"]));

    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$kontakt1}' WHERE sekce='kontakt1';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$kontakt2}' WHERE sekce='kontakt2';");
    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$kontakt3}' WHERE sekce='kontakt3';");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty kontakt byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function UpravTextyAkce()
  {
    $akce = stripslashes(htmlspecialchars($_POST["textakce"]));

    @$this->var->mysqli->multi_query("UPDATE texty SET text='{$akce}' WHERE sekce='akce';");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty akce byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function UpravTextyKurzy()
  {
    for ($i = 1; $i <= 68; $i++)  //68 radku
    {
      $kurzy = stripslashes(htmlspecialchars($_POST["kurzy{$i}"]));
      @$this->var->mysqli->multi_query("UPDATE texty SET text='{$kurzy}' WHERE sekce='kurzy{$i}';");
    }

    $result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty kurzy byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function UpravTextyTeam()
  {
    for ($i = 1; $i <= 10; $i++)  //10 radku
    {
      $team = stripslashes(htmlspecialchars($_POST["team{$i}"]));
      @$this->var->mysqli->multi_query("UPDATE texty SET text='{$team}' WHERE sekce='team{$i}';");
    }

    $result =
    "
            <div class=\"potvrzeni\">
              <p>
                texty team byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SekceKontakt()
  {
    $result =
    "<select name=\"sekcekontakt\" id=\"label_input_sekce\">";

    $hodnoty = array_keys($this->var->hkontakt);
    for ($i = 0; $i < count($this->var->hkontakt); $i++)
    {

      $result .=
      "
      <option value=\"{$hodnoty[$i]}\">{$this->var->hkontakt[$hodnoty[$i]]}</option>
      ";
    }

    $result .=
    "</select>";

    return $result;
  }
//******************************************************************************
  function SekceKontaktOznaceny($id)
  {
    $result =
    "<select name=\"sekcekontakt\" id=\"label_input_sekce\">";

    $hodnoty = array_keys($this->var->hkontakt);
    for ($i = 0; $i < count($this->var->hkontakt); $i++)
    {

      $result .=
      "
      <option value=\"{$hodnoty[$i]}\" ".($id == $hodnoty[$i] ? "selected=\"selected\"" : "").">{$this->var->hkontakt[$hodnoty[$i]]}</option>
      ";
    }

    $result .=
    "</select>";

    return $result;
  }
//******************************************************************************
	function ObsahAdmin()
	{
		switch ($_GET["akce"])
    {
      //************************************************************************
			case "uvod":
        if (!Empty($_POST["uvod1"]) &&
            !Empty($_POST["uvod2"]) &&
            !Empty($_POST["uvod3"]) &&
            !Empty($_POST["uvod4"]) &&
            !Empty($_POST["uvod5"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result .= $this->UpravTextyUvod();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
      <div id=\"hlavni_strana_sekce\">
          <h4>Panel: <em>Hlavní strana</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>
              {$this->FormatovaniTextu("styl_uvod1")}
            <textarea name=\"uvod1\" id=\"styl_uvod1\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("uvod1", true)}</textarea>
              {$this->FormatovaniTextu("styl_uvod2")}
            <textarea name=\"uvod2\" id=\"styl_uvod2\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("uvod2", true)}</textarea>
              {$this->FormatovaniTextu("styl_uvod3")}
            <textarea name=\"uvod3\" id=\"styl_uvod3\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("uvod3", true)}</textarea>
              {$this->FormatovaniTextu("styl_uvod4")}
            <textarea name=\"uvod4\" id=\"styl_uvod4\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("uvod4", true)}</textarea>
              {$this->FormatovaniTextu("styl_uvod5")}
            <textarea name=\"uvod5\" id=\"styl_uvod5\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("uvod5", true)}</textarea>
            <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
      </div>
        ";
			break;
			//************************************************************************
			case "historie":
        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, hlava, text FROM historie WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

        if (!Empty($_POST["historie"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result .= $this->UpravTextyHistorie();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
        <div id=\"historie_sekce\">
          <h4>Panel: <em>Historie klubu</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>
            {$this->FormatovaniTextu("styl_historie")}
            <textarea name=\"historie\" id=\"styl_historie\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("historie", true)}</textarea>
            <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
        ";


        switch ($_GET["co"])
				{
          case "add":
  					$aed =
            "
            <form action=\"\" method=\"post\" class=\"pridani_form\">
              <fieldset>
              <legend>Přidat novou položku do historie</legend>
              <h3>Přidat novou položku do historie</h3>
                <label for=\"label_input_datum\">Datum: </label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"hlava\" />
                <label for=\"label_input_aktualita\" id=\"label_novinka\">Text: </label>
                  <input id=\"label_input_aktualita\" type=\"text\" name=\"text\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat položku do historie\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["hlava"]) &&
  							!Empty($_POST["text"]))
  					{
  						$aed = $this->PridejHistorii();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "edit":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <form action=\"\" method=\"post\" class=\"pridani_form\">
                <fieldset>
                <legend>Upravit položku v historii</legend>
                <h3>Upravit položku v historii</h3>
                  <label for=\"label_input_datum\">Datum: </label>
                    <input id=\"label_input_datum\" type=\"text\" name=\"hlava\" value=\"{$data->hlava}\" />
                  <label for=\"label_input_aktualita\" id=\"label_novinka\">Text: </label>
                    <input id=\"label_input_aktualita\" type=\"text\" name=\"text\" value=\"{$data->text}\" />
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Uložit položku v historii\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["hlava"]) &&
  								!Empty($_POST["text"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravHistorii($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p class=\"prvni_odstavec\">
                  Chystáte se smazat položku v historii:
                </p>
                <p>
                  S datem:
                </p>
                <p>
                  <strong>{$data->hlava}</strong>
                </p>
                <p>
                  S textem:
                </p>
                <p>
                  <strong>{$data->text}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\" class=\"pridani_form\">
                <fieldset>
                <legend>Opravdu chcete smazat tuto položku v historii ?</legend>
                <h3>Opravdu chcete smazat tuto položku v historii ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazHistorii($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornovali jste smazání položky v historii.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}

        $result .=
        "
          <p class=\"pridat_polozku\">
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\" class=\"pridat_tl\" title=\"Přidat novou položku do historie\"><span>Přidat novou položku do historie</span></a>
          </p>
          <span class=\"odsazeni_historie\"></span>
          {$aed}
          {$this->VypisHistorieEditDel()}
        </div>
        ";
			break;
			//************************************************************************
			case "fotogalerie":
        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)  //sekce
        {
          if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM fotosekce WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

        if (!Empty($cislo) && $cislo != 0)  //sekce
        {
          if ($res = @$this->var->mysqli->query("SELECT id, sekce, altobrazek FROM fotogalerie WHERE id={$cislo};"))
  				{
            $data1 = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

        switch ($_GET["co"])
				{
          case "addsekce":
  					$aed =
            "
            <form class=\"pridani_form\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Přidat sekci</legend>
              <h3>Přidat sekci</h3>
                <label for=\"label_input_sekce\">Název sekce:</label>
                  <input id=\"label_input_sekce\" type=\"text\" name=\"nazev\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat sekci\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["nazev"]))
  					{
  						$aed = $this->PridejSekci();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "editsekce":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <form class=\"pridani_form\" action=\"\" method=\"post\">
                <fieldset>
                <legend>Upravit sekci</legend>
                <h3>Upravit sekci</h3>
                  <label for=\"label_input_sekce\">Název sekce:</label>
                    <input id=\"label_input_sekce\" type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" />
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit sekci\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["nazev"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravSekci($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "delsekce":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat sekci ve fotogalerii:
                </p>
                <p>
                  S názvem:
                </p>
                <p>
                  <strong>{$data->nazev}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\" class=\"pridani_form\">
                <fieldset>
                <legend>Opravdu chcete smazat tuto sekci ve fotogalerii ?</legend>
                <h3>Opravdu chcete smazat tuto sekci ve fotogalerii ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazSekci($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání konatktu.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
          //********************************************************************
				  case "addfoto":
  					$aed =
            "
            <form class=\"pridani_form fotky\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
              <legend>Přidat fotku</legend>
              <h3>Přidat fotku</h3>
                <label for=\"label_input_sekce\">Název sekce:</label>
                  {$this->VypisSekceFotoAdd()}
                <label for=\"label_input_alt\">Popis obrázku:</label>
                  <input id=\"label_input_alt\" type=\"text\" name=\"altobrazek\" />
                <label for=\"nahrat_label_input\">Cesta k obrázku:</label>
                  <input id=\"nahrat_label_input\" type=\"file\" name=\"obrazek\" title=\"(jpg, png)\" /><span>(jpg, png, max 512kb)</span>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat fotku\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  					    !Empty($_POST["sekcefoto"]) &&
  					    !Empty($_FILES["obrazek"]["name"]))
  					{
  						$aed = $this->PridejFotku();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "editfoto":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <form class=\"pridani_form fotky\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                <legend>Upravit fotku</legend>
                <h3>Upravit fotku</h3>
                  <label for=\"label_input_sekce\">Název sekce:</label>
                    {$this->VypisSekceFotoEdit($data1->sekce)}
                  <label for=\"label_input_alt\">Popis obrázku:</label>
                    <input id=\"label_input_alt\" type=\"text\" name=\"altobrazek\" value=\"{$data1->altobrazek}\" />
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit fotku\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
                  !Empty($_POST["sekcefoto"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravFotku($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "delfoto":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat fotku ve fotogalerii:
                </p>
                <p>
                  S popisem obrázku:
                </p>
                <p>
                  <strong>{$data1->altobrazek}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\" class=\"pridani_form\">
                <fieldset>
                <legend>Opravdu chcete smazat tuto fotku ve fotogalerii ?</legend>
                <h3>Opravdu chcete smazat tuto fotku ve fotogalerii ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazFotku($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání fotky.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}

        $result .=
        "
        <div id=\"fotogalerie_sekce\">
          <h4>Panel: <em>Fotogalerie</em></h4>
          <div id=\"obal_forem\">
            {$aed}
          </div>
          <span class=\"oddelovac_foto\"></span>
          <h3>Sekce</h3>
          <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=addsekce\" class=\"pridat_tl\" title=\"Přidat sekci\"><span>Přidat sekci</span></a>
          <span class=\"oddelovac_foto\"></span>
          {$this->VypisSekceFotoEditDel()}
          <span class=\"oddelovac_foto\"></span>
          <h3>Fotky</h3>
          <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=addfoto\" class=\"pridat_tl\" title=\"Přidat fotku\"><span>Přidat fotku</span></a>
          <span class=\"oddelovac_foto mezera_fotogalerie\"></span>
          {$this->VypisFotogalerieEditDel()}
        </div>
        ";
			break;
			//************************************************************************
			case "rozvrh":
        if (!Empty($_POST["rozvrh1"]) &&
            !Empty($_POST["rozvrh2"]) &&
            !Empty($_POST["rozvrh3"]) &&
            !Empty($_POST["rozvrh4"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result .= $this->UpravTextyRozvrh();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
        <div id=\"rozvrh_treninku_sekce\">
          <h4>Panel: <em>Rozvrh tréninků</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>
          {$this->FormatovaniTextu("styl_rozvrh1")}
            <textarea name=\"rozvrh1\" id=\"styl_rozvrh1\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("rozvrh1", true)}</textarea>
          {$this->FormatovaniTextu("styl_rozvrh2")}
            <textarea name=\"rozvrh2\" id=\"styl_rozvrh2\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("rozvrh2", true)}</textarea>
          {$this->FormatovaniTextu("styl_rozvrh3")}
            <textarea name=\"rozvrh3\" id=\"styl_rozvrh3\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("rozvrh3", true)}</textarea>
          {$this->FormatovaniTextu("styl_rozvrh4")}
            <textarea name=\"rozvrh4\" id=\"styl_rozvrh4\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("rozvrh4", true)}</textarea>
            <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
        <span id=\"presun\"></span>
        ";

        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, datum, trenink1, sucha, trenink2 FROM trenink WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, datum, led, sucha FROM treninkpripravka WHERE id={$cislo};"))
  				{
            $data1 = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

				switch ($_GET["co"])
				{
          case "add":
  					$aed =
            "
            <form class=\"rozvrh_form\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Přidat řádek do první tabulky</legend>
              <h3>Přidat řádek do první tabulky</h3>
                <label for=\"label_input_prvni\">Text v prvním sloupci &amp; (Text na celý řádek):</label>
                  <input id=\"label_input_prvni\" type=\"text\" name=\"datum\" />
                <label for=\"label_input_druhy\">Text ve druhém sloupci:</label>
                  <input id=\"label_input_druhy\" type=\"text\" name=\"trenink1\" />
                <label for=\"label_input_treti\">Text ve třetím sloupci:</label>
                  <input id=\"label_input_treti\" type=\"text\" name=\"sucha\" />
                <label for=\"label_input_ctvrty\">Text ve čtvrtém sloupci:</label>
                  <input id=\"label_input_ctvrty\" type=\"text\" name=\"trenink2\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat řádek do první tabulky\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["datum"]))
  					{
  						$aed = $this->PridejTrenink();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "edit":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
            <form class=\"rozvrh_form\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Upravit řádek v první tabulce</legend>
              <h3>Upravit řádek v první tabulce</h3>
                <label for=\"label_input_prvni\">Text v prvním sloupci &amp; (Text na celý řádek):</label>
                  <input id=\"label_input_prvni\" type=\"text\" name=\"datum\" value=\"{$data->datum}\" />
                <label for=\"label_input_druhy\">Text ve druhém sloupci:</label>
                  <input id=\"label_input_druhy\" type=\"text\" name=\"trenink1\" value=\"{$data->trenink1}\" />
                <label for=\"label_input_treti\">Text ve třetím sloupci:</label>
                  <input id=\"label_input_treti\" type=\"text\" name=\"sucha\" value=\"{$data->sucha}\" />
                <label for=\"label_input_ctvrty\">Text ve čtvrtém sloupci:</label>
                  <input id=\"label_input_ctvrty\" type=\"text\" name=\"trenink2\" value=\"{$data->trenink2}\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit řádek v první tabulce\" />
              </fieldset>
            </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["datum"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravTrenink($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat řádek v první tabulce:
                </p>
                <p>
                  S textem v prvním sloupci:
                </p>
                <p>
                  <strong>{$data->datum}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\" class=\"rozvrh_form\">
                <fieldset>
                <legend>Opravdu chcete smazat tento řádek v první tabulce ?</legend>
                <h3>Opravdu chcete smazat tento řádek v první tabulce ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazTrenink($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání aktuality.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
          //********************************************************************
				  case "addpripravka":
  					$aed =
            "
            <form class=\"rozvrh_form uprava_formy\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Přidat řádek do druhé tabulky</legend>
              <h3>Přidat řádek do druhé tabulky</h3>
                <label for=\"label_input_prvni\">Text v prvním sloupci:</label>
                  <input id=\"label_input_prvni\" type=\"text\" name=\"datum\" />
                <label for=\"label_input_druhy\">Text ve druhém sloupci:</label>
                  <input id=\"label_input_druhy\" type=\"text\" name=\"led\" />
                <label for=\"label_input_treti\">Text ve třetím sloupci:</label>
                  <input id=\"label_input_treti\" type=\"text\" name=\"sucha\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat řádek do druhé tabulky\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["sucha"]) &&
  							!Empty($_POST["led"]) &&
  							!Empty($_POST["datum"]))
  					{
  						$aed = $this->PridejTreninkPripravka();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "editpripravka":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
            <form class=\"rozvrh_form uprava_formy\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Upravit řádek v druhé tabulce</legend>
              <h3>Upravit řádek v druhé tabulce</h3>
                <label for=\"label_input_prvni\">Text v prvním sloupci:</label>
                  <input id=\"label_input_prvni\" type=\"text\" name=\"datum\" value=\"{$data1->datum}\" />
                <label for=\"label_input_druhy\">Text ve druhém sloupci:</label>
                  <input id=\"label_input_druhy\" type=\"text\" name=\"led\" value=\"{$data1->led}\" />
                <label for=\"label_input_treti\">Text ve třetím sloupci:</label>
                  <input id=\"label_input_treti\" type=\"text\" name=\"sucha\" value=\"{$data1->sucha}\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit řádek v druhé tabulce\" />
              </fieldset>
            </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["sucha"]) &&
  								!Empty($_POST["led"]) &&
  								!Empty($_POST["datum"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravTreninkPripravka($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "delpripravka":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat řádek v druhé tabulce:
                </p>
                <p>
                  S textem v prvním sloupci:
                </p>
                <p>
                  <strong>{$data1->datum}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\" class=\"rozvrh_form\">
                <fieldset>
                <legend>Opravdu chcete smazat tento řádek v druhé tabulce ?</legend>
                <h3>Opravdu chcete smazat tento řádek v druhé tabulce ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazTreninkPripravka($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání aktuality.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}

				$result .=
        "
            {$aed}
            <div id=\"prvni_tabulka_obal\">
            <h3>První tabulka</h3>
            <p>(řádek tabulky)</p>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add#presun\" class=\"pridat_tl\" title=\"Přidat novinku\"><span>Přidat řádek trénků</span></a>
            </div>
            {$this->VypisTreninkEditDel()}
            <div id=\"druha_tabulka_obal\">
            <h3>Druhá tabulka</h3>
            <p>(řádek tabulky)</p>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=addpripravka#presun\" class=\"pridat_tl\" title=\"Přidat novinku\"><span>Přidat řádek trénků přípravka</span></a>
            </div>
            {$this->VypisTreninkPripravkaEditDel()}
          </div>
        ";
			break;
			//************************************************************************
			case "kurzy":
        if (!Empty($_POST["kurzy1"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result .= $this->UpravTextyKurzy();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
        <div id=\"kurzy_brusleni_sekce\">
          <h4>Panel: <em>Kurzy bruslení</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>";

          $begin = "<div><div class=\"obal_ctyrka\">";
          $center = "</div><div class=\"obal_ctyrka\">";
          $end = "</div>";
          for ($i = 1; $i <= 68; $i++)
          {
            if ($i >= 24)
            {
              switch ($i)
              {
                case 24:
                  $zac = $begin;
                break;

                case 28:
                  $zac = $center;
                break;

                case 32:
                  $zac = $center;
                break;

                case 36:
                  $zac = $center;
                break;

                case 40:
                  $zac = $center;
                break;

                case 44:
                  $zac = $center;
                break;

                case 47:
                  $zac = $center;
                break;

                case 50:
                  $zac = $center;
                break;

                case 54:
                  $zac = $center;
                break;

                case 58:
                  $zac = $center;
                break;

                case 60:
                  $zac = $center;
                break;

                case 62:
                  $zac = $center;
                break;

                case 65:
                  $zac = $center;
                break;

                case 67:
                  $zac = $center;
                break;

                default:
                  $zac = "";
                  $kon = "";
                break;
              }
            }

            $result .=
            "{$zac}
            ".($i < 24 ? "<div class=\"obal_dvojka\">{$this->FormatovaniTextu("styl_kurzy{$i}")}" : "")."
            ".(($i == 13) || ($i == 16) || ($i == 22) ?
            "<textarea name=\"kurzy{$i}\" id=\"styl_kurzy{$i}\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("kurzy{$i}", true)}</textarea>".($i < 24 ? "</div>" : "")
            : //else
            "<input type=\"text\" name=\"kurzy{$i}\" id=\"styl_kurzy{$i}\" class=\"kouzelna_trida".($i < 24 ? " upgrade_kouzelnik" : "")."\" value=\"{$this->VypisTextuSekce("kurzy{$i}", true)}\" />".($i < 24 ? "</div>" : ""))."
            {$kon}".($i == 68 ? $end : "");
          }

          $result .=
          "</div>
          <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
        </div>
        ";
			break;
			//************************************************************************
			case "akce":
        if (!Empty($_POST["textakce"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result = $this->UpravTextyAkce();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
        <div id=\"prehled_akci_sekce\">
          <h4>Panel: <em>Přehled akcí</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>
            {$this->FormatovaniTextu("prehled_akci")}
            <textarea name=\"textakce\" id=\"prehled_akci\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("akce", true)}</textarea>
            <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
        ";

        $datum = date("d.m.Y");

        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, text FROM akce WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

				switch ($_GET["co"])
				{
          case "add":
  					$aed =
            "
            <form action=\"\" method=\"post\">
              <fieldset>
              <legend>Přidat novou akci</legend>
              <h3>Přidat novou akci</h3>
                <label for=\"label_input_datum\" title=\"DD.MM.RRRR\">Datum:</label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"datum\" value=\"{$datum}\" title=\"DD.MM.RRRR\" />
                {$this->FormatovaniTextu("label_input_text")}
                  <textarea id=\"label_input_text\" name=\"text\" cols=\"\" rows=\"\"></textarea>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat akci\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["text"]) &&
  							!Empty($_POST["datum"]))
  					{
  						$aed = $this->PridejAkci();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "edit":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
            <form action=\"\" method=\"post\">
              <fieldset>
              <legend>Upravit novou akci</legend>
              <h3>Upravit novou akci</h3>
                <label for=\"label_input_datum\" title=\"DD.MM.RRRR\">Datum:</label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"datum\" value=\"{$data->datum}\" title=\"DD.MM.RRRR\" />
                {$this->FormatovaniTextu("label_input_text")}
                  <textarea id=\"label_input_text\" name=\"text\" cols=\"\" rows=\"\">{$data->text}</textarea>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit akci\" />
              </fieldset>
            </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["text"]) &&
  								!Empty($_POST["datum"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravAkci($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat položku v přehledu akcí:
                </p>
                <p>
                  S textem:
                </p>
                <p>
                  <strong>{$data->text}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chcete smazat tuto položku v přehledu akcí ?</legend>
                <h3>Opravdu chcete smazat tuto položku v přehledu akcí ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazAkci($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání aktuality.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}

				$result .=
        "
          <div id=\"vypis_akci\">
            <div id=\"obal_vypis_akci\">
              <h3>Výpis přehledu akcí</h3>
              <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\" class=\"pridat_tl\" title=\"Přidat novou akci\"><span>Přidat novou akci</span></a>
            </div>
            {$aed}
            {$this->VypisAkceEditDel()}
          </div>
        </div>
        ";
			break;
			//************************************************************************
			case "kontakt":
        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, sekce, jmeno, telefon, email FROM kontakt WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

        if (!Empty($_POST["kontakt1"]) &&
            !Empty($_POST["kontakt2"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result .= $this->UpravTextyKontakt();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
        <div id=\"kontakt_sekce\">
          <h4>Panel: <em>Kontakt</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>
            {$this->FormatovaniTextu("styl_kontakt1")}
            <textarea name=\"kontakt1\" id=\"styl_kontakt1\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("kontakt1", true)}</textarea>
            {$this->FormatovaniTextu("styl_kontakt2")}
            <textarea name=\"kontakt2\" id=\"styl_kontakt2\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("kontakt2", true)}</textarea>
            {$this->FormatovaniTextu("styl_kontakt3")}
            <textarea name=\"kontakt3\" id=\"styl_kontakt3\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("kontakt3", true)}</textarea>
            <input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
        <span id=\"presun\"></span>
        ";
        //**********************************************************************
        switch ($_GET["co"])
				{
          case "add":
  					$aed =
            "
            <form class=\"pridani_form fotky\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Přidat kontakt</legend>
              <h3>Přidat kontakt</h3>
                <label for=\"label_input_sekce\">Název sekce:</label>
                  {$this->SekceKontakt()}
                <label for=\"label_input_alt\">Jméno:</label>
                  <input id=\"label_input_alt\" type=\"text\" name=\"jmeno\" />
                <label for=\"label_input_tel\">Telefon:</label>
                  <input id=\"label_input_tel\" type=\"text\" name=\"telefon\" />
                <label for=\"label_input_mail\">E-mail:</label>
                  <input id=\"label_input_mail\" type=\"text\" name=\"email\" onchange=\"kontrolaEmailu('styl_email');\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat kontakt\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["jmeno"]) &&
  							!Empty($_POST["telefon"]))
  					{
  						$aed = $this->PridejKontakt();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "edit":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
            <form class=\"pridani_form fotky\" action=\"\" method=\"post\">
              <fieldset>
              <legend>Upravit kontakt</legend>
              <h3>Upravit kontakt</h3>
                <label for=\"label_input_sekce\">Název sekce:</label>
                  {$this->SekceKontaktOznaceny($data->sekce)}
                <label for=\"label_input_alt\">Jméno:</label>
                  <input id=\"label_input_alt\" type=\"text\" name=\"jmeno\" value=\"{$data->jmeno}\"  />
                <label for=\"label_input_tel\">Telefon:</label>
                  <input id=\"label_input_tel\" type=\"text\" name=\"telefon\" value=\"{$data->telefon}\" />
                <label for=\"label_input_mail\">E-mail:</label>
                  <input id=\"label_input_mail\" type=\"text\" name=\"email\" value=\"{$data->email}\" onchange=\"kontrolaEmailu('styl_email');\" />
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit kontakt\" />
              </fieldset>
            </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["jmeno"]) &&
  								!Empty($_POST["telefon"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravKontakt($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat kontakt:
                </p>
                <p>
                  Se jménem:
                </p>
                <p>
                  <strong>{$data->jmeno}</strong>
                </p>
                <p>
                  S telefonem:
                </p>
                <p>
                  <strong>{$data->telefon}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\" class=\"pridani_form\">
                <fieldset>
                <legend>Opravdu chcete smazat tento kontakt ?</legend>
                <h3>Opravdu chcete smazat tento kontakt ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazKontakt($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání konatktu.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}

        $result .=
        "
        <div class=\"obal_pridat_kontakt\">
          <h2>Výpis kontaktů</h2>
          <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add#presun\" class=\"pridat_tl\" title=\"Přidat kontakt\"><span>Přidat kontakt</span></a>
        </div>
        {$aed}
        {$this->VypisKontaktyEditDel()}
        </div>
        ";
			break;
      //************************************************************************
			case "aktuality":  //2008-08-12 18:25:18 == Y-m-d H:i:s
				$datum = date("d.m.Y");

				$cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, text FROM aktuality WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

				switch ($_GET["co"])
				{
          case "add":
  					$aed =
            "
            <form action=\"\" method=\"post\">
              <fieldset>
              <legend>Přidat aktualitu</legend>
              <h3>Přidat aktualitu</h3>
                <label for=\"label_input_datum\" title=\"DD.MM.RRRR\">Datum:</label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"datum\" value=\"{$datum}\" title=\"DD.MM.RRRR\" />
                {$this->FormatovaniTextu("label_input_aktualita")}
                  <textarea id=\"label_input_aktualita\" name=\"aktualita\" cols=\"\" rows=\"\"></textarea>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_pridat\" name=\"tlacitko\" title=\"Přidat aktualitu\" />
              </fieldset>
            </form>
            ";

  					if (!Empty($_POST["tlacitko"]) &&
  							!Empty($_POST["aktualita"]) &&
  							!Empty($_POST["datum"]))
  					{
  						$aed = $this->PridejAktualitu();
  						$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  					}
				  break;

				  case "edit":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
            <form action=\"\" method=\"post\">
              <fieldset>
              <legend>Upravit aktualitu</legend>
              <h3>Upravit aktualitu</h3>
                <label for=\"label_input_datum\" title=\"DD.MM.RRRR\">Datum:</label>
                  <input id=\"label_input_datum\" type=\"text\" name=\"datum\" value=\"{$data->datum}\" title=\"DD.MM.RRRR\" />
                {$this->FormatovaniTextu("label_input_aktualita")}
                  <textarea id=\"label_input_aktualita\" name=\"aktualita\" cols=\"\" rows=\"\">{$data->text}</textarea>
                <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_upravit\" name=\"tlacitko\" title=\"Upravit aktualitu\" />
              </fieldset>
            </form>
              ";

  						if (!Empty($_POST["tlacitko"]) &&
  								!Empty($_POST["aktualita"]) &&
  								!Empty($_POST["datum"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->UpravAktualitu($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  					}
				  break;

				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat aktualitu:
                </p>
                <p>
                  S textem:
                </p>
                <p>
                  <strong>{$data->text}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chcete smazat tuto aktualitu ?</legend>
                <h3>Opravdu chcete smazat tuto aktualitu ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazAktualitu($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání aktuality.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}

				$result =
        "
        <div id=\"aktuality_sekce\">
          <h4>Panel: <em>Aktuality</em></h4>
        <div class=\"obal_pridat_odkaz\">
          <h2>Výpis aktualit</h2>
          <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\" class=\"pridat_tl\" title=\"Přidat novinku\"><span>Přidat novinku</span></a>
        </div>
        {$aed}
        {$this->VypisAktualitEditDel()}
        </div>
        ";
			break;
			//************************************************************************
			case "napiste":
        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, jmeno, prijmeni, ulice, mesto, psc, telefon, email, text FROM napiste WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

       	switch ($_GET["co"])
       	{
				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat příspěvek:
                </p>
                <p>
                  Se jménem odesílatele:
                </p>
                <p>
                  <strong>{$data->jmeno}</strong>
                </p>
                <p>
                  S příjmením odesílatele:
                </p>
                <p>
                  <strong>{$data->prijmeni}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chcete smazat tento příspěvek ?</legend>
                <h3>Opravdu chcete smazat tento příspěvek ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazNapis($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání aktuality.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}
        $result =
        "
        <div id=\"napiste_nam_sekce\">
          <h4>Panel: <em>Napište nám</em></h4>
        {$aed}
        {$this->VypisNapisDel()}
        </div>
        ";
			break;
			//************************************************************************
			case "forum":
        $cislo = $_GET["cislo"];
				settype($cislo, "integer");
        if (!Empty($cislo) && $cislo != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, jmeno, email, zprava FROM forum WHERE id={$cislo};"))
  				{
            $data = $res->fetch_object();
          }
            else
          {
            $this->ErrorMsg($this->var->mysqli->error);
          }
        }

       	switch ($_GET["co"])
       	{
				  case "del":
  					if (!Empty($cislo) && $cislo != 0)
  					{
  						$aed =
              "
              <div id=\"potvrzeni_smazat\">
                <p>
                  Chystáte se smazat příspěvek:
                </p>
                <p>
                  Se jménem odesílatele:
                </p>
                <p>
                  <strong>{$data->jmeno}</strong>
                </p>
                <p>
                  S emailem odesílatele:
                </p>
                <p>
                  <strong>{$data->email}</strong>
                </p>
                <p>
                  S datem:
                </p>
                <p>
                  <strong>{$data->datum}</strong>
                </p>
              </div>
              <form action=\"\" method=\"post\">
                <fieldset>
                <legend>Opravdu chcete smazat tento příspěvek ?</legend>
                <h3>Opravdu chcete smazat tento příspěvek ?</h3>
                  <input id=\"tlacitko_ok\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ano\" name=\"ano\" title=\"Ano\" />
                  <input id=\"tlacitko_no\" type=\"submit\" value=\"&nbsp;\" class=\"label_input_ne\" name=\"ne\" title=\"Ne\" />
                </fieldset>
              </form>
              ";

  						if (!Empty($_POST["ano"]) &&
  								$cislo != 0)
  						{
  							$aed = $this->SmazForum($cislo);
  							$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  						}
  							else
  						{
  							if (!Empty($_POST["ne"]))
  							{
  								$aed =
                  "
                  <div class=\"potvrzeni\">
                    <p>
                      Stornoval jsi smazání aktuality.
                    </p>
                    <p>
                      Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
                    </p>
                  </div>
                  ";
                  $this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
  							}
  						}
  					}
				  break;
				}
        $result =
        "
        <div id=\"forum_sekce\">
          <h4>Panel: <em>Fórum</em></h4>
        {$aed}
        {$this->VypisForumDel()}
        </div>
        ";
			break;
			//************************************************************************
			case "team":
        if (!Empty($_POST["team1"]) &&
            !Empty($_POST["tlacitko"]))
        {
          $result .= $this->UpravTextyTeam();
  				$this->AutoClick(1, "?action={$_GET["action"]}&amp;akce={$_GET["akce"]}");
        }

        $result .=
        "
        <div id=\"team_sekce\">
          <h4>Panel: <em>Team Moravia B</em></h4>
        <form method=\"post\" action=\"\">
          <fieldset>";

          for ($i = 1; $i <= 10; $i++)
          {
            $result .=
            "{$this->FormatovaniTextu("input_team{$i}")}
            <textarea name=\"team{$i}\" id=\"input_team{$i}\" cols=\"\" rows=\"\">{$this->VypisTextuSekce("team{$i}", true)}</textarea>
            ";
          }

          $result .=
          "<input type=\"submit\" name=\"tlacitko\" value=\"&nbsp;\" class=\"label_input_ulozit\" />
          </fieldset>
        </form>
        </div>
        ";
			break;
			//************************************************************************
      default:
        $result =
        "
        <div id=\"neotux\">
          <span id=\"tucnak\"></span>
          <div id=\"bublina\">
            <p>
              <em>Vítej</em>
            </p>
            <p>
              <em>V Administraci</em>
            </p>
            <p>
              Dnes je: {$this->var->den[Date("N")]}
            </p>
            <p>
              Datum: ".Date("j.n.y")."
            </p>
            <p id=\"cas\">
              Čas: ".Date("H.i.s")."
            </p>
          </div>
        </div>

        <h3 style=\"text-align: center; font: normal 14px Verdana, sans-serif; margin-left: 30px; margin-right: 30px;\">Administrace optimalizována pro IE7, FF2, FF3, Opera, Safari, a jiné <strong>moderní prohlížeče.</strong></h3>

        <p style=\"text-align: center; padding-top: 20px;\">
          <a href=\"https://admin.klenot.cz/mail/\" onclick=\"window.open(this.href); return false;\">Zkontrovat email <strong>fsc@fscbrno.cz</strong></a>
        </p>
        ";
      break;
    }

		return $result;
	}
//******************************************************************************
	function KontrolaLogin($jmeno, $heslo)
	{
		$login = array ("6342fd9364b41005acce71e244849183",	// radek
										"93f9a5d3507bbd81db94663fd09dc866",
										"48acfd8edd4b6009c8257490df01c717",	// martin
										"7c8c47575b1ff8a0a34e871a33b5954f",
                    "d502b713d6fec1729e945ed2f0326a4f", //pavel
                    "d2dc16049c146ca489c7406f290c242d"); //zápis loginů
		$poc = 0;

		for ($i = 0; $i < (count($login) - 1); $i++)
		{
			if ($jmeno == $login[$i] && $heslo == $login[$i + 1])
			{
				$poc++;
			}
		}

		if ($poc == 1)
		{
			$result = true;
		}
			else
		{
			$result = false;
		}

		return $result;
	}
//******************************************************************************
  function VypisAktualitTop5()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d/%m/%Y') as datum, text FROM aktuality ORDER BY aktuality.datum DESC LIMIT 0,5"))
    {
      $result =
      "<div id=\"aktuality_text\">";
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu
          $result .=
          "
          <p>
            {$data->datum} - <a href=\"#link{$data->id}\" onclick=\"AjaxStranka('aktuality', '');\" title=\"\">{$text}</a>
          </p>
          ";
        }
      }
        else
      {
        $result .= $this->EmptyLine();

      }
      $result .=
      "</div>";
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
	function VypisAktualit()
	{
    if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d/%m/%Y') as datum, text FROM aktuality ORDER BY aktuality.datum DESC"))
    {
      $result =
      "<div id=\"aktuality_obal_sekce\">
        <h2>Aktuality</h2>";
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu --- <a href=\"#link{$data->id}\" id=\"link{$data->id}\" title=\"\">{$text}</a> ---
          $result .=
          "
          <p id=\"link{$data->id}\">
            <span class=\"datum_aktuality\">{$data->datum}</span><span class=\"oddelovac_aktuality\">-</span><span class=\"text_aktuality\">{$text}</span>
          </p>
          ";
        }
      }
        else
      {
        $result .= $this->EmptyLine();

      }
      $result .=
      "</div>";

    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
	}
//******************************************************************************
	function VypisAktualitEditDel()
	{
		if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d/%m/%Y') as datum, text FROM aktuality ORDER BY aktuality.datum DESC"))
		{
			$poc = $res->num_rows;
			if ($poc != 0)
			{
  			for ($i = 0; $i < $poc; $i++)
  			{
  				$data = $res->fetch_object();
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu
  				$result .=
          "
          <div class=\"vypis_novinek\">
            <p class=\"datum\">
              {$data->datum}
            </p>
            <p class=\"text\">
              {$text}
            </p>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" class=\"smazat_tl\" title=\"Smazat aktualitu\"><span>Smazat aktualitu</span></a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$data->id}\" class=\"upravit_tl\" title=\"Upravit aktualitu\"><span>Upravit aktualitu</span></a>
          </div>
          ";
  			}
  			$result .=
        "<!-- spodek -->";
        }
          else
        {
          $result = $this->EmptyLine();
        }
  		}
  			else
  		{
  			$this->ErrorMsg($this->var->mysqli->error);
  		}

		return $result;
	}
//******************************************************************************
	function PridejAktualitu()
	{
    $aktualita = stripslashes(htmlspecialchars($_POST["aktualita"]));
		$datum = date("Y-m-d", strtotime($_POST["datum"]));

		if (@$this->var->mysqli->multi_query("INSERT INTO aktuality (id, datum, text) VALUES (NULL, '{$datum}', '{$aktualita}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána aktualita s textem:
        </p>
        <p>
          <em>{$aktualita}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
	}
//******************************************************************************
	function UpravAktualitu($id)
	{
		$aktualita = stripslashes(htmlspecialchars($_POST["aktualita"]));
		$datum = date("Y-m-d", strtotime($_POST["datum"]));

		@$this->var->mysqli->multi_query("UPDATE aktuality SET datum='{$datum}' WHERE id={$id};");
    @$this->var->mysqli->multi_query("UPDATE aktuality SET text='{$aktualita}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                Aktualita byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
	}
//******************************************************************************
	function SmazAktualitu($id)
	{
		if (@$this->var->mysqli->multi_query("DELETE FROM aktuality WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                Aktualita byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
	}
//******************************************************************************
  function VypisKontaktyFull()
  {
    if ($res = @$this->var->mysqli->query("SELECT sekce, jmeno, telefon, email FROM kontakt ORDER BY kontakt.sekce DESC, kontakt.jmeno ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        $s = 0;
        while ($data = $res->fetch_object())
        {
          $sek = $data->sekce;
          if ($sek != $sekce[$s - 1])
          {
            $sekce[$s] = $sek;
            $s++;
          }
          $psek[$i] = $sek;
          $jmeno[$i] = $data->jmeno;
          $telefon[$i] = $data->telefon;
          $email[$i] = $data->email;
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $pocsek = array_count_values($psek);  //spocitani polozek
    $k = 0;
    for ($i = 0; $i < count($pocsek); $i++)
    {
      $result .=
      "<p>
        <strong>
          {$this->var->hkontakt[$sekce[$i]]}
        </strong>
      </p>
      <table>
        <caption>{$this->var->hkontakt[$sekce[$i]]}</caption>
        <tbody>";

      for ($j = 0; $j < $pocsek[$sekce[$i]]; $j++)
      {

        $result .=
        "<tr ".(fmod($j, 2) == 0 ? "class=\"lichy\"" : "").">
          <th scope=\"row\">{$jmeno[$k]}</th>
          <td class=\"center\">{$telefon[$k]}</td>
          ".(!Empty($email[$k]) ? "<td><a href=\"mailto:{$email[$k]}\" title=\"{$email[$k]}\">{$email[$k]}</a></td>" : "<td class=\"center\">---</td>")."
        </tr>";
        $k++;
      }
      $result .=
      " </tbody>
      </table>";
    }

    return $result;
  }
//******************************************************************************
  function VypisKontaktySekce($sekce)
  {
    if ($res = @$this->var->mysqli->query("SELECT jmeno, telefon, email FROM kontakt WHERE sekce='{$sekce}' ORDER BY kontakt.jmeno ASC"))
    {
      $poc = $res->num_rows;
      if ($poc != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "<tr ".(fmod($i, 2) == 0 ? "class=\"lichy\"" : "").">
            <th scope=\"row\">{$data->jmeno}</th>
            <td class=\"center\">{$data->telefon}</td>
            ".(!Empty($data->email) ? "<td><a href=\"mailto:{$data->email}\" title=\"{$data->email}\">{$data->email}</a></td>" : "<td class=\"center\">---</td>")."
          </tr>";
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisKontaktyEditDel()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, sekce, jmeno, telefon, email FROM kontakt ORDER BY kontakt.sekce DESC, kontakt.jmeno ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        $s = 0;
        while ($data = $res->fetch_object())
        {
          $sek = $data->sekce;
          if ($sek != $sekce[$s - 1])
          {
            $sekce[$s] = $sek;
            $s++;
          }
          $psek[$i] = $sek;
          $jmeno[$i] = $data->jmeno;
          $telefon[$i] = $data->telefon;
          $email[$i] = $data->email;
          $id[$i] = $data->id;
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $pocsek = array_count_values($psek);  //spocitani polozek
    $k = 0;
    for ($i = 0; $i < count($pocsek); $i++)
    {
      $result .=
      "
      <span class=\"oddelovac\"></span>
      <table>
        <caption>{$this->var->hkontakt[$sekce[$i]]}</caption>
        <tbody>";

      for ($j = 0; $j < $pocsek[$sekce[$i]]; $j++)
      {

        $result .=
        "<tr ".(fmod($j, 2) == 0 ? "class=\"lichy\"" : "").">
          <th scope=\"row\">{$jmeno[$k]}</th>
          <td class=\"center\">| {$telefon[$k]} |</td>
          ".(!Empty($email[$k]) ? "<td><a href=\"mailto:{$email[$k]}\" title=\"{$email[$k]}\">{$email[$k]} </a> |</td>" : "<td class=\"center\">--- |</td>")."
          <td>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$id[$k]}#presun\" class=\"upravit_tl\" title=\"Upravit\"><span>Upravit</span></a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$id[$k]}#presun\" class=\"smazat_tl\" title=\"Smazat\"><span>Smazat</span></a>
          </td>
        </tr>";
        $k++;
      }
      $result .=
      " </tbody>
      </table>

      ";
    }

    return $result;
  }
/*
      <p>
        <strong>
          {$this->var->hkontakt[$sekce[$i]]}
        </strong>
      </p>
*/
//******************************************************************************
  function PridejKontakt()
  {
    $sekce = $_POST["sekcekontakt"];
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));

    if (@$this->var->mysqli->multi_query("INSERT INTO kontakt (id, sekce, jmeno, telefon, email) VALUES(NULL, '{$sekce}', '{$jmeno}', '{$telefon}', '{$email}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána kontakt s textem:
        </p>
        <p>
          <em>{$jmeno}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function UpravKontakt($id)
  {
    $sekce = stripslashes(htmlspecialchars($_POST["sekcekontakt"]));
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));

		@$this->var->mysqli->multi_query("UPDATE kontakt SET sekce='{$sekce}' WHERE id={$id};");
    @$this->var->mysqli->multi_query("UPDATE kontakt SET jmeno='{$jmeno}' WHERE id={$id};");
    @$this->var->mysqli->multi_query("UPDATE kontakt SET telefon='{$telefon}' WHERE id={$id};");
    @$this->var->mysqli->multi_query("UPDATE kontakt SET email='{$email}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                kontakt byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazKontakt($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM kontakt WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                kontakt byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function VypisHistorie()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, hlava, text FROM historie ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu
          $result .=
          "
          <p>
            <strong>
              {$data->hlava}
            </strong>
            - {$text}
          </p>
          ";
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisHistorieEditDel()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, hlava, text FROM historie ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu
          $result .=
          "
          <p class=\"polozka_historie\">
            <strong>
              {$data->hlava}
            </strong>
            - {$text}
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$data->id}\" class=\"upravit_tl\" title=\"Upravit tuto položku\">
              <span>Upravit tuto položku</span>
            </a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" class=\"smazat_tl\" title=\"Smazat tuto položku\">
              <span>Smazat tuto položku</span>
            </a>
          </p>
          <span class=\"oddelovac_historie\"></span>
          ";
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PridejHistorii()
  {
    $hlava = stripslashes(htmlspecialchars($_POST["hlava"]));
    $text = stripslashes(htmlspecialchars($_POST["text"]));

    if (@$this->var->mysqli->multi_query("INSERT INTO historie (id, hlava, text) VALUES(NULL, '{$hlava}', '{$text}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána historie s textem:
        </p>
        <p>
          <em>{$hlava}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function UpravHistorii($id)
  {
    $hlava = stripslashes(htmlspecialchars($_POST["hlava"]));
    $text = stripslashes(htmlspecialchars($_POST["text"]));

		@$this->var->mysqli->multi_query("UPDATE historie SET hlava='{$hlava}' WHERE id={$id};");
    @$this->var->mysqli->multi_query("UPDATE historie SET text='{$text}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                historie byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazHistorii($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM historie WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                historie byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function VypisAkce()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, text FROM akce ORDER BY akce.datum DESC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu
          $result .=
          "
          <p ".($i == 0 ? "class=\"prvni\"" : "").">
            <strong>
              {$data->datum} {$text}
            </strong>
          </p>
          ";
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisAkceEditDel()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, text FROM akce ORDER BY akce.datum DESC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);  //nahrazení textu
          $result .=
          "
          <p class=\"vypis_polozky_akce\">
            <strong>
              {$data->datum} {$text}
            </strong>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" class=\"smazat_tl\" title=\"Smazat\"><span>Smazat</span></a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$data->id}\" class=\"upravit_tl\" title=\"Upravit\"><span>Upravit</span></a>
          </p>
          ";
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
 // ".($i == 0 ? " class=\"prvni\"" : "")."
//******************************************************************************
  function PridejAkci()
  {
    $datum = date("Y-m-d", strtotime($_POST["datum"]));
    $text = stripslashes(htmlspecialchars($_POST["text"]));

    if (@$this->var->mysqli->multi_query("INSERT INTO akce (id, datum, text) VALUES(NULL, '{$datum}', '{$text}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána historie s textem:
        </p>
        <p>
          <em>{$datum}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function UpravAkci($id)
  {
    $datum = date("Y-m-d", strtotime($_POST["datum"]));
    $text = stripslashes(htmlspecialchars($_POST["text"]));

		@$this->var->mysqli->multi_query("UPDATE akce SET datum='{$datum}' WHERE id={$id};");
    @$this->var->mysqli->multi_query("UPDATE akce SET text='{$text}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                historie byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazAkci($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM akce WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                historie byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function VypisSekceFotoAdd()  //vypis sekci pri pridavani fotek
  {
    if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM fotosekce ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "<select name=\"sekcefoto\" id=\"label_input_sekce\">";

        while ($data = $res->fetch_object())
        {

          $result .=
          "<option value=\"{$data->id}\">{$data->nazev}</option>
          ";

        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisSekceFotoEdit($id)  //vypis sekci pri uprave fotek
  {
    if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM fotosekce ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "<select name=\"sekcefoto\" id=\"label_input_sekce\">";

        while ($data = $res->fetch_object())
        {

          $result .=
          "<option value=\"{$data->id}\" ".($id == $data->id ? "selected=\"selected\"" : "").">{$data->nazev}</option>
          ";

        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisSekceFotoEditDel()  //vypis sekci edit del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM fotosekce ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = $res->num_rows;
        while ($data = $res->fetch_object())
        {
          $i--;
          $result .=
          "
          <p ".($i == 0 ? "class=\"noborder\"" : "").">
            <strong>
              {$data->nazev}
            </strong>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=delsekce&amp;cislo={$data->id}\" class=\"smazat_tl\" title=\"Smazat sekci\"><span>Smazat sekci</span></a>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=editsekce&amp;cislo={$data->id}\" class=\"upravit_tl\" title=\"Upravit sekci\"><span>Upravit sekci</span></a>
          </p>
          ";
        }
      }
        else
      {
        $result = $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisSekceFoto() //vypis sekci ve strankach
  {
    if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM fotosekce ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <p>
            <a href=\"#\" onclick=\"AjaxStranka('fotogalerie', '{$data->id}');\" title=\"{$data->nazev}\">
              {$data->nazev}
            </a>
          </p>
          ";
        }
      }
        else
      {
        $result = $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PrvniSekceFoto() //vypis prvni sekce ve strankach
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotosekce ORDER BY id ASC LIMIT 0,1;"))
    {
      $result = $res->fetch_object()->id;
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PridejSekci()  //pridani sekce do fotogalerie
  {
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

    if (@$this->var->mysqli->multi_query("INSERT INTO fotosekce (id, nazev) VALUES(NULL, '{$nazev}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána sekce s textem:
        </p>
        <p>
          <em>{$nazev}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function UpravSekci($id)  //uprava sekce foto galerie
  {
    $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

		$this->var->mysqli->multi_query("UPDATE fotosekce SET nazev='{$nazev}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                sekce byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazSekci($id) //smazani sekce fotogalerie, obsahuje-li fotky smaze i ty
  {
    @$this->var->mysqli->multi_query("DELETE FROM fotosekce WHERE id={$id};");

    if ($res = @$this->var->mysqli->query("SELECT id FROM fotogalerie WHERE sekce={$id}"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          @$this->var->mysqli->multi_query("DELETE FROM fotomini WHERE id={$data->id};"); //doresit
          @$this->var->mysqli->multi_query("DELETE FROM fotofull WHERE id={$data->id};");
        }
      }
    }

    @$this->var->mysqli->multi_query("DELETE FROM fotogalerie WHERE sekce={$id};");

		$result =
    "
          <div class=\"potvrzeni\">
            <p>
              sekce byla smazána i s fotogalerie a s fotkami!
            </p>
            <p>
              Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
            </p>
          </div>
    ";

  	return $result;
  }
//******************************************************************************
  function DHTMLDiv($id, $sekce, $alt)
  {
    $result =
    "
    <div class=\"blok_obr_panel\">
      <div>
        <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=editfoto&amp;cislo={$id}\" title=\"Upravit\">Upravit</a>
        <p> - </p>
        <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=delfoto&amp;cislo={$id}\" title=\"Smazat\">Smazat</a>
      </div>
      <dl>
        <dt>Sekce:</dt>
        <dd>{$sekce}</dd>
      </dl>
      <dl>
        <dt>Popis:</dt>
        <dd>{$alt}</dd>
      </dl>
    </div>
    ";

    return $result;
  }
//******************************************************************************
  function VypisFotogalerieEditDel()  //vypis vsech fotek z fotogalerie
  {
    if ($res = @$this->var->mysqli->query("SELECT fotogalerie.id as id, fotosekce.nazev as fotosekce, altobrazek FROM fotogalerie, fotosekce WHERE fotogalerie.sekce=fotosekce.id ORDER BY fotogalerie.id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $id[$i] = $data->id;
          $alt[$i] = $data->altobrazek;
          $fotosekce[$i] = $data->fotosekce;
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $k = 0;
    for ($i = 0; $i < ceil($res->num_rows / 3); $i++)
    {
      $result .=
      "<div class=\"tri_polozky\">";
      for ($j = 0; $j < 3; $j++)
      {
        if (!Empty($id[$k]))
        {
          $result .=
          "
          <div title=\"{$alt[$k]}\" class=\"polozka_foto".($j == 2 ? " posledni" : "")."\">
           <img src=\"foto.php?action=mini&amp;id={$id[$k]}\" alt=\"{$alt[$k]}\" />
           <span>Po klapnutí na obrázek se zobrazí plný náhled</span>
           {$this->DHTMLDiv($id[$k], $fotosekce[$k], $alt[$k])}
          </div>
          ";
        }
        $k++;
      }
      $result .=
      "</div>
      ".(fmod($k, 3) == 0 ? "<span class=\"oddelovac\"></span>" : "");
    }

    return $result;
  }
//******************************************************************************
  function VypisFotogalerie() //vypis fototgalerie dle vyberu
  {
    $sekce = $_GET["akce"];
    settype($sekce, "integer");
    if (Empty($sekce) || $sekce == 0)
    {
      $sekce = $this->PrvniSekceFoto(); //ne vzdy bude prvni cislo 1
    }

    if ($res = @$this->var->mysqli->query("SELECT fotogalerie.id as id, altobrazek FROM fotogalerie, fotosekce WHERE fotogalerie.sekce=fotosekce.id AND fotogalerie.sekce={$sekce} ORDER BY fotogalerie.id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $id[$i] = $data->id;
          $alt[$i] = $data->altobrazek;
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $k = 0;
    for ($i = 0; $i < ceil($res->num_rows / 3); $i++)
    {
      $result .=
      "<div class=\"tri_polozky\">";
      for ($j = 0; $j < 3; $j++)
      {
        if (!Empty($id[$k]))
        {
          $result .=
          "<a href=\"foto.php?action=full&amp;id={$id[$k]}\" title=\"{$alt[$k]}\" rel=\"lightbox[roadtrip]\" ".($j == 2 ? "class=\"posledni\"" : "").">
           <img src=\"foto.php?action=mini&amp;id={$id[$k]}\" alt=\"{$alt[$k]}\" />
           <span>Po klapnutí na obrázek se zobrazí plný náhled</span>
          </a>
          ";
        }
        $k++;
      }
      $result .=
      "</div>
      ".(fmod($k, 3) == 0 ? "<span class=\"oddelovac\"></span>" : "");
    }

    return $result;
  }
//******************************************************************************
  function PridejFotku()  //pridani fotky do fotogalerie
  {
    $sekcefoto = $_POST["sekcefoto"];
    settype($sekcefoto, "integer");
    $altobrazek = stripslashes(htmlspecialchars($_POST["altobrazek"]));

		$a = explode(".", $_FILES["obrazek"]["name"]);
		$pripona = strtolower($a[count($a) - 1]);
		$size = $_FILES["obrazek"]["size"]; //velikost

    if (($pripona == "png" ||
        $pripona == "jpg") &&
        $size <= 524288)	//ještě asi omezit velikost
    {
      $nazev = $_FILES["obrazek"]["name"];
      $tmp = $_FILES["obrazek"]["tmp_name"];
      $typ = $_FILES["obrazek"]["type"];  //typ

      $this->ZmensiObrazek($tmp);

      $obr = $this->var->docasny;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $obr = $tmp;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      if (@$this->var->mysqli->multi_query("INSERT INTO fotogalerie (id, sekce, altobrazek) VALUES(NULL, {$sekcefoto}, '{$altobrazek}');"))
  		{
        $id = $this->var->mysqli->insert_id;  //nacte posledni vlozene id

        @$this->var->mysqli->multi_query("INSERT INTO fotomini (id, foto, typ) VALUES({$id}, '{$stream1}', '{$typ}');");
        @$this->var->mysqli->multi_query("INSERT INTO fotofull (id, foto, typ) VALUES({$id}, '{$stream2}', '{$typ}');");

  			$result =
        "
        <div class=\"potvrzeni\">
          <p>
            Byla přidána fotka s textem:
          </p>
          <p>
            <em>{$altobrazek}</em>
          </p>
          <p>
            Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
          </p>
        </div>
        ";
      }
        else
  		{
  			$this->ErrorMsg($this->var->mysqli->error);
  		}
    }
      else
    {
      $this->ErrorMsg("Nahrávání obrázku selhalo. <em>Obrázek nemá kompatibilní příponu</em>.");
    }

		return $result;
  }
//******************************************************************************
  function UpravFotku($id)  //uprava fotky, a to: altobrazku a sekce
  {
    $sekcefoto = $_POST["sekcefoto"];
    $altobrazek = stripslashes(htmlspecialchars($_POST["altobrazek"]));

		@$this->var->mysqli->multi_query("UPDATE fotogalerie SET altobrazek='{$altobrazek}' WHERE id={$id};");
		@$this->var->mysqli->multi_query("UPDATE fotogalerie SET sekce='{$sekcefoto}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                fotka byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazFotku($id) //smazani fotky
  {
    @$this->var->mysqli->multi_query("DELETE FROM fotogalerie WHERE id={$id};");
    @$this->var->mysqli->multi_query("DELETE FROM fotomini WHERE id={$id};");
    @$this->var->mysqli->multi_query("DELETE FROM fotofull WHERE id={$id};");

		$result =
    "
          <div class=\"potvrzeni\">
            <p>
              sekce byla smazána.
            </p>
            <p>
              Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
            </p>
          </div>
    ";

  	return $result;
  }
//******************************************************************************
  function VypisTreninkEditDel()  //vypis treninku v administraci
  {
    if ($res = @$this->var->mysqli->query("SELECT id, datum, trenink1, sucha, trenink2 FROM trenink ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 1;
        $result .= "<table>";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tbody>
          <tr".(fmod($i, 2) == 0 ? " class=\"lichy\"" : "").">
            ".(Empty($data->trenink1) && Empty($data->sucha) && Empty($data->trenink2) ?
            "<th scope=\"row\" colspan=\"4\" class=\"posledni\">{$data->datum}</th>" :
            "<th scope=\"row\">{$data->datum}</th>
            <td>| {$data->trenink1} |</td>
            <td>{$data->sucha} |</td>
            <td class=\"posledni\">{$data->trenink2} |</td>")."
            <td>
              <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo={$data->id}#presun\" class=\"upravit_tl\" title=\"Upravit\"><span>Upravit</span></a>
              <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}#presun\" class=\"smazat_tl\" title=\"Smazat\"><span>Smazat</span></a>
            </td>
          </tr>
          </tbody>
          ";
          $i++;
        }
        $result .= "</table>";
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisTrenink()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, datum, trenink1, sucha, trenink2 FROM trenink ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 1;
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr ".(fmod($i, 2) == 0 ? "class=\"lichy\"" : "").">
            ".(Empty($data->trenink1) && Empty($data->sucha) && Empty($data->trenink2) ?
            "<th scope=\"row\" colspan=\"4\" class=\"posledni\">{$data->datum}</th>" :
            "<th scope=\"row\">{$data->datum}</th>
            <td>{$data->trenink1}</td>
            <td>{$data->sucha}</td>
            <td class=\"posledni\">{$data->trenink2}</td>")."
          </tr>
          ";
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PridejTrenink()
  {
    $datum = stripslashes(htmlspecialchars($_POST["datum"]));
    $trenink1 = stripslashes(htmlspecialchars($_POST["trenink1"]));
    $sucha = stripslashes(htmlspecialchars($_POST["sucha"]));
    $trenink2 = stripslashes(htmlspecialchars($_POST["trenink2"]));

    if (@$this->var->mysqli->multi_query("INSERT INTO trenink (id, datum, trenink1, sucha, trenink2) VALUES(NULL, '{$datum}', '{$trenink1}', '{$sucha}', '{$trenink2}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána trenink s textem:
        </p>
        <p>
          <em>{$datum}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function UpravTrenink($id)
  {
    $datum = stripslashes(htmlspecialchars($_POST["datum"]));
    $trenink1 = stripslashes(htmlspecialchars($_POST["trenink1"]));
    $sucha = stripslashes(htmlspecialchars($_POST["sucha"]));
    $trenink2 = stripslashes(htmlspecialchars($_POST["trenink2"]));

		@$this->var->mysqli->multi_query("UPDATE trenink SET datum='{$datum}' WHERE id={$id};");
		@$this->var->mysqli->multi_query("UPDATE trenink SET trenink1='{$trenink1}' WHERE id={$id};");
		@$this->var->mysqli->multi_query("UPDATE trenink SET sucha='{$sucha}' WHERE id={$id};");
		@$this->var->mysqli->multi_query("UPDATE trenink SET trenink2='{$trenink2}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                trenink byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazTrenink($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM trenink WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                sekce byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function VypisTreninkPripravkaEditDel()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, datum, led, sucha FROM treninkpripravka ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 1;
        $result .= "<table>";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr ".(fmod($i, 2) == 0 ? "class=\"lichy\"" : "").">
            <th scope=\"row\">{$data->datum}</th>
            <td>| {$data->led} |</td>
            <td>{$data->sucha} |</td>
            <td>
              <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=editpripravka&amp;cislo={$data->id}#presun\" class=\"upravit_tl\" title=\"Upravit\"><span>Upravit</span></a>
              <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=delpripravka&amp;cislo={$data->id}#presun\" class=\"smazat_tl\" title=\"Smazat\"><span>Smazat</span></a>
            </td>
          </tr>
          ";
          $i++;
        }
        $result .= "</table>";
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisTreninkPripravka()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, datum, led, sucha FROM treninkpripravka ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 1;
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr ".(fmod($i, 2) == 0 ? "class=\"lichy\"" : "").">
            <th scope=\"row\">{$data->datum}</th>
            <td>{$data->led}</td>
            <td>{$data->sucha}</td>
          </tr>
          ";
          $i++;
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PridejTreninkPripravka()
  {
    $datum = stripslashes(htmlspecialchars($_POST["datum"]));
    $led = stripslashes(htmlspecialchars($_POST["led"]));
    $sucha = stripslashes(htmlspecialchars($_POST["sucha"]));

    if (@$this->var->mysqli->multi_query("INSERT INTO treninkpripravka (id, datum, led, sucha) VALUES(NULL, '{$datum}', '{$led}', '{$sucha}');"))
		{
			$result =
      "
      <div class=\"potvrzeni\">
        <p>
          Byla přidána trenink s textem:
        </p>
        <p>
          <em>{$datum}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function UpravTreninkPripravka($id)
  {
    $datum = stripslashes(htmlspecialchars($_POST["datum"]));
    $led = stripslashes(htmlspecialchars($_POST["led"]));
    $sucha = stripslashes(htmlspecialchars($_POST["sucha"]));

		@$this->var->mysqli->multi_query("UPDATE treninkpripravka SET datum='{$datum}' WHERE id={$id};");
		@$this->var->mysqli->multi_query("UPDATE treninkpripravka SET led='{$led}' WHERE id={$id};");
		@$this->var->mysqli->multi_query("UPDATE treninkpripravka SET sucha='{$sucha}' WHERE id={$id};");

		$result =
    "
            <div class=\"potvrzeni\">
              <p>
                trenink byla upravena.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
    ";

    return $result;
  }
//******************************************************************************
  function SmazTreninkPripravka($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM treninkpripravka WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                sekce byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function VypisNapisDel()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jmeno, prijmeni, ulice, mesto, psc, telefon, email, text FROM napiste ORDER BY id DESC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 1;
        $result .= "<table>";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr>
            <td>{$data->jmeno}, {$data->prijmeni}, {$data->ulice}, {$data->mesto}, {$data->psc}, {$data->telefon}, {$data->email}, {$data->text}</td>
            <td><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" class=\"smazat_tl\" title=\"Smazat\"><span>Smazat</span></a></td>
          </tr>
          ";
          $i++;
        }
        $result .= "</table>";
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PridejNapis($jmeno, $prijmeni, $ulice, $mesto, $psc, $telefon, $email, $text)
  {
    $jmeno = stripslashes(htmlspecialchars($jmeno));
    $prijmeni = stripslashes(htmlspecialchars($prijmeni));
    $ulice = stripslashes(htmlspecialchars($ulice));
    $mesto = stripslashes(htmlspecialchars($mesto));
    $psc = stripslashes(htmlspecialchars($psc));
    $telefon = stripslashes(htmlspecialchars($telefon));
    $email = stripslashes(htmlspecialchars($email));
    $text = stripslashes(htmlspecialchars($text));

    if (@$this->var->mysqli->multi_query("INSERT INTO napiste (id, jmeno, prijmeni, ulice, mesto, psc, telefon, email, text) VALUES(NULL, '{$jmeno}', '{$prijmeni}', '{$ulice}', '{$mesto}', '{$psc}', '{$telefon}', '{$email}', '{$text}');"))
		{
      $text =
			"
			Tato zpráva ti byla zaslána z tvého webu http://www.fscbrno.cz<br />
			<br />
			<strong>{$jmeno}</strong> ti poslal zprávu z formuláře na tvém webu.<br />
			<br />
			Formulář vyplnil následovně:<br />
			Jméno: <strong>{$jmeno}</strong><br />
			Příjmení: <strong>{$prijmeni}</strong><br />
			Ulice: <strong>{$ulice}</strong><br />
			Město: <strong>{$mesto}</strong><br />
			PSČ: <strong>{$psc}</strong><br />
			Telefon: <strong>{$telefon}</strong><br />
			E-mail: <strong>{$email}</strong><br />
			Datum: <strong>".(date("H:i:s d.m.Y"))."</strong><br />
			Zpráva: <strong>{$text}</strong><br />
			<br />
			Pro zobrazení zprávy klapni <a href=\"http://{$_SERVER["SERVER_NAME"]}/?action=administrace&amp;akce=napiste\" title=\"Pro zobrazení zprávy klapni zde\">zde</a>.
      ";

			$header = "{$this->var->hlavicky}\nFrom: {$email}\n";	//hlavicka

			if (!@mail($this->var->email, "Zpráva o příchodu zprávy z fscbrno.cz", $text, $header))  //zprava pro prijemce
			{
				$this->ErrorMsg("<em>E-mail nebyl odeslán</em>.");
			}

			$text =
			"potvrzení příchodu zprávy na http://www.fscbrno.cz";

			$header = "{$this->var->hlavicky}\n";	//hlavicka

			if (!@mail($email, "Zpráva o příchodu zprávy z fscbrno.cz", $text, $header)) //potvrzeni zpravy
			{
				$this->ErrorMsg("<em>E-mail nebyl odeslán</em>.");
			}
      //************************************************************************
      $result =
      "
      <div class=\"zpracovavam\"></div>
      {$this->var->chyba}
      ";
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
/*
      <div id=\"potvrzeni_ulozeno\">
        <p>
          Byla přidána napište nám s textem:
        </p>
        <p>
          <em>{$jmeno}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
*/
//******************************************************************************
  function SmazNapis($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM napiste WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                napis byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function VypisForum()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, jmeno, email, zprava FROM forum ORDER BY forum.datum DESC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <div class=\"prispevek\">
            <p class=\"datum\">
              {$data->datum}
            </p>
            <p class=\"oddelovac\">
              -
            </p>
            <p class=\"jmeno\">
              {$data->jmeno}
            </p>
            <p class=\"zprava\">
              {$data->zprava}
            </p>
          </div>
          ";
        }
      }
        else
      {
        //$result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisForumDel()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, DATE_FORMAT(datum, '%d.%m.%Y') as datum, DATE_FORMAT(datum, '%H:%i:%s') as cas, jmeno, email, zprava FROM forum ORDER BY forum.datum DESC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <div class=\"prispevek\">
            <p class=\"datum\">
              {$data->datum} {$data->cas}
            </p>
            <p class=\"oddelovac\">
              -
            </p>
            <p class=\"jmeno\">
              {$data->jmeno} {$data->email}
            </p>
            <p class=\"zprava\">
              {$data->zprava}
            </p>
            <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo={$data->id}\" class=\"smazat_tl\" title=\"Smazat\"><span>Smazat</span></a>
          </div>
          ";
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PridejForum($jmeno, $email, $zprava)
  {
    $jmeno = stripslashes(htmlspecialchars($jmeno));
    $email = stripslashes(htmlspecialchars($email));
    $zprava = stripslashes(htmlspecialchars($zprava));
    $datum = date("Y-m-d H:i:s");

    if (@$this->var->mysqli->multi_query("INSERT INTO forum (id, datum, jmeno, email, zprava) VALUES(NULL, '{$datum}', '{$jmeno}', '{$email}', '{$zprava}');"))
		{
      $text =
			"
			Tato zpráva ti byla zaslána z tvého webu http://www.fscbrno.cz<br />
			<br />
			<strong>{$jmeno}</strong> ti poslal zprávu z formuláře na tvém webu.<br />
			<br />
			Formulář vyplnil následovně:<br />
			E-mail: <strong>{$email}</strong><br />
			Datum: <strong>{$datum}</strong><br />
			Zpráva: <strong>{$zprava}</strong><br />
			<br />
			Pro zobrazení zprávy klapni <a href=\"http://{$_SERVER["SERVER_NAME"]}/?action=administrace&amp;akce=napiste\" title=\"Pro zobrazení zprávy klapni zde\">zde</a>.
      ";

			$header = "{$this->var->hlavicky}\nFrom: {$email}\n";	//hlavicka

			if (!@mail($this->var->email, "Zpráva o příchodu zprávy z fscbrno.cz", $text, $header))  //zprava pro prijemce
			{
				$this->ErrorMsg("<em>E-mail nebyl odeslán</em>.");
			}

			$text =
			"potvrzení příchodu zprávy na http://www.fscbrno.cz";

			$header = "{$this->var->hlavicky}\n";	//hlavicka

			if (!@mail($email, "Zpráva o příchodu zprávy z fscbrno.cz", $text, $header)) //potvrzeni zpravy
			{
				$this->ErrorMsg("<em>E-mail nebyl odeslán</em>.");
			}
      //************************************************************************
      $result =
      "{$this->var->chyba}
      <div class=\"zpracovavam\"></div>
      ";
/*
        <p>
          Byla přidána forum s textem:
        </p>
        <p>
          <em>{$jmeno}</em>
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
*/
		}
			else
		{
			$this->ErrorMsg($this->var->mysqli->error);
		}

		return $result;
  }
//******************************************************************************
  function SmazForum($id)
  {
    if (@$this->var->mysqli->multi_query("DELETE FROM forum WHERE id={$id};"))
		{
			$result =
      "
            <div class=\"potvrzeni\">
              <p>
                forum byla smazána.
              </p>
              <p>
                Pokračuj klapnutím <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"Pokračuj klapnutím zde\">zde</a>.
              </p>
            </div>
      ";
	  }
	  	else
	  {
			$this->ErrorMsg($this->var->mysqli->error);
		}

  	return $result;
  }
//******************************************************************************
  function Hledej($text)
  {
    if ($res = @$this->var->mysqli->query("SELECT text FROM texty WHERE (text LIKE ('%{$text}%')) ORDER BY text ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $text = str_replace($this->var->short, $this->var->long, $data->text);
          $result .=
          "
          {$text}<br />
          ";
        }
      }
        else
      {
        $result .= $this->EmptyLine();
      }
    }
     else
    {
      $this->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZmensiObrazek($stream)  //zmenší fotku na požadovany rozmer
  {
		$obr = getimagesize($stream);

		list ($w, $h, $t) = $obr;

    $newwidth = 150;
    $newheight = 200;

		$res = @imagecreatetruecolor($newwidth, $newheight);

		switch ($t)
		{
			case 2:	//jpg
				$source = @imagecreatefromjpeg($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagejpeg($res, $this->var->docasny);
			break;

			case 3:	//png
				$source = @imagecreatefrompng($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagepng($res, $this->var->docasny);
			break;
		}
		imagedestroy($res);
  }
//******************************************************************************
  function FormatovaniTextu($element)
  {
    $result =
     "
      <dl>
        <dd>
          <input class=\"label_input_url\" type=\"button\" title=\"Vloží odkaz\" value=\"&nbsp;\" onclick=\"VlozitDoTextu('$element', 0);\" />
        </dd>
        <dd>
          <input class=\"label_input_b\" type=\"button\" title=\"Tučné písmo\" value=\"&nbsp;\" onclick=\"VlozitDoTextu('$element', 1);\" />
        </dd>
        <dd>
          <input class=\"label_input_i\" type=\"button\" title=\"Kurzívé písmo\" value=\"&nbsp;\" onclick=\"VlozitDoTextu('$element', 2);\" />
        </dd>
        <dd>
          <input class=\"label_input_u\" type=\"button\" title=\"Podtržené písmo\" value=\"&nbsp;\" onclick=\"VlozitDoTextu('$element', 3);\" />
        </dd>
        <dd>
          <input class=\"label_input_email\" type=\"button\" title=\"Vloží e-mail\" value=\"&nbsp;\" onclick=\"VlozitDoTextu('$element', 4);\" />
        </dd>
        <dd>
          <input class=\"label_input_odstavec\" type=\"button\" title=\"Vloží odstavec\" value=\"&nbsp;\" onclick=\"VlozitDoTextu('$element', 5);\" />
        </dd>
      </dl>
        ";

    return $result;
  }
//******************************************************************************
	function ErrorMsg($chyba)
	{
    $this->var->chyba = "
    <div class=\"chyba_nenacteno\"></div>
    <div class=\"chyba\">
      <p>
        Vyskytla se chyba:
      </p>
      <p>
        {$chyba}
      </p>
    </div>
     ";
	}
//******************************************************************************
  function EmptyLine()
  {
    $result =
    "
      žádná položka
    ";

    return $result;
  }
//******************************************************************************
	var $start, $konec;
	function MeritCas() //funkce pro vrácení času
	{
	  $cas = explode(" ", microtime());
		$soucet = $cas[1] + $cas[0];

		return $soucet;
	}
//******************************************************************************
	function StartCas() //zapis začátku
	{
		$this->start = $this->MeritCas();
	}
//******************************************************************************
	function KonecCas() //zápis konce a finální vypis doby
	{
		$this->konec = $this->MeritCas();
		$presnost = 10000; //nastavená přesnost
		$cas = Abs((Round(($this->konec - $this->start) * $presnost)) / $presnost); //Abs, výpočet

    $result =
    "
      Stránka vygenerována za: {$cas} ms
    ";

    return $result;
	}
//******************************************************************************
}
?>
