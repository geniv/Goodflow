<?php
class Baklov
{
	var $dynvar = "action";	//proměnná dynamické adresy
	var $default = "uvod";	//dafaulní stránka
	var $defpozdr = "Vítej člověče";	//defaulrní pozdrav
	var $meta;	//globální meta refresh
	var $title = array ("uvod" => "Hlavní strana",	//pole popisů hlaviček
											"turistika" => "Turistické informace",
											"turistikafyzicka" => "Fyzická osoba",
											"turistikapravnicka" => "Podnikatel",
											"doprava" => "Doprava",
											"dopravaauto" => "Autem",
											"dopravavlak" => "Vlakem",
											"akce" => "Pořádání akcí",
											"akcesoukroma" => "Soukromé akce",
											"akcefiremni" => "Firemní akce",
											"pamatky" => "Okolní památky",
											"kontakt" => "Kontakt",
											"mapa" => "Mapa stránek",
											"opatreni" => "Opatření pro zlepšení on-page a off-page faktorů",
											"prohlaseni" => "Prohlášení o přístupnosti");
  var $prepisovanicest = array ("uvod" => "hlavni-strana",	//pole konverze cesty
                                "turistika" => "turisticke-informace",
                                "turistikafyzicka" => "turisticke-informace-fyzicka-osoba",
                                "turistikapravnicka" => "turisticke-informace-podnikatel",
                                "doprava" => "doprava",
                                "dopravaauto" => "doprava-autem",
                                "dopravavlak" => "doprava-vlakem",
                                "akce" => "poradani-akci",
                                "akcesoukroma" => "poradani-akci-soukrome-akce",
                                "akcefiremni" => "poradani-akci-firemni-akce",
                                "pamatky" => "okolni-pamatky",
                                "kontakt" => "kontakt",
                                "mapa" => "mapa-stranek",
                                "opatreni" => "opatreni-pro-zlepseni-on-page-a-off-page-faktoru",
                                "prohlaseni" => "prohlaseni-o-pristupnosti");
//******************************************************************************
	function Styl()	//Prepinani a nastavování stylu
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);
		$sub = $this->RozdelCestu($_GET[$this->dynvar], 1);

		if (Empty($_GET["setstyl"]) &&
				Empty($_COOKIE["styl"]) ||
				($kam == "mapa" ||
				$kam == "opatreni" ||
				$kam == "prohlaseni"))
		{
			$result = "style_default";
		}
			else
		{
			if (!Empty($_GET["Nastavit"]) &&
					!Empty($_GET["setstyl"]))
			{
				switch ($_GET["setstyl"])
				{
					case "1":
						$set = "style_default";
					break;
	
					case "2":
						$set = "style_1";
					break;
	
					case "3":
						$set = "style_2";
					break;
	
					case 4:
						$set = "style_empty";
					break;
					
					default:
						$set = "style_default";
					break;
				}

				SetCookie("styl", $set, Time() + 31536000);	//nastavení vybraného cookie
				if (!Empty($kam))
				{
					$cesta = $this->prepisovanicest[$kam];	//když neni prázdný kam
					if (!Empty($sub))	//když není prazdný sub
					{
						$cesta = $this->prepisovanicest["{$kam}{$sub}"];
					}
				}
					else
				{
					$cesta = $this->prepisovanicest[$this->default];	//když je prázdný kam
				}		
				$this->meta = $this->AutoClick(0, $cesta);	//auto set
			}
			if (!Empty($_COOKIE["styl"]))	//oštření při prázdném cookie
			{
				$result = $_COOKIE["styl"];
			}
				else
			{
				$result = "style_default";
			}
		}

		return $result;
	}
//******************************************************************************
	function NastavJmeno()	//nastavování pozdravu
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);
		$sub = $this->RozdelCestu($_GET[$this->dynvar], 1);

		if (!Empty($_GET["Nastavit"]) &&
				!Empty($_GET["pozdrav"]))
		{
			SetCookie("jmenobak", $_GET["pozdrav"], Time() + 31536000);
			if (!Empty($kam))
			{
				$cesta = $this->prepisovanicest[$kam];	//když neni prázdný kam
				if (!Empty($sub))	//když není prazdný sub
				{
					$cesta = $this->prepisovanicest["{$kam}{$sub}"];
				}
			}
				else
			{
				$cesta = $this->prepisovanicest[$this->default];	//když je prázdný kam
			}
			$this->meta = $this->AutoClick(0, $cesta);	//auto set $cesta
		}
	}
//******************************************************************************
	function VratitJmeno()	//návrat pozdravu
	{
		$kolac = $_COOKIE["jmenobak"];
		if (!Empty($kolac))
		{
			$result = $kolac;
		}
			else
		{
			$result = $this->defpozdr;
		}
		return $result;
	}
//******************************************************************************
	function RozdelCestu($cesta, $poradi)	//rozdělení dynamické adresy (vnucené .htaccessem)
	{
		$a = explode("-", $cesta); //rosekání adresy a vrácení žádaného výsledku
		return $a[$poradi];
	}
