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
	// zamíchání balíčku karet
  matchingGame.deck.sort(shuffle);
	
	// vytvoření 12ti karet
	for(var i=0;i<11;i++){
		$(".card:first-child").clone().appendTo("#cards");
	}
	
	// nastavení pozice karet
	$("#cards").children().each(function(index) {		
		// zarovnání karet do mřížky 4x3
		$(this).css({
			"left" : ($(this).width()  + 20) * (index % 4),
			"top"  : ($(this).height() + 20) * Math.floor(index / 4)
		});
		
		// získání obrázku karty ze zamíchaného balíčku
		var pattern = matchingGame.deck.pop();
		
		// nastavení obrázku zadní strany karty
		$(this).find(".back").addClass(pattern);
		
		// uložení informace o obrázku karty do elementu
		$(this).attr("data-pattern",pattern);
						
		// nastavení obsluhy klepnutí myší na element karty
		$(this).click(selectCard);				
	});	
});

function selectCard() {
	// pokud jsou otočené dvě karty, neprovádí se žádné další akce
	if ($(".card-flipped").size() > 1)
	{
		return;
	}
	
	$(this).addClass("card-flipped");
	
	// o 0.7s později se ověří, jestli se otočené karty shodují
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
}

function isMatchPattern()
{
	var cards = $(".card-flipped");
	var pattern = $(cards[0]).data("pattern");
	var anotherPattern = $(cards[1]).data("pattern");
	return (pattern == anotherPattern);
}

