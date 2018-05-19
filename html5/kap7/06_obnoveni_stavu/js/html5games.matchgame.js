var matchingGame = {};

matchingGame.savingObject = {};
matchingGame.savingObject.deck = [];

// pole s indexy odstraněných karet
matchingGame.savingObject.removedCards = [];

// uložení uplynulého času
matchingGame.savingObject.currentElapsedTime = 0;


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
	
	// obnovení uloženého balíčku
	var savedObject = savedSavingObject();
	if (savedObject != undefined)
	{
		matchingGame.deck = savedObject.deck;
	}
	
	// zkopírování balíčku do objektu savingObject
	matchingGame.savingObject.deck = matchingGame.deck.slice();
	
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
		
		// uložení indexu do elementu
		$(this).attr("data-card-index",index);
						
		$(this).click(selectCard);				
	});
	
  // odstranění karet, které jsou v objektu savedObject uvedené jako odstraněné
	if (savedObject != undefined)
	{
		matchingGame.savingObject.removedCards = savedObject.removedCards; 
		// vyhledání karet a jejich odstranění
		for(var i in matchingGame.savingObject.removedCards)
		{			
			$(".card[data-card-index="+matchingGame.savingObject.removedCards[i]+"]").remove();
		}
	}

	// nastavení uplynulého času na nulu
	matchingGame.elapsedTime = 0;
	
	// obnovení uloženého uplynulého času
	if (savedObject != undefined)
	{
		matchingGame.elapsedTime = savedObject.currentElapsedTime; 
		matchingGame.savingObject.currentElapsedTime = savedObject.currentElapsedTime;
	}
			
	// nastavení časovače
	matchingGame.timer = setInterval(countTimer, 1000);

});

function countTimer()
{

	matchingGame.elapsedTime++;
	
	// uložení uplynulého času do objektu savingObject
	matchingGame.savingObject.currentElapsedTime = matchingGame.elapsedTime;
		
	// určení uplynulého počtu minut a sekund
	var minute = Math.floor(matchingGame.elapsedTime / 60);
	var second = matchingGame.elapsedTime % 60;	
	
  // připojení předřadných nul pokud je počet minut nebo sekund menší jak 10
	if (minute < 10) minute = "0" + minute;
	if (second < 10) second = "0" + second;
	
	// zobrazení uplynulého času
	$("#elapsed-time").html(minute+":"+second);
	
	// uložení postupu ve hře
	saveSavingObject();
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
	// vložení všech odstraněných karet do pole
	$(".card-removed").each(function(){
		matchingGame.savingObject.removedCards.push($(this).data("cardIndex"));
		$(this).remove();
	});		
	
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
	
	// načtení předchozího skóre a času uložení z lokálního úložiště
	var lastScore = localStorage.getItem("last-score");
	
	// ověření existence uložené hodnoty
	lastScoreObj = JSON.parse(lastScore);
	if (lastScoreObj == null)
	{
		// pokud se v úložišti hodnota nenachází, vytvoří se prázdný objekt
		lastScoreObj = {"savedTime": "žádný záznam", "score": 0};
	}	
	var lastElapsedTime = lastScoreObj.score;
		
	if (lastElapsedTime == 0 || matchingGame.elapsedTime < lastElapsedTime)
	{
		$(".ribbon").removeClass("hide");
	}
		
	// převedení uplynulého času v sekundách do formátu minuty:sekundy
	var minute = Math.floor(lastElapsedTime / 60);
	var second = lastElapsedTime % 60;	
	
	// připojení předřadných nul pokud je počet minut nebo sekund menší jak 10
	if (minute < 10) minute = "0" + minute;
	if (second < 10) second = "0" + second;
	
	// zobrazení předchozího skóre v závěrečném dialogu	
	$(".last-score").html(minute+":"+second);
	
	// zobrazení času uložení předchozího skóre
	var savedTime = lastScoreObj.savedTime;
	$(".saved-time").html(savedTime);
	
	// určení aktuálního data a času
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var day = currentTime.getDate();
	var year = currentTime.getFullYear();
	var hours = currentTime.getHours();
	var minutes = currentTime.getMinutes();
	// připojení předřadné nuly k minutám
	if (minutes < 10) minutes = "0" + minutes;
	var seconds = currentTime.getSeconds();
	// připojení předřadné nuly k sekundám
	if (seconds < 10) seconds = "0" + seconds;
	
	var now = day+"/"+month+"/"+year+" "+hours+":"+minutes+":"+seconds;
	
	// vytvoření objektu obsahujícího datum, čas a skóre
	var obj = { "savedTime": now, "score": matchingGame.elapsedTime};
	
	// uložení skóre do lokálního úložiště
	localStorage.setItem("last-score", JSON.stringify(obj));
	
	// zobrazení závěrečného dialogu
	$("#popup").removeClass("hide");
	
	// odstranění uloženého objektu savingObject
	localStorage.removeItem("savingObject");
}

function saveSavingObject()
{
	// uložení objektu savingObject do lokálního úložiště
	localStorage["savingObject"] = JSON.stringify(matchingGame.savingObject);
}

// funkce vrací objekt savingObject uložený v lokálním úložišti
function savedSavingObject()
{
	var savingObject = localStorage["savingObject"];
	if (savingObject != undefined)
	{
		savingObject = JSON.parse(savingObject);
	}
	return savingObject;
}
