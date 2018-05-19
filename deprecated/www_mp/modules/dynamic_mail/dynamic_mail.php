<?php

/**
 *
 * Blok mail modulu
 *
 */

//verze modulu
define("v_DynamicMail", "0.14");

class DynamicMail extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni, $dbpredpona, $mainindex;
  public $idmodul = "dynmail";  //id pro rozliseni modulu v adminu
  private $idmail = "_list";
  public $mount = array(".unikatni_obsah.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul

  private $localpermit;

  private $name_typ = array();
  private $post_add_email = "addmail";
  private $post_add_button = "add_button";

  private $get_logout_email = "unsubscribe";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul, $this->idmail);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);
      $this->mainindex = $index;

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->name_typ = $this->unikatni["name_typ"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul,
                                                $this->idmail);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);  //pripojeni defaultu

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul,
                                                          $this->idmail));
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

        case "{$this->idmodul}{$this->idmail}":  //vypis mailu
          $result = $this->AdministraceEmailu();
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}zpravy (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                predmet VARCHAR(200),
                                zprava TEXT,
                                pridano DATETIME,
                                upraveno DATETIME,
                                odeslano DATETIME,
                                zamek BOOL,
                                aktivni BOOL);

                              CREATE TABLE {$this->dbpredpona}maillist (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                email VARCHAR(500),
                                agent VARCHAR(300),
                                ip VARCHAR(50),
                                pridano DATETIME,
                                upraveno DATETIME,
                                typ VARCHAR(20));
                                ");
  }

/**
 *
 * Zachytavani url pro zruseni odberu ze stranek
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicMail", "MailZachytavaniOdhlaseni"[, array("tvar" => "=neco"));
 *
 * @param nastaveni konfiguracni pole array("tvar")
 * @return vypis obsahu v html
 */
  public function MailZachytavaniOdhlaseni($nastaveni = array())
  {
    $tvar = $this->NotIsset($nastaveni, "tvar");

    $result = "";
    $odhlaseni = $this->NotEmpty("get", $this->get_logout_email);
    if (!$this->var->aktivniadmin &&
        !Empty($odhlaseni))
    {
      $roz = explode("email:", base64_decode(rawurldecode($odhlaseni)));
      $email = $this->KontrolaEmailu($roz[1]);
      //overeni existence emailu v databazi
      if (!Empty($email) &&
          !$this->DuplikatniHodnota("email", "maillist", $email))
      {
        if ($this->ControlDeleteForm(array("maillist" => array("email", $email, "email")), $nazev))
        {
          $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_odhlaseni", $tvar), $email);
        }
      }
      $this->AutoClick(1, $this->absolutni_url);  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Cron odesilani naklikanych zprav na  definovane emaily
 * --urceno pro cron
 *
 */
  public function CronOdesilaniEmailu()
  {
    $emaily = $this->VypisPolozky("email", "maillist");
    if ($res = $this->queryMultiObjectSingle("SELECT id, predmet, zprava FROM {$this->dbpredpona}zpravy WHERE aktivni=1 AND zamek=0;"))
    {
      foreach ($res as $data)
      { //odeslat vsechny pripravene zpravy
        $link = "";
        foreach ($emaily as $email)
        { //do vsech pripravenych emailu
          $kodlink = rawurlencode(base64_encode("email:{$email}"));
          $link = "{$this->absolutni_url}?{$this->get_logout_email}={$kodlink}";
//html_entity_decode($data->zprava, ENT_QUOTES, "UTF-8"),
          $message = $this->NactiUnikatniObsah($this->unikatni["normal_cron_email"],
                                              html_entity_decode(html_entity_decode($data->zprava, ENT_QUOTES, "UTF-8"), ENT_QUOTES, "UTF-8"),
                                              $link);

          mail($email, $data->predmet, $message, $this->unikatni["normal_cron_email_header"]);
        }

        //prenastaveni flagu odesláno
        $this->ControlForm(array ("odeslano" => array("self", "date", "now"),
                                  "zamek" => array("self", "boolean", true)),
                                  ($data->id > 0),
                          array("update", "zpravy", $data->id));
      }
    }
  }

/**
 *
 * Pridavani emailu ze stranek
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaStrankach"[, array("tvar" => "=neco"));
 *
 * @param nastaveni konfiguracni pole array("tvar")
 * @return vypis obsahu v html
 */
  public function MailNaStrankach($nastaveni = array())
  {
    $tvar = $this->NotIsset($nastaveni, "tvar");

    $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_na_strankach", $tvar),
                                        $this->post_add_email,
                                        $this->post_add_button);

    $email = $this->KontrolaEmailu($this->NotEmpty("post", $this->post_add_email));
    if (!$this->var->aktivniadmin &&
        !Empty($email) &&
        !Empty($_POST[$this->post_add_button]))
    {
      if ($this->DuplikatniHodnota("email", "maillist", $email))
      {
        if ($this->ControlForm(array ("email" => array("self", "string", $email),
                                      "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                                      "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                      "pridano" => array("self", "date", "now"),
                                      "typ" => array("self", "string", "web")),
                      (true),
                      array("insert", "maillist", NULL)))
        {
          $result = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_na_strankach_pridano", $tvar),
                                              $email);

          //prikaz na odeslani emailu, s linkem na jeho zruseni
          $kodlink = rawurlencode(base64_encode("email:{$email}"));
          $message = $this->NactiUnikatniObsah($this->EqTv($this->unikatni, "normal_na_strankach_email", $tvar),
                                              $email,
                                              "{$this->absolutni_url}?{$this->get_logout_email}={$kodlink}");
          mail($email, $this->unikatni["normal_na_strankach_predmet"], $message, $this->unikatni["normal_na_strankach_header"]);

          $this->AutoClick(1, $this->absolutni_url);  //auto kliknuti
        }
      }
        else
      {
        $result = $this->EqTv($this->unikatni, "normal_na_strankach_duplicita", $tvar);
      }
    }

    return $result;
  }

