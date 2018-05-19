function clear(ctx) {	
	ctx.clearRect(0,0,ctx.canvas.width,ctx.canvas.height); 
}

function Circle(x,y,radius){
	this.x = x;
	this.y = y;
	this.radius = radius;
}

function Line(startPoint,endPoint, thickness) {
	this.startPoint = startPoint;
	this.endPoint = endPoint;
	this.thickness = thickness;
}

var untangleGame = {
	circles: [],
	thinLineThickness: 1,
	boldLineThickness: 5,
	lines: [],
	currentLevel: 0
};

untangleGame.levels = 
[
	{
		"level" : 0,
		"circles" : [{"x" : 400, "y" : 156},
					{"x" : 381, "y" : 241},
					{"x" : 84, "y" : 233},
					{"x" : 88, "y" : 73}],
		"relationship" : {
							"0" : {"connectedPoints" : [1,2]},
							"1" : {"connectedPoints" : [0,3]},
							"2" : {"connectedPoints" : [0,3]},
							"3" : {"connectedPoints" : [1,2]}
						  }				  
	},
	{
		"level" : 1,
		"circles" : [{"x" : 401, "y" : 73},
					{"x" : 400, "y" : 240},
					{"x" : 88, "y" : 241},
					{"x" : 84, "y" : 72}],
		"relationship" : {
							"0" : {"connectedPoints" : [1,2,3]},
							"1" : {"connectedPoints" : [0,2,3]},
							"2" : {"connectedPoints" : [0,1,3]},
							"3" : {"connectedPoints" : [0,1,2]}
						  }				  
	},
	{
		"level" : 2,
		"circles" : [{"x" : 92, "y" : 85},
					{"x" : 253, "y" : 13},
					{"x" : 393, "y" : 86},
					{"x" : 390, "y" : 214},
					{"x" : 248, "y" : 275},
					{"x" : 95, "y" : 216}],
		"relationship" : {
							"0" : {"connectedPoints" : [2,3,4]},
							"1" : {"connectedPoints" : [3,5]},
							"2" : {"connectedPoints" : [0,4,5]},
							"3" : {"connectedPoints" : [0,1,5]},
							"4" : {"connectedPoints" : [0,2]},
							"5" : {"connectedPoints" : [1,2,3]}
						  }				  
	}
];

function setupCurrentLevel() {
	untangleGame.circles = [];
	var level = untangleGame.levels[untangleGame.currentLevel];
	for (var i=0; i<level.circles.length; i++) {
		untangleGame.circles.push(new Circle(level.circles[i].x, level.circles[i].y, 10));
	}
	
	// vytvoření čar propojujících kruhy
  connectCircles();
	updateLineIntersection();
}

function checkLevelCompleteness() {
	if ($("#progress").html() == "100") {
		if (untangleGame.currentLevel+1 < untangleGame.levels.length)
			untangleGame.currentLevel++;
		setupCurrentLevel();
	}
}

function drawLine(ctx, x1, y1, x2, y2, thickness) {		
	ctx.beginPath();
	ctx.moveTo(x1,y1);
	ctx.lineTo(x2,y2);
	ctx.lineWidth = thickness;
	ctx.strokeStyle = "#cfc";
	ctx.stroke();
}

function drawCircle(ctx, x, y, radius) {
	ctx.fillStyle = "rgba(200, 200, 100, .9)";
	ctx.beginPath();
	ctx.arc(x, y, radius, 0, Math.PI*2, true); 
	ctx.closePath();
	ctx.fill();
}

$(function(){		 			
	var canvas = document.getElementById("game");  
	var ctx = canvas.getContext("2d");
	
	setupCurrentLevel();	
	updateLevelProgress();
	
  // zde začíná obsluha událostí myši
  // určíme, jestli došlo ke klepnutí na některý z kruhů 
  // zobrazený na plátně a pokud ano, nastavíme kruh jako cílový pro 
  // další práci s myší
	    $("#game").mousedown(function(e) {
	    	var canvasPosition = $(this).offset();
	    	var mouseX = e.layerX || 0;
	    	var mouseY = e.layerY || 0;
	    	
			for(var i=0;i<untangleGame.circles.length;i++)
			{
				var circleX = untangleGame.circles[i].x;
				var circleY = untangleGame.circles[i].y;
				var radius = untangleGame.circles[i].radius;
				if (Math.pow(mouseX-circleX,2) + Math.pow(mouseY-circleY,2) < Math.pow(radius,2))
				{
					untangleGame.targetCircle = i;
					break;
				}
			}
	    });
	    
	    // společně s pohybem myši se přesunuje cílový kruh
	    $("#game").mousemove(function(e) {
	    	if (untangleGame.targetCircle != undefined)
	    	{
				var canvasPosition = $(this).offset();
				var mouseX = e.layerX || 0;
				var mouseY = e.layerY || 0;
				var radius = untangleGame.circles[untangleGame.targetCircle].radius;
				untangleGame.circles[untangleGame.targetCircle] = new Circle(mouseX, mouseY, radius);	
				
				connectCircles();
				updateLineIntersection();
				updateLevelProgress();				    	
	    	}
	    });
	    
	    // po uvolnění tlačítka myši se zruší nastavení cílového kruhu
	    $("#game").mouseup(function(e) {    	
	       	untangleGame.targetCircle = undefined;    	
	       	
          // při každém uvolnění tlačítka myši se ověří, jestli hráč 
          // dokončil aktuální úroveň hry
	       	checkLevelCompleteness();
	    });
	    
	    
	    // nastavení intervalu herní smyčky
	    setInterval(gameloop, 30);	
});

