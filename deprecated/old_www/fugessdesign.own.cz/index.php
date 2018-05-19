<?
require "administrace/funkce.php";

$web = new TFugessDesign; //vytvoření třídy
$web->StartCas(); //začítek měření času
$barva = $web->Adresa(0); //načtení barvy
$kam = $web->Adresa(1);	//načtení umistění

if (Empty($_GET["color"]))
{
	print //uvodní stránka
	"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
		\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
	  <head>
	    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
	    <meta http-equiv=\"Content-Language\" content=\"cs\" />
	    <meta name=\"author\" content=\"Fugess (Martin)\" />
	    <meta name=\"copyright\" content=\"Fugess Design (c) 2008\" />
	    <meta name=\"keywords\" content=\"fugess design, fugess, webdesign, fugessdesign, fugess webdesign\" />
	    <meta name=\"description\" content=\"Weblog o mladém tvůrci webových prezentací\" />
	    <meta name=\"robots\" content=\"index, follow\" />
	      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
	      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/index_styles.css\" media=\"screen\" />
	      <!--[if lte IE 6]>
	        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
	      <![endif]-->
	      <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
	      <title>Fugess Design - Fugessova tvorba webdesignu</title>
	  </head>
	    <body>
	      <div id=\"logoindex\"></div>
	        <p id=\"textpodlogem\">Vyberte si barvu, která Vám vyhovuje.</p>
	      <div id=\"vyberbarvu\">
  	      <p>
  	        <a href=\"?color={$web->bar[0]}\" title=\"Červená\">
  	          <img src=\"obr/icon_{$web->bar[0]}.png\" alt=\"Červená\" />
  	        </a>
  	      </p>
  	      <p>
  	        <a href=\"?color={$web->bar[1]}\" title=\"Fialová\" rel=\"nofollow\">
  	          <img src=\"obr/icon_{$web->bar[1]}.png\" alt=\"Fialová\" />
  	        </a>
  	      </p>
  	      <p>
  	        <a href=\"?color={$web->bar[2]}\" title=\"Purpurová\" rel=\"nofollow\">
  	          <img src=\"obr/icon_{$web->bar[2]}.png\" alt=\"Purpurová\" />
  	        </a>
  	      </p>
  	      <p>
  	        <a href=\"?color={$web->bar[3]}\" title=\"Modrá\" rel=\"nofollow\">
  	          <img src=\"obr/icon_{$web->bar[3]}.png\" alt=\"Modrá\" />
  	        </a>
  	      </p>
  	      <p>
  	        <a href=\"?color={$web->bar[4]}\" title=\"Zelená\" rel=\"nofollow\">
  	          <img src=\"obr/icon_{$web->bar[4]}.png\" alt=\"Zelená\" />
  	        </a>
  	      </p>
  	      <p>
  	        <a href=\"?color={$web->bar[5]}\" title=\"Černá\" rel=\"nofollow\">
  	          <img src=\"obr/icon_{$web->bar[5]}.png\" alt=\"Černá\" />
  	        </a>
  	      </p>
	      </div>
	      <div id=\"netagent\">
	        <p>
	          <img src=\"http://www.netagent.cz/agent.php?id=9785\" alt=\"NetAgent počítadlo\" />
	        </p>
	      </div>
	    </body>
	</html>";
}
  else
{
	print //globální index každé stránky
	"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
		\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
    <head>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
      <meta http-equiv=\"Content-Language\" content=\"cs\" />
      <meta name=\"author\" content=\"Fugess (Martin)\" />
      <meta name=\"copyright\" content=\"Fugess Design (c) 2008\" />
      <meta name=\"keywords\" content=\"fugess design, fugess, webdesign, fugessdesign, fugess webdesign\" />
      <meta name=\"description\" content=\"Weblog o mladém tvůrci webových prezentací\" />
      <meta name=\"robots\" content=\"index, follow\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/{$barva}_styles.css\" media=\"screen\" />
        <!--[if IE 7]>
          <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7_{$barva}.css\" media=\"screen\" />
        <![endif]-->
        <!--[if lte IE 6]>
          <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6_{$barva}.css\" media=\"screen\" />
        <![endif]-->
        <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
      <title>Fugess Design - Fugessova tvorba webdesignu - {$web->Title($kam)}</title>
    </head>
      <body>
        <div id=\"zahlavi\"><span id=\"prednacteni\"></span></div>
          <div id=\"obal\">
            <div id=\"levysloupec\">
              <div>
                <p>
                  <a href=\"?color=$barva{$web->odd}uvod\" title=\"Úvod\">Úvod</a>
                </p>
              </div>
              <div>
                <p>
                  <a href=\"?color=$barva{$web->odd}kontakt\" title=\"Kontakt\">Kontakt</a>
                </p>
              </div>
              <div>
                <p>
                  <a href=\"?color=$barva{$web->odd}reference\" title=\"Reference\">Reference</a>
                </p>
              </div>
              <div>
                <p>
                  <a href=\"?color=$barva{$web->odd}webdesign\" title=\"Webdesign\">Webdesign</a>
                </p>
              </div>
              <p id=\"barvatext1\">Chcete jinou barvu ?</p>
              <p id=\"barvatext2\">Vyberte si !</p>
              {$web->MenuBarev($barva, $kam)}
            </div><!-- konec levy sloupec -->
            <div id=\"obsah\">";
							require $web->Stranka($kam);
							print "
						</div><!-- konec obsah -->
          </div><!-- konec obal -->
        <div id=\"zapati\">
          <p id=\"vygenerovani\">{$web->KonecCas()}</p>
          <div id=\"valid\">
            <p id=\"css\">
              <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS version 2.1 !\" rel=\"nofollow\">
                <img src=\"http://www.w3.org/Icons/valid-css2.png\" alt=\"Valid CSS version 2.1 !\" />
              </a>
            </p>
            <p id=\"xhtml\">
              <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict !\" rel=\"nofollow\">
                <img src=\"http://www.w3.org/Icons/valid-xhtml10.png\" alt=\"Valid XHTML 1.0 Strict !\" />
              </a>
            </p>
          </div>
        </div><!-- konec zapati -->
      </body>
  </html>";
}
?>
