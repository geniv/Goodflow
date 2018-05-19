<?php

/**
 *
 * Blok dynamicky generovaneho centralniho obsahu
 *
 */

//verze modulu
define("v_DynamicCentral", "1.58");

class DynamicCentral extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona, $mainindex;
  public $idmodul = "dyncent";  //id pro rozliseni modulu v adminu
  private $idsortmenu = "_sort";  //razeni sablon
  private $idmenu = "_menu";  //obsluha sekci menu
  private $idlang = "_lang";  //obsluha jazyku
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array("script/ajax.js"); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array("Ajax" => "DynamicCentral"); //konvert nazvu metody

  private $localpermit;

  private $typ_elementu = array();  //typy elementu
  private $typ_vstupu = array();  //typy vstupu
  private $cfgexplode = "|--xx--|"; //text pro rozdeleni konfigurace
  private $obsexplode = "|-xxxx-|"; //text pro rozdeleni obsahu
  private $valexplode = "|-x--x-|"; //text pro rozdeleni value v obsahu

  private $znacka_povinne;
  private $name_button = "tlacitko";  //name tlacitko add/edit obsahu
  private $group_sep = "-;-";

  private $get_menu = "menu";
  private $get_down = "down";

  private $get_search = "search"; //get adresa pro vyhledavani
  private $post_search = "search";  //post adresa pro vyhledavani
  private $post_search_button = "search_button";

  private $supporttype = array("image/jpeg", "image/png");
  private $cachenamesab = array();

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idsortmenu, $this->idmenu, //0..2
                          $this->idlang);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      $this->mainindex = $index;

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->typ_elementu = $this->unikatni["set_typ_elementu"];
      $this->typ_vstupu = $this->unikatni["set_typ_vstupu"];
      $this->znacka_povinne = $this->unikatni["set_znacka_povinne"];

      $this->pathpicture = $this->unikatni["set_pathpicture"];
      $this->minidir = $this->unikatni["set_minidir"];
      $this->fulldir = $this->unikatni["set_fulldir"];
      //path souboru
      $this->pathfile = $this->unikatni["set_pathfile"];

      $this->get_menu = $this->unikatni["set_get_menu"];
      $this->get_down = $this->unikatni["set_get_down"];

      $this->maxsizepic = $this->unikatni["set_maxsizepic"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul,
                                                $this->idsortmenu,
                                                $this->idmenu,
                                                $this->idlang);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);

      $this->Instalace();

      //secteni pole permission a vytvorenych sablon
      $this->permit += $this->RozsiritPermission();
      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        $this->idsortmenu,
                                                        $this->idmenu,
                                                        $this->idlang)));
    }
  }

//dodelat!!!! dokontrolova, dostat do pouzitelne verze a pokracovat!!
//mrda duplikace?!! - zkontrolovat!!
//??na sablonach live zobrazovani a uprava zamku pres ajax a zobrazovani v menu???????
//[16:29:12] <Fugess> central by mel umet i vybirani nahodne polozky z preddefinovaneho / preddefinovanych obsahu - zvlast vystup
//tim se zbavime dalsiho modulu (random galerie bez sekci) viz galileo - rikam  zvlastni vystup
//dynamic_random_picture predelat do centralu - novy element a nebo proste jen volaci funkce!!

//dodelat!! fulltextove vyhledavani ze vsech textu!!! - + admin na nadefinovani adres co se kde nachazi!
//dodelat nahodne vystupy obsahu ze sablony/sablon

//odebirani veci emailem nebude tento modul zajistovat!! na to bude rss propojeni!

//dopracovat pripojeni s jazykovym modulem

//dodelat!! propojovani
//funkce bude brat adresu sablony, a pres unikatni se nadefinuje tvar prechodu dat,
//mezi centralem (source) a jinym modulem jako (destination),
//propojeni se bude definovat az na destination modulu, kde rekne v parametrech
//ze se ma vzit toto id elementu a jak se me vracet (jako jaky obejkt a nebo pod.)

//dodelat!! jeste spravovat jazykovou tabulku +
//prekladatele a jejich emaily kam se to bude posilat! atd...




//DODELAT!!!!
//strankovani pres adresu!!
//random vystup obsahu/sablon

//novy typ: rewrite adresa
//strankovani nastaveni v sablone
//v sablona misto moc bool udelat konfuguraci generovanou!

//do menu!!
//zobrazovat svoje submenu (jinak se bude rozbalovat postupne!)
//zobrazovat obsahy svych submenu
//zamky na zamikani pridavani dalsi urovne, +zamkne sama sebe zamek_menu
//+zamky na pridavani obsahu do dane urovne!! zamek_obsah
//zamky na obsah a polozku menu?!!

//jeste doresit propojeni obsahu a samotneho menu!!

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

        case "{$this->idmodul}{$this->idsortmenu}":  //razeni menu
          $result = $this->AdminVypisRazeniSablony();
        break;

        case "{$this->idmodul}{$this->idmenu}":  //obsluha sekce menu a jeho obsahu
          $result = (!Empty($adr[1]) ? $this->AdminObsahCentralMenu($adr[1]) : $this->AdminCentralMenu());
        break;

        case "{$this->idmodul}{$this->idlang}": //obsluha jazyku
          $result = "coming soon...";  //dodelat!! nejak...
          //dodelat!! +sprava jazyku???
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}sablona (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                adresa TEXT,
                                nazev VARCHAR(200),
                                razeni VARCHAR(50),
                                max_obsah INTEGER UNSIGNED,
                                jazyky BOOL,
                                formenu BOOL,
                                konfigurace TEXT,
                                popis TEXT,
                                poradi INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}menu (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                adresa TEXT,
                                sablona INTEGER UNSIGNED,
                                jazyk INTEGER UNSIGNED,
                                nazev VARCHAR(500),
                                rewrite VARCHAR(500),
                                zanoreni INTEGER UNSIGNED,
                                koren TEXT,
                                submenu TEXT,
                                defaultni BOOL,
                                max_zanoreni INTEGER UNSIGNED,
                                konfigurace TEXT,
                                pridano DATETIME,
                                upraveno DATETIME,
                                poradi INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}element (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                sablona INTEGER UNSIGNED,
                                nazev VARCHAR(200),
                                typ VARCHAR(50),
                                konfigurace TEXT,
                                value TEXT,
                                popis TEXT,
                                povinne BOOL,
                                vstup VARCHAR(50),
                                reg_exp VARCHAR(500),
                                min_val INTEGER UNSIGNED,
                                max_val INTEGER UNSIGNED,
                                poradi INTEGER UNSIGNED);

                              CREATE TABLE {$this->dbpredpona}obsah (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                sablona INTEGER UNSIGNED,
                                jazyk INTEGER UNSIGNED,
                                menu INTEGER UNSIGNED,
                                konfigurace TEXT,
                                obsah TEXT,
                                konfig TEXT,
                                pridano DATETIME,
                                upraveno DATETIME,
                                typy TEXT,
                                poradi INTEGER UNSIGNED);
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
    //rozsireni menu o sablony
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, formenu FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      $i = count($adresa);
      foreach ($res as $data)
      { //kdyz je pro menu tak kontroluje pocet id pro menu=0 a sablona=id
        //if ($data->formenu ? $this->VypisHodnotu("COUNT(id)", "obsah", $data->id, "menu=0 AND sablona=") > 0 : true)
        //{
          $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";
          $adresa[$i]["odkaz"] = $data->nazev;
          $adresa[$i]["title"] = $data->nazev;
          $i++;
        //}
      }
    }
    //rozsireni menu o central menu
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}menu WHERE zanoreni=0 ORDER BY poradi ASC;"))
    {
      foreach ($res as $data)
      {
        $adresa[$i]["main_href"] = "{$this->idmodul}{$this->idmenu}__{$data->id}";
        $adresa[$i]["odkaz"] = $data->nazev;
        $adresa[$i]["title"] = $data->nazev;
        $i++;
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $result["{$this->idmodul}__{$data->id}"] = array("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_vypis"], $data->nazev),
                                                        "addobsah" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_addobsah"], $data->nazev),
                                                        "copyobsah" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_copyobsah"], $data->nazev),
                                                        "editobsah" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_editobsah"], $data->nazev),
                                                        "delobsah" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_delobsah"], $data->nazev),
                                                        "updateobsah" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_updateobsah"], $data->nazev));
      }
    }
//dodelat!!! doresit!!
    //rozsireni na menu
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}menu WHERE zanoreni=0 ORDER BY poradi ASC;"))
    {
      //vypis menu
      foreach ($res as $data)
      { //jen vypis
        $result["{$this->idmodul}{$this->idmenu}__{$data->id}"] = array("" => $this->NactiUnikatniObsah($this->unikatni["admin_permit_rozsireni_menu_vypis"], $data->nazev));
      }
    }

    return $result;
  }

/**
 *
 * Vrati pocet radku pro strankovani
 *
 * pouziti:
 * $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsahPocetRadku", "adresa")
 *
 * @param adresa adresa sablony
 * @return pocet polozek obsahu v sablone
 */
  public function CentralMenuObsahPocetRadku($nastaveni)
  {
    $adresa = $nastaveni["adresa"];

    $subobsah = $nastaveni["subobsah"];
    $subobsahradio = $nastaveni["subobsahradio"];

    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "menu", $adresa) &&  //kontrola existence
        !$this->var->aktivniadmin)
    { //nacteni hodnot z menu + detekce prislusnosti k danemu menu

      $retdata = $this->ControlObjectHodnoty(array("id", "sablona", "rewrite", "defaultni", "konfigurace"), //"nazev", "rewrite", "zanoreni", "koren"
                                              array("menu", $adresa, "adresa="));

      $zprac = $this->ZpracovaniCentralMenuObsah($nastaveni);

      $idobsah = $zprac->idobsah;
      $rozkliknuto = $zprac->rozkliknuto;

      $result->pocet = $this->querySingle("SELECT COUNT(id) FROM
                                          {$this->dbpredpona}obsah o
                                          WHERE {$idobsah};");

      //slouceni adres
      $result->baseurl = $zprac->rewrite;
      //implode("/", $zprac->rewrite);
    }
//var_dump($result);
    return $result;
  }

/**
 *
 * Vrati pocet radku pro strankovani
 *
 * pouziti:
 * $pocet = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralPocetRadku", "adresa")
 *
 * @param adresa adresa sablony
 * @return pocet polozek obsahu v sablone
 */
  public function CentralPocetRadku($nastaveni)
  {
    $adresa = $nastaveni["adresa"];

    $subobsah = $nastaveni["subobsah"];
    $subobsahradio = $nastaveni["subobsahradio"];

    $sablona = $this->VypisHodnotu("id", "sablona", $adresa, "adresa=");

//cheat
    //zobrazovani jen urcitych id z obsahu
    $idobsah = "";
    if (!Empty($subobsah))
    {
      $sub = implode(", ", $this->NajdiAdrescontent($subobsah, $retdata->id));
      $idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
    }

    //zobrazovani urcitych id podle prepnute skupiny obsahu
    if (!Empty($subobsahradio))
    {
      $sub = implode(", ", $this->NajdiRadiocontent($subobsahradio, $retdata->id));
      $idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
    }

    //zobrazovani urcitych obsahu podle id
    if (is_array($subid))
    {
      $sub = implode(", ", $subid);
      $idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
    }

//dodelat!! zkontrolovat!
    $result->pocet = $this->VypisHodnotu("COUNT(id)", "obsah", $sablona, "sablona=");

    return $result;
  }

/**
 *
 * Vykreslovani vyhledavaciho formulare
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearchForm"[, array("tvar" => "tvar")]);
 *
 *  @param tvar nazev tvaru
 * @return formular pro hledani
 */
  public function CentralSearchForm($nastaveni = array())
  {
    $tvar = $nastaveni["tvar"];

    $result = "";
    if (!$this->var->aktivniadmin)
    {
      $post = $this->NotEmpty("post", $this->post_search);
      $get = $this->NotEmpty("get", $this->get_search);
      $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_search_form", $tvar),
                                          $this->post_search,
                                          rawurldecode($this->PrepisTextu(!Empty($post) ? $post : $get), "/[a-zA-Z0-9_ \-\.\(\)]{1}/"),
                                          $this->post_search_button);
    }

    return $result;
  }

/**
 *
 * Vypis vysledku vyhledavani
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralSearch"[, "tvar"]);
 * "RewriteRule ^hledani/(.+)/?$ ?action=hledani&search=$1 [L]"
 *
 * @param tvar nazev tvaru
 * @return vysledky vyhledavani
 */
  public function CentralSearch($nastaveni = array())
  {
    $tvar = $nastaveni["tvar"];
    //$baseurl = $nastaveni["baseurl"];
    $loadstr = $nastaveni["loadstr"];

    $result = "";
    if (!$this->var->aktivniadmin &&
        !Empty($_POST[$this->post_search]) &&
        !Empty($_POST[$this->post_search_button]))
    {
      $vyraz = $this->ChangeWrongChar($_POST[$this->post_search]);

      $result = $this->EqTv($this->unikatni, "normal_search_redirect_wait", $tvar);

      $this->AutoClick(0, $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_search_redirect", $tvar),
                                                    $this->absolutni_url,
                                                    rawurlencode($this->PrepisTextu($vyraz, "/[a-zA-Z0-9_ \-\.\(\)]{1}/"))));

    }

    if (!Empty($_GET[$this->get_search]))
    {
      $vyraz = $this->ChangeWrongChar($_GET[$this->get_search]);

      //"{$this->absolutni_url}/?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
//var_dump($_GET);
//jop tak by to nejak slo.... dodelat!!!
//$_GET[$this->var->get_kam] = "hledani";
      //presmerovani na potrebnou stranku!
      //$baseurl
//nebude prechazet mezi strankama ale jen vyrazi vykreslovani obsahu na uvodni strane
//a nebo jen nahradi, nebo vlastne ne to je blbost!
//dodelat!!!!!
//presmerovani na vyhledavaci stranku!!!?!


      $presna_adresa = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_search_fix_adres", $tvar),
                                                $this->absolutni_url);



      $konverze = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_search_konverze", $tvar),
                                            $vyraz);

      if ($res = $this->queryMultiObjectSingle("SELECT o.id id, s.adresa adresa, o.sablona sablona, o.menu menu,
                                                o.obsah obsah, o.konfig konfig, o.typy typy
                                                FROM {$this->dbpredpona}sablona s, {$this->dbpredpona}obsah o
                                                WHERE s.id=o.sablona AND
                                                o.obsah LIKE '%{$vyraz}%';"))
      {
        //prochazeni obsahu
        $row = array();
        $sumsearch = 0;
        foreach ($res as $data)
        {
          if (!Empty($loadstr[$data->adresa]))
          {
            if ($data->menu > 0)
            { //strankovani pro obsahy menu
//dodelat!!!
//slozitejsi vyhledavani!! a pocitani strankovani!
//musi se brat cislo menu a dle toho generovat adresu a dle nejake adresy zjistovat kolik
//dane zanoreni ma strankovani a jake vubec (kazdy obsah spada do urciteho menu)
//bude se teda vypisovat je zadana uroven menu pro vypsani id na propocet strankovani
            }
              else
            { //strankovani pro obycejne obsahy
              if ($r = $this->queryMultiObjectSingle("SELECT o.id id
                                                      FROM {$this->dbpredpona}obsah o
                                                      WHERE
                                                      sablona='{$data->sablona}';"))
              {
                $ro = array();
                foreach ($r as $d)
                {
                  $ro[] = $d->id;
                }
                //priprava pole a rozdeleni podle strankovani
                $na_stranku = $loadstr[$data->adresa];
                settype($na_stranku, "integer");
                $str_umisteni = array_chunk($ro, $na_stranku);
              }
            }
          }

          $typy = explode($this->obsexplode, $data->typy);
          $obsah = explode($this->obsexplode, $data->obsah);
          //projde typy a vybere obrazky
          foreach ($typy as $index => $typ)
          {
            $value = explode($this->valexplode, $obsah[$index]);
            //akceptovat volbu vyhledavani u konfigurace elementu (az u nove verze!)
            switch ($typ)
            {
/* dodelat!!! pozdeji rozsirit, zatim vyblokovano
              case "minitext":
              case "fulltext":
                //var_dump($obsah);
                var_dump($typ, $value);
              break;

              case "datum":
              case "cas":
              case "datumcas":
                var_dump($typ, $value);
              break;

              case "url":
              case "rewrite":
                $val = $value[0];
                $poc = mb_substr_count($val, $vyraz, "UTF-8");
                if ($poc > 0)
                {
                  //var_dump($obsah);
                  var_dump($typ, $value);
                }
              break;
*/

              case "minitext":
              case "fulltext":
              case "tinymce":
              case "wymeditorlite":
              case "minitextlite":
              case "fulltextlite":
                $val = $value[0];
                $poc = mb_substr_count($val, $vyraz, "UTF-8");
                if ($poc > 0)
                {
                  //vypichnuti casti textu prvniho vysledku
                  $ptext = mb_strpos($val, $vyraz, 0, "UTF-8");
                  $predza = 20;
                  $part = mb_substr($val, ($ptext < $predza ? 0 : $ptext - $predza), mb_strlen($vyraz) + (2 * $predza), "UTF-8");

                  if ($data->menu > 0)
                  {
                    $idmenu = $this->RekurzivniStoupani($data->menu);
                    $adr = array();
                    foreach ($idmenu as $ide)
                    {
                      $adr[] = $this->VypisHodnotu("rewrite", "menu", $ide);
                    }
                    $url = implode("/", $adr);
                    $link = "{$presna_adresa[$data->sablona]}{$url}";
//dodelat!!
//pri detekci strankovani podle definovane adresy
//si vezme pocet stranek a na stranku, vypise si na pozadi cely dany obsah
//a porozdeluje si vypis id z db
//var_dump($data->id);
//dodelat!! by se melo nejak i dat rozsirit do menu polozek obsahu
                  }
                    else
                  {
                    $link = $presna_adresa[$data->sablona];
                    //hledani strankovani pro obyc sablony
                    $strana = "";
                    foreach ($str_umisteni as $str => $strarray)
                    { //hleda aktualni id v poli indexu
                      $idx = array_search($data->id, $strarray);
                      //pokud nalezne inde
                      if (is_numeric($idx))
                      {
                        $strana = $str + 1;
                        break;
                      }
                    }
                    //dodelat!! mozna optimalizovat a nebo zuniverzalnit

                    if (!Empty($strana))
                    {
                      $link .= "/{$strana}";
                    }
                  }

                  //html_entity_decode(html_entity_decode(, ENT_QUOTES, "UTF-8"), ENT_QUOTES, "UTF-8")
                  $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_search_{$typ}", $tvar),
                                                    html_entity_decode($part, ENT_QUOTES, "UTF-8"),
                                                    $poc,
                                                    html_entity_decode($val, ENT_QUOTES, "UTF-8"),
                                                    $link);

                  $sumsearch += $poc; //zapocitani vysledku
                }
              break;
            }
          }
        }

        //konverze vysledku
        $row = preg_replace(array_keys($konverze), array_values($konverze), $row);
        //obal vysledku
        $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_search", $tvar),
                                            $sumsearch,
                                            implode("", $row));
      }
        else
      {
        $result = $this->EqTv($this->unikatni, "normal_vypis_search_null", $tvar);
      }
    }

    return $result;
  }

/**
 *
 * Obsluhuje download souboru pro danou adresu sablony
 *
 * pouziti:
 * $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDownload", "adresa");
 *
 * @param adresa naadresovani obsahu
 */
  public function CentralDownload($adresa)
  {
    if (!Empty($adresa) &&
        !$this->var->aktivniadmin)
    {
      //obsluha stahovani souboru
      $get_down = $this->NotEmpty("get", $this->get_down);
      //pokud neni dogn get prazdny
      if (!Empty($get_down))
      { //dekodovani a overeni adresy sablony
        $unkod = explode("::", base64_decode($get_down));
        $soubor = $unkod[1];
        //porovnani adresy a overeni existence
        if ($adresa == $unkod[0] &&
            file_exists($soubor))
        {
          $nazev = basename($soubor);
          header("Content-Description: File Transfer");
          header("Content-Type: application/force-download");
          header("Content-Disposition: attachment; filename=\"{$nazev}\"");
          readfile($soubor); //vycte soubor
          exit(0);
        }
      }
    }
  }

//dodelat!!!!
//prvni test na private pak centralizovat
  private function RazeniSouboru($pole, $razeni = array("name", "asc"))
  {
    //["path"]
    //["file"]
    //["name"]
    $result = "";
    switch ($moznosti[0])
    {
      case "none":  //neradi
      break;
//dodelat!! centralizovat!!!
      case "date asc":
      case "date desc":
        $casy = array();
        foreach ($file as $i => $soubor)
        {
          $casy[$i] = filemtime("{$this->dirpath}/{$this->pathfile}/{$soubor}");
        }
        //serazeni dle typu
        switch ($moznosti[0])
        {
          case "date asc":
            asort($casy);
          break;

          case "date desc":
            arsort($casy);
          break;
        }
        //nacteni klicu
        $klice = array_keys($casy);
      break;

      case "name asc":
      case "name desc":
        $nazvy = array();
        foreach ($name as $i => $nazev)
        { //radi podle malich pismen
          $nazvy[$i] = mb_strtolower($nazev, "UTF-8");
        }
        //serazeni dle typu
        switch ($moznosti[0])
        {
          case "name asc":
            asort($nazvy);
          break;

          case "name desc":
            arsort($nazvy);
          break;
        }
        //nacteni klicu
        $klice = array_keys($nazvy);
      break;
    }

    return $result;
  }

/**
 *
 * Centralni generovani elementu na vystup do stranek
 *
 * @param konfigurace pole konfigurace elementu
 * @param obsah pole obsahu elementu
 * @param typy pole typu obsahu
 * @param nastaveni pole nastaveni pro vykreslonani
 * @return pole elementu
 */
  private function GenerovaniPublicElementu($konfigurace, $obsah, $typy, $nastaveni)
  {
    $tvar = $nastaveni["tvar"]; //cislo tvaru
    $adresa = $nastaveni["adresa"]; //adresa sablony/?
    //$kontrola = $nastaveni["kontrola"]; //bool na aplikaci konvetru konvertu znaku
    $baseurl = $nastaveni["baseurl"]; //zacinajici adresa
    $idobsah = $nastaveni["id"];  //id cislo aktualniho obsahu

/*
case "checkgroup":
  $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
  $hodnoty = explode($this->valexplode, $obsah[$indextyp]);
  //vypise jen ty oznacene prvky
  foreach ($hodnoty as $hodnota)
  {
    if (!Empty($hodnota))
    {
      $pole[] = $hodnota;
    }
  }

  $val = implode($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_checkgroup", $sablona), $pole);
  $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
break;

case "download":
  $val = explode($this->valexplode, $obsah[$indextyp]);
  //rozdeleni na subpole
  $nazev = array_slice($val, 0, count($val) / 3);
  $file = array_slice($val, count($val) / 3, count($val) / 3);
  $popis = array_slice($val, (count($val) / 3) * 2);
  $row = array();
  foreach ($nazev as $i => $naz)
  {
    $a = explode(".", $file[$i]);  //rozdeleni podle tecky
    $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_download", $sablona),
                                      $naz,
                                      $file[$i],
                                      $popis[$i],
                                      "{$this->dirpath}/{$this->pathfile}/{$file[$i]}",
                                      strtolower($a[count($a) - 1]),
                                      $this->absolutni_url);
  }
  //slouceni hodnot do radku
  $ret[] = implode("", $row);
break;
*/

    $ret = array();
    //nacitani zakladnich tvaru
    foreach ($typy as $indextyp => $typ)
    {
      //prochazeni typu
      switch ($typ)
      {
        case "checkbox":
          $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
          //prepnuti moznosti podle ulozene hodnoty
          $val = $moznosti[($obsah[$indextyp] == "checkbox:1" ? 0 : 1)];
          $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
        break;
//?!! dodelat!! dotestovat!!!
        case "checkgroup":
          list($popis, $hodnoty) = $this->RozdelitHodnoty(explode($this->cfgexplode, $konfigurace[$indextyp]), 2, 2);
          $val = explode($this->valexplode, $obsah[$indextyp]);
          //vypis hodnot prvku
          $row = array();
          foreach ($hodnoty as $i => $hodnota)
          {
            $roz = explode($this->group_sep, $hodnota); //rozdeleni bool hodnot
            $stav = ($roz[0] == $val[$i] ? $roz[0] : $roz[1]);  //nacitani stavu
            $row[] = html_entity_decode(html_entity_decode($stav, NULL, "UTF-8"));
          }
          $ret[] = implode("", $row);
        break;
//?!! dodelat!! dotestovat!!!
        case "conectmodule":
          $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
          $modul = explode(":", $moznosti[0]);  //rosekani na pole
          $param = explode("|", $moznosti[1]);

          //prime pripojovani k modulu
          if (method_exists($modul[0], $modul[1]))
          { //zavolani funkce, + prevedeni @@_@@ promennych
            $ret[] = $this->var->main[0]->NactiFunkci($modul, $this->PrevodUnikatnihoTextu($param,
                                                                                          __METHOD__,
                                                                                          $data->id));
          }
            else
          {
            $ret[] = "---";
          }
        break;

        case "datum":
        case "datumcas":
          $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
          //vypis naformatovaneho datumu
          $datum = $this->InterpretDate($obsah[$indextyp], $moznosti[0], $moznosti[1], $moznosti[2], $moznosti[3]);
          $ret[] = html_entity_decode(html_entity_decode($datum, NULL, "UTF-8"));
        break;

        case "cas":
          //vypis naformatovaneho casu
          $cas = $this->InterpretTime($obsah[$indextyp], $konfigurace[$indextyp]);
          $ret[] = html_entity_decode(html_entity_decode($cas, NULL, "UTF-8"));
        break;

        case "radio":
        case "radiocontent":
        case "select":
        case "hiddentext":
        case "adrescontent":
        case "automazani":
        case "minitextlite":
        case "fulltextlite":
          //vypise obsahu elementu
          $val = $obsah[$indextyp];
          $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
        break;

        case "wymeditorlite":
          $val = $obsah[$indextyp];
          $ret[] = html_entity_decode(html_entity_decode($val, ENT_QUOTES, "UTF-8"));
        break;

        case "tinymce":
          $val = $obsah[$indextyp];
          $ret[] = html_entity_decode(html_entity_decode($val, ENT_QUOTES, "UTF-8"), ENT_QUOTES, "UTF-8");
        break;

        case "minitext":
          $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
          $val = $obsah[$indextyp];
          //prepis textu podlo konfigurace
          if ($moznosti[2] > 0) //pocet
          {
            //extrahuje z pole potrebnou konfiguraci, 3 poc
            list($search, $replace) = $this->RozdelitHodnoty($moznosti, 2, 3);
            //nahrazeni zadanym polem
            $prevod = str_replace($search, $replace, $val);
          }
            else
          {
            $prevod = $val;
          }
          $zkrac = $this->ZkraceniTextu($prevod, $moznosti[0], $moznosti[1]);
          //vypise zkraceny text a prepsany text
          $ret[] = html_entity_decode(html_entity_decode($zkrac, NULL, "UTF-8"));
          $ret[] = html_entity_decode(html_entity_decode($prevod, NULL, "UTF-8"));
        break;

        case "fulltext":
          $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
          $val = $obsah[$indextyp];
          //prepis textu podlo konfigurace, 0 min, 1 max
          if ($moznosti[4] > 0) //pocet
          {
            //extrahuje z pole potrebnou konfiguraci
            list($search, $replace) = $this->RozdelitHodnoty($moznosti, 2, 5);
            //nahrazeni zadanym polem
            $prevod = str_replace($search, $replace, $val);
          }
            else
          {
            $prevod = $val;
          }
          $zkrac = $this->ZkraceniTextu($prevod, $moznosti[2], $moznosti[3]);
          //vypise zkraceny text a prepsany text
          $ret[] = html_entity_decode(html_entity_decode($zkrac, NULL, "UTF-8"));
          $ret[] = html_entity_decode(html_entity_decode($prevod, NULL, "UTF-8"));
        break;

        case "foto":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          if (Empty($val[0]))
          {
            $val[0] = $val[1];  //pokud je own prazdne pouzije [1]
          }
          //vypis hlavniho mini a full obrazku + serie
          if (is_file("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$val[1]}"))
          {
            $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_foto", $tvar),
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$val[0]}",
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$val[1]}");
          }
            else
          {
            $ret[] = "";
          }
          $ret[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$val[0]}";
          $ret[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$val[1]}";
        break;

        case "onefoto":
          $val = $obsah[$indextyp];
          if (is_file("{$this->dirpath}/{$this->pathpicture}/{$val}"))
          {
            $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_onefoto", $tvar),
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$val}");
          }
            else
          {
            $ret[] = "";
          }
          $ret[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$val}";
        break;

        case "seriefoto":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          //nacteni a rozdeleni pole po 2
          $obr = array_chunk(array_slice($val, 0, (count($val) / 3) * 2), 2);
          $pop = array_slice($val, (count($val) / 3) * 2);
          //prochazeni obrazku
          $row = array();
          foreach ($pop as $i => $popis)
          {
            if (Empty($obr[$i][0]))
            {
              $obr[$i][0] = $obr[$i][1];  //pokud je own prazdne pouzije [1]
            }
            $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_seriefoto_row", $tvar),
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[$i][0]}",
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[$i][1]}",
                                              html_entity_decode(html_entity_decode($popis, NULL, "UTF-8")));
          }
          $ret[] = implode("", $row);
        break;

        case "oneseriefoto":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          $obr = array_slice($val, 0, count($val) / 2);
          $pop = array_slice($val, count($val) / 2);
          //prochazeni obrazku
          $row = array();
          foreach ($obr as $i => $polozka)
          {
            $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_oneseriefoto_row", $tvar),
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$polozka}",
                                              html_entity_decode(html_entity_decode($pop[$i], NULL, "UTF-8")));
          }
          $ret[] = implode("", $row);
        break;
