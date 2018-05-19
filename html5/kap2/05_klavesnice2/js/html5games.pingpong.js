var KEY = {
	UP: 38,
	DOWN: 40,
	W: 87,
	S: 83
}

// globální objekt pro uložení proměnných hry
var pingpong = {}

// pole stisknutých a uvolněných kláves
pingpong.pressedKeys = [];

$(function(){
	// nastavení intervalu volání funkce gameloop na 30 milisekund
	pingpong.timer = setInterval(gameloop,30);
	
	// zaznamenání stisknutí a uvolnění kláves do pole pressedKeys
	$(document).keydown(function(e){
		pingpong.pressedKeys[e.which] = true;
    });
    $(document).keyup(function(e){
    	pingpong.pressedKeys[e.which] = false;
	});
});

// tato funkce se volá každých 30 milisekund 
function gameloop()
{
	movePaddless();
}

	
function movePaddless()
{
  // časovačem pravidelně volaná funkce, která vyhodnocuje stisknuté klávesy
	if (pingpong.pressedKeys[KEY.UP])
	{
		// posunutí pálky B o pět pixelů nahoru
		var top = parseInt($("#paddleB").css("top"));
		$("#paddleB").css("top",top-5);	
	}
	if (pingpong.pressedKeys[KEY.DOWN])
	{
		// posunutí pálky B o pět pixelů dolů
		var top = parseInt($("#paddleB").css("top"));
		$("#paddleB").css("top",top+5);
	}
	if (pingpong.pressedKeys[KEY.W])
	{
		// posunutí pálky A o pět pixelů nahoru
		var top = parseInt($("#paddleA").css("top"));
		$("#paddleA").css("top",top-5);
	}
	if (pingpong.pressedKeys[KEY.S])
	{
		// posunutí pálky A o pět pixelů dolů
		var top = parseInt($("#paddleA").css("top"));
		$("#paddleA").css("top",top+5);			
	}
}