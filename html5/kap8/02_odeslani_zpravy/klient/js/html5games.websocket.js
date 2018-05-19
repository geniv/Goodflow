
var websocketGame = {
}

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
			console.log(e.data);
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
	
});

function sendMessage()
{
	var message = $("#chat-input").val();
	websocketGame.socket.send(message);
	$("#chat-input").val("");
}