<?php

/**
 *
 * Blok dynamicky generovaneho formulare
 *
 * public funkce:\n
 * construct: DynamicForm - hlavni konstruktor tridy\n
 * Formular() - hlavni vypis formulare, podle url a nebo zadaneho parametru\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicUser extends DefaultModule
{
  private $var, $dbname, $dirpath, $debug_lokal, $absolutni_url, $admincaptchakod, $captchakod, $unikatni, $dbpredpona;
  public $idmodul = "dynuser";
  private $subadmin = "_listuser";
  private $undying_user = array(1, ); //seznam nesmrelnych uzivatelu, takova ochrana proti prolomeni
  //klice pole
  private $idautorizace = "autorizace"; //get
  private $idinfouser = "userinfo"; //get
  private $idedituser = "useredit"; //get
  private $idsuicide = "usersuicide"; //get
  private $idlistuser = "userlist"; //get
  private $idlogoff = "userlogoff"; //get
  private $idforgetpass = "forgetpass"; //get
  private $iduserid = "id"; //get
  private $cookiename = "USER"; //cookie

  private $pathscript = "script"; //slozka skriptu

  private $timeactive = 5;  //minut
  //private $timelogdel = 7;  //dni
  private $countlogdel = 50;  //zaznamu
  private $filelogdel = ".logdeldate";  //nazev soboru na uchovani data dalsiho logovani

  private $znacka_povinne = "\n          <span>*</span>"; //povinne
  private $hlavicka = "Content-type: text/html; charset=UTF-8";
  //private $kodroz = "0-0";
  private $wordroz = "91827364-5";
  private $dayexpire = 3;

  private $input = array ("popisek" => "Krátký popisek",
                          "text" =>    "Dlouhé texty",
                          //...
                          );

  private $pocitadloporadi = array (0 => 8,
                                    1 => 8,
                                    2 => 5,
                                    3 => 5,
                                    4 => 5,
                                    5 => 7, //checkbox
                                    6 => 6, //radio
                                    7 => 7);

  private $vstupni_typ = array ("text", //kontrola - min poc, max poc
                                "integer",  //kontrola - min val, max val
                                "reg_exp"); //regularni vyraz

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

    $this->debug_lokal = false;  //lokalni zapinani debug modu

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->znacka_povinne = $this->NactiUnikatniObsah($this->unikatni["set_znacka_povinne"]); //znak *
    $this->input = $this->NactiUnikatniObsah($this->unikatni["set_input"]); //pole

    $this->undying_user = $this->NactiUnikatniObsah($this->unikatni["set_undying_user"]);

    $this->hlavicka = $this->NactiUnikatniObsah($this->unikatni["set_hlavicka"]);
    //$this->kodroz = $this->NactiUnikatniObsah($this->unikatni["set_kodroz"]);
    $this->wordroz = $this->NactiUnikatniObsah($this->unikatni["set_wordroz"]);
    $this->dayexpire = $this->NactiUnikatniObsah($this->unikatni["set_expire_user"]);
    $this->idautorizace = $this->NactiUnikatniObsah($this->unikatni["set_idautorizace"]);
    $this->idinfouser = $this->NactiUnikatniObsah($this->unikatni["set_idinfouser"]);
    $this->idedituser = $this->NactiUnikatniObsah($this->unikatni["set_idedituser"]);
    $this->idsuicide = $this->NactiUnikatniObsah($this->unikatni["set_idsuicide"]);
    $this->idlistuser = $this->NactiUnikatniObsah($this->unikatni["set_idlistuser"]);
    $this->idlogoff = $this->NactiUnikatniObsah($this->unikatni["set_idlogoff"]);
    $this->idforgetpass = $this->NactiUnikatniObsah($this->unikatni["set_idforgetpass"]);
    $this->iduserid = $this->NactiUnikatniObsah($this->unikatni["set_iduserid"]);
    $this->cookiename = $this->NactiUnikatniObsah($this->unikatni["set_cookiename"]);

    $this->timeactive = $this->NactiUnikatniObsah($this->unikatni["set_time_active"]);  //obnova aktivty
    //$this->timelogdel = $this->NactiUnikatniObsah($this->unikatni["set_time_log_del"]); //promazavani databaze
    $this->countlogdel = $this->NactiUnikatniObsah($this->unikatni["set_count_log_del"]); //pocet zaznamu na ktere se bude log omezovat

    $this->pathscript = $this->NactiUnikatniObsah($this->unikatni["set_pathscript"]);
    $this->filelogdel = "{$this->dirpath}/{$this->filelogdel}";

    $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dirpath}/{$this->dbname}");
    if (!$this->PripojeniDatabaze($error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $this->Instalace();

    $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                        $this->idmodul,
                                                        "{$this->idmodul}{$this->subadmin}"));
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    if (!$this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}uzivatele (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  login VARCHAR(100),
                                  heslo VARCHAR(100),
                                  email VARCHAR(100),
                                  pridano DATETIME,
                                  upraveno DATETIME,
                                  aktivni BOOL,
                                  pocet INTEGER UNSIGNED,
                                  polozky TEXT);

                                  CREATE TABLE {$this->dbpredpona}last_login (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  uzivatel INTEGER UNSIGNED,
                                  prihlaseni DATETIME,
                                  last_active DATETIME,
                                  ip VARCHAR(50),
                                  agent VARCHAR(300));

                                  CREATE TABLE {$this->dbpredpona}gui_element (
                                  id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  nazev VARCHAR(200),
                                  typ INTEGER UNSIGNED,
                                  value VARCHAR(500),
                                  registrace BOOL,
                                  profil BOOL,
                                  readonly BOOL,
                                  disabled BOOL,
                                  povinne BOOL,
                                  vstupni_typ INTEGER UNSIGNED,
                                  reg_exp VARCHAR(500),
                                  format VARCHAR(200),
                                  min_val INTEGER UNSIGNED,
                                  max_val INTEGER UNSIGNED,
                                  poradi INTEGER UNSIGNED);", $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
  }

/**
 *
 * Vrati obsah v poli
 *
 * pouziti: <strong>$pole = $this->var->main[0]->NactiFunkci("DynamicUser", "ArrayVystupUser"[, false]);</strong>
 *
 * @param vlastni zobrazi jen informace o vlastnim profilu (true), pri false ukazuje i cizi
 * @return obsah uzivatelu v poli
 */
  public function ArrayVystupUser($vlastni = true)
  {
    $result = "";
    if ($res = $this->query("SELECT
                            user.id id,
                            user.login login,
                            user.heslo heslo,
                            user.email email,
                            user.pridano pridano,
                            user.upraveno upraveno,
                            user.aktivni aktivni,
                            user.pocet pocet,
                            user.polozky polozky,
                            (SELECT prihlaseni FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) prihlaseni,
                            (SELECT ip FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) ip,
                            (SELECT agent FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) agent,
                            (SELECT last_active FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) last_active
                            FROM {$this->dbpredpona}uzivatele user
                            ORDER BY LOWER(login);", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
          $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);
          $doplnekid = (!$vlastni ? ($this->var->htaccess ? "/{$data->id}" : "&amp;{$this->iduserid}={$data->id}") : "");

          $result["id"][] = $data->id;
          $result["login"][] = $data->login;
          $result["heslo"][] = $data->heslo;
          $result["email"][] = $data->email;
          $result["pridano"][] = $data->pridano;
          $result["upraveno"][] = $data->upraveno;
          $result["aktivni"][] = $data->aktivni;
          $result["pocet"][] = $data->pocet;
          $result["polozky"][] = $data->polozky;
          $result["info"][] = ($this->var->htaccess ? "{$this->idinfouser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idinfouser}{$doplnekid}");
          $result["edit"][] = ($this->var->htaccess ? "{$this->idedituser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idedituser}{$doplnekid}");
          $result["del"][] = ($this->var->htaccess ? "{$this->idsuicide}{$doplnekid}" : "?{$this->var->get_kam}={$this->idsuicide}{$doplnekid}");
          $result["prihlaseni"][] = $data->prihlaseni;
          $result["last_active"][] = $data->last_active;
          $result["ip"][] = $data->ip;
          $result["browser"][] = $browser;
          $result["os"][] = $os;
          $result["online"][] = (date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($data->last_active)) ? 1 : 0);
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
 * Prihlasovaci formular uzivatele
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "LoginUser"[, false, true, 1]);</strong>
 *
 * @param vlastni zobrazi jen informace o vlastnim profilu (true), pri false ukazuje i cizi
 * @param online zapina hlidani posledni aktivity usera pro funkci: OnlineUser()
 * @param tvar cislo tvaru
 * @return logovaci formular uzivatele
 */
  public function LoginUser($vlastni = true, $online = false, $tvar = 1)
  {
    $submit_button = "log_tlacitko";
    $login = $_POST["login_user"];
    $heslo = $_POST["heslo_user"];

    if (!Empty($login) &&
        !Empty($heslo) &&
        !Empty($_POST[$submit_button]))
    {
      $heslo = md5(md5($this->ChangeWrongChar($heslo)));

      if ($res = $this->query("SELECT id, pocet FROM {$this->dbpredpona}uzivatele WHERE
                              login='{$login}' AND
                              heslo='{$heslo}' AND
                              aktivni=1;", $error))
      {
        if ($this->numRows($res) == 1)
        { //prihlaseno
          $data = $this->fetchObject($res);
          $id = $data->id;
          $pocet = $data->pocet + 1;  //pocitadlo prihlaseni
          SetCookie($this->cookiename, $this->ZakodujText("uzivatel:{$login}:jehoid:{$id}:{$heslo}"), Time() + 31536000); //zápis do cookie

          $hlaska = $this->NactiUnikatniObsah($this->unikatni["normal_login_user_true_{$tvar}"],
                                              $this->absolutni_url,
                                              $login);

          $this->AddLogUser($id, $pocet); //zalogovani vstupu

          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_login_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
        }
          else
        { //nenalezeno a nebo neautorizovano
          $hlaska = $this->NactiUnikatniObsah($this->unikatni["normal_login_user_false_{$tvar}"],
                                              $this->absolutni_url,
                                              $login);

          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_login_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }
    }
      else
    {
      if (!Empty($_POST[$submit_button]))
      {
        $hlaska = $this->NactiUnikatniObsah($this->unikatni["normal_login_user_empty_{$tvar}"],
                                            $this->absolutni_url);

        $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_login_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
      }
    }

    if (Empty($_COOKIE[$this->cookiename]))
    { //neprihlasen
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_user_off_{$tvar}"],
                                          " name=\"{$submit_button}\"",
                                          (!Empty($_POST[$submit_button]) ? " disabled=\"disabled\"" : ""),
                                          (!Empty($_POST[$submit_button]) ? "_disabled" : ""),
                                          $hlaska,
                                          $this->absolutni_url,
                                          ($this->var->htaccess ? "{$this->idforgetpass}" : "?{$this->var->get_kam}={$this->idforgetpass}"));
    }
      else
    { //prihlasen
      list($cookie_id, $cookie_login, $cookie_pass) = $this->AktivniUzivatel("array");

      if (!$this->ExistujeUser($cookie_id, $cookie_login, $cookie_pass))
      {
        $this->var->main[0]->AutoClick(0, "{$this->absolutni_url}?{$this->var->get_kam}={$this->idlogoff}");
      }

      if ($online)  //jen kdyz je priznak online kontroly na true
      {
        $this->EditLogUser($cookie_id); //upraveni datumu pristupu
      }

      $doplnekid = (!$vlastni ? ($this->var->htaccess ? "/{$cookie_id}" : "&amp;{$this->iduserid}={$cookie_id}") : "");

      $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_user_on_{$tvar}"],
                                          $this->absolutni_url,
                                          $cookie_login,
                                          ($this->var->htaccess ? "{$this->idlogoff}" : "?{$this->var->get_kam}={$this->idlogoff}"),
                                          ($this->var->htaccess ? "{$this->idinfouser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idinfouser}{$doplnekid}"),
                                          ($_GET[$this->var->get_kam] == $this->idinfouser ? $this->NactiUnikatniObsah($this->unikatni["normal_login_active_{$tvar}"]) : ""),
                                          ($this->var->htaccess ? "{$this->idedituser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idedituser}{$doplnekid}"),
                                          ($_GET[$this->var->get_kam] == $this->idedituser ? $this->NactiUnikatniObsah($this->unikatni["normal_login_active_{$tvar}"]) : ""),
                                          ($this->var->htaccess ? "{$this->idlistuser}" : "?{$this->var->get_kam}={$this->idlistuser}"),
                                          ($_GET[$this->var->get_kam] == $this->idlistuser ? $this->NactiUnikatniObsah($this->unikatni["normal_login_active_{$tvar}"]) : ""));
    }

    if ($_GET[$this->var->get_kam] == $this->idlogoff) //odhlaseni
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_user_logoff_{$tvar}"],
                                          $cookie_login,
                                          $this->absolutni_url);

      SetCookie($this->cookiename, "", Time() + 31536000); //zápis do cookie

      $this->LogOffUser($cookie_id); //odlogovani

      $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_login_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Formular zapomenuteho hesla
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "ZapomenuteHeslo"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return formular pro ziskani noveho hesla
 */
  public function ZapomenuteHeslo($tvar = 1)
  {
    $submit_button = "forget_tlacitko";
    $login = $_POST["login_forget"];
    $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email_forget"]);
    $hlaska = "";

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->idforgetpass)
    {
      if (!Empty($login) &&
          !Empty($email))
      {
        if ($res = $this->query("SELECT id, heslo FROM {$this->dbpredpona}uzivatele WHERE
                                login='{$login}' AND
                                email='{$email}' AND
                                aktivni=1;", $error))
        {
          if ($this->numRows($res) == 1)
          { //podarilo se najit uzivatele
            $dayexpire = $this->NactiUnikatniObsah($this->unikatni["normal_forger_pass_email_expire_{$tvar}"]);
            $newpass = $this->GenerujNoveHeslo($tvar);
            $poslano = date("Y-m-d H:i:s");

            $data = $this->fetchObject($res);

            $udaje[] = $this->ZakodujText("forget_pass");
            $udaje[] = $this->ZakodujText($data->id); //nactene ID
            $udaje[] = $this->ZakodujText($login); //zadany login
            $udaje[] = $this->ZakodujText($email); //zadany email
            $udaje[] = $this->ZakodujText($data->heslo); //nactene stare heslo
            $udaje[] = $this->ZakodujText($newpass); //nove heslo
            $udaje[] = $this->ZakodujText(date("Y-m-d H:i:s", strtotime("+{$dayexpire} day"))); //+X day od zadaneho data
            $linkact = implode($this->wordroz, $udaje);

            $obsahmessage = array("array_args",
                                  $this->absolutni_url,
                                  ($this->var->htaccess ? "{$this->idautorizace}/{$linkact}" : "?{$this->var->get_kam}={$this->idautorizace}&amp;{$this->iduserid}={$linkact}"),
                                  $login,
                                  $email,
                                  $newpass,
                                  $poslano);

            $subject = $this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_email_subject_{$tvar}"], $this->absolutni_url);
            $message = $this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_email_message_{$tvar}"],
                                                $obsahmessage);

            $header = $this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_email_header_{$tvar}"],  //hlavička
                                                $this->hlavicka);
//var_dump($message);
            if (!mail($email, $subject, $message, $header))
            {
              $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_send_email_error_{$tvar}"]), array(__LINE__, __METHOD__));
            }

            $hlaska = $this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_true_{$tvar}"],
                                                $this->absolutni_url,
                                                $login);

            $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
          }
            else
          { //nenalezeno a nebo neautorizovano
            $hlaska = $this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_false_{$tvar}"],
                                                $this->absolutni_url,
                                                $login);

            $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
          }
        }
          else
        {
          $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["normal_forget_pass_{$tvar}"],
                                          " name=\"{$submit_button}\"",
                                          (!Empty($_POST[$submit_button]) ? " disabled=\"disabled\"" : ""),
                                          (!Empty($_POST[$submit_button]) ? "_disabled" : ""),
                                          $hlaska,
                                          $this->absolutni_url,
                                          $this->idforgetpass);
    }

    return $result;
  }

