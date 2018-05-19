<?php
class Funkce
{
  public $var;
//******************************************************************************
  function __construct(&$var) //konstruktor
  {
    $this->var = $var;

    //$this->Instalace();
  }
//******************************************************************************
  function Menu() //menu stranek
  {
    $result =
    "
    <a href=\"?action=uvod\" title=\"\">uvod</a>
    <a href=\"?action=odkaz\" title=\"\">odkaz</a>
    ";

    return $result;
  }
//******************************************************************************
  function ObsahStranky() //obsah stranky
  {
    $kam = $_GET["action"];

    if (!Empty($kam))
    {
      if (file_exists("{$kam}.php"))
      {
        $this->var->kam = $kam;
        $result = include_once "{$this->var->kam}.php";
      }
	       else
      {
        $this->var->kam = $this->var->default;
        $result = include_once "{$this->var->kam}.php";
      }
    }
      else
   {
     $this->var->kam = $this->var->default;
     $result = include_once "{$this->var->kam}.php";
   }

     return $result;
  }
//******************************************************************************
  function OdkazZ5($zpet = 1) //vracec historie
  {
    $result = "<a href=\"javascript:history.back(-{$zpet});\">zpet</a>";

    return $result;
  }
//******************************************************************************
  function EmptyLine()  //prazdne pole
  {
    $result = "<strong>žádný výběr</strong>";

    return $result;
  }
//******************************************************************************
  function ErrorMsg($chyba)  //proecdura chybove hlasky
  {
    $this->var->chyba = 
    "
         <div class=\"pozice_nastaveni_polozek chyba_odsazeni\">
          <div class=\"pozadi_top_razeni_katal\"></div>
           <div class=\"pozadi_obal_razeni_katal uprava_pro_chybu\">
             <p>
                Vyskytla se chyba:
              </p>
              <p class=\"chyba\">
                <cite>$chyba</cite>
                {$this->OdkazZ5()}
              </p>
              <span class=\"chyba_obrazek_vlevo\"></span>
              <span class=\"chyba_obrazek_vpravo\"></span>
           </div>
         <div class=\"pozadi_bottom_razeni_katal odsazeni_zespodu\"></div>
        </div>";
  }
//******************************************************************************
	function AutoClick($cas, $cesta)	//auto kliknuti, procedura
	{
		$this->var->meta = "<meta http-equiv=\"refresh\" content=\"{$cas};URL={$cesta}\" />";
	}
//******************************************************************************
  function Instalace()  //instalace databaze
  {

  }
//******************************************************************************
	public $start, $konec;
	function MeritCas() //funkce pro vrácení času
	{
	  $cas = explode(" ", microtime());
		$soucet = $cas[1] + $cas[0];

		return $soucet;
	}
//******************************************************************************
	function StartCas() //zapis začátku
	{
		$this->start = $this->MeritCas();
	}
//******************************************************************************
	function KonecCas() //zápis konce a finální vypis doby
	{
		$this->konec = $this->MeritCas();
		$cas = Abs(Round(($this->konec - $this->start) * 10000) / 10000); //Abs, výpočet

		return "vygenerováno za: {$cas} s";
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}
?>
