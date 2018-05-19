var KEY = {
	UP: 38,
	DOWN: 40,
	W: 87,
	S: 83
}

var pingpong = {}

pingpong.pressedKeys = [];

pingpong.ball = {
	speed: 5,
	x: 150,
	y: 100,
	directionX: 1,
	directionY: 1
}

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
	moveBall();
	movePaddless();
}

function moveBall()
{
  // načtení potřebných hodnot
	var playgroundHeight = parseInt($("#playground").height());
	var playgroundWidth = parseInt($("#playground").width());	
	var ball = pingpong.ball;
	
  // ověření hranice herního pole
  // dolní hrana
	if (ball.y +ball.speed*ball.directionY > playgroundHeight)
	{
		ball.directionY = -1;
	}
	// horní hrana
	if (ball.y +ball.speed*ball.directionY < 0)
	{
		ball.directionY = 1;
	}
	// pravá hrana
	if (ball.x +ball.speed*ball.directionX > playgroundWidth)
	{
    // hráč B prohrál
    // přemístění míčku do výchozí polohy
		ball.x = 250;
		ball.y = 100;
		$("#ball").css({
			"left": ball.x,
			"top" : ball.y
		});
		ball.directionX = -1;
	}
	// levá hrana
	if (ball.x  + ball.speed*ball.directionX < 0)
	{
    // hráč A prohrál
    // přemístění míčku do výchozí polohy
		ball.x = 150;
		ball.y = 100;
		$("#ball").css({
			"left": ball.x,
			"top" : ball.y
		});
		ball.directionX = 1;
	}
	
	// levá pálka
	var paddleAX = parseInt($("#paddleA").css("left"))+parseInt($("#paddleA").css("width"));
	var paddleAYBottom = parseInt($("#paddleA").css("top"))+parseInt($("#paddleA").css("height"));
	var paddleAYTop = parseInt($("#paddleA").css("top"));
	if (ball.x + ball.speed*ball.directionX < paddleAX)
	{
		if (ball.y + ball.speed*ball.directionY <= paddleAYBottom && 
			ball.y + ball.speed*ball.directionY >= paddleAYTop)
		{
			ball.directionX = 1;
		}
	}
	
	// pravá pálka
	var paddleBX = parseInt($("#paddleB").css("left"));
	var paddleBYBottom = parseInt($("#paddleB").css("top"))+parseInt($("#paddleB").css("height"));
	var paddleBYTop = parseInt($("#paddleB").css("top"));
	if (ball.x + ball.speed*ball.directionX >= paddleBX)
	{
		if (ball.y + ball.speed*ball.directionY <= paddleBYBottom && 
			ball.y + ball.speed*ball.directionY >= paddleBYTop)
		{
			ball.directionX = -1;
		}
	}
	
	
	ball.x += ball.speed * ball.directionX;
	ball.y += ball.speed * ball.directionY;
	
	// vlastní pohyb míčku požadovaným směrem
	$("#ball").css({
		"left" : ball.x,
		"top" : ball.y
	});
}

function movePaddless()
{
	// časovačem pravidelně volaná funkce, která vyhodnocuje stisknuté klávesy 
	if (pingpong.pressedKeys[KEY.UP]) // šipka nahoru
	{
		// posunutí pálky B o pět pixelů nahoru
		var top = parseInt($("#paddleB").css("top"));
		$("#paddleB").css("top",top-5);	
	}
	if (pingpong.pressedKeys[KEY.DOWN]) // šipka dolů
	{
		// posunutí pálky B o pět pixelů dolů
		var top = parseInt($("#paddleB").css("top"));
		$("#paddleB").css("top",top+5);
	}
	if (pingpong.pressedKeys[KEY.W]) // w
	{
		// posunutí pálky A o pět pixelů nahoru
		var top = parseInt($("#paddleA").css("top"));
		$("#paddleA").css("top",top-5);
	}
	if (pingpong.pressedKeys[KEY.S]) // s
	{
		// posunutí pálky A o pět pixelů dolů
		var top = parseInt($("#paddleA").css("top"));
		$("#paddleA").css("top",top+5);			
	}
}