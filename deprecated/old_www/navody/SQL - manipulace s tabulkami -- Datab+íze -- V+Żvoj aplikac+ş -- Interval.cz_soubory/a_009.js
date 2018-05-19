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

if(58400==59728) {
 _bbtEtAd(753, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=61260/749125_0");
} else {
 bbt_ad[753]=new Array("Ploty, oplocení, pletivo,","plotové pøíslušenství. Kvalita od<br>èeského výrobce! Dopravu zajistíme.","http://www.dops.cz/","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=34756422;p4r=305398364;uwi=800;uhe=600;uce=1;param=61260/749125_5?");
}

if(60427==59728) {
 _bbtEtAd(431, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63358/826841_0");
} else {
 bbt_ad[431]=new Array("Hledáte zamìstnance","nebo práci v ÈR? Inzerujte na našem<br>pracovním portálu a urèitì najdete!","www.pracevcr.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=34794566;p4r=305415775;uwi=800;uhe=600;uce=1;param=63358/826841_5?");
}

if(61064==59728) {
 _bbtEtAd(3798, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=64248/843435_0");
} else {
 bbt_ad[3798]=new Array("Fotbalový šampionát EURO","Sázejte po internetu a tipujte<br>vítìze ME ve fotbale.","www.betfair.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=36245062;p4r=305454699;uwi=800;uhe=600;uce=1;param=64248/843435_5?");
}

if(60541==59728) {
 _bbtEtAd(538, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63618/835045_0");
} else {
 bbt_ad[538]=new Array("Zabezpeèení objektù","a areálù. Projekce, montáž, servis,<br>bezpeènostní dokumentace a další.","www.security.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181824838;p4r=305431151;uwi=800;uhe=600;uce=1;param=63618/835045_5?");
}

if(59960==59728) {
 _bbtEtAd(804, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62760/808940_0");
} else {
 bbt_ad[804]=new Array("Hobby a zahrada","Pro práci i odpoèinek na zahradì si<br>vyberete v našem Eshopu - Orion","www.velkoobchodorion.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=34081606;p4r=305402478;uwi=800;uhe=600;uce=1;param=62760/808940_5?");
}

if(59728==59728) {
 _bbtEtAd(2357, 1300, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/822485_0");
} else {
 bbt_ad[2357]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=34146118;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/822485_5?");
}
bbt_ad_ready=1;
bbtAddAd();

