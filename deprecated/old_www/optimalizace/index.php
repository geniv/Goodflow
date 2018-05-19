<?
require "administrace/funkce.php";

if(!Empty($jmeno) and !Empty($heslo) and LoginAdmin($jmeno,$heslo,"administrace")=="true")
{
  SetCookie("AD_jmeno",$jmeno,Time()+31536000);
  SetCookie("AD_heslo",$heslo,Time()+31536000);
}
  else
{
  if(!Empty($kam) and $kam=="admin")
  {
    SetCookie("AD_jmeno","");
    SetCookie("AD_heslo","");
  }//end kam==admin
}

print 
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
	\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\" />
      <!--[if lte IE 6]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"fuck_IE6.css\" media=\"screen\" />
      <![endif]-->
      <!--[if IE 7]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"fuck_IE7.css\" media=\"screen\" />
      <![endif]-->
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" media=\"screen\" />
      <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
    <title>Krumlov Trainz - Železniční Fotogalerie</title>
  </head>
    <body>
      <div id=\"hlavicka\"></div>
        <div id=\"obal\">
          <div id=\"menu\">
            <div id=\"vybergalerie\">
              <p>
                <a href=\"index.php?kam=galerie_vyber\"></a>
              </p>
            </div>
            <div id=\"odkazy\">
              <p>
                <a href=\"index.php?kam=odkazy\"></a>
              </p>
            </div>
            <div id=\"admin\">
              <p>
                <a href=\"index.php?kam=admin\"></a>
              </p>
            </div>
            <div id=\"spodekmenu\"><a href=\"index.php?kam=tabulka\">tabulka</a></div>
          </div>
          <div id=\"obsah\">
                ";
                  $default = "galerie_vyber.php";
                  if (!Empty($kam))
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
    </body>
</html>";

?>
