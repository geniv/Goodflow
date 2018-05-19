<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicZobrazeni - hlavni konstruktor tridy\n
 * RychloVypis() - rychlo vypis polozek\n
 * DynamickeZobrazeni() - standartni vypis polozek\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicZobrazeni extends DefaultModule
{
  private $var, $dbname, $dirpath, $debug_lokal, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dynzobr";  //id pro rozliseni modulu v adminu
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek
  private $vypis_chybu = false;

  private $znacka_povinne = "*";
  private $pathpicture = "obrazky";
  private $minidir = "mini";
  private $fulldir = "full";
  private $conffile = ".config_file";

  private $adresa_sekce = "sekce";
  private $rsslink = "rss";

                            //index => slovní popis
  private $element = array ("nadpis" =>  "Nadpis",
                            "popisek" => "Krátký popisek",
                            "text" =>    "Dlouhé texty",

                            "obrazek" => "Obrázek",

                            "datum" =>   "Datum",
                            "cas" =>     "Čas",
                            "datumcas" =>"Datum a čas",

                            "checkbox" => "Zaškrkávací políčko",

                            "autodel" => "Automatické mazání",
                            );

  private $pocitadloporadi = array (0 => 1,
                                    1 => 1,
                                    2 => 1,
                                    3 => 1,
                                    4 => 1,
                                    5 => 1,
                                    6 => 1,
                                    7 => 1,
                                    8 => 1);

  private $vstupni_typ = array ("text",
                                "integer",
                                "reg_exp");

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

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->debug_lokal = $this->NactiUnikatniObsah($this->unikatni["set_debug_lokal"]);  //lokalni zapinani debug modu

    $this->znacka_povinne = $this->NactiUnikatniObsah($this->unikatni["set_znacka_povinne"]);
    $this->pathpicture = $this->NactiUnikatniObsah($this->unikatni["set_pathpicture"]);
    $this->minidir = $this->NactiUnikatniObsah($this->unikatni["set_minidir"]);
    $this->fulldir = $this->NactiUnikatniObsah($this->unikatni["set_fulldir"]);
    $this->adresa_sekce = $this->NactiUnikatniObsah($this->unikatni["set_adresa_sekce"]);
    $this->rsslink = $this->NactiUnikatniObsah($this->unikatni["set_rsslink"]);

    $this->element = $this->NactiUnikatniObsah($this->unikatni["set_element"]);

    $this->povolit_pridani = $this->NactiUnikatniObsah($this->unikatni["set_povolit_pridani"]);
    $this->vypis_chybu = $this->NactiUnikatniObsah($this->unikatni["set_vypis_chybu"]);
    $this->conffile = $this->NactiUnikatniObsah($this->unikatni["set_conffile"]);

    $this->conffile = "{$this->dirpath}/{$this->conffile}";

    $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dirpath}/{$this->dbname}");
    if (!$this->PripojeniDatabaze($error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul)));
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
          $result = (!Empty($adr[1]) ? $this->AdminObsahSablony($adr[1]) : $this->AdministraceObsahu());
        break;
      }
    }

    return $result;
  }

