<?php

$host = "localhost"; //localhost		127.0.0.1
$username = "root";	//root		gfdesign-cz
$password = "geniv"; //Samsung		geniv		rfLIvu0sV
$databaze = "katalog"; //katalog		gfdesign-cz
$port = NULL;	//NULL		3305

	$mysqli = @new mysqli($host, $username, $password, $databaze, $port);
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