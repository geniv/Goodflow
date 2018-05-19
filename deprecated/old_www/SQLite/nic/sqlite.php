<?php
	header('Content-type: text/html; charset=UTF-8');
	
class SQLite
{
//******************************************************************************
	function RozdelCestu($cesta, $poradi)
	{
		$oddel = "-"; //zadaný oddělovač adresy
		$a = explode($oddel, $cesta); //rosekání adresy a vrácení žádaného výsledku
		return $a[$poradi];
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
}
//******************************************************************************
//******************************************************************************
//******************************************************************************
class DBSQLite extends SQLite //vnuk databáze
{
//******************************************************************************
	function Instalace($obj, $nazev)
	{
		if (!file_exists($nazev))
		{
			$obj->query("CREATE TABLE deklarace (iddeklarace INTEGER AUTO_INCREMENT PRIMARY KEY , nazev VARCHAR(100))");
			$obj->query("CREATE TABLE hodnota (iddeklarace INT, hodnota VARCHAR(50))");
		}
	}
//******************************************************************************
	function PridejDeklaraci($obj, $nazev)
	{
		$nav = $obj->query("INSERT INTO deklarace(nazev) VALUES ('$nazev')");
		if ($nav)
		{
			print "přidána deklarace $nazev <a href=\"sqlite.php\">klik</a>";
		}
			else
		{
			print "něco se posralo";
		}
	}
//******************************************************************************
	function UpravDeklaraci()
	{
	
	
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
	function VypisDB($obj, $dotaz)
	{
		$nav = $obj->query($dotaz);
		if ($nav)
		{
			$slo = $nav->numFields();	
			$poc = $nav->numRows();
			
			$vypis = "<table border=1>\n<tr>";
			for ($i = 0; $i < $slo; $i++)
			{
				$data = $nav->fieldName($i);
				$vypis .= "<th>{$data}</th>";
			}
			$vypis .= "</tr>";
			
			for ($i = 0; $i < $poc; $i++)
			{
				$data = $nav->fetch();
				$vypis .= "<tr>";
				for ($j = 0; $j < $slo; $j++)
				{
					$vypis .= "<td>{$data[$j]}</td>";
				}
				$vypis .= "</tr>";
			}
			$vypis .= "</table>";
		}
			else
		{
			$vypis = "prázdná tabulka";
		}
		
		
		return $vypis;
	}
//******************************************************************************
	function VypisDeklaraci($obj)
	{
		$nav = $obj->query("SELECT * FROM deklarace ORDER BY iddeklarace");
		$poc = $nav->numRows();
		
		if ($poc > 0)
		{
			$vypis = "<table border=\"1\">
								<tr>
									<th>id</th>
									<th>název</th>
								</tr>";
	
			for ($i = 0; $i < $poc; $i++)
			{
				$data = $nav->fetch();
				$vypis .= "<tr>
										<td>{$data["iddeklarace"]}</td>
										<td>{$data["nazev"]}</td>
									</tr>";
			}
			$vypis .= "</table>";
		}
			else
		{
			$vypis = "žádné deklarace";
		}
		
		
		return $vypis;
	}
//******************************************************************************
	function VypisDeklaraciEdit($obj)
	{
		$nav = $obj->query("SELECT * FROM deklarace ORDER BY iddeklarace");
		$poc = $nav->numRows();
		
		if ($poc > 0)
		{
			$vypis = "<table border=\"1\">
								<tr>
									<th>id</th>
									<th>název</th>
									<th>akce</th>
								</tr>";
	
			for ($i = 0; $i < $poc; $i++)
			{
				$data = $nav->fetch();
				$vypis .= "<tr>
										<td>{$data["iddeklarace"]}</td>
										<td>{$data["nazev"]}</td>
										<td><a href=\"?action=edit_dek-{$data["iddeklarace"]}\">upravit</a></td>
									</tr>";
			}
			$vypis .= "</table>";
		}
			else
		{
			$vypis = "žádné deklarace";
		}
		
		
		return $vypis;
	}
//******************************************************************************
	function VypisHodnot($obj)
	{
		
	}
//******************************************************************************
	function Sekce($obj)
	{
		if (!Empty($_GET["action"]))
		{
			$kam = $this->RozdelCestu($_GET["action"], 0);
		}
			else
		{
			$kam = "all";
		}
		
		switch($kam)
		{
			case "all":
				print $this->VypisDB($obj, "SELECT * FROM deklarace");
			break;
//******************************************************************************
		case "add_dek": //přidání deklarace
			print
				"<form method=\"POST\">
					<fieldset>
						deklarace<input type=\"text\" name=\"deklarace\"><br>
						<input type=\"submit\" value=\"Přidat\" name=\"tlacitko\">
					</fieldset>
				</form>";

				if (!Empty($_POST["tlacitko"]) && //připouštěcí podmínka
						!Empty($_POST["deklarace"]))
				{
					$this->PridejDeklaraci($dobj, $_POST["deklarace"]);
				}
			break;
//******************************************************************************
			case "edit_dek": //editace deklarace
				$id = $this->RozdelCestu($_GET["action"], 1);
				
				if(!Empty($id))
				{
					$p = $obj->query("SELECT * FROM deklarace WHERE iddeklarace=$id");
					$data = $p->fetchObject();
					//$data->iddeklarace;
					print $data->nazev;
					
				}
				
				/*
				print
					"<form method=\"POST\">
						<fieldset>
							deklarace<input type=\"text\" name=\"deklarace\"><br>
							<input type=\"submit\" value=\"Přidat\" name=\"tlacitko\">
						</fieldset>
					</form>";
					*/
				print $this->VypisDeklaraciEdit($obj);
			break;
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
			} //end switch
	
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
} //end class
	
	$databaze = "katalog.db"; //název DB
	$db = new SQLiteDatabase($databaze); //objetk
	$sql = new DBSQLite; //třída
	//$sql->Instalace($db, $databaze); //instalace tabulek

	print 
	"<a href=\"?action=all\">zobraz vše</a><br>
	<br>
	<a href=\"?action=add_dek\">přidej deklaraci</a><br>
	<a href=\"?action=edit_dek\">uprav deklaraci</a><br>
	<a href=\"?action=del_dek\">smaž deklaraci</a><br>
	<br>
	<a href=\"?action=add_hod\">přidej hodnotu</a><br>
	<a href=\"?action=edit_hod\">uprav hodnotu</a><br>
	<a href=\"?action=del_hod\">smaž hodnotu</a><br>
	<br>";

	$sql->Sekce($db);
	

?>
