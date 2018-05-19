<?php

class modul
{
	var $oddel = "-";	//oddělovač
	var $soubor;	//název souboru
	var $dat;	//objekt databáze
	var $chyba;	//globální chybová proměnná
	var $nazevdat = "data.bazar";	//název DB
	var $slozka = "./foto";	//složka plná velikost
	var $minislozka = "./mini_foto";	//složka miniatur
	var $web = "http://formular.bazarbreclav.cz/";	//uloženy obrázky
	var $maxsize = 3; //MB
	var $hlavicky = "Content-type: text/html; charset=UTF-8";
	var $email = "bazarbreclav@seznam.cz";
//******************************************************************************
	function ErrorMsg($chyba)  //začátek chybové hlášky
  {
    $result =
       "
	    			<div>
	      			<p>
	              <strong>Vyskytla se chyba:</strong>
	            </p>
	            <p>
                <cite>$chyba</cite>
	            </p>
	            <p>
                <strong>Jestli se vám zobrazí pod tímto textem, že formulář byl odeslán, tak se tak nestalo, jelikož se vyskytla chyba.</strong>
	            </p>
	    			</div>
      ";
    return $result;
  }
//******************************************************************************
	function Obsah()
	{
		if (!$this->dat = new SQLiteDatabase($this->nazevdat, 0777, $error))
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		$this->Instalace();
		
		$this->RozdelNazev();
		$hlaska = $this->ZalogovaniAdmin();
		$admin = $this->Administrace();
		$obsahadmin = $this->ObsahAdministrace();
		
		if (!Empty($_POST["jmeno"]) &&
				!Empty($_POST["email"]) &&
				!Empty($_POST["zprava"]) &&
				!Empty($_POST["predmet"]))
		{
			$sendmail = $this->OdeslatEmal();
		}

		$result = 
		"
		<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
					\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
			  <head>
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <meta http-equiv=\"Content-Language\" content=\"cs\" />
			    <meta name=\"author\" content=\"Fugess (Martin), Geniv (Radek)\" />
			    <meta name=\"copyright\" content=\"Fugess &amp; Geniv Design (c) 2008\" />
			    <meta name=\"robots\" content=\"noindex, nofollow\" />
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styly_mailfotky/styles.css\" media=\"screen\" />
			    <!--[if IE]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styly_mailfotky/styles_IE.css\" media=\"screen\" />
			    <![endif]-->
          <!--[if lte IE 6]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styly_mailfotky/styles_IE6.css\" media=\"screen\" />
			    <![endif]-->
			      <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
			    <title>Zašlete nám popis nebo foto zboží, které máte na prodej.</title>
			  </head>
			    <body>
			    <div id=\"zahlavi\">
  			    <h1>Zašlete nám popis nebo foto zboží, které máte na prodej. Rádi Vám odpovíme.</h1>
          </div>
			    <div id=\"obsah\">
		<form method=\"post\" action=\"\" enctype=\"multipart/form-data\" onsubmit=\"return kontrolaEmailu();\">
			<fieldset>
			<legend>Formulář pro zaslání fotky</legend>
			<label for=\"jmeno_for_id\">Vaše jméno: *</label>
      <input id=\"jmeno_for_id\" type=\"text\" name=\"jmeno\" class=\"vase_jmeno_input\" />
      <label for=\"email_for_id\" class=\"vas_email_label\">Váš e-mail: *</label>
      <input id=\"email_for_id\" type=\"text\" name=\"email\" />
      <label for=\"predmet_for_id\" class=\"predmet_zpravy_label\">Předmět zprávy: *</label>
      <input id=\"predmet_for_id\" type=\"text\" name=\"predmet\" />
      <label>Vaše zpráva: *</label>
      <textarea name=\"zprava\" cols=\"20\" rows=\"3\"></textarea>
      <label for=\"fotka_for_id\" class=\"zde_vlozte_fotku_label\">Zde vložte fotku:</label>
      <input id=\"fotka_for_id\" type=\"file\" name=\"soubor\" class=\"zde_vlozte_fotku_input\" />
      <label class=\"pripony\"><em>(nepovinné)</em> (jpg, png, gif)</label>
			<input type=\"submit\" name=\"tlacitko\" value=\"Odeslat\" class=\"odeslat_input\" />
			</fieldset>
			<p>
        * Tyto pole jsou povinné k vyplnění
			</p>
			$this->chyba
		</form>
		$hlaska
		$sendmail
		$admin
		$obsahadmin
        </div>
        <div id=\"zapati\">
        {$this->KonecCas()}
          <div>
            <p>
              <a href=\"?action=admin\" title=\"Administrace\">Administrace</a>
            </p>
          </div>
        </div>
		    </body>
		  </html>
    ";//<img id=\"progress\" src=\"progressbar.gif\">
		

		return	$result;
	}
//******************************************************************************
	function Administrace()
	{
		if (!Empty($_GET["action"]) && 
				$this->RozdelCestu($_GET["action"], 0) == "admin")
		{
			$result =
			"<form method=\"post\" action=\"\" class=\"form_logovani_admin\">
				<fieldset>
          <legend>Přihlášení do administrace</legend>
          <label for=\"login_for_id\">Login:</label>
          <input id=\"login_for_id\" type=\"text\" name=\"login\" />
          <label for=\"heslo_for_id\">Heslo:</label>
          <input id=\"heslo_for_id\" type=\"password\" name=\"heslo\" />
					<input class=\"tlacitko_potvrdit\" type=\"submit\" name=\"logtlacitko\" value=\"Přihlásit\" />
				</fieldset>
			</form>";
		}
		return $result;
	}
//******************************************************************************
	function ObsahAdministrace()
	{
		if ($this->KontrolaLoginu($_COOKIE["JMENOBAZ"], $_COOKIE["HESLOBAZ"]))
		{
			$result = 
			"
			<div id=\"odhlasit\">
  			<p>
          <a href=\"?action=logoff\" title=\"Odhlásit se\">Odhlásit se</a>
  			</p>
			</div>
			<span class=\"display_block odsazeni_zespodu\"></span>
			{$this->VypisAdresare()}
      ";
		}

		return $result;
	}
//******************************************************************************
	function RozdelNazev()
	{
		$oddel = "/"; //zadaný oddělovač adresy
		$a = explode($oddel, $_SERVER["SCRIPT_NAME"]); //rosekání adresy a vrácení žádaného výsledku
		$this->soubor = $a[count($a)-1];
	}
//******************************************************************************
	function ZalogovaniAdmin()
	{
		if (!Empty($_POST["logtlacitko"]) &&
				!Empty($_POST["login"]) &&
				!Empty($_POST["heslo"]))
		{
			if ($this->KontrolaLoginu(md5($_POST["login"]), md5($_POST["heslo"])))
			{
				SetCookie("JMENOBAZ", md5($_POST["login"]), Time() + 31536000);
				SetCookie("HESLOBAZ", md5($_POST["heslo"]), Time() + 31536000);
				$result = "
				<div>
          <p>
            Byl jsi přihlášen do administrace.
  				</p>
  				<p>
            <a href=\"$this->soubor\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
  				</p>
				</div>
        ";
			}
				else
			{
				$result = "
				<div>
          <p>
            Zadal jsi špatné loginy - nebyl jsi přihlášen.
  				</p>
  				<p>
            <a href=\"$this->soubor?action=admin\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
  				</p>
				</div>
        ";
			}
		}

		if (!Empty($_GET["action"]) && $_GET["action"] == "logoff")
		{
			SetCookie("JMENOBAZ", "", 0);
			SetCookie("HESLOBAZ", "", 0);
			$result = "
			   <div id=\"odhlaseni_admin\">
          <p>
            Byl jsi odhlášen.
  				</p>
  				<p>
            <a href=\"$this->soubor\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
  				</p>
				</div>
        ";
		}

		return $result;
	}
//******************************************************************************
	var $start, $konec;
	function MeritCas() //funkce pro vrácení času
	{
	  $cas = explode(" ", microtime());
		$soucet = $cas[1] + $cas[0];
		return $soucet;
	}
//******************************************************************************
	function StartCas() //zapis začátku
	{
		$this->start = $this->MeritCas();
	}
//******************************************************************************
	function KonecCas() //zápis konce a finální vypis doby
	{
		$this->konec = $this->MeritCas();
		$presnost = 10000; //nastavená přesnost
		$cas = Abs((Round(($this->konec - $this->start) * $presnost)) / $presnost); //Abs, výpočet
		return "
    <p class=\"vlevo\">
      Stránka vygenerována za: $cas ms
    </p>
    ";
	}
//******************************************************************************
	function RozdelCestu($cesta, $poradi)
	{
		$a = explode($this->oddel, $cesta); //rosekání adresy a vrácení žádaného výsledku
		return $a[$poradi];
	}
//******************************************************************************
	function OdeslatEmal()
	{
		$jmeno = stripslashes(htmlspecialchars($_POST["jmeno"], ENT_QUOTES));
		$email = stripslashes(htmlspecialchars($_POST["email"], ENT_QUOTES));
		$predmet = stripslashes(htmlspecialchars($_POST["predmet"], ENT_QUOTES));
		$zprava = stripslashes(htmlspecialchars($_POST["zprava"], ENT_QUOTES));
		$datum = strtotime("now");
		
		if (!Empty($_FILES["soubor"]["name"]))
		{
      $fotka = $_FILES["soubor"]["name"];
  		$size = $_FILES["soubor"]["size"];

  		$a = explode(".", $_FILES["soubor"]["name"]);
  		$pripona = strtolower($a[count($a) - 1]);

  		if (($pripona == "jpg" ||
  				$pripona == "gif" ||
  				$pripona == "png") &&
  				$size <= ($this->maxsize * 1048576))	//ještě asi omezit velikost
  		{
  			$zdroj = $_FILES["soubor"]["tmp_name"];
  			$nazev = $this->OsetreniNazvu($_FILES["soubor"]["name"]);
  			$cil = "{$this->slozka}/{$nazev}";

  			if (@move_uploaded_file($zdroj, $cil))
  			{
  				$result = "";
  				$mini = $this->ZmensiFotku($nazev);
          $foto = "
            <a href=\"{$this->web}/{$this->slozka}/{$nazev}\" title=\"$nazev\" target=\"_blank\">
              <img src=\"{$this->web}/{$this->minislozka}/{$nazev}\" alt=\"$nazev\" />
            </a>
          ";
  			}
  				else
  			{
  				$result .= "
          <p>
            Nahrávání souboru selhalo, počet chyb: <strong>{$_FILES["soubor"]["error"]}</strong>
          </p>
          <p>
            <a href=\"$this->soubor\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
          </p>
          ";
  			}
  		}
  			else
  		{
  			$result .= "
        <p>
          <strong>Soubor nebyl odeslán.</strong> Důvodem je nekompatibilní přípona <strong>$pripona</strong> a nebo překročená velikost obrázku.
        </p>
        <p>
          <strong>Zpráva byla odeslána bez přílohy.</strong>
        </p>
        ";
  		}
    }

    if (Empty($nazev))
    {
      $nazev = "0";
    }

    if (@$this->dat->queryExec("INSERT INTO fotky(jmeno, email, predmet, zprava, fotka, datum)
  															VALUES ('$jmeno', '$email', '$predmet', '$zprava', '$nazev', $datum)", $error))
  	{
      $result .= "
  		<p>
        Formulář byl úspěšně odeslán.
      </p>
      <p>
        <a href=\"$this->soubor\" title=\"Pokračuj klapnutím zde\">Pokračuj klapnutím zde</a>
      </p>
          ";

      $text =
  		"
        Byla ti zaslána zpráva od: <strong>$jmeno</strong>, ze tvých stránek http://www.bazarbreclav.cz/
        <br />
        <br />
        <u>Zde je výpis formuláře:</u>
        <br />
        Jméno osoby: <strong>$jmeno</strong>
        <br />
        Email osoby: <strong>$email</strong>
        <br />
        Zpráva osoby: <strong>$zprava</strong>
        <br />
        Jestli osoba přiložila obrázek, tak se ti zobrazí náhled pod tímto textem:
        <br />
        $foto
        <br />
        Náhled obrázku funguje jako odkaz na obrázek v plné velikosti.
        <br />
        <br />
        <strong>Tento e-mail ti byl zaslán automaticky přes stránky http://www.bazarbreclav.cz/</strong>
        <br />
        <strong>Pokud osoba vyplnila správně e-mail, tak můžeš ihned na tento e-mail odpovědět.</strong>
      ";

			$header = "$this->hlavicky\nFrom: $email\n";	//hlavička

			if (!@mail($this->email, $predmet, $text, $header))
			{
				$this->chyba = $this->ErrorMsg("Formulář nebyl odeslán");
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}

		return $result;
	}
//******************************************************************************
	function Instalace()
	{
		if (filesize($this->nazevdat) == 0)
		{
			if (!@$this->dat->queryExec("CREATE TABLE fotky (
																	id INTEGER AUTO_INCREMENT PRIMARY KEY,
																	jmeno VARCHAR(20),
																	email VARCHAR(30),
																	predmet VARCHAR(50),
																	zprava TEXT,
																	fotka VARCHAR(150),
																	datum INTEGER);", $error))
			{
				$this->chyba = $this->ErrorMsg($error);
			}
			chmod($this->nazevdat, 0777);	//nastavení práv
		}
	}
//******************************************************************************
	function VypisAdresare()
	{
		$id = $this->RozdelCestu($_GET["action"], 1);
		settype($id, "integer");

		if (!file_exists($this->slozka))
		{
			if (!mkdir($this->slozka))
			{
				$this->chyba = $this->ErrorMsg("složka nebyla vytvořena $this->slozka");
			}
			chmod($this->slozka, 0777);	//nastavení práv
		}

		if (!file_exists($this->minislozka))
		{
			if (!mkdir($this->minislozka))
			{
				$this->chyba = $this->ErrorMsg("složka nebyla vytvořena $this->minislozka");
			}
			chmod($this->minislozka, 0777);	//nastavení práv
		}

		if ($id != 0)
		{
			if ($res = @$this->dat->query("SELECT * FROM fotky WHERE id=$id", NULL, $error))
			{
				$data = $res->fetchObject();
			}
				else
			{
				$this->chyba = $this->ErrorMsg($error);
			}
			
			$result =
			"
			<form method=\"post\" action=\"\" class=\"otazka_smazat\">
			<p>
        Opravdu chceš smazat položku s názvem:
			</p>
			<p>
        <strong>$data->jmeno</strong>
			</p>
				<fieldset>
					<input type=\"submit\" class=\"ano\" name=\"ano\" value=\"Ano\" />
					<input type=\"submit\" class=\"ne\" name=\"ne\" value=\"Ne\" />
				</fieldset>
			</form>";
			
			if (!Empty($_POST["ano"]))
			{
				$result .= $this->SmazatFotku($id, $data->fotka, $data->jmeno);
			}

			if (!Empty($_POST["ne"]))
			{
				$result .= "
				<div class=\"odpoved\">
  				<p>
            Stornoval jsi požadavek na smazání položky s názvem:
  				</p>
  				<p>
            <strong>$data->jmeno</strong>
  				</p>
  				<p>
            Pokračuj klapnutím <a href=\"$this->soubor\" title=\"Pokračuj klapnutím zde\">zde</a>
  				</p>
				</div>
        ";
			}
		}
		$result .= $this->KontrolaPoctuFotek();

		if ($res = @$this->dat->query("SELECT * FROM fotky ORDER BY datum DESC", NULL, $error))
		{
			$result .= 
			"
      <div id=\"admin_zvlast\">
        <h1>Administrátorský panel</h1>
        <h2>Zde máš zobrazené obrázky nebo popisy zboží, které ti lidé poslali.</h2>
  			<div class=\"nadpis_admin\">
          <p class=\"id\">#</p>
          <p class=\"jmeno\">od (jméno)</p>
          <p class=\"mail\">od (email)</p>
          <p class=\"predmet\">Předmět zprávy</p>
          <p class=\"zprava\">Zpráva</p>
          <p class=\"fotka\">Fotka</p>
          <p class=\"datum\">Datum</p>
          <p class=\"smazat\">smazat</p>
  			</div>
      ";

			if ($res->numRows() == 0)
			{
				$result .=
				"<p class=\"zadne_fotky\">Žádné fotky</p>";
			}

			while ($data = $res->fetchObject())
			{
        if ($data->fotka != "0")
        {
          $odkaz = "<a href=\"{$this->slozka}/{$data->fotka}\" onclick=\"window.open(this.href); return false\" title=\"$data->fotka\"><img src=\"{$this->minislozka}/{$data->fotka}\" alt=\"$data->fotka\" /></a>";
        }
          else
        {
          $odkaz = "(bez fotky)";
        }
        $result .= 
				"
				<div class=\"polozky_admin\">
          <p class=\"id\">$data->id</p>
          <p class=\"jmeno\">$data->jmeno</p>
          <p class=\"mail\">$data->email</p>
          <p class=\"predmet\">$data->predmet</p>
          <p class=\"zprava\">$data->zprava</p>
          <p class=\"fotka\">$odkaz</p>
          <p class=\"datum\">{$this->Datum($data->datum)}</p>
          <p class=\"smazat\"><a href=\"?action=del_foto{$this->oddel}{$data->id}\" title=\"Smazat\"></a></p>
  			</div>
        ";
			}
			$result .= "</div>";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}

		return $result;
	}
//******************************************************************************
	function KontrolaNazvu($jmeno) //vrací nové jméno
	{
	  return strtr($jmeno," -áäčďéěëíňóöřšťúůüýžÁÄČĎÉĚËÍŇÓÖŘŠŤÚŮÜÝŽ",
												"__aacdeeeinoorstuuuyzAACDEEEINOORSTUUUYZ");
	}
//******************************************************************************
	function OsetreniNazvu($jmeno)
	{
		$a = explode(".", $jmeno);	//rozdělení jména
		$jm = $this->KontrolaNazvu(strtolower($a[count($a) - 2]));	//odstranění znaků a na malé písmena
		$pr = strtolower($a[count($a) - 1]);	//přípona na malé
		$kod = md5($jm);	//zakóduje své jméno
		$nahoda = rand();	//náhodné číslo

		$nazev = "{$jm}_{$kod}.{$pr}";	//zamýšlený název

		if (file_exists("{$this->slozka}/{$nazev}"))
		{
			$result = "{$jm}_{$kod}({$nahoda}).{$pr}";	//název při existenci souboru
		}
			else
		{
			$result = $nazev;
		}

		return $result;
	}
//******************************************************************************
	function ZmensiFotku($fotka)
	{
		$zdroj = "{$this->slozka}/{$fotka}";
		$nazev = "{$this->minislozka}/{$fotka}";
		$obr = getimagesize($zdroj);
		
		$w = $obr[0];
		$h = $obr[1];
		$t = $obr[2];

		$newwidth = 135;
		$newheight = 101;

		switch ($t)
		{
			case 1:	//gif
				$in = imagecreatefromgif;
				$out = imagegif;
			break;

			case 2:	//jpg
				$in = imagecreatefromjpeg;
				$out = imagejpeg;
			break;

			case 3:	//png
				$in = imagecreatefrompng;
				$out = imagepng;
			break;
		}

		if (!$res = @imagecreatetruecolor($newwidth, $newheight))
		{
			$this->chyba = $this->ErrorMsg("nepodařilo se inicializovat obrázek");
		}

		if (!$source = @$in($zdroj))
		{
			$this->chyba = $this->ErrorMsg("nepodařilo se otevřít obrázek");
		}

		if (!@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h))
		{
			$this->chyba = $this->ErrorMsg("nepodařilo se zmenšit obrázek");
		}

		if (!@$out($res, $nazev))
		{
			$this->chyba = $this->ErrorMsg("nepodařilo se uložit obrázek");
		}

		return $nazev;
	}
//******************************************************************************
	function SmazatFotku($id, $fotka, $jmeno)
	{
		if (@$this->dat->queryExec("DELETE FROM fotky WHERE id=$id", $error))
		{
			$result = "
        <div class=\"odpoved\">
  				<p>
            Byla smazána položka s názvem:
  				</p>
  				<p>
            <strong>$jmeno</strong>
  				</p>
  				<p>
            Pokračuj klapnutím <a href=\"$this->soubor\" title=\"Pokračuj klapnutím zde\">zde</a>
  				</p>
				</div>
      ";
			if (!@unlink("{$this->slozka}/{$fotka}"))
			{
				$this->chyba = $this->ErrorMsg("chyba: nebyla smazána originální fotka");
			}

			if (!@unlink("{$this->minislozka}/{$fotka}"))
			{
				$this->chyba = $this->ErrorMsg("chyba: nebyla smazána miniaturní fotka");
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
    }
    
		return $result;
	}
//******************************************************************************
	function KontrolaPoctuFotek()
	{
		$pol = $this->slozka; //uprava počtu fotek
		$i = 0;
		$handle = opendir($pol);
		while ($soub = readdir($handle))
		{
			$i++;
			$fulln[$i] = $soub;
		}
		closedir($handle);
		
		$pol = $this->minislozka;
		$i = 0;
		$handle = opendir($pol);
		while ($soub = readdir($handle))
		{
			$i++;
			$minin[$i] = $soub;
		}
		closedir($handle);

		if ($res = @$this->dat->query("SELECT COUNT(*) as pocet FROM fotky", NULL, $error))
		{
			$pocet = $res->fetchObject()->pocet;
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}

		$fumi = array_merge($fulln, $minin);	//sloučí pole
		$fumipoc = array_count_values($fumi);	//spočítá počet souborů, standartně 2
		$smaz = array_values($fumipoc);	//vrátí hodnoty tj počty opakování standart 2
		$keysmaz = array_keys($fumipoc);	//vrátí klíče pole tj názvy

		if (($pocet != (count($fulln) - 2)) ||
				($pocet != (count($minin) - 2)))
		{
			for ($i = 0; $i < count($smaz); $i++)
			{
				if ($smaz[$i] < 2)	//kdež je jen 1x
				{
					@unlink("{$this->slozka}/{$keysmaz[$i]}");
					@unlink("{$this->minislozka}/{$keysmaz[$i]}");
				}
			}
			$result .= "Info: Byl upraven počet fotek";
		}
		return $result;
	}
//******************************************************************************
	function Datum($datum)
	{
	  switch (Date("n", $datum))
	  {
	    case 1:
		    $mesic1 = "Leden";
		    $mesic = "Ledna";
	    break;
	    
	    case 2:
		    $mesic1 = "Únor";
		    $mesic = "Února";
	    break;
	    
	    case 3:
		    $mesic1 = "Březen";
		    $mesic = "Bžezna";
	    break;
	    
	    case 4:
		    $mesic1 = "Duben";
		    $mesic = "Dubna";
	    break;
	    
	    case 5:
		    $mesic1 = "Květen";
		    $mesic = "Května";
	    break;
	    
	    case 6:
		    $mesic1 = "Červen";
		    $mesic = "Června";
	    break;
	    
	    case 7:
		    $mesic1 = "Červenec";
		    $mesic = "Července";
	    break;
	    
	    case 8:
		    $mesic1 = "Srpen";
		    $mesic = "Srpna";
	    break;
	    
	    case 9:
		    $mesic1 = "Září";
		    $mesic = "Září";
	    break;
	    
	    case 10:
		    $mesic1 = "Říjen";
		    $mesic = "Října";
	    break;
	    
	    case 11:
			  $mesic1 = "Listopad";
			  $mesic = "Listopadu";
	    break;
	    
	    case 12:
			  $mesic1 = "Prosinec";
			  $mesic = "Prosince";
	    break;
	  }
	  
	  if (Date("j", $datum) == 1)
	  {
	    $mes = $mesic1;
	  }
	    else
	  {
	    $mes = $mesic;
	  }
	  return Date("j", $datum).". $mes ".Date("Y G:i:s", $datum);
	}
//******************************************************************************
	function KontrolaLoginu($jmeno, $heslo)
	{
		$login = array ("c8620e2ff5a9cb13bf66ab249822e9a9", 
										"e7b5b08060a7d949d953607dc515679e", 
										"e0694d5cfee470a0a40835bffc3d3d1f", 
										"34dae487e31f37aa74633258b7774d4f",
										"21232f297a57a5a743894a0e4a801fc3",	//viz - loginy - php_verze - bazarbreclav
										"743394beff4b1282ba735e5e3723ed74"); //zápis loginů;
		$poc = 0;

		for ($i = 0; $i < (count($login) - 1); $i++)
		{
			if ($jmeno == $login[$i] && $heslo == $login[$i + 1])
			{
				$poc++;
			}
		}

		if ($poc == 1)
		{
			$result = true;
		}
			else
		{
			$result = false;
		}
		return $result;
	}
//******************************************************************************
}

$db = new modul;
$db->StartCas();
print 
"{$db->Obsah()}";

?>
