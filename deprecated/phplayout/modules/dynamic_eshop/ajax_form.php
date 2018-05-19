<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $var, $dbpredpona;

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
    $result = "";

    $action = $_POST["action"];

    //vypis pro POST
    if (!Empty($action))
    {
      switch ($action)
      {
        case "rewritename": //rewrite prepis nazvu textu
          $text = $this->AjaxJQueryKonverze($_POST["text"]);

          $result = $this->RewritePrepis($text, "low");
        break;

        case "updatezanmenu":  //drag and drop na polozky menu
          $update_poradi = $_POST["arrayzanoreni"]; //nactene pole id z jQuery
          $smer = $_POST["direct"]; //nacte smer razeni

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $sql = "";
          $c_update = count($update_poradi);  //spocitani polozek
          $poc = ($smer == "asc" ? 1 : $c_update);  //rozlisi poratecni cislo
          foreach ($update_poradi as $index => $polozka)
          {
            $sql[] = "UPDATE {$this->dbpredpona}menu SET poradi={$poc} WHERE id={$polozka};";

            if ($smer == "asc") //pocita dle zvoleneho smeru
            {
              $poc++;
            }
              else
            {
              $poc--;
            }
          }

          if (is_array($sql))
          {
            if (!$this->queryExec(implode("\n", $sql), $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->unikatni["ajax_update_menu_zanoreni"];
        break;

        case "updateporobsah":  //drag and drop na polozky obsahu
          $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery
          $smer = $_POST["direct"]; //nacte smer razeni

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $sql = "";
          $c_update = count($update_poradi);  //spocitani polozek
          $poc = ($smer == "asc" ? 1 : $c_update);  //rozlisi poratecni cislo
          foreach ($update_poradi as $index => $polozka)
          {
            $sql[] = "UPDATE {$this->dbpredpona}obsah SET poradi={$poc} WHERE id={$polozka};";

            if ($smer == "asc") //pocita dle zvoleneho smeru
            {
              $poc++;
            }
              else
            {
              $poc--;
            }
          }

          if (is_array($sql))
          {
            if (!$this->queryExec(implode("\n", $sql), $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->unikatni["ajax_update_polozky_obsah"];
        break;

        case "changedefmenu": //zmena defaultni polozky v menu
          if ($_POST["value"] == "true")
          {
            $koren = $_POST["koren"]; //menit jen ty co maji stejny koren!!!!
            settype($koren, "integer");
            $id = $_POST["id"];
            settype($id, "integer");

            $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $lastid = $this->VypisHodnotu("id", "menu", $koren, "defaultni=1 AND koren=");

            if ($this->queryExec("UPDATE {$this->dbpredpona}menu SET defaultni=0 WHERE koren={$koren};
                                  UPDATE {$this->dbpredpona}menu SET defaultni=1 WHERE koren={$koren} AND id={$id};", $error))
            {
              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_change_defmenu"], $lastid, $id);
            }
              else
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }
        break;

        case "listcheckgroup":
        case "listcheckgroup_user":
          $poc = $_POST["pocet"];
          settype($poc, "integer");

          $naz = $this->AjaxJQueryKonverze(explode("|,|", $_POST["naz"]), NULL, array("|" => ""));  //nacteni nazvu
          $val = $this->AjaxJQueryKonverze(explode("|,|", $_POST["val"]), NULL, array("|" => ""));  //nacteni hodnot
          $sho = explode(",", $_POST["sho"]);

          for ($i = 0; $i < $poc; $i++)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_{$action}"],
                                                $i,
                                                $i + 1,
                                                $naz[$i],
                                                $val[$i],
                                                ($sho[$i] ? " checked=\"checked\"" : ""),
                                                ($sho[$i] ? " disabled=\"disabled\"" : ""),
                                                ($i > 0 && ($poc - 1) == $i ? $this->unikatni["ajax_{$action}_del"] : ""));
          }
        break;

        case "listradcolsel":  //vypis radio, color a select pro adminy
        case "listradcolsel_user":
          $poc = $_POST["pocet"];
          settype($poc, "integer");

          $typ = $_POST["typ"];
          //odchyceni barev
          $color = ($typ == "colorradio" || $typ == "colorradio_user");

          $nazev = $this->AjaxJQueryKonverze(explode("|,|", $_POST["nazev"]), NULL, array("|" => ""));  //nacteni nazvu
          $hodnota = $this->AjaxJQueryKonverze(explode("|,|", $_POST["hodnota"]), NULL, array("|" => ""));  //nacteni hodnot
          $show = explode(",", $_POST["show"]);

          for ($i = 0; $i < $poc; $i++)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_{$action}"],
                                                $i,
                                                $i + 1,
                                                $nazev[$i],
                                                (Empty($hodnota[$i]) && $color ? $this->unikatni["ajax_{$action}_defcolor"] : $hodnota[$i]),
                                                ($show[$i] ? " checked=\"checked\"" : ""),
                                                ($show[$i] ? " disabled=\"disabled\"" : ""),  //6
                                                ($i > 1 && ($poc - 1) == $i ? $this->unikatni["ajax_{$action}_del"] : ""),
                                                ($color ? $this->NactiUnikatniObsah($this->unikatni["ajax_{$action}_picker"], $i) : ""));
          }
        break;

        case "gendate": //generovani nahledu datumu
          $datum = $_POST["datum"];
          $format = $_POST["format"];
          $dny = $_POST["dny"];
          $mesice = $_POST["mesice"];
          $tvar = $_POST["tvar"];

          $result = $this->InterpretDate($datum, $format, $dny, $mesice, $tvar);
        break;

        case "gentime": //generovani nahledu casu
          $datum = $_POST["datum"];
          $format = $_POST["format"];

          $result = $this->InterpretTime($datum, $format);
        break;

        case "gentext": //generovani nahledu na text
          $text = $_POST["text"];
          $delka = $_POST["delka"];
          settype($delka, "integer");
          $zkraceni = $_POST["zkraceni"];

          //zkrati text na zadanou delku
          $result = $this->ZkraceniTextu($text, $delka, $zkraceni);
        break;

        case "updateelement":  //drag and drop na elementy
          $update_poradi = $_POST["arrayelements"]; //nactene pole id z jQuery

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $sql = "";
          foreach ($update_poradi as $index => $polozka)
          {
            $poc = $index + 1;
            $sql[] = "UPDATE {$this->dbpredpona}obsah_element SET poradi={$poc} WHERE id={$polozka};";
          }

          if (is_array($sql))
          {
            if (!$this->queryExec(implode("\n", $sql), $error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }
          }

          $result = $this->unikatni["ajax_update_elements"];
        break;

        case "listseriefoto": //vypis serie fotek
          $poc = $_POST["pocet"];
          settype($poc, "integer");
          $name = $_POST["name"];
          $pocser = $_POST["pocser"];

          $dirpath = dirname($_SERVER["SCRIPT_NAME"]);
          $pathpicture = $this->unikatni["set_pathpicture"];
          $minidir = $this->unikatni["set_minidir"];
          $fulldir = $this->unikatni["set_fulldir"];
          $sourcemini = $_POST["mini"]; //rozlisuje vstupni typ

          $pic = $this->AjaxJQueryKonverze(explode("|,|", $_POST["pic"]), NULL, array("|" => ""));  //nacteni nazvu obrazku
          $popis = $this->AjaxJQueryKonverze(explode("|,|", $_POST["popis"]), NULL, array("|" => ""));  //nacteni hodnot
          $obr = array_chunk($pic, 2);  //slouceni pole do dvojic

          for ($i = 0; $i < $poc; $i++)
          {
            //vkladani defaultniho obrazku
            if (!is_file("{$pathpicture}/{$fulldir}/{$obr[$i][1]}"))
            {
              $obr[$i][0] = $this->unikatni["admin_addedit_seriefoto_default_pic"];
            }
//neosetreni prazdneho mini a full
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_listseriefoto"],
                                                $i,
                                                $i + 1,
                                                $name,
                                                $popis[$i],
                                                "{$dirpath}/{$pathpicture}/{$minidir}/{$obr[$i][0]}",
                                                "{$dirpath}/{$pathpicture}/{$fulldir}/{$obr[$i][1]}",
                                                ($sourcemini == "own" ? $this->NactiUnikatniObsah($this->unikatni["ajax_listseriefoto_own"], $i, $i + 1, $name) : ""),
                                                (($poc - 1) == $i && $pocser ? $this->NactiUnikatniObsah($this->unikatni["ajax_listseriefoto_del"], $name) : ""));
          }
        break;
      }
    }

    return $result;
  }


}

new Ajax();
?>
