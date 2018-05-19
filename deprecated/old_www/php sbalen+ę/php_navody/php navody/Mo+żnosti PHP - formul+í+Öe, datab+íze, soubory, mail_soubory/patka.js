
// Skript poid�van� poed patieku v�ech dokumentu na JPW

// vyskl�d�n� ovl�dac�ho pan�lku navigace 

var prevNextText = ""; // promenn�, do kter� vyskl�d�m odkazy

function pripisOdkaz(idecko,zobrText,tipText){
	if(document.getElementById(idecko)){
		var objekt = document.getElementById(idecko);
		prevNextText += ' <a href="' + objekt.href + '" title="' + tipText + objekt.innerHTML +'">'+zobrText+'</a>'
	}
}

function navigaciDolu(){
	document.getElementById("wherenext").innerHTML = document.getElementById("navigace").innerHTML;
}

pripisOdkaz("prev","&lt;","P�edchoz�: ");
if(!jeDomovska && !jeSekce && !jePodsekce)pripisOdkaz("sel","^","Obsah podsekce ");
pripisOdkaz("next","&gt;", "Dal��: ");

// vyps�n� pan�lku do dokumentu
document.write('<div id="prevnexttop" class="panel"></div>');
document.write('<div id="prevnextbottom" class="panel"></div>');
document.write('<div id="wherenext"><a href="#navigace" onclick="navigaciDolu(); return false;">Kam d�l?</a></div>');
// document.write('<div id="gototop"><a href="#">na zae�tek str�nky</a></div>');

// naplnin� pan�lku vyskl�dan�m textem
document.getElementById("prevnexttop").innerHTML = prevNextText;
document.getElementById("prevnextbottom").innerHTML = prevNextText;


// Toplist
var ref ;
if (document.referrer){
	ref = escape(document.referrer);
	if(ref.indexOf("dusan.pc-slany") > -1 ) ref="http://stare_jpw";
	if(ref.indexOf("jakpsatweb.cz/weblog") > -1 ) ref="http://jpw_weblog";
	if(ref.indexOf("jakpsatweb.cz") > -1 ) ref="http://vnitrni_jakpsatweb";
}
else 
	ref = "nepredan";

// toplist parametr s
var topS = new Array();
topS[""]=1;
topS["undefined"]=1;
topS["zak"]=1;
topS["html"]=2;
topS["css"]=3;
topS["js"]=4;
topS["clanky"]=5;
topS["ost"]=6;
topS["en"]=7;

var topId = "49306";
var topSrc = "http://www.toplist.cz/dot.asp";
topSrc += "?id=" + topId; 
topSrc += "&http=" + ref;
if(document.body.className) topSrc += "&s=" + topS[document.body.className];
topSrc += "&r=" + Math.random();

var topImg = new Image();
topImg.src = topSrc;

// Navrcholu
var nvRef ;
if (document.referrer){
	nvRef = escape(document.referrer);
	}
else 
	nvRef = "nepredan";

var nvId = "31373";
var nvSrc = "http://c1.navrcholu.cz/hit";
nvSrc += "?site=" + nvId; 
nvSrc += ";t=lb14"; // druh obrazku
nvSrc += ";ref=" + nvRef;
nvSrc += ";r=" + Math.random();

var nvImg = new Image();
nvImg.src = nvSrc;


// ##############################################################
// P�id�n� hr�kov� navigace
// ��d�c� prom�nn�
var jeDomovska; if(jeDomovska != true) jeDomovska= false; 
var jeSekce; if(jeSekce != true) jeSekce = false; 
var jePodsekce; if(jePodsekce != true) jePodsekce = false;
var pridanyText = ""; // prom�nn�, ve kter� se skl�d� obsah hr�kov� navigace

//vypo��t�m ko�en, p�edpokl�d� existenci loga s odkazem na HP
korenHref = document.getElementById("logoa").href; 
koren = korenHref.substr(0, korenHref.length - 10); // zkracuju o 10 posledn�ch znak�, 10 je d�lka "index.html"

/* Odkaz Jak ps�t web */
pridanyText += "<a href='" + korenHref + "'>Jak ps�t web</a> ";

/* Prvn� �rove� z�lozek*/
// definice z�lozek
var ouskoT = new Array(), ouskoU = new Array();
ouskoT["zak"] = "N�vody"; // ouskoU["zak"] = "index.html"; // nebude pot�eba
ouskoT["css"] = "CSS"; ouskoU["css"] = "css/index.html";
ouskoT["html"] = "HTML"; ouskoU["html"] = "html/index.html";
ouskoT["js"] = "JavaScript"; ouskoU["js"] = "javascript/index.html";
ouskoT["clanky"] = "�l�nky"; ouskoU["clanky"] = "clanky/index.html";
ouskoT["ost"] = "Ostatn�"; ouskoU["ost"] = "navigace/ostatni.html";

ouskoA = document.body.className; // aktivn� z�lozka

pridanyText += "<b>&gt;</b> "; // prvn� zob��ek

// z�pis prvn� �rovn�
// v p��pad� sekce n�vod� ("zak") se prvn�mu hr�ku nep�id�v� odkaz 
// odkaz se nep�id�v� tak� v p��pad�, ze je str�nka sekc� (jeSekce)
if(ouskoA == "zak" || jeSekce) {
	pridanyText += ouskoT[ouskoA];
}
// domovsk� str�nka
/*else if(jeDomovska)
{
	pridanyText += "jste na hlavn� str�nce";
}*/
// jinak se odkaz p�id�v�
else {
	pridanyText += " <a href='" + koren + ouskoU[ouskoA] + "'>" ; 
	pridanyText += ouskoT[ouskoA];
	pridanyText += "</a>";
} 

/* Podsekce */
// vypisuje se v p��pad�, ze to nen� domovsk� str�nka a ze existuje prvek s id="sel"
if(!jeDomovska && document.getElementById("sel")){
	podsekce = document.getElementById("sel");
	
	// jestlize je to podsekce, nebo kdyz ma podsekce stejny odkaz jako sekce, bude jenom text	
	if((jePodsekce || podsekce.href == koren + ouskoU[ouskoA])&& !jeSekce){
		pridanyText += " <b>&gt;</b> "; //  zob��ek
		pridanyText += podsekce.innerHTML;
	}
	else if(jeSekce){ // uz v�m, ze existuje id="sel"
		pridanyText += " &nbsp; (rozcestn�k podsekce " + podsekce.innerHTML +")";
	}
	else {
		pridanyText += " <b>&gt;</b> "; //  zob��ek
		pridanyText += " <a href='" + podsekce.href + "'>" + podsekce.innerHTML + "</a>";;
	}
}

/* Vlastn� n�zev str�nky */

if(!jeDomovska && !jeSekce && !jePodsekce){
	pridanyText += " <b>&gt;</b> "; //  zob��ek
	nazev = document.getElementsByTagName("h1")[0];
	pridanyText += nazev.innerHTML;
}

/* Vyps�n� hr�kov� navigace do str�nky */
if(document.getElementById("hrasek")) document.getElementById("hrasek").innerHTML += pridanyText;
if(document.getElementById("hrasekdole")) document.getElementById("hrasek").innerHTML += "Um�st�n� t�to str�nky v hierarchii webu: " + pridanyText;

// konec hr�kov� navigace ############################################
