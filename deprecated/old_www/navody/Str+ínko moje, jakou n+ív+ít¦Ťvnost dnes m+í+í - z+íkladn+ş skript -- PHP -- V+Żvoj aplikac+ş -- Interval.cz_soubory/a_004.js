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
 _bbtEtAd(133, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=63906/840035_0");
} else {
 bbt_ad[133]=new Array("Vystup z davu!","Vyber si COOL e-mailovou adresu.<br>","http://www.vystupzdavu.cz/","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=83970898;h4r=33100101;p4r=305402478;uwi=800;uhe=600;uce=1;param=63906/840035_5?");
}

if(59155==59728) {
 _bbtEtAd(2357, 0, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62149/780320_0");
} else {
 bbt_ad[2357]=new Array("Spoøící úèet: 3,5 % p.a.","Máte nìjaké volné peníze? Zúroète<br>je. Vybrat je mùžete kdykoliv!","www.bawag.cz","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=83970898;h4r=33278533;p4r=305454699;uwi=800;uhe=600;uce=1;param=62149/780320_5?");
}

if(59728==59728) {
 _bbtEtAd(169, 1300, "http://ad2.billboard.cz/please/redirect/35974/1/1/32/!etarget=1;param=62552/822488_0");
} else {
 bbt_ad[169]=new Array("Reklama","Katalog<br>eTarget","etarget.com","http://ad2.billboard.cz/please/redirect/35974/1/1/32/!hash=83970898;h4r=33263429;p4r=305415775;uwi=800;uhe=600;uce=1;param=62552/822488_5?");
}
bbt_ad_ready=1;
bbtAddAd();

