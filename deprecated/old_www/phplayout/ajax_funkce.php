<?php
  include_once "default_modul.php";
  include_once "promenne.php";
  include_once "funkce.php";

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

    $this->unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php");
    //$this->get_id = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_id"]);
    //$this->get_sablona = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_sablona"]);
    //$this->get_text = $this->NactiUnikatniObsah($this->unikatni["ajax_set_get_text"]);

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

        case "gethostname":  //zjsteni hostname podle ip
          $result = gethostbyaddr($_POST["ip"]);
        break;
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
