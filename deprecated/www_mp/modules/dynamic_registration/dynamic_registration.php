<?php

/**
 *
 * Blok registracniho modulu
 *
 */

//verze modulu
define("v_DynamicRegistration", "0.28");

class DynamicRegistration extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona, $mainindex;
  public $idmodul = "dynreg";  //id pro rozliseni modulu v adminu
  private $idstat = "_stat";
  private $iduser = "_user";
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array();

  private $localpermit;

  private $cfgexplode = "|--xx--|"; //text pro rozdeleni konfigurace
  private $cookiename = "coknam";
  //private $get_registre = "registrace";
  private $get_logoff = "userlogoff"; //nesmi se krizit s funkci!
  private $get_profile = "upravit-profil";
  private $get_public_profile = "public-profile";
  private $get_info = "profil";
  private $maxsizepic = 6;  //MB
  private $pathpicture = "userfoto";

  private $usersett = ".usseetrting";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idstat, $this->iduser);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      //$this->mainindex = $index;

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul,
                                                $this->idstat,
                                                $this->iduser);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);  //pripojeni defaultu

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul,
                                                          $this->idstat,
                                                          $this->iduser));
    }
  }

//dodelat!!
//kompletne prepsat
//hlavni sekce: bude sekce konfigurace
//sekce: konfigurace: typ registrace, nejake texty, expirace logu, podminky zobrazeni (kdy editovat profil a pod.)
//sekce: vypis uzivatelu: vypis se strankovanim, sortovani a filtrovani:
//                       aktivni,neaktivni,vsichni/,razeni podle nekolika veci
//sekce: statistiky: vypis logovani uzivatelu a pod.
//konfigurace pridavnych elementu bude z unikatnich, nadefinovanaych v poli
//vystupy: online user, login user, uprava profilu, aktualni prihlaseny user
//func.vystupy: id current user, pole vsech uzivtelu?

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

        case "{$this->idmodul}{$this->idstat}":  //vypis statistik
          $result = "statistiky, coming soon...";
        break;

        case "{$this->idmodul}{$this->iduser}":  //vypis uzivatelu
          $result = $this->AdminObsahUser();
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}user (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                login VARCHAR(100),
                                heslo VARCHAR(100),
                                email VARCHAR(200),
                                pridano DATETIME,
                                upraveno DATETIME,
                                aktivni BOOL,
                                polozky TEXT);

                              CREATE TABLE {$this->dbpredpona}last_log (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                user INTEGER UNSIGNED,
                                session VARCHAR(100),
                                logon DATETIME,
                                last_act DATETIME,
                                agent VARCHAR(300),
                                ip VARCHAR(50));
                                ");
  }

/**
 *
 * Vyis uzivatelu a jejich sprava
 *
 * @return admin uzivatelu
 */
  private function AdminObsahUser()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah_user"],
                                        $this->AdminVypisObsahUser());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "infouser":  //info o uzivateli
          $id = $_GET["id"];
          settype($id, "integer");
