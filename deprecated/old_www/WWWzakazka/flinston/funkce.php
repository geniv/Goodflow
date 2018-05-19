<?php

/**
 *
 * Centralni funkce projektu
 *
 * public funkce:\n
 * construct: Funkce - hlavni konstruktor tridy\n
 * StartCas() - zacatek stopovani casu\n
 * KonecCas() - konec stopovani casu\n
 * ObsahStranek() - vkladani statickych nebo pevne danych stranek\n
 * OdkazZpet() - hypertextovy odkaz zpet\n
 * ErrorMsg() - globalni vypis chybovych hlasek\n
 * AutoClick() - meta odkaz na auto presmerovani\n
 * TypOS() - zjisteni  typu OS\n
 * TypBrowseru() - zjisteni typu Browseru\n
 * ExistenceUrl() - kontrola existence url\n
 * NactiUrl() - stahne obsah url stranky do promenne\n
 * Velikost() - dle dane velikosti vrati prepocitanou jednotku\n
 * KontrolaEmailu() - kontrola emailu za pomoci regularnich vyrazu\n
 * DetekceLinuxu() - detekce linuxu\n
 * DetekceOpery() - detekuje operu\n
 * Strankovani() - souvisle strankovani, netabulkove\n
 * PrepisAdresy() - prepis adresy do pekne formy\n
 * ZpetnyPrepisAdresy() - zpetny prepis do puvodni formy\n
 *
 * NactiFunkci() - nacte danou funkci z daneho modulu udaneho indexem, i s danym parametrem\n
 * AdminMenu() - odkaz na admin obsahu\n
 * AdminObsah() - obsah adminu\n
 * InicializaceModulu() - inicialiazce vsech modulu\n
 *
 * GenerovaniAdminMenu() - generovani menu adminu\n
 * GenerovaniAdminObsah() - generovani obsahu adminu\n
 *
 * url serveru: $_SERVER["SERVER_NAME"]
 * d.m.Y / H:i:s
 */

class Funkce
{
  private $var;
  private $start, $konec;
  private $idmodul = "funkce";
  private $idzaloha = "zaloha";
  private $iddelzal = "delzal";
  private $idupp = "up";

  private $get_check = "check";
  private $get_download = "down";
  private $get_zdrojstazeni = "source";
  private $get_showsource = "soucefile";
  /**
   * true/false - aktualizace kazdy den
   */
  private $autozaloha = true;
  /**
   * adresa slozky zalohovani databazi
   */
  private $zalohadir = "db";

/**
 *
 * Konstruktor funkce
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 *
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;

    if ($this->var->autoklenot)  //kdyz bude IP v bloku tak jde o lokalhost tedy, o klenot se nejedna
    {
      $this->var->klenot = (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok) ? true : false);
    }

    $verze = $this->KontrolaVerze();
    if ($verze < 5) //kontrola verze, kvuli php5
    {
      echo "máte příliš starou verzi php: (PHP{$verze}), potřebujete minimálně verzi PHP5";
      exit(1);
    }

    //$this->Instalace();

    $this->Prihlasovani();

    $this->AutoZalohovani();
  }

/**
 *
 * Vrati absolutni adresu s pathem
 *
 * @return absolutni adresa
 */
  public function AbsoluteUrl()
  {
    $path = dirname($_SERVER["SCRIPT_NAME"]);
    $result = "http://{$_SERVER["SERVER_NAME"]}".($path != "/" ? "{$path}" : "")."/";

    return $result;
  }

/**
 *
 * Zjist verzi php
 *
 * @return cislo verze
 */
  private function KontrolaVerze()
  {
    $verze = explode(".", phpversion());
    $result = $verze[0];
    settype($result, "integer");

    return $result;
  }

/**
 *
 * Zavola danou funkc z daneho indexu tridy, dokaze zpracovat libovolne mnozstvi parametru
 *
 * @param index index nebo nazev funkce pro $this->var->main
 * @param funkce volana public funkce
 * @return obsah funkce
 */
  public function NactiFunkci($index, $funkce)
  {
    $paramatr = func_get_args();
    $pocet = func_num_args();
    $argv = array();
    if ($pocet > 2)
    {
      for ($i = 2, $j = 0; $i < $pocet; $i++, $j++)
      {
        $argv[$j] = $paramatr[$i];  //prevedeni parametru
      }
    }

    if (is_string($index))
    {
      $cis = -1;
      for ($i = 0; $i < count($this->var->moduly); $i++)
      {
        if ($this->var->moduly[$i]["class"] == $index)
        {
          $cis = $i;
          break;
        }
      }

      if ($cis == -1)
      {
        $this->ErrorMsg("POZOR! Nepodařilo se najít třídu s názvem: ''{$index}'' !!");
      }
        else
      {
        $index = $cis;
      }
    }

    $result = "";
    if ($cis != -1)
    {
      if (method_exists($this->var->moduly[$index]["class"], $funkce))
      {
        $result = call_user_func_array(array($this->var->main[$index], $funkce), $argv);  //trida::funkce, parametry
      }
        else
      {
        if (!Empty($this->var->moduly[$index]["class"]))
        {
          $this->ErrorMsg("POZOR! U třídy: ''{$this->var->moduly[$index]["class"]}'' se neporařilo načíst funkci: ''{$funkce}''!");
        }
          else
        {
          $this->ErrorMsg("POZOR! Nepodařilo se najít třídu o indexu:  ''{$index}'' ");
        }
      }
    }

    return $result;
  }

/**
 *
 * Najde index podla zadane tridy
 *
 * @param trida nazev tridy
 * @return cslo indexu
 */
  public function NajdiIndexPodleTridy($trida)
  {
    $result = -1;
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      if ($this->var->moduly[$i]["class"] == $trida)
      {
        $result = $i;
        break;
      }
    }

