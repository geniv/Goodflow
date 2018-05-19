var externalize = function(){
	$$('a[rel="external"]').addEvent('click',function(e){
	    e.stop();
	    window.open(this.get('href'));
	}).removeProperty("external");
};

Element.implement({
	shake:function(radius,duration){
		radius = radius || 3;
		duration = duration || 500;
		duration = (duration/50).toInt() -1;
		var parent = this.getParent();
		if(parent != $(document.body) && parent.getStyle('position')=='static'){
			parent.setStyle('position','relative');
		}
		var position = this.getStyle('position');
		if(this.getStyle('position')=='static'){
			this.setStyle('position','relative');
			position = "relative";
		}
		if(Browser.Engine.trident){
			parent.setStyle("height",parent.getStyle('height'));
		}
		var coords = this.getPosition(parent);
		if(position == "relative" && !Browser.Engine.presto){
			coords.x -= parent.getStyle('paddingLeft').toInt();
			coords.y -= parent.getStyle('paddingTop').toInt();
		}
		var morph = this.retrieve('morph');
		if (morph){
			morph.cancel();
			var oldOptions = morph.options;
		}
		var morph = this.get('morph',{
			duration:50,
			link:'chain'
		});
		for(var i=0 ; i < duration ; i++){
			morph.start({
				top:coords.y+$random(-radius,radius),
				left:coords.x+$random(-radius,radius)
			});
		}
		morph.start({
			top:coords.y,
			left:coords.x
		}).chain(function(){
			if(oldOptions){
				this.set('morph',oldOptions);
			}
		}.bind(this));
		return this;
	},
	beat:function(radius,rate){
		radius = radius || 2;
		rate = rate || 70;
		duration = (60000/(4*rate)).toInt();
		var parent = this.getParent();
		if(parent != $(document.body) && parent.getStyle('position')=='static'){
			parent.setStyle('position','relative');
		}
		var position = this.getStyle('position');
		if(this.getStyle('position')=='static'){
			this.setStyle('position','relative');
			position = "relative";
		}
		if(Browser.Engine.trident){
			parent.setStyle("height",parent.getStyle('height'));
		}
		var coords = this.getCoordinates(parent);
		if(position == "relative" && !Browser.Engine.presto){
			coords.left -= parent.getStyle('paddingLeft').toInt();
			coords.top -= parent.getStyle('paddingTop').toInt();
		}
		this.set('morph',{
			link:'chain',
			transition:Fx.Transitions.Back.easeOut,
			duration:duration
		}).store('coords',coords);
		var hr = function(){
			var coords = this.retrieve('coords');
			this.morph({
				top: coords.top - radius,
				left: coords.left - radius,
				width: coords.width + 2*radius,
				height : coords.height + 2*radius
			}).morph(coords);
		};
		hr.call(this);
		hr.periodical((60000/rate).toInt(),this);
		return this;
	},
	center : function(relative){
		if($(relative)){
			relative = $(relative);
		}else{
			relative = window;
		}
		var windSize = relative.getSize();
		var elSize = this.getSize();
		var top,left,marginTop,marginLeft;
		if (windSize.x < elSize.x) {
			left = 0;
			marginLeft = 0;
		} else {
			left = '50%';
			marginLeft = -(elSize.x/2).toInt();
		}
		if (windSize.y < elSize.y ) {
			top = 0;
			marginTop = 0;
		} else {
			top = '50%';
			marginTop = -(elSize.y/2).toInt();
		}
		if(relative != window && relative.getStyle('position')=='static'  ){
			relative.setStyle('position','relative');
		}
		this.setStyles({
			position:'absolute',
			top:top,
			left:left,
			marginLeft:marginLeft,
			marginTop:marginTop
		}).inject((relative==window?$(document.body):relative));
		return this;
	},
	zboing:function(){
		var parent = this.getParent();
		if(parent != $(document.body) && parent.getStyle('position')=='static'){
			parent.setStyle('position','relative');
		}
		var position = this.getStyle('position');
		if(this.getStyle('position')=='static'){
			this.setStyle('position','relative');
			position = "relative";
		}
		if(Browser.Engine.trident || Browser.Engine.presto ){
			parent.setStyle("height",parent.getStyle('height'));
			var coords = this.getPosition(parent);
		}else{
			var coords = this.getPosition(parent);
			if(position == "relative"){
				coords.x -= parent.getStyle('paddingLeft').toInt();
				coords.y -= parent.getStyle('paddingTop').toInt();
			}
		}
		this.setStyle("cursor","move").store('position',coords).set('morph',{
			transition:Fx.Transitions.Elastic.easeOut
		}).makeDraggable({
			onComplete:function(){
				var position = this.element.retrieve('position');
				this.element.get('morph').start({
					top:position.y,
					left:position.x
				});
			}
		});
		return this;
	},
	fall:function(target,options){
		var options = options || {transition:Fx.Transitions.Bounce.easeOut,duration:800};
		var size = this.getSize();
		var winSize = window.getSize();
		var winScroll = window.getScroll();
		switch($type(target)){
			case 'element':
			case 'string':
				var coords = $(target).getCoordinates();
				target = {
					left:coords.left+((coords.width-size.x)/2).toInt(),
					top:coords.top+((coords.height-size.y)/2).toInt()
				}
				break;
			case 'object':
				if(target.x && target.y){
					target = {
						left:target.x-(size.x/2).toInt(),
						top:target.y-(size.y/2).toInt()
					}
					break;
				}
			default:
				target = {
					left:((winSize.x-size.x)/2).toInt()+winScroll.x,
					top:((winSize.y-size.y)/2).toInt()+winScroll.y
				}
				break;
		}
		target.width=size.x;
		target.height=size.y;
		this.setStyles({
			display:'none',
			position:'absolute',
			width:winSize.x,
			height:(winSize.x*size.y/size.x).toInt(),
			left:winScroll.x,
			top:winScroll.y+winSize.y/2-(winSize.x*size.y/(2*size.x)).toInt()
		}).inject($(document.body)).setStyle('display','block').get('morph',options).start(target);
		return this;
	},
	confirmUnsaved:function(){
		if(this.get('tag') == 'form'){
			this.addEvents({
				'submit':function(){this.store('modified',false);},
				'reset':function(){this.store('modified',false);}
			}).getElements('input,textarea,select').addEvent('change',function(){
				this.getParent('form').store('modified',true);
			});
			window.onbeforeunload = function(){
				if(this.retrieve('modified')){
					return "You did not submit the last modifications.";
				}
			}.bind(this);
		}
		return this;
	},
	inputHint : function(val){
		switch(this.get('tag')){
			case 'form':
				this.getElements('input[type="text"],textarea').inputHint(val);
				return this;
			case 'input':
			case 'textarea':
				this.store('default',(val||this.get('value')));
				this.addEvents({
					'focus':function(){
						if(this.get('value') == this.retrieve('default')){
							this.set('value', '');
						}
					},
					'blur':function(){
						if(this.get('value').clean() == '') {
							this.set('value', this.retrieve('default'));
						}
					}
				}).fireEvent('blur');
			default: return this;
		}
	},
	followMe : function(offset){
		offset = offset || 0;
		var pos = this.getCoordinates();
		this.inject($(document.body)).setStyles({
			position:'absolute',
			margin:0,
			top:pos.top,
			left:pos.left
		}).set('morph',{
			link:'cancel',
			transition:Fx.Transitions.linear,
			duration:1000
		});
		$(document.body).addEvent('mousemove',function(e){
			this.store('page',{top:e.page.y+offset,left:e.page.x+offset});
		}.bind(this));
		var goToMouse = function(){
			var page = this.retrieve('page');
			if(page){
				this.get('morph').start(page);
				this.store('page',false);
			}
		}
		this.store('period',goToMouse.periodical(200,this));
		return this;
	},
	autoRefresh : function(url){
		if(this.get('tag')!='select'){
			return false;
		}
		this.store('updated',false);
		this.addEvents({
			'mouseenter':function(){
				if(!this.retrieve('updated')){
					var indicator = new Element('option',{
						'html':'Refreshing...',
						'selected':'selected'
					});
					if(Browser.Engine.presto){
						indicator.inject(this,'top');
					}else{
						indicator.inject(this);
					}
					this.set('disabled','disabled');
					this.store('updated',true);
					var request = new Request({
						'url':url,
						'onSuccess':function(response){
							var options = JSON.decode(response);
							this.erase('disabled');
							this.updateSelect(options);
						}.bind(this)
					});
					request.send();
				}
			}.bind(this),
			'blur':function(){
				this.store('updated',false);
			}.bind(this)
		});
	},
	updateSelect : function(options){
		if(this.get('tag')!='select'){
			return false;
		}
		var selected = this.get('value');
		this.empty();
		$each(options,function(text,value){
			this.addOption(value,text,(value==selected?true:false));
		},this);
		if(Browser.Engine.trident){
			this.setStyle('width',this.getStyle('width'));
		}
	},
	cascade : function(url,target){
		if($(target).get('tag')!='select'){
			return false;
		}
		this.addEvent('change',function(selected){
			var value = this.get('value');
			var name = this.get('name');
			if(!$chk(value)){
				return;
			}
			var data = new Hash();
			data.set(name,value);
			var request = new Request({
				'url':url,
				'data':data.toQueryString(),
				'onSuccess':function(response){
					var options = JSON.decode(response);
					$(target).updateSelect(options);
					if(selected){
						$(target).setOption(selected);
					}
				}.bind(this)
			});
			request.send();
		}.bind(this));
	},
	addOption : function(value,text,selected){
		if(this.get('tag')!='select'){
			return false;
		}
		var option = new Element('option',{
			'value':value,
			'html':text
		});
		if(selected){
			option.set('selected','selected');
		}
		this.adopt(option);
	},
	setOption : function(value){
		value = $splat(value);
		value.each(function(v){
			v = ($type==="number") ? v + "" : v;
			Array.each(this.options, function(option){
				option.selected = (option.value===v+"") ? true : false;
			});
		}, this);
	}
});

