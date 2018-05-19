<?php

/**
 *
 */
class DynamicTasks extends DefaultModule
{
  private $var, $dbname, $dirpath, $absolutni_url, $unikatni, $dbpredpona;
  public $idmodul = "dyntasks";
  public $idtasktym = "tym";
  public $idtaskskup = "skup";
  public $idtaskproj = "proj";
  public $idtaskukol = "ukol";
  public $idtaskkom = "com";
  public $idtaskuser = "uziv";
  public $idtaskpost = "post";
  public $idtasklink = "link";
  public $idtaskback = "back";

  public $mount = array("ajax_form.php",
                        "script/jquery-132-yui.js",
                        "script/jquery-ui-1.7.1.custom.min.js");

  private $pathscript = "script";
  private $pathpicture = "picture";
  private $pathback = "background";
  private $pathprofile = "profile";

  private $max_w = 200;
  private $max_h = 100;
  private $max_size = 3;  //MB, 0=neomezene

  private $oddeltym = "-";

  private $viditelnost_skupiny = array ("--vyber--",
                                        "...",
                                        );

  private $dulezitost_ukolu = array("--vyber--",
                                    "");

/**
 *
 * Konstruktor funkce
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 *
 */
  public function __construct(&$var, $index = 0) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);
    $this->dbname = $this->var->moduly[$index]["databaze"];

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    //viditelnost_skupiny
    $this->viditelnost_skupiny = $this->NactiUnikatniObsah($this->unikatni["set_viditelnost_skupiny"]);
    $this->dulezitost_ukolu = $this->NactiUnikatniObsah($this->unikatni["set_dulezitost_ukolu"]);
    $this->pathscript = $this->NactiUnikatniObsah($this->unikatni["set_pathscript"]);
    $this->pathpicture = $this->NactiUnikatniObsah($this->unikatni["set_pathpicture"]);
    $this->pathback = $this->NactiUnikatniObsah($this->unikatni["set_pathback"]);
    $this->pathprofile = $this->NactiUnikatniObsah($this->unikatni["set_pathprofile"]);

    $this->max_w = $this->NactiUnikatniObsah($this->unikatni["set_max_w"]);
    $this->max_h = $this->NactiUnikatniObsah($this->unikatni["set_max_h"]);
    $this->max_size = $this->NactiUnikatniObsah($this->unikatni["set_max_size"]);

    $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
    if (!$this->PripojeniDatabaze($error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        "{$this->idmodul}{$this->idtasktym}",
                                                        "{$this->idmodul}{$this->idtaskskup}",
                                                        "{$this->idmodul}{$this->idtaskproj}",
                                                        "{$this->idmodul}{$this->idtaskukol}",
                                                        "{$this->idmodul}{$this->idtaskkom}",
                                                        "{$this->idmodul}{$this->idtaskuser}",
                                                        "{$this->idmodul}{$this->idtaskpost}",
                                                        "{$this->idmodul}{$this->idtasklink}",
                                                        "{$this->idmodul}{$this->idtaskback}"));
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()
  { //Y-m-d H:i:s
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}tym (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    nazev VARCHAR(300),
                                    zakladatel INTEGER UNSIGNED,
                                    popis TEXT,
                                    vznik DATETIME);

                                  CREATE TABLE {$this->dbpredpona}skupina (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    tym INTEGER UNSIGNED,
                                    uzivatel INTEGER UNSIGNED,
                                    verejne INTEGER UNSIGNED,
                                    nazev VARCHAR(100),
                                    popis TEXT,
                                    zalozeno DATETIME,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}projekt (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    skupina INTEGER UNSIGNED,
                                    nazev VARCHAR(100),
                                    popis TEXT,
                                    zadani DATETIME,
                                    dokonceni DATETIME,
                                    dokonceno BOOL,
                                    cena INTEGER UNSIGNED,
                                    narocnost INTEGER UNSIGNED,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}tasks (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    projekt INTEGER UNSIGNED,
                                    nazev VARCHAR(100),
                                    popis TEXT,
                                    zadani DATETIME,
                                    dokonceni DATETIME,
                                    dokonceno BOOL,
                                    dulezitost INTEGER UNSIGNED,
                                    barva VARCHAR(20),
                                    narocnost INTEGER UNSIGNED,
                                    zobrazit BOOL,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}komentare (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    tasks INTEGER UNSIGNED,
                                    uzivatel INTEGER UNSIGNED,
                                    zprava TEXT,
                                    pridano DATETIME,
                                    zanoreni INTEGER UNSIGNED,
                                    zobrazit BOOL,
                                    ip VARCHAR(50),
                                    agent VARCHAR(300));

                                  CREATE TABLE {$this->dbpredpona}uzivatele (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    tym TEXT,
                                    jmeno VARCHAR(100),
                                    prijmeni VARCHAR(100),
                                    login VARCHAR(100),
                                    heslo VARCHAR(100),
                                    email VARCHAR(100),
                                    popis TEXT,
                                    foto VARCHAR(300),
                                    zalozeno DATETIME,
                                    upraveno DATETIME,
                                    pocet INTEGER UNSIGNED,
                                    aktivni BOOL,
                                    nastaveni TEXT);

                                  CREATE TABLE {$this->dbpredpona}last_login (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    uzivatel INTEGER UNSIGNED,
                                    prihlaseni DATETIME,
                                    last_active DATETIME,
                                    ip VARCHAR(50),
                                    agent VARCHAR(300),
                                    stav BOOL);

                                  CREATE TABLE {$this->dbpredpona}posta (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    od INTEGER UNSIGNED,
                                    pro INTEGER UNSIGNED,
                                    predmet VARCHAR(100),
                                    zprava TEXT,
                                    odeslano DATETIME,
                                    precteno DATETIME,
                                    otevreno BOOL,
                                    zobrazit BOOL);

                                  CREATE TABLE {$this->dbpredpona}skupina_odkazu (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    uzivatel INTEGER UNSIGNED,
                                    nazev VARCHAR(100),
                                    barva VARCHAR(20),
                                    komentar TEXT);

                                  CREATE TABLE {$this->dbpredpona}odkaz (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    skupina INTEGER UNSIGNED,
                                    link TEXT,
                                    komentar TEXT);

                                  CREATE TABLE {$this->dbpredpona}pozadi (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    uzivatel INTEGER UNSIGNED,
                                    url VARCHAR(300),
                                    barva VARCHAR(20));
                                  ", $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
          $result = $this->AdministraceObsahu();  //hlavni administrace
        break;

        case "{$this->idmodul}{$this->idtasktym}":  //tym
          //$result = $this->AdminVypisTym();
          $result = $this->AdministraceObsahuTym();
        break;

        case "{$this->idmodul}{$this->idtaskskup}": //skupina
          //$result = $this->AdminVypisSkupina();
          $result = $this->AdministraceObsahuSkupina();
        break;

        case "{$this->idmodul}{$this->idtaskproj}": //projekt
          //$result = $this->AdminVypisProjekt();
          $result = $this->AdministraceObsahuProjekt();
        break;

        case "{$this->idmodul}{$this->idtaskukol}": //ukol
          //$result = $this->AdminVypisUkol();
          $result = $this->AdministraceObsahuUkol();
        break;

        case "{$this->idmodul}{$this->idtaskkom}":  //komentar
          //$result = $this->AdminVypisKomentar();
          $result = $this->AdministraceObsahuKomentar();
        break;

        case "{$this->idmodul}{$this->idtaskuser}": //uzivatel
          //$result = $this->AdminVypisUzivatel();
          $result = $this->AdministraceObsahuUzivatel();
        break;

        case "{$this->idmodul}{$this->idtaskpost}": //posta
          //$result = $this->AdminVypisPosta();
          $result = $this->AdministraceObsahuPosta();
        break;

        case "{$this->idmodul}{$this->idtasklink}": //odkaz
          $result = $this->AdministraceObsahuOdkaz();
        break;

        case "{$this->idmodul}{$this->idtaskback}": //pozadi
          $result = $this->AdministraceObsahuPozadi();
        break;
      }
    }

    return $result;
  }