    return $result;
  }

/**
 *
 * Hlavni inicializace modulu
 *
 */
  public function InicializaceModulu()
  {
    for ($i = 1; $i < count($this->var->moduly); $i++)
    {
      if (file_exists($this->var->moduly[$i]["include"]))
      {
        include_once "{$this->var->moduly[$i]["include"]}";
        if (class_exists($this->var->moduly[$i]["class"]))
        {
          if (method_exists($this->var->moduly[$i]["class"], "__construct"))
          {
            $this->var->main[$i] = new $this->var->moduly[$i]["class"]($this->var, $i);
          }
            else
          {
            $this->ErrorMsg("POZOR! Z třídy: ''{$this->var->moduly[$i]["class"]}'', metoda konstruktoru neexistuje");
          }
        }
          else
        {
          $this->ErrorMsg("POZOR! Třída:  ''{$this->var->moduly[$i]["class"]}'' neexistuje!!");
        }
      }
        else
      {
        $this->ErrorMsg("POZOR! Třída:  ''{$this->var->moduly[$i]["class"]}'' nema svoje zastoupení v modulech");
      }
    }
  }

/**
 *
 * Administracni menu
 *
 * @return odkazy menu
 */
  public function AdminMenu()
  {
    $result =
    "
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}\" title=\"uvod adminu\">uvod adminu</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}\" title=\"kontrola aktualizaci\">kontrola aktualizaci</a><br />
    <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idzaloha}\" title=\"zaloha DB\" onclick=\"return confirm('Opravdu zalohovat databazi??');\">zaloha DB</a><br />
    ";

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
        case "":  //uvod adminu
          $result =
          "
            obsah uvod adminu<br />
            <br />
            výpis záloh databaze:<br />
            {$this->VypisZalohyDB()}
          ";
        break;

        case $this->idmodul:  //id modul
          $result = $this->KontrolaAktualizace();
        break;

        case "{$this->idmodul}{$this->idzaloha}": //zaloha
          $result = $this->ZalohovaniSQLiteDB();
        break;

        case "{$this->idmodul}{$this->iddelzal}": //smazani souboru zalohy
          $result = $this->SmazatSouborZalohy();
        break;

        case "{$this->idmodul}{$this->idupp}":  //uploadovani verzi
          $result = $this->UploadovatNovouVerzi();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Kontroluje aktualizace na repozitu
 *
 * @return formular s aktualizacema
 */
  private function KontrolaAktualizace()
  {
    if ($this->var->aktualizovat)
    {
      $moduly = $this->var->moduly;

      $moduly[count($moduly)] = array("include" => "promenne.php",
                                      "class" => "Promenne",
                                      "admin" => false,
                                      "databaze" => "");

      $moduly[count($moduly)] = array("include" => "config_promenne.php",
                                      "class" => "ConfigPromenne",
                                      "admin" => false,
                                      "databaze" => "");

      $result = "Datum aktualizace: ".date("d.m.Y / H:i:s");

      for ($i = 0; $i < count($moduly); $i++)
      {
        $nazev = $moduly[$i]["class"];
        $cesta = $moduly[$i]["include"];

        $soubor = basename($cesta); //soubor
        $adresar = dirname($cesta); //adresar
        $adresar = explode("/", $adresar);
        $adresar = (count($adresar) > 1 ? $adresar[1] : "kořen (./)");

        if (file_exists($cesta))
        {
          $velikost = filesize($cesta);  //$this->Velikost()
          $datum = filemtime($cesta); //datum na aktualnim webu, date("d.m.Y H:i:s", )
        }
          else
        {
          $datum = "Chybná cesta v konfiguraci modulu  - spatna cesta";
        }

        $zprava = $this->NactiUrl("{$this->var->depozitar}?{$this->get_check}={$cesta}");  //datum na depozitu s velikosti
        $zprava_velikost = explode("-_-", $zprava); //rozdeleni na datum a velikost

        $zprava_datum = $zprava_velikost[0];  //vraceni datumu zpravy
        $zprava_velikost = $zprava_velikost[1]; //vraceni velikosti

        if (!Empty($zprava_velikost))
        {
          if ($datum == $zprava_datum)  //stejne datumy
          {
            if ($velikost == $zprava_velikost)
            {
              $info = "aktuální verze";
            }
              else
            {
              $info = "aktuální verze - nesedí velikost <a href=\"{$this->var->depozitar}?{$this->get_download}={$cesta}&amp;{$this->get_zdrojstazeni}={$_SERVER["SERVER_NAME"]}\" title=\"sosnout\">sosnout</a> <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idupp}&amp;file={$cesta}\" title=\"upnout\">upnout</a>";
            }
          }
            else
          {
            if ($datum > $zprava_datum) //nove na tomto webu
            {
              if ($velikost == $zprava_velikost)
              {
                $info = "aktuálni verze - novější datum na tomto webu";
              }
                else
              {
                $info = "novější datum na tomto webu";
              }
            }
              else
            {
              if ($velikost == $zprava_velikost)
              {
                $info = "aktuálni verze - aktualni datum na depozitu";
              }
                else
              {
                $info = "novější datum na depozitu - nesedí velikost <a href=\"{$this->var->depozitar}?{$this->get_download}={$cesta}&amp;{$this->get_zdrojstazeni}={$_SERVER["SERVER_NAME"]}\" title=\"sosnout\">sosnout</a> <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->idupp}&amp;file={$cesta}\" title=\"upnout\">upnout</a>";
              }
            }
          }
        }
          else
        {
          $info = "Dotyčná verze neni na depozitu prozatím vložena";
        }

        settype($datum, "integer"); //konvert na cislo
        if (!Empty($datum))
        {
          $fun_dat = date("d.m.Y / H:i:s", $datum);
        }

        settype($zprava_datum, "integer"); //konvert na cislo
        if (!Empty($zprava_datum))
        {

          $dep_dat = date("d.m.Y / H:i:s", $zprava_datum);
        }

        $result .=
        "<p>
          {$nazev} ([{$adresar}] - {$soubor}) -<br /><strong>{$fun_dat} ({$this->Velikost($velikost)})</strong> || depozit: <strong>{$dep_dat} ".(!Empty($zprava_velikost) ? "({$this->Velikost($zprava_velikost)})" : "")."</strong> -<br />{$info}
          <br />
          <br />
        </p>";
      }
    }
      else
    {
      $result = "Aktualizace jsou vypnuty";
    }

    return $result;
  }