Native.implement([Element,Document,Window],{
	IEBW : function(){
		if(Browser.Engine.trident){
			switch($type(this)){
				case 'window':
				case 'document':
					$(this.getDocument().html).setStyle('filter','gray');
					break;
				case 'element': 
					this.setStyle('filter','gray');
			}
		}
		return this;
	}
});
Native.implement([Element,Document,Window,String],{
	fromQueryString : function(){
		switch($type(this)){
			case 'window':
			case 'document':
				var url = location.href;
				break;
			case 'element':
				switch(this.get('tag')){
					case 'a':
						var url = this.get('href');
						break;
					case 'form':
						var url = this.get('action');
						break;
					default :
						return false;
				}
				break;
			case 'string':
				var url = this;
				break;
			default:
				return false;
		}
		var parameters = false;
		if(url.contains('?')){
			if(url.contains('#')){
				url = url.split('#')[0];
			}
			var query = url.split('?')[1];
			if(query != ""){
				var parameters = new Hash();
				params = query.split('&');
				params.each(function(param){
					param = param.split('=');
					parameters.set(param[0],param[1]);
				});
			}
		}
		return parameters;
	}
});

Fx.Slides = new Class({
	initialize:function(selector,options){
		this.elements = $$(selector);
		this.elements.set('slide',options);
	},

	slide:function(how,i){
		if($chk(i)){
			this.elements[i].slide(how);
		}else{
			this.elements.slide(how);
		}
	},

	show:function(i){
		this.slide('show',i);
	},

	hide:function(i){
		this.slide('hide',i);
	},

	slideIn:function(i){
		this.slide('in',i);
	},

	slideOut:function(i){
		this.slide('out',i);
	},

	toggle:function(i){
		this.slide('toggle',i);
	}
});
