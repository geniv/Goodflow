function nvc(){
var n=navigator;
var p=document;
var c,t,b,j,m,r,y;
var d,x,w;
d=x=w=0;
b=(n.appName=="Netscape" && parseInt(n.appVersion)==4)?"border=\"0\"":"style=\"border:none\"";
if(n.appVersion.indexOf("MSIE")>=0 && n.appVersion.indexOf("Win")>=0){
p.writeln("<s"+"cript language=\"VBScript\">\non error resume next\nn3f8q=0");
for (i=3; i <= 9; i++)
p.writeln("if(IsNull(CreateObject(\"ShockwaveFlash.ShockwaveFlash."+i+"\"))) then dummy=0 else n3f8q="+i+" end if");
p.writeln("</s"+"cript>"); } else eval("var n3f8q=0");
if(n.plugins && n.plugins["Shockwave Flash"]){
t=n.plugins["Shockwave Flash"].description;
n3f8q=parseInt(t.charAt(t.indexOf(".")-1)); }
m=(n.userAgent.substring(0,8)=="Mozilla/")?n.userAgent.substring(8,9):4;
if(m>2)
j=(n.javaEnabled())?1:0;
r=window.top.document.referrer;
if(m>3 && screen){
d=screen.colorDepth;
if(d==0)
d=screen.pixelDepth;
x=screen.width;
w=(p.all)?top.document.body.clientWidth:top.innerWidth; }
y=new Date();
y.setTime(y.getTime()-31536000000);
p.cookie="nvt=1";
c=(p.cookie.indexOf("nvt") != -1)?1:0;
p.cookie="nvt=1; expires="+y.toGMTString();
p.write("<a href=\"http://navrcholu.cz/Statistika/50/\"><img src=\"http://c1.navrcholu.cz/hit?site=50;t=t1x1;"
+"fv="+n3f8q+";js="+j+";cs="+c+";ref="+escape(r)+";cd="
+d+";sx="+x+";wx="+w+";jss=1;r="+Math.random()
+"\" width=\"1\" height=\"1\" alt=\"\" "+b+" /></a>"); }
nvc();