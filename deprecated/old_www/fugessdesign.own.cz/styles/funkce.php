<?php
	class SQLite
	{
		
		//**************************************************************************
		function CSS() //volba typu dokumentu
		{
			if (Empty($_GET["action"]))
			{
				header('Content-type: text/css; charset=UTF-8');
			}
				else
			{
				header('Content-type: text/html; charset=UTF-8');
			}
		}
		var $soubor;
	//****************************************************************************
		function Instalace($objekt, $nazev) //instalace DB
		{	
			if (filesize($nazev) == 0)
			{
				if ($objekt->query("CREATE TABLE deklarace (id INTEGER AUTO_INCREMENT PRIMARY KEY , nazev VARCHAR(100))"))
				{
					if ($objekt->query("CREATE TABLE hodnota (id INTEGER AUTO_INCREMENT PRIMARY KEY, iddek INT, nazev VARCHAR(100), poznamka VARCHAR(100))"))
					{
						print "Nainstalováno! {$this->AutoClick(1, "$this->soubor?action=all")}";
					}
				}		
			}
		}
	//****************************************************************************
		function Menu()
		{
			if (!Empty($_POST["login"]) && !Empty($_POST["heslo"]))
			{
				if ($this->KontrolaLoginu($_POST["login"],$_POST["heslo"]))
				{
					SetCookie("CSSJMENO", $_POST["login"], Time() + 31536000); //zápis do cookie
      		SetCookie("CSSHESLO", $_POST["heslo"], Time() + 31536000);
      		$prih = "přihlášeno {$this->AutoClick(1, "$this->soubor?action=all")}";
				}
					else
				{
					$prih = "špatně {$this->AutoClick(1, "$this->soubor?action=all")}";
				}
			}
			
			if (!Empty($_GET["action"]) && $_GET["action"] == "logout")
			{
				SetCookie("CSSJMENO", "");	//vymazání cookie
      	SetCookie("CSSHESLO", "");
      	$prih = "odhlášeno {$this->AutoClick(1, "$this->soubor?action=all")}";
			}
			
			print $prih;
			
			if (!Empty($_GET["action"]) && 
					!Empty($_COOKIE["CSSJMENO"]) && 
					!Empty($_COOKIE["CSSHESLO"]) && 
					$this->KontrolaLoginu($_COOKIE["CSSJMENO"], $_COOKIE["CSSHESLO"]))
			{
				print 
				"<a href=\"?action=all\">zobraz vše</a><br>
				<br>
				<a href=\"?action=complet\">kompletní databáze</a><br>
				<br>
				<a href=\"?action=add_dek\">přidej deklaraci</a><br>
				<a href=\"?action=edit_dek\">uprav deklaraci</a><br>
				<a href=\"?action=del_dek\">smaž deklaraci</a><br>
				<br>
				<a href=\"?action=add_hod\">přidej hodnotu</a><br>
				<a href=\"?action=edit_hod\">uprav hodnotu</a><br>
				<a href=\"?action=del_hod\">smaž hodnotu</a><br>
				<br>
				<a href=\"?action=logout\">odhlásit se</a><br>
				<br>
				<a href=\"$this->soubor\">přepni na css</a><br>
				<br>";
			}
				else
			{
				if (!Empty($_GET["action"]))
				{
					print 
					"<form method=\"POST\" action=\"\">
						<fieldset>
							login:<input type=\"text\" name=\"login\"><br>
							heslo<input type=\"password\" name=\"heslo\"><br>
							<input type=\"submit\" value=\"Přidat\" name=\"tlacitko\">
						</fieldset>
					</form>";
				}
			}
		}
	//****************************************************************************
		function RozdelCestu($cesta, $poradi)
		{
			$oddel = "-"; //zadaný oddělovač adresy
			$a = explode($oddel, $cesta); //rosekání adresy a vrácení žádaného výsledku
			return $a[$poradi];
		}
	//****************************************************************************
		function RozdelNazev()
		{
			$oddel = "/"; //zadaný oddělovač adresy
			$a = explode($oddel, $_SERVER["SCRIPT_NAME"]); //rosekání adresy a vrácení žádaného výsledku
			$this->soubor = $a[count($a)-1];
		}
	//****************************************************************************
		function Sekce($objekt)
		{
			if (!Empty($_GET["action"])&& 
					!Empty($_COOKIE["CSSJMENO"]) && 
					!Empty($_COOKIE["CSSHESLO"]) && 
					$this->KontrolaLoginu($_COOKIE["CSSJMENO"], $_COOKIE["CSSHESLO"]))
			{
				$kam = $this->RozdelCestu($_GET["action"], 0);
			}
				else
			{
				$kam = "all";
			}
			
			switch ($kam)
			{
				case "all":
					$this->VypisCSS($objekt);
				break;
			//************************************************************************
				case "complet":
					print $this->VypisDB($objekt, "SELECT * FROM deklarace");
					print $this->VypisDB($objekt, "SELECT * FROM hodnota");
				break;
			//************************************************************************
				case "add_dek":
					print 
					"<form method=\"POST\" action=\"\">
						<fieldset>
							deklarace<input type=\"text\" name=\"nazev\"><br>
							<input type=\"submit\" value=\"Přidat\" name=\"tlacitko\">
						</fieldset>
					</form>";
	
					if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
							!Empty($_POST["nazev"]))
					{
						$this->PridejDeklaraci($objekt, $_POST["nazev"]);
					}

					$this->VypisDeklarace($objekt);
				break;
			//************************************************************************
				case "edit_dek":
					$id = $this->RozdelCestu($_GET["action"], 1);
					
					if (!Empty($id))
					{
						$res = $objekt->query("SELECT * FROM deklarace WHERE id=$id");
						$data = $res->fetchObject();
						
						print
						"<form method=\"POST\" action=\"\">
							<fieldset>
								deklarace<input type=\"text\" name=\"nazev\" value=\"$data->nazev\"><br>
								<input type=\"submit\" value=\"Uložit\" name=\"tlacitko\">
							</fieldset>
						</form>";
					}
					
					if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
							!Empty($_POST["nazev"]) &&
							!Empty($id))
					{
						$this->UpravDeklaraci($objekt, $_POST["nazev"], $id);
					}
					
					$this->VypisDeklaraceEdit($objekt);
				break;
			//************************************************************************
				case "del_dek":
					$id = $this->RozdelCestu($_GET["action"], 1);
					
					if (!Empty($id))
					{
						$res = $objekt->query("SELECT * FROM deklarace WHERE id=$id");
						$data = $res->fetchObject();
						
						print
						"<form method=\"POST\">
							<fieldset>
								smazat název: $data->nazev<br>
								smazáním můžete dojít o vazby v tabulce!!
								<br>";
								if ($this->PocetDeklaraci($objekt) != 0)
								{
									print 
									"<input type=\"submit\" value=\"Ano\" name=\"tlacitko\">
									<input type=\"submit\" value=\"Ne\" name=\"tlacitko\">";
								}
						print
							"</fieldset>
						</form>";
					}
					
					if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
							$_POST["tlacitko"] == "Ano")
					{
						$this->SmazDeklaraci($objekt, $id);
					}
						else
					{
						if (!Empty($_POST["tlacitko"]))
						{
							print "ne... {$this->AutoClick(1, "$this->soubor?action=del_dek")}";
						}
					}

					$this->VypisDeklaraceDel($objekt);
				break;
			//************************************************************************
				case "add_hod":
					print 
					"<form method=\"POST\" action=\"\">
						<fieldset>
							{$this->RozbalovaciVypisDeklarace($objekt)}<br>
							hodnota<input type=\"text\" name=\"nazev\"><br>
							poznámka<input type=\"text\" name=\"poznamka\"><br>
							<input type=\"submit\" value=\"Přidat\" name=\"tlacitko\">
						</fieldset>
					</form>";
	
					if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
							!Empty($_POST["deklarace"]) && //!Empty($_POST["poznamka"])
							!Empty($_POST["nazev"]))
					{
						$this->PridejHodnotu($objekt, $_POST["deklarace"], $_POST["nazev"], $_POST["poznamka"]);
					}
					
					$this->VypisHodnoty($objekt);
				break;
			//************************************************************************
				case "edit_hod":
					$id = $this->RozdelCestu($_GET["action"], 1);
					
					if (!Empty($id))
					{
						$res = $objekt->query("SELECT * FROM hodnota WHERE id=$id");
						$data = $res->fetchObject();
						
						print
						"<form method=\"POST\" action=\"\">
							<fieldset>
								{$this->RozbalovaciVypisDeklaraceEdit($objekt, $data->iddek)}<br>
								hodnota<input type=\"text\" name=\"nazev\" value=\"$data->nazev\"><br>
								poznámka<input type=\"text\" name=\"poznamka\" value=\"$data->poznamka\"><br>
								<input type=\"submit\" value=\"Uložit\" name=\"tlacitko\">
							</fieldset>
						</form>";
					}
					
					if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
							!Empty($_POST["deklarace"]) && //!Empty($_POST["poznamka"])
							!Empty($_POST["nazev"]))
					{
						$this->UpravHodnotu($objekt, $_POST["deklarace"], $_POST["nazev"], $_POST["poznamka"], $id);
					}
					
					$this->VypisHodnotyEdit($objekt);
				break;
			//************************************************************************
				case "del_hod":
					$id = $this->RozdelCestu($_GET["action"], 1);
					
					if (!Empty($id))
					{
						$res = $objekt->query("SELECT * FROM hodnota WHERE id=$id");
						$data = $res->fetchObject();
						
						print
						"<form method=\"POST\">
							<fieldset>
								smazat název: $data->nazev<br>
								s poznámkou: $data->poznamka a vazbou na: $data->iddek
								<br>";
								if ($this->PocetHodnot($objekt) != 0)
								{
									print 
									"<input type=\"submit\" value=\"Ano\" name=\"tlacitko\">
									<input type=\"submit\" value=\"Ne\" name=\"tlacitko\">";
								}
						print
							"</fieldset>
						</form>";
					}
					
					if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
							$_POST["tlacitko"] == "Ano")
					{
						$this->SmazHodnotu($objekt, $id);
					}
						else
					{
						if (!Empty($_POST["tlacitko"]))
						{
							print "ne... {$this->AutoClick(1, "$this->soubor?action=del_hod")}";
						}
					}

					$this->VypisHodnotyDel($objekt);
				break;
			//************************************************************************
			}//end switch
		}
	//****************************************************************************
		function VypisDB($objekt, $sql)
		{
			if ($res = $objekt->query($sql))
			{
				$poc = $res->numRows();
				$slo = $res->numFields();
				$pole = "";
				
				if ($poc > 0 && $slo > 0)
				{
					$vypis = 
					"<table border=\"1\">
						<tr>";
					for ($i = 0; $i < $slo; $i++)
					{
						$data = $res->fieldName($i); //načtení hlavičky tabulky
						$pole[$i] = $data;					 //uložení hodnot hlavičky
						$vypis .= "<th>$data</th>";	 //výpis hlavičkyS
					}
					$vypis .= "</tr>";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$vypis .= "<tr>";
						$data = $res->fetchObject();	//načítání názvu do objetku
						
						for ($j = 0; $j < $slo; $j++)
						{
							$vypis .= "<td>{$data->$pole[$j]}</td>";	//vypis řádku
						}
						$vypis .= "</tr>";
					}
					$vypis .= "</table>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			return $vypis;
		}
	//****************************************************************************
		function VypisCSS($objekt)
		{
			if ($res = $objekt->query("SELECT deklarace.nazev as deklarace, hodnota.nazev as hodnota, hodnota.poznamka as poznamka FROM deklarace, hodnota WHERE deklarace.id=hodnota.iddek ORDER BY deklarace.id"))
			{
				$poc = $res->numRows();
				if ($poc > 0)
				{
					if (!Empty($_GET["action"]))
					{
						$kon = "<br>"; //zalamování v html
					}
						else
					{
						$kon = "\n"; //zalamování v css
					}

					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//vylepšit vykreslování
						
						if ($data->poznamka != "")
						{
							$pozn = "/*".htmlspecialchars_decode($data->poznamka)."*/";	//velmi důležité kodování!!
						}
							else
						{
							$pozn = "";
						}
						
						if ($data->deklarace == $pred)	//je-li předchozí stejná jako aktuální = sloučení
						{
							$vystup .= "\t".htmlspecialchars_decode($data->hodnota).";\t\t{$pozn}{$kon}";
						}
							else
						{
							if ($i > 1)	//dosazování }
							{
								$zak = "}{$kon}{$kon}";
							}
								else
							{
								$zak = ""; //první znak
							}

							$vystup .= "{$zak}".htmlspecialchars_decode($data->deklarace)." {{$kon}\t".htmlspecialchars_decode($data->hodnota).";\t\t{$pozn}{$kon}";
						}

						$pred = $data->deklarace;
					}
					$vystup .= "}{$kon}{$kon}/*css vygenerováno za: {$this->KonecCas()}*/";	//poslední řádek
				}
					else
				{
					$vystup = "nic";
				}
			}
				else
			{
				print "něco se pokazilo";
			}
			
			print $vystup;
		}
	//****************************************************************************
		function VypisDeklarace($objekt) //při přidávání deklarace
		{
			print $this->VypisDB($objekt, "SELECT * FROM deklarace");
		}
	//****************************************************************************
		function VypisHodnoty($objekt) //při přidávání hodnoty
		{
			print $this->VypisDB($objekt, "SELECT hodnota.id as id, deklarace.nazev as deklarace, hodnota.nazev as hodnota, poznamka FROM deklarace, hodnota WHERE deklarace.id=hodnota.iddek");
		}
	//****************************************************************************
		function VypisDeklaraceEdit($objekt)
		{
			if ($res = $objekt->query("SELECT * FROM deklarace")) //deklarace.nazev,hodnota.nazev FROM deklarace,hodnota WHERE deklarace.id=hodnota.dek"))
			{
				$poc = $res->numRows();

				if ($poc > 0)
				{
					$vypis = 
					"<table border=\"1\">
						<tr>
							<td>#</td>
							<td>Název</td>
							<td>Akce</td>
						</tr>";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//načítání hodnot do objetku
						$vypis .= "<tr>
												<td>$data->id</td>
												<td>$data->nazev</td>
												<td><a href=\"?action=edit_dek-$data->id\">uprav</a></td>
											</tr>";
					}
					$vypis .= "</table>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			print $vypis;
		}
	//****************************************************************************
		function VypisHodnotyEdit($objekt)
		{
			if ($res = $objekt->query("SELECT hodnota.id as id, deklarace.nazev as deklarace, hodnota.nazev as hodnota, poznamka FROM deklarace, hodnota WHERE deklarace.id=hodnota.iddek"))
			{
				$poc = $res->numRows();

				if ($poc > 0)
				{
					$vypis = 
					"<table border=\"1\">
						<tr>
							<td>#</td>
							<td>Deklarace</td>
							<td>Název</td>
							<td>Poznámka</td>
							<td>Akce</td>
						</tr>";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//načítání hodnot do objetku
						$vypis .= "<tr>
												<td>$data->id</td>
												<td>$data->deklarace</td>
												<td>$data->hodnota</td>
												<td>$data->poznamka</td>
												<td><a href=\"?action=edit_hod-$data->id\">uprav</a></td>
											</tr>";
					}
					$vypis .= "</table>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			print $vypis;
		}
	//****************************************************************************
		function VypisDeklaraceDel($objekt)
		{
			if ($res = $objekt->query("SELECT * FROM deklarace"))
			{
				$poc = $res->numRows();

				if ($poc > 0)
				{
					$vypis = 
					"<table border=\"1\">
						<tr>
							<td>#</td>
							<td>Název</td>
							<td>Akce</td>
						</tr>";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//načítání hodnot do objetku
						$vypis .= "<tr>
												<td>$data->id</td>
												<td>$data->nazev</td>
												<td><a href=\"?action=del_dek-$data->id\">smazat</a></td>
											</tr>";
					}
					$vypis .= "</table>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			print $vypis;
		}
	//****************************************************************************
		function VypisHodnotyDel($objekt)
		{
			if ($res = $objekt->query("SELECT hodnota.id as id, deklarace.nazev as deklarace, hodnota.nazev as hodnota, poznamka FROM deklarace, hodnota WHERE deklarace.id=hodnota.iddek"))
			{
				$poc = $res->numRows();

				if ($poc > 0)
				{
					$vypis = 
					"<table border=\"1\">
						<tr>
							<td>#</td>
							<td>Deklarace</td>
							<td>Název</td>
							<td>Poznámka</td>
							<td>Akce</td>
						</tr>";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//načítání hodnot do objetku
						$vypis .= "<tr>
												<td>$data->id</td>
												<td>$data->deklarace</td>
												<td>$data->hodnota</td>
												<td>$data->poznamka</td>
												<td><a href=\"?action=del_hod-$data->id\">smazat</a></td>
											</tr>";
					}
					$vypis .= "</table>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			print $vypis;
		}
	//****************************************************************************
		function RozbalovaciVypisDeklarace($objekt)
		{
			if ($res = $objekt->query("SELECT * FROM deklarace"))
			{
				$poc = $res->numRows();

				if ($poc > 0)
				{
					$vypis = 
					"<select name=\"deklarace\">\n";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//načítání hodnot do objetku
						$vypis .= "<option value=\"$data->id\">$data->nazev</option>\n";
					}
					$vypis .= "</select>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			return $vypis;
		}
	//****************************************************************************
		function RozbalovaciVypisDeklaraceEdit($objekt, $id)
		{
			if ($res = $objekt->query("SELECT * FROM deklarace"))
			{
				$poc = $res->numRows();

				if ($poc > 0)
				{
					$vypis = 
					"<select name=\"deklarace\">\n";
					
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();	//načítání hodnot do objetku
						if ($id == $data->id)
						{
							$oznac = "selected";
						}
							else
						{
							$oznac = "";
						}

						$vypis .= "<option $oznac value=\"$data->id\">$data->nazev</option>\n";
					}
					$vypis .= "</select>";
				}
					else
				{
					$vypis = "nedostatek dat";
				}
			}
				else
			{
				$vypis = "něco se pokazilo";
			}
			
			return $vypis;
		}
	//****************************************************************************
		function PocetDeklaraci($objekt)
		{
			if ($res = $objekt->query("SELECT COUNT(*) as pocet FROM deklarace"))
			{
				$data = $res->fetchObject();
				return $data->pocet;
			}
				else
			{
				return "něco se pokazilo";
			}
		}
	//****************************************************************************
		function PocetHodnot($objekt)
		{
			if ($res = $objekt->query("SELECT COUNT(*) as pocet FROM hodnota"))
			{
				$data = $res->fetchObject();
				return $data->pocet;
			}
				else
			{
				return "něco se pokazilo";
			}
		}
	//****************************************************************************
		var $start, $konec;
		function MeritCas() //funkce pro vrácení času
		{
		  $cas = explode(" ", microtime());
			$soucet = $cas[1] + $cas[0];
			return $soucet;
		}
	//****************************************************************************
		function StartCas() //zapis začátku
		{
			$this->start = $this->MeritCas();
		}
	//****************************************************************************
		function KonecCas() //zápis konce a finální vypis doby
		{
			$this->konec = $this->MeritCas();
			$presnost = 10000; //nastavená přesnost
			$cas = Abs(((Round(($this->konec - $this->start) * $presnost)) / $presnost) * 1000); //výpočet
			return "$cas us"; 
		}
	//****************************************************************************
		function KontrolaLoginu($jmeno, $heslo)
		{
			$login = array ("Geniv", "tecraasus", "Fugess", "SonySamsung"); //zápis loginů
			$poc = 0;
			
			for ($i = 0; $i < (count($login) / 2) + 1; $i++)
			{
				if ($jmeno == $login[$i] && $heslo == $login[$i + 1])
				{
					$poc++;
				}
			}
			
			if ($poc == 1)
			{
				return true;
			}
				else
			{
				return false;
			}
		}
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
	//****************************************************************************
		function PridejDeklaraci($objekt, $nazev)
		{
			$nazev = stripslashes(htmlspecialchars($nazev));
			if ($objekt->query("INSERT INTO deklarace(nazev) VALUES ('$nazev')"))
			{
				print "přidána deklarace: $nazev {$this->AutoClick(1, "$this->soubor?action=add_dek")}";
			}
				else
			{
				print "něco se podělalo {$this->AutoClick(1, "$this->soubor?action=add_dek")}";
			}
		}
	//****************************************************************************
		function UpravDeklaraci($objekt, $nazev, $id)
		{
			$nazev = stripslashes(htmlspecialchars($nazev));
			if ($objekt->query("UPDATE deklarace SET nazev='$nazev' WHERE id=$id"))
			{
				print "upravena deklarace: $nazev {$this->AutoClick(1, "$this->soubor?action=edit_dek")}";
			}
				else
			{
				print "něco se podělalo {$this->AutoClick(1, "$this->soubor?action=edit_dek")}";
			}
		}
	//****************************************************************************
		function SmazDeklaraci($objekt, $id)
		{
			if ($objekt->query("DELETE FROM deklarace WHERE id=$id"))
			{
				print "deklarace smazána {$this->AutoClick(1, "$this->soubor?action=del_dek")}";
			}
				else
			{
				print "něco se podělalo {$this->AutoClick(1, "$this->soubor?action=del_dek")}";
			}
		}
	//****************************************************************************
		function PridejHodnotu($objekt, $dek, $nazev, $poznamka)
		{
			$nazev = stripslashes(htmlspecialchars($nazev));
			$poznamka = stripslashes(htmlspecialchars($poznamka));
			if ($objekt->query("INSERT INTO hodnota(iddek, nazev, poznamka) VALUES ($dek, '$nazev', '$poznamka')"))
			{
				print "hodnota přidána: $dek, $nazev {$this->AutoClick(1, "$this->soubor?action=add_hod")}";
			}
				else
			{
				print "něco se podělalo {$this->AutoClick(1, "$this->soubor?action=add_hod")}";
			}
		}
	//****************************************************************************
		function UpravHodnotu($objekt, $dek, $nazev, $poznamka, $id)
		{
			$nazev = stripslashes(htmlspecialchars($nazev));
			$poznamka = stripslashes(htmlspecialchars($poznamka));
			if ($objekt->query("UPDATE hodnota SET iddek=$dek WHERE id=$id"))
			{
				if ($objekt->query("UPDATE hodnota SET nazev='$nazev' WHERE id=$id"))
				{
					if ($objekt->query("UPDATE hodnota SET poznamka='$poznamka' WHERE id=$id"))
					{
						$vysledek = true;
					}
						else
					{
						$vysledek = false;
					}
				}
					else
				{
					$vysledek = false;
				}
			}
				else
			{
				$vysledek = false;
			}
			
			if ($vysledek)
			{
				print "hodnota upravena: $dek, $nazev, $poznamka {$this->AutoClick(1, "$this->soubor?action=edit_hod")}";
			}
				else
			{
				print "něco se podělalo {$this->AutoClick(1, "$this->soubor?action=edit_hod")}";
			}
		}
	//****************************************************************************
		function SmazHodnotu($objekt, $id)
		{
			if ($objekt->query("DELETE FROM hodnota WHERE id=$id"))
			{
				print "hodnota smazána {$this->AutoClick(1, "$this->soubor?action=del_hod")}";
			}
				else
			{
				print "něco se podělalo {$this->AutoClick(1, "$this->soubor?action=del_hod")}";
			}
		}
	//****************************************************************************
		function AutoClick($cas, $cesta)
		{
			return "<head><meta http-equiv=\"refresh\" content=\"$cas;URL=$cesta\"></head>";
		}
	//****************************************************************************
	}
?>
