
var gCCompIDs = ''
var gCCompnTree = 1 //?????TS????? specialita elektrosveta
var gxdiv
var gxprev


// KOMPATIBILITA

var Br = new BrCheck()

function BrCheck()
{
	this.VER	= navigator.appVersion;
	this.AGENT	= navigator.userAgent;
	this.DOM	= document.getElementById ? true:false;

	this.OP5	= this.AGENT.indexOf("Opera 5")>-1							?true:false;
	this.OP6	= this.AGENT.indexOf("Opera 6")>-1							?true:false;
	this.OP7	= this.AGENT.indexOf("Opera 7")>-1							?true:false;
	this.OP		= (this.OP5 || this.OP6 || this.OP7);

	this.IE4	= (document.all && !this.DOM && !this.OP)					?true:false;
	this.IE5	= (this.VER.indexOf("MSIE 5")>-1 && this.DOM && !this.OP)	?true:false; 
	this.IE6	= (this.VER.indexOf("MSIE 6")>-1 && this.DOM && !this.OP)	?true:false;
	this.IE		= (this.IE4 || this.IE5 || this.IE6);

	this.NS4	= (document.layers && !this.DOM)							?true:false;
	this.NS7	= (this.DOM && parseInt(this.VER) >= 5 && this.AGENT.lastIndexOf('Netscape')<this.AGENT.lastIndexOf('7'))?true:false;
	this.NS6	= (this.DOM && parseInt(this.VER) >= 5 && !this.NS7)		?true:false;
	this.NS		= (this.NS4 || this.NS6 || this.NS7);

	return this;
}

function getE(objectID) {
	return document.getElementById(objectID);
}

function getF(formName) {
	return document.forms[formName];
}

function getFEx(formName, oDocument) {
	return oDocument.forms[formName];
}

function getEEx(objectID, oDocument) {
	return oDocument.getElementById(objectID);
}

function checkemptyinputs(){
	var objForm = document.forms.aform;
	
	for(var i = 0; i < document.forms.aform.length; i ++){
		if(document.forms.aform[i].value == "" || document.forms.aform[i].value == " "){
			document.forms.aform[i].disabled = true;
		}	
	}
	return true
}

function frmOnLoad()
{
	//var foo;
	var xx = ExtractCookies('XSubC');
	VisibDiv(xx);
}

function CheckItem(){
	var objForm = document.forms.additem;
	if(objForm){
		if(objForm.NameItem.value == ""){
			alert('Vyplòte prosím název položky, kterou chcete vložit do košíku!');
			return false
		}else{
			return true
		}
	}else{
		return false
	}
}

function loadpayments(form){
	for(var y = 0;y < form.length;y++){
		form[y].disabled = true;
		document.getElementById(form[y].value).style.display = "block";
	}
}



function changedelivery(DeliveryName, sAlert, price){
	var pole, html = "";
	var sPlatba;
	var paymentfrm = document.forms.OrderForm.payment;
	var arrpayment="";
	
	loadpayments(paymentfrm)

	if(arrP[DeliveryName]){
		pole = arrP[DeliveryName].split("|");
		for(var i = 0;i<pole.length;i++){
			if(pole[i] != ""){
				arrpayment = arrpayment + pole[i] + '|'
			}
		}
	}
	var re = "";

	for(var y = 0;y < paymentfrm.length;y++){		
		if(arrpayment.search(paymentfrm[y].value) > -1){
			
			
			if(price > 30000 && paymentfrm[y].value == 'Dobírkou' && DeliveryName == 'Pošta'){
			}else{
				paymentfrm[y].disabled = false;
				paymentfrm[y].checked = false;
			}
		}else{
			document.getElementById(paymentfrm[y].value).style.display = "none";
			paymentfrm[y].checked = false;
		}	
	}	

	alert(sAlert);
	
}
function PaymentAlert(sPlatba){
	re = /###/g
	alert(sPlatba.replace(re,'\n'));
}