//?!! dodelat!! dotestovat!!!
        case "download":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          $name = array_slice($val, 0, count($val) / 3);
          $file = array_slice($val, count($val) / 3, count($val) / 3);
          $popis = array_slice($val, (count($val) / 3) + (count($val) / 3));
          //nacteni defaultnich klicu
          $klice = range(0, count($name) - 1);
          $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
          switch ($moznosti[0])
          {
            case "none":  //neradi
            break;
//dodelat!! centralizovat!!! dodelat!!!
            case "date asc":
            case "date desc":
              $casy = array();
              foreach ($file as $i => $soubor)
              { //{$this->absolutni_url}
                $casy[$i] = filemtime("{$this->dirpath}/{$this->pathfile}/{$soubor}");
              }
              //serazeni dle typu
              switch ($moznosti[0])
              {
                case "date asc":
                  asort($casy);
                break;

                case "date desc":
                  arsort($casy);
                break;
              }
              //nacteni klicu
              $klice = array_keys($casy);
            break;

            case "name asc":
            case "name desc":
              $nazvy = array();
              foreach ($name as $i => $nazev)
              { //radi podle malich pismen
                $nazvy[$i] = mb_strtolower($nazev, "UTF-8");
              }
              //serazeni dle typu
              switch ($moznosti[0])
              {
                case "name asc":
                  asort($nazvy);
                break;

                case "name desc":
                  arsort($nazvy);
                break;
              }
              //nacteni klicu
              $klice = array_keys($nazvy);
            break;
          }
          //vypis souboru
          $row = array();
          foreach ($klice as $index => $i)
          { //{$this->absolutni_url} {$this->AdresarWebu()}
            $cesta = "{$this->dirpath}/{$this->pathfile}/{$file[$i]}";
            $kod = base64_encode("{$adresa}::{$cesta}");
//var_dump("{$this->AdresarWebu()}/{$cesta}");overovani bez: {$this->absolutni_url}
//ceska k souboru s: {$this->absolutni_url}
            if (is_file($cesta))
            {
              $datum = date($this->EqTv($this->unikatni, "normal_vypis_download_date", $tvar), @filemtime($cesta));
              $velikost = $this->Velikost(@filesize($cesta));
              $a = explode(".", $file[$i]); //rozdeleni nazvu
              $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_download_row", $tvar),
                                                "{$this->absolutni_url}?{$this->get_down}={$kod}",
                                                $name[$i],
                                                html_entity_decode(html_entity_decode($popis[$i], NULL, "UTF-8")),
                                                strtolower($a[count($a) - 1]),
                                                $datum,
                                                $velikost);
            }
          }
          $ret[] = implode("", $row);
        break;
//?!! dodelat!! dotestovat!!!
        case "flash": //dodelat!!
          $ret[] = "hele tu je imaginarni flash-ka :D";
        break;

        //case "upload"

        case "csssprit":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          $obr = $val[0];
          $w = $val[1];
          $h = $val[2];
          $w2 = $w / 2;
          $h2 = $h / 2;

          if (is_file("{$this->dirpath}/{$this->pathpicture}/{$obr}"))
          {
            $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_csssprit", $tvar),
                                              "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$obr}",
                                              $w, $h,
                                              $w2, $h2);
          }
            else
          {
            $ret[] = "";
          }

          $ret[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$obr}";  //cesta
          $ret[] = $w; //w
          $ret[] = $h; //h
          $ret[] = $w2; //w/2
          $ret[] = $h2; //h/2
        break;

        case "rewrite":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          //nacteni id menu a rekurzivni vystupani adresy a ignorace 0.zanoreni
          $polemenu = array_slice($this->RekurzivniStoupani($this->VypisHodnotu("menu", "obsah", $idobsah)), 1);
          $rewrite = array();
          foreach ($polemenu as $polozka)
          { //vygenerovani subadresy pro odkaz
            $rewrite[] = $this->VypisHodnotu("rewrite", "menu", $polozka);
          }
          //dodani posledni casti adresy
          $rewrite[] = $val[1];
          //slouceni s lomitkem
          $rewrite = implode("/", $rewrite);

          $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_rewrite", $tvar),
                                            $val[0],
                                            "{$this->absolutni_url}{$baseurl}{$rewrite}");

          $ret[] = "{$this->absolutni_url}{$baseurl}{$rewrite}";
          $ret[] = $val[0];
          $ret[] = $val[1];
        break;

        case "url":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_url", $tvar),
                                            $val[0],
                                            $val[1],
                                            ($val[2] ? " onclick=\"this.target='_blank'\"" : ""));
          $ret[] = $val[0];
          $ret[] = $val[1];
          $ret[] = ($val[2] ? " onclick=\"this.target='_blank'\"" : "");
        break;

        case "externalfile":
          $ret[] = "{$typ}:{$indextyp}";
        break;
/*
        case "externalfile":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          $row = array();
          foreach ($val as $kod)
          {
            $path = base64_decode($kod);
            if (is_file($path))
            {
              $down = base64_encode($this->ZakodujText("{$adresa}::{$path}"));
              $velikost = $this->Velikost(@filesize($path));
              $datum = date($this->EqTv($this->unikatni, "normal_vypis_externalfile_date", $tvar), @filemtime($path));
              $a = explode(".", $path);  //rozdeleni podle tecky
              $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_externalfile_row", $sablona),
                                                "{$this->absolutni_url}?{$this->get_down}={$down}",
                                                $path,
                                                basename($path),
                                                strtolower($a[count($a) - 1]),
                                                $datum,
                                                $velikost);
            }
          }
          //slouceni hodnot do radku
          $ret[] = implode("", $row);
        break;
*/
      }

    }

    //druhe prochazeni a vkladani prvnich obsahu do specifictejsich elementu
    foreach ($typy as $indextyp => $typ)
    {
      //prochazeni typu
      switch ($typ)
      {
        case "externalfile":
          $val = explode($this->valexplode, $obsah[$indextyp]);
          $row = array();
          foreach ($val as $kod)
          {
            $path = base64_decode($kod);
            if (is_file($path))
            {
              $down = base64_encode("{$adresa}::{$path}");
              $velikost = $this->Velikost(@filesize($path));
              $datum = date($this->EqTv($this->unikatni, "normal_vypis_externalfile_date", $tvar), @filemtime($path));
              $a = explode(".", $path);  //rozdeleni podle tecky

              $pole = array("array_args",
                            "{$this->absolutni_url}?{$this->get_down}={$down}",
                            $path,
                            basename($path),
                            strtolower($a[count($a) - 1]),
                            $datum,
                            $velikost);
              $pole = array_merge($pole, $ret);

              $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_externalfile_row", $tvar),
                                                $pole);
            }
          }
          //slouceni hodnot do radku
          $ret[$indextyp] = implode("", $row);
        break;
      }
    }

    return $ret;
  }

/**
 *
 * Nacitani hodnot entych
 *
 * @param konfigurace pole konfigurace funkce
 * @return objekt nactenych entych
 */
  private function GenerovaniPublicLoadEnte($konfigurace)
  {
    $result = (object)"";
    $tvar = $konfigurace["tvar"];
    $result->prvni = $this->EqTv($this->unikatni, "normal_vypis_prvni", $tvar);
    $result->key_prvni = array_keys($result->prvni);

    $result->posledni = $this->EqTv($this->unikatni, "normal_vypis_posledni", $tvar);
    $result->key_posledni = array_keys($result->posledni);

    $result->ente_def_array = $this->EqTv($this->unikatni, "normal_vypis_ente_def_array", $tvar);
    $result->ente_def = $this->EqTv($this->unikatni, "normal_vypis_ente_def", $tvar);
    $result->key_ente_def = array_keys($result->ente_def);

    $result->ente_od = $this->EqTv($this->unikatni, "normal_vypis_ente_od", $tvar);
    $result->ente_po = $this->EqTv($this->unikatni, "normal_vypis_ente_po", $tvar);
    //$result->ente_po = ($result->ente_po == 0 ? 1 : $result->ente_po);  //osetreni proti delani nulou
    $result->ente_break = $this->EqTv($this->unikatni, "normal_vypis_ente_break", $tvar);
    $result->poc = $this->EqTv($this->unikatni, "normal_vypis_begin_poc", $tvar);

    $result->posun = range(0, 9); //dorovnani pole, na puvodni cislovani
    $result->count = $konfigurace["count"];

    return $result;
  }

/**
 *
 * Pocitani a zpracovani entych
 *
 * @param konfigurace pole konfigurace funkce
 * @return objekt zpracovanych entych
 */
  private function GenerovaniPublicEnte($konfigurace)
  {
    $result = (object)"";
    $tvar = $konfigurace["tvar"];
    $result->poc = $konfigurace["poc"];
    $result->poci = $konfigurace["poci"];
    $loadente = $konfigurace["loadente"];

    //nacteni tvaru entych
    $lente = $this->EqTv($this->unikatni, "normal_vypis_ente", $tvar);
    //dosazovani hodnot pocitani do entych
    foreach ($lente as $index => $hodnota)
    {
      $ente = $this->NactiUnikatniObsah($hodnota, $result->poc[$index]);
      //vyhodnocovani podminky
      $podm_ente = ((($result->poci + $loadente->ente_od[$index]) % $loadente->ente_po[$index]) == $loadente->ente_break[$index]);
      if ($podm_ente)
      { //pocitani linearni ente
        $result->poc[$index]++;
      }
      //nacitani pole entych, musi ignorovat posledni polozku!
      //$result->array_ente[$index] = ($podm_ente && $result->poci != $loadente->count ? $ente : "");
      $result->array_ente[$index] = ($podm_ente ? $ente : "");
    }

    $result->array_prvni = ($result->poci == 0 ? $loadente->prvni : array_fill_keys($loadente->key_prvni, ""));
    $result->array_posledni = ($result->poci == $loadente->count ? $loadente->posledni : array_fill_keys($loadente->key_posledni, ""));
    $result->array_ente_def = (in_array($result->poci, $loadente->ente_def_array) ? $loadente->ente_def : array_fill_keys($loadente->key_ente_def, ""));

    $result->poci++;

    return $result;
  }

/**
 *
 * Hlavni vypis obsahu sablony pro danou adresu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", "adresa"[, "baseurl/", true|false, array("dalsi index"), $strankovani, 1]);
 *
 * @param nastaveni konfiguracni pole array("adresa", "subobsah", "baseurl", "skryvat", "pridavek", "strankovani", "tvar")
 * @return nadefinovany vypis
 */
  public function Central($nastaveni)
  {
    $adresa = $nastaveni["adresa"];

    $subobsah = $this->NotEmpty($nastaveni, "subobsah");//$nastaveni["subobsah"];
    $subobsahradio = $this->NotEmpty($nastaveni, "subobsahradio");//$nastaveni["subobsahradio"];

      $subid = $this->NotEmpty($nastaveni, "subid");//$nastaveni["subid"];
      $subpoc = $this->NotEmpty($nastaveni, "subpoc");//$nastaveni["subpoc"];

    $baseurl = $this->NotEmpty($nastaveni, "baseurl");//$nastaveni["baseurl"];
    $skryvat = $this->NotEmpty($nastaveni, "skryvat");//$nastaveni["skryvat"];
    $pridavek = $this->NotEmpty($nastaveni, "pridavek");//$nastaveni["pridavek"]
    $pridavek_obal = $this->NotEmpty($nastaveni, "pridavek_obal");//$nastaveni["pridavek_obal"];
    $strankovani = $this->NotEmpty($nastaveni, "strankovani");//$nastaveni["strankovani"];
    $tvar = $this->NotEmpty($nastaveni, "tvar");//$nastaveni["tvar"];

    //nacteni strankovani
    $limit = $str = "";
    if (!Empty($strankovani))
    {
      list($str, $limit) = $strankovani;
    }
//$kontrola = true;

//dodelat!!
//akceptovat celou adresu a nebo dane id a nebo rozsah id!!!
//jazyky?! - je jiny level zatim
//blbne nulta polozka

    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "sablona", $adresa) &&  //kontrola existence
        !$this->var->aktivniadmin &&
        ($skryvat ? Empty($_GET[$this->get_menu]) : true))
    {
      //nacteni hodnot ze sablony
      $retdata = $this->ControlObjectHodnoty(array("id", "razeni", "jazyky", "formenu", "konfigurace", "nazev", "popis"),
                                            array("sablona", $adresa, "adresa="));

///pripadne po upgradech tady to nastaveni musi byt stejny i u pocet polozke na stranku,
//jinak se strankovani a zobrazovani desinchronizuje
//cheat
      //zobrazovani jen urcitych id z obsahu
      $idobsah = "";
      if (!Empty($subobsah))
      {
        $sub = implode(", ", $this->NajdiAdrescontent($subobsah, $retdata->id));
        $idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
      }

      //zobrazovani urcitych id podle prepnute skupiny obsahu
      if (!Empty($subobsahradio))
      {
        $sub = implode(", ", $this->NajdiRadiocontent($subobsahradio, $retdata->id));
        $idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
      }

      //zobrazovani urcitych obsahu podle id
      if (is_array($subid))
      {
        $sub = implode(", ", $subid);
        $idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
      }

      //nacteni archivace a aktivace ze sablony
      $archivace = $this->HodnotaKonfiguraceSablony("archivace", $retdata->konfigurace);
      $aktivace = $this->HodnotaKonfiguraceSablony("aktivace", $retdata->konfigurace);
//dodelat!! jak to bude s jazykem? ,o.jazyk jazyk
      if ($res = $this->queryMultiObjectSingle("SELECT o.id id, o.konfigurace konfigurace, o.obsah obsah, o.konfig konfig, o.typy typy
                                                FROM {$this->dbpredpona}sablona s, {$this->dbpredpona}obsah o
                                                WHERE s.id=o.sablona AND
                                                s.adresa='{$adresa}'{$idobsah}
                                                ORDER BY o.{$retdata->razeni}
                                                {$limit};"))
      {
        //nacitani entych
        $retloadente = $this->GenerovaniPublicLoadEnte(array("tvar" => $tvar, "count" => (count($res) - 1)));

        $fullret = array();
        $retente = (object)"";
        $retente->poci = 0;
        $retente->poc = $retloadente->poc;
        //prochazeni obsahu
        foreach ($res as $data)
        { //zobrazeni podle aktivace a archivace
          if (($archivace ? !$this->HodnotaKonfiguraceObsahu("archivace", $data->konfig) : true) &&
              ($aktivace ? $this->HodnotaKonfiguraceObsahu("aktivace", $data->konfig) : true))
          {
            //pripraveni konfiguracniho pole
            $konfigurace = explode($this->obsexplode, $data->konfigurace);
            $obsah = explode($this->obsexplode, $data->obsah);
            $typy = explode($this->obsexplode, $data->typy);
            //pocitani entych
            $retente = $this->GenerovaniPublicEnte(array("tvar" => $tvar, "poci" => $retente->poci, "poc" => $retente->poc, "loadente" => $retloadente));

            //incializace pole radku
            $ret = array("array_object",
                        "absolutni_url" => $this->absolutni_url,
                        "id" => $data->id,
                        "poc" => $retente->poci,
//dodelat!!! nacitovane!!!, tak to proste nebude!!!
                        "subprvni" => ($subpoc == 0 && $retente->poci == 1 ? "prvni" : ""),
                        );

            $pole = array("tvar" => $tvar,
                          "adresa" => $adresa,
                            //"kontrola" => $kontrola,
                          "baseurl" => $baseurl,
                          "id" => $data->id);
            //vygenerovani elementu obsahu
            $elem = $this->GenerovaniPublicElementu($konfigurace, $obsah, $typy, $pole);
            //slouceni elementu a obsahu
            $ret = array_merge($ret, $retloadente->posun, $elem,
                              $retente->array_prvni, $retente->array_posledni,
                              $retente->array_ente_def, $retente->array_ente);

            //pridavek do kazde polozky, jako asoc pole a=>b
            if (!Empty($pridavek) &&
                is_array($pridavek))
            {
              $ret = array_merge($ret, $pridavek); //slouceni pole, hlavni+pridavek
            }

            //pridavani do pole vypisu polozek
            $fullret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis", $tvar),
                                                  $ret);
          }
        }

        $pole_obal = array ("array_object",
                            "nazev" => $retdata->nazev,
                            "popis" => $retdata->popis,
                            "vypis" => implode("", $fullret),  //slouceni nactenych polozek
                            "strankovani" => $str);

        //pridavek do kazde polozky, jako asoc pole a=>b
        if (!Empty($pridavek_obal) &&
            is_array($pridavek_obal))
        {
          $pole_obal = array_merge($pole_obal, $pridavek_obal); //slouceni pole, hlavni+pridavek
        }

        //vlozeni a slouceni finalniho vypisu a vlozeni strankovani
        $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_obal", $tvar),
                                            $pole_obal);
      }
        else
      {
        $result = $this->EqTv($this->unikatni, "normal_vypis_obal_null", $tvar); //null obsah
      }
    }

    return $result;
  }

/**
 *
 * Jednotne pristupovani z zobrazeni od obsahu
 *
 * @param nastaveni pole nastaveni
 * @return
 */
  private function ZpracovaniCentralMenuObsah($nastaveni)
  {
    $adresa = $nastaveni["adresa"];

    $subobsah = $nastaveni["subobsah"]; //$this->NotEmpty($nastaveni, "subobsah");//
    $subobsahradio = $nastaveni["subobsahradio"];

//dodelat!! docasny cheat!
    $submenu_od = (int)$this->NotEmpty($nastaveni, "submenu_od");//(!is_null($nastaveni["submenu_od"]) ? $nastaveni["submenu_od"] : 0);
    $submenu_only = (int)$this->NotEmpty($nastaveni, "submenu_only");//(!is_null($nastaveni["submenu_only"]) ? $nastaveni["submenu_only"] : 0);

    $result = "";

    //nacteni hodnot z menu + detekce prislusnosti k danemu menu
    $retdata = $this->ControlObjectHodnoty(array("id", "sablona", "rewrite", "defaultni", "konfigurace"), //"nazev", "rewrite", "zanoreni", "koren"
                                          array("menu", $adresa, "adresa="));
    $idmenu = $this->RekurzivniKlesani($retdata->id);

    $endid = -1;

    //nastaveni pro defaultni oznacovani polozky menu/obsahu
    $oznacit_defaultni = $this->HodnotaKonfiguraceMenu("oznacit_defaultni", $retdata->konfigurace);

    //najde defaultni polozku pro prednastavene zanoreni a relevantni skupinu id
    if ($oznacit_defaultni > 0) //jen mimo zakladni sekci
    {
      $idinmenu = implode(", ", $idmenu);
      $endid = $this->VypisHodnotu("id", "menu", NULL, "defaultni='1' AND zanoreni='{$oznacit_defaultni}' AND id IN ({$idinmenu})");
    }
      else
    { //musi vzit jen sam sebe
      if ($oznacit_defaultni == 0)
      {
        $endid = $retdata->id;
      }
    }

    //rozdeleni adresy z getu pro synchronizaci + zjisteni zanoreni
    $getarray = explode("/", $this->NotEmpty("get", $this->get_menu));  //$_GET[$this->get_menu]
    $zanoreni = count($getarray);
    //prochazi a kontroluje jen relevantni id menu
    $nalezeno = false;
    foreach ($idmenu as $id)
    { //pokud je zanoreni vys jak koren
      $zan = $zanoreni - 1;
      if (!Empty($getarray[$zan]))
      {
        $rewrite = $this->VypisHodnotu("rewrite", "menu", NULL, "zanoreni='{$zanoreni}' AND id='{$id}'");
        if ($getarray[$zan] == $rewrite)
        {
          $endid = $id;
          $nalezeno = true;
        }
      }
    }
    settype($endid, "integer");

//dodelat!!
//nemuze vracet pole z get ale nactene z defaultni!! a kdyz uz tak celou podadresu
    $result->rewrite = $this->VypisHodnotu("rewrite", "menu", $endid);
    //var_dump($this->RekurzivniKlesani($endid));

    //nastaveni pro rozbalovani sub obsahu
    $zobrazit_submenu_obsah = $this->HodnotaKonfiguraceMenu("zobrazit_submenu_obsah", $retdata->konfigurace);

    //povolovani filtrovani obsahu
    if ($zobrazit_submenu_obsah)
    { //zobrazuje vsechny nize vnorene obsahy s id

      //cheat
      settype($submenu_od, "integer");
      settype($submenu_only, "integer");


      $zan = $this->VypisHodnotu("zanoreni", "menu", $endid);

      $sub = $this->RekurzivniKlesani($endid);

//dodelat!!!
//cheaty!!! prilis nespolehlive !!! predelat!!!

      //blokovat jen do dotycneho zanoreni
      if ($submenu_od > 0)  //jen pokud je vetsi jak 1, 0 je totoz defaultne
      {
        if ($zan >= $submenu_od)
        {
          $submenu_od = 0;
        }
        $sub = array_slice($sub, $submenu_od);
      }

      //blokovani vyssich urovni
      if ($submenu_only > 0)
      { //vezme jen 0, pocet 1(pocet X)
        $sub = array_slice($sub, 0, $submenu_only);
      }

      $sub = implode(", ", $sub);
      $result->idobsah = "o.menu IN ({$sub})";
    }
      else
    { //jinak rozklikne menu urceneho id
      $result->idobsah = "o.menu='{$endid}'";
    }


    //zobrazovani jen urcitych id z obsahu
    if (!is_null($subobsah))  //dodelat!! mozna spis kontrolovat na empty!!!!
    {
      $sub = implode(", ", $this->NajdiAdrescontent($subobsah, $retdata->sablona));
      $result->idobsah = (!Empty($sub) ? "o.id IN ({$sub})" : "");
    }

    //zobrazovani urcitych id podle prepnute skupiny obsahu
    if (!is_null($subobsahradio))
    {
      $sub = implode(", ", $this->NajdiRadiocontent($subobsahradio, $retdata->sablona));
      $result->idobsah = (!Empty($sub) ? "o.id IN ({$sub})" : "");
    }

/*
    //zobrazovani urcitych obsahu podle id
    if (is_array($subid))
    {
      $sub = implode(", ", $subid);
      $result->idobsah = (!Empty($sub) ? " AND o.id IN ({$sub})" : "");
    }
*/

//var_dump($this->VypisHodnotu("menu", "obsah o", NULL, "{$result->idobsah} LIMIT 0,1"));
//var_dump($endid);
//var_dump($search_obsah);
//var_dump($endid);
//var_dump($nalezeno);

    $result->rozkliknuto = false;
    if (!$nalezeno)
    {
      $zan = $zanoreni - 1;
      if (!Empty($getarray[$zan]))
      { //nacteni pole dostupnych sekci pro rozkliknuti
        $rewriteadresy = $this->NajdiRewrite($retdata->sablona);
        //najde rewrite adresu v poli nactenych rewritu
        $search_obsah = array_search($getarray[$zan], $rewriteadresy);

        //rozkliknuto dane polozky
        $result->idobsah = "o.id='{$search_obsah}'";
        $result->rozkliknuto = true;
      }
    }

    return $result;
  }

/**
 *
 * Hlavni vypis obsahu podle menu sablony pro danou adresu menu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", "adresa"[, "baseurl/", true|false, array("dalsi index"), $strankovani, 1]);
 *
 * @param adresa naadresovani menu
 * @param baseurl pokud se menu nachazi na jine urovni adresy
 * @param pridavek pole na pridani externich promennych
 * @param strankovani vklada se promenna prevavana ze strankovaciho modulu
 * @param tvar cislo tvaru
 * @return nadefinovany vypis
 */
  public function CentralMenuObsah($nastaveni)
  {
    $adresa = $nastaveni["adresa"];

    $subobsah = $this->NotEmpty($nastaveni, "subobsah");//$nastaveni["subobsah"]; //dodelat!! implementovat!!!
    $subobsahradio = $nastaveni["subobsahradio"];
    //submenu_od
    //submenu_only

    $baseurl = $nastaveni["baseurl"];
    //$skryvat = $nastaveni["skryvat"];
    $pridavek = $this->NotEmpty($nastaveni, "pridavek");//$nastaveni["pridavek"];
    $pridavek_obal = $this->NotEmpty($nastaveni, "pridavek_obal");//$nastaveni["pridavek_obal"];
    $strankovani = $this->NotEmpty($nastaveni, "strankovani");//$nastaveni["strankovani"];
    $tvar = $this->NotEmpty($nastaveni, "tvar");//$nastaveni["tvar"];

    //nacteni strankovani
    $limit = $str = "";
    if (!Empty($strankovani))
    {
      list($str, $limit) = $strankovani;
    }
//$kontrola = true;
//nastavovalni bool pro prepnuti rozbalovani z menu a nebo primo ze sablony (bez menu)
    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "menu", $adresa) &&  //kontrola existence
        !$this->var->aktivniadmin)
    {
      //nacteni hodnot z menu + detekce prislusnosti k danemu menu
      $retdata = $this->ControlObjectHodnoty(array("id", "sablona", "rewrite", "defaultni", "konfigurace"), //"nazev", "rewrite", "zanoreni", "koren"
                                            array("menu", $adresa, "adresa="));


      $zprac = $this->ZpracovaniCentralMenuObsah($nastaveni);

      $idobsah = $zprac->idobsah;
      $rozkliknuto = $zprac->rozkliknuto;

//tu by se mohla zadavat primo sablona pro obsahy a nebo tahane z menu!
//ale musi se vyresit schovavani obsahu!! bud schovavat a nebo pripisovat
      //nacteni hodnot ze sablony, podle nulte urovne
      $sablonadata = $this->ControlObjectHodnoty(array("razeni", "jazyky", "formenu", "konfigurace", "nazev", "popis"),
                                                array("sablona", $retdata->sablona));



      if (!Empty($sablonadata->razeni))
      {
        $razeni = "ORDER BY o.{$sablonadata->razeni}";
      }

//var_dump($zprac);
//nastavovat od kolikate urovne se bude filtrovat obsah!!!!!
//var_dump($zprac, $idobsah);

//dodelat!! nastavovat: zmiznout obsah a nebo pribalit???!!
      if ($res = $this->queryMultiObjectSingle("SELECT id, konfigurace, obsah, konfig, typy
                                                FROM {$this->dbpredpona}obsah o
                                                WHERE {$idobsah}
                                                {$razeni}
                                                {$limit};"))
      {
        //nacitani entych
        $retloadente = $this->GenerovaniPublicLoadEnte(array("tvar" => $tvar, "count" => (count($res) - 1)));

        $fullret = array();
        $retente->poci = 0;
        $retente->poc = $retloadente->poc;
        $archivace = false;
        $aktivace = false;
        //prochazeni obsahu
        foreach ($res as $data)
        {
          if (($archivace ? !$this->HodnotaKonfiguraceObsahu("archivace", $data->konfig) : true) &&
              ($aktivace ? $this->HodnotaKonfiguraceObsahu("aktivace", $data->konfig) : true))
          {
            //pripraveni konfiguracniho pole
            $konfigurace = explode($this->obsexplode, $data->konfigurace);
            $obsah = explode($this->obsexplode, $data->obsah);
            $typy = explode($this->obsexplode, $data->typy);
            //pocitani entych
            $retente = $this->GenerovaniPublicEnte(array("tvar" => $tvar, "poci" => $retente->poci, "poc" => $retente->poc, "loadente" => $retloadente));

            //incializace pole radku
            $ret = array("array_object",
                        "absolutni_url" => $this->absolutni_url,
                        "id" => $data->id,
                        "poc" => $retente->poci,
                        );

            $pole = array("tvar" => $tvar,
                          "adresa" => $adresa,
                            //"kontrola" => $kontrola,
                          "baseurl" => $baseurl,
                          "id" => $data->id);
            //vygenerovani elementu obsahu
            $elem = $this->GenerovaniPublicElementu($konfigurace, $obsah, $typy, $pole);
            //slouceni elementu a obsahu
            $ret = array_merge($ret, $retloadente->posun, $elem,
                              $retente->array_prvni, $retente->array_posledni,
                              $retente->array_ente_def, $retente->array_ente);

            //pridavek do kazde polozky, jako asoc pole a=>b
            if (!Empty($pridavek) &&
                is_array($pridavek))
            {
              $ret = array_merge($ret, $pridavek); //slouceni pole, hlavni+pridavek
            }

            //pridavani do pole vypisu polozek
            $fullret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, ($rozkliknuto ? "normal_rozkliknuty_vypis" : "normal_vypis"), $tvar),
                                                  $ret);
          }
        }

        $pole_obal = array ("array_object",
                            "nazev" => $sablonadata->nazev, //$retdata->nazev//dodelat!!! data z retdata a nebo
                            "popis" => $sablonadata->popis, //$retdata->popis,
                            "vypis" => implode("", $fullret),  //slouceni nactenych polozek
                            "strankovani" => $str);

        //pridavek do kazde polozky, jako asoc pole a=>b
        if (!Empty($pridavek_obal) &&
            is_array($pridavek_obal))
        {
          $pole_obal = array_merge($pole_obal, $pridavek_obal); //slouceni pole, hlavni+pridavek
        }

        //vlozeni a slouceni finalniho vypisu a vlozeni strankovani
        $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, ($rozkliknuto ? "normal_rozkliknuty_vypis_obal" : "normal_vypis_obal"), $tvar),
                                            $pole_obal);
      }
        else
      {
        $result = $this->EqTv($this->unikatni, "normal_vypis_obal_null", $tvar); //null obsah
      }
    }

    return $result;
  }

