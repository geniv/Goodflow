<?php
class TVypis
{
	var $start, $konec;
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
		$cas = Abs(((Round(($this->konec - $this->start) * $presnost)) / $presnost) * 1000); //výpočet
		return "$cas us"; 
	}
//******************************************************************************
	function VypisSlozky($cesta)
	{
		$i=$j=0;
		if (filetype($cesta) == "dir")
		{
			$handle = opendir($cesta);//$pol
			while($soub = readdir($handle))
			{
				if (filetype("$cesta/$soub") == "dir")//$pol
				{
					$adresar[$i] = $soub;	//načítání adresářů
					$i++;
				}
			}
			closedir($handle);
			sort($adresar);
			reset($adresar);
			return $adresar;
		}
	}
//******************************************************************************
	function VypisSouboru($cesta)
	{
		$i=$j=0;
		if (filetype($cesta) == "dir")
		{
			$handle = opendir($cesta);//$pol
			while($soub = readdir($handle))
			{
				if (filetype("$cesta/$soub") == "file")//$pol
				{
					$soubor[$j] = $soub;	//načítání souborů
					$j++;
				}
			}
			closedir($handle);
			sort($soubor);
			reset($soubor);
			return $soubor;
		}
	}
//******************************************************************************
	function VelikostSouboru($cesta)
	{
		if (file_exists($cesta))
		{
			$vel = filesize($cesta);
			if($vel >= 1048576)
			{
				$velikost = sprintf("%.2f MB", $vel / 1048576);
			}
				else
			if($vel >= 1024)
			{
				$velikost = sprintf("%.2f KB", $vel / 1024);
			}
				else
			{
				$velikost = sprintf("%.2f Bytes", $vel);
			}
			return $velikost;
		}	
	}
//******************************************************************************
	function FirstLetter($cesta)
	{
		$i=0;
		if (filetype($cesta) == "dir")
		{
			$handle = opendir($cesta);//$pol
			while($soub = readdir($handle))
			{
				if (filetype("$cesta/$soub") == "dir")//$pol
				{
					$adresar[$i] = $soub;	//načítání adresářů
					$i++;
				}
			}
			closedir($handle);
			sort($adresar);
			reset($adresar);
			
			for ($i = 0; $i < count($adresar); $i++)
			{
				$text = strtoupper($adresar[$i]);
				$adresar[$i] = $text[0];
			}
			sort($adresar);
			reset($adresar);
			//$adresar = array_unique($adresar);
			$j=0;
			for ($i = 0; $i < count($adresar); $i++)
			{
				if ($adresar[$i] != $adresar[$i + 1])
				{
					$pismena[$j] = $adresar[$i];
					$j++;
				}				
			}
			sort($pismena);
			reset($pismena);

			for ($i = 1; $i < count($pismena); $i++)
			{
				if ($i != (count($pismena) - 1))
				{
					$carka = ", ";
				}
					else
				{
					$carka = "";
				}
				$vypis .= "<a href=\"#{$pismena[$i]}\">{$pismena[$i]}</a>{$carka}";
			}

			return $vypis;
		}
	}
