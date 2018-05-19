<?php

/**
 *
 * Blok dynamicky generovaneho extermiho adminu
 *
 */

//verze modulu
define("v_DynamicOutside", "1.12");

class DynamicOutside extends DefaultModule
{
  private $var, $sqlite, $dirpath, $unikatni, $absolutni_url;
  public $idmodul = "dynoutside";
  private $idcent = "_cent";  //sekce centralni nastaveni
  private $idnews = "_news";  //sekce novinky
  private $idrepo = "_repo";  //sekce reporty
  private $idfaq = "_faq";  //sekce FAQ
  private $iddlog = "_dlog";  //sekce download logu
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul

  private $dirlicence = "licence";

  //cache soubor pro centralni nastaveni
  private $cachesett = ".cachesetting";

  private $localpermit;

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idcent, $this->idnews,
                          $this->idrepo, $this->idfaq, $this->iddlog);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul,
                                                $this->idcent,
                                                $this->idfaq,
                                                $this->iddlog);

      $this->namemodule = $this->unikatni["name_module"];
      //nastaveni kominikace + auto pripojeni
      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);  //pripojeni defaultu

      $this->Instalace();

      //secteni pole permission a vytvorenych sablon
      $this->permit += $this->RozsiritPermission();
      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        $this->idcent,
                                                        $this->idfaq,
                                                        $this->iddlog)));

      //zajisteni komunikace s webama, generovani pro weby na zaklade dotazu z webu
      $this->KomunikaceDynamicOutside();
      //stahovani z webu
      $this->ZpetnaKomunikaceDynamicOutside();
    }
  }

//dodelat!!
//pridat ty veci fyzicky do databaze
//zamezit ostrelovani dotazama na sebe sama!!
//udelat nejaky postup potvrzovani zapocatych webu! tzn ze je poslana licence ale ceka se a schvaleni z adminu
//pokazde kdyz se web zarezistruje tak se bud pri preklopeni a nebo te registraci overi jestli se legalni ci ne!!!!
//na toto potvrzovani licence pridat sekci v adminu oustide,
//++sem preklopit aktualizace a u nacitani modulu nacitat jen podle nazvu slozky
//zlepsit zpetnou report komunikaci a predavani zprav z webu tu ulozenych!
//++upravit ukladani error logu! zdrejme zapis pri kazde chybe!!!! to neni mozne aby se to logovalo az na konec!!
//vykompenzovat stahovani ze sebe sama!!!
//dat do informaci o webu i zaplacno on/off!!! zvlast k domene a zvlast k hostingu!!!
//vlastnim cron prikazem generovat xml pro vlastni stranky
//vlastni funkci pri zadosti na aktualizace si nasit a vygenerovat vlastni xml pri kontrolu

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
      $adr = explode("__", $_GET[$this->var->get_idmodul]); //rozdeleni adresy
      switch ($adr[0])
      {
        case $this->idmodul:  //id modul
          $result = (!Empty($adr[1]) ? $this->AdminObsahSablony($adr[1]) : $this->AdministraceObsahu());
        break;

        case "{$this->idmodul}{$this->idcent}": //centralni nastaveni
          $result = $this->CentralSettings();
        break;

        case "{$this->idmodul}{$this->idfaq}":  //FAQ
          $result = $this->AdminFAQ();
        break;

        case "{$this->idmodul}{$this->iddlog}": //down logy
          $result = $this->AdminVypisDownLog();
        break;

        case "{$this->idmodul}{$this->idnews}": //novinky, vklada id
          $result = $this->AdminNovinky($adr[1]);
        break;

        case "{$this->idmodul}{$this->idrepo}": //reporty, vklada id
          $result = $this->AdminReporty($adr[1]);
        break;
      }
    }

    return $result;
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}web (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                nazev VARCHAR(200),
                                pridano DATETIME,
                                upraveno DATETIME,
                                url TEXT,
                                popis TEXT,
                                poskdomena VARCHAR(200),
                                expdomena DATETIME,
                                poskhosting VARCHAR(200),
                                exphosting DATETIME,
                                local BOOL,
                                aktivni BOOL);

                              CREATE TABLE {$this->dbpredpona}novinky (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                web INTEGER UNSIGNED,
                                nazev VARCHAR(200),
                                pridano DATETIME,
                                upraveno DATETIME,
                                popis TEXT);

                              CREATE TABLE {$this->dbpredpona}reporty (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                web INTEGER UNSIGNED,
                                ide INTEGER UNSIGNED,
                                login VARCHAR(100),
                                email VARCHAR(200),
                                predmet VARCHAR(500),
                                message TEXT,
                                prectene BOOL,
                                pridano DATETIME,
                                ip VARCHAR(50),
                                agent VARCHAR(300));

                              CREATE TABLE {$this->dbpredpona}faq_skupina (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                nazev TEXT);

                              CREATE TABLE {$this->dbpredpona}faq (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                skupina INTEGER UNSIGNED,
                                nazev VARCHAR(200),
                                otazka TEXT,
                                odpoved TEXT,
                                pridano DATETIME,
                                upraveno DATETIME);

                              CREATE TABLE {$this->dbpredpona}downlog (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                url TEXT,
                                exectime VARCHAR(100),
                                agent VARCHAR(300),
                                ip VARCHAR(50),
                                datum DATETIME);
                            ");
  }