function ControlDataOrder(){

	var delivery = document.OrderForm.delivery;
	var bDeliverySelect = false;
	var payment = document.OrderForm.payment;
	var bPaymentSelect = false;
	
	for (var i = 0; i < delivery.length;i++){if(delivery[i].checked){bDeliverySelect = true;}}
	for (var i = 0; i < payment.length;i++){if(payment[i].checked){bPaymentSelect = true;}}

	if(bDeliverySelect &&  bPaymentSelect){return true;}
	if(!bDeliverySelect){alert('Zvolte zpùsob doruèení!');return false;}
	if(!bPaymentSelect){alert('Zvolte zpùsob platby!');return false;}
}

function LoadCat(pkCat, nRealCat){
	
	var oIfr	= document.getElementById('subc');
	var oDiv	= document.getElementById('s' + pkCat);
	
	oIfr.src	= '/subm.asp?CatID=' + pkCat + '&kategorie=' + nRealCat;
}

function Trim(s) 
{
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }
  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}

function CCompChCli(o)
{
	var mess = "";
	var name = o.name;
	if (o)
	

	if (o.checked==true)
	{
		if (gCCompIDs.indexOf('|'+o.value+'|') < 0)
			gCCompIDs += '|'+o.value+'|'

		if (gCCompIDs != '')
			CCompOn()
		mess = "Položka " + name + " byla pøidána k porovnávání!\nPorovnávací tabulku zobrazíte tlaèítkem ‘Porovnat‘."		
	}
	else
	{
		gCCompIDs = gCCompIDs.replace('|'+o.value+'|', '')

		if (gCCompIDs == '')
			CCompOff()
		mess = "Položka " + name + " byla odebrána z porovnávání!"		
	}
	
	InsertCookies('CComp',gCCompIDs)
	alert(mess);
}

function CCompChOn()
{
	var ch = document.all.idCComp

	for (var i=0; i<ch.length; i++)
		if (gCCompIDs.indexOf('|'+ch[i].value+'|') > -1)
			ch[i].checked = true
}

function CCompChOff()
{
	var ch = document.all.idCComp

	for (var i=0; i<ch.length; i++)
		ch[i].checked = false
}

function CCompGo()
{
	var q = gCCompIDs
	
	while(q.indexOf('||') > -1) q = q.replace('||', ',')
	while(q.indexOf('|') > -1) q = q.replace('|', '')
	
	if (gCCompIDs=='')	alert('Nejsou vybrány žádné produkty k porovnávání.')
	else window.open ('/Compare.asp?DPGS='+q, 'Porovnavani','toolbar=1, location=1, directories=1, status=1, menubar=1, scrollbars=1, resizable=1')

//document.location = '/Compare.asp?DPGS='+q
}


function CCompOn()
{
	var im = document.all.idCCompGo
	var de = document.all.idCCompDel

	if (im)
	{
		im.src = im.src.replace('_CCmp.gif', '_CCmpEnable.gif')
		im.style.cursor = 'pointer'
		im.alt = 'Porovnej vybrané zboží'
	}
		
	if (de)
	{
		de.className = 'show'
		de.style.cursor = 'hand'
	}
}


function CCompOff()
{
	var im = document.all.idCCompGo
	var de = document.all.idCCompDel

	if (im)
	{
		im.src = im.src.replace('_CCmpEnable.gif', '_CCmp.gif')
		im.style.cursor = ''
		im.alt = 'Zaškrtnìte nejprve zboží k porovnání'
	}
	if (de)
	{
		de.className = 'hide'
		de.style.cursor = 'hand'
	}
}


function CCompStartup()
{
//	gCCompnTree = nTree.toString()
	gCCompIDs = ExtractCookies('CComp').replace('none','')
//	gCCompIDs = ExtractCookies('CComp1').replace('none','')

	if (gCCompIDs != '')
	{
		CCompOn()
		CCompChOn()
	}
}


function CCompDel()
{
	gCCompIDs = ''
	InsertCookies('CComp',gCCompIDs)
	CCompOff()
	CCompChOff()
}
//----------------------------------------------

function formsubmit(formname){
	document.forms[formname].submit();
}


function OpenWnd(strURL){
         var objWnd = window.open(strURL,"InfoDetail","scrollbars=no,height=500,width=400,left=10,top=10");
         objWnd.focus();
}

