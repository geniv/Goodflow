<?php

/**
 *
 * Blok dynamickeho prihlasovani
 *
 */

class DynamicLogin extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona, $mainindex;
  public $idmodul = "dynlogin";  //id pro rozliseni modulu v adminu
  private $idsortmenu = "_sortmenu";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php",
                        //"../../geoip/geoip.inc",
                        //"../../geoip/GeoIP.dat"
                        );
  public $generated = array("script/ajax.js"); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze

  private $vyhodnoceni = array("typ1...");
  private $expirace = array("+10 minutes" => "za 10 minut");

  private $hlavicka = "Content-type: text/html; charset=UTF-8";
  private $idget = "login";
  private $idautorizace = "autoriz";
  private $idreg = "idr";
  private $idstatus = "stats";
  private $ssid;  //nacitane id prohlizece

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

      $this->vyhodnoceni = $this->unikatni["set_vyhodnoceni"];
      $this->expirace = $this->unikatni["set_expirace"];

      $this->hlavicka = $this->unikatni["set_hlavicka"];
      $this->idget = $this->unikatni["set_idget"];
      $this->idautorizace = $this->unikatni["set_idautorizace"];
      $this->idreg = $this->unikatni["set_idreg"];
      $this->idstatus = $this->unikatni["set_idstatus"];

      $this->ssid = session_id(); //nacitani id prohlizace

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index);
      if (!$this->PripojeniDatabaze($error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $this->Instalace();

      $this->NastavitAdresuMenu($this->RozsiritAdminMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        $this->UmelyTitle(),
                                                        $this->idsortmenu)));
    }
  }
