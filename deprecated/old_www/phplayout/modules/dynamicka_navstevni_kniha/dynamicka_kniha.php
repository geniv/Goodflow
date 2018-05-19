<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicNavstevniKniha - hlavni konstruktor tridy\n
 * RychloVypis() - rychlo vypis polozek\n
 * DynamickeZobrazeni() - standartni vypis polozek\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicNavstevniKniha extends DefaultModule
{
  private $var, $dbname, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  private $admincaptchakod, $captchakod;
  public $idmodul = "dynkninav";  //id pro rozliseni modulu v adminu
  private $povolit_pridani = true; //true/false - povolit / zakazat, pridavani (i mazani) dalsich polozek
  private $vypis_chybu = false;

  private $hlavicka = "Content-type: text/html; charset=UTF-8";

  private $znacka_povinne = "*";

  private $rsslink = "rss";

                            //index => slovní popis
  private $element = array ("nadpis" =>  "Napis",
                            "popisek" => "Krátký popisek",
                            "text" =>    "Dlouhé texty",

                            "captcha" => "Captcha kod - 1x",

                            "datum" =>   "Datum",
                            "cas" =>     "Čas",
                            "datumcas" =>"Datum a čas",

                            "checkbox" => "Zaškrkávací políčko",
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

    $this->hlavicka = $this->NactiUnikatniObsah($this->unikatni["set_hlavicka"]);

    $this->znacka_povinne = $this->NactiUnikatniObsah($this->unikatni["set_znacka_povinne"]);
    $this->element = $this->NactiUnikatniObsah($this->unikatni["set_element"]);

    $this->povolit_pridani = $this->NactiUnikatniObsah($this->unikatni["set_povolit_pridani"]);
    $this->vypis_chybu = $this->NactiUnikatniObsah($this->unikatni["set_vypis_chybu"]);

    $this->dbpredpona = $this->NastavKomunikaci($this->var,
                                                $this->var->moduly[$index]["uloziste"],
                                                $this->var->moduly[$index]["class"],
                                                "{$this->dirpath}/{$this->dbname}");
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
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}sablona_kniha (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  adresa TEXT,
                                  razeni VARCHAR(50),
                                  nove_rss INTEGER UNSIGNED,
                                  nazev VARCHAR(200),
                                  popisek TEXT,
                                  href_id VARCHAR(200),
                                  href_class VARCHAR(200),
                                  href_akce VARCHAR(500),
                                  zobrazit BOOL);

                                  CREATE TABLE {$this->dbpredpona}obsah_sablony_kniha (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  sablona INTEGER UNSIGNED,
                                  obsah TEXT,
                                  pridano DATETIME,
                                  zobrazit BOOL,
                                  admin BOOL);

                                  CREATE TABLE {$this->dbpredpona}element_kniha (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  sablona INTEGER UNSIGNED,
                                  typ INTEGER UNSIGNED,
                                  nazev VARCHAR(200),
                                  value VARCHAR(200),
                                  povinne BOOL,
                                  skryt_obsah BOOL,
                                  vstupni_typ INTEGER UNSIGNED,
                                  reg_exp VARCHAR(500),
                                  vystupni_format VARCHAR(200),
                                  min_val INTEGER UNSIGNED,
                                  max_val INTEGER UNSIGNED,
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
    if ($res = $this->query("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}sablona_kniha ORDER BY LOWER(nazev);", $error))
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
 * Vrati obsah v poli
 *
 * pouziti: <strong>$pole = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "ArrayVystupObsahu"[, "adresa"]);</strong>
 *
 * @param adr adresa sablony
 * @return obsah v poli
 */
  public function ArrayVystupObsahu($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $razeni = $this->VypisRazeni($adresa);  //vrati smer razeni

    $sablona = $this->ZjistiSablonuAdresy($adresa);

    $result = "";
    if ($res = $this->query("SELECT
                            obsah, pridano, zobrazit, admin
                            FROM {$this->dbpredpona}obsah_sablony_kniha
                            WHERE
                            sablona={$sablona}
                            ORDER BY {$this->dbpredpona}obsah_sablony_kniha.pridano {$razeni};", $error))  //LIMIT 0,{$limit}
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $result["obsah"][] = $data->obsah;
          $result["pridano"][] = $data->pridano;
          $result["zobrazit"][] = $data->zobrazit;
          $result["admin"][] = $data->admin;
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
  private function VypisRazeni($adresa)
  {
    $result = "";
    if ($res = $this->query("SELECT razeni
                            FROM {$this->dbpredpona}sablona_kniha
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
 * Vrati cislo pro pocet zobrazeni novinek v rss
 *
 * @param adresa adresa sablony
 * @return cislo pro limit
 */
  private function VypisLimitRSS($adresa)
  {
    $result = 0;
    if ($res = $this->query("SELECT nove_rss
                            FROM {$this->dbpredpona}sablona_kniha
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
                            FROM {$this->dbpredpona}sablona_kniha
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
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "RSSLink"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return head link
 */
  public function RSSLink($tvar = 1)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_once_link_rss_{$tvar}"],
                                        ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}" : "?{$this->var->get_kam}={$this->rsslink}"));

    return $result;
  }

/**
 *
 * Generuje rss link do obsahu html
 *
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "RSSLinkWeb"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return html link
 */
  public function RSSLinkWeb($tvar = 1)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_once_link_rss_web_{$tvar}"],
                                        ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}" : "?{$this->var->get_kam}={$this->rsslink}"));

    return $result;
  }

/**
 *
 * Generuje rss, odchytava si danou url
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "RSSVystup"[, "adresa", 1]);</strong>
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
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $razeni = $this->VypisRazeni($adresa);  //vrati smer razeni
    $limit = $this->VypisLimitRSS($adresa);  //vrati pocet polozek v rychlo vypisu

    $sablona = $this->ZjistiSablonuAdresy($adresa);

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

      if ($res = $this->query("SELECT
                              obsah, pridano
                              FROM {$this->dbpredpona}obsah_sablony_kniha
                              WHERE
                              sablona={$sablona}
                              ORDER BY {$this->dbpredpona}obsah_sablony_kniha.pridano {$razeni}
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
                          date("D, d M Y H:i:s \G\M\T", strtotime($data->pridano)),
                          $i);

            for ($j = 0; $j < count($obsahpole); $j++)
            {
              if (count(explode("||--x--||", $obsahpole[$j])) == 2)
              {
                $zobr = explode("||--x--||", $obsahpole[$j]);

                if (strpos($zobr[1], "@") > 0)
                {
                  $email = $this->OsetreniTextu($zobr[1]);

                  $vypis[] = (!$zobr[0] ? $email : "");
                  //$this->NactiUnikatniObsah($this->unikatni["normal_visible_email_{$tvar}"], $email, $vypis[$this->NactiUnikatniObsah($this->unikatni["normal_num_jmeno_{$tvar}"])]) :
                  //                        $this->NactiUnikatniObsah($this->unikatni["normal_invsible_email_{$tvar}"], $email, $vypis[$this->NactiUnikatniObsah($this->unikatni["normal_num_jmeno_{$tvar}"])]));
                }
                  else
                {
                  $vypis[] = $this->OsetreniTextu(!$zobr[0] ? $zobr[1] : "");
                }
              }
                else
              {
                $vypis[] = $this->OsetreniTextu($obsahpole[$j]);
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
 * Osetri vstupni nazev, zde pro osetreni predmetu
 *
 * @param text vstupni text
 * @return bezpecny text
 */
  private function OsetreniTextu($text)
  {
    $prevod = $this->NactiUnikatniObsah($this->unikatni["set_prevod"],
                                        $this->absolutni_url);

    return strtr($text, $prevod);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Zjisti pocet radku v datazazi navstevni knihy
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "PocetRadkuNavstevniKniha"[, "adresa"]);</strong>
 *
 * @param adr adresa navstevn knihy
 * @return pocet radku v databazi
 */
  public function PocetRadkuNavstevniKniha($adr = NULL)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = $this->ChangeWrongChar($_SERVER["QUERY_STRING"]);
    }

    $sablona = $this->ZjistiSablonuAdresy($adresa);

    $result = 0;
    if ($res = $this->query("SELECT obsah, admin
                            FROM {$this->dbpredpona}obsah_sablony_kniha
                            WHERE zobrazit=1 AND
                            sablona={$sablona}
                            ORDER BY {$this->dbpredpona}obsah_sablony_kniha.pridano {$razeni};", $error))
    {
      $result = $this->numRows($res);
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
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicNavstevniKniha", "NavstevniKniha"[, "adresa", true, array("dalsi text a nebo funkce"), 1]);</strong>
 *
 * @param adr adresa sablony
 * @param kotrola zapina/vypina kontrolu uvozovek
 * @param pridavek pridava obsah pole do obsahu
 * @param strankovani vlozi nadefnovane pole ze strankovaciho modulu
 * @param tvar cislo tvaru
 * @return hlavni graficky vypis
 */
  public function NavstevniKniha($adr = NULL, $kontrola = true, $pridavek = NULL, $strankovani = NULL, $tvar = 1)
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

    $sablona = $this->ZjistiSablonuAdresy($adresa);

    $result = $this->VypisPridavaciFormular($sablona, $tvar); //vypise pridavaci formular

    $prvni = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_prvni_{$tvar}"]);
    $posledni = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_posledni_{$tvar}"]);
    $ente_def_array = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_def_array_{$tvar}"]);
    $ente_def = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_def_{$tvar}"]);
    $ente_od = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_od_{$tvar}"]);
    $ente_po = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_po_{$tvar}"]);
    $ente = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_ente_{$tvar}"]);

    $razeni = $this->VypisRazeni($adresa);  //vrati smer razeni

    if ($res = $this->query("SELECT obsah, admin
                            FROM {$this->dbpredpona}obsah_sablony_kniha
                            WHERE zobrazit=1 AND
                            sablona={$sablona}
                            ORDER BY {$this->dbpredpona}obsah_sablony_kniha.pridano {$razeni}
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
                        ($i == 0 ? $prvni : ""),
                        ($i == ($this->numRows($res) - 1) ? $posledni : ""),
                        (in_array($i, $ente_def_array) ? $ente_def : ""),
                        ((($i + $ente_od) % $ente_po) == 0 ? $ente : ""));

          for ($j = 0; $j < count($obsahpole); $j++)
          {
            if (count(explode("||--x--||", $obsahpole[$j])) == 2)
            {
              $zobr = explode("||--x--||", $obsahpole[$j]);

              if (strpos($zobr[1], "@") > 0)
              {
                $email = $this->OsetreniTextu($zobr[1]);

                $vypis[] = (!$zobr[0] ? $this->NactiUnikatniObsah($this->unikatni["normal_visible_email_{$tvar}"], $email, $vypis[$this->NactiUnikatniObsah($this->unikatni["normal_num_jmeno_{$tvar}"])]) :
                                        $this->NactiUnikatniObsah($this->unikatni["normal_invsible_email_{$tvar}"], $email, $vypis[$this->NactiUnikatniObsah($this->unikatni["normal_num_jmeno_{$tvar}"])]));
              }
                else
              {
                $vypis[] = $this->OsetreniTextu(!$zobr[0] ? $zobr[1] : "");
              }
            }
              else
            {
              $vypis[] = $this->OsetreniTextu(($kontrola ? htmlspecialchars_decode(html_entity_decode($obsahpole[$j])) : $obsahpole[$j]));
            }
          }

          $vypis[] = ($data->admin ? "_admin" : "");  //detekce admin prispevku

          //$dalsi[] = $this->absolutni_url;
          for ($j = 0; $j < count($pridavek); $j++)
          {
            $dalsi[] = $pridavek[$j]; //naplneni pole pro doplnkove %% parametry
          }

          if (!Empty($dalsi)) //pokud je pridavek pouzit
          {
            $vypis = array_merge($vypis, $dalsi); //slouceni pole
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_{$tvar}"],
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

    return $result;
  }

/**
 *
 * Zjisti cislo sablony podle adresy
 *
 * @param adresa adresa sablony
 * @return id sablony
 */
  private function ZjistiSablonuAdresy($adresa)
  {
    $result = 0;
    if ($res = $this->query("SELECT id
                            FROM {$this->dbpredpona}sablona_kniha
                            WHERE adresa='{$adresa}';", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $result = $this->fetchObject($res)->id;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    settype($result, "integer");

    return $result;
  }

/**
 *
 * Vypise pridavaci formular
 *
 * @param adresa adresa sablony
 * @return pridavaci formular
 */
  private function VypisPridavaciFormular($sablona, $tvar)
  {
    $typelementu = array_keys($this->element);

    if ($res = $this->query("SELECT id, sablona, typ, nazev, value,
                            povinne, skryt_obsah, vstupni_typ,
                            reg_exp, vystupni_format, min_val,
                            max_val, poradi
                            FROM {$this->dbpredpona}element_kniha
                            WHERE
                            sablona={$sablona}
                            ORDER BY poradi ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $i = 0;
        $pocetelem = $this->numRows($res);

        $vypis = array("array_args",
                      $this->absolutni_url,
                      $this->dirpath,
                      $sablona);

        while($data = $this->fetchObject($res))
        {
          $povinne = ($data->povinne ? $this->znacka_povinne : "");

          $podminka[$i]["id"] = $data->id;
          $podminka[$i]["name"] = "elem_{$data->id}"; //name elementu
          $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
          $podminka[$i]["blok"] = $data->value; //jmeno elementu
          $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
          $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
          $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
          $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
          $podminka[$i]["min"] = $data->min_val;  //minimalni pocet
          $podminka[$i]["max"] = $data->max_val;  //maximalni pocet
          $podminka[$i]["chyba"] = "";
          $podminka[$i]["chyba_form"] = "";

          switch ($typelementu[$data->typ])
          {
            case "nadpis": //nadpis
            case "text": //text
              $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], $data->id, $_POST["elem_{$data->id}"]);
              $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

              $vypis[] = $data->id;
              $vypis[] = " name=\"elem_{$data->id}\"";
              $vypis[] = $value;
              $vypis[] = " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = ($data->povinne ? $this->znacka_povinne : "");
            break;

            case "popisek": //popisek
              $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], $data->id, $_POST["elem_{$data->id}"]);
              $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

              $vypis[] = $data->id;
              $vypis[] = " name=\"elem_{$data->id}\"";
              $vypis[] = $value;
              $vypis[] = " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = ($data->skryt_obsah ? " name=\"skryt_elem_{$data->id}\"" : "");
              $vypis[] = ($data->povinne ? $this->znacka_povinne : "");
            break;

            case "captcha": //captcha kod
              if (!$this->var->aktivniadmin)
              {
                $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $data->value); //pro id 1
                $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $data->value, $slovo);  //pro id 1 se slovem

                $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                $this->captchakod[$sablona]["id"] = $data->value;
                $this->captchakod[$sablona]["captcha"] = $captcha;
                $this->captchakod[$sablona]["slovo"] = $slovo;
              }

              $vypis[] = $data->id;
              $vypis[] = " name=\"elem_{$data->id}\"";
              $vypis[] = $data->value;
              $vypis[] = $captcha;
              $vypis[] = $slovo;
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = ($data->povinne ? $this->znacka_povinne : "");
            break;

            case "datum": //datum
            case "cas": //cas
            case "datumcas": //datumcas
              $vypis[] = $data->id;
              $vypis[] = " name=\"elem_{$data->id}\"";
              $vypis[] = date($data->vystupni_format);
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = ($data->povinne ? $this->znacka_povinne : "");
            break;

            case "checkbox": //checkbox
              $val = htmlspecialchars_decode(html_entity_decode($data->value));

              $vypis[] = $data->id;
              $vypis[] = " name=\"elem_{$data->id}\"";
              $vypis[] = $val;
              $vypis[] = (!Empty($data->value) ? " value=\"{$val}\"" : "");
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = "";
              $vypis[] = ($data->povinne ? $this->znacka_povinne : "");
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

    $vypis[] = " name=\"tlacitko_kniha\"";
    $vypis[] = (!Empty($_POST["tlacitko_kniha"]) ? " disabled=\"disabled\"" : "");
    $vypis[] = (!Empty($_POST["tlacitko_kniha"]) ? "_disabled" : "");

    $result = $this->NactiUnikatniObsah($this->unikatni["normal_addobsah_form_{$tvar}"],
                                        $vypis);

    $poc = 0;
    $check = true;
    for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
    {
      //$zpost = $_POST[$podminka[$i]["name"]];
      $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

      //jmeno pro error hlasku
      $error_nazev = ($podminka[$i]["nazev"][strlen($podminka[$i]["nazev"]) - 1] == ":" ? substr($podminka[$i]["nazev"], 0, -1) : $podminka[$i]["nazev"]);

      switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
      {
        case "nadpis":
        case "popisek":
        case "text":
          switch ($podminka[$i]["vstup"])
          {
            case "text":  //konvert textu
              settype($zpost, "string");

              if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
              {
                $zpost = "";
                $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev) : "");
              }
                else
              if ($podminka[$i]["min"] > 0 &&
                  $podminka[$i]["max"] > 0)
              {
                if (strlen($zpost) < $podminka[$i]["min"] ||
                    strlen($zpost) > $podminka[$i]["max"])
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $error_nazev);
                }
              }
                else
              if ($podminka[$i]["min"] > 0)  //kontrola minina
              {
                if (strlen($zpost) < $podminka[$i]["min"])
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $error_nazev);
                }
              }
                else
              if ($podminka[$i]["max"] > 0)  //kontrola maxima
              {
                if (strlen($zpost) > $podminka[$i]["max"])
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $error_nazev);
                }
              }
            break;

            case "integer": //konvert cisla
              settype($zpost, "integer");

              if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
              {
                $zpost = "";
                $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev) : "");
              }
                else
              if ($podminka[$i]["min"] > 0 &&
                  $podminka[$i]["max"] > 0)
              {
                if ($zpost < $podminka[$i]["min"] ||  //kontrola hodnoty cisel
                    $zpost > $podminka[$i]["max"])
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $error_nazev);
                }
              }
                else
              if ($podminka[$i]["min"] > 0)  //kontrola minina
              {
                if ($zpost < $podminka[$i]["min"])
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $error_nazev);
                }
              }
                else
              if ($podminka[$i]["max"] > 0)  //kontrola maxima
              {
                if ($zpost > $podminka[$i]["max"])
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $error_nazev);
                }
              }
            break;

            case "reg_exp": //konrola reg_exp
              if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
              {
                $zpost = "";
                $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev) : "");
                break;
              }
                else
              {
                preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                $zpost = $ret[0];  //vybere nulty index

                if (Empty($zpost))
                {
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_reg_exp_{$tvar}"], $error_nazev);
                }
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

        case "captcha": //kontrola $_POST
          $pridavek = (is_array($_SESSION["slovo_{$this->captchakod[$sablona]["id"]}"]) ? "_solve" : "");

          if (count($_POST) == 0 || $zpost != $_SESSION["slovo_{$this->captchakod[$sablona]["id"]}{$pridavek}_vysledek"])
          {
            $_SESSION["slovo_{$this->captchakod[$sablona]["id"]}{$pridavek}_vysledek"] = $_SESSION["slovo_{$this->captchakod[$sablona]["id"]}{$pridavek}"];
          }

          if (Empty($zpost) && $podminka[$i]["povinne"])
          {
            $check = false;
            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_captcha_{$tvar}"]);  //prazdna
          }
            else
          {
            if ($zpost == $_SESSION["slovo_{$this->captchakod[$sablona]["id"]}{$pridavek}_vysledek"])  //turinguv stroj rozliseni cloveka
            {
              $poc++;
            }
              else
            {
              $check = false;
              $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_wrong_captcha_{$tvar}"]);  //spatne
            }
          }
        break;

        default:  //kontrola $_POST
          if (Empty($zpost) && $podminka[$i]["povinne"])
          {
            $check = false;
            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_unknown_{$tvar}"], $podminka[$i]["name"]);
          }
            else
          {
            $poc++;
          }
        break;
      }
    }

    if (!Empty($_POST["tlacitko_kniha"]) &&
        isset($_POST[$podminka[0]["name"]]) &&
        !$this->var->aktivniadmin &&
        $poc == $pocetelem &&
        $check)
    {
      $ukladani[] = "";
      for ($i = 0; $i < $pocetelem; $i++)
      {
        switch ($podminka[$i]["typ"])
        {
          case "popisek":
            $ukl = array((!Empty($_POST["skryt_{$podminka[$i]["name"]}"]) ? 1 : 0),
                          $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]));

            $ukladani[$i] = implode("||--x--||", $ukl);
          break;

          case "captcha":
            $ukladani[$i] = $this->captchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
          break;

          default:  //rozdeleni hodnot
            $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
          break;
        }
      }

      $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
      $datum = date("Y-m-d H:i:s");

      if ($this->queryExec("INSERT INTO {$this->dbpredpona}obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit, admin) VALUES
                            (NULL, {$sablona}, '{$ulozit}', '{$datum}', 1, 0);", $error))
      {
        $rozdel = explode("|-x-|", $ulozit);

        $vypis = array("array_args",
                      $this->absolutni_url,
                      "{$this->absolutni_url}{$_GET[$this->var->get_kam]}");

        for ($j = 0; $j < count($rozdel); $j++)
        {
          if (count(explode("||--x--||", $rozdel[$j])) == 2)
          {
            $zobr = explode("||--x--||", $rozdel[$j]);

            $vypis[] = $zobr[1];
          }
            else
          {
            $vypis[] = ($kontrola ? htmlspecialchars_decode(html_entity_decode($rozdel[$j])) : $rozdel[$j]);
          }
        }

        $dokonceno = $this->NactiUnikatniObsah($this->unikatni["normal_addobsah_form_hlaska_{$tvar}"],
                                              $vypis);

        //povolovani posilani reportu
        if ( $this->NactiUnikatniObsah($this->unikatni["normal_report_email_enabled_{$tvar}"]))
        {
          //report na zadanee emaily
          $email = implode(", ", $this->NactiUnikatniObsah($this->unikatni["normal_report_email_emaily_{$tvar}"]));

          $agent = $_SERVER["HTTP_USER_AGENT"];
          $ip = $_SERVER["REMOTE_ADDR"];
          $obsahmessage = array("array_args",
                                $this->absolutni_url,
                                $ip,
                                (!in_array($ip, $this->var->ipblok) ? gethostbyaddr($ip) : $ip),
                                $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $agent),
                                $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $agent),
                                $datum);

          $obsahmessage = array_merge($obsahmessage, $ukladani);  //slouceni obsahu s ukadacima informacema

          $subject = $this->NactiUnikatniObsah($this->unikatni["normal_report_email_subject_{$tvar}"], $this->absolutni_url);
          $message = $this->NactiUnikatniObsah($this->unikatni["normal_report_email_message_{$tvar}"],
                                              $obsahmessage);

          $header = $this->NactiUnikatniObsah($this->unikatni["normal_report_email_header_{$tvar}"],  //hlavička
                                              $this->hlavicka);

          if (!mail($email, $subject, $message, $header))
          {
            $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_report_email_send_error_{$tvar}"]), array(__LINE__, __METHOD__));
          }
        }

        if ($this->NactiUnikatniObsah($this->unikatni["set_show_form_{$tvar}"]))  //styl hlasky
        {
          $result .= $dokonceno;  //prida na konec
        }
          else
        {
          $result = $dokonceno; //nahradi misto formulare
        }

        if ($this->NactiUnikatniObsah($this->unikatni["set_autoklik_{$tvar}"]))
        {
          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["set_time_autoklik_{$tvar}"]), "{$this->absolutni_url}{$_GET[$this->var->get_kam]}");  //auto kliknuti
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
      else
    {
      if (count($_POST) > 0 &&
          !Empty($_POST["tlacitko_kniha"]))
      {
        $chyba = "";
        $chyba_form = "";
        for ($i = 0; $i < $pocetelem; $i++)
        {
          $chyba .= $podminka[$i]["chyba"];
          $chyba_form .= $podminka[$i]["chyba_form"];
        }

        if (Empty($_POST["error_tlacitko"]))
        {
          $error_button = $this->NactiUnikatniObsah($this->unikatni["normal_error_button_{$tvar}"]);
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["normal_error_end_{$tvar}"],
                                            $chyba,
                                            $chyba_form,
                                            $error_button,
                                            "{$this->absolutni_url}{$_GET[$this->var->get_kam]}");

        //$this->var->main[0]->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
      }
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

    $co = $_GET["co"];

    $doplnek = ($this->NactiUnikatniObsah($this->unikatni["set_admin_prepnani_unikatnich"]) ? "_{$sablona}" : "");  //rozlisi jestli vkladat _X nebo ""

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addobsah":  //pridavani obsahu
          if ($res = $this->query("SELECT id, sablona, typ, nazev, value,
                                  povinne, skryt_obsah, vstupni_typ,
                                  reg_exp, vystupni_format, min_val,
                                  max_val, poradi
                                  FROM {$this->dbpredpona}element_kniha
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
                $podminka[$i]["name"] = "elem_{$data->id}"; //name elementu
                $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
                $podminka[$i]["blok"] = $data->value; //jmeno elementu
                $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
                $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
                $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
                $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
                $podminka[$i]["min"] = $data->min_val;  //minimalni pocet
                $podminka[$i]["max"] = $data->max_val;  //maximalni pocet
                $podminka[$i]["chyba"] = "";
                $podminka[$i]["chyba_form"] = "";

                switch ($typelementu[$data->typ])
                {
                  case "nadpis": //nadpis
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->id, $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_nadpis{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "popisek": //popisek
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->id, $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem,
                                                          ($data->skryt_obsah ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_skryt_obsah"],
                                                                                                          $data->id,
                                                                                                          "") : ""),
                                                          $sablona);
                  break;

                  case "text": //text
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->id, $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "captcha": //captcha kod
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    if ($this->var->aktivniadmin)
                    {
                      $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $data->value); //pro id 1
                      $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $data->value, $slovo);  //pro id 1 se slovem

                      $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                      $this->admincaptchakod[$sablona]["id"] = $data->value;
                      $this->admincaptchakod[$sablona]["captcha"] = $captcha;
                      $this->admincaptchakod[$sablona]["slovo"] = $slovo;
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_captcha{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $slovo,
                                                          $captcha,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "datum": //datum
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum{$doplnek}"],
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
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas{$doplnek}"],
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

                  case "checkbox": //checkbox
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $val = htmlspecialchars_decode(html_entity_decode($data->value));
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_checkbox{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          (!Empty($data->value) ? " value=\"{$val}\"" : ""),
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          "",
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
                                              (!Empty($_POST["tlacitko"]) ? "_disabled" : ""));

          $poc = 0;
          $check = true;
          for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
          {
            //$zpost = $_POST[$podminka[$i]["name"]];
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

                    if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]) : "");
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

                    if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]) : "");
                    }
                      else
                    if ($podminka[$i]["min"] > 0 &&
                        $podminka[$i]["max"] > 0)
                    {
                      if ($zpost < $podminka[$i]["min"] ||  //kontrola hodnoty cisel
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
                    if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]) : "");
                      break;
                    }
                      else
                    {
                      preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                      $zpost = $ret[0];  //vybere nulty index

                      if (Empty($zpost))
                      {
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_reg_exp"], $podminka[$i]["nazev"]);
                      }
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

              case "captcha": //kontrola $_POST
                $pridavek = (is_array($_SESSION["slovo_{$this->admincaptchakod[$sablona]["id"]}"]) ? "_solve" : "");

                if (count($_POST) == 0 || $zpost != $_SESSION["admin_slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}_vysledek"])
                {
                  $_SESSION["admin_slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}_vysledek"] = $_SESSION["slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}"];
                }

                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty_captcha"]);  //prazdna
                }
                  else
                {
                  if ($zpost == $_SESSION["admin_slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}_vysledek"])  //turinguv stroj rozliseni cloveka
                  {
                    $poc++;
                  }
                    else
                  {
                    $check = false;
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_wrong_captcha"]);  //spatne
                  }
                }
              break;

              default:  //kontrola $_POST
                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_unknown"], $podminka[$i]["name"]);
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
                case "popisek":
                  $ukl = array((!Empty($_POST["skryt_{$podminka[$i]["name"]}"]) ? 1 : 0),
                                $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]));

                  $ukladani[$i] = implode("||--x--||", $ukl);
                break;

                case "captcha":
                  $ukladani[$i] = $this->admincaptchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
                break;

                default:  //rozdeleni hodnot
                  $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
                break;
              }
            }

            $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
            $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
            $datum = date("Y-m-d H:i:s");

            if ($this->queryExec("INSERT INTO {$this->dbpredpona}obsah_sablony_kniha (id, sablona, obsah, pridano, zobrazit, admin) VALUES
                                  (NULL, {$sablona}, '{$ulozit}', '{$datum}', {$zobrazit}, 1);", $error))
            {
              $obsahpole = explode("|-x-|", $ulozit);
              $nula = (count(explode("||--x--||", $obsahpole[0])) == 2 ? explode("||--x--||", $obsahpole[0]) : array(0, $obsahpole[0]));
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addobsah_hlaska"], $nula[1]);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
          }
            else
          {
            if (count($_POST) > 0)
            {
              $chyba = "";
              $chyba_form = "";
              for ($i = 0; $i < $pocetelem; $i++)
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
                                                  "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");

              //$this->var->main[0]->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
            }
          }
        break;



        case "editobsah": //uprava obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT sablona, obsah, pridano, zobrazit FROM {$this->dbpredpona}obsah_sablony_kniha WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);
              $obsah = $data->obsah;
              $zobrazit = $data->zobrazit;
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $nacist = explode("|-x-|", $obsah); //znovu rozdeleni

          if ($res = $this->query("SELECT id, sablona, typ, nazev, value,
                                  povinne, skryt_obsah, vstupni_typ,
                                  reg_exp, vystupni_format, min_val,
                                  max_val, poradi
                                  FROM {$this->dbpredpona}element_kniha
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
                $podminka[$i]["name"] = "elem_{$data->id}"; //name elementu
                $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
                $podminka[$i]["blok"] = $data->value; //jmeno elementu
                $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
                $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
                $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
                $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
                $podminka[$i]["min"] = $data->min_val;  //minimalni pocet
                $podminka[$i]["max"] = $data->max_val;  //maximalni pocet
                $podminka[$i]["chyba"] = "";
                $podminka[$i]["chyba_form"] = "";

                switch ($typelementu[$data->typ])
                {
                  case "nadpis": //nadpis
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->id, $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_nadpis{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "popisek": //popisek
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->id, $_POST["elem_{$data->id}"]);
                    $value = explode("||--x--||", $nacist[$i]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value[1],
                                                          "",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem,
                                                          ($data->skryt_obsah ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_skryt_obsah"],
                                                                                                          $data->id,
                                                                                                          ($value[0] ? " checked=\"checked\"" : "")) : ""),
                                                          $sablona);
                  break;

                  case "text": //text
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->id, $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "captcha": //captcha kod
                    $poradielem += $this->pocitadloporadi[$data->typ];

                    if ($this->var->aktivniadmin)
                    {
                      $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $nacist[$i]); //pro id 1
                      $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $nacist[$i], $slovo);  //pro id 1 se slovem

                      $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                      $this->admincaptchakod[$sablona]["id"] = $nacist[$i];
                      $this->admincaptchakod[$sablona]["captcha"] = $captcha;
                      $this->admincaptchakod[$sablona]["slovo"] = $slovo;
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_captcha{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $slovo,
                                                          $captcha,
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          $poradielem);
                  break;

                  case "datum": //datum
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum{$doplnek}"],
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
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas{$doplnek}"],
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

                  case "checkbox": //checkbox
                    $poradielem += $this->pocitadloporadi[$data->typ];
                    $val = htmlspecialchars_decode(html_entity_decode($nacist[$i]));
                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_checkbox{$doplnek}"],
                                                          $data->nazev,
                                                          $data->id,
                                                          (!Empty($nacist[$i]) ? " value=\"{$val}\"" : ""),
                                                          "",
                                                          "",
                                                          "",
                                                          $povinne,
                                                          (!Empty($nacist[$i]) ? " checked=\"checked\"" : ""),
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
                                              ($zobrazit ? " checked=\"checked\"" : ""),
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}",
                                              " name=\"tlacitko\"",
                                              (!Empty($_POST["tlacitko"]) ? " disabled=\"disabled\"" : ""),
                                              (!Empty($_POST["tlacitko"]) ? "_disabled" : ""));

          $poc = 0;
          $check = true;
          for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
          {
            //$zpost = $_POST[$podminka[$i]["name"]];
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

                    if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]) : "");
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

                    if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]) : "");
                    }
                      else
                    if ($podminka[$i]["min"] > 0 &&
                        $podminka[$i]["max"] > 0)
                    {
                      if ($zpost < $podminka[$i]["min"] ||  //kontrola hodnoty cisel
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
                    if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], $podminka[$i]["nazev"]) : "");
                      break;
                    }
                      else
                    {
                      preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                      $zpost = $ret[0];  //vybere nulty index

                      if (Empty($zpost))
                      {
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_reg_exp"], $podminka[$i]["nazev"]);
                      }
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

              case "captcha": //kontrola $_POST
                $pridavek = (is_array($_SESSION["slovo_{$this->admincaptchakod[$sablona]["id"]}"]) ? "_solve" : "");

                if (count($_POST) == 0 || $zpost != $_SESSION["admin_slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}_vysledek"])
                {
                  $_SESSION["admin_slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}_vysledek"] = $_SESSION["slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}"];
                }

                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty_captcha"]);  //prazdna
                }
                  else
                {
                  if ($zpost == $_SESSION["admin_slovo_{$this->admincaptchakod[$sablona]["id"]}{$pridavek}_vysledek"])  //turinguv stroj rozliseni cloveka
                  {
                    $poc++;
                  }
                    else
                  {
                    $check = false;
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_wrong_captcha"]);  //spatne
                  }
                }
              break;

              default:  //kontrola $_POST
                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_unknown"], $podminka[$i]["name"]);
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
                case "popisek":
                  $ukl = array((!Empty($_POST["skryt_{$podminka[$i]["name"]}"]) ? 1 : 0),
                                $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]));

                  $ukladani[$i] = implode("||--x--||", $ukl);
                break;

                case "captcha":
                  $ukladani[$i] = $this->admincaptchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
                break;

                default:  //rozdeleni hodnot
                  $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
                break;
              }
            }

            $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
            $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

            if ($this->queryExec("UPDATE {$this->dbpredpona}obsah_sablony_kniha SET sablona={$sablona},
                                                                                    obsah='{$ulozit}',
                                                                                    zobrazit={$zobrazit}
                                                                                    WHERE id={$id};", $error))
            {
              $obsahpole = explode("|-x-|", $ulozit);
              $nula = (count(explode("||--x--||", $obsahpole[0])) == 2 ? explode("||--x--||", $obsahpole[0]) : array(0, $obsahpole[0]));
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editobsah_hlaska"], $nula[1]);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
          }
            else
          {
            if (count($_POST) > 0)
            {
              $chyba = "";
              $chyba_form = "";
              for ($i = 0; $i < $pocetelem; $i++)
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
                                                  "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");

              //$this->var->main[0]->AutoClick(5, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
            }
          }
        break;

        case "delobsah": //mazani podle id obsahu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT obsah FROM {$this->dbpredpona}obsah_sablony_kniha WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}obsah_sablony_kniha WHERE id={$id};", $error)) //provedeni dotazu
              {
                $obsahpole = explode("|-x-|", $data->obsah);
                $nula = (count(explode("||--x--||", $obsahpole[0])) == 2 ? explode("||--x--||", $obsahpole[0]) : array(0, $obsahpole[0]));
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delobsah_hlaska"], $nula[1]);
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}__{$sablona}");  //auto kliknuti
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
 * Vypis obsahu sablony
 *
 * @param sablona cislo skupiny
 * @return vypis odkazu na upravu obsahu
 */
  private function AdminVypisObsahSablony($sablona)
  {
    settype($sablona, "integer");

    $doplnek = ($this->NactiUnikatniObsah($this->unikatni["set_admin_prepnani_unikatnich"]) ? "_{$sablona}" : "");  //rozlisi jestli vkladat _X nebo ""

    $result = "";
    if ($res = $this->query("SELECT id, sablona, obsah, pridano, zobrazit, admin
                            FROM {$this->dbpredpona}obsah_sablony_kniha
                            WHERE sablona={$sablona}
                            ORDER BY {$this->dbpredpona}obsah_sablony_kniha.pridano DESC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $obsahpole = explode("|-x-|", $data->obsah);
          $nula = (count(explode("||--x--||", $obsahpole[0])) == 2 ? explode("||--x--||", $obsahpole[0]) : array(0, $obsahpole[0]));

          $vypis = array ("array_args",
                          $data->obsah,
                          $nula[1],
                          date($this->NactiUnikatniObsah($this->unikatni["set_admin_datum{$doplnek}"]), strtotime($data->pridano)),
                          ($data->zobrazit ? " checked=\"checked\"" : ""),
                          ($data->admin ? " checked=\"checked\"" : ""),
                          ($data->admin ? "_admin" : ""),
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=editobsah&amp;id={$data->id}",
                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}__{$sablona}&amp;co=delobsah&amp;id={$data->id}"
                          );

          for ($j = 0; $j < count($obsahpole); $j++)
          {
            if (count(explode("||--x--||", $obsahpole[$j])) == 2) //detekce popisku
            {
              $zobr = explode("||--x--||", $obsahpole[$j]);

              $vypis[] = ($zobr[0] ? " checked=\"checked\"" : "");
              $vypis[] = $zobr[1];  //zamerne se neprevadi
            }
              else
            {
              $vypis[] = $this->OsetreniTextu(htmlspecialchars_decode(html_entity_decode($obsahpole[$j])));
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
      if ($res = $this->query("SELECT id FROM {$this->dbpredpona}sablona_kniha WHERE adresa='{$adresa}';", $error))
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
                            FROM {$this->dbpredpona}sablona_kniha;", $error))
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
    if ($res = $this->query("SELECT COUNT(id) pocet FROM {$this->dbpredpona}element_kniha WHERE sablona={$sablona};", $error))
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
 * Vygenerovani ajax scriptu pro web
 *
 */
  private function VygenerujAjaxScript()
  {
    $cesta = "{$this->dirpath}/ajax.js";
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath);
      $u = fopen($cesta, "w");
      fwrite($u, $obsah);
      fclose($u);

      var_dump("vytvořeno: {$cesta}");
    }
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
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv",
                                        ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_obsah_add_link"],
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addsab",
                                                                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem") : ""),
                                        $this->AdminVypisObsahu());

    $this->VygenerujAjaxScript(); //vygenerovani scriptu

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

        case "addsab": //pridavani sablony
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addsab"],
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $adresa = $this->ChangeWrongChar($_POST["adresa"]);
          $razeni = $this->ChangeWrongChar($_POST["razeni"]);
          $nove_rss = $_POST["nove_rss"];
          settype($nove_rss, "integer");
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $popisek = $this->ChangeWrongChar($_POST["popisek"]);
          $href_id = $this->ChangeWrongChar($_POST["href_id"]);
          $href_class = $this->ChangeWrongChar($_POST["href_class"]);
          $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($nazev) &&
              !$this->ExistujeSablona($adresa) &&
              $this->povolit_pridani)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}sablona_kniha (id, adresa, razeni, nove_rss, nazev, popisek, href_id, href_class, href_akce, zobrazit) VALUES
                                  (NULL, '{$adresa}', '{$razeni}', {$nove_rss}, '{$nazev}', '{$popisek}', '{$href_id}', '{$href_class}', '{$href_akce}', {$zobrazit});", $error))
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

          if ($res = $this->query("SELECT adresa, razeni, nove_rss, nazev, popisek, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}sablona_kniha WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editsab"],
                                                  $data->adresa,
                                                  ($data->razeni == "ASC" ? " checked=\"checked\"" : ""),
                                                  ($data->razeni == "DESC" ? " checked=\"checked\"" : ""),
                                                  $data->nove_rss,
                                                  $data->nazev,
                                                  $data->popisek,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $adresa = $this->ChangeWrongChar($_POST["adresa"]);
              $razeni = $this->ChangeWrongChar($_POST["razeni"]);
              $nove_rss = $_POST["nove_rss"];
              settype($nove_rss, "integer");
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
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
                if ($this->queryExec("UPDATE {$this->dbpredpona}sablona_kniha SET adresa='{$adresa}',
                                                                                  razeni='{$razeni}',
                                                                                  nove_rss={$nove_rss},
                                                                                  nazev='{$nazev}',
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

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}sablona_kniha WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}sablona_kniha WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}element_kniha WHERE sablona={$id};
                                    DELETE FROM {$this->dbpredpona}obsah_sablony_kniha WHERE sablona={$id};", $error)) //provedeni dotazu
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

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem"],
                                              $this->VyberSablony($sab),
                                              $this->VyberTypu($type, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$sab}&amp;vstup={$vstup}"),
                                              ($type < 3 || $type >= 7 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_value"], "") :
                                                                        ($type == 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_captcha"], "") : "")), //($type == 4 ? date("d.m.Y") : ($type == 5 ? date("H:i:s") : ($type == 6 ? date("d.m.Y H:i:s") : "")))
                                              ($type == 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_skryt_obsah"], "") : ""),
                                              ($type < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vstupni_typ"], $this->VyberVstupu($vstup, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$sab}&amp;typ={$type}")) : ""),
                                              ($type < 3 && $vstup == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_reg_exp"], "") : ""),
                                              ($type >= 4 && $type <= 6 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vystupni_format"], ($type == 4 ? "d.m.Y" : ($type == 5 ? "H:i:s" : "d.m.Y H:i:s"))) : ""),
                                              ($type < 3 && $vstup >= 0 && $vstup <= 1 ?$this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_min_max_poc"], 0, 0) : ""),
                                              $this->PocetRadku($sab, 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $sablona = $_POST["sablona"];
          settype($sablona, "integer");
          $typ = $_POST["typ"];
          settype($typ, "integer");
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $value = $this->ChangeWrongChar($_POST["value"]);
          $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
          $skryt_obsah = (!Empty($_POST["skryt_obsah"]) ? 1 : 0);
          $vstupni_typ = $_POST["vstupni_typ"];
          settype($vstupni_typ, "integer");
          $reg_exp = $this->ChangeWrongChar($_POST["reg_exp"]);
          $vystupni_format = $this->ChangeWrongChar($_POST["vystupni_format"]);
          $min_val = $_POST["min_val"];
          settype($min_val, "integer");
          $max_val = $_POST["max_val"];
          settype($max_val, "integer");
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              $poradi > 0 &&
              $this->povolit_pridani)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}element_kniha (id, sablona, typ, nazev, value, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi) VALUES
                                  (NULL, {$sablona}, {$typ}, '{$nazev}', '{$value}', {$povinne}, {$skryt_obsah}, {$vstupni_typ}, '{$reg_exp}', '{$vystupni_format}', {$min_val}, {$max_val}, {$poradi});", $error))
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

          if ($res = $this->query("SELECT sablona, typ, nazev, value, povinne, skryt_obsah, vstupni_typ, reg_exp, vystupni_format, min_val, max_val, poradi FROM {$this->dbpredpona}element_kniha WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $sab_1 = (!Empty($sab) ? $sab : $data->sablona);
              $type_1 = (isset($_GET["typ"]) ? $type : $data->typ);
              $vstup_1 = (isset($_GET["vstup"]) ? $vstup : $data->vstupni_typ);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem"],
                                                  $this->VyberSablony($sab_1),
                                                  $this->VyberTypu($type_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$id}&amp;sab={$sab_1}&amp;vstup={$vstup_1}"),
                                                  $data->nazev,
                                                  ($type_1 < 3 || $type_1 == 7 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_value"], $data->value) :
                                                                                ($type_1 == 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_captcha"], $data->value) : "")),
                                                  "",
                                                  "",
                                                  "",
                                                  ($data->povinne ? " checked=\"checked\"" : ""),
                                                  ($type_1 == 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_skryt_obsah"], ($data->skryt_obsah ? " checked=\"checked\"" : "")) : ""),
                                                  ($type_1 < 3 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vstupni_typ"], $this->VyberVstupu($vstup_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$id}&amp;sab={$sab_1}&amp;typ={$type_1}")) : ""),
                                                  ($type_1 < 3 && $vstup_1 == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_reg_exp"], $data->reg_exp) : ""),
                                                  ($type_1 >= 4 && $type_1 <= 6 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_vystupni_format"], (!isset($_GET["typ"]) ? $data->vystupni_format : ($type_1 == 4 ? "d.m.Y" : ($type_1 == 5 ? "H:i:s" : "d.m.Y H:i:s")))) : ""),
                                                  ($type_1 < 3 && $vstup_1 >= 0 && $vstup_1 <= 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addeditelem_min_max_poc"], $data->min_val, $data->max_val) : ""),
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $sablona = $_POST["sablona"];
              settype($sablona, "integer");
              $typ = $_POST["typ"];
              settype($typ, "integer");
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $value = $this->ChangeWrongChar($_POST["value"]);
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $skryt_obsah = (!Empty($_POST["skryt_obsah"]) ? 1 : 0);
              $vstupni_typ = $_POST["vstupni_typ"];
              settype($vstupni_typ, "integer");
              $reg_exp = $this->ChangeWrongChar($_POST["reg_exp"]);
              $vystupni_format = $this->ChangeWrongChar($_POST["vystupni_format"]);
              $min_val = $_POST["min_val"];
              settype($min_val, "integer");
              $max_val = $_POST["max_val"];
              settype($max_val, "integer");
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $poradi > 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}element_kniha SET sablona={$sablona},
                                                                                  typ={$typ},
                                                                                  nazev='{$nazev}',
                                                                                  value='{$value}',
                                                                                  povinne={$povinne},
                                                                                  skryt_obsah={$skryt_obsah},
                                                                                  vstupni_typ={$vstupni_typ},
                                                                                  reg_exp='{$reg_exp}',
                                                                                  vystupni_format='{$vystupni_format}',
                                                                                  min_val={$min_val},
                                                                                  max_val={$max_val},
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

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}element_kniha WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}element_kniha WHERE id={$id};", $error)) //provedeni dotazu
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
 * Vypis administrace obsahu - tvurce
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $typelementu = array_keys($this->element);

    $result = "";
    if ($res = $this->query("SELECT id, adresa, nazev, popisek FROM {$this->dbpredpona}sablona_kniha ORDER BY nazev ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona"],
                                              $data->id,
                                              $data->adresa,
                                              $data->nazev,
                                              $data->popisek,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editsab&amp;id={$data->id}",
                                              ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_sablona_adddel_link"],
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delsab&amp;id={$data->id}",
                                                                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;sab={$data->id}",
                                                                                                  $data->nazev) : "")
                                              );

          if ($res1 = $this->query("SELECT id, typ, nazev, value, povinne, skryt_obsah, vstupni_typ, vystupni_format, poradi FROM {$this->dbpredpona}element_kniha WHERE sablona={$data->id} ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_element"],
                                                    $data1->nazev,
                                                    (!Empty($data1->value) ? $data1->value : "---"),
                                                    $typelementu[$data1->typ],
                                                    ($data1->povinne ? " checked=\"checked\"" : ""),
                                                    ($data1->skryt_obsah ? " checked=\"checked\"" : ""),
                                                    $this->vstupni_typ[$data1->vstupni_typ],
                                                    (!Empty($data1->vystupni_format) ? $data1->vystupni_format : "---"),
                                                    $data1->poradi,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}",
                                                    ($this->povolit_pridani ? $this->NactiUnikatniObsah($this->unikatni["admin_vypis_del_link"],
                                                                                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}",
                                                                                                        $data1->nazev) : ""));
              }
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
