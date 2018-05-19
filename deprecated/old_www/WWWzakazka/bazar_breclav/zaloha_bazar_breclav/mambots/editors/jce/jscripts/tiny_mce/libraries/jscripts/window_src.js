//Requires mootools.js
var Dialog = new Class({
	getOptions : function(){
		return {			
			width: 250,
			height: 250,
			parent: 'body',
			onOpen: Class.empty,
			onConfirm: false,
			onCancel: function(){
				this.close();
			},
			confirmText: jce.getLang('ok'),
			cancelText: jce.getLang('cancel'), 
			drag: true,
			resize: false,
			minimize: false,
			modal: true,
			ghost: true
		};
	},
	initialize : function(name, title, body, options){
		this.setOptions(this.getOptions(), options);
		if (this.options.initialize) this.options.initialize.call(this);
		this.title = title;
		this.body = body;
		this.id = name + '_window';					
		if($(this.id)) return;
		this.open();	
	},
	open : function(){
		var html = '<div class="jce_win_head_left">';
		html += '<div class="jce_win_head_right">';
		html += '<div id="' + this.id + '_head" class="jce_win_head" onselectstart="return false;" unselectable="on" style="-moz-user-select: none !important;">';
		html += '<div id="' + this.id + '_title" class="jce_win_title">' + this.title + '</div>';
		html += '<div id="' + this.id + '_close" class="jce_win_close">&nbsp;</div>';
		if(this.options.minimize){
			html += '<div id="' + this.id + '_toggle" class="jce_win_min">&nbsp;</div>';	
		}
		html += '</div>';
		html += '</div></div>';
		html += '<div id="' + this.id + '_body" >';
		html += '<div id="' + this.id + '_html" class="jce_win_body">' + this.body + '</div>';
		html += '<div id="' + this.id + '_foot" class="jce_win_foot">';	
		
		if(this.options.onConfirm){
			html += '<input type="button" class="button" id="' + this.id + '_confirm" value="' + this.options.confirmText + '" />';
		}
		if(this.options.onCancel){
			html += '<input type="button" class="button" id="' + this.id + '_cancel" value="' + this.options.cancelText + '" />';
		}
		if(this.options.resize){
			html += '<div id="' + this.id + '_resize" class="jce_win_resize">&nbsp;</div>';
		}
		html += '</div>';
		html += '</div>';
		
		this.dialog = new Element('div').setProperty('id', this.id).injectInside($E(this.options.parent));
		this.dialog.setStyles({'position': 'absolute', 'zIndex': '1000', 'width': this.options.width.toInt() + 2 + 'px'}).setHTML(html);
		
		if(window.ie6){ 
			this.blocker = new Element('iframe').setProperties({'src': 'about:blank', 'id': this.id + '_blocker', 'frameborder': '0', 'scrolling': 'no', 'class': 'jce_win_blocker'}).injectInside($E('body'));
		}
		
		if(this.options.modal){
			//this.options.ghost = false;
			this.overlay = new Element('div').setProperty('id', this.id + '_overlay').addClass('jce_win_overlay').setOpacity(0.5).injectInside($E('body'));	
		}
		if(this.options.drag){
			this.dialog.makeDraggable(
			{
				handle: $(this.id + '_head'),
				onStart: function(){
					if(this.options.ghost){
						this.dialog.setOpacity(0.7);
					}
				}.bind(this),
				onComplete: function(){
					if(this.options.ghost){
						this.dialog.setOpacity(1);
					}
				}.bind(this)			
			});
		}else{
			this.options.ghost = false;	
		}
		if(this.options.resize){
			this.dialog.makeResizable({
				handle: $(this.id + '_resize'),
				limit: {x: [this.options.width, this.options.width * 2], y: [this.options.height, this.options.height * 2]}
			});
		}		
		$(this.id + '_close').addEvent('click', function(){
			this.close();			
		}.bind(this));
		if(this.options.minimize){
			$(this.id + '_head').addEvent('dblclick', function(){
				this.minimize(this);						   
			}.bind(this));			
			$(this.id + '_toggle').addEvent('click', function(){
				this.minimize(this);
			}.bind(this));	
		}
		if(this.options.onCancel){
			$(this.id + '_cancel').addEvent('click', function(){
				this.fireEvent('onCancel');
			}.bind(this));
		}
		if(this.options.onConfirm){
			$(this.id + '_confirm').addEvent('click', function(){
				this.fireEvent('onConfirm');
			}.bind(this));
		}
		/*document.addEvent('keydown', function(e){
			var e = new Event(e);
			if(e.key == 'esc'){
				this.close();
			}
		}.bind(this));*/
		this.centerWindow();
		this.fireEvent('onOpen');
	},
	getAbsPosition : function(n) {
		var p = {absLeft : 0, absTop : 0};
		while (n) {
			p.absLeft += n.offsetLeft;
			p.absTop += n.offsetTop;
			n = n.offsetParent;
		}
		return p;
	},
	centerWindow : function(){
		var re = $E('body');
		var rep = this.getAbsPosition(re);

		var x = rep.absLeft + (re.offsetWidth.toInt() / 2) - ($(this.id).offsetWidth.toInt() / 2);
		var y = rep.absTop + (re.offsetHeight.toInt() / 2) - ($(this.id).offsetHeight.toInt() / 2);
		
		if( $(this.id).offsetHeight.toInt() <  re.offsetHeight.toInt() - 30){
			y = y - 20;
		}		
		$(this.id).setStyles({'left': x + 'px', 'top': y + 'px'});	
	},
	setWidth: function(w){
		if(w.toInt() < 250) w = 250;
		this.options.width = w.toInt();
		this.dialog.setStyle('width', w.toInt() + 'px');
	},
	setHeight: function(h){
		if(h.toInt() < 250) h = 250;
		this.options.height = h.toInt();
		this.dialog.setStyle('height', h.toInt() + 'px');
	},
	close : function() {			
		$(this.id + '_html').setHTML('').remove();
		this.dialog.remove();
		if(window.ie6){
			this.blocker.remove();
		}
		if(this.options.modal){
			this.overlay.remove();
		}
		this.name = null;
		this.id = null;
	},
	minimize : function(el){
		if($(this.id + '_toggle').hasClass('jce_win_min')){
			$(this.id + '_toggle').className = 'jce_win_max';
			$(this.id + '_body').setStyle('display', 'none');
		}else{
			$(this.id + '_toggle').className = 'jce_win_min';
			$(this.id + '_body').setStyle('display', 'block');
		}
	},
	setBody : function(h){
		$(this.id + '_html').setHTML(h);
	},
	setIFrame : function(url, h){						   
		this.setHeight(h);
		this.centerWindow();
		$(this.id + '_html').setHTML('<iframe id="' + this.id + '_iframe" frameborder="0" scrolling="auto" width="100%" height="' + h + '"></iframe');		
		$(this.id + '_iframe').addEvent('load', function(){
			this.fireEvent('onFrameLoad');
		}.bind(this)).setProperty('src', url);
	},
	setIFrameHTML : function(h){
		$(this.id + '_iframe').contentWindow.document.body.innerHTML = h;
	}
});
Dialog.implement(new Options);
Dialog.implement(new Events);

