<?php

//jinak!!!!!!!!!!
//nadefinovani konstant pro databaze
define("NODATA", 0);
define("SQLITE", 1);
define("MYSQLI", 2);
define("SQLITE3", 3); //jeste jinak!

/**
 *
 * AutoLoad - nacitani vlozenych php class-u
 *
 * @param name nazev tridy ktera se vklada
 */
function __autoload($name)
{ //prevede na mala pismena a sahne do dotycne slozky
  $nazev = strtolower($name);
  $vyjimka = array("Promenne", "Funkce"); //pokud je modul z vyjimky nacte se z korenu
  $cesta = (in_array($name, $vyjimka) ? "{$nazev}.php" : "class/{$nazev}.php");
  if (file_exists($cesta))
  { //nacte pozadovanou cestu
    include_once $cesta;
  }
    else
  {
    echo "Trida: <strong>{$name}</strong> neexistuje mezi pripojovanyma modulama!";
    exit(1);
  }
}

/**
 *
 * Blok defaultniho dynamickeho modulu
 *
 */

class DefaultModule //extends subclass
{
  private $adresa_menu, $typdb, $ukazatel, $var, $trida,
          $cesta, $newcesta, $nazvydb, $pripojeno, $admin_user_id,
          $start, $konec, $dbpredpona, $pathdb, $realyclass, $idukazatel;

  //private $db;
//$db[$db->id]
  private $kodroz = "0-0";
  private $dedicne = ".duplikatni"; //nazev (predpona) duplikatnich unikatnich
  private $nahproc = "%%";

  //slozka na databaze s logovanim akci
  public $diractlog = "actlog";
  //slozka session logu
  public $dirsession = "seslog";
  //slozka cache
  public $dircache = "cache";
  private $cacheurl = ".cacheurl";

  public $permexplode = "|--x|x--|";

/**
 *
 * Nastaveni komunikace s databazi
 *
 * @param &var predani hlavnich promennych
 * @param index cislo modulu v poli modulu, nebo pole jednoho daneho modulu
 * @param ajax defaultne: false - normalne s pathem, pri true nedosazuje path do cesty
 * @param id cislo id ukazatele, umoznuje pripojit se vicekrat do db v jednom modulu, def = 0
 * @param autocon bool priznak auto pripojovani
 * @return vrati nazev predpony dle typu databaze
 */
  public function NastavKomunikaci(&$var, $index, $ajax = false, $id = 0, $autocon = false)
  {
    $this->var = $var;
    //pokud je id nenulllove tak nastavi id jinak nulu
    $this->idukazatel = (!is_null($id) ? $id : 0);  //nastavuje id pripojeni
    settype($ajax, "boolean");  //konvert na bool
    //pokud je index cislo modulu
    if (is_numeric($index))
    {
      if (!Empty($this->var->moduly[$index]["uloziste"])) //pokud ma modul databazi
      {
        $this->typdb[$this->idukazatel] = $this->var->moduly[$index]["uloziste"];  //$uloziste;
        $this->trida[$this->idukazatel] = strtolower($this->var->moduly[$index]["class"]);  //jako predpona do databaze pro tabulky, musi byt lower! $class
        $this->pathdb[$this->idukazatel] = dirname($this->var->moduly[$index]["include"]); //path cesty k databazi
        $this->cesta[$this->idukazatel] = ($ajax ? $this->var->moduly[$index]["databaze"] : "{$this->pathdb[$this->idukazatel]}/{$this->var->moduly[$index]["databaze"]}");
      }
      $this->realyclass[$this->idukazatel] = strtolower($this->var->moduly[$index]["class"]);  //nacita skutecnou tridu
    }
    //pokud je index pole jednoho modulu
    if (is_array($index))
    {
      if (!Empty($index["uloziste"])) //pokud ma modul databazi
      {
        $this->typdb[$this->idukazatel] = $index["uloziste"];
        $this->trida[$this->idukazatel] = strtolower($index["class"]);
        $this->pathdb[$this->idukazatel] = dirname($index["include"]);
        $this->cesta[$this->idukazatel] = ($ajax ? $index["databaze"] : "{$this->pathdb[$this->idukazatel]}/{$index["databaze"]}");
      }
      $this->realyclass[$this->idukazatel] = strtolower($index["class"]);  //nacita skutecnou tridu
    }
    //pokud index neni ani cislo a ani pole
    if (!is_numeric($index) &&
        !is_array($index))
    {
      $this->ErrorMsg("Nenalezen hledany modul!!", array(__LINE__, __METHOD__));
    }

    $this->newcesta[$this->idukazatel] = "{$this->cesta[$this->idukazatel]}.mysqli";
//var_dump($this->typdb, $this->trida, $this->pathdb, $this->cesta, $this->newcesta);
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = "";
      break;

      case "mysqli":  //v pripade mysqli prida nazev tridy
        $result = "{$this->trida[$this->idukazatel]}_";
      break;
    }
    //nastavi predponu dle typu databaze pro aktualni modul
    $this->dbpredpona[$this->idukazatel] = $result;
    //pokud je povolene auto pripojovani
    if ($autocon)
    {
      $this->PripojeniDatabaze();
    }

    return $result; //vrati predponu pro pripojme moduly
  }

/**
 *
 * Vrati aktualni typ nastavene databaze
 *
 * @param aktualni vybere pouze aktualni typ
 * @return typ databaze
 */
  public function ZjistiTypDB($aktualni = false)
  {
    $result = "";
    switch ($aktualni)
    {
      case true:
        $result = $this->typdb[$this->idukazatel];
      break;

      case false:
        $result = $this->typdb;
      break;
    }

    return $result;
  }

/**
 *
 * Vrati aktualni pracovni cestu
 *
 * @param aktualni vybere pouze aktualni cestu
 * @return cesta
 */
  public function ZjistiCestu($aktualni = false)
  {
    $result = "";
    switch ($aktualni)
    {
      case true:
        $result = $this->cesta[$this->idukazatel];
      break;

      case false:
        $result = $this->cesta;
      break;
    }

    return $result;
  }

/**
 *
 * Nastavuje natvrdo cestu do sqlite databaze pro aktualni spojeni
 *
 * @param cesta cesta co se ma nastavit
 */
  public function NastavCestu($cesta)
  {
    $this->cesta[$this->idukazatel] = $cesta;
  }

/**
 *
 * Vrati pracovni tridu
 *
 * @param aktualni vybere pouze aktualni tridu
 * @return trida
 */
  public function ZjistiClass($aktualni = false)
  {
    $result = "";
    switch ($aktualni)
    {
      case true:
        $result = $this->trida[$this->idukazatel];
      break;

      case false:
        $result = $this->trida;
      break;
    }

    return $result;
  }

/**
 *
 * Vrati realnou tridu
 *
 * @param aktualni vybere pouze aktualni tridu
 * @return trida
 */
  public function ZjistiRealClass($aktualni = false)
  {
    $result = "";
    switch ($aktualni)
    {
      case true:
        $result = $this->realyclass[$this->idukazatel];
      break;

      case false:
        $result = $this->realyclass;
      break;
    }

    return $result;
  }

/**
 *
 * Vrati ukazatel databaze
 *
 * @param aktualni vybere pouze aktualni ukazatel
 * @return ukazatel na db
 */
  public function ZjistiUkazatel($aktualni = false)
  {
    $result = "";
    switch ($aktualni)
    {
      case true:
        $result = $this->ukazatel[$this->idukazatel];
      break;

      case false:
        $result = $this->ukazatel;
      break;
    }

    return $result;
  }

/**
 *
 * Vrati bool jestli je databaze pripojena
 *
 * @param aktualni vybere pouze aktualni pripojeni
 * @return bool pripojeni
 */
  public function ZjistiConnection($aktualni = false)
  {
    $result = "";
    switch ($aktualni)
    {
      case true:
        $result = $this->pripojeno[$this->idukazatel];
      break;

      case false:
        $result = $this->pripojeno;
      break;
    }

    return $result;
  }

/**
 *
 * Vrati aktualni cislo indexu ukazatele
 *
 * @return index ukazatele
 */
  public function ZjistiIdUkazatel()
  {
    return $this->idukazatel;
  }

/**
 *
 * Pripoji databazi podle typu uloziste
 *
 * uzavira se ve funkci: VypisVsechnyChyby()
 *
 * @param &error text chyby
 * @return bool - pripojilo/nepripojilo
 */
  public function PripojeniDatabaze(&$error = NULL)
  {
//jeste by bylo nejlepsi oddelit spravu databazi od samotneho defaultu
//za dalsi by se jeste mela udelat stranka ktera bude potrebne moduly propojovat
//aby umela propojovat treba imagic a tady tu obsluhu databazi
//nebo aby to tu melo minimalne autoload...
//pripadne do ext slozky tadat tady potrebne php tridy
//ale asi jo .. prijde sem autoload?!
    $result = false;
    if ($this->trida[$this->idukazatel] == $this->realyclass[$this->idukazatel])  //porovnani nacitane a skutecne tridy
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
//dodelat!! pripat podporu pdo!!! (pdo zvladne sqlite3, mysql)
//sqlite:nazevsouboru
//mysql:host=localhost;port=3307;dbname=testdb
        case "sqlite":  //soubor, :memory:
          $path = dirname($this->cesta[$this->idukazatel]);

          if (file_exists($this->cesta[$this->idukazatel]) &&  //stryktni osetreni zapisovatelnosti
              is_file($this->cesta[$this->idukazatel]) &&  //je-li to soubor
              is_writable($this->cesta[$this->idukazatel]) &&  //da se zapisovat do cesty
              is_writable($path)) //zapisovat do pathe
          { //idealni stav, prime pripojeni
            if ($this->ukazatel[$this->idukazatel] = @new SQLiteDatabase($this->cesta[$this->idukazatel], 0777, $error))
            {
              $result = true;
            }
              else
            {
              $this->ErrorMsg($error, array(__LINE__, __METHOD__));
              $result = false;
            }
          }
            else
          {
            //pokud neexistuje a jde zapisovat do slozky, pokusi se vytvorit
            if (!file_exists($this->cesta[$this->idukazatel]) &&
                is_writable($path))
            {
              if (!$this->ukazatel[$this->idukazatel] = @new SQLiteDatabase($this->cesta[$this->idukazatel], 0777, $error))
              {
                $this->ErrorMsg($error, array(__LINE__, __METHOD__));
                $result = false;
              }
                else
              {
                $result = true;
              }
            }
            //kdyz nelze zapisovat do pathu
            if (!is_writable($path))
            {
              $this->ErrorMsg("Nelze zapisovat data do: {$path}", array(__LINE__, __METHOD__));
              $result = false;
            }
            //musi se dat zapsat do databaze
            if (!is_writable($this->cesta[$this->idukazatel])) //kdyz nelze zapisovat
            {
              $this->ErrorMsg("Nelze zapisovat data do SQLite databaze: {$this->cesta[$this->idukazatel]}", array(__LINE__, __METHOD__));
              $result = false;
            }
          }

          $this->pripojeno[$this->idukazatel] = $result;
        break;

        case "mysqli":  //MyISAM (obyc, neumi cisty transaction ,ale zamknout se da: START TRANSACTION/COMMIT), InnoDB (doporucena), MEMORY (pamet), ARCHIVE (logy)
        //mysql_dbname, mysql_host, mysql_user, mysql_pass, mysql_port
          $this->ukazatel[$this->idukazatel] = @new mysqli($this->DekodujText($this->var->mysql_host),
                                                          $this->DekodujText($this->var->mysql_user),
                                                          $this->DekodujText($this->var->mysql_pass),
                                                          $this->DekodujText($this->var->mysql_dbname),
                                                          $this->var->mysql_port);

          if ($this->ukazatel[$this->idukazatel]->connect_errno == 0)  //je-li 0 chyb
          {
            if ($this->ukazatel[$this->idukazatel]->set_charset("utf8")) //nastaveni kodovani
            {
              $result = true;
            }
              else
            {
              $this->ErrorMsg($this->ukazatel[$this->idukazatel]->error, array(__LINE__, __METHOD__));
              $result = false;
            }
          }
            else
          {
            $this->ErrorMsg($this->ukazatel[$this->idukazatel]->connect_error, array(__LINE__, __METHOD__));
            $result = false;
          }

          $this->pripojeno[$this->idukazatel] = $result;
        break;
      }
    }
      else
    {
      $this->ErrorMsg("Nelze připojit modul bez databáze!!", array(__LINE__, __METHOD__));
      $this->ukazatel[$this->idukazatel] = NULL;
    }

    return $result;
  }

/**
 *
 * Vrati se zpet k puvodnimu id a nebo prejde na jine id pripojeni
 *
 * pouziti:
 * $this->dbpredpona = $this->NavratPripojeni();
 *
 * @param id nastavi nove id ukazatele, def = 0
 * @return vrati puvodni predponu
 */
  public function NavratPripojeni($id = 0)
  {
    //$this->ZavritDatabaze();  //zavre aktualni session a nastavi novy id

    $this->idukazatel = $id;  //nastavy novy id

    $result = $this->NotEmpty($this->dbpredpona, $this->idukazatel);
    //$this->dbpredpona[$this->idukazatel];  //vraceni puvodni predpony

    return $result;
  }

/**
 *
 * Vrati pole tabulek aktualniho pripojeni
 *
 * @param &error text chybove hlasky, nepovinne
 * @return pole tabulek aktualniho indexu
 */
  public function GetTable(&$error = NULL)
  {
    $result = false;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          if ($res = @$this->ukazatel[$this->idukazatel]->query("SELECT name FROM sqlite_master WHERE type='table';", NULL, $error))
          {
            while ($data = $res->fetchObject())
            {
              $result[] = $data->name;
            }
          }
        break;

        case "mysqli":
          $dbname = $this->var->main[0]->DekodujText($this->var->mysql_dbname);
          $sqlname = "Tables_in_{$dbname}";

          if ($res = @$this->ukazatel[$this->idukazatel]->query("SHOW TABLES WHERE `Tables_in_{$dbname}` LIKE('{$this->trida[$this->idukazatel]}_%')"))
          {
            while ($data = $res->fetch_object())
            {
              $result[] = $data->$sqlname;
            }
          }
            else
          {
            $error = $this->ukazatel[$this->idukazatel]->error;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati pole sloupcu tabulky aktualniho pripojeni
 *
 * @param tabulka nazev tabulky ze ktere ma zjistit sloupce
 * @param all zapina zobrazeni vsecho, defaultne zobrazuje jen nazvy
 * @param &error text chybove hlasky, nepovinne
 * @return pole sloupcu tabulky aktualniho indexu
 */
  public function GetColumnTable($table, $all = false, &$error = NULL)
  {
    settype($all, "boolean");
    $result = false;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          if ($res = @$this->ukazatel[$this->idukazatel]->query("SELECT sql FROM sqlite_master WHERE type='table' AND name='{$table}';", NULL, $error))
          {
            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject()->sql; //nacteni create dotazu
              $a = explode("{$table} (", $data); //parsrovani hodnot
              $b = explode(",", $a[1]); //rozdeleni na radky
              //projiti radku rozdelenych podle ','
              foreach ($b as $index => $polozky)
              {
                //odstraneni zbytecnych mezer a rozdeleni podle " "
                $row = str_replace(array("))"), array(")"), ltrim($polozky)); //posledni ))
                if (count($b) - 1 == $index)  //detekce posledni polozky
                {
                  if (!strpos($row, "(")) //pokud neni ( v textu, odstrani posledni )
                  {
                    $row = substr($row, 0, -1); //odstranit 1 znak ')' z konce radku
                  }
                }

                $c = explode(" ", $row);
                //prevadeni na male pismena
                foreach ($c as $i => $hodnota)
                {
                  if ($i > 1)
                  {
                    $c[$i] = strtolower($hodnota);  //prevedeni od 2 indexu na male
                  }
                }

                $result[] = ($all ? $c : $c[0]);  //konecne nazvy sloupcu a nebo vse
              }
            }
          }
        break;

        case "mysqli":
          if ($res = @$this->ukazatel[$this->idukazatel]->query("SHOW CREATE TABLE {$table}"))
          {
            if ($res->num_rows == 1)
            {
              $column = "Create Table";
              $data = $res->fetch_object()->$column;  //nacteni create dotazu
              $a = explode("`{$table}` (", $data);  //parsrovani hodnot
              $b = explode(",", $a[1]); //rozdeleni na radky

              $index = 0;
              foreach ($b as $polozky)  //projiti radku
              {
                //odstraneni zbytecnych mezer a rozdeleni podle " "
                $c = explode(" ", str_replace(array("\n", "`"), array("", ""), ltrim($polozky)));
                //prevadeni na male pismena
                foreach ($c as $i => $hodnota)
                {
                  if ($i > 1)
                  {
                    $c[$i] = strtolower($hodnota);  //prevedeni od 2 indexu na male
                  }
                }

                if ($c[0] != "PRIMARY" && $c[1] != "KEY")
                {
                  $result[] = ($all ? $c : $c[0]);  //konecne nazvy sloupcu a nebo vse
                  $index++;
                }
                  else
                {
                  $pk = str_replace(array("(", ")"), array("", ""), $c[2]); //zjisteni PK
                  foreach ($result as $i => $hodn)
                  {
                    if ($pk == $hodn[0])  //vyhledani PK
                    {
                      $result[$i][] = "primary"; //doplneni puvodniho pole o PK
                      $result[$i][] = "key";
                      break;
                    }
                  }
                }
              }
            }
          }
            else
          {
            $error = $this->ukazatel[$this->idukazatel]->error;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Vrati typ charsetu kodovani v DB
 *
 * @return typ kodovani
 */
  public function AktualniKodovani()
  {
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = sqlite_libencoding();
      break;

      case "mysqli":
        $result = $this->ukazatel[$this->idukazatel]->character_set_name();
      break;
    }

    return $result;
  }

/**
 *
 * Vrati aktualni stav DB
 *
 * @return stav DB
 */
  public function AktualniStatusDB()
  {
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = stat($this->cesta[$this->idukazatel]);
      break;

      case "mysqli":
        $rozdel = explode("  ", $this->ukazatel[$this->idukazatel]->stat());
        foreach ($rozdel as $key => $value)
        {
          $roz = explode(": ", $rozdel[$key]);
          $result[$roz[0]] = $roz[1];
        }
      break;
    }

    return $result;
  }

/**
 *
 * Ukonci spojeni s databazi
 *
 * uzavira se ve funkci: VypisVsechnyChyby()
 *
 */
  public function ZavritDatabaze()
  {
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        //
      break;

      case "mysqli":
        if (!@$this->ukazatel[$this->idukazatel]->close())
        {
          $this->ErrorMsg("Nelze uzavrit databazi cislo {$this->idukazatel} !!", array(__LINE__, __METHOD__));
        }
      break;
    }
  }

/**
 *
 * Osetreni nebezpecnych znaku pro vstup do databaze
 *
 * @param text vstupni text
 * @param entity pri false vyhazuje jen nektere texty
 * @return osetreny text
 */
  public function ChangeWrongChar($text, $entity = true, $typ = NULL)
  {
    $result = "";
    $typ = (!is_null($typ) ? $typ : $this->typdb[$this->idukazatel]);
    switch ($typ)
    {
      default:
      case "sqlite":
        $result = stripslashes(htmlspecialchars($text, ENT_QUOTES, "UTF-8"));
        //htmlentities($text, ENT_QUOTES);
        //($komplexne ? stripslashes(htmlspecialchars($text, ENT_QUOTES)) : stripslashes(htmlspecialchars($text)));
      break;

      case "mysqli":  //zalomitkovani apostrofu / normalne ' necha
        //html na entity a zabezpeceni uvozovek a pod.
        $res = stripslashes(htmlspecialchars($text, ENT_QUOTES, "UTF-8"));
        $result = $this->ukazatel[$this->idukazatel]->real_escape_string($res);

        //$result = ($entity ? htmlentities($text, ENT_QUOTES, "UTF-8") :
        //                     htmlspecialchars($text, ENT_QUOTES, "UTF-8"));

        //($komplexne ? addslashes($text) : stripslashes(htmlspecialchars($text)));
      break;

      case "file":
        $result = htmlentities($text, ENT_COMPAT, "UTF-8");
      break;
    }

    return $result;
  }

/**
 *
 * Zpetny prevod nekterych znaku kvuli validite nebo uplnemu vypisu
 *
 * @param text vstupni text
 * @return puvodni text
 */
  public function BackChangeChar($text, $entity = true)
  {
    $result = "";
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = html_entity_decode($text, ENT_QUOTES);
        //($komplexne ? stripslashes(htmlspecialchars($text, ENT_QUOTES)) : stripslashes(htmlspecialchars($text)));
      break;

      case "mysqli":  //zalomitkovani apostrofu / normalne ' necha
        $result = html_entity_decode($text, NULL, "UTF-8");
        //html_entity_decode(, ENT_QUOTES);
        //($komplexne ? addslashes($text) : stripslashes(htmlspecialchars($text)));
        //html_entity_decode(, NULL, "UTF-8")
      break;
    }
//htmlspecialchars_decode(html_entity_decode($res->dialog, NULL, "UTF-8"))
    return $result;
  }

/**
 *
 * Zkrati text na pozadanovou hodnotu, pres Multibyte String Functions
 *
 * @param text vstupni text
 * @param delka zkraceni textu na pozadovanou hodnotu, def=20
 * @param znaky znaky za skracenou hodnotou, def="..."
 * @return zkraceny text
 */
  public function ZkraceniTextu($text, $delka = 20, $znaky = "...")
  {
    $result = $text;
    settype($delka, "integer"); //natypovani delky
    if ($delka > 0) //pokud je delka nenulova, prepise se navrat
    {
      $result = mb_substr($text, 0, $delka, "UTF-8").(mb_strlen($text, "UTF-8") > $delka ? $znaky : "");
    }

    return $result;
  }