/**
 *
 * Upload nove verze modulu
 *
 * @return info o uploadovani
 */
  private function UploadovatNovouVerzi()
  {
    $soubor = $_GET["file"];
    chmod($soubor, 0777);
    chmod(dirname($soubor), 0777);

    $result =
    "
    <form method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return confirm('Opravdu aktualizovat tento modul: \'{$soubor}\' ??');\">
      <fieldset>
        modul (jen php): <input type=\"file\" name=\"modul\" /> <br />
        <input type=\"submit\" name=\"tlacitko\" value=\"Upgradovat\" />
      </fieldset>
    </form>
    ";

    $koncovka = explode(".", $_FILES["modul"]["name"]);

    if (!Empty($_FILES["modul"]["tmp_name"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($soubor) &&
        $_FILES["modul"]["name"] == basename($soubor) &&
        $koncovka[count($koncovka) - 1] == "php" &&
        file_exists($soubor) &&
        $soubor != "promenne.php" &&
        $soubor != "index.php" &&
        $soubor != ".htaccess")
    {
      if (move_uploaded_file($_FILES["modul"]["tmp_name"], $soubor))
      {
        $result = "modul: ''{$soubor}'' uspěšne aktualizován";
        chmod($soubor, 0777);

        $this->var->main[0]->AutoClick(2, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
      }
        else
      {
        $result = "Nastala chyba: ''{$_FILES["modul"]["error"]}''";
      }
    }
      else
    {
      if (!Empty($_FILES["modul"]["tmp_name"]))
      {
        if ($koncovka[count($koncovka) - 1] == "php")
        {
          $result = "Jiná koncovka";
        }

        if (file_exists($soubor))
        {
          $result = "Soubor neexistuje";
        }

        if ($soubor != "promenne.php" &&
            $soubor != ".htaccess")
        {
          $result = "Nepřípustné soubory";
        }

        if ($_FILES["modul"]["name"] == basename($soubor))
        {
          $result = "Nenahráváte kompatibilní soubor";
        }
      }
    }

    return $result;
  }

/**
 *
 * Vygenerovani menu adminu
 *
 * @return admin menu
 */
  public function GenerovaniAdminMenu()
  {
    $result = "";
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      $result .= ($this->var->moduly[$i]["admin"] ? (method_exists($this->var->moduly[$i]["class"], "AdminMenu") ? $this->var->main[$i]->AdminMenu() : "Modul menu z třídy: ''{$this->var->moduly[$i]["class"]}'' se nepodařilo načíst, aktualizujte jej prosím<br />") : "");
    }

    $result .= "<a href=\"?{$this->var->get_kam}=logoff\">(log off)</a>";

    return $result;
  }

/**
 *
 * Vygenerovani obsahu adminu
 *
 * @return admin obsah
 */
  public function GenerovaniAdminObsah()
  {
    $result = "";
    for ($i = 0; $i < count($this->var->moduly); $i++)
    {
      $result .= ($this->var->moduly[$i]["admin"] ? (method_exists($this->var->moduly[$i]["class"], "AdminObsah") ? $this->var->main[$i]->AdminObsah() : "Modul obsahu z třídy: ''{$this->var->moduly[$i]["class"]}'' se nepodařilo načíst, aktualizujte jej prosím<br />") : "");
    }

    return $result;
  }

/**
 *
 * Zazalohovani sqlite databazi
 *
 * @return odkaz na zip soubor
 */
  private function ZalohovaniSQLiteDB($autodown = true)
  {
    $result = "";

    if (!file_exists($this->zalohadir))
    {
      mkdir($this->zalohadir, 0777);
    }
    $cil = "{$this->zalohadir}/zaloha_db_".date("d-m-Y_H-i-s").".zip";

    $zip = new ZipArchive();
    if ($zip->open($cil, ZipArchive::CREATE) === true)
    {
      for ($i = 0; $i < count($this->var->moduly); $i++)
      {
        if ($this->var->moduly[$i]["admin"])  //pokud ma modul dazaba
        {
          $databaze = dirname($this->var->moduly[$i]["include"])."/".$this->var->moduly[$i]["databaze"];
          if (file_exists($databaze))
          {
            $zip->addFile($databaze);  //ulozi i se stejnou cestou!!
          }
        }
      }
      $zip->close();
    }

    if ($autodown)
    {
      header("Content-Description: File Transfer");
      header("Content-Type: application/force-download");
      header("Content-Disposition: attachment; filename=\"{$cil}\"");
      $result = readfile($cil); //vybydne ke stazeni
    }

    return $result;
  }

/**
 *
 * Stara se o automatcke zalohovani
 *
 */
  private function AutoZalohovani()
  {
    if ($this->autozaloha)
    {
      $cesta = $this->zalohadir;
      if (file_exists($cesta))
      {
        $handle = opendir($cesta);
        $i = 0;
        while($soub = readdir($handle))
        {
          if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
          {
            if (date("Y-m-d") == date("Y-m-d", filemtime("{$cesta}/{$soub}")))
            {
              $i++;
            }
          }
        }
        closedir($handle);

        if ($i == 0)
        {
          $this->ZalohovaniSQLiteDB(false); //pri prazdne slozce
        }
      }
        else
      {
        mkdir($this->zalohadir, 0777);  //vytvoreni a prvotni zalohovani
        $this->ZalohovaniSQLiteDB(false);
      }
    }
  }

/**
 *
 * Vypise obsah adresare zalohy
 *
 * @return seznam souboru
 */
  private function VypisZalohyDB()
  {
    $result = "";
    $cesta = $this->zalohadir;
    if (file_exists($cesta))
    {
      $handle = opendir($cesta);
      $i = 0;
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != ".." && filetype("{$cesta}/{$soub}") == "file")
        {
          $soubor[$i] = $soub;
          $i++;
        }
      }
      closedir($handle);

      if ($i == 0)
      {
        $result = "složka záloh je prázdná";
      }
        else
      {
        rsort($soubor);

        for ($i = 0; $i < count($soubor); $i++)
        {
          $velikost = $this->Velikost(filesize("{$cesta}/{$soubor[$i]}"));
          $datum = date("d.m.Y / H:i:s", filemtime("{$cesta}/{$soubor[$i]}"));

          $result .=
          "
          <a href=\"{$cesta}/{$soubor[$i]}\" >{$soubor[$i]}</a> {$datum} ({$velikost}) -
          <a href=\"?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}{$this->iddelzal}&amp;file={$soubor[$i]}\" onclick=\"return confirm('Opravdu smazat soubor: \'{$soubor[$i]}\' ??');\">smazat</a><br />
          ";
        }
      }
    }
      else
    {
      $result = "nenexistuje složka, musí se něco zálohovat a nebo vytvořt adresář: '{$cesta}'";
    }

    return $result;
  }

