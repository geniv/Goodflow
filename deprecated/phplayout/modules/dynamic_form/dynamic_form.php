<?php

/**
 *
 * Blok dynamicky generovaneho formulare
 *
 */

//verze modulu
define("v_DynamicForm", "1.01");

class DynamicForm extends DefaultModule
{
  private $var, $dirpath, $debug_lokal, $absolutni_url, $captchakod, $unikatni, $dbpredpona;
  public $idmodul = "dynform";
  private $idsoubory = "_listfile";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array("script/ajax.js"); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array("Ajax" => "DynamicForm"); //konvert nazvu metody

  private $localpermit;

  private $znakpovinne = "\n          <span>*</span>"; //povinne
  private $hlavicka = "Content-type: text/html; charset=UTF-8";

  private $pathfile = "soubory";  //slozka souboru
  private $getidfile = "execfile";

  private $input = array ();

  private $vstupni_typ = array ("text", //kontrola - min poc, max poc
                                "integer",  //kontrola - min val, max val
                                "reg_exp"); //regularni vyraz

//dodelat!!!! od zacatku projit podle nejakeho modulu...
//prepracovat JS a moznosti elementu, vystupu jak internich tak externich

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

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      $this->znakpovinne = $this->unikatni["set_znakpovinne"];
      $this->input = $this->unikatni["set_input"];
      $this->hlavicka = $this->unikatni["set_hlavicka"];

      $this->pathfile = $this->unikatni["set_pathfile"];
      $this->getidfile = $this->unikatni["set_getidfile"];

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);  //pripojeni defaultu

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul,
                                                          $this->idsoubory));
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

        case "{$this->idmodul}{$this->idsoubory}":  //seznam souboru
          $result = $this->AdminObsahSouboru();
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
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}sablona (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                adresa TEXT,
                                nazev VARCHAR(200),
                                predmet VARCHAR(100),
                                email VARCHAR(100),
                                textemail TEXT,
                                dodatek TEXT,
                                oznameni BOOL,

                                predmetoznameni VARCHAR(200),
                                textemailoznameni TEXT,
                                zdrojovyemail VARCHAR(100),
                                odesilateladmin VARCHAR(100),
                                odesilateluzivatel VARCHAR(100),

                                konfigurace TEXT,
                                popis TEXT
                                );

                              CREATE TABLE {$this->dbpredpona}element (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                sablona INTEGER UNSIGNED,
                                nazev VARCHAR(200),
                                typ VARCHAR(50),
                                konfigurace TEXT,
                                value TEXT,
                                popis TEXT,
                                povinne BOOL,
                                vstup VARCHAR(50),
                                reg_exp VARCHAR(500),
                                min_val INTEGER UNSIGNED,
                                max_val INTEGER UNSIGNED,
                                poradi INTEGER UNSIGNED);
                                ");
  }

