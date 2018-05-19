var ref;
if (document.referrer){
	ref = escape(document.referrer);
	if(ref.indexOf("interval.cz") > -1 ) ref="http://internal.interval.cz";
	if(ref.indexOf("interval.inshop.cz") > -1 ) ref="http://inshop.interval.cz";
	if(ref.indexOf("interforum.interval.cz") > -1 ) ref="http://interforum.interval.cz";
	if(ref.indexOf("bezpecnost.interval.cz") > -1 ) ref="http://bezpecnost.interval.cz";
	if(ref.indexOf("css.interval.cz") > -1 ) ref="http://css.interval.cz";
	if(ref.indexOf("jednoduse.interval.cz") > -1 ) ref="http://jednoduse.interval.cz";
	if(ref.indexOf("php.interval.cz") > -1 ) ref="http://php.interval.cz";

	if(ref.indexOf("jaknaweb.com") > -1 ) ref="http://jaknaweb.com";
	if(ref.indexOf("jakpsatweb.cz") > -1 ) ref="http://jakpsatweb.cz";
}
else 
	ref = "http://nonexistent.interval.cz";

var topId = "105440";
var topSrc = "http://www.toplist.cz/dot.asp";
topSrc += "?id=" + topId; 
topSrc += "&http=" + ref;
topSrc += "&r=" + Math.random();

var topImg = new Image();
topImg.src = topSrc;