//******************************************************************************
	function Strom()
	{
		/*$i=$j=0;
		if (filetype($cesta) == "dir")
		{
			$handle = opendir($cesta);//$pol
			while($soub = readdir($handle))
			{
				if (filetype("$cesta/$soub") == "dir")//$pol
				{
					$adresar[$i] = $soub;	//načítání adresářů
					$i++;
				}
					else
				{
					$soubor[$j] = $soub;	//načítání souborů
					$j++;
				}
			}
			closedir($handle);	
		}
		
		$kor = ".";
		$j = 0;
		$adr = $this->VypisSlozky($kor);
		for ($i = 0; $i < count($adr); $i++)
		{
			if (filetype($adr[$i]) == "dir")
			{
				$adres[$j] = $this->VypisSlozky("$kor/$adr[$i]");
				for ($k = 0; $k < count($adres); $k++)
				{
					$vypis .= $adres[$k];
				}
				$j++;
			}
			$vypis .= $adr[$i];
		}
		
		return $vypis;*/
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

$vyp = new TVypis;
$vyp->StartCas();
	
	if (Empty($pol))
	{
		$pol = ".";
	}
	
	//$kore$n = ".";
	$i=$j=0;
	if (filetype($pol) == "dir")
	{
		$handle = opendir($pol);//$pol
		while($soub = readdir($handle))
		{
			if (filetype("$pol/$soub") == "dir")//$pol
			{
				$adresar[$i] = $soub;	//načítání adresářů
				$i++;
			}
				else
			{
				$soubor[$j] = $soub;	//načítání souborů
				$j++;
			}
		}
		closedir($handle);
		sort($adresar);
		reset($adresar);
		sort($soubor);
		reset($soubor);
	}
	
	$vypis =
	"{$vyp->Strom()}<br>
	(<a href=\"./\">home</a>)<br>
	{$vyp->FirstLetter(".")}<br>
	<table border=\"1\">
		<tr>
			<th>Name</th>
			<th>Size</th>
		</tr>";

	if (count($adresar) > 0)
	{
		for ($i = 1; $i < count($adresar); $i++)
		{
			$text = $adresar[$i];
			$vypis .=
			"<tr>
				<td colspan=\"2\"><a name=\"".strtoupper($text[0])."\"><a href=\"$pol/{$adresar[$i]}\" target=\"_blank\"><b>{$adresar[$i]}</b></a></td>
			</tr>";
		}
	}

	if (count($soubor) > 0)
	{
		for ($i = 0; $i < count($soubor); $i++)
		{
			$vypis .=
			"<tr>
				<td><a href=\"$pol/{$soubor[$i]}\" target=\"_blank\"><i>".wordwrap($soubor[$i], 80, "<br />", true)."</i></a></td>
				<td>{$vyp->VelikostSouboru("$pol/{$soubor[$i]}")}</td>
			</tr>";
		}
	}
	
	$vypis .=
	"</table>";
	
/*
	$vypis =
	"{$vyp->Strom()}<br>
	slozka (Velikost) (<a href=\"./\">home</a>)<br>
	{$vyp->FirstLetter($koren)}
	<ul>";

	if (count($adresar) > 0)
	{
		for ($i = 2; $i < count($adresar); $i++)
		{
			if ($pol == "$koren/{$adresar[$i]}")
			{
				$vypis .=	//1.uroveň adresář
				"<li><b>{$adresar[$i]}</b></li>
				<ol>";
				$vyp_dir = $vyp->VypisSlozky("$koren/{$adresar[$i]}");
				$vyp_adr = $vyp->VypisSouboru("$koren/{$adresar[$i]}");
				
				for ($j = 3; $j < count($vyp_dir); $j++)
				{
					$vypis .=	//1.uroveň adresář
					"<li>
						<a href=\"?pol=$pol/{$vyp_dir[$j]}\"><b>{$vyp_dir[$j]}</b></a>
					</li>";
				}

				for ($j = 0; $j < count($vyp_adr); $j++)
				{
					$vypis .=	//soubor
					"<li>
						<a href=\"$pol/{$vyp_adr[$j]}\" target=\"_blank\">
						<i>".wordwrap($vyp_adr[$j], 80, "<br />", true)."</i></a>
						({$vyp->VelikostSouboru("$pol/{$vyp_adr[$j]}")})
					</li>";
				}
				
				if (count($vyp_dir) == 0 && count($vyp_adr) == 0)
				{
					$vypis .= "<li>empty</li>";
				}
					
				$vypis .=
				"</ol>";
			}
				else
			{
				$text = $adresar[$i];
				$vypis .=	//0.uroveň adresář
				"<li>
					<a name=\"".strtoupper($text[0])."\"></a><a href=\"?pol=$koren/{$adresar[$i]}\"><b>{$adresar[$i]}</b></a>
				</li>";
			}
			
		}
	}

	if (count($soubor) > 0)
	{
		for ($i = 0; $i < count($soubor); $i++)
		{
			$vypis .=	//0.uroveň soubor
			"<li>
				<a href=\"$pol/{$soubor[$i]}\" target=\"_blank\">
				<i>".wordwrap($soubor[$i], 80, "<br />", true)."</i></a>
				({$vyp->VelikostSouboru("$koren/{$soubor[$i]}")})
			</li>";
		}
	}

	if (count($adresar) <= 2 || count($soubor) < 3)
	{
		$vypis .=
		"<tr>
		<th colspan=\"2\">Empty dir</th>
		</tr>";
	}
	
		$vypis .=
		"</ul>";
*/
		print "$vypis {$vyp->KonecCas()}";
?>