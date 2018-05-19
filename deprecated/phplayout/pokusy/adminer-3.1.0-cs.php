<?php
/** Adminer - Compact database management
* @link http://www.adminer.org/
* @author Jakub Vrana, http://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/error_reporting(6135);$re=(!ereg('^(unsafe_raw)?$',ini_get("filter.default"))||ini_get("filter.default_flags"));if($re){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$b){$Fe=filter_input_array(constant("INPUT$b"),FILTER_UNSAFE_RAW);if($Fe){$$b=$Fe;}}}if(isset($_GET["file"])){header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
base64_decode("AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA////AAAA/wBhTgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERAAAAAAETMzEQAAAAATERExAAAAABMRETEAAAAAExERMQAAAAATERExAAAAABMRETEAAAAAEzMzMREREQATERExEhEhABEzMxEhEREAAREREhERIRAAAAARIRESEAAAAAESEiEQAAAAABEREQAAAAAAAAAAD//9UAwP/VAIB/AACAf/AAgH+kAIB/gACAfwAAgH8AAIABAACAAf8AgAH/AMAA/wD+AP8A/wAIAf+B1QD//9UA");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo'body{color:#000;background:#fff;font:90%/1.25 Verdana,Arial,Helvetica,sans-serif;margin:0;}a{color:blue;}a:visited{color:navy;}a:hover{color:red;}h1{font-size:150%;margin:0;padding:.8em 1em;border-bottom:1px solid #999;font-weight:normal;color:#777;background:#eee;}h2{font-size:150%;margin:0 0 20px -18px;padding:.8em 1em;border-bottom:1px solid #000;color:#000;font-weight:normal;background:#ddf;}h3{font-weight:normal;font-size:130%;margin:1em 0 0;}form{margin:0;}table{margin:1em 20px 0 0;border:0;border-top:1px solid #999;border-left:1px solid #999;font-size:90%;}td,th{border:0;border-right:1px solid #999;border-bottom:1px solid #999;padding:.2em .3em;}th{background:#eee;text-align:left;}thead th{text-align:center;}thead td,thead th{background:#ddf;}fieldset{display:inline;vertical-align:top;padding:.5em .8em;margin:.8em .5em 0 0;border:1px solid #999;}p{margin:.8em 20px 0 0;}img{vertical-align:middle;border:0;}td img{max-width:200px;max-height:200px;}code{background:#eee;}tr:hover td,tr:hover th{background:#ddf;}pre{margin:1em 0 0;}.version{color:#777;font-size:67%;}.js .hidden{display:none;}.nowrap td,.nowrap th,td.nowrap{white-space:pre;}.wrap td{white-space:normal;}.error{color:red;background:#fee;}.error b{background:#fff;font-weight:normal;}.message{color:green;background:#efe;}.error,.message{padding:.5em .8em;margin:1em 20px 0 0;}.char{color:#007F00;}.date{color:#7F007F;}.enum{color:#007F7F;}.binary{color:red;}.odd td{background:#F5F5F5;}.time{color:silver;font-size:70%;}.function{text-align:right;}.number{text-align:right;}.datetime{text-align:right;}.type{width:15ex;width:auto\\9;}#menu{position:absolute;margin:10px 0 0;padding:0 0 30px 0;top:2em;left:0;width:19em;overflow:auto;overflow-y:hidden;white-space:nowrap;}#menu p{padding:.8em 1em;margin:0;border-bottom:1px solid #ccc;}#content{margin:2em 0 0 21em;padding:10px 20px 20px 0;}#lang{position:absolute;top:0;left:0;line-height:1.8em;padding:.3em 1em;}#breadcrumb{white-space:nowrap;position:absolute;top:0;left:21em;background:#eee;height:2em;line-height:1.8em;padding:0 1em;margin:0 0 0 -18px;}#h1{color:#777;text-decoration:none;font-style:italic;}#version{font-size:67%;color:red;}#schema{margin-left:60px;position:relative;}#schema .table{border:1px solid silver;padding:0 2px;cursor:move;position:absolute;}#schema .references{position:absolute;}.rtl h2{margin:0 -18px 20px 0;}.rtl p,.rtl table,.rtl .error,.rtl .message{margin:1em 0 0 20px;}.rtl #content{margin:2em 21em 0 0;padding:10px 0 20px 20px;}.rtl #breadcrumb{left:auto;right:21em;margin:0 -18px 0 0;}.rtl #lang,.rtl #menu{left:auto;right:0;}@media print{#lang,#menu{display:none;}#content{margin-left:1em;}#breadcrumb{left:1em;}}';}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");?>
document.body.className+=' js';function toggle(id){var el=document.getElementById(id);el.className=(el.className=='hidden'?'':'hidden');return true;}
function cookie(assign,days,params){var date=new Date();date.setDate(date.getDate()+days);document.cookie=assign+'; expires='+date+(params||'');}
function verifyVersion(protocol){cookie('adminer_version=0',1);var script=document.createElement('script');script.src=protocol+'://www.adminer.org/version.php';document.body.appendChild(script);}
function formCheck(el,name){var elems=el.form.elements;for(var i=0;i<elems.length;i++){if(name.test(elems[i].name)){elems[i].checked=el.checked;}}}
function formUncheck(id){document.getElementById(id).checked=false;}
function formChecked(el,name){var checked=0;var elems=el.form.elements;for(var i=0;i<elems.length;i++){if(name.test(elems[i].name)&&elems[i].checked){checked++;}}
return checked;}
function tableClick(event){var el=event.target||event.srcElement;while(!/^tr$/i.test(el.tagName)){if(/^(table|a|input|textarea)$/i.test(el.tagName)){return;}
el=el.parentNode;}
el=el.firstChild.firstChild;el.click&&el.click();el.onclick&&el.onclick();}
function setHtml(id,html){var el=document.getElementById(id);if(el){if(html==undefined){el.parentNode.innerHTML='&nbsp;';}else{el.innerHTML=html;}}}
function selectAddRow(field){field.onchange=function(){};var row=field.parentNode.cloneNode(true);var selects=row.getElementsByTagName('select');for(var i=0;i<selects.length;i++){selects[i].name=selects[i].name.replace(/[a-z]\[\d+/,'$&1');selects[i].selectedIndex=0;}
var inputs=row.getElementsByTagName('input');if(inputs.length){inputs[0].name=inputs[0].name.replace(/[a-z]\[\d+/,'$&1');inputs[0].value='';inputs[0].className='';}
field.parentNode.parentNode.appendChild(row);}
function textareaKeydown(target,event,tab,button){if(tab&&event.keyCode==9&&!event.shiftKey&&!event.altKey&&!event.ctrlKey&&!event.metaKey){if(target.setSelectionRange){var start=target.selectionStart;target.value=target.value.substr(0,start)+'\t'+target.value.substr(target.selectionEnd);target.setSelectionRange(start+1,start+1);return false;}else if(target.createTextRange){document.selection.createRange().text='\t';return false;}}
if(event.ctrlKey&&(event.keyCode==13||event.keyCode==10)&&!event.altKey&&!event.metaKey){if(button){button.click();}else{target.form.submit();}}
return true;}
function selectDblClick(td,event,text){td.ondblclick=function(){};var pos=event.rangeOffset;var value=(td.firstChild.firstChild?td.firstChild.firstChild.data:(td.firstChild.alt?td.firstChild.alt:td.firstChild.data));var input=document.createElement(text?'textarea':'input');input.name=td.id;input.value=(value=='\u00A0'||td.getElementsByTagName('i').length?'':value);input.style.width=Math.max(td.clientWidth-14,20)+'px';if(text){var rows=1;value.replace(/\n/g,function(){rows++;});input.rows=rows;input.onkeydown=function(event){return textareaKeydown(input,event||window.event);};}
if(document.selection){var range=document.selection.createRange();range.moveToPoint(event.x,event.y);var range2=range.duplicate();range2.moveToElementText(td);range2.setEndPoint('EndToEnd',range);pos=range2.text.length;}
td.innerHTML='';td.appendChild(input);input.focus();input.selectionStart=pos;input.selectionEnd=pos;if(document.selection){var range=document.selection.createRange();range.moveStart('character',pos);range.select();}}
function bodyLoad(version,protocol){var jushRoot=protocol + '://www.adminer.org/static/';var script=document.createElement('script');script.src=jushRoot+'jush.js';script.onload=function(){if(window.jush){jush.create_links=' target="_blank"';jush.urls.sql[0]='http://dev.mysql.com/doc/refman/'+version+'/en/$key';jush.urls.sql_sqlset=jush.urls.sql[0];jush.urls.sqlset[0]=jush.urls.sql[0];jush.urls.sqlstatus[0]=jush.urls.sql[0];jush.urls.pgsql[0]='http://www.postgresql.org/docs/'+version+'/static/$key';jush.urls.pgsql_pgsqlset=jush.urls.pgsql[0];jush.urls.pgsqlset[0]='http://www.postgresql.org/docs/'+version+'/static/runtime-config-$key.html#GUC-$1';jush.style(jushRoot+'jush.css');if(window.jushLinks){jush.custom_links=jushLinks;}
jush.highlight_tag('pre',0);jush.highlight_tag('code');}};script.onreadystatechange=function(){if(/^(loaded|complete)$/.test(script.readyState)){script.onload();}};document.body.appendChild(script);}
function selectValue(select){return select.value||select.options[select.selectedIndex].text;}
function formField(form,name){for(var i=0;i<form.length;i++){if(form[i].name==name){return form[i];}}}
function typePassword(el,disable){try{el.type=(disable?'text':'password');}catch(e){}}
var added='.',rowCount;function reEscape(s){return s.replace(/[\[\]\\^$*+?.(){|}]/,'\\$&');}
function idfEscape(s){return s.replace(/`/,'``');}
function editingNameChange(field){var name=field.name.substr(0,field.name.length-7);var type=formField(field.form,name+'[type]');var opts=type.options;var table=reEscape(field.value);var column='';var match;if((match=/(.+)_(.+)/.exec(table))||(match=/(.*[a-z])([A-Z].*)/.exec(table))){table=match[1];column=match[2];}
var plural='(?:e?s)?';var tabCol=table+plural+'_?'+column;var re=new RegExp('(^'+idfEscape(table+plural)+'`'+idfEscape(column)+'$'
+'|^'+idfEscape(tabCol)+'`'
+'|^'+idfEscape(column+plural)+'`'+idfEscape(table)+'$'
+')|`'+idfEscape(tabCol)+'$','i');var candidate;for(var i=opts.length;i--;){if(!/`/.test(opts[i].value)){if(i==opts.length-2&&candidate&&!match[1]&&name=='fields[1]'){return false;}
break;}
if(match=re.exec(opts[i].value)){if(candidate){return false;}
candidate=i;}}
if(candidate){type.selectedIndex=candidate;type.onchange();}}
function editingAddRow(button,allowed,focus){if(allowed&&rowCount>=allowed){return false;}
var match=/(\d+)(\.\d+)?/.exec(button.name);var x=match[0]+(match[2]?added.substr(match[2].length):added)+'1';var row=button.parentNode.parentNode;var row2=row.cloneNode(true);var tags=row.getElementsByTagName('select');var tags2=row2.getElementsByTagName('select');for(var i=0;i<tags.length;i++){tags2[i].name=tags[i].name.replace(/([0-9.]+)/,x);tags2[i].selectedIndex=tags[i].selectedIndex;}
tags=row.getElementsByTagName('input');tags2=row2.getElementsByTagName('input');var input=tags2[0];for(var i=0;i<tags.length;i++){if(tags[i].name=='auto_increment_col'){tags2[i].value=x;tags2[i].checked=false;}
tags2[i].name=tags[i].name.replace(/([0-9.]+)/,x);if(/\[(orig|field|comment|default)/.test(tags[i].name)){tags2[i].value='';}
if(/\[(has_default)/.test(tags[i].name)){tags2[i].checked=false;}}
tags[0].onchange=function(){editingNameChange(tags[0]);};row.parentNode.insertBefore(row2,row.nextSibling);if(focus){input.onchange=function(){editingNameChange(input);};input.focus();}
added+='0';rowCount++;return true;}
function editingRemoveRow(button){var field=formField(button.form,button.name.replace(/drop_col(.+)/,'fields$1[field]'));field.parentNode.removeChild(field);button.parentNode.parentNode.style.display='none';return true;}
var lastType='';function editingTypeChange(type){var name=type.name.substr(0,type.name.length-6);var text=selectValue(type);for(var i=0;i<type.form.elements.length;i++){var el=type.form.elements[i];if(el.name==name+'[length]'&&!((/(char|binary)$/.test(lastType)&&/(char|binary)$/.test(text))||(/(enum|set)$/.test(lastType)&&/(enum|set)$/.test(text)))){el.value='';}
if(lastType=='timestamp'&&el.name==name+'[has_default]'&&/timestamp/i.test(formField(type.form,name+'[default]').value)){el.checked=false;}
if(el.name==name+'[collation]'){el.className=(/(char|text|enum|set)$/.test(text)?'':'hidden');}
if(el.name==name+'[unsigned]'){el.className=(/(int|float|double|decimal)$/.test(text)?'':'hidden');}
if(el.name==name+'[on_delete]'){el.className=(/`/.test(text)?'':'hidden');}}}
function editingLengthFocus(field){var td=field.parentNode;if(/(enum|set)$/.test(selectValue(td.previousSibling.firstChild))){var edit=document.getElementById('enum-edit');var val=field.value;edit.value=(/^'.+','.+'$/.test(val)?val.substr(1,val.length-2).replace(/','/g,"\n").replace(/''/g,"'"):val);td.appendChild(edit);field.style.display='none';edit.style.display='inline';edit.focus();}}
function editingLengthBlur(edit){var field=edit.parentNode.firstChild;var val=edit.value;field.value=(/\n/.test(val)?"'"+val.replace(/\n+$/,'').replace(/'/g,"''").replace(/\n/g,"','")+"'":val);field.style.display='inline';edit.style.display='none';}
function columnShow(checked,column){var trs=document.getElementById('edit-fields').getElementsByTagName('tr');for(var i=0;i<trs.length;i++){trs[i].getElementsByTagName('td')[column].className=(checked?'':'hidden');}}
function partitionByChange(el){var partitionTable=/RANGE|LIST/.test(selectValue(el));el.form['partitions'].className=(partitionTable||!el.selectedIndex?'hidden':'');document.getElementById('partition-table').className=(partitionTable?'':'hidden');}
function partitionNameChange(el){var row=el.parentNode.parentNode.cloneNode(true);row.firstChild.firstChild.value='';el.parentNode.parentNode.parentNode.appendChild(row);el.onchange=function(){};}
function foreignAddRow(field){field.onchange=function(){};var row=field.parentNode.parentNode.cloneNode(true);var selects=row.getElementsByTagName('select');for(var i=0;i<selects.length;i++){selects[i].name=selects[i].name.replace(/\]/,'1$&');selects[i].selectedIndex=0;}
field.parentNode.parentNode.parentNode.appendChild(row);}
function indexesAddRow(field){field.onchange=function(){};var row=field.parentNode.parentNode.cloneNode(true);var spans=row.getElementsByTagName('span');for(var i=0;i<spans.length-1;i++){row.removeChild(spans[i]);}
var selects=row.getElementsByTagName('select');for(var i=0;i<selects.length;i++){selects[i].name=selects[i].name.replace(/indexes\[\d+/,'$&1');selects[i].selectedIndex=0;}
var input=row.getElementsByTagName('input')[0];input.name=input.name.replace(/indexes\[\d+/,'$&1');input.value='';field.parentNode.parentNode.parentNode.appendChild(row);}
function indexesAddColumn(field){field.onchange=function(){};var column=field.parentNode.cloneNode(true);var select=column.getElementsByTagName('select')[0];select.name=select.name.replace(/\]\[\d+/,'$&1');select.selectedIndex=0;var input=column.getElementsByTagName('input')[0];input.name=input.name.replace(/\]\[\d+/,'$&1');input.value='';field.parentNode.parentNode.appendChild(column);}
var that,x,y,em,tablePos;function schemaMousedown(el,event){that=el;x=event.clientX-el.offsetLeft;y=event.clientY-el.offsetTop;}
function schemaMousemove(ev){if(that!==undefined){ev=ev||event;var left=(ev.clientX-x)/em;var top=(ev.clientY-y)/em;var divs=that.getElementsByTagName('div');var lineSet={};for(var i=0;i<divs.length;i++){if(divs[i].className=='references'){var div2=document.getElementById((divs[i].id.substr(0,4)=='refs'?'refd':'refs')+divs[i].id.substr(4));var ref=(tablePos[divs[i].title]?tablePos[divs[i].title]:[div2.parentNode.offsetTop/em,0]);var left1=-1;var isTop=true;var id=divs[i].id.replace(/^ref.(.+)-.+/,'$1');if(divs[i].parentNode!=div2.parentNode){left1=Math.min(0,ref[1]-left)-1;divs[i].style.left=left1+'em';divs[i].getElementsByTagName('div')[0].style.width=-left1+'em';var left2=Math.min(0,left-ref[1])-1;div2.style.left=left2+'em';div2.getElementsByTagName('div')[0].style.width=-left2+'em';isTop=(div2.offsetTop+ref[0]*em>divs[i].offsetTop+top*em);}
if(!lineSet[id]){var line=document.getElementById(divs[i].id.replace(/^....(.+)-\d+$/,'refl$1'));var shift=ev.clientY-y-that.offsetTop;line.style.left=(left+left1)+'em';if(isTop){line.style.top=(line.offsetTop+shift)/em+'em';}
if(divs[i].parentNode!=div2.parentNode){line=line.getElementsByTagName('div')[0];line.style.height=(line.offsetHeight+(isTop?-1:1)*shift)/em+'em';}
lineSet[id]=true;}}}
that.style.left=left+'em';that.style.top=top+'em';}}
function schemaMouseup(ev){if(that!==undefined){ev=ev||event;tablePos[that.firstChild.firstChild.firstChild.data]=[(ev.clientY-y)/em,(ev.clientX-x)/em];that=undefined;var s='';for(var key in tablePos){s+='_'+key+':'+Math.round(tablePos[key][0]*10000)/10000+'x'+Math.round(tablePos[key][1]*10000)/10000;}
cookie('adminer_schema='+encodeURIComponent(s.substr(1)),30,'; path="'+location.pathname+location.search+'"');}}<?php
}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACIYSPqcvtD00I8cwqKb5v+q8pIAhxlRmhZYi17iPE8kzLBQA7");break;case"cross.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACI4SPqcvtDyMKYdZGb355wy6BX3dhlOEx57FK7gtHwkzXNl0AADs=");break;case"up.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACIISPqcvtD00IUU4K730T9J5hFTiKEXmaYcW2rgDH8hwXADs=");break;case"down.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACIISPqcvtD00I8cwqKb5bV/5cosdMJtmcHca2lQDH8hwXADs=");break;case"arrow.gif":echo
base64_decode("R0lGODlhCAAKAIAAAICAgP///yH5BAEAAAEALAAAAAAIAAoAAAIPBIJplrGLnpQRqtOy3rsAADs=");break;}}exit;}function
connection(){global$g;return$g;}function
idf_unescape($Q){$wb=substr($Q,-1);return
str_replace($wb.$wb,$wb,substr($Q,1,-1));}function
escape_string($b){return
substr(q($b),1,-1);}function
remove_slashes($xb){if(get_magic_quotes_gpc()){while(list($e,$b)=each($xb)){foreach($b
as$Ja=>$w){unset($xb[$e][$Ja]);if(is_array($w)){$xb[$e][stripslashes($Ja)]=$w;$xb[]=&$xb[$e][stripslashes($Ja)];}else{$xb[$e][stripslashes($Ja)]=($re?$w:stripslashes($w));}}}}}function
bracket_escape($Q,$df=false){static$Re=array(':'=>':1',']'=>':2','['=>':3');return
strtr($Q,($df?array_flip($Re):$Re));}function
h($D){return
htmlspecialchars($D,ENT_QUOTES);}function
nbsp($D){return(trim($D)!=""?h($D):"&nbsp;");}function
nl_br($D){return
str_replace("\n","<br>",$D);}function
checkbox($f,$r,$Ea,$Se="",$Qe=""){static$U=0;$U++;$c="<input type='checkbox'".($f?" name='$f' value='".h($r)."'":"").($Ea?" checked":"").($Qe?" onclick=\"$Qe\"":"")." id='checkbox-$U'>";return($Se!=""?"<label for='checkbox-$U'>$c".h($Se)."</label>":$c);}function
optionlist($Yc,$cf=null,$Be=false){$c="";foreach($Yc
as$Ja=>$w){if(is_array($w)){$c.='<optgroup label="'.h($Ja).'">';}foreach((is_array($w)?$w:array($Ja=>$w))as$e=>$b){$c.='<option'.($Be||is_string($e)?' value="'.h($e).'"':'').(($Be||is_string($e)?(string)$e:$b)===$cf?' selected':'').'>'.h($b);}if(is_array($w)){$c.='</optgroup>';}}return$c;}function
html_select($f,$Yc,$r="",$Fb=true){if($Fb){return"<select name='".h($f)."'".(is_string($Fb)?" onchange=\"$Fb\"":"").">".optionlist($Yc,$r)."</select>";}$c="";foreach($Yc
as$e=>$b){$c.="<label><input type='radio' name='".h($f)."' value='".h($e)."'".($e==$r?" checked":"").">".h($b)."</label>";}return$c;}function
confirm($qe=""){return" onclick=\"return confirm('".'Opravdu?'.($qe?" (' + $qe + ')":"")."');\"";}function
js_escape($D){return
addcslashes($D,"\r\n'\\/");}function
ini_bool($af){$b=ini_get($af);return(eregi('^(on|true|yes)$',$b)||(int)$b);}function
q($D){global$g;return$g->quote($D);}function
get_vals($j,$C=0){global$g;$c=array();$i=$g->query($j);if(is_object($i)){while($a=$i->fetch_row()){$c[]=$a[$C];}}return$c;}function
get_key_vals($j,$H=null){global$g;if(!is_object($H)){$H=$g;}$c=array();$i=$H->query($j);while($a=$i->fetch_row()){$c[$a[0]]=$a[1];}return$c;}function
get_rows($j,$H=null,$n="<p class='error'>"){global$g;if(!is_object($H)){$H=$g;}$c=array();$i=$H->query($j);if(is_object($i)){while($a=$i->fetch_assoc()){$c[]=$a;}}elseif(!$i&&$n&&(headers_sent()||ob_get_level())){echo$n.error()."\n";}return$c;}function
unique_array($a,$J){foreach($J
as$v){if(ereg("PRIMARY|UNIQUE",$v["type"])){$c=array();foreach($v["columns"]as$e){if(!isset($a[$e])){continue
2;}$c[$e]=$a[$e];}return$c;}}$c=array();foreach($a
as$e=>$b){if(!preg_match('~^(COUNT\\((\\*|(DISTINCT )?`(?:[^`]|``)+`)\\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\\(`(?:[^`]|``)+`\\))$~',$e)){$c[$e]=$b;}}return$c;}function
where($t){global$y;$c=array();foreach((array)$t["where"]as$e=>$b){$c[]=idf_escape(bracket_escape($e,1)).(ereg('\\.',$b)||$y=="mssql"?" LIKE ".exact_value(addcslashes($b,"%_")):" = ".exact_value($b));}foreach((array)$t["null"]as$e){$c[]=idf_escape($e)." IS NULL";}return
implode(" AND ",$c);}function
where_check($b){parse_str($b,$je);remove_slashes(array(&$je));return
where($je);}function
where_link($k,$C,$r,$ef="="){return"&where%5B$k%5D%5Bcol%5D=".urlencode($C)."&where%5B$k%5D%5Bop%5D=".urlencode($ef)."&where%5B$k%5D%5Bval%5D=".urlencode($r);}function
cookie($f,$r){global$Vb;$fc=array($f,(ereg("\n",$r)?"":$r),time()+2592000,preg_replace('~\\?.*~','',$_SERVER["REQUEST_URI"]),"",$Vb);if(version_compare(PHP_VERSION,'5.2.0')>=0){$fc[]=true;}return
call_user_func_array('setcookie',$fc);}function
restart_session(){if(!ini_bool("session.use_cookies")){session_start();}}function&get_session($e){return$_SESSION[$e][DRIVER][SERVER][$_GET["username"]];}function
set_session($e,$b){$_SESSION[$e][DRIVER][SERVER][$_GET["username"]]=$b;}function
auth_url($Ob,$E,$P){global$ka;preg_match('~([^?]*)\\??(.*)~',remove_from_uri(implode("|",array_keys($ka))."|username|".session_name()),$l);return"$l[1]?".(SID&&!$_COOKIE?SID."&":"").($Ob!="server"||$E!=""?urlencode($Ob)."=".urlencode($E)."&":"")."username=".urlencode($P).($l[2]?"&$l[2]":"");}function
redirect($ja,$va=null){if(isset($va)){restart_session();$_SESSION["messages"][]=$va;}if(isset($ja)){header("Location: ".($ja!=""?$ja:"."));exit;}}function
query_redirect($j,$ja,$va,$Dc=true,$ff=true,$se=false){global$g,$n,$p;if($ff){$se=!$g->query($j);}$xd="";if($j){$xd=$p->messageQuery($j);}if($se){$n=error().$xd;return
false;}if($Dc){redirect($ja,$va.$xd);}return
true;}function
queries($j=null){global$g;static$ab=array();if(!isset($j)){return
implode(";\n",$ab);}$ab[]=$j;return$g->query($j);}function
apply_queries($j,$F,$if='table'){foreach($F
as$h){if(!queries("$j ".$if($h))){return
false;}}return
true;}function
queries_redirect($ja,$va,$Dc){return
query_redirect(queries(),$ja,$va,$Dc,false,!$Dc);}function
remove_from_uri($Xa=""){return
substr(preg_replace("~(?<=[?&])($Xa".(SID?"":"|".session_name()).")=[^&]*&~",'',"$_SERVER[REQUEST_URI]&"),0,-1);}function
pagination($Y,$hf){return" ".($Y==$hf?$Y+1:'<a href="'.h(remove_from_uri("page").($Y?"&page=$Y":"")).'">'.($Y+1)."</a>");}function
get_file($e,$ze=false){$sa=$_FILES[$e];if(!$sa||$sa["error"]){return$sa["error"];}return
file_get_contents($ze&&ereg('\\.gz$',$sa["name"])?"compress.zlib://$sa[tmp_name]":($ze&&ereg('\\.bz2$',$sa["name"])?"compress.bzip2://$sa[tmp_name]":$sa["tmp_name"]));}function
upload_error($n){$xe=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):null);return($n?'Nepodařilo se nahrát soubor.'.($xe?" ".sprintf('Maximální povolená velikost souboru je %sB.',$xe):""):'Soubor neexistuje.');}function
odd($c=' class="odd"'){static$k=0;if(!$c){$k=-1;}return($k++%
2?$c:'');}function
is_utf8($b){return(preg_match('~~u',$b)&&!preg_match('~[\\0-\\x8\\xB\\xC\\xE-\\x1F]~',$b));}function
shorten_utf8($D,$aa=80,$gf=""){if(!preg_match("(^([\t\r\n -\x{FFFF}]{0,$aa})($)?)u",$D,$l)){preg_match("(^([\t\r\n -~]{0,$aa})($)?)",$D,$l);}return
h($l[1]).$gf.(isset($l[2])?"":"<i>...</i>");}function
friendly_url($b){return
preg_replace('~[^a-z0-9_]~i','-',$b);}function
hidden_fields($xb,$jf=array()){while(list($e,$b)=each($xb)){if(is_array($b)){foreach($b
as$Ja=>$w){$xb[$e."[$Ja]"]=$w;}}elseif(!in_array($e,$jf)){echo'<input type="hidden" name="'.h($e).'" value="'.h($b).'">';}}}function
hidden_fields_get(){echo(SID&&!$_COOKIE?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
column_foreign_keys($h){global$p;$c=array();foreach($p->foreignKeys($h)as$A){foreach($A["source"]as$b){$c[$b][]=$A;}}return$c;}function
enum_input($_,$Sa,$d,$r){preg_match_all("~'((?:[^']|'')*)'~",$d["length"],$ta);$c="";foreach($ta[1]as$k=>$b){$b=stripcslashes(str_replace("''","'",$b));$Ea=(is_int($r)?$r==$k+1:(is_array($r)?in_array($k+1,$r):$r===$b));$c.=" <label><input type='$_'$Sa value='".($k+1)."'".($Ea?' checked':'').'>'.h($b).'</label>';}return$c;}function
input($d,$r,$O){global$T,$p,$y;$f=h(bracket_escape($d["field"]));echo"<td class='function'>";$ca=(isset($_GET["select"])?array("orig"=>'původní'):array())+$p->editFunctions($d);$Sa=" name='fields[$f]'";if($d["type"]=="enum"){echo
nbsp($ca[""])."<td>".$p->editInput($_GET["edit"],$d,$Sa,$r);}else{$cb=0;foreach($ca
as$e=>$b){if($e===""||!$b){break;}$cb++;}$Fb=($cb?" onchange=\"var f = this.form['function[".js_escape($f)."]']; if ($cb > f.selectedIndex) f.selectedIndex = $cb;\"":"");$Sa.=$Fb;echo(count($ca)>1?html_select("function[$f]",$ca,!isset($O)||in_array($O,$ca)||isset($ca[$O])?$O:""):nbsp(reset($ca))).'<td>';$ve=$p->editInput($_GET["edit"],$d,$Sa,$r);if($ve!=""){echo$ve;}elseif($d["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$d["length"],$ta);foreach($ta[1]as$k=>$b){$b=stripcslashes(str_replace("''","'",$b));$Ea=(is_int($r)?($r>>$k)&1:in_array($b,explode(",",$r),true));echo" <label><input type='checkbox' name='fields[$f][$k]' value='".(1<<$k)."'".($Ea?' checked':'')."$Fb>".h($b).'</label>';}}elseif(ereg('blob|bytea|raw|file',$d["type"])&&ini_bool("file_uploads")){echo"<input type='file' name='fields-$f'$Fb>";}elseif(ereg('text|lob',$d["type"])){echo"<textarea ".($y!="sqlite"||ereg("\n",$r)?"cols='50' rows='12'":"cols='30' rows='1' style='height: 1.2em;'")."$Sa onkeydown='return textareaKeydown(this, event);'>".h($r).'</textarea>';}else{$td=(!ereg('int',$d["type"])&&preg_match('~^(\\d+)(,(\\d+))?$~',$d["length"],$l)?((ereg("binary",$d["type"])?2:1)*$l[1]+($l[3]?1:0)+($l[2]&&!$d["unsigned"]?1:0)):($T[$d["type"]]?$T[$d["type"]]+($d["unsigned"]?0:1):0));echo"<input value='".h($r)."'".($td?" maxlength='$td'":"").(ereg('char|binary',$d["type"])&&$td>20?" size='40'":"")."$Sa>";}}}function
process_input($d){global$p;$Q=bracket_escape($d["field"]);$O=$_POST["function"][$Q];$r=$_POST["fields"][$Q];if($d["type"]=="enum"){if($r==-1){return
false;}if($r==""){return"NULL";}return+$r;}if($d["auto_increment"]&&$r==""){return
null;}if($O=="orig"){return
false;}if($O=="NULL"){return"NULL";}if($d["type"]=="set"){return
array_sum((array)$r);}if(ereg('blob|bytea|raw|file',$d["type"])&&ini_bool("file_uploads")){$sa=get_file("fields-$Q");if(!is_string($sa)){return
false;}return
q($sa);}return$p->processInput($d,$r,$O);}function
search_tables(){global$p,$g;$_GET["where"][0]["op"]="LIKE %%";$_GET["where"][0]["val"]=$_POST["query"];$pa=false;foreach(table_status()as$h=>$I){$f=$p->tableName($I);if(isset($I["Engine"])&&$f!=""&&(!$_POST["tables"]||in_array($h,$_POST["tables"]))){$i=$g->query("SELECT".limit("1 FROM ".table($h)," WHERE ".implode(" AND ",$p->selectSearchProcess(fields($h),array())),1));if($i->fetch_row()){if(!$pa){echo"<ul>\n";$pa=true;}echo"<li><a href='".h(ME."select=".urlencode($h)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>".h($f)."</a>\n";}}}echo($pa?"</ul>":"<p class='message'>".'Žádné tabulky.')."\n";}function
dump_csv($a){foreach($a
as$e=>$b){if(preg_match("~[\"\n,;\t]~",$b)||$b===""){$a[$e]='"'.str_replace('"','""',$b).'"';}}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$a)."\n";}function
apply_sql_function($O,$C){return($O?($O=="unixepoch"?"DATETIME($C, '$O')":($O=="count distinct"?"COUNT(DISTINCT ":strtoupper("$O("))."$C)"):$C);}function
password_file(){$Mc=ini_get("upload_tmp_dir");if(!$Mc){if(function_exists('sys_get_temp_dir')){$Mc=sys_get_temp_dir();}else{$X=@tempnam("","");if(!$X){return
false;}$Mc=dirname($X);unlink($X);}}$X="$Mc/adminer.key";$c=@file_get_contents($X);if($c){return$c;}$Ha=@fopen($X,"w");if($Ha){$c=md5(uniqid(mt_rand(),true));fwrite($Ha,$c);fclose($Ha);}return$c;}function
is_mail($Ue){$ye='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$qc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$ha="$ye+(\\.$ye+)*@($qc?\\.)+$qc";return
preg_match("(^$ha(,\\s*$ha)*\$)i",$Ue);}function
is_url($D){$qc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return(preg_match("~^(https?)://($qc?\\.)+$qc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$D,$l)?strtolower($l[1]):"");}function
print_fieldset($U,$Ye,$Ve=false){echo"<fieldset><legend><a href='#fieldset-$U' onclick=\"return !toggle('fieldset-$U');\">$Ye</a></legend><div id='fieldset-$U'".($Ve?"":" class='hidden'").">\n";}function
bold($D,$Xe){return($Xe?"<b>$D</b>":$D);}if(!isset($_SERVER["REQUEST_URI"])){$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"].($_SERVER["QUERY_STRING"]!=""?"?$_SERVER[QUERY_STRING]":"");}$Vb=$_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_name("adminer_sid");$fc=array(0,preg_replace('~\\?.*~','',$_SERVER["REQUEST_URI"]),"",$Vb);if(version_compare(PHP_VERSION,'5.2.0')>=0){$fc[]=true;}call_user_func_array('session_set_cookie_params',$fc);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE));if(function_exists("set_magic_quotes_runtime")){set_magic_quotes_runtime(false);}@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",20);function
lang($We,$pc){$oc=($pc==1||(!$pc&&'cs'=='fr')?0:((!$pc||$pc>=5)&&ereg('cs|sk|ru','cs')?2:1));return
sprintf($We[$oc],$pc);}if(extension_loaded('pdo')){class
Min_PDO
extends
PDO{var$_result,$server_info,$affected_rows,$error;function
__construct(){}function
dsn($Ze,$P,$S,$bf='auth_error'){set_exception_handler($bf);parent::__construct($Ze,$P,$S);restore_exception_handler();$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=$this->getAttribute(4);}function
query($j,$Ya=false){$i=parent::query($j);if(!$i){$mf=$this->errorInfo();$this->error=$mf[2];return
false;}$this->store_result($i);return$i;}function
multi_query($j){return$this->_result=$this->query($j);}function
store_result($i=null){if(!$i){$i=$this->_result;}if($i->columnCount()){$i->num_rows=$i->rowCount();return$i;}$this->affected_rows=$i->rowCount();return
true;}function
next_result(){return$this->_result->nextRowset();}function
result($j,$d=0){$i=$this->query($j);if(!$i){return
false;}$a=$i->fetch();return$a[$d];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$a=(object)$this->getColumnMeta($this->_offset++);$a->orgtable=$a->table;$a->orgname=$a->name;$a->charsetnr=(in_array("blob",$a->flags)?63:0);return$a;}}}$ka=array();$ka["sqlite"]="SQLite 3";$ka["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$mc=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(extension_loaded(isset($_GET["sqlite"])?"sqlite3":"sqlite")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$error,$_link;function
Min_SQLite($X){$this->_link=new
SQLite3($X);$wd=$this->_link->version();$this->server_info=$wd["versionString"];}function
query($j){$i=@$this->_link->query($j);if(!$i){$this->error=$this->_link->lastErrorMsg();return
false;}elseif($i->numColumns()){return
new
Min_Result($i);}$this->affected_rows=$this->_link->changes();return
true;}function
quote($D){return"'".$this->_link->escapeString($D)."'";}function
store_result(){return$this->_result;}function
result($j,$d=0){$i=$this->query($j);if(!is_object($i)){return
false;}$a=$i->_result->fetchArray();return$a[$d];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
Min_Result($i){$this->_result=$i;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$C=$this->_offset++;$_=$this->_result->columnType($C);return(object)array("name"=>$this->_result->columnName($C),"type"=>$_,"charsetnr"=>($_==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
Min_SQLite($X){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($X);}function
query($j,$Ya=false){$yf=($Ya?"unbufferedQuery":"query");$i=@$this->_link->$yf($j,SQLITE_BOTH,$n);if(!$i){$this->error=$n;return
false;}elseif($i===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($i);}function
quote($D){return"'".sqlite_escape_string($D)."'";}function
store_result(){return$this->_result;}function
result($j,$d=0){$i=$this->query($j);if(!is_object($i)){return
false;}$a=$i->_result->fetch();return$a[$d];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
Min_Result($i){$this->_result=$i;if(method_exists($i,'numRows')){$this->num_rows=$i->numRows();}}function
fetch_assoc(){$a=$this->_result->fetch(SQLITE_ASSOC);if(!$a){return
false;}$c=array();foreach($a
as$e=>$b){$c[($e[0]=='"'?idf_unescape($e):$e)]=$b;}return$c;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$f=$this->_result->fieldName($this->_offset++);$ha='(\\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($ha\\.)?$ha\$~",$f,$l)){$h=($l[3]!=""?$l[3]:idf_unescape($l[2]));$f=($l[5]!=""?$l[5]:idf_unescape($l[4]));}return(object)array("name"=>$f,"orgname"=>$f,"orgtable"=>$h,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
Min_SQLite($X){$this->dsn(DRIVER.":$X","","");}}}class
Min_DB
extends
Min_SQLite{function
Min_DB(){$this->Min_SQLite(":memory:");}function
select_db($X){if(is_readable($X)&&$this->query("ATTACH ".$this->quote(ereg("(^[/\\]|:)",$X)?$X:dirname($_SERVER["SCRIPT_FILENAME"])."/$X")." AS a")){$this->Min_SQLite($X);return
true;}return
false;}function
multi_query($j){return$this->_result=$this->query($j);}function
next_result(){return
false;}}function
idf_escape($Q){return'"'.str_replace('"','""',$Q).'"';}function
table($Q){return
idf_escape($Q);}function
connect(){return
new
Min_DB;}function
get_databases(){return
array();}function
limit($j,$t,$M,$L=0,$Ta=" "){return" $j$t".(isset($M)?$Ta."LIMIT $M".($L?" OFFSET $L":""):"");}function
limit1($j,$t){global$g;return($g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($j,$t,1):" $j$t");}function
db_collation($s,$W){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name",1);}function
count_tables($z){return
array();}function
table_status($f=""){$c=array();foreach(get_rows("SELECT name AS Name, type AS Engine FROM sqlite_master WHERE type IN ('table', 'view')".($f!=""?" AND name = ".q($f):""))as$a){$a["Auto_increment"]="";$c[$a["Name"]]=$a;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$a){$c[$a["name"]]["Auto_increment"]=$a["seq"];}return($f!=""?$c[$f]:$c);}function
is_view($I){return$I["Engine"]=="view";}function
fk_support($I){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($h){$c=array();foreach(get_rows("PRAGMA table_info(".table($h).")")as$a){$_=strtolower($a["type"]);$xa=$a["dflt_value"];$c[$a["name"]]=array("field"=>$a["name"],"type"=>(eregi("int",$_)?"integer":(eregi("char|clob|text",$_)?"text":(eregi("blob",$_)?"blob":(eregi("real|floa|doub",$_)?"real":"numeric")))),"full_type"=>$_,"default"=>(ereg("'(.*)'",$xa,$l)?str_replace("''","'",$l[1]):($xa=="NULL"?null:$xa)),"null"=>!$a["notnull"],"auto_increment"=>eregi('^integer$',$_)&&$a["pk"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$a["pk"],);}return$c;}function
indexes($h,$H=null){$c=array();$Ia=array();foreach(fields($h)as$d){if($d["primary"]){$Ia[]=$d["field"];}}if($Ia){$c[""]=array("type"=>"PRIMARY","columns"=>$Ia,"lengths"=>array());}foreach(get_rows("PRAGMA index_list(".table($h).")")as$a){$c[$a["name"]]["type"]=($a["unique"]?"UNIQUE":"INDEX");$c[$a["name"]]["lengths"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($a["name"]).")")as$xc){$c[$a["name"]]["columns"][]=$xc["name"];}}return$c;}function
foreign_keys($h){$c=array();foreach(get_rows("PRAGMA foreign_key_list(".table($h).")")as$a){$A=&$c[$a["id"]];if(!$A){$A=$a;}$A["source"][]=$a["from"];$A["target"][]=$a["to"];}return$c;}function
view($f){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($f))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($s){return
false;}function
error(){global$g;return
h($g->error);}function
exact_value($b){return
q($b);}function
check_sqlite_name($f){global$g;$ie="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($ie)\$~",$f)){$g->error=sprintf('Prosím použijte jednu z koncovek %s.',str_replace("|",", ",$ie));return
false;}return
true;}function
create_database($s,$R){global$g;if(file_exists($s)){$g->error='Soubor existuje.';return
false;}if(!check_sqlite_name($s)){return
false;}$x=new
Min_SQLite($s);$x->query('PRAGMA encoding = "UTF-8"');$x->query('CREATE TABLE adminer (i)');$x->query('DROP TABLE adminer');return
true;}function
drop_databases($z){global$g;$g->Min_SQLite(":memory:");foreach($z
as$s){if(!@unlink($s)){$g->error='Soubor existuje.';return
false;}}return
true;}function
rename_database($f,$R){global$g;if(!check_sqlite_name($f)){return
false;}$g->Min_SQLite(":memory:");$g->error='Soubor existuje.';return@rename(DB,$f);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($h,$f,$o,$eb,$ya,$tb,$R,$Na,$ob){$u=array();foreach($o
as$d){if($d[1]){$u[]=($h!=""&&$d[0]==""?"ADD ":"  ").implode($d[1]);}}$u=array_merge($u,$eb);if($h!=""){foreach($u
as$b){if(!queries("ALTER TABLE ".table($h)." $b")){return
false;}}if($h!=$f&&!queries("ALTER TABLE ".table($h)." RENAME TO ".table($f))){return
false;}}elseif(!queries("CREATE TABLE ".table($f)." (\n".implode(",\n",$u)."\n)")){return
false;}if($Na){queries("UPDATE sqlite_sequence SET seq = $Na WHERE name = ".q($f));}return
true;}function
alter_indexes($h,$u){foreach($u
as$b){if(!queries(($b[2]?"DROP INDEX":"CREATE".($b[0]!="INDEX"?" UNIQUE":"")." INDEX ".idf_escape(uniqid($h."_"))." ON ".table($h))." $b[1]")){return
false;}}return
true;}function
truncate_tables($F){return
apply_queries("DELETE FROM",$F);}function
drop_views($Z){return
apply_queries("DROP VIEW",$Z);}function
drop_tables($F){return
apply_queries("DROP TABLE",$F);}function
move_tables($F,$Z,$qa){return
false;}function
trigger($f){global$g;preg_match('~^CREATE\\s+TRIGGER\\s*(?:[^`"\\s]+|`[^`]*`|"[^"]*")+\\s*([a-z]+)\\s+([a-z]+)\\s+ON\\s*(?:[^`"\\s]+|`[^`]*`|"[^"]*")+\\s*(?:FOR\\s*EACH\\s*ROW\\s)?(.*)~is',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($f)),$l);return
array("Timing"=>strtoupper($l[1]),"Event"=>strtoupper($l[2]),"Trigger"=>$f,"Statement"=>$l[3]);}function
triggers($h){$c=array();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($h))as$a){preg_match('~^CREATE\\s+TRIGGER\\s*(?:[^`"\\s]+|`[^`]*`|"[^"]*")+\\s*([a-z]+)\\s*([a-z]+)~i',$a["sql"],$l);$c[$a["name"]]=array($l[1],$l[2]);}return$c;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Type"=>array("FOR EACH ROW"),);}function
routine($f,$_){}function
routines(){}function
begin(){return
queries("BEGIN");}function
insert_into($h,$q){return
queries("INSERT INTO ".table($h).($q?" (".implode(", ",array_keys($q)).")\nVALUES (".implode(", ",$q).")":"DEFAULT VALUES"));}function
insert_update($h,$q,$Ia){return
queries("REPLACE INTO ".table($h)." (".implode(", ",array_keys($q)).") VALUES (".implode(", ",$q).")");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$j){return$g->query("EXPLAIN $j");}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($_d){return
true;}function
create_sql($h,$Na){global$g;return$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($h));}function
truncate_sql($h){return"DELETE FROM ".table($h);}function
use_sql($ea){}function
trigger_sql($h,$V){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND name = ".q($h)));}function
show_variables(){global$g;$c=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$e){$c[$e]=$g->result("PRAGMA $e");}return$c;}function
show_status(){$c=array();foreach(get_vals("PRAGMA compile_options")as$xf){list($e,$b)=explode("=",$xf,2);$c[$e]=$b;}return$c;}function
support($mb){return
ereg('^(view|trigger|variables|status|dump)$',$mb);}$y="sqlite";$T=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Oa=array_keys($T);$sb=array();$Zb=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$ca=array("hex","length","lower","round","unixepoch","upper");$pb=array("avg","count","count distinct","group_concat","max","min","sum");$Wb=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$ka["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$mc=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error;function
_error($_f,$n){if(ini_bool("html_errors")){$n=html_entity_decode(strip_tags($n));}$n=ereg_replace('^[^:]*: ','',$n);$this->error=$n;}function
connect($E,$P,$S){set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($E,"'\\"))."' user='".addcslashes($P,"'\\")."' password='".addcslashes($S,"'\\")."'";$this->_link=@pg_connect($this->_string.(DB!=""?" dbname='".addcslashes(DB,"'\\")."'":" dbname='template1'"),PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&DB!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='template1'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$wd=pg_version($this->_link);$this->server_info=$wd["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($D){return"'".pg_escape_string($this->_link,$D)."'";}function
select_db($ea){if($ea==DB){return$this->_database;}$c=@pg_connect("$this->_string dbname='".addcslashes($ea,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($c){$this->_link=$c;}return$c;}function
close(){$this->_link=@pg_connect("$this->_string dbname='template1'");}function
query($j,$Ya=false){$i=@pg_query($this->_link,$j);if(!$i){$this->error=pg_last_error($this->_link);return
false;}elseif(!pg_num_fields($i)){$this->affected_rows=pg_affected_rows($i);return
true;}return
new
Min_Result($i);}function
multi_query($j){return$this->_result=$this->query($j);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($j,$d=0){$i=$this->query($j);if(!$i){return
false;}return
pg_fetch_result($i->_result,0,$d);}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
Min_Result($i){$this->_result=$i;$this->num_rows=pg_num_rows($i);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$C=$this->_offset++;$c=new
stdClass;if(function_exists('pg_field_table')){$c->orgtable=pg_field_table($this->_result,$C);}$c->name=pg_field_name($this->_result,$C);$c->orgname=$c->name;$c->type=pg_field_type($this->_result,$C);$c->charsetnr=($c->type=="bytea"?63:0);return$c;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL";function
connect($E,$P,$S){$D="pgsql:host='".str_replace(":","' port='",addcslashes($E,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn($D.(DB!=""?" dbname='".addcslashes(DB,"'\\")."'":""),$P,$S);return
true;}function
select_db($ea){return(DB==$ea);}function
close(){}}}function
idf_escape($Q){return'"'.str_replace('"','""',$Q).'"';}function
table($Q){return
idf_escape($Q);}function
connect(){global$p;$g=new
Min_DB;$Aa=$p->credentials();if($g->connect($Aa[0],$Aa[1],$Aa[2])){return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database");}function
limit($j,$t,$M,$L=0,$Ta=" "){return" $j$t".(isset($M)?$Ta."LIMIT $M".($L?" OFFSET $L":""):"");}function
limit1($j,$t){return" $j$t";}function
db_collation($s,$W){global$g;return$g->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){return
get_key_vals("SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema() ORDER BY table_name");}function
count_tables($z){return
array();}function
table_status($f=""){$c=array();foreach(get_rows("SELECT relname AS \"Name\", CASE relkind WHEN 'r' THEN '' ELSE 'view' END AS \"Engine\", pg_relation_size(oid) AS \"Data_length\", pg_total_relation_size(oid) - pg_relation_size(oid) AS \"Index_length\", obj_description(oid, 'pg_class') AS \"Comment\"
FROM pg_class
WHERE relkind IN ('r','v')
AND relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())".($f!=""?" AND relname = ".q($f):""))as$a){$c[$a["Name"]]=$a;}return($f!=""?$c[$f]:$c);}function
is_view($I){return$I["Engine"]=="view";}function
fk_support($I){return
true;}function
fields($h){$c=array();foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull, col_description(c.oid, a.attnum) AS comment
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($h)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$a){ereg('(.*)(\\((.*)\\))?',$a["full_type"],$l);list(,$a["type"],,$a["length"])=$l;$a["full_type"]=$a["type"].($a["length"]?"($a[length])":"");$a["null"]=($a["attnotnull"]=="f");$a["auto_increment"]=eregi("^nextval\\(",$a["default"]);$a["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);$c[$a["field"]]=$a;}return$c;}function
indexes($h,$H=null){global$g;if(!is_object($H)){$H=$g;}$c=array();$ue=$H->result("SELECT oid FROM pg_class WHERE relname = ".q($h));$B=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $ue AND attnum > 0",$H);foreach(get_rows("SELECT relname, indisunique, indisprimary, indkey FROM pg_index i, pg_class ci WHERE i.indrelid = $ue AND ci.oid = i.indexrelid",$H)as$a){$c[$a["relname"]]["type"]=($a["indisprimary"]=="t"?"PRIMARY":($a["indisunique"]=="t"?"UNIQUE":"INDEX"));$c[$a["relname"]]["columns"]=array();foreach(explode(" ",$a["indkey"])as$Cf){$c[$a["relname"]]["columns"][]=$B[$Cf];}$c[$a["relname"]]["lengths"]=array();}return$c;}function
foreign_keys($h){$c=array();foreach(get_rows("SELECT tc.constraint_name, kcu.column_name, rc.update_rule AS on_update, rc.delete_rule AS on_delete, ccu.table_name AS table, ccu.column_name AS ref
FROM information_schema.table_constraints tc
LEFT JOIN information_schema.key_column_usage kcu USING (constraint_catalog, constraint_schema, constraint_name)
LEFT JOIN information_schema.referential_constraints rc USING (constraint_catalog, constraint_schema, constraint_name)
LEFT JOIN information_schema.constraint_column_usage ccu ON rc.unique_constraint_catalog = ccu.constraint_catalog AND rc.unique_constraint_schema = ccu.constraint_schema AND rc.unique_constraint_name = ccu.constraint_name
WHERE tc.constraint_type = 'FOREIGN KEY' AND tc.table_name = ".q($h))as$a){$A=&$c[$a["constraint_name"]];if(!$A){$A=$a;}$A["source"][]=$a["column_name"];$A["target"][]=$a["ref"];}return$c;}function
view($f){global$g;return
array("select"=>$g->result("SELECT pg_get_viewdef(".q($f).")"));}function
collations(){return
array();}function
information_schema($s){return($s=="information_schema");}function
error(){global$g;$c=h($g->error);if(preg_match('~^(.*\\n)?([^\\n]*)\\n( *)\\^(\\n.*)?$~s',$c,$l)){$c=$l[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($l[3]).'})(.*)~','\\1<b>\\2</b>',$l[2]).$l[4];}return
nl_br($c);}function
exact_value($b){return
q($b);}function
create_database($s,$R){return
queries("CREATE DATABASE ".idf_escape($s).($R?" ENCODING ".idf_escape($R):""));}function
drop_databases($z){global$g;$g->close();return
apply_queries("DROP DATABASE",$z,'idf_escape');}function
rename_database($f,$R){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($f));}function
auto_increment(){return"";}function
alter_table($h,$f,$o,$eb,$ya,$tb,$R,$Na,$ob){$u=array();$ab=array();foreach($o
as$d){$C=idf_escape($d[0]);$b=$d[1];if(!$b){$u[]="DROP $C";}else{$qd=$b[5];unset($b[5]);if(isset($b[6])&&$d[0]==""){$b[1]=($b[1]=="bigint"?" big":" ")."serial";}if($d[0]==""){$u[]=($h!=""?"ADD ":"  ").implode($b);}else{if($C!=$b[0]){$ab[]="ALTER TABLE ".table($h)." RENAME $C TO $b[0]";}$u[]="ALTER $C TYPE$b[1]";if(!$b[6]){$u[]="ALTER $C ".($b[3]?"SET$b[3]":"DROP DEFAULT");$u[]="ALTER $C ".($b[2]==" NULL"?"DROP NOT":"SET").$b[2];}}if($d[0]!=""||$qd!=""){$ab[]="COMMENT ON COLUMN ".table($h).".$b[0] IS ".($qd!=""?substr($qd,9):"''");}}}$u=array_merge($u,$eb);if($h==""){array_unshift($ab,"CREATE TABLE ".table($f)." (\n".implode(",\n",$u)."\n)");}elseif($u){array_unshift($ab,"ALTER TABLE ".table($h)."\n".implode(",\n",$u));}if($h!=""&&$h!=$f){$ab[]="ALTER TABLE ".table($h)." RENAME TO ".table($f);}if($h!=""||$ya!=""){$ab[]="COMMENT ON TABLE ".table($f)." IS ".q($ya);}if($Na!=""){}foreach($ab
as$j){if(!queries($j)){return
false;}}return
true;}function
alter_indexes($h,$u){$ga=array();$Fa=array();foreach($u
as$b){if($b[0]!="INDEX"){$ga[]=($b[2]?"\nDROP CONSTRAINT ":"\nADD $b[0] ".($b[0]=="PRIMARY"?"KEY ":"")).$b[1];}elseif($b[2]){$Fa[]=$b[1];}elseif(!queries("CREATE INDEX ".idf_escape(uniqid($h."_"))." ON ".table($h)." $b[1]")){return
false;}}return((!$ga||queries("ALTER TABLE ".table($h).implode(",",$ga)))&&(!$Fa||queries("DROP INDEX ".implode(", ",$Fa))));}function
truncate_tables($F){return
queries("TRUNCATE ".implode(", ",array_map('table',$F)));return
true;}function
drop_views($Z){return
queries("DROP VIEW ".implode(", ",array_map('table',$Z)));}function
drop_tables($F){return
queries("DROP TABLE ".implode(", ",array_map('table',$F)));}function
move_tables($F,$Z,$qa){foreach($F
as$h){if(!queries("ALTER TABLE ".table($h)." SET SCHEMA ".idf_escape($qa))){return
false;}}foreach($Z
as$h){if(!queries("ALTER VIEW ".table($h)." SET SCHEMA ".idf_escape($qa))){return
false;}}return
true;}function
trigger($f){$G=get_rows('SELECT trigger_name AS "Trigger", condition_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers WHERE event_object_table = '.q($_GET["trigger"]).' AND trigger_name = '.q($f));return
reset($G);}function
triggers($h){$c=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($h))as$a){$c[$a["trigger_name"]]=array($a["condition_timing"],$a["event_manipulation"]);}return$c;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
begin(){return
queries("BEGIN");}function
insert_into($h,$q){return
queries("INSERT INTO ".table($h).($q?" (".implode(", ",array_keys($q)).")\nVALUES (".implode(", ",$q).")":"DEFAULT VALUES"));}function
insert_update($h,$q,$Ia){global$g;$na=array();$t=array();foreach($q
as$e=>$b){$na[]="$e = $b";if(isset($Ia[idf_unescape($e)])){$t[]="$e = $b";}}return($t&&queries("UPDATE ".table($h)." SET ".implode(", ",$na)." WHERE ".implode(" AND ",$t))&&$g->affected_rows)||queries("INSERT INTO ".table($h)." (".implode(", ",array_keys($q)).") VALUES (".implode(", ",$q).")");}function
last_id(){return
0;}function
explain($g,$j){return$g->query("EXPLAIN $j");}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($La){global$g,$T,$Oa;$c=$g->query("SET search_path TO ".idf_escape($La));foreach(types()as$_){if(!isset($T[$_])){$T[$_]=0;$Oa['Uživatelské typy'][]=$_;}}return$c;}function
use_sql($ea){return"\connect ".idf_escape($ea);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
show_status(){}function
support($mb){return
ereg('^(comment|view|scheme|sequence|trigger|type|variables|drop_col)$',$mb);}$y="pgsql";$T=array();$Oa=array();foreach(array('Čísla'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Datum a čas'=>array("date"=>13,"time"=>17,"timestamp"=>20,"interval"=>0),'Řetězce'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binární'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Síť'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometrie'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$e=>$b){$T+=$b;$Oa[$e]=array_keys($b);}$sb=array();$Zb=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$ca=array("char_length","lower","round","to_hex","to_timestamp","upper");$pb=array("avg","count","count distinct","max","min","sum");$Wb=array(array("char"=>"md5","date|time"=>"now",),array("int|numeric|real|money"=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$ka["oracle"]="Oracle";if(isset($_GET["oracle"])){$mc=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$error;function
_error($_f,$n){if(ini_bool("html_errors")){$n=html_entity_decode(strip_tags($n));}$n=ereg_replace('^[^:]*: ','',$n);$this->error=$n;}function
connect($E,$P,$S){$this->_link=@oci_new_connect($P,$S,$E);if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($D){return"'".str_replace("'","''",$D)."'";}function
select_db($ea){return
true;}function
query($j,$Ya=false){$i=oci_parse($this->_link,$j);if(!$i){$n=oci_error($this->_link);$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$c=@oci_execute($i);restore_error_handler();if($c){if(oci_num_fields($i)){return
new
Min_Result($i);}$this->affected_rows=oci_num_rows($i);}return$c;}function
multi_query($j){return$this->_result=$this->query($j);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($j,$d=1){$i=$this->query($j);if(!is_object($i)||!oci_fetch($i->_result)){return
false;}return
oci_result($i->_result,$d);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
Min_Result($i){$this->_result=$i;}function
_convert($a){foreach((array)$a
as$e=>$b){if(is_a($b,'OCI-Lob')){$a[$e]=$b->load();}}return$a;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$C=$this->_offset++;$c=new
stdClass;$c->name=oci_field_name($this->_result,$C);$c->orgname=$c->name;$c->type=oci_field_type($this->_result,$C);$c->charsetnr=(ereg("raw|blob|bfile",$c->type)?63:0);return$c;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($E,$P,$S){}function
select_db($ea){}}}function
idf_escape($Q){return'"'.str_replace('"','""',$Q).'"';}function
table($Q){return
idf_escape($Q);}function
connect(){global$p;$g=new
Min_DB;$Aa=$p->credentials();if($g->connect($Aa[0],$Aa[1],$Aa[2])){return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($j,$t,$M,$L=0,$Ta=" "){return" $j$t".(isset($M)?($t?" AND":$Ta."WHERE").($L?" rownum > $L AND":"")." rownum <= ".($M+$L):"");}function
limit1($j,$t){return" $j$t";}function
db_collation($s,$W){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views");}function
count_tables($z){return
array();}function
table_status($f=""){$c=array();$oe=q($f);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine" FROM all_tables WHERE tablespace_name = '.q(DB).($f!=""?" AND table_name = $oe":"")."
UNION SELECT view_name, 'view' FROM user_views".($f!=""?" WHERE view_name = $oe":""))as$a){if($f!=""){return$a;}$c[$a["Name"]]=$a;}return$c;}function
is_view($I){return$I["Engine"]=="view";}function
fk_support($I){return
true;}function
fields($h){$c=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($h)." ORDER BY column_id")as$a){$_=$a["DATA_TYPE"];$aa="$a[DATA_PRECISION],$a[DATA_SCALE]";if($aa==","){$aa=$a["DATA_LENGTH"];}$c[$a["COLUMN_NAME"]]=array("field"=>$a["COLUMN_NAME"],"full_type"=>$_.($aa?"($aa)":""),"type"=>strtolower($_),"length"=>$aa,"default"=>$a["DATA_DEFAULT"],"null"=>($a["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$c;}function
indexes($h,$H=null){return
array();}function
view($f){$G=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($f));return
reset($G);}function
collations(){return
array();}function
information_schema($s){return
false;}function
error(){global$g;return
h($g->error);}function
exact_value($b){return
q($b);}function
explain($g,$j){$g->query("EXPLAIN PLAN FOR $j");return$g->query("SELECT * FROM plan_table");}function
alter_table($h,$f,$o,$eb,$ya,$tb,$R,$Na,$ob){$u=$Fa=array();foreach($o
as$d){$b=$d[1];if($b&&$d[0]!=""&&idf_escape($d[0])!=$b[0]){queries("ALTER TABLE ".table($h)." RENAME COLUMN ".idf_escape($d[0])." TO $b[0]");}if($b){$u[]=($h!=""?($d[0]!=""?"MODIFY (":"ADD ("):"  ").implode($b).($h!=""?")":"");}else{$Fa[]=idf_escape($d[0]);}}if($h==""){return
queries("CREATE TABLE ".table($f)." (\n".implode(",\n",$u)."\n)");}return(!$u||queries("ALTER TABLE ".table($h)."\n".implode("\n",$u)))&&(!$Fa||queries("ALTER TABLE ".table($h)." DROP (".implode(", ",$Fa).")"))&&($h==$f||queries("ALTER TABLE ".table($h)." RENAME TO ".table($f)));}function
foreign_keys($h){return
array();}function
truncate_tables($F){return
apply_queries("TRUNCATE TABLE",$F);}function
drop_views($Z){return
apply_queries("DROP VIEW",$Z);}function
drop_tables($F){return
apply_queries("DROP TABLE",$F);}function
begin(){return
true;}function
insert_into($h,$q){return
queries("INSERT INTO ".table($h)." (".implode(", ",array_keys($q)).")\nVALUES (".implode(", ",$q).")");}function
last_id(){return
0;}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($_d){return
true;}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
show_status(){$G=get_rows('SELECT * FROM v$instance');return
reset($G);}function
support($mb){return
ereg("view|drop_col|variables|status",$mb);}$y="oracle";$T=array();$Oa=array();foreach(array('Čísla'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Datum a čas'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Řetězce'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binární'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$e=>$b){$T+=$b;$Oa[$e]=array_keys($b);}$sb=array();$Zb=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL");$ca=array("length","lower","round","upper");$pb=array("avg","count","count distinct","max","min","sum");$Wb=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$ka["mssql"]="MS SQL";if(isset($_GET["mssql"])){$mc=array("SQLSRV","MSSQL");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($E,$P,$S){$this->_link=@sqlsrv_connect($E,array("UID"=>$P,"PWD"=>$S));if($this->_link){$Bf=sqlsrv_server_info($this->_link);$this->server_info=$Bf['SQLServerVersion'];}else{$this->_get_error();}return(bool)$this->_link;}function
quote($D){return"'".str_replace("'","''",$D)."'";}function
select_db($ea){return$this->query("USE $ea");}function
query($j,$Ya=false){$i=sqlsrv_query($this->_link,$j);if(!$i){$this->_get_error();return
false;}return$this->store_result($i);}function
multi_query($j){$this->_result=sqlsrv_query($this->_link,$j);if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($i=null){if(!$i){$i=$this->_result;}if(sqlsrv_field_metadata($i)){return
new
Min_Result($i);}$this->affected_rows=sqlsrv_rows_affected($i);return
true;}function
next_result(){return
sqlsrv_next_result($this->_result);}function
result($j,$d=0){$i=$this->query($j);if(!is_object($i)){return
false;}$a=$i->fetch_row();return$a[$d];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
Min_Result($i){$this->_result=$i;}function
_convert($a){foreach((array)$a
as$e=>$b){if(is_a($b,'DateTime')){$a[$e]=$b->format("Y-m-d H:i:s");}}return$a;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC,SQLSRV_SCROLL_NEXT));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC,SQLSRV_SCROLL_NEXT));}function
fetch_field(){if(!$this->_fields){$this->_fields=sqlsrv_field_metadata($this->_result);}$d=$this->_fields[$this->_offset++];$c=new
stdClass;$c->name=$d["Name"];$c->orgname=$d["Name"];$c->type=($d["Type"]==1?254:0);return$c;}function
seek($L){for($k=0;$k<$L;$k++){sqlsrv_fetch($this->_result);}}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($E,$P,$S){$this->_link=@mssql_connect($E,$P,$S);if($this->_link){$i=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");$a=$i->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$a[0]] $a[1]";}else{$this->error=mssql_get_last_message();}return(bool)$this->_link;}function
quote($D){return"'".str_replace("'","''",$D)."'";}function
select_db($ea){return
mssql_select_db($ea);}function
query($j,$Ya=false){$i=mssql_query($j,$this->_link);if(!$i){$this->error=mssql_get_last_message();return
false;}if($i===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($i);}function
multi_query($j){return$this->_result=$this->query($j);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result);}function
result($j,$d=0){$i=$this->query($j);if(!is_object($i)){return
false;}return
mssql_result($i->_result,0,$d);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
Min_Result($i){$this->_result=$i;$this->num_rows=mssql_num_rows($i);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$c=mssql_fetch_field($this->_result);$c->orgtable=$c->table;$c->orgname=$c->name;return$c;}function
seek($L){mssql_data_seek($this->_result,$L);}function
__destruct(){mssql_free_result($this->_result);}}}function
idf_escape($Q){return"[".str_replace("]","]]",$Q)."]";}function
table($Q){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($Q);}function
connect(){global$p;$g=new
Min_DB;$Aa=$p->credentials();if($g->connect($Aa[0],$Aa[1],$Aa[2])){return$g;}return$g->error;}function
get_databases(){return
get_vals("EXEC sp_databases");}function
limit($j,$t,$M,$L=0,$Ta=" "){return(isset($M)?" TOP (".($M+$L).")":"")." $j$t";}function
limit1($j,$t){return
limit($j,$t,1);}function
db_collation($s,$W){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name =  ".q($s));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($z){global$g;$c=array();foreach($z
as$s){$g->select_db($s);$c[$s]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$c;}function
table_status($f=""){$c=array();foreach(get_rows("SELECT name AS Name, type_desc AS Engine FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V')".($f!=""?" AND name = ".q($f):""))as$a){if($f!=""){return$a;}$c[$a["Name"]]=$a;}return$c;}function
is_view($I){return$I["Engine"]=="VIEW";}function
fk_support($I){return
true;}function
fields($h){$c=array();foreach(get_rows("SELECT c.*, t.name type, d.definition [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($h))as$a){$_=$a["type"];$aa=(ereg("char|binary",$_)?$a["max_length"]:($_=="decimal"?"$a[precision],$a[scale]":""));$c[$a["name"]]=array("field"=>$a["name"],"full_type"=>$_.($aa?"($aa)":""),"type"=>$_,"length"=>$aa,"default"=>$a["default"],"null"=>$a["is_nullable"],"auto_increment"=>$a["is_identity"],"collation"=>$a["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$a["is_identity"],);}return$c;}function
indexes($h,$H=null){global$g;if(!is_object($H)){$H=$g;}$c=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($h),$H)as$a){$c[$a["name"]]["type"]=($a["is_primary_key"]?"PRIMARY":($a["is_unique"]?"UNIQUE":"INDEX"));$c[$a["name"]]["lengths"]=array();$c[$a["name"]]["columns"][$a["key_ordinal"]]=$a["column_name"];}return$c;}function
view($f){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\\[[^]]*])*\\s+AS\\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($f))));}function
collations(){$c=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$R){$c[ereg_replace("_.*","",$R)][]=$R;}return$c;}function
information_schema($s){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\\[[^]]*])+~m','',$g->error)));}function
exact_value($b){return
q($b);}function
create_database($s,$R){return
queries("CREATE DATABASE ".idf_escape($s).(eregi('^[a-z0-9_]+$',$R)?" COLLATE $R":""));}function
drop_databases($z){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$z)));}function
rename_database($f,$R){if(eregi('^[a-z0-9_]+$',$R)){queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $R");}queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($f));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".(+$_POST["Auto_increment"]).",1)":"");}function
alter_table($h,$f,$o,$eb,$ya,$tb,$R,$Na,$ob){$u=array();foreach($o
as$d){$C=idf_escape($d[0]);$b=$d[1];if(!$b){$u["DROP"][]=" COLUMN $d[0]";}else{$b[1]=preg_replace("~( COLLATE )'(\\w+)'~","\\1\\2",$b[1]);if($d[0]==""){$u["ADD"][]="\n  ".implode("",$b);}else{unset($b[6]);if($C!=$b[0]){queries("EXEC sp_rename ".q(table($h).".$C").", ".q(idf_unescape($b[0])).", 'COLUMN'");}$u["ALTER COLUMN ".implode("",$b)][]="";}}}if($h==""){return
queries("CREATE TABLE ".table($f)." (".implode(",",(array)$u["ADD"])."\n)");}if($h!=$f){queries("EXEC sp_rename ".q(table($h)).", ".q($f));}foreach($u
as$e=>$b){if(!queries("ALTER TABLE ".idf_escape($f)." $e".implode(",",$b))){return
false;}}return
true;}function
alter_indexes($h,$u){$v=array();$Fa=array();foreach($u
as$b){if($b[2]){if($b[0]=="PRIMARY"){$Fa[]=$b[1];}else{$v[]="$b[1] ON ".table($h);}}elseif(!queries(($b[0]!="PRIMARY"?"CREATE".($b[0]!="INDEX"?" UNIQUE":"")." INDEX ".idf_escape(uniqid($h."_"))." ON ".table($h):"ALTER TABLE ".table($h)." ADD PRIMARY KEY")." $b[1]")){return
false;}}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$Fa||queries("ALTER TABLE ".table($h)." DROP ".implode(", ",$Fa)));}function
begin(){return
queries("BEGIN TRANSACTION");}function
insert_into($h,$q){return
queries("INSERT INTO ".table($h).($q?" (".implode(", ",array_keys($q)).")\nVALUES (".implode(", ",$q).")":"DEFAULT VALUES"));}function
insert_update($h,$q,$Ia){$na=array();$t=array();foreach($q
as$e=>$b){$na[]="$e = $b";if(isset($Ia[idf_unescape($e)])){$t[]="$e = $b";}}return
queries("MERGE ".table($h)." USING (VALUES(".implode(", ",$q).")) AS source (c".implode(", c",range(1,count($q))).") ON ".implode(" AND ",$t)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$na)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($q)).") VALUES (".implode(", ",$q).");");}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$j){$g->query("SET SHOWPLAN_ALL ON");$c=$g->query($j);$g->query("SET SHOWPLAN_ALL OFF");return$c;}function
foreign_keys($h){$c=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($h))as$a){$A=&$c[$a["FK_NAME"]];$A["table"]=$a["PKTABLE_NAME"];$A["source"][]=$a["FKCOLUMN_NAME"];$A["target"][]=$a["PKCOLUMN_NAME"];}return$c;}function
truncate_tables($F){return
apply_queries("TRUNCATE TABLE",$F);}function
drop_views($Z){return
queries("DROP VIEW ".implode(", ",array_map('table',$Z)));}function
drop_tables($F){return
queries("DROP TABLE ".implode(", ",array_map('table',$F)));}function
move_tables($F,$Z,$qa){return
apply_queries("ALTER SCHEMA ".idf_escape($qa)." TRANSFER",array_merge($F,$Z));}function
trigger($f){$G=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($f));$c=reset($G);if($c){$c["Statement"]=preg_replace('~^.+\\s+AS\\s+~isU','',$c["text"]);}return$c;}function
triggers($h){$c=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($h))as$a){$c[$a["name"]]=array($a["Timing"],$a["Event"]);}return$c;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!=""){return$_GET["ns"];}return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($La){return
true;}function
use_sql($ea){return"USE ".idf_escape($ea);}function
show_variables(){return
array();}function
show_status(){return
array();}function
support($mb){return
ereg('^(scheme|trigger|view|drop_col)$',$mb);}$y="mssql";$T=array();$Oa=array();foreach(array('Čísla'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Datum a čas'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Řetězce'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binární'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$e=>$b){$T+=$b;$Oa[$e]=array_keys($b);}$sb=array();$Zb=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$ca=array("len","lower","round","upper");$pb=array("avg","count","count distinct","max","min","sum");$Wb=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$ka=array("server"=>"MySQL")+$ka;if(!defined("DRIVER")){$mc=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
Min_DB(){parent::init();}function
connect($E,$P,$S){mysqli_report(MYSQLI_REPORT_OFF);list($vf,$Sc)=explode(":",$E,2);$c=@$this->real_connect(($E!=""?$vf:ini_get("mysqli.default_host")),("$E$P"!=""?$P:ini_get("mysqli.default_user")),("$E$P$S"!=""?$S:ini_get("mysqli.default_pw")),null,(is_numeric($Sc)?$Sc:ini_get("mysqli.default_port")),(!is_numeric($Sc)?$Sc:null));if($c){if(method_exists($this,'set_charset')){$this->set_charset("utf8");}else{$this->query("SET NAMES utf8");}}return$c;}function
result($j,$d=0){$i=$this->query($j);if(!$i){return
false;}$a=$i->fetch_array();return$a[$d];}function
quote($D){return"'".$this->escape_string($D)."'";}}}elseif(extension_loaded("mysql")){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$error,$_link,$_result;function
connect($E,$P,$S){$this->_link=@mysql_connect(($E!=""?$E:ini_get("mysql.default_host")),("$E$P"!=""?$P:ini_get("mysql.default_user")),("$E$P$S"!=""?$S:ini_get("mysql.default_password")),true,131072);if($this->_link){$this->server_info=mysql_get_server_info($this->_link);if(function_exists('mysql_set_charset')){mysql_set_charset("utf8",$this->_link);}else{$this->query("SET NAMES utf8");}}else{$this->error=mysql_error();}return(bool)$this->_link;}function
quote($D){return"'".mysql_real_escape_string($D,$this->_link)."'";}function
select_db($ea){return
mysql_select_db($ea,$this->_link);}function
query($j,$Ya=false){$i=@($Ya?mysql_unbuffered_query($j,$this->_link):mysql_query($j,$this->_link));if(!$i){$this->error=mysql_error($this->_link);return
false;}if($i===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($i);}function
multi_query($j){return$this->_result=$this->query($j);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($j,$d=0){$i=$this->query($j);if(!$i){return
false;}return
mysql_result($i->_result,0,$d);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
Min_Result($i){$this->_result=$i;$this->num_rows=mysql_num_rows($i);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$c=mysql_fetch_field($this->_result,$this->_offset++);$c->orgtable=$c->table;$c->orgname=$c->name;$c->charsetnr=($c->blob?63:0);return$c;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($E,$P,$S){$this->dsn("mysql:host=".str_replace(":",";unix_socket=",preg_replace('~:(\\d)~',';port=\\1',$E)),$P,$S);$this->query("SET NAMES utf8");return
true;}function
select_db($ea){return$this->query("USE ".idf_escape($ea));}function
query($j,$Ya=false){$this->setAttribute(1000,!$Ya);return
parent::query($j,$Ya);}}}function
idf_escape($Q){return"`".str_replace("`","``",$Q)."`";}function
table($Q){return
idf_escape($Q);}function
connect(){global$p;$g=new
Min_DB;$Aa=$p->credentials();if($g->connect($Aa[0],$Aa[1],$Aa[2])){$g->query("SET SQL_QUOTE_SHOW_CREATE=1");return$g;}return$g->error;}function
get_databases($kf=true){$c=&get_session("dbs");if(!isset($c)){if($kf){restart_session();ob_flush();flush();}$c=get_vals("SHOW DATABASES");}return$c;}function
limit($j,$t,$M,$L=0,$Ta=" "){return" $j$t".(isset($M)?$Ta."LIMIT $M".($L?" OFFSET $L":""):"");}function
limit1($j,$t){return
limit($j,$t,1);}function
db_collation($s,$W){global$g;$c=null;$ga=$g->result("SHOW CREATE DATABASE ".idf_escape($s),1);if(preg_match('~ COLLATE ([^ ]+)~',$ga,$l)){$c=$l[1];}elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$ga,$l)){$c=$W[$l[1]][0];}return$c;}function
engines(){$c=array();foreach(get_rows("SHOW ENGINES")as$a){if(ereg("YES|DEFAULT",$a["Support"])){$c[]=$a["Engine"];}}return$c;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){global$g;return
get_key_vals("SHOW".($g->server_info>=5?" FULL":"")." TABLES");}function
count_tables($z){$c=array();foreach($z
as$s){$c[$s]=count(get_vals("SHOW TABLES IN ".idf_escape($s)));}return$c;}function
table_status($f=""){$c=array();foreach(get_rows("SHOW TABLE STATUS".($f!=""?" LIKE ".q(addcslashes($f,"%_")):""))as$a){if($a["Engine"]=="InnoDB"){$a["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\\1',$a["Comment"]);}if(!isset($a["Rows"])){$a["Comment"]="";}if($f!=""){return$a;}$c[$a["Name"]]=$a;}return$c;}function
is_view($I){return!isset($I["Rows"]);}function
fk_support($I){return($I["Engine"]=="InnoDB");}function
fields($h){$c=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($h))as$a){preg_match('~^([^( ]+)(?:\\((.+)\\))?( unsigned)?( zerofill)?$~',$a["Type"],$l);$c[$a["Field"]]=array("field"=>$a["Field"],"full_type"=>$a["Type"],"type"=>$l[1],"length"=>$l[2],"unsigned"=>ltrim($l[3].$l[4]),"default"=>($a["Default"]!=""||ereg("char",$l[1])?$a["Default"]:null),"null"=>($a["Null"]=="YES"),"auto_increment"=>($a["Extra"]=="auto_increment"),"on_update"=>(eregi('^on update (.+)',$a["Extra"],$l)?$l[1]:""),"collation"=>$a["Collation"],"privileges"=>array_flip(explode(",",$a["Privileges"])),"comment"=>$a["Comment"],"primary"=>($a["Key"]=="PRI"),);}return$c;}function
indexes($h,$H=null){global$g;if(!is_object($H)){$H=$g;}$c=array();foreach(get_rows("SHOW INDEX FROM ".table($h),$H)as$a){$c[$a["Key_name"]]["type"]=($a["Key_name"]=="PRIMARY"?"PRIMARY":($a["Index_type"]=="FULLTEXT"?"FULLTEXT":($a["Non_unique"]?"INDEX":"UNIQUE")));$c[$a["Key_name"]]["columns"][]=$a["Column_name"];$c[$a["Key_name"]]["lengths"][]=$a["Sub_part"];}return$c;}function
foreign_keys($h){global$g,$bb;static$ha='`(?:[^`]|``)+`';$c=array();$we=$g->result("SHOW CREATE TABLE ".table($h),1);if($we){preg_match_all("~CONSTRAINT ($ha) FOREIGN KEY \\(((?:$ha,? ?)+)\\) REFERENCES ($ha)(?:\\.($ha))? \\(((?:$ha,? ?)+)\\)(?: ON DELETE (".implode("|",$bb)."))?(?: ON UPDATE (".implode("|",$bb)."))?~",$we,$ta,PREG_SET_ORDER);foreach($ta
as$l){preg_match_all("~$ha~",$l[2],$Ga);preg_match_all("~$ha~",$l[5],$qa);$c[idf_unescape($l[1])]=array("db"=>idf_unescape($l[4]!=""?$l[3]:$l[4]),"table"=>idf_unescape($l[4]!=""?$l[4]:$l[3]),"source"=>array_map('idf_unescape',$Ga[0]),"target"=>array_map('idf_unescape',$qa[0]),"on_delete"=>$l[6],"on_update"=>$l[7],);}}return$c;}function
view($f){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\\s+AS\\s+~isU','',$g->result("SHOW CREATE VIEW ".table($f),1)));}function
collations(){$c=array();foreach(get_rows("SHOW COLLATION")as$a){$c[$a["Charset"]][]=$a["Collation"];}ksort($c);foreach($c
as$e=>$b){sort($c[$e]);}return$c;}function
information_schema($s){global$g;return($g->server_info>=5&&$s=="information_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
exact_value($b){return
q($b)." COLLATE utf8_bin";}function
create_database($s,$R){set_session("dbs",null);return
queries("CREATE DATABASE ".idf_escape($s).($R?" COLLATE ".q($R):""));}function
drop_databases($z){set_session("dbs",null);return
apply_queries("DROP DATABASE",$z,'idf_escape');}function
rename_database($f,$R){if(create_database($f,$R)){$Rb=array();foreach(tables_list()as$h=>$_){$Rb[]=table($h)." TO ".idf_escape($f).".".table($h);}if(!$Rb||queries("RENAME TABLE ".implode(", ",$Rb))){queries("DROP DATABASE ".idf_escape(DB));return
true;}}return
false;}function
auto_increment(){$sd=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$sd="";break;}if($v["type"]=="PRIMARY"){$sd=" UNIQUE";}}}return" AUTO_INCREMENT$sd";}function
alter_table($h,$f,$o,$eb,$ya,$tb,$R,$Na,$ob){$u=array();foreach($o
as$d){$u[]=($d[1]?($h!=""?($d[0]!=""?"CHANGE ".idf_escape($d[0]):"ADD"):" ")." ".implode($d[1]).($h!=""?" $d[2]":""):"DROP ".idf_escape($d[0]));}$u=array_merge($u,$eb);$Sb="COMMENT=".q($ya).($tb?" ENGINE=".q($tb):"").($R?" COLLATE ".q($R):"").($Na!=""?" AUTO_INCREMENT=$Na":"").$ob;if($h==""){return
queries("CREATE TABLE ".table($f)." (\n".implode(",\n",$u)."\n) $Sb");}if($h!=$f){$u[]="RENAME TO ".table($f);}$u[]=$Sb;return
queries("ALTER TABLE ".table($h)."\n".implode(",\n",$u));}function
alter_indexes($h,$u){foreach($u
as$e=>$b){$u[$e]=($b[2]?"\nDROP INDEX ":"\nADD $b[0] ".($b[0]=="PRIMARY"?"KEY ":"")).$b[1];}return
queries("ALTER TABLE ".table($h).implode(",",$u));}function
truncate_tables($F){return
apply_queries("TRUNCATE TABLE",$F);}function
drop_views($Z){return
queries("DROP VIEW ".implode(", ",array_map('table',$Z)));}function
drop_tables($F){return
queries("DROP TABLE ".implode(", ",array_map('table',$F)));}function
move_tables($F,$Z,$qa){$Rb=array();foreach(array_merge($F,$Z)as$h){$Rb[]=table($h)." TO ".idf_escape($qa).".".table($h);}return
queries("RENAME TABLE ".implode(", ",$Rb));}function
trigger($f){$G=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($f));return
reset($G);}function
triggers($h){$c=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($h,"%_")))as$a){$c[$a["Trigger"]]=array($a["Timing"],$a["Event"]);}return$c;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Type"=>array("FOR EACH ROW"),);}function
routine($f,$_){global$g,$Mb,$nc,$T;$uf=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$_e="((".implode("|",array_merge(array_keys($T),$uf)).")(?:\\s*\\(((?:[^'\")]*|$Mb)+)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s]+)['\"]?)?";$ha="\\s*(".($_=="FUNCTION"?"":implode("|",$nc)).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$_e";$ga=$g->result("SHOW CREATE $_ ".idf_escape($f),2);preg_match("~\\(((?:$ha\\s*,?)*)\\)".($_=="FUNCTION"?"\\s*RETURNS\\s+$_e":"")."\\s*(.*)~is",$ga,$l);$o=array();preg_match_all("~$ha\\s*,?~is",$l[1],$ta,PREG_SET_ORDER);foreach($ta
as$Xa){$f=str_replace("``","`",$Xa[2]).$Xa[3];$o[]=array("field"=>$f,"type"=>strtolower($Xa[5]),"length"=>preg_replace_callback("~$Mb~s",'normalize_enum',$Xa[6]),"unsigned"=>strtolower(preg_replace('~\\s+~',' ',trim("$Xa[8] $Xa[7]"))),"full_type"=>$Xa[4],"inout"=>strtoupper($Xa[1]),"collation"=>strtolower($Xa[9]),);}if($_!="FUNCTION"){return
array("fields"=>$o,"definition"=>$l[11]);}return
array("fields"=>$o,"returns"=>array("type"=>$l[12],"length"=>$l[13],"unsigned"=>$l[15],"collation"=>$l[16]),"definition"=>$l[17],);}function
routines(){return
get_rows("SELECT * FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
begin(){return
queries("BEGIN");}function
insert_into($h,$q){return
queries("INSERT INTO ".table($h)." (".implode(", ",array_keys($q)).")\nVALUES (".implode(", ",$q).")");}function
insert_update($h,$q,$Ia){foreach($q
as$e=>$b){$q[$e]="$e = $b";}$na=implode(", ",$q);return
queries("INSERT INTO ".table($h)." SET $na ON DUPLICATE KEY UPDATE $na");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$j){return$g->query("EXPLAIN $j");}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($La){return
true;}function
create_sql($h,$Na){global$g;$c=$g->result("SHOW CREATE TABLE ".table($h),1);if(!$Na){$c=preg_replace('~ AUTO_INCREMENT=\\d+~','',$c);}return$c;}function
truncate_sql($h){return"TRUNCATE ".table($h);}function
use_sql($ea){return"USE ".idf_escape($ea);}function
trigger_sql($h,$V){$c="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($h,"%_")),null,"-- ")as$a){$c.="\n".($V=='CREATE+ALTER'?"DROP TRIGGER IF EXISTS ".idf_escape($a["Trigger"]).";;\n":"")."CREATE TRIGGER ".idf_escape($a["Trigger"])." $a[Timing] $a[Event] ON ".table($a["Table"])." FOR EACH ROW\n$a[Statement];;\n";}return$c;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
support($mb){global$g;return!ereg("scheme|sequence|type".($g->server_info<5.1?"|event|partitioning".($g->server_info<5?"|view|routine|trigger":""):""),$mb);}$y="sql";$T=array();$Oa=array();foreach(array('Čísla'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Datum a čas'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Řetězce'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Binární'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Seznamy'=>array("enum"=>65535,"set"=>64),)as$e=>$b){$T+=$b;$Oa[$e]=array_keys($b);}$sb=array("unsigned","zerofill","unsigned zerofill");$Zb=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL");$ca=array("char_length","date","from_unixtime","hex","lower","round","sec_to_time","time_to_sec","upper");$pb=array("avg","count","count distinct","group_concat","max","min","sum");$Wb=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1/hex","date|time"=>"now",),array("int|float|double|decimal"=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~^[^?]*/([^?]*).*~','\\1',$_SERVER["REQUEST_URI"]).'?'.(SID&&!$_COOKIE?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$Pc="3.1.0";class
Adminer{var$operators;function
name(){return"Adminer";}function
credentials(){return
array(SERVER,$_GET["username"],get_session("pwds"));}function
permanentLogin(){return
password_file();}function
database(){return
DB;}function
headers(){header("X-Frame-Options: deny");header("X-XSS-Protection: 0");}function
loginForm(){global$ka;echo'<table cellspacing="0">
<tr><th>Systém<td>',html_select("driver",$ka,DRIVER),'<tr><th>Server<td><input name="server" value="',h(SERVER),'">
<tr><th>Uživatel<td><input id="username" name="username" value="',h($_GET["username"]),'">
<tr><th>Heslo<td><input type="password" name="password">
</table>
<script type="text/javascript">
document.getElementById(\'username\').focus();
</script>
',"<p><input type='submit' value='".'Přihlásit se'."'>\n",checkbox("permanent",1,$_COOKIE["adminer_permanent"],'Trvalé přihlášení')."\n";}function
login($Hf,$S){return
true;}function
tableName($Nc){return
h($Nc["Name"]);}function
fieldName($d,$nb=0){return'<span title="'.h($d["full_type"]).'">'.h($d["field"]).'</span>';}function
selectLinks($Nc,$q=""){echo'<p class="tabs">';$Ka=array("select"=>'Vypsat data',"table"=>'Zobrazit strukturu');if(is_view($Nc)){$Ka["view"]='Pozměnit pohled';}else{$Ka["create"]='Pozměnit tabulku';}if(isset($q)){$Ka["edit"]='Nová položka';}foreach($Ka
as$e=>$b){echo" <a href='".h(ME)."$e=".urlencode($Nc["Name"]).($e=="edit"?$q:"")."'>".bold($b,isset($_GET[$e]))."</a>";}echo"\n";}function
foreignKeys($h){return
foreign_keys($h);}function
backwardKeys($h,$If){return
array();}function
backwardKeysPrint($Ef,$a){}function
selectQuery($j){global$y;return"<p><a href='".h(remove_from_uri("page"))."&amp;page=last' title='".'Poslední stránka'."'>&gt;&gt;</a> <code class='jush-$y'>".h(str_replace("\n"," ",$j))."</code> <a href='".h(ME)."sql=".urlencode($j)."'>".'Upravit'."</a>\n";}function
rowDescription($h){return"";}function
rowDescriptions($G,$lf){return$G;}function
selectVal($b,$x,$d){$c=($b!="<i>NULL</i>"&&ereg("char|binary",$d["type"])&&!ereg("var",$d["type"])?"<code>$b</code>":$b);if(ereg('blob|bytea|raw|file',$d["type"])&&!is_utf8($b)){$c=lang(array('%d bajt','%d bajty','%d bajtů'),strlen(html_entity_decode($b,ENT_QUOTES)));}return($x?"<a href='$x'>$c</a>":$c);}function
editVal($b,$d){return(ereg("binary",$d["type"])?reset(unpack("H*",$b)):$b);}function
selectColumnsPrint($N,$B){global$ca,$pb;print_fieldset("select",'Vypsat',$N);$k=0;$he=array('Funkce'=>$ca,'Agregace'=>$pb);foreach($N
as$e=>$b){$b=$_GET["columns"][$e];echo"<div>".html_select("columns[$k][fun]",array(-1=>"")+$he,$b["fun"]),"(<select name='columns[$k][col]'><option>".optionlist($B,$b["col"],true)."</select>)</div>\n";$k++;}echo"<div>".html_select("columns[$k][fun]",array(-1=>"")+$he,"","this.nextSibling.nextSibling.onchange();"),"(<select name='columns[$k][col]' onchange='selectAddRow(this);'><option>".optionlist($B,null,true)."</select>)</div>\n","</div></fieldset>\n";}function
selectSearchPrint($t,$B,$J){print_fieldset("search",'Vyhledat',$t);foreach($J
as$k=>$v){if($v["type"]=="FULLTEXT"){echo"(<i>".implode("</i>, <i>",array_map('h',$v["columns"]))."</i>) AGAINST"," <input name='fulltext[$k]' value='".h($_GET["fulltext"][$k])."'>",checkbox("boolean[$k]",1,isset($_GET["boolean"][$k]),"BOOL"),"<br>\n";}}$k=0;foreach((array)$_GET["where"]as$b){if("$b[col]$b[val]"!=""&&in_array($b["op"],$this->operators)){echo"<div><select name='where[$k][col]'><option value=''>(".'kdekoliv'.")".optionlist($B,$b["col"],true)."</select>",html_select("where[$k][op]",$this->operators,$b["op"]),"<input name='where[$k][val]' value='".h($b["val"])."'></div>\n";$k++;}}echo"<div><select name='where[$k][col]' onchange='selectAddRow(this);'><option value=''>(".'kdekoliv'.")".optionlist($B,null,true)."</select>",html_select("where[$k][op]",$this->operators),"<input name='where[$k][val]'></div>\n","</div></fieldset>\n";}function
selectOrderPrint($nb,$B,$J){print_fieldset("sort",'Seřadit',$nb);$k=0;foreach((array)$_GET["order"]as$e=>$b){if(isset($B[$b])){echo"<div><select name='order[$k]'><option>".optionlist($B,$b,true)."</select>",checkbox("desc[$k]",1,isset($_GET["desc"][$e]),'sestupně')."</div>\n";$k++;}}echo"<div><select name='order[$k]' onchange='selectAddRow(this);'><option>".optionlist($B,null,true)."</select>",checkbox("desc[$k]",1,0,'sestupně')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($M){echo"<fieldset><legend>".'Limit'."</legend><div>";echo"<input name='limit' size='3' value='".h($M)."'>","</div></fieldset>\n";}function
selectLengthPrint($zb){if(isset($zb)){echo"<fieldset><legend>".'Délka textů'."</legend><div>",'<input name="text_length" size="3" value="'.h($zb).'">',"</div></fieldset>\n";}}function
selectActionPrint(){echo"<fieldset><legend>".'Akce'."</legend><div>","<input type='submit' value='".'Vypsat'."'>","</div></fieldset>\n";}function
selectEmailPrint($Jf,$B){}function
selectColumnsProcess($B,$J){global$ca,$pb;$N=array();$ra=array();foreach((array)$_GET["columns"]as$e=>$b){if($b["fun"]=="count"||(isset($B[$b["col"]])&&(!$b["fun"]||in_array($b["fun"],$ca)||in_array($b["fun"],$pb)))){$N[$e]=apply_sql_function($b["fun"],(isset($B[$b["col"]])?idf_escape($b["col"]):"*"));if(!in_array($b["fun"],$pb)){$ra[]=$N[$e];}}}return
array($N,$ra);}function
selectSearchProcess($o,$J){global$y;$c=array();foreach($J
as$k=>$v){if($v["type"]=="FULLTEXT"&&$_GET["fulltext"][$k]!=""){$c[]="MATCH (".implode(", ",array_map('idf_escape',$v["columns"])).") AGAINST (".q($_GET["fulltext"][$k]).(isset($_GET["boolean"][$k])?" IN BOOLEAN MODE":"").")";}}foreach((array)$_GET["where"]as$b){if("$b[col]$b[val]"!=""&&in_array($b["op"],$this->operators)){$bc=" $b[op]";if(ereg('IN$',$b["op"])){$Ib=process_length($b["val"]);$bc.=" (".($Ib!=""?$Ib:"NULL").")";}elseif($b["op"]=="LIKE %%"){$bc=" LIKE ".$this->processInput($o[$b["col"]],"%$b[val]%");}elseif(!ereg('NULL$',$b["op"])){$bc.=" ".$this->processInput($o[$b["col"]],$b["val"]);}if($b["col"]!=""){$c[]=idf_escape($b["col"]).$bc;}else{$hb=array();foreach($o
as$f=>$d){if(is_numeric($b["val"])||!ereg('int|float|double|decimal',$d["type"])){$f=idf_escape($f);$hb[]=($y=="sql"&&ereg('char|text|enum|set',$d["type"])&&!ereg('^utf8',$d["collation"])?"CONVERT($f USING utf8)":$f);}}$c[]=($hb?"(".implode("$bc OR ",$hb)."$bc)":"0");}}}return$c;}function
selectOrderProcess($o,$J){$c=array();foreach((array)$_GET["order"]as$e=>$b){if(isset($o[$b])||preg_match('~^((COUNT\\(DISTINCT |[A-Z0-9_]+\\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\\)|COUNT\\(\\*\\))$~',$b)){$c[]=(isset($o[$b])?idf_escape($b):$b).(isset($_GET["desc"][$e])?" DESC":"");}}return$c;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"30");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($t,$lf){return
false;}function
messageQuery($j){global$y;restart_session();$U="sql-".count($_SESSION["messages"]);$ib=&get_session("queries");$ib[$_GET["db"]][]=(strlen($j)>1e6?ereg_replace('[\x80-\xFF]+$','',substr($j,0,1e6))."\n...":$j);return" <a href='#$U' onclick=\"return !toggle('$U');\">".'SQL příkaz'."</a><div id='$U' class='hidden'><pre class='jush-$y'>".shorten_utf8($j,1000).'</pre><p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($ib[$_GET["db"]])-1)).'">'.'Upravit'.'</a></div>';}function
editFunctions($d){global$Wb;$c=($d["null"]?"NULL/":"");foreach($Wb
as$e=>$ca){if(!$e||(!isset($_GET["call"])&&(isset($_GET["select"])||where($_GET)))){foreach($ca
as$ha=>$b){if(!$ha||ereg($ha,$d["type"])){$c.="/$b";}}}}return
explode("/",$c);}function
editInput($h,$d,$Sa,$r){if($d["type"]=="enum"){return(isset($_GET["select"])?"<label><input type='radio'$Sa value='-1' checked><i>".'původní'."</i></label> ":"").($d["null"]?"<label><input type='radio'$Sa value=''".(isset($r)||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"")."<label><input type='radio'$Sa value='0'".($r===0?" checked":"")."><i>".'prázdné'."</i></label>".enum_input("radio",$Sa,$d,$r);}return"";}function
processInput($d,$r,$O=""){$f=$d["field"];$c=q($r);if(ereg('^(now|getdate|uuid)$',$O)){$c="$O()";}elseif(ereg('^current_(date|timestamp)$',$O)){$c=$O;}elseif(ereg('^([+-]|\\|\\|)$',$O)){$c=idf_escape($f)." $O $c";}elseif(ereg('^[+-] interval$',$O)){$c=idf_escape($f)." $O ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+$~i",$r)?$r:$c);}elseif(ereg('^(addtime|subtime|concat)$',$O)){$c="$O(".idf_escape($f).", $c)";}elseif(ereg('^(md5|sha1|password|encrypt|hex)$',$O)){$c="$O($c)";}if(ereg("binary",$d["type"])){$c="unhex($c)";}return$c;}function
dumpOutput(){$c=array('text'=>'otevřít','file'=>'uložit');if(function_exists('gzencode')){$c['gz']='gzip';}if(function_exists('bzcompress')){$c['bz2']='bzip2';}return$c;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpTable($h,$V,$Wc=false){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($V){dump_csv(array_keys(fields($h)));}}elseif($V){$ga=create_sql($h,$_POST["auto_increment"]);if($ga){if($V=="DROP+CREATE"){echo"DROP ".($Wc?"VIEW":"TABLE")." IF EXISTS ".table($h).";\n";}if($Wc){$ga=preg_replace('~^([A-Z =]+) DEFINER=`'.str_replace("@","`@`",logged_user()).'`~','\\1',$ga);}echo($V!="CREATE+ALTER"?$ga:($Wc?substr_replace($ga," OR REPLACE",6,0):substr_replace($ga," IF NOT EXISTS",12,0))).";\n\n";}if($V=="CREATE+ALTER"&&!$Wc){$j="SELECT COLUMN_NAME, COLUMN_DEFAULT, IS_NULLABLE, COLLATION_NAME, COLUMN_TYPE, EXTRA, COLUMN_COMMENT FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ".q($h)." ORDER BY ORDINAL_POSITION";echo"DELIMITER ;;
CREATE PROCEDURE adminer_alter (INOUT alter_command text) BEGIN
	DECLARE _column_name, _collation_name, after varchar(64) DEFAULT '';
	DECLARE _column_type, _column_default text;
	DECLARE _is_nullable char(3);
	DECLARE _extra varchar(30);
	DECLARE _column_comment varchar(255);
	DECLARE done, set_after bool DEFAULT 0;
	DECLARE add_columns text DEFAULT '";$o=array();$Nb="";foreach(get_rows($j)as$a){$xa=$a["COLUMN_DEFAULT"];$a["default"]=(isset($xa)?q($xa):"NULL");$a["after"]=q($Nb);$a["alter"]=escape_string(idf_escape($a["COLUMN_NAME"])." $a[COLUMN_TYPE]".($a["COLLATION_NAME"]?" COLLATE $a[COLLATION_NAME]":"").(isset($xa)?" DEFAULT ".($xa=="CURRENT_TIMESTAMP"?$xa:$a["default"]):"").($a["IS_NULLABLE"]=="YES"?"":" NOT NULL").($a["EXTRA"]?" $a[EXTRA]":"").($a["COLUMN_COMMENT"]?" COMMENT ".q($a["COLUMN_COMMENT"]):"").($Nb?" AFTER ".idf_escape($Nb):" FIRST"));echo", ADD $a[alter]";$o[]=$a;$Nb=$a["COLUMN_NAME"];}echo"';
	DECLARE columns CURSOR FOR $j;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	SET @alter_table = '';
	OPEN columns;
	REPEAT
		FETCH columns INTO _column_name, _column_default, _is_nullable, _collation_name, _column_type, _extra, _column_comment;
		IF NOT done THEN
			SET set_after = 1;
			CASE _column_name";foreach($o
as$a){echo"
				WHEN ".q($a["COLUMN_NAME"])." THEN
					SET add_columns = REPLACE(add_columns, ', ADD $a[alter]', '');
					IF NOT (_column_default <=> $a[default]) OR _is_nullable != '$a[IS_NULLABLE]' OR _collation_name != '$a[COLLATION_NAME]' OR _column_type != ".q($a["COLUMN_TYPE"])." OR _extra != '$a[EXTRA]' OR _column_comment != ".q($a["COLUMN_COMMENT"])." OR after != $a[after] THEN
						SET @alter_table = CONCAT(@alter_table, ', MODIFY $a[alter]');
					END IF;";}echo"
				ELSE
					SET @alter_table = CONCAT(@alter_table, ', DROP ', _column_name);
					SET set_after = 0;
			END CASE;
			IF set_after THEN
				SET after = _column_name;
			END IF;
		END IF;
	UNTIL done END REPEAT;
	CLOSE columns;
	IF @alter_table != '' OR add_columns != '' THEN
		SET alter_command = CONCAT(alter_command, 'ALTER TABLE ".table($h)."', SUBSTR(CONCAT(add_columns, @alter_table), 2), ';\\n');
	END IF;
END;;
DELIMITER ;
CALL adminer_alter(@adminer_alter);
DROP PROCEDURE adminer_alter;

";}}}function
dumpData($h,$V,$j){global$g,$y;$le=($y=="sqlite"?0:1048576);if($V){if($_POST["format"]=="sql"&&$V=="TRUNCATE+INSERT"){echo
truncate_sql($h).";\n";}$o=fields($h);$i=$g->query($j,1);if($i){$jc="";$kb="";while($a=$i->fetch_assoc()){if($_POST["format"]!="sql"){dump_csv($a);}else{if(!$jc){$jc="INSERT INTO ".table($h)." (".implode(", ",array_map('idf_escape',array_keys($a))).") VALUES";}foreach($a
as$e=>$b){$a[$e]=(isset($b)?(ereg('int|float|double|decimal',$o[$e]["type"])?$b:q($b)):"NULL");}$ia=implode(",\t",$a);if($V=="INSERT+UPDATE"){$q=array();foreach($a
as$e=>$b){$q[]=idf_escape($e)." = $b";}echo"$jc ($ia) ON DUPLICATE KEY UPDATE ".implode(", ",$q).";\n";}else{$ia=($le?"\n":" ")."($ia)";if(!$kb){$kb=$jc.$ia;}elseif(strlen($kb)+2+strlen($ia)<$le){$kb.=",$ia";}else{$kb.=";\n";echo$kb;$kb=$jc.$ia;}}}}if($_POST["format"]=="sql"&&$V!="INSERT+UPDATE"&&$kb){$kb.=";\n";echo$kb;}}elseif($_POST["format"]=="sql"){echo"-- ".str_replace("\n"," ",$g->error)."\n";}}}function
dumpHeaders($ke,$qf=false){$X=($ke!=""?friendly_url($ke):"adminer");$fb=$_POST["output"];$Bb=($_POST["format"]=="sql"?"sql":($qf?"tar":"csv"));header("Content-Type: ".($fb=="bz2"?"application/x-bzip":($fb=="gz"?"application/x-gzip":($Bb=="tar"?"application/x-tar":($Bb=="sql"||$fb!="file"?"text/plain":"text/csv")."; charset=utf-8"))));if($fb!="text"){header("Content-Disposition: attachment; filename=$X.$Bb".($fb!="file"&&!ereg('[^0-9a-z]',$fb)?".$fb":""));}session_write_close();if($_POST["output"]=="bz2"){ob_start('bzcompress',1e6);}if($_POST["output"]=="gz"){ob_start('gzencode',1e6);}return$Bb;}function
navigation($Pb){global$Pc,$g,$K,$y,$ka;echo'<h1>
<a href="http://www.adminer.org/" id="h1">',$this->name(),'</a>
<span class="version">',$Pc,'</span>
<a href="http://www.adminer.org/#download" id="version">',(version_compare($Pc,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Pb=="auth"){$cb=true;foreach((array)$_SESSION["pwds"]as$Ob=>$tf){foreach($tf
as$E=>$sf){foreach($sf
as$P=>$S){if(isset($S)){if($cb){echo"<p>\n";$cb=false;}echo"<a href='".h(auth_url($Ob,$E,$P))."'>($ka[$Ob]) ".h($P.($E!=""?"@$E":""))."</a><br>\n";}}}}}else{$z=get_databases();echo'<form action="" method="post">
<p class="logout">
';if(DB==""||!$Pb){echo"<a href='".h(ME)."sql='>".bold('SQL příkaz',isset($_GET["sql"]))."</a>\n";if(support("dump")){echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."'>".bold('Export',isset($_GET["dump"]))."</a>\n";}}echo'<input type="hidden" name="token" value="',$K,'">
<input type="submit" name="logout" value="Odhlásit">
</p>
</form>
<form action="">
<p>
';hidden_fields_get();echo($z?html_select("db",array(""=>"(".'databáze'.")")+$z,DB,"this.form.submit();"):'<input name="db" value="'.h(DB).'">'),'<input type="submit" value="Vybrat"',($z?" class='hidden'":""),'>
';if($Pb!="db"&&DB!=""&&$g->select_db(DB)){if(support("scheme")){echo"<br>".html_select("ns",array(""=>"(".'schéma'.")")+schemas(),$_GET["ns"],"this.form.submit();");if($_GET["ns"]!=""){set_schema($_GET["ns"]);}}if($_GET["ns"]!==""&&!$Pb){echo'<p><a href="'.h(ME).'create=">'.bold('Vytvořit novou tabulku',$_GET["create"]==="")."</a>\n";$F=tables_list();if(!$F){echo"<p class='message'>".'Žádné tabulky.'."\n";}else{$this->tablesPrint($F);$Ka=array();foreach($F
as$h=>$_){$Ka[]=preg_quote($h,'/');}echo"<script type='text/javascript'>\n","var jushLinks = { $y: [ '".js_escape(ME)."table=\$&', /\\b(".implode("|",$Ka).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$b){echo"jushLinks.$b = jushLinks.$y;\n";}echo"</script>\n";}}}echo(isset($_GET["sql"])?'<input type="hidden" name="sql" value="">':(isset($_GET["schema"])?'<input type="hidden" name="schema" value="">':(isset($_GET["dump"])?'<input type="hidden" name="dump" value="">':""))),"</p></form>\n";}}function
tablesPrint($F){echo"<p id='tables'>\n";foreach($F
as$h=>$_){echo'<a href="'.h(ME).'select='.urlencode($h).'">'.bold('vypsat',$_GET["select"]==$h).'</a> ','<a href="'.h(ME).'table='.urlencode($h).'">'.bold($this->tableName(array("Name"=>$h)),$_GET["table"]==$h)."</a><br>\n";}}}$p=(function_exists('adminer_object')?adminer_object():new
Adminer);if(!isset($p->operators)){$p->operators=$Zb;}function
page_header($me,$n="",$kc=array(),$ne=""){global$Kf,$Vb,$p,$g,$ka;header("Content-Type: text/html; charset=utf-8");$p->headers();$pe=$me.($ne!=""?": ".h($ne):"");$ic=($Vb?"https":"http");echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="cs" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="robots" content="noindex">
<title>',$pe.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$p->name(),'</title>
<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=favicon.ico&amp;version=3.1.0",'">
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=default.css&amp;version=3.1.0";echo'">
';if(file_exists("adminer.css")){echo'<link rel="stylesheet" type="text/css" href="adminer.css">
';}echo'
<body class="ltr" onload="bodyLoad(\'',(is_object($g)?substr($g->server_info,0,3):""),'\', \'',$ic,'\');',(isset($_COOKIE["adminer_version"])?"":" verifyVersion('$ic');"),'">
<script type="text/javascript" src="',h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=functions.js&amp;version=3.1.0",'"></script>

<div id="content">
';if(isset($kc)){$x=substr(preg_replace('~(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.($x?h($x):".").'">'.$ka[DRIVER].'</a> &raquo; ';$x=substr(preg_replace('~(db|ns)=[^&]*&~','',ME),0,-1);$E=(SERVER!=""?h(SERVER):'Server');if($kc===false){echo"$E\n";}else{echo"<a href='".($x?h($x):".")."'>$E</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($kc))){echo'<a href="'.h($x."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';}if(is_array($kc)){if($_GET["ns"]!=""){echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';}foreach($kc
as$e=>$b){$hc=(is_array($b)?$b[1]:$b);if($hc!=""){echo'<a href="'.h(ME."$e=").urlencode(is_array($b)?$b[0]:$b).'">'.h($hc).'</a> &raquo; ';}}}echo"$me\n";}}echo"<h2>$pe</h2>\n";restart_session();if($_SESSION["messages"]){echo"<div class='message'>".implode("</div>\n<div class='message'>",$_SESSION["messages"])."</div>\n";$_SESSION["messages"]=array();}$z=&get_session("dbs");if(DB!=""&&$z&&!in_array(DB,$z,true)){$z=null;}if($n){echo"<div class='error'>$n</div>\n";}}function
page_footer($Pb=""){global$p;echo'</div>

<div id="menu">
';$p->navigation($Pb);echo'</div>
';}function
int32($da){while($da>=2147483648){$da-=4294967296;}while($da<=-2147483649){$da+=4294967296;}return(int)$da;}function
long2str($w,$yd){$ia='';foreach($w
as$b){$ia.=pack('V',$b);}if($yd){return
substr($ia,0,end($w));}return$ia;}function
str2long($ia,$yd){$w=array_values(unpack('V*',str_pad($ia,4*ceil(strlen($ia)/4),"\0")));if($yd){$w[]=strlen($ia);}return$w;}function
xxtea_mx($_a,$ua,$Da,$Ja){return
int32((($_a>>5&0x7FFFFFF)^$ua<<2)+(($ua>>3&0x1FFFFFFF)^$_a<<4))^int32(($Da^$ua)+($Ja^$_a));}function
encrypt_string($gc,$e){if($gc==""){return"";}$e=array_values(unpack("V*",pack("H*",md5($e))));$w=str2long($gc,true);$da=count($w)-1;$_a=$w[$da];$ua=$w[0];$ma=floor(6+52/($da+1));$Da=0;while($ma-->0){$Da=int32($Da+0x9E3779B9);$ec=$Da>>2&3;for($wa=0;$wa<$da;$wa++){$ua=$w[$wa+1];$Jb=xxtea_mx($_a,$ua,$Da,$e[$wa&3^$ec]);$_a=int32($w[$wa]+$Jb);$w[$wa]=$_a;}$ua=$w[0];$Jb=xxtea_mx($_a,$ua,$Da,$e[$wa&3^$ec]);$_a=int32($w[$da]+$Jb);$w[$da]=$_a;}return
long2str($w,false);}function
decrypt_string($gc,$e){if($gc==""){return"";}$e=array_values(unpack("V*",pack("H*",md5($e))));$w=str2long($gc,false);$da=count($w)-1;$_a=$w[$da];$ua=$w[0];$ma=floor(6+52/($da+1));$Da=int32($ma*0x9E3779B9);while($Da){$ec=$Da>>2&3;for($wa=$da;$wa>0;$wa--){$_a=$w[$wa-1];$Jb=xxtea_mx($_a,$ua,$Da,$e[$wa&3^$ec]);$ua=int32($w[$wa]-$Jb);$w[$wa]=$ua;}$_a=$w[$da];$Jb=xxtea_mx($_a,$ua,$Da,$e[$wa&3^$ec]);$ua=int32($w[0]-$Jb);$w[0]=$ua;$Da=int32($Da-0x9E3779B9);}return
long2str($w,true);}$g='';$K=$_SESSION["token"];if(!$_SESSION["token"]){$_SESSION["token"]=rand(1,1e6);}$_b=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$b){list($e)=explode(":",$b);$_b[$e]=$b;}}if(isset($_POST["server"])){session_regenerate_id();$_SESSION["pwds"][$_POST["driver"]][$_POST["server"]][$_POST["username"]]=$_POST["password"];if($_POST["permanent"]){$e=base64_encode($_POST["driver"])."-".base64_encode($_POST["server"])."-".base64_encode($_POST["username"]);$Hc=$p->permanentLogin();$_b[$e]="$e:".base64_encode($Hc?encrypt_string($_POST["password"],$Hc):"");cookie("adminer_permanent",implode(" ",$_b));}if(count($_POST)==($_POST["permanent"]?5:4)||DRIVER!=$_POST["driver"]||SERVER!=$_POST["server"]||$_GET["username"]!==$_POST["username"]){redirect(auth_url($_POST["driver"],$_POST["server"],$_POST["username"]));}}elseif($_POST["logout"]){if($K&&$_POST["token"]!=$K){page_header('Odhlásit','Neplatný token CSRF. Odešlete formulář znovu.');page_footer("db");exit;}else{foreach(array("pwds","dbs","queries")as$e){set_session($e,null);}$e=base64_encode(DRIVER)."-".base64_encode(SERVER)."-".base64_encode($_GET["username"]);if($_b[$e]){unset($_b[$e]);cookie("adminer_permanent",implode(" ",$_b));}redirect(substr(preg_replace('~(username|db|ns)=[^&]*&~','',ME),0,-1),'Odhlášení proběhlo v pořádku.');}}elseif($_b&&!$_SESSION["pwds"]){session_regenerate_id();$Hc=$p->permanentLogin();foreach($_b
as$e=>$b){list(,$Df)=explode(":",$b);list($Ob,$E,$P)=array_map('base64_decode',explode("-",$e));$_SESSION["pwds"][$Ob][$E][$P]=decrypt_string(base64_decode($Df),$Hc);}}function
auth_error($Ae=null){global$g,$p,$K;$Ic=session_name();$n="";if(!$_COOKIE[$Ic]&&$_GET[$Ic]&&ini_bool("session.use_only_cookies")){$n='Session proměnné musí být povolené.';}elseif(isset($_GET["username"])){if(($_COOKIE[$Ic]||$_GET[$Ic])&&!$K){$n='Session vypršela, přihlašte se prosím znovu.';}else{$S=&get_session("pwds");if(isset($S)){$n=h($Ae?$Ae->getMessage():(is_string($g)?$g:'Neplatné přihlašovací údaje.'));$S=null;}}}page_header('Přihlásit se',$n,null);echo"<form action='' method='post'>\n";$p->loginForm();echo"<div>";hidden_fields($_POST,array("driver","server","username","password","permanent"));echo"</div>\n","</form>\n";page_footer("auth");}if(isset($_GET["username"])){if(!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);page_header('Žádná extenze',sprintf('Není dostupná žádná z podporovaných PHP extenzí (%s).',implode(", ",$mc)),false);page_footer("auth");exit;}$g=connect();}if(is_string($g)||!$p->login($_GET["username"],get_session("pwds"))){auth_error();exit;}$K=$_SESSION["token"];if(isset($_POST["server"])&&$_POST["token"]){$_POST["token"]=$K;}$n=($_POST?($_POST["token"]==$K?"":'Neplatný token CSRF. Odešlete formulář znovu.'):($_SERVER["REQUEST_METHOD"]!="POST"?"":sprintf('Příliš velká POST data. Zmenšete data nebo zvyšte hodnotu konfigurační direktivy %s.','"post_max_size"')));function
connect_error(){global$g,$K,$n,$ka;$z=array();if(DB!=""){page_header('Databáze'.": ".h(DB),'Nesprávná databáze.',true);}else{if($_POST["db"]&&!$n){queries_redirect(substr(ME,0,-1),'Databáze byly odstraněny.',drop_databases($_POST["db"]));}page_header('Vybrat databázi',$n,false);echo"<p><a href='".h(ME)."database='>".'Vytvořit novou databázi'."</a>\n";foreach(array('privileges'=>'Oprávnění','processlist'=>'Seznam procesů','variables'=>'Proměnné','status'=>'Stav',)as$e=>$b){if(support($e)){echo"<a href='".h(ME)."$e='>$b</a>\n";}}echo"<p>".sprintf('Verze %s: %s přes PHP extenzi %s',$ka[DRIVER],"<b>$g->server_info</b>","<b>$g->extension</b>")."\n","<p>".sprintf('Přihlášen jako: %s',"<b>".h(logged_user())."</b>")."\n";if($_GET["refresh"]){set_session("dbs",null);}$z=get_databases();if($z){$_d=support("scheme");$W=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' onclick='tableClick(event);'>\n","<thead><tr><td><input type='hidden' name='token' value='$K'>&nbsp;<th>".'Databáze'."<td>".'Porovnávání'."<td>".'Tabulky'."</thead>\n";foreach($z
as$s){$Bd=h(ME)."db=".urlencode($s);echo"<tr".odd()."><td>".checkbox("db[]",$s,in_array($s,(array)$_POST["db"])),"<th><a href='$Bd'>".h($s)."</a>","<td><a href='$Bd".($_d?"&amp;ns=":"")."&amp;database='>".nbsp(db_collation($s,$W))."</a>","<td align='right'><a href='$Bd&amp;schema=' id='tables-".h($s)."'>?</a>","\n";}echo"</table>\n","<p><input type='submit' name='drop' value='".'Odstranit'."'".confirm("formChecked(this, /db/)").">\n","<a href='".h(ME)."refresh=1'>".'Obnovit'."</a>\n","</form>\n";}}page_footer("db");if($z){echo"<script type='text/javascript' src='".h(ME."script=connect&token=$K")."'></script>\n";}}if(isset($_GET["status"])){$_GET["variables"]=$_GET["status"];}if(!(DB!=""?$g->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect")){if(DB!=""){set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"])){redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());}if(!set_schema($_GET["ns"])){page_header('Schéma'.": ".h($_GET["ns"]),'Nesprávné schéma.',true);page_footer("ns");exit;}}function
select($i,$H=null){$Ka=array();$J=array();$B=array();$Ee=array();$T=array();odd('');for($k=0;$a=$i->fetch_row();$k++){if(!$k){echo"<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($oa=0;$oa<count($a);$oa++){$d=$i->fetch_field();$Ca=$d->orgtable;$wc=$d->orgname;if($Ca!=""){if(!isset($J[$Ca])){$J[$Ca]=array();foreach(indexes($Ca,$H)as$v){if($v["type"]=="PRIMARY"){$J[$Ca]=array_flip($v["columns"]);break;}}$B[$Ca]=$J[$Ca];}if(isset($B[$Ca][$wc])){unset($B[$Ca][$wc]);$J[$Ca][$wc]=$oa;$Ka[$oa]=$Ca;}}if($d->charsetnr==63){$Ee[$oa]=true;}$T[$oa]=$d->type;echo"<th".($Ca!=""||$d->name!=$wc?" title='".h(($Ca!=""?"$Ca.":"").$wc)."'":"").">".h($d->name);}echo"</thead>\n";}echo"<tr".odd().">";foreach($a
as$e=>$b){if(!isset($b)){$b="<i>NULL</i>";}else{if($Ee[$e]&&!is_utf8($b)){$b="<i>".lang(array('%d bajt','%d bajty','%d bajtů'),strlen($b))."</i>";}elseif(!strlen($b)){$b="&nbsp;";}else{$b=h($b);if($T[$e]==254){$b="<code>$b</code>";}}if(isset($Ka[$e])&&!$B[$Ka[$e]]){$x="edit=".urlencode($Ka[$e]);foreach($J[$Ka[$e]]as$_c=>$oa){$x.="&where".urlencode("[".bracket_escape($_c)."]")."=".urlencode($a[$oa]);}$b="<a href='".h(ME.$x)."'>$b</a>";}}echo"<td>$b";}}echo($k?"</table>":"<p class='message'>".'Žádné řádky.')."\n";}function
referencable_primary($rf){$c=array();foreach(table_status()as$Ba=>$h){if($Ba!=$rf&&fk_support($h)){foreach(fields($Ba)as$d){if($d["primary"]){if($c[$Ba]){unset($c[$Ba]);break;}$c[$Ba]=$d;}}}}return$c;}function
textarea($f,$r,$G=10,$hb=80){echo"<textarea name='$f' rows='$G' cols='$hb' style='width: 98%;' spellcheck='false' onkeydown='return textareaKeydown(this, event, true);'>".h($r)."</textarea>";}function
edit_type($e,$d,$W,$ba=array()){global$Oa,$T,$sb,$bb;echo'<td><select name="',$e,'[type]" class="type" onfocus="lastType = selectValue(this);" onchange="editingTypeChange(this);">',optionlist((!$d["type"]||isset($T[$d["type"]])?array():array($d["type"]))+$Oa+($ba?array('Cizí klíče'=>$ba):array()),$d["type"]),'</select>
<td><input name="',$e,'[length]" value="',h($d["length"]),'" size="3" onfocus="editingLengthFocus(this);"><td>',"<select name='$e"."[collation]'".(ereg('(char|text|enum|set)$',$d["type"])?"":" class='hidden'").'><option value="">('.'porovnávání'.')'.optionlist($W,$d["collation"]).'</select>',($sb?"<select name='$e"."[unsigned]'".(!$d["type"]||ereg('(int|float|double|decimal)$',$d["type"])?"":" class='hidden'").'><option>'.optionlist($sb,$d["unsigned"]).'</select>':''),($ba?"<select name='$e"."[on_delete]'".(ereg("`",$d["type"])?"":" class='hidden'")."><option value=''>(".'Při smazání'.")".optionlist($bb,$d["on_delete"])."</select> ":" ");}function
process_length($aa){global$Mb;return(preg_match("~^\\s*(?:$Mb)(?:\\s*,\\s*(?:$Mb))*\\s*\$~",$aa)&&preg_match_all("~$Mb~",$aa,$ta)?implode(",",$ta[0]):preg_replace('~[^0-9,+-]~','',$aa));}function
process_type($d,$dc="COLLATE"){global$sb;return" $d[type]".($d["length"]!=""?"(".process_length($d["length"]).")":"").(ereg('int|float|double|decimal',$d["type"])&&in_array($d["unsigned"],$sb)?" $d[unsigned]":"").(ereg('char|text|enum|set',$d["type"])&&$d["collation"]?" $dc ".q($d["collation"]):"");}function
process_field($d,$Fc){return
array(idf_escape($d["field"]),process_type($Fc),($d["null"]?" NULL":" NOT NULL"),(isset($d["default"])?" DEFAULT ".($d["type"]=="timestamp"&&eregi("^CURRENT_TIMESTAMP$",$d["default"])?$d["default"]:q($d["default"])):""),($d["on_update"]?" ON UPDATE $d[on_update]":""),(support("comment")&&$d["comment"]!=""?" COMMENT ".q($d["comment"]):""),($d["auto_increment"]?auto_increment():null),);}function
type_class($_){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$e=>$b){if(ereg("$e|$b",$_)){return" class='$e'";}}}function
edit_fields($o,$W,$_="TABLE",$Ne=0,$ba=array(),$Kb=false){global$nc;foreach($o
as$d){if($d["comment"]!=""){$Kb=true;break;}}echo'<thead><tr class="wrap">
';if($_=="PROCEDURE"){echo'<td>&nbsp;';}echo'<th>',($_=="TABLE"?'Název sloupce':'Název parametru'),'<td>Typ<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;" onblur="editingLengthBlur(this);"></textarea>
<td>Délka
<td>Volby
';if($_=="TABLE"){echo'<td>NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym title="Auto Increment">AI</acronym>
<td class="hidden">Výchozí hodnoty
',(support("comment")?"<td".($Kb?"":" class='hidden'").">".'Komentář':"");}echo'<td>',"<input type='image' name='add[".(support("move_col")?0:count($o))."]' src='".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=plus.gif&amp;version=3.1.0' alt='+' title='".'Přidat další'."'>",'<script type="text/javascript">row_count = ',count($o),';</script>
</thead>
';foreach($o
as$k=>$d){$k++;$hd=$d[($_POST?"orig":"field")];$Me=(isset($_POST["add"][$k-1])||(isset($d["field"])&&!$_POST["drop_col"][$k]))&&(support("drop_col")||$hd=="");echo'<tr',($Me?"":" style='display: none;'"),'>
',($_=="PROCEDURE"?"<td>".html_select("fields[$k][inout]",$nc,$d["inout"]):""),'<th>';if($Me){echo'<input name="fields[',$k,'][field]" value="',h($d["field"]),'" onchange="',($d["field"]!=""||count($o)>1?"":"editingAddRow(this, $Ne); "),'editingNameChange(this);" maxlength="64">';}echo'<input type="hidden" name="fields[',$k,'][orig]" value="',h($hd),'">
';edit_type("fields[$k]",$d,$W,$ba);if($_=="TABLE"){echo'<td>',checkbox("fields[$k][null]",1,$d["null"]),'<td><input type="radio" name="auto_increment_col" value="',$k,'"';if($d["auto_increment"]){echo' checked';}?> onclick="var field = this.form['fields[' + this.value + '][field]']; if (!field.value) { field.value = 'id'; field.onchange(); }">
<td class="hidden"><?php echo
checkbox("fields[$k][has_default]",1,$d["has_default"]),'<input name="fields[',$k,'][default]" value="',h($d["default"]),'" onchange="this.previousSibling.checked = true;">
',(support("comment")?"<td".($Kb?"":" class='hidden'")."><input name='fields[$k][comment]' value='".h($d["comment"])."' maxlength='255'>":"");}echo"<td>",(support("move_col")?"<input type='image' name='add[$k]' src='".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=plus.gif&amp;version=3.1.0' alt='+' title='".'Přidat další'."' onclick='return !editingAddRow(this, $Ne, 1);'>&nbsp;"."<input type='image' name='up[$k]' src='".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=up.gif&amp;version=3.1.0' alt='^' title='".'Přesunout nahoru'."'>&nbsp;"."<input type='image' name='down[$k]' src='".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=down.gif&amp;version=3.1.0' alt='v' title='".'Přesunout dolů'."'>&nbsp;":""),($hd==""||support("drop_col")?"<input type='image' name='drop_col[$k]' src='".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=cross.gif&amp;version=3.1.0' alt='x' title='".'Odebrat'."' onclick='return !editingRemoveRow(this);'>":""),"\n";}return$Kb;}function
process_fields(&$o){ksort($o);$L=0;if($_POST["up"]){$wb=0;foreach($o
as$e=>$d){if(key($_POST["up"])==$e){unset($o[$e]);array_splice($o,$wb,0,array($d));break;}if(isset($d["field"])){$wb=$L;}$L++;}}if($_POST["down"]){$pa=false;foreach($o
as$e=>$d){if(isset($d["field"])&&$pa){unset($o[key($_POST["down"])]);array_splice($o,$L,0,array($pa));break;}if(key($_POST["down"])==$e){$pa=$d;}$L++;}}$o=array_values($o);if($_POST["add"]){array_splice($o,key($_POST["add"]),0,array(array()));}}function
normalize_enum($l){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($l[0][0].$l[0][0],$l[0][0],substr($l[0],1,-1))),'\\'))."'";}function
grant($fa,$la,$B,$Ab){if(!$la){return
true;}if($la==array("ALL PRIVILEGES","GRANT OPTION")){return($fa=="GRANT"?queries("$fa ALL PRIVILEGES$Ab WITH GRANT OPTION"):queries("$fa ALL PRIVILEGES$Ab")&&queries("$fa GRANT OPTION$Ab"));}return
queries("$fa ".preg_replace('~(GRANT OPTION)\\([^)]*\\)~','\\1',implode("$B, ",$la).$B).$Ab);}function
drop_create($Fa,$ga,$ja,$Pe,$pf,$nf,$f){if($_POST["drop"]){return
query_redirect($Fa,$ja,$Pe,true,!$_POST["dropped"]);}$Ua=$f!=""&&($_POST["dropped"]||queries($Fa));$of=queries($ga);if(!queries_redirect($ja,($f!=""?$pf:$nf),$of)&&$Ua){restart_session();$_SESSION["messages"][]=$Pe;}return$Ua;}function
tar_file($X,$kd){$c=pack("a100a8a8a8a12a12",$X,644,0,0,decoct(strlen($kd)),decoct(time()));$Le=8*32;for($k=0;$k<strlen($c);$k++){$Le+=ord($c{$k});}$c.=sprintf("%06o",$Le)."\0 ";return$c.str_repeat("\0",512-strlen($c)).$kd.str_repeat("\0",511-(strlen($kd)+511)%
512);}session_cache_limiter("");if(!ini_bool("session.use_cookies")||@ini_set("session.use_cookies",false)!==false){session_write_close();}$bb=array("RESTRICT","CASCADE","SET NULL","NO ACTION");$Mb="'(?:''|[^'\\\\]|\\\\.)*+'";$nc=array("IN","OUT","INOUT");if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"]){$_GET["edit"]=$_GET["select"];}if(isset($_GET["callf"])){$_GET["call"]=$_GET["callf"];}if(isset($_GET["function"])){$_GET["procedure"]=$_GET["function"];}if(isset($_GET["download"])){$m=$_GET["download"];header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$m-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));echo$g->result("SELECT".limit(idf_escape($_GET["field"])." FROM ".table($m)," WHERE ".where($_GET),1));exit;}elseif(isset($_GET["table"])){$m=$_GET["table"];$o=fields($m);if(!$o){$n=error();}$I=($o?table_status($m):array());page_header(($o&&is_view($I)?'Pohled':'Tabulka').": ".h($m),$n);$p->selectLinks($I);$ya=$I["Comment"];if($ya!=""){echo"<p>".'Komentář'.": ".h($ya)."\n";}if($o){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Sloupec'."<td>".'Typ'.(support("comment")?"<td>".'Komentář':"")."</thead>\n";foreach($o
as$d){echo"<tr".odd()."><th>".h($d["field"]),"<td>".h($d["full_type"]).($d["null"]?" <i>NULL</i>":"").($d["auto_increment"]?" <i>".'Auto Increment'."</i>":""),(support("comment")?"<td>".nbsp($d["comment"]):""),"\n";}echo"</table>\n";if(!is_view($I)){echo"<h3>".'Indexy'."</h3>\n";$J=indexes($m);if($J){echo"<table cellspacing='0'>\n";foreach($J
as$f=>$v){ksort($v["columns"]);$db=array();foreach($v["columns"]as$e=>$b){$db[]="<i>".h($b)."</i>".($v["lengths"][$e]?"(".$v["lengths"][$e].")":"");}echo"<tr title='".h($f)."'><th>$v[type]<td>".implode(", ",$db)."\n";}echo"</table>\n";}echo'<p><a href="'.h(ME).'indexes='.urlencode($m).'">'.'Pozměnit indexy'."</a>\n";if(fk_support($I)){echo"<h3>".'Cizí klíče'."</h3>\n";$ba=foreign_keys($m);if($ba){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Zdroj'."<td>".'Cíl'."<td>".'Při smazání'."<td>".'Při změně'.($y!="sqlite"?"<td>&nbsp;":"")."</thead>\n";foreach($ba
as$f=>$A){$x=($A["db"]!=""?"<b>".h($A["db"])."</b>.":"").h($A["table"]);echo"<tr>","<th><i>".implode("</i>, <i>",array_map('h',$A["source"]))."</i>","<td><a href='".h($A["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($A["db"]),ME):ME)."table=".urlencode($A["table"])."'>$x</a>","(<i>".implode("</i>, <i>",array_map('h',$A["target"]))."</i>)","<td>$A[on_delete]\n","<td>$A[on_update]\n";if($y!="sqlite"){echo'<td><a href="'.h(ME.'foreign='.urlencode($m).'&name='.urlencode($f)).'">'.'Změnit'.'</a>';}}echo"</table>\n";}if($y!="sqlite"){echo'<p><a href="'.h(ME).'foreign='.urlencode($m).'">'.'Přidat cizí klíč'."</a>\n";}}if(support("trigger")){echo"<h3>".'Triggery'."</h3>\n";$lc=triggers($m);if($lc){echo"<table cellspacing='0'>\n";foreach($lc
as$e=>$b){echo"<tr valign='top'><td>$b[0]<td>$b[1]<th>".h($e)."<td><a href='".h(ME.'trigger='.urlencode($m).'&name='.urlencode($e))."'>".'Změnit'."</a>\n";}echo"</table>\n";}echo'<p><a href="'.h(ME).'trigger='.urlencode($m).'">'.'Přidat trigger'."</a>\n";}}}}elseif(isset($_GET["schema"])){page_header('Schéma databáze',"",array(),DB);$qb=array();$Ke=array();preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$_COOKIE["adminer_schema"],$ta,PREG_SET_ORDER);foreach($ta
as$k=>$l){$qb[$l[1]]=array($l[2],$l[3]);$Ke[]="\n\t'".js_escape($l[1])."': [ $l[2], $l[3] ]";}$Tb=0;$De=-1;$La=array();$Ce=array();$Je=array();foreach(table_status()as$a){if(!isset($a["Engine"])){continue;}$oc=0;$La[$a["Name"]]["fields"]=array();foreach(fields($a["Name"])as$f=>$d){$oc+=1.25;$d["pos"]=$oc;$La[$a["Name"]]["fields"][$f]=$d;}$La[$a["Name"]]["pos"]=($qb[$a["Name"]]?$qb[$a["Name"]]:array($Tb,0));foreach($p->foreignKeys($a["Name"])as$b){if(!$b["db"]){$za=$De;if($qb[$a["Name"]][1]||$qb[$b["table"]][1]){$za=min(floatval($qb[$a["Name"]][1]),floatval($qb[$b["table"]][1]))-1;}else{$De-=.1;}while($Je[(string)$za]){$za-=.0001;}$La[$a["Name"]]["references"][$b["table"]][(string)$za]=array($b["source"],$b["target"]);$Ce[$b["table"]][$a["Name"]][(string)$za]=$b["target"];$Je[(string)$za]=true;}}$Tb=max($Tb,$La[$a["Name"]]["pos"][0]+2.5+$oc);}echo'<div id="schema" style="height: ',$Tb,'em;">
<script type="text/javascript">
tablePos = {',implode(",",$Ke)."\n",'};
em = document.getElementById(\'schema\').offsetHeight / ',$Tb,';
document.onmousemove = schemaMousemove;
document.onmouseup = schemaMouseup;
</script>
';foreach($La
as$f=>$h){echo"<div class='table' style='top: ".$h["pos"][0]."em; left: ".$h["pos"][1]."em;' onmousedown='schemaMousedown(this, event);'>",'<a href="'.h(ME).'table='.urlencode($f).'"><b>'.h($f)."</b></a><br>\n";foreach($h["fields"]as$d){$b='<span'.type_class($d["type"]).' title="'.h($d["full_type"].($d["null"]?" NULL":'')).'">'.h($d["field"]).'</span>';echo($d["primary"]?"<i>$b</i>":$b)."<br>\n";}foreach((array)$h["references"]as$Ub=>$cc){foreach($cc
as$za=>$Kc){$tc=$za-$qb[$f][1];$k=0;foreach($Kc[0]as$Ga){echo"<div class='references' title='".h($Ub)."' id='refs$za-".($k++)."' style='left: $tc"."em; top: ".$h["fields"][$Ga]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$tc)."em;'></div></div>\n";}}}foreach((array)$Ce[$f]as$Ub=>$cc){foreach($cc
as$za=>$B){$tc=$za-$qb[$f][1];$k=0;foreach($B
as$qa){echo"<div class='references' title='".h($Ub)."' id='refd$za-".($k++)."' style='left: $tc"."em; top: ".$h["fields"][$qa]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=arrow.gif) no-repeat right center;&amp;version=3.1.0'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$tc)."em;'></div></div>\n";}}}echo"</div>\n";}foreach($La
as$f=>$h){foreach((array)$h["references"]as$Ub=>$cc){foreach($cc
as$za=>$Kc){$Xc=$Tb;$cd=-10;foreach($Kc[0]as$e=>$Ga){$Ie=$h["pos"][0]+$h["fields"][$Ga]["pos"];$He=$La[$Ub]["pos"][0]+$La[$Ub]["fields"][$Kc[1][$e]]["pos"];$Xc=min($Xc,$Ie,$He);$cd=max($cd,$Ie,$He);}echo"<div class='references' id='refl$za' style='left: $za"."em; top: $Xc"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($cd-$Xc)."em;'></div></div>\n";}}}echo'</div>
';}elseif(isset($_GET["dump"])){$m=$_GET["dump"];if($_POST){$Te="";foreach(array("output","format","db_style","table_style","data_style")as$e){$Te.="&$e=".urlencode($_POST[$e]);}cookie("adminer_export",substr($Te,1));$Bb=$p->dumpHeaders(($m!=""?$m:DB),(DB==""||count((array)$_POST["tables"]+(array)$_POST["data"])>1));$rb=($_POST["format"]=="sql");if($rb){echo"-- Adminer $Pc ".$ka[DRIVER]." dump

".($y!="sql"?"":"SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = ".q($g->result("SELECT @@time_zone")).";
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

");}$V=$_POST["db_style"];$z=array(DB);if(DB==""){$z=$_POST["databases"];if(is_string($z)){$z=explode("\n",rtrim(str_replace("\r","",$z),"\n"));}}foreach((array)$z
as$s){if($g->select_db($s)){if($rb&&ereg('CREATE',$V)&&($ga=$g->result("SHOW CREATE DATABASE ".idf_escape($s),1))){if($V=="DROP+CREATE"){echo"DROP DATABASE IF EXISTS ".idf_escape($s).";\n";}echo($V=="CREATE+ALTER"?preg_replace('~^CREATE DATABASE ~','\\0IF NOT EXISTS ',$ga):$ga).";\n";}if($rb){if($V){echo
use_sql($s).";\n\n";}if(in_array("CREATE+ALTER",array($V,$_POST["table_style"]))){echo"SET @adminer_alter = '';\n\n";}$lb="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$Ma){foreach(get_rows("SHOW $Ma STATUS WHERE Db = ".q($s),null,"-- ")as$a){$lb.=($V!='DROP+CREATE'?"DROP $Ma IF EXISTS ".idf_escape($a["Name"]).";;\n":"").$g->result("SHOW CREATE $Ma ".idf_escape($a["Name"]),2).";;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$a){$lb.=($V!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($a["Name"]).";;\n":"").$g->result("SHOW CREATE EVENT ".idf_escape($a["Name"]),3).";;\n\n";}}if($lb){echo"DELIMITER ;;\n\n$lb"."DELIMITER ;\n\n";}}if($_POST["table_style"]||$_POST["data_style"]){$Z=array();foreach(table_status()as$a){$h=(DB==""||in_array($a["Name"],(array)$_POST["tables"]));$Ge=(DB==""||in_array($a["Name"],(array)$_POST["data"]));if($h||$Ge){if(!is_view($a)){if($Bb=="tar"){ob_start();}$p->dumpTable($a["Name"],($h?$_POST["table_style"]:""));if($Ge){$p->dumpData($a["Name"],$_POST["data_style"],"SELECT * FROM ".table($a["Name"]));}if($rb&&$_POST["triggers"]){$lc=trigger_sql($a["Name"],$_POST["table_style"]);if($lc){echo"\nDELIMITER ;;\n$lc\nDELIMITER ;\n";}}if($Bb=="tar"){echo
tar_file((DB!=""?"":"$s/")."$a[Name].csv",ob_get_clean());}elseif($rb){echo"\n";}}elseif($rb){$Z[]=$a["Name"];}}}foreach($Z
as$Cc){$p->dumpTable($Cc,$_POST["table_style"],true);}if($Bb=="tar"){echo
pack("x512");}}if($V=="CREATE+ALTER"&&$rb){$j="SELECT TABLE_NAME, ENGINE, TABLE_COLLATION, TABLE_COMMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE()";echo"DELIMITER ;;
CREATE PROCEDURE adminer_alter (INOUT alter_command text) BEGIN
	DECLARE _table_name, _engine, _table_collation varchar(64);
	DECLARE _table_comment varchar(64);
	DECLARE done bool DEFAULT 0;
	DECLARE tables CURSOR FOR $j;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	OPEN tables;
	REPEAT
		FETCH tables INTO _table_name, _engine, _table_collation, _table_comment;
		IF NOT done THEN
			CASE _table_name";foreach(get_rows($j)as$a){$ya=q($a["ENGINE"]=="InnoDB"?preg_replace('~(?:(.+); )?InnoDB free: .*~','\\1',$a["TABLE_COMMENT"]):$a["TABLE_COMMENT"]);echo"
				WHEN ".q($a["TABLE_NAME"])." THEN
					".(isset($a["ENGINE"])?"IF _engine != '$a[ENGINE]' OR _table_collation != '$a[TABLE_COLLATION]' OR _table_comment != $ya THEN
						ALTER TABLE ".idf_escape($a["TABLE_NAME"])." ENGINE=$a[ENGINE] COLLATE=$a[TABLE_COLLATION] COMMENT=$ya;
					END IF":"BEGIN END").";";}echo"
				ELSE
					SET alter_command = CONCAT(alter_command, 'DROP TABLE `', REPLACE(_table_name, '`', '``'), '`;\\n');
			END CASE;
		END IF;
	UNTIL done END REPEAT;
	CLOSE tables;
END;;
DELIMITER ;
CALL adminer_alter(@adminer_alter);
DROP PROCEDURE adminer_alter;
";}if(in_array("CREATE+ALTER",array($V,$_POST["table_style"]))&&$rb){echo"SELECT @adminer_alter;\n";}}}if($rb){echo"-- ".$g->result("SELECT NOW()")."\n";}exit;}page_header('Export',"",($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),DB);echo'
<form action="" method="post">
<table cellspacing="0">
';$Oe=array('','USE','DROP+CREATE','CREATE');$te=array('','DROP+CREATE','CREATE');$Id=array('','TRUNCATE+INSERT','INSERT');if($y=="sql"){$Oe[]='CREATE+ALTER';$te[]='CREATE+ALTER';$Id[]='INSERT+UPDATE';}parse_str($_COOKIE["adminer_export"],$a);if(!$a){$a=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");}$Ea=($_GET["dump"]=="");echo"<tr><th>".'Výstup'."<td>".html_select("output",$p->dumpOutput(),$a["output"],0)."\n";echo"<tr><th>".'Formát'."<td>".html_select("format",$p->dumpFormat(),$a["format"],0)."\n";echo($y=="sqlite"?"":"<tr><th>".'Databáze'."<td>".html_select('db_style',$Oe,$a["db_style"]).(support("routine")?checkbox("routines",1,$Ea,'Procedury a funkce'):"").(support("event")?checkbox("events",1,$Ea,'Události'):"")),"<tr><th>".'Tabulky'."<td>".html_select('table_style',$te,$a["table_style"]).checkbox("auto_increment",1,$a["table_style"],'Auto Increment').(support("trigger")?checkbox("triggers",1,$a["table_style"],'Triggery'):""),"<tr><th>".'Data'."<td>".html_select('data_style',$Id,$a["data_style"]),'</table>
<p><input type="submit" value="Export">

<table cellspacing="0">
';$ed=array();if(DB!=""){$Ea=($m!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label><input type='checkbox' id='check-tables'$Ea onclick='formCheck(this, /^tables\\[/);'>".'Tabulky'."</label>","<th style='text-align: right;'><label>".'Data'."<input type='checkbox' id='check-data'$Ea onclick='formCheck(this, /^data\\[/);'></label>","</thead>\n";$Z="";foreach(table_status()as$a){$f=$a["Name"];$uc=ereg_replace("_.*","",$f);$Ea=($m==""||$m==(substr($m,-1)=="%"?"$uc%":$f));$db="<tr><td>".checkbox("tables[]",$f,$Ea,$f,"formUncheck('check-tables');");if(is_view($a)){$Z.="$db\n";}else{echo"$db<td align='right'><label>".($a["Engine"]=="InnoDB"&&$a["Rows"]?"~ ":"").$a["Rows"].checkbox("data[]",$f,$Ea,"","formUncheck('check-data');")."</label>\n";}$ed[$uc]++;}echo$Z;}else{echo"<thead><tr><th style='text-align: left;'><label><input type='checkbox' id='check-databases'".($m==""?" checked":"")." onclick='formCheck(this, /^databases\\[/);'>".'Databáze'."</label></thead>\n";$z=get_databases();if($z){foreach($z
as$s){if(!information_schema($s)){$uc=ereg_replace("_.*","",$s);echo"<tr><td>".checkbox("databases[]",$s,$m==""||$m=="$uc%",$s,"formUncheck('check-databases');")."</label>\n";$ed[$uc]++;}}}else{echo"<tr><td><textarea name='databases' rows='10' cols='20' onkeydown='return textareaKeydown(this, event);'></textarea>";}}echo'</table>
</form>
';$cb=true;foreach($ed
as$e=>$b){if($e!=""&&$b>1){echo($cb?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$e%")."'>".h($e)."</a>";$cb=false;}}}elseif(isset($_GET["privileges"])){page_header('Oprávnění');$i=$g->query("SELECT User, Host FROM mysql.user ORDER BY Host, User");if(!$i){echo'<form action=""><p>
';hidden_fields_get();echo'Uživatel: <input name="user">
Server: <input name="host" value="localhost">
<input type="hidden" name="grant" value="">
<input type="submit" value="Upravit">
</form>
';$i=$g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");}echo"<table cellspacing='0'>\n","<thead><tr><th>&nbsp;<th>".'Uživatel'."<th>".'Server'."</thead>\n";while($a=$i->fetch_assoc()){echo'<tr'.odd().'><td><a href="'.h(ME.'user='.urlencode($a["User"]).'&host='.urlencode($a["Host"])).'">'.'upravit'.'</a><td>'.h($a["User"])."<td>".h($a["Host"])."\n";}echo"</table>\n",'<p><a href="'.h(ME).'user=">'.'Vytvořit uživatele'."</a>";}elseif(isset($_GET["sql"])){restart_session();$wf=&get_session("queries");$ib=&$wf[DB];if(!$n&&$_POST["clear"]){$ib=array();redirect(remove_from_uri("history"));}page_header('SQL příkaz',$n);if(!$n&&$_POST){$Ha=false;$j=$_POST["query"];if($_POST["webfile"]){$Ha=@fopen((file_exists("adminer.sql")?"adminer.sql":(file_exists("adminer.sql.gz")?"compress.zlib://adminer.sql.gz":"compress.bzip2://adminer.sql.bz2")),"rb");$j=($Ha?fread($Ha,1e6):false);}elseif($_FILES&&$_FILES["sql_file"]["error"]!=4){$j=get_file("sql_file",true);}if(is_string($j)){if(function_exists('memory_get_usage')){@ini_set("memory_limit",2*strlen($j)+memory_get_usage()+8e6);}if($j!=""&&strlen($j)<1e6&&(!$ib||end($ib)!=$j)){$ib[]=$j;}$Gc="(\\s|/\\*.*\\*/|(#|-- )[^\n]*\n|--\n)";if(!ini_bool("session.use_cookies")){session_write_close();}$dd=";";$L=0;$Md=true;$H=connect();if(is_object($H)&&DB!=""){$H->select_db(DB);}$Db=0;$Lc=array();$zf='[\'`"]'.($y=="pgsql"?'|\\$[^$]*\\$':($y=="mssql"||$y=="sqlite"?'|\\[':'')).'|/\\*|-- |#';while($j!=""){if(!$L&&$y=="sql"&&preg_match('~^\\s*DELIMITER\\s+(.+)~i',$j,$l)){$dd=$l[1];$j=substr($j,strlen($l[0]));}else{preg_match('('.preg_quote($dd)."|$zf|\$)",$j,$l,PREG_OFFSET_CAPTURE,$L);$pa=$l[0][0];$L=$l[0][1]+strlen($pa);if(!$pa&&$Ha&&!feof($Ha)){$j.=fread($Ha,1e5);}else{if(!$pa&&rtrim($j)==""){break;}if($pa&&$pa!=$dd){while(preg_match('('.($pa=='/*'?'\\*/':($pa=='['?']':(ereg('^-- |^#',$pa)?"\n":preg_quote($pa)."|\\\\."))).'|$)s',$j,$l,PREG_OFFSET_CAPTURE,$L)){$ia=$l[0][0];$L=$l[0][1]+strlen($ia);if(!$ia&&$Ha&&!feof($Ha)){$j.=fread($Ha,1e6);}elseif($ia[0]!="\\"){break;}}}else{$Md=false;$ma=substr($j,0,$l[0][1]);$Db++;$db="<pre class='jush-$y' id='sql-$Db'>".shorten_utf8(trim($ma),1000)."</pre>\n";if(!$_POST["only_errors"]){echo$db;ob_flush();flush();}$bd=explode(" ",microtime());if(!$g->multi_query($ma)){echo($_POST["only_errors"]?$db:""),"<p class='error'>".'Chyba v dotazu'.": ".error()."\n";$Lc[]=" <a href='#sql-$Db'>$Db</a>";if($_POST["error_stops"]){break;}}else{if(is_object($H)&&preg_match("~^$Gc*(USE)\\b~isU",$ma)){$H->query($ma);}do{$i=$g->store_result();$ad=explode(" ",microtime());$be=" <span class='time'>(".sprintf('%.3f s',max(0,$ad[0]-$bd[0]+$ad[1]-$bd[1])).")</span>".(strlen($ma)<1000?" <a href='".h(ME)."sql=".urlencode(trim($ma))."'>".'Upravit'."</a>":"");if(!is_object($i)){if(preg_match("~^$Gc*(CREATE|DROP|ALTER)$Gc+(DATABASE|SCHEMA)\\b~isU",$ma)){restart_session();set_session("dbs",null);session_write_close();}if(!$_POST["only_errors"]){echo"<p class='message' title='".h($g->info)."'>".lang(array('Příkaz proběhl v pořádku, byl změněn %d záznam.','Příkaz proběhl v pořádku, byly změněny %d záznamy.','Příkaz proběhl v pořádku, bylo změněno %d záznamů.'),$g->affected_rows)."$be\n";}}else{if($_POST["only_errors"]){echo$db;$db="";}select($i,$H);echo"<p>".($i->num_rows?lang(array('%d řádek','%d řádky','%d řádků'),$i->num_rows):"").$be;if($H&&preg_match("~^($Gc|\\()*SELECT\\b~isU",$ma)){$U="explain-$Db";echo", <a href='#$U' onclick=\"return !toggle('$U');\">EXPLAIN</a>\n","<div id='$U' class='hidden'>\n";select(explain($H,$ma));echo"</div>\n";}}$bd=$ad;}while($g->next_result());}$j=substr($j,$L);$L=0;}}}}if($Md){echo"<p class='message'>".'Žádné příkazy k vykonání.'."\n";}elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d příkaz proběhl v pořádku.','%d příkazy proběhly v pořádku.','%d příkazů proběhlo v pořádku.'),$Db-count($Lc))."\n";}elseif($Lc&&$Db>1){echo"<p class='error'>".'Chyba v dotazu'.": ".implode("",$Lc)."\n";}}else{echo"<p class='error'>".upload_error($j)."\n";}}echo'
<form action="" method="post" enctype="multipart/form-data">
<p>';$ma=$_GET["sql"];if($_POST){$ma=$_POST["query"];}elseif($_GET["history"]!=""){$ma=$ib[$_GET["history"]];}textarea("query",$ma,20);echo($_POST?"":"<script type='text/javascript'>document.getElementsByTagName('textarea')[0].focus();</script>\n"),"<p>".(ini_bool("file_uploads")?'Nahrání souboru'.': <input type="file" name="sql_file">':'Nahrávání souborů není povoleno.'),'<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Provést" title="Ctrl+Enter">
',checkbox("error_stops",1,$_POST["error_stops"],'Zastavit při chybě')."\n",checkbox("only_errors",1,$_POST["only_errors"],'Zobrazit pouze chyby')."\n";print_fieldset("webfile",'Ze serveru',$_POST["webfile"]);$gd=array();foreach(array("gz"=>"zlib","bz2"=>"bz2")as$e=>$b){if(extension_loaded($b)){$gd[]=".$e";}}echo
sprintf('Soubor %s na webovém serveru',"<code>adminer.sql".($gd?"[".implode("|",$gd)."]":"")."</code>"),' <input type="submit" name="webfile" value="'.'Spustit soubor'.'">',"</div></fieldset>\n";if($ib){print_fieldset("history",'Historie',$_GET["history"]!="");foreach($ib
as$e=>$b){echo'<a href="'.h(ME."sql=&history=$e").'">'.'Upravit'."</a> <code class='jush-$y'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$b)))),80,"</code>")."<br>\n";}echo"<input type='submit' name='clear' value='".'Vyčistit'."'>\n","</div></fieldset>\n";}echo'
</form>
';}elseif(isset($_GET["edit"])){$m=$_GET["edit"];$t=(isset($_GET["select"])?(count($_POST["check"])==1?where_check($_POST["check"][0]):""):where($_GET));$na=(isset($_GET["select"])?$_POST["edit"]:$t);$o=fields($m);foreach($o
as$f=>$d){if(!isset($d["privileges"][$na?"update":"insert"])||$p->fieldName($d)==""){unset($o[$f]);}}if($_POST&&!$n&&!isset($_GET["select"])){$ja=$_POST["referer"];if($_POST["insert"]){$ja=($na?null:$_SERVER["REQUEST_URI"]);}elseif(!ereg('^.+&select=.+$',$ja)){$ja=ME."select=".urlencode($m);}if(isset($_POST["delete"])){query_redirect("DELETE".limit1("FROM ".table($m)," WHERE $t"),$ja,'Položka byla smazána.');}else{$q=array();foreach($o
as$f=>$d){$b=process_input($d);if($b!==false&&$b!==null){$q[idf_escape($f)]=($na?"\n".idf_escape($f)." = $b":$b);}}if($na){if(!$q){redirect($ja);}query_redirect("UPDATE".limit1(table($m)." SET".implode(",",$q),"\nWHERE $t"),$ja,'Položka byla aktualizována.');}else{$i=insert_into($m,$q);$ee=($i?last_id():0);queries_redirect($ja,sprintf('Položka%s byla vložena.',($ee?" $ee":"")),$i);}}}$Ba=$p->tableName(table_status($m));page_header(($na?'Upravit':'Vložit'),$n,array("select"=>array($m,$Ba)),$Ba);$a=null;if($_POST["save"]){$a=(array)$_POST["fields"];}elseif($t){$N=array();foreach($o
as$f=>$d){if(isset($d["privileges"]["select"])){$N[]=($_POST["clone"]&&$d["auto_increment"]?"'' AS ":(ereg("enum|set",$d["type"])?"1*".idf_escape($f)." AS ":"")).idf_escape($f);}}$a=array();if($N){$G=get_rows("SELECT".limit(implode(", ",$N)." FROM ".table($m)," WHERE $t",(isset($_GET["select"])?2:1)));$a=(isset($_GET["select"])&&count($G)!=1?null:reset($G));}}echo'
<form action="" method="post" enctype="multipart/form-data">
';if($o){echo"<table cellspacing='0'>\n";foreach($o
as$f=>$d){echo"<tr><th>".$p->fieldName($d);$xa=$_GET["set"][bracket_escape($f)];$r=(isset($a)?($a[$f]!=""&&ereg("enum|set",$d["type"])?+$a[$f]:$a[$f]):(!$na&&$d["auto_increment"]?"":(isset($_GET["select"])?false:(isset($xa)?$xa:$d["default"]))));if(!$_POST["save"]&&is_string($r)){$r=$p->editVal($r,$d);}$O=($_POST["save"]?(string)$_POST["function"][$f]:($t&&$d["on_update"]=="CURRENT_TIMESTAMP"?"now":($r===false?null:(isset($r)?'':'NULL'))));if($d["type"]=="timestamp"&&$r=="CURRENT_TIMESTAMP"){$r="";$O="now";}input($d,$r,$O);echo"\n";}echo"</table>\n";}echo'<p>
<input type="hidden" name="token" value="',$K,'">
<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
';if(isset($_GET["select"])){hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));}if($o){echo"<input type='submit' value='".'Uložit'."'>\n";if(!isset($_GET["select"])){echo'<input type="submit" name="insert" value="'.($na?'Uložit a pokračovat v editaci':'Uložit a vložit další')."\">\n";}}if($na){echo"<input type='submit' name='delete' value='".'Smazat'."'".confirm().">\n";}echo'</form>
';}elseif(isset($_GET["create"])){$m=$_GET["create"];$Yd=array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST');$Xd=referencable_primary($m);$ba=array();foreach($Xd
as$Ba=>$d){$ba[str_replace("`","``",$Ba)."`".str_replace("`","``",$d["field"])]=$Ba;}$Vc=array();$yc=array();if($m!=""){$Vc=fields($m);$yc=table_status($m);}if($_POST&&!$n&&!$_POST["add"]&&!$_POST["drop_col"]&&!$_POST["up"]&&!$_POST["down"]){if($_POST["drop"]){query_redirect("DROP TABLE ".table($m),substr(ME,0,-1),'Tabulka byla odstraněna.');}else{$o=array();$eb=array();ksort($_POST["fields"]);$ld=reset($Vc);$Nb="FIRST";foreach($_POST["fields"]as$e=>$d){$A=$ba[$d["type"]];$Fc=(isset($A)?$Xd[$A]:$d);if($d["field"]!=""){if(!$d["has_default"]){$d["default"]=null;}$xa=eregi_replace(" *on update CURRENT_TIMESTAMP","",$d["default"]);if($xa!=$d["default"]){$d["on_update"]="CURRENT_TIMESTAMP";$d["default"]=$xa;}if($e==$_POST["auto_increment_col"]){$d["auto_increment"]=true;}$Vd=process_field($d,$Fc);if($Vd!=process_field($ld,$ld)){$o[]=array($d["orig"],$Vd,$Nb);}if(isset($A)){$eb[]=($m!=""?"ADD":" ")." FOREIGN KEY (".idf_escape($d["field"]).") REFERENCES ".idf_escape($ba[$d["type"]])." (".idf_escape($Fc["field"]).")".(in_array($d["on_delete"],$bb)?" ON DELETE $d[on_delete]":"");}$Nb="AFTER ".idf_escape($d["field"]);}elseif($d["orig"]!=""){$o[]=array($d["orig"]);}if($d["orig"]!=""){$ld=next($Vc);}}$ob="";if(in_array($_POST["partition_by"],$Yd)){$Cd=array();if($_POST["partition_by"]=='RANGE'||$_POST["partition_by"]=='LIST'){foreach(array_filter($_POST["partition_names"])as$e=>$b){$r=$_POST["partition_values"][$e];$Cd[]="\nPARTITION ".idf_escape($b)." VALUES ".($_POST["partition_by"]=='RANGE'?"LESS THAN":"IN").($r!=""?" ($r)":" MAXVALUE");}}$ob.="\nPARTITION BY $_POST[partition_by]($_POST[partition])".($Cd?" (".implode(",",$Cd)."\n)":($_POST["partitions"]?" PARTITIONS ".(+$_POST["partitions"]):""));}elseif($m!=""&&support("partitioning")){$ob.="\nREMOVE PARTITIONING";}$va='Tabulka byla změněna.';if($m==""){cookie("adminer_engine",$_POST["Engine"]);$va='Tabulka byla vytvořena.';}queries_redirect(ME."table=".urlencode($_POST["name"]),$va,alter_table($m,$_POST["name"],$o,$eb,$_POST["Comment"],($_POST["Engine"]&&$_POST["Engine"]!=$yc["Engine"]?$_POST["Engine"]:""),($_POST["Collation"]&&$_POST["Collation"]!=$yc["Collation"]?$_POST["Collation"]:""),($_POST["Auto_increment"]!=""?+$_POST["Auto_increment"]:""),$ob));}}page_header(($m!=""?'Pozměnit tabulku':'Vytvořit tabulku'),$n,array("table"=>$m),$m);$a=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"")),"partition_names"=>array(""),);if($_POST){$a=$_POST;if($a["auto_increment_col"]){$a["fields"][$a["auto_increment_col"]]["auto_increment"]=true;}process_fields($a["fields"]);}elseif($m!=""){$a=$yc;$a["name"]=$m;$a["fields"]=array();if(!$_GET["auto_increment"]){$a["Auto_increment"]="";}foreach($Vc
as$d){$d["has_default"]=isset($d["default"]);if($d["on_update"]){$d["default"].=" ON UPDATE $d[on_update]";}$a["fields"][]=$d;}if(support("partitioning")){$ac="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($m);$i=$g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $ac ORDER BY PARTITION_ORDINAL_POSITION LIMIT 1");list($a["partition_by"],$a["partitions"],$a["partition"])=$i->fetch_row();$a["partition_names"]=array();$a["partition_values"]=array();foreach(get_rows("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $ac AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION")as$xc){$a["partition_names"][]=$xc["PARTITION_NAME"];$a["partition_values"][]=$xc["PARTITION_DESCRIPTION"];}$a["partition_names"][]="";}}$W=collations();$Ad=floor(extension_loaded("suhosin")?(min(ini_get("suhosin.request.max_vars"),ini_get("suhosin.post.max_vars"))-13)/10:0);if($Ad&&count($a["fields"])>$Ad){echo"<p class='error'>".h(sprintf('Byl překročen maximální povolený počet polí. Zvyšte prosím %s a %s.','suhosin.post.max_vars','suhosin.request.max_vars'))."\n";}$md=engines();foreach($md
as$tb){if(!strcasecmp($tb,$a["Engine"])){$a["Engine"]=$tb;break;}}echo'
<form action="" method="post" id="form">
<p>
Název tabulky: <input name="name" maxlength="64" value="',h($a["name"]),'">
',($md?html_select("Engine",array(""=>"(".'úložiště'.")")+$md,$a["Engine"]):""),' ',($W&&!ereg("sqlite|mssql",$y)?html_select("Collation",array(""=>"(".'porovnávání'.")")+$W,$a["Collation"]):""),' <input type="submit" value="Uložit">
<table cellspacing="0" id="edit-fields" class="nowrap">
';$Kb=edit_fields($a["fields"],$W,"TABLE",$Ad,$ba,$a["Comment"]!="");echo'</table>
<p>
Auto Increment: <input name="Auto_increment" size="6" value="',h($a["Auto_increment"]);?>">
<script type="text/javascript">
document.write('<label><input type="checkbox" onclick="columnShow(this.checked, 5);">Výchozí hodnoty<\/label>');
</script>
<?php echo(support("comment")?checkbox("","",$Kb,'Komentář',"columnShow(this.checked, 6); toggle('Comment'); if (this.checked) this.form['Comment'].focus();").' <input id="Comment" name="Comment" value="'.h($a["Comment"]).'" maxlength="60"'.($Kb?'':' class="hidden"').'>':''),'<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Uložit">
';if(strlen($_GET["create"])){echo'<input type="submit" name="drop" value="Odstranit"',confirm(),'>';}if(support("partitioning")){$Td=ereg('RANGE|LIST',$a["partition_by"]);print_fieldset("partition",'Rozdělit podle',$a["partition_by"]);echo'<p>
',html_select("partition_by",array(-1=>"")+$Yd,$a["partition_by"],"partitionByChange(this);"),'(<input name="partition" value="',h($a["partition"]),'">)
Oddíly: <input name="partitions" size="2" value="',h($a["partitions"]),'"',($Td||!$a["partition_by"]?" class='hidden'":""),'>
<table cellspacing="0" id="partition-table"',($Td?"":" class='hidden'"),'>
<thead><tr><th>Název oddílu<th>Hodnoty</thead>
';foreach($a["partition_names"]as$e=>$b){echo'<tr>','<td><input name="partition_names[]" value="'.h($b).'"'.($e==count($a["partition_names"])-1?' onchange="partitionNameChange(this);"':'').'>','<td><input name="partition_values[]" value="'.h($a["partition_values"][$e]).'">';}echo'</table>
</div></fieldset>
';}echo'</form>
';}elseif(isset($_GET["indexes"])){$m=$_GET["indexes"];$Bc=array("PRIMARY","UNIQUE","INDEX");$I=table_status($m);if(eregi("MyISAM|M?aria",$I["Engine"])){$Bc[]="FULLTEXT";}$J=indexes($m);if($y=="sqlite"){unset($Bc[0]);unset($J[""]);}if($_POST&&!$n&&!$_POST["add"]){$u=array();foreach($_POST["indexes"]as$v){if(in_array($v["type"],$Bc)){$B=array();$Xb=array();$q=array();ksort($v["columns"]);foreach($v["columns"]as$e=>$C){if($C!=""){$aa=$v["lengths"][$e];$q[]=idf_escape($C).($aa?"(".(+$aa).")":"");$B[]=$C;$Xb[]=($aa?$aa:null);}}if($B){foreach($J
as$f=>$Cb){ksort($Cb["columns"]);ksort($Cb["lengths"]);if($v["type"]==$Cb["type"]&&array_values($Cb["columns"])===$B&&(!$Cb["lengths"]||array_values($Cb["lengths"])===$Xb)){unset($J[$f]);continue
2;}}$u[]=array($v["type"],"(".implode(", ",$q).")");}}}foreach($J
as$f=>$Cb){$u[]=array($Cb["type"],idf_escape($f),"DROP");}if(!$u){redirect(ME."table=".urlencode($m));}queries_redirect(ME."table=".urlencode($m),'Indexy byly změněny.',alter_indexes($m,$u));}page_header('Indexy',$n,array("table"=>$m),$m);$o=array_keys(fields($m));$a=array("indexes"=>$J);if($_POST){$a=$_POST;if($_POST["add"]){foreach($a["indexes"]as$e=>$v){if($v["columns"][count($v["columns"])]!=""){$a["indexes"][$e]["columns"][]="";}}$v=end($a["indexes"]);if($v["type"]||array_filter($v["columns"],'strlen')||array_filter($v["lengths"],'strlen')){$a["indexes"][]=array("columns"=>array(1=>""));}}}else{foreach($a["indexes"]as$e=>$v){$a["indexes"][$e]["columns"][]="";}$a["indexes"][]=array("columns"=>array(1=>""));}echo'
<form action="" method="post">
<table cellspacing="0" class="nowrap">
<thead><tr><th>Typ indexu<th>Sloupec (délka)</thead>
';$oa=1;foreach($a["indexes"]as$v){echo"<tr><td>".html_select("indexes[$oa][type]",array(-1=>"")+$Bc,$v["type"],($oa==count($a["indexes"])?"indexesAddRow(this);":1))."<td>";ksort($v["columns"]);$k=1;foreach($v["columns"]as$C){echo"<span>".html_select("indexes[$oa][columns][$k]",array(-1=>"")+$o,$C,($k==count($v["columns"])?"indexesAddColumn(this);":1)),"<input name='indexes[$oa][lengths][$k]' size='2' value='".h($v["lengths"][$k])."'> </span>";$k++;}$oa++;}echo'</table>
<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Uložit">
<noscript><p><input type="submit" name="add" value="Přidat další"></noscript>
</form>
';}elseif(isset($_GET["database"])){if($_POST&&!$n&&!isset($_POST["add_x"])){restart_session();if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'Databáze byla odstraněna.',drop_databases(array(DB)));}elseif(DB!==$_POST["name"]){if(DB!=""){$_GET["db"]=$_POST["name"];queries_redirect(preg_replace('~db=[^&]*&~','',ME)."db=".urlencode($_POST["name"]),'Databáze byla přejmenována.',rename_database($_POST["name"],$_POST["collation"]));}else{$z=explode("\n",str_replace("\r","",$_POST["name"]));$Qd=true;$wb="";foreach($z
as$s){if(count($z)==1||$s!=""){if(!create_database($s,$_POST["collation"])){$Qd=false;}$wb=$s;}}queries_redirect(ME."db=".urlencode($wb),'Databáze byla vytvořena.',$Qd);}}else{if(!$_POST["collation"]){redirect(substr(ME,0,-1));}query_redirect("ALTER DATABASE ".idf_escape($_POST["name"]).(eregi('^[a-z0-9_]+$',$_POST["collation"])?" COLLATE $_POST[collation]":""),substr(ME,0,-1),'Databáze byla změněna.');}}page_header(DB!=""?'Pozměnit databázi':'Vytvořit databázi',$n,array(),DB);$W=collations();$f=DB;$dc=null;if($_POST){$f=$_POST["name"];$dc=$_POST["collation"];}elseif(DB!=""){$dc=db_collation(DB,$W);}elseif($y=="sql"){foreach(get_vals("SHOW GRANTS")as$fa){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\\.\\*)?~',$fa,$l)&&$l[1]){$f=stripcslashes(idf_unescape("`$l[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($f,"\n")?'<textarea id="name" name="name" rows="10" cols="40" onkeydown="return textareaKeydown(this, event);">'.h($f).'</textarea><br>':'<input id="name" name="name" value="'.h($f).'" maxlength="64">')."\n".($W?html_select("collation",array(""=>"(".'porovnávání'.")")+$W,$dc):"");?>
<script type='text/javascript'>document.getElementById('name').focus();</script>
<input type="hidden" name="token" value="<?php echo$K,'">
<input type="submit" value="Uložit">
';if(DB!=""){echo"<input type='submit' name='drop' value='".'Odstranit'."'".confirm().">\n";}elseif(!$_POST["add_x"]&&$_GET["db"]==""){echo"<input type='image' name='add' src='".h(preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"]))."?file=plus.gif&amp;version=3.1.0' alt='+' title='".'Přidat další'."'>\n";}echo'</form>
';}elseif(isset($_GET["scheme"])){if($_POST&&!$n){$x=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"]){query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$x,'Schéma bylo odstraněno.');}else{$x.=urlencode($_POST["name"]);if($_GET["ns"]==""){query_redirect("CREATE SCHEMA ".idf_escape($_POST["name"]),$x,'Schéma bylo vytvořeno.');}elseif($_GET["ns"]!=$_POST["name"]){query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($_POST["name"]),$x,'Schéma bylo změněno.');}else{redirect($x);}}}page_header($_GET["ns"]!=""?'Pozměnit schéma':'Vytvořit schéma',$n);$a=array("name"=>$_GET["ns"]);if($_POST){$a=$_POST;}echo'
<form action="" method="post">
<p><input name="name" value="',h($a["name"]),'">
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Uložit">
';if($_GET["ns"]!=""){echo"<input type='submit' name='drop' value='".'Odstranit'."'".confirm().">\n";}echo'</form>
';}elseif(isset($_GET["call"])){$Ra=$_GET["call"];page_header('Zavolat'.": ".h($Ra),$n);$Ma=routine($Ra,(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Ib=array();$lb=array();foreach($Ma["fields"]as$k=>$d){if(substr($d["inout"],-3)=="OUT"){$lb[$k]="@".idf_escape($d["field"])." AS ".idf_escape($d["field"]);}if(!$d["inout"]||substr($d["inout"],0,2)=="IN"){$Ib[]=$k;}}if(!$n&&$_POST){$fe=array();foreach($Ma["fields"]as$e=>$d){if(in_array($e,$Ib)){$b=process_input($d);if($b===false){$b="''";}if(isset($lb[$e])){$g->query("SET @".idf_escape($d["field"])." = $b");}}$fe[]=(isset($lb[$e])?"@".idf_escape($d["field"]):$b);}$j=(isset($_GET["callf"])?"SELECT":"CALL")." ".idf_escape($Ra)."(".implode(", ",$fe).")";echo"<p><code class='jush-$y'>".h($j)."</code> <a href='".h(ME)."sql=".urlencode($j)."'>".'Upravit'."</a>\n";if(!$g->multi_query($j)){echo"<p class='error'>".error()."\n";}else{do{$i=$g->store_result();if(is_object($i)){select($i);}else{echo"<p class='message'>".lang(array('Procedura byla zavolána, byl změněn %d záznam.','Procedura byla zavolána, byly změněny %d záznamy.','Procedura byla zavolána, bylo změněno %d záznamů.'),$g->affected_rows)."\n";}}while($g->next_result());if($lb){select($g->query("SELECT ".implode(", ",$lb)));}}}echo'
<form action="" method="post">
';if($Ib){echo"<table cellspacing='0'>\n";foreach($Ib
as$e){$d=$Ma["fields"][$e];$f=$d["field"];echo"<tr><th>".$p->fieldName($d);$r=$_POST["fields"][$f];if($r!=""){if($d["type"]=="enum"){$r=+$r;}if($d["type"]=="set"){$r=array_sum($r);}}input($d,$r,(string)$_POST["function"][$f]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Zavolat">
</form>
';}elseif(isset($_GET["foreign"])){$m=$_GET["foreign"];if($_POST&&!$n&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){if($_POST["drop"]){query_redirect("ALTER TABLE ".table($m)."\nDROP ".($y=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($_GET["name"]),ME."table=".urlencode($m),'Cizí klíč byl odstraněn.');}else{$Ga=array_filter($_POST["source"],'strlen');ksort($Ga);$qa=array();foreach($Ga
as$e=>$b){$qa[$e]=$_POST["target"][$e];}query_redirect("ALTER TABLE ".table($m).($_GET["name"]!=""?"\nDROP FOREIGN KEY ".idf_escape($_GET["name"]).",":"")."\nADD FOREIGN KEY (".implode(", ",array_map('idf_escape',$Ga)).") REFERENCES ".table($_POST["table"])." (".implode(", ",array_map('idf_escape',$qa)).")".(in_array($_POST["on_delete"],$bb)?" ON DELETE $_POST[on_delete]":"").(in_array($_POST["on_update"],$bb)?" ON UPDATE $_POST[on_update]":""),ME."table=".urlencode($m),($_GET["name"]!=""?'Cizí klíč byl změněn.':'Cizí klíč byl vytvořen.'));$n='Zdrojové a cílové sloupce musí mít stejný datový typ, nad cílovými sloupci musí být definován index a odkazovaná data musí existovat.'."<br>$n";}}page_header('Cizí klíč',$n,array("table"=>$m),$m);$a=array("table"=>$m,"source"=>array(""));if($_POST){$a=$_POST;ksort($a["source"]);if($_POST["add"]){$a["source"][]="";}elseif($_POST["change"]||$_POST["change-js"]){$a["target"]=array();}}elseif($_GET["name"]!=""){$ba=foreign_keys($m);$a=$ba[$_GET["name"]];$a["source"][]="";}$Ga=array_keys(fields($m));$qa=($m===$a["table"]?$Ga:array_keys(fields($a["table"])));$Pd=array();foreach(table_status()as$f=>$I){if(fk_support($I)){$Pd[]=$f;}}echo'
<form action="" method="post">
<p>
';if($a["db"]==""){echo'Cílová tabulka:
',html_select("table",$Pd,$a["table"],"this.form['change-js'].value = '1'; this.form.submit();"),'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Změnit"></noscript>
<table cellspacing="0">
<thead><tr><th>Zdroj<th>Cíl</thead>
';$oa=0;foreach($a["source"]as$e=>$b){echo"<tr>","<td>".html_select("source[".(+$e)."]",array(-1=>"")+$Ga,$b,($oa==count($a["source"])-1?"foreignAddRow(this);":1)),"<td>".html_select("target[".(+$e)."]",$qa,$a["target"][$e]);$oa++;}echo'</table>
<p>
Při smazání: ',html_select("on_delete",array(-1=>"")+$bb,$a["on_delete"]),' Při změně: ',html_select("on_update",array(-1=>"")+$bb,$a["on_update"]),'<p>
<input type="submit" value="Uložit">
<noscript><p><input type="submit" name="add" value="Přidat sloupec"></noscript>
';}if($_GET["name"]!=""){echo'<input type="submit" name="drop" value="Odstranit"',confirm(),'>';}echo'<input type="hidden" name="token" value="',$K,'">
</form>
';}elseif(isset($_GET["view"])){$m=$_GET["view"];$Ua=false;if($_POST&&!$n){$Ua=drop_create("DROP VIEW ".table($m),"CREATE VIEW ".table($_POST["name"])." AS\n$_POST[select]",($_POST["drop"]?substr(ME,0,-1):ME."table=".urlencode($_POST["name"])),'Pohled byl odstraněn.','Pohled byl změněn.','Pohled byl vytvořen.',$m);}page_header(($m!=""?'Pozměnit pohled':'Vytvořit pohled'),$n,array("table"=>$m),$m);$a=array();if($_POST){$a=$_POST;}elseif($m!=""){$a=view($m);$a["name"]=$m;}echo'
<form action="" method="post">
<p>Název: <input name="name" value="',h($a["name"]),'" maxlength="64">
<p>';textarea("select",$a["select"]);echo'<p>
<input type="hidden" name="token" value="',$K,'">
';if($Ua){echo'<input type="hidden" name="dropped" value="1">';}echo'<input type="submit" value="Uložit">
</form>
';}elseif(isset($_GET["event"])){$gb=$_GET["event"];$Jd=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$vd=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");if($_POST&&!$n){if($_POST["drop"]){query_redirect("DROP EVENT ".idf_escape($gb),substr(ME,0,-1),'Událost byla odstraněna.');}elseif(in_array($_POST["INTERVAL_FIELD"],$Jd)&&isset($vd[$_POST["STATUS"]])){$Gd="\nON SCHEDULE ".($_POST["INTERVAL_VALUE"]?"EVERY ".q($_POST["INTERVAL_VALUE"])." $_POST[INTERVAL_FIELD]".($_POST["STARTS"]?" STARTS ".q($_POST["STARTS"]):"").($_POST["ENDS"]?" ENDS ".q($_POST["ENDS"]):""):"AT ".q($_POST["STARTS"]))." ON COMPLETION".($_POST["ON_COMPLETION"]?"":" NOT")." PRESERVE";query_redirect(($gb!=""?"ALTER EVENT ".idf_escape($gb).$Gd.($gb!=$_POST["EVENT_NAME"]?"\nRENAME TO ".idf_escape($_POST["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($_POST["EVENT_NAME"]).$Gd)."\n".$vd[$_POST["STATUS"]]." COMMENT ".q($_POST["EVENT_COMMENT"])." DO\n$_POST[EVENT_DEFINITION]",substr(ME,0,-1),($gb!=""?'Událost byla změněna.':'Událost byla vytvořena.'));}}page_header(($gb!=""?'Pozměnit událost'.": ".h($gb):'Vytvořit událost'),$n);$a=array();if($_POST){$a=$_POST;}elseif($gb!=""){$G=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($gb));$a=reset($G);}echo'
<form action="" method="post">
<table cellspacing="0">
<tr><th>Název<td><input name="EVENT_NAME" value="',h($a["EVENT_NAME"]),'" maxlength="64">
<tr><th>Začátek<td><input name="STARTS" value="',h("$a[EXECUTE_AT]$a[STARTS]"),'">
<tr><th>Konec<td><input name="ENDS" value="',h($a["ENDS"]),'">
<tr><th>Každých<td><input name="INTERVAL_VALUE" value="',h($a["INTERVAL_VALUE"]),'" size="6"> ',html_select("INTERVAL_FIELD",$Jd,$a["INTERVAL_FIELD"]),'<tr><th>Stav<td>',html_select("STATUS",$vd,$a["STATUS"]),'<tr><th>Komentář<td><input name="EVENT_COMMENT" value="',h($a["EVENT_COMMENT"]),'" maxlength="64">
<tr><th>&nbsp;<td>',checkbox("ON_COMPLETION","PRESERVE",$a["ON_COMPLETION"]=="PRESERVE",'Po dokončení zachovat'),'</table>
<p>';textarea("EVENT_DEFINITION",$a["EVENT_DEFINITION"]);echo'<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Uložit">
';if($gb!=""){echo'<input type="submit" name="drop" value="Odstranit"',confirm(),'>';}echo'</form>
';}elseif(isset($_GET["procedure"])){$Ra=$_GET["procedure"];$Ma=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$Ua=false;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["drop_col"]&&!$_POST["up"]&&!$_POST["down"]){$q=array();$o=(array)$_POST["fields"];ksort($o);foreach($o
as$d){if($d["field"]!=""){$q[]=(in_array($d["inout"],$nc)?"$d[inout] ":"").idf_escape($d["field"]).process_type($d,"CHARACTER SET");}}$Ua=drop_create("DROP $Ma ".idf_escape($Ra),"CREATE $Ma ".idf_escape($_POST["name"])." (".implode(", ",$q).")".(isset($_GET["function"])?" RETURNS".process_type($_POST["returns"],"CHARACTER SET"):"")."\n$_POST[definition]",substr(ME,0,-1),'Procedura byla odstraněna.','Procedura byla změněna.','Procedura byla vytvořena.',$Ra);}page_header(($Ra!=""?(isset($_GET["function"])?'Změnit funkci':'Změnit proceduru').": ".h($Ra):(isset($_GET["function"])?'Vytvořit funkci':'Vytvořit proceduru')),$n);$W=get_vals("SHOW CHARACTER SET");sort($W);$a=array("fields"=>array());if($_POST){$a=$_POST;$a["fields"]=(array)$a["fields"];process_fields($a["fields"]);}elseif($Ra!=""){$a=routine($Ra,$Ma);$a["name"]=$Ra;}echo'
<form action="" method="post" id="form">
<p>Název: <input name="name" value="',h($a["name"]),'" maxlength="64">
<table cellspacing="0" class="nowrap">
';edit_fields($a["fields"],$W,$Ma);if(isset($_GET["function"])){echo"<tr><td>".'Návratový typ';edit_type("returns",$a["returns"],$W);}echo'</table>
<p>';textarea("definition",$a["definition"]);echo'<p>
<input type="hidden" name="token" value="',$K,'">
';if($Ua){echo'<input type="hidden" name="dropped" value="1">';}echo'<input type="submit" value="Uložit">
';if($Ra!=""){echo'<input type="submit" name="drop" value="Odstranit"',confirm(),'>';}echo'</form>
';}elseif(isset($_GET["sequence"])){$yb=$_GET["sequence"];if($_POST&&!$n){$x=substr(ME,0,-1);if($_POST["drop"]){query_redirect("DROP SEQUENCE ".idf_escape($yb),$x,'Sekvence byla odstraněna.');}elseif($yb==""){query_redirect("CREATE SEQUENCE ".idf_escape($_POST["name"]),$x,'Sekvence byla vytvořena.');}elseif($yb!=$_POST["name"]){query_redirect("ALTER SEQUENCE ".idf_escape($yb)." RENAME TO ".idf_escape($_POST["name"]),$x,'Sekvence byla změněna.');}else{redirect($x);}}page_header($yb!=""?'Pozměnit sekvenci'.": ".h($yb):'Vytvořit sekvenci',$n);$a=array("name"=>$yb);if($_POST){$a=$_POST;}echo'
<form action="" method="post">
<p><input name="name" value="',h($a["name"]),'">
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Uložit">
';if($yb!=""){echo"<input type='submit' name='drop' value='".'Odstranit'."'".confirm().">\n";}echo'</form>
';}elseif(isset($_GET["type"])){$Oc=$_GET["type"];if($_POST&&!$n){$x=substr(ME,0,-1);if($_POST["drop"]){query_redirect("DROP TYPE ".idf_escape($Oc),$x,'Typ byl odstraněn.');}else{query_redirect("CREATE TYPE ".idf_escape($_POST["name"])." $_POST[as]",$x,'Typ byl vytvořen.');}}page_header($Oc!=""?'Pozměnit typ'.": ".h($Oc):'Vytvořit typ',$n);$a["as"]="AS ";if($_POST){$a=$_POST;}echo'
<form action="" method="post">
<p>
<input type="hidden" name="token" value="',$K,'">
';if($Oc!=""){echo"<input type='submit' name='drop' value='".'Odstranit'."'".confirm().">\n";}else{echo"<input name='name' value='".h($a['name'])."'>\n";textarea("as",$a["as"]);echo"<p><input type='submit' value='".'Uložit'."'>\n";}echo'</form>
';}elseif(isset($_GET["trigger"])){$m=$_GET["trigger"];$Jc=trigger_options();$Fd=array("INSERT","UPDATE","DELETE");$Ua=false;if($_POST&&!$n&&in_array($_POST["Timing"],$Jc["Timing"])&&in_array($_POST["Event"],$Fd)&&in_array($_POST["Type"],$Jc["Type"])){$Od=" $_POST[Timing] $_POST[Event]";$Ab=" ON ".table($m);$Ua=drop_create("DROP TRIGGER ".idf_escape($_GET["name"]).($y=="pgsql"?$Ab:""),"CREATE TRIGGER ".idf_escape($_POST["Trigger"]).($y=="mssql"?$Ab.$Od:$Od.$Ab)." $_POST[Type]\n$_POST[Statement]",ME."table=".urlencode($m),'Trigger byl odstraněn.','Trigger byl změněn.','Trigger byl vytvořen.',$_GET["name"]);}page_header(($_GET["name"]!=""?'Změnit trigger'.": ".h($_GET["name"]):'Vytvořit trigger'),$n,array("table"=>$m));$a=array("Trigger"=>$m."_bi");if($_POST){$a=$_POST;}elseif($_GET["name"]!=""){$a=trigger($_GET["name"]);}echo'
<form action="" method="post" id="form">
<table cellspacing="0">
<tr><th>Čas<td>',html_select("Timing",$Jc["Timing"],$a["Timing"],"if (/^".h(preg_quote($m,"/"))."_[ba][iud]$/.test(this.form['Trigger'].value)) this.form['Trigger'].value = '".h(js_escape($m))."_' + selectValue(this).charAt(0).toLowerCase() + selectValue(this.form['Event']).charAt(0).toLowerCase();"),'<tr><th>Událost<td>',html_select("Event",$Fd,$a["Event"],"this.form['Timing'].onchange();"),'<tr><th>Typ<td>',html_select("Type",$Jc["Type"],$a["Type"]),'</table>
<p>Název: <input name="Trigger" value="',h($a["Trigger"]),'" maxlength="64">
<p>';textarea("Statement",$a["Statement"]);echo'<p>
<input type="hidden" name="token" value="',$K,'">
';if($Ua){echo'<input type="hidden" name="dropped" value="1">';}echo'<input type="submit" value="Uložit">
';if($_GET["name"]!=""){echo'<input type="submit" name="drop" value="Odstranit"',confirm(),'>';}echo'</form>
';}elseif(isset($_GET["user"])){$nd=$_GET["user"];$la=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$a){foreach(explode(",",($a["Privilege"]=="Grant option"?"":$a["Context"]))as$Ec){$la[$Ec][$a["Privilege"]]=$a["Comment"];}}$la["Server Admin"]+=$la["File access on server"];$la["Databases"]["Create routine"]=$la["Procedures"]["Create routine"];unset($la["Procedures"]["Create routine"]);$la["Columns"]=array();foreach(array("Select","Insert","Update","References")as$b){$la["Columns"][$b]=$la["Tables"][$b];}unset($la["Server Admin"]["Usage"]);foreach($la["Tables"]as$e=>$b){unset($la["Databases"][$e]);}$rc=array();if($_POST){foreach($_POST["objects"]as$e=>$b){$rc[$b]=(array)$rc[$b]+(array)$_POST["grants"][$e];}}$Za=array();$zc="";if(isset($_GET["host"])&&($i=$g->query("SHOW GRANTS FOR ".q($nd)."@".q($_GET["host"])))){while($a=$i->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$a[0],$l)&&preg_match_all('~ *([^(,]*[^ ,(])( *\\([^)]+\\))?~',$l[1],$ta,PREG_SET_ORDER)){foreach($ta
as$b){if($b[1]!="USAGE"){$Za["$l[2]$b[2]"][$b[1]]=true;}if(ereg(' WITH GRANT OPTION',$a[0])){$Za["$l[2]$b[2]"]["GRANT OPTION"]=true;}}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$a[0],$l)){$zc=$l[1];}}}if($_POST&&!$n){$Yb=(isset($_GET["host"])?q($nd)."@".q($_GET["host"]):"''");$jb=q($_POST["user"])."@".q($_POST["host"]);$zd=q($_POST["pass"]);if($_POST["drop"]){query_redirect("DROP USER $Yb",ME."privileges=",'Uživatel byl odstraněn.');}else{if($Yb!=$jb){$n=!queries(($g->server_info<5?"GRANT USAGE ON *.* TO":"CREATE USER")." $jb IDENTIFIED BY".($_POST["hashed"]?" PASSWORD":"")." $zd");}elseif($_POST["pass"]!=$zc||!$_POST["hashed"]){queries("SET PASSWORD FOR $jb = ".($_POST["hashed"]?$zd:"PASSWORD($zd)"));}if(!$n){$vc=array();foreach($rc
as$Wa=>$fa){if(isset($_GET["grant"])){$fa=array_filter($fa);}$fa=array_keys($fa);if(isset($_GET["grant"])){$vc=array_diff(array_keys(array_filter($rc[$Wa],'strlen')),$fa);}elseif($Yb==$jb){$ge=array_keys((array)$Za[$Wa]);$vc=array_diff($ge,$fa);$fa=array_diff($fa,$ge);unset($Za[$Wa]);}if(preg_match('~^(.+)\\s*(\\(.*\\))?$~U',$Wa,$l)&&(!grant("REVOKE",$vc,$l[2]," ON $l[1] FROM $jb")||!grant("GRANT",$fa,$l[2]," ON $l[1] TO $jb"))){$n=true;break;}}}if(!$n&&isset($_GET["host"])){if($Yb!=$jb){queries("DROP USER $Yb");}elseif(!isset($_GET["grant"])){foreach($Za
as$Wa=>$vc){if(preg_match('~^(.+)(\\(.*\\))?$~U',$Wa,$l)){grant("REVOKE",array_keys($vc),$l[2]," ON $l[1] FROM $jb");}}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'Uživatel byl změněn.':'Uživatel byl vytvořen.'),!$n);if($Yb!=$jb){$g->query("DROP USER $jb");}}}page_header((isset($_GET["host"])?'Uživatel'.": ".h("$nd@$_GET[host]"):'Vytvořit uživatele'),$n,array("privileges"=>array('','Oprávnění')));if($_POST){$a=$_POST;$Za=$rc;}else{$a=$_GET+array("host"=>$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$a["pass"]=$zc;if($zc!=""){$a["hashed"]=true;}$Za[""]=true;}echo'<form action="" method="post">
<table cellspacing="0">
<tr><th>Uživatel<td><input name="user" maxlength="16" value="',h($a["user"]),'">
<tr><th>Server<td><input name="host" maxlength="60" value="',h($a["host"]),'">
<tr><th>Heslo<td><input id="pass" name="pass" value="',h($a["pass"]),'">
';if(!$a["hashed"]){echo'<script type="text/javascript">typePassword(document.getElementById(\'pass\'));</script>';}echo
checkbox("hashed",1,$a["hashed"],'Zahašované',"typePassword(this.form['pass'], this.checked);"),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'><a href='http://dev.mysql.com/doc/refman/".substr($g->server_info,0,3)."/en/grant.html'>".'Oprávnění'."</a>";$k=0;foreach($Za
as$Wa=>$fa){echo'<th>'.($Wa!="*.*"?"<input name='objects[$k]' value='".h($Wa)."' size='10'>":"<input type='hidden' name='objects[$k]' value='*.*' size='10'>*.*");$k++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Server',"Databases"=>'Databáze',"Tables"=>'Tabulka',"Columns"=>'Sloupec',"Procedures"=>'Procedura',)as$Ec=>$hc){foreach((array)$la[$Ec]as$sc=>$ya){echo"<tr".odd()."><td".($hc?">$hc<td":" colspan='2'").' lang="en" title="'.h($ya).'">'.h($sc);$k=0;foreach($Za
as$Wa=>$fa){$f="'grants[$k][".h(strtoupper($sc))."]'";$r=$fa[strtoupper($sc)];if($Ec=="Server Admin"&&$Wa!=(isset($Za["*.*"])?"*.*":"")){echo"<td>&nbsp;";}elseif(isset($_GET["grant"])){echo"<td><select name=$f><option><option value='1'".($r?" selected":"").">".'Povolit'."<option value='0'".($r=="0"?" selected":"").">".'Zakázat'."</select>";}else{echo"<td align='center'><input type='checkbox' name=$f value='1'".($r?" checked":"").($sc=="All privileges"?" id='grants-$k-all'":($sc=="Grant option"?"":" onclick=\"if (this.checked) formUncheck('grants-$k-all');\"")).">";}$k++;}}}echo"</table>\n",'<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Uložit">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Odstranit"',confirm(),'>';}echo'</form>
';}elseif(isset($_GET["processlist"])){if($_POST&&!$n){$jd=0;foreach((array)$_POST["kill"]as$b){if(queries("KILL ".(+$b))){$jd++;}}queries_redirect(ME."processlist=",lang(array('Byl ukončen %d proces.','Byly ukončeny %d procesy.','Bylo ukončeno %d procesů.'),$jd),$jd||!$_POST["kill"]);}page_header('Seznam procesů',$n);echo'
<form action="" method="post">
<table cellspacing="0" onclick="tableClick(event);" class="nowrap">
';foreach(get_rows("SHOW FULL PROCESSLIST")as$k=>$a){if(!$k){echo"<thead><tr lang='en'><th>&nbsp;<th>".implode("<th>",array_keys($a))."</thead>\n";}echo"<tr".odd()."><td>".checkbox("kill[]",$a["Id"],0);foreach($a
as$e=>$b){echo"<td>".($e=="Info"&&$b!=""?"<code class='jush-$y'>".nbsp($b).'</code> <a href="'.h(ME.($a["db"]!=""?"db=".urlencode($a["db"])."&":"")."sql=".urlencode($b)).'">'.'Upravit'.'</a>':nbsp($b));}echo"\n";}echo'</table>
<p>
<input type="hidden" name="token" value="',$K,'">
<input type="submit" value="Ukončit">
</form>
';}elseif(isset($_GET["select"])){$m=$_GET["select"];$I=table_status($m);$J=indexes($m);$o=fields($m);$ba=column_foreign_keys($m);$Hd=array();$B=array();$zb=null;foreach($o
as$e=>$d){$f=$p->fieldName($d);if(isset($d["privileges"]["select"])&&$f!=""){$B[$e]=html_entity_decode(strip_tags($f));if(ereg('text|lob',$d["type"])){$zb=$p->selectLengthProcess();}}$Hd+=$d["privileges"];}list($N,$ra)=$p->selectColumnsProcess($B,$J);$t=$p->selectSearchProcess($o,$J);$nb=$p->selectOrderProcess($o,$J);$M=$p->selectLimitProcess();$ac=($N?implode(", ",$N):"*")."\nFROM ".table($m);$Dd=($ra&&count($ra)<count($N)?"\nGROUP BY ".implode(", ",$ra):"").($nb?"\nORDER BY ".implode(", ",$nb):"");if($_POST&&!$n){$Kd="(".implode(") OR (",array_map('where_check',(array)$_POST["check"])).")";$Ia=$Ac=null;foreach($J
as$v){if($v["type"]=="PRIMARY"){$Ia=array_flip($v["columns"]);$Ac=($N?$Ia:array());break;}}foreach($N
as$e=>$b){$b=$_GET["columns"][$e];if(!$b["fun"]){unset($Ac[$b["col"]]);}}if($_POST["export"]){$p->dumpHeaders($m);$p->dumpTable($m,"");if(ereg("[ct]sv",$_POST["format"])){$a=array_keys($o);if($N){$a=array();foreach($N
as$b){$a[]=(ereg('^`.*`$',$b)?idf_unescape($b):$b);}}dump_csv($a);}if(!is_array($_POST["check"])||$Ac===array()){$pd=$t;if(is_array($_POST["check"])){$pd[]="($Kd)";}$p->dumpData($m,"INSERT","SELECT $ac".($pd?"\nWHERE ".implode(" AND ",$pd):"").$Dd);}else{$Ld=array();foreach($_POST["check"]as$b){$Ld[]="(SELECT".limit($ac,"\nWHERE ".($t?implode(" AND ",$t)." AND ":"").where_check($b).$Dd,1).")";}$p->dumpData($m,"INSERT",implode(" UNION ALL ",$Ld));}exit;}if(!$p->selectEmailProcess($t,$ba)){if($_POST["save"]||$_POST["delete"]){$i=true;$ub=0;$j=table($m);$q=array();if(!$_POST["delete"]){foreach($B
as$f=>$b){$b=process_input($o[$f]);if($b!==null){if($_POST["clone"]){$q[idf_escape($f)]=($b!==false?$b:idf_escape($f));}elseif($b!==false){$q[]=idf_escape($f)." = $b";}}}$j.=($_POST["clone"]?" (".implode(", ",array_keys($q)).")\nSELECT ".implode(", ",$q)."\nFROM ".table($m):" SET\n".implode(",\n",$q));}if($_POST["delete"]||$q){$Tc="UPDATE";if($_POST["delete"]){$Tc="DELETE";$j="FROM $j";}if($_POST["clone"]){$Tc="INSERT";$j="INTO $j";}if($_POST["all"]||($Ac===array()&&$_POST["check"])||count($ra)<count($N)){$i=queries($Tc." $j".($_POST["all"]?($t?"\nWHERE ".implode(" AND ",$t):""):"\nWHERE $Kd"));$ub=$g->affected_rows;}else{foreach((array)$_POST["check"]as$b){$i=queries($Tc.limit1($j,"\nWHERE ".where_check($b)));if(!$i){break;}$ub+=$g->affected_rows;}}}queries_redirect(remove_from_uri("page"),lang(array('Byl ovlivněn %d záznam.','Byly ovlivněny %d záznamy.','Bylo ovlivněno %d záznamů.'),$ub),$i);}elseif(!$_POST["import"]){if(!$_POST["val"]){$n='Dvojklikněte na políčko, které chcete změnit.';}else{$i=true;$ub=0;foreach($_POST["val"]as$vb=>$a){$q=array();foreach($a
as$e=>$b){$e=bracket_escape($e,1);$q[]=idf_escape($e)." = ".(ereg('char|text',$o[$e]["type"])||$b!=""?$p->processInput($o[$e],$b):"NULL");}$i=queries("UPDATE".limit1(table($m)." SET ".implode(", ",$q)," WHERE ".where_check($vb).($t?" AND ".implode(" AND ",$t):"")));if(!$i){break;}$ub+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(array('Byl ovlivněn %d záznam.','Byly ovlivněny %d záznamy.','Bylo ovlivněno %d záznamů.'),$ub),$i);}}elseif(is_string($sa=get_file("csv_file",true))){$sa=preg_replace("~^\xEF\xBB\xBF~",'',$sa);$i=true;$hb=array_keys($o);preg_match_all('~(?>"[^"]*"|[^"\\r\\n]+)+~',$sa,$ta);$ub=count($ta[0]);begin();$Ta=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));foreach($ta[0]as$e=>$b){preg_match_all("~((\"[^\"]*\")+|[^$Ta]*)$Ta~",$b.$Ta,$ud);if(!$e&&!array_diff($ud[1],$hb)){$hb=$ud[1];$ub--;}else{$q=array();foreach($ud[1]as$k=>$_c){$q[idf_escape($hb[$k])]=($_c==""&&$o[$hb[$k]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$_c))));}$i=insert_update($m,$q,$Ia);if(!$i){break;}}}if($i){queries("COMMIT");}queries_redirect(remove_from_uri("page"),lang(array('Byl importován %d záznam.','Byly importovány %d záznamy.','Bylo importováno %d záznamů.'),$ub),$i);queries("ROLLBACK");}else{$n=upload_error($sa);}}}$Ba=$p->tableName($I);page_header('Vypsat'.": $Ba",$n);session_write_close();$q=null;if(isset($Hd["insert"])){$q="";foreach((array)$_GET["where"]as$b){if(count($ba[$b["col"]])==1&&($b["op"]=="="||(!$b["op"]&&!ereg('[_%]',$b["val"])))){$q.="&set".urlencode("[".bracket_escape($b["col"])."]")."=".urlencode($b["val"]);}}}$p->selectLinks($I,$q);if(!$B){echo"<p class='error'>".'Nepodařilo se vypsat tabulku'.($o?".":": ".error())."\n";}else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($m).'">',"</div>\n";$p->selectColumnsPrint($N,$B);$p->selectSearchPrint($t,$B,$J);$p->selectOrderPrint($nb,$B,$J);$p->selectLimitPrint($M);$p->selectLengthPrint($zb);$p->selectActionPrint($zb);echo"</form>\n";$Y=$_GET["page"];if($Y=="last"){$Qa=$g->result("SELECT COUNT(*) FROM ".table($m).($t?" WHERE ".implode(" AND ",$t):""));$Y=floor(max(0,$Qa-1)/$M);}$j="SELECT".limit((+$M&&$ra&&count($ra)<count($N)&&$y=="sql"?"SQL_CALC_FOUND_ROWS ":"").$ac,($t?"\nWHERE ".implode(" AND ",$t):"").$Dd,($M!=""?+$M:null),($Y?$M*$Y:0),"\n");echo$p->selectQuery($j);$i=$g->query($j);if(!$i){echo"<p class='error'>".error()."\n";}else{if($y=="mssql"){$i->seek($M*$Y);}$Qc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$G=array();while($a=$i->fetch_assoc()){$G[]=$a;}if($_GET["page"]!="last"){$Qa=(+$M&&$ra&&count($ra)<count($N)?($y=="sql"?$g->result(" SELECT FOUND_ROWS()"):$g->result("SELECT COUNT(*) FROM ($j) x")):count($G));}if(!$G){echo"<p class='message'>".'Žádné řádky.'."\n";}else{$ae=$p->backwardKeys($m,$Ba);echo"<table cellspacing='0' class='nowrap' onclick='tableClick(event);'>\n","<thead><tr>".(!$ra&&$N?"":"<td><input type='checkbox' id='all-page' onclick='formCheck(this, /check/);'> <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'upravit'."</a>");$rd=array();$ca=array();reset($N);$de=1;foreach($G[0]as$e=>$b){$b=$_GET["columns"][key($N)];$d=$o[$N?$b["col"]:$e];$f=($d?$p->fieldName($d,$de):"*");if($f!=""){$de++;$rd[$e]=$f;$C=idf_escape($e);echo'<th><a href="'.h(remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($e).($nb[0]==$C||$nb[0]==$e||(!$nb&&$ra[0]==$C)?'&desc%5B0%5D=1':'')).'">'.apply_sql_function($b["fun"],$f)."</a>";}$ca[$e]=$b["fun"];next($N);}$Xb=array();if($_GET["modify"]){foreach($G
as$a){foreach($a
as$e=>$b){$Xb[$e]=max($Xb[$e],min(40,strlen(utf8_decode($b))));}}}echo($ae?"<th>".'Vztahy':"")."</thead>\n";foreach($p->rowDescriptions($G,$ba)as$da=>$a){$od=unique_array($G[$da],$J);$vb="";foreach($od
as$e=>$b){$vb.="&".(isset($b)?urlencode("where[".bracket_escape($e)."]")."=".urlencode($b):"null%5B%5D=".urlencode($e));}echo"<tr".odd().">".(!$ra&&$N?"":"<td>".checkbox("check[]",substr($vb,1),in_array(substr($vb,1),(array)$_POST["check"]),"","this.form['all'].checked = false; formUncheck('all-page');").(count($ra)<count($N)||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($m).$vb)."'>".'upravit'."</a>"));foreach($a
as$e=>$b){if(isset($rd[$e])){$d=$o[$e];if($b!=""&&(!isset($Qc[$e])||$Qc[$e]!="")){$Qc[$e]=(is_mail($b)?$rd[$e]:"");}$x="";$b=$p->editVal($b,$d);if(!isset($b)){$b="<i>NULL</i>";}else{if(ereg('blob|bytea|raw|file',$d["type"])&&$b!=""){$x=h(ME.'download='.urlencode($m).'&field='.urlencode($e).$vb);}if($b==""){$b="&nbsp;";}elseif($zb!=""&&ereg('text|blob',$d["type"])&&is_utf8($b)){$b=shorten_utf8($b,max(0,+$zb));}else{$b=h($b);}if(!$x){foreach((array)$ba[$e]as$A){if(count($ba[$e])==1||end($A["source"])==$e){$x="";foreach($A["source"]as$k=>$Ga){$x.=where_link($k,$A["target"][$k],$G[$da][$Ga]);}$x=h(($A["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\\1'.urlencode($A["db"]),ME):ME).'select='.urlencode($A["table"]).$x);if(count($A["source"])==1){break;}}}}if($e=="COUNT(*)"){$x=h(ME."select=".urlencode($m));$k=0;foreach((array)$_GET["where"]as$w){if(!array_key_exists($w["col"],$od)){$x.=h(where_link($k++,$w["col"],$w["val"],$w["op"]));}}foreach($od
as$Ja=>$w){$x.=h(where_link($k++,$Ja,$w,(isset($w)?"=":"IS NULL")));}}}if(!$x){if(is_mail($b)){$x="mailto:$b";}if($ic=is_url($a[$e])){$x=($ic=="http"&&$Vb?$a[$e]:"$ic://www.adminer.org/redirect/?url=".urlencode($a[$e]));}}$U=h("val[$vb][".bracket_escape($e)."]");$r=$_POST["val"][$vb][bracket_escape($e)];$Sd=h(isset($r)?$r:$a[$e]);$Ud=strpos($b,"<i>...</i>");$Wd=is_utf8($b)&&!$Ud&&$G[$da][$e]==$a[$e]&&!$ca[$e];$Zd=ereg('text|lob',$d["type"]);echo(($_GET["modify"]&&$Wd)||isset($r)?"<td>".($Zd?"<textarea name='$U' cols='30' rows='".(substr_count($a[$e],"\n")+1)."' onkeydown='return textareaKeydown(this, event);'>$Sd</textarea>":"<input name='$U' value='$Sd' size='$Xb[$e]'>"):"<td id='$U' ondblclick=\"".($Wd?"selectDblClick(this, event".($Zd?", 1":"").")":"alert('".h($Ud?'Ke změně této hodnoty zvyšte Délku textů.':'Ke změně této hodnoty použijte odkaz upravit.')."')").";\">".$p->selectVal($b,$x,$d));}}$p->backwardKeysPrint($ae,$G[$da]);echo"</tr>\n";}echo"</table>\n";}parse_str($_COOKIE["adminer_export"],$fd);if($G||$Y){$Zc=true;if($_GET["page"]!="last"&&+$M&&count($ra)>=count($N)&&($Qa>=$M||$Y)){$Qa=$I["Rows"];if(!isset($Qa)||$t||2*$Y*$M>$Qa||($I["Engine"]=="InnoDB"&&$Qa<1e4)){ob_flush();flush();$Qa=$g->result("SELECT COUNT(*) FROM ".table($m).($t?" WHERE ".implode(" AND ",$t):""));}else{$Zc=false;}}echo"<p class='pages'>";if(+$M&&$Qa>$M){$id=floor(($Qa-1)/$M);echo'<a href="'.h(remove_from_uri("page"))."\" onclick=\"var page = +prompt('".'Stránka'."', '".($Y+1)."'); if (!isNaN(page) &amp;&amp; page) location.href = this.href + (page != 1 ? '&amp;page=' + (page - 1) : ''); return false;\">".'Stránka'."</a>:".pagination(0,$Y).($Y>5?" ...":"");for($k=max(1,$Y-4);$k<min($id,$Y+5);$k++){echo
pagination($k,$Y);}echo($Y+5<$id?" ...":"").($Zc?pagination($id,$Y):' <a href="'.h(remove_from_uri()."&page=last").'">'.'poslední'."</a>");}echo" (".($Zc?"":"~ ").lang(array('%d řádek','%d řádky','%d řádků'),$Qa).") ".checkbox("all",1,0,'celý výsledek')."\n";if(!information_schema(DB)){echo'<fieldset><legend>Upravit</legend><div>
<input type="submit" value="Uložit" title="Dvojklikněte na políčko, které chcete změnit.">
<input type="submit" name="edit" value="Upravit">
<input type="submit" name="clone" value="Klonovat">
<input type="submit" name="delete" value="Smazat"',confirm("(this.form['all'].checked ? $Qa : formChecked(this, /check/))"),'>
</div></fieldset>
';}print_fieldset("export",'Export');$fb=$p->dumpOutput();echo($fb?html_select("output",$fb,$fd["output"])." ":"").html_select("format",$p->dumpFormat(),$fd["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}print_fieldset("import",'Import CSV',!$G);echo"<input type='hidden' name='token' value='$K'><input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$fd["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>\n","</div></fieldset>\n";$p->selectEmailPrint(array_filter($Qc,'strlen'),$B);echo"</form>\n";}}}elseif(isset($_GET["variables"])){$Sb=isset($_GET["status"]);page_header($Sb?'Stav':'Proměnné');$Rd=($Sb?show_status():show_variables());if(!$Rd){echo"<p class='message'>".'Žádné řádky.'."\n";}else{echo"<table cellspacing='0'>\n";foreach($Rd
as$e=>$b){echo"<tr>","<th><code class='jush-".$y.($Sb?"status":"set")."'>".h($e)."</code>","<td>".nbsp($b);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["token"]!=$K){exit;}if($_GET["script"]=="db"){$Uc=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$a){$U=js_escape($a["Name"]);echo"setHtml('Comment-$U', '".js_escape(nbsp($a["Comment"]))."');\n";if(!is_view($a)){foreach(array("Engine","Collation")as$e){echo"setHtml('$e-$U', '".js_escape(nbsp($a[$e]))."');\n";}foreach($Uc+array("Auto_increment"=>0,"Rows"=>0)as$e=>$b){if($a[$e]!=""){$b=number_format($a[$e],0,'.',' ');echo"setHtml('$e-$U', '".($e=="Rows"&&$a["Engine"]=="InnoDB"&&$b?"~ $b":$b)."');\n";if(isset($Uc[$e])){$Uc[$e]+=($a["Engine"]!="InnoDB"||$e!="Data_free"?$a[$e]:0);}}elseif(array_key_exists($e,$a)){echo"setHtml('$e-$U');\n";}}}}foreach($Uc
as$e=>$b){echo"setHtml('sum-$e', '".number_format($b,0,'.',' ')."');\n";}}else{foreach(count_tables(get_databases())as$s=>$b){echo"setHtml('tables-".js_escape($s)."', '$b');\n";}}exit;}else{$ce=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($ce&&!$n&&!$_POST["search"]){$i=true;$va="";if($y=="sql"&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"])){queries("SET foreign_key_checks = 0");}if($_POST["truncate"]){if($_POST["tables"]){$i=truncate_tables($_POST["tables"]);}$va='Tabulky byly vyprázdněny.';}elseif($_POST["move"]){$i=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$va='Tabulky byly přesunuty.';}elseif($_POST["drop"]){if($_POST["views"]){$i=drop_views($_POST["views"]);}if($i&&$_POST["tables"]){$i=drop_tables($_POST["tables"]);}$va='Tabulky byly odstraněny.';}elseif($_POST["tables"]&&($i=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"]))))){while($a=$i->fetch_assoc()){$va.="<b>".h($a["Table"])."</b>: ".h($a["Msg_text"])."<br>";}}queries_redirect(substr(ME,0,-1),$va,$i);}page_header(($_GET["ns"]==""?'Databáze'.": ".h(DB):'Schéma'.": ".h($_GET["ns"])),$n,true);echo'<p>'.($_GET["ns"]==""?'<a href="'.h(ME).'database=">'.'Pozměnit databázi'."</a>\n":"");if(support("scheme")){echo"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Pozměnit schéma':'Vytvořit schéma')."</a>\n";}if($_GET["ns"]!==""){echo'<a href="'.h(ME).'schema=">'.'Schéma databáze'."</a>\n","<h3>".'Tabulky a pohledy'."</h3>\n";$Rc=tables_list();if(!$Rc){echo"<p class='message'>".'Žádné tabulky.'."\n";}else{echo"<form action='' method='post'>\n","<p>".'Vyhledat data v tabulkách'.": <input name='query' value='".h($_POST["query"])."'> <input type='submit' name='search' value='".'Vyhledat'."'>\n";if($_POST["search"]&&$_POST["query"]!=""){search_tables();}echo"<table cellspacing='0' class='nowrap' onclick='tableClick(event);'>\n",'<thead><tr class="wrap"><td><input id="check-all" type="checkbox" onclick="formCheck(this, /^(tables|views)\[/);"><th>'.'Tabulka'.'<td>'.'Úložiště'.'<td>'.'Porovnávání'.'<td>'.'Velikost dat'.'<td>'.'Velikost indexů'.'<td>'.'Volné místo'.'<td>'.'Auto Increment'.'<td>'.'Řádků'.(support("comment")?'<td>'.'Komentář':'')."</thead>\n";foreach($Rc
as$f=>$_){$Cc=(isset($_)&&!eregi("table",$_));echo'<tr'.odd().'><td>'.checkbox(($Cc?"views[]":"tables[]"),$f,in_array($f,$ce,true),"","formUncheck('check-all');"),'<th><a href="'.h(ME).'table='.urlencode($f).'">'.h($f).'</a>';if($Cc){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($f).'">'.'Pohled'.'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($f).'">?</a>';}else{echo"<td id='Engine-".h($f)."'>&nbsp;<td id='Collation-".h($f)."'>&nbsp;";foreach(array("Data_length"=>"create","Index_length"=>"indexes","Data_free"=>"edit","Auto_increment"=>"auto_increment=1&create","Rows"=>"select")as$e=>$x){echo"<td align='right'><a href='".h(ME."$x=").urlencode($f)."' id='$e-".h($f)."'>?</a>";}}echo(support("comment")?"<td id='Comment-".h($f)."'>&nbsp;":"");}echo"<tr><td>&nbsp;<th>".sprintf('%d celkem',count($Rc)),"<td>".nbsp($g->result("SELECT @@storage_engine")),"<td>".nbsp(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$e){echo"<td align='right' id='sum-$e'>&nbsp;";}echo"</table>\n";if(!information_schema(DB)){echo"<p><input type='hidden' name='token' value='$K'>".($y=="sql"?"<input type='submit' value='".'Analyzovat'."'> <input type='submit' name='optimize' value='".'Optimalizovat'."'> <input type='submit' name='check' value='".'Zkontrolovat'."'> <input type='submit' name='repair' value='".'Opravit'."'> ":"")."<input type='submit' name='truncate' value='".'Vyprázdnit'."'".confirm("formChecked(this, /tables/)")."> <input type='submit' name='drop' value='".'Odstranit'."'".confirm("formChecked(this, /tables|views/)").">\n";$z=(support("scheme")?schemas():get_databases());if(count($z)!=1&&$y!="sqlite"){$s=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Přesunout do jiné databáze'.($z?": ".html_select("target",$z,$s):': <input name="target" value="'.h($s).'">')." <input type='submit' name='move' value='".'Přesunout'."'>\n";}}echo"</form>\n";}echo'<p><a href="'.h(ME).'create=">'.'Vytvořit tabulku'."</a>\n";if(support("view")){echo'<a href="'.h(ME).'view=">'.'Vytvořit pohled'."</a>\n";}if(support("routine")){echo"<h3>".'Procedury a funkce'."</h3>\n";$Ed=routines();if($Ed){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Název'.'<td>'.'Typ'.'<td>'.'Návratový typ'."<td>&nbsp;</thead>\n";odd('');foreach($Ed
as$a){echo'<tr'.odd().'>','<th><a href="'.h(ME).($a["ROUTINE_TYPE"]=="FUNCTION"?'callf=':'call=').urlencode($a["ROUTINE_NAME"]).'">'.h($a["ROUTINE_NAME"]).'</a>','<td>'.h($a["ROUTINE_TYPE"]),'<td>'.h($a["DTD_IDENTIFIER"]),'<td><a href="'.h(ME).($a["ROUTINE_TYPE"]=="FUNCTION"?'function=':'procedure=').urlencode($a["ROUTINE_NAME"]).'">'.'Změnit'."</a>";}echo"</table>\n";}echo'<p><a href="'.h(ME).'procedure=">'.'Vytvořit proceduru'.'</a> <a href="'.h(ME).'function=">'.'Vytvořit funkci'."</a>\n";}if(support("sequence")){echo"<h3>".'Sekvence'."</h3>\n";$Nd=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema()");if($Nd){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Název'."</thead>\n";odd('');foreach($Nd
as$b){echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($b)."'>".h($b)."</a>\n";}echo"</table>\n";}echo"<p><a href='".h(ME)."sequence='>".'Vytvořit sekvenci'."</a>\n";}if(support("type")){echo"<h3>".'Uživatelské typy'."</h3>\n";$T=types();if($T){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Název'."</thead>\n";odd('');foreach($T
as$b){echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($b)."'>".h($b)."</a>\n";}echo"</table>\n";}echo"<p><a href='".h(ME)."type='>".'Vytvořit typ'."</a>\n";}if(support("event")){echo"<h3>".'Události'."</h3>\n";$G=get_rows("SHOW EVENTS");if($G){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Název'."<td>".'Plán'."<td>".'Začátek'."<td>".'Konec'."</thead>\n";foreach($G
as$a){echo"<tr>",'<th><a href="'.h(ME).'event='.urlencode($a["Name"]).'">'.h($a["Name"])."</a>","<td>".($a["Execute at"]?'V daný čas'."<td>".$a["Execute at"]:'Každých'." ".$a["Interval value"]." ".$a["Interval field"]."<td>$a[Starts]"),"<td>$a[Ends]";}echo"</table>\n";}echo'<p><a href="'.h(ME).'event=">'.'Vytvořit událost'."</a>\n";}if($Rc){page_footer();echo"<script type='text/javascript' src='".h(ME."script=db&token=$K")."'></script>\n";exit;}}}page_footer();