<?php

/**
 *
 * Blok dynamicky generovaneho menu
 *
 * public funkce:\n
 * construct: DynamicEshopMenu - hlavni konstruktor tridy\n
 * Menu() - hlavni vypis menu\n
 * NazevPodleAdresy() - vraceni nazvu podle ID\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicEshopMenu
{
  private $var;
  private $sqlite;
  private $dbname = "./modules/dynamicke_eshop_menu_foltyn/.dbdyneshmenu.sqlite2";
  private $idmodul = "eshopmenu";

  private $blokurl = array("buy" => "show");

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

    if (!$this->sqlite = @new SQLiteDatabase($this->dbname, 0777, $error))
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
    if (filesize($this->dbname) == 0)
    {
      if (!@$this->sqlite->queryExec("CREATE TABLE menu (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      nazev VARCHAR(200),
                                      koren INTEGER UNSIGNED,
                                      submenu TEXT,
                                      zanoreni INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Zablokovani oznacovani pri definovanych url adresach
 *
 * @return true/false - povoleno / zakazano
 */
  private function ZobrazitOznaceni()
  {
    $key = array_keys($this->blokurl);

    $result = true;
    for ($i = 0; $i < count($key); $i++)
    {
      if ($_GET[$key[$i]] == $this->blokurl[$key[$i]])
      {
        $result = false;
        break;
      }
    }

    return $result;
  }