/**
 *
 * Osetreni nedostatku v prevadeni znaku ajax Jquery
 *
 * pro php ajax:
 * $this->AjaxJQueryKonverze($_POST["nazev"])
 * $this->AjaxJQueryKonverze($_POST["nazev"], NULL, array("|" => "")))
 *
 * do funkce pro unikatni:
 * $this->AjaxJQueryKonverze()  //s tim ze bere z: "value" a uklada do: "roz"
 * $this->AjaxJQueryKonverze(NULL, array("hodnota", "roz"))
 *
 * @param text vstupni text pro konverzi
 * @param prom vystupni konfigurace promennych pro unikatni array(vstup, vystup)
 * @param rozsireni rozsirujici pole konverze ktere se apikuje na vstupni text
 * @return konvertovany text a nebo js kod pro prevod do unikatnich
 */
  public function AjaxJQueryKonverze($text = NULL, $prom = array("value", "roz"), $rozsireni = array())
  {
    $konverze = array("|>plus<|" => array("\+", "+"),
                      "|>lom<|" => array("\/", "/"),
                      "|>amp<|" => array("&", "&"),
                      "|>uvoz<|" => array("&quot;", "&quot;"),
                      );

    //rozsireni o vlastni pole
    if (!Empty($rozsireni) &&
        is_array($rozsireni))
    {
      $konverze = array_merge($konverze, $rozsireni); //rozsireni pole
    }

    $result = "";
    if (!is_null($text))  //pokud je co konvertovat
    { //prevod textu podle konverzni tabulky
      $hodn = array_values($konverze);
      $replace = array();
      foreach ($hodn as $repl)
      { //vyber 1.indexu, kdyz neni tak cely text, pri vlozeni pole z venku
        $replace[] = (!Empty($repl[1]) ? $repl[1] : $repl);
      }
      $result = str_replace(array_keys($konverze), $replace, $text);
    }
      else
    { //pro vlozeni do unikatnich
      $i = 0;
      $pole = "";
      //prochazeni pole konverze
      foreach ($konverze as $index => $polozka)
      {
        $pocatek = ($i == 0 ? "{$prom[0]}.toString()" : $prom[1]);
        $regexp = htmlspecialchars_decode($polozka[0]); //prevedeni &quot; na " a pod..
        $pole[] = "{$prom[1]} = {$pocatek}.replace(/{$regexp}/g, '{$index}');"; //inteligentni prepis
        //$pole[] = "roz = {$pocatek}.split('{$polozka}');";  //prvni radek
        //$pole[] = "roz = roz.join('{$index}');";  //druhy radek
        $i++;
      }
      $result = implode("\n", $pole); //slouceni pole entrama
    }

    return $result;
  }

/**
 *
 * Dekoduje url adresu po & a umoznuje ji od konce zkratit
 *
 * @param adresa vstupni adresa
 * @param odebrat pocet polozek kolik se ma z konce pole adresy odebrat
 * @return sloucena adresa s odebranym poctem polozek
 */
  public function DekodujAdresu($adresa, $odebrat = -1)
  {
    $adr = explode("&", $adresa);
    $result = (is_array($adr) ? implode("&", array_slice($adr, 0, $odebrat)) : $adresa);

    return $result;
  }

/**
 *
 * Instaluje databazi
 *
 * @param prikaz create prikazy
 * @param &error text chybove hlasky, nepovinne
 * @param potichu ticha instalace, defaultne false
 * @return true/false - nanistalovano/nenanistalovano
 */
  public function InstalaceDatabaze($prikaz, &$error = NULL, $potichu = false)
  {
    $path = dirname($this->newcesta[$this->idukazatel]); //slozka z cesty

    $result = false;
    if ($this->pripojeno[$this->idukazatel])
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          if (!filesize($this->cesta[$this->idukazatel]))
          {
            $result = $this->queryExec($prikaz, $error);
            if (Empty($error))
            {
              if (!$potichu)
              {
                echo "
                <meta http-equiv=\"refresh\" content=\"1;URL={$this->AbsolutniUrl()}?{$_SERVER["QUERY_STRING"]}\" />
                Instaluji databazi modulu <strong>{$this->trida[$this->idukazatel]}</strong>";
                exit(0);
              }
            }
              else
            { //pri chybe vymazne potvrzeni o instalaci
              if (file_exists($this->cesta[$this->idukazatel]))
              {
                unlink($this->cesta[$this->idukazatel]);
              }
            }
          }
            else
          {
            $result = true;
          }
        break;

        case "mysqli":
          if (!file_exists($this->newcesta[$this->idukazatel]))
          {
            $expl1 = explode("CREATE TABLE ", $prikaz);
//dodelat!! parsovat mozna trochu liip!!!
            $tab = 0;
            $poc = count($expl1);
            $key = "";
            for ($i = 1; $i < $poc; $i++)
            {
              $expl2 = explode(" (", $expl1[$i]); //vysekani nazvu databaze
              $tab += ($this->ExistujeTabulka($expl2[0], $error) ? 1 : 0);
              $nazevdb[] = $expl2[0];
            }

            if ($tab != ($poc - 1))
            {
              $result = $this->queryExec($prikaz, $error);  //prevedeni nazvu db
            }
              else
            {
              if (is_writable($path))
              {
                $u = fopen($this->newcesta[$this->idukazatel], "w");
                fwrite($u, date("Y-m-d H:i:s"));
                fclose($u);

                $result = true;
              }
                else
              {
                $error = "Není povolen zápis do složky: {$path}";
              }
            }

            if (Empty($error))  //kdyz je bez chyby
            {
              echo "
              <meta http-equiv=\"refresh\" content=\"1;URL={$this->AbsolutniUrl()}?{$_SERVER["QUERY_STRING"]}\" />
              Instaluji databázi modulu <strong>{$this->trida[$this->idukazatel]}</strong>
              ";
              exit(0);
            }
              else
            { //pri chybe vymazne potvrzeni o instalaci
              if (file_exists($this->newcesta[$this->idukazatel]))
              {
                unlink($this->newcesta[$this->idukazatel]);
              }

              $db = implode("`, `", $nazevdb);
              $this->queryExec("DROP TABLE `{$db}`;", $null); //postara se o smaznuti omylem vytvorenych
            }
          }
            else
          {
            $result = true;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Zjisti jestli dana tabulka existuje
 *
 * @param tabulka nazev tabulky
 * @param &error text chybove hlasky, nepovinne
 * @return true/false - existuje/neexistuje
 */
  public function ExistujeTabulka($tabulka, &$error = NULL)
  {
    $result = false;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        if ($res = @$this->ukazatel[$this->idukazatel]->query("SELECT name FROM sqlite_master WHERE type='table' AND name='{$tabulka}';", NULL, $error))
        {
          $result = ($res->numRows() == 1);
        }
      break;

      case "mysqli":
        $dbname = $this->DekodujText($this->var->mysql_dbname); //konvert nazvu
        if ($res = @$this->ukazatel[$this->idukazatel]->query("SHOW TABLES WHERE `Tables_in_{$dbname}`='{$tabulka}';"))
        {
          $result = ($res->num_rows == 1);
        }
          else
        {
          $error = $this->ukazatel[$this->idukazatel]->error;
        }
      break;
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Transakcni zamek databaze, zamknout
 *
 * @param &error text chybove hlasky, nepovinne
 */
  public function beginTransaction(&$error = NULL)
  {
    $result = false;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = $this->queryExec("BEGIN", $error);
      break;

      case "mysqli":  //dodelat!! bere jen urcite typy mysql, MyISAM to nepodporuje
        $result = $this->ukazatel[$this->idukazatel]->autocommit(false);
        $error = $this->ukazatel[$this->idukazatel]->error;
      break;
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Transakcni zamek databaze, odemknout
 *
 * @param &error text chybove hlasky, nepovinne
 */
  public function endTransaction(&$error = NULL)
  {
    $result = false;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = $this->queryExec("COMMIT", $error);
      break;

      case "mysqli":
        $result = $this->ukazatel[$this->idukazatel]->commit();
        $error = $this->ukazatel[$this->idukazatel]->error;
      break;
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Provede exec prikaz v DB
 *
 * @param prikaz sql prikaz, pro vice dotazu rozdelit "; "
 * @param &error text chybove hlasky, nepovinne
 * @return true/false - povedlo/nepovedlo
 */
  public function queryExec($prikaz, &$error = NULL)
  {
    $result = false;  //$this->pripojeno
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = @$this->ukazatel[$this->idukazatel]->queryExec($prikaz, $error);
      break;

      case "mysqli":
        $result = @$this->ukazatel[$this->idukazatel]->multi_query($prikaz);

        while ($this->ukazatel[$this->idukazatel]->more_results())
        {
          $this->ukazatel[$this->idukazatel]->next_result();
        }

        $error = $this->ukazatel[$this->idukazatel]->error;

/*
        $result = true; //defaultne nastavene true, jestli neprojde zhodi na false
        $err = "";
        //nahrazeni chr(13) za \n (za chr(10))
        $uprava = preg_replace(array("/\xd/", "/;\n/"), array("\n", ";||;"), $prikaz);
        $dotaz = preg_split("/;\|\|;/", $uprava); //rpzdeleni podle \n
        //prochazeni pole dotazu
        foreach ($dotaz as $sql)
        {
          $sql = trim($sql);  //odstraneni mezer
          if (!Empty($sql)) //pokud neni sql prazdny
          { //multi_query
            $result = ($this->ukazatel[$this->idukazatel]->real_query($sql) ? $result : false);
            $chyba = $this->ukazatel[$this->idukazatel]->error;
            if (!Empty($chyba))
            {
              $err[] = $chyba;
            }
          }
        }
        //slouceni pole chyb
        $error = (is_array($err) ? implode("<br />", $err) : "");
*/
      break;
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__, $prikaz));
    }

    return $result;
  }

/**
 *
 * Provede vyberovy prikaz
 *
 * @param prikaz sql prikaz
 * @param &error text chybove hlasky, nepovinne
 * @return resource prikazu
 */
  public function query($prikaz, &$error = NULL)
  {
    $result = false;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          $result = @$this->ukazatel[$this->idukazatel]->query($prikaz, NULL, $error);
        break;

        case "mysqli":
          $result = @$this->ukazatel[$this->idukazatel]->query($prikaz);
          $error = $this->ukazatel[$this->idukazatel]->error;
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__, $prikaz));
    }

    return $result;
  }

/**
 *
 * Provede vyberovy prikaz pouze na jeden sloupec[0] a prvniho radku/vsech radku
 *
 * @param prikaz sql prikaz
 * @param prvni bool jestli se ma vratit jen prvni radek nebo i ostatni
 * @param &error text chybove hlasky, nepovinne
 * @return text daneho radku
 */
  public function querySingle($prikaz, $prvni = true, &$error = NULL)
  {
    $result = NULL;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          $result = @$this->ukazatel[$this->idukazatel]->singleQuery($prikaz, $prvni);
        break;

        case "mysqli":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz))
          {
            if ($prvni) //jen jeden radek
            {
              if ($res->num_rows == 1)
              {
                $data = $res->fetch_array(MYSQLI_NUM);
                $result = $data[0];
              }
            }
              else
            { //vice radku
              while ($data = $res->fetch_array(MYSQLI_NUM))
              {
                $result[] = $data[0];
              }
            }
          }
            else
          {
            $error = $this->ukazatel[$this->idukazatel]->error;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__, $prikaz));
    }

    return $result;
  }

/**
 *
 * Vrati text dane bunky
 *
 * @param sloupec nazev sloupce
 * @param tabulka nazev tabulky
 * @param id cislo radku
 * @param dotaz tvar podminky dotazu, defaultne "id="
 * @return hodnota bunky
 */
  public function VypisHodnotu($sloupec, $tabulka, $id, $dotaz = "id=")
  {
    $sqlid = "";
    if (!is_null($id))
    { //vlozeni id jen kdyz je definovane
      $id = $this->ChangeWrongChar($id);  //prevod nebezpecnych znaku
      $sqlid = "'{$id}'";
    }
    $predpona = $this->NotEmpty($this->dbpredpona, $this->idukazatel);  //$this->dbpredpona[$this->idukazatel]
    $res = $this->querySingle("SELECT {$sloupec} FROM {$predpona}{$tabulka} WHERE {$dotaz}{$sqlid};");
    $result = (!is_null($res) ? $res : "");

    return $result;
  }

/**
 *
 * Vrati pole vsech hodnot ze zadaneho sloupce dane tabulky
 *
 * @param sloupec nazev sloupce
 * @param tabulka nazev tabulky
 * @return pole polozek z tabulky
 */
  public function VypisPolozky($sloupec, $tabulka)
  {
    $result = $this->querySingle("SELECT {$sloupec} FROM {$this->dbpredpona[$this->idukazatel]}{$tabulka};", false);

    return $result;
  }

/**
 *
 * Vrati pocet radku dane tabulky
 *
 * @param sloupec nazev sloupce
 * @param tabulka nazev tabulky
 * @param inc automaticke zvysovani o...
 * @param dotaz tvar podminky dotazu, defaultne ""
 * @return maximalni hodnota sloupce v DB
 */
  public function VypisPocetRadku($sloupec, $tabulka, $inc = 0, $dotaz = "")
  {
    settype($inc, "integer");

    $poc = $this->querySingle("SELECT MAX({$sloupec}) FROM {$this->dbpredpona[$this->idukazatel]}{$tabulka} {$dotaz};");
    $result = (!is_null($poc) ? $poc + $inc : $inc);

    return $result;
  }

/**
 *
 * Vraci bool o tom jestli dana hodnota v dane databazi existuje, true=neexistuje
 * pouziti:
 * kontrola duplikace
 * kontrola existence, s negaci
 *
 * @param sloupec nazev sloupce
 * @param tabulka nazev tabulky
 * @param id hodnota pro kontrolu
 * @param dodatek dodatek k dotazu, k upresneni podminek "neco='hu' AND "
 * @return bool o existenci, true=hodnota neexistuje
 */
  public function DuplikatniHodnota($sloupec, $tabulka, $hodnota, $dodatek = "")
  { //muze se pripojovat jen tehdy kdyz je pri mysqli neprazdna predpona!!!
    $result = true;
    if ($this->ZjistiTypDB(true) == "mysqli" ? !Empty($this->dbpredpona[$this->idukazatel]) : true)
    {
      $res = $this->querySingle("SELECT COUNT(id) FROM {$this->dbpredpona[$this->idukazatel]}{$tabulka} WHERE {$dodatek}{$sloupec}='{$hodnota}';");
      $result = ($res == 0);
    }

    return $result;
  }

/**
 *
 * Nastavi hodnotu dane bunky
 *
 * @param sloupec nazev sloupce
 * @param hodnota nova hodnota radku
 * @param tabulka nazev tabulky
 * @param id cislo radku
 * @param dotaz textovy dotaz na upresneni dronadne podminky, defaultne "id="
 * @param &error text chybove hlasky
 * @return bool o provedeni
 */
  public function NastavHodnotu($sloupec, $hodnota, $tabulka, $id, $dodatek = "id=")
  {
    //settype($id, "integer");
//dodelat!! zjednodusit!
    if (!$result = $this->queryExec("UPDATE {$this->dbpredpona[$this->idukazatel]}{$tabulka} SET {$sloupec}='{$hodnota}' WHERE {$dodatek}'{$id}';", $error))
    {
      var_dump($error, array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Spocita kolik dni ubehlo od poc_datum do kon_datum
 *
 * @param poc_datum pocatecni datum, vstup do strtotime
 * @param kon_datum koncove datum, vstup do strtotime
 * @param zaporne zapina zaporne znamenka pri obraceni data
 * @return pocet dni
 */
  public function PocetDni($poc_datum, $kon_datum, $zaporne = false)
  {
    $result = 0;
    $poc = strtotime($poc_datum); //pocatecni datum
    $kon = strtotime($kon_datum); //koncove datum
    //pokud je pocatecni mensi nez koncove - ok
    if (date("Y-m-d", $poc) < date("Y-m-d", $kon))
    {
      $i = 0;
      while (date("Y-m-d", strtotime("+{$i} day", $poc)) != date("Y-m-d", $kon))
      {
        $i++;
      }

      $result = $i;
    }
      else
    { //pokud je koncove datum mensi nez pocatecni
      $i = 0;
      while (date("Y-m-d", strtotime("-{$i} day", $poc)) != date("Y-m-d", $kon))
      {
        $i++;
      }

      $result = ($zaporne && date("Y-m-d", $poc) > date("Y-m-d", $kon) ? "-{$i}" : $i);
    }

    return $result;
  }

/**
 *
 * Provede vyberovy dotaz a vrati jeden cely zadany radek z dabataze
 *
 * @param prikaz sql prikaz
 * @param &error text chybove hlasky
 * @return jeden radek z databaze
 */
  public function querySingleRow($prikaz, &$error = NULL)
  {
    $result = NULL;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz, NULL, $error))
          {
            if ($res->numRows() == 1) //jen jeden radek
            {
              $result = $res->fetchObject();
            }
          }
        break;

        case "mysqli":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz))
          {
            if ($res->num_rows == 1)  //jen jeden radek
            {
              $result = $res->fetch_object();
            }
          }
            else
          {
            $error = $this->ukazatel[$this->idukazatel]->error;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__, $prikaz));
    }

    return $result;
  }

/**
 *
 * Provede vyberovy dotaz a cely vysledek vrati v objektech
 *
 * @param prikaz sql prikaz
 * @param &error text chybove hlasky, nepovinne
 * @return vsechny radky databaze v objektech
 */
  public function queryMultiObjectSingle($prikaz, &$error = NULL)
  {
    $result = NULL;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz, NULL, $error))
          {
            if ($res->numRows() != 0) //vsechny radky
            {
              while ($data = $res->fetchObject()) //generovani radku
              {
                $result[] = $data;
              }
            }
          }
        break;

        case "mysqli":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz))
          {
            if ($res->num_rows != 0)  //vsechny radky
            {
              $i = 0; //blbne?!!! dodelat!!!!fetch_array(MYSQLI_ASSOC)
              while ($data = $res->fetch_object()) //generovani radku
              {
                $result[] = $data;
/*
                foreach ($data as $index => $hodnota)
                { //ze Creating default object from empty value \v
                  $result[$i]->$index = $hodnota; //generovani sloupcu
                }
                $i++; //pricitani indexu radku
*/
              }
              //var_dump($result);
            }
          }
            else
          {
            $error = $this->ukazatel[$this->idukazatel]->error;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if (!Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__, $prikaz));
    }

    return $result;
  }

/**
 *
 * Provede vyberovy dotaz a cely vysledek vrati v poly
 *
 * @param prikaz sql prikaz
 * @param &error text chybove hlasky, nepovinne, pri true, vyblokuje logovani
 * @return vsechny radky databaze v poli
 */
  public function queryMultiArraySingle($prikaz, &$error = NULL)
  { //potlaceni error hlasky
    $showerror = (!$error);
    $result = NULL;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz, NULL, $error))
          {
            while ($data = $res->fetch(SQLITE_ASSOC)) //SQLITE_NUM
            {
              $result[] = $data;
            }
          }
        break;

        case "mysqli":
          if ($res = @$this->ukazatel[$this->idukazatel]->query($prikaz))
          {
            while ($data = $res->fetch_array(MYSQLI_ASSOC)) //MYSQLI_NUM
            {
              $result[] = $data;
            }
          }
            else
          {
            $error = $this->ukazatel[$this->idukazatel]->error;
          }
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    if ($showerror && !Empty($error))
    {
      $this->ErrorMsg($error, array(__LINE__, __METHOD__, $prikaz));
    }

    return $result;
  }

/**
 *
 * Formatovani datumu pro db
 *
 * @param date vstupni datum, presne datum v '', promenna bez ''
 * @param format vstupni PHP format, dalse se pak konvertuje podle dane db
 * @return text formatovani datumu pro danou databazi
 */
  public function dateFormat($date, $format)
  {
    $result = "";
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          //php => sqlite
          $prevod = array("a" => "%p",  //AM|PM
                          "A" => "%p", //AM|PM
                          "d" => "%d",  //day 01-31
                          "D" => "%a",  //sun-mon
                          "F" => "%B",  //januar-december
                          "h" => "%I",  //12hour 01-12
                          "H" => "%H",  //24hour 00-23
                          "i" => "%M",  //min 00-59
                          "j" => "%e",  //day 1-31
                          "l" => "%A",  //sunday-saturday
                          "m" => "%m",  //month 01-12
                          "M" => "%b",  //jan-dec
                          "s" => "%S",  //sec 00-59
                          "u" => "%f",  //microseconds
                          "w" => "%w",  //0=sun, 6=sat
                          "W" => "%W",  //week of year, weeks start mon, 1-53
                          "y" => "%y",  //year 2 dig.
                          "Y" => "%Y",  //year 4 dig.
                          "z" => "%j",  //day of year 1-365
                          "%%" => "%",  //%
                          );

          $form = strtr($format, $prevod);

          $result = "strftime('{$form}', {$date})";
        break;

        case "mysqli":
          //php => mysqli
          $prevod = array("a" => "%p",  //AM|PM
                          "A" => "%p", //AM|PM
                          "d" => "%d",  //day 01-31
                          "D" => "%a",  //sun-mon
                          "F" => "%M",  //januar-december
                          "g" => "%l",  //12hour 1-12
                          "G" => "%k",  //24hour 0-23
                          "h" => "%h",  //12hour 01-12
                          "H" => "%H",  //24hour 00-23
                          "i" => "%i",  //min 00-59
                          "j" => "%e",  //day 1-31
                          "l" => "%W",  //sunday-saturday
                          "m" => "%m",  //month 01-12
                          "M" => "%b",  //jan-dec
                          "n" => "%c",  //month 1-12
                          "s" => "%s",  //sec 00-59
                          "S" => "%D",  //eng suffix
                          "u" => "%f",  //microseconds
                          "w" => "%w",  //0=sun, 6=sat
                          "W" => "%u",  //week of year, weeks start mon
                          "y" => "%y",  //year 2 dig.
                          "Y" => "%Y",  //year 4 dig.
                          "z" => "%j",  //day od year
                          "%%" => "%",  //%
                          );

          $form = strtr($format, $prevod);

          $result = "DATE_FORMAT({$date}, '{$form}')";
        break;
      }
    }
      else
    {
      $error = "Není připojená databáze";
    }

    return $result;
  }

