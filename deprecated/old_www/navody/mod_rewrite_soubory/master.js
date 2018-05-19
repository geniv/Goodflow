var d = document;

function isValidEmail(checkStr)
{
  // test valid email address
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/;
  var EmailValid = filter.test(checkStr);
  return (EmailValid);
}

function checkSubscribeForm(theForm)
{
  var emailField = theForm.txtEmail;

  // check to see if the Email Address is blank
  if (emailField.value == "")
  {
    alert("Vyplňte laskavě vaši e-mailovou adresu.");
    emailField.focus();
    return (false);
  }
  // check email address length
  if (emailField.value.length > 100)
  {
    alert("Zadejte laskavě adresu kratší než 100 znaků.");
    emailField.focus();
    return (false);
  }
  // check email address structure
  if (!isValidEmail(emailField.value))
  {
    alert("Zadaná adresa " + emailField.value + " není platná. Zkuste ji laskavě vyplnit znovu.");
    emailField.focus();
    return (false);
  }
  return (true);
}

function checkFeedbackForm(theForm)
{
  // check email
  if (theForm.txtFrom.value !== "")
  {
    if (!isValidEmail(theForm.txtFrom.value))
    {
      alert("Zadaná adresa není platná. Zkuste ji laskavě vyplnit znovu.");
      theForm.txtFrom.focus();
      return (false);
    }
  }
  // check message
  if (theForm.txtMessage.value == "")
  {
    alert("Vyplňte laskavě text zprávy.");
    theForm.txtMessage.focus();
    return (false);
  }
  return (true);
}

function checkRecForm(theForm)
{
  // check to see if the field is blank
  if (theForm.txtName.value == "")
  {
    alert("Vyplňte laskavě vaše jméno.");
    theForm.txtName.focus();
    return (false);
  }
  // check to see if the Email Address is blank
  if (theForm.txtFrom.value == "")
  {
    alert("Vyplňte laskavě vaši e-mailovou adresu.");
    theForm.txtFrom.focus();
    return (false);
  }
  // check email structure
  if (!isValidEmail(theForm.txtFrom.value))
  {
    alert("Vaše zadaná adresa není platná. Zkuste ji laskavě vyplnit znovu.");
    theForm.txtFrom.focus();
    return (false);
  }
  // check to see if the Email Address is blank
  if (theForm.txtTo.value == "")
  {
    alert("Vyplňte laskavě e-mailovou adresu příjemce.");
    theForm.txtTo.focus();
    return (false);
  }
  // check email structure
  if (!isValidEmail(theForm.txtTo.value))
  {
    alert("Zadaná adresa příjemce není platná. Zkuste ji laskavě vyplnit znovu.");
    theForm.txtFrom.focus();
    return (false);
  }
  return (true);
}

function openWindow(url, name, params) {
  var myWin = window.open(url, name, params);
  myWin.focus();
}

//
// QueryString
//

function QueryString(key)
{
  var value = null;
  for (var i=0;i<QueryString.keys.length;i++)
  {
    if (QueryString.keys[i]==key)
    {
      value = QueryString.values[i];
      break;
    }
  }
  return value;
}
QueryString.keys = new Array();
QueryString.values = new Array();

function QueryString_Parse()
{
  var query = window.location.search.substring(1);
  var pairs = query.split("&");

  for (var i=0;i<pairs.length;i++)
  {
    var pos = pairs[i].indexOf('=');
    if (pos >= 0)
    {
      var argname = pairs[i].substring(0,pos);
      var value = pairs[i].substring(pos+1);
      QueryString.keys[QueryString.keys.length] = argname;
      QueryString.values[QueryString.values.length] = unescape(value.split('+').join(' '));
    }
  }
}

QueryString_Parse();

//
// styleAbbr
//

function styleAbbr() {
	var oldBodyText, newBodyText, reg
	if (isWinIE) {
		oldBodyText = document.body.innerHTML;
		reg = /<ABBR([^>]*)>([^<]*)<\/ABBR>/g;
		newBodyText = oldBodyText.replace(reg, '<ABBR $1><SPAN class=\"help\" $1>$2</SPAN></ABBR>');
		document.body.innerHTML = newBodyText;
	}
}

function quoteIt(qs,lang){
  var x,v,q;
  var qEn = ["\u201C","\u201D","\u2018","\u2019"];
  var qFr = ["\u00AB","\u00BB","\u2039","\u203A"];
  var qCs = ["„","“","‚","‘"];
  if(lang.indexOf("en")!=-1) { q = qEn }
  else if(lang.indexOf("fr")!=-1) { q = qFr }
  else { q = qCs }
  for(x=0;qs.length>x;x++){
    (qs[x].parentNode.nodeName!="Q") ? v = 0 : v = 2;
    qs[x].insertBefore(d.createTextNode(q[0+v]),qs[x].firstChild);
    qs[x].appendChild(d.createTextNode(q[1+v]));
  }
}

window.onload = function(){
	styleAbbr()
	if (isIE) {
		var qs = d.getElementsByTagName("q");
		quoteIt(qs,"cs");
	}
};

isIE = (document.all) ? true:false;
isWinIE = (navigator.appVersion.indexOf('MSIE')>-1 && navigator.appVersion.indexOf('Windows')>-1);
