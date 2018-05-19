$(function(){
	
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
				
	});	
});
