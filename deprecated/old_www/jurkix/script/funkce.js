function kontrolaEmailu()
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

function AjaxStranka(action, akce, co, cislo) //web
{
  xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Your browser does not support AJAX!");
    return;
  }

  var url = "ajax.php?fun=web&action=" + action + "&akce=" + akce + "&co=" + co + "&cislo=" + cislo + "&kid=" + Math.random();

  xmlHttp.onreadystatechange = ZmenaStavu;  //po dokoncení se zavola
  xmlHttp.open("GET", url, true); //na serveru se zavola
  xmlHttp.send(null); //a posle se to vsechno
}

function ZmenaStavu()
{
  if (document.getElementById('obal_layout') != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 3: //pracuje
        document.getElementById('obal_layout').innerHTML = "Načítání..."; //nacitani
      break;

      case 4: //kompletni
        document.getElementById('obal_layout').innerHTML = xmlHttp.responseText;
      break;
    }
  }
}
/*
function AjaxGrafika(sekce)  //subsekce grafika
{
  xmlHttp1 = CreateXmlHttpObject();
  if (xmlHttp1 == null)
  {
    alert ("Your browser does not support AJAX!");
    return;
  }

  var url = "ajax.php?fun=grafika&sekce=" + sekce + "&kid=" + Math.random();

  xmlHttp1.onreadystatechange = ZmenaStavu1;  //po dokoncení se zavola
  xmlHttp1.open("GET", url, true); //na serveru se zavola
  xmlHttp1.send(null); //a posle se to vsechno
}

function ZmenaStavu1()
{
  switch (xmlHttp1.readyState) //osetreni navratovych kodu
  {
    case 3: //pracuje
      document.getElementById('vypis_grafiky').innerHTML = "Načítání..."; //nacitani
    break;

    case 4: //kompletni
      document.getElementById('vypis_grafiky').innerHTML = xmlHttp1.responseText;
    break;
  }
}
*/
function AjaxKontakt(jmeno, telefon, email, zprava)  //kontakt
{
  xmlHttp2 = CreateXmlHttpObject();
  if (xmlHttp2 == null)
  {
    alert ("Your browser does not support AJAX!");
    return;
  }

  var url = "ajax.php?fun=kontakt&jmeno=" + jmeno + "&telefon=" + telefon + "&email=" + email + "&zprava=" + zprava + "&kid=" + Math.random();

  xmlHttp2.onreadystatechange = ZmenaStavu2;  //po dokoncení se zavola
  xmlHttp2.open("GET", url, true); //na serveru se zavola
  xmlHttp2.send(null); //a posle se to vsechno
}

function ZmenaStavu2()
{
  switch (xmlHttp2.readyState) //osetreni navratovych kodu
  {
    case 3: //pracuje
      document.getElementById('mesg_kontakt').innerHTML = "Načítání..."; //nacitani
    break;

    case 4: //kompletni
      document.getElementById('mesg_kontakt').innerHTML = xmlHttp2.responseText;
    break;
  }
}

function AutoClick(cas, action, akce) //auto klikne za dany cas na danou adresu ajaxu
{
  setTimeout("AjaxStranka('" + action + "', '" + akce + "', '', '');", cas * 1000);
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