function OpenWndXY(strURL, Y, X){
	var swindowname = "info";
	var sParameters = "scrollbars=yes,height=" + Y + ",width=" + X
//
//
         var objWnd = window.open(strURL,swindowname,sParameters);
         objWnd.focus();
}

function ControlNumber(){
     if ((event.keyCode <48) || (event.keyCode >57)) event.returnValue = false;
}
//----------info okno-------------------------------------------------------
function InfoWindow(strAddress) {
       showModalDialog(strAddress,"Info","status:no; center:yes; help:no; minimize:no;dialogWidth=450pt;dialogHeight=320pt");
}
function WriteDate(){
    var strDay=new Date();
    var d=strDay.getDay();
    if (d==1) {document.writeln('pondìlí') }
    else { if (d==2) {document.writeln('úterý') }
    else { if (d==3) {document.writeln('støeda') }
    else { if (d==4) {document.writeln('ètvrtek') }
    else { if (d==5) {document.writeln('pátek') }
    else { if (d==6) {document.writeln('sobota') }
    else { if (d==0) {document.writeln('nedìle') }}}}}}};
    document.writeln(strDay.getDate(),'.',strDay.getMonth()+1,'.',strDay.getFullYear());
    }
function EmailControl(f){
    if ((f=='' || f=='vas@email.cz') ||(f.indexOf('@') < 1 || f.indexOf('@') != f.lastIndexOf('@') || f.lastIndexOf('.') < f.lastIndexOf('@')+2  || f.lastIndexOf('.') > (f.length-3) || f.lastIndexOf('.') < (f.length-4))){
       alert('Nesprávný formát e-mailu');
       return false;
       }
    return true;
}
function ShowSearchMenu(x){
	//alert(document.getElementByID('searchtable'));
    if (x == 1){
	document.getElementById('searchtable').style.display = 'block';
    }else{
	document.getElementById('searchtable').style.display = 'none';
    }
}
function PositionInfo(strText, strCode){
    document.getElementById('StateInfo3').innerHTML=strText;
    document.getElementById('StateInfo2').innerHTML="  probíhá pøipojování...";
    var e = document.getElementById(strCode);//event.srcElement;
    var y = 0;
    var x = findPosX(e);//event.clientX;

    while (typeof e == 'object' && e.tagName != 'BODY'){
          y += e.offsetTop;
          e = e.offsetParent;
    };
    document.getElementById('StateInfo1').style.top=y-140;
    if (document.body.clientWidth < 933){
      document.getElementById('StateInfo1').style.left=x-175;
    }else{
      document.getElementById('StateInfo1').style.left=680;
    }
}

function findPosX(obj){
	var curleft = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
		return curleft;
	
}

function findPosY(obj){
	var curtop = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
		return curtop;
}


function LocState(strCode,intCount){
    window.parent.frames['WinStat'].location.href="/InfoState.asp?ID="+strCode+"&CN="+intCount
    PositionInfo("On-line stav",strCode);
    return false
}
function ChangeStorage(bState){
    if(bState){
        for(var i = 0; i < document.all['S'].length; i++){
            document.all['S'][i].value="0"
        }
    }else{
        for(var i = 0; i < document.all['S'].length; i++){
            document.all['S'][i].value="-1"
        }

    }
}
function ChangeCloseout(bState){
    if(bState){
        for(var i = 0; i < document.all['C'].length; i++){
            document.all['C'][i].value="1"
        }
    }else{
        for(var i = 0; i < document.all['C'].length; i++){
            document.all['C'][i].value="3"
        }

    }
}

