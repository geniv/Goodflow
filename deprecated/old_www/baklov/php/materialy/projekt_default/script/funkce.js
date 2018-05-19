// JavaScript Document

	function PrepniStyl(cislo)
	{
	  var datum = new Date();
	  var pozdrav = NactiJmeno();
		datum.setTime(datum.getTime() + 24 * 60 * 1000);

		if (pozdrav == '') //je-li jméno prázdné
		{
			document.cookie = 'JMENO=' + escape("Vítej, člověče!") + '; EXPIRES=' + datum.toGMTString(); //uložení do cookie
			//document.getElementById('pozd').value= "Vítej, člověče!";
		}

		switch(cislo)
	  {
			case 1:
				document.cookie = 'STYLE=style_default; EXPIRES=' + datum.toGMTString(); //uložení do cookie
			break;
			
			case 2:
				document.cookie = 'STYLE=style_1; EXPIRES=' + datum.toGMTString(); //uložení do cookies
			break;
			
			case 3:
				document.cookie = 'STYLE=style_2; EXPIRES=' + datum.toGMTString(); //uložení do cookie
			break;
			
			case 4:
				document.cookie = 'STYLE=style_print; EXPIRES=' + datum.toGMTString(); //uložení do cookie
			break;
		}
		//alert(document.cookie);
	}
	
	function UlozJmeno(jmeno)
	{
		datum = new Date(); //vložení data expirace
		datum.setTime(datum.getTime() + 24 * 60 * 1000); //uložení do cookie
		document.cookie = 'JMENO=' + escape(jmeno)+'; EXPIRES=' + datum.toGMTString(); //uložení do cookie
	}
	
	function NactiJmeno()
	{
	  var kol = document.cookie; //načtení do proměnné
	  var p1 = kol.indexOf('JMENO=', kol) + 1; //zjištění pozice = a připočítání '='
		if (p1 != -1)	//je-li =
		{
			var p2 = kol.indexOf(';', p1); //hledá rozlišení další cookie
			if (p2 == -1) //neni-li ;
			{
				p2 = kol.length; //nastaví délku p2 na poslední znak v kol
			}
			return unescape(kol.substring((p1 + "JMENO".length), p2)); //vybere text mezi p1 + 1 a p2
		}
	}
	
	function NacteniWebu()
	{
		var pozdrav = NactiJmeno();

		if (pozdrav == "" || pozdrav == "=slyle_1")
		{
			document.getElementById('pozd').value = "Vítej, člověče!";
		}
			else
		{
			document.getElementById('pozd').value = pozdrav;
			document.getElementById('pozdr').innerHTML = pozdrav;
		}
	}
	
	
/*
	    <script type="text/javascript">
	 		function PrepniStyl(cislo)
			{
			  switch(cislo)
			  {
					case 1:
						//?
						//alert("bu1");
// 						document.write("<style>");
// 						document.write("body { background-color: red; }");
// 						document.write("</style>");
// 						document.write("ewrwt");
						//document.getElementById("hlavni").backgroundColor = red;
					break;
					
					case 2:
						//alert("bu2");
				  	//document.write("<link rel='stylesheet' type='text/css' href='styles/styl2.css' media='screen' />");
					break;
					
					case 3:
						//alert("bu3");
						//	document.write("<link rel='stylesheet' type='text/css' href='styles/styl3.css' media='screen' />");
					break;
					
					case 4:
						//lert("bu4");
						//	document.write("<link rel='stylesheet' type='text/css' href='styles/styl_tisk.css' media='screen' />");
					break;
				}
			}
  		</script>
  		<script type="text/javascript">
	 		function PrepniStyl(cislo)
			{
			  switch(cislo)
			  {
					case 1:
						//?
						//alert("bu1");
						//document.write("<style>");
						//document.write("body { background-color: red; }");
						//document.write("</style>");
						//document.write("ewrwt");
						document.getElementById('main').backgroundColor = red;
					break;
					
					case 2:
						//alert("bu2");
				  	//document.write("<link rel='stylesheet' type='text/css' href='styles/styl2.css' media='screen' />");
					break;
					
					case 3:
						//alert("bu3");
						//	document.write("<link rel='stylesheet' type='text/css' href='styles/styl3.css' media='screen' />");
					break;
					
					case 4:
						//lert("bu4");
						//	document.write("<link rel='stylesheet' type='text/css' href='styles/styl_tisk.css' media='screen' />");
					break;
				}
			}
  		</script>
*/
