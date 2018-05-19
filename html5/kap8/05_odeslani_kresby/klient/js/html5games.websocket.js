var websocketGame = {
	// konstanty
	LINE_SEGMENT : 0,
	CHAT_MESSAGE : 1,

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
			// ověření zda se jedná o zprávu chatu anebo o data kresby
			console.log("událost message:",e.data);
			var data = JSON.parse(e.data);
			if (data.dataType == websocketGame.CHAT_MESSAGE)
			{
				$("#chat-history").append("<li>"+data.sender+" říká: "+data.message+"</li>");
			}
			else if (data.dataType == websocketGame.LINE_SEGMENT)
			{
				drawLine(ctx, data.startX, data.startY, data.endX, data.endY, 1);
			}
			
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
				
				// odeslání dat segmentu čáry serveru
				var data = {};
				data.dataType = websocketGame.LINE_SEGMENT;
				data.startX = websocketGame.startX;
				data.startY = websocketGame.startY;
				data.endX = mouseX;
				data.endY = mouseY;
				websocketGame.socket.send(JSON.stringify(data));
				
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
	
	// vložení zprávy do datového objektu
	var data = {};
	data.dataType = websocketGame.CHAT_MESSAGE;
	data.message = message;
	
	websocketGame.socket.send(JSON.stringify(data));
	$("#chat-input").val("");
}