// JavaScript Document

	function PrepniStyl(cislo)
	{
	  var pozdrav = nacti_cookie("zdrav");

		switch(cislo)
	  {
			case 1:
        nastav_cookie("styl", "style_default");
			break;
			
			case 2:
				nastav_cookie("styl", "style_1");
			break;
			
			case 3:
				nastav_cookie("styl", "style_2");
			break;
			
			case 4:
				nastav_cookie("styl", "style_print");
			break;
			
			case 5:
				nastav_cookie("styl", "style_empty");
			break;
		}
	}
	
	function UlozJmeno(jmeno)
	{
  	if (jmeno != null)
  	{
  		nastav_cookie("zdrav", jmeno);
  		window.location="./index.htm";
  	}
	}
	
	
	function nastav_cookie(jmeno_cookie, hodnota)
  {
  	document.cookie = jmeno_cookie + "=" + escape(hodnota);
  }
  
  function nacti_cookie(jmeno_cookie)
  {
  if (document.cookie.length > 0)
    {
    cokstart = document.cookie.indexOf(jmeno_cookie + "=");
    if (cokstart != -1)
      {
      cokstart = cokstart + jmeno_cookie.length + 1;
      cokend = document.cookie.indexOf(";", cokstart);
      if (cokend == -1)
      {
        cokend = document.cookie.length;
      }
      return unescape(document.cookie.substring(cokstart, cokend));
      }
    }
    return "";
  }
	
	function NactiJmeno()
	{
    return nacti_cookie("zdrav");
	}
	
	function NacteniWebu()
	{
		var pozdrav = nacti_cookie("zdrav");

		if (pozdrav == '')
		{
			document.getElementById('pozdr').innerHTML = "Vítej, člověče!";
			document.getElementById('pozd').value = "Vítej, člověče!";
		}
			else
		{
			document.getElementById('pozd').value = pozdrav;
			document.getElementById('pozdr').innerHTML = pozdrav;
		}
	}
	
	function NactiStyl()
	{
    var css = nacti_cookie("styl");

    if (css != '')
    {
    	document.write("<link rel='stylesheet' type='text/css' href='styles/" + css + ".css' media='screen' />");
    }
      else
    {
      document.write("<link rel='stylesheet' type='text/css' href='styles/style_default.css' media='screen' />");
    }
  }
