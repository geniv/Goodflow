$(function(){
	var canvas = document.getElementById("game");  
	var ctx = canvas.getContext("2d");
	ctx.fillStyle = "rgba(20, 20, 10, .8)";
	
	// dolní půlkruh
	ctx.beginPath();
	ctx.arc(100, 110, 50 , 0, Math.PI); 
	ctx.closePath();
	ctx.fill();
	
	// horní půlkruh
	ctx.beginPath();
	ctx.arc(100, 90, 50 , 0, Math.PI, true); 
	ctx.closePath();
	ctx.fill();		
	
	// levý půlkruh
	ctx.beginPath();
	ctx.arc(230, 100, 50 , Math.PI/2, Math.PI*3/2); 
	ctx.closePath();
	ctx.fill();
	
	// pravý půlkruh
	ctx.beginPath();
	ctx.arc(250, 100, 50 , Math.PI*3/2, Math.PI/2); 
	ctx.closePath();
	ctx.fill();
	
	// téměř celý kruh
	ctx.beginPath();
	ctx.arc(180, 240, 50 , Math.PI*7/6, Math.PI*2/3); 
	ctx.closePath();
	ctx.fill();
	
	// malý oblouk
	ctx.beginPath();
	ctx.arc(150, 250, 50 , Math.PI*7/6, Math.PI*2/3, true); 
	ctx.closePath();
	ctx.fill();
	
});
