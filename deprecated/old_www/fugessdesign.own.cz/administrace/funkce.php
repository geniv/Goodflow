<?
class TFugessDesign
{
	var $start, $konec; //definice proměnných
	var $odd = "-";
	var $bar = array("red", "violet", "purple", "blue", "green", "black"); //barvy stránek
//******************************************************************************	
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
		$presnost = 10000; //nastavená přesnost
		$cas = Abs(((Round(($this->konec - $this->start) * $presnost)) / $presnost) * 1000); //Abs, výpočet
		return "Stranka vygenerovana za: $cas &micro;s"; 
	}
//******************************************************************************
	function Title($kam) //dosazení hlavičky
	{
		$title = array("uvod" => "Úvod", "kontakt" => "Kontakt", "reference" => "Reference", "webdesign" => "Webdesign");
		return $title[$kam];
	}
//******************************************************************************
	function Adresa($cislo) //0=barva, 1=kam, vybrání adresy
	{
		if (!Empty($_GET["color"]))
		{
			$adr = $_GET["color"];
			$navrat = explode($this->odd, $adr); //rozsekání barvy
		}
		
		$poc = 0;
		for ($i = 0; $i < count($this->bar); $i++)
		{
		  if ($navrat[0] == $this->bar[$i])
		  {
				$poc++;
			}
		}	//end for
		
		if ($cislo == 0)
		{
			if ($poc == 1)	//barva stránky
			{
				return $navrat[0];	
			}
				else
			{
				return $this->bar[0];	//je-li blbě tak defaultně je 0.index
			}
		}
			else
		{
			if (!Empty($navrat[1]))	//adresa stránky
			{
				return $navrat[1];
			}
				else
			{
				return "uvod";
			}
		}
	}
//******************************************************************************
	function MenuBarev($barva,$kam) //obrázkové tlačítka
	{
		$navrat = "";
		if ($barva != $this->bar[0])
		{
			$navrat .=	"
	    <p>
	      <a href=\"?color={$this->bar[0]}{$this->odd}$kam\" title=\"Červená\">
	        <img src=\"obr/icon_{$this->bar[0]}.png\" alt=\"Červená\" />
	      </a>
			</p>";
		}
							
		if ($barva != $this->bar[1])
		{
			$navrat .=	"
			<p>
	    	<a href=\"?color={$this->bar[1]}{$this->odd}$kam\" title=\"Fialová\" rel=\"nofollow\">
	        <img src=\"obr/icon_{$this->bar[1]}.png\" alt=\"Fialová\" />
	      </a>
	    </p>";
	  }
	            
	  if ($barva != $this->bar[2])
		{
			$navrat .=	"
	    <p>
	  		<a href=\"?color={$this->bar[2]}{$this->odd}$kam\" title=\"Purpurová\" rel=\"nofollow\">
	    		<img src=\"obr/icon_{$this->bar[2]}.png\" alt=\"Purpurová\" />
	    	</a>
	    </p>";
	  }
	            
	  if ($barva != $this->bar[3])
		{
			$navrat .=	"
	    <p>
		    <a href=\"?color={$this->bar[3]}{$this->odd}$kam\" title=\"Modrá\" rel=\"nofollow\">
		    	<img src=\"obr/icon_{$this->bar[3]}.png\" alt=\"Modrá\" />
		    </a>
	    </p>";
	  }

		if ($barva != $this->bar[4])
		{
			$navrat .=	"
	    <p>
		    <a href=\"?color={$this->bar[4]}{$this->odd}$kam\" title=\"Zelená\" rel=\"nofollow\">
		    	<img src=\"obr/icon_{$this->bar[4]}.png\" alt=\"Zelená\" />
		    </a>
	    </p>";
	  }
	            
	  if ($barva != $this->bar[5])
		{
			$navrat .=	"
	    <p>
		    <a href=\"?color={$this->bar[5]}{$this->odd}$kam\" title=\"Černá\" rel=\"nofollow\">
		    	<img src=\"obr/icon_{$this->bar[5]}.png\" alt=\"Černá\" />
		    </a>
	    </p>";
	  }
		return $navrat;
	}
//******************************************************************************
	function Stranka($kam) //přepínán stránek
	{
		$default = "uvod.php";
	  if (!Empty($kam))
	  {
	    if (file_exists("$kam.php"))
	    {
	    	return "$kam.php";
	    }
	    	else
	    {
	      return $default;
	    }
	  }
	    else
	  {
	    return $default;
	  }
	}
//******************************************************************************
}