var goCurrentImg;

function cl_min (ev) {
	if (window.event) {ev = window.event}
	var hi = document.getElementById("hi"+this.iid);
	//alert(hi.firstChild.firstChild.firstChild);	
	//return
	//var td = hi.firstChild.firstChild.firstChild;
	hi.innerHTML = "<img src='" + this.thsrc + "' alt='Náhled' />"
//"" + this.sName + "<br />
//	img.src = this.thsrc;
	hi.style.width = this.thw;
	hi.style.height = this.thh;
	hi.style.left = "5px";//this.offsetLeft; //(objPos(this).x +10) + "px";//leftPosition(this) + "px";
	hi.style.top = "-17px"; //this.offsehiop; //(objPos(this).y + 10) + "px";//(topPosition(this) + 35) + "px";
	if (goCurrentImg){goCurrentImg.style.display = "none"}
	hi.style.display = "block";
	goCurrentImg = hi;
}

//function cl_min (ev) {
//	if (window.event) {ev = window.event}
//	var hi = document.getElementById("hi"+this.iid);
//	var img = hi.firstChild;
//	img.src = this.thsrc;
//	img.width = this.thw;
//	img.height = this.thh;
//	hi.style.left = "10px";//this.offsetLeft; //(objPos(this).x +10) + "px";//leftPosition(this) + "px";
//	hi.style.top = "-20px"; //this.offsehiop; //(objPos(this).y + 10) + "px";//(topPosition(this) + 35) + "px";
//	hi.style.display = "block";
//}

function cl_mout (ev) {
	if (window.event) {ev = window.event}
	var hi = document.getElementById("hi"+this.iid);
	hi.style.display = "none";
}

function lf(n,ev,f,w,h,iid, sName){
	
	if (Br.IE || Br.OP) {
		n.thsrc = f;
		n.thw = w;
		n.thh = h;
		n.iid = iid;
		n.sName = sName;
		n.onmouseover = cl_min;
		n.onmouseout = cl_mout;
		n.onmouseover(ev);
	}
}
