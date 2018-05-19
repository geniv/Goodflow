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
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/global_styles.css\" media=\"screen\" />
            <!--[if IE]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
            <![endif]-->
            <!--[if IE 7]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
            <![endif]-->
            <!--[if lte IE 6]>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
            <![endif]-->
            <title>TSQM - ".(Empty($_GET["akce"]) ? "{$this->var->jazyk[$this->var->title[$this->var->kam][""]]}" : "{$this->var->jazyk[$this->var->title[$this->var->kam][""]]} - {$this->var->jazyk[$this->var->title[$this->var->kam][$_GET["akce"]]]}")."</title>
            <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
            <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
          </head>
          <body".($this->var->kam != "uvod" ? " class=\"odsazeni_left odsazeni_right\"" : "").">

            <div id=\"jazyk\" onmouseover=\"movein(this);\" onmouseout=\"moveout(this);\">
              <p id=\"jazykbar\">
                &raquo;
              </p>
                {$jazyk}
            </div>
            <script type=\"text/javascript\">
              make_menus();
            </script>

            <div class=\"preload\"></div>
            <div class=\"prihlasen_odhlasit\">
              <p>
                {$this->var->jazyk["uzivatel"]}: <strong>{$_COOKIE["TSQM_JMENO"]}</strong>
              </p>
              <p class=\"odhl\">
                <a href=\"?action=logoff\" title=\"{$this->var->jazyk["log_off_link"]}\">{$this->var->jazyk["log_off_link"]}</a>
              </p>
            </div>
              <p class=\"drobeckova_navigace\">{$this->var->main->DrobeckovaNavigace()}</p>
            <!-- uzivatel: [tvuj_login] -->
            {$prih} <!-- hlaska odhlaseno, prihlaseno, chyba - nahrazuje -->
            {$obsah} <!-- obsah -->
            {$this->var->loadingjazyk} <!-- loadimage - vyber jazyk -->
            {$this->var->chyba} <!-- globalni chyba -->

            <div class=\"vygenerovano_{$this->var->nowjazyk}\"> <!-- vygenerovano za -->
              <p>
                {$this->var->main->KonecCas()}
              </p>
            </div>

            <div class=\"zpatky_jedna_uroven".($this->var->kam == "uvod" ? " zpatky_jedna_uroven_uvod" : "")."\">
              <a href=\"javascript:history.back(-1);\" title=\"{$this->var->jazyk["zpet"]}\"></a>
            </div>

          </body>
        </html>
  ";//
?>
