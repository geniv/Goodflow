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
 _bbtEtAd(455, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=64320/844132_0");
} else {
 bbt_ad[455]=new Array("Windows Server 2008","Nespoutaný server. Bezpeènìjší<br>než kdykoliv pøedtím.","serveronauti.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181398086;p4r=305410657;uwi=800;uhe=600;uce=1;param=64320/844132_5?");
}

if(60541==59728) {
 _bbtEtAd(538, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63618/835045_0");
} else {
 bbt_ad[538]=new Array("Zabezpeèení objektù","a areálù. Projekce, montáž, servis,<br>bezpeènostní dokumentace a další.","www.security.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181824838;p4r=305431151;uwi=800;uhe=600;uce=1;param=63618/835045_5?");
}

if(59728==59728) {
 _bbtEtAd(348, 1100, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/810782_0");
} else {
 bbt_ad[348]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181612102;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/810782_5?");
}
bbt_ad_ready=1;
bbtAddAd();

