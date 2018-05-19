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
 * vybere provadenou akci ajaxu pres dane parametry
 *
 * @return dana akce
 */
  private function VyberFunkci()  //vybere volanou funkci
  {
    $result = "";

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        case "changedate":  //posun datumu
          $datum = $_POST["datum"];

          $result = date($this->unikatni["admin_addeditfac_tvar_datum"], strtotime($this->unikatni["admin_addfac_plus_datum"], strtotime($datum)));
        break;

        case "listelem":  //vypis elementu
          $pocet = $_POST["pocet"];
          //$nazev = str_replace("|", "", explode("|,|", $_POST["nazev"])); //nacteni polozek
          $nazev = $this->AjaxJQueryKonverze(explode("|,|", $_POST["nazev"]), NULL, array("|" => ""));  //nacteni nazvu
          $mnozstvi = explode(",", $_POST["mnozstvi"]);
          $cenajm = explode(",", $_POST["cenajm"]);
          $sleva = explode(",", $_POST["sleva"]);

          $sumcena = 0;
          for ($i = 0; $i < ($pocet <= 0 ? 1 : $pocet); $i++) //vykresleni polozek
          {
            $cenacel = $mnozstvi[$i] * $cenajm[$i];
            $slevacel = $mnozstvi[$i] * $sleva[$i];
            $koncena = $cenacel - $slevacel;
            $sumcena += $koncena;

            $result .= $this->NactiUnikatniObsah($this->unikatni["admin_listelem"],
                                                $i,
                                                $nazev[$i],
                                                (!Empty($mnozstvi[$i]) ? $mnozstvi[$i] : 0),
                                                (!Empty($cenajm[$i]) ? $cenajm[$i] : 0),
                                                $cenacel,
                                                (!Empty($sleva[$i]) ? $sleva[$i] : 0),
                                                $slevacel,
                                                $koncena,
                                                ($i > 0 && ($pocet - 1) == $i ? $this->unikatni["admin_listelem_del"] : ""));
          }

          $result .= $this->NactiUnikatniObsah($this->unikatni["admin_listelem_end"],
                                              $sumcena);
        break;
      }
    }

    return $result;
  }
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
