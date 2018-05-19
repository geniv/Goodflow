<?php
//******************************************************************************
//******************************************************************************
//******************************************************************************
include_once "login.php";
class Databaze extends Login
{
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
	function PripojMySQLi()
	{
		$this->mysqli = @new mysqli($this->host, $this->username, $this->password, $this->databaze, $this->port);

		if (!mysqli_connect_errno())	//objektové připojení do DB mysqli_connect_errno()
		{

			if (@$this->mysqli->multi_query("SET CHARACTER SET UTF8"))	//bez návratu testuje jen chybu s negací
			{
				$result = true;
			}
				else
			{
				$this->chyba = $this->ErrorMsg($this->mysqli->error);
			}
		}
			else
		{
			$result = false;
			$this->chyba = $this->ErrorMsg(mysqli_connect_error());
		}

		return $result;
	}
//******************************************************************************
	function ZavriMySQLi()
	{
		$this->mysqli->close();	//uzavření DB
	}
//******************************************************************************
  function Existuje() //oveří existenci a vrátí logickou hodnotu
  {
		if ($res = @$this->mysqli->query("SHOW DATABASES"))
		{
			$poc = $res->num_rows;
			$pex = 0;

			while ($data = $res->fetch_object())
			{
				if ($data->Database == $this->databaze)
				{
					$pex++;
				}
			}

			if ($pex == 1)
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
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		return $result;
	}
//******************************************************************************
	function ExistujeTabulka($nazev)
	{
		if ($res = @$this->mysqli->query("SHOW TABLES"))
		{
			$poc = $res->num_rows;
			$pex = 0;
			$tab = "Tables_in_{$this->databaze}";

			while ($data = $res->fetch_object())
			{
				if ($data->$tab == $nazev)
				{
					$pex++;
				}
			}

			if ($pex == 1)
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
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		return $result;
	}
//******************************************************************************
	function VytvorDB() //vytvoří složku o jméně
	{
		if (@$this->mysqli->multi_query("CREATE DATABASE $this->databaze;")) //pošle dotaz na vytvoření
		{
			$result = true;
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);
			$result = false;
		}

		return $result;
	}
//******************************************************************************
	function VypisTabulkuUplne($sql)
	{
		if ($res = @$this->mysqli->query($sql)) //dotaz
		{
			$slo = $res->field_count; //načte počet sloupců
			$poc = $res->num_rows; //načtení počtu řádků
			$pole = "";

			if ($poc > 0)
			{
				$vystup = "

        <table summary=\"Výpis všech tabulek\">
          <caption>Výpis všech tabulek</caption>
          <thead>
            <tr>"; //začátek
				for ($i = 0; $i < $slo; $i++) //generování hlavičky
				{
					$data = $res->fetch_field();	//fetch_field_direct($i);
					$vystup .= "
              <th scope=\"col\">$data->name</th>";
					$pole[$i] = $data->name;
				}
				$vystup .= "
            </tr>
          </thead>";

				for ($i = 0; $i < $poc; $i++) //generování obsahu
				{
					$vystup .= "

          <tbody>
            <tr>";
					$rada = $res->fetch_object();
					for ($j = 0; $j < $slo; $j++)
					{
						$vystup .= "
              <td scope=\"row\">{$rada->$pole[$j]}</td>";
					}
					$vystup .= "
            </tr>
          </tbody>";
				}
				$vystup .= "
        </table>";

				$result = $vystup;
			}
				else
			{
				$result = "
        <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
          <div class=\"pozadi_obal_razeni_katal\">
            <p>
              <strong>Prázdná tabulka</strong>
            </p>
          </div>
        <div class=\"pozadi_bottom_razeni_katal\"></div>
        "; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		return $result;
	}
//******************************************************************************
}
//******************************************************************************
//******************************************************************************
//******************************************************************************
class KatalogDVD extends Databaze //vnuk třídy databáze
{
  var $instalace = false;  //true/false = instaluje/neinstaluje
  var $Tkam = "";
	var $oddel = "-"; //zadaný oddělovač adresy
	var $nazevstyl = "./styles/glotyl.lg";
	var $dab;	//objekt databáze stylu
	var $setstyl; //gobání proměnná nasavení stylu
	var $stranlite;	//objekt databáze stránkování
	var $globstran;
	var $stran_od = 0;
	var $stran_poc = 4;
	var $katpocnazev = ".pocitadlo_katalog.huh";  //jméno databáze počítadla
	var $katpoc;
	var $nazevstranlite = "strankovani.baf";	//jméno databáze stránkování
	var $katlog;
	var $nazevkatlog = ".logovani.katalog";

	var $titlehlavicka = array("complet" => "Výpis katalogu",
                             "search" => "Hledat",
                             "add_dvd" => "Přidat položku katalogu",
                             "edit_dvd" => "Upravit položku katalogu",
                             "del_dvd" => "Smazat položku katalogu",
                             "add_kategory" => "Přidat žánr",
                             "edit_kategory" => "Upravit žánr",
                             "del_kategory" => "Smazat žánr",
                             "add_medium" => "Přidat médium",
                             "edit_medium" => "Upravit médium",
                             "del_medium" => "Smazat médium",
                             "all" => "Zobrazit celé tabulky",
                             "logoff" => "Odhlásit",
														 "statistic" => "Statistiky",
														 "adminpoc" => "Logování katalogu");
//******************************************************************************
	function RozdelCestu($cesta, $poradi)
	{
		$a = explode($this->oddel, $cesta); //rosekání adresy a vrácení žádaného výsledku

		return $a[$poradi];
	}
//******************************************************************************
	function emptytable()
  {
    $result = "
    <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
      <div class=\"pozadi_obal_razeni_katal\">
        <p>
          Prázdná tabulka v sekci: <strong>{$this->titlehlavicka[$this->Tkam]}</strong>
        </p>
      </div>
    <div class=\"pozadi_bottom_razeni_katal\"></div>
  ";

  	return $result;
  }
//******************************************************************************
	function HledejVyraz()
	{
		$slovo = $_GET["vyraz"];
		$sloupec = $_GET["sloupec"];
		$raz = $this->RozdelCestu($_GET["action"], 1);	//výraz
		$sme = $this->RozdelCestu($_GET["action"], 2);	//směr
		$str = $this->RozdelCestu($_GET["action"], 3);	//stránka

		if (Empty($raz))
		{
			$radit = "id";	//defaultní řazení
		}
			else
		{
			$radit = $raz;
		}

		if (Empty($sme))
		{
			$smer = "down";	//defaultní směr
		}
			else
		{
			$smer = $sme;
		}

		if (Empty($str))
		{
			$str = 1;	//defaultní stránka
		}

		$razeni = array("id" => "dvd.detachid",	//rozlišovač řazení
										"nazev" => "dvd.nazev",
										"kategorie" => "kategorie.nazev",
										"medium" => "medium.typ",
										"komentar" => "dvd.komentar",
										"pocet" => "dvd.pocet",
										"cas" => "DATE_FORMAT(datum, '%H:%i:%s')",
										"datum" => "radicidatum");

		$smerovani = array("up" => "DESC", "down" => "ASC");	//rozlišovač směřování

		$val = array("dvd.iddvd", "dvd.nazev", "kategorie.nazev", "medium.typ", "dvd.komentar", "dvd.pocet", "DATE_FORMAT(datum, '%H:%i:%s')", "DATE_FORMAT(datum, '%d.%m.%Y')");
		if ($res0 = @$this->mysqli->query("SELECT COUNT(*) as pocet FROM dvd, kategorie, medium WHERE dvd.idkategorie=kategorie.idkategorie AND dvd.idmedium=medium.idmedium AND ({$val[$sloupec]} LIKE ('%$slovo%'))")) //celkový počet
		{
			$allpoc = $res0->fetch_object()->pocet;	//celkový počet nalezených
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		$set_strana = $this->NastaveniStrankovani();	//dvd.iddvd as id,
		$strana = $this->Strankovani($allpoc, "&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}");
		if ($res = @$this->mysqli->query("SELECT
																			dvd.detachid,
																			dvd.nazev as nazev,
																			kategorie.nazev as kategorie,
																			medium.typ, dvd.komentar,
																			dvd.pocet,
																			DATE_FORMAT(datum, '%H:%i:%s') as cas,
																			DATE_FORMAT(datum, '%d.%m.%Y') as datum,
																			datum as radicidatum
																			FROM dvd, kategorie, medium
																			WHERE dvd.idkategorie=kategorie.idkategorie
																			AND dvd.idmedium=medium.idmedium
																			AND ({$val[$sloupec]} LIKE ('%$slovo%'))
																			ORDER BY {$razeni[$radit]} {$smerovani[$smer]},
																			detachid {$smerovani[$smer]}
																			LIMIT $this->stran_od, $this->stran_poc")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup =
				"
				<div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Hledaný výraz: <strong>$slovo</strong>
	          </p>
	          <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
	            Počet výsledků: <strong>$allpoc</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            <em>Řazení v hledání</em>
	          </p>
	          <div id=\"razeni_smer\">
	            <p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}down{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"vzestupně\">vzestupně</a>
	            </p>
	              <p>-</p>
	      			<p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}up{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"sestupně\">sestupně</a>
	            </p>
	          </div>
	  			</div>
	        <div class=\"pozadi_obal_razeni_katal razeni_vyska_p\">
	          <p class=\"id_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}id{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"#\"><em>#</em></a>
	          </p>
	          <p class=\"nazev_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}nazev{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Název\"><em>Název</em></a>
	          </p>
	          <p class=\"kategorie_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}kategorie{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Žánr\"><em>Žánr</em></a>
	          </p>
	          <p class=\"typ_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}medium{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Médium\"><em>Médium</em></a>
	          </p>
	          <p class=\"komentar_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}komentar{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Komentář\"><em>Komentář</em></a>
	          </p>
	          <p class=\"pocet_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}pocet{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Počet\"><em>Počet</em></a>
	          </p>
	          <p class=\"cas_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}cas{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Čas\"><em>Čas</em></a>
	          </p>
	          <p class=\"datum_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}datum{$this->oddel}{$smer}{$this->oddel}{$str}&vyraz={$_GET["vyraz"]}&sloupec={$_GET["sloupec"]}&tlacitko={$_GET["tlacitko"]}\" title=\"Datum\"><em>Datum</em></a>
	          </p>
	        </div>
	      <div class=\"pozadi_bottom_razeni_katal\"></div>
	      ";	//začátek tabulky

				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_obal_polozka_katal\">
					  <div class=\"pozadi_top_polozka_katal\"></div>
	    				<div class=\"pozadi_center_polozka_katal\">
	      				<p class=\"id_nazev vsechny_nazev\">#</p>
	      				<p class=\"nazev_nazev vsechny_nazev\">Název</p>
	      				<p class=\"kategorie_nazev vsechny_nazev\">Žánr</p>
	      				<p class=\"typ_nazev vsechny_nazev\">Médium</p>
	      				<p class=\"komentar_nazev vsechny_nazev\">Komentář</p>
	      				<p class=\"pocet_nazev vsechny_nazev\">Počet</p>
	      				<p class=\"cas_nazev vsechny_nazev\">Čas</p>
	      				<p class=\"datum_nazev vsechny_nazev\">Datum</p>
	      				<p class=\"id_hodnota vsechny_hodnota\" title=\"$data->detachid\">$data->detachid</p>
	      				<p class=\"nazev_hodnota vsechny_hodnota\">$data->nazev</p>
	      				<p class=\"kategorie_hodnota vsechny_hodnota\">$data->kategorie</p>
	      				<p class=\"typ_hodnota vsechny_hodnota\">$data->typ</p>
	      				<p class=\"komentar_hodnota vsechny_hodnota\">$data->komentar</p>
	      				<p class=\"pocet_hodnota vsechny_hodnota\">$data->pocet</p>
	      				<p class=\"cas_hodnota vsechny_hodnota\">$data->cas</p>
	      				<p class=\"datum_hodnota vsechny_hodnota\">$data->datum</p>
	            </div>
	          <div class=\"pozadi_bottom_polozka_katal\"></div>
	        </div>
	        "; //řádek tabulky
				}
				$vystup .=
				"
				$strana
	      $set_strana
				"; //konec tabulky

				$result = $vystup;
			}
				else
			{
				$result = "
	      <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Hledaný výraz: <strong>$slovo</strong> nebyl nalezen
	          </p>
	          <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
	            Počet výsledků: <strong>$poc</strong>
	          </p>
	          <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
	            Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
	      "; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisVyberuHledani()
	{
		$text = array("#", "Název", "Žánr", "Médium", "Komentář", "Počet", "Čas", "Datum");

		$vystup = "<select id=\"vyber_typ_hledani\" name=\"sloupec\">\n"; //začátek selectu
		for ($i = 0; $i < count($text); $i++) //vykreslovací cyklus
		{
			$vystup.="<option value=\"$i\">{$text[$i]}</option>\n"; //řádek selectu
		}
		$vystup.="</select>"; //konec selectu

		return $vystup; //vratí poskládaný select
	}
//******************************************************************************
	function PridejDVD($nazev, $komentar, $kategorie, $medium, $pocet)
	{
		$nazev = stripslashes(htmlspecialchars($nazev, ENT_QUOTES)); //první odstranit & a pak zohlednit "" a ''
		$komentar = stripslashes(htmlspecialchars($komentar, ENT_QUOTES));
		$poc = $this->PocetDVD();	//počet dvd
		$idealposl = range(1, $poc);	//ideální posloupnost

		if ($res = @$this->mysqli->query("SELECT detachid FROM dvd ORDER BY detachid"))
		{
			$pc = $res->num_rows;
			if ($pc > 0)
			{
				for ($i = 0; $i < $pc; $i++)
				{
					$realposl[$i] = $res->fetch_object()->detachid;	//reálná posloupnost
				}

				$chyby = array_diff($idealposl, $realposl);
				$resid = array_values($chyby);
				$id = $resid[count($resid) - 1];
			}

			if (Empty($id))	//pokud je prázdný
			{
				$id = $poc + 1;
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if (@$this->mysqli->multi_query("INSERT INTO dvd VALUES (NULL, $kategorie, $medium, $id, '$nazev', '$komentar', $pocet, NOW());"))
		{
			$result = "
	           <div class=\"pozadi_top_razeni_katal\"></div>
	         			<div class=\"pozadi_obal_razeni_katal\">
	           			<p>
	                   Byla přidána položka katalogu s názvem: <strong>$nazev</strong>
	                 </p>
	                 <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
	                   Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
	                 </p>
	         			</div>
	       			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
	             ";
	    include_once "rss.php";
			$web->VytvorRss("now");	//příkaz na znovu našteí dat do RSS
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		return $result;
	}
//******************************************************************************
	function PridejKategorii($nazev)
	{
		$nazev = stripslashes(htmlspecialchars($nazev, ENT_QUOTES));
		if (@$this->mysqli->multi_query("INSERT INTO kategorie VALUES (0, '$nazev')"))
		{
			$result = "
			       <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Byl přidán žánr s názvem: <strong>$nazev</strong>
                  </p>
                  <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal\"></div>
             ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function PridejMedium($typ)
	{
		$typ = stripslashes(htmlspecialchars($typ));
		if (@$this->mysqli->multi_query("INSERT INTO medium VALUES (0, '$typ')"))
		{
			$result = "
			       <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Bylo přidáno médium s názvem: <strong>$typ</strong>
                  </p>
                  <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal\"></div>
             ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function UpravDVD($id, $nazev, $komentar, $kategorie, $medium, $pocet)
	{
		$nazev = stripslashes(htmlspecialchars($nazev, ENT_QUOTES));
		$komentar = stripslashes(htmlspecialchars($komentar, ENT_QUOTES));

		if (@$this->mysqli->multi_query("UPDATE dvd SET idkategorie=$kategorie WHERE iddvd=$id") &&
				@$this->mysqli->multi_query("UPDATE dvd SET idmedium=$medium WHERE iddvd=$id") &&
				@$this->mysqli->multi_query("UPDATE dvd SET nazev='$nazev' WHERE iddvd=$id") &&
				@$this->mysqli->multi_query("UPDATE dvd SET komentar='$komentar' WHERE iddvd=$id") &&
				@$this->mysqli->multi_query("UPDATE dvd SET pocet=$pocet WHERE iddvd=$id") &&
				@$this->mysqli->multi_query("UPDATE dvd SET datum=NOW() WHERE iddvd=$id"))
		{
							$result = "
							<div class=\"pozadi_top_razeni_katal\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Byla upravena položka katalogu s názvem: <strong>$nazev</strong>
                  </p>
                  <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function UpravKategorii($id, $nazev)
	{
		$nazev = stripslashes(htmlspecialchars($nazev, ENT_QUOTES));
		if (@$this->mysqli->multi_query("UPDATE kategorie SET nazev='$nazev' WHERE idkategorie=$id"))
		{
			$result = "
			          <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	            			<p>
	                    Byl upraven žánr s názvem: <strong>$nazev</strong>
	                  </p>
	                  <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
	                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
	                  </p>
	          			</div>
	        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
	           ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function UpravMedium($id, $typ)
	{
		$typ = stripslashes(htmlspecialchars($typ, ENT_QUOTES));
		if (@$this->mysqli->multi_query("UPDATE medium SET typ='$typ' WHERE idmedium=$id"))
		{
			$result = "
			       <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Bylo upraveno médium s názvem: <strong>$typ</strong>
                  </p>
                  <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
             ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function SmazDVD($id, $nazev)
	{
		if (@$this->mysqli->multi_query("DELETE FROM dvd WHERE iddvd=$id"))
		{
			$result = "
			          <div class=\"pozadi_top_razeni_katal\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	            			<p>
	                    Byla smazána položka s názvem:
	                  </p>
	                  <p class=\"nazev_smazani_polozky\">
	                    $nazev
	                  </p>
	                  <p>
	                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
	                  </p>
	          			</div>
	        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
	            ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function SmazKategorii($id, $zanr)
	{
		if (@$this->mysqli->multi_query("DELETE FROM kategorie WHERE idkategorie=$id") &&
				@$this->mysqli->multi_query("DELETE FROM dvd WHERE idkategorie=$id"))
		{
				$result = "
				          <div class=\"pozadi_top_razeni_katal\"></div>
		          			<div class=\"pozadi_obal_razeni_katal\">
		            			<p>
		                    Byl smazán žánr s názvem:
		                  </p>
		                  <p class=\"nazev_smazani_polozky\">
		                    $zanr
		                  </p>
		                  <p>
		                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
		                  </p>
		          			</div>
		        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
		           ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function SmazMedium($id, $medium)
	{
		if (@$this->mysqli->multi_query("DELETE FROM medium WHERE idmedium=$id") &&
				@$this->mysqli->multi_query("DELETE FROM dvd WHERE idmedium=$id"))
		{
				$result = "
				          <div class=\"pozadi_top_razeni_katal\"></div>
		          			<div class=\"pozadi_obal_razeni_katal\">
		            			<p>
		                    Bylo smazáno médium s názvem:
		                  </p>
		                  <p class=\"nazev_smazani_polozky\">
		                    $medium
		                  </p>
		                  <p>
		                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
		                  </p>
		          			</div>
		        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
		           ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisKategorii()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM kategorie ORDER BY nazev")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "<select id=\"vyber_zanr_pridat_polozku\" name=\"kategorie\">\n"; //začátek selectu
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="<option value=\"$data->idkategorie\">$data->nazev</option>\n"; //řádek selectu
				}
				$vystup.="</select>"; //konec selectu

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				 $result = "prázdný seznam"; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisOznaceneKategorii($cislo)
	{
		if ($res = @$this->mysqli->query("SELECT * FROM kategorie ORDER BY nazev")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "<select id=\"vyber_zanr_pridat_polozku\" name=\"kategorie\">\n"; //začátek selectu
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					if ($cislo == $data->idkategorie)
					{
						$oznac = "selected=\"selected\"";
					}
						else
					{
						$oznac = "";
					}
					$vystup.="<option $oznac value=\"$data->idkategorie\">$data->nazev</option>\n"; //řádek selectu
				}
				$vystup.="</select>"; //konec selectu

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = "prázdný seznam"; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisTextKategorii($cislo)
	{
		if ($res = @$this->mysqli->query("SELECT * FROM kategorie WHERE idkategorie=$cislo")) //dotaz
		{
			$data = $res->fetch_object(); //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $data->nazev; //vrátí textově název
	}
//******************************************************************************
	function PocetKategorii()
	{
		if ($res = @$this->mysqli->query("SELECT COUNT(*) AS pocet FROM kategorie")) //dotaz
		{
			$poc = $res->fetch_object(); //načtení počtu řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $poc->pocet; //vrátí počet řádků
	}
//******************************************************************************
	function VypisMedium()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM medium ORDER BY typ")) //dotaz na medium
		{
			$poc = $res->num_rows;	//načtení počtu řádků

			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "<select id=\"vyber_medium_pridat_polozku\" name=\"medium\">\n";	//začátek selectu
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="<option value=\"$data->idmedium\">$data->typ</option>\n"; //řádek selectu
				}
				$vystup.="</select>"; //konec selectu

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = "prázdný seznam"; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisOznaceneMedium($cislo)
	{
		if ($res = @$this->mysqli->query("SELECT * FROM medium ORDER BY typ")) //dotaz na medium
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "<select id=\"vyber_medium_pridat_polozku\" name=\"medium\">\n";	//začátek selectu
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					if ($cislo == $data->idmedium)
					{
						$oznac = "selected=\"selected\"";
					}
						else
					{
						$oznac = "";
					}
					$vystup .= "<option $oznac value=\"$data->idmedium\">$data->typ</option>\n"; //řádek selectu
				}
				$vystup .= "</select>"; //konec selectu

				$result =  $vystup; //vratí poskládaný select
			}
				else
			{
				$result = "prázdný seznam"; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}
    return $result;
	}
//******************************************************************************
	function VypisTextMedium($cislo)
	{
		if ($res = @$this->mysqli->query("SELECT * FROM medium WHERE idmedium=$cislo")) //dotaz na počet
		{
			$result = $res->fetch_object()->typ; //vrátí textově typ
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function PocetMedium()
	{
		if ($res = @$this->mysqli->query("SELECT COUNT(*) AS pocet FROM medium")) //dotaz
		{
			$result = $res->fetch_object()->pocet; //vrátí počet řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		return $result;
	}
//******************************************************************************
	function PocetDVD()
	{
		if ($res = @$this->mysqli->query("SELECT COUNT(*) as pocet FROM dvd, kategorie, medium WHERE dvd.idkategorie=kategorie.idkategorie AND dvd.idmedium=medium.idmedium"))	//celkový počet
		{
			$result = $res->fetch_object()->pocet;
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		return $result;
	}
//******************************************************************************
	function VypisDVD()
	{
		$raz = $this->RozdelCestu($_GET["action"], 1);	//výraz
		$sme = $this->RozdelCestu($_GET["action"], 2);	//směr
		$str = $this->RozdelCestu($_GET["action"], 3);	//stránka

		if (Empty($raz))
		{
			$radit = "id";	//defaultní řazení
		}
			else
		{
			$radit = $raz;
		}

		if (Empty($sme))
		{
			$smer = "down";	//defaultní směr
		}
			else
		{
			$smer = $sme;
		}

		if (Empty($str))
		{
			$str = 1;	//default strana
		}

		$razeni = array("id" => "dvd.detachid",	//rozlišovač řazení
										"nazev" => "dvd.nazev",
										"kategorie" => "kategorie.nazev",
										"medium" => "medium.typ",
										"komentar" => "dvd.komentar",
										"pocet" => "dvd.pocet",
										"cas" => "DATE_FORMAT(datum, '%H:%i:%s')",
										"datum" => "radicidatum"); //DATE_FORMAT(datum, '%d.%m.%Y')

		$smerovani = array("up" => "DESC", "down" => "ASC");	//rozlišovač směřování

		$allpoc = $this->PocetDVD();	//zjištění počtu DVD
		$set_strana = $this->NastaveniStrankovani();	//nastavení stránkování
		$strana = $this->Strankovani($allpoc);	//stránkování  dvd.iddvd as id,

    if ($res = @$this->mysqli->query("SELECT
                                      kategorie.nazev as kategorie,
                                      medium.typ as typ,
                                      dvd.detachid,
                                      dvd.nazev as nazev,
                                      komentar,
                                      pocet,
                                      DATE_FORMAT(datum, '%H:%i:%s') as cas,
                                      DATE_FORMAT(datum, '%d.%m.%Y') as datum,
                                      datum as radicidatum
                                      FROM dvd, kategorie, medium
                                      WHERE dvd.idkategorie=kategorie.idkategorie
                                      AND dvd.idmedium=medium.idmedium
                                      ORDER BY {$razeni[$radit]} {$smerovani[$smer]},
																			detachid {$smerovani[$smer]}
                                      LIMIT $this->stran_od, $this->stran_poc"))
		{
			$poc = $res->num_rows;
			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Výpis obsahu katalogu
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            <em>Řazení katalogu</em>
	          </p>
	          <div id=\"razeni_smer\">
	            <p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}down{$this->oddel}{$str}\" title=\"vzestupně\">vzestupně</a>
	            </p>
	              <p>-</p>
	      			<p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}up{$this->oddel}{$str}\" title=\"sestupně\">sestupně</a>
	            </p>
	          </div>
	  			</div>
	        <div class=\"pozadi_obal_razeni_katal razeni_vyska_p\">
	          <p class=\"id_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}id{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"#\"><em>#</em></a>
	          </p>
	          <p class=\"nazev_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}nazev{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Název\"><em>Název</em></a>
	          </p>
	          <p class=\"kategorie_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}kategorie{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Žánr\"><em>Žánr</em></a>
	          </p>
	          <p class=\"typ_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}medium{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Médium\"><em>Médium</em></a>
	          </p>
	          <p class=\"komentar_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}komentar{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Komentář\"><em>Komentář</em></a>
	          </p>
	          <p class=\"pocet_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}pocet{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Počet\"><em>Počet</em></a>
	          </p>
	          <p class=\"cas_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}cas{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Čas\"><em>Čas</em></a>
	          </p>
	          <p class=\"datum_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}datum{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Datum\"><em>Datum</em></a>
	          </p>
	        </div>
	      <div class=\"pozadi_bottom_razeni_katal\"></div>
	      ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_obal_polozka_katal\" id=\"presmerovani_{$data->detachid}\">
					  <div class=\"pozadi_top_polozka_katal\"></div>
	    				<div class=\"pozadi_center_polozka_katal\">
	      				<p class=\"id_nazev vsechny_nazev\">#</p>
	      				<p class=\"nazev_nazev vsechny_nazev\">Název</p>
	      				<p class=\"kategorie_nazev vsechny_nazev\">Žánr</p>
	      				<p class=\"typ_nazev vsechny_nazev\">Médium</p>
	      				<p class=\"komentar_nazev vsechny_nazev\">Komentář</p>
	      				<p class=\"pocet_nazev vsechny_nazev\">Počet</p>
	      				<p class=\"cas_nazev vsechny_nazev\">Čas</p>
	      				<p class=\"datum_nazev vsechny_nazev\">Datum</p>
	      				<p class=\"id_hodnota vsechny_hodnota\" title=\"$data->detachid\">$data->detachid</p>
	      				<p class=\"nazev_hodnota vsechny_hodnota\">$data->nazev</p>
	      				<p class=\"kategorie_hodnota vsechny_hodnota\">$data->kategorie</p>
	      				<p class=\"typ_hodnota vsechny_hodnota\">$data->typ</p>
	       				<p class=\"komentar_hodnota vsechny_hodnota\">$data->komentar</p>
	      				<p class=\"pocet_hodnota vsechny_hodnota\">$data->pocet</p>
	      				<p class=\"cas_hodnota vsechny_hodnota\">$data->cas</p>
	      				<p class=\"datum_hodnota vsechny_hodnota\">$data->datum</p>
	            </div>
	          <div class=\"pozadi_bottom_polozka_katal\"></div>
	        </div>
	        "; //řádek tabulky
				}

				$vystup .=
				"
	      $strana
	      $set_strana
				"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisDvdEdit()
	{
		$raz = $this->RozdelCestu($_GET["action"], 1);	//výraz
		$sme = $this->RozdelCestu($_GET["action"], 2);	//směr
		$str = $this->RozdelCestu($_GET["action"], 3);	//stránka

		if (Empty($raz))
		{
			$radit = "id";	//defaultní řazení
		}
			else
		{
			$radit = $raz;
		}

		if (Empty($sme))
		{
			$smer = "down";	//defaultní směr
		}
			else
		{
			$smer = $sme;
		}

		if (Empty($str))
		{
			$str = 1;	//default strana
		}

		$razeni = array("id" => "dvd.detachid",	//rozlišovač řazení
										"nazev" => "dvd.nazev",
										"kategorie" => "kategorie.nazev",
										"medium" => "medium.typ",
										"komentar" => "dvd.komentar",
										"pocet" => "dvd.pocet",
										"cas" => "DATE_FORMAT(datum, '%H:%i:%s')",
										"datum" => "radicidatum");

		$smerovani = array("up" => "DESC", "down" => "ASC");	//rozlišovač směřování

		$allpoc = $this->PocetDVD();
		$set_strana = $this->NastaveniStrankovani();
		$strana = $this->Strankovani($allpoc);

		if ($res = @$this->mysqli->query("SELECT
																			dvd.iddvd as id,
																			dvd.detachid,
																			dvd.nazev as nazev,
																			kategorie.nazev as kategorie,
																			medium.typ as typ,
																			komentar,
																			pocet,
																			DATE_FORMAT(datum, '%H:%i:%s') as cas,
																			DATE_FORMAT(datum, '%d.%m.%Y') as datum,
																			datum as radicidatum
																			FROM dvd, kategorie, medium
																			WHERE dvd.idkategorie=kategorie.idkategorie
																			AND dvd.idmedium=medium.idmedium
																			ORDER BY {$razeni[$radit]} {$smerovani[$smer]},
																			detachid {$smerovani[$smer]}
																			LIMIT $this->stran_od, $this->stran_poc")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Výpis obsahu katalogu (<em>Upravit položku katalogu</em>)
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            <em>Řazení katalogu</em>
	          </p>
	          <div id=\"razeni_smer\">
	            <p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}down{$this->oddel}{$str}\" title=\"vzestupně\">vzestupně</a>
	            </p>
	              <p>-</p>
	      			<p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}up{$this->oddel}{$str}\" title=\"sestupně\">sestupně</a>
	            </p>
	          </div>
	  			</div>
	        <div class=\"pozadi_obal_razeni_katal razeni_vyska_p\">
	          <p class=\"id_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}id{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"#\"><em>#</em></a>
	          </p>
	          <p class=\"nazev_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}nazev{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Název\"><em>Název</em></a>
	          </p>
	          <p class=\"kategorie_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}kategorie{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Žánr\"><em>Žánr</em></a>
	          </p>
	          <p class=\"typ_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}medium{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Médium\"><em>Médium</em></a>
	          </p>
	          <p class=\"komentar_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}komentar{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Komentář\"><em>Komentář</em></a>
	          </p>
	          <p class=\"pocet_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}pocet{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Počet\"><em>Počet</em></a>
	          </p>
	          <p class=\"cas_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}cas{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Čas\"><em>Čas</em></a>
	          </p>
	          <p class=\"datum_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}datum{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Datum\"><em>Datum</em></a>
	          </p>
	        </div>
	      <div class=\"pozadi_bottom_razeni_katal\"></div>
	      ";	//začátek tabulky

				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_obal_polozka_katal\">
					  <div class=\"pozadi_top_polozka_katal\"></div>
	    				<div class=\"pozadi_center_polozka_katal\">
	      				<p class=\"id_nazev vsechny_nazev\">#</p>
	      				<p class=\"nazev_nazev vsechny_nazev\">Název</p>
	      				<p class=\"kategorie_nazev vsechny_nazev\">Žánr</p>
	      				<p class=\"typ_nazev vsechny_nazev\">Médium</p>
	      				<p class=\"komentar_nazev vsechny_nazev\">Komentář</p>
	      				<p class=\"pocet_nazev vsechny_nazev\">Počet</p>
	      				<p class=\"cas_nazev vsechny_nazev\">Čas</p>
	      				<p class=\"datum_nazev vsechny_nazev\">Datum</p>
	      				<p class=\"id_hodnota vsechny_hodnota\" title=\"$data->detachid\">$data->detachid</p>
	      				<p class=\"nazev_hodnota vsechny_hodnota\">$data->nazev</p>
	      				<p class=\"kategorie_hodnota vsechny_hodnota\">$data->kategorie</p>
	      				<p class=\"typ_hodnota vsechny_hodnota\">$data->typ</p>
	       				<p class=\"komentar_hodnota vsechny_hodnota\">$data->komentar</p>
	      				<p class=\"pocet_hodnota vsechny_hodnota\">$data->pocet</p>
	      				<p class=\"cas_hodnota vsechny_hodnota\">$data->cas</p>
	      				<p class=\"datum_hodnota vsechny_hodnota\">$data->datum</p>
	      				<span></span>
	              <p class=\"novy_radek_upravit_smazat\">
	        				<a href=\"?action=edit_dvd{$this->oddel}{$this->oddel}{$this->oddel}{$this->oddel}$data->id\" title=\"Upravit položku katalogu\">Upravit položku katalogu</a>
	              </p>
	            </div>
	          <div class=\"pozadi_bottom_polozka_katal\"></div>
	        </div>
	      "; //řádek tabulky
				}
				$vystup.="
				$strana
	      $set_strana
				"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisKategorieEdit()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM kategorie ORDER BY nazev")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup = "
	              <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	                  <p class=\"id_zanr_medium\">
	                    <strong>###</strong>
	                  </p>
	                  <p>
	                    <strong>Název žánru</strong>
	                  </p>
	                  <p class=\"odsazeni_mezi_dvema_odstavci\">
	                    (<strong>Upravit žánr</strong>)
	                  </p>
	                </div>
	              <div class=\"pozadi_bottom_razeni_katal mirne_odsazeni_zespodu\"></div>
	              ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_top_razeni_katal\"></div>
	          <div class=\"pozadi_obal_razeni_katal\">
	    				<p class=\"id_zanr_medium_hodnota\">
	              $data->idkategorie
	            </p>
	            <p class=\"nazev_zanr_medium_hodnota\">
	              $data->nazev
	            </p>
	            <p class=\"odsazeni_mezi_dvema_odstavci\">
	              (<em><a href=\"?action=edit_kategory{$this->oddel}{$this->oddel}{$this->oddel}{$this->oddel}$data->idkategorie\" title=\"Upravit\">Upravit</a></em>)
	            </p>
	          </div>
	        <div class=\"pozadi_bottom_razeni_katal\"></div>
	                 "; //řádek tabulky
				}
				$vystup.="<span class=\"display_block odsazeni_zespodu\"></span>"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
  function VypisKategorieObsah()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM kategorie ORDER BY nazev")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup = "
				       <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	                  <p class=\"id_zanr_medium\">
	                    <strong>###</strong>
	                  </p>
	                  <p class=\"nazev_zanr_medium\">
	                    <strong>Název žánru</strong>
	                  </p>
	                </div>
	              <div class=\"pozadi_bottom_razeni_katal mirne_odsazeni_zespodu\"></div>
	                ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_top_razeni_katal\"></div>
	          <div class=\"pozadi_obal_razeni_katal\">
	      			<p class=\"id_zanr_medium_hodnota\">
	              $data->idkategorie
	            </p>
	            <p class=\"nazev_zanr_medium_hodnota\">
	              $data->nazev
	            </p>
	          </div>
	        <div class=\"pozadi_bottom_razeni_katal\"></div>
	        "; //řádek tabulky
				}
				$vystup.="<span class=\"display_block odsazeni_zespodu\"></span>"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisMediumEdit()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM medium ORDER BY typ")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup = "
	              <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	                  <p class=\"id_zanr_medium\">
	                    <strong>###</strong>
	                  </p>
	                  <p class=\"nazev_zanr_medium\">
	                    <strong>Název média</strong>
	                  </p>
	                  <p class=\"odsazeni_mezi_dvema_odstavci\">
	                    (<strong>Upravit médium</strong>)
	                  </p>
	                </div>
	              <div class=\"pozadi_bottom_razeni_katal mirne_odsazeni_zespodu\"></div>
	                ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_top_razeni_katal\"></div>
	          <div class=\"pozadi_obal_razeni_katal\">
	    				<p class=\"id_zanr_medium_hodnota\">
	              $data->idmedium
	            </p>
	            <p class=\"nazev_zanr_medium_hodnota\">
	              $data->typ
	            </p>
	            <p class=\"odsazeni_mezi_dvema_odstavci\">
	              (<em><a href=\"?action=edit_medium{$this->oddel}{$this->oddel}{$this->oddel}{$this->oddel}$data->idmedium\" title=\"Upravit\">Upravit</a></em>)
	            </p>
	          </div>
	        <div class=\"pozadi_bottom_razeni_katal\"></div>
	        "; //řádek tabulky
				}
				$vystup.="<span class=\"display_block odsazeni_zespodu\"></span>"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisMediumObsah()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM medium ORDER BY typ")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup = "<div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	                  <p class=\"id_zanr_medium\">
	                    <strong>###</strong>
	                  </p>
	                  <p class=\"nazev_zanr_medium\">
	                    <strong>Název média</strong>
	                  </p>
	                </div>
	              <div class=\"pozadi_bottom_razeni_katal mirne_odsazeni_zespodu\"></div>";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_top_razeni_katal\"></div>
	          <div class=\"pozadi_obal_razeni_katal\">
	    				<p class=\"id_zanr_medium_hodnota\">
	              $data->idmedium
	            </p>
	            <p class=\"nazev_zanr_medium_hodnota\">
	              $data->typ
	            </p>
	          </div>
	        <div class=\"pozadi_bottom_razeni_katal\"></div>
	                 "; //řádek tabulky
				}
				$vystup.="<span class=\"display_block odsazeni_zespodu\"></span>"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisDvdDel()
	{
		$raz = $this->RozdelCestu($_GET["action"], 1);	//výraz
		$sme = $this->RozdelCestu($_GET["action"], 2);	//směr
		$str = $this->RozdelCestu($_GET["action"], 3);	//stránka

		if (Empty($raz))
		{
			$radit = "id";	//defaultní řazení
		}
			else
		{
			$radit = $raz;
		}

		if (Empty($sme))
		{
			$smer = "down";	//defaultní směr
		}
			else
		{
			$smer = $sme;
		}

		if (Empty($str))
		{
			$str = 1;
		}

		$razeni = array("id" => "dvd.detachid",	//rozlišovač řazení
										"nazev" => "dvd.nazev",
										"kategorie" => "kategorie.nazev",
										"medium" => "medium.typ",
										"komentar" => "dvd.komentar",
										"pocet" => "dvd.pocet",
										"cas" => "DATE_FORMAT(datum, '%H:%i:%s')",
										"datum" => "radicidatum");

		$smerovani = array("up" => "DESC", "down" => "ASC");	//rozlišovač směřování

		$allpoc = $this->PocetDVD();
		$set_strana = $this->NastaveniStrankovani();
		$strana = $this->Strankovani($allpoc);

		if ($res = @$this->mysqli->query("SELECT
																			dvd.iddvd as id,
																			dvd.detachid,
																			dvd.nazev as nazev,
																			kategorie.nazev as kategorie,
																			medium.typ as typ,
																			komentar,
																			pocet,
																			DATE_FORMAT(datum, '%H:%i:%s') as cas,
																			DATE_FORMAT(datum, '%d.%m.%Y') as datum,
																			datum as radicidatum
																			FROM dvd, kategorie, medium
																			WHERE dvd.idkategorie=kategorie.idkategorie
																			AND dvd.idmedium=medium.idmedium
																			ORDER BY {$razeni[$radit]} {$smerovani[$smer]},
																			detachid {$smerovani[$smer]}
																			LIMIT $this->stran_od, $this->stran_poc")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Výpis obsahu katalogu (<em>Smazat položku katalogu</em>)
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
				<div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            <em>Řazení katalogu</em>
	          </p>
	          <div id=\"razeni_smer\">
	            <p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}down{$this->oddel}{$str}\" title=\"vzestupně\">vzestupně</a>
	            </p>
	              <p>-</p>
	      			<p>
	              <a href=\"?action={$this->Tkam}{$this->oddel}{$radit}{$this->oddel}up{$this->oddel}{$str}\" title=\"sestupně\">sestupně</a>
	            </p>
	          </div>
	  			</div>
	        <div class=\"pozadi_obal_razeni_katal razeni_vyska_p\">
	          <p class=\"id_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}id{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"#\"><em>#</em></a>
	          </p>
	          <p class=\"nazev_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}nazev{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Název\"><em>Název</em></a>
	          </p>
	          <p class=\"kategorie_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}kategorie{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Žánr\"><em>Žánr</em></a>
	          </p>
	          <p class=\"typ_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}medium{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Médium\"><em>Médium</em></a>
	          </p>
	          <p class=\"komentar_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}komentar{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Komentář\"><em>Komentář</em></a>
	          </p>
	          <p class=\"pocet_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}pocet{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Počet\"><em>Počet</em></a>
	          </p>
	          <p class=\"cas_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}cas{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Čas\"><em>Čas</em></a>
	          </p>
	          <p class=\"datum_nazev vsechny_nazev\">
	            <a href=\"?action={$this->Tkam}{$this->oddel}datum{$this->oddel}{$smer}{$this->oddel}{$str}\" title=\"Datum\"><em>Datum</em></a>
	          </p>
	        </div>
	      <div class=\"pozadi_bottom_razeni_katal\"></div>
	                 ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_obal_polozka_katal\">
					  <div class=\"pozadi_top_polozka_katal\"></div>
	    				<div class=\"pozadi_center_polozka_katal\">
	      				<p class=\"id_nazev vsechny_nazev\">#</p>
	      				<p class=\"nazev_nazev vsechny_nazev\">Název</p>
	      				<p class=\"kategorie_nazev vsechny_nazev\">Žánr</p>
	      				<p class=\"typ_nazev vsechny_nazev\">Médium</p>
	      				<p class=\"komentar_nazev vsechny_nazev\">Komentář</p>
	      				<p class=\"pocet_nazev vsechny_nazev\">Počet</p>
	      				<p class=\"cas_nazev vsechny_nazev\">Čas</p>
	      				<p class=\"datum_nazev vsechny_nazev\">Datum</p>
	      				<p class=\"id_hodnota vsechny_hodnota\" title=\"$data->detachid\">$data->detachid</p>
	      				<p class=\"nazev_hodnota vsechny_hodnota\">$data->nazev</p>
	      				<p class=\"kategorie_hodnota vsechny_hodnota\">$data->kategorie</p>
	      				<p class=\"typ_hodnota vsechny_hodnota\">$data->typ</p>
	       				<p class=\"komentar_hodnota vsechny_hodnota\">$data->komentar</p>
	      				<p class=\"pocet_hodnota vsechny_hodnota\">$data->pocet</p>
	      				<p class=\"cas_hodnota vsechny_hodnota\">$data->cas</p>
	      				<p class=\"datum_hodnota vsechny_hodnota\">$data->datum</p>
	      				<span></span>
	              <p class=\"novy_radek_upravit_smazat\">
	        				<a href=\"?action=del_dvd{$this->oddel}{$this->oddel}{$this->oddel}{$this->oddel}$data->id\"  title=\"Smazat položku katalogu\">Smazat položku katalogu</a>
	              </p>
	            </div>
	          <div class=\"pozadi_bottom_polozka_katal\"></div>
	        </div>
	                  "; //řádek tabulky
				}
				$vystup.="
				$strana
	      $set_strana
				"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisKategorieDel()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM kategorie ORDER BY nazev")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup = "
	              <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	                  <p class=\"id_zanr_medium\">
	                    <strong>###</strong>
	                  </p>
	                  <p class=\"nazev_zanr_medium\">
	                    <strong>Název žánru</strong>
	                  </p>
	                  <p class=\"odsazeni_mezi_dvema_odstavci\">
	                    (<strong>Smazat žánr</strong>)
	                  </p>
	                </div>
	              <div class=\"pozadi_bottom_razeni_katal mirne_odsazeni_zespodu\"></div>
	                ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_top_razeni_katal\"></div>
	          <div class=\"pozadi_obal_razeni_katal\">
	    				<p class=\"id_zanr_medium_hodnota\">
	              $data->idkategorie
	            </p>
	            <p class=\"nazev_zanr_medium_hodnota\">
	              $data->nazev
	            </p>
	            <p class=\"odsazeni_mezi_dvema_odstavci\">
	              (<em><a href=\"?action=del_kategory{$this->oddel}{$this->oddel}{$this->oddel}{$this->oddel}$data->idkategorie\" title=\"Smazat\">Smazat</a></em>)
	            </p>
	          </div>
	        <div class=\"pozadi_bottom_razeni_katal\"></div>
	                 "; //řádek tabulky
				}
				$vystup.="<span class=\"display_block odsazeni_zespodu\"></span>"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result =  $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
	function VypisMediumDel()
	{
		if ($res = @$this->mysqli->query("SELECT * FROM medium ORDER BY typ")) //dotaz
		{
			$poc = $res->num_rows; //načtení počtu řádků

			if ($poc > 0)
			{
				$vystup = "
	              <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	          			<div class=\"pozadi_obal_razeni_katal\">
	                  <p class=\"id_zanr_medium\">
	                    <strong>###</strong>
	                  </p>
	                  <p class=\"nazev_zanr_medium\">
	                    <strong>Název média</strong>
	                  </p>
	                  <p class=\"odsazeni_mezi_dvema_odstavci\">
	                    (<strong>Smazat médium</strong>)
	                  </p>
	                </div>
	              <div class=\"pozadi_bottom_razeni_katal mirne_odsazeni_zespodu\"></div>
	                ";	//začátek tabulky
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetch_object(); //načítání řádků
					$vystup.="
					<div class=\"pozadi_top_razeni_katal\"></div>
	          <div class=\"pozadi_obal_razeni_katal\">
	    				<p class=\"id_zanr_medium_hodnota\">
	              $data->idmedium
	            </p>
	            <p class=\"nazev_zanr_medium_hodnota\">
	              $data->typ
	            </p>
	            <p class=\"odsazeni_mezi_dvema_odstavci\">
	              (<em><a href=\"?action=del_medium{$this->oddel}{$this->oddel}{$this->oddel}{$this->oddel}$data->idmedium\" title=\"Smazat\">Smazat</a></em>)
	            </p>
	          </div>
	        <div class=\"pozadi_bottom_razeni_katal\"></div>
	                 "; //řádek tabulky
				}
				$vystup.="<span class=\"display_block odsazeni_zespodu\"></span>"; //konec tabulky

				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = $this->emptytable(); //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

    return $result;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function Sekce()	//0=kam, 1=řadit, 2=směr, 3=stránka, 4=pracovní id,
	{
		if (!Empty($_GET["action"]))
		{
			$kam = $this->RozdelCestu($_GET["action"], 0); //načtení rozlišení sekce
		}
			else
		{
			$kam = "complet";
		}

		$this->Tkam = $kam; //naplnění vnitřní globální přoměnné

		switch($kam)
		{
//******************************************************************************
			case "complet":
				return $this->VypisDVD();
			break;
//******************************************************************************
			case "add_dvd":
				$result =
				"
          <form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend>Přidat položku katalogu</legend>
              <label for=\"nazev_pridat\" id=\"pridat_nazev_label\">Název:</label>
                <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"nazev\" />
              <label for=\"komentar_pridat\" id=\"pridat_komentar_label\">Komentář:</label>
                <input id=\"komentar_pridat\" class=\"pridat_komentar_input\" type=\"text\" name=\"komentar\" />
              <label for=\"pocet_disku_pridat\" id=\"pridat_pocet_disku_label\">Počet disků:</label>
                <input id=\"pocet_disku_pridat\" class=\"pridat_pocet_disku_input\" type=\"text\" name=\"pocet\" />
						  <label id=\"zanr_label\">Žánr:</label> {$this->VypisKategorii()}
						  <label id=\"medium_label\">Médium:</label> {$this->VypisMedium()}
        ";
						if ($this->PocetKategorii() != 0 &&
								$this->PocetMedium() != 0)
						{
							$result .= "<input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Přidat položku\" name=\"tlacitko\" />";
						}
				$result .=
					"</fieldset>
          </form>";

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["nazev"]) &&
						!Empty($_POST["komentar"]) &&
						!Empty($_POST["pocet"]) &&
						settype($_POST["pocet"], "integer") &&
						$_POST["pocet"] != 0 &&
						$this->PocetKategorii() != 0 &&
						$this->PocetMedium() != 0)
				{
					$result = $this->PridejDVD($_POST["nazev"], $_POST["komentar"], $_POST["kategorie"], $_POST["medium"], $_POST["pocet"]); //požadovaná akce
				}

				return $result;
			break;
//******************************************************************************
			case "add_kategory":
				$result =
				"
				  <form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend>Přidat žánr</legend>
              <label for=\"nazev_pridat\" class=\"pridat_nazev_label_trida\">Název žánru:</label>
                <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"nazev\" />
						  <input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Přidat žánr\" name=\"tlacitko\" />
						</fieldset>
          </form>
        ";

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["nazev"]))
				{
					$result = $this->PridejKategorii($_POST["nazev"]); //požadovaná akce
				}
				$result .= $this->VypisKategorieObsah();

				return $result;
			break;
//******************************************************************************
			case "add_medium":
				$result =
				"
          <form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend>Přidat médium</legend>
              <label for=\"nazev_pridat\" class=\"pridat_nazev_label_trida\">Název média:</label>
                <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"typ\" />
						  <input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Přidat médium\" name=\"tlacitko\" />
						</fieldset>
          </form>
        ";

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["typ"]))
				{
					$result = $this->PridejMedium($_POST["typ"]); //požadovaná akce
				}
				$result .= $this->VypisMediumObsah();

				return $result;
			break;
//******************************************************************************
//******************************************************************************
			case "edit_dvd":
				$id = $this->RozdelCestu($_GET["action"], 4);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->mysqli->query("SELECT dvd.nazev as nazev, kategorie.idkategorie as kategorie, medium.idmedium as typ, komentar, pocet FROM dvd, kategorie, medium WHERE dvd.idkategorie=kategorie.idkategorie AND dvd.idmedium=medium.idmedium AND iddvd=$id")) //dotaz
					{
						$data = $res->fetch_object(); //načítání řádků
					}
						else
					{
						$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
					}

					$result =
					"
					<form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend>Upravit položku katalogu</legend>
              <label for=\"nazev_pridat\" id=\"pridat_nazev_label\">Název:</label>
                <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"nazev\" value=\"$data->nazev\" />
              <label for=\"komentar_pridat\" id=\"pridat_komentar_label\">Komentář:</label>
                <input id=\"komentar_pridat\" class=\"pridat_komentar_input\" type=\"text\" name=\"komentar\" value=\"$data->komentar\" />
              <label for=\"pocet_disku_pridat\" id=\"pridat_pocet_disku_label\">Počet disků:</label>
                <input id=\"pocet_disku_pridat\" class=\"pridat_pocet_disku_input\" type=\"text\" name=\"pocet\" value=\"$data->pocet\" />
						  <label id=\"zanr_label\">Žánr:</label> {$this->VypisOznaceneKategorii($data->kategorie)}
						  <label id=\"medium_label\">Médium:</label> {$this->VypisOznaceneMedium($data->typ)}
          ";
							if ($this->PocetKategorii() != 0 &&
									$this->PocetMedium() != 0)
							{
								$result .= "<input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Upravit položku\" name=\"tlacitko\" />";
							}
					$result .=
						"</fieldset>
          </form>
          <span class=\"display_block odsazeni_zespodu\"></span>";
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["nazev"]) &&
						!Empty($_POST["komentar"]) &&
						!Empty($_POST["pocet"]) &&
						settype($_POST["pocet"], "integer") &&
						$_POST["pocet"] != 0 &&
						$this->PocetKategorii() != 0 &&
						$this->PocetMedium() != 0)
				{
					$result = $this->UpravDVD($id, $_POST["nazev"], $_POST["komentar"], $_POST["kategorie"], $_POST["medium"], $_POST["pocet"]);
				}

				$result .= $this->VypisDvdEdit(); //vypsání tabulky
				return $result;
			break;
//******************************************************************************
			case "edit_kategory":
				$id = $this->RozdelCestu($_GET["action"], 4);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->mysqli->query("SELECT * FROM kategorie WHERE idkategorie=$id")) //dotaz
					{
						$data = $res->fetch_object(); //načítání řádků
					}
						else
					{
						$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
					}

					$result =
					"
					<form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend>Upravit žánr</legend>
              <label for=\"nazev_pridat\" class=\"pridat_nazev_label_trida\">Název žánru:</label>
                <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"nazev\" value=\"$data->nazev\" />
          ";
							if ($this->PocetKategorii() != 0)
							{
								$result .= "<input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Upravit žánr\" name=\"tlacitko\" />";
							}
					$result .=
						"</fieldset>
          </form>";
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["nazev"]))
				{
					$result = $this->UpravKategorii($id, $_POST["nazev"]);
				}

				$result .= $this->VypisKategorieEdit(); //vypsání tabulky

				return $result;
			break;
//******************************************************************************
			case "edit_medium":
				$id = $this->RozdelCestu($_GET["action"], 4);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->mysqli->query("SELECT * FROM medium WHERE idmedium=$id")) //dotaz
					{
						$data = $res->fetch_object(); //načítání řádků
					}
						else
					{
						$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
					}

					$result =
					"
					<form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend>Upravit médium</legend>
              <label for=\"nazev_pridat\" class=\"pridat_nazev_label_trida\">Název média:</label>
                <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"typ\" value=\"$data->typ\" />
          ";
							if ($this->PocetMedium() != 0)
							{
								$result .= "<input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Upravit médium\" name=\"tlacitko\" />";
							}
					$result .=
						"</fieldset>
          </form>";
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["typ"]))
				{
					$result = $this->UpravMedium($id, $_POST["typ"]);
				}

				$result .= $this->VypisMediumEdit(); //vypsání tabulky

				return $result;
			break;
//******************************************************************************
//******************************************************************************
			case "del_dvd":
				$id = $this->RozdelCestu($_GET["action"], 4);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->mysqli->query("SELECT dvd.iddvd, dvd.nazev as nazev, kategorie.idkategorie as kategorie, medium.idmedium as typ, komentar, pocet FROM dvd, kategorie, medium WHERE dvd.idkategorie=kategorie.idkategorie AND dvd.idmedium=medium.idmedium AND iddvd=$id")) //dotaz
					{
						$data = $res->fetch_object(); //načítání řádků
					}
						else
					{
						$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
					}

					$result =
					"
					<form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend class=\"nadpis_smazani_polozky\">Chystáte se smazat položku s názvem:</legend>
              <label class=\"nazev_smazani_polozky\">$data->nazev</label>
              <label class=\"otazka\">Opravdu chcete tuto položku smazat ?</label>
          ";
							if ($this->PocetKategorii() != 0 &&
									$this->PocetMedium() != 0)
							{
								$result .=
								"
								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ano\" name=\"tlacitko\" />
								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ne\" name=\"tlacitko\" />
                ";
							}
					$result .=
						"</fieldset>
          </form>
          <span class=\"display_block odsazeni_zespodu\"></span>";
				}

				if (!Empty($_POST["tlacitko"]))	//připouštěcí podmínka
				{
					if ($_POST["tlacitko"] == "Ano")
					{
						$result = $this->SmazDVD($id, $data->nazev);
					}
						else
					{
						$result = "
						  <div class=\"pozadi_top_razeni_katal\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Byl stornován požadavek na smazání položky s názvem:
                  </p>
                  <p class=\"nazev_smazani_polozky\">
                    $data->nazev
                  </p>
                  <p>
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
            ";
					}
				}

				$result .= $this->VypisDvdDel(); //vypsání tabulky

				return $result;
			break;
//******************************************************************************
			case "del_kategory":
				$id = $this->RozdelCestu($_GET["action"], 4);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->mysqli->query("SELECT * FROM kategorie WHERE idkategorie=$id")) //dotaz
					{
						$data = $res->fetch_object(); //načítání řádků
					}
						else
					{
						$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
					}

				$result =
					"
					<form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend class=\"nadpis_smazani_polozky\">Chystáte se smazat žánr s názvem:</legend>
              <label class=\"nazev_smazani_polozky\">$data->nazev</label>
              <label class=\"otazka vystraha\">Smazáním tohoto žánru příjdete o</label>
              <label class=\"otazka vystraha\">položky katalogu s tímto žánrem !</label>
              <label class=\"otazka jemne_odsadit\">Opravdu chcete tuto položku smazat ?</label>
          ";
							if ($this->PocetKategorii() != 0)
							{
								$result .=
								"
								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ano\" name=\"tlacitko\" />
								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ne\" name=\"tlacitko\" />
                ";
							}
					$result .=
						"</fieldset>
          </form>
          <span class=\"display_block odsazeni_zespodu\"></span>";
				}

				if (!Empty($_POST["tlacitko"]))	//připouštěcí podmínka
				{
					if ($_POST["tlacitko"] == "Ano")
					{
						$result = $this->SmazKategorii($id, $data->nazev);
					}
						else
					{
						$result = "
						  <div class=\"pozadi_top_razeni_katal\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Byl stornován požadavek na smazání žánru s názvem:
                  </p>
                  <p class=\"nazev_smazani_polozky\">
                    $data->nazev
                  </p>
                  <p>
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
                     ";
					}
				}

				$result .= $this->VypisKategorieDel(); //vypsání tabulky

				return $result;
			break;
//******************************************************************************
			case "del_medium":
				$id = $this->RozdelCestu($_GET["action"], 4);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->mysqli->query("SELECT * FROM medium WHERE idmedium=$id")) //dotaz
					{
						$data = $res->fetch_object(); //načítání řádků
					}
						else
					{
						$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
					}

					$result =
					"
					<form id=\"pridat_polozku_form\" action=\"\" method=\"post\">
            <fieldset>
              <legend class=\"nadpis_smazani_polozky\">Chystáte se smazat médium s názvem:</legend>
              <label class=\"nazev_smazani_polozky\">$data->typ</label>
              <label class=\"otazka vystraha\">Smazáním tohoto média příjdete o</label>
              <label class=\"otazka vystraha\">položky katalogu s tímto médiem !</label>
              <label class=\"otazka jemne_odsadit\">Opravdu chcete tuto položku smazat ?</label>
          ";
							if ($this->PocetMedium() != 0)
							{
								$result .=
								"
								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ano\" name=\"tlacitko\" />
								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ne\" name=\"tlacitko\" />
                ";
							}
					$result .=
						"</fieldset>
          </form>
          <span class=\"display_block odsazeni_zespodu\"></span>";
				}

				if (!Empty($_POST["tlacitko"]))	//připouštěcí podmínka
				{
					if ($_POST["tlacitko"] == "Ano")
					{
						$result = $this->SmazMedium($id, $data->typ);
					}
						else
					{
						$result = "
						  <div class=\"pozadi_top_razeni_katal\"></div>
          			<div class=\"pozadi_obal_razeni_katal\">
            			<p>
                    Byl stornován požadavek na smazání média s názvem:
                  </p>
                  <p class=\"nazev_smazani_polozky\">
                    $data->typ
                  </p>
                  <p>
                    Pokračuj klapnutím <em><a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a></em>
                  </p>
          			</div>
        			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
                     ";
					}
				}

				$result .= $this->VypisMediumDel(); //vypsání tabulky

				return $result;
			break;
//******************************************************************************
//******************************************************************************
			case "all":
				$result = $this->VypisTabulkuUplne("SELECT * FROM dvd");
				$result .= $this->VypisTabulkuUplne("SELECT * FROM kategorie");
				$result .= $this->VypisTabulkuUplne("SELECT * FROM medium");

				return $result;
			break;
//******************************************************************************
//******************************************************************************
			case "search":
				$result = //{$this->NastaveniStrankovani()}
				"
          <form id=\"search_form\" action=\"index.php?action=search\" method=\"get\">
            <fieldset>
              <legend>Hledání</legend>
              <label for=\"search\" id=\"search_label\">Hledaný výraz:</label>
                <input id=\"search\" class=\"search_input\" type=\"text\" name=\"vyraz\" />
                {$this->VypisVyberuHledani()}
                <input id=\"search_tlacitko\" type=\"submit\" value=\"Hledat\" name=\"tlacitko\" />
                <input type=\"hidden\" value=\"{$this->Tkam}\" name=\"action\" />
            </fieldset>
          </form>
        ";

				if (!Empty($_GET["tlacitko"])&&
						!Empty($_GET["vyraz"]))
				{
					$result .= $this->HledejVyraz();
				}

				return $result;
			break;
//******************************************************************************
//******************************************************************************
			case "statistic":
				$result = $this->Statistiky();

        return $result;
			break;
//******************************************************************************
//******************************************************************************
      case "adminpoc":
        $akce = $this->RozdelCestu($_GET["action"], 1);

				if (!Empty($akce) && $akce == "zalohaDB")
				{
				  $hlaska = $this->ZalohovaciSystem();
				}

        $result =
        "
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Logování katalogu
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            <a href=\"?action=adminpoc-zalohaDB\" title=\"Zálohovat databázi\"><strong>Zálohovat databázi</strong></a>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        $hlaska
        {$this->VypisPocitadla()}
        <div class=\"pozadi_top_razeni_katal odsazeni_zhora\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
	            Logování přihlašování
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        {$this->VypisLoguPrihlasovani()}
        ";

        return $result;
      break;
//******************************************************************************
//******************************************************************************
		} //end switch
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function InstalaceMySQLi() //YYYY-MM-DD HH:MM:SS '2008-06-19 21:41:35' Y-m-d H:i:s
	{
    if ($this->instalace)
		{
			if (!$this->Existuje()) //instalace
			{
				if (!$this->VytvorDB())
				{
					$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
				}
			}

			if (!$this->ExistujeTabulka("dvd"))
			{
				if (!@$this->mysqli->multi_query("CREATE TABLE dvd (
		  																		iddvd INTEGER AUTO_INCREMENT PRIMARY KEY,
																					idkategorie INTEGER,
		  																		idmedium INTEGER,
		  																		detachid INTEGER UNIQUE,
		  																		nazev VARCHAR(200) UNIQUE,
																					komentar VARCHAR(300),
																					pocet INTEGER,
																					datum DATETIME);"))
				{
					$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
				}
			}

			if (!$this->ExistujeTabulka("kategorie"))
			{
				if (!@$this->mysqli->multi_query("CREATE TABLE kategorie (
																					idkategorie INTEGER AUTO_INCREMENT PRIMARY KEY,
																					nazev VARCHAR(30) UNIQUE);"))
				{
					$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
				}
			}

			if (!$this->ExistujeTabulka("medium"))
			{
				if (!@$this->mysqli->multi_query("CREATE TABLE medium (
																					idmedium INTEGER AUTO_INCREMENT PRIMARY KEY,
																					typ VARCHAR(10) UNIQUE);"))
				{
					$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
				}
			}
		}
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function Odkazy()
	{
		$result =
		"
    <div id=\"obal_prikazy\">
      <p>
        <a href=\"?action=complet\" title=\"Výpis katalogu\" id=\"vypis_katalogu\">Výpis katalogu</a>
      </p>
      <p>
        <a href=\"?action=search\" title=\"Hledat\" id=\"hledat\">Hledat</a>
      </p>
      <p>
        <a href=\"?action=add_dvd\" title=\"Přidat položku katalogu\" id=\"pridat_pk\">Přidat položku katalogu</a>
      </p>
      <p>
        <a href=\"?action=edit_dvd\" title=\"Upravit položku katalogu\" id=\"upravit_pk\">Upravit položku katalogu</a>
      </p>
      <p>
        <a href=\"?action=del_dvd\" title=\"Smazat položku katalogu\" id=\"smazat_pk\">Smazat položku katalogu</a>
      </p>
      <p>
        <a href=\"?action=add_kategory\" title=\"Přidat žánr\" id=\"pridat_zanr\">Přidat žánr</a>
      </p>
      <p>
        <a href=\"?action=edit_kategory\" title=\"Upravit žánr\" id=\"upravit_zanr\">Upravit žánr</a>
      </p>
      <p>
        <a href=\"?action=del_kategory\" title=\"Smazat žánr\" id=\"smazat_zanr\">Smazat žánr</a>
      </p>
      <p>
        <a href=\"?action=add_medium\" title=\"Přidat médium\" id=\"pridat_medium\">Přidat médium</a>
      </p>
      <p>
        <a href=\"?action=edit_medium\" title=\"Upravit médium\" id=\"upravit_medium\">Upravit médium</a>
      </p>
      <p>
        <a href=\"?action=del_medium\" title=\"Smazat médium\" id=\"smazat_medium\">Smazat médium</a>
      </p>
      <p>
        <a href=\"?action=all\" title=\"Zobrazit celé tabulky\" id=\"zobrazit_ct\">Zobrazit celé tabulky</a>
      </p>
      <p>
        <a href=\"?action=logoff\" title=\"Odhlásit\" id=\"odhlasit\">Odhlásit</a>
      </p>
    </div>";

    return $result;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function InstalaceStrankovani($nazev)	//instalace SQLite
	{
		if (filesize($nazev) == 0)
		{
			if (@$this->stranlite->queryExec("CREATE TABLE strankovani (id INTEGER AUTO_INCREMENT PRIMARY KEY,
																														 			kde VARCHAR(30) UNIQUE,
																														 			pocet INTEGER)", $error))
			{
				if (!@$this->stranlite->queryExec("INSERT INTO strankovani(kde, pocet) VALUES ('complet',	5);
																					INSERT INTO strankovani(kde, pocet) VALUES ('search',		5);
																					INSERT INTO strankovani(kde, pocet) VALUES ('edit_dvd',	5);
																					INSERT INTO strankovani(kde, pocet) VALUES ('del_dvd',	5);
																					INSERT INTO strankovani(kde, pocet) VALUES ('styl',			1);", $error))
				{
					$this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
				}
			}
				else
			{
				$this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
			}
		}
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function ObsahStylu()
	{
		$this->dab = @new SQLiteDatabase($this->nazevstyl);
		if ($res = @$this->dab->query("SELECT * FROM styl", NULL, $error))
		{
			$poc = $res->numRows();

			if ($res0 = @$this->dab->query("SELECT styl FROM nastaveni WHERE jmeno='styl'", NULL, $error))
			{
				$cislo = $res0->fetchObject()->styl;
			}
				else
			{
				$this->chyba = $this->ErrorMsg($error);
			}

			if ($poc > 0)
			{
				$vystup = "
				  <form id=\"vyber_styl_form\" action=\"\" method=\"get\">
            <fieldset>
              <legend>Nastavení stylu</legend>
              <select id=\"vyber_styl_select\" name=\"styl\">\n"; //začátek selectu
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetchObject();
					if ($cislo == $data->id)
					{
						$oznac = "selected=\"selected\"";
					}
						else
					{
						$oznac = "";
					}
					$vystup .= "<option $oznac value=\"$data->id\">$data->nazev</option>\n"; //řádek selectu
				}
				$vystup .= "</select>
										<input id=\"tlacitko_nastavit\" type=\"submit\" name=\"tlacitkostyl\" value=\"Nastavit\" />
										<input type=\"hidden\" name=\"action\" value=\"$this->Tkam\" />
										</fieldset>
          </form>"; //konec selectu
				if (!Empty($_GET["tlacitkostyl"]) &&
						!Empty($_GET["styl"]))
				{
					$this->setstyl = $this->NastavStyl($_GET["styl"]);
				}
			}
				else
			{
				$vystup = "&nbsp;"; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}

		return $vystup;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function NastavStyl($cislo)
	{
		if (@$this->dab->queryExec("UPDATE nastaveni SET styl=$cislo WHERE jmeno='styl'", $error))
		{
			$vyst = "
			<div class=\"pozice_nastaveni_polozek\">
        <div class=\"pozadi_top_razeni_katal\"></div>
    			<div class=\"pozadi_obal_razeni_katal\">
      			<p>
              Byl nastaven styl s názvem: <strong>{$this->VypisStyluText($cislo)}</strong>
            </p>
            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              Pokračuj klapnutím <a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a>
            </p>
    			</div>
  			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
			</div>
      "; // {$this->AutoClick(1, "index.php")}";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}

		return $vyst;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function VypisStyluText($cislo)	//výpis vybraného stylu při mazání
	{
		$res = $this->dab->query("SELECT * FROM styl WHERE id=$cislo");

		return $res->fetchObject()->nazev;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function KatalogDVD()
	{
		$this->StartCas();
		$this->stranlite = new SQLiteDatabase($this->nazevstranlite);	//vytoření globálního objektu
		$this->InstalaceStrankovani($this->nazevstranlite);	//instalace databáze
		$this->katpoc = new SQLiteDatabase($this->katpocnazev); //počítadlo
		$this->katlog = new SQLiteDatabase($this->nazevkatlog); //logování
		$this->LogovaniPrihlasovani();  //procedura chytajcí logování
		$pocitadlo = $this->Pocitadlo();  //výpis počítadla

		if ($con = $this->PripojMySQLi())
		{
      $this->InstalaceMySQLi(); //postará se o instalaci
  		$result1 = $this->Odkazy(); //odkazy stránek
  		$result1 .= $this->Sekce(); //rozdělování stránek
  		$styl = $this->ObsahStylu();	//select s výpisem stylů
  		$this->ZavriMySQLi(); //zavření DB
    }

		if (!Empty($_POST["jmeno"]) && !Empty($_POST["heslo"]))
	  {
			if ($this->KontrolaLogin(md5($_POST["jmeno"]), md5($_POST["heslo"]))) //heslo správně
	    {
	      SetCookie("JMENO", md5($_POST["jmeno"]), Time() + 31536000); //zápis do cookie
	      SetCookie("HESLO", md5($_POST["heslo"]), Time() + 31536000);
	      $prih = "
	      <div id=\"prihlaseni_accept\">
	        <div>
	          <a href=\"?action=$this->Tkam\" title=\"Byl jsi přihlášen.\">
	            <span id=\"prihlaseni_sipka_levy\"></span>
	            <span id=\"prihlaseni_accept_center\"></span>
	            <span id=\"prihlaseni_sipka_pravy\"></span>
	          </a>
	        </div>
	        <p>
	          <a href=\"?action=$this->Tkam\" title=\"Byl jsi přihlášen.\">Byl jsi přihlášen.</a>
	        </p>
	        <p>
	          <a href=\"?action=$this->Tkam\" title=\"Pro pokračování klapni na obrázek.\">Pro pokračování klapni na obrázek.</a>
	        </p>
	      </div>";
	    }
	    	else
	    {
	      $prih = "
	      <div id=\"prihlaseni_rejected\">
	        <div>
	          <a href=\"?action=$this->Tkam\" title=\"Zadal jsi neplatný login.\">
	            <span id=\"prihlaseni_sipka_levy\"></span>
	            <span id=\"prihlaseni_rejected_center\"></span>
	            <span id=\"prihlaseni_sipka_pravy\"></span>
	          </a>
	        </div>
	        <p>
	          <a href=\"?action=$this->Tkam\" title=\"Zadal jsi neplatný login.\">Zadal jsi neplatný login.</a>
	        </p>
	        <p>
	          <a href=\"?action=$this->Tkam\" title=\"Skus se znovu přihlásit.\">Skus se znovu přihlásit.</a>
	        </p>
	        <p>
	          <a href=\"?action=$this->Tkam\" title=\"Pro pokračování klapni na obrázek.\">Pro pokračování klapni na obrázek.</a>
	        </p>
	      </div>"; //heslo špatně
	    }
	  }

	  if(!Empty($_GET["action"]) && $_GET["action"] == "logoff")
		{
			SetCookie("JMENO", "", 0); //vymazání cookie
		  SetCookie("HESLO", "", 0);
		  $prih = "
        <div id=\"prihlaseni_accept\">
	        <div>
	          <a href=\"./\" title=\"Byl jsi odhlášen.\">
	            <span id=\"prihlaseni_sipka_levy\"></span>
	            <span id=\"prihlaseni_logoff_2_center\"></span>
	            <span id=\"prihlaseni_sipka_pravy\"></span>
	          </a>
	        </div>
	        <p>
	          <a href=\"./\" title=\"Byl jsi odhlášen.\">Byl jsi odhlášen.</a>
	        </p>
	        <p>
	          <a href=\"./\" title=\"Pro pokračování klapni na obrázek.\">Pro pokračování klapni na obrázek.</a>
	        </p>
	      </div>
		  ";
		}

		if (Empty($prih)) //je-li text nedefinován
		{
			$prih = "";
		}

		if (!Empty($_COOKIE["JMENO"]) && !Empty($_COOKIE["HESLO"]) && $this->KontrolaLogin($_COOKIE["JMENO"], $_COOKIE["HESLO"]))
		{
			$result =
			"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
					\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
			  <head>
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <meta http-equiv=\"Content-Language\" content=\"cs\" />
			    <meta name=\"author\" content=\"Geniv &amp; Fugess\" />
			    <meta name=\"copyright\" content=\"Geniv (c) 2008, Fugess (c) 2008\" />
			    <meta name=\"keywords\" content=\"Katalogový systém, Katalog, Katalog Fugess, Katalog Geniv, Katalog - {$this->titlehlavicka[$this->Tkam]}, {$this->titlehlavicka[$this->Tkam]}\" />
			    <meta name=\"description\" content=\"Katalogový systém\" />
			    <meta name=\"robots\" content=\"index, follow\" />
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.php\" media=\"screen\" />
			    <!--[if IE]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if IE 7]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if lte IE 6]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
			    <![endif]-->
			    	<link type=\"application/rss+xml\" rel=\"alternate\" href=\"rss\" />
			      <link rel=\"shortcut icon\" href=\"obr/favicon_katalog.ico\" />
			      <script type=\"text/javascript\" src=\"script/nove_okno.js\"></script>
			    <title>Katalog CD a DVD - {$this->titlehlavicka[$this->Tkam]}</title>
<!-- google analytics -->
          <script type=\"text/javascript\">
            var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
            document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
          </script>
          <script type=\"text/javascript\">
            var pageTracker = _gat._getTracker(\"UA-4450047-2\");
            pageTracker._initData();
            pageTracker._trackPageview();
          </script>
<!-- /google analytics -->
			  </head>
			    <body>
			      <div id=\"zahlavi\"></div>
			      <div id=\"obsah\">
	            <div id=\"stav_databaze\">";

			if (!$con) //připojení
			{
				$result .= "
                <p id=\"offline\">
                  Stav databáze
                </p>
	            </div>";
			}
				else
			{
				$result .= "
                <p id=\"online\">
                  Stav databáze
                </p>
	            </div>
              $result1
              $instal";

			}
				$result .= "
				 $this->setstyl
	       $prih
	       $this->chyba
	        </div>
		      <div id=\"zapati\">
	          <p id=\"gen_cas_uvodni_index\">
              {$this->KonecCas()}
            </p>
            <p id=\"pocitadlo\">
               Celkem navštíveno: {$pocitadlo}x
            </p>
            <div id=\"ovladani_stylu\">
            $styl
            <p>
              <a href=\"styles/global_styles.php?akce=all\" title=\"Administrace stylů\">Administrace stylů</a>
              (<a href=\"styles/global_styles.php?akce=all\" onclick=\"return !OpenMyWin(this,'_okno');\" title=\"v novém okně\">v novém okně</a>)
            </p>
            </div>
	        </div>
		    </body>
		  </html>";
		}
			else
		{
			$result =
			"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
					\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
			  <head>
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <meta http-equiv=\"Content-Language\" content=\"cs\" />
			    <meta name=\"author\" content=\"Geniv &amp; Fugess\" />
			    <meta name=\"copyright\" content=\"Geniv (c) 2008, Fugess (c) 2008\" />
			    <meta name=\"keywords\" content=\"katalog GFdesign, katalogový systém GFdesign, katalog by GFdesign, katalogový systém by GFdesign, Katalogový systém, Katalog, Katalog Fugess, Katalog Geniv, Katalogový systém Fugess, Katalogový systém Geniv, Katalog CD a DVD, Katalog filmů, Katalog médií, Katalog pro média, Katalog by Fugess, Katalog by Geniv, Katalog Fugess Geniv\" />
			    <meta name=\"description\" content=\"Katalogový systém\" />
			    <meta name=\"robots\" content=\"index, follow\" />
            <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.php\" media=\"screen\" />
            <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/log_index.css\" media=\"screen\" />
          <!--[if IE]>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
          <![endif]-->
          <!--[if IE 7]>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
          <![endif]-->
          <!--[if lte IE 6]>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
          <![endif]-->
            <link rel=\"shortcut icon\" href=\"obr/favicon_katalog_vstup.ico\" />
          <title>Katalog filmů | mluveného slova a ostatních médií | pro CD a DVD</title>
          <script type=\"text/javascript\">
            var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
            document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
          </script>
          <script type=\"text/javascript\">
            var pageTracker = _gat._getTracker(\"UA-4450047-2\");
            pageTracker._initData();
            pageTracker._trackPageview();
          </script>
			  </head>
			    <body>
			      <div id=\"zahlavi\"></div>
			      <div id=\"obsah\">
			        <h1>
                Katalog
              </h1>
			        <h2>
                filmů, mluveného slova a ostatních médií
              </h2>
			        <h3>
                pro CD a DVD
              </h3>
			        <h4>
                Do katalogu mají přístup jen autoři
              </h4>
			        <div id=\"obal_formy\">
	    					<form id=\"prihlasovaci_form\" action=\"index.php\" method=\"post\">
	    						<fieldset>
	    						  <legend>Přihlašovací formulář</legend>
	    						  <label for=\"login\" id=\"login_label\">Login:</label>
	    							<input id=\"login\" type=\"text\" name=\"jmeno\" />
	    							<label for=\"heslo\">Heslo:</label>
	    							<input id=\"heslo\" type=\"password\" name=\"heslo\" />
	    							<input id=\"prihlasit\" type=\"submit\" name=\"tlacitko\" value=\"Přihlásit\" />
	    						</fieldset>
	    					</form>
	  					</div>
             $prih
             <div id=\"ikony_uvod_obsah\">
              <span class=\"php\" title=\"PHP\"></span>
              <span class=\"mysql\" title=\"MySQL\"></span>
              <span class=\"sqlite\" title=\"SQLite\"></span>
              <span class=\"apache\" title=\"Apache\"></span>
             </div>
					  </div>
	          <div id=\"zapati\">
	            <p id=\"gen_cas_uvodni_index\">
                {$this->KonecCas()}
              </p>
              <p id=\"texty_valid\">
                Valid <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict\" rel=\"nofollow\">XHTML</a> | <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS 2.1\" rel=\"nofollow\">CSS</a> | <a href=\"http://validator.w3.org/feed/check.cgi?url=http%3A//katalog.gfdesign.cz/rss\" title=\"Valid RSS 2.0\" rel=\"nofollow\">RSS</a> &amp; recommended web browser FF | IE7 | Opera | Safari
              </p>
              <p id=\"autori\">
                Design &amp; Coding by Fugess (2008), Programming by Geniv (2008) © GF Design
              </p>
	          </div>
	        </body>
	      </html>";
		}

		print $result;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function NastaveniStrankovani()
	{
		if ($res = @$this->stranlite->query("SELECT * FROM strankovani WHERE kde='$this->Tkam'", $error))
		{
			$data = $res->fetchObject();

			$this->globstran = $data->pocet;

			$vystup =
			"
	    <form class=\"vychozi_form\" action=\"\" method=\"post\">
	      <fieldset>
	        <legend>Nastavení počtu položek na stránku</legend>
	          <label class=\"vychozi_label\">
	            <span>Počet položek na stránku:</span>
	            <input class=\"vychozi_text_input\" type=\"text\" name=\"setstran\" value=\"$data->pocet\" maxlength=\"10\" />
	          </label>
	        <input class=\"vychozi_tlacitko\" type=\"submit\" value=\"Nastavit\" name=\"tlacitkosql\" />
	      </fieldset>
	    </form>
	    ";

			if (!Empty($_POST["tlacitkosql"]) &&
					!Empty($_POST["setstran"]) &&
					settype($_POST["setstran"], "integer") &&
					$_POST["setstran"] != 0)
			{
				if (@$this->stranlite->queryExec("UPDATE strankovani SET pocet={$_POST["setstran"]} WHERE kde='$this->Tkam'", $error))
				{
					$vystup .= "
		      <div class=\"pozice_nastaveni_polozek\">
		        <div class=\"pozadi_top_razeni_katal\"></div>
		    			<div class=\"pozadi_obal_razeni_katal\">
		      			<p>
		              Počet položek na stránku byl nastaven na hodnotu: <strong>{$_POST["setstran"]}</strong>
		            </p>
		            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
		              Pokračuj klapnutím <a href=\"?action=$this->Tkam\" title=\"Pokračuj klapnutím zde\">zde</a>
		            </p>
		    			</div>
		  			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
					</div>
		      ";
	      }
	      	else
	      {
					$this->chyba = $this->ErrorMsg($error);
				}
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}

    return $vystup;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function Strankovani($pocet, $constdodatek = "")
	{
		$razeni = $this->RozdelCestu($_GET["action"], 1);	//výraz
		$smer = $this->RozdelCestu($_GET["action"], 2);	//směr
		$strana = $this->RozdelCestu($_GET["action"], 3);	//stránka
		if ($this->globstran > 0)
    {
      $pocstr = ceil($pocet / $this->globstran);
    }

		if (Empty($strana) || $strana > $pocstr || !(settype($strana, "integer") && $strana != 0))
		{
			$strana = 1;
		}

		$num_zpet = $strana - 1;
		$num_dal = $strana + 1;

		$this->stran_od = ($strana * $this->globstran) - $this->globstran;	//výpočet stránkování
		$this->stran_poc = $this->globstran;

		if ($strana > 1)
		{
			$adresa = "<span>(</span><a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}{$num_zpet}{$constdodatek}\" title=\"Předchozí\">Předchozí</a><span>)</span> ";
		}
			else
		{
			$adresa = "";
		}

		if ($pocstr >= 7)
		{
			if ($strana <= 3)	//začátek
			{
				for ($i = 1; $i < 4; $i++)
				{
          if ($i != 3)
					{
						$carka = ", ";
					}
						else
					{
						$carka = " ";
					}

          if ($i != $strana)
					{
						$adresa .= "<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}{$i}{$constdodatek}\" title=\"$i\">$i</a>$carka";
					}
						else
					{
						$adresa .= "{$i}{$carka}";
					}
				}

				$adresa .=
				"... <a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}{$pocstr}{$constdodatek}\" title=\"$pocstr\">$pocstr</a>";
			}

			if ($strana > 3 && $strana <= ($pocstr - 2))	//střed
			{
				$adresa .=
				"<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}1{$constdodatek}\" title=\"1\">1</a>
				...
				<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}".($strana - 1)."{$constdodatek}\" title=\"".($strana - 1)."\">".($strana - 1)."</a>,
				$strana,
				<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}".($strana + 1)."{$constdodatek}\" title=\"".($strana + 1)."\">".($strana + 1)."</a>
				...
				<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}{$pocstr}{$constdodatek}\" title=\"$pocstr\">$pocstr</a>";
			}

			if ($strana > ($pocstr - 2))	//konec
			{
				$adresa .=
				"<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}1{$constdodatek}\" title=\"1\">1</a>,
				...";
				$inv = 2;
				for ($i = 1; $i < 4; $i++)
				{
					if (($pocstr - $inv) != $pocstr)
					{
						$carka = ", ";
					}
						else
					{
						$carka = "";
					}

					if ($strana != ($pocstr - $inv))
					{
						$adresa .= "<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}".($pocstr - $inv)."{$constdodatek}\" title=\"".($pocstr - $inv)."\">".($pocstr - $inv)."</a>$carka";
					}
						else
					{
						$adresa .= ($pocstr - $inv)."$carka";
					}
					$inv--;
				}
			}
		}
			else
		{
			for ($i = 1; $i <= $pocstr; $i++)
			{
				if ($i != $pocstr)	//doplnění čárky
				{
					$carka = ", ";
				}
					else
				{
					$carka = "";
				}

				if ($strana == $i)	//doplnění čísel
				{
					$adresa .= "{$i}{$carka}";
				}
					else
				{
					$adresa .= "<a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}{$i}{$constdodatek}\" title=\"$i\">$i</a>$carka";
				}
			} //end for
		}

		if ($strana < $pocstr)
		{
			$adresa .= " <span>(</span><a href=\"?action={$this->Tkam}{$this->oddel}{$razeni}{$this->oddel}{$smer}{$this->oddel}{$num_dal}{$constdodatek}\" title=\"Další\">Další</a><span>)</span>";
		}
			else
		{
			$adresa .= "";
		}

		if ($adresa != "1")
		{
      $jdi = "
      <p>
        Jdi na stranu: $adresa
      </p>
      ";
    }
  		else
		{
      $jdi = "";
    }

		$result = "
    <div id=\"strankovani\">
      $jdi
      <p id=\"vpravo\">
        Strana: $strana z $pocstr
      </p>
    </div>
    <div id=\"vypis_celkem_polozek\">
      <p>
        <a href=\"?action=statistic\" title=\"Statistiky katalogu\">Statistiky katalogu</a>
      </p>
    </div>
    <div id=\"logovani\">
      <p>
        <a href=\"?action=adminpoc\" title=\"Logování katalogu\">Logování katalogu</a>
      </p>
    </div>
    ";

    return $result;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function KontrolaLogin($jmeno, $heslo)
	{
		$login = array ("c8620e2ff5a9cb13bf66ab249822e9a9",
										"e7b5b08060a7d949d953607dc515679e",
										"e0694d5cfee470a0a40835bffc3d3d1f",
										"8f326241255e5d89c6684a6f684e4be6"); //zápis loginů
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
//******************************************************************************
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
	function Statistiky()
	{
		if ($res = @$this->mysqli->query("SELECT COUNT(*) as pocet FROM kategorie")) //dotaz
		{
			$poc_kategorie = $res->fetch_object()->pocet; //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT COUNT(*) as pocet FROM medium")) //dotaz
		{
			$poc_medium = $res->fetch_object()->pocet; //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT typ, count(typ) as pocet FROM dvd, medium WHERE dvd.idmedium=medium.idmedium GROUP BY typ")) //dotaz
		{
			while ($data = $res->fetch_object()) //načítání řádků
			{
				$media .= "
            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              <strong>$data->typ</strong> - <strong>{$data->pocet}x</strong>
	          </p>
         ";
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT kategorie.nazev as nazev ,count(kategorie.nazev) as pocet FROM dvd, kategorie WHERE dvd.idkategorie=kategorie.idkategorie GROUP BY kategorie.nazev")) //dotaz
		{
			while ($data = $res->fetch_object()) //načítání řádků
			{
				$kategorie .= "
            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              <strong>$data->nazev</strong> - <strong>{$data->pocet}x</strong>
	          </p>
         ";
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT SUM(pocet) as pocet FROM dvd")) //dotaz
		{
			$sum_dvd = $res->fetch_object()->pocet; //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT MIN(pocet) as pocet FROM dvd")) //dotaz
		{
			$min_dvd = $res->fetch_object()->pocet; //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT MAX(pocet) as pocet FROM dvd")) //dotaz
		{
			$max_dvd = $res->fetch_object()->pocet; //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT AVG(pocet) as pocet FROM dvd")) //dotaz
		{
			$avg_dvd = $res->fetch_object()->pocet; //načítání řádků
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT pocet, COUNT(pocet) as poc FROM dvd GROUP BY pocet")) //dotaz
		{
			while ($data = $res->fetch_object()) //načítání řádků
			{
				$allpocet .=
        "
            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              <strong>{$data->poc}x</strong> - <strong>$data->pocet</strong>
	          </p>
        ";
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		if ($res = @$this->mysqli->query("SELECT DATE_FORMAT(datum, '%d.%m.%Y') as datum, count(nazev) as pocet FROM dvd GROUP BY DATE_FORMAT(datum, '%d.%m.%Y')")) //dotaz
		{
			while ($data = $res->fetch_object()) //načítání řádků
			{
				$dvd_datum .=
        "
            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              <strong>$data->datum</strong> - <strong>{$data->pocet}x</strong>
	          </p>
        ";
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
		}

		$result =
		"
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Statistiky katalogu
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              <strong>Celkem položek</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Počet položek v katalogu celkem: <strong>{$this->PocetDVD()}</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Počet žánrů celkem: <strong>$poc_kategorie</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Počet médií celkem: <strong>$poc_medium</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              <strong>Počet použití položek</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Který druh média má kolik položek:
	          </p>
	          $media
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Který druh žánru má kolik položek:
	          </p>
	          $kategorie
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        <div class=\"pozadi_top_razeni_katal \"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              <strong>Součty disků</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Celkový počet disků ve všech položkách: <strong>$sum_dvd</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Minimální počet disků ve všech položkách: <strong>$min_dvd</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Maximální počet disků ve všech položkách: <strong>$max_dvd</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Průměrný počet disků ve všech položkách: <strong>$avg_dvd</strong>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              Kolik položek má počet disků:
	          </p>
	          $allpocet
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal\"></div>
        <div class=\"pozadi_top_razeni_katal\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
              V jakém datu bylo přidáno kolik položek:
	          </p>
	          $dvd_datum
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
    ";

		return $result;
	}
//******************************************************************************
	function Pocitadlo()
	{
    $datum = date("Y-m-d");
    $cas = date("H:i:s");
    $hodina = date("H");
    $uphodina = date("H", mktime(date("H") + 1, 0, 0, 0, 0, 0));

    if (filesize($this->katpocnazev) == 0)
    {
      if (!@$this->katpoc->queryExec("CREATE TABLE pocitadlo (
                                      id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                      ip VARCHAR(40),
                                      hodina INTEGER,
                                      cas TIME,
                                      datum DATE,
                                      pocet INTEGER);", $error))
      {
        $this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
      }
    }

    if ($res = @$this->katpoc->query("SELECT COUNT(ip) as pocet FROM pocitadlo WHERE ip='{$_SERVER["REMOTE_ADDR"]}';", NULL, $error))
    {
      $data = $res->fetchObject();
      if ($data->pocet == 0)  //ověří existenci IP
      { //když neexistuje vytvoří s 1
        if (!@$this->katpoc->queryExec("INSERT INTO pocitadlo VALUES (NULL, '{$_SERVER["REMOTE_ADDR"]}', $uphodina, '$cas', '$datum', 1);", $error))
        {
          $this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
        }
      }
        else
      { //existuje-li a 'hodina'!='hodině aktuální' tak si načte a updatuje
        if ($res = @$this->katpoc->query("SELECT pocet, hodina FROM pocitadlo WHERE ip='{$_SERVER["REMOTE_ADDR"]}'", NULL, $error))
        {
          $data = $res->fetchObject();
          $poc = $data->pocet;  //php porovnání dat
          if (date("H", mktime($data->hodina - 1, 0, 0, 0, 0, 0)) != $hodina)  //když se ->hodina <= $hodina tak updejtuj 23<22
          {
            $poc++;
            if (!@$this->katpoc->queryExec("UPDATE pocitadlo SET pocet=$poc WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                            UPDATE pocitadlo SET cas='$cas' WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                            UPDATE pocitadlo SET datum='$datum' WHERE ip='{$_SERVER["REMOTE_ADDR"]}';
                                            UPDATE pocitadlo SET hodina=$uphodina WHERE ip='{$_SERVER["REMOTE_ADDR"]}';", $error))
            {
              $this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
            }
          }
        }
          else
        {
          $this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
        }
      }
    }
      else
    {
      $this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
    }

    if ($res = @$this->katpoc->query("SELECT SUM(pocet) as pocet FROM pocitadlo", NULL, $error))
    {
      $result = $res->fetchObject()->pocet;
    }
      else
    {
      $this->chyba = $this->ErrorMsg($error);	//chyba do globální proměnné
    }

		return $result;
	}
//******************************************************************************
  function VypisPocitadla()
  {
    if ($res = @$this->katpoc->query("SELECT * FROM pocitadlo", NULL, $error))
    {
      while ($data = $res->fetchObject())
      {
        $host = gethostbyaddr($data->ip);
        $result .= "
					<div class=\"pozadi_obal_polozka_katal\">
					  <div class=\"pozadi_top_polozka_katal\"></div>
	    				<div class=\"pozadi_center_polozka_katal\">
	      				<p class=\"id_hodnota vsechny_hodnota\" title=\"$data->id\">$data->id</p>
	      				<p class=\"ip_hodnota vsechny_hodnota\">$data->ip</p>
	      				<p class=\"hostitel_hodnota vsechny_hodnota\" title=\"$host\">$host</p>
	      				<p class=\"do_kdy_hodnota vsechny_hodnota\">$data->hodina</p>
	      				<p class=\"prichod_cas_hodnota vsechny_hodnota\">$data->cas</p>
	      				<p class=\"prichod_datum_hodnota vsechny_hodnota\">$data->datum</p>
	      				<p class=\"kolikrat_hodnota vsechny_hodnota\" title=\"{$data->pocet}x\">{$data->pocet}x</p>
	            </div>
	          <div class=\"pozadi_bottom_polozka_katal\"></div>
	        </div>
        ";
      }
    }
      else
    {
      $this->chyba = $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function LogovaniPrihlasovani()
  {
    $datum = date("j", mktime(0, 0, 0, 0, date("j") + 7, 0));
    $realdatum = date("Y-m-d H:i:s");

    if (filesize($this->nazevkatlog) == 0)
    {
      if (!@$this->katlog->queryExec("CREATE TABLE logovani (
                                      id INTEGER AUTO_INCREMENT PRIMARY KEY,
                                      jmeno VARCHAR(100),
                                      heslo VARCHAR(100),
                                      ip VARCHAR(40),
                                      pristup BOOL,
                                      datum DATETIME,
                                      expirace INTEGER);", $error))
      {
        $this->chyba = $this->ErrorMsg($error);
      }
    }

    if (!Empty($_POST["jmeno"]) && !Empty($_POST["heslo"]))
    {
      $pristup = $this->KontrolaLogin(md5($_POST["jmeno"]), md5($_POST["heslo"]));

      switch ($pristup)
      {
        case true:
          $pristup = "povoleno";
          $jmeno = $_POST["jmeno"];
          $heslo = "--- --- ---";
        break;

        case false:
          $pristup = "zakázáno";
          $jmeno = $_POST["jmeno"];
          $heslo = $_POST["heslo"];
        break;
      }

      if (!@$this->katlog->queryExec("INSERT INTO logovani VALUES (NULL, '$jmeno', '$heslo', '{$_SERVER["REMOTE_ADDR"]}', '$pristup', '$realdatum', $datum);", $error))
      {
        $this->chyba = $this->ErrorMsg($error);
      }
    }
  }
//******************************************************************************
  function VypisLoguPrihlasovani()
  {
    $datum = date("j");

    if ($res = @$this->katlog->query("SELECT * FROM logovani ORDER BY id DESC", NULL, $error))
    {
      while ($data = $res->fetchObject())
      {
        $result .= "
					<div class=\"pozadi_obal_polozka_katal\">
					  <div class=\"pozadi_top_polozka_katal\"></div>
	    				<div class=\"pozadi_center_polozka_katal\">
	      				<p class=\"id_hodnota vsechny_hodnota\" title=\"$data->id\">$data->id</p>
	      				<p class=\"login_hodnota vsechny_hodnota\" title=\"$data->jmeno\">$data->jmeno</p>
	      				<p class=\"heslo_hodnota vsechny_hodnota\" title=\"$data->heslo\">$data->heslo</p>
	      				<p class=\"ip_logovani_hodnota vsechny_hodnota\" title=\"$data->ip\">$data->ip</p>
	      				<p class=\"povoleni_hodnota vsechny_hodnota\">$data->pristup</p>
	      				<p class=\"datum_logovani_hodnota vsechny_hodnota\">$data->datum</p>
	      				<p class=\"datum_expirace vsechny_hodnota\">$data->expirace</p>
	            </div>
	          <div class=\"pozadi_bottom_polozka_katal\"></div>
	        </div>
        ";
      }
    }
      else
    {
      $this->chyba = $this->ErrorMsg($error);
    }

    if (!@$this->katlog->queryExec("DELETE FROM logovani WHERE $datum>=expirace", $error))
    {
      $this->chyba = $this->ErrorMsg($error);
    }

    return $result;
  }
//******************************************************************************
  function ZalohovaciSystem() //zálohovaí systém!!
  {
    $zip = new ZipArchive;
		if ($res = $zip->open("katalog.zip", ZipArchive::CREATE))
		{
    		if ($res = @$this->mysqli->query("SELECT * FROM dvd")) //zaloha DVD
    		{
    			while ($data = $res->fetch_object()) //načítání řádků
    			{
    				$katalog .=
"INSERT INTO dvd VALUES ($data->iddvd, $data->idkategorie, $data->idmedium, $data->detachid, '$data->nazev', '$data->komentar', $data->pocet, '$data->datum');
";
    			}
    		}
    			else
    		{
    			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
    		}

    		if ($res = @$this->mysqli->query("SELECT * FROM kategorie")) //zaloha Kategorie
    		{
    			while ($data = $res->fetch_object()) //načítání řádků
    			{
    				$katalog .=
"INSERT INTO kategorie VALUES ($data->idkategorie, '$data->nazev');
";
    			}
    		}
    			else
    		{
    			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
    		}

    		if ($res = @$this->mysqli->query("SELECT * FROM medium")) //zaloha Medium
    		{
    			while ($data = $res->fetch_object()) //načítání řádků
    			{
    				$katalog .=
"INSERT INTO medium VALUES ($data->idmedium, '$data->typ');
";
    			}
    		}
    			else
    		{
    			$this->chyba = $this->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
    		}

      $zip->addFromString('katalog.sql', $katalog);
			$zip->close();
		}

		$result =
		"
        <div class=\"pozadi_top_razeni_katal zaporne_odsazeni_zhora\"></div>
	  			<div class=\"pozadi_obal_razeni_katal\">
	    			<p>
  	    			<a href=\"katalog.zip\" title=\"Stáhnout zálohu\"><strong>Stáhnout zálohu</strong></a>
	          </p>
	          <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              Pokračuj klapnutím <em><a href=\"?action=adminpoc\" title=\"Pokračuj klapnutím zde\">zde</a></em>
	          </p>
	  			</div>
				<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
    ";

		return $result;
  }
//******************************************************************************
}
//******************************************************************************
//******************************************************************************
//******************************************************************************
?>
