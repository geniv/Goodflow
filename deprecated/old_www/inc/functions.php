<?
// --------------------------------------
// --   Knihovna univerzálních funkcí  --
// -- (c) 2001 http://www.gpm.web4u.cz --
// --------------------------------------

// funkce na otestování, zda se jedná o zadání správného emailu
function IsEmail ($text) {
  	$text = strtolower($text);
  	/* for ($i=1; $i<=strlen($text); $i++)
  	{
    	if (strpos("abcdefghijklmnopqrstuvwxyz0123456789@.-_", substr($text, $i, 1)) === false)
    	{
			return false;
    	}
  	} */
	if (strlen($text) < 6)
	{
    	return false;
  	}
	if (strpos($text, "@") != strrpos($text, "@"))
	{
    	return false;
  	}
	if ((strpos($text, "@") < 1) || (strpos($text, "@") > (strlen($text) - 4)))
	{
    	return false;
  	}
	if (strrpos($text, ".") < strpos($text, "@"))
	{
    	return false;
  	}
	if (((strlen($text) - strrpos($text, ".") - 1) < 2) || ((strlen($text) - strrpos($text, ".") - 1) > 3))
	{
    	return false;
  	}
	return true;
} 

// pøevod znakové sady win-1250 na iso
function ToISO ($text) {
	$iso = "µ¾®»«¹©¥";
	$win = "¾šŠ¼";


	for ($i=1; $i<=strlen($win); $i++)
  	{
    	$text = str_replace(substr($win,$i-1,1), substr($iso,$i-1,1), $text);
  	}
  	return $text;
}

// náhrada funkce str_repeat
function StrRepeat ($text, $num) {
	for ($i=1; $i<=$num; $i++) { $temp = $temp . $text; }
	return $temp;
} 

// funkce mysql_query s vıpisem pøípadné chyby
function MySqlQuery ($query) {
	$sql_result = mysql_query($query);
	if (!$sql_result) {
		echo "<p><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><font color=\"Red\"><b>MySQL Error</b></font> - ";
		echo mysql_errno().": ".mysql_error()."</font></p>";
	}
	return $sql_result;
} 

// pøevod do kódování MIME
function ToMIME ($text) {
	for ($i=1; $i<=strlen($text); $i++)
	{
    	if (ord(substr($text,$i-1,1)) == 61)
	    {
	    	$temp = $temp . "=3D";
		}
	    elseif (ord(substr($text,$i-1,1)) < 128)
	    {
			$temp = $temp . substr($text,$i-1,1);
	    }
		else
	    {
			$temp = $temp . "=" . substr(dechex(ord(substr($text,$i-1,1))), strlen(dechex(ord(substr($text,$i-1,1)))) - 2);
	    }
	} 
	return $temp;
}

// vrátí time +/- Den,Mìsíc,Rok
function ConvertDate ($mounth, $day, $year) {
	$temp  = mktime (0,0,0,date("m")+$mounth  ,date("d")+$day,date("Y")+$year);
	return $temp;
}

//  Vrátí název, verzi a platformu
function detect_browser() 
{ 
	global $HTTP_USER_AGENT, $BName, $BVersion, $BPlatform; 
	
	// Browser 
	if(eregi("(opera) ([0-9]{1,2}.[0-9]{1,3}){0,1}",$HTTP_USER_AGENT,$match) || eregi("(opera/)([0-9]{1,2}.[0-9]{1,3}){0,1}",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "Opera"; $BVersion=$match[2]; 
	} 
	elseif(eregi("(konqueror)/([0-9]{1,2}.[0-9]{1,3})",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "Konqueror"; $BVersion=$match[2]; 
	} 
	elseif(eregi("(lynx)/([0-9]{1,2}.[0-9]{1,2}.[0-9]{1,2})",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "Lynx "; $BVersion=$match[2]; 
	} 
	elseif(eregi("(links) \(([0-9]{1,2}.[0-9]{1,3})",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "Links "; $BVersion=$match[2]; 
	} 
	elseif(eregi("(msie) ([0-9]{1,2}.[0-9]{1,3})",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "MSIE "; $BVersion=$match[2]; 
	} 
	elseif(eregi("(netscape6)/(6.[0-9]{1,3})",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "Netscape "; $BVersion=$match[2]; 
	} 
	elseif(eregi("mozilla/5",$HTTP_USER_AGENT)) 
	{ 
	$BName = "Netscape"; $BVersion="Unknown"; 
	} 
	elseif(eregi("(mozilla)/([0-9]{1,2}.[0-9]{1,3})",$HTTP_USER_AGENT,$match)) 
	{ 
	$BName = "Netscape "; $BVersion=$match[2]; 
	} 
	elseif(eregi("w3m",$HTTP_USER_AGENT)) 
	{ 
	$BName = "w3m"; $BVersion="Unknown"; 
	} 
	else{$BName = "Unknown"; $BVersion="Unknown";} 
	
	// System 
	if(eregi("linux",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "Linux"; 
	} 
	elseif(eregi("win32",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "Windows"; 
	} 
	elseif((eregi("(win)([0-9]{2})",$HTTP_USER_AGENT,$match)) || (eregi("(windows) ([0-9]{2})",$HTTP_USER_AGENT,$match))) 
	{ 
	$BPlatform = "Windows $match[2]"; 
	} 
	elseif(eregi("(winnt)([0-9]{1,2}.[0-9]{1,2}){0,1}",$HTTP_USER_AGENT,$match)) 
	{ 
	$BPlatform = "Windows NT $match[2]"; 
	} 
	elseif(eregi("(windows nt)( ){0,1}([0-9]{1,2}.[0-9]{1,2}){0,1}",$HTTP_USER_AGENT,$match)) 
	{ 
	$BPlatform = "Windows NT $match[3]"; 
	} 
	elseif(eregi("mac",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "Macintosh"; 
	} 
	elseif(eregi("(sunos) ([0-9]{1,2}.[0-9]{1,2}){0,1}",$HTTP_USER_AGENT,$match)) 
	{ 
	$BPlatform = "SunOS $match[2]"; 
	} 
	elseif(eregi("(beos) r([0-9]{1,2}.[0-9]{1,2}){0,1}",$HTTP_USER_AGENT,$match)) 
	{ 
	$BPlatform = "BeOS $match[2]"; 
	} 
	elseif(eregi("freebsd",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "FreeBSD"; 
	} 
	elseif(eregi("openbsd",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "OpenBSD"; 
	} 
	elseif(eregi("irix",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "IRIX"; 
	} 
	elseif(eregi("os/2",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "OS/2"; 
	} 
	elseif(eregi("plan9",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "Plan9"; 
	} 
	elseif(eregi("unix",$HTTP_USER_AGENT) || eregi("hp-ux",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "Unix"; 
	} 
	elseif(eregi("osf",$HTTP_USER_AGENT)) 
	{ 
	$BPlatform = "OSF"; 
	} 
	else{$BPlatform = "Unknown";} 

} 

?>