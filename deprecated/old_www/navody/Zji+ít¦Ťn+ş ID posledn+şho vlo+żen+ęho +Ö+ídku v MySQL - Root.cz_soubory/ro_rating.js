roct = 10000;
rocl = 500;
function rotc() {
document.cookie="rft=1";
if(document.cookie.indexOf("rft=1") != -1) {
return 1;
} else {
return 0;
}
}
function rocchck() {
if (document.cookie.indexOf("rc=") != -1) {
window.setTimeout("rocchck()",500);
} else {
document.getElementsByTagName("body")[0].removeChild(document.getElementById("rorbox")); 
}
}
function roac(cv) {
var rc = '';
var dc = document.cookie;
var p = dc.indexOf("rc=");
if(p != -1) {
p += 3;
if (dc.indexOf(";",p) == -1) {
rc = dc.substring(p);
} else {
rc = dc.substring(p,dc.indexOf(";",p));
}
}
rc += cv;
var d = new Date((new Date()).getTime()+roct*3600000*24);
document.cookie = "rc="+rc+'; path=/; expires='+d.toGMTString();
if (rc.length > rocl) {
var b = document.getElementsByTagName("body")[0];
var bx = document.createElement("div");
bx.id = "rorbox";
bx.appendChild(document.createTextNode('Ukládám hodnocení...'));
b.appendChild(bx);
window.setTimeout("rocchck()",500);
var i = document.createElement("iframe");
i.id = "rorboxif";
i.src = "http://www.root.cz/uloz-hodnoceni/?"+Math.round(Math.random()*100000);;
b.appendChild(i);
}
}
function rocch(e) {
var i;
for(i=0;i<=e.childNodes.length-1;i++) {
e.removeChild(e.childNodes[i]);
}
}
function rogtr(d,t) {
rocch(d);
var i = false;
if(t == rormn) {
i = gen_ico('thumb-dn.png','Palec dolu','To snad ne...');
} else {
i = gen_ico('thumb-up.png','Palec nahoru','Výbornì!');
}
if(i) {
var span = document.createElement("span");
span.className = "op-qm";
span.appendChild(i);
span.title = "Va¹e hodnocení názoru";
d.appendChild(span);
}
}
function rosr() {
var id = this.id;
var p = id.substring(3).split('o');
rogtr(document.getElementById("rx0o"+p[1]),p[2]);
var h = document.getElementById("rf0o"+p[1]);
h.parentNode.removeChild(h);
roac(p[0]+'o'+p[1]+"-"+p[2]+"#");
return false;
}
rocc = rotc();
function rogf(fd,ot,o) {
var div = document.createElement("span");
var tn = document.createTextNode("Ohodno»te: ");
div.appendChild(tn);
div.className = "op-qs";
var span;
span = document.createElement("span");
span.id="rfi"+ot+'o'+o+'o'+rormn;
span.appendChild(gen_ico('thumb-dn.png','Palec dolu','To snad ne...'));
span.onclick= rosr;
div.appendChild(span);
span = document.createElement("span");
span.id="rfi"+ot+'o'+o+'o'+rormx;
span.appendChild(gen_ico('thumb-up.png','Palec nahoru','Výbornì!'));
span.onclick= rosr;
div.appendChild(span);
fd.appendChild(div);
}
function rogrf(ot,o) {
var fd=document.getElementById("rf"+ot+'o'+o);
if (rocc == 0) {
fd.style.display = "none"; 
} else {
rocch(fd);
rogf(fd,ot,o);
}
}