/*
  //tady ty funkce bud udelat na funkce se vsim vsuidy a nebo sjednotit!
  public function PridejTym()
  {
    //
  }

  public function UpravTym()
  {
    //
  }
*/




/**
 *
 * Vrati hodnotu z dazabaze
 *
 * @param sloupec nazev sloupce
 * @param databaze nazev databaze
 * @param id cislo radku
 * @return hodnota
 */
  private function NavratHodnoty($sloupec, $databaze, $id)
  {
    $result = "";
    settype($id, "integer");
    if ($res = $this->query("SELECT {$sloupec} vystup FROM {$this->dbpredpona}{$databaze} WHERE id={$id};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $result = $this->fetchObject($res)->vystup;
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
    if (!file_exists("{$this->dirpath}/{$this->pathscript}"))  //vytvoreni slozek na obrazky
    {
      mkdir("{$this->dirpath}/{$this->pathscript}", 0777);
    }

    $cesta = "{$this->dirpath}/script/ajax.js";  //js jde do slozky
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath);  //cesta php ajaxu zustava
      $u = fopen($cesta, "w");
      fwrite($u, $obsah);
      fclose($u);

      echo "vytvořeno: {$cesta}";
    }
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        $this->AdminVypisObsahu(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}&amp;co=addtym",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=addgrup",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=addproj",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}&amp;co=addtask",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}&amp;co=addcom",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}&amp;co=adduser",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskpost}&amp;co=addpost");

    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    if (!file_exists("{$this->dirpath}/{$this->pathpicture}"))  //vytvoreni slozek na obrazky
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->pathback}"))
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->pathback}", 0777);
    }

    if (file_exists("{$this->dirpath}/{$this->pathpicture}") &&
        !file_exists("{$this->dirpath}/{$this->pathpicture}/{$this->pathprofile}"))
    {
      mkdir("{$this->dirpath}/{$this->pathpicture}/{$this->pathprofile}", 0777);
    }

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        //???
      }
    }

    return $result;
  }

  private function AdminVypisObsahu()
  {
    $result = "nějaký hlavní výpis";

    return $result;
  }

