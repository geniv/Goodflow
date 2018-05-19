// StopIE6 namespace
var StopIE6 = {};
// STOPIE6 usage mode:  TOLERANT (warn users but keep them on your site)  | NOMERCY (warn users and redirect to stopie6.org)
StopIE6.mode = 'nomercy';
StopIE6.iframe = document.createElement('iframe');
StopIE6.overlay = document.createElement('div');  
StopIE6.div = document.createElement('div');  
StopIE6.clientWidth = document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth;
StopIE6.clientHeight = document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight;
// iframe shim for hiding <SELECT> and objects (as found on   http://www.macridesweb.com/oltest/IframeShim.html )
StopIE6.iframe.id = (new Date().getTime()) + '_shim';
StopIE6.iframe.src = 'javascript:void(0);';
StopIE6.iframe.frameBorder = '0';
StopIE6.iframe.scrolling = 'no';
StopIE6.iframe.style.filter='progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)';
StopIE6.iframe.style.position = 'absolute';
StopIE6.iframe.style.top = '0';
StopIE6.iframe.style.left = '0';
StopIE6.iframe.style.zIndex = '1000';
StopIE6.iframe.style.width = StopIE6.clientWidth;
StopIE6.iframe.style.height = StopIE6.clientHeight;
// black overlay
StopIE6.overlay.id = (new Date().getTime()) + '_overlay';
StopIE6.overlay.style.position = 'absolute'; 
StopIE6.overlay.style.width = StopIE6.clientWidth;
StopIE6.overlay.style.height = StopIE6.clientHeight;
StopIE6.overlay.style.zIndex = '1001';
StopIE6.overlay.style.backgroundColor = '#000000'; 
// warning div
StopIE6.div.style.position = 'absolute';
StopIE6.div.style.width = '300';
StopIE6.div.style.height = '205';
StopIE6.div.style.backgroundColor = '#eeeeee';
StopIE6.div.style.color = '#444444';
StopIE6.div.style.padding = '4px 10px';
StopIE6.div.style.top = (StopIE6.clientHeight - 205) / 2;
StopIE6.div.style.left = (StopIE6.clientWidth - 320) / 2;
StopIE6.div.innerHTML = '<div style="position: absolute; top: 1px; left: 301px; padding: 2px 5px; background-color: #eee; font: bold 12px Verdana,Arial,Helvetica,sans-serif"><a href="./" onclick="StopIE6.close(); return false" title="close">X</a></div><p style="border-left: 1px solid #bbb; border-right: 1px solid #bbb; padding: 0 5px; font: 12px Verdana,Arial,Helvetica,sans-serif; line-height:150%;">You are running Internet Explorer 6.<br /><br />This is not an up-to-date browser and it may adversely affect your computer security and your browsing experience.<br /><strong>Please upgrade to Internet Explorer 7 or switch to another browser now.</strong><img src="../obr/no-ie-6.png" style="margin: 20px 0 10px 80px" /><br /><span style="font-size: 10px;">Stop IE6 campaign. Read more on <a href="http://www.stopie6.org">www.stopie6.org</a></span></p>';
StopIE6.close = function(){
	StopIE6.div.parentNode.removeChild(StopIE6.div);
	StopIE6.overlay.parentNode.removeChild(StopIE6.overlay);
	StopIE6.iframe.parentNode.removeChild(StopIE6.iframe);
	if (StopIE6.mode != 'tolerant') location.href = './';
};
// inject elements into the body
document.body.insertBefore(StopIE6.iframe, document.body.firstChild);
StopIE6.overlay.appendChild(StopIE6.div);
document.body.insertBefore(StopIE6.overlay, document.body.firstChild.nextSibling);
// emulate the fixed position (as found on  http://www.howtocreate.co.uk/fixedPosition.html )
document.getElementById(StopIE6.overlay.id).style.setExpression("top", "ignoreMe = (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + 'px'");
document.getElementById(StopIE6.overlay.id).style.setExpression("left", "ignoreMe = (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + 'px'");
document.getElementById(StopIE6.iframe.id).style.setExpression("top", "ignoreMe = (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + 'px'");
document.getElementById(StopIE6.iframe.id).style.setExpression("left", "ignoreMe = (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + 'px'");
document.recalc(true);