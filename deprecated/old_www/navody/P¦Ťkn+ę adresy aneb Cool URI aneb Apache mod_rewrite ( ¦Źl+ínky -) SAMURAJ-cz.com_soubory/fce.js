// JavaScript Document
<!--

// otevre link v novem okne
function newWindow(wlink) {
	var Wind = window.open(wlink, '_blank'); 
	Wind.focus();
	return false;
}

// ve formulari o do prvku o vlozi text txt
function PutToTextArea(f, o, txt) {
	document.forms[f][o].value += txt;
	document.forms[f][o].focus();
}

// pokud je do daneho elementu (textarea) vlozeno vice znaku, vyvola varovani
function MaxChars(obj, num, key) {
	if(key == 8 || key == 46) return false; 
	if(obj.value.length >= num) {
		alert("Příspěvek může obsahovat maximálně "+num+" znaků.");
		return true;
	} else {
		return false;
	}
}

// obj je ukazatel na text area, na pozici kurzoru vlozi val1 a val2, pokud je oznacen text vlozi okolo, pokud je val2=0, prepise
// pouziti InsertAtPosition(document.form.textarea, '<a>', '</a>')
function InsertAtPosition(obj, val1, val2) {
	if(document.selection) {	// IE
		obj.focus();
		sel = document.selection.createRange();	
		if(val2) sel.text = val1 + sel.text + val2;
		else sel.text = val1;
	} else  	// Mozilla, FF, Netscape
		if(obj.selectionStart || obj.selectionStart == 0) {
			var startPos = obj.selectionStart;
			var endPos = obj.selectionEnd;
			if(val2) obj.value = obj.value.substring(0, startPos) + val1 + obj.value.substring(startPos, endPos) + val2 + obj.value.substring(endPos, obj.value.length);
			else obj.value = obj.value.substring(0, startPos) + val1 + obj.value.substring(endPos, obj.value.length);
		} else
			obj.value += (val1 + val2);
}

// vlozi odkaz z dotazem na link
function InsertLink(obj) {
	var sProtocol = "http://";
	var sLink = prompt("Vložte link:", "");
	if(sLink == null) return false;
	var val = "<a href='" + sProtocol + sLink + "'>" + sLink;
	InsertAtPosition(obj, val, "</a>");
	return true;
}

// pokud znak patri do pole change_inp, zmeni ho na change_out, jinak 0
function changeChar(ch) {
	var change_inp = " .,-ěščřžýáíéůúť";
	var change_out = "----escrzyaieuut";
	for(var pos=0;pos<change_inp.length;pos++) 
		if(ch == change_inp.charAt(pos)) return change_out.charAt(pos);
	return 0;
}

// upravi vstupni retezec podle pravidel na link k clanku (mala pismena,nahradit mezery a diakritiku, odstranit ostatni)
// inp a outp jsou textova pole
function ConvertArticleName(inp, outp) {
	var input = (inp.value).toLowerCase();
	var output = "", ch, lastch = "";
	for(var pos=0;pos<input.length;pos++) {
		ch = input.charAt(pos);
		if((ch>='a' && ch<='z')||(ch>='A' && ch<='Z')||(ch>='0' && ch<='9')) { output += ch; lastch = ch; }
		else {
			ch=changeChar(ch);
			if(ch && !(lastch == '-' && ch == '-')) { output += ch; lastch = ch; }
		}
	}
	outp.value = output;
}



//-->
