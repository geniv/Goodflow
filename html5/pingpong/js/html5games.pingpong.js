//html5games.pingpong.js

/*
var pingpong = {
  scoreA: 0,
  scoreB: 0
};

pingpong.pressedKeys = [];

pingpong.ball = {
  speed: 5,
  x: 150,
  y: 100,
  directionX: 1,
  directionY: 1
}


//konstanty klaves
var KEY = {
  UP: 38,
  DOWN: 40,
  W: 87,
  S: 83
}

$(function() {
  pingpong.timer = setInterval(gameloop, 30);

  $(document).keydown(function(e) {
    pingpong.pressedKeys[e.which] = true;
  });
  $(document).keyup(function(e) {
    pingpong.pressedKeys[e.which] = false;
  });
});

//herni symcka
function gameloop() {
  movePaddles();
  moveBall();
}

//obsluha pohybu palek
function movePaddles() {
  var playground = $('#playground');
  var playgroundHeight = parseInt(playground.height());
  var playgroundWidth = parseInt(playground.width());
//FIXME spatne meze
  var paddleA = $('#paddleA');
  var paddleB = $('#paddleB');

  //nahoru A
  if (pingpong.pressedKeys[KEY.W]) {
    var top = parseInt(paddleA.css('top'));
    //ochrana proti prelezani za platno
    if (top > 0) {
      paddleA.css('top', top - 5);
    }
  }

  //dolu A
  if (pingpong.pressedKeys[KEY.S]) {
    var top = parseInt(paddleA.css('top'));
    //ochrana proti prelezani za platno
    if (top + paddleA.height() < playgroundHeight) {
      paddleA.css('top', top + 5);
    }
  }

  //nahoru B
  if (pingpong.pressedKeys[KEY.UP]) {
    var top = parseInt(paddleB.css('top'));
    //ochrana proti prelezani za platno
    if (top > 0) {
      paddleB.css('top', top - 5);
    }
  }

  //dolu B
  if (pingpong.pressedKeys[KEY.DOWN]) {
    var top = parseInt(paddleB.css('top'));
    //ochrana proti prelezani za platno
    if (top + paddleB.height() < playgroundHeight) {
      paddleB.css('top', top + 5);
    }
  }
}

//obsluha pohybu micku
function moveBall() {
  var playground = $('#playground');
  var playgroundHeight = parseInt(playground.height());
  var playgroundWidth = parseInt(playground.width());
  var ball = pingpong.ball;

  //horni hrana
  if (ball.y + ball.speed * ball.directionY < 0) {
   ball.directionY = 1;
  }

  //dolni hrana
  if (ball.y + getBallHeight() + ball.speed * ball.directionY > playgroundHeight) {
    ball.directionY = -1;
  }

  //leva hrana
  if (ball.x + ball.speed * ball.directionX < 0) {
    //hrac A prohral
    ball.x = 150;
    ball.y = 100;
    setBall(ball.x, ball.y);
    pingpong.scoreB++;
    $('#scoreB').html(pingpong.scoreB);

    ball.directionX = 1;
  }

  //prava hrana
  if (ball.x + getBallWidth() + ball.speed * ball.directionX > playgroundWidth) {
    //hrac B probral
    ball.x = 250;
    ball.y = 100;
    setBall(ball.x, ball.y);
    pingpong.scoreA++;
    $('#scoreA').html(pingpong.scoreA);

    ball.directionX = -1;
  }

  ball.x += ball.speed * ball.directionX;
  ball.y += ball.speed * ball.directionY;

  //vyhodnoceni palek
  var paddleA = $('#paddleA');
  var paddleB = $('#paddleB');
  //leva palka
  var paddleAX = parseInt(paddleA.css('left')) + parseInt(paddleA.css('width'));
  var paddleAYBottom = parseInt(paddleA.css('top')) + parseInt(paddleA.css('height'));
  var paddleAYTop = parseInt(paddleA.css('top'));

  if (ball.x + ball.speed * ball.directionX < paddleAX) {
    if (ball.y + ball.speed * ball.directionY <= paddleAYBottom &&
        ball.y + ball.speed * ball.directionY >= paddleAYTop) {
      ball.directionX = 1;
    }
  }

  //prava palka
  var paddleBX = parseInt(paddleB.css('left'));
  var paddleBYBottom = parseInt(paddleB.css('top')) + parseInt(paddleB.css('height'));
  var paddleBYTop = parseInt(paddleB.css('top'));

  if (ball.x + getBallWidth() + ball.speed * ball.directionX >= paddleBX) {
    if (ball.y + ball.speed * ball.directionY <= paddleBYBottom &&
        ball.y + ball.speed * ball.directionY >= paddleBYTop) {
      ball.directionX = -1;
    }
  }

  setBall(ball.x, ball.y);
}

function getBallWidth() {
  return $('#ball').width();
}

function getBallHeight() {
  return $('#ball').height();
}

function setBall(x, y) {
  //pohyb micku
  $('#ball').css({
    'left': x,
    'top': y
  });
}
*/

/*
//test node.js a websocket:
var websocketGame = {};

$(function() {
  if (window["WebSocket"]) {
    websocketGame.socket = new WebSocket("ws://gfdesign.cz:8000");
    //obsluha open
    websocketGame.socket.onopen = function () {
      console.log('spojeni navazano');
    };

    //obsluha message
    websocketGame.socket.onmessage = function(e) {
      console.log(e.data);
    };

    //obsluha close
    websocketGame.socket.onclose = function(e) {
      console.log('spojeni ukonceno');
    };
  }

  $('#send').click(sendMessage);

  $('#chat-input').keypress(function(event) {
    if (event.keyCode == '13') {
      sendMessage();
    }
  });

});



function sendMessage() {
	var message = $("#chat-input").val();
	websocketGame.socket.send(message);
	$("#chat-input").val("");
}
*/

var websocketGame = {
}


// init script when the DOM is ready.
$(function(){
	// check if existence of WebSockets in browser
	if (window["WebSocket"]) {

		// create connection
		//websocketGame.socket = new WebSocket("ws://www.gfdesign.cz:8000");
    websocketGame.socket = new WebSocket("ws://88.83.251.187:8000");

		// on open event
		websocketGame.socket.onopen = function(e) {
			console.log('WebSocket connection otevreno.');
		};

		// on message event
		websocketGame.socket.onmessage = function(e) {
			$("#chat-history").append("<li>"+e.data+"</li>");
		};

		// on close event
		websocketGame.socket.onclose = function(e) {
			console.log('WebSocket connection closed.');
		};

  $("#send").click(sendMessage);

  $("#chat-input").keypress(function(event) {
    if (event.keyCode == '13') {
      sendMessage();
    }
  });

  function sendMessage()
  {
    var message = $("#chat-input").val();
    websocketGame.socket.send(message);
    $("#chat-input").val("");
  }

	}

});




























