// JavaScript Document
function kontrolaEmailu(element)
{
	if (window.RegExp)
	{
		re = new RegExp("^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$");

		if (!re.test(document.getElementById(element).value))
		{
			window.alert("Zadal jsi špatný formát emailu !");
			return false;
		}
	}
}

//vypujceno z http://forum.trainz.cz/
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));

function VlozitDoTextu(element, cislo)
{
  var znacky = new Array('[url="http://"]', '[/url]', '[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[email="@"]', '@[/email]', '[odstavec]', '[/odstavec]');
  cis = cislo * 2;

  txtarea = document.getElementById(element);
  txtarea.focus(); //predani zamereni

  if ((clientVer >= 4) && is_ie && is_win)  //verze prohlizece
  {
    sel = document.selection.createRange().text;

    if (sel)
    {
			document.selection.createRange().text = znacky[cis] + sel + znacky[cis + 1];
			txtarea.focus(); //predani zamereni
			sel = '';
			return;
		}
  }
    else
  {
    var selLength = txtarea.textLength;
  	var selStart = txtarea.selectionStart;
  	var selEnd = txtarea.selectionEnd;
  	var scrollTop = txtarea.scrollTop;

  	if (selEnd == 1 || selEnd == 2)
  	{
  		selEnd = selLength;
  	}

  	var s1 = (txtarea.value).substring(0, selStart);
  	var s2 = (txtarea.value).substring(selStart, selEnd)
  	var s3 = (txtarea.value).substring(selEnd, selLength);

    if (s2.length != 0)
    {
      txtarea.value = s1 + znacky[cis] + s2 + znacky[cis + 1] + s3;
    	txtarea.selectionStart = selEnd + znacky[cis].length + znacky[cis + 1].length;
    	txtarea.selectionEnd = txtarea.selectionStart;
    	txtarea.focus();
    	txtarea.scrollTop = scrollTop;
    	return;
    }
  }

  txtarea.focus();
  txtarea.value = txtarea.value + znacky[cis] + znacky[cis + 1];  //kdyz neni oznaceno tak hodi na konec
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

function AjaxStranka(action, akce) //web
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var url = "ajax.php?fun=web&action=" + action + "&akce=" + akce + "&kid=" + Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp);};  //po dokoncení se zavola
  xmlHttp.open("GET", url, true); //na serveru se zavola
  xmlHttp.send(null); //a posle se to vsechno
}

function ZmenaStavu(xmlHttp)
{
  var element = "obal_layout";  //id elementu

  if (document.getElementById(element) != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 0: //neinicializováno
        document.getElementById(element).innerHTML = "<div class='chyba_nenacteno'></div>"; //nacitani
      break;

      case 1: //nacitam v FF3 problikava
        //document.getElementById(element).innerHTML = "<div class='nacitam'></div>"; //nacitani
      break;

      case 2: //nacteno
        document.getElementById(element).innerHTML = "<div class='nacteno'></div>"; //nacitani
      break;

      case 3: //zpracovava
        document.getElementById(element).innerHTML = "<div class='zpracovavam'></div>"; //nacitani
      break;

      case 4: //kompletni
        if (xmlHttp.status == 200)  //je-li vse ok
        {
          document.getElementById(element).innerHTML = xmlHttp.responseText;
        }
          else
        {
          document.getElementById(element).innerHTML = "<div class='chyba_reload'>Při načítání stránky došlo k chybě č. "+xmlHttp.status+" ["+xmlHttp.statusText+"] :) <p>Reloaduj stránku znovu, nebo běž na jinou sekci a tuhle skus znovu.</p></div>";
        }
      break;
    }
  }
}

function AjaxNapiste(jmeno, prijmeni, ulice, mesto, psc, telefon, email, text)  //napiste
{
  var xmlHttp2 = CreateXmlHttpObject();
  if (xmlHttp2 == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var url = "ajax.php?fun=napis&jmeno=" + jmeno + "&prijmeni=" + prijmeni + "&ulice=" + ulice + "&mesto=" + mesto + "&psc=" + psc + "&telefon=" + telefon + "&email=" + email + "&text=" + text + "&kid=" + Math.random();

  xmlHttp2.onreadystatechange = function(){ZmenaStavu2(xmlHttp2);};  //po dokoncení se zavola
  xmlHttp2.open("GET", url, true); //na serveru se zavola
  xmlHttp2.send(null); //a posle se to vsechno
}

function ZmenaStavu2(xmlHttp)
{
  var element = "mesg_napiste";  //id elementu

  if (document.getElementById(element) != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 0: //neinicializováno
        document.getElementById(element).innerHTML = "<div class='chyba_nenacteno'></div>"; //nacitani
      break;

      case 1: //nacitam v FF3 problikava
        //document.getElementById(element).innerHTML = "<div class='nacitam'></div>"; //nacitani
      break;

      case 2: //nacteno
        document.getElementById(element).innerHTML = "<div class='nacteno'></div>"; //nacitani
      break;

      case 3: //zpracovava
        document.getElementById(element).innerHTML = "<div class='zpracovavam'></div>"; //nacitani
      break;

      case 4: //kompletni
        if (xmlHttp.status == 200)  //je-li vse ok
        {
          document.getElementById(element).innerHTML = xmlHttp.responseText;
        }
          else
        {
          document.getElementById(element).innerHTML = "<div class='chyba_reload'>Při načítání stránky došlo k chybě č. "+xmlHttp.status+" ["+xmlHttp.statusText+"] :) <p>Reloaduj stránku znovu, nebo běž na jinou sekci a tuhle skus znovu.</p></div>";
        }
      break;
    }
  }
}

