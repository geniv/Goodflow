<?php

$host = "127.0.0.1"; //localhost		127.0.0.1:3305
$username = "gfdesign-cz";	//root		gfdesign-cz
$password = "rfLIvu0sV"; //Samsung		geniv		rfLIvu0sV
$databaze = "gfdesign-cz"; //katalog		gfdesign-cz
$port = "3305";

	$mysqli = @new mysqli($host, $uziv, $heslo, $databaze,NULL,$port,NULL);
	print "chyba: ".mysqli_connect_errno()."<br/>";
	if (!mysqli_connect_errno())
	{
		print "<b>ok</b><br/>";
		
		$res = $mysqli->query("SHOW DATABASES");
		while ($data = $res->fetch_object())
		{
			print "$data->Database<br />";
		}
	}
		else
	{
		print mysqli_connect_error();
	}	
	
	$mysqli->close();
?>