//dodelat!! - //vice urovnove menu!!
//akce: schovavat expiraci u typu bez expirace?!
//akce: zapinat/vypinat akce (moznost predchystat si akci, ale neukazovat ji [one check])
//volba typu kontoly duplicit (vypnuto, email, prohlizec, jmeno-prijmeni [multi check])
//ajaxem zneaktivnovat inputy pri registraci kdyz dojde kapacita
//pridat logovani i rozliseni a hloubky
//ukladani funkci na jmeno modulu a funkce ne na cislo a funkci!!!! to je neomalene!!!
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
          $result = (!Empty($adr[1]) ? $this->VypisObsahSkupny($adr[1]) : $this->AdministraceObsahu());
        break;

        case "{$this->idmodul}{$this->idsortmenu}": //razeni menu
          $result = $this->AdminiVypisRazeniMenu();
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
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}prihlasovani (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    nazev VARCHAR(200),
                                    adresa TEXT,
                                    modul VARCHAR(100) NULL,
                                    funkce VARCHAR(100) NULL,
                                    adresa_funkce TEXT,
                                    index_nazev INTEGER UNSIGNED,
                                    index_datum INTEGER UNSIGNED,
                                    index_popis INTEGER UNSIGNED,
                                    popis TEXT,
                                    idcaptcha INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}akce (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    prihlasovani INTEGER UNSIGNED,
                                    akceid INTEGER UNSIGNED,
                                    reg_begin DATETIME,
                                    reg_end DATETIME,
                                    prefix TEXT,
                                    typ_kontroly INTEGER UNSIGNED,
                                    kapacita INTEGER UNSIGNED,
                                    rezerva INTEGER UNSIGNED,
                                    expirace VARCHAR(50),
                                    autodel DATETIME,
                                    nazev VARCHAR(200),
                                    popis TEXT,
                                    href_id VARCHAR(200),
                                    href_class VARCHAR(200),
                                    href_akce VARCHAR(500),
                                    zobrazit BOOL,
                                    poradi INTEGER UNSIGNED);

                                  CREATE TABLE {$this->dbpredpona}registrace (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    akce INTEGER UNSIGNED,
                                    email VARCHAR(200),
                                    jmeno VARCHAR(100),
                                    prijmeni VARCHAR(100),
                                    identifikace TEXT,
                                    kontakt TEXT,
                                    zadano DATETIME,
                                    potvrzeno DATETIME,
                                    aktivni BOOL,
                                    ucast BOOL,
                                    ip VARCHAR(50),
                                    agent VARCHAR(300),
                                    session VARCHAR(100));", $error))
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
    if ($res = $this->query("SELECT id, nazev, href_id, href_class, href_akce, zobrazit FROM {$this->dbpredpona}akce ORDER BY poradi ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
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
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $adresa;
  }

/**
 *
 * Vygeneruje umely title dle zvolene sekce
 *
 * @return novy title do admin menu
 */
  private function UmelyTitle()
  {
    switch ($_GET["co"])
    {
      case "editprih":
        $result = $this->VypisHodnotu("nazev", "prihlasovani", $_GET["id"]);
      break;

      case "addakce":
        $result = $this->VypisHodnotu("nazev", "prihlasovani", $_GET["prih"]);
      break;

      case "editakce":
        $result = $this->VypisHodnotu("nazev", "akce", $_GET["id"]);
      break;

      case "infouser":
      case "edituser":
        $roz = explode("__", $_GET["ret"]);
        $result = $this->VypisHodnotu("nazev", "akce", $roz[1]);
      break;

      default:
        $result = $this->unikatni["admin_default_title"];
      break;
    }

    return $result;
  }

/**
 *
 * Automaticka kontrola mazani akci v prihlasovacim bloku
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicLogin", "KontrolaAutoMazani", "adresa");</strong>
 *
 * @param adresa adresa prihlasovaciho bloku
 * @return info o mazani
 */
  public function KontrolaAutoMazani($adresa)
  {
    $result = "";
    $idprihlaseni = $this->querySingle("SELECT id FROM {$this->dbpredpona}prihlasovani WHERE adresa='{$adresa}';");

    if ($res1 = $this->query("SELECT id, autodel FROM {$this->dbpredpona}akce WHERE prihlasovani={$idprihlaseni};", $error))
    {
      if ($this->numRows($res1) != 0)
      {
        $neaktivni = "";
        while ($data1 = $this->fetchObject($res1))
        {
          if ($data1->autodel != "1970-01-01 01:00:00" &&
              date("Y-m-d H:i:s") > $data1->autodel)
          {
            $neaktivni[] = $data1->id;
          }
            else
          {
            $result[] = $data1->autodel;
          }
        }
        $result[] = $neaktivni;

        if (!Empty($neaktivni) &&
            is_array($neaktivni))
        {
          $result = count($neaktivni);
          $del_id = implode(", ", $neaktivni);
          $this->querySingle("DELETE FROM {$this->dbpredpona}akce WHERE id IN ({$del_id});");
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
 * Generovani prefixu podle zadani
 *
 * @param prefix nastaveny text
 * @return nahodny prefix podle zadani
 */
  private function GenerujPrefix($prefix)
  {
    $result = "";
    $rozdel = explode("|", html_entity_decode($prefix, NULL, "UTF-8")); //prvni rozdeleni podle |, prevod > na spravny znak
    foreach ($rozdel as $row)
    {
      $randroz = explode("->", $row); //rozdel podle ->
      $result .= (count($randroz) == 2 ? rand($randroz[0], $randroz[1]) : $row);
    }

    return $result;
  }

/**
 *
 * Hlavni volani generovani prefixu, zaroven rekurzivne overuje jestli prefix neexituje v ramci vsech uzivatelu
 *
 * @param idakce id cislo akce
 * @param prefix zadany tvar prefixu
 * @return unikatni prefix kod
 */
  private function RekurzivniGenerovaniPrefix($idakce, $prefix)
  {
    $genprefix = $this->GenerujPrefix($prefix); //akce={$idakce} AND - musi byt uniktni v ramci vsech uzivatelu!
    $duplprefix = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE identifikace='{$genprefix}';");

    if ($duplprefix != 0)
    {
      $genprefix = $this->RekurzivniGenerovaniPrefix($idakce, $prefix);
    }

    return $genprefix;
  }

/**
 *
 * Formular vyberu a registrace
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicLogin", "DynamickaRegistrace", "adresa", $_GET["akceid"][, array("pridavek"), 1]);</strong>
 *
 * @param adresa adresa prihlasovaciho bloku
 * @param zobr_id_akce id akce ze zobrazeni
 * @param pridavek pridavne pole
 * @param tvar cislo tvaru
 * @return vypis nebo samotna registrace
 */
  public function DynamickaRegistrace($adresa, $zobr_id_akce, $pridavek = NULL, $tvar = 1)
  {
    settype($zobr_id_akce, "integer");

    $existence = $this->querySingle("SELECT id FROM {$this->dbpredpona}akce WHERE akceid={$zobr_id_akce};");
    settype($existence, "integer");

    $result = "";
    if ($zobr_id_akce > 0 &&
        $existence != 0)
    {
      if ($res = $this->query("SELECT id idprihlasovani, modul, funkce, adresa_funkce, idcaptcha
                              FROM {$this->dbpredpona}prihlasovani
                              WHERE
                              adresa='{$adresa}';", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $data = $this->fetchObject($res);

          //najde si id akce podle akceid cisla ze zobrazeni
          $idakce = $this->querySingle("SELECT id FROM {$this->dbpredpona}akce WHERE akceid={$zobr_id_akce} AND prihlasovani={$data->idprihlasovani};");
          //toto je sptravne id akce, id prihlasovani je ptakovina a akceid ze tobrazeni taky!!

          //kontrola expiraci ostatnich, obsluha vyexpirovanych uzivatelu
          $this->KontrolaExpirace($idakce);

          $trida = array ($data->modul,
                          $data->funkce);

          //pripojeni funkce
          $obsah = $this->VypisHodnotyVybraneTridy($trida, $data->adresa_funkce, $zobr_id_akce);

          $tvar_datum = $this->unikatni["normal_tvar_datum_{$tvar}"];
          $kapacita = $this->VypisHodnotu("kapacita", "akce", $idakce); //nacteni kapacity
          $rezerva = $this->VypisHodnotu("rezerva", "akce", $idakce); //nacteni rezervy

          //nacteni typu akce
          $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $idakce);

/*
          //pod zamkem musi kontrolovat kapacitu
          if ($this->beginTransaction($errortr))
          {
*/
            $ulozit = false;
            switch ($typ_kontroly)  //rozdeleni podle typu kontroly
            {
              case 0: //kontrola na aktivovane, kontroluje aktivovane
                $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND aktivni=1"); //secte aktivni

                if ($aktivnich < ($kapacita + $rezerva))
                {
                  $ulozit = true;
                }
                  else
                {
                  $res = $this->unikatni["normal_registrace_full_kapacita_{$tvar}"];
                }
              break;

              case 1: //kontrola na pridane, kontroluje pridane
                $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce}"); //secte vsechny pridane

                if ($aktivnich < ($kapacita + $rezerva))
                {
                  $ulozit = true;
                }
                  else
                {
                  $res = $this->unikatni["normal_registrace_full_kapacita_{$tvar}"];
                }
              break;
            } //end select

            $datumkonani = false;
            $reg_begin = $this->VypisHodnotu("reg_begin", "akce", $idakce);
            $reg_end = $this->VypisHodnotu("reg_end", "akce", $idakce);
            $nyni = date("Y-m-d H:i:s");
            if ($nyni >= $reg_begin &&
                $nyni <= $reg_end)
            {
              $datumkonani = true;
            }
              else
            {
              $res1 = $this->unikatni["normal_registrace_reg_datum_{$tvar}"];
            }

            //sam si nacte captchu
            $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $data->idcaptcha); //pro id 1
            $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $data->idcaptcha, $slovo);  //pro id 1 se slovem
            $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "UpravSlovo", $slovo);

            $doplnek = array ("array_args",
                              $this->absolutni_url,
                              $this->dirpath,
                              $idakce,
                              date($tvar_datum, strtotime($this->VypisHodnotu("reg_begin", "akce", $idakce))),
                              date($tvar_datum, strtotime($this->VypisHodnotu("reg_end", "akce", $idakce))),
                              $this->VypisHodnotu("typ_kontroly", "akce", $idakce),
                              ($kapacita + $rezerva),
                              (!$ulozit || !$datumkonani ? $this->unikatni["normal_registrace_css_skryvani_{$tvar}"] : ""), //8
                              (!$ulozit || !$datumkonani ? " disabled=\"disabled\"" : ""), //9
                              ($ulozit ? " name=\"registrace_email\"" : ""),  //10
                              ($ulozit ? " name=\"registrace_jmeno\"" : ""),
                              ($ulozit ? " name=\"registrace_prijmeni\"" : ""),
                              ($ulozit ? " name=\"registrace_captcha\"" : ""),
                              ($ulozit ? " name=\"registrace_submit\"" : ""),  //14
                              $data->idcaptcha,
                              $captcha,
                              $slovo
                              );

            if (is_array($obsah))
            {
              $doplnek = array_merge($doplnek, $obsah); //slouceni doplnku a obsahu
            }

            if (!Empty($pridavek) &&
                is_array($pridavek))
            {
              $doplnek = array_merge($doplnek, $pridavek); //slouceni pole, hlavni+pridavek
            }

            $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_registrace_{$tvar}"],
                                                $doplnek);

            $registrace_email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["registrace_email"]);
            $registrace_jmeno = $this->ChangeWrongChar($_POST["registrace_jmeno"], false);  //ulozeni bez entit
            $registrace_prijmeni = $this->ChangeWrongChar($_POST["registrace_prijmeni"], false);

            $pridavek = (is_array($_SESSION["slovo_{$data->idcaptcha}"]) ? "_solve" : "");
            if (count($_POST) == 0 || $_POST["registrace_captcha"] != $_SESSION["slovo_{$data->idcaptcha}{$pridavek}_vysledek"])
            {
              $_SESSION["slovo_{$data->idcaptcha}{$pridavek}_vysledek"] = $_SESSION["slovo_{$data->idcaptcha}{$pridavek}"];
            }

            $check = false;
            if (!Empty($_POST["registrace_captcha"]))
            {
              $check = ($_POST["registrace_captcha"] == $_SESSION["slovo_{$data->idcaptcha}{$pridavek}_vysledek"]);  //turinguv stroj rozliseni cloveka
            }

//$registrace_email = "geniv@geniv-asus";  //docasne nastaveno!

            $ip = $_SERVER["REMOTE_ADDR"];
            $agent = $_SERVER["HTTP_USER_AGENT"];

            //vyhleda pocet duplikatnich agentu ze stejne ip
            //$duplagent = ($this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND agent='{$agent}' AND ip='{$ip}' AND session='{$this->ssid}';") == 0);
            $duplagent = true;
            //vyhleda jestli uz uzivatel neexistuje
            $dupl_user = ($this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND email='{$registrace_email}' AND jmeno='{$registrace_jmeno}' AND prijmeni='{$registrace_prijmeni}';") == 0);
//$duplagent = true;

/*
            if (!$this->endTransaction($errortre)) //unlock konec transakce
            {
              $this->var->main[0]->ErrorMsg($errortre, array(__LINE__, __METHOD__));
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($errortr, array(__LINE__, __METHOD__));
          }
*/

          if (!Empty($_POST["registrace_submit"]) &&
              !Empty($registrace_email) &&
              !Empty($registrace_jmeno) &&
              !Empty($registrace_prijmeni) &&
              $check &&
              //$ulozit &&
              //$datumkonani &&
              $duplagent &&
              $dupl_user &&
              $idakce > 0)
          {
            if ($ulozit &&
                $datumkonani)
            {
              if ($this->beginTransaction($error))
              {
                $finulozit = false; //finalni kontrola kapacity
                switch ($typ_kontroly)  //rozdeleni podle typu kontroly
                {
                  case 0: //kontrola na aktivovane, kontroluje aktivovane
                    $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND aktivni=1;"); //secte aktivni

                    $finulozit = ($aktivnich < ($kapacita + $rezerva));
                  break;

                  case 1: //kontrola na pridane, kontroluje pridane
                    $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce};"); //secte vsechny pridane

                    $finulozit = ($aktivnich < ($kapacita + $rezerva));
                  break;
                } //end select

                $nowdate = date("Y-m-d H:i:s"); //presne datum, nyni
                $datum = date($tvar_datum, strtotime($nowdate));  //tvarovane datum, pouzite dal
                $expirace = date($tvar_datum, strtotime($this->VypisHodnotu("expirace", "akce", $idakce), strtotime($nowdate)));  //tvarovana expirace

                $zadano = $nowdate; //full datum pridani
                $identifikace = $this->RekurzivniGenerovaniPrefix($idakce, $this->VypisHodnotu("prefix", "akce", $idakce));
//drzet palce jestli to pri pristi registraci neselze!!
                if ($finulozit) //jeste jednou finalni kontrola kapacity
                {
                  if ($this->queryExec("INSERT INTO {$this->dbpredpona}registrace (id, akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, potvrzeno, aktivni, ucast, ip, agent, session) VALUES
                                        (NULL, {$idakce}, '{$registrace_email}', '{$registrace_jmeno}', '{$registrace_prijmeni}', '{$identifikace}', '', '{$zadano}', '', 0, 0, '{$ip}', '{$agent}', '{$this->ssid}');", $error))
                  {
                    $lastid = $this->lastInsertRowid();

                    $nahoda = array(array(100, 500),
                                    array(500, 1000),
                                    array(1000, 1500)
                                    );

                    foreach ($nahoda as $ran) //vygenerovani rady cisel
                    {
                      $nah[] = rand($ran[0], $ran[1]);
                    }

                    $linkact = $this->ZakodujText("{$nah[0]}:autorizace:prihlasovani:{$nah[1]}:lastid:{$lastid}:pridano:{$nah[2]}");

                    $header = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_email_header_{$typ_kontroly}_{$tvar}"],  //hlavicka
                                                        $this->hlavicka);

                    $predmet = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_email_subject_{$typ_kontroly}_{$tvar}"],
                                                        $this->OsetriJmeno($this->VypisNazevObsahZobrazeni($idakce)));

                    $zprava = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_email_text_{$typ_kontroly}_{$tvar}"],
                                                        $this->absolutni_url,
                                                        $this->dirpath,
                                                        $registrace_email,
                                                        $registrace_jmeno,
                                                        $registrace_prijmeni,
                                                        $datum,
                                                        $expirace,
                                                        ($this->var->htaccess ? "{$this->idautorizace}/{$linkact}" : "{$this->idget}={$this->idautorizace}&amp;{$this->idreg}={$linkact}"),
                                                        $this->VypisNazevObsahZobrazeni($idakce),
                                                        $identifikace);

                    if (!@mail($registrace_email, $predmet, $zprava, $header))
                    {
                      $result = $this->unikatni["normal_registrace_false_{$tvar}"];

                      $result .= $this->unikatni["normal_registrace_email_send_error_{$tvar}"];
                    }
                      else
                    {
                      $result = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_true_{$typ_kontroly}_{$tvar}"],
                                                        $registrace_email,
                                                        $registrace_jmeno,
                                                        $registrace_prijmeni,
                                                        $expirace);

                      if ($this->unikatni["normal_registrace_autoclick_{$typ_kontroly}_{$tvar}"])
                      {
                        $this->var->main[0]->AutoClick($this->unikatni["normal_registrace_autoclick_time_{$typ_kontroly}_{$tvar}"], $this->absolutni_url);  //auto kliknuti
                      }
                    }
                  }
                    else
                  {
                    $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                  }
                } //konec finalni kontroly kapacity

                if (!$this->endTransaction($error1)) //unlock ukladani
                {
                  $this->var->main[0]->ErrorMsg($error1, array(__LINE__, __METHOD__));
                }
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
              }
            } //end ulozit
              else
            {
              if (!$ulozit)
              {
                $result .= $res;
              }

              if (!$datumkonani)
              {
                $result .= $res1;
              }
            }
          }
            else
          {
            if (!Empty($_POST["registrace_submit"]))  //pri zmacknutem tlacitku
            {
              $result = $this->unikatni["normal_registrace_false_{$tvar}"];

              if (Empty($registrace_email))
              {
                $result .= $this->unikatni["normal_error_email_{$tvar}"];
              }

              if (Empty($registrace_jmeno))
              {
                $result .= $this->unikatni["normal_error_jmeno_{$tvar}"];
              }

              if (Empty($registrace_prijmeni))
              {
                $result .= $this->unikatni["normal_error_prijmeni_{$tvar}"];
              }

              if (!$check)
              {
                $result .= $this->unikatni["normal_error_captcha_{$tvar}"];
              }

              if (!$duplagent)
              {
                $result .= $this->unikatni["normal_error_duplikace_{$tvar}"];
              }

              if (!$dupl_user)
              {
                $result .= $this->unikatni["normal_error_duplikace_user_{$tvar}"];
              }
            }
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
      else
    { //vypis vsech registraci
      $tvar_datum = $this->unikatni["normal_tvar_datum_{$tvar}"];

      if ($res = $this->query("SELECT id idprihlasovani, modul, funkce, adresa_funkce
                              FROM {$this->dbpredpona}prihlasovani
                              WHERE
                              adresa='{$adresa}';", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $data = $this->fetchObject($res);

          $trida = array ($data->modul,
                          $data->funkce);

          $nyni = date("Y-m-d H:i:s");  //aktualni datum
          if ($res1 = $this->query("SELECT id, akceid, reg_begin, reg_end, typ_kontroly, kapacita, rezerva FROM {$this->dbpredpona}akce WHERE prihlasovani={$data->idprihlasovani} ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $obsah = $this->VypisHodnotyVybraneTridy($trida, $data->adresa_funkce, $data1->akceid);

                $suma = $data1->kapacita + $data1->rezerva;

                $kap = false;
                switch ($data1->typ_kontroly)
                {
                  case 0: //kontrola na aktivovane
                    $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$data1->id} AND aktivni=1"); //secte aktivni

                    $zbyva = $suma - $aktivnich;

                    if ($aktivnich < $suma)
                    {
                      $kap = true;
                    }
                  break;

                  case 1: //kontrola na pridane
                    $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$data1->id}"); //secte vsechny pridane

                    $zbyva = $suma - $aktivnich;

                    if ($aktivnich < $suma)
                    {
                      $kap = true;
                    }
                  break;
                }

                $dat = false;
                if ($nyni >= $data1->reg_begin &&
                    $nyni <= $data1->reg_end)
                {
                  $dat = true;
                  $datumkonani = $this->unikatni["normal_vypis_vsechny_registrace_reg_on_{$tvar}"];
                }
                  else
                {
                  $datumkonani = $this->unikatni["normal_vypis_vsechny_registrace_reg_off_{$tvar}"];//$this->NactiUnikatniObsah($this->unikatni["normal_registrace_reg_datum_{$tvar}"]);
                }

                $doplnek = array ("array_args",
                                  $this->absolutni_url,
                                  $this->dirpath,
                                  $data1->akceid,
                                  date($tvar_datum, strtotime($data1->reg_begin)),
                                  date($tvar_datum, strtotime($data1->reg_end)),
                                  $this->vyhodnoceni[$data1->typ_kontroly],
                                  $datumkonani,
                                  $data1->kapacita,
                                  $data1->rezerva,
                                  $suma,  //10
                                  $aktivnich,
                                  $zbyva,
                                  ($suma > $aktivnich ? $this->unikatni["normal_vypis_vsechny_registrace_open_{$tvar}"] :
                                                        $this->unikatni["normal_vypis_vsechny_registrace_close_{$tvar}"]),
                                  (!$kap || !$dat ? $this->unikatni["normal_vypis_vsechny_registrace_css_skryvani_{$tvar}"] : ""),
                                  (!$kap || !$dat ? " disabled=\"disabled\"" : "")
                                  );

                if (is_array($obsah))
                {
                  $doplnek = array_merge($doplnek, $obsah);
                }

                if (!Empty($pridavek) &&
                    is_array($pridavek))
                {
                  $doplnek = array_merge($doplnek, $pridavek); //slouceni pole, hlavni+pridavek
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_vsechny_registrace_{$tvar}"],
                                                    $doplnek);
              }
            }
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
    }

    return $result;
  }

