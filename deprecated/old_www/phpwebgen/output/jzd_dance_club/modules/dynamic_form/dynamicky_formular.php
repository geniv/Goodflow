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

class DynamicForm extends DefaultModule
{
  private $var, $sqlite, $dbname, $dirpath, $unikatni;
  private $idmodul = "dynform";
  private $znakpovinne = "\n          <span>*</span>"; //povinne
  private $znakdoporuc = "<<--";  //dulezite
  private $hlavicka = "Content-type: text/html; charset=UTF-8";

  private $input = array ("text"     => array("begin",    "", "type", "name", "value", "label", "readonly", "disabled",         "",    "", "text"),
                          "password" => array("begin",    "", "type", "name", "value", "label", "readonly", "disabled",         "",    "", "text"),
                          "textarea" => array("begin", "end",     "", "name", "value", "label", "readonly", "disabled",         "",    "", "text"),
                          "checkbox" => array("begin",    "", "type", "name", "value", "label",         "", "disabled",  "checked",    "",     ""),
                          "radio"    => array("begin",    "", "type", "name", "value", "label",         "", "disabled",  "checked",    "",     ""),
                          "submit"   => array("begin",    "", "type", "name", "value",      "",         "", "disabled",         "",    "",     ""),
                          "reset"    => array("begin",    "", "type", "name", "value",      "",         "", "disabled",         "",    "",     ""),
                          "image"    => array("begin",    "", "type", "name",      "",      "",         "", "disabled",         "", "src",     ""),
                          "hidden"   => array("begin",    "", "type", "name", "value",      "",         "",         "",         "",    "",     ""),
                          "select"   => array("begin", "end",     "", "name",      "", "label",         "", "disabled",         "",    "",     ""),
                          "option"   => array("begin", "end",     "",     "", "value",      "",         "",         "", "selected",    "",     ""),
                          "optgroup" => array("begin", "end",     "",     "", "value",      "",         "",         "",         "",    "",     ""),
                          );

  private $vstupni_typ = array ("text",
                                "integer",
                                "reg_exp");

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

    $this->znakpovinne = $this->NactiUnikatniObsah($this->unikatni["set_znakpovinne"]);
    $this->znakdoporuc = $this->NactiUnikatniObsah($this->unikatni["set_znakdoporuc"]);
    $this->hlavicka = $this->NactiUnikatniObsah($this->unikatni["set_hlavicka"]);

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
      if (!@$this->sqlite->queryExec("CREATE TABLE formular (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      adresa TEXT,
                                      nazev VARCHAR(200),
                                      predmet VARCHAR(200),
                                      email VARCHAR(100),
                                      textemail TEXT,
                                      dodatek TEXT,
                                      oznameni BOOL,
                                      predmetoznameni VARCHAR(200),
                                      textemailoznameni TEXT,
                                      zdrojovyemail VARCHAR(100),
                                      odesilateladmin VARCHAR(100),
                                      odesilateluzivatel VARCHAR(100));

                                      CREATE TABLE prvek (
                                      id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                      formular INTEGER UNSIGNED,
                                      nazev VARCHAR(200),
                                      typ INTEGER UNSIGNED,
                                      name VARCHAR(200),
                                      value VARCHAR(200),
                                      input_class VARCHAR(200),
                                      input_id VARCHAR(200),
                                      input_akce VARCHAR(500),
                                      readonly BOOL,
                                      disabled BOOL,
                                      label BOOL,
                                      zacatek BOOL,
                                      konec BOOL,
                                      povinne BOOL,
                                      reg_exp VARCHAR(500),
                                      vstupni_typ INTEGER UNSIGNED,
                                      min_poc INTEGER UNSIGNED,
                                      max_poc INTEGER UNSIGNED,
                                      poradi INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error);
      }
    }
  }

