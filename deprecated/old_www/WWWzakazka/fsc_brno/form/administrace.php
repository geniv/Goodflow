<?php
  $aktuality = $this->var->main->VypisAktualitTop5();
  if (!Empty($_POST["login"]) && !Empty($_POST["heslo"]))
	{
		if ($this->KontrolaLogin(md5(md5($_POST["login"])), md5(md5($_POST["heslo"]))))
		{
			SetCookie("FSC_JMENO", md5(md5($_POST["login"])), Time() + 31536000); //zápis do cookie
	    SetCookie("FSC_HESLO", md5(md5($_POST["heslo"])), Time() + 31536000);
	    $this->AutoClick(1, "?action=administrace");
	    $prih =
	    "
      <div class=\"odhlaseno_prihlaseno\">
        <p>
          Byl jsi přihlášen.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action=administrace\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
			else
		{
			$prih =
			"
	    <div class=\"odhlaseno_prihlaseno\">
        <p>
          Zadal jsi špatné loginy.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action=administrace\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
      ";
		}
	}

	if (!Empty($_GET["akce"]) && $_GET["akce"] == "logoff")
	{
		SetCookie("FSC_JMENO", "", 0); //vymazání cookie
		SetCookie("FSC_HESLO", "", 0);
		$this->AutoClick(1, "?action=administrace");
		$prih =
		"
	    <div class=\"odhlaseno_prihlaseno\">
        <p>
          Byl jsi odhlášen.
        </p>
        <p>
          Pokračuj klapnutím <a href=\"?action=administrace\" title=\"Pokračuj klapnutím zde\">zde</a>.
        </p>
      </div>
    ";
	}

	if (!Empty($_COOKIE["FSC_JMENO"]) &&
			!Empty($_COOKIE["FSC_HESLO"]) &&
			$this->KontrolaLogin($_COOKIE["FSC_JMENO"], $_COOKIE["FSC_HESLO"]) &&
			$_GET["akce"] != "logoff")
	{
		$menuadmin = $this->MenuAdmin();
		$obsahadmin = $this->ObsahAdmin();
		return
		"
		{$menuadmin}
  <div id=\"obsah_admin\">
    {$obsahadmin}
  </div>
  <div class=\"neobtekat\"></div>
		";
	}
		else
	{
  return
  "
<div id=\"bocni_sloupec\">
  <div id=\"aktuality\">
    <p>
      <a href=\"#\" onclick=\"AjaxStranka('aktuality', '');\" title=\"\">
        <span>
          AKTUALITY
        </span>
      </a>
    </p>
  </div>
  {$aktuality}

  <div id=\"sponzori\">
    <p>
      <a href=\"#\" onclick=\"AjaxStranka('sponzori', '');\" title=\"\">
        <span>
          SPONZOŘI
        </span>
      </a>
    </p>
  </div>
  <div id=\"sponzori_text\">
    <p>
      <a href=\"http://www.vsktechnika.cz/\" title=\"VSK Technika Brno\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_001.png\" alt=\"VSK Technika Brno\" />
      </a>
      <a href=\"http://www.jaso.cz/\" title=\"JASO - e-shop\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_003.png\" alt=\"JASO - e-shop\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.kores-praha.cz/\" title=\"Kores - lepicí tyčinky, lepidla, korekční pásky, poznámkové bločky, Ink jety\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_004.png\" alt=\"Kores - lepicí tyčinky, lepidla, korekční pásky, poznámkové bločky, Ink jety\" />
      </a>
      <a href=\"http://www.hokejovahalabrno.cz/\" title=\"Hokejová hala dětí a mládeže v Brně\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_002.png\" alt=\"Hokejová hala dětí a mládeže v Brně\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.bmcbrno.cz/\" title=\"Exkluzivní zastoupení výrobců | BMC Brno\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_005.png\" alt=\"Exkluzivní zastoupení výrobců | BMC Brno\" />
      </a>
      <a href=\"http://www.bomaso.cz/\" title=\"Bomaso, a.s.\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_006.png\" alt=\"Bomaso, a.s.\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.al-plast.net/\" title=\"AL plast s.r.o\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_007.png\" alt=\"AL plast s.r.o\" />
      </a>
      <a href=\"http://www.auxiliateam.cz/\" title=\"Auxilia team – Bruslení na umělém ledě, Apartmány Flamenco\" class=\"right mirny_posun\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_008.png\" alt=\"Auxilia team – Bruslení na umělém ledě, Apartmány Flamenco\" />
      </a>
      <a href=\"http://www.reklamnicokolady.cz/\" title=\"Chocogastro, s.r.o.\" class=\"right mirny_posun\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_017.png\" alt=\"Chocogastro, s.r.o.\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.bernard.cz/\" title=\"Bernard - rodinný pivovar\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_009.png\" alt=\"Bernard - rodinný pivovar\" />
      </a>
      <a href=\"http://www.hkonicek.cz/\" title=\"Hotel Koníček - ubytování Uherské Hradiště, hotel Uherské Hradiště\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_010.png\" alt=\"Hotel Koníček - ubytování Uherské Hradiště, hotel Uherské Hradiště\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.saunabrno.cz/\" title=\"Sauna FAVORIT, Brno\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_011.png\" alt=\"Sauna FAVORIT, Brno\" />
      </a>
      <a href=\"http://www.hummel.dk/\" title=\"hummel International - Company\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_012.png\" alt=\"hummel International - Company\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.kovokon.cz/\" title=\"KOVOKON Popovice s.r.o.\" class=\"left posun\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_013.png\" alt=\"KOVOKON Popovice s.r.o.\" />
      </a>
      <a href=\"http://www.podaneruce.cz/\" title=\"Sdružení Podané ruce, o.s. - prevence a léčba drogové závislosti\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_014.png\" alt=\"Sdružení Podané ruce, o.s. - prevence a léčba drogové závislosti\" />
      </a>
    </p>
    <p>
      <a href=\"http://www.radka-rene.com\" title=\"Radka &amp; Rene\" class=\"left\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_015.png\" alt=\"Radka &amp; Rene\" />
      </a>
      <a href=\"#\" title=\"Lošťák\" class=\"right\" onclick=\"window.open(this.href); return false;\">
        <img src=\"obr/loga/logo_016.png\" alt=\"Lošťák\" />
      </a>
    </p>
  </div>
</div>
<div id=\"obsah\">
  <div id=\"hledani_obsah\">
    <p id=\"hledani_datum\">
      Dnes je: ".date("d.m.Y")."
    </p>
    <div id=\"forma_hledani\">
      <form action=\"\">
        <fieldset>
          <legend>Hledání výrazu</legend>
          <label for=\"hledani_label_input\">Hledání výrazu</label>
            <input id=\"hledani_label_input\" type=\"text\" name=\"jmeno\" value=\"Hledaný výraz ...\" onfocus=\"if(this.value == 'Hledaný výraz ...'){this.value=''}\" onblur=\"if(this.value == ''){this.value='Hledaný výraz ...'}\" />
            <input id=\"tl_odeslat\" type=\"button\" value=\"&nbsp;\" name=\"tlacitko\" />
        </fieldset>
      </form>
    </div>
  </div>


<div id=\"administrace_log\">
<span class=\"klic_01\"></span>
<span class=\"klic_02\"></span>
  <form method=\"post\" action=\"\">
    <fieldset>
    <legend>Administrace - Přihlašovací formulář</legend>
    <h2>Administrace - Přihlašovací formulář</h2>
      <label for=\"login_label_input\">Přihlašovací JMÉNO: </label>
        <input id=\"login_label_input\" type=\"text\" name=\"login\" />
      <label for=\"heslo_label_input\">Přihlašovací HESLO: </label>
        <input id=\"heslo_label_input\" type=\"password\" name=\"heslo\" />
      <input id=\"tl_odeslat_admin\" type=\"submit\" value=\"Přihlášení\" name=\"tlacitko\" />
    </fieldset>
  </form>
</div>

</div>
<div class=\"neobtekat\"></div>
{$prih}
  ";
  }
?>
