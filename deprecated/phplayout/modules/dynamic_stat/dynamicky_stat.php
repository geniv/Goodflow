<?php

/**
 *
 * Blok dynamicky generovaneho status-u projektu
 *
 */

class DynamicStat extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dynstat";  //id pro rozliseni modulu v adminu
  private $idstat = "_alllog";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze

  private $prihlaseno;
  private $max_fin_logu = 10;


/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->prihlaseno = false;

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
      if (!$this->PripojeniDatabaze($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $this->Instalace();

      $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        $this->idstat)));
    }
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
      $adr = explode("__", $_GET[$this->var->get_idmodul]); //rozdeleni adresy
      switch ($adr[0])
      {
        case $this->idmodul:  //id modul
          $result = (!Empty($adr[1]) ? $this->AdminObsahProjektu($adr[1]) : $this->AdministraceObsahu());
        break;

        case "{$this->idmodul}{$this->idstat}": //statistiky
          $result = $this->AdminStatistikaLogu();
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
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}projekt (
                                    id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                    login VARCHAR(100),
                                    heslo VARCHAR(100),
                                    nazev VARCHAR(200),
                                    popis TEXT,
                                    cena INTEGER UNSIGNED,
                                    zacatek DATETIME,
                                    konec DATETIME,
                                    grafika INTEGER UNSIGNED,
                                    grafika_popis TEXT,
                                    kod INTEGER UNSIGNED,
                                    kod_popis TEXT,
                                    program INTEGER UNSIGNED,
                                    program_popis TEXT,
                                    aktivni BOOL,
                                    href_id VARCHAR(200),
                                    href_class VARCHAR(200),
                                    href_akce VARCHAR(500),
                                    zobrazit BOOL,
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}projektlog (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    projekt INTEGER UNSIGNED,
                                    datum DATETIME,
                                    ip VARCHAR(50),
                                    agent VARCHAR(300));
                                  ", $error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
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
    if ($res = $this->queryMultiObjectSingle("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}projekt ORDER BY poradi ASC;", $error))
    {
      $i = count($adresa);
      foreach ($res as $data) //rozsireni menu
      {
        $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";
        $adresa[$i]["odkaz"] = $data->nazev;
        $adresa[$i]["title"] = $data->nazev;
        $adresa[$i]["id"] = $data->href_id;
        $adresa[$i]["class"] = $data->href_class;
        $adresa[$i]["akce"] = $data->href_akce;
        $adresa[$i]["zobrazit"] = $data->zobrazit;
        $i++;
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $adresa;
  }

/**
 *
 * Uzivatelsky vypis statistyk projektu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicStat", "UserStatus"[, 1]);
 *
 * @param tvar cislo tvaru
 * @return vypis projektu
 */
  public function UserStatus($tvar = 1)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_stat_login_{$tvar}"],
                                        "stat_login",
                                        "stat_heslo",
                                        "stat_tlacitko");

    if (!Empty($_POST["stat_login"]) &&
        !Empty($_POST["stat_heslo"]) &&
        !Empty($_POST["stat_tlacitko"]))
    {
      $data = $this->AutorizaceUzivatele($_POST["stat_login"], $_POST["stat_heslo"]);
      if ($data->id > 0)
      {
        $this->prihlaseno = true; //pro detekci prihlaseni
        $tvar_datum = $this->unikatni["normal_stat_tvar_datum_{$tvar}"];

        $grafika = $this->LastParagraph($data->grafika_popis);
        $kod = $this->LastParagraph($data->kod_popis);
        $program = $this->LastParagraph($data->program_popis);

        $result = $this->NactiUnikatniObsah($this->unikatni["normal_stat_vypis_{$tvar}"],
                                            $this->absolutni_url,
                                            $data->nazev,
                                            $data->popis,
                                            $data->login, //3
                                            $this->MezeraCisla($data->cena),
                                            date($tvar_datum, strtotime($data->zacatek)),
                                            ($data->konec != "1970-01-01 01:00:00" ? date($tvar_datum, strtotime($data->konec)) : ""),
                                            $data->grafika,
                                            (!Empty($grafika) ? html_entity_decode($grafika, NULL, "UTF-8") : $this->unikatni["normal_stat_grafika_null_{$tvar}"]),
                                            $data->kod,
                                            (!Empty($kod) ? html_entity_decode($kod, NULL, "UTF-8") : $this->unikatni["normal_stat_kod_null_{$tvar}"]),
                                            $data->program,
                                            (!Empty($program) ? html_entity_decode($program, NULL, "UTF-8") : $this->unikatni["normal_stat_program_null_{$tvar}"]));
      }
        else
      {
        $result = $this->unikatni["normal_stat_wrong_login_{$tvar}"];
      }
    }
      else
    {
      $this->prihlaseno = false;
    }

    return $result;
  }

