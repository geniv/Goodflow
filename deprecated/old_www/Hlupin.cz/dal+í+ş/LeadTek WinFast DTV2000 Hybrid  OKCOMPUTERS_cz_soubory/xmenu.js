
var aitem, atimer;

function menuItemShow(){
	if (atimer) clearTimeout(atimer);
	this.className = "sel";
}

function menuItemHide(){
	this.className = "";
}

function menuItemOut(ev){
	atimer = setTimeout("window.aitem.hide();", 10);
}

function menuItemOver(ev){
	if(aitem) if(aitem!=this) aitem.hide();
	this.show();
	aitem = this;
}


function xinit(menu_id) {
	var menu = document.getElementById(menu_id);
	
	for(var i=0;i<menu.childNodes.length;i++){
		it=menu.childNodes[i];
		if (it.className == '' ){
			it.show = menuItemShow;
			it.hide = menuItemHide;
			it.onmouseover = menuItemOver;
			it.onmouseout = menuItemOut;
		}
	}

}



