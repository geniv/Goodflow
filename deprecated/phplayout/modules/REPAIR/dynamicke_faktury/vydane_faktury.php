<?php

/**
 *
 * Blok vydanych faktur
 *
 */

class DynamicFacture extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona, $mainindex;
  public $idmodul = "dynfac";  //id pro rozliseni modulu v adminu
  private $idlistfac = "_listfac";
  private $idstat = "_stat";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze

  private $stav = array();
  private $typplatby = array();

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
      $this->mainindex = $index;

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->stav = $this->unikatni["set_stav"];
      $this->typplatby = $this->unikatni["set_typplatby"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
      if (!$this->PripojeniDatabaze($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $this->Instalace();

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul,
                                                          $this->idlistfac,
                                                          $this->idstat));
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
      switch ($_GET[$this->var->get_idmodul])
      {
        case $this->idmodul:  //id modul
          $result = $this->AdministraceObsahu();
        break;

        case "{$this->idmodul}{$this->idlistfac}": //vypis faktur
          $result = $this->AdminVypisFaktur();
        break;

        case "{$this->idmodul}{$this->idstat}": //statistiky faktur
          $result = $this->AdminStatistikaFaktur();
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
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}faktura (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    cislo INTEGER UNSIGNED,
                                    zakaznik INTEGER UNSIGNED,
                                    vystaveno DATE,
                                    splatnost DATE,
                                    stav INTEGER UNSIGNED,
                                    typplatby INTEGER UNSIGNED,
                                    varsym VARCHAR(100),
                                    konsym VARCHAR(100),
                                    nadpis TEXT,
                                    polozky TEXT,
                                    poznamka1 TEXT,
                                    poznamka2 TEXT,
                                    poznamka3 TEXT,
                                    poznamka4 TEXT,
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    vytisknuto DATETIME);

                                  CREATE TABLE {$this->dbpredpona}zakaznik (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    cislo INTEGER UNSIGNED,
                                    firma VARCHAR(500),
                                    jednatel VARCHAR(500),
                                    dic VARCHAR(100),
                                    ico VARCHAR(100),
                                    ulicecp VARCHAR(500),
                                    mesto VARCHAR(100),
                                    psc VARCHAR(20),
                                    pridano DATETIME,
                                    upraveno DATETIME,
                                    aktivni BOOL);", $error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
  }

