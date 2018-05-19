<?php

/**
 *
 * Blok dynamicky generovaneho htaccess-u
 *
 * public funkce:\n
 * construct: DynamicHtaccess - hlavni konstruktor tridy\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicHtaccess extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $absolutni_url, $unikatni;
  public $idmodul = "genhtaccess";
  private $idgenfile = "compile";

/**
 *
 * Konstruktor menu
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

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
      if (!@$this->sqlite->queryExec("CREATE TABLE htaccess (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      aktivni BOOL,
                                      rewrite TEXT,
                                      poznamka VARCHAR(300),
                                      poradi INTEGER UNSIGNED);

                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'Options -Indexes', 'zobrazovani souboru', 1);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 1, 'ErrorDocument 400 {$this->absolutni_url}error_page/400.html', 'error page 400', 2);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 1, 'ErrorDocument 401 {$this->absolutni_url}error_page/401.html', 'error page 401', 3);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 1, 'ErrorDocument 403 {$this->absolutni_url}error_page/403.html', 'error page 403', 4);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 1, 'ErrorDocument 404 {$this->absolutni_url}error_page/404.html', 'error page 404', 5);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 1, 'ErrorDocument 500 {$this->absolutni_url}error_page/500.html', 'error page 500', 6);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 1, 'ErrorDocument 503 {$this->absolutni_url}error_page/503.html', 'error page 503', 7);

                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'AddHandler php5-cgi .php', 'zapinani php5 na klenotu 1/2', 8);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'Action php5-cgi /php5cgi/php', 'zapinani php5 na klenotu 2/2', 9);

                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'RewriteEngine on', 'zapinani rewrite', 10);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'RewriteBase /', 'nasmerovani korenu', 11);

                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'RewriteRule ^rss/([a-zA-Z-\_]+)/?$ ?action=rss&sablona=$1 [L]', '', 12);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'RewriteRule ^([a-zA-Z0-9-\_]+)/([0-9]+)?$ ?action=$1&str=$2 [L]', '', 13);
                                      INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES (NULL, 0, 'RewriteRule ^([a-zA-Z0-9-\_]+)/?$ ?action=$1 [L]', '', 14);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
  }

/**
 *
 * Vygenerovani samotneho htaccess-u
 *
 * @return info o generovani
 */
  private function GenerujHtaccess()
  {
    $out = "";
    if ($res = @$this->sqlite->query("SELECT aktivni, rewrite, poznamka FROM htaccess ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $out .= $this->NactiUnikatniObsah($this->unikatni["admin_generovani_htaccess"],
                                            $data->poznamka,
                                            ($data->aktivni ? $data->rewrite : "#{$data->rewrite}"));
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $u = fopen(".htaccess", "w");
    fwrite($u, htmlspecialchars_decode(html_entity_decode($out)));
    fclose($u);

    $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti

    return $result = $this->NactiUnikatniObsah($this->unikatni["admin_generovani_htaccess_complet"]);
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
          $result = $this->Administrace();
        break;

        case "{$this->idmodul}{$this->idgenfile}":  //generovani htaccessu
          $result = $this->GenerujHtaccess();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati pocet polozek v DB
 *
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($inc = 0)
  {
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM htaccess;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet + $inc;
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho htaccessu
 *
 * @return adminstracni formular v html
 */
  private function Administrace()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idgenfile}",
                                        (file_exists(".htaccess") ? $this->NactiUnikatniObsah($this->unikatni["admin_htaccess_exists"],
                                                                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show")
                                                                  :
                                                                    $this->NactiUnikatniObsah($this->unikatni["admin_htaccess_not_exists"])),
                                        $this->AdminVypisObsah());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "test_rv":
          $vstup = stripslashes(htmlspecialchars($_POST["vstup"], ENT_QUOTES));
          //prepinani podle webu/lokalu
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));

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

        case "add": //pridavani
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add"],
                                              $this->PocetRadku(1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);
          $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
          $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              $poradi != 0)
          {
            if (@$this->sqlite->queryExec("INSERT INTO htaccess (id, aktivni, rewrite, poznamka, poradi) VALUES
                                          (NULL, {$aktivni}, '{$rewrite}', '{$poznamka}', {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_hlaska"],
                                                  $rewrite,
                                                  $poradi);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edit":  //editace
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT aktivni, rewrite, poznamka, poradi FROM htaccess WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit"],
                                                  ($data->aktivni ? " checked=\"checked\"" : ""),
                                                  $data->rewrite,
                                                  $data->poznamka,
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);
              $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
              $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  $poradi != 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE htaccess SET aktivni={$aktivni},
                                                                    rewrite='{$rewrite}',
                                                                    poznamka='{$poznamka}',
                                                                    poradi={$poradi}
                                                                    WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_hlaska"],
                                                      $rewrite);

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

        case "del": //rekurzivni mazani
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT rewrite FROM htaccess WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM htaccess WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_hlaska"],
                                                    $data->rewrite);

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

        case "show":  //zobrazi nahled existujiciho htaccess-u
          $u = fopen(".htaccess", "r");
          $out = fread($u, filesize(".htaccess"));
          fclose($u);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_show"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                              $out);
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace htaccessu
 *
 * @return vypis htaccesu v html
 */
  private function AdminVypisObsah()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin"],
                                        $this->absolutni_url,
                                        $this->dirpath);
    $i = 0;
    if ($res = @$this->sqlite->query("SELECT id, aktivni, rewrite, poznamka, poradi FROM htaccess ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                              $data->id,
                                              $data->poradi,
                                              ($data->aktivni ? " checked=\"checked\"" : ""),
                                              ($data->aktivni ? $data->rewrite : "#{$data->rewrite}"),
                                              $data->poznamka,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}");
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_end"]);

    return $result;
  }
}
?>
