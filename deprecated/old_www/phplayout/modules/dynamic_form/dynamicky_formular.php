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
  private $var, $sqlite, $dbname, $dirpath, $debug_lokal, $absolutni_url, $captchakod, $unikatni;
  public $idmodul = "dynform";
  private $znakpovinne = "\n          <span>*</span>"; //povinne
  private $hlavicka = "Content-type: text/html; charset=UTF-8";

  private $input = array ("text"     => "textové pole",  //Xx - nazev, value

                          "checkbox" => "zaškrkávací políčko",  //Xx - nazev, checked

                          "submit"   => "odesílací tlačítko - 1x", //1x - value
                          "reset"    => "resetovací tlačítko - 1x",  //1x - value

                          "captcha"  => "captcha kod - 1x",  //1x - ?
                          );

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

    $this->znakpovinne = $this->NactiUnikatniObsah($this->unikatni["set_znakpovinne"]);
    $this->input = $this->NactiUnikatniObsah($this->unikatni["set_input"]);
    $this->hlavicka = $this->NactiUnikatniObsah($this->unikatni["set_hlavicka"]);

    if (!$this->sqlite = @new SQLiteDatabase("{$this->dirpath}/{$this->dbname}", 0777, $error))
    {
      $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
                                      value VARCHAR(200),
                                      readonly BOOL,
                                      disabled BOOL,
                                      povinne BOOL,
                                      reg_exp VARCHAR(500),
                                      vstupni_typ INTEGER UNSIGNED,
                                      min_val INTEGER UNSIGNED,
                                      max_val INTEGER UNSIGNED,
                                      poradi INTEGER UNSIGNED);
                                      ", $error))
      {
        $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
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
 * @param idcaptcha cislo id captcha kodu
 * @param captcha polo formular captcha
 * @param slovo vysledne slovo captcha
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

    //vypis formulare
    $result = "";
    $name_tlacitko = "";
    if ($res = @$this->sqlite->query("SELECT id, adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel FROM formular WHERE adresa='{$adresa}';", NULL, $error))
    {
      $poc_prvku = $res->numRows();
      if ($res->numRows() == 1)
      {
        while ($data = $res->fetchObject())
        {
          //vypis prvku
          if ($res1 = @$this->sqlite->query("SELECT
                                            id,
                                            formular,
                                            nazev,
                                            typ,
                                            value,
                                            readonly,
                                            disabled,
                                            povinne,
                                            reg_exp,
                                            vstupni_typ,
                                            min_val,
                                            max_val,
                                            poradi
                                            FROM prvek
                                            WHERE prvek.formular={$data->id}
                                            ORDER BY poradi ASC;", NULL, $error))
          {
            $pocetelem = $res1->numRows();
            if ($res1->numRows() != 0)
            {
              $i = 0;
              $vypis = array("array_args",
                            $this->absolutni_url,
                            $this->dirpath);

              while ($data1 = $res1->fetchObject())
              {
                $podminka[$i]["id"] = $data1->id;
                $podminka[$i]["name"] = "elem_{$data1->id}"; //jmeno elementu
                $podminka[$i]["nazev"] = $data1->nazev; //popis elementu
                $podminka[$i]["blok"] = $data1->value; //jmeno elementu
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
                    $vypis[] = $data1->id;
                    $vypis[] = " name=\"elem_{$data1->id}\""; //zvazit ajax konrolu!
                    $vypis[] = $data1->nazev;
                    $vypis[] = (!Empty($_POST["elem_{$data1->id}"]) ? $_POST["elem_{$data1->id}"] : $data1->value); //pri chybnem vyplneni, funkce jen na oko
                    $podminka[$i]["chyba_form"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_hidden_{$tvar}"], $data1->id, $_POST["elem_{$data1->id}"]);
                    //$vypis[] = " onfocus=\"if(this.value == '{$data1->value}'){this.value='';}\" onblur=\"if(this.value == ''){this.value='{$data1->value}';}\"";
                    $vypis[] = " onfocus=\"this.value=(this.value == '{$data1->value}' ? '' : this.value);\" onblur=\"this.value=(this.value == '' ? '{$data1->value}' : this.value);\"";
                    $vypis[] = ($data1->readonly ? " readonly=\"readonly\"" : "");
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($data1->povinne ? $this->znakpovinne : "");
                  break;

                  case "checkbox":  //pro checkbox
                    $vypis[] = $data1->id;
                    $vypis[] = " name=\"elem_{$data1->id}\"";
                    $vypis[] = $data1->nazev;
                    //$vypis[] = $data1->value; //je tu jako skupina
                    //$vypis[] = " onfocus=\"if(this.value == '{$data1->value}'){this.value='';}\" onblur=\"if(this.value == ''){this.value='{$data1->value}';}\"";
                    //$vypis[] = " onfocus=\"this.value=(this.value == '{$data1->value}' ? '' : '');\" onblur=\"this.value=(this.value == '' ? '{$data1->value}' : '');\"";
                    //$vypis[] = ($data1->readonly ? " readonly=\"readonly\"" : "");
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($data1->povinne ? $this->znakpovinne : "");
                  break;

                  case "submit":  //pro submit - watafak?
                    $vypis[] = $data1->id;
                    $vypis[] = " name=\"elem_{$data1->id}\"";
                    //$vypis[] = $data1->nazev;
                    $vypis[] = $data1->value;
                    //$vypis[] = " onfocus=\"if(this.value == '{$data1->value}'){this.value='';}\" onblur=\"if(this.value == ''){this.value='{$data1->value}';}\"";
                    //$vypis[] = " onfocus=\"this.value=(this.value == '{$data1->value}' ? '' : '');\" onblur=\"this.value=(this.value == '' ? '{$data1->value}' : '');\"";
                    //$vypis[] = ($data1->readonly ? " readonly=\"readonly\"" : "");   >> !Empty($_POST["elem_{$data1->id}"])    $captcha_kod == $_SESSION["slovo_{$this->captchakod[$adresa]["id"]}_vysledek"]
                    $vypis[] = ($data1->disabled || !Empty($_POST["elem_{$data1->id}"]) ? " disabled=\"disabled\"" : "");  //osetreni do zadani spravneho captcha kodu
                    $vypis[] = ($data1->disabled || !Empty($_POST["elem_{$data1->id}"]) ? "_disabled" : "");
                    $vypis[] = ($data1->povinne ? $this->znakpovinne : "");
                    $name_tlacitko = "elem_{$data1->id}";
                  break;

                  case "reset":  //pro reset
                    $vypis[] = $data1->id;
                    $vypis[] = " name=\"elem_{$data1->id}\"";
                    //$vypis[] = $data1->nazev;
                    $vypis[] = $data1->value;
                    //$vypis[] = " onfocus=\"if(this.value == '{$data1->value}'){this.value='';}\" onblur=\"if(this.value == ''){this.value='{$data1->value}';}\"";
                    //$vypis[] = " onfocus=\"this.value=(this.value == '{$data1->value}' ? '' : '');\" onblur=\"this.value=(this.value == '' ? '{$data1->value}' : '');\"";
                    //$vypis[] = ($data1->readonly ? " readonly=\"readonly\"" : "");
                    $vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = ($data1->povinne ? $this->znakpovinne : "");
                  break;

                  case "captcha":  //pro captcha
                    $vypis[] = $data1->id;
                    $vypis[] = " name=\"elem_{$data1->id}\"";

                    //sam si nacte captchu
                    $slovo = $this->var->main[0]->NactiFunkci("CaptchaCode", "GenerujNahodneSlovo", $data1->value); //pro id 1
                    $captcha = $this->var->main[0]->NactiFunkci("CaptchaCode", "CaptchaKod", $data1->value, $slovo);  //pro id 1 se slovem

                    $slovo = (is_array($slovo) ? $slovo[1] : $slovo);

                    $this->captchakod[$adresa]["id"] = $data1->value;
                    $this->captchakod[$adresa]["captcha"] = $captcha;
                    $this->captchakod[$adresa]["slovo"] = $slovo;
                    //$vypis[] = $data1->nazev;
                    //$vypis[] = $data1->value;
                    //$vypis[] = " onfocus=\"if(this.value == '{$data1->value}'){this.value='';}\" onblur=\"if(this.value == ''){this.value='{$data1->value}';}\"";
                    //$vypis[] = " onfocus=\"this.value=(this.value == '{$data1->value}' ? '' : '');\" onblur=\"this.value=(this.value == '' ? '{$data1->value}' : '');\"";
                    //$vypis[] = ($data1->readonly ? " readonly=\"readonly\"" : "");
                    //$vypis[] = ($data1->disabled ? " disabled=\"disabled\"" : "");
                    $vypis[] = $data1->value; //id
                    $vypis[] = $captcha;
                    $vypis[] = $slovo;
                    //$captcha_kod = $_POST["elem_{$data1->id}"];
                    $vypis[] = ($data1->povinne ? $this->znakpovinne : "");
                  break;
                }

                $i++;
              } //end while res1

              $vypis[] = $data->dodatek;

              $result .= $this->NactiUnikatniObsah($this->unikatni["normal_vypis_form_{$tvar}"], $vypis);

              $poc = 0;
              $check = true;
              $vystup = "";
              for ($i = 0; $i < $pocetelem; $i++) //kontrola vyplneni a spravnosti dat
              {
                //$zpost = $_POST[$podminka[$i]["name"]]; //vezme si hodnotu z postu podle nazvu elementu
                $zpost = stripslashes(htmlspecialchars($_POST[$podminka[$i]["name"]], ENT_QUOTES)); //prevadat i pro kontrolu!

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

                  case "captcha": //kontrola captcha kodu
                    $pridavek = (is_array($_SESSION["slovo_{$this->captchakod[$sablona]["id"]}"]) ? "_solve" : "");

                    if (count($_POST) == 0 || $zpost != $_SESSION["slovo_{$this->captchakod[$adresa]["id"]}{$pridavek}_vysledek"])
                    {
                      $_SESSION["slovo_{$this->captchakod[$adresa]["id"]}{$pridavek}_vysledek"] = $_SESSION["slovo_{$this->captchakod[$adresa]["id"]}{$pridavek}"];
                    }

                    if (Empty($zpost) && $podminka[$i]["povinne"])
                    {
                      $check = false;
                      $podminka[$i]["chyba"] = $this->NactiUnikatniObsah($this->unikatni["normal_error_empty_captcha_{$tvar}"]);  //prazdna
                    }
                      else
                    {
                      if ($zpost == $_SESSION["slovo_{$this->captchakod[$adresa]["id"]}{$pridavek}_vysledek"])  //turinguv stroj rozliseni cloveka
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

                  $useremail = array("array_args",
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
    if ($res = @$this->sqlite->query("SELECT COUNT(id) as pocet FROM prvek WHERE formular={$formular};", NULL, $error))
    {
      if ($res->numRows() == 1)
      {
        $result = $res->fetchObject()->pocet + $inc;
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
    $cesta = "{$this->dirpath}/ajax.js";
    if (!file_exists($cesta))
    {
      $obsah = $this->NactiUnikatniObsah($this->unikatni["ajaxscript"],
                                        $this->absolutni_url,
                                        $this->dirpath);
      $u = fopen($cesta, "w");
      fwrite($u, $obsah);
      fclose($u);

      var_dump("vytvořeno: {$cesta}");
    }
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
                                        "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=test_rv",
                                        $this->AdminVypisForm());

    $this->VygenerujAjaxScript(); //vygenerovani scriptu

    $co = $_GET["co"];

    if (!Empty($co))
    {
      switch ($co)
      {
        case "test_rv":
          $vstup = stripslashes(htmlspecialchars($_POST["vstup"], ENT_QUOTES));
          //prepinani podle webu/lokalu
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));

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

        case "addform": //pridavani formulare
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_form"],
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

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
          $odesilateladmin = stripslashes(htmlspecialchars($_POST["odesilateladmin"], ENT_QUOTES)); //from
          $odesilateluzivatel = stripslashes(htmlspecialchars($_POST["odesilateluzivatel"], ENT_QUOTES)); //from
          $from = ($_POST["odesilatel"] == "true" ? $odesilateladmin : $zdrojovyemail);

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($adresa) &&
              !Empty($predmet) &&
              !Empty($email) &&
              !Empty($textemail) &&
              !Empty($from) &&
              ($oznameni ? (!Empty($odesilateluzivatel) ? true : false) : true))
          {
            if (@$this->sqlite->queryExec("INSERT INTO formular (id, adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel) VALUES
                                          (NULL, '{$adresa}', '{$nazev}', '{$predmet}', '{$email}', '{$textemail}', '{$dodatek}', {$oznameni}, '{$predmetoznameni}', '{$textemailoznameni}', '{$zdrojovyemail}', '{$odesilateladmin}', '{$odesilateluzivatel}');", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_form_hlaska"], $adresa);

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

          if ($res = @$this->sqlite->query("SELECT adresa, nazev, predmet, email, textemail, dodatek, oznameni, predmetoznameni, textemailoznameni, zdrojovyemail, odesilateladmin, odesilateluzivatel FROM formular WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_form"],
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

          if ($res = @$this->sqlite->query("SELECT adresa FROM formular WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec ("DELETE FROM formular WHERE id={$id};
                                              DELETE FROM prvek WHERE formular={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_form_hlaska"], $data->adresa);

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

          //$num_input = array_values($this->input);  //navrat dane hodnoty radku

          $jmeno_typu = array_keys($this->input);
          $aktualni_typ = $jmeno_typu[$type];

          $zobr_nazev = ($aktualni_typ == "text" || $aktualni_typ == "checkbox" || $aktualni_typ == "radio");
          $zobr_value = ($aktualni_typ == "text" || $aktualni_typ == "submit" || $aktualni_typ == "reset");
          $zobr_disabled = ($aktualni_typ == "text"|| $aktualni_typ == "checkbox" || $aktualni_typ == "radio" || $aktualni_typ == "submit" || $aktualni_typ == "reset");
          $zobr_vstup = ($aktualni_typ == "text");
          $zobr_captcha = ($aktualni_typ == "captcha");

          $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_elem"],
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
                                              $this->PocetRadku($form, 1),
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          $formular = stripslashes(htmlspecialchars($_POST["formular"], ENT_QUOTES));
          settype($formular, "integer");
          $typ = stripslashes(htmlspecialchars($_POST["typ"], ENT_QUOTES));
          settype($typ, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
          $value = stripslashes(htmlspecialchars($_POST["value"], ENT_QUOTES));
          $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
          $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
          $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
          $vstupni_typ = stripslashes(htmlspecialchars($_POST["vstupni_typ"], ENT_QUOTES));
          settype($vstupni_typ, "integer");
          $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));
          $min_val = stripslashes(htmlspecialchars($_POST["min_val"], ENT_QUOTES));
          settype($min_val, "integer");
          $max_val = stripslashes(htmlspecialchars($_POST["max_val"], ENT_QUOTES));
          settype($max_val, "integer");
          $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
          settype($poradi, "integer");

          if (!Empty($_POST["tlacitko"]) &&
              !Empty($formular) &&
              !Empty($poradi) &&
              $poradi > 0)
          {
            if (@$this->sqlite->queryExec("INSERT INTO prvek (id, formular, nazev, typ, value, readonly, disabled, povinne, reg_exp, vstupni_typ, min_val, max_val, poradi) VALUES
                                          (NULL, {$formular}, '{$nazev}', {$typ}, '{$value}', {$readonly}, {$disabled}, {$povinne}, '{$reg_exp}', {$vstupni_typ}, {$min_val}, {$max_val}, {$poradi});", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["admin_add_elem_hlaska"], $nazev);

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

          if ($res = @$this->sqlite->query("SELECT id, formular, nazev, typ, value, readonly, disabled, povinne, reg_exp, vstupni_typ, min_val, max_val, poradi FROM prvek WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              $type_1 = (isset($_GET["typ"]) ? $type : $data->typ);
              $vstup_1 = (isset($_GET["vstupni_typ"]) ? $vstup : $data->vstupni_typ);

              $jmeno_typu = array_keys($this->input);
              $aktualni_typ = $jmeno_typu[$type_1];

              $zobr_nazev = ($aktualni_typ == "text" || $aktualni_typ == "checkbox" || $aktualni_typ == "radio");
              $zobr_value = ($aktualni_typ == "text" || $aktualni_typ == "submit" || $aktualni_typ == "reset");
              $zobr_disabled = ($aktualni_typ == "text"|| $aktualni_typ == "checkbox" || $aktualni_typ == "radio" || $aktualni_typ == "submit" || $aktualni_typ == "reset");
              $zobr_vstup = ($aktualni_typ == "text");
              $zobr_captcha = ($aktualni_typ == "captcha");

              $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem"],
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
                                                  $data->poradi,
                                                  "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

              $formular = stripslashes(htmlspecialchars($_POST["formular"], ENT_QUOTES));
              settype($formular, "integer");
              $typ = stripslashes(htmlspecialchars($_POST["typ"], ENT_QUOTES));
              settype($typ, "integer");
              $nazev = stripslashes(htmlspecialchars($_POST["nazev"], ENT_QUOTES));
              $value = stripslashes(htmlspecialchars($_POST["value"], ENT_QUOTES));
              $readonly = (!Empty($_POST["readonly"]) ? 1 : 0);
              $disabled = (!Empty($_POST["disabled"]) ? 1 : 0);
              $povinne = (!Empty($_POST["povinne"]) ? 1 : 0);
              $vstupni_typ = stripslashes(htmlspecialchars($_POST["vstupni_typ"], ENT_QUOTES));
              settype($vstupni_typ, "integer");
              $reg_exp = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? $_POST["reg_exp"] : stripslashes(htmlspecialchars($_POST["reg_exp"], ENT_QUOTES)));
              $min_val = stripslashes(htmlspecialchars($_POST["min_val"], ENT_QUOTES));
              settype($min_val, "integer");
              $max_val = stripslashes(htmlspecialchars($_POST["max_val"], ENT_QUOTES));
              settype($max_val, "integer");
              $poradi = stripslashes(htmlspecialchars($_POST["poradi"], ENT_QUOTES));
              settype($poradi, "integer");

              if (!Empty($_POST["tlacitko"]) &&
                  !Empty($formular) &&
                  !Empty($poradi) &&
                  $poradi > 0 &&
                  $id != 0)
              {
                if (@$this->sqlite->queryExec("UPDATE prvek SET formular={$formular},
                                                                nazev='{$nazev}',
                                                                typ={$typ},
                                                                value='{$value}{$src}',
                                                                readonly={$readonly},
                                                                disabled={$disabled},
                                                                povinne={$povinne},
                                                                reg_exp='{$reg_exp}',
                                                                vstupni_typ={$vstupni_typ},
                                                                min_val={$min_val},
                                                                max_val={$max_val},
                                                                poradi={$poradi}
                                                                WHERE id={$id};", $error))
                {
                  $result = $this->NactiUnikatniObsah($this->unikatni["admin_edit_elem_hlaska"],
                                                      $nazev);

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

          if ($res = @$this->sqlite->query("SELECT nazev FROM prvek WHERE id={$id};", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();

              if (@$this->sqlite->queryExec("DELETE FROM prvek WHERE id={$id};", $error)) //provedeni dotazu
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["admin_del_elem_hlaska"],
                                                    $data->nazev);

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
                                            value, poradi, povinne
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

    return $result;
  }
}
?>
