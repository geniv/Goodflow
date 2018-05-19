EAS_flash = 1;
EAS_proto = "http:";
if (location.protocol == "https:") {
   EAS_proto = "https:";
}
if (document.getElementById) {
   EAS_dom = true;
} else {
   EAS_dom = false;
}

EAS_server = EAS_proto + "//eas.apm.emediate.eu";

function EAS_load(url) {
	document.write('<scr' + 'ipt language="JavaScript" src="' + url + '"></sc' + 'ript>');
}

function EAS_init(pages, parameters) {

	var EAS_ord=new Date().getTime();
	var EAS_url = EAS_server + "/eas?target=_blank&EASformat=jsvars&EAScus=" + pages + "&ord=" + EAS_ord;

	EAS_detect_flash();

	EAS_url += "&EASflash=" + EAS_flash;

	if (parameters) EAS_url += "&" + parameters;

	EAS_load(EAS_url);

	return;
}

function EAS_detect_flash() {

   if (EAS_flash > 1) return;

	var maxVersion = 9;
	var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;
	var isIE = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
	var isWin = (navigator.appVersion.indexOf("Windows") != -1) ? true : false;

	// write vbscript detection if we're not on mac.
	if(isIE && isWin && !isOpera){ 
		document.write('<SCR' + 'IPT LANGUAGE=VBScript\> \n');
		document.write('on error resume next \n');
		for (i = 2; i <= maxVersion; i++) {
			document.write('if(IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash.' + i + '"))) Then EAS_flash='+i+' \n');
		}
		document.write('</SCR' + 'IPT\> \n'); // break up end tag so it doesn't end our script
	} else if (navigator.plugins) {
		if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]){

			var isVersion2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
			var flashDescription = navigator.plugins["Shockwave Flash" + isVersion2].description;
			var flashVersion = parseInt(flashDescription.charAt(flashDescription.indexOf(".") - 1));

			if (flashVersion > 1) EAS_flash = flashVersion;
		}
	}

	// alert("Version is " + EAS_flash);
	
}

function EAS_show_flash(width, height, src, extra) {
   var EAS_args = [];
   if (extra) EAS_args = extra.split(",");

	document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + width + '" height="' + height + '"><param name=src value=' + src + '>');
   for (i = 0; i < EAS_args.length; i++) {
      EAS_eq = EAS_args[i].indexOf('=');
      EAS_nv0 = EAS_args[i].substring(0, EAS_eq );
      EAS_nv1 = EAS_args[i].substring(EAS_eq+1, EAS_args[i].length);
      document.write('<param name="' + EAS_nv0 + '" value="' + EAS_nv1 + '">');
   }
   document.write('<embed src="' + src + '" width="' + width + '" height="' + height + '" type="application/x-shockwave-flash"');
   for (i = 0; i < EAS_args.length; i++) {
      EAS_eq = EAS_args[i].indexOf('=');
      EAS_nv0 = EAS_args[i].substring(0, EAS_eq );
      EAS_nv1 = EAS_args[i].substring(EAS_eq+1, EAS_args[i].length);

      document.write(' ' + EAS_nv0 + '="' + EAS_nv1 + '"');
   }
   document.write('></embed></object>');
}

function EAS_statistics() {

   var t = new Date();
   var EAS_time = t.getTime();

   if (typeof(EAS_cu) == "undefined") return;
   if (EAS_flash == 1) EAS_detect_flash();

   var EAS_stat_tag = EAS_server + '/eas?ty=ct;cu=' + EAS_cu + ';ord=' + EAS_time;
   if (EAS_flash > 2) EAS_stat_tag += ';EASflash=' + EAS_flash;
   if (typeof(EAS_page) != "undefined") EAS_stat_tag += ';sw=' + EAS_page;
   if (typeof(EAS_extra) != "undefined") EAS_stat_tag += ';sw2=' + EAS_extra;
   EAS_stat_tag += ';logrest=width=' + screen.width + ';height=' + screen.height + ';time=' + t.getHours() + ":" + t.getMinutes() + ":" + t.getSeconds();
   if (document.referrer) EAS_stat_tag += ';ref=' + document.referrer;

   document.write('<img width="1" height="1" src="' + EAS_stat_tag + '">');
}