/**
 *
 * Smaze dany soubor ve slozce zalohy
 *
 * @return zprava o smazani
 */
  private function SmazatSouborZalohy()
  {
    $cesta = $_GET["file"];

    if (file_exists("{$this->zalohadir}/{$cesta}"))
    {
      $result = (unlink("{$this->zalohadir}/{$cesta}") ? "soubor: '{$cesta}' byl smazán" : "něco se pokazilo");

      $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}");  //auto kliknuti
    }
      else
    {
      $result = "cesta neexistuje";

      $this->var->main[0]->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}");  //auto kliknuti
    }

    return $result;
  }

/**
 *
 * Funkce se pokusí stáhnout danou url stránku
 *
 * pouziti: <strong>$url = $this->var->main[0]->NactiFunkci("Funkce", "NactiUrl", "www.url.cz");</strong>
 *
 * @param url www adresa
 * @return stranka v promenne
 */
  public function NactiUrl($url)
  {
    $url = str_replace("http://", "", $url);
    if (preg_match("#/#","{$url}"))
    {
      $page = $url;
      $url = @explode("/",$url);
      $url = $url[0];
      $page = str_replace($url,"",$page);
      if (!$page || $page == "")
      {
        $page = "/";
      }
      $ip = gethostbyname($url);
    }
      else
    {
      $ip = gethostbyname($url);
      $page = "/";
    }

    if ($open = @fsockopen($ip, 80, $errno, $errstr, 60))
    {
      $send .= "GET {$page} HTTP/1.0\r\n";
      $send .= "Host: {$url}\r\n";
      $send .= "Accept-Language: en-us, en;q=0.50\r\n";
      $send .= "User-Agent: {$_SERVER["HTTP_USER_AGENT"]}\r\n";
      $send .= "Connection: Close\r\n\r\n";

      fputs($open, $send);
      $return = "";
      while (!feof($open))
      {
        $return .= fgets($open, 4096);
      }
      fclose($open);

      $ret = @explode("\r\n\r\n", $return, 2);
      //$header = $ret[0]; //header
      $result = $ret[1]; //body
    }
      else
    {
      $this->ErrorMsg("Chyba připojení k portu 80, cislo: {$errno}, duvod: {$errstr}");
      $result = NULL;
    }
    //$result = file_get_contents($url);

    return $result;
  }

