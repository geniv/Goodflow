<?php
include_once "promenne.php";
include_once "funkce.php";

class GFDesignUpload
{
  public $var;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->main = new Funkce($this->var);

    $this->var->main->StartCas();
    $this->var->main->AddVstup();
    $this->var->main->KontrolaExpiraceUctu(); //kontroluje expiraci souboru

    if (!Empty($_POST["jmeno"]) && !Empty($_POST["heslo"])) //přihlášení
    {
      $kont = $this->var->main->KontrolaLogin(md5(md5($_POST["jmeno"])), md5(md5($_POST["heslo"])));
      $this->var->main->AddLog($_POST["jmeno"], $_POST["heslo"], $kont); //zaloguje pristup

      if ($kont) //heslo správně
      { //správně
        SetCookie("UPLOAD_JMENO", md5(md5($_POST["jmeno"])), Time() + 31536000); //zápis do cookie
        SetCookie("UPLOAD_HESLO", md5(md5($_POST["heslo"])), Time() + 31536000);
        $prih = "
                  <div id=\"nacitani_central_fixni\" title=\"Byl jsi přihlášen\">
                    <p>
                      Byl jsi přihlášen
                    </p>
                  </div>
                ";  //vkládají se
        $this->var->main->AutoClick(2, "./");  //auto kliknuti
      }
        else
      { //špatne
        $prih =
        "
          <div id=\"nacitani_central_fixni\" title=\"Zadal jsi špatné údaje\">
            <p>
              Zadal jsi špatné údaje
            </p>
          </div>
        "; //vkládají se, heslo špatně
        $this->var->main->AutoClick(3, "./");  //auto kliknuti
      }
    }

    if(!Empty($_GET["action"]) && $_GET["action"] == "logoff")  //odhlášení
    {
      SetCookie("UPLOAD_JMENO", "", 0); //vymazání cookie
      SetCookie("UPLOAD_HESLO", "", 0);
      $prih = "
                <div id=\"nacitani_central_fixni\" title=\"Byl jsi odhlášen\">
                  <p>
                    Byl jsi odhlášen
                  </p>
                </div>
              "; //vkládají se
      $this->var->main->AutoClick(2, "./");  //auto kliknuti
    }

