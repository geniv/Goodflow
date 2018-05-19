var carGame = {	
}

var canvas;
var ctx;
var canvasWidth; 
var canvasHeight;
		
$(function() {
	
	
	// obsluha události stisknutí klávesy
	$(document).keydown(function(e){			
		switch(e.keyCode) {
			case 88: // klávesa X aplikuje na auto sílu směřující vpravo
				var force = new b2Vec2(10000000, 0);
				carGame.car.ApplyForce(force, carGame.car.GetCenterPosition());
				break;
			case 90: // klávesa Z aplikuje na auto sílu směřující vlevo
				var force = new b2Vec2(-10000000, 0);
				carGame.car.ApplyForce(force, carGame.car.GetCenterPosition());
				break;
			case 82: // klávesa R restartuje hru
				restartGame();
				break;
		}
	});
	
	
	
	// spuštění hry
	restartGame();
	
	
	console.log("Svět byl vytvořen. ", carGame.world);
	
	// získání kontextu plátna
	canvas = document.getElementById('game');  
	ctx = canvas.getContext('2d');
	canvasWidth = parseInt(canvas.width);
	canvasHeight = parseInt(canvas.height);
	
	// zahájení plynutí času
	step();

});


function step() {
	carGame.world.Step(1.0/60, 1);
	ctx.clearRect(0, 0, canvasWidth, canvasHeight);
	
	drawWorld(carGame.world, ctx);
	
	setTimeout(step, 10);
	
	
	// průchod přes všechny položky seznamu kolizí
	for (var cn = carGame.world.GetContactList(); cn != null; cn = cn.GetNext())
	{				
		var body1 = cn.GetShape1().GetBody();
		var body2 = cn.GetShape2().GetBody();
		// ověření, zda auto narazilo do cílového objektu
		if ((body1 == carGame.car && body2 == carGame.gamewinWall) ||
			(body2 == carGame.car && body1 == carGame.gamewinWall))
		{
			console.log("Úroveň dokončena!");
			restartGame();	
		}
		
	}
}

function restartGame()
{
	// vytvoření světa
	carGame.world = createWorld();
	
	// vytvoření země
	createGround(250, 270, 250, 25, 0);
	
	// vytvoření rampy
	createGround(500, 250, 65, 15, -10);
	createGround(600, 225, 80, 15, -20);
	createGround(1100, 250, 100, 15, 0);
	
	// vytvoření cíle
	carGame.gamewinWall = createGround(1200, 215, 15, 25, 0);
	
	
	// vytvoření auta
	carGame.car = createCarAt(50, 210);
}

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

function createGround(x, y, width, height, rotation) {
	// definice tvaru
	var groundSd = new b2BoxDef();
	groundSd.extents.Set(width, height);
	groundSd.restitution = 0.4;
	
	// definice objektu se zadaným tvarem
	var groundBd = new b2BodyDef();
	groundBd.AddShape(groundSd);
	groundBd.position.Set(x, y);
	groundBd.rotation = rotation * Math.PI / 180;
	var body = carGame.world.CreateBody(groundBd);
	
	return body;
}

function createCarAt(x, y) {
	// definice tvaru auta
	var boxSd = new b2BoxDef();
	boxSd.density = 1.0;
	boxSd.friction = 1.5;
	boxSd.restitution = .4;
	boxSd.extents.Set(40, 20);
	
	// definice objektu auta
	var boxBd = new b2BodyDef();
	boxBd.AddShape(boxSd);
	boxBd.position.Set(x,y);		
	var carBody = carGame.world.CreateBody(boxBd);
	
	// vytvoření kol
	var wheelBody1 = createWheel(carGame.world, x-25, y+20);
	var wheelBody2 = createWheel(carGame.world, x+25, y+20);
	
	// spojení levého kola s objektem auta
	var jointDef = new b2RevoluteJointDef();
	jointDef.anchorPoint.Set(x-25, y+20);
	jointDef.body1 = carBody;
	jointDef.body2 = wheelBody1;
	carGame.world.CreateJoint(jointDef);
	
	// spojení pravého kola s objektem auta
	var jointDef = new b2RevoluteJointDef();
	jointDef.anchorPoint.Set(x+25, y+20);
	jointDef.body1 = carBody;
	jointDef.body2 = wheelBody2;
	carGame.world.CreateJoint(jointDef);
	
	return carBody;
				
}

function createWheel(world, x, y) {
	// definice tvaru
	var ballSd = new b2CircleDef();
	ballSd.density = 1.0;
	ballSd.radius = 10;
	ballSd.restitution = 0.1;
	ballSd.friction = 4.3;
	
	// definice objektu
	var ballBd = new b2BodyDef();
	ballBd.AddShape(ballSd);
	ballBd.position.Set(x,y);
	return world.CreateBody(ballBd);
}



// funkce pro nakreslení světa
function drawWorld(world, context) {
	for (var b = world.m_bodyList; b != null; b = b.m_next) {
		for (var s = b.GetShapeList(); s != null; s = s.GetNext()) {
			drawShape(s, context);
		}
	}
}

// funkce pro nakreslení tvaru
function drawShape(shape, context) {
	context.strokeStyle = '#003300';
	context.beginPath();
	switch (shape.m_type) {
	case b2Shape.e_circleShape:
		var circle = shape;
		var pos = circle.m_position;
		var r = circle.m_radius;
		var segments = 16.0;
		var theta = 0.0;
		var dtheta = 2.0 * Math.PI / segments;
		// nakreslení kružnice
		context.moveTo(pos.x + r, pos.y);
		for (var i = 0; i < segments; i++) {
			var d = new b2Vec2(r * Math.cos(theta), r * Math.sin(theta));
			var v = b2Math.AddVV(pos, d);
			context.lineTo(v.x, v.y);
			theta += dtheta;
		}
		context.lineTo(pos.x + r, pos.y);

		// nakreslení poloměru
		context.moveTo(pos.x, pos.y);
		var ax = circle.m_R.col1;
		var pos2 = new b2Vec2(pos.x + r * ax.x, pos.y + r * ax.y);
		context.lineTo(pos2.x, pos2.y);
		break;
	case b2Shape.e_polyShape:
		var poly = shape;
		var tV = b2Math.AddVV(poly.m_position, b2Math.b2MulMV(poly.m_R, poly.m_vertices[0]));
		context.moveTo(tV.x, tV.y);
		for (var i = 0; i < poly.m_vertexCount; i++) {
			var v = b2Math.AddVV(poly.m_position, b2Math.b2MulMV(poly.m_R, poly.m_vertices[i]));
			context.lineTo(v.x, v.y);
		}
		context.lineTo(tV.x, tV.y);
		break;
	}
	context.stroke();
}