/**
 *
 * Zjisti prvni polozku v databazi
 *
 * @return adresu prvni polozky
 */
  private function PrvniPolozka()
  {
    if ($res = @$this->sqlite->query("SELECT id FROM menu WHERE zanoreni=0 ORDER BY LOWER(nazev) ASC LIMIT 0,1;", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->id;
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
 * Generovani samotneho menu
 *
 * @return vygenerovane menu
 */
  public function Menu()
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, submenu, zanoreni FROM menu WHERE zanoreni=0 ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $subadresa = explode("-", $_GET[$this->var->get_kam]);

          $oznpodm = (!Empty($_GET[$this->var->get_kam]) ? ($subadresa[0] == $data->id) : ($this->ZobrazitOznaceni() ? $this->PrvniPolozka() == $data->id : false));
          $subozna = ((count($subadresa) - 1) == $data->zanoreni);

          $result .=
          "<a href=\"?{$this->var->get_kam}={$data->id}\" title=\"{$data->nazev}\">".($oznpodm ? ($subozna ? "[> " : "[ ") : "")."{$data->nazev}".($oznpodm ? ($subozna ? " <]" : " ]") : "")."</a> - ({$data->id}, {$data->zanoreni})<br />
          ".($oznpodm ? $this->RekurzivniMenu($subadresa[0]) : "")."
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

/**
 *
 * Administracni menu
 *
 * @return admin menu
 */
  public function AdminMenu()
  {
    $result =
    "<a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"\">administrace dynamickeho eshop menu</a><br />";

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
          $result = $this->AdministraceMenu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati nazev nalezici danemu id, pro externi moduly
 *
 * @param id id polozky menu
 * @return nazev polozky menu
 */
  public function NazevPodleAdresy($id)
  {
    settype($id, "integer");
    $result = "žádný název neexistuje";
    if ($res = @$this->sqlite->query("SELECT nazev FROM menu WHERE id='{$id}';", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->nazev;
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
 * Vrati text submenu
 *
 * @param id cislo menu
 * @return vraci id ukazujici na vnorene submenu
 */
  private function NavratSubmenu($id)
  {
    settype($id, "integer");
    if ($res = @$this->sqlite->query("SELECT submenu FROM menu WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->submenu;
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
 * Rekurzivne volana funkce na vykreslovani submenu
 *
 * @param id cislo posledniho zanoreni
 * @return zpracovane menu v html
 */
  private function RekurzivniMenu($id)
  {
    settype($id, "integer");
    $sub = explode("-", $this->NavratSubmenu($id)); //rozdeleni podmenu
    $subadresa = explode("-", $_GET[$this->var->get_kam]);  //rozdeleni adresy

    if (!Empty($sub[0]))  //je-li prni prvek v pomenu neprazdny
    {
      $subwhere = "";
      for ($i = 0; $i < count($sub); $i++)  //vygenerovani dotazu pro vyps menu
      {
        $subwhere .= "{$sub[$i]}, ";
      }
      $subwhere = substr($subwhere, 0, -2);

      $result = "";
      if ($res = @$this->sqlite->query("SELECT id, nazev, zanoreni FROM menu WHERE id IN ({$subwhere}) ORDER BY LOWER(nazev) ASC;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          while ($data = $res->fetchObject())
          {
            $odsazeni = str_repeat("---", $data->zanoreni); //poctani zanoreni

            $oznpodm = ($data->id == $subadresa[$data->zanoreni]); //rekurzivni podminka
            $subozna = ((count($subadresa) - 1) == $data->zanoreni);

            $rozklad = "";
            for ($i = 0; $i < $data->zanoreni; $i++)  //rozklad adresy
            {
              $rozklad .= "{$subadresa[$i]}-";
            }

            $result .=
            "{$odsazeni} <a href=\"?{$this->var->get_kam}={$rozklad}{$data->id}\" title=\"{$data->nazev}\">".($oznpodm ? ($subozna ? "[> " : "[ ") : "")."{$data->nazev}".($oznpodm ? ($subozna ? " <]" : " ]") : "")."</a> - ({$data->id}, {$data->zanoreni})<br />
            ".($oznpodm ? $this->RekurzivniMenu($subadresa[$data->zanoreni]) : "")."
            ";
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
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
  private function ExistujePolozka($nazev, $zanoreni)
  {
    settype($zanoreni, "integer");

    if ($res = @$this->sqlite->query("SELECT id FROM menu WHERE nazev='{$nazev}' AND zanoreni={$zanoreni};", NULL, $error))
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
  private function AdministraceMenu()
  {
    $result =
    "administrace dynamickeho menu
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;zanoreni=0\" title=\"\">přidat hlavni sekci</a><br />
    <br />
    {$this->AdminVypisMenu()}
    ";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani
          $zanoreni = $_GET["zanoreni"];  //cislo zanoreni
          settype($zanoreni, "integer");

          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          $result =
          "
          <form method=\"post\">
            <fieldset>
              <input type=\"text\" name=\"nazev\" /> <br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat do zanoření: {$zanoreni}\" />
            </fieldset>
          </form>
          ";

          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !$this->ExistujePolozka($nazev, $zanoreni))  //kontola jestli neni stejny nazev na stejne urovni
          {
            if (@$this->sqlite->queryExec("INSERT INTO menu (id, nazev, koren, submenu, zanoreni) VALUES
                                          (NULL, '{$nazev}', {$id}, '', {$zanoreni});", $error))
            {
              if (!Empty($id) &&
                  $zanoreni > 0)
              {
                $this->UpravSubMenu($id, $this->sqlite->lastInsertRowid()); //pridat do ID posledni AutoID
              }

              $result =
              "
                přídán: {$nazev} do zanoření: {$zanoreni}
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

          if ($res = @$this->sqlite->query("SELECT nazev FROM menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" /> <br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit\" />
                </fieldset>
              </form>
              ";

              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE menu SET nazev='{$nazev}' WHERE id={$id};", $error))
                {
                  $result =
                  "
                    upraven: {$nazev}
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

          $ext_dyn_obsah = $this->var->main[0]->PripojModul("DynamicObsahEshop");

          if ($res = @$this->sqlite->query("SELECT nazev FROM menu WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
              $smazat = explode("-", "{$this->RekurzivniMazani($id)}{$id}");  //zjisteni polozek na smazani

              $delwhere = "";
              for ($i = 0; $i < count($smazat); $i++) //vygenerovani dotazu pro smazani
              {
                $delwhere .= "{$smazat[$i]}, ";
              }
              $delwhere = substr($delwhere, 0, -2);

              //rekurzvni vzestup zjistujici adresu
              $ext_dyn_obsah->SmazStranku($this->UpravaStoupani($id)); //zpetne propojeni pro smazani obsahu podle adresy

              //musi upravit jeste driv nez se smaze aby zjistil jaky byl koren daneho ID
              $this->UpravSubIntegritu($id);  //uprav integritu v databazi menu

              if (@$this->sqlite->queryExec("DELETE FROM menu WHERE id IN ({$delwhere});", $error)) //provedeni dotazu
              {
                $result =
                "
                  smazáno: '{$data->nazev}' a všechny podmenu!
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
      }
    }

    return $result;
  }

/**
 *
 * Rekurzi ziska seznam id submenu, rekurzvnim sestupem
 *
 * @param id vstupni id
 * @return seznam id
 */
  private function RekurzivniMazani($id)
  {
    $sub = explode("-", $this->NavratSubmenu($id)); //rozdeleni podmenu

    $result = "";
    for ($i = 0; $i < count($sub); $i++)
    {
      if (!Empty($sub[0]))
      {
        $result .= "{$sub[$i]}-".(!Empty($sub[0]) ? $this->RekurzivniMazani($sub[$i]) : "");
      }
    }

    return $result;
  }

/**
 *
 * Finalni uprava rekurzivni vzestupu
 *
 * @param id pocatecni id
 * @return adresa ve spravnem poradi
 */
  private function UpravaStoupani($id)
  {
    $adresa = "{$id}-{$this->RekurzivniStoupani($id)}";
    $adresa = substr($adresa, 0, -1);
    $adresa = explode("-", $adresa);

    $sub = "";
    for ($i = count($adresa) - 1; $i >= 0; $i--)
    {
      $sub .= "{$adresa[$i]}-";
    }
    $result = substr($sub, 0, -1);

    return $result;
  }

/**
 *
 * Rekurzivni "stoupani" po strome
 *
 * @param id vstupni id
 * @return adresa pospatku
 */
  private function RekurzivniStoupani($id)
  {
    settype($id, "integer");
    if ($res = @$this->sqlite->query("SELECT koren FROM menu WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $adr = $res->fetchObject()->koren;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    if (!Empty($adr))
    {
      $result .= "{$adr}-{$this->RekurzivniStoupani($adr)}";
    }

    return $result;
  }

/**
 *
 * Vypis administrace menu
 *
 * @return vypis menu v html
 */
  private function AdminVypisMenu()
  {
    $ext_dyn_obsah = $this->var->main[0]->PripojModul("DynamicObsahEshop");

    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, nazev, submenu, zanoreni FROM menu WHERE zanoreni=0 ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $submenu = $this->VykresliBlokAdminMenu($data->submenu);

          $odsazeni = str_repeat("--", $data->zanoreni);

          $exter_add = $ext_dyn_obsah->PridejSmazStranku($this->UpravaStoupani($data->id));

          $result .=
          "{$odsazeni} ({$data->id}) {$data->nazev} - {$data->zanoreni}
          [[{$exter_add}]]
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;id={$data->id}&amp;zanoreni=".($data->zanoreni + 1)."\" title=\"\">přidat podsekci</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">upravit sekci</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->nazev}\' ?');\">smazat sekci</a> <br />
          {$submenu}";
        }
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
 * Rekurzivni vykreslovani admin sub menu
 *
 * @param submenu text submenu urcujici dalsi clen
 * @return kostru dalsiho clenu
 */
  private function VykresliBlokAdminMenu($submenu)
  {
    $sub = explode("-", $submenu);
    $ext_dyn_obsah = $this->var->main[0]->PripojModul("DynamicObsahEshop");

    if (!Empty($sub[0]))  //konrola prvniho indexu, rozhodnuti dalsiho volani
    {
      $subwhere = "";
      for ($i = 0; $i < count($sub); $i++)
      {
        $subwhere .= "{$sub[$i]}, "; //vygenerovani dotazu
      }
      $subwhere = substr($subwhere, 0, -2);

      $result = "";
      if ($res = @$this->sqlite->query("SELECT id, nazev, submenu, zanoreni FROM menu WHERE id IN ({$subwhere}) ORDER BY LOWER(nazev) ASC;", NULL, $error))
      {
        if ($res->numRows() != 0)
        {
          while ($data = $res->fetchObject())
          {
            $submenu = $this->VykresliBlokAdminMenu($data->submenu); //rekurzivni volani

            $odsazeni = str_repeat("--", $data->zanoreni);  //pocet carek zanoreni

            $exter_add = $ext_dyn_obsah->PridejSmazStranku($this->UpravaStoupani($data->id));

            $result .=
            "{$odsazeni} ({$data->id}) {$data->nazev} - {$data->zanoreni}
            [[{$exter_add}]]
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add&amp;id={$data->id}&amp;zanoreni=".($data->zanoreni + 1)."\" title=\"\">přidat podsekci</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}\" title=\"\">upravit sekci</a>
            <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat: \'{$data->nazev}\' ?');\">smazat sekci</a> <br />
            {$submenu}";
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }

    return $result;
  }

/**
 *
 * Pridavani ID do submenu
 *
 * @param id zaznam do ktereho se ma last_id pridat
 * @param last_id ID-cko co se ma pridat
 * @return
 */
  private function UpravSubMenu($id, $last_id)
  {
    if ($res = @$this->sqlite->query("SELECT submenu FROM menu WHERE id={$id};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $submenu = $res->fetchObject()->submenu;
        $submenu = (Empty($submenu) ? "{$last_id}" : "{$submenu}-{$last_id}");

        if (!@$this->sqlite->queryExec("UPDATE menu SET submenu='{$submenu}' WHERE id={$id};", $error))
        {
          $this->var->main[0]->ErrorMsg($error);
        }
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
 * Upravuje odseknute vetve stromu a kontroluje existence ID
 *
 * @param delid id ktere se ma v databazi vymazat
 */
  private function UpravSubIntegritu($delid)  //zmaze id ... ktere bylo pod urovni a upravi subadresu
  {
    $endid = 0;
    settype($delid, "integer");
    //zisteni korenu daneho ID, uz nevyhledava
    if ($res = @$this->sqlite->query("SELECT koren FROM menu WHERE id={$delid};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $endid = $res->fetchObject()->koren;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    settype($endid, "integer");
    //nacteni submenu ktere se ma upravit
    if ($res = @$this->sqlite->query("SELECT submenu FROM menu WHERE id={$endid};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $submenu = $res->fetchObject()->submenu;
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $sub = explode("-", $submenu);
    $newsubmenu = "";

    if (count($sub) > 1)
    {
      for ($i = 0; $i < count($sub); $i++)
      {
        if ($sub[$i] != $delid && $this->ExistujeID($sub[$i]))  //vypise bez delid a neexistujici ID
        {
          $newsubmenu .= "{$sub[$i]}-";
        }
      }

      if (Empty($newsubmenu))
      {
        $newsubmenu = NULL;
      }
        else
      {
        $newsubmenu = substr($newsubmenu, 0, -1);
      }
    }
      else
    {
      $newsubmenu = NULL;
    }

    if (!@$this->sqlite->queryExec("UPDATE menu SET submenu='{$newsubmenu}' WHERE id={$endid};", $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }
  }

/**
 *
 * Kontroluje jestli dane id v databazi existuje
 *
 * @param id kontrolovane id v databazi
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeID($id)
  {
    settype($id, "integer");
    if ($res = @$this->sqlite->query("SELECT id FROM menu WHERE id={$id};", NULL, $error))
    {
      $result = ($res->numRows() == 1 ? true : false);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    return $result;
  }
}
?>
