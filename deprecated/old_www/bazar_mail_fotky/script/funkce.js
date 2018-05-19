function kontrolaEmailu()
{
	if (window.RegExp) 
	{
		re = new RegExp("^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$");
		
		if (!re.test(document.getElementById("email").value))
		{
			window.alert("Zadal jsi špatný formát emailu !");
			return false;
		}
	}
}