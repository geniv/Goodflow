// kontrola prazdneho inputu
function isEmpty(e) {   
    return ((e == null) || (e.length == 0));
}

//vyhledavaci pole
function searching(input) {
	if (input.value == "hledej...") input.value = "";
}

//odeslani vyhledavani
function checkSearching(form) {
if ((isEmpty(form.hledej.value)) || (form.hledej.value == "hledej...")) {
	alert("Je třeba zadat hledaný výraz.");
	form.hledej.focus();
	return false
	}
	else return true;
}