/**
 *
 * Obaluje polozkama menu polozky obsahu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObal", array("adresa" => "adresa"[, baseurl => "baseurl/", "tvar" => ""]);
 *
 * @param nastaveni konfiguracni pole
 * @return obalovany vypis obsahu
 */
  public function CentralMenuObal($nastaveni)
  {
    $adresa = $nastaveni["adresa"];
    $baseurl = $nastaveni["baseurl"];
    //$skryvat = $nastaveni["skryvat"];
    //$pridavek = $nastaveni["pridavek"];
    //$strankovani = $nastaveni["strankovani"];
    $tvar = $nastaveni["tvar"];

/*
    //nacteni strankovani
    $limit = $str = "";
    if (!Empty($strankovani))
    {
      list($str, $limit) = $strankovani;
    }
*/

    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "menu", $adresa) &&  //kontrola existence
        !$this->var->aktivniadmin)
    { //nacteni hodnot z menu + detekce prislusnosti k danemu menu
      $retdata = $this->ControlObjectHodnoty(array("id", "sablona", "rewrite", "defaultni", "konfigurace", "submenu"), //"nazev", "rewrite", "zanoreni", "koren"
                                            array("menu", $adresa, "adresa="));
      //$idmenu = $this->RekurzivniKlesani($retdata->id);

      //nacteni hodnot ze sablony, podle nulte urovne
      $sablonadata = $this->ControlObjectHodnoty(array("razeni", "adresa", "jazyky", "formenu", "konfigurace", "nazev", "popis"),
                                                array("sablona", $retdata->sablona));

//dodelat!! resene dost hnusne na miru!

      $submenu = implode(", ", explode("-", $retdata->submenu));
      $idsubmenu = "id IN ({$submenu})";

      if ($res = $this->queryMultiObjectSingle("SELECT id, sablona, nazev, konfigurace
                                                FROM {$this->dbpredpona}menu
                                                WHERE {$idsubmenu}
                                                ORDER BY poradi ASC;"))
      {
        $poc = 0;
        foreach ($res as $data)
        {
          $razeni = $this->VypisHodnotu("razeni", "sablona", $data->sablona);
          if ($res1 = $this->queryMultiObjectSingle("SELECT id FROM {$this->dbpredpona}obsah WHERE menu='{$data->id}'
                                                    ORDER BY {$sablonadata->razeni};"))
          {
            $poleidobsah = array();
            foreach ($res1 as $data1)
            { //vygenerovani id pro obsah
              $poleidobsah[] = $data1->id;
            }
//var_dump($sablonadata->adresa);
//implode(", ", )
            $obsah = $this->Central(array("adresa" => $sablonadata->adresa, "subid" => $poleidobsah, "subpoc" => $poc, "tvar" => $tvar));

            $poc++;
            $result .= $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_menu_obal", $tvar),
                                                $data->nazev,
                                                $obsah);
          }
        }
      }

//var_dump($sablonadata);
//var_dump($retdata);
//vypisovat 1 uroven menu a do toho podle id vkladatobsahy ktere nalezi idmenu do toho menu
//var_dump(, $data->nazev);
//in_array($data->id, $idmenu)

//zapinat rozbalovani? jestli rozbalovat postupne a nebo vsechno jiz rozbalene
      //vypis X?! urovne  menu a jeho obsahu

/*
 * obaluje obsahy ktere jsou vsechny zobrazovany,
 * menu je tu jen zanoreni 1 ktere slouzi jako obal pro obsahy!!
 * s tim ze se polozky menu neorzklikavaji
 **/
//dodelat!! naaplikovat otestovat!!
//dodelat!! specialni vystup na obalovani obsahu
    }

    return $result;
  }

/**
 *
 * Menu pro navigaci
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenu", "adresa"[, "baseurl/", false, 1]);
 * "RewriteRule ^polozky/(.+)/?$ ?action=prvni-sekce&menu=$1 [L]"
 *
 * @param adresa adresace bloku menu
 * @param baseurl pokud se menu nachazi na jine urovni adresy
 * @param rozbalovat bool na zapinani celeho nebo postupneho vykreslovani
 * @param tvar cislo tvaru
 * @return vykresleny blok menu
 */
  public function CentralMenu($nastaveni)
  {
    $adresa = $nastaveni["adresa"];
    $baseurl = $nastaveni["baseurl"];
    //$skryvat = $nastaveni["skryvat"];
    //$pridavek = $nastaveni["pridavek"];
    //$strankovani = $nastaveni["strankovani"];
    $tvar = $this->NotEmpty($nastaveni, "tvar");//$nastaveni["tvar"];
//$adresa, $baseurl = "", $tvar = "")
//kontrolovat prislusnost k menu!! id->menu
    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "menu", $adresa) && //kontrola existence
        !$this->var->aktivniadmin)  //generovani jen na strankach
    {
      //nacteni dat podle adresy
      $retdata = $this->ControlObjectHodnoty(array("id", "submenu", "konfigurace"),  //, "koren", "submenu"
                                            array("menu", $adresa, "adresa="));

      //rozbalonani svych submenu, jen v 0 zanoreni!
      $zobrazit_submenu = $this->HodnotaKonfiguraceMenu("zobrazit_submenu", $retdata->konfigurace);
      //defaultni nastaveni oznacovani vychoziho zanoreni menu
      $oznacit_defaultni = $this->HodnotaKonfiguraceMenu("oznacit_defaultni", $retdata->konfigurace);

      //musi existovat adresa, jinak pri neexistenc vypisuje vsechny menu
      $konfigurace = array ("adresa" => $adresa,
                            "lasturl" => $baseurl,
                            "getarray" => explode("/", $this->NotEmpty("get", $this->get_menu)),  //$_GET[$this->get_menu]
                            "poradi" => array_flip($this->RekurzivniKlesani($retdata->id)),
                            "rozbalovat" => !$zobrazit_submenu, //rozbalovani submenu
                            "defaultni" => $oznacit_defaultni,
                            "tvar" => $tvar);
      $result = $this->RekurzivniCentralMenu(1, $retdata->submenu, $konfigurace);
    }

    return $result;
  }

/**
 *
 * Rekurzivni vykreslování bloku menu
 *
 * @param zanoreni cislo zanoreni
 * @param submenu blok submenu
 * @param konfigurace pole konfiguracnich hodnot
 * @return blok menu/submenu
 */
  private function RekurzivniCentralMenu($zanoreni, $submenu, $konfigurace)
  {
    $result = "";
    //rozdeneni sub polozek na vykresleni
    $sub = explode("-", $submenu);
    $subpolozky = "";
    if (!Empty($submenu))
    { //slozeni sub dotazu na vykresleni jen urcitych id
      $id = implode(", ", $sub);
      $subpolozky = "AND id IN ({$id})";
    }

//dodelat!!!!! poresit pocitani entych po celem menu a v kazde urovni menu!

    //nacteni hodnot pro vsechny polozky
    $lasturl = $konfigurace["lasturl"]; //posledni adresa
    $adresa = $konfigurace["adresa"]; //adresa bloku menu
    $c_mindex = count($konfigurace["poradi"]);  //pocet polozek
    $tvar = $konfigurace["tvar"]; //cislo tvaru

    $aktivni = $this->EqTv($this->unikatni, "normal_vypis_menu_aktivni", $tvar);
    $key_aktivni = array_keys($aktivni);
    $prvni = $this->EqTv($this->unikatni, "normal_vypis_menu_prvni", $tvar);
    $key_prvni = array_keys($prvni);
    $posledni = $this->EqTv($this->unikatni, "normal_vypis_menu_posledni", $tvar);
    $key_posledni = array_keys($posledni);

    $ente_od = $this->EqTv($this->unikatni, "normal_vypis_menu_ente_od", $tvar);
    $ente_po = $this->EqTv($this->unikatni, "normal_vypis_menu_ente_po", $tvar);
    $ente_break = $this->EqTv($this->unikatni, "normal_vypis_menu_ente_break", $tvar);
    $ente = $this->EqTv($this->unikatni, "normal_vypis_menu_ente", $tvar);

    $ente_def_array = $this->EqTv($this->unikatni, "normal_vypis_menu_ente_def_array", $tvar);
    $ente_def = $this->EqTv($this->unikatni, "normal_vypis_menu_ente_def", $tvar);

    $zantext = $this->EqTv($this->unikatni, "normal_vypis_menu_text_zanoreni", $tvar);

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, rewrite, zanoreni, koren, submenu,
                                              defaultni, konfigurace
                                              FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni}
                                              {$subpolozky}
                                              ORDER BY poradi ASC;"))
    {
      $zpoc = 0;
      //vypis rekurzivniho menu
      foreach ($res as $data)
      {
        $zan = $data->zanoreni + 1;
        //generovani submenu
        $submenu = "";
        if ($data->submenu)
        { //rekurzivni vykreslovani ostatnich polozek
          $konfigurace["lasturl"] = "{$lasturl}{$data->rewrite}/";  //nastaveni url pro dalsi zanoreni
          $submenu = $this->RekurzivniCentralMenu($zan, $data->submenu, $konfigurace);
        }

//dodelat!!!
//jazyk????
//do nastaveni pridat i aplikaci auto rozbalovani

        //nacteni hodnot pro jednu polozku
        $mindex = $konfigurace["poradi"][$data->id];  //index

//dodelat!!!! stejny pripad jako zantext
        foreach ($ente as $index => $hodnota)
        { //vyhodnocovani podminky
          $podm_ente = ((($mindex + $ente_od[$index]) % $ente_po[$index]) == $ente_break[$index]);
          $array_ente[$index] = ($podm_ente ? $hodnota : "");
        }

        foreach ($ente_def as $index => $hodnota)
        {
          $array_ente_def[$index] = (in_array($mindex, $ente_def_array[$index]) ? $hodnota  : "");
        }

        //vyhodnocovani aktualni polozky
        $rewrite = $konfigurace["getarray"][$data->zanoreni - 1];
        $podminka = ($rewrite == $data->rewrite || (Empty($rewrite) && $konfigurace["defaultni"] == $data->zanoreni && $data->defaultni));

        $array_aktivni = ($podminka ? $aktivni : array_fill_keys($key_aktivni, ""));
        $array_prvni = ($mindex == 1 ? $prvni : array_fill_keys($key_prvni, ""));
        $array_posledni = ($mindex == $c_mindex - 1 ? $posledni : array_fill_keys($key_posledni, ""));

        //incializace pole radku
        $ret = array ("array_object",
                      "absolutni_url" => $this->absolutni_url,
                      "id" => $data->id,
                      "nazev" => $data->nazev,
                      "url" => "{$this->absolutni_url}{$lasturl}{$data->rewrite}",
                      "zantext" => $zantext[$data->zanoreni],
                      "zanoreni" => $data->zanoreni,
                      "koren" => $data->koren,
                      "menupoc" => $mindex,  //pocitadlo v menu
                      "zanorenipoc" => $zpoc,  //pocitadlo v zanoreni
                      "submenu" => ($konfigurace["rozbalovat"] ? ($podminka ? $submenu : "") : $submenu),
                      );
        $zpoc++;

        //slouceni elementu a obsahu
        $ret = array_merge($ret, $array_aktivni,
                          $array_prvni, $array_posledni,
                          $array_ente_def, $array_ente);

        //vypis obsahu menu
        $result .= $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_menu", $tvar),
                                            $ret);

      }
    }

    return $result;
  }

/**
 *
 * Drobeckova navigace k menu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralDrobeckovaNavigace", "adresa"[, "baseurl/", 1]);
 *
 * @param adresa adresace drobeckove navigace
 * @param baseurl pokud se menu nachazi na jine urovni adresy
 * @param tvar cislo tvaru
 * @return vykreslena drobeckova navigace
 */
  public function CentralDrobeckovaNavigace($nastaveni)
  {
    $adresa = $nastaveni["adresa"];
    $baseurl = $nastaveni["baseurl"];
    //$skryvat = $nastaveni["skryvat"];
    //$pridavek = $nastaveni["pridavek"];
    //$strankovani = $nastaveni["strankovani"];
    $tvar = $nastaveni["tvar"];
//$adresa, $baseurl = "", $tvar = "")

    $result = "";
    if (!Empty($adresa) &&
        !$this->DuplikatniHodnota("adresa", "menu", $adresa) && //kontrola existence
        !$this->var->aktivniadmin)  //generovani jen na strankach
    {
      $id = $this->VypisHodnotu("id", "menu", $adresa, "adresa=");
      $idmenu = $this->RekurzivniKlesani($id);

      //bere adresu dle aktualni adresy
      $getarray = explode("/", $_GET[$this->get_menu]);

      $ret = $this->EqTv($this->unikatni, "normal_vypis_drobecky_first", $tvar);
      foreach ($getarray as $index => $polozka)
      {
        $data = $this->ControlObjectHodnoty(array("id", "nazev", "rewrite", "zanoreni", "koren"),
                                            array("menu", $polozka, "rewrite="));
//dodelat: jazyk, ???? co s tim??
        if (!Empty($data->nazev) && //opkud neni prazdny nazev
            in_array($data->id, $idmenu)) //overovani prislusnosti k menu
        {
          if ($index != count($getarray) - 1) //do predposledniho jsou vsechno odkazy
          { //odkaz
            $rewurl = "";
            //nacitani last rewrite pro uplnou adresu
            foreach ($this->RekurzivniStoupani($data->id) as $suburl)
            { //nabirani do pole
              $rewurl[] = $this->VypisHodnotu("rewrite", "menu", $suburl);
            }
            //slouceni rewtite s /
            $lasturl = implode("/", $rewurl);
            //nacitani adresy sveho korene
            $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_drobecky_href", $tvar),
                                              $data->nazev,
                                              "{$this->absolutni_url}{$baseurl}{$lasturl}",
                                              $data->zanoreni,
                                              $data->koren);
          }
            else
          { //text
            $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_vypis_drobecky_text", $tvar),
                                              $data->nazev,
                                              $data->rewrite,
                                              $data->zanoreni,
                                              $data->koren);
          }
        }
      }

      $result = implode($this->EqTv($this->unikatni, "normal_vypis_drobecky_sep", $tvar), $ret);
    }

    return $result;
  }

/**
 *
 * Promazavani obsahu na zaklade zadaneho datumu
 * --urceno pro cron
 *
 */
  public function CronCentralAutomazani()
  {
    if ($res = $this->queryMultiObjectSingle("SELECT id, obsah, typy
                                              FROM {$this->dbpredpona}obsah;"))
    {
      $dnes = date("Y-m-d");
      $delid = "";
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $obsah = explode($this->obsexplode, $data->obsah);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "automazani":
              $datum = date("Y-m-d", strtotime($obsah[$index]));
              if ($datum <= $dnes)
              { //nacitani id ktere se ma smazat
                $delid[] = $data->id;
              }
            break;
          }
        }
      }

      if (!Empty($delid) &&
          is_array($delid))
      {
        $sloucene = implode(", ", $delid);
        $this->queryExec("DELETE FROM {$this->dbpredpona}obsah WHERE id IN ({$sloucene});"); //provedeni dotazu
      }
    }
  }

/**
 *
 * Vygenerovani ajax scriptu pro web
 *
 */
  public function VygenerujAjaxScript()
  {
    $cesta = "{$this->dirpath}/{$this->generated[0]}"; //cesta ajaxu
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath,
                                        $this->AjaxJQueryKonverze(NULL, array("text", "roz")));

      $result = $this->ControlWriteFile(array($cesta => $obsah));
    }

    return $result;
  }

/**
 *
 * Vyber sablony
 *
 * @param id identifikator polozky
 * @param menu bool na vyber sablon v elementech a nebo v menu
 * @return vyber sablon
 */
  private function VyberSablony($id = NULL, $menu = false)
  {
    $result = "";
    $podm = ($menu ? 1 : 0);
    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, nazev, konfigurace FROM {$this->dbpredpona}sablona WHERE formenu={$podm} ORDER BY poradi ASC;"))
    {
      //vypis sablon
      $row = array();
      foreach ($res as $data)
      {
        $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_row"],
                                          $data->id,
                                          ($id == $data->id ? " selected=\"selected\"" : ""),
                                          $data->nazev,
                                          $data->adresa);

      }
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony"],
                                          implode("", $row));
    }
      else
    {
      $result = $this->unikatni["admin_vyber_sablony_null"]; //null sablon
    }

    return $result;
  }

/**
 *
 * Vyber typu elementu
 *
 * @param id identifikator polozky
 * @param adresa smerovaci adresa pri reloadu straky
 * @param konfigurace nastaveni vybraneho elementu
 * @return vyber elementu a jeho konfigurace
 */
  private function VyberTypu($id, $adresa, $konfigurace = NULL)
  {
    //parsnuti adresy, na ziskani promennych
    parse_str(html_entity_decode($adresa), $ret);
    //nacteni aktualnich prvku z dane sablony
    $cur_prvky = $this->VypisHodnotu("typ", "element", $ret["sab"], "sablona=");
    //natypovani na pole
    settype($cur_prvky, "array");
    //prvky ktere moho byt v sablone jen jedenkrat
    $onetyp = array("automazani", "rewrite");
    //vypis elementu
    $ret = array();
    foreach ($this->typ_elementu as $index => $polozka)
    {  //pokud spada sablona do jednorazovych tak vykresli podle toho co je ulozene
      if (in_array($index, $onetyp) ? !in_array($index, $cur_prvky) : true)
      {
        $ret[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_row"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $polozka);
      }
    }
    //rozdeleni nactene konfigurace na pole
    $konfigurace = explode($this->cfgexplode, $konfigurace);
    //zobrazeni potrebne konfigurace
    $res = array();
    switch ($id) //rozdeleni podle typu
    {
      case "checkbox":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_checkbox_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_checkbox"],
                                          $hodnota[0],
                                          $hodnota[1]);
      break;

      case "radio":
      case "radiocontent":
      case "select":
      case "checkgroup":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_radio_select_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        //rozdeleni hodnot
        list($pop, $hod) = $this->RozdelitHodnoty($hodnota, 2, 2);
        settype($hodnota[1], "integer");  //pretypovani na cislo
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_radio_select"],
                                          $this->dirpath,
                                          $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                          $id,
                                          $hodnota[0], //zalomeni
                                          $hodnota[1],  //pocet
                                          (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""), //popisek
                                          (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : "")); //hodnoty
      break;

      case "conectmodule":
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        $funkce = explode(":", $hodnota[0]);  //rozdeleni 0 indexu pro nalistovani funkce

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_conectmodule"],
                                          $this->SeznamTrid($funkce[0], $funkce[1]),
                                          $hodnota[1]);
      break;
//dodelat!!! pridat polozku hledat!!!
      case "minitext":
        if (!is_numeric($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_minitext_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        list($pop, $hod) = $this->RozdelitHodnoty($hodnota, 2, 3);
        settype($hodnota[2], "integer");  //pretypovani na cislo
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_minitext"],
                                          $this->dirpath,
                                          $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2],  //pocet
                                          (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""),  //popisek
                                          (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : "")); //hodnoty
      break;

      case "fulltext":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_fulltext_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);
        list($pop, $hod) = $this->RozdelitHodnoty($hodnota, 2, 5);
        settype($hodnota[4], "integer");  //pretypovani na cislo
        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_fulltext"],
                                          $this->dirpath,
                                          $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2],
                                          $hodnota[3],
                                          $hodnota[4],  //pocet
                                          (!Empty($pop) ? html_entity_decode(implode("|', '|", $pop), NULL, "UTF-8") : ""),  //popisek
                                          (!Empty($hod) ? html_entity_decode(implode("|', '|", $hod), NULL, "UTF-8") : "")); //hodnoty
      break;

      case "minitextlite":
      case "wymeditorlite":
      case "hiddentext":
      case "tinymce":
      case "header":
      case "specheader":
      case "rewrite":
      case "url":
      case "adrescontent":
        $res[] = $this->unikatni["admin_vyber_typu_not"];
      break;

      case "fulltextlite":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_fulltextlite_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_fulltextlite"],
                                          $hodnota[0],
                                          $hodnota[1]);
      break;

      case "datum":
      case "datumcas":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_{$id}_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_{$id}"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2],
                                          $hodnota[3]);
      break;

      case "cas":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_cas_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_cas"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0]);
      break;

      case "automazani":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_automazani_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_automazani"],
                                          $hodnota[0]);
      break;

      case "foto":  //foto+mini
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_foto_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_foto"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          $hodnota[1],
                                          ($hodnota[2] ? " checked=\"checked\"" : ""),  //uprava full
                                          ($hodnota[2] ? " disabled=\"disabled\"" : ""));
      break;

      case "onefoto": //foto bez mini
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_onefoto_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_onefoto"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          ($hodnota[1] ? " checked=\"checked\"" : ""),  //uprava full
                                          ($hodnota[1] ? " disabled=\"disabled\"" : ""));
      break;

      case "seriefoto": //serie foto+mini
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_seriefoto_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_seriefoto"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          $hodnota[1],
                                          ($hodnota[2] ? " checked=\"checked\"" : ""),  //uprava full
                                          ($hodnota[2] ? " disabled=\"disabled\"" : ""),
                                          $hodnota[3],
                                          ($hodnota[4] ? " checked=\"checked\"" : ""),  //uprava poctu
                                          ($hodnota[4] ? " disabled=\"disabled\"" : ""));
      break;

      case "oneseriefoto":  //serie fotek bez mini, multiple
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_oneseriefoto_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_oneseriefoto"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          ($hodnota[1] ? " checked=\"checked\"" : ""),  //uprava full
                                          ($hodnota[1] ? " disabled=\"disabled\"" : ""),
                                          $hodnota[2],  //max pocet
                                          ($hodnota[3] ? " checked=\"checked\"" : ""),  //uprava poctu
                                          ($hodnota[3] ? " disabled=\"disabled\"" : ""));
      break;

      case "download":  //stahovani souboru uzivateli
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_download_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_download"],
                                          $hodnota[0],
                                          ($hodnota[1] == "none" ? " checked=\"checked\"" : ""),  //rozliseni razeni
                                          ($hodnota[1] == "date asc" ? " checked=\"checked\"" : ""),
                                          ($hodnota[1] == "date desc" ? " checked=\"checked\"" : ""),
                                          ($hodnota[1] == "name asc" ? " checked=\"checked\"" : ""),
                                          ($hodnota[1] == "name desc" ? " checked=\"checked\"" : ""));
      break;

      case "upload":  //uploadovani souboru uzivatelama
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_upload_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_upload"],
                                          $hodnota[0]);
      break;

      case "flash":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_flash_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_flash"],
                                          ($hodnota[0] == "link" ? " checked=\"checked\"" : ""), //rozliseni vstupu
                                          ($hodnota[0] == "file" ? " checked=\"checked\"" : ""),
                                          $hodnota[1],
                                          $hodnota[2],  //4
                                          ($hodnota[3] ? " checked=\"checked\"" : ""),  //uprava velikosti
                                          ($hodnota[3] ? " disabled=\"disabled\"" : ""),  //6
                                          ($hodnota[4] ? " checked=\"checked\"" : ""),  //uprava velikosti
                                          ($hodnota[4] ? " disabled=\"disabled\"" : ""),
                                          $hodnota[5],  //9
                                          $hodnota[6],
                                          ($hodnota[7] == "default" ? " checked=\"checked\"" : ""), //11
                                          ($hodnota[7] == "left" ? " checked=\"checked\"" : ""),
                                          ($hodnota[7] == "right" ? " checked=\"checked\"" : ""),
                                          ($hodnota[7] == "top" ? " checked=\"checked\"" : ""),
                                          ($hodnota[7] == "bottom" ? " checked=\"checked\"" : ""),
                                          ($hodnota[8] == "true" ? " checked=\"checked\"" : ""), //16
                                          ($hodnota[8] == "false" ? " checked=\"checked\"" : ""),
                                          ($hodnota[9] == "true" ? " checked=\"checked\"" : ""), //18
                                          ($hodnota[9] == "false" ? " checked=\"checked\"" : ""),
                                          ($hodnota[10] == "true" ? " checked=\"checked\"" : ""), //20
                                          ($hodnota[10] == "false" ? " checked=\"checked\"" : ""),
                                          ($hodnota[11] == "low" ? " checked=\"checked\"" : ""), //22
                                          ($hodnota[11] == "medium" ? " checked=\"checked\"" : ""),
                                          ($hodnota[11] == "high" ? " checked=\"checked\"" : ""),
                                          ($hodnota[11] == "autolow" ? " checked=\"checked\"" : ""),
                                          ($hodnota[11] == "autohigh" ? " checked=\"checked\"" : ""),
                                          ($hodnota[11] == "best" ? " checked=\"checked\"" : ""),
                                          ($hodnota[12] == "true" ? " checked=\"checked\"" : ""), //28
                                          ($hodnota[12] == "false" ? " checked=\"checked\"" : ""),
                                          ($hodnota[13] == "window" ? " checked=\"checked\"" : ""),  //30
                                          ($hodnota[13] == "opaque" ? " checked=\"checked\"" : ""),
                                          ($hodnota[13] == "transparent" ? " checked=\"checked\"" : ""),
                                          ($hodnota[14] == "true" ? " checked=\"checked\"" : ""),  //33
                                          ($hodnota[14] == "false" ? " checked=\"checked\"" : ""));
      break;

      case "csssprit":
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_csssprit_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? array_values($_POST["konfigurace"]) : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_csssprit"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2],
                                          $hodnota[3],
                                          ($hodnota[4] == "left" ? " checked=\"checked\"" : ""),
                                          ($hodnota[4] == "top" ? " checked=\"checked\"" : ""),
                                          ($hodnota[5] == "transparent" ? " checked=\"checked\"" : ""),
                                          ($hodnota[5] == "rgb" ? " checked=\"checked\"" : ""),
                                          $hodnota[6]);
      break;

      case "externalfile":  //pripojeni externich souboru
        if (Empty($konfigurace[0]))
        { //vlozeni defaultnich dat
          $konfigurace = $this->unikatni["admin_vyber_typu_externalfile_default"];
        }
        $hodnota = (!Empty($_POST["konfigurace"]) ? $_POST["konfigurace"] : $konfigurace);

        $res[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu_externalfile"],
                                          "{$this->dirpath}/{$this->generated[0]}",
                                          $hodnota[0],
                                          $hodnota[1],
                                          $hodnota[2],
                                          ($hodnota[3] ? " checked=\"checked\"" : ""),  //povoleni mazani
                                          ($hodnota[3] ? " disabled=\"disabled\"" : ""));
      break;

      default:
        $res[] = $this->unikatni["admin_vyber_typu_null"];
      break;
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_typu"],
                                        $adresa,
                                        implode("", $ret),  //select
                                        implode("", $res)); //nastaveni

    return $result;
  }