//******************************************************************************
	function Stranka()	//hlavní zobrazovací funkce
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);

		if (!($kam == "mapa" ||
					$kam == "opatreni" ||
					$kam == "prohlaseni"))
		{
			$styl4 = $this->ZmenaStylu(4, "Textová verze stránek");
		}

		if ($_COOKIE["styl"] != "style_empty")
		{
			$reset = "<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/reset.css\" media=\"screen\" />";
		}

		$this->NastavJmeno();	//procedůra nastavení jména
//print_r($_REQUEST);
		$vyst =
		"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
				\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
			  <head>
			    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			    <meta http-equiv=\"Content-Language\" content=\"cs\" />
			    <meta name=\"author\" content=\"Geniv &amp; Fugess\" />
			    <meta name=\"copyright\" content=\"Geniv (c) 2008, Fugess (c) 2008\" />
			    <meta name=\"keywords\" content=\"Hrad Baklov, Baklov, památka Baklov, fiktivní hrad Baklov, Hrad Baklov - {$this->Title()}\" />
			    <meta name=\"description\" content=\"Hrad Baklov - {$this->Title()}\" />
			    <meta name=\"robots\" content=\"index, follow\" />
			    <meta name=\"verify-v1\" content=\"u+jMoRJyyEnUWiFVkct9+nfS8QrzYlKQ/m8UVaZXzC8=\" />
			    $reset
			    <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/{$this->Styl()}.css\" media=\"screen\" />
			    $this->meta
					<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/style_print.css\" media=\"print\" />
			    <!--[if IE]>
			    	<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
			    <![endif]-->
			    <!--[if lte IE 6]>
			    	<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
			    <![endif]-->
			    <link rel=\"shortcut icon\" href=\"img/favikona.ico\" />
			    <script type=\"text/javascript\" src=\"script/zmena_stylu.js\"></script>
          <script type=\"text/javascript\">
            var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
            document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
          </script>
          <script type=\"text/javascript\">
            var pageTracker = _gat._getTracker(\"UA-4450047-1\");
            pageTracker._initData();
            pageTracker._trackPageview();
          </script>
			    <title>Hrad Baklov - {$this->Title()}</title>
			  </head>
			    <body>
		  	    <div id=\"zahlavi\">
		    	    <h1><a href=\"./\" title=\"Hrad Baklov\">Hrad Baklov</a></h1>
		    	    <h2>Vítejte na stránkách o fiktivním hradu Baklov</h2>
		    	    <span id=\"pozdr\">{$this->VratitJmeno()}</span>
		        </div>
		        <div id=\"lista_zahlavi\">
		          {$this->SekceStranky()}
		          <div id=\"zmena_stylu_odkazy\">
		            {$this->BlokZmenaStylu()}
		          </div>
		        </div>
		        <div id=\"obal_bloku_1_2\">
		    	    <div id=\"blok_1\">
		      	    {$this->Navigace()}
		          </div>
							{$this->VlozenaStranka()}		        
		  	    <div id=\"lista_zapati\">
		          <form id=\"zmeja_jmena\" action=\"\" method=\"get\">
		            <fieldset>
		              <legend>Nastav si svůj pozdrav !</legend>
		              <label for=\"pozd\">Zde napiš své jméno:</label>
		              <input type=\"text\" id=\"pozd\" name=\"pozdrav\" value=\"{$this->VratitJmeno()}\" />
		              <input type=\"hidden\" name=\"{$this->dynvar}\" value=\"{$_GET[$this->dynvar]}\" />
		              <input type=\"hidden\" id=\"setstyl\" name=\"setstyl\"/>
		              <input id=\"potvrdit\" type=\"submit\" name=\"Nastavit\" value=\"Nastavit\" />
		            </fieldset>
		          </form>
		        </div>
		  	    <div id=\"zapati\">
		          <p id=\"prvni\">
		            $styl4
		          </p>
		          <p>
		            <a href=\"mapa-stranek\" title=\"Mapa stránek\">Mapa stránek</a>
		          </p>
		          <p>
		            <a href=\"opatreni-pro-zlepseni-on-page-a-off-page-faktoru\" title=\"Opatření pro zlepšení on-page a off-page faktorů\">Opatření pro zlepšení on-page a off-page faktorů</a>
		          </p>
		          <p>
		            <a href=\"prohlaseni-o-pristupnosti\" title=\"Prohlášení o přístupnosti\">Prohlášení o přístupnosti</a>
		          </p>
		          <div>
		            <p>
		              <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS version 2.1 !\" rel=\"nofollow\">Valid CSS 2.1 !</a>
		            </p>
		            <p>-
		              <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict !\" rel=\"nofollow\">Valid XHTML 1.0 Strict !</a>
		            </p>
		          </div>
		          <p>
		            Design &amp; Coding by Fugess, Programming by Geniv
		          </p>
		  	    </div>
			    </body>
			</html>
		";

		return $vyst;
	}
//******************************************************************************
	function Title()	//změna hlavičky dle adresy
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);
		$sub = $this->RozdelCestu($_GET[$this->dynvar], 1);

		if (Empty($kam))
		{
			$result = $this->title["uvod"];
		}
			else
		{
			$result = $this->title[$kam];
			if (!Empty($sub))
			{
				$result = "{$this->title[$kam]} - {$this->title["{$kam}{$sub}"]}" ;
			}
		}

		return $result;
	}