    if (!Empty($_COOKIE["UPLOAD_JMENO"]) && !Empty($_COOKIE["UPLOAD_HESLO"]) && $this->var->main->KontrolaLogin($_COOKIE["UPLOAD_JMENO"], $_COOKIE["UPLOAD_HESLO"]))
    {
      $menu = $this->var->main->Menu();
      $obsah = $this->var->main->ObsahStranky();  //vypis obsahu stranek

      if ($this->var->main->Pristup())  //rozdeleni stranek podle pristupu
      {
        $this->var->main->AddEditStat();  //statistika pohybu
        $this->var->main->IpLog();  //statistika IP

        $zaplneno = $this->var->main->CurrentPercentSizeSpace($this->var->iduser, $this->var->prostor); //% zaplneno
        $zbyva = 100 - $zaplneno;

        $zaplnenomega = $this->var->main->CurrentSizeSpace($this->var->iduser, true); //MB zaplneno
        $maxmega = $this->var->prostor * 1024 * 1024;
        $zbyvamega = $maxmega - $zaplnenomega;

        $pocitadlo = $this->var->main->WebCount();
        $online = $this->var->main->OnlineUser();
        $listselstyl = $this->var->main->ListingSelectedStyle($stylhlaska);

        $result =
        "{$this->var->main->ChangeHeader()}
  <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
    <head>
      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
      <meta http-equiv=\"Content-Language\" content=\"cs\" />
      <meta name=\"author\" content=\"Geniv &amp; Fugess (GF Design)\" />
      <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz)\" />
      <meta name=\"keywords\" content=\"upload by GF Design, Upload GF Design, Upload GFDesign, GF Design upload, GFDesign upload\" />
      <meta name=\"description\" content=\"Upload by GF Design\" />
      <meta name=\"robots\" content=\"index, follow\" />
      {$this->var->meta}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"ajax.php?action=css&amp;style={$this->var->style}\" media=\"screen\" />
      <!--[if IE]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
      <![endif]-->
      <!--[if IE 7]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
      <![endif]-->
      <!--[if lte IE 6]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
      <![endif]-->
      <title>Upload by GF Design - {$this->var->stranka[$this->var->kam]}</title>
      <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
      <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
      <!--[if lte IE 6]>
        <script type=\"text/javascript\" src=\"script/detect.js\"></script>
      <![endif]-->
      <script type=\"text/javascript\">
        Rozliseni('".session_id()."');
      </script>
    </head>
    <body>
      <div id=\"obal_layout\">
      <span class=\"preload_01 preloader\"></span>
      <span class=\"preload_02 preloader\"></span>
      <span class=\"preload_03 preloader\"></span>
      <span class=\"preload_04 preloader\"></span>
      <span class=\"preload_05 preloader\"></span>
      <span class=\"preload_06 preloader\"></span>
      <span class=\"preload_07 preloader\"></span>
      <span class=\"preload_08 preloader\"></span>
      <span class=\"preload_09 preloader\"></span>
      <span class=\"preload_10 preloader\"></span>
      <span class=\"preload_11 preloader\"></span>
        <div id=\"zahlavi\">
          <div id=\"nadpis_zahlavi\"></div>
          <h1>Upload by GF Design</h1>
          <div id=\"informace_zahlavi\">
            <p>
              <a href=\"./\" title=\"Úvodní stránka\">
                <span class=\"prava_{$this->var->pravo}\"></span> {$this->var->jmeno}
              </a>
            </p>
          </div>
          <div id=\"informace_2_zahlavi\">
            <dl>
              <dt>
                Tvůj login:
              </dt>
              <dd>
                {$this->var->jmeno}
              </dd>
            </dl>
            <dl>
              <dt>
                Tvé práva:
              </dt>
              <dd>
                {$this->var->prava[$this->var->pravo]}
              </dd>
            </dl>
            <dl>
              <dt>
                Máš k dispozici:
              </dt>
              <dd>
                {$this->var->main->Velikost($this->var->prostor * 1024 * 1024)}
              </dd>
            </dl>
            <dl>
              <dt>
                Máš zaplněno:
              </dt>
              <dd>
                {$this->var->main->Velikost($zaplnenomega)} ({$zaplneno}%)
              </dd>
            </dl>
            <dl>
              <dt>
                Zbývá místa:
              </dt>
              <dd>
                {$this->var->main->Velikost($zbyvamega)} ({$zbyva}%)
              </dd>
            </dl>
            <dl>
              <dt>
                Účet vytvořen:
              </dt>
              <dd>
                {$this->var->vytvoreno}
              </dd>
            </dl>
            ".($this->var->expiraceucet != 0 ? "
            <dl>
              <dt>
                Do smazání účtu zbývá:
              </dt>
              <dd>
                {$this->var->main->VyslovnostDnuZbyva($this->var->main->ZbyvaDni($this->var->vytvoreno, $this->var->expiraceucet))}
              </dd>
            </dl>
            " : "")."
            <dl>
              <dt>
                Doba existence Tvého účtu:
              </dt>
              <dd>
                {$this->var->main->VyslovnostDnu($this->var->expiraceucet)}
              </dd>
            </dl>
            <dl>
              <dt>
                Doba existence Tvých souborů:
              </dt>
              <dd>
                {$this->var->main->VyslovnostDnu($this->var->expirace)}
              </dd>
            </dl>
            <dl>
              <dt>
                Zvolený styl vzhledu:
              </dt>
              <dd>
                {$this->var->main->VypisNazevStylu($this->var->style)}
              </dd>
            </dl>
          </div>
          <div id=\"progressbar_misto\">
            <p>{$zaplneno}% ".($this->var->prostor >= 100 && $this->var->prostor <= 199 ? "ze" : "z")." {$this->var->main->Velikost($this->var->prostor * 1024 * 1024)}</p>
            <div>
              <span style=\"width: {$zaplneno}%;\"></span>
            </div>
          </div>
          <div id=\"menu_zahlavi\">
            {$menu}
          </div>
        </div>
        <div id=\"obal_obsah\" class=\"prihlasen_sekce\">
          <p id=\"drobeckova_navigace\">
            <span></span>
            {$this->var->main->DrobeckovaNavigace()}
            <em></em>
          </p>
          <div id=\"download_zip\"></div>
          {$obsah}
          {$prih}
          {$this->var->chyba}
          {$stylhlaska}
        </div>
        <div id=\"zapati\">
          {$listselstyl}
          <p id=\"cas_vygenerovani\">
            {$this->var->main->KonecCas()}
          </p>
          <div id=\"obal_flex_textu_zapati\">
            <p id=\"bylo_dohromady_lidi\">
              <em>Na stránkách bylo dohromady: {$pocitadlo} lidí</em>
              <span>Počet přístupů: {$pocitadlo} | </span>
            </p>
            <p id=\"aktualne_je_online\">
              <em>Aktuálně je online: {$online}</em>
              <span>Online: {$online}</span>
            </p>
          </div>
          ".($this->var->pravo == 1 ? "
          <p id=\"polozka_administrace_stylu_zapati\">
            <a href=\"?action=style\" class=\"polozka_administrace_stylu".(Empty($_GET["action"]) ? "" : ($_GET["action"] == "style" ? " aktivni" : ""))."\" title=\"{$this->var->stranka["style"]}\">
            <span class=\"".(Empty($_GET["action"]) ? "aktivni" : ($this->var->orientace[$_GET["action"]] == "style" ? "aktivni" : "neaktivni"))."\"></span>
            {$this->var->stranka["style"]}</a>
          </p>
          " : "")."
          <p id=\"autor\">
          <em></em>
            <span>Created by GF Design, Copyright &copy; Fugess &amp; Geniv<span> &amp; Jurkix</span></span>
          <em id=\"konec_autor\"></em>
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
      <meta name=\"author\" content=\"Geniv &amp; Fugess (GF Design)\" />
      <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz)\" />
      <meta name=\"keywords\" content=\"upload by GF Design, Upload GF Design, Upload GFDesign, GF Design upload, GFDesign upload\" />
      <meta name=\"description\" content=\"Upload by GF Design\" />
      <meta name=\"robots\" content=\"index, follow\" />
      {$this->var->meta}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"ajax.php?action=css&amp;style={$this->var->style}\" media=\"screen\" />
      <!--[if IE]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
      <![endif]-->
      <!--[if IE 7]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
      <![endif]-->
      <!--[if lte IE 6]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
      <![endif]-->
      <title>Upload by GF Design</title>
      <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
      <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
      <!--[if lte IE 6]>
        <script type=\"text/javascript\" src=\"script/detect.js\"></script>
      <![endif]-->
      <script type=\"text/javascript\">
        Rozliseni('".session_id()."');
      </script>
    </head>
    <body>
      <div id=\"obal_layout\">
        <div id=\"zahlavi\">
          <div id=\"nadpis_zahlavi\"></div>
          <h1>Upload by GF Design</h1>
          <div id=\"informace_zahlavi\">
            <p>
              <a href=\"./\" title=\"Úvodní stránka\">
                <span class=\"prava_{$this->var->pravo}\"></span> {$this->var->jmeno}
              </a>
            </p>
          </div>
          <div id=\"informace_2_zahlavi\">
            <dl>
              <dt>
                Tvůj login:
              </dt>
              <dd>
                {$this->var->jmeno}
              </dd>
            </dl>
            <dl>
              <dt>
                Tvé práva:
              </dt>
              <dd>
                {$this->var->prava[$this->var->pravo]}
              </dd>
            </dl>
            <dl>
              <dt>
                Máš k dispozici:
              </dt>
              <dd>
                {$this->var->prostor} MB
              </dd>
            </dl>
            <dl>
              <dt>
                Účet vytvořen:
              </dt>
              <dd>
                {$this->var->vytvoreno}
              </dd>
            </dl>
            ".($this->var->expiraceucet != 0 ? "
            <dl>
              <dt>
                Do smazání účtu zbývá:
              </dt>
              <dd>
                {$this->var->main->VyslovnostDnuZbyva($this->var->main->ZbyvaDni($this->var->vytvoreno, $this->var->expiraceucet))}
              </dd>
            </dl>
            " : "")."
            <dl>
              <dt>
                Doba existence Tvého účtu:
              </dt>
              <dd>
                {$this->var->main->VyslovnostDnu($this->var->expiraceucet)}
              </dd>
            </dl>
            <dl>
              <dt>
                Doba existence Tvých souborů:
              </dt>
              <dd>
                {$this->var->main->VyslovnostDnu($this->var->expirace)}
              </dd>
            </dl>
            <dl>
              <dt>
                Zvolený styl vzhledu:
              </dt>
              <dd>
                {$this->var->style}
              </dd>
            </dl>
          </div>
          <div id=\"menu_zahlavi\">
            {$menu}
          </div>
        </div>
        <div id=\"obal_obsah\" class=\"prihlasen_sekce\">
          <div id=\"nepovoleny_pristup\">
            <span class=\"vlevo_obrazek\"></span>
            <p>
              Nemáte oprávnění pro vstup do této sekce !
            </p>
            <span class=\"vpravo_obrazek\"></span>
          </div>
          {$prih}
          {$this->var->chyba}
        </div>
        <div id=\"zapati\">
          <p id=\"cas_vygenerovani\">
            {$this->var->main->KonecCas()}
          </p>
          <div id=\"obal_flex_textu_zapati\">
            <p id=\"bylo_dohromady_lidi\">
              <em>Na stránkách bylo dohromady: {$pocitadlo} lidí</em>
              <span>Počet přístupů: {$pocitadlo} | </span>
            </p>
            <p id=\"aktualne_je_online\">
              <em>Aktuálně je online: {$online}</em>
              <span>Online: {$online}</span>
            </p>
          </div>
          <p id=\"autor\">
          <em></em>
            <span>Created by GF Design, Copyright &copy; Fugess &amp; Geniv<span> &amp; Jurkix</span></span>
          <em id=\"konec_autor\"></em>
          </p>
        </div>
      </div>
    </body>
  </html>";

      }
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
      <meta name=\"author\" content=\"Geniv &amp; Fugess (GF Design)\" />
      <meta name=\"copyright\" content=\"Created by GFdesign (info@gfdesign.cz)\" />
      <meta name=\"keywords\" content=\"upload by GF Design, Upload GF Design, Upload GFDesign, GF Design upload, GFDesign upload\" />
      <meta name=\"description\" content=\"Upload by GF Design\" />
      <meta name=\"robots\" content=\"index, follow\" />
      {$this->var->meta}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"ajax.php?action=css&amp;style={$this->var->style}\" media=\"screen\" />
      <!--[if IE]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE.css\" media=\"screen\" />
      <![endif]-->
      <!--[if IE 7]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE7.css\" media=\"screen\" />
      <![endif]-->
      <!--[if lte IE 6]>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"styles/styles_IE6.css\" media=\"screen\" />
      <![endif]-->
      <title>Upload by GF Design</title>
      <link rel=\"shortcut icon\" href=\"obr/favicon.ico\" />
      <script type=\"text/javascript\" src=\"script/funkce.js\"></script>
      <!--[if lte IE 6]>
        <script type=\"text/javascript\" src=\"script/detect.js\"></script>
      <![endif]-->
      <script type=\"text/javascript\">
        Rozliseni('".session_id()."');
      </script>
    </head>
    <body id=\"prihlasovani_orange\">
      <div id=\"obal_layout\">
        <div id=\"zahlavi\">
          <div id=\"nadpis_zahlavi\"></div>
          <h1>Upload by GF Design</h1>
        </div>
        <div id=\"obal_obsah\" class=\"logovani_uvod\">
          <form method=\"post\" action=\"\"".(!Empty($_POST["tlacitko"]) ? " style=\"display: none;\"" : "").">
            <fieldset>
              <dl>
                <dt>
                  <label for=\"login\">Login:</label>
                </dt>
                <dd>
                  <input id=\"login\" type=\"text\" name=\"jmeno\" value=\"\" onblur=\"if(this.value=='')this.value='Login';\" onfocus=\"if(this.value=='Login')this.value='';\" />
                </dd>
                <dt>
                  <label for=\"heslo\">Heslo:</label>
                </dt>
                <dd>
                  <input id=\"heslo\" type=\"password\" name=\"heslo\" value=\"\" onblur=\"if(this.value=='')this.value='Heslo';if(this.value=='Heslo')this.type='text';\" onfocus=\"if(this.value=='Heslo')this.value='';this.type='password';\" />
                </dd>
                <dd>
                  <input id=\"prihlasit\" name=\"tlacitko\" type=\"submit\" value=\"Přihlásit se\" title=\"Přihlásit se\" />
                </dd>
              </dl>
            </fieldset>
          </form>
          {$prih}
          {$this->var->chyba}
        </div>
        <div id=\"zapati\">
          <div id=\"obal_flex_textu_zapati\">
            <p id=\"bylo_dohromady_lidi_logovani\">
              <span></span>
              <abbr title=\"Valid XHTML 1.0 Strict &amp; Valid CSS 2.1\">
                Valid <a href=\"http://validator.w3.org/check?uri=referer\" title=\"Valid XHTML 1.0 Strict\" rel=\"nofollow\">XHTML 1.0 Strict</a> &amp; <a href=\"http://jigsaw.w3.org/css-validator/check/referer\" title=\"Valid CSS 2.1\" rel=\"nofollow\">CSS 2.1</a>
              </abbr>
            </p>
          </div>
          <p id=\"autor\">
          <em></em>
            <span>Created by GF Design, Copyright &copy; Fugess &amp; Geniv<span> &amp; Jurkix</span></span>
          <em id=\"konec_autor\"></em>
          </p>
        </div>
      </div>
    </body>
  </html>";

    }

    echo $result;
  }
//******************************************************************************
}

$web = new GFDesignUpload();
?>
