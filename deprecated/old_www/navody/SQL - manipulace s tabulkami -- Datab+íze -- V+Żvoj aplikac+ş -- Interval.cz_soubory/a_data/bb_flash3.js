// @params bb_Redir,bb_Height,bb_Width,bb_Flash,bb_Target,bb_Banner,bb_Wmode,bb_FlashVer,bb_Param,bb_Embed,bb_Object,bb_Swf;
function bb_getFlashVer(){
  var bb_plgv=0,x,axo;
	if(navigator.plugins && navigator.mimeTypes.length){
		var x = navigator.plugins["Shockwave Flash"];
		if(x && x.description) {
			bb_plgv = x.description.replace(/([a-zA-Z]|\s)+/, "").replace(/(\s+r|\s+b[0-9]+)/, ".").split(".")[0];
		}
	}else if(typeof(ActiveXObject)!="undefined") {
		try{
			var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
		}catch(e){
			try {
				var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
				bb_plgv = 6;
			} catch(e) {
			}
			try {
				var axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
			} catch(e) {}
		}
		if (axo != null) {
			bb_plgv = axo.GetVariable("$version").split(" ")[1].split(",")[0];
		}
	}
	return bb_plgv;
}
function bb_Flash3(bb) {
	if(typeof bb != "object") { return; }
	if(typeof bb_flashdetected != "number" || bb_flashdetected<1){
	  var bb_flashdetected=bb_getFlashVer();
	}
	var movie= bb.Swf!='' ? bb.Swf : bb.Flash+'?clickTag='+escape(bb.Redir)+'&clickthru='+escape(bb.Redir)+'&clickTarget='+bb.Target;
	var wmode= bb.Wmode=='' ? 'opaque':bb.Wmode;
	if (bb_flashdetected>=bb.FlashVer) {
	  document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width='+bb.Width+' height='+bb.Height+' '+bb.Object+' ><param name=movie value="'+movie+'"><param name=allowScriptAccess value="always"><param name=wmode value="'+wmode+'">'+bb.Param);
	  document.write('<embed src="'+movie+'" quality=high type="application/x-shockwave-flash" width='+bb.Width+' height='+bb.Height+' wmode="'+wmode+'" '+bb.Embed+' allowScriptAccess="always"></embed>');
	  document.write('</object>');
	} else {
	  document.write("<a href='"+bb.Redir+"' target='"+bb.Target+"'><img src='"+bb.Banner+"' width="+bb.Width+" height="+bb.Height+" border=0 /></a>");
	}
}
if (typeof(_bmad)=="object") {
	for(_bmix in _bmad) {
		if (_bmad[_bmix]==null) { continue; }
		bb_Flash3(_bmad[_bmix]);
		_bmad[_bmix]=null;
	}
}