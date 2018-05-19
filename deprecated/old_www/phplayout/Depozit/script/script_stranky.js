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
	
	var el = $$('.centralni_box a');
	$$('.centralni_box a').addEvents({
		mouseenter: function(){
			this.morph({
        'borderColor': '#000'
			});
		},
		mouseleave: function(){
			this.morph({
        'borderColor': '#fff'
			});
		}
	});
	
	var el = $$('#sekce_uvodni_strana p');
	$$('#sekce_uvodni_strana p').addEvents({
		mouseenter: function(){
			this.morph({
        'backgroundColor': '#d9d9d9'
			});
		},
		mouseleave: function(){
			this.morph({
        'backgroundColor': '#fff'
			});
		}
	});
	
	var el = $$('#sekce_uvodni_strana p#celkovy_pocet');
	$$('#sekce_uvodni_strana p#celkovy_pocet').addEvents({
		mouseenter: function(){
			this.morph({
        'backgroundColor': '#525252',
        'color': '#fff',
        'borderTopColor': '#d9d9d9',
        'borderRightColor': '#d9d9d9',
        'borderLeftColor': '#d9d9d9'
			});
		},
		mouseleave: function(){
			this.morph({
        'backgroundColor': '#fff',
        'color': '#000',
        'borderTopColor': '#fff',
        'borderRightColor': '#fff',
        'borderLeftColor': '#fff'
			});
		}
	});
	
	var el = $$('#sekce_vypis_stazenych_modulu .polozka_vypis');
	$$('#sekce_vypis_stazenych_modulu .polozka_vypis').addEvents({
		mouseenter: function(){
			this.morph({
        'backgroundColor': '#d9d9d9'
			});
		},
		mouseleave: function(){
			this.morph({
        'backgroundColor': '#fff'
			});
		}
	});
	
	var el = $$('#sekce_vypis_stazenych_modulu .zahlavi_polozka_vypis');
	$$('#sekce_vypis_stazenych_modulu .zahlavi_polozka_vypis').addEvents({
		mouseenter: function(){
			this.morph({
        'backgroundColor': '#525252',
        'color': '#fff'
			});
		},
		mouseleave: function(){
			this.morph({
        'backgroundColor': '#fff',
        'color': '#000'
			});
		}
	});
	
	var el = $$('#sekce_vypis_modulu .polozka_vypis');
	$$('#sekce_vypis_modulu .polozka_vypis').addEvents({
		mouseenter: function(){
			this.morph({
        'backgroundColor': '#d9d9d9'
			});
		},
		mouseleave: function(){
			this.morph({
        'backgroundColor': '#fff'
			});
		}
	});
	
	var el = $$('#sekce_vypis_modulu .zahlavi_polozka_vypis');
	$$('#sekce_vypis_modulu .zahlavi_polozka_vypis').addEvents({
		mouseenter: function(){
			this.morph({
        'backgroundColor': '#525252',
        'color': '#fff'
			});
		},
		mouseleave: function(){
			this.morph({
        'backgroundColor': '#fff',
        'color': '#000'
			});
		}
	});
	
	var el = $$('#zapati #nastaveni_strankovani');
	$$('#zapati #nastaveni_strankovani').addEvents({
		mouseenter: function(){
			this.morph({
        'height': '142px'
			});
		},
		mouseleave: function(){
			this.morph({
        'height': '20px'
			});
		}
	});
	
	$$('h1').zboing();
	if(Browser.Engine.trident){
		document.ondragstart = function (){return false;}
	}
});
