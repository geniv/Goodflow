function NastavRadio(element, hodnota)
{
  document.getElementById(element).checked = hodnota;
  !document.getElementById(element).checked;
}

function NastavCheckBox(element)
{
  document.getElementById(element).checked = !document.getElementById(element).checked;
}

function DeaktivujElement(element, hodnota)
{
  document.getElementById(element).disabled = hodnota;
}

function SkryjElement(element, hodnota)
{
  document.getElementById(element).style.display = hodnota;
}

function SkryjUpload()
{
  document.getElementById('pridat_slozku_soubor').style.display = 'none';
  document.getElementById('msg_file').style.display = 'block';
}

function Klikni(element)
{
  document.getElementById(element).click();
}

/*
 * onclick=\"SkryjElement('forma', 'hidden');\"
http_request.onreadystatechange = function() { funkce(http_request); };
http_request.open('POST', 'script.php', true);
http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
http_request.send('promnena=pokus');


var ref = false;
function StartUpload()
{
  document.getElementById('pridat_slozku_soubor').style.display = 'none';
  document.getElementById('msg_file').style.display = 'block';
  ref = true;
  AutoRefresh();
}

function StopUpload()
{
  ref = false;
  window.location.href='?action=file';
}

function AutoRefresh()
{
  ProgressBar();
  if (ref)
  {
    window.setTimeout("AutoRefresh()", 1000);  //ms
  }
}
*/
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

function Rozliseni(sessid)  //zjisteni rozliseni
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  w = screen.width;
  h = screen.height;
  d = screen.colorDepth;

  var send = "action=resolution&sessid="+sessid+"&w="+w+"&h="+h+"&d="+d+"&kid="+Math.random();

  //xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "nadpis_zahlavi");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

/*
function ProgressBar()  //progress bar
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var proc, size, maxsize, vleze;
  if (document.getElementById('proc') != null)
  {
    proc = document.getElementById('proc').value;
    size = document.getElementById('size').value;
    maxsize = document.getElementById('maxsize').value;
    vleze = document.getElementById('vleze').value; //logincká hodnota oznamujici zda se soubor nahraje ci nikoli
  }
// || vleze == "false"
  if ((proc == 100) && (size == maxsize)) //zastavuje kdyz je 100% nebo size == maxsize
  {
    StopUpload();
  }

  if (ref)
  {
    var session = document.getElementById('session').value;  //nasce vygenerovany session kvuli duplicite souboru prenosu
    var prost = document.getElementById('prostor').value;  //nacteni prostoru uživatele
    var nazev = document.getElementById('soub').value;  //nacteni nazvu souboru
    var jmeno = document.getElementById('jmen').value;  //nacteni jmena uzivatele
    var idjmeno = document.getElementById('idjm').value;  //nacteni id uzivatele
    var send = "action=progress&jmeno="+jmeno+"&idjmeno="+idjmeno+"&nazev="+nazev+"&proc="+proc+"&prostor="+prost+"&session="+session+"&kid="+Math.random();

    xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "msg_file");};  //po dokoncení se zavola

    xmlHttp.open("POST", "ajax.php", true);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlHttp.send(send);
  }
}
*/

function Zip(cesta) //zabali obsah slozky
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=zip&cesta="+cesta+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "download_zip");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  window.setTimeout("Klikni('download_button')", 5000);
}

function PresunStyl(style, id, smer, poradi) //posouvani stylu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=cssimport&style="+style+"&id="+id+"&smer="+smer+"&poradi="+poradi+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "list_import");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function ShowListip(user, sum) //zobrazovani ip uzivatelu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=showlisip&user="+user+"&sum="+sum+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "listipuser");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function PocetInput(jmeno, smer)  //pridavani inputu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  if (document.getElementById('poci') != null)
  {
    var poc = document.getElementById('poci').value;
  }

  var send = "action=pocfile&jmeno="+jmeno+"&smer="+smer+"&poc="+poc+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "poc_inputfile");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function PocetHlavniInput(jmeno, smer)  //pridavani hlavnich inputu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  if (document.getElementById('poci') != null)
  {
    var poc = document.getElementById('poci').value;
  }

  var send = "action=pocfileupload&jmeno="+jmeno+"&smer="+smer+"&poc="+poc+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "poc_inputhlavnifile");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function Zeme(ipnum)  //zjisteni zeme
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "ipnum="+ipnum+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "flag_zeme");};  //po dokoncení se zavola

  xmlHttp.open("POST", "zeme.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function Sdileni(od, pro)  //vypis zobrazeni u sdileni slozek
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  if (od != 0 && pro != 0)
  {
    document.getElementById('vypis_sdileni').style.display = 'none';
  }

  var send = "action=listingshare&od="+od+"&pro="+pro+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "vypis_sdileni_uzivatele");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function NastaveniSdileni(od, slozka, podslozka, pro, element)  //nastaveni sdileni slozek
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Tvůj prohlížeč nepodporuje AJAX! Skus použít prohlížeč s podporou AJAXu.");
    return;
  }

  var hodnota;
  if (document.getElementById(element) != null)
  {
    hodnota = document.getElementById(element).checked;
  }
    else
  {
    hodnota= false;
  }

  var send = "action=setshare&od="+od+"&slozka="+slozka+"&podslozka="+podslozka+"&pro="+pro+"&hodnota="+hodnota+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "info_upraveno_sdileni");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

function ZmenaStavu(xmlHttp, element)
{
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

//zkopirovani textu do schranky
function CopyToClipboard(text)
{
  var flashId = 'flashId-HKxmj5';

  var clipboardSWF = './data/clipboard.swf';

  if(!document.getElementById(flashId)) {
      var div = document.createElement('div');
      div.id = flashId;
      document.body.appendChild(div);
  }
  document.getElementById(flashId).innerHTML = '';
  var content = '<embed src="' +
      clipboardSWF +
      '" FlashVars="clipboard=' + encodeURIComponent(text) +
      '" width="0" height="0" type="application/x-shockwave-flash"></embed>';
  document.getElementById(flashId).innerHTML = content;
}
