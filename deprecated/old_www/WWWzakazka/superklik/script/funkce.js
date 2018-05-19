// JavaScript Document

//aplikace AJAXu
//
// name: CreateXmlHttpObject
// @param
// @return
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

//
// name: AjaxStranka
// @param
// @return
function AjaxStranka(kam)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=web&kam="+kam+"&w="+screen.width+"&h="+screen.height+"&d="+screen.colorDepth+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "main_form");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  if (kam == 'admin')
  {
    window.setTimeout("location.href='ajax.php?action=admin';", 1000);  //ms
  }
}

//
// name: Buben
// @param
// @return
function Buben(typ) //zvoli typ automatu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=buben&typ="+typ+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "flash_automat");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  Hodiny();
  InitJezdiciText();
}

//
// name: KontrolaPrihlaseni
// @param
// @return
function KontrolaPrihlaseni()
{
  if (document.getElementById('lista_prihlasovani') != null)
  {
    Login('', '');
  }
  //return (document.getElementById('lista_prihlasovani') != null ? false : true);
}

//
// name: Login
// @param
// @return
function Login(login, heslo) //prihlasovani uzivatelu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=login&login="+login+"&heslo="+heslo+"&w="+screen.width+"&h="+screen.height+"&d="+screen.colorDepth+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "reg_log");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  window.setTimeout("Buben('orig');", 1000);  //ms

  if (login != '' && heslo != '') //kdyz jsou pole neprazdne
  {
    AjaxStranka('log_on');
    window.setTimeout("AjaxStranka('');KontrolaPrihlaseni();", 3000);
    return;
  }
    else
  {
    if (login == '' && heslo == '') //kdyz jsou pole prazdne
    {
      AjaxStranka('');
      return;
    }

    if (login == '' || heslo == '') //kdyz je jedno z poli prazdne
    {
      AjaxStranka('log_err_only');
      window.setTimeout("AjaxStranka('');", 3000);
      return;
    }
  }
}

/*
  if (navigator.appName == "Microsoft Internet Explorer" &&
      parseInt(navigator.appVersion) >= 4)
  {
    //document.getElementById('reg_log').innerHTML = ;
  }

  //alert(navigator.appName);

  alert(navigator.appVersion);
  parseInt(navigator.appVersion)
  navigator.appName

  if (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) >= 4)
  {sekvence příkazů pro Explorer}
  else
  {příkazy pro jiné prohlížeče};
*/

//
// name: UnLogin
// @param
// @return
function UnLogin() //odhlaseni uzivatele
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=logoff&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "reg_log");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  Buben('demo');
  AjaxStranka('log_off');
  window.setTimeout("AjaxStranka('');", 3000);
}

