window.addEvent('domready',function(){
	var myHelp = new mooSlide2({ 
    slideSpeed: 1500,
    fadeSpeed: 500,
    toggler:'napoveda_wym',
    content:'napoveda_wym_panel',
    height: 230,
    close: false,
    effects:Fx.Transitions.Bounce.easeOut, 
    from:'bottom'
  });
	//optional: AutoStart the slider on page load:
	//MyLogin.run();
    $('close').addEvent('click', function(e){
		e = new Event(e);
		myHelp.clearit();
		e.stop();
	});
});