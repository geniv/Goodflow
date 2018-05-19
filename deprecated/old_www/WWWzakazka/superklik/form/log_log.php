<?php
  return
  "  <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
          <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <meta http-equiv=\"Content-Language\" content=\"cs\" />
            <meta name=\"author\" content=\"Jurkix &amp; Geniv &amp; Fugess, (GF Design)\" />
            <meta name=\"copyright\" content=\"\" />
            <meta name=\"description\" content=\"\" />
            {$this->var->meta}
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles_uvod.css\" media=\"screen\" />
            <!--[if IE]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE 7]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
            <![endif]-->
            <!--[if lte IE 6]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE]>
              <script type=\"text/javascript\" src=\"script/script_flash.js\" defer=\"defer\"></script>
            <![endif]-->
            <title>{$title}</title>
          </head>
          <body id=\"uvod\">
            <h1>Superklik</h1>
            <div id=\"konstrukce_logo\"></div>
            <div id=\"konstrukce_preklad\"></div>
            <form id=\"prihlasovaci_form\" action=\"\" method=\"post\">
              <fieldset>
                <h2>přihlášení</h2> <!-- nahrada za legend -->
                <label for=\"login\">Login:</label>
                  <input id=\"login\" type=\"text\" name=\"jmeno\" />
                <label for=\"heslo\">Heslo:</label>
                  <input id=\"heslo\" type=\"password\" name=\"heslo\" />
                  <input id=\"prihlasit\" type=\"submit\" name=\"tlacitko\" value=\"Přihlásit se\" />
              </fieldset>
            </form>
            {$prih}
            {$this->var->chyba}

              <div id=\"flash_music\">
                <!--[if !IE]> -->
                  <object type=\"application/x-shockwave-flash\" data=\"{$web}/flash/music.swf\" width=\"50\" height=\"50\">
                <!-- <![endif]-->
                <!--[if IE]>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"50\" height=\"50\">
                    <param name=\"movie\" value=\"{$web}/flash/music.swf\" />
                <!--><!---->
                    <param name=\"loop\" value=\"true\" />
                    <param name=\"menu\" value=\"false\" />
                    <param name=\"bgcolor\" value=\"#000000\" />
                    <p id=\"no_flash\"></p>
                  </object>
                <!-- <![endif]-->
              </div>

          </body>
        </html>
  ";
?>

