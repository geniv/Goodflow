<?php

/**
 *
 * Blok dynamicky generovaneho obsahu eshopu
 *
 * public funkce:\n
 * construct: DynamicObsahEshop - hlavni konstruktor tridy\n
 * ObsahEshop() - hlavni vypis eshop obsahu\n
 * NakupniKosik() - hlavni vypis kosku a pruvodce\n
 * InfoKosik() - informacni panel kosiku\n
 * VyhledatPolozku() - formular pro vyhledavani\n
 * PridejSmazStranku() - funkce pridavana do externich modulu na propojeni stranek\n
 * SmazStranku() - funkce pro smazani polozek kdyz se maze z dynamickeho menu\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 * Title() - generovana hlavicka
 *
 */

class DynamicObsahEshop
{
  private $var;
  private $sqlite;
  private $dbname;// = ".dbdynobsaheshop.sqlite2";
  private $idmodul = "dynobsaheshop";  //id pro rozliseni modulu v adminu
  private $pathcest = "picture";
  private $dirpath;
  private $minidir = "mini";  //adresar miniatur
  private $fulldir = "full";  //adresar full obrazku
  private $oddtit = "/";  //odelovaci znak v title

  private $expuser = 30;  //dni expirace uzivatele

  private $defdph = 0; //% dph
  private $defhmo = "kg"; //jednotka vahy
  private $defmen = "Kč"; //jednotka meny
  private $pocet_sloupcu = 1; //pocet sloupcu
  private $strankovani = 6; //pocet radku

  private $prijemce_objednavky = "eshop@bslaguna.cz";  //seznam mailu odesilatelu
  private $predmet = "Objednávka z eshopu"; //predmet emailu
  private $odeslano = "Odesláno ke zpracování."; //hlaska pri uspesnem odeslani

  private $hlavicka_emaliu = "Content-type: text/html; charset=UTF-8";

  private $dodani = array(array("zpusob" => "Česká pošta (120,-)",
                                "cena" => "120"),

                          array("zpusob" => "PPL (120,-)",
                                "cena" => "120"),

                          array("zpusob" => "Bankovní převod – Česká pošta (90,-) ",
                                "cena" => "90"),

                          array("zpusob" => "Bankovní převod – PPL (90,-)",
                                "cena" => "90"),
                          );

  private $max_h_nahled = 135;  //px - vyska nahledu
  private $max_h_obrazek = 400; //px - vyska obrazku
  private $max_size = 3; //max 3MB upload obrazku

  private $sub_polozka = "pol";
  private $sub_buy = "buy";

  private $defsort = "a_cena";  //defaultni hodnoty pri vypisu
  private $defview = "obr";

  private $razeni = array("a_cena" => "cena ASC",
                          "de_cena" => "cena DESC",
                          "a_nazev" => "nazev ASC",
                          "de_nazev" => "nazev DESC",
                          "a_datum" => "publikace ASC",
                          "de_deatum" => "publikace DESC",
                          );

  private $zobrazeni = array ("obr" => "zobr1",
                              "tab" => "zobr2",
                              "fas" => "zobr3",
                              );

  private $textpodminek = //text obchodnich podminek
          " <strong>Všeobecné obchodní podmínky pro nákup v tomto internetovém obchodě</strong><br /><br />

            <h1>Obchodní podmínky</h1><br />
            <p>Obchodní podmínky internetového obchodu se řídí níže uvedeným nákupním řádem, jakož i platnou legislativou a obchodními zvyklostmi. Na veškeré nabízené zboží je poskytována plná záruka dle platných legislativních předpisů a dle záručních podmínek výrobce či dovozce.</p><br />

            <h1>Objednání zboží</h1><br />
            <p>Odesláním internetové objednávky vybraného zboží zákazník potvrzuje závaznost jeho objednávky, vyjadřuje souhlas s obchodními podmínkami a zároveň potvrzuje svou způsobilost k právním úkonům. Pokud zákazník při zadávání objednávky správně vyplní e-mailovou adresu, bude mu na ni doručena kopie objednávky jako potvrzení zapsání objednávky do objednávkového systému e-shopu.</p><br />
            <p>Objednávat zboží lze rovněž přímo e-mailem: eshop@bslaguna.cz </p><br />
            <p>Objednávka je vždy považována za závaznou pro obě strany, není-li dohodnuto jinak.</p><br />

            <h1>Storno objednávky</h1><br />
            <strong>Storno objednávky ze strany kupujícího</strong><br /><br />
            <p>Objednávku lze stornovat e-mailem, pokud je objednávka přijatá a zboží nebylo expedováno. V případě pozdějšího zrušení objednávky má prodejce nárok na náhradu škody, především prokazatelných nákladů spojených s expedicí zboží.</p><br />
            <strong>Storno objednávky ze strany prodávajícího</strong><br /><br />
            <p>Provozovatel internetového obchodu má právo stornovat objednávku nebo její část v případě, že se objednané zboží během vyřizování objednávky přestane vyrábět nebo dodávat na český trh, případně se výrazným způsobem změní jeho cena. O zrušení objednávky bude zákazník informován. Pokud již hodnotu objednaného zboží ve stornované objednávce uhradil, bude mu příslušná částka vrácena v nejbližším možném termínu.</p><br />

            <h1>Dodání zboží</h1><br />
            <p>Zboží uvedené jako skladem je standardně expedováno do 5-ti pracovních dnů. Ostatní nabízené zboží je převážné většině expedováno v rozmezí 5-14 dnů. U méně běžného nebo problematického zboží však tato lhůta nemůže být zaručena, neboť závisí na dalších distributorech a dovozcích. V případě nedostupnosti zboží nebo delší dodací lhůty může zákazník stornovat objednávku e-mailem bez jakýchkoli sankcí z naší strany.</p><br />

            <h1>Způsoby platby a doprava</h1><br />
            <p>Dobírka - Česká pošta 120,- Kč platba při obdržení zboží.</p><br />
            <p>Dobírka - PPL 120,- Kč platba při obdržení zboží.</p><br />
            <p>Bankovní převod – Česká pošta 90,- Kč zboží je zasláno po obdržení platby na účet. Pokyny k platbě Vám budou zaslány na e-mail.</p><br />
            <p>Bankovní převod – PPL 90,- Kč zboží je zasláno po obdržení platby na účet. Pokyny k platbě Vám budou zaslány na e-mail.</p><br />

            <h1>Záruka a reklamace</h1><br />
            <p>Veškeré nabízené zboží pochází od autorizovaných dovozců a oficiálních distributorů pro ČR, je standardní kvality a je na něj poskytována plná záruka dle platných legislativních předpisů a dle záručních podmínek výrobce.</p><br />

            <h1>Odstoupení od kupní smlouvy - vrácení zboží</h1><br />
            <p>U zboží nakoupeného prostřednictvím internetového obchodu má kupující podle Občanského zákoníku právo do 14 dnů od doručení zboží na jeho vrácení bez udání důvodu. Zboží nesmí být žádným způsobem poškozené, nést znaky používání či jinak znehodnocené a musí být zabalené v originálních obalech spolu s veškerým příslušenstvím. Ke zboží musí být přiloženy veškeré dokumenty a to včetně faktury a záručního listu. Následně bude zákazníkovi převedena příslušná částka, která bude snížena o poštovné a další prokazatelné náklady spojené především s expedicí.</p><br />

            <h1>Odpovědnost za správnost údajů</h1><br />
            <p>Informace na webových stránkách jsou zčásti přebírány od třetích stran a mohou obsahovat věcné a technické nepřesnosti či typografické chyby a mohou být aktualizovány bez předchozího upozornění. Prodejce tedy nemůže bezvýhradně garantovat správnost jejich obsahu.</p><br />
            <p>Prodejce nenese vůči jiné straně odpovědnost za škody, způsobené použitím informací z internetového obchodu nebo odkazovaných webových stránek, nebyli-li tyto informace na přání zákazníka následně písemně potvrzeny ze strany prodejce.</p>
          ";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);
    $this->dbname = $this->var->moduly[$index]["databaze"];

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace(); //instalace DB
    $this->StartSession();  //start Session
  }