/**
 *
 * Instalace SQLite databaze
 *
 */
  private function Instalace()
  {
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}sablona (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  adresa TEXT,
                                  razeni VARCHAR(50),
                                  nove INTEGER UNSIGNED,
                                  nove_rss INTEGER UNSIGNED,
                                  nazev VARCHAR(200),
                                  rewrite VARCHAR(200),
                                  popisek TEXT,
                                  href_id VARCHAR(200),
                                  href_class VARCHAR(200),
                                  href_akce VARCHAR(500),
                                  zobrazit BOOL);

                                  CREATE TABLE {$this->dbpredpona}obsah_sablony (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  sablona INTEGER UNSIGNED,
                                  obsah TEXT,
                                  pridano DATETIME,
                                  nazev VARCHAR(200),
                                  rewrite VARCHAR(200));

                                  CREATE TABLE {$this->dbpredpona}element (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  sablona INTEGER UNSIGNED,
                                  typ INTEGER UNSIGNED,
                                  nazev VARCHAR(200),
                                  value VARCHAR(500),
                                  povinne BOOL,
                                  vstupni_typ INTEGER UNSIGNED,
                                  reg_exp VARCHAR(500),
                                  vystupni_format VARCHAR(200),
                                  min_poc INTEGER UNSIGNED,
                                  max_poc INTEGER UNSIGNED,
                                  poradi INTEGER UNSIGNED);", $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    $i = count($adresa);
    if ($res = $this->query("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}sablona ORDER BY id ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $adresa[$i]["main_href"] = "{$this->idmodul}__{$data->id}";
          $adresa[$i]["odkaz"] = $this->NactiUnikatniObsah($this->unikatni["admin_tvar_menu_odkaz"], $data->nazev);
          $adresa[$i]["title"] = $this->NactiUnikatniObsah($this->unikatni["admin_tvar_menu_title"], $data->nazev);
          $adresa[$i]["id"] = $data->href_id;
          $adresa[$i]["class"] = $data->href_class;
          $adresa[$i]["akce"] = $data->href_akce;
          $adresa[$i]["zobrazit"] = $data->zobrazit;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $adresa;
  }

/**
 *
 * Postara se o automaticke odmazani zaznamu, pokud je implementovano (autodel) a tato funkce v indexu volana
 *
 * pouziti: <strong>[var_dump(]$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "KontrolaAutoMazani" [, "adresa"], 6 [, false]);</strong>
 *
 * @param adr adresa sablony
 * @param poradi je cislo poradi v elementech
 * @param autodel pri false zakaze auto mazani
 * @param poradi poradi elementu (autodel)
 */
  public function KontrolaAutoMazani($adr = NULL, $poradi, $autodel = true)
  {
    if (!Empty($adr))
    {
      if (is_array($adr))
      {
        $uvoz = "";
        for ($i = 0; $i < count($adr); $i++)
        {
          $uvoz[] .= "'{$adr[$i]}'";
        }
        $uvoz = implode(", ", $uvoz);
        $adresa = " IN ({$uvoz})";
        $podm_adresa = $adr[0];
      }
        else
      {
        $adresa = "='{$adr}'";
        $podm_adresa = $adr;
      }
    }
      else
    {
      $adr = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
      $adresa = "='{$adr}'";
      $podm_adresa = $adr;
    }

    $typelementu = array_flip(array_keys($this->element));
    $typ = "autodel";

    if ($res = $this->query("SELECT
                            {$this->dbpredpona}element.typ typ,
                            {$this->dbpredpona}element.poradi poradi
                            FROM {$this->dbpredpona}sablona, {$this->dbpredpona}element
                            WHERE
                            {$this->dbpredpona}sablona.id={$this->dbpredpona}element.sablona AND
                            {$this->dbpredpona}sablona.adresa{$adresa};", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $poc = 0; //posun indexuje se od 0!
        while($data = $this->fetchObject($res))
        {
          if ($typelementu[$typ] == $data->typ && $poradi == $data->poradi)
          {
            break;
          }
            else
          {
            $poc += $this->pocitadloporadi[$data->typ];
          }
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result = "";
    if ($res = $this->query("SELECT
                            {$this->dbpredpona}obsah_sablony.id id,
                            {$this->dbpredpona}obsah_sablony.obsah obsah
                            FROM {$this->dbpredpona}sablona, {$this->dbpredpona}obsah_sablony
                            WHERE
                            {$this->dbpredpona}sablona.id={$this->dbpredpona}obsah_sablony.sablona AND
                            {$this->dbpredpona}sablona.adresa{$adresa}", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $obsahpole = explode("|-x-|", $data->obsah);
          $vypis = "";
          for ($j = 0; $j < count($obsahpole); $j++)
          {
            if (count(explode("||--x--||", $obsahpole[$j])) == 5)
            {
              $obr = explode("||--x--||", $obsahpole[$j]);
              $vypis[] = "";//"{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
              $vypis[] = "";//"{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[0]}";
            }
              else
            {
              $vypis[] = $obsahpole[$j];
            }
          }

          $result[] = $vypis[$poc]; //vystupni data pro kontrolu

          if ($this->var->debug_mod && $this->debug_lokal)
          {
            var_dump("vypis: ", $vypis, "xxx");
          }

          if (!Empty($vypis[$poc]) &&
              date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($vypis[$poc])) &&
              $autodel) //porovna dotumy expirace
          {
            if ($this->queryExec("DELETE FROM {$this->dbpredpona}obsah_sablony WHERE id={$data->id};", $error)) //provedeni dotazu
            {
              $this->SyncFileWithDB();  //+synchronizace
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    if ($this->var->debug_mod && $this->debug_lokal)
    {
      var_dump("adr: ", $adr, "poradi: ", $poradi, "autodel: ", $autodel, "najity poc: ", $poc, "---");
    }

    return $result;
  }

/**
 *
 * Vrati obsah v poli
 *
 * pouziti: <strong>$pole = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "ArrayVystupObsahu"[, "adresa"]);</strong>
 *
 * @param adr adresa sablony
 * @return obsah v poli
 */
  public function ArrayVystupObsahu($adr = NULL)
  {
    if (!Empty($adr))
    {
      if (is_array($adr))
      {
        $uvoz = "";
        for ($i = 0; $i < count($adr); $i++)
        {
          $uvoz[] .= "'{$adr[$i]}'";
        }
        $uvoz = implode(", ", $uvoz);
        $adresa = " IN ({$uvoz})";
        $podm_adresa = $adr[0];
      }
        else
      {
        $adresa = "='{$adr}'";
        $podm_adresa = $adr;
      }
    }
      else
    {
      $adr = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
      $adresa = "='{$adr}'";
      $podm_adresa = $adr;
    }

    $razeni = $this->RychloVypisRazeni($podm_adresa);  //vrati smer razeni

    $result = "";
    if ($res = $this->query("SELECT
                            {$this->dbpredpona}obsah_sablony.sablona sablona,
                            {$this->dbpredpona}obsah_sablony.obsah obsah,
                            {$this->dbpredpona}obsah_sablony.pridano pridano,
                            {$this->dbpredpona}obsah_sablony.nazev nazev,
                            {$this->dbpredpona}obsah_sablony.rewrite rewrite
                            FROM {$this->dbpredpona}sablona, {$this->dbpredpona}obsah_sablony
                            WHERE
                            {$this->dbpredpona}sablona.id={$this->dbpredpona}obsah_sablony.sablona AND
                            {$this->dbpredpona}sablona.adresa{$adresa}
                            ORDER BY {$this->dbpredpona}obsah_sablony.pridano {$razeni};", $error))  //LIMIT 0,{$limit}
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $result["sablona"][] = $data->sablona;
          $result["obsah"][] = $data->obsah;
          $result["pridano"][] = $data->pridano;
          $result["nazev"][] = $data->nazev;
          $result["rewrite"][] = $data->rewrite;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati textovy smer razeni
 *
 * @param adresa adresa sablony
 * @return text razeni
 */
  private function RychloVypisRazeni($adresa)
  {
    $result = "";
    if ($res = $this->query("SELECT razeni
                            FROM {$this->dbpredpona}sablona
                            WHERE
                            adresa='{$adresa}';", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);
        $result = $data->razeni;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati textovy smer razeni pro admin
 *
 * @param sablona cislo sablony
 * @return text razeni
 */
  private function AdminVypisRazeni($sablona)
  {
    settype($sablona, "integer");

    $result = "";
    if ($res = $this->query("SELECT razeni
                            FROM {$this->dbpredpona}sablona
                            WHERE
                            id={$sablona};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);
        $result = $data->razeni;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati cislo pro pocet zobrazeni novinek v rychlo vypisu
 *
 * @param adresa adresa sablony
 * @return cislo pro limit
 */
  private function RychloVypisLimit($adresa)
  {
    $result = 0;
    if ($res = $this->query("SELECT nove
                            FROM {$this->dbpredpona}sablona
                            WHERE
                            adresa='{$adresa}';", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);
        $result = $data->nove;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati cislo pro pocet zobrazeni novinek v rss
 *
 * @param adresa adresa sablony
 * @return cislo pro limit
 */
  private function VypisLimitRSS($adresa)
  {
    $result = 0;
    if ($res = $this->query("SELECT nove_rss
                            FROM {$this->dbpredpona}sablona
                            WHERE
                            adresa='{$adresa}';", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);
        $result = $data->nove_rss;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati text daneho sloupce
 *
 * @param sablona id sablony
 * @param sloupec nazev sloupce v databazi
 * @return text sloupce
 */
  private function VypisSloupce($sablona, $sloupec)
  {
    settype($sablona, "integer");

    $result = "";
    if ($res = $this->query("SELECT {$sloupec} vyst
                            FROM {$this->dbpredpona}sablona
                            WHERE
                            id={$sablona};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);
        $result = $data->vyst;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Generuje rss link do html hlavicky (head)
 *
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLink"[, 1]);</strong>
 * pro vice polozek do adresa zapsat sablony: array("adresa", "adresa1")
 * razeni a pocet novych bere podle prvniho v poli!
 *
 * @param vyber vyber polozek z databaze sablon
 * @param tvar cislo tvaru
 * @return head link
 */
  public function RSSLink($vyber = NULL, $tvar = 1)
  {
    $result = "";
    if (!Empty($vyber))
    {
      if (is_array($vyber))
      {
        $uvoz = "";
        for ($i = 0; $i < count($vyber); $i++)
        {
          $uvoz[] .= "'{$vyber[$i]}'";
        }
        $uvoz = implode(", ", $uvoz);
        $adresa = " IN ({$uvoz})";
      }
        else
      {
        $adresa = "='{$vyber}'";
      }

      if ($res = $this->query("SELECT nazev, rewrite
                              FROM {$this->dbpredpona}sablona
                              WHERE adresa{$adresa}
                              ORDER BY nazev ASC;", $error))
      {
        if ($this->numRows($res) != 0)
        {
          while ($data = $this->fetchObject($res))
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_link_rss_{$tvar}"],
                                                ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}/{$data->rewrite}" : "?{$this->var->get_kam}={$this->rsslink}&amp;sablona={$data->rewrite}"),
                                                $data->nazev);
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
      else
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_once_link_rss_{$tvar}"],
                                          ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}" : "?{$this->var->get_kam}={$this->rsslink}"));
    }

    return $result;
  }

/**
 *
 * Generuje rss link do obsahu html
 *
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSLinkWeb"[, 1]);</strong>
 * pro vice polozek do adresa zapsat sablony: array("adresa", "adresa1")
 * razeni a pocet novych bere podle prvniho v poli!
 *
 * @param vyber vyber polozek z databaze sablon
 * @param tvar cislo tvaru
 * @return html link
 */
  public function RSSLinkWeb($vyber = NULL, $tvar = 1)
  {
    $result = "";
    if (!Empty($vyber))
    {
      if (is_array($vyber))
      {
        $uvoz = "";
        for ($i = 0; $i < count($vyber); $i++)
        {
          $uvoz[] .= "'{$vyber[$i]}'";
        }
        $uvoz = implode(", ", $uvoz);
        $adresa = " IN ({$uvoz})";
      }
        else
      {
        $adresa = "='{$vyber}'";
      }

      if ($res = $this->query("SELECT nazev, rewrite
                              FROM {$this->dbpredpona}sablona
                              WHERE adresa{$adresa}
                              ORDER BY nazev ASC;", $error))
      {
        if ($this->numRows($res) != 0)
        {
          while ($data = $this->fetchObject($res))
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_link_rss_web_{$tvar}"],
                                                ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}/{$data->rewrite}" : "?{$this->var->get_kam}={$this->rsslink}&amp;sablona={$data->rewrite}"),
                                                $data->nazev);
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
      else
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_once_link_rss_web_{$tvar}"],
                                          ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}" : "?{$this->var->get_kam}={$this->rsslink}"));
    }

    return $result;
  }

/**
 *
 * Generuje rss, odchytava si danou url
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RSSVystup"["adresa", 1]);</strong>
 * pro vice polozek do adresa zapsat sablony: array("adresa", "adresa1")
 * razeni a pocet novych bere podle prvniho v poli!
 *
 * @param adr volitelna adresa, jedna a nebo pole adres
 * @param tvar cislo tvaru
 */
  public function RSSVystup($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      if (is_array($adr))
      {
        $uvoz = "";
        for ($i = 0; $i < count($adr); $i++)
        {
          $uvoz[] .= "'{$adr[$i]}'";
        }
        $uvoz = implode(", ", $uvoz);
        $adresa = " IN ({$uvoz})";
        $podm_adresa = $adr[0];
      }
        else
      {
        $adresa = "='{$adr}'";
        $podm_adresa = $adr;
      }
    }
      else
    {
      $adr = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
      $adresa = "='{$adr}'";
      $podm_adresa = $adr;
    }

    $razeni = $this->RychloVypisRazeni($podm_adresa);  //vrati smer razeni
    $limit = $this->VypisLimitRSS($podm_adresa);  //vrati pocet polozek v rychlo vypisu

    $this->rss_kodovani = $this->NactiUnikatniObsah($this->unikatni["set_rss_kodovani_{$tvar}"]);
    $this->rss_title = $this->NactiUnikatniObsah($this->unikatni["set_rss_title_{$tvar}"]);
    $this->rss_category = $this->NactiUnikatniObsah($this->unikatni["set_rss_category_{$tvar}"]);
    $this->rss_description = $this->NactiUnikatniObsah($this->unikatni["set_rss_description_{$tvar}"]);
    $this->rss_language = $this->NactiUnikatniObsah($this->unikatni["set_rss_language_{$tvar}"]);
    $this->rss_copyright = $this->NactiUnikatniObsah($this->unikatni["set_rss_copyright_{$tvar}"]);
    $this->rss_managingEditor = $this->NactiUnikatniObsah($this->unikatni["set_rss_managingEditor_{$tvar}"]);
    $this->rss_webMaster = $this->NactiUnikatniObsah($this->unikatni["set_rss_webMaster_{$tvar}"]);
    $this->rss_ttl = $this->NactiUnikatniObsah($this->unikatni["set_rss_ttl_{$tvar}"]);
    $this->rss_image_title = $this->NactiUnikatniObsah($this->unikatni["set_rss_image_title_{$tvar}"]);
    $this->rss_image_link = $this->NactiUnikatniObsah($this->unikatni["set_rss_image_link_{$tvar}"], $this->absolutni_url);
    $this->rss_image_url = $this->NactiUnikatniObsah($this->unikatni["set_rss_image_url_{$tvar}"], $this->absolutni_url);

    if ($_GET[$this->var->get_kam] == $this->rsslink)  //ceka na danou adresu
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_rss_header_{$tvar}"],
                                          $this->rss_kodovani,
                                          $this->rss_title,
                                          $this->absolutni_url,
                                          $this->rss_category,
                                          $this->rss_description,
                                          $this->rss_language,
                                          $this->rss_copyright,
                                          $this->rss_managingEditor,
                                          $this->rss_webMaster,
                                          $this->rss_ttl,
                                          gmdate("D, d M Y H:i:s \G\M\T"),
                                          $this->rss_image_url);

      if ($res = $this->query("SELECT {$this->dbpredpona}obsah_sablony.nazev nazev,
                              {$this->dbpredpona}obsah_sablony.rewrite rewrite,
                              {$this->dbpredpona}obsah_sablony.obsah obsah,
                              {$this->dbpredpona}obsah_sablony.pridano datum
                              FROM {$this->dbpredpona}sablona, {$this->dbpredpona}obsah_sablony
                              WHERE
                              {$this->dbpredpona}sablona.id={$this->dbpredpona}obsah_sablony.sablona AND
                              {$this->dbpredpona}sablona.adresa{$adresa}
                              ORDER BY {$this->dbpredpona}obsah_sablony.pridano {$razeni}
                              LIMIT 0,{$limit};", $error))
      {
        if ($this->numRows($res) != 0)
        {
          $i = 0;
          while ($data = $this->fetchObject($res))
          { //kdyz bude na webu: prevadet - zpetne, lokal neprevadet
            $prevod = (in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $data->obsah : htmlspecialchars_decode(html_entity_decode($data->obsah, ENT_QUOTES)));
            $obsahpole = explode("|-x-|", $prevod); //1.stupen rozsekani

            $vypis = array("array_args",
                          $this->absolutni_url,
                          $data->rewrite,
                          $data->nazev,
                          date("D, d M Y H:i:s \G\M\T", strtotime($data->datum)),
                          $i);

            for ($j = 0; $j < count($obsahpole); $j++)
            {
              if (count(explode("||--x--||", $obsahpole[$j])) == 5)
              {
                $obr = explode("||--x--||", $obsahpole[$j]);
                $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
                $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[0]}";
              }
                else
              {
                $vypis[] = $obsahpole[$j];
              }
            }

            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rss_item_{$tvar}"], $vypis);
            $i++;
          }
        }
      }

      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rss_end_{$tvar}"]);

      echo $result;
      exit(0);
    }
  }

/**
 *
 * Rychlo vypis pro strucne zobrazeni napr. na uvodu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "RychloVypis"[, "adresa", 1]);</strong>
 * pro vice polozek do adresa zapsat sablony: array("adresa", "adresa1")
 * razeni a pocet novych bere podle prvniho v poli!
 *
 * @param adr adresa sablony
 * @param tvar cislo tvaru
 * @return dany pocet polozek obsahu
 */
  public function RychloVypis($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      if (is_array($adr))
      {
        $uvoz = "";
        for ($i = 0; $i < count($adr); $i++)
        {
          $uvoz[] .= "'{$adr[$i]}'";
        }
        $uvoz = implode(", ", $uvoz);
        $adresa = " IN ({$uvoz})";
        $podm_adresa = $adr[0];
      }
        else
      {
        $adresa = "='{$adr}'";
        $podm_adresa = $adr;
      }
    }
      else
    {
      $adr = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
      $adresa = "='{$adr}'";
      $podm_adresa = $adr;
    }

    $razeni = $this->RychloVypisRazeni($podm_adresa);  //vrati smer razeni
    $limit = $this->RychloVypisLimit($podm_adresa);  //vrati pocet polozek v rychlo vypisu

    $prvni = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_prvni_{$tvar}"]);
    $posledni = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_posledni_{$tvar}"]);
    $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_ente_def_array_{$tvar}"]);
    $ente_def = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_ente_def_{$tvar}"]);
    $ente_od = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_ente_od_{$tvar}"]);
    $ente_po = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_ente_po_{$tvar}"]);
    $ente = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_ente_{$tvar}"]);

    $result = "";
    if ($res = $this->query("SELECT {$this->dbpredpona}obsah_sablony.nazev nazev,
                            {$this->dbpredpona}obsah_sablony.rewrite rewrite,
                            {$this->dbpredpona}obsah_sablony.obsah obsah
                            FROM {$this->dbpredpona}sablona, {$this->dbpredpona}obsah_sablony
                            WHERE
                            {$this->dbpredpona}sablona.id={$this->dbpredpona}obsah_sablony.sablona AND
                            {$this->dbpredpona}sablona.adresa{$adresa}
                            ORDER BY {$this->dbpredpona}obsah_sablony.pridano {$razeni}
                            LIMIT 0,{$limit};", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $i = 0;
        while ($data = $this->fetchObject($res))
        {
          $obsahpole = explode("|-x-|", $data->obsah);

          $vypis = array("array_args",
                        $this->absolutni_url,
                        $data->rewrite,
                        $data->nazev,
                        (!Empty($data->rewrite) && $_GET[$this->var->get_kam] == $data->rewrite ? $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_oznaceni_{$tvar}"]) : ""),
                        ($i == 0 ? $prvni : ""),
                        ($i == ($this->numRows($res) - 1) ? $posledni : ""),
                        (in_array($i, $ente_def_array) ? $ente_def : ""),
                        ((($i + $ente_od) % $ente_po) == 0 ? $ente : ""));

          for ($j = 0; $j < count($obsahpole); $j++)
          {
            if (count(explode("||--x--||", $obsahpole[$j])) == 5)
            {
              $obr = explode("||--x--||", $obsahpole[$j]);
              $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
              $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[0]}";
            }
              else
            {
              $vypis[] = $obsahpole[$j];
            }
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_{$tvar}"], $vypis);
          $i++;
        }
      }
        else
      {
        if ($this->vypis_chybu)
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_rychlo_vypis_null_{$tvar}"]);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vypise title do stranek
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "Title");</strong>
 *
 * @return title text
 */
  public function Title()
  {
    $result = "";
    if (!Empty($_GET[$this->adresa_sekce]))
    {
      $adresa = $_GET[$this->adresa_sekce];
      if ($res = $this->query("SELECT nazev
                              FROM {$this->dbpredpona}obsah_sablony
                              WHERE
                              rewrite='{$adresa}';", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $data = $this->fetchObject($res);
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_title"],  $data->nazev);
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Zjisti pocet radku v datazazi navstevni knihy
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "PocetRadkuDynamickeZobrazeni"[, "adresa"]);</strong>
 *
 * @param adr adresa navstevn knihy
 * @return pocet radku v databazi
 */
  public function PocetRadkuDynamickeZobrazeni($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $result = 0;
    if ($res = $this->query("SELECT {$this->dbpredpona}obsah_sablony.id
                            FROM {$this->dbpredpona}sablona, {$this->dbpredpona}obsah_sablony
                            WHERE {$this->dbpredpona}sablona.id={$this->dbpredpona}obsah_sablony.sablona AND
                            {$this->dbpredpona}sablona.adresa='{$adresa}';", $error))
    {
      $result = $this->numRows($res);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

  private function PoleTypuSablony($adresa)
  {
    $result = "";
    if ($res = $this->query("SELECT {$this->dbpredpona}element.typ typ
                            FROM {$this->dbpredpona}sablona, {$this->dbpredpona}element
                            WHERE
                            {$this->dbpredpona}sablona.id={$this->dbpredpona}element.sablona AND
                            {$this->dbpredpona}sablona.adresa='{$adresa}'
                            ORDER BY {$this->dbpredpona}element.poradi ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result[] = $data->typ;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Hlavni dynamicke zobrazeni obsahu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicZobrazeni", "DynamickeZobrazeni"[, "adresa", true, array("dalsi text a nebo funkce"), 1]);</strong>
 *
 * @param adr adresa sablony
 * @param kotrola zapina/vypina kontrolu uvozovek
 * @param pridavek pridava obsah pole do obsahu, tvar %%XX%%
 * @param strankovani vlozi nadefnovane pole ze strankovaciho modulu
 * @param tvar cislo tvaru
 * @return hlavni graficky vypis
 */
  public function DynamickeZobrazeni($adr = NULL, $kontrola = true, $pridavek = NULL, $strankovani = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $limit = $str = "";
    if (!Empty($strankovani))
    {
      list($str, $limit) = $strankovani;
    }

    $razeni = $this->RychloVypisRazeni($adresa);  //vrati smer razeni

    $prvni = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_prvni_{$tvar}"]);
    $posledni = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_posledni_{$tvar}"]);
    $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_def_array_{$tvar}"]);
    $ente_def = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_def_{$tvar}"]);
    $ente_od = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_od_{$tvar}"]);
    $ente_po = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_po_{$tvar}"]);
    $ente = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_{$tvar}"]);

    $arrayden = $this->NactiUnikatniObsah($this->unikatni["dny_datum_{$tvar}"]);

    $result = "";
    if (Empty($_GET[$this->adresa_sekce]))  //normalni vypis
    {
      //nacist do pole typy prvku a podle nich rozdelovat
      $typy = $this->PoleTypuSablony($adresa);
      $typelementu = array_keys($this->element);

      if ($res = $this->query("SELECT {$this->dbpredpona}obsah_sablony.id id,
                              {$this->dbpredpona}obsah_sablony.obsah obsah,
                              {$this->dbpredpona}obsah_sablony.nazev nazev,
                              {$this->dbpredpona}obsah_sablony.rewrite rewrite
                              FROM {$this->dbpredpona}sablona, {$this->dbpredpona}obsah_sablony
                              WHERE
                              {$this->dbpredpona}sablona.id={$this->dbpredpona}obsah_sablony.sablona AND
                              {$this->dbpredpona}sablona.adresa='{$adresa}'
                              ORDER BY {$this->dbpredpona}obsah_sablony.pridano {$razeni}
                              {$limit};", $error))
      {
        if ($this->numRows($res) != 0)
        {
          $i = 0;
          while ($data = $this->fetchObject($res))
          {
            $obsahpole = explode("|-x-|", $data->obsah);

            $vypis = array("array_args",
                          $this->absolutni_url,
                          $data->rewrite,
                          $data->nazev,
                          ($i == 0 ? $prvni : ""),
                          ($i == ($this->numRows($res) - 1) ? $posledni : ""),
                          (in_array($i, $ente_def_array) ? $ente_def : ""),
                          ((($i + $ente_od) % $ente_po) == 0 ? $ente : ""));

            for ($j = 0; $j < count($typy); $j++)
            {
              switch ($typelementu[$typy[$j]])
              {
                case "nadpis": //nadpis
                case "popisek": //popisek
                case "text": //text
                case "checkbox": //checkbox
                  $vypis[] = ($kontrola ? htmlspecialchars_decode(html_entity_decode($obsahpole[$j])) : $obsahpole[$j]);
                break;

                case "obrazek": //obrazek
                  $obr = explode("||--x--||", $obsahpole[$j]);

                  $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
                  $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[0]}";
                break;

                case "datum": //datum
                  if ($this->var->debug_mod && $this->debug_lokal)
                  {
                    var_dump("normal_vypis_datum_{$j}_{$tvar}");  //"d.m.Y"
                  } //bonus: vlozeni dne v tydnu

                  $vypis[] = date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_datum_{$j}_{$tvar}"],
                                                            $arrayden[date("N", strtotime($obsahpole[$j]))]), strtotime($obsahpole[$j]));
                break;

                case "cas": //cas
                  if ($this->var->debug_mod && $this->debug_lokal)
                  {
                    var_dump("normal_vypis_cas_{$j}_{$tvar}");  //"H:i:s"
                  }

                  $vypis[] = date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_cas_{$j}_{$tvar}"],
                                                            $arrayden[date("N", strtotime($obsahpole[$j]))]), strtotime($obsahpole[$j]));
                break;

                case "datumcas": //datumcas
                  if ($this->var->debug_mod && $this->debug_lokal)
                  {
                    var_dump("normal_vypis_datumcas_{$j}_{$tvar}");  //"d.m.Y H:i:s"
                  }

                  $vypis[] = date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_datumcas_{$j}_{$tvar}"],
                                                            $arrayden[date("N", strtotime($obsahpole[$j]))]), strtotime($obsahpole[$j]));
                break;

                case "autodel": //automazani
                  //
                break;
              }
            }

            $vypis[] = $data->id; //id radku obsahu

            if (count($pridavek) > 0)
            {
              $dalsi[] = $this->absolutni_url;  //vklada se za vygenerovany vypis a neplati dosavadni promenne
              for ($j = 0; $j < count($pridavek); $j++)
              {
                $dalsi[] = $pridavek[$j]; //naplneni pole pro doplnkove %% parametry
              }

              $vypis = array_merge($vypis, $dalsi); //slouceni pole
            }

            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_{$tvar}"], //klasický %% výpis!!
                                                $vypis);
            $i++;
          }
        }
          else
        {
          if ($this->vypis_chybu)
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_null_{$tvar}"]);
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $result .= $str;  //vlozeni strankovani
    }
      else
    {
      $adresa = $_GET[$this->adresa_sekce]; //full one vypis
      if ($res = $this->query("SELECT obsah, nazev, rewrite
                              FROM {$this->dbpredpona}obsah_sablony
                              WHERE
                              rewrite='{$adresa}';", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $data = $this->fetchObject($res);

          $obsahpole = explode("|-x-|", $data->obsah);

          $vypis = array("array_args");
          for ($i = 0; $i < count($obsahpole); $i++)
          {
            if (count(explode("||--x--||", $obsahpole[$i])) == 5)
            {
              $obr = explode("||--x--||", $obsahpole[$i]);
              $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
              $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[0]}";
            }
              else
            {
              $vypis[] = $obsahpole[$i];
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_full_{$tvar}"], $vypis);
        }
          else
        {
          //if ($this->vypis_chybu)
          //{
            $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_full_error_{$tvar}"]);
          //}
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Detekuje prvek auto del
 *
 * @param sablona cislo sablony
 * @param &id_elem id vystupniho elementu pro zamereni JS
 * @param &date_inc pricitaci text datumu
 * @param &date_format vystupni format datumu auto del
 * @return true/false - detekovano/nedetekovano
 */
  private function DetekceAutodel($sablona, &$id_elem, &$date_inc, &$date_format)
  {
    settype($sablona, "integer");

    $result = "";
    if ($res = $this->query("SELECT value, reg_exp, vystupni_format
                            FROM {$this->dbpredpona}element
                            WHERE sablona={$sablona} AND
                            typ=8;", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $result = true;
        $data = $this->fetchObject($res);

        $id_elem = $data->value;
        $date_inc = $data->reg_exp;
        $date_format = $data->vystupni_format;
      }
        else
      {
        $result = false;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vypise obsah skupiny, univerzelni vypis
 *
 * @param sablona id dane sablony
 * @return obsah skupny s odkazy
 */
  private function AdminObsahSablony($sablona)
  {
    settype($sablona, "integer");

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_sablony"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=addobsah",
                                        $this->VypisSloupce($sablona, "popisek"),
                                        $this->AdminVypisObsahSablony($sablona),
                                        $this->VypisSloupce($sablona, "nazev"));

    $typelementu = array_keys($this->element);

    if (!file_exists("{$this->dirpath}/{$this->pathpicture}"))  //vytvoreni slozek na obrazky
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}"))
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}"))
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}", 0777);
    }

    $co = $_GET["co"];

    $doplnek = ($this->NactiUnikatniObsah($this->unikatni["set_admin_prepnani_unikatnich"]) ? "_{$sablona}" : "");  //rozlisi jestli vkladat _X nebo ""

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah":  //pridavani obsahu
          if ($res = $this->query("SELECT id, sablona, typ, nazev, value,
                                  povinne, vstupni_typ, reg_exp,
                                  vystupni_format, min_poc, max_poc,
                                  poradi
                                  FROM {$this->dbpredpona}element
                                  WHERE sablona={$sablona}
                                  ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res) != 0)
            {
              $element = "";
              $i = 0;
              $pocetelem = $this->numRows($res);
              $poradielem = 7;  //+7
              while($data = $this->fetchObject($res))
              {
                $povinne = ($data->povinne ? $this->znacka_povinne : "");

                $podminka[$i]["id"] = $data->id;
                $podminka[$i]["name"] = "elem_{$data->id}"; //jmeno elementu
                $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
                $podminka[$i]["obr"] = "elem_obr"; //nazev elementu obrazku
                $podminka[$i]["nahled"] = "nahled_obr"; //nazev elementu nahledu
                $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
                $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
                $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
                $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
                $podminka[$i]["min"] = $data->min_poc;  //minimalni pocet
                $podminka[$i]["max"] = $data->max_poc;  //maximalni pocet
                $podminka[$i]["chyba"] = "";
                $podminka[$i]["chyba_form"] = "";

                switch ($typelementu[$data->typ])
                {
                  case "nadpis": //nadpis
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_nadpis{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "popisek": //popisek
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "text": //text
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "obrazek": //obrazek
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $rozdelit = explode("|-|", $data->value);
                    $w_mini = $rozdelit[0];
                    $h_mini = $rozdelit[1];
                    $w_full = $rozdelit[2];
                    $h_full = $rozdelit[3];

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_obrazek{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $w_mini,
                                                          $h_mini,
                                                          $w_full,
                                                          $h_full,
                                                          ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                                          ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                                          ($w_full != 0 ? " checked=\"checked\"" : ""),
                                                          ($h_full != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                                          ($w_mini == 0 && $h_mini == 0 ? "mini_4{$data->id}()" : ($w_mini != 0 && $h_mini != 0 ? "mini_3{$data->id}();" : ($h_mini != 0 ? "mini_2{$data->id}();" : ($w_mini != 0 ? "mini_1{$data->id}();" : "")))),
                                                          ($w_full == 0 && $h_full == 0 ? "full_4{$data->id}();" : ($w_full != 0 && $h_full != 0 ? "full_3{$data->id}();" : ($h_full != 0 ? "full_2{$data->id}();" : ($w_full != 0 ? "full_1{$data->id}();" : "")))),
                                                          "",
                                                          "",
                                                          $poradielem);
                  break;

                  case "datum": //datum
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    $input_akce = "";
                    if ($this->DetekceAutodel($sablona, $del_id, $inc, $format))
                    {
                      $input_akce = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel_onkeyp"],
                                                              $del_id,
                                                              $inc,
                                                              $format);
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),//$data->value,
                                                          "",
                                                          "",
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;

                  case "cas": //cas
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_cas{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),//$data->value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;

                  case "datumcas": //datumcas
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    $input_akce = "";
                    if ($this->DetekceAutodel($sablona, $del_id, $inc, $format))
                    {
                      $input_akce = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel_onkeyp"],
                                                              $del_id,
                                                              $inc,
                                                              $format);
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),//$data->value,
                                                          "",
                                                          "",
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;

                  case "checkbox": //checkbox
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_checkbox{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          " value=\"{$data->value}\"",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          (!Empty($_POST["elem_{$data->id}"]) ? " checked=\"checked\"" : ""),
                                                          $poradielem);
                  break;

                  case "autodel":
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    $input_id = "";
                    if ($this->DetekceAutodel($sablona, $del_id, $inc, $format))
                    {
                      $input_id = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel_id"],
                                                            $del_id);
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          date($data->vystupni_format),
                                                          "",
                                                          $input_id,
                                                          "",
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;
                }

                $i++;
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_form{$doplnek}"],
                                              $element,
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}",
                                              " name=\"tlacitko\"",
                                              (!Empty($_POST["tlacitko"]) ? " disabled=\"disabled\"" : ""),
                                              (!Empty($_POST["tlacitko"]) ? "_disabled" : ""),
                                              $this->VypisSloupce($sablona, "nazev"));

          $poc = 0;
          $check = true;
          for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
          {
            $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

            switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
            {
              case "nadpis":
              case "popisek":
              case "text":
                switch ($podminka[$i]["vstup"])
                {
                  case "text":  //konvert textu
                    settype($zpost, "string");

                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]);
                    }
                      else
                    if ($podminka[$i]["min"] > 0 &&
                        $podminka[$i]["max"] > 0)
                    {
                      if (strlen($zpost) < $podminka[$i]["min"] ||
                          strlen($zpost) > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min_max"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["min"] > 0)  //kontrola minina
                    {
                      if (strlen($zpost) < $podminka[$i]["min"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["max"] > 0)  //kontrola maxima
                    {
                      if (strlen($zpost) > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_max"], $podminka[$i]["nazev"]);
                      }
                    }
                  break;

                  case "integer": //konvert cisla
                    settype($zpost, "integer");

                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]);
                    }
                      else
                    if ($podminka[$i]["min"] > 0 &&
                        $podminka[$i]["max"] > 0)
                    {
                      if ($zpost < $podminka[$i]["min"] ||
                          $zpost > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min_max"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["min"] > 0)  //kontrola minina
                    {
                      if ($zpost < $podminka[$i]["min"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["max"] > 0)  //kontrola maxima
                    {
                      if ($zpost > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_max"], $podminka[$i]["nazev"]);
                      }
                    }
                  break;

                  case "reg_exp": //konrola reg_exp
                    preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                    $zpost = $ret[0];  //vybere nulty index

                    if (Empty($zpost))
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_reg_exp"], $podminka[$i]["nazev"]);
                    }
                  break;
                }

                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                }
                  else
                {
                  $poc++;
                }
              break;

              case "obrazek": //kontrola $_FILES
                if (Empty($_FILES["elem_obr"]["tmp_name"][$podminka[$i]["id"]]) && $podminka[$i]["povinne"])
                {
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]);
                  $check = false;
                }
                  else
                {
                  $poc++;
                }
              break;

              case "checkbox":  //kontrola $_POST
                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_checkbox"], $podminka[$i]["nazev"]);
                }
                  else
                {
                  $poc++;
                }
              break;

              default:  //kontrola $_POST
                if (Empty($_POST[$podminka[$i]["name"]]) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_unknown"], $error_nazev);
                }
                  else
                {
                  $poc++;
                }
              break;
            }
          }

          if (!Empty($_POST["tlacitko"]) &&
              $poc == $pocetelem &&
              $check)
          {
            $ukladani[] = "";
            for ($i = 0; $i < $pocetelem; $i++)
            {
              switch ($podminka[$i]["typ"])
              {
                case "obrazek": //upload obrazku
                  $w_mini = $_POST["w_mini"][$podminka[$i]["id"]];
                  settype($w_mini, "integer");

                  $h_mini = $_POST["h_mini"][$podminka[$i]["id"]];
                  settype($h_mini, "integer");

                  $w_full = $_POST["w_full"][$podminka[$i]["id"]];
                  settype($w_full, "integer");

                  $h_full = $_POST["h_full"][$podminka[$i]["id"]];
                  settype($h_full, "integer");

                  $url = "";
                  if (!Empty($_FILES[$podminka[$i]["obr"]]["tmp_name"][$podminka[$i]["id"]]))
                  {
                    $this->ZpracujObrazek($_FILES[$podminka[$i]["obr"]], $podminka[$i]["id"], $url, $w_mini, $h_mini, $w_full, $h_full, $_FILES[$podminka[$i]["nahled"]]);
                  }

                  $uloz_obr = "";
                  $uloz_obr[] = $url;
                  $uloz_obr[] = $w_mini;
                  $uloz_obr[] = $h_mini;
                  $uloz_obr[] = $w_full;
                  $uloz_obr[] = $h_full;

                  $ukladani[$i] = implode("||--x--||", $uloz_obr);
                break;

                default:  //rozdeleni hodnot
                  $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
                break;
              }
            }

            $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
            $nazev = $this->ChangeWrongChar($_POST["nazev"]);
            $rewrite = $this->ChangeWrongChar($_POST["rewrite"]);
            $datum = date("Y-m-d H:i:s");

            if ($this->queryExec("INSERT INTO {$this->dbpredpona}obsah_sablony (id, sablona, obsah, pridano, nazev, rewrite) VALUES
                                  (NULL, {$sablona}, '{$ulozit}', '{$datum}', '{$nazev}', '{$rewrite}');", $error))
            {
              $navic = $this->SyncFileWithDB();
              $rozdel = explode("|-x-|", $ulozit);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_hlaska"], $rozdel[0], $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
            else
          {
            if (count($_POST) > 0)
            {
              $chyba = "";
              $chyba_form = "";
              for ($i = 0; $i < count($podminka); $i++) //$pocetelem
              {
                $chyba .= $podminka[$i]["chyba"];
                $chyba_form .= $podminka[$i]["chyba_form"];
              }

              if (Empty($_POST["error_tlacitko"]))
              {
                $error_button = $this->NactiUnikatniObsah($this->unikatni["admin_error_button"]);
              }

              $result .= $this->NactiUnikatniObsah($this->unikatni["admin_error_end"],
                                                  $chyba,
                                                  $chyba_form,
                                                  $error_button,
                                                  "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");
            }
          }
        break;



        case "editobsah": //uprava obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT sablona, obsah, pridano, nazev, rewrite FROM {$this->dbpredpona}obsah_sablony WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);
              $obsah = $data->obsah;
              $nazev = $data->nazev;
              $rewrite = $data->rewrite;
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $nacist = explode("|-x-|", $obsah); //znovu rozdeleni

          if ($res = $this->query("SELECT id, sablona, typ, nazev, value,
                                  povinne, vstupni_typ, reg_exp,
                                  vystupni_format, min_poc, max_poc,
                                  poradi
                                  FROM {$this->dbpredpona}element
                                  WHERE sablona={$sablona}
                                  ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res) != 0)
            {
              $element = "";
              $i = 0;
              $pocetelem = $this->numRows($res);
              $poradielem = 7;  //+7
              while($data = $this->fetchObject($res))
              {
                $povinne = ($data->povinne ? $this->znacka_povinne : "");

                $podminka[$i]["id"] = $data->id;
                $podminka[$i]["name"] = "elem_{$data->id}"; //jmeno elementu
                $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
                $podminka[$i]["obr"] = "elem_obr"; //nazev elementu obrazku
                $podminka[$i]["nahled"] = "nahled_obr"; //nazev elementu nahledu
                $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
                $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
                $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
                $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
                $podminka[$i]["min"] = $data->min_poc;  //minimalni pocet
                $podminka[$i]["max"] = $data->max_poc;  //maximalni pocet
                $podminka[$i]["chyba"] = "";
                $podminka[$i]["chyba_form"] = "";

                switch ($typelementu[$data->typ])
                {
                  case "nadpis": //nadpis
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $nacist[$i]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_nadpis{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "popisek": //popisek
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $nacist[$i]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "text": //text
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $nacist[$i]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "obrazek": //obrazek
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $rozdelit = explode("||--x--||", $nacist[$i]);
                    $w_mini = $rozdelit[1];
                    $h_mini = $rozdelit[2];
                    $w_full = $rozdelit[3];
                    $h_full = $rozdelit[4];

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_obrazek{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $w_mini,
                                                          $h_mini,
                                                          $w_full,
                                                          $h_full,
                                                          ($w_mini != 0 ? " checked=\"checked\"" : ""),
                                                          ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                                          ($w_full != 0 ? " checked=\"checked\"" : ""),
                                                          ($h_full != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                                          ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                                          ($w_mini == 0 && $h_mini == 0 ? "mini_4{$data->id}()" : ($w_mini != 0 && $h_mini != 0 ? "mini_3{$data->id}();" : ($h_mini != 0 ? "mini_2{$data->id}();" : ($w_mini != 0 ? "mini_1{$data->id}();" : "")))),
                                                          ($w_full == 0 && $h_full == 0 ? "full_4{$data->id}();" : ($w_full != 0 && $h_full != 0 ? "full_3{$data->id}();" : ($h_full != 0 ? "full_2{$data->id}();" : ($w_full != 0 ? "full_1{$data->id}();" : "")))),
                                                          "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$rozdelit[0]}",
                                                          "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$rozdelit[0]}",
                                                          $poradielem);
                  break;

                  case "datum": //datum
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    $input_akce = "";
                    if ($this->DetekceAutodel($sablona, $del_id, $inc, $format))
                    {
                      $input_akce = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel_onkeyp"],
                                                              $del_id,
                                                              $inc,
                                                              $format);
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          "",
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;

                  case "cas": //cas
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_cas{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;

                  case "datumcas": //datumcas
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    $input_akce = "";
                    if ($this->DetekceAutodel($sablona, $del_id, $inc, $format))
                    {
                      $input_akce = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel_onkeyp"],
                                                              $del_id,
                                                              $inc,
                                                              $format);
                    }
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          "",
                                                          $input_akce,
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;

                  case "checkbox": //checkbox
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_checkbox{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          " value=\"{$data->value}\"",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          (!Empty($nacist[$i]) ? " checked=\"checked\"" : ""),
                                                          $poradielem);
                  break;

                  case "autodel":
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    $input_id = "";
                    if ($this->DetekceAutodel($sablona, $del_id, $inc, $format))
                    {
                      $input_id = $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel_id"],
                                                            $del_id);
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_autodel{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          $input_id,
                                                          "",
                                                          $povinne,
                                                          $data->vystupni_format,
                                                          date($data->vystupni_format),
                                                          $poradielem);
                  break;
                }

                $i++;
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_form{$doplnek}"],
                                              $element,
                                              $nazev,
                                              $rewrite,
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}",
                                              " name=\"tlacitko\"",
                                              (!Empty($_POST["tlacitko"]) ? " disabled=\"disabled\"" : ""),
                                              (!Empty($_POST["tlacitko"]) ? "_disabled" : ""),
                                              $this->VypisSloupce($sablona, "nazev"));

          $poc = 0;
          $check = true;
          for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
          {
            $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

            switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
            {
              case "nadpis":
              case "popisek":
              case "text":
                switch ($podminka[$i]["vstup"])
                {
                  case "text":  //konvert textu
                    settype($zpost, "string");

                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]);
                    }
                      else
                    if ($podminka[$i]["min"] > 0 &&
                        $podminka[$i]["max"] > 0)
                    {
                      if (strlen($zpost) < $podminka[$i]["min"] ||
                          strlen($zpost) > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min_max"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["min"] > 0)  //kontrola minina
                    {
                      if (strlen($zpost) < $podminka[$i]["min"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["max"] > 0)  //kontrola maxima
                    {
                      if (strlen($zpost) > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_max"], $podminka[$i]["nazev"]);
                      }
                    }
                  break;

                  case "integer": //konvert cisla
                    settype($zpost, "integer");

                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]);
                    }
                      else
                    if ($podminka[$i]["min"] > 0 &&
                        $podminka[$i]["max"] > 0)
                    {
                      if ($zpost < $podminka[$i]["min"] ||
                          $zpost > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min_max"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["min"] > 0)  //kontrola minina
                    {
                      if ($zpost < $podminka[$i]["min"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_min"], $podminka[$i]["nazev"]);
                      }
                    }
                      else
                    if ($podminka[$i]["max"] > 0)  //kontrola maxima
                    {
                      if ($zpost > $podminka[$i]["max"])
                      {
                        $zpost = "";
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_max"], $podminka[$i]["nazev"]);
                      }
                    }
                  break;

                  case "reg_exp": //konrola reg_exp
                    preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                    $zpost = $ret[0];  //vybere nulty index

                    if (Empty($zpost))
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_reg_exp"], $podminka[$i]["nazev"]);
                    }
                  break;
                }

                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                }
                  else
                {
                  $poc++;
                }
              break;

              case "obrazek": //kontrola $_FILES
/*
              var_dump($_FILES[$podminka[$i]["obr"]]["tmp_name"][$podminka[$i]["id"]]);
                if (Empty($_FILES[$podminka[$i]["obr"]]["tmp_name"][$podminka[$i]["id"]]) && $podminka[$i]["povinne"])
                {
                  $check = false;
                }
                  else
                {
*/
                  $poc++;
                //}
              break;

              case "checkbox":  //kontrola $_POST
                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_checkbox"], $podminka[$i]["nazev"]);
                }
                  else
                {
                  $poc++;
                }
              break;

              default:  //kontrola $_POST
                if (Empty($_POST[$podminka[$i]["name"]]) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_unknown"], $podminka[$i]["nazev"]);
                }
                  else
                {
                  $poc++;
                }
              break;
            }
          }

          if (!Empty($_POST["tlacitko"]) &&
              $poc == $pocetelem &&
              $check &&
              $id != 0)
          {
            $ukladani[] = "";
            for ($i = 0; $i < $pocetelem; $i++)
            {
              switch ($podminka[$i]["typ"])
              {
                case "obrazek": //upload obrazku
                  $w_mini = $_POST["w_mini"][$podminka[$i]["id"]];
                  settype($w_mini, "integer");

                  $h_mini = $_POST["h_mini"][$podminka[$i]["id"]];
                  settype($h_mini, "integer");

                  $w_full = $_POST["w_full"][$podminka[$i]["id"]];
                  settype($w_full, "integer");

                  $h_full = $_POST["h_full"][$podminka[$i]["id"]];
                  settype($h_full, "integer");

                  $url = "";
                  if (!Empty($_FILES[$podminka[$i]["obr"]]["tmp_name"][$podminka[$i]["id"]]) &&
                      ($w_mini == 0 && $h_mini == 0 && Empty($_FILES[$podminka[$i]["nahled"]]["tmp_name"][$podminka[$i]["id"]]) ? false : true))
                  {
                    $this->ZpracujObrazek($_FILES[$podminka[$i]["obr"]], $podminka[$i]["id"], $url, $w_mini, $h_mini, $w_full, $h_full, $_FILES[$podminka[$i]["nahled"]]);
                  }
                    else
                  {
                    $rozdelit = explode("||--x--||", $nacist[$i]);
                    $url = $rozdelit[0];
                  }

                  $uloz_obr = "";
                  $uloz_obr[] = $url;
                  $uloz_obr[] = $w_mini;
                  $uloz_obr[] = $h_mini;
                  $uloz_obr[] = $w_full;
                  $uloz_obr[] = $h_full;

                  $ukladani[$i] = implode("||--x--||", $uloz_obr);
                break;

                default:  //rozdeleni hodnot
                  $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
                break;
              }
            }

            $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
            $nazev = $this->ChangeWrongChar($_POST["nazev"]);
            $rewrite = $this->ChangeWrongChar($_POST["rewrite"]);

            if ($this->queryExec("UPDATE {$this->dbpredpona}obsah_sablony SET sablona={$sablona},
                                                                              obsah='{$ulozit}',
                                                                              nazev='{$nazev}',
                                                                              rewrite='{$rewrite}'
                                                                              WHERE id={$id};", $error))
            {
              $navic = $this->SyncFileWithDB();
              $rozdel = explode("|-x-|", $ulozit);
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_hlaska"], $rozdel[0], $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
            else
          {
            if (count($_POST) > 0)
            {
              $chyba = "";
              $chyba_form = "";
              for ($i = 0; $i < count($podminka); $i++) //$pocetelem
              {
                $chyba .= $podminka[$i]["chyba"];
                $chyba_form .= $podminka[$i]["chyba_form"];
              }

              if (Empty($_POST["error_tlacitko"]))
              {
                $error_button = $this->NactiUnikatniObsah($this->unikatni["admin_error_button"]);
              }

              $result .= $this->NactiUnikatniObsah($this->unikatni["admin_error_end"],
                                                  $chyba,
                                                  $chyba_form,
                                                  $error_button,
                                                  "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");
            }
          }
        break;

        case "delobsah": //mazani podle id obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT obsah FROM {$this->dbpredpona}obsah_sablony WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}obsah_sablony WHERE id={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB();
                $rozdel = explode("|-x-|", $data->obsah);
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delobsah_hlaska"], $rozdel[0], $navic);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Zpracovani obrazku
 *
 * @param tmp temp name obrazku
 * @param cislo cislo obrazku
 * @param &obrazek pres parametr vraci jmeno obrazku
 * @param w_mini sirka mini
 * @param h_mini vyska mini
 * @param w_full sirka full
 * @param h_full vyska full
 * @param tmp2 temp name nahradni minatury
 * @return true/false - povedlo se / nepovedlo se
 */
  private function ZpracujObrazek($tmp, $cislo, &$obrazek, $w_mini, $h_mini, $w_full, $h_full, $tmp2 = null)
  {
    settype($cislo, "integer");
    list($old_w, $old_h) = getimagesize($tmp["tmp_name"][$cislo]);
    $result = true;

    if (Empty($tmp2["tmp_name"][$cislo]))
    {
      //mini obr
      if ($w_mini != 0 && //pevna velikost
          $h_mini != 0)
      {
        if ($old_w <= $w_mini &&
            $old_h <= $h_mini)
        {
          $new_w = $old_w;  //zanechava
          $new_h = $old_h;
        }
          else
        {
          $new_w = $w_mini; //zmensuje
          $new_h = $h_mini;
        }
      }
        else
      if ($h_mini == 0) //auto dopocitavani vysky
      {
        if ($old_w <= $w_mini)
        {
          $new_w = $old_w;  //zanechava
          $new_h = $old_h;
        }
          else
        {
          $new_w = $w_mini; //zmensuje
          $new_h = round($old_h / ($old_w / $w_mini));
        }
      }
        else
      if ($w_mini == 0) //auto dopocitavani sirky
      {
        if ($old_w <= $h_mini)
        {
          $new_w = $old_w;  //zanechava
          $new_h = $old_h;
        }
          else
        {
          $new_w = round($old_w / ($old_h / $h_mini)); //zmensuje
          $new_h = $h_mini;
        }
      }
        else
      {
        $result = false;
      }
    }

    //full obr
    if ($w_full == 0 && //pevna velikost
        $h_full == 0)
    {
      $new_w_obr = $old_w;  //zanechava
      $new_h_obr = $old_h;
    }
      else
    if ($w_full != 0 && //pevna velikost
        $h_full != 0)
    {
      if ($old_w <= $w_full &&
          $old_h <= $h_full)
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = $w_full; //zmensuje
        $new_h_obr = $h_full;
      }
    }
      else
    if ($h_full == 0) //auto dopocitavani vysky
    {
      if ($old_w <= $w_full)
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = $w_full; //zmensuje
        $new_h_obr = round($old_h / ($old_w / $w_full));
      }
    }
      else
    if ($w_full == 0) //auto dopocitavani sirky
    {
      if ($old_w <= $h_full)
      {
        $new_w_obr = $old_w;  //zanechava
        $new_h_obr = $old_h;
      }
        else
      {
        $new_w_obr = round($old_w / ($old_h / $h_full)); //zmensuje
        $new_h_obr = $h_full;
      }
    }
      else
    {
      $result = false;
    }

    if (($this->ValueConfig(4) != 0 ? $tmp["size"][$cislo] < (1024 * 1024 * $this->ValueConfig(4)) : true) && //je-li nastaven limit omezuje jinak pousti
        $result)
    {
      $nazev = $this->VytvorJmenoObrazku();

      switch ($tmp["type"][$cislo])
      {
        case "image/jpeg":
          $pripona = "jpg";
          ini_set("memory_limit", "100M");  //nasosne si vic mega
          $img_old = imagecreatefromjpeg($tmp["tmp_name"][$cislo]);

          if (Empty($tmp2["tmp_name"][$cislo]))
          {
            $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
            imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}_{$cislo}.{$pripona}", 100);
            imagedestroy($img_new);
          }
            else
          { //nahradni mini
            if (!move_uploaded_file($tmp2["tmp_name"][$cislo], "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}_{$cislo}.{$pripona}"))
            {
              $result = false;
            }
          }

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);  //full
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$nazev}_{$cislo}.{$pripona}", 100);
          imagedestroy($img_new);
        break;

        case "image/png":
          $pripona = "png";
          ini_set("memory_limit", "100M");  //nasosne si vic mega
          $img_old = imagecreatefrompng($tmp["tmp_name"][$cislo]);

          if (Empty($tmp2["tmp_name"][$cislo]))
          {
            $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
            imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
            imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}_{$cislo}.{$pripona}");
            imagedestroy($img_new);
          }
            else
          { //nahradni mini
            if (!move_uploaded_file($tmp2["tmp_name"][$cislo], "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$nazev}_{$cislo}.{$pripona}"))
            {
              $result = false;
            }
          }

          $img_new = imagecreatetruecolor($new_w_obr, $new_h_obr);  //full
          imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w_obr, $new_h_obr, $old_w, $old_h);
          imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$nazev}_{$cislo}.{$pripona}");
          imagedestroy($img_new);
        break;

        default:
          $result = false;
        break;
      }

      $obrazek = "{$nazev}_{$cislo}.{$pripona}";
    }
      else
    {
      $result = false;
    }

    return $result;
  }

/**
 *
 * Vygenerovani nazvu pro obrazky
 *
 * @return vygenerovany vzorek nazvu
 */
  private function VytvorJmenoObrazku()
  {
    $result = date("d-m-Y-H-i-s");

    return $result;
  }

/**
 *
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SyncFileWithDB()
  {
    if ($res = $this->query("SELECT obsah FROM {$this->dbpredpona}obsah_sablony WHERE obsah LIKE ('%.jpg%') OR obsah LIKE('%.png%');", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $databaze = "";
        while ($data = $this->fetchObject($res))
        {
          $obsahpole = explode("|-x-|", $data->obsah);
          for ($i = 0; $i < count($obsahpole); $i++)
          {
            if (count(explode("||--x--||", $obsahpole[$i])) == 5)
            {
              $obr = explode("||--x--||", $obsahpole[$i]);
              $databaze[] = $obr[0];
            }
          }
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }


    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->minidir}";  //projiti miniatur
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
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}";  //projiti plnych velikosti
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
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$diff[$i]}");
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
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$diff[$i]}");
      }
    }

    $result = $pocet1 + $pocet2;

    return $result;
  }

/**
 *
 * Vypis obsahu sablony
 *
 * @param sablona cislo skupiny
 * @return vypis odkazu na upravu obsahu
 */
  private function AdminVypisObsahSablony($sablona)
  {
    settype($sablona, "integer");
    $nazev = $this->VypisSloupce($sablona, "nazev");
    $razeni = $this->AdminVypisRazeni($sablona);  //vrati smer razeni v adminu

    $doplnek = ($this->NactiUnikatniObsah($this->unikatni["set_admin_prepnani_unikatnich"]) ? "_{$sablona}" : "");  //rozlisi jestli vkladat _X nebo ""

    $result = "";
    if ($res = $this->query("SELECT id, obsah, pridano, nazev, rewrite
                            FROM {$this->dbpredpona}obsah_sablony
                            WHERE sablona={$sablona}
                            ORDER BY {$this->dbpredpona}obsah_sablony.pridano {$razeni};", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $rozdel = explode("|-x-|", $data->obsah);

          $vypis = array ("array_args",
                          $nazev,
                          $rozdel[0],
                          date($this->NactiUnikatniObsah($this->unikatni["set_admin_datum{$doplnek}"]), strtotime($data->pridano)),
                          $data->nazev,
                          $data->rewrite,
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=editobsah&amp;id={$data->id}",
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=delobsah&amp;id={$data->id}"
                          );

          for ($j = 0; $j < count($rozdel); $j++)
          {
            if (count(explode("||--x--||", $rozdel[$j])) == 5)
            {
              $obr = explode("||--x--||", $rozdel[$j]);
              $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->minidir}/{$obr[0]}";
              $vypis[] = "{$this->absolutni_url}{$this->dirpath}/{$this->pathpicture}/{$this->fulldir}/{$obr[0]}";
            }
              else
            {
              $vypis[] = htmlspecialchars_decode(html_entity_decode($rozdel[$j]));
            }
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah{$doplnek}"],
                                              $vypis);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Overuje existenci sablony
 *
 * @param nazev nazev sablony
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeSablona($adresa)
  {
    if (!Empty($adresa))
    {
      if ($res = $this->query("SELECT id FROM {$this->dbpredpona}sablona WHERE adresa='{$adresa}';", $error))
      {
        $result = ($this->numRows($res) == 1 ? true : false);
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }

    return $result;
  }

/**
 *
 * Select pro vyber sablony
 *
 * @param id nepovinne urcuje oznacene id polozky
 * @return vyber sablony
 */
  private function VyberSablony($id = NULL)
  {
    $result = "";
    if ($res = $this->query("SELECT id, adresa, nazev
                            FROM {$this->dbpredpona}sablona
                            ORDER BY id ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_begin"]);
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev,
                                              $data->adresa);
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_vyber_sablony_null"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vypisuje seznam typu
 *
 * @param id id polozky typu, nepovinne
 * @param adresa adresa pro navrat spravne stranky, nepovinne
 * @return html select
 */
  private function VyberTypu($id = NULL, $adresa = NULL)
  {
    $typ = array_keys($this->element);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_begin"], $adresa);
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i],
                                          $this->element[$typ[$i]]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati select pro vyber ze vstupu
 *
 * @param id id polozky vstupu, nepovinne
 * @param adresa adresa pro navrat spravne stranky, nepovinne
 * @return html select
 */
  private function VyberVstupu($id = NULL, $adresa = NULL)
  {
    $typ = $this->vstupni_typ;

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_begin"], $adresa);
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i]);
      ;
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati pocet elementu v dane sablone
 *
 * @param sablona cislo formulare
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($sablona, $inc = 0)
  {
    settype($sablona, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = $this->query("SELECT COUNT(id) pocet FROM {$this->dbpredpona}element WHERE sablona={$sablona};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $result = $this->fetchObject($res)->pocet + $inc;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati hodnotu daneho indexu
 *
 * @param cislo index pole pro navrat pozadovane hodnoty
 * @return cislo dle indexu
 */
  private function ValueConfig($cislo)
  {
    if (file_exists($this->conffile))
    {
      $u = fopen($this->conffile, "r");
      $data = explode("-", fread($u, filesize($this->conffile)));
      fclose($u);

      $result = $data[$cislo];
    }

    return $result;
  }

/**
 *
 * Nacte konfiguraci
 *
 * @param limit limit uploadu
 */
  private function LoadConfig(&$w_mini, &$h_mini, &$w_full, &$h_full, &$limit)
  {
    if (file_exists($this->conffile))
    {
      $u = fopen($this->conffile, "r");
      $data = fread($u, filesize($this->conffile));
      fclose($u);

      $data = explode("-", $data);
      $w_mini = $data[0];
      $h_mini = $data[1];
      $w_full = $data[2];
      $h_full = $data[3];
      $limit = $data[4];  //3
    }
      else
    {
      $u = fopen($this->conffile, "w");
      fwrite($u, "0-135-0-400-3");
      fclose($u);

      echo "soubor se vytvari, pro pokracovani refresujte a nebo zmente prava zapisu ve slozce";
    }
  }

/**
 *
 * Ulozi konfiguraci
 *
 * @return info o ulozeni
 */
  private function SaveConfig()
  {
    $w_mini = $_POST["w_mini"];
    settype($w_mini, "integer");

    $h_mini = $_POST["h_mini"];
    settype($h_mini, "integer");

    $w_full = $_POST["w_full"];
    settype($w_full, "integer");

    $h_full = $_POST["h_full"];
    settype($h_full, "integer");

    $limit = $_POST["limit"];
    settype($limit, "integer");

    $u = fopen($this->conffile, "w");
    fwrite($u, "{$w_mini}-{$h_mini}-{$w_full}-{$h_full}-{$limit}");
    fclose($u);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_config_save"]);

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
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=config",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv",
                                        ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_obsah_add_link"],
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addsab",
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem") : ""),
                                        $this->AdminVypisObsahu());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "test_rv":
          $vstup = $this->ChangeWrongChar($_POST["vstup"]);
          //prepinani podle webu/lokalu
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : $this->ChangeWrongChar($_POST["reg_exp"], false));

          $vysledek = "";
          if (!Empty($_POST["tlacitko"]) &&
              !Empty($vstup) &&
              !Empty($reg_exp))
          {
            if (@preg_match($reg_exp, $vstup, $ret) !== false)
            {
              $vysledek = (!Empty($ret[0]) ? $ret[0] : "NULL");  //vybere nulty index
            }
              else
            {
              $this->var->main[0]->ErrorMsg($reg_exp, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_test_rv"],
                                              $vstup,
                                              $reg_exp,
                                              $vysledek,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");
        break;

        case "config":  //kofigurace galerie
          $this->LoadConfig($w_mini, $h_mini, $w_full, $h_full, $limit);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_config"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              ($limit != 0 ? " checked=\"checked\"" : ""),
                                              $limit,
                                              ($limit == 0 ? " checked=\"checked\"" : ""),
                                              ($limit == 0 ? "lim_2();" : "lim_1();"),
                                              ($w_mini != 0 ? " checked=\"checked\"" : ""), //mini
                                              $w_mini,
                                              ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                              $h_mini,
                                              ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                              ($w_full != 0 ? " checked=\"checked\"" : ""), //full
                                              $w_full,
                                              ($h_full != 0 ? " checked=\"checked\"" : ""),
                                              $h_full,
                                              ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                              ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                              ($w_mini == 0 && $h_mini == 0 ? "mini_4();" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                              ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))));

          if (!Empty($_POST["tlacitko"]))
          {
            $result = $this->SaveConfig();

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "addsab": //pridavani sablony
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addsab"],
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $adresa = $this->ChangeWrongChar($_POST["adresa"]);
          $razeni = $this->ChangeWrongChar($_POST["razeni"]);
          $nove = $_POST["nove"];
          settype($nove, "integer");
          $nove_rss = $_POST["nove_rss"];
          settype($nove_rss, "integer");
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $rewrite = $this->ChangeWrongChar($_POST["rewrite"]);
          $popisek = $this->ChangeWrongChar($_POST["popisek"]);
          $href_id = $this->ChangeWrongChar($_POST["href_id"]);
          $href_class = $this->ChangeWrongChar($_POST["href_class"]);
          $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($nazev) &&
              //!$this->ExistujeSablona($adresa) &&
              $this->povolit_pridani)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}sablona (id, adresa, razeni, nove, nove_rss, nazev, rewrite, popisek, href_id, href_class, href_akce, zobrazit) VALUES
                                  (NULL, '{$adresa}', '{$razeni}', {$nove}, {$nove_rss}, '{$nazev}', '{$rewrite}', '{$popisek}', '{$href_id}', '{$href_class}', '{$href_akce}', {$zobrazit});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addsab_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editsab":  //uprava skupiny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT adresa, razeni, nove, nove_rss, nazev, rewrite, popisek, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}sablona WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editsab"],
                                                  $this->dirpath,
                                                  $data->adresa,
                                                  ($data->razeni == "ASC" ? " checked=\"checked\"" : ""),
                                                  ($data->razeni == "DESC" ? " checked=\"checked\"" : ""),
                                                  $data->nove,
                                                  $data->nove_rss,
                                                  $data->nazev,
                                                  $data->rewrite,
                                                  $data->popisek,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $adresa = $this->ChangeWrongChar($_POST["adresa"]);
              $razeni = $this->ChangeWrongChar($_POST["razeni"]);
              $nove = $_POST["nove"];
              settype($nove, "integer");
              $nove_rss = $_POST["nove_rss"];
              settype($nove_rss, "integer");
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $rewrite = $this->ChangeWrongChar($_POST["rewrite"]);
              $popisek = $this->ChangeWrongChar($_POST["popisek"]);
              $href_id = $this->ChangeWrongChar($_POST["href_id"]);
              $href_class = $this->ChangeWrongChar($_POST["href_class"]);
              $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}sablona SET adresa='{$adresa}',
                                                                            razeni='{$razeni}',
                                                                            nove={$nove},
                                                                            nove_rss={$nove_rss},
                                                                            nazev='{$nazev}',
                                                                            rewrite='{$rewrite}',
                                                                            popisek='{$popisek}',
                                                                            href_id='{$href_id}',
                                                                            href_class='{$href_class}',
                                                                            href_akce='{$href_akce}',
                                                                            zobrazit={$zobrazit}
                                                                            WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editsab_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "delsab": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}sablona WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}sablona WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}element WHERE sablona={$id};
                                    DELETE FROM {$this->dbpredpona}obsah_sablony WHERE sablona={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delsab_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "addelem": //pridavani elementu
          $sab = $_GET["sab"];
          settype($sab, "integer");
          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstup"];
          settype($vstup, "integer");

          $value = "";
          switch ($type)
          {
            case 0: //nadpis
            case 1: //popisek
            case 2: //text
            case 7: //checkbox
              $value = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_value"], "");
            break;

            case 3: //obrazek
              $w_mini = $this->ValueConfig(0);
              $h_mini = $this->ValueConfig(1);
              $w_full = $this->ValueConfig(2);
              $h_full = $this->ValueConfig(3);

              $value = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_value_pic"],
                                                $w_mini,
                                                $h_mini,
                                                $w_full,
                                                $h_full,
                                                ($w_mini != 0 ? " checked=\"checked\"" : ""), //mini
                                                ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                                ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                                ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                                ($w_full != 0 ? " checked=\"checked\"" : ""), //full
                                                ($h_full != 0 ? " checked=\"checked\"" : ""),
                                                ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                                ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                                ($w_mini == 0 && $h_mini == 0 ? "mini_4()" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                                ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))));
            break;

            case 8:
              $value = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_autodel_value"], "");
            break ;
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem"],
                                              $this->VyberSablony($sab),
                                              $this->VyberTypu($type, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$sab}&amp;vstup={$vstup}"),
                                              $value,
                                              ($type < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vstupni_typ"], $this->VyberVstupu($vstup, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$sab}&amp;typ={$type}")) : ""),
                                              ($type < 3 && $vstup == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_reg_exp"], "") : ($type == 8 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_autodel_reg_exp"], "") : "")),
                                              ($type >= 4 && $type <= 6 || $type == 8 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vystupni_format"], ($type == 4 ? "d.m.Y" : ($type == 5 ? "H:i:s" : "d.m.Y H:i:s"))) : ""),
                                              ($type < 3 && $vstup == 0 ?$this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_min_max_poc"], 0, 0) : ""),
                                              $this->PocetRadku($sab, 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $sablona = $_POST["sablona"];
          settype($sablona, "integer");
          $typ = $_POST["typ"];
          settype($typ, "integer");
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);

          if ($type == 3)
          {
            for ($i = 0; $i < 4; $i++)
            {
              $val[$i] = $_POST["value"][$i];
              settype($val[$i], "integer");
            }
          }

          $value = ($type == 3 ? $this->ChangeWrongChar(implode("|-|", $val)) : $this->ChangeWrongChar($_POST["value"]));
          $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
          $vstupni_typ = $_POST["vstupni_typ"];
          settype($vstupni_typ, "integer");
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? htmlspecialchars($_POST["reg_exp"], ENT_QUOTES) : $this->ChangeWrongChar($_POST["reg_exp"]));
          $vystupni_format = $this->ChangeWrongChar($_POST["vystupni_format"]);
          $min_poc = $_POST["min_poc"];
          settype($min_poc, "integer");
          $max_poc = $_POST["max_poc"];
          settype($max_poc, "integer");
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              $poradi > 0 &&
              $this->povolit_pridani)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}element (id, sablona, typ, nazev, value, povinne, vstupni_typ, reg_exp, vystupni_format, min_poc, max_poc, poradi) VALUES
                                  (NULL, {$sablona}, {$typ}, '{$nazev}', '{$value}', {$povinne}, {$vstupni_typ}, '{$reg_exp}', '{$vystupni_format}', {$min_poc}, {$max_poc}, {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editelem":  //uprava elementu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $sab = $_GET["sab"];
          settype($sab, "integer");
          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstup"];
          settype($vstup, "integer");

          if ($res = $this->query("SELECT sablona, typ, nazev, value, povinne, vstupni_typ, reg_exp, vystupni_format, min_poc, max_poc, poradi FROM {$this->dbpredpona}element WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $sab_1 = (!Empty($sab) ? $sab : $data->sablona);
              $type_1 = (isset($_GET["typ"]) ? $type : $data->typ);
              $vstup_1 = (isset($_GET["vstup"]) ? $vstup : $data->vstupni_typ);

              $value = "";
              switch ($type_1)
              {
                case 0: //nadpis
                case 1: //popisek
                case 2: //text
                case 7: //checkbox
                  $value = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_value"], $data->value);
                break;

                case 3: //obrazek
                  $rozdelit = explode("|-|", $data->value);
                  $w_mini = $rozdelit[0];
                  $h_mini = $rozdelit[1];
                  $w_full = $rozdelit[2];
                  $h_full = $rozdelit[3];

                  $value = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_value_pic"],
                                                    $w_mini,
                                                    $h_mini,
                                                    $w_full,
                                                    $h_full,
                                                    ($w_mini != 0 ? " checked=\"checked\"" : ""), //mini
                                                    ($h_mini != 0 ? " checked=\"checked\"" : ""),
                                                    ($w_mini != 0 && $h_mini != 0 ? " checked=\"checked\"" : ""),
                                                    ($w_mini == 0 && $h_mini == 0 ? " checked=\"checked\"" : ""),
                                                    ($w_full != 0 ? " checked=\"checked\"" : ""), //full
                                                    ($h_full != 0 ? " checked=\"checked\"" : ""),
                                                    ($w_full != 0 && $h_full != 0 ? " checked=\"checked\"" : ""),
                                                    ($w_full == 0 && $h_full == 0 ? " checked=\"checked\"" : ""),
                                                    ($w_mini == 0 && $h_mini == 0 ? "mini_4()" : ($w_mini != 0 && $h_mini != 0 ? "mini_3();" : ($h_mini != 0 ? "mini_2();" : ($w_mini != 0 ? "mini_1();" : "")))),
                                                    ($w_full == 0 && $h_full == 0 ? "full_4();" : ($w_full != 0 && $h_full != 0 ? "full_3();" : ($h_full != 0 ? "full_2();" : ($w_full != 0 ? "full_1();" : "")))));
                break;

                case 8:
                  $value = $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_autodel_value"], $data->value);
                break ;
              }

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem"],
                                                  $this->VyberSablony($sab_1),
                                                  $this->VyberTypu($type_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$id}&amp;sab={$sab_1}&amp;vstup={$vstup_1}"),
                                                  $data->nazev,
                                                  $value,
                                                  "",
                                                  "",
                                                  "",
                                                  ($data->povinne ? " checked=\"checked\"" : ""),
                                                  ($type_1 < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vstupni_typ"], $this->VyberVstupu($vstup_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$id}&amp;sab={$sab_1}&amp;typ={$type_1}")) : ""),
                                                  ($type_1 < 3 && $vstup_1 == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_reg_exp"], $data->reg_exp) : ($type_1 == 8 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_autodel_reg_exp"], $data->reg_exp) : "")),
                                                  ($type_1 >= 4 && $type_1 <= 6 || $type_1 == 8 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vystupni_format"], (Empty($type) ? $data->vystupni_format : ($type_1 == 4 ? "d.m.Y" : ($type_1 == 5 ? "H:i:s" : "d.m.Y H:i:s")))) : ""),
                                                  ($type_1 < 3 && $vstup_1 == 0 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_min_max_poc"], $data->min_poc, $data->max_poc) : ""),
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $sablona = $_POST["sablona"];
              settype($sablona, "integer");
              $typ = $_POST["typ"];
              settype($typ, "integer");
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);

              if ($type_1 == 3)
              {
                for ($i = 0; $i < 4; $i++)
                {
                  $val[$i] = $_POST["value"][$i];
                  settype($val[$i], "integer");
                }
              }

              $value = ($type_1 == 3 ? $this->ChangeWrongChar(implode("|-|", $val)) : $this->ChangeWrongChar($_POST["value"]));
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $vstupni_typ = $_POST["vstupni_typ"];
              settype($vstupni_typ, "integer");
              $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? htmlspecialchars($_POST["reg_exp"], ENT_QUOTES) : $this->ChangeWrongChar($_POST["reg_exp"]));
              $vystupni_format = $this->ChangeWrongChar($_POST["vystupni_format"]);
              $min_poc = $_POST["min_poc"];
              settype($min_poc, "integer");
              $max_poc = $_POST["max_poc"];
              settype($max_poc, "integer");
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $poradi > 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}element SET sablona={$sablona},
                                                                            typ={$typ},
                                                                            nazev='{$nazev}',
                                                                            value='{$value}',
                                                                            povinne={$povinne},
                                                                            vstupni_typ={$vstupni_typ},
                                                                            reg_exp='{$reg_exp}',
                                                                            vystupni_format='{$vystupni_format}',
                                                                            min_poc={$min_poc},
                                                                            max_poc={$max_poc},
                                                                            poradi={$poradi}
                                                                            WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
                }
                  else
                {
                  $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                }
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "delelem": //mazani podle id skupny
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          $id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}element WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}element WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delelem_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    $typelementu = array_keys($this->element);

    if ($res = $this->query("SELECT id, adresa, nazev, rewrite, popisek FROM {$this->dbpredpona}sablona ORDER BY id ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona"],
                                              $data->id,
                                              $data->adresa,
                                              $data->nazev,
                                              $data->rewrite,
                                              $data->popisek,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editsab&amp;id={$data->id}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona_adddel_link"],
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delsab&amp;id={$data->id}",
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$data->id}",
                                                                                                  $data->nazev) : "")
                                              );

          if ($res1 = $this->query("SELECT id, typ, nazev, value, povinne, vstupni_typ, vystupni_format, poradi FROM {$this->dbpredpona}element WHERE sablona={$data->id} ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_element"],
                                                    $data1->nazev,
                                                    (!Empty($data1->value) ? $data1->value : $this->NactiUnikatniObsah($this->unikatni["admin_vypis_empty_value"])),
                                                    $this->element[$typelementu[$data1->typ]],
                                                    ($data1->povinne ? " checked=\"checked\"" : ""),
                                                    $this->vstupni_typ[$data1->vstupni_typ],
                                                    (!Empty($data1->vystupni_format) ? $data1->vystupni_format : $this->NactiUnikatniObsah($this->unikatni["admin_vypis_empty_value"])),
                                                    $data1->poradi,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}",
                                                    ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_del_link"],
                                                                                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}",
                                                                                                        $data1->nazev) : ""));
              }
            }
              else
            {
              $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_element_null"]);
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_end"]);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }
}
?>
