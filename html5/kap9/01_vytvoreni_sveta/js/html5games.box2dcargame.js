// globální objekt obsahující nezbytné proměnné hry
var carGame = {	
}

var canvas;
var ctx;
var canvasWidth; 
var canvasHeight;
		
$(function() {
	
	carGame.world = createWorld();
	
	console.log("Svět byl vytvořen. ",carGame.world);
	
	// získání kontextu plátna
	canvas = document.getElementById('game');  
	ctx = canvas.getContext('2d');
	canvasWidth = parseInt(canvas.width);
	canvasHeight = parseInt(canvas.height);
});


function createWorld() {
	
	// nastavení rozměrů světa
	var worldAABB = new b2AABB();
	worldAABB.minVertex.Set(-4000, -4000);
	worldAABB.maxVertex.Set(4000, 4000);
	
	// nastavení gravitace
	var gravity = new b2Vec2(0, 300);
	
	// zakázání spánku objektů
	var doSleep = false;
	
  // vytvoření světa se zadanou velikostí, gravitací a zakázaným spánkem objektů
	var world = new b2World(worldAABB, gravity, doSleep);

	
	return world;
}

