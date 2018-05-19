<?php
class HlavniFunkce
{
  public $var;  //definice mistni promenne $var

/* kostruktor hlavni funkce, zapina session a defnuje mistni $this->var
 *
 * name: __construct
 * @param &var - adresa promenne predane z indexu
 * @return void
 */
  function __construct(&$var) //konstruktor
  {
    $this->var = $var;
    $this->StartSession();
    $this->var->web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
    //$_SESSION["SACTIVE"] = true;
  }

/* vraceni aktualniho ohsahu stranek
 *
 * name: ObsahStranky
 * @param nazev stranky
 * @return obsah stranek v html
 */
  function ObsahStranky($kam) //vkladani obsahu stranky
  {
    $result = "";
    if (!Empty($kam))
    {
      if (file_exists("{$this->var->form}/{$kam}.php"))
      {
        $this->var->kam = $kam;
        $result = include_once "{$this->var->form}/{$this->var->kam}.php";
      }
    }

    return $result;
  }

/* vrati obsah stranky v adminu
 *
 * name: ObsahAdminu
 * @param stranka
 * @return stranka v html
 */
  function ObsahAdminu($kam)
  {
    if (!Empty($kam))
    {
      if (file_exists("{$this->var->form}/admin_{$kam}.php"))
      {
        $cesta = "admin_{$kam}";
      }
        else
      {
        $cesta = $this->var->default;
      }
    }
      else
    {
      $cesta = $this->var->default;
    }

    $result = include_once "{$this->var->form}/{$cesta}.php";

    return $result;
  }

/* odstraneni bilich znaku z konce
 *
 * name: OdstranitBileZnaky
 * @param vstupni text
 * @return vrati text bez poslednch blich znaku
 */
  function OdstranitBileZnaky($text)
  {
    while ($text[strlen($text) - 1] == " ")
    {
      $text = substr($text, 0, -1);
    }

    $result = $text;

    return $result;
  }

/**
 *
 * Kontrola emailu pres regularni vyraz
 *
 * @param email text na zkontrolovani
 * @return je-li vyraz v poradku vrati jeho hodnotu
 */
  public function KontrolaEmailu($email)
  {
    $regular = "/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$/";
    preg_match($regular, $email, $ret);
    $result = $ret[0];  //vybere hodnotu z pole

    return $result;
  }

/* registruje uzivatele
 *
 * name: Registrace
 * @param void
 * @return hlaska vysledku registrace
 */
  function Registrace() //registrace novyho uzivatele
  {
    $login = stripslashes(htmlspecialchars($_POST["login"]));
    $heslo = stripslashes(htmlspecialchars($_POST["heslo"]));
    $heslo1 = stripslashes(htmlspecialchars($_POST["heslo1"]));
    $email = $this->KontrolaEmailu(stripslashes(htmlspecialchars($_POST["email"])));
    $jmeno = $this->OdstranitBileZnaky(stripslashes(htmlspecialchars($_POST["jmeno"])));
    $prijmeni = $this->OdstranitBileZnaky(stripslashes(htmlspecialchars($_POST["prijmeni"])));
    $ulice = $this->OdstranitBileZnaky(stripslashes(htmlspecialchars($_POST["ulice"])));
    $cp = $this->OdstranitBileZnaky(stripslashes(htmlspecialchars($_POST["cp"])));
    $psc = $this->OdstranitBileZnaky(stripslashes(htmlspecialchars($_POST["psc"])));
    $mesto = $this->OdstranitBileZnaky(stripslashes(htmlspecialchars($_POST["mesto"])));
    $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
    $souhlas = stripslashes(htmlspecialchars($_POST["souhlas"]));
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $session = session_id();
    $w = $_POST["w"];
    $h = $_POST["h"];
    settype($w, "integer");
    settype($h, "integer");
    $rozliseni = "{$w}x{$h}";
    $d = $_POST["d"];
    settype($d, "integer");

    $dot1 = $_POST["dot1"];
    settype($dot1, "integer");
    $dot2 = $_POST["dot2"];
    settype($dot2, "integer");
    $dot3 = $_POST["dot3"];
    settype($dot3, "integer");
    $dot4 = $_POST["dot4"];
    settype($dot4, "integer");

    if (!Empty($login) &&
        !Empty($heslo) &&
        !Empty($heslo1) &&
        !Empty($email) &&
        !Empty($jmeno) &&
        !Empty($prijmeni) &&
        !Empty($ulice) &&
        !Empty($cp) &&
        !Empty($psc) &&
        !Empty($mesto) &&
        //!Empty($telefon) &&
        !Empty($souhlas))
    {
      if ($heslo == $heslo1)
      {
        if ($souhlas == "true")
        { //kontrola jestli uz neexistuje-li login
          if ($res = @$this->var->mysqli->query("SELECT login FROM uzivatel
                                                WHERE
                                                (login='{$login}') OR
                                                (jmeno='{$jmeno}' AND prijmeni='{$prijmeni}' AND ulice='{$ulice}' AND cp='{$cp}' AND mesto='{$mesto}') OR
                                                (session='{$session}' AND ip='{$ip}');")) // AND DAY(datum)=DAY(NOW())
          {
            if ($res->num_rows == 0)
            {
              if (@$this->var->mysqli->multi_query("INSERT INTO uzivatel (id, login, heslo, jmeno, prijmeni, ulice, cp, psc, mesto, telefon, email, datum, upraveno, autorizace, aktivni, ip, agent, session, rozliseni, hloubka) VALUES
                                                                         (NULL, '{$login}', '{$heslo}', '{$jmeno}', '{$prijmeni}', '{$ulice}', '{$cp}', '{$psc}', '{$mesto}', '{$telefon}', '{$email}', NOW(), NOW(), false, true, '{$ip}', '{$agent}', '{$session}', '{$rozliseni}', {$d});"))
              {
                $result = "
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen obrazek_prihlasen_registrace\"></span>
      Registrace proběhla úspěšně.
      Na Váš email bylo zasláno autorizační potvrzení uživatelských údajů.
      <em>
        Zkontrolujte si prosím Váš uvedený email a dokončete autorizaci.
        Děkujeme. Váš team Superklik.cz
      </em>
    </p>
                ";

                $id = $this->var->mysqli->insert_id;
                settype($id, "integer");
                if (!@$this->var->mysqli->multi_query ("INSERT INTO uzivatel_dotaznik (id, uzivatel, odpoved1, odpoved2, odpoved3, odpoved4) VALUES
                                                        (NULL, {$id}, {$dot1}, {$dot2}, {$dot3}, {$dot4});
                                                        "))
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
                }

                $this->PoslatAutorizacniEmail($email, $id, $login, $heslo, $jmeno, $prijmeni);
              }
                else
              {
                $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
              }
            }
              else
            {
              $result = "
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen obrazek_prihlasen\"></span>
      Registrace nebyla provedena. Toto uživatelské jméno již existuje. Nebo jste se pred chvíli již registroval.
    </p>
              ";
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

        }
          else
        {
          $result = "
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen obrazek_prihlasen\"></span>
      Registrace nebyla provedena. Musíte souhlasit s podmínkami.
    </p>
";
        }
      }
        else
      {
        $result = "
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen obrazek_prihlasen\"></span>
      Registrace nebyla provedena. Zadali jste špatné heslo.
    </p>
";
      }
    }
      else
    {
      $result = "
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen obrazek_prihlasen\"></span>
      Registrace nebyla provedena. Nevyplnily jste některé údaje.
    </p>
";
    }

    return $result;
  }

/* posle autorizacni email uzivateli
 *
 * name: PoslatAutorizacniEmail
 * @param email, id uzivatele, login, jmeno, prijmeni uzivatele
 * @return void
 */
  function PoslatAutorizacniEmail($email, $id, $login, $heslo, $jmeno, $prijmeni)
  {
    $sifra = "{$id}{$email}{$heslo}{$prijmeni}{$login}{$jmeno}{$id}";
    $sifra = md5($sifra);

    $text =
    "
    Dobry den,<br /><br />
    Toto je autorizacni email soutezniho portalu Superklik.cz, kde jste provedli registraci.<br />
    Pro uplne dokonceni prosim kliknete na tento <a href=\"{$this->var->web}/auth.php?action={$sifra}\" title=\"Pro uplne dokonceni prosim kliknete na tento ODKAZ\">ODKAZ</a> a tim bude kompletne dokoncena autorizace Vasich udaju dulezitych pro registraci a zaslani pripadnych vyher.
    <br /><br />
    Tato autorizace ma platnost pouze 2 dny od data obdrzeni tohoto emailu. Pokud nebude provedeno potvrzeni autorizace udaju, registrace na souteznim portalu Superklik.cz bude automaticky smazana.
    <br /><br /><br />
    Vase prihlasovaci jmeno je: <strong>{$login}</strong><br />
    Vase prihlasovaci heslo je: <strong>{$heslo}</strong><br />
    <br /><br />
    Dekujeme a prejeme hodne stesti!<br />
    Vas team Superklik.cz
    ";

    $header = "{$this->var->hlavicky}";  //hlavicka
    $submit = "Autorizacni potvrzeni registrace na souteznim portalu Superklik.cz";
    //$submit = iconv("UTF-8", "Windows-1250", $submit);

    if (!@mail($email, $submit, $text, $header))
    {
      $this->var->main->ErrorMsg("E-mail nebyl odeslán");
    }
  }

/* kontrola overeni autorizace
 *
 * name: OvereniAutorizace
 * @param sifra
 * @return navratovy text
 */
  function OvereniAutorizace($sifra)
  {
    $poc = 0;
    if ($res = @$this->var->mysqli->query("SELECT id, login, heslo, jmeno, prijmeni, email FROM uzivatel WHERE autorizace=false;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $slozenasifra = "{$data->id}{$data->email}{$data->heslo}{$data->prijmeni}{$data->login}{$data->jmeno}{$data->id}";
          $slozenasifra = md5($slozenasifra); //zadni vratka autorizace

          if ($sifra == $slozenasifra)
          {
            $poc = $data->id;
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    if ($poc != 0)  //je-li nalezeno
    {
      if (@$this->var->mysqli->multi_query("UPDATE uzivatel SET autorizace=true WHERE id={$poc};"))
      {
        $result =
        "Byli jste úspěšně autorizováni! Hodně štěstí přeje team Superklik.cz Nyní se můžete přihlásit... přejít na <a href=\"{$this->var->web}\">www.superklik.cz</a>";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }
      else
    {
      $result = "Požadované potvrzení autorizace neproběhlo úspěšně. Může se jednat o expirovany účet uživatele. Prosim proveďte registraci znovu a potvrďte autorizační odkaz. Děkujeme. Váš team Superklik.cz";
    }

    return $result;
  }

/* kontroluje zda doba u nove zaregistrovanych bez autorizace nepresahla doba [timexprucet] dny
 *
 * name: KontrolaExpiraceAutorizace
 * @param void
 * @return void
 */
  function KontrolaExpiraceAutorizace()
  {
    if ($res = @$this->var->mysqli->query("SELECT id, datum FROM uzivatel WHERE autorizace=false;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $dat = strtotime($data->datum);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat) + $this->var->timexprucet, date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //interval expirace
          //echo "{$datum}<br/>";

          if (date("Y-m-d H:i:s") > $datum) //casovany interval date("Y-m-d H:i:s") > $datum - prekroceni aktualniho data vypocitaneho
          {
            if (!@$this->var->mysqli->multi_query("DELETE FROM uzivatel WHERE id={$data->id};"))
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }
  }

/* nastaven a startovani session
 *
 * name: StartSession
 * @param void
 * @return void
 */
  function StartSession() //aktvuje session promenne
  {
    session_name("SESSID"); //nastaveni jmena session
    session_register("SLOGIN"); //login uzivatele
    session_register("SHESLO"); //heslo uzivatele
    session_register("SACTIVE");  //prihlaseno/neprihlaseno
    session_register("IDUSER"); //id prihlaseneho uzivatele

    session_register("G_POM1"); //buben1
    session_register("G_POM2"); //buben2
    session_register("G_POM3"); //buben3
    session_register("G_VYS");  //vyhra - detekce vyhry
    session_register("G_VYH");  //cena

    session_start();
  }

/* prihlaseni uzivatele do stranek
 *
 * name: LoginUser
 * @param login, heslo
 * @return povoleno/nepovoleno
 */
  function LoginUser($login, $heslo)  //zalogovani uzivatele
  {
    if ($res = @$this->var->mysqli->query("SELECT id, login FROM uzivatel WHERE login='{$login}' AND heslo='{$heslo}' AND autorizace=true AND aktivni=true;"))
    {
      if ($res->num_rows == 1)
      {
        $data = $res->fetch_object();
        $_SESSION["IDUSER"] = $data->id;
        $_SESSION["SLOGIN"] = $login;
        $_SESSION["SHESLO"] = $heslo;
        $_SESSION["SACTIVE"] = true;  //prihlaseni
        $result = true;

        //zapise posledni cas prihlaseni
        if (!@$this->var->mysqli->multi_query ("UPDATE uzivatel SET naposledy=NOW()
                                                                    WHERE id={$data->id};"))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $_SESSION["IDUSER"] = 0;
        $_SESSION["SLOGIN"] = "";
        $_SESSION["SHESLO"] = "";
        $_SESSION["SACTIVE"] = false;  //spatne prihlaseno
        $result = false;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vrati hodoty uctu uzivatele
 *
 * name: ReturnValieUditUser
 * @param vstup id, vystup editovatelene polozky
 * @return void
 */
  function ReturnValieUditUser($id, &$email, &$jmeno, &$prijmeni, &$ulice, &$cp, &$psc, &$mesto, &$telefon) //vrati hodnoty uzivatele
  {
    settype($id, "integer");
    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, login, heslo, jmeno, prijmeni, ulice, cp, psc, mesto, telefon, email FROM uzivatel WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();
          $jmeno = $data->jmeno;
          $prijmeni = $data->prijmeni;
          $email = $data->email;
          $telefon = $data->telefon;
          $ulice = $data->ulice;
          $cp = $data->cp;
          $psc = $data->psc;
          $mesto = $data->mesto;
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }
  }

/* editace uzivatele
 *
 * name: EditUser
 * @param id
 * @return zprava
 */
  function EditUser($id)  //upravi uzivatele
  {
    $email = stripslashes(htmlspecialchars($_POST["email"]));
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $prijmeni = stripslashes(htmlspecialchars($_POST["prijmeni"]));
    $ulice = stripslashes(htmlspecialchars($_POST["ulice"]));
    $cp = stripslashes(htmlspecialchars($_POST["cp"]));
    $psc = stripslashes(htmlspecialchars($_POST["psc"]));
    $mesto = stripslashes(htmlspecialchars($_POST["mesto"]));
    $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
    settype($id, "integer");

    if ($id != 0)
    {
      if (@$this->var->mysqli->multi_query("UPDATE uzivatel SET jmeno='{$jmeno}',
                                                                prijmeni='{$prijmeni}',
                                                                ulice='{$ulice}',
                                                                cp='{$cp}',
                                                                psc='{$psc}',
                                                                mesto='{$mesto}',
                                                                telefon='{$telefon}',
                                                                email='{$email}',
                                                                upraveno=NOW()
                                                                WHERE id={$id};
                                                        "))
      {
        $result = "
<h2></h2>
  <div>
    <p class=\"texty_odhlaseno_prihlaseno\">
      <span class=\"obrazek_odhlasen_prihlasen obrazek_prihlasen\"></span>
      Byly upraveny vaše osobní údaje.
    </p>
  </div>
<h3 class=\"pravidla_bottom\"></h3>
        "; // {$jmeno}
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* instalace tabulek databaze
 *
 * name: InstalaceMySQLi
 * @param void
 * @return void
 */
  function InstalaceMySQLi()  //instalace DB
  {
    if ($this->var->instalace)  //je-li instalace rucne povolena
    {
      if (!$this->ExistujeTabulka("uzivatel")) //tabulka uzivatelu
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE uzivatel (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              login VARCHAR(50) NULL,
                                              heslo VARCHAR(50) NULL,
                                              jmeno VARCHAR(50) NULL,
                                              prijmeni VARCHAR(50) NULL,
                                              ulice VARCHAR(100) NULL,
                                              cp VARCHAR(50) NULL,
                                              psc VARCHAR(50) NULL,
                                              mesto VARCHAR(200) NULL,
                                              telefon VARCHAR(50) NULL,
                                              email VARCHAR(100) NULL,
                                              datum DATETIME NULL,
                                              upraveno DATETIME NULL,
                                              naposledy DATETIME NULL,
                                              autorizace BOOL NULL,
                                              aktivni BOOL NULL,
                                              ip VARCHAR(30) NULL,
                                              agent VARCHAR(200) NULL,
                                              session VARCHAR(100) NULL,
                                              rozliseni VARCHAR(50) NULL,
                                              hloubka INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX login(login))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("losovani")) //tabulka losovani
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE losovani (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              uzivatel INTEGER UNSIGNED NULL,
                                              datum DATETIME NULL,
                                              buben1 INTEGER UNSIGNED NULL,
                                              buben2 INTEGER UNSIGNED NULL,
                                              buben3 INTEGER UNSIGNED NULL,
                                              vyhra BOOL NULL,
                                              cena INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id),
                                              INDEX uzivatel(uzivatel))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE losovani ADD
                                              FOREIGN KEY (uzivatel) REFERENCES uzivatel(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("vyherci")) //tabulka vyherci
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE vyherci (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              uzivatel INTEGER UNSIGNED NULL,
                                              poloha INTEGER UNSIGNED NULL,
                                              datum DATETIME NULL,
                                              popis TEXT NULL,
                                              PRIMARY KEY(id),
                                              INDEX uzivatel(uzivatel))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE vyherci ADD
                                              FOREIGN KEY (uzivatel) REFERENCES uzivatel(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("adresa")) //tabulka logovacich adres
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE adresa (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              ip VARCHAR(30) NULL,
                                              uzivatel INTEGER UNSIGNED NULL,
                                              jmeno VARCHAR(50) NULL,
                                              agent VARCHAR(200) NULL,
                                              cas DATETIME NULL,
                                              rozliseni VARCHAR(50) NULL,
                                              hloubka INTEGER UNSIGNED NULL,
                                              session VARCHAR(100) NULL,
                                              pocet INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("logovani")) //tabulka logovani
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE logovani (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              login VARCHAR(50) NULL,
                                              heslo VARCHAR(50) NULL,
                                              pristup BOOL NULL,
                                              agent VARCHAR(200) NULL,
                                              session VARCHAR(100) NULL,
                                              cas DATETIME NULL,
                                              rozliseni VARCHAR(50) NULL,
                                              hloubka INTEGER UNSIGNED NULL,
                                              ip VARCHAR(30) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("nastaveni")) //tabulka nastaveni
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE nastaveni (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              promenna VARCHAR(200) NULL,
                                              hodnota VARCHAR(200) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("nastaveni") != 2) //automaticka instalace nastaveni
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO nastaveni (id, promenna, hodnota) VALUES (NULL, 'min_ot', '1'),
                                                                                                    (NULL, 'max_ot', '10');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
/*
      if (!$this->ExistujeTabulka("otazky_anketa")) //tabulka otazky_anketa
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE otazky_anketa (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              otazky VARCHAR(200) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX otazky(otazky))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("odpovedi_anketa")) //tabulka odpovedi_anketa
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE odpovedi_anketa (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              otazka INTEGER UNSIGNED NULL,
                                              odpoved VARCHAR(200) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
*/
      if (!$this->ExistujeTabulka("uzivatel_dotaznik")) //tabulka uzivatel_dotaznik
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE uzivatel_dotaznik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              uzivatel INTEGER UNSIGNED NULL,
                                              odpoved1 INTEGER UNSIGNED NULL,
                                              odpoved2 INTEGER UNSIGNED NULL,
                                              odpoved3 INTEGER UNSIGNED NULL,
                                              odpoved4 INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id),
                                              INDEX uzivatel(uzivatel))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE uzivatel_dotaznik ADD
                                              FOREIGN KEY (uzivatel) REFERENCES uzivatel(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("sekce_dotaznik")) //tabulka sekce_dotaznik
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE sekce_dotaznik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              otazka VARCHAR(100) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("sekce_dotaznik") != 4) //automaticka instalace sekce_dotaznik
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO sekce_dotaznik (id, otazka) VALUES (1, 'Pohlaví:'),
                                                                                              (2, 'Stáří:'),
                                                                                              (3, 'Pracuji jako:'),
                                                                                              (4, 'O Superklik.cz jsem se dozvěděl(a):');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("dotaznik")) //tabulka dotaznik
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE dotaznik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce INTEGER UNSIGNED NULL,
                                              odpoved VARCHAR(100) NULL,
                                              PRIMARY KEY(id),
                                              INDEX sekce(sekce))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE dotaznik ADD
                                              FOREIGN KEY (sekce) REFERENCES sekce_dotaznik(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("dotaznik") != 22) //automaticka instalace dotaznik
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO dotaznik (id, sekce, odpoved) VALUES (1, 1, 'Muž'),
                                                                                                (2, 1, 'Žena'),

                                                                                                (3, 2, '5 - 11 let'),
                                                                                                (4, 2, '12 - 15 let'),
                                                                                                (5, 2, '16 - 18 let'),
                                                                                                (6, 2, '19 - 25 let'),
                                                                                                (7, 2, '26 - 35 let'),
                                                                                                (8, 2, '36 - 50 let'),
                                                                                                (9, 2, '51 - a více let'),

                                                                                                (10, 3, 'Podnikatel'),
                                                                                                (11, 3, 'Státní správa'),
                                                                                                (12, 3, 'Ekonom'),
                                                                                                (13, 3, 'Školství'),
                                                                                                (14, 3, 'Ve firmě'),
                                                                                                (15, 3, 'Student'),
                                                                                                (16, 3, 'Nezaměstnaný'),

                                                                                                (17, 4, 'Z internetové reklamy'),
                                                                                                (18, 4, 'Z televize'),
                                                                                                (19, 4, 'Z novin'),
                                                                                                (20, 4, 'Z inzerátu'),
                                                                                                (21, 4, 'Od známého'),
                                                                                                (22, 4, 'Z letáku');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("sekce_pravidla")) //tabulka sekce_pravidla
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE sekce_pravidla (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              cislo INTEGER UNSIGNED NULL,
                                              nazev VARCHAR(200) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("pravidla")) //tabulka pravidla
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE pravidla (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce INTEGER UNSIGNED NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id),
                                              INDEX sekce(sekce))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE pravidla ADD
                                              FOREIGN KEY (sekce) REFERENCES sekce_pravidla(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("sekce_pravidla") != 8)  //je-li pocet radku < 8
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO sekce_pravidla (id, cislo, nazev) VALUES ('1', '1', 'Definice'),
                                                                                                    ('2', '2', 'Obecná pravidla'),
                                                                                                    ('3', '3', 'Registrace'),
                                                                                                    ('4', '4', 'Ochrana osobních údajů'),
                                                                                                    ('5', '5', 'Účást v soutěžích'),
                                                                                                    ('6', '6', 'Kreditní systém'),
                                                                                                    ('7', '7', 'Záruky provozovatele'),
                                                                                                    ('8', '8', 'Závěrečná ustanovení');

                                              INSERT INTO pravidla (id, sekce, text) VALUES (NULL , '1', 'Výherní server (dále jen Superklik.cz) – je veřejný webový server umožňující výhry pro jednotlivé soutěžící. Soutěžit může jen zaregistrovaný uživatel.'),
                                                                                            (NULL , '1', 'Uživatel soutěže (dále jen uživatel nebo soutěžící) - osoba, která je občanem České republiky a má zde trvalé bydliště a při registraci potvrdí souhlas s těmito pravidly.'),
                                                                                            (NULL , '1', 'Pořadatel soutěže (dále jen pořadatel) - právnická nebo fyzická osoba, která si u provozovatele zadá zveřejnění soutěže. Pořadatelem může být i provozovatel.'),
                                                                                            (NULL , '1', 'Provozovatel Superklik.cz (dále jen provozovatel) – AZ-System s.r.o. se sídlem Fibichova 43, Břeclav, 690 02, IČO: 25715909, www.azsystem.cz'),
                                                                                            (NULL , '1', 'Výherce soutěže (dále jen výherce) - uživatel, který zodpověděl správně soutěžní otázky v soutěži a byl automaticky vylosován po skončení soutěže.'),

                                                                                            (NULL , '2', 'Na výherním portálu Superklik.cz se mohou účastnit všichni zaregistrovaní uživatelé serveru kteří souhlasí s těmito pravidly, s výjimkou zaměstnanců a spolupracovníků provozovatele a jejich rodinných příslušníků.'),
                                                                                            (NULL , '2', 'Provoz serveru, povinnosti provozovatele, pořadatelů a uživatelů jsou dány těmito pravidly.'),

                                                                                            (NULL , '3', 'Zkusit své štěstí se mohou účastnit pouze řádně zaregistrovaní uživatelé. Řádnou registrací se rozumí uvedení všech povinných registračních údajů v souladu se skutečností. Nepovinné údaje vyplněny být nemusí, nesmějí však být vyplněny v rozporu se skutečností. Uživatel je povinen v případě změny jakýchkoliv registračních údajů opravit tyto data na stránce změna registrace, a to do 1 měsíce od okamžiku, kdy změna nastala.'),
                                                                                            (NULL , '3', 'Každý uživatel serveru může být na Superklik.cz v jeden okamžik zaregistrován pouze jednou.'),
                                                                                            (NULL , '3', 'V případě zjištění duplicitních registrací nebo nepravdivých údajů (v rozporu se skutečností) si provozovatel vyhrazuje právo na nepřiznání výhry takovémuto uživateli a na úplné zrušení všech duplicitních registrací.'),

                                                                                            (NULL , '4', 'Veškerá data získaná od uživatele jsou považována za jeho osobní a vztahuje se na ně ochrana podle zákona č. 101/2000 Sb. o ochraně osobních údajů.'),
                                                                                            (NULL , '4', 'Provozovatel se zavazuje, že osobní údaje uživatelů nebudou předávány žádné třetí osobě. Výjimku tvoří pouze data výherců, která mohou být uveřejněna na stránkách Superklik.cz ve formátu &quot;Jméno - Příjmení - Město&quot;) a dále může být jejich jméno a adresa předána pořadateli soutěže pro zaslání výhry.'),
                                                                                            (NULL , '4', 'Data získaná od uživatele slouží jako základ pro generovaní výsledných statistických zpráv a jako kontaktní údaje pro zasílání výher nebo &quot;dárků za účast v soutěži&quot;, kterými mohou být slevy na různé zboží apod.'),
                                                                                            (NULL , '4', 'E-maily s oznámením o nových soutěžích nebo o výhrách mohou mimo toto oznámení obsahovat i reklamní sdělení či obrázek.'),
                                                                                            (NULL , '4', 'Uživatel může kdykoliv zrušit svou registraci po přihlášení k serveru pomocí svého uživatelského jména a hesla, které zadá v průběhu registrace. Po zrušení registrace jsou veškerá data uživatele zanonymizována v souladu se zákonem č. 101/2000 Sb. o ochraně osobních údajů.'),

                                                                                            (NULL , '5', 'U každé ze soutěží je uvedeno datum jejího vyhlášení i datum ukončení, přičemž během této doby se mohou uživatelé zúčastnit soutěže zodpovězením všech soutěžních otázek. Uživatelé, kteří zodpoví správně všechny soutěžní otázky, postupují do slosování o výhry. Losování soutěží probíhá automaticky do 14 dnů od data jejího ukončení. Vylosovaní výherci jsou v závislosti na nastavení osobních preferencí informováni o své výhře prostřednictvím elektronické pošty na e-mailovou adresu uvedenou při registraci'),
                                                                                            (NULL , '5', 'Některé soutěže můžou mít doplňující nebo omezující požadavky na výherce. Jedná se například o výhry tabákových či alkoholických výrobků, zapůjčení automobilu atp. Výherce který nesplňuje všeobecné právní požadavky k získání takové výhry může výhru převést písemným, notářsky ověřeným prohlášením na jinou osobu která tyto požadavky splňuje, nebo za něj může výhru převzít jeho zákonný zástupce.'),
                                                                                            (NULL , '5', 'Výhry jsou zasílány pouze v rámci území ČR a to na adresy výherců uvedených při registraci nejpozději do 1 měsíce od data slosování, přičemž u některých výher může být účtováno poštovné formou dobírky. V případě, že se výhra vrátí odesílateli z důvodu nevyzvednutí výhercem, bude po dobu 1 měsíce připravena k osobnímu vyzvednutí v sídle provozovatele. Pokud výhra nebude ani v této lhůtě vyzvednuta, propadá ve prospěch pořadatele soutěže.'),
                                                                                            (NULL , '5', 'Pokud není pořadatelem soutěže přímo provozovatel, nenese provozovatel žádnou zodpovědnost za případné nedodání či neodeslání výher výhercům ze strany pořadatele soutěže.'),
                                                                                            (NULL , '5', 'Výhry jsou právně nevymahatelné.'),

                                                                                            (NULL , '6', 'Každá soutěž je ohodnocena určitým počtem kreditů které se při správném zodpovězení soutěžních otázek po skončení soutěže přičtou na účet uživatele.'),
                                                                                            (NULL , '6', 'Kredity se přičtou uživateli pouze při správném zodpovězení soutěžní otázky následný den po ukončení soutěže.'),
                                                                                            (NULL , '6', 'Kredity je možno sbírat po dobu kalendářního roku. Účastník s největším počtem kreditů k 31.12. pak získá cenu předem vyhlášenou provozovatelem.'),
                                                                                            (NULL , '6', 'Pořadatel může určit i kratší dobu (nejčastěji měsíc) po jejímž uplynutí získá cenu určenou provozovatelem ten soutěžící, který má nejvíce kreditů.'),
                                                                                            (NULL , '6', 'Pokud má největší počet kreditů více uživatelů rozhodne o výherci losování stejně jako u standardních soutěží.'),

                                                                                            (NULL , '7', 'Provozovatel neposkytuje záruku nepřetržité funkčnosti, bezchybného provozu a zabezpečení serveru. Je v zájmu provozovatele veškeré funkce systému poskytovat uživatelům na maximální možné úrovni. Provozovatel se zavazuje plnit veškeré povinnosti plynoucí z těchto podmínek.'),
                                                                                            (NULL , '7', 'Provozovatel neodpovídá za jakoukoliv škodu, která byla nebo mohla být uživateli nebo pořadateli způsobena v souvislosti s jeho používáním nebo využíváním serveru Superklik.cz.'),

                                                                                            (NULL , '8', 'Tato pravidla jsou vytvořena v souladu s platnými zákony a dalšími právními předpisy České republiky a jsou závazná pro obě strany. Uživatel serveru svou registrací potvrzuje, že byl s nimi prokazatelným způsobem seznámen a zavazuje se podle nich řídit.'),
                                                                                            (NULL , '8', 'Provozovatel si vyhrazuje právo na případnou změnu a doplnění těchto registračních podmínek. V tomto případě provozovatel oznámí změny upozorněním na stránkách serveru Superklik.cz'),
                                                                                            (NULL , '8', 'Tato pravidla jsou platná ode dne 1.3.2006');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("vyhry")) //tabulka vyhry
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE vyhry (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              popis TEXT NULL,
                                              typ VARCHAR(10) NULL,
                                              dodavatel TEXT NULL,
                                              www VARCHAR(500) NULL,
                                              aktivni BOOL NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("vyhry") != 8) //automaticka instalace bubnu
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO vyhry (id, popis, typ, dodavatel, www, aktivni) VALUES (1, '[span]LCD TV Full HD[/span] [span]SAMSUNG LE40A756[/span]', 'png', 'Samsung', 'www', false),
                                                                                                                  (2, 'Autorádio Kenwood KDC-W3037A', 'png', 'AUTOSHOP, Břeclav', 'www', false),
                                                                                                                  (3, '[span]Dárková poukázka v hodnotě 4.000,-[/span] [span]na ubytování, stravu a rybolov[/span]', 'png', '[span]KD system s.r.o.[/span] [span]Rybník Balaton - Brno[/span]', 'www', false),
                                                                                                                  (4, '[span]Notebook HP Pavilion DV5-1115[/span] [span]DVD±RW LS/WiFi/BT/VHP[/span]', 'png', 'Hawlett - Packard', 'www', false),
                                                                                                                  (5, 'SONY PSP - PlayStation Portable3004', 'png', 'MeximONE s.r.o.', 'www', false),
                                                                                                                  (6, '[span]Poukázka na nákup v hodnotě 4 x 500,- Kč[/span] [span]po celé ČR v prodejnách Hervis sport[/span]', 'png', 'Hervis Sport', 'www', false),
                                                                                                                  (7, '---', '', '---', '', false),
                                                                                                                  (8, '---', '', '---', '', false);
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("sekce_cenik")) //tabulka sekce_cenik
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE sekce_cenik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              nadpis VARCHAR(200) NULL,
                                              format VARCHAR(100) NULL,
                                              cena1 VARCHAR(100) NULL,
                                              cena2 VARCHAR(100) NULL,
                                              poznamka VARCHAR(100) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("sekce_cenik") != 3) //automaticka instalace sekce_cenik
      {
        if (!@$this->var->mysqli->multi_query ("INSERT INTO sekce_cenik (id, nadpis, format, cena1, cena2, poznamka) VALUES (1, 'VIP LOGA NA SOUTĚŽNÍCH VÁLCÍCH', 'Formáty a velikost', 'Cena/týden', 'Cena/měsíc', 'Poznámka'),
                                                                                                                            (2, 'BANNERY', 'Formáty a velikost', 'Cena/týden', 'Cena/měsíc', 'Poznámka'),
                                                                                                                            (3, 'OSTATNÍ FORMY REKLAMY', 'Formát', 'Specifikace', 'Cena', 'Poznámka');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("cenik")) //tabulka cenik
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE cenik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce INTEGER UNSIGNED NULL,
                                              format VARCHAR(500) NULL,
                                              cena1 VARCHAR(500) NULL,
                                              cena2 VARCHAR(500) NULL,
                                              poznamka TEXT NULL,
                                              PRIMARY KEY(id),
                                              INDEX sekce(sekce))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE cenik ADD
                                              FOREIGN KEY (sekce) REFERENCES sekce_cenik(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("cenik") != 6) //automaticka instalace cenik
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO cenik (id, sekce, format, cena1, cena2, poznamka) VALUES (NULL, 1, 'Logo společnosti [span]30x30[/span]', '5 000 Kč', '15 000 Kč', '[span]- umístění loga společnosti na válce[/span][span]- odkaz na www stránky[/span][span]- zdarma rozesílání reklamních emailů[/span][span]- vyhotovení reklamního banneru zdarma[/span]'),
                                                                                                                    (NULL, 2, 'Postraní reklamní banner [span]468x60[/span]', '3 000 Kč', '10 000 Kč', '[center]---[/center]'),
                                                                                                                    (NULL, 2, 'Fullbanner nahoře / dole [span]468x60[/span]', '1 500 Kč', '5 000 Kč', '[center]---[/center]'),
                                                                                                                    (NULL, 2, 'Postraní banner [span]468x60[/span]', '3 000 Kč', '10 000 Kč', '[center]---[/center]'),
                                                                                                                    (NULL, 3, 'Logo společnosti s odkazem na www stránky', '[span]Rozsah A4,[/span] [span]3x foto max 200x200[/span]', '[span]2 000 Kč / týden[/span] [span]5 000 Kč / měsíc[/span]', '[center]Exkluzivita v oboru + 10% ceny[/center]'),
                                                                                                                    (NULL, 3, 'Běžící reklamní text', 'odkaz na vaše stránky, text v délce max. 40 znaků', '[span]1 000 Kč / týden[/span] [span]3 000 Kč / měsíc[/span]', '[center]---[/center]');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("objednavka_cenik")) //tabulka sekce_cenik
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE objednavka_cenik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              jmeno VARCHAR(200) NULL,
                                              prijmeni VARCHAR(200) NULL,
                                              ulice VARCHAR(200) NULL,
                                              mesto VARCHAR(200) NULL,
                                              psc VARCHAR(50) NULL,
                                              telefon VARCHAR(50) NULL,
                                              email VARCHAR(100) NULL,
                                              pozadavek TEXT NULL,
                                              datum DATETIME NULL,
                                              ip VARCHAR(30) NULL,
                                              agent VARCHAR(200) NULL,
                                              session VARCHAR(100) NULL,
                                              rozliseni VARCHAR(50) NULL,
                                              hloubka INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("sekce_faq")) //tabulka sekce_faq
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE sekce_faq (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              nazev VARCHAR(200) NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("sekce_faq") != 2) //automaticka instalace sekce_faq
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO sekce_faq (id, nazev) VALUES (1, 'Technické otázky'),
                                                                                        (2, 'Soutěžní dotazy');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("faq")) //tabulka faq
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE faq (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce INTEGER UNSIGNED NULL,
                                              otazka TEXT NULL,
                                              odpoved TEXT NULL,
                                              PRIMARY KEY(id),
                                              INDEX sekce(sekce))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;

                                              ALTER TABLE faq ADD
                                              FOREIGN KEY (sekce) REFERENCES sekce_faq(id)
                                              ON DELETE CASCADE
                                              ON UPDATE CASCADE;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("faq") != 5) //automaticka instalace faq
      {
        if (!@$this->var->mysqli->multi_query ("INSERT INTO faq (id, sekce, otazka, odpoved) VALUES (NULL, 1, 'Nezobrazuje si mi úvodní animace ve flashi a nelze dále procházet stránkami.', 'Váš webový prohlížeč zřejmě neobsahuje nainstalovanou/aktuální verzi flash v.9.0 a vyšší. Pro odstranění tohoto problému musíte nainstalovat Micromedia Flash Player, nebo zkontrolujte zda je povolen flash ve vašem prohlížeči.'),
                                                                                                    (NULL, 1, 'Pro jaké verze internetového prohlížeče je optimalizován ?', 'Internet Explorer 6, Internet Explorer 7, Firefox 2, Firefox 3, Opera, Safari, ostatní prohlížeče založené na jádru Gecko.'),
                                                                                                    (NULL, 1, 'Po klepnutí na odkaz se nic nezobrazí, co mám dělat ?', 'Zkontrolujte zda má Váš Internetový prohlížeč zapnutou funkci JavaScript.'),
                                                                                                    (NULL, 2, 'Mohu zkusit své štěstí vícekrát za den ?', 'Ne, systém výher je nastaven pro každého uživatele pouze na jeden pokus za den. Systém kontroluje a zamezuje přihlášení stejného uživatele pomocí kontroly IP adresy a ID prohlížeče.'),
                                                                                                    (NULL, 2, 'Pokud vyhraji, bude mi cena za výhru zaslána ?', 'Ano, vše bude doručeno poštovní dobírkou České pošty dle zadaných registračních údajů.');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if (!$this->ExistujeTabulka("texty")) //tabulka texty
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE texty (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce VARCHAR(200) NULL,
                                              text TEXT NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("texty") != 6) //automaticka instalace texty
      {
        if (!@$this->var->mysqli->multi_query("INSERT INTO texty (id, sekce, text) VALUES (NULL, 'rekl_text_on', '1'),
                                                                                          (NULL, 'rekl_text1', 'Hypernova - akce týdne - kuře grilované 34,-Kč'),
                                                                                          (NULL, 'rekl_text2', ''),
                                                                                          (NULL, 'rekl_text3', ''),
                                                                                          (NULL, 'rekl_text4', ''),
                                                                                          (NULL, 'rekl_text5', '');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }


      if (!$this->ExistujeTabulka("banner")) //tabulka banner
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE banner (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              cesta VARCHAR(500) NULL,
                                              pos_top INTEGER NULL,
                                              pos_left INTEGER NULL,
                                              width INTEGER UNSIGNED NULL,
                                              height INTEGER UNSIGNED NULL,
                                              posledni BOOL NULL,
                                              PRIMARY KEY(id))

                                              ENGINE = InnoDB
                                              ROW_FORMAT = COMPACT
                                              DEFAULT CHARACTER SET utf8
                                              COLLATE utf8_czech_ci;
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      if ($this->PocetRadkuTabulky("banner") != 5) //automaticka instalace banner
      {
        if (!@$this->var->mysqli->multi_query ("INSERT INTO banner (id, cesta, pos_top, pos_left, width, height, posledni) VALUES
                                                (1, '{$this->var->web}/flash/autoshop.swf', 0, -132, 120, 400, false),
                                                (2, '{$this->var->web}/flash/CDC.swf ', 400, -132, 120, 400, false),
                                                (3, '{$this->var->web}/flash/balaton.swf', 0, 749, 120, 400, false),
                                                (4, '{$this->var->web}/flash/klenot.swf', 400, 749, 120, 400, true),
                                                (5, '{$this->var->web}/flash/FSC.swf', 800, -132, 120, 400, true);
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }

      /*
      ENGINE = InnoDB
      ROW_FORMAT = COMPACT
      DEFAULT CHARACTER SET utf8
      COLLATE utf8_czech_ci
      */
    }
  }

/* otevreni komunikace mysqli -- php
 *
 * name: OtevriMySQLi
 * @param void
 * @return pripojeno/nepripojeno
 */
  function OtevriMySQLi() //otvírání DB
  {
    $this->var->mysqli = @new mysqli($this->var->login->host, $this->var->login->username, $this->var->login->password, $this->var->login->databaze, $this->var->login->port);
    if (!mysqli_connect_errno())  //objektové připojení do DB mysqli_connect_errno()
    {
      if (@$this->var->mysqli->multi_query("SET CHARACTER SET UTF8")) //bez návratu testuje jen chybu s negací
      {
        $result = true;
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->myslqi->error);
      }
    }
      else
    {
      $result = false;
      $this->var->main->ErrorMsg(mysqli_connect_error());
    }

    return $result;
  }

/* zavre komunikaci databaze
 *
 * name: ZavriMySQLi
 * @param void
 * @return void
 */
  function ZavriMySQLi()  //zavírání DB
  {
    $this->var->mysqli->close();
  }

/* overeni existence tabulky
 *
 * name: ExistujeTabulka
 * @param nazev
 * @return existuje/neexistuje
 */
  function ExistujeTabulka($nazev)  //ověření existence tabulky
  {
    if ($res = @$this->var->mysqli->query("SHOW TABLES"))
    {
      $poc = $res->num_rows;
      $pex = 0;
      $tab = "Tables_in_{$this->var->login->databaze}";

      while ($data = $res->fetch_object())
      {
        if ($data->$tab == $nazev)
        {
          $pex++;
        }
      }

      $result = ($pex == 1 ? true : false);
    }
      else
    {
      $this->var->main->ErrorMsg($var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* spocita pocet radku v dane tabulce
 *
 * name: PocetRadkuTabulky
 * @param nazev tabulky
 * @return pocet radku
 */
  function PocetRadkuTabulky($tabulka)
  {
    if ($res = @$this->var->mysqli->query("SELECT COUNT(id) as pocet FROM {$tabulka};"))
    {
      if ($res->num_rows == 1)
      {
        $result = $res->fetch_object()->pocet;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* textovy odkaz z5 o N zadanych kroku zpet
 *
 * name: OdkazZ5
 * @param pocet kroku zpet
 * @return forma odkazu
 */
  function OdkazZ5($zpet = 1) //vraceč historie
  {
    $result = include "{$this->var->form}/odkaz_z5.php";

    return $result;
  }

/* text prazdne pole
 *
 * name: EmptyLine
 * @param void
 * @return text v html
 */
  function EmptyLine()  //prázdné pole
  {
    $result = include "{$this->var->form}/empty_line.php";

    return $result;
  }

/* dialog chyboveho hlaseni
 *
 * name: ErrorMsg
 * @param text chyby
 * @return chyba v html
 */
  function ErrorMsg($chyba)  //proecdura chybové hlášky
  {
    $this->var->chyba = include "{$this->var->form}/error_msg.php";
  }

/* nastaveni auto presmerovani
 *
 * name: AutoClick
 * @param cas (s), cesta (url)
 * @return meta-tag
 */
  function AutoClick($cas, $cesta)  //auto kliknutí, procedůra
  {
    $this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
  }

/* kontrola autorizace, prihlaseni do adminu
 *
 * name: KontrolaAutorizace
 * @param jmeno, heslo
 * @return povoleno/nepovoleno
 */
  function KontrolaAutorizace($jmeno, $heslo)
  {
    $auth = array("6342fd9364b41005acce71e244849183", //ja
                  "da5f45b7f012fddca9bcb7d37c8f1509", //a_s_t
                  "48acfd8edd4b6009c8257490df01c717", //on
                  "7c8c47575b1ff8a0a34e871a33b5954f", //mUP
                  "299902807d34eb3c27d132bc89d2e6d6", //pav
                  "6124b73c891e17d7e835e02baaa2dc94", //new
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


  public $start, $konec;  //definice promennych pro mereni casu
/* vraceni casu stopek
 *
 * name: MeritCas
 * @param void
 * @return cas stopek
 */
  function MeritCas() //funkce pro vrácení času
  {
    $cas = explode(" ", microtime());
    $soucet = $cas[1] + $cas[0];

    return $soucet;
  }

/* nastavi do promene start pocatecni stav
 *
 * name: StartCas
 * @param void
 * @return void
 */
  function StartCas() //zapis začátku
  {
    $this->start = $this->MeritCas();
    //sleep(15);  //test presnosti
  }

/* zjisti cas stopek a udela rozdil startu a konce vysledkem je cas vygenerovani
 *
 * name: KonecCas
 * @param void
 * @return vygenerovani stranky v html
 */
  function KonecCas() //zápis konce a finální vypis doby
  {
    $this->konec = $this->MeritCas();
    $presnost = 10000; //nastavená přesnost
    $cas = Abs((Round(($this->konec - $this->start) * $presnost)) / $presnost); //Abs, výpočet

    return include "{$this->var->form}/vygenerovano.php";
  }

/* zjistuje kdo ma dnes svatek
 *
 * name: DnesMaSvatek
 * @param void
 * @return jmeno oslavence
 */
  function DnesMaSvatek() //funkce vraci jmeno toho kdo ma svatek
  {
    $svatek = array(1 => array(1 => "Nový rok", //leden
                                    "Karina",
                                    "Radmila",
                                    "Diana",
                                    "Dalimil",
                                    "Tři králové",
                                    "Vilma",
                                    "Čestmír",
                                    "Vladan",
                                    "Břetislav",
                                    "Bohdana",
                                    "Pravoslav",
                                    "Edita",
                                    "Radovan",
                                    "Alice",
                                    "Ctirad",
                                    "Drahoslav",
                                    "Vladislav",
                                    "Doubravka",
                                    "Ilona",
                                    "Běla",
                                    "Slavomír",
                                    "Zdeněk",
                                    "Milena",
                                    "Miloš",
                                    "Zora",
                                    "Ingrid",
                                    "Otýlie",
                                    "Zdislava",
                                    "Robin",
                                    "Marika"),

                         array(1 => "Hynek",  //unor
                                    "Nela/Hromnice",
                                    "Blažej",
                                    "Jarmila",
                                    "Dobromila",
                                    "Vanda",
                                    "Veronika",
                                    "Milada",
                                    "Apolena",
                                    "Mojmír",
                                    "Božena",
                                    "Slavěna",
                                    "Věnceslav",
                                    "Valentýn",
                                    "Jiřina",
                                    "Ljuba",
                                    "Miloslava",
                                    "Gizela",
                                    "Patrik",
                                    "Oldřich",
                                    "Lenka",
                                    "Petr",
                                    "Svatopluk",
                                    "Matěj",
                                    "Liliana",
                                    "Dorota",
                                    "Alexandr",
                                    "Lumír",
                                    "Horymír"),

                         array(1 => "Bedřich",  //brezen
                                    "Anežka",
                                    "Kamil",
                                    "Stela",
                                    "Kazimír",
                                    "Miroslav",
                                    "Tomáš",
                                    "Gabriela",
                                    "Františka",
                                    "Viktorie",
                                    "Anděla",
                                    "Řehoř",
                                    "Růžena",
                                    "Rút/Matylda",
                                    "Ida",
                                    "Elena/Herbert",
                                    "Vlastimil",
                                    "Eduard",
                                    "Josef",
                                    "Světlana",
                                    "Radek",
                                    "Leona",
                                    "Ivona",
                                    "Gabriel",
                                    "Marián",
                                    "Emanuel",
                                    "Dita",
                                    "Soňa",
                                    "Taťána",
                                    "Arnošt",
                                    "Kvido"),

                         array(1 => "Hugo", //duben
                                    "Erika",
                                    "Richard",
                                    "Ivana",
                                    "Miroslava",
                                    "Vendula",
                                    "Heřman/Hermína",
                                    "Ema",
                                    "Dušan",
                                    "Darja",
                                    "Izabela",
                                    "Julius",
                                    "Aleš",
                                    "Vincenc",
                                    "Anastázie",
                                    "Irena",
                                    "Rudolf",
                                    "Valérie",
                                    "Rostislav",
                                    "Marcela",
                                    "Alexandra",
                                    "Evženie",
                                    "Vojtěch",
                                    "Jiří",
                                    "Marek",
                                    "Oto",
                                    "Jaroslav",
                                    "Vlastislav",
                                    "Robert",
                                    "Blahoslav"),

                         array(1 => "Svátek práce", //kveten
                                    "Zikmund",
                                    "Alexej",
                                    "Květoslav",
                                    "Klaudie, Květnové povstání českého lidu",
                                    "Radoslav",
                                    "Stanisla",
                                    "Den osvobození od fašismu",
                                    "Ctibor",
                                    "Blažena",
                                    "Svatava",
                                    "Pankrác",
                                    "Servác",
                                    "Bonifác",
                                    "Žofie",
                                    "Přemysl",
                                    "Aneta",
                                    "Nataša",
                                    "Ivo",
                                    "Zbyšek",
                                    "Monika",
                                    "Emil",
                                    "Vladimír",
                                    "Jana",
                                    "Viola",
                                    "Filip",
                                    "Valdemar",
                                    "Vilém",
                                    "Maxmilián",
                                    "Ferdinand",
                                    "Kamila"),

                         array(1 => "Laura",  //cerven
                                    "Jarmil",
                                    "Tamara",
                                    "Dalibor",
                                    "Dobroslav",
                                    "Norbert",
                                    "Iveta/Slavoj",
                                    "Medard",
                                    "Stanislav",
                                    "Gita",
                                    "Bruno",
                                    "Antonie",
                                    "Antonín",
                                    "Roland",
                                    "Vít",
                                    "Zbyněk",
                                    "Adolf",
                                    "Milan",
                                    "Leoš",
                                    "Květa",
                                    "Alois",
                                    "Pavla",
                                    "Zdeňka",
                                    "Jan",
                                    "Ivan",
                                    "Adriana",
                                    "Ladislav",
                                    "Lubomír",
                                    "Petr a Pavel",
                                    "Šárka"),

                         array(1 => "Jaroslava",  //cervenec
                                    "Patricie",
                                    "Radomír",
                                    "Prokop",
                                    "Den slovanských věrozvěstů Cyrila a Metoděje",
                                    "Upálení mistra Jana Husa",
                                    "Bohuslava",
                                    "Nora",
                                    "Drahoslava",
                                    "Libuše/Amálie",
                                    "Olga",
                                    "Bořek",
                                    "Markéta",
                                    "Karolína",
                                    "Jindřich",
                                    "Luboš",
                                    "Martina",
                                    "Drahomíra",
                                    "Čeněk",
                                    "Ilja",
                                    "Vítězslav",
                                    "Magdeléna",
                                    "Libor",
                                    "Kristýna",
                                    "Jakub",
                                    "Anna",
                                    "Věroslav",
                                    "Viktor",
                                    "Marta",
                                    "Bořivoj",
                                    "Ignác"),

                         array(1 => "Oskar",  //srpen
                                    "Gustav",
                                    "Miluše",
                                    "Dominik",
                                    "Kristián",
                                    "Oldřiška",
                                    "Lada",
                                    "Soběslav",
                                    "Roman",
                                    "Vavřinec",
                                    "Zuzana",
                                    "Klára",
                                    "Alena",
                                    "Alan",
                                    "Hana",
                                    "Jáchym",
                                    "Petra",
                                    "Helena",
                                    "Ludvík",
                                    "Bernard",
                                    "Johana",
                                    "Bohuslav",
                                    "Sandra",
                                    "Bartoloměj",
                                    "Radim",
                                    "Luděk",
                                    "Otakar",
                                    "Augustýn",
                                    "Evelína",
                                    "Vladěna",
                                    "Pavlína"),

                         array(1 => "Linda/Samuel", //zari
                                    "Adéla",
                                    "Bronislav",
                                    "Jindřiška",
                                    "Boris",
                                    "Boleslav",
                                    "Regína",
                                    "Mariana",
                                    "Daniela",
                                    "Irma",
                                    "Denisa",
                                    "Marie",
                                    "Lubor",
                                    "Radka",
                                    "Jolana",
                                    "Ludmila",
                                    "Naděžda",
                                    "Kryštof",
                                    "Zita",
                                    "Oleg",
                                    "Matouš",
                                    "Darina",
                                    "Berta",
                                    "Jaromír",
                                    "Zlata",
                                    "Andrea",
                                    "Jonáš",
                                    "Václav, Den české státnosti",
                                    "Michal",
                                    "Jeroným"),

                         array(1 => "Igor", //rijen
                                    "Olívie",
                                    "Bohumil",
                                    "František",
                                    "Eliška",
                                    "Hanuš",
                                    "Justýna",
                                    "Věra",
                                    "Štefan/Sára",
                                    "Marina",
                                    "Andrej",
                                    "Marcel",
                                    "Renáta",
                                    "Agáta",
                                    "Tereza",
                                    "Havel",
                                    "Hedvika",
                                    "Lukáš",
                                    "Michaela",
                                    "Vendelín",
                                    "Brigita",
                                    "Sabina",
                                    "Teodor",
                                    "Nina",
                                    "Beáta",
                                    "Erik",
                                    "Šarlota/Zoe",
                                    "Den vzniku samostatného československého státu",
                                    "Silvie",
                                    "Tadeáš",
                                    "Štěpánka"),

                         array(1 => "Felix",  //listopad
                                    "Památka zesnulých",
                                    "Hubert",
                                    "Karel",
                                    "Miriam",
                                    "Liběna",
                                    "Saskie",
                                    "Bohumír",
                                    "Bohdan",
                                    "Evžen",
                                    "Martin",
                                    "Benedikt",
                                    "Tibor",
                                    "Sáva",
                                    "Leopold",
                                    "Otmar",
                                    "Mahulena, Den boje studentů za svobodu a demokracii",
                                    "Romana",
                                    "Alžběta",
                                    "Nikola",
                                    "Albert",
                                    "Cecílie",
                                    "Klement",
                                    "Emílie",
                                    "Kateřina",
                                    "Artur",
                                    "Xenie",
                                    "René",
                                    "Zina",
                                    "Ondřej"),

                         array(1 => "Iva",  //prosinec
                                    "Blanka",
                                    "Svatoslav",
                                    "Barbora",
                                    "Jitka",
                                    "Mikuláš",
                                    "Ambrož/Benjamín",
                                    "Květoslava",
                                    "Vratislav",
                                    "Julie",
                                    "Dana",
                                    "Simona",
                                    "Lucie",
                                    "Lýdie",
                                    "Radana",
                                    "Albína",
                                    "Daniel",
                                    "Miloslav",
                                    "Ester",
                                    "Dagmar",
                                    "Natálie",
                                    "Šimon",
                                    "Vlasta",
                                    "Adam a Eva, Štědrý den",
                                    "Boží hod vánoční - svátek vánoční",
                                    "Štěpán - svátek vánoční",
                                    "Žaneta",
                                    "Bohumila",
                                    "Judita",
                                    "David",
                                    "Silvestr - Nový rok"));

    return $svatek[date("n")][date("j")];
  }

/* rozparsruje a upravi html kod nahodneho horoskopu a prevede kodovani na UTF-8
 *
 * name: Horoskop
 * @param void
 * @return vyparsrovany a upraveny nahodny horoskop
 */
  function Horoskop() //zobrazuje strucne horoskopy
  {
    $url = "http://www.e-horoskopy.cz/jv-horoskop.asp";

    $page = $this->OpenUrl($url);
    $result = iconv("Windows-1250", "UTF-8", $page);

    $a = explode("<img src=\"", $result);
    $b = explode("\"", $a[1]);
    $oldurl = $b[0];
    $newurl = "picture.php?q=".base64_encode(base64_encode($b[0]));

    $hledat = array("document.write('",
                    "');",
                    "<small><a href=\"http://www.e-horoskopy.cz/\" target=\"_blank\">...další znamení</a></small>",
                    "<br>",
                    " align=\"absmiddle\"",
                    "\">",
                    $oldurl);

    $nahradit = array("",
                      "",
                      "",
                      "",
                      "",
                      "\" />",
                      $newurl);

    $result = str_replace($hledat, $nahradit, $result);

    return $result;
  }

/* rozparseruje dany horoskop
 *
 * name: RozdelHoroskop
 * @param source (zdroj), vraci: nazev, datum, text, lide, penize, erotika, vecer
 * @return void
 */
  function RozdelHoroskop($source, &$nazev, &$datum, &$text, &$lide, &$penize, &$erotika, &$vecer)  //rozparsruje obsah horoskopu
  {
    $a = explode("<div class=\"obr\">", $source);
    $b = explode("</a>", $a[0]);
    $nazev = $b[0];
    $c = explode("<div class=\"center\">", $a[1]);
    $d = explode("<div class=\"anotace\"><p>", $c[1]);
    $e = explode("</div>", $d[0]);
    $datum = $e[0];
    $f = explode("<ul>", $d[1]);
    $g = explode("</p>", $f[0]);
    $text = $g[0];
    $h = explode("<li>", $f[1]);
    $i = explode("</li>", $h[1]);
    $lide = $i[0];
    $j = explode("</li>", $h[2]);
    $penize = $j[0];
    $k = explode("</li>", $h[3]);
    $erotika = $k[0];
    $l = explode("</li>", $h[4]);
    $vecer = $l[0];

/*
    $aa = $i[0];
    for ($i = 0; $i < strlen($aa); $i++)
    {
      echo ord($aa[$i])." -- (".chr(ord($aa[$i]))."), ";
    }
*/
  }

/* zobrazi horoskop pres ajax
 *
 * name: ShowObsahHoroskopu
 * @param typ (znameni)
 * @return horoskop poskladany v nasem html
 */
  function ShowObsahHoroskopu($typ) //zobrazi obsah horoskopu pres ajax
  {
    $url = "http://www.e-horoskopy.cz/";
    $source = $this->OpenUrl($url);
    $source = iconv("Windows-1250", "UTF-8", $source);

    $a = explode("<div class=\"znameni\">", $source);

    for ($i = 1; $i <= 12; $i++)
    {
      $b = explode("<h2><a href=\"{$typ}.asp\">", $a[$i]);
      if (strlen($b[0]) == 2)
      {
        $c = $b[1];
        break;
      }
    }

    $this->RozdelHoroskop($c, $nazev, $datum, $text, $lide, $penize, $erotika, $vecer);
    $obr = "<img src=\"obr/horoskopy/znameni-{$typ}.gif\" />";

    $result =
    "
<div id=\"vypis_zpravy_horoskopy\">
  <div id=\"vypis_zpravy_horoskopy_vnitrek\">
    <h2>{$nazev} - {$datum}</h2>
      <p>
      {$obr}
      <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"ZobrazitZpravu(0, 0); return false;\"><span>Zavřít sekci</span></a>
      {$text}<br />
      <em></em>
      {$lide}<br />
      {$penize}<br />
      {$erotika}<br />
      {$vecer}
      </p>
  </div>
</div>
    ";

    return $result;
  }

/* rozparsruje kurzy men
 *
 * name: Kurzy
 * @param vraci: euro, usd, skk, gbp, hrk
 * @return void
 */
  function Kurzy(&$eur, &$usd, &$gbp, &$hrk) //vyparsruje kurzy ze stranek
  {
    $url = "http://www.novinky.cz/";
    $result = $this->OpenUrl($url);

    $a = explode("<td class=\"curName\">", $result);
    //$b = explode("<td class=\"curBid\">", $a[1]);

    $eur = explode("<td class=\"curBid\"> ", $a[1]);
    $eur = explode(" </td>", $eur[1]);
    $eur = $eur[0];

    $usd = explode("<td class=\"curBid\"> ", $a[2]);
    $usd = explode(" </td>", $usd[1]);
    $usd = $usd[0];

    $gbp = explode("<td class=\"curBid\"> ", $a[3]);
    $gbp = explode(" </td>", $gbp[1]);
    $gbp = $gbp[0];

    $hrk = explode("<td class=\"curBid\"> ", $a[4]);
    $hrk = explode(" </td>", $hrk[1]);
    $hrk = $hrk[0];
  }

/* zjisteni jestli hlavicka zpravy neobsahuje blokovane slovo
 *
 * name: BlokSlovo
 * @param hlavicka zpravy
 * @return nelezeno - obsahuje/nebsahuje
 */
  function BlokSlova($zprava)
  {
    $result = false;
    for ($i = 0; $i < count($this->var->blokzpravy); $i++)  //projde plokovane fraze
    {
      if (strpos($zprava, $this->var->blokzpravy[$i]) !== false)  //vyhodnoceni jestli se v 1 zprave neobsahuje jedno z blokovanych slov
      {
        $result = true;
        break;
      }
    }

    return $result;
  }

/* ulozi zpravy do cache pro rychlejsi nacitani
 *
 * name: SaveCacheZpravy
 * @param url, pocet zprav, cislo cache, rucni update true/false
 * @return void
 */
  function SaveCacheZpravy($url, $pocet, $typ, $rucne = false)  //ulozy zpravy do cache automaticky/rucne
  {
    if (!file_exists($this->var->cache))  //vytvoreni slozky
    {
      mkdir($this->var->cache, 0777);
    }

    $hledat = array("/");
    $nahradit = array("__");
    $uri = str_replace($hledat, $nahradit, $url);

    if (file_exists("{$this->var->cache}/.{$uri}"))
    {
      $dat = filemtime("{$this->var->cache}/.{$uri}");
      $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat) + $this->var->cachetimezpravy, date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //interval refresh dat
      //echo "{$datum}<br>";

      if (date("Y-m-d H:i:s") > $datum || $rucne) //casovany reload chche pameti  date("Y-m-d H:i:s") > $datum
      {
        $source = $this->OpenUrl($url);  //nacteni do promenne
        if ($source != NULL)
        {
          $xml = new SimpleXMLElement($source); //zbytecna oklika nad funkci!
        }

/*
        $xml = new XMLReader();
        $xml->open($url);

        $items = null;
        $index = 0;
        $name = "";
        $isItem = false;
        while($xml->read())
        {
          switch ($xml->nodeType)
          {
            case XMLReader::ELEMENT:
              if($xml->name == "item")
              {
                $isItem = true;
              }
              else
              if($isItem)
              {
                $name = $xml->name;
              }
            break;

            case XMLReader::END_ELEMENT:
              if($xml->name == "item")
              {
                $isItem = false;
                $index++;
              }
            break;

            case XMLReader::TEXT:
            case XMLReader::CDATA:
              if(!Empty($isItem))
              {
                $items[$index][$name] = $xml->value;
              }
            break;
          }
        }

        $xml->close();
*/

        $poc = 0;
        for ($i = 0; $poc < $pocet; $i++) //dela dokud nenacte potrebny pocet spravnych zprav
        {
          //odstreneni nebezpecnych znaku
          $hledat = array("\"", //uvozovka
                          "\n",
                          "\n\n",
                          "\n\n\n",
                          "\n\n\n\n",
                          "\n\n\n\n\n", //5 enter
                          "„",  //specialni uvozovky
                          "“");

          $nahradit = array("&quot;",
                            "",
                            "",
                            "",
                            "",
                            "", //5 enter
                            "&quot;",
                            "&quot;");

          //odstraneni polozek blokovanych polozek
          if (!$this->BlokSlova($xml->item[$i]->title)) //$items[$i]["title"]
          {
            $link = $xml->item[$i]->link;  //$items[$i]["link"];
            $title = $xml->item[$i]->title; //$items[$i]["title"];
            $text = str_replace($hledat, $nahradit, $xml->item[$i]->description);  //$items[$i]["description"]

            $zprava[$poc] = "{$link}---||---{$title}---||---{$text}";
            $poc++;
          }
        }

        $soubor = "{$this->var->cache}/.{$uri}";
        $u = fopen($soubor, "w");
        fwrite($u, implode("|||--|||", $zprava));
        fclose($u);

        $soubor = "{$this->var->cache}/.{$typ}";
        $u = fopen($soubor, "w");
        fwrite($u, $uri);
        fclose($u);
      }
    }
      else
    {
      $u = fopen("{$this->var->cache}/.{$uri}", "w"); //vytvoreni souboru
      fclose($u);
    }
  }

/* nacte zpravy z cache pameti
 *
 * name: ShowCaheZpravy
 * @param url cache
 * @return array zprav
 */
  function ShowCaheZpravy($url) //vypse zpravy z cache
  {
    if (!file_exists("./cache"))  //vytvoreni slozky
    {
      mkdir("./cache", 0777);
    }

    $hledat = array("/");
    $nahradit = array("__");
    $uri = str_replace($hledat, $nahradit, $url);

    $soubor = "{$this->var->cache}/.{$uri}";
    if (file_exists($soubor) && //existuje-li a je-li nenulova velikost
        filesize($soubor) != 0)
    {
      $u = fopen($soubor, "r");
      $data = explode("|||--|||", fread($u, filesize($soubor)));
      fclose($u);

      for ($i = 0; $i < count($data); $i++)
      {
        $mezidata = explode("---||---", $data[$i]);
        $result["link"][$i] = $mezidata[0];
        $result["title"][$i] = $mezidata[1];
        $result["text"][$i] = $mezidata[2];
      }
    }
      else
    {
      $this->SaveCacheZpravy($url, 1, 1, true); //kdyz je soubor s cache prazdny nacte jeden radek, zbytek udela kontrola poctu zprav
    }

    return $result;
  }

/* vypise danou zpravu pres ajax
 *
 * name: ShowObsahZpravy
 * @param cislo zpravy, typ zpravy
 * @return zprava zpracovany v danem html formatu
 */
  function ShowObsahZpravy($cislo, $typ)  //zobraz zpravu
  {
    if ($typ != 0)
    {
      $soubor = "{$this->var->cache}/.{$typ}";
      $u = fopen($soubor, "r");
      $nazev = fread($u, filesize($soubor));
      fclose($u);
      $zpravy = $this->ShowCaheZpravy($nazev);

      $link = $zpravy["link"][$cislo];
      $title = $zpravy["title"][$cislo];
      $text = $zpravy["text"][$cislo];

      //$url = $this->GetObrazekZpravy($link, $title);
      switch ($typ)
      {
        case 1:
          $url = "obr/ikona_odrazka_z_domova_velky.png";
        break;

        case 2:
          $url = "obr/ikona_odrazka_ze_sveta_velky.png";
        break;

        case 3:
          $url = "obr/ikona_odrazka_ze_sportu_velky.png";
        break;
      }

      if (!Empty($url))
      {
        $obr = "<img src=\"{$url}\" alt=\"{$title}\" />"; //
      }
        else
      {
        $tit = " style=\"float: left;\"";
      }

      $result = //nejak na hovno: <div id=\"vypis_zpravy_horoskopy\"></div>
      "
<div id=\"vypis_zpravy_horoskopy\">
  <div id=\"vypis_zpravy_horoskopy_vnitrek\">

  <h2{$tit}>{$title}</h2>
    <p>

    {$obr}

    <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"ZobrazitZpravu(0, 0); return false;\"><span>Zavřít sekci</span></a>

    {$text}

    </p>

  </div>
</div>
      ";
    }
      else
    {
      $result = "";
    }

    return $result;
  }

/* overi zda existuje url dle hlavicky c.200
 *
 * name: ExistenceUrl
 * @param url
 * @return existuje/neexistuje
 */
  function ExistenceUrl($url) //overi jestli url existuje!
  {
    if (!in_array($_SERVER["REMOTE_ADDR"], $this->var->ipblok))
    {
      $a = get_headers($url);
      if (count($a) > 1)
      {
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
        $result = false;
      }
    }
      else
    {
      $result = true;
    }

    return $result;
  }

/* vyparsruje obrazek z dane url
 *
 * name: GetObrazekZpravy
 * @param url, oddelovac title
 * @return url obrazku

  function GetObrazekZpravy($url, $title) //ziska obrazek ze stranek
  {
    $source = $this->OpenUrl($url);  //nacteni do promenne

    $a = @explode("{$title}", $source);
    if (strpos($url, "sport.cz") !== false)  //kdyz je sport - jsou jene indexy parseru
    {
      if (count($a) == 3)
      {
        $b = explode("<img src=\"", $a[1]);//$a[2]
        $c = explode("\" alt=\"", $b[3]);
      }
        else
      {
        $b = explode("<img src=\"", $a[0]);
        $c = explode("\" alt=\"", $b[3]);
      }
    }
      else
    {
      if (count($a) == 3)
      {
        $b = explode("<img src=\"", $a[2]); //standartni indexy
        $c = explode("\" alt=\"", $b[1]);
      }
        else
      {
        $b = explode("<img src=\"", $a[0]);
        $c = explode("\" alt=\"", $b[3]);
      }
    }

    if (strpos($c[0], "http:") !== false) //obsahuje-li c0 text http
    {
      $result = "picture.php?q=".base64_encode(base64_encode($c[0]));
    }
      else
    {
      $result = "";
    }

    return $result;
  }
*/

/* inicializacni funkce zprav, nacitani, ukladani a kontrola cache
 *
 * name: Zpravy
 * @param adresa zprav, pocet zprav, typ zpravy
 * @return vyrezany blok zprav v html
 */
  function Zpravy($adresa, $pocet, $typ)
  {
    $this->SaveCacheZpravy($adresa, $pocet, $typ);

    $zpravy = $this->ShowCaheZpravy($adresa);

    $poc = 0; //pocitadlo nefunkcnich zprav
    $result = "";
    for ($i = 0; $i < count($zpravy["title"]); $i++)
    {
      $title = $zpravy["title"][$i];

      $delka = strlen($title);  //texty optimalizovany pro "windows FF"
      $podm = 70;
      if ($delka < $podm)
      {
        $reducetitle = $title;
      }
        else
      {
        $reducetitle = substr($title, 0, $podm)."...";
      }

      $reducetitle = iconv("UTF-8", "UTF-8", $reducetitle); //uhlazeni diakritiky

      $obr = "";
      if ($i == 0)
      {
        //$url = $this->GetObrazekZpravy($zpravy["link"][0], $title);
        switch ($typ)
        {
          case 1:
            $url = "obr/ikona_odrazka_z_domova.png";
          break;

          case 2:
            $url = "obr/ikona_odrazka_ze_sveta.png";
          break;

          case 3:
            $url = "obr/ikona_odrazka_ze_sportu.png";
          break;
        }

        if (!Empty($url))
        {
          $obr = ""; // <img src=\"{$url}\" alt=\"{$title}\" />
        }
      }

      if (!$this->ExistenceUrl($zpravy["link"][$i]) ||
          $this->BlokSlova($reducetitle)) //pri neexistenci url nebo blokovanych slovech
      {
        $poc++;
      }

      $result .=  //{$title}
      "
        <p>
          <img src=\"{$url}\" alt=\"\" />
          <a href=\"#\" onclick=\"ZobrazitZpravu({$i}, {$typ}); return false;\"".($i == 0 ? " class=\" prvni_aktivni_odkaz\"" : "").">{$reducetitle}</a>
        </p>
      "; //{$obr}
    }

    if ($poc != 0 || $i != $pocet)  //kdyz je nejaka zprava v bloku neaktivni a nebo nesedi pocet zprav tak udela rucni reload
    {
      $this->SaveCacheZpravy($adresa, $pocet, $typ, true);  //prikaz na znovu nacachovani
    }

    return $result;
  }

/* pomocna parserovac funkce pro ziskavani programu
 *
 * name: ParserTvProgram
 * @param adresa
 * @return aktialni program
 */
  function ParserTvProgram($source)
  {
    $result = explode("</span>", $source);
    $result = explode("\">", $result[0]);
    $result = $result[6];

    return $result;
  }

/* funkce parserujci z uzl cas od-do
 *
 * name: ParserTvTime
 * @param zdroj, vraci: od, do
 * @return void
 */
  function ParserTvTime($source, &$od, &$do)
  {
    $a = explode("<div class=\"proc-text\">", $source);
    $od = explode("</div>", $a[1]);
    $od = $od[0];
    $do = explode("</div>", $a[2]);
    $do = $do[0];
  }

/* inicalizacn funkce pro ziskavan aktualniho TV programu
 *
 * name: TvAktualne
 * @param vrac: ct1, ct2, nova, prima
 * @return void
 */
  function TvAktualne(&$ct1, &$ct2, &$nova, &$prima)
  {
    $url = "http://www.seznam.cz/";
    $source = $this->OpenUrl($url);

    $a = explode("<div id=\"tv-cont\"> <table cellpadding=\"0\" cellspacing=\"0\"> <tr>", $source);
    $b = explode("</td> </tr> <tr>", $a[1]);

    $this->ParserTvTime($b[0], $od, $do);
    $ct1 = "<span class=\"nazev_programu\">ČT 1</span><span class=\"nazev_cas_programu\">{$od} - {$do}</span><span class=\"nazev_poradu\">{$this->ParserTvProgram($b[0])}</span>";

    $this->ParserTvTime($b[1], $od, $do);
    $ct2 = "<span class=\"nazev_programu\">ČT 2</span><span class=\"nazev_cas_programu\">{$od} - {$do}</span><span class=\"nazev_poradu\">{$this->ParserTvProgram($b[1])}</span>";

    $this->ParserTvTime($b[2], $od, $do);
    $nova = "<span class=\"nazev_programu\">Nova</span><span class=\"nazev_cas_programu\">{$od} - {$do}</span><span class=\"nazev_poradu\">{$this->ParserTvProgram($b[2])}</span>";

    $this->ParserTvTime($b[3], $od, $do);
    $prima = "<span class=\"nazev_programu\">Prima</span><span class=\"nazev_cas_programu\">{$od} - {$do}</span><span class=\"nazev_poradu\">{$this->ParserTvProgram($b[3])}</span>";
  }

/* funkce pro stazeni obsahu stranky z webu, pro dalsi zpracovani, nejdulezitejsi funkce
 *
 * name: OpenUrl
 * @param url stranky
 * @return url stanka
 */
  function OpenUrl($url)
  {
    /*
    blok:
    */
    //var_dump(fopen("http://www.novinky.cz", "r"));
//$url = "aktualne.centrum.cz";
    //var_dump(fsockopen(gethostbyname($url), 80, $errno, $errstr, 30));
    //var_dump("{$errno} {$errstr}");
/*
    $xml = new XMLReader();
    $xml->open($url);

    while($xml->read())
    {
      //var_dump($xml->nodeType);
      var_dump($xml->value);
      switch ($xml->nodeType)
      {
          case XMLReader::END_ELEMENT: return $tree;
          case XMLReader::ELEMENT:
              $node = array('tag' => $xml->name, 'value' => $xml->isEmptyElement ? '' : "");  //xml2assoc($xml)
              if($xml->hasAttributes)
                  while($xml->moveToNextAttribute())
                      $node['attributes'][$xml->name] = $xml->value;
              $tree[] = $node;
          break;
          case XMLReader::TEXT:
          case XMLReader::CDATA:
              $tree .= $xml->value;
      }
    }
*/
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
      $send = "GET {$page} HTTP/1.0\r\n";
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
      $this->var->main->ErrorMsg("připojení k portu 80, cislo: {$errno}, duvod: {$errstr}");
      $result = NULL;
    }

    return $result;
  }


/********************** < MENU > **********************/


/* vykresli menu adminu
 *
 * name: MenuAdmin
 * @param void
 * @return html menu
 */
  function MenuAdmin()
  {
    $index = array_keys($this->var->menu);
    $result = "";

    for ($i = 0; $i < count($this->var->menu); $i++)
    {
      $podm = ($_GET["akce"] == $index[$i]);
      $result .=
      "
<p class=\"{$index[$i]}\">
  <a href=\"?action={$_GET["action"]}&amp;akce={$index[$i]}\">
    <span>
      ".($podm ? "[" : "")."{$this->var->menu[$index[$i]]}".($podm ? "]" : "")."
    </span>
  </a>
</p>
      ";
    }

    return $result;
  }


/********************** < UZIVATELE > **********************/


/* vypis vsech uzivatelu
 *
 * name: VypisUzivatelu
 * @param void
 * @return vypis v html
 */
  function VypisAdmiUzivatele($str)
  {
    $strankovani = $this->Strankovani("uzivatel", $str, "vypisuser", "vypis_user", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          id,
                                          login,
                                          DATE_FORMAT(datum, '%H:%i:%s %d.%m.%y') as datum,
                                          DATE_FORMAT(upraveno, '%H:%i:%s %d.%m.%y') as upraveno,
                                          DATE_FORMAT(naposledy, '%H:%i:%s %d.%m.%y') as naposledy,
                                          autorizace,
                                          aktivni
                                          FROM uzivatel
                                          ORDER BY uzivatel.login ASC
                                          {$limit};"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;

        $result .=
        "{$strankovani}
<div class=\"polozka_uzivatel\">
  <p class=\"delka_login\">
    Login
  </p>
  <p class=\"delka_datumy\">
    Datum registrace
  </p>
  <p class=\"delka_datumy\">
    Datum upravení
  </p>
  <p class=\"delka_datumy\">
    Datum návštěvy
  </p>
  <p class=\"akce_uzivatele\">
    Ovládání
  </p>
</div>

        ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<div class=\"polozka_uzivatel".($i == ($res->num_rows - 1) ? " posledni_polozka_border" : "")."\">
  <p class=\"delka_login\">
    <a href=\"#\" onclick=\"PoslatAkci('infouser', {$data->id}, 'info_user');\">
      {$data->login}
    </a>
  </p>
  <p class=\"delka_datumy\">
    {$data->datum}
  </p>
  <p class=\"delka_datumy\">
    {$data->upraveno}
  </p>
  <p class=\"delka_datumy\">
    ".(!Empty($data->naposledy) ? "{$data->naposledy}" : "---")."
  </p>
  <p>
    <span class=\"uzivatel_aktivita_{$data->aktivni}\">
      <span>
        ".($data->aktivni ? "Uživatel je aktivní" : "Uživatel není aktivní")."
      </span>
    </span>
  </p>
  <p>
    <a href=\"#\" onclick=\"PoslatAkci('edituser', {$data->id}, 'info_user');\" class=\"upravit_uzivatele_odkaz\">
      <span>
        Upravit uživatele
      </span>
    </a>
  </p>
  <p>
    <a href=\"#\" onclick=\"PoslatAkci('deluser', {$data->id}, 'info_user');\" class=\"smazat_uzivatele_odkaz\">
      <span>
        Smazat uživatele
      </span>
    </a>
  </p>
  <p>
    ".($data->autorizace ? "
    <span class=\"uzivatel_autorizovan\">
      <span>
        Uživatel je autorizován
      </span>
    </span>
    " : "
    <a href=\"#\" onclick=\"PoslatAkci('sendauthuser', {$data->id}, 'info_user');\" class=\"uzivatel_neautorizovan\">
      <span>
        Tento uživatel není autorizován. Klapnutím na ikonu vykřičníku pošlete uživateli autorizační zprávu.
      </span>
    </a>
    ")."
  </p>
</div>
          ";  //{$data->heslo} {$data->jmeno} {$data->prijmeni} {$data->ulice} {$data->cp} {$data->psc} {$data->mesto} {$data->telefon} {$data->email}
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypise seznam uzivatelu
 *
 * name: VypisAdminLide
 * @param void
 * @return strohy vypis lidi
 */
  function VypisAdminLide($str)
  {
    $strankovani = $this->Strankovani("uzivatel", $str, "vypislide", "vypis_lide", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          id,
                                          login,
                                          email,
                                          jmeno,
                                          prijmeni,
                                          telefon,
                                          ulice,
                                          cp,
                                          psc,
                                          mesto
                                          FROM uzivatel
                                          ORDER BY uzivatel.prijmeni ASC,
                                          uzivatel.jmeno ASC,
                                          uzivatel.id ASC
                                          {$limit};"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;

        $result .=
        "{$strankovani}
<p class=\"odstavec_hodnoty_pocitadla odstavec_hodnoty_pocitadla_zahlavi\">
  <span class=\"hodnota_pocitadla_central login_pocitadla\">Příjmení</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">Jméno</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">Login</span>
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">E-mail</span>
  <span class=\"hodnota_pocitadla_central operacni_system_pocitadla\">Město</span>
  <span class=\"hodnota_pocitadla_central prohlizec_pocitadla\">Ulice</span>
  <span class=\"hodnota_pocitadla_central ip_adresa_pocitadla\">ČP</span>
  <span class=\"hodnota_pocitadla_central ip_adresa_pocitadla\">PSČ</span>
  <span class=\"hodnota_pocitadla_central rozliseni_pocitadla\">Telefon</span>
</p>
        ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->prijmeni}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->jmeno}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->login}</span>
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">{$data->email}</span>
  <span class=\"hodnota_pocitadla_central operacni_system_pocitadla\">{$data->mesto}</span>
  <span class=\"hodnota_pocitadla_central prohlizec_pocitadla\">{$data->ulice}</span>
  <span class=\"hodnota_pocitadla_central ip_adresa_pocitadla\">{$data->cp}</span>
  <span class=\"hodnota_pocitadla_central ip_adresa_pocitadla\">{$data->psc}</span>
  <span class=\"hodnota_pocitadla_central rozliseni_pocitadla\">".(!Empty($data->telefon) ? "{$data->telefon}" : "---")."</span>
</p>
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypisuje blizsi informace o uzivateli
 *
 * name: InfoUser
 * @param id uzivatele
 * @return pres ajax vyps v html
 */
  function InfoAdminUser($id)
  {
    settype($id, "integer");
    $kip = $_SERVER["REMOTE_ADDR"];

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT
                                            id,
                                            login,
                                            heslo,
                                            jmeno,
                                            prijmeni,
                                            ulice,
                                            cp,
                                            psc,
                                            mesto,
                                            telefon,
                                            email,
                                            DATE_FORMAT(datum, '%H:%i:%s %d.%m.%y') as datum,
                                            DATE_FORMAT(upraveno, '%H:%i:%s %d.%m.%y') as upraveno,
                                            DATE_FORMAT(naposledy, '%H:%i:%s %d.%m.%y') as naposledy,
                                            autorizace,
                                            aktivni,
                                            ip,
                                            agent,
                                            session,
                                            rozliseni,
                                            hloubka
                                            FROM uzivatel WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->ipblok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);

          $result =
          "
<div id=\"uzivatele_informace\">
  <dl>
    <dt>ID uživatele:</dt>
    <dd>{$data->id}</dd>
  </dl>
  <dl>
    <dt>Login:</dt>
    <dd>{$data->login}</dd>
  </dl>
  <dl>
    <dt>Heslo:</dt>
    <dd title=\"{$data->heslo}\">****</dd>
  </dl>
  <dl>
    <dt>Jméno:</dt>
    <dd>{$data->jmeno}</dd>
  </dl>
  <dl>
    <dt>Příjmení:</dt>
    <dd>{$data->prijmeni}</dd>
  </dl>
  <dl>
    <dt>Ulice:</dt>
    <dd>{$data->ulice}</dd>
  </dl>
  <dl>
    <dt>Číslo popisné:</dt>
    <dd>{$data->cp}</dd>
  </dl>
  <dl>
    <dt>Poštovní směrovací číslo:</dt>
    <dd>{$data->psc}</dd>
  </dl>
  <dl>
    <dt>Bydliště:</dt>
    <dd>{$data->mesto}</dd>
  </dl>
  <dl>
    <dt>Telefon:</dt>
    <dd>{$data->telefon}</dd>
  </dl>
  <dl>
    <dt>E-mail:</dt>
    <dd>{$data->email}</dd>
  </dl>
  <dl>
    <dt>Datum zaregistrování:</dt>
    <dd>{$data->datum}</dd>
  </dl>
  <dl>
    <dt>Datum posledního upravení účtu:</dt>
    <dd>{$data->upraveno}</dd>
  </dl>
  <dl>
    <dt>Datum poslední aktivity:</dt>
    <dd>{$data->naposledy}</dd>
  </dl>
  <dl>
    <dt>Operační systém:</dt>
    <dd>{$os}</dd>
  </dl>
  <dl>
    <dt>Prohlížeč:</dt>
    <dd>{$browser}</dd>
  </dl>
  <dl>
    <dt>IP adresa:</dt>
    <dd>{$ip}</dd>
  </dl>
  <dl>
    <dt>Název hostitele:</dt>
    <dd>{$host}</dd>
  </dl>
  <dl>
    <dt>Rozlišení:</dt>
    <dd>{$data->rozliseni} x {$data->hloubka}</dd>
  </dl>
  <dl>
    <dt>Země původu:</dt>
    <dd><a href=\"#\" onclick=\"PoslatAkci('zjistizemi', {$ipnum}, 'info_zeme');\">zjistit</a></dd>
  </dl>
  <dl>
    <dt>Stav autorizace:</dt>
    <dd><input disabled=\"disabled\" type=\"checkbox\"".($data->autorizace ? " checked=\"checked\"" : "")." /></dd>
  </dl>
  <dl>
    <dt>Aktivnost účtu:</dt>
    <dd><input disabled=\"disabled\" type=\"checkbox\"".($data->aktivni ? " checked=\"checked\"" : "")." /></dd>
  </dl>
  <div id=\"info_zeme\"></div>
  <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_user');\" id=\"odkaz_zavrit_uzivatele\"></a>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* editace uzivatele
 *
 * name: EditUser
 * @param id uzivatele
 * @return formular v html
 */
  function EditAdminUser($id, $edit = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, login, heslo, jmeno, prijmeni, ulice, cp, psc, mesto, telefon, email, DATE_FORMAT(datum, '%H:%i:%s %d.%m.%y') as datum, DATE_FORMAT(upraveno, '%H:%i:%s %d.%m.%y') as upraveno, autorizace, aktivni FROM uzivatel WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"uzivatele_informace\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"user_login\">Login:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_login\" value=\"{$data->login}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_heslo\">Heslo:</label>
        </dt>
        <dd>
          <input type=\"password\" id=\"user_heslo\" value=\"{$data->heslo}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_jmeno\">Jméno:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_jmeno\" value=\"{$data->jmeno}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_prijmeni\">Příjmení:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_prijmeni\" value=\"{$data->prijmeni}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_ulice\">Ulice:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_ulice\" value=\"{$data->ulice}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_cp\">Číslo popisné:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_cp\" value=\"{$data->cp}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_psc\">Poštovní směrovací číslo:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_psc\" value=\"{$data->psc}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_mesto\">Bydliště:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_mesto\" value=\"{$data->mesto}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_telefon\">Telefon:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_telefon\" value=\"{$data->telefon}\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_email\">E-mail:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"user_email\" value=\"{$data->email}\" />
        </dd>
      </dl>
      <dl>
        <dt>Datum zaregistrování:</dt>
        <dd>{$data->datum}</dd>
      </dl>
      <dl>
        <dt>Datum posledního upravení účtu:</dt>
        <dd>{$data->upraveno}</dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_autorizace\">Stav autorizace:</label>
        </dt>
        <dd>
          <input id=\"user_autorizace\" type=\"checkbox\"".($data->autorizace ? " checked=\"checked\"" : "")." />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"user_aktivni\">Aktivnost účtu:</label>
        </dt>
        <dd>
          <input id=\"user_aktivni\" type=\"checkbox\"".($data->aktivni ? " checked=\"checked\"" : "")." />
        </dd>
      </dl>
      <input type=\"button\" value=\"Upravit uživatele\" onclick=\"
      loginid='user_login';
      hesloid='user_heslo';
      jmenoid='user_jmeno';
      prijmid='user_prijmeni';
      uliceid='user_ulice';
      cpid='user_cp';
      pscid='user_psc';
      mestoid='user_mesto';
      telefid='user_telefon';
      emailid='user_email';
      authoid='user_autorizace';
      aktivid='user_aktivni';
      PoslatAkci('yesedituser&amp;login='+document.getElementById(loginid).value+
      '&amp;heslo='+document.getElementById(hesloid).value+
      '&amp;jmeno='+document.getElementById(jmenoid).value+
      '&amp;prijmeni='+document.getElementById(prijmid).value+
      '&amp;ulice='+document.getElementById(uliceid).value+
      '&amp;cp='+document.getElementById(cpid).value+
      '&amp;psc='+document.getElementById(pscid).value+
      '&amp;mesto='+document.getElementById(mestoid).value+
      '&amp;telefon='+document.getElementById(telefid).value+
      '&amp;email='+document.getElementById(emailid).value+
      '&amp;autorizace='+document.getElementById(authoid).checked+
      '&amp;aktivni='+document.getElementById(aktivid).checked
      , {$data->id}, 'info_user'); return false;\" id=\"tlacitko_potvrdit\" />
    </fieldset>
  </form>
  <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_user');\" id=\"odkaz_zavrit_uzivatele\"></a>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)  //je-li editovano
    {
      $login = stripslashes(htmlspecialchars($_POST["login"]));
      $heslo = stripslashes(htmlspecialchars($_POST["heslo"]));
      $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
      $prijmeni = stripslashes(htmlspecialchars($_POST["prijmeni"]));
      $ulice = stripslashes(htmlspecialchars($_POST["ulice"]));
      $cp = stripslashes(htmlspecialchars($_POST["cp"]));
      $psc = stripslashes(htmlspecialchars($_POST["psc"]));
      $mesto = stripslashes(htmlspecialchars($_POST["mesto"]));
      $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
      $email = stripslashes(htmlspecialchars($_POST["email"]));
      $autorizace = $_POST["autorizace"];
      $aktivni = $_POST["aktivni"];

      if (@$this->var->mysqli->multi_query("UPDATE uzivatel SET login='{$login}',
                                                                heslo='{$heslo}',
                                                                jmeno='{$jmeno}',
                                                                prijmeni='{$prijmeni}',
                                                                ulice='{$ulice}',
                                                                cp='{$cp}',
                                                                psc='{$psc}',
                                                                mesto='{$mesto}',
                                                                telefon='{$telefon}',
                                                                email='{$email}',
                                                                upraveno=NOW(),
                                                                autorizace={$autorizace},
                                                                aktivni={$aktivni}
                                                                WHERE id={$id};"))
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl upraven uživatel s loginem: <strong>{$login}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* smazani uzivatele
 *
 * name: DelUser
 * @param id uzivatele
 * @return formular v html
 */
  function DelAdminUser($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, login, jmeno, prijmeni FROM uzivatel WHERE id={$id};"))
      {     //heslo,, ulice, cp, psc, mesto, telefon, email, DATE_FORMAT(datum, '%H:%i:%s %d.%m.%y') as datum, DATE_FORMAT(upraveno, '%H:%i:%s %d.%m.%y') as upraveno, autorizace, aktivni
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat uživatele s loginem: <strong>{$data->login}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdeluser', {$data->id}, 'info_user'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_user'); return false;\" id=\"tlacitko_ne\" />
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_user');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($smazat)  //je-li smazano
      {
        if (@$this->var->mysqli->multi_query("DELETE FROM uzivatel WHERE id={$id};"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl smazán uživatel s loginem: <strong>{$data->login}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }

/* funkce pro znovu zaslani autorizacniho emailu
 *
 * name: ZnovuPoslaniAutorzace
 * @param id uzivatele
 * @return navratova inforamace
 */
  function ZnovuPoslaniAutorzace($id, $poslat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, login, heslo, jmeno, prijmeni, ulice, cp, psc, mesto, telefon, email, DATE_FORMAT(datum, '%H:%i:%s %d.%m.%y') as datum, DATE_FORMAT(upraveno, '%H:%i:%s %d.%m.%y') as upraveno, autorizace, aktivni FROM uzivatel WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete poslat autorizační zprávu uživateli s loginem: <strong>{$data->login}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yessendauthuser', {$data->id}, 'info_user'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('infouser', 0, 'info_user'); return false;\" id=\"tlacitko_ne\" />
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_user');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($poslat)
      {
        $this->PoslatAutorizacniEmail($data->email, $data->id, $data->login, $data->heslo, $data->jmeno, $data->prijmeni);
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Uživateli s loginem: <strong>{$data->login}</strong> byla odesláná zpráva s autorizací
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }


/********************** < BUBNY > **********************/


/* vypise bubny
 *
 * name: VypisBuben
 * @param void
 * @return vypis obrazku bubnu
 */
  function VypisAdminBuben()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id FROM vyhry ORDER BY vyhry.id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "
<ul>
  <li class=\"id_bubnu neborder_vpravo\"></li>
  <li class=\"nahoru_obrazek_bubnu neborder_vpravo\"></li>
  <li class=\"dolu_obrazek_bubnu\"></li>
  <li class=\"obrazek_bubnu\">
    <img src=\"{$this->var->bubpic}/0.jpg\" alt=\"buben 0\" />
  </li>
  <li class=\"upravit_obrazek\"></li>
</ul>
        ";

        while ($data = $res->fetch_object())
        {
          $id = $data->id;
          $plus = $id - 1;
          $minus = $id + 1;

          if ($id != $res->num_rows)
          {
            $result .=
            "
<ul".($id == ($res->num_rows - 1) ? " class=\"neborder_spodek\"" : "").">
  <li class=\"id_bubnu\">
    ID: {$id}
  </li>
  <li class=\"nahoru_obrazek_bubnu\">
    ".($id != 1 ? "<a href=\"#\" onclick=\"PoslatAkci('poradibuben&amp;posunna={$plus}', {$id}, 'info_buben');\" title=\"Posunout obrázek o jednu úroveň nahoru\" class=\"posunout_nahoru\"></a>" : "<span class=\"posunout_nahoru_neaktivni\"></span>")."
  </li>
  <li class=\"dolu_obrazek_bubnu\">
    ".($id != ($res->num_rows - 1) ? "<a href=\"#\" onclick=\"PoslatAkci('poradibuben&amp;posunna={$minus}', {$id}, 'info_buben');\" title=\"Posunout obrázek o jednu úroveň dolů\" class=\"posunout_dolu\"></a>" : "<span class=\"posunout_dolu_neaktivni\"></span>")."
  </li>
  <li class=\"obrazek_bubnu\">
    <img src=\"{$this->var->bubpic}/{$id}.jpg\" alt=\"buben {$id}\" />
  </li>
  <li class=\"upravit_obrazek\">
    <a href=\"ajax.php?action=admin&amp;akce=bubny&amp;co=editbuben&amp;id={$id}\" title=\"Upravit obrázek\">
      <span></span>
      Upravit obrázek
    </a>
  </li>
</ul>
            ";
          }

        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* formular pro reupload obrazku
 *
 * name: EditBuben
 * @param void
 * @return forma pro reupload
 */
  function EditAdminObrazekBuben()
  {
    $id = $_GET["id"];
    settype($id, "integer");

    if (!Empty($id) &&
        $id != 0 &&
        $_GET["co"] == "editbuben")
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
    <fieldset>
      <label for=\"input_file_reupload\" id=\"cislo_obrazku_label\">Obrázek číslo: <em>{$id}</em></label>
      <img src=\"{$this->var->bubpic}/{$id}.jpg\" alt=\"{$id}.jpg\" id=\"obrazek_reupload\" />
      <input type=\"file\" name=\"soubor\" id=\"input_file_reupload\" />
      <input type=\"submit\" name=\"tlacitko\" value=\"Nahrát nový obrázek\" id=\"tlacitko_upravit_obrazek\" />
      <a href=\"ajax.php?action=admin&amp;akce=bubny\" title=\"Zavřít okno\"></a>
    </fieldset>
  </form>
</div>
      ";

      $max_w = 78;
      $max_h = 40;

      if (!Empty($_POST["tlacitko"]))
      {
        if (!Empty($_FILES["soubor"]["tmp_name"]))
        {
          if ($_FILES["soubor"]["type"] == "image/jpeg")  //jen jpg
          {
            if (file_exists("{$this->var->bubpic}/{$id}.jpg")) //smaze stary
            {
              unlink("{$this->var->bubpic}/{$id}.jpg");
            }
              else
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba: <strong>Obrázek neexistuje</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
              $this->AutoClick(5, "ajax.php?action=admin&akce=bubny");
            }

            if (is_uploaded_file($_FILES["soubor"]["tmp_name"]))
            {
              $temp_pic = $_FILES["soubor"]["tmp_name"];
              list($old_w, $old_h) = getimagesize($temp_pic);
              $img_new = imagecreatetruecolor($max_w, $max_h);
              $img_old = imagecreatefromjpeg($temp_pic);
              imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $max_w, $max_h, $old_w, $old_h);
              imagejpeg($img_new, "{$this->var->bubpic}/{$id}.jpg", 100);

              chmod("{$this->var->bubpic}/{$id}.jpg", 0777);  //zmena atributu

              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Obrázek číslo: <strong>{$id}</strong> byl úspěšně nahrán
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
              //<input type=\"button\" value=\"refresh\" onclick=\"location.reload(false);\">

              $this->AutoClick(3, "ajax.php?action=admin&akce=bubny");
            }
              else
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nahrátí obrázku se nezdařilo. Počet chyb je: <strong>{$_FILES["soubor"]["error"]}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
              $this->AutoClick(5, "ajax.php?action=admin&akce=bubny");
            }

          }
            else
          {
            $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nahrátí obrázku se nezdařilo. Obrázek má nesprávný formát. Povolený formát je: <strong>JPG</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
            ";
            $this->AutoClick(5, "ajax.php?action=admin&akce=bubny");
          }

        }
          else
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nahrátí obrázku se nezdařilo.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
          $this->AutoClick(5, "ajax.php?action=admin&akce=bubny");
        }
      }
    }

    return $result;
  }

/* prohozeni obrazku
 *
 * name: PoradiAminBuben
 * @param textove data na prohozeni
 * @return info o prohozeni
 */
  function PoradiAminBuben($id, $newid)
  {
    if ($id != 0)
    {
      $source = "{$id}.jpg"; //z
      $destin = "{$newid}.jpg"; //do
      $pom = "pom_{$source}"; //pomocna

      rename("{$this->var->bubpic}/{$source}", "{$this->var->bubpic}/{$pom}");  //zdroj za pomocnou
      rename("{$this->var->bubpic}/{$destin}", "{$this->var->bubpic}/{$source}"); //cil za zdroj
      rename("{$this->var->bubpic}/{$pom}", "{$this->var->bubpic}/{$destin}");  //pomocna za cil

      //$result = "z: {$source} do: {$destin} <input type=\"button\" value=\"refresh\" onclick=\"location.reload(true);\">";
    }

    return $result;
  }

/* Vykreslovani flashu bubnu
 *
 * name: Buben
 * @param adresa webu, demo/full
 * @return html flashu
 */
  function Buben($typ)  //vykresli dany buben
  {
    $pocet = $this->PocetBubnu();

    $demo =
    "
                    <!--[if !IE]> -->
                      <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/demo_flash.swf\" width=\"262\" height=\"145\">
                    <!-- <![endif]-->
                    <!--[if IE]>
                      <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"262\" height=\"145\">
                        <param name=\"movie\" value=\"{$this->var->web}/flash/demo_flash.swf\" />
                    <!--><!---->
                        <param name=\"loop\" value=\"true\" />
                        <param name=\"menu\" value=\"false\" />
                        <param name=\"bgcolor\" value=\"#2e2e2e\" />
                        <param name=\"FlashVars\" value=\"pocet={$pocet}\" />
                        <param name=\"wmode\" value=\"transparent\" />
                        <p class=\"no_flash\"></p>
                      </object>
                    <!-- <![endif]-->
    ";

    $toceno =
    "
                    <!--[if !IE]> -->
                      <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/flash_nolimit.swf\" width=\"262\" height=\"145\">
                    <!-- <![endif]-->
                    <!--[if IE]>
                      <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"262\" height=\"145\">
                        <param name=\"movie\" value=\"{$this->var->web}/flash/flash_nolimit.swf\" />
                    <!--><!---->
                        <param name=\"loop\" value=\"true\" />
                        <param name=\"menu\" value=\"false\" />
                        <param name=\"bgcolor\" value=\"#2e2e2e\" />
                        <param name=\"FlashVars\" value=\"pocet={$pocet}\" />
                        <param name=\"wmode\" value=\"transparent\" />
                        <p class=\"no_flash\"></p>
                      </object>
                    <!-- <![endif]-->
                  <div id=\"id_nolimit\"></div>
    ";

    switch ($typ) //prepnuti dle typu
    {
      case "demo":
        $result = $demo;
      break;

      case "orig":
        if (!Empty($_SESSION["SLOGIN"]) &&
            $_SESSION["SACTIVE"] &&
            $_SESSION["IDUSER"] != 0)
        {
          $toceni = $this->PocetToceni($_SESSION["IDUSER"]);

/*
  for ($i = 0; $i < 5000; $i++)  //zatezovy test
  {
    $this->VolbaKombilaceBubnu($otocek1, $otocek2, $otocek3, $polozka1, $polozka2, $polozka3);
  }
*/

          if ($toceni == 0) //je jednou za den
          {
            $this->VolbaKombilaceBubnu($otocek1, $otocek2, $otocek3, $polozka1, $polozka2, $polozka3);

            $full =
            "
                      <div>
                        <!--[if !IE]> -->
                          <object type=\"application/x-shockwave-flash\" data=\"{$this->var->web}/flash/automat_flash.swf\" width=\"407\" height=\"146\">
                        <!-- <![endif]-->
                        <!--[if IE]>
                          <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"407\" height=\"146\">
                            <param name=\"movie\" value=\"{$this->var->web}/flash/automat_flash.swf\" />
                        <!--><!---->
                            <param name=\"loop\" value=\"true\" />
                            <param name=\"menu\" value=\"false\" />
                            <param name=\"bgcolor\" value=\"#2e2e2e\" />
                            <param name=\"FlashVars\" value=\"a1={$otocek1}&a2={$otocek2}&a3={$otocek3}&z1={$polozka1}&z2={$polozka2}&z3={$polozka3}&jmeno={$_SESSION["SLOGIN"]}&pocet={$pocet}\" />
                            <param name=\"wmode\" value=\"transparent\" />
                            <p class=\"no_flash\"></p>
                          </object>
                        <!-- <![endif]-->
                      </div>
            ";

            $result = $full;
          }
            else
          {
            $result = $toceno;
          }
        }
          else
        {
          $result = $demo;
        }
      break;
    }

    return $result;
  }

/* vrati herni kombinaci pro hru
 *
 * name: VolbaKombilaceBubnu
 * @param
 * @return
 */
  function VolbaKombilaceBubnu(&$otocek1, &$otocek2, &$otocek3, &$polozka1, &$polozka2, &$polozka3)
  {
    if ($res = @$this->var->mysqli->query("SELECT id, aktivni FROM vyhry ORDER BY vyhry.id"))
    {
      $pocet = 0;
      if ($res->num_rows != 0)
      {
        $idvyhra = 0;
        $i = 0;
        $vyh[] = 0;
        while ($data = $res->fetch_object())
        {
          if ($data->aktivni)
          {
            $vyh[$i] = $data->id; //od 1, naplni pole
            $i++;
          }
        }
        $idvyhra = $vyh[array_rand($vyh)];  //nahodne vybrani jedne vyhry
        $pocet = $res->num_rows - 1;  //0 se nepocita!!
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $min_ot = $this->CtiNastaveni("min_ot");
    settype($min_ot, "integer");
    $max_ot = $this->CtiNastaveni("max_ot");
    settype($max_ot, "integer");

    //volba otocek
    for ($i = 0; $i < 3; $i++)
    {
      $poleot[$i] = rand($min_ot, $max_ot);
    }

    sort($poleot);

    if ($poleot[1] == $poleot[2]) //aby byl posledni opravdu nejvetsi
    {
      $poleot[2] += 1;
    }

    if ($poleot[0] < $poleot[1] &&
        $poleot[1] < $poleot[2] &&
        $poleot[0] < $poleot[2])
    {
      $otocek1 = $poleot[0];
      $otocek2 = $poleot[1];
      $otocek3 = $poleot[2];
    }
      else
    {
      $otocek1 = 2;
      $otocek2 = 3;
      $otocek3 = 4;
    }

    //volba polozek
    $min_h = 0;
    $max_h = $pocet - 1;

    $den = date("j");
    settype($den, "integer"); //prevod na cislo
    if ($den > 20 && !Empty($idvyhra)) //po 20 se zmensi rozsah a musi byt vybrana vyhra, opraveno
    {
      if ((($idvyhra - 1) + 2) > ($pocet - 1))  //je-li vetsi
      {
        $min_h = ($idvyhra - 1) - 2;  //zmenseni minima
      }
        else
      {
        $max_h = ($idvyhra - 1) + 2;  //zmenseni maxima
      }
    }

    $pocettoceni = $this->PocetToceni($_SESSION["IDUSER"]); //pocet prihlaseni za den
    $poslvyherce = $this->PosledniVyherce();  //id posledniho uzivatele co vyhral

    //echo $pocettoceni;
    //$poslvyherce = 0; //testovani
    //$pocettoceni = 0; //testovani

    $pom1 = rand($min_h, $max_h);
    $pom2 = rand($min_h, $max_h);
    $pom3 = rand($min_h, $max_h);

    $vysledek = false;
    if ($pom1 == $pom2 &&
        $pom2 == $pom3)
    {
      if ($pom1 == ($idvyhra - 1) &&  //kdyz se trefi aktivni vyhra, je 0 otocek za den, neni-li to posledni vyherce co minule vyhral
          $pocettoceni == 0 &&
          $poslvyherce != $_SESSION["IDUSER"])  //kdyz je nejaka vyhra aktivni
      {
        $vysledek = true; //kdyz vyhraje -> zrusi aktivitu vyhry a prida vyherce s jeho cenou
        settype($idvyhra, "integer");

        $_SESSION["G_POM1"] = $pom1;
        $_SESSION["G_POM2"] = $pom2;
        $_SESSION["G_POM3"] = $pom3;
        $_SESSION["G_VYS"] = $vysledek; //vyhra
        $_SESSION["G_VYH"] = $idvyhra;  //cena

//skusit nejak dat taky bokem do funkce... moznosti vice vyher zaroven se (teoreticky zvyhla pravdepodobnost, praticky se snizila!)
/*
        if (!@$this->var->mysqli->multi_query("UPDATE vyhry SET aktivni=false
                                                                WHERE id={$idvyhra};"))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }

        if (!@$this->var->mysqli->multi_query("INSERT INTO vyherci (id, uzivatel, poloha, datum, cena) VALUES
                                              (NULL, {$_SESSION["IDUSER"]}, {$pom1}, NOW(), {$idvyhra});
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
*/
        return 0;
      }
        else
      {
        $vysledek = false;
        $pom1 += 1;
        $pom2 += 2;
        $pom3 += 3;

        $polozka1 = $pom1;
        $polozka2 = $pom2;
        $polozka3 = $pom3;
      }
    }
      else
    {
      $polozka1 = $pom1;
      $polozka2 = $pom2;
      $polozka3 = $pom3;
    }

    settype($vysledek, "integer");  //konverze vysledku
    settype($idvyhra, "integer"); //konverze id vyhry bool->int

    $_SESSION["G_POM1"] = $pom1;
    $_SESSION["G_POM2"] = $pom2;
    $_SESSION["G_POM3"] = $pom3;
    $_SESSION["G_VYS"] = $vysledek; //vyhra
    $_SESSION["G_VYH"] = $idvyhra;  //cena
    /*
    if (!@$this->var->mysqli->multi_query("INSERT INTO losovani (id, uzivatel, datum, buben1, buben2, buben3, vyhra, cena) VALUES
                                          (NULL, {$_SESSION["IDUSER"]}, NOW(), {$pom1}, {$pom2}, {$pom3}, {$vysledek}, {$idvyhra});
                                         "))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }
    */
  }

/* zaloguje hodnoty po zmacknuti tlacitka klik
 *
 * name: LogovaniVytocenychDat
 * @param void
 * @return void
 */
  function LogovaniVytocenychDat()
  {
    switch ($_SESSION["G_VYS"]) //rozdeleni podle vyhry
    {
      case true:  //zalogovani vyhry + zalogovani losovani
        if (!@$this->var->mysqli->multi_query("UPDATE vyhry SET aktivni=false
                                                                WHERE id={$_SESSION["G_VYH"]};"))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }

        //vytahne z databaze popis ceny
        if ($res = @$this->var->mysqli->query("SELECT
                                              popis
                                              FROM vyhry
                                              WHERE
                                              id={$_SESSION["G_VYH"]};
                                              "))
        {
          if ($res->num_rows == 1)
          {
            $popis = $res->fetch_object()->popis;
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }

        //zalogovani vyherce
        if (!@$this->var->mysqli->multi_query("INSERT INTO vyherci (id, uzivatel, poloha, datum, popis) VALUES
                                              (NULL, {$_SESSION["IDUSER"]},
                                              {$_SESSION["G_POM1"]},
                                              NOW(),
                                              '{$popis}');
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }

        //zalogovani losovani
        if (!@$this->var->mysqli->multi_query("INSERT INTO losovani (id, uzivatel, datum, buben1, buben2, buben3, vyhra, cena) VALUES
                                              (NULL, {$_SESSION["IDUSER"]}, NOW(),
                                              {$_SESSION["G_POM1"]},
                                              {$_SESSION["G_POM2"]},
                                              {$_SESSION["G_POM3"]},
                                              {$_SESSION["G_VYS"]},
                                              {$_SESSION["G_VYH"]});
                                             "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      break;

      case false: //obycejne zalogovani
        if (!@$this->var->mysqli->multi_query("INSERT INTO losovani (id, uzivatel, datum, buben1, buben2, buben3, vyhra, cena) VALUES
                                              (NULL, {$_SESSION["IDUSER"]}, NOW(),
                                              {$_SESSION["G_POM1"]},
                                              {$_SESSION["G_POM2"]},
                                              {$_SESSION["G_POM3"]},
                                              {$_SESSION["G_VYS"]},
                                              {$_SESSION["G_VYH"]});
                                             "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      break;
    }
  }

/* vrati pocet bubnu
 *
 * name: PocetBubnu
 * @param void
 * @return pocet bubnu-1
 */
  function PocetBubnu()
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM vyhry"))
    {
      if ($res->num_rows != 0)
      {
        $result = $res->num_rows - 1;  //0 se nepocita!!
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vrati cislo zatoceni za den
 *
 * name: PocetToceni
 * @param id uzivatele
 * @return pocet doceni za den
 */
  function PocetToceni($id)
  {
    $result = 0;
    if ($res = @$this->var->mysqli->query("SELECT count(id) as pocet
                                          FROM losovani
                                          WHERE uzivatel={$id} AND
                                          DAY(NOW())=DAY(datum) AND
                                          MONTH(NOW())=MONTH(datum) AND
                                          YEAR(NOW())=YEAR(datum);"))
    {
      if ($res->num_rows != 0)
      {
        $result = $res->fetch_object()->pocet;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* navraceni id posledniho vyherce
 *
 * name: PosledniVyherce
 * @param void
 * @return vrati id posledniho vyherce
 */
  function PosledniVyherce()
  {
    $result = 0;
    if ($res = @$this->var->mysqli->query("SELECT uzivatel
                                          FROM losovani
                                          WHERE vyhra=true
                                          ORDER BY losovani.datum DESC
                                          LIMIT 0, 1;"))
    {
      if ($res->num_rows != 0)
      {
        $result = $res->fetch_object()->uzivatel;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypise informaci po vytoceni
 *
 * name: VypisVyhodnoceni
 * @param void
 * @return vysledek v html
 */
  function VypisVyhodnoceni(&$styl)
  {
    $id = $_SESSION["IDUSER"];
    if ($res = @$this->var->mysqli->query("SELECT
                                          DATE_FORMAT(losovani.datum, '%d.%m.%y %H:%i:%s') as datum,
                                          losovani.buben1 as buben1,
                                          losovani.buben2 as buben2,
                                          losovani.buben3 as buben3
                                          FROM losovani
                                          WHERE uzivatel={$id} AND
                                          DAY(NOW())=DAY(datum) AND
                                          MONTH(NOW())=MONTH(datum) AND
                                          YEAR(NOW())=YEAR(datum)
                                          ORDER BY losovani.datum DESC,
                                          losovani.id DESC
                                          LIMIT 0, 1;"))
    {
      if ($res->num_rows != 0)
      {
        $data = $res->fetch_object();
        $styl = ($data->vyhra ? " obrazek_vyhral_jste" : " obrazek_nevyhral_jste" );
        $result = ($data->vyhra ? "Gratulujeme!!! Vyhrál jste!!! Vaše výhra Vám bude doručena. Team Superklik" : $this->var->textneuspechu[array_rand($this->var->textneuspechu)]);
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypis vyhercu v html
 *
 * name: VypisVyhercu
 * @param void
 * @return vypis v html
 */
  function VypisVyhercu()
  {
    $poc = 1;
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          uzivatel.jmeno as jmeno,
                                          uzivatel.prijmeni as prijmeni,
                                          uzivatel.mesto as mesto,
                                          vyherci.datum
                                          FROM vyherci, uzivatel
                                          WHERE vyherci.uzivatel=uzivatel.id
                                          ORDER BY vyherci.datum DESC
                                          LIMIT 0, 5;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
                    <p>
                      <span class=\"obrazek_darek_0{$poc}\"></span>
                      {$data->jmeno} {$data->prijmeni} - {$data->mesto}
                    </p>
          ";
          $poc++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    //falesne data
    $pole = array("Jiří Procházka - Prostějov",
                  "Jana Nováková - Liberec",
                  "František Veleba - Brno",
                  "Pavel Liška - Karviná",
                  "Martin Gajdoš - Hodonín");

    if ($res->num_rows < 5)
    {
      for ($i = 0; $i < (5 - $res->num_rows); $i++)
      {
        $result .=
        "
          <p>
            <span class=\"obrazek_darek_0{$poc}\"></span>
            {$pole[$i]}
          </p>
        ";
        $poc++;
      }
    }
    //falesne data

    return $result;
  }

/* vypise zaznam losovani
 *
 * name: VypisAdminLosovani
 * @param void
 * @return vypis v html
 */
  function VypisAdminLosovani($str)
  {
    $strankovani = $this->Strankovani("losovani", $str, "vypislos", "vypis_los", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT losovani.id as id,
                                          uzivatel.jmeno as jmeno,
                                          uzivatel.prijmeni as prijmeni,
                                          uzivatel.login as login,
                                          DATE_FORMAT(losovani.datum, '%d.%m.%y %H:%i:%s') as datum,
                                          losovani.datum as datumexp,
                                          losovani.buben1 as buben1,
                                          losovani.buben2 as buben2,
                                          losovani.buben3 as buben3,
                                          losovani.vyhra as vyhra,
                                          losovani.cena as cena
                                          FROM losovani, uzivatel
                                          WHERE
                                          losovani.uzivatel=uzivatel.id
                                          ORDER BY losovani.datum DESC,
                                          losovani.id DESC
                                          {$limit}"))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "{$strankovani}";
        while ($data = $res->fetch_object())
        {
          $popis = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $this->VypisCislaVyhry($data->cena));
          $popis = substr($popis, 0, 50);
          $popis = iconv("UTF-8", "UTF-8", $popis); //uhlazeni diakritiky

          $dat = strtotime($data->datumexp);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) + $this->var->expiracelos, date("Y", $dat)));  //expirace
          $expcas = date("d.m.Y H:i:s", strtotime($datum));

          $result .=
          "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central pocet_pristupu_pocitadla\">{$data->id}.</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->jmeno}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->prijmeni}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->login}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$data->datum}</span>
  <span class=\"hodnota_pocitadla_central zeme_puvodu_pocitadla\">{$data->buben1}-{$data->buben2}-{$data->buben3}</span>
  <span class=\"hodnota_pocitadla_central expirace_cas_pocitadla\">{$expcas}</span>
  <span class=\"hodnota_pocitadla_central pocet_pristupu_pocitadla\">".($data->vyhra ? "<span class=\"povoleny_pristup pristup\" title=\"{$data->login} vyhrál\"></span>" : "<span class=\"nepovoleny_pristup pristup\" title=\"{$data->login} nevyhrál\"></span>")."</span>
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">Hrálo se o: {$popis}</span>
</p>
          ";

          if (date("Y-m-d H:i:s") > $datum)
          {
            if (!@$this->var->mysqli->multi_query("DELETE FROM losovani WHERE id={$data->id};"))
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vrati popis vyhry
 *
 * name: VypisCislaVyhry
 * @param id
 * @return nazev vyhry
 */
  function VypisCislaVyhry($id)
  {
    if ($res = @$this->var->mysqli->query("SELECT
                                          vyhry.popis as popis
                                          FROM vyhry
                                          WHERE
                                          vyhry.id={$id};
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $result = $res->fetch_object()->popis;
      }
        else
      {
        $result = "NENÍ NASTAVENA VÝHRA";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }


/********************** < VYHERCI > **********************/


/* vypise jen vyherce
 *
 * name: VypisAdminVyherci
 * @param void
 * @return vypis v html
 */
  function VypisAdminVyherci($str)
  {
    $strankovani = $this->Strankovani("vyherci", $str, "vypisvyh", "vypis_vyh", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          uzivatel.jmeno as jmeno,
                                          uzivatel.prijmeni as prijmeni,
                                          uzivatel.login as login,
                                          DATE_FORMAT(vyherci.datum, '%d.%m.%y %H:%i:%s') as datum,
                                          vyherci.popis as popis
                                          FROM vyherci, uzivatel
                                          WHERE
                                          uzivatel.id=vyherci.uzivatel
                                          ORDER BY vyherci.datum DESC
                                          {$limit};
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "{$strankovani}";
        while ($data = $res->fetch_object())
        {
          $popis = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->popis);
          //$popis = substr($popis, 0, 50);
          //$popis = iconv("UTF-8", "UTF-8", $popis); //uhlazeni diakritiky

          $result .=
          "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->jmeno}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->prijmeni}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->login}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$data->datum}</span>
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">Vyhrál: {$popis}</span>
</p>
          ";
        }
      }
        else
      {
        $result = "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">Nikdo zatím nevyhrál</span>
</p>
        ";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }


/********************** < DOTAZNÍK > **********************/


/* vypis vysledku dotazniku
 *
 * name: VypisAdminDotaznik
 * @param void
 * @return vypis v html
 */
/*
SELECT
uzivatel.jmeno as jmeno,
uzivatel.prijmeni as prijmeni,
uzivatel.login as login,
d1.odpoved as odpoved1,
d2.odpoved as odpoved2,
d3.odpoved as odpoved3,
d4.odpoved as odpoved4
FROM uzivatel_dotaznik,
uzivatel,
dotaznik as d1,
dotaznik as d2,
dotaznik as d3,
dotaznik as d4
WHERE
uzivatel.id=uzivatel_dotaznik.uzivatel AND
uzivatel_dotaznik.odpoved1=d1.id AND
uzivatel_dotaznik.odpoved2=d2.id AND
uzivatel_dotaznik.odpoved3=d3.id AND
uzivatel_dotaznik.odpoved4=d4.id
ORDER BY uzivatel_dotaznik.id ASC
*/
  function VypisAdminDotaznik($str)
  {
    $strankovani = $this->Strankovani("uzivatel_dotaznik", $str, "vypisdot", "vypis_dot", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          uzivatel.jmeno as jmeno,
                                          uzivatel.prijmeni as prijmeni,
                                          uzivatel.login as login,
                                          d1.odpoved as odpoved1,
                                          d2.odpoved as odpoved2,
                                          d3.odpoved as odpoved3,
                                          d4.odpoved as odpoved4
                                          FROM uzivatel_dotaznik,
                                          uzivatel,
                                          dotaznik as d1,
                                          dotaznik as d2,
                                          dotaznik as d3,
                                          dotaznik as d4
                                          WHERE
                                          uzivatel.id=uzivatel_dotaznik.uzivatel AND
                                          uzivatel_dotaznik.odpoved1=d1.id AND
                                          uzivatel_dotaznik.odpoved2=d2.id AND
                                          uzivatel_dotaznik.odpoved3=d3.id AND
                                          uzivatel_dotaznik.odpoved4=d4.id
                                          ORDER BY uzivatel_dotaznik.id ASC
                                          {$limit};
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "{$strankovani}";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->jmeno}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$data->prijmeni}</span>
  <span class=\"hodnota_pocitadla_central login_pocitadla_posledni\">{$data->login}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$data->odpoved1}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$data->odpoved2}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$data->odpoved3}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla_posledni\">{$data->odpoved4}</span>
</p>
          ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypis dotazniku ve strankach
 *
 * name: VypisDotaznik
 * @param void
 * @return vypis v html
 */
  function VypisDotaznik()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id,
                                          otazka
                                          FROM sekce_dotaznik
                                          ORDER BY sekce_dotaznik.id ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $i = 1;
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <div".(($i % 2) == 0 ? " class=\"vpravo delsi\"" : "").">
        <em>{$data->otazka}</em>
        <select size=\"1\" id=\"dot_{$data->id}\">
          <option>- Vyber možnost -</option>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT id,
                                                  sekce,
                                                  odpoved
                                                  FROM dotaznik
                                                  WHERE
                                                  dotaznik.sekce={$data->id}
                                                  ORDER BY dotaznik.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              while ($data1 = $res1->fetch_object())
              {
                $result .=
                "
          <option value=\"{$data1->id}\">{$data1->odpoved}</option>
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

          $result .=
          "
        </select>
      </div>
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }


/********************** < PRAVIDLA > **********************/


/* vypise pravidla ve strankach
 *
 * name: VypisPravidla
 * @param void
 * @return pravidla v html
 */
  function VypisPravidla()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT sekce_pravidla.id as id,
                                          sekce_pravidla.cislo as cislo,
                                          sekce_pravidla.nazev as nazev
                                          FROM sekce_pravidla
                                          ORDER BY sekce_pravidla.cislo ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
  <ul>
    <li class=\"nadpis_seznamu\"><span><em>{$this->DecimalToRimske($data->cislo)}.</em>{$data->nazev}</span>
      <ul>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT pravidla.text as text
                                                  FROM pravidla
                                                  WHERE
                                                  pravidla.sekce={$data->id}
                                                  ORDER BY pravidla.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              while ($data1 = $res1->fetch_object())
              {
                $result .=
                "
        <li>{$data1->text}</li>
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

          $result .=
          "
      </ul>
    </li>
  </ul>
          ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* prevod do rimskeho cisla
 *
 * name: DecimalToRimske
 * @param cislo
 * @return rimske cislo
 */
  function DecimalToRimske($cislo)
  {
    if (array_key_exists($cislo, $this->var->rimske))
    {
      $result = $this->var->rimske[$cislo];
    }
      else
    {
      $result = $cislo;
    }

    return $result;
  }

/* vypis pravidel v adminu
 *
 * name: VypisAdminPravidla
 * @param void
 * @return texty pravidel
 */
  function VypisAdminPravidla()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT sekce_pravidla.id as id,
                                          sekce_pravidla.cislo as cislo,
                                          sekce_pravidla.nazev as nazev
                                          FROM sekce_pravidla
                                          ORDER BY sekce_pravidla.cislo ASC;
                                          "))
    {
      $result .=
      "
<a href=\"#\" onclick=\"PoslatAkci('addpravidla&amp;typ=title', 0, 'info_pravidla');\" id=\"pridat_pravidla\">
  <span></span>
  Přidat sekci
</a>
      ";

      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<h4".($j > 1 ? " class=\"vetsi_odsazeni\"" : "").">
  {$this->DecimalToRimske($data->cislo)}. {$data->nazev}
  <a href=\"#\" onclick=\"PoslatAkci('editpravidla&amp;typ=title', {$data->id}, 'info_pravidla');\" title=\"Upravit sekci\" class=\"upravit_sekci_odkaz\">
    <span>
      Upravit sekci
    </span>
  </a>
  <a href=\"#\" onclick=\"PoslatAkci('delpravidla&amp;typ=title', {$data->id}, 'info_pravidla');\" title=\"Smazat sekci\" class=\"smazat_sekci_odkaz\">
    <span>
      Smazat sekci
    </span>
  </a>
  <a href=\"#\" onclick=\"PoslatAkci('addpravidla&amp;typ=text', {$data->id}, 'info_pravidla');\" title=\"Přidat řádek\" class=\"pridat_radek_odkaz\">
    <span>
      Přidat řádek
    </span>
  </a>
</h4>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT pravidla.id as id,
                                                  pravidla.text as text
                                                  FROM pravidla
                                                  WHERE
                                                  pravidla.sekce={$data->id}
                                                  ORDER BY pravidla.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              while ($data1 = $res1->fetch_object())
              {
                $vyrez = substr($data1->text, 0, 50);
                $vyrez = iconv("UTF-8", "UTF-8", $vyrez); //uhlazeni diakritiky

                $result .=
                "
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">{$vyrez}...</strong>
  <a href=\"#\" onclick=\"PoslatAkci('editpravidla&amp;typ=text', {$data1->id}, 'info_pravidla');\" class=\"odkaz_upravit_radek\"></a>
  <a href=\"#\" onclick=\"PoslatAkci('delpravidla&amp;typ=text', {$data1->id}, 'info_pravidla');\" class=\"odkaz_smazat_radek\"></a>
</p>
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* prida sekci nebo radek pravidla
 *
 * name: PridejAdminPravidla
 * @param id, typ clanku, pridat/nepridat
 * @return forma pridani pravila
 */
  function PridejAdminPravidla($id, $typ, $add = false)
  {
    switch ($typ)
    {
      case "title":
        if (!$add)
        {
          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"pravidla_cislo\" class=\"centralni_text_label baner_cesta_central\">Číslo sekce:</label>
      <input type=\"text\" id=\"pravidla_cislo\" />
      <label for=\"pravidla_nazev\" class=\"centralni_text_label baner_top_central\">Název sekce:</label>
      <input type=\"text\" id=\"pravidla_nazev\" />
      <input type=\"button\" value=\"Přidat sekci\" onclick=\"
      idcislo='pravidla_cislo';
      idnazev='pravidla_nazev';
      PoslatAkci('yesaddpravidla&amp;typ=title&amp;cislo='+document.getElementById(idcislo).value+
      '&amp;nazev='+document.getElementById(idnazev).value, 0, 'info_pravidla'); return false;\" id=\"tlacitko_pridat\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_pravidla');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
          else
        {
          $cislo = $_POST["cislo"];
          settype($cislo, "integer");
          $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

          if (!Empty($nazev))
          {
            if (@$this->var->mysqli->multi_query("INSERT INTO sekce_pravidla (id, cislo, nazev) VALUES
                                                  (NULL, {$cislo}, '{$nazev}');
                                                 "))
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla přidána sekce pravidla s názvem: <strong>{$nazev}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
              else
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
            else
          {
            $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Při přidávání sekce pravidla došlo k chybě.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
            ";
          }
        }
      break;

      case "text":
        if (!$add)
        {
          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"upraveni_vyhry_form\">
    <fieldset>
      <p class=\"zarovnani_vlevo\">Text pravidla</p>
      <textarea id=\"pravidla_text\" name=\"format\" rows=\"10\" cols=\"100\"></textarea>
      <input type=\"button\" value=\"Přidat řádek\" onclick=\"
      idtext='pravidla_text';
      PoslatAkci('yesaddpravidla&amp;typ=text&amp;text='+document.getElementById(idtext).value, {$id}, 'info_pravidla'); return false;\" id=\"tlacitko_pridat\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_pravidla');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
          else
        {
          $text = stripslashes(htmlspecialchars($_POST["text"]));

          if (!Empty($text))
          {
            if (@$this->var->mysqli->multi_query("INSERT INTO pravidla (id, sekce, text) VALUES
                                                  (NULL, {$id}, '{$text}');
                                                 "))
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl přidán řádek pravidla s textem: <strong>{$text}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
              else
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
            else
          {
            $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Při přidávání řádku pravidla došlo k chybě.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
            ";
          }
        }
      break;
    }

    return $result;
  }

/* editace pravidel a jejich nadpisu
 *
 * name: EditAdminPravidla
 * @param id, typ clanku, editova/needitovat
 * @return forma nebo informace od pravidel
 */
  function EditAdminPravidla($id, $typ, $edit = false)
  {
    settype($id, "integer");

    if (!Empty($typ) && $id != 0)
    {
      switch ($typ)
      {
        case "title":
          if ($res = @$this->var->mysqli->query("SELECT sekce_pravidla.id as id,
                                                sekce_pravidla.cislo as cislo,
                                                sekce_pravidla.nazev as nazev
                                                FROM sekce_pravidla
                                                WHERE
                                                sekce_pravidla.id={$id};
                                                "))
          {
            if ($res->num_rows == 1)
            {
              $data = $res->fetch_object();

              $result =
              "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"pravidla_cislo\" class=\"centralni_text_label baner_cesta_central\">Číslo sekce:</label>
      <input type=\"text\" id=\"pravidla_cislo\" value=\"{$data->cislo}\" />
      <label for=\"pravidla_nazev\" class=\"centralni_text_label baner_top_central\">Název sekce:</label>
      <input type=\"text\" id=\"pravidla_nazev\" value=\"{$data->nazev}\" />
      <input type=\"button\" value=\"Upravit sekci\" onclick=\"
      cisloid='pravidla_cislo';
      hlavickaid='pravidla_nazev';
      PoslatAkci('yeseditpravidla&amp;typ=title&amp;cislo='+document.getElementById(cisloid).value+
      '&amp;hlavicka='+document.getElementById(hlavickaid).value, {$data->id}, 'info_pravidla'); return false;\" id=\"tlacitko_upravit\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_pravidla');\"></a>
    </fieldset>
  </form>
</div>
              ";
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

          if ($edit)
          {
            $cislo = stripslashes(htmlspecialchars($_POST["cislo"]));
            settype($cislo, "integer");
            $hlavicka = stripslashes(htmlspecialchars($_POST["hlavicka"]));

            if (@$this->var->mysqli->multi_query("UPDATE sekce_pravidla SET cislo={$cislo},
                                                                            nazev='{$hlavicka}'
                                                                            WHERE id={$id};"))
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla upravena sekce pravidla s názvem: <strong>{$hlavicka}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
              else
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        break;

        case "text":
          if ($res = @$this->var->mysqli->query("SELECT pravidla.id as id,
                                                pravidla.text as text
                                                FROM pravidla
                                                WHERE
                                                pravidla.id={$id};
                                                "))
          {
            if ($res->num_rows == 1)
            {
              $data = $res->fetch_object();

              $result =
              "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"upraveni_vyhry_form\">
    <fieldset>
      <p class=\"zarovnani_vlevo\">Text pravidla</p>
      <textarea id=\"pravidla_text\" name=\"format\" rows=\"10\" cols=\"100\">{$data->text}</textarea>
      <input type=\"button\" value=\"Upravit řádek\" onclick=\"
      textid='pravidla_text';
      PoslatAkci('yeseditpravidla&amp;typ=text&amp;text='+document.getElementById(textid).value, {$data->id}, 'info_pravidla'); return false;\" id=\"tlacitko_upravit\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_pravidla');\"></a>
    </fieldset>
  </form>
</div>
              ";
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

          if ($edit)
          {
            $text = stripslashes(htmlspecialchars($_POST["text"]));

            if (@$this->var->mysqli->multi_query("UPDATE pravidla SET text='{$text}'
                                                                      WHERE id={$id};"))
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl upraven řádek pravidla s textem: <strong>{$text}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
              else
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        break;
      }
    }

    return $result;
  }

/* smaze dane pravidlo
 *
 * name: SmazAdminPravidla
 * @param id, typ clanku, detekce smazani
 * @return formular v html
 */
  function SmazAdminPravidla($id, $typ, $smazat = false)
  {
    settype($id, "integer");

    switch ($typ)
    {
      case "title":
        if ($id != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, cislo, nazev FROM sekce_pravidla WHERE id={$id};"))
          {
            if ($res->num_rows == 1)
            {
              $data = $res->fetch_object();

              $result =
              "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat sekci pravidla s názvem: <strong>{$data->nazev}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelpravidla&amp;typ=title', {$data->id}, 'info_pravidla'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_pravidla'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
              ";
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

          if ($smazat)  //je-li smazano
          {
            if (@$this->var->mysqli->multi_query("DELETE FROM sekce_pravidla WHERE id={$id};"))
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla smazána sekce pravidla s názvem: <strong>{$data->nazev}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
              else
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      break;

      case "text":
        if ($id != 0)
        {
          if ($res = @$this->var->mysqli->query("SELECT id, sekce, text FROM pravidla WHERE id={$id};"))
          {
            if ($res->num_rows == 1)
            {
              $data = $res->fetch_object();

              $result =
              "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat řádek pravidla s názvem: <strong>{$data->text}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelpravidla&amp;typ=text', {$data->id}, 'info_pravidla'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_pravidla'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
              ";
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }

          if ($smazat)  //je-li smazano
          {
            if (@$this->var->mysqli->multi_query("DELETE FROM pravidla WHERE id={$id};"))
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl smazán řádek pravidla s textem: <strong>{$data->text}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
              else
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      break;
    }

    return $result;
  }


/********************** < VYHRY > **********************/


/* vypis vyher na webu
 *
 * name: VypisVyhry
 * @param void
 * @return vypis v html
 */
  function VypisVyhry()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, popis, typ, dodavatel, www FROM vyhry ORDER BY vyhry.id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $popisek = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data->popis);
          $dodavatel = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data->dodavatel);

          $alt1 = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->popis);
          $alt2 = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->dodavatel);

          $result .=
          "
  <ul class=\"listina_vyher".($i == 0 ? " listina_bonus" : "")."\">
    <li class=\"popis_text_vyhry\">{$popisek}</li>
    <li class=\"obrazek_vyhry\"><img src=\"{$this->var->vyhpic}/vyhra_00{$data->id}.{$data->typ}\" alt=\"{$alt1} - {$alt2}\" /></li>
    <li class=\"informace_o_zbozi_vyhry\">{$dodavatel}
      <img src=\"{$this->var->bubpic}/{$i}.jpg\">
      ".(!Empty($data->www) ? "<a href=\"http://{$data->www}\" title=\"{$data->www}\">{$data->www}</a>" : "")."
    </li>
  </ul>
          ";

          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* prida polozku vyhry
 *
 * name: PridejObrazekBuben
 * @param detekce pridani
 * @return info v html
 */
  function PridejAdminVyhru($add = false)
  {
    if (!$add)
    {
      $result =
      "
<div id=\"pridat_vyhru_otazka\">
  <p>
    Opravdu chcete přidat výhru ?
  </p>
  <p class=\"odstavec_informace\">
    (Výhra bude přidána jako poslední položka v seznamu)
  </p>
  <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesaddvyhry', 0, 'info_vyhry');\" id=\"tlacitko_ano\" />
  <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('editvyhry', 0, 'info_vyhry');\" id=\"tlacitko_ne\" />
</div>
      ";
    }
      else
    {
      if (@$this->var->mysqli->multi_query("INSERT INTO vyhry (id, popis, typ, dodavatel, www, aktivni) VALUES (NULL, '---', '', '---', '', false);"))
      {
        $id = $this->var->mysqli->insert_id;
        $min = $id - 1;

        //copy("{$this->var->bubpic}/{$min}.jpg", "{$this->var->bubpic}/{$id}.jpg");  //kopie obrazku

        $img = imagecreate(78, 40);
        $back = imagecolorallocate($img, 255, 255, 255);  //vytvori bile platno
        imagejpeg($img, "{$this->var->bubpic}/{$min}.jpg");

        $result = "
<div id=\"centralni_polozka_upravit\">
  <p>
    Byla přidána výhra s ID: <strong>{$id}</strong>
  </p>
  <span class=\"nacitani_obrazek\"></span>
</div>
                  ";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* vypis vyher v adminu
 *
 * name: VypisAdminVyhry
 * @param void
 * @return vypis v html
 */
  function VypisAdminVyhry()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, popis, typ, dodavatel, www, aktivni FROM vyhry ORDER BY vyhry.id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        $result .=
        "
<a href=\"#\" onclick=\"PoslatAkci('addvyhry', 0, 'info_vyhry'); return false;\" id=\"pridat_vyhru\">
  <span></span>
  Přidat výhru
</a>
        ";

        while ($data = $res->fetch_object())
        {
          $popisek = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data->popis);
          $dodavatel = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data->dodavatel);

          $alt1 = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->popis);
          $alt2 = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->dodavatel);

          $result .=
          "
  <ul class=\"listina_vyher\">
    <li class=\"popis_text_vyhry\">
      {$popisek}
      <a href=\"ajax.php?action=admin&amp;akce=vyhry&amp;co=edittext&amp;id={$data->id}\" title=\"Upravit výhru\" class=\"odkaz_upravit_vyhry\">
        <span></span>
        Upravit výhru
      </a>
    </li>
    <li class=\"obrazek_vyhry\">
      <img src=\"{$this->var->vyhpic}/vyhra_00{$data->id}.{$data->typ}\" alt=\"{$alt1} - {$alt2}\" />
      <a href=\"ajax.php?action=admin&amp;akce=vyhry&amp;co=editpicvyhry&amp;id={$data->id}\" title=\"Nahrát obrázek\" class=\"odkaz_upravit_vyhry odkaz_upravit_obrazek\">
        <span></span>
        Nahrát obrázek
      </a>
    </li>
    <li class=\"informace_o_zbozi_vyhry\">
      {$dodavatel}
      <img src=\"{$this->var->bubpic}/{$i}.jpg\" alt=\"{$i}.jpg\" />
      ".(!Empty($data->www) ? "<a href=\"http://{$data->www}\" title=\"{$data->www}\">{$data->www}</a>" : "")."
      <span class=\"aktivita_vyhry\">
        <em>Aktivní výhra:</em> <input disabled=\"disabled\" type=\"checkbox\"".($data->aktivni ? " checked=\"checked\"" : "")." />
      </span>
      ".($data->id == $res->num_rows ? "<a href=\"#\" onclick=\"PoslatAkci('delvyhry', {$data->id}, 'info_vyhry');\" title=\"Smazat výhru\" class=\"odkaz_upravit_vyhry odkaz_smazat_vyhru\">
        <span></span>
        Smazat výhru
      </a>" : "")."
    </li>
  </ul>
          ";
//onclick=\"PoslatAkci('editvyhry', {$data->id}, 'info_vyhry'); location.href='#'; return false;\"
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* znacky interpretoveho jazyka
 *
 * name: VypisInterpretu
 * @param id elementu
 * @return znak pro vlozeni v html
 */
  function VypisInterpretu($id)
  {
    $result = "";
    for ($i = 0; $i < count($this->var->interet); $i++)
    {
      $result .=
      "
<a href=\"#\" onclick=\"VlozitDoTextu('{$id}', {$i}); return false;\" class=\"ovladaci_prvky_k_textarea ovladaci_prvek_samostatny_{$i}\">
  {$this->var->interet[$i]}
</a>
      ";
    }

    return $result;
  }

/* editace polozky vyhry
 *
 * name: EditAdmiVyhry
 * @param void
 * @return formular v html
 */
  function EditAdmiVyhry()
  {
    $id = $_GET["id"];
    settype($id, "integer");

    if (!Empty($id) &&
        $id != 0 &&
        $_GET["co"] == "edittext")
    {
      if ($res = @$this->var->mysqli->query("SELECT id, popis, typ, dodavatel, www, aktivni FROM vyhry WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();
          $typ = $data->typ;

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"upraveni_vyhry_form\">
    <fieldset>
      <span>
        <label id=\"cislo_obrazku_label\">Editace výhry s ID: <em>{$id}</em></label>
        <img src=\"{$this->var->vyhpic}/vyhra_00{$id}.{$typ}\" alt=\"vyhra_00{$id}.{$typ}\" id=\"obrazek_vyhra_upravit\" />
      </span>
      <em class=\"vysvetlivka_form vysvetlivka_form_b\"><em>b</em><cite> - </cite>tučný text</em>
      <em class=\"vysvetlivka_form vysvetlivka_form_i\"><em>i</em><cite> - </cite>kurzivý text</em>
      <em class=\"vysvetlivka_form vysvetlivka_form_u\"><em>u</em><cite> - </cite><strong>podtržený text</strong></em>
      <em class=\"vysvetlivka_form vysvetlivka_form_center\"><em>center</em><cite> - </cite>samostatný text uprostřed</em>
      <p class=\"zarovnani_vlevo\">První text</p>
      {$this->VypisInterpretu("vyhry_popis")}
      <textarea id=\"vyhry_popis\" name=\"popis\" rows=\"10\" cols=\"100\">{$data->popis}</textarea>
      <p class=\"zarovnani_vlevo\">Druhý text</p>
      {$this->VypisInterpretu("vyhry_dodavatel")}
      <textarea id=\"vyhry_dodavatel\" name=\"dodavatel\" rows=\"10\" cols=\"100\">{$data->dodavatel}</textarea>
      <dl>
        <dt>
          http://
        </dt>
        <dd>
          <input type=\"text\" name=\"www\" value=\"{$data->www}\" class=\"www_input_vyhra\" />
        <dd>
      </dl>
      <dl>
        <dt>
          Aktivovat výhru:
        </dt>
        <dd id=\"aktivace_vyhry_input\">
          <input name=\"aktivni\" value=\"true\" type=\"checkbox\"".($data->aktivni ? " checked=\"checked\"" : "")." />
        <dd>
      </dl>
      <input type=\"submit\" name=\"tlacitko\" value=\"Upravit výhru\" id=\"tlacitko_upravit\" />
      <a href=\"ajax.php?action=admin&amp;akce=vyhry\" title=\"Zavřít okno\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if (!Empty($_POST["tlacitko"]))
      {
        $popis = stripslashes(htmlspecialchars($_POST["popis"]));
        $dodavatel = stripslashes(htmlspecialchars($_POST["dodavatel"]));
        $www = stripslashes(htmlspecialchars($_POST["www"]));
        $aktivni = ($_POST["aktivni"] == "true" ? 1 : 0);

        if (@$this->var->mysqli->multi_query ("UPDATE vyhry SET popis='{$popis}',
                                                                dodavatel='{$dodavatel}',
                                                                www='{$www}'
                                                                WHERE id={$id};"))
        {
          if (@$this->var->mysqli->multi_query ("UPDATE vyhry SET aktivni={$aktivni}
                                                                  WHERE id={$id};"))
          {
            $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla upravena výhra s ID: <strong>{$id}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
            ";
            $this->AutoClick(1, "ajax.php?action=admin&akce=vyhry");
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }

/* reupload obrazku ve vyhrach
 *
 * name: EditAdminObrazkyVyhry
 * @param void
 * @return info o uploadu
 */
  function EditAdminObrazkyVyhry()
  {
    $id = $_GET["id"];
    settype($id, "integer");

    if (!Empty($id) &&
        $id != 0 &&
        $_GET["co"] == "editpicvyhry")
    {
      if ($res = @$this->var->mysqli->query("SELECT id, popis, typ, dodavatel FROM vyhry WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();
          $typ = $data->typ;

          $result =
          "
<div id=\"centralni_polozka_upravit\" class=\"centralni_polozka_upravit_obrazek_vyhry\">
  <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
    <fieldset>
      <label for=\"input_file_reupload\" id=\"cislo_obrazku_label\">Obrázek číslo: <em>{$id}</em></label>
      <input type=\"file\" name=\"soubor\" id=\"input_file_reupload\" />
      <img src=\"{$this->var->vyhpic}/vyhra_00{$id}.{$typ}\" alt=\"vyhra_00{$id}.{$typ}\" id=\"obrazek_vyhra_reupload\" />
      <input type=\"submit\" name=\"tlacitko\" value=\"Nahrát nový obrázek\" id=\"tlacitko_upravit_obrazek_vyhry\" />
      <a href=\"ajax.php?action=admin&amp;akce=vyhry\" title=\"Zavřít okno\"></a>
    </fieldset>
  </form>
</div>
          ";

          $max_w = 150;
          //$max_h = 40;

          if (!Empty($_POST["tlacitko"]))
          {
            if ($_FILES["soubor"]["type"] == "image/jpeg" ||
                $_FILES["soubor"]["type"] == "image/png")
            {
              if (file_exists("{$this->var->vyhpic}/vyhra_00{$id}.{$typ}")) //smaze stary
              {
                unlink("{$this->var->vyhpic}/vyhra_00{$id}.{$typ}");
              }
                else
              {
                $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Obrázek neexistuje !
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
                ";
              }

              $temp_pic = $_FILES["soubor"]["tmp_name"];
              if (is_uploaded_file($temp_pic))
              {
                list($old_w, $old_h) = getimagesize($temp_pic);

                if ($old_w <= $max_w)  //je-li mensi tak se zanecha
                {
                  $new_w = $old_w;
                  $new_h = $old_h;
                }
                  else
                {
                  $new_w = $max_w; //dana sirka
                  $new_h = round($old_h / ($old_w / $max_w)); //vypocet vysky
                }

                $pripona = "";
                switch ($_FILES["soubor"]["type"])
                {
                  case "image/jpeg":
                    $pripona = "jpg";
                    $img_new = imagecreatetruecolor($new_w, $new_h);
                    $img_old = imagecreatefromjpeg($temp_pic);
                    imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
                    imagejpeg($img_new, "{$this->var->vyhpic}/vyhra_00{$id}.{$pripona}", 100);
                    imagedestroy($img_new);

                    chmod("{$this->var->vyhpic}/vyhra_00{$id}.{$pripona}", 0777);  //zmena atributu
                    $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nový <strong>JPG</strong> obrázek číslo: <strong>{$id}</strong> byl úspěšně nahrán
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
                    ";
                  break;

                  case "image/png":
                    $pripona = "png";
                    $img_new = imagecreatetruecolor($new_w, $new_h);
                    $img_old = imagecreatefrompng($temp_pic);
                    imagecopyresampled($img_new, $img_old, 0, 0, 0, 0, $new_w, $new_h, $old_w, $old_h);
                    imagepng($img_new, "{$this->var->vyhpic}/vyhra_00{$id}.{$pripona}");
                    imagedestroy($img_new);

                    chmod("{$this->var->vyhpic}/vyhra_00{$id}.{$pripona}", 0777);  //zmena atributu
                    $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nový <strong>PNG</strong> obrázek číslo: <strong>{$id}</strong> byl úspěšně nahrán
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
                    ";
                  break;
                }

                if (!Empty($pripona)) //uprava koncovy v db
                {
                  if (!@$this->var->mysqli->multi_query("UPDATE vyhry SET typ='{$pripona}'
                                                                          WHERE id={$id};"))
                  {
                    $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
                  }
                }

                $this->AutoClick(1, "ajax.php?action=admin&akce=vyhry");
              }
                else
              {
                $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nahrátí obrázku se nezdařilo. Počet chyb je: <strong>{$_FILES["soubor"]["error"]}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
                ";
              }
            }
              else
            {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nahrátí obrázku se nezdařilo. Obrázek má nesprávný formát. Povolené formáty jsou: <strong>JPG a PNG</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
            }
          }
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* smazani polozky vyhry
 *
 * name: SmazAdminObrazekBuben
 * @param id obrazku, prznak smazani
 * @return info o prubehu v html
 */
  function SmazAdminVyhru($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat výhru s ID: <strong>{$id}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelvyhry', {$id}, 'info_vyhry'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_vyhry'); return false;\" id=\"tlacitko_ne\" />
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_user');\"></a>
    </fieldset>
  </form>
</div>
      ";
    }

    if ($smazat)
    {
      if (@$this->var->mysqli->multi_query("DELETE FROM vyhry WHERE id={$id};
                                            ALTER TABLE vyhry AUTO_INCREMENT={$id};"))
      {
        $min = $id - 1;
        @unlink("{$this->var->bubpic}/{$min}.jpg");  //smazani obrazku

        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla smazána výhra s ID: <strong>{$id}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }


/********************** < FAQ > **********************/


/* vypisuje ve strankach faq
 *
 * name: VypisFAQ
 * @param void
 * @return vypis faq v html
 */
  function VypisFAQ()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, nazev
                                          FROM sekce_faq
                                          ORDER BY sekce_faq.id ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $j = 0;
        while ($data = $res->fetch_object())
        {
          $j++;
          $result .=
          "
 <h4".($j > 1 ? " class=\"vetsi_odsazeni\"" : "").">{$data->nazev}</h4>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT sekce, otazka, odpoved
                                                  FROM faq
                                                  WHERE
                                                  faq.sekce={$data->id}
                                                  ORDER BY faq.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              $i = 0;
              while ($data1 = $res1->fetch_object())
              {
                $i++;
                $result .=
                "
  <p>
    <em class=\"ikona_otazka\"></em>
    <strong class=\"otazka\">Otázka:</strong> {$data1->otazka}
  </p>
  <p>
    <em class=\"ikona_odpoved\"></em>
    <strong class=\"odpoved\">Odpověď:</strong> {$data1->odpoved}
  </p>
  ".($res1->num_rows != $i ? "<span class=\"linka\"></span>" : "")."
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypsuje faq
 *
 * name: VypisAdminFAQ
 * @param void
 * @return vypis v html
 */
  function VypisAdminFAQ()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, nazev
                                          FROM sekce_faq
                                          ORDER BY sekce_faq.id ASC;
                                          "))
    {
      $result .=
      "
<a href=\"#\" onclick=\"PoslatAkci('addfaqsekce', 0, 'info_faq');\" id=\"pridat_faq\">
  <span></span>
  Přidat sekci FAQ
</a>
      ";

      if ($res->num_rows != 0)
      {
        $j = 0;
        while ($data = $res->fetch_object())
        {
          $j++;
          $result .=
          "
<h4".($j > 1 ? " class=\"vetsi_odsazeni\"" : "").">
  {$data->nazev}
  <a href=\"#\" onclick=\"PoslatAkci('editfaqsekce', {$data->id}, 'info_faq');\" title=\"Upravit sekci\" class=\"upravit_sekci_odkaz\">
    <span>
      Upravit sekci
    </span>
  </a>
  <a href=\"#\" onclick=\"PoslatAkci('delfaqsekce', {$data->id}, 'info_faq');\" title=\"Smazat sekci\" class=\"smazat_sekci_odkaz\">
    <span>
      Smazat sekci
    </span>
  </a>
  <a href=\"#\" onclick=\"PoslatAkci('addfaqradek', {$data->id}, 'info_faq');\" title=\"Přidat řádek\" class=\"pridat_radek_odkaz\">
    <span>
      Přidat řádek
    </span>
  </a>
</h4>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT id, sekce, otazka, odpoved
                                                  FROM faq
                                                  WHERE
                                                  faq.sekce={$data->id}
                                                  ORDER BY faq.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              $i = 0;
              while ($data1 = $res1->fetch_object())
              {
                $i++;
                $result .=
                "
<p class=\"odstavec_ve_faq\">
  <em class=\"ikona_otazka\"></em>
  <strong class=\"otazka\">Otázka:</strong> {$data1->otazka}
</p>
<p class=\"odstavec_ve_faq\">
  <em class=\"ikona_odpoved\"></em>
  <strong class=\"odpoved\">Odpověď:</strong> {$data1->odpoved}
</p>
<a href=\"#\" onclick=\"PoslatAkci('delfaqradek', {$data1->id}, 'info_faq');\" title=\"Smazat řádek\" class=\"smazat_radek_odkaz\">
  <span>
    Smazat řádek
  </span>
</a>
<a href=\"#\" onclick=\"PoslatAkci('editfaqradek', {$data1->id}, 'info_faq');\" title=\"Upravit řádek\" class=\"upravit_radek_odkaz\">
  <span>
    Upravit řádek
  </span>
</a>
".($res1->num_rows != $i ? "<span class=\"linka\"></span>" : "")."
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* pridani nove sekce do faq
 *
 * name: PridejAdminFAQSekce
 * @param detekce pridani
 * @return formular v html
 */
  function PridejAdminFAQSekce($add = false)
  {
    if (!$add)
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"faq_nazev\" id=\"centralni_text_label\">Název sekce FAQ:</label>
      <input type=\"text\" id=\"faq_nazev\" />
      <input type=\"button\" value=\"Přidat sekci FAQ\" onclick=\"
      idnazev='faq_nazev';
      PoslatAkci('yesaddfaqsekce&amp;nazev='+document.getElementById(idnazev).value, 0, 'info_faq'); return false;\" id=\"tlacitko_pridat\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_faq');\"></a>
    </fieldset>
  </form>
</div>
      ";
    }
      else
    {
      $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

      if (!Empty($nazev))
      {
        if (@$this->var->mysqli->multi_query("INSERT INTO sekce_faq (id, nazev) VALUES
                                              (NULL, '{$nazev}');
                                             "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla přidána sekce FAQ s názvem: <strong>{$nazev}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při přidávání sekce do FAQ
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* uprava dane sekce faq
 *
 * name: EditAdmiFAQSekce
 * @param id, detekce editace
 * @return formaular v html
 */
  function EditAdmiFAQSekce($id, $edit = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM sekce_faq WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"faq_nazev\" id=\"centralni_text_label\">Název sekce FAQ:</label>
      <input type=\"text\" id=\"faq_nazev\" value=\"{$data->nazev}\" />
      <input type=\"button\" value=\"Upravit sekci FAQ\" onclick=\"
      idnazev='faq_nazev';
      PoslatAkci('yeseditfaqsekce&amp;nazev='+document.getElementById(idnazev).value, {$id}, 'info_faq'); return false;\" id=\"tlacitko_upravit\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_faq');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)  //je-li editovano
    {
      $nazev = stripslashes(htmlspecialchars($_POST["nazev"]));

      if (!Empty($nazev))
      {
        if (@$this->var->mysqli->multi_query ("UPDATE sekce_faq SET nazev='{$nazev}'
                                                                    WHERE id={$id};
                                              "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla upravena sekce FAQ s názvem: <strong>{$nazev}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při upravování sekce ve FAQ
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }


/* smazani dane sekce faq
 *
 * name: SmazAdminFAQSekce
 * @param id, detekce smazani
 * @return formular v html
 */
  function SmazAdminFAQSekce($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, nazev FROM sekce_faq WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat sekci FAQ s názvem: <strong>{$data->nazev}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelfaqsekce', {$data->id}, 'info_faq'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_faq'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($smazat)  //je-li smazano
      {
        if (@$this->var->mysqli->multi_query("DELETE FROM sekce_faq WHERE id={$id};"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla smazána sekce ve FAQ s názvem: <strong>{$data->nazev}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }

/* prida radek do dane sekce faq
 *
 * name: PridejAdminFAQRadek
 * @param detekce pridani
 * @return formular v html
 */
  function PridejAdminFAQRadek($id, $add = false)
  {
    if (!$add)
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"pridavani_faq_delsi\">
    <fieldset>
      <label for=\"faq_otazka\" id=\"centralni_text_label_otazka\">Otázka:</label>
      <input type=\"text\" id=\"faq_otazka\" />
      <label for=\"faq_odpoved\" id=\"centralni_text_label_odpoved\">Odpověď:</label>
      <input type=\"text\" id=\"faq_odpoved\" />
      <input type=\"button\" value=\"Přidat řádek\" onclick=\"
      idotazka='faq_otazka';
      idodpoved='faq_odpoved';
      PoslatAkci('yesaddfaqradek&amp;otazka='+document.getElementById(idotazka).value+
      '&amp;odpoved='+document.getElementById(idodpoved).value, {$id}, 'info_faq'); return false;\" id=\"tlacitko_pridat\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_faq');\"></a>
    </fieldset>
  </form>
</div>
      ";
    }
      else
    {
      $otazka = stripslashes(htmlspecialchars($_POST["otazka"]));
      $odpoved = stripslashes(htmlspecialchars($_POST["odpoved"]));

      if (!Empty($otazka) &&
          !Empty($odpoved))
      {
        if (@$this->var->mysqli->multi_query("INSERT INTO faq (id, sekce, otazka, odpoved) VALUES
                                              (NULL, {$id}, '{$otazka}', '{$odpoved}');
                                             "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl přidán řádek s otázkou: <strong>{$otazka}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při přidávání řádku
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* upravy dany radek faq
 *
 * name: EditAdmiFAQRadek
 * @param id, detekce sditace
 * @return formular v html
 */
  function EditAdmiFAQRadek($id, $edit = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, sekce, otazka, odpoved FROM faq WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"pridavani_faq_delsi\">
    <fieldset>
      <label for=\"faq_otazka\" id=\"centralni_text_label_otazka\">Otázka:</label>
      <input type=\"text\" id=\"faq_otazka\" value=\"{$data->otazka}\" />
      <label for=\"faq_odpoved\" id=\"centralni_text_label_odpoved\">Odpověď:</label>
      <input type=\"text\" id=\"faq_odpoved\" value=\"{$data->odpoved}\" />
      <input type=\"button\" value=\"Upravit řádek\" onclick=\"
      idotazka='faq_otazka';
      idodpoved='faq_odpoved';
      PoslatAkci('yeseditfaqradek&amp;otazka='+document.getElementById(idotazka).value+
      '&amp;odpoved='+document.getElementById(idodpoved).value, {$id}, 'info_faq'); return false;\" id=\"tlacitko_upravit\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_faq');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)  //je-li editovano
    {
      $otazka = stripslashes(htmlspecialchars($_POST["otazka"]));
      $odpoved = stripslashes(htmlspecialchars($_POST["odpoved"]));

      if (!Empty($otazka) &&
          !Empty($odpoved))
      {
        if (@$this->var->mysqli->multi_query ("UPDATE faq SET otazka='{$otazka}',
                                                              odpoved='{$odpoved}'
                                                              WHERE id={$id};
                                              "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl upraven řádek s otázkou: <strong>{$otazka}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při upravování řádku
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* smaze dany radek faq
 *
 * name: SmazAdminFAQRadek
 * @param id, detekce smazani
 * @return formular v html
 */
  function SmazAdminFAQRadek($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, otazka, odpoved FROM faq WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat řádek s otázkou: <strong>{$data->otazka}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelfaqradek', {$data->id}, 'info_faq'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_faq'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($smazat)  //je-li smazano
      {
        if (@$this->var->mysqli->multi_query("DELETE FROM faq WHERE id={$id};"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl smazán řádek s otázkou: <strong>{$data->otazka}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }


/********************** < CENIK > **********************/


/*
 *
 * name: VypisCenik
 * @param
 * @return
 */
  function VypisCenik()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, nadpis, format, cena1, cena2, poznamka
                                          FROM sekce_cenik
                                          ORDER BY sekce_cenik.id ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<em class=\"nadpis_seznamu_tabulky\">{$data->nadpis}</em>
<table summary=\"{$data->nadpis}\" class=\"tabulka_cenik\">
<caption>{$data->nadpis}</caption>
  <thead>
    <tr>
      <th class=\"formaty_a_velikost\">{$data->format}</th>
      <th class=\"ceny_seznam\">{$data->cena1}</th>
      <th class=\"ceny_seznam\">{$data->cena2}</th>
      <th class=\"poznamky_seznam\">{$data->poznamka}</th>
    </tr>
  </thead>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT sekce, format, cena1, cena2, poznamka
                                                  FROM cenik
                                                  WHERE
                                                  cenik.sekce={$data->id}
                                                  ORDER BY cenik.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              while ($data1 = $res1->fetch_object())
              {
                $format = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->format);
                $cena1 = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->cena1);
                $cena2 = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->cena2);
                $poznamka = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->poznamka);

                $result .=
                "
    <tr>
      <td class=\"formaty_a_velikost\">{$format}</td>
      <td class=\"ceny_seznam\">{$cena1}</td>
      <td class=\"ceny_seznam\">{$cena2}</td>
      <td class=\"poznamky_seznam\">{$poznamka}</td>
    </tr>
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
          $result .=
          "
  </tbody>
  <tfoot>
    <tr class=\"zapati_tabulky\">
      <td class=\"formaty_a_velikost\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"poznamky_seznam\"></td>
    </tr>
  </tfoot>
</table>
          ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypisuje vyhry v adminu
 *
 * name: VypisAdminCenik
 * @param void
 * @return vypis v html
 */
  function VypisAdminCenik()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, nadpis, format, cena1, cena2, poznamka
                                          FROM sekce_cenik
                                          ORDER BY sekce_cenik.id ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "
<a href=\"#\" onclick=\"PoslatAkci('addceniksekce', 0, 'info_cenik');\" id=\"pridat_cenik\">
  <span></span>
  Přidat sekci ceníku
</a>
        ";

        $i = 0;
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<em class=\"nadpis_seznamu_tabulky".($i == 0 ? " vetsi_odsazeni" : "")."\">
  {$data->nadpis}
  <a href=\"#\" onclick=\"PoslatAkci('editceniksekce', {$data->id}, 'info_cenik');\" title=\"Upravit sekci\" class=\"upravit_sekci_odkaz\">
    <span>
      Upravit sekci
    </span>
  </a>
  <a href=\"#\" onclick=\"PoslatAkci('delceniksekce', {$data->id}, 'info_cenik');\" title=\"Smazat sekci\" class=\"smazat_sekci_odkaz\">
    <span>
      Smazat sekci
    </span>
  </a>
  <a href=\"ajax.php?action=admin&akce=ceny&amp;co=addradek&amp;id={$data->id}\" title=\"Přidat řádek\" class=\"pridat_radek_odkaz\">
    <span>
      Přidat řádek
    </span>
  </a>
</em>
<table summary=\"{$data->nadpis}\" class=\"tabulka_cenik\">
<caption>{$data->nadpis}</caption>
  <thead>
    <tr>
      <th class=\"formaty_a_velikost\">{$data->format}</th>
      <th class=\"ceny_seznam\">{$data->cena1}</th>
      <th class=\"ceny_seznam\">{$data->cena2}</th>
      <th class=\"poznamky_seznam\">{$data->poznamka}</th>
    </tr>
  </thead>
          ";

          if ($res1 = @$this->var->mysqli->query("SELECT id, sekce, format, cena1, cena2, poznamka
                                                  FROM cenik
                                                  WHERE
                                                  cenik.sekce={$data->id}
                                                  ORDER BY cenik.id ASC;
                                                  "))
          {
            if ($res1->num_rows != 0)
            {
              while ($data1 = $res1->fetch_object())
              {
                $format = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->format);
                $cena1 = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->cena1);
                $cena2 = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->cena2);
                $poznamka = str_replace($this->var->interpret_hledat, $this->var->interpret_nadradit, $data1->poznamka);

                $result .=
                "
    <tr>
      <td class=\"formaty_a_velikost\">{$format}</td>
      <td class=\"ceny_seznam\">{$cena1}</td>
      <td class=\"ceny_seznam\">{$cena2}</td>
      <td class=\"poznamky_seznam\">{$poznamka}</td>
      <td class=\"polozky_smazat_upravit\">
        <a href=\"ajax.php?action=admin&akce=ceny&amp;co=editradek&amp;id={$data1->id}\" class=\"odkaz_upravit_radek\"></a>
        <a href=\"#\" onclick=\"PoslatAkci('delcenikradek', {$data1->id}, 'info_cenik');\" class=\"odkaz_smazat_radek\"></a>
      </td>
    </tr>
                ";
              }
            }
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
          $result .=
          "
  </tbody>
  <tfoot>
    <tr class=\"zapati_tabulky\">
      <td class=\"formaty_a_velikost\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"ceny_seznam\"></td>
      <td class=\"poznamky_seznam\"></td>
    </tr>
  </tfoot>
</table>
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* prida sekci ceniku
 *
 * name: PridejAdminCenikSekce
 * @param detekce pridani
 * @return formular v html
 */
  function PridejAdminCenikSekce($add = false)
  {
    if (!$add)
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"cenik_nadpis\" class=\"centralni_text_label baner_cesta_central\">Nadpis sekce ceníku:</label>
      <input type=\"text\" id=\"cenik_nadpis\" />
      <label for=\"cenik_format\" class=\"centralni_text_label baner_top_central\">Formát:</label>
      <input type=\"text\" id=\"cenik_format\" />
      <label for=\"cenik_cena1\" class=\"centralni_text_label baner_left_central\">První cena:</label>
      <input type=\"text\" id=\"cenik_cena1\" />
      <label for=\"cenik_cena2\" class=\"centralni_text_label baner_w_central\">Druhá cena:</label>
      <input type=\"text\" id=\"cenik_cena2\" />
      <label for=\"cenik_poznamka\" class=\"centralni_text_label baner_h_central\">Poznámka:</label>
      <input type=\"text\" id=\"cenik_poznamka\" />
      <input type=\"button\" value=\"Přidat ceník\" onclick=\"
      idnadpis='cenik_nadpis';
      idformat='cenik_format';
      idcena1='cenik_cena1';
      idcena2='cenik_cena2';
      idpoznamka='cenik_poznamka';
      PoslatAkci('yesaddceniksekce&amp;nadpis='+document.getElementById(idnadpis).value+
      '&amp;format='+document.getElementById(idformat).value+
      '&amp;cena1='+document.getElementById(idcena1).value+
      '&amp;cena2='+document.getElementById(idcena2).value+
      '&amp;poznamka='+document.getElementById(idpoznamka).value, 0, 'info_cenik'); return false;\" id=\"tlacitko_pridat\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_cenik');\"></a>
    </fieldset>
  </form>
</div>
      ";
    }
      else
    {
      $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"]));
      $format = stripslashes(htmlspecialchars($_POST["format"]));
      $cena1 = stripslashes(htmlspecialchars($_POST["cena1"]));
      $cena2 = stripslashes(htmlspecialchars($_POST["cena2"]));
      $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"]));

      if (!Empty($nadpis) &&
          !Empty($format) &&
          !Empty($cena1) &&
          !Empty($cena2) &&
          !Empty($poznamka))
      {
        if (@$this->var->mysqli->multi_query("INSERT INTO sekce_cenik (id, nadpis, format, cena1, cena2, poznamka) VALUES
                                              (NULL, '{$nadpis}', '{$format}', '{$cena1}', '{$cena2}', '{$poznamka}');"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla přidána sekce ceníku s názvem: <strong>{$nadpis}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Při přidávání sekce ceníku došlo k chybě.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* edituje sekci ceniku
 *
 * name: EditAdmiCenikSekce
 * @param id, detekce edtace
 * @return formular v html
 */
  function EditAdmiCenikSekce($id, $edit = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, nadpis, format, cena1, cena2, poznamka FROM sekce_cenik WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"cenik_nadpis\" class=\"centralni_text_label baner_cesta_central\">Nadpis sekce ceníku:</label>
      <input type=\"text\" id=\"cenik_nadpis\" value=\"{$data->nadpis}\" />
      <label for=\"cenik_format\" class=\"centralni_text_label baner_top_central\">Formát:</label>
      <input type=\"text\" id=\"cenik_format\" value=\"{$data->format}\" />
      <label for=\"cenik_cena1\" class=\"centralni_text_label baner_left_central\">První cena:</label>
      <input type=\"text\" id=\"cenik_cena1\" value=\"{$data->cena1}\" />
      <label for=\"cenik_cena2\" class=\"centralni_text_label baner_w_central\">Druhá cena:</label>
      <input type=\"text\" id=\"cenik_cena2\" value=\"{$data->cena2}\" />
      <label for=\"cenik_poznamka\" class=\"centralni_text_label baner_h_central\">Poznámka:</label>
      <input type=\"text\" id=\"cenik_poznamka\" value=\"{$data->poznamka}\" />
      <input type=\"button\" value=\"Upravit ceník\" onclick=\"
      idnadpis='cenik_nadpis';
      idformat='cenik_format';
      idcena1='cenik_cena1';
      idcena2='cenik_cena2';
      idpoznamka='cenik_poznamka';
      PoslatAkci('yeseditceniksekce&amp;nadpis='+document.getElementById(idnadpis).value+
      '&amp;format='+document.getElementById(idformat).value+
      '&amp;cena1='+document.getElementById(idcena1).value+
      '&amp;cena2='+document.getElementById(idcena2).value+
      '&amp;poznamka='+document.getElementById(idpoznamka).value, {$id}, 'info_cenik'); return false;\" id=\"tlacitko_upravit\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_cenik');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)  //je-li editovano
    {
      $nadpis = stripslashes(htmlspecialchars($_POST["nadpis"]));
      $format = stripslashes(htmlspecialchars($_POST["format"]));
      $cena1 = stripslashes(htmlspecialchars($_POST["cena1"]));
      $cena2 = stripslashes(htmlspecialchars($_POST["cena2"]));
      $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"]));

      if (!Empty($nadpis) &&
          !Empty($format) &&
          !Empty($cena1) &&
          !Empty($cena2) &&
          !Empty($poznamka))
      {
        if (@$this->var->mysqli->multi_query ("UPDATE sekce_cenik SET nadpis='{$nadpis}',
                                                                      format='{$format}',
                                                                      cena1='{$cena1}',
                                                                      cena2='{$cena2}',
                                                                      poznamka='{$poznamka}'
                                                                      WHERE id={$id};
                                              "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla upravena sekce ceníku s názvem: <strong>{$nadpis}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Při upravování sekce ceníku došlo k chybě.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* smazani sekce ceniku
 *
 * name: SmazAdminCenikSekce
 * @param id, detekce smazani
 * @return formular v html
 */
  function SmazAdminCenikSekce($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, nadpis, format, cena1, cena2, poznamka FROM sekce_cenik WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat sekci ceníku s názvem: <strong>{$data->nadpis}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelceniksekce', {$data->id}, 'info_cenik'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_cenik'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($smazat)  //je-li smazano
      {
        if (@$this->var->mysqli->multi_query("DELETE FROM sekce_cenik WHERE id={$id};"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla smazána sekce ceníku s názvem: <strong>{$data->nadpis}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }

/* prida radek do dane sekce ceniku
 *
 * name: PridejAdminCenikRadek
 * @param void
 * @return formular v html
 */
  function PridejAdminCenikRadek()
  {
    $id = $_GET["id"];
    settype($id, "integer");

    if (!Empty($id) &&
        $id != 0 &&
        $_GET["co"] == "addradek")
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"upraveni_vyhry_form\">
    <fieldset>
      <em class=\"vysvetlivka_form vysvetlivka_form_b\"><em>b</em><cite> - </cite>tučný text</em>
      <em class=\"vysvetlivka_form vysvetlivka_form_i\"><em>i</em><cite> - </cite>kurzivý text</em>
      <em class=\"vysvetlivka_form vysvetlivka_form_u\"><em>u</em><cite> - </cite><strong>podtržený text</strong></em>
      <em class=\"vysvetlivka_form vysvetlivka_form_center\"><em>center</em><cite> - </cite>samostatný text uprostřed</em>
      <p class=\"zarovnani_vlevo\">Formát</p>
      {$this->VypisInterpretu("cenik_format")}
      <textarea id=\"cenik_format\" name=\"format\" rows=\"10\" cols=\"100\"></textarea>
      <p class=\"zarovnani_vlevo\">První cena</p>
      {$this->VypisInterpretu("cenik_cena1")}
      <textarea id=\"cenik_cena1\" name=\"cena1\" rows=\"10\" cols=\"100\"></textarea>
      <p class=\"zarovnani_vlevo\">Druhá cena</p>
      {$this->VypisInterpretu("cenik_cena2")}
      <textarea id=\"cenik_cena2\" name=\"cena2\" rows=\"10\" cols=\"100\"></textarea>
      <p class=\"zarovnani_vlevo\">Poznámka</p>
      {$this->VypisInterpretu("cenik_poznamka")}
      <textarea id=\"cenik_poznamka\" name=\"poznamka\" rows=\"10\" cols=\"100\"></textarea>
      <input type=\"submit\" name=\"tlacitko\" value=\"Přidat řádek\" id=\"tlacitko_pridat\" />
      <a href=\"ajax.php?action=admin&amp;akce=ceny\" title=\"Zavřít okno\"></a>
    </fieldset>
  </form>
</div>
      ";

      if (!Empty($_POST["tlacitko"]))
      {
        $format = stripslashes(htmlspecialchars($_POST["format"]));
        $cena1 = stripslashes(htmlspecialchars($_POST["cena1"]));
        $cena2 = stripslashes(htmlspecialchars($_POST["cena2"]));
        $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"]));

        if (!Empty($format) &&
            !Empty($cena1) &&
            !Empty($cena2) &&
            !Empty($poznamka))
        {
          if (@$this->var->mysqli->multi_query("INSERT INTO cenik (id, sekce, format, cena1, cena2, poznamka) VALUES
                                                (NULL, {$id}, '{$format}', '{$cena1}', '{$cena2}', '{$poznamka}');
                                              "))
          {
            $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl přidán řádek ceníku s ID: <strong>{$id}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
            ";
            $this->AutoClick(1, "ajax.php?action=admin&akce=ceny");
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
          else
        {
          $result = "
 <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při přidávání řádku
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
          $this->AutoClick(1, "ajax.php?action=admin&akce=ceny");
        }
      }
    }

    return $result;
  }

/* upravi dany radek v ceniku
 *
 * name: EditAdmiCenikRadek
 * @param void
 * @return formular v html
 */
  function EditAdmiCenikRadek()
  {
    $id = $_GET["id"];
    settype($id, "integer");

    if (!Empty($id) &&
        $id != 0 &&
        $_GET["co"] == "editradek")
    {
      if ($res = @$this->var->mysqli->query("SELECT id, format, cena1, cena2, poznamka FROM cenik WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"upraveni_vyhry_form\">
    <fieldset>
      <em class=\"vysvetlivka_form vysvetlivka_form_b\"><em>b</em><cite> - </cite>tučný text</em>
      <em class=\"vysvetlivka_form vysvetlivka_form_i\"><em>i</em><cite> - </cite>kurzivý text</em>
      <em class=\"vysvetlivka_form vysvetlivka_form_u\"><em>u</em><cite> - </cite><strong>podtržený text</strong></em>
      <em class=\"vysvetlivka_form vysvetlivka_form_center\"><em>center</em><cite> - </cite>samostatný text uprostřed</em>
      <p class=\"zarovnani_vlevo\">Formát</p>
      {$this->VypisInterpretu("cenik_format")}
      <textarea id=\"cenik_format\" name=\"format\" rows=\"10\" cols=\"100\">{$data->format}</textarea>
      <p class=\"zarovnani_vlevo\">První cena</p>
      {$this->VypisInterpretu("cenik_cena1")}
      <textarea id=\"cenik_cena1\" name=\"cena1\" rows=\"10\" cols=\"100\">{$data->cena1}</textarea>
      <p class=\"zarovnani_vlevo\">Druhá cena</p>
      {$this->VypisInterpretu("cenik_cena2")}
      <textarea id=\"cenik_cena2\" name=\"cena2\" rows=\"10\" cols=\"100\">{$data->cena2}</textarea>
      <p class=\"zarovnani_vlevo\">Poznámka</p>
      {$this->VypisInterpretu("cenik_poznamka")}
      <textarea id=\"cenik_poznamka\" name=\"poznamka\" rows=\"10\" cols=\"100\">{$data->poznamka}</textarea>
      <input type=\"submit\" name=\"tlacitko\" value=\"Upravit řádek\" id=\"tlacitko_upravit\" />
      <a href=\"ajax.php?action=admin&amp;akce=ceny\" title=\"Zavřít okno\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if (!Empty($_POST["tlacitko"]))
      {
        $format = stripslashes(htmlspecialchars($_POST["format"]));
        $cena1 = stripslashes(htmlspecialchars($_POST["cena1"]));
        $cena2 = stripslashes(htmlspecialchars($_POST["cena2"]));
        $poznamka = stripslashes(htmlspecialchars($_POST["poznamka"]));

        if (!Empty($format) &&
            !Empty($cena1) &&
            !Empty($cena2) &&
            !Empty($poznamka))
        {
          if (@$this->var->mysqli->multi_query ("UPDATE cenik SET format='{$format}',
                                                                  cena1='{$cena1}',
                                                                  cena2='{$cena2}',
                                                                  poznamka='{$poznamka}'
                                                                  WHERE id={$id};"))
          {
              $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl upraven řádek ceníku s ID: <strong>{$id}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
              ";
              $this->AutoClick(1, "ajax.php?action=admin&akce=ceny");
          }
            else
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
          else
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při upravení řádku
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
          $this->AutoClick(1, "ajax.php?action=admin&akce=ceny");
        }
      }
    }

    return $result;
  }

/* smazani daneho radku ceniku
 *
 * name: SmazAdminCenikRadek
 * @param idm detekce smazani
 * @return formular v html
 */
  function SmazAdminCenikRadek($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, sekce, format, cena1, cena2, poznamka FROM cenik WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat řádek ceníku s ID: <strong>{$data->id}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelcenikradek', {$data->id}, 'info_cenik'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_cenik'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($smazat)  //je-li smazano
      {
        if (@$this->var->mysqli->multi_query("DELETE FROM cenik WHERE id={$id};"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl smazán řádek ceníku s ID: <strong>{$data->id}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }

/* ulozeni objednavky
 *
 * name: PridejObjednavkuCeniku
 * @param void
 * @return info o dokonceni
 */
  function PridejObjednavkuCeniku()
  {
    $jmeno = stripslashes(htmlspecialchars($_POST["jmeno"]));
    $prijmeni = stripslashes(htmlspecialchars($_POST["prijmeni"]));
    $ulice = stripslashes(htmlspecialchars($_POST["ulice"]));
    $mesto = stripslashes(htmlspecialchars($_POST["mesto"]));
    $psc = stripslashes(htmlspecialchars($_POST["psc"]));
    $telefon = stripslashes(htmlspecialchars($_POST["telefon"]));
    $email = stripslashes(htmlspecialchars($_POST["email"]));
    $text = stripslashes(htmlspecialchars($_POST["text"]));
    $rozliseni = "{$_POST["w"]}x{$_POST["h"]}";
    $hloubka = $_POST["d"];
    $session = session_id();

    if (!Empty($jmeno) &&
        !Empty($prijmeni) &&
        !Empty($telefon) &&
        !Empty($email))
    {
      if (@$this->var->mysqli->multi_query("INSERT INTO objednavka_cenik (id, jmeno, prijmeni, ulice, mesto, psc, telefon, email, pozadavek, datum, ip, agent, session, rozliseni, hloubka)
                                            VALUES (NULL, '{$jmeno}', '{$prijmeni}', '{$ulice}', '{$mesto}', '{$psc}', '{$telefon}', '{$email}', '{$text}', NOW(), '{$_SERVER["REMOTE_ADDR"]}', '{$_SERVER["HTTP_USER_AGENT"]}', '{$session}', '{$rozliseni}', {$hloubka});
                                            "))
      {
        @mail("info@superklik.cz", "Upozorneni na objednávku", "Přišla nová objednávka", $this->var->hlavicky);

        $result = "<p style=\"text-align: center; padding: 10px 0 30px;\">Vaše objednávka byla odeslána ke zpracování</p>";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }
      else
    {
      $result = "<p style=\"text-align: center; padding: 10px 0 30px;\">Nevyplnily jste potřebné údaje</p>";
    }

    return $result;
  }

/* vypis objednavek v ceniku
 *
 * name: VypisAdminObjednavky
 * @param void
 * @return formular v html
 */
  function VypisAdminObjednavky()
  {
    $kip = $_SERVER["REMOTE_ADDR"];
    $result = "";

    if ($res = @$this->var->mysqli->query("SELECT id,
                                          jmeno,
                                          prijmeni,
                                          ulice,
                                          mesto,
                                          psc,
                                          telefon,
                                          email,
                                          pozadavek,
                                          DATE_FORMAT(datum, '%d.%m. %Y. %H:%i:%s') as datum,
                                          ip,
                                          agent,
                                          session,
                                          rozliseni,
                                          hloubka
                                          FROM objednavka_cenik
                                          ORDER BY objednavka_cenik.id ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->ipblok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);

          $result .=
          "
<div class=\"definicni_vycty\">
  <dl>
    <dt>Jméno:</dt>
    <dd>{$data->jmeno}</dd>
  </dl>
  <dl>
    <dt>Příjmení:</dt>
    <dd>{$data->prijmeni}</dd>
  </dl>
  <dl>
    <dt>Ulice:</dt>
    <dd>{$data->ulice}</dd>
  </dl>
  <dl>
    <dt>Město:</dt>
    <dd>{$data->mesto}</dd>
  </dl>
  <dl>
    <dt>PSČ:</dt>
    <dd>{$data->psc}</dd>
  </dl>
  <dl>
    <dt>Telefon:</dt>
    <dd>{$data->telefon}</dd>
  </dl>
  <dl>
    <dt>E-mail:</dt>
    <dd>{$data->email}</dd>
  </dl>
  <dl>
    <dt>Datum:</dt>
    <dd>{$data->datum}</dd>
  </dl>
</div>
<p class=\"pozadavek_objednavky\">{$data->pozadavek}</p>
<a href=\"#\" onclick=\"PoslatAkci('delobjednavka', {$data->id}, 'info_cenik');\" class=\"smazat_objednavku\"></a>
          ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/*
 *
 * name: SmazAdminObjednavku
 * @param id, detekce smazani
 * @return informace o smazani
 */
  function SmazAdminObjednavku($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat objednávku s ID: <strong>{$id}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelobjednavka', {$id}, 'info_cenik'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_cenik'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
      ";
    }

    if ($smazat)
    {
      if (@$this->var->mysqli->multi_query("DELETE FROM objednavka_cenik WHERE id={$id};"))
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byla smazána objednávka s ID: <strong>{$id}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }


/********************** < NASTAVENI > **********************/


/*
 *
 * name: CtiNastaveni
 * @param jmeno promenne
 * @return hodnota
 */
  function CtiNastaveni($jmeno)
  {
    if ($res = @$this->var->mysqli->query("SELECT hodnota FROM nastaveni WHERE promenna='{$jmeno}';"))
    {
      if ($res->num_rows == 1)
      {
        $result = $res->fetch_object()->hodnota;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* nastaveni promenne na novou hodnotu
 *
 * name: SetNastaveni
 * @param jmeno promenne, haska editace, priznak editace
 * @return vystupni formular
 */
  function SetNastaveni($jmeno, $hlaska, $outelment, $edit = false)
  {
    if (!Empty($jmeno))
    {
      if ($res = @$this->var->mysqli->query("SELECT hodnota FROM nastaveni WHERE promenna='{$jmeno}';"))
      {
        if ($res->num_rows == 1)
        {
          $hodnota = $res->fetch_object()->hodnota;

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"promenna_hodnota\" id=\"centralni_text_label\">{$hlaska}</label>
      <input type=\"text\" id=\"promenna_hodnota\" value=\"{$hodnota}\" />
      <input type=\"button\" value=\"Upravit hodnotu\" onclick=\"
      hodonotaid='promenna_hodnota';
      PoslatAkci('yeseditvar&amp;var={$jmeno}&amp;out={$outelment}&amp;hodnota='+document.getElementById(hodonotaid).value, 0, '{$outelment}');\" id=\"tlacitko_upravit\" />
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, '{$outelment}');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)
    {
      $hodnota = stripslashes(htmlspecialchars($_POST["hodnota"]));

      if (@$this->var->mysqli->multi_query("UPDATE nastaveni SET hodnota='{$hodnota}'
                                                              WHERE promenna='{$jmeno}';
                                            "))
      {
        $result = "
<div id=\"centralni_polozka_upravit\">
  <p>
    Byla nastavena hodnota: <strong>{$hodnota}</strong>
  </p>
  <span class=\"nacitani_obrazek\"></span>
</div>
";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }


/********************** < BANERY > **********************/


/* vypis banneru do stranek
 *
 * name: VypisBaner
 * @param void
 * @return vypis v html
 */
  function VypisBaner()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, cesta, pos_top, pos_left, width, height, posledni
                                          FROM banner
                                          ORDER BY banner.id ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
              <div class=\"reklama_{$data->id}\" style=\"position: absolute; width: {$data->width}px; height: {$data->height}px; z-index: 10; top: {$data->pos_top}px; left: {$data->pos_left}px;\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$data->cesta}\" width=\"{$data->width}\" height=\"{$data->height}\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0\" width=\"{$data->width}\" height=\"{$data->height}\">
                    <param name=\"movie\" value=\"{$data->cesta}\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#2e2e2e\" />
                    <param name=\"wmode\" value=\"transparent\" />

                    <param name=\"quality\" value=\"low\" />
                    <param name=\"scale\" value=\"exactfit\" />
                    <p class=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>
              ".($data->posledni ? "" : "<span class=\"linka_pod_flashem\" style=\"top: ".($data->pos_top + $data->height)."px; left: {$data->pos_left}px; \"></span>")."
          ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypise bubny
 *
 * name: VypisAdminBaner
 * @param void
 * @return  vypis v html
 */
  function VypisAdminBaner()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, cesta, pos_top, pos_left, width, height, posledni
                                          FROM banner
                                          ORDER BY banner.id ASC;
                                          "))
    {
      $result .=
      "
<a href=\"#\" onclick=\"PoslatAkci('addbaner', 0, 'info_baner');\" id=\"pridat_baner\">
  <span></span>
  Přidat banner
</a>
      ";
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $result .=
          "
<h4".($i == 0 ? " class=\"vetsi_odsazeni\"" : "").">
  Číslo banneru: {$data->id}
  <a href=\"#\" onclick=\"PoslatAkci('editbaner', {$data->id}, 'info_baner');\" title=\"Upravit banner\" class=\"upravit_sekci_odkaz\">
    <span>
      Upravit banner
    </span>
  </a>
  <a href=\"#\" onclick=\"PoslatAkci('delbaner', {$data->id}, 'info_baner');\" title=\"Smazat banner\" class=\"smazat_sekci_odkaz\">
    <span>
      Smazat banner
    </span>
  </a>
</h4>
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">Cesta k banneru:</strong> {$data->cesta}
</p>
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">Délka:</strong> {$data->width}
</p>
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">Výška:</strong> {$data->height}
</p>
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">Pozice zhora:</strong> {$data->pos_top}
</p>
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">Pozice zleva:</strong> {$data->pos_left}
</p>
<p class=\"odstavec_ve_faq\">
  <strong class=\"otazka\">Poslední banner v sloupci:</strong> <cite>".($data->posledni ? "Ano" : "Ne")."</cite>
</p>
          ";
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* prida baner
 *
 * name: PridejAdminBaner
 * @param priznak pridani
 * @return formular v html
 */
  function PridejAdminBaner($add = false)
  {
    if (!$add)
    {
      $result =
      "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"baner_cesta\" class=\"centralni_text_label baner_cesta_central\">Cesta k banneru:</label>
      <input type=\"text\" id=\"baner_cesta\" />
      <label for=\"baner_top\" class=\"centralni_text_label baner_top_central\">Pozice zhora:</label>
      <input type=\"text\" id=\"baner_top\" />
      <label for=\"baner_left\" class=\"centralni_text_label baner_left_central\">Pozice zleva:</label>
      <input type=\"text\" id=\"baner_left\" />
      <label for=\"baner_w\" class=\"centralni_text_label baner_w_central\">Délka:</label>
      <input type=\"text\" id=\"baner_w\" />
      <label for=\"baner_h\" class=\"centralni_text_label baner_h_central\">Výška:</label>
      <input type=\"text\" id=\"baner_h\" />
      <label for=\"baner_posl\" class=\"centralni_text_label baner_posl_central\">Poslední banner v sloupci:</label>
      <input type=\"checkbox\" id=\"baner_posl\" />
      <input type=\"button\" value=\"Přidat banner\" onclick=\"
      idcesta='baner_cesta';
      idtop='baner_top';
      idleft='baner_left';
      idw='baner_w';
      idh='baner_h';
      idposl='baner_posl';
      PoslatAkci('yesaddbaner&amp;cesta='+document.getElementById(idcesta).value+
      '&amp;top='+document.getElementById(idtop).value+
      '&amp;left='+document.getElementById(idleft).value+
      '&amp;w='+document.getElementById(idw).value+
      '&amp;h='+document.getElementById(idh).value+
      '&amp;posl='+document.getElementById(idposl).checked
      , 0, 'info_baner'); return false;\" id=\"tlacitko_pridat\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_baner');\"></a>
    </fieldset>
  </form>
</div>
      ";
    }
      else
    {
      $cesta = stripslashes(htmlspecialchars($_POST["cesta"]));
      $top = $_POST["top"];
      settype($top, "integer");
      $left = $_POST["left"];
      settype($left, "integer");
      $w = $_POST["w"];
      settype($w, "integer");
      $h = $_POST["h"];
      settype($h, "integer");
      $posledni = $_POST["posl"];

      if (!Empty($cesta) &&
          $w != 0 &&
          $h != 0)
      {
        if (@$this->var->mysqli->multi_query("INSERT INTO banner (id, cesta, pos_top, pos_left, width, height, posledni) VALUES
                                              (NULL, '{$cesta}', {$top}, {$left}, {$w}, {$h}, {$posledni});
                                             "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl přidán banner s cestou: <strong>{$cesta}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Při přidávání banneru došlo k chybě.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* edituje dany baner
 *
 * name: EditAdmiBaner
 * @param id, priznak editace
 * @return formular v html
 */
  function EditAdmiBaner($id, $edit = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, cesta, pos_top, pos_left, width, height, posledni FROM banner WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"baner_cesta\" class=\"centralni_text_label baner_cesta_central\">Cesta k banneru:</label>
      <input type=\"text\" id=\"baner_cesta\" value=\"{$data->cesta}\" />
      <label for=\"baner_top\" class=\"centralni_text_label baner_top_central\">Pozice zhora:</label>
      <input type=\"text\" id=\"baner_top\" value=\"{$data->pos_top}\" />
      <label for=\"baner_left\" class=\"centralni_text_label baner_left_central\">Pozice zleva:</label>
      <input type=\"text\" id=\"baner_left\" value=\"{$data->pos_left}\" />
      <label for=\"baner_w\" class=\"centralni_text_label baner_w_central\">Délka:</label>
      <input type=\"text\" id=\"baner_w\" value=\"{$data->width}\" />
      <label for=\"baner_h\" class=\"centralni_text_label baner_h_central\">Výška:</label>
      <input type=\"text\" id=\"baner_h\" value=\"{$data->height}\" />
      <label for=\"baner_posl\" class=\"centralni_text_label baner_posl_central\">Poslední banner v sloupci:</label>
      <input type=\"checkbox\" id=\"baner_posl\"".($data->posledni ? " checked=\"checked\"" : "")." />
      <input type=\"button\" value=\"Upravit banner\" onclick=\"
      idcesta='baner_cesta';
      idtop='baner_top';
      idleft='baner_left';
      idw='baner_w';
      idh='baner_h';
      idposl='baner_posl';
      PoslatAkci('yeseditbaner&amp;cesta='+document.getElementById(idcesta).value+
      '&amp;top='+document.getElementById(idtop).value+
      '&amp;left='+document.getElementById(idleft).value+
      '&amp;w='+document.getElementById(idw).value+
      '&amp;h='+document.getElementById(idh).value+
      '&amp;posl='+document.getElementById(idposl).checked
      , {$id}, 'info_baner'); return false;\" id=\"tlacitko_upravit\">
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, 'info_baner');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)  //je-li editovano
    {
      $cesta = stripslashes(htmlspecialchars($_POST["cesta"]));
      $top = $_POST["top"];
      settype($top, "integer");
      $left = $_POST["left"];
      settype($left, "integer");
      $w = $_POST["w"];
      settype($w, "integer");
      $h = $_POST["h"];
      settype($h, "integer");
      $posledni = $_POST["posl"];

      if (!Empty($cesta) &&
          $w != 0 &&
          $h != 0)
      {
        if (@$this->var->mysqli->multi_query("UPDATE banner SET cesta='{$cesta}',
                                                                pos_top={$top},
                                                                pos_left={$left},
                                                                width={$w},
                                                                height={$h},
                                                                posledni={$posledni}
                                                                WHERE id={$id};
                                              "))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl upraven banner s cestou: <strong>{$cesta}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Při upravování banneru došlo k chybě.
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
    }

    return $result;
  }

/* smaze dany baner
 *
 * name: SmazAdminBaner
 * @param id, detekce smazani
 * @return formular v html
 */
  function SmazAdminBaner($id, $smazat = false)
  {
    settype($id, "integer");

    if ($id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, cesta, pos_top, pos_left, width, height, posledni FROM banner WHERE id={$id};"))
      {
        if ($res->num_rows == 1)
        {
          $data = $res->fetch_object();

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <p>Opravdu chcete smazat banner s cestou: <strong>{$data->cesta}</strong> ?</p>
      <input type=\"button\" value=\"Ano\" onclick=\"PoslatAkci('yesdelbaner', {$data->id}, 'info_baner'); return false;\" id=\"tlacitko_ano\" />
      <input type=\"button\" value=\"Ne\" onclick=\"PoslatAkci('', 0, 'info_baner'); return false;\" id=\"tlacitko_ne\" />
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }

      if ($smazat)  //je-li smazano
      {
        if (@$this->var->mysqli->multi_query("DELETE FROM banner WHERE id={$id};"))
        {
          $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Byl smazán banner s cestou: <strong>{$data->cesta}</strong>
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
          ";
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
        }
      }
    }

    return $result;
  }


/********************** < HROMADNA POSTA > **********************/


/* hromadne rozesilani emailu
 *
 * name: PoslatHromadnouPostu
 * @param void
 * @return formular v html
 */
  function PoslatHromadnouPostu()
  {
    $result = "";
    $vypis = "";
    $pro = "";
    if ($res = @$this->var->mysqli->query("SELECT login, email FROM uzivatel ORDER BY uzivatel.id"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $vypis .=
          "
<dl class=\"vypis_loginu_mailu\">
  <dt>
    {$data->login}
  </dt>
  <dd>
    {$data->email}
  </dd>
</dl>
          ";
          $pro .= "{$data->email}, ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $pro = substr($pro, 0, -2); //odebrani carky

    $result .=
    "
<div id=\"hromadne_rozesilani_mailu\">
  <form action=\"\" method=\"post\" class=\"upraveni_vyhry_form\">
    <fieldset>
      <dl>
        <dt>
          <label for=\"hromadna_zprava_predmet\">Předmět:</label>
        </dt>
        <dd>
          <input type=\"text\" id=\"hromadna_zprava_predmet\" name=\"predmet\" />
        </dd>
      </dl>
      <dl>
        <dt>
          <label for=\"hromadna_zprava\">Zpráva:</label>
        </dt>
        <dd>
          <textarea id=\"hromadna_zprava\" name=\"zprava\" rows=\"10\" cols=\"100\"></textarea>
        </dd>
      </dl>
      <input type=\"submit\" name=\"tlacitko\" value=\"Odeslat e-mail všem registrovaným uživatelům\" id=\"tlacitko_odeslat_maily\">
    </fieldset>
  </form>
</div>
{$vypis}
    ";

    if (!Empty($_POST["tlacitko"]) &&
        !Empty($_POST["predmet"]) &&
        !Empty($_POST["zprava"]))
    {
      $predmet = stripslashes(htmlspecialchars($_POST["predmet"]));
      $zprava = stripslashes(htmlspecialchars($_POST["zprava"]));

      if (@mail($pro, $predmet, $zprava, $this->var->hlavicky))
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Hromadný e-mail byl odeslán
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";
      }
        else
      {
        $result = "
  <div id=\"centralni_polozka_upravit\">
    <p>
      Nastala chyba při hromadném odesílání e-mailu
    </p>
    <span class=\"nacitani_obrazek\"></span>
  </div>
        ";;
      }

      $this->AutoClick(3, "ajax.php?action=admin&akce=hrom");
    }

    return $result;
  }


/********************** < POČÍTADLO > **********************/


/* zapocitani pocitadla
 *
 * name: PridejPocitadlo
 * @param width, height, depth
 * @return void
 */
  function PridejPocitadlo($w, $h, $d)
  {
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $session = session_id();
    settype($w, "integer");
    settype($h, "integer");
    $rozliseni = "{$w}x{$h}";
    settype($d, "integer");
    $hloubka = $d;
    $uzivatel = $_SESSION["IDUSER"];
    settype($uzivatel, "integer");
    $jmeno = $_SESSION["SLOGIN"];

    if (!Empty($session))
    {
      if ($res = @$this->var->mysqli->query("SELECT id, pocet, cas, jmeno FROM adresa WHERE session='{$session}';"))
      {
        if ($res->num_rows == 0)
        {
          if (!@$this->var->mysqli->multi_query("INSERT INTO adresa (id, ip, uzivatel, jmeno, agent, cas, rozliseni, hloubka, session, pocet) VALUES
                                                (NULL, '{$ip}', '{$uzivatel}', '{$jmeno}', '{$agent}', NOW(), '{$rozliseni}', {$hloubka}, '{$session}', 1);"))
          {
            $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
          }
        }
          else
        {
          $data = $res->fetch_object();
          $dat = strtotime($data->cas);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat) + $this->var->expiracepocitadla, date("s", $dat), date("n", $dat), date("j", $dat), date("Y", $dat)));  //expirace pocitadla, predpocitane datum
          $pocet = $data->pocet + 1;

          if (date("Y-m-d H:i:s") > $datum || (!Empty($jmeno) && Empty($data->jmeno))) //urci jak dlouho bude rozestup mezi kontrolami - poc
          {
            if (!@$this->var->mysqli->multi_query ("UPDATE adresa SET ip='{$ip}',
                                                                      uzivatel='{$uzivatel}',
                                                                      jmeno='{$jmeno}',
                                                                      agent='{$agent}',
                                                                      cas=NOW(),
                                                                      rozliseni='{$rozliseni}',
                                                                      hloubka={$hloubka},
                                                                      pocet={$pocet}
                                                                      WHERE id={$data->id};
                                                  "))
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error."kok");  //chyba do globalni promenne
      }
    }
  }

/* vypis pocitadla
 *
 * name: VypisAdminPocitadlo
 * @param void
 * @return vypis v html
 */
  function VypisAdminPocitadlo($str)
  {
    $kip = $_SERVER["REMOTE_ADDR"];
    $strankovani = $this->Strankovani("adresa", $str, "vypispoc", "vypis_poc", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, ip, uzivatel, jmeno, agent, cas, rozliseni, hloubka, session, pocet
                                          FROM adresa
                                          ORDER BY adresa.cas DESC
                                          {$limit};
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "{$strankovani}";

        while ($data = $res->fetch_object())
        {
          $dat = strtotime($data->cas);
          $cas = date("H:i:s d.m.Y", $dat);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat) + $this->var->expiraceadresy, date("j", $dat), date("Y", $dat)));  //expirace
          $expcas = date("H:i:s d.m.Y", strtotime($datum));
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->ipblok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);

          $result .=
          "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central login_pocitadla\">".(!Empty($data->jmeno) ? "{$data->jmeno}" : "---")."</span>
  <span class=\"hodnota_pocitadla_central pocet_pristupu_pocitadla\">{$data->pocet}x</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$cas}</span>
  <span class=\"hodnota_pocitadla_central expirace_cas_pocitadla\">{$expcas}</span>
  <span class=\"hodnota_pocitadla_central operacni_system_pocitadla\">{$os}</span>
  <span class=\"hodnota_pocitadla_central prohlizec_pocitadla\">{$browser}</span>
  <span class=\"hodnota_pocitadla_central ip_adresa_pocitadla\">{$ip}</span>
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">{$host}</span>
  <span class=\"hodnota_pocitadla_central rozliseni_pocitadla\">{$data->rozliseni} x {$data->hloubka}</span>
  <span class=\"hodnota_pocitadla_central zeme_puvodu_pocitadla\"><a href=\"#\" onclick=\"PoslatAkci('zjistizemi', {$ipnum}, 'info_poc'); return false;\" title=\"Země původu\">Země původu</a></span>
</p>
          ";

          if (date("Y-m-d H:i:s") > $datum)
          {
            if (!@$this->var->mysqli->multi_query("DELETE FROM adresa WHERE id={$data->id};"))
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypis konecneho cisla pocitadla
 *
 * name: CisloPocitadlaPristupu
 * @param void
 * @return pocet pristupu
 */
  function CisloPocitadlaPristupu()
  {
    if ($res = @$this->var->mysqli->query("SELECT SUM(pocet) as pocet
                                          FROM adresa;
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $result = $res->fetch_object()->pocet;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }


/********************** < LOGOVANI > **********************/


/* prida logovani
 *
 * name: PridejLogovani
 * @param login, heslo, prostup, wigth, height, deph
 * @return void
 */
  function PridejLogovani($login, $heslo, $pristup, $w, $h, $d)
  {
    $login = addslashes(base64_encode($login));
    $heslo = addslashes(base64_encode($heslo));
    $ip = $_SERVER["REMOTE_ADDR"];
    $agent = $_SERVER["HTTP_USER_AGENT"];
    $session = session_id();
    settype($w, "integer");
    settype($h, "integer");
    $rozliseni = "{$w}x{$h}";
    settype($d, "integer");
    $hloubka = $d;

    if (!@$this->var->mysqli->multi_query("INSERT INTO logovani (id, login, heslo, pristup, agent, session, cas, rozliseni, hloubka, ip) VALUES
                                          (NULL, '{$login}', '{$heslo}', '{$pristup}', '{$agent}', '{$session}', NOW(), '{$rozliseni}', {$hloubka}, '{$ip}');"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }
  }

/* vypis logovani na web
 *
 * name: VypisAdminLogovani
 * @param void
 * @return vypis v html
 */
  function VypisAdminLogovani($str)
  {
    $kip = $_SERVER["REMOTE_ADDR"];
    $strankovani = $this->Strankovani("logovani", $str, "vypislog", "vypis_log", $limit);
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT id, login, heslo, pristup, agent, session, cas, rozliseni, hloubka, ip
                                          FROM logovani
                                          ORDER BY logovani.id DESC
                                          {$limit};
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $result .= "{$strankovani}";
        while ($data = $res->fetch_object())
        {
          $login = base64_decode($data->login);
          $heslo = base64_decode($data->heslo);
          $stav = ($data->pristup ? "<span class=\"povoleny_pristup pristup\" title=\"Přístup povolen\"></span>" : "<span class=\"nepovoleny_pristup pristup\" title=\"Přístup nepovolen\"></span>");
          $dat = strtotime($data->cas);
          $cas = date("H:i:s d.m.Y", $dat);
          $datum = date("Y-m-d H:i:s", mktime(date("H", $dat), date("i", $dat), date("s", $dat), date("n", $dat), date("j", $dat) + $this->var->expiracelogovani, date("Y", $dat)));  //expirace
          $expcas = date("H:i:s d.m.Y", strtotime($datum));
          $agent = $data->agent;
          $os = $this->ZjistiOS($agent);
          $browser = $this->ZjistiBrowser($agent);
          $ip = $data->ip;
          $host = (in_array($kip, $this->var->ipblok) ? "localhost" : gethostbyaddr($ip)); //host
          $ipnum = $this->VypocetIpNum($ip);

          $result .=
          "
<p class=\"odstavec_hodnoty_pocitadla\">
  <span class=\"hodnota_pocitadla_central login_pocitadla\">{$login}</span>
  <span class=\"hodnota_pocitadla_central heslo_pocitadla\" title=\"{$heslo}\">****</span>
  <span class=\"hodnota_pocitadla_central pocet_pristupu_pocitadla\">{$stav}</span>
  <span class=\"hodnota_pocitadla_central cas_pristupu_pocitadla\">{$cas}</span>
  <span class=\"hodnota_pocitadla_central expirace_cas_pocitadla\">{$expcas}</span>
  <span class=\"hodnota_pocitadla_central ip_adresa_pocitadla\">{$ip}</span>
  <span class=\"hodnota_pocitadla_central operacni_system_pocitadla\">{$os}</span>
  <span class=\"hodnota_pocitadla_central prohlizec_pocitadla\">{$browser}</span>
  <span class=\"hodnota_pocitadla_central hostitel_pocitadla\">{$host}</span>
  <span class=\"hodnota_pocitadla_central rozliseni_pocitadla\">{$data->rozliseni} x {$data->hloubka}</span>
  <span class=\"hodnota_pocitadla_central zeme_puvodu_pocitadla\"><a href=\"#\" onclick=\"PoslatAkci('zjistizemi', {$ipnum}, 'info_log'); return false;\" title=\"Země původu\">Země původu</a></span>
</p>
          ";

          if (date("Y-m-d H:i:s") > $datum)
          {
            if (!@$this->var->mysqli->multi_query("DELETE FROM logovani WHERE id={$data->id};"))
            {
              $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
            }
          }
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }


/********************** < TEXTY > **********************/


/* vrati hodnotu textu z dane sekce
 *
 * name: VypisTexty
 * @param nazev sekce textu
 * @return text
 */
  function VypisTexty($sekce)
  {
    if ($res = @$this->var->mysqli->query("SELECT text
                                          FROM texty
                                          WHERE sekce='{$sekce}';
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $result = $res->fetch_object()->text;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* edituje texty
 *
 * name: SetTexty
 * @param sekce, hlaska upravy, vystupni element, detekce editace
 * @return formular v html
 */
  function SetTexty($sekce, $hlaska, $outelment, $edit = false)
  {
    if (!Empty($sekce))
    {
      if ($res = @$this->var->mysqli->query("SELECT text FROM texty WHERE sekce='{$sekce}';"))
      {
        if ($res->num_rows == 1)
        {
          $hodnota = $res->fetch_object()->text;

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\" class=\"pridavani_faq_delsi\">
    <fieldset>
      <label for=\"promenna_hodnota\" id=\"centralni_text_label\" style=\"left: 28px;\">{$hlaska}</label>
      <input type=\"text\" id=\"promenna_hodnota\" value=\"{$hodnota}\" style=\"width: 280px;\" />
      <input type=\"button\" value=\"Upravit text\" onclick=\"
      hodonotaid='promenna_hodnota';
      PoslatAkci('yesedittex&amp;var={$sekce}&amp;out={$outelment}&amp;hodnota='+document.getElementById(hodonotaid).value, 0, '{$outelment}');\" id=\"tlacitko_upravit\" />
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, '{$outelment}');\" style=\"margin-right: 0;\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)
    {
      $hodnota = stripslashes(htmlspecialchars($_POST["hodnota"]));

      if (@$this->var->mysqli->multi_query ("UPDATE texty SET text='{$hodnota}'
                                                          WHERE sekce='{$sekce}';
                                            "))
      {
        $result = "
<div id=\"centralni_polozka_upravit\">
  <p>
    Byl upraven reklamní text: <strong>{$hodnota}</strong>
  </p>
  <span class=\"nacitani_obrazek\"></span>
</div>
";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* upravuje bool hodnoty v textech
 *
 * name: SetTextyBool
 * @param sekce, haska pri editaci, vystupn element
 * @return formular v html
 */
  function SetTextyBool($sekce, $hlaska, $outelment, $edit = false)
  {
    if (!Empty($sekce))
    {
      if ($res = @$this->var->mysqli->query("SELECT text FROM texty WHERE sekce='{$sekce}';"))
      {
        if ($res->num_rows == 1)
        {
          $hodnota = $res->fetch_object()->text;

          $result =
          "
<div id=\"centralni_polozka_upravit\">
  <form action=\"\" method=\"post\">
    <fieldset>
      <label for=\"promenna_hodnota\" id=\"centralni_text_label\">{$hlaska}</label>
      <input type=\"checkbox\" id=\"promenna_hodnota\"".($hodnota ? " checked=\"checked\"" : "")." style=\"width: 30px; margin-top: 12px; margin-left: 10px;\" />
      <input type=\"button\" value=\"Nastavit zobrazení\" onclick=\"
      hodonotaid='promenna_hodnota';
      PoslatAkci('yesedittexbool&amp;var={$sekce}&amp;out={$outelment}&amp;hodnota='+document.getElementById(hodonotaid).checked, 0, '{$outelment}');\" id=\"tlacitko_upravit_obrazek\" />
      <a href=\"#\" title=\"Zavřít okno\" onclick=\"PoslatAkci('', 0, '{$outelment}');\"></a>
    </fieldset>
  </form>
</div>
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    if ($edit)
    {
      $hodnota = stripslashes(htmlspecialchars($_POST["hodnota"]));

      if (@$this->var->mysqli->multi_query ("UPDATE texty SET text={$hodnota}
                                                          WHERE sekce='{$sekce}';
                                            "))
      {
        $result = "
<div id=\"centralni_polozka_upravit\">
  <p>
    Byla nastavena hodnota.
  </p>
  <span class=\"nacitani_obrazek\"></span>
</div>
";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
      }
    }

    return $result;
  }

/* vypise skrypt pro jezdici text
 *
 * name: VypisPoleJezdicihoTextu
 * @param void
 * @return texty reklami
 */
  function VypisPoleJezdicihoTextu()
  {
    $poc = 1;
    $result = "";
    for ($i = 1; $i <= 5; $i++)
    {
      $hodnota =  $this->VypisTexty("rekl_text{$i}");
      if (!Empty($hodnota))
      {
        $result .=
        "line[{$poc}]=\"{$hodnota}\";
              ";
        $poc++;
      }
    }

    return $result;
  }


/********************** < OSTATNI > **********************/


/* zjisti typ prohlizece
 *
 * name: ZjistiBrowser
 * @param net agent
 * @return prohlizec
 */
  function ZjistiBrowser($agent)
  { //obsaj prejat a opraven z: programy.wz.cz
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

    foreach($BrowserList as $Browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if ($matches)
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $Browser = str_replace("\\{$i}", $matches[$i], $Browser);
          }
        }
        break;
      }
    }

    return trim($Browser);
  }


/* zjisti operacni system
 *
 * name: ZjistiOS
 * @param net agent
 * @return operacni system
 */
  function ZjistiOS($agent) //zjisteni operacniho systemu
  { //obsaj prejat a opraven z: programy.wz.cz
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

    foreach($OSList as $OS => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if ($matches)
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $OS = str_replace("\\{$i}", $matches[$i], $OS);
          }
          break;
        }
      }
    }

    return trim($OS);
  }


/* zjisti zemi puvodu podle IP
 *
 * name: ZjistiZemi
 * @param ip adresa
 * @return nazev zeme
 */
  function ZjistiZemi($ipnum) //vraceni zeme, jen na zavolani
  {
    $this->var->main->StartCas();
    ini_set("memory_limit", "100M");  //nasosne si 100MB

    $sloup = 6;
    $soubor = "./data/GeoIPCountryWhois.csv";
    $u = fopen($soubor, "r");
    $data = explode("+", fread($u, filesize($soubor)));
    fclose($u);

    $result = "";
    for ($i = 0; $i <= count($data) / $sloup; $i++)
    {
      $od = $data[($i * $sloup) + 2];
      $do = $data[($i * $sloup) + 3];

      if ($od <= $ipnum && $do >= $ipnum)
      {
        $ozn = $data[($i * $sloup) + 4];
        $zeme = $data[($i * $sloup) + 5];

        $flag = strtolower($ozn); //prevedeni na male pismena

        $result = "
<div id=\"zeme_puvodu\">
  <span style=\"background: url(./obr/vlajky/{$flag}.png) no-repeat center top;\"></span>
  <strong>{$zeme} ({$ozn})</strong>";

        break;
      }
    }

    if (Empty($result))
    {
      $result = "
<div id=\"zeme_puvodu\">
  <strong>Nebyla nalezena země</strong>
      ";
    }

    $result .=
    "
  <em>{$this->var->main->KonecCas()}</em>
  <a href=\"#\" onclick=\"document.getElementById('zeme_puvodu').style.display='none'; return false;\" title=\"Zavřít okno\"></a>
</div>
    ";

    return $result;
  }

/* vypocet cisla pro zjisteni zeme
 *
 * name: VypocetIpNum
 * @param ip adresa
 * @return cislo pro vyhledani v databazi zemi
 */
  function VypocetIpNum($ip)  //vypocet cisla pro zjisteni zeme z IP
  {
    $a = explode(".", $ip);
    $result = 16777216 * $a[0] + 65536 * $a[1] + 256 * $a[2] + $a[3];

    return $result;
  }

/* strakovaci funkce
 *
 * name: Strankovani
 * @param nazev tabulky, akce pro ajax, vystupni element, &SQL limit do DB
 * @return prechody po strankach
 */
  function Strankovani($tabulka, $strana, $akce, $vystup, &$limit)
  {
    $pocet = $this->PocetRadkuTabulky($tabulka);  //pocet radku taulky
    $pocetstran = ceil($pocet / $this->var->strankovani);  //vypocteny pocet stran podle strankovani

    settype($strana, "integer");

    $mezai = false;
    $jdi = "";
    if ($pocetstran > 7)
    {
      for ($i = 0; $i < 3; $i++)
      {
        $str = $i * $this->var->strankovani; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ";
        }
      }

      if (($strana / $this->var->strankovani) >= 2 && ($strana / $this->var->strankovani) <= ($pocetstran - 3))
      {
        $mezi = true;
      }
        else
      {
        $jdi .= "..., ";
      }

      for ($i = $pocetstran - 3; $i < $pocetstran; $i++)
      {
        $str = $i * $this->var->strankovani; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ";
        }
      }
    }
      else
    {
      for ($i = 0; $i < $pocetstran; $i++)
      {
        $str = $i * $this->var->strankovani; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ";
        }
      }
    }

    if ($mezi)
    {
      $i = 0;
      $str = $i * $this->var->strankovani; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi = "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ..., ";

      $i = ($strana / $this->var->strankovani) - 1;
      $str = $i * $this->var->strankovani; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ";

      $i = ($strana / $this->var->strankovani);
      $str = $i * $this->var->strankovani; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "{$poc}</a>, ";

      $aktualni = $poc;

      $i = ($strana / $this->var->strankovani) + 1;
      $str = $i * $this->var->strankovani; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ..., ";

      $i = $pocetstran - 1;
      $str = $i * $this->var->strankovani; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"#\" onclick=\"PoslatAkci('{$akce}&amp;str={$str}', 0, '{$vystup}'); return false;\">{$poc}</a>, ";
    }

    $jdi = substr($jdi, 0, -2); //odebrani carky

    $limit = "LIMIT {$strana}, {$this->var->strankovani}"; //dodatecny dotaz do DB

    $result =
    "
    <div id=\"strankovani\">
      {$jdi}
      <p id=\"vpravo\">
        Strana: {$aktualni} z {$pocetstran}
      </p>
    </div>
    ";

    return $result;
  }


/********************** < UVODNI SEKCE > **********************/


/* vypise vyhru mesice
 *
 * name: AktualniVyhra
 * @param void
 * @return vrati vyhru aktualniho mesice
 */
  function AktualniVyhra()
  {
    if ($res = @$this->var->mysqli->query("SELECT popis FROM vyhry WHERE aktivni=true;"))
    {
      if ($res->num_rows != 0)
      {
        $result = "<p>Vyhry pro tento měsíc:</p>";
        while ($data = $res->fetch_object())
        {
          $popis = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->popis);
          $popis = substr($popis, 0, 50);
          $popis = iconv("UTF-8", "UTF-8", $popis); //uhlazeni diakritiky

          $result .= "<p>&raquo;{$popis}...</p>";
        }
      }
        else
      {
        $result = "<p>Žádné vyhry nejsou pro tento měsíc vybráné</p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypise autorizovane a neautorizovane uzivatele
 *
 * name: PocetUzivatelu
 * @param void
 * @return vypis v html
 */
  function PocetUzivatelu()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT COUNT(id) as pocet, autorizace FROM uzivatel GROUP BY autorizace;"))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $pocet[$i] = $data->pocet;
          $autor[$i] = $data->autorizace;
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $result .=
    "<p><br /></p>";

    for ($i = 0; $i < count($pocet); $i++)
    {
      if ($autor[$i])
      {
        $result .=
        "
        <p>{$pocet[$i]}x autorizovaných užvatelů</p>
        ";
      }
        else
      {
        $result .=
        "
        <p>{$pocet[$i]}x neautorizovaných užvatelů</p>
        ";
      }
    }

    //kontrola duplicity uzivatelu podle emalu a adresy!!
    if ($res = @$this->var->mysqli->query("SELECT
                                          a.id,
                                          a.login,
                                          a.email,
                                          a.jmeno,
                                          a.prijmeni
                                          FROM
                                          uzivatel as a,
                                          uzivatel as b
                                          WHERE
                                          a.email=b.email AND
                                          a.login!=b.login
                                          GROUP BY
                                          a.id,
                                          a.jmeno;"))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "<p><br />Duplicita uživatelů podle emailu:</p>";

        while ($data = $res->fetch_object())
        {
          $result .=
          "<p>&otimes; login: <strong>{$data->login}</strong>, E-mail: <strong>{$data->email}</strong></p>
          ";
        }

        $result .=
        "<p><br /></p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    if ($res = @$this->var->mysqli->query("SELECT
                                          a.id,
                                          a.login,
                                          a.jmeno,
                                          a.prijmeni
                                          FROM
                                          uzivatel as a,
                                          uzivatel as b
                                          WHERE
                                          a.jmeno=b.jmeno AND
                                          a.prijmeni=b.prijmeni AND
                                          a.ulice=b.ulice AND
                                          a.cp=b.cp AND
                                          a.psc=b.psc AND
                                          a.mesto=b.mesto AND
                                          a.login!=b.login
                                          GROUP BY
                                          a.id,
                                          a.jmeno;"))
    {
      if ($res->num_rows != 0)
      {
        $result .=
        "<p><br />Duplicita uživatelů podle adresy:</p>";

        while ($data = $res->fetch_object())
        {
          $result .=
          "<p>&otimes; login: <strong>{$data->login}</strong>, Jméno: <strong>{$data->jmeno}</strong>, Příjmení: <strong>{$data->prijmeni}</strong></p>
          ";
        }

        $result .=
        "<p><br /></p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypise posledniho vyherce a jeho cenu
 *
 * name: PosledniUspesnyVyherce
 * @param void
 * @return posledni vyherce
 */
  function PosledniUspesnyVyherce()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          uzivatel.jmeno as jmeno,
                                          uzivatel.prijmeni as prijmeni,
                                          uzivatel.login as login,
                                          DATE_FORMAT(vyherci.datum, '%d.%m. %Y. %H:%i:%s') as datum,
                                          vyherci.popis as popis
                                          FROM uzivatel, vyherci
                                          WHERE
                                          uzivatel.id=vyherci.uzivatel
                                          ORDER BY vyherci.datum DESC
                                          LIMIT 0, 1;"))
    {
      if ($res->num_rows == 1)
      {
        $data = $res->fetch_object();

        $popis = str_replace($this->var->interpret_hledat, $this->var->interpret_empty, $data->popis);
        $popis = substr($popis, 0, 50);
        $popis = iconv("UTF-8", "UTF-8", $popis); //uhlazeni diakritiky

        $result =
        "
        <p>Poslední výherce: {$data->jmeno} {$data->prijmeni} ({$data->login}) </p>
        <p>Datum vyhry: {$data->datum}</p>
        <p>Výhra: {$popis}...</p>
        ";
      }
        else
      {
        $result =
        "<p>Ještě nikdo nevyhrál</p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $result .=
    "<p><br /></p>";

    return $result;
  }

/* vypise celkovy pocet toceni
 *
 * name: PocetVsechToceni
 * @param void
 * @return pocet toceni
 */
  function PocetVsechToceni()
  {
    if ($res = @$this->var->mysqli->query("SELECT
                                          COUNT(id) as pocet
                                          FROM losovani
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $pocet = $res->fetch_object()->pocet;
        $result = "Celkově točeno: {$pocet}x";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }

/* vypise aktualni datum
 *
 * name: InfoDatum
 * @param void
 * @return aktualni datum
 */
  function InfoDatum()
  {
    $dat = date("d.m.Y");
    $cas = date("H:i:s");

    $result =
    "
    <p>Dnes je: {$dat}</p>
    <p>Vstup do administrace: {$cas}<br /></p>
    ";

    return $result;
  }

/* vypis statistik uzivatelu
 *
 * name: StatistikyUzivatelu
 * @param void
 * @return statistiky
 */
  function StatistikyUzivatelu()
  {
    $result = "";
    if ($res = @$this->var->mysqli->query("SELECT
                                          COUNT(id) as pocet
                                          FROM adresa
                                          WHERE
                                          DAY(NOW())=DAY(cas) AND
                                          MONTH(NOW())=MONTH(cas) AND
                                          YEAR(NOW())=YEAR(cas);
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $pocet = $res->fetch_object()->pocet;

        $result .= "<p>Dnes tento web zhléhlo: {$pocet}x</p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    if ($res = @$this->var->mysqli->query("SELECT
                                          COUNT(id) as pocet
                                          FROM adresa
                                          WHERE
                                          WEEK(NOW())=WEEK(cas);
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $pocet = $res->fetch_object()->pocet;

        $result .= "<p>Za tento týden již web zhléhlo: {$pocet}x</p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    if ($res = @$this->var->mysqli->query("SELECT
                                          COUNT(id) as pocet
                                          FROM adresa
                                          WHERE
                                          MONTH(NOW())=MONTH(cas);
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $pocet = $res->fetch_object()->pocet;

        $result .= "<p>Za tento měsíc již web zhléhlo: {$pocet}x</p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    if ($res = @$this->var->mysqli->query("SELECT
                                          COUNT(id) as pocet
                                          FROM losovani
                                          WHERE
                                          DAY(NOW())=DAY(datum) AND
                                          MONTH(NOW())=MONTH(datum) AND
                                          YEAR(NOW())=YEAR(datum);
                                          "))
    {
      if ($res->num_rows == 1)
      {
        $pocet = $res->fetch_object()->pocet;

        $result .= "<p>Dnes již točilo: {$pocet}x</p>";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $result .=
    "<p><br /></p>";

    $result .=
    "<p>Celkový počet přístupů: {$this->var->main->CisloPocitadlaPristupu()}x</p>";

    $result .=
    "<p><br />Operační systémy:</p>";

    //OS
    if ($res = @$this->var->mysqli->query("SELECT
                                          agent
                                          FROM adresa

                                          "))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $arros[$i] = $this->ZjistiOS($data->agent);
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $osname = array_values(array_unique($arros));  //vybrani unikatnich jmen
    sort($osname); //serazeni jmen
    $oscount = array_count_values($arros); //spocitani pristupu dle prohlizecu

    for ($i = 0; $i < count($osname); $i++)
    {
      $result .=
      "
      <p>&rArr; {$osname[$i]} - {$oscount[$osname[$i]]}x</p>
      ";
    }

    $result .=
    "<p><br />Prohlížeče:</p>";

    //Browser
    if ($res = @$this->var->mysqli->query("SELECT
                                          agent
                                          FROM adresa

                                          "))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $arrbrowser[$i] = $this->ZjistiBrowser($data->agent);
          $i++;
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    $browsername = array_values(array_unique($arrbrowser));  //vybrani unikatnich jmen
    sort($browsername); //serazeni jmen
    $browsercount = array_count_values($arrbrowser); //spocitani pristupu dle prohlizecu

    for ($i = 0; $i < count($browsername); $i++)
    {
      $result .=
      "
      <p>&bull; {$browsername[$i]} - {$browsercount[$browsername[$i]]}x</p>
      ";
    }

    $result .=
    "<p><br />Rozlišení:</p>";

    //Rozliseni
    if ($res = @$this->var->mysqli->query("SELECT
                                          rozliseni,
                                          COUNT(rozliseni) as pocet
                                          FROM adresa
                                          GROUP BY rozliseni
                                          ORDER BY pocet DESC, rozliseni ASC;
                                          "))
    {
      if ($res->num_rows != 0)
      {
        $i = 0;
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <p>&rsaquo; {$data->rozliseni} - {$data->pocet}x</p>
          ";
        }
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globalni promenne
    }

    return $result;
  }


/********************** < KONEC > **********************/
}
?>
