var bmone2n={positions: 		new Object(),adRepository:	new Object(),oldErrHandler:  null,blockErrors: function(){if(typeof _bbdebug=="undefined"){if(! this.oldErrHandler)this.oldErrHandler=window.onerror;window.onerror=this.failGracefully;}},unblockErrors: function(){if(typeof _bbdebug=="undefined"){window.onerror=this.oldErrHandler;}},failGracefully: function(){return true;},getRefTo:function(objID,dc){var objRef=null;if(!dc)dc=document;if(dc.getElementById && dc.getElementById(objID)!=null)objRef=dc.getElementById(objID);else if(dc.layers && dc.layers[objID]!=null)objRef=dc.layers[objID];else if(dc.all)objRef=dc.all[objID];return objRef;},addPosition:function(posID,codeParams,objIDsSuccess,objStylesSuccess,objIDsFail,objStylesFail,callback){this.blockErrors();var target=this.getRefTo("bmone2n-"+posID);if(target &&(target.style.visibility.toUpperCase()!="HIDDEN")&&(target.style.display.toUpperCase()!="NONE")){this.positions[posID]=new Object();this.positions[posID]["codeParams"]=typeof(codeParams)!="string" ? "" : codeParams;this.positions[posID]["objIDsS"]=objIDsSuccess=="this" || objIDsSuccess=="" ? "bmone2n-"+posID : objIDsSuccess;this.positions[posID]["objStylesS"]=objStylesSuccess;this.positions[posID]["objIDsF"]=objIDsFail=="this" || objIDsFail=="" ? "bmone2n-"+posID : objIDsFail;this.positions[posID]["objStylesF"]=objStylesFail;this.positions[posID]["callback"]=callback;}this.unblockErrors();},addAd:function(posID,adCode,beacon){this.blockErrors();this.adRepository[posID]=new Object();this.adRepository[posID]["adCode"]=adCode;this.adRepository[posID]["beacon"]=beacon ? true : false;this.unblockErrors();},makeAd:function(posID){this.blockErrors();var target,source,beaconCode="";var tomove=true;if(this.adRepository[posID]&& this.adRepository[posID]["adCode"]){if(this.adRepository[posID]["beacon"]){beaconCode="BBMEDIA ONE2MANY WARNING: INVISIBLE BEACON CODE TO BE PLACED HERE. IF YOU SEE THIS MESSAGE IT IS WRONG!";}var tmpstr=this.adRepository[posID]["adCode"].toUpperCase();target=this.getRefTo("bmone2n-"+posID);if(tmpstr.indexOf("<SC")!=-1  ||  tmpstr.indexOf("SCRIPT")!=-1){document.write(this.adRepository[posID]["adCode"]+beaconCode);if(tomove)this.adRepository[posID]["tomove"]=true;}else{target=this.getRefTo("bmone2n-"+posID);if(target){target.innerHTML=this.adRepository[posID]["adCode"]+beaconCode;if(typeof this.positions[posID]["callback"]!="function"){this.changeStyles(posID,true);}else{this.positions[posID]["callback"](posID,true);}}}if(target && !target.outerHTML){this.move1Ad(posID);}}else{if(typeof this.positions[posID]["callback"]!="function"){this.changeStyles(posID,false);}else{this.positions[posID]["callback"](posID,false);}}this.unblockErrors();},move1Ad:function(posID){var spp;var child=null;var sibling=null;if(this.adRepository[posID]["tomove"]){var target=this.getRefTo("bmone2n-"+posID);if(target){var source=this.getRefTo("bmone2t-"+posID);if(source){source.style.display='block';if(source.outerHTML){childs=source.childNodes.length;if(source.childNodes.length){child=source.childNodes[0];}while(child){sibling=child.nextSibling;if(child.nodeName &&(child.nodeName.toUpperCase()!="SCRIPT")){target.insertBefore(child,null);}child=sibling;}}else{target.insertBefore(source,null);}if(typeof this.positions[posID]["callback"]!="function"){this.changeStyles(posID,true);}else{this.positions[posID]["callback"](posID,true);}}}this.adRepository[posID]["tomove"]=false;}},moveAd:  function(){this.blockErrors();var that=this;for(var posID in this.adRepository){this.move1Ad(posID);}this.unblockErrors();},getMoveAdCall:  function(posID){that=this;return function(){that.move1Ad(posID);}},getAd:function(adDomain,keywords,xtraprms){this.blockErrors();var one2n=0;var one2nparams='';for(var posID in this.positions){one2n++;one2nparams+="&one2n"+one2n+"=/"+posID.replace(/\./g,'/')+"/;"+posID+";"+escape(this.positions[posID]["codeParams"]);}if(one2n>0){one2nparams+="&one2n="+one2n;var bbs=screen,bbn=navigator,bbh;bbh='&ubl='+bbn.browserLanguage+'&ucc='+bbn.cpuClass+'&ucd='+bbs.colorDepth+'&uce='+bbn.cookieEnabled+'&udx='+bbs.deviceXDPI+'&udy='+bbs.deviceYDPI+'&usl='+bbn.systemLanguage+'&uje='+bbn.javaEnabled()+'&uah='+bbs.availHeight+'&uaw='+bbs.availWidth+'&ubd='+bbs.bufferDepth+'&uhe='+bbs.height+'&ulx='+bbs.logicalXDPI+'&uly='+bbs.logicalYDPI+'&use='+bbs.fontSmoothingEnabled+'&uto='+(new Date()).getTimezoneOffset()+'&uti='+(new Date()).getTime()+'&uui='+bbs.updateInterval+'&uul='+bbn.userLanguage+'&uwi='+bbs.width;bbh=one2nparams+bbh;if(typeof keywords=="string" && keywords!="")bbh+="&keywords="+escape(keywords);if(typeof xtraprms=="string" && xtraprms!="")bbh+=xtraprms;var locPro=(location.protocol.substring(0,2)!='ht')? 'http:' : location.protocol;document.write("<scr"+"ipt language='JavaScript' type='text/javascript' charset='windows-1250' src="+locPro+"//"+adDomain+"/please/showit/0/0/0/1/?typkodu=js"+bbh+"&alttext=0&border=0&bust="+Math.random()+"&target=_top'><"+"\/scr"+"ipt>");}this.unblockErrors();},changeStyles:function(posID,success){this.blockErrors();finalL=success ? "S" : "F";var lastStyle="",eqSign,semiSign,styleValue,styleProperty;if(typeof(this.positions[posID])!="undefined" && this.positions[posID]["objIDs"+finalL]){var arr_posIDs=(this.positions[posID]["objIDs"+finalL]).split(",");var arr_Styles=(this.positions[posID]["objStyles"+finalL]).split(",");for(var i in arr_posIDs){if(!arr_Styles[i]){if(lastStyle){arr_Styles[i]=lastStyle;}else{return;}}var myStyle=arr_Styles[i];lastStyle=myStyle;var toChange=this.getRefTo(arr_posIDs[i]);if(toChange){if(myStyle.indexOf('class=')==0){toChange.className=myStyle.substr(6);}else{while(myStyle){eqSign=myStyle.indexOf(":");if(eqSign==-1)return;semiSign=myStyle.indexOf(";");if(semiSign==-1)semiSign=myStyle.length;styleProperty=myStyle.substr(0,eqSign);styleValue=myStyle.substr(eqSign+1,semiSign-eqSign-1);toChange.style[styleProperty]=styleValue;myStyle=myStyle.substr(semiSign+1);}}}}}this.unblockErrors();},rotateAd:function(groupDefs){if(typeof bb_rotation=="function"){bb_rotation(groupDefs);}else{for(var i=0;i<groupDefs.length;i++){if(groupDefs[i].gId !=0 && groupDefs[i].poss.length>1){for(var j=0;j<groupDefs[i].poss.length-1;j++){sourceIdx=Math.floor(Math.random()*groupDefs[i].poss.length);destIdx=Math.floor(Math.random()*groupDefs[i].poss.length);if(sourceIdx !=destIdx){source=document.getElementById("bmone2n-"+groupDefs[i].poss[sourceIdx]);dest=document.getElementById("bmone2n-"+groupDefs[i].poss[destIdx]);if(source && dest){sourcePar=source.parentNode;destPar=dest.parentNode;ns=source.nextSibling;replaced=destPar.replaceChild(source,dest);sourcePar.insertBefore(replaced,ns);}}}}}}},iniDivRotation:      function(rotationInfo){var groups=new Object();var groupDefs=[];var positionPairs=rotationInfo.split(";");for(var i=0;i<positionPairs.length;i++){groupInfo=positionPairs[i].split("#");groupId="grp"+groupInfo[1];if(typeof groups[groupId]!="undefined"){groups[groupId].push(groupInfo[0]);}else{groups[groupId]=[groupInfo[0]];}}for(group in groups){gid=group.substr(3);groupDefs.push({gId: gid,poss: groups[group]});}this.rotateAd(groupDefs);},contentLoadedFunctions:[],contentLoaded: false,runContentLoadedFunctions: function(){this.contentLoaded=true;for(var i=0;i<this.contentLoadedFunctions.length;i++){this.contentLoadedFunctions[i]();}},initContentLoaded: function(){var that=this;var eventAttached=false;if(document.addEventListener){document.addEventListener("DOMContentLoaded",function(){that.runContentLoadedFunctions();},false);eventAttached=true;}if(document.getElementById){var deferScript=document.getElementById('__init_script');if(deferScript){deferScript.onreadystatechange=function(){if(this.readyState=='complete'){that.runContentLoadedFunctions();}};eventAttached=true;deferScript.onreadystatechange();deferScript=null;}}if(!eventAttached){oldOnload=window.onload;window.onload=function(){that.runContentLoadedFunctions();if(oldOnload)oldOnload();}}},runWhenContentLoaded: function(callback){if(this.contentLoaded){callback();}else{this.contentLoadedFunctions.push(callback);}}};