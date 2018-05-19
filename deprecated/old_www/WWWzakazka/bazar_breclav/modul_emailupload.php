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
	var $web = "http://test.gfdesign.cz";	//uloženy obrázky
	var $maxsize = 3;	//MB
	var $hlavicky = "Content-type: text/html; charset=UTF-8";
	var $email = "fugess.martin@centrum.cz, fugess@gfdesign.cz";
//******************************************************************************
	function ErrorMsg($chyba)  //začátek chybové hlášky
  {
    $result =
       "<div class=\"pozice_nastaveni_polozek chyba_odsazeni\">
	        <div class=\"pozadi_top_razeni_katal\"></div>
	    			<div class=\"pozadi_obal_razeni_katal uprava_pro_chybu\">
	      			<p>
	              Vyskytla se chyba:
	            </p>
	            <p class=\"chyba\">
                <cite>$chyba</cite>
	            </p>
	            <span class=\"chyba_obrazek_vlevo\"></span>
	            <span class=\"chyba_obrazek_vpravo\"></span>
	    			</div>
	  			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
				</div>";
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
				!Empty($_POST["predmet"]) &&
				!Empty($_FILES["soubor"]))
		{
			$sendmail = $this->OdeslatEmal();
		}

		$result = 
		"<script type=\"text/javascript\" src=\"script/funkce.js\"></script>
		<form method=\"post\" action=\"\" enctype=\"multipart/form-data\" onsubmit=\"return kontrolaEmailu();\">
			<fieldset>
				Zašlete nám foto zboží, které máte na prodej. Rádi Vám odpovíme. Foto přiložte<br />
				Zadejte vaše jméno: <input type=\"text\" name=\"jmeno\" /><br />
				Zadejte váš e-mail: <input type=\"text\" id=\"email\" name=\"email\" /><br />
				Předmět zprávy: <input type=\"text\" name=\"predmet\" /><br />
				Vaše zpráva: <textarea name=\"zprava\"></textarea><br />
				Fotka: <input type=\"file\" name=\"soubor\" />podpora: jpg, png, gif.<br />
				<input type=\"submit\" name=\"tlacitko\" value=\"nahrát\" /><br />
				
			</fieldset>
			$this->chyba
		</form>
		$hlaska
		$sendmail
		$admin
		$obsahadmin";//<img id=\"progress\" src=\"progressbar.gif\">
		

		return	$result;
	}
//******************************************************************************
	function Administrace()
	{
		if (!Empty($_GET["action"]) && 
				$this->RozdelCestu($_GET["action"], 0) == "admin")
		{
			$result =
			"<form method=\"post\">
				<fieldset>
					Jméno:<input type=\"text\" name=\"login\" /><br />
					Heslo:<input type=\"password\" name=\"heslo\" /><br />
					<input type=\"submit\" name=\"logtlacitko\" value=\"Přihlásit\">
				</fieldset>
			</form>";
		}
			else
		{
			if (!$this->KontrolaLoginu($_COOKIE["JMENOBAZ"], $_COOKIE["HESLOBAZ"]))
			{
				$result = "<a href=\"?action=admin\">administrace</a><br>";
			}
		}
		return $result;
	}
