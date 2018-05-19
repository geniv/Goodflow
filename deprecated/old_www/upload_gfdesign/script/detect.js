//Client engine detection as found on MooTools, My Object Oriented Javascript Tools. Copyright (c) 2006-2007 Valerio Proietti, <http://mad4milk.net>, MIT Style License.
var Client = {
	Engine: {'name': 'unknown', 'version': ''},
	Platform: {},
	Features: {}
};
//Client.Features
Client.Features.xhr = !!(window.XMLHttpRequest);
Client.Features.xpath = !!(document.evaluate);

//Client.Engine
if (window.opera) Client.Engine.name = 'opera';
else if (window.ActiveXObject) Client.Engine = {'name': 'ie', 'version': (Client.Features.xhr) ? 7 : 6};
else if (!navigator.taintEnabled) Client.Engine = {'name': 'webkit', 'version': (Client.Features.xpath) ? 420 : 419};
else if (document.getBoxObjectFor != null) Client.Engine.name = 'gecko';
Client.Engine[Client.Engine.name] = Client.Engine[Client.Engine.name + Client.Engine.version] = true;

//Client.Platform
Client.Platform.name = navigator.platform.match(/(mac)|(win)|(linux)|(nix)/i) || ['Other'];
Client.Platform.name = Client.Platform.name[0].toLowerCase();
Client.Platform[Client.Platform.name] = true;
// end Client detection -------------------------------- //

function injectScript()
{
	var scripts = document.getElementsByTagName('script');
	for (var i=0; i< scripts.length; i++){
		if (scripts[i].src.match(/detect.js/i)) {
			var url = scripts[i].src.replace(/detect.js/i, 'stopie6.js');
			break;
		}		
	}
	var e = document.createElement('script');
	e.src = url;
	e.type= 'text/javascript';
	document.getElementsByTagName('head')[0].appendChild(e);	  
}

onload = function()
{	 
	if (Client.Engine.ie && !Client.Engine.ie7) injectScript();
}