// konstanty
var LINE_SEGMENT = 0;
var CHAT_MESSAGE = 1;
var GAME_LOGIC = 2;


// konstanty stavů hry
var WAITING_TO_START = 0;
var GAME_START = 1;
var GAME_OVER = 2;
var GAME_RESTART = 3;

var ws = require(__dirname + '/lib/ws/server');
var server = ws.createServer();

// index hráče, který má právě kreslit
var playerTurn = 0;

var wordsList = ['jablko','myšlenka','moudrost','vztek'];
var currentAnswer = undefined;

var currentGameState = WAITING_TO_START;

var gameOverTimeout;

server.addListener("connection", function(conn){
	// kód provedený po navázání spojení
	console.log("Navázáno spojení s identifikátorem",conn.id);
	var message = "Navázáno spojení "+conn.id+" se serverem. Celkový počet spojení:"+server.manager.length;
	var data = {};
	data.dataType = CHAT_MESSAGE;
	data.sender = "Server";
	data.message = message;	
	server.broadcast(JSON.stringify(data));
	
	// odeslání stavu hry všem hráčům
	var gameLogicData = {};
	gameLogicData.dataType = GAME_LOGIC;
	gameLogicData.gameState = WAITING_TO_START;
	server.broadcast(JSON.stringify(gameLogicData));
	
	// hra se spustí, pokud jsou připojeni alespoň dva hráči
	if (currentGameState == WAITING_TO_START && server.manager.length >= 2)
	{
		startGame();
	}
	
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
		
		// ověření správnosti odpovědi
		if (data.dataType == CHAT_MESSAGE)
		{
			if (currentGameState == GAME_START && data.message == currentAnswer)
			{
				var gameLogicData = {};
				gameLogicData.dataType = GAME_LOGIC;
				gameLogicData.gameState = GAME_OVER;
				gameLogicData.winner = conn.id;
				gameLogicData.answer = currentAnswer;
				server.broadcast(JSON.stringify(gameLogicData));
				
				currentGameState = WAITING_TO_START;
				
				// zrušení nastaveného časovače
				clearTimeout(gameOverTimeout);
			}
		}
		
		
		if (data.dataType == GAME_LOGIC && data.gameState == GAME_RESTART)
		{
			startGame();
		}
	});
});

function startGame()
{
	// výběr hráče, který má kreslit
	playerTurn = (playerTurn+1) % server.manager.length;	
	
	// náhodný výběr odpovědi
	var answerIndex = Math.floor(Math.random() * wordsList.length);
	currentAnswer = wordsList[answerIndex];
	
	// odeslání stavové zprávy o zahájení hry všem hráčům
	var gameLogicData1 = {};
	gameLogicData1.dataType = GAME_LOGIC;
	gameLogicData1.gameState = GAME_START;
	gameLogicData1.isPlayerTurn = false;
	server.broadcast(JSON.stringify(gameLogicData1));
	
	// odeslání stavové zprávy hráči, který má kreslit	
	var index = 0;	
	server.manager.forEach(function(connection){
		if (index == playerTurn)
		{
			var gameLogicData2 = {};
			gameLogicData2.dataType = GAME_LOGIC;
			gameLogicData2.gameState = GAME_START;
			gameLogicData2.answer = currentAnswer;
			gameLogicData2.isPlayerTurn = true;
			server.send(connection.id, JSON.stringify(gameLogicData2));
		}
		index++;						
	});
	
	// ukončení hry po uplynutí jedné minuty
	gameOverTimeout = setTimeout(function(){
		var gameLogicData = {};
		gameLogicData.dataType = GAME_LOGIC;
		gameLogicData.gameState = GAME_OVER;
		gameLogicData.winner = "Nikdo";
		gameLogicData.answer = currentAnswer;
		server.broadcast(JSON.stringify(gameLogicData));
		
		currentGameState = WAITING_TO_START;
	},60*1000);

	currentGameState = GAME_START;
}


server.listen(8000);

console.log("Server WebSocket je spuštěný.");
console.log("Server naslouchá na portu 8000.");
