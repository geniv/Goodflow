<?php
$sum = 0;
$pris = false;
$kon = false; 
$poches = 14;
$zob = 0;
$redy = true; 
$heslo = array
         (1 => 
				  'heslo1', 
				  'heslo2',
					'heslo3',
					'heslo4',
					'heslo5',
					'heslo6',
					'heslo7',
					'heslo8',
					'heslo9',
					'heslo10',
					'heslo11',
					'heslo12',
					'heslo13',
					'heslo14');	

	if (!Empty($send) && !Empty($pasw))
	{
	  $poc = $_POST["pocit"] + 1;
	  if ($heslo[$poc - 1] == $_POST["pasw"])
		{
			$sum = $_POST["suma"] + 5;
			$redy = true;
		}
			else
		{
			print 
			"<head>
      <meta http-equiv=\"refresh\" content=\"1;URL=JavaScript:history.back();\">
      </head>"; //heslo zadáno špatnì <a href=\"JavaScript:history.back();\">z5</a>
			$redy = false;
		}
	}
		else
	{
		$poc = $_POST["pocit"];
		$redy = true;
	}
	
	//print $heslo[$poc - 1].", zadané: ".$_POST["pasw"].", suma: ".$_POST["suma"];
	
	if (Empty($poc))
	{
	  $poc = 1;
	}

	if ($sum == ($poches * 5))
	{
		$pris = true;
	}
		else
	{
		$pris = false;
	}

	if ($pris == true)
	{
		print 
			"<head>
      <meta http-equiv=\"refresh\" content=\"1;URL=index.php\">
      </head>";
		//require "rozvrh.htm"; //budou data v POST!
		//print "Všech $poches hesel je zadáno správnì!";
	}
		else
	{
		if ($poc == ($poches + 1))
		{
			print "Nìkteré ze $poches hesel je zadáno špatnì! <a href=\"./\">z5</a>";
		}
			else
		{
		  if ($redy == true)
			{
				print //{$heslo[$poc]}
				"<fieldset>
					<legend>Heslo $poc</legend>
					<form method=\"post\">
						<label for=\"hes\">Heslo:</label>
						<input type=\"password\" id=\"hes\" name=\"pasw\" value=\"{$heslo[$poc]}\"><br>
						<input type=\"submit\" name=\"send\" value=\"Ovìøit\">
						<input type=\"hidden\" name=\"pocit\" value=\"$poc\">
						<input type=\"hidden\" name=\"suma\" value=\"$sum\">
					</form>
				</fieldset>";
			}
		}
	}
?>