/**
 *
 * Zjisti pocet radku
 *
 * @param resource resource sql dotazu
 * @return pocet radku
 */
  public function numRows($resource)
  {
    $result = 0;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = $resource->numRows();
      break;

      case "mysqli":
        $result = $resource->num_rows;
      break;
    }

    return $result;
  }
//mysqli::multi_query
/*
  public function q($prikaz)
  {
    $this->ress = "";
    $result = false;
    if ($this->pripojeno[$this->idukazatel]) //kontrola pripojene databaze
    {
      switch ($this->typdb[$this->idukazatel])
      {
        default:
        case "sqlite":
          //$result = @$this->ukazatel[$this->idukazatel]->query($prikaz, NULL, $error);
        break;

        case "mysqli":
          $this->ukazatel[$this->idukazatel]->result = @$this->ukazatel[$this->idukazatel]->query($prikaz);
          //$error = $this->ukazatel[$this->idukazatel]->error;
        break;
      }
    }

    return $this;
  }

  public function numR()
  {
    //var_dump($this->ress);//->ress->num_rows);
    var_dump($this->ukazatel[$this->idukazatel]->result->num_rows);
    //return $this->ress->num_rows;
  }
*/

/**
 *
 * Zjisti pocet ovlivnenych radku
 *
 * @return pocet ovlivneni
 */
  public function numChanges()
  {
    $result = 0;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = $this->ukazatel[$this->idukazatel]->changes();
      break;

      case "mysqli":
        $result = $this->ukazatel[$this->idukazatel]->affected_rows;
        //$result = $this->ukazatel[$this->idukazatel]->info;
      break;
    }

    return $result;
  }

/**
 *
 * Provadi array vystup z databaze
 *
 * @param resource resource sql dotazu
 * @param out vystupni format indexu pole, NUM - cisla, ASSOC - asociativni, BOTH - oboji
 * @return pole pro nacteni hodnot
 */
  public function fetch($resource, $out = "NUM")
  {
    $result = "";
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $typ = array ("ASSOC" => SQLITE_ASSOC,
                      "NUM" => SQLITE_NUM,
                      "BOTH" => SQLITE_BOTH); //ASSOC, NUM, BOT

        $result = $resource->fetch($typ[$out]); //SQLITE_ASSOC, SQLITE_NUM, SQLITE_BOTH
      break;

      case "mysqli":
        $typ = array ("ASSOC" => MYSQLI_ASSOC,
                      "NUM" => MYSQLI_NUM,
                      "BOTH" => MYSQLI_BOTH); //ASSOC, NUM, BOT

        $result = $resource->fetch_array($typ[$out]); //MYSQLI_ASSOC, MYSQLI_NUM, MYSQLI_BOTH
      break;
    }

    return $result;
  }

/**
 *
 * Provadi objektove vystup z databaze
 *
 * @param resource resource sql dotazu
 * @return objekty pro nacteni hodnoty
 */
  public function fetchObject($resource)
  {
    $result = "";
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = $resource->fetchObject();
      break;

      case "mysqli":
        $result = $resource->fetch_object();
      break;
    }

    return $result;
  }

/**
 *
 * Zjisti vlastnosti sloupce
 *
 * @param resource resource sql dotazu
 * @return vlastnosti sloupce v objektu
 */
  public function fetchFields($resource)
  {
    $result = NULL;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        //$result = $resource->;
      break;

      case "mysqli":
        $result = $resource->fetch_fields();
      break;
    }

    return $result;
  }

/**
 *
 * Zjisti posledni pridane ID
 *
 * @return posledni cislo ID PK
 */
  public function lastInsertRowid()
  {
    $result = 0;
    switch ($this->typdb[$this->idukazatel])
    {
      default:
      case "sqlite":
        $result = $this->ukazatel[$this->idukazatel]->lastInsertRowid();
      break;

      case "mysqli":
        $result = $this->ukazatel[$this->idukazatel]->insert_id;
      break;
    }

    return $result;
  }

/**
 *
 * Zakoduje text
 *
 * @param text vstupni text
 * @return zasifrovany text
 */
  public function ZakodujText($text)
  {
    $lett = str_split($text, 1);
    $result = "";

    for ($i = 0; $i < count($lett); $i++)
    {
      $result[] = decoct(decoct(ord($lett[$i]) + ($i * 10)) + (($i + 1) * 14)) + ($i * 11);
    }

    return implode($this->kodroz, $result);
  }

/**
 *
 * Dekoduj text
 *
 * @param text vstupni zakodovany text
 * @return rozsifrovany text
 */
  public function DekodujText($text)
  {
    $kod = explode($this->kodroz, $text);
    $result = "";

    for ($i = 0; $i < count($kod); $i++)
    {
      $result .= chr(octdec(octdec($kod[$i] - ($i * 11)) - (($i + 1) * 14)) - ($i * 10));
    }

    return $result;
  }

/**
 *
 * Nacte obsah daneho souboru
 *
 * pouziti:
 * $obsah = $this->var->main[0]->NactiFunkci("Funkce", "NactiObsahSouboru"[, false]);
 *
 * @param soubor nazev souboru pro nacteni, slozku bere dle cesty (souboryinclude) v user_promenne
 * @param once rozliseni jestli se ma nacis jedenkrat a nebo normalne
 * @return obsah
 */
  public function NactiObsahSouboru($soubor, $once = true)
  {
    $result = false;
    if (file_exists($soubor))
    { //nacteni super globalni absolutni url
      $rozdel = explode("_", basename($soubor), 2);
      $path = dirname($soubor);
      $nazev = implode("_", array($this->dedicne, $rozdel[1]));

      $cesta = "{$path}/{$nazev}";  //pokud existuje duplikat slucuje 2 pole
      if (file_exists($cesta))
      {
        $hlavni = ($once ? include_once($soubor) : include($soubor));
        $pridavek = ($once ? include_once($cesta) : include($cesta));

        if (is_array($hlavni) &&  //kontroluje jestli jsou oba soubory pole
            is_array($pridavek))
        {
          $result = array_merge($hlavni,
                                $pridavek);
        }
      }
        else
      {
        $result = ($once ? include_once($soubor) : include($soubor));
      }
    }
      else
    {
      var_dump("soubor: <strong>{$soubor}</strong> neexistuje", array(__LINE__, __METHOD__));
    }

    return $result;
  }

/**
 *
 * Nacitani unikatniho textu a z promenne kde se nazrazuji za skutecny obsah
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("Funkce", "NactiUnikatniObsah", $this->unikatni["sekce"][, "parametry", ...]);
 * $text = $this->NactiUnikatniObsah($this->unikatni["sekce"][, "parametry", ...]);
 *
 * odedelovace: @@_@@
 *
 * pro zapsani libovolneho poctu argumentu v jednom argumentu: array("array_args", ...);
 *
 * @param unikatnitext sekce vlozena z pole
 * @return upraveny unikatni text podle prepisujicich parametru
 */
  public function PrevodUnikatnihoTextu($unikatnitext)
  {
    //zavolani funkce NactiUnikatniObsah s jinym vnitrnim nastavenim
    $param = func_get_args(); //nacteni vsech parametru aktualni volane funkce a predani dal
    $back = $this->nahproc; //ulozeni puvodni hodnoty
    $this->nahproc = "@@";  //vnitrne se prenastavi %%->@@
    $result = call_user_func_array(array($this, "NactiUnikatniObsah"), $param);
    $this->nahproc = $back; //vraceni nastaveni nazpet @@->%%

    return $result;
  }

/**
 *
 * Nacitani unikatnich obsahu stranek z promenne kde se nazrazuji za skutecny obsah
 *
 * pouziti:
 * $text = $this->var->main[0]->NactiFunkci("Funkce", "NactiUnikatniObsah", $this->unikatni["sekce"][, "parametry", ...]);
 * $text = $this->NactiUnikatniObsah($this->unikatni["sekce"][, "parametry", ...]);
 *
 * odedelovace: %%_%%
 *
 * pro zapsani libovolneho poctu argumentu v jednom argumentu:
 * array("array_args", "hodnota", ...);
 * pro zapsani libovolneho poctu a nahzeleni podle slov:
 * array("array_object", "klic" => "hodnota", ...)
 *
 * @param unikatnitext promenna nactena z unikatnich a nebo jineho zdroje
 * @return upraveny unikatni text podle prepisujicich parametru
 */
  public function NactiUnikatniObsah($unikatnitext)
  {
    $parametr = func_get_args();  //vyber vsech argumentu
    $param = array_slice($parametr, 1);  //vezme si od 1 indexu zbytek pole, argumenty
    $result = "";
    switch (gettype($unikatnitext))
    {
      case "NULL":
        $param = (is_array($param[0]) ? $param[0] : $param);  //pokud je prvni index pole vezme jen prvni index
        $par = implode(", ", $param); //slouceni pole parametru a vypsani od 1 indexu pres result a echo
        $result = "<strong>Nenalezen index pole!</strong><br />Zpracovany text: <strong>{$par}</strong>\n";
        echo $result; //vypsani na stdout
      break;

      case "array":
        if (!Empty($unikatnitext[0]) &&
            is_array($unikatnitext[0]) ||
            count($param) > 0)  //kdyz je 0 index unikatnitext pole nebo je nenulovy pocet parametru
        {
          //substituce hodnot pole
          foreach ($unikatnitext as $ipolozka => $polozka)
          {
            $result[$ipolozka] = $polozka; //nacteni pole do prvniho indexu
            foreach ($param as $ihodnota => $hodnota)  //prochazi parametry
            { //prepis jednotlivych procent
              $poc = $ihodnota + 1; //prevadi indexy od 1..N
              $result[$ipolozka] = str_replace("{$this->nahproc}{$poc}{$this->nahproc}", $hodnota, $result[$ipolozka]); //nahrazuje %% indexy po array uz ne po polozkach
            }
          }

          //pokud najde v klici %%X%%, aby se i ty nahradily
          if (preg_grep("/{$this->nahproc}\d{$this->nahproc}/", array_keys($result)))
          {
            $res = "";
            $poci = 0; //pocitadlo pro posun v hodnotach
            $val = array_values($result); //ziskani hodnot pole
            $result = ""; //vamazani resultu, vytvori se novy
            foreach ($unikatnitext as $ipolozka => $polozka)
            { //naplneni hotnot klicema
              $res[$ipolozka] = $ipolozka;
              foreach ($param as $ihodnota => $hodnota)  //prochazi parametry
              { //prepis samotnych polozek
                $poc = $ihodnota + 1; //prevadi indexy od 1..N
                $res[$ipolozka] = str_replace("{$this->nahproc}{$poc}{$this->nahproc}", $hodnota, $res[$ipolozka]); //nahrazuje %% indexy po array uz ne po polozkach
              } //znovu plneni pole
              $result[$res[$ipolozka]] = $val[$poci]; //plneni noveho vystupu
              $poci++;
            }
          }
        }
          else
        { //jinak nacita do navratu cisty vstup
          $result = $unikatnitext;
        }
      break;

      case "string":
        //uprava volitelnych parametru
        $prm = (!Empty($param[0][0]) ? $param[0][0] : "");
        switch ($prm)
        {
          default:
          case "array_args":  //pro obyc texty a nebo array_args
            $param = ($prm == "array_args" ? array_slice($param[0], 1) : $param);
            $result = $unikatnitext;  //nacteni prvni polozky
            foreach ($param as $ipolozka => $polozka)
            {
              $poc = $ipolozka + 1; //prevadi indexy od 1..N
              $result = str_replace("{$this->nahproc}{$poc}{$this->nahproc}", $polozka, $result);
            }
            //kontrola jestli nekde nejsou nevyuzite indexy
            $pole = preg_grep("/{$this->nahproc}\d{$this->nahproc}/", array($result));
            if (count($pole) > 0)
            { //nahrazeni prazdnych indexu za --X--
              $result = implode("", preg_replace("/{$this->nahproc}\d{$this->nahproc}/", "--X--", $pole));
            }
          break;

          case "array_object":  //pro textone harazovani array_object
            $param = array_slice($param[0], 1); //vyextrahovani pole
            $klice = array_keys($param);  //nacteni klicu
            $result = $unikatnitext;  //nacteni prvni polozky
            foreach ($klice as $polozka)
            {
              $result = str_replace("{$this->nahproc}{$polozka}{$this->nahproc}", $param[$polozka], $result);
            }
          break;
        }
      break;

      default:  //jine nez pozadovane typy rovnou vraci
        $result = $unikatnitext;
      break;
    }

    return $result;
  }

/**
 *
 * Nahrazovani unikatnich objektovych textu
 *
 * @param vstup vstupni text/pole na nahrazeni
 * @param pole vstupni pole identifikatoru s hodnotama na prepis
 * @param znak nepovinny znak identifikatoru, def %%
 * @return nahrazeny vstup podle pole
 */
  public function UniqObject($vstup, $pole, $znak = "%%")
  {
    $result = "";
    //nacteni klicu
    $klice = array_keys($pole);
    //uprava klicu
    $search = preg_replace("/\w+/", "{$znak}$0{$znak}", $klice);
    //nacteni hodnot
    $replace = array_values($pole);
    //nahrazeni vstupu naraz
    $result = str_replace($search, $replace, $vstup);

    return $result;
  }

/**
 *
 * Nastavi adresu menu pro lokalni tridu prenesenou z volane tridy (ze syna pro otce)
 *
 * @param adresa dvourozmerne pole menu
 */
  public function NastavitAdresuMenu($adresa)
  {
    $this->adresa_menu = $adresa;

    $this->LastError(get_class($this));
  }

/**
 *
 * Predani pole pro title
 *
 * @return title adminu
 */
  public function PredaniAdminTitle()
  {
    $result = "";
    if (!is_null($this->var->asocmoduly["index"]["Funkce"])) //overi jestli je pripojeny default
    {
      $result = call_user_func_array(array($this->var->main[$this->var->asocmoduly["index"]["Funkce"]], "CallAdminTitle"), array($this->adresa_menu));
    }
      else
    {
      echo "Nepodarilo se pripojit Default modul v <strong>{$this->adresa_menu[0]["odkaz"]}</strong> pro AdminTitle!<br />";
    }

    return $result;
  }

/**
 *
 * Predani pole pro menu
 *
 * @param predani pole predane z modulu
 * @return odkazy menu
 */
  public function PredaniAdminMenu($predani)
  {
    $result = "";
    if (!is_null($this->var->asocmoduly["index"]["Funkce"])) //overi jestli je pripojeny default
    {
      $result = call_user_func_array(array($this->var->main[$this->var->asocmoduly["index"]["Funkce"]], "CallAdminMenu"), array($this->adresa_menu, $predani));
    }
      else
    {
      echo "Nepodarilo se pripojit Default modul v <strong>{$this->adresa_menu[0]["odkaz"]}</strong> pro AdminMenu!<br />";
    }

    return $result;
  }

/**
 *
 * Vrati absolutni adresu s pathem
 *
 * @return absolutni adresa
 */
  public function AbsolutniUrl()
  {
    $path = dirname($_SERVER["SCRIPT_NAME"]);
    $result = "http://{$_SERVER["SERVER_NAME"]}".($path != "/" ? $path : "")."/";

    return $result;
  }

/**
 *
 * Vypise absolutni cestu ke korenu stranek
 *
 * @return absolutni cesta
 */
  public function AdresarWebu()
  {
    $result = dirname($_SERVER["SCRIPT_FILENAME"]);

    return $result;
  }

/**
 *
 * Meta refresh
 *
 * pouziti: ( 1[ms] )
 * $this->var->main[0]->NactiFunkci("Funkce", "AutoClick", 1, "url");
 * presmerovava z default modulu
 * v modulech ktere dedi default_modul:( 1[ms] )
 * $this->NactiFunkci("Funkce", "AutoClick", 1, "url");
 *
 * @param cas doba aktualizace
 * @param cesta cilova cesta presmerovani
 * @return prislusne nastaveny meta tag
 */
  public function AutoClick($cas, $cesta)
  {
    $url = htmlspecialchars_decode($cesta);
    //if (!headers_sent())
    //{
      header("Refresh: {$cas}; URL={$url}");
      //exit(0);
    //}
  }

/**
 *
 * Presmerovani ErrorMsg do funkce
 *
 */
  public function ErrorMsg($chyba, $poloha = array(0, NULL), $tisk = false)
  {
    if (method_exists($this->var->main[0], "ErrorMsg")) //overi existenci metody
    {
      call_user_func_array(array($this->var->main[0], "ErrorMsg"), array($chyba, $poloha, $tisk));
    }
  }

/**
 *
 * Presmerovani OverovaniManualPermission do funkce
 *
 * @return vraci bool opravneni
 */
  public function OverovaniManualPermission($class = NULL, $id_modul = NULL, $co = NULL)
  {
    $result = "";
    if (method_exists($this->var->main[0], "ManualPermission")) //overi existenci metody
    {
      $result = call_user_func_array(array($this->var->main[0], "ManualPermission"), array($class, $id_modul, $co));
    }
      else
    {
      var_dump("nenalezena metoda: ManualPermission");
    }

    return $result;
  }

/**
 *
 * Aplikace opravneni dle pole permission
 *
 * @param class trida objektu
 * @param permit pole opravneni daneho modulu
 * @return objektove pole aplikovanych opravneni
 */
  public function AplikacePermission($class, $permit)
  {
    $result = array();
    $user = ($this->GetSessionUser(true) > 0);  //pokud je uzivatel
    //prochazeni bloku
    foreach ($permit as $indexblok => $blok)
    {
      //prochazeni sekci
      foreach ($blok as $indexsekce => $sekce)
      { //vkladani do objektu kde prazdne indexy jsou zbytecne
        if (!Empty($indexsekce))
        { //naplneni objektu podle indexu
          $result[$indexblok][$indexsekce] = ($user ? $this->OverovaniManualPermission($class, $indexblok, $indexsekce) : true);
          //ORIGINAL:
          //$result->$indexblok->$indexsekce = ($user ? $this->OverovaniManualPermission($class, $indexblok, $indexsekce) : true);
        }
      }
    }

    return $result;
  }