var Alert = Dialog.extend({
    initialize: function(html){
        this.parent('alert', jce.getLang('alert', false), html, {
			width: 250,
			cancelTxt : jce.getLang('ok', false)
		});
    }
});
var Confirm = Dialog.extend({
    getExtended : function(){
		return {
			onConfirm : function(){
				this.close;
			},
			width: 250,
			confirmText : jce.getLang('yes', false),
			cancelText : jce.getLang('no', false)
		};
	},
	initialize: function(html, options){
        this.setOptions(this.getExtended(), options);
		this.parent('confirm', jce.getLang('confirm', false), html, this.options);
    }
});
var Prompt = Dialog.extend({
	getExtended : function(){
		return {
			onConfirm : function(){
				this.close;
			},
			text : '',
			value : '',
			multiline : false,
			width: 250
		};
	},
	initialize: function(title, options){
        this.setOptions(this.getExtended(), options);
		this.html = '';
		if(this.options.text){
			this.html +='<label id="prompt_value_label" for="prompt_value">' + this.options.text + '</label><br />';	
		}
		if(this.options.multiline){
			this.html += '<textarea name="prompt_value" id="prompt_value" style="width:230px; height:75px;">' + this.options.value + '</textarea>';
		}else{
			this.html += '<input type="text" name="prompt_value" id="prompt_value" size="40" value="' + this.options.value + '" />';
		}
		this.parent('prompt', title, this.html, this.options);
    }					   
});
var basicDialog = Dialog.extend({
	getExtended : function(){
		return {
			minimize: true,
			modal: false
		};
	},
	initialize: function(title, html, options){
		this.setOptions(this.getExtended(), options);
		this.parent('basic_dialog', title, html, this.options);
    }							
});
var iframeDialog = basicDialog.extend({
	moreOptions : function(){
		return {
			frameHeight: 250,
			onFrameLoad: Class.empty
		};
	},
	initialize: function(title, url, options){
		this.setOptions(this.moreOptions(), options);
		this.parent(title, '', this.options);
		this.setIFrame(url, this.options.frameHeight);
    }							
});
var imagePreview = basicDialog.extend({
    moreOptions : function(){
        return {
            width: 640,
			height: 480,
			modal: true,
			id: 'previewImage'
        };
    },
    initialize: function(title, url, options){
        this.setOptions (this.moreOptions(), options);
        this.parent('Image Preview', '', this.options);
		this.img = new Image();
		this.img.title = title;
		this.img.onload = function(){
			this.setDimensions();	
		}.bind(this);
		this.img.src = url;
		$(this.id + '_html').adopt(this.img);
		this.centerWindow();
    },
	setDimensions: function(){
		this.img.width = this.getDimensions().width;
		this.img.height = this.getDimensions().height;
		
        this.setWidth(this.img.width + 40);
		this.centerWindow();
	},
    getDimensions: function(){
        var x = this.options.width.toInt() - 40;
        var y = this.options.height.toInt() - 40;
		var w = tw = this.img.width.toInt();
		var h = th = this.img.height.toInt();
		
		if(w > x){
			w = x;
			h = ( w / tw ) * th;
		}
		if( h > y ){
			h = y;
        	w = ( h / th ) * tw;
		}
        return {'width': w, 'height': h};
    }
});
var mediaPreview = basicDialog.extend({
    moreOptions : function(){
        return {
            id: 'mediaPreview',
			mediaWidth: 640,
			mediaHeight: 480,
			modal: true,
			width: 640,
			height: 480
        };
    },
    initialize: function(title, url, type, options){		
		this.setOptions (this.moreOptions(), options);
        this.parent('Media Preview', '', this.options);
		
		this.mediaWidth = this.options.mediaWidth;
		this.mediaHeight = this.options.mediaHeight;
        
		this.mediaWidth = this.getDimensions().width.toInt();
        this.mediaHeight = this.getDimensions().height.toInt();
		
		this.setWidth(this.mediaWidth + 40);
		this.setHeight(this.mediaHeight);
		
		var html = '';		
		switch (type) {
			case "flash":
				cls = 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000';
				codebase = 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0';
				type = 'application/x-shockwave-flash';
				break;
	
			case "shockwave":
				cls = 'clsid:166B1BCA-3F9C-11CF-8075-444553540000';
				codebase = 'http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=8,5,1,0';
				type = 'application/x-director';
				break;
	
			case "qt":
				cls = 'clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B';
				codebase = 'http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0';
				type = 'video/quicktime';
				break;
	
			case "wmp":
				cls = tinyMCE.getParam('media_wmp6_compatible') ? 'clsid:05589FA1-C356-11CE-BF01-00AA0055595A' : 'clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6';
				codebase = 'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701';
				type = 'application/x-mplayer2';
				break;
	
			case "rmp":
				cls = 'clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA';
				codebase = 'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701';
				type = 'audio/x-pn-realaudio-plugin';
				break;
		}
		html += '<object classid="' + cls + '" codebase="' + codebase + '" width="' + this.mediaWidth + '" height="' + this.mediaHeight + '">';
		html += '<param name="url" value="' + url + '">';
		html += '<param name="src" value="' + url + '">';
		html += '<embed type="' + type + '" width="' + this.mediaWidth + '" height="' + this.mediaHeight + '" src="' + url + '">';
		html += '</embed></object>';
		
		this.setBody(html);
		this.centerWindow();
    },
    getDimensions: function(){
        var x = this.options.width.toInt() - 40;
        var y = this.options.height.toInt() - 40;		
		var w = tw = this.mediaWidth.toInt();
		var h = th = this.mediaHeight.toInt();
		
		if(w > x){
			w = x;
			h = ( w / tw ) * th;
		}
		if( h > y ){
			h = y;
        	w = ( h / th ) * tw;
		}
        return {'width': w, 'height': h};
    }
});