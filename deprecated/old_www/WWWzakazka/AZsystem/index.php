<?php
require "administrace/funkce.php";
print 
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"Fugess (Martin)\" />
    <meta name=\"copyright\" content=\"Fugess Desig (c) 2008\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles.css\" media=\"screen\" />
      <!--[if IE 7]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
      <![endif]-->
      <!--[if lte IE 6]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
      <![endif]-->
      <title>AZ System s.r.o. - Váš průvodce světem softwaru a hardwaru, webových aplikací a počítačového poradenství</title>
      <script type=\"text/javascript\">AC_FL_RunContent = 0;</script>
      <script src=\"AC_RunActiveContent.js\" type=\"text/javascript\"></script>
  </head>
    <body>";
/*
print_r($_GET);
print "<br>";
print_r($_POST);
print "<br>";
print_r($_ENV);
print "<br>";
print_r($_COOKIE);
print "<br>";
print $_GET[kam];
*/
  if (!Empty($_GET['d']))
  {
    $roz = explode(":", $_GET['d']);
  }

  if (!Empty($roz[1]))
  {
    $mezi = $roz[1]; //kam=reference
    $mezi1 = explode("=", $mezi); //[0]=>kam [1]=>reference
    $kam = $mezi1[1]; //kam <- mezi1[1]
  }

  if (!Empty($roz[0]))
  {
    if ($roz[0] == "false")
    {
      $hlava = FlashNormal();
    }
  }
    else
  {
    $hlava = FlashDefault();
  }

