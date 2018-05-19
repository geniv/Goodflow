<?php
  include_once "../../default_modul.php";
  include_once "../../promenne.php";
  include_once "../../funkce.php";

class Ajax extends DefaultModule
{
  private $unikatni, $var, $dbpredpona;
  private $cfgexplode = "|--xx--|";

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

    if (!Empty($action))
    {
      switch ($action)
      {
        case "rewritename": //prepis rewrite nazvu
          $text = $this->AjaxJQueryKonverze($_POST["text"]);

          $result = $this->RewritePrepis($text, "low");
        break;

        case "fileexists":  //overeni existence slozky
          $cesta = $_POST["cesta"];
          $dir = "{$_SERVER["DOCUMENT_ROOT"]}{$cesta}";

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_fileexists"],
                                              $dir,
                                              $this->unikatni["ajax_fileexists_stav"][file_exists($dir)]);
        break;

        case "getdir":
          $name = $_POST["name"];
          $cesta = $_POST["cesta"];
          $data = $_POST["data"];

          $enco = explode("val:", base64_decode($data));
          $rozdel = explode(":::", $enco[0]);
          $koren = "{$_SERVER["DOCUMENT_ROOT"]}{$rozdel[0]}";  //nastaveni korenu adresare
          $val = explode(":::", $enco[1]);
          //$max = $rozdel[1];  //max souboru, 0 = neomezene
          $accept = explode(",", $rozdel[2]); //akceptovane pripony
          $enable_del = (!Empty($rozdel[3])); //true = povoleni mazani

          $row = array();
          $adresare = $this->VypisAdresaru($cesta, array("name", "asc"));
          if (is_array($adresare))
          { //vypis slozek ze slozky
            foreach ($adresare as $polozka)
            {
              $row[] = $this->NactiUnikatniObsah($this->unikatni["ajax_getdir_adresar"],
                                                  $polozka,
                                                  $name,
                                                  $cesta,
                                                  $data);
            }
          }

          $soubory = $this->VypisSouboru($cesta, array("name", "asc"), $accept);
          if (is_array($soubory))
          { //vypis souboru ze slozky
            foreach ($soubory as $index => $polozka)
            {
              $path = "{$cesta}/{$polozka}";
              $velikost = $this->Velikost(filesize($path));
              $datum = date($this->unikatni["ajax_getdir_soubor_datum"] ,filemtime($path));
              $cod = base64_encode($path);
              $check = in_array($cod, $val);
              $row[] = $this->NactiUnikatniObsah($this->unikatni["ajax_getdir_soubor"],
                                                $polozka,
                                                $velikost,
                                                $datum,
                                                $name,  //4
                                                $index,
                                                $cod,
                                                ($check ? " checked=\"checked\"" : ""),
                                                (!$check ? " disabled=\"disabled\"" : ""),
                                                ($enable_del ? $this->NactiUnikatniObsah($this->unikatni["ajax_getdir_soubor_link"], "nejaky link ...", $polozka) : ""));
            }
          }
            else
          {
            $row[] = $this->unikatni["ajax_getdir_soubor_null"];
          }
          //rozdeleni aktualni cesty
          $aktual = array_diff(explode("/", $cesta), explode("/", $koren));
          //korenovy drobek
          $drobek = array($this->NactiUnikatniObsah($this->unikatni["ajax_getdir_koren"],
                                                    basename($koren),
                                                    $name,
                                                    $koren,
                                                    $data));
          //generovani drobeckove navigace
          $poc = 0;
          $ces = array();
          foreach ($aktual as $polozka)
          {
            if ($poc != (count($aktual) - 1))
            {
              $ces[] = $polozka;
              $sub = implode("/", $ces);  //slucovani adresy pro dane zanoreni
              $drobek[] = $this->NactiUnikatniObsah($this->unikatni["ajax_getdir_drobek_href"],
                                                    $polozka,
                                                    $name,
                                                    "{$koren}/{$sub}",
                                                    $data);
            }
              else
            {
              $drobek[] = $this->NactiUnikatniObsah($this->unikatni["ajax_getdir_drobek_text"],
                                                    $polozka);
            }
            $poc++;
          }
          //vystup
          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_getdir_obal"],
                                              implode($this->unikatni["ajax_getdir_drobek_sep"], $drobek),
                                              $name,
                                              implode("", $row));
        break;

        case "listradsel":  //vypis radio a select
          $poc = $_POST["pocet"];
          settype($poc, "integer");
          //$poc = ($poc <= 1 ? 2 : $poc);  //osetreni proti podklapnuti

          $typ = $_POST["typ"];
          //odchyceni checkgroup
          $group = ($typ == "checkgroup");

          $nazev = $this->AjaxJQueryKonverze(explode("|,|", $_POST["nazev"]), NULL, array("|" => ""));  //nacteni nazvu
          $hodnota = $this->AjaxJQueryKonverze(explode("|,|", $_POST["hodnota"]), NULL, array("|" => ""));  //nacteni hodnot