/**
 *
 * Navraceni samotneho formulare
 *
 * $text = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "adresa"[, array("pridavek"), 1]);
 *
 * @param adresa adresa formulare
 * @param pridavek pridavne pole hodnot
 * @param tvar tvat formulare
 * @return vystupni formular
 */
  public function Formular($adresa, $pridavek = NULL, $tvar = 1)
  {
    $typ = array_keys($this->input);  //nazvy prvku

/*
    if (!Empty($_GET[$this->getidfile]))
    {
      //"download:".rand(100, 1000).":form%%{$zipcil}%%".rand(100, 1000)
      $dekodovani = $this->DekodujText($_GET[$this->getidfile]);
      $direct = explode(":", $dekodovani);
      $fil = explode("%%", $dekodovani);

      if ($direct[0] == "download" &&
          !Empty($fil[1]))
      {
        $nazev = explode("_", basename($fil[1])); //vybrani nazvu
        header("Content-Description: File Transfer");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment; filename=\"{$nazev[0]}.zip\"");  //nazev vrati se zip
        readfile($fil[1]); //vyblije soubor na stdout
        exit(0);
      }
    }
*/

    //vypis formulare
    $result = "";
    $name_tlacitko = "tlacitko";
    if ($res = $this->query("SELECT id, adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel FROM {$this->dbpredpona}formular WHERE adresa='{$adresa}';", $error))
    {
      $poc_prvku = $this->numRows($res);
      if ($this->numRows($res) == 1)
      {
        //soubory
        if (!file_exists("{$this->dirpath}/{$this->pathfile}"))  //vytvoreni slozek na obrazky
        {
          mkdir("{$this->dirpath}/{$this->pathfile}", 0777);
        }

        while ($data = $this->fetchObject($res))
        {
          //vypis prvku
          if ($res1 = $this->query("SELECT
                                    id, formular, nazev, typ, value, readonly,
                                    disabled, povinne, reg_exp, vstupni_typ,
                                    min_val, max_val
                                    FROM {$this->dbpredpona}prvek
                                    WHERE prvek.formular={$data->id}
                                    ORDER BY poradi ASC;", $error))
          {
            $pocetelem = $this->numRows($res1);
            if ($this->numRows($res1) != 0)
            {
              $i = 0;
              $vypis = array("array_args",
                            $this->absolutni_url,
                            $this->dirpath);

              while ($data1 = $this->fetchObject($res1))
              {
                $podminka[$i]["id"] = $data1->id;
                $podminka[$i]["name"] = ($typ[$data1->typ] == "radio" ? "elem_{$data1->nazev}" : "elem_{$data1->id}");//"elem_{$data1->id}"; //jmeno elementu
                $podminka[$i]["nazev"] = $data1->nazev; //popis elementu
                $podminka[$i]["blok"] = $data1->value; //text value, pro blok
                $podminka[$i]["typ"] = $typ[$data1->typ];  //textove oznaceni typu
                $podminka[$i]["povinne"] = $data1->povinne;  //bool vyraz povinne
                $podminka[$i]["vstup"] = $this->vstupni_typ[$data1->vstupni_typ];  //typ vstupu
                $podminka[$i]["reg_exp"] = $data1->reg_exp;  //regularni vyraz
                $podminka[$i]["min"] = $data->min_val;  //minimalni pocet
                $podminka[$i]["max"] = $data->max_val;  //maximalni pocet
                $podminka[$i]["chyba"] = "";  //text chyby
                $podminka[$i]["chyba_form"] = ""; //hidden chyby pro znovu naplneni

                switch ($typ[$data1->typ])
                {
                  case "text":  //pro text
                    $vypis[] = $podminka[$i]["id"].":text";
                    $vypis[] = $podminka[$i]["name"];
                    $vypis[] = $podminka[$i]["nazev"];
                    $vypis[] = (!Empty($_POST[$podminka[$i]["name"]]) ? $_POST[$podminka[$i]["name"]] : $data1->value); //pri chybnem vyplneni, funkce jen na oko
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], $podminka[$i]["name"], $_POST[$podminka[$i]["name"]]);
                    $vypis[] = " onfocus=\"this.value=(this.value == '{$data1->value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$data1->value}' : this.value);\"";
                    $vypis[] = ($data1->readonly ? " readonly=\"readonly\"" : "");
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($podminka[$i]["povinne"] ? $this->znakpovinne : "");
                  break;

                  case "checkbox":  //pro checkbox
                    $vypis[] = $podminka[$i]["id"].":checkbox";
                    $vypis[] = $podminka[$i]["name"];
                    $vypis[] = $data1->value;//$podminka[$i]["nazev"];
                    $vypis[] = (!Empty($_POST[$podminka[$i]["name"]]) ? " checked=\"checked\"" : "");
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($podminka[$i]["povinne"] ? $this->znakpovinne : "");
                  break;

                  case "radio": //pro radio
                    $vypis[] = $podminka[$i]["id"].":radio";
                    $vypis[] = $podminka[$i]["name"];
                    $vypis[] = $data1->value;//$podminka[$i]["nazev"];
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($_POST[$podminka[$i]["name"]] == $data1->value ? " checked=\"checked\"" : "");
                    $vypis[] = ($podminka[$i]["povinne"] ? $this->znakpovinne : "");
                  break;

                  case "datumcas":  //pro datum cas
                    $vypis[] = $podminka[$i]["id"].":datumcas";
                    $vypis[] = $podminka[$i]["name"];
                    $vypis[] = $podminka[$i]["nazev"];
                    $vypis[] = (!Empty($_POST[$podminka[$i]["name"]]) ? $_POST[$podminka[$i]["name"]] : date($data1->value));
                    $vypis[] = ($podminka[$i]["povinne"] ? $this->znakpovinne : "");
                  break;

                  case "captcha":  //pro captchu
                    $vypis[] = $podminka[$i]["id"].":captcha";
                    $vypis[] = $podminka[$i]["name"];
                    //$vypis[] = $podminka[$i]["nazev"];

                    //sam si nacte captchu
                    $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $data1->value); //pro id 1
                    $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $data1->value, $slovo);  //pro id 1 se slovem
                    $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "UpravSlovo", $slovo);

                    $this->captchakod[$adresa]["id"] = $data1->value;
                    $this->captchakod[$adresa]["captcha"] = $captcha;
                    $this->captchakod[$adresa]["slovo"] = $slovo;

                    $vypis[] = $data1->value; //id captcha
                    $vypis[] = $captcha;  //samotny obrazek
                    $vypis[] = $slovo;

                    $vypis[] = ($podminka[$i]["povinne"] ? $this->znakpovinne : "");
                  break;

                  case "file":  //upload souboru
                    $vypis[] = $podminka[$i]["id"].":file";
                    $vypis[] = $podminka[$i]["name"];
                    $vypis[] = implode(", ", explode("|", $data1->value));
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($podminka[$i]["povinne"] ? $this->znakpovinne : "");
                  break;
                }

                $i++;
              } //end while res1

              $vypis[] = $name_tlacitko;
              $vypis[] = (!Empty($_POST[$name_tlacitko]) ? " disabled=\"disabled\"" : "");
              $vypis[] = $data->dodatek;

              if (!Empty($pridavek) &&
                  is_array($pridavek))
              {
                $vypis = array_merge($vypis, $pridavek); //slouceni pole, hlavni+pridavek
              }

              $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_{$tvar}"],
                                                  $vypis);

              if ($this->var->debug_mod && $this->debug_lokal)  //debug mode
              {
                print_r($vypis);
              }

              $poc = 0;
              $check = true;
              $vystup = "";
              for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni a spravnosti dat
              {
                //$zpost = $_POST[$podminka[$i]["name"]]; //vezme si hodnotu z postu podle nazvu elementu
                $zpost = $this->ChangeWrongChar($_POST[$podminka[$i]["name"]]); //prevadat i pro kontrolu!

                //jmeno pro error hlasku
                $error_nazev = ($podminka[$i]["nazev"][strlen($podminka[$i]["nazev"]) - 1] == ":" ? substr($podminka[$i]["nazev"], 0, -1) : $podminka[$i]["nazev"]);

                switch ($podminka[$i]["typ"]) //rozliseni kontroly podle typu
                {
                  case "text":  //konrola pro text
                    switch ($podminka[$i]["vstup"])
                    {
                      case "text":  //konvert textu
                        settype($zpost, "string");

                        if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                        {
                          $zpost = "";
                          $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev) : "");
                        }
                          else
                        if ($podminka[$i]["min"] > 0 && //kontrola rozsahu poctu pismen
                            $podminka[$i]["max"] > 0)
                        {
                          if (strlen($zpost) < $podminka[$i]["min"] ||
                              strlen($zpost) > $podminka[$i]["max"])
                          {
                            $zpost = "";
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $error_nazev);
                          }
                        }
                          else
                        if ($podminka[$i]["min"] > 0)  //kontrola minina
                        {
                          if (strlen($zpost) < $podminka[$i]["min"])
                          {
                            $zpost = "";
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $error_nazev);
                          }
                        }
                          else
                        if ($podminka[$i]["max"] > 0)  //kontrola maxima
                        {
                          if (strlen($zpost) > $podminka[$i]["max"])
                          {
                            $zpost = "";
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $error_nazev);
                          }
                        }
                      break;

                      case "integer": //kontrola cisla
                        settype($zpost, "integer");

                        if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                        {
                          $zpost = "";
                          $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev) : "");
                        }
                          else
                        if ($podminka[$i]["min"] > 0 &&
                            $podminka[$i]["max"] > 0)
                        {
                          if ($zpost < $podminka[$i]["min"] ||  //kontrola hodnoty cisel
                              $zpost > $podminka[$i]["max"])
                          {
                            $zpost = "";
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_max_{$tvar}"], $error_nazev);
                          }
                        }
                          else
                        if ($podminka[$i]["min"] > 0)  //kontrola minina
                        {
                          if ($zpost < $podminka[$i]["min"])
                          {
                            $zpost = "";
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_min_{$tvar}"], $error_nazev);
                          }
                        }
                          else
                        if ($podminka[$i]["max"] > 0)  //kontrola maxima
                        {
                          if ($zpost > $podminka[$i]["max"])
                          {
                            $zpost = "";
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_max_{$tvar}"], $error_nazev);
                          }
                        }
                      break;

                      case "reg_exp": //konrola reg_exp
                        if ($podminka[$i]["blok"] == $zpost)  //znacknuto bez rozmyslu
                        {
                          $zpost = "";
                          $podminka[$i]["chyba"] = ($podminka[$i]["povinne"] ? $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev) : "");
                          break;
                        }
                          else
                        {
                          preg_match($podminka[$i]["reg_exp"], $zpost, $ret);
                          $zpost = $ret[0];  //vybere nulty index

                          if (Empty($zpost))
                          {
                            $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_reg_exp_{$tvar}"], $error_nazev);
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
                      $vystup[] = $podminka[$i]["nazev"];
                      $vystup[] = $zpost;
                    }
                  break;

                  case "checkbox":  //kontrola checkboxu
                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_checked_error_{$tvar}"], $error_nazev);
                    }
                      else
                    {
                      $poc++;
                      $vystup[] = $zpost;
                    }
                  break;

                  case "radio": //kontrols radio buttonu
                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_radio_error_{$tvar}"], $error_nazev);
                    }
                      else
                    {
                      $poc++;
                      $vystup[] = $zpost;
                    }
                  break;

                  case "datumcas":  //kontrola datum-cas
                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_{$tvar}"], $error_nazev);
                    }
                      else
                    {
                      $poc++;
                      $vystup[] = $zpost;
                    }
                  break;

                  case "captcha": //kontrola captcha kodu
                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_captcha_{$tvar}"]);  //prazdna
                    }
                      else
                    {
                      if ($zpost == $_SESSION["slovo_{$this->captchakod[$adresa]["id"]}_lastsolve"])  //turinguv stroj rozliseni cloveka
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

                  case "file":  //kontrola uploadu
                    if (Empty($_FILES[$podminka[$i]["name"]]["tmp_name"]) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_file_error_{$tvar}"], $error_nazev);
                    }
                      else
                    {
                      $poc++;
                      $roz = explode(".", $_FILES[$podminka[$i]["name"]]["name"]);
                      $prip = strtolower($roz[count($roz) - 1]);  //vyparsrovani a osetreni pripony
                      $seznam = explode("|", $podminka[$i]["blok"]);

                      if (in_array($prip, $seznam)) //kontrola pripony
                      {
                        //upload
                        $nazev = strtolower($_FILES[$podminka[$i]["name"]]["name"]);
                        if (move_uploaded_file($_FILES[$podminka[$i]["name"]]["tmp_name"],
                                              "{$this->dirpath}/{$this->pathfile}/{$nazev}"))
                        {
                          $dat = date("d-m-Y-H-i-s");
                          $ran = rand(100, 1000).rand(100, 1000).rand(100, 1000);

                          $zipcil = "{$this->dirpath}/{$this->pathfile}/{$nazev}_{$dat}_{$ran}.zip";
                          $zip = new ZipArchive();  //zazipovani souboru
                          if ($zip->open($zipcil, ZipArchive::CREATE) === true)
                          {
                            $zip->addFile("{$this->dirpath}/{$this->pathfile}/{$nazev}", $nazev);
                            if ($zip->close())  //kdyz zavre tak smaze originalni soubor
                            {
                              unlink("{$this->dirpath}/{$this->pathfile}/{$nazev}");
                            }
                          }
                          $execdown = $this->ZakodujText("download:".rand(100, 1000).":form%%{$zipcil}%%".rand(100, 1000));

                          $vystup[] = ($this->var->htaccess ? "{$this->getidfile}/{$execdown}" : "?{$this->getidfile}={$execdown}");
                        }
                          else
                        {
                          $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_upload_file_error_{$tvar}"], $nazev);
                        }
                      }
                        else
                      {
                        $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_suffix_file_error_{$tvar}"], $prip);
                      }
                    }
                  break;

                  default:  //kontrola defaultnich hodnot bez ukladani obsahu: submit, reset
                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_unkown_{$tvar}"], $error_nazev);
                    }
                      else
                    {
                      $poc++;
                    }
                  break;
                } //end switch
              } //end for

              if ($this->var->debug_mod && $this->debug_lokal)  //debug mode
              {
                var_dump($vystup);
                var_dump(sprintf("check: %d, poc: %d, pocelem: %d, poc==pocelem: %d", $check, $poc, $pocetelem, $poc == $pocetelem));
              }

              if ($check &&
                  $poc == $pocetelem &&
                  count($_POST) > 1 &&
                  !Empty($_POST[$name_tlacitko]))
              {
                $adminemail = array("array_args",
                                    $this->absolutni_url,
                                    $_SERVER["REMOTE_ADDR"],
                                    gethostbyaddr($_SERVER["REMOTE_ADDR"]),
                                    $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $_SERVER["HTTP_USER_AGENT"]),
                                    $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $_SERVER["HTTP_USER_AGENT"]),
                                    date($this->NactiUnikatniObsah($this->unikatni["normal_datum_admin_email_{$tvar}"])));

                //je-li vyplneny odesilatel na tvrdo pouzije odesilatele, jinak bere z inputu zdrojoveho emailu
                $header = $this->NactiUnikatniObsah($this->unikatni["normal_email_header_{$tvar}"],  //hlavička
                                                    $this->hlavicka,
                                                    (!Empty($data->odesilateladmin) ? htmlspecialchars_decode(html_entity_decode($data->odesilateladmin)) : $_POST[$data->zdrojovyemail]));

                if ($this->var->debug_mod && $this->debug_lokal)  //debug mode
                {
                  var_dump($header, $this->PrevodUnikatnihoTextu($data->textemail, array_merge($adminemail, $vystup)));
                }

                //prepis symbolickych promennych, format: @@XX@@
                if (@mail($data->email, $this->OsetreniTextu($data->predmet), $this->PrevodUnikatnihoTextu(htmlspecialchars_decode(html_entity_decode($data->textemail)), array_merge($adminemail, $vystup)), $header))  //odeslani adminovy
                {
                  $em1 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send_true_{$tvar}"]);
                }
                  else
                {
                  $em1 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send_false_{$tvar}"]);
                }

                //oznamovaci email
                if ($data->oznameni && !Empty($data->zdrojovyemail))
                {
                  $header2 = $this->NactiUnikatniObsah($this->unikatni["normal_email_header_{$tvar}"],  //hlavička
                                                      $this->hlavicka,
                                                      htmlspecialchars_decode(html_entity_decode($data->odesilateluzivatel)));

                  $useremail = array ("array_args",
                                      $this->absolutni_url);

                  if ($this->var->debug_mod && $this->debug_lokal)  //debug mode
                  {
                    var_dump($header2, $this->PrevodUnikatnihoTextu($data->textemailoznameni, array_merge($useremail, $vystup)));
                  }

                  //odeslani, format: @@XX@@
                  if (@mail($_POST[$data->zdrojovyemail], $this->OsetreniTextu($data->predmetoznameni), htmlspecialchars_decode(html_entity_decode($this->PrevodUnikatnihoTextu($data->textemailoznameni)), array_merge($useremail, $vystup)), $header2))
                  {
                    $em2 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send2_true_{$tvar}"]);
                  }
                    else
                  {
                    $em2 = $this->NactiUnikatniObsah($this->unikatni["normal_email_send2_false_{$tvar}"]);
                  }
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["normal_email_send_complet_{$tvar}"],
                                                    $em1,
                                                    $em2,
                                                    "{$this->absolutni_url}{$_GET[$this->var->get_kam]}");
              }
                else
              {
                if (count($_POST) > 0 &&
                    !Empty($_POST[$name_tlacitko]))
                {
                  $chyba = "";
                  $chyba_form = "";
                  for ($i = 0; $i < $pocetelem; $i++)
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
                                                      "{$this->absolutni_url}{$_GET[$this->var->get_kam]}");
                }
              } //end fail data
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        } //end while res
      } //num rows
        else
      {
        $result = "";
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
 * Vrati select pro vyber ze vstupu
 *
 * @param id id polozky vstupu, nepovinne
 * @return html select
 */
  private function VyberVstupu($id = NULL, $adresa = NULL)
  {
    $typ = $this->vstupni_typ;

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vstupni_typ_select_begin"], $adresa);
    $c_typ = count($typ);
    for ($i = 0; $i < $c_typ; $i++)
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

    $c_typ = count($typ);
    for ($i = 0; $i < $c_typ; $i++)
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
 * Vrati select pro vyber z formularu
 *
 * @param id id polozky menu, nepovinne
 * @return html select
 */
  private function VyberSekce($id = NULL)
  {
    $result = "";
    if ($res = $this->query("SELECT id, adresa FROM {$this->dbpredpona}formular ORDER BY LOWER(nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        $result = $this->NactiUnikatniObsah($this->unikatni["admin_formular_select_begin"]);
        while ($data = $this->fetchObject($res))
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
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
    if ($res = $this->query("SELECT COUNT(id) as pocet FROM {$this->dbpredpona}prvek WHERE formular={$formular};", $error))
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
 * Vygenerovani ajax scriptu pro web
 *
 */
  public function VygenerujAjaxScript()
  {
    $result = "";
    $cesta = "{$this->dirpath}/{$this->generated[0]}"; //cesta ajaxu
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath);

      $result = $this->ControlWriteFile(array($cesta => $obsah));
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
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addform",
                                        ""//$this->AdminVypisObsahu()
                                        );

//$a = $this->q("SELECT adresa FROM {$this->dbpredpona}sablona");
//var_dump($a->numR()); //$this->numRows($a),

    //$a = new uDB("nastaveni....");
    //var_dump($a->query("redek"));

//$pok = $this->NactiUrl($this->absolutni_url);
//$dom = new DOMDocument($this->absolutni_url);
//$dom->loadHTML();
//$html = file_get_contents($this->absolutni_url);
//var_dump($html);


    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "addform": //pridavani formulare
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addform"],
                                              $this->dirpath,
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $adresa = $this->ChangeWrongChar($_POST["adresa"]);
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $predmet = $this->ChangeWrongChar($_POST["predmet"]);
          $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);  //kontrola emailu
          $textemail = $this->ChangeWrongChar($_POST["textemail"]);
          $dodatek = $this->ChangeWrongChar($_POST["dodatek"]);
          $oznameni = (!Empty($_POST["oznameni"]) ? 1 : 0);
          $predmetoznameni = $this->ChangeWrongChar($_POST["predmetoznameni"]);
          $textemailoznameni = $this->ChangeWrongChar($_POST["textemailoznameni"]);
          $zdrojovyemail = $this->ChangeWrongChar($_POST["zdrojovyemail"]);
          $odesilateladmin = $this->ChangeWrongChar($_POST["odesilateladmin"]); //from
          $odesilateluzivatel = $this->ChangeWrongChar($_POST["odesilateluzivatel"]); //from
          $from = ($_POST["odesilatel"] == "true" ? $odesilateladmin : $zdrojovyemail);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($predmet) &&
              !Empty($email) &&
              !Empty($textemail) &&
              !Empty($from) &&
              ($oznameni ? (!Empty($odesilateluzivatel) ? true : false) : true))
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}formular (id, adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel) VALUES
                                  (NULL, '{$adresa}', '{$nazev}', '{$predmet}', '{$email}', '{$textemail}', '{$dodatek}', {$oznameni}, '{$predmetoznameni}', '{$textemailoznameni}', '{$zdrojovyemail}', '{$odesilateladmin}', '{$odesilateluzivatel}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addform_hlaska"], $adresa);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editform":  //editace formulare
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel FROM {$this->dbpredpona}formular WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editform"],
                                                  $this->dirpath,
                                                  $data->adresa,
                                                  $data->nazev,
                                                  $data->predmet,
                                                  (!Empty($data->odesilateladmin) ? " checked=\"checked\"" : ""),
                                                  $data->odesilateladmin,
                                                  (!Empty($data->zdrojovyemail) ? " checked=\"checked\"" : ""),
                                                  $data->zdrojovyemail,
                                                  $data->email,
                                                  $data->textemail,
                                                  $data->dodatek,
                                                  ($data->oznameni ? " checked=\"checked\"" : ""),
                                                  $data->predmetoznameni,
                                                  $data->odesilateluzivatel,
                                                  $data->textemailoznameni,
                                                  (Empty($data->odesilateladmin) ? "CheckOdeslatelFlexible();" : "CheckOdeslatelSolid();"),
                                                  ($data->oznameni ? "CheckOznameni(true);" : "CheckOznameni(false);"),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $adresa = $this->ChangeWrongChar($_POST["adresa"]);
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $predmet = $this->ChangeWrongChar($_POST["predmet"]);
              $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", $_POST["email"]);  //kontrola emailu
              $textemail = $this->ChangeWrongChar($_POST["textemail"]);
              $dodatek = $this->ChangeWrongChar($_POST["dodatek"]);
              $oznameni = (!Empty($_POST["oznameni"]) ? 1 : 0);
              $predmetoznameni = $this->ChangeWrongChar($_POST["predmetoznameni"]);
              $textemailoznameni = $this->ChangeWrongChar($_POST["textemailoznameni"]);
              $zdrojovyemail = $this->ChangeWrongChar($_POST["zdrojovyemail"]);
              $odesilateladmin = $this->ChangeWrongChar($_POST["odesilateladmin"]);
              $odesilateluzivatel = $this->ChangeWrongChar($_POST["odesilateluzivatel"]);
              $from = ($_POST["odesilatel"] == "true" ? $odesilateladmin : $zdrojovyemail);

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($adresa) &&
                  !Empty($predmet) &&
                  !Empty($email) &&
                  !Empty($textemail) &&
                  !Empty($from) &&
                  ($oznameni ? (!Empty($odesilateluzivatel) ? true : false) : true) &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}formular SET adresa='{$adresa}',
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
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editform_hlaska"], $adresa);

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

        case "delform": //mazani formulare
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT adresa FROM {$this->dbpredpona}formular WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}formular WHERE id={$id};
                                    DELETE FROM {$this->dbpredpona}prvek WHERE formular={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delform_hlaska"], $data->adresa);

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

        case "addelem": //pridavani elementu
          $form = $_GET["form"];  //cislo formulare
          settype($form, "integer");

          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstupni_typ"];
          settype($vstup, "integer");

          $jmeno_typu = array_keys($this->input);
          $aktualni_typ = $jmeno_typu[$type];

          $zobr_nazev = ($aktualni_typ == "text" ||
                        $aktualni_typ == "radio" ||
                        $aktualni_typ == "datumcas");
          $zobr_value = ($aktualni_typ == "text" ||
                        $aktualni_typ == "checkbox" ||
                        $aktualni_typ == "radio" ||
                        $aktualni_typ == "datumcas" ||
                        $aktualni_typ == "file");
          $zobr_disabled = ($aktualni_typ == "text" ||
                            $aktualni_typ == "checkbox" ||
                            $aktualni_typ == "radio"||
                            $aktualni_typ == "file");
          $zobr_vstup = ($aktualni_typ == "text");
          $zobr_captcha = ($aktualni_typ == "captcha");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem"],
                                              $this->VyberSekce($form),
                                              $this->VyberTypu($type, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;form={$form}&amp;vstup={$vstup}"),
                                              ($zobr_nazev ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_nazev"], "") : ""),
                                              ($zobr_value ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_value"], "") : ""),
                                              ($zobr_captcha ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_captcha"], "") : ""),
                                              ($zobr_vstup ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_readonly"], "") : ""),
                                              ($zobr_disabled ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_disabled"], "") : ""),
                                              ($zobr_vstup ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_vstupni_typ"], $this->VyberVstupu($vstup, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=addelem&amp;form={$form}&amp;typ={$type}")) : ""),
                                              ($zobr_vstup && $vstup == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_reg_exp"], "") : ""),
                                              ($zobr_vstup && $vstup >= 0 && $vstup <= 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_minmax_val"], 0, 0) : ""),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $formular = $_POST["formular"];
          settype($formular, "integer");
          $typ = $_POST["typ"];
          settype($typ, "integer");
          $nazev = $this->ChangeWrongChar($_POST["nazev"]);
          $value = $this->ChangeWrongChar($_POST["value"]);
          $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
          $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
          $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
          $vstupni_typ = $_POST["vstupni_typ"];
          settype($vstupni_typ, "integer");
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : $this->ChangeWrongChar($_POST["reg_exp"], false));
          $min_val = $_POST["min_val"];
          settype($min_val, "integer");
          $max_val = $_POST["max_val"];
          settype($max_val, "integer");
          $poradi = $this->PocetRadku($form, 1);  //jen u add

          if (!Empty($_POST["tlacitko"]) &&
              $formular > 0)
          {
            if ($this->queryExec("INSERT INTO {$this->dbpredpona}prvek (id, formular, nazev, typ, value, readonly, disabled, povinne, reg_exp, vstupni_typ, min_val, max_val, poradi) VALUES
                                  (NULL, {$formular}, '{$nazev}', {$typ}, '{$value}', {$readonly}, {$disabled}, {$povinne}, '{$reg_exp}', {$vstupni_typ}, {$min_val}, {$max_val}, {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_addelem_hlaska"], $nazev);

              $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
              else
            {
              $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "editelem":  //editace elementu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          $type = $_GET["typ"];
          settype($type, "integer");
          $vstup = $_GET["vstupni_typ"];
          settype($vstup, "integer");

          if ($res = $this->query("SELECT id, formular, nazev, typ, value, readonly, disabled, povinne, reg_exp, vstupni_typ, min_val, max_val FROM {$this->dbpredpona}prvek WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              $type_1 = (isset($_GET["typ"]) ? $type : $data->typ);
              $vstup_1 = (isset($_GET["vstupni_typ"]) ? $vstup : $data->vstupni_typ);

              $jmeno_typu = array_keys($this->input);
              $aktualni_typ = $jmeno_typu[$type_1];

              $zobr_nazev = ($aktualni_typ == "text" ||
                            $aktualni_typ == "radio" ||
                            $aktualni_typ == "datumcas");
              $zobr_value = ($aktualni_typ == "text" ||
                            $aktualni_typ == "checkbox" ||
                            $aktualni_typ == "radio" ||
                            $aktualni_typ == "datumcas" ||
                            $aktualni_typ == "file");
              $zobr_disabled = ($aktualni_typ == "text" ||
                                $aktualni_typ == "checkbox" ||
                                $aktualni_typ == "radio"||
                                $aktualni_typ == "file");

              $zobr_vstup = ($aktualni_typ == "text");
              $zobr_captcha = ($aktualni_typ == "captcha");

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem"],
                                                  $this->VyberSekce($data->formular),
                                                  $this->VyberTypu($type_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;vstup={$vstup_1}&amp;id={$id}"),
                                                  ($zobr_nazev ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_nazev"], $data->nazev) : ""),
                                                  ($zobr_value ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_value"], $data->value) : ""),
                                                  ($zobr_captcha ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_captcha"], $data->value) : ""),
                                                  ($zobr_vstup ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_readonly"], ($data->readonly ? " checked=\"checked\"" : "")) : ""),
                                                  ($zobr_disabled ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_disabled"], ($data->disabled ? " checked=\"checked\"" : "")) : ""),
                                                  ($data->povinne ? " checked=\"checked\"" : ""),
                                                  ($zobr_vstup ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_vstupni_typ"], $this->VyberVstupu($vstup_1, "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;typ={$type_1}&amp;id={$id}")) : ""),
                                                  ($zobr_vstup && $vstup_1 == 2 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_reg_exp"], $data->reg_exp) : ""),
                                                  ($zobr_vstup && $vstup_1 >= 0 && $vstup_1 <= 1 ? $this->NactiUnikatniObsah($this->unikatni["admin_addedit_elem_minmax_val"], $data->min_val, $data->max_val) : ""),
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $formular = $_POST["formular"];
              settype($formular, "integer");
              $typ = $_POST["typ"];
              settype($typ, "integer");
              $nazev = $this->ChangeWrongChar($_POST["nazev"]);
              $value = $this->ChangeWrongChar($_POST["value"]);
              $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
              $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $vstupni_typ = $_POST["vstupni_typ"];
              settype($vstupni_typ, "integer");
              $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : $this->ChangeWrongChar($_POST["reg_exp"], false));
              $min_val = $_POST["min_val"];
              settype($min_val, "integer");
              $max_val = $_POST["max_val"];
              settype($max_val, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($formular) &&
                  $id != 0)
              {
                if ($this->queryExec("UPDATE {$this->dbpredpona}prvek SET formular={$formular},
                                                                          nazev='{$nazev}',
                                                                          typ={$typ},
                                                                          value='{$value}{$src}',
                                                                          readonly={$readonly},
                                                                          disabled={$disabled},
                                                                          povinne={$povinne},
                                                                          reg_exp='{$reg_exp}',
                                                                          vstupni_typ={$vstupni_typ},
                                                                          min_val={$min_val},
                                                                          max_val={$max_val}
                                                                          WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_editelem_hlaska"], $nazev);

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

        case "delelem": //mazani elementu
          $id = $_GET["id"];  //cislo sekce
          settype($id, "integer");

          if ($res = $this->query("SELECT nazev FROM {$this->dbpredpona}prvek WHERE id={$id};", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              if ($this->queryExec("DELETE FROM {$this->dbpredpona}prvek WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_delelem_hlaska"], $data->nazev);

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

        case "delfile": //smazani souboru
          $file = $_GET["file"];

          if (!Empty($file) &&
              unlink("{$this->dirpath}/{$this->pathfile}/{$file}"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_delfile_hlaska"], $file);

            $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}{$this->idsoubory}");  //auto kliknuti
          }
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
    return strtr($text, $this->unikatni["set_prevod"]);  //prevede text dle prevadecoho pole
  }

/**
 *
 * Vypis administrace obsahu
 *
 * @return vypis obsahu v html
 */
  private function AdminVypisObsahu()
  {
    $typ = array_keys($this->input);

    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin"],
                                        $this->absolutni_url,
                                        $this->dirpath);
    //vypis formulare
    if ($res = $this->query("SELECT id, adresa, nazev, predmet, email, textemail FROM {$this->dbpredpona}formular ORDER BY LOWER(nazev) ASC;", $error))
    {
      if ($this->numRows($res) != 0)
      {
        while ($data = $this->fetchObject($res))
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
          if ($res1 = $this->query("SELECT id, nazev, typ,
                                    value, poradi, povinne
                                    FROM {$this->dbpredpona}prvek
                                    WHERE formular={$data->id}
                                    ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res1) != 0)
            {
              while ($data1 = $this->fetchObject($res1))
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_elem"],
                                                    $data1->nazev,
                                                    $data1->id,
                                                    $typ[$data1->typ],
                                                    $data1->value,
                                                    $data1->poradi,
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=editelem&amp;id={$data1->id}",
                                                    "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delelem&amp;id={$data1->id}",
                                                    ($data1->povinne ? " checked=\"checked\"" : ""));
              }
            }
          }
            else
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_end_form"]);
        }
      }
    }
      else
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    $result .= $this->unikatni["admin_vypis_obsah_end"];

    return $result;
  }

/**
 *
 * Vypis souboru z formulare
 *
 * @return vypis souboru
 */
  private function AdminObsahSouboru()
  {
    $result = $this->unikatni["admin_obsah_souboru_begin"];
    $res = $this->VypisSouboru("{$this->dirpath}/{$this->pathfile}", array("date", "asc"));
    if (!is_null($res))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_obsah_souboru"],
                                            "{$this->dirpath}/{$this->pathfile}/{$data}",
                                            $data,
                                            date($this->unikatni["tvar_datum_vypis_souboru"], filemtime("{$this->dirpath}/{$this->pathfile}/{$data}")),
                                            "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=delfile&amp;file={$data}");
      }
    }
      else
    {
      $result .= $this->unikatni["admin_obsah_souboru_null"];
    }
    $result .= $this->unikatni["admin_obsah_souboru_end"];

    return $result;
  }


}
?>
