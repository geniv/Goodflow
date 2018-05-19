<?php
class Funkce
{
  public $var;
//******************************************************************************
  function __construct(&$var) //konstruktor
  {
    $this->var = $var;

    if (!$this->var->sqlite = @new SQLiteDatabase($this->var->namesqlite, 0777, $error))
    {
      $this->ErrorMsg($error);
    }

    $this->Instalace();
  }
//******************************************************************************
  function ObsahStranky() //obsah stranky
  {
    $kam = $_GET["action"];
    if (!Empty($kam))
    {
      if (file_exists("{$kam}.php"))
      {
        $this->var->kam = $kam;
        $result = include_once "{$this->var->kam}.php";
      }
        else
      {
        $this->var->kam = $this->var->default;
        $result = include_once "{$this->var->kam}.php";
      }
    }
      else
   {
     $this->var->kam = $this->var->default;
     $result = include_once "{$this->var->kam}.php";
   }

     return $result;
  }
//******************************************************************************
  function OdkazZ5($zpet = 1) //vracec historie
  {
    $result = "<a href=\"javascript:history.back(-{$zpet});\">zpet</a>";

    return $result;
  }
//******************************************************************************
  function EmptyLine()  //prazdne pole
  {
    $result = "<strong>Prázdný řádek</strong>";

    return $result;
  }
//******************************************************************************
  function ErrorMsg($chyba)  //proecdura chybove hlasky
  {
    $this->var->chyba =
    "
         <div class=\"pozice_nastaveni_polozek chyba_odsazeni\">
          <div class=\"pozadi_top_razeni_katal\"></div>
           <div class=\"pozadi_obal_razeni_katal uprava_pro_chybu\">
             <p>
                Vyskytla se chyba:
              </p>
              <p class=\"chyba\">
                <cite>{$chyba}</cite>
                {$this->OdkazZ5()}
              </p>
              <span class=\"chyba_obrazek_vlevo\"></span>
              <span class=\"chyba_obrazek_vpravo\"></span>
           </div>
         <div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        </div>";
  }
//******************************************************************************
  function Menu()
  {
    switch ($this->kam)
    {
      case "cenik":
        $aktivni[0] = " aktivni";
      break;

      case "kontakt":
        $aktivni[1] = " aktivni";
      break;

      case "sit":
        $aktivni[2] = " aktivni";
      break;
    }

    $result =
    "
              <ul>
  <li class=\"menu_sit{$aktivni[2]}\"><a href=\"sit\" title=\"Síť\"><em>Síť</em></a></li>
                <li class=\"menu_kontakt{$aktivni[1]}\"><a href=\"kontakt\" title=\"Kontakt\"><em>Kontakt</em></a></li>
                <li class=\"menu_cenik{$aktivni[0]}\"><a href=\"cenik\" title=\"Cení­k\"><em>Cení­k</em></a></li>
              </ul>
    ";

    return $result;
  }
//******************************************************************************
  function Novinky()
  {
    $result =
    "
<div id=\"novinky\">

  <span class=\"hlavicka\"></span>

  <ul>";
    if ($res = @$this->var->sqlite->query("SELECT
                                          strftime('%d.%m.%Y', datum) as datum,
                                          popis
                                          FROM novinky
                                          ORDER BY novinky.datum DESC
                                          LIMIT 0, {$this->var->pocnovinek};
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
    <li>{$data->datum} {$data->popis}</li>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result .=
    "
  </ul>
  <span class=\"paticka\"></span>
</div>
    ";

    return $result;
  }
//******************************************************************************
  function PosliKontakt() //posle kontakt
  {
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $prijmeni = stripslashes(htmlspecialchars($_POST["prijmeni"]));
    $email = stripslashes(htmlspecialchars($_POST["e-mail"]));
    $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
    $vzkaz = stripslashes(htmlspecialchars($_POST["vzkaz"]));
    $datum = date("Y-m-d H:i:s");

    $text =
    "
    Tato zpráva ti byla zaslána z tvého webu http://kupredu.net<br />
    <br />
    <strong>{$jmeno} {$prijmeni}</strong> ti poslal zprávu z formuláře kontaktů na tvém webu.<br />
    <br />
    Formulář vyplnil následovně:<br />
    Jméno: <strong>{$jmeno}</strong><br />
    Příjmení: <strong>{$prijmeni}</strong><br />
    E-mail: <strong>{$email}</strong><br />
    Telefon: <strong>{$telefon}</strong><br />
    Datum: <strong>{$datum}</strong><br />
    Vzkaz: <strong>{$vzkaz}</strong><br />
    ";

    $header = "{$this->var->hlavicky}\nFrom: {$email}\n";  //hlavička

    if (!mail($this->var->email, "Zprava z webu kupredu.net", $text, $header))
    {
      $this->ErrorMsg("<div id=\"form\">E-mail nebyl odeslán.</div>");
    }
      else
    {
      $result = "<div id=\"form\">Odesláno.</div>";
    }

    return $result;
  }
//******************************************************************************
  function PosliDopravu() //posle autodopravu
  {
    $odkud = stripslashes(htmlspecialchars($_POST["odkud"]));
    $kam = stripslashes(htmlspecialchars($_POST["kam"]));
    $kdy = stripslashes(htmlspecialchars($_POST["kdy"]));
    $nazev_firmy = stripslashes(htmlspecialchars($_POST["nazev_firmy"]));
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $prijmeni = stripslashes(htmlspecialchars($_POST["prijmeni"]));
    $adresa = stripslashes(htmlspecialchars($_POST["adresa"]));
    $mesto = stripslashes(htmlspecialchars($_POST["mesto"]));
    $stat = stripslashes(htmlspecialchars($_POST["stat"]));
    $kontaktni_osoba = stripslashes(htmlspecialchars($_POST["kontaktni_osoba"]));
    $kontaktni_telefon = stripslashes(htmlspecialchars($_POST["kontaktni_telefon"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));
    $predpokladana_hmotnost = stripslashes(htmlspecialchars($_POST["predpokladana_hmotnost"]));
    $rozmery = stripslashes(htmlspecialchars($_POST["rozmery"]));
    $hodnota_zbozi = stripslashes(htmlspecialchars($_POST["hodnota_zbozi"]));
    $vzkaz = stripslashes(htmlspecialchars($_POST["vzkaz"]));

    $text =
    "
    Tato zpráva ti byla zaslána z tvého webu http://kupredu.net<br />
    <br />
    <strong>{$jmeno} {$prijmeni}</strong> ti poslal zprávu z formuláře Autodoprava na tvém webu.<br />
    <br />
    Formulář vyplnil následovně:<br />
    Odkud: <strong>{$odkud}</strong><br />
    Kam: <strong>{$kam}</strong><br />
    Kdy: <strong>{$kdy}</strong><br />
    Název Firmy: <strong>{$nazev_firmy}</strong><br />
    Jméno: <strong>{$jmeno}</strong><br />
    Příjmení: <strong>{$prijmeni}</strong><br />
    Adresa: <strong>{$adresa}</strong><br />
    Město: <strong>{$mesto}</strong><br />
    Stát: <strong>{$stat}</strong><br />
    Kontaktní osoba: <strong>{$kontaktni_osoba}</strong><br />
    Kontaktní telefon: <strong>{$kontaktni_telefon}</strong><br />
    Kontaktní e-mail: <strong>{$email}</strong><br />
    Hmotnost: <strong>{$predpokladana_hmotnost}</strong><br />
    Rozměry(cm): <strong>{$rozmery}</strong><br />
    Hodnota zboží: <strong>{$hodnota_zbozi}</strong><br />
    Vzkaz: <strong>{$vzkaz}</strong><br />
    ";

    $header = "{$this->var->hlavicky}\nFrom: {$email}\n";  //hlavička

    if (!mail($this->var->email, "Zprava z webu kupredu.net", $text, $header))
    {
      $this->ErrorMsg("<div id=\"form\">E-mail nebyl odeslán.</div>");
    }
      else
    {
      $result = "<div id=\"form\">Odesláno.</div>";
    }

    return $result;
  }
//******************************************************************************
  function PosliSatelit() //posle satelit
  {
    $misto = stripslashes(htmlspecialchars($_POST["misto"]));
    $firma = stripslashes(htmlspecialchars($_POST["firma"]));
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $prijmeni = stripslashes(htmlspecialchars($_POST["prijmeni"]));
    $adresa = stripslashes(htmlspecialchars($_POST["adresa"]));
    $mesto = stripslashes(htmlspecialchars($_POST["mesto"]));
    $stat = stripslashes(htmlspecialchars($_POST["stat"]));
    $kontaktni_osoba = stripslashes(htmlspecialchars($_POST["kontaktni_osoba"]));
    $kontaktni_telefon = stripslashes(htmlspecialchars($_POST["kontaktni_telefon"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));
    $vzkaz = stripslashes(htmlspecialchars($_POST["vzkaz"]));

    $text =
    "
    Tato zpráva ti byla zaslána z tvého webu http://kupredu.net<br />
    <br />
    <strong>{$jmeno} {$prijmeni}</strong> ti poslal zprávu z formuláře Satelitní příjem na tvém webu.<br />
    <br />
    Formulář vyplnil následovně:<br />
    Místo instalace: <strong>{$misto}</strong><br />
    Název firmy: <strong>{$firma}</strong><br />
    Jméno: <strong>{$jmeno}</strong><br />
    Příjmení: <strong>{$prijmeni}</strong><br />
    Adresa: <strong>{$adresa}</strong><br />
    Město: <strong>{$mesto}</strong><br />
    Stát: <strong>{$stat}</strong><br />
    Kontaktní osoba: <strong>{$kontaktni_osoba}</strong><br />
    Kontaktní telefon: <strong>{$kontaktni_telefon}</strong><br />
    Kontaktní e-mail: <strong>{$email}</strong><br />
    Vzkaz: <strong>{$vzkaz}</strong><br />
    ";

    $header = "{$this->var->hlavicky}\nFrom: {$email}\n";  //hlavička

    if (!mail($this->var->email, "Zprava z webu kupredu.net", $text, $header))
    {
      $this->ErrorMsg("<div id=\"form\">E-mail nebyl odeslán.</div>");
    }
      else
    {
      $result = "<div id=\"form\">Odesláno.</div>";
    }

    return $result;
  }
//******************************************************************************
  function AutoClick($cas, $cesta)  //auto kliknuti, procedura
  {
    $this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }
//******************************************************************************
  function Instalace()  //instalace databaze
  {
    if (filesize($this->var->namesqlite) == 0)
    {
      if (!@$this->var->sqlite->queryExec ("CREATE TABLE bezagregace (
                                            id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                            rychlost VARCHAR(200),
                                            cena INTEGER UNSIGNED,
                                            nazev VARCHAR(200));

                                            INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES (NULL, '400 Kbit/s', 99, 'Meloun');
                                            INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES (NULL, '700 Kbit/s', 200, 'Broskev');
                                            INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES (NULL, '800 Kbit/s', 256, 'Jahoda');
                                            INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES (NULL, '1,1 Mbit/s', 401, 'Vanilka');
                                            INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES (NULL, '1,6 Mbit/s', 601, 'Lesní plody');
                                            INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES (NULL, '2,1 Mbit/s', 801, 'Malina');

                                            CREATE TABLE agregace (
                                            id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                            rychlost VARCHAR(200),
                                            agregace VARCHAR(100),
                                            cena INTEGER UNSIGNED,
                                            nazev VARCHAR(200));

                                            INSERT INTO agregace (id, rychlost, agregace, cena, nazev) VALUES (NULL, '11 Mbit/s', '1:20', 256, 'Paprička');
                                            INSERT INTO agregace (id, rychlost, agregace, cena, nazev) VALUES (NULL, '11 Mbit/s', '1:10', 401, 'Chili paprička');

                                            CREATE TABLE novinky (
                                            id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                            datum DATETIME,
                                            popis TEXT);

                                            INSERT INTO novinky (id, datum, popis) VALUES (NULL, '2008-12-01 00:00:00', 'spuštěna nová verze webu');
                                            INSERT INTO novinky (id, datum, popis) VALUES (NULL, '2008-12-02 00:00:00', 'Zavedení nových tarifů');
                                            ", $error))
      {
        $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function VypisBezAgregace()
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          rychlost,
                                          cena,
                                          nazev
                                          FROM bezagregace
                                          ORDER BY bezagregace.cena ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
    <ul>
      <li class=\"rychlost\">{$data->rychlost}</li>
      <li class=\"cena\">{$data->cena} Kč</li>
      <li class=\"tarif\">{$data->nazev}</li>
    </ul>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function VypisSAgregaci()
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          rychlost,
                                          agregace,
                                          cena,
                                          nazev
                                          FROM agregace
                                          ORDER BY agregace.cena ASC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
    <ul>
      <li class=\"rychlost\">{$data->rychlost}</li>
      <li class=\"agregace\">{$data->agregace}</li>
      <li class=\"cena\">{$data->cena} Kč</li>
      <li class=\"tarif\">{$data->nazev}</li>
   </ul>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function KontrolaAutorizace($jmeno, $heslo)
  {
    $auth = array("6342fd9364b41005acce71e244849183", //ja
                  "93f9a5d3507bbd81db94663fd09dc866", //ta
                  "48acfd8edd4b6009c8257490df01c717", //on
                  "7c8c47575b1ff8a0a34e871a33b5954f", //mUP
                  "06b586c247dd639a269aa3bbe70fabac", //jur
                  "2750e0d761a4d611073ae2ac3b171753",
                  );

    $poc = 0;
    for ($i = 0; $i < count($auth); $i++)  //kontrola vcetne posledniho!
    {
      if (md5(md5($jmeno)) == $auth[$i] &&
          md5(md5($heslo)) == $auth[$i + 1])
      {
        $poc++;
      }
    }

    return ($poc == 1 ? true : false);
  }
//******************************************************************************
  function VypisAdminBezAgregace()
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          id,
                                          rychlost,
                                          cena,
                                          nazev
                                          FROM bezagregace
                                          ORDER BY bezagregace.cena ASC;
                                          ", NULL, $error))
    {
      $result .=
      "
      <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\">přidat</a>
      ";
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
    <ul>
      <li class=\"rychlost\">{$data->rychlost} <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;id={$data->id}\">edit</a></li>
      <li class=\"cena\">{$data->cena} Kč <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;id={$data->id}\">smazat</a></li>
      <li class=\"tarif\">{$data->nazev}</li>
    </ul>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    switch ($_GET["co"])
    {
      case "add": //pridavani
        $result =
        "přidávám...
        <form method=\"post\">
          <fieldset>
            rychlost:<input type=\"text\" name=\"rychlost\"><br>
            cena:<input type=\"text\" name=\"cena\">Kč<br>
            nazev:<input type=\"text\" name=\"nazev\"><br>
            <input type=\"submit\" name=\"tlacitko\" value=\"přidat\">
          </fieldset>
        </form>
        ";

        if (!Empty($_POST["tlacitko"]))
        {
          $rychlost = stripslashes(htmlspecialchars($_POST["rychlost"]));
          $cena = stripslashes(htmlspecialchars($_POST["cena"]));
          settype($cena, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

          if (!Empty($rychlost) &&
              !Empty($cena) &&
              !Empty($nazev))
          {
            if (@$this->var->sqlite->queryExec("INSERT INTO bezagregace (id, rychlost, cena, nazev) VALUES
                                                (NULL, '{$rychlost}', {$cena}, '{$nazev}');", $error))
            {
              $result =
              "
                        <div id=\"nacitani_central\" title=\"Byla přidána položka: {$nazev}\">
                          <p>
                            Byla přidána položka: <em>{$nazev}</em>
                          </p>
                        </div>
              ";

              $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        }
      break;


      case "edit":  //editace polozky
        $id = $_GET["id"];
        settype($cena, "integer");

        if ($id != 0)
        {
          if ($res = @$this->var->sqlite->query("SELECT
                                                rychlost,
                                                cena,
                                                nazev
                                                FROM bezagregace
                                                WHERE id={$id};
                                                ", NULL, $error))
          {

            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result =
          "upravuju...
          <form method=\"post\">
            <fieldset>
              rychlost:<input type=\"text\" name=\"rychlost\" value=\"{$data->rychlost}\"><br>
              cena:<input type=\"text\" name=\"cena\" value=\"{$data->cena}\">Kč<br>
              nazev:<input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\"><br>
              <input type=\"submit\" name=\"tlacitko\" value=\"upravit\">
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["tlacitko"]))
          {
            $rychlost = stripslashes(htmlspecialchars($_POST["rychlost"]));
            $cena = stripslashes(htmlspecialchars($_POST["cena"]));
            settype($cena, "integer");
            $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

            if (!Empty($rychlost) &&
                !Empty($cena) &&
                !Empty($nazev))
            {
              if (@$this->var->sqlite->queryExec ("UPDATE bezagregace SET rychlost='{$rychlost}',
                                                                          cena={$cena},
                                                                          nazev='{$nazev}'
                                                                          WHERE id={$id};", $error))
              {
                $result =
                "
                          <div id=\"nacitani_central\" title=\"Byla upravena položka: {$nazev}\">
                            <p>
                              Byl upravena položka: <em>{$nazev}</em>
                            </p>
                          </div>
                ";

                $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
        }
      break;


      case "del":  //smazani polozky
        $id = $_GET["id"];
        settype($cena, "integer");
        if ($id != 0)
        {
          if ($res = @$this->var->sqlite->query("SELECT
                                                rychlost,
                                                cena,
                                                nazev
                                                FROM bezagregace
                                                WHERE id={$id};
                                                ", NULL, $error))
          {

            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result =
          "upravuju...
          <form method=\"post\">
            <fieldset>
              smazat:{$data->nazev}??
              <input type=\"submit\" name=\"ano\" value=\"jo\">
              <input type=\"submit\" name=\"ne\" value=\"ne\">
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["ano"]))
          {
            if (@$this->var->sqlite->queryExec ("DELETE FROM bezagregace WHERE id={$id};", $error))
            {
              $result =
              "
                        <div id=\"nacitani_central\" title=\"Byla smazána položka: {$data->nazev}\">
                          <p>
                            Byl smazána položka: <em>{$data->nazev}</em>
                          </p>
                        </div>
              ";

              $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }

          if (!Empty($_POST["ne"]))
          {
            $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
          }
        }
      break;
    }

    return $result;
  }
//******************************************************************************
//******************************************************************************
  function VypisAdminSAgregaci()
  {
    if ($res = @$this->var->sqlite->query("SELECT
                                          id,
                                          rychlost,
                                          agregace,
                                          cena,
                                          nazev
                                          FROM agregace
                                          ORDER BY agregace.cena ASC;
                                          ", NULL, $error))
    {
      $result .=
      "
      <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\">přidat</a>
      ";
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
    <ul>
      <li class=\"rychlost\">{$data->rychlost} <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;id={$data->id}\">edit</a></li>
      <li class=\"tarif\">{$data->agregace}</li>
      <li class=\"cena\">{$data->cena} Kč <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;id={$data->id}\">smazat</a></li>
      <li class=\"tarif\">{$data->nazev}</li>
    </ul>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    switch ($_GET["co"])
    {
      case "add": //pridavani
        $result =
        "přidávám...
        <form method=\"post\">
          <fieldset>
            rychlost:<input type=\"text\" name=\"rychlost\"><br>
            agregace:<input type=\"text\" name=\"agregace\"><br>
            cena:<input type=\"text\" name=\"cena\">Kč<br>
            nazev:<input type=\"text\" name=\"nazev\"><br>
            <input type=\"submit\" name=\"tlacitko\" value=\"přidat\">
          </fieldset>
        </form>
        ";

        if (!Empty($_POST["tlacitko"]))
        {
          $rychlost = stripslashes(htmlspecialchars($_POST["rychlost"]));
          $agregace = stripslashes(htmlspecialchars($_POST["agregace"]));
          $cena = stripslashes(htmlspecialchars($_POST["cena"]));
          settype($cena, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

          if (!Empty($rychlost) &&
              !Empty($cena) &&
              !Empty($nazev))
          {
            if (@$this->var->sqlite->queryExec("INSERT INTO agregace (id, rychlost, agregace, cena, nazev) VALUES
                                                (NULL, '{$rychlost}', '{$agregace}', {$cena}, '{$nazev}');", $error))
            {
              $result =
              "
                        <div id=\"nacitani_central\" title=\"Byla přidána položka: {$nazev}\">
                          <p>
                            Byla přidána položka: <em>{$nazev}</em>
                          </p>
                        </div>
              ";

              $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        }
      break;


      case "edit":  //editace polozky
        $id = $_GET["id"];
        settype($cena, "integer");

        if ($id != 0)
        {
          if ($res = @$this->var->sqlite->query("SELECT
                                                rychlost,
                                                agregace,
                                                cena,
                                                nazev
                                                FROM agregace
                                                WHERE id={$id};
                                                ", NULL, $error))
          {

            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result =
          "upravuju...
          <form method=\"post\">
            <fieldset>
              rychlost:<input type=\"text\" name=\"rychlost\" value=\"{$data->rychlost}\"><br>
              agregace:<input type=\"text\" name=\"agregace\" value=\"{$data->agregace}\"><br>
              cena:<input type=\"text\" name=\"cena\" value=\"{$data->cena}\">Kč<br>
              nazev:<input type=\"text\" name=\"nazev\" value=\"{$data->nazev}\"><br>
              <input type=\"submit\" name=\"tlacitko\" value=\"upravit\">
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["tlacitko"]))
          {
            $rychlost = stripslashes(htmlspecialchars($_POST["rychlost"]));
            $agregace = stripslashes(htmlspecialchars($_POST["agregace"]));
            $cena = stripslashes(htmlspecialchars($_POST["cena"]));
            settype($cena, "integer");
            $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

            if (!Empty($rychlost) &&
                !Empty($cena) &&
                !Empty($nazev))
            {
              if (@$this->var->sqlite->queryExec("UPDATE agregace SET rychlost='{$rychlost}',
                                                                      agregace='{$agregace}',
                                                                      cena={$cena},
                                                                      nazev='{$nazev}'
                                                                      WHERE id={$id};", $error))
              {
                $result =
                "
                          <div id=\"nacitani_central\" title=\"Byla upravena položka: {$nazev}\">
                            <p>
                              Byl upravena položka: <em>{$nazev}</em>
                            </p>
                          </div>
                ";

                $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
        }
      break;


      case "del":  //smazani polozky
        $id = $_GET["id"];
        settype($cena, "integer");

        if ($id != 0)
        {
          if ($res = @$this->var->sqlite->query("SELECT
                                                rychlost,
                                                agregace,
                                                cena,
                                                nazev
                                                FROM agregace
                                                WHERE id={$id};
                                                ", NULL, $error))
          {

            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result =
          "upravuju...
          <form method=\"post\">
            <fieldset>
              smazat:{$data->nazev}??
              <input type=\"submit\" name=\"ano\" value=\"jo\">
              <input type=\"submit\" name=\"ne\" value=\"ne\">
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["ano"]))
          {
            if (@$this->var->sqlite->queryExec ("DELETE FROM agregace WHERE id={$id};", $error))
            {
              $result =
              "
                        <div id=\"nacitani_central\" title=\"Byla smazána položka: {$data->nazev}\">
                          <p>
                            Byl smazána položka: <em>{$data->nazev}</em>
                          </p>
                        </div>
              ";

              $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }

          if (!Empty($_POST["ne"]))
          {
            $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
          }
        }
      break;
    }

    return $result;
  }
//******************************************************************************
//******************************************************************************
  function VypisAdminNovinky()
  {
    $result .=
    "
    <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=add\">přidat</a>
    <ul>";

    if ($res = @$this->var->sqlite->query("SELECT
                                          id,
                                          strftime('%d.%m.%Y', datum) as datum,
                                          popis
                                          FROM novinky
                                          ORDER BY novinky.datum DESC;
                                          ", NULL, $error))
    {
      if ($res->numRows() != 0)
      {
        while ($data = $res->fetchObject())
        {
          $result .=
          "
    <li>{$data->datum} {$data->popis}
      <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;id={$data->id}\">edit</a>
      <a href=\"index.php?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;id={$data->id}\">smazat</a>
    </li>
          ";
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    $result .=
    "</ul>";

    //odmazavani nadbytecnych novinek
    if ($res = @$this->var->sqlite->query("SELECT
                                          id,
                                          strftime('%d.%m.%Y', datum) as datum
                                          FROM novinky
                                          ORDER BY novinky.datum DESC;
                                          ", NULL, $error))
    {

      if ($res->numRows() != 0)
      {
        $i = 1;
        while ($data = $res->fetchObject())
        {
          if ($i > $this->var->pocnovinek)
          {
            if (!@$this->var->sqlite->queryExec ("DELETE FROM novinky WHERE id={$data->id};", $error))
            {
              $this->ErrorMsg($error);
            }
          }
          $i++;
        }
      }
    }
      else
    {
      $this->ErrorMsg($error);
    }

    switch ($_GET["co"])
    {
      case "add": //pridavani
        $result =
        "přidávám...
        <form method=\"post\">
          <fieldset>
            datum:<input type=\"text\" name=\"datum\"><br>
            popis:<textarea name=\"popis\"></textarea><br>
            <input type=\"submit\" name=\"tlacitko\" value=\"přidat\">
          </fieldset>
        </form>
        ";

        if (!Empty($_POST["tlacitko"]))
        {
          $datum = stripslashes(htmlspecialchars($_POST["datum"]));
          $datum= date("Y-m-d H:i:s", strtotime($datum));
          $popis = stripslashes(htmlspecialchars($_POST["popis"]));

          if (!Empty($datum) &&
              !Empty($popis))
          {
            if (@$this->var->sqlite->queryExec("INSERT INTO novinky (id, datum, popis) VALUES
                                                (NULL, '{$datum}', '{$popis}');", $error))
            {
              $result =
              "
                        <div id=\"nacitani_central\" title=\"Byla přidána položka: {$datum}\">
                          <p>
                            Byla přidána položka: <em>{$datum}</em>
                          </p>
                        </div>
              ";

              $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }
        }
      break;


      case "edit":  //editace polozky
        $id = $_GET["id"];
        settype($cena, "integer");

        if ($id != 0)
        {
          if ($res = @$this->var->sqlite->query("SELECT
                                                strftime('%d.%m.%Y', datum) as datum,
                                                popis
                                                FROM novinky
                                                WHERE id={$id};
                                                ", NULL, $error))
          {

            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result =
          "upravuju...
          <form method=\"post\">
            <fieldset>
              datum:<input type=\"text\" name=\"datum\" value=\"{$data->datum}\"><br>
              popis:<textarea name=\"popis\">{$data->popis}</textarea><br>
              <input type=\"submit\" name=\"tlacitko\" value=\"upravit\">
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["tlacitko"]))
          {
            $datum = stripslashes(htmlspecialchars($_POST["datum"]));
            $datum= date("Y-m-d H:i:s", strtotime($datum));
            $popis = stripslashes(htmlspecialchars($_POST["popis"]));

           if (!Empty($datum) &&
                !Empty($popis))
            {
              if (@$this->var->sqlite->queryExec ("UPDATE novinky SET datum='{$datum}',
                                                                      popis='{$popis}'
                                                                      WHERE id={$id};", $error))
              {
                $result =
                "
                          <div id=\"nacitani_central\" title=\"Byla upravena položka: {$datum}\">
                            <p>
                              Byl upravena položka: <em>{$datum}</em>
                            </p>
                          </div>
                ";

                $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
              }
                else
              {
                $this->ErrorMsg($error);
              }
            }
          }
        }
      break;


      case "del":  //smazani polozky
        $id = $_GET["id"];
        settype($cena, "integer");

        if ($id != 0)
        {
          if ($res = @$this->var->sqlite->query("SELECT
                                                strftime('%d.%m.%Y', datum) as datum,
                                                popis
                                                FROM novinky
                                                WHERE id={$id};
                                                ", NULL, $error))
          {

            if ($res->numRows() == 1)
            {
              $data = $res->fetchObject();
            }
          }
            else
          {
            $this->ErrorMsg($error);
          }

          $result =
          "upravuju...
          <form method=\"post\">
            <fieldset>
              smazat:{$data->datum}??
              <input type=\"submit\" name=\"ano\" value=\"jo\">
              <input type=\"submit\" name=\"ne\" value=\"ne\">
            </fieldset>
          </form>
          ";

          if (!Empty($_POST["ano"]))
          {
            if (@$this->var->sqlite->queryExec ("DELETE FROM novinky WHERE id={$id};", $error))
            {
              $result =
              "
                        <div id=\"nacitani_central\" title=\"Byla smazána položka: {$data->datum}\">
                          <p>
                            Byl smazána položka: <em>{$data->datum}</em>
                          </p>
                        </div>
              ";

              $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
            }
              else
            {
              $this->ErrorMsg($error);
            }
          }

          if (!Empty($_POST["ne"]))
          {
            $this->var->main->AutoClick(1, "index.php?action={$_GET["action"]}&akce={$_GET["akce"]}");
          }
        }
      break;
    }

    return $result;
  }
//******************************************************************************
//******************************************************************************
}
?>