/**
 *
 * Vygeneruje nove heslo, posilat stare nebude
 *
 * @param tvar cislo tvaru
 * @return nove heslo
 */
  private function GenerujNoveHeslo($tvar = 1)
  {
    $result = "";
    $abeceda = str_split($this->NactiUnikatniObsah($this->unikatni["normal_abeceda_gen_pass_{$tvar}"]), 1);
    $delka = $this->NactiUnikatniObsah($this->unikatni["normal_length_gen_pass_{$tvar}"]);

    for ($i = 0; $i < $delka; $i++)
    {
      $result .= $abeceda[array_rand($abeceda)];  //nahodne vybrani pismene z pole
    }

    return $result;
  }

/**
 *
 * Zaloguje uzivatele pri vstupu
 *
 * @param id id user
 */
  private function AddLogUser($iduser, $pocet)
  {
    settype($iduser, "integer");
    settype($pocet, "integer");

    $datum = date("Y-m-d H:i:s");
    $active = date("Y-m-d H:i:s", strtotime("+{$this->timeactive} minute"));
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];

    if (!$this->queryExec("INSERT INTO {$this->dbpredpona}last_login (id, uzivatel, prihlaseni, last_active, ip, agent) VALUES
                          (NULL, {$iduser}, '{$datum}', '{$active}', '{$ip}', '{$agent}');
                          UPDATE {$this->dbpredpona}uzivatele SET pocet={$pocet}
                                                              WHERE id={$iduser};
                          ", $error)) //provedeni dotazu
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    if (($pocet % $this->countlogdel) == 0) //kazdych N prihlaseni promaze logy
    {
      $konec = $this->PocetRadkuLogu($iduser) - $this->countlogdel; //od,do (pocet presahujicich)
      if ($res = $this->query("SELECT id
                              FROM {$this->dbpredpona}last_login
                              WHERE uzivatel={$iduser}
                              ORDER BY {$this->dbpredpona}last_login.last_active DESC
                              LIMIT {$this->countlogdel},{$konec}", $error))
      {
        if ($this->numRows($res) != 0)
        {
          while ($data = $this->fetchObject($res))
          {
            $logy[] = "id={$data->id}";
          }

          $del = implode(" OR ", $logy);  //slopuci pole id na vymazani
          if (!$this->queryExec("DELETE FROM {$this->dbpredpona}last_login WHERE {$del};", $error)) //provedeni dotazu
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
  }

/**
 *
 * Upravi datum a cas posledni aktivity pro OnlineUser
 *
 * @param id id user
 */
  private function EditLogUser($iduser)
  {
    settype($iduser, "integer");

    $datum = date("Y-m-d H:i:s");
    $active = date("Y-m-d H:i:s", strtotime("+{$this->timeactive} minute"));
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];

    //nacte id (dle usera a agenta) a porovnava s predpokladaym datem
    if ($res = $this->query("SELECT id
                            FROM {$this->dbpredpona}last_login
                            WHERE
                            id=(SELECT id FROM {$this->dbpredpona}last_login WHERE uzivatel={$iduser} AND agent='{$agent}' ORDER BY {$this->dbpredpona}last_login.prihlaseni DESC LIMIT 0,1) AND
                            last_active>'{$datum}';", $error))  //id nesmi jit pres promennou ale primo
    {
      if ($this->numRows($res) == 0)  //kdyz je 0 radku tak pravuje aktivitu
      { //predzvejka si id daneho zaznamu (dle usera a agenta) a podle toho upravy dany zaznam
        if (!$this->queryExec("SET @id=(SELECT id FROM {$this->dbpredpona}last_login WHERE uzivatel={$iduser} AND agent='{$agent}' ORDER BY {$this->dbpredpona}last_login.prihlaseni DESC LIMIT 0,1);
                               UPDATE {$this->dbpredpona}last_login SET last_active='{$active}',
                                                                        ip='{$ip}',
                                                                        agent='{$agent}'
                                                                        WHERE
                                                                        id=@id;", $error)) //provedeni dotazu
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

/**
 *
 * Odloguje uzivatele
 *
 * @param id id user
 */
  private function LogOffUser($iduser)
  {
    settype($iduser, "integer");

    $datum = date("Y-m-d H:i:s");
    $agent = $_SERVER["HTTP_USER_AGENT"];

    if (!$this->queryExec("SET @id=(SELECT id FROM {$this->dbpredpona}last_login WHERE uzivatel={$iduser} AND agent='{$agent}' ORDER BY {$this->dbpredpona}last_login.prihlaseni DESC LIMIT 0,1);
                           UPDATE {$this->dbpredpona}last_login SET last_active='{$datum}'
                                                                    WHERE
                                                                    id=@id;", $error)) //provedeni dotazu
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }
  }

/**
 *
 * Vrati pocet radku logu pole id user
 *
 * @param iduser id uzivatele
 * @return pocet radku
 */
  private function PocetRadkuLogu($iduser)
  {
    $result = 0;
    if ($res = $this->query("SELECT
                            count(id) pocet
                            FROM {$this->dbpredpona}last_login
                            WHERE uzivatel={$iduser};", $error))  //id nesmi jit pres promennou ale primo
    {
      if ($this->numRows($res) == 1)
      {
        $result = $this->fetchObject($res)->pocet;
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
 * Vypis uzivatelu kteri se jevi jako aktivni
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "OnlineUser"[, false, 1]);</strong>
 *
 * pozor na poradi!!!
 *
 * @param vlastni zobrazi jen informace o vlastnim profilu (true), pri false ukazuje i cizi
 * @param tvar cislo tvaru
 * @return online user
 */
  public function OnlineUser($vlastni = true, $tvar = 1)
  {
    $result = "";
    $datum = date("Y-m-d H:i:s");
    $aktivni = $this->AktivniUzivatel();

    if ($res = $this->query("SELECT user.id id,
                            user.login login,
                            lastlogin.ip ip,
                            lastlogin.agent agent,
                            lastlogin.last_active active
                            FROM {$this->dbpredpona}uzivatele user, {$this->dbpredpona}last_login lastlogin
                            WHERE
                            user.id=lastlogin.uzivatel AND
                            lastlogin.last_active>'{$datum}';", $error))  //id nesmi jit pres promennou ale primo
    {
      if ($this->numRows($res) != 0)  //kdyz je 0 radku tak pravuje aktivitu
      {
        $user = "";
        while ($data = $this->fetchObject($res))
        {
          $doplnekid = (!$vlastni ? ($this->var->htaccess ? "/{$data->id}" : "&amp;{$this->iduserid}={$data->id}") : "");
          $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
          $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);
          $datum = date($this->NactiUnikatniObsah($this->unikatni["normal_online_user_tvar_datum_{$tvar}"]), strtotime($data->active));

          $user[] = ($vlastni ? ($aktivni == $data->id ?
                                                        $this->NactiUnikatniObsah($this->unikatni["normal_online_user_true_select_{$tvar}"],  //je-li aktivni
                                                                                  $this->absolutni_url,
                                                                                  ($this->var->htaccess ? "{$this->idinfouser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idinfouser}{$doplnekid}"),
                                                                                  $data->login,
                                                                                  $browser,
                                                                                  $os,
                                                                                  $datum,
                                                                                  $data->ip)
                                                        :
                                                        $this->NactiUnikatniObsah($this->unikatni["normal_online_user_true_{$tvar}"], //je-li jiny nez aktvni
                                                                                  $this->absolutni_url,
                                                                                  ($this->var->htaccess ? "{$this->idinfouser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idinfouser}{$doplnekid}"),
                                                                                  $data->login,
                                                                                  $browser,
                                                                                  $os,
                                                                                  $datum,
                                                                                  $data->ip)
                                )
                              :
                                $this->NactiUnikatniObsah($this->unikatni["normal_online_user_false_{$tvar}"],  //je-li admin mod
                                                          $this->absolutni_url,
                                                          ($this->var->htaccess ? "{$this->idinfouser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idinfouser}{$doplnekid}"),
                                                          $data->login,
                                                          $browser,
                                                          $os,
                                                          $datum,
                                                          $data->ip)
                    );
        }

        $result = implode($this->NactiUnikatniObsah($this->unikatni["normal_online_user_oddel_{$tvar}"]), $user);
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
 * Otestuje jestli dany uzivatel existuje
 *
 * pouziti: <strong>$bool = $this->var->main[0]->NactiFunkci("DynamicUser", "ExistujeUser", 3, "login", "heslo");</strong>
 *
 * @param id id uzivatele
 * @param login logni uzivatele
 * @param pass heslo uzivatele
 * @return true/false - existuje/neexistuje
 */
  public function ExistujeUser($id, $login, $pass)
  {
    settype($id, "integer");

    $result = false;
    if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele
                            WHERE
                            id={$id} AND
                            login='{$login}' AND
                            heslo='{$pass}' AND
                            aktivni=1;", $error))
    {
      $result = ($this->numRows($res) == 1);
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati data prihlaseneho uzivatele
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "AktivniUzivatel"[, "id"]);</strong>
 *
 * @param navrat text navratoveho typu
 * @return mixed data
 */
  public function AktivniUzivatel($navrat = "id")
  {
    $result = "";
    $rozdel = explode(":", $this->DekodujText($_COOKIE[$this->cookiename]));

    switch ($navrat)
    {
      default:
      case "id":  //jen id
        $result = $rozdel[3]; //nacteni id
      break;

      case "login": //jen login
        $result = $rozdel[1]; //nacteni loginu
      break;

      case "pass":  //jen pass
        $result = $rozdel[4]; //nacteni pass
      break;


      case "array": //id a login v ciselnem poli
        $result = array($rozdel[3], $rozdel[1], $rozdel[4]);  //nacteni [0]=>id, [1]=>loginu, [2]=>heslo
      break;

      case "assoc": //id a login v asociativnim poli
        $result = array("id" => $rozdel[3], //nacteni ["id"]=>id, ["login"]=>loginu, ["pass"]=>pass
                        "login" => $rozdel[1],
                        "pass" => $rozdel[4],);
      break;
    }

    return $result;
  }

/**
 *
 * Autorizuje uzivatele
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "AutorizaceUzivatele"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return autorizacni oznameni
 */
  public function AutorizaceUzivatele($tvar = 1)
  {
    $linkact = $_GET[$this->iduserid];  //vezme z id

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->idautorizace &&
        !Empty($linkact)) //kontrola adresy
    {
      $rozdeleni = explode($this->wordroz, $linkact);
      $typauth = $this->DekodujText($rozdeleni[0]); //typ autorizace

      switch ($typauth)
      {
        case "authorize_user":  //autorizace uzivatele
          $login = $this->DekodujText($rozdeleni[1]);
          $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $this->DekodujText($rozdeleni[2]));
          $expirace = $this->DekodujText($rozdeleni[3]);

          if (!Empty($login) && //2 kontrola udaju
              !Empty($email) &&
              !Empty($expirace))
          {
            if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE
                                    login='{$login}' AND
                                    email='{$email}' AND
                                    aktivni=0;", $error))
            {
              if ($this->numRows($res) == 1)
              {
                $id = $this->fetchObject($res)->id;
                settype($id, "integer");

                if (date("Y-m-d H:i:s") < $expirace)  //kdyz jeste nenastal soudny den smazani
                { //aktivuje usera
                  if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET aktivni=1 WHERE id={$id};", $error)) //provedeni dotazu
                  {
                    $result = $this->NactiUnikatniObsah($this->unikatni["normal_activate_user_{$tvar}"], $login);

                    $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_activate_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
                  }
                    else
                  {
                    $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                  }
                }
                  else
                { //smaze usera
                  if ($this->queryExec("DELETE FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error)) //provedeni dotazu
                  {
                    $result = $this->NactiUnikatniObsah($this->unikatni["normal_activate_del_user_{$tvar}"], $login);

                    $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_activate_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
                  }
                    else
                  {
                    $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
                  }
                }
              }
                else
              { //nenalezeno a nebo jiz autorizovano
                $result = $this->NactiUnikatniObsah($this->unikatni["normal_activate_act_user_{$tvar}"]);

                $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_activate_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
              }
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "change_pass": //zmena hesla
          $id = $this->DekodujText($rozdeleni[1]);
          settype($id, "integer");
          //$oldpass = $this->DekodujText($rozdeleni[2]);
          $newpass = $this->DekodujText($rozdeleni[3]);
          $expirace = $this->DekodujText($rozdeleni[4]);

          if ($id > 0 &&
              date("Y-m-d H:i:s") < $expirace)
          {
            if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE
                                    heslo='{$newpass}';", $error))
            {
              if ($this->numRows($res) == 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET heslo='{$newpass}' WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["normal_activate_change_pass_{$tvar}"], "");
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

          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_activate_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
        break;

        case "change_email":  //zmena emailu
          $id = $this->DekodujText($rozdeleni[1]);
          settype($id, "integer");
          //$oldemail = $this->DekodujText($rozdeleni[2]);
          $newemail = $this->DekodujText($rozdeleni[3]);
          $expirace = $this->DekodujText($rozdeleni[4]);

          if ($id > 0 &&
              date("Y-m-d H:i:s") < $expirace)
          {
            if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE
                                    email='{$newemail}';", $error))
            {
              if ($this->numRows($res) == 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET email='{$newemail}' WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["normal_activate_change_email_{$tvar}"], $newemail);
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

          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_activate_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
        break;

        case "forget_pass": //zapomenute heslo
          $id = $this->DekodujText($rozdeleni[1]);
          settype($id, "integer");
          //$oldpass = $this->DekodujText($rozdeleni[4]);
          $newpass = md5(md5($this->DekodujText($rozdeleni[5])));
          $expirace = $this->DekodujText($rozdeleni[6]);

          $login = $this->DekodujText($rozdeleni[2]); //login uzvatele

          //var_dump($this->DekodujText($rozdeleni[1]));  //id
          //var_dump($this->DekodujText($rozdeleni[2]));  //login
          //var_dump($this->DekodujText($rozdeleni[3]));  //email
          //var_dump($this->DekodujText($rozdeleni[4]));  //old heslo
          //var_dump($this->DekodujText($rozdeleni[5]), $newpass);  //new pass (bez md5)
          //var_dump($this->DekodujText($rozdeleni[6]));  //expirace

          if ($id > 0 &&
              date("Y-m-d H:i:s") < $expirace)
          {
            if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE
                                    heslo='{$newpass}';", $error))
            {
              if ($this->numRows($res) == 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET heslo='{$newpass}' WHERE id={$id};", $error)) //provedeni dotazu
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["normal_activate_forget_pass_{$tvar}"], $login);
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

          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_activate_timeout_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypise informace o zvolenem proflu uzivatele
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "InformaceProfilu"[, true, 1]);</strong>
 *
 * @param vlastni zobrazi jen informace o vlastnim profilu (true), pri false ukazuje i cizi
 * @param tvar cislo tvaru
 * @return informace o uzivateli
 */
  public function InformaceProfilu($vlastni = true, $tvar = 1)
  {
    //kdyz je vlastni==true vezme jen id prihlaseneho, pokud false vezme z adresy
    $id = ($vlastni ? $this->AktivniUzivatel() : $_GET[$this->iduserid]); //nacte si id
    settype($id, "integer");

    $doplnekid = (!$vlastni ? ($this->var->htaccess ? "/{$id}" : "&amp;{$this->iduserid}={$id}") : "");

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->idinfouser &&
        !Empty($id))
    {
      if ($res = $this->query("SELECT
                              user.id id,
                              user.login login,
                              user.heslo heslo,
                              user.email email,
                              user.pridano pridano,
                              user.upraveno upraveno,
                              user.aktivni aktivni,
                              user.polozky polozky,
                              (SELECT ip FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) ip,
                              (SELECT agent FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) agent,
                              (SELECT last_active FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) last_active
                              FROM
                              {$this->dbpredpona}uzivatele user
                              WHERE user.id={$id};", $error))
      {
        if ($this->numRows($res) == 1)  //last_login, last_ip, last_agent,
        {
          $data = $this->fetchObject($res);

          $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
          $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);

/*

SELECT user.id id,
                            user.login login,
                            user.heslo heslo,
                            user.email email,
                            user.pridano pridano,
                            user.upraveno upraveno,
                            user.aktivni aktivni,
                            user.polozky polozky,
                            (SELECT ip FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) ip,
                            (SELECT agent FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) agent,
                            (SELECT last_active FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) last_active
                            FROM
                            {$this->dbpredpona}uzivatele user
                            ORDER BY user.pridano ASC;
                        (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? gethostbyaddr($data->last_ip) : $data->last_ip),
*/
          $vypis = array("array_args",
                        $this->absolutni_url,
                        "{$this->dirpath}/{$this->pathscript}",
                        $data->id,
                        $data->login,
                        $data->email,
                        date($this->NactiUnikatniObsah($this->unikatni["normal_info_user_datum_{$tvar}"]), strtotime($data->pridano)),
                        date($this->NactiUnikatniObsah($this->unikatni["normal_info_user_datum_{$tvar}"]), strtotime($data->upraveno)),
                        ($data->aktivni ? " checked=\"checked\"" : ""),
                        date($this->NactiUnikatniObsah($this->unikatni["normal_info_user_datum_{$tvar}"]), strtotime($data->last_active)),
                        $data->ip,
                        $browser,
                        $os,
                        ($this->var->htaccess ? "{$this->idedituser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idedituser}{$doplnekid}"),
                        ($this->var->htaccess ? "{$this->idsuicide}{$doplnekid}" : "?{$this->var->get_kam}={$this->idsuicide}{$doplnekid}"));

          $polozky = explode("|-x-|", $data->polozky);
          $vypis = array_merge($vypis, $polozky);

          $result = $this->NactiUnikatniObsah($this->unikatni["normal_info_user_{$tvar}"],
                                              $vypis);
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
 * Mazani uzivatele
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "SmazaniProfilu"[, true, 1]);</strong>
 *
 * @param vlastni smazani vlastniho profilu (true), pri false smaze i cizi
 * @param tvar cislo tvaru
 * @return mazani uzivatele
 */
  public function SmazaniProfilu($vlastni = true, $tvar = 1)
  {
    //kdyz je vlastni==true vezme jen id prihlaseneho, pokud false vezme z adresy
    $id = ($vlastni ? $this->AktivniUzivatel() : $_GET[$this->iduserid]); //nacte si id
    settype($id, "integer");

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->idsuicide && //pri detekci mazani
        !Empty($id))
    {
      $softkod = $this->ZakodujText("uzivatel:{$id}:chce smazat ucet"); //odkaz na potvrzeni pro email

      //detekce pro true (vlastnik)
      $mezikod = explode(":", $this->DekodujText($_GET[$this->iduserid]));
      settype($mezikod[1], "integer");  //prevod stringu na cislo

      //detekce pro false (cizi admin)
      $akt = $this->AktivniUzivatel("array");
      $aktivni = $akt[0];
      settype($aktivni, "integer");

      //kdyz bude v admin modu, bude prihlaseny==id tak pouze posle email
      //jako ve vlastnickem modu, nebude provadet prime mazaci operace!
      if (!$vlastni &&
          $aktivni > 0 &&
          $id > 0 &&
          $aktivni == $id)
      {
        $vlastni = true;  //pri admin modu a mazani sebe sama, se chovat jako u vlastniku
      }

      switch ($vlastni)
      {
        default:
        case true:  //smazani sebe sama
          if ($mezikod[0] == "uzivatel" &&  //kdyz se detekuje uzivatel, jinak odesila mail
              $mezikod[1] > 0 &&
              $mezikod[2] == "chce smazat ucet" &&  //kdyz detekuje kod!! v ID!!
              !in_array($mezikod[1], $this->undying_user))  //kdyz se nejedna o chraneneho
          { //smazani uzivatele
            if ($this->queryExec("DELETE FROM {$this->dbpredpona}uzivatele WHERE id={$mezikod[1]};", $error)) //provedeni dotazu
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_user_hlaska_{$tvar}"]);

              $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_suicide_time_autoclick_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
            else
          { //odeslani emailu
            if (!in_array($mezikod[1], $this->undying_user))  //kdyz se nejedna o chraneneho
            {
              $email = $this->VypisSloupce($id, "email");
              $obsahmessage = array("array_args",
                                    $this->absolutni_url,
                                    ($this->var->htaccess ? "{$this->idsuicide}/{$softkod}" : "?{$this->var->get_kam}={$this->idsuicide}&amp;{$this->iduserid}={$softkod}"),
                                    $this->AktivniUzivatel("login"),
                                    "-volne-");

              $subject = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_email_subject_{$tvar}"], $this->absolutni_url);
              $message = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_email_message_{$tvar}"],
                                                  $obsahmessage);

              $header = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_email_header_{$tvar}"],  //hlavička
                                                  $this->hlavicka);

              if (mail($email, $subject, $message, $header))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_send_email_{$tvar}"], $email);
              }
                else
              {
                $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_suicide_send_email_error_{$tvar}"]), array(__LINE__, __METHOD__));
              }
            }

            if ($this->NactiUnikatniObsah($this->unikatni["normal_suicide_autoclick_{$tvar}"]))
            {
              $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_suicide_time_autoclick_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
            }
          }
        break;

        case false: //odeslani informativniho emailu, kdo smazal jake ID (od koho, pro koho)
          if ($aktivni > 0 &&
              $id > 0 &&
              $aktivni != $id &&
              !in_array($id, $this->undying_user))  //kdyz se nejedna o chraneneho
          {
            $userlogin = $this->VypisSloupce($id, "login"); //login uzivatele co se ma smazat

            if ($this->queryExec("DELETE FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error)) //provedeni dotazu
            {
              $email = $this->VypisSloupce($id, "email");
              $obsahmessage = array("array_args",
                                    $this->absolutni_url,
                                    $this->AktivniUzivatel("login"),  //zdroj, (od koho, kdo mazal)
                                    $userlogin);  //cil, (pro koho, koho mazal)

              $subject = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_other_email_subject_{$tvar}"], $this->absolutni_url);
              $message = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_other_email_message_{$tvar}"],
                                                  $obsahmessage);

              $header = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_other_email_header_{$tvar}"],  //hlavička
                                                  $this->hlavicka,
                                                  $this->VypisSloupce($aktivni, "email"));  //email admina

              $ema = "";
              if (mail($email, $subject, $message, $header))
              {
                $ema = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_other_send_email_{$tvar}"], $email);
              }
                else
              {
                $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_suicide_send_email_error_{$tvar}"]), array(__LINE__, __METHOD__));
              }

              $result = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_other_user_hlaska_{$tvar}"],
                                                  $userlogin,
                                                  $ema);

              $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_suicide_other_time_autoclick_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
            else
          {
            if ($aktivni > 0 &&
                $id > 0 &&
                $aktivni == $id)
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["normal_suicide_self_user_hlaska_{$tvar}"], $akt[1]);

              $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_suicide_time_autoclick_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypise editacni formular uzivatele
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "EditaceProfilu"[, true, 1]);</strong>
 *
 * @param vlastni zobrazi jen editace o vlastnim profilu (true), pri false ukazuje i cizi
 * @param tvar cislo tvaru
 * @return editace uzivatele
 */
  public function EditaceProfilu($vlastni = true, $tvar = 1)
  {
    //kdyz je vlastni==true vezme jen id prihlaseneho, pokud false vezme z adresy
    $id = ($vlastni ? $this->AktivniUzivatel() : $_GET[$this->iduserid]); //nacte si id
    settype($id, "integer");

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->idedituser &&
        !Empty($id))
    {
      if ($res = $this->query("SELECT login, heslo, email, polozky FROM {$this->dbpredpona}uzivatele
                              WHERE aktivni=1 AND id={$id};", $error))
      {
        if ($this->numRows($res) == 1)
        {
          $data = $this->fetchObject($res);
          $obsah = $data->polozky;

          $login = $data->login;
          $heslo = $data->heslo;
          $email = $data->email;
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $nacist = explode("|-x-|", $obsah); //znovu rozdeleni
      $typelementu = array_keys($this->input);

      if ($res = $this->query("SELECT id, nazev, typ, value,
                              profil, readonly,
                              disabled, povinne, vstupni_typ,
                              reg_exp, format, min_val, max_val
                              FROM {$this->dbpredpona}gui_element
                              ORDER BY poradi ASC;", $error))
      {
        if ($this->numRows($res) != 0)
        {
          $i = 0;
          $pocetelem = $this->numRows($res);
          $pocnoreg = 0;

          $doplnekid = (!$vlastni ? ($this->var->htaccess ? "/{$id}" : "&amp;{$this->iduserid}={$id}") : "");

          $vypis = array("array_args",
                        $this->absolutni_url,
                        "{$this->dirpath}/{$this->pathscript}",
                        $login,
                        ($this->var->htaccess ? "{$this->idsuicide}{$doplnekid}" : "?{$this->var->get_kam}={$this->idsuicide}{$doplnekid}"));

          while($data = $this->fetchObject($res))
          {
            $povinne = ($data->povinne ? $this->znacka_povinne : "");

            $podminka[$i]["id"] = $data->id;
            $podminka[$i]["name"] = ($typelementu[$data->typ] == "radio" ? $data->value : "elem_{$data->id}"); //name elementu
            $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
            $podminka[$i]["blok"] = $data->value; //blok elementu
            $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
            $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
            $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
            $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
            $podminka[$i]["min"] = $data->min_val;  //minimalni pocet
            $podminka[$i]["max"] = $data->max_val;  //maximalni pocet
            $podminka[$i]["chyba"] = "";
            $podminka[$i]["chyba_form"] = "";
            $podminka[$i]["show"] = $data->profil;  //zobrazovani prvku

            if ($podminka[$i]["show"])  //kdyz jsou prvky v registracce
            {
              switch ($typelementu[$data->typ])
              {
                case "popisek": //popisek
                case "text": //text
                  $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                  $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $nacist[$i]);

                  $vypis[] = $data->id;
                  $vypis[] = $podminka[$i]["nazev"];
                  $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                  $vypis[] = $value;
                  $vypis[] = (Empty($_POST[$podminka[$i]["name"]]) ? " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"" : "");
                  $vypis[] = ($data->readonly ? " readonly=\"readonly\"" : "");
                  $vypis[] = ($data->disabled ? " disabled=\"disabled\"" : "");
                  $vypis[] = $povinne;
                break;

                case "datum": //datum
                case "cas": //cas
                case "datumcas": //datumcas
                  $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                  $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $nacist[$i]);

                  $vypis[] = $data->id;
                  $vypis[] = $podminka[$i]["nazev"];
                  $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                  $vypis[] = $value;
                  $vypis[] = $povinne;
                break;

                case "checkbox": //checkbox
                  $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                  $vypis[] = $data->id;
                  $vypis[] = $podminka[$i]["nazev"];
                  $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                  $vypis[] = $nacist[$i];
                  $vypis[] = (!Empty($nacist[$i]) ? " checked=\"checked\"" : "");
                  $vypis[] = ($data->disabled ? " disabled=\"disabled\"" : "");
                  $vypis[] = $povinne;
                break;

                case "radio": //radio
                  $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], $data->value, $_POST[$data->value]);

                  $vypis[] = $data->id;
                  $vypis[] = $podminka[$i]["nazev"];  //zaroven i value!!!
                  $vypis[] = " name=\"{$podminka[$i]["name"]}\""; //<- je tu value!! tak bycha na to
                  $vypis[] = (!Empty($nacist[$i]) && $nacist[$i] == $data->nazev ? " checked=\"checked\"" : "");
                  $vypis[] = ($data->disabled ? " disabled=\"disabled\"" : "");
                  $vypis[] = $povinne;
                break;

                case "captcha": //captcha kod
                  if (!$this->var->aktivniadmin)
                  {
                    $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $nacist[$i]); //pro id 1
                    $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $nacist[$i], $slovo);  //pro id 1 se slovem

                    $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                    $this->captchakod[$sablona]["id"] = $nacist[$i];
                    $this->captchakod[$sablona]["captcha"] = $captcha;
                    $this->captchakod[$sablona]["slovo"] = $slovo;
                  }

                  $vypis[] = $data->id;
                  $vypis[] = $podminka[$i]["nazev"];
                  $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                  $vypis[] = $nacist[$i];
                  $vypis[] = $captcha;
                  $vypis[] = $slovo;
                  $vypis[] = $povinne;
                break;
              }
            }
              else
            {
              $pocnoreg++;  //spocitani skrytych prvku
            }

            $i++; //musi furt pocitat!
          }
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $vypis[] = " name=\"tlacitko_edit\"";
      $vypis[] = (!Empty($_POST["tlacitko_edit"]) ? " disabled=\"disabled\"" : "");
      $vypis[] = (!Empty($_POST["tlacitko_edit"]) ? "_disabled" : "");

      $result = $this->NactiUnikatniObsah($this->unikatni["normal_edit_user_{$tvar}"],
                                          $vypis);


      $poc = 0;
      $check = true;
      for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
      {
        $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

        if ($podminka[$i]["show"])  //kdyz jsou prvky v registracce
        {
          switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
          {
            case "popisek":
            case "text":
              switch ($podminka[$i]["vstup"])
              {
                case "text":  //konvert textu
                  settype($zpost, "string");

                  if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $podminka[$i]["nazev"]) : "");
                  }
                    else
                  if ($podminka[$i]["min"] > 0 &&
                      $podminka[$i]["max"] > 0)
                  {
                    if (strlen($zpost) < $podminka[$i]["min"] ||
                        strlen($zpost) > $podminka[$i]["max"])
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $podminka[$i]["nazev"]);
                    }
                  }
                    else
                  if ($podminka[$i]["min"] > 0)  //kontrola minina
                  {
                    if (strlen($zpost) < $podminka[$i]["min"])
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $podminka[$i]["nazev"]);
                    }
                  }
                    else
                  if ($podminka[$i]["max"] > 0)  //kontrola maxima
                  {
                    if (strlen($zpost) > $podminka[$i]["max"])
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $podminka[$i]["nazev"]);
                    }
                  }
                break;

                case "integer": //konvert cisla
                  settype($zpost, "integer");

                  if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $podminka[$i]["nazev"]) : "");
                  }
                    else
                  if ($podminka[$i]["min"] > 0 &&
                      $podminka[$i]["max"] > 0)
                  {
                    if ($zpost < $podminka[$i]["min"] ||  //kontrola hodnoty cisel
                        $zpost > $podminka[$i]["max"])
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $podminka[$i]["nazev"]);
                    }
                  }
                    else
                  if ($podminka[$i]["min"] > 0)  //kontrola minina
                  {
                    if ($zpost < $podminka[$i]["min"])
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $podminka[$i]["nazev"]);
                    }
                  }
                    else
                  if ($podminka[$i]["max"] > 0)  //kontrola maxima
                  {
                    if ($zpost > $podminka[$i]["max"])
                    {
                      $zpost = "";
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $podminka[$i]["nazev"]);
                    }
                  }
                break;

                case "reg_exp": //konrola reg_exp
                  if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $podminka[$i]["nazev"]) : "");
                    break;
                  }
                    else
                  {
                    preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                    $zpost = $ret[0];  //vybere nulty index

                    if (Empty($zpost))
                    {
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_reg_exp_{$tvar}"], $podminka[$i]["nazev"]);
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

            case "radio":  //kontrola $_POST
              if (Empty($zpost) && $podminka[$i]["povinne"])
              {
                $check = false;
                $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_radio_{$tvar}"], $podminka[$i]["nazev"]);
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
                $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_checkbox_{$tvar}"], $podminka[$i]["nazev"]);
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
      }

      if (!Empty($_POST["tlacitko_edit"]) &&
          $poc == ($pocetelem - $pocnoreg) && //doladeni poctu zobrazovanych prvku
          $check &&
          !Empty($_POST["login"]))
      {
        $ukladani[] = "";
        for ($i = 0; $i < $pocetelem; $i++)
        {
          switch ($podminka[$i]["typ"])
          {
            case "captcha":
              $ukladani[$i] = $this->captchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
            break;

            default:  //rozdeleni hodnot
              $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
            break;
          }
        }

        $ema = "";
        $login = $this->ChangeWrongChar($this->OsetreniTextu($_POST["login"]));
        $newheslo = md5(md5($this->ChangeWrongChar($_POST["heslo"])));
        $newemail = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);
        $upraveno = date("Y-m-d H:i:s");

        $udaje = "";
        $change_pass = false;
        if (!Empty($_POST["heslo"]) &&
            $newheslo != $heslo &&  //kdyz je jine heslo!
            $newemail == $email)  //musi sedet email
        {
          $dayexpire = $this->NactiUnikatniObsah($this->unikatni["normal_edit_pass_email_expire_{$tvar}"]);

          $udaje[] = $this->ZakodujText("change_pass");
          $udaje[] = $this->ZakodujText($id);
          $udaje[] = $this->ZakodujText($heslo); //stare heslo
          $udaje[] = $this->ZakodujText($newheslo); //nove heslo
          $udaje[] = $this->ZakodujText(date("Y-m-d H:i:s", strtotime("+{$dayexpire} day"))); //+X day od zadaneho data
          $linkact = implode($this->wordroz, $udaje);

          $change_pass = true;

          $obsahmessage = array("array_args",
                                $this->absolutni_url,
                                ($this->var->htaccess ? "{$this->idautorizace}/{$linkact}" : "?{$this->var->get_kam}={$this->idautorizace}&amp;{$this->iduserid}={$linkact}"),
                                $login,
                                $heslo,
                                $newheslo,
                                $email,
                                $upraveno);

          $subject = $this->NactiUnikatniObsah($this->unikatni["normal_edit_pass_email_subject_{$tvar}"], $this->absolutni_url);
          $message = $this->NactiUnikatniObsah($this->unikatni["normal_edit_pass_email_message_{$tvar}"],
                                              $obsahmessage);

          $header = $this->NactiUnikatniObsah($this->unikatni["normal_edit_pass_email_header_{$tvar}"],  //hlavička
                                              $this->hlavicka);
//var_dump($message);
          if (mail($email, $subject, $message, $header))
          {
            $ema = $this->NactiUnikatniObsah($this->unikatni["normal_edit_pass_send_email_{$tvar}"],
                                            $this->absolutni_url,
                                            $email);
          }
            else
          {
            $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_edit_pass_send_email_error_{$tvar}"]), array(__LINE__, __METHOD__));
          }
        }

        $udaje = "";
        if (!Empty($newemail) &&
            $newemail != $email &&  //kdyz je jiny email
            $newheslo == $heslo &&  //musi sedet heslo
            !$change_pass)  //nesmelo byt menene heslo
        {
          $dayexpire = $this->NactiUnikatniObsah($this->unikatni["normal_edit_email_email_expire_{$tvar}"]);

          $udaje[] = $this->ZakodujText("change_email");
          $udaje[] = $this->ZakodujText($id);
          $udaje[] = $this->ZakodujText($email); //stary email
          $udaje[] = $this->ZakodujText($newemail); //novy email
          $udaje[] = $this->ZakodujText(date("Y-m-d H:i:s", strtotime("+{$dayexpire} day"))); //+X day od zadaneho data
          $linkact = implode($this->wordroz, $udaje);

          $obsahmessage = array("array_args",
                                $this->absolutni_url,
                                ($this->var->htaccess ? "{$this->idautorizace}/{$linkact}" : "?{$this->var->get_kam}={$this->idautorizace}&amp;{$this->iduserid}={$linkact}"),
                                $login,
                                $email,
                                $newemail,
                                $upraveno);

          $subject = $this->NactiUnikatniObsah($this->unikatni["normal_edit_email_email_subject_{$tvar}"], $this->absolutni_url);
          $message = $this->NactiUnikatniObsah($this->unikatni["normal_edit_email_email_message_{$tvar}"],
                                              $obsahmessage);

          $header = $this->NactiUnikatniObsah($this->unikatni["normal_edit_email_email_header_{$tvar}"],  //hlavička
                                              $this->hlavicka);
//var_dump($message);
          if (mail($newemail, $subject, $message, $header))
          {
            $ema = $this->NactiUnikatniObsah($this->unikatni["normal_edit_email_send_email_{$tvar}"],
                                            $this->absolutni_url,
                                            $email);
          }
            else
          {
            $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_edit_email_send_email_error_{$tvar}"]), array(__LINE__, __METHOD__));
          }
        }

        //nebude se ukladat heslo ani email!
        $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB

        if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET login='{$login}',
                                                                      upraveno='{$upraveno}',
                                                                      polozky='{$ulozit}'
                                                                      WHERE id={$id};", $error))
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_edit_user_hlaska_{$tvar}"],
                                              $login,
                                              $ema);

          if ($this->NactiUnikatniObsah($this->unikatni["normal_edit_autoclick_{$tvar}"]))
          {
            $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_edit_time_autoclick_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
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
            !Empty($_POST["tlacitko_edit"]))
        {
          if (Empty($_POST["login"])) //rozsireni podminek pro chybu loginu
          {
            $poradi = count($podminka);
            $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Login");
            $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "login", $_POST["login"]);
          }
            else
          { //navraceni obsahu do post
            $poradi = count($podminka);
            if ($this->KontrolaDuplicity($_POST["login"]))
            {
              $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_duplicity_{$tvar}"], $_POST["login"]);
            }
            $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "login", $_POST["login"]);
          }

          if (Empty($_POST["heslo"])) //heslo
          {
            $poradi = count($podminka);
            $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Heslo");
            //$podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "heslo", $_POST["heslo"]);
          }

          if (Empty($_POST["email"])) //email 1
          {
            $poradi = count($podminka);
            $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Email");
            $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email", $_POST["email"]);
          }
            else
          { //navraceni obsahu do post
            $poradi = count($podminka);
            if (Empty($email))
            {
              $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_wrong_email_{$tvar}"], $_POST["email"]);
            }
            $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email", $_POST["email"]);
          }

          $chyba = "";
          $chyba_form = "";
          for ($i = 0; $i < count($podminka); $i++) //$pocetelem
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
                                              $this->absolutni_url);
        }
      }
    }

    return $result;
  }

/**
 *
 * Vypise seznam uzivatelu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "SeznamUzivatelu"[, true, 1]);</strong>
 *
 * @param vlastni zobrazi jen informace o vlastnim profilu (true), pri false ukazuje i cizi
 * @param tvar cislo tvaru
 * @return informace o uzivateli
 */
  public function SeznamUzivatelu($vlastni = true, $tvar = 1)
  {
    //vypise seznam uzivatelu
    $id = $this->AktivniUzivatel(); //nacte si id
    settype($id, "integer");

    $result = "";
    if ($_GET[$this->var->get_kam] == $this->idlistuser &&
        !Empty($id))
    {
      $result = $this->NactiUnikatniObsah($this->unikatni["normal_list_user_begin_{$tvar}"],
                                          $this->absolutni_url,
                                          "{$this->dirpath}/{$this->pathscript}");

      $enable_info = $this->NactiUnikatniObsah($this->unikatni["normal_list_user_enable_info_{$tvar}"]);
      $enable_edit = $this->NactiUnikatniObsah($this->unikatni["normal_list_user_enable_edit_{$tvar}"]);
      $enable_del = $this->NactiUnikatniObsah($this->unikatni["normal_list_user_enable_del_{$tvar}"]);
//last_login, last_ip, last_agent,                               FROM {$this->dbpredpona}uzivatele
//                          (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? gethostbyaddr($data->last_ip) : $data->last_ip),
      //vypis user
      if ($res = $this->query("SELECT
                              user.id id,
                              user.login login,
                              user.heslo heslo,
                              user.email email,
                              user.pridano pridano,
                              user.upraveno upraveno,
                              user.aktivni aktivni,
                              user.polozky polozky,
                              (SELECT ip FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) ip,
                              (SELECT agent FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) agent,
                              (SELECT last_active FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) last_active
                              FROM
                              {$this->dbpredpona}uzivatele user
                              ORDER BY LOWER(login) ASC;", $error))
      {
        if ($this->numRows($res) != 0)
        {
          $vypis = "";
          while ($data = $this->fetchObject($res))
          {
            $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
            $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);

            $doplnekid = (!$vlastni ? ($this->var->htaccess ? "/{$data->id}" : "&amp;{$this->iduserid}={$data->id}") : "");

            $vypis = array("array_args",
                          $this->absolutni_url,
                          $data->id,
                          $data->login,
                          $data->email,
                          date($this->NactiUnikatniObsah($this->unikatni["normal_list_user_datum_{$tvar}"]), strtotime($data->pridano)),
                          date($this->NactiUnikatniObsah($this->unikatni["normal_list_user_datum_{$tvar}"]), strtotime($data->upraveno)),
                          ($data->aktivni ? " checked=\"checked\"" : ""),
                          date($this->NactiUnikatniObsah($this->unikatni["normal_list_user_datum_{$tvar}"]), strtotime($data->last_active)),
                          (date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($data->last_active)) ?
                            $this->NactiUnikatniObsah($this->unikatni["normal_list_user_online_true_{$tvar}"]) :
                            $this->NactiUnikatniObsah($this->unikatni["normal_list_user_online_false_{$tvar}"])),
                          $data->ip,
                          ($vlastni ? "true" : "false"),
                          $browser,
                          $os,
                          ($enable_info ? $this->NactiUnikatniObsah($this->unikatni["normal_list_user_enable_info_link_{$tvar}"],
                                                                    $this->absolutni_url,
                                                                    ($this->var->htaccess ? "{$this->idinfouser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idinfouser}{$doplnekid}"),
                                                                    $data->login) : ""),
                          ($enable_edit ? $this->NactiUnikatniObsah($this->unikatni["normal_list_user_enable_edit_link_{$tvar}"],
                                                                    $this->absolutni_url,
                                                                    ($this->var->htaccess ? "{$this->idedituser}{$doplnekid}" : "?{$this->var->get_kam}={$this->idedituser}{$doplnekid}"),
                                                                    $data->login) : ""),
                          ($enable_del ? $this->NactiUnikatniObsah($this->unikatni["normal_list_user_enable_del_link_{$tvar}"],
                                                                  $this->absolutni_url,
                                                                  ($this->var->htaccess ? "{$this->idsuicide}{$doplnekid}" : "?{$this->var->get_kam}={$this->idsuicide}{$doplnekid}"),
                                                                  $data->login) : ""),
                          "link pro ajax zobrazeni posledních logů"
                          );

            $polozky = explode("|-x-|", $data->polozky);

            $vypis = array_merge($vypis, $polozky);

            $result .= $this->NactiUnikatniObsah($this->unikatni["normal_list_user_{$tvar}"],
                                                $vypis);
          }
        }
          else
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["normal_list_user_null_{$tvar}"]);
        }
      }
        else
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
      }

      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_list_user_end_{$tvar}"]);

    }

    return $result;
  }

/**
 *
 * Registrace uzivatelu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicUser", "Registrace"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return registracni formular
 */
  public function Registrace($tvar = 1)
  {
    //kontrola expirace uzivatelu
    $expdate = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - $this->dayexpire, date("Y")));
    if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE
                            aktivni=0 AND
                            pridano<'{$expdate}';", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while($data = $this->fetchObject($res))
        {
          $deluser[] = $data->id;
        }

        $users = implode(",", $deluser);  //slouceni a odmazani
        if (!$this->queryExec("DELETE FROM {$this->dbpredpona}uzivatele WHERE id IN ({$users});", $error)) //provedeni dotazu
        {
          $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $typelementu = array_keys($this->input);

    if ($res = $this->query("SELECT id, nazev, typ, value,
                            registrace, readonly,
                            disabled, povinne, vstupni_typ,
                            reg_exp, format, min_val, max_val
                            FROM {$this->dbpredpona}gui_element
                            ORDER BY poradi ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $i = 0;
        $pocetelem = $this->numRows($res);
        $pocnoreg = 0;

        $vypis = array("array_args",
                      $this->absolutni_url,
                      "{$this->dirpath}/{$this->pathscript}",
                      $_POST["login"],
                      $_POST["email"],
                      $_POST["email_2"]);

        while($data = $this->fetchObject($res))
        {
          $povinne = ($data->povinne ? $this->znacka_povinne : "");

          $podminka[$i]["id"] = $data->id;
          $podminka[$i]["name"] = ($typelementu[$data->typ] == "radio" ? $data->value : "elem_{$data->id}"); //name elementu
          $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
          $podminka[$i]["blok"] = $data->value; //blok elementu
          $podminka[$i]["typ"] = $typelementu[$data->typ];  //textove oznaceni typu
          $podminka[$i]["povinne"] = $data->povinne;  //bool vyraz povinne
          $podminka[$i]["vstup"] = $this->vstupni_typ[$data->vstupni_typ];  //typ vstupu
          $podminka[$i]["reg_exp"] = $data->reg_exp;  //regularni vyraz
          $podminka[$i]["min"] = $data->min_val;  //minimalni pocet
          $podminka[$i]["max"] = $data->max_val;  //maximalni pocet
          $podminka[$i]["chyba"] = "";
          $podminka[$i]["chyba_form"] = "";
          $podminka[$i]["show"] = $data->registrace;  //zobrazovani prvku

          if ($podminka[$i]["show"])  //kdyz jsou prvky v registracce
          {
            switch ($typelementu[$data->typ])
            {
              case "popisek": //popisek
              case "text": //text
                $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                $vypis[] = $data->id;
                $vypis[] = $podminka[$i]["nazev"];
                $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                $vypis[] = $value;
                $vypis[] = (Empty($_POST[$podminka[$i]["name"]]) ? " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"" : "");
                $vypis[] = ($data->readonly ? " readonly=\"readonly\"" : "");
                $vypis[] = ($data->disabled ? " disabled=\"disabled\"" : "");
                $vypis[] = $povinne;
              break;

              case "datum": //datum
              case "cas": //cas
              case "datumcas": //datumcas
                $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : date($data->format));

                $vypis[] = $data->id;
                $vypis[] = $podminka[$i]["nazev"];
                $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                $vypis[] = $value;
                $vypis[] = $povinne;
              break;

              case "checkbox": //checkbox
                $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                $vypis[] = $data->id;
                $vypis[] = $podminka[$i]["nazev"];
                $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                $vypis[] = $data->value;
                $vypis[] = (!Empty($_POST[$podminka[$i]["name"]]) ? " checked=\"checked\"" : "");
                $vypis[] = ($data->disabled ? " disabled=\"disabled\"" : "");
                $vypis[] = $povinne;
              break;

              case "radio": //radio
                $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], $data->value, $_POST[$data->value]);

                $vypis[] = $data->id;
                $vypis[] = $podminka[$i]["nazev"];  //zaroven i value!!!
                $vypis[] = " name=\"{$podminka[$i]["name"]}\""; //<- je tu value!! tak bycha na to
                $vypis[] = (!Empty($_POST[$data->value]) && $_POST[$data->value] == $data->nazev ? " checked=\"checked\"" : "");
                $vypis[] = ($data->disabled ? " disabled=\"disabled\"" : "");
                $vypis[] = $povinne;
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
                $vypis[] = $podminka[$i]["nazev"];
                $vypis[] = " name=\"{$podminka[$i]["name"]}\"";
                $vypis[] = $data->value;
                $vypis[] = $captcha;
                $vypis[] = $slovo;
                $vypis[] = $povinne;
              break;
            }
          }
            else
          {
            $pocnoreg++;  //spocitani skrytych prvku
          }

          $i++; //musi furt pocitat!
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $vypis[] = " name=\"tlacitko\"";
    $vypis[] = (!Empty($_POST["tlacitko"]) ? " disabled=\"disabled\"" : "");
    $vypis[] = (!Empty($_POST["tlacitko"]) ? "_disabled" : "");

    $result = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_{$tvar}"],
                                        $vypis);

    $poc = 0;
    $check = true;
    for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
    {
      $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

      if ($podminka[$i]["show"])  //kdyz jsou prvky v registracce
      {
        switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
        {
          case "popisek":
          case "text":
            switch ($podminka[$i]["vstup"])
            {
              case "text":  //konvert textu
                settype($zpost, "string");

                if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $podminka[$i]["nazev"]) : "");
                }
                  else
                if ($podminka[$i]["min"] > 0 &&
                    $podminka[$i]["max"] > 0)
                {
                  if (strlen($zpost) < $podminka[$i]["min"] ||
                      strlen($zpost) > $podminka[$i]["max"])
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $podminka[$i]["nazev"]);
                  }
                }
                  else
                if ($podminka[$i]["min"] > 0)  //kontrola minina
                {
                  if (strlen($zpost) < $podminka[$i]["min"])
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $podminka[$i]["nazev"]);
                  }
                }
                  else
                if ($podminka[$i]["max"] > 0)  //kontrola maxima
                {
                  if (strlen($zpost) > $podminka[$i]["max"])
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $podminka[$i]["nazev"]);
                  }
                }
              break;

              case "integer": //konvert cisla
                settype($zpost, "integer");

                if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $podminka[$i]["nazev"]) : "");
                }
                  else
                if ($podminka[$i]["min"] > 0 &&
                    $podminka[$i]["max"] > 0)
                {
                  if ($zpost < $podminka[$i]["min"] ||  //kontrola hodnoty cisel
                      $zpost > $podminka[$i]["max"])
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $podminka[$i]["nazev"]);
                  }
                }
                  else
                if ($podminka[$i]["min"] > 0)  //kontrola minina
                {
                  if ($zpost < $podminka[$i]["min"])
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $podminka[$i]["nazev"]);
                  }
                }
                  else
                if ($podminka[$i]["max"] > 0)  //kontrola maxima
                {
                  if ($zpost > $podminka[$i]["max"])
                  {
                    $zpost = "";
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $podminka[$i]["nazev"]);
                  }
                }
              break;

              case "reg_exp": //konrola reg_exp
                if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                {
                  $zpost = "";
                  $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $podminka[$i]["nazev"]) : "");
                  break;
                }
                  else
                {
                  preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                  $zpost = $ret[0];  //vybere nulty index

                  if (Empty($zpost))
                  {
                    $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_reg_exp_{$tvar}"], $podminka[$i]["nazev"]);
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

          case "radio":  //kontrola $_POST
            if (Empty($zpost) && $podminka[$i]["povinne"])
            {
              $check = false;
              $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_radio_{$tvar}"], $podminka[$i]["nazev"]);
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
              $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_checkbox_{$tvar}"], $podminka[$i]["nazev"]);
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
    }

    $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);
    $email_2 = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email_2"]);

    if (!Empty($_POST["tlacitko"]) &&
        $poc == ($pocetelem - $pocnoreg) && //doladeni poctu zobrazovanych prvku
        !Empty($_POST["login"]) &&
        !$this->KontrolaDuplicity($_POST["login"]) &&
        !Empty($_POST["heslo"]) &&
        !Empty($_POST["heslo_2"]) &&
        $_POST["heslo"] == $_POST["heslo_2"] &&
        !Empty($email) &&
        !Empty($email_2) &&
        $_POST["email"] == $_POST["email_2"] &&
        $check)
    {
      $ukladani[] = "";
      for ($i = 0; $i < $pocetelem; $i++)
      {
        if ($podminka[$i]["show"])  //kdyz jsou prvky v registracce
        {
          switch ($podminka[$i]["typ"])
          {
            case "captcha":
              $ukladani[$i] = $this->captchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
            break;

            default:  //rozdeleni hodnot
              $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
            break;
          }
        }
          else
        {
          $ukladani[$i] = "";  //vraceni prazdneho obsahu
        }
      }

      $login = $this->ChangeWrongChar($this->OsetreniTextu($_POST["login"]));
      $heslo = md5(md5($this->ChangeWrongChar($_POST["heslo"])));

      $pridano = date("Y-m-d H:i:s");
      $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);
      //$ip = $_SERVER["REMOTE_ADDR"];
      //$agent = $_SERVER["HTTP_USER_AGENT"];
      $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
//'', '{$ip}', '{$agent}',last_login, last_ip, last_agent,
      if ($this->queryExec("INSERT INTO {$this->dbpredpona}uzivatele (id, login, heslo, email, pridano, upraveno, aktivni, polozky) VALUES
                            (NULL, '{$login}', '{$heslo}', '{$email}', '{$pridano}', '', 0, '{$ulozit}');", $error))
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_hlaska_{$tvar}"], $login);

        $dat = strtotime($pridano);
        //mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("m", $dat), date("d", $dat) + $this->dayexpire, date("Y", $dat))
        $expdate = date("Y-m-d H:i:s", strtotime("+{$this->dayexpire} day", $dat)); //+X day od zadaneho data
        $udaje[] = $this->ZakodujText("authorize_user");
        $udaje[] = $this->ZakodujText($login);
        $udaje[] = $this->ZakodujText($email);
        $udaje[] = $this->ZakodujText($expdate);
        $linkact = implode($this->wordroz, $udaje);

        $obsahmessage = array("array_args",
                              $this->absolutni_url,
                              ($this->var->htaccess ? "{$this->idautorizace}/{$linkact}" : "?{$this->var->get_kam}={$this->idautorizace}&amp;{$this->iduserid}={$linkact}"),
                              $login,
                              $heslo,
                              $email,
                              $pridano,
                              $expdate);

        $obsahmessage = array_merge($obsahmessage, $ukladani);  //slouceni obsahu s ukadacima informacema

        $subject = $this->NactiUnikatniObsah($this->unikatni["normal_email_subject_{$tvar}"], $this->absolutni_url);
        $message = $this->NactiUnikatniObsah($this->unikatni["normal_email_message_{$tvar}"],
                                            $obsahmessage);

        $header = $this->NactiUnikatniObsah($this->unikatni["normal_email_header_{$tvar}"],  //hlavička
                                            $this->hlavicka);

        if (!mail($email, $subject, $message, $header))
        {
          $this->var->main[0]->ErrorMsg($this->NactiUnikatniObsah($this->unikatni["normal_send_email_error_{$tvar}"]), array(__LINE__, __METHOD__));
        }

        if ($this->NactiUnikatniObsah($this->unikatni["normal_reg_autoclick_{$tvar}"]))
        {
          $this->var->main[0]->AutoClick($this->NactiUnikatniObsah($this->unikatni["normal_reg_time_autoclick_{$tvar}"]), $this->absolutni_url);  //auto kliknuti
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
          !Empty($_POST["tlacitko"]))
      {
        if (Empty($_POST["login"])) //rozsireni podminek pro chybu loginu
        {
          $poradi = count($podminka);
          $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Login");
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "login", $_POST["login"]);
        }
          else
        { //navraceni obsahu do post
          $poradi = count($podminka);
          if ($this->KontrolaDuplicity($_POST["login"]))
          {
            $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_duplicity_{$tvar}"], $_POST["login"]);
          }
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "login", $_POST["login"]);
        }


        if (Empty($_POST["heslo"])) //heslo
        {
          $poradi = count($podminka);
          $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Heslo");
          //$podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "heslo", $_POST["heslo"]);
        }

        if (!Empty($_POST["heslo"]) &&
            !Empty($_POST["heslo_2"]) &&
            $_POST["heslo"] != $_POST["heslo_2"])
        {
          $poradi = count($podminka);
          $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_pass_not_equal_{$tvar}"]);
        }


        if (Empty($_POST["email"])) //email 1
        {
          $poradi = count($podminka);
          $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Email");
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email", $_POST["email"]);
        }
          else
        { //navraceni obsahu do post
          $poradi = count($podminka);
          if (Empty($email))
          {
            $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_wrong_email_{$tvar}"], $_POST["email"]);
          }
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email", $_POST["email"]);
        }

        if (Empty($_POST["email_2"])) //email 2
        {
          $poradi = count($podminka);
          $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], "Email 2");
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email_2", $_POST["email_2"]);
        }
          else
        { //navraceni obsahu do post
          $poradi = count($podminka);
          if (Empty($email_2))
          {
            $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_wrong_email_{$tvar}"], $_POST["email_2"]);
          }
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email_2", $_POST["email_2"]);
        }

        if (!Empty($email) &&
            !Empty($email_2) &&
            $email != $email_2)
        {
          $poradi = count($podminka);
          $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_email_not_equal_{$tvar}"]);
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email", $_POST["email"]);
          $poradi = count($podminka);
          $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], "email_2", $_POST["email_2"]);
        }

        $chyba = "";
        $chyba_form = "";
        for ($i = 0; $i < count($podminka); $i++) //$pocetelem
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
                                            $this->absolutni_url);  //auto kliknuti
      }
    }

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
          $result = $this->AdministraceObsahu();
        break;

        case "{$this->idmodul}{$this->subadmin}": //vypis uzivatelu
          $result = $this->AdminVypisUser();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vrati select pro vyber ze vstupu
 *
 * @param id id polozky vstupu, nepovinne
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
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati select pro vyber z elementu
 *
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberTypu($id = NULL, $adresa = NULL)
  {
    $typ = array_keys($this->input);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_begin"], $adresa);

    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i],
                                          $this->input[$typ[$i]]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati pocet elementu v danem formulari
 *
 * @param formular cislo formulare
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($inc = 0)
  {
    settype($inc, "integer");

    $result = 0;
    if ($res = $this->query("SELECT COUNT(id) pocet FROM {$this->dbpredpona}gui_element;", $error))
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
 * Kontroluje duplicitu uzivatelu
 *
 * @param login login uzivatele
 * @return true/false - existuje/neexistuje
 */
  private function KontrolaDuplicity($login)
  {
    $result = false;
    if ($res = $this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE login='{$login}';", $error))
    {
      $result = ($this->numRows($res) != 0 ? true : false);
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

    $cesta = "{$this->dirpath}/{$this->pathscript}/ajax.js";  //js jde do slozky
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
 * Vrati hodnotu daneho sloupce
 *
 * @param id user id
 * @param sloupec nazev sloupce v databazi
 * @return hodnota sloupce
 */
  private function VypisSloupce($id, $sloupec)
  {
    settype($id, "integer");

    $result = "";
    if ($res = $this->query("SELECT {$sloupec} vyst
                            FROM {$this->dbpredpona}uzivatele
                            WHERE
                            id={$id};", $error))
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho formulare
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgui",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adduser",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=stat",
                                        $this->AdminVypisGUI());

    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $typelementu = array_keys($this->input);

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

        case "addgui": //pridavani GUI
          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstupni_typ"];
          settype($vstup, "integer");

          $jmeno_typu = array_keys($this->input);
          $aktualni_typ = $jmeno_typu[$type];

          $zobr_value = ($aktualni_typ == "popisek" || $aktualni_typ == "text");
          $zobr_checkbox = ($aktualni_typ == "checkbox");
          $zobr_disabled = ($aktualni_typ == "popisek" || $aktualni_typ == "text" || $aktualni_typ == "checkbox" || $aktualni_typ == "radio");
          $zobr_captcha = ($aktualni_typ == "captcha");
          $zobr_group = ($aktualni_typ == "radio");
          $zobr_format = ($aktualni_typ == "datum" || $aktualni_typ == "cas" || $aktualni_typ == "datumcas");
          $datumy = ($aktualni_typ == "datum" ? "j.n.Y" : ($aktualni_typ == "cas" ? "H:i:s" : ($aktualni_typ == "datumcas" ? "j.n.Y H:i:s" : "")));

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_gui"],
                                              $this->VyberTypu($type, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgui&amp;vstup={$vstup}"),
                                              ($zobr_value || $zobr_checkbox ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_value"], "") : ""),
                                              ($zobr_captcha ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_captcha"], 1) : ""),
                                              ($zobr_group ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_group"], "") : ""),
                                              ($zobr_value ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_readonly"], "") : ""),
                                              ($zobr_disabled ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_disabled"], "") : ""),
                                              ($zobr_value ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_vstupni_typ"], $this->VyberVstupu($vstup, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addgui&amp;typ={$type}")) : ""),
                                              ($zobr_value && $vstup == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_reg_exp"], "") : ""),
                                              ($zobr_format ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_vystupni_typ"], $datumy, date($datumy)) : ""),
                                              ($zobr_value && $vstup >= 0 && $vstup <= 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_minmax_val"], 0, 0) : ""),
                                              $this->PocetRadku(1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $typ = $this->ChangeWrongChar($_POST["typ"]);
          settype($typ, "integer");
          $value = $this->ChangeWrongChar($_POST["value"]);
          $registrace = (!Empty($_POST["registrace"]) ? 1 : 0);
          $profil = (!Empty($_POST["profil"]) ? 1 : 0);
          $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
          $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
          $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
          $vstupni_typ = $_POST["vstupni_typ"];
          settype($vstupni_typ, "integer");
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : $this->ChangeWrongChar($_POST["reg_exp"]));
          $format = $this->ChangeWrongChar($_POST["format"]);
          $min_val = $_POST["min_val"];
          settype($min_val, "integer");
          $max_val = $_POST["max_val"];
          settype($max_val, "integer");
          $poradi = $_POST["poradi"];
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($nazev))
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}gui_element (id, nazev, typ, value, registrace, profil, readonly, disabled, povinne, vstupni_typ, reg_exp, format, min_val, max_val, poradi) VALUES
                                  (NULL, '{$nazev}', {$typ}, '{$value}', {$registrace}, {$profil}, {$readonly}, {$disabled}, {$povinne}, {$vstupni_typ}, '{$reg_exp}', '{$format}', {$min_val}, {$max_val}, {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_gui_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editgui":  //editace GUI
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstupni_typ"];
          settype($vstup, "integer");

          if ($res = $this->query("SELECT id, nazev, typ, value, registrace, profil, readonly, disabled, povinne, vstupni_typ, reg_exp, format, min_val, max_val, poradi FROM {$this->dbpredpona}gui_element WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $type_1 = (isset($_GET["typ"]) ? $type : $data->typ);
              $vstup_1 = (isset($_GET["vstupni_typ"]) ? $vstup : $data->vstupni_typ);

              $jmeno_typu = array_keys($this->input);
              $aktualni_typ = $jmeno_typu[$type_1];

              $zobr_value = ($aktualni_typ == "popisek" || $aktualni_typ == "text");
              $zobr_checkbox = ($aktualni_typ == "checkbox");
              $zobr_disabled = ($aktualni_typ == "popisek" || $aktualni_typ == "text" || $aktualni_typ == "checkbox" || $aktualni_typ == "radio");
              $zobr_captcha = ($aktualni_typ == "captcha");
              $zobr_group = ($aktualni_typ == "radio");
              $zobr_format = ($aktualni_typ == "datum" || $aktualni_typ == "cas" || $aktualni_typ == "datumcas");

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_gui"],
                                                  $data->nazev,
                                                  $this->VyberTypu($type_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgui&amp;id={$id}&amp;vstup={$vstup_1}"),
                                                  ($zobr_value || $zobr_checkbox ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_value"], $data->value) : ""),
                                                  ($zobr_captcha ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_captcha"], $data->value) : ""),
                                                  ($zobr_group ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_group"], $data->value) : ""),
                                                  ($data->registrace ? " checked=\"checked\"" : ""),
                                                  ($data->profil ? " checked=\"checked\"" : ""),
                                                  ($zobr_value ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_readonly"], ($data->readonly ? " checked=\"checked\"" : "")) : ""),
                                                  ($zobr_disabled ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_disabled"], ($data->disabled ? " checked=\"checked\"" : "")) : ""),
                                                  ($data->povinne ? " checked=\"checked\"" : ""),
                                                  ($zobr_value ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_vstupni_typ"], $this->VyberVstupu($vstup_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgui&amp;id={$id}&amp;typ={$type_1}")) : ""),
                                                  ($zobr_value && $vstup == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_reg_exp"], $data->reg_exp) : ""),
                                                  ($zobr_format ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_vystupni_typ"], $data->format, date($data->format)) : ""),
                                                  ($zobr_value && $vstup >= 0 && $vstup <= 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_minmax_val"], $data->min_val, $data->max_val) : ""),
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $typ = $this->ChangeWrongChar($_POST["typ"]);
              settype($typ, "integer");
              $value = $this->ChangeWrongChar($_POST["value"]);
              $registrace = (!Empty($_POST["registrace"]) ? 1 : 0);
              $profil = (!Empty($_POST["profil"]) ? 1 : 0);
              $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
              $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $vstupni_typ = $_POST["vstupni_typ"];
              settype($vstupni_typ, "integer");
              $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : $this->ChangeWrongChar($_POST["reg_exp"]));
              $format = $this->ChangeWrongChar($_POST["format"]);
              $min_val = $_POST["min_val"];
              settype($min_val, "integer");
              $max_val = $_POST["max_val"];
              settype($max_val, "integer");
              $poradi = $_POST["poradi"];
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($nazev) &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}gui_element SET nazev='{$nazev}',
                                                                                typ={$typ},
                                                                                value='{$value}',
                                                                                registrace={$registrace},
                                                                                profil={$profil},
                                                                                readonly={$readonly},
                                                                                disabled={$disabled},
                                                                                povinne={$povinne},
                                                                                vstupni_typ={$vstupni_typ},
                                                                                reg_exp='{$reg_exp}',
                                                                                format='{$format}',
                                                                                min_val={$min_val},
                                                                                max_val={$max_val},
                                                                                poradi={$poradi}
                                                                                WHERE id={$id};
                                                                                ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_gui_hlaska"], $nazev);

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

        case "delgui": //mazani GUI
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}gui_element WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}gui_element WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_gui_hlaska"], $data->nazev);

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

        case "adduser": //pridani uzivatele
          if ($res = $this->query("SELECT id, nazev, typ, value,
                                  registrace, profil, readonly,
                                  disabled, povinne, vstupni_typ,
                                  reg_exp, format, min_val, max_val
                                  FROM {$this->dbpredpona}gui_element
                                  ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res) != 0)
            {
              $element = "";
              $i = 0;
              $pocetelem = $this->numRows($res);
              $poradielem = 6;  //od

              while($data = $this->fetchObject($res))
              {
                $povinne = ($data->povinne ? $this->znacka_povinne : "");

                $podminka[$i]["id"] = $data->id;
                $podminka[$i]["name"] = ($typelementu[$data->typ] == "radio" ? $data->value : "elem_{$data->id}"); //name elementu
                $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
                $podminka[$i]["blok"] = $data->value; //blok elementu
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
                  case "popisek": //popisek
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          (Empty($_POST["elem_{$data->id}"]) ? " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"" : ""),
                                                          $povinne,
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "text": //text
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value,
                                                          (Empty($_POST["elem_{$data->id}"]) ? " onfocus=\"this.value=(this.value == '{$value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$value}' : this.value);\"" : ""),
                                                          $povinne,
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "datum": //datum
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : date($data->format));

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value, //$data->value,
                                                          $povinne,
                                                          $data->format,
                                                          date($data->format),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "cas": //cas
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : date($data->format));

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_cas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value, //$data->value,
                                                          $povinne,
                                                          $data->format,
                                                          date($data->format),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "datumcas": //datumcas
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);
                    $value = (!Empty($_POST["elem_{$data->id}"]) ? $_POST["elem_{$data->id}"] : date($data->format));

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $value, //$data->value,
                                                          $povinne,
                                                          $data->format,
                                                          date($data->format),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "checkbox": //checkbox
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_checkbox"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $povinne,
                                                          (!Empty($_POST["elem_{$data->id}"]) ? " checked=\"checked\"" : ""),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "radio": //radio
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->value, $_POST[$data->value]);
                    $value = (!Empty($_POST[$data->value]) ? $_POST[$data->value] : $data->value);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_radio"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value, //name bere z value
                                                          $povinne,
                                                          (!Empty($_POST[$data->value]) && $_POST[$data->value] == $data->nazev ? " checked=\"checked\"" : ""),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "captcha": //captcha kod
                    if ($this->var->aktivniadmin)
                    {
                      $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $data->value); //pro id 1
                      $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $data->value, $slovo);  //pro id 1 se slovem

                      $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                      $this->admincaptchakod[$sablona]["id"] = $data->value;
                      $this->admincaptchakod[$sablona]["captcha"] = $captcha;
                      $this->admincaptchakod[$sablona]["slovo"] = $slovo;
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_captcha"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $slovo,
                                                          $captcha,
                                                          $povinne,
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
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

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_user"],
                                              $element,
                                              "{$this->dirpath}/{$this->pathscript}",
                                              $_POST["login"],
                                              $_POST["email"],
                                              (!Empty($_POST["aktivni"]) ? " checked=\"checked\"" : ""),
                                              " name=\"tlacitko\"",
                                              (!Empty($_POST["tlacitko"]) ? " disabled=\"disabled\"" : ""),
                                              (!Empty($_POST["tlacitko"]) ? "_disabled" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $poc = 0;
          $check = true;
          for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
          {
            //$zpost = $_POST[$podminka[$i]["name"]];
            $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

            switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
            {
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

              case "radio":  //kontrola $_POST
                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_radio"], $podminka[$i]["nazev"]);
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

          $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);
          //$email_2 = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email_2"]);

          if (!Empty($_POST["tlacitko"]) &&
              $poc == $pocetelem &&
              !Empty($_POST["login"]) &&
              !$this->KontrolaDuplicity($_POST["login"]) &&
              !Empty($_POST["heslo"]) &&
              //!Empty($_POST["heslo_2"]) &&
              //$_POST["heslo"] == $_POST["heslo_2"] &&
              !Empty($email) &&
              //!Empty($email_2) &&
              //$_POST["email"] == $_POST["email_2"] &&
              $check)
          {
            $ukladani[] = "";
            for ($i = 0; $i < $pocetelem; $i++)
            {
              switch ($podminka[$i]["typ"])
              {
                case "captcha":
                  $ukladani[$i] = $this->admincaptchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
                break;

                default:  //rozdeleni hodnot
                  $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
                break;
              }
            }

            $login = $this->ChangeWrongChar($this->OsetreniTextu($_POST["login"]));
            $heslo = md5(md5($this->ChangeWrongChar($_POST["heslo"])));
            //$email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);

            $pridano = date("Y-m-d H:i:s");
            $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);
            //$ip = $_SERVER["REMOTE_ADDR"];
            //$agent = $_SERVER["HTTP_USER_AGENT"];
            $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
//last_login, last_ip, last_agent,'', '{$ip}', '{$agent}',
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}uzivatele (id, login, heslo, email, pridano, upraveno, aktivni, polozky) VALUES
                                  (NULL, '{$login}', '{$heslo}', '{$email}', '{$pridano}', '', {$aktivni}, '{$ulozit}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_user_hlaska"], $login);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->subadmin}");  //auto kliknuti
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
              if (Empty($_POST["login"])) //rozsireni podminek pro chybu loginu
              {
                $poradi = count($podminka);
                $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], "Login");
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "login", $_POST["login"]);
              }
                else
              { //navraceni obsahu do post
                $poradi = count($podminka);
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "login", $_POST["login"]);
              }

              if (Empty($_POST["heslo"])) //heslo
              {
                $poradi = count($podminka);
                $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], "Heslo");
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "heslo", $_POST["heslo"]);
              }
                else
              { //navraceni obsahu do post
                $poradi = count($podminka);
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "heslo", $_POST["heslo"]);
              }

              if (Empty($_POST["email"])) //email
              {
                $poradi = count($podminka);
                $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], "Email");
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "email", $_POST["email"]);
              }
                else
              { //navraceni obsahu do post
                $poradi = count($podminka);
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "email", $_POST["email"]);
              }

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
                                                  "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->subadmin}");  //auto kliknuti
            }
          }
        break;




        case "edituser":  //uprava uzivatele
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT login, heslo, email, aktivni, polozky FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);
              $obsah = $data->polozky;

              $login = $data->login;
              $heslo = $data->heslo;
              $email = $data->email;
              $aktivni = $data->aktivni;
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $nacist = explode("|-x-|", $obsah); //znovu rozdeleni

          if ($res = $this->query("SELECT id, nazev, typ, value,
                                    registrace, profil, readonly,
                                    disabled, povinne, vstupni_typ,
                                    reg_exp, format, min_val, max_val
                                    FROM {$this->dbpredpona}gui_element
                                    ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res) != 0)
            {
              $element = "";
              $i = 0;
              $pocetelem = $this->numRows($res);
              $poradielem = 5;  //od

              while($data = $this->fetchObject($res))
              {
                $povinne = ($data->povinne ? $this->znacka_povinne : "");

                $podminka[$i]["id"] = $data->id;
                $podminka[$i]["name"] = ($typelementu[$data->typ] == "radio" ? $data->value : "elem_{$data->id}"); //name elementu
                $podminka[$i]["nazev"] = $data->nazev; //nazev elementu
                $podminka[$i]["blok"] = $data->value; //blok elementu
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
                  case "popisek": //popisek
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_popisek"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          $povinne,
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "text": //text
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_text"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          "",
                                                          $povinne,
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "datum": //datum
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datum"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $povinne,
                                                          $data->format,
                                                          date($data->format),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "cas": //cas
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_cas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $povinne,
                                                          $data->format,
                                                          date($data->format),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "datumcas": //datumcas
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_datumcas"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $povinne,
                                                          $data->format,
                                                          date($data->format),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "checkbox": //checkbox
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "elem_{$data->id}", $_POST["elem_{$data->id}"]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_checkbox"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value,
                                                          $povinne,
                                                          (!Empty($nacist[$i]) ? " checked=\"checked\"" : ""),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "radio": //radio
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], $data->value, $_POST[$data->value]);

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_radio"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $data->value, //name bere z value
                                                          $povinne,
                                                          (!Empty($nacist[$i]) && $nacist[$i] == $data->nazev ? " checked=\"checked\"" : ""),
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
                  break;

                  case "captcha": //captcha kod
                    if ($this->var->aktivniadmin)
                    {
                      $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $nacist[$i]); //pro id 1
                      $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $nacist[$i], $slovo);  //pro id 1 se slovem

                      $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                      $this->admincaptchakod[$sablona]["id"] = $nacist[$i];
                      $this->admincaptchakod[$sablona]["captcha"] = $captcha;
                      $this->admincaptchakod[$sablona]["slovo"] = $slovo;
                    }

                    $element .= $this->NactiUnikatniObsah($this->unikatni["admin_addeditobsah_captcha"],
                                                          $data->nazev,
                                                          $data->id,
                                                          $nacist[$i],
                                                          $slovo,
                                                          $captcha,
                                                          $povinne,
                                                          $poradielem);

                    $poradielem += $this->pocitadloporadi[$data->typ];
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

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_user"],
                                              $element,
                                              "{$this->dirpath}/{$this->pathscript}",
                                              $login,
                                              $email,
                                              ($aktivni ? " checked=\"checked\"" : ""),
                                              " name=\"tlacitko\"",
                                              (!Empty($_POST["tlacitko"]) ? " disabled=\"disabled\"" : ""),
                                              (!Empty($_POST["tlacitko"]) ? "_disabled" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $poc = 0;
          $check = true;
          for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni
          {
            //$zpost = $_POST[$podminka[$i]["name"]];
            $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

            switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
            {
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

              case "radio":  //kontrola $_POST
                if (Empty($zpost) && $podminka[$i]["povinne"])
                {
                  $check = false;
                  $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_radio"], $podminka[$i]["nazev"]);
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

          $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);

          if (!Empty($_POST["tlacitko"]) &&
              $poc == $pocetelem &&
              $check &&
              !Empty($_POST["login"]) &&
              //!$this->KontrolaDuplicity($_POST["login"]) &&
              //!Empty($_POST["heslo"]) && - podle jinych podminek!
              //!Empty($_POST["heslo_2"]) &&
              //$_POST["heslo"] == $_POST["heslo_2"] &&
              !Empty($email) //&& -
              //!Empty($_POST["email_2"]) &&
              //$_POST["email"] == $_POST["email_2"]
              )
          {
            $ukladani[] = "";
            for ($i = 0; $i < $pocetelem; $i++)
            {
              switch ($podminka[$i]["typ"])
              {
                case "captcha":
                  $ukladani[$i] = $this->admincaptchakod[$sablona]["id"]; //ulozi ID captchy a ne hodnotu!
                break;

                default:  //rozdeleni hodnot
                  $ukladani[$i] = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]);  //osetreni textu!!
                break;
              }
            }

            $login = $this->ChangeWrongChar($this->OsetreniTextu($_POST["login"]));
            $heslo = (!Empty($_POST["heslo"]) ? md5(md5($this->ChangeWrongChar($_POST["heslo"]))) : $heslo);
            //$email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]); bacha!!!!

            $upraveno = date("Y-m-d H:i:s");
            $aktivni = (!Empty($_POST["aktivni"]) ? 1 : 0);
            //$ip = $_SERVER["REMOTE_ADDR"];
            //$agent = $_SERVER["HTTP_USER_AGENT"];
            $ulozit = implode("|-x-|", $ukladani);  //ulozit do DB
//last_ip='{$ip}',
//last_agent='{$agent}',
            if ($this->queryExec("UPDATE {$this->dbpredpona}uzivatele SET login='{$login}',
                                                                          heslo='{$heslo}',
                                                                          email='{$email}',
                                                                          upraveno='{$upraveno}',
                                                                          aktivni='{$aktivni}',
                                                                          polozky='{$ulozit}'
                                                                          WHERE id={$id};", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_user_hlaska"], $login);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->subadmin}");  //auto kliknuti
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
              if (Empty($_POST["login"])) //rozsireni podminek pro chybu loginu
              {
                $poradi = count($podminka);
                $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], "Login");
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "login", $_POST["login"]);
              }
                else
              { //navraceni obsahu do post
                $poradi = count($podminka);
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "login", $_POST["login"]);
              }

              if (Empty($_POST["heslo"])) //heslo
              {
                $poradi = count($podminka);
                $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], "Heslo");
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "heslo", $_POST["heslo"]);
              }
                else
              { //navraceni obsahu do post
                $poradi = count($podminka);
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "heslo", $_POST["heslo"]);
              }

              if (Empty($_POST["email"])) //email
              {
                $poradi = count($podminka);
                $podminka[$poradi]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_empty"], "Email");
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "email", $_POST["email"]);
              }
                else
              { //navraceni obsahu do post
                $poradi = count($podminka);
                $podminka[$poradi]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["admin_error_hidden"], "email", $_POST["email"]);
              }

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
                                                  "{$this->absolutni_url}?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->subadmin}");  //auto kliknuti
            }
          }
        break;


        case "deluser": //mazani uzivatele
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");  //pripadne i sem ... !in_array(5, $this->undying_user);

          if ($res = $this->query("SELECT login FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}uzivatele WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_user_hlaska"], $data->login);

                $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->subadmin}");  //auto kliknuti
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


        case "stat":
          //statistika

          //prubezna kontrola duplicity emailu (uzivatelu podle emailu)!!
          //uzivatel musu mit nejakou moznost pozadat o automaticke vymazani z databaze.. z profilu...
          //pod confirm otazkou a heslem a potvrzeni emailem!!
        break;
      }
    }

    return $result;
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
    $prevod = $this->NactiUnikatniObsah($this->unikatni["set_prevod"]);

    return strtr($text, $prevod);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Vypis administrace uzivatelu
 *
 * @return vypis menu v html
 */
  private function AdminVypisGUI()
  {
    $typ = array_keys($this->input);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_gui_begin"],
                                        $this->absolutni_url,
                                        $this->dirpath);
    //vypis gui
    if ($res = $this->query("SELECT id, nazev, typ, value, registrace, profil, readonly, disabled, povinne, vstupni_typ, reg_exp, format, min_val, max_val, poradi FROM {$this->dbpredpona}gui_element ORDER BY poradi ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_gui"],
                                              $data->id,
                                              $data->poradi,
                                              $data->nazev,
                                              $typ[$data->typ],
                                              ($data->registrace ? " checked=\"checked\"" : ""),
                                              ($data->profil ? " checked=\"checked\"" : ""),
                                              ($data->povinne ? " checked=\"checked\"" : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editgui&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delgui&amp;id={$data->id}");
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_gui_end"]);

    return $result;
  }

/**
 *
 * Vypis administrace uzivatelu
 *
 * @return vypis menu v html
 */
  private function AdminVypisUser()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_begin"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=adduser",
                                        "{$this->dirpath}/{$this->pathscript}",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

    //vypis user
    if ($res = $this->query("SELECT user.id id,
                            user.login login,
                            user.heslo heslo,
                            user.email email,
                            user.pridano pridano,
                            user.upraveno upraveno,
                            user.aktivni aktivni,
                            user.polozky polozky,
                            (SELECT ip FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) ip,
                            (SELECT agent FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) agent,
                            (SELECT last_active FROM {$this->dbpredpona}last_login last_log WHERE user.id=last_log.uzivatel ORDER BY last_log.last_active DESC LIMIT 0,1) last_active
                            FROM
                            {$this->dbpredpona}uzivatele user
                            ORDER BY user.pridano ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
        {
          $browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $data->agent);
          $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $data->agent);

          $vypis = array("array_args",
                        $data->id,
                        $data->login,
                        $data->email,
                        date($this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_datum"]), strtotime($data->pridano)),
                        date($this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_datum"]), strtotime($data->upraveno)),
                        ($data->aktivni ? " checked=\"checked\"" : ""),
                        date($this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_datum"]), strtotime($data->last_active)),
                        (date("Y-m-d H:i:s") < date("Y-m-d H:i:s", strtotime($data->last_active)) ?
                            $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_online_true"]) :
                            $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_online_false"])),
                        $data->ip,
                        $browser,
                        $os,
                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edituser&amp;id={$data->id}",
                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=deluser&amp;id={$data->id}");

          $polozky = explode("|-x-|", $data->polozky);

          $vypis = array_merge($vypis, $polozky);

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user"],
                                              $vypis);
        }
      }
        else
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_null"]);
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_user_end"]);

    return $result;
  }
}
?>