/**
 *
 * Vypise seznam vsech trid a jejich public funkci
 *
 * @param modul nazev modulu
 * @param nazev jmeno funkce
 * @return select s tridama a funkcema
 */
  private function SeznamTrid($modul = NULL, $nazev = NULL)
  {
    $result = $this->unikatni["admin_seznam_trid_begin"];

    $funblok = $this->BlokovaneNazvyVypisu();

    foreach ($this->var->main as $index => $polozka)
    {
      $trida = get_class($polozka);
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid_skupina_begin"],
                                          $trida);

      if ($index != $this->mainindex) //vyblokovani vlastni funkce
      {
        //nacteni funkci
        $fun = get_class_methods($polozka);
        foreach ($fun as $funkce)
        {
          if (!in_array($funkce, $funblok)) //ignorace funkci
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid"],
                                                "{$trida}:{$funkce}",
                                                ($trida == $modul && $funkce == $nazev ? " selected=\"selected\"" : ""),
                                                $funkce);
          }
        }
      }

      $result .= $this->unikatni["admin_seznam_trid_skupina_end"];
    }

    $result .= $this->unikatni["admin_seznam_trid_end"];

    return $result;
  }

/**
 *
 * Vyber vstupu textovych elementu
 *
 * @param id identifikator polozky
 * @param typ vybrany typ elementu
 * @param adresa smerovaci adresa pri reloadu straky
 * @param reg_exp regularni vyraz
 * @param min minimalni hodnota znaku
 * @param max maximalni hodnota znaku
 * @return vyber vstupu a jeho konfigurace
 */
  private function VyberVstupu($id, $typ, $adresa, $reg_exp = "", $min = 0, $max = 0)
  {
    $result = "";
    switch ($typ) //rozliseni podle typu
    {
      case "minitext":
      case "fulltext":
      case "minitextlite":
      case "fulltextlite":
      case "wymeditorlite":
      case "tinymce":
        $id = (!Empty($id) ? $id : "string"); //osetreni defaultni/prazdne hodnoty
        //vypis vstupu
        $row = array();
        foreach ($this->typ_vstupu as $index => $polozka)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_vstupu_row"],
                                            $index,
                                            ($id == $index ? " selected=\"selected\"" : ""),
                                            $polozka);
        }
        $ret = "";
        switch ($id)  //rozliseni podle vstupu
        {
          case "string":
          case "integer":
          case "float":
            //osetreni nezadane polozky
            $min = (!is_null($min) ? $min : 0);
            $max = (!is_null($max) ? $max : 0);
            $ret = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_vstupu_string_integer_float"],
                                                $min,
                                                $max);
          break;

          case "reg_exp":
            $ret = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_vstupu_reg_exp"],
                                                $reg_exp);
          break;
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_vstupu"],
                                            $adresa,
                                            implode("", $row),
                                            $ret);
      break;
    }

    return $result;
  }

/**
 *
 * Vrati delku zadaneho elementu, delky pro funkci Central
 *
 * @param typ typ elementu
 * @param konfigurace konfigurace elementu
 * @return vypocitana delka rozsahu elementu pri hlavnim vypisu
 */
  private function PocitaniProcentElementu($typ, $konfigurace)
  {
    $result = "";
    switch ($typ)
    {
      case "checkbox":  //1
      case "conectmodule":  //1
      case "datum": //1
      case "cas": //1
      case "datumcas":  //1
      case "automazani":  //1
      case "hiddentext":  //1
      case "adrescontent":  //1
      case "checkgroup":  //1
      case "radio": //1
      case "radiocontent":  //1
      case "select":  //1
      case "minitextlite":  //1
      case "fulltextlite":  //1
      case "seriefoto": //1, foto
      case "oneseriefoto":  //1, foto
      case "download":  //1
      case "externalfile":  //1
      case "tinymce": //1
      case "wymeditorlite": //1
        $result = 1;  //hodnota
      break;

      //case "upload":
      //case "flash":

      case "url": //4
      case "rewrite": //4
        $result = 4;
      break;

      case "minitext":  //2
      case "fulltext":  //2
      case "onefoto": //2, dle existence + obr
        $result = 2;  //zkraceny, original text
      break;


      case "foto":  //dle existence + mini + full
        $result = 3;
      break;

      case "csssprit":  //6
        $result = 6;  //dle existence + cesta + w + h + w/2 + h/2
      break;

      default:
      case "header":  //0, specialni pripad
      case "specheader":  //0, specialni pripad
        $result = 0;
      break;
    }

    return $result;
  }

/**
 *
 * Vygeneruje kod sablony
 *
 * @param id identifikator sablony
 * @return textove id sablony
 */
  private function KodSablony($id)
  {
    settype($id, "integer");

    $result = "";
    $kod = array();
    if ($res = $this->queryMultiObjectSingle("SELECT typ FROM {$this->dbpredpona}element WHERE sablona='{$id}' ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $kod[] = $data->typ;
      }

      $result = implode("-", $kod);
    }

    return $result;
  }

/**
 *
 * Vyber sablon u obsahu
 *
 * @param id cislo sablony
 * @param formenu bool na zobrazeni sablony pro menu
 * @param zmena skryje select na vyber sablon
 * @param edit bool editace
 * @param adresa presmerovaci adresa
 * @return select vyber
 */
  private function VyberObsahSablony($id, $formenu, $zmena, $edit, $adresa)
  {
    if ($zmena)
    { //generovani kodu sablony
      $kod = $this->KodSablony($id);
      $result = "";
      if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, max_obsah, konfigurace FROM {$this->dbpredpona}sablona WHERE formenu='{$formenu}' ORDER BY poradi ASC;"))
      { //rozdeleni adresy
        $adr0 = explode("__", $adresa);
        $adr1 = implode("&amp;", array_splice(explode("&amp;", $adr0[1]), 1));  //zahodi 0.index
        //vypis sablon
        $row = array();
        foreach ($res as $data)
        { //vygenerovani kodu sablony
          $kod_sab = $this->KodSablony($data->id);
          $zamek = $this->HodnotaKonfiguraceSablony("zamek", $data->konfigurace);
          //vypsani sablony pokud jsou elementy stejne
          if ($kod == $kod_sab)
          {
            //podminka pridavani
            $podm_add = (!$zamek && ($data->max_obsah != 0 ? $this->VypisHodnotu("COUNT(id)", "obsah", $data->id, "sablona=") < $data->max_obsah : true));
            //zobrazi jen neblokovane na pridavani nebo pri editaci sama sebe
            if ($podm_add || ($edit && $id == $data->id))
            {
              $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_obsah_sablony_row"],
                                                  $data->id,
                                                  ($id == $data->id ? " selected=\"selected\"" : ""),
                                                  $data->nazev);
            }
          }
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_obsah_sablony"],
                                            $adr0[0],
                                            $adr1,
                                            implode("", $row));
      }
        else
      {
        $result = $this->unikatni["admin_vyber_obsah_sablony_null"];
      }
    }
      else
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_obsah_sablony_hidden"],
                                          $id);
    }

    return $result;
  }

/**
 *
 * Generovani elementu pro pridavani a upravu obsahu
 *
 * @param index andex vykreslovaneho elementu
 * @param podminka pole podminek
 * @return pole elementu
 */
  private function GenerovaniElementu($index, $podminka)
  {
    $result = "";
    $element = array();
    $sablona = $podminka[$index]["sablona"];  //nacteni cislo sablony
    $fpovinne = ($podminka[$index]["povinne"] ? $this->unikatni["admin_addeditobsah_povinne"][$podminka[$index]["typ"]] : "");
    $povinne = ($podminka[$index]["povinne"] ? $this->znacka_povinne : ""); //aplikace povinneho textu
    //prochazeni typu a jejich vykresleni
    switch ($podminka[$index]["typ"])
    {
      case "checkbox":
        $value = (!Empty($_POST[$this->name_button]) ? (!Empty($_POST[$podminka[$index]["name"]]["value"]) ? $podminka[$index]["konfigurace"][0] : "") : $podminka[$index]["value"]);
        $mozn = array("checkbox:0", "checkbox:1");
        $check = (in_array($value, $mozn) ? $value == "checkbox:1" : $value == $podminka[$index]["konfigurace"][0]);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_checkbox", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($check ? " checked=\"checked\"" : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //5
                                              $povinne);
      break;

      case "checkgroup":
        list($popis, $hodnoty) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 2, 2);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : explode($this->valexplode, $podminka[$index]["value"]));
        //vypis prvku
        $row = array();
        foreach ($hodnoty as $i => $hodnota)
        {
          $podm = (($i + 1) == $podminka[$index]["konfigurace"][0]);
          $radek = explode($this->group_sep, $hodnota);
          $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_checkgroup_row", $sablona),
                                            $popis[$i], //popis
                                            $podminka[$index]["name"],
                                            $i,
                                            $radek[0], //value
                                            ($radek[0] == $value[$i] ? " checked=\"checked\"" : ""), //checked
                                            ($podm ? $this->EqTv($this->unikatni, "admin_addeditobsah_checkgroup_row_zalomeni", $sablona) : ""));
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_checkgroup", $sablona),
                                              $podminka[$index]["nazev"],
                                              implode("", $row),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //4
                                              $povinne);
      break;

      case "radio":
      case "radiocontent":
        list($popis, $hodnota) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 2, 2);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $row = array();
        for ($i = 0; $i < $podminka[$index]["konfigurace"][1]; $i++)
        {
          $podm = (($i + 1) == $podminka[$index]["konfigurace"][0]);
          $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_radio_row", $sablona),
                                            $popis[$i], //popis
                                            $podminka[$index]["name"],
                                            $hodnota[$i], //value
                                            ($hodnota[$i] == $value ? " checked=\"checked\"" : ""), //checked
                                            ($podm ? $this->EqTv($this->unikatni, "admin_addeditobsah_radio_row_zalomeni", $sablona) : ""));
        }
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_radio", $sablona),
                                              $podminka[$index]["nazev"],
                                              implode("", $row),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //4
                                              $povinne);
      break;

      case "select":
        list($popis, $hodnota) = $this->RozdelitHodnoty($podminka[$index]["konfigurace"], 2, 2);
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $row = array();
        for ($i = 0; $i < $podminka[$index]["konfigurace"][1]; $i++)
        { //select nema zalamovani!
          $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_select_row", $sablona),
                                            $hodnota[$i], //value
                                            ($hodnota[$i] == $value ? " selected=\"selected\"" : ""),
                                            $popis[$i]);  //popis
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_select", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              implode("", $row),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //5
                                              $povinne);
      break;

      case "conectmodule":
        $modul = explode(":", $podminka[$index]["konfigurace"][0]);
        $param = explode("|", $podminka[$index]["konfigurace"][1]);

        //overeni existence funkce
        if (method_exists($modul[0], $modul[1]))
        { //test zavolani funkce
          $ret = $this->var->main[0]->NactiFunkci($modul, $param);
        }
          else
        {
          $ret = $this->unikatni["admin_addeditobsah_conectmodule_null"];
        }

        //value je k nicemu, volani modulu se provadi primo v hlavni funkci
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_conectmodule", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $ret,
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //5
                                              $povinne);
      break;

      case "minitextlite":
      case "wymeditorlite":
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_{$podminka[$index]["typ"]}", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              ($podminka[$index]["vstup"] == "string" && $podminka[$index]["max_val"] > 0 ? " maxlength=\"{$podminka[$index]["max_val"]}\"" : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //6
                                              $povinne);
      break;

      case "tinymce":
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_{$podminka[$index]["typ"]}", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $this->dirpath,
                                              $value,
                                              ($podminka[$index]["vstup"] == "string" && $podminka[$index]["max_val"] > 0 ? " maxlength=\"{$podminka[$index]["max_val"]}\"" : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //7
                                              $povinne);
      break;

      case "fulltextlite":
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_fulltextlite", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],  //4
                                              $podminka[$index]["konfigurace"][1],
                                              ($podminka[$index]["vstup"] == "string" && $podminka[$index]["max_val"] > 0 ? " maxlength=\"{$podminka[$index]["max_val"]}\"" : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //8
                                              $povinne);
      break;

      case "header":  //hlavicka
      case "specheader":  //hlavicka special
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_{$podminka[$index]["typ"]}", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["value"],
                                              $podminka[$index]["popis"]);
      break;

      case "minitext":
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $delka = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["delka"] : $podminka[$index]["konfigurace"][0]);
        $zkrac = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["zkrac"] : $podminka[$index]["konfigurace"][1]);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_{$podminka[$index]["typ"]}", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              ($podminka[$index]["vstup"] == "string" && $podminka[$index]["max_val"] > 0 ? " maxlength=\"{$podminka[$index]["max_val"]}\"" : ""),
                                              $delka,
                                              $zkrac,
                                              $podminka[$index]["id"],
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //9
                                              $povinne);
      break;

      case "fulltext":
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $delka = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["delka"] : $podminka[$index]["konfigurace"][2]);
        $zkrac = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["zkrac"] : $podminka[$index]["konfigurace"][3]);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_fulltext", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],  //4
                                              $podminka[$index]["konfigurace"][1],
                                              ($podminka[$index]["vstup"] == "string" && $podminka[$index]["max_val"] > 0 ? " maxlength=\"{$podminka[$index]["max_val"]}\"" : ""),
                                              $delka,
                                              $zkrac,
                                              $podminka[$index]["id"],
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //11
                                              $povinne);
      break;

      case "datum": //datum & datumcas
      case "datumcas":
        $datum = date($podminka[$index]["konfigurace"][0], strtotime($podminka[$index]["value"]));
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $datum);
        $procformat = preg_replace(array("/\w+/"), array("%$0"), $podminka[$index]["konfigurace"][0]);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_{$podminka[$index]["typ"]}", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],
                                              $podminka[$index]["konfigurace"][1],
                                              $podminka[$index]["konfigurace"][2],
                                              $podminka[$index]["konfigurace"][3],
                                              $procformat,  //8
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //9
                                              $povinne);
      break;

      case "cas":
        $datum = date($podminka[$index]["konfigurace"][0], strtotime($podminka[$index]["value"]));
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $datum);
        $procformat = preg_replace(array("/\w+/"), array("%$0"), $podminka[$index]["konfigurace"][0]);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_cas", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["konfigurace"][0],
                                              $procformat,  //5
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //7
                                              $povinne);
      break;

      case "hiddentext":  //skryty text
      case "adrescontent":  //adresace obsahu, jako skryty text
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_{$podminka[$index]["typ"]}", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              $podminka[$index]["popis"]);
      break;

      case "automazani":  //datum automazani
        $value = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["value"] : date("d.m.Y", strtotime($podminka[$index]["value"])));
        $volby = explode(",", $podminka[$index]["konfigurace"][0]);
        //vypis prednastaveneho casu
        $row = array();
        foreach ($volby as $cas)
        {
          $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_automazani_row", $sablona),
                                            date("d.m.Y", strtotime($cas)),
                                            $podminka[$index]["name"],
                                            $cas);
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_automazani", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value,
                                              implode("", $row),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //6
                                              $povinne);
      break;

      case "foto":  //fotka s miniaturou
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main"]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $mini = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["mini"] : $podminka[$index]["konfigurace"][0]);
        $full = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["full"] : $podminka[$index]["konfigurace"][1]);

        //vlastni nastaveni hlavniho obrazku
        $set_enable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_foto_enable", $sablona),
                                                $podminka[$index]["name"],  //pokud je vlastni miniatura tak vlozi primo file
                                                $mini,
                                                $full);

        //vlastni upload miniatury pro main kdyz je skryte nastaveni obrazku
        $set_disable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_foto_disable", $sablona),
                                                $podminka[$index]["name"],
                                                $podminka[$index]["konfigurace"][0],
                                                $podminka[$index]["konfigurace"][1]); //nesmi se ovlivnovat z postu

        $obr = explode($this->valexplode, $value);
        //doplneni own
        if (Empty($obr[0]))
        {
          $obr[0] = $obr[1];  //pokud je own prazdne pouzije [1]
        }

        if (!is_file("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[1]}"))
        { //pokud neexistuje obrazek
          $obr[0] = $this->unikatni["admin_addeditobsah_foto_default_pic"];
          $obr[1] = $obr[0];
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_foto", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][2] ? $set_enable : $set_disable),
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}", //4
                                              "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[1]}",
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //7
                                              $povinne);
      break;

      case "onefoto": //fotka bez miniatury
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main"]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $full = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["full"] : $podminka[$index]["konfigurace"][0]);

        //vlastni nastaveni hlavniho obrazku
        $set_enable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_onefoto_enable", $sablona),
                                                $podminka[$index]["name"],  //pokud je vlastni miniatura tak vlozi primo file
                                                $full);

        $set_disable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_onefoto_disable", $sablona),
                                                $podminka[$index]["name"],
                                                $podminka[$index]["konfigurace"][0]);

        //nacte obrazek
        $obr = $value;
        if (!is_file("{$this->dirpath}/{$this->pathpicture}/{$obr}"))
        { //pokud neexistuje obrazek
          $obr = $this->unikatni["admin_addeditobsah_onefoto_default_pic"];
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_onefoto", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][1] ? $set_enable : $set_disable),
                                              "{$this->dirpath}/{$this->pathpicture}/{$obr}", //4
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //6
                                              $povinne);
      break;

      case "seriefoto": //setie fotek s miniaturama
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main0"]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $mini = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["mini"] : $podminka[$index]["konfigurace"][0]);
        $full = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["full"] : $podminka[$index]["konfigurace"][1]);
        $poc = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["poc"] : $podminka[$index]["konfigurace"][3]);

        //vlastni nastaveni hlavniho obrazku
        $set_enable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_seriefoto_enable", $sablona),
                                                $podminka[$index]["name"],  //pokud je vlastni miniatura tak vlozi primo file
                                                $mini,
                                                $full);

        //vlastni upload miniatury pro main kdyz je skryte nastaveni obrazku
        $set_disable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_seriefoto_disable", $sablona),
                                                $podminka[$index]["name"],
                                                $podminka[$index]["konfigurace"][0],  //nesmi se ovlivnovat z postu
                                                $podminka[$index]["konfigurace"][1]);

        $obr = explode($this->valexplode, $value);
        $obr_pic = array_slice($obr, 0, $poc * 2);
        $obr_pop = array_slice($obr, $poc * 2);

        //vraceni hodnot popisu z postu
        $sud = 0;
        foreach (range(0, $poc - 1) as $i)
        {
          //overeni existence mini
          $obr_pic[$sud] = (file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr_pic[$sud]}") ? $obr_pic[$sud] : "");
          //overeni existence full
          $obr_pic[$sud + 1] = (file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr_pic[$sud + 1]}") ? $obr_pic[$sud + 1] : "");
          //nacitani popisku
          $popis = $_POST[$podminka[$index]["name"]]["popis{$i}"];
          $obr_pop[$i] = html_entity_decode((!Empty($popis) ? $popis : $obr_pop[$i]), NULL, "UTF-8");
          $sud += 2;  //pocitani kazde druhe polozky
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_seriefoto", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][2] ? $set_enable : $set_disable),
                                              $this->dirpath, //4
                                              $poc,
                                              (!Empty($obr_pic) ? implode("|', '|", $obr_pic) : ""),
                                              (!Empty($obr_pop) ? implode("|', '|", $obr_pop) : ""),  //7
                                              $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                              $podminka[$index]["konfigurace"][4],  //9
                                              ($podminka[$index]["konfigurace"][4] ? $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_seriefoto_add", $sablona), $podminka[$index]["name"]) : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //12
                                              $povinne);
      break;

      case "oneseriefoto":  //serie fotek bez miniatur
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main"][0]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        $full = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["full"] : $podminka[$index]["konfigurace"][0]);
        $poc = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["poc"] : $podminka[$index]["konfigurace"][2]);
        settype($_POST[$podminka[$index]["name"]]["old"], "array");
        $obr = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["old"] : explode($this->valexplode, $value));

        //vlastni nastaveni obrazku
        $set_enable = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_oneseriefoto_enable", $sablona),
                                                $podminka[$index]["name"],  //pokud je vlastni miniatura tak vlozi primo file
                                                $full);

        $set_enable_poc = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_oneseriefoto_poc", $sablona),
                                                    $podminka[$index]["name"],
                                                    $poc);

        $row = array();
        $obrazky = array_slice($obr, 0, count($obr) / 2);
        $pop = array_slice($obr, count($obr) / 2);
        foreach ($obrazky as $i => $val)
        {
          if (!Empty($val))
          {
            //osetreni prazdneho obrazku
            $obr = (!Empty($val) ? $val : "");  //$this->unikatni["admin_addeditobsah_oneseriefoto_default_pic"]
            $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_oneseriefoto_row", $sablona),
                                              $podminka[$index]["name"],
                                              $val,
                                              "{$this->dirpath}/{$this->pathpicture}/{$obr}",
                                              $pop[$i]);
          }
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_oneseriefoto", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][1] ? $set_enable : ""),
                                              ($podminka[$index]["konfigurace"][3] ? $set_enable_poc : ""),
                                              implode("", $row),  //5
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //7
                                              $povinne);
      break;

      case "download":  //stahovani souboru uzivateli
        $value = (!Empty($_FILES[$podminka[$index]["name"]]["tmp_name"]["main"][0]) ? $_POST[$podminka[$index]["name"]]["value"] : $podminka[$index]["value"]);
        settype($_POST[$podminka[$index]["name"]]["old_name"], "array");
        settype($_POST[$podminka[$index]["name"]]["old_file"], "array");
        $file = (!Empty($_POST[$this->name_button]) ? array_merge($_POST[$podminka[$index]["name"]]["old_name"], $_POST[$podminka[$index]["name"]]["old_file"]) : explode($this->valexplode, $value));
        //rozdeleni do promennych
        $name = array_slice($file, 0, count($file) / 3);
        $soubor = array_slice($file, count($file) / 3, count($file) / 3);
        $popis = array_slice($file, (count($file) / 3) + (count($file) / 3));

        $row = array();
        foreach ($soubor as $i => $val)
        {
          if (!Empty($val))
          {
            $fil = (!Empty($val) ? $val : "");  //$this->unikatni["admin_addeditobsah_download_default_fil"]
            $a = explode(".", $fil);  //rozdeleni podle tecky
            $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_download_row", $sablona),
                                              $podminka[$index]["name"],
                                              $name[$i],
                                              $val,
                                              $popis[$i],
                                              "{$this->dirpath}/{$this->pathfile}/{$fil}",
                                              strtolower($a[count($a) - 1]),
                                              $this->absolutni_url);
          }
        }

        //vytvaret slozku, upne admin , uzivatel stahne
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_download", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              implode("", $row),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //5
                                              $povinne);
      break;

      case "upload":  //upload od uzivatele?
        //upne user, admin stahne/smaze
        //pozdeji nejak dosefovat! musi byt jen jedenkrat v sablone!!!!!!
        //$fpovinne,
      break;

      case "flash": //flash video
        $link = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["link"] : $podminka[$index]["value"]);
        $width = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["width"] : $podminka[$index]["konfigurace"][1]);
        $height = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["height"] : $podminka[$index]["konfigurace"][2]);
        $param = (!Empty($_POST[$this->name_button]) ? $_POST[$podminka[$index]["name"]]["param"] : $podminka[$index]["konfigurace"][5]);

        $src_link = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_flash_link", $sablona),
                                              $podminka[$index]["name"],
                                              $link);

        $src_file = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_flash_file", $sablona),
                                              $podminka[$index]["name"],
                                              $link); //odstranovat nejak soubor???

        $enable_size = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_flash_size", $sablona),
                                                $podminka[$index]["name"],
                                                $width,
                                                $height);
//dodelat!! vlastni parametry nedodelany! jak bude zapotrebu dodelat!!
        $enable_param = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_flash_param", $sablona),
                                                  $podminka[$index]["name"],
                                                  $param);

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_flash", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              ($podminka[$index]["konfigurace"][0] == "link" ? $src_link : $src_file),
                                              ($podminka[$index]["konfigurace"][3] ? $enable_size : ""),
                                              ($podminka[$index]["konfigurace"][4] ? $enable_param : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //7
                                              $povinne);
      break;

      case "csssprit":  //css sprit obrazku
        $obr = explode($this->valexplode, $podminka[$index]["value"]);
        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_csssprit", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $podminka[$index]["konfigurace"][1],
                                              $podminka[$index]["konfigurace"][2],
                                              "{$this->dirpath}/{$this->pathpicture}/{$obr[0]}",
                                              $obr[1],  //w
                                              $obr[2],  //h
                                              $podminka[$index]["popis"],
                                              $fpovinne,  //9
                                              $povinne);
      break;

      case "rewrite": //rewrite rozklikavani
        $value = (!Empty($_POST[$this->name_button]) ? array_values($_POST[$podminka[$index]["name"]]) : explode($this->valexplode, $podminka[$index]["value"]));

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_rewrite", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value[0],
                                              $value[1],
                                              $podminka[$index]["popis"],
                                              $fpovinne,
                                              $povinne);
      break;

      case "url": //url adresa
        $value = (!Empty($_POST[$this->name_button]) ? array_values($_POST[$podminka[$index]["name"]]) : explode($this->valexplode, $podminka[$index]["value"]));

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_url", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $value[0],
                                              $value[1],
                                              ($value[2] ? " checked=\"checked\"" : ""),
                                              $podminka[$index]["popis"],
                                              $fpovinne,
                                              $povinne);
      break;

      case "externalfile":  //externi soubor
        $value = (!Empty($_POST[$podminka[$index]["name"]]["soubory"][0]) ? array_values($_POST[$podminka[$index]["name"]]["soubory"]) : explode($this->valexplode, $podminka[$index]["value"]));
        $koren = "{$_SERVER["DOCUMENT_ROOT"]}/{$podminka[$index]["konfigurace"][0]}";
        $data = base64_encode(implode(":::", $podminka[$index]["konfigurace"])."val:".implode(":::", $value));

        //vypis souboru v seznamu
        $row = array();
        if (!Empty($value[0]))
        {
          foreach ($value as $i => $polozka)
          {
            if (!Empty($polozka))
            {
              $path = base64_decode($polozka);
              $velikost = $this->Velikost(filesize($path));
              $datum = date($this->unikatni["admin_addeditobsah_externalfile_val_datum"] ,filemtime($path));
              $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_externalfile_val"],
                                                basename($path),
                                                $velikost,
                                                $datum,
                                                $podminka[$index]["name"],  //4
                                                $i,
                                                $polozka);
            }
          }
        }
          else
        {
          $row[] = $this->unikatni["admin_addeditobsah_externalfile_val_null"];
        }

        $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_externalfile", $sablona),
                                              $podminka[$index]["nazev"],
                                              $podminka[$index]["name"],
                                              $koren,
                                              $data,
                                              implode("", $row),
                                              $podminka[$index]["popis"],
                                              $fpovinne,
                                              $povinne);
      break;
    }
    //slouceni elementu
    $result = implode("", $element);
    //kontrola prazdnosti, znamena ze chyby element, edituje dle toho co ma ulozene
    if (Empty($element))
    {
      $result = $this->EqTv($this->unikatni, "admin_addeditobsah_not_found", $sablona);
    }

    return $result;
  }

