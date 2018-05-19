var urlcesta = "http://geniv-laptop/phplayout/modules/dynamic_picture_gallery/";

/**
 * Vytvoreni tridy ajaxu
 * @return objekt ajaxu
 */
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

/**
 * Vykonavaci fukce, posila instrukce na server
 * @param text vstupni text
 */
function PoctadloZobrazeni(id)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=pocitadlo&id="+id+"&kid="+Math.random();

  //xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "pokus");};  //po dokonceni se zavola

  xmlHttp.open("POST", urlcesta + "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

/**
 * Vykonavaci fukce, posila instrukce na server
 * @param text vstupni text
 */
function RozkliknutiPolozky(id, element)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=rozkliknuti&id="+id+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, element);};  //po dokonceni se zavola

  xmlHttp.open("POST", urlcesta + "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

/**
 * Samotna zmena stavu
 * @param xmlHttp vstupni objekt ajaxu
 * @param element ID vystupnho elementu
 */
function ZmenaStavu(xmlHttp, element)
{
  element1 = element+"_fin";

  if (document.getElementById(element) != null)
  {
    switch (xmlHttp.readyState) //osetreni navratovych kodu
    {
      case 4: //kompletni
        if (xmlHttp.status == 200)  //je-li vse ok
        {
          document.getElementById(element).innerHTML = xmlHttp.responseText;
        }
      break;
    }
  }
}
