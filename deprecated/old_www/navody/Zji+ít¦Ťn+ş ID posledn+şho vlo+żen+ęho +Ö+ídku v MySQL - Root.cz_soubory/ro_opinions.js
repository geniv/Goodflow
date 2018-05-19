var o_error = 'Chyba pøenosu:';
var o_loading = 'Naèítám...';
var o_not_supported = 'Funkce (XMLHttpRequest) není podporována prohlí¾eèem.';
function processReqChange(req,span,op_id,status,rating_value,thread_id) {
if (req.readyState == 4) {
if (req.status == 200) {
var opinion;
var my_rating_value_html;
opinion=document.getElementById("o"+op_id);
opinion.innerHTML=req.responseText;
if (rating_value > 0) {
opinion_rv=document.getElementById("rx0o"+op_id);
var span;
span=document.createElement("span");
span.className="op-qm";
opinion_rv.appendChild(span);
if(rating_value==rormn) {
span.appendChild(gen_ico('thumb-dn.png','Palec dolu','To snad ne...'));
} else if (rating_value==rormx) {
span.appendChild(gen_ico('thumb-up.png','Palec nahoru','Výbornì!'));
}
} else {
rogrf(0,op_id); 
}
opinion_s=document.getElementById("o"+op_id+'s');
if (status=='new') {
opinion_s.innerHTML=o_new_status_html;
} else if (status=='unreaded') {
opinion_s.innerHTML=o_unreaded_status_html;
}

if (thread_id > 0) {
var my_thread=o_thread.replace(/%%OPINION_ID%%/g,op_id);
my_thread=my_thread.replace(/%%THREAD_ID%%/g,thread_id);
} else {
var my_thread='';
}
opinion_t=document.getElementById("o"+op_id+'t');
opinion_t.innerHTML=my_thread;
} else {
span.innerHTML=o_error+' '+req.status+' '+req.statusText;
return false;
}

}
}
function o_uncover(span,op_id,status,rating_value,thread_id) {
var url=o_url.replace(/%%OPINION_ID%%/g,op_id);
if (window.XMLHttpRequest) {
span.innerHTML=o_loading;
var req = new XMLHttpRequest();
req.onreadystatechange = function() { 
processReqChange(req,span,op_id,status,rating_value,thread_id);
}
req.open("GET", url, true);
req.send(null);
} else if (window.ActiveXObject) {
var req = new ActiveXObject("Microsoft.XMLHTTP");
if (req) {
span.innerHTML=o_loading;
req.onreadystatechange = function() { 
processReqChange(req,span,op_id,status,rating_value,thread_id);
}
req.open("GET", url, true);
req.send();
} else {
span.innerHTML=o_not_supported;
}
} else {
span.innerHTML=o_not_supported;
}
return false;
}
function o_ubu(opinion_id,status,rating_value,thread_id) {
document.write('<span class="op-h-t" onclick="return o_uncover(this,'+opinion_id+',\''+status+'\','+rating_value+','+thread_id+');"><strong>Zobrazit</strong></span>')
}