/**
 *
 * Zobrazovani dodatecneho nastaveni obsahu
 *
 * @param sablona cislo sablony
 * @param jazyk cislo jazyka
 * @param menu cislo menu
 * @param konfigurace nactena konfigurace
 * @return dodatecne nastaveni
 */
  private function AdminKonfiguraceObsahu($sablona, $jazyk, $menu, $konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_obsahu"];
    $retdata = $this->ControlObjectHodnoty(array("formenu", "konfigurace"),
                                          array("sablona", $sablona));
    //zpracovani navracene konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $element = array();
    foreach ($pole as $name => $hodnoty)
    { //podminka k zobrazeni elementu
      if ($this->HodnotaKonfiguraceSablony($name, $retdata->konfigurace))
      {
        $value = $this->HodnotaKonfiguraceObsahu($name, $konfigurace);
        //vyber elementu dle typu
        switch ($hodnoty["typ"])
        {
          case "boolean":
            $element[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_skryta_sekce_addedit_obsah_element", $sablona),
                                                  $name,
                                                  ($value ? " checked=\"checked\"" : ""),
                                                  ($value ? "true" : "false"),
                                                  $hodnoty["name"],
                                                  $hodnoty["class"]);
          break;
        }
      }
    }

    $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_skryta_sekce_addedit_obsah", $sablona),
                                        //sem nekam ma pak prijit jazyk $jazyk
                                        ($retdata->formenu ? $this->AdminSelectMenu($menu) : ""),
                                        implode("", $element));

    return $result;
  }

/**
 *
 * Vypis konfigurace obsahu u vypisu
 *
 * @param konfigurace_sablony (pole) konfigurace ze sablony
 * @param konfigurace_obsahu (pole) konfigurace z obsahu
 * @param od generovat od cisla 0/1, defaultne 0
 * @return vygenerovane pouzita konfigurace
 */
  private function AdminVypisKonfiguraceObsahu($konfigurace_sablony, $konfigurace_obsahu, $od = 0)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_obsahu"];
    //zpracovani navracene konfigurace
    $konfigurace_sablony = (is_array($konfigurace_sablony) ? $konfigurace_sablony : explode($this->cfgexplode, $konfigurace_sablony));
    $konfigurace_obsahu = (is_array($konfigurace_obsahu) ? $konfigurace_obsahu : explode($this->cfgexplode, $konfigurace_obsahu));
    $element = array();
    settype($od, "integer");
    $poc = $od;
    foreach ($pole as $name => $hodnoty)
    {
      if ($this->HodnotaKonfiguraceSablony($name, $konfigurace_sablony))
      {
        $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_obsahu"],
                                              (($poc % 2) == 0 ? "sudy" : "lichy"),
                                              $hodnoty["action"],
                                              (in_array("{$name}:true", $konfigurace_obsahu) ? " checked=\"checked\"" : ""));
        $poc++;
      }
    }
    //slouceni elementu
    $result = implode("", $element);

    return $result;
  }

/**
 *
 * Vraceni hodnoty pozadovane z konfigurace
 *
 * @param hodnota nazev hodnoty ktera se ma vytahnout z konfigurace
 * @param konfigurace (pole) vstupni konfigurace
 * @return hodnota zadane konfigurace
 */
  private function HodnotaKonfiguraceObsahu($hodnota, $konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_obsahu"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $ret = array_values(preg_grep("/{$hodnota}:/", $konfigurace));
    $ret = explode("{$hodnota}:", $ret[0]);
    $value = $ret[1]; //nacteni hodnoty
    //pretypovani dle typu
    switch ($pole[$hodnota]["typ"])
    {
      case "boolean": //konvert na boolean
        $result = ($value == "true");
      break;
    }

    return $result;
  }

/**
 *
 * Vyber menu pri pridavani obsahu
 *
 * @param id cislo oznaceneho menu
 * @return select pro vybrani urciteho zanoreni obsahu v menu
 */
  private function AdminSelectMenu($id, $zanoreni = 0, $submenu = NULL)
  {
    $result = "";
    //rozdeneni sub polozek na vykresleni
    $sub = explode("-", $submenu);
    $subpolozky = "";
    //generovani podminky pro root podminku
    if ($zanoreni == 0)
    {
      $subid = $this->RekurzivniStoupani($id);
      $subpolozky = " AND id='{$subid[0]}'";
    }
    //generovani podminky pro submenu
    if (!Empty($submenu))
    { //slozeni sub dotazu na vykresleni jen urcitych id
      $subid = implode(", ", $sub);
      $subpolozky = "AND id IN ({$subid})";
    }

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, zanoreni, koren, submenu, konfigurace
                                              FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni}
                                              {$subpolozky}
                                              ORDER BY poradi ASC;"))
    {
      //vypis menu
      $row = array();
      foreach ($res as $data)
      {
        $zan = $data->zanoreni + 1;
        $submenu = "";
        if (!Empty($data->submenu))
        { //generovani submenu, a zanoreni o 1 vyssi
          $submenu = $this->AdminSelectMenu($id, $zan, $data->submenu);
        }

        $zamek_obsah = (!$this->var->admin_mod ? $this->HodnotaKonfiguraceMenu("zamek_obsahu", $data->konfigurace) : false);

        $hloubka = str_repeat("&nbsp;&nbsp;", $data->zanoreni);
        //zobrazeni jen odemcenych menu
        if (!$zamek_obsah)
        {
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_select_menu_row"],
                                            $data->id,
                                            ($id == $data->id ? " selected=\"selected\"" : ""),
                                            $data->nazev,
                                            $hloubka);
        }
        $row[] = $submenu;
        //slouceni radku
        $radky = implode("", $row);
        if ($zanoreni == 0)
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_select_menu"],
                                              $radky);
        }
          else
        {
          $result = $radky;
        }
      }
    }
      else
    {
      $result = $this->unikatni["admin_select_menu_null"];
    }

    return $result;
  }

/**
 *
 * Vypise obsah skupiny, univerzalni vypis
 *
 * @param sablona id dane sablony
 * @return obsah skupny s odkazy
 */
  private function AdminObsahSablony($sablona)
  {
    settype($sablona, "integer");
    //nacteni hodnot ze sablony
    $retdata = $this->ControlObjectHodnoty(array("max_obsah", "formenu", "konfigurace", "nazev", "popis"),
                                          array("sablona", $sablona));
    //zpracovani konfigurace ze sablony
    $zamek = $this->HodnotaKonfiguraceSablony("zamek", $retdata->konfigurace);
    $zmena = $this->HodnotaKonfiguraceSablony("zmena", $retdata->konfigurace);
    //podminka pridavani
    $podm_add = (!$zamek && ($retdata->max_obsah != 0 ? $this->VypisHodnotu("COUNT(id)", "obsah", $sablona, "sablona=") < $retdata->max_obsah : true));
    //podminka pro zobrazeni tlacitka pridat obsah, bez id menu se nezobrazi
    $addformenu = ($retdata->formenu ? !Empty($_POST["menu"]) : true);
    $idsablona = "{$this->idmodul}__{$sablona}";  //adresa sablony
    $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_sablony", $sablona),
                                        $sablona,
                                        ($podm_add && $addformenu ? $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_sablony_add", $sablona),
                                                                                              ($this->localpermit[$idsablona]["addobsah"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=addobsah" : "")) : ""),
                                        $retdata->nazev,
                                        $retdata->popis,
                                        $this->AdminVypisObsahSablony($sablona));
//$this->EqTv($this->unikatni, "", $sablona)
    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah":  //pridavani obsahu
        case "copyobsah": //duplikace obsahu
          $podm_copy = ($co == "copyobsah");
          if ($podm_copy)
          {
            $id = (int)$_GET["id"];
            //nacita hodnoty z kopirovaneho obsahu
            if ($data = $this->querySingleRow("SELECT jazyk, menu, konfigurace, obsah, konfig, typy FROM {$this->dbpredpona}obsah WHERE id={$id};"))
            {
              //$val_jazyk = $data->jazyk;  //???dodeat potom...
              $val_menu = $data->menu;
              $val_obsah = explode($this->obsexplode, $data->obsah);
              $val_konfigurace = explode($this->obsexplode, $data->konfigurace);
              $val_typy = explode($this->obsexplode, $data->typy);
              $val_konfig = $data->konfig;
            }
          }
            else
          {
            $val_jazyk = "";  //dodelat vracet jazyk???
            $val_menu = $this->NotEmpty("get", "menu");
            $val_konfig = "";
          }
          //vraceni hodnot z postu
          if (!Empty($_POST[$this->name_button]))
          {
            //$val_jazyk = $_POST["jazyk"];
            $val_menu = $this->NotEmpty("post", "menu");
            $val_konfig = $this->NotEmpty("post", "konfig");
          }

          //pokud je sablona pro menu a neni zadano menu tak presmerovani na zpet
          if ($retdata->formenu && Empty($val_menu))
          { //neni vybrany koren menu, takze navrat
            $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
          }

          if ($res = $this->queryMultiObjectSingle("SELECT id, sablona, nazev, typ, konfigurace, value, popis,
                                                    povinne, vstup, reg_exp, min_val, max_val
                                                    FROM {$this->dbpredpona}element WHERE sablona={$sablona}
                                                    ORDER BY poradi ASC;"))
          {
            //vypis elementu
            foreach ($res as $index => $data)
            {
              //nacteni pracovniho pole
              $podminka[$index]["id"] = $data->id;
              $podminka[$index]["typ"] = ($podm_copy ? $val_typy[$index] : $data->typ);  //uklada se
              $podminka[$index]["nazev"] = $data->nazev;
              $podminka[$index]["popis"] = $data->popis;
              $podminka[$index]["name"] = "elem_{$data->id}";
              $podminka[$index]["value"] = ($podm_copy ? $val_obsah[$index] : $data->value);  //uklada se
              $podminka[$index]["konfigurace"] = explode($this->cfgexplode, ($podm_copy ? $val_konfigurace[$index] : $data->konfigurace));  //uklada se
              $podminka[$index]["povinne"] = $data->povinne;
              $podminka[$index]["vstup"] = $data->vstup;
              $podminka[$index]["reg_exp"] = $data->reg_exp;
              $podminka[$index]["min_val"] = $data->min_val;
              $podminka[$index]["max_val"] = $data->max_val;
              $podminka[$index]["sablona"] = $sablona;

              //zapouzdreni generovani elementu
              $element[] = $this->GenerovaniElementu($index, $podminka);
            }

            $array_error = array();
            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]))
            { //probehne typova kontrolo & seskladani dat na ulozeni
              foreach ($podminka as $index => $polozky)
              {
                $value = $this->KontrolaVstupu($_POST[$podminka[$index]["name"]]["value"], $podminka[$index], $chyba);
                if (Empty($chyba)) //kdyz je prazdna chyba probiha zpracovani vstupu
                { //naplneni pole pro ulozeni
                  $prom = $this->ZpracovaniVstupu($value, $_POST[$podminka[$index]["name"]], $podminka[$index]);
                  $save_val[$index] = $prom["val"]; //naplneni hodnot
                  $save_cfg[$index] = $prom["cfg"]; //naplneni konfiguraci
                  $save_typ[$index] = $polozky["typ"];  //naplneni typu
                }
                  else
                { //naplneni pripadnych chyb
                  $array_error[] = $chyba;
                }
              }
            }

            $chyby = "";
            //detekce a slouceni chyb
            if (count($array_error) > 0)
            {
              $chyby = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_error", $sablona),
                                                implode("", $array_error));
            }

            $retlink = (!Empty($_GET["ret"]) ? "{$_GET["ret"]}&amp;menu={$val_menu}" : "{$this->idmodul}__{$sablona}");

            $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah", $sablona),
                                                "{$this->dirpath}/{$this->generated[0]}",
                                                $this->dirpath,
                                                $this->EqTv($this->unikatni, "admin_addeditobsah_add", $sablona),
                                                implode("", $element),  //4
                                                $this->AdminKonfiguraceObsahu($sablona, $val_jazyk, $val_menu, $val_konfig),
                                                " name=\"{$this->name_button}\"", //6
                                                $this->VyberObsahSablony($sablona, $retdata->formenu, $zmena, false, "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$retlink}&amp;co=addobsah"),
                                                $chyby, //8
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$retlink}");

            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]) &&
                count($array_error) == 0 &&
                $podm_add)  //zamek na pocet
            {
              //algoritmus ukladani dat
              if ($this->ControlForm(array ("sablona" => array("post", "string"),
                                            //"jazyk" => array("post", "integer"),
                                            "menu" => array("post", "integer"),
                                            "konfigurace" => array("self", "array", $save_cfg, $this->obsexplode),
                                            "obsah" => array("self", "array", $save_val, $this->obsexplode),
                                            "konfig" => array("post", "array", NULL, $this->cfgexplode),
                                            "pridano" => array("self", "date", "now"),
                                            //"upraveno" => array("self", "date", "now"),
                                            "typy" => array("self", "array", $save_typ, $this->obsexplode),
                                            "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "obsah", 1, "WHERE sablona={$sablona}"))),
                                    true,
                                    array("insert", "obsah", NULL)))
              {
                $last_id = $this->lastInsertRowid();
                $vstup = $this->NajdiObrazky(); //vyhleda vsechny obrazky
                //synchronizace
                $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}" => $vstup,
                                                        "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}" => $vstup,
                                                        "{$this->dirpath}/{$this->pathpicture}" => $vstup,
                                                        "{$this->dirpath}/{$this->pathfile}" => $vstup,));
                //zmena hlasky pri zkopirovani obsahu
                $result = $this->Hlaska(($podm_copy ? "copy" : "add"), array($last_id, $navic));
                $this->AdminAddActionLog($last_id, array(__LINE__, __METHOD__));
                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$retlink}");  //auto kliknuti
              }
            }
          }
            else
          {
            $result .= $this->EqTv($this->unikatni, "admin_addeditobsah_null", $sablona); //null element
          }
        break;

        case "editobsah": //uprava obsahu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT jazyk, menu, konfigurace, obsah, konfig, typy FROM {$this->dbpredpona}obsah WHERE id={$id};"))
          {
            //rozdeleni nactenych hodnot
            $val_jazyk = "";  //$val_jazyk = $data->jazyk;
            $val_menu = $data->menu;
            $val_obsah = explode($this->obsexplode, $data->obsah);
            $val_konfigurace = explode($this->obsexplode, $data->konfigurace);
            $val_typy = explode($this->obsexplode, $data->typy);
            $val_konfig = $data->konfig;
          }
          //vraceni hodnot z postu
          if (!Empty($_POST[$this->name_button]))
          {
            //$val_jazyk = $_POST["jazyk"];
            $val_menu = $this->NotEmpty("post", "menu");
            $val_konfig = $this->NotEmpty("post", "konfig");
          }

          if ($res = $this->queryMultiObjectSingle("SELECT id, sablona, nazev, typ, konfigurace, value, popis,
                                                    povinne, vstup, reg_exp, min_val, max_val
                                                    FROM {$this->dbpredpona}element WHERE sablona={$sablona}
                                                    ORDER BY poradi ASC;"))
          {
            //vypis elementu
            foreach ($res as $index => $data)
            {
              //nacteni pracovniho pole
              $podminka[$index]["id"] = $data->id;
              $podminka[$index]["typ"] = $val_typy[$index]; //$data->typ;  //uklada se
              $podminka[$index]["nazev"] = $data->nazev;
              $podminka[$index]["popis"] = $data->popis;
              $podminka[$index]["name"] = "elem_{$data->id}";
              $podminka[$index]["value"] = $val_obsah[$index];  //$data->value;
              $podminka[$index]["konfigurace"] = explode($this->cfgexplode, $val_konfigurace[$index]);  //uklada se
              $podminka[$index]["povinne"] = $data->povinne;
              $podminka[$index]["vstup"] = $data->vstup;
              $podminka[$index]["reg_exp"] = $data->reg_exp;
              $podminka[$index]["min_val"] = $data->min_val;
              $podminka[$index]["max_val"] = $data->max_val;
              $podminka[$index]["sablona"] = $sablona;

              //zapouzdreni generovani elementu
              $element[] = $this->GenerovaniElementu($index, $podminka);
            }

            $array_error = array();
            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]))
            { //probehne typova kontrolo & seskladani dat na ulozeni
              foreach ($podminka as $index => $polozky)
              { //dodelat!! tu se mu neco nezda!, nejak tu nedefunuje pole?!!!
                $value = $this->KontrolaVstupu($_POST[$polozky["name"]]["value"], $polozky, $chyba);
                if (Empty($chyba)) //kdyz je prazdna chyba probiha zpracovani vstupu
                { //naplneni pole pro ulozeni
                  $prom = $this->ZpracovaniVstupu($value, $this->NotEmpty("post", $polozky["name"]), $polozky);
                  $save_val[$index] = $prom["val"]; //naplneni hodnot
                  $save_cfg[$index] = $prom["cfg"]; //naplneni konfiguraci
                  $save_typ[$index] = $polozky["typ"];  //naplneni typu
                }
                  else
                { //naplneni pripadnych chyb
                  $array_error[] = $chyba;
                }
              }
            }

            $chyby = "";
            //detekce a slouceni chyb
            if (count($array_error) > 0)
            {
              $chyby = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah_error", $sablona),
                                                implode($this->EqTv($this->unikatni, "admin_addeditobsah_error_sep", $sablona), $array_error));
            }

            $retlink = (!Empty($_GET["ret"]) ? "{$_GET["ret"]}&amp;menu={$val_menu}" : "{$this->idmodul}__{$sablona}");

            $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_addeditobsah", $sablona),
                                                "{$this->dirpath}/{$this->generated[0]}",
                                                $this->dirpath,
                                                $this->EqTv($this->unikatni, "admin_addeditobsah_edit", $sablona),
                                                implode("", $element),  //4
                                                $this->AdminKonfiguraceObsahu($sablona, $val_jazyk, $val_menu, $val_konfig),
                                                " name=\"{$this->name_button}\"", //6
                                                $this->VyberObsahSablony($sablona, $retdata->formenu, $zmena, true, "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$retlink}&amp;co=editobsah&amp;id={$id}"),
                                                $chyby, //8
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$retlink}");

            //po zmacknuti tlacitka
            if (!Empty($_POST[$this->name_button]) &&
                count($array_error) == 0 &&
                $id > 0)
            {
              //algoritmus ukladani dat
              if ($this->ControlForm(array ("sablona" => array("post", "string"),
                                            //"jazyk" => array("post", "integer"),
                                            "menu" => array("post", "integer"),
                                            "konfigurace" => array("self", "array", $save_cfg, $this->obsexplode),
                                            "obsah" => array("self", "array", $save_val, $this->obsexplode),
                                            "konfig" => array("post", "array", NULL, $this->cfgexplode),
                                            //"pridano" => array("self", "date", "now"),
                                            "upraveno" => array("self", "date", "now"),
                                            "typy" => array("self", "array", $save_typ, $this->obsexplode)),
                                    true,
                                    array("update", "obsah", $id)))
              {
                $vstup = $this->NajdiObrazky(); //vyhleda vsechny obrazky
                //synchronizace
                $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}" => $vstup,
                                                        "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}" => $vstup,
                                                        "{$this->dirpath}/{$this->pathpicture}" => $vstup,
                                                        "{$this->dirpath}/{$this->pathfile}" => $vstup,));

                $result = $this->Hlaska("edit", array($id, $navic));
                $this->AdminAddActionLog($id, array(__LINE__, __METHOD__));
                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$retlink}");  //auto kliknuti
              }
            }
          }
            else
          {
            $result .= $this->EqTv($this->unikatni, "admin_addeditobsah_null", $sablona); //null element
          }
        break;

        case "delobsah": //mazani obsahu
          $id = $_GET["id"];
          settype($id, "integer");

          $retlink = (!Empty($_GET["ret"]) ? "{$_GET["ret"]}&amp;menu={$_GET["menu"]}" : "{$this->idmodul}__{$sablona}");
          if ($this->ControlDeleteForm(array("obsah" => array("id", $id, "id")), $nazev))
          {
            $vstup = $this->NajdiObrazky(); //vyhleda vsechny obrazky
            //synchronizace
            $navic = $this->ControlSynchronize(array("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}" => $vstup,
                                                    "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}" => $vstup,
                                                    "{$this->dirpath}/{$this->pathpicture}" => $vstup,
                                                    "{$this->dirpath}/{$this->pathfile}" => $vstup,));

            $result = $this->Hlaska("del", array($id, $navic));
            $this->AdminAddActionLog($id, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$retlink}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis obsahu sablony
 *
 * @param sablona cislo skupiny
 * @param menu id menu, default 0
 * @return vypis obsahu
 */
  private function AdminVypisObsahSablony($sablona, $menu = 0)
  {
    settype($sablona, "integer");
    settype($menu, "integer");
    //nacteni nastaveni sablony
    if (!$retdata = $this->ControlObjectHodnoty(array("razeni", "max_obsah", "formenu", "konfigurace"),
                                                array("sablona", $sablona)))
    { //nasmerovani pryc z neexistujici sablony
      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
      $retdata->razeni = "poradi ASC";
    }

    $podm_razeni = ($retdata->razeni == "poradi ASC" || $retdata->razeni == "poradi DESC");

    //nacitani tvaru datumu
    $tvar_datum = $this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_datum", $sablona);
    $datum_null = $this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_datum_null", $sablona);

    //nacitani korene bloku menu
    if (!Empty($menu))
    {
      $rootmenu = $this->RekurzivniStoupani($menu);
    }

    $idsablona = "{$this->idmodul}__{$sablona}";  //adresa sablony
    $copyobsah_permit = $this->localpermit[$idsablona]["copyobsah"];
    $editobsah_permit = $this->localpermit[$idsablona]["editobsah"];
    $delobsah_permit = $this->localpermit[$idsablona]["delobsah"];

    $result = "";
    //prodava skrypty na drag'n'drop
    if ($podm_razeni)
    {
      $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_begin", $sablona),
                                          $this->dirpath,
                                          ($retdata->razeni == "poradi ASC" ? "asc" : "desc"));
    }

//dodelat!!!
//vypisovat jazyk? nebo primo seskupovat plozky dle jazyku???  $retdata->jazyky
//je spravne - pri smazani menu -- se jeho polozky objevi v sablone do ktere spadaly

    $zamek = $this->HodnotaKonfiguraceSablony("zamek", $retdata->konfigurace);
    //archivace, aktivace, zmena
    if ($res = $this->queryMultiObjectSingle("SELECT id, konfigurace, obsah, konfig, pridano, upraveno, typy
                                              FROM {$this->dbpredpona}obsah o
                                              WHERE sablona={$sablona} AND menu={$menu}
                                              ORDER BY o.{$retdata->razeni};"))
    {
      //definovani podminek pro odkazy copy & del
      $copy_podm = (!$zamek && ($retdata->max_obsah != 0 ? count($res) < $retdata->max_obsah : true));
      $del_podm = (!$zamek);
      //vypis obsahu
      foreach ($res as $data)
      {
        $konfigurace = explode($this->obsexplode, $data->konfigurace);
        $obsah = explode($this->obsexplode, $data->obsah);
        $typy = explode($this->obsexplode, $data->typy);

        $ret = array();
        //prochazeni typu
        foreach ($typy as $indextyp => $typ)
        {
          switch ($typ)
          {
            case "checkbox":
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              //vyber pole moznosti podle zvolehe hodnoty
              $val = $moznosti[($obsah[$indextyp] == "checkbox:1" ? 0 : 1)];
              $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
            break;

            case "checkgroup":
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              $hodnoty = explode($this->valexplode, $obsah[$indextyp]);
              //vypise jen ty oznacene prvky
              foreach ($hodnoty as $hodnota)
              {
                if (!Empty($hodnota))
                {
                  $pole[] = $hodnota;
                }
              }

              $val = implode($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_checkgroup", $sablona), $pole);
              $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
            break;

            case "radio":
            case "radiocontent":
            case "select":
            case "hiddentext":
            case "adrescontent":
            case "automazani":
            case "minitextlite":
            case "fulltextlite":
              //vypise obsah elementu
              $val = $obsah[$indextyp];
              $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
            break;

            case "wymeditorlite":
              $val = $obsah[$indextyp];
              $ret[] = html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
              $ret[] = $val;
            break;

            case "tinymce":
              $val = $obsah[$indextyp];
              $ret[] = html_entity_decode($val, ENT_QUOTES, "UTF-8");
              $ret[] = preg_replace(array("/&amp;/"), array("&"), $val);
            break;

            case "conectmodule":  //pripoji modul
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              $modul = explode(":", $moznosti[0]);  //rosekani na pole
              $param = explode("|", $moznosti[1]);
//dodelat!! nebylo zatim otestovano!!!
              //prime pripojovani k modulu
              if (method_exists($modul[0], $modul[1]))
              { //zavolani funkce, + prevedeni @@_@@ promennych
                $ret[] = $this->var->main[0]->NactiFunkci($modul, $this->PrevodUnikatnihoTextu($param,
                                                                                              __METHOD__,
                                                                                              $data->id));
              }
                else
              {
                $ret[] = "---";
              }
            break;

            case "minitext":
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              $val = $obsah[$indextyp];
              //prepis textu podlo konfigurace
              if ($moznosti[2] > 0) //pocet
              {
                //extrahuje z pole potrebnou konfiguraci, 3 poc
                list($search, $replace) = $this->RozdelitHodnoty($moznosti, 2, 3);
                //nahrazeni zadanym polem
                $prevod = str_replace($search, $replace, $val);
              }
                else
              {
                $prevod = $val;
              }
              $zkrac = $this->ZkraceniTextu($prevod, $moznosti[0], $moznosti[1]);
              //vypise zkraceny text a prepsany text
              $ret[] = html_entity_decode(html_entity_decode($zkrac, NULL, "UTF-8"));
              $ret[] = html_entity_decode(html_entity_decode($prevod, NULL, "UTF-8"));
            break;

            case "fulltext":
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              $val = $obsah[$indextyp];
              //prepis textu podlo konfigurace, 0 min, 1 max
              if ($moznosti[4] > 0) //pocet
              {
                //extrahuje z pole potrebnou konfiguraci
                list($search, $replace) = $this->RozdelitHodnoty($moznosti, 2, 5);
                //nahrazeni zadanym polem
                $prevod = str_replace($search, $replace, $val);
              }
                else
              {
                $prevod = $val;
              }
              $zkrac = $this->ZkraceniTextu($prevod, $moznosti[2], $moznosti[3]);
              //vypise zkraceny text a prepsany text
              $ret[] = html_entity_decode(html_entity_decode($zkrac, NULL, "UTF-8"));
              $ret[] = html_entity_decode(html_entity_decode($prevod, NULL, "UTF-8"));
            break;

            case "foto":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              if (Empty($val[0]))
              {
                $val[0] = $val[1];  //pokud je own prazdne pouzije [1]
              }
              //vypis hlavniho mini obrazku
              $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$val[0]}";
              $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$val[1]}";
            break;

            case "onefoto":
              $val = $obsah[$indextyp];
              $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$val}";
            break;

            case "seriefoto":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              //nacteni a rozdeleni pole po 2
              $obr = array_chunk(array_slice($val, 0, (count($val) / 3) * 2), 2);
              $popis = array_slice($val, (count($val) / 3) * 2);
              $row = array();
              foreach ($popis as $i => $pop)
              {
                //nahrazeni obrazku miniatury
                if (Empty($obr[$i][0]))
                {
                  $obr[$i][0] = $obr[$i][1];
                }
                $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_seriefoto", $sablona),
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[$i][1]}",
                                                  "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[$i][0]}",
                                                  $pop);
              }
              //slouceni hodnot do radku
              $ret[] = implode("", $row);
            break;

            case "oneseriefoto":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              $obrazek = array_slice($val, 0, count($val) / 2);
              $pop = array_slice($val, count($val) / 2);
              $row = array();
              foreach ($obrazek as $i => $obr)
              {
                $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_oneseriefoto", $sablona),
                                                  "{$this->dirpath}/{$this->pathpicture}/{$obr}",
                                                  $pop[$i]);
              }
              //slouceni hodnot do radku
              $ret[] = implode("", $row);
            break;

            case "download":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              //rozdeleni na subpole
              $nazev = array_slice($val, 0, count($val) / 3);
              $file = array_slice($val, count($val) / 3, count($val) / 3);
              $popis = array_slice($val, (count($val) / 3) * 2);
              $row = array();
              foreach ($nazev as $i => $naz)
              {
                if (!Empty($file[$i]))
                {
                  $a = explode(".", $file[$i]);  //rozdeleni podle tecky
                  $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_download", $sablona),
                                                    $naz,
                                                    $file[$i],
                                                    $popis[$i],
                                                    "{$this->dirpath}/{$this->pathfile}/{$file[$i]}",
                                                    strtolower($a[count($a) - 1]),
                                                    $this->absolutni_url);
                }
              }
              //slouceni hodnot do radku
              $ret[] = implode("", $row);
            break;

            case "flash":
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              //var_dump($moznosti);
              $val = $obsah[$indextyp];
              $ret[] = ($moznosti[0] == "link" ? $val : "{$this->dirpath}/{$this->pathfile}/{$val}");
              $ret[] = "rezerva?!";
            break;
//dodelat! neosetreno prazdne indexy
            case "csssprit":
              $hodnoty = explode($this->valexplode, $obsah[$indextyp]);
              $ret[] = "{$this->dirpath}/{$this->pathpicture}/{$hodnoty[0]}";
              $ret[] = "{$hodnoty[1]}x{$hodnoty[2]}";
            break;

            //case "upload"

            case "rewrite":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              $ret[] = $val[0];
              $ret[] = $val[1];
            break;

            case "url":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              $ret[] = $val[0];
              $ret[] = $val[1];
              $ret[] = ($val[2] ? " onclick=\"this.target='_blank'\"" : "");
            break;

            case "externalfile":
              $val = explode($this->valexplode, $obsah[$indextyp]);
              $row = array();
              foreach ($val as $kod)
              {
                if (!Empty($kod))
                {
                  $path = base64_decode($kod);
                  $velikost = $this->Velikost(filesize($path));
                  $a = explode(".", $path);  //rozdeleni podle tecky
                  $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_externalfile", $sablona),
                                                    basename($path),
                                                    $path,
                                                    strtolower($a[count($a) - 1]),
                                                    $this->absolutni_url);
                }
              }
              //slouceni hodnot do radku
              $ret[] = implode("", $row);
            break;

            case "datum":
            case "datumcas":
              $moznosti = explode($this->cfgexplode, $konfigurace[$indextyp]);
              //vypis naformatovaneho datumu
              $datum = $this->InterpretDate($obsah[$indextyp], $moznosti[0], $moznosti[1], $moznosti[2], $moznosti[3]);
              $ret[] = html_entity_decode(html_entity_decode($datum, NULL, "UTF-8"));
            break;

            case "cas":
              //vypis naformatovaneho casu
              $cas = $this->InterpretTime($obsah[$indextyp], $konfigurace[$indextyp]);
              $ret[] = html_entity_decode(html_entity_decode($cas, NULL, "UTF-8"));
            break;
          }
        }
        //vraceci odkaz
        $odkaz = (!Empty($menu) ? "&amp;menu={$menu}&amp;ret={$this->idmodul}{$this->idmenu}__{$rootmenu[0]}" : "");

        $archivace = $this->HodnotaKonfiguraceSablony("archivace", $retdata->konfigurace);
        $aktivace = $this->HodnotaKonfiguraceSablony("aktivace", $retdata->konfigurace);

        //ovladani archivace obsahu
        $archiv = ($aktivace && !$this->var->admin_mod ? !$this->HodnotaKonfiguraceObsahu("archivace", $data->konfig) : true);
        //stridani prvniho radku sude / liche
        $stridani = ($archivace && $aktivace ? 1 : 0);

        $pole_del = array("array_args",
                          $data->id,
                          ($delobsah_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=delobsah&amp;id={$data->id}{$odkaz}" : ""));
        $pole_del = array_merge($pole_del, $ret);

        $vypis = array("array_args",
                      $data->id,
                      date($tvar_datum, strtotime($data->pridano)),
                      (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $datum_null),
                      $this->AdminVypisKonfiguraceObsahu($retdata->konfigurace, $data->konfig, $stridani),  //5
                      ($copy_podm ? $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_copy", $sablona), //5
                                                              ($copyobsah_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=copyobsah&amp;id={$data->id}{$odkaz}" : "")) : ""),
                      ($editobsah_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=editobsah&amp;id={$data->id}{$odkaz}" : ""), //6
                      ($del_podm && $archiv ? $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_del", $sablona), $pole_del) : ""),  //7
                      ($this->var->admin_mod ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_sablony_editelemobsah"],
                                                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelemobsah&amp;id={$data->id}") : ""),
                      "9 - rezerva");

        //secteni hlavniho pole a indexu
        $vypis = array_merge($vypis, $ret);

        $result .= $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_obsah_sablony", $sablona),
                                            $vypis);
      }
    }
      else
    {
      $result .= $this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_null", $sablona); //null obsahu
    }

    //pridava konec pri razeni podle poradi
    if ($podm_razeni)
    {
      $result .= $this->EqTv($this->unikatni, "admin_vypis_obsah_sablony_end", $sablona);
    }

    return $result;
  }

/**
 *
 * Projde obsah a vypise vsechny obrazky
 *
 * @return pole hodnot
 */
  private function NajdiObrazky()
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT obsah, typy
                                              FROM {$this->dbpredpona}obsah;"))
    {
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $obsah = explode($this->obsexplode, $data->obsah);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "foto":
              $hodn = explode($this->valexplode, $obsah[$index]);
              $result = array_merge($result, $hodn);
            break;

            case "oneseriefoto":
              $hodn = explode($this->valexplode, $obsah[$index]);
              $result = array_merge($result, array_slice($hodn, 0, count($hodn) / 2));
            break;

            case "onefoto":
            case "flash":
              $result[] = $obsah[$index];
            break;

            case "csssprit":
              $hodn = explode($this->valexplode, $obsah[$index]);
              $result[] = $hodn[0];
            break;

            case "seriefoto":
              $hodn = explode($this->valexplode, $obsah[$index]);
              //odfiltrovani komentaru
              $result = array_merge($result, array_slice($hodn, 0, (count($hodn) / 3) * 2));
            break;

            case "download":
              $hodn = explode($this->valexplode, $obsah[$index]);
              //odfiltrovani nazvu a popisku
              $result = array_merge($result, array_slice($hodn, count($hodn) / 3, count($hodn) / 3));
            break;
          }
        }
      }
    }
    $result = array_unique($result);  //odstraneni duplikatnich hodnot (prazdneho mista)

