<?php
	if (!Empty($_GET["action"]))
	{
		unlink($_GET["action"]);
		print "smazáno";
	}
?>