/**
 *
 * Vrati pocet radku ve fakturach
 *
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetFaktur($inc = 0)
  {
    settype($inc, "integer");
    $datum = date("Y"); //aktualni rok

    $poc = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}faktura
                              WHERE {$this->dateFormat("vystaveno", "Y")}={$datum}
                              GROUP BY {$this->dateFormat("vystaveno", "Y")};");

    $result = ($poc != 0 ? $poc + $inc : $inc);

    return $result;
  }

/**
 *
 * Vyber skupiny
 *
 * @param id id polozky, nepovinne
 * @return vyber skupin
 */
  private function VyberZakaznika($id = NULL)
  {
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT id, cislo, firma, jednatel FROM {$this->dbpredpona}zakaznik ORDER BY LOWER(firma) ASC;", $error))
    {
      $result = $this->unikatni["admin_vyber_zakaznik_begin"];
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_zakaznik"],
                                            $data->id,
                                            (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                            $data->cislo,
                                            $data->firma,
                                            $data->jednatel);
      }
      $result .= $this->unikatni["admin_vyber_zakaznik_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_vyber_zakaznik_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje seznam zpusobu razeni
 *
 * @param id id polozky, nepovinne
 * @return select vyber zpusobu
 */
  private function VyberStav($id = NULL)
  {
    $result = $this->unikatni["admin_stav_begin"];
    foreach ($this->stav as $index => $hodnota)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stav"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $hodnota);
    }
    $result .= $this->unikatni["admin_stav_end"];

    return $result;
  }

/**
 *
 * Vypisuje seznam zpusobu razeni
 *
 * @param id id polozky, nepovinne
 * @return select vyber zpusobu
 */
  private function VyberTypPlatby($id = NULL)
  {
    $result = $this->unikatni["admin_typplatby_begin"];
    foreach ($this->typplatby as $index => $hodnota)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typplatby"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $hodnota);
    }
    $result .= $this->unikatni["admin_typplatby_end"];

    return $result;
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho obsahu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addadr",
                                        $this->AdminVypisObsahu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addadr": //pridavani zakaznika
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addadr"],
                                              $this->VypisPocetRadku("cislo", "zakaznik", 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["cislo"]) &&
              !Empty($_POST["firma"]) &&
              //!Empty($_POST["jednatel"]) &&
              //!Empty($_POST["dic"]) &&
              //!Empty($_POST["ico"]) &&
              !Empty($_POST["ulicecp"]) &&
              !Empty($_POST["mesto"]) &&
              !Empty($_POST["psc"]))
          {
            $cislo = $_POST["cislo"];
            settype($cislo, "integer");
            $firma = $this->ChangeWrongChar($_POST["firma"]);
            $jednatel = $this->ChangeWrongChar($_POST["jednatel"]);
            $dic = $this->ChangeWrongChar($_POST["dic"]);
            $ico = $this->ChangeWrongChar($_POST["ico"]);
            $ulicecp = $this->ChangeWrongChar($_POST["ulicecp"]);
            $mesto = $this->ChangeWrongChar($_POST["mesto"]);
            $psc = $this->ChangeWrongChar($_POST["psc"]);
            $pridano = date("Y-m-d H:i:s");
            $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);

            if ($this->queryExec("INSERT INTO {$this->dbpredpona}zakaznik (id, cislo, firma, jednatel, dic, ico, ulicecp, mesto, psc, pridano, upraveno, aktivni) VALUES
                                  (NULL, {$cislo}, '{$firma}', '{$jednatel}', '{$dic}', '{$ico}', '{$ulicecp}', '{$mesto}', '{$psc}', '{$pridano}', '', {$aktivni});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addadr_hlaska"], $firma);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editadr":  //editaci zakaznika
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT cislo, firma, jednatel, dic, ico, ulicecp, mesto, psc, aktivni FROM {$this->dbpredpona}zakaznik WHERE id={$id};", $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_editadr"],
                                                $data->cislo,
                                                $data->firma,
                                                $data->jednatel,
                                                $data->dic,
                                                $data->ico,
                                                $data->ulicecp,
                                                $data->mesto,
                                                $data->psc,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($_POST["cislo"]) &&
                !Empty($_POST["firma"]) &&
                //!Empty($_POST["jednatel"]) &&
                //!Empty($_POST["dic"]) &&
                //!Empty($_POST["ico"]) &&
                !Empty($_POST["ulicecp"]) &&
                !Empty($_POST["mesto"]) &&
                !Empty($_POST["psc"]) &&
                $id != 0)
            {
              $cislo = $_POST["cislo"];
              settype($cislo, "integer");
              $firma = $this->ChangeWrongChar($_POST["firma"]);
              $jednatel = $this->ChangeWrongChar($_POST["jednatel"]);
              $dic = $this->ChangeWrongChar($_POST["dic"]);
              $ico = $this->ChangeWrongChar($_POST["ico"]);
              $ulicecp = $this->ChangeWrongChar($_POST["ulicecp"]);
              $mesto = $this->ChangeWrongChar($_POST["mesto"]);
              $psc = $this->ChangeWrongChar($_POST["psc"]);
              $upraveno = date("Y-m-d H:i:s");
              $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);

              if ($this->queryExec("UPDATE {$this->dbpredpona}zakaznik SET cislo={$cislo},
                                                                          firma='{$firma}',
                                                                          jednatel='{$jednatel}',
                                                                          dic='{$dic}',
                                                                          ico='{$ico}',
                                                                          ulicecp='{$ulicecp}',
                                                                          mesto='{$mesto}',
                                                                          psc='{$psc}',
                                                                          upraveno='{$upraveno}',
                                                                          aktivni={$aktivni}
                                                                          WHERE id={$id};", $error))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_editadr_hlaska"], $firma);

                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
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

        case "deladr": //mazani zakaznika
          $id = $_GET["id"];
          settype($id, "integer");

          if ($nazev = $this->querySingle("SELECT firma FROM {$this->dbpredpona}zakaznik WHERE id={$id};")) //kdyz je nazev nenulovy
          {
            if ($this->queryExec("DELETE FROM {$this->dbpredpona}zakaznik WHERE id={$id};
                                  DELETE FROM {$this->dbpredpona}faktura WHERE zakaznik={$id};", $error)) //provedeni dotazu
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_deladr_hlaska"], $nazev);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "addfac": //pridavani faktury
          $adr = $_GET["adr"];
          settype($adr, "integer");

          $tvar_datum = $this->unikatni["admin_addeditfac_tvar_datum"];
          $plus_datum = $this->unikatni["admin_addfac_plus_datum"];

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfac"],
                                              $this->var->jquerycore,
                                              $this->var->jqueryui,
                                              $this->dirpath,
                                              $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                              $this->PocetFaktur(1),
                                              $this->VyberZakaznika($adr),
                                              date($tvar_datum),
                                              date($tvar_datum, strtotime($plus_datum)),
                                              $this->VyberStav(),
                                              $this->VyberTypPlatby(),
                                              $this->VytvorCisloFaktury($this->PocetFaktur(1)), //VS
                                              $this->unikatni["admin_addfac_def_konsym"],
                                              $this->unikatni["admin_addfac_def_nadpis"],
                                              1,  //14
                                              "",
                                              "",
                                              "",
                                              "",
                                              $this->unikatni["admin_addfac_nadpis"], //19
                                              $this->unikatni["admin_addfac_tlacitko"],
                                              $this->unikatni["admin_addfac_poznamka1"], //21
                                              $this->unikatni["admin_addfac_poznamka2"],
                                              $this->unikatni["admin_addfac_poznamka3"],
                                              $this->unikatni["admin_addfac_poznamka4"],
                                              $this->VytvorCisloFaktury($this->PocetFaktur(1)), //nahled cisla
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? "{$this->idmodul}{$_GET["ret"]}" : $this->idmodul)
                                              );

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($_POST["cislo"]) &&
              !Empty($_POST["zakaznik"]) &&
              !Empty($_POST["vystaveno"]) &&
              !Empty($_POST["splatnost"]))
          {
            $cislo = $_POST["cislo"];
            settype($cislo, "integer");
            $zakaznik = $_POST["zakaznik"];
            settype($zakaznik, "integer");
            $vystaveno = date("Y-m-d", strtotime($this->ChangeWrongChar($_POST["vystaveno"])));
            $splatnost = date("Y-m-d", strtotime($this->ChangeWrongChar($_POST["splatnost"])));
            $stav = $_POST["stav"];
            settype($stav, "integer");
            $typplatby = $_POST["typplatby"];
            settype($typplatby, "integer");
            $varsym = $this->ChangeWrongChar($_POST["varsym"]);
            $konsym = $this->ChangeWrongChar($_POST["konsym"]);
            $nadpis = $this->ChangeWrongChar($_POST["nadpis"]);
              $sub_nazev = implode("|--naz--|", $_POST["polozky_nazev"]);
              $sub_mnozstvi = implode("|--mno--|", $_POST["polozky_mnozstvi"]);
              $sub_cenajm = implode("|--cen--|", $_POST["polozky_cenajm"]);
              $sub_sleva = implode("|--sle--|", $_POST["polozky_sleva"]);
            $polozky = implode("|--xx--|", array($sub_nazev, $sub_mnozstvi, $sub_cenajm, $sub_sleva));
            $poznamka1 = $this->ChangeWrongChar($_POST["poznamka1"]);
            $poznamka2 = $this->ChangeWrongChar($_POST["poznamka2"]);
            $poznamka3 = $this->ChangeWrongChar($_POST["poznamka3"]);
            $poznamka4 = $this->ChangeWrongChar($_POST["poznamka4"]);
            $pridano = date("Y-m-d H:i:s");

            if ($this->queryExec("INSERT INTO {$this->dbpredpona}faktura (id, cislo, zakaznik, vystaveno, splatnost, stav, typplatby, varsym, konsym, nadpis, polozky, poznamka1, poznamka2, poznamka3, poznamka4, pridano, upraveno, vytisknuto) VALUES
                                  (NULL, {$cislo}, {$zakaznik}, '{$vystaveno}', '{$splatnost}', {$stav}, {$typplatby}, '{$varsym}', '{$konsym}', '{$nadpis}', '{$polozky}', '{$poznamka1}', '{$poznamka2}', '{$poznamka3}', '{$poznamka4}', '{$pridano}', '', '');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addfac_hlaska"], $this->VytvorCisloFaktury($cislo));

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? "{$this->idmodul}{$_GET["ret"]}" : $this->idmodul));  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editfac":  //uprava faktury
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT cislo, zakaznik, vystaveno, splatnost, stav, typplatby, varsym, konsym, nadpis, polozky, poznamka1, poznamka2, poznamka3, poznamka4 FROM {$this->dbpredpona}faktura WHERE id={$id};", $error))
          {
            $tvar_datum = $this->unikatni["admin_addeditfac_tvar_datum"];

            $rozdel = explode("|--xx--|", $data->polozky);
            $sub_nazev = implode("|', '|", explode("|--naz--|", $rozdel[0]));
            $sub_mnozstvi = implode("', '", explode("|--mno--|", $rozdel[1]));
            $sub_cenajm = implode("', '", explode("|--cen--|", $rozdel[2]));
            $sub_sleva = implode("', '", explode("|--sle--|", $rozdel[3]));

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditfac"],
                                                $this->var->jquerycore,
                                                $this->var->jqueryui,
                                                $this->dirpath,
                                                $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz")),
                                                $data->cislo,
                                                $this->VyberZakaznika($data->zakaznik),
                                                date($tvar_datum, strtotime($data->vystaveno)),
                                                date($tvar_datum, strtotime($data->splatnost)),
                                                $this->VyberStav($data->stav),
                                                $this->VyberTypPlatby($data->typplatby),
                                                $data->varsym,
                                                $data->konsym,
                                                $data->nadpis,
                                                count(explode("|--naz--|", $rozdel[0])),  //14
                                                $sub_nazev,
                                                $sub_mnozstvi,
                                                $sub_cenajm,
                                                $sub_sleva,
                                                $this->unikatni["admin_editfac_nadpis"],
                                                $this->unikatni["admin_editfac_tlacitko"],
                                                $data->poznamka1, //21
                                                $data->poznamka2,
                                                $data->poznamka3,
                                                $data->poznamka4,
                                                $this->VytvorCisloFaktury($data->cislo),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? "{$this->idmodul}{$_GET["ret"]}" : $this->idmodul)
                                                );

            if (!Empty($_POST["tlacitko"]) &&
                !Empty($_POST["cislo"]) &&
                !Empty($_POST["zakaznik"]) &&
                !Empty($_POST["vystaveno"]) &&
                !Empty($_POST["splatnost"]) &&
                $id != 0)
            {
              $cislo = $_POST["cislo"];
              settype($cislo, "integer");
              $zakaznik = $_POST["zakaznik"];
              settype($zakaznik, "integer");
              $vystaveno = date("Y-m-d", strtotime($this->ChangeWrongChar($_POST["vystaveno"])));
              $splatnost = date("Y-m-d", strtotime($this->ChangeWrongChar($_POST["splatnost"])));
              $stav = $_POST["stav"];
              settype($stav, "integer");
              $typplatby = $_POST["typplatby"];
              settype($typplatby, "integer");
              $varsym = $this->ChangeWrongChar($_POST["varsym"]);
              $konsym = $this->ChangeWrongChar($_POST["konsym"]);
              $nadpis = $this->ChangeWrongChar($_POST["nadpis"]);
                $sub_nazev = implode("|--naz--|", $_POST["polozky_nazev"]);
                $sub_mnozstvi = implode("|--mno--|", $_POST["polozky_mnozstvi"]);
                $sub_cenajm = implode("|--cen--|", $_POST["polozky_cenajm"]);
                $sub_sleva = implode("|--sle--|", $_POST["polozky_sleva"]);
              $polozky = implode("|--xx--|", array($sub_nazev, $sub_mnozstvi, $sub_cenajm, $sub_sleva));
              $poznamka1 = $this->ChangeWrongChar($_POST["poznamka1"]);
              $poznamka2 = $this->ChangeWrongChar($_POST["poznamka2"]);
              $poznamka3 = $this->ChangeWrongChar($_POST["poznamka3"]);
              $poznamka4 = $this->ChangeWrongChar($_POST["poznamka4"]);
              $upraveno = date("Y-m-d H:i:s");

              if ($this->queryExec("UPDATE {$this->dbpredpona}faktura SET cislo={$cislo},
                                                                          zakaznik={$zakaznik},
                                                                          vystaveno='{$vystaveno}',
                                                                          splatnost='{$splatnost}',
                                                                          stav={$stav},
                                                                          typplatby={$typplatby},
                                                                          varsym='{$varsym}',
                                                                          konsym='{$konsym}',
                                                                          nadpis='{$nadpis}',
                                                                          polozky='{$polozky}',
                                                                          poznamka1='{$poznamka1}',
                                                                          poznamka2='{$poznamka2}',
                                                                          poznamka3='{$poznamka3}',
                                                                          poznamka4='{$poznamka4}',
                                                                          upraveno='{$upraveno}'
                                                                          WHERE id={$id};", $error))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_editfac_hlaska"], $this->VytvorCisloFaktury($cislo));

                $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? "{$this->idmodul}{$_GET["ret"]}" : $this->idmodul));  //auto kliknuti
              }
                else
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

        case "delfac": //mazani faktury
          $id = $_GET["id"];
          settype($id, "integer");

          $zakaznik = $this->querySingle("SELECT zakaznik FROM {$this->dbpredpona}faktura WHERE id={$id};");  //vytahne si cislo zakaznika
          $nazev = $this->querySingle("SELECT cislo FROM {$this->dbpredpona}faktura WHERE id={$id};");
          $vytisknuto = $this->querySingle("SELECT vytisknuto FROM {$this->dbpredpona}faktura WHERE id={$id};");
          $facnum = $this->VytvorCisloFaktury($nazev);
          if ((Empty($vytisknuto) || $vytisknuto == "0000-00-00 00:00:00") && !is_null($nazev)) //kdyz je nevytisknuto a nazev nenulovy
          {
            if ($this->queryExec("DELETE FROM {$this->dbpredpona}faktura WHERE id={$id};", $error)) //provedeni dotazu
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfac_hlaska"], $facnum);

              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? "{$this->idmodul}{$_GET["ret"]}" : $this->idmodul));  //auto kliknuti
            }
              else
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "infofac":  //informace o fakture
          $id = $_GET["id"];  //id akce
          settype($id, "integer");

          $tvar_datum = $this->NactiUnikatniObsah($this->unikatni["admin_infofac_tvar_datum"]);
          $tvar_datum_full = $this->NactiUnikatniObsah($this->unikatni["admin_infofac_full_tvar_datum"]);

          if ($data = $this->querySingleRow("SELECT cislo, zakaznik, vystaveno, splatnost,
                                            stav, typplatby, varsym, konsym, nadpis, polozky,
                                            poznamka1, poznamka2, poznamka3, poznamka4,
                                            pridano, upraveno, vytisknuto
                                            FROM {$this->dbpredpona}faktura WHERE id={$id};", $error))
          {
            $rozdel = explode("|--xx--|", $data->polozky);  //rozdeleni polozek
            $sub_nazev = explode("|--naz--|", $rozdel[0]);
            $sub_mnozstvi = explode("|--mno--|", $rozdel[1]);
            $sub_cenajm = explode("|--cen--|", $rozdel[2]);
            $sub_sleva = explode("|--sle--|", $rozdel[3]);

            $pol = "";
            $sumcena = 0;
            $sumsleva = 0;
            $sumcelkem = 0;
            foreach ($sub_nazev as $index => $polozka)  //generovani polozek
            {
              $cena = ($sub_mnozstvi[$index] * $sub_cenajm[$index]);
              $sleva = ($sub_mnozstvi[$index] * $sub_sleva[$index]);
              $celkem = ($sub_mnozstvi[$index] * $sub_cenajm[$index]) - ($sub_mnozstvi[$index] * $sub_sleva[$index]);
              $sumcena += $cena;
              $sumsleva += $sleva;
              $sumcelkem += $celkem;

              $pol .= $this->NactiUnikatniObsah($this->unikatni["admin_infofac_row"],
                                                $polozka, //nazev
                                                $sub_mnozstvi[$index],
                                                $sub_cenajm[$index],
                                                $sub_sleva[$index],
                                                $cena,
                                                $sleva,
                                                $celkem);
            }

            $zak = $this->querySingleRow("SELECT cislo, firma, jednatel, dic, ico, ulicecp, mesto, psc FROM {$this->dbpredpona}zakaznik WHERE id={$data->zakaznik};", $error1);
            if (is_null($zak))
            {
              if (!Empty($error1))
              {
                $this->ErrorMsg($error1, array(__LINE__, __METHOD__));
              }
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_infofac"],
                                                $this->VytvorCisloFaktury($data->cislo),
                                                $zak->firma,  //zakaznici
                                                $zak->jednatel,
                                                $zak->dic,
                                                $zak->ico,
                                                $zak->ulicecp,
                                                $zak->mesto,
                                                $zak->psc,  //zakaznici
                                                date($tvar_datum, strtotime($data->vystaveno)),
                                                date($tvar_datum, strtotime($data->splatnost)),
                                                $this->stav[$data->stav],
                                                $this->typplatby[$data->typplatby],
                                                $data->varsym,
                                                $data->konsym,
                                                $data->nadpis,  //15
                                                $pol, //vlozene polozky
                                                $sumcena,
                                                $sumsleva,
                                                $sumcelkem,
                                                $data->poznamka1, //20
                                                $data->poznamka2,
                                                $data->poznamka3,
                                                $data->poznamka4,
                                                date($tvar_datum_full, strtotime($data->pridano)),
                                                (!Empty($data->upraveno) && $data->upraveno != "0000-00-00 00:00:00" ? date($tvar_datum_full, strtotime($data->upraveno)) : $this->unikatni["admin_infofac_full_tvar_datum_null"]),
                                                (!Empty($data->vytisknuto) && $data->vytisknuto != "0000-00-00 00:00:00" ? date($tvar_datum_full, strtotime($data->vytisknuto)) : $this->unikatni["admin_infofac_vytisknuto_null"]),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? "{$this->idmodul}{$_GET["ret"]}" : $this->idmodul));
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "makepdf": //tvorba pdf faktury
          $id = $_GET["id"];  //id akce
          settype($id, "integer");

          $tvar_datum = $this->unikatni["admin_pdf_tvar_datum"];

          //zmeni flag tisku a zakaze smazani
          $vytisknuto = date("Y-m-d H:i:s");
          if (!$this->queryExec("UPDATE {$this->dbpredpona}faktura SET vytisknuto='{$vytisknuto}' WHERE id={$id};", $error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $ret = "";
          if ($data = $this->querySingleRow("SELECT cislo, zakaznik, vystaveno, splatnost,
                                            stav, typplatby, varsym, konsym, nadpis, polozky,
                                            poznamka1, poznamka2, poznamka3, poznamka4
                                            FROM {$this->dbpredpona}faktura WHERE id={$id};", $error))
          {
            $zak = $this->querySingleRow("SELECT cislo, firma, jednatel, dic, ico, ulicecp, mesto, psc FROM {$this->dbpredpona}zakaznik WHERE id={$data->zakaznik};", $error1);
            if (is_null($zak))
            {
              if (!Empty($error1))
              {
                $this->ErrorMsg($error1, array(__LINE__, __METHOD__));
              }
            }

            $vypis = array ("array_args",
                            $this->absolutni_url,
                            $this->VytvorCisloFaktury($data->cislo),
                            $zak->firma,  //zakaznici
                            $zak->jednatel,
                            $zak->dic,
                            $zak->ico,
                            $zak->ulicecp,
                            $zak->mesto,
                            $zak->psc,  //zakaznici
                            date($tvar_datum, strtotime($data->vystaveno)),
                            date($tvar_datum, strtotime($data->splatnost)),
                            $this->stav[$data->stav],
                            $this->typplatby[$data->typplatby],
                            $data->varsym,
                            $data->konsym,
                            $data->nadpis,
                            $data->poznamka1,
                            $data->poznamka2,
                            $data->poznamka3,
                            $data->poznamka4
                            );

            $ret = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis"],
                                            $vypis);

            $rozdel = explode("|--xx--|", $data->polozky);  //rozdeleni polozek
            $sub_nazev = explode("|--naz--|", $rozdel[0]);
            $sub_mnozstvi = explode("|--mno--|", $rozdel[1]);
            $sub_cenajm = explode("|--cen--|", $rozdel[2]);
            $sub_sleva = explode("|--sle--|", $rozdel[3]);

            $sumcena = 0;
            $sumsleva = 0;
            $sumcelkem = 0;
            foreach ($sub_nazev as $index => $polozka)
            {
              $cena = ($sub_mnozstvi[$index] * $sub_cenajm[$index]);
              $sleva = ($sub_mnozstvi[$index] * $sub_sleva[$index]);
              $celkem = ($sub_mnozstvi[$index] * $sub_cenajm[$index]) - ($sub_mnozstvi[$index] * $sub_sleva[$index]);
              $sumcena += $cena;
              $sumsleva += $sleva;
              $sumcelkem += $celkem;

              $ret .= $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_row"],
                                                $polozka, //nazev
                                                $sub_mnozstvi[$index],
                                                $sub_cenajm[$index],
                                                $sub_sleva[$index],
                                                $cena,
                                                $sleva,
                                                $celkem);
            }

            $ret .= $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_end"],
                                              $sumcena,
                                              $sumsleva,
                                              $sumcelkem,
                                              $this->VytvorCisloFaktury($data->cislo));
          }
            else
          {
            if (!Empty($error))
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }

          $cesta_tridy = $this->var->mpdfcore; //cesta mpdf
          if (file_exists($cesta_tridy))
          {
            //vystupni adresa
            $adresa = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_cesta"],
                                                $vypis);

            $title = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_title"],
                                                $vypis);

            $author = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_author"],
                                                $vypis);

            $subject = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_subject"],
                                                $vypis);

            $creator = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_creator"],
                                                $vypis);

            $keywords = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_keywords"],
                                                  $vypis);

            //css pdf-ka
            $cssfile = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_cssfile"],
                                                $this->absolutni_url,
                                                $this->dirpath);

            //typ ukladani, true = (I) save as, false = (D) force
            $savestyle = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_save_style"]);

            $header = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_header"],
                                                $vypis);

            $footer = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_footer"],
                                                $vypis);

            ini_set("memory_limit", "100M");  //nasosne si vic mega
            define("_MPDF_PATH", dirname($this->var->mpdfcore)."/"); //nastaveni patchu cesty
            include $cesta_tridy; //vlozeni obsahu tridy

            $mpdf = new mPDF("utf-8");  //vytvoreni tridy

            $mpdf->SetDisplayMode("fullpage");  //prvotni zobrazeni

            $mpdf->SetTitle($title);  //nastaveni titulku
            $mpdf->SetAuthor($author);  //nastaveni autora
            $mpdf->SetSubject($subject);  //nastaveni predmetu
            $mpdf->SetCreator($creator);  //nastaveni tvurce
            $mpdf->SetKeywords($keywords);  //nastaveni klicovych slov

            $css = "";
            if (file_exists("{$cssfile}.css"))
            {
              $css = file_get_contents("{$cssfile}.css"); //nacteni stylu
            }

            $mpdf->SetHTMLHeader($header);  //nastaveni zahlavi
            $mpdf->SetHTMLFooter($footer);  //nastaveni zapati

            $mpdf->WriteHTML($css, 1);  //vlozeni css stylu
            $mpdf->WriteHTML($ret, 2);  //vlozeni html stranky
            $mpdf->Output("{$adresa}.pdf", ($savestyle ? "I" : "D")); //ukladaci styl
            exit(0);  //ukonceni bez chyby
          }
            else
          {
            $this->ErrorMsg("Neexistuje cesta: {$cesta_tridy}", array(__LINE__, __METHOD__));
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Posklada cislo faktury
 *
 * @param faktura cislo faktury
 * @return cislo faktury
 */
  private function VytvorCisloFaktury($faktura)
  {
    $rok = str_split(date("Y"));  //rozparsrovani roku, kvuli prvni cislici
    $numrok = date("y");  //ziskani koncoveho dvojcisli roku

    //pridani nul do cisla
    $numfak = "";
    if ($faktura < 10)
    {
      $numfak = "00{$faktura}";
    }
      else
    if ($faktura < 100 && $faktura >= 10)
    {
      $numfak = "0{$faktura}";
    }
      else
    if ($faktura >= 100)
    {
      $numfak = $faktura;
    }

    $result = "{$rok[0]}{$numrok}{$numfak}";

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
    $tvar_datum = $this->unikatni["admin_vypis_tvar_datum"];

    if ($res = $this->queryMultiObjectSingle("SELECT id, cislo, firma, jednatel, pridano, upraveno FROM {$this->dbpredpona}zakaznik ORDER BY LOWER(firma) ASC;", $error))
    {
      foreach ($res as $data)
      {
        $pocet = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}faktura WHERE zakaznik={$data->id};");

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->cislo,
                                            $data->firma,
                                            (!Empty($data->jednatel) ? $data->jednatel : $this->unikatni["admin_vypis_obsah_jednatel_null"]),
                                            date($tvar_datum, strtotime($data->pridano)),
                                            $pocet, //($data->aktivni ? " checked=\"checked\"" : ""),aktivni
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfac&amp;adr={$data->id}&amp;ret={$this->idlistfac}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editadr&amp;id={$data->id}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deladr&amp;id={$data->id}");
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
        $result = $this->unikatni["admin_vypis_obsah_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypis faktur
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisFaktur()
  {
    $tvar_datum = $this->unikatni["admin_vypis_faktur_tvar_datum"];
    $tvar_datum_full = $this->unikatni["admin_vypis_faktur_full_tvar_datum"];

    $result = $this->unikatni["admin_vypis_faktur_begin"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, cislo, zakaznik, vystaveno, splatnost, stav, typplatby, nadpis, polozky, pridano, upraveno, vytisknuto FROM {$this->dbpredpona}faktura ORDER BY cislo ASC;", $error))
    {
      foreach ($res as $data)
      {
        $rozdel = explode("|--xx--|", $data->polozky);
        $sub_mnozstvi = explode("|--mno--|", $rozdel[1]);
        $sub_cenajm = explode("|--cen--|", $rozdel[2]);
        $sub_sleva = explode("|--sle--|", $rozdel[3]);

        $cena = 0;
        $sleva = 0;
        foreach ($sub_mnozstvi as $index => $pocet)
        {
          $cena += $pocet * $sub_cenajm[$index];  //soucet a suma ceny
          $sleva += $pocet * $sub_sleva[$index];  //soucet a suma slevy
        }
        $celkem = $cena - $sleva; //celkova cena

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_faktur"],
                                            $this->VytvorCisloFaktury($data->cislo),
                                            $this->VypisHodnotu("firma", "zakaznik", $data->zakaznik),
                                            $this->VypisHodnotu("jednatel", "zakaznik", $data->zakaznik),
                                            date($tvar_datum, strtotime($data->vystaveno)),
                                            date($tvar_datum, strtotime($data->splatnost)),
                                            $this->stav[$data->stav],
                                            $this->typplatby[$data->typplatby],
                                            $data->nadpis,
                                            $celkem,
                                            date($tvar_datum_full, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) && $data->upraveno != "0000-00-00 00:00:00" ? date($tvar_datum_full, strtotime($data->upraveno)) : $this->unikatni["admin_vypis_faktur_tvar_datum_null"]),
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=makepdf&amp;id={$data->id}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=infofac&amp;id={$data->id}&amp;ret={$this->idlistfac}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addfac&amp;adr={$data->zakaznik}&amp;ret={$this->idlistfac}",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editfac&amp;id={$data->id}&amp;ret={$this->idlistfac}",
                                            (Empty($data->vytisknuto) || $data->vytisknuto == "0000-00-00 00:00:00" ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_faktur_del_link_true"],
                                                                                                                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfac&amp;id={$data->id}&amp;ret={$this->idlistfac}",
                                                                                                                                                $data->cislo,
                                                                                                                                                $this->VypisHodnotu("firma", "zakaznik", $data->zakaznik),
                                                                                                                                                $this->VypisHodnotu("jednatel", "zakaznik", $data->zakaznik))
                                                                                                                    : $this->unikatni["admin_vypis_faktur_del_link_false"])
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
        $result .= $this->unikatni["admin_vypis_faktur_null"];
      }
    }
    $result .= $this->unikatni["admin_vypis_faktur_end"];

    return $result;
  }

/**
 *
 * Vypis statistik faktur
 *
 * @return vypis obsahu v html
 */
  private function AdminStatistikaFaktur()
  {
    $tvar_datum = $this->unikatni["admin_stat_faktur_tvar_datum"];

    $result = $this->unikatni["admin_stat_faktur_begin"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, cislo, zakaznik, vystaveno,
                                              splatnost, stav, typplatby, polozky
                                              FROM {$this->dbpredpona}faktura
                                              ORDER BY cislo ASC;", $error))
    {
      foreach ($res as $data)
      {
        $rozdel = explode("|--xx--|", $data->polozky);
        $sub_mnozstvi = explode("|--mno--|", $rozdel[1]);
        $sub_cenajm = explode("|--cen--|", $rozdel[2]);
        $sub_sleva = explode("|--sle--|", $rozdel[3]);

        $cena = 0;
        $sleva = 0;
        foreach ($sub_mnozstvi as $index => $pocet)
        {
          $cena += $pocet * $sub_cenajm[$index];  //soucet a suma ceny
          $sleva += $pocet * $sub_sleva[$index];  //soucet a suma slevy
        }
        $celkem = $cena - $sleva; //celkova cena

        $datum = explode("-", date("Y-n", strtotime($data->vystaveno)));  //datum na rozdeleni
        //$prom[Y][n] = array(data)
        $rozdeleni[$datum[0]][$datum[1]][] = array ("array_args", //rozdeleni dat
                                                    $this->VytvorCisloFaktury($data->cislo),
                                                    $this->VypisHodnotu("firma", "zakaznik", $data->zakaznik),
                                                    date($tvar_datum, strtotime($data->vystaveno)),
                                                    date($tvar_datum, strtotime($data->splatnost)),
                                                    $this->stav[$data->stav],
                                                    $this->typplatby[$data->typplatby],
                                                    $cena,
                                                    $sleva,
                                                    $celkem,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=infofac&amp;id={$data->id}&amp;ret={$this->idstat}");
      }
    }
      else
    {
      if (!Empty($error))
      {
        $this->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    //jmena mesicu
    $mesicname = $this->unikatni["admin_stat_faktur_mesicname"];

    //samotne vykresleni hotovych dat
    $start_year = $this->unikatni["admin_stat_faktur_start_year"];
    $pole_roku = range($start_year, date("Y")); //vytvoreni pole roku
    $allsum = 0;
    foreach ($pole_roku as $rok)  //projiti roku
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_faktur_rok_begin"],
                                          $rok);

      //u aktualniho roku jen do aktualniho mesice
      $pole_mesicu = (date("Y") == $rok ? range(1, date("m")) : range(1, 12));  //vytvoreni pole mesicu
      $yearsum = 0;
      foreach ($pole_mesicu as $mesic)  //projiti mesicu
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_faktur_mesic_begin"],
                                            $mesic,
                                            $mesicname[$mesic]);

        $monthsum = 0;
        if (!Empty($rozdeleni[$rok][$mesic])) //detekne neprazdne polozky
        {
          foreach ($rozdeleni[$rok][$mesic] as $faktura)  //projiti polozek mesice
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_faktur_row"],
                                                $faktura);

            $monthsum += $faktura[9]; //soucet ceny za mesic
            $yearsum += $faktura[9]; //soucet ceny za rok
          }
        }
          else
        {
          $result .= $this->unikatni["admin_stat_faktur_row_null"];
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_faktur_mesic_end"],
                                            $mesic,
                                            $mesicname[$mesic],
                                            $monthsum);
      }

      $allsum += $yearsum;

      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_faktur_rok_end"],
                                          $rok,
                                          $yearsum);
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_stat_faktur_all"],
                                        $start_year,
                                        date("Y"),
                                        $allsum);

    $result .= $this->unikatni["admin_stat_faktur_end"];

    return $result;
  }


}
?>