function ControlUserDataSubmit(){
  if((document.UserDataForm.FirstName.value == "" ||document.UserDataForm.LastName.value == "")& document.UserDataForm.Firm.value == ""){alert("Vyplòte název firmy nebo jméno a pøíjmení.");return false}
  if(document.UserDataForm.Street.value == ""){alert("Vyplòte ulici.");return false}
  if(document.UserDataForm.City.value == ""){alert("Vyplòte mìsto.");return false}
  if(document.UserDataForm.ZipCode.value == ""){alert("Vyplòte PSÈ.");return false}
  if(document.UserDataForm.Phone.value == ""){alert("Vyplòte telefon.");return false}
  if(document.UserDataForm.Email.value == ""){alert("Vyplòte email.");return false}
  if(document.UserDataForm.Login.value == ""){alert("Vyplòte pøihlašovací jméno.");return false}
  if(document.UserDataForm.Login.value.length < 8){alert("Pøihlašovací jméno musí mít minimálnì 8 znakù.");return false}
  if(document.UserDataForm.Password.value == ""){alert("Vyplòte heslo.");return false}
  if(document.UserDataForm.Password.value.length < 8){alert("Heslo musí mít minimálnì 8 znakù.");return false}
  return true
}

function ControlPassword(NameOne,NameTwo){
  if (document.all[NameOne].value != document.all[NameTwo].value){
  alert("Špatnì zadané heslo.");
  document.all[NameOne].value = "";
  document.all[NameTwo].value = "";
  document.all[NameOne].focus();
  return false;
  }else{
  return true;
  }
}

//---------------------- prekopirovano z elektrosvet.cz
function AddBuy(strName, intPrice, intDph, strCode) {
        var strData,strReturn
        strData = strName+"&"+intPrice+"&"+intDph+"&"+strCode
        strReturn = showModalDialog("/AddUpdBuy.asp",strData,"status:no; center:yes; help:no; minimize:no;dialogWidth=350pt;dialogHeight=200pt");
        if (strReturn == "1"){ActionCookies('BZbuy')
        }else if (strReturn == "2"){window.location.href="/order.asp"}
}
function AddBuyDetail(strName, intPrice, intDph, strCode) {
        var strData,strReturn
        strData = strName+"&"+intPrice+"&"+intDph+"&"+strCode
        strReturn = showModalDialog("/AddUpdBuy.asp",strData,"status:no; center:yes; help:no; minimize:no;dialogWidth=350pt;dialogHeight=200pt");
        if (strReturn == "1"){
                        window.opener.ActionCookies('BZbuy')
        }else if (strReturn == "2"){
                        window.opener.location.href="/order.asp";
                        window.close();
                }
}
function ActionCookies(strName){
        var strString,strSum1,strSum2,intSuma;
        strSum2 = new Array();
        intSuma = 0;

        strString = ExtractCookies(strName);
        if (strString > ""){
                strSum1 = strString.split("#");
                for (var i=0; i< strSum1.length-1; i++){
                              strSum2[i] = strSum1[i].split("&");
                        intSuma += BarterComma(strSum2[i][1])*BarterComma(strSum2[i][4]);
                }
                document.all.CompletPrice.value =  FormatNumber(intSuma);
        }
}

function DeleteCookies(strName){
        var vyprs=new Date();
        vyprs.setDate(vyprs.getDate() - 365);
        document.cookie=strName+"=; expires="+vyprs.toGMTString()+";";
        vyprs.setDate(365 + 365 + vyprs.getDate());
        document.cookie=strName+"=; expires="+vyprs.toGMTString()+";";
        document.all.CompletPrice.value = "0.00";
}
function InsTreeCook(intId,idTree){
        var vyprs=new Date();
        vyprs.setDate(vyprs.getDate() - 365);
        document.cookie="category"+idTree+"="+intId+"; expires="+vyprs.toGMTString()+";";
        vyprs.setDate(365 + 365 + vyprs.getDate());
        document.cookie="category"+idTree+"="+intId+"; expires="+vyprs.toGMTString()+";";
}
function InsertCookies(strName,strData){
        var vyprs=new Date();
        vyprs.setDate(vyprs.getDate() - 365);
        document.cookie=strName+"="+strData+"; expires="+vyprs.toGMTString()+";";
        vyprs.setDate(365 + 365 + vyprs.getDate());
        document.cookie=strName+"="+strData+"; expires="+vyprs.toGMTString()+";";
}