/**
 *
 * Kontrola emailu pres regularni vyraz
 *
 * pouziti: <strong>$email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", "email@email.cz");</strong>
 *
 * @param email text na zkontrolovani
 * @return je-li vyraz v poradku vrati jeho hodnotu
 */
  public function KontrolaEmailu($email)
  {
    $regular = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
    preg_match($regular, $email, $ret);
    $result = $ret[0];  //vybere nulty index

    return $result;
  }

/**
 *
 * Kontroluje zda dana url adresa existuje
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "ExsteneUrl", "www.neco.cz") ? "existuje" : "neexistuje")."</strong>
 *
 * @param url www adresa
 * @return true/false - existuje / neexistuje
 */
  public function ExistenceUrl($url)
  {
    if (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok))
    {
      $a = get_headers($url);
      $b = explode(" ", $a[0]);

      if ($b[1] == 200) //kdyz existuje je 200
      {
        $result = true;
      }
        else
      {
        $result = false;
      }
    }
      else
    {
      $result = true;
    }

    return $result;
  }

/**
 *
 * Provadi prihlaseni do adminu
 *
 */
  private function Prihlasovani()
  {
    if ($this->var->klenot)  //prepnuti pro ziskani dat z klenot
    {
      list($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]) = explode(":", base64_decode(substr($_SERVER["REDIRECT_REMOTE_USER"], 6)));
    }

    if ($_GET[$this->var->get_kam] == "logoff")
    {
      $_SERVER["PHP_AUTH_USER"] = "";
      $_SERVER["PHP_AUTH_PW"] = "";
      header("WWW-Authenticate: Basic realm=\"vychozi layout\"");
      header("HTTP/1.0 401 Unauthorized");
      $this->AutoClick(0, "./");
    }

    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu)
    {
      if (!$this->Autorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
      {
        header("WWW-Authenticate: Basic realm=\"vychozi layout\"");
        header("HTTP/1.0 401 Unauthorized");

        $this->var->aktivniadmin = false;
        $this->AutoClick(0, "./");
      }
        else
      {
        if ($this->Autorizace($_SERVER["PHP_AUTH_USER"], $_SERVER["PHP_AUTH_PW"]))
        {
          $this->var->aktivniadmin = true;
        }
          else
        {
          $this->var->aktivniadmin = false;
        }
      }
    }
  }

/**
 *
 * Overeni hesla do administrace
 *
 * @param login: login admina
 * @param heslo: heslo admina
 * @return povoleno/zamitnuto - true/false
 */
  private function Autorizace($login, $heslo)
  {
    $result = ($this->var->adminpristup[$login] == md5(md5($heslo)) ? true : false);

    return $result;
  }

/**
 *
 * Vraceni odpocitavaneho casu pro vypocet delky provaden skryptu
 *
 * @return cas stopek v ms
 */
  private function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $soucet = $cas[1] + $cas[0];

    return $soucet;
  }

/**
 *
 * Zacatek odpocitavani
 *
 */
  public function StartCas() //zapis začátku
  {
    $this->start = $this->MeritCas();
  }

/**
 *
 * Konec odpocitavani
 *
 * @return cas v sec.
 */
  public function KonecCas()
  {
    $this->konec = $this->MeritCas();
    $cas = Abs(Round(($this->konec - $this->start) * 10000) / 10000); //Abs, výpočet

    return $cas;
  }

/**
 *
 * Prechod o pocet stranek zpet
 *
 * pouziti: <strong>$odkaz = $this->var->main[0]->NactiFunkci("Funkce", "OdkazZpet", "text1", 1);</strong>
 *
 * @param zpet pocet kroku koli ma udelat zpet
 * @return odkaz v html
 */
  public function OdkazZpet($text = "O úroveň nazpět", $zpet = 1) //vracec historie
  {
    $result = "<a href=\"javascript:history.back(-{$zpet});\">{$text}</a>";

    return $result;
  }

/**
 *
 * Vypis chyby v html
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("Funkce", "ErrorMsg", "text chyby", "text odkazu zpet");</strong>
 *
 * @param chyba text chyby
 * @return chyby interpretovana v html kodu
 */
  public function ErrorMsg($chyba, $zpet_odkaz = "O úroveň nazpět")  //proecdura chybove hlasky
  {
    $this->var->chyba =
    "
<div id=\"centralni_chyba\">
  <p>
    Vyskytla se chyba:
  </p>
  <p>
    <strong>{$chyba}</strong>
  </p>
  {$this->OdkazZpet($zpet_odkaz)}
</div>
    ";
  }

