(function(a){a.jGrowl=function(b,c){if(a("#jGrowl").size()==0){a('<div id="jGrowl"></div>').addClass((c&&c.position)?c.position:a.jGrowl.defaults.position).appendTo("body")}a("#jGrowl").jGrowl(b,c)};a.fn.jGrowl=function(b,d){if(a.isFunction(this.each)){var c=arguments;return this.each(function(){var e=this;if(a(this).data("jGrowl.instance")==undefined){a(this).data("jGrowl.instance",a.extend(new a.fn.jGrowl(),{notifications:[],element:null,interval:null}));a(this).data("jGrowl.instance").startup(this)}if(a.isFunction(a(this).data("jGrowl.instance")[b])){a(this).data("jGrowl.instance")[b].apply(a(this).data("jGrowl.instance"),a.makeArray(c).slice(1))}else{a(this).data("jGrowl.instance").create(b,d)}})}};a.extend(a.fn.jGrowl.prototype,{defaults:{pool:0,header:"",group:"",sticky:false,position:"top-right",glue:"after",theme:"default",themeState:"highlight",corners:"10px",check:250,life:3000,closeDuration:"normal",openDuration:"normal",easing:"swing",closer:true,closeTemplate:"&times;",closerTemplate:"<div>[ Zavřít vše ]</div>",log:function(c,b,d){},beforeOpen:function(c,b,d){},afterOpen:function(c,b,d){},open:function(c,b,d){},beforeClose:function(c,b,d){},close:function(c,b,d){},animateOpen:{opacity:"show"},animateClose:{opacity:"hide"}},notifications:[],element:null,interval:null,create:function(b,c){var c=a.extend({},this.defaults,c);if(typeof c.speed!=="undefined"){c.openDuration=c.speed;c.closeDuration=c.speed}this.notifications.push({message:b,options:c});c.log.apply(this.element,[this.element,b,c])},render:function(d){var b=this;var c=d.message;var e=d.options;e.themeState=(e.themeState=="")?"":"ui-state-"+e.themeState;var d=a('<div class="jGrowl-notification '+e.themeState+" ui-corner-all"+((e.group!=undefined&&e.group!="")?" "+e.group:"")+'"><div class="jGrowl-close">'+e.closeTemplate+'</div><div class="jGrowl-header">'+e.header+'</div><div class="jGrowl-message">'+c+"</div></div>").data("jGrowl",e).addClass(e.theme).children("div.jGrowl-close").bind("click.jGrowl",function(){a(this).parent().trigger("jGrowl.close")}).parent();a(d).bind("mouseover.jGrowl",function(){a("div.jGrowl-notification",b.element).data("jGrowl.pause",true)}).bind("mouseout.jGrowl",function(){a("div.jGrowl-notification",b.element).data("jGrowl.pause",false)}).bind("jGrowl.beforeOpen",function(){if(e.beforeOpen.apply(d,[d,c,e,b.element])!=false){a(this).trigger("jGrowl.open")}}).bind("jGrowl.open",function(){if(e.open.apply(d,[d,c,e,b.element])!=false){if(e.glue=="after"){a("div.jGrowl-notification:last",b.element).after(d)}else{a("div.jGrowl-notification:first",b.element).before(d)}a(this).animate(e.animateOpen,e.openDuration,e.easing,function(){if(a.browser.msie&&(parseInt(a(this).css("opacity"),10)===1||parseInt(a(this).css("opacity"),10)===0)){this.style.removeAttribute("filter")}if(a(this).data("jGrowl")!=null){a(this).data("jGrowl").created=new Date()}a(this).trigger("jGrowl.afterOpen")})}}).bind("jGrowl.afterOpen",function(){e.afterOpen.apply(d,[d,c,e,b.element])}).bind("jGrowl.beforeClose",function(){if(e.beforeClose.apply(d,[d,c,e,b.element])!=false){a(this).trigger("jGrowl.close")}}).bind("jGrowl.close",function(){a(this).data("jGrowl.pause",true);a(this).animate(e.animateClose,e.closeDuration,e.easing,function(){if(a.isFunction(e.close)){if(e.close.apply(d,[d,c,e,b.element])!==false){a(this).remove()}}else{a(this).remove()}})}).trigger("jGrowl.beforeOpen");if(e.corners!=""&&a.fn.corner!=undefined){a(d).corner(e.corners)}if(a("div.jGrowl-notification:parent",b.element).size()>1&&a("div.jGrowl-closer",b.element).size()==0&&this.defaults.closer!=false){a(this.defaults.closerTemplate).addClass("jGrowl-closer "+this.defaults.themeState+" ui-corner-all").addClass(this.defaults.theme).appendTo(b.element).animate(this.defaults.animateOpen,this.defaults.speed,this.defaults.easing).bind("click.jGrowl",function(){a(this).siblings().trigger("jGrowl.beforeClose");if(a.isFunction(b.defaults.closer)){b.defaults.closer.apply(a(this).parent()[0],[a(this).parent()[0]])}})}},update:function(){a(this.element).find("div.jGrowl-notification:parent").each(function(){if(a(this).data("jGrowl")!=undefined&&a(this).data("jGrowl").created!=undefined&&(a(this).data("jGrowl").created.getTime()+parseInt(a(this).data("jGrowl").life))<(new Date()).getTime()&&a(this).data("jGrowl").sticky!=true&&(a(this).data("jGrowl.pause")==undefined||a(this).data("jGrowl.pause")!=true)){a(this).trigger("jGrowl.beforeClose")}});if(this.notifications.length>0&&(this.defaults.pool==0||a(this.element).find("div.jGrowl-notification:parent").size()<this.defaults.pool)){this.render(this.notifications.shift())}if(a(this.element).find("div.jGrowl-notification:parent").size()<2){a(this.element).find("div.jGrowl-closer").animate(this.defaults.animateClose,this.defaults.speed,this.defaults.easing,function(){a(this).remove()})}},startup:function(b){this.element=a(b).addClass("jGrowl").append('<div class="jGrowl-notification"></div>');this.interval=setInterval(function(){a(b).data("jGrowl.instance").update()},parseInt(this.defaults.check));if(a.browser.msie&&parseInt(a.browser.version)<7&&!window.XMLHttpRequest){a(this.element).addClass("ie6")}},shutdown:function(){a(this.element).removeClass("jGrowl").find("div.jGrowl-notification").remove();clearInterval(this.interval)},close:function(){a(this.element).find("div.jGrowl-notification").each(function(){a(this).trigger("jGrowl.beforeClose")})}});a.jGrowl.defaults=a.fn.jGrowl.prototype.defaults})(jQuery);