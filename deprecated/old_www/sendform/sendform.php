<?

// ------------------------------------------
// -- Script pro odesl�n� formul��e mailem --
// --   (c) 2001 http://www.gpm.web4u.cz   --
// ------------------------------------------

/*
Povinn� parametry:
	$komu		... adresa p��jemce
	$email		... adresa odes�latele
	
Nepovinn� parametry:
	$predmet	... p�edm�t mailu
	$nexturl	... str�nka s pod�kov�n�m
	$backurl	... adresa str�nky pro n�vrat
	$html		... Y/N - odeslat ve form�tu HTML
	$soubor		... p��loha mailu (pouze pro HTML form�t)
	$@???		... povinn� polo�ky pro odesl�n� v mailu za��naj� znakem @
	$#???		... nepovinn� polo�ky pro odesl�n� v mailu za��naj� znakem #
*/

require("../inc/functions.php");
if ($html == "Y") include("../inc/class.html.mime.mail.inc");

if(count($_POST) > 0) {
	// kontrola, zda jsou vypln�ny povinn� parametry
	if (!$komu) $errlist .= ", Komu";
	if (!$email) $errlist .= ", Email";
	while (list($promenna, $hodnota) = each($_POST)) {
		if ((substr($promenna, 0, 1) == "@") && ($hodnota == "")) 
			$errlist .= ", " . substr($promenna, 1);
	}
	
	// pokud nejsou vypln�ny povinn� parametry
	if ($errlist) {
		echo "<font size=\"6\"><b>Chyba!</b></font>";
		echo "<p>Nejsou vypln�ny v�echny po�adovan� �daje:<br>";
    	echo "<b>".substr($errlist, 1)."</b></p>";
    	echo "<p><a href='javascript:history.go(-1)'>Zp�t</a></p>";
		exit;	// ukon��me zpracov�n� scriptu
  	}
	
	if ($html == "Y") {
		// pokud m� b�t mail odesl�n ve form�tu HTML
		$telo = "<table>";
		$telo .= "<tr><td><font color=\"Red\"><b>Email:</b></font></td><td>&nbsp;</td><td>$email</td></tr>";
		reset($_POST);
		while (list($promenna, $hodnota) = each($_POST)) {
			// nahrad�me konce ��dk� tagem <br>
			$hodnota = str_replace(chr(13) . chr(10), "<br>", $hodnota);
			$hodnota = str_replace(chr(10) . chr(13), "<br>", $hodnota);
			$hodnota = str_replace(chr(13), "<br>", $hodnota);
			$hodnota = str_replace(chr(10), "<br>", $hodnota);
	
			// pokud parametr za��n� na # nebo *, tak zapsat hodnotu do textu mailu
			if (((substr($promenna, 0, 1) == "@") || (substr($promenna, 0, 1) == "#")) && ($hodnota != "")) 
	    		{ $telo .= "<tr><td valign=\"top\"><b>".substr($promenna, 1).":</b></td><td>&nbsp;</td><td>$hodnota</td></tr>"; }
		}
		$telo .= "</table>";
		$telo .= "<p><hr></p>";
		$telo .= "<p><b>U�ivatel�v browser:</b> $HTTP_USER_AGENT<br>";
		$telo .= "<b>IP adresa, ze kter� p�i�el po�adavek:</b> $REMOTE_ADDR</p>";
		

		$mail = new html_mime_mail("X-Mailer: Html Mime Mail Class");


		if ($soubor_name) {
		    if (copy ($soubor, "../temp/$soubor_name")) {
				$priloha = $mail->get_file("../temp/$soubor_name");
				$mail->add_attachment($priloha, $soubor_name, $soubor_type);
				unlink("../temp/$soubor_name");
		    }
		}
		
		// ode�leme mail ve form�tu HTML
	    $mail->add_html(ToISO($telo), "");
		$mail->set_charset('iso-8859-2', TRUE);
		$mail->build_message();
		$mail->send($komu, $komu, $email, $email, ToISO($predmet), "Return-Path: $email");
		
		$sendok = true;

		// odeslat potvrzen�
		usleep(500);
		$mail->send($email, $email, $email, $email, ToISO("Potvrzen� - vypln�n� formul��e"), "Return-Path: $email");
	} else {
		$telo = "Email: $email\n";
	
		// projdeme v�echny p�ijat� parametry
		reset($_POST);
		while (list($promenna, $hodnota) = each($_POST)) {
			// nahrad�me konce ��dk� znakem \n
			$hodnota = str_replace(chr(13) . chr(10), "\n", $hodnota);
			$hodnota = str_replace(chr(10) . chr(13), "\n", $hodnota);
			$hodnota = str_replace(chr(13), "\n", $hodnota);
			$hodnota = str_replace(chr(10), "\n", $hodnota);
	
			// pokud parametr za��n� na # nebo *, tak zapsat hodnotu do textu mailu
			if (((substr($promenna, 0, 1) == "@") || (substr($promenna, 0, 1) == "#")) && ($hodnota != "")) 
	    		{ $telo .= substr($promenna, 1) . ": $hodnota\n"; }
		}
	
		// nech�me si poslat ozna�en� u�ivatelova browsu a jeho IP
		$telo .= "\nU�ivatel�v browser: $HTTP_USER_AGENT\n";
		$telo .= "IP adresa, ze kter� p�i�el po�adavek: $REMOTE_ADDR\n";
		
		// ode�leme mail funkc� mail()
		$sendok = mail($komu, ToISO($predmet), ToISO($telo), "From: $email\nReturn-Path: $email");

		// odeslat potvrzen�
		usleep(500);
		mail($email, ToISO("Potvrzen� - vypln�n� formul��e"), ToISO($telo), "From: $email\nReturn-Path: $email");
	}
	
	// pokud byl mail odesl�n v po��dku
	if ($sendok) {
		// p�esm�rujeme mail na str�nku s pod�kov�n�m
		if ($nexturl != "")
	        { 
			echo "";
		} else {
			echo "<p>Va�e zpr�va byla v po��dku odesl�na.</p>";
		}
  	} else {
		// pokud nebyl mail odesl�n
		echo "<font size=\"6\"><b>Chyba!</b></font>";
		echo "<p>N�kter� ze slu�eb selhala. Zkuste to pros�m pozd�ji.<br>";
    	echo "V p��pad� pot�� kontaktujte: <a href='mailto:$komu'>$komu</a></p>";
    	echo "<p><a href='javascript:history.go(-1)'>Zp�t</a></p>";
  	}
} else {
	// pokud byl script spu�t�n bez parametr�
	echo "<font size=\"6\"><b>Chyba!</b></font>";

}

?>