//dodelat!!
          //mozna informace o uzivateli
        break;

        case "edituser":  //uprava uzivatele
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT login, email, aktivni, polozky FROM {$this->dbpredpona}user WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_edituser"],
                                                $data->login,
                                                $data->email,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                $this->AdminVypisKonfiguraceFormulare($data->polozky),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iduser}");

            //zpracovani polozek z postu
            $pole = $this->ZpracovaniKonfiguraceFormulare("admin", $data->polozky, $chyba);

            $stav = $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaRegistraci", array("email" => $data->email, "smer" => "check"));
            $stav_post = $this->NotEmpty("post", "admin_novinky");
            $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaRegistraci", array("email" => $data->email, "smer" => ($stav ? ($stav_post == "on" ? "check" : "del") : ($stav_post == "on" ? "add" : "check"))));

            if ($this->ControlForm(array ("login" => array("post", "string"),
                                          //heslo
                                          "email" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("post", "boolean"),
                                          "polozky" => array("self", "array", $pole, $this->cfgexplode),
                                          ),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["login"]) && !Empty($_POST["email"]) && Empty($chyba) && $id > 0),
                                array("update", "user", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["login"]);
              $this->AdminAddActionLog($_POST["login"], array(__LINE__, __METHOD__));
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->iduser}");  //auto kliknuti
            }
              else
            {
              if (!Empty($_POST["tlacitko"]) && !Empty($chyba))
              {
                $result = $this->Hlaska("warning", "Chyba v: {$chyba}");
              }
            }
          }
        break;

        case "deluser": //mazani uzivatele
          $id = (int)$_GET["id"];

          if ($this->ControlDeleteForm(array("user" => array("id", $id, "login")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->iduser}");  //auto kliknuti
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis uzivatelu v adminu
 *
 * @return vypis
 */
  private function AdminVypisObsahUser()
  {
    $result = "";

    $tvar_datum = $this->unikatni["admin_vypis_user_datum"];
    $datum_null = $this->unikatni["admin_vypis_user_datum_null"];
//dodelat!!! pridat opravneni!!!
//dodelat!! sem prijde filtrovani!!!
    if ($res = $this->queryMultiObjectSingle("SELECT id, login, email, pridano, upraveno, aktivni, polozky
                                              FROM {$this->dbpredpona}user
                                              ORDER BY login ASC;"))
    {
      $row = array();
      foreach ($res as $data)
      {
        $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_user_row"],
                                          $data->login,
                                          $data->email,
                                          date($tvar_datum, strtotime($data->pridano)),
                                          (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : $datum_null),
                                          ($data->aktivni ? " checked=\"checked\"" : ""),
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iduser}&amp;co=edituser&amp;id={$data->id}",
                                          "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iduser}&amp;co=deluser&amp;id={$data->id}");
      }

      $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_user"],
                                          implode("", $row));
    }
      else
    {
      $result = $this->unikatni["admin_vypis_user_null"];
    }

    return $result;
  }

/**
 *
 * Zpracovani dat z postu a preneseni je do pole pro ulozeni
 *
 * @param mod cast adminu
 * @param konfigurace konfiguracni (pole) hodnot
 * @param &chyba eventualni nevyplneni povinne polozky
 * @return pole zpracovanych hodnot
 */
  private function ZpracovaniKonfiguraceFormulare($mod, $konfigurace, &$chyba)
  {
    $chyba = "";
    $result = array();
    $postform = $this->unikatni["normal_def_form"];
    foreach ($postform as $index => $polozka)
    { //sesbirani dat do pole
      $idx = "{$mod}_{$index}";
      $val = $this->NotEmpty("post", $idx);

      //kontrola povinne polozky
      if ($polozka["povinne"] &&
          Empty($val))
      {
        $chyba = $polozka["name"];
        break;
      }

      switch ($polozka["typ"])
      {
        case "text":
        case "textarea":
        case "select":
        case "checkbox":
          $result[] = "{$index}:{$this->NotEmpty('post', $idx)}";
        break;

        case "file":
          $size = $this->unikatni["normal_profile_file_size"];
          //dosazeni defaultni polozky
          $val = $this->HodnotaKonfiguraceFormulare("foto", $konfigurace);

          //samotny upload obrazku
          $max = 1024 * 1024 * $this->maxsizepic; //vypocet max size v MB
          $obr = $this->ControlPicture(array("main" => array(NULL, array("dir" => $size))),
                                      array($idx, $max, array("dir" => "{$this->dirpath}/{$this->pathpicture}"))
                                      );

          $obrazek = (!Empty($obr["main"]["mini"]) ? $obr["main"]["mini"] : $val);

          $result[] = "{$index}:{$obrazek}";
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vraceni hodnoty pozadovane z konfigurace
 *
 * @param hodnota nazev hodnoty ktera se ma vytahnout z konfigurace
 * @param konfigurace (pole) vstupni konfigurace
 * @return hodnota zadane konfigurace
 */
  private function HodnotaKonfiguraceFormulare($hodnota, $konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["normal_def_form"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
    $ret = array_values(preg_grep("/{$hodnota}:/", $konfigurace));
    $ret = explode("{$hodnota}:", $this->NotIsset($ret, 0));
    $value = $this->NotIsset($ret, 1); //nacteni hodnoty
    //pretypovani dle typu
    switch ($pole[$hodnota]["typ"])
    {
      case "boolean": //konvert na boolean
        //
      break;

      case "checkbox":
        $result = ($value == "on");
      break;

      case "text":
      case "textarea":
      case "select":
      case "file":
        settype($value, "string");
        $result = $value;
      break;
    }

    return $result;
  }

/**
 *
 * Vypis konfigurace registracniho formulare
 *
 * @param konfigurace_sablony (pole) konfigurace z registrace
 * @return vygenerovane pouzita konfigurace
 */
  private function AdminVypisKonfiguraceFormulare($konfigurace)
  {
    $result = "";
    $pole = $this->unikatni["normal_def_form"];
    //rozdeleni konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));
//var_dump($konfigurace);
    $result = "";
    $row = array();
    foreach ($pole as $name => $polozka)
    {
      $val = $this->HodnotaKonfiguraceFormulare($name, $konfigurace);
      $input_name = "admin_{$name}";
      $povinne = "";  //dodelat?!!!
      //vypis podle typu
      switch ($polozka["typ"])
      {
        case "text":
        case "textarea":
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_text"],
                                            $polozka["class"],
                                            $polozka["name"],
                                            $input_name,
                                            $val,
                                            $povinne);
        break;
//dodelat!! doladit!!!
        case "select":
          $rew = array();
          foreach ($polozka["moznosti"] as $hodnota)
          {
            $rew[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_select_row"],
                                              $hodnota,
                                              ($val == $hodnota ? " selected=\"selected\"" : ""));
          }
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_select"],
                                            $polozka["class"],
                                            $polozka["name"],
                                            $input_name,
                                            implode("", $rew),
                                            $povinne);
        break;

        case "checkbox":
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_checkbox"],
                                            $polozka["class"],
                                            $polozka["name"],
                                            $input_name,
                                            ($val ? " checked=\"checked\"" : ""),
                                            $povinne);
        break;

        case "file":
          $row[] = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_konfigurace_file"],
                                            $polozka["class"],
                                            $polozka["name"],
                                            $input_name,
                                            "{$this->dirpath}/{$this->pathpicture}/{$val}",
                                            $povinne);
        break;
      }
    }

    $result = implode("", $row);

    return $result;
  }

/**
 *
 * Generovani formularu pro uzivatele
 *
 * @param formtyp typ formulare na generovani
 * @return vygenerovany formular
 */
  private function NadefinovaneFormulare($formtyp, $konfigurace = NULL)
  {
    $pole = $this->unikatni["normal_def_form"];
    //zpracovani konfigurace
    $konfigurace = (is_array($konfigurace) ? $konfigurace : explode($this->cfgexplode, $konfigurace));

    $result = "";
    $row = array();
    foreach ($pole as $name => $polozka)
    {
      if (in_array($formtyp, $polozka["show"]))
      {
        $val = $this->HodnotaKonfiguraceFormulare($name, $konfigurace);
        //dosazeni hodnot podle registrace a nebo upravy profilu
        $input_name = "{$formtyp}_{$name}";

        $value = ($formtyp == "profil" ? (!Empty($_POST[$input_name]) ? $_POST[$input_name] : $val) :
                                        (!Empty($_POST[$input_name]) ? $_POST[$input_name] : $polozka["value"]));
//uprava name pro input
//htmlspecialchars_decode(html_entity_decode($rozrad[0], NULL, "UTF-8")),
//    html_entity_decode(html_entity_decode($val, NULL, "UTF-8"));
//html_entity_decode(html_entity_decode(737123124, NULL, "UTF-8"))
        $povinne = ($polozka["povinne"] ? $polozka["fpovinne"] : "");

        //vypis podle typu
        switch ($polozka["typ"])
        {
          case "text":
          case "textarea":
            $row[] = $this->NactiUnikatniObsah($this->unikatni["normal_def_form_{$polozka["typ"]}"],
                                              $polozka["class"],
                                              $polozka["name"],
                                              $input_name,
                                              $value,
                                              $povinne);
          break;

          case "select":
            $rew = array();
            foreach ($polozka["moznosti"] as $hodnota)
            {// $polozka["value"]
              $rew[] = $this->NactiUnikatniObsah($this->unikatni["normal_def_form_select_row"],
                                                $hodnota,
                                                ($value == $hodnota ? " selected=\"selected\"" : ""));
            }
            $row[] = $this->NactiUnikatniObsah($this->unikatni["normal_def_form_select"],
                                              $polozka["class"],
                                              $polozka["name"],
                                              $input_name,
                                              implode("", $rew),
                                              $povinne);
          break;

          case "checkbox":
            $row[] = $this->NactiUnikatniObsah($this->unikatni["normal_def_form_checkbox"],
                                              $polozka["class"],
                                              $polozka["name"],
                                              $input_name,
                                              ($value ? " checked=\"checked\"" : ""),
                                              $povinne);
          break;

          case "file":
            $row[] = $this->NactiUnikatniObsah($this->unikatni["normal_def_form_file"],
                                              $polozka["class"],
                                              $polozka["name"],
                                              $input_name,
                                              "{$this->dirpath}/{$this->pathpicture}/{$value}",
                                              $povinne);
          break;
        }
      }
    }

    $result = implode("", $row);

    return $result;
  }

/**
 *
 * Vypis formulare registrace
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicRegistration", "RegistraceForm");
 *
 * @param tvar nazev tvaru
 * @return formular registrace
 */
  public function RegistraceForm($nastaveni = array())
  {
    $tvar = $this->NotIsset($nastaveni, "tvar");

    if (!$this->var->aktivniadmin)
    {
      //nacteni konfigurace
      if (!$res = $this->ControlConfig(array("emailadmin", "typregistrace",
                                            "captcha", "podminky", "textpodminky", "lenloginmin", "lenloginmax",
                                            "lenpassmin", "lenpassmax", "typchar", "changelogin", "duplicemail",
                                            "maxlogin", "maxregistration", "interpost", "maxinterpost"), true,
                                      array("load|config", "{$this->dirpath}/{$this->usersett}")))
      {
        var_dump("neco se zhnojilo..., neni vytvorena konfigurace!");
      }

      switch ($res->typregistrace)
      {
        case "vypnuto": //vypisnuta registrace
          $result = $this->unikatni["normal_registrace_disable"];
        break;

        //case "primo":
        //case "presemail":
        case "presadmin": //registrace pres admina
          $name_reg_login = "reg_login";
          $name_reg_hes1 = "reg_hes1";
          $name_reg_hes2 = "reg_hes2";
          $name_reg_email = "reg_email";
          $name_reg_captcha = "reg_captcha";
          $name_reg_button = "reg_button";

          $mod = "registr";
          $form = $this->NadefinovaneFormulare($mod);

          //ochrana proti nezadanemu captcha kodu
          if ($res->captcha > 0)
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_form"],
                                                $name_reg_login,
                                                $this->NotEmpty("post", $name_reg_login),
                                                $name_reg_hes1,
                                                $name_reg_hes2,
                                                $name_reg_email,
                                                $this->NotEmpty("post", $name_reg_email),
                                                $form,
                                                $this->var->main[0]->NactiFunkci("DynamicCaptcha", "CaptchaKod", $res->captcha),
                                                $name_reg_captcha,
                                                $name_reg_button);
          }

    //++ detekce nevyplnene polozky a zvyrazneni!!!!

          //kontrola hesla
          $email = $this->KontrolaEmailu($this->NotEmpty("post", $name_reg_email));
          if (!Empty($_POST[$name_reg_button]) &&
              !Empty($_POST[$name_reg_login]) &&
              !Empty($_POST[$name_reg_hes1]) &&
              !Empty($_POST[$name_reg_hes2]) &&
              !Empty($email) &&
              $_POST[$name_reg_hes1] == $_POST[$name_reg_hes2] &&
              $_SESSION["slovo_{$res->captcha}_lastsolve"] == $_POST[$name_reg_captcha])
          {
            $pole = array();
            $postform = array_keys($this->unikatni["normal_def_form"]);
            foreach ($postform as $index)
            { //sesbirani dat do pole
              $idx = "{$mod}_{$index}";
              $pole[] = "{$index}:{$_POST[$idx]}";
            }

            if ($this->NotEmpty("post", "registr_novinky") == "on")
            {
              $result .= $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaRegistraci", array("email" => $email, "smer" => "add"));
            }


    //dodelat!!
    //pri uspesnem provedeni funkce se spusti nadefinovane funkce (pres podminky?!)

            //dodelat!!!
            //aktivni se bude brat podle typu registrace
            if ($this->ControlForm(array ("login" => array("self", "string", $_POST[$name_reg_login]),
                                          "heslo" => array("self", "string|2md5", $_POST[$name_reg_hes1]),
                                          "email" => array("self", "string", $_POST[$name_reg_email]),
                                          "pridano" => array("self", "date", "now"),
                                          //"upraveno" => array("self", "date", "now"),
                                          "aktivni" => array("self", "boolean", false),
                                          "polozky" => array("self", "array", $pole, $this->cfgexplode)),
                                  $this->DuplikatniHodnota("login", "user", $_POST[$name_reg_login]), //unikatnost na login
                                  array("insert", "user", NULL)))
            {
              $ret = array ("array_object",
                            "absolutni_url" => $this->absolutni_url,
                            "login" => $_POST[$name_reg_login],
                            "heslo" => $_POST[$name_reg_hes1],
                            "email" => $_POST[$name_reg_email],
                            "datum" => date($this->unikatni["normal_registrace_datum"]));

              $ret = array_merge($ret, $_POST);

              $predmet = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_predmet"],
                                                  $ret);

              $message = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_message"],
                                                  $ret);

              $header = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_header"],
                                                  $ret);

              //odeslani emailu na nadefinovany email o tom ze je novy uzivatel
              //email pro admina
              if (mail($res->emailadmin, $predmet, $message, $header))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_done"],
                                                    $ret);

                $userpredmet = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_user_predmet"],
                                                        $ret);

                $usermessage = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_user_message"],
                                                        $ret);

                $userheader = $this->NactiUnikatniObsah($this->unikatni["normal_registrace_user_header"],
                                                        $ret);

                //email pro uzivatele
                mail($email, $userpredmet, $usermessage, $userheader);

                //vraci zpet na nactenou adresu get_kam
                $this->AutoClick(10, $this->absolutni_url);  //auto kliknuti
              }
            }
              else
            {
              $result .= $this->unikatni["normal_registrace_fail"];
            }
          }
            else
          {
            if (!Empty($_POST[$name_reg_button]))
            {
              if (Empty($_POST[$name_reg_login]))
              {
                $result .= $this->unikatni["normal_registrace_fail_login"];
              }

              if (Empty($_POST[$name_reg_hes1]) ||
                  Empty($_POST[$name_reg_hes2]))
              {
                $result .= $this->unikatni["normal_registrace_fail_heslo"];
              }

              if ($_POST[$name_reg_hes1] != $_POST[$name_reg_hes2])
              {
                $result .= $this->unikatni["normal_registrace_fail_compare_heslo"];
              }

              if (Empty($email))
              {
                $result .= $this->unikatni["normal_registrace_fail_email"];
              }

              if ($_SESSION["slovo_{$res->captcha}_lastsolve"] != $_POST[$name_reg_captcha])
              {
                $result .= $this->unikatni["normal_registrace_fail_captcha"];
              }
            }
          }
        break;
      }


    }

    return $result;
  }

