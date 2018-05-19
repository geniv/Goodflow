var KEY = {
	W: 87,
	A: 65,
	S: 83,
	D: 68
	}


var player = {}
player.pressedKeys = [];

$(function(){
	player.timer = setInterval(gameloop,30);

	$(document).keydown(function(e){
	player.pressedKeys[e.which] = true;
	});

	$(document).keyup(function(e){
	player.pressedKeys[e.which] = false;
  }); 
});

function gameloop()
{
	movePaddless();
}

function movePaddless(){
	//nahrani do promenych sirky platna
	var rozmer_y = $("#platno").height();
	var rozmer_x = $("#platno").width();
	//nahrani do promenych rozmery hrace
	var hrac_y = $("#hrac").height();
	var hrac_x = $("#hrac").width();
	//zjisteni aktualni polohy divu hrac
	var hrac = $("#hrac").position();
	var hrac_vyska = hrac.top;
	var hrac_sirka = hrac.left;
	
	//zobrazeni aktualnich souradnic divu hrac
	$("#x").html(hrac_vyska);
	$("#y").html(hrac_sirka);
	
	//posun nahoru se zabezpeceni proti uteku z herni plochy
	if(player.pressedKeys[KEY.W]){
		if(hrac_vyska > 0) {
			var top = parseInt($("#hrac").css("top"));
			$("#hrac").css("top",top-5);
		}
	}
	//posun dolu se zabezpeceni proti uteku z herni plochy
	if(player.pressedKeys[KEY.S]){
		if(hrac_vyska < rozmer_y - hrac_y) {
			var top = parseInt($("#hrac").css("top"));
			$("#hrac").css("top",top+5);
		}
	}
	//posun doprava se zabezpeceni proti uteku z herni plochy
	if(player.pressedKeys[KEY.A]){
		if(hrac_sirka > 0) {
			var left = parseInt($("#hrac").css("left"));
			$("#hrac").css("left",left-5);
		}
	}
	//posun doprava se zabezpeceni proti uteku z herni plochy
	if(player.pressedKeys[KEY.D]){
		if(hrac_sirka < rozmer_x - hrac_x) {
			var left = parseInt($("#hrac").css("left"));
			$("#hrac").css("left",left+5);
		}
	}

}