/**
 *
 * Prida zadany tym uzivateli
 *
 * @param id id cislo uzivatele
 * @param tym cislo pridavaneho tymu
 */
  private function PridejTymUzivatele($id, $tym)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = $this->query("SELECT tym FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $zmena = false; //defaultne nemeni
          $data = $this->fetchObject($res); //nacte data
          $tymy = explode($this->oddeltym, $data->tym); //rozdelit podle oddelovace

          if (count($tymy) > 1)  //pokud je vic polozek jak 1
          {
            if (!in_array($tym, $tymy)) //pokud uz neni v poli pridany
            {
              $num = $tymy; //predani kopie do num
              $num[] = $tym;  //pridani na konec
              sort($num); //serazeni pole

              $ulozit = implode($this->oddeltym, $num); //slouceni

              $zmena = true;
            }
          }
            else
          { //ulozeni prvniho tymu
            if ($tymy[0] == "0")  //kdyz je v databazi 0
            {
              $ulozit = $tym; //ulozit nove cislo

              $zmena = true;
            }
              else
            {
              if ($tymy[0] != $tym) //kdyz se cislo v databazi nerovna novemu
              {
                $num[] = $tymy[0];  //udelani 2 rozmerneho pole
                $num[] = $tym;

                $ulozit = implode($this->oddeltym, $num); //slouceni

                $zmena = true;
              }
            }
          }

          if ($zmena)
          {
            $datum = date("Y-m-d H:i:s");
            if (!$this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET tym='{$ulozit}',
                                                                          upraveno='{$datum}'
                                                                          WHERE id={$id};
                                                                          ", $error))
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
    }
  }

  private function UpravTymUzivatele($id, $tym)
  {
    //
  }

  private function SmazatTymUzivatele($id, $tym)
  {
    //
  }

/**
 *
 * Vypise pole tymu ve kterych se vyskytuje uzivatel
 *
 * @param id id cislo uzivatele
 * @return pole cisel tymu
 */
  private function PoleTymUzivatele($id)
  {
    settype($id, "integer");
    $result = "";

    if ($id != 0)
    {
      if ($res = $this->query("SELECT tym FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $zmena = false; //defaultne nemeni
          $data = $this->fetchObject($res); //nacte data
          $result = explode($this->oddeltym, $data->tym); //rozdelit podle oddelovace
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
 * Funkce pro zobrazovani administrace tymu
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuTym()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_tym"],
                                        $this->AdminVypisTym());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addtym": //pridavani tymu - vytvoreni tymu, vytvari uzivatel!
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtym"],
                                              $this->absolutni_url,
                                              "{$this->dirpath}/script",
                                              $this->NavratHodnoty("login", "uzivatele", $id),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}");

          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $popis = $this->ChangeWrongChar($_POST["popis"]);

//kontrola duplicity! live + static

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              $id != 0)
          {
            $datum = date("Y-m-d H:i:s");
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}tym (id, nazev, zakladatel, popis, vznik) VALUES
                                  (NULL, '{$nazev}', {$id}, '{$popis}', '{$datum}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtym_hlaska"], $nazev);

              //jako zakladatel ma pravo na ucast v tomto tymu
              $this->PridejTymUzivatele($id, $this->lastInsertRowid());

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edittym": //editace tymu
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev, zakladatel, popis, vznik FROM {$this->dbpredpona}tym WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittym"],
                                                  $this->absolutni_url,
                                                  "{$this->dirpath}/script",
                                                  $data->nazev,
                                                  $this->NavratHodnoty("login", "uzivatele", $data->zakladatel),
                                                  $data->popis,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}");

              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $popis = $this->ChangeWrongChar($_POST["popis"]);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}tym SET nazev='{$nazev}',
                                                                        popis='{$popis}'
                                                                        WHERE id={$id};
                                                                        ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittym_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}");  //auto kliknuti
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

        case "deltym":  //mazani tymu
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}tym WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}tym WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_deltym_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}");  //auto kliknuti
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
 * Admin vypis tymu
 *
 * @return vypis tymu
 */
  private function AdminVypisTym()
  {
    $result = "";
    if ($res = $this->query("SELECT
                            t.id id,
                            t.nazev nazev,
                            u.login zakladatel,
                            t.popis popis,
                            t.vznik vznik
                            FROM {$this->dbpredpona}tym t, {$this->dbpredpona}uzivatele u
                            WHERE t.zakladatel=u.id
                            ORDER BY lower(t.nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_tym"],
                                              $data->id,
                                              $data->nazev,
                                              $data->zakladatel,
                                              $data->popis,
                                              $data->vznik,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}&amp;co=edittym&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}&amp;co=deltym&amp;id={$data->id}");
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
 * Select vypis tymu
 *
 * @param id id cislo uzivatele
 * @param select cislo oznacene polozky
 * @param adresa url pro navraceni na strejne misto
 * @return select s tymy
 */
  private function SelectTym($id, $select = NULL, $adresa, &$current_tym)
  {
    settype($id, "integer");
    settype($select, "integer");
    $tym = $this->PoleTymUzivatele($id);

    $vyber = implode(", ", $tym);

    $result = "";
    if ($res = $this->query("SELECT
                            t.id id,
                            t.nazev nazev,
                            u.login zakladatel,
                            t.popis popis,
                            t.vznik vznik
                            FROM {$this->dbpredpona}tym t, {$this->dbpredpona}uzivatele u
                            WHERE t.zakladatel=u.id AND
                            t.id IN ({$vyber})
                            ORDER BY lower(t.nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_tym_begin"], $adresa);

        $i = 0;
        while ($data = $this->fetchObject($res))
        {
          $current_tym = ($select == 0 ? ($i == 0 ? $data->id : $current_tym) : $select);

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_tym"],
                                              $data->id,
                                              ($data->id == $select ? " selected=\"selected\"" : ""),
                                              $data->nazev,
                                              $data->zakladatel,
                                              $data->popis,
                                              $data->vznik);
          $i++;
        }

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_tym_end"]);
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
 * Select vypis viditelnosti
 *
 * @param verejne cislo v poli
 * @return select s verejnosti (viditelnosti)
 */
  private function SelectViditelnost($verejne = NULL)
  {
    settype($verejne, "integer");
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_select_viditelnost_begin"]);

    for ($i = 0; $i < count($this->viditelnost_skupiny); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_viditelnost"],
                                          $i,
                                          ($i == $verejne ? " selected=\"selected\"" : ""),
                                          $this->viditelnost_skupiny[$i]);
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_viditelnost_end"]);

    return $result;
  }

/**
 *
 * Spocita pocet skupin pro daneho uzivatele a tym
 *
 * @param tym cislo tymu
 * @param uzivatel cislo uzivatele
 * @param inc automaticke zvysovani o...
 * @return pocet polozek
 */
  private function PocetRadkuSkupina($tym, $uzivatel, $inc = 0)
  {
    settype($tym, "integer");
    settype($uzivatel, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = $this->query("SELECT COUNT(id) pocet
                            FROM {$this->dbpredpona}skupina
                            WHERE
                            tym={$tym} AND
                            uzivatel={$uzivatel};
                            ", $error))
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
 * Funkce pro zobrazovani administrace skupiny
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuSkupina()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_skupina"],
                                        $this->absolutni_url,
                                        "{$this->dirpath}/script",
                                        $this->AdminVypisSkupina(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=addgrup");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addgrup": //pridavani skupin
          $id = $_GET["id"];  //cislo id uzivatele
          settype($id, "integer");

          $tym = $_GET["tym"];  //cislo tymu
          settype($tym, "integer");

          //vraci aktualni, ale vyuziva se tu jako prvni
          $select_tym = $this->SelectTym($id, $tym, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=addgrup&amp;id={$id}", $curr_tym);

          //prvni z prom, jinak z get
          $tym_1 = (!Empty($tym) ? $tym : $curr_tym);

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgrup"],
                                              $this->absolutni_url,
                                              "{$this->dirpath}/script",
                                              $select_tym,
                                              $this->NavratHodnoty("login", "uzivatele", $id),
                                              $this->SelectViditelnost(),
                                              $this->PocetRadkuSkupina($tym_1, $id, 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}");

          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $num_tym = $_POST["tym"];
          settype($num_tym, "integer");
          $num_uzivatel = $id;
          $num_verejne = $_POST["verejne"];
          settype($num_verejne, "integer");
          $popis = $this->ChangeWrongChar($_POST["popis"]);
          $num_poradi = $_POST["poradi"];
          settype($num_poradi, "integer");

//kontrola duplicity v ramci skupiny! live + static
//drag'n drop na skupiny

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              $num_tym != 0 &&
              $num_uzivatel != 0 && //jako id
              $num_verejne != 0 &&
              $num_poradi != 0)
          {
            $datum = date("Y-m-d H:i:s");
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}skupina (id, tym, uzivatel, verejne, nazev, popis, zalozeno, poradi) VALUES
                                  (NULL, {$num_tym}, {$num_uzivatel}, {$num_verejne}, '{$nazev}', '{$popis}', '{$datum}', {$num_poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addgrup_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editgrup":  //editace skupin
          $id = $_GET["id"];  //cislo id skupiny
          settype($id, "integer");

          $tym = $_GET["tym"];  //cislo tymu
          settype($tym, "integer");

          if ($res = $this->query("SELECT tym, uzivatel, verejne, nazev, popis, zalozeno, poradi FROM {$this->dbpredpona}skupina WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              //prvni z db, jinak z get
              $tym_1 = (!Empty($tym) ? $tym : $data->tym);

              //vraci aktualni, ale vyuziva se tu jako prvni
              $select_tym = $this->SelectTym($data->uzivatel, $tym_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=editgrup&amp;id={$id}", $curr_tym);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgrup"],
                                                  $this->absolutni_url,
                                                  "{$this->dirpath}/script",
                                                  $select_tym,
                                                  $this->NavratHodnoty("login", "uzivatele", $data->uzivatel),
                                                  $this->SelectViditelnost($data->verejne),
                                                  $data->nazev,
                                                  $data->popis,
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}");

              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $num_tym = $_POST["tym"];
              settype($num_tym, "integer");
              $num_uzivatel = $data->uzivatel;  //cislo uzivatele z db
              $num_verejne = $_POST["verejne"];
              settype($num_verejne, "integer");
              $popis = $this->ChangeWrongChar($_POST["popis"]);
              $num_poradi = $_POST["poradi"];
              settype($num_poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $num_tym != 0 &&
                  $num_uzivatel != 0 &&
                  $num_verejne != 0 &&
                  $num_poradi != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}skupina SET tym={$num_tym},
                                                                            uzivatel={$num_uzivatel},
                                                                            verejne={$num_verejne},
                                                                            nazev='{$nazev}',
                                                                            popis='{$popis}',
                                                                            poradi={$num_poradi}
                                                                            WHERE id={$id};
                                                                            ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editgrup_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}");  //auto kliknuti
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

        case "delgrup": //mazani skupin
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}skupina WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}skupina WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delgrup_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}");  //auto kliknuti
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
 * Admin vypis skupin
 *
 * @return vypis skupin
 */
  private function AdminVypisSkupina()
  {
    $result = "";
    //skupinovy vypis - po skupinach oddelovat vypisy pro drag'n drop
    if ($res = $this->query("SELECT
                            s.uzivatel uzivatel,
                            u.login login
                            FROM
                            {$this->dbpredpona}skupina s,
                            {$this->dbpredpona}uzivatele u
                            WHERE
                            s.uzivatel=u.id
                            GROUP BY uzivatel
                            ORDER BY lower(s.nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_begin"],
                                              $data->login,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=addgrup&amp;id={$data->uzivatel}");

          if ($res1 = $this->query("SELECT
                                    s.id id,
                                    s.poradi poradi,
                                    s.verejne verejne,
                                    s.nazev nazev,
                                    s.popis popis,
                                    u.login zakladatel,
                                    t.nazev tym,
                                    s.zalozeno vznik
                                    FROM
                                    {$this->dbpredpona}tym t,
                                    {$this->dbpredpona}uzivatele u,
                                    {$this->dbpredpona}skupina s
                                    WHERE
                                    s.tym=t.id AND
                                    s.uzivatel=u.id AND
                                    s.uzivatel={$data->uzivatel}
                                    ORDER BY lower(s.nazev) ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina"],
                                                    $data1->id,
                                                    $data1->poradi,
                                                    $this->viditelnost_skupiny[$data1->verejne],
                                                    $data1->nazev,
                                                    $data1->popis,
                                                    $data1->zakladatel,
                                                    $data1->tym,
                                                    $data1->vznik,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=editgrup&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=delgrup&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=addproj&amp;id={$data1->id}");
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
        else
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_skupina_null"]);
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
 * Spocita pocet radku pro dany projekt podle skupiny
 *
 * @param skupina cislo skupina
 * @param inc automaticke zvysovani o...
 * @return pocet polozek
 */
  private function PocetRadkuProjekt($skupina, $inc = 0)
  {
    settype($skupina, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = $this->query("SELECT COUNT(id) pocet
                            FROM {$this->dbpredpona}projekt
                            WHERE
                            skupina={$skupina};
                            ", $error))
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
 * Funkce pro zobrazovani administrace projektu
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuProjekt()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_projekt"],
                                        $this->absolutni_url,
                                        "{$this->dirpath}/script",
                                        $this->AdminVypisProjekt(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=addproj");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addproj": //pridavani projektu
          $id = $_GET["id"];  //cislo id skupina
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addproj"],
                                              $this->absolutni_url,
                                              "{$this->dirpath}/script",
                                              $this->NavratHodnoty("nazev", "skupina", $id),
                                              date("Y-m-d H:i:s"),
                                              $this->PocetRadkuProjekt($id, 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}");

          $num_skupina = $id; //z get
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $popis = $this->ChangeWrongChar($_POST["popis"]);
          $zadani = $this->ChangeWrongChar($_POST["zadani"]);
          $dokonceni = $this->ChangeWrongChar($_POST["dokonceni"]);
          $dokonceno = (!Empty($_POST["dokonceno"]) ? 1 : 0);
          $num_cena = $_POST["cena"];
          settype($num_cena, "integer");
          $num_narocnost = $_POST["narocnost"];
          settype($num_narocnost, "integer");
          $num_poradi = $_POST["poradi"];
          settype($num_poradi, "integer");

//kontrola duplicity v ramci skupiny! live + static
//drag'n drop na skupiny

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($zadani) &&
              $num_poradi != 0 &&
              $id != 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}projekt (id, skupina, nazev, popis, zadani, dokonceni, dokonceno, cena, narocnost, poradi) VALUES
                                  (NULL, {$num_skupina}, '{$nazev}', '{$popis}', '{$zadani}', '{$dokonceni}', {$dokonceno}, {$num_cena}, {$num_narocnost}, {$num_poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addproj_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editproj":  //editace projektu
          $id = $_GET["id"];  //cislo id skupiny
          settype($id, "integer");

          if ($res = $this->query("SELECT skupina, nazev, popis, zadani, dokonceni, dokonceno, cena, narocnost, poradi FROM {$this->dbpredpona}projekt WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editproj"],
                                                  $this->absolutni_url,
                                                  "{$this->dirpath}/script",
                                                  $this->NavratHodnoty("nazev", "skupina", $data->skupina),
                                                  $data->nazev,
                                                  $data->popis,
                                                  $data->zadani,
                                                  $data->dokonceni,
                                                  ($data->dokonceno ? " checked=\"checked\"" : ""),
                                                  $data->cena,
                                                  $data->narocnost,
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}");

              $num_skupina = $data->skupina;  //z db
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $popis = $this->ChangeWrongChar($_POST["popis"]);
              $zadani = $this->ChangeWrongChar($_POST["zadani"]);
              $dokonceni = $this->ChangeWrongChar($_POST["dokonceni"]);
              $dokonceno = (!Empty($_POST["dokonceno"]) ? 1 : 0);
              $num_cena = $_POST["cena"];
              settype($num_cena, "integer");
              $num_narocnost = $_POST["narocnost"];
              settype($num_narocnost, "integer");
              $num_poradi = $_POST["poradi"];
              settype($num_poradi, "integer");

//kontrola duplicity v ramci skupiny! live + static
//drag'n drop na skupiny

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  !Empty($zadani) &&
                  $num_poradi != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}projekt SET skupina={$num_skupina},
                                                                            nazev='{$nazev}',
                                                                            popis='{$popis}',
                                                                            zadani='{$zadani}',
                                                                            dokonceni='{$dokonceni}',
                                                                            dokonceno={$dokonceno},
                                                                            cena={$num_cena},
                                                                            narocnost={$num_narocnost},
                                                                            poradi={$num_poradi}
                                                                            WHERE id={$id};
                                                                            ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editproj_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}");  //auto kliknuti
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

        case "delproj": //mazani projektu
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}projekt WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}projekt WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delproj_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}");  //auto kliknuti
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
 * Admin vypis projektu
 *
 * @return vypis projektu
 */
  private function AdminVypisProjekt()
  {
    $result = "";
    //skupinovy vypis - po skupinach oddelovat vypisy pro drag'n drop
    if ($res = $this->query("SELECT
                            p.skupina skupina,
                            s.nazev nazev
                            FROM
                            {$this->dbpredpona}skupina s,
                            {$this->dbpredpona}projekt p
                            WHERE
                            p.skupina=s.id
                            GROUP BY p.skupina
                            ORDER BY lower(p.nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_projekt_begin"],
                                              $data->nazev,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=addproj&amp;id={$data->skupina}");

          if ($res1 = $this->query("SELECT
                                    p.id id,
                                    p.poradi poradi,
                                    s.nazev skupina,
                                    p.nazev nazev,
                                    p.popis popis,
                                    p.zadani zadani,
                                    p.dokonceni dokonceni,
                                    p.dokonceno dokonceno,
                                    p.cena cena,
                                    p.narocnost narocnost
                                    FROM
                                    {$this->dbpredpona}projekt p,
                                    {$this->dbpredpona}skupina s
                                    WHERE
                                    p.skupina=s.id AND
                                    p.skupina={$data->skupina}
                                    ORDER BY lower(p.nazev) ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_projekt"],
                                                    $data1->id,
                                                    $data1->poradi,
                                                    $data1->skupina,
                                                    $data1->nazev,
                                                    $data1->popis,
                                                    $data1->zadani,
                                                    $data1->dokonceni,
                                                    ($data1->dokonceno ? " checked=\"checked\"" : ""),
                                                    $data1->cena,
                                                    $data1->narocnost,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=editproj&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=delproj&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}&amp;co=addtask&amp;id={$data1->id}");
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_projekt_end"]);
        }
      }
        else
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_projekt_null"]);
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
 * Select vypis dulezitosti
 *
 * @param dulezitost cislo v poli
 * @return select dulezitosti
 */
  private function SelectDulezitost($dulezitost = NULL)
  {
    settype($dulezitost, "integer");
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_select_dulezitost_begin"]);

    for ($i = 0; $i < count($this->dulezitost_ukolu); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_dulezitost"],
                                          $i,
                                          ($i == $dulezitost ? " selected=\"selected\"" : ""),
                                          $this->dulezitost_ukolu[$i]);
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_select_dulezitost_end"]);

    return $result;
  }

/**
 *
 * Spocita pocet radku pro dany ukol podle projektu
 *
 * @param projekt cislo projektu
 * @param inc automaticke zvysovani o...
 * @return pocet polozek
 */
  private function PocetRadkuUkol($projekt, $inc = 0)
  {
    settype($projekt, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = $this->query("SELECT COUNT(id) pocet
                            FROM {$this->dbpredpona}tasks
                            WHERE
                            projekt={$projekt};
                            ", $error))
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
 * Funkce pro zobrazovani administrace ukolu
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuUkol()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_ukol"],
                                        $this->absolutni_url,
                                        "{$this->dirpath}/script",
                                        $this->AdminVypisUkol(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}&amp;co=addtask");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addtask": //pridavani uloh
          $id = $_GET["id"];  //cislo id projekt
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtask"],
                                              $this->absolutni_url,
                                              "{$this->dirpath}/script",
                                              $this->NavratHodnoty("nazev", "projekt", $id),
                                              date("Y-m-d H:i:s"),
                                              $this->SelectDulezitost(),
                                              $this->PocetRadkuUkol($id, 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}");
//http://acko.net/dev/farbtastic
          $num_projekt = $id; //z get
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $popis = $this->ChangeWrongChar($_POST["popis"]);
          $zadani = $this->ChangeWrongChar($_POST["zadani"]);
          $dokonceni = $this->ChangeWrongChar($_POST["dokonceni"]);
          $dokonceno = (!Empty($_POST["dokonceno"]) ? 1 : 0);
          $num_dulezitost = $_POST["dulezitost"];
          settype($num_dulezitost, "integer");
          $barva = $this->ChangeWrongChar($_POST["barva"]);
          $num_narocnost = $_POST["narocnost"];
          settype($num_narocnost, "integer");
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
          $num_poradi = $_POST["poradi"];
          settype($num_poradi, "integer");

//kontrola duplicity v ramci skupiny! live + static
//drag'n drop na skupiny

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($zadani) &&
              $num_dulezitost != 0 &&
              $num_poradi != 0 &&
              $id != 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}tasks (id, projekt, nazev, popis, zadani, dokonceni, dokonceno, dulezitost, barva, narocnost, zobrazit, poradi) VALUES
                                  (NULL, {$num_projekt}, '{$nazev}', '{$popis}', '{$zadani}', '{$dokonceni}', {$dokonceno}, {$num_dulezitost}, '{$barva}', {$num_narocnost}, {$zobrazit}, {$num_poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addtask_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "edittask":  //editace uloh
          $id = $_GET["id"];  //cislo id skupiny
          settype($id, "integer");

          if ($res = $this->query("SELECT projekt, nazev, popis, zadani, dokonceni, dokonceno, dulezitost, barva, narocnost, zobrazit, poradi FROM {$this->dbpredpona}tasks WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittask"],
                                                  $this->absolutni_url,
                                                  "{$this->dirpath}/script",
                                                  $this->NavratHodnoty("nazev", "projekt", $data->projekt),
                                                  $data->nazev,
                                                  $data->popis,
                                                  $data->zadani,
                                                  $data->dokonceni,
                                                  ($data->dokonceno ? " checked=\"checked\"" : ""),
                                                  $this->SelectDulezitost($data->dulezitost),
                                                  $data->barva,
                                                  $data->narocnost,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}");

              $num_projekt = $data->projekt; //z db
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $popis = $this->ChangeWrongChar($_POST["popis"]);
              $zadani = $this->ChangeWrongChar($_POST["zadani"]);
              $dokonceni = $this->ChangeWrongChar($_POST["dokonceni"]);
              $dokonceno = (!Empty($_POST["dokonceno"]) ? 1 : 0);
              $num_dulezitost = $_POST["dulezitost"];
              settype($num_dulezitost, "integer");
              $barva = $this->ChangeWrongChar($_POST["barva"]);
              $num_narocnost = $_POST["narocnost"];
              settype($num_narocnost, "integer");
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
              $num_poradi = $_POST["poradi"];
              settype($num_poradi, "integer");

//kontrola duplicity v ramci skupiny! live + static
//drag'n drop na skupiny

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  !Empty($zadani) &&
                  $num_dulezitost != 0 &&
                  $num_poradi != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}tasks SET projekt={$num_projekt},
                                                                          nazev='{$nazev}',
                                                                          popis='{$popis}',
                                                                          zadani='{$zadani}',
                                                                          dokonceni='{$dokonceni}',
                                                                          dokonceno={$dokonceno},
                                                                          dulezitost={$num_dulezitost},
                                                                          barva='{$barva}',
                                                                          narocnost={$num_narocnost},
                                                                          zobrazit={$zobrazit},
                                                                          poradi={$num_poradi}
                                                                          WHERE id={$id};
                                                                          ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edittask_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}");  //auto kliknuti
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

        case "deltask": //mazani uloh
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}tasks WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}tasks WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_deltask_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}");  //auto kliknuti
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
 * Admin vypis ukolu
 *
 * @return vypis ukolu
 */
  private function AdminVypisUkol()
  {
    $result = "";
    //skupinovy vypis - po skupinach oddelovat vypisy pro drag'n drop
    if ($res = $this->query("SELECT
                            t.projekt projekt,
                            p.nazev nazev
                            FROM
                            {$this->dbpredpona}tasks t,
                            {$this->dbpredpona}projekt p
                            WHERE
                            t.projekt=p.id
                            GROUP BY t.projekt
                            ORDER BY lower(t.nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_ukol_begin"],
                                              $data->nazev,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}&amp;co=addtask&amp;id={$data->projekt}");

          if ($res1 = $this->query("SELECT
                                    t.id id,
                                    t.poradi poradi,
                                    p.nazev skupina,
                                    t.nazev nazev,
                                    t.popis popis,
                                    t.zadani zadani,
                                    t.dokonceni dokonceni,
                                    t.dokonceno dokonceno,
                                    t.dulezitost dulezitost,
                                    t.barva barva,
                                    t.narocnost narocnost,
                                    t.zobrazit zobrazit
                                    FROM
                                    {$this->dbpredpona}projekt p,
                                    {$this->dbpredpona}tasks t
                                    WHERE
                                    t.projekt=p.id AND
                                    t.projekt={$data->projekt}
                                    ORDER BY lower(t.nazev) ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_ukol"],
                                                    $data1->id,
                                                    $data1->poradi,
                                                    $data1->skupina,
                                                    $data1->nazev,
                                                    $data1->popis,
                                                    $data1->zadani,
                                                    $data1->dokonceni,
                                                    ($data1->dokonceno ? " checked=\"checked\"" : ""),
                                                    $this->dulezitost_ukolu[$data1->dulezitost],
                                                    $data1->barva,
                                                    $data1->narocnost,
                                                    ($data1->zobrazit ? " checked=\"checked\"" : ""),
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskukol}&amp;co=edittask&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskproj}&amp;co=deltask&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}&amp;co=addcom&amp;id={$data1->id}&amp;zan=0");
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_ukol_end"]);
        }
      }
        else
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_ukol_null"]);
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
 * Funkce pro zobrazovani administrace komentaru
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuKomentar()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_komentar"],
                                        $this->AdminVypisKomentar(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}&amp;co=addcom");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addcom":  //pridavani komentaru
          $id = $_GET["id"];  //cislo id projekt
          settype($id, "integer");

          $zan = $_GET["zan"];  //cislo zanoreni
          settype($zan, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addcom"],
                                              $this->absolutni_url,
                                              $this->dirpath,
                                              $this->NavratHodnoty("nazev", "tasks", $id),
                                              $zan,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}");

          $num_tasks = $id; //z get
          $num_uzivatel = $_POST["uzivatel"];
          settype($num_uzivatel, "integer");
          $zprava = $this->ChangeWrongChar($_POST["zprava"]);
          $pridano = date("Y-m-d H:i:s");
          $num_zanoreni = $zan;
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
          $ip = $_SERVER["REMOTE_ADDR"];
          $agent = $_SERVER["HTTP_USER_AGENT"];

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($zprava) &&
              $num_uzivatel != 0 &&
              isset($_GET["zan"]) &&
              $id != 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}komentare (id, tasks, uzivatel, zprava, pridano, zanoreni, zobrazit, ip, agent) VALUES
                                  (NULL, {$num_tasks}, {$num_uzivatel}, '{$zprava}', '{$pridano}', {$num_zanoreni}, {$zobrazit}, '{$ip}', '{$agent}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addcom_hlaska"], $zprava);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editcom": //editace komentaru
          $id = $_GET["id"];  //cislo id skupiny
          settype($id, "integer");

          if ($res = $this->query("SELECT tasks, uzivatel, zprava, pridano, zanoreni, zobrazit FROM {$this->dbpredpona}komentare WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editcom"],
                                                  $this->absolutni_url,
                                                  $this->dirpath,
                                                  $this->NavratHodnoty("nazev", "tasks", $data->tasks),
                                                  $this->NavratHodnoty("login", "uzivatele", $data->uzivatel),
                                                  $data->uzivatel,
                                                  $data->zprava,
                                                  $data->pridano,
                                                  $data->zanoreni,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}");

              $num_tasks = $data->tasks; //z db
              $num_uzivatel = $_POST["uzivatel"];
              settype($num_uzivatel, "integer");
              $zprava = $this->ChangeWrongChar($_POST["zprava"]);
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($zprava) &&
                  $num_uzivatel != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}komentare SET tasks={$num_tasks},
                                                                              uzivatel={$num_uzivatel},
                                                                              zprava='{$zprava}',
                                                                              zobrazit={$zobrazit}
                                                                              WHERE id={$id};
                                                                              ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editcom_hlaska"], $zprava);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}");  //auto kliknuti
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

        case "delcom":  //mazani komentaru
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT zprava FROM {$this->dbpredpona}komentare WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}komentare WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delcom_hlaska"], $data->zprava);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}");  //auto kliknuti
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
 * Admin vypis komentaru
 *
 * @return vypis komentaru
 */
  private function AdminVypisKomentar()
  {
    $result = "";
    if ($res = $this->query("SELECT
                            k.id id,
                            k.tasks ukol,
                            u.login uzivatel,
                            k.zprava zprava,
                            k.pridano pridano,
                            k.zanoreni zanoreni,
                            k.zobrazit zobrazit,
                            k.ip ip,
                            k.agent agent
                            FROM
                            {$this->dbpredpona}komentare k,
                            {$this->dbpredpona}uzivatele u
                            WHERE
                            k.uzivatel=u.id
                            ORDER BY lower(k.pridano) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
          $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);
          $nextzan = $data->zanoreni + 1;

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_komentar"],
                                              $data->id,
                                              $data->zprava,
                                              $data->uzivatel,
                                              $data->pridano,
                                              $data->zanoreni,
                                              ($data->zobrazit ? " checked=\"checked\"" : ""),
                                              $data->ip,
                                              $browser,
                                              $os,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}&amp;co=editcom&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}&amp;co=delcom&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskkom}&amp;co=addcom&amp;id={$data->ukol}&amp;zan={$nextzan}");
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
 * Funkce pro zobrazovani administrace uzivatelu
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuUzivatel()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_uzivatel"],
                                        $this->AdminVypisUzivatel(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}&amp;co=adduser");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "adduser": //pridavani uzivatelu
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_adduser"],
                                              $this->absolutni_url,
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");

          //$tym = 0;// $_POST["tym"]; - zatim pujde jen vytvaret!
          //bude rozdelovat cislo tymu dle pridani a nebo vytvoreni!
          $jmeno = $this->ChangeWrongChar($_POST["jmeno"]);
          $prijmeni = $this->ChangeWrongChar($_POST["prijmeni"]);
          $login = $this->ChangeWrongChar($_POST["login"]);
          $heslo = md5(md5($_POST["heslo"]));
          $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);
          $popis = $this->ChangeWrongChar($_POST["popis"]);

          $ob = false;
          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $ob = $this->ZpracujObrazek($_FILES["obrazek"], $url, "profil");
          }

//kontrola duplicity! live + static
          $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);

          if (!Empty($_POST["tlacitko"]) &&
              //!Empty($_POST["tym"]) &&
              !Empty($jmeno) &&
              !Empty($login) &&
              !Empty($_POST["heslo"]) &&
              !Empty($email))
          {
            $datum = date("Y-m-d H:i:s");
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}uzivatele (id, tym, jmeno, prijmeni, login, heslo, email, popis, foto, zalozeno, upraveno, pocet, aktivni, nastaveni) VALUES
                                  (NULL, '0', '{$jmeno}', '{$prijmeni}', '{$login}', '{$heslo}', '{$email}', '{$popis}', '', '{$datum}', '', 0, {$aktivni}, '');", $error))
            {
              $navic = $this->SyncFileWithDB();
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_adduser_hlaska"], $login, $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "contym":  //pripojeni se k tymu
          $id = $_GET["id"];  //cislo id skupiny
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_contymuser"],
                                                  $this->absolutni_url,
                                                  $this->dirpath,
                                                  $this->NavratHodnoty("login", "uzivatele", $id),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");

          $num_tym = $_POST["tym"];
          settype($num_tym, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              $num_tym != 0 &&
              $id != 0)
          {
            //dopsat!!!
            //pouzit: pridat do tymu! + dopsat: konecne ten vypis tymu
/*
            if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET tym='{$tym}',
                                                                          jmeno='{$jmeno}',
                                                                          prijmeni='{$prijmeni}',
                                                                          login='{$login}',
                                                                          heslo='{$heslo}',
                                                                          email='{$email}',
                                                                          popis='{$popis}',
                                                                          foto='',
                                                                          upraveno='{$datum}',
                                                                          aktivni={$aktivni}
                                                                          WHERE id={$id};
                                                                          ", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edituser_hlaska"], $login);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
*/
          }
        break;

        case "edituser":  //editace uzivatelu
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT tym, jmeno, prijmeni, login, heslo, email, popis, foto, zalozeno, upraveno, pocet, aktivni, nastaveni FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edituser"],
                                                  $this->absolutni_url,
                                                  $this->dirpath,
                                                  $data->tym, //vypis tymu!
                                                  $data->jmeno,
                                                  $data->prijmeni,
                                                  $data->login,
                                                  $data->email,
                                                  $data->popis,
                                                  $data->foto,
                                                  ($data->aktivni ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");

//dodelat!!
              $tym = 0;// $_POST["tym"]; - zatim pujde jen vytvaret!
              //bude rozdelovat cislo tymu dle pridani a nebo vytvoreni!
              $jmeno = $this->ChangeWrongChar($_POST["jmeno"]);
              $prijmeni = $this->ChangeWrongChar($_POST["prijmeni"]);
              $login = $this->ChangeWrongChar($_POST["login"]);
              $heslo = (!Empty($_POST["heslo"]) ? md5(md5($_POST["heslo"])) : $data->heslo);
              $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);
              $popis = $this->ChangeWrongChar($_POST["popis"]);

              //fotka!!!!

              //snychronizace!

              $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($_POST["tym"]) &&
                  !Empty($jmeno) &&
                  !Empty($login) &&
                  //!Empty($_POST["heslo"]) &&
                  !Empty($email) &&
                  $id != 0)
              {
                $datum = date("Y-m-d H:i:s");
                if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET tym='{$tym}',
                                                                              jmeno='{$jmeno}',
                                                                              prijmeni='{$prijmeni}',
                                                                              login='{$login}',
                                                                              heslo='{$heslo}',
                                                                              email='{$email}',
                                                                              popis='{$popis}',
                                                                              foto='',
                                                                              upraveno='{$datum}',
                                                                              aktivni={$aktivni}
                                                                              WHERE id={$id};
                                                                              ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edituser_hlaska"], $login);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");  //auto kliknuti
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

        case "deluser": //mazani uzivatelu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT login FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_deluser_hlaska"], $data->login);
//dodelat!! musi vsechno tam kde je uzivatel obsazen
                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}");  //auto kliknuti
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
 * Admin vypis uzivatelu
 *
 * @return vypis uzivatelu
 */
  private function AdminVypisUzivatel()
  {
    $result = "";
    if ($res = $this->query("SELECT id, tym, jmeno, prijmeni, login, heslo, email, popis, foto, zalozeno, upraveno, pocet, aktivni, nastaveni FROM {$this->dbpredpona}uzivatele ORDER BY lower(login) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_uzivatel"],
                                              $data->id,
                                              $data->tym,
                                              $data->jmeno,
                                              $data->prijmeni,
                                              $data->login,
                                              $data->email,
                                              $data->foto,
                                              $data->zalozeno,
                                              $data->upraveno,
                                              $data->pocet,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}&amp;co=edituser&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}&amp;co=deluser&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskuser}&amp;co=contym&amp;id={$data->id}", //pripojeni k tymu
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasktym}&amp;co=addtym&amp;id={$data->id}",  //tym
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskskup}&amp;co=addgrup&amp;id={$data->id}",  //skupiny projektu
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskpost}&amp;co=addpost&amp;id={$data->id}", //posta
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=addlinkgroup&amp;id={$data->id}",  //skupina odkazu
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}&amp;co=addback&amp;id={$data->id}");  //pozadi
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
 * Funkce pro zobrazovani administrace posty
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuPosta()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_posta"],
                                        $this->AdminVypisPosta(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskpost}&amp;co=addpost");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addpost": //pridavani posty
          //INSERT INTO posta (id, od, pro, predmet, zprava, odeslano, precteno, otevreno, zobrazit) VALUES(
        break;

        case "editpost":  //editace posty
          //?????
        break;

        case "delpost": //mazani posty
          //
        break;
      }
    }

    return $result;
  }

