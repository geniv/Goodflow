window.addEvent('domready', function(){
	var el = $$('#menu_zahlavi h2');
	$$('#menu_zahlavi h2').set('opacity', 0.3).addEvents({
		mouseenter: function(){
			this.morph({
				'opacity': 1
			});
		},
		mouseleave: function(){
			this.morph({
				opacity: 0.3
			});
		}
	});
	$$('h1').zboing();
	if(Browser.Engine.trident){
		document.ondragstart = function (){return false;}
	}
});