          for ($i = 0; $i < $poc; $i++)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_listradsel"],
                                                $i,
                                                $i + 1,
                                                $nazev[$i],
                                                $hodnota[$i],
                                                ($group ? "" : $this->NactiUnikatniObsah($this->unikatni["ajax_listradsel_radsel"], $i, $i + 1)),
                                                ($i > 1 && ($poc - 1) == $i ? $this->unikatni["ajax_listradsel_del"] : ""));
          }
        break;

        case "listtext":  //vypis textovych prepisu pro texty
          $poc = $_POST["pocet"];
          settype($poc, "integer");

          $nazev = $this->AjaxJQueryKonverze(explode("|,|", $_POST["nazev"]), NULL, array("|" => ""));  //nacteni nazvu
          $hodnota = $this->AjaxJQueryKonverze(explode("|,|", $_POST["hodnota"]), NULL, array("|" => ""));  //nacteni hodnot

          for ($i = 0; $i < $poc; $i++)
          {
            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_listtext"],
                                                $i,
                                                $i + 1,
                                                $nazev[$i],
                                                $hodnota[$i],
                                                (($poc - 1) == $i ? $this->unikatni["ajax_listtext_del"] : ""));
          }
        break;

        case "listseriefoto": //vypis serie fotek
          $poc = $_POST["pocet"];
          settype($poc, "integer");
          $poc = ($poc <= 0 ? 1 : $poc);  //osetreni proti podklapnuti
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
              $obr[$i][0] = $this->unikatni["admin_addeditobsah_seriefoto_default_pic"];
              $obr[$i][1] = $obr[$i][0];
            }

            //doplneni own
            if (Empty($obr[$i][0]))
            {
              $obr[$i][0] = $obr[$i][1];  //pokud je own prazdne pouzije [1]
            }

            $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_listseriefoto"],
                                                $i,
                                                $i + 1,
                                                $name,
                                                $popis[$i],
                                                "{$dirpath}/{$pathpicture}/{$minidir}/{$obr[$i][0]}",
                                                "{$dirpath}/{$pathpicture}/{$fulldir}/{$obr[$i][1]}",
                                                ($sourcemini == "own" ? $this->NactiUnikatniObsah($this->unikatni["ajax_listseriefoto_own"], $i, $i + 1, $name) : ""),
                                                ($i > 0 && ($poc - 1) == $i && $pocser ? $this->NactiUnikatniObsah($this->unikatni["ajax_listseriefoto_del"], $name) : ""));
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
          $id = $_POST["id"];
          settype($id, "integer");
          $text = $_POST["text"];
          $delka = $_POST["delka"];
          settype($delka, "integer");
          $zkraceni = $_POST["zkraceni"];

          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }

          $konfigurace = explode($this->cfgexplode, $this->VypisHodnotu("konfigurace", "element", $id));

          //extrahuje z pole potrebnou konfiguraci
          list($search, $replace) = $this->RozdelitHodnoty($konfigurace, 2, 3);
          //nahrazeni zadanym polem
          $prepis = str_replace($search, $replace, $text);
          //zkrati text na zadanou delku
          $result = $this->ZkraceniTextu($prepis, $delka, $zkraceni);
        break;

        case "updateelement":  //drag and drop na elementy
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}", $action))
          {
            $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $sql = "";
            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}element SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}", $action);
              }
            }

            $result = $this->unikatni["ajax_updateelement"];
          }
            else
          {
            $result = $this->unikatni["ajax_updateelement_not_permit"];
          }
        break;

        case "updatesablona": //drag and drop na sablony
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[1]}", $action))
          {
            $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $sql = "";
            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}sablona SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[1]}", $action);
              }
            }

            $result = $this->unikatni["ajax_updatesablona"];
          }
            else
          {
            $result = $this->unikatni["ajax_updatesablona_not_permit"];
          }
        break;

        case "updateobsah": //drag and drop na obsahy
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"));

          $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery
          $smer = $_POST["direct"]; //nacte smer razeni

          $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
          if (!$this->PripojeniDatabaze($error))
          {
            var_dump($error, array(__LINE__, __METHOD__));
          }
          //vezme si prvni index a podle neho urci sablonu
          $sablona = $this->VypisHodnotu("sablona", "obsah", $update_poradi[0]);
          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}__{$sablona}", $action))
          {
            $sql = "";
            $c_update = count($update_poradi);  //spocitani polozek
            $poc = ($smer == "asc" ? 1 : $c_update);  //rozlisi poratecni cislo
            foreach ($update_poradi as $polozka)
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
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}__{$sablona}", $action);
              }
            }

            $result = $this->unikatni["ajax_updateobsah"];
          }
            else
          {
            $result = $this->unikatni["ajax_updateobsah_not_permit"];
          }
        break;

        case "updatemenu":  //drag and drop na menu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[2]}", $action))
          {
            $update_poradi = $_POST["arrayporadi"]; //nactene pole id z jQuery

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $sql = "";
            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}menu SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              if ($this->queryExec(implode("\n", $sql)))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[2]}", $action);
              }
            }

            $result = $this->unikatni["ajax_updatemenu"];
          }
            else
          {
            $result = $this->unikatni["ajax_updatemenu_not_permit"];
          }
        break;

        case "changedefmenu":  //nastavovani defaultni polozky
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[2]}", $action))
          {
            if ($_POST["value"] == "true")
            {
              $koren = $_POST["koren"]; //menit jen ty co maji stejny koren!!!!
              settype($koren, "integer");
              $id = $_POST["id"];
              settype($id, "integer");

              $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
              if (!$this->PripojeniDatabaze($error))
              {
                var_dump($error, array(__LINE__, __METHOD__));
              }

              $lastid = $this->VypisHodnotu("id", "menu", $koren, "defaultni=1 AND koren=");

              if ($this->queryExec("UPDATE {$this->dbpredpona}menu SET defaultni=0 WHERE koren={$koren};
                                    UPDATE {$this->dbpredpona}menu SET defaultni=1 WHERE koren={$koren} AND id={$id};"))
              {
                $result = $this->NactiUnikatniObsah($this->unikatni["ajax_changedefmenu"], $lastid, $id);
                $this->AdminAddActionLog(array($lastid, $id), array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[2]}", $action);
              }
            }
          }
            else
          {
            $result = $this->unikatni["ajax_changedefmenu_not_permit"];
          }
        break;
      }
    }

    return $result;
  }


}

new Ajax();
?>