//
// name: EditUser
// @param
// @return
function EditUser(id) //informace o uzvateli
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=edituser&id="+id+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "info_user");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}
/*
//
// name: DelUser
// @param
// @return
function DelUser(id) //informace o uzvateli
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=deluser&id="+id+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "info_user");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

//
// name: InfoUser
// @param
// @return
function InfoUser(id) //informace o uzvateli
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=infouser&id="+id+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "info_user");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}
*/
//
// name: PoslatAkci
// @param akce, id, element
// @return
function PoslatAkci(akce, id, element) //posle danou akci
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action="+akce+"&id="+id+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, element);};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  var action = akce.split("&", 1);
  action = action[0];

  //document.getElementById('pokus').innerHTML = action;  '<div id=\"pokus\"></div>'
  //window.setTimeout("", 3000);
  /*
  if (action == 'yesaddvyhry' ||
      action == '')
  {
    window.setTimeout("PoslatAkci('vypisbuben', 0, 'vypis_buben');PoslatAkci('poradibuben', 0, 'info_buben');", 3000);  //ms
  }
  */

  if (action == 'yesdeluser' ||
      action == 'yesedituser' ||
      action == 'yessendauthuser')
  { //obnova obsahu, vyprazdneni info divu
    window.setTimeout("PoslatAkci('vypisuser', 0, 'vypis_user');PoslatAkci('', 0, 'info_user');", 3000);  //ms
  }

  if (action == 'poradibuben')
  {
    window.setTimeout("location.reload(true);", 1);  //ms
  }

  if (action == 'yesaddpravidla' ||
      action == 'yeseditpravidla' ||
      action == 'yesdelpravidla')
  {
    window.setTimeout("PoslatAkci('vypispravidla', 0, 'vypis_pravidla');PoslatAkci('', 0, 'info_pravidla');", 3000);  //ms
  }

  if (action == 'yesaddvyhry' ||
      action == 'yeseditvyhry' ||
      action == 'yesdelvyhry')
  {
    window.setTimeout("PoslatAkci('vypisvyhry', 0, 'vypis_vyhry');PoslatAkci('', 0, 'info_vyhry');", 3000);  //ms
  }

  if (action == 'addobjednavkacenik')
  {
    window.setTimeout("PoslatAkci('', 0, 'info_objednavka');", 6000);  //ms
    document.getElementById('label_input_jmeno').value = '';
    document.getElementById('label_input_prijmeni').value = '';
    document.getElementById('label_input_ulice').value = '';
    document.getElementById('label_input_mesto').value = '';
    document.getElementById('label_input_psc').value = '';
    document.getElementById('label_input_telefon').value = '';
    document.getElementById('label_input_email').value = '@';
    document.getElementById('label_textarea_pozadavek').value = '';
  }

  if (action == 'yesdelobjednavka')
  {
    window.setTimeout("location.reload(true);", 3000);  //ms
  }

  if (action == 'yesaddceniksekce' ||
      action == 'yeseditceniksekce' ||
      action == 'yesdelceniksekce' ||
      action == 'yesdelcenikradek')
  {
    window.setTimeout("PoslatAkci('vypiscenik', 0, 'vypis_cenik');PoslatAkci('', 0, 'info_cenik');", 3000);  //ms
  }

  if (action == 'yesaddfaqsekce' ||
      action == 'yeseditfaqsekce' ||
      action == 'yesdelfaqsekce' ||
      action == 'yesaddfaqradek' ||
      action == 'yeseditfaqradek' ||
      action == 'yesdelfaqradek')
  {
    window.setTimeout("PoslatAkci('vypisfaq', 0, 'vypis_faq');PoslatAkci('', 0, 'info_faq');", 3000);  //ms
  }

  if (action == 'yesaddbaner' ||
      action == 'yeseditbaner' ||
      action == 'yesdelbaner')
  {
    window.setTimeout("PoslatAkci('vypisbaner', 0, 'vypis_baner');PoslatAkci('', 0, 'info_baner');", 3000);  //ms
  }

  if (action == 'yeseditvar' ||
      action == 'yesedittex' ||
      action == 'yesedittexbool')
  {
    window.setTimeout("location.reload(true);", 3000);  //ms
  }

  //location.href='#'; return false;
  //location.reload(true);/false
}

//
// name: Registrace
// @param
// @return
function Registrace(login, heslo, heslo1, email, jmeno, prijmeni, ulice, cp, psc, mesto, telefon, souhlas) //registrace
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var dot1 = document.getElementById('dot_1').value;
  var dot2 = document.getElementById('dot_2').value;
  var dot3 = document.getElementById('dot_3').value;
  var dot4 = document.getElementById('dot_4').value;

  var dotaz = "&dot1="+dot1+"&dot2="+dot2+"&dot3="+dot3+"&dot4="+dot4;

  var send = "action=registrace&login="+login+"&heslo="+heslo+"&heslo1="+heslo1+"&email="+email+"&jmeno="+jmeno+"&prijmeni="+prijmeni+"&ulice="+ulice+"&cp="+cp+"&psc="+psc+"&mesto="+mesto+"&telefon="+telefon+"&souhlas="+souhlas+"&w="+screen.width+"&h="+screen.height+"&d="+screen.colorDepth+dotaz+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "div_registrace");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  //window.setTimeout("AjaxStranka('');", 3000);  //ms
}

// Upravi udaje uzivatele
// name: UpravitUdaje
// @param
// @return
function UpravitUdaje(email, jmeno, prijmeni, ulice, cp, psc, mesto, telefon) //uprava udaju
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=edit&email="+email+"&jmeno="+jmeno+"&prijmeni="+prijmeni+"&ulice="+ulice+"&cp="+cp+"&psc="+psc+"&mesto="+mesto+"&telefon="+telefon+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "main_form");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);

  window.setTimeout("AjaxStranka('ax_info');", 3000);  //ms
}

//
// name: ZobrazitZpravu
// @paramv cislo zpravy,typ zpravy
// @return zprava
function ZobrazitZpravu(cislo, typ)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=zprava&cislo="+cislo+"&typ="+typ+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "zpravy_a_horoskopy_obal");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}