/**
 *
 * Meta refresh
 *
 * pouziti: <strong>$this->var->main[0]->NactiFunkci("Funkce", "AutoClick", 1, "url");</strong>( 1[ms] )
 *
 * @param cas doba aktualizace
 * @param cesta cilova cesta presmerovani
 * @return prislusne nastaveny meta tag
 */
  public function AutoClick($cas, $cesta)  //auto kliknuti, procedura
  {
    $this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }

/**
 *
 * Zjisteni a vypsani typu OS
 *
 * pouziti: <strong>$os = $this->var->main[0]->NactiFunkci("Funkce", "TypOS", $_SERVER["HTTP_USER_AGENT"]);</strong>
 *
 * @param agent agent z $_SERVER["HTTP_USER_AGENT"]
 * @return typ OS
 */
  public function TypOS($agent)
  {
    $OSList = array("Windows 3.11" => "/Win16/i",
                    "Windows 95" => "/(Windows.95)|(Win95)/i",
                    "Windows 98" => "/(Windows.98)|(Win98)/i",
                    "Windows 2000" => "/(Windows NT 5\.0)|(Windows 2000)/i",
                    "Windows XP" => "/(Windows NT 5\.1)|(Windows XP)/i",
                    "Windows XP x64" => "/((Windows NT 5\.2).*(Win64))|((Win64).*(Windows NT 5\.2))/i",
                    "Windows Server 2003" => "/Windows NT 5\.2/i",
                    "Windows Vista" => "/Windows NT 6\.0/i",
                    "Windows 7" => "/Windows NT 7\.0/i",
                    "Windows NT 4.0" => "/(Windows NT 4\.0)|(WinNT4\.0)|(WinNT)|(Windows NT)/i",
                    "Windows ME" => "/(Windows ME)|(Win 9x 4\.90)/i",
                    "Microsoft PocketPC" => "/((Windows CE).*(PPC))|((PPC).*(Windows CE))/i",
                    "Microsoft Smartphone" => "/((Windows CE).*(smartphone))|((smartphone).*(Windows CE))/i",
                    "Windows CE" => "/Windows CE/i",
                    "Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "Sharp Zaurus \\1" => "/Zaurus ([a-zA-Z0-9\.]+)/i",
                    "Zaurus" => "/Zaurus/i",
                    "Symbian OS" => "/Symbian/i",
                    "Sony Clie" => "#PalmOS/sony/model#i",
                    "Series \\1" => "/Series ([0-9]+)/i",
                    "Nokia \\1" => "/Nokia ([0-9]+)/i",
                    "Siemens \\1" => "/SIE-([a-zA-Z0-9]+)/i",
                    "Dopod \\1" => "/dopod([a-zA-Z0-9]+)/i",
                    "O2 XDA \\1" => "/o2 xda ([a-zA-Z0-9 ]+);/i",
                    "Samsung \\1" => "/SEC-([a-zA-Z0-9]+)/i",
                    "SonyEricsson \\1" => "/SonyEricsson ?([a-zA-Z0-9]+)/i",
                    "Nintendo Wii" => "/Wii/i",
                    "Bot" => "/(crawler)|(Mediapartners-Google)|(Jyxobot)|(morfeo.centrum.cz)|(Gigabot)|(ASAP-LynxViewer)|(ASAP-Web-Sniffer)|(EARTHCOM.info)|(Mozdex)|(SeznamBot)|(Speedy Spider)|(Yahoo! Slurp)|(ZACATEK_CZ_BOT)|(www.yacy.net)|(Googlebot)|(Openbot)|(MSNBot)|(del.icio.us-thumbnails)|(Exabot)|(findlinks)|(Bot,Robot,Spider)/i",
                    "Neznámý" => "/(.*)/");

    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return trim($os);
  }

