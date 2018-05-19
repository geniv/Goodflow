<?

// ------------------------------------------
// -- Script pro odeslání formuláøe mailem --
// --   (c) 2001 http://www.gpm.web4u.cz   --
// ------------------------------------------

/*
Povinné parametry:
	$komu		... adresa pøíjemce
	$email		... adresa odesílatele
	
Nepovinné parametry:
	$predmet	... pøedmìt mailu
	$nexturl	... stránka s podìkováním
	$backurl	... adresa stránky pro návrat
	$html		... Y/N - odeslat ve formátu HTML
	$soubor		... pøíloha mailu (pouze pro HTML formát)
	$@???		... povinné položky pro odeslání v mailu zaèínají znakem @
	$#???		... nepovinné položky pro odeslání v mailu zaèínají znakem #
*/

require("../inc/functions.php");
if ($html == "Y") include("../inc/class.html.mime.mail.inc");

if(count($_POST) > 0) {
	// kontrola, zda jsou vyplnìny povinné parametry
	if (!$komu) $errlist .= ", Komu";
	if (!$email) $errlist .= ", Email";
	while (list($promenna, $hodnota) = each($_POST)) {
		if ((substr($promenna, 0, 1) == "@") && ($hodnota == "")) 
			$errlist .= ", " . substr($promenna, 1);
	}
	
	// pokud nejsou vyplnìny povinné parametry
	if ($errlist) {
		echo "<font size=\"6\"><b>Chyba!</b></font>";
		echo "<p>Nejsou vyplnìny všechny požadované údaje:<br>";
    	echo "<b>".substr($errlist, 1)."</b></p>";
    	echo "<p><a href='javascript:history.go(-1)'>Zpìt</a></p>";
		exit;	// ukonèíme zpracování scriptu
  	}
	
	if ($html == "Y") {
		// pokud má být mail odeslán ve formátu HTML
		$telo = "<table>";
		$telo .= "<tr><td><font color=\"Red\"><b>Email:</b></font></td><td>&nbsp;</td><td>$email</td></tr>";
		reset($_POST);
		while (list($promenna, $hodnota) = each($_POST)) {
			// nahradíme konce øádkù tagem <br>
			$hodnota = str_replace(chr(13) . chr(10), "<br>", $hodnota);
			$hodnota = str_replace(chr(10) . chr(13), "<br>", $hodnota);
			$hodnota = str_replace(chr(13), "<br>", $hodnota);
			$hodnota = str_replace(chr(10), "<br>", $hodnota);
	
			// pokud parametr zaèíná na # nebo *, tak zapsat hodnotu do textu mailu
			if (((substr($promenna, 0, 1) == "@") || (substr($promenna, 0, 1) == "#")) && ($hodnota != "")) 
	    		{ $telo .= "<tr><td valign=\"top\"><b>".substr($promenna, 1).":</b></td><td>&nbsp;</td><td>$hodnota</td></tr>"; }
		}
		$telo .= "</table>";
		$telo .= "<p><hr></p>";
		$telo .= "<p><b>Uživatelùv browser:</b> $HTTP_USER_AGENT<br>";
		$telo .= "<b>IP adresa, ze které pøišel požadavek:</b> $REMOTE_ADDR</p>";
		

		$mail = new html_mime_mail("X-Mailer: Html Mime Mail Class");


		if ($soubor_name) {
		    if (copy ($soubor, "../temp/$soubor_name")) {
				$priloha = $mail->get_file("../temp/$soubor_name");
				$mail->add_attachment($priloha, $soubor_name, $soubor_type);
				unlink("../temp/$soubor_name");
		    }
		}
		
		// odešleme mail ve formátu HTML
	    $mail->add_html(ToISO($telo), "");
		$mail->set_charset('iso-8859-2', TRUE);
		$mail->build_message();
		$mail->send($komu, $komu, $email, $email, ToISO($predmet), "Return-Path: $email");
		
		$sendok = true;

		// odeslat potvrzení
		usleep(500);
		$mail->send($email, $email, $email, $email, ToISO("Potvrzení - vyplnìní formuláøe"), "Return-Path: $email");
	} else {
		$telo = "Email: $email\n";
	
		// projdeme všechny pøijaté parametry
		reset($_POST);
		while (list($promenna, $hodnota) = each($_POST)) {
			// nahradíme konce øádkù znakem \n
			$hodnota = str_replace(chr(13) . chr(10), "\n", $hodnota);
			$hodnota = str_replace(chr(10) . chr(13), "\n", $hodnota);
			$hodnota = str_replace(chr(13), "\n", $hodnota);
			$hodnota = str_replace(chr(10), "\n", $hodnota);
	
			// pokud parametr zaèíná na # nebo *, tak zapsat hodnotu do textu mailu
			if (((substr($promenna, 0, 1) == "@") || (substr($promenna, 0, 1) == "#")) && ($hodnota != "")) 
	    		{ $telo .= substr($promenna, 1) . ": $hodnota\n"; }
		}
	
		// necháme si poslat oznaèení uživatelova browsu a jeho IP
		$telo .= "\nUživatelùv browser: $HTTP_USER_AGENT\n";
		$telo .= "IP adresa, ze které pøišel požadavek: $REMOTE_ADDR\n";
		
		// odešleme mail funkcí mail()
		$sendok = mail($komu, ToISO($predmet), ToISO($telo), "From: $email\nReturn-Path: $email");

		// odeslat potvrzení
		usleep(500);
		mail($email, ToISO("Potvrzení - vyplnìní formuláøe"), ToISO($telo), "From: $email\nReturn-Path: $email");
	}
	
	// pokud byl mail odeslán v poøádku
	if ($sendok) {
		// pøesmìrujeme mail na stránku s podìkováním
		if ($nexturl != "")
	        { 
			echo "";
		} else {
			echo "<p>Vaše zpráva byla v poøádku odeslána.</p>";
		}
  	} else {
		// pokud nebyl mail odeslán
		echo "<font size=\"6\"><b>Chyba!</b></font>";
		echo "<p>Nìkterá ze služeb selhala. Zkuste to prosím pozdìji.<br>";
    	echo "V pøípadì potíží kontaktujte: <a href='mailto:$komu'>$komu</a></p>";
    	echo "<p><a href='javascript:history.go(-1)'>Zpìt</a></p>";
  	}
} else {
	// pokud byl script spuštìn bez parametrù
	echo "<font size=\"6\"><b>Chyba!</b></font>";

}

?>
