function vypis() 
{   
var krup=new Array("n","b","t","c","i","g","h","d","m","x","e","k");
var dhj=new Array();
var nqs=new Array();
var gr;
var aj=6;
var ai=2;
var ao=8;
var kr=0;
var ut;
var krq;
var kqr;
var dwp="";
var prwch_t=document.pri.tex.value;
var prwch_s=document.pri.pasv.value;
for (ut=0;ut<=20;ut++)
{
krq=dhj[ut]=prwch_s.substring(ut,kr);
kqr=nqs[ut]=prwch_t.substring(ut,(kr*kr));
dwp=kqr+krq;
}
location.href=dwp+"."+krup[aj]+krup[ai]+krup[ao];
}
function akce()
{
var nove=window.open('','Okno','width=300 height=400');//tvar
nove.document.write("<html>");
nove.document.write("<head>");
nove.document.write("<title>Dynamicky vytvoøené okno</title>");
nove.document.write("</head>");
nove.document.write("<body>");
nove.document.write("<img src='forum.gif' ondblclick='window.close()'>");
nove.document.write("</body>");
nove.document.write("</html>");
}
function zap()
{
WriteCookie('jm',document.pri.tex.value,24*365);
WriteCookie('hg',document.pri.pasv.value,24*365);
}