/**
 *
 * Zjisteni a vypsani typu Browseru
 *
 * pouziti: <strong>$browser = $this->var->main[0]->NactiFunkci("Funkce", "TypBrowseru", $_SERVER["HTTP_USER_AGENT"]);</strong>
 *
 * @param agent agent z $_SERVER["HTTP_USER_AGENT"]
 * @return typ Browseru
 */
  public function TypBrowseru($agent)
  {
    $BrowserList = array ("Internet Explorer \\1" => "#MSIE ([a-zA-Z0-9\.]+)#i",
                          "Mozilla Firefox \\2" => "#(Firefox|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
                          "Flock \\1" => "#Flock/([a-zA-Z0-9\.]+)#i",
                          "Epiphany \\1" => "#Epiphany/([a-zA-Z0-9\.]+)#i",
                          "Konqueror \\1" => "#Konqueror/([a-zA-Z0-9\.]+)#i",
                          "Maxthon \\1" => "#Maxthon ?([a-zA-Z0-9\.]+)?#i",
                          "K-Meleon \\1" => "#K-Meleon/([a-zA-Z0-9\.]+)#i",
                          "Lynx \\1" => "#Lynx/([a-zA-Z0-9\.]+)#i",
                          "Links \\1" => "#Links .{2}([a-zA-Z0-9\.]+)#i",
                          "ELinks \\3" => "#ELinks([/ ]|(.{2}))([a-zA-Z0-9\.]+)#i",
                          "Debian IceWeasel \\1" => "#(iceweasel)/([a-zA-Z0-9\.]+)#i",
                          "Mozilla SeaMonkey \\1" => "#(SeaMonkey)/([a-zA-Z0-9\.]+)#i",
                          "OmniWeb" => "#OmniWeb#i",
                          "Mozilla \\1" => "#^Mozilla/5\.0.*rv:([a-zA-Z0-9\.]+).*#i",
                          "Netscape Navigator \\1" => "#^Mozilla/([a-zA-Z0-9\.]+)#i",
                          "PHP" => "/PHP/i",
                          "SymbianOS \\1" => "#symbianos/([a-zA-Z0-9\.]+)#i",
                          "Avant Browser" => "/avantbrowser\.com/i",
                          "Camino \\1" => "#(Camino|Chimera)[ /]([a-zA-Z0-9\.]+)#i",
                          "Anonymouse" => "/anonymouse/i",
                          "Danger HipTop" => "/danger hiptop/i",
                          "W3M \\1" => "#w3m/([a-zA-Z0-9\.]+)#i",
                          "Shiira \\1" => "#Shiira[ /]([a-zA-Z0-9\.]+)#i",
                          "Dillo \\1" => "#Dillo[ /]([a-zA-Z0-9\.]+)#i",
                          "Openwave UP.Browser \\1" => "#UP.Browser/([a-zA-Z0-9\.]+)#i",
                          "DoCoMo \\1" => "#DoCoMo/(([a-zA-Z0-9\.]+)[/ ]([a-zA-Z0-9\.]+))#i",
                          "Unbranded Firefox \\1" => "#(bonecho)/([a-zA-Z0-9\.]+)#i",
                          "Kazehakase \\1" => "#Kazehakase/([a-zA-Z0-9\.]+)#i",
                          "Minimo \\1" => "#Minimo/([a-zA-Z0-9\.]+)#i",
                          "MultiZilla \\1" => "#MultiZilla/([a-zA-Z0-9\.]+)#i",
                          "Sony PSP \\2" => "/PSP \(PlayStation Portable\)\; ([a-zA-Z0-9\.]+)/i",
                          "Galeon \\1" => "#Galeon/([a-zA-Z0-9\.]+)#i",
                          "iCab \\1" => "#iCab/([a-zA-Z0-9\.]+)#i",
                          "NetPositive \\1" => "#NetPositive/([a-zA-Z0-9\.]+)#i",
                          "NetNewsWire \\1" => "#NetNewsWire/([a-zA-Z0-9\.]+)#i",
                          "Opera Mini \\1" => "#opera mini/([a-zA-Z0-9]+)#i",
                          "WebPro \\2" => "#WebPro(/([a-zA-Z0-9\.]+))?#i",
                          "Netfront \\1" => "#Netfront/([a-zA-Z0-9\.]+)#i",
                          "Xiino \\1" => "#Xiino/([a-zA-Z0-9\.]+)#i",
                          "Blackberry \\1" => "#Blackberry([0-9]+)?#i",
                          "Orange SPV \\1" => "#SPV ([0-9a-zA-Z\.]+)#i",
                          "LG \\1" => "#LGE-([a-zA-Z0-9]+)#i",
                          "Motorola \\1" => "#MOT-([a-zA-Z0-9]+)#i",
                          "Nokia \\1" => "#Nokia ?([0-9]+)#i",
                          "Nokia N-Gage" => "#NokiaN-Gage#i",
                          "Blazer \\1" => "#Blazer[ /]?([a-zA-Z0-9\.]*)#i",
                          "Siemens \\1" => "#SIE-([a-zA-Z0-9]+)#i",
                          "Samsung \\4" => "#((SEC-)|(SAMSUNG-))((S.H-[a-zA-Z0-9]+)|([a-zA-Z0-9]+))#i",
                          "SonyEricsson \\1" => "#SonyEricsson ?([a-zA-Z0-9]+)#i",
                          "J2ME/MIDP Browser" => "#(j2me|midp)#i",
                          "Neznámý" => "/(.*)/");

    foreach($BrowserList as $browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if (!Empty($matches))
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $browser = str_replace("\\{$i}", $matches[$i], $browser);
          }
        }
        break;
      }
    }

    return trim($browser);
  }

