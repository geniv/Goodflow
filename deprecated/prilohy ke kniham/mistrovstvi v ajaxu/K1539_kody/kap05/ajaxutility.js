/*
                   Ajax Utility JavaScript Library

  Knihovna JavaScriptu pro práci s Ajaxem.

  Umístěte soubor ajaxutility.js do stejného adresáře, ve kterém se nachází webová 
  stránka a vložte následující kód do elementu <head> stránky:

  <script type = "text/javascript" src = "ajaxutility.js"></script>

  Knihovna nabízí následující funkce: 

  ziskejText(url, callbackFunkce) 
    Pomocí metody GET získá text ze serveru. 

  ziskejXml(url, callbackFunkce) 
    Pomocí metody GET získá dokument XML ze serveru. 

  odesliDataZiskejText(url, data, callbackFunkce) 
    Pomocí metody POST odešle data serveru a získá nazpět text. 
    Předávejte data, která se mají odeslat, jako páry parametr/hodnota, např. "parametr=100".

  odesliDataZiskejXml(url, data, callbackFunkce) 
    Pomocí metody POST odešle data serveru a získá nazpět dokument XML. 
    Předávejte data, která se mají odeslat, jako páry parametr/hodnota, např. "parametr=100".

*/

function ziskejText(url, callbackFunkce)
{ 
  var XMLHttpRequestObjekt = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObjekt = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObjekt = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObjekt) {
    XMLHttpRequestObjekt.open("GET", url); 

    XMLHttpRequestObjekt.onreadystatechange = function() 
    { 
      if (XMLHttpRequestObjekt.readyState == 4 && 
        XMLHttpRequestObjekt.status == 200) { 
          callbackFunkce(XMLHttpRequestObjekt.responseText); 
          delete XMLHttpRequestObjekt;
          XMLHttpRequestObjekt = null;
      } 
    } 

    XMLHttpRequestObjekt.send(null); 
  }
}

function ziskejXml(url, callbackFunkce)
{ 
  var XMLHttpRequestObjekt = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObjekt = new XMLHttpRequest();
    XMLHttpRequestObjekt.overrideMimeType("text/xml");
  } else if (window.ActiveXObject) {
    XMLHttpRequestObjekt = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObjekt) {
    XMLHttpRequestObjekt.open("GET", url); 

    XMLHttpRequestObjekt.onreadystatechange = function() 
    { 
      if (XMLHttpRequestObjekt.readyState == 4 && 
        XMLHttpRequestObjekt.status == 200) { 
          callbackFunkce(XMLHttpRequestObjekt.responseXML); 
          delete XMLHttpRequestObjekt;
          XMLHttpRequestObjekt = null;
      } 
    } 

    XMLHttpRequestObjekt.send(null); 
  }
}

function odesliDataZiskejText(url, data, callbackFunkce)
{ 
  var XMLHttpRequestObjekt = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObjekt = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObjekt = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObjekt) {
    XMLHttpRequestObjekt.open("POST", url); 
    XMLHttpRequestObjekt.setRequestHeader('Content-Type', 
      'application/x-www-form-urlencoded'); 

    XMLHttpRequestObjekt.onreadystatechange = function() 
    { 
      if (XMLHttpRequestObjekt.readyState == 4 && 
        XMLHttpRequestObjekt.status == 200) {
          callbackFunkce(XMLHttpRequestObjekt.responseText); 
          delete XMLHttpRequestObjekt;
          XMLHttpRequestObjekt = null;
      } 
    }

    XMLHttpRequestObjekt.send(data); 
  }
}

function odesliDataZiskejXml(url, data, callbackFunkce)
{ 
  var XMLHttpRequestObjekt = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObjekt = new XMLHttpRequest();
    XMLHttpRequestObjekt.overrideMimeType("text/xml");
  } else if (window.ActiveXObject) {
    XMLHttpRequestObjekt = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObjekt) {
    XMLHttpRequestObjekt.open("POST", url); 
    XMLHttpRequestObjekt.setRequestHeader('Content-Type', 
      'application/x-www-form-urlencoded'); 

    XMLHttpRequestObjekt.onreadystatechange = function() 
    { 
      if (XMLHttpRequestObjekt.readyState == 4 && 
        XMLHttpRequestObjekt.status == 200) {
          callbackFunkce(XMLHttpRequestObjekt.responseXML);
          delete XMLHttpRequestObjekt;
          XMLHttpRequestObjekt = null;
      } 
    }

    XMLHttpRequestObjekt.send(data); 
  }
}


