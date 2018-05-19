<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $dbname, $var, $get_id, $get_sablona, $get_text, $dbpredpona;
// $dirpath,
/**
 *
 * konstuktor ajaxu stranky s tiskem
 *
 * @return tisk vysledku dane funkce
 */
  public function __construct()
  {
    $this->var = new Promenne();  //vytvoreni promennych
    $this->var->main = new Funkce($this->var, 0);  //vytvoreni funkce

    $this->unikatni = $this->NactiObsahSouboru(".unikatni_obsah.php");
    $this->get_id = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_id"]);
    $this->get_sablona = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_sablona"]);
    $this->get_text = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_text"]);

    echo $this->VyberFunkci();
  }

/**
 *
 * vybere provadenou akci ajaxu pres dane parmetry
 *
 * @return dana akce
 */
  private function VyberFunkci()  //vybere volanou funkci
  {
    //$action = (!Empty($_POST["action"]) ? $_POST["action"] : $_GET["action"]);
    //$web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
    //print_r($_GET);
    //print_r($_POST);
    //print_r($_SERVER);
    //print_r($_SESSION);

    $result = "";

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        case "kontrola": //post - kontrola typu
          $id = $_POST[$this->get_id];
          settype($id, "integer");
          $sablona = $_POST[$this->get_sablona];
          settype($sablona, "integer");
          $text = $_POST[$this->get_text];

          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dbname}");
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          //$this->sqlite = new SQLiteDatabase($this->dbname, 0777, $error);  //pripojeni do DB
//var_dump($index, $this->dbname, $this->sqlite, $error);
          if ($res = @$this->query("SELECT
                                    vstupni_typ, reg_exp, min_val, max_val
                                    FROM {$this->dbpredpona}gui_element
                                    WHERE id={$id}
                                    ORDER BY poradi ASC;", $error))
          {
            if ($this->numRows($res) == 1)
            {
              $data = $this->fetchObject($res);

              switch ($data->vstupni_typ)
              {
                case 0: //text
                  settype($text, "string");

                  if ($data->min_val > 0 && //kontrola rozsahu poctu pismen
                      $data->max_val > 0)
                  {
                    if (strlen($text) < $data->min_val ||
                        strlen($text) > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->min_val > 0)  //kontrola minina
                  {
                    if (strlen($text) < $data->min_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->max_val > 0)  //kontrola maxima
                  {
                    if (strlen($text) > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                break;

                case 1: //integer
                  settype($text, "integer");

                  if ($data->min_val > 0 &&
                      $data->max_val > 0)
                  {
                    if ($text < $data->min_val ||  //kontrola hodnoty cisel
                        $text > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->min_val > 0)  //kontrola minina
                  {
                    if ($text < $data->min_val)
                    {
                      $text = "";
                    }
                  }
                    else
                  if ($data->max_val > 0)  //kontrola maxima
                  {
                    if ($text > $data->max_val)
                    {
                      $text = "";
                    }
                  }
                break;

                case 2: //reg_exp
                  preg_match($data->reg_exp, $text, $ret);
                  $text = $ret[0];  //vybere nulty index
                break;
              }

              if (!Empty($text))  //kontrola prazdnosti
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["ajax_dobre"]);
              }
                else
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["ajax_spatne"]);
              }
            }
          }
            else
          {
            var_dump($error);
          }
        break;

        case "porovnani": //post - kontrola stejnosti
          $text1 = $_POST["text1"];
          $text2 = $_POST["text2"];

          $result = ($text1 == $text2 ? $this->NactiUnikatniObsah($this->unikatni["ajax_porovnani_true"]) :
                                        $this->NactiUnikatniObsah($this->unikatni["ajax_porovnani_false"]));
        break;

        case "email": //post - kontrola emailu
          $email = $_POST["email"];

          $result = ($this->var->main->KontrolaEmailu($email) == $email ? $this->NactiUnikatniObsah($this->unikatni["ajax_porovnani_true"]) :
                                                                          $this->NactiUnikatniObsah($this->unikatni["ajax_porovnani_false"]));
        break;

        case "duplicita": //kontrola duplicity jmena
          $login = $_POST["login"];

          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dbname}");
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          if ($res = @$this->query("SELECT id FROM {$this->dbpredpona}uzivatele WHERE login='{$login}';", $error))
          {
            $result = ($this->numRows($res) != 0 ? $this->NactiUnikatniObsah($this->unikatni["ajax_duplicita_true"]) :
                                                  $this->NactiUnikatniObsah($this->unikatni["ajax_duplicita_false"]));
          }
            else
          {
            var_dump($error);
          }
        break;

        case "getzeme": //zjisteni zeme
          $ip = $_POST["ip"]; //nacteni IP adresy
          $tvar = $_POST["tvar"]; //nacte cislo tvaru

          if (!in_array($ip, $this->var->ipblok)) //kontrola localhostu
          {
            include("geoip.inc");
            $handle = geoip_open("GeoIP.dat", GEOIP_MEMORY_CACHE);  //GEOIP_STANDARD
            $zeme = geoip_country_name_by_addr($handle, $ip);
            geoip_close($handle);

            if (Empty($zeme)) //kdyz nenajde
            {
              $zeme = $this->NactiUnikatniObsah($this->unikatni["ajax_zeme_notfound_{$tvar}"]);
            }
          }
            else
          { //kdyz se testuje na lokalu
            $zeme = $this->NactiUnikatniObsah($this->unikatni["ajax_zeme_local_{$tvar}"]);
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_get_zeme_{$tvar}"], $ip, $zeme);
        break;

        case "updateRecordsListings": //zmena poradi elementu
          $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
          $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

          //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
          $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dbname}");
          if (!$this->PripojeniDatabaze($error))
          {
            $this->var->main[0]->ErrorMsg($error, array(__LINE__, __METHOD__));
          }

          $update_poradi = $_POST["recordsArray"]; //vrati nove poradi ID

          for ($i = 0; $i < count($update_poradi); $i++)
          {
            $poc = $i + 1;  //predpocitani poradi od 1
            if (!$this->queryExec("UPDATE {$this->dbpredpona}gui_element SET poradi={$poc}
                                  WHERE id={$update_poradi[$i]};", $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_records_listings"]);
        break;

        case "gethostname":  //zjsteni hostname podle ip
          $result = gethostbyaddr($_POST["ip"]);
        break;

        case "getloginhistory": //vypise logy posledniho prihlaseni daneho uzivatele
          $id = $_POST["id"];
          settype($text, "integer");
          $tvar = $_POST["tvar"]; //nacte cislo tvaru

          if ($id > 0 &&
              $_POST["prava"] == "false")
          {
            $script = explode("/", dirname($_SERVER["SCRIPT_NAME"])); //vezme si cestu sama sebe a vyhleda svoje umisteni
            $index = $this->var->main->NajdiIndexPodleCesty(implode("/", array_slice($script, -2))); //nalezeni prislusneho modulu

            //$this->dirpath = dirname($this->var->moduly[$index]["include"]);  //nacte dir path
            $this->dbname = $this->var->moduly[$index]["databaze"]; //nacte db name, musis byt v te same slozce

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $this->var->moduly[$index]["uloziste"], $this->var->moduly[$index]["class"], "{$this->dbname}");
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $tvar_data = $this->NactiUnikatniObsah($this->unikatni["ajax_tvar_datumu_getloginhistory_{$tvar}"]);

            if ($res = @$this->query("SELECT id, prihlaseni, last_active, ip, agent FROM {$this->dbpredpona}last_login
                                      WHERE uzivatel={$id}
                                      ORDER BY {$this->dbpredpona}last_login.last_active DESC;", $error))
            {
              if ($this->numRows($res) != 0)
              {
                while ($data = $this->fetchObject($res))
                {
                  $browser = $this->var->main->TypBrowseru($data->agent);
                  $os = $this->var->main->TypOS($data->agent);

                  $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_vypis_getloginhistory_{$tvar}"],
                                                      $data->id,
                                                      date($tvar_data, strtotime($data->prihlaseni)),
                                                      date($tvar_data, strtotime($data->last_active)),
                                                      $data->ip,
                                                      $browser,
                                                      $os);
                }
              }
            }
              else
            {
              var_dump($error);
            }
          }
        break;
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
