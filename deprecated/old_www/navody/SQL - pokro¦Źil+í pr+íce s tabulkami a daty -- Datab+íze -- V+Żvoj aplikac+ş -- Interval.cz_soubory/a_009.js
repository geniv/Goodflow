bbt_url="http://www.billboard.cz/media-text.php";
bbt_adsupertitle="<h3 class='bbt_title' onClick=\"window.open('"+bbt_url+"');javascript:event.cancelBubble=true;\">Billboard Intextov� reklama</h3>";
bbt_adsuperfooter="<h5 onClick=\"window.open('"+bbt_url+"');javascript:event.cancelBubble=true;\"><span></span><em>o reklam� Billboard &raquo;</em></h5>";
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
 bbt_ad[753]=new Array("Ploty, oplocen�, pletivo,","plotov� p��slu�enstv�. Kvalita od<br>�esk�ho v�robce! Dopravu zajist�me.","http://www.dops.cz/","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=34659654;p4r=305441369;uwi=800;uhe=600;uce=1;param=61260/749125_5?");
}

if(61064==59728) {
 _bbtEtAd(3798, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=64250/843435_0");
} else {
 bbt_ad[3798]=new Array("S�zen� po internetu","Online s�zky na v�sledky<br>sportovn�ch utk�n�. V�hodn� kurzy.","www.betfair.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2184211526;p4r=305454699;uwi=800;uhe=600;uce=1;param=64250/843435_5?");
}

if(60541==59728) {
 _bbtEtAd(538, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63618/835045_0");
} else {
 bbt_ad[538]=new Array("Zabezpe�en� objekt�","a are�l�. Projekce, mont�, servis,<br>bezpe�nostn� dokumentace a dal��.","www.security.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181824838;p4r=305431151;uwi=800;uhe=600;uce=1;param=63618/835045_5?");
}

if(59728==59728) {
 _bbtEtAd(1426, 1400, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/811705_0");
} else {
 bbt_ad[1426]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=0;h4r=2181142598;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/811705_5?");
}
bbt_ad_ready=1;
bbtAddAd();

