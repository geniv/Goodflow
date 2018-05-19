var ws = require(__dirname + '/lib/ws/server');
var server = ws.createServer();

server.addListener("connection", function(conn){
	// kód provedený po navázání spojení
	console.log("Navázáno spojení s identifikátorem",conn.id);
	var message = "Navázáno spojení "+conn.id+" se serverem. Celkový počet spojení:"+server.manager.length;
	server.broadcast(message);
	
	// obsluha příchozích zpráv
	conn.addListener("message", function(message){
		console.log("Obdržena zpráva '"+message+"' spojením "+conn.id);
	});
});

server.listen(8000);

console.log("Server WebSocket je spuštěný.");
console.log("Server naslouchá na portu 8000.");
