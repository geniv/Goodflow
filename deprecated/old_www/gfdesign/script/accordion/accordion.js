window.addEvent('domready', function() {
	var myAccordion = new Accordion($('accordion_obal'), 'h3.prepinac', 'div.obsah_accordion', {

		alwaysHide: true,
		//display:-1,
		show: 0,
		opacity: true,
		
		onActive: function(toggler, element){
			toggler.setStyle('color', '#dd7011');
		},
		onBackground: function(toggler, element){
			toggler.setStyle('color', '#c9f00f');
		}
	});
});