/**
 *
 * Admin vypis posty
 *
 * @return vypis posty
 */
  private function AdminVypisPosta()
  {
    $result = "posta";

    return $result;
  }

/**
 *
 * Funkce pro zobrazovani administrace odkazu
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuOdkaz()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_odkaz"],
                                        $this->AdminVypisOdkaz(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=addlinkgroup");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addlinkgroup": //pridavani skupiny odkazu
          $id = $_GET["id"];  //cislo id uzivatele
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addlinkgroup"],
                                              $this->absolutni_url,
                                              $this->dirpath,
                                              $this->NavratHodnoty("login", "uzivatele", $id),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");

          $num_uzivatel = $id;
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $barva = $this->ChangeWrongChar($_POST["barva"]);
          $komentar = $this->ChangeWrongChar($_POST["popis"]);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              $num_uzivatel != 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}skupina_odkazu (id, uzivatel, nazev, barva, komentar) VALUES
                                  (NULL, {$num_uzivatel}, '{$nazev}', '{$barva}', '{$komentar}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addlinkgroup_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editlinkgroup":  //editace skupiny odkazu
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT uzivatel, nazev, barva, komentar FROM {$this->dbpredpona}skupina_odkazu WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editlinkgroup"],
                                                  $this->absolutni_url,
                                                  $this->dirpath,
                                                  $this->NavratHodnoty("login", "uzivatele", $data->uzivatel),
                                                  $data->nazev,
                                                  $data->barva,
                                                  $data->komentar,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");


              $num_uzivatel = $data->uzivatel;
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $barva = $this->ChangeWrongChar($_POST["barva"]);
              $komentar = $this->ChangeWrongChar($_POST["popis"]);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $num_uzivatel != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}skupina_odkazu SET uzivatel={$num_uzivatel},
                                                                                  nazev='{$nazev}',
                                                                                  barva='{$barva}',
                                                                                  komentar='{$komentar}'
                                                                                  WHERE id={$id};
                                                                                  ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editlinkgroup_hlaska"], $nazev);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");  //auto kliknuti
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

        case "dellinkgroup": //mazani skupiny odkazu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}skupina_odkazu WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}skupina_odkazu WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}odkaz WHERE skupina={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_dellinkgroup_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");  //auto kliknuti
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

        case "addlink": //pridavani odkazu
          $id = $_GET["id"];  //cislo id uzivatele
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addlink"],
                                              $this->absolutni_url,
                                              $this->dirpath,
                                              $this->NavratHodnoty("nazev", "skupina_odkazu", $id),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");

          $num_skupina = $id;
          $link = $this->ChangeWrongChar($_POST["nazev"]);
          $komentar = $this->ChangeWrongChar($_POST["popis"]);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($link) &&
              $num_skupina != 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}odkaz (id, skupina, link, komentar) VALUES
                                  (NULL, {$num_skupina}, '{$link}', '{$komentar}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addlink_hlaska"], $link);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editlink":  //editace odkazu
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT skupina, link, komentar FROM {$this->dbpredpona}odkaz WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editlink"],
                                                  $this->absolutni_url,
                                                  $this->dirpath,
                                                  $this->NavratHodnoty("nazev", "skupina_odkazu", $data->skupina),
                                                  $data->link,
                                                  $data->komentar,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");

              $num_skupina = $data->skupina;
              $link = $this->ChangeWrongChar($_POST["nazev"]);
              $komentar = $this->ChangeWrongChar($_POST["popis"]);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($link) &&
                  $num_skupina != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}odkaz SET skupina={$num_skupina},
                                                                          link='{$link}',
                                                                          komentar='{$komentar}'
                                                                          WHERE id={$id};
                                                                          ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editlink_hlaska"], $link);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");  //auto kliknuti
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

        case "dellink": //mazani odkazu
          $id = $_GET["id"];  //cislo linku
          settype($id, "integer");

          if ($res = $this->query("SELECT link FROM {$this->dbpredpona}odkaz WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}odkaz WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_dellink_hlaska"], $data->link);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}");  //auto kliknuti
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
 * Admin vypis odkazu
 *
 * @return vypis odkazu
 */
  private function AdminVypisOdkaz()
  {
    $result = "";
    if ($res = $this->query("SELECT
                            s.id id,
                            u.login login,
                            s.uzivatel uzivatel,
                            s.nazev nazev,
                            s.barva barva,
                            s.komentar komentar
                            FROM
                            {$this->dbpredpona}skupina_odkazu s,
                            {$this->dbpredpona}uzivatele u
                            WHERE
                            s.uzivatel=u.id
                            ORDER BY lower(s.nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_odkaz_begin"],
                                              $data->id,
                                              $data->login,
                                              $data->nazev,
                                              $data->barva,
                                              $data->komentar,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=editlinkgroup&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=dellinkgroup&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=addlinkgroup&amp;id={$data->uzivatel}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=addlink&amp;id={$data->id}");

          if ($res1 = $this->query("SELECT
                                    id,
                                    link,
                                    komentar
                                    FROM
                                    {$this->dbpredpona}odkaz o
                                    WHERE
                                    o.skupina={$data->id}
                                    ORDER BY lower(o.link) ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_odkaz"],
                                                    $data1->id,
                                                    $data1->link,
                                                    $data1->komentar,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=editlink&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtasklink}&amp;co=dellink&amp;id={$data1->id}");
              }
            }
              else
            {
              $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_odkaz_null"]);
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_odkaz_end"]);
        }
      }
        else
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_odkaz_group_null"]);
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
 * Kontroluje rozdily mezi databazi a filesystemem
 *
 */
  private function SyncFileWithDB()
  {
    if ($res = $this->query("SELECT url FROM {$this->dbpredpona}pozadi;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $i = 0;
        while ($data = $this->fetchObject($res))
        {
          $databaze[$i] = $data->url;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $j = 0;
    $cesta = "{$this->dirpath}/{$this->pathpicture}/{$this->pathback}";  //projiti miniatur
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
/*

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
*/

    $pocet1 = 0;
    if (count($databaze) != 0 &&  //mini
        count($mini) != 0)
    {
      $diff = array_diff($mini, $databaze); //vyhozeni rozdilu
      $diff = array_values($diff);  //oprava indexu
      $pocet1 = count($diff);

      for ($i = 0; $i < $pocet1; $i++)
      {
        chmod("{$this->dirpath}/{$this->pathpicture}/{$this->pathback}/{$diff[$i]}", 0777);
        unlink("{$this->dirpath}/{$this->pathpicture}/{$this->pathback}/{$diff[$i]}");
      }
    }

/*
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
*/

    $result = $pocet1 + $pocet2;

    return $result;
  }

/**
 *
 * Zpracovani obrazku
 *
 * @param tmp temp name obrazku
 * @param &obrazek pres parametr vraci jmeno obrazku
 * @return true/false - povedlo se / nepovedlo se
 */
  private function ZpracujObrazek($tmp, &$obrazek, $typ)
  {
    $result = true;
    list($old_w, $old_h) = getimagesize($tmp["tmp_name"]);

    $nazev = $this->VytvorJmenoObrazku();
    $roz = explode(".", $tmp["name"]);
    $pripona = $roz[count($roz) - 1];

    switch ($typ)
    {
      default:
      case "profil":
        $w_mini = $this->max_w[0];
        $h_mini = $this->max_h[0];

        if ($this->max_size[0] != 0 ? $tmp["size"] < (1024 * 1024 * $this->max_size[0]) : true)
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

          switch ($tmp["type"])
          {
            case "image/jpeg":
              $pripona = "jpg";
              ini_set("memory_limit", "100M");  //nasosne si vic mega
              $img_old = imagecreatefromjpeg($tmp["tmp_name"]);

              $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
              imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
              imagejpeg($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->pathprofile}/{$nazev}.{$pripona}", 100);
              imagedestroy($img_new);
            break;

            case "image/png":
              $pripona = "png";
              ini_set("memory_limit", "100M");  //nasosne si vic mega
              $img_old = imagecreatefrompng($tmp["tmp_name"]);

              $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
              imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
              imagepng($img_new, "{$this->dirpath}/{$this->pathpicture}/{$this->pathprofile}/{$nazev}.{$pripona}");
              imagedestroy($img_new);
            break;

            default:
              $result = false;
            break;
          }

          $obrazek = "{$nazev}.{$pripona}";
        }
      break;

      case "pozadi":
        if ($this->max_size[1] != 0 ? $tmp["size"] < (1024 * 1024 * $this->max_size[1]) : true)
        {
          if (!move_uploaded_file($tmp["tmp_name"], "{$this->dirpath}/{$this->pathpicture}/{$this->pathback}/{$nazev}.{$pripona}"))
          {
            $result = false;
          }

          $obrazek = "{$nazev}.{$pripona}";
        }
      break;
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
 * Funkce pro zobrazovani administrace odkazu
 *
 * @return administrativni rozhrani
 */
  private function AdministraceObsahuPozadi()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_pozadi"],
                                        $this->AdminVypisPozadi(),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}&amp;co=addback");

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addback": //pridavani pozadi
          $id = $_GET["id"];  //cislo id uzivatele
          settype($id, "integer");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addback"],
                                              $this->absolutni_url,
                                              $this->dirpath,
                                              $this->NavratHodnoty("login", "uzivatele", $id),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}");

          $ob = false;
          if (!Empty($_FILES["obrazek"]["tmp_name"]))
          {
            $ob = $this->ZpracujObrazek($_FILES["obrazek"], $url, "pozadi");
          }

          $num_uzivatel = $id;
          $barva = $this->ChangeWrongChar($_POST["barva"]);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($url) &&
              $num_uzivatel != 0 &&
              $ob)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}pozadi (id, uzivatel, url, barva) VALUES
                                  (NULL, {$num_uzivatel}, '{$url}', '{$barva}');", $error))
            {
              $navic = $this->SyncFileWithDB();
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addback_hlaska"], $url, $navic);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editback":  //editace pozadi
          $id = $_GET["id"];  //cislo
          settype($id, "integer");

          if ($res = $this->query("SELECT uzivatel, url, barva FROM {$this->dbpredpona}pozadi WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editback"],
                                                  $this->absolutni_url,
                                                  $this->dirpath,
                                                  $this->NavratHodnoty("login", "uzivatele", $data->uzivatel),
                                                  $data->url,
                                                  $data->barva,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}");

              $num_uzivatel = $data->uzivatel;
              $barva = $this->ChangeWrongChar($_POST["barva"]);

              if (!Empty($_FILES["obrazek"]["tmp_name"]))
              {
                $this->ZpracujObrazek($_FILES["obrazek"], $url, "pozadi");
              }
                else
              {
                $url = $data->url;
              }

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($url) &&
                  $num_uzivatel != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}pozadi SET uzivatel={$num_uzivatel},
                                                                          url='{$url}',
                                                                          barva='{$barva}'
                                                                          WHERE id={$id};
                                                                          ", $error))
                {
                  $navic = $this->SyncFileWithDB();
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editback_hlaska"], $url, $navic);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}");  //auto kliknuti
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

        case "delback": //mazani pozadi
          $id = $_GET["id"];  //cislo linku
          settype($id, "integer");

          if ($res = $this->query("SELECT url FROM {$this->dbpredpona}pozadi WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}pozadi WHERE id={$id};", $error)) //provedeni dotazu
              {
                $navic = $this->SyncFileWithDB();
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delback_hlaska"], $data->url, $navic);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}");  //auto kliknuti
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
 * Admin vypis pozadi
 *
 * @return vypis pozadi
 */
  private function AdminVypisPozadi()
  {
    $result = "";
    if ($res = $this->query("SELECT
                            p.id id,
                            u.login login,
                            p.url url,
                            p.barva barva
                            FROM
                            {$this->dbpredpona}pozadi p,
                            {$this->dbpredpona}uzivatele u
                            WHERE
                            p.uzivatel=u.id
                            ORDER BY
                            lower(u.login) ASC,
                            p.id ASC;
                            ", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_pozadi"],
                                              $data->id,
                                              $data->login,
                                              $data->url,
                                              $data->barva,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}&amp;co=editback&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idtaskback}&amp;co=delback&amp;id={$data->id}");  //pozadi
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