function AjaxForum(jmeno, email, zprava)  //forum
{
  var xmlHttp2 = CreateXmlHttpObject();
  if (xmlHttp2 == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var url = "ajax.php?fun=forum&jmeno=" + jmeno + "&email=" + email + "&zprava=" + zprava + "&kid=" + Math.random();

  xmlHttp2.onreadystatechange = function(){ZmenaStavu3(xmlHttp2);};  //po dokoncení se zavola
  xmlHttp2.open("GET", url, true); //na serveru se zavola
  xmlHttp2.send(null); //a posle se to vsechno
}

function ZmenaStavu3(xmlHttp)
{
  var element = "mesg_forum";  //id elementu

  if (document.getElementById(element) != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 0: //neinicializováno
        document.getElementById(element).innerHTML = "<div class='chyba_nenacteno'></div>"; //nacitani
      break;

      case 1: //nacitam v FF3 problikava
        //document.getElementById(element).innerHTML = "<div class='nacitam'></div>"; //nacitani
      break;

      case 2: //nacteno
        document.getElementById(element).innerHTML = "<div class='nacteno'></div>"; //nacitani
      break;

      case 3: //zpracovava
        document.getElementById(element).innerHTML = "<div class='zpracovavam'></div>"; //nacitani
      break;

      case 4: //kompletni
        if (xmlHttp.status == 200)  //je-li vse ok
        {
          document.getElementById(element).innerHTML = xmlHttp.responseText;
        }
          else
        {
          document.getElementById(element).innerHTML = "<div class='chyba_reload'>Při načítání stránky došlo k chybě č. "+xmlHttp.status+" ["+xmlHttp.statusText+"] :) <p>Reloaduj stránku znovu, nebo běž na jinou sekci a tuhle skus znovu.</p></div>";
        }
      break;
    }
  }
}

function AjaxHledani(text)  //hledani
{
  var xmlHttp2 = CreateXmlHttpObject();
  if (xmlHttp2 == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var url = "ajax.php?fun=search&text=" + text + "&kid=" + Math.random();

  xmlHttp2.onreadystatechange = function(){ZmenaStavu4(xmlHttp2);};  //po dokoncení se zavola
  xmlHttp2.open("GET", url, true); //na serveru se zavola
  xmlHttp2.send(null); //a posle se to vsechno
}

function ZmenaStavu4(xmlHttp)
{
  var element = "mesg_search";  //id elementu

  if (document.getElementById(element) != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 0: //neinicializováno
        document.getElementById(element).innerHTML = "<div class='chyba_nenacteno'></div>"; //nacitani
      break;

      case 1: //nacitam v FF3 problikava
        //document.getElementById(element).innerHTML = "<div class='nacitam'></div>"; //nacitani
      break;

      case 2: //nacteno
        document.getElementById(element).innerHTML = "<div class='nacteno'></div>"; //nacitani
      break;

      case 3: //zpracovava
        document.getElementById(element).innerHTML = "<div class='zpracovavam'></div>"; //nacitani
      break;

      case 4: //kompletni
        if (xmlHttp.status == 200)  //je-li vse ok
        {
          document.getElementById(element).innerHTML = xmlHttp.responseText;
        }
          else
        {
          document.getElementById(element).innerHTML = "<div class='chyba_reload'>Při načítání stránky došlo k chybě č. "+xmlHttp.status+" ["+xmlHttp.statusText+"] :) <p>Reloaduj stránku znovu, nebo běž na jinou sekci a tuhle skus znovu.</p></div>";
        }
      break;
    }
  }
}

function AutoClick(cas, action, akce) //auto klikne za dany cas na danou adresu ajaxu
{
  setTimeout("AjaxStranka('" + action + "', '" + akce + "');", cas * 1000);
}

function Enter(event, element)  //zmackne dane ID
{
  if (event == null)
  {
    event = window.event;
  }

  if (event.keyCode == 13)
  {
    document.getElementById(element).click();
  }
}
