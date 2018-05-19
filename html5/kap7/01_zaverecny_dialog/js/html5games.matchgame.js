var matchingGame = {};
matchingGame.deck = [
	'cardAK', 'cardAK',
	'cardAQ', 'cardAQ',
	'cardAJ', 'cardAJ',
	'cardBK', 'cardBK',
	'cardBQ', 'cardBQ',
	'cardBJ', 'cardBJ',	
];

$(function(){		
	matchingGame.deck.sort(shuffle);
	
	for(var i=0;i<11;i++){
		$(".card:first-child").clone().appendTo("#cards");
	}
	
	$("#cards").children().each(function(index) {		
		$(this).css({
			"left" : ($(this).width()  + 20) * (index % 4),
			"top"  : ($(this).height() + 20) * Math.floor(index / 4)
		});
		
		var pattern = matchingGame.deck.pop();
		
		$(this).find(".back").addClass(pattern);
		
		$(this).data("pattern",pattern);
						
		$(this).click(selectCard);				
	});	

	// nastavení uplynulého času na nulu
	matchingGame.elapsedTime = 0;
			
	// nastavení časovače
	matchingGame.timer = setInterval(countTimer, 1000);

});

function countTimer()
{
	matchingGame.elapsedTime++;
	
	// určení uplynulého počtu minut a sekund
	var minute = Math.floor(matchingGame.elapsedTime / 60);
	var second = matchingGame.elapsedTime % 60;	
	
  // připojení předřadných nul pokud je počet minut nebo sekund menší jak 10
	if (minute < 10) minute = "0" + minute;
	if (second < 10) second = "0" + second;
	
	// zobrazení uplynulého času
	$("#elapsed-time").html(minute+":"+second);
}

function selectCard() {
	if ($(".card-flipped").size() > 1)
	{
		return;
	}
	
	$(this).addClass("card-flipped");
	
	if ($(".card-flipped").size() == 2)
	{
		setTimeout(checkPattern,700);
	}
}

function shuffle()
{
	return 0.5 - Math.random();
}

function checkPattern()
{
	if (isMatchPattern())
	{
		$(".card-flipped").removeClass("card-flipped").addClass("card-removed");
		
		$(".card-removed").bind("webkitTransitionEnd", removeTookCards);
	}
	else
	{
		$(".card-flipped").removeClass("card-flipped");
	}
}

function removeTookCards()
{
	$(".card-removed").remove();
	
	// pokud byly odstraněny všechny karty, zobrazí se závěrečný dialog
	if ($(".card").length == 0)
	{
		gameover();
	}
	
}

function isMatchPattern()
{
	var cards = $(".card-flipped");
	var pattern = $(cards[0]).data("pattern");
	var anotherPattern = $(cards[1]).data("pattern");
	return (pattern == anotherPattern);
}


function gameover()
{
	// zrušení časovače 
	clearInterval(matchingGame.timer);
	
	// vložení skóre do závěrečného dialogu
	$(".score").html($("#elapsed-time").html());
		
	// zobrazení závěrečného dialogu
	$("#popup").removeClass("hide");
}