//--"upload"

    return $result;
  }

/**
 *
 * Projde obsah a vypise vsechny obrazky
 *
 * @return pole hodnot
 */
  private function NajdiRewrite($sablona)
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, obsah, typy
                                              FROM {$this->dbpredpona}obsah WHERE sablona='{$sablona}';"))
    {
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $obsah = explode($this->obsexplode, $data->obsah);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "rewrite":
              $hodn = explode($this->valexplode, $obsah[$index]);
              $result[$data->id] = $hodn[1];
            break;
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Projde obsah a vypise vsechny obrazky
 *
 * @param subobsah hledany subobsah
 * @param sablona cislo sablony v ktere ma hledat obsahy
 * @return pole id obsahu
 */
  private function NajdiAdrescontent($subobsah, $sablona)
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, obsah, typy
                                              FROM {$this->dbpredpona}obsah WHERE sablona='{$sablona}';"))
    {
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $obsah = explode($this->obsexplode, $data->obsah);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "adrescontent":
              if ($subobsah == $obsah[$index])
              {
                $result[] = $data->id;
              }
            break;
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Projde obsah a vypise vsechny obrazky
 *
 * @param subobsah hledany subobsah
 * @param sablona cislo sablony v ktere ma hledat obsahy
 * @return pole id obsahu
 */
  private function NajdiRadiocontent($subobsah, $sablona)
  {
    $result = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, obsah, typy
                                              FROM {$this->dbpredpona}obsah WHERE sablona='{$sablona}';"))
    {
      //vypis obsahu
      foreach ($res as $data)
      {
        $typy = explode($this->obsexplode, $data->typy);
        $obsah = explode($this->obsexplode, $data->obsah);
        //projde typy a vybere obrazky
        foreach ($typy as $index => $typ)
        {
          switch ($typ)
          {
            case "radiocontent":
              if ($subobsah == $obsah[$index])
              {
                $result[] = $data->id;
              }
            break;
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Kontroluje vstupni data
 *
 * @param promenna promenna vytazema ze vstupu
 * @param nastaveni asociativni pole nastaveni
 * @param &error text chybove hlasky
 * @return zkontrolovana promenna
 */
  private function KontrolaVstupu($promenna, $nastaveni, &$error)
  {
    $chyba = "";
    $error = "";
    //pokud je polozka povinna
    if ($nastaveni["povinne"])
    {
      //vyber textoveho typu
      switch ($nastaveni["typ"])
      {
        case "checkbox":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni povinneho checkboxu
            $chyba = $this->unikatni["admin_kontrola_vstupu_checkbox"];
          }
        break;

        case "checkgroup":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni minimalne jednoho checkboxu
            $chyba = $this->unikatni["admin_kontrola_vstupu_checkgroup"];
          }
        break;

        case "radio":
        case "radiocontent":
        case "select":
          if (is_null($promenna))
          {
            $promenna = "";
            //neoznaceni povinneho radio buttonu
            $chyba = $this->unikatni["admin_kontrola_vstupu_radio"];
          }
        break;

        case "minitext":
        case "fulltext":
        case "minitextlite":
        case "fulltextlite":
        case "wymeditorlite":
        case "tinymce":
          //dodatecny osetreni min/max hodnot na cisla
          settype($nastaveni["min_val"], "integer");
          settype($nastaveni["max_val"], "integer");

          //rozdeleni podle vstupu
          switch ($nastaveni["vstup"])
          {
            case "string":
              //dodatecny prevod na dany typ
              settype($promenna, "string");

              if (Empty($promenna))
              {
                //pokud je prazdna hodnota
                $chyba = $this->unikatni["admin_kontrola_vstupu_str_empty"];
              }
                else
              if ($nastaveni["min_val"] > 0 &&
                  $nastaveni["max_val"] > 0)
              {
                if (mb_strlen($promenna, "UTF-8") < $nastaveni["min_val"] ||
                    mb_strlen($promenna, "UTF-8") > $nastaveni["max_val"])
                {
                  $promenna = "";
                  //chyba - presah spodem/vrchem
                  $chyba = $this->unikatni["admin_kontrola_vstupu_str_minmax"];
                }
              }
                else
              if ($nastaveni["min_val"] > 0)
              {
                if (mb_strlen($promenna, "UTF-8") < $nastaveni["min_val"])
                {
                  $promenna = "";
                  //chyba - presah spodem
                  $chyba = $this->unikatni["admin_kontrola_vstupu_str_min"];
                }
              }
                else
              if ( $nastaveni["max_val"] > 0)
              {
                if (mb_strlen($promenna, "UTF-8") > $nastaveni["max_val"])
                {
                  $promenna = "";
                  //chyba - presah vrchem
                  $chyba = $this->unikatni["admin_kontrola_vstupu_str_max"];
                }
              }
            break;

            case "integer":
            case "float":
              //dodatecny prevod na dany typ
              switch ($nastaveni["vstup"])
              {
                case "integer":
                  settype($promenna, "integer");
                break;

                case "float":
                  settype($promenna, "float");
                break;
              }

              if (is_null($promenna))
              {
                //pokud je prazdna hodnota
                $chyba = $this->unikatni["admin_kontrola_vstupu_val_null"];
              }
                else
              if ($nastaveni["min_val"] > 0 &&
                  $nastaveni["max_val"] > 0)
              {
                if ($promenna < $nastaveni["min_val"] ||
                    $promenna > $nastaveni["max_val"])
                {
                  $promenna = "";
                  //chyba - presah spodem/vrchem
                  $chyba = $this->unikatni["admin_kontrola_vstupu_val_minmax"];
                }
              }
                else
              if ($nastaveni["min_val"] > 0)
              {
                if ($promenna < $nastaveni["min_val"])
                {
                  $promenna = "";
                  //chyba - presah spodem
                  $chyba = $this->unikatni["admin_kontrola_vstupu_val_min"];
                }
              }
                else
              if ( $nastaveni["max_val"] > 0)
              {
                if ($promenna > $nastaveni["max_val"])
                {
                  $promenna = "";
                  //chyba - presah vrchem
                  $chyba = $this->unikatni["admin_kontrola_vstupu_val_max"];
                }
              }
            break;

            case "reg_exp":
              preg_match($nastaveni["reg_exp"], $promenna, $ret);
              $promenna = $ret[0];  //vybere nulty index

              if (Empty($promenna))
              {
                //chyba neproslo pres regexp
                $chyba = $this->unikatni["admin_kontrola_vstupu_reg_exp"];
              }
            break;
          }
        break;

        case "datum":
        case "automazani":
          //parsuje datum
          $datum = date_parse($promenna);
          $testdate = date("Y-m-d H:i:s", strtotime($promenna));
          //kontroluje vstupni datum a pocet chyb po parsrovani
          if (!checkdate($datum["month"], $datum["day"], $datum["year"]) ||
              $datum["error_count"] != 0 ||
              $testdate == "1970-01-01 01:00:00")
          {
            $promenna = "";
            //chyba, neni gregoriansky datum
            $chyba = $this->unikatni["admin_kontrola_vstupu_datum"];
          }
        break;

        case "cas":
        case "datumcas":
          $testdate = date("Y-m-d H:i:s", strtotime($promenna));
          if ($testdate == "1970-01-01 01:00:00")
          {
            $promenna = "";
            //chyba, neni spravny cas nebo datumcas
            $chyba = $this->unikatni["admin_kontrola_vstupu_cas_datumcas"];
          }
        break;

        case "conectmodule":
        case "hiddentext":
        case "adrescontent":
        case "header":
        case "specheader":
          //zadna kontrola
        break;

        case "foto":
          //koukne jestli jsou nahrane fotky
          $obr = explode($this->valexplode, $nastaveni["value"]);
          if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main"]) &&
              Empty($obr[1])) //obr[0] je own, obr[1] je mini
          {
            $promenna = "";
            //chyba, neni vybran hlavni obrazek
            $chyba = $this->unikatni["admin_kontrola_vstupu_foto"];
          }

          if (($nastaveni["konfigurace"][2] ? $_POST[$nastaveni["name"]]["mini"] : $nastaveni["konfigurace"][0]) == "own" &&
              (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main"]) xor
              Empty($_FILES[$nastaveni["name"]]["tmp_name"]["mini"])))
          {
            $promenna = "";
            //chyba, neni vybran hlavni obrazek s miniaturou
            $chyba = $this->unikatni["admin_kontrola_vstupu_foto_mini"];
          }

          //kontrola textu nastaveni main pic
          if ($nastaveni["konfigurace"][2] && //pokud je povolena uprava main
              (Empty($_POST[$nastaveni["name"]]["mini"]) ||
              Empty($_POST[$nastaveni["name"]]["full"])))
          {
            $promenna = "";
            //chyba, neni nastaven zmensovaci pomer
            $chyba = $this->unikatni["admin_kontrola_vstupu_foto_dim"];
          }
        break;

        case "onefoto":
          //koukne jestli jsou nahrane fotky
          $obr = $nastaveni["value"];
          if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main"]) &&
              Empty($obr)) //obr[0] je own, obr[1] je mini
          {
            $promenna = "";
            //chyba, neni vybran hlavni obrazek
            $chyba = $this->unikatni["admin_kontrola_vstupu_onefoto"];
          }

          //kontrola textu nastaveni main pic
          if ($nastaveni["konfigurace"][1] && //pokud je povolena uprava main
              Empty($_POST[$nastaveni["name"]]["full"]))
          {
            $promenna = "";
            //chyba, neni nastaven zmensovaci pomer
            $chyba = $this->unikatni["admin_kontrola_vstupu_onefoto_dim"];
          }
        break;

        case "seriefoto":
          $obr = explode($this->valexplode, $nastaveni["value"]);
          $poc = $_POST[$nastaveni["name"]]["poc"];
          settype($poc, "integer");

          for ($i = 0; $i < $poc; $i++)
          {
            if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}"]) &&
                Empty($obr[$i]))
            {
              $promenna = "";
              //chyba, neni jeden vybran full brazek
              $chyba = $this->unikatni["admin_kontrola_vstupu_seriefoto"];
              break;
            }

            if (($nastaveni["konfigurace"][2] ? $_POST[$nastaveni["name"]]["mini"] : $nastaveni["konfigurace"][0]) == "own" &&
                (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}"]) xor
                Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}_mini"])))
            {
              $promenna = "";
              //chyba, neni vybran hlavni obrazek s miniaturou
              $chyba = $this->unikatni["admin_kontrola_vstupu_seriefoto_mini"];
              break;
            }
          }

          //pokud je povoleno vlastni nastaveni kontroluje hodnoty
          if ($nastaveni["konfigurace"][2] && //pokud je povolena uprava
              (Empty($_POST[$nastaveni["name"]]["mini"]) ||
              Empty($_POST[$nastaveni["name"]]["full"])))
          {
            $promenna = "";
            //chyba, neni nastaven zmensovaci pomer
            $chyba = $this->unikatni["admin_kontrola_vstupu_seriefoto_dim"];
          }
        break;

        case "oneseriefoto":
          //koukne jestli jsou nahrane fotky
          $obr = $nastaveni["value"];
          if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main"][0]) &&
              Empty($obr)) //obr[0] je own, obr[1] je mini
          {
            $promenna = "";
            //chyba, neni vybran hlavni obrazek
            $chyba = $this->unikatni["admin_kontrola_vstupu_oneseriefoto"];
          }

          //kontrola textu nastaveni main pic
          if ($nastaveni["konfigurace"][1] && //pokud je povolena uprava main
              Empty($_POST[$nastaveni["name"]]["full"]))
          {
            $promenna = "";
            //chyba, neni nastaven zmensovaci pomer
            $chyba = $this->unikatni["admin_kontrola_vstupu_oneseriefoto_dim"];
          }
        break;

        case "download":
          if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["soubor"][0]) &&
              Empty($nastaveni["value"]))
          {
            $promenna = "";
            //chyba, neni vybran soubor
            $chyba = $this->unikatni["admin_kontrola_vstupu_download"];
          }
        break;

        case "flash":
          //kontrola linku/souboru
          if ($nastaveni["konfigurace"][0] == "link")
          {
            if (Empty($_POST[$nastaveni["name"]]["flash"]))
            {
              $promenna = "";
              //chyba, neni vybran link
              $chyba = $this->unikatni["admin_kontrola_vstupu_flash_link"];
            }
          }
            else
          {
            if (Empty($_FILES[$nastaveni["name"]]["tmp_name"]["flash"][0]))
            {
              $promenna = "";
              //chyba, neni vybran soubor
              $chyba = $this->unikatni["admin_kontrola_vstupu_flash_file"];
            }
          }
          //kontrola rozmenu, pokud se nastavuji manualne
          if ($nastaveni["konfigurace"][3])
          {
            if (Empty($_POST[$nastaveni["name"]]["width"]) ||
                Empty($_POST[$nastaveni["name"]]["height"]))
            {
              $promenna = "";
              //chyba, neni nastaven zmensovaci pomer
              $chyba = $this->unikatni["admin_kontrola_vstupu_flash_dim"];
            }
          }
        break;

        case "csssprit":
          //kontrola vlozeni obrazku
          if ((Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main0"]) ||
              Empty($_FILES[$nastaveni["name"]]["tmp_name"]["main1"])) &&
              Empty($nastaveni["value"]))
          {
            $promenna = "";
            //chyba, neni vybran soubor
            $chyba = $this->unikatni["admin_kontrola_vstupu_csssprit"];
          }
          //kontrola vstuniho typu
          if (Empty($nastaveni["value"]) &&
              !in_array($_FILES[$nastaveni["name"]]["type"]["main0"], $this->supporttype))
          {
            $promenna = "";
            //chyba, neni vybran soubor
            $chyba = $this->unikatni["admin_kontrola_vstupu_csssprit_type"];
          }
        break;

        //case "upload":

        case "rewrite":
          //kontrola vlozeni nazvu
          if (Empty($_POST[$nastaveni["name"]]["nazev"]))
          {
            $promenna = "";
            //chyba, neni vyplnen nazev
            $chyba = $this->unikatni["admin_kontrola_vstupu_rewrite"];
          }
        break;

        case "url":
          //kontrola vlozeni nazvu a url
          if (Empty($_POST[$nastaveni["name"]]["url"]) ||
              Empty($_POST[$nastaveni["name"]]["nazev"]))
          {
            $promenna = "";
            //chyba, neni vyplnen url nebo nazev
            $chyba = $this->unikatni["admin_kontrola_vstupu_url"];
          }
        break;

        case "externalfile":
          if (Empty($_POST[$nastaveni["name"]]["soubory"][0]) &&
              Empty($_POST[$nastaveni["name"]]["list"][0]))
          {
            $promenna = "";
            //chyba, neni vybran zadny soubor
            $chyba = $this->unikatni["admin_kontrola_vstupu_externalfile"];
          }
        break;
      }
    }

    //zpracovani chyby pokud je polozka povinna
    if (!Empty($chyba))
    {
      $error = $this->NactiUnikatniObsah($this->unikatni["admin_kontrola_vstupu_error"],
                                        $chyba,
                                        $nastaveni["nazev"],
                                        $this->typ_elementu[$nastaveni["typ"]]);
    }

    return $promenna;
  }

/**
 *
 * Zpracovani nactenych hodnot
 *
 * @param value zkontrolovane value z kontrolni funkce
 * @param nactene promenne nactene z postu
 * @param nastaveni nacteni a rozdeleni konfigurace z db
 * @return pole zpracovanych dat
 */
  private function ZpracovaniVstupu($value, $nactene, $nastaveni)
  {
    $result = "";
    switch ($nastaveni["typ"])
    {
      case "checkbox":
        $result["val"] = (!Empty($value) ? "checkbox:1" : "checkbox:0");
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]); //nacteni konfigurace
      break;

      case "header":
      case "specheader":
      break;

      case "checkgroup":
        list($popis, $hodnoty) = $this->RozdelitHodnoty($nastaveni["konfigurace"], 2, 2);
        $pole = array();
        foreach ($hodnoty as $i => $hodnota)
        {
          $radek = explode($this->group_sep, $hodnota);
          $pole[] = ($radek[0] == $value[$i] ? $radek[0] : $radek[1]);
        }

        $result["val"] = implode($this->valexplode, $pole); //ulouzi indexy oznacenych checkboxu
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "hiddentext":
      case "adrescontent":
      case "minitextlite":
      case "wymeditorlite":
      case "tinymce":
        $result["val"] = $value;
        $result["cfg"] = "";
      break;

      case "fulltextlite":
      case "automazani":
        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "minitext":
        $nastaveni["konfigurace"][0] = $nactene["delka"];
        $nastaveni["konfigurace"][1] = $nactene["zkrac"];

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "fulltext":
        $nastaveni["konfigurace"][2] = $nactene["delka"];
        $nastaveni["konfigurace"][3] = $nactene["zkrac"];

        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "foto":
        //pokud nejsou polozky na POST-u vezme se z defaultni konfigurace
        $mini = (!Empty($nactene["mini"]) ? $nactene["mini"] : $nastaveni["konfigurace"][0]);
        $full = (!Empty($nactene["full"]) ? $nactene["full"] : $nastaveni["konfigurace"][1]);

        //odchyceni smazani miniatury
        $delpic = false;
        if (strpos($mini, "->") > 0)
        {
          $roz = explode("->", $mini);
          $mini = $roz[1];
          $delpic = true;
        }

        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array(NULL, array ("mini" => $mini,
                                                                        "full" => $full))),
                                    array($nastaveni["name"], $max, array("mini" => "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}",
                                                                          "full" => "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}"))
                                    );

        //update stavajicich hodnot
        $nastaveni["konfigurace"][0] = $mini;
        $nastaveni["konfigurace"][1] = $full;

        //roseka nacteny obsah
        $pic = explode($this->valexplode, $nastaveni["value"]);

        //pokud nebyli polozky uploadovany tak dosadi polozky nactene
        $obr["main"]["own"] = (Empty($obr["main"]["own"]) ? (!$delpic ? $pic[0] : "") : $obr["main"]["own"]);
        $obr["main"]["mini"] = (Empty($obr["main"]["mini"]) ? $pic[1] : $obr["main"]["mini"]);

        $pole = array($obr["main"]["own"],
                      $obr["main"]["mini"]);

        $result["val"] = implode($this->valexplode, $pole); //(1+1)main
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "onefoto":
        //pokud nejsou polozky na POST-u vezme se z defaultni konfigurace
        $full = (!Empty($nactene["full"]) ? $nactene["full"] : $nastaveni["konfigurace"][0]);

        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array(NULL, array ("full" => $full))),
                                    array($nastaveni["name"], $max, array("full" => "{$this->dirpath}/{$this->pathpicture}"))
                                    );

        //update stavajicich hodnot
        $nastaveni["konfigurace"][0] = $full;

        //roseka nacteny obsah
        $pic = explode($this->valexplode, $nastaveni["value"]);

        //vezme z jednoho a nebo druheho vstupu
        $obrazek = (!Empty($obr["main"]["mini"]) ? $obr["main"]["mini"] : $obr["main"]["own"]);
        //pokud nebyli polozky uploadovany tak dosadi polozky nactene
        $obr = (Empty($obrazek) ? $pic[0] : $obrazek);

        $result["val"] = $obr;

        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "seriefoto":
        $mini = (!Empty($nactene["mini"]) ? $nactene["mini"] : $nastaveni["konfigurace"][0]);
        $full = (!Empty($nactene["full"]) ? $nactene["full"] : $nastaveni["konfigurace"][1]);
        $poc = $nactene["poc"];
        settype($poc, "integer");

        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array($poc, array ("mini" => $mini,
                                                                        "full" => $full))),
                                    array($nastaveni["name"], $max, array("mini" => "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}",
                                                                          "full" => "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}"))
                                    );

        $pic = explode($this->valexplode, $nastaveni["value"]);
        $pic_obr = array_chunk(array_slice($pic, 0, $poc * 2), 2);

        //nacteni obrazku z multipole
        $obrazky = array();
        foreach ($obr["main"] as $i => $obrazek)
        { //slucovani presne dvou polozek
          $obrazky[] = implode($this->valexplode, array((!Empty($obrazek["own"]) ? $obrazek["own"] : $pic_obr[$i][0]),
                                                        (!Empty($obrazek["mini"]) ? $obrazek["mini"] : $pic_obr[$i][1])));
        }

        //nacteni popisku obrazku
        $rozsah = range(0, $poc - 1);
        $popis = array();
        foreach ($rozsah as $poradi)
        { //sesbirani popisku z postu
          $popis[] = $nactene["popis{$poradi}"];
        }

        //update stavajicich hodnot
        $nastaveni["konfigurace"][0] = $mini;
        $nastaveni["konfigurace"][1] = $full;
        $nastaveni["konfigurace"][3] = $poc;

        $pole = array(implode($this->valexplode, $obrazky),
                      implode($this->valexplode, $popis));

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "oneseriefoto":
        //pokud nejsou polozky na POST-u vezme se z defaultni konfigurace
        $full = (!Empty($nactene["full"]) ? $nactene["full"] : $nastaveni["konfigurace"][0]);
        $poc = (int)(!is_null($nactene["poc"]) ? $nactene["poc"] : $nastaveni["konfigurace"][2]);
        $old = (array)$_POST[$nastaveni["name"]]["old"];
        $old_popis = (array)$_POST[$nastaveni["name"]]["popis"];

        $infinite = false;  //infinite pri uploadu
        if (!Empty($_FILES[$nastaveni["name"]]["name"]["main"][0]) &&
            $poc == 0)
        {
          //pri neomezenem poctu vrati pocet uploadovanych fotek
          $poc = count($_FILES[$nastaveni["name"]]["name"]["main"]);
          $infinite = true;
        }

        //infinite pri uprave
        if (Empty($_FILES[$nastaveni["name"]]["name"]["main"][0]) &&
            $poc == 0)
        {
          $poc = count($old);
          $infinite = true;
        }

        //zjednoduseni pole files, pri uploadu
        foreach (range(0, $poc - 1) as $i)
        {
          $_FILES[$nastaveni["name"]]["name"]["main{$i}"] = $_FILES[$nastaveni["name"]]["name"]["main"][$i];
          $_FILES[$nastaveni["name"]]["type"]["main{$i}"] = $_FILES[$nastaveni["name"]]["type"]["main"][$i];
          $_FILES[$nastaveni["name"]]["tmp_name"]["main{$i}"] = $_FILES[$nastaveni["name"]]["tmp_name"]["main"][$i];
          $_FILES[$nastaveni["name"]]["error"]["main{$i}"] = $_FILES[$nastaveni["name"]]["error"]["main"][$i];
          $_FILES[$nastaveni["name"]]["size"]["main{$i}"] = $_FILES[$nastaveni["name"]]["size"]["main"][$i];
        }
