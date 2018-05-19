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

if(60763==59728) {
 _bbtEtAd(1558, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63906/840020_0");
} else {
 bbt_ad[1558]=new Array("Vystup z davu!","Vyber si COOL e-mailovou adresu.<br>","http://www.vystupzdavu.cz/","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=2214461002;h4r=2180602181;p4r=305428068;uwi=800;uhe=600;uce=1;param=63906/840020_5?");
}

if(59351==59728) {
 _bbtEtAd(529, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62166/786749_0");
} else {
 bbt_ad[529]=new Array("Zatemòovací technika","rolety, pøedokenní rolety, markýzy<br>vnitøní i venkovní, vèetnì montáže","www.plastic-al.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=2214461002;h4r=33253189;p4r=305454699;uwi=800;uhe=600;uce=1;param=62166/786749_5?");
}

if(55476==59728) {
 _bbtEtAd(23321, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=57942/574940_0");
} else {
 bbt_ad[23321]=new Array("LevnePneu.cz","Vybírejte levné pneumatiky a disky.<br>Zasíláme je zdarma po celé ÈR .","www.levnepneu.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=2214461002;h4r=33317701;p4r=305454699;uwi=800;uhe=600;uce=1;param=57942/574940_5?");
}

if(59728==59728) {
 _bbtEtAd(6418, 500, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/822738_0");
} else {
 bbt_ad[6418]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=2214461002;h4r=2180665669;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/822738_5?");
}
bbt_ad_ready=1;
bbtAddAd();