/**
 *
 * Vraci id aktualne prihlaseneho uzivatele podle cookie
 *
 * @return id prihlaseneho uzivatele
 */
  private function CurrentIdUser()
  {
    $result = "";
    if (!Empty($_COOKIE[$this->cookiename]))
    {
      $roz = explode("||", $this->DekodujText($_COOKIE[$this->cookiename]));

      //dodelat!! ++ overeni proti podstrceni cookie!!!

      $result->id = $roz[0];
      settype($result->id, "integer");
      $result->expire = $roz[1];
    }

    return $result;
  }

/**
 *
 * Formulare pro upravu profilu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicRegistration", "ProfileForm");
 *
 * @return editace profilu
 */
  public function ProfileForm()
  {
    $result = "";
    if (!$this->var->aktivniadmin)
    {
      //odchyceni getu
      $get_kam = (!Empty($_GET[$this->var->get_kam]) ? $_GET[$this->var->get_kam] : "");
      if (!Empty($get_kam) &&
          $get_kam == $this->get_profile)
      { //uprava prihlaseneho uzivatele
        $uid = $this->CurrentIdUser();

        //pokud je id obsazeno a neni nulove
        if ($uid->id > 0)
        {
          $name_prof_button = "prof_button";

          //nacteni hodnot od uzivatele
          $retdata = $this->ControlObjectHodnoty(array("login", "polozky", "email"),
                                                array("user", $uid->id, "aktivni=1 AND id="));

//dodelat!!
//pres nastaveni povolovat zmenu login/heslo/email jednotlive!

          $mod = "profil";
          $form = $this->NadefinovaneFormulare($mod, $retdata->polozky);

          $result = $this->NactiUnikatniObsah($this->unikatni["normal_profile_form"],
                                              "enable login",
                                              "enable heslo",
                                              "enable email",
                                              $form,
                                              $name_prof_button,
                                              $this->HodnotaKonfiguraceFormulare("jmeno", $retdata->polozky),
                                              $this->HodnotaKonfiguraceFormulare("prijmeni", $retdata->polozky));
//dodelat!!!
//za predpokladu povinnych login/heslo/email kontrolovat i to!!!
          if (!Empty($_POST[$name_prof_button]))
          { //zpracovani polozek z postu
            $pole = $this->ZpracovaniKonfiguraceFormulare($mod, $retdata->polozky, $chyba);

            if (Empty($chyba) &&
                !Empty($pole[0]))
            {
              $stav = $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaRegistraci", array("email" => $retdata->email, "smer" => "check"));
              $stav_post = $this->NotEmpty("post", "profil_novinky");
              $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaRegistraci", array("email" => $retdata->email, "smer" => ($stav ? ($stav_post == "on" ? "check" : "del") : ($stav_post == "on" ? "add" : "check"))));

              if ($this->ControlForm(array (//"login" => array("self", "string", $_POST[$name_reg_login]),
                                            //"heslo" => array("self", "string|2md5", $_POST[$name_reg_hes1]),
                                            //"email" => array("self", "string", $_POST[$name_reg_email]),
                                            //"pridano" => array("self", "date", "now"),
                                            "upraveno" => array("self", "date", "now"),
                                            //"aktivni" => array("self", "boolean", false),
                                            "polozky" => array("self", "array", $pole, $this->cfgexplode)),
                                    true, //unikatnost na login
                                    array("update", "user", $uid->id)))
              { //$this->DuplikatniHodnota("login", "user", $_POST[$name_reg_login])
                $result = $this->NactiUnikatniObsah($this->unikatni["normal_profile_done"],
                                                    $retdata->login);
//dodelat!! synchronizace!!!
                //vraci zpet na nactenou adresu get_kam
                $this->AutoClick(1, "{$this->absolutni_url}{$this->get_info}");  //auto kliknuti
              }

              //+ informace o profilu v adminu!!!
              //+ doplni permisny o sekce!!!
              //pote otestit + to tim padem bude prozazim hotovo
              //statistuky se dodelaji pozdeji
              //sjednotit nacitani dat z cookie, + s ochanou proti podstrceni!!!!
            }
              else
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["normal_profile_fail"],
                                                  $chyba);
            }

          }

          //generovat adresu na verejny profil
        }
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje informace o profilu
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoProfile");
 *
 * @return informace o profilu
 */
  public function InfoProfile()
  {
    $result = "";
    if (!$this->var->aktivniadmin)
    {
      //odchyceni getu
      $get_kam = (!Empty($_GET[$this->var->get_kam]) ? $_GET[$this->var->get_kam] : "");
      if (!Empty($get_kam) &&
          $get_kam == $this->get_info)
      { //info o prihlasenem uzivateli
        $uid = $this->CurrentIdUser();

        //pokud je id obsazeno a neni nulove
        if ($uid->id > 0)
        {
//dodelat pak moznosti nastaveni viditelnosti login/email
          //nacteni hodnot od uzivatele
          $retdata = $this->ControlObjectHodnoty(array("id", "login", "email", "polozky"),
                                                array("user", $uid->id, "aktivni=1 AND id="));

          $pole = array();
          $postform = array_keys($this->unikatni["normal_def_form"]);
          foreach ($postform as $index)
          {
            $pole[$index] = $this->HodnotaKonfiguraceFormulare($index, $retdata->polozky);
          }

          $cesta = "{$this->dirpath}/{$this->pathpicture}/{$pole["foto"]}";
          $obrazek = (is_file($cesta) ? $cesta : "{$this->dirpath}/{$this->unikatni["normal_info_profile_defpic"]}");
          $nick = $this->RewritePrepis("{$pole["jmeno"]}-{$pole["prijmeni"]}", "low");

          $ret = array("array_object",
                      "login" => $retdata->login,
                      "email" => $retdata->email,
                      "edit_url" => "{$this->absolutni_url}{$this->get_profile}",
                      "profil_foto" => $obrazek,
                      "profil_url" => "{$this->absolutni_url}{$nick}-{$retdata->id}",
                      //dodelat!! povolovat pres admin verejne profily
                      );

          $ret = array_merge($ret, $pole);

          $result = $this->NactiUnikatniObsah($this->unikatni["normal_info_profile"],
                                              $ret);
        }
      }
    }

    return $result;
  }

/**
 *
 * Vypisuje verejny profil
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicRegistration", "InfoPublicProfile");
 * "RewriteRule ^(.+)-(.+)-([0-9]+)/?$ ?action=public-profile&jm=$1&pr=$2&uid=$3 [L]"
 *
 * @return vypis verejneho profilu
 */
  public function InfoPublicProfile()
  {
    $result = "";
    if (!$this->var->aktivniadmin)
    {
      $jm = (!Empty($_GET["jm"]) ? $_GET["jm"] : "");
      $pr = (!Empty($_GET["pr"]) ? $_GET["pr"] : "");
      $uid = (!Empty($_GET["uid"]) ? $_GET["uid"] : "");

      //nacteni konfigurace z globalniho nastaveni
      if (!$retdata = $this->ControlConfig(array("verejne"), true,
                                      array("load|config", "{$this->dirpath}/{$this->usersett}")))
      {
        var_dump("neexistuje konfigurace");
      }

      //odchyceni getu
      $get_kam = (!Empty($_GET[$this->var->get_kam]) ? $_GET[$this->var->get_kam] : "");
      if (!Empty($get_kam) &&
          $get_kam == $this->get_public_profile &&
          !Empty($jm) &&
          !Empty($pr) &&
          !Empty($uid) &&
          $retdata->verejne)  //musi byt zapnuty verejny profil
      { //info o prihlasenem uzivateli
        if ($uid > 0)
        {
          //nacteni hodnot od uzivatele, overeni podle id
          if ($retdata = $this->ControlObjectHodnoty(array("id", "login", "email", "polozky"),
                                                    array("user", $uid, "aktivni=1 AND id=")))
          { //overeni podle jmena a prijmeni
            $jmeno = $this->RewritePrepis($this->HodnotaKonfiguraceFormulare("jmeno", $retdata->polozky), "low");
            $prijmeni = $this->RewritePrepis($this->HodnotaKonfiguraceFormulare("prijmeni", $retdata->polozky), "low");
//var_dump($jmeno, $jm, $prijmeni, $pr);  neumi prijmeni s mezerou!
            if ($jm == $jmeno &&
                $pr == $prijmeni)
            {
              $pole = array();
              $postform = array_keys($this->unikatni["normal_def_form"]);
              foreach ($postform as $index)
              {
                $pole[$index] = $this->HodnotaKonfiguraceFormulare($index, $retdata->polozky);
              }
//dodelat! v pripade potreby sjednotit!
              $cesta = "{$this->dirpath}/{$this->pathpicture}/{$pole["foto"]}";
              $obrazek = (is_file($cesta) ? $cesta : "{$this->dirpath}/{$this->unikatni["normal_info_profile_defpic"]}");
              $nick = "{$jm}-{$pr}";

              $ret = array("array_object",
                          "login" => $retdata->login,
                          "email" => $retdata->email,
                          "edit_url" => "{$this->absolutni_url}{$this->get_profile}",
                          "profil_foto" => $obrazek,
                          "profil_url" => "{$this->absolutni_url}{$nick}-{$retdata->id}",
                          //dodelat!! povolovat pres admin verejne profily
                          );

              $ret = array_merge($ret, $pole);

              $result = $this->NactiUnikatniObsah($this->unikatni["normal_info_public_profile"],
                                                  $ret);
            }
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Vrati id aktvniho uzivatele
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicRegistration", "AktivniUzivatel");
 *
 * @return id prihlaseneho uzivatele
 */
  public function AktivniUzivatel()
  {
    $uid = $this->CurrentIdUser();
    $result = $uid->id;

    return $result;
  }

//dodelat!! vraceni informaci o uzivateli na pozadani!! dle zadaneho id uzivatele
  //public function

/**
 *
 * Vypis formulare prihlasovani
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicRegistration", "LoginForm");
 *
 * @param tvar nazev tvaru
 * @return formular prihlasovani
 */
  public function LoginForm($nastaveni = array())
  {
    //$tvar = $nastaveni["tvar"];
    $result = "";
    if (!$this->var->aktivniadmin)
    {
      $name_login = "l_login";
      $name_heslo = "l_heslo";
      $name_button = "l_button";

      if ($uid = $this->CurrentIdUser())
      {
        //kontrola jestli jeste existuje
        $userlogin = $this->VypisHodnotu("login", "user", $uid->id, "aktivni=1 AND id=");
      }

      $logexpire = "";
      $regexpire = "";
      //nacteni konfigurace z globalniho nastaveni
      if ($retdata = $this->ControlConfig(array("loginexpirace", "onregexpirace", "regexpirace"), true,
                                      array("load|config", "{$this->dirpath}/{$this->usersett}")))
      {
        $logexpire = strtotime($retdata->loginexpirace);
        $regexpire = strtotime($retdata->regexpirace);
      }
        else
      {
        var_dump("neexistuje konfigurace");
      }

//dodelat!!!!
//musi predavat ve funkci aktualni prihlasene id user aby ostatni
//funkce / moduly dokazali detekovat prihlaseneho uzivatele

      //pokdu je nacteny cas vetsi nez odecteny aktualni tak neplati
      if (!Empty($uid->id) &&
          !Empty($userlogin) &&
          !Empty($logexpire))
      { //po prihlaseni
        if ($uid->expire > $logexpire)  //pokud cas expirace vyhovuje casu prihlaseni
        { //prenese id a zanase novy cas
          SetCookie($this->cookiename, $this->ZakodujText("{$uid->id}||{$_SERVER["REQUEST_TIME"]}"), Time() + 31536000); //zápis do cookie
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_form_po"],
                                              "{$this->absolutni_url}{$this->get_info}",  //odkaz na info
                                              $userlogin,
                                              "{$this->absolutni_url}{$this->get_logoff}",
                                              date($this->unikatni["normal_login_form_po_datum"], $uid->expire));
        }
          else
        { //expirace prihlaseni
          SetCookie($this->cookiename, "", Time() + 31536000); //zápis do cookie
          $result = $this->unikatni["normal_login_form_po_expire"];
          $this->AutoClick(1, $this->absolutni_url);
        }
      }
        else
      { //pred prihlasenim
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_form_pred"],
                                            $name_login,
                                            $name_heslo,
                                            $name_button,
                                            "{$this->absolutni_url}");  //{$this->get_registre}
      }

      //odchyceni getu
      $get_kam = (!Empty($_GET[$this->var->get_kam]) ? $_GET[$this->var->get_kam] : "");
      if (!Empty($get_kam) &&
          $get_kam == $this->get_logoff)
      { //odchyceni odhlaseni uzivatele
        SetCookie($this->cookiename, "", Time() + 31536000); //zápis do cookie
        $result = $this->unikatni["normal_login_form_log_out"];
        $this->AutoClick(1, $this->absolutni_url);
      }

      if (!Empty($_POST[$name_button]) &&
          !Empty($_POST[$name_login]) &&
          !Empty($_POST[$name_heslo]) &&
          !Empty($regexpire))
      {
        $login = $_POST[$name_login];
        $hes = md5(md5($_POST[$name_heslo]));
//dodelat!! rozlisovat jeste podle podminek!!!!

//dodelat!! kdyby bylo zapotrebi tak sjednotit do jedne funkce!!
        //ovladani overovani expirace uzivatelu
        if ($retdata->onregexpirace)
        {
          //overovani expiraci neaktivnich uzivatelu
          if ($res = $this->queryMultiObjectSingle("SELECT id, pridano FROM {$this->dbpredpona}user WHERE aktivni=0;"))
          {
            //projiti neaktivnich uzivatelu
            $expid = array();
            foreach ($res as $data)
            {
              $regdat = strtotime($data->pridano);
              if ($regdat < $regexpire)
              {
                $expid[] = $data->id;
              }
            }
            //slouci id provede dotaz
            $sloucene = implode(", ", $expid);
            $this->queryExec("DELETE FROM {$this->dbpredpona}user WHERE id IN ({$sloucene});"); //provedeni dotazu
          }
        }

        $userid = $this->VypisHodnotu("id", "user", NULL, "aktivni=1 AND login='{$login}' AND heslo='{$hes}'");
        if (!Empty($userid))
        { //pri uspesnem prihlaseni
          SetCookie($this->cookiename, $this->ZakodujText("{$userid}||{$_SERVER["REQUEST_TIME"]}"), Time() + 31536000); //zápis do cookie
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_form_log_on_true"],
                                              $login);

//dodelat!!! musi se zalogovat do databaze last_log!!!

          $this->AutoClick(1, $this->absolutni_url);
        }
          else
        { //pri neuspesnem prihlaseni
          $result = $this->NactiUnikatniObsah($this->unikatni["normal_login_form_log_on_false"],
                                              $login);
          $this->AutoClick(1, $this->absolutni_url);
        }
      }
    }

    return $result;
  }

/**
 *
 * Hlavni administrace uzivatelu
 *
 * @return obsluha uzivatelu
 */
  private function AdministraceObsahu()
  {
    //nacitani konfigurace
    if (!$res = $this->ControlConfig(array("emailadmin", "typregistrace", "loginexpirace", "onregexpirace", "regexpirace", "verejne",
                                          "captcha", "podminky", "textpodminky", "lenloginmin", "lenloginmax",
                                          "lenpassmin", "lenpassmax", "typchar", "changelogin", "duplicemail",
                                          "maxlogin", "maxregistration", "interpost", "maxinterpost"), true,
                                    array("load|config", "{$this->dirpath}/{$this->usersett}")))
    {
      $res->emailadmin = "@";
      $res->typregistrace = "presadmin";
      $res->loginexpirace = "-2 hour";
      $res->onregexpirace = "on";
      $res->regexpirace = "-2 day";
      $res->verejne = false;
      $res->captcha = 0;
      $res->podminky = false;
      $res->textpodminky = "";
      $res->lenloginmin = 0;
      $res->lenloginmax = 0;
      $res->lenpassmin = 0;
      $res->lenpassmax = 0;
      $res->typchar = array();
      $res->changelogin = false;
      $res->duplicemail = false;
      $res->maxlogin = 0;
      $res->maxregistration = 0;
      $res->interpost = false;
      $res->maxinterpost = 0;
    }

    $typchar = $res->typchar;//explode(",", $res->typchar);
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"], array("array_object",
                                        "emailadmin" => $res->emailadmin,
                                        "typ_vypnuto" => ($res->typregistrace == "vypnuto" ? " checked=\"checked\"" : ""),
                                        "typ_primo" => ($res->typregistrace == "primo" ? " checked=\"checked\"" : ""),
                                        "typ_presemail" => ($res->typregistrace == "presemail" ? " checked=\"checked\"" : ""),
                                        "typ_presadmin" => ($res->typregistrace == "presadmin" ? " checked=\"checked\"" : ""),
                                        "loginexpirace" => $res->loginexpirace,
                                        "onregexpirace" => ($res->onregexpirace ? " checked=\"checked\"" : ""),
                                        "regexpirace" => $res->regexpirace,
                                        "verejne" => ($res->verejne ? " checked=\"checked\"" : ""),
                                        "captcha" => $res->captcha,
                                        "podminky" => ($res->podminky ? " checked=\"checked\"" : ""),
                                        "textpodminky" => $res->textpodminky,
                                        "lenloginmin" => $res->lenloginmin,
                                        "lenloginmax" => $res->lenloginmax,
                                        "lenpassmin" => $res->lenpassmin,
                                        "lenpassmax" => $res->lenpassmax,
                                        "uplow" => (in_array("uplow", $typchar) ? " checked=\"checked\"" : ""),
                                        "alfamun" => (in_array("alfamun", $typchar) ? " checked=\"checked\"" : ""),
                                        "spec" => (in_array("spec", $typchar) ? " checked=\"checked\"" : ""),
                                        "changelogin" => ($res->changelogin ? " checked=\"checked\"" : ""),
                                        "duplicemail" => ($res->duplicemail ? " checked=\"checked\"" : ""),
                                        "maxlogin" => $res->maxlogin,
                                        "maxregistration" => $res->maxregistration,
                                        "interpost" => ($res->interpost ? " checked=\"checked\"" : ""),
                                        "maxinterpost" => $res->maxinterpost,
                                        "???",
                                        "???"));

    //ukladani konfigurace
    if ($this->ControlConfig(array ("emailadmin" => array("post", "string"),
                                    "typregistrace" => array("post", "string"),
                                    "loginexpirace" => array("post", "string"),
                                    "onregexpirace" => array("post", "boolean"),
                                    "regexpirace" => array("post", "string"),
                                    "verejne" => array("post", "boolean"),
                                    "captcha" => array("post", "integer"),
                                    "podminky" => array("post", "boolean"),
                                    "textpodminky" => array("post", "string"),
                                    "lenloginmin" => array("post", "integer"),
                                    "lenloginmax" => array("post", "integer"),
                                    "lenpassmin" => array("post", "integer"),
                                    "lenpassmax" => array("post", "integer"),
                                    "typchar" => array("post", "array"),  //, is_array($this->NotEmpty("post", "typchar")) ? implode(",", $_POST["typchar"]) : ""
                                    "changelogin" => array("post", "boolean"),
                                    "duplicemail" => array("post", "boolean"),
                                    "maxlogin" => array("post", "integer"),
                                    "maxregistration" => array("post", "integer"),
                                    "interpost" => array("post", "boolean"),
                                    "maxinterpost" => array("post", "integer"),
                                    //"",
                                    //"",
                                    ), (!Empty($_POST["tlacitko"]) && !Empty($_POST["typregistrace"])),
                              array("save|config", "{$this->dirpath}/{$this->usersett}")))
    {
      $result = $this->Hlaska("edit", "Konfigurace uživatelů");
      $this->AdminAddActionLog("", array(__LINE__, __METHOD__));
      $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&ret={$this->idmodul}");  //auto kliknuti
    }

    //vytvari potrebne slozky
    $this->ControlCreateDir(array(array($this->dirpath, $this->pathpicture),
                                  ));

    return $result;
  }

/**
 *
 * Vypis obsahu logu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisLogu()
  {
    $result = $this->unikatni["admin_vypis_logu_begin"];
    $tvar_datum = $this->unikatni["admin_vypis_logu_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, exectime, datum, agent, ip FROM {$this->dbpredpona}cron_log ORDER BY cron_log.datum DESC;"))
    {
      foreach ($res as $data)
      {
        $os = $this->TypOS($data->agent);
        $browser = $this->TypBrowseru($data->agent);
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_logu"],
                                            $data->id,
                                            $data->exectime,
                                            date($tvar_datum, strtotime($data->datum)),
                                            $data->ip,
                                            $os,
                                            $browser);
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }


}
?>
