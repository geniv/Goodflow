function addSidebar(name, url, config_url){
if(config_url == null) config_url = "";
if((typeof window.sidebar == "object") && (typeof window.sidebar.addPanel == "function")){
window.sidebar.addPanel(name, url, config_url);
}else{
window.alert("Vá¹ prohlí¾eè nepodporuje tuto funkci. Zkuste Mozillu.");
}
}
var offset = 1;
var count = 0;
var maxCount = 150;
var direction = 1;
var id = null;
var elem = null;
function jobsStart(){
id = setTimeout("jobsScroll()", 8000);
elem = document.getElementById("jobs-lst");
}
function jobsScroll(){
elem.scrollTop = elem.scrollTop + (offset * direction);
count++;
if (count >= maxCount){
count = 0;
direction = -1 * direction;
id = setTimeout("jobsScroll()", 5000);
} else {
id = setTimeout("jobsScroll()", 1);
}
}
function jobsSleep(a){
if (a) {
window.clearTimeout(id);
} else {
id = window.setTimeout("jobsScroll()", 1);
}
}
rormx = 10;
rormn = 1;
roimw = 18;
roimh = 18;
function gen_ico(im,ia,it) {
var i = new Image;
i.src = "http://i.iinfo.cz/r2/"+im;
i.alt = ia;
i.title = it;
i.width = roimw;
i.height = roimh;
return i;
}
var Funcs = {
gEBI : function(id)
{
return document.getElementById(id);
},
gEBN : function(name)
{
return document.getElementsByName(name);
},
appC : function(parent, child)
{
return parent.appendChild(child);
},
cElm : function(elm)
{
return document.createElement(elm);
},
cTxt : function(txt)
{
return document.createTextNode(txt);
},
rmC : function(parent,child)
{
return parent.removeChild(child);
},
rmE : function(elm)
{
return elm.parentNode.removeChild(elm);
},
rmChilds : function(parent)
{
while(parent.hasChildNodes()){
parent.removeChild(parent.childNodes[0]);
}
return false;;
},
preloadImgs : function(imgsUrl)
{
for(i=0;i<imgsUrl.length;i++){
var pic = new Image();
pic.src = imgsUrl[i];
}
return true;
}
}
var xmlhttp = {
xt : null,
url : null,
_parent : null,
request : function(url,content,method,parentID)
{
if(!url || !content || !parentID){return false;}
if(!method){method = 'GET';}

var tm = new Date();
this.url = url + content + "&t=" + tm.getTime();
this._parent = Funcs.gEBI(parentID);
if(this.checkHost(url)){
this.xt = this.xt ? this.xt : this.setRequestType();
if(this.xt){
this.xt.open(method,this.url,true);
this.xt.setRequestHeader("Content-Type","text/xml;Charset=utf-8");
this.xt.onreadystatechange = function(){xmlhttp.state_changed();}
this.xt.send(null);
}
}
return true;
},
requestDOM : function()
{
var loader = Funcs.cElm("script");
loader.type = "text/javascript";
loader.src = this.url;
try{
Funcs.appC(this._parent,loader);
}catch(e){
return false;
}
},
state_changed : function()
{
if(this.xt.readyState == 4){
if(this.xt.status == 200){
eval(this.xt.responseText);
}else{
this.requestDOM();
}
}
},
setRequestType : function()
{
if(window.XMLHttpRequest){
out = new XMLHttpRequest();
}else if(window.createRequest){
out = window.createRequest();
}else{
try{
out = new ActiveXObject("Microsoft.XMLHTTP");
}catch(e){
try{
out = new ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
return this.requestDOM();
}
}
}
return out;
},
checkHost : function()
{
var host = false;
if(this.url.indexOf('http') != -1){
host = this.url.substr(7);
if(host.indexOf('/') != -1){
host = host.substr(0,host.indexOf('/'));
}
if(document.location.hostname == host){
return true;
}else{
return false;
}
}
return true;
}
}
