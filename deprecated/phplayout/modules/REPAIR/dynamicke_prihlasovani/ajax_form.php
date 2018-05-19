<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $var, $dbpredpona, $seppol;

/**
 *
 * konstuktor ajaxu stranky s tiskem
 *
 * @return tisk vysledku dane funkce
 */
  public function __construct()
  {
    $this->var = new Promenne();  //vytvoreni promennych
    $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
    $this->unikatni = $this->var->main[0]->AjaxInicializaceModulu(".unikatni_obsah.php");  //inicializace pro ajax

    //$this->unikatni = $this->NactiObsahSouboru(".unikatni_obsah.php");

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
        case "testprefix":  //live ukazka prefixu
          $text = $_POST["text"];

          $mainroz = explode("|", $text); //prvni rozdeleni podle |
          //print_r($mainroz);
          $out = "";
          foreach ($mainroz as $row)
          {
            $randroz = explode("->", $row);
            $out .= (count($randroz) == 2 ? rand($randroz[0], $randroz[1]) : $row);
          }

          $result = $out;
        break;

        case "currcap": //aktualni kapacita
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $idakce = $_POST["id"];
          settype($idakce, "integer");
          $typ = $_POST["typ"];
          settype($typ, "integer");
          $tvar = $_POST["tvar"];

          $kapacita = $this->querySingle("SELECT kapacita FROM {$this->dbpredpona}akce WHERE id={$idakce}"); //kapacita
          $rezerva = $this->querySingle("SELECT rezerva FROM {$this->dbpredpona}akce WHERE id={$idakce}"); //kapacita

          switch ($typ)  //rozdeleni podle typu kontroly
          {
            case 0: //kontrola na aktivovane
              $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce} AND aktivni=1"); //secte aktivni
            break;

            case 1: //kontrola na pridane
              $aktivnich = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona}registrace WHERE akce={$idakce}"); //secte vsechny pridane
            break;
          }
          $suma = $kapacita + $rezerva;
          $zbyva = $suma - $aktivnich;

          $result = $this->NactiUnikatniObsah($this->unikatni["normal_ajax_currcap_{$tvar}"],
                                              $kapacita,
                                              $rezerva,
                                              $suma,
                                              $aktivnich,
                                              $zbyva,
                                              date($this->unikatni["normal_ajax_tvar_datum_{$tvar}"])
                                              );
        break;

        case "getzeme": //zjisteni zeme
          $ip = $_POST["ip"]; //nacteni IP adresy
          $tvar = $_POST["tvar"]; //nacte cislo tvaru

          if (!in_array($ip, $this->var->ipblok)) //kontrola localhostu
          {
            include("../../{$this->var->geoipinc}");
            $handle = geoip_open("../../{$this->var->geoipdat}", GEOIP_MEMORY_CACHE);  //GEOIP_STANDARD
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

        case "gethostname":  //zjsteni hostname podle ip
          $result = gethostbyaddr($_POST["ip"]);
        break;

        case "setvalue":
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $id = $_POST["id"];
          settype($id, "integer");

          $ucast = ($_POST["val"] == "true" ? 1 : 0);

          if ($this->queryExec("UPDATE {$this->dbpredpona}registrace SET ucast={$ucast} WHERE id={$id};", $error))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_setvalue"],
                                                $id,
                                                ($ucast ? $this->unikatni["ajax_update_setvalue_true"] : $this->unikatni["ajax_update_setvalue_false"]));
          }
            else
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }
        break;

        case "updateRecordsListingsMenu": //drag and drop na menu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $update_poradi = $_POST["recordsArray"]; //vrati nove poradi ID

          $poc = 0;
          $c_update = count($update_poradi);
          for ($i = 0; $i < $c_update; $i++)
          {
            $poc = $i + 1;

            //ulozi nove poradi
            if (!$this->queryExec("UPDATE {$this->dbpredpona}akce SET poradi={$poc}
                                  WHERE id={$update_poradi[$i]};", $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_records_listings_menu"]);
        break;
      }
    }

    return $result;
  }


}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
