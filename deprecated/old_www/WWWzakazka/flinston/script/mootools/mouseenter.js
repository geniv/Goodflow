window.addEvent('domready', function(){
	var el = $$('#obsah_sloupce p.polozka_sloupce a');
	$$('#obsah_sloupce p.polozka_sloupce a').addEvents({
		mouseenter: function(){
			this.morph({
				'background-color': '#587936',
				'color': '#393b37'
			});
		},
		mouseleave: function(){
			this.morph({
				'background-color': '#5e813b',
				'color': '#2a441e'
			});
		}
	});
	var el = $$('#obsah_sloupce p.mail a');
	$$('#obsah_sloupce p.mail a').addEvents({
		mouseenter: function(){
			this.morph({
				'background-color': '#587936',
				'color': '#393b37'
			});
		},
		mouseleave: function(){
			this.morph({
				'background-color': '#5e813b',
				'color': '#1e4c1b'
			});
		}
	});
	var el = $$('#zapati p a');
	$$('#zapati p a').addEvents({
		mouseenter: function(){
			this.morph({
				'color': '#9ab877'
			});
		},
		mouseleave: function(){
			this.morph({
				'color': '#2a441e'
			});
		}
	});
});