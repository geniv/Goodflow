// globální objekt pro uložení proměnných hry
var audiogame = {};

// obsluha události ready
$(function(){	
	// načtení elementů audio
	audiogame.buttonOverSound = document.getElementById("buttonover");
	audiogame.buttonOverSound.volume = .3;
	audiogame.buttonActiveSound = document.getElementById("buttonactive");
	audiogame.buttonActiveSound.volume = .3;
	
	// nastavení obsluhy událostí odkazu s identifikátorem game
	$("a[href='#game']")
	.hover(function(){
		audiogame.buttonOverSound.currentTime = 0;		
		audiogame.buttonOverSound.play();	
	},function(){
		audiogame.buttonOverSound.pause();	
	})
	.click(function(){
		audiogame.buttonActiveSound.currentTime = 0;
		audiogame.buttonActiveSound.play();
		
		return false;
	});
	
	drawBackground();
});



function drawBackground()
{
	// získání objektu plátna a jeho kontextu
	var game = document.getElementById("game-background-canvas");
	var ctx = game.getContext('2d');
		
	// nastavení stylu třech vertikálních čar
	ctx.lineWidth = 10;
	ctx.strokeStyle = "#000";
	
	var center = game.width/2;
	
  // nakreslení třech čar
  // první čára se nachází 100 pixelů nalevo od středu
	ctx.beginPath();
	ctx.moveTo(center-100, 50);
	ctx.lineTo(center-100, ctx.canvas.height - 50);		
	ctx.stroke();
	
  // druhá čára se nachází uprostřed
	ctx.beginPath();
	ctx.moveTo(center, 50);
	ctx.lineTo(center, ctx.canvas.height - 50);
	ctx.stroke();
	
	// třetí čára se nachází 100 pixelů napravo od středu
	ctx.beginPath();
	ctx.moveTo(center+100, 50);
	ctx.lineTo(center+100, ctx.canvas.height - 50);
	ctx.stroke();
	
	// nakreslení horizontální čáry
	ctx.beginPath();
	ctx.moveTo(center-150, ctx.canvas.height - 80);
	ctx.lineTo(center+150, ctx.canvas.height - 80);

  // nastavení šířky čáry na 1 pixel a barvy na šedou před vlastním 
  // zobrazením čáry na plátně
	ctx.lineWidth = 1;
	ctx.strokeStyle = "rgba(50,50,50,.8)";
	ctx.stroke();
}