/**
 *
 * Pridavani emailu z registrace
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("DynamicMail", "MailNaRegistraci", array("email" => $email, "smer" => "add"));
 *
 * @param nastaveni konfiguracni pole array("email", "smer")
 * @return vypis obsahu v html
 */
  public function MailNaRegistraci($nastaveni)
  {
    $result = "";

    $email = $this->NotIsset($nastaveni, "email");
    $smer = $this->NotIsset($nastaveni, "smer");

    switch ($smer)
    {
      case "add": //pridani emailu, pri registraci/editaci profilu
        if (!Empty($email))
        {
          if ($this->DuplikatniHodnota("email", "maillist", $email))
          {
            $this->ControlForm(array ("email" => array("self", "string", $email),
                                      "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                                      "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                      "pridano" => array("self", "date", "now"),
                                      "typ" => array("self", "string", "reg")),
                              (true),
                              array("insert", "maillist", NULL));
          }
            else
          {
            $result = $this->unikatni["normal_na_registraci"];
          }
        }
      break;

      case "check": //kontrola pri nacitani, true=existuje
        $result = (!Empty($email) && !$this->DuplikatniHodnota("email", "maillist", $email));
      break;

      case "del": //mazani emailu ze seznamu
        $this->ControlDeleteForm(array("maillist" => array("email", $email, "email")), $nazev);
      break;
    }

    return $result;
  }

