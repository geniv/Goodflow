// globální objekt pro uložení proměnných hry
var audiogame = {};

// obsluha události ready
$(function(){	
	// načtení elementů audio
	audiogame.buttonOverSound = document.getElementById("buttonover");
	audiogame.buttonOverSound.volume = .3;
	audiogame.buttonActiveSound = document.getElementById("buttonactive");
	audiogame.buttonActiveSound.volume = .3;
	
	// nastavení obsluhy událostí odkazu s identifikátorem game
	$("a[href='#game']")
	.hover(function(){
		audiogame.buttonOverSound.currentTime = 0;		
		audiogame.buttonOverSound.play();	
	},function(){
		audiogame.buttonOverSound.pause();	
	})
	.click(function(){
		audiogame.buttonActiveSound.currentTime = 0;
		audiogame.buttonActiveSound.play();
		
		return false;
	});
	
});
