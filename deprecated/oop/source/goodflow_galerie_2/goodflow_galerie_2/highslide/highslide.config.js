/**
*	Site-specific configuration settings for Highslide JS
*/
hs.graphicsDir = 'highslide/graphics/';
hs.showCredits = false;
hs.outlineType = 'custom';
hs.dimmingOpacity = 0.85;
hs.dimmingDuration = 75;
hs.fadeInOut = true;
hs.align = 'center';
hs.captionEval = 'this.a.title';
hs.registerOverlay({
	html: '<div class="closebutton" onclick="return hs.close(this)" title="Zavřít"></div>',
	position: 'top right',
	useOnHtml: true,
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});



// Add the slideshow controller
hs.addSlideshow({
	slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		className: 'large-dark',
		opacity: '0.6',
		position: 'bottom center',
		offsetX: '0',
		offsetY: '-15',
		hideOnMouseOut: true
	}
});

// Czech language strings
hs.lang = {
	cssDirection: 'ltr',
	loadingText: 'Načítá se...',
	loadingTitle: 'Klikněte pro zrušení',
	focusTitle: 'Klikněte pro přenesení do popředí',
	fullExpandTitle: 'Zvětšit na původní velikost',
	creditsText: 'Powered by <i>Highslide JS</i>',
	creditsTitle: 'Přejít na stránky Highslide JS',
	previousText: 'Předchozí',
	nextText: 'Další',
	moveText: 'Přesunout',
	closeText: 'Zavřít',
	closeTitle: 'Zavřít (esc)',
	resizeTitle: 'Změnit velikost',
	playText: 'Přehrát',
	playTitle: 'Přehrát slideshow (mezerník)',
	pauseText: 'Pozastavit',
	pauseTitle: 'Pozastavit slideshow (mezerník)',
	previousTitle: 'Předchozí (šipka vlevo)',
	nextTitle: 'Další (šipka vpravo)',
	moveTitle: 'Přesunout',
	fullExpandText: 'Plná velikost',
	number: 'Obrázek %1 z %2',
	restoreTitle: 'Klikněte pro zavření obrázku, klikněte a táhněte pro jeho přesunutí. Použijte šipky na klávesnici pro přesun na další a předchozí.'
};

// gallery config object
var config1 = {
	slideshowGroup: 'group1',
	numberPosition: 'caption',
	transitions: ['expand', 'crossfade']
};