//******************************************************************************
	function ZmenaStylu($cislo, $popis)	//odkaz změny stylu
	{
		return "<a href=\"#\" onclick=\"ZmenStyl($cislo);\" title=\"$popis\">$popis</a>";
	}
//******************************************************************************
	function VlozenaStranka()	//vkládání obsahu stránky přes include a return
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);
		$sub = $this->RozdelCestu($_GET[$this->dynvar], 1);

		if (!Empty($kam))
		{
			if (file_exists("{$kam}.php"))
			{
				if (!Empty($sub) && file_exists("{$kam}_{$sub}.php"))	//musí existovat hlavní i subsekce
				{
					return include_once "{$kam}_{$sub}.php";
				}
					else
				{
					return include_once "{$kam}.php"; //všechny stránky musí mít jako návrat return!
				}
			}
				else
			{
				return include_once "{$this->default}.php";
			}
		}
			else
		{
			return include_once "{$this->default}.php";
		}
	}
//******************************************************************************
	function Navigace()	//funkce hlavního menu
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);

		if (!Empty($kam))
		{
			switch ($kam)
			{
				case "turistika":
					$subtur = 
					"
          <li class=\"vnoreny\">
            <ol>
              <li><a href=\"turisticke-informace-fyzicka-osoba\" title=\"Fyzická osoba\">Fyzická osoba</a><span> - </span></li>
              <li><a href=\"turisticke-informace-podnikatel\" title=\"Podnikatel\">Podnikatel</a></li>
            </ol>
          </li>
          ";
				break;

				case "doprava":
					$subdop =
					"
					<li class=\"vnoreny\">
            <ol id=\"doprava\">
              <li><a href=\"doprava-autem\" title=\"Autem\">Autem</a><span> - </span></li>
              <li><a href=\"doprava-vlakem\" title=\"Vlakem\">Vlakem</a></li>
            </ol>
          </li>
          ";
				break;

				case "akce":
					$subakc =
					"
					<li class=\"vnoreny\">
            <ol id=\"poradani_akci\">
              <li><a href=\"poradani-akci-soukrome-akce\" title=\"Soukromé akce\">Soukromé akce</a><span> - </span></li>
              <li><a href=\"poradani-akci-firemni-akce\" title=\"Firemní akce\">Firemní akce</a></li>
            </ol>
          </li>";
				break;
			}
		}

		return
		"<h3>Navigace</h3>
			<ul>
				<li><a href=\"hlavni-strana\" title=\"Hlavní strana\">Hlavní strana</a></li>
				<li><a href=\"turisticke-informace\" title=\"Turistické informace\">Turistické informace</a></li>
				$subtur
				<li><a href=\"doprava\" title=\"Doprava\">Doprava</a></li>
				$subdop
				<li><a href=\"poradani-akci\" title=\"Pořádání akcí\">Pořádání akcí</a></li>
				$subakc
				<li><a href=\"okolni-pamatky\" title=\"Okolní památky\">Okolní památky</a></li>
				<li><a href=\"kontakt\" title=\"Kontakt\">Kontakt</a></li>
			</ul>";
	}
//******************************************************************************
	function SekceStranky()	//drobečková navigace
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);
		$sub = $this->RozdelCestu($_GET[$this->dynvar], 1);

		$result = "<p>Nacházíte se v sekci: <strong><a href=\"hlavni-strana\" title=\"Hlavní strana\">Hlavní strana</a>";
		
		if (!Empty($kam) && $kam != "uvod")
		{
			$result .= " &raquo; <a href=\"{$this->prepisovanicest[$kam]}\" title=\"{$this->title[$kam]}\">{$this->title[$kam]}</a>";
			if (!Empty($sub))
			{
				$result .= " &raquo; <a href=\"{$this->prepisovanicest["{$kam}{$sub}"]}\" title=\"{$this->title["{$kam}{$sub}"]}\">{$this->title["{$kam}{$sub}"]}</a>";
			}
		}

		return "$result</strong></p>";
	}
//******************************************************************************
	function BlokZmenaStylu()	//blok změny stylu stránek
	{
		$kam = $this->RozdelCestu($_GET[$this->dynvar], 0);
		if (!($kam == "mapa" ||
					$kam == "opatreni" ||
					$kam == "prohlaseni"))
		{
			return
			"<p id=\"nadpis_styly\">Změn si styl stránek !</p>
	      <p>
	        {$this->ZmenaStylu(1, "Základní styl")}
	      </p>
	      <p>
	        {$this->ZmenaStylu(2, "Druhý styl")}
	      </p>
	      <p>
	        {$this->ZmenaStylu(3, "Třetí styl")}
	      </p>";
		}
	}
//******************************************************************************
	function AutoClick($cas, $cesta)	//refresh-ovaci meta
	{
		return "<meta http-equiv=\"refresh\" content=\"$cas;URL=$cesta\" />";
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}
?>
