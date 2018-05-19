<?php
  $znaky = (!Empty($_POST["tlacitko"]) ? $_POST["znaky"] : "%%");
  $od = (!Empty($_POST["tlacitko"]) ? $_POST["od"] : 1);
  $do = (!Empty($_POST["tlacitko"]) ? $_POST["do"] : 100);
  echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" content=\"cs\" />
    <meta name=\"author\" content=\"GF design - Tvorba webových stránek a systémů (www.gfdesign.cz)\" />
    <meta name=\"copyright\" content=\"Created by GF design\" />
    <meta name=\"description\" content=\"Generátor procent apod.\" />
    <meta name=\"robots\" content=\"index, follow\" />
      <link rel=\"stylesheet\" type=\"text/css\" href=\"procento_gen.css\" media=\"screen\" title=\"Generátor procent apod.\" />
    <title>Generátor procent apod.</title>
  </head>
  <body>
  <form method=\"post\" action=\"\">
    <fieldset>
      <label>
        <span>Procento, nebo jiný znak:</span>
        <input type=\"text\" name=\"znaky\" value=\"{$znaky}\" />
      </label>
      <label>
        <span>Počítat od:</span>
        <input type=\"text\" name=\"od\" value=\"{$od}\" />
      </label>
      <label>
        <span>Počítat do:</span>
        <input type=\"text\" name=\"do\" value=\"{$do}\" />
      </label>
      <input type=\"submit\" name=\"tlacitko\" value=\"Vygenerovat\" id=\"odeslat\" />
    </fieldset>
  </form>
  <div id=\"vypis\">\n";

  for ($i = $od; $i <= $do; $i++)
  {
    echo "    {$znaky}{$i}{$znaky}<br />\n";
  }
  echo "  </div>
  </body>
</html>";
?>