/**
 *
 * Navraceni samotneho formulare
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular"[, "adresa"]);</strong>
 *
 * @param adr adresa formulare
 * @param tvar tvat formulare
 * @return vystupni formular
 */
  public function Formular($adr = NULL, $tvar = 1)
  {
    if (!Empty($adr))
    {
      $adresa = $adr;
    }
      else
    {
      $adresa = stripslashes(htmlspecialchars($_SERVER["QUERY_STRING"], ENT_QUOTES));
    }

    $typ = array_keys($this->input);  //nazvy prvku
    $num_input = array_values($this->input);  //navraceni hodnot definovanych prvku
    $dattyp = $this->vstupni_typ; //datove typy

    $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_begin_form_{$tvar}"]);

    //vypis formulare
    if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel FROM formular WHERE adresa='{$adresa}';", NULL, $error))
    {
      $poc_prvku = $res->numRows();
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $dodatek = $data->dodatek;

          $predmet = $data->predmet;
          $email = $data->email;
          $textemail = $data->textemail;

          $oznameni = $data->oznameni;
          $predmetoznameni = $data->predmetoznameni;
          $textemailoznameni = $data->textemailoznameni;

          $odesilateladmin = $data->odesilateladmin;
          $odesilateluzivatel = $data->odesilateluzivatel;

          $zdrojovyemail = $data->zdrojovyemail;  //brat z POST!!

          $result .= (!Empty($data->nazev) ? $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_nadpis_{$tvar}"],
                                                                      $data->nazev) : "");

          //vypis prvku
          if ($res1 = @$this->sqlite->query("SELECT
                                            nazev,
                                            typ,
                                            name,
                                            value,
                                            input_class,
                                            input_id,
                                            input_akce,
                                            readonly,
                                            disabled,
                                            label,
                                            zacatek,
                                            konec,
                                            povinne,
                                            reg_exp,
                                            vstupni_typ,
                                            min_poc,
                                            max_poc
                                            FROM prvek
                                            WHERE prvek.formular={$data->id}
                                            ORDER BY poradi ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              $i = 0;
              while ($data1 = $res1->fetchObject())
              {
                $nazev = (!Empty($data1->nazev) ? "{$data1->nazev}" : "");

                $name = (!Empty($data1->name) ? " name=\"{$data1->name}\"" : "");

                $value = (!Empty($data1->value) ? " value=\"{$data1->value}\"" : "");
                $valuetext = (!Empty($data1->value) ? "{$data1->value}" : "");
                $valuegru = (!Empty($data1->value) ? " label=\"{$data1->value}\"" : ""); //pro group..
                $src = (!Empty($data1->value) ? " src=\"{$data1->value}\"" : ""); //pro image

                $input_class = (!Empty($data1->input_class) ? " class=\"{$data1->input_class}\"" : "");
                $input_id = (!Empty($data1->input_id) || $data1->label ? " id=\"{$data1->input_id}\"" : "");
                $input_akce = (!Empty($data1->input_akce) ? "{$data1->input_akce}" : "");

                $readonly = ($data1->readonly ? " readonly=\"readonly\"" : "");
                $disabled = ($data1->disabled ? " disabled=\"disabled\"" : "");
                $label = ($data1->label ? $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_label_{$tvar}"],
                                                                    $data1->name,
                                                                    $data1->input_id,
                                                                    $nazev)  : "");

                $povinne = (!Empty($data1->povinne) ? "{$this->znakpovinne}" : ""); //pripisuje znamenko povinnosti

                if (!Empty($data1->povinne) &&
                    $typ[$data1->typ] != "option" &&
                    $typ[$data1->typ] != "optgroup" &&
                    $typ[$data1->typ] != "hidden")
                {
                  $podminka[$i] = $data1->name;
                  $i++;
                }

                $prvky[$data1->name]["typ"] = $data1->typ;
                $prvky[$data1->name]["vstup"] = $dattyp[$data1->vstupni_typ];
                $prvky[$data1->name]["reg_exp"] = $data1->reg_exp;
                $prvky[$data1->name]["nazev"] = $data1->nazev;
                $prvky[$data1->name]["defaultni"] = $data1->povinne;
                $prvky[$data1->name]["min"] = $data1->min_poc;
                $prvky[$data1->name]["max"] = $data1->max_poc;

                switch ($typ[$data1->typ])
                {
                  case "text":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_text_zac_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $value,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $readonly,
                                                          $disabled,
                                                          $povinne);
                    }
                  break;

                  case "password":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_password_zac_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $value,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $readonly,
                                                          $disabled,
                                                          $povinne);
                    }
                  break;

                  case "textarea":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_textarea_zac_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $readonly,
                                                          $disabled,
                                                          $valuetext);
                    }

                    if ($data1->konec)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_textarea_kon_{$tvar}"],
                                                          $povinne);
                    }

                    if ($data1->zacatek && $data1->konec)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_textarea_zac_kon_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $readonly,
                                                          $disabled,
                                                          $valuetext,
                                                          $povinne);
                    }
                  break;

                  case "checkbox":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_checkbox_zac_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $disabled,
                                                          $valuetext,
                                                          $povinne);
                    }
                  break;

                  case "radio":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_radio_zac_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $disabled,
                                                          $valuetext,
                                                          $povinne);
                    }
                  break;

                  case "submit":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_submit_zac_{$tvar}"],
                                                          $data1->name,
                                                          $name,
                                                          $value,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $disabled);
                    }
                  break;

                  case "reset":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_reset_zac_{$tvar}"],
                                                          $data1->name,
                                                          $name,
                                                          $value,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $disabled);
                    }
                  break;

                  case "image":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_image_zac_{$tvar}"],
                                                          $name,
                                                          $src,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $disabled);
                    }
                  break;

                  case "hidden":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_hidden_zac_{$tvar}"],
                                                          $name,
                                                          $value,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce);
                    }
                  break;

                  case "select":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_select_zac_{$tvar}"],
                                                          $label,
                                                          $data1->name,
                                                          $name,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $disabled);
                    }

                    if ($data1->konec)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_select_kon_{$tvar}"],
                                                          $povinne);
                    }
                  break;

                  case "option":
                    if ($data1->zacatek && $data1->konec)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_option_zac_kon_{$tvar}"],
                                                          $value,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce,
                                                          $nazev);
                    }
                  break;

                  case "optgroup":
                    if ($data1->zacatek)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_optgroup_zac_{$tvar}"],
                                                          $valuegru,
                                                          $input_class,
                                                          $input_id,
                                                          $input_akce);
                    }

                    if ($data1->konec)
                    {
                      $element = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_optgroup_kon_{$tvar}"]);
                    }
                  break;

                  default:
                    $element = "??";
                  break;
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_elem_{$tvar}"],
                                                    $element);
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_end_form_{$tvar}"],
                                        $dodatek);

    $pot = true;
    $poc = 0;
    for ($i = 0; $i < count($podminka); $i++) //kontrola podminek
    {
      if (Empty($_POST[$podminka[$i]]))
      {
        $pot = false; //kdyz nevyhovuje post
      }
        else
      {
        $poc++; //pocita spravne vyplneni
      }
    }

    if (count($_POST) > 1 &&  //vic jak 1 poslany post
        $pot && //potvrzen redy
        $poc == count($podminka) && //sedi delka podminky a napoctanych bez problemu
        $poc > 0) //pocet vest jak nula
    {
      $obsah = "";
      $dokon = true;
      $klice = array_keys($_POST);  //vezme klice z POSTu

      for ($i = 0; $i < count($klice); $i++)
      {
        $prom = $_POST[$klice[$i]];

        if ($num_input[$prvky[$klice[$i]]["typ"]][10] == "text")  //kontrola textovych elementu
        {
          if ($prvky[$klice[$i]]["min"] > 0 &&
              $prvky[$klice[$i]]["max"] > 0)
          {
            if (strlen($prom) < $prvky[$klice[$i]]["min"] ||
                strlen($prom) > $prvky[$klice[$i]]["max"])
            {
              $prom = "";
            }
          }
            else
          if ($prvky[$klice[$i]]["min"] > 0)  //kontrola minina
          {
            if (strlen($prom) < $prvky[$klice[$i]]["min"])
            {
              $prom = "";
            }
          }
            else
          if ($prvky[$klice[$i]]["max"] > 0)  //kontrola maxima
          {
            if (strlen($prom) > $prvky[$klice[$i]]["max"])
            {
              $prom = "";
            }
          }

          switch ($prvky[$klice[$i]]["vstup"])
          {
            case "text":  //konvert na text
              settype($prom, "string");
            break;

            case "integer": //konvert na cislo
              settype($prom, "integer");
            break;

            case "reg_exp": //konvert podle RV
              preg_match($prvky[$klice[$i]]["reg_exp"], $prom, $ret);
              $prom = $ret[0];  //vybere nulty index
            break;
          }
        }

        $def = $prvky[$klice[$i]]["defaultni"]; //defaultni polozka

        if (!Empty($prom))  //kdyz jsou dane promene neprazdne
        {
          $nazev = $prvky[$klice[$i]]["nazev"];

          switch ($typ[$prvky[$klice[$i]]["typ"]])
          {
            case "text":
            case "password":
            case "textarea":
            case "checkbox":
            case "radio":
            case "select":
              $obsah .= $this->NactiUnikatniObsah($this->unikatni["normal_email_text_{$tvar}"],
                                                  $nazev,
                                                  $prom);
            break;
          }
        }
          else
        {
          if ($def)
          {
            $dokon = false;
          }
        }
      }

      if ($dokon)
      {
        $ip = $_SERVER["REMOTE_ADDR"];
        $agent = $_SERVER["HTTP_USER_AGENT"];
        $os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $agent);
        $brow = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $agent);
        $host = gethostbyaddr($ip);
        $datum = date("d.m.y / H:i:s");

        $zprava = $this->NactiUnikatniObsah($this->unikatni["normal_email_zprava_{$tvar}"],
                                            $textemail,
                                            $obsah,
                                            $ip,
                                            $host,
                                            $os,
                                            $brow,
                                            $datum);

        //prepnani mezi nastavenym a uzivatelskym emailem
        $admin_from = (!Empty($odesilateladmin) ? $odesilateladmin : $_POST[$zdrojovyemail]);
        $header = $this->NactiUnikatniObsah($this->unikatni["normal_email_header_{$tvar}"],  //hlavička
                                            $this->hlavicka,
                                            $admin_from);

        if (@mail($email, $this->OsetreniTextu($predmet), $zprava, $header))  //odeslani majiteli
        {
          $em1 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send_true_{$tvar}"]);
        }
          else
        {
          $em1 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send_false_{$tvar}"]);
        }

        if ($oznameni)  //je-li povolene oznameni
        {
          $zprava = "{$textemailoznameni}<br />\n<br />\n{$obsah}";
          $header = "{$this->hlavicka}\nFrom: {$odesilateluzivatel}\n";  //hlavička

          if (@mail($_POST[$zdrojovyemail], $this->OsetreniTextu($predmetoznameni), $zprava, $header))
          {
            $em2 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send2_true_{$tvar}"]);
          }
            else
          {
            $em2 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send2_false_{$tvar}"]);
          }
        }

        $result = $this->NactiUnikatniObsah($this->unikatni["normal_email_send_complet_{$tvar}"],
                                            $em1,
                                            $em2);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["normal_input_error_{$tvar}"]);
      }
    }

    if ($poc_prvku == 0)  //kdyz nesedi adresa
    {
      $result = "";
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
          $result = $this->AdministraceFormulare();
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
  private function VyberVstupu($id = NULL)
  {
    $typ = $this->vstupni_typ;

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_begin"]);
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i]);
      ;
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
  private function VyberTypu($id = NULL, $zamek = false)
  {
    $typ = array_keys($this->input);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_begin"],
                                        ($zamek ? " disabled=\"disabled\"" : ""));

    for ($i = 0; $i < count($typ); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select"],
                                          $i,
                                          ($id == $i ? " selected=\"selected\"" : ""),
                                          $typ[$i]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["admin_typ_select_end"]);

    return $result;
  }

