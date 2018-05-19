// konstanty
var LINE_SEGMENT = 0;
var CHAT_MESSAGE = 1;

var ws = require(__dirname + '/lib/ws/server');
var server = ws.createServer();

server.addListener("connection", function(conn){
	// kód provedený po navázání spojení
	console.log("Navázáno spojení s identifikátorem",conn.id);
	var message = "Navázáno spojení "+conn.id+" se serverem. Celkový počet spojení:"+server.manager.length;
	var data = {};
	data.dataType = CHAT_MESSAGE;
	data.sender = "Server";
	data.message = message;
	
	server.broadcast(JSON.stringify(data));
	
	// obsluha příchozích zpráv
	conn.addListener("message", function(message){
		console.log("Obdržena zpráva '"+message+"' spojením "+conn.id);
		var data = JSON.parse(message);
		if (data.dataType == CHAT_MESSAGE)
		{
			// vložení informací o odesilateli do datového objektu
			data.sender = conn.id;
		}
		server.broadcast(JSON.stringify(data));
	});
});

server.listen(8000);

console.log("Server WebSocket je spuštěný.");
console.log("Server naslouchá na portu 8000.");