function connectCircles()
{
	// propojení kruhů čarami na základě výchozích dat úrovně
	var level = untangleGame.levels[untangleGame.currentLevel];
	untangleGame.lines.length = 0;
	for (var i in level.relationship) {
		var connectedPoints = level.relationship[i].connectedPoints;
		var startPoint = untangleGame.circles[i];
		for (var j in connectedPoints) {
			var endPoint = untangleGame.circles[connectedPoints[j]];
			untangleGame.lines.push(new Line(startPoint, endPoint));
		}
	}
}

function updateLineIntersection()
{
	// cyklus přes jednotlivé čáry
	for (var i=0;i<untangleGame.lines.length;i++) {
		var line1 = untangleGame.lines[i];
		line1.thickness = untangleGame.thinLineThickness;
		for(var j=0;j<i;j++) {	
			var line2 = untangleGame.lines[j];
			
			// pokud se čáry protínají, zobrazíme je tučně 
			if (isIntersect(line1, line2)) {
				line1.thickness = untangleGame.boldLineThickness;
				line2.thickness = untangleGame.boldLineThickness;
			}			
		}
	}
}

function updateLevelProgress()
{
	// určení postupu v rámci úrovně
	var progress = 0;
	for (var i=0;i<untangleGame.lines.length;i++) {
		if (untangleGame.lines[i].thickness == untangleGame.thinLineThickness) {
			progress++;
		}
	}
	var progressPercentage = Math.floor(progress/untangleGame.lines.length*100);
	$("#progress").html(progressPercentage);
	
	// zobrazení aktuální úrovně
	$("#level").html(untangleGame.currentLevel);
}

function gameloop() {	
	// získání objektu plátna a jeho kontextu
	var canvas = document.getElementById("game");  
	var ctx = canvas.getContext("2d"); 				
	
	// vymazání obsahu plátna
	clear(ctx);
	
	// nakreslení uložených čar
	for(var i=0;i<untangleGame.lines.length;i++) {
		var line = untangleGame.lines[i];
		var startPoint = line.startPoint;
		var endPoint = line.endPoint;
		var thickness = line.thickness;
		drawLine(ctx, startPoint.x, startPoint.y, endPoint.x, endPoint.y, thickness);
	}
	
	// nakreslení uložených kruhů
	for(var i=0;i<untangleGame.circles.length;i++) {
		var circle = untangleGame.circles[i];
		drawCircle(ctx, circle.x, circle.y, circle.radius);
	}
}



function isIntersect(line1, line2)
{
	// převedení první přímky do obecného tvaru: Ax+By = C
	var a1 = line1.endPoint.y - line1.startPoint.y;
	var b1 = line1.startPoint.x - line1.endPoint.x;
	var c1 = a1 * line1.startPoint.x + b1 * line1.startPoint.y;
	
	// převedení druhé přímky do obecného tvaru: Ax+By = C
	var a2 = line2.endPoint.y - line2.startPoint.y;
	var b2 = line2.startPoint.x - line2.endPoint.x;
	var c2 = a2 * line2.startPoint.x + b2 * line2.startPoint.y;
	
	// výpočet průsečíku		
	var d = a1*b2 - a2*b1;
	
	// pokud má proměnná d hodnotu 0, jsou přímky rovnoběžné
	if (d == 0) {
		return false;
	}else {
		var x = (b2*c1 - b1*c2) / d;
		var y = (a1*c2 - a2*c1) / d;
					
		// ověří se, jestli průsečík leží na obou úsečkách
		if ((isInBetween(line1.startPoint.x, x, line1.endPoint.x) || isInBetween(line1.startPoint.y, y, line1.endPoint.y)) &&
			(isInBetween(line2.startPoint.x, x, line2.endPoint.x) || isInBetween(line2.startPoint.y, y, line2.endPoint.y))) 
		{
			return true;	
		}
	}
	
	return false;
}

// vrací true, pokud se b nachází mezi a a c
// v případě a==b nebo b==c vrací false
function isInBetween(a, b, c) {
  // vrátí false pokud je b téměř rovno a nebo c
  // eliminuje se tak možná nepřesnost při práci s desetinnými 
  // čísly, které se od sebe liší jen o 0.00000...0001
	if (Math.abs(a-b) < 0.000001 || Math.abs(b-c) < 0.000001) {
		return false;
	}
	
	// vrátí true pokud je b mezi a a c
	return (a < b && b < c) || (c < b && b < a);
}

