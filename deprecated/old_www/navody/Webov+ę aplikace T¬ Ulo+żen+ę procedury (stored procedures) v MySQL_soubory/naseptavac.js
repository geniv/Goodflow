var xmlHttp;
var dokonceniDiv;
var vstupniPole;
var tabulkaUdaju;
var tabulkaUdajuTelo;

function vytvorXMLHttpRequest(){
    if (window.ActiveXObject){
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }else if (window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }
}

function inicializujPromene(){
    vstupniPole = document.getElementById("s");
	tabulkaUdaju = document.getElementById("tabulkaUdaju");
	dokonceniDiv = document.getElementById("nabidka");
	tabulkaUdajuTelo = document.getElementById("tabulkaUdajuTelo");
}

function vyhledejUdaje(){
	inicializujPromene();
	if (vstupniPole.value.length > 0){
		vytvorXMLHttpRequest();
		//var url = "naseptavac.php?udaj="+escape(vstupniPole.value);
		var url = "http://weboveaplikace.info/naseptavac.php?udaj="+encodeURIComponent(vstupniPole.value);
		xmlHttp.open("GET",url,true);
		xmlHttp.onreadystatechange = zpracujZmenuStavu;
		xmlHttp.send(null);
	}else{
		vymazUdaje();
	}
}

function zpracujZmenuStavu(){
	if (xmlHttp.readyState == 4){
		if (xmlHttp.status == 200){
			var xml = xmlHttp.responseXML;
			//var udaj = xml.getElementsByTagName("udaj")[0].firstChild.data;
            if (xml.getElementsByTagName("udaj")!=null){
    			nastavUdaje(xml.getElementsByTagName("udaj"));
            }else{
			    vymazUdaje();
            }
		}else if (xmlHttp.status == 204){
			vymazUdaje();
		}
	}
}

function nastavUdaje(udaje){
	vymazUdaje();
	var velikost = udaje.length;
	nastavUmisteni();
	var rada, bunka, txtUzel;
	for (var i=0; i < velikost; i++){
		var dalsiUzel = udaje[i].firstChild.data;
		rada = document.createElement("tr");
		bunka = document.createElement("td");
		bunka.onmouseout = function(){this.className="mouseOver";};
		bunka.onmouseover = function(){this.className="mouseOut";};
        bunka.className="mouseOver";
		bunka.setAttribute("border",0);
		bunka.onclick = function(){vyplnUdaj(this);};
		txtUzel = document.createTextNode(dalsiUzel);
		bunka.appendChild(txtUzel);
		rada.appendChild(bunka);
		tabulkaUdajuTelo.appendChild(rada);
	}
}


function nastavUmisteni(){
	var konec = vstupniPole.offsetWidth;
	var levy = vypoctiUmisteniLevy(vstupniPole);
	var horni = vypoctiUmisteniHorni(vstupniPole)+vstupniPole.offsetHeight;
	dokonceniDiv.style.border = "black 1px solid";
	dokonceniDiv.style.left = levy + "px";
	dokonceniDiv.style.top = horni + "px";
	tabulkaUdaju.style.width = konec+"px";
}

function vypoctiUmisteniLevy(pole){
	return vypoctiUmisteni(pole,"offsetLeft");
}

function vypoctiUmisteniHorni(pole){
	return vypoctiUmisteni(pole,"offsetTop");
}

function vypoctiUmisteni(pole, atribut){
	var umisteni = 0;
	while (pole){
		umisteni += pole[atribut];
		pole = pole.offsetParent;
	}
	return umisteni;
}

function vyplnUdaj(bunka){
	vstupniPole.value = bunka.firstChild.nodeValue;
	vymazUdaje();
}


function vymazUdaje(){
	var velikost = tabulkaUdajuTelo.childNodes.length;
	for (var i = velikost-1; i>=0 ; i--){
		tabulkaUdajuTelo.removeChild(tabulkaUdajuTelo.childNodes[i]);
	}
	dokonceniDiv.style.border = "none";
}