//
// name: ZobrazitHoroskop
// @paramv typ
// @return zprava
function ZobrazitHoroskop(typ)
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=horoskop&typ="+typ+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "zpravy_a_horoskopy_obal");};  //po dokoncení se zavola

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
          document.getElementById(element).innerHTML = "<div class='chyba_reload'>Při načítání stránky došlo k chybě č. "+xmlHttp.status+" ["+xmlHttp.statusText+"] :) <p>Reloaduj stránku znovu, nebo běž na jinou sekci a tuhle Zkus znovu.</p></div>";
        }
      break;
    }
  }
}

var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));

function VlozitDoTextu(element, cislo)
{
  var znacky = interpretsada;
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

//
// name: Enter
// @param
// @return
function Enter(event, element)
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

//
// name: UkazTlacitko
// @param
// @return
function UkazTlacitko(element, hodnota)
{
  if (document.getElementById(element) != null)
  {
    document.getElementById(element).disabled = hodnota;
  }
}

function Hodiny()
{
  element = "samotne_hodiny";
/*
  cesta = "obr/hodiny/";

  num = new Array();
  num[0] = "0.gif";
  num[1] = "1.gif";
  num[2] = "2.gif";
  num[3] = "3.gif";
  num[4] = "4.gif";
  num[5] = "5.gif";
  num[6] = "6.gif";
  num[7] = "7.gif";
  num[8] = "8.gif";
  num[9] = "9.gif";

  num["am"] = "am.gif";
  num["pm"] = "pm.gif";

  num["on"] = "con.gif";
  num["off"] = "coff.gif";
*/
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();
  var ampm = (hours < 12 ? "am" : "pm");

  var hodiny = (hours <= 9 ? ""+hours : ""+hours);
  h0 = hodiny.charAt(0);
  h1 = hodiny.charAt(1);

  var minuty = (minutes <= 9 ? "0"+minutes : ""+minutes);
  m0 = minuty.charAt(0);
  m1 = minuty.charAt(1);

  var sekundy = (seconds <= 9 ? "0"+seconds : ""+seconds);
  s0 = sekundy.charAt(0);
  s1 = sekundy.charAt(1);

  //obr =
  //"<img src="+cesta+num[h0]+" /><img src="+cesta+num[h1]+" /><img src="+cesta+num["on"]+" /><img src="+cesta+num[m0]+" /><img src="+cesta+num[m1]+" /><img src="+cesta+num["on"]+" /><img src="+cesta+num[s0]+" /><img src="+cesta+num[s1]+" /><img src="+cesta+num[ampm]+" />";

  cas = h0+h1+":"+m0+m1;

  if (document.getElementById(element) != null)
  {
    document.getElementById(element).innerHTML = cas;
  }

  window.setTimeout("Hodiny();",1000);
}

//puvodni univerzalni jezdici text
//viz: http://www.dynamicdrive.com/dynamicindex2/typescroll.htm
var longestmessage = 1;
var exist = false;

function InitJezdiciText()
{
  if (line[1] != null)
  {
    for (i = 2; i < line.length; i++)
    {
      if (line[i].length > line[longestmessage].length)
      {
        longestmessage = i;
      }
    }

    JezdiciText();

    exist = true;
  }
    else
  {
    exist = false;
    //var line = new Array();
  }
}

//Auto set scroller width
var tscroller_width = (exist ? line[longestmessage].length : 0);
var lines = line.length - 1;
//(exist ? line.length - 1 : 0);  //--Number of lines

var temp = "";
var nextchar =- 1;
var nextline = 1;
var cursor = "|";

function JezdiciText()
{
  if (temp == line[nextline] & temp.length == line[nextline].length & nextline!=lines)
  {
    nextline++;
    nextchar =- 1;
    if (document.getElementById('jezdici_text') != null)
    {
      document.getElementById('jezdici_text').innerHTML = temp;
    }
    temp = "";
    setTimeout("nextstep()", 1000)
  }
    else
  if (nextline == lines & temp==line[nextline] & temp.length == line[nextline].length)
  {
    nextline = 1;
    nextchar =- 1;
    if (document.getElementById('jezdici_text') != null)
    {
      document.getElementById('jezdici_text').innerHTML = temp;
    }
    temp = "";
    setTimeout("nextstep()", 1000)
  }
    else
  {
    nextstep()
  }
}

function nextstep()
{
/*
  if (cursor=="\\")
  {
    //cursor="|";
  }
    else
  if (cursor=="|")
  {
    //cursor="/";
  }
    else
  if (cursor=="/")
  {
    //cursor="-";
  }
    else
  if (cursor=="-")
  {
    //cursor="\\";
  }
*/
  nextchar++;
  temp += line[nextline].charAt(nextchar);
  if (document.getElementById('jezdici_text') != null)
  {
    document.getElementById('jezdici_text').innerHTML = temp + cursor;
  }
  setTimeout("JezdiciText();", 100);
}



/*
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>

<script language="JavaScript1.2">
<!--

//Secify scroller contents
var line=new Array()
line[1]="Hypernova - akce týdne - kuře vindalů - grilované 34,-Kč";

//Specify font size for scoller
var ts_fontsize="16px";

//--Don't edit below this line

var longestmessage=1
for (i=2;i<line.length;i++){
if (line[i].length>line[longestmessage].length)
longestmessage=i
}

//Auto set scroller width
var tscroller_width=line[longestmessage].length

lines=line.length-1 //--Number of lines

//if IE 4+ or NS6
if (document.all||document.getElementById){
document.write('<form name="bannerform">')
document.write('<input type="text" name="banner" size="'+tscroller_width+'"')
document.write(' style="background-color: '+document.bgColor+'; color: '+document.body.text+'; font-family: verdana; font-size: '+ts_fontsize+'; font-weight:bold; border: medium none" onfocus="blur()">')
document.write('</form>')
}

temp=""
nextchar=-1;
nextline=1;
cursor="|";
function animate()
{
  if (temp==line[nextline] & temp.length==line[nextline].length & nextline!=lines)
  {
    nextline++;
    nextchar=-1;
    document.bannerform.banner.value=temp;
    temp="";
    setTimeout("nextstep()",1000)
  }
    else
  if (nextline==lines & temp==line[nextline] & temp.length==line[nextline].length)
  {
    nextline=1;
    nextchar=-1;
    document.bannerform.banner.value=temp;
    temp="";
    setTimeout("nextstep()",1000)
  }
    else
  {
    nextstep()
  }
}

function nextstep()
{
  if (cursor=="\\")
  {
    //cursor="|";
  }
    else
  if (cursor=="|")
  {
    //cursor="/";
  }
    else
  if (cursor=="/")
  {
    //cursor="-";
  }
    else
  if (cursor=="-")
  {
    //cursor="\\";
  }

  nextchar++;
  temp += line[nextline].charAt(nextchar);
  document.bannerform.banner.value = temp + cursor;
  setTimeout("animate()", 100);
}

//if IE 4+ or NS6
if (document.all || document.getElementById)
  window.onload=animate
// -->
</script>

</body>
</html>
*/


/*
//
// name: VlozitText
// @param
// @return
function VlozitText(text) //
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "action=inputtext&text="+text+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "vypis_zpravy_horoskopy");};  //po dokoncení se zavola

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlHttp.send(send);
}
*/
/*
function NastavRadio(element, hodnota)
{
  document.getElementById(element).checked = hodnota;
}

function DeaktivujElement(element, hodnota)
{
  document.getElementById(element).disabled = hodnota;
}

function SkryjElement(element, hodnota)
{
  document.getElementById(element).style.display = hodnota;
}

/ *
 * onclick=\"SkryjElement('forma', 'hidden');\"
http_request.onreadystatechange = function() { funkce(http_request); };
http_request.open('POST', 'script.php', true);
http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
http_request.send('promnena=pokus');
* /

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
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
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

function ProgressBar()  //progress bar
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var proc, size, maxsize, vleze;
  if (document.getElementById('proc') != null)
  {
    proc = document.getElementById('proc').value;
    size = document.getElementById('size').value;
    maxsize = document.getElementById('maxsize').value;
    vleze = document.getElementById('vleze').value; //logincká hodnota oznamujici zda se soubor ahraje ci nikoli
  }
// || vleze == "false"
  if ((proc == 100 && size == maxsize))
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

function PresunStyl(style, id, smer, poradi) //posouvani stylu
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
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
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
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
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
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

function Zeme(ipnum)  //zjisteni zeme
{
  var xmlHttp = CreateXmlHttpObject();
  if (xmlHttp == null)
  {
    alert ("Váš prohlížeč nepodporuje AJAX, zkuste použít prohlížeč s podporou AJAXu.");
    return;
  }

  var send = "ipnum="+ipnum+"&kid="+Math.random();

  xmlHttp.onreadystatechange = function(){ZmenaStavu(xmlHttp, "flag_zeme");};  //po dokoncení se zavola

  xmlHttp.open("POST", "zeme.php", true);
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
          document.getElementById(element).innerHTML = "<div class='chyba_reload'>Při načítání stránky došlo k chybě č. "+xmlHttp.status+" ["+xmlHttp.statusText+"] :) <p>Reloaduj stránku znovu, nebo běž na jinou sekci a tuhle Zkus znovu.</p></div>";
        }
      break;
    }
  }
}
*/