//******************************************************************************
	function ObsahAdministrace()
	{
		if ($this->KontrolaLoginu($_COOKIE["JMENOBAZ"], $_COOKIE["HESLOBAZ"]))
		{
			$result = 
			"<a href=\"?action=logoff\">odhlásit</a><br />
			{$this->VypisAdresare()}
			 <br />";
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
				$result = "přihlášeno <a href=\"$this->soubor\">go</a>";
			}
				else
			{
				$result = "špatně <a href=\"$this->soubor?action=admin\">go</a>";
			}
		}

		if (!Empty($_GET["action"]) && $_GET["action"] == "logoff")
		{
			SetCookie("JMENOBAZ", "", 0);
			SetCookie("HESLOBAZ", "", 0);
			$result = "odhlášeno <a href=\"$this->soubor\">go</a>";
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
		return "Stránka vygenerována za: $cas ms"; 
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
		$zprava = stripslashes(htmlspecialchars($_POST["predmet"], ENT_QUOTES));
		$fotka = $_FILES["soubor"]["name"];
		$size = $_FILES["soubor"]["size"];
		$datum = strtotime("now");

		$a = explode(".", $_FILES["soubor"]["name"]);
		$pripona = strtolower($a[count($a) - 1]);

		if ($pripona == "jpg" || 
				$pripona == "gif" ||
				$pripona == "png" &&
				$size <= ($this->maxsize * 1048576))	//ještě asi omezit velikost
		{
			$zdroj = $_FILES["soubor"]["tmp_name"];
			$nazev = $this->OsetreniNazvu($_FILES["soubor"]["name"]);
			$cil = "{$this->slozka}/{$nazev}";

			if (@move_uploaded_file($zdroj, $cil))
			{
				$result = "soubor $nazev uspěšně uploadován na server <a href=\"$this->soubor\">klik</a><br>";
				$mini = $this->ZmensiFotku($nazev);

				if (@$this->dat->queryExec("INSERT INTO fotky(jmeno, email, predmet, zprava, fotka, datum) 
																		VALUES ('$jmeno', '$email', '$predmet', '$zprava', '$nazev', $datum)", $error))
				{
					$result .=
					"přidána položka od: $jmeno, $email ...atd<br/>";

					$text =
					"<table border=\"1\">
						<tr>
							<td>pokusní buňka</td>
							<td>pokusní buňka</td>
						</tr>
					</table>
					jméno: $jmeno<br/>
					email: $email<br/>
					zpráva:<br/>
					$zprava<br/>
					fotka: <a href=\"{$this->web}/{$this->slozka}/{$nazev}\" target=\"_blank\"><img src=\"{$this->web}/{$this->minislozka}/{$nazev}\" alt=\"$nazev\">";

					$header = "$this->hlavicky\nFrom: $email\n";	//hlavička

					if (@mail($this->email, $predmet, $text, $header))
					{
						$result .= "email odeslán";
					}
						else
					{
						$this->chyba = $this->ErrorMsg("email neodeslán!");
					}
				}
					else
				{
					$this->chyba = $this->ErrorMsg($error);
				}
			}
				else
			{
				$result .= "Nahrávání souboru selhalo, počet chyb: {$_FILES["soubor"]["error"]} <a href=\"$this->soubor\">klik</a><br/>";
			}
		}
			else
		{
			$result .= "nekompatibilní přípona '$pripona' a nebo překročená velikost<a href=\"$this->soubor\">klik</a><br/>";
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
				$this->chyba = $this->ErrorMsg("složka nevytvořena $this->slozka");
			}
			chmod($this->slozka, 0777);	//nastavení práv
		}

		if (!file_exists($this->minislozka))
		{
			if (!mkdir($this->minislozka))
			{
				$this->chyba = $this->ErrorMsg("složka nevytvořena $this->minislozka");
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
			"opravdu smazat: ' $data->jmeno ' ...atd.
			<form method=\"post\">
				<fieldset>
					<input type=\"submit\" name=\"ano\" value=\"jo\">
					<input type=\"submit\" name=\"ne\" value=\"nee\">
				</fieldset>
			</form>";
			
			if (!Empty($_POST["ano"]))
			{
				$result .= $this->SmazatFotku($id, $data->fotka);
				$result .= $this->KontrolaPoctuFotek();
			}

			if (!Empty($_POST["ne"]))
			{
				$result .= "tak ne no... <a href=\"$this->soubor\">klik</a>";
			}
		}

		if ($res = @$this->dat->query("SELECT * FROM fotky ORDER BY datum DESC", NULL, $error))
		{
			$result .= 
			"<table border=\"1\">
				<tr>
					<th>id</th>
					<th>jmeno</th>
					<th>emai</th>
					<th>predmet</th>
					<th>zprava</th>
					<th>fotka</th>
					<th>datum</th>
					<th>akce</th>
				</tr>";

			if ($res->numRows() == 0)
			{
				$result .=
				"<tr>
					<th colspan=\"8\">žádná data</th>
				</tr>";
			}

			while ($data = $res->fetchObject())
			{
				$result .= 
				"<tr>
					<td>$data->id</td>
					<td>$data->jmeno</td>
					<td>$data->email</td>
					<td>$data->predmet</td>
					<td>$data->zprava</td>
					<td><a href=\"{$this->slozka}/{$data->fotka}\" target=\"_blank\"><img src=\"{$this->minislozka}/{$data->fotka}\" alt=\"$data->fotka\"></a>{$data->fotka}</td>
					<td>{$this->Datum($data->datum)}</td>
					<td><a href=\"?action=del_foto{$this->oddel}{$data->id}\">smazat fotku</a></td>
				</tr>";
			}
			$result .= "</table>";
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

		$newwidth = 180;
		$newheight = 135;

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
			$this->chyba = $this->ErrorMsg("neporažilo se otevřít obrázek");
		}

		if (!@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h))
		{
			$this->chyba = $this->ErrorMsg("nepodařilo se zmenšit obrázek");
		}

		if (!@$out($res, $nazev))
		{
			$this->chyba = $this->ErrorMsg("nepodařlo se uložit obrázek");
		}

		return $nazev;
	}
//******************************************************************************
	function SmazatFotku($id, $fotka)
	{
		if (@$this->dat->queryExec("DELETE FROM fotky WHERE id=$id", $error))
		{
			$result = "záznam odebrán<br/>";
			if (@unlink("{$this->slozka}/{$fotka}"))
			{
				$result .= "smazána fotka full<br/>";
			}
				else
			{
				$this->chyba = $this->ErrorMsg("nesmazána originální fotka");
			}

			if (@unlink("{$this->minislozka}/{$fotka}"))
			{
				$result .= "smazána fotka mini<br/>";
			}
				else
			{
				$this->chyba = $this->ErrorMsg("nesmazána miniaturní fotka");
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		
		$result .= "<a href=\"$this->soubor\">klik</a>";
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
			$result .= "upraven počet fotek";
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
										"4b01091127aec1384c655f32d91b1366",	//bazar, nazdar
										"fd097a2bc27a8101d48b4885278f57f7"); //zápis loginů;
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

header('Content-type: text/html; charset=UTF-8');
$db = new modul;
$db->StartCas();
print 
"{$db->Obsah()}
{$db->KonecCas()}";

?>