print "     <div id=\"zahlavi\">
              <div id=\"vlajky\">
                <p>
                  <em id=\"text_cze\">Česky</em>
                  <a href=\"#\" title=\"Česky\">
                    <img src=\"img/cze.png\" alt=\"Česky\" />
                  </a>
                </p>
                <p>
                  <em id=\"text_ska\">Slovensky</em>
                  <a href=\"#\" title=\"Slovensky\">
                    <img src=\"img/ska.png\" alt=\"Slovensky\" />
                  </a>
                </p>
                <p>
                  <em id=\"text_ger\">German</em>
                  <a href=\"#\" title=\"German\">
                    <img src=\"img/ger.png\" alt=\"German\" />
                  </a>
                </p>
                <p>
                  <em id=\"text_eng\">English</em>
                  <a href=\"#\" title=\"English\">
                    <img src=\"img/eng.png\" alt=\"English\" />
                  </a>
                </p>
              </div>
              $hlava
            </div>
            <div id=\"navigace\"></div>
            <div id=\"obal_pozadi\">
              <div id=\"obal\">
                <div id=\"menu\">
                  <div id=\"menu_vrsek\">
                    <div>
                      <form method=\"post\" action=\"\">
                        <fieldset>
                          <input type=\"text\" name=\"hledani\" id=\"hledani\" />
                          <input type=\"image\" src=\"img/hledej_button.png\" id=\"tl_hledat\" alt=\"Hledat\" />
                        </fieldset>
                      </form>
                    </div>
                      <p>
                        <img src=\"img/sipka_menu.gif\" alt=\"Tvorba WWW\" /><a href=\"index.php?d=false:kam=tvorba_www\" title=\"Tvorba WWW\" class=\"vrchni_menu\">Tvorba WWW</a>
                      </p>
                      <p>
                        <img src=\"img/sipka_menu.gif\" alt=\"Hosting a domény\" /><a href=\"index.php?d=false:kam=hosting_a_domeny\" title=\"Hosting a domény\" class=\"vrchni_menu\">Hosting a domény</a>
                      </p>
                      <p>
                        <img src=\"img/sipka_menu.gif\" alt=\"Grafická tvorba\" /><a href=\"index.php?d=false:kam=graficka_tvorba\" title=\"Grafická tvorba\" class=\"vrchni_menu\">Grafická tvorba</a>
                      </p>
                      <p>
                        <img src=\"img/sipka_menu.gif\" alt=\"Prezentace\" /><a href=\"index.php?d=false:kam=prezentace\" title=\"Prezentace\" class=\"vrchni_menu\">Prezentace</a>
                      </p>
                        <div id=\"obr_menu\">
                          <p>
                            <a href=\"index.php?d=false:kam=software\" title=\"Software\" id=\"software\"></a>
                          </p>
                          <p>
                            <a href=\"index.php?d=false:kam=hardware\" title=\"Hardware\" id=\"hardware\"></a>
                          </p>
                          <p>
                            <a href=\"index.php?d=false:kam=licencovani\" title=\"Licencování\" id=\"licencovani\"></a>
                          </p>
                          <p>
                            <a href=\"index.php?d=false:kam=it_poradenstvi\" title=\"IT Poradenství\" id=\"it_poradenstvi\"></a>
                          </p>
                        </div>
                  </div>
                  <div id=\"menu_prazdno\">
                    <p><img src=\"img/partneri_spoluprace.png\" alt=\"Partneři - Spolupráce\" /></p>
                    <p class=\"partneri\">
                      <a href=\"http://www.cdc.cz/\" title=\"CDC Data s.r.o.\"><img src=\"img/cdc_ikona.png\" alt=\"CDC Data s.r.o.\" /></a>
                      <a href=\"http://www.klenot.cz/\" title=\"Klenot.cz - domov pro Vaše stránky\"><img src=\"img/klenot_ikona.png\" alt=\"Klenot.cz - domov pro Vaše stránky\" /></a>
                    </p>
                    <p class=\"partneri\">
                      <a href=\"http://www.rybnikbalaton.cz/\" title=\"Rybářská bašta Rybník Balaton - pořádání akcí, ubytování, restaurace\"><img src=\"img/rybnik_ikona.png\" alt=\"Rybářská bašta Rybník Balaton - pořádání akcí, ubytování, restaurace\" /></a>
                      <a href=\"http://www.fugessdesign.own.cz\" title=\"Fugess Design - mladý tvůrce webových prezentací\"><img src=\"img/fugess_ikona.png\" alt=\"Fugess Design - mladý tvůrce webových prezentací\" /></a>
                    </p>
                    <p id=\"prihlaseni_zakaznika\">
                      <img src=\"img/prihlaseni_zakaznika.png\" alt=\"Přihlášení zákazníka\" />
                    </p>
                    <div id=\"menu_prazdno_prihlasovani\">
                      <form method=\"post\" action=\"\">
                        <fieldset id=\"prihlasovani_label\">
                          <label>Přihlašovací jméno:</label>
                            <input name=\"prihlaseni_login\" id=\"prihlaseni_login\" type=\"text\" />
                          <label>Heslo:</label>
                            <input name=\"prihlaseni_heslo\" id=\"prihlaseni_heslo\" type=\"text\" />
                            <input type=\"submit\" id=\"prihlasovani_prihlasit\" value=\"\" />
                            <input type=\"image\" src=\"img/registrace_button.png\" id=\"tl_registrace\" alt=\"Registrace\" />
                        </fieldset>
                      </form>
                    </div>
                  </div>
                </div>
                  <div id=\"obsah\">
                    ";
                      $default = "aktuality.php";
                      if (!Empty($kam)) //$_GET['kam']
                      {
                        if (file_exists("$kam.php"))
                        {
                          require "$kam.php";
                        }
                          else
                        {
                          require $default;
                        }
                      }
                        else
                      {
                        require $default;
                      }
            
                     print
                     "          </div>
              </div>
            </div>
            <div id=\"zapati\">
              <ul>
                <li><a href=\"http://asus.com/\" title=\"ASUSTeK Computer Inc.\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_02.png\" alt=\"ASUSTeK Computer Inc.\" /></a></li>
                <li><a href=\"http://t-mobile.com/\" title=\"T-Mobile Company\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_03.png\" alt=\"T-Mobile Company\" /></a></li>
                <li><a href=\"http://www.google.com/\" title=\"Google\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_04.png\" alt=\"Google\" /></a></li>
                <li><a href=\"http://www.citrix.com/\" title=\"Citrix Systems\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_05.png\" alt=\"Citrix Systems\" /></a></li>
                <li><a href=\"http://icq.com/\" title=\"ICQ\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_06.png\" alt=\"ICQ\" /></a></li>
                <li><a href=\"http://skype.com/\" title=\"Skype\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_07.png\" alt=\"Skype\" /></a></li>
                <li><a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict !\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_09.png\" alt=\"Valid XHTML 1.0 Strict !\" /></a></li>
                <li><a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS version 2.1 !\" rel=\"nofollow\"><img src=\"img/zapati_lista_loga_08.png\" alt=\"Valid CSS version 2.1 !\" /></a></li>
              </ul>
            </div>
    </body>
</html>";

?>
