<?php

/**
 *
 * Blok dynamicky generovaneho obsahu
 *
 * public funkce:\n
 * construct: DynamicCyklObsah - hlavni konstruktor tridy\n
 * CyklObsah() - hlavni vypis obsahu, podle adresy a nebo podle daneho parametru\n
 * RSSVystup() - vypise link pro RSS vystup\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicCyklObsah extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $unikatni;
  public $idmodul = "cyklobsah";

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

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"], $this->idmodul));
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
      if (!@$this->sqlite->queryExec("CREATE TABLE cyklicky_obsah (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      datum DATETIME,
                                      text TEXT);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Navraceni samotneho generovaneho textu dle dane adresy
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicCyklObsah", "CyklObsah"[, "nekde_nekde", 1]);</strong>
 *
 * @param adr vstupni adresa, bez ni se bere adresa ze $_SERVER["QUERY_STRING"]
 * @param tvar cislo tvaru ktery se ma pouzit
 * @return vystupni text
 */
  public function CyklObsah($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $result = "";
    if ($res = @$this->sqlite->query("SELECT datum, text FROM cyklicky_obsah
                                      WHERE adresa='{$adresa}'
                                      ORDER BY cyklicky_obsah.datum DESC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date($this->NactiUnikatniObsah($this->unikatni["normal_vypis_tvar_datum_{$tvar}"]), strtotime($data->datum));

          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_obsah_{$tvar}"],
                                              $datum,
                                              $data->text);
        }
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_null_{$tvar}"]);
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
 * Generuje rss link do html hlavicky (head)
 *
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSLink"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return head link
 */
  public function RSSLink($tvar = 1)
  {
    $mutace = $this->var->main[0]->NactiFunkci("DynamicLanguage", "MutaceJazyka");
    $pole = (!Empty($mutace) ? array_keys($mutace) : "");  //navrat klicu

    $result = "";
    for ($i = 0; $i < count($pole); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_link_rss_{$tvar}"],
                                          ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}/{$mutace[$pole[$i]]}" : "?{$this->var->get_kam}={$this->rsslink}&amp;jazyk={$pole[$i]}"),
                                          $mutace[$pole[$i]],
                                          $this->var->main[0]->NactiFunkci("DynamicLanguage", "JazykPodleId", $pole[$i]));
    }

    return $result;
  }

/**
 *
 * Generuje rss link do obsahu html
 *
 * pouziti: <strong>$rss = $this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSLinkWeb"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return html link
 */
  public function RSSLinkWeb($tvar = 1)
  {
    $mutace = $this->var->main[0]->NactiFunkci("DynamicLanguage", "MutaceJazyka");
    $pole = (!Empty($mutace) ? array_keys($mutace) : "");  //navrat klicu

    $result = "";
    for ($i = 0; $i < count($pole); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_link_rss_web_{$tvar}"],
                                          ($this->var->htaccess ? "{$this->absolutni_url}{$this->rsslink}/{$mutace[$pole[$i]]}" : "?{$this->var->get_kam}={$this->rsslink}&amp;jazyk={$pole[$i]}"),
                                          $mutace[$pole[$i]],
                                          $this->var->main[0]->NactiFunkci("DynamicLanguage", "JazykPodleId", $pole[$i]));
    }

    return $result;
  }

/**
 *
 * Generuje rss, odchytava si danou url
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("DynamicLanguageCyklObsah", "RSSVystup"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 */
  public function RSSVystup($tvar = 1)
  {
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

    if ($_GET[$this->var->get_kam] == $this->rsslink)  //ceka na danou adresu
    {
      $jazyk = ($this->var->htaccess ? $this->var->main[0]->NactiFunkci("DynamicLanguage", "PrevodTextoveAdresy", $_GET["jazyk"]) : $_GET["jazyk"]);
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

      if ($res = @$this->sqlite->query("SELECT datum, text FROM cyklicky_lang_obsah
                                        WHERE jazyk={$jazyk}
                                        ORDER BY cyklicky_lang_obsah.datum DESC;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          $i = 0;
          while ($data = $res->fetchObject())
          {
            $title = date($this->NactiUnikatniObsah($this->unikatni["normal_rss_item_datum_{$tvar}"]), strtotime($data->datum));
            $datum = date("D, d M Y H:i:s \G\M\T", strtotime($data->datum));

            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_rss_item_{$tvar}"],
                                                $title,
                                                $this->absolutni_url,
                                                $data->text,
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
      }
    }

    return $result;
  }

/**
 *
 * Overuje jestli existuje polozda v DB
 *
 * @param nazev nazev sekce
 * @param zanoreni cislo zanoreni sekce
 * @return true/false - existuje / neexistuje
 */
  private function ExistujePolozka($adresa)
  {
    if ($res = @$this->sqlite->query("SELECT id FROM cyklicky_obsah WHERE adresa='{$adresa}';", NULL, $error))
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho menu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add",
                                        $this->AdminVypisObsah());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              date("j.n.Y H:i:s"));

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
          $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($datum) &&
              !Empty($text))
          {
            if (@$this->sqlite->queryExec("INSERT INTO cyklicky_obsah (id, adresa, datum, text) VALUES
                                          (NULL, '{$adresa}', '{$datum}', '{$text}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"],
                                                  $adresa);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //editace
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, datum, text FROM cyklicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  $data->adresa,
                                                  date("j.n.Y H:i:s", strtotime(stripslashes($data->datum))),
                                                  $data->text);
              ;

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $datum = date("Y-m-d H:i:s", strtotime(stripslashes(htmlspecialchars($_POST["datum"], ENT_QUOTES))));
              $text = stripslashes(htmlspecialchars($_POST["text"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($datum) &&
                  !Empty($text) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE cyklicky_obsah SET adresa='{$adresa}',
                                                                          datum='{$datum}',
                                                                          text='{$text}'
                                                                          WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"], $adresa);
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

        case "del": //rekurzivni mazani
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM cyklicky_obsah WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM cyklicky_obsah WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"], $data->adresa);
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace menu
 *
 * @return vypis menu v html
 */
  private function AdminVypisObsah()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, datum, text FROM cyklicky_obsah ORDER BY LOWER(adresa) ASC, cyklicky_obsah.datum DESC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $datum = date("j.n. Y H:i:s", strtotime($data->datum));

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->adresa,
                                              $data->id,
                                              $datum,
                                              $data->text,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }
}
?>
