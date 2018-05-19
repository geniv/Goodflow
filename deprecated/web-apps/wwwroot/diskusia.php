<?php

    if(!require_once("./config.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 701</div>"); exit();} else{}

    if(!require_once("./functions.php")) {print("<div align=\"center\"><br /><br /><br />Chyba 702</div>"); exit();} else {}

    pconnect_mysql($host, $user, $password, $db);
    
    // akcie
    
    if($_POST["action"] == "Odoslať") {
		
		if($_POST["meno"] == "") { print("<br /><br /><div align=\"center\">Nevyplnili ste meno!</div>"); exit(); } else {}
        if($_POST["mail"] == "") { print("<br /><br /><div align=\"center\">Nevyplnili ste mail!</div>"); exit(); } else {}
        if($_POST["text"] == "") { print("<br /><br /><div align=\"center\">Nevyplnili ste text!</div>"); exit(); } else {}
		
        $meno = htmlspecialchars(trim($_POST["meno"]), ENT_QUOTES);
        $mail = htmlspecialchars(trim($_POST["mail"]), ENT_QUOTES);
        $text = addslashes(trim($_POST["text"]));
        $date = date("Y-m-d H:i:s");
        $project = addslashes(trim($_POST["project"]));
        
        // os a browser start
        include_once("./files/Browser.php");
        $browser = new Browser();
        
        // Windows (Browser::PLATFORM_WINDOWS)
        // Windows CE (Browser::PLATFORM_WINDOWS_CE)
        // Apple (Browser::PLATFORM_APPLE)
        // Linux (Browser::PLATFORM_LINUX)
        // OS/2 (Browser::PLATFORM_OS2)
        // BeOS (Browser::PLATFORM_BEOS)
        // iPhone (Browser::PLATFORM_IPHONE)
        // iPod (Browser::PLATFORM_IPOD)
        
        $os = "nezname";
        switch($browser->getPlatform()) {
        	   case Browser::PLATFORM_WINDOWS:
                $os = "windows";
                break;
            case Browser::PLATFORM_WINDOWS_CE:
                $os = "windows";
                break;
            case Browser::PLATFORM_APPLE:
                $os = "mac";
                break;
            case Browser::PLATFORM_LINUX:
                $os = "linux";
                break;
            case Browser::PLATFORM_OS2:
                $os = "os2";
                break;
            case Browser::PLATFORM_BEOS:
                $os = "beos";
                break;
            case Browser::PLATFORM_IPHONE:
                $os = "iphone";
                break;
            case Browser::PLATFORM_IPOD:
                $os = "ipod";
                break;
        }
        
        // Opera (Browser::BROWSER_OPERA)
        // WebTV (Browser::BROWSER_WEBTV)
        // NetPositive (Browser::BROWSER_NETPOSITIVE)
        // Internet Explorer (Browser::BROWSER_IE)
        // Pocket Internet Explorer (Browser::BROWSER_POCKET_IE)
        // Galeon (Browser::BROWSER_GALEON)
        // Konqueror (Browser::BROWSER_KONQUEROR)
        // iCab (Browser::BROWSER_ICAB)
        // OmniWeb (Browser::BROWSER_OMNIWEB)
        // Phoenix (Browser::BROWSER_PHOENIX)
        // Firebird (Browser::BROWSER_FIREBIRD)
        // Firefox (Browser::BROWSER_FIREFOX)
        // Mozilla (Browser::BROWSER_MOZILLA)
        // Amaya (Browser::BROWSER_AMAYA)
        // Lynx (Browser::BROWSER_LYNX)
        // Safari (Browser::BROWSER_SAFARI)
        // iPhone (Browser::BROWSER_IPHONE)
        // iPod (Browser::BROWSER_IPOD)
        // Googles Android(Browser::BROWSER_ANDROID)
        // Googles Chrome(Browser::BROWSER_CHROME)
        // GoogleBot(Browser::BROWSER_GOOGLEBOT)
        // Yahoo!s Slurp(Browser::BROWSER_SLURP)
        // W3Cs Validator(Browser::BROWSER_W3CVALIDATOR)

        $brows = "nezname";
        switch($browser->getBrowser()) {
        	   case Browser::BROWSER_FIREFOX:
                $brows = "mozilla";
                break;
            case Browser::BROWSER_OPERA:
                $brows = "opera";
                break;
            case Browser::BROWSER_IE:
                $brows = "msie";
                break;
            case Browser::BROWSER_KONQUEROR:
                $brows = "konqueror";
                break;
            case Browser::BROWSER_SAFARI:
                $brows = "safari";
                break;
            case Browser::BROWSER_ANDROID:
                $brows = "android";
                break;
            case Browser::BROWSER_CHROME:
                $brows = "chrome";
                break;
        }
        
        // os a browser koniec
        
        $expire = time() + 60 * 60 * 24 * 30;
        @setcookie("diskusia_meno", $_POST["meno"], $expire);
        @setcookie("diskusia_mail", $_POST["mail"], $expire);
        
        mysql_query(" INSERT INTO projects_diskusia (name, mail, content, ip, os, browser, date, project) VALUES('$meno', '$mail', '$text', '$ip', '$os', '$brows', '$date', '$project') ") or die("<div align=\"center\"><br /><br /><br />Chyba 703</div>");
        print("<div align=\"center\">Správa odoslaná úspešne. <a href=\"index.php\" target=\"_self\">Pokračovať</a></div>");
    }
    
    mysql_close();

?>