/**
 *
 * Rozsireni menu adminu o dane skupiny z teto sekce
 *
 * @param adresa pole adres adminmenu
 * @return rozsirene pole adres adminmenu o sekce z tohoto modulu
 */
  private function RozsiritAdminMenu($adresa)
  {
    $rozsireni = array(array("main_href" => "{$this->idmodul}{$this->idnews}",
                            "odkaz" => $this->unikatni["admin_menu_rozsireni_news"]),
                      array("main_href" => "{$this->idmodul}{$this->idrepo}",
                            "odkaz" => $this->unikatni["admin_menu_rozsireni_report"]));

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}web ORDER BY LOWER(nazev) ASC;"))
    {
      $i = count($adresa);
      foreach ($res as $data) //rozsireni menu
      {
        $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";
        $adresa[$i]["odkaz"] = $data->nazev;
        $adresa[$i]["title"] = $data->nazev;
        $i++;

        //generovani rozsireni novinek a reportu
        foreach ($rozsireni as $polozka)
        {
          $adresa[$i]["main_href"] ="{$polozka["main_href"]}__{$data->id}";
          $adresa[$i]["odkaz"] = $polozka["odkaz"];
          $adresa[$i]["title"] = $polozka["odkaz"];
          $i++;
        }
      }
    }

    return $adresa;
  }

/**
 *
 * Rozsireni pole permission na zaklade vytvorenych sablon
 *
 * @return pole vytvorenych sablon
 */
  private function RozsiritPermission()
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}web ORDER BY LOWER(nazev) ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $result["{$this->idmodul}__{$data->id}"] = array("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_vypis"], $data->nazev));

        $result["{$this->idmodul}{$this->idnews}__{$data->id}"] = array("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_vypis_news"], $data->nazev),
                                                                        "addnews" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_add_news"], $data->nazev),
                                                                        "editnews" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_edit_news"], $data->nazev),
                                                                        "delnews" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_del_news"], $data->nazev));

        $result["{$this->idmodul}{$this->idrepo}__{$data->id}"] = array("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_vypis_report"], $data->nazev),
                                                                        "showrep" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_showrep"], $data->nazev),
                                                                        "delrep" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_delrep"], $data->nazev));
      }
    }

    return $result;
  }

