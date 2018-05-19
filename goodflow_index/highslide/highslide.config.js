/**
*	Site-specific configuration settings for Highslide JS
*/
hs.showCredits = false;
hs.outlineType = 'custom';
//hs.allowSizeReduction = false;
//hs.maxWidth = 1100;
//hs.maxHeight = 800;
hs.dimmingOpacity = 0.8;
hs.fadeInOut = true;
hs.easing = 'linearTween';
hs.expandDuration = 200;
hs.restoreDuration = 200;
hs.outlineWhileAnimating = 0;
hs.align = 'center';
hs.allowMultipleInstances = false;
hs.captionEval = 'this.a.title';
hs.registerOverlay({
	html: '<div class="closebutton" onclick="return hs.close(this)" title="Zavřít"></div>',
	position: 'top right',
	useOnHtml: true,
	fade: 2 // fading the semi-transparent overlay looks bad in IE
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
	number: 'Náhled %1 z %2',
	restoreTitle: 'Klikněte pro zavření obrázku, klikněte a táhněte pro jeho přesunutí. Použijte šipky na klávesnici pro přesun na další a předchozí.'
};
