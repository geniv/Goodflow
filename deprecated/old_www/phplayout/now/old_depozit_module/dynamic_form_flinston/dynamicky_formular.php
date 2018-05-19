<?php

/**
 *
 * Blok dynamicky generovane obrazkove galerie
 *
 * public funkce:\n
 * construct: DynamicForm - hlavni konstruktor tridy\n
 * Formular() - hlavni vypis formulare, podle url a nebo zadaneho parametru\n
 * AdminObsah() - obsah adminu\n
 *
 */

class DynamicForm extends DefaultModule
{
  private $var;
  private $sqlite;
  private $dbname;  //jmeno db se ziska z promenne.php
  private $idmodul = "dynform";
  private $dirpath;
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

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error);
    }

    $this->Instalace();

    $adresa_menu = array( array("main_href" => "{$this->idmodul}",
                                "odkaz" => "Dynamické formuláře",
                                "title" => "Dynamické formuláře",
                                "id" => "",
                                "class" => "dynamicke_formulare_menu",
                                "akce" => ""),
                          );

    $this->NastavitAdresuMenu($adresa_menu);
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
 * @return vystupni formular
 */
  public function Formular($adr = NULL)
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

    $result =
    "  <form method=\"post\" action=\"\" id=\"centralni_form\">
    <fieldset>
      <dl>\n";
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

          $result .= (!Empty($data->nazev) ? "<h2>{$data->nazev}</h2>" : "");

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
                $label = ($data1->label ? "        <dt id=\"centralni_dt_{$data1->name}\">\n          <label for=\"{$data1->input_id}\">{$nazev}</label>\n        </dt>\n        " : "");

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
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <input type=\"text\"{$name}{$value}{$input_class}{$input_id}{$input_akce}{$readonly}{$disabled} />{$povinne}\n        </dd>\n";
                    }
                  break;

                  case "password":
                    if ($data1->zacatek)
                    {
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <input type=\"password\"{$name}{$value}{$input_class}{$input_id}{$input_akce}{$readonly}{$disabled} />{$povinne}\n        </dd>\n";
                    }
                  break;

                  case "textarea":
                    if ($data1->zacatek)
                    {
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <textarea{$name}{$input_class}{$input_id}{$input_akce}{$readonly}{$disabled} rows=\"10\" cols=\"30\">{$valuetext}";
                    }

                    if ($data1->konec)
                    {
                      $element = "</textarea>{$povinne}\n        </dd>\n";
                    }

                    if ($data1->zacatek && $data1->konec)
                    {
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <textarea{$name}{$input_class}{$input_id}{$input_akce}{$readonly}{$disabled} rows=\"10\" cols=\"30\">{$valuetext}</textarea>{$povinne}\n        </dd>\n";
                    }
                  break;

                  case "checkbox":
                    if ($data1->zacatek)
                    {
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <input type=\"checkbox\"{$name}{$input_class}{$input_id}{$input_akce}{$disabled} /> {$valuetext}{$povinne}\n        </dd>\n";
                    }
                  break;

                  case "radio":
                    if ($data1->zacatek)
                    {
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <input type=\"radio\"{$name}{$input_class}{$input_id}{$input_akce}{$disabled} /> {$valuetext}{$povinne}\n        </dd>\n";
                    }
                  break;

                  case "submit":
                    if ($data1->zacatek)
                    {
                      $element = "        <dd id=\"centralni_dd_{$data1->name}\">\n          <input type=\"submit\"{$name}{$value}{$input_class}{$input_id}{$input_akce}{$disabled} />\n        </dd>\n";
                    }
                  break;

                  case "reset":
                    if ($data1->zacatek)
                    {
                      $element = "        <dd id=\"centralni_dd_{$data1->name}\">\n          <input type=\"reset\"{$name}{$value}{$input_class}{$input_id}{$input_akce}{$disabled} />\n        </dd>\n";
                    }
                  break;

                  case "image":
                    if ($data1->zacatek)
                    {
                      $element = "        <input type=\"image\"{$name}{$src}{$input_class}{$input_id}{$input_akce}{$disabled} />\n";
                    }
                  break;

                  case "hidden":
                    if ($data1->zacatek)
                    {
                      $element = "        <input type=\"hidden\"{$name}{$value}{$input_class}{$input_id}{$input_akce} />\n";
                    }
                  break;

                  case "select":
                    if ($data1->zacatek)
                    {
                      $element = "{$label}<dd id=\"centralni_dd_{$data1->name}\">\n          <select{$name}{$input_class}{$input_id}{$input_akce}{$disabled}>";
                    }

                    if ($data1->konec)
                    {
                      $element = "\n          </select>{$povinne}\n        </dd>\n";
                    }
                  break;

                  case "option":
                    if ($data1->zacatek && $data1->konec)
                    {
                      $element = "\n              <option{$value}{$input_class}{$input_id}{$input_akce}>{$nazev}</option>";
                    }
                  break;

                  case "optgroup":
                    if ($data1->zacatek)
                    {
                      $element = "\n            <optgroup{$valuegru}{$input_class}{$input_id}{$input_akce}>";
                    }

                    if ($data1->konec)
                    {
                      $element = "\n            </optgroup>";
                    }
                  break;

                  default:
                    $element = "??";
                  break;
                }

                $result .=
                "{$element}";
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

    $result .=
    "      </dl>
      <p id=\"centralni_form_dodatek\">{$dodatek}</p>
    </fieldset>
  </form>";

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
              $obsah .= "{$nazev}: {$prom}<br />\n";
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

        $zprava = "{$textemail}<br />\n<br />\n{$obsah}<br />\nIP: {$ip}<br />\nHost: {$host}<br />\nOS: {$os}<br />\nBrowser: {$brow}<br />\nDatum: {$datum}";
        //prepnani mezi nastavenym a uzivatelskym emailem
        $admin_from = (!Empty($odesilateladmin) ? $odesilateladmin : $_POST[$zdrojovyemail]);
        $header = "{$this->hlavicka}\nFrom: {$admin_from}";  //hlavička

        if (@mail($email, $this->OsetreniTextu($predmet), $zprava, $header))  //odeslani majiteli
        {
          $em1 = "odesláno majiteli";
        }
          else
        {
          $em1 = "něco se pokazilo";
        }

        if ($oznameni)  //je-li povolene oznameni
        {
          $zprava = "{$textemailoznameni}<br />\n<br />\n{$obsah}";
          $header = "{$this->hlavicka}\nFrom: {$odesilateluzivatel}\n";  //hlavička

          if (@mail($_POST[$zdrojovyemail], $this->OsetreniTextu($predmetoznameni), $zprava, $header))
          {
            $em2 = ", odeslano oznameni";
          }
            else
          {
            $em2 = ", něco se pokazilo";
          }
        }

        $result = "data odeslána... {$em1}{$em2}";
      }
        else
      {
        $result = "chyba vstupnich dat!";
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
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberVstupu($id = NULL)
  {
    $typ = $this->vstupni_typ;

    $result = "<select name=\"vstupni_typ\">";
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .=
      "
        <option value=\"{$i}\"".($id == $i ? " selected=\"selected\"" : "").">{$typ[$i]}</option>
      ";
    }
    $result .= "</select>";

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

    $result = "<select name=\"typ\"".($zamek ? " disabled=\"disabled\"" : "").">";
    for ($i = 0; $i < count($typ); $i++)
    {
      $result .=
      "
        <option value=\"{$i}\"".($id == $i ? " selected=\"selected\"" : "").">{$typ[$i]}</option>
      ";
    }
    $result .= "</select>";

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
        $result = "<select name=\"formular\">";
        while ($data = $res->fetchObject())
        {
          $result .=
          "
            <option value=\"{$data->id}\"".(!Empty($id) && $id == $data->id ? " selected=\"selected\"" : "").">adresa formuláře: {$data->adresa}</option>
          ";
        }
        $result .= "</select>";
      }
        else
      {
        $result = "žádný formulář";
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
    $result =
    "administrace dynamické obrázkové galerie
    <br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addform\" title=\"\">přidat formular</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv\" title=\"\">test regularnich vyrazu</a><br />
    <br />
    {$this->AdminVypisForm()}
    ";

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "test_rv":
          $vstup = stripslashes(htmlspecialchars($_POST["vstup"], ENT_QUOTES));
          //prepinani podle webu/lokalu
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));

          $result =
          "
          <form method=\"post\">
            <fieldset>
              <a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />
              vstup: <input type=\"text\" name=\"vstup\" value=\"{$vstup}\" /><br />
              reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"{$reg_exp}\" /><br />
              <input type=\"submit\" name=\"tlacitko\" value=\"otestovat\" />
            </fieldset>
          </form>
          výsledek:
          ";

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($vstup) &&
              !Empty($reg_exp))
          {
            preg_match($reg_exp, $vstup, $ret);
            $result .= (!Empty($ret[0]) ? "<strong>{$ret[0]}</strong>" : "NULL");  //vybere nulty index
          }
        break;

        case "addform": //pridavani formulare
          $result =
          "
          <form method=\"post\">
            <fieldset>
              adresa: <input type=\"text\" name=\"adresa\" />*<br />
              nazev: <input type=\"text\" name=\"nazev\" /><br />
              predmet: <input type=\"text\" name=\"predmet\" />*<br />
              <input type=\"checkbox\" name=\"odesilatel\" checked=\"checked\" onclick=\"(this.checked ? odes_1() : odes_2());\" /> posílat uživatelův email jako odesilatele *<br />
              odesilatel admin: <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilatel\" /><br />
              email: <input type=\"text\" name=\"email\" />*<br />
              text email: <input type=\"text\" name=\"textemail\" />*<br />
              dodatek: <input type=\"text\" name=\"dodatek\" /><br />
              oznameni: <input type=\"checkbox\" name=\"oznameni\" checked=\"checked\" /><br />
              predmet oznameni: <input type=\"text\" name=\"predmetoznameni\" /><br />
              odesilatel uzivatel: <input type=\"text\" name=\"odesilateluzivatel\" />*<br />
              text email oznameni: <input type=\"text\" name=\"textemailoznameni\" /><br />
              zdrojovy email: <input type=\"text\" name=\"zdrojovyemail\" />(name elementu)<br />
              <input type=\"submit\" name=\"tlacitko\" value=\"Přidat formular\" />
            </fieldset>
          </form>

          <script type=\"text/javascript\">
            function odes_1()
            {
              document.getElementById('id_odesilatel').disabled = true;
            }

            function odes_2()
            {
              document.getElementById('id_odesilatel').disabled = false;
            }

            odes_1();
          </script>
          ";

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
              $result =
              "
                přídán: {$adresa}
              ";
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

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  adresa: <input type=\"text\" name=\"adresa\" value=\"{$data->adresa}\" />*<br />
                  nazev: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" /><br />
                  predmet: <input type=\"text\" name=\"predmet\" value=\"{$data->predmet}\" />*<br />
                  <input type=\"checkbox\" name=\"odesilatel\"".(Empty($data->odesilateladmin) ? " checked=\"checked\"" : "")." onclick=\"(this.checked ? odes_1() : odes_2());\" /> posílat uživatelův email jako odesilatele *<br />
                  odesilatel admin: <input type=\"text\" name=\"odesilateladmin\" id=\"id_odesilatel\" value=\"{$data->odesilateladmin}\" /><br />
                  email: <input type=\"text\" name=\"email\" value=\"{$data->email}\" />*<br />
                  text email: <input type=\"text\" name=\"textemail\" value=\"{$data->textemail}\" />*<br />
                  dodatek: <input type=\"text\" name=\"dodatek\" value=\"{$data->dodatek}\" /><br />
                  oznameni: <input type=\"checkbox\" name=\"oznameni\"".($data->oznameni ? " checked=\"checked\"" : "")." /><br />
                  predmet oznameni: <input type=\"text\" name=\"predmetoznameni\" value=\"{$data->predmetoznameni}\" /><br />
                  odesilatel uzivatel: <input type=\"text\" name=\"odesilateluzivatel\" value=\"{$data->odesilateluzivatel}\" />*<br />
                  text email oznameni: <input type=\"text\" name=\"textemailoznameni\" value=\"{$data->textemailoznameni}\" /><br />
                  zdrojovy email: <input type=\"text\" name=\"zdrojovyemail\" value=\"{$data->zdrojovyemail}\" />(name elementu)<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit formular\" />
                </fieldset>
              </form>

              <script type=\"text/javascript\">
                function odes_1()
                {
                  document.getElementById('id_odesilatel').disabled = true;
                }

                function odes_2()
                {
                  document.getElementById('id_odesilatel').disabled = false;
                }

                ".(Empty($data->odesilateladmin) ? "odes_1();" : "odes_2();")."
              </script>
              ";

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
                  $result =
                  "
                    upraven: {$adresa}
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
                $result =
                "
                  smazána adresa: '{$data->adresa}' a jeho pod-elementy
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



        case "addelem": //pridavani elementu
          $form = $_GET["form"];  //cislo formulare
          settype($form, "integer");

          $l_id = $_GET["lastid"];  //ekv, id
          settype($l_id, "integer");

          if ($l_id == 0)
          { //pridani vzorku prvku
            $result =
            "
            <form method=\"post\">
              <fieldset>
                {$this->VyberTypu()}<br />
                nazev: <input type=\"text\" name=\"nazev\" /><br />
                <input type=\"submit\" name=\"tlacitko\" value=\"Přidat prvek\" />
              </fieldset>
            </form>
            ";

            $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
            $typ = $_POST["typ"];  //cislo formulare
            settype($typ, "integer");

            if (!Empty($_POST["tlacitko"]))
            {
              if (@$this->sqlite->queryExec("INSERT INTO prvek (id, formular, nazev, typ) VALUES
                                            (NULL, {$form}, '{$nazev}', {$typ});", $error))
              {
                $result =
                "
                  přídán typ element: {$this->VyberTypu($typ, true)}
                ";

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

                $result =
                "
                <form method=\"post\">
                  <fieldset>
                    formulář: {$this->VyberSekce($form)}<br />
                    {$this->VyberTypu($data->typ, true)}<br />
                    ".($show_nazev ? "nazev: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" />".($text_hint ? $this->znakdoporuc : "")."<br />" : "")."
                    ".(!Empty($num_input[$data->typ][3]) ? "name: <input type=\"text\" name=\"name\" />".($submit_hint || $text_hint ? $this->znakdoporuc : "")."<br />" : "")."
                    ".(!Empty($num_input[$data->typ][4]) && Empty($num_input[$data->typ][9]) ? "value: <input type=\"text\" name=\"value\" />".($submit_hint ? $this->znakdoporuc : "")."<br />" : "")."
                    input_class: <input type=\"text\" name=\"input_class\" /><br />
                    input_id: <input type=\"text\" name=\"input_id\" /><br />
                    input_akce: <input type=\"text\" name=\"input_akce\" /><br />
                    ".(!Empty($num_input[$data->typ][9]) ? "src: <input type=\"text\" name=\"src\" /><br />" : "")."
                    ".(!Empty($num_input[$data->typ][6]) ? "readonly: <input type=\"checkbox\" name=\"readonly\" /><br />" : "")."
                    ".(!Empty($num_input[$data->typ][7]) ? "disabled: <input type=\"checkbox\" name=\"disabled\" /><br />" : "")."
                    ".(!Empty($num_input[$data->typ][5]) ? "label: <input type=\"checkbox\" name=\"label\" /><br />" : "")."
                    zacatek: <input type=\"checkbox\" name=\"zacatek\"".($num_input[$data->typ][0] ? " checked=\"checked\"" : "")." /><br />
                    ".(!Empty($num_input[$data->typ][1]) ? "konec: <input type=\"checkbox\" name=\"konec\" /><br />" : "")."
                    ".($show_povinne ? "povinne: <input type=\"checkbox\" name=\"povinne\" />".($submit_hint ? $this->znakdoporuc : "")."<br />" : "")."
                    ".(!Empty($num_input[$data->typ][10]) ? "vstupni_typ: {$this->VyberVstupu()}<br />" : "")."
                    ".(!Empty($num_input[$data->typ][10]) ? "reg_exp: <input type=\"text\" name=\"reg_exp\" /><a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />" : "")."
                    ".(!Empty($num_input[$data->typ][10]) ? "min_poc: <input type=\"text\" name=\"min_poc\" /><br />" : "")."
                    ".(!Empty($num_input[$data->typ][10]) ? "max_poc: <input type=\"text\" name=\"max_poc\" /><br />" : "")."
                    poradi: <input type=\"text\" name=\"poradi\" value=\"{$this->PocetRadku($form)}\" />*>0<br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"Přidat element\" />
                  </fieldset>
                </form>
                ";

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
                    $result =
                    "
                      uložen element: {$name}
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

              $result =
              "
              <form method=\"post\">
                <fieldset>
                  formulář: {$this->VyberSekce($data->formular)}<br />
                  {$this->VyberTypu($data->typ)}, po uložení vyplnit dané políčka<br />
                  ".($show_nazev ? "nazev: <input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\" />".($text_hint ? $this->znakdoporuc : "")."<br />" : "")."
                  ".(!Empty($num_input[$data->typ][3]) ? "name: <input type=\"text\" name=\"name\" value=\"{$data->name}\" />".($submit_hint || $text_hint ? $this->znakdoporuc : "")."<br />" : "")."
                  ".(!Empty($num_input[$data->typ][4]) && Empty($num_input[$data->typ][9]) ? "value: <input type=\"text\" name=\"value\" value=\"{$data->value}\" />".($submit_hint ? $this->znakdoporuc : "")."<br />" : "")."
                  input_class: <input type=\"text\" name=\"input_class\" value=\"{$data->input_class}\" /><br />
                  input_id: <input type=\"text\" name=\"input_id\" value=\"{$data->input_id}\" />".($data->label ? $this->znakdoporuc : "")."<br />
                  input_akce: <input type=\"text\" name=\"input_akce\" value=\"{$data->input_akce}\" /><br />
                  ".(!Empty($num_input[$data->typ][9]) ? "src: <input type=\"text\" name=\"src\" value=\"{$data->value}\" /><br />" : "")."
                  ".(!Empty($num_input[$data->typ][6]) ? "readonly: <input type=\"checkbox\" name=\"readonly\"".($data->readonly ? " checked=\"checked\"" : "")." /><br />" : "")."
                  ".(!Empty($num_input[$data->typ][7]) ? "disabled: <input type=\"checkbox\" name=\"disabled\"".($data->disabled ? " checked=\"checked\"" : "")." /><br />" : "")."
                  ".(!Empty($num_input[$data->typ][5]) ? "label: <input type=\"checkbox\" name=\"label\"".($data->label ? " checked=\"checked\"" : "")." /><br />" : "")."
                  zacatek: <input type=\"checkbox\" name=\"zacatek\"".($data->zacatek ? " checked=\"checked\"" : "")." /><br />
                  ".(!Empty($num_input[$data->typ][1]) ? "konec: <input type=\"checkbox\" name=\"konec\"".($data->konec ? " checked=\"checked\"" : "")." /><br />" : "")."
                  ".($show_povinne ? "povinne: <input type=\"checkbox\" name=\"povinne\"".($data->povinne ? " checked=\"checked\"" : "")." />".($submit_hint ? $this->znakdoporuc : "")."<br />" : "")."
                  ".(!Empty($num_input[$data->typ][10]) ? "vstupni_typ: {$this->VyberVstupu($data->vstupni_typ)}<br />" : "")."
                  ".(!Empty($num_input[$data->typ][10]) ? "reg_exp: <input type=\"text\" name=\"reg_exp\" value=\"{$data->reg_exp}\" /><a href=\"http://php.net/manual/en/regexp.reference.php\">dokumentace</a><br />" : "")."
                  ".(!Empty($num_input[$data->typ][10]) ? "min_poc: <input type=\"text\" name=\"min_poc\" value=\"{$data->min_poc}\" /><br />" : "")."
                  ".(!Empty($num_input[$data->typ][10]) ? "max_poc: <input type=\"text\" name=\"max_poc\" value=\"{$data->max_poc}\" /><br />" : "")."
                  poradi: <input type=\"text\" name=\"poradi\" value=\"{$data->poradi}\" />*>0<br />
                  <input type=\"submit\" name=\"tlacitko\" value=\"Upravit element\" />
                </fieldset>
              </form>
              ";

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
                  $result =
                  "
                    uložen element: {$name}
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
                $result =
                "
                  smazán element: {$data->name}
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
          $result .=
          "<br />
-------------------------------------------------------------------------------
          <br />
          {$data->nazev} - {$data->adresa}<p>{$data->predmet} {$data->email} {$data->textemail}</p>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;form={$data->id}\" title=\"\">přidat prvek</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editform&amp;id={$data->id}\" title=\"\">upravit formulář</a>
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delform&amp;id={$data->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat formulář: \'{$data->nazev}\' ?');\">smazat formulář</a><br />
          ";

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
                $result .=
                "<br />
*******************************************************************************
                <br />
                <p>{$data1->nazev}, {$typ[$data1->typ]}, {$data1->name}, {$data1->value}, {$data1->poradi}</p>
                <br />
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}\" title=\"\">upravit prvek</a>
                <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}\" title=\"\" onclick=\"return confirm('Opravdu smazat prvek: \'{$data1->nazev}\' ?');\">smazat prvek</a><br />

                ";
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

    return $result;
  }
}
?>
