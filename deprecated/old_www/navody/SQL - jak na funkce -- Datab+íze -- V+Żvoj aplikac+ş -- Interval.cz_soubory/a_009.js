bbt_url="http://www.billboard.cz/media-text.php";
bbt_adsupertitle="<h3 class='bbt_title' onClick=\"window.open('"+bbt_url+"');javascript:event.cancelBubble=true;\">Billboard Intextová reklama</h3>";
bbt_adsuperfooter="<h5 onClick=\"window.open('"+bbt_url+"');javascript:event.cancelBubble=true;\"><span></span><em>o reklamì Billboard &raquo;</em></h5>";
var _bbtAdDomain='ad2.billboard.cz';
var bbt_etarget_ad={};
function _bbtEtAd(idwrd,cat,url) {
 var obj={};
 obj.categ=cat;
 obj.asyncUrl=url;
 bbt_etarget_ad[idwrd]=obj;
 bbt_ad[idwrd]=new Array("","","","http://www.etarget.cz/catalog.php?ref=4372&catalogPartner=270&c="+cat+"&asynchronousConfirmURL="+escape(url));
}

if(61130==59728) {
 _bbtEtAd(38, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=64320/844117_0");
} else {
 bbt_ad[38]=new Array("Windows Server 2008","Nespoutaný server. Bezpeènìjší<br>než kdykoliv pøedtím.","serveronauti.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181499462;p4r=305415775;uwi=800;uhe=600;uce=1;param=64320/844117_5?");
}

if(60763==59728) {
 _bbtEtAd(1558, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63906/840033_0");
} else {
 bbt_ad[1558]=new Array("Vystup z davu!","Vyber si COOL e-mailovou adresu.<br>","http://www.vystupzdavu.cz/","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181538118;p4r=305415775;uwi=800;uhe=600;uce=1;param=63906/840033_5?");
}

if(61064==59728) {
 _bbtEtAd(3798, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=64250/843435_0");
} else {
 bbt_ad[3798]=new Array("Sázení po internetu","Online sázky na výsledky<br>sportovních utkání. Výhodné kurzy.","www.betfair.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2184211526;p4r=305454699;uwi=800;uhe=600;uce=1;param=64250/843435_5?");
}

if(60541==59728) {
 _bbtEtAd(538, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63618/835045_0");
} else {
 bbt_ad[538]=new Array("Zabezpeèení objektù","a areálù. Projekce, montáž, servis,<br>bezpeènostní dokumentace a další.","www.security.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181824838;p4r=305431151;uwi=800;uhe=600;uce=1;param=63618/835045_5?");
}

if(59728==59728) {
 _bbtEtAd(32710, 1100, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/814618_0");
} else {
 bbt_ad[32710]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181569862;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/814618_5?");
}
bbt_ad_ready=1;
bbtAddAd();

