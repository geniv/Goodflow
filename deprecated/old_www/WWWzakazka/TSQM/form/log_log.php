<?php
  return
  "
      <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
        \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
        <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
          <head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
            <meta http-equiv=\"Content-Language\" content=\"cs\" />
            <meta name=\"author\" content=\"Geniv &amp; Fugess\" />
            <meta name=\"copyright\" content=\"created by GFdesign (info@gfdesign.cz)\" />
            <meta name=\"keywords\" content=\"\" />
            <meta name=\"description\" content=\"TSQM\" />
            <meta name=\"robots\" content=\"noindex, nofollow\" />
            {$this->var->meta}
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles_log.css\" media=\"screen\" />
            <!--[if IE]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE 7]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
            <![endif]-->
            <!--[if lte IE 6]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
            <![endif]-->
            <title>TSQM - {$this->var->jazyk["log_form"]}</title>
            <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
          </head>
          <body>
            <div id=\"logo_uvod\">
              <h1>TSQM</h1>
            </div>
            <form action=\"\" method=\"post\">
              <fieldset>
                <h2>{$this->var->jazyk["log_form"]}</h2> <!-- nahrada za legend -->
                <label for=\"login\">{$this->var->jazyk["log_log"]}:</label>
                  <input id=\"login\" type=\"text\" name=\"jmeno\" />
                <label for=\"heslo\">{$this->var->jazyk["log_hes"]}:</label>
                  <input id=\"heslo\" type=\"password\" name=\"heslo\" />
                <input id=\"prihlasit\" type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["log_prihl"]}\" />
              </fieldset>
            </form>
            <div class=\"preload preload_2\"></div>
            $prih
            {$this->var->chyba}
          </body>
        </html>
  ";
?>
