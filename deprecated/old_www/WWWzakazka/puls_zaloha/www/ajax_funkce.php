<?php
  include_once "default_modul.php";
  include_once "promenne.php";
  include_once "funkce.php";

class AjaxFunkce extends DefaultModule
{
  private $unikatni, $var, $dbpredpona, $absolutni_url;
  private $get_check, $get_down, $get_downclass;

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
    $this->unikatni = $this->var->main[0]->AjaxInicializaceModulu(".unikatni_funkce.php");  //inicializace pro ajax
    $this->absolutni_url = $this->AbsolutniUrl();

    //$this->get_check = $this->unikatni["set_get_check"];
    //$this->get_down = $this->unikatni["set_get_down"];
    //$this->get_downclass = $this->unikatni["set_get_downclass"];

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
      //$set_jednotky = $this->unikatni["set_jednotky"];  //naceteni jednotek
      //$set_nosize = $this->unikatni["set_aktualizace_nosize"]; //nacteni tvaru bez datumu
      //$set_datum = $this->unikatni["set_aktualizace_datum"]; //nacteni tvaru datumu
      //$set_nodatum = $this->unikatni["set_aktualizace_nodatum"]; //nacteni tvaru bez datumu

      switch ($action)
      {
        case "getzeme": //zjisteni zeme
          $ip = $_POST["ip"]; //nacteni IP adresy
          $tvar = $_POST["tvar"]; //nacte cislo tvaru

          if (!in_array($ip, $this->var->ipblok)) //kontrola localhostu
          {
            include($this->var->geoipinc);
            $handle = geoip_open($this->var->geoipdat, GEOIP_MEMORY_CACHE);  //GEOIP_STANDARD
            $zeme = geoip_country_name_by_addr($handle, $ip);
            geoip_close($handle);

            if (Empty($zeme)) //kdyz nenajde
            {
              $zeme = $this->unikatni["ajax_zeme_notfound_{$tvar}"];
            }
          }
            else
          { //kdyz se testuje na lokalu
            $zeme = $this->unikatni["ajax_zeme_local_{$tvar}"];
          }

          $result = $this->NactiUnikatniObsah($this->unikatni["ajax_get_zeme_{$tvar}"], $ip, $zeme);
        break;

        case "gethostname":  //zjsteni hostname podle ip
          $result = gethostbyaddr($_POST["ip"]);
        break;

        case "cas": //vraceni casu
          $result = date("H:i");
        break;

        case "getsize": //inerpretuje velikost
          $result = $this->Velikost($_POST["cesta"]);
        break;

        case "getadrsize": //zjisti velikost adresaru
          $rekurzivne = ($_POST["rek"] == "true");
          $result = $this->Velikost($this->VelikostAdresare($_POST["cesta"], $rekurzivne));
        break;

        case "getavgsize":  //zjisti prumernou velikost jednoho souboru
          $rekurzivne = ($_POST["rek"] == "true");
          $size = $this->VelikostAdresare($_POST["cesta"], $rekurzivne);
          $countfile = count($this->VypisSouboru($_POST["cesta"]));
          $avg = 0;
          if ($countfile > 0)
          { //vypocet prumerne velikosti souboru v adresari
            $avg = $size / $countfile;
          }
          $result = $this->Velikost($avg);
        break;

        case "getmoduleupdate": //aktualizace pro dany modul pri obsluze modulu
          $result = "coming soon.... ve vývoji na pořadí...";
/*
          $include = $_POST["include"]; //nacteni cesty
          $class = $_POST["class"]; //nacteni tridy
          $module = $this->ConnectModule(0, array("class", "adress"), $this->var);

          if (!Empty($include) &&
              !Empty($class) &&
              $this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[1]}", $action))
          {
            //uprava pravidla pri funkci a vysekani duplicitnich slozek
            $cesta = ($class == "Funkce" ?
                        $include :
                        implode("/", array_unique(explode("/","{$this->var->dirmodule}/{$include}"))));
            $modules = "";
            if (file_exists($cesta))  //pokud existuje cesta
            {
              include_once $cesta;
              $modul = new $class();
              $path = dirname($cesta); //zjisteni pathu cesty

              $nazev = explode(".", basename($cesta));

              $modules[] = $cesta;  //vlozeni zakladniho modulu

              if (!Empty($modul->mount))  //test existence pripojnych modulu
              {
                if ($class == "Funkce")
                {
                  $modul->mount = array_merge($modul->mount, $this->unikatni["set_addon_mount"]); //rozsireni pripojenych souboru
                }

                foreach ($modul->mount as $hodnota)
                {
                  if (!Empty($hodnota)) //pokud ma modul nejaky pripojny soubor
                  {
                    $modules[] = "{$path}/{$hodnota}"; //vlozeni pridavnych modulu
                  }
                }
              }

              //nacteni css stylu pokud existuji
              if (file_exists("{$path}/{$nazev[0]}.css"))
              {
                $modules[] = "{$path}/{$nazev[0]}.css"; //vytvoreni cesty css
              }
//dodelat!!! do budoucna predelat na XML!!!!!!!!!!!!!!!!!!!
              //prepnuti typu unikatnich
              $unikatni = ($class == "Funkce" ? ".unikatni_funkce.php" : ".unikatni_obsah.php");
              //nacteni unikatnich pokud existuji
              if (file_exists("{$path}/{$unikatni}"))
              {
                $modules[] = "{$path}/{$unikatni}"; //vyrvoreni cesty unikatnich
              }

              $arraydotaz = implode("&{$this->get_check}[]=", $modules);  //slozeni dotazu na modul
              $retserver = explode("++", $this->NactiUrl("{$this->var->depozitar}?{$this->get_check}[]={$arraydotaz}"));  //otazka na server

              $diff = "";
              foreach ($modules as $idx => $hodnota) //projiti modulu
              {
                $adresar = basename(dirname($hodnota)); //adresar
                $adresar = ($adresar == "." || $adresar == ".." ? $this->unikatni["aktualizace_root"] : $adresar);
                $soubor = basename($hodnota); //soubor

                if (file_exists($hodnota))  //overeni existence lokalniho souboru
                {
                  $md5 = md5_file($hodnota);  //vypocitani md5_file
                  $datum = filemtime($hodnota); //zjisteni lokalniho casu zmeny
                  $velikost = filesize($hodnota); //zjisteni lokalni velikosti
                }
                  else
                { //pokud neni na lokalu
                  $md5 = "";
                  $datum = 0;
                  $velikost = 0;
                }

                //kontrola jestli na je soubor na serveru
                if ($retserver[$idx] != "error")
                {
                  //rozdeleni zjistenych hodnot
                  $expserver = explode("__", $retserver[$idx]); //sahne si pro dotycny server navrat
                  $server_md5 = $expserver[0];  //md5_file
                  $server_time = $expserver[1]; //filemtime
                  $server_size = $expserver[2]; //filesize
                }
                  else
                { //pokud neni na serveru
                  $server_md5 = "";
                  $server_time = 0;
                  $server_size = 0;
                }

                $diff = $this->var->main[0]->PorovnaniAktualizace($this->unikatni, $md5, $server_md5);

                //pocitani radku
                $countline = 0;
                if (file_exists($hodnota))
                {
                  $u = fopen($hodnota, "r");
                  $nactenytext = fread($u, filesize($hodnota) > 0 ? filesize($hodnota) : 1);
                  //spocita radky rozdelenych podle \n
                  $countline = count(explode("\n", $nactenytext)); //spocita radky
                  fclose($u);
                }

                $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_get_module_update"],
                                                    $class,
                                                    $adresar,
                                                    $soubor,
                                                    (!Empty($datum) ? date($set_datum, $datum) : $set_nodatum),
                                                    (!Empty($server_time) ? date($set_datum, $server_time) : $set_nodatum),
                                                    (!Empty($velikost) ? $this->Velikost($velikost) : $set_nosize),
                                                    (!Empty($server_size) ? $this->Velikost($server_size) : $set_nosize),
                                                    $diff,
                                                    $countline);
              }
            }
            $this->AdminAddActionLog($class, array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[1]}", $action);
          }
            else
          {
            $result = $this->unikatni["ajax_get_module_update_not_permit"];
          }
*/
        break;

        case "getvalue":  //zjisti pozadovanout hodnotu
          $key = $_POST["key"];

          $stav = "ready";
          switch ($key) //vrati podle potreby hodnotu
          {
            case "phpver":  //zjisti verzi php
              $result = PHP_VERSION;
            break;

            case "phpvermin":  //vypise minimalni verzi php
              $cisver = str_split($this->var->phpmin);  //rozsekani cisla
              $n1 = $cisver[0];
              $n2 = "{$cisver[1]}{$cisver[2]}"; //slouceni cisel
              settype($n2, "integer");  //konvert na integer
              $n3 = "{$cisver[3]}{$cisver[4]}";
              settype($n3, "integer");
              $result = "{$n1}.{$n2}.{$n3}";  //slozeni cisla verze
            break;

            case "zipver":  //zjisti verzi zip
              $result = phpversion("zip");
            break;

            case "sqlitever": //zjisti verzi sqlite
              $result = phpversion("sqlite"); //SQLite
            break;

            case "apachever": //zjisti verzi apache
              $result = $_SERVER["SERVER_SOFTWARE"];
            break;

            case "systemver":  //zjisti verzi systemu
              $result = php_uname();
            break;

            case "loadext": //zjisti nactene rozsireni php
              $ext = get_loaded_extensions();
              $result = implode(", ", $ext);
            break;

            case "needext": //zjisti potrebne rozsireni php
              $ext = get_loaded_extensions(); //vsechny nactene moduly apache
              natcasesort($this->var->needexmod);  //seradeni hodnot sestupne
              foreach ($this->var->needexmod as $hodnota) //projiti pole potrebnych modulu
              {
                $result .= $this->NactiUnikatniObsah($this->unikatni["ajax_need_ext"],
                                                    $hodnota,
                                                    (in_array($hodnota, $ext) ? " checked=\"checked\"" : ""));
              }
            break;

            case "curos": //zjisti aktualni os
              //$result = $this->TypOS($_SERVER["HTTP_USER_AGENT"]);
              $result = $this->TypSystemu()->os;
            break;

            case "curbrow": //zjisti aktualni browser
              //$result = $this->TypBrowseru($_SERVER["HTTP_USER_AGENT"]);
              $result = $this->TypSystemu()->browser;
            break;

            case "curip": //zjisti aktualni ip
              $result = $_SERVER["REMOTE_ADDR"];
            break;

            case "curhost": //zjisti aktualni hostname
              $result = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
            break;

            case "curjquery": //zjisti aktualni jQuery
              $ret = $this->NactiUrl("http://jquery.com/");
              $a = preg_split("/Release:<\/strong> v|<\/p>/", $ret);
              $result = (!Empty($a[5]) ? $a[5] : "");
              //porovnani verze
              $cesta = "{$this->var->jquerycore}";
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/Library v|\n/", $data);
                $stav = ($a[2] == $result ? "ready" : "wrong");
              }
            break;

            case "curlocjquery":  //zjisti aktualni jQuery na lokalu
              $result = "???";
              $cesta = "{$this->var->jquerycore}";
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/Library v|\n/", $data);
                $result = $a[2];
              }
            break;

