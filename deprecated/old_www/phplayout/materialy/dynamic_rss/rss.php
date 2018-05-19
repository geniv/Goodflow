<?php

/**
 *
 * Blok dynamicky generovaneho obsahu rss vystup, pasivne cte externi SQLite2 databazi,
 * kde tento modul ceka na svou chvili nez bude zavolan, jinak se neprojevuje
 *
 * public funkce:\n
 * construct: DynamicRSS - hlavni konstruktor tridy\n
 * RSSVystup() - hlavni vypis obsahu, podle adresy a nebo podle daneho parametru\n
 *
 */

class DynamicRSS extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;

  private $printurl = "rss";  //url na kterou ceka

  //data pro pripojen externi databaze
  private $sourcedb = "DynamicLanguageCyklObsah"; //nazev hledane tridy
  private $sourcetable = "cyklicky_lang_obsah";  //nazev tabulky
  private $sourcecolumn = "datum, text"; //nazev sloupcu
  private $sourceorder = "ORDER BY cyklicky_lang_obsah.datum DESC";

  private $rss_datum = "datum"; //datum
  private $rss_descr = "text";  //description

  private $rss_kodovani = "UTF-8";
  private $rss_title = "title rss";
  private $rss_category = "kategorie";
  private $rss_description = "poznamka";
  private $rss_language = "cs";
  private $rss_copyright = "(c) vytvoren (c)";
  private $rss_managingEditor = "rizeni@email.cz (rizeni)";
  private $rss_webMaster = "webmaster@email.cz (webmaster)";
  private $rss_ttl = 120;

  private $rss_image_title = "nadpis obrazku";
  private $rss_image_link = "http://www.kam_nas_obrazek_zavede.cz";
  private $rss_image_url = "http://www.absolutni_cesta_obrazku.cz/obr.png";

  private $jazyk = false; //povoleni ocekavat jazyk

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
    $dirpath = dirname($this->var->moduly[$index]["include"]);

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");
  }

/**
 *
 * Generuje rss, odchytava si danou url
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("DynamicRSS", "RSSVystup"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 */
  public function RSSVystup($tvar = 1)
  {
    $this->printurl = $this->NactiUnikatniObsah($this->unikatni["set_printurl_{$tvar}"]);
    $this->sourcedb = $this->NactiUnikatniObsah($this->unikatni["set_sourcedb_{$tvar}"]);

    $this->rss_datum = $this->NactiUnikatniObsah($this->unikatni["set_rss_datum_{$tvar}"]);
    $this->rss_descr = $this->NactiUnikatniObsah($this->unikatni["set_rss_descr_{$tvar}"]);

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
    $this->rss_image_link = $this->NactiUnikatniObsah($this->unikatni["set_rss_image_link_{$tvar}"]);
    $this->rss_image_url = $this->NactiUnikatniObsah($this->unikatni["set_rss_image_url_{$tvar}"]);

    $this->jazyk = $this->NactiUnikatniObsah($this->unikatni["set_jazyk_{$tvar}"]); //povoleni ocekavat jazyk

    $index = $this->var->main[0]->NajdiIndexPodleTridy($this->sourcedb);  //najde index tridy
    if ($index >= 0)
    {
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      $this->dbname = $this->var->moduly[$index]["databaze"];

      if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg("Modul: '{$this->sourcedb}' nenalezen");
    }

    if ($_GET[$this->var->get_kam] == $this->printurl)  //ceka na danou adresu
    {
      if ($this->jazyk)
      {
        $jazyk = ($this->var->htaccess ? $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrevodTextoveAdresy", $_GET["jazyk"]) : $_GET["jazyk"]);
      }

      $this->sourcequery = $this->NactiUnikatniObsah($this->unikatni["set_sourcequery_{$tvar}"],
                                                    $jazyk);

      $pubdate = gmdate("D, d M Y H:i:s \G\M\T");

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
                                          $pubdate,
                                          $this->rss_image_url);

      if ($res = @$this->sqlite->query($this->sourcequery, NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $i = 0;
          while ($data = $res->fetchObject())
          {
            $column_dat = $this->rss_datum;
            $column_des = $this->rss_descr;
            $title = date("d.m.Y", strtotime($data->$column_dat));

            $dat = strtotime($data->$column_dat);
            $datum = date("D, d M Y H:i:s \G\M\T", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) - 1, date("Y", $dat)));

            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rss_item_{$tvar}"],
                                                $title,
                                                $this->absolutni_url,
                                                $data->$column_des,
                                                $datum,
                                                $i);

            $i++;
          }
        }
      }

      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rss_end_{$tvar}"]);

      echo $result;
      exit(0);
    }
  }
}
?>
