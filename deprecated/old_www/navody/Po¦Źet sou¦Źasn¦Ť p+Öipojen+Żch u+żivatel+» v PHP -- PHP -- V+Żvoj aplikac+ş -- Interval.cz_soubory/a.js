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
 bbt_ad[1558]=new Array("Vystup z davu!","Vyber si COOL e-mailovou adresu.<br>","http://www.vystupzdavu.cz/","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=59369285;h4r=2180394821;p4r=305431151;uwi=800;uhe=600;uce=1;param=63906/840020_5?");
}

if(59728==59728) {
 _bbtEtAd(2231, 1300, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/823651_0");
} else {
 bbt_ad[2231]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=59369285;h4r=2179744837;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/823651_5?");
}
bbt_ad_ready=1;
bbtAddAd();