/**
 *
 * Rozslisujici text pro index
 *
 * pouziti (musi byt az za UserStatus!!):
 * $text = $this->var->main[0]->NactiFunkci("DynamicStat", "UserStatusClass"[, 1]);
 *
 * @param tvar cislo tvaru
 * @return text pro tridu na rozliseni login/logoff
 */
  public function UserStatusClass($tvar = 1)
  {
    $result = ($this->prihlaseno ? $this->unikatni["normal_stat_class_true_{$tvar}"] : $this->unikatni["normal_stat_class_false_{$tvar}"]);

    return $result;
  }

/**
 *
 * Kontrola autorizace uzivatele
 *
 * @param login prihlasovaci login
 * @param heslo prihlasovaci heslo
 * @return objekt nacteheho uzivatele
 */
  private function AutorizaceUzivatele($login, $heslo)
  {
    $result = "";
    if ($data = $this->querySingleRow("SELECT id, login, nazev, popis, cena, zacatek, konec, grafika, grafika_popis, kod, kod_popis, program, program_popis
                                      FROM {$this->dbpredpona}projekt
                                      WHERE
                                      login='{$this->ChangeWrongChar($login)}' AND
                                      heslo='{$this->ChangeWrongChar($heslo)}' AND
                                      aktivni=1;", $error))
    {
      $result = $data;  //predani datoveho objektu
      //zalogovani prihlaseni uzivatele
      $this->AddLogProjekt($data->id);
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Loguje vstupy
 *
 * @param projekt id projektu
 */
  private function AddLogProjekt($projekt)
  {
    settype($projekt, "integer");
    if (!$this->ControlForm(array("projekt" => array("self", "integer", $projekt),
                                  "datum" => array("self", "date", "now"),
                                  "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                  "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"])),
                          true,
                          array("insert", "projektlog", NULL),
                          $error))
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
  }

/**
 *
 * Vypis logovani uzivatelu
 *
 * @param projekt id projektu
 * @param uzavreno bool o tom jestli je projekt uzavreni ci nikoli
 * @return vypis
 */
  private function AdminVypisLogProjekt($projekt, $uzavreno)
  {
    settype($projekt, "integer");

    $nazev = $this->VypisHodnotu("nazev", "projekt", $projekt); //nacte nazev projektu
    $pocet = $this->VypisHodnotu("COUNT(id)", "projektlog", $projekt, "projekt="); //nacte pocet radku logu
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_log_begin"],
                                        $nazev,
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$projekt}",
                                        ($uzavreno && $pocet > $this->max_fin_logu ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_log_begin_clear"],
                                                                                                              $nazev,
                                                                                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$projekt}&amp;co=clearlog") : "")
                                        );

    if ($res = $this->queryMultiObjectSingle("SELECT id, datum, ip, agent FROM {$this->dbpredpona}projektlog l WHERE projekt={$projekt} ORDER BY l.datum DESC;", $error))
    {
      $tvar_datum = $this->unikatni["admin_log_tvar_datum"];
      //vypis logu projektu
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_log"],
                                            $data->id,
                                            date($tvar_datum, strtotime($data->datum)),
                                            $data->ip,
                                            $this->TypOS($data->agent),
                                            $this->TypBrowseru($data->agent));
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_log_null"]; //null log
      }
    }

    $result .= $this->unikatni["admin_vypis_log_end"];

    return $result;
  }

/**
 *
 * Promaze logy pristupu uzivatelu na poslednich 10 zaznamu
 *
 * @param projekt id projektu
 * @return hlaska stavu
 */
  private function AdminClearLogProjekt($projekt)
  {
    settype($projekt, "integer");
    //necha poslednich 10 zaznamu
    if ($this->ControlDeleteLast(array("projektlog" => array($this->max_fin_logu, $projekt, "projekt=")), $pocet, $error))
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_clearlog_hlaska"], $pocet);

      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$projekt}&amp;co=log");  //auto kliknuti
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Vypis statistik daneho projektu
 *
 * @param projekt id projektu
 * @return statistiky
 */
  private function AdminStatLogProjekt($projekt)
  {
    settype($projekt, "integer");

    $result = "";
    $datum = $ip = $agent = $opersys = $browser = array();
    if ($res = $this->queryMultiObjectSingle("SELECT datum, ip, agent FROM {$this->dbpredpona}projektlog WHERE projekt={$projekt};", $error))
    {
      foreach ($res as $data)
      {
        $datum[] = $data->datum;
        $ip[] = $data->ip;
        $agent[] = $data->agent;
        $opersys[] = $this->TypOS($data->agent);
        $browser[] = $this->TypBrowseru($data->agent);
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    //pocet pristupu z ip
    $count_ip = "";
    $pole = array_count_values($ip);
    if (count($pole) > 0)
    {
      foreach ($pole as $ip => $pocetip)
      {
        $count_ip .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_ip"],
                                              $ip,
                                              $pocetip);
      }
    }
      else
    {
      $count_ip = $this->unikatni["admin_stat_log_count_ip_null"];
    }

    //pocet pristupu z browseru
    $count_brow = "";
    $pole = array_count_values($browser);
    if (count($pole) > 0)
    {
      foreach ($pole as $brow => $pocetbrow)
      {
        $count_brow .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_brow"],
                                                $brow,
                                                $pocetbrow);
      }
    }
      else
    {
      $count_brow = $this->unikatni["admin_stat_log_count_brow_null"];
    }

    //pocet pristupu z os
    $count_os = "";
    $pole = array_count_values($opersys);
    if (count($pole) > 0)
    {
      foreach ($pole as $os => $pocetos)
      {
        $count_os .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_os"],
                                              $os,
                                              $pocetos);
      }
    }
      else
    {
      $count_os = $this->unikatni["admin_stat_log_count_os_null"];
    }

    //pocet prostupu z os a brow
    $count_osbrow = "";
    $pole = (!Empty($agent) ? $this->AlgPoctyOsProhlizecu($agent) : array());
    if (count($pole) > 0)
    {
      foreach ($pole as $hodnoty)
      {
        $count_osbrow .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_osbrow"],
                                                  $hodnoty["brow"],
                                                  $hodnoty["os"],
                                                  $hodnoty["count"]);
      }
    }
      else
    {
      $count_osbrow = $this->unikatni["admin_stat_log_count_osbrow_null"];
    }

    //pocet pristupu jaky den
    $count_datum = "";
    if (count($datum) > 0)
    {
      //zaokrouhleni data na dny
      foreach ($datum as $dat)
      {
        $poledat[] = date("Y-m-d", strtotime($dat));
      }

      $pole = array_count_values($poledat);
      foreach ($pole as $dat => $pocetdat)
      {
        $count_datum .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_datum"],
                                                  date($this->unikatni["admin_stat_log_count_datum_tvar"], strtotime($dat)),
                                                  $pocetdat);
      }
    }
      else
    {
      $count_datum = $this->unikatni["admin_stat_log_count_datum_null"];
    }

    $grafika = $this->VypisHodnotu("grafika", "projekt", $projekt);
    $grafika_popis = array_slice(explode("&lt;p&gt;", $this->VypisHodnotu("grafika_popis", "projekt", $projekt)), 1);
    $kod = $this->VypisHodnotu("kod", "projekt", $projekt);
    $kod_popis = array_slice(explode("&lt;p&gt;", $this->VypisHodnotu("kod_popis", "projekt", $projekt)), 1);
    $program = $this->VypisHodnotu("program", "projekt", $projekt);
    $program_popis = array_slice(explode("&lt;p&gt;", $this->VypisHodnotu("program_popis", "projekt", $projekt)), 1);

    //pomer progres/pocet prispevku, cim mensi tim presmejsi
    $pomer_grafika = ($grafika / (count($grafika_popis) == 0 ? 1 : count($grafika_popis)));
    $pomer_kod = ($kod / (count($kod_popis) == 0 ? 1 : count($kod_popis)));
    $pomer_program = ($program / (count($program_popis) == 0 ? 1 : count($program_popis)));
    //prubeh celeho projektu v %
    $prubeh = round((($grafika + $kod + $program) / 300) * 100, 2);

    $tvar_datum = $this->unikatni["admin_stat_log_datum_tvar"];

    //prvni zapocaty projekt
    $prvni = $this->VypisHodnotu("MIN(datum)", "projektlog", 1, "");

    //posledni zapocaty projekt
    $posledni = $this->VypisHodnotu("MAX(datum)", "projektlog", 1, "");

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_projekt"],
                                        $this->VypisHodnotu("nazev", "projekt", $projekt),
                                        $this->VypisHodnotu("COUNT(id)", "projektlog", $projekt, "projekt="),
                                        $count_ip,
                                        $count_brow,
                                        $count_os,
                                        $count_osbrow,
                                        $count_datum,
                                        count($grafika_popis),  //pocet popisku
                                        $pomer_grafika, //pomer popisku
                                        count($kod_popis),
                                        $pomer_kod,
                                        count($program_popis),
                                        $pomer_program,
                                        $prubeh,  //celkovy prubeh
                                        date($tvar_datum, strtotime($prvni)),
                                        date($tvar_datum, strtotime($posledni)),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$projekt}");

    return $result;
  }

