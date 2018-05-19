
var websocketGame = {
	// příznak kreslení
	isDrawing : false,

	// počáteční bod další kreslené čáry
	startX : 0,
	startY : 0,
}

// kontext plátna
var canvas = document.getElementById('drawing-pad');
var ctx = canvas.getContext('2d');

// obsluha události ready
$(function(){
	// ověření podpory rozhraní WebSocket prohlížečem
	if (window["WebSocket"]) {
		
		// vytvoření spojení
		websocketGame.socket = new WebSocket("ws://127.0.0.1:8000");
		
		// obsluha události open
		websocketGame.socket.onopen = function(e) {
			console.log('Spojení navázáno.');
		};
		
		// obsluha události message
		websocketGame.socket.onmessage = function(e) {
			$("#chat-history").append("<li>"+e.data+"</li>");
		};
		
		// obsluha události close
		websocketGame.socket.onclose = function(e) {
			console.log('Spojení ukončeno.');
		};		
	}
	
	$("#send").click(sendMessage);
	
	$("#chat-input").keypress(function(event) {  
		if (event.keyCode == '13') {  
			sendMessage();  
		}  
	});
	
	
	// kód umožňující kreslení na plátně
	$("#drawing-pad").mousedown(function(e) {
		// určení souřadnic kurzoru myši vzhledem k levému hornímu rohu plátna
    var mouseX = e.layerX || 0;
    var mouseY = e.layerY || 0;	
    	
		websocketGame.startX = mouseX;
		websocketGame.startY = mouseY;

		websocketGame.isDrawing = true;
    });
    
    $("#drawing-pad").mousemove(function(e) {
		  // nakreslení čáry
    	if (websocketGame.isDrawing) {
			  // určení souřadnic kurzoru myši vzhledem k levému hornímu rohu plátna
	    	var mouseX = e.layerX || 0;
	    	var mouseY = e.layerY || 0;	
	
			if (!(mouseX == websocketGame.startX && mouseY == websocketGame.startY))
			{				
				drawLine(ctx,websocketGame.startX,websocketGame.startY,mouseX,mouseY,1);
				
				websocketGame.startX = mouseX;
				websocketGame.startY = mouseY;
			}	
		}
    });

    $("#drawing-pad").mouseup(function(e) {
		  websocketGame.isDrawing = false;
    });
	
});

function drawLine(ctx, x1, y1, x2, y2, thickness) {		
	ctx.beginPath();
	ctx.moveTo(x1,y1);
	ctx.lineTo(x2,y2);
	ctx.lineWidth = thickness;
	ctx.strokeStyle = "#444";
	ctx.stroke();
}

function sendMessage()
{
	var message = $("#chat-input").val();
	websocketGame.socket.send(message);
	$("#chat-input").val("");
}