//dodelat!! absolutne predelat! spatne resena logika!!!!!
        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array($poc, array ("full" => $full))),
                                    array($nastaveni["name"], $max, array("full" => "{$this->dirpath}/{$this->pathpicture}"))
                                    );

        //nacitani obrazku z uploadu
        $pic = array();
        foreach ($obr["main"] as $obrazek)
        { //vezme z jednoho a nebo druheho vstupu
          $obraz = (!Empty($obrazek["mini"]) ? $obrazek["mini"] : $obrazek["own"]);
          if (!Empty($obraz))
          {
            $pic[] = $obraz;
          }
        }

        //slouceni starych a nove upnutych (poradi se resi uplne samo)
        //vyhazeni duplicitnich mezer
        //orezani max poctu, pri neomezenem povoli vsechny
        $obrazky = array_slice(array_unique(array_merge($old, $pic)), 0, ($infinite ? NULL : $poc));
        //projiti pole nazvu pro spravne pocty komentaru
        foreach ($obrazky as $index => $hodnota)
        { //natypovani prazdnych bunek
          settype($old_popis[$index], "string");
        }
        //slouceni obrazku a popisku
        $obrazky = array_merge($obrazky, $old_popis);

        //update stavajicich hodnot
        $nastaveni["konfigurace"][0] = $full;
        $nastaveni["konfigurace"][2] = ($infinite ? 0 : $poc);

        $result["val"] = implode($this->valexplode, $obrazky);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "download":
        //upload souboru
        $file = $this->ControlUploadFile(array("{$this->dirpath}/{$this->pathfile}" => array($nastaveni["name"], "soubor")));
        //nacteni max cisla
        $max = $nastaveni["konfigurace"][0];

        //natypovani file na pole
        settype($file["file"], "array");
        //nacitani z upnutych souboru
        $upfile["name"] = array();
        $upfile["file"] = array();
        foreach ($file["file"] as $index => $fil)
        { //kontrola jestli neni file prazdny
          if (!Empty($fil))
          { //vkladani jmena dle indexu a jmena souboru
            $upfile["name"][] = $file["name"][$index];
            $upfile["file"][] = $fil;
          }
        }

        $old_name = $_POST[$nastaveni["name"]]["old_name"];
        settype($old_name, "array"); //retypovani na pole
        $old_file = $_POST[$nastaveni["name"]]["old_file"];
        settype($old_file, "array"); //retypovani na pole
        $old_popis = $_POST[$nastaveni["name"]]["popis"];
        settype($old_popis, "array"); //retypovani na pole

        $name_merge = array_merge($old_name, $upfile["name"]);
        $file_merge = array_merge($old_file, $upfile["file"]);

        //projiti pole nazvu pro spravne pocty komentaru
        foreach ($name_merge as $index => $hodnota)
        { //natypovani prazdnych bunek
          settype($old_popis[$index], "string");
        }

        //pokud je nastavene orezavani tak orezava
        if ($max > 0)
        {
          $name_merge = array_slice($name_merge, 0, $max);
          $file_merge = array_slice($file_merge, 0, $max);
          $old_popis = array_slice($old_popis, 0, $max);
        }

        //slucovani na mensi pole
        $pole = array(implode($this->valexplode, $name_merge),
                      implode($this->valexplode, $file_merge),
                      implode($this->valexplode, $old_popis),
                      );

        //do value nazvy
        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "flash":
        $width = (!Empty($nactene["width"]) ? $nactene["width"] : $nastaveni["konfigurace"][1]);
        $height = (!Empty($nactene["height"]) ? $nactene["height"] : $nastaveni["konfigurace"][2]);

        if ($nastaveni["konfigurace"][0] == "link")
        { //pokud je link bere link z postu
          $src = $nactene["flash"];
        }
          else
        { //upload souboru
          $file = $this->ControlUploadFile(array("{$this->dirpath}/{$this->pathfile}" => array($nastaveni["name"], "flash")));
          //vraceni hodnot z value pokud se neuploaduje
          $src = (!Empty($file["file"][0]) ? $file["file"][0] : $nastaveni["value"]);
        }

        //update stavajicich hodnot
        $nastaveni["konfigurace"][1] = $width;
        $nastaveni["konfigurace"][2] = $height;

        $result["val"] = $src;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "csssprit":
        //samotny upload obrazku
        $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size
        $obr = $this->ControlPicture(array("main" => array(2, array("full" => $nastaveni["konfigurace"][0]))),
                                    array($nastaveni["name"], $max, array("full" => "{$this->dirpath}/{$this->pathpicture}"))
                                    );
        //pokud se neco uploaduje
        if (!Empty($obr["main"][0]))
        {
          //nacteni obrazku, pri zmenseni z mini, pri full z own
          $pic1 = (!Empty($obr["main"][0]["mini"]) ? $obr["main"][0]["mini"] : $obr["main"][0]["own"]);
          $pic2 = (!Empty($obr["main"][1]["mini"]) ? $obr["main"][1]["mini"] : $obr["main"][1]["own"]);

          $src = $pic1;
          $path = "{$this->dirpath}/{$this->pathpicture}";

          //zpracovani css spritu
          $this->ControlCssSprit("{$path}/{$pic1}", "{$path}/{$pic2}",
                                $nastaveni["konfigurace"][4],
                                explode(" ", $nastaveni["konfigurace"][3]),
                                ($nastaveni["konfigurace"][5] == "rgb" ? explode(",", $nastaveni["konfigurace"][6]) : NULL));

          //nacteni velikosti
          $a = getimagesize("{$path}/{$src}");
          $w = $a[0];
          $h = $a[1];
          $pole = array($src, $w, $h);
        }
          else
        { //navraceni hodnot
          $pole = explode($this->valexplode, $nastaveni["value"]);
        }

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "rewrite":
        $nazev = $_POST[$nastaveni["name"]]["nazev"];
        $rewrite = $this->RewritePrepis($nazev, "low");  //rucni prevod pro jistotu

        $pole = array($nazev,
                      $rewrite);

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "url":
        $url = $_POST[$nastaveni["name"]]["url"];
        $nazev = $_POST[$nastaveni["name"]]["nazev"];
        $target = (!Empty($_POST[$nastaveni["name"]]["target"]) ? 1 : 0);

        $pole = array($url,
                      $nazev,
                      $target);

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      case "externalfile":
        //nove oznacene
        $nove = $_POST[$nastaveni["name"]]["soubory"];
        settype($nove, "array"); //retypovani na pole
        //vyber polozek co se maji odstranit + razeni
        $list = $_POST[$nastaveni["name"]]["list"];
        settype($list, "array"); //retypovani na pole
        //pole polozek na smazani
        $del = $_POST[$nastaveni["name"]]["del"];
        //secteni aktualniho listu a novych polozek
        $aktualni = array_unique(array_merge($list, $nove));
        //nastaveni vystupniho pole
        $pole = $aktualni;
        //pokud jsou dany nejake polozky na smazani
        if (is_array($del))
        {
          $prepis = array();
          foreach ($aktualni as $polozka)
          { //odstranovani polozek
            if (!in_array($polozka, $del))
            {
              $prepis[] = $polozka;
            }
          }
          $pole = $prepis;
        }
        //ovlivneni max poctu polozek
        $max = $nastaveni["konfigurace"][1];
        if ($max > 0)
        {
          $pole = array_slice($pole, 0, $max);
        }

        $result["val"] = implode($this->valexplode, $pole);
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;

      //"upload"

      case "radio":
      case "radiocontent":
      case "select":
      case "conectmodule":  //value je tady k nicemu
      case "datum":
      case "cas":
      case "datumcas":
        $result["val"] = $value;
        $result["cfg"] = implode($this->cfgexplode, $nastaveni["konfigurace"]);
      break;
    }

    return $result;
  }

/**
 *
 * Generovani konfigurace v add/edit menu
 *
 * @param konfigurace (pole) konfigurace
 * @return definovana konfigurace menu
 */
  private function AdminKonfiguraceMenu($konfigurace, $zanoreni)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_menu"];
    //zpracovani navracene konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $element = array();
    foreach ($pole as $name => $hodnoty)
    {
      if (!is_null($this->NotIsset($hodnoty["only"], 0)) ? in_array($zanoreni, $hodnoty["only"]) : true)
      {
        $val = $this->HodnotaKonfiguraceMenu($name, $konfigurace);
        //vkladani spravne hodnoty
        $value = ($val === "" ? $hodnoty["def"] : $val);
        //vyber elementu dle typu
        switch ($hodnoty["typ"])
        {
          case "boolean":
            $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_konfigurace_menu_boolean"],
                                                  $name,
                                                  ($value ? " checked=\"checked\"" : ""),
                                                  ($value ? "true" : "false"),
                                                  $hodnoty["name"],
                                                  $hodnoty["class"]);
          break;

          case "integer":
            $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_konfigurace_menu_integer"],
                                                  $name,
                                                  $value,
                                                  $hodnoty["name"],
                                                  $hodnoty["class"]);
          break;
        }

      }
    }
    //slouceni elementu
    $result = implode("", $element);

    return $result;
  }

/**
 *
 * Vypis konfigurace menu u vypisu
 *
 * @param konfigurace (pole) konfigurace
 * @param csskonf pole nastaveni stylu: array(barva bloku, hloubka zanoreni)
 * @param od generovat od cisla 0/1, defaultne 0
 * @return vygenerovane pouzita konfigurace
 */
  private function AdminVypisKonfiguraceMenu($konfigurace, $csskonf, $od = 0, $zanoreni)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_menu"];
    $sudeliche = $this->unikatni["set_konfigurace_sude_liche"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $element = array();
    settype($od, "integer");
    $poc = $od;
    foreach ($pole as $name => $hodnoty)
    { //zobrazeni jen v neblokovanem zanoreni
      if (isset($hodnoty["only"][0]) ? in_array($zanoreni, $hodnoty["only"]) : true)
      {
        $value = $this->HodnotaKonfiguraceMenu($name, $konfigurace);
        //vyber elementu dle typu
        switch ($hodnoty["typ"])
        {
          case "boolean":
            $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_menu_boolean"],
                                                  $csskonf[0],  //cislo barvy bloku
                                                  $sudeliche[$poc % 2],
                                                  $csskonf[1],  //hloubka zanoreni
                                                  $hodnoty["name"],
                                                  ($value ? " checked=\"checked\"" : ""));
          break;

          case "integer":
            $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_menu_integer"],
                                                  $csskonf[0],  //cislo barvy bloku
                                                  $sudeliche[$poc % 2],
                                                  $csskonf[1],  //hloubka zanoreni
                                                  $hodnoty["name"],
                                                  $value);
          break;
        }

        $poc++;
      }
    }
    //slouceni elementu
    $result = implode("", $element);

    return $result;
  }

/**
 *
 * Vraceni hodnoty pozadovane z konfigurace
 *
 * @param hodnota nazev hodnoty ktera se ma vytahnout z konfigurace
 * @param konfigurace (pole) vstupni konfigurace
 * @return hodnota zadane konfigurace
 */
  private function HodnotaKonfiguraceMenu($hodnota, $konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_menu"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $ret = array_values(preg_grep("/{$hodnota}:/", $konfigurace));
    $ret = explode("{$hodnota}:", $this->NotIsset($ret, 0));
    $value = $this->NotIsset($ret, 1); //nacteni hodnoty
    //pretypovani dle typu
    switch ($pole[$hodnota]["typ"])
    {
      case "boolean": //konvert na boolean
        $result = ($value == "true");
      break;

      case "integer":
        settype($value, "integer");
        $result = $value;
      break;
    }

    return $result;
  }

/**
 *
 * Generovani konfigurace v add/edit sablone
 *
 * @param konfigurace (pole) konfigurace
 * @return definovana konfigurace sablony
 */
  private function AdminKonfiguraceSablony($konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_sablony"];
    //zpracovani navracene konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $element = array();
    foreach ($pole as $name => $hodnoty)
    {
      $value = $this->HodnotaKonfiguraceSablony($name, $konfigurace);
      //vyber elementu dle typu
      switch ($hodnoty["typ"])
      {
        case "boolean":
          $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_konfigurace_sablony"],
                                                $name,
                                                ($value ? " checked=\"checked\"" : ""),
                                                ($value ? "true" : "false"),
                                                $hodnoty["name"],
                                                $hodnoty["class"]);
        break;
      }
    }
    //slouceni elementu
    $result = implode("", $element);

    return $result;
  }

/**
 *
 * Vypis konfigurace sablony u vypisu
 *
 * @param konfigurace (pole) konfigurace
 * @param od generovat od cisla 0/1, defaultne 0
 * @return vygenerovane pouzita konfigurace
 */
  private function AdminVypisKonfiguraceSablony($konfigurace, $od = 0)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_sablony"];
    $sudeliche = $this->unikatni["set_konfigurace_sude_liche"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $element = array();
    settype($od, "integer");
    $poc = $od;
    foreach ($pole as $name => $hodnoty)
    {
      $element[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_sablony"],
                                            $sudeliche[$poc % 2],
                                            $hodnoty["name"],
                                            (in_array("{$name}:true", $konfigurace) ? " checked=\"checked\"" : ""));
      $poc++;
    }
    //slouceni elementu
    $result = implode("", $element);

    return $result;
  }

/**
 *
 * Vraceni hodnoty pozadovane z konfigurace
 *
 * @param hodnota nazev hodnoty ktera se ma vytahnout z konfigurace
 * @param konfigurace (pole) vstupni konfigurace
 * @return hodnota zadane konfigurace
 */
  private function HodnotaKonfiguraceSablony($hodnota, $konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["set_konfigurace_sablony"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $ret = array_values(preg_grep("/{$hodnota}:/", $konfigurace));
    $ret = explode("{$hodnota}:", $this->NotIsset($ret, 0));
    $value = $this->NotIsset($ret, 1); //nacteni hodnoty
    //pretypovani dle typu
    switch ($pole[$hodnota]["typ"])
    {
      case "boolean": //konvert na boolean
        $result = ($value == "true");
      break;
    }

    return $result;
  }

/**
 *
 * Hlavni administrace obsahu modulu
 *
 * @return hlavni adminstrace modulu
 */
  private function AdministraceObsahu()
  {
    $co = $this->NotEmpty("get", "co");

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addsab"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addsab" : ""),
                                        (Empty($co) ? $this->AdminVypisObsahu() : ""));

    //vytvari potrebne slozky
    $this->ControlCreateDir(array(array($this->dirpath, $this->pathpicture, $this->minidir),
                                  array($this->dirpath, $this->pathpicture, $this->fulldir),
                                  array($this->dirpath, $this->pathfile),
                                  ));

    if (!Empty($co))
    {
      switch ($co)
      {
        //obsluha sablony
        case "addsab":  //pridani sablony
        case "copysab": //duplikace sablony
          $podm_copy = ($co == "copysab");
          if ($podm_copy)
          {
            $id = (int)$_GET["id"];

            //nacitani hodnot z kopirovane sablony
            if ($data = $this->querySingleRow("SELECT adresa, nazev, razeni, max_obsah, jazyky, formenu, konfigurace, popis FROM {$this->dbpredpona}sablona WHERE id={$id};"))
            {
              $val_adresa = $data->adresa;
              $val_nazev = $data->nazev;
              $val_razeni = $data->razeni;
              $val_max_obsah = $data->max_obsah;
              $val_jazyky = $data->jazyky;
              $val_formenu = $data->formenu;
              $val_konfigurace = $data->konfigurace;
              $val_popis = $data->popis;
            }
          }
            else
          {
            //nacitani defaultnich hodnot nastaveni
            $default = $this->unikatni["admin_addsab_default"];

            $val_adresa = $default[0];
            $val_nazev = $default[1];
            $val_razeni = $default[2];
            $val_max_obsah = $default[3];
            $val_jazyky = $default[4];
            $val_formenu = $default[5];
            $val_konfigurace = $default[6];
            $val_popis = $default[7];
          }

          if (!Empty($_POST["tlacitko"]))
          { //nacitani hodnot z postu
            $val_adresa = $this->NotEmpty("post", "adresa");
            $val_nazev = $this->NotEmpty("post", "nazev");
            $val_razeni = $this->NotEmpty("post", "razeni");
            $val_max_obsah = $this->NotEmpty("post", "max_obsah");
            $val_jazyky = $this->NotEmpty("post", "jazyky");
            $val_formenu = $this->NotEmpty("post", "formenu");
            $val_konfigurace = $this->NotEmpty("post", "konfigurace");
            $val_popis = $this->NotEmpty("post", "popis");
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditsab"],
                                              $this->unikatni["admin_addeditsab_add"],
                                              $val_adresa,
                                              $val_nazev,
                                              ($val_razeni == "pridano ASC" ? " checked=\"checked\"" : ""),
                                              ($val_razeni == "pridano DESC" ? " checked=\"checked\"":  ""),
                                              ($val_razeni == "poradi ASC" ? " checked=\"checked\"" : ""),
                                              ($val_razeni == "poradi DESC" ? " checked=\"checked\"" : ""),
                                              $val_max_obsah, //8
                                              ($val_jazyky ? " checked=\"checked\"" : ""),
                                              ($val_formenu ? " checked=\"checked\"" : ""), //10
                                              $this->AdminKonfiguraceSablony($val_konfigurace),
                                              $val_popis, //12
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                        "nazev" => array("post", "string"),
                                        "razeni" => array("post", "string"),
                                        "max_obsah" => array("post", "integer"),
                                        "jazyky" => array("post", "boolean"),
                                        "formenu" => array("post", "boolean"),
                                        "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                        "popis" => array("post", "string"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "sablona", 1))), //kontrola prazdnoty a unikatnost adresy
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["adresa"]) && !Empty($_POST["nazev"]) && $this->DuplikatniHodnota("adresa", "sablona", $_POST["adresa"])),
                                array("insert", "sablona", NULL)))
          {
            //rozlisuje hlasky pridavani a nebo duplikace sablony
            if ($podm_copy)
            {//dodelat! kontrolovat aby fungovalo 100%?!!
              //zkopirovani elementu
              if ($this->ControlForm(array ("sablona" => array("self|copy", "integer", $this->lastInsertRowid()),
                                            "nazev" => array("copy", "string"),
                                            "typ" => array("copy", "string"),
                                            "konfigurace" => array("copy", "string"),
                                            "value" => array("copy", "string"),
                                            "popis" => array("copy", "string"),
                                            "povinne" => array("copy", "boolean"),
                                            "vstup" => array("copy", "string"),
                                            "reg_exp" => array("copy", "string"),
                                            "min_val" => array("copy", "integer"),
                                            "max_val" => array("copy", "integer"),
                                            "poradi" => array("copy", "integer")),
                                    true,
                                    array("copy", "element", $id)))
              {
                //pokud se podari zkopirovat
                $result = $this->Hlaska("copy", $_POST["nazev"]);
                $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              }
            }
              else
            {
              $result = $this->Hlaska("add", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            }

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editsab":  //uprava sablony
          $id = (int)$_GET["id"];

          if ($data = $this->querySingleRow("SELECT adresa, nazev, razeni, max_obsah, jazyky, formenu, konfigurace, popis FROM {$this->dbpredpona}sablona WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditsab"],
                                                $this->unikatni["admin_addeditsab_edit"],
                                                $data->adresa,
                                                $data->nazev,
                                                ($data->razeni == "pridano ASC" ? " checked=\"checked\"" : ""),
                                                ($data->razeni == "pridano DESC" ? " checked=\"checked\"":  ""),
                                                ($data->razeni == "poradi ASC" ? " checked=\"checked\"" : ""),
                                                ($data->razeni == "poradi DESC" ? " checked=\"checked\"" : ""),
                                                $data->max_obsah, //8
                                                ($data->jazyky ? " checked=\"checked\"" : ""),
                                                ($data->formenu ? " checked=\"checked\"" : ""), //10
                                                $this->AdminKonfiguraceSablony($data->konfigurace),
                                                $data->popis, //13
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                          "nazev" => array("post", "string"),
                                          "razeni" => array("post", "string"),
                                          "max_obsah" => array("post", "integer"),
                                          "jazyky" => array("post", "boolean"),
                                          "formenu" => array("post", "boolean"),
                                          "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                          "popis" => array("post", "string")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["adresa"]) &&  !Empty($_POST["nazev"]) && $id > 0),
                                array("update", "sablona", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delsab":  //mazani sablony
          $id = (int)$_GET["id"];

          if ($this->ControlDeleteForm(array ("sablona" => array("id", $id, "nazev"),
                                              "element" => array("sablona"),
                                              "obsah" => array("sablona"),
                                              "menu" => array("sablona")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        //obsluha elementu
        case "addelem": //pridani elementu
        case "copyelem":  //duplikace elementu
          $podm_copy = ($co == "copyelem");
          if ($podm_copy)
          {
            $id = (int)$_GET["id"];

            //nacitani hodnot z kopirovane sablony
            if ($data = $this->querySingleRow("SELECT sablona, nazev, typ, konfigurace, value, popis, povinne, vstup, reg_exp, min_val, max_val FROM {$this->dbpredpona}element WHERE id={$id};"))
            {
              $val_sablona = $data->sablona;
              $val_nazev = $data->nazev;
              $val_typ = $data->typ;
              $val_konfigurace = $data->konfigurace;
              $val_value = $data->value;
              $val_popis = $data->popis;
              $val_povinne = $data->povinne;
              $val_vstup = $data->vstup;
              $val_reg_exp = $data->reg_exp;
              $val_min_val = $data->min_val;
              $val_max_val = $data->max_val;
            }
          }
            else
          {
            $val_sablona = "";
            $val_nazev = "";
            $val_typ = "";
            $val_konfigurace = "";
            $val_value = "";
            $val_popis = "";
            $val_povinne = "";
            $val_vstup = "";
            $val_reg_exp = "";
            $val_min_val = "";
            $val_max_val = "";
          }

          if (!Empty($_POST["tlacitko"]))
          { //nacitani hodnot z postu
            $val_nazev = $this->NotEmpty("post", "nazev");//$_POST["nazev"];
            $val_value = $this->NotEmpty("post", "value");//$_POST["value"];
            $val_popis = $this->NotEmpty("post", "popis");//$_POST["popis"];
            $val_povinne = $this->NotEmpty("post", "povinne");//$_POST["povinne"];
          }

          $sab = (int)$this->NotEmpty("get", "sab", $val_sablona);
          $typ = $this->NotEmpty("get", "typ", $val_typ);
          $vstup = $this->NotEmpty("get", "vstup", $val_vstup);
          //nacteni hodnot ze sablony
          $retdata = $this->ControlObjectHodnoty(array("nazev", "formenu"),
                                                array("sablona", $sab));

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem"],
                                              $this->unikatni["admin_addeditelem_add"],
                                              $retdata->nazev,
                                              $this->VyberSablony($sab, $retdata->formenu),
                                              $val_nazev,
                                              $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;sab={$sab}&amp;vstup={$vstup}", $val_konfigurace),
                                              $val_value,
                                              $val_popis,
                                              ($val_povinne ? " checked=\"checked\"" : ""),
                                              $this->VyberVstupu($vstup, $typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;sab={$sab}&amp;typ={$typ}", $val_reg_exp, $val_min_val, $val_max_val),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("sablona" => array("post", "integer"),
                                        "nazev" => array("post", "string"),
                                        "typ" => array("post", "string"),
                                        "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                        "value" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "povinne" => array("post", "boolean"),
                                        "vstup" => array("post", "string"),
                                        "reg_exp" => array("post", "string"),
                                        "min_val" => array("post", "integer"),
                                        "max_val" => array("post", "integer"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "element", 1, "WHERE sablona='{$sab}'"))),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["sablona"]) && !Empty($_POST["typ"])),
                                array("insert", "element", NULL)))
          {
            //zmena hlasky pri zkopirovani elementu
            $result = $this->Hlaska(($podm_copy ? "copy" : "add"), $_POST["nazev"]);
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editelem": //uprava elementu
          $id = (int)$_GET["id"];

          if ($data = $this->querySingleRow("SELECT id, sablona, nazev, typ, konfigurace, value, popis, povinne, vstup, reg_exp, min_val, max_val FROM {$this->dbpredpona}element WHERE id={$id};"))
          {
            $sab = (int)$data->sablona;
            $typ = $this->NotEmpty("get", "typ", $data->typ);
            $vstup = $this->NotEmpty("get", "vstup", $data->vstup);
            //nacteni hodnot ze sablony
            $retdata = $this->ControlObjectHodnoty(array("nazev", "formenu"),
                                                  array("sablona", $sab));

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem"],
                                                $this->unikatni["admin_addeditelem_edit"],
                                                $retdata->nazev,
                                                $this->VyberSablony($data->sablona, $retdata->formenu),
                                                $data->nazev,
                                                $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;sab={$sab}&amp;vstup={$vstup}&amp;id={$id}", $data->konfigurace),
                                                $data->value,
                                                $data->popis,
                                                ($data->povinne ? " checked=\"checked\"" : ""),
                                                $this->VyberVstupu($vstup, $typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;sab={$sab}&amp;typ={$typ}&amp;id={$id}", $data->reg_exp, $data->min_val, $data->max_val),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("sablona" => array("post", "integer"),
                                          "nazev" => array("post", "string"),
                                          "typ" => array("post", "string"),
                                          "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                          "value" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          "povinne" => array("post", "boolean"),
                                          "vstup" => array("post", "string"),
                                          "reg_exp" => array("post", "string"),
                                          "min_val" => array("post", "integer"),
                                          "max_val" => array("post", "integer")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["sablona"]) && !Empty($_POST["typ"]) && $id > 0),
                                  array("update", "element", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "editelemobsah": //uprava elementu z obsahu
          $id = (int)$_GET["id"];
          $elemindex = (int)$this->NotEmpty("get", "elem");  //index elementu
//dodelat!!! pri dalsi brutalni aktualizaci, ukladat s obsahem vic hodnot z elementu a
//sjednotit a vylepsit ukladani!!!, kdyz uz tak se musi ukladat veskere daneho elementu nastaveni!
//jinak neni mozne aby tento blok fungoval korektne!!! proto to tunguje nekorektne!!!!
          //nacteni nastaveni sablony
          if ($data = $this->ControlObjectHodnoty(array("sablona", "menu", "konfigurace", "obsah", "typy"),
                                                  array("obsah", $id)))
          {
            $typy = explode($this->obsexplode, $data->typy);
            //vypis hodnot v danem obsahu
            foreach ($typy as $index => $hodnota)
            {
              $poc = $index + 1;
              $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_editelemobsah_row"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;id={$id}&amp;elem={$poc}",
                                                $hodnota);
            }

            if (Empty($elemindex))
            { //pred rozkliknutim
              $root = $this->RekurzivniStoupani($data->menu); //adresovani vracecich odkazu
              $retlink = (!Empty($data->menu) ? "{$this->idmodul}{$this->idmenu}__{$root[0]}&amp;menu={$data->menu}" : "{$this->idmodul}__{$data->sablona}");

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelemobsah"],
                                                  $id,
                                                  implode("", $row),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$retlink}");
            }
              else
            { //po rozkliknuti
              $elemindex--; //odecteni na puvodni hodnotu

              $konfigurace = explode($this->obsexplode, $data->konfigurace);
              $obsah = explode($this->obsexplode, $data->obsah);
              $typ = $this->NotEmpty("get", "typ", $typy[$elemindex]);
//var_dump($konfigurace);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelemobsah_edit"],
                                                  $typy[$elemindex],
                                                  $typ,
                                                  $this->VyberTypu($typ, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;sab={$data->sablona}&amp;co={$co}&amp;id={$id}&amp;elem={$elemindex}", $konfigurace[$elemindex]),
                                                  $obsah[$elemindex],
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co={$co}&amp;id={$id}");

              if (!Empty($_POST["tlacitko"]) &&
                  $id > 0)
              { //prepsani potrebneho indexu v promennych
                $typy[$elemindex] = $_POST["typ"];
                $konfigurace[$elemindex] = implode($this->cfgexplode, $_POST["konfigurace"]);
                $obsah[$elemindex] = $_POST["value"];

                //algoritmus ukladani dat
                if ($this->ControlForm(array ("konfigurace" => array("self", "array", $konfigurace, $this->obsexplode),
                                              "obsah" => array("self", "array", $obsah, $this->obsexplode),
                                              //"pridano" => array("self", "date", "now"),
                                              "upraveno" => array("self", "date", "now"),
                                              "typy" => array("self", "array", $typy, $this->obsexplode)),
                                      true,
                                      array("update", "obsah", $id)))
                {
                  $result = $this->Hlaska("edit", $_POST["typ"]);
                  $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&co={$co}&id={$id}");  //auto kliknuti
                }
              }
            }
          }
        break;

        case "delelem": //mazani elementu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("element" => array("id", $id, "nazev")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Rychlo vypis menu se scroll odkazy
 *
 * @return odkazy do menu
 */
  private function AdminVypisObsahScrollTo()
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona_scrollto"],
                                            $data->id,
                                            $data->nazev);
      }
    }
      else
    {
      $result = $this->unikatni["admin_vypis_sablona_scrollto_null"];
    }

    return $result;
  }