/**
 *
 * Hlavni administrace obsahu modulu
 *
 * @return hlavni adminstrace modulu
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["addmsg"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addmsg" : ""),
                                        $this->AdminVypisObsahu());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addmsg": //pridavani zpravy
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditmsg"],
                                              $this->unikatni["admin_addeditmsg_add"],
                                              $this->dirpath,
                                              "", "", "",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("predmet" => array("self", "string", $this->PrepisTextu($this->NotEmpty("post", "predmet"), "/[a-zA-Z0-9_ \-\.\(\)]{1}/")),
                                        "zprava" => array("post", "string"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now"),
                                        //"odeslano" => array("self", "date", "now"),
                                        "zamek" => array("self", "boolean", false),
                                        "aktivni" => array("post", "boolean")),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["predmet"]) && !Empty($_POST["zprava"])),
                        array("insert", "zpravy", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["predmet"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editmsg":  //editace zpravy
          $id = (int)$_GET["id"];

          if ($data = $this->querySingleRow("SELECT predmet, zprava, aktivni FROM {$this->dbpredpona}zpravy WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditmsg"],
                                                $this->unikatni["admin_addeditmsg_edit"],
                                                $this->dirpath,
                                                $data->predmet,
                                                $data->zprava,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("predmet" => array("self", "string", $this->PrepisTextu($this->NotEmpty("post", "predmet"), "/[a-zA-Z0-9_ \-\.\(\)]{1}/")),
                                          "zprava" => array("post", "string"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now"),
                                          //"odeslano" => array("self", "date", "now"),
                                          //"zamek" => array("post", "boolean"),
                                          "aktivni" => array("post", "boolean")),
                          (!Empty($_POST["tlacitko"]) && !Empty($_POST["predmet"]) && !Empty($_POST["zprava"]) && $id > 0),
                          array("update", "zpravy", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["predmet"]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "delmsg": //mazani zpravy
          $id = (int)$_GET["id"];

          if ($this->ControlDeleteForm(array("zpravy" => array("id", $id, "predmet")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
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
    $result = "";
    $tvar_datum = $this->unikatni["admin_vypis_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, predmet, zprava, pridano, upraveno, odeslano, zamek, aktivni FROM {$this->dbpredpona}zpravy ORDER BY pridano DESC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->predmet,
                                            html_entity_decode($data->zprava, ENT_QUOTES, "UTF-8"),
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : ""),
                                            (!Empty($data->odeslano) ? date($tvar_datum, strtotime($data->odeslano)) : ""),
                                            ($data->zamek ? " checked=\"checked\"" : ""),
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["editmsg"] && !$data->zamek ?
                                             $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_edit"],
                                                                      "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editmsg&amp;id={$data->id}")  : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delmsg"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delmsg&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_obsah_null"];
    }

    return $result;
  }

/**
 *
 * Hlavni administrace obsahu emailu
 *
 * @return adminstrace emailu
 */
  private function AdministraceEmailu()
  {
    $result = "";
    $co = $this->NotEmpty("get", "co");

    switch ($co)
    {
      default:
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_email"],
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["addmail"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}&amp;co=addmail" : ""),
                                            $this->AdminVypisEmailu());
      break;

      case "addmail": //pridavani emailu
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditmail"],
                                            $this->unikatni["admin_addeditmail_add"],
                                            "",
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}");

        if ($this->ControlForm(array ("email" => array("post", "string"),
                                      "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                                      "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                      "pridano" => array("self", "date", "now"),
                                      //"upraveno" => array("self", "date", "now"),
                                      "typ" => array("self", "string", "dir")),
                      (!Empty($_POST["tlacitko"]) && !Empty($_POST["email"])),
                      array("insert", "maillist", NULL)))
        {
          $result = $this->Hlaska("add", $_POST["email"]);
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}");  //auto kliknuti
        }
      break;

      case "editmail":  //editace emailu
        $id = (int)$_GET["id"];

        if ($data = $this->querySingleRow("SELECT email FROM {$this->dbpredpona}maillist WHERE id={$id};"))
        {
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addeditmail"],
                                              $this->unikatni["admin_addeditmail_edit"],
                                              $data->email,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}");

          if ($this->ControlForm(array ("email" => array("post", "string"),
                                        "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                                        "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                        //"pridano" => array("self", "date", "now"),
                                        "upraveno" => array("self", "date", "now"),
                                        //"typ" => array("self", "string", "dir")
                                        ),
                        (!Empty($_POST["tlacitko"]) && !Empty($_POST["email"]) && $id > 0),
                        array("update", "maillist", $id)))
          {
            $result = $this->Hlaska("edit", $_POST["email"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}");  //auto kliknuti
          }
        }
      break;

      case "delmail": //mazani emailu
        $id = (int)$_GET["id"];

        if ($this->ControlDeleteForm(array("maillist" => array("id", $id, "email")), $nazev))
        {
          $result = $this->Hlaska("del", $nazev);
          $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}");  //auto kliknuti
        }
      break;
    }

    return $result;
  }

/**
 *
 * Vypis obsahu logu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisEmailu()
  {
    $result = "";
    $tvar_datum = $this->unikatni["admin_vypis_email_tvar_datum"];
    if ($res = $this->queryMultiObjectSingle("SELECT id, email, ip, pridano, upraveno, typ FROM {$this->dbpredpona}maillist ORDER BY LOWER(email) ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_email"],
                                            $data->email,
                                            date($tvar_datum, strtotime($data->pridano)),
                                            (!Empty($data->upraveno) ? date($tvar_datum, strtotime($data->upraveno)) : ""),
                                            $data->ip,
                                            $this->name_typ[$data->typ],
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["editmail"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}&amp;co=editmail&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["delmail"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idmail}&amp;co=delmail&amp;id={$data->id}" : ""));
      }
    }
      else
    {
      $result .= $this->unikatni["admin_vypis_email_null"];
    }

    return $result;
  }


}
?>