/**
 *
 * Vyparsruje z cistych <p></p> posledni polozku
 *
 * @param text vstupni text z wym editoru
 * @return posledni polozka
 */
  private function LastParagraph($text)
  {
    $result = "";
    $ods = explode("&lt;/p&gt;", $text);  //rozdeleni podle </p>
    foreach ($ods as $pol)
    {
      if (!Empty($pol))
      {
        $a = explode("&lt;p&gt;", $pol);  //rozdeleni podle <p>
        $result = $a[1];  //preda 1 index
      }
    }

    return $result;
  }

/**
 *
 * Vypise obsah skupiny, univerzelni vypis
 *
 * @param id id daneho projektu
 * @return obsah skupny s odkazy
 */
  private function AdminObsahProjektu($id)
  {
    settype($id, "integer");

    if ($data = $this->querySingleRow("SELECT login, nazev, popis, cena, zacatek, konec, grafika, grafika_popis, kod, kod_popis, program, program_popis, aktivni FROM {$this->dbpredpona}projekt WHERE id={$id};", $error))
    {
      $tvar_datum = $this->unikatni["admin_proj_tvar_datum"];

      //nacteni a parsnuti posledniho odstavce
      $grafika = $this->LastParagraph($data->grafika_popis);
      $kod = $this->LastParagraph($data->kod_popis);
      $program = $this->LastParagraph($data->program_popis);

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_projekt"],
                                          $data->nazev,
                                          $data->popis,
                                          $data->login, //3
                                          $this->MezeraCisla($data->cena),
                                          date($tvar_datum, strtotime($data->zacatek)),
                                          ($data->konec != "1970-01-01 01:00:00" ? date($tvar_datum, strtotime($data->konec)) : $this->unikatni["admin_obsah_projekt_konec_null"]),
                                          ($data->aktivni ? $this->unikatni["admin_obsah_projekt_run"] : ($data->konec != "1970-01-01 01:00:00" ? $this->unikatni["admin_obsah_projekt_finish"] : $this->unikatni["admin_obsah_projekt_pauze"])),
                                          $this->PocetDni($data->zacatek, ($data->konec != "1970-01-01 01:00:00" ? $data->konec : "now"), true),
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$id}&amp;co=grafika",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$id}&amp;co=kod",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$id}&amp;co=program",
                                          $data->grafika,
                                          (!Empty($grafika) ? html_entity_decode($grafika, NULL, "UTF-8") : $this->unikatni["admin_obsah_projekt_grafika_null"]),
                                          $data->kod,
                                          (!Empty($kod) ? html_entity_decode($kod, NULL, "UTF-8") : $this->unikatni["admin_obsah_projekt_kod_null"]),
                                          $data->program,
                                          (!Empty($program) ? html_entity_decode($program, NULL, "UTF-8") : $this->unikatni["admin_obsah_projekt_program_null"]),
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$id}&amp;co=log",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$id}&amp;co=statlog"
                                          );

      //podminka uzavreneho projektu
      $uzavreno = (!$data->aktivni && $data->konec != "1970-01-01 01:00:00");

      $index_postup = "";
      $index_popis = "";
      $co = $this->NotEmpty("get", "co");
      if (!Empty($co))
      {
        switch ($co)
        {
          case "grafika": //editace grafiky
            $index_postup = "grafika";
            $index_popis = "grafika_popis";
            $nazev = $this->unikatni["admin_obsah_projekt_grafika"];
          break;

          case "kod": //editace programu
            $index_postup = "kod";
            $index_popis = "kod_popis";
            $nazev = $this->unikatni["admin_obsah_projekt_kod"];
          break;

          case "program": //editace programu
            $index_postup = "program";
            $index_popis = "program_popis";
            $nazev = $this->unikatni["admin_obsah_projekt_program"];
          break;

          case "log": //vypis logu
            $result = $this->AdminVypisLogProjekt($id, $uzavreno);
          break;

          case "clearlog":  //promazavani logu
            if ($uzavreno)
            { //pokud je projekt uzavren a je datum konce povoli se promazani logu
              $result = $this->AdminClearLogProjekt($id);
            }
              else
            { //jinak presmerovani zpet na logovani
              $this->AutoClick(0, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$id}&amp;co=log");  //auto kliknuti
            }
          break;

          case "statlog": //statistiky logu
            $result = $this->AdminStatLogProjekt($id);
          break;
        }

        //nacteni vnitrniho adminu
        if (!Empty($index_postup))
        {
          $postup = $this->VypisHodnotu($index_postup, "projekt", $id);
          $popis = $this->VypisHodnotu($index_popis, "projekt", $id);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_projekt_choice"],
                                              $this->var->jquerycore,
                                              $this->var->jqueryui,
                                              $this->dirpath,
                                              $nazev,
                                              $index_postup,
                                              $index_popis,
                                              $postup,
                                              $popis,
                                              $this->VypisHodnotu("nazev", "projekt", $id),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$id}");

          if ($this->ControlForm(array ($index_postup => array("post", "string"),
                                        $index_popis => array("post", "string"),
                                        "upraveno" => array("self", "date", "now")),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST[$index_popis])),
                                array("update", "projekt", $id),
                                $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_projekt_hlaska"], $nazev);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$id}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        }
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_obsah_projekt_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypis statistik celeho statusu
 *
 * @return vypis
 */
  private function AdminStatistikaLogu()
  {
    $result = "";
    $datum = $ip = $agent = $opersys = $browser = array();
    if ($res = $this->queryMultiObjectSingle("SELECT datum, ip, agent FROM {$this->dbpredpona}projektlog;", $error))
    {
      foreach ($res as $data)
      {
        $datum[] = $data->datum;
        $ip[] = $data->ip;
        $agent[] = $data->agent;
        $opersys[] = $this->TypOS($data->agent);
        $browser[] = $this->TypBrowseru($data->agent);
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    //pocet pristupu z ip
    $count_ip = "";
    $pole = array_count_values($ip);
    if (count($pole) > 0)
    {
      foreach ($pole as $ip => $pocetip)
      {
        $count_ip .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_ip"],
                                              $ip,
                                              $pocetip);
      }
    }
      else
    {
      $count_ip = $this->unikatni["admin_stat_log_count_ip_null"];
    }

    //pocet pristupu z browseru
    $count_brow = "";
    $pole = array_count_values($browser);
    if (count($pole) > 0)
    {
      foreach ($pole as $brow => $pocetbrow)
      {
        $count_brow .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_brow"],
                                                $brow,
                                                $pocetbrow);
      }
    }
      else
    {
      $count_brow = $this->unikatni["admin_stat_log_count_brow_null"];
    }

    //pocet pristupu z os
    $count_os = "";
    $pole = array_count_values($opersys);
    if (count($pole) > 0)
    {
      foreach ($pole as $os => $pocetos)
      {
        $count_os .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_os"],
                                              $os,
                                              $pocetos);
      }
    }
      else
    {
      $count_os = $this->unikatni["admin_stat_log_count_os_null"];
    }

    //pocet prostupu z os a brow
    $count_osbrow = "";
    $pole = (!Empty($agent) ? $this->AlgPoctyOsProhlizecu($agent) : array());
    if (count($pole) > 0)
    {
      foreach ($pole as $hodnoty)
      {
        $count_osbrow .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_osbrow"],
                                                  $hodnoty["brow"],
                                                  $hodnoty["os"],
                                                  $hodnoty["count"]);
      }
    }
      else
    {
      $count_osbrow = $this->unikatni["admin_stat_log_count_osbrow_null"];
    }

    //pocet pristupu jaky den
    $count_datum = "";
    if (count($datum) > 0)
    {
      //zaokrouhleni data na dny
      foreach ($datum as $dat)
      {
        $poledat[] = date("Y-m-d", strtotime($dat));
      }

      $pole = array_count_values($poledat);
      foreach ($pole as $dat => $pocetdat)
      {
        $count_datum .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_datum"],
                                                  date($this->unikatni["admin_stat_log_count_datum_tvar"], strtotime($dat)),
                                                  $pocetdat);
      }
    }
      else
    {
      $count_datum = $this->unikatni["admin_stat_log_count_datum_null"];
    }

    //tvar datumu pro vypis datumu do central logu
    $tvar_datum = $this->unikatni["admin_stat_log_datum_tvar"];

    //pocet logu jednotlivych projektu
    $count_log = "";
    if ($res = $this->queryMultiObjectSingle("SELECT nazev, count(l.id) pocet FROM {$this->dbpredpona}projekt p ,{$this->dbpredpona}projektlog l
                                              WHERE p.id=l.projekt GROUP BY nazev;", $error))
    {
      foreach ($res as $data)
      {
        $count_log .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_log_count_log"],
                                                $data->nazev,
                                                $data->pocet);
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $count_log = $this->unikatni["admin_stat_log_count_log_null"];
      }
    }

    //prvni zapocaty projekt
    $prvni = $this->VypisHodnotu("MIN(zacatek)", "projekt", 1, "");

    //posledni zapocaty projekt
    $posledni = $this->VypisHodnotu("MAX(zacatek)", "projekt", 1, "");

    //minimalni cena projektu
    $mincena = $this->VypisHodnotu("MIN(cena)", "projekt", 1, "");
    settype($mincena, "integer"); //pretypovani na integer

    //maximalni cena projektu
    $maxcena = $this->VypisHodnotu("MAX(cena)", "projekt", 1, "");
    settype($maxcena, "integer"); //pretypovani na integer

    //prumerna cena projektu
    $avgcena = $this->VypisHodnotu("AVG(cena)", "projekt", 1, "");
    settype($avgcena, "integer"); //pretypovani na integer

    //soucet cen vsech projektu
    $sumcena = $this->VypisHodnotu("SUM(cena)", "projekt", 1, "");
    settype($sumcena, "integer"); //pretypovani na integer

    $poc = $this->VypisHodnotu("COUNT(id)", "projekt", 1, "");  //pocet projektu
    settype($poc, "integer"); //pretypovani na integer

    $neakt = $this->VypisHodnotu("COUNT(id)", "projekt", 0, "konec=='' AND aktivni=");  //neaktivni
    settype($neakt, "integer"); //pretypovani na integer

    $akt = $this->VypisHodnotu("COUNT(id)", "projekt", 1, "aktivni=");  //aktivni
    settype($akt, "integer"); //pretypovani na integer

    $dokon = $this->VypisHodnotu("COUNT(id)", "projekt", 0, "konec!='' AND aktivni=");  //dokoncene
    settype($dokon, "integer"); //pretypovani na integer

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_stat_log"],
                                        $poc,
                                        $neakt,
                                        $akt,
                                        $dokon,
                                        $count_ip,
                                        $count_brow,
                                        $count_os,
                                        $count_osbrow,
                                        $count_datum,
                                        $count_log,
                                        date($tvar_datum, strtotime($prvni)),
                                        date($tvar_datum, strtotime($posledni)),
                                        $this->MezeraCisla($mincena), //13
                                        $this->MezeraCisla($maxcena),
                                        $this->MezeraCisla($avgcena),
                                        $this->MezeraCisla($sumcena));

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho obsahu adminu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addproj",
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addproj":  //pridani projektu
          $default = $this->unikatni["admin_addproj_default"];  //nacteni defaultnich add

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditproj"],
                                              $this->var->jquerycore,
                                              $this->var->jqueryui,
                                              $default[0],
                                              $default[1],
                                              $default[2],
                                              $default[3],
                                              $default[4],
                                              date($this->unikatni["admin_proj_tvar_datum"]),
                                              $default[5],
                                              ($default[6] ? " checked=\"checked\"" : ""),
                                              $default[7],
                                              $default[8],
                                              $default[9],
                                              ($default[10] ? " checked=\"checked\"" : ""),
                                              $this->unikatni["admin_addproj_name"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("login" => array("post", "string"),
                                        "heslo" => array("post", "string"),
                                        "nazev" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "cena" => array("post", "integer"),
                                        "zacatek" => array("post", "date"),
                                        "konec" => array("post", "date"),
                                        "grafika" => array("self", "integer", 0),
                                        "kod" => array("self", "integer", 0),
                                        "program" => array("self", "integer", 0),
                                        "aktivni" => array("post", "boolean"),
                                        "href_id" => array("post", "string"),
                                        "href_class" => array("post", "string"),
                                        "href_akce" => array("post", "string"),
                                        "zobrazit" => array("post", "boolean"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "projekt", 1))),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["login"]) && $this->DuplikatniHodnota("login", "projekt", $_POST["login"], "aktivni=1 AND") && !Empty($_POST["heslo"]) && !Empty($_POST["zacatek"])),
                                array("insert", "projekt", NULL),
                                $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addproj_hlaska"], $_POST["nazev"]);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editproj":  //uprava projektu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT login, heslo, nazev, popis, cena, zacatek, konec, aktivni, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}projekt WHERE id={$id};", $error))
          {
            $tvar_datum = $this->unikatni["admin_proj_tvar_datum"];

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditproj"],
                                                $this->var->jquerycore,
                                                $this->var->jqueryui,
                                                $data->nazev,
                                                $data->popis,
                                                $data->login,
                                                $data->heslo, //6
                                                $data->cena,
                                                date($tvar_datum, strtotime($data->zacatek)),
                                                ($data->konec != "1970-01-01 01:00:00" ? date($tvar_datum, strtotime($data->konec)) : ""),
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                $data->href_id,
                                                $data->href_class,
                                                $data->href_akce,
                                                ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                $this->unikatni["admin_editproj_name"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            //pokud je projekt finish
            if (Empty($_POST["aktivni"]) && !Empty($_POST["konec"]))
            { //zmeni na vastni hodnotu ktera je predem prazdna
              $typ = "self";
            }
              else
            { //a nebo necha data z postu
              $typ = "post";
            }

            if ($this->ControlForm(array ("login" => array($typ, "string", ""),
                                          "heslo" => array($typ, "string", ""),
                                          "nazev" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          "cena" => array("post", "integer"),
                                          "zacatek" => array("post", "date"),
                                          "konec" => array("post", "date"),
                                          "aktivni" => array("post", "boolean"),
                                          "href_id" => array("post", "string"),
                                          "href_class" => array("post", "string"),
                                          "href_akce" => array("post", "string"),
                                          "zobrazit" => array("post", "boolean"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")),  //!Empty($_POST["login"]) && !Empty($_POST["heslo"]) &&
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["nazev"]) && !Empty($_POST["zacatek"])),
                                  array("update", "projekt", $id),
                                  $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editproj_hlaska"], $_POST["nazev"]);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              if (!Empty($error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "delproj":  //mazani projektu
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array ("projekt" => array("id", $id, "nazev"),
                                              "projektlog" => array("projekt")), $nazev, $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delproj_hlaska"], $nazev);

            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin"],
                                        $this->var->jquerycore,
                                        $this->var->jqueryui,
                                        $this->dirpath);

    if ($res = $this->queryMultiObjectSingle("SELECT id, login, nazev, popis, cena, zacatek, konec, grafika, kod, program, aktivni, zobrazit, poradi FROM {$this->dbpredpona}projekt ORDER BY poradi ASC;", $error))
    {
      $tvar_datum = $this->unikatni["admin_proj_tvar_datum"];
      //vypis projektu
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->id,
                                            $data->nazev,
                                            $data->popis,
                                            $data->login,
                                            $this->MezeraCisla($data->cena),  //5
                                            date($tvar_datum, strtotime($data->zacatek)),
                                            ($data->konec != "1970-01-01 01:00:00" ? date($tvar_datum, strtotime($data->konec)) : $this->unikatni["admin_vypis_obsah_null_date"]),
                                            ($data->aktivni ? $this->unikatni["admin_obsah_projekt_run"] : ($data->konec != "1970-01-01 01:00:00" ? $this->unikatni["admin_obsah_projekt_finish"] : $this->unikatni["admin_obsah_projekt_pauze"])),
                                            $this->PocetDni($data->zacatek, ($data->konec != "1970-01-01 01:00:00" ? $data->konec : "now"), true),
                                            $data->grafika, //10
                                            $data->kod,
                                            $data->program, //12
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($data->zobrazit ? " checked=\"checked\"" : ""),
                                            $data->poradi,  //15
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editproj&amp;id={$data->id}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delproj&amp;id={$data->id}"
                                            );
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_obsah_null"]; //null projekt
      }
    }

    $result .= $this->unikatni["admin_vypis_obsah_end"];

    return $result;
  }


}
?>
