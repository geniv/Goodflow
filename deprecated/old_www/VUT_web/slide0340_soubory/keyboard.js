	function alert_keycode(ev)
	{
		if (ev) event = ev;
		if (event.keyCode == 32 || event.keyCode == 13)
		{
			window.location.href = NEXT;
			event.returnValue = false;
		}
		if (event.keyCode == 8)
		{
			window.location.href = PREV;
			event.returnValue = false;
		}
		
	}
	document.onkeypress=alert_keycode;