/**
 *
 * Zjisteni statusu registrace
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicLogin", "StatusRegistrace"[, 1]);</strong>
 *
 * name: StatusRegistrace
 * @param tvar cislo tvaru
 * @return identifikacni prefix
 */
  public function StatusRegistrace($tvar = 1)
  {
    $result = "";
    $linkact = $_GET[$this->idreg];  //vezme z id
    $kod = explode(":", $this->DekodujText($linkact));
    $identifikace = $kod[5];

//"{$nah[0]}:statistika:prihlasovani:{$nah[1]}:identifikace:{$identifikace}:pridano:{$nah[2]}"
    if ($_GET[$this->idget] == $this->idstatus &&
        !Empty($linkact) &&
        !Empty($identifikace) &&
        $kod[1] == "statistika" &&
        $kod[2] == "prihlasovani" &&
        $kod[4] == "identifikace")
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_status_registrace_{$tvar}"],
                                          $identifikace);
    }

    return $result;
  }

/**
 *
 * Kontrola expirace uzivatelu
 *
 * @param idakce cislo id akce
 * @return pocet odmazanych
 */
  private function KontrolaExpirace($idakce)
  {
    settype($idakce, "integer");
    $result = 0;

    //kontrola cele akce na expiraci uzivatelu, obsluha vyexpirovanych uzivatelu
    $pocet_neaktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND aktivni=0;");
    $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $idakce);

    if ($pocet_neaktivnich > 0 &&
        $typ_kontroly == 0) //jen pri kontrole na aktivni uzivatele
    {
      $reg_begin = $this->VypisHodnotu("reg_begin", "akce", $idakce);
      $reg_end = $this->VypisHodnotu("reg_end", "akce", $idakce);
      $nyni = date("Y-m-d H:i:s");
      //expirace jen pri otevrene registraci
      if ($nyni >= $reg_begin &&
          $nyni <= $reg_end)
      {
        if ($res1 = $this->query("SELECT id, zadano FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND aktivni=0;", $error))
        {
          if ($this->numRows($res1) != 0)
          {
            $neaktivni = "";
            $exprtime = $this->VypisHodnotu("expirace", "akce", $idakce);
            while ($data1 = $this->fetchObject($res1))
            {
              if (date("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime($exprtime, strtotime($data1->zadano))))
              {
                $neaktivni[] = $data1->id;
              }
            }

            if (!Empty($neaktivni) &&
                is_array($neaktivni))
            {
              $result = count($neaktivni);
              $del_neaktivni = implode(", ", $neaktivni);
              $this->querySingle("DELETE FROM {$this->dbpredpona}registrace WHERE id IN ({$del_neaktivni});");
            }
          }
        }
          else
        {
          $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
      } //end datum kontrola
    }

    return $result;
  }

/**
 *
 * Autorizace registrace z linku v emailu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicLogin", "AutorizaceRegistrace"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return vysledek autorizace
 */
  public function AutorizaceRegistrace($tvar = 1)
  {
    $result = "";

    $linkact = $_GET[$this->idreg];  //vezme z id

    $kod = explode(":", $this->DekodujText($linkact));
    $lastid = $kod[5];
    settype($lastid, "integer");

//"{$nah[0]}:autorizace:prihlasovani:{$nah[1]}:lastid:{$lastid}:pridano:{$nah[2]}"
    if ($_GET[$this->idget] == $this->idautorizace &&
        !Empty($linkact) &&
        $lastid > 0 &&
        $kod[1] == "autorizace" &&
        $kod[2] == "prihlasovani" &&
        $kod[4] == "lastid")
    {
      $countid = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE id={$lastid} AND aktivni=0;"); //1 nebo 0
      settype($countid, "integer");

      if ($countid == 0)
      {
        //vyexpirovano, smazano, neexistuje, aktivovano
        $result = $this->unikatni["normal_error_autorizace_{$tvar}"];
      }
        else
      {
        $idakce = $this->VypisHodnotu("akce", "registrace", $lastid);

        $this->KontrolaExpirace($idakce); //kontrola expirace uzivatelu v akci

        $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $idakce);

        $tvar_datum = $this->unikatni["normal_tvar_datum_{$tvar}"];
        $kapacita = $this->VypisHodnotu("kapacita", "akce", $idakce);
        $rezerva = $this->VypisHodnotu("rezerva", "akce", $idakce);

        $identifikace = $this->VypisHodnotu("identifikace", "registrace", $lastid);
        $email = $this->VypisHodnotu("email", "registrace", $lastid);

        //kontrola obsahu pod zamkem
        if ($this->beginTransaction($error))
        {
          $ulozit = false;
          switch ($typ_kontroly)
          {
            case 0: //kontrola na aktivovane
              $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND aktivni=1"); //secte aktivni

              if ($aktivnich < ($kapacita + $rezerva))
              {
                $ulozit = true;
              }
                else
              {
                $res = $this->unikatni["normal_autorizace_full_kapacita_{$tvar}"];
              }
            break;

            case 1: //kontrola na pridane
              $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce}"); //secte vsechny pridane

              if ($aktivnich < ($kapacita + $rezerva))
              {
                $ulozit = true;
              }
                else
              {
                $res = $this->unikatni["normal_autorizace_full_kapacita_{$tvar}"];
              }
            break;
          }

          $datumkonani = false;
          $reg_begin = $this->VypisHodnotu("reg_begin", "akce", $idakce);
          $reg_end = $this->VypisHodnotu("reg_end", "akce", $idakce);
          $nyni = date("Y-m-d H:i:s");
          if ($nyni >= $reg_begin &&
              $nyni <= $reg_end)
          {
            $datumkonani = true;
          }
            else
          {
            $res1 = $this->unikatni["normal_autorizace_reg_datum_{$tvar}"];
          }

          if (!$this->endTransaction($error)) //unlock
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        }
          else
        {
          $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
        }

        if ($ulozit &&
            $datumkonani)
        {
          if ($this->beginTransaction($error))
          {
            $potvrzeno = date("Y-m-d H:i:s");

            if ($this->queryExec("UPDATE {$this->dbpredpona}registrace SET aktivni=1,
                                                                          potvrzeno='{$potvrzeno}'
                                                                          WHERE id={$lastid};", $error)) //provedeni dotazu
            {
              $nahoda = array(array(100, 500),
                              array(500, 1000),
                              array(1000, 1500)
                              );

              foreach ($nahoda as $ran) //vygenerovani rady cisel
              {
                $nah[] = rand($ran[0], $ran[1]);
              }

              $linkstat = $this->ZakodujText("{$nah[0]}:statistika:prihlasovani:{$nah[1]}:identifikace:{$identifikace}:pridano:{$nah[2]}");;

              $header = $this->NactiUnikatniObsah($this->unikatni["normal_autorizace_email_header_{$tvar}"],  //hlavicka
                                                  $this->hlavicka);

              $predmet = $this->NactiUnikatniObsah($this->unikatni["normal_autorizace_email_subject_{$tvar}"],
                                                  $this->OsetriJmeno($this->VypisNazevObsahZobrazeni($idakce)));

              $zprava = $this->NactiUnikatniObsah($this->unikatni["normal_autorizace_email_text_{$tvar}"],
                                                  $this->absolutni_url,
                                                  ($this->var->htaccess ? "{$this->idstatus}/{$linkstat}" : "{$this->idget}={$this->idstatus}&amp;{$this->idreg}={$linkstat}"),
                                                  date($tvar_datum, strtotime($potvrzeno)),
                                                  $identifikace,
                                                  $this->VypisNazevObsahZobrazeni($idakce));

              if (!@mail($email, $predmet, $zprava, $header))
              {
                $result = $this->unikatni["normal_autorizace_email_send_error_{$tvar}"];
              }
                else
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["normal_autorizace_true_{$tvar}"],
                                                    $identifikace);

                if ($this->unikatni["normal_autorizace_autoclick_{$tvar}"])
                {
                  $this->var->main[0]->AutoClick($this->unikatni["normal_autorizace_autoclick_time_{$tvar}"], $this->absolutni_url);  //auto kliknuti
                }
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }

            if (!$this->endTransaction($error)) //unlock
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        } //end ulozit
          else
        {
          if (!$ulozit)
          {
            $result .= $res;
          }

          if (!$datumkonani)
          {
            $result .= $res1;
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Osetruje nebezpecne znaky v nazvu
 *
 * @param jmeno nazev
 * @return osetreny nazev
 */
  private function OsetriJmeno($jmeno)
  {
    $prepis = $this->unikatni["set_prepis"];

    return strtr($jmeno, $prepis);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Vypise obsah registrace, univerzalni vypis
 *
 * @param id cislo id dane skupiny
 * @return obsah skupny s odkazy
 */
  private function VypisObsahSkupny($id)
  {
    settype($id, "integer");

    $this->VygenerujAjaxScript();

    $tvar_datum = $this->unikatni["admin_vypis_obsah_tvar_datum"];

    $kapacita = $this->VypisHodnotu("kapacita", "akce", $id);
    $rezerva = $this->VypisHodnotu("rezerva", "akce", $id);
    $suma = $kapacita + $rezerva;
    $celkem = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id}");
    $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $id);
    //$aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id} AND aktivni=1"); //secte aktivni
    //$aktivnich < ($kapacita + $rezerva)
    switch ($typ_kontroly)  //rozdeleni podle typu kontroly
    {
      case 0: //kontrola na aktivovane, kontroluje aktivovane
        $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id} AND aktivni=1"); //secte aktivni
      break;

      case 1: //kontrola na pridane, kontroluje pridane
        $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id}"); //secte vsechny pridane
      break;
    }

    $zbyva = $suma - $aktivnich;
    $expirace = $this->VypisHodnotu("expirace", "akce", $id);

    //vypocet poradi uzivatele
    $flipid = "";
    if ($idecka = $this->querySingle("SELECT id FROM {$this->dbpredpona}registrace WHERE akce={$id} ORDER BY zadano ASC;", false)) //vypise id v pridanem poradi
    {
      $flipid = array_flip($idecka);
    }

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_skupiny_begin"],
                                        $this->absolutni_url,
                                        $this->dirpath,
                                        $this->VypisHodnotu("nazev", "akce", $id),
                                        $this->vyhodnoceni[$typ_kontroly],
                                        $kapacita,
                                        $rezerva,
                                        $suma,
                                        $aktivnich,
                                        $celkem,  //9
                                        $zbyva, //10
                                        ($aktivnich < $suma ? ($celkem == $suma ? $this->unikatni["admin_vypis_obsah_skupiny_open_full"] :
                                                                                  $this->unikatni["admin_vypis_obsah_skupiny_open"]) :
                                                              ($aktivnich == $suma ? $this->unikatni["admin_vypis_obsah_skupiny_close_full"] :
                                                                                     $this->unikatni["admin_vypis_obsah_skupiny_close"])
                                                              ),
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=makepdf&amp;id={$id}",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delalluser&amp;id={$id}&amp;ret={$_GET[$this->var->get_idmodul]}",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=infoakce&amp;id={$id}&amp;ret={$_GET[$this->var->get_idmodul]}"
                                        );

    if ($res = $this->query("SELECT id, email, jmeno, prijmeni, identifikace, kontakt, zadano, potvrzeno, aktivni, ucast, ip
                            FROM {$this->dbpredpona}registrace
                            WHERE akce={$id}
                            ORDER BY LOWER(prijmeni) ASC, LOWER(jmeno) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_skupiny"],
                                              $data->id,
                                              $data->email,
                                              $data->jmeno,
                                              $data->prijmeni,
                                              $data->identifikace,
                                              $data->kontakt, //zatim nevyuzito
                                              date($tvar_datum, strtotime($data->zadano)),  //7
                                              date($tvar_datum, strtotime($expirace, strtotime($data->zadano))),  //8
                                              (!Empty($data->potvrzeno) && $data->potvrzeno != "0000-00-00 00:00:00" ? date($tvar_datum, strtotime($data->potvrzeno)) : ($typ_kontroly == 1 ? $this->unikatni["admin_vypis_obsah_noautoexpire"] : $this->unikatni["admin_vypis_obsah_noexpire"])),
                                              ($data->aktivni || $typ_kontroly == 1 ? " checked=\"checked\"" : ""), //10
                                              ($data->aktivni || $typ_kontroly == 1 ? $this->unikatni["admin_vypis_obsah_aktivni_true"] : $this->unikatni["admin_vypis_obsah_aktivni_false"]),  //11
                                              ($data->aktivni || $typ_kontroly == 1 ? "" : " disabled=\"disabled\""), //12
                                              ($data->ucast ? " checked=\"checked\"" : ""),
                                              ($data->ucast ? $this->unikatni["admin_vypis_obsah_ucast"] : ""),  //14
                                              $data->ip,  //15
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=infouser&amp;id={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edituser&amp;id={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}", //17
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deluser&amp;id={$data->id}&amp;ret={$_GET[$this->var->get_idmodul]}",
                                              $this->OsetriJmeno($data->jmeno),
                                              $this->OsetriJmeno($data->prijmeni),
                                              $flipid[$data->id] + 1
                                              );//html_entity_decode(, NULL, "UTF-8"), NULL, "UTF-8")
        }
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_obsah_skupiny_null"];
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->unikatni["admin_vypis_obsah_skupiny_end"];

    return $result;
  }

/**
 *
 * Overuje existenci skupiny
 *
 * @param nazev nazev skupiny
 * @return true/false - existuje / neexistuje
 */
  private function ExistujeAkce($nazev)
  {
    $result = false;
    if (!Empty($nazev))
    {
      if ($res = $this->query("SELECT id FROM {$this->dbpredpona}akce WHERE nazev='{$nazev}';", $error))
      {
        $result = ($this->numRows($res) == 1);
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
 * Vrati pocet radku v dane skupine
 *
 * @param skupina cislo skupiny prihlasovani
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($skupina, $inc = 0)
  {
    settype($skupina, "integer");
    settype($inc, "integer");

    $poc = $this->querySingle("SELECT COUNT(id) pocet FROM {$this->dbpredpona}akce WHERE prihlasovani={$skupina};");
    $result = (!is_null($poc) ? $poc + $inc : $inc);

    return $result;
  }

/**
 *
 * Select pro vyber prihlasovani
 *
 * @param id nepovinne urcuje oznacene id polozky
 * @return vyber prihlasovani
 */
  private function VyberPrihlasovani($id = NULL)
  {
    $result = "";
    if ($res = $this->query("SELECT id, adresa, nazev
                            FROM {$this->dbpredpona}prihlasovani
                            ORDER BY id ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $result = $this->unikatni["admin_vyber_prihlasovani_begin"];
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vyber_prihlasovani"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->nazev,
                                              $data->adresa);
        }
        $result .= $this->unikatni["admin_vyber_prihlasovani_end"];
      }
        else
      {
        $result = $this->unikatni["admin_vyber_prihlasovani_null"];
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
 * Vypisuje seznam typu vyhodnoceni
 *
 * @param id id polozky typu, nepovinne
 * @return select vyber vyhodnoceni
 */
  private function VyberTypuVyhodnoceni($id = NULL)
  {
    $result = $this->unikatni["admin_typvyhodnoceni_begin"];
    foreach ($this->vyhodnoceni as $index => $hodnota)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typvyhodnoceni"],
                                          $index,
                                          ($id == $index ? " selected=\"selected\"" : ""),
                                          $hodnota);
    }
    $result .= $this->unikatni["admin_typvyhodnoceni_end"];

    return $result;
  }

/**
 *
 * Vypisuje seznam delek expirace
 *
 * @param id id polozky typu, nepovinne
 * @return select vyberu delky expirace
 */
  private function VyberDelkyExpirace($id = NULL)
  {
    $typ = array_keys($this->expirace);

    $result = $this->unikatni["admin_delkaexpirace_begin"];

    $c_typ = count($typ);
    for ($i = 0; $i < $c_typ; $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_delkaexpirace"],
                                          $typ[$i],
                                          ($id == $typ[$i] ? " selected=\"selected\"" : ""),
                                          $this->expirace[$typ[$i]]);
    }
    $result .= $this->unikatni["admin_delkaexpirace_end"];

    return $result;
  }

/**
 *
 * Vypise seznam vsech trid a jejich public funkci
 *
 * @param id nazev tridy
 * @param nazev jmeno funkce
 * @return select s tridama a funkcema
 */
  private function SeznamTrid($id = NULL, $nazev = NULL)
  {
    $result = $this->unikatni["admin_seznam_trid_begin"];

    $funblok = $this->BlokovaneNazvyVypisu();

    for ($i = 0; $i < count($this->var->main); $i++)
    {
      $class = get_class($this->var->main[$i]);
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid_skupina_begin"],
                                          $class);

      if ($i != $this->mainindex) //vyblokovani vlastni funkce
      {
        //nacteni funkci
        $funkce = get_class_methods($this->var->main[$i]);
        for ($j = 0; $j < count($funkce); $j++)
        {
          if (!in_array($funkce[$j], $funblok)) //ignorace funkci
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_seznam_trid"],
                                                "{$class}:{$funkce[$j]}",
                                                ($class == $id && $funkce[$j] == $nazev ? " selected=\"selected\"" : ""),
                                                $funkce[$j]);
          }
        }
      }

      $result .= $this->unikatni["admin_seznam_trid_skupina_end"];
    }

    $result .= $this->unikatni["admin_seznam_trid_end"];

    return $result;
  }

/**
 *
 * Vypise obsah vybrane tridy
 *
 * @param trida pole indexu a funkce modulu
 * @param parametr parametr adresy pro arrayvystup
 * @param index_nazev cislo indexu kde se nachazi nazev
 * @param add true = trudavani, false = editace
 * @param adresa adresa pro presmerovani pri zmene id
 * @param id vybrane id
 * @return select vypis obsahu funkce
 */
  private function VypisVybraneTridy($trida, $parametr, $index_nazev, $add, $id, $adresa)
  {
    $ret = "";
    if (is_array($trida) &&
        //is_numeric($trida[0]) &&
        //!Empty($trida[1]) &&
        !Empty($parametr))
    {
      //$ret = call_user_func(array($trida[0], $trida[1]), $parametr); //0=index, 1=funkce
      $ret = $this->var->main[0]->NactiFunkci($trida, array($parametr));
    }

    if (is_array($ret))
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_tridy_begin"], $adresa);
      $index = $ret["id"];

      $akceid = array();
      if ($res = $this->query("SELECT akceid FROM {$this->dbpredpona}akce;", $error))
      {
        if ($this->numRows($res) != 0)
        {
          while ($data = $this->fetchObject($res))
          {
            $akceid[] = $data->akceid; //nacitani pouzitych id akci
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $c_index = count($index);
      for ($i = 0; $i < $c_index; $i++)
      {
        if ($add ? !in_array($index[$i], $akceid) : $id == $index[$i])
        {
          $nazev = $ret["obsah"][$i];
          //explode($ret["separator"], $ret["obsah"][$i][$index_nazev]);

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_tridy"],
                                              $index[$i],
                                              (!Empty($id) && $id == $index[$i] ? " selected=\"selected\"" : ""),
                                              $nazev[$index_nazev]);
        }
      }

      $result .= $this->unikatni["admin_vypis_tridy_end"];
    }
      else
    {
      $result = $this->unikatni["admin_vypis_tridy_error"];
    }

    return $result;
  }

/**
 *
 * @param trida pole indexu a funkce modulu
 * @param parametr parametr adresy pro arrayvystup
 * @param id vybrane id obsahu
 * @return pole hodnot obsahu
 */
  private function VypisHodnotyVybraneTridy($trida, $parametr, $id)
  {
    $ret = "";
    $result = "";
    if (is_array($trida) &&
        //is_numeric($trida[0]) &&
        //!Empty($trida[1]) &&
        !Empty($parametr))
    {
      $ret = $this->var->main[0]->NactiFunkci($trida, array($parametr));
      //call_user_func(array($this->var->main[$trida[0]], $trida[1]), $parametr); //0=index, 1=funkce
//var_dump($ret); //kua to musi spolu kominikonvat za kazdou cenu! vsichni!
      if (is_array($ret) &&
          !Empty($id))
      {
        $index = array_flip($ret["id"]);  //prohozeni indexu
        $result = $ret["obsah"][$index[$id]];
        //explode($ret["separator"], $ret["obsah"][$index[$id]]);
      }
    }

    return $result;
  }

/**
 *
 * Vypise nazev akce dle id akce
 *
 * @param idakce cislo akce
 * @return nazev akce
 */
  private function VypisNazevObsahZobrazeni($idakce)
  {
    $result = "";
    $idprihlaseni = $this->VypisHodnotu("prihlasovani", "akce", $idakce);
    $akceid = $this->VypisHodnotu("akceid", "akce", $idakce);

    //sahne si tabulky prihlasovani pro konfiguraci vystupu
    if ($res = $this->query("SELECT nazev, adresa, modul, funkce, adresa_funkce, index_nazev, index_datum, index_popis FROM {$this->dbpredpona}prihlasovani WHERE id={$idprihlaseni};", $error))
    {
      if ($this->numRows($res) == 1)
      {
        $data = $this->fetchObject($res);

        $trida = array($data->modul,
                      $data->funkce);

        $obsah = $this->VypisHodnotyVybraneTridy($trida, $data->adresa_funkce, $akceid);
//html_entity_decode($this->NactiUnikatniObsah($this->unikatni["set_nahled_text"]), NULL, "UTF-8")
        $result = html_entity_decode($obsah[$data->index_nazev], NULL, "UTF-8"); //vytahle obsah dle indexu akce
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
 * Vypocita rozdil datumu a vypise v danem formatu
 *
 * @param datum_end datum konce
 * @param datum_begin datum zacatku
 * @param format vystupni format
 * @return rozdil dat ve vystupnim formatu
 */
  private function VypocetRozdiluData($datum_end, $datum_begin, $format = "%yyyy %mm %dd %H:%M:%S")
  {
    $pracformat = "Y-n-j-H-i-s";
    $elem = explode("-", "%yyyy-%mm-%dd-%H-%M-%S");
    $begin = explode("-", date($pracformat, strtotime($datum_begin)));
    $end = explode("-", date($pracformat, strtotime($datum_end)));

    $result = $format;
    $c_begin = count($begin);
    for ($i = 0; $i < $c_begin; $i++)
    {
      $result = str_replace($elem[$i], abs($end[$i] - $begin[$i]), $result);
    }

    return $result;
  }

/**
 *
 * Vypis duplikatnich uzivatelu a jejich emailu
 *
 * @param id cislo akce
 * @return vypis duplikatnich
 */
  private function VypisDuplikatnichEmailu($id)
  {
    settype($id, "integer");
    $result = "";
    if ($pole = $this->queryMultiArraySingle("SELECT r1.id, r1.jmeno, r1.prijmeni, r1.email
                                              FROM {$this->dbpredpona}registrace r1, dynamiclogin_registrace r2
                                              WHERE
                                              r1.akce={$id} AND
                                              r2.akce={$id} AND
                                              r1.email=r2.email AND
                                              (r1.jmeno!=r2.jmeno AND r1.prijmeni!=r2.prijmeni)
                                              GROUP BY r1.id
                                              ORDER BY LOWER(r1.email) ASC,
                                                       LOWER(r1.prijmeni) ASC,
                                                       LOWER(r1.jmeno) ASC;", $error))
    {
      $result = $this->unikatni["admin_duplikace_email_begin"];

      foreach ($pole as $radek) //generovani radku
      {
        $hod = array_values($radek);  //vybrani hodnot
        $vypis = array("array_args"); //zacatek pole
        $vypis = array_merge($vypis, $hod); //slouceni pole

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_duplikace_email"],
                                            $vypis);
      }

      $result .= $this->unikatni["admin_duplikace_email_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_duplikace_email_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypis poctu prohlizecu
 *
 * @param id cislo akce
 * @return vypis prohlizecu
 */
  private function VypisPoctyProhlizecu($id)
  {
    settype($id, "integer");
    $result = "";
    if ($pole = $this->queryMultiArraySingle("SELECT agent
                                              FROM {$this->dbpredpona}registrace
                                              WHERE
                                              akce={$id};", $error))
    {
      $result = $this->unikatni["admin_pocty_brow_begin"];

      foreach ($pole as $radek) //zpracovani prohlizecu
      {
        $agent = array_values($radek);  //vybrani hodnot
        $browser[] = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $agent[0]);
      }

      $pocty = array_count_values($browser);  //spocitani hodnot
      arsort($pocty); //serazeni podle hodnoty reverzivne

      foreach ($pocty as $index => $radek) //generovani radku
      {
        $vypis = array ("array_args", //zacatek pole
                        $index,
                        $radek);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_pocty_brow"],
                                            $vypis);

      }

      $result .= $this->unikatni["admin_pocty_brow_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_pocty_brow_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypis poctu operacnich systemu
 *
 * @param id cislo akce
 * @return vypis operacnich systemu
 */
  private function VypisPoctyOs($id)
  {
    settype($id, "integer");
    $result = "";
    if ($pole = $this->queryMultiArraySingle("SELECT agent
                                              FROM {$this->dbpredpona}registrace
                                              WHERE
                                              akce={$id};", $error))
    {
      $result = $this->unikatni["admin_pocty_os_begin"];

      foreach ($pole as $radek) //zpracovani prohlizecu
      {
        $agent = array_values($radek);  //vybrani hodnot
        $os[] = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $agent[0]);
      }

      $pocty = array_count_values($os);  //spocitani hodnot
      arsort($pocty); //serazeni podle hodnoty reverzivne

      foreach ($pocty as $index => $radek) //generovani radku
      {
        $vypis = array ("array_args", //zacatek pole
                        $index,
                        $radek);

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_pocty_os"],
                                            $vypis);

      }

      $result .= $this->unikatni["admin_pocty_os_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_pocty_os_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypis operacnich systemu, prohlizecu a jejich poctu
 *
 * @param id cislo akce
 * @return vypis operacnich systemu a prohlizecu
 */
  private function VypisPoctyOsProhlizecu($id)
  {
    settype($id, "integer");
    $result = "";
    if ($res = $this->queryMultiObjectSingle("SELECT agent
                                              FROM {$this->dbpredpona}registrace
                                              WHERE akce={$id};", $error))
    {
      $result = $this->unikatni["admin_pocty_osbrow_begin"];
      //vygenerovani pole agentu
      $agent = "";
      foreach ($res as $data)
      {
        $agent[] = $data->agent;
      }

      $ret = $this->AlgPoctyOsProhlizecu($agent);
      foreach ($ret as $hodnota) //generovani radku
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_pocty_osbrow"],
                                            $hodnota["brow"], //prohlizec
                                            $hodnota["os"], //os
                                            $hodnota["count"]);

      }

      $result .= $this->unikatni["admin_pocty_osbrow_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_pocty_osbrow_null"];
      }
    }

    return $result;
  }

/**
 *
 * Vypis casu registrace
 *
 * @param id cislo akce
 * @return vypis casu
 */
  private function VypisProdlevyPrihlasovani($id)
  {
    settype($id, "integer");
    $result = "";
    if ($pole = $this->queryMultiArraySingle("SELECT COUNT(zadano), DATE_FORMAT(zadano, '%Y-%m-%d %H:%i')
                                              FROM {$this->dbpredpona}registrace
                                              WHERE
                                              akce={$id}
                                              GROUP BY DATE_FORMAT(zadano, '%Y-%m-%d %H:%i')
                                              ORDER BY zadano ASC;", $error))
    {
      $result = $this->unikatni["admin_prodlevy_begin"];

      $tvar_datum = $this->unikatni["admin_prodlevy_tvar_datum"];

      foreach ($pole as $radek) //generovani radku
      {
        $hod = array_values($radek);  //vybrani hodnot
        $vypis = array ("array_args", //zacatek pole
                        $hod[0],
                        date($tvar_datum, strtotime($hod[1])));

        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_prodlevy"],
                                            $vypis);

      }

      $result .= $this->unikatni["admin_prodlevy_end"];
    }
      else
    {
      if (!Empty($error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
        else
      {
        $result = $this->unikatni["admin_prodlevy_null"];
      }
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
    $cesta = "{$this->dirpath}/script/ajax.js";
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath,
                                        $this->unikatni["admin_vypis_obsah_ucast"]);
      if ($u = @fopen($cesta, "w"))
      {
        fwrite($u, $obsah);
        fclose($u);

        var_dump("vytvořeno: {$cesta}");
      }
        else
      {
        var_dump("nelze zapsat do: {$cesta}");
      }
    }
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
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addprih",
                                        $this->AdminVypisObsahu()
                                        );

    $co = $_GET["co"];

    $this->VygenerujAjaxScript();

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addprih": //pridavani prihlasovani
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addprih"],
                                              $this->SeznamTrid(),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"
                                              );

          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $adresa = $this->ChangeWrongChar($_POST["adresa"]);
          $rozdel = explode(":", $_POST["trida"]);
          $modul = $rozdel[0];
          //settype($modul, "integer");
          $funkce = $rozdel[1];
          $adresa_funkce = $this->ChangeWrongChar($_POST["adresa_funkce"]);
          $index_nazev = $_POST["index_nazev"];
          settype($index_nazev, "integer");
          $index_datum = $_POST["index_datum"];
          settype($index_datum, "integer");
          $index_popis = $_POST["index_popis"];
          settype($index_popis, "integer");
          $popis = $this->ChangeWrongChar($_POST["popis"]);
          $idcaptcha = $_POST["idcaptcha"];
          settype($idcaptcha, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev) &&
              !Empty($adresa) &&
              $idcaptcha > 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}prihlasovani (id, nazev, adresa, modul, funkce, adresa_funkce, index_nazev, index_datum, index_popis, popis, idcaptcha) VALUES
                                  (NULL, '{$nazev}', '{$adresa}', '{$modul}', '{$funkce}', '{$adresa_funkce}', {$index_nazev}, {$index_datum}, {$index_popis}, '{$popis}', {$idcaptcha});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addprih_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editprih":  //editaci prihlasovani
          $id = $_GET["id"];
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev, adresa, modul, funkce, adresa_funkce, index_nazev, index_datum, index_popis, idcaptcha, popis FROM {$this->dbpredpona}prihlasovani WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editprih"],
                                                  $data->nazev,
                                                  $data->adresa,
                                                  $this->SeznamTrid($data->modul, $data->funkce),
                                                  $data->adresa_funkce,
                                                  $data->index_nazev,
                                                  $data->index_datum,
                                                  $data->index_popis,
                                                  $data->idcaptcha,
                                                  $data->popis,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"
                                                  );

              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $adresa = $this->ChangeWrongChar($_POST["adresa"]);
              $rozdel = explode(":", $_POST["trida"]);
              $modul = $rozdel[0];
              //settype($modul, "integer");
              $funkce = $rozdel[1];
              $adresa_funkce = $this->ChangeWrongChar($_POST["adresa_funkce"]);
              $index_nazev = $_POST["index_nazev"];
              settype($index_nazev, "integer");
              $index_datum = $_POST["index_datum"];
              settype($index_datum, "integer");
              $index_popis = $_POST["index_popis"];
              settype($index_popis, "integer");
              $popis = $this->ChangeWrongChar($_POST["popis"]);
              $idcaptcha = $_POST["idcaptcha"];
              settype($idcaptcha, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  !Empty($adresa) &&
                  $idcaptcha > 0 &&
                  $id > 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}prihlasovani SET nazev='{$nazev}',
                                                                                adresa='{$adresa}',
                                                                                modul='{$modul}',
                                                                                funkce='{$funkce}',
                                                                                adresa_funkce='{$adresa_funkce}',
                                                                                index_nazev={$index_nazev},
                                                                                index_datum={$index_datum},
                                                                                index_popis={$index_popis},
                                                                                idcaptcha={$idcaptcha},
                                                                                popis='{$popis}'
                                                                                WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editprih_hlaska"], $nazev);

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

        case "delprih": //mazani prihlasovani
          $id = $_GET["id"];
          settype($id, "integer");
          //$id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}prihlasovani WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $idakce = $this->querySingle("SELECT id FROM {$this->dbpredpona}akce WHERE prihlasovani={$id};");
              settype($idakce, "integer");

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}prihlasovani WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}akce WHERE prihlasovani={$id};
                                    DELETE FROM {$this->dbpredpona}registrace WHERE akce={$idakce};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delprih_hlaska"], $data->nazev);

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

        case "addakce": //pridavani akce
          $prih = $_GET["prih"];
          settype($prih, "integer");

          $akceid = $_GET["akceid"];
          settype($akceid, "integer");

          $trida = array($this->VypisHodnotu("modul", "prihlasovani", $prih),
                        $this->VypisHodnotu("funkce", "prihlasovani", $prih));

          $adresa = $this->VypisHodnotu("adresa_funkce", "prihlasovani", $prih);
          $index_nazev = $this->VypisHodnotu("index_nazev", "prihlasovani", $prih);
          $index_datum = $this->VypisHodnotu("index_datum", "prihlasovani", $prih);
          $index_popis = $this->VypisHodnotu("index_popis", "prihlasovani", $prih);
          $obsah = $this->VypisHodnotyVybraneTridy($trida, $adresa, $akceid);

          $tvar_datum = $this->unikatni["admin_addedit_tvar_datum"];
          $defposun_datum_end = $this->unikatni["admin_defposun_datum_end"];
          $defposun_datum_autodel = $this->unikatni["admin_defposun_datum_autodel"];

          $deftvar_prefix = $this->unikatni["admin_deftvar_prefix"];

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addakce"],
                                              $this->dirpath,
                                              $this->VypisHodnotu("nazev", "prihlasovani", $prih),
                                              $this->VyberPrihlasovani($prih),
                                              $this->VypisVybraneTridy($trida, $adresa, $index_nazev, true, $akceid, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addakce&amp;prih={$prih}"),
                                              $obsah[$index_nazev],
                                              (!Empty($obsah[$index_datum]) ? date($tvar_datum, strtotime($obsah[$index_datum])) : ""),
                                              $obsah[$index_popis],
                                              date($tvar_datum),  //begin
                                              date($tvar_datum, strtotime($defposun_datum_end)),  //end
                                              $deftvar_prefix,
                                              $this->VyberTypuVyhodnoceni(),
                                              $this->VyberDelkyExpirace(),
                                              (!Empty($obsah[$index_datum]) ? date($tvar_datum, strtotime($defposun_datum_autodel, strtotime($obsah[$index_datum]))) : ""),  //x dni od reg_end
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"
                                              );

          $prihlasovani = $_POST["prihlasovani"];
          settype($prihlasovani, "integer");
          //$akceid
          $reg_begin = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["reg_begin"])));
          $reg_end = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["reg_end"])));
          $prefix = $this->ChangeWrongChar($_POST["prefix"]);
          $typ_kontroly = $_POST["typ_kontroly"];
          $kapacita = $_POST["kapacita"];
          settype($kapacita, "integer");
          $rezerva = $_POST["rezerva"];
          settype($rezerva, "integer");
          $expirace = $this->ChangeWrongChar($_POST["expirace"]);
          $autodel = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["autodel"])));
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $popis = $this->ChangeWrongChar($_POST["popis"]);
          $href_id = $this->ChangeWrongChar($_POST["href_id"]);
          $href_class = $this->ChangeWrongChar($_POST["href_class"]);
          $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
          $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
          $poradi = $this->PocetRadku($prih, 1);

          if (!Empty($_POST["tlacitko"]) &&
              $akceid > 0 &&
              !Empty($_POST["reg_begin"]) &&
              !Empty($_POST["reg_end"]) &&
              !Empty($prefix) &&
              $kapacita > 0 &&
              !Empty($nazev) &&
              !$this->ExistujeAkce($nazev) &&
              $prihlasovani != 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}akce (id, prihlasovani, akceid, reg_begin, reg_end, prefix, typ_kontroly, kapacita, rezerva, expirace, autodel, nazev, popis, href_id, href_class, href_akce, zobrazit, poradi) VALUES
                                  (NULL, {$prihlasovani}, {$akceid}, '{$reg_begin}', '{$reg_end}', '{$prefix}', {$typ_kontroly}, {$kapacita}, {$rezerva}, '{$expirace}', '{$autodel}', '{$nazev}', '{$popis}', '{$href_id}', '{$href_class}', '{$href_akce}', {$zobrazit}, {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addakce_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editakce":  //uprava akce
          $id = $_GET["id"];
          settype($id, "integer");

          $akceid = $_GET["akceid"];
          settype($akceid, "integer");

          if ($res = $this->query("SELECT prihlasovani, akceid, reg_begin, reg_end, prefix, typ_kontroly, kapacita, rezerva, expirace, autodel, nazev, popis, href_id, href_class, href_akce, zobrazit, poradi FROM {$this->dbpredpona}akce WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $akceid_1 = (isset($_GET["akceid"]) ? $akceid : $data->akceid);

              $trida = array($this->VypisHodnotu("modul", "prihlasovani", $data->prihlasovani),
                            $this->VypisHodnotu("funkce", "prihlasovani", $data->prihlasovani));

              $adresa = $this->VypisHodnotu("adresa_funkce", "prihlasovani", $data->prihlasovani);
              $index_nazev = $this->VypisHodnotu("index_nazev", "prihlasovani", $data->prihlasovani);
              $index_datum = $this->VypisHodnotu("index_datum", "prihlasovani", $data->prihlasovani);
              $index_popis = $this->VypisHodnotu("index_popis", "prihlasovani", $data->prihlasovani);
              $obsah = $this->VypisHodnotyVybraneTridy($trida, $adresa, $akceid_1);

              $tvar_datum = $this->unikatni["admin_addedit_tvar_datum"];

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editakce"],
                                                  $this->dirpath,
                                                  $this->VypisHodnotu("nazev", "prihlasovani", $data->prihlasovani),
                                                  $this->VyberPrihlasovani($data->prihlasovani),
                                                  $this->VypisVybraneTridy($trida, $adresa, $index_nazev, false, $akceid_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editakce&amp;id={$id}"),
                                                  $obsah[$index_nazev],
                                                  date($tvar_datum, strtotime($obsah[$index_datum])),
                                                  $obsah[$index_popis],
                                                  date($tvar_datum, strtotime($data->reg_begin)),
                                                  date($tvar_datum, strtotime($data->reg_end)), //9
                                                  $data->prefix,
                                                  $this->VyberTypuVyhodnoceni($data->typ_kontroly),
                                                  $data->kapacita,  //12
                                                  $data->rezerva,
                                                  $this->VyberDelkyExpirace($data->expirace),
                                                  ($data->autodel != "1970-01-01 01:00:00" ? date($tvar_datum, strtotime($data->autodel)) : ""), //15
                                                  $data->nazev,
                                                  $data->popis,
                                                  $data->href_id,
                                                  $data->href_class,
                                                  $data->href_akce,
                                                  ($data->zobrazit ? " checked=\"checked\"" : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}"
                                                  );

              $prihlasovani = $_POST["prihlasovani"];
              settype($prihlasovani, "integer");
              $akceid = $akceid_1;
              $reg_begin = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["reg_begin"])));
              $reg_end = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["reg_end"])));
              $prefix = $this->ChangeWrongChar($_POST["prefix"]);
              $typ_kontroly = $_POST["typ_kontroly"];
              $kapacita = $_POST["kapacita"];
              settype($kapacita, "integer");
              $rezerva = $_POST["rezerva"];
              settype($rezerva, "integer");
              $expirace = $this->ChangeWrongChar($_POST["expirace"]);
              $autodel = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["autodel"])));
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $popis = $this->ChangeWrongChar($_POST["popis"]);
              $href_id = $this->ChangeWrongChar($_POST["href_id"]);
              $href_class = $this->ChangeWrongChar($_POST["href_class"]);
              $href_akce = $this->ChangeWrongChar($_POST["href_akce"]);
              $zobrazit = (!Empty($_POST["zobrazit"]) ? 1 : 0);
              //$poradi = $this->PocetRadku($prih, 1);

              if (!Empty($_POST["tlacitko"]) &&
                  $akceid > 0 &&
                  !Empty($_POST["reg_begin"]) &&
                  !Empty($_POST["reg_end"]) &&
                  !Empty($prefix) &&
                  $kapacita > 0 &&
                  !Empty($nazev) &&
                  //!$this->ExistujeAkce($nazev) &&
                  $prihlasovani != 0 &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}akce SET prihlasovani={$prihlasovani},
                                                                        akceid={$akceid},
                                                                        reg_begin='{$reg_begin}',
                                                                        reg_end='{$reg_end}',
                                                                        prefix='{$prefix}',
                                                                        typ_kontroly={$typ_kontroly},
                                                                        kapacita={$kapacita},
                                                                        rezerva={$rezerva},
                                                                        expirace='{$expirace}',
                                                                        autodel='{$autodel}',
                                                                        nazev='{$nazev}',
                                                                        popis='{$popis}',
                                                                        href_id='{$href_id}',
                                                                        href_class='{$href_class}',
                                                                        href_akce='{$href_akce}',
                                                                        zobrazit={$zobrazit}
                                                                        WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editakce_hlaska"], $nazev);

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

        case "delakce": //mazani akce
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");
          //$id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}akce WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}akce WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}registrace WHERE akce={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delakce_hlaska"], $data->nazev);

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

        case "makepdf": //tvorba pdf z akci
          $id = $_GET["id"];  //id akce
          settype($id, "integer");

          $tvar_datum = $this->unikatni["admin_pdf_tvar_datum"];

          $kapacita = $this->VypisHodnotu("kapacita", "akce", $id);
          $rezerva = $this->VypisHodnotu("rezerva", "akce", $id);
          $suma = $kapacita + $rezerva;
          $celkem = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id}");
          $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $id);
          //$aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id} AND aktivni=1"); //secte aktivni

          switch ($typ_kontroly)  //rozdeleni podle typu kontroly
          {
            case 0: //kontrola na aktivovane, kontroluje aktivovane
              $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id} AND aktivni=1"); //secte aktivni
            break;

            case 1: //kontrola na pridane, kontroluje pridane
              $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$id}"); //secte vsechny pridane
            break;
          }

          $zbyva = $suma - $aktivnich;
          $expirace = $this->VypisHodnotu("expirace", "akce", $id);

          $vypis = array("array_args",
                        $this->absolutni_url,
                        $id,
                        $this->VypisNazevObsahZobrazeni($id),
                        $this->vyhodnoceni[$typ_kontroly],
                        $kapacita,
                        $rezerva,
                        $suma,
                        $aktivnich,
                        $celkem,  //9
                        ($aktivnich < $suma ? ($celkem == $suma ? $this->unikatni["admin_pdf_vypis_open_full"] :
                                                                  $this->unikatni["admin_pdf_vypis_open"]) :
                                              ($aktivnich == $suma ? $this->unikatni["admin_pdf_vypis_close_full"] :
                                                                     $this->unikatni["admin_pdf_vypis_close"])
                                              ),
                        $zbyva);

          //vypocet poradi uzivatele
          $flipid = "";
          if ($idecka = $this->querySingle("SELECT id FROM {$this->dbpredpona}registrace WHERE akce={$id} ORDER BY zadano ASC;", false)) //vypise id v pridanem poradi
          {
            $flipid = array_flip($idecka);
          }

          $ret = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_begin"],
                                          $vypis);

          if ($res = $this->query("SELECT id, email, jmeno, prijmeni, identifikace,
                                  kontakt, zadano, potvrzeno, aktivni, ucast, ip, agent
                                  FROM {$this->dbpredpona}registrace
                                  WHERE
                                  akce={$id}
                                  ORDER BY LOWER(prijmeni) ASC, LOWER(jmeno) ASC;
                                  ", $error))
          {
            if ($this->numRows($res) != 0)
            {
              $i = 0; //pocitadlo radku na strance
              $str = 1; //pocitadlo stranek

              $prvni = $this->unikatni["admin_pdf_page_first"];
              $ostatni = $this->unikatni["admin_pdf_page_other"];

              while ($data = $this->fetchObject($res))
              {
                if ($this->unikatni["admin_pdf_browseros"]) //zapinani prohlizecu
                {
                  $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
                  $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);
                }

                $pagebreak = false; //normalne vypnuty break
                if ($str == 1 && $i == $prvni)
                {
                  $i = 0; //vynulovani pocitadla radku na strance
                  $str++; //pocitadlo stranek
                  $pagebreak = true;  //aktivace break
                }

                if ($str > 1 && $i == $ostatni)
                {
                  $i = 0; //vynulovani pocitadla radku na strance
                  $str++; //pocitadlo stranek
                  $pagebreak = true;  //aktivace break
                }

                $ret .= $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis"],
                                                  $data->email,
                                                  $data->jmeno,
                                                  $data->prijmeni,
                                                  $data->identifikace,
                                                  $data->kontakt,
                                                  date($tvar_datum, strtotime($data->zadano)),
                                                  date($tvar_datum, strtotime($expirace, strtotime($data->zadano))),
                                                  date($tvar_datum, strtotime($data->potvrzeno)),
                                                  ($data->aktivni || $typ_kontroly == 1 ? " checked=\"checked\"" : ""),
                                                  ($data->ucast ? " checked=\"checked\"" : ""),
                                                  ($pagebreak ? $this->unikatni["admin_pdf_page_pagebreak"] : ""),
                                                  $data->ip,
                                                  $browser,
                                                  $os,
                                                  $flipid[$data->id] + 1
                                                  );

                $i++; //pocitadlo radku na strance
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $ret .= $this->unikatni["admin_pdf_vypis_end"];


          //$cesta_tridy = "{$this->dirpath}/mpdf/mpdf.php"; //{$this->dirpath}/
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
            $savestyle = $this->unikatni["admin_pdf_vypis_save_style"];

            $header = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_header"],
                                                $vypis);

            $footer = $this->NactiUnikatniObsah($this->unikatni["admin_pdf_vypis_footer"],
                                                $vypis);

            ini_set("memory_limit", "100M");  //nasosne si vic mega
            //define("_MPDF_PATH", "{$this->dirpath}/mpdf/"); //nastaveni patchu cesty
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
            $this->var->main[0]->ErrorMsg("Neexistuje cesta: {$cesta_tridy}", array(__LINE__, __METHOD__));
          }
        break;

        case "infoakce":  //informace o akci
          $id = $_GET["id"];  //id akce
          settype($id, "integer");

          $tvar_datum = $this->unikatni["admin_infoakce_tvar_datum"];

          $duplicitni_email = $this->VypisDuplikatnichEmailu($id);
          $pocet_prohlizece = $this->VypisPoctyProhlizecu($id);
          $pocet_os = $this->VypisPoctyOs($id);
          $pocet_osprohlizece = $this->VypisPoctyOsProhlizecu($id);
          $prodlevy_prihlasovani = $this->VypisProdlevyPrihlasovani($id);

          $prvni_reg = $this->querySingle("SELECT MIN(zadano) FROM {$this->dbpredpona}registrace WHERE akce={$id}");
          $posl_reg = $this->querySingle("SELECT MAX(zadano) FROM {$this->dbpredpona}registrace WHERE akce={$id}");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_infoakce"],
                                              $this->dirpath,
                                              $duplicitni_email,
                                              $pocet_prohlizece,
                                              $pocet_os,
                                              $pocet_osprohlizece,
                                              $prodlevy_prihlasovani,
                                              (!Empty($prvni_reg) ? date($tvar_datum, strtotime($prvni_reg)) : ""),
                                              (!Empty($posl_reg) ? date($tvar_datum, strtotime($posl_reg)) : ""),
                                              $this->VypocetRozdiluData($posl_reg, $prvni_reg, $this->unikatni["admin_infoakce_delka_tvar_datum"]),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul));
        break;

        case "infouser":  //informace uzivatele
          $id = $_GET["id"];
          settype($id, "integer");

          if ($res = $this->query("SELECT id, akce, email, jmeno, prijmeni, identifikace,
                                  kontakt, zadano, potvrzeno, aktivni, ucast, ip,
                                  agent, session
                                  FROM {$this->dbpredpona}registrace
                                  WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $tvar_datum = $this->unikatni["admin_infoedituser_tvar_datum"];

              //vypocet poradi uzivatele
              if ($idecka = $this->querySingle("SELECT id FROM {$this->dbpredpona}registrace WHERE akce={$data->akce} ORDER BY zadano ASC;", false)) //vypise id v pridanem poradi
              {
                $flipid = array_flip($idecka);
              }

              $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
              $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);

              $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $data->akce);
              $expirace = $this->VypisHodnotu("expirace", "akce", $data->akce);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_infouser"],
                                                  $this->dirpath,
                                                  $this->VypisNazevObsahZobrazeni($data->akce),
                                                  $data->email,
                                                  $data->jmeno,
                                                  $data->prijmeni,
                                                  $data->identifikace,
                                                  $data->kontakt, //zatim nevyuzito
                                                  date($tvar_datum, strtotime($data->zadano)),
                                                  date($tvar_datum, strtotime($expirace, strtotime($data->zadano))),
                                                  (!Empty($data->potvrzeno) && $data->potvrzeno != "0000-00-00 00:00:00" ? date($tvar_datum, strtotime($data->potvrzeno)) : ($typ_kontroly == 1 ? $this->unikatni["admin_vypis_obsah_noautoexpire"] : $this->unikatni["admin_vypis_obsah_noexpire"])),
                                                  ($data->aktivni || $typ_kontroly == 1 ? " checked=\"checked\"" : ""),
                                                  ($data->ucast ? " checked=\"checked\"" : ""),
                                                  $data->ip,
                                                  $browser, //14
                                                  $os,
                                                  $flipid[$data->id] + 1, //16
                                                  $data->session,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul)
                                                  );
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        break;

        case "edituser":  //editace uzivatele
          $id = $_GET["id"];
          settype($id, "integer");

          if ($res = $this->query("SELECT akce, email, jmeno, prijmeni, identifikace, kontakt, zadano, potvrzeno, aktivni, ucast FROM {$this->dbpredpona}registrace WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $tvar_datum = $this->unikatni["admin_infoedituser_tvar_datum"];

              $typ_kontroly = $this->VypisHodnotu("typ_kontroly", "akce", $data->akce);
              $expirace = $this->VypisHodnotu("expirace", "akce", $data->akce);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edituser"],
                                                  $this->dirpath,
                                                  $this->VypisNazevObsahZobrazeni($data->akce),
                                                  $data->email,
                                                  $data->jmeno,
                                                  $data->prijmeni,
                                                  $data->identifikace,
                                                  $data->kontakt, //zatim nevyuzito
                                                  date($tvar_datum, strtotime($data->zadano)),
                                                  date($tvar_datum, strtotime($expirace, strtotime($data->zadano))),
                                                  ($data->potvrzeno != "0000-00-00 00:00:00" ? date($tvar_datum, strtotime($data->potvrzeno)) : ""),
                                                  ($data->aktivni || $typ_kontroly == 1 ? " checked=\"checked\"" : ""), //pro aktivni
                                                  ($data->aktivni || $typ_kontroly == 1 ? "" : " disabled=\"disabled\""), //12
                                                  ($data->ucast ? " checked=\"checked\"" : ""),
                                                  ($data->ucast ? " disabled=\"disabled\"" : ""), //14, pro aktivni
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul)
                                                  );

              $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);
              $jmeno = $this->ChangeWrongChar($_POST["jmeno"], false);
              $prijmeni = $this->ChangeWrongChar($_POST["prijmeni"], false);
              $identifikace = $this->ChangeWrongChar($_POST["identifikace"]);
              //kontakt, kontakt, zatim nevyuzito
              $zadano = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["zadano"])));
              //$expirace = date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["expirace"])));
              $potvrzeno = (Empty($_POST["potvrzeno"]) ? "" : date("Y-m-d H:i:s", strtotime($this->ChangeWrongChar($_POST["potvrzeno"]))));
              $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);
              //kdyz potvrdi z adminu tak da aktualni datum
              $potvrzeno = ($aktivni ? ($data->aktivni ? $potvrzeno : date("Y-m-d H:i:s")) : ($data->aktivni ? "" : $potvrzeno));
              $ucast = (!Empty($_POST["ucast"]) ? 1 : 0);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($email) &&
                  !Empty($_POST["jmeno"]) &&
                  !Empty($_POST["prijmeni"]) &&
                  !Empty($_POST["identifikace"]) &&
                  !Empty($_POST["zadano"]) &&
                  //!Empty($_POST["expirace"]) &&
                  $id > 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}registrace SET email='{$email}',
                                                                              jmeno='{$jmeno}',
                                                                              prijmeni='{$prijmeni}',
                                                                              identifikace='{$identifikace}',
                                                                              kontakt='',
                                                                              zadano='{$zadano}',
                                                                              potvrzeno='{$potvrzeno}',
                                                                              aktivni={$aktivni},
                                                                              ucast={$ucast}
                                                                              WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edituser_hlaska"],
                                                      $email,
                                                      $jmeno,
                                                      $prijmeni);

                  $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul));  //auto kliknuti
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

        case "deluser": //mazani uzivatele
          $id = $_GET["id"];
          settype($id, "integer");
          //$id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT jmeno FROM {$this->dbpredpona}registrace WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}registrace WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_deluser_hlaska"], $data->jmeno);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul));  //auto kliknuti
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

        case "delalluser":  //mazani vsech uzivatelu
          $id = $_GET["id"];  //id akce
          settype($id, "integer");
          //$id = ($this->povolit_pridani ? $id : 0); //zakaz odmazani

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}akce WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}registrace WHERE akce={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delalluser_hlaska"], $data->nazev);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}=".(!Empty($_GET["ret"]) ? $_GET["ret"] : $this->idmodul));  //auto kliknuti
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
    $tvar_datum = $this->unikatni["admin_vypis_tvar_datum"];

    if ($res = $this->query("SELECT id, nazev, adresa, modul, funkce, adresa_funkce, popis FROM {$this->dbpredpona}prihlasovani ORDER BY nazev ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_prihlasovani_begin"],
                                              $data->id,
                                              $data->nazev,
                                              $data->adresa,
                                              get_class($this->var->main[$data->modul]),
                                              $data->funkce,
                                              $data->adresa_funkce,
                                              $data->popis,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addakce&amp;prih={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editprih&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delprih&amp;id={$data->id}"
                                              );

          if ($res1 = $this->query("SELECT id, akceid, reg_begin, reg_end, typ_kontroly, kapacita, rezerva, expirace, autodel, nazev, popis FROM {$this->dbpredpona}akce WHERE prihlasovani={$data->id} ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $celkem = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$data1->id}");

                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_prihlasovani_akce"],
                                                    $data1->id,
                                                    $data1->akceid,
                                                    date($tvar_datum, strtotime($data1->reg_begin)),
                                                    date($tvar_datum, strtotime($data1->reg_end)),
                                                    $this->vyhodnoceni[$data1->typ_kontroly],
                                                    $data1->kapacita,
                                                    $data1->rezerva,
                                                    $celkem,
                                                    $this->expirace[$data1->expirace],
                                                    ($data1->autodel != "1970-01-01 01:00:00" ? date($tvar_datum, strtotime($data1->autodel)) : ""),
                                                    $data1->nazev,  //11
                                                    $data1->popis,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editakce&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delakce&amp;id={$data1->id}"
                                                    );
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->unikatni["admin_vypis_prihlasovani_end"];
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
 * Vypisuje polozky menu a umoznuje je radit
 *
 * @return vypis polozek menu
 */
  private function AdminiVypisRazeniMenu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_razeni_menu_begin"],
                                        $this->absolutni_url,
                                        $this->dirpath);

    if ($res = $this->query("SELECT id, nazev, popis, poradi FROM {$this->dbpredpona}akce ORDER BY poradi ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_razeni_menu"],
                                              $data->id,
                                              $data->poradi,
                                              $data->popis,
                                              $data->nazev);
        }
      }
        else
      {
        $result .= $this->unikatni["admin_vypis_razeni_menu_null"];
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->unikatni["admin_vypis_razeni_menu_end"];

    return $result;
  }


}
?>