function ExtractCookies(strName){
        var cookieList=document.cookie.split("; ");
        var cookieArray = new Array();
        var name = "#"
        for (var i=0; i < cookieList.length; i++){
                if(cookieList[i].indexOf(strName)>-1){
                      if( cookieList[i].indexOf("=")>-1){name = cookieList[i].split("=");}
                 }
        }
        if (name != "#"){
                        return name[1];
        }else{
                        return "none";
        }
}

function ParseCookies(strName){
        var strCook = ExtractCookies(strName)
        if (strCook != "none"){
                var strList = strCook.split("a");
                for (var i=0; i < strList.length-1; i++){
                  if(typeof(document.all[strList[i]+'a']) == "object"){document.all[strList[i]+'a'].click();}
                }
     }
}
function FormatNumber(text){
        var mezi = BarterComma(text);
        mezi = ''+Math.round(parseFloat(mezi) * 100);
        var desetiny = mezi.substring(mezi.length-2, mezi.length);
        var cele = mezi.substring(0,mezi.length-2);
        if (parseFloat(mezi) < 1){
                var mezi = "0."+desetiny;
        }else{
                var mezi = cele+"."+desetiny;
        }
        return mezi;
}
function BarterComma(text){
        var mezi = ''+text;
        if (mezi.indexOf(',') != -1){
                mezi = mezi.split(",");
                mezi = mezi[0]+"."+mezi[1];
        }else{
                mezi = text;
        }
        return parseFloat(mezi);
}
function ControlNumber(){
     if ((event.keyCode <48) || (event.keyCode >57)) event.returnValue = false;
}
//----------info okno-------------------------------------------------------
function InfoWindow(strAddress) {
       showModalDialog(strAddress,"Info","status:no; center:yes; help:no; minimize:no;dialogWidth=450pt;dialogHeight=320pt");
}
function WriteDate(){
    var strDay=new Date();
    var d=strDay.getDay();
    if (d==1) {document.writeln('pondìlí') }
    else { if (d==2) {document.writeln('úterý') }
    else { if (d==3) {document.writeln('støeda') }
    else { if (d==4) {document.writeln('ètvrtek') }
    else { if (d==5) {document.writeln('pátek') }
    else { if (d==6) {document.writeln('sobota') }
    else { if (d==0) {document.writeln('nedìle') }}}}}}};
    document.writeln(strDay.getDate(),'.',strDay.getMonth()+1,'.',strDay.getFullYear());
    }
function EmailControl(f){
    if ((f=='' || f=='vas@email.cz' || f=='váš@email.cz' || f=='na@email.cz') ||(f.indexOf('@') < 1 || f.indexOf('@') != f.lastIndexOf('@') || f.lastIndexOf('.') < f.lastIndexOf('@')+2  || f.lastIndexOf('.') > (f.length-3) || f.lastIndexOf('.') < (f.length-5))){
       alert('Nesprávný formát emailu');
       return false;
       }
    return true;
}
//function ShowSearchMenu(x){
 //   if (x == 1){
  //      document.all.SearchTable.style.display='';
   // }else{
    //    document.all.SearchTable.style.display='none';
    //}
//}
//function LocInfo(){
 //   document.getElementById('StateInfo2').innerHTML="  probíhá pøipojování...";
 //   var e = event.srcElement;
 ///   var y = 0;
//    var x = 0;
//    while (typeof e == 'object' && e.tagName != 'BODY'){
 //         y += e.offsetTop;
 //         e = e.offsetParent;
//    };
 //   x = (window.screen.width/2)+375
 //   document.getElementById('StateInfo1').style.top=y-140;
  //  document.getElementById('StateInfo1').style.left=x;
//}

//function (strText){
//    document.all.StateInfo3.innerHTML=strText;
//    document.all.StateInfo2.innerHTML="  probíhá pøipojování...";
//    var e = event.srcElement;
//    var y = 0;
//    var x = event.clientX;
 //   while (typeof e == 'object' && e.tagName != 'BODY'){
//          y += e.offsetTop;
 //         e = e.offsetParent;
   // };
   // document.all.StateInfo1.style.top=y-140;
   // if (document.body.clientWidth < 933){
   //   document.all.StateInfo1.style.left=x-175;
   // }else{
   //   document.all.StateInfo1.style.left=780;
   // }
