var KEY = {
	UP: 38,
	DOWN: 40,
	W: 87,
	S: 83
}

// kód nacházející se uvnitř $(function(){} se spustí poté, co 
// se dokončí načítání dokumentu a bude připravený DOM
$(function(){
	// naslouchání události stisknutí klávesy klávesnice
	$(document).keydown(function(e){
      switch(e.which){
        case KEY.UP:
          // určení aktuální hodnoty vlastnosti top pálky B a převedení 
          // hodnoty na celé číslo
        	var top = parseInt($("#paddleB").css("top"));
        	// posunutí pálky B o 5 pixelů nahoru
        	$("#paddleB").css("top",top-5);
        	break;
        case KEY.DOWN:
        	var top = parseInt($("#paddleB").css("top"));
        	// posunutí pálky B o 5 pixelů dolů
        	$("#paddleB").css("top",top+5);
        	break;
        case KEY.W:
        	var top = parseInt($("#paddleA").css("top"));
        	// posunutí pálky A o 5 pixelů nahoru
			$("#paddleA").css("top",top-5);
        	break;
        case KEY.S:
			var top = parseInt($("#paddleA").css("top"));
			// posunutí pálky A o 5 pixelů dolů
			$("#paddleA").css("top",top+5);
        	break;
      }
    });
});