/**
 *
 * Detekce linuxu
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ? "je to linux" : "je to mrkvosoft")."</strong>
 *
 * @return jsou to linuxy / nejsou to linuxy - true(linux) / false(MS)
 */
  public function DetekceLinuxu()
  {
    $OSList = array("Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return (!Empty($os) ? true : false);
  }

/**
 *
 * Detekce opery
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceOpery") ? "je to opera" : "je to coloki jineho")."</strong>
 *
 * @return je to opera / neni to opera - true(opera) / false(jiny)
 */
  public function DetekceOpery()
  {
    $OSList = array("Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                    "" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return (!Empty($os) ? true : false);
  }

/**
 *
 * Stara se instalaci databaze
 *
 */
  private function Instalace()  //instalace databaze
  {
    //
  }

/**
 *
 * Prepocet velikosti
 *
 * pouziti: <strong>$velikost = $this->var->main[0]->NactiFunkci("Funkce", "Velikost", filesize($soubor));</strong>
 *
 * @param size zmerena velikost
 * @return prepocitana velikost
 */
  public function Velikost($size)  //vypocet velikosti souboru
  {
    $symbol = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

    $exp = 0;
    $converted_value = 0;
    if ($size > 0)
    {
      $exp = floor(log($size) / log(1024));
      $converted_value = ($size / pow(1024, floor($exp)));
    }

    $result = sprintf("%.2f {$symbol[$exp]}", $converted_value);

    return $result;
  }

/**
 *
 * Strankuje hlavni vypis, definovano na promenny pocet stranek, radkove strankovani, eshop ma vlastni kvuli radkovani do tabulky
 *
 * pouziti: <strong>list($str, $limit) = $this->var->main[0]->NactiFunkci("Funkce", "Strankovani", 10, $pocet_radku, "moje_adresa", "limit");</strong>
 *
 * @param na_stranku cislo urcujici pocet polozek na stranku
 * @param pocet_radku pocet radku (polozek) v cele databazi (ci dane sekci!!)
 * @param adresa text adresy pro maximalni zachovani funkcnosti odkazu
 * @param typ urcuje typ vystupu pres parametr limit - limit/array
 * @return [0]=>strankovaci odkazy; typ=limit,[1]=>dotaz do databaze pro dany vypis polozek; typ=array,[1]=>pole minimum a maximum
 */
  public function Strankovani($na_stranku, $pocet_radku, $adresa, $typ)
  {
    $strana = $_GET["str"];
    settype($strana, "integer");

    settype($na_stranku, "integer");
    $pocetstran = ceil($pocet_radku / $na_stranku);  //vypocteny pocet stran podle strankovani

    settype($strana, "integer");
    $mezai = false;
    if ($pocetstran > 7)
    {
      for ($i = 0; $i < 3; $i++)  //prvni trojicka
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana != 0)  //predchozi
        {
          $prev = $strana - $na_stranku;
          $jdi .= "<a href=\"{$adresa}&amp;str={$prev}\" title=\"\">předchozí</a> ";
        }

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }
      }

      if (($strana / $na_stranku) >= 2 && ($strana / $na_stranku) <= ($pocetstran - 3))
      {
        $mezi = true;
      }
        else
      {
        $jdi .= "..., ";
      }

      for ($i = $pocetstran - 3; $i < $pocetstran; $i++)  //posledni trojicka
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky
          $next = $strana + $na_stranku;
          $jdi .= " <a href=\"{$adresa}&amp;str={$next}\" title=\"\">další</a>, ";
        }
      }
    }
      else
    {
      for ($i = 0; $i < $pocetstran; $i++)
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana != 0)  //predchozi
        {
          $prev = $strana - $na_stranku;
          $jdi .= "<a href=\"{$adresa}&amp;str={$prev}\" title=\"\">předchozí</a> ";
        }

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky

          $next = $strana + $na_stranku;
          $jdi .= " <a href=\"{$adresa}&amp;str={$next}\" title=\"\">další</a>, ";
        }
      }
    }

    if ($mezi)
    {
      $prev = $strana - $na_stranku;  //predchozi
      $pred = "<a href=\"{$adresa}&amp;str={$prev}\" title=\"\">předchozí</a> ";

      $i = 0;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi = "{$pred}<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ..., ";

      $i = ($strana / $na_stranku) - 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";

      $i = ($strana / $na_stranku);
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "{$poc}</a>, ";

      $aktualni = $poc; //prostedni clen

      $i = ($strana / $na_stranku) + 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ..., ";

      $i = $pocetstran - 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";

      $jdi = substr($jdi, 0, -2); //odebrani carky
      $next = $strana + $na_stranku;  //dalsi
      $jdi .= " <a href=\"{$adresa}&amp;str={$next}\" title=\"\">další</a>, ";
    }

    $jdi = substr($jdi, 0, -2); //odebrani carky

    $result[0] =
    "
    <div id=\"strankovani\">
      {$jdi}
      <p id=\"vpravo\">
        Strana: {$aktualni} z {$pocetstran}
      </p>
    </div>
    ";

    switch ($typ)
    {
      case "limit":
        $result[1] = "LIMIT {$strana}, {$na_stranku}"; //dodatecny dotaz do DB
      break;

      case "array":
        $result[1][0] = $strana;
        $result[1][1] = $strana + $na_stranku;
      break;
    }

    return $result;
  }

/**
 *
 * Prepisuje obycejnou adresu pro htaccess format - testovaci provoz
 *
 * @param adresa vstupni adresa
 * @return url pripravena pro hraccess
 */
  public function PrepisAdresy($adresa)
  {
    $search = array_keys($this->var->prepis_pravidla);
    $replace = array_values($this->var->prepis_pravidla);

    $result = str_replace($search, $replace, $adresa);

    return $result;
  }

/**
 *
 * Prepisuje zpet textovou adresu do neupravene - testovaci provoz
 *
 * @param adresa vstupni adresa
 * @return url adresa shodna s nazevem
 */
  public function ZpetnyPrepisAdresy($adresa)
  {
    $search = array_values($this->var->prepis_pravidla);
    $replace = array_keys($this->var->prepis_pravidla);

    $result = str_replace($search, $replace, $adresa);

    return $result;
  }
}
?>