            case "curjqueryui": //zjisti aktualni jQuery UI
              $ret = $this->NactiUrl("http://jqueryui.com/");
              $a = preg_split("/Stable<\/a>  \(|: <em>/", $ret);
              $result = (!Empty($a[1]) ? $a[1] : "");
              //porovnani verze
              $cesta = "{$this->var->jqueryui}";
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/jQuery UI |\n/", $data);
                $stav = ($a[2] == $result ? "ready" : "wrong");
              }
            break;

            case "curlocjqueryui": //zjisti aktualni jQuery UI na lokalu
              $result = "???";
              $cesta = "{$this->var->jqueryui}";
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/jQuery UI |\n/", $data);
                $result = $a[2];
              }
            break;

            case "curhighslide": //zjisti aktualni highslide
              $ret = $this->NactiUrl("http://www.highslide.com/download.php");
              $a = preg_split("/\.zip'>| \(latest\)/", $ret);
              $result = (!Empty($a[1]) ? $a[1] : "");
              //porovnani verze
              $cesta = "script/highslide/highslide-full.min.js";
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/Version: | \(/", $data);
                $stav = ($a[1] == $result ? "ready" : "wrong");
              }
            break;

            case "curlochighslide": //zjisti aktualni highslide na lokalu
              $result = "???";
              $cesta = $this->var->highslide;
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/Version: | \(/", $data);
                $result = $a[1];
              }
            break;

            case "curhighcharts": //zjisti aktualni highcharts na webu
              $ret = $this->NactiUrl("http://www.highcharts.com/download");
              $a = preg_split("/'ZIP', '|'\)/", $ret);
              $result = (!Empty($a[1]) ? $a[1] : "");
              //porovnani verze
              $cesta = $this->var->highcharts;
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/ v| \(/", $data);
                $stav = ($a[1] == $result ? "ready" : "wrong");
              }
            break;

            case "curlochighcharts":  //zjisti aktualni highcharts na lokalu
              $result = "???";
              $cesta = $this->var->highcharts;
              if ($u = @fopen($cesta, "r"))
              {
                $data = fread($u, 200);
                fclose($u);
                $a = preg_split("/ v| \(/", $data);
                $result = $a[1];
              }
            break;

            case "mPDF":  //zjisti aktualni mPDF na lokalu
              ini_set("memory_limit", "100M");  //nasosne si vic mega
              include_once $this->var->mpdfcore;
              $result = mPDF_VERSION;
            break;

            case "curmpdf": //zjisti aktualni mpdf
              $ret = $this->NactiUrl("http://mpdf.bpm1.com/download");
              $a = preg_split("/Download mPDF Version | \(/", $ret);
              $result = (!Empty($a[1]) ? $a[1] : "");
              //porovnani verze
              ini_set("memory_limit", "100M");  //nasosne si vic mega
              include_once $this->var->mpdfcore;
              $stav = (mPDF_VERSION == $result ? "ready" : "wrong");
            break;

            case "getbrowver":  //vrati verzi browscapu
              $a = $this->InfoGetBrowser(); //http://browsers.garykeith.com/downloads.asp
              $result = $a["Version"];
            break;

            case "curgetbrowver": //aktialni verze browscapu
              $ret = $this->NactiUrl("http://browsers.garykeith.com/downloads.asp", array("cache" => true, "expire" => "-2 day"));
              $a = preg_split("/<b>Version:<\/b> |<br>/", $ret);
              $result = $a[1];  //vyparsrovane version
              //porovnani verze
              $b = $this->InfoGetBrowser();
              $stav = ($b["Version"] == $result ? "ready" : "wrong");
            break;

            case "getbrowreleased": //vrati released browscapu
              $a = $this->InfoGetBrowser();
              $result = $a["Released"];
            break;

            case "curgetbrowreleased":  //aktualni released browscapu
              $ret = $this->NactiUrl("http://browsers.garykeith.com/downloads.asp", array("cache" => true, "expire" => "-2 day"));
              $a = preg_split("/<b>Released:<\/b> |<\/p>/", $ret);
              $result = $a[1];  //vyparsrovane released
              //porovnani verze
              $b = $this->InfoGetBrowser();
              $stav = ($b["Released"] == $result ? "ready" : "wrong");
            break;

            //geoip:
            //http://www.maxmind.com/app/geolitecountry
            //geocity:
            //http://www.maxmind.com/app/geolitecity
          }

          switch ($key)
          {
            case "curjquery":
            case "curlocjquery":
            case "curjqueryui":
            case "curlocjqueryui":
            case "curhighslide":
            case "curlochighslide":
            case "curhighcharts":
            case "curlochighcharts":
            case "mPDF":
            case "curmpdf":
            case "getbrowver":
            case "curgetbrowver":
            case "getbrowreleased":
            case "curgetbrowreleased":
              $result = $this->NactiUnikatniObsah($this->unikatni["info_admin_uvod_{$stav}_verze"],
                                                  $result);
            break;
          }
        break;

        case "updatemenu": //drag and drop na moduly
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);
          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[2]}", $action))
          {
            $update_poradi = $_POST["arrayporadi"]; //vrati nove poradi ID

            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            foreach ($update_poradi as $index => $polozka)
            {
              $poc = $index + 1;
              $sql[] = "UPDATE {$this->dbpredpona}moduly SET poradi={$poc} WHERE id={$polozka};";
            }

            if (is_array($sql))
            {
              //ulozi nove poradi
              if ($this->queryExec(implode("\n", $sql), $error))
              {
                $this->AdminAddActionLog($update_poradi, array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[2]}", $action);
              }
            }

            $this->var->main[0]->AjaxAdminGenerateModule(); //vygeneruje znovu cache

            if (Empty($error))
            {
              $result = $this->unikatni["ajax_updatemenu"];
            }
          }
            else
          {
            $result = $this->unikatni["ajax_updatemenu_not_permit"];
          }
        break;

        case "changeact": //zmeni aktivitu modulu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);
          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[2]}", $action))
          {
            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $id = $_POST["id"]; //vrati nove poradi ID
            $stav = ($_POST["stav"] == "true" ? 1 : 0); //vrati nove poradi ID

            if ($this->queryExec("UPDATE {$this->dbpredpona}moduly SET aktivni={$stav}
                                  WHERE id={$id};", $error))
            {
              $this->var->main[0]->AjaxAdminGenerateModule(); //vygeneruje znovu cache
              $this->AdminAddActionLog(array($id, $stav), array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[2]}", $action);
              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_action"], $id);
            }
          }
            else
          {
            $result = $this->unikatni["ajax_update_action_not_permit"];
          }
        break;

        case "setpermit": //nastavovani opravneni modulu
          $index = $this->var->main[0]->NajdiIndexPodleCesty($_SERVER["SCRIPT_NAME"]); //nalezeni prislusneho modulu
          $module = $this->ConnectModule($index, array("class", "adress"), $this->var);

          if ($this->OverovaniManualPermission($module->class, "{$module->adress[0]}{$module->adress[3]}", $action))
          {
            $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, true);
            if (!$this->PripojeniDatabaze($error))
            {
              var_dump($error, array(__LINE__, __METHOD__));
            }

            $id = $_POST["id"]; //vrati nove poradi ID
            settype($id, "integer");
            $adresa = $_POST["adresa"];
            $stav = ($_POST["stav"] == "true" ? 1 : 0); //vrati nove poradi ID
            //zamek dotazu, zamceni
            $this->beginTransaction();

            //nacteni opravneni a rozdeleni na pole
            $permit = explode($this->permexplode, $this->VypisHodnotu("opravneni", "permission", $id));

            //pokud odznaceno tak nevlozi do pole
            if ($stav)
            { //pokud je prvni index neprazdny
              if (!Empty($permit[0]))
              { //prida do pole danou adresu
                $permit[] = $adresa;
              }
                else
              { //vlozeni do nulteho indexu
                $permit[0] = $adresa;
              }
            }
              else
            { //nalezeni polozky na vyhozeni
              $pos = array_search($adresa, $permit);  //pokud existuje
              $permit[$pos] = null; //vymaze obsah indexu
            }
            //vyhazeni duplikatnich hodnot, zejmena mezer v poly
            $permit = array_unique($permit);
            sort($permit);  //seradi sestupne aby mezery vyskakaly na prvni mista

            //uprava a slouceni pole
            $opravneni = implode($this->permexplode, $permit);
            if ($this->queryExec("UPDATE {$this->dbpredpona}permission SET opravneni='{$opravneni}' WHERE id={$id};", $error))
            {
              $ret = str_replace(array("|-|", "|x|"), array("::", "->"), $adresa);
              $result = $this->NactiUnikatniObsah($this->unikatni["ajax_update_permission"],
                                                  $ret,
                                                  ($stav ? $this->unikatni["ajax_update_permission_true"] : $this->unikatni["ajax_update_permission_false"]));
            }

            //zamek dotazu, odemceni
            if ($this->endTransaction())
            {
              $this->AdminAddActionLog(array($ret, $stav), array(__LINE__, __METHOD__), "{$module->adress[0]}{$module->adress[3]}", $action);
              $this->var->main[0]->GenerovaniCssPermisson($id);  //pregenerovani css s opravnenim
            }
          }
            else
          {
            $result = $this->unikatni["ajax_update_permission_not_permit"];
          }
        break;
      }
    }

    return $result;
  }


}

  $web = new AjaxFunkce();
?>