/**
 *
 * Pripojeni zadaneho modulu dle indexu
 *
 * @param index index modulu v promenne moduly[]
 * @param promenna pole promennych na vraceni
 * @param this_var vola nastavovani komunikace,
 *        musi se zadat pokud je tato funkce volana pred nastavenim komunikace
 * @return ukazatel na tridu a nebo zadana promenna
 */
  public function ConnectModule($index, $promenna = NULL, $this_var = NULL)
  {
    $result = "";
    if (Empty($this->var->main[0]))
    { //v pripade volani z ajaxu
      $var = new Promenne();  //vytvoreni promennych
      $var->main[0] = new Funkce($var, 0);  //vytvoreni funkce
    }
    //pokud je pouzita globalni promenna
    if (!Empty($this_var))
    { //jen nastaveni konfigurace
      $this->NastavKomunikaci($this_var, $index);
    }

    if (method_exists($var->main[0], "ConMod")) //overi existenci metody
    {
      $result = call_user_func_array(array($var->main[0], "ConMod"), array($index, $promenna));
    }
      else
    {
      var_dump("nenalezena metoda: ConMod");
    }

    return $result;
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
  public function Velikost($size)
  {
    $symbol = array("bajtů", "kB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

    $exp = 0;
    $converted_value = 0;
    if ($size > 0)
    {
      $exp = floor(log($size) / log(1024));
      $converted_value = ($size / pow(1024, floor($exp)));
    }

    $result = sprintf(($exp == 0 ? "%d {$symbol[$exp]}" : "%.2f {$symbol[$exp]}"), $converted_value);

    return $result;
  }

/**
 *
 * Rekurzivni/nerekurzivni mereni velikosti souboru/slozek
 *
 * @param cesta cesta adresare
 * @param rekurzivne rekurzivni prochazeni true/false
 * @return velikost v zakladnich jednotkach
 */
  public function VelikostAdresare($cesta, $rekurzivne = false)
  {
    $sum = 0;
    if (file_exists($cesta) &&  //existuje-li
        is_readable($cesta))  //a jde-li z neho cist
    {
      $cesta = (is_dir($cesta) ? $cesta : dirname($cesta));
      $handle = opendir($cesta);
      while($soub = readdir($handle))
      {
        if ($soub != "." && $soub != "..")
        {
          switch (@filetype("{$cesta}/{$soub}"))  //umlceni warningu
          {
            case "dir":
              $sum += ($rekurzivne ? $this->VelikostAdresare("{$cesta}/{$soub}", $rekurzivne) : 0);
            break;

            case "file":
              $sum += filesize("{$cesta}/{$soub}");
            break;
          }

        }
      }
      closedir($handle);
    }

    return $sum;
  }

/**
 *
 * Filtr na koncovky
 *
 * @param nazev nazev souboru
 * @param filtr pole filtru
 * @return boolean zdali obsahuje danou koncovku
 */
  private function FiltrKoncovek($nazev, $filtr)
  {
    $result = true; //normalne pousti
    if (!Empty($filtr) &&
        is_array($filtr))
    {
      $a = explode(".", strtolower($nazev));  //prevedeni na male a rozdeleni podle tecky

      $result = in_array($a[count($a) - 1], $filtr);  //prohledani pole filtru
    }

    return $result;
  }

/**
 *
 * Vypise soubory ze zadane slozky
 *
 * @param cesta cesta k souborum
 * @param sort pole nastavujici vystupni razeni, array("date/name", "asc/desc")
 * @param filtr pole nastavujuci vystupni koncovky, array("php", "js")
 * @return pole souboru
 */
  public function VypisSouboru($cesta, $sort = NULL, $filtr = NULL)
  {
    $result = NULL;
    if (file_exists($cesta))
    {
      $soub = "";
      $dat = array();
      $handle = opendir($cesta);
      while($soub = readdir($handle))
      {
        if ($soub != "." &&
            $soub != ".." &&
            is_file("{$cesta}/{$soub}"))
        {
          if ($this->FiltrKoncovek($soub, $filtr))  //filtrovani koncovek
          {
            $result[] = $soub;  //nacitani souboru
            $dat[] = filemtime("{$cesta}/{$soub}"); //datum zmeny
          }
        }
      }
      closedir($handle);
//dodelat!!! umoznit i filt na zakazane pripony a pka dalsi i povolene
      if (!Empty($sort) && is_array($result))
      {
        $result = $this->RazeniPole($result, $dat, $sort);
      }
    }

    return $result;
  }

/**
 *
 * Vypise adresare ze zadane slozky
 *
 * @param cesta cesta k adresarum
 * @param sort pole nastavujici vystupni razeni, array("date/name", "asc/desc")
 * @return pole slozek a souboru
 */
  public function VypisAdresaru($cesta, $sort = NULL)
  {
    $result = NULL;
    if (file_exists($cesta))
    {
      $soub = "";
      $dat = array();
      $handle = opendir($cesta);
      while($soub = readdir($handle))
      {
        if ($soub != "." &&
            $soub != ".." &&
            is_dir("{$cesta}/{$soub}"))
        {
          $result[] = $soub;  //nacitani souboru
          $dat[] = filemtime("{$cesta}/{$soub}"); //datum zmeny
        }
      }
      closedir($handle);

      if (!Empty($sort) && is_array($result))
      {
        $result = $this->RazeniPole($result, $dat, $sort);
      }
    }

    return $result;
  }

/**
 *
 * Aplikuje razeni na pole
 *
 * @param pole vstupni pole dat
 * @param datum datumy souboru
 * @param sort parametry razeni
 * @return serazene pole dle parametru
 */
  private function RazeniPole($pole, $datum, $sort)
  {
    $result = $pole;

    if (!Empty($sort) &&
        is_array($sort) &&  //konfigurace musi byt pole
        is_array($datum)) //vstupni datumy musi byt pole
    {
      switch ($sort[0]) //aplikace razeni
      {
        case "date":  //razeni dle data vytvoreni [filemtime]
          switch ($sort[1])
          {
            case "asc":
              asort($datum);  //serazeni datumu
              $res = "";
              foreach ($datum as $index => $hod)
              {
                $res[] = $result[$index]; //vlozeni serazenych indexu
              }
              $result = $res;
            break;

            case "desc":
              arsort($datum);
              $res = "";
              foreach ($datum as $index => $hod)
              {
                $res[] = $result[$index]; //vlozeni serazenych indexu
              }
              $result = $res;
            break;
          }
        break;

        case "name":  //razeni dle nazvu
          switch ($sort[1])
          {
            case "asc":
              //sort($result);
              natcasesort($result);
            break;

            case "desc":
              //rsort($result);
              natcasesort($result);
              $result = array_reverse($result);
            break;
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Porovnani vstupnich poli a vrati jejich prebytek
 *
 * @param pole1 vzorove pole
 * @param pole2 aktualni pole
 * @return hodnoty ktere v aktualnim poli prebyvaji
 */
  public function PorovnaniPole($pole1, $pole2)
  {
    $result = "";
    if (!is_null($pole1) &&
        is_array($pole1) &&
        count($pole1) != 0 &&
        !is_null($pole2) &&
        is_array($pole2) &&
        count($pole2) != 0)
    {
      $diff = array_diff($pole1, $pole2); //vyhozeni rozdilu
      $result = array_values($diff);  //oprava indexu
    }

    return $result;
  }

/**
 *
 * Blokovane nazvy funkci pri select vypisu trid a jejich funkci
 *
 * @return pole nazvu
 */
  public function BlokovaneNazvyVypisu()
  {
    $result = array("__construct",
                    "AdminObsah", "PredaniAdminTitle", "PredaniAdminMenu",
                    "InstalaceDatabaze", "ExistujeTabulka",
                    "ChangeWrongChar", "BackChangeChar",
                    "NastavKomunikaci",
                    "PripojeniDatabaze", "ZavritDatabaze", "NastavCestu",
                    "ZjistiTypDB", "ZjistiCestu", "ZjistiClass", "ZjistiUkazatel", "ZjistiConnection", "ZjistiIdUkazatel",
                    "NavratPripojeni", "OverovaniManualPermission",
                    "GetTable", "GetColumnTable", "ConnectModule",
                    "queryExec", "query", "querySingle", "querySingleRow", "queryMultiObjectSingle", "queryMultiArraySingle",
                    "numRows", "numChanges", "dateFormat",
                    "fetch", "fetchObject", "fetchFields", "lastInsertRowid",
                    "beginTransaction", "endTransaction",
                    "AktualniStatusDB", "AktualniKodovani",
                    "ZakodujText", "DekodujText", "DekodujAdresu",
                    "NactiObsahSouboru", "NactiUnikatniObsah", "PrevodUnikatnihoTextu",
                    "NastavitAdresuMenu", "VygenerujAjaxScript", "ZjistiRealClass", "AplikacePermission",
                    "AbsolutniUrl", "AdresarWebu",
                    "PorovnaniPole", "InfoGetBrowser", "GetBrowser", "GetBrowserLite",
                    "VypisHodnotu", "VypisPolozky", "NastavHodnotu", "VypisPocetRadku", "DuplikatniHodnota", "VypisSouboru",
                    "RimskeArabske", "ArabskeRimske",
                    "GetSessionId", "SetSessionUser", "GetSessionUser", "DelSessionUser", "RegenerateSession",
                    "BlokovaneNazvyVypisu", "ExistenceUrl", "NactiUrl", "KontrolaEmailu",
                    "MeritCas", "KalkulaceCas",
                    "TypOS", "TypBrowseru", "TypSystemu", "VysloveniDne",
                    "Autorizace", "AutorizaceOtherUser",
                    "DetekceLinuxu", "DetekceWindows", "DetekceOpery", "DetekceFirefoxu", "DetekceWebkitu", "DetekceChromeLinux",
                    "AlgPoctyOsProhlizecu", "DetekceIExplorer",
                    "VypisAdresaru", "Velikost", "VelikostAdresare", "FileVynorovani",
                    "AutoClick", "ErrorMsg", "ZjistiAtributy",
                    "ZkraceniTextu", "AjaxJQueryKonverze",
                    "ControlForm", "ControlConfig", "ControlDeleteForm", "ControlDeleteLast", "ControlSynchronize",
                    "ControlPicture", "ControlCreateDir", "ControlUploadFile", "ControlPreInstall", "ControlObjectHodnoty",
                    "ControlDeleteContentDir", "ControlWriteFile", "ControlIsPreInstall", "ControlCssSprit", "ControlCreateXml",
                    "RekurzivniKlesani", "RekurzivniStoupani", "AdminAddActionLog",
                    "PrevodNaRGB", "NahodnaRGBBarva",
                    "Svatek", "EqTv", "Hlaska", "NotEmpty",
                    "RewritePrepis", "PrepisTextu",
                    "InterpretDate", "InterpretTime",
                    "RozdelitHodnoty", "MezeraCisla",
                    "PocetDni");

    return $result;
  }

/**
 *
 * Algoritmus na setrideni a parsrovani agentu
 *
 * @param pole pole agentu
 * @return pole setridenych agentu
 */
  public function AlgPoctyOsProhlizecu($pole)
  {
    $result = "";
    foreach ($pole as $radek) //zpracovani prohlizecu
    {
      //$os = $this->TypOS($radek);
      //$browser = $this->TypBrowseru($radek);
      $sys = $this->TypSystemu($radek);
      $proh[$sys->os][] = $sys->browser; //nacteni prohlizecu do danych os
    }

    ksort($proh); //serazeni podle klicu
    //projiti prohlizecu
    foreach ($proh as $os => $brow)
    { //spocitani hodnot navstev pro ruzne systemy
      $pocty = array_count_values($brow);
      //vypis poctu navstev z os a prohlizecu
      foreach ($pocty as $p_brow => $p_pocet)
      {
        $result[] = array("brow" => $p_brow,
                          "os" => $os,
                          "count" => $p_pocet);
      }
    }

    return $result;
  }

/**
 *
 * Vypis informaci z user agenta
 *
 * @param agent user agent, nepovinny
 * @param automatic bool na zapinani automatickeho dosazovani agenta, nepovinne
 * @return objekt hodnot
 */
  public function TypSystemu($agent = NULL, $automatic = true)
  {
    $result = "";
    $result->agent = ($automatic ? (!Empty($agent) ? $agent : $_SERVER["HTTP_USER_AGENT"]) : $agent); //nacte si pouziteho agenta
    //pokud nalezne v browscap vystup
    //$brow = "";
/*
    if ($browscap = $this->GetBrowserLite($result->agent, false))
    {
      //print_r($browscap);
      $brow = $browscap["parent"];
      $roz = preg_split("/ /", $brow);
      if (count($roz) > 1 && is_numeric($roz[count($roz) - 1]))
      { //pokud je vytahnuty nazev s mezerou
        $brow = $roz[0];
      }
//var_dump($brow, $result->agent);
      switch ($brow)
      {
        case "Opera": //vyjimka u opery
          $parser = array("/Version\//", 1);
        break;

        case "Links": //vyjimka u linksu
          $parser = array("/{$brow} \(|; /", 1);
        break;

        case "ELinks":
          $parser = array("/{$brow}\/|~/", 1);
        break;

        case "Chrome":  //vyjimka u chrome
          $parser = array("/{$brow}\/| S/", 1);
        break;

        case "Firefox": //vyjimka u win firefoxu
          $parser = array("/{$brow}\/| \( /", 1);
        break;

        case "IE":
          $parser = array("/{$brow} |; /", 2);
        break;

        case "Galeon":
          $parser = array("/{$brow}\/| \(/", 2);
        break;

        case "Wget":
          $parser = array("/{$brow}\//", 1);
        break;

        case "Android":
          $parser = array("/{$brow} |; /", 3);
        break;

        default:  //ostatni user agenti
          $parser = array("/{$brow}\//", 1);
        break;
      }
      //parsnuti agentu kvuli verzi prohlizece, podle zadani
      $browver = preg_split($parser[0], $result->agent);
//print_r($browver);
      $ver = "";
      if (!Empty($browver[$parser[1]]))
      {
        $ver = " {$browver[$parser[1]]}";
      }
      //pridani verze prohlizece
      $result->browser = "{$brow}{$ver}";  //nazev + verze
//var_dump($result->browser, "\n\n");
      $result->os = $browscap["platform"];
    }
*/

    $result->browser = $this->TypBrowseru($result->agent);
    $result->os = $this->TypOS($result->agent);
//dodelat!! nejak dooptimalizovat!!
/*
    $brow = $this->GetBrowser($result->agent);
    $result->browser = $brow->browser;
    $result->os = $brow->platform;
*/

    return $result;
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
                    "Windows 7" => "/Windows NT 6\.1/i",
                    //"Windows 8" => "/Windows NT 7\.0/i",
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
                    "Ubuntu Linux" => "/((Ubuntu);.*(Linux))/i",
                    "Ubuntu Linux \\4 (\\5)" => "/((Linux).*(Ubuntu\/([0-9\.]+) \(([a-zA-Z]+)\)))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Android Linux \\2" => "/(Android ([0-9\.]+))/i",
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
//var_dump($agent); //dodelat!!! odladit!!
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        $c_matches = count($matches);
        for ($i = 0; $i < $c_matches; $i++)
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
                          "Mozilla Firefox \\2" => "#(Firefox|Shiretoko|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Chrome \\1" => "#Chrome/([a-zA-Z0-9\.]+) Safari/([a-zA-Z0-9\.]+)#i",
                          "Android Safari \\1" => "#Mobile Safari/([a-zA-Z0-9\.]+)#i",
                          "Aurora Safari \\1" => "#Arora/([a-zA-Z0-9\.]+)#i",
                          "rekonq Safari" => "#rekonq#i",
                          "Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
                          "Flock \\1" => "#Flock/([a-zA-Z0-9\.]+)#i",
                          "Epiphany \\1" => "#Epiphany/([a-zA-Z0-9\.]+)#i",
                          "Konqueror \\1" => "#Konqueror/([a-zA-Z0-9\.]+)#i",
                          "Maxthon \\1" => "#Maxthon ?([a-zA-Z0-9\.]+)?#i",
                          "K-Meleon \\1" => "#K-Meleon/([a-zA-Z0-9\.]+)#i",
                          "Lynx \\1" => "#Lynx/([a-zA-Z0-9\.]+)#i",
                          "Links \\1" => "#Links \(.{2}([a-zA-Z0-9\.]+)#i",
                          "ELinks \\3" => "#ELinks([/ ]|(.{2}))([a-zA-Z0-9\.]+)#i",
                          "Debian IceWeasel \\1" => "#(iceweasel)/([a-zA-Z0-9\.]+)#i",
                          "Mozilla SeaMonkey \\2" => "#(SeaMonkey)/([a-zA-Z0-9\.]+)#i",
                          "OmniWeb" => "#OmniWeb#i",
                          "Galeon Mozilla \\1" => "#Galeon/([a-zA-Z0-9\.]+)#i",
                          "Mozilla Fennec \\2" => "#^Mozilla/5\.0.*rv:([a-zA-Z0-9\.]+).*Fennec/([a-zA-Z0-9\.]+)#i",
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
                          "Wget \\1" => "#([0-9\.]+)#i",
                          "Neznámý" => "/(.*)/");

    foreach($BrowserList as $browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if (!Empty($matches))
        {
          $c_matches = count($matches);
          for ($i = 0; $i < $c_matches; $i++)
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
 * Zjisteni verze pouzivaneho browscapu
 *
 * @return informacni pole
 */
  public function InfoGetBrowser()
  {
    $cesta = "{$this->AdresarWebu()}/browscap/php_browscap.ini";
    if (file_exists($cesta))
    { //funkci volat s jinymi parametry od verze 5.3.0> alias 50300
      if (PHP_VERSION_ID >= 50300)
      { //pokud je verze >= 5.3.0
        $data = parse_ini_file($cesta, true, INI_SCANNER_RAW);
      }
        else
      { //ostatni verze
        $data = parse_ini_file($cesta, true);
      }
    }
//predelat!!!! dodelat!!
    return $data["GJK_Browscap_Version"];
  }

/**
 *
 * Zjisteni verze prohlizece a systemu s pomoci browscapu, ekvivalent k get_browser
 *
 * @param agent, user agent, nepovinny
 * @return informacni pole o agentu
 */
  public function GetBrowser($agent = NULL)
  { //data: http://browsers.garykeith.com/downloads.asp
    //class: https://github.com/GaretJax/phpbrowscap
    $result = "";
    $brow = new Browscap($this->dircache);
    $brow->lowercase = true;  //male pismena v promennch
    $brow->doAutoUpdate = false;  //zakazany autoupdate!
    $cesta_cache = "{$this->dircache}/{$brow->cacheFilename}";
    $cesta_ini = "{$this->dircache}/{$brow->iniFilename}";
    if (file_exists($cesta_cache) &&
        file_exists($cesta_ini))
    {
      $result = $brow->getBrowser($agent);  //vystup v objektech
    }
      else
    {
      echo "need install browscap!";
    }

    return $result;
  }

/**
 *
 * Zjisteni verze prohlizece a systemu s pomoci browscapu, ekvivalent k get_browser, odlehcena verze
 *
 * @param agent, user agent, nepovinny
 * @return informacni pole o agentu
 */
  public function GetBrowserLite($agent = NULL, $auto = true)
  { //pouzito z php.net, data: http://browsers.garykeith.com/downloads.asp
    $result = "";
    $agent = ($auto ? (!Empty($agent) ? $agent : $_SERVER["HTTP_USER_AGENT"]) : $agent);
//dodelat!! aplikovano ??
//ue?! na neco???
/*
    $brows = $this->var->browscap;  //nacteni z globalni promenne
    //var_dump($this->var->browscap); //dodelat!! doresit!!
    if (is_array($brows))
    {
      foreach ($brows as $k => $t)
      {
        if(fnmatch($k, $agent))
        {
          //vraceni prohlizece a os platformy
          $result["parent"] = (!Empty($t["Browser"]) ? ($t["Browser"] != "Default Browser" ? $t["Browser"] : "unknown") : $t["Parent"]);
          $result["platform"] = (!Empty($t["Platform"]) ? $t["Platform"] : "unknown");
          //print_r($t);
          break;
        }
      }
    }
      else
    {
      var_dump("nedostupne data");
    }
*/

    return $result;
  }

/**
 *
 * Detekce linuxu
 *
 * pouziti: <strong>".($this->var->main[0]->NactiFunkci("Funkce", "DetekceLinuxu") ? "je to linux" : "je to mrkvosoft")."</strong>
 *
 * @return jsou to linuxy / nejsou to linuxy - true(linux) / false(jine)
 */
  public function DetekceLinuxu()
  {
    $brow = $this->GetBrowser();
    $result = ($brow->platform == "Linux");

    return $result;
  }

/**
 *
 * Detekce windows
 *
 * ".($this->var->main[0]->NactiFunkci("Funkce", "DetekceMicrosoftu") ? "je to windows" : "je to coloki jineho")."
 *
 * @return bool, true je to windows
 */
  public function DetekceWindows()
  {
    $brow = $this->GetBrowser();
    $result = (substr_count($brow->browser_name_pattern, "Windows") ? true : false);

    return $result;
  }

/**
 *
 * Detekce IE
 *
 * ".($this->var->main[0]->NactiFunkci("Funkce", "DetekceIExplorer"[, array(6, 7)|6]) ? "je to IE (6|7)|6" : "je to coloki jineho")."
 *
 * @param verze cislo a nebo pole cislic, cislo IE verze, nepovinny
 * @return bool, true je to IE (pripadne dle jake verze)
 */
  public function DetekceIExplorer($verze = NULL)
  {
    $brow = $this->GetBrowser();
    $a = explode(" ", $brow->browser);
    $result = ($a[0] == "IE" && (!Empty($verze) ? (is_array($verze) ? in_array($brow->majorver, $verze) : $brow->majorver == $verze) : true));

    return $result;
  }

/**
 *
 * Detekce firefoxu
 *
 * ".($this->var->main[0]->NactiFunkci("Funkce", "DetekceFirefoxu") ? "je to firefox" : "je to coloki jineho")."
 *
 * @return bool, true je to firefox
 */
  public function DetekceFirefoxu()
  {
    $brow = $this->GetBrowser();
    $result = ($brow->browser == "Firefox");

    return $result;
  }

/**
 *
 * Detekce webkit jadra
 *
 * ".($this->var->main[0]->NactiFunkci("Funkce", "DetekceWebkitu") ? "je to webkit" : "je to coloki jineho")."
 *
 * @return bool, true je to webkit jadro
 */
  public function DetekceWebkitu()
  {
    $brow = $this->GetBrowser();
    $result = (substr_count($brow->browser_name_pattern, "AppleWebKit") ? true : false);

    return $result;
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
    $brow = $this->GetBrowser();
    $result = ($brow->browser == "Opera");

    return $result;
  }

/**
 *
 * Detekce chrome linux
 *
 * ".($this->var->main[0]->NactiFunkci("Funkce", "DetekceChromeLinux") ? "je to chrome" : "je to coloki jineho")."
 *
 * @return bool, true je to chrome na linuxu
 */
  public function DetekceChromeLinux()
  {
    $brow = $this->GetBrowser();
    $result = ($brow->browser == "Chrome" && $brow->platform == "Linux");

    return $result;
  }

/**
 *
 * Zjisti atributy opravneni souboru
 *
 * @param cesta cesta k souboru
 * @param oktal true/false - vraci oktal/vraci standartni textovy rwx
 * @return text opravneni
 */
  public function ZjistiAtributy($cesta, $oktal = false)
  {
    $result = "";
    if (file_exists($cesta))
    {
      $perms = fileperms($cesta); //nacte prava v int

      if ($oktal) //pocta ctal a nebo plny tvar
      {
        $result = substr(decoct($perms), -4);
      }
        else
      {
        if (($perms & 0xC000) == 0xC000)
        {
          // Socket
          $result = "s";
        }
          elseif (($perms & 0xA000) == 0xA000)
        {
          // Symbolic Link
          $result = "l";
        }
          elseif (($perms & 0x8000) == 0x8000)
        {
          // Regular
          $result = "-";
        }
          elseif (($perms & 0x6000) == 0x6000)
        {
          // Block special
          $result = "b";
        }
          elseif (($perms & 0x4000) == 0x4000)
        {
          // Directory
          $result = "d";
        }
          elseif (($perms & 0x2000) == 0x2000)
        {
          // Character special
          $result = "c";
        }
          elseif (($perms & 0x1000) == 0x1000)
        {
          // FIFO pipe
          $result = "p";
        }
          else
        {
          // Unknown
          $result = "u";
        }

        //Owner
        $result .= (($perms & 0x0100) ? "r" : "-");
        $result .= (($perms & 0x0080) ? "w" : "-");
        $result .= (($perms & 0x0040) ?
                    (($perms & 0x0800) ? "s" : "x" ) :
                    (($perms & 0x0800) ? "S" : "-"));
        // Group
        $result .= (($perms & 0x0020) ? "r" : "-");
        $result .= (($perms & 0x0010) ? "w" : "-");
        $result .= (($perms & 0x0008) ?
                    (($perms & 0x0400) ? "s" : "x" ) :
                    (($perms & 0x0400) ? "S" : "-"));
        // World
        $result .= (($perms & 0x0004) ? "r" : "-");
        $result .= (($perms & 0x0002) ? "w" : "-");
        $result .= (($perms & 0x0001) ?
                    (($perms & 0x0200) ? "t" : "x" ) :
                    (($perms & 0x0200) ? "T" : "-"));
      }
    }

    return $result;
  }

/**
 *
 * Vraceni odpocitavaneho casu pro vypocet delky provaden skryptu
 *
 * @return cas stopek v ms
 */
  public function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $result = $cas[1] + $cas[0];

    return $result;
  }

/**
 *
 * Kalkulace odpocitavani
 *
 * @param start pocatecni cas
 * @param konec koncovy cas
 * @return uplynuly cas v sec.
 */
  public function KalkulaceCas($start, $konec)
  {
    $result = Abs(Round(($konec - $start) * 10000) / 10000); //Abs, vypocet

    return $result;
  }

/**
 *
 * Vynorovani se ze slozek, bliz ke korenu
 *
 * @param cesta vstupni cesta
 * @return vynorenou cestu
 */
  public function FileVynorovani($cesta)
  {
    $poc = 0;
    $prvni = $cesta;
    //cyklicke vynorovani ze slozek(sestup)
    if (!file_exists($cesta)) //pokud cesta neexistuje zanoruje
    {
      while (!file_exists($cesta))
      {
        $cesta = "../{$cesta}";
        $poc++;
        if ($poc > 10)  //kontrola zacykleni
        {
          $cesta = $prvni;  //vrati puvodni cestu kdyz se zacykli
          break;
        }
      }
    }

    return $cesta;
  }

/**
 *
 * Rozdeli jednolite pole po zadanych krocich do ruznych oddilu
 *
 * @param vstup vstupni pole napr: array(1, "h", "p", "h", "p", "h", "p")
 * @param po cislo rozdeleni po potu znaku napr: 2 (v pripade uvedeneho pole)
 * @param od cislo od ktereho si vezme z pole data, defaultne: 1
 * @return rozdelene pole na bloky poli
 */
  public function RozdelitHodnoty($vstup, $po, $od = 1)
  {
    $result = "";
    if (is_array($vstup))
    {
      //vytahnuti pole prvku od
      $pole = array_slice($vstup, $od);
      for ($i = 0; $i < count($pole); $i += $po)
      { //roztrideni hodnot podle potreby
        for ($j = 0; $j < $po; $j++)
        { //rozhazeni podle poctu po
          $result[$j][] = $pole[$i + $j]; //vlozeni vypoctenych hodnot
        }
      }
    }

    return $result;
  }

/**
 *
 * Ovladani insert/update dotazu formulare
 *
 * elementy:
 * array(nazev_polozky_db => array(zdroj, typ[, vlastni_zdroj, separator_pole]), ...)
 *
 * podminka:
 * (!Empty($_POST["tlacitko"]))
 *
 * nastaveni:
 * array(typ_akce, nazev_db_s_predponou[, id_u_update]),
 *
 * u typu dotazu: copy
 * musi byt jeden sloupec typu: self|copy -> ten se prepisuje vetsinou last_id
 * musi se i uvest v nastaveni id radku, slouzi jako zdrojove id pro kopirovani dat podle sloupce oznaceneho: self|copy
 *
 * @param elementy pole elementu >> array("nazev" => array("post/post|opt/|get/get|opt/|self|copy|/self|copy/", "string/string|code/string|decode/string|2md5/string|pref/string|suff/|integer|boolean|date|float|array"[, $_POST["nazev"]|$value|"nazev"|"now"(u date), "|+|"]), ...)
 * @param podminka blokova ukladaci podminka >> (!Empty($_POST["tlacitko"]))
 * @param nastaveni preda: akce, nazev db[, id radek] >> array("insert|update|copy", "sablona"[, NULL|$id|2, true(debug)]),
 * @param &error text chybove hlasky
 * @return bool o provedeni dotazu
 */
  public function ControlForm($elementy, $podminka, $nastaveni, &$error = NULL)
  {
    //$nastaveni[0] : typ dotazu
    //$nastaveni[1] : nazev db
    //$nastaveni[2] : [id radku]
    //$nastaveni[3] : [true -> debug on]

    //povolene typy
    $allowtype = array ("string",
                        "string|code",  //zakodovani
                        "string|decode",  //dekovani
                        "string|2md5",  //2md5
                        "string|pref",  //prefix
                        "string|suff",  //suffix
                        "integer",
                        "boolean",
                        "date",
                        "float",
                        "array");

    $result = false;
    if ($podminka &&
        is_array($elementy) &&  //elementy musi byt pole
        is_array($nastaveni) &&
        in_array($nastaveni[0], array("insert", "update", "copy"))  //akceptovane dotazy
        )
    { //typy na preskoceni
      $skiptype = array($allowtype[1] => $allowtype[0],
                        $allowtype[2] => $allowtype[0],
                        $allowtype[3] => $allowtype[0],
                        $allowtype[4] => $allowtype[0],
                        $allowtype[5] => $allowtype[0]);
      //nacitani hodnot
      $sloupce = "";
      $copysloupce = "";
      foreach ($elementy as $index => $polozky) //rozdeleni elementu
      {
        switch ($polozky[0])  //rozdeleni nacitani podle zdroje
        {
          case "get": //nacitani z get
            $sloupce[$index] = $_GET[$index];
          break;

          case "get|opt": //nacitani z get, pokud je prazdny pouzije vlastni
            $sloupce[$index] = (!Empty($_GET[$index]) ? $_GET[$index] : $polozky[2]);
            //pokud pouzije puvodni hodnotu a jedna se o preskakovany typ tak se prevede
            if (Empty($_POST[$index]) && !Empty($skiptype[$polozky[1]]))
            { //prevedeni specialniho typu na obycejny odvozeny ze specialniho
              $polozky[1] = $skiptype[$polozky[1]];
            }
          break;

          case "post":  //nacitani z post
            $sloupce[$index] = $this->NotEmpty("post", $index);  //$_POST[$index];
          break;

          case "post|opt":  //nacitani z post, pokud je prazdny pouzije vlastni
            $sloupce[$index] = (!Empty($_POST[$index]) ? $_POST[$index] : $polozky[2]);
            //pokud pouzije puvodni hodnotu a jedna se o preskakovany typ tak se prevede
            if (Empty($_POST[$index]) && !Empty($skiptype[$polozky[1]]))
            { //prevedeni specialniho typu na obycejny odvozeny ze specialniho
              $polozky[1] = $skiptype[$polozky[1]];
            }
          break;

          case "self":  //vlastni hodnota
            $sloupce[$index] = $polozky[2];
          break;

          case "self|copy": //vlastni hodnota a sloupec pro urceni nacitanych hodnot
            $sloupce[$index] = $polozky[2];
            //nacte si id pro spravne rizeni kopirovani
            $directid = $this->querySingle("SELECT id FROM {$this->dbpredpona[$this->idukazatel]}{$nastaveni[1]} WHERE {$index}='{$nastaveni[2]}';", false);

          break;

          case "copy":  //kopirovani hodnoty
            //projiti id a natahnuti hodnot podle id
            if (!Empty($directid) &&
                is_array($directid))
            {
              foreach ($directid as $idecko)
              { //predponu tabulky si funkce vklada uz sama
                $copysloupce[$idecko][$index] = $this->VypisHodnotu($index, $nastaveni[1], $idecko);
              }
            }
          break;

          default:
            $error = "chyba v indexu: {$index}, špatny zdroj: {$polozky[0]}";
            //return NULL;
          break;
        }

        //natypovani vstupu
        if (in_array($polozky[1], $allowtype))
        {
          //konverze hodnot
          switch ($polozky[1])
          {
            case "string":  //osetreni pri stringu
              $sloupce[$index] = "'{$this->ChangeWrongChar($sloupce[$index])}'";  //pridani '
            break;

            case "string|code": //zakodovat string
              $sloupce[$index] = "'{$this->ZakodujText($this->ChangeWrongChar($sloupce[$index]))}'";
              $polozky[1] = "string"; //prepsani typu na string
            break;

            case "string|decode": //dekodovat string
              $sloupce[$index] = "'{$this->ChangeWrongChar($this->DekodujText($sloupce[$index]))}'";
              $polozky[1] = "string"; //prepsani typu na string
            break;

            case "string|2md5": //2md5 string
              $md5 = md5(md5($this->ChangeWrongChar($sloupce[$index])));
              $sloupce[$index] = "'{$md5}'";
              $polozky[1] = "string"; //prepsani typu na string
            break;

            case "string|pref": //predpona string
              $sloupce[$index] = "'{$this->ChangeWrongChar($polozky[2].$sloupce[$index])}'";
              $polozky[1] = "string"; //prepsani typu na string
            break;

            case "string|suff": //koncovka string
              $sloupce[$index] = "'{$this->ChangeWrongChar($sloupce[$index].$polozky[2])}'";
              $polozky[1] = "string"; //prepsani typu na string
            break;

            case "boolean": //osetreni pri bool, uklada se jako integer
              $sloupce[$index] = (!Empty($sloupce[$index]) ? 1 : 0);
              $polozky[1] = "integer"; //prepsani typu na integer
            break;

            case "date":  //osetreni datumu
              $intdat = $this->ChangeWrongChar(is_numeric($sloupce[$index]) ? $sloupce[$index] : strtotime($sloupce[$index]));
              $datum = date("Y-m-d H:i:s", $intdat);  //prevod na regulerni datum
              $sloupce[$index] = "'{$datum}'";  //pridani '
              $polozky[1] = "string"; //prepsani typu na string
            break;

            case "array": //osetreni pole, uklada se jako string
              if (!Empty($polozky[3]))  //kontrola spojovaciho textu
              {
                $pole = ""; //pokud je vstup pole, jinak vrati jen text
                if (is_array($sloupce[$index]))
                {
                  $pole = implode($polozky[3], $sloupce[$index]);
                }
                $sloupce[$index] = "'{$this->ChangeWrongChar($pole)}'"; //pridani '
                $polozky[1] = "string"; //prepsani typu na string
              }
                else
              {
                $error = "spojovaci text u indexu: {$index} nebyl definovan";
                //return NULL;
              }
            break;
          }
          settype($sloupce[$index], $polozky[1]); //typova konverze
        }
          else
        {
          $error = "chyba v indexu: {$index}, špatny typ: {$polozky[1]}";
          //return NULL;
        }
      }

      if (is_array($sloupce))
      {
         //slozeni sql dotazu
        $klice = implode(", ", array_keys($sloupce)); //vyber klicu a slouceni pro 1/2 dotazu
        $hodnoty = implode(", ", array_values($sloupce)); //vyber hodnot a slouceni pro 2/2 dotazu
        $sql = "";
        //slozeni pozadovaneho typu
        switch ($nastaveni[0])
        {
          case "insert":  //tvorba insert
            $predpona = $this->NotEmpty($this->dbpredpona, $this->idukazatel);  //$this->dbpredpona[$this->idukazatel]
            $sql = "INSERT INTO {$predpona}{$nastaveni[1]} ({$klice}) VALUES ({$hodnoty});"; //tvar insert dotazu
          break;

          case "update":  //tvorba update
            if ($nastaveni[2] > 0)  //kontrola nenuloveho id
            {
              $polozky = "";
              foreach ($sloupce as $klic => $hodnota)
              {
                $polozky[] = "{$klic}={$hodnota}";  //vlozeni vedle sebe klice a hodnoty
              }
              $hodnoty = implode(", ", $polozky); //spojeni klicu a hodnot

              $sql = "UPDATE {$this->dbpredpona[$this->idukazatel]}{$nastaveni[1]} SET {$hodnoty} WHERE id={$nastaveni[2]};"; //tvar update dotazu
            }
              else
            {
              $error = "id pro update: {$nastaveni[2]} ma špatnou hodnotu";
              //return NULL;
            }
          break;

          case "copy":  //copy, tvorba skupiny insert dotazu
            //projde pole kopirovani
            if (!Empty($copysloupce) &&
                is_array($copysloupce))
            {
              foreach ($copysloupce as $row)
              {
                $sl = $sloupce; //zkopiruje si original pole a prepise nactenyma hodnotama
                foreach ($row as $indexcols => $cols)
                { //prepisuje kopii puvodniho pole sloupcu
                  $sl[$indexcols] = "'{$cols}'";  //nacita jako text
                }

                //vyber klicu a slouceni pro dotazu
                $sl_key = implode(", ", array_keys($sl));
                $sl_val = implode(", ", array_values($sl));
                $sql[] = "INSERT INTO {$this->dbpredpona[$this->idukazatel]}{$nastaveni[1]} ({$sl_key}) VALUES ({$sl_val});"; //tvar insert dotazu
              }

              $sql = implode("\n", $sql); //slouceni dotazu pomoci entru
            }
          break;
        }

        if (!Empty($nastaveni[3]) &&
            $nastaveni[3])
        {
          var_dump($sql);
          return NULL;
        }

        if (!Empty($sql)) //pokud se podarilo seskladat dotaz
        {
          $res = $this->queryExec($sql, $error); //provedeni slozeneho dotazu
          $result = $res;
//dodelat!! dotestovat pocet radku v mysqli!!, pri zmene vravi 1, pri zedne zmene 0
          //pokud se provede zmena radku tak poskytne aktualni result
          //$result = ($this->numChanges() ? $res : $result);
          if (!Empty($error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Nacitani hodnot do objektoveho pole
 *
 * @param pole vstupni pole hodnota, array("hodnota", "hodnota2",...)
 * @param nastaveni pole nastaveni, array("tabulka", $id[, "id="])
 * @return hodnoty v objektu
 */
  public function ControlObjectHodnoty($pole, $nastaveni)
  {
    $sloupce = implode(", ", $pole);  //sloupeni podle carky
    $podminka = (!Empty($nastaveni[2]) ? $nastaveni[2] : "id=");
    $predpona = $this->NotEmpty($this->dbpredpona, $this->idukazatel);  //$this->dbpredpona[$this->idukazatel]
    $dotaz = "SELECT {$sloupce} FROM {$predpona}{$nastaveni[0]} WHERE {$podminka}'{$nastaveni[1]}';";
    //provedeni dotazu
    $result = $this->querySingleRow($dotaz);

    return $result;
  }

/**
 *
 * Overovani jestli je predinstalovana databaze
 *
 * @return bool o existenci preinstall
 */
  public function ControlIsPreInstall()
  {
    $cesta = "{$this->pathdb[$this->idukazatel]}/.installdata";
    $result = file_exists($cesta);

    return $result;
  }

/**
 *
 * Ovladani predinstalace dat do tabulek
 *
 * @param tabulky vstupni pole: array(tabulka => array(array("id" => 1, "sloupec" => "hodnota"), array([dalsi radek tabulky...])))
 * @param nastaveni pole nahrazeni za %% pro pole hodnot: array("index1", "index2"[...])
 * @param &error text chybove hlasky, nepovinne
 * @return bool o provedeni dotazu
 */
  public function ControlPreInstall($tabulky, $nastaveni = NULL, &$error = NULL)
  {
    $result = false;
    //cesta install break-u
    $cesta = "{$this->pathdb[$this->idukazatel]}/.installdata";
    if (is_array($tabulky) &&
        !file_exists($cesta))
    {
      $sql = "";
      //prochazeni vstupniho pole
      foreach ($tabulky as $tabulka => $radky)
      {
        //instaluje jen tehdy kdyz je tabulka prazdna
        if ($this->VypisHodnotu("COUNT(id)", $tabulka, 1, "") == 0)
        {
          //prochazeni polozek tabulek
          foreach ($radky as $radek => $prvky)
          {
            //vytahnuti sloupcu a hodnot
            $sloupce = array_keys($prvky);
            $hodnoty = array_values($prvky);
            //pokud je nastaveni pole
            if (is_array($nastaveni))
            { //vytvoreni pole s array args
              $prepis = array_merge(array("array_args"), $nastaveni);
              //prepis %% hodnot
              foreach ($hodnoty as $index => $hodnota)
              { //prepisuje jednotlive hodnoty
                $hodnoty[$index] = $this->NactiUnikatniObsah($hodnota, $prepis);
              }
            }
            //slouceni sloupci a hodnot na text
            $slo = implode(", ", $sloupce);
            $hod = implode("', '", $hodnoty);
            //vytvoreni sql insert dotazu
            $sql[] = "INSERT INTO {$this->dbpredpona[$this->idukazatel]}{$tabulka} ({$slo}) VALUES ('{$hod}');";
          }
        }
      }
      //pokud se sql pole
      if (is_array($sql))
      {
        //slouceni dotazu pomoci entru
        $sql = implode("\n", $sql);
        //provedeni slozeneho dotazu
        if ($result = $this->queryExec($sql, $error))
        {
          //pokud se dotaz provedl
          if (is_writable($this->pathdb[$this->idukazatel])) //overeni zapisu
          { //vytvoreni souboru s datem preinstalace
            $u = fopen($cesta, "w");
            fwrite($u, date("Y-m-d H:i:s"));
            fclose($u);
          }
            else
          {
            $this->ErrorMsg("Není povolen zápis do složky: {$cesta}", array(__LINE__, __METHOD__));
          }
        }
          else
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
      }
      //pokud neprobehla preinstalace
      if (!file_exists($cesta))
      {
        $this->ErrorMsg("Data {$this->trida[$this->idukazatel]} nebyla předinstalována!", array(__LINE__, __METHOD__));
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
 * Ovladani konfigurace
 *
 * hodnoty:
 * array("nazev_promenne" => array("post|get|self", "string|integer|boolean|date", $vlastni)) - save
 * array("nazev_promenne"[ => "separator"]) - load
 *
 * podminka:
 * (!Empty($_POST["tlacitko"])) - save
 * true - load
 *
 * nastaveni:
 * array("save|config/load|config/"direct|load|config"", "cesta konfig souboru")
 *
 * @param hodnoty pole hodnot na ulozeni/nacteni: array(nazev => array(zdroj, typ_hodnoty, $vlastni))
 * @param podminka bool podminka na provedeni konfigurace
 * @param nastaveni pole nastaveni: typ operace, cesta na otevreni/ulozeni
 * @return bool o provedeni konfigurace
 */
  public function ControlConfig($hodnoty, $podminka, $nastaveni)
  {
    //podporovane datove typy
    $support_type = array("string", "string|base64",
                          "integer", "date", "boolean", "array");
    //vstupni podminka
    $result = false;
    if ($podminka &&
        is_array($hodnoty) &&  //elementy musi byt pole
        is_array($nastaveni) &&
        in_array($nastaveni[0], array("save|config", "load|config", "direct|load|config"))  //akceptovane dotazy
        )
    {
      //nacitani hodnot
      $sloupce = "";
      foreach ($hodnoty as $index => $polozky) //rozdeleni elementu
      {
        switch ($polozky[0])  //rozdeleni nacitani podle zdroje
        {
          case "get": //nacitani z get
            $sloupce[$index] = $_GET[$index];
          break;

          case "post":  //nacitani z post
            $sloupce[$index] = $this->NotEmpty("post", $index);  //$_POST[$index];
          break;

          case "self":  //vlastni hodnota
            $sloupce[$index] = $polozky[2];
          break;

          case "load":  //nacitani hodnot do dane promenne
            $sloupce[$index] = $polozky[1];
          break;

          default:  //nacteni jen hodnot a nebo hodnot a indexu
            //indexu musi byt neciselny!
            $sloupce[$polozky] = (!is_numeric($index) ? $index : "");
          break;
        }

        //osetreni vstupnich hodnot pri ukladani
        if (!Empty($polozky[1]) &&
            $nastaveni[0] == "save|config" &&
            in_array($polozky[1], $support_type)  //bere jen podporovane typy
            )
        {
          //konverzni switch
          switch ($polozky[1])
          {
            case "string":  //osetreni stringu
              $sloupce[$index] = (string)$sloupce[$index];
              //$this->ChangeWrongChar($sloupce[$index], NULL, "file");
            break;

            case "string|base64":
              $sloupce[$index] = base64_encode($sloupce[$index]);
            break;

            case "integer":
              $sloupce[$index] = (int)$sloupce[$index];
            break;

            case "date":  //osetreni datumu
            //$this->ChangeWrongChar($sloupce[$index], NULL, "file"))
              $sloupce[$index] = date("Y-m-d H:i:s", strtotime((string)$sloupce[$index]));
              //$polozky[1] = "string"; //prepsani typu na string
            break;

            case "boolean": //osetreni bool
              $sloupce[$index] = (int)(!Empty($sloupce[$index]) ? 1 : 0);
              //$polozky[1] = "integer";  //pretypovani na integer
            break;

            //case "array":
          }
          //settype($sloupce[$index], $polozky[1]); //typova konverze
        }
      }

      //pokud je to pole pokracuje
      if (is_array($sloupce))
      {
        //slozeni pozadovaneho typu
        switch ($nastaveni[0])
        {
          case "save|config": //upadani konfigu
            $xml = new SimpleXMLElement("<config></config>");
            foreach ($sloupce as $indexhodn => $hodn)
            {
              if (is_array($hodn))
              { //ukladani pole
                //<nazev type="typ"></nazev>
                $pole = $xml->addChild($indexhodn);
                $pole->addAttribute("type", $hodnoty[$indexhodn][1]);
                foreach ($hodn as $klic => $hodnota)
                { //<key name="klic">hodnota</key>
                  $pole->addChild("key", $hodnota)->addAttribute("name", $klic);
                }
              }
                else
              { //ukladani textu
                //<nazev type="typ">hodnota</nazev>
                $xml->addChild($indexhodn, $hodn)->addAttribute("type", $hodnoty[$indexhodn][1]);
              }
            }
            //ulozeni do xml formatu, +vraceni stavu
            $result = $xml->asXML($nastaveni[1]);
          break;

          case "load|config": //nacitani configu do promenne
            if (file_exists($nastaveni[1]) &&
                is_file($nastaveni[1]))
            { //nacteni xml
              $result = (object)"";
              $xml = simplexml_load_file($nastaveni[1]);
              //prochazeni xml objektu
              foreach ($sloupce as $klic => $hodnota)
              {
                //nacteni typu promenne
                $type = (string)$xml->$klic->attributes();
                //zpracovani dle typu
                switch ($type)
                {
                  case "array":
                    $row = array();
                    foreach ($xml->$klic->key as $hodn)
                    { //nacteni pole, nacitani vseho
                      $index = (string)$hodn->attributes(); //nacteni indexu
                      $row[$index] = (string)$hodn; //nacteni hodnoty do indexu
                    }
                    //nacteni pole
                    $result->$klic = $row;
                  break;

                  case "string|base64":
                    $result->$klic = base64_decode((string)$xml->$klic);
                  break;

                  default:
                    $result->$klic = (string)$xml->$klic;
                  break;
                }
              }
            }
          break;
        }
      }
    }

    return $result;
  }

/**
 *
 * Ovladani delete dotazu formulare
 *
 * tabulky:
 * array(tabulka => array(podminka[, id pro podminku|nebo pole id pro jeden sloupec, sloupec_na_vraceni]), ...)
 *
 * @param tabulky pole tabulek a jejich id >> array("tabulka" => array("nazev"[$id|array id, "sloupec"]), ...)
 * @param &navrat vrati obsah nastaveneho sloupce na vraceni
 * @param &error text chybove hlasky, nepovinne
 * @return bool o provedeni dotazu
 */
  public function ControlDeleteForm($tabulky, &$navrat, &$error = NULL)
  {
    $result = false;
    $dotaz = "";
    foreach ($tabulky as $index => $polozky)
    {
      if (!Empty($polozky[1]) &&
          !Empty($polozky[2]))
      { //nacteni kontrolni hodnoty z db pred smazanim
        $ide = (is_array($polozky[1]) ? $polozky[1][0] : $polozky[1]);
        $navrat = $this->VypisHodnotu($polozky[2], $index, $ide);
      }

      if (!Empty($polozky[1]))  //kdyz je id na podminku neprazdne naplni id pro sql
      {
        //pokud nejsou dale zadane jine id, pouzije prvni
        //pokud je polozky[1] pole prida do cisteho id
        if (is_array($polozky[1]))
        {
          $id = $polozky[1];
        }
          else
        {
          $id[] = $polozky[1];
        }
      }

      //prochazeni pole id na slozeni dotazu
      foreach ($id as $idx)
      {
        $dotaz[] = "DELETE FROM {$this->dbpredpona[$this->idukazatel]}{$index} WHERE {$polozky[0]}='{$idx}';";
      }
    }

    if (is_array($dotaz)) //pokud dostane dotaz, a navratova hodnota existuje
    { //nasypani dotazu po jednom
//dodelat!! prepsat!!
      foreach ($dotaz as $sql)
      {
        if (!Empty($sql))
        {
          $res = $this->queryExec($sql, $error); //provedeni slozeneho dotazu
          //pokud se provede zmena radku tak poskytne aktualni result
          $result = ($this->numChanges() ? $res : $result);
//dodelat!! mozna prepsat funkci queryExec pro mysqli!!!
          if (!Empty($error))
          {
            $this->ErrorMsg($error, array(__LINE__, __METHOD__));
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Ovladani delete dotazu jen na poslednich X zaznamu
 *
 * tabulky:
 * array("tabulka" => array(nechat_zaznamu, id_podminky[def=1], "text_podminky"[def=""]))
 *
 * @param tabulky konfiguracni pole nastaveni
 * @param &ovlivneno pocet ovlivnenych radku v databazi
 * @param &error text chybove hlasky
 * @return bool o provedeni dotazu
 */
  public function ControlDeleteLast($tabulky, &$ovlivneno, &$error)
  {
    $result = false;
    $dotaz = "";
    //prochazeni tabulke a jejich nastaveni
    foreach ($tabulky as $index => $polozka)
    { //nacteni poctu radku dane db, dle danych podminek, pokud je dotaz presnejsi
      $pocet = $this->VypisHodnotu("COUNT(id)", $index, $polozka[1], $polozka[2]);
      $nechat = $polozka[0];  //nacte si cislo pro max ponechanych zaznamu
      settype($nechat, "integer");  //kolik se ma nechat, dodatecne natypovani
      $smazat = "";
      //pokud je pocet radku db vetsi nez pocet pozadovanych poslednich
      if ($pocet > $nechat)
      {
        //od 0 do pocet-poslednichX
        $delka = $pocet - $nechat;  //vypocet
        //seradi podle ASC a vezme od 0 po pocet_radku-nechat_pocet
        $hodnoty = $this->querySingle("SELECT id FROM {$this->dbpredpona[$this->idukazatel]}{$index} WHERE {$polozka[2]}'{$polozka[1]}' ORDER BY id ASC LIMIT 0,{$delka};", false);
        $smazat = implode(", ", $hodnoty);  //slozeni id na smazani
        $dotaz[] = "DELETE FROM {$this->dbpredpona[$this->idukazatel]}{$index} WHERE id IN ({$smazat});";
      }
    }

    if (is_array($dotaz)) //pokud dostane dotaz, a navratova hodnota existuje
    {
      $sql = implode("\n", $dotaz);
///dodelat!! prepsat!!
      if (!Empty($sql))
      {
        $result = $this->queryExec($sql, $error); //provedeni slozeneho dotazu
        $ovlivneno = $this->numChanges(); //vrati pocet ovlivnenych radku
      }
    }

    return $result;
  }

/**
 *
 * Promazani zadane slozky
 *
 * @param cesta ceska k adresari na promazani
 * @return text smazanych hlasek
 */
  public function ControlDeleteContentDir($cesta)
  {
    $result = "";
    if ($soubory = $this->VypisSouboru($cesta))
    {
      //prochazeni pole souboru
      foreach ($soubory as $soubor)
      {
        if (@unlink("{$cesta}/{$soubor}"))
        { //pokud se podari tak prida del hlasku
          $result .= $this->Hlaska("del", $soubor);
        }
      }
    }
      else
    {
      $result = $this->Hlaska("info", "Žádné soubory");
    }

    return $result;
  }

/**
 *
 * Vytvari slozky dle konfiguracniho pole az do libovolnych zanoreni
 *
 * pole:
 * array(array("adresar", "adresar1", "adresar2"))
 *
 * @param pole, vstupni pole vytvarenych adresaru
 */
  public function ControlCreateDir($pole)
  {
    foreach ($pole as $hodnoty) //prochazi hlavni pole polozek
    {
      $slozka = ""; //vynulovani generovaneho nazvu slozek
      foreach ($hodnoty as $polozka)  //prochazi kazde jeden smer slozek
      {
        $slozka .= "{$polozka}/"; //scita jmeno slozky
        if (!file_exists($slozka))  //overuje existenci
        {
          mkdir($slozka, 0777); //vytvari slozky
        }
      }
    }
  }

/**
 *
 * Zapis dat do zadaneho/zadanych souboru
 *
 * pole:
 * array("cesta" => "data"[, ...])
 *
 * @param pole vstupni pole na ulozeni dat
 * @return hlaska o akci
 */
  public function ControlWriteFile($pole)
  {
    $result = "";
    foreach ($pole as $cesta => $data)
    {
      if ($u = @fopen($cesta, "w"))
      {
        fwrite($u, $data);
        fclose($u);

        $result .= $this->Hlaska("info", "Vytvoreno: {$cesta}");
      }
        else
      {
        $result .= $this->Hlaska("warning", "Nelze zapsat do: {$cesta}");
      }
    }

    return $result;
  }

/**
 *
 * Ovlada upload souboru
 *
 * soubory:
 * array("cesta" => array("name_elementu", "name_input_type_file"))
 *
 * @param soubory konfiguracni pole pro upload
 * @return pole nauploadovanych souboru
 */
  public function ControlUploadFile($soubory)
  {
    $result = array();
    foreach ($soubory as $cil => $polozka)
    {
      $tmp = $_FILES[$polozka[0]]["tmp_name"][$polozka[1]];
      settype($tmp, "array"); //predefinice na pole
      //prochazeni tmp souboru
      foreach ($tmp as $index => $temp)
      {
        $roz = explode(".", $_FILES[$polozka[0]]["name"][$polozka[1]][$index]); //rozdeleni jmena
        $dat = date("d-m-Y_H-i-s__"); //vytvoreni data
        $ran = rand(1000, 10000); //vytvoreni nahodneho cisla
        $nazev = "{$dat}{$ran}__{$this->RewritePrepis($roz[0])}.{$roz[count($roz) - 1]}";
        $cilnazev = "{$cil}/{$nazev}";  //slozeni cile a nazvu
        if (file_exists($temp) &&
            move_uploaded_file($temp, $cilnazev))
        { //nacitani nazvu
          $result["file"][] = $nazev;
          $result["name"][] = $_FILES[$polozka[0]]["name"][$polozka[1]][$index];
        }
      }
    }

    return $result;
  }

/**
 *
 * Zpracuje xml
 *
 * @param pole vstupni pole dat array("index" => array("zdroj:self|server", "typ:string|array", "vlastni hodnota"))
 * @param nastaveni array("head" => "", "body" => "", "out" => "",)
 * @return xml data pokud je dano
 */
  public function ControlCreateXml($pole, $nastaveni)
  {
    $result = "";

    $head = (!Empty($nastaveni["head"]) ? $nastaveni["head"] : "<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
    $body = (!Empty($nastaveni["body"]) ? $nastaveni["body"] : "<informace></informace>");

    //vygeneruje xml s daty a pak ulozi soubor
    $xml = new SimpleXMLElement("{$head}{$body}");
    //prochazeni definovaneho pole
    foreach ($pole as $index => $hodnota)
    {
      $text = "";
      //prepinani podle typu zdroje
      switch ($hodnota[0])
      {
        case "self":  //vlastni zdroj dat
          $text = $this->ZpracovaniVstupuXml($hodnota[1], $hodnota[2]);
        break;

        case "server":  //data ze serveru
          $text = $this->ZpracovaniVstupuXml($hodnota[1], $this->NotEmpty("server", $index));
        break;
      }
      //vlozeni do xmlka
      $xml->$index = $text;
    }
    //urci typ vystupu
    if (!Empty($nastaveni["out"]))
    { //pokud je nastaveny out tak ulozi do specifikovaneho souboru
      $xml->asXml($nastaveni["out"]);
    }
      else
    {
      $result = $xml->asXml();
    }

    return $result;
  }

/**
 *
 * Zpracovani nactenych hodnot
 *
 * @param typ typ vstupni hodnoty
 * @param hodnota vstupni hodnota
 * @return osetrena a zpracovana hodnota
 */
  private function ZpracovaniVstupuXml($typ, $hodnota)
  {
    $result = "";
    switch ($typ)
    {
      case "string":
        $result = $this->ChangeWrongChar($hodnota);
        settype($result, "string");
      break;

      case "array":
        if (is_array($hodnota))
        { //kdyz jo hodnota pole
          $result = $this->ChangeWrongChar(implode(", ", $hodnota));
          settype($result, "string");
        }
      break;
    }

    return $result;
  }

/**
 *
 * Ovladani uploadu a upravy obrazku
 *
 * obrazky:
 * array("name sub input file" => array(pocet, array(out1 => "0x0"|$var, out2 => "0x135")))
 *
 * nastaveni:
 * array("name main element", maxsize[1024*1024*X], array(out1 => "cesta k out 1", out2 => "cesta k out 2"))
 *
 * @param obrazky pole obrazku
 * @param nastaveni pole nastaveni
 * @return pole nazvu, kde je klic pouzity z klice v $obrazky
 */
  public function ControlPicture($obrazky, $nastaveni)
  {
    $result = "";
    $files = $_FILES[$nastaveni[0]];  //nacte si files pro dany element
    $maxsize = $nastaveni[1]; //nacte si meximalni velikost
    $slozky = $nastaveni[2];  //slozky na ukladani

    //projde zadane obrazky
    foreach ($obrazky as $indexobrazek => $obrazek)
    {
      //vystupnich adres prepis na uadane slozky
      $obr = "";
      foreach ($obrazek[1] as $indexset => $set)
      { //prepsani na cesty slozek
        $obr[$slozky[$indexset]] = $set;
      }

      $pocet = $obrazek[0]; //nacteni poctu obrazku
      if (is_null($pocet))
      { //upload jednoho obrazku
        $result[$indexobrazek] = $this->SavePicture($files, $indexobrazek, $maxsize, $obr);
      }
        else
      {
        //cyklicke pojiti nahranych obrazku
        $rozsah = range(0, $pocet - 1);
        foreach ($rozsah as $polozka)
        { //uploadu po obrazku
          $result[$indexobrazek][$polozka] = $this->SavePicture($files, "{$indexobrazek}{$polozka}", $maxsize, $obr);
        }
      }
    }

    return $result;
  }

/**
 *
 * Ulozi definovany obrazek a udela potrebne korekce a kopie
 *
 * @param files $_FILES daneho elementu
 * @param name subjmeno ve _FILES
 * @param size maximalni velikost
 * @param ulozit pole slozek a velikosti pro finalni ulozeni
 * @return vrati pole uploadovanych obrazku
 */
  private function SavePicture($files, $name, $size, $ulozit)
  {
    $result = "";
    $jmeno = date("d-m-Y_H-i-s_").rand(1000, 10000);
    $action = "";
    foreach ($ulozit as $indexout => $out)
    {
      $pripona = "";
      $obr = "";
      switch ($out)
      {
        case "own":
        case "0x0":
          switch ($out)
          {
            case "own":
              $source = "{$name}_mini";
            break;

            case "0x0":
              $source = $name;
            break;
          }

          $obr = $files["tmp_name"][$source];
          $typ = $files["type"][$source];
          if (file_exists($obr) &&
              $files["size"][$source] < $size)
          {
            $file = $obr;
            $pripona = $this->SuffixPicture($typ);
            $action = "upload";
          }
        break;

        default:
          $rozmer = explode("x", $out);
          $w = $rozmer[0];  //zadane velikosti na obrazky
          $h = $rozmer[1];

          $obr = $files["tmp_name"][$name];
          $typ = $files["type"][$name];
          if (file_exists($obr) &&
              $files["size"][$name] < $size)
          {
            $a = getimagesize($obr);  //nacteni rozmeru obrazku
            $old_w = $a[0]; //nactene velikosti z obrazku
            $old_h = $a[1];

            if ($w == 0)  //auto W
            {
              if ($old_w <= $h)
              {
                $new_w = $old_w;  //zanecha
                $new_h = $old_h;
              }
                else
              {
                $new_w = round($old_w / ($old_h / $h)); //zmensi
                $new_h = $h;
              }
            }

            if ($h == 0)  //auto H
            {
              if ($old_w <= $w)
              {
                $new_w = $old_w;  //zanecha
                $new_h = $old_h;
              }
                else
              {
                $new_w = $w; //zmensi
                $new_h = round($old_h / ($old_w / $w));
              }
            }

            if ($w != 0 && $h != 0)
            {
              if ($old_w <= $w &&
                  $old_h <= $h)
              {
                $new_w = $old_w;  //zanecha
                $new_h = $old_h;
              }
                else
              {
                $new_w = $w; //zmensi
                $new_h = $h;
              }
            }

            //nastaveni ciselneho typu na vypocitane hodnoty rozmeru
            settype($new_w, "integer");
            settype($new_h, "integer");

            $file = $obr;
            $pripona = $this->SuffixPicture($typ);
            $action = "resize";
          }
        break;
      }

      $cil = "{$indexout}/{$jmeno}.{$pripona}"; //nazev pro upload
      $retnazev = "{$jmeno}.{$pripona}";  //nazev pro vystup

      //provedeni samotneho uploadu
      switch ($action)
      {
        case "upload":
          //uploaduje cisty obrazek
          if (move_uploaded_file($file, $cil))
          {
            $result["own"] = $retnazev;
          }
        break;

        case "resize":
          //zmensovani podle typu obrazku a zmensi
          switch ($typ)
          {
            case "image/jpeg":
              ini_set("memory_limit", "100M");  //rezervuje vic mega
              $img_old = imagecreatefromjpeg($file);
              //vytvoreni noveho platna
              $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
              //zaruceni transparentnosti
              $color = imagecolorallocatealpha($img_new, 0, 0, 0, 127);
              imagefill($img_new, 0, 0, $color);
              imagesavealpha($img_new, true);
              imagealphablending($img_new, true);
              //zmenseni a vlozeni obrazku
              imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
              imagejpeg($img_new, $cil, 100);
              imagedestroy($img_new);

              $result["mini"] = $retnazev;
            break;

            case "image/png":
              ini_set("memory_limit", "100M");  //rezervuje vic mega
              $img_old = imagecreatefrompng($file);
              //vytvoreni noveho platna
              $img_new = imagecreatetruecolor($new_w, $new_h);  //mini
              //zaruceni transparentnosti
              $color = imagecolorallocatealpha($img_new, 0, 0, 0, 127);
              imagefill($img_new, 0, 0, $color);
              imagesavealpha($img_new, true);
              imagealphablending($img_new, true);
              //zmenseni a vlozeni obrazku
              imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
              imagepng($img_new, $cil, 9);
              imagedestroy($img_new);

              $result["mini"] = $retnazev;
            break;

            default:
              $result = NULL;
            break;
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Rozliseni typu koncovky
 *
 * @param typ vstupni typ podle mime
 * @return vrati koncovku
 */
  private function SuffixPicture($typ)
  {
    $result = "";
    switch ($typ)
    {
      case "image/jpeg":
        $result = "jpg";
      break;

      case "image/png":
        $result = "png";
      break;
    }

    return $result;
  }

/**
 *
 * Generovani css spritu
 *
 * @param obr1 cesta obrazku 1
 * @param obr2 cesta obrazku 2
 * @param smer smer generovani top/left
 * @param padding pdingy obrazku zadane jako pole array(T, R, B, L)
 * @param barva rgb barva zadana jako pole array(R, G, B), kdyz nezada bude transparentni
 * @return nazev vygenerovaneho 3 platna, bere se podle prvniho obrazku
 */
  public function ControlCssSprit($obr1, $obr2, $smer = "left", $padding = array(0, 0, 0, 0), $barva = NULL)
  {
    $result = "";
    //pokud oba obrazky existuji
    if (file_exists($obr1) &&
        file_exists($obr2))
    {
      $a = getimagesize($obr1);
      $w = $a[0]; //nactene velikosti z obrazku
      $h = $a[1];
      $b = getimagesize($obr2);

      $cil = $obr1; //cil ulozi jako obrazek 1

      //pokud jsou typy obou obrazku stejne
      if ($a["mime"] == $b["mime"])
      {
        //nacitani paddingu TOP RIGHT BOTTOM LEFT
        $p_top = $padding[0];
        $p_right = $padding[1];
        $p_bottom = $padding[2];
        $p_left = $padding[3];
        //redeklarace typu pro jistotu
        settype($p_top, "integer");
        settype($p_right, "integer");
        settype($p_bottom, "integer");
        settype($p_left, "integer");

        ini_set("memory_limit", "100M");  //rezervuje vic mega
        //rozdeleni podle typu, nacitani obrazku
        switch ($a["mime"])
        {
          case "image/jpeg":
            //nacteni zdrojovych obrazku do img streamu
            $img1 = imagecreatefromjpeg($obr1);
            $img2 = imagecreatefromjpeg($obr2);
          break;

          case "image/png":
            //nacteni zdrojovych obrazku do img streamu
            $img1 = imagecreatefrompng($obr1);
            $img2 = imagecreatefrompng($obr2);
          break;
        }
        //rozdeleni podle smeru a vypocet rozmeru 3 platna
        switch ($smer)
        {
          default:
          case "left":
            //vypocet velikosti 3 platna
            $new_w = ($w * 2) + ($p_left * 2) + ($p_right * 2);
            $new_h = $h + $p_top + $p_bottom;
            //vypocet pozice druheho obrazku
            $pos_x = ($p_left * 2) + $w + $p_right;
            $pos_y = $p_top;
          break;

          case "top":
            //vypocet velikosti 3 platna
            $new_w = $w + $p_left + $p_right;
            $new_h = ($h * 2) + ($p_top * 2) + ($p_bottom * 2);
            //vypocet pozice druheho obrazku
            $pos_x = $p_left;
            $pos_y = ($p_top * 2) + $h + $p_bottom;
          break;
        }
        //vytvoreni platna
        $img = imagecreatetruecolor($new_w, $new_h);  //platno pro 3 obrazek
        //detekce barvy pozadi
        if (!is_null($barva))
        { //redeklarace typu pro jistotu
          settype($barva[0], "integer");
          settype($barva[1], "integer");
          settype($barva[2], "integer");
          //nastaveni dane barvy pozadi
          $color = imagecolorallocate($img, $barva[0], $barva[1], $barva[2]);
          imagefilledrectangle($img, 0, 0, $new_w - 1, $new_h - 1, $color);
        }
          else
        { //nastaveni transpatentnosti
          $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
          imagealphablending($img, true);
          imagesavealpha($img, true);
          imagefill($img, 0, 0, $color);
        }
        //nakopirovani 1 obrazku do platna
        imagecopy($img, $img1, $p_left, $p_top, 0, 0, $w, $h);
        //nakopirovani 2 obrazku do platna
        imagecopy($img, $img2, $pos_x, $pos_y, 0, 0, $w, $h);
        //rozdeleni podle typu, ulozeni posledniho platna
        switch ($a["mime"])
        {
          case "image/jpeg":
            //ulozeni do obrazku
            imagejpeg($img, $cil, 100);  //bez komprese
            imagedestroy($img);
          break;

          case "image/png":
            //ulozeni do obrazku
            imagepng($img, $cil, 9);  //bez komprese
            imagedestroy($img);
          break;
        }
        //vraceni nazvu
        $result = $cil;
      }
    }

    return $result;
  }

/**
 *
 * Ovladani synchronizace souboru s databazi
 *
 * nastaveni:
 * array("cela cesta" => pole_souboru_na_porovnani,
 *       "dalsi cesta" => klidne_i_stejny_pole)
 *
 * @param nastaveni konfiguracni pole
 * @return pocet rozdilnych souboru
 */
  public function ControlSynchronize($nastaveni)
  {
    $result = 0;
    $block = array("php", "css", "sqlite2", "mysqli");  //blokovane pripony
    //rozdeleni jednotlivych nastaveni
    foreach ($nastaveni as $cesta => $pole)
    {
      //vstupni pole musi byt pole a musi byt nezprazdne
      if (!Empty($pole) && is_array($pole))
      {
        $soubory = $this->VypisSouboru($cesta); //nacteni souboru podle cesty
        //musi existovat i nejake soubory ve slozce
        if (is_array($soubory))
        { //kdyz jsou obe promenne pole dela rozdil
          $diff = array_diff($soubory, $pole);  //rozdil poli
          $result += count($diff);  //secteni poctu pole
          //projiti pole souboru na smazani
          foreach ($diff as $soubor)
          { //rozdeleni podle tecky a kontroluje pripony
            $a = explode(".", $soubor); //parsnuti pripony
            //pokud neni v poli pripona a cesta je soubor tak smaze soubor
            if (!in_array($a[count($a) - 1], $block) &&
                is_file("{$cesta}/{$soubor}"))
            { //a pak maze prebytecne soubory
              @unlink("{$cesta}/{$soubor}");
            }
          }
        }
      }
    }

    return $result;
  }

/**
 *
 * Eqivalentni tvar klice
 *
 * pole, pole=1 (pro id 1, vybere toto jako eqivalent)
 * pokus, pokus=adr (pro hodnotu adr zezme tu s =)
 *
 * @param unikatni pole unikatnich hodnot
 * @param klic nacitany defaultni tvar
 * @param index hodnota ktera se vklada za "="
 * @return vyhledana ekvivalentni hodnota z unikatnich
 */
  public function EqTv($unikatni, $klic, $index)
  {
    $result = $klic;  //nastaveni defaultniho klice
    //settype($index, "integer");
    //vyhledani v poli klicu kde je '=', vysledne pole pak prochazi
    $hledani = preg_grep("/[=]/", array_keys($unikatni));
    foreach ($hledani as $hodnota)
    { //rozdeleni podle = na detekci klice a sablony
      $roz = explode("=", $hodnota);
      //settype($roz[1], "integer");  //predefinace na integer

      if ($roz[0] == $klic &&
          $roz[1] == $index)
      { //pokud najde klic pro danou sablonu pouzije ho
        $result = $hodnota;
        break;
      }
    }

    return $unikatni[$result];
  }

/**
 *
 * Interpretace datumu a jeho funkci podle zadanych parametru
 *
 * @param datum vstupni datum v klasickem formatu, 1.1.1970
 * @param format textovy format podle php standardu, viz funkce date
 * @param dny dny v tydnu oddelene carkou
 * @param mesice mesice v roce oddelene carkou
 * @param tvar predloha pro spravne zobrazeni vysledneho tvaru
 * @return vysledny tvar datum dle predlohy
 */
  public function InterpretDate($datum, $format, $dny, $mesice, $tvar)
  {
    $idat = strtotime($datum);  //nacteni ciselne podoby data
    $datum = date($format, $idat);
    $dny = explode(",", $dny);  //parsnuti podle ,
    $mesice = explode(",", $mesice);
    $den = $dny[date("N", $idat) - 1];
    $mesic = $mesice[date("n", $idat) - 1];
    //self:: interpretuje svou tridu tzn tady: DynamicLiteCentral::Svatek
    $svatek = $this->Svatek($datum);  //svatky si prevadeji datum sami

    $result = str_replace(array("@datum@", "@den@", "@mesic@", "@svatek@"),
                          array($datum, $den, $mesic, $svatek),
                          $tvar);

    return $result;
  }

/**
 *
 * Interpretace casu
 *
 * @param cas vstupni datum v klasickem tvaru, 1.1.1970
 * @param format textovy format podle php standardu, viz funkce date
 * @return vysledny tvar casu
 */
  public function InterpretTime($cas, $format)
  {
    $result = date($format, strtotime($cas));

    return $result;
  }

/**
 *
 * Vypisuje dle zadaneho data svatek
 *
 * @param datum vstupni datum pro zjisteni svatku
 * @return svatek daneho dne
 */
  public function Svatek($datum)
  {
                    //leden
    $svatek = array(array("Nový rok", "Karina", "Radmila", "Diana", "Dalimil",
                          "Tři králové", "Vilma", "Čestmír", "Vladan", "Břetislav",
                          "Bohdana", "Pravoslav", "Edita", "Radovan", "Alice",
                          "Ctirad", "Drahoslav", "Vladislav", "Doubravka", "Ilona",
                          "Běla", "Slavomír", "Zdeněk", "Milena", "Miloš", "Zora",
                          "Ingrid", "Otýlie", "Zdislava", "Robin", "Marika"),
                    //unor
                    array("Hynek", "Nela/Hromnice", "Blažej", "Jarmila", "Dobromila",
                          "Vanda", "Veronika", "Milada", "Apolena", "Mojmír",
                          "Božena", "Slavěna", "Věnceslav", "Valentýn", "Jiřina",
                          "Ljuba", "Miloslava", "Gizela", "Patrik", "Oldřich",
                          "Lenka", "Petr", "Svatopluk", "Matěj", "Liliana",
                          "Dorota", "Alexandr", "Lumír", "Horymír"),
                    //brezen
                    array("Bedřich", "Anežka", "Kamil", "Stela", "Kazimír",
                          "Miroslav", "Tomáš", "Gabriela", "Františka", "Viktorie",
                          "Anděla", "Řehoř", "Růžena", "Rút/Matylda", "Ida",
                          "Elena/Herbert", "Vlastimil", "Eduard", "Josef", "Světlana",
                          "Radek", "Leona", "Ivona", "Gabriel", "Marián",
                          "Emanuel", "Dita", "Soňa", "Taťána", "Arnošt",
                          "Kvido"),
                    //duben
                    array("Hugo", "Erika", "Richard", "Ivana", "Miroslava",
                          "Vendula", "Heřman/Hermína", "Ema", "Dušan", "Darja",
                          "Izabela", "Julius", "Aleš", "Vincenc", "Anastázie",
                          "Irena", "Rudolf", "Valérie", "Rostislav", "Marcela",
                          "Alexandra", "Evženie", "Vojtěch", "Jiří", "Marek",
                          "Oto", "Jaroslav", "Vlastislav", "Robert", "Blahoslav"),
                    //kveten
                    array("Svátek práce", "Zikmund", "Alexej", "Květoslav", "Klaudie, Květnové povstání českého lidu",
                          "Radoslav", "Stanisla", "Den osvobození od fašismu", "Ctibor", "Blažena",
                          "Svatava", "Pankrác", "Servác", "Bonifác", "Žofie",
                          "Přemysl", "Aneta", "Nataša", "Ivo", "Zbyšek",
                          "Monika", "Emil", "Vladimír", "Jana", "Viola",
                          "Filip", "Valdemar", "Vilém", "Maxmilián", "Ferdinand",
                          "Kamila"),
                    //cerven
                    array("Laura", "Jarmil", "Tamara", "Dalibor", "Dobroslav",
                          "Norbert", "Iveta/Slavoj", "Medard", "Stanislav", "Gita",
                          "Bruno", "Antonie", "Antonín", "Roland", "Vít",
                          "Zbyněk", "Adolf", "Milan", "Leoš", "Květa",
                          "Alois", "Pavla", "Zdeňka", "Jan", "Ivan",
                          "Adriana", "Ladislav", "Lubomír", "Petr a Pavel", "Šárka"),
                    //cervenec
                    array("Jaroslava", "Patricie", "Radomír", "Prokop", "Den slovanských věrozvěstů Cyrila a Metoděje",
                          "Upálení mistra Jana Husa", "Bohuslava", "Nora", "Drahoslava", "Libuše/Amálie",
                          "Olga", "Bořek", "Markéta", "Karolína", "Jindřich",
                          "Luboš", "Martina", "Drahomíra", "Čeněk", "Ilja",
                          "Vítězslav", "Magdeléna", "Libor", "Kristýna", "Jakub",
                          "Anna", "Věroslav", "Viktor", "Marta", "Bořivoj",
                          "Ignác"),
                    //srpen
                    array("Oskar", "Gustav", "Miluše", "Dominik", "Kristián",
                          "Oldřiška", "Lada", "Soběslav", "Roman", "Vavřinec",
                          "Zuzana", "Klára", "Alena", "Alan", "Hana",
                          "Jáchym", "Petra", "Helena", "Ludvík", "Bernard",
                          "Johana", "Bohuslav", "Sandra", "Bartoloměj", "Radim",
                          "Luděk", "Otakar", "Augustýn", "Evelína", "Vladěna",
                          "Pavlína"),
                    //zari
                    array("Linda/Samuel", "Adéla", "Bronislav", "Jindřiška", "Boris",
                          "Boleslav", "Regína", "Mariana", "Daniela", "Irma",
                          "Denisa", "Marie", "Lubor", "Radka", "Jolana",
                          "Ludmila", "Naděžda", "Kryštof", "Zita", "Oleg",
                          "Matouš", "Darina", "Berta", "Jaromír", "Zlata",
                          "Andrea", "Jonáš", "Václav, Den české státnosti", "Michal", "Jeroným"),
                    //rijen
                    array("Igor", "Olívie", "Bohumil", "František", "Eliška",
                          "Hanuš", "Justýna", "Věra", "Štefan/Sára", "Marina",
                          "Andrej", "Marcel", "Renáta", "Agáta", "Tereza",
                          "Havel", "Hedvika", "Lukáš", "Michaela", "Vendelín",
                          "Brigita", "Sabina", "Teodor", "Nina", "Beáta",
                          "Erik", "Šarlota/Zoe", "Den vzniku samostatného československého státu", "Silvie", "Tadeáš",
                          "Štěpánka"),
                    //listopad
                    array("Felix", "Památka zesnulých", "Hubert", "Karel", "Miriam",
                          "Liběna", "Saskie", "Bohumír", "Bohdan", "Evžen",
                          "Martin", "Benedikt", "Tibor", "Sáva", "Leopold",
                          "Otmar", "Mahulena, Den boje studentů za svobodu a demokracii", "Romana", "Alžběta", "Nikola",
                          "Albert", "Cecílie", "Klement", "Emílie", "Kateřina",
                          "Artur", "Xenie", "René", "Zina", "Ondřej"),
                    //prosinec
                    array("Iva", "Blanka", "Svatoslav", "Barbora", "Jitka",
                          "Mikuláš", "Ambrož/Benjamín", "Květoslava", "Vratislav", "Julie",
                          "Dana", "Simona", "Lucie", "Lýdie", "Radana",
                          "Albína", "Daniel", "Miloslav", "Ester", "Dagmar",
                          "Natálie", "Šimon", "Vlasta", "Adam a Eva, Štědrý den", "Boží hod vánoční - svátek vánoční",
                          "Štěpán - svátek vánoční", "Žaneta", "Bohumila", "Judita", "David",
                          "Silvestr - Nový rok"));

    $datum = strtotime($datum);
    $result = $svatek[date("n", $datum) - 1][date("j", $datum) - 1];

    return $result;
  }

/**
 *
 * Prepis textu dle povolenych znaku
 *
 * @param text vstupni text
 * @param pattern regularni vyraz na povolene znaky
 * @return preskladany text
 */
  public function PrepisTextu($text, $pattern = "/[a-zA-Z0-9_\-\.\(\)]{1}/")
  {
    $result = "";
    if (!Empty($text))
    {
      $prepis = array("á" => "a", "Á" => "A",
                      "ä" => "a", "Ä" => "A",
                      "ǎ" => "a", "Ǎ" => "A",
                      "ć" => "c", "Ć" => "C",
                      "č" => "c", "Č" => "C",
                      "ď" => "d", "Ď" => "D",
                      "é" => "e", "É" => "E",
                      "ě" => "e", "Ě" => "E",
                      "ë" => "e", "Ë" => "E",
                      "í" => "i", "Í" => "I",
                      "ǐ" => "i", "Ǐ" => "I",
                      "ï" => "i", "Ï" => "I",
                      "ĺ" => "l", "Ĺ" => "L",
                      "ľ" => "l", "Ľ" => "L",
                      "ň" => "n", "Ň" => "N",
                      "ń" => "n", "Ń" => "N",
                      "ó" => "o", "Ó" => "O",
                      "ǒ" => "o", "Ǒ" => "O",
                      "ö" => "o", "Ö" => "O",
                      "ŕ" => "r", "Ŕ" => "R",
                      "ř" => "r", "Ř" => "R",
                      "ś" => "s", "Ś" => "S",
                      "š" => "s", "Š" => "S",
                      "ť" => "t", "Ť" => "T",
                      "ẗ" => "t",
                      "ů" => "u", "Ů" => "U",
                      "ú" => "u", "Ú" => "U",
                      "ǔ" => "u", "Ǔ" => "U",
                      "ü" => "u", "Ü" => "U",
                      "ý" => "y", "Ý" => "Y",
                      "ÿ" => "y", "Ÿ" => "Y",
                      "ž" => "z", "Ž" => "Z",
                      "ź" => "z", "Ź" => "Z",);

      $search = array_keys($prepis);
      $replace = array_values($prepis);
      $text = str_replace($search, $replace, $text);

      $row = array();
      $rozdel = str_split($text);
      foreach ($rozdel as $pismeno)
      {
        if (preg_match($pattern, $pismeno))
        {
          $row[] = $pismeno;
        }
      }

      $result = implode("", $row);
    }

    return $result;
  }

/**
 *
 * Prepis textu podle rewrite standardu by GFdesign.cz
 *
 * @param text vstupni text
 * @param out vystupni nastaveni >> "up" (upper), "low" (lower), NULL (zanecha velikost)
 * @return prepsavy text posle prepisovaciho pole
 */
  public function RewritePrepis($text, $out = NULL)
  {
    $prepis = array("á" => "a", "Á" => "A",
                    "ä" => "a", "Ä" => "A",
                    "ǎ" => "a", "Ǎ" => "A",
                    "ć" => "c", "Ć" => "C",
                    "č" => "c", "Č" => "C",
                    "ď" => "d", "Ď" => "D",
                    "é" => "e", "É" => "E",
                    "ě" => "e", "Ě" => "E",
                    "ë" => "e", "Ë" => "E",
                    "í" => "i", "Í" => "I",
                    "ǐ" => "i", "Ǐ" => "I",
                    "ï" => "i", "Ï" => "I",
                    "ĺ" => "l", "Ĺ" => "L",
                    "ľ" => "l", "Ľ" => "L",
                    "ň" => "n", "Ň" => "N",
                    "ń" => "n", "Ń" => "N",
                    "ó" => "o", "Ó" => "O",
                    "ǒ" => "o", "Ǒ" => "O",
                    "ö" => "o", "Ö" => "O",
                    "ŕ" => "r", "Ŕ" => "R",
                    "ř" => "r", "Ř" => "R",
                    "ś" => "s", "Ś" => "S",
                    "š" => "s", "Š" => "S",
                    "ť" => "t", "Ť" => "T",
                    "ẗ" => "t",
                    "ů" => "u", "Ů" => "U",
                    "ú" => "u", "Ú" => "U",
                    "ǔ" => "u", "Ǔ" => "U",
                    "ü" => "u", "Ü" => "U",
                    "ý" => "y", "Ý" => "Y",
                    "ÿ" => "y", "Ÿ" => "Y",
                    "ž" => "z", "Ž" => "Z",
                    "ź" => "z", "Ź" => "Z",
                    " " => "-", "	" => "-",
                    "." => "-",
                    "(" => "-", ")" => "-",
                    "[" => "-", "]" => "-",
                    "{" => "-", "}" => "-",
                    "ˇ" => "-", "´" => "-",
                    "+" => "-",
                    //"-" => "_",
                    "*" => "-",
                    "/" => "-",  // /
                    "=" => "-",
                    ";" => "-",
                    ":" => "-",
                    "," => "-",
                    "'" => "-",
                    "\'" => "-",
                    "?" => "-",
                    "<" => "-", ">" => "-",
                    "\\" => "-",  // \
                    "|" => "-",
                    "!" => "-",
                    "@" => "-",
                    "%" => "-",
                    //"\"" => "-",
                    //"&quot;" => "-",
                    "&" => "-",
                    "-quot-" => "-",
                    "§" => "-",
                    "#" => "-",
                    "$" => "-",
                    "˚" => "-", "°" => "-",
                    "`" => "-",
                    "~" => "-",
                    "^" => "-",
                    "€" => "-",
                    "¶" => "-",
                    "¨" => "-",
                    "ŧ" => "-", "Ŧ" => "-",
                    "¯" => "-",
                    "–" => "-",
                    "←" => "-", "→" => "-", "↓" => "-",
                    "ø" => "-",
                    "þ" => "-",
                    "Đ" => "-",
                    "đ" => "-",
                    "ł" => "-",
                    "Ł" => "-",
                    );

    $search = array_keys($prepis);
    $replace = array_values($prepis);
    $result = str_replace($search, $replace, $text);

    switch ($out)
    {
      case "up":
        $result = mb_strtoupper($result, "UTF-8");
      break;

      case "low":
        $result = mb_strtolower($result, "UTF-8");
      break;
    }

    return $result;
  }

/**
 *
 * Vytvari mezery v cisle, po tisicech
 *
 * @param cislo vstupni cislo
 * @param desetinne odelovac desetinne carky
 * @param mezera znak mezery mezi tisicama
 * @return cislo s mezerama
 */
  public function MezeraCisla($cislo, $desetinna = ".", $mezera = " ")
  {
    $result = number_format($cislo, 0, $desetinna, $mezera);

    return $result;
  }

/**
 *
 * Prevadi hex reprezentaci (s #) barev na dec reprezentaci
 *
 * @param hex hex barva, s delkou 3 nebo 6
 * @return pole v dec podobe
 */
  public function PrevodNaRGB($hex)
  {
    $result = "";
    $hex = array_slice(str_split($hex), 1); //orezani #
    if (count($hex) == 3)
    { //vypocet 3 znakeho cisla na 6 znake a prevede na dec
      foreach ($hex as $kod)
      {
        $result[] = hexdec("{$kod}{$kod}");
      }
    }
      else
    if (count($hex) == 6)
    { //slouceni po dvojcich a prevedeni cisla na dec
      foreach (array_chunk($hex, 2) as $kod)
      {
        $result[] = hexdec(implode("", $kod));
      }
    }
      else
    {
      $result = NULL;
    }

    return $result;
  }

/**
 *
 * Vygeneruje nahodnou rgb barvu (s #) v 3 nebo 6 mistnem tvaru zobrazeni
 *
 * @param min minimalni barva v 3 a nebo 6 tvaru
 * @param max maximalni barva v 3 a nebo 6 tvaru
 * @return nahodna barva v zadanem limitu
 */
  public function NahodnaRGBBarva($min, $max)
  {
    $result = "";
    $min = array_slice(str_split($min), 1); //orezani #
    $max = array_slice(str_split($max), 1); //orezani #
    if (count($min) == count($max))
    {
      if (count($min) == 3)
      {
        $result[] = "#";  //vlozeni #
        foreach ($min as $index => $kod)
        { //prevedeni na dec, vypocet rand, prevedeni na hex
          $result[] = dechex(rand(hexdec("{$kod}{$kod}"), hexdec("{$max[$index]}{$max[$index]}")));
        } //slouceni dvojic
        $result = implode("", $result);
      }
        else
      if (count($min) == 6)
      {
        $min = array_chunk($min, 2);
        $max = array_chunk($max, 2);
        $result[] = "#";  //vlozeni #
        foreach ($min as $index => $kod)
        {
          $result[] = dechex(rand(hexdec(implode("", $kod)), hexdec(implode("", $max[$index]))));
        }
        $result = implode("", $result);
      }
        else
      {
        $result = NULL;
      }
    }

    return $result;
  }

/**
 *
 * Rekurzivni klesani dolu po submenu
 *
 * @param id vstupni identifikator
 * @param tabulka tabulka zdrojovych dat
 * @param poccall pocitadlo volani, pri 0 vynuluje promennou
 * @return pole od 0.zan po zadane id vcetne
 */
  public function RekurzivniKlesani($id, $tabulka = "menu", $poccall = 0)
  {
    static $result;
    //pri prvnim volani vynulovani promenne
    if ($poccall == 0)
    {
      $result = array();
    }
    //natypovani id
    settype($id, "integer");
    $result[] = $id;
    //id je pocatesni id klesani, pak klesa po submenu
    $submenu = explode("-", $this->VypisHodnotu("submenu", $tabulka, $id));
    if (!Empty($submenu[0]))
    {
      foreach ($submenu as $subid)
      {
        $this->RekurzivniKlesani($subid, $tabulka, ++$poccall);
      }
    }


    return $result;
  }

/**
 *
 * Rekurzivni stoupani nahoru ke korenu
 *
 * @param id vstupni identifikator
 * @param tabulka tabulka zdrojovych dat
 * @param poccall pocitadlo volani, pri 0 vynuluje promennou
 * @return pole od id do 0.zan vcetne
 */
  public function RekurzivniStoupani($id, $tabulka = "menu", $poccall = 0)
  {
    static $result;
    //pri prvnim volani vynulovani promenne
    if ($poccall == 0)
    {
      $result = array();
    }
    //natypovani id
    settype($id, "integer");
    $koren = $this->VypisHodnotu("koren", $tabulka, $id); //nacteni cisla korenu
    $zanoreni = $this->VypisHodnotu("zanoreni", $tabulka, $id);  //nacteni cisla zanoreni jako indexu
    //id nesmi byt 0 a zanoreni musi byt cislo
    if (!Empty($id) &&
        is_numeric($zanoreni))
    {
      $result[$zanoreni] = $id;
    }

    //rekurzivne se vola dokud nedojde na nulu
    if ($zanoreni > 0)
    {
      $this->RekurzivniStoupani($koren, $tabulka, ++$poccall);
    }
      else
    {
      //pri zanoreni 0 seradi multi-pole podle klicu
      if (is_array($result))
      {
        ksort($result);
      }
    }

    return $result;
  }

/**
 *
 * Admin logovani uzivatelskych zasahu
 *
 * @param hodnota olozena hodnota a nebo pole hodnot
 * @param misto pel umisteni logovani, radek/metoda
 * @param idmodul id modulu
 * @param co volany blok funkce v adminu
 */
  public function AdminAddActionLog($hodnota, $misto, $idmodul = NULL, $co = NULL)
  {
    //pokud je v adminu a je prihlaseny uzivatel, tak loguje akce
    if ($this->var->useradmin_id > 0 &&
        !$this->var->admin_mod)
    {
      $logdir = $this->FileVynorovani($this->diractlog);  //najde slozku logovani
      $dnes = date("Y-m-d");  //dnesni datum
      //nadefinovani pripojeni
      $pole = array("uloziste" => "sqlite",
                    "class" => "Pocitadlo",
                    "include" => "pocitadlo.php",
                    "databaze" => "{$logdir}/.alog{$dnes}.sqlite2");
      //pokud existuje slozka, jinak se musi regenerovat js
      if (file_exists($logdir))
      {
        $this->dbpredpona = $this->NastavKomunikaci($this->var, $pole, NULL, "act");
        if (!$this->PripojeniDatabaze($error))
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
//dodelat!!! nejak to prca!!!
//var_dump($this->ZjistiConnection(true));
        //instalace databaze
        $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}actlog (
                                    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    user INTEGER UNSIGNED,
                                    idmodul VARCHAR(300),
                                    co VARCHAR(300),
                                    hodnota VARCHAR(300),
                                    radek INTEGER UNSIGNED,
                                    metoda VARCHAR(300),
                                    agent VARCHAR(300),
                                    ip VARCHAR(50),
                                    datum DATETIME);
                                  ", $null, true);

        //nacitani umisteni
        $idmodul = (isset($idmodul) ? $idmodul : $this->NotEmpty("get", $this->var->get_idmodul));
        $co = $this->NotEmpty("get", "co");
        //pracovani hodnoty
        $hodn = $this->ZkraceniTextu((is_array($hodnota) ? implode($this->permexplode, $hodnota) : $hodnota), 297);
        //pridani zaznamu akce
        $this->ControlForm(array("user" => array("self", "integer", $this->var->useradmin_id),
                                  "idmodul" => array("self", "string", $idmodul),
                                  "co" => array("self", "string", $co),
                                  "hodnota" => array("self", "string", $hodn),
                                  "radek" => array("self", "integer", $misto[0]),
                                  "metoda" => array("self", "string", $misto[1]),
                                  "agent" => array("self", "string", $_SERVER["HTTP_USER_AGENT"]),
                                  "ip" => array("self", "string", $_SERVER["REMOTE_ADDR"]),
                                  "datum" => array("self", "date", $_SERVER["REQUEST_TIME"])),
                            (true), array("insert", "actlog", NULL));

        $this->dbpredpona = $this->NavratPripojeni(); //navrat id pro samotnou funkci i s predponou
      }
    }
  }

/**
 *
 * Prevede rimske na arabske cislo
 *
 * @param slovo vstupni rimske cislo
 * @return arabske cislo
 */
  public function RimskeArabske($slovo)
  {
    $pole = array("I" => 1,
                  "V" => 5,
                  "X" => 10,
                  "L" => 50,
                  "C" => 100,
                  "D" => 500,
                  "M" => 1000);

    $rozdel = str_split($slovo);  //rozdeleni rimskeho slova na pismena
    $result = 0;
    foreach ($rozdel as $index => $pismeno)
    { //kdyz je dalsi pismeno hodnotove vetsi tak scita
      if ($pole[$pismeno] < $pole[$rozdel[$index + 1]])
      {
        $result += $pole[$pismeno];  //scitani hodnoty
      }
        else
      {
        $result -= $pole[$pismeno];  //odcitani hodnoty
      }
    }

    return abs($result);
  }

/**
 *
 * Prevede arabske na rimske cislo
 *
 * @param cislo vstupni arabske cislo
 * @return rimske cislo
 */
  public function ArabskeRimske($cislo, $classic = true)
  {
    $pole = array("IIII", "V", "XXXX", "L", "CCCC", "D", "MMMM");
    $result = "";
    foreach ($pole as $blok)
    {
      $lenblok = strlen($blok) + 1;
      $modulo = $cislo % $lenblok;
      $result = substr($blok, 0, $modulo).$result;
      $cislo = ($cislo - $modulo) / $lenblok;
    }

    //optimalizace na klasicky tvar
    if ($classic)
    {
      $prep = array("/DCCCC/" => "CM",
                    "/CCCC/" => "CD",
                    "/LXXXX/" => "XC",
                    "/XXXX/" => "XL",
                    "/VIIII/" => "IX",
                    "/IIII/" => "IV");

      $result = preg_replace(array_keys($prep), array_values($prep), $result);
    }

    return $result;
  }

/**
 *
 * Startuje a nuluje session
 *
 */
  public function StartSession() //aktvuje session promenne
  {
    if (!isset($_SESSION))
    {
      session_start();  //nastartovani session
      //$_SESSION = ""; //nesmi se vyprazdnovat! uz kvuli captcha kodum!
    }
  }

/**
 *
 * Vrati session id prohlizece
 *
 * pouziti:
 * $id = $this->var->main[0]->NactiFunkci("Funkce", "GetSessionId");
 *
 * @return session id
 */
  public function GetSessionId()
  {
    $result = session_id();
    if (Empty($result))
    { //pokud je prazdne nastartuje se
      $this->StartSession();
      $result = session_id();
    }

    return $result;
  }

/**
 *
 * Nastavi id uzivatele
 *
 * @param user id uzivatele
 */
  public function SetSessionUser($id, $user, $pass)
  {
    $cesta = "{$this->dirsession}/.slog{$this->GetSessionId()}";
    if (!file_exists($cesta) &&
        $u = @fopen($cesta, "w"))
    {
      fwrite($u, $this->ZakodujText(implode("|-u-|", array($id, $user, $pass))));
      fclose($u);
    }
  }

/**
 *
 * Vrati id prihlaseneho uzivatele
 *
 * @return id uzivatele
 */
  public function GetSessionUser($userid = false)
  {
    $result = false;
    //musi se vynorovat ze slozek
    $cesta = $this->FileVynorovani("{$this->dirsession}/.slog{$this->GetSessionId()}");
    if (file_exists($cesta) &&
        $u = @fopen($cesta, "r"))
    {
      $result = explode("|-u-|", $this->DekodujText(fread($u, filesize($cesta))));
      fclose($u);
      if (is_array($result))
      {
        $result = ($userid ? $result[0] : array($result[1], $result[2]));
      }
    }

    return $result;
  }

/**
 *
 * Regeneruje session id
 *
 */
  public function RegenerateSession()
  {
    session_regenerate_id(true);  //regenerovani id
  }

/**
 *
 * Smaze file session user
 *
 */
  public function DelSessionUser()
  {
    $cesta = "{$this->dirsession}/.slog{$this->GetSessionId()}";
    @unlink($cesta);
  }

/**
 *
 * Overeni pristupu do administrace
 *
 * @param login login admina
 * @param heslo heslo admina
 * @param kodovat zapnuto/vypnuto - implcitni kodovani
 * @return povoleno/zamitnuto - true/false
 */
  public function Autorizace($login, $heslo, $kodovat = true)
  {
    $result = false;
    $log = ($kodovat ? md5(md5($login)) : $login);  //prepis loginu
    $hes = ($kodovat ? md5(md5($heslo)) : $heslo);
    $result = (!Empty($this->var->adminpristup[$log][0]) &&
              $this->var->adminpristup[$log][0] === $hes);
    if ($result)
    {
      $this->var->adminuser["name"] = base64_decode($this->var->adminpristup[$log][1]);
      $this->SetSessionUser(-1, $log, $hes);
      $this->var->admin_mod = true;
    }
      else
    {
      $result = false;
      $this->var->admin_mod  = false;
    }

    $result = $this->AutorizaceOtherUser($login, $heslo, $kodovat, $result);

    return $result;
  }

/**
 *
 * Overeni pristupu do administrace ostatnim adminum
 *
 * @param login login admina
 * @param heslo heslo admina
 * @param kodovat zapnuto/vypnuto - implcitni kodovani
 * @param prihlaseno pokud je hlavni prihlaseni false tak koukne do DB
 * @return povoleno/zamitnuto - true/false
 */
  public function AutorizaceOtherUser($login, $heslo, $kodovat = true, $prihlaseno)
  {
    if (!$prihlaseno) //kdyz je neprihlasen, jide i do db
    {
      $result = false;
      $log = ($kodovat ? md5(md5($login)) : $login);  //zpracovani udaju
      $hes = ($kodovat ? md5(md5($heslo)) : $heslo);
      if ($data = $this->ControlObjectHodnoty(array("id", "jmeno", "permission", "superadmin"),
                                              array("useradmin", $hes, "aktivni=1 AND loginlog='{$log}' AND heslo=")))
      {
        $this->var->adminuser["name"] = $this->DekodujText($data->jmeno);
        //nastaveni id prihlaseneho uzivatele
        $this->var->useradmin_id = $data->id; //nacitani id uzivatele
        settype($this->var->useradmin_id, "integer");  //redeklarace na integer
        //nastaveni session logu
        $this->SetSessionUser($data->id, $log, $hes);
        //nacteni opravneni
        $this->var->useradmin_permission = $data->permission; //nacitani id permission
        settype($this->var->useradmin_permission, "integer");  //redeklarace na integer

        $this->var->admin_mod = false;
        $this->var->admin_permit = explode($this->permexplode, $this->VypisHodnotu("opravneni", "permission", $data->permission, "aktivni=1 AND id="));

        //overovani podle superadmina
        if (!$data->superadmin)
        { //pokud je superadmin na false tak vyhodi eventuelne pristup do permission
          $this->var->admin_permit = array_diff($this->var->admin_permit, array("Funkce|-|funkce_permit|x|"));
        }
        $result = ($data->permission > 0);  //overeni opravneni
      }
        else
      {
        if (!Empty($error))
        {
          $this->ErrorMsg($error, array(__LINE__, __METHOD__));
        }
          else
        {
          $result = false;  //neakceptovan
        }
      }
    }
      else
    {
      $result = $prihlaseno;
    }

    return $result;
  }

/**
 *
 * Centralni hlasky adminu
 *
 * @param typ typ hlasky: add, copy, edit, del, info, warning
 * @param texty pole textu, kdyz jen text tak jen ten, jinak: array("text", "navic")
 * @param misto umisteni pro warning: array(__LINE__, __METHOD__)
 * @return typova klaska
 */
  public function Hlaska($typ, $texty, $misto = NULL)
  {
    $result = "";
    //lokalni nacitani unikatnich
    $unikatni = $this->NactiObsahSouboru(".unikatni_funkce.php", false);
    $text = (is_array($texty) ? $texty[0] : $texty);
    switch ($typ)
    {
      case "add":
      case "copy":
      case "edit":
      case "del":
        $navic = (is_array($texty) && !is_null($texty[1]) ? $this->NactiUnikatniObsah($unikatni["admin_centralni_hlaska_navic"], $texty[1]) : "");
        $result = $this->NactiUnikatniObsah($unikatni["admin_centralni_hlaska_{$typ}"],
                                            $text,
                                            $navic);
      break;

      case "info":
      case "send":  //neco odeslano
        $result = $this->NactiUnikatniObsah($unikatni["admin_centralni_hlaska_{$typ}"],
                                            $text);
      break;

      case "warning":
      case "notexists": //neco neexistuje
      case "clear": //neco se vycisti
        $umisteni = (is_array($misto) && !Empty($misto[0]) && !Empty($misto[1]) ?
                      $this->NactiUnikatniObsah($unikatni["admin_centralni_hlaska_umisteni"],
                                                $misto[0],  //radek
                                                $misto[1]) : "" //metoda
                    );

        $result = $this->NactiUnikatniObsah($unikatni["admin_centralni_hlaska_{$typ}"],
                                            $text,
                                            $umisteni);
      break;
    }

    return $result;
  }

/**
 *
 * Vysloveni spravneho tvaru dne
 *
 * pouziti:
 * $slovoden = $this->var->main[0]->NactiFunkci("Fukce", "VysloveniDne", 4);
 *
 * @param dne cislo dne
 * @return tvar slova dne
 */
  public function VysloveniDne($den)
  {
    $poledny = array("dnů",
                    "den",
                    "dny",
                    "dní");

    switch ($den)
    {
      case 0: //dnu
        $result = $poledny[0];
      break;

      case 1: //den
        $result = $poledny[1];
      break;

      case 2: //dny
      case 3:
      case 4:
        $result = $poledny[2];
      break;

      default:  //dni
        $result = $poledny[3];
      break;
    }

    return $result;
  }

/**
 *
 * Kontroluje zda dana url adresa existuje
 *
 * pouziti: (prilis nefunguje)
 * ($this->var->main[0]->NactiFunkci("Funkce", "ExistenceUrl", "www.neco.cz") ? "existuje" : "neexistuje")
 *
 * @param url www adresa
 * @param omezovat bool na omezovani kontroly jen podle ip, default true, nepovinne
 * @return true/false - existuje / neexistuje
 */
  public function ExistenceUrl($url)
  {
    $result = false;
    if (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok))
    {
      $a = get_headers($url);
      $b = explode(" ", $a[0]); //parsnuti hlavicky
      $result = ($b[1] == 200); //kdyz je 200, je true
    }

    return $result;
  }

/**
 *
 * Osetreni prazdnosti pro promenne typu $_GET, $_POST, $_SERVER a $_SESSION
 *
 * @param metoda typ vstupni metody
 * @param index index zadane metody
 * @param def defaultni hodnota pokud musi byt jina nez ""
 * @return promenna pokud je neprazdna
 */
  public function NotEmpty($metoda, $index, $def = "")
  {
    $result = "";
    //rozdelni dle vstupu
    switch ($metoda)
    {
      case "get":
        $result = (!Empty($_GET[$index]) ? $_GET[$index] : $def);
      break;

      case "post":
        $result = (!Empty($_POST[$index]) ? $_POST[$index] : $def);
      break;

      case "server":
        $result = (!Empty($_SERVER[$index]) ? $_SERVER[$index] : $def);
      break;

      case "session":
        $result = (!Empty($_SESSION[$index]) ? $_SESSION[$index] : $def);
      break;

      default:  //dodelat: z tadyma vyhodit!!!
        $result = (!Empty($metoda[$index]) ? $metoda[$index] : $def);
      break;
    }

    return $result;
  }

/**
 *
 * Osetreni prazdnosti pro klasicka pole
 *
 * @param pole vstupni pole
 * @param klic klic pro pole
 * @param def defaultni hodnota pokud musi byt jina nez ""
 * @return promenna pokud je neprazdna
 */
  public function NotIsset($pole, $klic, $def = "")
  {
    $result = (!Empty($pole[$klic]) ? $pole[$klic] : $def);

    return $result;
  }

/**
 *
 * Funkce se pokusí stáhnout danou url stránku
 *
 * pouziti:
 * $obsahurl = $this->var->main[0]->NactiFunkci("Funkce", "NactiUrl", "www.url.cz");
 *
 * @param url www adresa
 * @param caching konfiguracni pole konfigurace array("cache" => true, "expire" => "-1 day")
 * @return stranka v promenne
 */
  public function NactiUrl($url, $nastaveni = NULL)
  {
    $result = "";
    $cache = (!Empty($nastaveni["cache"]) ? $nastaveni["cache"] : false);
    $expire = (!Empty($nastaveni["expire"]) ? $nastaveni["expire"] : "-1 day");
    //pole chybovych kodu
    $array_errno = array(6 => "Couldn't resolve host. The given remote host was not resolved.",
                         28 => "Operation timeout. The specified time-out period was reached according to the conditions.");
    $knihovna = "curl";
    if (in_array($knihovna, get_loaded_extensions()))  //kontrola jestli je externi modul dostupny
    { //vytvoreni cesty
      $res = "";
      $newurl = $this->PrepisTextu($url, "/[a-zA-Z0-9_\-]{1}/");
      $cesta = "{$this->dircache}/{$this->cacheurl}_{$newurl}";
      if ($cache)
      { //promazavani cahce po zadane dobe, pokud existuje
        if (file_exists($cesta) &&
            filemtime($cesta) <= strtotime($expire))
        { //promazani cache po expiraci data
          @unlink($cesta);
        }
        //pri cache nacita data ze souboru
        $res = $this->ControlConfig(array("result"), true,
                                    array("load|config", $cesta));
      }

      if ($cache ? !$res : true)
      {
        //lepsi zpusob stahovani z webu
        $ch = curl_init($url);  //inicializace
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //skryje navratovy text
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        //pokud je nastavene post nastavi prislusne nastaveni
        if (!Empty($nastaveni["post"]))
        {
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $nastaveni["post"]);
        }

        //curl_setopt_array($ch, $option);  //preneseni konfugurace
        if (!$result = curl_exec($ch)) //nacteni na navrat
        {
          $errno = curl_errno($ch);
          //vyspani chyby na stdout dle cisla chyby
          echo (array_key_exists($errno, $array_errno) ? $array_errno[$errno] : $errno);
        }
        curl_close($ch);  //uzavreni curl

        if ($cache && !Empty($result)) //pokud je cachovani zapnuto && result neco vraci
        {
          //uklada vysledek pokud neexistuje
          $this->ControlConfig(array ("url" => array("self", "string", $url),
                                      "result" => array("self", "string|base64", $result)), true,
                              array("save|config", $cesta));
        }
      }
        else
      { //vraceni nacachovane hodnoty
        $result = htmlspecialchars_decode(html_entity_decode($res->result, NULL, "UTF-8"));
      }
    }

    return $result;
  }

/**
 *
 * Kontrola emailu pres regularni vyraz, i vice, vysledek zimploduje
 *
 * pouziti:
 * $email = $this->var->main[0]->NactiFunkci("Funkce", "KontrolaEmailu", "email@email.cz");
 *
 * @param email text na zkontrolovani
 * @return je-li vyraz v poradku vrati jeho hodnotu
 */
  public function KontrolaEmailu($email)
  {
    $emaily = explode(",", $email);
    $result = "";
    $konec = false;
    $email = "";
    $c_emaily = count($emaily);
    for ($i = 0; $i < $c_emaily; $i++)
    { //text azAZ09_.-@azAZ09.-.azAZ{2-4} znaky
      $regular = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
      preg_match($regular, trim($emaily[$i]), $ret);

      if (!Empty($ret[0]))  //pokud je neprazdny, nechybny
      {
        $email[] = $ret[0];
      }
        else
      {
        $konec = true;
      }
    }

    $result = (!$konec ? implode(", ", $email) : "");

    return $result;
  }

/**
 *
 * Tiskne za debug modu vsechny chyby
 *
 */
  public function LastError($class = "")
  {
    $debug = (!Empty($_GET["debug"]) ? $_GET["debug"] : "");
    switch ($debug)
    {
      case "lasterror": //debug vypis chyb
        $err = error_get_last();
        $typ = array (1 => "E_ERROR",
                      2 => "E_WARNING",
                      4 => "E_PARSE",
                      8 => "E_NOTICE",
                      16 => "E_CORE_ERROR",
                      32 => "E_CORE_WARNING",
                      64 => "E_COMPILE_ERROR",
                      128 => "E_COMPILE_WARNING",
                      256 => "E_USER_ERROR",
                      512 => "E_USER_WARNING",
                      1024 => "E_USER_NOTICE",
                      2048 => "E_STRICT",
                      4096 => "E_RECOVERABLE_ERROR",
                      8192 => "E_DEPRECATED",
                      16384 => "E_USER_DEPRECATED",
                      30719 => "E_ALL",);

      if (!Empty($err))
      {
        echo "
              zdrojova trida: <strong>{$class}</strong><br />
              typ: <strong>{$typ[$err["type"]]}</strong><br />
              message: <strong>{$err["message"]}</strong><br />
              file: <strong>{$err["file"]}</strong><br />
              line: <strong>{$err["line"]}</strong><hr />\n";
      }
        else
      {
        echo "* Uspech, zadna chyba!! z <strong>{$class}</strong><br />\n";
      }
      break;
    }
  }


}
?>