/**
 *
 * Zajistuje vraceni xml s daty
 *
 * @return generovane xml
 */
  private function KomunikaceDynamicOutside()
  {
    $result = "";
    $web = $this->NotEmpty("get", "w");
    //pokud je pripojeni mimo admin
    if (!(!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu) &&
        //$this->var->administrace != $this->absolutni_url && //a jen mimo tent web!
        !Empty($web))
    {
      //dekodovani adresy
      $kod = base64_decode($web);
      $url = $this->DekodujText($kod);

      //nacteni hodnot ze sablony
      if ($retdata = $this->ControlObjectHodnoty(array("id", "poskdomena", "expdomena", "poskhosting", "exphosting"),
                                                array("web", $url, "url=")))
      {
        $start = $this->MeritCas(); //zacatek mereni
        //vyrvoreni xml
        $xml = new SimpleXMLElement("<outside></outside>");
        //zpracovani do xml
        $xml->web->poskdomena = $retdata->poskdomena;
        $xml->web->expdomena = $retdata->expdomena;
        $xml->web->poskhosting = $retdata->poskhosting;
        $xml->web->exphosting = $retdata->exphosting;
        //generovani novinek
        if ($res = $this->queryMultiObjectSingle("SELECT pridano, nazev, popis FROM {$this->dbpredpona}novinky
                                                  WHERE web='{$retdata->id}'
                                                  ORDER BY pridano DESC;"))
        {
          //vypis novinek
          $i = 0; //pocitadlo polozek
          foreach ($res as $data)
          { //zpracovani do xml
            $xml->novinky[$i]->datum = $data->pridano;
            $xml->novinky[$i]->nazev = $data->nazev;
            $xml->novinky[$i]->popis = $data->popis;
            $i++;
          }
        }
        //generovani globalniho nastaveni
        $res = $this->ControlConfig(array("datumoddo", "dialog", "popisfaq", "popisreport"), true,
                                    array("load|config", "{$this->dirpath}/{$this->cachesett}"));
        //zpracovani do xml
        $xml->nastaveni->datumoddo = $res->datumoddo;
        $xml->nastaveni->dialog = $res->dialog;
        $xml->nastaveni->popisfaq = $res->popisfaq;
        $xml->nastaveni->popisreport = $res->popisreport;
        //generovani faq
        if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}faq_skupina
                                                  ORDER BY LOWER(nazev) ASC;"))
        {
          //vypis skupin
          $i = 0; //pocitadlo skupin
          foreach ($res as $data)
          { //zpracovani do xml
            $xml->faq[$i]->nazev = $data->nazev;
            //generovani faq polozek
            if ($res1 = $this->queryMultiObjectSingle("SELECT nazev, otazka, odpoved FROM {$this->dbpredpona}faq
                                                      WHERE skupina='{$data->id}'
                                                      ORDER BY LOWER(nazev) ASC;"))
            {
              //vypis polozek
              $j = 0; //pocitadlo polozek
              foreach ($res1 as $data1)
              { //zpracovani do xml
                $xml->faq[$i]->polozka[$j]->nazev = $data1->nazev;
                $xml->faq[$i]->polozka[$j]->otazka = $data1->otazka;
                $xml->faq[$i]->polozka[$j]->odpoved = $data1->odpoved;
                $j++;
              }
            }
            $i++;
          }
        }

        $konec = $this->MeritCas(); //konec mereni
        $exectime = $this->KalkulaceCas($start, $konec);
        //logovani downloadu
        $this->AdminAddDownLog($url, $exectime);

        //nastaveni hlavicky
        header("Content-type: text/xml");
        echo $xml->asXml();
        exit(0);
      }
        else
      {
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><outside></outside>";
        exit(0);
      }
    }

    return $result;
  }

/**
 *
 * Zpetna komunikace s weby, manualne na dotaz z emailu overuje reporty
 *
 */
  private function ZpetnaKomunikaceDynamicOutside()
  {
    $result = "";
    $web = $this->NotEmpty("get", "r");

    //pokud je pripojeni mimo admin
    if (!(!Empty($_GET[$this->var->get_kam]) &&
        $_GET[$this->var->get_kam] == $this->var->adresaadminu)) //a jen mimo tent web!
    {
      if (!Empty($web) &&   ///dodelat!!!!!!§
          $this->var->administrace != $this->absolutni_url)
      {
        //dekodovani pro zjisteni url
        $roz = explode("--", base64_decode($web));
        $url = $this->DekodujText($roz[0]);
        //overeni existence url
        $webid = $this->VypisHodnotu("id", "web", $url, "url=");
        if ($webid > 0)
        {
          //stahnuti xml
          $getxml = $this->NactiUrl("{$url}?wr={$web}");
//dodelat!! ukladat do XML a pak parsrovat!
//ukladat az na pozadani z webu
          //parsnuti xml
          $xml = @new SimpleXMLElement($getxml);
          if (!Empty($xml->reporty[0]->id))
          {
            //prochazeni reportu
            foreach ($xml->reporty as $report)
            {
              //naskladani do databaze
              $this->ControlForm(array ("web" => array("self", "integer", $webid),
                                        "ide" => array("self", "integer", $report->id),
                                        "login" => array("self", "string", $report->login),
                                        "email" => array("self", "string", $report->email),
                                        "predmet" => array("self", "string", $report->predmet),
                                        "message" => array("self", "string", $report->message),
                                        "prectene" => array("self", "boolean", false),
                                        "pridano" => array("self", "date", $report->pridano),
                                        "ip" => array("self", "string", $report->ip),
                                        "agent" => array("self", "string", $report->agent)),
                                $this->DuplikatniHodnota("ide", "reporty", $report->id, "web='{$webid}' AND "),  //kontrola duplicity pro dany web
                                array("insert", "reporty", NULL));
            }
            //autoklik na dany web, dany report
            $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}__{$webid}&co=showrep&id={$roz[1]}");  //auto kliknuti
          }
        }
      }

      $kk = $this->NotEmpty("post", "kk");
      $ll = $this->NotEmpty("post", "ll");
      if (!Empty($kk) &&
          !Empty($ll))
      {
        $url = base64_decode(rawurldecode($kk));
        $kod = base64_decode(rawurldecode($ll));
        if (!Empty($url) &&
            !Empty($kod))
        {
          $cesta = "{$this->dirpath}/{$this->dirlicence}/{$this->PrepisTextu($url)}.xml";
          if ($u = fopen($cesta, "w"))
          {
            fwrite($u, $kod);
            fclose($u);
//bude se to jeste nejak propojovat s db a overovat jestli je to legalni web
//+se tu musi logovat z kama dotazy chodi a udelat k tomu admin jestli jsou
//redy a jestli ne....
//po expiraci odmazat, cronem prochazet expiraci
//mozna jeste doresit!!!!
            echo "ok";
          }
        }
          else
        {
          echo "ee";
        }

        exit;
      }
    }
  }

/**
 *
 * Hlavni administrace webu
 *
 * @return obsluha webu
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addweb"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addweb" : ""),
                                        $this->AdminVypisObsah());

    $tvar_datum = $this->unikatni["admin_addeditweb_tvar_datum"];

    $this->ControlCreateDir(array(array($this->dirpath, $this->dirlicence),));

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addweb":  //pridavani webu
          $default = $this->unikatni["admin_addweb_default"];
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditweb"],
                                              $this->unikatni["admin_addeditweb_add"],
                                              $default[0],
                                              $default[1],
                                              $default[2],
                                              $default[3],
                                              date($tvar_datum, strtotime($default[4])),
                                              $default[5],
                                              date($tvar_datum, strtotime($default[6])),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "url" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "poskdomena" => array("post", "string"),
                                        "expdomena" => array("post", "date"),
                                        "poskhosting" => array("post", "string"),
                                        "exphosting" => array("post", "date")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["url"])),
                                array("insert", "web", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editweb": //uprava webu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev, url, popis, poskdomena, expdomena, poskhosting, exphosting FROM {$this->dbpredpona}web WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditweb"],
                                                $this->unikatni["admin_addeditweb_edit"],
                                                $data->nazev,
                                                $data->url,
                                                $data->popis,
                                                $data->poskdomena,
                                                date($tvar_datum, strtotime($data->expdomena)),
                                                $data->poskhosting,
                                                date($tvar_datum, strtotime($data->exphosting)),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul));

            if ($this->ControlForm(array ("nazev" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "url" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          "poskdomena" => array("post", "string"),
                                          "expdomena" => array("post", "date"),
                                          "poskhosting" => array("post", "string"),
                                          "exphosting" => array("post", "date")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["url"]) && $id > 0),
                                  array("update", "web", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delweb":  //mazani webu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("web" => array("id", $id, "nazev"),
                                            "novinky" => array("web"),
                                            "reporty" => array("web")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis hlavniho obsahu
 *
 * @return vypis obsahu
 */
  private function AdminVypisObsah()
  {
    $result = "";
    $tvar_datum = $this->unikatni["admin_vypis_obsah_tvar_datum"];

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, pridano, upraveno, url FROM {$this->dbpredpona}web ORDER BY LOWER(nazev) ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->id,
                                            $data->nazev,
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $this->unikatni["admin_vypis_obsah_neupraveno"]),
                                            $data->url, //5
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["editweb"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editweb&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delweb"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delweb&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }

/**
 *
 * Vypis a obsluha centralniho nastaveni
 *
 * @return vypis nastaveni
 */
  private function CentralSettings()
  {
    $result = "";
    if ($this->ControlConfig(array("datumoddo" => array("post", "string"),
                                    "dialog" => array("post", "string"),
                                    "popisfaq" => array("post", "string"),
                                    "popisreport" => array("post", "string")
                                    ),
                              (!Empty($_POST["tlacitko"]) && !Empty($_POST["datumoddo"]) && !Empty($_POST["dialog"]) && !Empty($_POST["popisfaq"]) && !Empty($_POST["popisreport"])),
                              array("save|config", "{$this->dirpath}/{$this->cachesett}")))
    {
      $result = $this->Hlaska("edit", "Centrální nastavení");
      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}{$this->idcent}");  //auto kliknuti
    }
      else
    {
      if (!$res = $this->ControlConfig(array("datumoddo", "dialog", "popisfaq", "popisreport"), true,
                                    array("load|config", "{$this->dirpath}/{$this->cachesett}")))
      {
        $result = $this->Hlaska("warning", "Nejsou nacachovany hodnoty");
      }

      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_settings"],
                                          $this->dirpath,
                                          $res->datumoddo,
                                          $res->dialog,
                                          $res->popisfaq,
                                          $res->popisreport);
    }

    return $result;
  }

/**
 *
 * Hlavni administrace FAQ
 *
 * @return obsluha faq
 */
  private function AdminFAQ()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_faq"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addfaqskup"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;co=addfaqskup" : ""),
                                        $this->AdminVypisFAQ());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addfaqskup": //privavani skupiny FAQ
          $default = $this->unikatni["admin_addfaqskup_default"];
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfaqskup"],
                                              $this->unikatni["admin_addeditfaqskup_add"],
                                              $default[0],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}");

          if ($this->ControlForm(array("nazev" => array("post", "string")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"])),
                                array("insert", "faq_skupina", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}");  //auto kliknuti
          }
        break;

        case "editfaqskup":  //uprava skupiny FAQ
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT nazev FROM {$this->dbpredpona}faq_skupina WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfaqskup"],
                                                $this->unikatni["admin_addeditfaqskup_edit"],
                                                $data->nazev,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}");

            if ($this->ControlForm(array("nazev" => array("post", "string")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $id > 0),
                                  array("update", "faq_skupina", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}");  //auto kliknuti
            }
          }
        break;

        case "delfaqskup": //mazani skupiny FAQ
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("faq_skupina" => array("id", $id, "nazev"),
                                            "faq" => array("skupina")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}");  //auto kliknuti
          }
        break;

        case "addfaq":  //pridavani FAQ
          $skupina = $_GET["skup"];
          settype($skupina, "integer");

          $default = $this->unikatni["admin_addfaq_default"];
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfaq"],
                                              $this->unikatni["admin_addeditfaq_add"],
                                              $this->AdminSkupinaFAQ($skupina),
                                              $default[0],
                                              $default[1],
                                              $default[2],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;skup={$skupina}");

          if ($this->ControlForm(array ("skupina" => array("post", "integer"),
                                        "nazev" => array("post", "string"),
                                        "otazka" => array("post", "string"),
                                        "odpoved" => array("post", "string"),
                                        "pridano" => array("self", "date", "now")),//"upraveno" => array("self", "date", "now"),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["otazka"]) && !Empty($_POST["odpoved"])),
                                array("insert", "faq", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&skup={$_POST["skupina"]}");  //auto kliknuti
          }
        break;

        case "editfaq": //uprava FAQ
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT skupina, nazev, otazka, odpoved FROM {$this->dbpredpona}faq WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfaq"],
                                                $this->unikatni["admin_addeditfaq_edit"],
                                                $this->AdminSkupinaFAQ($data->skupina),
                                                $data->nazev,
                                                $data->otazka,
                                                $data->odpoved,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;skup={$data->skupina}");

            if ($this->ControlForm(array ("skupina" => array("post", "integer"),
                                          "nazev" => array("post", "string"),
                                          "otazka" => array("post", "string"),
                                          "odpoved" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["otazka"]) && !Empty($_POST["odpoved"]) && $id > 0),
                                  array("update", "faq", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&skup={$_POST["skupina"]}");  //auto kliknuti
            }
          }
        break;

        case "delfaq":  //mazani FAQ
          $id = $_GET["id"];
          settype($id, "integer");

          $skupina = $this->VypisHodnotu("skupina", "faq", $id);  //nacte si id pro vraceni
          if ($this->ControlDeleteForm(array("faq" => array("id", $id, "nazev")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&skup={$skupina}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis selectu skupin FAQ
 *
 * @return vypis selectu
 */
  private function AdminSkupinaFAQ($id = NULL)
  {
    $ret = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}faq_skupina ORDER BY LOWER(nazev) ASC;"))
    {
      foreach ($res as $data)
      {
        $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_skupina_faq_row"],
                                          $data->id,
                                          ($id == $data->id ? " selected=\"selected\"" : ""),
                                          $data->nazev);
      }
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_skupina_faq"],
                                        implode("", $ret));

    return $result;
  }

/**
 *
 * Vypis obsahu FAQ
 *
 * @return vypis FAQ
 */
  private function AdminVypisFAQ()
  {
    $result = "";
    $skupina = (!Empty($_GET["skup"]) ? $_GET["skup"] : "");  //nacitani id skupiny
    $tvar_datum = $this->unikatni["admin_vypis_faq_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}faq_skupina ORDER BY LOWER(nazev) ASC;"))
    {
      foreach ($res as $data)
      {
        //vypis polozek
        $polozky = array();
        $podm = ($skupina == $data->id);
        //generovani jen kdyz je potreba
        if ($podm)
        {
          if ($res1 = $this->queryMultiObjectSingle("SELECT id, nazev, otazka, odpoved, pridano, upraveno FROM {$this->dbpredpona}faq WHERE skupina='{$data->id}' ORDER BY LOWER(nazev) ASC;"))
          {
            foreach ($res1 as $data1)
            {
              $polozky[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_faq"],
                                                    $data1->nazev,
                                                    $data1->otazka,
                                                    $data1->odpoved,
                                                    date($tvar_datum, strtotime($data1->pridano)),
                                                    (!Empty($data1->upraveno) ? date($tvar_datum, strtotime($data1->upraveno)) : $this->unikatni["admin_vypis_faq_neupraveno"]),
                                                    ($this->localpermit[$_GET[$this->var->get_idmodul]]["editfaq"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;co=editfaq&amp;id={$data1->id}" : ""),
                                                    ($this->localpermit[$_GET[$this->var->get_idmodul]]["delfaq"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;co=delfaq&amp;id={$data1->id}" : ""));
            }
          }
            else
          {
            $polozky[] = $this->unikatni["admin_vypis_faq_null"];
          }
        }

        //vypis skupin
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_faq_skupina"],
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}".(!$podm ? "&amp;skup={$data->id}" : ""),
                                            $data->nazev,
                                            ($podm ? $this->unikatni["admin_vypis_faq_skupina_aktivni"] : ""),
                                            ($podm ? implode("", $polozky) : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["addfaq"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;co=addfaq&amp;skup={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["editfaqskup"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;co=editfaqskup&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delfaqskup"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idfaq}&amp;co=delfaqskup&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_faq_skupina_null"];
    }

    return $result;
  }

/**
 *
 * Loguje download logy
 *
 * @param web nazev webu
 */
  private function AdminAddDownLog($web, $exectime)
  {
    $this->ControlForm(array ("url" => array("self", "string", $web),
                              "exectime" => array("self", "string", $exectime),
                              "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                              "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                              "datum" => array("self", "date", "now")),
                      (!Empty($web)),
                      array("insert", "downlog", NULL));
  }

/**
 *
 * Hlavni administrace download logu
 *
 * @return obsluha download logu
 */
  private function AdminVypisDownLog()
  {
    $result = $this->unikatni["admin_vypis_down_log_begin"];
    $tvar_datum = $this->unikatni["admin_vypis_down_log_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT url, exectime, agent, ip, datum FROM {$this->dbpredpona}downlog ORDER BY datum DESC;"))
    {
      foreach ($res as $data)
      {
        $sys = $this->TypSystemu($data->agent, false);
        //$os = $this->TypOS($data->agent);
        //$brow = $this->TypBrowseru($data->agent);
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_down_log"],
                                            $data->url,
                                            $data->exectime,
                                            $data->ip,
                                            date($tvar_datum, strtotime($data->datum)),
                                            $sys->os,
                                            $sys->browser);
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_down_log_null"];
    }

    return $result;
  }

/**
 *
 * Cisteni download logu
 * --urceno pro cron
 *
 */
  public function CronClearDownLog()
  {
    $expire = date("Y-m-d H:i:s", strtotime($this->unikatni["set_down_log_expire"]));
    if ($res = $this->queryMultiObjectSingle("SELECT id
                                              FROM {$this->dbpredpona}downlog
                                              WHERE
                                              datum<='{$expire}';"))
    {
      $id = "";
      foreach ($res as $data)
      {
        $id[] = $data->id;
      }

      if (!Empty($id) &&
          is_array($id))
      {
        $sloucene = implode(", ", $id);
        $this->queryExec("DELETE FROM {$this->dbpredpona}downlog WHERE id IN ({$sloucene});");
      }
    }
  }

/**
 *
 * Vypise obsah skupiny, univerzalni vypis
 *
 * @param sablona id dane sablony
 * @return obsah skupny
 */
  private function AdminObsahSablony($sablona)
  {
    settype($sablona, "integer");
    //nacteni hodnot ze sablony
    $retdata = $this->ControlObjectHodnoty(array("nazev", "url", "popis", "poskdomena", "expdomena", "poskhosting", "exphosting"),
                                          array("web", $sablona));

    $tvar_datum = $this->unikatni["admin_obsah_sablona_tvar_datum"];

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_sablona"],
                                        $sablona,
                                        $retdata->nazev,
                                        $retdata->url,
                                        $retdata->popis,
                                        date($tvar_datum, strtotime($retdata->expdomena)),
                                        $retdata->poskdomena,
                                        date($tvar_datum, strtotime($retdata->exphosting)),
                                        $retdata->poskhosting,
                                        ($this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->idnews}__{$sablona}", "") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}" : ""),
                                        $this->VypisHodnotu("COUNT(id)", "novinky", $sablona, "web="),
                                        ($this->OverovaniManualPermission(NULL, "{$this->idmodul}{$this->idrepo}__{$sablona}", "") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}__{$sablona}" : ""),
                                        $this->VypisHodnotu("COUNT(id)", "reporty", $sablona, "web="),
                                        ($this->OverovaniManualPermission(NULL, "{$this->idmodul}", "editweb") ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editweb&amp;id={$sablona}&amp;ret={$this->idmodul}__{$sablona}" : ""));

    return $result;
  }

/**
 *
 * Hlavni administrace novinek
 *
 * @param sablona cislo sekce webu
 * @return obsluha novinek
 */
  private function AdminNovinky($sablona)
  {
    settype($sablona, "integer");
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_novinky"],
                                        $sablona,
                                        $this->VypisHodnotu("nazev", "web", $sablona),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addnews"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}&amp;co=addnews" : ""),
                                        $this->AdminVypisNovinky($sablona));

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addnews": //pridavani novinek
          $default = $this->unikatni["admin_addnews_default"];
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditnews"],
                                              $this->unikatni["admin_addeditnews_add"],
                                              $default[0],
                                              $default[1],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}");

          if ($this->ControlForm(array ("web" => array("self", "integer", $sablona),
                                        "nazev" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "popis" => array("post", "string")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"])),
                                array("insert", "novinky", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}");  //auto kliknuti
          }
        break;

        case "editnews":  //uprava novinek
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT id, nazev, popis FROM {$this->dbpredpona}novinky WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditnews"],
                                                $this->unikatni["admin_addeditnews_edit"],
                                                $data->nazev,
                                                $data->popis,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}");

            if ($this->ControlForm(array ("web" => array("self", "integer", $sablona),
                                          "nazev" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "popis" => array("post", "string")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && $id > 0),
                                  array("update", "novinky", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}");  //auto kliknuti
            }
          }
        break;

        case "delnews": //mazani novinek
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("novinky" => array("id", $id, "nazev")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis obsahu novinek
 *
 * @param sablona cislo sekce webu
 * @return vypis novinek
 */
  private function AdminVypisNovinky($sablona)
  {
    settype($sablona, "integer");
    $result = "";
    $tvar_datum = $this->unikatni["admin_vypis_novinky_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, pridano, upraveno, popis FROM {$this->dbpredpona}novinky WHERE web='{$sablona}' ORDER BY pridano DESC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_novinky"],
                                            $data->id,
                                            $data->nazev,
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $this->unikatni["admin_vypis_novinky_neupraveno"]),
                                            $data->popis, //5
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["editnews"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}&amp;co=editnews&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delnews"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idnews}__{$sablona}&amp;co=delnews&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_novinky_null"];
    }

    return $result;
  }

/**
 *
 * Hlavni administrace reportu
 *
 * @param sablona cislo sekce webu
 * @return obsluha reportu
 */
  private function AdminReporty($sablona)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_reporty"],
                                        $sablona,
                                        $this->VypisHodnotu("nazev", "web", $sablona),
                                        $this->AdminVypisReporty($sablona));

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "showrep": //zobrazeni reportu
          $id = $_GET["id"];
          settype($id, "integer");

          $retdata = $this->ControlObjectHodnoty(array("id", "login", "email", "predmet", "message", "prectene", "pridano", "ip", "agent"),
                                                array("reporty", $id, "ide="));

          if ($retdata->id)
          {
            $tvar_datum = $this->unikatni["admin_showrep_tvar_datum"];
            $sys = $this->TypSystemu($retdata->agent);
            //$os = $this->TypOS($retdata->agent);
            //$brow = $this->TypBrowseru($retdata->agent);
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_showrep"],
                                                $retdata->login,
                                                $retdata->email,
                                                $retdata->predmet,
                                                $retdata->message,
                                                ($retdata->prectene ? " checked=\"checked\"" : ""),
                                                date($tvar_datum, strtotime($retdata->pridano)),  //6
                                                $retdata->ip,
                                                $sys->os,
                                                $sys->browser,
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}__{$sablona}");

            //nastaveni priznaku precteni
            $this->NastavHodnotu("prectene", 1, "reporty", $retdata->id);
          }
        break;

        case "delrep":  //mazani reportu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("reporty" => array("id", $id, "predmet")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}__{$sablona}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis obsahu reportu
 *
 * @param sablona cislo sekce webu
 * @return vypis reportu
 */
  private function AdminVypisReporty($sablona)
  {
    settype($sablona, "integer");
    $result = "";
    $tvar_datum = $this->unikatni["admin_vypis_reporty_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, ide, login, email, predmet, message, prectene, pridano, ip, agent FROM {$this->dbpredpona}reporty WHERE web='{$sablona}' ORDER BY pridano DESC;"))
    {
      foreach ($res as $data)
      {
        $sys = $this->TypSystemu($data->agent);
        //$os = $this->TypOS($data->agent);
        //$brow = $this->TypBrowseru($data->agent);
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_reporty"],
                                            $data->login,
                                            $data->email,
                                            $data->predmet,
                                            $data->message,
                                            ($data->prectene ? " checked=\"checked\"" : ""),
                                            date($tvar_datum, strtotime($data->pridano)),
                                            $data->ip, //7
                                            $sys->os,
                                            $sys->browser,
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["showrep"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}__{$sablona}&amp;co=showrep&amp;id={$data->ide}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delrep"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idrepo}__{$sablona}&amp;co=delrep&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_reporty_null"];
    }

    return $result;
  }


}
?>