/**
 *
 * Vypis administrace obsahu sablon
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $copysab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["copysab"];
    $editsab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editsab"];
    $delsab_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delsab"];

    $addelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["addelem"];
    $copyelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["copyelem"];
    $editelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editelem"];
    $delelem_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delelem"];

    $rad = array();
    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, nazev, max_obsah, formenu, konfigurace FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $row = array();
        if ($res1 = $this->queryMultiObjectSingle("SELECT id, nazev, typ, konfigurace, value, povinne, poradi FROM {$this->dbpredpona}element WHERE sablona={$data->id} ORDER BY poradi ASC;"))
        {
          $i = 10;  //pocatek pocitani indexu v hlavnim vypisu

          //vypis elementu
          foreach ($res1 as $data1)
          {
            $delka = $this->PocitaniProcentElementu($data1->typ, $data1->konfigurace);
            $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_element"],
                                              $data1->id,
                                              $this->typ_elementu[$data1->typ],
                                              $data1->value,
                                              $data1->nazev,
                                              ($data1->povinne ? " checked=\"checked\"" : ""),
                                              $data1->poradi,
                                              $i,
                                              $i + $delka - 1,
                                              ($copyelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=copyelem&amp;id={$data1->id}" : ""),
                                              ($editelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}" : ""),
                                              ($delelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}" : ""));
            $i += $delka; //pricitani delek
          }
        }
          else
        {
          $row[] = $this->unikatni["admin_vypis_obsah_element_null"]; //null elementu
        }

        $rad[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_sablona"],
                                          $data->id,
                                          $data->adresa,
                                          $data->nazev,
                                          ($data->max_obsah > 0 ? $data->max_obsah : $this->unikatni["admin_vypis_obsah_sablona_infinite"]),
                                          ($data->formenu ? " checked=\"checked\"" : ""),
                                          $this->AdminVypisKonfiguraceSablony($data->konfigurace),  //6
                                          ($copysab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=copysab&amp;id={$data->id}" : ""),
                                          ($editsab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editsab&amp;id={$data->id}" : ""),
                                          ($delsab_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delsab&amp;id={$data->id}" : ""),
                                          ($addelem_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$data->id}" : ""),
                                          implode("", $row));
      }
    }
      else
    {
      $rad[] = $this->unikatni["admin_vypis_obsah_sablona_null"]; //null sablon
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_sablona_begin"],
                                        $this->dirpath,
                                        $this->AdminVypisObsahScrollTo(),
                                        implode("", $rad));

    return $result;
  }

/**
 *
 * Vypisuje polozky sablon a umoznuje je radit
 *
 * @return vypis polozek sablon
 */
  private function AdminVypisRazeniSablony()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_razeni_sablony_begin"],
                                        $this->dirpath);

    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, nazev, poradi FROM {$this->dbpredpona}sablona ORDER BY poradi ASC;"))
    {
      //vypis sablon
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_razeni_sablony"],
                                            $data->id,
                                            $data->poradi,
                                            $data->adresa,
                                            $data->nazev);
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_razeni_sablony_null"];
    }

    $result .= $this->unikatni["admin_vypis_razeni_sablony_end"];

    return $result;
  }

/**
 *
 * Zobrazuje skryte nastaveni menu
 *
 * @param adresa naadresovani menu
 * @param max_zanoreni cislo max zanoreni menu
 * @return html skryte sekce
 */
  private function SkrytaSekceNastaveniCentralMenu($adresa = NULL, $max_zanoreni = NULL)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_skryta_sekce_nastaveni_menu"],
                                        $adresa,
                                        $max_zanoreni);

    return $result;
  }

/**
 *
 * Hlavni administrace menu
 *
 * @return obsluha menu
 */
  private function AdminCentralMenu()
  {
    $addmenu = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_menu_addmenu"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addmenu"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=addmenu" : ""));

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_menu"],
                                        ($this->var->admin_mod ? $addmenu : ""),
                                        $this->AdminVypisCentralMenu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addmenu": //pridavani menu
          $zan = (int)$this->NotEmpty("get", "zan", 0);  //cislo zanoreni
          $koren = (int)$this->NotEmpty("get", "root"); //cislo korenoveho id

          $rootid = $this->RekurzivniStoupani($koren);
          settype($rootid[0], "integer"); //pretypovani, v pri pridavani do korene je nula!
          $max_zanoreni = $this->VypisHodnotu("max_zanoreni", "menu", $rootid[0]);

          if (!Empty($_POST["tlacitko"]))
          {
            $val_sablona = $_POST["sablona"];
            //jazyk
            $val_nazev = $_POST["nazev"];
            $val_rewrite = $_POST["rewrite"];
            $val_adresa  = $_POST["adresa"];
            $val_max_zanoreni = $_POST["max_zanoreni"];
            $val_konfigurace = $_POST["konfigurace"];
          }
            else
          { //dodelat!!
            $val_max_zanoreni = 0;
            //predoznaci sablonu ze sveho rodice
            $val_sablona = (!Empty($koren) ? $this->VypisHodnotu("sablona", "menu", $koren) : "");
            $val_nazev = "";
            $val_rewrite = "";
            $val_adresa = "";
            //$val_max_zanoreni
            $val_konfigurace = "";
          }
//jak na jazyky???? nejak propojit s volbama sablony????
          $jazyk = false; //nastaveni jazyka

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditmenu"],
                                              "{$this->dirpath}/{$this->generated[0]}",
                                              $this->unikatni["admin_addeditmenu_add"],
                                              $zan,
                                              $this->VyberSablony($val_sablona, true),
                                              ($jazyk ? "volitelný jazyk - skryvane dle nastaveni sablony, casem dodelat!<br />" : ""),
                                              $val_nazev,
                                              $val_rewrite,
                                              ($zan == 0 && $this->var->admin_mod ? $this->SkrytaSekceNastaveniCentralMenu($val_adresa, $val_max_zanoreni) : ""),
                                              ($this->var->admin_mod ? $this->AdminKonfiguraceMenu($val_konfigurace, $zan) : ""),
                                              $this->VypisZanoreniMenu($zan, $koren),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");
//dodelat!!! vyresit prenos nastaveni konfigurace pri pridavani menu uzivatelem!!!
//zkopirovani nastaveni z korenoveho alementu a enbo nejaka predvolena nastaveni?!!!
          //hlidani maximalniho zanoreni
          $next_zanoreni = ($max_zanoreni > 0 ? $zan <= $max_zanoreni : true);
//musi byt povinna sablona!
//&& !Empty($_POST["rewrite"])
          if ($this->ControlForm(array ("adresa" => array("post", "string"),
                                        "sablona" => array("post", "integer"),
                                        "jazyk" => array("post", "integer"),
                                        "nazev" => array("post", "string"), //rewrite se pro jistotu prepisuje manualne
                                        "rewrite" => array("self", "string", $this->RewritePrepis($this->NotEmpty("post", "nazev"), "low")),
                                        "zanoreni" => array("self", "integer", $zan),
                                        "koren" => array("self", "integer", $koren),
                                        "defaultni" => array("self", "boolean", $this->VypisPocetRadku("poradi", "menu", 1, "WHERE koren={$koren}") == 1 ? 1 : 0),
                                        "max_zanoreni" => array("post", "integer"),
                                        "konfigurace" => array("post", "array", NULL, $this->cfgexplode),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "menu", 1, "WHERE zanoreni={$zan}"))),
                              (!Empty($_POST["tlacitko"]) && !Empty($_POST["sablona"]) && !Empty($_POST["nazev"]) && $next_zanoreni && $this->DuplikatniHodnota("rewrite", "menu", $_POST["rewrite"], "zanoreni='{$zan}' AND koren='{$koren}' AND ")),
                              array("insert", "menu", NULL)))
          {
            //pridani posledniho id do submenu korene
            if ($zan > 0 &&
                $koren > 0)
            { //nacteni noveho id
              $last_id = $this->lastInsertRowid();
              //nacteni submenu z rootu
              $submenu = $this->VypisHodnotu("submenu", "menu", $koren);
              //vlozeni noveho id a nebo pripojeni noveho id na konec
              $submenu = (Empty($submenu) ? $last_id : "{$submenu}-{$last_id}");
              $this->NastavHodnotu("submenu", $submenu, "menu", $koren);
            }

            $result = $this->Hlaska("add", $_POST["nazev"]);
            $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");  //auto kliknuti
          }
        break;

        case "editmenu":  //uprava menu
          $id = (int)$_GET["id"];

          if ($data = $this->querySingleRow("SELECT adresa, sablona, jazyk, nazev, rewrite, zanoreni, koren, submenu, defaultni, max_zanoreni, konfigurace FROM {$this->dbpredpona}menu WHERE id={$id};"))
          {
            $jazyk = false;

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditmenu"],
                                                "{$this->dirpath}/{$this->generated[0]}",
                                                $this->unikatni["admin_addeditmenu_edit"],
                                                $data->zanoreni,
                                                $this->VyberSablony($data->sablona, true),
                                                ($jazyk ? "volitelný jazyk - skryvane dle nastaveni sablony, casem dodelat!<br />" : ""),
                                                $data->nazev,
                                                $data->rewrite,
                                                ($data->zanoreni == 0 && $this->var->admin_mod ? $this->SkrytaSekceNastaveniCentralMenu($data->adresa, $data->max_zanoreni) : ""),
                                                ($this->var->admin_mod ? $this->AdminKonfiguraceMenu($data->konfigurace, $data->zanoreni) : ""),
                                                $this->VypisZanoreniMenu($data->zanoreni, $data->koren),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");
//&& !Empty($_POST["rewrite"])
            if ($this->ControlForm(array ("adresa" => array("post|opt", "string", $data->adresa),
                                          "sablona" => array("post", "integer"),
                                          "jazyk" => array("post", "integer"),  //dodelat!! ?!
                                          "nazev" => array("post", "string"), //rewrite se pro jistotu prepisuje manualne
                                          "rewrite" => array("self", "string", $this->RewritePrepis($this->NotEmpty("post", "nazev"), "low")),
                                          "max_zanoreni" => array("post|opt", "integer", $data->max_zanoreni),
                                          "konfigurace" => array("post|opt", "array", explode($this->cfgexplode, $data->konfigurace), $this->cfgexplode),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")),
                                (!Empty($_POST["tlacitko"])&& !Empty($_POST["sablona"]) && !Empty($_POST["nazev"]) && $id > 0),
                                array("update", "menu", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["nazev"]);
              $this->AdminAddActionLog($_POST["nazev"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");  //auto kliknuti
            }
          }
        break;

        case "delmenu": //mazani menu
          $id = (int)$_GET["id"];
          //nacitani koreni a defaulni polozky z aktualne mazane polozky
          $retdata = $this->ControlObjectHodnoty(array("koren", "defaultni", "zanoreni"),
                                                array("menu", $id));
          //nacteni submenu podle korene
          $submenu = explode("-", $this->VypisHodnotu("submenu", "menu", $retdata->koren));
          //kopie id a prevod na array
          $arrayid = $id;
          settype($arrayid, "array");
          //diff pole a slouceni pro submenu
          $newsubmenu = implode("-", array_diff($submenu, $arrayid));
          //pokud je aktualni mazana polozka jako defaultni, a mimo hlavni uroven
          $newdefid = "";
          if ($retdata->defaultni && $retdata->zanoreni > 0)
          { //nacte si pocet bloku s danym korenem
            $pockor = $this->VypisHodnotu("COUNT(id)", "menu", $retdata->koren, "koren=");
            //pokud je v bloku vic jak jedno menu
            if ($pockor > 1)
            {
              $newdefid = $this->VypisHodnotu("id", "menu", NULL, "defaultni=0 AND koren='{$retdata->koren}' LIMIT 0,1");
            }
          }

          $rek_id = $this->RekurzivniKlesani($id);  //nasteni subid pro smazani submenu
          if ($this->ControlDeleteForm(array("menu" => array("id", $rek_id, "nazev")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            //prenastaveni cisla menu na 0 vsem obsahum pridruzenym obsahu
            $this->NastavHodnotu("menu", 0, "obsah", $id, "menu=");
            //oprava submenu v korenu
            $this->NastavHodnotu("submenu", $newsubmenu, "menu", $retdata->koren);
            //pokud polozka byla defaultni, tak ji opravi
            if (!Empty($newdefid))
            {
              $this->NastavHodnotu("defaultni", 1, "menu", $newdefid);  //oprava defaultni polozky
            }
            $this->AdminAddActionLog($nazev, array(__LINE__, __METHOD__));
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje menu zadane urovne a sablony pro presun drag'n'drop
 *
 * @param zanoreni hloubka zanoreni
 * @param koren koren menu
 * @return vypis na drag'n'drop
 */
  private function VypisZanoreniMenu($zanoreni, $koren)
  {
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    settype($koren, "integer");  //pretypovani cisla korenu

    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, koren, submenu, defaultni FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni} AND koren={$koren}
                                              ORDER BY poradi ASC;"))
    {
      //vypis zanoreni menu
      $row = array();
      foreach ($res as $data)
      {
        $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zanoreni_menu_row"],
                                          $data->id,
                                          $data->nazev,
                                          ($data->defaultni ? " checked=\"checked\"" : ""),
                                          (!Empty($data->submenu) ? $this->unikatni["admin_vypis_zanoreni_menu_submenu"] : ""));
      }
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_zanoreni_menu"],
                                          $this->dirpath,
                                          implode("", $row));
    }
      else
    {
      $result = $this->unikatni["admin_vypis_zanoreni_menu_null"]; //null zanoreni menu
    }

    return $result;
  }

/**
 *
 * Vypis administrace obsahu menu
 *
 * @return vypis obsahu
 */
  private function AdminVypisCentralMenu()
  {
    $array_id = $this->VypisPolozky("id", "sablona");
    $array_nazev = $this->VypisPolozky("nazev", "sablona");
    //nacteni id=>nazev sablony
    $this->cachenamesab = array_combine($array_id, $array_nazev);

    //nacteni opravneni pro ovladani
    $addmenu_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["addmenu"];
    $editmenu_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editmenu"];
    $delmenu_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delmenu"];

//dodelat!!
//aplikovat zamky!!!! na pridavani!!!
//kam patri zamky ? na polozky menu a nebo na zamikani obsahu???
//u menu zamkne odmazani sama sebe + pridat submenu - do konfigu!!!
//u pridavani obsahu zamkne pridat obsah(i smazat obsah?!!)
//propojovani obsahu a menu,
//dodelat!!!!!!!!!!!!!!!!!!!!!!!!!

    if ($res = $this->queryMultiObjectSingle("SELECT id, adresa, sablona, nazev, zanoreni, koren, submenu, max_zanoreni, konfigurace FROM {$this->dbpredpona}menu WHERE zanoreni=0 ORDER BY poradi ASC;"))
    {
      //vypis menu
      $row = array();
      foreach ($res as $data)
      {
        //dalsi polozky se budou generovat jidou strucnou funkci po stavajici menu
        $zan = $data->zanoreni + 1;

        $submenu = "";
        if (!Empty($data->submenu))
        { //rekurzivni vykreslovani ostatnich polozek
          $submenu = $this->AdminRekurzivniVypisCentralMenu($zan, $data->submenu);
        }

        $addmenu = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_central_menu_addmenu"],
                                            ($addmenu_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=addmenu&amp;zan={$zan}&amp;root={$data->id}" : ""),
                                            18);

        $delmenu = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_central_menu_delmenu"],
                                            ($delmenu_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=delmenu&amp;id={$data->id}" : ""),
                                            $data->nazev,
                                            18);
//dodelat!! doaplikovat zamky!
//$this->HodnotaKonfiguraceMenu("zamek_menu", $data->konfigurace)
        $zamek_menu = (!$this->var->admin_mod ? $this->HodnotaKonfiguraceMenu("zamek_menu", $data->konfigurace) : false);
//var_dump($zamek_menu);
        $next_zanoreni = ($data->max_zanoreni > 0 ? $data->zanoreni < $data->max_zanoreni : true);
        $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_central_menu_row"],
                                          $data->id,
                                          $data->adresa,
                                          $this->cachenamesab[$data->sablona],
                                          $data->nazev, //4
                                          ($data->max_zanoreni > 0 ? $data->max_zanoreni : $this->unikatni["admin_vypis_central_menu_infinite"]),
                                          $this->AdminVypisKonfiguraceMenu($data->konfigurace, array(4, 0), NULL, $data->zanoreni),  //6
                                          ($editmenu_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=editmenu&amp;id={$data->id}" : ""),
                                          (!$zamek_menu ? $delmenu : ""),
                                          ($next_zanoreni && !$zamek_menu ? $addmenu : ""),
                                          $submenu);  //10

        if (Empty($data->submenu))
        {
          $row[] = $this->unikatni["admin_vypis_central_menu_row_null"];
        }
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_central_menu"],
                                          $this->dirpath,
                                          implode("", $row));
    }
      else
    {
      $result = $this->unikatni["admin_vypis_central_menu_null"];
    }

    return $result;
  }

/**
 *
 * Rekurzivny vypis polozek pod hlavnim menu (vcetne jejich obsahu?)
 *
 * @param zanoreni cislo zanoreni na vypis
 * @param submenu submeny na vykresleni
 * @return reurzivni vypis
 */
  private function AdminRekurzivniVypisCentralMenu($zanoreni = 0, $submenu = NULL)
  {
    $result = "";
    //rozdeneni sub polozek na vykresleni
    $sub = explode("-", $submenu);
    $subpolozky = "";
    if (!Empty($submenu))
    { //slozeni sub dotazu na vykresleni jen urcitych id
      $id = implode(", ", $sub);
      $subpolozky = "AND id IN ({$id})";
    }

    $zanpoc = $this->unikatni["admin_vypis_central_menu_pocitani"];

    //nacteni opravneni pro ovladani
    $addmenu_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["addmenu"];
    $editmenu_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["editmenu"];
    $delmenu_permit = $this->localpermit[$_GET[$this->var->get_idmodul]]["delmenu"];

    if ($res = $this->queryMultiObjectSingle("SELECT id, sablona, nazev, zanoreni, koren, submenu, defaultni, konfigurace FROM {$this->dbpredpona}menu
                                              WHERE zanoreni={$zanoreni}
                                              {$subpolozky}
                                              ORDER BY poradi ASC;"))
    {
      //vypis rekurzivniho menu
      $row = array();
      foreach ($res as $data)
      {
        $zan = $data->zanoreni + 1;

        $submenu = "";
        if (!Empty($data->submenu))
        { //rekurzivni vykreslovani ostatnich polozek
          $submenu = $this->AdminRekurzivniVypisCentralMenu($zan, $data->submenu);
        }

        $addmenu = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_central_menu_addmenu"],
                                            ($addmenu_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=addmenu&amp;zan={$zan}&amp;root={$data->id}" : ""),
                                            4);

        $delmenu = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_central_menu_delmenu"],
                                            ($delmenu_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=delmenu&amp;id={$data->id}" : ""),
                                            $data->nazev,
                                            4);

        $pocitani = $zanpoc * $data->zanoreni;
        //pocitani max zanoreni?
        $rootid = $this->RekurzivniStoupani($data->id);
        $max_zanoreni = $this->VypisHodnotu("max_zanoreni", "menu", $rootid[0]);
        $next_zanoreni = ($max_zanoreni > 0 ? $data->zanoreni < $max_zanoreni : true);

        $zamek_menu = (!$this->var->admin_mod ? $this->HodnotaKonfiguraceMenu("zamek_menu", $data->konfigurace) : false);

        $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_rekurzivni_vypis_central_menu_row"],
                                          $data->id,
                                          $pocitani,  //2
                                          $this->cachenamesab[$data->sablona],
                                          $data->nazev, //4
                                          $data->zanoreni,  //5
                                          $data->koren, //6
                                          ($data->defaultni ? " checked=\"checked\"" : ""),
                                          $this->AdminVypisKonfiguraceMenu($data->konfigurace, array(1, $pocitani), 1, $data->zanoreni),
                                          ($editmenu_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}&amp;co=editmenu&amp;id={$data->id}" : ""),
                                          (!$zamek_menu ? $delmenu : ""),
                                          ($next_zanoreni && !$zamek_menu ? $addmenu : ""),
                                          $submenu);  //12

/*
        if (Empty($data->submenu))
        {
          $row[] = $this->unikatni["admin_vypis_central_menu_row_null"];
        }
*/
      }

      $result = implode("", $row);
    }

    return $result;
  }

/**
 *
 * Vypise obsah skupiny menu, univerzalni vypis
 *
 * @param menu id daneho menu
 * @return obsah skupny menu s odkazy
 */
  private function AdminObsahCentralMenu($menu)
  {
    settype($menu, "integer");
    //nacitani zvoleneho id menu
    $idmenu = (!Empty($_GET["menu"]) ? $_GET["menu"] : $menu);
    settype($idmenu, "integer");

    //nacteni hodnot ze sablony
    $retdata = $this->ControlObjectHodnoty(array("sablona", "konfigurace", "nazev"),
                                          array("menu", $idmenu));

    $idsablona = "{$this->idmodul}__{$retdata->sablona}";  //id sablony
    $addobsah_permit = $this->localpermit[$idsablona]["addobsah"];

    $addobsah = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_menu_addobsah", $menu),
                                          ($addobsah_permit ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$idsablona}&amp;co=addobsah&amp;menu={$idmenu}&amp;ret={$this->idmodul}{$this->idmenu}__{$menu}" : ""));

    $zamek_obsah = (!$this->var->admin_mod ? $this->HodnotaKonfiguraceMenu("zamek_obsahu", $retdata->konfigurace) : false);

    $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_obsah_central_menu", $menu),
                                        $retdata->sablona,
                                        (!$zamek_obsah ? $addobsah : ""),
                                        $retdata->nazev,
                                        $this->VypisMenu($menu, $idmenu),
                                        $this->VypisDrobNavMenu($menu, $idmenu),
                                        $this->AdminVypisObsahSablony($retdata->sablona, $idmenu));

    return $result;
  }

/**
 *
 * Menu pro pridavani obsahu
 *
 * @param menu cislo aktualniho korene menu
 * @param idmenu aktualni id polozky menu
 * @return seskladane menu pro pridavani obsahu
 */
  private function VypisMenu($menu, $idmenu = 0)
  {
    $result = "";
    settype($idmenu, "integer");  //pretypovani cisla id menu
    //nacteni dat pro vykresneni podle vlozeneho id menu
    $retdata = $this->ControlObjectHodnoty(array("zanoreni", "koren", "submenu"),
                                          array("menu", $idmenu));

    $zanoreni = $retdata->zanoreni; //nacteni zanoreni
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    $koren = $retdata->koren; //nacteni korenu
    settype($koren, "integer");  //pretypovani cisla korenu
    $submenu = $retdata->submenu; //nacteni submenu

    //pokud je detekovane submenu
    if (!Empty($submenu))
    { //pricte zanoreni a koren bude predesle menu
      $zanoreni += 1;
      $koren = $idmenu;

      //vypis polozek podle direkci
      if ($res = $this->queryMultiObjectSingle("SELECT id, sablona, nazev, rewrite, zanoreni, koren, submenu, defaultni, konfigurace
                                                FROM {$this->dbpredpona}menu
                                                WHERE zanoreni={$zanoreni} AND koren={$koren}
                                                ORDER BY poradi ASC;"))
      {
        //vypis menu
        $row = array();
        foreach ($res as $data)
        {
          $idsablona = "{$this->idmodul}__{$data->sablona}";

          //oznacovani aktivnich polozek, pri oznacem menu, nebo pri defaultni polozce
          $row[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_menu_row", $menu),
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}__{$menu}&amp;menu={$data->id}",
                                            $data->nazev,
                                            (!Empty($data->submenu) ? $this->EqTv($this->unikatni, "admin_vypis_menu_submenu", $menu) : ""),
                                            $data->zanoreni,  //4 pryc
                                            ($data->defaultni ? " checked=\"checked\"" : ""), //7
                                            $this->VypisHodnotu("COUNT(id)", "obsah", $data->id, "menu=")); //pocet polozek je pod danym menu
        }

        $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_menu", $menu),
                                            implode("", $row));
      }
    }

    return $result;
  }

/**
 *
 * Drobeckova navigace u pridavani obsahu do menu
 *
 * @param menu cislo aktualniho korene menu
 * @param idmenu idmenu aktualni id polozky menu
 * @return seskladana drobeckova navigace
 */
  private function VypisDrobNavMenu($menu, $idmenu = 0)
  {
    $result = "";
    settype($idmenu, "integer");  //pretypovani cisla id menu
    //nacteni dat pro vykresneni podle vlozeneho id menu
    $dat = $this->querySingleRow("SELECT zanoreni, koren, submenu FROM {$this->dbpredpona}menu WHERE id={$idmenu};");

    $zanoreni = $dat->zanoreni; //nacteni zanoreni
    settype($zanoreni, "integer");  //pretypovani cisla zanoreni
    $koren = $dat->koren; //nacteni korenu
    settype($koren, "integer");  //pretypovani cisla korenu

    //vybere si jen id od nuly do predposledniho
    $drobid = $this->RekurzivniStoupani($koren);
    $drobid[] = $idmenu;

    //vygenerovani podminky sql pro vyber polozek drobeckove navigace
    $subpolozky = "0";
    if (!Empty($drobid[0]))
    {
      $id = implode(", ", $drobid);
      $subpolozky = "id IN ({$id})";
    }

    $ret = array();
    //vypis polozek podle direkci
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, rewrite, zanoreni, koren
                                              FROM {$this->dbpredpona}menu
                                              WHERE {$subpolozky}
                                              ORDER BY zanoreni ASC;"))
    {
      //vypis drobeckove navigace
      foreach ($res as $index => $data)
      {
        if ($index != (count($res) - 1))
        { //odkaz
          $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_drobek_href", $menu),
                                            $data->id,
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmenu}__{$menu}&amp;menu={$data->id}",
                                            $data->nazev,
                                            $data->rewrite,
                                            $data->zanoreni);
        }
          else
        { //text
          $ret[] = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_drobek_text", $menu),
                                            $data->id,
                                            $data->nazev,
                                            $data->rewrite,
                                            $data->zanoreni);
        }
      }
    }
    //pokud je vys nez v 0 urovni
    if ($zanoreni > 0)
    {
      //slouceni pole drobeckove navigace
      $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "admin_vypis_drobek", $menu),
                                          implode($this->EqTv($this->unikatni, "admin_vypis_drobek_sep", $menu), $ret));
    }

    return $result;
  }


}
?>