//}
//unction LocState(strCode,intCount){
//    window.parent.frames['WinStat'].location.href="/InfoState.asp?ID="+strCode+"&CN="+intCount
//    LocInfo("On-line stav");
//}
function ChangeStorage(bState){
    if(bState){
        for(var i = 0; i < document.all['S'].length; i++){
            document.all['S'][i].value="0"
        }
    }else{
        for(var i = 0; i < document.all['S'].length; i++){
            document.all['S'][i].value="-1"
        }

    }
}
function ChangeCloseout(bState){
    if(bState){
        for(var i = 0; i < document.all['C'].length; i++){
            document.all['C'][i].value="1"
        }
    }else{
        for(var i = 0; i < document.all['C'].length; i++){
            document.all['C'][i].value="3"
        }

    }
}

function ControlUserDataSubmit(){
    if((document.UserDataForm.FirstName.value == "" ||document.UserDataForm.LastName.value == "")& document.UserDataForm.Firm.value == ""){alert("Vyplòte název firmy nebo jméno a pøíjmení.");return false}
    if(document.UserDataForm.Street.value == ""){alert("Vyplòte ulici.");return false}
    if(document.UserDataForm.City.value == ""){alert("Vyplòte mìsto.");return false}
    if(document.UserDataForm.ZipCode.value == ""){alert("Vyplòte PSÈ.");return false}
    if(document.UserDataForm.Phone.value == ""){alert("Vyplòte telefon.");return false}

  if(document.UserDataForm.Login)
  {
    if(document.UserDataForm.Login.value == ""){alert("Vyplòte uživatelské jméno.");return false}
    if(document.UserDataForm.Login.value.length < 5){alert("Uživatelské jméno musí mít minimálnì 5 znakù.");return false}
  }
  if(document.UserDataForm.Password)
  {
    if(document.UserDataForm.Password.value == ""){alert("Vyplòte heslo.");return false}
    if(document.UserDataForm.Password.value.length < 5){alert("Heslo musí mít minimálnì 5 znakù.");return false}
  }
  return true
}


//function ControlDataOrder(nNoRegister){
 //   if(nNoRegister==1)
 //   {
  //      if(document.OrderForm.FirstName.value == "" ||document.OrderForm.LastName.value == ""){alert("Vyplòte jméno a pøíjmení.");return false}
   //     if(document.OrderForm.Street.value == ""){alert("Vyplòte ulici.");return false}
   //     if(document.OrderForm.City.value == ""){alert("Vyplòte mìsto.");return false}
   //     if(document.OrderForm.ZipCode.value == ""){alert("Vyplòte PSÈ.");return false}
   //     if(document.OrderForm.Phone.value == ""){alert("Vyplòte telefon.");return false}
   // }
  
//    if(document.OrderForm.DeliveryType.value == "-"){alert("Vyberte zpùsob dopravy.");document.OrderForm.DeliveryType.focus();return false}
//    if(document.OrderForm.PaymentType.value == "-"){alert("Vyberte zpùsob platby.");document.OrderForm.PaymentType.focus();return false}

//  return true
//}