/**
 *
 * Vrati select pro vyber z formularu
 *
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberSekce($id = NULL)
  {
    $result = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa FROM formular ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_formular_select_begin"]);
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_formular_select"],
                                              $data->id,
                                              (!Empty($id) && $id == $data->id ? " selected=\"selected\"" : ""),
                                              $data->adresa);
        }
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_formular_select_end"]);
      }
        else
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_formular_select_null"]);
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
 * Vrati pocet elementu v danem formulari
 *
 * @param formular cislo formulare
 * @param inc automaticke zvysovani o...
 * @return pocet radku v DB
 */
  private function PocetRadku($formular, $inc = 0)
  {
    settype($formular, "integer");
    settype($inc, "integer");

    $result = 0;
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM prvek WHERE formular={$formular};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet + $inc;
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
 * Interne volana funkce pro zobrazovani administrace dynamickeho formulare
 *
 * @return adminstracni formular v html
 */
  private function AdministraceFormulare()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addform",
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv",
                                        $this->AdminVypisForm());

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "test_rv":
          $vstup = stripslashes(htmlspecialchars($_POST["vstup"], ENT_QUOTES));
          //prepinani podle webu/lokalu
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_test_rv"],
                                              $vstup,
                                              $reg_exp);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($vstup) &&
              !Empty($reg_exp))
          {
            preg_match($reg_exp, $vstup, $ret);
            $result .= (!Empty($ret[0]) ? $this->NactiUnikatniObsah($this->unikatni["admin_test_rv_out"], $ret[0]) : "NULL");  //vybere nulty index
          }
        break;

        case "addform": //pridavani formulare
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_form"]);

          $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $predmet = stripslashes(htmlspecialchars($_POST["predmet"], ENT_QUOTES));
          $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);  //kontrola emailu
          $textemail = stripslashes(htmlspecialchars($_POST["textemail"], ENT_QUOTES));
          $dodatek = stripslashes(htmlspecialchars($_POST["dodatek"], ENT_QUOTES));
          $oznameni = (!Empty($_POST["oznameni"]) ? 1 : 0);
          $predmetoznameni = stripslashes(htmlspecialchars($_POST["predmetoznameni"], ENT_QUOTES));
          $textemailoznameni = stripslashes(htmlspecialchars($_POST["textemailoznameni"], ENT_QUOTES));
          $zdrojovyemail = stripslashes(htmlspecialchars($_POST["zdrojovyemail"], ENT_QUOTES));
          $odesilateladmin = stripslashes(htmlspecialchars($_POST["odesilateladmin"], ENT_QUOTES));
          $odesilateluzivatel = stripslashes(htmlspecialchars($_POST["odesilateluzivatel"], ENT_QUOTES));

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($predmet) &&
              !Empty($email) &&
              !Empty($textemail) &&
              ($oznameni ? (!Empty($odesilateluzivatel) ? true : false) : true))
          {
            if (@$this->sqlite->queryExec("INSERT INTO formular (id, adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel) VALUES
                                          (NULL, '{$adresa}', '{$nazev}', '{$predmet}', '{$email}', '{$textemail}', '{$dodatek}', {$oznameni}, '{$predmetoznameni}', '{$textemailoznameni}', '{$zdrojovyemail}', '{$odesilateladmin}', '{$odesilateluzivatel}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_form_hlaska"], $adresa);
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error);
            }

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "editform":  //editace formulare
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel FROM formular WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_form"],
                                                  $data->adresa,
                                                  $data->nazev,
                                                  $data->predmet,
                                                  (Empty($data->odesilateladmin) ? " checked=\"checked\"" : ""),
                                                  $data->odesilateladmin,
                                                  $data->email,
                                                  $data->textemail,
                                                  $data->dodatek,
                                                  ($data->oznameni ? " checked=\"checked\"" : ""),
                                                  $data->predmetoznameni,
                                                  $data->odesilateluzivatel,
                                                  $data->textemailoznameni,
                                                  $data->zdrojovyemail,
                                                  (Empty($data->odesilateladmin) ? "odes_1();" : "odes_2();"));

              $adresa = stripslashes(htmlspecialchars($_POST["adresa"], ENT_QUOTES));
              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $predmet = stripslashes(htmlspecialchars($_POST["predmet"], ENT_QUOTES));
              $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);  //kontrola emailu
              $textemail = stripslashes(htmlspecialchars($_POST["textemail"], ENT_QUOTES));
              $dodatek = stripslashes(htmlspecialchars($_POST["dodatek"], ENT_QUOTES));
              $oznameni = (!Empty($_POST["oznameni"]) ? 1 : 0);
              $predmetoznameni = stripslashes(htmlspecialchars($_POST["predmetoznameni"], ENT_QUOTES));
              $textemailoznameni = stripslashes(htmlspecialchars($_POST["textemailoznameni"], ENT_QUOTES));
              $zdrojovyemail = stripslashes(htmlspecialchars($_POST["zdrojovyemail"], ENT_QUOTES));
              $odesilateladmin = stripslashes(htmlspecialchars($_POST["odesilateladmin"], ENT_QUOTES));
              $odesilateluzivatel = stripslashes(htmlspecialchars($_POST["odesilateluzivatel"], ENT_QUOTES));

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($predmet) &&
                  !Empty($email) &&
                  !Empty($textemail) &&
                  ($oznameni ? (!Empty($odesilateluzivatel) ? true : false) : true) &&
                  $id > 0)
              {
                if (@$this->sqlite->queryExec ("UPDATE formular SET adresa='{$adresa}',
                                                                    nazev='{$nazev}',
                                                                    predmet='{$predmet}',
                                                                    email='{$email}',
                                                                    textemail='{$textemail}',
                                                                    dodatek='{$dodatek}',
                                                                    oznameni={$oznameni},
                                                                    predmetoznameni='{$predmetoznameni}',
                                                                    textemailoznameni='{$textemailoznameni}',
                                                                    zdrojovyemail='{$zdrojovyemail}',
                                                                    odesilateladmin='{$odesilateladmin}',
                                                                    odesilateluzivatel='{$odesilateluzivatel}'
                                                                    WHERE id={$id};
                                                                    ", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_form_hlaska"], $adresa);
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

        case "delform": //mazani formulare
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT adresa FROM formular WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec ("DELETE FROM formular WHERE id={$id};
                                              DELETE FROM prvek WHERE formular={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_form_hlaska"], $data->adresa);
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



        case "addelem": //pridavani elementu
          $form = $_GET["form"];  //cislo formulare
          settype($form, "integer");

          $l_id = $_GET["lastid"];  //ekv, id
          settype($l_id, "integer");

          if ($l_id == 0)
          { //pridani vzorku prvku
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_elem1"], $this->VyberTypu());

            $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
            $typ = $_POST["typ"];  //cislo formulare
            settype($typ, "integer");

            if (!Empty($_POST["tlacitko"]))
            {
              if (@$this->sqlite->queryExec("INSERT INTO prvek (id, formular, nazev, typ) VALUES
                                            (NULL, {$form}, '{$nazev}', {$typ});", $error))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_elem1_hlaska"],
                                                    $this->VyberTypu($typ, true));

                $lastid = $this->sqlite->lastInsertRowid();
                settype($lastid, "integer");
              }
                else
              {
                $this->var->main[0]->ErrorMsg($error);
              }

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}&co=addelem&form={$form}&lastid={$lastid}");  //auto kliknuti
            }
          }
            else
          { //kompletni vyplneni
            if ($res = @$this->sqlite->query("SELECT id, nazev, typ FROM prvek WHERE id={$l_id} AND formular={$form};", NULL, $error))
            {
              if ($res->numRows() == 1)
              {
                $data = $res->fetchObject();
                $num_input = array_values($this->input);  //navrat dane hodnoty radku
                //print_r($num_input[$data->typ]); //posl. id: {$l_id}  $num_input[$data->typ][0]

                $jmeno_typu = array_keys($this->input);
                $jm_typ = $jmeno_typu[$data->typ];

                $text_hint = ($jm_typ == "text");
                $submit_hint = ($jm_typ == "submit");

                $show_povinne = ($jm_typ != "option" && $jm_typ != "optgroup" && $jm_typ != "hidden");
                $show_nazev = ($jm_typ != "optgroup" && $jm_typ != "hidden" && $jm_typ != "submit" && $jm_typ != "reset");
                //".($submit_hint ? $this->znakdoporuc : "")."
                //".($submit_hint || $text_hint ? $this->znakdoporuc : "")."

                $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_elem2"],
                                                    $this->VyberSekce($form),
                                                    $this->VyberTypu($data->typ, true),
                                                    ($show_nazev ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_nazev"],
                                                                                            $data->nazev,
                                                                                            ($text_hint ? $this->znakdoporuc : "")) : ""),
                                                    (!Empty($num_input[$data->typ][3]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_name"],
                                                                                                                    ($submit_hint || $text_hint ? $this->znakdoporuc : "")) : ""),
                                                    (!Empty($num_input[$data->typ][4]) && Empty($num_input[$data->typ][9]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_value"],
                                                                                                                                                      ($submit_hint ? $this->znakdoporuc : "")) : ""),
                                                    (!Empty($num_input[$data->typ][9]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_src"]) : ""),
                                                    (!Empty($num_input[$data->typ][6]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_readonly"]) : ""),
                                                    (!Empty($num_input[$data->typ][7]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_disabled"]) : ""),
                                                    (!Empty($num_input[$data->typ][5]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_label"]) : ""),
                                                    ($num_input[$data->typ][0] ? " checked=\"checked\"" : ""),
                                                    (!Empty($num_input[$data->typ][1]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_konec"]) : ""),
                                                    ($show_povinne ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_povinne"],
                                                                                              ($submit_hint ? $this->znakdoporuc : "")) : ""),
                                                    (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_vstupni_typ"],
                                                                                                                    $this->VyberVstupu()) : ""),
                                                    (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_reg_exp"]) : ""),
                                                    (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_min_poc"]) : ""),
                                                    (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_max_poc"]) : ""),
                                                    $this->PocetRadku($form));

                $formular = stripslashes(htmlspecialchars($_POST["formular"], ENT_QUOTES));
                settype($formular, "integer");
                //$typ = stripslashes(htmlspecialchars($_POST["typ"], ENT_QUOTES)); // - typ se zanecha
                //settype($typ, "integer");
                $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
                $name = stripslashes(htmlspecialchars($_POST["name"], ENT_QUOTES));
                $value = stripslashes(htmlspecialchars($_POST["value"], ENT_QUOTES));
                $input_class = stripslashes(htmlspecialchars($_POST["input_class"], ENT_QUOTES));
                $input_id = stripslashes(htmlspecialchars($_POST["input_id"], ENT_QUOTES));
                $input_akce = stripslashes(htmlspecialchars($_POST["input_akce"], ENT_QUOTES));
                $src = stripslashes(htmlspecialchars($_POST["src"], ENT_QUOTES));
                $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
                $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
                $label = (!Empty($_POST["label"]) ? 1 : 0);
                $zacatek = (!Empty($_POST["zacatek"]) ? 1 : 0);
                $konec = (!Empty($_POST["konec"]) ? 1 : 0);
                $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
                $vstupni_typ = stripslashes(htmlspecialchars($_POST["vstupni_typ"], ENT_QUOTES));
                settype($vstupni_typ, "integer");
                $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));
                $min_poc = stripslashes(htmlspecialchars($_POST["min_poc"], ENT_QUOTES));
                settype($min_poc, "integer");
                $max_poc = stripslashes(htmlspecialchars($_POST["max_poc"], ENT_QUOTES));
                settype($max_poc, "integer");
                $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
                settype($poradi, "integer");

                if (!Empty($_POST["tlacitko"]) &&
                    !Empty($formular) &&
                    !Empty($poradi) &&
                    $poradi > 0)
                {
                  if (@$this->sqlite->queryExec("UPDATE prvek SET formular={$formular},
                                                                  nazev='{$nazev}',
                                                                  typ={$data->typ},
                                                                  name='{$name}',
                                                                  value='{$value}{$src}',
                                                                  input_class='{$input_class}',
                                                                  input_id='{$input_id}',
                                                                  input_akce='{$input_akce}',
                                                                  readonly={$readonly},
                                                                  disabled={$disabled},
                                                                  label={$label},
                                                                  zacatek={$zacatek},
                                                                  konec={$konec},
                                                                  povinne={$povinne},
                                                                  reg_exp='{$reg_exp}',
                                                                  vstupni_typ={$vstupni_typ},
                                                                  min_poc={$min_poc},
                                                                  max_poc={$max_poc},
                                                                  poradi={$poradi}
                                                                  WHERE id={$l_id};", $error))
                  {
                    $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_elem2_hlaska"], $name);
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
          } //end else if ($l_id == 0)
        break;

        case "editelem":  //editace elementu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT formular, nazev, typ, name, value, input_class, input_id, input_akce, readonly, disabled, label, zacatek, konec, povinne, reg_exp, vstupni_typ, min_poc, max_poc, poradi FROM prvek WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
              $num_input = array_values($this->input);  //navrat dane hodnoty radku
              //print_r($num_input[$data->typ]); //posl. id: {$l_id}  $num_input[$data->typ][0]

              $jmeno_typu = array_keys($this->input);
              $jm_typ = $jmeno_typu[$data->typ];

              $text_hint = ($jm_typ == "text");
              $submit_hint = ($jm_typ == "submit");

              $show_povinne = ($jm_typ != "option" && $jm_typ != "optgroup");
              $show_nazev = ($jm_typ != "optgroup" && $jm_typ != "hidden" && $jm_typ != "submit" && $jm_typ != "reset");
              //".($submit_hint ? $this->znakdoporuc : "")."
              //".($submit_hint || $text_hint ? $this->znakdoporuc : "")."

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem"],
                                                  $this->VyberSekce($data->formular),
                                                  $this->VyberTypu($data->typ),
                                                  ($show_nazev ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_nazev"],
                                                                                          $data->nazev,
                                                                                          ($text_hint ? $this->znakdoporuc : "")) : ""),
                                                  (!Empty($num_input[$data->typ][3]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_name"],
                                                                                                                $data->name,
                                                                                                                ($submit_hint || $text_hint ? $this->znakdoporuc : "")) : ""),
                                                  (!Empty($num_input[$data->typ][4]) && Empty($num_input[$data->typ][9]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_value"],
                                                                                                                                                    $data->value,
                                                                                                                                                    ($submit_hint ? $this->znakdoporuc : "")) : ""),
                                                  $data->input_class,
                                                  $data->input_id,
                                                  ($data->label ? $this->znakdoporuc : ""),
                                                  $data->input_akce,
                                                  (!Empty($num_input[$data->typ][9]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_src"],
                                                                                                                $data->value) : ""),
                                                  (!Empty($num_input[$data->typ][6]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_readonly"],
                                                                                                                ($data->readonly ? " checked=\"checked\"" : "")) : ""),
                                                  (!Empty($num_input[$data->typ][7]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_disabled"],
                                                                                                                ($data->disabled ? " checked=\"checked\"" : "")) : ""),
                                                  (!Empty($num_input[$data->typ][5]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_label"],
                                                                                                                ($data->label ? " checked=\"checked\"" : "")) : ""),
                                                  ($data->zacatek ? " checked=\"checked\"" : ""),
                                                  (!Empty($num_input[$data->typ][1]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_konec"],
                                                                                                                ($data->konec ? " checked=\"checked\"" : "")) : ""),
                                                  ($show_povinne ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_povinne"],
                                                                                            ($data->povinne ? " checked=\"checked\"" : ""),
                                                                                            ($submit_hint ? $this->znakdoporuc : "")) : ""),
                                                  (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_vstupni_typ"],
                                                                                                                  $this->VyberVstupu($data->vstupni_typ)) : ""),
                                                  (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_reg_exp"],
                                                                                                                  $data->reg_exp) : ""),
                                                  (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_min_poc"],
                                                                                                                  $data->min_poc) : ""),
                                                  (!Empty($num_input[$data->typ][10]) ? $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_max_poc"],
                                                                                                                  $data->max_poc) : ""),
                                                  $data->poradi
                                                  );

              $formular = stripslashes(htmlspecialchars($_POST["formular"], ENT_QUOTES));
              settype($formular, "integer");
              $typ = stripslashes(htmlspecialchars($_POST["typ"], ENT_QUOTES));
              settype($typ, "integer");
              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $name = stripslashes(htmlspecialchars($_POST["name"], ENT_QUOTES));
              $value = stripslashes(htmlspecialchars($_POST["value"], ENT_QUOTES));
              $input_class = stripslashes(htmlspecialchars($_POST["input_class"], ENT_QUOTES));
              $input_id = stripslashes(htmlspecialchars($_POST["input_id"], ENT_QUOTES));
              $input_akce = stripslashes(htmlspecialchars($_POST["input_akce"], ENT_QUOTES));
              $src = stripslashes(htmlspecialchars($_POST["src"], ENT_QUOTES));
              $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
              $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
              $label = (!Empty($_POST["label"]) ? 1 : 0);
              $zacatek = (!Empty($_POST["zacatek"]) ? 1 : 0);
              $konec = (!Empty($_POST["konec"]) ? 1 : 0);
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $vstupni_typ = stripslashes(htmlspecialchars($_POST["vstupni_typ"], ENT_QUOTES));
              settype($vstupni_typ, "integer");
              $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));
              $min_poc = stripslashes(htmlspecialchars($_POST["min_poc"], ENT_QUOTES));
              settype($min_poc, "integer");
              $max_poc = stripslashes(htmlspecialchars($_POST["max_poc"], ENT_QUOTES));
              settype($max_poc, "integer");
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($formular) &&
                  !Empty($poradi) &&
                  $poradi > 0 &&
                  $id > 0)
              {
                if (@$this->sqlite->queryExec("UPDATE prvek SET formular={$formular},
                                                                nazev='{$nazev}',
                                                                typ={$typ},
                                                                name='{$name}',
                                                                value='{$value}{$src}',
                                                                input_class='{$input_class}',
                                                                input_id='{$input_id}',
                                                                input_akce='{$input_akce}',
                                                                readonly={$readonly},
                                                                disabled={$disabled},
                                                                label={$label},
                                                                zacatek={$zacatek},
                                                                konec={$konec},
                                                                povinne={$povinne},
                                                                reg_exp='{$reg_exp}',
                                                                vstupni_typ={$vstupni_typ},
                                                                min_poc={$min_poc},
                                                                max_poc={$max_poc},
                                                                poradi={$poradi}
                                                                WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_hlaska"],
                                                      $name);
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

        case "delelem": //mazani elementu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = @$this->sqlite->query("SELECT name FROM prvek WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM prvek WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_elem_hlaska"],
                                                    $data->name);
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
 * Osetri vstupni nazev
 *
 * @param text vstupni text
 * @return bezpecny text
 */
  private function OsetreniTextu($text)
  {
    $prevod = array("\xc3\xa1" => "a",
                    "\xc3\xa4" => "a",
                    "\xc4\x8d" => "c",
                    "\xc4\x8f" => "d",
                    "\xc3\xa9" => "e",
                    "\xc4\x9b" => "e",
                    "\xc3\xad" => "i",
                    "\xc4\xbe" => "l",
                    "\xc4\xba" => "l",
                    "\xc5\x88" => "n",
                    "\xc3\xb3" => "o",
                    "\xc3\xb6" => "o",
                    "\xc5\x91" => "o",
                    "\xc3\xb4" => "o",
                    "\xc5\x99" => "r",
                    "\xc5\x95" => "r",
                    "\xc5\xa1" => "s",
                    "\xc5\xa5" => "t",
                    "\xc3\xba" => "u",
                    "\xc5\xaf" => "u",
                    "\xc3\xbc" => "u",
                    "\xc5\xb1" => "u",
                    "\xc3\xbd" => "y",
                    "\xc5\xbe" => "z",
                    "\xc3\x81" => "A",
                    "\xc3\x84" => "A",
                    "\xc4\x8c" => "C",
                    "\xc4\x8e" => "D",
                    "\xc3\x89" => "E",
                    "\xc4\x9a" => "E",
                    "\xc3\x8d" => "I",
                    "\xc4\xbd" => "L",
                    "\xc4\xb9" => "L",
                    "\xc5\x87" => "N",
                    "\xc3\x93" => "O",
                    "\xc3\x96" => "O",
                    "\xc5\x90" => "O",
                    "\xc3\x94" => "O",
                    "\xc5\x98" => "R",
                    "\xc5\x94" => "R",
                    "\xc5\xa0" => "S",
                    "\xc5\xa4" => "T",
                    "\xc3\x9a" => "U",
                    "\xc5\xae" => "U",
                    "\xc3\x9c" => "U",
                    "\xc5\xb0" => "U",
                    "\xc3\x9d" => "Y",
                    "\xc5\xbd" => "Z",
                    " " => " ",
                    //"-" => "_",
                    "+" => "_",
                    ";" => "_",
                    ":" => "_",
                    "," => "_",
                    "'" => "_",
                    "?" => "_",
                    "<" => "_",
                    ">" => "_",
                    "\x5c" => "_",  // /
                    "\x2f" => "_",  // \
                    "|" => "_",
                    "=" => "_",
                    "!" => "_",
                    "*" => "_",
                    "@" => "_",
                    "%" => "_",
                    "&" => "_",
                    "§" => "_",
                    "#" => "_",
                    "$" => "_",
                    "\"" => "_",
                    "˚" => "_",
                    "`" => "_",
                    "~" => "_",
                    "^" => "_",
                    "€" => "_",
                    "¶" => "_",
                    "¨" => "_",
                    "ŧ" => "_",
                    "¯" => "_",
                    "←" => "_",
                    "→" => "_",
                    "↓" => "_",
                    "ø" => "_",
                    "þ" => "_",
                    "Đ" => "d",
                    "đ" => "d"
                    );

    return strtr($text, $prevod);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Vypis administrace formulare
 *
 * @return vypis menu v html
 */
  private function AdminVypisForm()
  {
    $typ = array_keys($this->input);

    $result = "";
    //vypis formulare
    if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, predmet, email, textemail FROM formular ORDER BY LOWER(nazev) ASC;", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin_form"],
                                              $data->nazev,
                                              $data->adresa,
                                              $data->predmet,
                                              $data->email,
                                              $data->textemail,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;form={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editform&amp;id={$data->id}",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delform&amp;id={$data->id}");

          //vypis prvku
          if ($res1 = @$this->sqlite->query("SELECT id,
                                            nazev,
                                            typ,
                                            name,
                                            value, poradi
                                            FROM prvek
                                            WHERE prvek.formular={$data->id}
                                            ORDER BY poradi ASC;", NULL, $error))
          {
            if ($res1->numRows() != 0)
            {
              while ($data1 = $res1->fetchObject())
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_elem"],
                                                    $data1->nazev,
                                                    $typ[$data1->typ],
                                                    $data1->name,
                                                    $data1->value,
                                                    $data1->poradi,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}");
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error);
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_end_form"]);
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
