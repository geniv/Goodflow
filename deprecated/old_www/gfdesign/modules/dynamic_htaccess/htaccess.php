<?php

/**
 *
 * Blok dynamicky generovaneho htaccess-u
 *
 * public funkce:\n
 * construct: DynamicHtaccess - hlavni konstruktor tridy\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicHtaccess
{
  private $var;
  private $sqlite;
  private $dbname;
  private $idmodul = "genhtaccess";
  private $idgenfile = "compile";
  private $dirpath;

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

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();
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
                                      rewrite TEXT,
                                      poznamka VARCHAR(300),
                                      poradi INTEGER UNSIGNED);

                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#Options -Indexes', 'zobrazovani souboru', 1);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#ErrorDocument 400 /error_page.html', 'error page 400', 2);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#ErrorDocument 401 /error_page.html', 'error page 401', 3);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#ErrorDocument 403 /error_page.html', 'error page 403', 4);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#ErrorDocument 404 /error_page.html', 'error page 404', 5);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#ErrorDocument 500 /error_page.html', 'error page 500', 6);

                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#AddHandler php5-cgi .php', 'zapinani php5 na klenotu 1/2', 7);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#Action php5-cgi /php5cgi/php', 'zapinani php5 na klenotu 2/2', 8);

                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '', 'http aturizace pro klenot server', 9);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#RewriteEngine on', 'zapinani rewrite', 10);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#RewriteBase /', '', 11);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#RewriteCond %{HTTP:Authorization} !^$', 'nastaveni na http autorzaci', 12);
                                      INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES (NULL, '#RewriteRule .* - [E=REMOTE_USER:%{HTTP:Authorization},L]', 'prepis http autorizace na klenotu', 13);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
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
    if ($res = @$this->sqlite->query("SELECT rewrite, poznamka FROM htaccess ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $out .=
          "#{$data->poznamka}\n{$data->rewrite}\n\n";
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $u = fopen(".htaccess", "w");
    fwrite($u, htmlspecialchars_decode(html_entity_decode($out)));
    fclose($u);

    $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti

    return $result = "kompilováno";
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
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">administrace dynamickeho htaccess-u</a><br />";

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
          $result = $this->AdministraceHtaccessu();
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho htaccessu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceHtaccessu()
  {
    $result =
    "administrace dynamickeho htaccess-u
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add\" title=\"\">přidat položku</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idgenfile}\" title=\"\" onclick=\"return confirm('Opravdu vygenerovat soubor ?');\">vygenerovat htaccess</a>
    ".(file_exists(".htaccess") ? "htaccess existuje <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show\" title=\"\">náhled</a>" : "htaccess neexistuje")."
    <br />
    <br />
    {$this->AdminVypisHtaccess()}
    ";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $result =
          "
          <form method=\"post\">
            <fieldset>
              rewrite: <input type=\"input\" name=\"rewrite\" /><br />
              poznamka: <input type=\"input\" name=\"poznamka\" />(max 300 zn.)<br />
              poradi: <input type=\"input\" name=\"poradi\" />>0<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat položku\" />
            </fieldset>
          </form>
          ";

          $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
          $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($poradi) &&
              $poradi != 0)
          {
            if (@$this->sqlite->queryExec("INSERT INTO htaccess (id, rewrite, poznamka, poradi) VALUES
                                          (NULL, '{$rewrite}', '{$poznamka}', {$poradi});", $error))
            {
              $result =
              "
                přídán: {$rewrite} do pořadí: {$poradi}
              ";
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

          if ($res = @$this->sqlite->query("SELECT rewrite, poznamka, poradi FROM htaccess WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  rewrite: <input type=\"input\" name=\"rewrite\" value=\"{$data->rewrite}\" /><br />
                  poznamka: <input type=\"input\" name=\"poznamka\" value=\"{$data->poznamka}\" />(max 300 zn.)<br />
                  poradi: <input type=\"input\" name=\"poradi\" value=\"{$data->poradi}\" />>0<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $rewrite = stripslashes(htmlspecialchars($_POST["rewrite"], ENT_QUOTES));
              $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"], ENT_QUOTES));
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($poradi) &&
                  $poradi != 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE htaccess SET rewrite='{$rewrite}',
                                                                    poznamka='{$poznamka}',
                                                                    poradi={$poradi}
                                                                    WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upraven: {$rewrite}
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
                $result =
                "
                  smazáno: '{$data->rewrite}'
                ";
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

        case "show":  //zobrazi nahled existujiciho htaccess-u
          $u = fopen(".htaccess", "r");
          $out = fread($u, filesize(".htaccess"));
          fclose($u);

          $result =
          "<br />
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">zavřít náhled [X]</a><br />
          <pre>{$out}</pre>";
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
  private function AdminVypisHtaccess()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, rewrite, poznamka, poradi FROM htaccess ORDER BY poradi ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "poradi: '{$data->poradi}' ({$data->id}) <strong>{$data->rewrite} #{$data->poznamka}</strong>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">upravit položku</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->rewrite}\' ?');\">smazat položku</a> <br />
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
}
?>