function UnleashHideSpecial(objcheck, objHiddenTd, objsubcheck, objSubHiddenTd)
{
if(document.all[objcheck].checked == true && document.all[objHiddenTd].style.display == "none")
	{
		if(document.all[objsubcheck].checked == true && document.all[objcheck].checked == true)
			{
			document.all[objSubHiddenTd].style.display = "block";
			}
		document.all[objHiddenTd].style.display = "block";
	} 
else if(document.all[objcheck].checked == false && document.all[objHiddenTd].style.display == "block")
	{
		document.all[objSubHiddenTd].style.display = "none";
		document.all[objHiddenTd].style.display = "none";
	}
else
	{
		document.all[objSubHiddenTd].style.display = "none";
		document.all[objHiddenTd].style.display = "none";
	}
}
//******************************************************************************
function formatNumber(nNumber)
{

    if(!isNaN(nNumber))
    {
        
        var re=/ /g;
        var sOUT="";
        var sPIN=nNumber.toString();
        var sPINdec='';
        var nCount=0

        if(sPIN.indexOf(".")!=-1)
        {
            sPINdec=sPIN.substring(sPIN.indexOf(".")+1,sPIN.length)   
            sPIN=sPIN.substring(0,sPIN.indexOf("."))   

            sPINdec=sPINdec.substring(0,2)
            for(var i=sPINdec.length;i<2;i++){sPINdec+="0"}
        }
        else
        {
            sPINdec="00";   
        }

        for(var i=sPIN.length-1;i>=0;i--)
        {
        	sOUT=sPIN.charAt(i)+sOUT;

        	if(((sOUT.length-nCount)%3)==0)
        	{
        		sOUT=" "+sOUT;
        		nCount=nCount+1;
        	}
        }


        sOUT+=","+sPINdec;
        sOUT=sOUT.replace(re,"&nbsp;");


    }
    else
    {
        var sOUT="#ERROR#";
    }

    return sOUT;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// VALIDACE FORMULARE PREHLEDU OBJEDNAVEK ////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getF(formName)
{
	return document.forms[formName]
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validateOrded_change_fEnable(no, typ)
{
	var f = getF('FFF')
	f.fType.value   = typ;
	f.fEnable.value = no;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validateOrder_ByLast()
{
	var f = getF('FFF')
	if(isNaN(f.LastOrder.value))	{alert('Zadaný poèet posledních objednávek není èíslo!');	f.LastOrder.focus();	return;}
	if(f.LastOrder.value == '')		{alert('Zadejte poèet posledních objednávek!');				f.LastOrder.focus();	return;}
	if(f.LastOrder.value == 0)		{alert('Ale ale, posledních 0 ...??... \n8-)');				f.LastOrder.focus();	return;}
	validateOrded_change_fEnable(1);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validateOrder_One()
{
	var f = getF('FFF')
	if(f.n_Doklad.value == '')		{alert('Zadejte její èíslo!');								f.n_Doklad.focus();	return;}
	if(f.n_Doklad.value == 0)		{alert('Ale ale, è. 0 ...??... \n8-)');						f.n_Doklad.focus();	return;}
	validateOrded_change_fEnable(1, 'One');
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validateOrder_ByDate()
{
	var f = getF('FFF')
	if(!isDate(f.OneDay.value))	{alert('Neplatný formát data!');								f.OneDay.focus();		return;}
	validateOrded_change_fEnable(1);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function validateOrder_List()
{
	var f = getF('FFF')
	if(!isDate(f.d_D1.value))		{alert('Neplatný formát data OD!');							f.d_D1.focus();		return;}
	if(!isDate(f.d_D2.value))		{alert('Neplatný formát data DO!');							f.d_D2.focus();		return;}
	if(!validatedateftomto(f.d_D1.value, f.d_D2.value))
	{
		alert('Datum OD je vìtší než DO!');
		f.d_D1.focus();
		return;
	}
	validateOrded_change_fEnable(1, 'List');
}

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

function isDate(fDate)
{	var status = true
	a = fDate.split(".")
	if (a.length!=3) {status = false}
	if (isNaN(a[0]) || a[0]<1 || a[0]>31) {status = false}
	if (isNaN(a[1]) || a[1]<1 || a[1]>12) {status = false}
	if (isNaN(a[2]) || a[2]<1900 || a[2]>2100) {status = false}
	if ((a[1]==4 || a[1]==6 || a[1]==9 || a[1]==11) && (a[0]>30)) {status = false}
	if (a[1]==2 && a[2]%4==0) {if ((a[0]>29)) {status = false}}
	if (a[1]==2 && a[2]%4!=0) {if ((a[0]>28)) {status = false}}
	return status
}

function validatedateftomto(pdateFrom, pdateTo)
{	dF = pdateFrom.split(".")
	dT = pdateTo.split(".")
	OK=true

	if ((parseInt(dF[2])<parseInt(dT[2])) && OK) return true;
	if ((parseInt(dF[2])<=parseInt(dT[2])) && OK) OK=true; else OK=false;
	if ((parseInt(dF[1])<parseInt(dT[1])) && OK)  return true;
	if ((parseInt(dF[1])<=parseInt(dT[1])) && OK) OK=true; else OK=false;
	if ((parseInt(dF[0])<parseInt(dT[0])) && OK) return true;
	if ((parseInt(dF[0])<=parseInt(dT[0])) && OK) OK=true; else OK=false;
	if (!OK) return false;
	return true;
}

function fn_DetailPage_Ask(formChild)
{
	var f = formChild.form;
	
	if (!EmailControl(f.AskEmail.value))
	{
		f.AskEmail.focus();
		return false
	}
	
	var url = '';
	
	url += '/Includes/DetailPage_Question_IFR.asp'
	url += '?CD='			+ f.Code.value.toString()
	url += '&Name='			+ f.Name.value.toString()
	url += '&AskQuestion='	+ f.AskQuestion.value.toString()
	url += '&AskEmail='		+ f.AskEmail.value.toString()
	
	document.all.WinStat.src = url;
	
	f.AskQuestion.value='\n\nOdesílám...'
	
	return false;
}

function fn_DetailPage_Send(formChild)
{
	fn_DetailPage_SendInit()

	var f = formChild.form;

	if (!EmailControl(f.SendToEmail.value))
	{
		f.SendToEmail.focus();
		return false
	}

	if (!EmailControl(f.SendFromEmail.value))
	{
		f.SendFromEmail.focus();
		return false
	}
		
	var url = '';
	
	url += '/Includes/DetailPage_SendUrl_IFR.asp'
	url += '?CD='				+ f.Code.value.toString()
	url += '&Name='				+ f.Name.value.toString()
	url += '&SendToEmail='		+ f.SendToEmail.value.toString()
	url += '&SendFromEmail='	+ f.SendFromEmail.value.toString()
	url += '&SendFromName='		+ f.SendFromName.value.toString()
	url += '&SendFromComent='	+ f.SendFromComent.value.toString()

	document.all.WinStat.src = url;
	
	f.SendFromComent.value='\n\nOdesílám...'
	
	return false;
}

function fn_DetailPage_SendInit()
{
	document.all.idDetailPage_Send1.className = 'Show';
	document.all.idDetailPage_Send2.className = 'Show';
	document.all.idDetailPage_Send3.className = 'Show';
}

function extractNumber(obj, decimalPlaces, allowNegative)
{
	var temp = obj.value;
	
	// avoid changing things if already formatted correctly
	var reg0Str = '[0-9]*';
	if (decimalPlaces > 0) {
		reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
	} else if (decimalPlaces < 0) {
		reg0Str += '\\.?[0-9]*';
	}
	reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
	reg0Str = reg0Str + '$';
	var reg0 = new RegExp(reg0Str);
	if (reg0.test(temp)) return true;

	// first replace all non numbers
	var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
	var reg1 = new RegExp(reg1Str, 'g');
	temp = temp.replace(reg1, '');

	if (allowNegative) {
		// replace extra negative
		var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
		var reg2 = /-/g;
		temp = temp.replace(reg2, '');
		if (hasNegative) temp = '-' + temp;
	}
	
	if (decimalPlaces != 0) {
		var reg3 = /\./g;
		var reg3Array = reg3.exec(temp);
		if (reg3Array != null) {
			// keep only first occurrence of .
			//  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
			var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
			reg3Right = reg3Right.replace(reg3, '');
			reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
			temp = temp.substring(0,reg3Array.index) + '.' + reg3Right;
		}
	}
	
	obj.value = temp;
}

function blockNonNumbers(obj, e, allowDecimal, allowNegative)
{
	var key;
	var isCtrl = false;
	var keychar;
	var reg;
		
	if(window.event) {
		key = e.keyCode;
		isCtrl = window.event.ctrlKey
	}
	else if(e.which) {
		key = e.which;
		isCtrl = e.ctrlKey;
	}
	
	if (isNaN(key)) return true;
	
	keychar = String.fromCharCode(key);
	
	// check for backspace or delete, or if Ctrl was pressed
	if (key == 8 || isCtrl)
	{
		return true;
	}

	reg = /\d/;
	var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
	var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;
	
	return isFirstN || isFirstD || reg.test(keychar);
}
