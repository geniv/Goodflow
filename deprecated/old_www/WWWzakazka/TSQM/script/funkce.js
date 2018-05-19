// JavaScript Document

function UniverzalniKontrola(element, vyraz, hlaska)  //univerzální kontrolovací skrypt
{
  if (window.RegExp)
	{
		re = new RegExp(vyraz);

		if (!re.test(document.getElementById(element).value))
		{
			window.alert(hlaska);
			return false;
		}
	}
}

function ZablokovaniElementu(element, hodnota)
{
  document.getElementById(element).disabled = hodnota;
}

function OznacElement(element, hodnota)
{
  document.getElementById(element).checked = hodnota;
}

function SoucetSourozencu(element1, element2, element3, hlaska)
{
  var brat = eval(document.getElementById(element1).value);
  var sest = eval(document.getElementById(element2).value);
  var pocet = brat + sest;
  if (pocet < 0)
  {
    pocet = 0;
  }
  document.getElementById(element3).innerHTML = pocet;
}

function VypocetPocetRoku(element1, element2, element3, hlaska)
{
  var rod = eval(document.getElementById(element1).value);
  var rdo = eval(document.getElementById(element2).value);
  var pocet = rdo - rod;
  if (pocet < 0)
  {
    window.alert(hlaska);
    pocet = 0;
    document.getElementById(element2).value = document.getElementById(element1).value;
  }
  document.getElementById(element3).innerHTML = pocet;
}
//aplikace AJAXu
function CreateXmlHttpObject()
{
  var xmlHttp = null;
  try
    {
      xmlHttp = new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
    }
      catch (e)
      {
        try
        {
          xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");  // Internet Explorer
        }
          catch (e)
          {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
      }

  return xmlHttp;
}

var elem; //definice proměnné elementu
function AjaxKontrola(element, action, hodnota) //výstupní element, kontrolovaný element(do PHP), hodnota objektu (v XHTML)
{
  xmlHttp = CreateXmlHttpObject();
  elem = element; //definice elementu
  if (xmlHttp == null)
  {
    alert ("Your browser does not support AJAX!");
    return;
  }

  var url = "kontrola.php?action=" + action + "&value=" + hodnota + "&kid=" + Math.random();

  xmlHttp.onreadystatechange = ZmenaStavu;  //po dokoncení se zavola
  xmlHttp.open("GET", url, true); //na serveru se zavola
  xmlHttp.send(null); //a posle se to vsechno
}

function ZmenaStavu()
{
  switch (xmlHttp.readyState) //osetreni navratovych kodu
  {
    case 3: //pracuje
      document.getElementById(elem).innerHTML = "Loading..."; //nacitani
    break;
    
    case 4: //kompletni
      document.getElementById(elem).innerHTML = xmlHttp.responseText;
    break;
  }
}
//kod vyjizdeciho menu**********************************************************
var rychlost = 15;
var cekani = 500; //ms
var id_elem = "jazyk";  //id elementu
var plus = 2;

function move(elem, num)
{
  elem.getElementsByTagName('div')[0].style['right'] = parseInt(elem.getElementsByTagName('div')[0].style['right']) + num + 'px';
  elem.style.width = parseInt(elem.style.width) + num + 'px';

  if(num > 0)
  {
    elem.moving = setTimeout(function(){movein(elem)}, rychlost);
  }
    else
  {
    elem.moving = setTimeout(function(){moveout1(elem)}, rychlost);
  }
}

function movein(elem)
{
  var m1 = parseInt(elem.getElementsByTagName('div')[0].style['right']);

  if(elem.moving)
  {
    clearTimeout(elem.moving);
  }

  if (m1 < -plus)
  {
    move(elem, 10);
  }
}

function moveout(elem)
{
  if(elem.moving)
  {
    clearTimeout(elem.moving);
  }
  elem.moving = setTimeout(function(){moveout1(elem)}, cekani);
}

function moveout1(elem)
{
  var aw = elem.b.offsetWidth - 270;
  var m1 = elem.getElementsByTagName('div')[0];

  if(elem.moving)
  {
    clearTimeout(elem.moving);
    if (parseInt(m1.style['right']) >= aw - m1.offsetWidth + 10)
    {
      move(elem, -10);
    }
  }
}

function make_menus()
{
  var idel = document.getElementById(id_elem);
  var bar = document.getElementById(id_elem + 'bar');
  idel.b = bar;
  resizevent(idel);
}

function resizevent(param)
{
  var m1 = param.getElementsByTagName('div')[0];
  bo = param.b.offsetWidth + plus;
  m1.style['right'] = (navigator.appName == 'Microsoft Internet Explorer' ? bo - (m1.offsetWidth - 30) + 'px' : bo - m1.offsetWidth + 'px');
  param.style.width = bo + 'px';
}
//kod vyjizdeciho menu**********************************************************

function VlozitText(element, text)
{
  document.getElementById(element).value = text;
}

/*
document.getElementsByTagName('input')[0]
document.getElementsByName('tlacitko')[0]
document.getElementById('odkaz')
document.getElementByClass('bulletmenu'); ???

, '<span id='obr{$cislo}{$i}'>...</span>'
<span id=\"obr{$cislo}{$i}\">
*/

/* funkce na rozbalovani prav v administrace */

function ElementSpan(cesta, typ)
{
  if (typ)
  {
    return "<span style='background-image:url(" + cesta + "obr/zabalene_prava.png);'></span>";//background-image:url(" + cesta + "obr/zabalene_prava.png);
  }
    else
  {
    return "<span style='background-image:url(" + cesta + "obr/rozbalene_prava.png);'></span>";//background-image:url(" + cesta + "obr/rozbalene_prava.png);
  }
}

function Rozbalit(element, prvek, idpozadi, mini, full, cesta)
{
  var el = document.getElementById(element);  //ul
  var el1 = document.getElementById(idpozadi);  //a href

  if (el.style.display == 'block')
  {
    el.style.display = 'none';  //ul
    el1.style.backgroundImage="url(" + cesta + "obr/plus_rozbalene_prava.png)";
    prvek.innerHTML = mini + ElementSpan(cesta, true);  //obsah a hrefu
  }
    else
  {
    el.style.display = 'block'; //ul
    el1.style.backgroundImage="url(" + cesta + "obr/minus_zabalene_prava.png)"; //a href
    prvek.innerHTML = full + ElementSpan(cesta, false); //obsah a hrefu
  }
}

function RozbalPlus(element, main, link, cesta, mini, full)
{
  var el = document.getElementById(element);  //ul
  var el1 = document.getElementById(link);  //a href

  if (el.style.display == 'block')
  {
    el.style.display = 'none';
    el1.innerHTML = mini + ElementSpan(cesta, true);  //obsah druheho a hrefu
    main.style.backgroundImage="url(" + cesta + "obr/plus_rozbalene_prava.png)";
  }
    else
  {
    el.style.display = 'block';
    el1.innerHTML = full + ElementSpan(cesta, false); //obsah druheho a hrefu
    main.style.backgroundImage="url(" + cesta + "obr/minus_zabalene_prava.png)";
  }
}


/*

function AjaxMenu(cislo, box)  //vykreslovaci a vykona cast menu, cislo, sekce, podsekce, podpodsekce
{ //, cismen, men, cissub, sub, box, akce
  MenuXmlHttp = CreateXmlHttpObject();

  if (MenuXmlHttp == null)
  {
    alert ("Your browser does not support AJAX!");
    return;
  }

  var url = "ajax.php?cislo=" + cislo + "&box=" + box + "&kid=" + Math.random();  //posilana url adresa
//&cismen=" + cismen + "&men=" + men + "&cissub=" + cissub + "&sub=" + sub + "&box=" + box + "&akce=" + akce + "
  MenuXmlHttp.onreadystatechange = Zobraz; //po dokoncení se zavola
  MenuXmlHttp.open("GET", url, true); //na serveru
  MenuXmlHttp.send(null); //a posle se to vsechno
}

function Zobraz()
{
  switch (MenuXmlHttp.readyState) //osetreni navratovych kodu
  {
    case 3: //pracuje
      document.getElementById('ajax_msg').innerHTML = "Loading..."; //nacitani
    break;

    case 4: //kompletni
      document.getElementById('ajax_msg').innerHTML = MenuXmlHttp.responseText;
    break;
  }
}
*/
/*
function KontrolaEmailu()
{
	if (window.RegExp)
	{
		re = new RegExp("^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$");

		if (!re.test(document.getElementById("email_label_input").value))
		{
			window.alert("Zadal jsi špatný formát emailu !");
			return false;
		}
	}
}
*/