function EAS_duplicate(cu, expires) {
   var cookie_arr = document.cookie.split('; ');
   var nv_arr;
   var cu_arr;
   var duplicate = 0;
   var found_cu = 0;
   var now = Math.round(new Date().getTime() / 1000);
   var new_cookie = "";
   if (cookie_arr.length > 0) {
      for (var i = 0; i < cookie_arr.length; i++) {
         nv_arr = cookie_arr[i].split('=');
         if (nv_arr[0] == 'eas_dup') {
            cu_arr = nv_arr[1].split(':');
            for (var j = 0; j < cu_arr.length; j++) {
               cu_val = cu_arr[j].split('_');
               if (now - cu_val[1] < expires) {
                  if (cu_val[0] == cu) {
                     found_cu = 1;
                     duplicate = 1;
                     break;
                  } else {
                     if (new_cookie) new_cookie += ":";
                     new_cookie += cu_arr[j];
                  }
               }
            }
            break;
         }
      }
   }

   if (!duplicate) {
      if (!found_cu) {
         if (new_cookie) new_cookie += ":";
         new_cookie += cu + "_" + now;
      }
      document.cookie = "eas_dup=" + new_cookie + "; path=/; expires=Mon, 16 Mar, 2020 01:00:00 GMT;";
   }
   if (duplicate) return true;
   return false;
}

function EAS_place_ad(cus) {
   if(!EAS_dom) return;
   var EAS_cu_arr = cus.split(",");
   for (var i = 0; i < EAS_cu_arr.length; i++) {
      var EAS_cu = EAS_cu_arr[i];
      var EAS_temp = "EAS_position_" + EAS_cu;
      var EAS_div_position = document.getElementById(EAS_temp);
      if (EAS_div_position) {
         EAS_temp = "EAS_tag_" + EAS_cu;
         var EAS_div_tag = document.getElementById(EAS_temp);
         if (EAS_div_tag) {
            EAS_div_tag.style.position = "absolute";
            EAS_div_tag.style.top = EAS_div_position.offsetTop + "px";
            EAS_div_tag.style.left = EAS_div_position.offsetLeft + "px";
            EAS_div_tag.style.display = "block";
         } else {
            document.write("<!-- ERROR: Missing tag " + EAS_temp + " -->");
         }
      } else {
         document.write("<!-- ERROR: Missing tag " + EAS_temp + " -->");
      }
   }
}

function EAS_wl_checkElements(_array, _elem) {
   // init
   var cu, res, gotcus = 0;
   var strElem;
   var excl = ",8961,7947,7945,7949,4776,6655,4604,4775,4782,4550,4783,4784,4777,4774,4551,4553,6360,3428,4785,6364,7946,4552,7948,9167,6361,6365,6362,6367,6366,6363,626,3838,3839,";

   // walk through collection
   var coll = document.getElementsByTagName(_elem);
   for (var i=0; i<coll.length; i++) {
      // try to get html code or src attribute
      strElem = coll[i].innerHTML?coll[i].innerHTML:coll[i].src;
      if (strElem != '') {
         // search for content unit id in result
         res = strElem.match(/eas\?.*cu=([0-9]+)[;&:]/);
         if (res && res[1]) {
            cu = parseInt(res[1]);
            if (cu > 0) {
               // check exclusion
               if (excl.indexOf(","+cu+",") < 0) {
                  _array.push(cu);
                  gotcus = 1;
               }
            }
         }
      }
   }

   return gotcus;
}

function EAS_wl_tracking() {
   if(!EAS_dom) return;

   // check browser language
   var isDE = -1;
   if (navigator.browserLanguage) {
      isDE = (navigator.browserLanguage.indexOf("de"));
   } else if (navigator.language) {
      isDE = (navigator.language.indexOf("de"));
   }
   if (isDE != 0) return;

   //var a = Math.floor(Math.random()*100);
   //if (a > 100) return;

   var mycus = new Array();
   var gotcus = 0;
   var wl_url = 'http://wltr.apm.emediate.eu/Cnt/adpepper/CP/';

   // check different kinds of elelemts
   gotcus += EAS_wl_checkElements(mycus, "iframe");
   gotcus += EAS_wl_checkElements(mycus, "script");

   // now create pixel request for each cu we got
   if (gotcus) {
      var pixurl, cu, rnd;
      for (var i=0; i<mycus.length; i++) {
         // create tracking pixel request
         cu = mycus[i];
         rnd = Math.floor(Math.random()*99999999999);
         pixurl = wl_url + cu + '?ord=' + rnd;

         // create & append invisible image tag
         var img = document.createElement("img");
         img.setAttribute("width", 0);
         img.setAttribute("height", 0);
         img.setAttribute("src", pixurl);
         document.body.appendChild(img);

         // only the 1st of all found cus!
         break;
      }
   }
}

if (window.addEventListener){
  window.addEventListener('load', EAS_wl_tracking, false);
} else if (window.attachEvent){
  window.attachEvent('onload', EAS_wl_tracking);
}

