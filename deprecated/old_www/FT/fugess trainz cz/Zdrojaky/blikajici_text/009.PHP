<b>Blikající text</b>
		<br><br>


<table width="400" cellpadding="10" cellspacing="0" border="0" style="border: #ffcc66 1px solid">
	 <tr>
	  <td>
<p align="left">&lt;SCRIPT><br>
var textfont="Verdana"<br>
var textsize=12<br>
var textcolor="FF0000"<br>
<br>
var msg=new Array()<br>
msg[0]="HELLO STRANGER!"<br>
msg[1]="STILL GOING STRONG?"<br>
msg[2]="CAN YOU SMELL SPRING?"<br>
msg[3]="BE HAPPY DO NOT WORRY."<br>
<br>
var maxloop=50<br>
var step=20<br>
var timer<br>
var msglength=msg[0].length-1<br>
var i_mes=0<br>
var loopcounter=0<br>
var xpos=new Array()<br>
var ypos=new Array()<br>
<br>
for (i=0; i&lt;=msg.length-1;i++) {<br>
    msg[i]=msg[i]+" "<br>
}<br>
<br>
for (i=1; i&lt;=msg.length-1;i++) {<br>
    if(msg[i].length-1 >= msg[i-1].length-1) {msglength=msg[i].length-1}<br>
}<br>
<br>
for (i=0; i&lt;=msglength-1;i++) {<br>
    xpos[i]=-50<br>
	ypos[i]=-50<br>
}<br>
<br>
if (document.layers) {<br>
	if (textsize>25) {textsize=6}<br>
	else if (textsize>20) {textsize=5}<br>
	else if (textsize>14) {textsize=4}&nbsp;<br>
	else if (textsize>10) {textsize=3}<br>
	else if (textsize>8) {textsize=2}<br>
	else if (textsize&lt;=7) {textsize=1}<br>
}<br>
<br>
function init() {<br>
	if (loopcounter&lt;=maxloop) {<br>
		for (i=message.length-1; i>=1; i--) {<br>
   			xpos[i]=xpos[i-1]+step<br>
			ypos[i]=ypos[i-1]<br>
    	}<br>
		xpos[0]=220<br>
		ypos[0]=50<br>
		if (document.all) {<br>
			for (i=0; i&lt;message.length-1; i++) {<br>
    			var thisspan = eval("document.all.span"+(i)+".style")<br>
    			thisspan.posLeft=xpos[i]<br>
				thisspan.posTop=ypos[i]<br>
                                        thisspan.color=Math.random()*255*255*255+Math.random()*255*255+Math.random()*255<br>
    		}<br>
		}<br>
		if (document.layers) {<br>
			for (i=0; i&lt;message.length-1; i++) {<br>
    			var thisspan = eval("document.span"+i)<br>
    			thisspan.left=xpos[i]<br>
				thisspan.top=ypos[i]<br>
    		}<br>
		}<br>
		loopcounter++<br>
		timer=setTimeout("init()",20)<br>
	}<br>
	else {<br>
		clearTimeout(timer)<br>
		clearmessage()<br>
	}<br>
}<br>
<br>
function clearmessage() {<br>
		loopcounter=0<br>
		if (document.all) {<br>
			for (i=0;i&lt;=msglength;i++) {&nbsp;<br>
				var thisspan = eval("document.all.span"+i)<br>
    			thisspan.innerHTML=" "<br>
				var thisspan = eval("document.all.span"+(i)+".style")<br>
                thisspan.posLeft=-5000&nbsp;<br>
			}<br>
		}<br>
		if (document.layers) {<br>
			for (i=0;i&lt;=msglength;i++) {<br>
				var thisspan = eval("document.span"+i)<br>
                thisspan.left=-5000<br>
<br>
			}<br>
		}<br>
		changemessage()<br>
}<br>
<br>
function changemessage() {<br>
		var messa=msg[i_mes]<br>
		message=messa.split("")<br>
		if (document.all) {<br>
			for (i=0;i&lt;=message.length-1;i++) {<br>
				var thisspan = eval("document.all.span"+i)<br>
    			thisspan.innerHTML="&lt;p style='font-family:"+textfont+";font-size:"+textsize+";'>"+message[i]+"&lt;/p>"<br>
			}<br>
		}<br>
		if (document.layers) {<br>
			for (i=0; i&lt;message.length-1; i++) {<br>
    			var thisspan=eval("document.span"+i+".document")<br>
    			thisspan.write("&lt;p>&lt;font size="+textsize+" color="+textcolor+" face="+textfont+">"+message[i]+"&lt;/font>&lt;/p>")<br>
				thisspan.clear()<br>
    		}<br>
		}<br>
		i_mes++&nbsp;<br>
		if (i_mes>=msg.length) {i_mes=0}<br>
		timer=setTimeout("init()",50)<br>
}<br>
<br>
// - End of JavaScript - --><br>
&lt;/SCRIPT><br>
<br>
&lt;STYLE>.spanstyle {<br>
	LEFT: -5000px; POSITION: absolute<br>
}<br>
&lt;/STYLE><br>
<br>
&lt;META content="MSHTML 5.50.4134.600" name=GENERATOR>&lt;/HEAD><br>
&lt;BODY bgColor=black onload=clearmessage()><br>
&lt;SCRIPT><br>
&lt;!-- Beginning of JavaScript -<br>
<br>
for (i=0;i&lt;=msglength;i++) {<br>
    document.write("&lt;span id='span"+i+"' class='spanstyle'>")<br>
    document.write("&lt;/span>")<br>
}<br>
<br>
// - End of JavaScript - --><br>
&lt;/SCRIPT></p>

	  </td>
     </tr>
	 </table> 