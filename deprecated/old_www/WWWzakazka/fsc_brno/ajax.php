<?php
  include_once "promenne.php";
  include_once "funkce.php";
  include_once "login.php";

class Ajax
{
  public $var, $fun, $action, $akce;
  public $jmeno, $prijmeni, $ulice, $mesto, $psc, $telefon, $email, $text;  //promenne pro napiste nam
  public $zprava; //pro forum
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login();  //vytvoření objektu login
    $this->var->main = new Hlavni($this->var);

    $this->fun = $_GET["fun"];  //natazeni promennych
    $this->action = $_GET["action"];
    $this->akce = $_GET["akce"];

    $this->jmeno = $_GET["jmeno"];
    $this->prijmeni = $_GET["prijmeni"];
    $this->ulice = $_GET["ulice"];
    $this->mesto = $_GET["mesto"];
    $this->psc = $_GET["psc"];
    $this->telefon = $_GET["telefon"];
    $this->email = $_GET["email"];
    $this->text = $_GET["text"];

    $this->zprava = $_GET["zprava"];

		$this->var->main->StartCas();
    if ($con = $this->var->main->OtevriMySQLi())//$this->var,$this->login$this->var,
    {
      $this->var->main->InstalaceMySQLi();//$this->var, $this->login
		  $result = $this->VolbaFunkce(); //hlavni vypisovaci fukce
		  $this->var->main->ZavriMySQLi(); //uzávěr databáze
    }
      else
    {
      $result =
      "
        {$this->var->chyba}
      ";
    }
    
    echo $result;
  }
//******************************************************************************
  function VolbaFunkce()
  {
    switch($this->fun)
    {
      //************************************************************************
      case "web": //webova stranka
        $result = $this->Stranka();  //vykresleni stranky
      break;
      //************************************************************************
      case "napis": //napiste nam
        if (!Empty($this->jmeno) &&
            !Empty($this->prijmeni) &&
            !Empty($this->telefon) &&
            !Empty($this->email) &&
            $this->email != "@" &&
            !Empty($this->text))
        {
          $result = $this->var->main->PridejNapis($this->jmeno, $this->prijmeni, $this->ulice, $this->mesto, $this->psc, $this->telefon, $this->email, $this->text);
        }
          else
        {
          $result =
          "
          <div class=\"nedostatek_udaju\"></div>
          {$this->var->chyba}
          ";
        }
      break;
      //************************************************************************
      case "forum": //forum
        if (!Empty($this->jmeno) &&
            !Empty($this->email) &&
            $this->email != "@" &&
            !Empty($this->zprava))
        {
          $result = $this->var->main->PridejForum($this->jmeno, $this->email, $this->zprava);  //pridani fora
        }
          else
        {
          $result =
          "
          <div class=\"nedostatek_udaju\"></div>
          {$this->var->chyba}
          ";
        }
      break;
      //************************************************************************
      case "search": //webove hledani
        if (!Empty($this->text) && $this->text != "Hledaný výraz ...")
        {
          $result =
          "{$this->var->main->Hledej($this->text)}
          {$this->var->chyba}";
        }
      break;
      //************************************************************************
    }

    return $result;
  }
//******************************************************************************
  function Stranka()
  {
    $aktuality = $this->var->main->VypisAktualitTop5();
    $obsah = $this->var->main->ObsahStrakny();

    $result =
    "
<div id=\"mesg_search\"></div>
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
      <a href=\"\" title=\"Lošťák\" class=\"right\" onclick=\"window.open(this.href); return false;\">
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
      <form action=\"\" onsubmit=\"return false;\" method=\"get\">
        <fieldset>
          <legend>Hledání výrazu</legend>
          <label for=\"hledani_label_input\">Hledání výrazu</label>
            <input id=\"hledani_label_input\" type=\"text\" name=\"jmeno\" value=\"Hledaný výraz ...\" onfocus=\"if(this.value == 'Hledaný výraz ...'){this.value=''}\" onblur=\"if(this.value == ''){this.value='Hledaný výraz ...'}\" onkeydown=\"Enter(event, 'tl_odeslat_hledej');\" />
            <input id=\"tl_odeslat_hledej\" type=\"button\" value=\"&nbsp;\" name=\"tlacitko\" onclick=\"AjaxHledani(document.getElementById('hledani_label_input').value);\" />
        </fieldset>
      </form>
    </div>
  </div>
  {$this->var->chyba}
  {$obsah}

<!--
  {$this->var->main->KonecCas()}
-->
</div>

    ";

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

$web = new Ajax();
?>
