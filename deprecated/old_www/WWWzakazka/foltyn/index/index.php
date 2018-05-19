<?php
$sum = 0;
$pris = "false";
$poches = 14;
$zob = 0;
$redy = "true"; 
$heslo = array
         (1 => 
				  'K-452-14', 
				  '2',
					'3',
					'4',
					'5',
					'6',
					'7',
					'8',
					'9',
					'10',
					'11',
					'12',
					'13',
					'14');		

	if (!Empty($send) && !Empty($pasw))
	{
	  $poc = $_POST["pocit"] + 1;
	  if ($heslo[$poc - 1] == $_POST["pasw"])
		{
			$sum = $_POST["suma"] + 5;
			$redy = "true";
		}
			else
		{
			print 
			"<head>
      <meta http-equiv=\"refresh\" content=\"1;URL=JavaScript:history.back();\">
      </head>"; //heslo zadáno špatnì <a href=\"JavaScript:history.back();\">z5</a>
			$redy = "false";
		}
	}
		else
	{
		$poc = $_POST["pocit"];
		$redy = "true";
	}
	
		
	if (Empty($poc))
	{
	  $poc = 1;
	}

	if ($sum == ($poches * 5))
	{
		$pris = "true";
	}
		else
	{
		$pris = "false";
	}

	if ($pris == "true")
	{
		require "new.html";
  	//print "Všech $poches hesel je zadáno správnì!"; 
	}
		else
	{
				  if ($redy == "true")
			{
				print //{$heslo[$poc]}
					"<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\" />
</head>
<body background='./login.jpg' text='white'>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					
					
					<div align=\"center\">Kód èíšlo: $poc</div>
					 <form method=\"post\" align=\"center\">
						<label for=\"hes\">Heslo:</label>
						<input type=\"password\" id=\"hes\" name=\"pasw\" value=\"{$heslo[$poc]}\">
						<input type=\"submit\" name=\"send\" value=\"Ovìøit\">
						<input type=\"hidden\" name=\"pocit\" value=\"$poc\">
						<input type=\"hidden\" name=\"suma\" value=\"$sum\">
					</form>";
				}
		//}
	}
	echo"</body>";
?>