/**
 *
 * Administracni menu
 *
 * @return admin menu
 */
  public function AdminMenu()
  {
    $result =
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">Úprava obsahu</a>";

    return $result;
  }

/**
 *
 * Obsah adminu
 *
 * @return obsah adminu
 */
  public function AdminObsah()
  {
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      switch ($_GET[$this->var->get_idmodul])
      {
        case $this->idmodul:  //id modul
          $result = $this->AdministraceEshopObsahu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Typova kontrola adresy
 *
 * @param adresa vstupni adresa
 * @return znovu prepsana adresa po typove kontrole
 */
  private function ValiditaAdresy($adresa)
  {
    $adr = explode("-", $adresa);

    $result = "";
    for ($i = 0; $i < count($adr); $i++)
    {
      settype($adr[$i], "integer");
      $result .= "{$adr[$i]}-";
    }
    $result = substr($result, 0, -1);

    return $result;
  }

/**
 *
 * Instalace SQLite databaze
 *
 */
  private function Instalace()
  {
    if (filesize("{$this->dirpath}/{$this->dbname}") == 0)
    {
      if (!@$this->sqlite->queryExec("CREATE TABLE obsah_eshop (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      nazev TEXT,
                                      vyrobce VARCHAR(200),
                                      popis TEXT,
                                      publikace DATE,
                                      kod VARCHAR(50),
                                      hmotnost FLOAT,
                                      dph FLOAT,
                                      cena FLOAT,
                                      obrazek VARCHAR(200),
                                      skladem INTEGER UNSIGNED);

                                      CREATE TABLE kosik (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      zakaznik INTEGER UNSIGNED,
                                      zbozi INTEGER UNSIGNED,
                                      pocet INTEGER UNSIGNED);

                                      CREATE TABLE zakaznik (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      session VARCHAR(100),
                                      expirace DATETIME,
                                      doprava INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Zjisti prvni polozku v databazi
 *
 * @return adresu prvni polozky
 */
  private function PrvniPolozka()
  {
    if ($res = @$this->sqlite->query("SELECT adresa FROM obsah_eshop ORDER BY LOWER(adresa) ASC LIMIT 0,1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->adresa;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Generovani samotneho eshop obsahu
 *
 * @return vygenerovany obsah
 */
  public function ObsahEshop()
  {
    $adresa = (!Empty($_GET[$this->var->get_kam]) ? $this->ValiditaAdresy($_GET[$this->var->get_kam]) : $this->PrvniPolozka());

    if (!Empty($_GET[$this->sub_polozka]))  //rozkliknuta polozka
    {
      $id = $_GET[$this->sub_polozka];
      settype($id, "integer");
      if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, vyrobce, popis, publikace,
                                        kod, hmotnost, dph, cena, skladem, obrazek
                                        FROM obsah_eshop WHERE id='{$id}';", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $data = $res->fetchObject();  //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
          $publikace = date("d.m. Y", strtotime($data->publikace));

          $result =
          "
            <div class=\"detail_polozky\">
                <h4>{$data->nazev}</h4>
                <a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}&amp;{$this->sub_buy}=add\">hodit do košíku</a><br />
                <img src=\"{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}\" alt=\"{$data->nazev}\" class=\"miniatura\" />
                <ul>
                <li>Dostupnost: {$data->vyrobce}</li>
                <li><table><tr><td>Popis:</td><td><p>{$data->popis}</p></td></tr></table></li>
<!--
                <li>Publikace: {$publikace}</li>
                <li>Kód: {$data->kod}</li>
                <li>DPH: {$data->dph}</li>
                <li>Skladem: {$data->skladem}</li>
                <li>Hmotnost: {$data->hmotnost} {$this->defhmo}</li>
-->
                <li class=\"cena\"><strong>Cena: {$data->cena} {$this->defmen}</strong></li>
                </ul><br />
                <img src=\"{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}\" alt=\"{$data->nazev}\" /><br />
            </div>
          ";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
      else
    {
      $sort = (!Empty($_GET["sort"]) && in_array($this->razeni[$_GET["sort"]], $this->razeni) ? $_GET["sort"] : $this->defsort);
      $view = (!Empty($_GET["view"]) && in_array($this->zobrazeni[$_GET["view"]], $this->zobrazeni) ? $_GET["view"] : $this->defview);
      $str = $_GET["str"];
      settype($str, "integer");

      $stankovani = $this->Strankovani($str, "?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort={$sort}&amp;view={$view}", $limit);

      //".($sort == "a_datum" ?
      //"<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort=de_datum&amp;view={$view}&amp;str={$str}\">datum sestupně</a>" :
      //"<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort=a_datum&amp;view={$view}&amp;str={$str}\">datum vzestupně</a>")."

      $result =  //hlavni vypis polozek, lze radit a prepinat zobrazeni
      "<p class=\"razeni_zobrazeni\"><strong>řadit podle:</strong>
      ".($sort == "a_cena" ?
      "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort=de_cena&amp;view={$view}&amp;str={$str}\">ceny sestupně</a>" :
      "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort=a_cena&amp;view={$view}&amp;str={$str}\">ceny vzestupně</a>")."

      ".($sort == "a_nazev" ?
      "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort=de_nazev&amp;view={$view}&amp;str={$str}\">název sestupně</a>" :
      "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort=a_nazev&amp;view={$view}&amp;str={$str}\">název vzestupně</a>")."

      <br />
      <strong>zobrazení:</strong>
      ".($view == "obr" ? "s obrázky" : "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort={$sort}&amp;view=obr&amp;str={$str}\">s obrázky</a>")."
      ".($view == "tab" ? "tabulkový" : "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort={$sort}&amp;view=tab&amp;str={$str}\">tabulkový</a>")."
      ".($view == "fas" ? "rychlý" : "<a href=\"?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort={$sort}&amp;view=fas&amp;str={$str}\">rychlý</a>")."
      </p>
      <br />
      {$stankovani}
      <br />
      ";
//?{$this->var->get_kam}={$_GET[$this->var->get_kam]}&amp;sort={$_GET["sort"]}&amp;view={$_GET["view"]}&amp;str={$_GET["str"]}
      if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, vyrobce, popis, publikace,
                                        kod, hmotnost, dph, cena, skladem, obrazek
                                        FROM obsah_eshop WHERE adresa='{$adresa}'
                                        ORDER BY {$this->razeni[$sort]},
                                        id ASC
                                        {$limit};", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $i = 0;
          while ($data = $res->fetchObject()) //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
          {
            $publikace = date("d.m. Y", strtotime($data->publikace));

            switch ($this->zobrazeni[$view])  //volba zobrazeni
            {
              case "zobr1": //obrazky
                $result .=
                "
                ".($i > 0 && ($i % $this->pocet_sloupcu) == 0 ? "<hr>" : "")."
                    <hr class=\"oddelovac\" />
                  <div class=\"zobrazeni_obrazky\">
                    <a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}\" title=\"\"><h4>{$data->nazev}</h4></a>
                    <a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}&amp;{$this->sub_buy}=add\">Přidat do košíku</a><br />
                    <a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}\" title=\"\"><img src=\"{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}\" alt=\"{$data->nazev}\" /></a>
                    <ul>
                    <li>Dostupnost: {$data->vyrobce}</li>
                    <li><table><tr><td>Popis:</td><td><p>{$data->popis}</p></td></tr></table></li>
<!--
                    <li>Hmotnost: {$data->hmotnost} {$this->defhmo}</li>
                    <li>DPH: {$data->dph}</li>
                    <li>Skladem: {$data->skladem}</li>
                    <li>Publikace: {$publikace}</li>
                    <li>Kód: {$data->kod}</li>
-->
                    <li class=\"cena\"><strong>Cena: {$data->cena} {$this->defmen}</strong></li>
                    </ul>
                  </div>
                  <br />
                ";
                $i++;
              break;

              case "zobr2": //tabulka
                $result .=
                "
                ".($i > 0 && ($i % $this->pocet_sloupcu) == 0 ? "<hr>" : "")."
                    <hr class=\"oddelovac\" />
                  <div class=\"zobrazeni_tabulka\"><ul>
                    <li><a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}\" title=\"\"><h4>{$data->nazev}</h4></a></li>
                    <li><a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}&amp;{$this->sub_buy}=add\">Přidat do košíku</a></li>
                    <li>Dostupnost: {$data->vyrobce}</li>
                    <li><table><tr><td>Popis:</td><td><p>{$data->popis}</p></td></tr></table></li>
<!--
                    <li>Publikace: {$publikace}</li>
                    <li>Skladem: {$data->skladem}</li>
-->
                    <li class=\"cena\"><strong>Cena: {$data->cena} {$this->defmen}</strong></li>
                    </ul>
                  </div>
                  <br />
                ";
                $i++;
              break;

              case "zobr3": //rychle
                $result .=
                "
                ".($i > 0 && ($i % $this->pocet_sloupcu) == 0 ? "<hr>" : "")."
                    <hr class=\"oddelovac\" />
                  <div class=\"zobrazeni_rychle\"><ul>
                    <li><a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}\" title=\"\"><h4>{$data->nazev}</h4></a></li>
                    <li><a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}&amp;{$this->sub_buy}=add\">Přidat do košíku</a></li>
                    <li>Dostupnost: {$data->vyrobce}</li>
                    <li class=\"cena\"><strong>Cena: {$data->cena} {$this->defmen}</strong></li>
<!--
                    <li>Skladem: {$data->skladem}</li>
-->
                    </ul>
                  </div>
                  <br />
                ";
                $i++;
              break;
            } //konec - volba zobrazeni
          }
        }
          else
        {
          $result = "<h6>Zadaná stránka neexistuje!</h6>";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    if (!Empty($_GET[$this->sub_buy])) //pridani polozky do kosiku, kdyz je neprazdny priznak kosiku
    {
      switch ($_GET[$this->sub_buy])
      {
        case "show":  //vypis kosiku
          $result = $this->NakupniKosik();
        break;

        case "add": //pridani polozky do kosiku
          $result = $this->PridejPolozku();
        break;

        case "krok": //krok objednavky
          $result =
          "<div class=\"soupis_obj\"><strong>Soupis objednávky</strong><br /><br />

          {$this->SoupisObjedvavky()}</div>

          <form method=\"post\">
            <fieldset>
              <p>
              <strong>jméno:</strong> <br /><input type=\"text\" name=\"jmeno\" /><br />
              </p>
              <p>
              <strong>ulice:</strong> <br /><input type=\"text\" name=\"ulice\" /><br />
              </p>
              <p>
              <strong>město:</strong> <br /><input type=\"text\" name=\"mesto\" /><br />
              </p>
              <p>
              <strong>psč:</strong>   <br /><input type=\"text\" name=\"psc\" /><br />
              </p>
              <p>
              <strong>email:</strong> <br /><input type=\"text\" name=\"email\" value=\"@\" /><br />
              </p>
              <p><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Potvrdit objednávku\" />
              </p>
            </fieldset>
          </form>

          <p class=\"kos\"><a href=\"?{$this->sub_buy}=show\">Zpět do košíku</a></p>";

          $jmeno = $_POST["jmeno"];
          $ulice = $_POST["ulice"];
          $mesto = $_POST["mesto"];
          $psc = $_POST["psc"];
          $email = $_POST["email"];

          if (!Empty($jmeno) &&
              !Empty($ulice) &&
              !Empty($mesto) &&
              !Empty($psc) &&
              !Empty($email))
          {

            $result =
            "<div class=\"soupis_obj\"><strong>Potvrzení objednávky</strong><br /><br />

            {$this->SoupisObjedvavky()}</div>

          <form method=\"post\">
            <fieldset>
              Jméno: {$jmeno}<br />
              Ulice: {$ulice}<br />
              Město: {$mesto}<br />
              Psč: {$psc}<br />
              Email: {$email}<br />

              <input type=\"hidden\" name=\"jmeno\" value=\"{$jmeno}\" />
              <input type=\"hidden\" name=\"ulice\" value=\"{$ulice}\" />
              <input type=\"hidden\" name=\"mesto\" value=\"{$mesto}\" />
              <input type=\"hidden\" name=\"psc\" value=\"{$psc}\" />
              <input type=\"hidden\" name=\"email\" value=\"{$email}\" /><br />
              <input type=\"submit\" name=\"tlacitko1\" value=\"Odeslat\" />
            </fieldset>
          </form>

           <p class=\"kos\">{$this->var->main[0]->OdkazZpet("Zpět na soupis objednávky")}</p>
            ";

            if (!Empty($_POST["tlacitko1"]))
            {
              $result =
              "
          <form method=\"post\">
            <fieldset>
              <input type=\"hidden\" name=\"jmeno\" value=\"{$jmeno}\" />
              <input type=\"hidden\" name=\"ulice\" value=\"{$ulice}\" />
              <input type=\"hidden\" name=\"mesto\" value=\"{$mesto}\" />
              <input type=\"hidden\" name=\"psc\" value=\"{$psc}\" />
              <input type=\"hidden\" name=\"email\" value=\"{$email}\" />
              <input type=\"hidden\" name=\"tlacitko1\" value=\"...\" />
              <p>
                {$this->textpodminek}
              </p><br /><br />
              <input type=\"checkbox\" name=\"souhlas\" value=\"true\" /> souhlasím<br /><br />
              <input type=\"submit\" name=\"tlacitko2\" value=\"Odeslat objednávku\" />
            </fieldset>
          </form>

          <p class=\"kos\">{$this->var->main[0]->OdkazZpet("Zpět na potvrzení objednávky")}</p>
              ";

              if (!Empty($_POST["tlacitko2"]) &&
                  $_POST["souhlas"] == "true")
              {
                $result = $this->OdeslatObjednavku($jmeno, $ulice, $mesto, $psc, $email);
              }
            }
          }
        break;
      }
    }

    if (!Empty($_GET["tlacitko"]))
    {
      $nazev = $_GET["nazev"];
      $result = "";
      if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, vyrobce, popis, publikace,
                                        kod, hmotnost, dph, cena, skladem, obrazek
                                        FROM obsah_eshop WHERE
                                        nazev LIKE(\"%{$nazev}%\") OR
                                        vyrobce LIKE(\"%{$nazev}%\") OR
                                        popis LIKE(\"%{$nazev}%\");", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          while ($data = $res->fetchObject())
          {
            $publikace = date("d.m. Y", strtotime($data->publikace));

            $result .=
            "
              <p>
                <h4>název: {$data->nazev}</h4>
                <a href=\"?{$this->var->get_kam}={$data->adresa}&amp;{$this->sub_polozka}={$data->id}&amp;{$this->sub_buy}=add\">hodit do košíku</a><br />
                <img src=\"{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}\" alt=\"{$data->nazev}\" />
                <ul>
                <li>Dostupnost: {$data->vyrobce}</li>
                <li><table><tr><td>Popis:</td><td><p>{$data->popis}</p></td></tr></table></li>
<!--
                <li>Publikace: {$publikace}</li>
                <li>Kód: {$data->kod}</li>
                <li>Hmotnost: {$data->hmotnost} {$this->defhmo}</li>
                <li>DPH: {$data->dph}</li>
-->
                <li>Cena celkem: {$data->cena} {$this->defmen}</li>
                <li>Skladem: {$data->skladem}</li>
                </ul>
              </p><br />
            ";
          }
        }
          else
        {
          $result = "<strong>žádný výsledek</strong>";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje title hlavicku
 *
 * @return title text
 */
  public function Title()
  {
    if (!Empty($_GET[$this->sub_polozka]))
    {
      $result = " {$this->oddtit} {$this->NazevPodleId($_GET[$this->sub_polozka])}";
    }

    if (!Empty($_GET[$this->sub_buy]))
    {
      switch ($_GET[$this->sub_buy])
      {
        case "show":
          $result = "košík";
        break;

        case "add":
          $result = "přidání položky";
        break;

        case "krok":
          $result = "průvodce objednávkou";
        break;
      }
    }

    return $result;
  }

  private function NazevPodleId($id)
  {
    settype($id, "integer");
    if ($res = @$this->sqlite->query("SELECT nazev
                                      FROM obsah_eshop WHERE
                                      id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->nazev;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Informacni lista kosiku
 *
 * @return vypis ceny a poctu polozek
 */
  public function InfoKosik()
  {
    $uzivatel = $this->IdUzivatele();
    if ($this->ExistujeUzivatel(session_id()) &&
        $this->PocetPolozekKosiku($uzivatel) != 0)
    {
      if ($res = @$this->sqlite->query("SELECT COUNT(kosik.id) as pocet,
                                        sum(obsah_eshop.cena * kosik.pocet) as cena
                                        FROM kosik, obsah_eshop
                                        WHERE kosik.zakaznik={$uzivatel} AND
                                        obsah_eshop.id=kosik.zbozi;", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $data = $res->fetchObject();
          $cenadoprava = $this->dodani[$this->IdDopravy($uzivatel)]["cena"];
          $cena = floor(((($data->cena + $cenadoprava) / 100) * $this->defdph) + ($data->cena + $cenadoprava));

          $result =
          "
            <strong><a href=\"?{$this->sub_buy}=show\">V košíku</a> máte {$data->pocet} položek za: {$cena} {$this->defmen}</strong>
          ";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
      else
    {
      $result = "<strong>košík neni při nulovém počtu k dispozici</strong>";
    }

    return $result;
  }

/**
 *
 * Samotny vypis nakupniho kosiku s pruvodcem
 *
 * @return vypis kosiku
 */
  public function NakupniKosik()
  {
    $uzivatel = $this->IdUzivatele();

    if ($this->ExistujeUzivatel(session_id()) &&
        $this->PocetPolozekKosiku($uzivatel) != 0)
    {
      $result =
      "<form method=\"post\">
            <fieldset>";
      if ($res = @$this->sqlite->query("SELECT
                                        kosik.id as id,
                                        obsah_eshop.nazev as zbozi,
                                        obsah_eshop.cena as cena,
                                        obsah_eshop.dph as dph,
                                        kosik.pocet as pocet
                                        FROM kosik, obsah_eshop
                                        WHERE kosik.zakaznik={$uzivatel} AND
                                        obsah_eshop.id=kosik.zbozi;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $sumsoucet = 0;
          while ($data = $res->fetchObject())
          {
            $soucet = floor($data->cena * $data->pocet);
            $cenarow = (($soucet / 100) * $data->dph) + $soucet;
            $sumsoucet += ($data->cena * $data->pocet);

            $pocet[$data->id] = $data->pocet;

            $result .=
            "
              <strong>{$data->zbozi}</strong><br /><br />
<!--              cena bez dph: {$data->cena} {$this->defmen}<br />
              dph: {$data->dph} %<br />
-->
              Počet: <input type=\"text\" value=\"{$data->pocet}\" size=\"2\" name=\"poc_{$data->id}\" /><br />
<!--              součet ceny bez dph: {$soucet} {$this->defmen}<br /> -->
              Cena: {$cenarow} {$this->defmen}<br /><br />
              <hr class=\"oddelovac\" /><br /><br />
            ";
          }

          $doprava = $this->IdDopravy($uzivatel);
          $cenadoprava = $this->dodani[$doprava]["cena"];
          $celkem = floor(((($sumsoucet + $cenadoprava) / 100) * $this->defdph) + ($sumsoucet + $cenadoprava));

          $result .=
          "
<!--            celkový součet bez dph: {$sumsoucet} {$this->defmen}<br /> -->
            Doprava: {$this->VypisDopravySelect($doprava)} {$cenadoprava} {$this->defmen}<br />
            Cena celkem: <strong>{$celkem} {$this->defmen}</strong><br />
            <br />
            <input type=\"submit\" value=\"Aktualizovat\" name=\"tlacitko\">
            </fieldset>
            </form>

            <p class=\"kos\"><a href=\"?{$this->sub_buy}=krok\">Pokračovat</a></p>

          ";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }

      if (!Empty($_POST["tlacitko"]))
      {
        $key = array_keys($pocet);  //ziskani hodnot ID
        for ($i = 0; $i < count($pocet); $i++)
        {
          $newpocet = explode("_", $_POST["poc_{$key[$i]}"]);
          $this->ZmenMnozstviPolozky($key[$i], $newpocet[0]);
        }

        $doprava = $_POST["doprava"];
        if (!@$this->sqlite->queryExec("UPDATE zakaznik SET doprava={$doprava} WHERE id={$uzivatel};", $error))
        {
          $this->var->main[0]->ErrorMsg($error);
        }

        $result =
        "uloženo..";

        $this->var->main[0]->AutoClick(1, "?{$this->sub_buy}=show");  //auto kliknuti
      }

    }
      else
    {
      $result = "není k dispozici vypis košíku";
    }

    return $result;
  }

/**
 *
 * Formular pro vyhledavani v DB, nastavuje pouze priznaky
 *
 * @return formular hledani
 */
  public function VyhledatPolozku()
  {
    $hlaska = "";//Zadejte výraz pro vyhledání
    $result =
    "
    <form class=\"vyhledavani\" method=\"get\">
      <fieldset>
        <input type=\"text\" name=\"nazev\" value=\"{$hlaska}\" onfocus=\"if(this.value == '{$hlaska}'){this.value='';}\" onblur=\"if(this.value == ''){this.value='{$hlaska}';}\" />
        <input type=\"submit\" name=\"tlacitko\" value=\"Hledat\" />
      </fieldset>
    </form>
    ";

    return $result;
  }

/**
 *
 * Zpracuje objednavku a odesle emailem
 *
 * @param jmeno - jmeno zakaznika
 * @param ulice - ulice zakaznika
 * @param mesto - mesto zakaznika
 * @param psc - psc zakaznika
 * @param email - email zakaznika
 * @return navratova zprava
 */
  private function OdeslatObjednavku($jmeno, $ulice, $mesto, $psc, $email)
  {
    if ($this->ExistujeUzivatel(session_id()))
    {
      $id = $this->IdUzivatele();

      $result = "";
      if ($res = @$this->sqlite->query("SELECT
                                        kosik.id as id,
                                        obsah_eshop.nazev as zbozi,
                                        obsah_eshop.cena as cena,
                                        obsah_eshop.dph as dph,
                                        kosik.pocet as pocet
                                        FROM kosik, obsah_eshop
                                        WHERE kosik.zakaznik={$id} AND
                                        obsah_eshop.id=kosik.zbozi;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $sumsoucet = 0;
          while ($data = $res->fetchObject())
          {
            $soucet = floor($data->cena * $data->pocet);
            $cenarow = (($soucet / 100) * $data->dph) + $soucet;
            $sumsoucet += ($data->cena * $data->pocet);

            // cena bez dph: {$data->cena} {$this->defmen}<br />
            // součet jednoho typu: {$soucet} {$this->defmen}<br />
            // dph: {$data->dph} %<br />

            $result .=
            "
              Název: {$data->zbozi}<br />
              Počet: {$data->pocet} x<br />
              Cena: {$cenarow} {$this->defmen}<br /><br />
            ";
          }

          $doprava = $this->IdDopravy($id);

          $cenadoprava = $this->dodani[$doprava]["cena"];
          $celkem = floor(((($sumsoucet + $cenadoprava) / 100) * $this->defdph) + ($sumsoucet + $cenadoprava));

          // celkový součet bez dph: {$sumsoucet} {$this->defmen}<br />

          $result .=
          "
            Doprava: {$this->dodani[$doprava]["zpusob"]} {$cenadoprava} {$this->defmen}<br />
            Cena celkem: {$celkem} {$this->defmen}<br /><br />

            Odeslat na adresu:<br />

            Jméno: <strong>{$jmeno}</strong><br />
            Ulice: <strong>{$ulice}</strong><br />
            Město: <strong>{$mesto}</strong><br />
            PSČ: <strong>{$psc}</strong><br />
            <br />
            Email uživatele: {$email}
          ";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }

      $header = "{$this->hlavicka_emaliu}\nFrom: {$email}\n";  //hlavicka
      $predmet = $this->predmet;

      $info = "";
      if (mail($this->prijemce_objednavky, $predmet, $result, $header))
      {
        if (mail($email, $predmet, $result, $header))
        {
          $info = $this->odeslano;  //kdyz se emal uspesne odesle

          //vyprazdneni kosku
          if (!@$this->sqlite->queryExec("DELETE FROM kosik WHERE zakaznik={$id};", $error))
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg("E-mail nebyl odeslán.");
      }
    }

    return $info;
  }

/**
 *
 * Vypisuje objenavku
 *
 * @return nypis objednavky k povrzeni
 */
  private function SoupisObjedvavky()
  {
    if ($this->ExistujeUzivatel(session_id()))
    {
      $id = $this->IdUzivatele();

      $result = "";
      if ($res = @$this->sqlite->query("SELECT
                                        kosik.id as id,
                                        obsah_eshop.nazev as zbozi,
                                        obsah_eshop.cena as cena,
                                        obsah_eshop.dph as dph,
                                        kosik.pocet as pocet
                                        FROM kosik, obsah_eshop
                                        WHERE kosik.zakaznik={$id} AND
                                        obsah_eshop.id=kosik.zbozi;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $sumsoucet = 0;
          while ($data = $res->fetchObject())
          {
            $soucet = floor($data->cena * $data->pocet);
            $cenarow = (($soucet / 100) * $data->dph) + $soucet;
            $sumsoucet += ($data->cena * $data->pocet);

            $result .=  //id: {$data->id}<br />
            "
              <strong>{$data->zbozi}</strong><br />
<!--              cena bez dph: {$data->cena} {$this->defmen}<br />
              dph: {$data->dph} %<br />
-->
              Počet: {$data->pocet} x<br />
<!--              součet jednoho typu: {$soucet} {$this->defmen}<br />-->
              Cena: {$cenarow} {$this->defmen}<br /><br />
              <hr class=\"oddelovac\" /><br />
            ";
          }

          $doprava = $this->IdDopravy($id);

          $cenadoprava = $this->dodani[$doprava]["cena"];
          $celkem = floor(((($sumsoucet + $cenadoprava) / 100) * $this->defdph) + ($sumsoucet + $cenadoprava));

          $result .=
          "
<!--            celkový součet bez dph: {$sumsoucet} {$this->defmen}<br /> -->
            Doprava: {$this->dodani[$doprava]["zpusob"]} ({$cenadoprava} {$this->defmen})<br />
            Cena celkem: {$celkem} {$this->defmen}<br /><br />
            <hr class=\"oddelovac\" /><br />
          ";
        }
          else
        {
          $result .= "<strong>uživatel nemá nic vybrané</strong>";
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    return $result;
  }

/**
 *
 * Informacni zprava o pridani zbozi
 *
 * @return info o pridani
 */
  private function PridejPolozku()
  {
    $id = $_GET["{$this->sub_polozka}"];
    settype($id, "integer");

    if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, vyrobce, popis, publikace,
                                      kod, hmotnost, dph, cena, skladem, obrazek
                                      FROM obsah_eshop WHERE id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $data = $res->fetchObject();  //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani

        $result = "přídáno do košíku: {$data->nazev}";

        $this->PridejPolozkuDoKosiku($data->id);

        $this->var->main[0]->AutoClick(5, "?{$this->var->get_kam}={$data->adresa}&{$this->sub_polozka}={$data->id}");  //auto kliknuti
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Startuje session
 *
 */
  private function StartSession() //aktvuje session promenne
  {
    session_name("SSID"); //nastaveni jmena session

    session_start();
  }

/**
 *
 * Overuje existenci uzivatele s danym ssid
 *
 * @param ssid session id uzivatele
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeUzivatel($ssid)
  {
    if ($res = @$this->sqlite->query("SELECT id FROM zakaznik WHERE session='{$ssid}';", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Zanese uzivatele (jeho ssid) do databaze pokud tam, jeste neni
 *
 */
  private function InicializujUzivatele()
  {
    $ssid = session_id();

    if (!$this->ExistujeUzivatel($ssid))
    {
      if (!@$this->sqlite->queryExec("INSERT INTO zakaznik (id, session, expirace, doprava) VALUES
                                      (NULL, '{$ssid}', strftime('%Y-%m-%d %H:%M:%S', 'now'), 0);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Vrati cislo uzivatele v DB zakaznik
 *
 * @return cislo uzivatele
 */
  private function IdUzivatele()
  {
    $ssid = session_id();
    $result = 0;

    if ($res = @$this->sqlite->query("SELECT id
                                      FROM zakaznik
                                      WHERE session='{$ssid}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Zjisti jestli polozka uzivatele je jiz v kosiku
 *
 * @param id cislo polozky
 * @return true/false - existuje / neexistuje
 */
  private function ExistujePolozka($id)
  {
    settype($id, "integer");
    $user = $this->IdUzivatele();

    if ($res = @$this->sqlite->query("SELECT id FROM kosik WHERE zbozi={$id} AND zakaznik={$user};", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Inkrementuje pocet polozek daneho typu v databazi
 *
 * @param id id polozky
 */
  private function PridejMnozstviPolozky($id)
  {
    if ($this->ExistujeUzivatel(session_id()))
    {
      settype($id, "integer");
      $user = $this->IdUzivatele();

      if ($res = @$this->sqlite->query("SELECT id, pocet FROM kosik WHERE zbozi={$id} AND zakaznik={$user};", NULL, $error))
      {
        if ($res->numRows() == 1)
        {
          $data = $res->fetchObject();
          $idkosik = $data->id;
          $pocet = $data->pocet;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }

      $pocet += 1;  //inkrementace

      if (!@$this->sqlite->queryExec("UPDATE kosik SET pocet={$pocet} WHERE id={$idkosik};", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Zmeni pocet polozek daneho typu v databazi, smaze nebo upravi
 *
 * @param id id polozky
 * @param pocet nova hodnota poctu
 */
  private function ZmenMnozstviPolozky($id, $pocet)
  {
    if ($this->ExistujeUzivatel(session_id()))
    {
      settype($id, "integer");
      settype($pocet, "integer");

      if ($pocet == 0)
      {
        if (!@$this->sqlite->queryExec("DELETE FROM kosik WHERE id={$id};", $error))
        {
          $this->var->main[0]->ErrorMsg($error);
        }
      }
        else
      {
        if (!@$this->sqlite->queryExec("UPDATE kosik SET pocet={$pocet} WHERE id={$id};", $error))
        {
          $this->var->main[0]->ErrorMsg($error);
        }
      }

    }
  }

/**
 *
 * Prida polozku do tabulky kosik
 *
 * @param id id zbozi
 */
  private function PridejPolozkuDoKosiku($id)
  {
    settype($id, "integer");
    $this->InicializujUzivatele();  //inicializece

    $uzivatel = $this->IdUzivatele();

    $ssid = session_id();

    if (!$this->ExistujePolozka($id))
    {
      if (!@$this->sqlite->queryExec("INSERT INTO kosik (id, zakaznik, zbozi, pocet) VALUES
                                      (NULL, {$uzivatel}, {$id}, 1);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
      else
    {
      $this->PridejMnozstviPolozky($id);
    }
  }

/**
 *
 * Vrati pocet polozek v databazi
 *
 * @return pocet polozek
 */
  private function PocetPolozekKosiku($id)
  {
    settype($id, "integer");

    if ($res = @$this->sqlite->query("SELECT id
                                      FROM kosik
                                      WHERE zakaznik={$id};", NULL, $error))
    {
      $result = $res->numRows();
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vypis uziavatelu v databazi
 *
 * @return vypis uzivatelu
 */
  private function VypisUzivatelu()
  {
    $result =
    "<div class=\"soupis_obj\">
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\"><strong>Uprava obsahu</strong></a><br /><br />
    Výpis uživatelů:<br /><br />
    ";
/*
                                      SELECT zakaznik.id as id,
                                      zakaznik.session as session,
                                      zakaznik.expirace as expirace,
                                      count(kosik.id) as pocet,
                                      sum(obsah_eshop.cena * kosik.pocet) as cena,
                                      zakaznik.doprava as doprava
                                      FROM zakaznik, kosik, obsah_eshop
                                      WHERE
                                      kosik.zakaznik=zakaznik.id AND
                                      kosik.zbozi=obsah_eshop.id
                                      GROUP BY zakaznik.session
                                      ORDER BY zakaznik.id ASC;
*/

    if ($res = @$this->sqlite->query("SELECT id,
                                      session,
                                      expirace
                                      FROM zakaznik
                                      ORDER BY zakaznik.id ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject()) //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
        {
          //$expirace = date("d.m. Y", strtotime($data->expirace));
          $dat = strtotime($data->expirace);
          $datum = date("Y-m-d", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) + $this->expuser, date("Y", $dat)));  //expirace
          $expdate = date("d.m. Y", strtotime($datum)); //uprava data do pekneho formatu

          $cenadoprava = $this->dodani[$data->doprava]["cena"];
          $celkem = floor((($data->cena + $cenadoprava) / 100) * $this->defdph) + ($data->cena + $cenadoprava);

          $result .=
          "
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=infouser&amp;id={$data->id}\">{$data->session}</a><br />
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=clearbuy&amp;id={$data->id}\"
              onclick=\"return confirm('Opravdu vyprázdnit košík: \'{$data->session}\' ?');\">vyprazdni mu košík</a>
              vyprší dne: {$expdate}
            <br /><br />
          ";

          if (date("Y-m-d") > $datum) //smaze po necnosti N dni
          {
            if (!@$this->sqlite->queryExec("DELETE FROM zakaznik WHERE id={$data->id};
                                            DELETE FROM kosik WHERE zakaznik={$data->id};", $error))
            {
              $this->var->main[0]->ErrorMsg($error);
            }
          }
        }
      }
        else
      {
        $result .= "<strong>žádní uživatelé</strong>";
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $result.="</div>";
    return $result;
  }

/**
 *
 * Zjisteni typu dopravy daneho uzivatele
 *
 * @param id id uzivatele
 * @return id dopravy
 */
  private function IdDopravy($id)
  {
    settype($id, "integer");
    if ($res = @$this->sqlite->query("SELECT doprava
                                      FROM zakaznik
                                      WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->doprava;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vyber dopravy k uzivateli
 *
 * @return select pro vyber dopravy
 */
  private function VypisDopravySelect($id)
  {
    settype($id, "integer");

    $result =
    "<select name=\"doprava\">";
    for ($i = 0; $i < count($this->dodani); $i++)
    {
      $result .=
      "
        <option value=\"{$i}\"".($id == $i ? " selected=\"selected\"" : "").">{$this->dodani[$i]["zpusob"]}</option>
      ";
    }
    $result .=
    "</select>";

    return $result;
  }

/**
 *
 * Externi odkaz do dalsich modulu, kontroluje se s existenci adresy v DB
 *
 * @param cesta cesta k obsahu
 * @return odkaz nebo zprava
 */
  public function PridejSmazStranku($cesta)
  {
    $result = "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;adresa={$cesta}\">přidat obsah</a>";

    return $result;
  }

/**
 *
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SynchronizaceSouboruDB()
  {
    if ($res = @$this->sqlite->query("SELECT obrazek FROM obsah_eshop", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $i = 0;
        while ($data = $res->fetchObject()) //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
        {
          $databaze[$i] = $data->obrazek;
          $i++; //inkrementace
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathcest}/{$this->minidir}";  //projiti miniatur
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $mini[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathcest}/{$this->fulldir}";  //projiti plnych velikosti
    $handle = opendir($cesta);
    while($soub = readdir($handle))
    {
      if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
      {
        $full[$j] = $soub;  //nacitani souboru
        $j++;
      }
    }
    closedir($handle);

    $pocet1 = 0;
    if (count($databaze) != 0 &&  //mini
        count($mini) != 0)
    {
      $diff = array_diff($mini, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet1 = count($diff);

      for ($i = 0; $i < $pocet1; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$diff[$i]}");
      }
    }

    $pocet2 = 0;
    if (count($databaze) != 0 &&  //full
        count($full) != 0)
    {
      $diff = array_diff($full, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet2 = count($diff);

      for ($i = 0; $i < $pocet2; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$diff[$i]}");
      }
    }

    $result = $pocet1 + $pocet2;

    return $result;
  }

/**
 *
 * Smaze polozky na dane strance
 *
 * @param cesta adresa na rozlseni cesty do databaze
 */
  public function SmazStranku($cesta)
  {
    $cesta = $this->ValiditaAdresy($cesta);

    if ($res = @$this->sqlite->query("SELECT obrazek
                                      FROM obsah_eshop WHERE adresa='{$cesta}';", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject()) //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
        {
          if (file_exists("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}"))
          {
            chmod("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}", 0777);
            @unlink("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}");
          }

          if (file_exists("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}"))
          {
            chmod("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}", 0777);
            @unlink("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}");
          }
        }

        if (!@$this->sqlite->queryExec("DELETE FROM obsah_eshop WHERE adresa='{$cesta}';", $error)) //provedeni dotazu
        {
          $this->var->main[0]->ErrorMsg($error);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }
  }

/**
 *
 * Overeni existence odkazu
 *
 * @param cesta ceska k obsahu
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeOdkaz($cesta)
  {
    $adresa = $this->ValiditaAdresy($cesta);

    if ($res = @$this->sqlite->query("SELECT id FROM obsah_eshop WHERE adresa='{$adresa}';", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vygenerovani nazvu pro obrazky
 *
 * @param adresa adresa je zahrnuta ve vzorku nazvu
 * @return vygenerovany vzorek nazvu
 */
  private function VytvorJmenoObrazku($adresa)
  {
    $nahoda = "";
    for ($i = 0; $i < 5; $i++)
    {
      $nahoda .= rand(10, 5000);
    }

    $result = "{$adresa}_{$nahoda}";

    return $result;
  }

/**
 *
 * Zpracovani obrazku
 *
 * @return true/false - poledlo se / nepovedlo se
 */
  private function ZpracujObrazek($adresa, $tmp, &$obrazek)
  {
    list($old_w, $old_h) = getimagesize($tmp["tmp_name"]);

    if ($old_h <= $this->max_h_nahled)  //je-li mensi tak se zanecha
    {
      $new_w = $old_w;
      $new_h = $old_h;
    }
      else
    {
      $new_w = round($old_w / ($old_h / $this->max_h_nahled)); //vypocet sirky
      $new_h = $this->max_h_nahled;
    }

    if ($old_h <= $this->max_h_obrazek)  //je-li mensi tak se zanecha
    {
      $new_w_obr = $old_w;
      $new_h_obr = $old_h;
    }
      else
    {
      $new_w_obr = round($old_w / ($old_h / $this->max_h_obrazek)); //vypocet sirky
      $new_h_obr = $this->max_h_obrazek;
    }

    if ($tmp["size"] < (1024 * 1024 * $this->max_size))
    {
      $nazev = $this->VytvorJmenoObrazku($adresa);

      switch ($tmp["type"])
      {
        case "image/jpeg":
          $img_old = imagecreatefromjpeg($tmp["tmp_name"]);

          $img_new = imagecreatetruecolor($new_w, $new_h);
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$nazev}.jpg", 100);
          imagedestroy($img_new);

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$nazev}.jpg", 100);
          imagedestroy($img_new);

          $result = true;
          $pripona = "jpg";
        break;

        case "image/png":
          $img_old = imagecreatefrompng($tmp["tmp_name"]);

          $img_new = imagecreatetruecolor($new_w, $new_h);
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$nazev}.png");
          imagedestroy($img_new);

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$nazev}.png");
          imagedestroy($img_new);

          $result = true;
          $pripona = "png";
        break;

        default:
          $result = false;
        break;
      }
    }
      else
    {
      $result = false;
    }

    $obrazek = "{$nazev}.{$pripona}";

    return $result;
  }

/**
 *
 * Vrati aktualni pocet uzivatelu v databazi
 *
 * @return pocet uzivatelu
 */
  private function PocetUzvatelu()
  {
    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id
                                      FROM zakaznik;", NULL, $error))
    {
      $result = $res->numRows();
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vypis jiz stavajicich adres
 *
 * @return vypis skupny adres
 */
  private function VypisSkupiny()
  {
    $result =
    "";


    if ($res = @$this->sqlite->query("SELECT
                                      adresa,
                                      count(adresa) as poc
                                      FROM obsah_eshop
                                      GROUP BY adresa
                                      ORDER BY LOWER(adresa) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject()) //pripadne prepisovac specialni syntaxe a v editoru ajax zobrazovani
        {
          $adr = explode("-", $data->adresa);
          $nazev = $this->var->main[0]->NactiFunkci(1, "NazevPodleAdresy", $adr[count($adr) - 1]);

          $result .=
          "
            <strong>{$nazev}</strong> ({$data->poc}x)
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;adresa={$data->adresa}\">přidat obsah</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgrup&amp;grup={$data->adresa}\" title=\"\" onclick=\"return confirm('Opravdu smazat skupnu adres: \'{$data->adresa}\' ?');\">smazat skupinu</a><br />
          ";
        }
      }
        else
      {
        $result = "žádné skupiny";
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho eshop obsahu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceEshopObsahu()
  {
    $result =
    "<div class=\"soupis_obj\"><strong>Úprava obsahu</strong><br /><br />
    {$this->VypisSkupiny()}
    {$this->AdminVypisEshopObsahu()}<br />";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result =
          "
          <form method=\"post\" enctype=\"multipart/form-data\">
            <fieldset>
              <p><strong>název:</strong><br/> <input name=\"nazev\" />*</p><br />
              <p><strong>dostupnost:</strong><br/> <input type=\"input\" name=\"vyrobce\" /></p><br />
              <p><strong>popis:</strong><br/> <textarea name=\"popis\" rows=\"5\"></textarea>*</p><br />
<!--              <p><strong>publikace:</strong><br/> <input type=\"input\" name=\"publikace\" value=\"".date("j.n. Y")."\" /></p><br />
              <p><strong>kód:</strong><br/> <input type=\"input\" name=\"kod\" /></p><br />
              <p><strong>hmotnost:</strong><br/> <input type=\"input\" name=\"hmotnost\" /> {$this->defhmo}</p><br />
              <p><strong>dph:</strong><br/> <input type=\"input\" name=\"dph\" value=\"0\" /> %</p> -->
              <p><strong>cena:</strong><br/> <input type=\"input\" name=\"cena\" /> {$this->defmen}</p><br />
              <p><strong>obrázek:</strong><br/> <input type=\"file\" name=\"obrazek\" /></p><br /><br />
<!--              <p><strong>skladem:</strong><br/> <input type=\"input\" name=\"skladem\" /> ks</p>-->
              <p><input type=\"submit\" name=\"tlacitko\" value=\"Přidat\" /></p>
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $vyrobce = stripslashes(htmlspecialchars($_POST["vyrobce"], ENT_QUOTES));
          $popis = stripslashes(htmlspecialchars($_POST["popis"], ENT_QUOTES));
          $publikace = date("Y-m-d H:i:s", strtotime($_POST["publikace"]));
          $kod = stripslashes(htmlspecialchars($_POST["kod"], ENT_QUOTES));
          $hmotnost = $_POST["hmotnost"];
          settype($hmotnost, "float");

          $dph = $_POST["dph"];
          settype($dph, "float");

          $cena = $_POST["cena"];
          settype($cena, "float");

          $skladem = $_POST["skladem"];
          settype($skladem, "integer");

          $adresa = stripslashes(htmlspecialchars($_GET["adresa"], ENT_QUOTES));

          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $this->ZpracujObrazek($adresa, $_FILES["obrazek"], $obrazek);
          }
            else
          {
            $obrazek = NULL;
          }

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($popis))
          {
            if (@$this->sqlite->queryExec("INSERT INTO obsah_eshop (id, adresa, nazev, vyrobce, popis, publikace, kod, hmotnost, dph, cena, obrazek, skladem) VALUES
                                          (NULL, '{$adresa}', '{$nazev}', '{$vyrobce}', '{$popis}', '{$publikace}', '{$kod}', {$hmotnost}, {$dph}, {$cena}, '{$obrazek}', {$skladem});
                                          ", $error))
            {
              $result =
              "
                přídán obsah: {$nazev} do adresy: {$adresa}
              ";
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //uprava
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, nazev, vyrobce, popis, publikace, kod, hmotnost, dph, cena, obrazek, skladem FROM obsah_eshop WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                  <p><strong>název:</strong><br /> <input name=\"nazev\" class=\"inp\" value=\"{$data->nazev}\" />*</p><br />
                  <p><strong>dostupnost:</strong><br /> <input type=\"input\" name=\"vyrobce\" class=\"inp\" value=\"{$data->vyrobce}\" /></p><br />
                  <p><strong>popis:</strong><br /> <textarea name=\"popis\" class=\"inp\" rows=\"5\">{$data->popis}</textarea>*</p><br />
<!--                  <p><strong>publikace:</strong><br /> <input type=\"input\" class=\"inp\" name=\"publikace\" value=\"{$data->publikace}\" /></p><br />
                  <p><strong>kód:</strong><br /> <input type=\"input\" name=\"kod\" class=\"inp\" value=\"{$data->kod}\" /></p><br />
                  <p><strong>hmotnost:</strong><br /> <input type=\"input\" name=\"hmotnost\" class=\"inp\" value=\"{$data->hmotnost}\" /> {$this->defhmo}</p><br />
                  <p><strong>dph:</strong><br /> <input type=\"input\" name=\"dph\" class=\"inp\" value=\"0\" /> %</p><br />
-->
                  <p><strong>cena:</strong><br /> <input type=\"input\" name=\"cena\" class=\"inp\" value=\"{$data->cena}\" /> {$this->defmen}</p><br />
                  <p><img src=\"{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}\" alt=\"{$data->nazev}\" /></p><br />
                  <p><strong>obrázek:</strong><br /> <input class=\"inp\" type=\"file\" name=\"obrazek\" /></p><br />
<!--                  <p><strong>skladem:</strong><br /> <input type=\"input\" class=\"inp\" name=\"skladem\" value=\"{$data->skladem}\" /></p><br />-->
                  <p><input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" /></p><br />
                </fieldset>
              </form>
              ";

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $vyrobce = stripslashes(htmlspecialchars($_POST["vyrobce"], ENT_QUOTES));
              $popis = stripslashes(htmlspecialchars($_POST["popis"], ENT_QUOTES));
              $publikace = date("Y-m-d H:i:s", strtotime($_POST["publikace"]));
              $kod = stripslashes(htmlspecialchars($_POST["kod"], ENT_QUOTES));
              $hmotnost = $_POST["hmotnost"];
              settype($hmotnost, "float");

              $dph = $_POST["dph"];
              settype($dph, "float");

              $cena = $_POST["cena"];
              settype($cena, "float");

              $skladem = $_POST["skladem"];
              settype($skladem, "integer");

              if (!Empty($_FILES["obrazek"]["tmp_name"]))
              {
                $this->ZpracujObrazek($data->adresa, $_FILES["obrazek"], $obrazek);
              }
                else
              {
                $obrazek = $data->obrazek;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  !Empty($popis) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE obsah_eshop SET nazev='{$nazev}',
                                                                      vyrobce='{$vyrobce}',
                                                                      popis='{$popis}',
                                                                      publikace='{$publikace}',
                                                                      kod='{$kod}',
                                                                      hmotnost={$hmotnost},
                                                                      dph={$dph},
                                                                      cena={$cena},
                                                                      obrazek='{$obrazek}',
                                                                      skladem={$skladem}
                                                                      WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upraven: {$nazev}
                  ";
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error);
                }

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "del": //mazani
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          $syn = $this->SynchronizaceSouboruDB();

          if ($res = @$this->sqlite->query("SELECT adresa, nazev, obrazek FROM obsah_eshop WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM obsah_eshop WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazáno: '{$data->nazev}', adresa: '{$data->adresa}'.<br />
                  položek navíc: {$syn}
                ";

                if (file_exists("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}"))
                {
                  chmod("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}", 0777);
                  @unlink("{$this->dirpath}/{$this->pathcest}/{$this->minidir}/{$data->obrazek}");
                }

                if (file_exists("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}"))
                {
                  chmod("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}", 0777);
                  @unlink("{$this->dirpath}/{$this->pathcest}/{$this->fulldir}/{$data->obrazek}");
                }
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "delgrup":
          $grup = $_GET["grup"];  //cislo skupiny

          $syn = $this->SynchronizaceSouboruDB();

          if (@$this->sqlite->queryExec("DELETE FROM obsah_eshop WHERE adresa='{$grup}';", $error)) //provedeni dotazu
          {
            $result =
            "
              smazána skupna adres: '{$grup}'.<br />
              položky navíc: {$syn}
            ";
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
        break;

        case "showuser":  //vypis uzivatelu
          $result = $this->VypisUzivatelu();
        break;

        case "infouser":  //info o uzivateli
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          $result =
          "<div class=\"soupis_obj\">
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\"><strong>Úprava obsahu</strong></a><br /><br />
          ";
          if ($res = @$this->sqlite->query("SELECT
                                            kosik.id as id,
                                            obsah_eshop.nazev as zbozi,
                                            obsah_eshop.cena as cena,
                                            obsah_eshop.dph as dph,
                                            kosik.pocet as pocet
                                            FROM kosik, obsah_eshop
                                            WHERE kosik.zakaznik={$id} AND
                                            obsah_eshop.id=kosik.zbozi;", NULL, $error))
          {
            if ($res->numRows() != 0)
            {
              $sumsoucet = 0;
              while ($data = $res->fetchObject())
              {
                $soucet = floor($data->cena * $data->pocet);
                $cenarow = (($soucet / 100) * $data->dph) + $soucet;
                $sumsoucet += ($data->cena * $data->pocet);

                $result .=  //id: {$data->id}<br />
                "
                  nazev: {$data->zbozi}<br />
                  cena bez dph: {$data->cena} {$this->defmen}<br />
                  dph: {$data->dph} %<br />
                  počet: {$data->pocet} x<br />
                  součet jednoho typu: {$soucet} {$this->defmen}<br />
                  cena řádku s dph: {$cenarow} {$this->defmen}<br /><br />
                ";
              }

              $doprava = $this->IdDopravy($id);

              $cenadoprava = $this->dodani[$doprava]["cena"];
              $celkem = floor(((($sumsoucet + $cenadoprava) / 100) * $this->defdph) + ($sumsoucet + $cenadoprava));

              $result .=
              "
                celkový součet bez dph: {$sumsoucet} {$this->defmen}<br />
                doprava: {$this->dodani[$doprava]["zpusob"]} {$cenadoprava} {$this->defmen}<br />
                celková cena se vším všudy (s dph {$this->defdph} %): {$celkem} {$this->defmen}<br />
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=clearbuy&amp;id={$id}\"
                  onclick=\"return confirm('Opravdu vyprázdnit košík: \'{$id}\' ?');\">vyprazdni mu košík</a>
              ";
            }
              else
            {
              $result .= "<strong>uživatel nemá nic vybrané</strong>";
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;

        case "clearbuy":  //vyprazdneni kosku daneho uzivatele
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if (!@$this->sqlite->queryExec("DELETE FROM kosik WHERE zakaznik={$id};", $error))
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
        break;
      }
    }
//    $result .= "</div>";
    return $result;
  }

/**
 *
 * Vypis administrace eshop obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisEshopObsahu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, popis FROM obsah_eshop ORDER BY adresa ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <br /><h4>{$data->nazev}</h4>
            <p>
              <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">upravit položku</a><br />
              <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->nazev}\', adresa: \'{$data->adresa}\' ?');\">smazat položku</a>
            </p>
            <br />
          ";
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Vrati pocet polozek v eshopu
 *
 * @return pocet polozek
 */
  private function PocetPolozekObsahu()
  {
    $adresa = $_GET[$this->var->get_kam];

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT id FROM obsah_eshop WHERE adresa='{$adresa}';", NULL, $error))
    {
      $result = $res->numRows();
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }

/**
 *
 * Strankuje hlavni vypis, definovano na jednu tabulku
 *
 * @param neco
 * @return neco
 */
  private function Strankovani($strana, $adresa, &$limit)
  {
    $pocet = $this->PocetPolozekObsahu();  //pocet radku taulky
    $pocetstran = ceil($pocet / ($this->strankovani * $this->pocet_sloupcu));  //vypocteny pocet stran podle strankovani

    settype($strana, "integer");

    $mezai = false;
    if ($pocetstran > 7)
    {
      for ($i = 0; $i < 3; $i++)
      {
        $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }
      }

      if (($strana / ($this->strankovani * $this->pocet_sloupcu)) >= 2 && ($strana / ($this->strankovani * $this->pocet_sloupcu)) <= ($pocetstran - 3))
      {
        $mezi = true;
      }
        else
      {
        $jdi .= "..., ";
      }

      for ($i = $pocetstran - 3; $i < $pocetstran; $i++)
      {
        $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }
      }
    }
      else
    {
      for ($i = 0; $i < $pocetstran; $i++)
      {
        $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }
      }
    }

    if ($mezi)
    {
      $i = 0;
      $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi = "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ..., ";

      $i = ($strana / ($this->strankovani * $this->pocet_sloupcu)) - 1;
      $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";

      $i = ($strana / ($this->strankovani * $this->pocet_sloupcu));
      $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "{$poc}</a>, ";

      $aktualni = $poc;

      $i = ($strana / ($this->strankovani * $this->pocet_sloupcu)) + 1;
      $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ..., ";

      $i = $pocetstran - 1;
      $str = $i * ($this->strankovani * $this->pocet_sloupcu); //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
    }

    $jdi = substr($jdi, 0, -2); //odebrani carky

    $limit = "LIMIT {$strana}, ".($this->strankovani * $this->pocet_sloupcu); //dodatecny dotaz do DB

    $result =
    "
    <div id=\"strankovani\">
      Strana {$jdi}
    </div>
    ";

          //<p id=\"vpravo\">
        //Strana: {$aktualni} z {$pocetstran}
      //</p>

    return $result;
  }
}
?>
