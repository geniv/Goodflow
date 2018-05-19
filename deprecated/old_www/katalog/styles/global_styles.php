<?php
class CSS
{
	var $db;
	var $oddel = "-"; //zadaný oddělovač adresy
	var $nazev = "glotyl.lg";
	var $prih;
	var $out;
	var $chyba;	//globální chybová hláška
	var $meta;	//globální meta autoclick
//******************************************************************************
	function ErrorMsg($chyba)	//vypis chyby
	{
		$result =
		        "
    		    <div class=\"pozice_nastaveni_polozek\">
    	        <div class=\"obal_polozky_top\"></div>
    	    			<div class=\"obal_polozky_center uprava_pro_chybu\">
    	      			<p>
    	              Vyskytla se chyba:
    	            </p>
    	            <p class=\"chyba\">
                    <cite>$chyba</cite>
    	            </p>
    	            <span class=\"chyba_obrazek_vlevo\"></span>
    	            <span class=\"chyba_obrazek_vpravo\"></span>
    	    			</div>
    	  			<div class=\"obal_polozky_bottom\"></div>
    				</div>
            ";
		return $result;
	}
//******************************************************************************
	function EmptyTable()
	{
		$result =
		        "
    	        <div class=\"obal_polozky_top\"></div>
    	    			<div class=\"obal_polozky_center vetsi_padding\">
    	      			<p>
    	              V katalogu nejsou žádné styly.
    	            </p>
    	            <span class=\"prazdne_styly_maly_levy\"></span>
    	            <span class=\"prazdne_styly_maly_pravy\"></span>
    	    			</div>
    	  			<div class=\"obal_polozky_bottom\"></div>
            ";
		return $result;
	}
//******************************************************************************
	function CSS()	//konstruktor
	{
		$soubor = $this->AktualniZpracovani();
		if ($this->AktualniZpracovani() == "global_styles.php" && Empty($_GET["akce"]))
		{
			header('Content-type: text/css; charset=UTF-8');	//poslání hlavičky
		}
		
		if ($soubor == "index.php" || ($soubor == "global_styles.php" && !Empty($_GET["akce"])))
		{
			header('Content-type: text/html; charset=UTF-8');
		}
		
		$this->Instalace();
    $this->Menu();
	}
//******************************************************************************
	function AutoClick($cas, $cesta)	//auto kliknutí
	{
		$this->meta = "<meta http-equiv=\"refresh\" content=\"$cas;URL=$cesta\" />";
	}
//******************************************************************************
	function AktualniZpracovani()
	{
		$odd = "/"; //zadaný oddělovač adresy
		$a = explode($odd, $_SERVER["SCRIPT_NAME"]); //rosekání adresy a vrácení žádaného výsledku
		return $a[count($a) - 1];
	} 
//******************************************************************************
	function RozdelCestu($cesta, $poradi)	//dozdělí cestu adresy
	{
		$a = explode($this->oddel, $cesta); //rosekání adresy a vrácení žádaného výsledku
		return $a[$poradi];
	}
//******************************************************************************
	function Instalace()	//instalace SQLite
	{
		if ($this->AktualniZpracovani() == "index.php")
		{
			$nazev = "./styles/$this->nazev";
		}
			else
		{
			$nazev = "./$this->nazev";
		}
		
		$this->db = new SQLiteDatabase($nazev);

		if (filesize($nazev) == 0)
		{
			header('Content-type: text/html; charset=UTF-8');
			if (@$this->db->queryExec("CREATE TABLE styl (id INTEGER AUTO_INCREMENT PRIMARY KEY, nazev VARCHAR(30));
																CREATE TABLE import (id INTEGER AUTO_INCREMENT PRIMARY KEY, cislo INTEGER, cesta VARCHAR(100));
																CREATE TABLE nastaveni (id INTEGER AUTO_INCREMENT PRIMARY KEY, jmeno VARCHAR(30), styl INTEGER);
																INSERT INTO nastaveni(jmeno, styl) VALUES ('styl', 1)", $error))
			{
				return "nainstalováno! {$this->AutoClick(1, "./styles/global_styles.php?akce=all")}";
			}
				else
			{
				$this->chyba = $this->ErrorMsg($error);
			}
		}
	}
//******************************************************************************
	function VypisCSS()	//hlavní výpis stylu dle zadání
	{
    if (($this->AktualniZpracovani() == "global_styles.php" && Empty($_GET["akce"])) ||
        (!Empty($_COOKIE["GCSSJMENO"]) && !Empty($_COOKIE["GCSSHESLO"]) && $this->KontrolaLoginu($_COOKIE["GCSSJMENO"], $_COOKIE["GCSSHESLO"])))
		{
			if ($rs = @$this->db->query("SELECT styl FROM nastaveni WHERE jmeno='styl'", NULL, $error))
			{
				$cislo = $rs->fetchObject()->styl;
			}
				else
			{
				$this->chyba = $this->ErrorMsg($error);
			}

			if ($res = @$this->db->query("SELECT import.cesta as cesta FROM styl, import WHERE styl.id=import.cislo AND styl.id=$cislo ORDER BY import.id", NULL, $error))
			{
				$poc = $res->numRows();
				if ($poc > 0)
				{
				  if (!Empty($_GET["akce"]))
					{
  					$zalomeni = "<br />\n";
          }
            else
          {
            $zalomeni = "\n";
          }
					$vypis = "/* importovani resetu a centralniho stylu */{$zalomeni}{$zalomeni}";
		
					for ($i = 0; $i < $poc; $i++)
					{
						$data = $res->fetchObject();
						$vypis .= "@import url(\"".htmlspecialchars_decode($data->cesta, ENT_NOQUOTES)."\");$zalomeni";
					}
					$vypis .= 
					"$zalomeni/* Fugess (Martin) */$zalomeni/* Programming by Geniv */";
				}
					else
				{
					$vypis = "@import url(\"empty_styles.css\");";
				}
			}
				else
			{
				$this->chyba = $this->ErrorMsg($error);
			}
      return $vypis;
		}
	}
//******************************************************************************
	function VypisImportyAdd()	//vypíše editační tabulku
	{
		if ($res = @$this->db->query("SELECT import.id as id, styl.nazev as nazev, import.cesta as cesta FROM styl, import WHERE styl.id=import.cislo ORDER BY import.cislo,import.id", NULL, $error))
		{
			$poc = $res->numRows();
			if ($poc > 0)
			{
				$vypis = 
				"
				    <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  <strong>###</strong>
                </p>
                <p class=\"nazev_stylu\">
                  <strong>Název stylu</strong>
                </p>
                <p class=\"nazev_importu\">
                  <strong>Import s cestou k CSS</strong>
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
	
				for ($i = 0; $i < $poc; $i++)
				{
					$data = $res->fetchObject();
					$vypis .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  $data->id
                </p>
                <p class=\"nazev_stylu\">
                  $data->nazev
                </p>
                <p class=\"nazev_importu\">
                  $data->cesta
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
				}
				$vypis .= "";
			}
				else
			{
				$vypis = $this->EmptyTable();
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vypis;
	}
//******************************************************************************
	function VypisImportyEdit()	//vypíše editační tabulku
	{
		if ($res = @$this->db->query("SELECT import.id as id, styl.nazev as nazev, import.cesta as cesta FROM styl, import WHERE styl.id=import.cislo ORDER BY import.cislo,import.id", NULL, $error))
		{
			$poc = $res->numRows();
			if ($poc > 0)
			{
				$vypis = 
            "
            <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  <strong>###</strong>
                </p>
                <p class=\"nazev_stylu\">
                  <strong>Název stylu</strong>
                </p>
                <p class=\"nazev_importu\">
                  <strong>Import s cestou k CSS</strong>
                </p>
                <p class=\"upravit_smazat_import vetsi_odsazeni_nadpis\">
                  <strong>Upravit import</strong>
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
	
				for ($i = 0; $i < $poc; $i++)
				{
					$data = $res->fetchObject();
					$vypis .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  $data->id
                </p>
                <p class=\"nazev_stylu\">
                  $data->nazev
                </p>
                <p class=\"nazev_importu\">
                  $data->cesta
                </p>
                <p class=\"upravit_smazat_import\">
                  <a href=\"?akce=edit_imp{$this->oddel}{$data->id}\" title=\"Upravit import\">Upravit import</a>
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
				}
				$vypis .= "";
			}
				else
			{
				$vypis = $this->EmptyTable();
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vypis;
	}
//******************************************************************************
	function VypisImportyDel()	//vypíše mazací tabulku
	{
		if ($res = @$this->db->query("SELECT import.id as id, styl.nazev as nazev, import.cesta as cesta FROM styl, import WHERE styl.id=import.cislo ORDER BY import.cislo,import.id", NULL, $error))
		{
			$poc = $res->numRows();
			if ($poc > 0)
			{
				$vypis =
            "
            <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  <strong>###</strong>
                </p>
                <p class=\"nazev_stylu\">
                  <strong>Název stylu</strong>
                </p>
                <p class=\"nazev_importu\">
                  <strong>Import s cestou k CSS</strong>
                </p>
                <p class=\"upravit_smazat_import vetsi_odsazeni_nadpis\">
                  <strong>Smazat import</strong>
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
	
				for ($i = 0; $i < $poc; $i++)
				{
					$data = $res->fetchObject();
					$vypis .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  $data->id
                </p>
                <p class=\"nazev_stylu\">
                  $data->nazev
                </p>
                <p class=\"nazev_importu\">
                  $data->cesta
                </p>
                <p class=\"upravit_smazat_import\">
                  <a href=\"?akce=del_imp{$this->oddel}{$data->id}\" title=\"Smazat import\">Smazat import</a>
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
				}
				$vypis .= "";
			}
				else
			{
				$vypis = $this->EmptyTable();
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vypis;
	}
//******************************************************************************
	function PocetStylu()	//vrátí počet stylů 
	{
		if ($res = @$this->db->query("SELECT COUNT(*) as pocet FROM styl", NULL, $error))
		{
			return $res->fetchObject()->pocet;
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function PridejStyl($nazev)	//dotaz na přidání stylu
	{
		$nazev = stripslashes(htmlspecialchars($nazev, ENT_QUOTES));
		if (@$this->db->queryExec("INSERT INTO styl(nazev) VALUES ('$nazev')", $error))
		{
			return
              "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl přidán styl s názvem: <strong>$nazev</strong>
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=add_styl\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"pridani_stylu_maly_levy\"></span>
                  <span class=\"pridani_stylu_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom odsazeni_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function UpravStyl($id, $nazev)	//dotaz na upravení stylu
	{
		$nazev = stripslashes(htmlspecialchars($nazev, ENT_QUOTES));
		if (@$this->db->queryExec("UPDATE styl SET nazev='$nazev' WHERE id=$id", $error))
		{
			return "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl upraven styl s názvem: <strong>$nazev</strong>
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=edit_styl\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"upraveni_stylu_maly_levy\"></span>
                  <span class=\"upraveni_stylu_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom odsazeni_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function SmazStyl($id, $nazev)	//dotaz na smazání stylu
	{
		if (@$this->db->queryExec("DELETE FROM styl WHERE id=$id;
                              DELETE FROM import WHERE cislo=$id", $error))
		{
			return "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl smazán styl s názvem a (ID):
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $nazev ($id)
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=del_styl\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"smazani_css_maly_levy smazani_css_maly_levy_vetsi_top\"></span>
                  <span class=\"smazani_css_maly_pravy smazani_css_maly_pravy_vetsi_top\"></span>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function PridejImport($cislo, $cesta)	//dotaz na přidání importu
	{
		$cesta = stripslashes(htmlspecialchars($cesta, ENT_QUOTES));

		if (@$this->db->queryExec("INSERT INTO import(cislo, cesta) VALUES ($cislo, '$cesta')", $error))
		{
			return
              "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Do stylu s názvem a (ID):
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    {$this->VypisStyluText($cislo)} ($cislo)
  	              </p>
  	              <p class=\"mirne_odsazeni\">
                    byl přidán import s cestou k CSS souboru:
  	              </p>
  	              <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $cesta
  	              </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=add_imp\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"pridani_importu_maly_levy\"></span>
                  <span class=\"pridani_importu_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom odsazeni_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function UpravImport($id, $cislo, $cesta)	//dotaz na uptavu importu
	{
		$cesta = stripslashes(htmlspecialchars($cesta, ENT_QUOTES));

		if (@$this->db->queryExec("UPDATE import SET cislo=$cislo WHERE id=$id;
															UPDATE import SET cesta='$cesta' WHERE id=$id", $error))
		{
			return "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl upraven import s cestou k CSS souboru:
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $cesta
  	              </p>
  	              <p class=\"mirne_odsazeni\">
                    ve stylu s názvem a (ID):
  	              </p>
  	              <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    {$this->VypisStyluText($cislo)} ($id)
  	              </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=edit_imp\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"upraveni_importu_maly_levy\"></span>
                  <span class=\"upraveni_importu_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom odsazeni_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function SmazImport($id, $nazev, $cislo)	//dotaz na smáni importu
	{
		if (@$this->db->queryExec("DELETE FROM import WHERE id=$id", $error))
		{
			return "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl smazán import s cestou k CSS souboru:
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $nazev
                  </p>
                  <p>
                    vázaným ke stylu s názvem a (ID):
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    {$this->VypisStyluText($cislo)} ($id)
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=del_imp\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"smazani_importu_maly_levy\"></span>
                  <span class=\"smazani_importu_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function Menu()	//výpis menu
	{
		if (!Empty($_POST["login"]) && !Empty($_POST["heslo"]))
		{
			if ($this->KontrolaLoginu(md5($_POST["login"]), md5($_POST["heslo"])))
			{
				SetCookie("GCSSJMENO", md5($_POST["login"]), Time() + 31536000); //zápis do cookie
     		SetCookie("GCSSHESLO", md5($_POST["heslo"]), Time() + 31536000);
     		$this->prih = "
     		<div id=\"prihlaseni_accept\">
	        <div>
	          <a href=\"global_styles.php?akce=all\" title=\"Byl jsi přihlášen.\">
	            <span id=\"prihlaseni_sipka_levy\"></span>
	            <span id=\"prihlaseni_accept_center\"></span>
	            <span id=\"prihlaseni_sipka_pravy\"></span>
	          </a>
	        </div>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Byl jsi přihlášen.\">Byl jsi přihlášen.</a>
	        </p>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Pro pokračování klapni na obrázek.\">Pro pokračování klapni na obrázek.</a>
	        </p>
	      </div>
        ";
			}
				else
			{
				$this->prih = "
				<div id=\"prihlaseni_rejected\">
	        <div>
	          <a href=\"global_styles.php?akce=all\" title=\"Zadal jsi neplatný login.\">
	            <span id=\"prihlaseni_sipka_levy\"></span>
	            <span id=\"prihlaseni_rejected_center\"></span>
	            <span id=\"prihlaseni_sipka_pravy\"></span>
	          </a>
	        </div>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Zadal jsi neplatný login.\">Zadal jsi neplatný login.</a>
	        </p>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Skus se znovu přihlásit.\">Skus se znovu přihlásit.</a>
	        </p>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Pro pokračování klapni na obrázek.\">Pro pokračování klapni na obrázek.</a>
	        </p>
	      </div>
        ";
			}
		}

		if (!Empty($_GET["akce"]) && $_GET["akce"] == "logout")
		{
			SetCookie("GCSSJMENO", "", 0);	//vymazání cookie
     	SetCookie("GCSSHESLO", "", 0);
     	$this->prih = "
     	  <div id=\"prihlaseni_accept\">
	        <div>
	          <a href=\"global_styles.php?akce=all\" title=\"Byl jsi odhlášen.\">
	            <span id=\"prihlaseni_sipka_levy\"></span>
	            <span id=\"prihlaseni_logoff_2_center\"></span>
	            <span id=\"prihlaseni_sipka_pravy\"></span>
	          </a>
	        </div>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Byl jsi odhlášen.\">Byl jsi odhlášen.</a>
	        </p>
	        <p>
	          <a href=\"global_styles.php?akce=all\" title=\"Pro pokračování klapni na obrázek.\">Pro pokračování klapni na obrázek.</a>
	        </p>
	      </div>
        ";
		}

      $menu = $this->Sekce();

		if (!Empty($_GET["akce"]) && 
				!Empty($_COOKIE["GCSSJMENO"]) && 
				!Empty($_COOKIE["GCSSHESLO"]) && 
				$this->KontrolaLoginu($_COOKIE["GCSSJMENO"], $_COOKIE["GCSSHESLO"]))
		{
			$result = 
			"
			<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
					\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
			  <head>
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <meta http-equiv=\"Content-Language\" content=\"cs\" />
			    <meta name=\"author\" content=\"Geniv &amp; Fugess\" />
			    <meta name=\"copyright\" content=\"Geniv (c) 2008, Fugess (c) 2008\" />
			    <meta name=\"description\" content=\"Katalogový systém\" />
			    <meta name=\"robots\" content=\"noindex, nofollow\" />
			    $this->meta
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"global_styles_admin.css\" media=\"screen\" />
          <!--[if IE]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles_IE_admin.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if IE 7]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles_IE7_admin.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if lte IE 6]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles_IE6_admin.css\" media=\"screen\" />
			    <![endif]-->
			      <link rel=\"shortcut icon\" href=\"../obr/favicon_administrace_css.ico\" />
			    <title>Katalog - Administrace stylů - {$this->Title()}</title>
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
			    <body id=\"admin_body\">
			      <div id=\"admin_zahlavi\"></div>
			      <div id=\"admin_obsah\">
  			      <div id=\"obal_prikazy\">
                <p>
                  <a href=\"?akce=all\" title=\"Zobrazit aktuální CSS\" id=\"vypis_katalogu\">Zobrazit aktuální CSS</a>
                </p>
                <p>
                  <a href=\"global_styles.php\" title=\"Zobrazit CSS soubor\" id=\"upravit_medium\">Zobrazit CSS soubor</a>
                </p>
                <p>
                  <a href=\"?akce=upload\" title=\"Upload CSS souborů\" id=\"hledat\">Upload CSS souborů</a>
                </p>
                <p>
                  <a href=\"?akce=listupload\" title=\"Výpis CSS složky\" id=\"pridat_pk\">Výpis CSS složky</a>
                </p>
                <p>
                  <a href=\"?akce=add_styl\" title=\"Přidat styl\" id=\"upravit_pk\">Přidat styl</a>
                </p>
                <p>
                  <a href=\"?akce=edit_styl\" title=\"Upravit styl\" id=\"smazat_pk\">Upravit styl</a>
                </p>
                <p>
                  <a href=\"?akce=del_styl\" title=\"Smazat styl\" id=\"pridat_zanr\">Smazat styl</a>
                </p>
                <p>
                  <a href=\"?akce=add_imp\" title=\"Přidat import\" id=\"upravit_zanr\">Přidat import</a>
                </p>
                <p>
                  <a href=\"?akce=edit_imp\" title=\"Upravit import\" id=\"smazat_zanr\">Upravit import</a>
                </p>
                <p>
                  <a href=\"?akce=del_imp\" title=\"Smazat import\" id=\"pridat_medium\">Smazat import</a>
                </p>
                <p>
                  <a href=\"../\" title=\"Vrátit se na stránky\" id=\"smazat_medium\">Vrátit se na stránky</a>
                </p>
                <p>
                  <a href=\"?akce=logout\" title=\"Odhlásit\" id=\"odhlasit\">Odhlásit</a>
                </p>
              </div>
			$this->prih
			$this->chyba
			$menu";
		}
			else
		{
			if (!Empty($_GET["akce"]))
			{
				$result = 
				"
				<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
					\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
			  <head>
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <meta http-equiv=\"Content-Language\" content=\"cs\" />
			    <meta name=\"author\" content=\"Geniv &amp; Fugess\" />
			    <meta name=\"copyright\" content=\"Geniv (c) 2008, Fugess (c) 2008\" />
			    <meta name=\"description\" content=\"Katalogový systém\" />
			    <meta name=\"robots\" content=\"noindex, nofollow\" />
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"global_styles_admin.css\" media=\"screen\" />
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"log_index_admin_styles.css\" media=\"screen\" />
          <!--[if IE]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles_IE_admin.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if IE 7]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles_IE7_admin.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if lte IE 6]>
			      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles_IE6_admin.css\" media=\"screen\" />
			    <![endif]-->
			      <link rel=\"shortcut icon\" href=\"../obr/favicon_administrace_css_vstup.ico\" />
			    <title>Katalog CD a DVD - Administrace stylů</title>
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
			    <body id=\"admin_body\">
			      <div id=\"admin_zahlavi\"></div>
			      <div id=\"admin_obsah_uvod\">
			        <h1>
                Katalog - Administrace stylů
              </h1>
			        <h2>
                Administrace pro ovládání stylů
              </h2>
			        <h3>
                Do administrace mají přístup jen autoři
              </h3>
			        <div id=\"admin_obal_formy\">
	    					<form id=\"admin_prihlasovaci_form\" action=\"\" method=\"post\">
	    						<fieldset>
	    						  <legend>Přihlašovací formulář</legend>
	    						  <label for=\"login\" id=\"login_label\">Login:</label>
	    							<input id=\"login\" type=\"text\" name=\"login\" />
	    							<label for=\"heslo\">Heslo:</label>
	    							<input id=\"heslo\" type=\"password\" name=\"heslo\" />
	    							<input id=\"prihlasit\" type=\"submit\" name=\"tlacitko\" value=\"Přihlásit\" />
	    						</fieldset>
	    					</form>
	  					</div>
	  					$this->prih
	  					<div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    <a href=\"../\" title=\"Vrátit se na stránky\">Vrátit se na stránky</a>
                  </p>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
	  					<div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    <a href=\"#\" onclick=\"window.close();\" title=\"Zavřít okno administrace\">Zavřít okno administrace</a>
                  </p>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
					  </div>
	          <div id=\"admin_zapati\">
  	          <p id=\"autori\">
                Design &amp; Coding by Fugess (2008), Programming by Geniv (2008)
              </p>
	          </div>
        ";
			}
		}
		print $result;
	}
//******************************************************************************
	function Sekce()	//výpis jednotlivých sekcí
	{
		if (!Empty($_GET["akce"]) &&	//ověřování při obrazení
				!Empty($_COOKIE["GCSSJMENO"]) && 
				!Empty($_COOKIE["GCSSHESLO"]) && 
				$this->KontrolaLoginu($_COOKIE["GCSSJMENO"], $_COOKIE["GCSSHESLO"]))
		{
			$kam = $this->RozdelCestu($_GET["akce"], 0);
		}
			else
		{
			$kam = "all";
		}

		switch($kam)
		{
			case "all":
    		if ($this->AktualniZpracovani() == "global_styles.php" && !Empty($_GET["akce"]))
    		{
      		$vyst = "
            <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Výpis aktuálního CSS
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            <div class=\"obal_polozky_top\"></div>
              <div class=\"obal_polozky_center vetsi_padding\">
                <p>";
          $vyst .= $this->VypisCSS();
          $vyst .= "
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>";
        }
          else
        {
          print $this->VypisCSS();
        }
			break;
			//************************************************************************
			case "add_styl":
				$vyst =
      				"
      				<form class=\"pridat_polozku_form\" action=\"\" method=\"post\">
                <fieldset>
                  <legend>Přidat styl</legend>
                  <label for=\"nazev_pridat\" class=\"pridat_nazev_label_trida\">Název stylu:</label>
                    <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"nazev\" />
    						  <input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Přidat styl\" name=\"tlacitko\" />
    						</fieldset>
              </form>
              ";

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["nazev"]))
				{
					$vyst .= $this->PridejStyl($_POST["nazev"]);
				}

				$vyst .= $this->VypisStyluAdd();
			break;
			//************************************************************************
			case "edit_styl":
				$id = $this->RozdelCestu($_GET["akce"], 1);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					$vyst =
					"
						  <form class=\"pridat_polozku_form\" action=\"\" method=\"post\">
                <fieldset>
                  <legend>Upravit styl</legend>
                  <label for=\"nazev_pridat\" class=\"pridat_nazev_label_trida\">Název stylu:</label>
                    <input id=\"nazev_pridat\" class=\"pridat_nazev_input\" type=\"text\" name=\"nazev\" value=\"{$this->VypisStyluText($id)}\" />
    						  <input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Upravit styl\" name=\"tlacitko\" />
    						</fieldset>
              </form>
          ";
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["nazev"]) &&
						!Empty($id) &&
						settype($id, "integer") &&
						$id != 0)
				{
					$vyst .= $this->UpravStyl($id, $_POST["nazev"]);
				}

				$vyst .= $this->VypisStyluEdit();
			break;
			//************************************************************************
			case "del_styl":
				$id = $this->RozdelCestu($_GET["akce"], 1);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					$vyst =
					"
              <form class=\"pridat_polozku_form\" action=\"\" method=\"post\">
                <fieldset>
                  <legend class=\"nadpis_smazani_polozky\">Chystáte se smazat styl s názvem a (ID):</legend>
                  <label class=\"nazev_smazani_polozky\">{$this->VypisStyluText($id)} ($id)</label>
                  <label class=\"otazka\">Opravdu chcete tento styl smazat ?</label>
    								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ano\" name=\"tlacitko\" />
    								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ne\" name=\"tlacitko\" />
                </fieldset>
              </form>
          ";
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						$_POST["tlacitko"] == "Ano" &&
						!Empty($id) &&
						settype($id, "integer") &&
						$id != 0)
				{
					$vyst .= $this->SmazStyl($id, $this->VypisStyluText($id));
				}
					else
				{
					if (!Empty($_POST["tlacitko"]))
					{
						$vyst .=
              "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl stornován požadavek na smazání stylu s názvem a (ID):
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    {$this->VypisStyluText($id)} ($id)
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=del_styl\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"stornovani_smazani_maly_levy\"></span>
                  <span class=\"stornovani_smazani_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
              ";
					}
				}

				$vyst .= $this->VypisStyluDel();
			break;
			//************************************************************************
			case "add_imp":
				$vyst =
				      "
				      <form class=\"pridat_polozku_form pridat_polozku_form_pridat_upravit_import\" action=\"\" method=\"post\">
                <fieldset>
                  <legend>Přidat import</legend>
                    <label>Název stylu:</label>
                      {$this->VyberStylu()}
                    <label>Import s cestou k CSS:</label>
                      {$this->VyberSouboruCSS()}
              ";
						if ($this->PocetStylu() >0)
						{
							$vyst .=
							"<input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Přidat import\" name=\"tlacitko\" />";
						}
						$vyst .=
             "</fieldset>
            </form>";

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["cislo"]) &&
						!Empty($_POST["cesta"]))
				{
					$vyst .= $this->PridejImport($_POST["cislo"], $_POST["cesta"]);
				}

				$vyst .= $this->VypisImportyAdd();
			break;
			//************************************************************************
			case "edit_imp":
				$id = $this->RozdelCestu($_GET["akce"], 1);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->db->query("SELECT * FROM import WHERE id=$id", NULL, $error))
					{
						$data = $res->fetchObject();
	
						$vyst =
						  "
						  <form class=\"pridat_polozku_form pridat_polozku_form_pridat_upravit_import\" action=\"\" method=\"post\">
                <fieldset>
                  <legend>Upravit import</legend>
                    <label>Název stylu:</label>
                      {$this->VyberStyluEdit($data->cislo)}
                    <label>Import s cestou k CSS:</label>
                      {$this->VyberSouboruCSSOznacene($data->cesta)}
                  <input id=\"pridat_polozku_tlacitko\" type=\"submit\" value=\"Upravit import\" name=\"tlacitko\" />
                </fieldset>
              </form>
              ";
					}
						else
					{
						$this->chyba = $this->ErrorMsg($error);
					}
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["cislo"]) &&
						!Empty($_POST["cesta"]) &&
						!Empty($id) &&
						settype($id, "integer") &&
						$id != 0)
				{
					$vyst .= $this->UpravImport($id, $_POST["cislo"], $_POST["cesta"]);
				}

				$vyst .= $this->VypisImportyEdit();
			break;
			//************************************************************************
			case "del_imp":
				$id = $this->RozdelCestu($_GET["akce"], 1);

				if (!Empty($id) && settype($id, "integer") && $id != 0)
				{
					if ($res = @$this->db->query("SELECT * FROM import WHERE id=$id", NULL, $error))
					{
						$data = $res->fetchObject();

						$vyst =
              "
              <form class=\"pridat_polozku_form\" action=\"\" method=\"post\">
                <fieldset>
                  <legend class=\"nadpis_smazani_polozky\">Chystáte se smazat import s cestou:</legend>
                  <label class=\"nazev_smazani_polozky\">$data->cesta</label>
                  <label class=\"druha_otazka_label\">vázaným ke stylu s názvem a (ID):</label>
                  <label class=\"nazev_smazani_polozky\">{$this->VypisStyluText($data->cislo)} ($data->id)</label>
                  <label class=\"otazka\">Opravdu chcete tento import smazat ?</label>
    								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ano\" name=\"tlacitko\" />
    								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ne\" name=\"tlacitko\" />
                </fieldset>
              </form>
              ";
					}
						else
					{
						$this->chyba = $this->ErrorMsg($error);
					}
				}

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						$_POST["tlacitko"] == "Ano" &&
						!Empty($id) &&
						settype($id, "integer") &&
						$id != 0)
				{
					$vyst .= $this->SmazImport($id, $data->cesta, $data->cislo);
				}
					else
				{
					if (!Empty($_POST["tlacitko"]))
					{
						$vyst .=
              "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl stornován požadavek na smazání importu s cestou k CSS souboru:
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $data->cesta
                  </p>
                  <p>
                    vázaným ke stylu s názvem a (ID):
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    {$this->VypisStyluText($data->cislo)} ($data->id)
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=del_imp\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"stornovani_smazani_importu_maly_levy\"></span>
                  <span class=\"stornovani_smazani_importu_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
              ";
					}
				}

				$vyst .= $this->VypisImportyDel();
				//return $vyst;
			break;
			//************************************************************************
			case "upload":
				$vyst =
				"
				<form class=\"upload_form\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">
  	      <fieldset>
  	        <legend>Upload CSS souborů</legend>
              <label for=\"upload_input\" id=\"upload_label_styl\">Cesta k CSS:</label>
              <input id=\"upload_input\" class=\"upload_input_styl\" type=\"file\" name=\"uploadstyl\" />
            <input class=\"upload_tlacitko\" type=\"submit\" value=\"Nahrát CSS\" name=\"tlacitko\" />
  	      </fieldset>
  	    </form>";
      	
      	if (!Empty($_POST["tlacitko"]) &&
						!Empty($_FILES["uploadstyl"]))
				{
					$a = explode(".", $_FILES["uploadstyl"]["name"]);
					$pripona = $a[count($a) - 1];
					if ($pripona == "css")
					{
						$zdroj = $_FILES["uploadstyl"]["tmp_name"];
						$nazev = $this->OsetreniNazvu($_FILES["uploadstyl"]["name"]);
						$cil = "../styles/{$nazev}";						

						if (move_uploaded_file($zdroj, $cil))
						{
							$vyst .=
            "
						<div class=\"obal_polozky_top\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Byl nahrán CSS soubor s názvem: <strong>$nazev</strong>
                </p>
                <p class=\"mirne_odsazeni\">
                  Pokračuj klapnutím <a href=\"global_styles.php?akce=upload\" title=\"Pokračuj klapnutím zde\">zde</a>
	              </p>
                <span class=\"stazeni_css_maly_levy\"></span>
                <span class=\"stazeni_css_maly_pravy\"></span>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
						}
							else
						{
							$vyst .=
            "
            <div class=\"obal_polozky_top\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Selhalo nahrávání souboru s názvem: <strong>$nazev</strong>
                </p>
                <p class=\"mirne_odsazeni\">
                  Počet chyb při nahrávání: <strong>{$_FILES["uploadstyl"]["error"]}</strong>
	              </p>
                <p class=\"mirne_odsazeni\">
                  Pokračuj klapnutím <a href=\"global_styles.php?akce=upload\" title=\"Pokračuj klapnutím zde\">zde</a>
	              </p>
                <span class=\"chyba_obrazek_vlevo\"></span>
                <span class=\"chyba_obrazek_vpravo\"></span>
              </div>
            <div class=\"obal_polozky_bottom\"></div>";
						}
					}
						else
					{
						$vyst .=
            "
            <div class=\"obal_polozky_top\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Selhalo nahrávání souboru kvůli nekompatibilní příponě: <strong>.$pripona</strong>
                </p>
                <p class=\"mirne_odsazeni\">
                  Pokračuj klapnutím <a href=\"global_styles.php?akce=upload\" title=\"Pokračuj klapnutím zde\">zde</a>
	              </p>
                <span class=\"chyba_obrazek_vlevo_pripona\"></span>
                <span class=\"chyba_obrazek_vpravo_pripona\"></span>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
					}
				}
				//return $vyst;
			break;
			//************************************************************************
			case "listupload":
				$pol = "./";
				$i = 0;
				$cesta = $vystup = "";
				$handle = opendir($pol);
				while ($soub = readdir($handle))
				{
					$i++;
					$cesta[$i]=$soub;
				}
				closedir($handle);
				sort($cesta);	//seřazení
				reset($cesta);
				
				$akce = $this->RozdelCestu($_GET["akce"], 1);
				$coakce = $this->RozdelCestu($_GET["akce"], 2);

				if (!Empty($akce))
				{
					switch($akce)
					{
						case "download":
							$vyst .= $this->ZabalitCSS($coakce);
						break;

						case "delete":
							$vyst .=
							"
							<form class=\"pridat_polozku_form\" action=\"\" method=\"post\">
                <fieldset>
                  <legend class=\"nadpis_smazani_polozky\">Chystáte se smazat CSS soubor s názvem:</legend>
                  <label class=\"nazev_smazani_polozky\">$coakce</label>
                  <label class=\"otazka\">Opravdu chcete tento CSS soubor smazat ?</label>
    								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ano\" name=\"tlacitko\" />
    								<input class=\"pridat_polozku_tlacitko_trida\" type=\"submit\" value=\"Ne\" name=\"tlacitko\" />
                </fieldset>
              </form>
              ";
							
							if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
									$_POST["tlacitko"] == "Ano" &&
									!Empty($coakce))
							{
								$vyst .= $this->SmazatSouborCSS($coakce);
							}
								else
							{
								if (!Empty($_POST["tlacitko"]))
								{
									$vystup .=
              "
  						<div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl stornován požadavek na smazání CSS souboru s názvem:
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $coakce
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=listupload\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"stornovani_smazani_maly_levy\"></span>
                  <span class=\"stornovani_smazani_maly_pravy\"></span>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
              ";
								}
							}
						break;
						
						case "deleteallzip":
							$vyst .= $this->SmazVsechnyZip();
						break;
					}
				}

				$vystup .=
				"
          <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Výpis CSS složky
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            <div class=\"obal_polozky_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"poradove_cislo vsechny_nazev\"><em>#</em></p>
                <p class=\"nazev_css vsechny_nazev\"><em>Název CSS</em></p>
                <p class=\"download_css vsechny_nazev\"><em>Stáhnout CSS</em></p>
                <p class=\"size_css vsechny_nazev\"><em>Velikost CSS</em></p>
                <p class=\"delete_css vsechny_nazev\"><em>Smazat CSS</em></p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
				";
				$j = 1;
				$poczip = 0;
				for ($i = 2; $i < count($cesta); $i++)
				{
					$a = explode(".", $cesta[$i]);
					$prip = $a[count($a) - 1];
					if ($prip == "css" && !($cesta[$i] == "empty_styles.css" ||
                                  $cesta[$i] == "global_styles_admin.css" ||
                                  $cesta[$i] == "log_index.css" ||
                                  $cesta[$i] == "log_index_admin_styles.css" ||
                                  $cesta[$i] == "styles_admin.css" ||
                                  $cesta[$i] == "styles_IE6.css" ||
                                  $cesta[$i] == "styles_IE6_admin.css" ||
                                  $cesta[$i] == "styles_IE7.css" ||
                                  $cesta[$i] == "styles_IE7_admin.css" ||
                                  $cesta[$i] == "styles_IE.css" ||
                                  $cesta[$i] == "styles_IE_admin.css"))
					{
						if (file_exists($cesta[$i]))
						{
							rename($cesta[$i], $this->KontrolaNazvu($cesta[$i]));	//kontrola jména souboru
						}
						$vystup .=
						"
						<div class=\"obal_polozky_top_vypis\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"poradove_cislo vsechny_nazev\" title=\"$j\">$j</p>
                <p class=\"nazev_css vsechny_nazev\">{$cesta[$i]}</p>
                <p class=\"download_css vsechny_nazev\"><a href=\"?akce=listupload{$this->oddel}download{$this->oddel}{$cesta[$i]}\" title=\"Stáhnout CSS\">Stáhnout CSS</a></p>
                <p class=\"size_css vsechny_nazev\">{$this->VelikostSouboru("$pol/{$cesta[$i]}")}</p>
                <p class=\"delete_css vsechny_nazev\"><a href=\"?akce=listupload{$this->oddel}delete{$this->oddel}{$cesta[$i]}\" title=\"Smazat CSS\">Smazat CSS</a></p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
						$j++;
					}
					
					if ($prip == "zip")
					{
						$poczip++;
						$zip .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  <strong>Stáhnout soubor s názvem:</strong>
                </p>
                <p class=\"mirne_odsazeni\">
                  <a href=\"{$cesta[$i]}\" title=\"Stáhnout soubor s názvem: {$cesta[$i]}\">{$cesta[$i]}</a>
                </p>
                <span class=\"stazeni_css_maly_levy\"></span>
                <span class=\"stazeni_css_maly_pravy\"></span>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
					}
				}
				$vystup .= "";
				
				if ($poczip != 0)
				{
					$vystup .=
					"
            <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Výpis CSS složky se zabalenými CSS soubory
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            $zip
            <div class=\"obal_polozky_top odsazeni_top_mensi\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Počet zabalených CSS souborů: <strong>$poczip</strong>
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p>
                  Pro smazání všech zabalených CSS souborů klapněte <a href=\"?akce=listupload{$this->oddel}deleteallzip\" title=\"Pro smazání všech zabalených CSS souborů klapněte zde\">zde</a>
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
				}
				$vyst .= $vystup;
			break;
		}	//end switch
		if ($this->AktualniZpracovani() == "global_styles.php" && !Empty($_GET["akce"]))
		{
  		$vyst .=
            "
            </div>
            <div id=\"admin_zapati\">
  	          <p id=\"autori\">
                Design &amp; Coding by Fugess (2008), Programming by Geniv (2008)
              </p>
	          </div>
          </body>
        </html>
            ";
    }
    return $vyst;
	}	//end sekce
//******************************************************************************
	function KontrolaLoginu($jmeno, $heslo)	//ověřování loginů
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
	function VyberStylu()	//vypsáné stylů do selectu
	{
		if ($res = @$this->db->query("SELECT * FROM styl", NULL, $error))
		{
			$poc = $res->numRows();
			
			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "<select name=\"cislo\">\n"; //začátek selectu
				for ($i = 0; $i < $poc; $i++) //vykreslovací cyklus
				{
					$data = $res->fetchObject();
					$vystup.="<option value=\"$data->id\">".stripslashes($data->nazev)."</option>\n"; //řádek selectu
				}
				$vystup.="</select>"; //konec selectu
		
				$result = $vystup; //vratí poskládaný select
			}
				else
			{
				$result = "<p>Prázdný seznam stylů</p>"; //pokud není řádek
			}
			return $result;
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
	function VypisStyluAdd()
	{
		if ($res = @$this->db->query("SELECT * FROM styl", NULL, $error))
		{
			$poc = $res->numRows();
			if ($poc > 0)
			{
				$vypis =
            "
    				<div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  <strong>###</strong>
                </p>
                <p>
                  <strong>Název stylu</strong>
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
	
				for ($i = 0; $i < $poc; $i++)
				{
					$data = $res->fetchObject();
					$vypis .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  $data->id
                </p>
                <p>
                  $data->nazev
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
				}
				$vypis .= "";
			}
				else
			{
				$vypis = $this->EmptyTable();
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vypis;
	}
//******************************************************************************
	function VypisStyluEdit()	//vypsané styly na editaci
	{
		if ($res = @$this->db->query("SELECT * FROM styl", NULL, $error))
		{
			$poc = $res->numRows();
			if ($poc > 0)
			{
				$vypis =
            "
				    <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  <strong>###</strong>
                </p>
                <p>
                  <strong>Název stylu</strong>
                </p>
                <p>
                  (<strong>Upravit styl</strong>)
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
	
				for ($i = 0; $i < $poc; $i++)
				{
					$data = $res->fetchObject();
					$vypis .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  $data->id
                </p>
                <p>
                  $data->nazev
                </p>
                <p>
                  (<a href=\"?akce=edit_styl{$this->oddel}{$data->id}\" title=\"Upravit\">Upravit</a>)
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
				}
				$vypis .= "";
			}
				else
			{
				$vypis = $this->EmptyTable();
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vypis;
	}
//******************************************************************************
	function VypisStyluDel()	//vypsané styly na smazání
	{
		if ($res = @$this->db->query("SELECT * FROM styl", NULL, $error))
		{
			$poc = $res->numRows();
			if ($poc > 0)
			{
				$vypis =
            "
            <div class=\"obal_polozky_top odsazeni_top\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  <strong>###</strong>
                </p>
                <p>
                  <strong>Název stylu</strong>
                </p>
                <p>
                  (<strong>Smazat styl</strong>)
                </p>
              </div>
            <div class=\"obal_polozky_bottom odsazeni_bottom_male\"></div>
            ";
	
				for ($i = 0; $i < $poc; $i++)
				{
					$data = $res->fetchObject();
					$vypis .=
            "
            <div class=\"obal_polozky_top odsazeni_top_male\"></div>
              <div class=\"obal_polozky_center\">
                <p class=\"vypis_stylu\">
                  $data->id
                </p>
                <p>
                  $data->nazev
                </p>
                <p>
                  (<a href=\"?akce=del_styl{$this->oddel}{$data->id}\" title=\"Smazat\">Smazat</a>)
                </p>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";
				}
				$vypis .= "";
			}
				else
			{
				$vypis = $this->EmptyTable();
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vypis;
	}
//******************************************************************************
	function VyberStyluEdit($cislo)	//výběr stylu v selektu v editaci
	{
		if ($res = @$this->db->query("SELECT * FROM styl", NULL, $error))
		{
			$poc = $res->numRows();
			
			if ($poc > 0) //je-li větší jak 0
			{
				$vystup = "<select name=\"cislo\">\n"; //začátek selectu
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
					$vystup .= "<option $oznac value=\"$data->id\">".stripslashes($data->nazev)."</option>\n"; //řádek selectu
				}
				$vystup .= "</select>"; //konec selectu
			}
				else
			{
				$vystup = "<p>Prázdný seznam stylů</p>"; //pokud není řádek
			}
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
		return $vystup;
	}
//******************************************************************************
	function VypisStyluText($cislo)	//výpis vybraného stylu při mazání i přímo v katalogu
	{
		if ($res = @$this->db->query("SELECT * FROM styl WHERE id=$cislo", NULL, $error))
		{
			return $res->fetchObject()->nazev;
		}
			else
		{
			$this->chyba = $this->ErrorMsg($error);
		}
	}
//******************************************************************************
/*
	function ObsahStylu($sem)	//využito přímo v katalogu
	{
		if ($res = $this->db->query("SELECT * FROM styl"))
		{
			$poc = $res->numRows();
			
			if ($rs = $this->db->query("SELECT styl FROM nastaveni WHERE jmeno='styl'"))
			{
				$cislo = $rs->fetchObject()->styl;
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
					$vystup .= "<option $oznac value=\"$data->id\">".stripslashes($data->nazev)."</option>\n"; //řádek selectu
				}
				$vystup .= "</select>
										<input id=\"tlacitko_nastavit\" type=\"submit\" name=\"tlacitkostyl\" value=\"Nastavit\" />
										<input type=\"hidden\" name=\"action\" value=\"$sem\" />
										</fieldset>
          </form>"; //konec selectu
				if (!Empty($_GET["tlacitkostyl"]) &&
						!Empty($_GET["styl"]))
				{
					$vystup .= $this->NastavStyl($_GET["styl"], $sem);
				}
			}
				else
			{
				$vystup = "prázdný seznam stylů"; //pokud není řádek
			}
		}
			else
		{
			$vystup = "něco se pokazilo";
		}
		return $vystup;
	}
*/
//******************************************************************************
/*
	function NastavStyl($cislo, $sem)	//využito přímo v katalogu
	{
		if ($this->db->queryExec("UPDATE nastaveni SET styl=$cislo WHERE jmeno='styl'"))
		{
			$vyst = "
			<div class=\"pozice_nastaveni_polozek\">
        <div class=\"pozadi_top_razeni_katal\"></div>
    			<div class=\"pozadi_obal_razeni_katal\">
      			<p>
              Byl nastaven styl s názvem: <strong>{$this->VypisStyluText($cislo)}</strong>
            </p>
            <p class=\"vetsi_odsazeni_mezi_dvema_odstavci\">
              Pokračuj klapnutím <a href=\"?action=$sem\" title=\"Pokračuj klapnutím zde\">zde</a>
            </p>
    			</div>
  			<div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
			</div>
      "; // {$this->AutoClick(1, "index.php")}";
		}
			else
		{
			$vyst = "něco se podělalo {$this->AutoClick(1, "global_styles.php?akce=all")}";
		}
		return $vyst;
	}
*/
//******************************************************************************
	function ZabalitCSS($nazev)
	{
		$a = explode(".", $nazev);
		$nazev = $a[count($a) - 2];
	
		$zip = new ZipArchive;
		if ($res = $zip->open("{$nazev}.zip", ZipArchive::CREATE))
		{
			$zip->addFile("{$nazev}.css");
			$zip->close();
			$vyst =
            "{$this->AutoClick(0, "{$nazev}.zip")}
            <div class=\"obal_polozky_top\"></div>
              <div class=\"obal_polozky_center vetsi_padding\">
                <p>
                  Byl zabalen CSS soubor s názvem: <strong>$nazev.css</strong>
                </p>
                <p class=\"mirne_odsazeni\">
                  Zároveň Vám byl CSS soubor odeslán ke stažení.
                </p>
                <p class=\"mirne_odsazeni\">
                  Jestli se Vám nezobrazil dotaz na stažení CSS, tak jej můžete stáhnout <a href=\"{$nazev}.zip\" title=\"Klepněte zde pro stažení CSS souboru\">zde</a>.
                </p>
                <p class=\"mirne_odsazeni\">
                  Pokračuj klapnutím <a href=\"global_styles.php?akce=listupload\" title=\"Pokračuj klapnutím zde\">zde</a>
	              </p>
               <span id=\"stazeni_css_levy\"></span>
               <span id=\"stazeni_css_pravy\"></span>
              </div>
            <div class=\"obal_polozky_bottom\"></div>
            ";	//stažení konkrétního souboru
		}
			else
		{
			$this->chyba = $this->ErrorMsg("nezabaleno");
		}
		return $vyst;
	}
//******************************************************************************
	function VelikostSouboru($cesta)
	{
		if (file_exists($cesta))
		{
			$vel = filesize($cesta);
			if($vel >= 1048576)
			{
				$velikost = sprintf("%.2f MB", $vel / 1048576);
			}
				else
			if($vel >= 1024)
			{
				$velikost = sprintf("%.2f kB", $vel / 1024);
			}
				else
			{
				$velikost = sprintf("%.2f bytes", $vel);
			}
			return $velikost;
		}	
	}
//******************************************************************************
	function VyberSouboruCSS()
	{
		$pol = "./";
		$i = 0;
		$cesta = "";
		$handle = opendir($pol);
		while ($soub = readdir($handle))
		{
			$i++;
			$cesta[$i]=$soub;
		}

		closedir($handle);
		sort($cesta);	//seřazení
		reset($cesta);

		$vystup =
		"<select name=\"cesta\">";

		for ($i = 2; $i < count($cesta); $i++)
		{
			$a = explode(".", $cesta[$i]);
			$prip = $a[count($a) - 1];
			if ($prip == "css" && !($cesta[$i] == "empty_styles.css" ||
                              $cesta[$i] == "global_styles_admin.css" ||
                              $cesta[$i] == "log_index.css" ||
                              $cesta[$i] == "log_index_admin_styles.css" ||
                              $cesta[$i] == "styles_admin.css" ||
                              $cesta[$i] == "styles_IE6.css" ||
                              $cesta[$i] == "styles_IE6_admin.css" ||
                              $cesta[$i] == "styles_IE7.css" ||
                              $cesta[$i] == "styles_IE7_admin.css" ||
                              $cesta[$i] == "styles_IE.css" ||
                              $cesta[$i] == "styles_IE_admin.css"))
			{
				$vystup .=
				"<option value=\"{$cesta[$i]}\">{$cesta[$i]}</option>"; 
			}	
		}

		$vystup .= "</select>";
		return $vystup;
	}
//******************************************************************************
	function VyberSouboruCSSOznacene($nazev)
	{
		$pol = "./";
		$i = 0;
		$cesta = "";
		$handle = opendir($pol);
		while ($soub = readdir($handle))
		{
			$i++;
			$cesta[$i]=$soub;
		}

		closedir($handle);
		sort($cesta);	//seřazení
		reset($cesta);

		$vystup =
		"<select name=\"cesta\">";

		for ($i = 2; $i < count($cesta); $i++)
		{
			$a = explode(".", $cesta[$i]);
			$prip = $a[count($a) - 1];
			if ($nazev == $cesta[$i])
			{
				$oznac = "selected=\"selected\"";
			}
				else
			{
				$oznac = "";
			}
			
			if ($prip == "css" && !($cesta[$i] == "empty_styles.css" ||
                              $cesta[$i] == "global_styles_admin.css" ||
                              $cesta[$i] == "log_index.css" ||
                              $cesta[$i] == "log_index_admin_styles.css" ||
                              $cesta[$i] == "styles_admin.css" ||
                              $cesta[$i] == "styles_IE6.css" ||
                              $cesta[$i] == "styles_IE6_admin.css" ||
                              $cesta[$i] == "styles_IE7.css" ||
                              $cesta[$i] == "styles_IE7_admin.css" ||
                              $cesta[$i] == "styles_IE.css" ||
                              $cesta[$i] == "styles_IE_admin.css"))
			{
				$vystup .=
				"<option $oznac value=\"{$cesta[$i]}\">{$cesta[$i]}</option>"; 
			}	
		}

		$vystup .= "</select>";
		return $vystup;
	}
//******************************************************************************
	function SmazatSouborCSS($soubor)
	{
		if (unlink($soubor))
		{
			$vyst = "
              <div class=\"obal_polozky_top\"></div>
                <div class=\"obal_polozky_center\">
                  <p>
                    Byl smazán CSS soubor s názvem:
                  </p>
                  <p class=\"mirne_odsazeni nazev_smazani_polozky\">
                    $soubor
                  </p>
                  <p class=\"mirne_odsazeni\">
                    Pokračuj klapnutím <a href=\"global_styles.php?akce=listupload\" title=\"Pokračuj klapnutím zde\">zde</a>
  	              </p>
                  <span class=\"smazani_css_maly_levy smazani_css_maly_levy_vetsi_top\"></span>
                  <span class=\"smazani_css_maly_pravy smazani_css_maly_pravy_vetsi_top\"></span>
                </div>
              <div class=\"obal_polozky_bottom\"></div>
              ";
		}
			else
		{
			$this->chyba = $this->ErrorMsg("Vyskytla se chyba při mazání CSS souboru");
		}
		return $vyst;
	}
//******************************************************************************
	function KontrolaNazvu($jmeno) //vrací nové jméno
	{
	   return strtr($jmeno," -áäčďéěëíňóöřšťúůüýžÁÄČĎÉĚËÍŇÓÖŘŠŤÚŮÜÝŽ",
												"__aacdeeeinoorstuuuyzAACDEEEINOORSTUUUYZ");
	}
//******************************************************************************
	function SmazVsechnyZip()
	{
		$pol = "./";
		$handle = opendir($pol);
		$er = 0;
		while ($soub = readdir($handle))
		{
			$a = explode(".", $soub);
			if ($a[count($a) - 1] == "zip")	//najde si *.zip
			{
				if (!@unlink($soub))
				{
          $this->chyba = $this->ErrorMsg("Selhalo smazání zip souboru s názvem: <strong>$soub</strong>");
          $er++;
        }
			}
		}
		closedir($handle);
		
		if ($er == 0)
		{
			$result = "
			        <div class=\"obal_polozky_top odsazeni_top_male\"></div>
	              <div class=\"obal_polozky_center\">
	                <p>
	                  Byly smazány všechny zip soubory z CSS složky.
	                </p>
	                <p class=\"mirne_odsazeni\">
	                  Pokračuj klapnutím <a href=\"global_styles.php?akce=listupload\" title=\"Pokračuj klapnutím zde\">zde</a>
		              </p>
	                <span class=\"smazani_css_maly_levy\"></span>
	                <span class=\"smazani_css_maly_pravy\"></span>
	              </div>
	            <div class=\"obal_polozky_bottom\"></div>
	            ";
    }
    return $result;
	}
//******************************************************************************
	function OsetreniNazvu($jmeno)
	{
		$a = explode(".", $jmeno);	//rozdělení jména
		$jm = $this->KontrolaNazvu($a[count($a) - 2]);	//odstranění znaků a na malé písmena

		$result = "{$jm}.css";	//zamýšlený název

		if (file_exists($result))
		{
			$pol = "./";
			$handle = opendir($pol);
			$i = 0;
			while ($soub = readdir($handle))
			{
				$soubor[$i] = $soub;
				$i++;
			}
			closedir($handle);

			$acount = array_count_values($soubor);	//spočítání duplikátní
			$klic = array_keys($acount);	//výběr klíče
			for ($i = 0; $i < count($klic); $i++)
			{
				$t0 = explode(".", $klic[$i]);	//rozdělení dle teček
				$t1 = explode("(", $t0[0]);	//rozdělení dle závorek
				$t2[$i] = $t1[0];	//přidělení 0 indexu
			}
			$bcount = array_count_values($t2);	//spočítá duplikátní
			$pocet = $bcount[$jm];	//přečte z pole počet souborů
			$result = "{$jm}({$pocet}).css";	//název při existenci souboru
		}

		return $result;
	}
//******************************************************************************
	function Title()
	{
		$kam = $this->RozdelCestu($_GET["akce"], 0);
		
		$poloha = array("all" => "Výpis aktuálního CSS",
										"upload" => "Upload CSS souborů",
										"listupload" => "Výpis CSS složky",
										"add_styl" => "Přidat styl",
										"edit_styl" => "Upravit styl",
										"del_styl" => "Smazat styl",
										"add_imp" => "Přidat import",
										"edit_imp" => "Upravit import",
										"del_imp" => "Smazat import",
										"logout" => "Byl jsi odhlášen.");

		return $poloha[$kam];
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

$obj = new CSS;
?>