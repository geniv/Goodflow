<?php

/**
 *
 * Blok rozlisovani podle user agenta
 *
 * public funkce:\n
 * construct: RozliseniPodleAgenta - hlavni konstruktor tridy\n
 * RozlisOS() - rozliseni podle OS\n
 * RozlisBrowser() - rozliseni podle Browseru\n
 *
 */

class RozliseniPodleAgenta
{
  private $var;

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
  }

/**
 *
 * Rozliseni podle operacnho systemu uzivatele
 *
 * @return nazev operacniho systemu
 */
  public function RozlisOS()
  {
    $OSList = array("Windows 3.11" => "/Win16/i",
                    "Windows 95" => "/(Windows.95)|(Win95)/i",
                    "Windows 98" => "/(Windows.98)|(Win98)/i",
                    "Windows 2000" => "/(Windows NT 5\.0)|(Windows 2000)/i",
                    "Windows XP" => "/(Windows NT 5\.1)|(Windows XP)/i",
                    "Windows XP x64" => "/((Windows NT 5\.2).*(Win64))|((Win64).*(Windows NT 5\.2))/i",
                    "Windows Server 2003" => "/Windows NT 5\.2/i",
                    "Windows Vista" => "/Windows NT 6\.0/i",
                    "Windows 7" => "/Windows NT 7\.0/i",
                    "Windows NT 4.0" => "/(Windows NT 4\.0)|(WinNT4\.0)|(WinNT)|(Windows NT)/i",
                    "Windows ME" => "/(Windows ME)|(Win 9x 4\.90)/i",
                    "Microsoft PocketPC" => "/((Windows CE).*(PPC))|((PPC).*(Windows CE))/i",
                    "Microsoft Smartphone" => "/((Windows CE).*(smartphone))|((smartphone).*(Windows CE))/i",
                    "Windows CE" => "/Windows CE/i",
                    "Mandrake Linux" => "/((Linux).*(Mandrake))|((Mandrake).*(Linux))/i",
                    "Mandriva Linux" => "/((Linux).*(Mandriva))|((Mandriva).*(Linux))/i",
                    "SuSE Linux" => "/((Linux).*(SuSE))|((SuSE).*(Linux))/i",
                    "Novell Linux" => "/((Linux).*(Novell))|((Novell).*(Linux))/i",
                    "Kubuntu Linux" => "/((Linux).*(Kubuntu))|((Kubuntu).*(Linux))/i",
                    "Xubuntu Linux" => "/((Linux).*(Xubuntu))|((Xubuntu).*(Linux))/i",
                    "Edubuntu Linux" => "/((Linux).*(Edubuntu))|((Edubuntu).*(Linux))/i",
                    "Ubuntu Linux" => "/((Linux).*(Ubuntu))|((Ubuntu).*(Linux))/i",
                    "Debian GNU/Linux" => "/((Linux).*(Debian))|((Debian).*(Linux))/i",
                    "RedHat Linux" => "/((Linux).*(Red ?Hat))|((Red ?Hat).*(Linux))/i",
                    "Gentoo Linux" => "/((Linux).*(Gentoo))|((Gentoo).*(Linux))/i",
                    "Fedora Linux" => "/((Linux).*(Fedora))|((Fedora).*(Linux))/i",
                    "MEPIS Linux" => "/((Linux).*(MEPIS))|((MEPIS).*(Linux))/i",
                    "Knoppix Linux" => "/((Linux).*(Knoppix))|((Knoppix).*(Linux))/i",
                    "Slackware Linux" => "/((Linux).*(Slackware))|((Slackware).*(Linux))/i",
                    "Xandros Linux" => "/((Linux).*(Xandros))|((Xandros).*(Linux))/i",
                    "Kanotix Linux" => "/((Linux).*(Kanotix))|((Kanotix).*(Linux))/i",
                    "Linux" => "/(Linux)|(X11)/i",
                    "FreeBSD" => "/Free/i",
                    "OpenBSD" => "/OpenBSD/i",
                    "NetBSD" => "/NetBSD/i",
                    "SGI IRIX" => "/IRIX/i",
                    "Sun OS" => "/SunOS/i",
                    "QNX" => "/QNX/i",
                    "BeOS" => "/BeOS/i",
                    "Mac OS X Leopard" => "/(Mac OS).*(Leopard)/i",
                    "Mac OS X" => "/(Mac OS X)/i",
                    "Mac OS" => "/(Mac_PowerPC)|(Macintosh)/i",
                    "OS/2" => "#OS/2#i",
                    "Qtopia" => "/QtEmbedded/i",
                    "Sharp Zaurus \\1" => "/Zaurus ([a-zA-Z0-9\.]+)/i",
                    "Zaurus" => "/Zaurus/i",
                    "Symbian OS" => "/Symbian/i",
                    "Sony Clie" => "#PalmOS/sony/model#i",
                    "Series \\1" => "/Series ([0-9]+)/i",
                    "Nokia \\1" => "/Nokia ([0-9]+)/i",
                    "Siemens \\1" => "/SIE-([a-zA-Z0-9]+)/i",
                    "Dopod \\1" => "/dopod([a-zA-Z0-9]+)/i",
                    "O2 XDA \\1" => "/o2 xda ([a-zA-Z0-9 ]+);/i",
                    "Samsung \\1" => "/SEC-([a-zA-Z0-9]+)/i",
                    "SonyEricsson \\1" => "/SonyEricsson ?([a-zA-Z0-9]+)/i",
                    "Nintendo Wii" => "/Wii/i",
                    "Bot" => "/(crawler)|(Mediapartners-Google)|(Jyxobot)|(morfeo.centrum.cz)|(Gigabot)|(ASAP-LynxViewer)|(ASAP-Web-Sniffer)|(EARTHCOM.info)|(Mozdex)|(SeznamBot)|(Speedy Spider)|(Yahoo! Slurp)|(ZACATEK_CZ_BOT)|(www.yacy.net)|(Googlebot)|(Openbot)|(MSNBot)|(del.icio.us-thumbnails)|(Exabot)|(findlinks)|(Bot,Robot,Spider)/i",
                    "Neznámý" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($OSList as $os => $regexp)
    {
      preg_match($regexp, $agent, $matches);
      if (!Empty($matches))
      {
        for ($i = 0; $i <= count($matches); $i++)
        {
          $os = str_replace("\\{$i}", $matches[$i], $os);
        }
        break;
      }
    }

    return trim($os);
  }

/**
 *
 * Rozliseni podle browseru uzivatele
 *
 * @return nazev browseru
 */
  public function RozlisBrowser()
  {
    $BrowserList = array ("Internet Explorer \\1" => "#MSIE ([a-zA-Z0-9\.]+)#i",
                          "Mozilla Firefox \\2" => "#(Firefox|Phoenix|Firebird)/([a-zA-Z0-9\.]+)#i",
                          "Opera \\1" => "#Opera[ /]([a-zA-Z0-9\.]+)#i",
                          "Netscape \\1" => "#Netscape[0-9]?/([a-zA-Z0-9\.]+)#i",
                          "Safari \\1" => "#Safari/([a-zA-Z0-9\.]+)#i",
                          "Flock \\1" => "#Flock/([a-zA-Z0-9\.]+)#i",
                          "Epiphany \\1" => "#Epiphany/([a-zA-Z0-9\.]+)#i",
                          "Konqueror \\1" => "#Konqueror/([a-zA-Z0-9\.]+)#i",
                          "Maxthon \\1" => "#Maxthon ?([a-zA-Z0-9\.]+)?#i",
                          "K-Meleon \\1" => "#K-Meleon/([a-zA-Z0-9\.]+)#i",
                          "Lynx \\1" => "#Lynx/([a-zA-Z0-9\.]+)#i",
                          "Links \\1" => "#Links .{2}([a-zA-Z0-9\.]+)#i",
                          "ELinks \\3" => "#ELinks([/ ]|(.{2}))([a-zA-Z0-9\.]+)#i",
                          "Debian IceWeasel \\1" => "#(iceweasel)/([a-zA-Z0-9\.]+)#i",
                          "Mozilla SeaMonkey \\1" => "#(SeaMonkey)/([a-zA-Z0-9\.]+)#i",
                          "OmniWeb" => "#OmniWeb#i",
                          "Mozilla \\1" => "#^Mozilla/5\.0.*rv:([a-zA-Z0-9\.]+).*#i",
                          "Netscape Navigator \\1" => "#^Mozilla/([a-zA-Z0-9\.]+)#i",
                          "PHP" => "/PHP/i",
                          "SymbianOS \\1" => "#symbianos/([a-zA-Z0-9\.]+)#i",
                          "Avant Browser" => "/avantbrowser\.com/i",
                          "Camino \\1" => "#(Camino|Chimera)[ /]([a-zA-Z0-9\.]+)#i",
                          "Anonymouse" => "/anonymouse/i",
                          "Danger HipTop" => "/danger hiptop/i",
                          "W3M \\1" => "#w3m/([a-zA-Z0-9\.]+)#i",
                          "Shiira \\1" => "#Shiira[ /]([a-zA-Z0-9\.]+)#i",
                          "Dillo \\1" => "#Dillo[ /]([a-zA-Z0-9\.]+)#i",
                          "Openwave UP.Browser \\1" => "#UP.Browser/([a-zA-Z0-9\.]+)#i",
                          "DoCoMo \\1" => "#DoCoMo/(([a-zA-Z0-9\.]+)[/ ]([a-zA-Z0-9\.]+))#i",
                          "Unbranded Firefox \\1" => "#(bonecho)/([a-zA-Z0-9\.]+)#i",
                          "Kazehakase \\1" => "#Kazehakase/([a-zA-Z0-9\.]+)#i",
                          "Minimo \\1" => "#Minimo/([a-zA-Z0-9\.]+)#i",
                          "MultiZilla \\1" => "#MultiZilla/([a-zA-Z0-9\.]+)#i",
                          "Sony PSP \\2" => "/PSP \(PlayStation Portable\)\; ([a-zA-Z0-9\.]+)/i",
                          "Galeon \\1" => "#Galeon/([a-zA-Z0-9\.]+)#i",
                          "iCab \\1" => "#iCab/([a-zA-Z0-9\.]+)#i",
                          "NetPositive \\1" => "#NetPositive/([a-zA-Z0-9\.]+)#i",
                          "NetNewsWire \\1" => "#NetNewsWire/([a-zA-Z0-9\.]+)#i",
                          "Opera Mini \\1" => "#opera mini/([a-zA-Z0-9]+)#i",
                          "WebPro \\2" => "#WebPro(/([a-zA-Z0-9\.]+))?#i",
                          "Netfront \\1" => "#Netfront/([a-zA-Z0-9\.]+)#i",
                          "Xiino \\1" => "#Xiino/([a-zA-Z0-9\.]+)#i",
                          "Blackberry \\1" => "#Blackberry([0-9]+)?#i",
                          "Orange SPV \\1" => "#SPV ([0-9a-zA-Z\.]+)#i",
                          "LG \\1" => "#LGE-([a-zA-Z0-9]+)#i",
                          "Motorola \\1" => "#MOT-([a-zA-Z0-9]+)#i",
                          "Nokia \\1" => "#Nokia ?([0-9]+)#i",
                          "Nokia N-Gage" => "#NokiaN-Gage#i",
                          "Blazer \\1" => "#Blazer[ /]?([a-zA-Z0-9\.]*)#i",
                          "Siemens \\1" => "#SIE-([a-zA-Z0-9]+)#i",
                          "Samsung \\4" => "#((SEC-)|(SAMSUNG-))((S.H-[a-zA-Z0-9]+)|([a-zA-Z0-9]+))#i",
                          "SonyEricsson \\1" => "#SonyEricsson ?([a-zA-Z0-9]+)#i",
                          "J2ME/MIDP Browser" => "#(j2me|midp)#i",
                          "Neznámý" => "/(.*)/");

    $agent = $_SERVER["HTTP_USER_AGENT"];
    foreach($BrowserList as $browser => $regexp)
    {
      if (preg_match($regexp, $agent, $matches))
      {
        if (!Empty($matches))
        {
          for ($i = 0; $i <= count($matches); $i++)
          {
            $browser = str_replace("\\{$i}", $matches[$i], $browser);
          }
        }
        break;
      }
    }

    return trim($browser);
  }
}
?>
